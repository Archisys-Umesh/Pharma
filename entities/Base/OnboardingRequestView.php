<?php

namespace entities\Base;

use \DateTime;
use \Exception;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;
use entities\OnboardingRequestViewQuery as ChildOnboardingRequestViewQuery;
use entities\Map\OnboardingRequestViewTableMap;

/**
 * Base class that represents a row from the 'onboarding_request_view' table.
 *
 *
 *
 * @package    propel.generator.entities.Base
 */
abstract class OnboardingRequestView implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\entities\\Map\\OnboardingRequestViewTableMap';


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
     * The value for the on_board_request_id field.
     *
     * @var        int
     */
    protected $on_board_request_id;

    /**
     * The value for the first_name field.
     *
     * @var        string|null
     */
    protected $first_name;

    /**
     * The value for the last_name field.
     *
     * @var        string|null
     */
    protected $last_name;

    /**
     * The value for the outlet_name field.
     *
     * @var        string|null
     */
    protected $outlet_name;

    /**
     * The value for the email field.
     *
     * @var        string|null
     */
    protected $email;

    /**
     * The value for the mobile field.
     *
     * @var        string|null
     */
    protected $mobile;

    /**
     * The value for the outlet_type_id field.
     *
     * @var        int|null
     */
    protected $outlet_type_id;

    /**
     * The value for the outlettype_name field.
     *
     * @var        string|null
     */
    protected $outlettype_name;

    /**
     * The value for the territory field.
     *
     * @var        int|null
     */
    protected $territory;

    /**
     * The value for the territory_name field.
     *
     * @var        string|null
     */
    protected $territory_name;

    /**
     * The value for the created_at field.
     *
     * @var        DateTime|null
     */
    protected $created_at;

    /**
     * The value for the created_by field.
     *
     * @var        string|null
     */
    protected $created_by;

    /**
     * The value for the orgunitid field.
     *
     * @var        int|null
     */
    protected $orgunitid;

    /**
     * The value for the unit_name field.
     *
     * @var        string|null
     */
    protected $unit_name;

    /**
     * The value for the approved_by field.
     *
     * @var        string|null
     */
    protected $approved_by;

    /**
     * The value for the approved_at field.
     *
     * @var        DateTime|null
     */
    protected $approved_at;

    /**
     * The value for the status field.
     *
     * @var        int|null
     */
    protected $status;

    /**
     * The value for the operations field.
     *
     * @var        string|null
     */
    protected $operations;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * Initializes internal state of entities\Base\OnboardingRequestView object.
     */
    public function __construct()
    {
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
     * Compares this with another <code>OnboardingRequestView</code> instance.  If
     * <code>obj</code> is an instance of <code>OnboardingRequestView</code>, delegates to
     * <code>equals(OnboardingRequestView)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [on_board_request_id] column value.
     *
     * @return int
     */
    public function getOnBoardRequestId()
    {
        return $this->on_board_request_id;
    }

    /**
     * Get the [first_name] column value.
     *
     * @return string|null
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * Get the [last_name] column value.
     *
     * @return string|null
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * Get the [outlet_name] column value.
     *
     * @return string|null
     */
    public function getOutletName()
    {
        return $this->outlet_name;
    }

    /**
     * Get the [email] column value.
     *
     * @return string|null
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get the [mobile] column value.
     *
     * @return string|null
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * Get the [outlet_type_id] column value.
     *
     * @return int|null
     */
    public function getOutletTypeId()
    {
        return $this->outlet_type_id;
    }

    /**
     * Get the [outlettype_name] column value.
     *
     * @return string|null
     */
    public function getOutlettypeName()
    {
        return $this->outlettype_name;
    }

    /**
     * Get the [territory] column value.
     *
     * @return int|null
     */
    public function getTerritory()
    {
        return $this->territory;
    }

    /**
     * Get the [territory_name] column value.
     *
     * @return string|null
     */
    public function getTerritoryName()
    {
        return $this->territory_name;
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
     * Get the [created_by] column value.
     *
     * @return string|null
     */
    public function getCreatedBy()
    {
        return $this->created_by;
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
     * Get the [unit_name] column value.
     *
     * @return string|null
     */
    public function getUnitName()
    {
        return $this->unit_name;
    }

    /**
     * Get the [approved_by] column value.
     *
     * @return string|null
     */
    public function getApprovedBy()
    {
        return $this->approved_by;
    }

    /**
     * Get the [optionally formatted] temporal [approved_at] column value.
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
    public function getApprovedAt($format = null)
    {
        if ($format === null) {
            return $this->approved_at;
        } else {
            return $this->approved_at instanceof \DateTimeInterface ? $this->approved_at->format($format) : null;
        }
    }

    /**
     * Get the [status] column value.
     *
     * @return int|null
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Get the [operations] column value.
     *
     * @return string|null
     */
    public function getOperations()
    {
        return $this->operations;
    }

    /**
     * Set the value of [on_board_request_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOnBoardRequestId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->on_board_request_id !== $v) {
            $this->on_board_request_id = $v;
            $this->modifiedColumns[OnboardingRequestViewTableMap::COL_ON_BOARD_REQUEST_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [first_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setFirstName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->first_name !== $v) {
            $this->first_name = $v;
            $this->modifiedColumns[OnboardingRequestViewTableMap::COL_FIRST_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [last_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setLastName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->last_name !== $v) {
            $this->last_name = $v;
            $this->modifiedColumns[OnboardingRequestViewTableMap::COL_LAST_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOutletName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->outlet_name !== $v) {
            $this->outlet_name = $v;
            $this->modifiedColumns[OnboardingRequestViewTableMap::COL_OUTLET_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [email] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setEmail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->email !== $v) {
            $this->email = $v;
            $this->modifiedColumns[OnboardingRequestViewTableMap::COL_EMAIL] = true;
        }

        return $this;
    }

    /**
     * Set the value of [mobile] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setMobile($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->mobile !== $v) {
            $this->mobile = $v;
            $this->modifiedColumns[OnboardingRequestViewTableMap::COL_MOBILE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_type_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOutletTypeId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->outlet_type_id !== $v) {
            $this->outlet_type_id = $v;
            $this->modifiedColumns[OnboardingRequestViewTableMap::COL_OUTLET_TYPE_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlettype_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOutlettypeName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->outlettype_name !== $v) {
            $this->outlettype_name = $v;
            $this->modifiedColumns[OnboardingRequestViewTableMap::COL_OUTLETTYPE_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [territory] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setTerritory($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->territory !== $v) {
            $this->territory = $v;
            $this->modifiedColumns[OnboardingRequestViewTableMap::COL_TERRITORY] = true;
        }

        return $this;
    }

    /**
     * Set the value of [territory_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setTerritoryName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->territory_name !== $v) {
            $this->territory_name = $v;
            $this->modifiedColumns[OnboardingRequestViewTableMap::COL_TERRITORY_NAME] = true;
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
    protected function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            if ($this->created_at === null || $dt === null || $dt->format("Y-m-d") !== $this->created_at->format("Y-m-d")) {
                $this->created_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[OnboardingRequestViewTableMap::COL_CREATED_AT] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [created_by] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setCreatedBy($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->created_by !== $v) {
            $this->created_by = $v;
            $this->modifiedColumns[OnboardingRequestViewTableMap::COL_CREATED_BY] = true;
        }

        return $this;
    }

    /**
     * Set the value of [orgunitid] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOrgunitid($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->orgunitid !== $v) {
            $this->orgunitid = $v;
            $this->modifiedColumns[OnboardingRequestViewTableMap::COL_ORGUNITID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [unit_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setUnitName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->unit_name !== $v) {
            $this->unit_name = $v;
            $this->modifiedColumns[OnboardingRequestViewTableMap::COL_UNIT_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [approved_by] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setApprovedBy($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->approved_by !== $v) {
            $this->approved_by = $v;
            $this->modifiedColumns[OnboardingRequestViewTableMap::COL_APPROVED_BY] = true;
        }

        return $this;
    }

    /**
     * Sets the value of [approved_at] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    protected function setApprovedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->approved_at !== null || $dt !== null) {
            if ($this->approved_at === null || $dt === null || $dt->format("Y-m-d") !== $this->approved_at->format("Y-m-d")) {
                $this->approved_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[OnboardingRequestViewTableMap::COL_APPROVED_AT] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [status] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setStatus($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->status !== $v) {
            $this->status = $v;
            $this->modifiedColumns[OnboardingRequestViewTableMap::COL_STATUS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [operations] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOperations($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->operations !== $v) {
            $this->operations = $v;
            $this->modifiedColumns[OnboardingRequestViewTableMap::COL_OPERATIONS] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : OnboardingRequestViewTableMap::translateFieldName('OnBoardRequestId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->on_board_request_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : OnboardingRequestViewTableMap::translateFieldName('FirstName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->first_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : OnboardingRequestViewTableMap::translateFieldName('LastName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->last_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : OnboardingRequestViewTableMap::translateFieldName('OutletName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : OnboardingRequestViewTableMap::translateFieldName('Email', TableMap::TYPE_PHPNAME, $indexType)];
            $this->email = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : OnboardingRequestViewTableMap::translateFieldName('Mobile', TableMap::TYPE_PHPNAME, $indexType)];
            $this->mobile = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : OnboardingRequestViewTableMap::translateFieldName('OutletTypeId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_type_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : OnboardingRequestViewTableMap::translateFieldName('OutlettypeName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlettype_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : OnboardingRequestViewTableMap::translateFieldName('Territory', TableMap::TYPE_PHPNAME, $indexType)];
            $this->territory = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : OnboardingRequestViewTableMap::translateFieldName('TerritoryName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->territory_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : OnboardingRequestViewTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : OnboardingRequestViewTableMap::translateFieldName('CreatedBy', TableMap::TYPE_PHPNAME, $indexType)];
            $this->created_by = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : OnboardingRequestViewTableMap::translateFieldName('Orgunitid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->orgunitid = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : OnboardingRequestViewTableMap::translateFieldName('UnitName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->unit_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : OnboardingRequestViewTableMap::translateFieldName('ApprovedBy', TableMap::TYPE_PHPNAME, $indexType)];
            $this->approved_by = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : OnboardingRequestViewTableMap::translateFieldName('ApprovedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->approved_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : OnboardingRequestViewTableMap::translateFieldName('Status', TableMap::TYPE_PHPNAME, $indexType)];
            $this->status = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : OnboardingRequestViewTableMap::translateFieldName('Operations', TableMap::TYPE_PHPNAME, $indexType)];
            $this->operations = (null !== $col) ? (string) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 18; // 18 = OnboardingRequestViewTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\entities\\OnboardingRequestView'), 0, $e);
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
        $pos = OnboardingRequestViewTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getOnBoardRequestId();

            case 1:
                return $this->getFirstName();

            case 2:
                return $this->getLastName();

            case 3:
                return $this->getOutletName();

            case 4:
                return $this->getEmail();

            case 5:
                return $this->getMobile();

            case 6:
                return $this->getOutletTypeId();

            case 7:
                return $this->getOutlettypeName();

            case 8:
                return $this->getTerritory();

            case 9:
                return $this->getTerritoryName();

            case 10:
                return $this->getCreatedAt();

            case 11:
                return $this->getCreatedBy();

            case 12:
                return $this->getOrgunitid();

            case 13:
                return $this->getUnitName();

            case 14:
                return $this->getApprovedBy();

            case 15:
                return $this->getApprovedAt();

            case 16:
                return $this->getStatus();

            case 17:
                return $this->getOperations();

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
     *
     * @return array An associative array containing the field names (as keys) and field values
     */
    public function toArray(string $keyType = TableMap::TYPE_PHPNAME, bool $includeLazyLoadColumns = true, array $alreadyDumpedObjects = []): array
    {
        if (isset($alreadyDumpedObjects['OnboardingRequestView'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['OnboardingRequestView'][$this->hashCode()] = true;
        $keys = OnboardingRequestViewTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getOnBoardRequestId(),
            $keys[1] => $this->getFirstName(),
            $keys[2] => $this->getLastName(),
            $keys[3] => $this->getOutletName(),
            $keys[4] => $this->getEmail(),
            $keys[5] => $this->getMobile(),
            $keys[6] => $this->getOutletTypeId(),
            $keys[7] => $this->getOutlettypeName(),
            $keys[8] => $this->getTerritory(),
            $keys[9] => $this->getTerritoryName(),
            $keys[10] => $this->getCreatedAt(),
            $keys[11] => $this->getCreatedBy(),
            $keys[12] => $this->getOrgunitid(),
            $keys[13] => $this->getUnitName(),
            $keys[14] => $this->getApprovedBy(),
            $keys[15] => $this->getApprovedAt(),
            $keys[16] => $this->getStatus(),
            $keys[17] => $this->getOperations(),
        ];
        if ($result[$keys[10]] instanceof \DateTimeInterface) {
            $result[$keys[10]] = $result[$keys[10]]->format('Y-m-d');
        }

        if ($result[$keys[15]] instanceof \DateTimeInterface) {
            $result[$keys[15]] = $result[$keys[15]]->format('Y-m-d');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }


        return $result;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return \Propel\Runtime\ActiveQuery\Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria(): Criteria
    {
        $criteria = new Criteria(OnboardingRequestViewTableMap::DATABASE_NAME);

        if ($this->isColumnModified(OnboardingRequestViewTableMap::COL_ON_BOARD_REQUEST_ID)) {
            $criteria->add(OnboardingRequestViewTableMap::COL_ON_BOARD_REQUEST_ID, $this->on_board_request_id);
        }
        if ($this->isColumnModified(OnboardingRequestViewTableMap::COL_FIRST_NAME)) {
            $criteria->add(OnboardingRequestViewTableMap::COL_FIRST_NAME, $this->first_name);
        }
        if ($this->isColumnModified(OnboardingRequestViewTableMap::COL_LAST_NAME)) {
            $criteria->add(OnboardingRequestViewTableMap::COL_LAST_NAME, $this->last_name);
        }
        if ($this->isColumnModified(OnboardingRequestViewTableMap::COL_OUTLET_NAME)) {
            $criteria->add(OnboardingRequestViewTableMap::COL_OUTLET_NAME, $this->outlet_name);
        }
        if ($this->isColumnModified(OnboardingRequestViewTableMap::COL_EMAIL)) {
            $criteria->add(OnboardingRequestViewTableMap::COL_EMAIL, $this->email);
        }
        if ($this->isColumnModified(OnboardingRequestViewTableMap::COL_MOBILE)) {
            $criteria->add(OnboardingRequestViewTableMap::COL_MOBILE, $this->mobile);
        }
        if ($this->isColumnModified(OnboardingRequestViewTableMap::COL_OUTLET_TYPE_ID)) {
            $criteria->add(OnboardingRequestViewTableMap::COL_OUTLET_TYPE_ID, $this->outlet_type_id);
        }
        if ($this->isColumnModified(OnboardingRequestViewTableMap::COL_OUTLETTYPE_NAME)) {
            $criteria->add(OnboardingRequestViewTableMap::COL_OUTLETTYPE_NAME, $this->outlettype_name);
        }
        if ($this->isColumnModified(OnboardingRequestViewTableMap::COL_TERRITORY)) {
            $criteria->add(OnboardingRequestViewTableMap::COL_TERRITORY, $this->territory);
        }
        if ($this->isColumnModified(OnboardingRequestViewTableMap::COL_TERRITORY_NAME)) {
            $criteria->add(OnboardingRequestViewTableMap::COL_TERRITORY_NAME, $this->territory_name);
        }
        if ($this->isColumnModified(OnboardingRequestViewTableMap::COL_CREATED_AT)) {
            $criteria->add(OnboardingRequestViewTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(OnboardingRequestViewTableMap::COL_CREATED_BY)) {
            $criteria->add(OnboardingRequestViewTableMap::COL_CREATED_BY, $this->created_by);
        }
        if ($this->isColumnModified(OnboardingRequestViewTableMap::COL_ORGUNITID)) {
            $criteria->add(OnboardingRequestViewTableMap::COL_ORGUNITID, $this->orgunitid);
        }
        if ($this->isColumnModified(OnboardingRequestViewTableMap::COL_UNIT_NAME)) {
            $criteria->add(OnboardingRequestViewTableMap::COL_UNIT_NAME, $this->unit_name);
        }
        if ($this->isColumnModified(OnboardingRequestViewTableMap::COL_APPROVED_BY)) {
            $criteria->add(OnboardingRequestViewTableMap::COL_APPROVED_BY, $this->approved_by);
        }
        if ($this->isColumnModified(OnboardingRequestViewTableMap::COL_APPROVED_AT)) {
            $criteria->add(OnboardingRequestViewTableMap::COL_APPROVED_AT, $this->approved_at);
        }
        if ($this->isColumnModified(OnboardingRequestViewTableMap::COL_STATUS)) {
            $criteria->add(OnboardingRequestViewTableMap::COL_STATUS, $this->status);
        }
        if ($this->isColumnModified(OnboardingRequestViewTableMap::COL_OPERATIONS)) {
            $criteria->add(OnboardingRequestViewTableMap::COL_OPERATIONS, $this->operations);
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
        $criteria = ChildOnboardingRequestViewQuery::create();
        $criteria->add(OnboardingRequestViewTableMap::COL_ON_BOARD_REQUEST_ID, $this->on_board_request_id);

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
        $validPk = null !== $this->getOnBoardRequestId();

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
        return $this->getOnBoardRequestId();
    }

    /**
     * Generic method to set the primary key (on_board_request_id column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setOnBoardRequestId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getOnBoardRequestId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \entities\OnboardingRequestView (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setOnBoardRequestId($this->getOnBoardRequestId());
        $copyObj->setFirstName($this->getFirstName());
        $copyObj->setLastName($this->getLastName());
        $copyObj->setOutletName($this->getOutletName());
        $copyObj->setEmail($this->getEmail());
        $copyObj->setMobile($this->getMobile());
        $copyObj->setOutletTypeId($this->getOutletTypeId());
        $copyObj->setOutlettypeName($this->getOutlettypeName());
        $copyObj->setTerritory($this->getTerritory());
        $copyObj->setTerritoryName($this->getTerritoryName());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setCreatedBy($this->getCreatedBy());
        $copyObj->setOrgunitid($this->getOrgunitid());
        $copyObj->setUnitName($this->getUnitName());
        $copyObj->setApprovedBy($this->getApprovedBy());
        $copyObj->setApprovedAt($this->getApprovedAt());
        $copyObj->setStatus($this->getStatus());
        $copyObj->setOperations($this->getOperations());
        if ($makeNew) {
            $copyObj->setNew(true);
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
     * @return \entities\OnboardingRequestView Clone of current object.
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
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     *
     * @return $this
     */
    public function clear()
    {
        $this->on_board_request_id = null;
        $this->first_name = null;
        $this->last_name = null;
        $this->outlet_name = null;
        $this->email = null;
        $this->mobile = null;
        $this->outlet_type_id = null;
        $this->outlettype_name = null;
        $this->territory = null;
        $this->territory_name = null;
        $this->created_at = null;
        $this->created_by = null;
        $this->orgunitid = null;
        $this->unit_name = null;
        $this->approved_by = null;
        $this->approved_at = null;
        $this->status = null;
        $this->operations = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
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

        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(OnboardingRequestViewTableMap::DEFAULT_STRING_FORMAT);
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
