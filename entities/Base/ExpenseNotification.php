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
use entities\Map\ExpenseNotificationTableMap;

/**
 * Base class that represents a row from the 'expense_notification' table.
 *
 *
 *
 * @package    propel.generator.entities.Base
 */
abstract class ExpenseNotification implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\entities\\Map\\ExpenseNotificationTableMap';


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
     * The value for the moye field.
     *
     * @var        string|null
     */
    protected $moye;

    /**
     * The value for the pending_for_submit field.
     *
     * @var        string|null
     */
    protected $pending_for_submit;

    /**
     * The value for the pending_for_approve field.
     *
     * @var        string|null
     */
    protected $pending_for_approve;

    /**
     * The value for the pending_for_audit field.
     *
     * @var        string|null
     */
    protected $pending_for_audit;

    /**
     * The value for the orgunit_id field.
     *
     * @var        int|null
     */
    protected $orgunit_id;

    /**
     * The value for the unit_name field.
     *
     * @var        string|null
     */
    protected $unit_name;

    /**
     * The value for the pending_punchout field.
     *
     * @var        string|null
     */
    protected $pending_punchout;

    /**
     * The value for the unique_pending_for_submit field.
     *
     * @var        string|null
     */
    protected $unique_pending_for_submit;

    /**
     * The value for the unique_pending_for_approve field.
     *
     * @var        string|null
     */
    protected $unique_pending_for_approve;

    /**
     * The value for the unique_pending_for_submit_ids field.
     *
     * @var        string|null
     */
    protected $unique_pending_for_submit_ids;

    /**
     * The value for the unique_pending_punchout_ids field.
     *
     * @var        string|null
     */
    protected $unique_pending_punchout_ids;

    /**
     * The value for the unique_pending_approval_manager_ids field.
     *
     * @var        string|null
     */
    protected $unique_pending_approval_manager_ids;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * Initializes internal state of entities\Base\ExpenseNotification object.
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
     * Compares this with another <code>ExpenseNotification</code> instance.  If
     * <code>obj</code> is an instance of <code>ExpenseNotification</code>, delegates to
     * <code>equals(ExpenseNotification)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [moye] column value.
     *
     * @return string|null
     */
    public function getMoye()
    {
        return $this->moye;
    }

    /**
     * Get the [pending_for_submit] column value.
     *
     * @return string|null
     */
    public function getPendingForSubmit()
    {
        return $this->pending_for_submit;
    }

    /**
     * Get the [pending_for_approve] column value.
     *
     * @return string|null
     */
    public function getPendingForApprove()
    {
        return $this->pending_for_approve;
    }

    /**
     * Get the [pending_for_audit] column value.
     *
     * @return string|null
     */
    public function getPendingForAudit()
    {
        return $this->pending_for_audit;
    }

    /**
     * Get the [orgunit_id] column value.
     *
     * @return int|null
     */
    public function getOrgunitId()
    {
        return $this->orgunit_id;
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
     * Get the [pending_punchout] column value.
     *
     * @return string|null
     */
    public function getPendingPunchout()
    {
        return $this->pending_punchout;
    }

    /**
     * Get the [unique_pending_for_submit] column value.
     *
     * @return string|null
     */
    public function getUniquePendingForSubmit()
    {
        return $this->unique_pending_for_submit;
    }

    /**
     * Get the [unique_pending_for_approve] column value.
     *
     * @return string|null
     */
    public function getUniquePendingForApprove()
    {
        return $this->unique_pending_for_approve;
    }

    /**
     * Get the [unique_pending_for_submit_ids] column value.
     *
     * @return string|null
     */
    public function getUniquePendingForSubmitIds()
    {
        return $this->unique_pending_for_submit_ids;
    }

    /**
     * Get the [unique_pending_punchout_ids] column value.
     *
     * @return string|null
     */
    public function getUniquePendingPunchout()
    {
        return $this->unique_pending_punchout_ids;
    }

    /**
     * Get the [unique_pending_approval_manager_ids] column value.
     *
     * @return string|null
     */
    public function getUniquePendingApprovalManagerIds()
    {
        return $this->unique_pending_approval_manager_ids;
    }

    /**
     * Set the value of [moye] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setMoye($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->moye !== $v) {
            $this->moye = $v;
            $this->modifiedColumns[ExpenseNotificationTableMap::COL_MOYE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [pending_for_submit] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setPendingForSubmit($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->pending_for_submit !== $v) {
            $this->pending_for_submit = $v;
            $this->modifiedColumns[ExpenseNotificationTableMap::COL_PENDING_FOR_SUBMIT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [pending_for_approve] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setPendingForApprove($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->pending_for_approve !== $v) {
            $this->pending_for_approve = $v;
            $this->modifiedColumns[ExpenseNotificationTableMap::COL_PENDING_FOR_APPROVE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [pending_for_audit] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setPendingForAudit($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->pending_for_audit !== $v) {
            $this->pending_for_audit = $v;
            $this->modifiedColumns[ExpenseNotificationTableMap::COL_PENDING_FOR_AUDIT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [orgunit_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOrgunitId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->orgunit_id !== $v) {
            $this->orgunit_id = $v;
            $this->modifiedColumns[ExpenseNotificationTableMap::COL_ORGUNIT_ID] = true;
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
            $this->modifiedColumns[ExpenseNotificationTableMap::COL_UNIT_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [pending_punchout] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setPendingPunchout($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->pending_punchout !== $v) {
            $this->pending_punchout = $v;
            $this->modifiedColumns[ExpenseNotificationTableMap::COL_PENDING_PUNCHOUT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [unique_pending_for_submit] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setUniquePendingForSubmit($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->unique_pending_for_submit !== $v) {
            $this->unique_pending_for_submit = $v;
            $this->modifiedColumns[ExpenseNotificationTableMap::COL_UNIQUE_PENDING_FOR_SUBMIT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [unique_pending_for_approve] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setUniquePendingForApprove($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->unique_pending_for_approve !== $v) {
            $this->unique_pending_for_approve = $v;
            $this->modifiedColumns[ExpenseNotificationTableMap::COL_UNIQUE_PENDING_FOR_APPROVE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [unique_pending_for_submit_ids] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setUniquePendingForSubmitIds($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->unique_pending_for_submit_ids !== $v) {
            $this->unique_pending_for_submit_ids = $v;
            $this->modifiedColumns[ExpenseNotificationTableMap::COL_UNIQUE_PENDING_FOR_SUBMIT_IDS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [unique_pending_punchout_ids] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setUniquePendingPunchout($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->unique_pending_punchout_ids !== $v) {
            $this->unique_pending_punchout_ids = $v;
            $this->modifiedColumns[ExpenseNotificationTableMap::COL_UNIQUE_PENDING_PUNCHOUT_IDS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [unique_pending_approval_manager_ids] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setUniquePendingApprovalManagerIds($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->unique_pending_approval_manager_ids !== $v) {
            $this->unique_pending_approval_manager_ids = $v;
            $this->modifiedColumns[ExpenseNotificationTableMap::COL_UNIQUE_PENDING_APPROVAL_MANAGER_IDS] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : ExpenseNotificationTableMap::translateFieldName('Moye', TableMap::TYPE_PHPNAME, $indexType)];
            $this->moye = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : ExpenseNotificationTableMap::translateFieldName('PendingForSubmit', TableMap::TYPE_PHPNAME, $indexType)];
            $this->pending_for_submit = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : ExpenseNotificationTableMap::translateFieldName('PendingForApprove', TableMap::TYPE_PHPNAME, $indexType)];
            $this->pending_for_approve = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : ExpenseNotificationTableMap::translateFieldName('PendingForAudit', TableMap::TYPE_PHPNAME, $indexType)];
            $this->pending_for_audit = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : ExpenseNotificationTableMap::translateFieldName('OrgunitId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->orgunit_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : ExpenseNotificationTableMap::translateFieldName('UnitName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->unit_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : ExpenseNotificationTableMap::translateFieldName('PendingPunchout', TableMap::TYPE_PHPNAME, $indexType)];
            $this->pending_punchout = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : ExpenseNotificationTableMap::translateFieldName('UniquePendingForSubmit', TableMap::TYPE_PHPNAME, $indexType)];
            $this->unique_pending_for_submit = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : ExpenseNotificationTableMap::translateFieldName('UniquePendingForApprove', TableMap::TYPE_PHPNAME, $indexType)];
            $this->unique_pending_for_approve = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : ExpenseNotificationTableMap::translateFieldName('UniquePendingForSubmitIds', TableMap::TYPE_PHPNAME, $indexType)];
            $this->unique_pending_for_submit_ids = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : ExpenseNotificationTableMap::translateFieldName('UniquePendingPunchout', TableMap::TYPE_PHPNAME, $indexType)];
            $this->unique_pending_punchout_ids = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : ExpenseNotificationTableMap::translateFieldName('UniquePendingApprovalManagerIds', TableMap::TYPE_PHPNAME, $indexType)];
            $this->unique_pending_approval_manager_ids = (null !== $col) ? (string) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 12; // 12 = ExpenseNotificationTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\entities\\ExpenseNotification'), 0, $e);
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
        $pos = ExpenseNotificationTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getMoye();

            case 1:
                return $this->getPendingForSubmit();

            case 2:
                return $this->getPendingForApprove();

            case 3:
                return $this->getPendingForAudit();

            case 4:
                return $this->getOrgunitId();

            case 5:
                return $this->getUnitName();

            case 6:
                return $this->getPendingPunchout();

            case 7:
                return $this->getUniquePendingForSubmit();

            case 8:
                return $this->getUniquePendingForApprove();

            case 9:
                return $this->getUniquePendingForSubmitIds();

            case 10:
                return $this->getUniquePendingPunchout();

            case 11:
                return $this->getUniquePendingApprovalManagerIds();

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
        if (isset($alreadyDumpedObjects['ExpenseNotification'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['ExpenseNotification'][$this->hashCode()] = true;
        $keys = ExpenseNotificationTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getMoye(),
            $keys[1] => $this->getPendingForSubmit(),
            $keys[2] => $this->getPendingForApprove(),
            $keys[3] => $this->getPendingForAudit(),
            $keys[4] => $this->getOrgunitId(),
            $keys[5] => $this->getUnitName(),
            $keys[6] => $this->getPendingPunchout(),
            $keys[7] => $this->getUniquePendingForSubmit(),
            $keys[8] => $this->getUniquePendingForApprove(),
            $keys[9] => $this->getUniquePendingForSubmitIds(),
            $keys[10] => $this->getUniquePendingPunchout(),
            $keys[11] => $this->getUniquePendingApprovalManagerIds(),
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
        $criteria = new Criteria(ExpenseNotificationTableMap::DATABASE_NAME);

        if ($this->isColumnModified(ExpenseNotificationTableMap::COL_MOYE)) {
            $criteria->add(ExpenseNotificationTableMap::COL_MOYE, $this->moye);
        }
        if ($this->isColumnModified(ExpenseNotificationTableMap::COL_PENDING_FOR_SUBMIT)) {
            $criteria->add(ExpenseNotificationTableMap::COL_PENDING_FOR_SUBMIT, $this->pending_for_submit);
        }
        if ($this->isColumnModified(ExpenseNotificationTableMap::COL_PENDING_FOR_APPROVE)) {
            $criteria->add(ExpenseNotificationTableMap::COL_PENDING_FOR_APPROVE, $this->pending_for_approve);
        }
        if ($this->isColumnModified(ExpenseNotificationTableMap::COL_PENDING_FOR_AUDIT)) {
            $criteria->add(ExpenseNotificationTableMap::COL_PENDING_FOR_AUDIT, $this->pending_for_audit);
        }
        if ($this->isColumnModified(ExpenseNotificationTableMap::COL_ORGUNIT_ID)) {
            $criteria->add(ExpenseNotificationTableMap::COL_ORGUNIT_ID, $this->orgunit_id);
        }
        if ($this->isColumnModified(ExpenseNotificationTableMap::COL_UNIT_NAME)) {
            $criteria->add(ExpenseNotificationTableMap::COL_UNIT_NAME, $this->unit_name);
        }
        if ($this->isColumnModified(ExpenseNotificationTableMap::COL_PENDING_PUNCHOUT)) {
            $criteria->add(ExpenseNotificationTableMap::COL_PENDING_PUNCHOUT, $this->pending_punchout);
        }
        if ($this->isColumnModified(ExpenseNotificationTableMap::COL_UNIQUE_PENDING_FOR_SUBMIT)) {
            $criteria->add(ExpenseNotificationTableMap::COL_UNIQUE_PENDING_FOR_SUBMIT, $this->unique_pending_for_submit);
        }
        if ($this->isColumnModified(ExpenseNotificationTableMap::COL_UNIQUE_PENDING_FOR_APPROVE)) {
            $criteria->add(ExpenseNotificationTableMap::COL_UNIQUE_PENDING_FOR_APPROVE, $this->unique_pending_for_approve);
        }
        if ($this->isColumnModified(ExpenseNotificationTableMap::COL_UNIQUE_PENDING_FOR_SUBMIT_IDS)) {
            $criteria->add(ExpenseNotificationTableMap::COL_UNIQUE_PENDING_FOR_SUBMIT_IDS, $this->unique_pending_for_submit_ids);
        }
        if ($this->isColumnModified(ExpenseNotificationTableMap::COL_UNIQUE_PENDING_PUNCHOUT_IDS)) {
            $criteria->add(ExpenseNotificationTableMap::COL_UNIQUE_PENDING_PUNCHOUT_IDS, $this->unique_pending_punchout_ids);
        }
        if ($this->isColumnModified(ExpenseNotificationTableMap::COL_UNIQUE_PENDING_APPROVAL_MANAGER_IDS)) {
            $criteria->add(ExpenseNotificationTableMap::COL_UNIQUE_PENDING_APPROVAL_MANAGER_IDS, $this->unique_pending_approval_manager_ids);
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
        throw new LogicException('The ExpenseNotification object has no primary key');

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
        $validPk = false;

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
     * Returns NULL since this table doesn't have a primary key.
     * This method exists only for BC and is deprecated!
     * @return null
     */
    public function getPrimaryKey()
    {
        return null;
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return false;
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \entities\ExpenseNotification (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setMoye($this->getMoye());
        $copyObj->setPendingForSubmit($this->getPendingForSubmit());
        $copyObj->setPendingForApprove($this->getPendingForApprove());
        $copyObj->setPendingForAudit($this->getPendingForAudit());
        $copyObj->setOrgunitId($this->getOrgunitId());
        $copyObj->setUnitName($this->getUnitName());
        $copyObj->setPendingPunchout($this->getPendingPunchout());
        $copyObj->setUniquePendingForSubmit($this->getUniquePendingForSubmit());
        $copyObj->setUniquePendingForApprove($this->getUniquePendingForApprove());
        $copyObj->setUniquePendingForSubmitIds($this->getUniquePendingForSubmitIds());
        $copyObj->setUniquePendingPunchout($this->getUniquePendingPunchout());
        $copyObj->setUniquePendingApprovalManagerIds($this->getUniquePendingApprovalManagerIds());
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
     * @return \entities\ExpenseNotification Clone of current object.
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
        $this->moye = null;
        $this->pending_for_submit = null;
        $this->pending_for_approve = null;
        $this->pending_for_audit = null;
        $this->orgunit_id = null;
        $this->unit_name = null;
        $this->pending_punchout = null;
        $this->unique_pending_for_submit = null;
        $this->unique_pending_for_approve = null;
        $this->unique_pending_for_submit_ids = null;
        $this->unique_pending_punchout_ids = null;
        $this->unique_pending_approval_manager_ids = null;
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
        return (string) $this->exportTo(ExpenseNotificationTableMap::DEFAULT_STRING_FORMAT);
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
