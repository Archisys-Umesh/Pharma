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
use entities\Company as ChildCompany;
use entities\CompanyQuery as ChildCompanyQuery;
use entities\Positions as ChildPositions;
use entities\PositionsQuery as ChildPositionsQuery;
use entities\Stp as ChildStp;
use entities\StpQuery as ChildStpQuery;
use entities\StpWeek as ChildStpWeek;
use entities\StpWeekQuery as ChildStpWeekQuery;
use entities\Map\StpTableMap;
use entities\Map\StpWeekTableMap;

/**
 * Base class that represents a row from the 'stp' table.
 *
 *
 *
 * @package    propel.generator.entities.Base
 */
abstract class Stp implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\entities\\Map\\StpTableMap';


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
     * The value for the stp_id field.
     *
     * @var        int
     */
    protected $stp_id;

    /**
     * The value for the position_id field.
     *
     * @var        int
     */
    protected $position_id;

    /**
     * The value for the company_id field.
     *
     * @var        int
     */
    protected $company_id;

    /**
     * The value for the stp_status field.
     *
     * @var        string|null
     */
    protected $stp_status;

    /**
     * The value for the stp_approved_by field.
     *
     * @var        int|null
     */
    protected $stp_approved_by;

    /**
     * The value for the approved_date field.
     *
     * @var        DateTime|null
     */
    protected $approved_date;

    /**
     * The value for the rejected_reason field.
     *
     * @var        string|null
     */
    protected $rejected_reason;

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
     * @var        ChildCompany
     */
    protected $aCompany;

    /**
     * @var        ChildPositions
     */
    protected $aPositions;

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
     * Initializes internal state of entities\Base\Stp object.
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
     * Compares this with another <code>Stp</code> instance.  If
     * <code>obj</code> is an instance of <code>Stp</code>, delegates to
     * <code>equals(Stp)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [stp_id] column value.
     *
     * @return int
     */
    public function getStpId()
    {
        return $this->stp_id;
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
     * Get the [company_id] column value.
     *
     * @return int
     */
    public function getCompanyId()
    {
        return $this->company_id;
    }

    /**
     * Get the [stp_status] column value.
     *
     * @return string|null
     */
    public function getStpStatus()
    {
        return $this->stp_status;
    }

    /**
     * Get the [stp_approved_by] column value.
     *
     * @return int|null
     */
    public function getStpApprovedBy()
    {
        return $this->stp_approved_by;
    }

    /**
     * Get the [optionally formatted] temporal [approved_date] column value.
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
    public function getApprovedDate($format = null)
    {
        if ($format === null) {
            return $this->approved_date;
        } else {
            return $this->approved_date instanceof \DateTimeInterface ? $this->approved_date->format($format) : null;
        }
    }

    /**
     * Get the [rejected_reason] column value.
     *
     * @return string|null
     */
    public function getRejectedReason()
    {
        return $this->rejected_reason;
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
     * Set the value of [stp_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setStpId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->stp_id !== $v) {
            $this->stp_id = $v;
            $this->modifiedColumns[StpTableMap::COL_STP_ID] = true;
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
            $this->modifiedColumns[StpTableMap::COL_POSITION_ID] = true;
        }

        if ($this->aPositions !== null && $this->aPositions->getPositionId() !== $v) {
            $this->aPositions = null;
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
            $this->modifiedColumns[StpTableMap::COL_COMPANY_ID] = true;
        }

        if ($this->aCompany !== null && $this->aCompany->getCompanyId() !== $v) {
            $this->aCompany = null;
        }

        return $this;
    }

    /**
     * Set the value of [stp_status] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setStpStatus($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->stp_status !== $v) {
            $this->stp_status = $v;
            $this->modifiedColumns[StpTableMap::COL_STP_STATUS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [stp_approved_by] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setStpApprovedBy($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->stp_approved_by !== $v) {
            $this->stp_approved_by = $v;
            $this->modifiedColumns[StpTableMap::COL_STP_APPROVED_BY] = true;
        }

        return $this;
    }

    /**
     * Sets the value of [approved_date] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setApprovedDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->approved_date !== null || $dt !== null) {
            if ($this->approved_date === null || $dt === null || $dt->format("Y-m-d") !== $this->approved_date->format("Y-m-d")) {
                $this->approved_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[StpTableMap::COL_APPROVED_DATE] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [rejected_reason] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setRejectedReason($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->rejected_reason !== $v) {
            $this->rejected_reason = $v;
            $this->modifiedColumns[StpTableMap::COL_REJECTED_REASON] = true;
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
                $this->modifiedColumns[StpTableMap::COL_CREATED_AT] = true;
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
                $this->modifiedColumns[StpTableMap::COL_UPDATED_AT] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : StpTableMap::translateFieldName('StpId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->stp_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : StpTableMap::translateFieldName('PositionId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->position_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : StpTableMap::translateFieldName('CompanyId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->company_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : StpTableMap::translateFieldName('StpStatus', TableMap::TYPE_PHPNAME, $indexType)];
            $this->stp_status = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : StpTableMap::translateFieldName('StpApprovedBy', TableMap::TYPE_PHPNAME, $indexType)];
            $this->stp_approved_by = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : StpTableMap::translateFieldName('ApprovedDate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->approved_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : StpTableMap::translateFieldName('RejectedReason', TableMap::TYPE_PHPNAME, $indexType)];
            $this->rejected_reason = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : StpTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : StpTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 9; // 9 = StpTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\entities\\Stp'), 0, $e);
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
        if ($this->aPositions !== null && $this->position_id !== $this->aPositions->getPositionId()) {
            $this->aPositions = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(StpTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildStpQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aCompany = null;
            $this->aPositions = null;
            $this->collStpWeeks = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see Stp::setDeleted()
     * @see Stp::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(StpTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildStpQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(StpTableMap::DATABASE_NAME);
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
                StpTableMap::addInstanceToPool($this);
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

            if ($this->stpWeeksScheduledForDeletion !== null) {
                if (!$this->stpWeeksScheduledForDeletion->isEmpty()) {
                    \entities\StpWeekQuery::create()
                        ->filterByPrimaryKeys($this->stpWeeksScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
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

        $this->modifiedColumns[StpTableMap::COL_STP_ID] = true;
        if (null !== $this->stp_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . StpTableMap::COL_STP_ID . ')');
        }
        if (null === $this->stp_id) {
            try {
                $dataFetcher = $con->query("SELECT nextval('stp_stp_id_seq')");
                $this->stp_id = (int) $dataFetcher->fetchColumn();
            } catch (Exception $e) {
                throw new PropelException('Unable to get sequence id.', 0, $e);
            }
        }


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(StpTableMap::COL_STP_ID)) {
            $modifiedColumns[':p' . $index++]  = 'stp_id';
        }
        if ($this->isColumnModified(StpTableMap::COL_POSITION_ID)) {
            $modifiedColumns[':p' . $index++]  = 'position_id';
        }
        if ($this->isColumnModified(StpTableMap::COL_COMPANY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'company_id';
        }
        if ($this->isColumnModified(StpTableMap::COL_STP_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'stp_status';
        }
        if ($this->isColumnModified(StpTableMap::COL_STP_APPROVED_BY)) {
            $modifiedColumns[':p' . $index++]  = 'stp_approved_by';
        }
        if ($this->isColumnModified(StpTableMap::COL_APPROVED_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'approved_date';
        }
        if ($this->isColumnModified(StpTableMap::COL_REJECTED_REASON)) {
            $modifiedColumns[':p' . $index++]  = 'rejected_reason';
        }
        if ($this->isColumnModified(StpTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(StpTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }

        $sql = sprintf(
            'INSERT INTO stp (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'stp_id':
                        $stmt->bindValue($identifier, $this->stp_id, PDO::PARAM_INT);

                        break;
                    case 'position_id':
                        $stmt->bindValue($identifier, $this->position_id, PDO::PARAM_INT);

                        break;
                    case 'company_id':
                        $stmt->bindValue($identifier, $this->company_id, PDO::PARAM_INT);

                        break;
                    case 'stp_status':
                        $stmt->bindValue($identifier, $this->stp_status, PDO::PARAM_STR);

                        break;
                    case 'stp_approved_by':
                        $stmt->bindValue($identifier, $this->stp_approved_by, PDO::PARAM_INT);

                        break;
                    case 'approved_date':
                        $stmt->bindValue($identifier, $this->approved_date ? $this->approved_date->format("Y-m-d") : null, PDO::PARAM_STR);

                        break;
                    case 'rejected_reason':
                        $stmt->bindValue($identifier, $this->rejected_reason, PDO::PARAM_STR);

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
        $pos = StpTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getStpId();

            case 1:
                return $this->getPositionId();

            case 2:
                return $this->getCompanyId();

            case 3:
                return $this->getStpStatus();

            case 4:
                return $this->getStpApprovedBy();

            case 5:
                return $this->getApprovedDate();

            case 6:
                return $this->getRejectedReason();

            case 7:
                return $this->getCreatedAt();

            case 8:
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
        if (isset($alreadyDumpedObjects['Stp'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['Stp'][$this->hashCode()] = true;
        $keys = StpTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getStpId(),
            $keys[1] => $this->getPositionId(),
            $keys[2] => $this->getCompanyId(),
            $keys[3] => $this->getStpStatus(),
            $keys[4] => $this->getStpApprovedBy(),
            $keys[5] => $this->getApprovedDate(),
            $keys[6] => $this->getRejectedReason(),
            $keys[7] => $this->getCreatedAt(),
            $keys[8] => $this->getUpdatedAt(),
        ];
        if ($result[$keys[5]] instanceof \DateTimeInterface) {
            $result[$keys[5]] = $result[$keys[5]]->format('Y-m-d');
        }

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
        $pos = StpTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setStpId($value);
                break;
            case 1:
                $this->setPositionId($value);
                break;
            case 2:
                $this->setCompanyId($value);
                break;
            case 3:
                $this->setStpStatus($value);
                break;
            case 4:
                $this->setStpApprovedBy($value);
                break;
            case 5:
                $this->setApprovedDate($value);
                break;
            case 6:
                $this->setRejectedReason($value);
                break;
            case 7:
                $this->setCreatedAt($value);
                break;
            case 8:
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
        $keys = StpTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setStpId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setPositionId($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setCompanyId($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setStpStatus($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setStpApprovedBy($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setApprovedDate($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setRejectedReason($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setCreatedAt($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setUpdatedAt($arr[$keys[8]]);
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
        $criteria = new Criteria(StpTableMap::DATABASE_NAME);

        if ($this->isColumnModified(StpTableMap::COL_STP_ID)) {
            $criteria->add(StpTableMap::COL_STP_ID, $this->stp_id);
        }
        if ($this->isColumnModified(StpTableMap::COL_POSITION_ID)) {
            $criteria->add(StpTableMap::COL_POSITION_ID, $this->position_id);
        }
        if ($this->isColumnModified(StpTableMap::COL_COMPANY_ID)) {
            $criteria->add(StpTableMap::COL_COMPANY_ID, $this->company_id);
        }
        if ($this->isColumnModified(StpTableMap::COL_STP_STATUS)) {
            $criteria->add(StpTableMap::COL_STP_STATUS, $this->stp_status);
        }
        if ($this->isColumnModified(StpTableMap::COL_STP_APPROVED_BY)) {
            $criteria->add(StpTableMap::COL_STP_APPROVED_BY, $this->stp_approved_by);
        }
        if ($this->isColumnModified(StpTableMap::COL_APPROVED_DATE)) {
            $criteria->add(StpTableMap::COL_APPROVED_DATE, $this->approved_date);
        }
        if ($this->isColumnModified(StpTableMap::COL_REJECTED_REASON)) {
            $criteria->add(StpTableMap::COL_REJECTED_REASON, $this->rejected_reason);
        }
        if ($this->isColumnModified(StpTableMap::COL_CREATED_AT)) {
            $criteria->add(StpTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(StpTableMap::COL_UPDATED_AT)) {
            $criteria->add(StpTableMap::COL_UPDATED_AT, $this->updated_at);
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
        $criteria = ChildStpQuery::create();
        $criteria->add(StpTableMap::COL_STP_ID, $this->stp_id);

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
        $validPk = null !== $this->getStpId();

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
        return $this->getStpId();
    }

    /**
     * Generic method to set the primary key (stp_id column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setStpId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getStpId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \entities\Stp (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setPositionId($this->getPositionId());
        $copyObj->setCompanyId($this->getCompanyId());
        $copyObj->setStpStatus($this->getStpStatus());
        $copyObj->setStpApprovedBy($this->getStpApprovedBy());
        $copyObj->setApprovedDate($this->getApprovedDate());
        $copyObj->setRejectedReason($this->getRejectedReason());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getStpWeeks() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addStpWeek($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setStpId(NULL); // this is a auto-increment column, so set to default value
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
     * @return \entities\Stp Clone of current object.
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
            $v->addStp($this);
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
                $this->aCompany->addStps($this);
             */
        }

        return $this->aCompany;
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
            $v->addStp($this);
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
                $this->aPositions->addStps($this);
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
        if ('StpWeek' === $relationName) {
            $this->initStpWeeks();
            return;
        }
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
     * If this ChildStp is new, it will return
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
                    ->filterByStp($this)
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
            $stpWeekRemoved->setStp(null);
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
                ->filterByStp($this)
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
        $stpWeek->setStp($this);
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
            $this->stpWeeksScheduledForDeletion[]= clone $stpWeek;
            $stpWeek->setStp(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Stp is new, it will return
     * an empty collection; or if this Stp has previously
     * been saved, it will retrieve related StpWeeks from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Stp.
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
     * Otherwise if this Stp is new, it will return
     * an empty collection; or if this Stp has previously
     * been saved, it will retrieve related StpWeeks from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Stp.
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
     * Otherwise if this Stp is new, it will return
     * an empty collection; or if this Stp has previously
     * been saved, it will retrieve related StpWeeks from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Stp.
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
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     *
     * @return $this
     */
    public function clear()
    {
        if (null !== $this->aCompany) {
            $this->aCompany->removeStp($this);
        }
        if (null !== $this->aPositions) {
            $this->aPositions->removeStp($this);
        }
        $this->stp_id = null;
        $this->position_id = null;
        $this->company_id = null;
        $this->stp_status = null;
        $this->stp_approved_by = null;
        $this->approved_date = null;
        $this->rejected_reason = null;
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
            if ($this->collStpWeeks) {
                foreach ($this->collStpWeeks as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collStpWeeks = null;
        $this->aCompany = null;
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
        return (string) $this->exportTo(StpTableMap::DEFAULT_STRING_FORMAT);
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
