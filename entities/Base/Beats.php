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
use entities\BeatOutlets as ChildBeatOutlets;
use entities\BeatOutletsQuery as ChildBeatOutletsQuery;
use entities\Beats as ChildBeats;
use entities\BeatsQuery as ChildBeatsQuery;
use entities\Company as ChildCompany;
use entities\CompanyQuery as ChildCompanyQuery;
use entities\Dayplan as ChildDayplan;
use entities\DayplanQuery as ChildDayplanQuery;
use entities\GeoTowns as ChildGeoTowns;
use entities\GeoTownsQuery as ChildGeoTownsQuery;
use entities\OnBoardRequestAddress as ChildOnBoardRequestAddress;
use entities\OnBoardRequestAddressQuery as ChildOnBoardRequestAddressQuery;
use entities\Orders as ChildOrders;
use entities\OrdersQuery as ChildOrdersQuery;
use entities\OrgUnit as ChildOrgUnit;
use entities\OrgUnitQuery as ChildOrgUnitQuery;
use entities\StpWeek as ChildStpWeek;
use entities\StpWeekQuery as ChildStpWeekQuery;
use entities\Territories as ChildTerritories;
use entities\TerritoriesQuery as ChildTerritoriesQuery;
use entities\Tourplans as ChildTourplans;
use entities\TourplansQuery as ChildTourplansQuery;
use entities\Map\BeatOutletsTableMap;
use entities\Map\BeatsTableMap;
use entities\Map\DayplanTableMap;
use entities\Map\OnBoardRequestAddressTableMap;
use entities\Map\OrdersTableMap;
use entities\Map\StpWeekTableMap;
use entities\Map\TourplansTableMap;

/**
 * Base class that represents a row from the 'beats' table.
 *
 *
 *
 * @package    propel.generator.entities.Base
 */
abstract class Beats implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\entities\\Map\\BeatsTableMap';


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
     * The value for the beat_id field.
     *
     * @var        int
     */
    protected $beat_id;

    /**
     * The value for the beat_name field.
     *
     * @var        string
     */
    protected $beat_name;

    /**
     * The value for the beat_remark field.
     *
     * @var        string
     */
    protected $beat_remark;

    /**
     * The value for the beat_code field.
     *
     * @var        string
     */
    protected $beat_code;

    /**
     * The value for the territory_id field.
     *
     * @var        int|null
     */
    protected $territory_id;

    /**
     * The value for the company_id field.
     *
     * @var        int
     */
    protected $company_id;

    /**
     * The value for the itownid field.
     *
     * @var        string|null
     */
    protected $itownid;

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
     * The value for the org_unit_id field.
     *
     * @var        int|null
     */
    protected $org_unit_id;

    /**
     * @var        ChildOrgUnit
     */
    protected $aOrgUnit;

    /**
     * @var        ChildGeoTowns
     */
    protected $aGeoTowns;

    /**
     * @var        ChildCompany
     */
    protected $aCompany;

    /**
     * @var        ChildTerritories
     */
    protected $aTerritories;

    /**
     * @var        ObjectCollection|ChildBeatOutlets[] Collection to store aggregation of ChildBeatOutlets objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildBeatOutlets> Collection to store aggregation of ChildBeatOutlets objects.
     */
    protected $collBeatOutletss;
    protected $collBeatOutletssPartial;

    /**
     * @var        ObjectCollection|ChildDayplan[] Collection to store aggregation of ChildDayplan objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildDayplan> Collection to store aggregation of ChildDayplan objects.
     */
    protected $collDayplans;
    protected $collDayplansPartial;

    /**
     * @var        ObjectCollection|ChildOnBoardRequestAddress[] Collection to store aggregation of ChildOnBoardRequestAddress objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildOnBoardRequestAddress> Collection to store aggregation of ChildOnBoardRequestAddress objects.
     */
    protected $collOnBoardRequestAddresses;
    protected $collOnBoardRequestAddressesPartial;

    /**
     * @var        ObjectCollection|ChildOrders[] Collection to store aggregation of ChildOrders objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildOrders> Collection to store aggregation of ChildOrders objects.
     */
    protected $collOrderss;
    protected $collOrderssPartial;

    /**
     * @var        ObjectCollection|ChildTourplans[] Collection to store aggregation of ChildTourplans objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildTourplans> Collection to store aggregation of ChildTourplans objects.
     */
    protected $collTourplanss;
    protected $collTourplanssPartial;

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
     * @var ObjectCollection|ChildBeatOutlets[]
     * @phpstan-var ObjectCollection&\Traversable<ChildBeatOutlets>
     */
    protected $beatOutletssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildDayplan[]
     * @phpstan-var ObjectCollection&\Traversable<ChildDayplan>
     */
    protected $dayplansScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildOnBoardRequestAddress[]
     * @phpstan-var ObjectCollection&\Traversable<ChildOnBoardRequestAddress>
     */
    protected $onBoardRequestAddressesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildOrders[]
     * @phpstan-var ObjectCollection&\Traversable<ChildOrders>
     */
    protected $orderssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildTourplans[]
     * @phpstan-var ObjectCollection&\Traversable<ChildTourplans>
     */
    protected $tourplanssScheduledForDeletion = null;

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
    }

    /**
     * Initializes internal state of entities\Base\Beats object.
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
     * Compares this with another <code>Beats</code> instance.  If
     * <code>obj</code> is an instance of <code>Beats</code>, delegates to
     * <code>equals(Beats)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [beat_id] column value.
     *
     * @return int
     */
    public function getBeatId()
    {
        return $this->beat_id;
    }

    /**
     * Get the [beat_name] column value.
     *
     * @return string
     */
    public function getBeatName()
    {
        return $this->beat_name;
    }

    /**
     * Get the [beat_remark] column value.
     *
     * @return string
     */
    public function getBeatRemark()
    {
        return $this->beat_remark;
    }

    /**
     * Get the [beat_code] column value.
     *
     * @return string
     */
    public function getBeatCode()
    {
        return $this->beat_code;
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
     * Get the [company_id] column value.
     *
     * @return int
     */
    public function getCompanyId()
    {
        return $this->company_id;
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
     * Get the [org_unit_id] column value.
     *
     * @return int|null
     */
    public function getOrgUnitId()
    {
        return $this->org_unit_id;
    }

    /**
     * Set the value of [beat_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setBeatId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->beat_id !== $v) {
            $this->beat_id = $v;
            $this->modifiedColumns[BeatsTableMap::COL_BEAT_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [beat_name] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setBeatName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->beat_name !== $v) {
            $this->beat_name = $v;
            $this->modifiedColumns[BeatsTableMap::COL_BEAT_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [beat_remark] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setBeatRemark($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->beat_remark !== $v) {
            $this->beat_remark = $v;
            $this->modifiedColumns[BeatsTableMap::COL_BEAT_REMARK] = true;
        }

        return $this;
    }

    /**
     * Set the value of [beat_code] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setBeatCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->beat_code !== $v) {
            $this->beat_code = $v;
            $this->modifiedColumns[BeatsTableMap::COL_BEAT_CODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [territory_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setTerritoryId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->territory_id !== $v) {
            $this->territory_id = $v;
            $this->modifiedColumns[BeatsTableMap::COL_TERRITORY_ID] = true;
        }

        if ($this->aTerritories !== null && $this->aTerritories->getTerritoryId() !== $v) {
            $this->aTerritories = null;
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
            $this->modifiedColumns[BeatsTableMap::COL_COMPANY_ID] = true;
        }

        if ($this->aCompany !== null && $this->aCompany->getCompanyId() !== $v) {
            $this->aCompany = null;
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
            $this->modifiedColumns[BeatsTableMap::COL_ITOWNID] = true;
        }

        if ($this->aGeoTowns !== null && $this->aGeoTowns->getItownid() !== $v) {
            $this->aGeoTowns = null;
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
                $this->modifiedColumns[BeatsTableMap::COL_CREATED_AT] = true;
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
                $this->modifiedColumns[BeatsTableMap::COL_UPDATED_AT] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [org_unit_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOrgUnitId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->org_unit_id !== $v) {
            $this->org_unit_id = $v;
            $this->modifiedColumns[BeatsTableMap::COL_ORG_UNIT_ID] = true;
        }

        if ($this->aOrgUnit !== null && $this->aOrgUnit->getOrgunitid() !== $v) {
            $this->aOrgUnit = null;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : BeatsTableMap::translateFieldName('BeatId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->beat_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : BeatsTableMap::translateFieldName('BeatName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->beat_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : BeatsTableMap::translateFieldName('BeatRemark', TableMap::TYPE_PHPNAME, $indexType)];
            $this->beat_remark = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : BeatsTableMap::translateFieldName('BeatCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->beat_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : BeatsTableMap::translateFieldName('TerritoryId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->territory_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : BeatsTableMap::translateFieldName('CompanyId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->company_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : BeatsTableMap::translateFieldName('Itownid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->itownid = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : BeatsTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : BeatsTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : BeatsTableMap::translateFieldName('OrgUnitId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->org_unit_id = (null !== $col) ? (int) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 10; // 10 = BeatsTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\entities\\Beats'), 0, $e);
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
        if ($this->aTerritories !== null && $this->territory_id !== $this->aTerritories->getTerritoryId()) {
            $this->aTerritories = null;
        }
        if ($this->aCompany !== null && $this->company_id !== $this->aCompany->getCompanyId()) {
            $this->aCompany = null;
        }
        if ($this->aGeoTowns !== null && $this->itownid !== $this->aGeoTowns->getItownid()) {
            $this->aGeoTowns = null;
        }
        if ($this->aOrgUnit !== null && $this->org_unit_id !== $this->aOrgUnit->getOrgunitid()) {
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
            $con = Propel::getServiceContainer()->getReadConnection(BeatsTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildBeatsQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aOrgUnit = null;
            $this->aGeoTowns = null;
            $this->aCompany = null;
            $this->aTerritories = null;
            $this->collBeatOutletss = null;

            $this->collDayplans = null;

            $this->collOnBoardRequestAddresses = null;

            $this->collOrderss = null;

            $this->collTourplanss = null;

            $this->collStpWeeks = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see Beats::setDeleted()
     * @see Beats::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(BeatsTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildBeatsQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(BeatsTableMap::DATABASE_NAME);
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
                BeatsTableMap::addInstanceToPool($this);
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

            if ($this->aGeoTowns !== null) {
                if ($this->aGeoTowns->isModified() || $this->aGeoTowns->isNew()) {
                    $affectedRows += $this->aGeoTowns->save($con);
                }
                $this->setGeoTowns($this->aGeoTowns);
            }

            if ($this->aCompany !== null) {
                if ($this->aCompany->isModified() || $this->aCompany->isNew()) {
                    $affectedRows += $this->aCompany->save($con);
                }
                $this->setCompany($this->aCompany);
            }

            if ($this->aTerritories !== null) {
                if ($this->aTerritories->isModified() || $this->aTerritories->isNew()) {
                    $affectedRows += $this->aTerritories->save($con);
                }
                $this->setTerritories($this->aTerritories);
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

            if ($this->beatOutletssScheduledForDeletion !== null) {
                if (!$this->beatOutletssScheduledForDeletion->isEmpty()) {
                    \entities\BeatOutletsQuery::create()
                        ->filterByPrimaryKeys($this->beatOutletssScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->beatOutletssScheduledForDeletion = null;
                }
            }

            if ($this->collBeatOutletss !== null) {
                foreach ($this->collBeatOutletss as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->dayplansScheduledForDeletion !== null) {
                if (!$this->dayplansScheduledForDeletion->isEmpty()) {
                    foreach ($this->dayplansScheduledForDeletion as $dayplan) {
                        // need to save related object because we set the relation to null
                        $dayplan->save($con);
                    }
                    $this->dayplansScheduledForDeletion = null;
                }
            }

            if ($this->collDayplans !== null) {
                foreach ($this->collDayplans as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->onBoardRequestAddressesScheduledForDeletion !== null) {
                if (!$this->onBoardRequestAddressesScheduledForDeletion->isEmpty()) {
                    foreach ($this->onBoardRequestAddressesScheduledForDeletion as $onBoardRequestAddress) {
                        // need to save related object because we set the relation to null
                        $onBoardRequestAddress->save($con);
                    }
                    $this->onBoardRequestAddressesScheduledForDeletion = null;
                }
            }

            if ($this->collOnBoardRequestAddresses !== null) {
                foreach ($this->collOnBoardRequestAddresses as $referrerFK) {
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

            if ($this->tourplanssScheduledForDeletion !== null) {
                if (!$this->tourplanssScheduledForDeletion->isEmpty()) {
                    foreach ($this->tourplanssScheduledForDeletion as $tourplans) {
                        // need to save related object because we set the relation to null
                        $tourplans->save($con);
                    }
                    $this->tourplanssScheduledForDeletion = null;
                }
            }

            if ($this->collTourplanss !== null) {
                foreach ($this->collTourplanss as $referrerFK) {
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

        $this->modifiedColumns[BeatsTableMap::COL_BEAT_ID] = true;
        if (null !== $this->beat_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . BeatsTableMap::COL_BEAT_ID . ')');
        }
        if (null === $this->beat_id) {
            try {
                $dataFetcher = $con->query("SELECT nextval('beats_beat_id_seq')");
                $this->beat_id = (int) $dataFetcher->fetchColumn();
            } catch (Exception $e) {
                throw new PropelException('Unable to get sequence id.', 0, $e);
            }
        }


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(BeatsTableMap::COL_BEAT_ID)) {
            $modifiedColumns[':p' . $index++]  = 'beat_id';
        }
        if ($this->isColumnModified(BeatsTableMap::COL_BEAT_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'beat_name';
        }
        if ($this->isColumnModified(BeatsTableMap::COL_BEAT_REMARK)) {
            $modifiedColumns[':p' . $index++]  = 'beat_remark';
        }
        if ($this->isColumnModified(BeatsTableMap::COL_BEAT_CODE)) {
            $modifiedColumns[':p' . $index++]  = 'beat_code';
        }
        if ($this->isColumnModified(BeatsTableMap::COL_TERRITORY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'territory_id';
        }
        if ($this->isColumnModified(BeatsTableMap::COL_COMPANY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'company_id';
        }
        if ($this->isColumnModified(BeatsTableMap::COL_ITOWNID)) {
            $modifiedColumns[':p' . $index++]  = 'itownid';
        }
        if ($this->isColumnModified(BeatsTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(BeatsTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }
        if ($this->isColumnModified(BeatsTableMap::COL_ORG_UNIT_ID)) {
            $modifiedColumns[':p' . $index++]  = 'org_unit_id';
        }

        $sql = sprintf(
            'INSERT INTO beats (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'beat_id':
                        $stmt->bindValue($identifier, $this->beat_id, PDO::PARAM_INT);

                        break;
                    case 'beat_name':
                        $stmt->bindValue($identifier, $this->beat_name, PDO::PARAM_STR);

                        break;
                    case 'beat_remark':
                        $stmt->bindValue($identifier, $this->beat_remark, PDO::PARAM_STR);

                        break;
                    case 'beat_code':
                        $stmt->bindValue($identifier, $this->beat_code, PDO::PARAM_STR);

                        break;
                    case 'territory_id':
                        $stmt->bindValue($identifier, $this->territory_id, PDO::PARAM_INT);

                        break;
                    case 'company_id':
                        $stmt->bindValue($identifier, $this->company_id, PDO::PARAM_INT);

                        break;
                    case 'itownid':
                        $stmt->bindValue($identifier, $this->itownid, PDO::PARAM_INT);

                        break;
                    case 'created_at':
                        $stmt->bindValue($identifier, $this->created_at ? $this->created_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'updated_at':
                        $stmt->bindValue($identifier, $this->updated_at ? $this->updated_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'org_unit_id':
                        $stmt->bindValue($identifier, $this->org_unit_id, PDO::PARAM_INT);

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
        $pos = BeatsTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getBeatId();

            case 1:
                return $this->getBeatName();

            case 2:
                return $this->getBeatRemark();

            case 3:
                return $this->getBeatCode();

            case 4:
                return $this->getTerritoryId();

            case 5:
                return $this->getCompanyId();

            case 6:
                return $this->getItownid();

            case 7:
                return $this->getCreatedAt();

            case 8:
                return $this->getUpdatedAt();

            case 9:
                return $this->getOrgUnitId();

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
        if (isset($alreadyDumpedObjects['Beats'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['Beats'][$this->hashCode()] = true;
        $keys = BeatsTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getBeatId(),
            $keys[1] => $this->getBeatName(),
            $keys[2] => $this->getBeatRemark(),
            $keys[3] => $this->getBeatCode(),
            $keys[4] => $this->getTerritoryId(),
            $keys[5] => $this->getCompanyId(),
            $keys[6] => $this->getItownid(),
            $keys[7] => $this->getCreatedAt(),
            $keys[8] => $this->getUpdatedAt(),
            $keys[9] => $this->getOrgUnitId(),
        ];
        if ($result[$keys[7]] instanceof \DateTimeInterface) {
            $result[$keys[7]] = $result[$keys[7]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[8]] instanceof \DateTimeInterface) {
            $result[$keys[8]] = $result[$keys[8]]->format('Y-m-d H:i:s.u');
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
            if (null !== $this->aTerritories) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'territories';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'territories';
                        break;
                    default:
                        $key = 'Territories';
                }

                $result[$key] = $this->aTerritories->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collBeatOutletss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'beatOutletss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'beat_outletss';
                        break;
                    default:
                        $key = 'BeatOutletss';
                }

                $result[$key] = $this->collBeatOutletss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collDayplans) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'dayplans';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'dayplans';
                        break;
                    default:
                        $key = 'Dayplans';
                }

                $result[$key] = $this->collDayplans->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collOnBoardRequestAddresses) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'onBoardRequestAddresses';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'on_board_request_addresses';
                        break;
                    default:
                        $key = 'OnBoardRequestAddresses';
                }

                $result[$key] = $this->collOnBoardRequestAddresses->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
            if (null !== $this->collTourplanss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'tourplanss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'tourplanss';
                        break;
                    default:
                        $key = 'Tourplanss';
                }

                $result[$key] = $this->collTourplanss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = BeatsTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setBeatId($value);
                break;
            case 1:
                $this->setBeatName($value);
                break;
            case 2:
                $this->setBeatRemark($value);
                break;
            case 3:
                $this->setBeatCode($value);
                break;
            case 4:
                $this->setTerritoryId($value);
                break;
            case 5:
                $this->setCompanyId($value);
                break;
            case 6:
                $this->setItownid($value);
                break;
            case 7:
                $this->setCreatedAt($value);
                break;
            case 8:
                $this->setUpdatedAt($value);
                break;
            case 9:
                $this->setOrgUnitId($value);
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
        $keys = BeatsTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setBeatId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setBeatName($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setBeatRemark($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setBeatCode($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setTerritoryId($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setCompanyId($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setItownid($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setCreatedAt($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setUpdatedAt($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setOrgUnitId($arr[$keys[9]]);
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
        $criteria = new Criteria(BeatsTableMap::DATABASE_NAME);

        if ($this->isColumnModified(BeatsTableMap::COL_BEAT_ID)) {
            $criteria->add(BeatsTableMap::COL_BEAT_ID, $this->beat_id);
        }
        if ($this->isColumnModified(BeatsTableMap::COL_BEAT_NAME)) {
            $criteria->add(BeatsTableMap::COL_BEAT_NAME, $this->beat_name);
        }
        if ($this->isColumnModified(BeatsTableMap::COL_BEAT_REMARK)) {
            $criteria->add(BeatsTableMap::COL_BEAT_REMARK, $this->beat_remark);
        }
        if ($this->isColumnModified(BeatsTableMap::COL_BEAT_CODE)) {
            $criteria->add(BeatsTableMap::COL_BEAT_CODE, $this->beat_code);
        }
        if ($this->isColumnModified(BeatsTableMap::COL_TERRITORY_ID)) {
            $criteria->add(BeatsTableMap::COL_TERRITORY_ID, $this->territory_id);
        }
        if ($this->isColumnModified(BeatsTableMap::COL_COMPANY_ID)) {
            $criteria->add(BeatsTableMap::COL_COMPANY_ID, $this->company_id);
        }
        if ($this->isColumnModified(BeatsTableMap::COL_ITOWNID)) {
            $criteria->add(BeatsTableMap::COL_ITOWNID, $this->itownid);
        }
        if ($this->isColumnModified(BeatsTableMap::COL_CREATED_AT)) {
            $criteria->add(BeatsTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(BeatsTableMap::COL_UPDATED_AT)) {
            $criteria->add(BeatsTableMap::COL_UPDATED_AT, $this->updated_at);
        }
        if ($this->isColumnModified(BeatsTableMap::COL_ORG_UNIT_ID)) {
            $criteria->add(BeatsTableMap::COL_ORG_UNIT_ID, $this->org_unit_id);
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
        $criteria = ChildBeatsQuery::create();
        $criteria->add(BeatsTableMap::COL_BEAT_ID, $this->beat_id);

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
        $validPk = null !== $this->getBeatId();

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
        return $this->getBeatId();
    }

    /**
     * Generic method to set the primary key (beat_id column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setBeatId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getBeatId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \entities\Beats (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setBeatName($this->getBeatName());
        $copyObj->setBeatRemark($this->getBeatRemark());
        $copyObj->setBeatCode($this->getBeatCode());
        $copyObj->setTerritoryId($this->getTerritoryId());
        $copyObj->setCompanyId($this->getCompanyId());
        $copyObj->setItownid($this->getItownid());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        $copyObj->setOrgUnitId($this->getOrgUnitId());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getBeatOutletss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBeatOutlets($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getDayplans() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addDayplan($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getOnBoardRequestAddresses() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOnBoardRequestAddress($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getOrderss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOrders($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getTourplanss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTourplans($relObj->copy($deepCopy));
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
            $copyObj->setBeatId(NULL); // this is a auto-increment column, so set to default value
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
     * @return \entities\Beats Clone of current object.
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
            $this->setOrgUnitId(NULL);
        } else {
            $this->setOrgUnitId($v->getOrgunitid());
        }

        $this->aOrgUnit = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildOrgUnit object, it will not be re-added.
        if ($v !== null) {
            $v->addBeats($this);
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
        if ($this->aOrgUnit === null && ($this->org_unit_id != 0)) {
            $this->aOrgUnit = ChildOrgUnitQuery::create()->findPk($this->org_unit_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aOrgUnit->addBeatss($this);
             */
        }

        return $this->aOrgUnit;
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
            $v->addBeats($this);
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
                $this->aGeoTowns->addBeatss($this);
             */
        }

        return $this->aGeoTowns;
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
            $v->addBeats($this);
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
                $this->aCompany->addBeatss($this);
             */
        }

        return $this->aCompany;
    }

    /**
     * Declares an association between this object and a ChildTerritories object.
     *
     * @param ChildTerritories|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setTerritories(ChildTerritories $v = null)
    {
        if ($v === null) {
            $this->setTerritoryId(NULL);
        } else {
            $this->setTerritoryId($v->getTerritoryId());
        }

        $this->aTerritories = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildTerritories object, it will not be re-added.
        if ($v !== null) {
            $v->addBeats($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildTerritories object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildTerritories|null The associated ChildTerritories object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getTerritories(?ConnectionInterface $con = null)
    {
        if ($this->aTerritories === null && ($this->territory_id != 0)) {
            $this->aTerritories = ChildTerritoriesQuery::create()->findPk($this->territory_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aTerritories->addBeatss($this);
             */
        }

        return $this->aTerritories;
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
        if ('BeatOutlets' === $relationName) {
            $this->initBeatOutletss();
            return;
        }
        if ('Dayplan' === $relationName) {
            $this->initDayplans();
            return;
        }
        if ('OnBoardRequestAddress' === $relationName) {
            $this->initOnBoardRequestAddresses();
            return;
        }
        if ('Orders' === $relationName) {
            $this->initOrderss();
            return;
        }
        if ('Tourplans' === $relationName) {
            $this->initTourplanss();
            return;
        }
        if ('StpWeek' === $relationName) {
            $this->initStpWeeks();
            return;
        }
    }

    /**
     * Clears out the collBeatOutletss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addBeatOutletss()
     */
    public function clearBeatOutletss()
    {
        $this->collBeatOutletss = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collBeatOutletss collection loaded partially.
     *
     * @return void
     */
    public function resetPartialBeatOutletss($v = true): void
    {
        $this->collBeatOutletssPartial = $v;
    }

    /**
     * Initializes the collBeatOutletss collection.
     *
     * By default this just sets the collBeatOutletss collection to an empty array (like clearcollBeatOutletss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBeatOutletss(bool $overrideExisting = true): void
    {
        if (null !== $this->collBeatOutletss && !$overrideExisting) {
            return;
        }

        $collectionClassName = BeatOutletsTableMap::getTableMap()->getCollectionClassName();

        $this->collBeatOutletss = new $collectionClassName;
        $this->collBeatOutletss->setModel('\entities\BeatOutlets');
    }

    /**
     * Gets an array of ChildBeatOutlets objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildBeats is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildBeatOutlets[] List of ChildBeatOutlets objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBeatOutlets> List of ChildBeatOutlets objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getBeatOutletss(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collBeatOutletssPartial && !$this->isNew();
        if (null === $this->collBeatOutletss || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collBeatOutletss) {
                    $this->initBeatOutletss();
                } else {
                    $collectionClassName = BeatOutletsTableMap::getTableMap()->getCollectionClassName();

                    $collBeatOutletss = new $collectionClassName;
                    $collBeatOutletss->setModel('\entities\BeatOutlets');

                    return $collBeatOutletss;
                }
            } else {
                $collBeatOutletss = ChildBeatOutletsQuery::create(null, $criteria)
                    ->filterByBeats($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collBeatOutletssPartial && count($collBeatOutletss)) {
                        $this->initBeatOutletss(false);

                        foreach ($collBeatOutletss as $obj) {
                            if (false == $this->collBeatOutletss->contains($obj)) {
                                $this->collBeatOutletss->append($obj);
                            }
                        }

                        $this->collBeatOutletssPartial = true;
                    }

                    return $collBeatOutletss;
                }

                if ($partial && $this->collBeatOutletss) {
                    foreach ($this->collBeatOutletss as $obj) {
                        if ($obj->isNew()) {
                            $collBeatOutletss[] = $obj;
                        }
                    }
                }

                $this->collBeatOutletss = $collBeatOutletss;
                $this->collBeatOutletssPartial = false;
            }
        }

        return $this->collBeatOutletss;
    }

    /**
     * Sets a collection of ChildBeatOutlets objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $beatOutletss A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setBeatOutletss(Collection $beatOutletss, ?ConnectionInterface $con = null)
    {
        /** @var ChildBeatOutlets[] $beatOutletssToDelete */
        $beatOutletssToDelete = $this->getBeatOutletss(new Criteria(), $con)->diff($beatOutletss);


        $this->beatOutletssScheduledForDeletion = $beatOutletssToDelete;

        foreach ($beatOutletssToDelete as $beatOutletsRemoved) {
            $beatOutletsRemoved->setBeats(null);
        }

        $this->collBeatOutletss = null;
        foreach ($beatOutletss as $beatOutlets) {
            $this->addBeatOutlets($beatOutlets);
        }

        $this->collBeatOutletss = $beatOutletss;
        $this->collBeatOutletssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BeatOutlets objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BeatOutlets objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countBeatOutletss(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collBeatOutletssPartial && !$this->isNew();
        if (null === $this->collBeatOutletss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBeatOutletss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getBeatOutletss());
            }

            $query = ChildBeatOutletsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByBeats($this)
                ->count($con);
        }

        return count($this->collBeatOutletss);
    }

    /**
     * Method called to associate a ChildBeatOutlets object to this object
     * through the ChildBeatOutlets foreign key attribute.
     *
     * @param ChildBeatOutlets $l ChildBeatOutlets
     * @return $this The current object (for fluent API support)
     */
    public function addBeatOutlets(ChildBeatOutlets $l)
    {
        if ($this->collBeatOutletss === null) {
            $this->initBeatOutletss();
            $this->collBeatOutletssPartial = true;
        }

        if (!$this->collBeatOutletss->contains($l)) {
            $this->doAddBeatOutlets($l);

            if ($this->beatOutletssScheduledForDeletion and $this->beatOutletssScheduledForDeletion->contains($l)) {
                $this->beatOutletssScheduledForDeletion->remove($this->beatOutletssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildBeatOutlets $beatOutlets The ChildBeatOutlets object to add.
     */
    protected function doAddBeatOutlets(ChildBeatOutlets $beatOutlets): void
    {
        $this->collBeatOutletss[]= $beatOutlets;
        $beatOutlets->setBeats($this);
    }

    /**
     * @param ChildBeatOutlets $beatOutlets The ChildBeatOutlets object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeBeatOutlets(ChildBeatOutlets $beatOutlets)
    {
        if ($this->getBeatOutletss()->contains($beatOutlets)) {
            $pos = $this->collBeatOutletss->search($beatOutlets);
            $this->collBeatOutletss->remove($pos);
            if (null === $this->beatOutletssScheduledForDeletion) {
                $this->beatOutletssScheduledForDeletion = clone $this->collBeatOutletss;
                $this->beatOutletssScheduledForDeletion->clear();
            }
            $this->beatOutletssScheduledForDeletion[]= clone $beatOutlets;
            $beatOutlets->setBeats(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Beats is new, it will return
     * an empty collection; or if this Beats has previously
     * been saved, it will retrieve related BeatOutletss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Beats.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBeatOutlets[] List of ChildBeatOutlets objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBeatOutlets}> List of ChildBeatOutlets objects
     */
    public function getBeatOutletssJoinOutletOrgData(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBeatOutletsQuery::create(null, $criteria);
        $query->joinWith('OutletOrgData', $joinBehavior);

        return $this->getBeatOutletss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Beats is new, it will return
     * an empty collection; or if this Beats has previously
     * been saved, it will retrieve related BeatOutletss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Beats.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBeatOutlets[] List of ChildBeatOutlets objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBeatOutlets}> List of ChildBeatOutlets objects
     */
    public function getBeatOutletssJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBeatOutletsQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getBeatOutletss($query, $con);
    }

    /**
     * Clears out the collDayplans collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addDayplans()
     */
    public function clearDayplans()
    {
        $this->collDayplans = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collDayplans collection loaded partially.
     *
     * @return void
     */
    public function resetPartialDayplans($v = true): void
    {
        $this->collDayplansPartial = $v;
    }

    /**
     * Initializes the collDayplans collection.
     *
     * By default this just sets the collDayplans collection to an empty array (like clearcollDayplans());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initDayplans(bool $overrideExisting = true): void
    {
        if (null !== $this->collDayplans && !$overrideExisting) {
            return;
        }

        $collectionClassName = DayplanTableMap::getTableMap()->getCollectionClassName();

        $this->collDayplans = new $collectionClassName;
        $this->collDayplans->setModel('\entities\Dayplan');
    }

    /**
     * Gets an array of ChildDayplan objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildBeats is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildDayplan[] List of ChildDayplan objects
     * @phpstan-return ObjectCollection&\Traversable<ChildDayplan> List of ChildDayplan objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getDayplans(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collDayplansPartial && !$this->isNew();
        if (null === $this->collDayplans || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collDayplans) {
                    $this->initDayplans();
                } else {
                    $collectionClassName = DayplanTableMap::getTableMap()->getCollectionClassName();

                    $collDayplans = new $collectionClassName;
                    $collDayplans->setModel('\entities\Dayplan');

                    return $collDayplans;
                }
            } else {
                $collDayplans = ChildDayplanQuery::create(null, $criteria)
                    ->filterByBeats($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collDayplansPartial && count($collDayplans)) {
                        $this->initDayplans(false);

                        foreach ($collDayplans as $obj) {
                            if (false == $this->collDayplans->contains($obj)) {
                                $this->collDayplans->append($obj);
                            }
                        }

                        $this->collDayplansPartial = true;
                    }

                    return $collDayplans;
                }

                if ($partial && $this->collDayplans) {
                    foreach ($this->collDayplans as $obj) {
                        if ($obj->isNew()) {
                            $collDayplans[] = $obj;
                        }
                    }
                }

                $this->collDayplans = $collDayplans;
                $this->collDayplansPartial = false;
            }
        }

        return $this->collDayplans;
    }

    /**
     * Sets a collection of ChildDayplan objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $dayplans A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setDayplans(Collection $dayplans, ?ConnectionInterface $con = null)
    {
        /** @var ChildDayplan[] $dayplansToDelete */
        $dayplansToDelete = $this->getDayplans(new Criteria(), $con)->diff($dayplans);


        $this->dayplansScheduledForDeletion = $dayplansToDelete;

        foreach ($dayplansToDelete as $dayplanRemoved) {
            $dayplanRemoved->setBeats(null);
        }

        $this->collDayplans = null;
        foreach ($dayplans as $dayplan) {
            $this->addDayplan($dayplan);
        }

        $this->collDayplans = $dayplans;
        $this->collDayplansPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Dayplan objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related Dayplan objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countDayplans(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collDayplansPartial && !$this->isNew();
        if (null === $this->collDayplans || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collDayplans) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getDayplans());
            }

            $query = ChildDayplanQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByBeats($this)
                ->count($con);
        }

        return count($this->collDayplans);
    }

    /**
     * Method called to associate a ChildDayplan object to this object
     * through the ChildDayplan foreign key attribute.
     *
     * @param ChildDayplan $l ChildDayplan
     * @return $this The current object (for fluent API support)
     */
    public function addDayplan(ChildDayplan $l)
    {
        if ($this->collDayplans === null) {
            $this->initDayplans();
            $this->collDayplansPartial = true;
        }

        if (!$this->collDayplans->contains($l)) {
            $this->doAddDayplan($l);

            if ($this->dayplansScheduledForDeletion and $this->dayplansScheduledForDeletion->contains($l)) {
                $this->dayplansScheduledForDeletion->remove($this->dayplansScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildDayplan $dayplan The ChildDayplan object to add.
     */
    protected function doAddDayplan(ChildDayplan $dayplan): void
    {
        $this->collDayplans[]= $dayplan;
        $dayplan->setBeats($this);
    }

    /**
     * @param ChildDayplan $dayplan The ChildDayplan object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeDayplan(ChildDayplan $dayplan)
    {
        if ($this->getDayplans()->contains($dayplan)) {
            $pos = $this->collDayplans->search($dayplan);
            $this->collDayplans->remove($pos);
            if (null === $this->dayplansScheduledForDeletion) {
                $this->dayplansScheduledForDeletion = clone $this->collDayplans;
                $this->dayplansScheduledForDeletion->clear();
            }
            $this->dayplansScheduledForDeletion[]= $dayplan;
            $dayplan->setBeats(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Beats is new, it will return
     * an empty collection; or if this Beats has previously
     * been saved, it will retrieve related Dayplans from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Beats.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildDayplan[] List of ChildDayplan objects
     * @phpstan-return ObjectCollection&\Traversable<ChildDayplan}> List of ChildDayplan objects
     */
    public function getDayplansJoinOutletOrgData(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildDayplanQuery::create(null, $criteria);
        $query->joinWith('OutletOrgData', $joinBehavior);

        return $this->getDayplans($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Beats is new, it will return
     * an empty collection; or if this Beats has previously
     * been saved, it will retrieve related Dayplans from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Beats.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildDayplan[] List of ChildDayplan objects
     * @phpstan-return ObjectCollection&\Traversable<ChildDayplan}> List of ChildDayplan objects
     */
    public function getDayplansJoinAgendatypes(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildDayplanQuery::create(null, $criteria);
        $query->joinWith('Agendatypes', $joinBehavior);

        return $this->getDayplans($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Beats is new, it will return
     * an empty collection; or if this Beats has previously
     * been saved, it will retrieve related Dayplans from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Beats.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildDayplan[] List of ChildDayplan objects
     * @phpstan-return ObjectCollection&\Traversable<ChildDayplan}> List of ChildDayplan objects
     */
    public function getDayplansJoinGeoTowns(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildDayplanQuery::create(null, $criteria);
        $query->joinWith('GeoTowns', $joinBehavior);

        return $this->getDayplans($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Beats is new, it will return
     * an empty collection; or if this Beats has previously
     * been saved, it will retrieve related Dayplans from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Beats.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildDayplan[] List of ChildDayplan objects
     * @phpstan-return ObjectCollection&\Traversable<ChildDayplan}> List of ChildDayplan objects
     */
    public function getDayplansJoinBrandCampiagnVisitPlan(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildDayplanQuery::create(null, $criteria);
        $query->joinWith('BrandCampiagnVisitPlan', $joinBehavior);

        return $this->getDayplans($query, $con);
    }

    /**
     * Clears out the collOnBoardRequestAddresses collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addOnBoardRequestAddresses()
     */
    public function clearOnBoardRequestAddresses()
    {
        $this->collOnBoardRequestAddresses = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collOnBoardRequestAddresses collection loaded partially.
     *
     * @return void
     */
    public function resetPartialOnBoardRequestAddresses($v = true): void
    {
        $this->collOnBoardRequestAddressesPartial = $v;
    }

    /**
     * Initializes the collOnBoardRequestAddresses collection.
     *
     * By default this just sets the collOnBoardRequestAddresses collection to an empty array (like clearcollOnBoardRequestAddresses());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initOnBoardRequestAddresses(bool $overrideExisting = true): void
    {
        if (null !== $this->collOnBoardRequestAddresses && !$overrideExisting) {
            return;
        }

        $collectionClassName = OnBoardRequestAddressTableMap::getTableMap()->getCollectionClassName();

        $this->collOnBoardRequestAddresses = new $collectionClassName;
        $this->collOnBoardRequestAddresses->setModel('\entities\OnBoardRequestAddress');
    }

    /**
     * Gets an array of ChildOnBoardRequestAddress objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildBeats is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildOnBoardRequestAddress[] List of ChildOnBoardRequestAddress objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequestAddress> List of ChildOnBoardRequestAddress objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOnBoardRequestAddresses(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collOnBoardRequestAddressesPartial && !$this->isNew();
        if (null === $this->collOnBoardRequestAddresses || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collOnBoardRequestAddresses) {
                    $this->initOnBoardRequestAddresses();
                } else {
                    $collectionClassName = OnBoardRequestAddressTableMap::getTableMap()->getCollectionClassName();

                    $collOnBoardRequestAddresses = new $collectionClassName;
                    $collOnBoardRequestAddresses->setModel('\entities\OnBoardRequestAddress');

                    return $collOnBoardRequestAddresses;
                }
            } else {
                $collOnBoardRequestAddresses = ChildOnBoardRequestAddressQuery::create(null, $criteria)
                    ->filterByBeats($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collOnBoardRequestAddressesPartial && count($collOnBoardRequestAddresses)) {
                        $this->initOnBoardRequestAddresses(false);

                        foreach ($collOnBoardRequestAddresses as $obj) {
                            if (false == $this->collOnBoardRequestAddresses->contains($obj)) {
                                $this->collOnBoardRequestAddresses->append($obj);
                            }
                        }

                        $this->collOnBoardRequestAddressesPartial = true;
                    }

                    return $collOnBoardRequestAddresses;
                }

                if ($partial && $this->collOnBoardRequestAddresses) {
                    foreach ($this->collOnBoardRequestAddresses as $obj) {
                        if ($obj->isNew()) {
                            $collOnBoardRequestAddresses[] = $obj;
                        }
                    }
                }

                $this->collOnBoardRequestAddresses = $collOnBoardRequestAddresses;
                $this->collOnBoardRequestAddressesPartial = false;
            }
        }

        return $this->collOnBoardRequestAddresses;
    }

    /**
     * Sets a collection of ChildOnBoardRequestAddress objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $onBoardRequestAddresses A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setOnBoardRequestAddresses(Collection $onBoardRequestAddresses, ?ConnectionInterface $con = null)
    {
        /** @var ChildOnBoardRequestAddress[] $onBoardRequestAddressesToDelete */
        $onBoardRequestAddressesToDelete = $this->getOnBoardRequestAddresses(new Criteria(), $con)->diff($onBoardRequestAddresses);


        $this->onBoardRequestAddressesScheduledForDeletion = $onBoardRequestAddressesToDelete;

        foreach ($onBoardRequestAddressesToDelete as $onBoardRequestAddressRemoved) {
            $onBoardRequestAddressRemoved->setBeats(null);
        }

        $this->collOnBoardRequestAddresses = null;
        foreach ($onBoardRequestAddresses as $onBoardRequestAddress) {
            $this->addOnBoardRequestAddress($onBoardRequestAddress);
        }

        $this->collOnBoardRequestAddresses = $onBoardRequestAddresses;
        $this->collOnBoardRequestAddressesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related OnBoardRequestAddress objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related OnBoardRequestAddress objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countOnBoardRequestAddresses(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collOnBoardRequestAddressesPartial && !$this->isNew();
        if (null === $this->collOnBoardRequestAddresses || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collOnBoardRequestAddresses) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getOnBoardRequestAddresses());
            }

            $query = ChildOnBoardRequestAddressQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByBeats($this)
                ->count($con);
        }

        return count($this->collOnBoardRequestAddresses);
    }

    /**
     * Method called to associate a ChildOnBoardRequestAddress object to this object
     * through the ChildOnBoardRequestAddress foreign key attribute.
     *
     * @param ChildOnBoardRequestAddress $l ChildOnBoardRequestAddress
     * @return $this The current object (for fluent API support)
     */
    public function addOnBoardRequestAddress(ChildOnBoardRequestAddress $l)
    {
        if ($this->collOnBoardRequestAddresses === null) {
            $this->initOnBoardRequestAddresses();
            $this->collOnBoardRequestAddressesPartial = true;
        }

        if (!$this->collOnBoardRequestAddresses->contains($l)) {
            $this->doAddOnBoardRequestAddress($l);

            if ($this->onBoardRequestAddressesScheduledForDeletion and $this->onBoardRequestAddressesScheduledForDeletion->contains($l)) {
                $this->onBoardRequestAddressesScheduledForDeletion->remove($this->onBoardRequestAddressesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildOnBoardRequestAddress $onBoardRequestAddress The ChildOnBoardRequestAddress object to add.
     */
    protected function doAddOnBoardRequestAddress(ChildOnBoardRequestAddress $onBoardRequestAddress): void
    {
        $this->collOnBoardRequestAddresses[]= $onBoardRequestAddress;
        $onBoardRequestAddress->setBeats($this);
    }

    /**
     * @param ChildOnBoardRequestAddress $onBoardRequestAddress The ChildOnBoardRequestAddress object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeOnBoardRequestAddress(ChildOnBoardRequestAddress $onBoardRequestAddress)
    {
        if ($this->getOnBoardRequestAddresses()->contains($onBoardRequestAddress)) {
            $pos = $this->collOnBoardRequestAddresses->search($onBoardRequestAddress);
            $this->collOnBoardRequestAddresses->remove($pos);
            if (null === $this->onBoardRequestAddressesScheduledForDeletion) {
                $this->onBoardRequestAddressesScheduledForDeletion = clone $this->collOnBoardRequestAddresses;
                $this->onBoardRequestAddressesScheduledForDeletion->clear();
            }
            $this->onBoardRequestAddressesScheduledForDeletion[]= $onBoardRequestAddress;
            $onBoardRequestAddress->setBeats(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Beats is new, it will return
     * an empty collection; or if this Beats has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Beats.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequestAddress[] List of ChildOnBoardRequestAddress objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequestAddress}> List of ChildOnBoardRequestAddress objects
     */
    public function getOnBoardRequestAddressesJoinOutletAddress(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestAddressQuery::create(null, $criteria);
        $query->joinWith('OutletAddress', $joinBehavior);

        return $this->getOnBoardRequestAddresses($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Beats is new, it will return
     * an empty collection; or if this Beats has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Beats.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequestAddress[] List of ChildOnBoardRequestAddress objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequestAddress}> List of ChildOnBoardRequestAddress objects
     */
    public function getOnBoardRequestAddressesJoinBrands(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestAddressQuery::create(null, $criteria);
        $query->joinWith('Brands', $joinBehavior);

        return $this->getOnBoardRequestAddresses($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Beats is new, it will return
     * an empty collection; or if this Beats has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Beats.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequestAddress[] List of ChildOnBoardRequestAddress objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequestAddress}> List of ChildOnBoardRequestAddress objects
     */
    public function getOnBoardRequestAddressesJoinClassification(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestAddressQuery::create(null, $criteria);
        $query->joinWith('Classification', $joinBehavior);

        return $this->getOnBoardRequestAddresses($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Beats is new, it will return
     * an empty collection; or if this Beats has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Beats.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequestAddress[] List of ChildOnBoardRequestAddress objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequestAddress}> List of ChildOnBoardRequestAddress objects
     */
    public function getOnBoardRequestAddressesJoinOutletTags(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestAddressQuery::create(null, $criteria);
        $query->joinWith('OutletTags', $joinBehavior);

        return $this->getOnBoardRequestAddresses($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Beats is new, it will return
     * an empty collection; or if this Beats has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Beats.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequestAddress[] List of ChildOnBoardRequestAddress objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequestAddress}> List of ChildOnBoardRequestAddress objects
     */
    public function getOnBoardRequestAddressesJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestAddressQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getOnBoardRequestAddresses($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Beats is new, it will return
     * an empty collection; or if this Beats has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Beats.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequestAddress[] List of ChildOnBoardRequestAddress objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequestAddress}> List of ChildOnBoardRequestAddress objects
     */
    public function getOnBoardRequestAddressesJoinGeoCity(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestAddressQuery::create(null, $criteria);
        $query->joinWith('GeoCity', $joinBehavior);

        return $this->getOnBoardRequestAddresses($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Beats is new, it will return
     * an empty collection; or if this Beats has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Beats.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequestAddress[] List of ChildOnBoardRequestAddress objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequestAddress}> List of ChildOnBoardRequestAddress objects
     */
    public function getOnBoardRequestAddressesJoinGeoState(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestAddressQuery::create(null, $criteria);
        $query->joinWith('GeoState', $joinBehavior);

        return $this->getOnBoardRequestAddresses($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Beats is new, it will return
     * an empty collection; or if this Beats has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Beats.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequestAddress[] List of ChildOnBoardRequestAddress objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequestAddress}> List of ChildOnBoardRequestAddress objects
     */
    public function getOnBoardRequestAddressesJoinGeoTowns(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestAddressQuery::create(null, $criteria);
        $query->joinWith('GeoTowns', $joinBehavior);

        return $this->getOnBoardRequestAddresses($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Beats is new, it will return
     * an empty collection; or if this Beats has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Beats.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequestAddress[] List of ChildOnBoardRequestAddress objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequestAddress}> List of ChildOnBoardRequestAddress objects
     */
    public function getOnBoardRequestAddressesJoinOnBoardRequest(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestAddressQuery::create(null, $criteria);
        $query->joinWith('OnBoardRequest', $joinBehavior);

        return $this->getOnBoardRequestAddresses($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Beats is new, it will return
     * an empty collection; or if this Beats has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Beats.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequestAddress[] List of ChildOnBoardRequestAddress objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequestAddress}> List of ChildOnBoardRequestAddress objects
     */
    public function getOnBoardRequestAddressesJoinOrgUnit(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestAddressQuery::create(null, $criteria);
        $query->joinWith('OrgUnit', $joinBehavior);

        return $this->getOnBoardRequestAddresses($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Beats is new, it will return
     * an empty collection; or if this Beats has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Beats.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequestAddress[] List of ChildOnBoardRequestAddress objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequestAddress}> List of ChildOnBoardRequestAddress objects
     */
    public function getOnBoardRequestAddressesJoinOutletOrgData(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestAddressQuery::create(null, $criteria);
        $query->joinWith('OutletOrgData', $joinBehavior);

        return $this->getOnBoardRequestAddresses($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Beats is new, it will return
     * an empty collection; or if this Beats has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Beats.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequestAddress[] List of ChildOnBoardRequestAddress objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequestAddress}> List of ChildOnBoardRequestAddress objects
     */
    public function getOnBoardRequestAddressesJoinOutletType(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestAddressQuery::create(null, $criteria);
        $query->joinWith('OutletType', $joinBehavior);

        return $this->getOnBoardRequestAddresses($query, $con);
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
     * If this ChildBeats is new, it will return
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
                    ->filterByBeats($this)
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
            $ordersRemoved->setBeats(null);
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
                ->filterByBeats($this)
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
        $orders->setBeats($this);
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
            $orders->setBeats(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Beats is new, it will return
     * an empty collection; or if this Beats has previously
     * been saved, it will retrieve related Orderss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Beats.
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
     * Otherwise if this Beats is new, it will return
     * an empty collection; or if this Beats has previously
     * been saved, it will retrieve related Orderss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Beats.
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
     * Otherwise if this Beats is new, it will return
     * an empty collection; or if this Beats has previously
     * been saved, it will retrieve related Orderss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Beats.
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
     * Otherwise if this Beats is new, it will return
     * an empty collection; or if this Beats has previously
     * been saved, it will retrieve related Orderss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Beats.
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
     * Otherwise if this Beats is new, it will return
     * an empty collection; or if this Beats has previously
     * been saved, it will retrieve related Orderss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Beats.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOrders[] List of ChildOrders objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrders}> List of ChildOrders objects
     */
    public function getOrderssJoinTerritories(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOrdersQuery::create(null, $criteria);
        $query->joinWith('Territories', $joinBehavior);

        return $this->getOrderss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Beats is new, it will return
     * an empty collection; or if this Beats has previously
     * been saved, it will retrieve related Orderss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Beats.
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
     * Clears out the collTourplanss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addTourplanss()
     */
    public function clearTourplanss()
    {
        $this->collTourplanss = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collTourplanss collection loaded partially.
     *
     * @return void
     */
    public function resetPartialTourplanss($v = true): void
    {
        $this->collTourplanssPartial = $v;
    }

    /**
     * Initializes the collTourplanss collection.
     *
     * By default this just sets the collTourplanss collection to an empty array (like clearcollTourplanss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTourplanss(bool $overrideExisting = true): void
    {
        if (null !== $this->collTourplanss && !$overrideExisting) {
            return;
        }

        $collectionClassName = TourplansTableMap::getTableMap()->getCollectionClassName();

        $this->collTourplanss = new $collectionClassName;
        $this->collTourplanss->setModel('\entities\Tourplans');
    }

    /**
     * Gets an array of ChildTourplans objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildBeats is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildTourplans[] List of ChildTourplans objects
     * @phpstan-return ObjectCollection&\Traversable<ChildTourplans> List of ChildTourplans objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getTourplanss(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collTourplanssPartial && !$this->isNew();
        if (null === $this->collTourplanss || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collTourplanss) {
                    $this->initTourplanss();
                } else {
                    $collectionClassName = TourplansTableMap::getTableMap()->getCollectionClassName();

                    $collTourplanss = new $collectionClassName;
                    $collTourplanss->setModel('\entities\Tourplans');

                    return $collTourplanss;
                }
            } else {
                $collTourplanss = ChildTourplansQuery::create(null, $criteria)
                    ->filterByBeats($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collTourplanssPartial && count($collTourplanss)) {
                        $this->initTourplanss(false);

                        foreach ($collTourplanss as $obj) {
                            if (false == $this->collTourplanss->contains($obj)) {
                                $this->collTourplanss->append($obj);
                            }
                        }

                        $this->collTourplanssPartial = true;
                    }

                    return $collTourplanss;
                }

                if ($partial && $this->collTourplanss) {
                    foreach ($this->collTourplanss as $obj) {
                        if ($obj->isNew()) {
                            $collTourplanss[] = $obj;
                        }
                    }
                }

                $this->collTourplanss = $collTourplanss;
                $this->collTourplanssPartial = false;
            }
        }

        return $this->collTourplanss;
    }

    /**
     * Sets a collection of ChildTourplans objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $tourplanss A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setTourplanss(Collection $tourplanss, ?ConnectionInterface $con = null)
    {
        /** @var ChildTourplans[] $tourplanssToDelete */
        $tourplanssToDelete = $this->getTourplanss(new Criteria(), $con)->diff($tourplanss);


        $this->tourplanssScheduledForDeletion = $tourplanssToDelete;

        foreach ($tourplanssToDelete as $tourplansRemoved) {
            $tourplansRemoved->setBeats(null);
        }

        $this->collTourplanss = null;
        foreach ($tourplanss as $tourplans) {
            $this->addTourplans($tourplans);
        }

        $this->collTourplanss = $tourplanss;
        $this->collTourplanssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Tourplans objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related Tourplans objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countTourplanss(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collTourplanssPartial && !$this->isNew();
        if (null === $this->collTourplanss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTourplanss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getTourplanss());
            }

            $query = ChildTourplansQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByBeats($this)
                ->count($con);
        }

        return count($this->collTourplanss);
    }

    /**
     * Method called to associate a ChildTourplans object to this object
     * through the ChildTourplans foreign key attribute.
     *
     * @param ChildTourplans $l ChildTourplans
     * @return $this The current object (for fluent API support)
     */
    public function addTourplans(ChildTourplans $l)
    {
        if ($this->collTourplanss === null) {
            $this->initTourplanss();
            $this->collTourplanssPartial = true;
        }

        if (!$this->collTourplanss->contains($l)) {
            $this->doAddTourplans($l);

            if ($this->tourplanssScheduledForDeletion and $this->tourplanssScheduledForDeletion->contains($l)) {
                $this->tourplanssScheduledForDeletion->remove($this->tourplanssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildTourplans $tourplans The ChildTourplans object to add.
     */
    protected function doAddTourplans(ChildTourplans $tourplans): void
    {
        $this->collTourplanss[]= $tourplans;
        $tourplans->setBeats($this);
    }

    /**
     * @param ChildTourplans $tourplans The ChildTourplans object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeTourplans(ChildTourplans $tourplans)
    {
        if ($this->getTourplanss()->contains($tourplans)) {
            $pos = $this->collTourplanss->search($tourplans);
            $this->collTourplanss->remove($pos);
            if (null === $this->tourplanssScheduledForDeletion) {
                $this->tourplanssScheduledForDeletion = clone $this->collTourplanss;
                $this->tourplanssScheduledForDeletion->clear();
            }
            $this->tourplanssScheduledForDeletion[]= $tourplans;
            $tourplans->setBeats(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Beats is new, it will return
     * an empty collection; or if this Beats has previously
     * been saved, it will retrieve related Tourplanss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Beats.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildTourplans[] List of ChildTourplans objects
     * @phpstan-return ObjectCollection&\Traversable<ChildTourplans}> List of ChildTourplans objects
     */
    public function getTourplanssJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildTourplansQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getTourplanss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Beats is new, it will return
     * an empty collection; or if this Beats has previously
     * been saved, it will retrieve related Tourplanss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Beats.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildTourplans[] List of ChildTourplans objects
     * @phpstan-return ObjectCollection&\Traversable<ChildTourplans}> List of ChildTourplans objects
     */
    public function getTourplanssJoinAgendatypes(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildTourplansQuery::create(null, $criteria);
        $query->joinWith('Agendatypes', $joinBehavior);

        return $this->getTourplanss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Beats is new, it will return
     * an empty collection; or if this Beats has previously
     * been saved, it will retrieve related Tourplanss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Beats.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildTourplans[] List of ChildTourplans objects
     * @phpstan-return ObjectCollection&\Traversable<ChildTourplans}> List of ChildTourplans objects
     */
    public function getTourplanssJoinMtpDay(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildTourplansQuery::create(null, $criteria);
        $query->joinWith('MtpDay', $joinBehavior);

        return $this->getTourplanss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Beats is new, it will return
     * an empty collection; or if this Beats has previously
     * been saved, it will retrieve related Tourplanss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Beats.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildTourplans[] List of ChildTourplans objects
     * @phpstan-return ObjectCollection&\Traversable<ChildTourplans}> List of ChildTourplans objects
     */
    public function getTourplanssJoinGeoTowns(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildTourplansQuery::create(null, $criteria);
        $query->joinWith('GeoTowns', $joinBehavior);

        return $this->getTourplanss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Beats is new, it will return
     * an empty collection; or if this Beats has previously
     * been saved, it will retrieve related Tourplanss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Beats.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildTourplans[] List of ChildTourplans objects
     * @phpstan-return ObjectCollection&\Traversable<ChildTourplans}> List of ChildTourplans objects
     */
    public function getTourplanssJoinMtp(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildTourplansQuery::create(null, $criteria);
        $query->joinWith('Mtp', $joinBehavior);

        return $this->getTourplanss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Beats is new, it will return
     * an empty collection; or if this Beats has previously
     * been saved, it will retrieve related Tourplanss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Beats.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildTourplans[] List of ChildTourplans objects
     * @phpstan-return ObjectCollection&\Traversable<ChildTourplans}> List of ChildTourplans objects
     */
    public function getTourplanssJoinOutletOrgData(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildTourplansQuery::create(null, $criteria);
        $query->joinWith('OutletOrgData', $joinBehavior);

        return $this->getTourplanss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Beats is new, it will return
     * an empty collection; or if this Beats has previously
     * been saved, it will retrieve related Tourplanss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Beats.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildTourplans[] List of ChildTourplans objects
     * @phpstan-return ObjectCollection&\Traversable<ChildTourplans}> List of ChildTourplans objects
     */
    public function getTourplanssJoinPositions(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildTourplansQuery::create(null, $criteria);
        $query->joinWith('Positions', $joinBehavior);

        return $this->getTourplanss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Beats is new, it will return
     * an empty collection; or if this Beats has previously
     * been saved, it will retrieve related Tourplanss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Beats.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildTourplans[] List of ChildTourplans objects
     * @phpstan-return ObjectCollection&\Traversable<ChildTourplans}> List of ChildTourplans objects
     */
    public function getTourplanssJoinBrandCampiagnVisitPlan(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildTourplansQuery::create(null, $criteria);
        $query->joinWith('BrandCampiagnVisitPlan', $joinBehavior);

        return $this->getTourplanss($query, $con);
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
     * If this ChildBeats is new, it will return
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
                    ->filterByBeats($this)
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
            $stpWeekRemoved->setBeats(null);
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
                ->filterByBeats($this)
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
        $stpWeek->setBeats($this);
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
            $stpWeek->setBeats(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Beats is new, it will return
     * an empty collection; or if this Beats has previously
     * been saved, it will retrieve related StpWeeks from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Beats.
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
     * Otherwise if this Beats is new, it will return
     * an empty collection; or if this Beats has previously
     * been saved, it will retrieve related StpWeeks from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Beats.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildStpWeek[] List of ChildStpWeek objects
     * @phpstan-return ObjectCollection&\Traversable<ChildStpWeek}> List of ChildStpWeek objects
     */
    public function getStpWeeksJoinTerritories(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildStpWeekQuery::create(null, $criteria);
        $query->joinWith('Territories', $joinBehavior);

        return $this->getStpWeeks($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Beats is new, it will return
     * an empty collection; or if this Beats has previously
     * been saved, it will retrieve related StpWeeks from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Beats.
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
        if (null !== $this->aOrgUnit) {
            $this->aOrgUnit->removeBeats($this);
        }
        if (null !== $this->aGeoTowns) {
            $this->aGeoTowns->removeBeats($this);
        }
        if (null !== $this->aCompany) {
            $this->aCompany->removeBeats($this);
        }
        if (null !== $this->aTerritories) {
            $this->aTerritories->removeBeats($this);
        }
        $this->beat_id = null;
        $this->beat_name = null;
        $this->beat_remark = null;
        $this->beat_code = null;
        $this->territory_id = null;
        $this->company_id = null;
        $this->itownid = null;
        $this->created_at = null;
        $this->updated_at = null;
        $this->org_unit_id = null;
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
            if ($this->collBeatOutletss) {
                foreach ($this->collBeatOutletss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collDayplans) {
                foreach ($this->collDayplans as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collOnBoardRequestAddresses) {
                foreach ($this->collOnBoardRequestAddresses as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collOrderss) {
                foreach ($this->collOrderss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTourplanss) {
                foreach ($this->collTourplanss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collStpWeeks) {
                foreach ($this->collStpWeeks as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collBeatOutletss = null;
        $this->collDayplans = null;
        $this->collOnBoardRequestAddresses = null;
        $this->collOrderss = null;
        $this->collTourplanss = null;
        $this->collStpWeeks = null;
        $this->aOrgUnit = null;
        $this->aGeoTowns = null;
        $this->aCompany = null;
        $this->aTerritories = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(BeatsTableMap::DEFAULT_STRING_FORMAT);
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
