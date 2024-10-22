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
use entities\BrandCampiagnVisitPlan as ChildBrandCampiagnVisitPlan;
use entities\BrandCampiagnVisitPlanQuery as ChildBrandCampiagnVisitPlanQuery;
use entities\Company as ChildCompany;
use entities\CompanyQuery as ChildCompanyQuery;
use entities\Dailycalls as ChildDailycalls;
use entities\DailycallsQuery as ChildDailycallsQuery;
use entities\Dayplan as ChildDayplan;
use entities\DayplanQuery as ChildDayplanQuery;
use entities\MediaFiles as ChildMediaFiles;
use entities\MediaFilesQuery as ChildMediaFilesQuery;
use entities\OrgUnit as ChildOrgUnit;
use entities\OrgUnitQuery as ChildOrgUnitQuery;
use entities\Tourplans as ChildTourplans;
use entities\TourplansQuery as ChildTourplansQuery;
use entities\Map\AgendatypesTableMap;
use entities\Map\BrandCampiagnVisitPlanTableMap;
use entities\Map\DailycallsTableMap;
use entities\Map\DayplanTableMap;
use entities\Map\TourplansTableMap;

/**
 * Base class that represents a row from the 'agendatypes' table.
 *
 *
 *
 * @package    propel.generator.entities.Base
 */
abstract class Agendatypes implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\entities\\Map\\AgendatypesTableMap';


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
     * The value for the agendaid field.
     *
     * @var        int
     */
    protected $agendaid;

    /**
     * The value for the agendname field.
     *
     * @var        string|null
     */
    protected $agendname;

    /**
     * The value for the agendaimage field.
     *
     * @var        int|null
     */
    protected $agendaimage;

    /**
     * The value for the agendacontroltype field.
     *
     * @var        string|null
     */
    protected $agendacontroltype;

    /**
     * The value for the company_id field.
     *
     * @var        int
     */
    protected $company_id;

    /**
     * The value for the orgunitid field.
     *
     * @var        int|null
     */
    protected $orgunitid;

    /**
     * The value for the status field.
     *
     * @var        string|null
     */
    protected $status;

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
     * The value for the is_private field.
     *
     * Note: this column has a database default value of: false
     * @var        boolean|null
     */
    protected $is_private;

    /**
     * @var        ChildOrgUnit
     */
    protected $aOrgUnit;

    /**
     * @var        ChildCompany
     */
    protected $aCompany;

    /**
     * @var        ChildMediaFiles
     */
    protected $aMediaFiles;

    /**
     * @var        ObjectCollection|ChildBrandCampiagnVisitPlan[] Collection to store aggregation of ChildBrandCampiagnVisitPlan objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildBrandCampiagnVisitPlan> Collection to store aggregation of ChildBrandCampiagnVisitPlan objects.
     */
    protected $collBrandCampiagnVisitPlans;
    protected $collBrandCampiagnVisitPlansPartial;

    /**
     * @var        ObjectCollection|ChildDailycalls[] Collection to store aggregation of ChildDailycalls objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildDailycalls> Collection to store aggregation of ChildDailycalls objects.
     */
    protected $collDailycallss;
    protected $collDailycallssPartial;

    /**
     * @var        ObjectCollection|ChildDayplan[] Collection to store aggregation of ChildDayplan objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildDayplan> Collection to store aggregation of ChildDayplan objects.
     */
    protected $collDayplans;
    protected $collDayplansPartial;

    /**
     * @var        ObjectCollection|ChildTourplans[] Collection to store aggregation of ChildTourplans objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildTourplans> Collection to store aggregation of ChildTourplans objects.
     */
    protected $collTourplanss;
    protected $collTourplanssPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildBrandCampiagnVisitPlan[]
     * @phpstan-var ObjectCollection&\Traversable<ChildBrandCampiagnVisitPlan>
     */
    protected $brandCampiagnVisitPlansScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildDailycalls[]
     * @phpstan-var ObjectCollection&\Traversable<ChildDailycalls>
     */
    protected $dailycallssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildDayplan[]
     * @phpstan-var ObjectCollection&\Traversable<ChildDayplan>
     */
    protected $dayplansScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildTourplans[]
     * @phpstan-var ObjectCollection&\Traversable<ChildTourplans>
     */
    protected $tourplanssScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues(): void
    {
        $this->is_private = false;
    }

    /**
     * Initializes internal state of entities\Base\Agendatypes object.
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
     * Compares this with another <code>Agendatypes</code> instance.  If
     * <code>obj</code> is an instance of <code>Agendatypes</code>, delegates to
     * <code>equals(Agendatypes)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [agendaid] column value.
     *
     * @return int
     */
    public function getAgendaid()
    {
        return $this->agendaid;
    }

    /**
     * Get the [agendname] column value.
     *
     * @return string|null
     */
    public function getAgendname()
    {
        return $this->agendname;
    }

    /**
     * Get the [agendaimage] column value.
     *
     * @return int|null
     */
    public function getAgendaimage()
    {
        return $this->agendaimage;
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
     * Get the [company_id] column value.
     *
     * @return int
     */
    public function getCompanyId()
    {
        return $this->company_id;
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
     * Get the [status] column value.
     *
     * @return string|null
     */
    public function getStatus()
    {
        return $this->status;
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
     * Get the [is_private] column value.
     *
     * @return boolean|null
     */
    public function getIsPrivate()
    {
        return $this->is_private;
    }

    /**
     * Get the [is_private] column value.
     *
     * @return boolean|null
     */
    public function isPrivate()
    {
        return $this->getIsPrivate();
    }

    /**
     * Set the value of [agendaid] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setAgendaid($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->agendaid !== $v) {
            $this->agendaid = $v;
            $this->modifiedColumns[AgendatypesTableMap::COL_AGENDAID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [agendname] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setAgendname($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->agendname !== $v) {
            $this->agendname = $v;
            $this->modifiedColumns[AgendatypesTableMap::COL_AGENDNAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [agendaimage] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setAgendaimage($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->agendaimage !== $v) {
            $this->agendaimage = $v;
            $this->modifiedColumns[AgendatypesTableMap::COL_AGENDAIMAGE] = true;
        }

        if ($this->aMediaFiles !== null && $this->aMediaFiles->getMediaId() !== $v) {
            $this->aMediaFiles = null;
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
            $this->modifiedColumns[AgendatypesTableMap::COL_AGENDACONTROLTYPE] = true;
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
            $this->modifiedColumns[AgendatypesTableMap::COL_COMPANY_ID] = true;
        }

        if ($this->aCompany !== null && $this->aCompany->getCompanyId() !== $v) {
            $this->aCompany = null;
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
            $this->modifiedColumns[AgendatypesTableMap::COL_ORGUNITID] = true;
        }

        if ($this->aOrgUnit !== null && $this->aOrgUnit->getOrgunitid() !== $v) {
            $this->aOrgUnit = null;
        }

        return $this;
    }

    /**
     * Set the value of [status] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setStatus($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->status !== $v) {
            $this->status = $v;
            $this->modifiedColumns[AgendatypesTableMap::COL_STATUS] = true;
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
                $this->modifiedColumns[AgendatypesTableMap::COL_CREATED_AT] = true;
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
                $this->modifiedColumns[AgendatypesTableMap::COL_UPDATED_AT] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Sets the value of the [is_private] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param bool|integer|string|null $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setIsPrivate($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->is_private !== $v) {
            $this->is_private = $v;
            $this->modifiedColumns[AgendatypesTableMap::COL_IS_PRIVATE] = true;
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
            if ($this->is_private !== false) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : AgendatypesTableMap::translateFieldName('Agendaid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->agendaid = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : AgendatypesTableMap::translateFieldName('Agendname', TableMap::TYPE_PHPNAME, $indexType)];
            $this->agendname = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : AgendatypesTableMap::translateFieldName('Agendaimage', TableMap::TYPE_PHPNAME, $indexType)];
            $this->agendaimage = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : AgendatypesTableMap::translateFieldName('Agendacontroltype', TableMap::TYPE_PHPNAME, $indexType)];
            $this->agendacontroltype = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : AgendatypesTableMap::translateFieldName('CompanyId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->company_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : AgendatypesTableMap::translateFieldName('Orgunitid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->orgunitid = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : AgendatypesTableMap::translateFieldName('Status', TableMap::TYPE_PHPNAME, $indexType)];
            $this->status = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : AgendatypesTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : AgendatypesTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : AgendatypesTableMap::translateFieldName('IsPrivate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_private = (null !== $col) ? (boolean) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 10; // 10 = AgendatypesTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\entities\\Agendatypes'), 0, $e);
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
        if ($this->aMediaFiles !== null && $this->agendaimage !== $this->aMediaFiles->getMediaId()) {
            $this->aMediaFiles = null;
        }
        if ($this->aCompany !== null && $this->company_id !== $this->aCompany->getCompanyId()) {
            $this->aCompany = null;
        }
        if ($this->aOrgUnit !== null && $this->orgunitid !== $this->aOrgUnit->getOrgunitid()) {
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
            $con = Propel::getServiceContainer()->getReadConnection(AgendatypesTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildAgendatypesQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aOrgUnit = null;
            $this->aCompany = null;
            $this->aMediaFiles = null;
            $this->collBrandCampiagnVisitPlans = null;

            $this->collDailycallss = null;

            $this->collDayplans = null;

            $this->collTourplanss = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see Agendatypes::setDeleted()
     * @see Agendatypes::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(AgendatypesTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildAgendatypesQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(AgendatypesTableMap::DATABASE_NAME);
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
                AgendatypesTableMap::addInstanceToPool($this);
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

            if ($this->aCompany !== null) {
                if ($this->aCompany->isModified() || $this->aCompany->isNew()) {
                    $affectedRows += $this->aCompany->save($con);
                }
                $this->setCompany($this->aCompany);
            }

            if ($this->aMediaFiles !== null) {
                if ($this->aMediaFiles->isModified() || $this->aMediaFiles->isNew()) {
                    $affectedRows += $this->aMediaFiles->save($con);
                }
                $this->setMediaFiles($this->aMediaFiles);
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

            if ($this->brandCampiagnVisitPlansScheduledForDeletion !== null) {
                if (!$this->brandCampiagnVisitPlansScheduledForDeletion->isEmpty()) {
                    foreach ($this->brandCampiagnVisitPlansScheduledForDeletion as $brandCampiagnVisitPlan) {
                        // need to save related object because we set the relation to null
                        $brandCampiagnVisitPlan->save($con);
                    }
                    $this->brandCampiagnVisitPlansScheduledForDeletion = null;
                }
            }

            if ($this->collBrandCampiagnVisitPlans !== null) {
                foreach ($this->collBrandCampiagnVisitPlans as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->dailycallssScheduledForDeletion !== null) {
                if (!$this->dailycallssScheduledForDeletion->isEmpty()) {
                    foreach ($this->dailycallssScheduledForDeletion as $dailycalls) {
                        // need to save related object because we set the relation to null
                        $dailycalls->save($con);
                    }
                    $this->dailycallssScheduledForDeletion = null;
                }
            }

            if ($this->collDailycallss !== null) {
                foreach ($this->collDailycallss as $referrerFK) {
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

        $this->modifiedColumns[AgendatypesTableMap::COL_AGENDAID] = true;
        if (null !== $this->agendaid) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . AgendatypesTableMap::COL_AGENDAID . ')');
        }
        if (null === $this->agendaid) {
            try {
                $dataFetcher = $con->query("SELECT nextval('agendatypes_agendaid_seq')");
                $this->agendaid = (int) $dataFetcher->fetchColumn();
            } catch (Exception $e) {
                throw new PropelException('Unable to get sequence id.', 0, $e);
            }
        }


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(AgendatypesTableMap::COL_AGENDAID)) {
            $modifiedColumns[':p' . $index++]  = 'agendaid';
        }
        if ($this->isColumnModified(AgendatypesTableMap::COL_AGENDNAME)) {
            $modifiedColumns[':p' . $index++]  = 'agendname';
        }
        if ($this->isColumnModified(AgendatypesTableMap::COL_AGENDAIMAGE)) {
            $modifiedColumns[':p' . $index++]  = 'agendaimage';
        }
        if ($this->isColumnModified(AgendatypesTableMap::COL_AGENDACONTROLTYPE)) {
            $modifiedColumns[':p' . $index++]  = 'agendacontroltype';
        }
        if ($this->isColumnModified(AgendatypesTableMap::COL_COMPANY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'company_id';
        }
        if ($this->isColumnModified(AgendatypesTableMap::COL_ORGUNITID)) {
            $modifiedColumns[':p' . $index++]  = 'orgunitid';
        }
        if ($this->isColumnModified(AgendatypesTableMap::COL_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'status';
        }
        if ($this->isColumnModified(AgendatypesTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(AgendatypesTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }
        if ($this->isColumnModified(AgendatypesTableMap::COL_IS_PRIVATE)) {
            $modifiedColumns[':p' . $index++]  = 'is_private';
        }

        $sql = sprintf(
            'INSERT INTO agendatypes (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'agendaid':
                        $stmt->bindValue($identifier, $this->agendaid, PDO::PARAM_INT);

                        break;
                    case 'agendname':
                        $stmt->bindValue($identifier, $this->agendname, PDO::PARAM_STR);

                        break;
                    case 'agendaimage':
                        $stmt->bindValue($identifier, $this->agendaimage, PDO::PARAM_INT);

                        break;
                    case 'agendacontroltype':
                        $stmt->bindValue($identifier, $this->agendacontroltype, PDO::PARAM_STR);

                        break;
                    case 'company_id':
                        $stmt->bindValue($identifier, $this->company_id, PDO::PARAM_INT);

                        break;
                    case 'orgunitid':
                        $stmt->bindValue($identifier, $this->orgunitid, PDO::PARAM_INT);

                        break;
                    case 'status':
                        $stmt->bindValue($identifier, $this->status, PDO::PARAM_STR);

                        break;
                    case 'created_at':
                        $stmt->bindValue($identifier, $this->created_at ? $this->created_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'updated_at':
                        $stmt->bindValue($identifier, $this->updated_at ? $this->updated_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'is_private':
                        $stmt->bindValue($identifier, $this->is_private, PDO::PARAM_BOOL);

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
        $pos = AgendatypesTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getAgendaid();

            case 1:
                return $this->getAgendname();

            case 2:
                return $this->getAgendaimage();

            case 3:
                return $this->getAgendacontroltype();

            case 4:
                return $this->getCompanyId();

            case 5:
                return $this->getOrgunitid();

            case 6:
                return $this->getStatus();

            case 7:
                return $this->getCreatedAt();

            case 8:
                return $this->getUpdatedAt();

            case 9:
                return $this->getIsPrivate();

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
        if (isset($alreadyDumpedObjects['Agendatypes'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['Agendatypes'][$this->hashCode()] = true;
        $keys = AgendatypesTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getAgendaid(),
            $keys[1] => $this->getAgendname(),
            $keys[2] => $this->getAgendaimage(),
            $keys[3] => $this->getAgendacontroltype(),
            $keys[4] => $this->getCompanyId(),
            $keys[5] => $this->getOrgunitid(),
            $keys[6] => $this->getStatus(),
            $keys[7] => $this->getCreatedAt(),
            $keys[8] => $this->getUpdatedAt(),
            $keys[9] => $this->getIsPrivate(),
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
            if (null !== $this->aMediaFiles) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'mediaFiles';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'media_files';
                        break;
                    default:
                        $key = 'MediaFiles';
                }

                $result[$key] = $this->aMediaFiles->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collBrandCampiagnVisitPlans) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'brandCampiagnVisitPlans';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'brand_campiagn_visit_plans';
                        break;
                    default:
                        $key = 'BrandCampiagnVisitPlans';
                }

                $result[$key] = $this->collBrandCampiagnVisitPlans->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collDailycallss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'dailycallss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'dailycallss';
                        break;
                    default:
                        $key = 'Dailycallss';
                }

                $result[$key] = $this->collDailycallss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = AgendatypesTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setAgendaid($value);
                break;
            case 1:
                $this->setAgendname($value);
                break;
            case 2:
                $this->setAgendaimage($value);
                break;
            case 3:
                $this->setAgendacontroltype($value);
                break;
            case 4:
                $this->setCompanyId($value);
                break;
            case 5:
                $this->setOrgunitid($value);
                break;
            case 6:
                $this->setStatus($value);
                break;
            case 7:
                $this->setCreatedAt($value);
                break;
            case 8:
                $this->setUpdatedAt($value);
                break;
            case 9:
                $this->setIsPrivate($value);
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
        $keys = AgendatypesTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setAgendaid($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setAgendname($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setAgendaimage($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setAgendacontroltype($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setCompanyId($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setOrgunitid($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setStatus($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setCreatedAt($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setUpdatedAt($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setIsPrivate($arr[$keys[9]]);
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
        $criteria = new Criteria(AgendatypesTableMap::DATABASE_NAME);

        if ($this->isColumnModified(AgendatypesTableMap::COL_AGENDAID)) {
            $criteria->add(AgendatypesTableMap::COL_AGENDAID, $this->agendaid);
        }
        if ($this->isColumnModified(AgendatypesTableMap::COL_AGENDNAME)) {
            $criteria->add(AgendatypesTableMap::COL_AGENDNAME, $this->agendname);
        }
        if ($this->isColumnModified(AgendatypesTableMap::COL_AGENDAIMAGE)) {
            $criteria->add(AgendatypesTableMap::COL_AGENDAIMAGE, $this->agendaimage);
        }
        if ($this->isColumnModified(AgendatypesTableMap::COL_AGENDACONTROLTYPE)) {
            $criteria->add(AgendatypesTableMap::COL_AGENDACONTROLTYPE, $this->agendacontroltype);
        }
        if ($this->isColumnModified(AgendatypesTableMap::COL_COMPANY_ID)) {
            $criteria->add(AgendatypesTableMap::COL_COMPANY_ID, $this->company_id);
        }
        if ($this->isColumnModified(AgendatypesTableMap::COL_ORGUNITID)) {
            $criteria->add(AgendatypesTableMap::COL_ORGUNITID, $this->orgunitid);
        }
        if ($this->isColumnModified(AgendatypesTableMap::COL_STATUS)) {
            $criteria->add(AgendatypesTableMap::COL_STATUS, $this->status);
        }
        if ($this->isColumnModified(AgendatypesTableMap::COL_CREATED_AT)) {
            $criteria->add(AgendatypesTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(AgendatypesTableMap::COL_UPDATED_AT)) {
            $criteria->add(AgendatypesTableMap::COL_UPDATED_AT, $this->updated_at);
        }
        if ($this->isColumnModified(AgendatypesTableMap::COL_IS_PRIVATE)) {
            $criteria->add(AgendatypesTableMap::COL_IS_PRIVATE, $this->is_private);
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
        $criteria = ChildAgendatypesQuery::create();
        $criteria->add(AgendatypesTableMap::COL_AGENDAID, $this->agendaid);

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
        $validPk = null !== $this->getAgendaid();

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
        return $this->getAgendaid();
    }

    /**
     * Generic method to set the primary key (agendaid column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setAgendaid($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getAgendaid();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \entities\Agendatypes (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setAgendname($this->getAgendname());
        $copyObj->setAgendaimage($this->getAgendaimage());
        $copyObj->setAgendacontroltype($this->getAgendacontroltype());
        $copyObj->setCompanyId($this->getCompanyId());
        $copyObj->setOrgunitid($this->getOrgunitid());
        $copyObj->setStatus($this->getStatus());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        $copyObj->setIsPrivate($this->getIsPrivate());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getBrandCampiagnVisitPlans() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBrandCampiagnVisitPlan($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getDailycallss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addDailycalls($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getDayplans() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addDayplan($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getTourplanss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTourplans($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setAgendaid(NULL); // this is a auto-increment column, so set to default value
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
     * @return \entities\Agendatypes Clone of current object.
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
            $this->setOrgunitid(NULL);
        } else {
            $this->setOrgunitid($v->getOrgunitid());
        }

        $this->aOrgUnit = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildOrgUnit object, it will not be re-added.
        if ($v !== null) {
            $v->addAgendatypes($this);
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
                $this->aOrgUnit->addAgendatypess($this);
             */
        }

        return $this->aOrgUnit;
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
            $v->addAgendatypes($this);
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
                $this->aCompany->addAgendatypess($this);
             */
        }

        return $this->aCompany;
    }

    /**
     * Declares an association between this object and a ChildMediaFiles object.
     *
     * @param ChildMediaFiles|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setMediaFiles(ChildMediaFiles $v = null)
    {
        if ($v === null) {
            $this->setAgendaimage(NULL);
        } else {
            $this->setAgendaimage($v->getMediaId());
        }

        $this->aMediaFiles = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildMediaFiles object, it will not be re-added.
        if ($v !== null) {
            $v->addAgendatypes($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildMediaFiles object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildMediaFiles|null The associated ChildMediaFiles object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getMediaFiles(?ConnectionInterface $con = null)
    {
        if ($this->aMediaFiles === null && ($this->agendaimage != 0)) {
            $this->aMediaFiles = ChildMediaFilesQuery::create()->findPk($this->agendaimage, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aMediaFiles->addAgendatypess($this);
             */
        }

        return $this->aMediaFiles;
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
        if ('BrandCampiagnVisitPlan' === $relationName) {
            $this->initBrandCampiagnVisitPlans();
            return;
        }
        if ('Dailycalls' === $relationName) {
            $this->initDailycallss();
            return;
        }
        if ('Dayplan' === $relationName) {
            $this->initDayplans();
            return;
        }
        if ('Tourplans' === $relationName) {
            $this->initTourplanss();
            return;
        }
    }

    /**
     * Clears out the collBrandCampiagnVisitPlans collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addBrandCampiagnVisitPlans()
     */
    public function clearBrandCampiagnVisitPlans()
    {
        $this->collBrandCampiagnVisitPlans = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collBrandCampiagnVisitPlans collection loaded partially.
     *
     * @return void
     */
    public function resetPartialBrandCampiagnVisitPlans($v = true): void
    {
        $this->collBrandCampiagnVisitPlansPartial = $v;
    }

    /**
     * Initializes the collBrandCampiagnVisitPlans collection.
     *
     * By default this just sets the collBrandCampiagnVisitPlans collection to an empty array (like clearcollBrandCampiagnVisitPlans());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBrandCampiagnVisitPlans(bool $overrideExisting = true): void
    {
        if (null !== $this->collBrandCampiagnVisitPlans && !$overrideExisting) {
            return;
        }

        $collectionClassName = BrandCampiagnVisitPlanTableMap::getTableMap()->getCollectionClassName();

        $this->collBrandCampiagnVisitPlans = new $collectionClassName;
        $this->collBrandCampiagnVisitPlans->setModel('\entities\BrandCampiagnVisitPlan');
    }

    /**
     * Gets an array of ChildBrandCampiagnVisitPlan objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildAgendatypes is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildBrandCampiagnVisitPlan[] List of ChildBrandCampiagnVisitPlan objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBrandCampiagnVisitPlan> List of ChildBrandCampiagnVisitPlan objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getBrandCampiagnVisitPlans(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collBrandCampiagnVisitPlansPartial && !$this->isNew();
        if (null === $this->collBrandCampiagnVisitPlans || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collBrandCampiagnVisitPlans) {
                    $this->initBrandCampiagnVisitPlans();
                } else {
                    $collectionClassName = BrandCampiagnVisitPlanTableMap::getTableMap()->getCollectionClassName();

                    $collBrandCampiagnVisitPlans = new $collectionClassName;
                    $collBrandCampiagnVisitPlans->setModel('\entities\BrandCampiagnVisitPlan');

                    return $collBrandCampiagnVisitPlans;
                }
            } else {
                $collBrandCampiagnVisitPlans = ChildBrandCampiagnVisitPlanQuery::create(null, $criteria)
                    ->filterByAgendatypes($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collBrandCampiagnVisitPlansPartial && count($collBrandCampiagnVisitPlans)) {
                        $this->initBrandCampiagnVisitPlans(false);

                        foreach ($collBrandCampiagnVisitPlans as $obj) {
                            if (false == $this->collBrandCampiagnVisitPlans->contains($obj)) {
                                $this->collBrandCampiagnVisitPlans->append($obj);
                            }
                        }

                        $this->collBrandCampiagnVisitPlansPartial = true;
                    }

                    return $collBrandCampiagnVisitPlans;
                }

                if ($partial && $this->collBrandCampiagnVisitPlans) {
                    foreach ($this->collBrandCampiagnVisitPlans as $obj) {
                        if ($obj->isNew()) {
                            $collBrandCampiagnVisitPlans[] = $obj;
                        }
                    }
                }

                $this->collBrandCampiagnVisitPlans = $collBrandCampiagnVisitPlans;
                $this->collBrandCampiagnVisitPlansPartial = false;
            }
        }

        return $this->collBrandCampiagnVisitPlans;
    }

    /**
     * Sets a collection of ChildBrandCampiagnVisitPlan objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $brandCampiagnVisitPlans A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setBrandCampiagnVisitPlans(Collection $brandCampiagnVisitPlans, ?ConnectionInterface $con = null)
    {
        /** @var ChildBrandCampiagnVisitPlan[] $brandCampiagnVisitPlansToDelete */
        $brandCampiagnVisitPlansToDelete = $this->getBrandCampiagnVisitPlans(new Criteria(), $con)->diff($brandCampiagnVisitPlans);


        $this->brandCampiagnVisitPlansScheduledForDeletion = $brandCampiagnVisitPlansToDelete;

        foreach ($brandCampiagnVisitPlansToDelete as $brandCampiagnVisitPlanRemoved) {
            $brandCampiagnVisitPlanRemoved->setAgendatypes(null);
        }

        $this->collBrandCampiagnVisitPlans = null;
        foreach ($brandCampiagnVisitPlans as $brandCampiagnVisitPlan) {
            $this->addBrandCampiagnVisitPlan($brandCampiagnVisitPlan);
        }

        $this->collBrandCampiagnVisitPlans = $brandCampiagnVisitPlans;
        $this->collBrandCampiagnVisitPlansPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BrandCampiagnVisitPlan objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BrandCampiagnVisitPlan objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countBrandCampiagnVisitPlans(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collBrandCampiagnVisitPlansPartial && !$this->isNew();
        if (null === $this->collBrandCampiagnVisitPlans || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBrandCampiagnVisitPlans) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getBrandCampiagnVisitPlans());
            }

            $query = ChildBrandCampiagnVisitPlanQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByAgendatypes($this)
                ->count($con);
        }

        return count($this->collBrandCampiagnVisitPlans);
    }

    /**
     * Method called to associate a ChildBrandCampiagnVisitPlan object to this object
     * through the ChildBrandCampiagnVisitPlan foreign key attribute.
     *
     * @param ChildBrandCampiagnVisitPlan $l ChildBrandCampiagnVisitPlan
     * @return $this The current object (for fluent API support)
     */
    public function addBrandCampiagnVisitPlan(ChildBrandCampiagnVisitPlan $l)
    {
        if ($this->collBrandCampiagnVisitPlans === null) {
            $this->initBrandCampiagnVisitPlans();
            $this->collBrandCampiagnVisitPlansPartial = true;
        }

        if (!$this->collBrandCampiagnVisitPlans->contains($l)) {
            $this->doAddBrandCampiagnVisitPlan($l);

            if ($this->brandCampiagnVisitPlansScheduledForDeletion and $this->brandCampiagnVisitPlansScheduledForDeletion->contains($l)) {
                $this->brandCampiagnVisitPlansScheduledForDeletion->remove($this->brandCampiagnVisitPlansScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildBrandCampiagnVisitPlan $brandCampiagnVisitPlan The ChildBrandCampiagnVisitPlan object to add.
     */
    protected function doAddBrandCampiagnVisitPlan(ChildBrandCampiagnVisitPlan $brandCampiagnVisitPlan): void
    {
        $this->collBrandCampiagnVisitPlans[]= $brandCampiagnVisitPlan;
        $brandCampiagnVisitPlan->setAgendatypes($this);
    }

    /**
     * @param ChildBrandCampiagnVisitPlan $brandCampiagnVisitPlan The ChildBrandCampiagnVisitPlan object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeBrandCampiagnVisitPlan(ChildBrandCampiagnVisitPlan $brandCampiagnVisitPlan)
    {
        if ($this->getBrandCampiagnVisitPlans()->contains($brandCampiagnVisitPlan)) {
            $pos = $this->collBrandCampiagnVisitPlans->search($brandCampiagnVisitPlan);
            $this->collBrandCampiagnVisitPlans->remove($pos);
            if (null === $this->brandCampiagnVisitPlansScheduledForDeletion) {
                $this->brandCampiagnVisitPlansScheduledForDeletion = clone $this->collBrandCampiagnVisitPlans;
                $this->brandCampiagnVisitPlansScheduledForDeletion->clear();
            }
            $this->brandCampiagnVisitPlansScheduledForDeletion[]= $brandCampiagnVisitPlan;
            $brandCampiagnVisitPlan->setAgendatypes(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Agendatypes is new, it will return
     * an empty collection; or if this Agendatypes has previously
     * been saved, it will retrieve related BrandCampiagnVisitPlans from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Agendatypes.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBrandCampiagnVisitPlan[] List of ChildBrandCampiagnVisitPlan objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBrandCampiagnVisitPlan}> List of ChildBrandCampiagnVisitPlan objects
     */
    public function getBrandCampiagnVisitPlansJoinBrandCampiagn(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBrandCampiagnVisitPlanQuery::create(null, $criteria);
        $query->joinWith('BrandCampiagn', $joinBehavior);

        return $this->getBrandCampiagnVisitPlans($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Agendatypes is new, it will return
     * an empty collection; or if this Agendatypes has previously
     * been saved, it will retrieve related BrandCampiagnVisitPlans from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Agendatypes.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBrandCampiagnVisitPlan[] List of ChildBrandCampiagnVisitPlan objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBrandCampiagnVisitPlan}> List of ChildBrandCampiagnVisitPlan objects
     */
    public function getBrandCampiagnVisitPlansJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBrandCampiagnVisitPlanQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getBrandCampiagnVisitPlans($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Agendatypes is new, it will return
     * an empty collection; or if this Agendatypes has previously
     * been saved, it will retrieve related BrandCampiagnVisitPlans from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Agendatypes.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBrandCampiagnVisitPlan[] List of ChildBrandCampiagnVisitPlan objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBrandCampiagnVisitPlan}> List of ChildBrandCampiagnVisitPlan objects
     */
    public function getBrandCampiagnVisitPlansJoinSurvey(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBrandCampiagnVisitPlanQuery::create(null, $criteria);
        $query->joinWith('Survey', $joinBehavior);

        return $this->getBrandCampiagnVisitPlans($query, $con);
    }

    /**
     * Clears out the collDailycallss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addDailycallss()
     */
    public function clearDailycallss()
    {
        $this->collDailycallss = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collDailycallss collection loaded partially.
     *
     * @return void
     */
    public function resetPartialDailycallss($v = true): void
    {
        $this->collDailycallssPartial = $v;
    }

    /**
     * Initializes the collDailycallss collection.
     *
     * By default this just sets the collDailycallss collection to an empty array (like clearcollDailycallss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initDailycallss(bool $overrideExisting = true): void
    {
        if (null !== $this->collDailycallss && !$overrideExisting) {
            return;
        }

        $collectionClassName = DailycallsTableMap::getTableMap()->getCollectionClassName();

        $this->collDailycallss = new $collectionClassName;
        $this->collDailycallss->setModel('\entities\Dailycalls');
    }

    /**
     * Gets an array of ChildDailycalls objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildAgendatypes is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildDailycalls[] List of ChildDailycalls objects
     * @phpstan-return ObjectCollection&\Traversable<ChildDailycalls> List of ChildDailycalls objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getDailycallss(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collDailycallssPartial && !$this->isNew();
        if (null === $this->collDailycallss || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collDailycallss) {
                    $this->initDailycallss();
                } else {
                    $collectionClassName = DailycallsTableMap::getTableMap()->getCollectionClassName();

                    $collDailycallss = new $collectionClassName;
                    $collDailycallss->setModel('\entities\Dailycalls');

                    return $collDailycallss;
                }
            } else {
                $collDailycallss = ChildDailycallsQuery::create(null, $criteria)
                    ->filterByAgendatypes($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collDailycallssPartial && count($collDailycallss)) {
                        $this->initDailycallss(false);

                        foreach ($collDailycallss as $obj) {
                            if (false == $this->collDailycallss->contains($obj)) {
                                $this->collDailycallss->append($obj);
                            }
                        }

                        $this->collDailycallssPartial = true;
                    }

                    return $collDailycallss;
                }

                if ($partial && $this->collDailycallss) {
                    foreach ($this->collDailycallss as $obj) {
                        if ($obj->isNew()) {
                            $collDailycallss[] = $obj;
                        }
                    }
                }

                $this->collDailycallss = $collDailycallss;
                $this->collDailycallssPartial = false;
            }
        }

        return $this->collDailycallss;
    }

    /**
     * Sets a collection of ChildDailycalls objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $dailycallss A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setDailycallss(Collection $dailycallss, ?ConnectionInterface $con = null)
    {
        /** @var ChildDailycalls[] $dailycallssToDelete */
        $dailycallssToDelete = $this->getDailycallss(new Criteria(), $con)->diff($dailycallss);


        $this->dailycallssScheduledForDeletion = $dailycallssToDelete;

        foreach ($dailycallssToDelete as $dailycallsRemoved) {
            $dailycallsRemoved->setAgendatypes(null);
        }

        $this->collDailycallss = null;
        foreach ($dailycallss as $dailycalls) {
            $this->addDailycalls($dailycalls);
        }

        $this->collDailycallss = $dailycallss;
        $this->collDailycallssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Dailycalls objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related Dailycalls objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countDailycallss(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collDailycallssPartial && !$this->isNew();
        if (null === $this->collDailycallss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collDailycallss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getDailycallss());
            }

            $query = ChildDailycallsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByAgendatypes($this)
                ->count($con);
        }

        return count($this->collDailycallss);
    }

    /**
     * Method called to associate a ChildDailycalls object to this object
     * through the ChildDailycalls foreign key attribute.
     *
     * @param ChildDailycalls $l ChildDailycalls
     * @return $this The current object (for fluent API support)
     */
    public function addDailycalls(ChildDailycalls $l)
    {
        if ($this->collDailycallss === null) {
            $this->initDailycallss();
            $this->collDailycallssPartial = true;
        }

        if (!$this->collDailycallss->contains($l)) {
            $this->doAddDailycalls($l);

            if ($this->dailycallssScheduledForDeletion and $this->dailycallssScheduledForDeletion->contains($l)) {
                $this->dailycallssScheduledForDeletion->remove($this->dailycallssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildDailycalls $dailycalls The ChildDailycalls object to add.
     */
    protected function doAddDailycalls(ChildDailycalls $dailycalls): void
    {
        $this->collDailycallss[]= $dailycalls;
        $dailycalls->setAgendatypes($this);
    }

    /**
     * @param ChildDailycalls $dailycalls The ChildDailycalls object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeDailycalls(ChildDailycalls $dailycalls)
    {
        if ($this->getDailycallss()->contains($dailycalls)) {
            $pos = $this->collDailycallss->search($dailycalls);
            $this->collDailycallss->remove($pos);
            if (null === $this->dailycallssScheduledForDeletion) {
                $this->dailycallssScheduledForDeletion = clone $this->collDailycallss;
                $this->dailycallssScheduledForDeletion->clear();
            }
            $this->dailycallssScheduledForDeletion[]= $dailycalls;
            $dailycalls->setAgendatypes(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Agendatypes is new, it will return
     * an empty collection; or if this Agendatypes has previously
     * been saved, it will retrieve related Dailycallss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Agendatypes.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildDailycalls[] List of ChildDailycalls objects
     * @phpstan-return ObjectCollection&\Traversable<ChildDailycalls}> List of ChildDailycalls objects
     */
    public function getDailycallssJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildDailycallsQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getDailycallss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Agendatypes is new, it will return
     * an empty collection; or if this Agendatypes has previously
     * been saved, it will retrieve related Dailycallss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Agendatypes.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildDailycalls[] List of ChildDailycalls objects
     * @phpstan-return ObjectCollection&\Traversable<ChildDailycalls}> List of ChildDailycalls objects
     */
    public function getDailycallssJoinOutletOrgData(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildDailycallsQuery::create(null, $criteria);
        $query->joinWith('OutletOrgData', $joinBehavior);

        return $this->getDailycallss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Agendatypes is new, it will return
     * an empty collection; or if this Agendatypes has previously
     * been saved, it will retrieve related Dailycallss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Agendatypes.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildDailycalls[] List of ChildDailycalls objects
     * @phpstan-return ObjectCollection&\Traversable<ChildDailycalls}> List of ChildDailycalls objects
     */
    public function getDailycallssJoinPositions(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildDailycallsQuery::create(null, $criteria);
        $query->joinWith('Positions', $joinBehavior);

        return $this->getDailycallss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Agendatypes is new, it will return
     * an empty collection; or if this Agendatypes has previously
     * been saved, it will retrieve related Dailycallss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Agendatypes.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildDailycalls[] List of ChildDailycalls objects
     * @phpstan-return ObjectCollection&\Traversable<ChildDailycalls}> List of ChildDailycalls objects
     */
    public function getDailycallssJoinGeoTowns(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildDailycallsQuery::create(null, $criteria);
        $query->joinWith('GeoTowns', $joinBehavior);

        return $this->getDailycallss($query, $con);
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
     * If this ChildAgendatypes is new, it will return
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
                    ->filterByAgendatypes($this)
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
            $dayplanRemoved->setAgendatypes(null);
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
                ->filterByAgendatypes($this)
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
        $dayplan->setAgendatypes($this);
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
            $dayplan->setAgendatypes(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Agendatypes is new, it will return
     * an empty collection; or if this Agendatypes has previously
     * been saved, it will retrieve related Dayplans from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Agendatypes.
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
     * Otherwise if this Agendatypes is new, it will return
     * an empty collection; or if this Agendatypes has previously
     * been saved, it will retrieve related Dayplans from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Agendatypes.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildDayplan[] List of ChildDayplan objects
     * @phpstan-return ObjectCollection&\Traversable<ChildDayplan}> List of ChildDayplan objects
     */
    public function getDayplansJoinBeats(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildDayplanQuery::create(null, $criteria);
        $query->joinWith('Beats', $joinBehavior);

        return $this->getDayplans($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Agendatypes is new, it will return
     * an empty collection; or if this Agendatypes has previously
     * been saved, it will retrieve related Dayplans from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Agendatypes.
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
     * Otherwise if this Agendatypes is new, it will return
     * an empty collection; or if this Agendatypes has previously
     * been saved, it will retrieve related Dayplans from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Agendatypes.
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
     * If this ChildAgendatypes is new, it will return
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
                    ->filterByAgendatypes($this)
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
            $tourplansRemoved->setAgendatypes(null);
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
                ->filterByAgendatypes($this)
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
        $tourplans->setAgendatypes($this);
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
            $tourplans->setAgendatypes(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Agendatypes is new, it will return
     * an empty collection; or if this Agendatypes has previously
     * been saved, it will retrieve related Tourplanss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Agendatypes.
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
     * Otherwise if this Agendatypes is new, it will return
     * an empty collection; or if this Agendatypes has previously
     * been saved, it will retrieve related Tourplanss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Agendatypes.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildTourplans[] List of ChildTourplans objects
     * @phpstan-return ObjectCollection&\Traversable<ChildTourplans}> List of ChildTourplans objects
     */
    public function getTourplanssJoinBeats(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildTourplansQuery::create(null, $criteria);
        $query->joinWith('Beats', $joinBehavior);

        return $this->getTourplanss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Agendatypes is new, it will return
     * an empty collection; or if this Agendatypes has previously
     * been saved, it will retrieve related Tourplanss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Agendatypes.
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
     * Otherwise if this Agendatypes is new, it will return
     * an empty collection; or if this Agendatypes has previously
     * been saved, it will retrieve related Tourplanss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Agendatypes.
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
     * Otherwise if this Agendatypes is new, it will return
     * an empty collection; or if this Agendatypes has previously
     * been saved, it will retrieve related Tourplanss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Agendatypes.
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
     * Otherwise if this Agendatypes is new, it will return
     * an empty collection; or if this Agendatypes has previously
     * been saved, it will retrieve related Tourplanss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Agendatypes.
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
     * Otherwise if this Agendatypes is new, it will return
     * an empty collection; or if this Agendatypes has previously
     * been saved, it will retrieve related Tourplanss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Agendatypes.
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
     * Otherwise if this Agendatypes is new, it will return
     * an empty collection; or if this Agendatypes has previously
     * been saved, it will retrieve related Tourplanss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Agendatypes.
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
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     *
     * @return $this
     */
    public function clear()
    {
        if (null !== $this->aOrgUnit) {
            $this->aOrgUnit->removeAgendatypes($this);
        }
        if (null !== $this->aCompany) {
            $this->aCompany->removeAgendatypes($this);
        }
        if (null !== $this->aMediaFiles) {
            $this->aMediaFiles->removeAgendatypes($this);
        }
        $this->agendaid = null;
        $this->agendname = null;
        $this->agendaimage = null;
        $this->agendacontroltype = null;
        $this->company_id = null;
        $this->orgunitid = null;
        $this->status = null;
        $this->created_at = null;
        $this->updated_at = null;
        $this->is_private = null;
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
            if ($this->collBrandCampiagnVisitPlans) {
                foreach ($this->collBrandCampiagnVisitPlans as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collDailycallss) {
                foreach ($this->collDailycallss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collDayplans) {
                foreach ($this->collDayplans as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTourplanss) {
                foreach ($this->collTourplanss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collBrandCampiagnVisitPlans = null;
        $this->collDailycallss = null;
        $this->collDayplans = null;
        $this->collTourplanss = null;
        $this->aOrgUnit = null;
        $this->aCompany = null;
        $this->aMediaFiles = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(AgendatypesTableMap::DEFAULT_STRING_FORMAT);
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
