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
use entities\OrgUnit as ChildOrgUnit;
use entities\OrgUnitQuery as ChildOrgUnitQuery;
use entities\Positions as ChildPositions;
use entities\PositionsQuery as ChildPositionsQuery;
use entities\PrescriberTallySummaryQuery as ChildPrescriberTallySummaryQuery;
use entities\Territories as ChildTerritories;
use entities\TerritoriesQuery as ChildTerritoriesQuery;
use entities\Map\PrescriberTallySummaryTableMap;

/**
 * Base class that represents a row from the 'prescriber_tally_summary' table.
 *
 *
 *
 * @package    propel.generator.entities.Base
 */
abstract class PrescriberTallySummary implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\entities\\Map\\PrescriberTallySummaryTableMap';


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
     * The value for the prescriber_tally_summary_id field.
     *
     * @var        int
     */
    protected $prescriber_tally_summary_id;

    /**
     * The value for the orgunit_id field.
     *
     * @var        int
     */
    protected $orgunit_id;

    /**
     * The value for the position_id field.
     *
     * @var        int
     */
    protected $position_id;

    /**
     * The value for the territory_id field.
     *
     * @var        int
     */
    protected $territory_id;

    /**
     * The value for the brand_id field.
     *
     * @var        int
     */
    protected $brand_id;

    /**
     * The value for the moye field.
     *
     * @var        string
     */
    protected $moye;

    /**
     * The value for the tagged_drs field.
     *
     * @var        int|null
     */
    protected $tagged_drs;

    /**
     * The value for the lm_rxbers field.
     *
     * @var        int|null
     */
    protected $lm_rxbers;

    /**
     * The value for the cm_rxbers field.
     *
     * @var        int|null
     */
    protected $cm_rxbers;

    /**
     * The value for the gain field.
     *
     * @var        int|null
     */
    protected $gain;

    /**
     * The value for the loss field.
     *
     * @var        int|null
     */
    protected $loss;

    /**
     * The value for the two_month_rxber field.
     *
     * @var        int|null
     */
    protected $two_month_rxber;

    /**
     * The value for the nonrxber field.
     *
     * @var        int|null
     */
    protected $nonrxber;

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
     * Note: this column has a database default value of: (expression) CURRENT_TIMESTAMP
     * @var        DateTime|null
     */
    protected $updated_at;

    /**
     * The value for the cm_rcpa field.
     *
     * @var        string|null
     */
    protected $cm_rcpa;

    /**
     * The value for the cm_visit field.
     *
     * @var        string|null
     */
    protected $cm_visit;

    /**
     * @var        ChildOrgUnit
     */
    protected $aOrgUnit;

    /**
     * @var        ChildPositions
     */
    protected $aPositions;

    /**
     * @var        ChildTerritories
     */
    protected $aTerritories;

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
     * Initializes internal state of entities\Base\PrescriberTallySummary object.
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
     * Compares this with another <code>PrescriberTallySummary</code> instance.  If
     * <code>obj</code> is an instance of <code>PrescriberTallySummary</code>, delegates to
     * <code>equals(PrescriberTallySummary)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [prescriber_tally_summary_id] column value.
     *
     * @return int
     */
    public function getPrescriberTallySummaryId()
    {
        return $this->prescriber_tally_summary_id;
    }

    /**
     * Get the [orgunit_id] column value.
     *
     * @return int
     */
    public function getOrgunitId()
    {
        return $this->orgunit_id;
    }

    /**
     * Get the [position_id] column value.
     *
     * @return int
     */
    public function getPositionId()
    {
        return $this->position_id;
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
     * Get the [brand_id] column value.
     *
     * @return int
     */
    public function getBrandId()
    {
        return $this->brand_id;
    }

    /**
     * Get the [moye] column value.
     *
     * @return string
     */
    public function getMoye()
    {
        return $this->moye;
    }

    /**
     * Get the [tagged_drs] column value.
     *
     * @return int|null
     */
    public function getTaggedDrs()
    {
        return $this->tagged_drs;
    }

    /**
     * Get the [lm_rxbers] column value.
     *
     * @return int|null
     */
    public function getLmRxbers()
    {
        return $this->lm_rxbers;
    }

    /**
     * Get the [cm_rxbers] column value.
     *
     * @return int|null
     */
    public function getCmRxbers()
    {
        return $this->cm_rxbers;
    }

    /**
     * Get the [gain] column value.
     *
     * @return int|null
     */
    public function getGain()
    {
        return $this->gain;
    }

    /**
     * Get the [loss] column value.
     *
     * @return int|null
     */
    public function getLoss()
    {
        return $this->loss;
    }

    /**
     * Get the [two_month_rxber] column value.
     *
     * @return int|null
     */
    public function getTwoMonthRxber()
    {
        return $this->two_month_rxber;
    }

    /**
     * Get the [nonrxber] column value.
     *
     * @return int|null
     */
    public function getNonrxber()
    {
        return $this->nonrxber;
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
     * Get the [cm_rcpa] column value.
     *
     * @return string|null
     */
    public function getCmRcpa()
    {
        return $this->cm_rcpa;
    }

    /**
     * Get the [cm_visit] column value.
     *
     * @return string|null
     */
    public function getCmVisit()
    {
        return $this->cm_visit;
    }

    /**
     * Set the value of [prescriber_tally_summary_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPrescriberTallySummaryId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->prescriber_tally_summary_id !== $v) {
            $this->prescriber_tally_summary_id = $v;
            $this->modifiedColumns[PrescriberTallySummaryTableMap::COL_PRESCRIBER_TALLY_SUMMARY_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [orgunit_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOrgunitId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->orgunit_id !== $v) {
            $this->orgunit_id = $v;
            $this->modifiedColumns[PrescriberTallySummaryTableMap::COL_ORGUNIT_ID] = true;
        }

        if ($this->aOrgUnit !== null && $this->aOrgUnit->getOrgunitid() !== $v) {
            $this->aOrgUnit = null;
        }

        return $this;
    }

    /**
     * Set the value of [position_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPositionId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->position_id !== $v) {
            $this->position_id = $v;
            $this->modifiedColumns[PrescriberTallySummaryTableMap::COL_POSITION_ID] = true;
        }

        if ($this->aPositions !== null && $this->aPositions->getPositionId() !== $v) {
            $this->aPositions = null;
        }

        return $this;
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
            $this->modifiedColumns[PrescriberTallySummaryTableMap::COL_TERRITORY_ID] = true;
        }

        if ($this->aTerritories !== null && $this->aTerritories->getTerritoryId() !== $v) {
            $this->aTerritories = null;
        }

        return $this;
    }

    /**
     * Set the value of [brand_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setBrandId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->brand_id !== $v) {
            $this->brand_id = $v;
            $this->modifiedColumns[PrescriberTallySummaryTableMap::COL_BRAND_ID] = true;
        }

        if ($this->aBrands !== null && $this->aBrands->getBrandId() !== $v) {
            $this->aBrands = null;
        }

        return $this;
    }

    /**
     * Set the value of [moye] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setMoye($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->moye !== $v) {
            $this->moye = $v;
            $this->modifiedColumns[PrescriberTallySummaryTableMap::COL_MOYE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [tagged_drs] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setTaggedDrs($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->tagged_drs !== $v) {
            $this->tagged_drs = $v;
            $this->modifiedColumns[PrescriberTallySummaryTableMap::COL_TAGGED_DRS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [lm_rxbers] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setLmRxbers($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->lm_rxbers !== $v) {
            $this->lm_rxbers = $v;
            $this->modifiedColumns[PrescriberTallySummaryTableMap::COL_LM_RXBERS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [cm_rxbers] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCmRxbers($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->cm_rxbers !== $v) {
            $this->cm_rxbers = $v;
            $this->modifiedColumns[PrescriberTallySummaryTableMap::COL_CM_RXBERS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [gain] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setGain($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->gain !== $v) {
            $this->gain = $v;
            $this->modifiedColumns[PrescriberTallySummaryTableMap::COL_GAIN] = true;
        }

        return $this;
    }

    /**
     * Set the value of [loss] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setLoss($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->loss !== $v) {
            $this->loss = $v;
            $this->modifiedColumns[PrescriberTallySummaryTableMap::COL_LOSS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [two_month_rxber] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setTwoMonthRxber($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->two_month_rxber !== $v) {
            $this->two_month_rxber = $v;
            $this->modifiedColumns[PrescriberTallySummaryTableMap::COL_TWO_MONTH_RXBER] = true;
        }

        return $this;
    }

    /**
     * Set the value of [nonrxber] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setNonrxber($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->nonrxber !== $v) {
            $this->nonrxber = $v;
            $this->modifiedColumns[PrescriberTallySummaryTableMap::COL_NONRXBER] = true;
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
                $this->modifiedColumns[PrescriberTallySummaryTableMap::COL_CREATED_AT] = true;
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
                $this->modifiedColumns[PrescriberTallySummaryTableMap::COL_UPDATED_AT] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [cm_rcpa] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCmRcpa($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->cm_rcpa !== $v) {
            $this->cm_rcpa = $v;
            $this->modifiedColumns[PrescriberTallySummaryTableMap::COL_CM_RCPA] = true;
        }

        return $this;
    }

    /**
     * Set the value of [cm_visit] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCmVisit($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->cm_visit !== $v) {
            $this->cm_visit = $v;
            $this->modifiedColumns[PrescriberTallySummaryTableMap::COL_CM_VISIT] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : PrescriberTallySummaryTableMap::translateFieldName('PrescriberTallySummaryId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->prescriber_tally_summary_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : PrescriberTallySummaryTableMap::translateFieldName('OrgunitId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->orgunit_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : PrescriberTallySummaryTableMap::translateFieldName('PositionId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->position_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : PrescriberTallySummaryTableMap::translateFieldName('TerritoryId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->territory_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : PrescriberTallySummaryTableMap::translateFieldName('BrandId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->brand_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : PrescriberTallySummaryTableMap::translateFieldName('Moye', TableMap::TYPE_PHPNAME, $indexType)];
            $this->moye = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : PrescriberTallySummaryTableMap::translateFieldName('TaggedDrs', TableMap::TYPE_PHPNAME, $indexType)];
            $this->tagged_drs = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : PrescriberTallySummaryTableMap::translateFieldName('LmRxbers', TableMap::TYPE_PHPNAME, $indexType)];
            $this->lm_rxbers = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : PrescriberTallySummaryTableMap::translateFieldName('CmRxbers', TableMap::TYPE_PHPNAME, $indexType)];
            $this->cm_rxbers = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : PrescriberTallySummaryTableMap::translateFieldName('Gain', TableMap::TYPE_PHPNAME, $indexType)];
            $this->gain = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : PrescriberTallySummaryTableMap::translateFieldName('Loss', TableMap::TYPE_PHPNAME, $indexType)];
            $this->loss = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : PrescriberTallySummaryTableMap::translateFieldName('TwoMonthRxber', TableMap::TYPE_PHPNAME, $indexType)];
            $this->two_month_rxber = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : PrescriberTallySummaryTableMap::translateFieldName('Nonrxber', TableMap::TYPE_PHPNAME, $indexType)];
            $this->nonrxber = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : PrescriberTallySummaryTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : PrescriberTallySummaryTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : PrescriberTallySummaryTableMap::translateFieldName('CmRcpa', TableMap::TYPE_PHPNAME, $indexType)];
            $this->cm_rcpa = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : PrescriberTallySummaryTableMap::translateFieldName('CmVisit', TableMap::TYPE_PHPNAME, $indexType)];
            $this->cm_visit = (null !== $col) ? (string) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 17; // 17 = PrescriberTallySummaryTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\entities\\PrescriberTallySummary'), 0, $e);
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
        if ($this->aOrgUnit !== null && $this->orgunit_id !== $this->aOrgUnit->getOrgunitid()) {
            $this->aOrgUnit = null;
        }
        if ($this->aPositions !== null && $this->position_id !== $this->aPositions->getPositionId()) {
            $this->aPositions = null;
        }
        if ($this->aTerritories !== null && $this->territory_id !== $this->aTerritories->getTerritoryId()) {
            $this->aTerritories = null;
        }
        if ($this->aBrands !== null && $this->brand_id !== $this->aBrands->getBrandId()) {
            $this->aBrands = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(PrescriberTallySummaryTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildPrescriberTallySummaryQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aOrgUnit = null;
            $this->aPositions = null;
            $this->aTerritories = null;
            $this->aBrands = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see PrescriberTallySummary::setDeleted()
     * @see PrescriberTallySummary::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(PrescriberTallySummaryTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildPrescriberTallySummaryQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(PrescriberTallySummaryTableMap::DATABASE_NAME);
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
                PrescriberTallySummaryTableMap::addInstanceToPool($this);
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

            if ($this->aPositions !== null) {
                if ($this->aPositions->isModified() || $this->aPositions->isNew()) {
                    $affectedRows += $this->aPositions->save($con);
                }
                $this->setPositions($this->aPositions);
            }

            if ($this->aTerritories !== null) {
                if ($this->aTerritories->isModified() || $this->aTerritories->isNew()) {
                    $affectedRows += $this->aTerritories->save($con);
                }
                $this->setTerritories($this->aTerritories);
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

        $this->modifiedColumns[PrescriberTallySummaryTableMap::COL_PRESCRIBER_TALLY_SUMMARY_ID] = true;
        if (null !== $this->prescriber_tally_summary_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . PrescriberTallySummaryTableMap::COL_PRESCRIBER_TALLY_SUMMARY_ID . ')');
        }
        if (null === $this->prescriber_tally_summary_id) {
            try {
                $dataFetcher = $con->query("SELECT nextval('prescriber_tally_summary_prescriber_tally_summary_id_seq')");
                $this->prescriber_tally_summary_id = (int) $dataFetcher->fetchColumn();
            } catch (Exception $e) {
                throw new PropelException('Unable to get sequence id.', 0, $e);
            }
        }


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(PrescriberTallySummaryTableMap::COL_PRESCRIBER_TALLY_SUMMARY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'prescriber_tally_summary_id';
        }
        if ($this->isColumnModified(PrescriberTallySummaryTableMap::COL_ORGUNIT_ID)) {
            $modifiedColumns[':p' . $index++]  = 'orgunit_id';
        }
        if ($this->isColumnModified(PrescriberTallySummaryTableMap::COL_POSITION_ID)) {
            $modifiedColumns[':p' . $index++]  = 'position_id';
        }
        if ($this->isColumnModified(PrescriberTallySummaryTableMap::COL_TERRITORY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'territory_id';
        }
        if ($this->isColumnModified(PrescriberTallySummaryTableMap::COL_BRAND_ID)) {
            $modifiedColumns[':p' . $index++]  = 'brand_id';
        }
        if ($this->isColumnModified(PrescriberTallySummaryTableMap::COL_MOYE)) {
            $modifiedColumns[':p' . $index++]  = 'moye';
        }
        if ($this->isColumnModified(PrescriberTallySummaryTableMap::COL_TAGGED_DRS)) {
            $modifiedColumns[':p' . $index++]  = 'tagged_drs';
        }
        if ($this->isColumnModified(PrescriberTallySummaryTableMap::COL_LM_RXBERS)) {
            $modifiedColumns[':p' . $index++]  = 'lm_rxbers';
        }
        if ($this->isColumnModified(PrescriberTallySummaryTableMap::COL_CM_RXBERS)) {
            $modifiedColumns[':p' . $index++]  = 'cm_rxbers';
        }
        if ($this->isColumnModified(PrescriberTallySummaryTableMap::COL_GAIN)) {
            $modifiedColumns[':p' . $index++]  = 'gain';
        }
        if ($this->isColumnModified(PrescriberTallySummaryTableMap::COL_LOSS)) {
            $modifiedColumns[':p' . $index++]  = 'loss';
        }
        if ($this->isColumnModified(PrescriberTallySummaryTableMap::COL_TWO_MONTH_RXBER)) {
            $modifiedColumns[':p' . $index++]  = 'two_month_rxber';
        }
        if ($this->isColumnModified(PrescriberTallySummaryTableMap::COL_NONRXBER)) {
            $modifiedColumns[':p' . $index++]  = 'nonrxber';
        }
        if ($this->isColumnModified(PrescriberTallySummaryTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(PrescriberTallySummaryTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }
        if ($this->isColumnModified(PrescriberTallySummaryTableMap::COL_CM_RCPA)) {
            $modifiedColumns[':p' . $index++]  = 'cm_rcpa';
        }
        if ($this->isColumnModified(PrescriberTallySummaryTableMap::COL_CM_VISIT)) {
            $modifiedColumns[':p' . $index++]  = 'cm_visit';
        }

        $sql = sprintf(
            'INSERT INTO prescriber_tally_summary (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'prescriber_tally_summary_id':
                        $stmt->bindValue($identifier, $this->prescriber_tally_summary_id, PDO::PARAM_INT);

                        break;
                    case 'orgunit_id':
                        $stmt->bindValue($identifier, $this->orgunit_id, PDO::PARAM_INT);

                        break;
                    case 'position_id':
                        $stmt->bindValue($identifier, $this->position_id, PDO::PARAM_INT);

                        break;
                    case 'territory_id':
                        $stmt->bindValue($identifier, $this->territory_id, PDO::PARAM_INT);

                        break;
                    case 'brand_id':
                        $stmt->bindValue($identifier, $this->brand_id, PDO::PARAM_INT);

                        break;
                    case 'moye':
                        $stmt->bindValue($identifier, $this->moye, PDO::PARAM_STR);

                        break;
                    case 'tagged_drs':
                        $stmt->bindValue($identifier, $this->tagged_drs, PDO::PARAM_INT);

                        break;
                    case 'lm_rxbers':
                        $stmt->bindValue($identifier, $this->lm_rxbers, PDO::PARAM_INT);

                        break;
                    case 'cm_rxbers':
                        $stmt->bindValue($identifier, $this->cm_rxbers, PDO::PARAM_INT);

                        break;
                    case 'gain':
                        $stmt->bindValue($identifier, $this->gain, PDO::PARAM_INT);

                        break;
                    case 'loss':
                        $stmt->bindValue($identifier, $this->loss, PDO::PARAM_INT);

                        break;
                    case 'two_month_rxber':
                        $stmt->bindValue($identifier, $this->two_month_rxber, PDO::PARAM_INT);

                        break;
                    case 'nonrxber':
                        $stmt->bindValue($identifier, $this->nonrxber, PDO::PARAM_INT);

                        break;
                    case 'created_at':
                        $stmt->bindValue($identifier, $this->created_at ? $this->created_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'updated_at':
                        $stmt->bindValue($identifier, $this->updated_at ? $this->updated_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'cm_rcpa':
                        $stmt->bindValue($identifier, $this->cm_rcpa, PDO::PARAM_STR);

                        break;
                    case 'cm_visit':
                        $stmt->bindValue($identifier, $this->cm_visit, PDO::PARAM_STR);

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
        $pos = PrescriberTallySummaryTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getPrescriberTallySummaryId();

            case 1:
                return $this->getOrgunitId();

            case 2:
                return $this->getPositionId();

            case 3:
                return $this->getTerritoryId();

            case 4:
                return $this->getBrandId();

            case 5:
                return $this->getMoye();

            case 6:
                return $this->getTaggedDrs();

            case 7:
                return $this->getLmRxbers();

            case 8:
                return $this->getCmRxbers();

            case 9:
                return $this->getGain();

            case 10:
                return $this->getLoss();

            case 11:
                return $this->getTwoMonthRxber();

            case 12:
                return $this->getNonrxber();

            case 13:
                return $this->getCreatedAt();

            case 14:
                return $this->getUpdatedAt();

            case 15:
                return $this->getCmRcpa();

            case 16:
                return $this->getCmVisit();

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
        if (isset($alreadyDumpedObjects['PrescriberTallySummary'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['PrescriberTallySummary'][$this->hashCode()] = true;
        $keys = PrescriberTallySummaryTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getPrescriberTallySummaryId(),
            $keys[1] => $this->getOrgunitId(),
            $keys[2] => $this->getPositionId(),
            $keys[3] => $this->getTerritoryId(),
            $keys[4] => $this->getBrandId(),
            $keys[5] => $this->getMoye(),
            $keys[6] => $this->getTaggedDrs(),
            $keys[7] => $this->getLmRxbers(),
            $keys[8] => $this->getCmRxbers(),
            $keys[9] => $this->getGain(),
            $keys[10] => $this->getLoss(),
            $keys[11] => $this->getTwoMonthRxber(),
            $keys[12] => $this->getNonrxber(),
            $keys[13] => $this->getCreatedAt(),
            $keys[14] => $this->getUpdatedAt(),
            $keys[15] => $this->getCmRcpa(),
            $keys[16] => $this->getCmVisit(),
        ];
        if ($result[$keys[13]] instanceof \DateTimeInterface) {
            $result[$keys[13]] = $result[$keys[13]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[14]] instanceof \DateTimeInterface) {
            $result[$keys[14]] = $result[$keys[14]]->format('Y-m-d H:i:s.u');
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
        $pos = PrescriberTallySummaryTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setPrescriberTallySummaryId($value);
                break;
            case 1:
                $this->setOrgunitId($value);
                break;
            case 2:
                $this->setPositionId($value);
                break;
            case 3:
                $this->setTerritoryId($value);
                break;
            case 4:
                $this->setBrandId($value);
                break;
            case 5:
                $this->setMoye($value);
                break;
            case 6:
                $this->setTaggedDrs($value);
                break;
            case 7:
                $this->setLmRxbers($value);
                break;
            case 8:
                $this->setCmRxbers($value);
                break;
            case 9:
                $this->setGain($value);
                break;
            case 10:
                $this->setLoss($value);
                break;
            case 11:
                $this->setTwoMonthRxber($value);
                break;
            case 12:
                $this->setNonrxber($value);
                break;
            case 13:
                $this->setCreatedAt($value);
                break;
            case 14:
                $this->setUpdatedAt($value);
                break;
            case 15:
                $this->setCmRcpa($value);
                break;
            case 16:
                $this->setCmVisit($value);
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
        $keys = PrescriberTallySummaryTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setPrescriberTallySummaryId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setOrgunitId($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setPositionId($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setTerritoryId($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setBrandId($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setMoye($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setTaggedDrs($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setLmRxbers($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setCmRxbers($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setGain($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setLoss($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setTwoMonthRxber($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setNonrxber($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setCreatedAt($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setUpdatedAt($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setCmRcpa($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setCmVisit($arr[$keys[16]]);
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
        $criteria = new Criteria(PrescriberTallySummaryTableMap::DATABASE_NAME);

        if ($this->isColumnModified(PrescriberTallySummaryTableMap::COL_PRESCRIBER_TALLY_SUMMARY_ID)) {
            $criteria->add(PrescriberTallySummaryTableMap::COL_PRESCRIBER_TALLY_SUMMARY_ID, $this->prescriber_tally_summary_id);
        }
        if ($this->isColumnModified(PrescriberTallySummaryTableMap::COL_ORGUNIT_ID)) {
            $criteria->add(PrescriberTallySummaryTableMap::COL_ORGUNIT_ID, $this->orgunit_id);
        }
        if ($this->isColumnModified(PrescriberTallySummaryTableMap::COL_POSITION_ID)) {
            $criteria->add(PrescriberTallySummaryTableMap::COL_POSITION_ID, $this->position_id);
        }
        if ($this->isColumnModified(PrescriberTallySummaryTableMap::COL_TERRITORY_ID)) {
            $criteria->add(PrescriberTallySummaryTableMap::COL_TERRITORY_ID, $this->territory_id);
        }
        if ($this->isColumnModified(PrescriberTallySummaryTableMap::COL_BRAND_ID)) {
            $criteria->add(PrescriberTallySummaryTableMap::COL_BRAND_ID, $this->brand_id);
        }
        if ($this->isColumnModified(PrescriberTallySummaryTableMap::COL_MOYE)) {
            $criteria->add(PrescriberTallySummaryTableMap::COL_MOYE, $this->moye);
        }
        if ($this->isColumnModified(PrescriberTallySummaryTableMap::COL_TAGGED_DRS)) {
            $criteria->add(PrescriberTallySummaryTableMap::COL_TAGGED_DRS, $this->tagged_drs);
        }
        if ($this->isColumnModified(PrescriberTallySummaryTableMap::COL_LM_RXBERS)) {
            $criteria->add(PrescriberTallySummaryTableMap::COL_LM_RXBERS, $this->lm_rxbers);
        }
        if ($this->isColumnModified(PrescriberTallySummaryTableMap::COL_CM_RXBERS)) {
            $criteria->add(PrescriberTallySummaryTableMap::COL_CM_RXBERS, $this->cm_rxbers);
        }
        if ($this->isColumnModified(PrescriberTallySummaryTableMap::COL_GAIN)) {
            $criteria->add(PrescriberTallySummaryTableMap::COL_GAIN, $this->gain);
        }
        if ($this->isColumnModified(PrescriberTallySummaryTableMap::COL_LOSS)) {
            $criteria->add(PrescriberTallySummaryTableMap::COL_LOSS, $this->loss);
        }
        if ($this->isColumnModified(PrescriberTallySummaryTableMap::COL_TWO_MONTH_RXBER)) {
            $criteria->add(PrescriberTallySummaryTableMap::COL_TWO_MONTH_RXBER, $this->two_month_rxber);
        }
        if ($this->isColumnModified(PrescriberTallySummaryTableMap::COL_NONRXBER)) {
            $criteria->add(PrescriberTallySummaryTableMap::COL_NONRXBER, $this->nonrxber);
        }
        if ($this->isColumnModified(PrescriberTallySummaryTableMap::COL_CREATED_AT)) {
            $criteria->add(PrescriberTallySummaryTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(PrescriberTallySummaryTableMap::COL_UPDATED_AT)) {
            $criteria->add(PrescriberTallySummaryTableMap::COL_UPDATED_AT, $this->updated_at);
        }
        if ($this->isColumnModified(PrescriberTallySummaryTableMap::COL_CM_RCPA)) {
            $criteria->add(PrescriberTallySummaryTableMap::COL_CM_RCPA, $this->cm_rcpa);
        }
        if ($this->isColumnModified(PrescriberTallySummaryTableMap::COL_CM_VISIT)) {
            $criteria->add(PrescriberTallySummaryTableMap::COL_CM_VISIT, $this->cm_visit);
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
        $criteria = ChildPrescriberTallySummaryQuery::create();
        $criteria->add(PrescriberTallySummaryTableMap::COL_PRESCRIBER_TALLY_SUMMARY_ID, $this->prescriber_tally_summary_id);

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
        $validPk = null !== $this->getPrescriberTallySummaryId();

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
        return $this->getPrescriberTallySummaryId();
    }

    /**
     * Generic method to set the primary key (prescriber_tally_summary_id column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setPrescriberTallySummaryId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getPrescriberTallySummaryId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \entities\PrescriberTallySummary (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setOrgunitId($this->getOrgunitId());
        $copyObj->setPositionId($this->getPositionId());
        $copyObj->setTerritoryId($this->getTerritoryId());
        $copyObj->setBrandId($this->getBrandId());
        $copyObj->setMoye($this->getMoye());
        $copyObj->setTaggedDrs($this->getTaggedDrs());
        $copyObj->setLmRxbers($this->getLmRxbers());
        $copyObj->setCmRxbers($this->getCmRxbers());
        $copyObj->setGain($this->getGain());
        $copyObj->setLoss($this->getLoss());
        $copyObj->setTwoMonthRxber($this->getTwoMonthRxber());
        $copyObj->setNonrxber($this->getNonrxber());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        $copyObj->setCmRcpa($this->getCmRcpa());
        $copyObj->setCmVisit($this->getCmVisit());
        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setPrescriberTallySummaryId(NULL); // this is a auto-increment column, so set to default value
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
     * @return \entities\PrescriberTallySummary Clone of current object.
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
     * @param ChildOrgUnit $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setOrgUnit(ChildOrgUnit $v = null)
    {
        if ($v === null) {
            $this->setOrgunitId(NULL);
        } else {
            $this->setOrgunitId($v->getOrgunitid());
        }

        $this->aOrgUnit = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildOrgUnit object, it will not be re-added.
        if ($v !== null) {
            $v->addPrescriberTallySummary($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildOrgUnit object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildOrgUnit The associated ChildOrgUnit object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOrgUnit(?ConnectionInterface $con = null)
    {
        if ($this->aOrgUnit === null && ($this->orgunit_id != 0)) {
            $this->aOrgUnit = ChildOrgUnitQuery::create()->findPk($this->orgunit_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aOrgUnit->addPrescriberTallySummaries($this);
             */
        }

        return $this->aOrgUnit;
    }

    /**
     * Declares an association between this object and a ChildPositions object.
     *
     * @param ChildPositions $v
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
            $v->addPrescriberTallySummary($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildPositions object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildPositions The associated ChildPositions object.
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
                $this->aPositions->addPrescriberTallySummaries($this);
             */
        }

        return $this->aPositions;
    }

    /**
     * Declares an association between this object and a ChildTerritories object.
     *
     * @param ChildTerritories $v
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
            $v->addPrescriberTallySummary($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildTerritories object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildTerritories The associated ChildTerritories object.
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
                $this->aTerritories->addPrescriberTallySummaries($this);
             */
        }

        return $this->aTerritories;
    }

    /**
     * Declares an association between this object and a ChildBrands object.
     *
     * @param ChildBrands $v
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
            $v->addPrescriberTallySummary($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildBrands object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildBrands The associated ChildBrands object.
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
                $this->aBrands->addPrescriberTallySummaries($this);
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
            $this->aOrgUnit->removePrescriberTallySummary($this);
        }
        if (null !== $this->aPositions) {
            $this->aPositions->removePrescriberTallySummary($this);
        }
        if (null !== $this->aTerritories) {
            $this->aTerritories->removePrescriberTallySummary($this);
        }
        if (null !== $this->aBrands) {
            $this->aBrands->removePrescriberTallySummary($this);
        }
        $this->prescriber_tally_summary_id = null;
        $this->orgunit_id = null;
        $this->position_id = null;
        $this->territory_id = null;
        $this->brand_id = null;
        $this->moye = null;
        $this->tagged_drs = null;
        $this->lm_rxbers = null;
        $this->cm_rxbers = null;
        $this->gain = null;
        $this->loss = null;
        $this->two_month_rxber = null;
        $this->nonrxber = null;
        $this->created_at = null;
        $this->updated_at = null;
        $this->cm_rcpa = null;
        $this->cm_visit = null;
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
        $this->aPositions = null;
        $this->aTerritories = null;
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
        return (string) $this->exportTo(PrescriberTallySummaryTableMap::DEFAULT_STRING_FORMAT);
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
