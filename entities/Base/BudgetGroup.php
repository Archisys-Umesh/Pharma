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
use entities\BudgetExp as ChildBudgetExp;
use entities\BudgetExpQuery as ChildBudgetExpQuery;
use entities\BudgetGrades as ChildBudgetGrades;
use entities\BudgetGradesQuery as ChildBudgetGradesQuery;
use entities\BudgetGroup as ChildBudgetGroup;
use entities\BudgetGroupQuery as ChildBudgetGroupQuery;
use entities\Company as ChildCompany;
use entities\CompanyQuery as ChildCompanyQuery;
use entities\Expenses as ChildExpenses;
use entities\ExpensesQuery as ChildExpensesQuery;
use entities\Map\BudgetExpTableMap;
use entities\Map\BudgetGradesTableMap;
use entities\Map\BudgetGroupTableMap;
use entities\Map\ExpensesTableMap;

/**
 * Base class that represents a row from the 'budget_group' table.
 *
 *
 *
 * @package    propel.generator.entities.Base
 */
abstract class BudgetGroup implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\entities\\Map\\BudgetGroupTableMap';


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
     * The value for the bgid field.
     *
     * @var        int
     */
    protected $bgid;

    /**
     * The value for the company_id field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $company_id;

    /**
     * The value for the group_name field.
     *
     * @var        string
     */
    protected $group_name;

    /**
     * The value for the groupcode field.
     *
     * @var        string|null
     */
    protected $groupcode;

    /**
     * The value for the maxlimit field.
     *
     * @var        string
     */
    protected $maxlimit;

    /**
     * The value for the notes field.
     *
     * @var        string|null
     */
    protected $notes;

    /**
     * The value for the status field.
     *
     * Note: this column has a database default value of: 1
     * @var        int|null
     */
    protected $status;

    /**
     * The value for the created_at field.
     *
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
     * The value for the is_default field.
     *
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $is_default;

    /**
     * @var        ChildCompany
     */
    protected $aCompany;

    /**
     * @var        ObjectCollection|ChildBudgetExp[] Collection to store aggregation of ChildBudgetExp objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildBudgetExp> Collection to store aggregation of ChildBudgetExp objects.
     */
    protected $collBudgetExps;
    protected $collBudgetExpsPartial;

    /**
     * @var        ObjectCollection|ChildBudgetGrades[] Collection to store aggregation of ChildBudgetGrades objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildBudgetGrades> Collection to store aggregation of ChildBudgetGrades objects.
     */
    protected $collBudgetGradess;
    protected $collBudgetGradessPartial;

    /**
     * @var        ObjectCollection|ChildExpenses[] Collection to store aggregation of ChildExpenses objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildExpenses> Collection to store aggregation of ChildExpenses objects.
     */
    protected $collExpensess;
    protected $collExpensessPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildBudgetExp[]
     * @phpstan-var ObjectCollection&\Traversable<ChildBudgetExp>
     */
    protected $budgetExpsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildBudgetGrades[]
     * @phpstan-var ObjectCollection&\Traversable<ChildBudgetGrades>
     */
    protected $budgetGradessScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildExpenses[]
     * @phpstan-var ObjectCollection&\Traversable<ChildExpenses>
     */
    protected $expensessScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues(): void
    {
        $this->company_id = 0;
        $this->status = 1;
        $this->is_default = false;
    }

    /**
     * Initializes internal state of entities\Base\BudgetGroup object.
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
     * Compares this with another <code>BudgetGroup</code> instance.  If
     * <code>obj</code> is an instance of <code>BudgetGroup</code>, delegates to
     * <code>equals(BudgetGroup)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [bgid] column value.
     *
     * @return int
     */
    public function getBgid()
    {
        return $this->bgid;
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
     * Get the [group_name] column value.
     *
     * @return string
     */
    public function getGroupName()
    {
        return $this->group_name;
    }

    /**
     * Get the [groupcode] column value.
     *
     * @return string|null
     */
    public function getGroupcode()
    {
        return $this->groupcode;
    }

    /**
     * Get the [maxlimit] column value.
     *
     * @return string
     */
    public function getMaxlimit()
    {
        return $this->maxlimit;
    }

    /**
     * Get the [notes] column value.
     *
     * @return string|null
     */
    public function getNotes()
    {
        return $this->notes;
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
     * Get the [is_default] column value.
     *
     * @return boolean
     */
    public function getIsDefault()
    {
        return $this->is_default;
    }

    /**
     * Get the [is_default] column value.
     *
     * @return boolean
     */
    public function isDefault()
    {
        return $this->getIsDefault();
    }

    /**
     * Set the value of [bgid] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setBgid($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->bgid !== $v) {
            $this->bgid = $v;
            $this->modifiedColumns[BudgetGroupTableMap::COL_BGID] = true;
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
            $this->modifiedColumns[BudgetGroupTableMap::COL_COMPANY_ID] = true;
        }

        if ($this->aCompany !== null && $this->aCompany->getCompanyId() !== $v) {
            $this->aCompany = null;
        }

        return $this;
    }

    /**
     * Set the value of [group_name] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setGroupName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->group_name !== $v) {
            $this->group_name = $v;
            $this->modifiedColumns[BudgetGroupTableMap::COL_GROUP_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [groupcode] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setGroupcode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->groupcode !== $v) {
            $this->groupcode = $v;
            $this->modifiedColumns[BudgetGroupTableMap::COL_GROUPCODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [maxlimit] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setMaxlimit($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->maxlimit !== $v) {
            $this->maxlimit = $v;
            $this->modifiedColumns[BudgetGroupTableMap::COL_MAXLIMIT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [notes] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setNotes($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->notes !== $v) {
            $this->notes = $v;
            $this->modifiedColumns[BudgetGroupTableMap::COL_NOTES] = true;
        }

        return $this;
    }

    /**
     * Set the value of [status] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setStatus($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->status !== $v) {
            $this->status = $v;
            $this->modifiedColumns[BudgetGroupTableMap::COL_STATUS] = true;
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
                $this->modifiedColumns[BudgetGroupTableMap::COL_CREATED_AT] = true;
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
                $this->modifiedColumns[BudgetGroupTableMap::COL_UPDATED_AT] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Sets the value of the [is_default] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param bool|integer|string $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setIsDefault($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->is_default !== $v) {
            $this->is_default = $v;
            $this->modifiedColumns[BudgetGroupTableMap::COL_IS_DEFAULT] = true;
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
            if ($this->company_id !== 0) {
                return false;
            }

            if ($this->status !== 1) {
                return false;
            }

            if ($this->is_default !== false) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : BudgetGroupTableMap::translateFieldName('Bgid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->bgid = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : BudgetGroupTableMap::translateFieldName('CompanyId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->company_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : BudgetGroupTableMap::translateFieldName('GroupName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->group_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : BudgetGroupTableMap::translateFieldName('Groupcode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->groupcode = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : BudgetGroupTableMap::translateFieldName('Maxlimit', TableMap::TYPE_PHPNAME, $indexType)];
            $this->maxlimit = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : BudgetGroupTableMap::translateFieldName('Notes', TableMap::TYPE_PHPNAME, $indexType)];
            $this->notes = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : BudgetGroupTableMap::translateFieldName('Status', TableMap::TYPE_PHPNAME, $indexType)];
            $this->status = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : BudgetGroupTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : BudgetGroupTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : BudgetGroupTableMap::translateFieldName('IsDefault', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_default = (null !== $col) ? (boolean) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 10; // 10 = BudgetGroupTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\entities\\BudgetGroup'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(BudgetGroupTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildBudgetGroupQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aCompany = null;
            $this->collBudgetExps = null;

            $this->collBudgetGradess = null;

            $this->collExpensess = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see BudgetGroup::setDeleted()
     * @see BudgetGroup::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(BudgetGroupTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildBudgetGroupQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(BudgetGroupTableMap::DATABASE_NAME);
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
                BudgetGroupTableMap::addInstanceToPool($this);
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

            if ($this->budgetExpsScheduledForDeletion !== null) {
                if (!$this->budgetExpsScheduledForDeletion->isEmpty()) {
                    \entities\BudgetExpQuery::create()
                        ->filterByPrimaryKeys($this->budgetExpsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->budgetExpsScheduledForDeletion = null;
                }
            }

            if ($this->collBudgetExps !== null) {
                foreach ($this->collBudgetExps as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->budgetGradessScheduledForDeletion !== null) {
                if (!$this->budgetGradessScheduledForDeletion->isEmpty()) {
                    foreach ($this->budgetGradessScheduledForDeletion as $budgetGrades) {
                        // need to save related object because we set the relation to null
                        $budgetGrades->save($con);
                    }
                    $this->budgetGradessScheduledForDeletion = null;
                }
            }

            if ($this->collBudgetGradess !== null) {
                foreach ($this->collBudgetGradess as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->expensessScheduledForDeletion !== null) {
                if (!$this->expensessScheduledForDeletion->isEmpty()) {
                    \entities\ExpensesQuery::create()
                        ->filterByPrimaryKeys($this->expensessScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->expensessScheduledForDeletion = null;
                }
            }

            if ($this->collExpensess !== null) {
                foreach ($this->collExpensess as $referrerFK) {
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

        $this->modifiedColumns[BudgetGroupTableMap::COL_BGID] = true;
        if (null !== $this->bgid) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . BudgetGroupTableMap::COL_BGID . ')');
        }
        if (null === $this->bgid) {
            try {
                $dataFetcher = $con->query("SELECT nextval('budget_group_bgid_seq')");
                $this->bgid = (int) $dataFetcher->fetchColumn();
            } catch (Exception $e) {
                throw new PropelException('Unable to get sequence id.', 0, $e);
            }
        }


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(BudgetGroupTableMap::COL_BGID)) {
            $modifiedColumns[':p' . $index++]  = 'bgid';
        }
        if ($this->isColumnModified(BudgetGroupTableMap::COL_COMPANY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'company_id';
        }
        if ($this->isColumnModified(BudgetGroupTableMap::COL_GROUP_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'group_name';
        }
        if ($this->isColumnModified(BudgetGroupTableMap::COL_GROUPCODE)) {
            $modifiedColumns[':p' . $index++]  = 'groupcode';
        }
        if ($this->isColumnModified(BudgetGroupTableMap::COL_MAXLIMIT)) {
            $modifiedColumns[':p' . $index++]  = 'maxlimit';
        }
        if ($this->isColumnModified(BudgetGroupTableMap::COL_NOTES)) {
            $modifiedColumns[':p' . $index++]  = 'notes';
        }
        if ($this->isColumnModified(BudgetGroupTableMap::COL_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'status';
        }
        if ($this->isColumnModified(BudgetGroupTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(BudgetGroupTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }
        if ($this->isColumnModified(BudgetGroupTableMap::COL_IS_DEFAULT)) {
            $modifiedColumns[':p' . $index++]  = 'is_default';
        }

        $sql = sprintf(
            'INSERT INTO budget_group (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'bgid':
                        $stmt->bindValue($identifier, $this->bgid, PDO::PARAM_INT);

                        break;
                    case 'company_id':
                        $stmt->bindValue($identifier, $this->company_id, PDO::PARAM_INT);

                        break;
                    case 'group_name':
                        $stmt->bindValue($identifier, $this->group_name, PDO::PARAM_STR);

                        break;
                    case 'groupcode':
                        $stmt->bindValue($identifier, $this->groupcode, PDO::PARAM_STR);

                        break;
                    case 'maxlimit':
                        $stmt->bindValue($identifier, $this->maxlimit, PDO::PARAM_STR);

                        break;
                    case 'notes':
                        $stmt->bindValue($identifier, $this->notes, PDO::PARAM_STR);

                        break;
                    case 'status':
                        $stmt->bindValue($identifier, $this->status, PDO::PARAM_INT);

                        break;
                    case 'created_at':
                        $stmt->bindValue($identifier, $this->created_at ? $this->created_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'updated_at':
                        $stmt->bindValue($identifier, $this->updated_at ? $this->updated_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'is_default':
                        $stmt->bindValue($identifier, $this->is_default, PDO::PARAM_BOOL);

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
        $pos = BudgetGroupTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getBgid();

            case 1:
                return $this->getCompanyId();

            case 2:
                return $this->getGroupName();

            case 3:
                return $this->getGroupcode();

            case 4:
                return $this->getMaxlimit();

            case 5:
                return $this->getNotes();

            case 6:
                return $this->getStatus();

            case 7:
                return $this->getCreatedAt();

            case 8:
                return $this->getUpdatedAt();

            case 9:
                return $this->getIsDefault();

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
        if (isset($alreadyDumpedObjects['BudgetGroup'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['BudgetGroup'][$this->hashCode()] = true;
        $keys = BudgetGroupTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getBgid(),
            $keys[1] => $this->getCompanyId(),
            $keys[2] => $this->getGroupName(),
            $keys[3] => $this->getGroupcode(),
            $keys[4] => $this->getMaxlimit(),
            $keys[5] => $this->getNotes(),
            $keys[6] => $this->getStatus(),
            $keys[7] => $this->getCreatedAt(),
            $keys[8] => $this->getUpdatedAt(),
            $keys[9] => $this->getIsDefault(),
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
            if (null !== $this->collBudgetExps) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'budgetExps';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'budget_exps';
                        break;
                    default:
                        $key = 'BudgetExps';
                }

                $result[$key] = $this->collBudgetExps->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collBudgetGradess) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'budgetGradess';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'budget_gradess';
                        break;
                    default:
                        $key = 'BudgetGradess';
                }

                $result[$key] = $this->collBudgetGradess->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collExpensess) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'expensess';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'expensess';
                        break;
                    default:
                        $key = 'Expensess';
                }

                $result[$key] = $this->collExpensess->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = BudgetGroupTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setBgid($value);
                break;
            case 1:
                $this->setCompanyId($value);
                break;
            case 2:
                $this->setGroupName($value);
                break;
            case 3:
                $this->setGroupcode($value);
                break;
            case 4:
                $this->setMaxlimit($value);
                break;
            case 5:
                $this->setNotes($value);
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
                $this->setIsDefault($value);
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
        $keys = BudgetGroupTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setBgid($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setCompanyId($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setGroupName($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setGroupcode($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setMaxlimit($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setNotes($arr[$keys[5]]);
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
            $this->setIsDefault($arr[$keys[9]]);
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
        $criteria = new Criteria(BudgetGroupTableMap::DATABASE_NAME);

        if ($this->isColumnModified(BudgetGroupTableMap::COL_BGID)) {
            $criteria->add(BudgetGroupTableMap::COL_BGID, $this->bgid);
        }
        if ($this->isColumnModified(BudgetGroupTableMap::COL_COMPANY_ID)) {
            $criteria->add(BudgetGroupTableMap::COL_COMPANY_ID, $this->company_id);
        }
        if ($this->isColumnModified(BudgetGroupTableMap::COL_GROUP_NAME)) {
            $criteria->add(BudgetGroupTableMap::COL_GROUP_NAME, $this->group_name);
        }
        if ($this->isColumnModified(BudgetGroupTableMap::COL_GROUPCODE)) {
            $criteria->add(BudgetGroupTableMap::COL_GROUPCODE, $this->groupcode);
        }
        if ($this->isColumnModified(BudgetGroupTableMap::COL_MAXLIMIT)) {
            $criteria->add(BudgetGroupTableMap::COL_MAXLIMIT, $this->maxlimit);
        }
        if ($this->isColumnModified(BudgetGroupTableMap::COL_NOTES)) {
            $criteria->add(BudgetGroupTableMap::COL_NOTES, $this->notes);
        }
        if ($this->isColumnModified(BudgetGroupTableMap::COL_STATUS)) {
            $criteria->add(BudgetGroupTableMap::COL_STATUS, $this->status);
        }
        if ($this->isColumnModified(BudgetGroupTableMap::COL_CREATED_AT)) {
            $criteria->add(BudgetGroupTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(BudgetGroupTableMap::COL_UPDATED_AT)) {
            $criteria->add(BudgetGroupTableMap::COL_UPDATED_AT, $this->updated_at);
        }
        if ($this->isColumnModified(BudgetGroupTableMap::COL_IS_DEFAULT)) {
            $criteria->add(BudgetGroupTableMap::COL_IS_DEFAULT, $this->is_default);
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
        $criteria = ChildBudgetGroupQuery::create();
        $criteria->add(BudgetGroupTableMap::COL_BGID, $this->bgid);

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
        $validPk = null !== $this->getBgid();

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
        return $this->getBgid();
    }

    /**
     * Generic method to set the primary key (bgid column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setBgid($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getBgid();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \entities\BudgetGroup (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setCompanyId($this->getCompanyId());
        $copyObj->setGroupName($this->getGroupName());
        $copyObj->setGroupcode($this->getGroupcode());
        $copyObj->setMaxlimit($this->getMaxlimit());
        $copyObj->setNotes($this->getNotes());
        $copyObj->setStatus($this->getStatus());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        $copyObj->setIsDefault($this->getIsDefault());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getBudgetExps() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBudgetExp($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getBudgetGradess() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBudgetGrades($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getExpensess() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addExpenses($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setBgid(NULL); // this is a auto-increment column, so set to default value
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
     * @return \entities\BudgetGroup Clone of current object.
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
            $this->setCompanyId(0);
        } else {
            $this->setCompanyId($v->getCompanyId());
        }

        $this->aCompany = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildCompany object, it will not be re-added.
        if ($v !== null) {
            $v->addBudgetGroup($this);
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
                $this->aCompany->addBudgetGroups($this);
             */
        }

        return $this->aCompany;
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
        if ('BudgetExp' === $relationName) {
            $this->initBudgetExps();
            return;
        }
        if ('BudgetGrades' === $relationName) {
            $this->initBudgetGradess();
            return;
        }
        if ('Expenses' === $relationName) {
            $this->initExpensess();
            return;
        }
    }

    /**
     * Clears out the collBudgetExps collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addBudgetExps()
     */
    public function clearBudgetExps()
    {
        $this->collBudgetExps = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collBudgetExps collection loaded partially.
     *
     * @return void
     */
    public function resetPartialBudgetExps($v = true): void
    {
        $this->collBudgetExpsPartial = $v;
    }

    /**
     * Initializes the collBudgetExps collection.
     *
     * By default this just sets the collBudgetExps collection to an empty array (like clearcollBudgetExps());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBudgetExps(bool $overrideExisting = true): void
    {
        if (null !== $this->collBudgetExps && !$overrideExisting) {
            return;
        }

        $collectionClassName = BudgetExpTableMap::getTableMap()->getCollectionClassName();

        $this->collBudgetExps = new $collectionClassName;
        $this->collBudgetExps->setModel('\entities\BudgetExp');
    }

    /**
     * Gets an array of ChildBudgetExp objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildBudgetGroup is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildBudgetExp[] List of ChildBudgetExp objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBudgetExp> List of ChildBudgetExp objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getBudgetExps(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collBudgetExpsPartial && !$this->isNew();
        if (null === $this->collBudgetExps || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collBudgetExps) {
                    $this->initBudgetExps();
                } else {
                    $collectionClassName = BudgetExpTableMap::getTableMap()->getCollectionClassName();

                    $collBudgetExps = new $collectionClassName;
                    $collBudgetExps->setModel('\entities\BudgetExp');

                    return $collBudgetExps;
                }
            } else {
                $collBudgetExps = ChildBudgetExpQuery::create(null, $criteria)
                    ->filterByBudgetGroup($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collBudgetExpsPartial && count($collBudgetExps)) {
                        $this->initBudgetExps(false);

                        foreach ($collBudgetExps as $obj) {
                            if (false == $this->collBudgetExps->contains($obj)) {
                                $this->collBudgetExps->append($obj);
                            }
                        }

                        $this->collBudgetExpsPartial = true;
                    }

                    return $collBudgetExps;
                }

                if ($partial && $this->collBudgetExps) {
                    foreach ($this->collBudgetExps as $obj) {
                        if ($obj->isNew()) {
                            $collBudgetExps[] = $obj;
                        }
                    }
                }

                $this->collBudgetExps = $collBudgetExps;
                $this->collBudgetExpsPartial = false;
            }
        }

        return $this->collBudgetExps;
    }

    /**
     * Sets a collection of ChildBudgetExp objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $budgetExps A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setBudgetExps(Collection $budgetExps, ?ConnectionInterface $con = null)
    {
        /** @var ChildBudgetExp[] $budgetExpsToDelete */
        $budgetExpsToDelete = $this->getBudgetExps(new Criteria(), $con)->diff($budgetExps);


        $this->budgetExpsScheduledForDeletion = $budgetExpsToDelete;

        foreach ($budgetExpsToDelete as $budgetExpRemoved) {
            $budgetExpRemoved->setBudgetGroup(null);
        }

        $this->collBudgetExps = null;
        foreach ($budgetExps as $budgetExp) {
            $this->addBudgetExp($budgetExp);
        }

        $this->collBudgetExps = $budgetExps;
        $this->collBudgetExpsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BudgetExp objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BudgetExp objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countBudgetExps(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collBudgetExpsPartial && !$this->isNew();
        if (null === $this->collBudgetExps || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBudgetExps) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getBudgetExps());
            }

            $query = ChildBudgetExpQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByBudgetGroup($this)
                ->count($con);
        }

        return count($this->collBudgetExps);
    }

    /**
     * Method called to associate a ChildBudgetExp object to this object
     * through the ChildBudgetExp foreign key attribute.
     *
     * @param ChildBudgetExp $l ChildBudgetExp
     * @return $this The current object (for fluent API support)
     */
    public function addBudgetExp(ChildBudgetExp $l)
    {
        if ($this->collBudgetExps === null) {
            $this->initBudgetExps();
            $this->collBudgetExpsPartial = true;
        }

        if (!$this->collBudgetExps->contains($l)) {
            $this->doAddBudgetExp($l);

            if ($this->budgetExpsScheduledForDeletion and $this->budgetExpsScheduledForDeletion->contains($l)) {
                $this->budgetExpsScheduledForDeletion->remove($this->budgetExpsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildBudgetExp $budgetExp The ChildBudgetExp object to add.
     */
    protected function doAddBudgetExp(ChildBudgetExp $budgetExp): void
    {
        $this->collBudgetExps[]= $budgetExp;
        $budgetExp->setBudgetGroup($this);
    }

    /**
     * @param ChildBudgetExp $budgetExp The ChildBudgetExp object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeBudgetExp(ChildBudgetExp $budgetExp)
    {
        if ($this->getBudgetExps()->contains($budgetExp)) {
            $pos = $this->collBudgetExps->search($budgetExp);
            $this->collBudgetExps->remove($pos);
            if (null === $this->budgetExpsScheduledForDeletion) {
                $this->budgetExpsScheduledForDeletion = clone $this->collBudgetExps;
                $this->budgetExpsScheduledForDeletion->clear();
            }
            $this->budgetExpsScheduledForDeletion[]= clone $budgetExp;
            $budgetExp->setBudgetGroup(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this BudgetGroup is new, it will return
     * an empty collection; or if this BudgetGroup has previously
     * been saved, it will retrieve related BudgetExps from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in BudgetGroup.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBudgetExp[] List of ChildBudgetExp objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBudgetExp}> List of ChildBudgetExp objects
     */
    public function getBudgetExpsJoinExpenseMaster(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBudgetExpQuery::create(null, $criteria);
        $query->joinWith('ExpenseMaster', $joinBehavior);

        return $this->getBudgetExps($query, $con);
    }

    /**
     * Clears out the collBudgetGradess collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addBudgetGradess()
     */
    public function clearBudgetGradess()
    {
        $this->collBudgetGradess = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collBudgetGradess collection loaded partially.
     *
     * @return void
     */
    public function resetPartialBudgetGradess($v = true): void
    {
        $this->collBudgetGradessPartial = $v;
    }

    /**
     * Initializes the collBudgetGradess collection.
     *
     * By default this just sets the collBudgetGradess collection to an empty array (like clearcollBudgetGradess());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBudgetGradess(bool $overrideExisting = true): void
    {
        if (null !== $this->collBudgetGradess && !$overrideExisting) {
            return;
        }

        $collectionClassName = BudgetGradesTableMap::getTableMap()->getCollectionClassName();

        $this->collBudgetGradess = new $collectionClassName;
        $this->collBudgetGradess->setModel('\entities\BudgetGrades');
    }

    /**
     * Gets an array of ChildBudgetGrades objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildBudgetGroup is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildBudgetGrades[] List of ChildBudgetGrades objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBudgetGrades> List of ChildBudgetGrades objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getBudgetGradess(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collBudgetGradessPartial && !$this->isNew();
        if (null === $this->collBudgetGradess || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collBudgetGradess) {
                    $this->initBudgetGradess();
                } else {
                    $collectionClassName = BudgetGradesTableMap::getTableMap()->getCollectionClassName();

                    $collBudgetGradess = new $collectionClassName;
                    $collBudgetGradess->setModel('\entities\BudgetGrades');

                    return $collBudgetGradess;
                }
            } else {
                $collBudgetGradess = ChildBudgetGradesQuery::create(null, $criteria)
                    ->filterByBudgetGroup($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collBudgetGradessPartial && count($collBudgetGradess)) {
                        $this->initBudgetGradess(false);

                        foreach ($collBudgetGradess as $obj) {
                            if (false == $this->collBudgetGradess->contains($obj)) {
                                $this->collBudgetGradess->append($obj);
                            }
                        }

                        $this->collBudgetGradessPartial = true;
                    }

                    return $collBudgetGradess;
                }

                if ($partial && $this->collBudgetGradess) {
                    foreach ($this->collBudgetGradess as $obj) {
                        if ($obj->isNew()) {
                            $collBudgetGradess[] = $obj;
                        }
                    }
                }

                $this->collBudgetGradess = $collBudgetGradess;
                $this->collBudgetGradessPartial = false;
            }
        }

        return $this->collBudgetGradess;
    }

    /**
     * Sets a collection of ChildBudgetGrades objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $budgetGradess A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setBudgetGradess(Collection $budgetGradess, ?ConnectionInterface $con = null)
    {
        /** @var ChildBudgetGrades[] $budgetGradessToDelete */
        $budgetGradessToDelete = $this->getBudgetGradess(new Criteria(), $con)->diff($budgetGradess);


        $this->budgetGradessScheduledForDeletion = $budgetGradessToDelete;

        foreach ($budgetGradessToDelete as $budgetGradesRemoved) {
            $budgetGradesRemoved->setBudgetGroup(null);
        }

        $this->collBudgetGradess = null;
        foreach ($budgetGradess as $budgetGrades) {
            $this->addBudgetGrades($budgetGrades);
        }

        $this->collBudgetGradess = $budgetGradess;
        $this->collBudgetGradessPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BudgetGrades objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BudgetGrades objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countBudgetGradess(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collBudgetGradessPartial && !$this->isNew();
        if (null === $this->collBudgetGradess || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBudgetGradess) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getBudgetGradess());
            }

            $query = ChildBudgetGradesQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByBudgetGroup($this)
                ->count($con);
        }

        return count($this->collBudgetGradess);
    }

    /**
     * Method called to associate a ChildBudgetGrades object to this object
     * through the ChildBudgetGrades foreign key attribute.
     *
     * @param ChildBudgetGrades $l ChildBudgetGrades
     * @return $this The current object (for fluent API support)
     */
    public function addBudgetGrades(ChildBudgetGrades $l)
    {
        if ($this->collBudgetGradess === null) {
            $this->initBudgetGradess();
            $this->collBudgetGradessPartial = true;
        }

        if (!$this->collBudgetGradess->contains($l)) {
            $this->doAddBudgetGrades($l);

            if ($this->budgetGradessScheduledForDeletion and $this->budgetGradessScheduledForDeletion->contains($l)) {
                $this->budgetGradessScheduledForDeletion->remove($this->budgetGradessScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildBudgetGrades $budgetGrades The ChildBudgetGrades object to add.
     */
    protected function doAddBudgetGrades(ChildBudgetGrades $budgetGrades): void
    {
        $this->collBudgetGradess[]= $budgetGrades;
        $budgetGrades->setBudgetGroup($this);
    }

    /**
     * @param ChildBudgetGrades $budgetGrades The ChildBudgetGrades object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeBudgetGrades(ChildBudgetGrades $budgetGrades)
    {
        if ($this->getBudgetGradess()->contains($budgetGrades)) {
            $pos = $this->collBudgetGradess->search($budgetGrades);
            $this->collBudgetGradess->remove($pos);
            if (null === $this->budgetGradessScheduledForDeletion) {
                $this->budgetGradessScheduledForDeletion = clone $this->collBudgetGradess;
                $this->budgetGradessScheduledForDeletion->clear();
            }
            $this->budgetGradessScheduledForDeletion[]= $budgetGrades;
            $budgetGrades->setBudgetGroup(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this BudgetGroup is new, it will return
     * an empty collection; or if this BudgetGroup has previously
     * been saved, it will retrieve related BudgetGradess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in BudgetGroup.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBudgetGrades[] List of ChildBudgetGrades objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBudgetGrades}> List of ChildBudgetGrades objects
     */
    public function getBudgetGradessJoinGradeMaster(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBudgetGradesQuery::create(null, $criteria);
        $query->joinWith('GradeMaster', $joinBehavior);

        return $this->getBudgetGradess($query, $con);
    }

    /**
     * Clears out the collExpensess collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addExpensess()
     */
    public function clearExpensess()
    {
        $this->collExpensess = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collExpensess collection loaded partially.
     *
     * @return void
     */
    public function resetPartialExpensess($v = true): void
    {
        $this->collExpensessPartial = $v;
    }

    /**
     * Initializes the collExpensess collection.
     *
     * By default this just sets the collExpensess collection to an empty array (like clearcollExpensess());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initExpensess(bool $overrideExisting = true): void
    {
        if (null !== $this->collExpensess && !$overrideExisting) {
            return;
        }

        $collectionClassName = ExpensesTableMap::getTableMap()->getCollectionClassName();

        $this->collExpensess = new $collectionClassName;
        $this->collExpensess->setModel('\entities\Expenses');
    }

    /**
     * Gets an array of ChildExpenses objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildBudgetGroup is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildExpenses[] List of ChildExpenses objects
     * @phpstan-return ObjectCollection&\Traversable<ChildExpenses> List of ChildExpenses objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getExpensess(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collExpensessPartial && !$this->isNew();
        if (null === $this->collExpensess || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collExpensess) {
                    $this->initExpensess();
                } else {
                    $collectionClassName = ExpensesTableMap::getTableMap()->getCollectionClassName();

                    $collExpensess = new $collectionClassName;
                    $collExpensess->setModel('\entities\Expenses');

                    return $collExpensess;
                }
            } else {
                $collExpensess = ChildExpensesQuery::create(null, $criteria)
                    ->filterByBudgetGroup($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collExpensessPartial && count($collExpensess)) {
                        $this->initExpensess(false);

                        foreach ($collExpensess as $obj) {
                            if (false == $this->collExpensess->contains($obj)) {
                                $this->collExpensess->append($obj);
                            }
                        }

                        $this->collExpensessPartial = true;
                    }

                    return $collExpensess;
                }

                if ($partial && $this->collExpensess) {
                    foreach ($this->collExpensess as $obj) {
                        if ($obj->isNew()) {
                            $collExpensess[] = $obj;
                        }
                    }
                }

                $this->collExpensess = $collExpensess;
                $this->collExpensessPartial = false;
            }
        }

        return $this->collExpensess;
    }

    /**
     * Sets a collection of ChildExpenses objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $expensess A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setExpensess(Collection $expensess, ?ConnectionInterface $con = null)
    {
        /** @var ChildExpenses[] $expensessToDelete */
        $expensessToDelete = $this->getExpensess(new Criteria(), $con)->diff($expensess);


        $this->expensessScheduledForDeletion = $expensessToDelete;

        foreach ($expensessToDelete as $expensesRemoved) {
            $expensesRemoved->setBudgetGroup(null);
        }

        $this->collExpensess = null;
        foreach ($expensess as $expenses) {
            $this->addExpenses($expenses);
        }

        $this->collExpensess = $expensess;
        $this->collExpensessPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Expenses objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related Expenses objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countExpensess(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collExpensessPartial && !$this->isNew();
        if (null === $this->collExpensess || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collExpensess) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getExpensess());
            }

            $query = ChildExpensesQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByBudgetGroup($this)
                ->count($con);
        }

        return count($this->collExpensess);
    }

    /**
     * Method called to associate a ChildExpenses object to this object
     * through the ChildExpenses foreign key attribute.
     *
     * @param ChildExpenses $l ChildExpenses
     * @return $this The current object (for fluent API support)
     */
    public function addExpenses(ChildExpenses $l)
    {
        if ($this->collExpensess === null) {
            $this->initExpensess();
            $this->collExpensessPartial = true;
        }

        if (!$this->collExpensess->contains($l)) {
            $this->doAddExpenses($l);

            if ($this->expensessScheduledForDeletion and $this->expensessScheduledForDeletion->contains($l)) {
                $this->expensessScheduledForDeletion->remove($this->expensessScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildExpenses $expenses The ChildExpenses object to add.
     */
    protected function doAddExpenses(ChildExpenses $expenses): void
    {
        $this->collExpensess[]= $expenses;
        $expenses->setBudgetGroup($this);
    }

    /**
     * @param ChildExpenses $expenses The ChildExpenses object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeExpenses(ChildExpenses $expenses)
    {
        if ($this->getExpensess()->contains($expenses)) {
            $pos = $this->collExpensess->search($expenses);
            $this->collExpensess->remove($pos);
            if (null === $this->expensessScheduledForDeletion) {
                $this->expensessScheduledForDeletion = clone $this->collExpensess;
                $this->expensessScheduledForDeletion->clear();
            }
            $this->expensessScheduledForDeletion[]= clone $expenses;
            $expenses->setBudgetGroup(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this BudgetGroup is new, it will return
     * an empty collection; or if this BudgetGroup has previously
     * been saved, it will retrieve related Expensess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in BudgetGroup.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildExpenses[] List of ChildExpenses objects
     * @phpstan-return ObjectCollection&\Traversable<ChildExpenses}> List of ChildExpenses objects
     */
    public function getExpensessJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildExpensesQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getExpensess($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this BudgetGroup is new, it will return
     * an empty collection; or if this BudgetGroup has previously
     * been saved, it will retrieve related Expensess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in BudgetGroup.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildExpenses[] List of ChildExpenses objects
     * @phpstan-return ObjectCollection&\Traversable<ChildExpenses}> List of ChildExpenses objects
     */
    public function getExpensessJoinCurrencies(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildExpensesQuery::create(null, $criteria);
        $query->joinWith('Currencies', $joinBehavior);

        return $this->getExpensess($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this BudgetGroup is new, it will return
     * an empty collection; or if this BudgetGroup has previously
     * been saved, it will retrieve related Expensess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in BudgetGroup.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildExpenses[] List of ChildExpenses objects
     * @phpstan-return ObjectCollection&\Traversable<ChildExpenses}> List of ChildExpenses objects
     */
    public function getExpensessJoinEmployee(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildExpensesQuery::create(null, $criteria);
        $query->joinWith('Employee', $joinBehavior);

        return $this->getExpensess($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this BudgetGroup is new, it will return
     * an empty collection; or if this BudgetGroup has previously
     * been saved, it will retrieve related Expensess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in BudgetGroup.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildExpenses[] List of ChildExpenses objects
     * @phpstan-return ObjectCollection&\Traversable<ChildExpenses}> List of ChildExpenses objects
     */
    public function getExpensessJoinOrgUnit(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildExpensesQuery::create(null, $criteria);
        $query->joinWith('OrgUnit', $joinBehavior);

        return $this->getExpensess($query, $con);
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
            $this->aCompany->removeBudgetGroup($this);
        }
        $this->bgid = null;
        $this->company_id = null;
        $this->group_name = null;
        $this->groupcode = null;
        $this->maxlimit = null;
        $this->notes = null;
        $this->status = null;
        $this->created_at = null;
        $this->updated_at = null;
        $this->is_default = null;
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
            if ($this->collBudgetExps) {
                foreach ($this->collBudgetExps as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collBudgetGradess) {
                foreach ($this->collBudgetGradess as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collExpensess) {
                foreach ($this->collExpensess as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collBudgetExps = null;
        $this->collBudgetGradess = null;
        $this->collExpensess = null;
        $this->aCompany = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(BudgetGroupTableMap::DEFAULT_STRING_FORMAT);
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
