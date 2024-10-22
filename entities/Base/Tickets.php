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
use entities\Employee as ChildEmployee;
use entities\EmployeeQuery as ChildEmployeeQuery;
use entities\Outlets as ChildOutlets;
use entities\OutletsQuery as ChildOutletsQuery;
use entities\TicketReplies as ChildTicketReplies;
use entities\TicketRepliesQuery as ChildTicketRepliesQuery;
use entities\TicketType as ChildTicketType;
use entities\TicketTypeQuery as ChildTicketTypeQuery;
use entities\Tickets as ChildTickets;
use entities\TicketsQuery as ChildTicketsQuery;
use entities\Map\TicketRepliesTableMap;
use entities\Map\TicketsTableMap;

/**
 * Base class that represents a row from the 'tickets' table.
 *
 *
 *
 * @package    propel.generator.entities.Base
 */
abstract class Tickets implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\entities\\Map\\TicketsTableMap';


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
     * The value for the id field.
     *
     * @var        int
     */
    protected $id;

    /**
     * The value for the ticket_type_id field.
     *
     * @var        int
     */
    protected $ticket_type_id;

    /**
     * The value for the outlet_id field.
     *
     * @var        int
     */
    protected $outlet_id;

    /**
     * The value for the media_id field.
     *
     * @var        string|null
     */
    protected $media_id;

    /**
     * The value for the description field.
     *
     * @var        string|null
     */
    protected $description;

    /**
     * The value for the status field.
     *
     * Note: this column has a database default value of: 'open'
     * @var        string
     */
    protected $status;

    /**
     * The value for the employee_id field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $employee_id;

    /**
     * The value for the company_id field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $company_id;

    /**
     * The value for the created_at field.
     *
     * Note: this column has a database default value of: (expression) CURRENT_TIMESTAMP
     * @var        DateTime
     */
    protected $created_at;

    /**
     * The value for the updated_at field.
     *
     * @var        DateTime|null
     */
    protected $updated_at;

    /**
     * The value for the integration_id field.
     *
     * @var        string|null
     */
    protected $integration_id;

    /**
     * The value for the allocated_to field.
     *
     * @var        int|null
     */
    protected $allocated_to;

    /**
     * @var        ChildTicketType
     */
    protected $aTicketType;

    /**
     * @var        ChildOutlets
     */
    protected $aOutlets;

    /**
     * @var        ChildEmployee
     */
    protected $aEmployeeRelatedByEmployeeId;

    /**
     * @var        ChildCompany
     */
    protected $aCompany;

    /**
     * @var        ChildEmployee
     */
    protected $aEmployeeRelatedByAllocatedTo;

    /**
     * @var        ObjectCollection|ChildTicketReplies[] Collection to store aggregation of ChildTicketReplies objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildTicketReplies> Collection to store aggregation of ChildTicketReplies objects.
     */
    protected $collTicketRepliess;
    protected $collTicketRepliessPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildTicketReplies[]
     * @phpstan-var ObjectCollection&\Traversable<ChildTicketReplies>
     */
    protected $ticketRepliessScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues(): void
    {
        $this->status = 'open';
        $this->employee_id = 0;
        $this->company_id = 0;
    }

    /**
     * Initializes internal state of entities\Base\Tickets object.
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
     * Compares this with another <code>Tickets</code> instance.  If
     * <code>obj</code> is an instance of <code>Tickets</code>, delegates to
     * <code>equals(Tickets)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [id] column value.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the [ticket_type_id] column value.
     *
     * @return int
     */
    public function getTicketTypeId()
    {
        return $this->ticket_type_id;
    }

    /**
     * Get the [outlet_id] column value.
     *
     * @return int
     */
    public function getOutletId()
    {
        return $this->outlet_id;
    }

    /**
     * Get the [media_id] column value.
     *
     * @return string|null
     */
    public function getMediaId()
    {
        return $this->media_id;
    }

    /**
     * Get the [description] column value.
     *
     * @return string|null
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Get the [status] column value.
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Get the [employee_id] column value.
     *
     * @return int
     */
    public function getEmployeeId()
    {
        return $this->employee_id;
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
     * Get the [optionally formatted] temporal [created_at] column value.
     *
     *
     * @param string|null $format The date/time format string (either date()-style or strftime()-style).
     *   If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL).
     *
     * @throws \Propel\Runtime\Exception\PropelException - if unable to parse/validate the date/time value.
     *
     * @psalm-return ($format is null ? DateTime : string)
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
     * Get the [integration_id] column value.
     *
     * @return string|null
     */
    public function getIntegrationId()
    {
        return $this->integration_id;
    }

    /**
     * Get the [allocated_to] column value.
     *
     * @return int|null
     */
    public function getAllocatedTo()
    {
        return $this->allocated_to;
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[TicketsTableMap::COL_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [ticket_type_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setTicketTypeId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->ticket_type_id !== $v) {
            $this->ticket_type_id = $v;
            $this->modifiedColumns[TicketsTableMap::COL_TICKET_TYPE_ID] = true;
        }

        if ($this->aTicketType !== null && $this->aTicketType->getId() !== $v) {
            $this->aTicketType = null;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOutletId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->outlet_id !== $v) {
            $this->outlet_id = $v;
            $this->modifiedColumns[TicketsTableMap::COL_OUTLET_ID] = true;
        }

        if ($this->aOutlets !== null && $this->aOutlets->getId() !== $v) {
            $this->aOutlets = null;
        }

        return $this;
    }

    /**
     * Set the value of [media_id] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setMediaId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->media_id !== $v) {
            $this->media_id = $v;
            $this->modifiedColumns[TicketsTableMap::COL_MEDIA_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [description] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setDescription($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->description !== $v) {
            $this->description = $v;
            $this->modifiedColumns[TicketsTableMap::COL_DESCRIPTION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [status] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setStatus($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->status !== $v) {
            $this->status = $v;
            $this->modifiedColumns[TicketsTableMap::COL_STATUS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [employee_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setEmployeeId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->employee_id !== $v) {
            $this->employee_id = $v;
            $this->modifiedColumns[TicketsTableMap::COL_EMPLOYEE_ID] = true;
        }

        if ($this->aEmployeeRelatedByEmployeeId !== null && $this->aEmployeeRelatedByEmployeeId->getEmployeeId() !== $v) {
            $this->aEmployeeRelatedByEmployeeId = null;
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
            $this->modifiedColumns[TicketsTableMap::COL_COMPANY_ID] = true;
        }

        if ($this->aCompany !== null && $this->aCompany->getCompanyId() !== $v) {
            $this->aCompany = null;
        }

        return $this;
    }

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            if ($this->created_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->created_at->format("Y-m-d H:i:s.u")) {
                $this->created_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[TicketsTableMap::COL_CREATED_AT] = true;
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
                $this->modifiedColumns[TicketsTableMap::COL_UPDATED_AT] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [integration_id] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIntegrationId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->integration_id !== $v) {
            $this->integration_id = $v;
            $this->modifiedColumns[TicketsTableMap::COL_INTEGRATION_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [allocated_to] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setAllocatedTo($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->allocated_to !== $v) {
            $this->allocated_to = $v;
            $this->modifiedColumns[TicketsTableMap::COL_ALLOCATED_TO] = true;
        }

        if ($this->aEmployeeRelatedByAllocatedTo !== null && $this->aEmployeeRelatedByAllocatedTo->getEmployeeId() !== $v) {
            $this->aEmployeeRelatedByAllocatedTo = null;
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
            if ($this->status !== 'open') {
                return false;
            }

            if ($this->employee_id !== 0) {
                return false;
            }

            if ($this->company_id !== 0) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : TicketsTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : TicketsTableMap::translateFieldName('TicketTypeId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->ticket_type_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : TicketsTableMap::translateFieldName('OutletId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : TicketsTableMap::translateFieldName('MediaId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->media_id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : TicketsTableMap::translateFieldName('Description', TableMap::TYPE_PHPNAME, $indexType)];
            $this->description = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : TicketsTableMap::translateFieldName('Status', TableMap::TYPE_PHPNAME, $indexType)];
            $this->status = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : TicketsTableMap::translateFieldName('EmployeeId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->employee_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : TicketsTableMap::translateFieldName('CompanyId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->company_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : TicketsTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : TicketsTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : TicketsTableMap::translateFieldName('IntegrationId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->integration_id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : TicketsTableMap::translateFieldName('AllocatedTo', TableMap::TYPE_PHPNAME, $indexType)];
            $this->allocated_to = (null !== $col) ? (int) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 12; // 12 = TicketsTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\entities\\Tickets'), 0, $e);
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
        if ($this->aTicketType !== null && $this->ticket_type_id !== $this->aTicketType->getId()) {
            $this->aTicketType = null;
        }
        if ($this->aOutlets !== null && $this->outlet_id !== $this->aOutlets->getId()) {
            $this->aOutlets = null;
        }
        if ($this->aEmployeeRelatedByEmployeeId !== null && $this->employee_id !== $this->aEmployeeRelatedByEmployeeId->getEmployeeId()) {
            $this->aEmployeeRelatedByEmployeeId = null;
        }
        if ($this->aCompany !== null && $this->company_id !== $this->aCompany->getCompanyId()) {
            $this->aCompany = null;
        }
        if ($this->aEmployeeRelatedByAllocatedTo !== null && $this->allocated_to !== $this->aEmployeeRelatedByAllocatedTo->getEmployeeId()) {
            $this->aEmployeeRelatedByAllocatedTo = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(TicketsTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildTicketsQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aTicketType = null;
            $this->aOutlets = null;
            $this->aEmployeeRelatedByEmployeeId = null;
            $this->aCompany = null;
            $this->aEmployeeRelatedByAllocatedTo = null;
            $this->collTicketRepliess = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see Tickets::setDeleted()
     * @see Tickets::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(TicketsTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildTicketsQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(TicketsTableMap::DATABASE_NAME);
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
                TicketsTableMap::addInstanceToPool($this);
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

            if ($this->aTicketType !== null) {
                if ($this->aTicketType->isModified() || $this->aTicketType->isNew()) {
                    $affectedRows += $this->aTicketType->save($con);
                }
                $this->setTicketType($this->aTicketType);
            }

            if ($this->aOutlets !== null) {
                if ($this->aOutlets->isModified() || $this->aOutlets->isNew()) {
                    $affectedRows += $this->aOutlets->save($con);
                }
                $this->setOutlets($this->aOutlets);
            }

            if ($this->aEmployeeRelatedByEmployeeId !== null) {
                if ($this->aEmployeeRelatedByEmployeeId->isModified() || $this->aEmployeeRelatedByEmployeeId->isNew()) {
                    $affectedRows += $this->aEmployeeRelatedByEmployeeId->save($con);
                }
                $this->setEmployeeRelatedByEmployeeId($this->aEmployeeRelatedByEmployeeId);
            }

            if ($this->aCompany !== null) {
                if ($this->aCompany->isModified() || $this->aCompany->isNew()) {
                    $affectedRows += $this->aCompany->save($con);
                }
                $this->setCompany($this->aCompany);
            }

            if ($this->aEmployeeRelatedByAllocatedTo !== null) {
                if ($this->aEmployeeRelatedByAllocatedTo->isModified() || $this->aEmployeeRelatedByAllocatedTo->isNew()) {
                    $affectedRows += $this->aEmployeeRelatedByAllocatedTo->save($con);
                }
                $this->setEmployeeRelatedByAllocatedTo($this->aEmployeeRelatedByAllocatedTo);
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

            if ($this->ticketRepliessScheduledForDeletion !== null) {
                if (!$this->ticketRepliessScheduledForDeletion->isEmpty()) {
                    \entities\TicketRepliesQuery::create()
                        ->filterByPrimaryKeys($this->ticketRepliessScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->ticketRepliessScheduledForDeletion = null;
                }
            }

            if ($this->collTicketRepliess !== null) {
                foreach ($this->collTicketRepliess as $referrerFK) {
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

        $this->modifiedColumns[TicketsTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . TicketsTableMap::COL_ID . ')');
        }
        if (null === $this->id) {
            try {
                $dataFetcher = $con->query("SELECT nextval('tickets_id_seq')");
                $this->id = (int) $dataFetcher->fetchColumn();
            } catch (Exception $e) {
                throw new PropelException('Unable to get sequence id.', 0, $e);
            }
        }


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(TicketsTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(TicketsTableMap::COL_TICKET_TYPE_ID)) {
            $modifiedColumns[':p' . $index++]  = 'ticket_type_id';
        }
        if ($this->isColumnModified(TicketsTableMap::COL_OUTLET_ID)) {
            $modifiedColumns[':p' . $index++]  = 'outlet_id';
        }
        if ($this->isColumnModified(TicketsTableMap::COL_MEDIA_ID)) {
            $modifiedColumns[':p' . $index++]  = 'media_id';
        }
        if ($this->isColumnModified(TicketsTableMap::COL_DESCRIPTION)) {
            $modifiedColumns[':p' . $index++]  = 'description';
        }
        if ($this->isColumnModified(TicketsTableMap::COL_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'status';
        }
        if ($this->isColumnModified(TicketsTableMap::COL_EMPLOYEE_ID)) {
            $modifiedColumns[':p' . $index++]  = 'employee_id';
        }
        if ($this->isColumnModified(TicketsTableMap::COL_COMPANY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'company_id';
        }
        if ($this->isColumnModified(TicketsTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(TicketsTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }
        if ($this->isColumnModified(TicketsTableMap::COL_INTEGRATION_ID)) {
            $modifiedColumns[':p' . $index++]  = 'integration_id';
        }
        if ($this->isColumnModified(TicketsTableMap::COL_ALLOCATED_TO)) {
            $modifiedColumns[':p' . $index++]  = 'allocated_to';
        }

        $sql = sprintf(
            'INSERT INTO tickets (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id':
                        $stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);

                        break;
                    case 'ticket_type_id':
                        $stmt->bindValue($identifier, $this->ticket_type_id, PDO::PARAM_INT);

                        break;
                    case 'outlet_id':
                        $stmt->bindValue($identifier, $this->outlet_id, PDO::PARAM_INT);

                        break;
                    case 'media_id':
                        $stmt->bindValue($identifier, $this->media_id, PDO::PARAM_STR);

                        break;
                    case 'description':
                        $stmt->bindValue($identifier, $this->description, PDO::PARAM_STR);

                        break;
                    case 'status':
                        $stmt->bindValue($identifier, $this->status, PDO::PARAM_STR);

                        break;
                    case 'employee_id':
                        $stmt->bindValue($identifier, $this->employee_id, PDO::PARAM_INT);

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
                    case 'integration_id':
                        $stmt->bindValue($identifier, $this->integration_id, PDO::PARAM_STR);

                        break;
                    case 'allocated_to':
                        $stmt->bindValue($identifier, $this->allocated_to, PDO::PARAM_INT);

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
        $pos = TicketsTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getId();

            case 1:
                return $this->getTicketTypeId();

            case 2:
                return $this->getOutletId();

            case 3:
                return $this->getMediaId();

            case 4:
                return $this->getDescription();

            case 5:
                return $this->getStatus();

            case 6:
                return $this->getEmployeeId();

            case 7:
                return $this->getCompanyId();

            case 8:
                return $this->getCreatedAt();

            case 9:
                return $this->getUpdatedAt();

            case 10:
                return $this->getIntegrationId();

            case 11:
                return $this->getAllocatedTo();

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
        if (isset($alreadyDumpedObjects['Tickets'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['Tickets'][$this->hashCode()] = true;
        $keys = TicketsTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getId(),
            $keys[1] => $this->getTicketTypeId(),
            $keys[2] => $this->getOutletId(),
            $keys[3] => $this->getMediaId(),
            $keys[4] => $this->getDescription(),
            $keys[5] => $this->getStatus(),
            $keys[6] => $this->getEmployeeId(),
            $keys[7] => $this->getCompanyId(),
            $keys[8] => $this->getCreatedAt(),
            $keys[9] => $this->getUpdatedAt(),
            $keys[10] => $this->getIntegrationId(),
            $keys[11] => $this->getAllocatedTo(),
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
            if (null !== $this->aTicketType) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'ticketType';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'ticket_type';
                        break;
                    default:
                        $key = 'TicketType';
                }

                $result[$key] = $this->aTicketType->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aOutlets) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'outlets';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'outlets';
                        break;
                    default:
                        $key = 'Outlets';
                }

                $result[$key] = $this->aOutlets->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aEmployeeRelatedByEmployeeId) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'employee';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'employee';
                        break;
                    default:
                        $key = 'Employee';
                }

                $result[$key] = $this->aEmployeeRelatedByEmployeeId->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
            if (null !== $this->aEmployeeRelatedByAllocatedTo) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'employee';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'employee';
                        break;
                    default:
                        $key = 'Employee';
                }

                $result[$key] = $this->aEmployeeRelatedByAllocatedTo->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collTicketRepliess) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'ticketRepliess';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'ticket_repliess';
                        break;
                    default:
                        $key = 'TicketRepliess';
                }

                $result[$key] = $this->collTicketRepliess->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = TicketsTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setId($value);
                break;
            case 1:
                $this->setTicketTypeId($value);
                break;
            case 2:
                $this->setOutletId($value);
                break;
            case 3:
                $this->setMediaId($value);
                break;
            case 4:
                $this->setDescription($value);
                break;
            case 5:
                $this->setStatus($value);
                break;
            case 6:
                $this->setEmployeeId($value);
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
            case 10:
                $this->setIntegrationId($value);
                break;
            case 11:
                $this->setAllocatedTo($value);
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
        $keys = TicketsTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setTicketTypeId($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setOutletId($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setMediaId($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setDescription($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setStatus($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setEmployeeId($arr[$keys[6]]);
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
        if (array_key_exists($keys[10], $arr)) {
            $this->setIntegrationId($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setAllocatedTo($arr[$keys[11]]);
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
        $criteria = new Criteria(TicketsTableMap::DATABASE_NAME);

        if ($this->isColumnModified(TicketsTableMap::COL_ID)) {
            $criteria->add(TicketsTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(TicketsTableMap::COL_TICKET_TYPE_ID)) {
            $criteria->add(TicketsTableMap::COL_TICKET_TYPE_ID, $this->ticket_type_id);
        }
        if ($this->isColumnModified(TicketsTableMap::COL_OUTLET_ID)) {
            $criteria->add(TicketsTableMap::COL_OUTLET_ID, $this->outlet_id);
        }
        if ($this->isColumnModified(TicketsTableMap::COL_MEDIA_ID)) {
            $criteria->add(TicketsTableMap::COL_MEDIA_ID, $this->media_id);
        }
        if ($this->isColumnModified(TicketsTableMap::COL_DESCRIPTION)) {
            $criteria->add(TicketsTableMap::COL_DESCRIPTION, $this->description);
        }
        if ($this->isColumnModified(TicketsTableMap::COL_STATUS)) {
            $criteria->add(TicketsTableMap::COL_STATUS, $this->status);
        }
        if ($this->isColumnModified(TicketsTableMap::COL_EMPLOYEE_ID)) {
            $criteria->add(TicketsTableMap::COL_EMPLOYEE_ID, $this->employee_id);
        }
        if ($this->isColumnModified(TicketsTableMap::COL_COMPANY_ID)) {
            $criteria->add(TicketsTableMap::COL_COMPANY_ID, $this->company_id);
        }
        if ($this->isColumnModified(TicketsTableMap::COL_CREATED_AT)) {
            $criteria->add(TicketsTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(TicketsTableMap::COL_UPDATED_AT)) {
            $criteria->add(TicketsTableMap::COL_UPDATED_AT, $this->updated_at);
        }
        if ($this->isColumnModified(TicketsTableMap::COL_INTEGRATION_ID)) {
            $criteria->add(TicketsTableMap::COL_INTEGRATION_ID, $this->integration_id);
        }
        if ($this->isColumnModified(TicketsTableMap::COL_ALLOCATED_TO)) {
            $criteria->add(TicketsTableMap::COL_ALLOCATED_TO, $this->allocated_to);
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
        $criteria = ChildTicketsQuery::create();
        $criteria->add(TicketsTableMap::COL_ID, $this->id);

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
        $validPk = null !== $this->getId();

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
        return $this->getId();
    }

    /**
     * Generic method to set the primary key (id column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \entities\Tickets (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setTicketTypeId($this->getTicketTypeId());
        $copyObj->setOutletId($this->getOutletId());
        $copyObj->setMediaId($this->getMediaId());
        $copyObj->setDescription($this->getDescription());
        $copyObj->setStatus($this->getStatus());
        $copyObj->setEmployeeId($this->getEmployeeId());
        $copyObj->setCompanyId($this->getCompanyId());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        $copyObj->setIntegrationId($this->getIntegrationId());
        $copyObj->setAllocatedTo($this->getAllocatedTo());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getTicketRepliess() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTicketReplies($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setId(NULL); // this is a auto-increment column, so set to default value
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
     * @return \entities\Tickets Clone of current object.
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
     * Declares an association between this object and a ChildTicketType object.
     *
     * @param ChildTicketType $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setTicketType(ChildTicketType $v = null)
    {
        if ($v === null) {
            $this->setTicketTypeId(NULL);
        } else {
            $this->setTicketTypeId($v->getId());
        }

        $this->aTicketType = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildTicketType object, it will not be re-added.
        if ($v !== null) {
            $v->addTickets($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildTicketType object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildTicketType The associated ChildTicketType object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getTicketType(?ConnectionInterface $con = null)
    {
        if ($this->aTicketType === null && ($this->ticket_type_id != 0)) {
            $this->aTicketType = ChildTicketTypeQuery::create()->findPk($this->ticket_type_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aTicketType->addTicketss($this);
             */
        }

        return $this->aTicketType;
    }

    /**
     * Declares an association between this object and a ChildOutlets object.
     *
     * @param ChildOutlets $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setOutlets(ChildOutlets $v = null)
    {
        if ($v === null) {
            $this->setOutletId(NULL);
        } else {
            $this->setOutletId($v->getId());
        }

        $this->aOutlets = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildOutlets object, it will not be re-added.
        if ($v !== null) {
            $v->addTickets($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildOutlets object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildOutlets The associated ChildOutlets object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOutlets(?ConnectionInterface $con = null)
    {
        if ($this->aOutlets === null && ($this->outlet_id != 0)) {
            $this->aOutlets = ChildOutletsQuery::create()->findPk($this->outlet_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aOutlets->addTicketss($this);
             */
        }

        return $this->aOutlets;
    }

    /**
     * Declares an association between this object and a ChildEmployee object.
     *
     * @param ChildEmployee $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setEmployeeRelatedByEmployeeId(ChildEmployee $v = null)
    {
        if ($v === null) {
            $this->setEmployeeId(0);
        } else {
            $this->setEmployeeId($v->getEmployeeId());
        }

        $this->aEmployeeRelatedByEmployeeId = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildEmployee object, it will not be re-added.
        if ($v !== null) {
            $v->addTicketsRelatedByEmployeeId($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildEmployee object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildEmployee The associated ChildEmployee object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getEmployeeRelatedByEmployeeId(?ConnectionInterface $con = null)
    {
        if ($this->aEmployeeRelatedByEmployeeId === null && ($this->employee_id != 0)) {
            $this->aEmployeeRelatedByEmployeeId = ChildEmployeeQuery::create()->findPk($this->employee_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aEmployeeRelatedByEmployeeId->addTicketssRelatedByEmployeeId($this);
             */
        }

        return $this->aEmployeeRelatedByEmployeeId;
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
            $this->setCompanyId(0);
        } else {
            $this->setCompanyId($v->getCompanyId());
        }

        $this->aCompany = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildCompany object, it will not be re-added.
        if ($v !== null) {
            $v->addTickets($this);
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
                $this->aCompany->addTicketss($this);
             */
        }

        return $this->aCompany;
    }

    /**
     * Declares an association between this object and a ChildEmployee object.
     *
     * @param ChildEmployee|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setEmployeeRelatedByAllocatedTo(ChildEmployee $v = null)
    {
        if ($v === null) {
            $this->setAllocatedTo(NULL);
        } else {
            $this->setAllocatedTo($v->getEmployeeId());
        }

        $this->aEmployeeRelatedByAllocatedTo = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildEmployee object, it will not be re-added.
        if ($v !== null) {
            $v->addTicketsRelatedByAllocatedTo($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildEmployee object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildEmployee|null The associated ChildEmployee object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getEmployeeRelatedByAllocatedTo(?ConnectionInterface $con = null)
    {
        if ($this->aEmployeeRelatedByAllocatedTo === null && ($this->allocated_to != 0)) {
            $this->aEmployeeRelatedByAllocatedTo = ChildEmployeeQuery::create()->findPk($this->allocated_to, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aEmployeeRelatedByAllocatedTo->addTicketssRelatedByAllocatedTo($this);
             */
        }

        return $this->aEmployeeRelatedByAllocatedTo;
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
        if ('TicketReplies' === $relationName) {
            $this->initTicketRepliess();
            return;
        }
    }

    /**
     * Clears out the collTicketRepliess collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addTicketRepliess()
     */
    public function clearTicketRepliess()
    {
        $this->collTicketRepliess = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collTicketRepliess collection loaded partially.
     *
     * @return void
     */
    public function resetPartialTicketRepliess($v = true): void
    {
        $this->collTicketRepliessPartial = $v;
    }

    /**
     * Initializes the collTicketRepliess collection.
     *
     * By default this just sets the collTicketRepliess collection to an empty array (like clearcollTicketRepliess());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTicketRepliess(bool $overrideExisting = true): void
    {
        if (null !== $this->collTicketRepliess && !$overrideExisting) {
            return;
        }

        $collectionClassName = TicketRepliesTableMap::getTableMap()->getCollectionClassName();

        $this->collTicketRepliess = new $collectionClassName;
        $this->collTicketRepliess->setModel('\entities\TicketReplies');
    }

    /**
     * Gets an array of ChildTicketReplies objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildTickets is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildTicketReplies[] List of ChildTicketReplies objects
     * @phpstan-return ObjectCollection&\Traversable<ChildTicketReplies> List of ChildTicketReplies objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getTicketRepliess(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collTicketRepliessPartial && !$this->isNew();
        if (null === $this->collTicketRepliess || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collTicketRepliess) {
                    $this->initTicketRepliess();
                } else {
                    $collectionClassName = TicketRepliesTableMap::getTableMap()->getCollectionClassName();

                    $collTicketRepliess = new $collectionClassName;
                    $collTicketRepliess->setModel('\entities\TicketReplies');

                    return $collTicketRepliess;
                }
            } else {
                $collTicketRepliess = ChildTicketRepliesQuery::create(null, $criteria)
                    ->filterByTickets($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collTicketRepliessPartial && count($collTicketRepliess)) {
                        $this->initTicketRepliess(false);

                        foreach ($collTicketRepliess as $obj) {
                            if (false == $this->collTicketRepliess->contains($obj)) {
                                $this->collTicketRepliess->append($obj);
                            }
                        }

                        $this->collTicketRepliessPartial = true;
                    }

                    return $collTicketRepliess;
                }

                if ($partial && $this->collTicketRepliess) {
                    foreach ($this->collTicketRepliess as $obj) {
                        if ($obj->isNew()) {
                            $collTicketRepliess[] = $obj;
                        }
                    }
                }

                $this->collTicketRepliess = $collTicketRepliess;
                $this->collTicketRepliessPartial = false;
            }
        }

        return $this->collTicketRepliess;
    }

    /**
     * Sets a collection of ChildTicketReplies objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $ticketRepliess A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setTicketRepliess(Collection $ticketRepliess, ?ConnectionInterface $con = null)
    {
        /** @var ChildTicketReplies[] $ticketRepliessToDelete */
        $ticketRepliessToDelete = $this->getTicketRepliess(new Criteria(), $con)->diff($ticketRepliess);


        $this->ticketRepliessScheduledForDeletion = $ticketRepliessToDelete;

        foreach ($ticketRepliessToDelete as $ticketRepliesRemoved) {
            $ticketRepliesRemoved->setTickets(null);
        }

        $this->collTicketRepliess = null;
        foreach ($ticketRepliess as $ticketReplies) {
            $this->addTicketReplies($ticketReplies);
        }

        $this->collTicketRepliess = $ticketRepliess;
        $this->collTicketRepliessPartial = false;

        return $this;
    }

    /**
     * Returns the number of related TicketReplies objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related TicketReplies objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countTicketRepliess(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collTicketRepliessPartial && !$this->isNew();
        if (null === $this->collTicketRepliess || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTicketRepliess) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getTicketRepliess());
            }

            $query = ChildTicketRepliesQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByTickets($this)
                ->count($con);
        }

        return count($this->collTicketRepliess);
    }

    /**
     * Method called to associate a ChildTicketReplies object to this object
     * through the ChildTicketReplies foreign key attribute.
     *
     * @param ChildTicketReplies $l ChildTicketReplies
     * @return $this The current object (for fluent API support)
     */
    public function addTicketReplies(ChildTicketReplies $l)
    {
        if ($this->collTicketRepliess === null) {
            $this->initTicketRepliess();
            $this->collTicketRepliessPartial = true;
        }

        if (!$this->collTicketRepliess->contains($l)) {
            $this->doAddTicketReplies($l);

            if ($this->ticketRepliessScheduledForDeletion and $this->ticketRepliessScheduledForDeletion->contains($l)) {
                $this->ticketRepliessScheduledForDeletion->remove($this->ticketRepliessScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildTicketReplies $ticketReplies The ChildTicketReplies object to add.
     */
    protected function doAddTicketReplies(ChildTicketReplies $ticketReplies): void
    {
        $this->collTicketRepliess[]= $ticketReplies;
        $ticketReplies->setTickets($this);
    }

    /**
     * @param ChildTicketReplies $ticketReplies The ChildTicketReplies object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeTicketReplies(ChildTicketReplies $ticketReplies)
    {
        if ($this->getTicketRepliess()->contains($ticketReplies)) {
            $pos = $this->collTicketRepliess->search($ticketReplies);
            $this->collTicketRepliess->remove($pos);
            if (null === $this->ticketRepliessScheduledForDeletion) {
                $this->ticketRepliessScheduledForDeletion = clone $this->collTicketRepliess;
                $this->ticketRepliessScheduledForDeletion->clear();
            }
            $this->ticketRepliessScheduledForDeletion[]= clone $ticketReplies;
            $ticketReplies->setTickets(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Tickets is new, it will return
     * an empty collection; or if this Tickets has previously
     * been saved, it will retrieve related TicketRepliess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Tickets.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildTicketReplies[] List of ChildTicketReplies objects
     * @phpstan-return ObjectCollection&\Traversable<ChildTicketReplies}> List of ChildTicketReplies objects
     */
    public function getTicketRepliessJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildTicketRepliesQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getTicketRepliess($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Tickets is new, it will return
     * an empty collection; or if this Tickets has previously
     * been saved, it will retrieve related TicketRepliess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Tickets.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildTicketReplies[] List of ChildTicketReplies objects
     * @phpstan-return ObjectCollection&\Traversable<ChildTicketReplies}> List of ChildTicketReplies objects
     */
    public function getTicketRepliessJoinEmployee(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildTicketRepliesQuery::create(null, $criteria);
        $query->joinWith('Employee', $joinBehavior);

        return $this->getTicketRepliess($query, $con);
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
        if (null !== $this->aTicketType) {
            $this->aTicketType->removeTickets($this);
        }
        if (null !== $this->aOutlets) {
            $this->aOutlets->removeTickets($this);
        }
        if (null !== $this->aEmployeeRelatedByEmployeeId) {
            $this->aEmployeeRelatedByEmployeeId->removeTicketsRelatedByEmployeeId($this);
        }
        if (null !== $this->aCompany) {
            $this->aCompany->removeTickets($this);
        }
        if (null !== $this->aEmployeeRelatedByAllocatedTo) {
            $this->aEmployeeRelatedByAllocatedTo->removeTicketsRelatedByAllocatedTo($this);
        }
        $this->id = null;
        $this->ticket_type_id = null;
        $this->outlet_id = null;
        $this->media_id = null;
        $this->description = null;
        $this->status = null;
        $this->employee_id = null;
        $this->company_id = null;
        $this->created_at = null;
        $this->updated_at = null;
        $this->integration_id = null;
        $this->allocated_to = null;
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
            if ($this->collTicketRepliess) {
                foreach ($this->collTicketRepliess as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collTicketRepliess = null;
        $this->aTicketType = null;
        $this->aOutlets = null;
        $this->aEmployeeRelatedByEmployeeId = null;
        $this->aCompany = null;
        $this->aEmployeeRelatedByAllocatedTo = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(TicketsTableMap::DEFAULT_STRING_FORMAT);
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
