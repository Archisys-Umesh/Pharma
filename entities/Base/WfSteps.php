<?php

namespace entities\Base;

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
use entities\WfMaster as ChildWfMaster;
use entities\WfMasterQuery as ChildWfMasterQuery;
use entities\WfRequests as ChildWfRequests;
use entities\WfRequestsQuery as ChildWfRequestsQuery;
use entities\WfSteps as ChildWfSteps;
use entities\WfStepsQuery as ChildWfStepsQuery;
use entities\Map\WfRequestsTableMap;
use entities\Map\WfStepsTableMap;

/**
 * Base class that represents a row from the 'wf_steps' table.
 *
 *
 *
 * @package    propel.generator.entities.Base
 */
abstract class WfSteps implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\entities\\Map\\WfStepsTableMap';


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
     * The value for the wf_steps_id field.
     *
     * @var        int
     */
    protected $wf_steps_id;

    /**
     * The value for the wf_id field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $wf_id;

    /**
     * The value for the wf_in_status field.
     *
     * Note: this column has a database default value of: '0'
     * @var        string
     */
    protected $wf_in_status;

    /**
     * The value for the request_up field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $request_up;

    /**
     * The value for the wf_out_status field.
     *
     * Note: this column has a database default value of: '0'
     * @var        string
     */
    protected $wf_out_status;

    /**
     * The value for the wf_request_desc field.
     *
     * Note: this column has a database default value of: '0'
     * @var        string
     */
    protected $wf_request_desc;

    /**
     * The value for the wf_step_level field.
     *
     * @var        string
     */
    protected $wf_step_level;

    /**
     * The value for the wf_btn_desc field.
     *
     * @var        string
     */
    protected $wf_btn_desc;

    /**
     * The value for the notification_status field.
     *
     * Note: this column has a database default value of: 1
     * @var        int
     */
    protected $notification_status;

    /**
     * @var        ChildWfMaster
     */
    protected $aWfMaster;

    /**
     * @var        ObjectCollection|ChildWfRequests[] Collection to store aggregation of ChildWfRequests objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildWfRequests> Collection to store aggregation of ChildWfRequests objects.
     */
    protected $collWfRequestss;
    protected $collWfRequestssPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildWfRequests[]
     * @phpstan-var ObjectCollection&\Traversable<ChildWfRequests>
     */
    protected $wfRequestssScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues(): void
    {
        $this->wf_id = 0;
        $this->wf_in_status = '0';
        $this->request_up = 0;
        $this->wf_out_status = '0';
        $this->wf_request_desc = '0';
        $this->notification_status = 1;
    }

    /**
     * Initializes internal state of entities\Base\WfSteps object.
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
     * Compares this with another <code>WfSteps</code> instance.  If
     * <code>obj</code> is an instance of <code>WfSteps</code>, delegates to
     * <code>equals(WfSteps)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [wf_steps_id] column value.
     *
     * @return int
     */
    public function getWfStepsId()
    {
        return $this->wf_steps_id;
    }

    /**
     * Get the [wf_id] column value.
     *
     * @return int
     */
    public function getWfId()
    {
        return $this->wf_id;
    }

    /**
     * Get the [wf_in_status] column value.
     *
     * @return string
     */
    public function getWfInStatus()
    {
        return $this->wf_in_status;
    }

    /**
     * Get the [request_up] column value.
     *
     * @return int
     */
    public function getRequestUp()
    {
        return $this->request_up;
    }

    /**
     * Get the [wf_out_status] column value.
     *
     * @return string
     */
    public function getWfOutStatus()
    {
        return $this->wf_out_status;
    }

    /**
     * Get the [wf_request_desc] column value.
     *
     * @return string
     */
    public function getWfRequestDesc()
    {
        return $this->wf_request_desc;
    }

    /**
     * Get the [wf_step_level] column value.
     *
     * @return string
     */
    public function getWfStepLevel()
    {
        return $this->wf_step_level;
    }

    /**
     * Get the [wf_btn_desc] column value.
     *
     * @return string
     */
    public function getWfBtnDesc()
    {
        return $this->wf_btn_desc;
    }

    /**
     * Get the [notification_status] column value.
     *
     * @return int
     */
    public function getNotificationStatus()
    {
        return $this->notification_status;
    }

    /**
     * Set the value of [wf_steps_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setWfStepsId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->wf_steps_id !== $v) {
            $this->wf_steps_id = $v;
            $this->modifiedColumns[WfStepsTableMap::COL_WF_STEPS_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [wf_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setWfId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->wf_id !== $v) {
            $this->wf_id = $v;
            $this->modifiedColumns[WfStepsTableMap::COL_WF_ID] = true;
        }

        if ($this->aWfMaster !== null && $this->aWfMaster->getWfId() !== $v) {
            $this->aWfMaster = null;
        }

        return $this;
    }

    /**
     * Set the value of [wf_in_status] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setWfInStatus($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->wf_in_status !== $v) {
            $this->wf_in_status = $v;
            $this->modifiedColumns[WfStepsTableMap::COL_WF_IN_STATUS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [request_up] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setRequestUp($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->request_up !== $v) {
            $this->request_up = $v;
            $this->modifiedColumns[WfStepsTableMap::COL_REQUEST_UP] = true;
        }

        return $this;
    }

    /**
     * Set the value of [wf_out_status] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setWfOutStatus($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->wf_out_status !== $v) {
            $this->wf_out_status = $v;
            $this->modifiedColumns[WfStepsTableMap::COL_WF_OUT_STATUS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [wf_request_desc] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setWfRequestDesc($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->wf_request_desc !== $v) {
            $this->wf_request_desc = $v;
            $this->modifiedColumns[WfStepsTableMap::COL_WF_REQUEST_DESC] = true;
        }

        return $this;
    }

    /**
     * Set the value of [wf_step_level] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setWfStepLevel($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->wf_step_level !== $v) {
            $this->wf_step_level = $v;
            $this->modifiedColumns[WfStepsTableMap::COL_WF_STEP_LEVEL] = true;
        }

        return $this;
    }

    /**
     * Set the value of [wf_btn_desc] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setWfBtnDesc($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->wf_btn_desc !== $v) {
            $this->wf_btn_desc = $v;
            $this->modifiedColumns[WfStepsTableMap::COL_WF_BTN_DESC] = true;
        }

        return $this;
    }

    /**
     * Set the value of [notification_status] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setNotificationStatus($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->notification_status !== $v) {
            $this->notification_status = $v;
            $this->modifiedColumns[WfStepsTableMap::COL_NOTIFICATION_STATUS] = true;
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
            if ($this->wf_id !== 0) {
                return false;
            }

            if ($this->wf_in_status !== '0') {
                return false;
            }

            if ($this->request_up !== 0) {
                return false;
            }

            if ($this->wf_out_status !== '0') {
                return false;
            }

            if ($this->wf_request_desc !== '0') {
                return false;
            }

            if ($this->notification_status !== 1) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : WfStepsTableMap::translateFieldName('WfStepsId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->wf_steps_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : WfStepsTableMap::translateFieldName('WfId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->wf_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : WfStepsTableMap::translateFieldName('WfInStatus', TableMap::TYPE_PHPNAME, $indexType)];
            $this->wf_in_status = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : WfStepsTableMap::translateFieldName('RequestUp', TableMap::TYPE_PHPNAME, $indexType)];
            $this->request_up = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : WfStepsTableMap::translateFieldName('WfOutStatus', TableMap::TYPE_PHPNAME, $indexType)];
            $this->wf_out_status = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : WfStepsTableMap::translateFieldName('WfRequestDesc', TableMap::TYPE_PHPNAME, $indexType)];
            $this->wf_request_desc = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : WfStepsTableMap::translateFieldName('WfStepLevel', TableMap::TYPE_PHPNAME, $indexType)];
            $this->wf_step_level = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : WfStepsTableMap::translateFieldName('WfBtnDesc', TableMap::TYPE_PHPNAME, $indexType)];
            $this->wf_btn_desc = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : WfStepsTableMap::translateFieldName('NotificationStatus', TableMap::TYPE_PHPNAME, $indexType)];
            $this->notification_status = (null !== $col) ? (int) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 9; // 9 = WfStepsTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\entities\\WfSteps'), 0, $e);
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
        if ($this->aWfMaster !== null && $this->wf_id !== $this->aWfMaster->getWfId()) {
            $this->aWfMaster = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(WfStepsTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildWfStepsQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aWfMaster = null;
            $this->collWfRequestss = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see WfSteps::setDeleted()
     * @see WfSteps::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(WfStepsTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildWfStepsQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(WfStepsTableMap::DATABASE_NAME);
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
                WfStepsTableMap::addInstanceToPool($this);
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

            if ($this->aWfMaster !== null) {
                if ($this->aWfMaster->isModified() || $this->aWfMaster->isNew()) {
                    $affectedRows += $this->aWfMaster->save($con);
                }
                $this->setWfMaster($this->aWfMaster);
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

            if ($this->wfRequestssScheduledForDeletion !== null) {
                if (!$this->wfRequestssScheduledForDeletion->isEmpty()) {
                    \entities\WfRequestsQuery::create()
                        ->filterByPrimaryKeys($this->wfRequestssScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->wfRequestssScheduledForDeletion = null;
                }
            }

            if ($this->collWfRequestss !== null) {
                foreach ($this->collWfRequestss as $referrerFK) {
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

        $this->modifiedColumns[WfStepsTableMap::COL_WF_STEPS_ID] = true;
        if (null !== $this->wf_steps_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . WfStepsTableMap::COL_WF_STEPS_ID . ')');
        }
        if (null === $this->wf_steps_id) {
            try {
                $dataFetcher = $con->query("SELECT nextval('wf_steps_wf_steps_id_seq')");
                $this->wf_steps_id = (int) $dataFetcher->fetchColumn();
            } catch (Exception $e) {
                throw new PropelException('Unable to get sequence id.', 0, $e);
            }
        }


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(WfStepsTableMap::COL_WF_STEPS_ID)) {
            $modifiedColumns[':p' . $index++]  = 'wf_steps_id';
        }
        if ($this->isColumnModified(WfStepsTableMap::COL_WF_ID)) {
            $modifiedColumns[':p' . $index++]  = 'wf_id';
        }
        if ($this->isColumnModified(WfStepsTableMap::COL_WF_IN_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'wf_in_status';
        }
        if ($this->isColumnModified(WfStepsTableMap::COL_REQUEST_UP)) {
            $modifiedColumns[':p' . $index++]  = 'request_up';
        }
        if ($this->isColumnModified(WfStepsTableMap::COL_WF_OUT_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'wf_out_status';
        }
        if ($this->isColumnModified(WfStepsTableMap::COL_WF_REQUEST_DESC)) {
            $modifiedColumns[':p' . $index++]  = 'wf_request_desc';
        }
        if ($this->isColumnModified(WfStepsTableMap::COL_WF_STEP_LEVEL)) {
            $modifiedColumns[':p' . $index++]  = 'wf_step_level';
        }
        if ($this->isColumnModified(WfStepsTableMap::COL_WF_BTN_DESC)) {
            $modifiedColumns[':p' . $index++]  = 'wf_btn_desc';
        }
        if ($this->isColumnModified(WfStepsTableMap::COL_NOTIFICATION_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'notification_status';
        }

        $sql = sprintf(
            'INSERT INTO wf_steps (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'wf_steps_id':
                        $stmt->bindValue($identifier, $this->wf_steps_id, PDO::PARAM_INT);

                        break;
                    case 'wf_id':
                        $stmt->bindValue($identifier, $this->wf_id, PDO::PARAM_INT);

                        break;
                    case 'wf_in_status':
                        $stmt->bindValue($identifier, $this->wf_in_status, PDO::PARAM_STR);

                        break;
                    case 'request_up':
                        $stmt->bindValue($identifier, $this->request_up, PDO::PARAM_INT);

                        break;
                    case 'wf_out_status':
                        $stmt->bindValue($identifier, $this->wf_out_status, PDO::PARAM_STR);

                        break;
                    case 'wf_request_desc':
                        $stmt->bindValue($identifier, $this->wf_request_desc, PDO::PARAM_STR);

                        break;
                    case 'wf_step_level':
                        $stmt->bindValue($identifier, $this->wf_step_level, PDO::PARAM_STR);

                        break;
                    case 'wf_btn_desc':
                        $stmt->bindValue($identifier, $this->wf_btn_desc, PDO::PARAM_STR);

                        break;
                    case 'notification_status':
                        $stmt->bindValue($identifier, $this->notification_status, PDO::PARAM_INT);

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
        $pos = WfStepsTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getWfStepsId();

            case 1:
                return $this->getWfId();

            case 2:
                return $this->getWfInStatus();

            case 3:
                return $this->getRequestUp();

            case 4:
                return $this->getWfOutStatus();

            case 5:
                return $this->getWfRequestDesc();

            case 6:
                return $this->getWfStepLevel();

            case 7:
                return $this->getWfBtnDesc();

            case 8:
                return $this->getNotificationStatus();

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
        if (isset($alreadyDumpedObjects['WfSteps'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['WfSteps'][$this->hashCode()] = true;
        $keys = WfStepsTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getWfStepsId(),
            $keys[1] => $this->getWfId(),
            $keys[2] => $this->getWfInStatus(),
            $keys[3] => $this->getRequestUp(),
            $keys[4] => $this->getWfOutStatus(),
            $keys[5] => $this->getWfRequestDesc(),
            $keys[6] => $this->getWfStepLevel(),
            $keys[7] => $this->getWfBtnDesc(),
            $keys[8] => $this->getNotificationStatus(),
        ];
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aWfMaster) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'wfMaster';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'wf_master';
                        break;
                    default:
                        $key = 'WfMaster';
                }

                $result[$key] = $this->aWfMaster->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collWfRequestss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'wfRequestss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'wf_requestss';
                        break;
                    default:
                        $key = 'WfRequestss';
                }

                $result[$key] = $this->collWfRequestss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = WfStepsTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setWfStepsId($value);
                break;
            case 1:
                $this->setWfId($value);
                break;
            case 2:
                $this->setWfInStatus($value);
                break;
            case 3:
                $this->setRequestUp($value);
                break;
            case 4:
                $this->setWfOutStatus($value);
                break;
            case 5:
                $this->setWfRequestDesc($value);
                break;
            case 6:
                $this->setWfStepLevel($value);
                break;
            case 7:
                $this->setWfBtnDesc($value);
                break;
            case 8:
                $this->setNotificationStatus($value);
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
        $keys = WfStepsTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setWfStepsId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setWfId($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setWfInStatus($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setRequestUp($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setWfOutStatus($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setWfRequestDesc($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setWfStepLevel($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setWfBtnDesc($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setNotificationStatus($arr[$keys[8]]);
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
        $criteria = new Criteria(WfStepsTableMap::DATABASE_NAME);

        if ($this->isColumnModified(WfStepsTableMap::COL_WF_STEPS_ID)) {
            $criteria->add(WfStepsTableMap::COL_WF_STEPS_ID, $this->wf_steps_id);
        }
        if ($this->isColumnModified(WfStepsTableMap::COL_WF_ID)) {
            $criteria->add(WfStepsTableMap::COL_WF_ID, $this->wf_id);
        }
        if ($this->isColumnModified(WfStepsTableMap::COL_WF_IN_STATUS)) {
            $criteria->add(WfStepsTableMap::COL_WF_IN_STATUS, $this->wf_in_status);
        }
        if ($this->isColumnModified(WfStepsTableMap::COL_REQUEST_UP)) {
            $criteria->add(WfStepsTableMap::COL_REQUEST_UP, $this->request_up);
        }
        if ($this->isColumnModified(WfStepsTableMap::COL_WF_OUT_STATUS)) {
            $criteria->add(WfStepsTableMap::COL_WF_OUT_STATUS, $this->wf_out_status);
        }
        if ($this->isColumnModified(WfStepsTableMap::COL_WF_REQUEST_DESC)) {
            $criteria->add(WfStepsTableMap::COL_WF_REQUEST_DESC, $this->wf_request_desc);
        }
        if ($this->isColumnModified(WfStepsTableMap::COL_WF_STEP_LEVEL)) {
            $criteria->add(WfStepsTableMap::COL_WF_STEP_LEVEL, $this->wf_step_level);
        }
        if ($this->isColumnModified(WfStepsTableMap::COL_WF_BTN_DESC)) {
            $criteria->add(WfStepsTableMap::COL_WF_BTN_DESC, $this->wf_btn_desc);
        }
        if ($this->isColumnModified(WfStepsTableMap::COL_NOTIFICATION_STATUS)) {
            $criteria->add(WfStepsTableMap::COL_NOTIFICATION_STATUS, $this->notification_status);
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
        $criteria = ChildWfStepsQuery::create();
        $criteria->add(WfStepsTableMap::COL_WF_STEPS_ID, $this->wf_steps_id);

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
        $validPk = null !== $this->getWfStepsId();

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
        return $this->getWfStepsId();
    }

    /**
     * Generic method to set the primary key (wf_steps_id column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setWfStepsId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getWfStepsId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \entities\WfSteps (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setWfId($this->getWfId());
        $copyObj->setWfInStatus($this->getWfInStatus());
        $copyObj->setRequestUp($this->getRequestUp());
        $copyObj->setWfOutStatus($this->getWfOutStatus());
        $copyObj->setWfRequestDesc($this->getWfRequestDesc());
        $copyObj->setWfStepLevel($this->getWfStepLevel());
        $copyObj->setWfBtnDesc($this->getWfBtnDesc());
        $copyObj->setNotificationStatus($this->getNotificationStatus());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getWfRequestss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addWfRequests($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setWfStepsId(NULL); // this is a auto-increment column, so set to default value
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
     * @return \entities\WfSteps Clone of current object.
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
     * Declares an association between this object and a ChildWfMaster object.
     *
     * @param ChildWfMaster $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setWfMaster(ChildWfMaster $v = null)
    {
        if ($v === null) {
            $this->setWfId(0);
        } else {
            $this->setWfId($v->getWfId());
        }

        $this->aWfMaster = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildWfMaster object, it will not be re-added.
        if ($v !== null) {
            $v->addWfSteps($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildWfMaster object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildWfMaster The associated ChildWfMaster object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getWfMaster(?ConnectionInterface $con = null)
    {
        if ($this->aWfMaster === null && ($this->wf_id != 0)) {
            $this->aWfMaster = ChildWfMasterQuery::create()->findPk($this->wf_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aWfMaster->addWfStepss($this);
             */
        }

        return $this->aWfMaster;
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
        if ('WfRequests' === $relationName) {
            $this->initWfRequestss();
            return;
        }
    }

    /**
     * Clears out the collWfRequestss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addWfRequestss()
     */
    public function clearWfRequestss()
    {
        $this->collWfRequestss = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collWfRequestss collection loaded partially.
     *
     * @return void
     */
    public function resetPartialWfRequestss($v = true): void
    {
        $this->collWfRequestssPartial = $v;
    }

    /**
     * Initializes the collWfRequestss collection.
     *
     * By default this just sets the collWfRequestss collection to an empty array (like clearcollWfRequestss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initWfRequestss(bool $overrideExisting = true): void
    {
        if (null !== $this->collWfRequestss && !$overrideExisting) {
            return;
        }

        $collectionClassName = WfRequestsTableMap::getTableMap()->getCollectionClassName();

        $this->collWfRequestss = new $collectionClassName;
        $this->collWfRequestss->setModel('\entities\WfRequests');
    }

    /**
     * Gets an array of ChildWfRequests objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildWfSteps is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildWfRequests[] List of ChildWfRequests objects
     * @phpstan-return ObjectCollection&\Traversable<ChildWfRequests> List of ChildWfRequests objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getWfRequestss(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collWfRequestssPartial && !$this->isNew();
        if (null === $this->collWfRequestss || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collWfRequestss) {
                    $this->initWfRequestss();
                } else {
                    $collectionClassName = WfRequestsTableMap::getTableMap()->getCollectionClassName();

                    $collWfRequestss = new $collectionClassName;
                    $collWfRequestss->setModel('\entities\WfRequests');

                    return $collWfRequestss;
                }
            } else {
                $collWfRequestss = ChildWfRequestsQuery::create(null, $criteria)
                    ->filterByWfSteps($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collWfRequestssPartial && count($collWfRequestss)) {
                        $this->initWfRequestss(false);

                        foreach ($collWfRequestss as $obj) {
                            if (false == $this->collWfRequestss->contains($obj)) {
                                $this->collWfRequestss->append($obj);
                            }
                        }

                        $this->collWfRequestssPartial = true;
                    }

                    return $collWfRequestss;
                }

                if ($partial && $this->collWfRequestss) {
                    foreach ($this->collWfRequestss as $obj) {
                        if ($obj->isNew()) {
                            $collWfRequestss[] = $obj;
                        }
                    }
                }

                $this->collWfRequestss = $collWfRequestss;
                $this->collWfRequestssPartial = false;
            }
        }

        return $this->collWfRequestss;
    }

    /**
     * Sets a collection of ChildWfRequests objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $wfRequestss A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setWfRequestss(Collection $wfRequestss, ?ConnectionInterface $con = null)
    {
        /** @var ChildWfRequests[] $wfRequestssToDelete */
        $wfRequestssToDelete = $this->getWfRequestss(new Criteria(), $con)->diff($wfRequestss);


        $this->wfRequestssScheduledForDeletion = $wfRequestssToDelete;

        foreach ($wfRequestssToDelete as $wfRequestsRemoved) {
            $wfRequestsRemoved->setWfSteps(null);
        }

        $this->collWfRequestss = null;
        foreach ($wfRequestss as $wfRequests) {
            $this->addWfRequests($wfRequests);
        }

        $this->collWfRequestss = $wfRequestss;
        $this->collWfRequestssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related WfRequests objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related WfRequests objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countWfRequestss(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collWfRequestssPartial && !$this->isNew();
        if (null === $this->collWfRequestss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collWfRequestss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getWfRequestss());
            }

            $query = ChildWfRequestsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByWfSteps($this)
                ->count($con);
        }

        return count($this->collWfRequestss);
    }

    /**
     * Method called to associate a ChildWfRequests object to this object
     * through the ChildWfRequests foreign key attribute.
     *
     * @param ChildWfRequests $l ChildWfRequests
     * @return $this The current object (for fluent API support)
     */
    public function addWfRequests(ChildWfRequests $l)
    {
        if ($this->collWfRequestss === null) {
            $this->initWfRequestss();
            $this->collWfRequestssPartial = true;
        }

        if (!$this->collWfRequestss->contains($l)) {
            $this->doAddWfRequests($l);

            if ($this->wfRequestssScheduledForDeletion and $this->wfRequestssScheduledForDeletion->contains($l)) {
                $this->wfRequestssScheduledForDeletion->remove($this->wfRequestssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildWfRequests $wfRequests The ChildWfRequests object to add.
     */
    protected function doAddWfRequests(ChildWfRequests $wfRequests): void
    {
        $this->collWfRequestss[]= $wfRequests;
        $wfRequests->setWfSteps($this);
    }

    /**
     * @param ChildWfRequests $wfRequests The ChildWfRequests object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeWfRequests(ChildWfRequests $wfRequests)
    {
        if ($this->getWfRequestss()->contains($wfRequests)) {
            $pos = $this->collWfRequestss->search($wfRequests);
            $this->collWfRequestss->remove($pos);
            if (null === $this->wfRequestssScheduledForDeletion) {
                $this->wfRequestssScheduledForDeletion = clone $this->collWfRequestss;
                $this->wfRequestssScheduledForDeletion->clear();
            }
            $this->wfRequestssScheduledForDeletion[]= clone $wfRequests;
            $wfRequests->setWfSteps(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this WfSteps is new, it will return
     * an empty collection; or if this WfSteps has previously
     * been saved, it will retrieve related WfRequestss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in WfSteps.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildWfRequests[] List of ChildWfRequests objects
     * @phpstan-return ObjectCollection&\Traversable<ChildWfRequests}> List of ChildWfRequests objects
     */
    public function getWfRequestssJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildWfRequestsQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getWfRequestss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this WfSteps is new, it will return
     * an empty collection; or if this WfSteps has previously
     * been saved, it will retrieve related WfRequestss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in WfSteps.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildWfRequests[] List of ChildWfRequests objects
     * @phpstan-return ObjectCollection&\Traversable<ChildWfRequests}> List of ChildWfRequests objects
     */
    public function getWfRequestssJoinEmployee(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildWfRequestsQuery::create(null, $criteria);
        $query->joinWith('Employee', $joinBehavior);

        return $this->getWfRequestss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this WfSteps is new, it will return
     * an empty collection; or if this WfSteps has previously
     * been saved, it will retrieve related WfRequestss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in WfSteps.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildWfRequests[] List of ChildWfRequests objects
     * @phpstan-return ObjectCollection&\Traversable<ChildWfRequests}> List of ChildWfRequests objects
     */
    public function getWfRequestssJoinWfDocuments(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildWfRequestsQuery::create(null, $criteria);
        $query->joinWith('WfDocuments', $joinBehavior);

        return $this->getWfRequestss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this WfSteps is new, it will return
     * an empty collection; or if this WfSteps has previously
     * been saved, it will retrieve related WfRequestss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in WfSteps.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildWfRequests[] List of ChildWfRequests objects
     * @phpstan-return ObjectCollection&\Traversable<ChildWfRequests}> List of ChildWfRequests objects
     */
    public function getWfRequestssJoinWfMaster(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildWfRequestsQuery::create(null, $criteria);
        $query->joinWith('WfMaster', $joinBehavior);

        return $this->getWfRequestss($query, $con);
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
        if (null !== $this->aWfMaster) {
            $this->aWfMaster->removeWfSteps($this);
        }
        $this->wf_steps_id = null;
        $this->wf_id = null;
        $this->wf_in_status = null;
        $this->request_up = null;
        $this->wf_out_status = null;
        $this->wf_request_desc = null;
        $this->wf_step_level = null;
        $this->wf_btn_desc = null;
        $this->notification_status = null;
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
            if ($this->collWfRequestss) {
                foreach ($this->collWfRequestss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collWfRequestss = null;
        $this->aWfMaster = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(WfStepsTableMap::DEFAULT_STRING_FORMAT);
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
