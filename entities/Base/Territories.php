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
use entities\Beats as ChildBeats;
use entities\BeatsQuery as ChildBeatsQuery;
use entities\Company as ChildCompany;
use entities\CompanyQuery as ChildCompanyQuery;
use entities\OnBoardRequest as ChildOnBoardRequest;
use entities\OnBoardRequestQuery as ChildOnBoardRequestQuery;
use entities\Orders as ChildOrders;
use entities\OrdersQuery as ChildOrdersQuery;
use entities\OrgUnit as ChildOrgUnit;
use entities\OrgUnitQuery as ChildOrgUnitQuery;
use entities\Positions as ChildPositions;
use entities\PositionsQuery as ChildPositionsQuery;
use entities\PrescriberData as ChildPrescriberData;
use entities\PrescriberDataQuery as ChildPrescriberDataQuery;
use entities\PrescriberTallySummary as ChildPrescriberTallySummary;
use entities\PrescriberTallySummaryQuery as ChildPrescriberTallySummaryQuery;
use entities\StpWeek as ChildStpWeek;
use entities\StpWeekQuery as ChildStpWeekQuery;
use entities\Territories as ChildTerritories;
use entities\TerritoriesQuery as ChildTerritoriesQuery;
use entities\TerritoryTowns as ChildTerritoryTowns;
use entities\TerritoryTownsQuery as ChildTerritoryTownsQuery;
use entities\Map\BeatsTableMap;
use entities\Map\OnBoardRequestTableMap;
use entities\Map\OrdersTableMap;
use entities\Map\PrescriberDataTableMap;
use entities\Map\PrescriberTallySummaryTableMap;
use entities\Map\StpWeekTableMap;
use entities\Map\TerritoriesTableMap;
use entities\Map\TerritoryTownsTableMap;

/**
 * Base class that represents a row from the 'territories' table.
 *
 *
 *
 * @package    propel.generator.entities.Base
 */
abstract class Territories implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\entities\\Map\\TerritoriesTableMap';


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
     * The value for the territory_id field.
     *
     * @var        int
     */
    protected $territory_id;

    /**
     * The value for the territory_code field.
     *
     * Note: this column has a database default value of: '0'
     * @var        string|null
     */
    protected $territory_code;

    /**
     * The value for the company_id field.
     *
     * @var        int
     */
    protected $company_id;

    /**
     * The value for the territory_name field.
     *
     * @var        string
     */
    protected $territory_name;

    /**
     * The value for the orgunitid field.
     *
     * @var        int|null
     */
    protected $orgunitid;

    /**
     * The value for the position_id field.
     *
     * @var        int|null
     */
    protected $position_id;

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
     * The value for the on_boarding_status field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $on_boarding_status;

    /**
     * The value for the start_date field.
     *
     * @var        DateTime|null
     */
    protected $start_date;

    /**
     * The value for the end_date field.
     *
     * @var        DateTime|null
     */
    protected $end_date;

    /**
     * The value for the istateid field.
     *
     * @var        int|null
     */
    protected $istateid;

    /**
     * @var        ChildCompany
     */
    protected $aCompany;

    /**
     * @var        ChildOrgUnit
     */
    protected $aOrgUnit;

    /**
     * @var        ChildPositions
     */
    protected $aPositions;

    /**
     * @var        ObjectCollection|ChildBeats[] Collection to store aggregation of ChildBeats objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildBeats> Collection to store aggregation of ChildBeats objects.
     */
    protected $collBeatss;
    protected $collBeatssPartial;

    /**
     * @var        ObjectCollection|ChildOnBoardRequest[] Collection to store aggregation of ChildOnBoardRequest objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildOnBoardRequest> Collection to store aggregation of ChildOnBoardRequest objects.
     */
    protected $collOnBoardRequests;
    protected $collOnBoardRequestsPartial;

    /**
     * @var        ObjectCollection|ChildOrders[] Collection to store aggregation of ChildOrders objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildOrders> Collection to store aggregation of ChildOrders objects.
     */
    protected $collOrderss;
    protected $collOrderssPartial;

    /**
     * @var        ObjectCollection|ChildPrescriberData[] Collection to store aggregation of ChildPrescriberData objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildPrescriberData> Collection to store aggregation of ChildPrescriberData objects.
     */
    protected $collPrescriberDatas;
    protected $collPrescriberDatasPartial;

    /**
     * @var        ObjectCollection|ChildPrescriberTallySummary[] Collection to store aggregation of ChildPrescriberTallySummary objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildPrescriberTallySummary> Collection to store aggregation of ChildPrescriberTallySummary objects.
     */
    protected $collPrescriberTallySummaries;
    protected $collPrescriberTallySummariesPartial;

    /**
     * @var        ObjectCollection|ChildTerritoryTowns[] Collection to store aggregation of ChildTerritoryTowns objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildTerritoryTowns> Collection to store aggregation of ChildTerritoryTowns objects.
     */
    protected $collTerritoryTownss;
    protected $collTerritoryTownssPartial;

    /**
     * @var        ObjectCollection|ChildStpWeek[] Collection to store aggregation of ChildStpWeek objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildStpWeek> Collection to store aggregation of ChildStpWeek objects.
     */
    protected $collStpWeeks;
    protected $collStpWeeksPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildBeats[]
     * @phpstan-var ObjectCollection&\Traversable<ChildBeats>
     */
    protected $beatssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildOnBoardRequest[]
     * @phpstan-var ObjectCollection&\Traversable<ChildOnBoardRequest>
     */
    protected $onBoardRequestsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildOrders[]
     * @phpstan-var ObjectCollection&\Traversable<ChildOrders>
     */
    protected $orderssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildPrescriberData[]
     * @phpstan-var ObjectCollection&\Traversable<ChildPrescriberData>
     */
    protected $prescriberDatasScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildPrescriberTallySummary[]
     * @phpstan-var ObjectCollection&\Traversable<ChildPrescriberTallySummary>
     */
    protected $prescriberTallySummariesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildTerritoryTowns[]
     * @phpstan-var ObjectCollection&\Traversable<ChildTerritoryTowns>
     */
    protected $territoryTownssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildStpWeek[]
     * @phpstan-var ObjectCollection&\Traversable<ChildStpWeek>
     */
    protected $stpWeeksScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues(): void
    {
        $this->territory_code = '0';
        $this->on_boarding_status = 0;
    }

    /**
     * Initializes internal state of entities\Base\Territories object.
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
     * Compares this with another <code>Territories</code> instance.  If
     * <code>obj</code> is an instance of <code>Territories</code>, delegates to
     * <code>equals(Territories)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [territory_id] column value.
     *
     * @return int
     */
    public function getTerritoryId()
    {
        return $this->territory_id;
    }

    /**
     * Get the [territory_code] column value.
     *
     * @return string|null
     */
    public function getTerritoryCode()
    {
        return $this->territory_code;
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
     * Get the [territory_name] column value.
     *
     * @return string
     */
    public function getTerritoryName()
    {
        return $this->territory_name;
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
     * Get the [position_id] column value.
     *
     * @return int|null
     */
    public function getPositionId()
    {
        return $this->position_id;
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
     * Get the [on_boarding_status] column value.
     *
     * @return int
     */
    public function getOnBoardingStatus()
    {
        return $this->on_boarding_status;
    }

    /**
     * Get the [optionally formatted] temporal [start_date] column value.
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
    public function getStartDate($format = null)
    {
        if ($format === null) {
            return $this->start_date;
        } else {
            return $this->start_date instanceof \DateTimeInterface ? $this->start_date->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [end_date] column value.
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
    public function getEndDate($format = null)
    {
        if ($format === null) {
            return $this->end_date;
        } else {
            return $this->end_date instanceof \DateTimeInterface ? $this->end_date->format($format) : null;
        }
    }

    /**
     * Get the [istateid] column value.
     *
     * @return int|null
     */
    public function getIstateid()
    {
        return $this->istateid;
    }

    /**
     * Set the value of [territory_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setTerritoryId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->territory_id !== $v) {
            $this->territory_id = $v;
            $this->modifiedColumns[TerritoriesTableMap::COL_TERRITORY_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [territory_code] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setTerritoryCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->territory_code !== $v) {
            $this->territory_code = $v;
            $this->modifiedColumns[TerritoriesTableMap::COL_TERRITORY_CODE] = true;
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
            $this->modifiedColumns[TerritoriesTableMap::COL_COMPANY_ID] = true;
        }

        if ($this->aCompany !== null && $this->aCompany->getCompanyId() !== $v) {
            $this->aCompany = null;
        }

        return $this;
    }

    /**
     * Set the value of [territory_name] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setTerritoryName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->territory_name !== $v) {
            $this->territory_name = $v;
            $this->modifiedColumns[TerritoriesTableMap::COL_TERRITORY_NAME] = true;
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
            $this->modifiedColumns[TerritoriesTableMap::COL_ORGUNITID] = true;
        }

        if ($this->aOrgUnit !== null && $this->aOrgUnit->getOrgunitid() !== $v) {
            $this->aOrgUnit = null;
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
            $this->modifiedColumns[TerritoriesTableMap::COL_POSITION_ID] = true;
        }

        if ($this->aPositions !== null && $this->aPositions->getPositionId() !== $v) {
            $this->aPositions = null;
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
                $this->modifiedColumns[TerritoriesTableMap::COL_CREATED_AT] = true;
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
                $this->modifiedColumns[TerritoriesTableMap::COL_UPDATED_AT] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [on_boarding_status] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOnBoardingStatus($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->on_boarding_status !== $v) {
            $this->on_boarding_status = $v;
            $this->modifiedColumns[TerritoriesTableMap::COL_ON_BOARDING_STATUS] = true;
        }

        return $this;
    }

    /**
     * Sets the value of [start_date] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setStartDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->start_date !== null || $dt !== null) {
            if ($this->start_date === null || $dt === null || $dt->format("Y-m-d") !== $this->start_date->format("Y-m-d")) {
                $this->start_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[TerritoriesTableMap::COL_START_DATE] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Sets the value of [end_date] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setEndDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->end_date !== null || $dt !== null) {
            if ($this->end_date === null || $dt === null || $dt->format("Y-m-d") !== $this->end_date->format("Y-m-d")) {
                $this->end_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[TerritoriesTableMap::COL_END_DATE] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [istateid] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIstateid($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->istateid !== $v) {
            $this->istateid = $v;
            $this->modifiedColumns[TerritoriesTableMap::COL_ISTATEID] = true;
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
            if ($this->territory_code !== '0') {
                return false;
            }

            if ($this->on_boarding_status !== 0) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : TerritoriesTableMap::translateFieldName('TerritoryId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->territory_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : TerritoriesTableMap::translateFieldName('TerritoryCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->territory_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : TerritoriesTableMap::translateFieldName('CompanyId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->company_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : TerritoriesTableMap::translateFieldName('TerritoryName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->territory_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : TerritoriesTableMap::translateFieldName('Orgunitid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->orgunitid = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : TerritoriesTableMap::translateFieldName('PositionId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->position_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : TerritoriesTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : TerritoriesTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : TerritoriesTableMap::translateFieldName('OnBoardingStatus', TableMap::TYPE_PHPNAME, $indexType)];
            $this->on_boarding_status = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : TerritoriesTableMap::translateFieldName('StartDate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->start_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : TerritoriesTableMap::translateFieldName('EndDate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->end_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : TerritoriesTableMap::translateFieldName('Istateid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->istateid = (null !== $col) ? (int) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 12; // 12 = TerritoriesTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\entities\\Territories'), 0, $e);
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
        if ($this->aOrgUnit !== null && $this->orgunitid !== $this->aOrgUnit->getOrgunitid()) {
            $this->aOrgUnit = null;
        }
        if ($this->aPositions !== null && $this->position_id !== $this->aPositions->getPositionId()) {
            $this->aPositions = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(TerritoriesTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildTerritoriesQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aCompany = null;
            $this->aOrgUnit = null;
            $this->aPositions = null;
            $this->collBeatss = null;

            $this->collOnBoardRequests = null;

            $this->collOrderss = null;

            $this->collPrescriberDatas = null;

            $this->collPrescriberTallySummaries = null;

            $this->collTerritoryTownss = null;

            $this->collStpWeeks = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see Territories::setDeleted()
     * @see Territories::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(TerritoriesTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildTerritoriesQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(TerritoriesTableMap::DATABASE_NAME);
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
                TerritoriesTableMap::addInstanceToPool($this);
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

            if ($this->aOrgUnit !== null) {
                if ($this->aOrgUnit->isModified() || $this->aOrgUnit->isNew()) {
                    $affectedRows += $this->aOrgUnit->save($con);
                }
                $this->setOrgUnit($this->aOrgUnit);
            }

            if ($this->aPositions !== null) {
                if ($this->aPositions->isModified() || $this->aPositions->isNew()) {
                    $affectedRows += $this->aPositions->save($con);
                }
                $this->setPositions($this->aPositions);
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

            if ($this->beatssScheduledForDeletion !== null) {
                if (!$this->beatssScheduledForDeletion->isEmpty()) {
                    \entities\BeatsQuery::create()
                        ->filterByPrimaryKeys($this->beatssScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->beatssScheduledForDeletion = null;
                }
            }

            if ($this->collBeatss !== null) {
                foreach ($this->collBeatss as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->onBoardRequestsScheduledForDeletion !== null) {
                if (!$this->onBoardRequestsScheduledForDeletion->isEmpty()) {
                    foreach ($this->onBoardRequestsScheduledForDeletion as $onBoardRequest) {
                        // need to save related object because we set the relation to null
                        $onBoardRequest->save($con);
                    }
                    $this->onBoardRequestsScheduledForDeletion = null;
                }
            }

            if ($this->collOnBoardRequests !== null) {
                foreach ($this->collOnBoardRequests as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->orderssScheduledForDeletion !== null) {
                if (!$this->orderssScheduledForDeletion->isEmpty()) {
                    foreach ($this->orderssScheduledForDeletion as $orders) {
                        // need to save related object because we set the relation to null
                        $orders->save($con);
                    }
                    $this->orderssScheduledForDeletion = null;
                }
            }

            if ($this->collOrderss !== null) {
                foreach ($this->collOrderss as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->prescriberDatasScheduledForDeletion !== null) {
                if (!$this->prescriberDatasScheduledForDeletion->isEmpty()) {
                    \entities\PrescriberDataQuery::create()
                        ->filterByPrimaryKeys($this->prescriberDatasScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->prescriberDatasScheduledForDeletion = null;
                }
            }

            if ($this->collPrescriberDatas !== null) {
                foreach ($this->collPrescriberDatas as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->prescriberTallySummariesScheduledForDeletion !== null) {
                if (!$this->prescriberTallySummariesScheduledForDeletion->isEmpty()) {
                    \entities\PrescriberTallySummaryQuery::create()
                        ->filterByPrimaryKeys($this->prescriberTallySummariesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->prescriberTallySummariesScheduledForDeletion = null;
                }
            }

            if ($this->collPrescriberTallySummaries !== null) {
                foreach ($this->collPrescriberTallySummaries as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->territoryTownssScheduledForDeletion !== null) {
                if (!$this->territoryTownssScheduledForDeletion->isEmpty()) {
                    \entities\TerritoryTownsQuery::create()
                        ->filterByPrimaryKeys($this->territoryTownssScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->territoryTownssScheduledForDeletion = null;
                }
            }

            if ($this->collTerritoryTownss !== null) {
                foreach ($this->collTerritoryTownss as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->stpWeeksScheduledForDeletion !== null) {
                if (!$this->stpWeeksScheduledForDeletion->isEmpty()) {
                    foreach ($this->stpWeeksScheduledForDeletion as $stpWeek) {
                        // need to save related object because we set the relation to null
                        $stpWeek->save($con);
                    }
                    $this->stpWeeksScheduledForDeletion = null;
                }
            }

            if ($this->collStpWeeks !== null) {
                foreach ($this->collStpWeeks as $referrerFK) {
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

        $this->modifiedColumns[TerritoriesTableMap::COL_TERRITORY_ID] = true;
        if (null !== $this->territory_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . TerritoriesTableMap::COL_TERRITORY_ID . ')');
        }
        if (null === $this->territory_id) {
            try {
                $dataFetcher = $con->query("SELECT nextval('territories_territory_id_seq')");
                $this->territory_id = (int) $dataFetcher->fetchColumn();
            } catch (Exception $e) {
                throw new PropelException('Unable to get sequence id.', 0, $e);
            }
        }


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(TerritoriesTableMap::COL_TERRITORY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'territory_id';
        }
        if ($this->isColumnModified(TerritoriesTableMap::COL_TERRITORY_CODE)) {
            $modifiedColumns[':p' . $index++]  = 'territory_code';
        }
        if ($this->isColumnModified(TerritoriesTableMap::COL_COMPANY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'company_id';
        }
        if ($this->isColumnModified(TerritoriesTableMap::COL_TERRITORY_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'territory_name';
        }
        if ($this->isColumnModified(TerritoriesTableMap::COL_ORGUNITID)) {
            $modifiedColumns[':p' . $index++]  = 'orgunitid';
        }
        if ($this->isColumnModified(TerritoriesTableMap::COL_POSITION_ID)) {
            $modifiedColumns[':p' . $index++]  = 'position_id';
        }
        if ($this->isColumnModified(TerritoriesTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(TerritoriesTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }
        if ($this->isColumnModified(TerritoriesTableMap::COL_ON_BOARDING_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'on_boarding_status';
        }
        if ($this->isColumnModified(TerritoriesTableMap::COL_START_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'start_date';
        }
        if ($this->isColumnModified(TerritoriesTableMap::COL_END_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'end_date';
        }
        if ($this->isColumnModified(TerritoriesTableMap::COL_ISTATEID)) {
            $modifiedColumns[':p' . $index++]  = 'istateid';
        }

        $sql = sprintf(
            'INSERT INTO territories (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'territory_id':
                        $stmt->bindValue($identifier, $this->territory_id, PDO::PARAM_INT);

                        break;
                    case 'territory_code':
                        $stmt->bindValue($identifier, $this->territory_code, PDO::PARAM_STR);

                        break;
                    case 'company_id':
                        $stmt->bindValue($identifier, $this->company_id, PDO::PARAM_INT);

                        break;
                    case 'territory_name':
                        $stmt->bindValue($identifier, $this->territory_name, PDO::PARAM_STR);

                        break;
                    case 'orgunitid':
                        $stmt->bindValue($identifier, $this->orgunitid, PDO::PARAM_INT);

                        break;
                    case 'position_id':
                        $stmt->bindValue($identifier, $this->position_id, PDO::PARAM_INT);

                        break;
                    case 'created_at':
                        $stmt->bindValue($identifier, $this->created_at ? $this->created_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'updated_at':
                        $stmt->bindValue($identifier, $this->updated_at ? $this->updated_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'on_boarding_status':
                        $stmt->bindValue($identifier, $this->on_boarding_status, PDO::PARAM_INT);

                        break;
                    case 'start_date':
                        $stmt->bindValue($identifier, $this->start_date ? $this->start_date->format("Y-m-d") : null, PDO::PARAM_STR);

                        break;
                    case 'end_date':
                        $stmt->bindValue($identifier, $this->end_date ? $this->end_date->format("Y-m-d") : null, PDO::PARAM_STR);

                        break;
                    case 'istateid':
                        $stmt->bindValue($identifier, $this->istateid, PDO::PARAM_INT);

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
        $pos = TerritoriesTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getTerritoryId();

            case 1:
                return $this->getTerritoryCode();

            case 2:
                return $this->getCompanyId();

            case 3:
                return $this->getTerritoryName();

            case 4:
                return $this->getOrgunitid();

            case 5:
                return $this->getPositionId();

            case 6:
                return $this->getCreatedAt();

            case 7:
                return $this->getUpdatedAt();

            case 8:
                return $this->getOnBoardingStatus();

            case 9:
                return $this->getStartDate();

            case 10:
                return $this->getEndDate();

            case 11:
                return $this->getIstateid();

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
        if (isset($alreadyDumpedObjects['Territories'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['Territories'][$this->hashCode()] = true;
        $keys = TerritoriesTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getTerritoryId(),
            $keys[1] => $this->getTerritoryCode(),
            $keys[2] => $this->getCompanyId(),
            $keys[3] => $this->getTerritoryName(),
            $keys[4] => $this->getOrgunitid(),
            $keys[5] => $this->getPositionId(),
            $keys[6] => $this->getCreatedAt(),
            $keys[7] => $this->getUpdatedAt(),
            $keys[8] => $this->getOnBoardingStatus(),
            $keys[9] => $this->getStartDate(),
            $keys[10] => $this->getEndDate(),
            $keys[11] => $this->getIstateid(),
        ];
        if ($result[$keys[6]] instanceof \DateTimeInterface) {
            $result[$keys[6]] = $result[$keys[6]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[7]] instanceof \DateTimeInterface) {
            $result[$keys[7]] = $result[$keys[7]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[9]] instanceof \DateTimeInterface) {
            $result[$keys[9]] = $result[$keys[9]]->format('Y-m-d');
        }

        if ($result[$keys[10]] instanceof \DateTimeInterface) {
            $result[$keys[10]] = $result[$keys[10]]->format('Y-m-d');
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
            if (null !== $this->collBeatss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'beatss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'beatss';
                        break;
                    default:
                        $key = 'Beatss';
                }

                $result[$key] = $this->collBeatss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collOnBoardRequests) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'onBoardRequests';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'on_board_requests';
                        break;
                    default:
                        $key = 'OnBoardRequests';
                }

                $result[$key] = $this->collOnBoardRequests->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collOrderss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'orderss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'orderss';
                        break;
                    default:
                        $key = 'Orderss';
                }

                $result[$key] = $this->collOrderss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collPrescriberDatas) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'prescriberDatas';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'prescriber_datas';
                        break;
                    default:
                        $key = 'PrescriberDatas';
                }

                $result[$key] = $this->collPrescriberDatas->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collPrescriberTallySummaries) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'prescriberTallySummaries';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'prescriber_tally_summaries';
                        break;
                    default:
                        $key = 'PrescriberTallySummaries';
                }

                $result[$key] = $this->collPrescriberTallySummaries->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collTerritoryTownss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'territoryTownss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'territory_townss';
                        break;
                    default:
                        $key = 'TerritoryTownss';
                }

                $result[$key] = $this->collTerritoryTownss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collStpWeeks) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'stpWeeks';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'stp_weeks';
                        break;
                    default:
                        $key = 'StpWeeks';
                }

                $result[$key] = $this->collStpWeeks->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = TerritoriesTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setTerritoryId($value);
                break;
            case 1:
                $this->setTerritoryCode($value);
                break;
            case 2:
                $this->setCompanyId($value);
                break;
            case 3:
                $this->setTerritoryName($value);
                break;
            case 4:
                $this->setOrgunitid($value);
                break;
            case 5:
                $this->setPositionId($value);
                break;
            case 6:
                $this->setCreatedAt($value);
                break;
            case 7:
                $this->setUpdatedAt($value);
                break;
            case 8:
                $this->setOnBoardingStatus($value);
                break;
            case 9:
                $this->setStartDate($value);
                break;
            case 10:
                $this->setEndDate($value);
                break;
            case 11:
                $this->setIstateid($value);
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
        $keys = TerritoriesTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setTerritoryId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setTerritoryCode($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setCompanyId($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setTerritoryName($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setOrgunitid($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setPositionId($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setCreatedAt($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setUpdatedAt($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setOnBoardingStatus($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setStartDate($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setEndDate($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setIstateid($arr[$keys[11]]);
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
        $criteria = new Criteria(TerritoriesTableMap::DATABASE_NAME);

        if ($this->isColumnModified(TerritoriesTableMap::COL_TERRITORY_ID)) {
            $criteria->add(TerritoriesTableMap::COL_TERRITORY_ID, $this->territory_id);
        }
        if ($this->isColumnModified(TerritoriesTableMap::COL_TERRITORY_CODE)) {
            $criteria->add(TerritoriesTableMap::COL_TERRITORY_CODE, $this->territory_code);
        }
        if ($this->isColumnModified(TerritoriesTableMap::COL_COMPANY_ID)) {
            $criteria->add(TerritoriesTableMap::COL_COMPANY_ID, $this->company_id);
        }
        if ($this->isColumnModified(TerritoriesTableMap::COL_TERRITORY_NAME)) {
            $criteria->add(TerritoriesTableMap::COL_TERRITORY_NAME, $this->territory_name);
        }
        if ($this->isColumnModified(TerritoriesTableMap::COL_ORGUNITID)) {
            $criteria->add(TerritoriesTableMap::COL_ORGUNITID, $this->orgunitid);
        }
        if ($this->isColumnModified(TerritoriesTableMap::COL_POSITION_ID)) {
            $criteria->add(TerritoriesTableMap::COL_POSITION_ID, $this->position_id);
        }
        if ($this->isColumnModified(TerritoriesTableMap::COL_CREATED_AT)) {
            $criteria->add(TerritoriesTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(TerritoriesTableMap::COL_UPDATED_AT)) {
            $criteria->add(TerritoriesTableMap::COL_UPDATED_AT, $this->updated_at);
        }
        if ($this->isColumnModified(TerritoriesTableMap::COL_ON_BOARDING_STATUS)) {
            $criteria->add(TerritoriesTableMap::COL_ON_BOARDING_STATUS, $this->on_boarding_status);
        }
        if ($this->isColumnModified(TerritoriesTableMap::COL_START_DATE)) {
            $criteria->add(TerritoriesTableMap::COL_START_DATE, $this->start_date);
        }
        if ($this->isColumnModified(TerritoriesTableMap::COL_END_DATE)) {
            $criteria->add(TerritoriesTableMap::COL_END_DATE, $this->end_date);
        }
        if ($this->isColumnModified(TerritoriesTableMap::COL_ISTATEID)) {
            $criteria->add(TerritoriesTableMap::COL_ISTATEID, $this->istateid);
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
        $criteria = ChildTerritoriesQuery::create();
        $criteria->add(TerritoriesTableMap::COL_TERRITORY_ID, $this->territory_id);

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
        $validPk = null !== $this->getTerritoryId();

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
        return $this->getTerritoryId();
    }

    /**
     * Generic method to set the primary key (territory_id column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setTerritoryId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getTerritoryId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \entities\Territories (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setTerritoryCode($this->getTerritoryCode());
        $copyObj->setCompanyId($this->getCompanyId());
        $copyObj->setTerritoryName($this->getTerritoryName());
        $copyObj->setOrgunitid($this->getOrgunitid());
        $copyObj->setPositionId($this->getPositionId());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        $copyObj->setOnBoardingStatus($this->getOnBoardingStatus());
        $copyObj->setStartDate($this->getStartDate());
        $copyObj->setEndDate($this->getEndDate());
        $copyObj->setIstateid($this->getIstateid());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getBeatss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBeats($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getOnBoardRequests() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOnBoardRequest($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getOrderss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOrders($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getPrescriberDatas() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPrescriberData($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getPrescriberTallySummaries() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPrescriberTallySummary($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getTerritoryTownss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTerritoryTowns($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getStpWeeks() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addStpWeek($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setTerritoryId(NULL); // this is a auto-increment column, so set to default value
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
     * @return \entities\Territories Clone of current object.
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
            $v->addTerritories($this);
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
                $this->aCompany->addTerritoriess($this);
             */
        }

        return $this->aCompany;
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
            $v->addTerritories($this);
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
                $this->aOrgUnit->addTerritoriess($this);
             */
        }

        return $this->aOrgUnit;
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
            $v->addTerritories($this);
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
                $this->aPositions->addTerritoriess($this);
             */
        }

        return $this->aPositions;
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
        if ('Beats' === $relationName) {
            $this->initBeatss();
            return;
        }
        if ('OnBoardRequest' === $relationName) {
            $this->initOnBoardRequests();
            return;
        }
        if ('Orders' === $relationName) {
            $this->initOrderss();
            return;
        }
        if ('PrescriberData' === $relationName) {
            $this->initPrescriberDatas();
            return;
        }
        if ('PrescriberTallySummary' === $relationName) {
            $this->initPrescriberTallySummaries();
            return;
        }
        if ('TerritoryTowns' === $relationName) {
            $this->initTerritoryTownss();
            return;
        }
        if ('StpWeek' === $relationName) {
            $this->initStpWeeks();
            return;
        }
    }

    /**
     * Clears out the collBeatss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addBeatss()
     */
    public function clearBeatss()
    {
        $this->collBeatss = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collBeatss collection loaded partially.
     *
     * @return void
     */
    public function resetPartialBeatss($v = true): void
    {
        $this->collBeatssPartial = $v;
    }

    /**
     * Initializes the collBeatss collection.
     *
     * By default this just sets the collBeatss collection to an empty array (like clearcollBeatss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBeatss(bool $overrideExisting = true): void
    {
        if (null !== $this->collBeatss && !$overrideExisting) {
            return;
        }

        $collectionClassName = BeatsTableMap::getTableMap()->getCollectionClassName();

        $this->collBeatss = new $collectionClassName;
        $this->collBeatss->setModel('\entities\Beats');
    }

    /**
     * Gets an array of ChildBeats objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildTerritories is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildBeats[] List of ChildBeats objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBeats> List of ChildBeats objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getBeatss(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collBeatssPartial && !$this->isNew();
        if (null === $this->collBeatss || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collBeatss) {
                    $this->initBeatss();
                } else {
                    $collectionClassName = BeatsTableMap::getTableMap()->getCollectionClassName();

                    $collBeatss = new $collectionClassName;
                    $collBeatss->setModel('\entities\Beats');

                    return $collBeatss;
                }
            } else {
                $collBeatss = ChildBeatsQuery::create(null, $criteria)
                    ->filterByTerritories($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collBeatssPartial && count($collBeatss)) {
                        $this->initBeatss(false);

                        foreach ($collBeatss as $obj) {
                            if (false == $this->collBeatss->contains($obj)) {
                                $this->collBeatss->append($obj);
                            }
                        }

                        $this->collBeatssPartial = true;
                    }

                    return $collBeatss;
                }

                if ($partial && $this->collBeatss) {
                    foreach ($this->collBeatss as $obj) {
                        if ($obj->isNew()) {
                            $collBeatss[] = $obj;
                        }
                    }
                }

                $this->collBeatss = $collBeatss;
                $this->collBeatssPartial = false;
            }
        }

        return $this->collBeatss;
    }

    /**
     * Sets a collection of ChildBeats objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $beatss A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setBeatss(Collection $beatss, ?ConnectionInterface $con = null)
    {
        /** @var ChildBeats[] $beatssToDelete */
        $beatssToDelete = $this->getBeatss(new Criteria(), $con)->diff($beatss);


        $this->beatssScheduledForDeletion = $beatssToDelete;

        foreach ($beatssToDelete as $beatsRemoved) {
            $beatsRemoved->setTerritories(null);
        }

        $this->collBeatss = null;
        foreach ($beatss as $beats) {
            $this->addBeats($beats);
        }

        $this->collBeatss = $beatss;
        $this->collBeatssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Beats objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related Beats objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countBeatss(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collBeatssPartial && !$this->isNew();
        if (null === $this->collBeatss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBeatss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getBeatss());
            }

            $query = ChildBeatsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByTerritories($this)
                ->count($con);
        }

        return count($this->collBeatss);
    }

    /**
     * Method called to associate a ChildBeats object to this object
     * through the ChildBeats foreign key attribute.
     *
     * @param ChildBeats $l ChildBeats
     * @return $this The current object (for fluent API support)
     */
    public function addBeats(ChildBeats $l)
    {
        if ($this->collBeatss === null) {
            $this->initBeatss();
            $this->collBeatssPartial = true;
        }

        if (!$this->collBeatss->contains($l)) {
            $this->doAddBeats($l);

            if ($this->beatssScheduledForDeletion and $this->beatssScheduledForDeletion->contains($l)) {
                $this->beatssScheduledForDeletion->remove($this->beatssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildBeats $beats The ChildBeats object to add.
     */
    protected function doAddBeats(ChildBeats $beats): void
    {
        $this->collBeatss[]= $beats;
        $beats->setTerritories($this);
    }

    /**
     * @param ChildBeats $beats The ChildBeats object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeBeats(ChildBeats $beats)
    {
        if ($this->getBeatss()->contains($beats)) {
            $pos = $this->collBeatss->search($beats);
            $this->collBeatss->remove($pos);
            if (null === $this->beatssScheduledForDeletion) {
                $this->beatssScheduledForDeletion = clone $this->collBeatss;
                $this->beatssScheduledForDeletion->clear();
            }
            $this->beatssScheduledForDeletion[]= $beats;
            $beats->setTerritories(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Territories is new, it will return
     * an empty collection; or if this Territories has previously
     * been saved, it will retrieve related Beatss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Territories.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBeats[] List of ChildBeats objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBeats}> List of ChildBeats objects
     */
    public function getBeatssJoinOrgUnit(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBeatsQuery::create(null, $criteria);
        $query->joinWith('OrgUnit', $joinBehavior);

        return $this->getBeatss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Territories is new, it will return
     * an empty collection; or if this Territories has previously
     * been saved, it will retrieve related Beatss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Territories.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBeats[] List of ChildBeats objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBeats}> List of ChildBeats objects
     */
    public function getBeatssJoinGeoTowns(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBeatsQuery::create(null, $criteria);
        $query->joinWith('GeoTowns', $joinBehavior);

        return $this->getBeatss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Territories is new, it will return
     * an empty collection; or if this Territories has previously
     * been saved, it will retrieve related Beatss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Territories.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBeats[] List of ChildBeats objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBeats}> List of ChildBeats objects
     */
    public function getBeatssJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBeatsQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getBeatss($query, $con);
    }

    /**
     * Clears out the collOnBoardRequests collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addOnBoardRequests()
     */
    public function clearOnBoardRequests()
    {
        $this->collOnBoardRequests = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collOnBoardRequests collection loaded partially.
     *
     * @return void
     */
    public function resetPartialOnBoardRequests($v = true): void
    {
        $this->collOnBoardRequestsPartial = $v;
    }

    /**
     * Initializes the collOnBoardRequests collection.
     *
     * By default this just sets the collOnBoardRequests collection to an empty array (like clearcollOnBoardRequests());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initOnBoardRequests(bool $overrideExisting = true): void
    {
        if (null !== $this->collOnBoardRequests && !$overrideExisting) {
            return;
        }

        $collectionClassName = OnBoardRequestTableMap::getTableMap()->getCollectionClassName();

        $this->collOnBoardRequests = new $collectionClassName;
        $this->collOnBoardRequests->setModel('\entities\OnBoardRequest');
    }

    /**
     * Gets an array of ChildOnBoardRequest objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildTerritories is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest> List of ChildOnBoardRequest objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOnBoardRequests(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collOnBoardRequestsPartial && !$this->isNew();
        if (null === $this->collOnBoardRequests || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collOnBoardRequests) {
                    $this->initOnBoardRequests();
                } else {
                    $collectionClassName = OnBoardRequestTableMap::getTableMap()->getCollectionClassName();

                    $collOnBoardRequests = new $collectionClassName;
                    $collOnBoardRequests->setModel('\entities\OnBoardRequest');

                    return $collOnBoardRequests;
                }
            } else {
                $collOnBoardRequests = ChildOnBoardRequestQuery::create(null, $criteria)
                    ->filterByTerritories($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collOnBoardRequestsPartial && count($collOnBoardRequests)) {
                        $this->initOnBoardRequests(false);

                        foreach ($collOnBoardRequests as $obj) {
                            if (false == $this->collOnBoardRequests->contains($obj)) {
                                $this->collOnBoardRequests->append($obj);
                            }
                        }

                        $this->collOnBoardRequestsPartial = true;
                    }

                    return $collOnBoardRequests;
                }

                if ($partial && $this->collOnBoardRequests) {
                    foreach ($this->collOnBoardRequests as $obj) {
                        if ($obj->isNew()) {
                            $collOnBoardRequests[] = $obj;
                        }
                    }
                }

                $this->collOnBoardRequests = $collOnBoardRequests;
                $this->collOnBoardRequestsPartial = false;
            }
        }

        return $this->collOnBoardRequests;
    }

    /**
     * Sets a collection of ChildOnBoardRequest objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $onBoardRequests A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setOnBoardRequests(Collection $onBoardRequests, ?ConnectionInterface $con = null)
    {
        /** @var ChildOnBoardRequest[] $onBoardRequestsToDelete */
        $onBoardRequestsToDelete = $this->getOnBoardRequests(new Criteria(), $con)->diff($onBoardRequests);


        $this->onBoardRequestsScheduledForDeletion = $onBoardRequestsToDelete;

        foreach ($onBoardRequestsToDelete as $onBoardRequestRemoved) {
            $onBoardRequestRemoved->setTerritories(null);
        }

        $this->collOnBoardRequests = null;
        foreach ($onBoardRequests as $onBoardRequest) {
            $this->addOnBoardRequest($onBoardRequest);
        }

        $this->collOnBoardRequests = $onBoardRequests;
        $this->collOnBoardRequestsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related OnBoardRequest objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related OnBoardRequest objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countOnBoardRequests(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collOnBoardRequestsPartial && !$this->isNew();
        if (null === $this->collOnBoardRequests || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collOnBoardRequests) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getOnBoardRequests());
            }

            $query = ChildOnBoardRequestQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByTerritories($this)
                ->count($con);
        }

        return count($this->collOnBoardRequests);
    }

    /**
     * Method called to associate a ChildOnBoardRequest object to this object
     * through the ChildOnBoardRequest foreign key attribute.
     *
     * @param ChildOnBoardRequest $l ChildOnBoardRequest
     * @return $this The current object (for fluent API support)
     */
    public function addOnBoardRequest(ChildOnBoardRequest $l)
    {
        if ($this->collOnBoardRequests === null) {
            $this->initOnBoardRequests();
            $this->collOnBoardRequestsPartial = true;
        }

        if (!$this->collOnBoardRequests->contains($l)) {
            $this->doAddOnBoardRequest($l);

            if ($this->onBoardRequestsScheduledForDeletion and $this->onBoardRequestsScheduledForDeletion->contains($l)) {
                $this->onBoardRequestsScheduledForDeletion->remove($this->onBoardRequestsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildOnBoardRequest $onBoardRequest The ChildOnBoardRequest object to add.
     */
    protected function doAddOnBoardRequest(ChildOnBoardRequest $onBoardRequest): void
    {
        $this->collOnBoardRequests[]= $onBoardRequest;
        $onBoardRequest->setTerritories($this);
    }

    /**
     * @param ChildOnBoardRequest $onBoardRequest The ChildOnBoardRequest object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeOnBoardRequest(ChildOnBoardRequest $onBoardRequest)
    {
        if ($this->getOnBoardRequests()->contains($onBoardRequest)) {
            $pos = $this->collOnBoardRequests->search($onBoardRequest);
            $this->collOnBoardRequests->remove($pos);
            if (null === $this->onBoardRequestsScheduledForDeletion) {
                $this->onBoardRequestsScheduledForDeletion = clone $this->collOnBoardRequests;
                $this->onBoardRequestsScheduledForDeletion->clear();
            }
            $this->onBoardRequestsScheduledForDeletion[]= $onBoardRequest;
            $onBoardRequest->setTerritories(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Territories is new, it will return
     * an empty collection; or if this Territories has previously
     * been saved, it will retrieve related OnBoardRequests from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Territories.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsJoinEmployeeRelatedByApprovedByEmployeeId(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('EmployeeRelatedByApprovedByEmployeeId', $joinBehavior);

        return $this->getOnBoardRequests($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Territories is new, it will return
     * an empty collection; or if this Territories has previously
     * been saved, it will retrieve related OnBoardRequests from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Territories.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsJoinPositionsRelatedByApprovedByPositionId(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('PositionsRelatedByApprovedByPositionId', $joinBehavior);

        return $this->getOnBoardRequests($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Territories is new, it will return
     * an empty collection; or if this Territories has previously
     * been saved, it will retrieve related OnBoardRequests from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Territories.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getOnBoardRequests($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Territories is new, it will return
     * an empty collection; or if this Territories has previously
     * been saved, it will retrieve related OnBoardRequests from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Territories.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsJoinEmployeeRelatedByCreatedByEmployeeId(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('EmployeeRelatedByCreatedByEmployeeId', $joinBehavior);

        return $this->getOnBoardRequests($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Territories is new, it will return
     * an empty collection; or if this Territories has previously
     * been saved, it will retrieve related OnBoardRequests from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Territories.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsJoinPositionsRelatedByCreatedByPositionId(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('PositionsRelatedByCreatedByPositionId', $joinBehavior);

        return $this->getOnBoardRequests($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Territories is new, it will return
     * an empty collection; or if this Territories has previously
     * been saved, it will retrieve related OnBoardRequests from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Territories.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsJoinEmployeeRelatedByFinalApprovedByEmployeeId(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('EmployeeRelatedByFinalApprovedByEmployeeId', $joinBehavior);

        return $this->getOnBoardRequests($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Territories is new, it will return
     * an empty collection; or if this Territories has previously
     * been saved, it will retrieve related OnBoardRequests from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Territories.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsJoinPositionsRelatedByFinalApprovedByPositionId(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('PositionsRelatedByFinalApprovedByPositionId', $joinBehavior);

        return $this->getOnBoardRequests($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Territories is new, it will return
     * an empty collection; or if this Territories has previously
     * been saved, it will retrieve related OnBoardRequests from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Territories.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsJoinOutlets(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('Outlets', $joinBehavior);

        return $this->getOnBoardRequests($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Territories is new, it will return
     * an empty collection; or if this Territories has previously
     * been saved, it will retrieve related OnBoardRequests from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Territories.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsJoinOutletType(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('OutletType', $joinBehavior);

        return $this->getOnBoardRequests($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Territories is new, it will return
     * an empty collection; or if this Territories has previously
     * been saved, it will retrieve related OnBoardRequests from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Territories.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsJoinPositionsRelatedByPosition(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('PositionsRelatedByPosition', $joinBehavior);

        return $this->getOnBoardRequests($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Territories is new, it will return
     * an empty collection; or if this Territories has previously
     * been saved, it will retrieve related OnBoardRequests from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Territories.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsJoinEmployeeRelatedByUpdatedByEmployeeId(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('EmployeeRelatedByUpdatedByEmployeeId', $joinBehavior);

        return $this->getOnBoardRequests($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Territories is new, it will return
     * an empty collection; or if this Territories has previously
     * been saved, it will retrieve related OnBoardRequests from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Territories.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsJoinPositionsRelatedByUpdatedByPositionId(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('PositionsRelatedByUpdatedByPositionId', $joinBehavior);

        return $this->getOnBoardRequests($query, $con);
    }

    /**
     * Clears out the collOrderss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addOrderss()
     */
    public function clearOrderss()
    {
        $this->collOrderss = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collOrderss collection loaded partially.
     *
     * @return void
     */
    public function resetPartialOrderss($v = true): void
    {
        $this->collOrderssPartial = $v;
    }

    /**
     * Initializes the collOrderss collection.
     *
     * By default this just sets the collOrderss collection to an empty array (like clearcollOrderss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initOrderss(bool $overrideExisting = true): void
    {
        if (null !== $this->collOrderss && !$overrideExisting) {
            return;
        }

        $collectionClassName = OrdersTableMap::getTableMap()->getCollectionClassName();

        $this->collOrderss = new $collectionClassName;
        $this->collOrderss->setModel('\entities\Orders');
    }

    /**
     * Gets an array of ChildOrders objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildTerritories is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildOrders[] List of ChildOrders objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrders> List of ChildOrders objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOrderss(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collOrderssPartial && !$this->isNew();
        if (null === $this->collOrderss || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collOrderss) {
                    $this->initOrderss();
                } else {
                    $collectionClassName = OrdersTableMap::getTableMap()->getCollectionClassName();

                    $collOrderss = new $collectionClassName;
                    $collOrderss->setModel('\entities\Orders');

                    return $collOrderss;
                }
            } else {
                $collOrderss = ChildOrdersQuery::create(null, $criteria)
                    ->filterByTerritories($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collOrderssPartial && count($collOrderss)) {
                        $this->initOrderss(false);

                        foreach ($collOrderss as $obj) {
                            if (false == $this->collOrderss->contains($obj)) {
                                $this->collOrderss->append($obj);
                            }
                        }

                        $this->collOrderssPartial = true;
                    }

                    return $collOrderss;
                }

                if ($partial && $this->collOrderss) {
                    foreach ($this->collOrderss as $obj) {
                        if ($obj->isNew()) {
                            $collOrderss[] = $obj;
                        }
                    }
                }

                $this->collOrderss = $collOrderss;
                $this->collOrderssPartial = false;
            }
        }

        return $this->collOrderss;
    }

    /**
     * Sets a collection of ChildOrders objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $orderss A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setOrderss(Collection $orderss, ?ConnectionInterface $con = null)
    {
        /** @var ChildOrders[] $orderssToDelete */
        $orderssToDelete = $this->getOrderss(new Criteria(), $con)->diff($orderss);


        $this->orderssScheduledForDeletion = $orderssToDelete;

        foreach ($orderssToDelete as $ordersRemoved) {
            $ordersRemoved->setTerritories(null);
        }

        $this->collOrderss = null;
        foreach ($orderss as $orders) {
            $this->addOrders($orders);
        }

        $this->collOrderss = $orderss;
        $this->collOrderssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Orders objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related Orders objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countOrderss(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collOrderssPartial && !$this->isNew();
        if (null === $this->collOrderss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collOrderss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getOrderss());
            }

            $query = ChildOrdersQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByTerritories($this)
                ->count($con);
        }

        return count($this->collOrderss);
    }

    /**
     * Method called to associate a ChildOrders object to this object
     * through the ChildOrders foreign key attribute.
     *
     * @param ChildOrders $l ChildOrders
     * @return $this The current object (for fluent API support)
     */
    public function addOrders(ChildOrders $l)
    {
        if ($this->collOrderss === null) {
            $this->initOrderss();
            $this->collOrderssPartial = true;
        }

        if (!$this->collOrderss->contains($l)) {
            $this->doAddOrders($l);

            if ($this->orderssScheduledForDeletion and $this->orderssScheduledForDeletion->contains($l)) {
                $this->orderssScheduledForDeletion->remove($this->orderssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildOrders $orders The ChildOrders object to add.
     */
    protected function doAddOrders(ChildOrders $orders): void
    {
        $this->collOrderss[]= $orders;
        $orders->setTerritories($this);
    }

    /**
     * @param ChildOrders $orders The ChildOrders object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeOrders(ChildOrders $orders)
    {
        if ($this->getOrderss()->contains($orders)) {
            $pos = $this->collOrderss->search($orders);
            $this->collOrderss->remove($pos);
            if (null === $this->orderssScheduledForDeletion) {
                $this->orderssScheduledForDeletion = clone $this->collOrderss;
                $this->orderssScheduledForDeletion->clear();
            }
            $this->orderssScheduledForDeletion[]= $orders;
            $orders->setTerritories(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Territories is new, it will return
     * an empty collection; or if this Territories has previously
     * been saved, it will retrieve related Orderss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Territories.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOrders[] List of ChildOrders objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrders}> List of ChildOrders objects
     */
    public function getOrderssJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOrdersQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getOrderss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Territories is new, it will return
     * an empty collection; or if this Territories has previously
     * been saved, it will retrieve related Orderss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Territories.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOrders[] List of ChildOrders objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrders}> List of ChildOrders objects
     */
    public function getOrderssJoinEmployee(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOrdersQuery::create(null, $criteria);
        $query->joinWith('Employee', $joinBehavior);

        return $this->getOrderss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Territories is new, it will return
     * an empty collection; or if this Territories has previously
     * been saved, it will retrieve related Orderss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Territories.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOrders[] List of ChildOrders objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrders}> List of ChildOrders objects
     */
    public function getOrderssJoinOutletsRelatedByOutletFrom(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOrdersQuery::create(null, $criteria);
        $query->joinWith('OutletsRelatedByOutletFrom', $joinBehavior);

        return $this->getOrderss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Territories is new, it will return
     * an empty collection; or if this Territories has previously
     * been saved, it will retrieve related Orderss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Territories.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOrders[] List of ChildOrders objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrders}> List of ChildOrders objects
     */
    public function getOrderssJoinOutletsRelatedByOutletTo(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOrdersQuery::create(null, $criteria);
        $query->joinWith('OutletsRelatedByOutletTo', $joinBehavior);

        return $this->getOrderss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Territories is new, it will return
     * an empty collection; or if this Territories has previously
     * been saved, it will retrieve related Orderss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Territories.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOrders[] List of ChildOrders objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrders}> List of ChildOrders objects
     */
    public function getOrderssJoinBeats(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOrdersQuery::create(null, $criteria);
        $query->joinWith('Beats', $joinBehavior);

        return $this->getOrderss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Territories is new, it will return
     * an empty collection; or if this Territories has previously
     * been saved, it will retrieve related Orderss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Territories.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOrders[] List of ChildOrders objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrders}> List of ChildOrders objects
     */
    public function getOrderssJoinPricebooks(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOrdersQuery::create(null, $criteria);
        $query->joinWith('Pricebooks', $joinBehavior);

        return $this->getOrderss($query, $con);
    }

    /**
     * Clears out the collPrescriberDatas collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addPrescriberDatas()
     */
    public function clearPrescriberDatas()
    {
        $this->collPrescriberDatas = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collPrescriberDatas collection loaded partially.
     *
     * @return void
     */
    public function resetPartialPrescriberDatas($v = true): void
    {
        $this->collPrescriberDatasPartial = $v;
    }

    /**
     * Initializes the collPrescriberDatas collection.
     *
     * By default this just sets the collPrescriberDatas collection to an empty array (like clearcollPrescriberDatas());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPrescriberDatas(bool $overrideExisting = true): void
    {
        if (null !== $this->collPrescriberDatas && !$overrideExisting) {
            return;
        }

        $collectionClassName = PrescriberDataTableMap::getTableMap()->getCollectionClassName();

        $this->collPrescriberDatas = new $collectionClassName;
        $this->collPrescriberDatas->setModel('\entities\PrescriberData');
    }

    /**
     * Gets an array of ChildPrescriberData objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildTerritories is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildPrescriberData[] List of ChildPrescriberData objects
     * @phpstan-return ObjectCollection&\Traversable<ChildPrescriberData> List of ChildPrescriberData objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getPrescriberDatas(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collPrescriberDatasPartial && !$this->isNew();
        if (null === $this->collPrescriberDatas || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collPrescriberDatas) {
                    $this->initPrescriberDatas();
                } else {
                    $collectionClassName = PrescriberDataTableMap::getTableMap()->getCollectionClassName();

                    $collPrescriberDatas = new $collectionClassName;
                    $collPrescriberDatas->setModel('\entities\PrescriberData');

                    return $collPrescriberDatas;
                }
            } else {
                $collPrescriberDatas = ChildPrescriberDataQuery::create(null, $criteria)
                    ->filterByTerritories($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collPrescriberDatasPartial && count($collPrescriberDatas)) {
                        $this->initPrescriberDatas(false);

                        foreach ($collPrescriberDatas as $obj) {
                            if (false == $this->collPrescriberDatas->contains($obj)) {
                                $this->collPrescriberDatas->append($obj);
                            }
                        }

                        $this->collPrescriberDatasPartial = true;
                    }

                    return $collPrescriberDatas;
                }

                if ($partial && $this->collPrescriberDatas) {
                    foreach ($this->collPrescriberDatas as $obj) {
                        if ($obj->isNew()) {
                            $collPrescriberDatas[] = $obj;
                        }
                    }
                }

                $this->collPrescriberDatas = $collPrescriberDatas;
                $this->collPrescriberDatasPartial = false;
            }
        }

        return $this->collPrescriberDatas;
    }

    /**
     * Sets a collection of ChildPrescriberData objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $prescriberDatas A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setPrescriberDatas(Collection $prescriberDatas, ?ConnectionInterface $con = null)
    {
        /** @var ChildPrescriberData[] $prescriberDatasToDelete */
        $prescriberDatasToDelete = $this->getPrescriberDatas(new Criteria(), $con)->diff($prescriberDatas);


        $this->prescriberDatasScheduledForDeletion = $prescriberDatasToDelete;

        foreach ($prescriberDatasToDelete as $prescriberDataRemoved) {
            $prescriberDataRemoved->setTerritories(null);
        }

        $this->collPrescriberDatas = null;
        foreach ($prescriberDatas as $prescriberData) {
            $this->addPrescriberData($prescriberData);
        }

        $this->collPrescriberDatas = $prescriberDatas;
        $this->collPrescriberDatasPartial = false;

        return $this;
    }

    /**
     * Returns the number of related PrescriberData objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related PrescriberData objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countPrescriberDatas(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collPrescriberDatasPartial && !$this->isNew();
        if (null === $this->collPrescriberDatas || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPrescriberDatas) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPrescriberDatas());
            }

            $query = ChildPrescriberDataQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByTerritories($this)
                ->count($con);
        }

        return count($this->collPrescriberDatas);
    }

    /**
     * Method called to associate a ChildPrescriberData object to this object
     * through the ChildPrescriberData foreign key attribute.
     *
     * @param ChildPrescriberData $l ChildPrescriberData
     * @return $this The current object (for fluent API support)
     */
    public function addPrescriberData(ChildPrescriberData $l)
    {
        if ($this->collPrescriberDatas === null) {
            $this->initPrescriberDatas();
            $this->collPrescriberDatasPartial = true;
        }

        if (!$this->collPrescriberDatas->contains($l)) {
            $this->doAddPrescriberData($l);

            if ($this->prescriberDatasScheduledForDeletion and $this->prescriberDatasScheduledForDeletion->contains($l)) {
                $this->prescriberDatasScheduledForDeletion->remove($this->prescriberDatasScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildPrescriberData $prescriberData The ChildPrescriberData object to add.
     */
    protected function doAddPrescriberData(ChildPrescriberData $prescriberData): void
    {
        $this->collPrescriberDatas[]= $prescriberData;
        $prescriberData->setTerritories($this);
    }

    /**
     * @param ChildPrescriberData $prescriberData The ChildPrescriberData object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removePrescriberData(ChildPrescriberData $prescriberData)
    {
        if ($this->getPrescriberDatas()->contains($prescriberData)) {
            $pos = $this->collPrescriberDatas->search($prescriberData);
            $this->collPrescriberDatas->remove($pos);
            if (null === $this->prescriberDatasScheduledForDeletion) {
                $this->prescriberDatasScheduledForDeletion = clone $this->collPrescriberDatas;
                $this->prescriberDatasScheduledForDeletion->clear();
            }
            $this->prescriberDatasScheduledForDeletion[]= clone $prescriberData;
            $prescriberData->setTerritories(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Territories is new, it will return
     * an empty collection; or if this Territories has previously
     * been saved, it will retrieve related PrescriberDatas from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Territories.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPrescriberData[] List of ChildPrescriberData objects
     * @phpstan-return ObjectCollection&\Traversable<ChildPrescriberData}> List of ChildPrescriberData objects
     */
    public function getPrescriberDatasJoinOrgUnit(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPrescriberDataQuery::create(null, $criteria);
        $query->joinWith('OrgUnit', $joinBehavior);

        return $this->getPrescriberDatas($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Territories is new, it will return
     * an empty collection; or if this Territories has previously
     * been saved, it will retrieve related PrescriberDatas from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Territories.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPrescriberData[] List of ChildPrescriberData objects
     * @phpstan-return ObjectCollection&\Traversable<ChildPrescriberData}> List of ChildPrescriberData objects
     */
    public function getPrescriberDatasJoinPositions(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPrescriberDataQuery::create(null, $criteria);
        $query->joinWith('Positions', $joinBehavior);

        return $this->getPrescriberDatas($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Territories is new, it will return
     * an empty collection; or if this Territories has previously
     * been saved, it will retrieve related PrescriberDatas from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Territories.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPrescriberData[] List of ChildPrescriberData objects
     * @phpstan-return ObjectCollection&\Traversable<ChildPrescriberData}> List of ChildPrescriberData objects
     */
    public function getPrescriberDatasJoinOutletOrgData(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPrescriberDataQuery::create(null, $criteria);
        $query->joinWith('OutletOrgData', $joinBehavior);

        return $this->getPrescriberDatas($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Territories is new, it will return
     * an empty collection; or if this Territories has previously
     * been saved, it will retrieve related PrescriberDatas from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Territories.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPrescriberData[] List of ChildPrescriberData objects
     * @phpstan-return ObjectCollection&\Traversable<ChildPrescriberData}> List of ChildPrescriberData objects
     */
    public function getPrescriberDatasJoinBrands(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPrescriberDataQuery::create(null, $criteria);
        $query->joinWith('Brands', $joinBehavior);

        return $this->getPrescriberDatas($query, $con);
    }

    /**
     * Clears out the collPrescriberTallySummaries collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addPrescriberTallySummaries()
     */
    public function clearPrescriberTallySummaries()
    {
        $this->collPrescriberTallySummaries = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collPrescriberTallySummaries collection loaded partially.
     *
     * @return void
     */
    public function resetPartialPrescriberTallySummaries($v = true): void
    {
        $this->collPrescriberTallySummariesPartial = $v;
    }

    /**
     * Initializes the collPrescriberTallySummaries collection.
     *
     * By default this just sets the collPrescriberTallySummaries collection to an empty array (like clearcollPrescriberTallySummaries());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPrescriberTallySummaries(bool $overrideExisting = true): void
    {
        if (null !== $this->collPrescriberTallySummaries && !$overrideExisting) {
            return;
        }

        $collectionClassName = PrescriberTallySummaryTableMap::getTableMap()->getCollectionClassName();

        $this->collPrescriberTallySummaries = new $collectionClassName;
        $this->collPrescriberTallySummaries->setModel('\entities\PrescriberTallySummary');
    }

    /**
     * Gets an array of ChildPrescriberTallySummary objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildTerritories is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildPrescriberTallySummary[] List of ChildPrescriberTallySummary objects
     * @phpstan-return ObjectCollection&\Traversable<ChildPrescriberTallySummary> List of ChildPrescriberTallySummary objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getPrescriberTallySummaries(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collPrescriberTallySummariesPartial && !$this->isNew();
        if (null === $this->collPrescriberTallySummaries || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collPrescriberTallySummaries) {
                    $this->initPrescriberTallySummaries();
                } else {
                    $collectionClassName = PrescriberTallySummaryTableMap::getTableMap()->getCollectionClassName();

                    $collPrescriberTallySummaries = new $collectionClassName;
                    $collPrescriberTallySummaries->setModel('\entities\PrescriberTallySummary');

                    return $collPrescriberTallySummaries;
                }
            } else {
                $collPrescriberTallySummaries = ChildPrescriberTallySummaryQuery::create(null, $criteria)
                    ->filterByTerritories($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collPrescriberTallySummariesPartial && count($collPrescriberTallySummaries)) {
                        $this->initPrescriberTallySummaries(false);

                        foreach ($collPrescriberTallySummaries as $obj) {
                            if (false == $this->collPrescriberTallySummaries->contains($obj)) {
                                $this->collPrescriberTallySummaries->append($obj);
                            }
                        }

                        $this->collPrescriberTallySummariesPartial = true;
                    }

                    return $collPrescriberTallySummaries;
                }

                if ($partial && $this->collPrescriberTallySummaries) {
                    foreach ($this->collPrescriberTallySummaries as $obj) {
                        if ($obj->isNew()) {
                            $collPrescriberTallySummaries[] = $obj;
                        }
                    }
                }

                $this->collPrescriberTallySummaries = $collPrescriberTallySummaries;
                $this->collPrescriberTallySummariesPartial = false;
            }
        }

        return $this->collPrescriberTallySummaries;
    }

    /**
     * Sets a collection of ChildPrescriberTallySummary objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $prescriberTallySummaries A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setPrescriberTallySummaries(Collection $prescriberTallySummaries, ?ConnectionInterface $con = null)
    {
        /** @var ChildPrescriberTallySummary[] $prescriberTallySummariesToDelete */
        $prescriberTallySummariesToDelete = $this->getPrescriberTallySummaries(new Criteria(), $con)->diff($prescriberTallySummaries);


        $this->prescriberTallySummariesScheduledForDeletion = $prescriberTallySummariesToDelete;

        foreach ($prescriberTallySummariesToDelete as $prescriberTallySummaryRemoved) {
            $prescriberTallySummaryRemoved->setTerritories(null);
        }

        $this->collPrescriberTallySummaries = null;
        foreach ($prescriberTallySummaries as $prescriberTallySummary) {
            $this->addPrescriberTallySummary($prescriberTallySummary);
        }

        $this->collPrescriberTallySummaries = $prescriberTallySummaries;
        $this->collPrescriberTallySummariesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related PrescriberTallySummary objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related PrescriberTallySummary objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countPrescriberTallySummaries(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collPrescriberTallySummariesPartial && !$this->isNew();
        if (null === $this->collPrescriberTallySummaries || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPrescriberTallySummaries) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPrescriberTallySummaries());
            }

            $query = ChildPrescriberTallySummaryQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByTerritories($this)
                ->count($con);
        }

        return count($this->collPrescriberTallySummaries);
    }

    /**
     * Method called to associate a ChildPrescriberTallySummary object to this object
     * through the ChildPrescriberTallySummary foreign key attribute.
     *
     * @param ChildPrescriberTallySummary $l ChildPrescriberTallySummary
     * @return $this The current object (for fluent API support)
     */
    public function addPrescriberTallySummary(ChildPrescriberTallySummary $l)
    {
        if ($this->collPrescriberTallySummaries === null) {
            $this->initPrescriberTallySummaries();
            $this->collPrescriberTallySummariesPartial = true;
        }

        if (!$this->collPrescriberTallySummaries->contains($l)) {
            $this->doAddPrescriberTallySummary($l);

            if ($this->prescriberTallySummariesScheduledForDeletion and $this->prescriberTallySummariesScheduledForDeletion->contains($l)) {
                $this->prescriberTallySummariesScheduledForDeletion->remove($this->prescriberTallySummariesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildPrescriberTallySummary $prescriberTallySummary The ChildPrescriberTallySummary object to add.
     */
    protected function doAddPrescriberTallySummary(ChildPrescriberTallySummary $prescriberTallySummary): void
    {
        $this->collPrescriberTallySummaries[]= $prescriberTallySummary;
        $prescriberTallySummary->setTerritories($this);
    }

    /**
     * @param ChildPrescriberTallySummary $prescriberTallySummary The ChildPrescriberTallySummary object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removePrescriberTallySummary(ChildPrescriberTallySummary $prescriberTallySummary)
    {
        if ($this->getPrescriberTallySummaries()->contains($prescriberTallySummary)) {
            $pos = $this->collPrescriberTallySummaries->search($prescriberTallySummary);
            $this->collPrescriberTallySummaries->remove($pos);
            if (null === $this->prescriberTallySummariesScheduledForDeletion) {
                $this->prescriberTallySummariesScheduledForDeletion = clone $this->collPrescriberTallySummaries;
                $this->prescriberTallySummariesScheduledForDeletion->clear();
            }
            $this->prescriberTallySummariesScheduledForDeletion[]= clone $prescriberTallySummary;
            $prescriberTallySummary->setTerritories(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Territories is new, it will return
     * an empty collection; or if this Territories has previously
     * been saved, it will retrieve related PrescriberTallySummaries from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Territories.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPrescriberTallySummary[] List of ChildPrescriberTallySummary objects
     * @phpstan-return ObjectCollection&\Traversable<ChildPrescriberTallySummary}> List of ChildPrescriberTallySummary objects
     */
    public function getPrescriberTallySummariesJoinOrgUnit(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPrescriberTallySummaryQuery::create(null, $criteria);
        $query->joinWith('OrgUnit', $joinBehavior);

        return $this->getPrescriberTallySummaries($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Territories is new, it will return
     * an empty collection; or if this Territories has previously
     * been saved, it will retrieve related PrescriberTallySummaries from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Territories.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPrescriberTallySummary[] List of ChildPrescriberTallySummary objects
     * @phpstan-return ObjectCollection&\Traversable<ChildPrescriberTallySummary}> List of ChildPrescriberTallySummary objects
     */
    public function getPrescriberTallySummariesJoinPositions(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPrescriberTallySummaryQuery::create(null, $criteria);
        $query->joinWith('Positions', $joinBehavior);

        return $this->getPrescriberTallySummaries($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Territories is new, it will return
     * an empty collection; or if this Territories has previously
     * been saved, it will retrieve related PrescriberTallySummaries from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Territories.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPrescriberTallySummary[] List of ChildPrescriberTallySummary objects
     * @phpstan-return ObjectCollection&\Traversable<ChildPrescriberTallySummary}> List of ChildPrescriberTallySummary objects
     */
    public function getPrescriberTallySummariesJoinBrands(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPrescriberTallySummaryQuery::create(null, $criteria);
        $query->joinWith('Brands', $joinBehavior);

        return $this->getPrescriberTallySummaries($query, $con);
    }

    /**
     * Clears out the collTerritoryTownss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addTerritoryTownss()
     */
    public function clearTerritoryTownss()
    {
        $this->collTerritoryTownss = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collTerritoryTownss collection loaded partially.
     *
     * @return void
     */
    public function resetPartialTerritoryTownss($v = true): void
    {
        $this->collTerritoryTownssPartial = $v;
    }

    /**
     * Initializes the collTerritoryTownss collection.
     *
     * By default this just sets the collTerritoryTownss collection to an empty array (like clearcollTerritoryTownss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTerritoryTownss(bool $overrideExisting = true): void
    {
        if (null !== $this->collTerritoryTownss && !$overrideExisting) {
            return;
        }

        $collectionClassName = TerritoryTownsTableMap::getTableMap()->getCollectionClassName();

        $this->collTerritoryTownss = new $collectionClassName;
        $this->collTerritoryTownss->setModel('\entities\TerritoryTowns');
    }

    /**
     * Gets an array of ChildTerritoryTowns objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildTerritories is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildTerritoryTowns[] List of ChildTerritoryTowns objects
     * @phpstan-return ObjectCollection&\Traversable<ChildTerritoryTowns> List of ChildTerritoryTowns objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getTerritoryTownss(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collTerritoryTownssPartial && !$this->isNew();
        if (null === $this->collTerritoryTownss || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collTerritoryTownss) {
                    $this->initTerritoryTownss();
                } else {
                    $collectionClassName = TerritoryTownsTableMap::getTableMap()->getCollectionClassName();

                    $collTerritoryTownss = new $collectionClassName;
                    $collTerritoryTownss->setModel('\entities\TerritoryTowns');

                    return $collTerritoryTownss;
                }
            } else {
                $collTerritoryTownss = ChildTerritoryTownsQuery::create(null, $criteria)
                    ->filterByTerritories($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collTerritoryTownssPartial && count($collTerritoryTownss)) {
                        $this->initTerritoryTownss(false);

                        foreach ($collTerritoryTownss as $obj) {
                            if (false == $this->collTerritoryTownss->contains($obj)) {
                                $this->collTerritoryTownss->append($obj);
                            }
                        }

                        $this->collTerritoryTownssPartial = true;
                    }

                    return $collTerritoryTownss;
                }

                if ($partial && $this->collTerritoryTownss) {
                    foreach ($this->collTerritoryTownss as $obj) {
                        if ($obj->isNew()) {
                            $collTerritoryTownss[] = $obj;
                        }
                    }
                }

                $this->collTerritoryTownss = $collTerritoryTownss;
                $this->collTerritoryTownssPartial = false;
            }
        }

        return $this->collTerritoryTownss;
    }

    /**
     * Sets a collection of ChildTerritoryTowns objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $territoryTownss A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setTerritoryTownss(Collection $territoryTownss, ?ConnectionInterface $con = null)
    {
        /** @var ChildTerritoryTowns[] $territoryTownssToDelete */
        $territoryTownssToDelete = $this->getTerritoryTownss(new Criteria(), $con)->diff($territoryTownss);


        $this->territoryTownssScheduledForDeletion = $territoryTownssToDelete;

        foreach ($territoryTownssToDelete as $territoryTownsRemoved) {
            $territoryTownsRemoved->setTerritories(null);
        }

        $this->collTerritoryTownss = null;
        foreach ($territoryTownss as $territoryTowns) {
            $this->addTerritoryTowns($territoryTowns);
        }

        $this->collTerritoryTownss = $territoryTownss;
        $this->collTerritoryTownssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related TerritoryTowns objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related TerritoryTowns objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countTerritoryTownss(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collTerritoryTownssPartial && !$this->isNew();
        if (null === $this->collTerritoryTownss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTerritoryTownss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getTerritoryTownss());
            }

            $query = ChildTerritoryTownsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByTerritories($this)
                ->count($con);
        }

        return count($this->collTerritoryTownss);
    }

    /**
     * Method called to associate a ChildTerritoryTowns object to this object
     * through the ChildTerritoryTowns foreign key attribute.
     *
     * @param ChildTerritoryTowns $l ChildTerritoryTowns
     * @return $this The current object (for fluent API support)
     */
    public function addTerritoryTowns(ChildTerritoryTowns $l)
    {
        if ($this->collTerritoryTownss === null) {
            $this->initTerritoryTownss();
            $this->collTerritoryTownssPartial = true;
        }

        if (!$this->collTerritoryTownss->contains($l)) {
            $this->doAddTerritoryTowns($l);

            if ($this->territoryTownssScheduledForDeletion and $this->territoryTownssScheduledForDeletion->contains($l)) {
                $this->territoryTownssScheduledForDeletion->remove($this->territoryTownssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildTerritoryTowns $territoryTowns The ChildTerritoryTowns object to add.
     */
    protected function doAddTerritoryTowns(ChildTerritoryTowns $territoryTowns): void
    {
        $this->collTerritoryTownss[]= $territoryTowns;
        $territoryTowns->setTerritories($this);
    }

    /**
     * @param ChildTerritoryTowns $territoryTowns The ChildTerritoryTowns object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeTerritoryTowns(ChildTerritoryTowns $territoryTowns)
    {
        if ($this->getTerritoryTownss()->contains($territoryTowns)) {
            $pos = $this->collTerritoryTownss->search($territoryTowns);
            $this->collTerritoryTownss->remove($pos);
            if (null === $this->territoryTownssScheduledForDeletion) {
                $this->territoryTownssScheduledForDeletion = clone $this->collTerritoryTownss;
                $this->territoryTownssScheduledForDeletion->clear();
            }
            $this->territoryTownssScheduledForDeletion[]= clone $territoryTowns;
            $territoryTowns->setTerritories(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Territories is new, it will return
     * an empty collection; or if this Territories has previously
     * been saved, it will retrieve related TerritoryTownss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Territories.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildTerritoryTowns[] List of ChildTerritoryTowns objects
     * @phpstan-return ObjectCollection&\Traversable<ChildTerritoryTowns}> List of ChildTerritoryTowns objects
     */
    public function getTerritoryTownssJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildTerritoryTownsQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getTerritoryTownss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Territories is new, it will return
     * an empty collection; or if this Territories has previously
     * been saved, it will retrieve related TerritoryTownss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Territories.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildTerritoryTowns[] List of ChildTerritoryTowns objects
     * @phpstan-return ObjectCollection&\Traversable<ChildTerritoryTowns}> List of ChildTerritoryTowns objects
     */
    public function getTerritoryTownssJoinGeoTowns(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildTerritoryTownsQuery::create(null, $criteria);
        $query->joinWith('GeoTowns', $joinBehavior);

        return $this->getTerritoryTownss($query, $con);
    }

    /**
     * Clears out the collStpWeeks collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addStpWeeks()
     */
    public function clearStpWeeks()
    {
        $this->collStpWeeks = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collStpWeeks collection loaded partially.
     *
     * @return void
     */
    public function resetPartialStpWeeks($v = true): void
    {
        $this->collStpWeeksPartial = $v;
    }

    /**
     * Initializes the collStpWeeks collection.
     *
     * By default this just sets the collStpWeeks collection to an empty array (like clearcollStpWeeks());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initStpWeeks(bool $overrideExisting = true): void
    {
        if (null !== $this->collStpWeeks && !$overrideExisting) {
            return;
        }

        $collectionClassName = StpWeekTableMap::getTableMap()->getCollectionClassName();

        $this->collStpWeeks = new $collectionClassName;
        $this->collStpWeeks->setModel('\entities\StpWeek');
    }

    /**
     * Gets an array of ChildStpWeek objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildTerritories is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildStpWeek[] List of ChildStpWeek objects
     * @phpstan-return ObjectCollection&\Traversable<ChildStpWeek> List of ChildStpWeek objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getStpWeeks(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collStpWeeksPartial && !$this->isNew();
        if (null === $this->collStpWeeks || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collStpWeeks) {
                    $this->initStpWeeks();
                } else {
                    $collectionClassName = StpWeekTableMap::getTableMap()->getCollectionClassName();

                    $collStpWeeks = new $collectionClassName;
                    $collStpWeeks->setModel('\entities\StpWeek');

                    return $collStpWeeks;
                }
            } else {
                $collStpWeeks = ChildStpWeekQuery::create(null, $criteria)
                    ->filterByTerritories($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collStpWeeksPartial && count($collStpWeeks)) {
                        $this->initStpWeeks(false);

                        foreach ($collStpWeeks as $obj) {
                            if (false == $this->collStpWeeks->contains($obj)) {
                                $this->collStpWeeks->append($obj);
                            }
                        }

                        $this->collStpWeeksPartial = true;
                    }

                    return $collStpWeeks;
                }

                if ($partial && $this->collStpWeeks) {
                    foreach ($this->collStpWeeks as $obj) {
                        if ($obj->isNew()) {
                            $collStpWeeks[] = $obj;
                        }
                    }
                }

                $this->collStpWeeks = $collStpWeeks;
                $this->collStpWeeksPartial = false;
            }
        }

        return $this->collStpWeeks;
    }

    /**
     * Sets a collection of ChildStpWeek objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $stpWeeks A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setStpWeeks(Collection $stpWeeks, ?ConnectionInterface $con = null)
    {
        /** @var ChildStpWeek[] $stpWeeksToDelete */
        $stpWeeksToDelete = $this->getStpWeeks(new Criteria(), $con)->diff($stpWeeks);


        $this->stpWeeksScheduledForDeletion = $stpWeeksToDelete;

        foreach ($stpWeeksToDelete as $stpWeekRemoved) {
            $stpWeekRemoved->setTerritories(null);
        }

        $this->collStpWeeks = null;
        foreach ($stpWeeks as $stpWeek) {
            $this->addStpWeek($stpWeek);
        }

        $this->collStpWeeks = $stpWeeks;
        $this->collStpWeeksPartial = false;

        return $this;
    }

    /**
     * Returns the number of related StpWeek objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related StpWeek objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countStpWeeks(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collStpWeeksPartial && !$this->isNew();
        if (null === $this->collStpWeeks || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collStpWeeks) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getStpWeeks());
            }

            $query = ChildStpWeekQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByTerritories($this)
                ->count($con);
        }

        return count($this->collStpWeeks);
    }

    /**
     * Method called to associate a ChildStpWeek object to this object
     * through the ChildStpWeek foreign key attribute.
     *
     * @param ChildStpWeek $l ChildStpWeek
     * @return $this The current object (for fluent API support)
     */
    public function addStpWeek(ChildStpWeek $l)
    {
        if ($this->collStpWeeks === null) {
            $this->initStpWeeks();
            $this->collStpWeeksPartial = true;
        }

        if (!$this->collStpWeeks->contains($l)) {
            $this->doAddStpWeek($l);

            if ($this->stpWeeksScheduledForDeletion and $this->stpWeeksScheduledForDeletion->contains($l)) {
                $this->stpWeeksScheduledForDeletion->remove($this->stpWeeksScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildStpWeek $stpWeek The ChildStpWeek object to add.
     */
    protected function doAddStpWeek(ChildStpWeek $stpWeek): void
    {
        $this->collStpWeeks[]= $stpWeek;
        $stpWeek->setTerritories($this);
    }

    /**
     * @param ChildStpWeek $stpWeek The ChildStpWeek object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeStpWeek(ChildStpWeek $stpWeek)
    {
        if ($this->getStpWeeks()->contains($stpWeek)) {
            $pos = $this->collStpWeeks->search($stpWeek);
            $this->collStpWeeks->remove($pos);
            if (null === $this->stpWeeksScheduledForDeletion) {
                $this->stpWeeksScheduledForDeletion = clone $this->collStpWeeks;
                $this->stpWeeksScheduledForDeletion->clear();
            }
            $this->stpWeeksScheduledForDeletion[]= $stpWeek;
            $stpWeek->setTerritories(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Territories is new, it will return
     * an empty collection; or if this Territories has previously
     * been saved, it will retrieve related StpWeeks from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Territories.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildStpWeek[] List of ChildStpWeek objects
     * @phpstan-return ObjectCollection&\Traversable<ChildStpWeek}> List of ChildStpWeek objects
     */
    public function getStpWeeksJoinBeats(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildStpWeekQuery::create(null, $criteria);
        $query->joinWith('Beats', $joinBehavior);

        return $this->getStpWeeks($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Territories is new, it will return
     * an empty collection; or if this Territories has previously
     * been saved, it will retrieve related StpWeeks from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Territories.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildStpWeek[] List of ChildStpWeek objects
     * @phpstan-return ObjectCollection&\Traversable<ChildStpWeek}> List of ChildStpWeek objects
     */
    public function getStpWeeksJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildStpWeekQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getStpWeeks($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Territories is new, it will return
     * an empty collection; or if this Territories has previously
     * been saved, it will retrieve related StpWeeks from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Territories.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildStpWeek[] List of ChildStpWeek objects
     * @phpstan-return ObjectCollection&\Traversable<ChildStpWeek}> List of ChildStpWeek objects
     */
    public function getStpWeeksJoinStp(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildStpWeekQuery::create(null, $criteria);
        $query->joinWith('Stp', $joinBehavior);

        return $this->getStpWeeks($query, $con);
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
            $this->aCompany->removeTerritories($this);
        }
        if (null !== $this->aOrgUnit) {
            $this->aOrgUnit->removeTerritories($this);
        }
        if (null !== $this->aPositions) {
            $this->aPositions->removeTerritories($this);
        }
        $this->territory_id = null;
        $this->territory_code = null;
        $this->company_id = null;
        $this->territory_name = null;
        $this->orgunitid = null;
        $this->position_id = null;
        $this->created_at = null;
        $this->updated_at = null;
        $this->on_boarding_status = null;
        $this->start_date = null;
        $this->end_date = null;
        $this->istateid = null;
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
            if ($this->collBeatss) {
                foreach ($this->collBeatss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collOnBoardRequests) {
                foreach ($this->collOnBoardRequests as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collOrderss) {
                foreach ($this->collOrderss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPrescriberDatas) {
                foreach ($this->collPrescriberDatas as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPrescriberTallySummaries) {
                foreach ($this->collPrescriberTallySummaries as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTerritoryTownss) {
                foreach ($this->collTerritoryTownss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collStpWeeks) {
                foreach ($this->collStpWeeks as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collBeatss = null;
        $this->collOnBoardRequests = null;
        $this->collOrderss = null;
        $this->collPrescriberDatas = null;
        $this->collPrescriberTallySummaries = null;
        $this->collTerritoryTownss = null;
        $this->collStpWeeks = null;
        $this->aCompany = null;
        $this->aOrgUnit = null;
        $this->aPositions = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(TerritoriesTableMap::DEFAULT_STRING_FORMAT);
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
