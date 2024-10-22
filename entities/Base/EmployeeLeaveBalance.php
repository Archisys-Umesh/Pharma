<?php

namespace entities\Base;

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
use entities\EmployeeLeaveBalanceQuery as ChildEmployeeLeaveBalanceQuery;
use entities\Map\EmployeeLeaveBalanceTableMap;

/**
 * Base class that represents a row from the 'employee_leave_balance' table.
 *
 *
 *
 * @package    propel.generator.entities.Base
 */
abstract class EmployeeLeaveBalance implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\entities\\Map\\EmployeeLeaveBalanceTableMap';


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
     * The value for the uniquecode field.
     *
     * @var        string
     */
    protected $uniquecode;

    /**
     * The value for the employee_id field.
     *
     * @var        int|null
     */
    protected $employee_id;

    /**
     * The value for the leave_year field.
     *
     * @var        string|null
     */
    protected $leave_year;

    /**
     * The value for the leave_type field.
     *
     * @var        string|null
     */
    protected $leave_type;

    /**
     * The value for the accuration field.
     *
     * @var        int|null
     */
    protected $accuration;

    /**
     * The value for the opening field.
     *
     * @var        int|null
     */
    protected $opening;

    /**
     * The value for the reward field.
     *
     * @var        int|null
     */
    protected $reward;

    /**
     * The value for the consumed field.
     *
     * @var        int|null
     */
    protected $consumed;

    /**
     * The value for the balance field.
     *
     * @var        int|null
     */
    protected $balance;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * Initializes internal state of entities\Base\EmployeeLeaveBalance object.
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
     * Compares this with another <code>EmployeeLeaveBalance</code> instance.  If
     * <code>obj</code> is an instance of <code>EmployeeLeaveBalance</code>, delegates to
     * <code>equals(EmployeeLeaveBalance)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [uniquecode] column value.
     *
     * @return string
     */
    public function getUniquecode()
    {
        return $this->uniquecode;
    }

    /**
     * Get the [employee_id] column value.
     *
     * @return int|null
     */
    public function getEmployeeId()
    {
        return $this->employee_id;
    }

    /**
     * Get the [leave_year] column value.
     *
     * @return string|null
     */
    public function getLeaveYear()
    {
        return $this->leave_year;
    }

    /**
     * Get the [leave_type] column value.
     *
     * @return string|null
     */
    public function getLeaveType()
    {
        return $this->leave_type;
    }

    /**
     * Get the [accuration] column value.
     *
     * @return int|null
     */
    public function getAccuration()
    {
        return $this->accuration;
    }

    /**
     * Get the [opening] column value.
     *
     * @return int|null
     */
    public function getOpening()
    {
        return $this->opening;
    }

    /**
     * Get the [reward] column value.
     *
     * @return int|null
     */
    public function getReward()
    {
        return $this->reward;
    }

    /**
     * Get the [consumed] column value.
     *
     * @return int|null
     */
    public function getConsumed()
    {
        return $this->consumed;
    }

    /**
     * Get the [balance] column value.
     *
     * @return int|null
     */
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * Set the value of [uniquecode] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setUniquecode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->uniquecode !== $v) {
            $this->uniquecode = $v;
            $this->modifiedColumns[EmployeeLeaveBalanceTableMap::COL_UNIQUECODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [employee_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setEmployeeId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->employee_id !== $v) {
            $this->employee_id = $v;
            $this->modifiedColumns[EmployeeLeaveBalanceTableMap::COL_EMPLOYEE_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [leave_year] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setLeaveYear($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->leave_year !== $v) {
            $this->leave_year = $v;
            $this->modifiedColumns[EmployeeLeaveBalanceTableMap::COL_LEAVE_YEAR] = true;
        }

        return $this;
    }

    /**
     * Set the value of [leave_type] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setLeaveType($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->leave_type !== $v) {
            $this->leave_type = $v;
            $this->modifiedColumns[EmployeeLeaveBalanceTableMap::COL_LEAVE_TYPE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [accuration] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setAccuration($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->accuration !== $v) {
            $this->accuration = $v;
            $this->modifiedColumns[EmployeeLeaveBalanceTableMap::COL_ACCURATION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [opening] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOpening($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->opening !== $v) {
            $this->opening = $v;
            $this->modifiedColumns[EmployeeLeaveBalanceTableMap::COL_OPENING] = true;
        }

        return $this;
    }

    /**
     * Set the value of [reward] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setReward($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->reward !== $v) {
            $this->reward = $v;
            $this->modifiedColumns[EmployeeLeaveBalanceTableMap::COL_REWARD] = true;
        }

        return $this;
    }

    /**
     * Set the value of [consumed] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setConsumed($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->consumed !== $v) {
            $this->consumed = $v;
            $this->modifiedColumns[EmployeeLeaveBalanceTableMap::COL_CONSUMED] = true;
        }

        return $this;
    }

    /**
     * Set the value of [balance] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setBalance($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->balance !== $v) {
            $this->balance = $v;
            $this->modifiedColumns[EmployeeLeaveBalanceTableMap::COL_BALANCE] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : EmployeeLeaveBalanceTableMap::translateFieldName('Uniquecode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->uniquecode = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : EmployeeLeaveBalanceTableMap::translateFieldName('EmployeeId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->employee_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : EmployeeLeaveBalanceTableMap::translateFieldName('LeaveYear', TableMap::TYPE_PHPNAME, $indexType)];
            $this->leave_year = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : EmployeeLeaveBalanceTableMap::translateFieldName('LeaveType', TableMap::TYPE_PHPNAME, $indexType)];
            $this->leave_type = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : EmployeeLeaveBalanceTableMap::translateFieldName('Accuration', TableMap::TYPE_PHPNAME, $indexType)];
            $this->accuration = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : EmployeeLeaveBalanceTableMap::translateFieldName('Opening', TableMap::TYPE_PHPNAME, $indexType)];
            $this->opening = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : EmployeeLeaveBalanceTableMap::translateFieldName('Reward', TableMap::TYPE_PHPNAME, $indexType)];
            $this->reward = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : EmployeeLeaveBalanceTableMap::translateFieldName('Consumed', TableMap::TYPE_PHPNAME, $indexType)];
            $this->consumed = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : EmployeeLeaveBalanceTableMap::translateFieldName('Balance', TableMap::TYPE_PHPNAME, $indexType)];
            $this->balance = (null !== $col) ? (int) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 9; // 9 = EmployeeLeaveBalanceTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\entities\\EmployeeLeaveBalance'), 0, $e);
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
        $pos = EmployeeLeaveBalanceTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getUniquecode();

            case 1:
                return $this->getEmployeeId();

            case 2:
                return $this->getLeaveYear();

            case 3:
                return $this->getLeaveType();

            case 4:
                return $this->getAccuration();

            case 5:
                return $this->getOpening();

            case 6:
                return $this->getReward();

            case 7:
                return $this->getConsumed();

            case 8:
                return $this->getBalance();

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
        if (isset($alreadyDumpedObjects['EmployeeLeaveBalance'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['EmployeeLeaveBalance'][$this->hashCode()] = true;
        $keys = EmployeeLeaveBalanceTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getUniquecode(),
            $keys[1] => $this->getEmployeeId(),
            $keys[2] => $this->getLeaveYear(),
            $keys[3] => $this->getLeaveType(),
            $keys[4] => $this->getAccuration(),
            $keys[5] => $this->getOpening(),
            $keys[6] => $this->getReward(),
            $keys[7] => $this->getConsumed(),
            $keys[8] => $this->getBalance(),
        ];
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
        $criteria = new Criteria(EmployeeLeaveBalanceTableMap::DATABASE_NAME);

        if ($this->isColumnModified(EmployeeLeaveBalanceTableMap::COL_UNIQUECODE)) {
            $criteria->add(EmployeeLeaveBalanceTableMap::COL_UNIQUECODE, $this->uniquecode);
        }
        if ($this->isColumnModified(EmployeeLeaveBalanceTableMap::COL_EMPLOYEE_ID)) {
            $criteria->add(EmployeeLeaveBalanceTableMap::COL_EMPLOYEE_ID, $this->employee_id);
        }
        if ($this->isColumnModified(EmployeeLeaveBalanceTableMap::COL_LEAVE_YEAR)) {
            $criteria->add(EmployeeLeaveBalanceTableMap::COL_LEAVE_YEAR, $this->leave_year);
        }
        if ($this->isColumnModified(EmployeeLeaveBalanceTableMap::COL_LEAVE_TYPE)) {
            $criteria->add(EmployeeLeaveBalanceTableMap::COL_LEAVE_TYPE, $this->leave_type);
        }
        if ($this->isColumnModified(EmployeeLeaveBalanceTableMap::COL_ACCURATION)) {
            $criteria->add(EmployeeLeaveBalanceTableMap::COL_ACCURATION, $this->accuration);
        }
        if ($this->isColumnModified(EmployeeLeaveBalanceTableMap::COL_OPENING)) {
            $criteria->add(EmployeeLeaveBalanceTableMap::COL_OPENING, $this->opening);
        }
        if ($this->isColumnModified(EmployeeLeaveBalanceTableMap::COL_REWARD)) {
            $criteria->add(EmployeeLeaveBalanceTableMap::COL_REWARD, $this->reward);
        }
        if ($this->isColumnModified(EmployeeLeaveBalanceTableMap::COL_CONSUMED)) {
            $criteria->add(EmployeeLeaveBalanceTableMap::COL_CONSUMED, $this->consumed);
        }
        if ($this->isColumnModified(EmployeeLeaveBalanceTableMap::COL_BALANCE)) {
            $criteria->add(EmployeeLeaveBalanceTableMap::COL_BALANCE, $this->balance);
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
        $criteria = ChildEmployeeLeaveBalanceQuery::create();
        $criteria->add(EmployeeLeaveBalanceTableMap::COL_UNIQUECODE, $this->uniquecode);

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
        $validPk = null !== $this->getUniquecode();

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
     * @return string
     */
    public function getPrimaryKey()
    {
        return $this->getUniquecode();
    }

    /**
     * Generic method to set the primary key (uniquecode column).
     *
     * @param string|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?string $key = null): void
    {
        $this->setUniquecode($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getUniquecode();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \entities\EmployeeLeaveBalance (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setUniquecode($this->getUniquecode());
        $copyObj->setEmployeeId($this->getEmployeeId());
        $copyObj->setLeaveYear($this->getLeaveYear());
        $copyObj->setLeaveType($this->getLeaveType());
        $copyObj->setAccuration($this->getAccuration());
        $copyObj->setOpening($this->getOpening());
        $copyObj->setReward($this->getReward());
        $copyObj->setConsumed($this->getConsumed());
        $copyObj->setBalance($this->getBalance());
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
     * @return \entities\EmployeeLeaveBalance Clone of current object.
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
        $this->uniquecode = null;
        $this->employee_id = null;
        $this->leave_year = null;
        $this->leave_type = null;
        $this->accuration = null;
        $this->opening = null;
        $this->reward = null;
        $this->consumed = null;
        $this->balance = null;
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
        return (string) $this->exportTo(EmployeeLeaveBalanceTableMap::DEFAULT_STRING_FORMAT);
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
