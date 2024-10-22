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
use entities\Branch as ChildBranch;
use entities\BranchQuery as ChildBranchQuery;
use entities\GeoCity as ChildGeoCity;
use entities\GeoCityQuery as ChildGeoCityQuery;
use entities\GeoCountry as ChildGeoCountry;
use entities\GeoCountryQuery as ChildGeoCountryQuery;
use entities\GeoDistance as ChildGeoDistance;
use entities\GeoDistanceQuery as ChildGeoDistanceQuery;
use entities\GeoState as ChildGeoState;
use entities\GeoStateQuery as ChildGeoStateQuery;
use entities\Holidays as ChildHolidays;
use entities\HolidaysQuery as ChildHolidaysQuery;
use entities\OnBoardRequestAddress as ChildOnBoardRequestAddress;
use entities\OnBoardRequestAddressQuery as ChildOnBoardRequestAddressQuery;
use entities\Map\BranchTableMap;
use entities\Map\GeoCityTableMap;
use entities\Map\GeoDistanceTableMap;
use entities\Map\GeoStateTableMap;
use entities\Map\HolidaysTableMap;
use entities\Map\OnBoardRequestAddressTableMap;

/**
 * Base class that represents a row from the 'geo_state' table.
 *
 *
 *
 * @package    propel.generator.entities.Base
 */
abstract class GeoState implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\entities\\Map\\GeoStateTableMap';


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
     * The value for the istateid field.
     *
     * @var        int
     */
    protected $istateid;

    /**
     * The value for the sstatename field.
     *
     * @var        string
     */
    protected $sstatename;

    /**
     * The value for the sstatecode field.
     *
     * @var        string
     */
    protected $sstatecode;

    /**
     * The value for the dcreateddate field.
     *
     * @var        DateTime|null
     */
    protected $dcreateddate;

    /**
     * The value for the dmodifydate field.
     *
     * @var        DateTime|null
     */
    protected $dmodifydate;

    /**
     * The value for the country_id field.
     *
     * @var        int|null
     */
    protected $country_id;

    /**
     * The value for the sstatus field.
     *
     * Note: this column has a database default value of: '1'
     * @var        string
     */
    protected $sstatus;

    /**
     * @var        ChildGeoCountry
     */
    protected $aGeoCountry;

    /**
     * @var        ObjectCollection|ChildBranch[] Collection to store aggregation of ChildBranch objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildBranch> Collection to store aggregation of ChildBranch objects.
     */
    protected $collBranches;
    protected $collBranchesPartial;

    /**
     * @var        ObjectCollection|ChildGeoCity[] Collection to store aggregation of ChildGeoCity objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildGeoCity> Collection to store aggregation of ChildGeoCity objects.
     */
    protected $collGeoCities;
    protected $collGeoCitiesPartial;

    /**
     * @var        ObjectCollection|ChildGeoDistance[] Collection to store aggregation of ChildGeoDistance objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildGeoDistance> Collection to store aggregation of ChildGeoDistance objects.
     */
    protected $collGeoDistancesRelatedByFromStateId;
    protected $collGeoDistancesRelatedByFromStateIdPartial;

    /**
     * @var        ObjectCollection|ChildGeoDistance[] Collection to store aggregation of ChildGeoDistance objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildGeoDistance> Collection to store aggregation of ChildGeoDistance objects.
     */
    protected $collGeoDistancesRelatedByToStateId;
    protected $collGeoDistancesRelatedByToStateIdPartial;

    /**
     * @var        ObjectCollection|ChildHolidays[] Collection to store aggregation of ChildHolidays objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildHolidays> Collection to store aggregation of ChildHolidays objects.
     */
    protected $collHolidayss;
    protected $collHolidayssPartial;

    /**
     * @var        ObjectCollection|ChildOnBoardRequestAddress[] Collection to store aggregation of ChildOnBoardRequestAddress objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildOnBoardRequestAddress> Collection to store aggregation of ChildOnBoardRequestAddress objects.
     */
    protected $collOnBoardRequestAddresses;
    protected $collOnBoardRequestAddressesPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildBranch[]
     * @phpstan-var ObjectCollection&\Traversable<ChildBranch>
     */
    protected $branchesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildGeoCity[]
     * @phpstan-var ObjectCollection&\Traversable<ChildGeoCity>
     */
    protected $geoCitiesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildGeoDistance[]
     * @phpstan-var ObjectCollection&\Traversable<ChildGeoDistance>
     */
    protected $geoDistancesRelatedByFromStateIdScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildGeoDistance[]
     * @phpstan-var ObjectCollection&\Traversable<ChildGeoDistance>
     */
    protected $geoDistancesRelatedByToStateIdScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildHolidays[]
     * @phpstan-var ObjectCollection&\Traversable<ChildHolidays>
     */
    protected $holidayssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildOnBoardRequestAddress[]
     * @phpstan-var ObjectCollection&\Traversable<ChildOnBoardRequestAddress>
     */
    protected $onBoardRequestAddressesScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues(): void
    {
        $this->sstatus = '1';
    }

    /**
     * Initializes internal state of entities\Base\GeoState object.
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
     * Compares this with another <code>GeoState</code> instance.  If
     * <code>obj</code> is an instance of <code>GeoState</code>, delegates to
     * <code>equals(GeoState)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [istateid] column value.
     *
     * @return int
     */
    public function getIstateid()
    {
        return $this->istateid;
    }

    /**
     * Get the [sstatename] column value.
     *
     * @return string
     */
    public function getSstatename()
    {
        return $this->sstatename;
    }

    /**
     * Get the [sstatecode] column value.
     *
     * @return string
     */
    public function getSstatecode()
    {
        return $this->sstatecode;
    }

    /**
     * Get the [optionally formatted] temporal [dcreateddate] column value.
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
    public function getDcreateddate($format = null)
    {
        if ($format === null) {
            return $this->dcreateddate;
        } else {
            return $this->dcreateddate instanceof \DateTimeInterface ? $this->dcreateddate->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [dmodifydate] column value.
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
    public function getDmodifydate($format = null)
    {
        if ($format === null) {
            return $this->dmodifydate;
        } else {
            return $this->dmodifydate instanceof \DateTimeInterface ? $this->dmodifydate->format($format) : null;
        }
    }

    /**
     * Get the [country_id] column value.
     *
     * @return int|null
     */
    public function getCountryId()
    {
        return $this->country_id;
    }

    /**
     * Get the [sstatus] column value.
     *
     * @return string
     */
    public function getSstatus()
    {
        return $this->sstatus;
    }

    /**
     * Set the value of [istateid] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIstateid($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->istateid !== $v) {
            $this->istateid = $v;
            $this->modifiedColumns[GeoStateTableMap::COL_ISTATEID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [sstatename] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setSstatename($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->sstatename !== $v) {
            $this->sstatename = $v;
            $this->modifiedColumns[GeoStateTableMap::COL_SSTATENAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [sstatecode] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setSstatecode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->sstatecode !== $v) {
            $this->sstatecode = $v;
            $this->modifiedColumns[GeoStateTableMap::COL_SSTATECODE] = true;
        }

        return $this;
    }

    /**
     * Sets the value of [dcreateddate] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setDcreateddate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->dcreateddate !== null || $dt !== null) {
            if ($this->dcreateddate === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->dcreateddate->format("Y-m-d H:i:s.u")) {
                $this->dcreateddate = $dt === null ? null : clone $dt;
                $this->modifiedColumns[GeoStateTableMap::COL_DCREATEDDATE] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Sets the value of [dmodifydate] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setDmodifydate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->dmodifydate !== null || $dt !== null) {
            if ($this->dmodifydate === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->dmodifydate->format("Y-m-d H:i:s.u")) {
                $this->dmodifydate = $dt === null ? null : clone $dt;
                $this->modifiedColumns[GeoStateTableMap::COL_DMODIFYDATE] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [country_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCountryId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->country_id !== $v) {
            $this->country_id = $v;
            $this->modifiedColumns[GeoStateTableMap::COL_COUNTRY_ID] = true;
        }

        if ($this->aGeoCountry !== null && $this->aGeoCountry->getIcountryid() !== $v) {
            $this->aGeoCountry = null;
        }

        return $this;
    }

    /**
     * Set the value of [sstatus] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setSstatus($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->sstatus !== $v) {
            $this->sstatus = $v;
            $this->modifiedColumns[GeoStateTableMap::COL_SSTATUS] = true;
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
            if ($this->sstatus !== '1') {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : GeoStateTableMap::translateFieldName('Istateid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->istateid = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : GeoStateTableMap::translateFieldName('Sstatename', TableMap::TYPE_PHPNAME, $indexType)];
            $this->sstatename = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : GeoStateTableMap::translateFieldName('Sstatecode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->sstatecode = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : GeoStateTableMap::translateFieldName('Dcreateddate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->dcreateddate = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : GeoStateTableMap::translateFieldName('Dmodifydate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->dmodifydate = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : GeoStateTableMap::translateFieldName('CountryId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->country_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : GeoStateTableMap::translateFieldName('Sstatus', TableMap::TYPE_PHPNAME, $indexType)];
            $this->sstatus = (null !== $col) ? (string) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 7; // 7 = GeoStateTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\entities\\GeoState'), 0, $e);
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
        if ($this->aGeoCountry !== null && $this->country_id !== $this->aGeoCountry->getIcountryid()) {
            $this->aGeoCountry = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(GeoStateTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildGeoStateQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aGeoCountry = null;
            $this->collBranches = null;

            $this->collGeoCities = null;

            $this->collGeoDistancesRelatedByFromStateId = null;

            $this->collGeoDistancesRelatedByToStateId = null;

            $this->collHolidayss = null;

            $this->collOnBoardRequestAddresses = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see GeoState::setDeleted()
     * @see GeoState::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(GeoStateTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildGeoStateQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(GeoStateTableMap::DATABASE_NAME);
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
                GeoStateTableMap::addInstanceToPool($this);
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

            if ($this->aGeoCountry !== null) {
                if ($this->aGeoCountry->isModified() || $this->aGeoCountry->isNew()) {
                    $affectedRows += $this->aGeoCountry->save($con);
                }
                $this->setGeoCountry($this->aGeoCountry);
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

            if ($this->branchesScheduledForDeletion !== null) {
                if (!$this->branchesScheduledForDeletion->isEmpty()) {
                    foreach ($this->branchesScheduledForDeletion as $branch) {
                        // need to save related object because we set the relation to null
                        $branch->save($con);
                    }
                    $this->branchesScheduledForDeletion = null;
                }
            }

            if ($this->collBranches !== null) {
                foreach ($this->collBranches as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->geoCitiesScheduledForDeletion !== null) {
                if (!$this->geoCitiesScheduledForDeletion->isEmpty()) {
                    foreach ($this->geoCitiesScheduledForDeletion as $geoCity) {
                        // need to save related object because we set the relation to null
                        $geoCity->save($con);
                    }
                    $this->geoCitiesScheduledForDeletion = null;
                }
            }

            if ($this->collGeoCities !== null) {
                foreach ($this->collGeoCities as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->geoDistancesRelatedByFromStateIdScheduledForDeletion !== null) {
                if (!$this->geoDistancesRelatedByFromStateIdScheduledForDeletion->isEmpty()) {
                    foreach ($this->geoDistancesRelatedByFromStateIdScheduledForDeletion as $geoDistanceRelatedByFromStateId) {
                        // need to save related object because we set the relation to null
                        $geoDistanceRelatedByFromStateId->save($con);
                    }
                    $this->geoDistancesRelatedByFromStateIdScheduledForDeletion = null;
                }
            }

            if ($this->collGeoDistancesRelatedByFromStateId !== null) {
                foreach ($this->collGeoDistancesRelatedByFromStateId as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->geoDistancesRelatedByToStateIdScheduledForDeletion !== null) {
                if (!$this->geoDistancesRelatedByToStateIdScheduledForDeletion->isEmpty()) {
                    foreach ($this->geoDistancesRelatedByToStateIdScheduledForDeletion as $geoDistanceRelatedByToStateId) {
                        // need to save related object because we set the relation to null
                        $geoDistanceRelatedByToStateId->save($con);
                    }
                    $this->geoDistancesRelatedByToStateIdScheduledForDeletion = null;
                }
            }

            if ($this->collGeoDistancesRelatedByToStateId !== null) {
                foreach ($this->collGeoDistancesRelatedByToStateId as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->holidayssScheduledForDeletion !== null) {
                if (!$this->holidayssScheduledForDeletion->isEmpty()) {
                    foreach ($this->holidayssScheduledForDeletion as $holidays) {
                        // need to save related object because we set the relation to null
                        $holidays->save($con);
                    }
                    $this->holidayssScheduledForDeletion = null;
                }
            }

            if ($this->collHolidayss !== null) {
                foreach ($this->collHolidayss as $referrerFK) {
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

        $this->modifiedColumns[GeoStateTableMap::COL_ISTATEID] = true;
        if (null !== $this->istateid) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . GeoStateTableMap::COL_ISTATEID . ')');
        }
        if (null === $this->istateid) {
            try {
                $dataFetcher = $con->query("SELECT nextval('geo_state_istateid_seq')");
                $this->istateid = (int) $dataFetcher->fetchColumn();
            } catch (Exception $e) {
                throw new PropelException('Unable to get sequence id.', 0, $e);
            }
        }


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(GeoStateTableMap::COL_ISTATEID)) {
            $modifiedColumns[':p' . $index++]  = 'istateid';
        }
        if ($this->isColumnModified(GeoStateTableMap::COL_SSTATENAME)) {
            $modifiedColumns[':p' . $index++]  = 'sstatename';
        }
        if ($this->isColumnModified(GeoStateTableMap::COL_SSTATECODE)) {
            $modifiedColumns[':p' . $index++]  = 'sstatecode';
        }
        if ($this->isColumnModified(GeoStateTableMap::COL_DCREATEDDATE)) {
            $modifiedColumns[':p' . $index++]  = 'dcreateddate';
        }
        if ($this->isColumnModified(GeoStateTableMap::COL_DMODIFYDATE)) {
            $modifiedColumns[':p' . $index++]  = 'dmodifydate';
        }
        if ($this->isColumnModified(GeoStateTableMap::COL_COUNTRY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'country_id';
        }
        if ($this->isColumnModified(GeoStateTableMap::COL_SSTATUS)) {
            $modifiedColumns[':p' . $index++]  = 'sstatus';
        }

        $sql = sprintf(
            'INSERT INTO geo_state (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'istateid':
                        $stmt->bindValue($identifier, $this->istateid, PDO::PARAM_INT);

                        break;
                    case 'sstatename':
                        $stmt->bindValue($identifier, $this->sstatename, PDO::PARAM_STR);

                        break;
                    case 'sstatecode':
                        $stmt->bindValue($identifier, $this->sstatecode, PDO::PARAM_STR);

                        break;
                    case 'dcreateddate':
                        $stmt->bindValue($identifier, $this->dcreateddate ? $this->dcreateddate->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'dmodifydate':
                        $stmt->bindValue($identifier, $this->dmodifydate ? $this->dmodifydate->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'country_id':
                        $stmt->bindValue($identifier, $this->country_id, PDO::PARAM_INT);

                        break;
                    case 'sstatus':
                        $stmt->bindValue($identifier, $this->sstatus, PDO::PARAM_STR);

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
        $pos = GeoStateTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIstateid();

            case 1:
                return $this->getSstatename();

            case 2:
                return $this->getSstatecode();

            case 3:
                return $this->getDcreateddate();

            case 4:
                return $this->getDmodifydate();

            case 5:
                return $this->getCountryId();

            case 6:
                return $this->getSstatus();

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
        if (isset($alreadyDumpedObjects['GeoState'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['GeoState'][$this->hashCode()] = true;
        $keys = GeoStateTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getIstateid(),
            $keys[1] => $this->getSstatename(),
            $keys[2] => $this->getSstatecode(),
            $keys[3] => $this->getDcreateddate(),
            $keys[4] => $this->getDmodifydate(),
            $keys[5] => $this->getCountryId(),
            $keys[6] => $this->getSstatus(),
        ];
        if ($result[$keys[3]] instanceof \DateTimeInterface) {
            $result[$keys[3]] = $result[$keys[3]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[4]] instanceof \DateTimeInterface) {
            $result[$keys[4]] = $result[$keys[4]]->format('Y-m-d H:i:s.u');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aGeoCountry) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'geoCountry';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'geo_country';
                        break;
                    default:
                        $key = 'GeoCountry';
                }

                $result[$key] = $this->aGeoCountry->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collBranches) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'branches';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'branches';
                        break;
                    default:
                        $key = 'Branches';
                }

                $result[$key] = $this->collBranches->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collGeoCities) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'geoCities';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'geo_cities';
                        break;
                    default:
                        $key = 'GeoCities';
                }

                $result[$key] = $this->collGeoCities->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collGeoDistancesRelatedByFromStateId) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'geoDistances';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'geo_distances';
                        break;
                    default:
                        $key = 'GeoDistances';
                }

                $result[$key] = $this->collGeoDistancesRelatedByFromStateId->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collGeoDistancesRelatedByToStateId) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'geoDistances';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'geo_distances';
                        break;
                    default:
                        $key = 'GeoDistances';
                }

                $result[$key] = $this->collGeoDistancesRelatedByToStateId->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collHolidayss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'holidayss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'holidayss';
                        break;
                    default:
                        $key = 'Holidayss';
                }

                $result[$key] = $this->collHolidayss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = GeoStateTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setIstateid($value);
                break;
            case 1:
                $this->setSstatename($value);
                break;
            case 2:
                $this->setSstatecode($value);
                break;
            case 3:
                $this->setDcreateddate($value);
                break;
            case 4:
                $this->setDmodifydate($value);
                break;
            case 5:
                $this->setCountryId($value);
                break;
            case 6:
                $this->setSstatus($value);
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
        $keys = GeoStateTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIstateid($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setSstatename($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setSstatecode($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setDcreateddate($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setDmodifydate($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setCountryId($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setSstatus($arr[$keys[6]]);
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
        $criteria = new Criteria(GeoStateTableMap::DATABASE_NAME);

        if ($this->isColumnModified(GeoStateTableMap::COL_ISTATEID)) {
            $criteria->add(GeoStateTableMap::COL_ISTATEID, $this->istateid);
        }
        if ($this->isColumnModified(GeoStateTableMap::COL_SSTATENAME)) {
            $criteria->add(GeoStateTableMap::COL_SSTATENAME, $this->sstatename);
        }
        if ($this->isColumnModified(GeoStateTableMap::COL_SSTATECODE)) {
            $criteria->add(GeoStateTableMap::COL_SSTATECODE, $this->sstatecode);
        }
        if ($this->isColumnModified(GeoStateTableMap::COL_DCREATEDDATE)) {
            $criteria->add(GeoStateTableMap::COL_DCREATEDDATE, $this->dcreateddate);
        }
        if ($this->isColumnModified(GeoStateTableMap::COL_DMODIFYDATE)) {
            $criteria->add(GeoStateTableMap::COL_DMODIFYDATE, $this->dmodifydate);
        }
        if ($this->isColumnModified(GeoStateTableMap::COL_COUNTRY_ID)) {
            $criteria->add(GeoStateTableMap::COL_COUNTRY_ID, $this->country_id);
        }
        if ($this->isColumnModified(GeoStateTableMap::COL_SSTATUS)) {
            $criteria->add(GeoStateTableMap::COL_SSTATUS, $this->sstatus);
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
        $criteria = ChildGeoStateQuery::create();
        $criteria->add(GeoStateTableMap::COL_ISTATEID, $this->istateid);

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
        $validPk = null !== $this->getIstateid();

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
        return $this->getIstateid();
    }

    /**
     * Generic method to set the primary key (istateid column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setIstateid($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getIstateid();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \entities\GeoState (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setSstatename($this->getSstatename());
        $copyObj->setSstatecode($this->getSstatecode());
        $copyObj->setDcreateddate($this->getDcreateddate());
        $copyObj->setDmodifydate($this->getDmodifydate());
        $copyObj->setCountryId($this->getCountryId());
        $copyObj->setSstatus($this->getSstatus());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getBranches() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBranch($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getGeoCities() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addGeoCity($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getGeoDistancesRelatedByFromStateId() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addGeoDistanceRelatedByFromStateId($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getGeoDistancesRelatedByToStateId() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addGeoDistanceRelatedByToStateId($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getHolidayss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addHolidays($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getOnBoardRequestAddresses() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOnBoardRequestAddress($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIstateid(NULL); // this is a auto-increment column, so set to default value
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
     * @return \entities\GeoState Clone of current object.
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
     * Declares an association between this object and a ChildGeoCountry object.
     *
     * @param ChildGeoCountry|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setGeoCountry(ChildGeoCountry $v = null)
    {
        if ($v === null) {
            $this->setCountryId(NULL);
        } else {
            $this->setCountryId($v->getIcountryid());
        }

        $this->aGeoCountry = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildGeoCountry object, it will not be re-added.
        if ($v !== null) {
            $v->addGeoState($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildGeoCountry object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildGeoCountry|null The associated ChildGeoCountry object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getGeoCountry(?ConnectionInterface $con = null)
    {
        if ($this->aGeoCountry === null && ($this->country_id != 0)) {
            $this->aGeoCountry = ChildGeoCountryQuery::create()->findPk($this->country_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aGeoCountry->addGeoStates($this);
             */
        }

        return $this->aGeoCountry;
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
        if ('Branch' === $relationName) {
            $this->initBranches();
            return;
        }
        if ('GeoCity' === $relationName) {
            $this->initGeoCities();
            return;
        }
        if ('GeoDistanceRelatedByFromStateId' === $relationName) {
            $this->initGeoDistancesRelatedByFromStateId();
            return;
        }
        if ('GeoDistanceRelatedByToStateId' === $relationName) {
            $this->initGeoDistancesRelatedByToStateId();
            return;
        }
        if ('Holidays' === $relationName) {
            $this->initHolidayss();
            return;
        }
        if ('OnBoardRequestAddress' === $relationName) {
            $this->initOnBoardRequestAddresses();
            return;
        }
    }

    /**
     * Clears out the collBranches collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addBranches()
     */
    public function clearBranches()
    {
        $this->collBranches = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collBranches collection loaded partially.
     *
     * @return void
     */
    public function resetPartialBranches($v = true): void
    {
        $this->collBranchesPartial = $v;
    }

    /**
     * Initializes the collBranches collection.
     *
     * By default this just sets the collBranches collection to an empty array (like clearcollBranches());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBranches(bool $overrideExisting = true): void
    {
        if (null !== $this->collBranches && !$overrideExisting) {
            return;
        }

        $collectionClassName = BranchTableMap::getTableMap()->getCollectionClassName();

        $this->collBranches = new $collectionClassName;
        $this->collBranches->setModel('\entities\Branch');
    }

    /**
     * Gets an array of ChildBranch objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildGeoState is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildBranch[] List of ChildBranch objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBranch> List of ChildBranch objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getBranches(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collBranchesPartial && !$this->isNew();
        if (null === $this->collBranches || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collBranches) {
                    $this->initBranches();
                } else {
                    $collectionClassName = BranchTableMap::getTableMap()->getCollectionClassName();

                    $collBranches = new $collectionClassName;
                    $collBranches->setModel('\entities\Branch');

                    return $collBranches;
                }
            } else {
                $collBranches = ChildBranchQuery::create(null, $criteria)
                    ->filterByGeoState($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collBranchesPartial && count($collBranches)) {
                        $this->initBranches(false);

                        foreach ($collBranches as $obj) {
                            if (false == $this->collBranches->contains($obj)) {
                                $this->collBranches->append($obj);
                            }
                        }

                        $this->collBranchesPartial = true;
                    }

                    return $collBranches;
                }

                if ($partial && $this->collBranches) {
                    foreach ($this->collBranches as $obj) {
                        if ($obj->isNew()) {
                            $collBranches[] = $obj;
                        }
                    }
                }

                $this->collBranches = $collBranches;
                $this->collBranchesPartial = false;
            }
        }

        return $this->collBranches;
    }

    /**
     * Sets a collection of ChildBranch objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $branches A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setBranches(Collection $branches, ?ConnectionInterface $con = null)
    {
        /** @var ChildBranch[] $branchesToDelete */
        $branchesToDelete = $this->getBranches(new Criteria(), $con)->diff($branches);


        $this->branchesScheduledForDeletion = $branchesToDelete;

        foreach ($branchesToDelete as $branchRemoved) {
            $branchRemoved->setGeoState(null);
        }

        $this->collBranches = null;
        foreach ($branches as $branch) {
            $this->addBranch($branch);
        }

        $this->collBranches = $branches;
        $this->collBranchesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Branch objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related Branch objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countBranches(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collBranchesPartial && !$this->isNew();
        if (null === $this->collBranches || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBranches) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getBranches());
            }

            $query = ChildBranchQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByGeoState($this)
                ->count($con);
        }

        return count($this->collBranches);
    }

    /**
     * Method called to associate a ChildBranch object to this object
     * through the ChildBranch foreign key attribute.
     *
     * @param ChildBranch $l ChildBranch
     * @return $this The current object (for fluent API support)
     */
    public function addBranch(ChildBranch $l)
    {
        if ($this->collBranches === null) {
            $this->initBranches();
            $this->collBranchesPartial = true;
        }

        if (!$this->collBranches->contains($l)) {
            $this->doAddBranch($l);

            if ($this->branchesScheduledForDeletion and $this->branchesScheduledForDeletion->contains($l)) {
                $this->branchesScheduledForDeletion->remove($this->branchesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildBranch $branch The ChildBranch object to add.
     */
    protected function doAddBranch(ChildBranch $branch): void
    {
        $this->collBranches[]= $branch;
        $branch->setGeoState($this);
    }

    /**
     * @param ChildBranch $branch The ChildBranch object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeBranch(ChildBranch $branch)
    {
        if ($this->getBranches()->contains($branch)) {
            $pos = $this->collBranches->search($branch);
            $this->collBranches->remove($pos);
            if (null === $this->branchesScheduledForDeletion) {
                $this->branchesScheduledForDeletion = clone $this->collBranches;
                $this->branchesScheduledForDeletion->clear();
            }
            $this->branchesScheduledForDeletion[]= $branch;
            $branch->setGeoState(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this GeoState is new, it will return
     * an empty collection; or if this GeoState has previously
     * been saved, it will retrieve related Branches from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GeoState.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBranch[] List of ChildBranch objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBranch}> List of ChildBranch objects
     */
    public function getBranchesJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBranchQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getBranches($query, $con);
    }

    /**
     * Clears out the collGeoCities collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addGeoCities()
     */
    public function clearGeoCities()
    {
        $this->collGeoCities = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collGeoCities collection loaded partially.
     *
     * @return void
     */
    public function resetPartialGeoCities($v = true): void
    {
        $this->collGeoCitiesPartial = $v;
    }

    /**
     * Initializes the collGeoCities collection.
     *
     * By default this just sets the collGeoCities collection to an empty array (like clearcollGeoCities());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initGeoCities(bool $overrideExisting = true): void
    {
        if (null !== $this->collGeoCities && !$overrideExisting) {
            return;
        }

        $collectionClassName = GeoCityTableMap::getTableMap()->getCollectionClassName();

        $this->collGeoCities = new $collectionClassName;
        $this->collGeoCities->setModel('\entities\GeoCity');
    }

    /**
     * Gets an array of ChildGeoCity objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildGeoState is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildGeoCity[] List of ChildGeoCity objects
     * @phpstan-return ObjectCollection&\Traversable<ChildGeoCity> List of ChildGeoCity objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getGeoCities(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collGeoCitiesPartial && !$this->isNew();
        if (null === $this->collGeoCities || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collGeoCities) {
                    $this->initGeoCities();
                } else {
                    $collectionClassName = GeoCityTableMap::getTableMap()->getCollectionClassName();

                    $collGeoCities = new $collectionClassName;
                    $collGeoCities->setModel('\entities\GeoCity');

                    return $collGeoCities;
                }
            } else {
                $collGeoCities = ChildGeoCityQuery::create(null, $criteria)
                    ->filterByGeoState($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collGeoCitiesPartial && count($collGeoCities)) {
                        $this->initGeoCities(false);

                        foreach ($collGeoCities as $obj) {
                            if (false == $this->collGeoCities->contains($obj)) {
                                $this->collGeoCities->append($obj);
                            }
                        }

                        $this->collGeoCitiesPartial = true;
                    }

                    return $collGeoCities;
                }

                if ($partial && $this->collGeoCities) {
                    foreach ($this->collGeoCities as $obj) {
                        if ($obj->isNew()) {
                            $collGeoCities[] = $obj;
                        }
                    }
                }

                $this->collGeoCities = $collGeoCities;
                $this->collGeoCitiesPartial = false;
            }
        }

        return $this->collGeoCities;
    }

    /**
     * Sets a collection of ChildGeoCity objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $geoCities A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setGeoCities(Collection $geoCities, ?ConnectionInterface $con = null)
    {
        /** @var ChildGeoCity[] $geoCitiesToDelete */
        $geoCitiesToDelete = $this->getGeoCities(new Criteria(), $con)->diff($geoCities);


        $this->geoCitiesScheduledForDeletion = $geoCitiesToDelete;

        foreach ($geoCitiesToDelete as $geoCityRemoved) {
            $geoCityRemoved->setGeoState(null);
        }

        $this->collGeoCities = null;
        foreach ($geoCities as $geoCity) {
            $this->addGeoCity($geoCity);
        }

        $this->collGeoCities = $geoCities;
        $this->collGeoCitiesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related GeoCity objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related GeoCity objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countGeoCities(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collGeoCitiesPartial && !$this->isNew();
        if (null === $this->collGeoCities || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collGeoCities) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getGeoCities());
            }

            $query = ChildGeoCityQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByGeoState($this)
                ->count($con);
        }

        return count($this->collGeoCities);
    }

    /**
     * Method called to associate a ChildGeoCity object to this object
     * through the ChildGeoCity foreign key attribute.
     *
     * @param ChildGeoCity $l ChildGeoCity
     * @return $this The current object (for fluent API support)
     */
    public function addGeoCity(ChildGeoCity $l)
    {
        if ($this->collGeoCities === null) {
            $this->initGeoCities();
            $this->collGeoCitiesPartial = true;
        }

        if (!$this->collGeoCities->contains($l)) {
            $this->doAddGeoCity($l);

            if ($this->geoCitiesScheduledForDeletion and $this->geoCitiesScheduledForDeletion->contains($l)) {
                $this->geoCitiesScheduledForDeletion->remove($this->geoCitiesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildGeoCity $geoCity The ChildGeoCity object to add.
     */
    protected function doAddGeoCity(ChildGeoCity $geoCity): void
    {
        $this->collGeoCities[]= $geoCity;
        $geoCity->setGeoState($this);
    }

    /**
     * @param ChildGeoCity $geoCity The ChildGeoCity object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeGeoCity(ChildGeoCity $geoCity)
    {
        if ($this->getGeoCities()->contains($geoCity)) {
            $pos = $this->collGeoCities->search($geoCity);
            $this->collGeoCities->remove($pos);
            if (null === $this->geoCitiesScheduledForDeletion) {
                $this->geoCitiesScheduledForDeletion = clone $this->collGeoCities;
                $this->geoCitiesScheduledForDeletion->clear();
            }
            $this->geoCitiesScheduledForDeletion[]= $geoCity;
            $geoCity->setGeoState(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this GeoState is new, it will return
     * an empty collection; or if this GeoState has previously
     * been saved, it will retrieve related GeoCities from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GeoState.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildGeoCity[] List of ChildGeoCity objects
     * @phpstan-return ObjectCollection&\Traversable<ChildGeoCity}> List of ChildGeoCity objects
     */
    public function getGeoCitiesJoinGeoCountry(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildGeoCityQuery::create(null, $criteria);
        $query->joinWith('GeoCountry', $joinBehavior);

        return $this->getGeoCities($query, $con);
    }

    /**
     * Clears out the collGeoDistancesRelatedByFromStateId collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addGeoDistancesRelatedByFromStateId()
     */
    public function clearGeoDistancesRelatedByFromStateId()
    {
        $this->collGeoDistancesRelatedByFromStateId = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collGeoDistancesRelatedByFromStateId collection loaded partially.
     *
     * @return void
     */
    public function resetPartialGeoDistancesRelatedByFromStateId($v = true): void
    {
        $this->collGeoDistancesRelatedByFromStateIdPartial = $v;
    }

    /**
     * Initializes the collGeoDistancesRelatedByFromStateId collection.
     *
     * By default this just sets the collGeoDistancesRelatedByFromStateId collection to an empty array (like clearcollGeoDistancesRelatedByFromStateId());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initGeoDistancesRelatedByFromStateId(bool $overrideExisting = true): void
    {
        if (null !== $this->collGeoDistancesRelatedByFromStateId && !$overrideExisting) {
            return;
        }

        $collectionClassName = GeoDistanceTableMap::getTableMap()->getCollectionClassName();

        $this->collGeoDistancesRelatedByFromStateId = new $collectionClassName;
        $this->collGeoDistancesRelatedByFromStateId->setModel('\entities\GeoDistance');
    }

    /**
     * Gets an array of ChildGeoDistance objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildGeoState is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildGeoDistance[] List of ChildGeoDistance objects
     * @phpstan-return ObjectCollection&\Traversable<ChildGeoDistance> List of ChildGeoDistance objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getGeoDistancesRelatedByFromStateId(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collGeoDistancesRelatedByFromStateIdPartial && !$this->isNew();
        if (null === $this->collGeoDistancesRelatedByFromStateId || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collGeoDistancesRelatedByFromStateId) {
                    $this->initGeoDistancesRelatedByFromStateId();
                } else {
                    $collectionClassName = GeoDistanceTableMap::getTableMap()->getCollectionClassName();

                    $collGeoDistancesRelatedByFromStateId = new $collectionClassName;
                    $collGeoDistancesRelatedByFromStateId->setModel('\entities\GeoDistance');

                    return $collGeoDistancesRelatedByFromStateId;
                }
            } else {
                $collGeoDistancesRelatedByFromStateId = ChildGeoDistanceQuery::create(null, $criteria)
                    ->filterByGeoStateRelatedByFromStateId($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collGeoDistancesRelatedByFromStateIdPartial && count($collGeoDistancesRelatedByFromStateId)) {
                        $this->initGeoDistancesRelatedByFromStateId(false);

                        foreach ($collGeoDistancesRelatedByFromStateId as $obj) {
                            if (false == $this->collGeoDistancesRelatedByFromStateId->contains($obj)) {
                                $this->collGeoDistancesRelatedByFromStateId->append($obj);
                            }
                        }

                        $this->collGeoDistancesRelatedByFromStateIdPartial = true;
                    }

                    return $collGeoDistancesRelatedByFromStateId;
                }

                if ($partial && $this->collGeoDistancesRelatedByFromStateId) {
                    foreach ($this->collGeoDistancesRelatedByFromStateId as $obj) {
                        if ($obj->isNew()) {
                            $collGeoDistancesRelatedByFromStateId[] = $obj;
                        }
                    }
                }

                $this->collGeoDistancesRelatedByFromStateId = $collGeoDistancesRelatedByFromStateId;
                $this->collGeoDistancesRelatedByFromStateIdPartial = false;
            }
        }

        return $this->collGeoDistancesRelatedByFromStateId;
    }

    /**
     * Sets a collection of ChildGeoDistance objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $geoDistancesRelatedByFromStateId A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setGeoDistancesRelatedByFromStateId(Collection $geoDistancesRelatedByFromStateId, ?ConnectionInterface $con = null)
    {
        /** @var ChildGeoDistance[] $geoDistancesRelatedByFromStateIdToDelete */
        $geoDistancesRelatedByFromStateIdToDelete = $this->getGeoDistancesRelatedByFromStateId(new Criteria(), $con)->diff($geoDistancesRelatedByFromStateId);


        $this->geoDistancesRelatedByFromStateIdScheduledForDeletion = $geoDistancesRelatedByFromStateIdToDelete;

        foreach ($geoDistancesRelatedByFromStateIdToDelete as $geoDistanceRelatedByFromStateIdRemoved) {
            $geoDistanceRelatedByFromStateIdRemoved->setGeoStateRelatedByFromStateId(null);
        }

        $this->collGeoDistancesRelatedByFromStateId = null;
        foreach ($geoDistancesRelatedByFromStateId as $geoDistanceRelatedByFromStateId) {
            $this->addGeoDistanceRelatedByFromStateId($geoDistanceRelatedByFromStateId);
        }

        $this->collGeoDistancesRelatedByFromStateId = $geoDistancesRelatedByFromStateId;
        $this->collGeoDistancesRelatedByFromStateIdPartial = false;

        return $this;
    }

    /**
     * Returns the number of related GeoDistance objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related GeoDistance objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countGeoDistancesRelatedByFromStateId(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collGeoDistancesRelatedByFromStateIdPartial && !$this->isNew();
        if (null === $this->collGeoDistancesRelatedByFromStateId || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collGeoDistancesRelatedByFromStateId) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getGeoDistancesRelatedByFromStateId());
            }

            $query = ChildGeoDistanceQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByGeoStateRelatedByFromStateId($this)
                ->count($con);
        }

        return count($this->collGeoDistancesRelatedByFromStateId);
    }

    /**
     * Method called to associate a ChildGeoDistance object to this object
     * through the ChildGeoDistance foreign key attribute.
     *
     * @param ChildGeoDistance $l ChildGeoDistance
     * @return $this The current object (for fluent API support)
     */
    public function addGeoDistanceRelatedByFromStateId(ChildGeoDistance $l)
    {
        if ($this->collGeoDistancesRelatedByFromStateId === null) {
            $this->initGeoDistancesRelatedByFromStateId();
            $this->collGeoDistancesRelatedByFromStateIdPartial = true;
        }

        if (!$this->collGeoDistancesRelatedByFromStateId->contains($l)) {
            $this->doAddGeoDistanceRelatedByFromStateId($l);

            if ($this->geoDistancesRelatedByFromStateIdScheduledForDeletion and $this->geoDistancesRelatedByFromStateIdScheduledForDeletion->contains($l)) {
                $this->geoDistancesRelatedByFromStateIdScheduledForDeletion->remove($this->geoDistancesRelatedByFromStateIdScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildGeoDistance $geoDistanceRelatedByFromStateId The ChildGeoDistance object to add.
     */
    protected function doAddGeoDistanceRelatedByFromStateId(ChildGeoDistance $geoDistanceRelatedByFromStateId): void
    {
        $this->collGeoDistancesRelatedByFromStateId[]= $geoDistanceRelatedByFromStateId;
        $geoDistanceRelatedByFromStateId->setGeoStateRelatedByFromStateId($this);
    }

    /**
     * @param ChildGeoDistance $geoDistanceRelatedByFromStateId The ChildGeoDistance object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeGeoDistanceRelatedByFromStateId(ChildGeoDistance $geoDistanceRelatedByFromStateId)
    {
        if ($this->getGeoDistancesRelatedByFromStateId()->contains($geoDistanceRelatedByFromStateId)) {
            $pos = $this->collGeoDistancesRelatedByFromStateId->search($geoDistanceRelatedByFromStateId);
            $this->collGeoDistancesRelatedByFromStateId->remove($pos);
            if (null === $this->geoDistancesRelatedByFromStateIdScheduledForDeletion) {
                $this->geoDistancesRelatedByFromStateIdScheduledForDeletion = clone $this->collGeoDistancesRelatedByFromStateId;
                $this->geoDistancesRelatedByFromStateIdScheduledForDeletion->clear();
            }
            $this->geoDistancesRelatedByFromStateIdScheduledForDeletion[]= $geoDistanceRelatedByFromStateId;
            $geoDistanceRelatedByFromStateId->setGeoStateRelatedByFromStateId(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this GeoState is new, it will return
     * an empty collection; or if this GeoState has previously
     * been saved, it will retrieve related GeoDistancesRelatedByFromStateId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GeoState.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildGeoDistance[] List of ChildGeoDistance objects
     * @phpstan-return ObjectCollection&\Traversable<ChildGeoDistance}> List of ChildGeoDistance objects
     */
    public function getGeoDistancesRelatedByFromStateIdJoinGeoTownsRelatedByFromTownId(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildGeoDistanceQuery::create(null, $criteria);
        $query->joinWith('GeoTownsRelatedByFromTownId', $joinBehavior);

        return $this->getGeoDistancesRelatedByFromStateId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this GeoState is new, it will return
     * an empty collection; or if this GeoState has previously
     * been saved, it will retrieve related GeoDistancesRelatedByFromStateId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GeoState.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildGeoDistance[] List of ChildGeoDistance objects
     * @phpstan-return ObjectCollection&\Traversable<ChildGeoDistance}> List of ChildGeoDistance objects
     */
    public function getGeoDistancesRelatedByFromStateIdJoinGeoTownsRelatedByToTownId(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildGeoDistanceQuery::create(null, $criteria);
        $query->joinWith('GeoTownsRelatedByToTownId', $joinBehavior);

        return $this->getGeoDistancesRelatedByFromStateId($query, $con);
    }

    /**
     * Clears out the collGeoDistancesRelatedByToStateId collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addGeoDistancesRelatedByToStateId()
     */
    public function clearGeoDistancesRelatedByToStateId()
    {
        $this->collGeoDistancesRelatedByToStateId = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collGeoDistancesRelatedByToStateId collection loaded partially.
     *
     * @return void
     */
    public function resetPartialGeoDistancesRelatedByToStateId($v = true): void
    {
        $this->collGeoDistancesRelatedByToStateIdPartial = $v;
    }

    /**
     * Initializes the collGeoDistancesRelatedByToStateId collection.
     *
     * By default this just sets the collGeoDistancesRelatedByToStateId collection to an empty array (like clearcollGeoDistancesRelatedByToStateId());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initGeoDistancesRelatedByToStateId(bool $overrideExisting = true): void
    {
        if (null !== $this->collGeoDistancesRelatedByToStateId && !$overrideExisting) {
            return;
        }

        $collectionClassName = GeoDistanceTableMap::getTableMap()->getCollectionClassName();

        $this->collGeoDistancesRelatedByToStateId = new $collectionClassName;
        $this->collGeoDistancesRelatedByToStateId->setModel('\entities\GeoDistance');
    }

    /**
     * Gets an array of ChildGeoDistance objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildGeoState is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildGeoDistance[] List of ChildGeoDistance objects
     * @phpstan-return ObjectCollection&\Traversable<ChildGeoDistance> List of ChildGeoDistance objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getGeoDistancesRelatedByToStateId(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collGeoDistancesRelatedByToStateIdPartial && !$this->isNew();
        if (null === $this->collGeoDistancesRelatedByToStateId || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collGeoDistancesRelatedByToStateId) {
                    $this->initGeoDistancesRelatedByToStateId();
                } else {
                    $collectionClassName = GeoDistanceTableMap::getTableMap()->getCollectionClassName();

                    $collGeoDistancesRelatedByToStateId = new $collectionClassName;
                    $collGeoDistancesRelatedByToStateId->setModel('\entities\GeoDistance');

                    return $collGeoDistancesRelatedByToStateId;
                }
            } else {
                $collGeoDistancesRelatedByToStateId = ChildGeoDistanceQuery::create(null, $criteria)
                    ->filterByGeoStateRelatedByToStateId($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collGeoDistancesRelatedByToStateIdPartial && count($collGeoDistancesRelatedByToStateId)) {
                        $this->initGeoDistancesRelatedByToStateId(false);

                        foreach ($collGeoDistancesRelatedByToStateId as $obj) {
                            if (false == $this->collGeoDistancesRelatedByToStateId->contains($obj)) {
                                $this->collGeoDistancesRelatedByToStateId->append($obj);
                            }
                        }

                        $this->collGeoDistancesRelatedByToStateIdPartial = true;
                    }

                    return $collGeoDistancesRelatedByToStateId;
                }

                if ($partial && $this->collGeoDistancesRelatedByToStateId) {
                    foreach ($this->collGeoDistancesRelatedByToStateId as $obj) {
                        if ($obj->isNew()) {
                            $collGeoDistancesRelatedByToStateId[] = $obj;
                        }
                    }
                }

                $this->collGeoDistancesRelatedByToStateId = $collGeoDistancesRelatedByToStateId;
                $this->collGeoDistancesRelatedByToStateIdPartial = false;
            }
        }

        return $this->collGeoDistancesRelatedByToStateId;
    }

    /**
     * Sets a collection of ChildGeoDistance objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $geoDistancesRelatedByToStateId A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setGeoDistancesRelatedByToStateId(Collection $geoDistancesRelatedByToStateId, ?ConnectionInterface $con = null)
    {
        /** @var ChildGeoDistance[] $geoDistancesRelatedByToStateIdToDelete */
        $geoDistancesRelatedByToStateIdToDelete = $this->getGeoDistancesRelatedByToStateId(new Criteria(), $con)->diff($geoDistancesRelatedByToStateId);


        $this->geoDistancesRelatedByToStateIdScheduledForDeletion = $geoDistancesRelatedByToStateIdToDelete;

        foreach ($geoDistancesRelatedByToStateIdToDelete as $geoDistanceRelatedByToStateIdRemoved) {
            $geoDistanceRelatedByToStateIdRemoved->setGeoStateRelatedByToStateId(null);
        }

        $this->collGeoDistancesRelatedByToStateId = null;
        foreach ($geoDistancesRelatedByToStateId as $geoDistanceRelatedByToStateId) {
            $this->addGeoDistanceRelatedByToStateId($geoDistanceRelatedByToStateId);
        }

        $this->collGeoDistancesRelatedByToStateId = $geoDistancesRelatedByToStateId;
        $this->collGeoDistancesRelatedByToStateIdPartial = false;

        return $this;
    }

    /**
     * Returns the number of related GeoDistance objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related GeoDistance objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countGeoDistancesRelatedByToStateId(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collGeoDistancesRelatedByToStateIdPartial && !$this->isNew();
        if (null === $this->collGeoDistancesRelatedByToStateId || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collGeoDistancesRelatedByToStateId) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getGeoDistancesRelatedByToStateId());
            }

            $query = ChildGeoDistanceQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByGeoStateRelatedByToStateId($this)
                ->count($con);
        }

        return count($this->collGeoDistancesRelatedByToStateId);
    }

    /**
     * Method called to associate a ChildGeoDistance object to this object
     * through the ChildGeoDistance foreign key attribute.
     *
     * @param ChildGeoDistance $l ChildGeoDistance
     * @return $this The current object (for fluent API support)
     */
    public function addGeoDistanceRelatedByToStateId(ChildGeoDistance $l)
    {
        if ($this->collGeoDistancesRelatedByToStateId === null) {
            $this->initGeoDistancesRelatedByToStateId();
            $this->collGeoDistancesRelatedByToStateIdPartial = true;
        }

        if (!$this->collGeoDistancesRelatedByToStateId->contains($l)) {
            $this->doAddGeoDistanceRelatedByToStateId($l);

            if ($this->geoDistancesRelatedByToStateIdScheduledForDeletion and $this->geoDistancesRelatedByToStateIdScheduledForDeletion->contains($l)) {
                $this->geoDistancesRelatedByToStateIdScheduledForDeletion->remove($this->geoDistancesRelatedByToStateIdScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildGeoDistance $geoDistanceRelatedByToStateId The ChildGeoDistance object to add.
     */
    protected function doAddGeoDistanceRelatedByToStateId(ChildGeoDistance $geoDistanceRelatedByToStateId): void
    {
        $this->collGeoDistancesRelatedByToStateId[]= $geoDistanceRelatedByToStateId;
        $geoDistanceRelatedByToStateId->setGeoStateRelatedByToStateId($this);
    }

    /**
     * @param ChildGeoDistance $geoDistanceRelatedByToStateId The ChildGeoDistance object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeGeoDistanceRelatedByToStateId(ChildGeoDistance $geoDistanceRelatedByToStateId)
    {
        if ($this->getGeoDistancesRelatedByToStateId()->contains($geoDistanceRelatedByToStateId)) {
            $pos = $this->collGeoDistancesRelatedByToStateId->search($geoDistanceRelatedByToStateId);
            $this->collGeoDistancesRelatedByToStateId->remove($pos);
            if (null === $this->geoDistancesRelatedByToStateIdScheduledForDeletion) {
                $this->geoDistancesRelatedByToStateIdScheduledForDeletion = clone $this->collGeoDistancesRelatedByToStateId;
                $this->geoDistancesRelatedByToStateIdScheduledForDeletion->clear();
            }
            $this->geoDistancesRelatedByToStateIdScheduledForDeletion[]= $geoDistanceRelatedByToStateId;
            $geoDistanceRelatedByToStateId->setGeoStateRelatedByToStateId(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this GeoState is new, it will return
     * an empty collection; or if this GeoState has previously
     * been saved, it will retrieve related GeoDistancesRelatedByToStateId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GeoState.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildGeoDistance[] List of ChildGeoDistance objects
     * @phpstan-return ObjectCollection&\Traversable<ChildGeoDistance}> List of ChildGeoDistance objects
     */
    public function getGeoDistancesRelatedByToStateIdJoinGeoTownsRelatedByFromTownId(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildGeoDistanceQuery::create(null, $criteria);
        $query->joinWith('GeoTownsRelatedByFromTownId', $joinBehavior);

        return $this->getGeoDistancesRelatedByToStateId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this GeoState is new, it will return
     * an empty collection; or if this GeoState has previously
     * been saved, it will retrieve related GeoDistancesRelatedByToStateId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GeoState.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildGeoDistance[] List of ChildGeoDistance objects
     * @phpstan-return ObjectCollection&\Traversable<ChildGeoDistance}> List of ChildGeoDistance objects
     */
    public function getGeoDistancesRelatedByToStateIdJoinGeoTownsRelatedByToTownId(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildGeoDistanceQuery::create(null, $criteria);
        $query->joinWith('GeoTownsRelatedByToTownId', $joinBehavior);

        return $this->getGeoDistancesRelatedByToStateId($query, $con);
    }

    /**
     * Clears out the collHolidayss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addHolidayss()
     */
    public function clearHolidayss()
    {
        $this->collHolidayss = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collHolidayss collection loaded partially.
     *
     * @return void
     */
    public function resetPartialHolidayss($v = true): void
    {
        $this->collHolidayssPartial = $v;
    }

    /**
     * Initializes the collHolidayss collection.
     *
     * By default this just sets the collHolidayss collection to an empty array (like clearcollHolidayss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initHolidayss(bool $overrideExisting = true): void
    {
        if (null !== $this->collHolidayss && !$overrideExisting) {
            return;
        }

        $collectionClassName = HolidaysTableMap::getTableMap()->getCollectionClassName();

        $this->collHolidayss = new $collectionClassName;
        $this->collHolidayss->setModel('\entities\Holidays');
    }

    /**
     * Gets an array of ChildHolidays objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildGeoState is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildHolidays[] List of ChildHolidays objects
     * @phpstan-return ObjectCollection&\Traversable<ChildHolidays> List of ChildHolidays objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getHolidayss(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collHolidayssPartial && !$this->isNew();
        if (null === $this->collHolidayss || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collHolidayss) {
                    $this->initHolidayss();
                } else {
                    $collectionClassName = HolidaysTableMap::getTableMap()->getCollectionClassName();

                    $collHolidayss = new $collectionClassName;
                    $collHolidayss->setModel('\entities\Holidays');

                    return $collHolidayss;
                }
            } else {
                $collHolidayss = ChildHolidaysQuery::create(null, $criteria)
                    ->filterByGeoState($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collHolidayssPartial && count($collHolidayss)) {
                        $this->initHolidayss(false);

                        foreach ($collHolidayss as $obj) {
                            if (false == $this->collHolidayss->contains($obj)) {
                                $this->collHolidayss->append($obj);
                            }
                        }

                        $this->collHolidayssPartial = true;
                    }

                    return $collHolidayss;
                }

                if ($partial && $this->collHolidayss) {
                    foreach ($this->collHolidayss as $obj) {
                        if ($obj->isNew()) {
                            $collHolidayss[] = $obj;
                        }
                    }
                }

                $this->collHolidayss = $collHolidayss;
                $this->collHolidayssPartial = false;
            }
        }

        return $this->collHolidayss;
    }

    /**
     * Sets a collection of ChildHolidays objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $holidayss A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setHolidayss(Collection $holidayss, ?ConnectionInterface $con = null)
    {
        /** @var ChildHolidays[] $holidayssToDelete */
        $holidayssToDelete = $this->getHolidayss(new Criteria(), $con)->diff($holidayss);


        $this->holidayssScheduledForDeletion = $holidayssToDelete;

        foreach ($holidayssToDelete as $holidaysRemoved) {
            $holidaysRemoved->setGeoState(null);
        }

        $this->collHolidayss = null;
        foreach ($holidayss as $holidays) {
            $this->addHolidays($holidays);
        }

        $this->collHolidayss = $holidayss;
        $this->collHolidayssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Holidays objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related Holidays objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countHolidayss(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collHolidayssPartial && !$this->isNew();
        if (null === $this->collHolidayss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collHolidayss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getHolidayss());
            }

            $query = ChildHolidaysQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByGeoState($this)
                ->count($con);
        }

        return count($this->collHolidayss);
    }

    /**
     * Method called to associate a ChildHolidays object to this object
     * through the ChildHolidays foreign key attribute.
     *
     * @param ChildHolidays $l ChildHolidays
     * @return $this The current object (for fluent API support)
     */
    public function addHolidays(ChildHolidays $l)
    {
        if ($this->collHolidayss === null) {
            $this->initHolidayss();
            $this->collHolidayssPartial = true;
        }

        if (!$this->collHolidayss->contains($l)) {
            $this->doAddHolidays($l);

            if ($this->holidayssScheduledForDeletion and $this->holidayssScheduledForDeletion->contains($l)) {
                $this->holidayssScheduledForDeletion->remove($this->holidayssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildHolidays $holidays The ChildHolidays object to add.
     */
    protected function doAddHolidays(ChildHolidays $holidays): void
    {
        $this->collHolidayss[]= $holidays;
        $holidays->setGeoState($this);
    }

    /**
     * @param ChildHolidays $holidays The ChildHolidays object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeHolidays(ChildHolidays $holidays)
    {
        if ($this->getHolidayss()->contains($holidays)) {
            $pos = $this->collHolidayss->search($holidays);
            $this->collHolidayss->remove($pos);
            if (null === $this->holidayssScheduledForDeletion) {
                $this->holidayssScheduledForDeletion = clone $this->collHolidayss;
                $this->holidayssScheduledForDeletion->clear();
            }
            $this->holidayssScheduledForDeletion[]= $holidays;
            $holidays->setGeoState(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this GeoState is new, it will return
     * an empty collection; or if this GeoState has previously
     * been saved, it will retrieve related Holidayss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GeoState.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildHolidays[] List of ChildHolidays objects
     * @phpstan-return ObjectCollection&\Traversable<ChildHolidays}> List of ChildHolidays objects
     */
    public function getHolidayssJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildHolidaysQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getHolidayss($query, $con);
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
     * If this ChildGeoState is new, it will return
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
                    ->filterByGeoState($this)
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
            $onBoardRequestAddressRemoved->setGeoState(null);
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
                ->filterByGeoState($this)
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
        $onBoardRequestAddress->setGeoState($this);
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
            $onBoardRequestAddress->setGeoState(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this GeoState is new, it will return
     * an empty collection; or if this GeoState has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GeoState.
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
     * Otherwise if this GeoState is new, it will return
     * an empty collection; or if this GeoState has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GeoState.
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
     * Otherwise if this GeoState is new, it will return
     * an empty collection; or if this GeoState has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GeoState.
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
     * Otherwise if this GeoState is new, it will return
     * an empty collection; or if this GeoState has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GeoState.
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
     * Otherwise if this GeoState is new, it will return
     * an empty collection; or if this GeoState has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GeoState.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequestAddress[] List of ChildOnBoardRequestAddress objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequestAddress}> List of ChildOnBoardRequestAddress objects
     */
    public function getOnBoardRequestAddressesJoinBeats(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestAddressQuery::create(null, $criteria);
        $query->joinWith('Beats', $joinBehavior);

        return $this->getOnBoardRequestAddresses($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this GeoState is new, it will return
     * an empty collection; or if this GeoState has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GeoState.
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
     * Otherwise if this GeoState is new, it will return
     * an empty collection; or if this GeoState has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GeoState.
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
     * Otherwise if this GeoState is new, it will return
     * an empty collection; or if this GeoState has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GeoState.
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
     * Otherwise if this GeoState is new, it will return
     * an empty collection; or if this GeoState has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GeoState.
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
     * Otherwise if this GeoState is new, it will return
     * an empty collection; or if this GeoState has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GeoState.
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
     * Otherwise if this GeoState is new, it will return
     * an empty collection; or if this GeoState has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GeoState.
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
     * Otherwise if this GeoState is new, it will return
     * an empty collection; or if this GeoState has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GeoState.
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
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     *
     * @return $this
     */
    public function clear()
    {
        if (null !== $this->aGeoCountry) {
            $this->aGeoCountry->removeGeoState($this);
        }
        $this->istateid = null;
        $this->sstatename = null;
        $this->sstatecode = null;
        $this->dcreateddate = null;
        $this->dmodifydate = null;
        $this->country_id = null;
        $this->sstatus = null;
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
            if ($this->collBranches) {
                foreach ($this->collBranches as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collGeoCities) {
                foreach ($this->collGeoCities as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collGeoDistancesRelatedByFromStateId) {
                foreach ($this->collGeoDistancesRelatedByFromStateId as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collGeoDistancesRelatedByToStateId) {
                foreach ($this->collGeoDistancesRelatedByToStateId as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collHolidayss) {
                foreach ($this->collHolidayss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collOnBoardRequestAddresses) {
                foreach ($this->collOnBoardRequestAddresses as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collBranches = null;
        $this->collGeoCities = null;
        $this->collGeoDistancesRelatedByFromStateId = null;
        $this->collGeoDistancesRelatedByToStateId = null;
        $this->collHolidayss = null;
        $this->collOnBoardRequestAddresses = null;
        $this->aGeoCountry = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(GeoStateTableMap::DEFAULT_STRING_FORMAT);
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
