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
use entities\GeoDistanceQuery as ChildGeoDistanceQuery;
use entities\GeoState as ChildGeoState;
use entities\GeoStateQuery as ChildGeoStateQuery;
use entities\GeoTowns as ChildGeoTowns;
use entities\GeoTownsQuery as ChildGeoTownsQuery;
use entities\Map\GeoDistanceTableMap;

/**
 * Base class that represents a row from the 'geo_distance' table.
 *
 *
 *
 * @package    propel.generator.entities.Base
 */
abstract class GeoDistance implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\entities\\Map\\GeoDistanceTableMap';


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
     * The value for the geo_distance_id field.
     *
     * @var        int
     */
    protected $geo_distance_id;

    /**
     * The value for the from_town_id field.
     *
     * @var        int
     */
    protected $from_town_id;

    /**
     * The value for the to_town_id field.
     *
     * @var        int
     */
    protected $to_town_id;

    /**
     * The value for the distance_km field.
     *
     * Note: this column has a database default value of: '0'
     * @var        string
     */
    protected $distance_km;

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
     * The value for the belt_name field.
     *
     * @var        string|null
     */
    protected $belt_name;

    /**
     * The value for the from_state_id field.
     *
     * @var        int|null
     */
    protected $from_state_id;

    /**
     * The value for the calculation_type field.
     *
     * @var        string|null
     */
    protected $calculation_type;

    /**
     * The value for the amount field.
     *
     * Note: this column has a database default value of: '0.00'
     * @var        string|null
     */
    protected $amount;

    /**
     * The value for the remark field.
     *
     * @var        string|null
     */
    protected $remark;

    /**
     * The value for the to_state_id field.
     *
     * @var        int|null
     */
    protected $to_state_id;

    /**
     * @var        ChildGeoTowns
     */
    protected $aGeoTownsRelatedByFromTownId;

    /**
     * @var        ChildGeoTowns
     */
    protected $aGeoTownsRelatedByToTownId;

    /**
     * @var        ChildGeoState
     */
    protected $aGeoStateRelatedByFromStateId;

    /**
     * @var        ChildGeoState
     */
    protected $aGeoStateRelatedByToStateId;

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
        $this->distance_km = '0';
        $this->amount = '0.00';
    }

    /**
     * Initializes internal state of entities\Base\GeoDistance object.
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
     * Compares this with another <code>GeoDistance</code> instance.  If
     * <code>obj</code> is an instance of <code>GeoDistance</code>, delegates to
     * <code>equals(GeoDistance)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [geo_distance_id] column value.
     *
     * @return int
     */
    public function getGeoDistanceId()
    {
        return $this->geo_distance_id;
    }

    /**
     * Get the [from_town_id] column value.
     *
     * @return int
     */
    public function getFromTownId()
    {
        return $this->from_town_id;
    }

    /**
     * Get the [to_town_id] column value.
     *
     * @return int
     */
    public function getToTownId()
    {
        return $this->to_town_id;
    }

    /**
     * Get the [distance_km] column value.
     *
     * @return string
     */
    public function getDistanceKm()
    {
        return $this->distance_km;
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
     * Get the [belt_name] column value.
     *
     * @return string|null
     */
    public function getBeltName()
    {
        return $this->belt_name;
    }

    /**
     * Get the [from_state_id] column value.
     *
     * @return int|null
     */
    public function getFromStateId()
    {
        return $this->from_state_id;
    }

    /**
     * Get the [calculation_type] column value.
     *
     * @return string|null
     */
    public function getCalculationType()
    {
        return $this->calculation_type;
    }

    /**
     * Get the [amount] column value.
     *
     * @return string|null
     */
    public function getAmount()
    {
        return $this->amount;
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
     * Get the [to_state_id] column value.
     *
     * @return int|null
     */
    public function getToStateId()
    {
        return $this->to_state_id;
    }

    /**
     * Set the value of [geo_distance_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setGeoDistanceId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->geo_distance_id !== $v) {
            $this->geo_distance_id = $v;
            $this->modifiedColumns[GeoDistanceTableMap::COL_GEO_DISTANCE_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [from_town_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFromTownId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->from_town_id !== $v) {
            $this->from_town_id = $v;
            $this->modifiedColumns[GeoDistanceTableMap::COL_FROM_TOWN_ID] = true;
        }

        if ($this->aGeoTownsRelatedByFromTownId !== null && $this->aGeoTownsRelatedByFromTownId->getItownid() !== $v) {
            $this->aGeoTownsRelatedByFromTownId = null;
        }

        return $this;
    }

    /**
     * Set the value of [to_town_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setToTownId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->to_town_id !== $v) {
            $this->to_town_id = $v;
            $this->modifiedColumns[GeoDistanceTableMap::COL_TO_TOWN_ID] = true;
        }

        if ($this->aGeoTownsRelatedByToTownId !== null && $this->aGeoTownsRelatedByToTownId->getItownid() !== $v) {
            $this->aGeoTownsRelatedByToTownId = null;
        }

        return $this;
    }

    /**
     * Set the value of [distance_km] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setDistanceKm($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->distance_km !== $v) {
            $this->distance_km = $v;
            $this->modifiedColumns[GeoDistanceTableMap::COL_DISTANCE_KM] = true;
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
                $this->modifiedColumns[GeoDistanceTableMap::COL_CREATED_AT] = true;
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
                $this->modifiedColumns[GeoDistanceTableMap::COL_UPDATED_AT] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [belt_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setBeltName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->belt_name !== $v) {
            $this->belt_name = $v;
            $this->modifiedColumns[GeoDistanceTableMap::COL_BELT_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [from_state_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFromStateId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->from_state_id !== $v) {
            $this->from_state_id = $v;
            $this->modifiedColumns[GeoDistanceTableMap::COL_FROM_STATE_ID] = true;
        }

        if ($this->aGeoStateRelatedByFromStateId !== null && $this->aGeoStateRelatedByFromStateId->getIstateid() !== $v) {
            $this->aGeoStateRelatedByFromStateId = null;
        }

        return $this;
    }

    /**
     * Set the value of [calculation_type] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCalculationType($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->calculation_type !== $v) {
            $this->calculation_type = $v;
            $this->modifiedColumns[GeoDistanceTableMap::COL_CALCULATION_TYPE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [amount] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setAmount($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->amount !== $v) {
            $this->amount = $v;
            $this->modifiedColumns[GeoDistanceTableMap::COL_AMOUNT] = true;
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
            $this->modifiedColumns[GeoDistanceTableMap::COL_REMARK] = true;
        }

        return $this;
    }

    /**
     * Set the value of [to_state_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setToStateId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->to_state_id !== $v) {
            $this->to_state_id = $v;
            $this->modifiedColumns[GeoDistanceTableMap::COL_TO_STATE_ID] = true;
        }

        if ($this->aGeoStateRelatedByToStateId !== null && $this->aGeoStateRelatedByToStateId->getIstateid() !== $v) {
            $this->aGeoStateRelatedByToStateId = null;
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
            if ($this->distance_km !== '0') {
                return false;
            }

            if ($this->amount !== '0.00') {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : GeoDistanceTableMap::translateFieldName('GeoDistanceId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->geo_distance_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : GeoDistanceTableMap::translateFieldName('FromTownId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->from_town_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : GeoDistanceTableMap::translateFieldName('ToTownId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->to_town_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : GeoDistanceTableMap::translateFieldName('DistanceKm', TableMap::TYPE_PHPNAME, $indexType)];
            $this->distance_km = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : GeoDistanceTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : GeoDistanceTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : GeoDistanceTableMap::translateFieldName('BeltName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->belt_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : GeoDistanceTableMap::translateFieldName('FromStateId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->from_state_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : GeoDistanceTableMap::translateFieldName('CalculationType', TableMap::TYPE_PHPNAME, $indexType)];
            $this->calculation_type = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : GeoDistanceTableMap::translateFieldName('Amount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->amount = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : GeoDistanceTableMap::translateFieldName('Remark', TableMap::TYPE_PHPNAME, $indexType)];
            $this->remark = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : GeoDistanceTableMap::translateFieldName('ToStateId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->to_state_id = (null !== $col) ? (int) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 12; // 12 = GeoDistanceTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\entities\\GeoDistance'), 0, $e);
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
        if ($this->aGeoTownsRelatedByFromTownId !== null && $this->from_town_id !== $this->aGeoTownsRelatedByFromTownId->getItownid()) {
            $this->aGeoTownsRelatedByFromTownId = null;
        }
        if ($this->aGeoTownsRelatedByToTownId !== null && $this->to_town_id !== $this->aGeoTownsRelatedByToTownId->getItownid()) {
            $this->aGeoTownsRelatedByToTownId = null;
        }
        if ($this->aGeoStateRelatedByFromStateId !== null && $this->from_state_id !== $this->aGeoStateRelatedByFromStateId->getIstateid()) {
            $this->aGeoStateRelatedByFromStateId = null;
        }
        if ($this->aGeoStateRelatedByToStateId !== null && $this->to_state_id !== $this->aGeoStateRelatedByToStateId->getIstateid()) {
            $this->aGeoStateRelatedByToStateId = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(GeoDistanceTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildGeoDistanceQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aGeoTownsRelatedByFromTownId = null;
            $this->aGeoTownsRelatedByToTownId = null;
            $this->aGeoStateRelatedByFromStateId = null;
            $this->aGeoStateRelatedByToStateId = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see GeoDistance::setDeleted()
     * @see GeoDistance::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(GeoDistanceTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildGeoDistanceQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(GeoDistanceTableMap::DATABASE_NAME);
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
                GeoDistanceTableMap::addInstanceToPool($this);
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

            if ($this->aGeoTownsRelatedByFromTownId !== null) {
                if ($this->aGeoTownsRelatedByFromTownId->isModified() || $this->aGeoTownsRelatedByFromTownId->isNew()) {
                    $affectedRows += $this->aGeoTownsRelatedByFromTownId->save($con);
                }
                $this->setGeoTownsRelatedByFromTownId($this->aGeoTownsRelatedByFromTownId);
            }

            if ($this->aGeoTownsRelatedByToTownId !== null) {
                if ($this->aGeoTownsRelatedByToTownId->isModified() || $this->aGeoTownsRelatedByToTownId->isNew()) {
                    $affectedRows += $this->aGeoTownsRelatedByToTownId->save($con);
                }
                $this->setGeoTownsRelatedByToTownId($this->aGeoTownsRelatedByToTownId);
            }

            if ($this->aGeoStateRelatedByFromStateId !== null) {
                if ($this->aGeoStateRelatedByFromStateId->isModified() || $this->aGeoStateRelatedByFromStateId->isNew()) {
                    $affectedRows += $this->aGeoStateRelatedByFromStateId->save($con);
                }
                $this->setGeoStateRelatedByFromStateId($this->aGeoStateRelatedByFromStateId);
            }

            if ($this->aGeoStateRelatedByToStateId !== null) {
                if ($this->aGeoStateRelatedByToStateId->isModified() || $this->aGeoStateRelatedByToStateId->isNew()) {
                    $affectedRows += $this->aGeoStateRelatedByToStateId->save($con);
                }
                $this->setGeoStateRelatedByToStateId($this->aGeoStateRelatedByToStateId);
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

        $this->modifiedColumns[GeoDistanceTableMap::COL_GEO_DISTANCE_ID] = true;
        if (null !== $this->geo_distance_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . GeoDistanceTableMap::COL_GEO_DISTANCE_ID . ')');
        }
        if (null === $this->geo_distance_id) {
            try {
                $dataFetcher = $con->query("SELECT nextval('geo_distance_geo_distance_id_seq')");
                $this->geo_distance_id = (int) $dataFetcher->fetchColumn();
            } catch (Exception $e) {
                throw new PropelException('Unable to get sequence id.', 0, $e);
            }
        }


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(GeoDistanceTableMap::COL_GEO_DISTANCE_ID)) {
            $modifiedColumns[':p' . $index++]  = 'geo_distance_id';
        }
        if ($this->isColumnModified(GeoDistanceTableMap::COL_FROM_TOWN_ID)) {
            $modifiedColumns[':p' . $index++]  = 'from_town_id';
        }
        if ($this->isColumnModified(GeoDistanceTableMap::COL_TO_TOWN_ID)) {
            $modifiedColumns[':p' . $index++]  = 'to_town_id';
        }
        if ($this->isColumnModified(GeoDistanceTableMap::COL_DISTANCE_KM)) {
            $modifiedColumns[':p' . $index++]  = 'distance_km';
        }
        if ($this->isColumnModified(GeoDistanceTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(GeoDistanceTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }
        if ($this->isColumnModified(GeoDistanceTableMap::COL_BELT_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'belt_name';
        }
        if ($this->isColumnModified(GeoDistanceTableMap::COL_FROM_STATE_ID)) {
            $modifiedColumns[':p' . $index++]  = 'from_state_id';
        }
        if ($this->isColumnModified(GeoDistanceTableMap::COL_CALCULATION_TYPE)) {
            $modifiedColumns[':p' . $index++]  = 'calculation_type';
        }
        if ($this->isColumnModified(GeoDistanceTableMap::COL_AMOUNT)) {
            $modifiedColumns[':p' . $index++]  = 'amount';
        }
        if ($this->isColumnModified(GeoDistanceTableMap::COL_REMARK)) {
            $modifiedColumns[':p' . $index++]  = 'remark';
        }
        if ($this->isColumnModified(GeoDistanceTableMap::COL_TO_STATE_ID)) {
            $modifiedColumns[':p' . $index++]  = 'to_state_id';
        }

        $sql = sprintf(
            'INSERT INTO geo_distance (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'geo_distance_id':
                        $stmt->bindValue($identifier, $this->geo_distance_id, PDO::PARAM_INT);

                        break;
                    case 'from_town_id':
                        $stmt->bindValue($identifier, $this->from_town_id, PDO::PARAM_INT);

                        break;
                    case 'to_town_id':
                        $stmt->bindValue($identifier, $this->to_town_id, PDO::PARAM_INT);

                        break;
                    case 'distance_km':
                        $stmt->bindValue($identifier, $this->distance_km, PDO::PARAM_STR);

                        break;
                    case 'created_at':
                        $stmt->bindValue($identifier, $this->created_at ? $this->created_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'updated_at':
                        $stmt->bindValue($identifier, $this->updated_at ? $this->updated_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'belt_name':
                        $stmt->bindValue($identifier, $this->belt_name, PDO::PARAM_STR);

                        break;
                    case 'from_state_id':
                        $stmt->bindValue($identifier, $this->from_state_id, PDO::PARAM_INT);

                        break;
                    case 'calculation_type':
                        $stmt->bindValue($identifier, $this->calculation_type, PDO::PARAM_STR);

                        break;
                    case 'amount':
                        $stmt->bindValue($identifier, $this->amount, PDO::PARAM_STR);

                        break;
                    case 'remark':
                        $stmt->bindValue($identifier, $this->remark, PDO::PARAM_STR);

                        break;
                    case 'to_state_id':
                        $stmt->bindValue($identifier, $this->to_state_id, PDO::PARAM_INT);

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
        $pos = GeoDistanceTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getGeoDistanceId();

            case 1:
                return $this->getFromTownId();

            case 2:
                return $this->getToTownId();

            case 3:
                return $this->getDistanceKm();

            case 4:
                return $this->getCreatedAt();

            case 5:
                return $this->getUpdatedAt();

            case 6:
                return $this->getBeltName();

            case 7:
                return $this->getFromStateId();

            case 8:
                return $this->getCalculationType();

            case 9:
                return $this->getAmount();

            case 10:
                return $this->getRemark();

            case 11:
                return $this->getToStateId();

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
        if (isset($alreadyDumpedObjects['GeoDistance'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['GeoDistance'][$this->hashCode()] = true;
        $keys = GeoDistanceTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getGeoDistanceId(),
            $keys[1] => $this->getFromTownId(),
            $keys[2] => $this->getToTownId(),
            $keys[3] => $this->getDistanceKm(),
            $keys[4] => $this->getCreatedAt(),
            $keys[5] => $this->getUpdatedAt(),
            $keys[6] => $this->getBeltName(),
            $keys[7] => $this->getFromStateId(),
            $keys[8] => $this->getCalculationType(),
            $keys[9] => $this->getAmount(),
            $keys[10] => $this->getRemark(),
            $keys[11] => $this->getToStateId(),
        ];
        if ($result[$keys[4]] instanceof \DateTimeInterface) {
            $result[$keys[4]] = $result[$keys[4]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[5]] instanceof \DateTimeInterface) {
            $result[$keys[5]] = $result[$keys[5]]->format('Y-m-d H:i:s.u');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aGeoTownsRelatedByFromTownId) {

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

                $result[$key] = $this->aGeoTownsRelatedByFromTownId->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aGeoTownsRelatedByToTownId) {

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

                $result[$key] = $this->aGeoTownsRelatedByToTownId->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aGeoStateRelatedByFromStateId) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'geoState';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'geo_state';
                        break;
                    default:
                        $key = 'GeoState';
                }

                $result[$key] = $this->aGeoStateRelatedByFromStateId->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aGeoStateRelatedByToStateId) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'geoState';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'geo_state';
                        break;
                    default:
                        $key = 'GeoState';
                }

                $result[$key] = $this->aGeoStateRelatedByToStateId->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
        $pos = GeoDistanceTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setGeoDistanceId($value);
                break;
            case 1:
                $this->setFromTownId($value);
                break;
            case 2:
                $this->setToTownId($value);
                break;
            case 3:
                $this->setDistanceKm($value);
                break;
            case 4:
                $this->setCreatedAt($value);
                break;
            case 5:
                $this->setUpdatedAt($value);
                break;
            case 6:
                $this->setBeltName($value);
                break;
            case 7:
                $this->setFromStateId($value);
                break;
            case 8:
                $this->setCalculationType($value);
                break;
            case 9:
                $this->setAmount($value);
                break;
            case 10:
                $this->setRemark($value);
                break;
            case 11:
                $this->setToStateId($value);
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
        $keys = GeoDistanceTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setGeoDistanceId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setFromTownId($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setToTownId($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setDistanceKm($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setCreatedAt($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setUpdatedAt($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setBeltName($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setFromStateId($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setCalculationType($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setAmount($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setRemark($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setToStateId($arr[$keys[11]]);
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
        $criteria = new Criteria(GeoDistanceTableMap::DATABASE_NAME);

        if ($this->isColumnModified(GeoDistanceTableMap::COL_GEO_DISTANCE_ID)) {
            $criteria->add(GeoDistanceTableMap::COL_GEO_DISTANCE_ID, $this->geo_distance_id);
        }
        if ($this->isColumnModified(GeoDistanceTableMap::COL_FROM_TOWN_ID)) {
            $criteria->add(GeoDistanceTableMap::COL_FROM_TOWN_ID, $this->from_town_id);
        }
        if ($this->isColumnModified(GeoDistanceTableMap::COL_TO_TOWN_ID)) {
            $criteria->add(GeoDistanceTableMap::COL_TO_TOWN_ID, $this->to_town_id);
        }
        if ($this->isColumnModified(GeoDistanceTableMap::COL_DISTANCE_KM)) {
            $criteria->add(GeoDistanceTableMap::COL_DISTANCE_KM, $this->distance_km);
        }
        if ($this->isColumnModified(GeoDistanceTableMap::COL_CREATED_AT)) {
            $criteria->add(GeoDistanceTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(GeoDistanceTableMap::COL_UPDATED_AT)) {
            $criteria->add(GeoDistanceTableMap::COL_UPDATED_AT, $this->updated_at);
        }
        if ($this->isColumnModified(GeoDistanceTableMap::COL_BELT_NAME)) {
            $criteria->add(GeoDistanceTableMap::COL_BELT_NAME, $this->belt_name);
        }
        if ($this->isColumnModified(GeoDistanceTableMap::COL_FROM_STATE_ID)) {
            $criteria->add(GeoDistanceTableMap::COL_FROM_STATE_ID, $this->from_state_id);
        }
        if ($this->isColumnModified(GeoDistanceTableMap::COL_CALCULATION_TYPE)) {
            $criteria->add(GeoDistanceTableMap::COL_CALCULATION_TYPE, $this->calculation_type);
        }
        if ($this->isColumnModified(GeoDistanceTableMap::COL_AMOUNT)) {
            $criteria->add(GeoDistanceTableMap::COL_AMOUNT, $this->amount);
        }
        if ($this->isColumnModified(GeoDistanceTableMap::COL_REMARK)) {
            $criteria->add(GeoDistanceTableMap::COL_REMARK, $this->remark);
        }
        if ($this->isColumnModified(GeoDistanceTableMap::COL_TO_STATE_ID)) {
            $criteria->add(GeoDistanceTableMap::COL_TO_STATE_ID, $this->to_state_id);
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
        $criteria = ChildGeoDistanceQuery::create();
        $criteria->add(GeoDistanceTableMap::COL_GEO_DISTANCE_ID, $this->geo_distance_id);

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
        $validPk = null !== $this->getGeoDistanceId();

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
        return $this->getGeoDistanceId();
    }

    /**
     * Generic method to set the primary key (geo_distance_id column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setGeoDistanceId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getGeoDistanceId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \entities\GeoDistance (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setFromTownId($this->getFromTownId());
        $copyObj->setToTownId($this->getToTownId());
        $copyObj->setDistanceKm($this->getDistanceKm());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        $copyObj->setBeltName($this->getBeltName());
        $copyObj->setFromStateId($this->getFromStateId());
        $copyObj->setCalculationType($this->getCalculationType());
        $copyObj->setAmount($this->getAmount());
        $copyObj->setRemark($this->getRemark());
        $copyObj->setToStateId($this->getToStateId());
        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setGeoDistanceId(NULL); // this is a auto-increment column, so set to default value
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
     * @return \entities\GeoDistance Clone of current object.
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
     * Declares an association between this object and a ChildGeoTowns object.
     *
     * @param ChildGeoTowns $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setGeoTownsRelatedByFromTownId(ChildGeoTowns $v = null)
    {
        if ($v === null) {
            $this->setFromTownId(NULL);
        } else {
            $this->setFromTownId($v->getItownid());
        }

        $this->aGeoTownsRelatedByFromTownId = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildGeoTowns object, it will not be re-added.
        if ($v !== null) {
            $v->addGeoDistanceRelatedByFromTownId($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildGeoTowns object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildGeoTowns The associated ChildGeoTowns object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getGeoTownsRelatedByFromTownId(?ConnectionInterface $con = null)
    {
        if ($this->aGeoTownsRelatedByFromTownId === null && ($this->from_town_id != 0)) {
            $this->aGeoTownsRelatedByFromTownId = ChildGeoTownsQuery::create()->findPk($this->from_town_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aGeoTownsRelatedByFromTownId->addGeoDistancesRelatedByFromTownId($this);
             */
        }

        return $this->aGeoTownsRelatedByFromTownId;
    }

    /**
     * Declares an association between this object and a ChildGeoTowns object.
     *
     * @param ChildGeoTowns $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setGeoTownsRelatedByToTownId(ChildGeoTowns $v = null)
    {
        if ($v === null) {
            $this->setToTownId(NULL);
        } else {
            $this->setToTownId($v->getItownid());
        }

        $this->aGeoTownsRelatedByToTownId = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildGeoTowns object, it will not be re-added.
        if ($v !== null) {
            $v->addGeoDistanceRelatedByToTownId($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildGeoTowns object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildGeoTowns The associated ChildGeoTowns object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getGeoTownsRelatedByToTownId(?ConnectionInterface $con = null)
    {
        if ($this->aGeoTownsRelatedByToTownId === null && ($this->to_town_id != 0)) {
            $this->aGeoTownsRelatedByToTownId = ChildGeoTownsQuery::create()->findPk($this->to_town_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aGeoTownsRelatedByToTownId->addGeoDistancesRelatedByToTownId($this);
             */
        }

        return $this->aGeoTownsRelatedByToTownId;
    }

    /**
     * Declares an association between this object and a ChildGeoState object.
     *
     * @param ChildGeoState|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setGeoStateRelatedByFromStateId(ChildGeoState $v = null)
    {
        if ($v === null) {
            $this->setFromStateId(NULL);
        } else {
            $this->setFromStateId($v->getIstateid());
        }

        $this->aGeoStateRelatedByFromStateId = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildGeoState object, it will not be re-added.
        if ($v !== null) {
            $v->addGeoDistanceRelatedByFromStateId($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildGeoState object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildGeoState|null The associated ChildGeoState object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getGeoStateRelatedByFromStateId(?ConnectionInterface $con = null)
    {
        if ($this->aGeoStateRelatedByFromStateId === null && ($this->from_state_id != 0)) {
            $this->aGeoStateRelatedByFromStateId = ChildGeoStateQuery::create()->findPk($this->from_state_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aGeoStateRelatedByFromStateId->addGeoDistancesRelatedByFromStateId($this);
             */
        }

        return $this->aGeoStateRelatedByFromStateId;
    }

    /**
     * Declares an association between this object and a ChildGeoState object.
     *
     * @param ChildGeoState|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setGeoStateRelatedByToStateId(ChildGeoState $v = null)
    {
        if ($v === null) {
            $this->setToStateId(NULL);
        } else {
            $this->setToStateId($v->getIstateid());
        }

        $this->aGeoStateRelatedByToStateId = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildGeoState object, it will not be re-added.
        if ($v !== null) {
            $v->addGeoDistanceRelatedByToStateId($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildGeoState object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildGeoState|null The associated ChildGeoState object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getGeoStateRelatedByToStateId(?ConnectionInterface $con = null)
    {
        if ($this->aGeoStateRelatedByToStateId === null && ($this->to_state_id != 0)) {
            $this->aGeoStateRelatedByToStateId = ChildGeoStateQuery::create()->findPk($this->to_state_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aGeoStateRelatedByToStateId->addGeoDistancesRelatedByToStateId($this);
             */
        }

        return $this->aGeoStateRelatedByToStateId;
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
        if (null !== $this->aGeoTownsRelatedByFromTownId) {
            $this->aGeoTownsRelatedByFromTownId->removeGeoDistanceRelatedByFromTownId($this);
        }
        if (null !== $this->aGeoTownsRelatedByToTownId) {
            $this->aGeoTownsRelatedByToTownId->removeGeoDistanceRelatedByToTownId($this);
        }
        if (null !== $this->aGeoStateRelatedByFromStateId) {
            $this->aGeoStateRelatedByFromStateId->removeGeoDistanceRelatedByFromStateId($this);
        }
        if (null !== $this->aGeoStateRelatedByToStateId) {
            $this->aGeoStateRelatedByToStateId->removeGeoDistanceRelatedByToStateId($this);
        }
        $this->geo_distance_id = null;
        $this->from_town_id = null;
        $this->to_town_id = null;
        $this->distance_km = null;
        $this->created_at = null;
        $this->updated_at = null;
        $this->belt_name = null;
        $this->from_state_id = null;
        $this->calculation_type = null;
        $this->amount = null;
        $this->remark = null;
        $this->to_state_id = null;
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

        $this->aGeoTownsRelatedByFromTownId = null;
        $this->aGeoTownsRelatedByToTownId = null;
        $this->aGeoStateRelatedByFromStateId = null;
        $this->aGeoStateRelatedByToStateId = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(GeoDistanceTableMap::DEFAULT_STRING_FORMAT);
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
