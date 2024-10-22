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
use entities\GeoTowns as ChildGeoTowns;
use entities\GeoTownsQuery as ChildGeoTownsQuery;
use entities\SfcMasterQuery as ChildSfcMasterQuery;
use entities\Map\SfcMasterTableMap;

/**
 * Base class that represents a row from the 'sfc_master' table.
 *
 *
 *
 * @package    propel.generator.entities.Base
 */
abstract class SfcMaster implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\entities\\Map\\SfcMasterTableMap';


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
     * The value for the sfc_master_id field.
     *
     * @var        int
     */
    protected $sfc_master_id;

    /**
     * The value for the from_town_id field.
     *
     * @var        int|null
     */
    protected $from_town_id;

    /**
     * The value for the to_town_id field.
     *
     * @var        int|null
     */
    protected $to_town_id;

    /**
     * The value for the trip_type field.
     *
     * @var        string|null
     */
    protected $trip_type;

    /**
     * The value for the exp_mod field.
     *
     * @var        string|null
     */
    protected $exp_mod;

    /**
     * The value for the value field.
     *
     * @var        string|null
     */
    protected $value;

    /**
     * The value for the policy_key field.
     *
     * @var        string|null
     */
    protected $policy_key;

    /**
     * The value for the company_id field.
     *
     * @var        int|null
     */
    protected $company_id;

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
     * @var        ChildGeoTowns
     */
    protected $aGeoTownsRelatedByFromTownId;

    /**
     * @var        ChildGeoTowns
     */
    protected $aGeoTownsRelatedByToTownId;

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
     * Initializes internal state of entities\Base\SfcMaster object.
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
     * Compares this with another <code>SfcMaster</code> instance.  If
     * <code>obj</code> is an instance of <code>SfcMaster</code>, delegates to
     * <code>equals(SfcMaster)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [sfc_master_id] column value.
     *
     * @return int
     */
    public function getSfcMasterId()
    {
        return $this->sfc_master_id;
    }

    /**
     * Get the [from_town_id] column value.
     *
     * @return int|null
     */
    public function getFromTownId()
    {
        return $this->from_town_id;
    }

    /**
     * Get the [to_town_id] column value.
     *
     * @return int|null
     */
    public function getToTownId()
    {
        return $this->to_town_id;
    }

    /**
     * Get the [trip_type] column value.
     *
     * @return string|null
     */
    public function getTripType()
    {
        return $this->trip_type;
    }

    /**
     * Get the [exp_mod] column value.
     *
     * @return string|null
     */
    public function getExpMod()
    {
        return $this->exp_mod;
    }

    /**
     * Get the [value] column value.
     *
     * @return string|null
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Get the [policy_key] column value.
     *
     * @return string|null
     */
    public function getPolicyKey()
    {
        return $this->policy_key;
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
     * Set the value of [sfc_master_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setSfcMasterId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->sfc_master_id !== $v) {
            $this->sfc_master_id = $v;
            $this->modifiedColumns[SfcMasterTableMap::COL_SFC_MASTER_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [from_town_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFromTownId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->from_town_id !== $v) {
            $this->from_town_id = $v;
            $this->modifiedColumns[SfcMasterTableMap::COL_FROM_TOWN_ID] = true;
        }

        if ($this->aGeoTownsRelatedByFromTownId !== null && $this->aGeoTownsRelatedByFromTownId->getItownid() !== $v) {
            $this->aGeoTownsRelatedByFromTownId = null;
        }

        return $this;
    }

    /**
     * Set the value of [to_town_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setToTownId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->to_town_id !== $v) {
            $this->to_town_id = $v;
            $this->modifiedColumns[SfcMasterTableMap::COL_TO_TOWN_ID] = true;
        }

        if ($this->aGeoTownsRelatedByToTownId !== null && $this->aGeoTownsRelatedByToTownId->getItownid() !== $v) {
            $this->aGeoTownsRelatedByToTownId = null;
        }

        return $this;
    }

    /**
     * Set the value of [trip_type] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setTripType($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->trip_type !== $v) {
            $this->trip_type = $v;
            $this->modifiedColumns[SfcMasterTableMap::COL_TRIP_TYPE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [exp_mod] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setExpMod($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->exp_mod !== $v) {
            $this->exp_mod = $v;
            $this->modifiedColumns[SfcMasterTableMap::COL_EXP_MOD] = true;
        }

        return $this;
    }

    /**
     * Set the value of [value] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setValue($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->value !== $v) {
            $this->value = $v;
            $this->modifiedColumns[SfcMasterTableMap::COL_VALUE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [policy_key] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPolicyKey($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->policy_key !== $v) {
            $this->policy_key = $v;
            $this->modifiedColumns[SfcMasterTableMap::COL_POLICY_KEY] = true;
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
            $this->modifiedColumns[SfcMasterTableMap::COL_COMPANY_ID] = true;
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
                $this->modifiedColumns[SfcMasterTableMap::COL_CREATED_AT] = true;
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
                $this->modifiedColumns[SfcMasterTableMap::COL_UPDATED_AT] = true;
            }
        } // if either are not null

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SfcMasterTableMap::translateFieldName('SfcMasterId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->sfc_master_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SfcMasterTableMap::translateFieldName('FromTownId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->from_town_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SfcMasterTableMap::translateFieldName('ToTownId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->to_town_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : SfcMasterTableMap::translateFieldName('TripType', TableMap::TYPE_PHPNAME, $indexType)];
            $this->trip_type = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : SfcMasterTableMap::translateFieldName('ExpMod', TableMap::TYPE_PHPNAME, $indexType)];
            $this->exp_mod = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : SfcMasterTableMap::translateFieldName('Value', TableMap::TYPE_PHPNAME, $indexType)];
            $this->value = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : SfcMasterTableMap::translateFieldName('PolicyKey', TableMap::TYPE_PHPNAME, $indexType)];
            $this->policy_key = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : SfcMasterTableMap::translateFieldName('CompanyId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->company_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : SfcMasterTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : SfcMasterTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 10; // 10 = SfcMasterTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\entities\\SfcMaster'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(SfcMasterTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSfcMasterQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aGeoTownsRelatedByFromTownId = null;
            $this->aGeoTownsRelatedByToTownId = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see SfcMaster::setDeleted()
     * @see SfcMaster::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SfcMasterTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSfcMasterQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(SfcMasterTableMap::DATABASE_NAME);
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
                SfcMasterTableMap::addInstanceToPool($this);
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

        $this->modifiedColumns[SfcMasterTableMap::COL_SFC_MASTER_ID] = true;
        if (null !== $this->sfc_master_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . SfcMasterTableMap::COL_SFC_MASTER_ID . ')');
        }
        if (null === $this->sfc_master_id) {
            try {
                $dataFetcher = $con->query("SELECT nextval('sfc_master_sfc_master_id_seq')");
                $this->sfc_master_id = (int) $dataFetcher->fetchColumn();
            } catch (Exception $e) {
                throw new PropelException('Unable to get sequence id.', 0, $e);
            }
        }


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SfcMasterTableMap::COL_SFC_MASTER_ID)) {
            $modifiedColumns[':p' . $index++]  = 'sfc_master_id';
        }
        if ($this->isColumnModified(SfcMasterTableMap::COL_FROM_TOWN_ID)) {
            $modifiedColumns[':p' . $index++]  = 'from_town_id';
        }
        if ($this->isColumnModified(SfcMasterTableMap::COL_TO_TOWN_ID)) {
            $modifiedColumns[':p' . $index++]  = 'to_town_id';
        }
        if ($this->isColumnModified(SfcMasterTableMap::COL_TRIP_TYPE)) {
            $modifiedColumns[':p' . $index++]  = 'trip_type';
        }
        if ($this->isColumnModified(SfcMasterTableMap::COL_EXP_MOD)) {
            $modifiedColumns[':p' . $index++]  = 'exp_mod';
        }
        if ($this->isColumnModified(SfcMasterTableMap::COL_VALUE)) {
            $modifiedColumns[':p' . $index++]  = 'value';
        }
        if ($this->isColumnModified(SfcMasterTableMap::COL_POLICY_KEY)) {
            $modifiedColumns[':p' . $index++]  = 'policy_key';
        }
        if ($this->isColumnModified(SfcMasterTableMap::COL_COMPANY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'company_id';
        }
        if ($this->isColumnModified(SfcMasterTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(SfcMasterTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }

        $sql = sprintf(
            'INSERT INTO sfc_master (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'sfc_master_id':
                        $stmt->bindValue($identifier, $this->sfc_master_id, PDO::PARAM_INT);

                        break;
                    case 'from_town_id':
                        $stmt->bindValue($identifier, $this->from_town_id, PDO::PARAM_INT);

                        break;
                    case 'to_town_id':
                        $stmt->bindValue($identifier, $this->to_town_id, PDO::PARAM_INT);

                        break;
                    case 'trip_type':
                        $stmt->bindValue($identifier, $this->trip_type, PDO::PARAM_STR);

                        break;
                    case 'exp_mod':
                        $stmt->bindValue($identifier, $this->exp_mod, PDO::PARAM_STR);

                        break;
                    case 'value':
                        $stmt->bindValue($identifier, $this->value, PDO::PARAM_STR);

                        break;
                    case 'policy_key':
                        $stmt->bindValue($identifier, $this->policy_key, PDO::PARAM_STR);

                        break;
                    case 'company_id':
                        $stmt->bindValue($identifier, $this->company_id, PDO::PARAM_INT);

                        break;
                    case 'created_at':
                        $stmt->bindValue($identifier, $this->created_at ? $this->created_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'updated_at':
                        $stmt->bindValue($identifier, $this->updated_at ? $this->updated_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

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
        $pos = SfcMasterTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getSfcMasterId();

            case 1:
                return $this->getFromTownId();

            case 2:
                return $this->getToTownId();

            case 3:
                return $this->getTripType();

            case 4:
                return $this->getExpMod();

            case 5:
                return $this->getValue();

            case 6:
                return $this->getPolicyKey();

            case 7:
                return $this->getCompanyId();

            case 8:
                return $this->getCreatedAt();

            case 9:
                return $this->getUpdatedAt();

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
        if (isset($alreadyDumpedObjects['SfcMaster'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['SfcMaster'][$this->hashCode()] = true;
        $keys = SfcMasterTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getSfcMasterId(),
            $keys[1] => $this->getFromTownId(),
            $keys[2] => $this->getToTownId(),
            $keys[3] => $this->getTripType(),
            $keys[4] => $this->getExpMod(),
            $keys[5] => $this->getValue(),
            $keys[6] => $this->getPolicyKey(),
            $keys[7] => $this->getCompanyId(),
            $keys[8] => $this->getCreatedAt(),
            $keys[9] => $this->getUpdatedAt(),
        ];
        if ($result[$keys[8]] instanceof \DateTimeInterface) {
            $result[$keys[8]] = $result[$keys[8]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[9]] instanceof \DateTimeInterface) {
            $result[$keys[9]] = $result[$keys[9]]->format('Y-m-d H:i:s.u');
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
        $pos = SfcMasterTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setSfcMasterId($value);
                break;
            case 1:
                $this->setFromTownId($value);
                break;
            case 2:
                $this->setToTownId($value);
                break;
            case 3:
                $this->setTripType($value);
                break;
            case 4:
                $this->setExpMod($value);
                break;
            case 5:
                $this->setValue($value);
                break;
            case 6:
                $this->setPolicyKey($value);
                break;
            case 7:
                $this->setCompanyId($value);
                break;
            case 8:
                $this->setCreatedAt($value);
                break;
            case 9:
                $this->setUpdatedAt($value);
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
        $keys = SfcMasterTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setSfcMasterId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setFromTownId($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setToTownId($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setTripType($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setExpMod($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setValue($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setPolicyKey($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setCompanyId($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setCreatedAt($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setUpdatedAt($arr[$keys[9]]);
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
        $criteria = new Criteria(SfcMasterTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SfcMasterTableMap::COL_SFC_MASTER_ID)) {
            $criteria->add(SfcMasterTableMap::COL_SFC_MASTER_ID, $this->sfc_master_id);
        }
        if ($this->isColumnModified(SfcMasterTableMap::COL_FROM_TOWN_ID)) {
            $criteria->add(SfcMasterTableMap::COL_FROM_TOWN_ID, $this->from_town_id);
        }
        if ($this->isColumnModified(SfcMasterTableMap::COL_TO_TOWN_ID)) {
            $criteria->add(SfcMasterTableMap::COL_TO_TOWN_ID, $this->to_town_id);
        }
        if ($this->isColumnModified(SfcMasterTableMap::COL_TRIP_TYPE)) {
            $criteria->add(SfcMasterTableMap::COL_TRIP_TYPE, $this->trip_type);
        }
        if ($this->isColumnModified(SfcMasterTableMap::COL_EXP_MOD)) {
            $criteria->add(SfcMasterTableMap::COL_EXP_MOD, $this->exp_mod);
        }
        if ($this->isColumnModified(SfcMasterTableMap::COL_VALUE)) {
            $criteria->add(SfcMasterTableMap::COL_VALUE, $this->value);
        }
        if ($this->isColumnModified(SfcMasterTableMap::COL_POLICY_KEY)) {
            $criteria->add(SfcMasterTableMap::COL_POLICY_KEY, $this->policy_key);
        }
        if ($this->isColumnModified(SfcMasterTableMap::COL_COMPANY_ID)) {
            $criteria->add(SfcMasterTableMap::COL_COMPANY_ID, $this->company_id);
        }
        if ($this->isColumnModified(SfcMasterTableMap::COL_CREATED_AT)) {
            $criteria->add(SfcMasterTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(SfcMasterTableMap::COL_UPDATED_AT)) {
            $criteria->add(SfcMasterTableMap::COL_UPDATED_AT, $this->updated_at);
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
        $criteria = ChildSfcMasterQuery::create();
        $criteria->add(SfcMasterTableMap::COL_SFC_MASTER_ID, $this->sfc_master_id);

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
        $validPk = null !== $this->getSfcMasterId();

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
        return $this->getSfcMasterId();
    }

    /**
     * Generic method to set the primary key (sfc_master_id column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setSfcMasterId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getSfcMasterId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \entities\SfcMaster (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setFromTownId($this->getFromTownId());
        $copyObj->setToTownId($this->getToTownId());
        $copyObj->setTripType($this->getTripType());
        $copyObj->setExpMod($this->getExpMod());
        $copyObj->setValue($this->getValue());
        $copyObj->setPolicyKey($this->getPolicyKey());
        $copyObj->setCompanyId($this->getCompanyId());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setSfcMasterId(NULL); // this is a auto-increment column, so set to default value
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
     * @return \entities\SfcMaster Clone of current object.
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
     * @param ChildGeoTowns|null $v
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
            $v->addSfcMasterRelatedByFromTownId($this);
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
    public function getGeoTownsRelatedByFromTownId(?ConnectionInterface $con = null)
    {
        if ($this->aGeoTownsRelatedByFromTownId === null && ($this->from_town_id != 0)) {
            $this->aGeoTownsRelatedByFromTownId = ChildGeoTownsQuery::create()->findPk($this->from_town_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aGeoTownsRelatedByFromTownId->addSfcMastersRelatedByFromTownId($this);
             */
        }

        return $this->aGeoTownsRelatedByFromTownId;
    }

    /**
     * Declares an association between this object and a ChildGeoTowns object.
     *
     * @param ChildGeoTowns|null $v
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
            $v->addSfcMasterRelatedByToTownId($this);
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
    public function getGeoTownsRelatedByToTownId(?ConnectionInterface $con = null)
    {
        if ($this->aGeoTownsRelatedByToTownId === null && ($this->to_town_id != 0)) {
            $this->aGeoTownsRelatedByToTownId = ChildGeoTownsQuery::create()->findPk($this->to_town_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aGeoTownsRelatedByToTownId->addSfcMastersRelatedByToTownId($this);
             */
        }

        return $this->aGeoTownsRelatedByToTownId;
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
            $this->aGeoTownsRelatedByFromTownId->removeSfcMasterRelatedByFromTownId($this);
        }
        if (null !== $this->aGeoTownsRelatedByToTownId) {
            $this->aGeoTownsRelatedByToTownId->removeSfcMasterRelatedByToTownId($this);
        }
        $this->sfc_master_id = null;
        $this->from_town_id = null;
        $this->to_town_id = null;
        $this->trip_type = null;
        $this->exp_mod = null;
        $this->value = null;
        $this->policy_key = null;
        $this->company_id = null;
        $this->created_at = null;
        $this->updated_at = null;
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
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SfcMasterTableMap::DEFAULT_STRING_FORMAT);
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