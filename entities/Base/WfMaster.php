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
use entities\WfDocuments as ChildWfDocuments;
use entities\WfDocumentsQuery as ChildWfDocumentsQuery;
use entities\WfMaster as ChildWfMaster;
use entities\WfMasterQuery as ChildWfMasterQuery;
use entities\WfRequests as ChildWfRequests;
use entities\WfRequestsQuery as ChildWfRequestsQuery;
use entities\WfStatus as ChildWfStatus;
use entities\WfStatusQuery as ChildWfStatusQuery;
use entities\WfSteps as ChildWfSteps;
use entities\WfStepsQuery as ChildWfStepsQuery;
use entities\Map\WfDocumentsTableMap;
use entities\Map\WfMasterTableMap;
use entities\Map\WfRequestsTableMap;
use entities\Map\WfStatusTableMap;
use entities\Map\WfStepsTableMap;

/**
 * Base class that represents a row from the 'wf_master' table.
 *
 *
 *
 * @package    propel.generator.entities.Base
 */
abstract class WfMaster implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\entities\\Map\\WfMasterTableMap';


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
     * The value for the wf_id field.
     *
     * @var        int
     */
    protected $wf_id;

    /**
     * The value for the wf_name field.
     *
     * @var        string
     */
    protected $wf_name;

    /**
     * @var        ObjectCollection|ChildWfDocuments[] Collection to store aggregation of ChildWfDocuments objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildWfDocuments> Collection to store aggregation of ChildWfDocuments objects.
     */
    protected $collWfDocumentss;
    protected $collWfDocumentssPartial;

    /**
     * @var        ObjectCollection|ChildWfRequests[] Collection to store aggregation of ChildWfRequests objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildWfRequests> Collection to store aggregation of ChildWfRequests objects.
     */
    protected $collWfRequestss;
    protected $collWfRequestssPartial;

    /**
     * @var        ObjectCollection|ChildWfStatus[] Collection to store aggregation of ChildWfStatus objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildWfStatus> Collection to store aggregation of ChildWfStatus objects.
     */
    protected $collWfStatuses;
    protected $collWfStatusesPartial;

    /**
     * @var        ObjectCollection|ChildWfSteps[] Collection to store aggregation of ChildWfSteps objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildWfSteps> Collection to store aggregation of ChildWfSteps objects.
     */
    protected $collWfStepss;
    protected $collWfStepssPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildWfDocuments[]
     * @phpstan-var ObjectCollection&\Traversable<ChildWfDocuments>
     */
    protected $wfDocumentssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildWfRequests[]
     * @phpstan-var ObjectCollection&\Traversable<ChildWfRequests>
     */
    protected $wfRequestssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildWfStatus[]
     * @phpstan-var ObjectCollection&\Traversable<ChildWfStatus>
     */
    protected $wfStatusesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildWfSteps[]
     * @phpstan-var ObjectCollection&\Traversable<ChildWfSteps>
     */
    protected $wfStepssScheduledForDeletion = null;

    /**
     * Initializes internal state of entities\Base\WfMaster object.
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
     * Compares this with another <code>WfMaster</code> instance.  If
     * <code>obj</code> is an instance of <code>WfMaster</code>, delegates to
     * <code>equals(WfMaster)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [wf_id] column value.
     *
     * @return int
     */
    public function getWfId()
    {
        return $this->wf_id;
    }

    /**
     * Get the [wf_name] column value.
     *
     * @return string
     */
    public function getWfName()
    {
        return $this->wf_name;
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
            $this->modifiedColumns[WfMasterTableMap::COL_WF_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [wf_name] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setWfName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->wf_name !== $v) {
            $this->wf_name = $v;
            $this->modifiedColumns[WfMasterTableMap::COL_WF_NAME] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : WfMasterTableMap::translateFieldName('WfId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->wf_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : WfMasterTableMap::translateFieldName('WfName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->wf_name = (null !== $col) ? (string) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 2; // 2 = WfMasterTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\entities\\WfMaster'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(WfMasterTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildWfMasterQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collWfDocumentss = null;

            $this->collWfRequestss = null;

            $this->collWfStatuses = null;

            $this->collWfStepss = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see WfMaster::setDeleted()
     * @see WfMaster::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(WfMasterTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildWfMasterQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(WfMasterTableMap::DATABASE_NAME);
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
                WfMasterTableMap::addInstanceToPool($this);
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

            if ($this->wfDocumentssScheduledForDeletion !== null) {
                if (!$this->wfDocumentssScheduledForDeletion->isEmpty()) {
                    \entities\WfDocumentsQuery::create()
                        ->filterByPrimaryKeys($this->wfDocumentssScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->wfDocumentssScheduledForDeletion = null;
                }
            }

            if ($this->collWfDocumentss !== null) {
                foreach ($this->collWfDocumentss as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
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

            if ($this->wfStatusesScheduledForDeletion !== null) {
                if (!$this->wfStatusesScheduledForDeletion->isEmpty()) {
                    \entities\WfStatusQuery::create()
                        ->filterByPrimaryKeys($this->wfStatusesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->wfStatusesScheduledForDeletion = null;
                }
            }

            if ($this->collWfStatuses !== null) {
                foreach ($this->collWfStatuses as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->wfStepssScheduledForDeletion !== null) {
                if (!$this->wfStepssScheduledForDeletion->isEmpty()) {
                    \entities\WfStepsQuery::create()
                        ->filterByPrimaryKeys($this->wfStepssScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->wfStepssScheduledForDeletion = null;
                }
            }

            if ($this->collWfStepss !== null) {
                foreach ($this->collWfStepss as $referrerFK) {
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

        $this->modifiedColumns[WfMasterTableMap::COL_WF_ID] = true;
        if (null !== $this->wf_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . WfMasterTableMap::COL_WF_ID . ')');
        }
        if (null === $this->wf_id) {
            try {
                $dataFetcher = $con->query("SELECT nextval('wf_master_wf_id_seq')");
                $this->wf_id = (int) $dataFetcher->fetchColumn();
            } catch (Exception $e) {
                throw new PropelException('Unable to get sequence id.', 0, $e);
            }
        }


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(WfMasterTableMap::COL_WF_ID)) {
            $modifiedColumns[':p' . $index++]  = 'wf_id';
        }
        if ($this->isColumnModified(WfMasterTableMap::COL_WF_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'wf_name';
        }

        $sql = sprintf(
            'INSERT INTO wf_master (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'wf_id':
                        $stmt->bindValue($identifier, $this->wf_id, PDO::PARAM_INT);

                        break;
                    case 'wf_name':
                        $stmt->bindValue($identifier, $this->wf_name, PDO::PARAM_STR);

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
        $pos = WfMasterTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getWfId();

            case 1:
                return $this->getWfName();

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
        if (isset($alreadyDumpedObjects['WfMaster'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['WfMaster'][$this->hashCode()] = true;
        $keys = WfMasterTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getWfId(),
            $keys[1] => $this->getWfName(),
        ];
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collWfDocumentss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'wfDocumentss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'wf_documentss';
                        break;
                    default:
                        $key = 'WfDocumentss';
                }

                $result[$key] = $this->collWfDocumentss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
            if (null !== $this->collWfStatuses) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'wfStatuses';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'wf_statuses';
                        break;
                    default:
                        $key = 'WfStatuses';
                }

                $result[$key] = $this->collWfStatuses->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collWfStepss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'wfStepss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'wf_stepss';
                        break;
                    default:
                        $key = 'WfStepss';
                }

                $result[$key] = $this->collWfStepss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = WfMasterTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setWfId($value);
                break;
            case 1:
                $this->setWfName($value);
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
        $keys = WfMasterTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setWfId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setWfName($arr[$keys[1]]);
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
        $criteria = new Criteria(WfMasterTableMap::DATABASE_NAME);

        if ($this->isColumnModified(WfMasterTableMap::COL_WF_ID)) {
            $criteria->add(WfMasterTableMap::COL_WF_ID, $this->wf_id);
        }
        if ($this->isColumnModified(WfMasterTableMap::COL_WF_NAME)) {
            $criteria->add(WfMasterTableMap::COL_WF_NAME, $this->wf_name);
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
        $criteria = ChildWfMasterQuery::create();
        $criteria->add(WfMasterTableMap::COL_WF_ID, $this->wf_id);

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
        $validPk = null !== $this->getWfId();

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
        return $this->getWfId();
    }

    /**
     * Generic method to set the primary key (wf_id column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setWfId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getWfId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \entities\WfMaster (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setWfName($this->getWfName());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getWfDocumentss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addWfDocuments($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getWfRequestss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addWfRequests($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getWfStatuses() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addWfStatus($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getWfStepss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addWfSteps($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setWfId(NULL); // this is a auto-increment column, so set to default value
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
     * @return \entities\WfMaster Clone of current object.
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
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName): void
    {
        if ('WfDocuments' === $relationName) {
            $this->initWfDocumentss();
            return;
        }
        if ('WfRequests' === $relationName) {
            $this->initWfRequestss();
            return;
        }
        if ('WfStatus' === $relationName) {
            $this->initWfStatuses();
            return;
        }
        if ('WfSteps' === $relationName) {
            $this->initWfStepss();
            return;
        }
    }

    /**
     * Clears out the collWfDocumentss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addWfDocumentss()
     */
    public function clearWfDocumentss()
    {
        $this->collWfDocumentss = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collWfDocumentss collection loaded partially.
     *
     * @return void
     */
    public function resetPartialWfDocumentss($v = true): void
    {
        $this->collWfDocumentssPartial = $v;
    }

    /**
     * Initializes the collWfDocumentss collection.
     *
     * By default this just sets the collWfDocumentss collection to an empty array (like clearcollWfDocumentss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initWfDocumentss(bool $overrideExisting = true): void
    {
        if (null !== $this->collWfDocumentss && !$overrideExisting) {
            return;
        }

        $collectionClassName = WfDocumentsTableMap::getTableMap()->getCollectionClassName();

        $this->collWfDocumentss = new $collectionClassName;
        $this->collWfDocumentss->setModel('\entities\WfDocuments');
    }

    /**
     * Gets an array of ChildWfDocuments objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildWfMaster is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildWfDocuments[] List of ChildWfDocuments objects
     * @phpstan-return ObjectCollection&\Traversable<ChildWfDocuments> List of ChildWfDocuments objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getWfDocumentss(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collWfDocumentssPartial && !$this->isNew();
        if (null === $this->collWfDocumentss || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collWfDocumentss) {
                    $this->initWfDocumentss();
                } else {
                    $collectionClassName = WfDocumentsTableMap::getTableMap()->getCollectionClassName();

                    $collWfDocumentss = new $collectionClassName;
                    $collWfDocumentss->setModel('\entities\WfDocuments');

                    return $collWfDocumentss;
                }
            } else {
                $collWfDocumentss = ChildWfDocumentsQuery::create(null, $criteria)
                    ->filterByWfMaster($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collWfDocumentssPartial && count($collWfDocumentss)) {
                        $this->initWfDocumentss(false);

                        foreach ($collWfDocumentss as $obj) {
                            if (false == $this->collWfDocumentss->contains($obj)) {
                                $this->collWfDocumentss->append($obj);
                            }
                        }

                        $this->collWfDocumentssPartial = true;
                    }

                    return $collWfDocumentss;
                }

                if ($partial && $this->collWfDocumentss) {
                    foreach ($this->collWfDocumentss as $obj) {
                        if ($obj->isNew()) {
                            $collWfDocumentss[] = $obj;
                        }
                    }
                }

                $this->collWfDocumentss = $collWfDocumentss;
                $this->collWfDocumentssPartial = false;
            }
        }

        return $this->collWfDocumentss;
    }

    /**
     * Sets a collection of ChildWfDocuments objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $wfDocumentss A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setWfDocumentss(Collection $wfDocumentss, ?ConnectionInterface $con = null)
    {
        /** @var ChildWfDocuments[] $wfDocumentssToDelete */
        $wfDocumentssToDelete = $this->getWfDocumentss(new Criteria(), $con)->diff($wfDocumentss);


        $this->wfDocumentssScheduledForDeletion = $wfDocumentssToDelete;

        foreach ($wfDocumentssToDelete as $wfDocumentsRemoved) {
            $wfDocumentsRemoved->setWfMaster(null);
        }

        $this->collWfDocumentss = null;
        foreach ($wfDocumentss as $wfDocuments) {
            $this->addWfDocuments($wfDocuments);
        }

        $this->collWfDocumentss = $wfDocumentss;
        $this->collWfDocumentssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related WfDocuments objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related WfDocuments objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countWfDocumentss(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collWfDocumentssPartial && !$this->isNew();
        if (null === $this->collWfDocumentss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collWfDocumentss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getWfDocumentss());
            }

            $query = ChildWfDocumentsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByWfMaster($this)
                ->count($con);
        }

        return count($this->collWfDocumentss);
    }

    /**
     * Method called to associate a ChildWfDocuments object to this object
     * through the ChildWfDocuments foreign key attribute.
     *
     * @param ChildWfDocuments $l ChildWfDocuments
     * @return $this The current object (for fluent API support)
     */
    public function addWfDocuments(ChildWfDocuments $l)
    {
        if ($this->collWfDocumentss === null) {
            $this->initWfDocumentss();
            $this->collWfDocumentssPartial = true;
        }

        if (!$this->collWfDocumentss->contains($l)) {
            $this->doAddWfDocuments($l);

            if ($this->wfDocumentssScheduledForDeletion and $this->wfDocumentssScheduledForDeletion->contains($l)) {
                $this->wfDocumentssScheduledForDeletion->remove($this->wfDocumentssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildWfDocuments $wfDocuments The ChildWfDocuments object to add.
     */
    protected function doAddWfDocuments(ChildWfDocuments $wfDocuments): void
    {
        $this->collWfDocumentss[]= $wfDocuments;
        $wfDocuments->setWfMaster($this);
    }

    /**
     * @param ChildWfDocuments $wfDocuments The ChildWfDocuments object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeWfDocuments(ChildWfDocuments $wfDocuments)
    {
        if ($this->getWfDocumentss()->contains($wfDocuments)) {
            $pos = $this->collWfDocumentss->search($wfDocuments);
            $this->collWfDocumentss->remove($pos);
            if (null === $this->wfDocumentssScheduledForDeletion) {
                $this->wfDocumentssScheduledForDeletion = clone $this->collWfDocumentss;
                $this->wfDocumentssScheduledForDeletion->clear();
            }
            $this->wfDocumentssScheduledForDeletion[]= clone $wfDocuments;
            $wfDocuments->setWfMaster(null);
        }

        return $this;
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
     * If this ChildWfMaster is new, it will return
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
                    ->filterByWfMaster($this)
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
            $wfRequestsRemoved->setWfMaster(null);
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
                ->filterByWfMaster($this)
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
        $wfRequests->setWfMaster($this);
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
            $wfRequests->setWfMaster(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this WfMaster is new, it will return
     * an empty collection; or if this WfMaster has previously
     * been saved, it will retrieve related WfRequestss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in WfMaster.
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
     * Otherwise if this WfMaster is new, it will return
     * an empty collection; or if this WfMaster has previously
     * been saved, it will retrieve related WfRequestss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in WfMaster.
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
     * Otherwise if this WfMaster is new, it will return
     * an empty collection; or if this WfMaster has previously
     * been saved, it will retrieve related WfRequestss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in WfMaster.
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
     * Otherwise if this WfMaster is new, it will return
     * an empty collection; or if this WfMaster has previously
     * been saved, it will retrieve related WfRequestss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in WfMaster.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildWfRequests[] List of ChildWfRequests objects
     * @phpstan-return ObjectCollection&\Traversable<ChildWfRequests}> List of ChildWfRequests objects
     */
    public function getWfRequestssJoinWfSteps(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildWfRequestsQuery::create(null, $criteria);
        $query->joinWith('WfSteps', $joinBehavior);

        return $this->getWfRequestss($query, $con);
    }

    /**
     * Clears out the collWfStatuses collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addWfStatuses()
     */
    public function clearWfStatuses()
    {
        $this->collWfStatuses = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collWfStatuses collection loaded partially.
     *
     * @return void
     */
    public function resetPartialWfStatuses($v = true): void
    {
        $this->collWfStatusesPartial = $v;
    }

    /**
     * Initializes the collWfStatuses collection.
     *
     * By default this just sets the collWfStatuses collection to an empty array (like clearcollWfStatuses());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initWfStatuses(bool $overrideExisting = true): void
    {
        if (null !== $this->collWfStatuses && !$overrideExisting) {
            return;
        }

        $collectionClassName = WfStatusTableMap::getTableMap()->getCollectionClassName();

        $this->collWfStatuses = new $collectionClassName;
        $this->collWfStatuses->setModel('\entities\WfStatus');
    }

    /**
     * Gets an array of ChildWfStatus objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildWfMaster is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildWfStatus[] List of ChildWfStatus objects
     * @phpstan-return ObjectCollection&\Traversable<ChildWfStatus> List of ChildWfStatus objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getWfStatuses(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collWfStatusesPartial && !$this->isNew();
        if (null === $this->collWfStatuses || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collWfStatuses) {
                    $this->initWfStatuses();
                } else {
                    $collectionClassName = WfStatusTableMap::getTableMap()->getCollectionClassName();

                    $collWfStatuses = new $collectionClassName;
                    $collWfStatuses->setModel('\entities\WfStatus');

                    return $collWfStatuses;
                }
            } else {
                $collWfStatuses = ChildWfStatusQuery::create(null, $criteria)
                    ->filterByWfMaster($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collWfStatusesPartial && count($collWfStatuses)) {
                        $this->initWfStatuses(false);

                        foreach ($collWfStatuses as $obj) {
                            if (false == $this->collWfStatuses->contains($obj)) {
                                $this->collWfStatuses->append($obj);
                            }
                        }

                        $this->collWfStatusesPartial = true;
                    }

                    return $collWfStatuses;
                }

                if ($partial && $this->collWfStatuses) {
                    foreach ($this->collWfStatuses as $obj) {
                        if ($obj->isNew()) {
                            $collWfStatuses[] = $obj;
                        }
                    }
                }

                $this->collWfStatuses = $collWfStatuses;
                $this->collWfStatusesPartial = false;
            }
        }

        return $this->collWfStatuses;
    }

    /**
     * Sets a collection of ChildWfStatus objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $wfStatuses A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setWfStatuses(Collection $wfStatuses, ?ConnectionInterface $con = null)
    {
        /** @var ChildWfStatus[] $wfStatusesToDelete */
        $wfStatusesToDelete = $this->getWfStatuses(new Criteria(), $con)->diff($wfStatuses);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->wfStatusesScheduledForDeletion = clone $wfStatusesToDelete;

        foreach ($wfStatusesToDelete as $wfStatusRemoved) {
            $wfStatusRemoved->setWfMaster(null);
        }

        $this->collWfStatuses = null;
        foreach ($wfStatuses as $wfStatus) {
            $this->addWfStatus($wfStatus);
        }

        $this->collWfStatuses = $wfStatuses;
        $this->collWfStatusesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related WfStatus objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related WfStatus objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countWfStatuses(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collWfStatusesPartial && !$this->isNew();
        if (null === $this->collWfStatuses || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collWfStatuses) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getWfStatuses());
            }

            $query = ChildWfStatusQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByWfMaster($this)
                ->count($con);
        }

        return count($this->collWfStatuses);
    }

    /**
     * Method called to associate a ChildWfStatus object to this object
     * through the ChildWfStatus foreign key attribute.
     *
     * @param ChildWfStatus $l ChildWfStatus
     * @return $this The current object (for fluent API support)
     */
    public function addWfStatus(ChildWfStatus $l)
    {
        if ($this->collWfStatuses === null) {
            $this->initWfStatuses();
            $this->collWfStatusesPartial = true;
        }

        if (!$this->collWfStatuses->contains($l)) {
            $this->doAddWfStatus($l);

            if ($this->wfStatusesScheduledForDeletion and $this->wfStatusesScheduledForDeletion->contains($l)) {
                $this->wfStatusesScheduledForDeletion->remove($this->wfStatusesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildWfStatus $wfStatus The ChildWfStatus object to add.
     */
    protected function doAddWfStatus(ChildWfStatus $wfStatus): void
    {
        $this->collWfStatuses[]= $wfStatus;
        $wfStatus->setWfMaster($this);
    }

    /**
     * @param ChildWfStatus $wfStatus The ChildWfStatus object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeWfStatus(ChildWfStatus $wfStatus)
    {
        if ($this->getWfStatuses()->contains($wfStatus)) {
            $pos = $this->collWfStatuses->search($wfStatus);
            $this->collWfStatuses->remove($pos);
            if (null === $this->wfStatusesScheduledForDeletion) {
                $this->wfStatusesScheduledForDeletion = clone $this->collWfStatuses;
                $this->wfStatusesScheduledForDeletion->clear();
            }
            $this->wfStatusesScheduledForDeletion[]= clone $wfStatus;
            $wfStatus->setWfMaster(null);
        }

        return $this;
    }

    /**
     * Clears out the collWfStepss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addWfStepss()
     */
    public function clearWfStepss()
    {
        $this->collWfStepss = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collWfStepss collection loaded partially.
     *
     * @return void
     */
    public function resetPartialWfStepss($v = true): void
    {
        $this->collWfStepssPartial = $v;
    }

    /**
     * Initializes the collWfStepss collection.
     *
     * By default this just sets the collWfStepss collection to an empty array (like clearcollWfStepss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initWfStepss(bool $overrideExisting = true): void
    {
        if (null !== $this->collWfStepss && !$overrideExisting) {
            return;
        }

        $collectionClassName = WfStepsTableMap::getTableMap()->getCollectionClassName();

        $this->collWfStepss = new $collectionClassName;
        $this->collWfStepss->setModel('\entities\WfSteps');
    }

    /**
     * Gets an array of ChildWfSteps objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildWfMaster is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildWfSteps[] List of ChildWfSteps objects
     * @phpstan-return ObjectCollection&\Traversable<ChildWfSteps> List of ChildWfSteps objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getWfStepss(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collWfStepssPartial && !$this->isNew();
        if (null === $this->collWfStepss || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collWfStepss) {
                    $this->initWfStepss();
                } else {
                    $collectionClassName = WfStepsTableMap::getTableMap()->getCollectionClassName();

                    $collWfStepss = new $collectionClassName;
                    $collWfStepss->setModel('\entities\WfSteps');

                    return $collWfStepss;
                }
            } else {
                $collWfStepss = ChildWfStepsQuery::create(null, $criteria)
                    ->filterByWfMaster($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collWfStepssPartial && count($collWfStepss)) {
                        $this->initWfStepss(false);

                        foreach ($collWfStepss as $obj) {
                            if (false == $this->collWfStepss->contains($obj)) {
                                $this->collWfStepss->append($obj);
                            }
                        }

                        $this->collWfStepssPartial = true;
                    }

                    return $collWfStepss;
                }

                if ($partial && $this->collWfStepss) {
                    foreach ($this->collWfStepss as $obj) {
                        if ($obj->isNew()) {
                            $collWfStepss[] = $obj;
                        }
                    }
                }

                $this->collWfStepss = $collWfStepss;
                $this->collWfStepssPartial = false;
            }
        }

        return $this->collWfStepss;
    }

    /**
     * Sets a collection of ChildWfSteps objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $wfStepss A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setWfStepss(Collection $wfStepss, ?ConnectionInterface $con = null)
    {
        /** @var ChildWfSteps[] $wfStepssToDelete */
        $wfStepssToDelete = $this->getWfStepss(new Criteria(), $con)->diff($wfStepss);


        $this->wfStepssScheduledForDeletion = $wfStepssToDelete;

        foreach ($wfStepssToDelete as $wfStepsRemoved) {
            $wfStepsRemoved->setWfMaster(null);
        }

        $this->collWfStepss = null;
        foreach ($wfStepss as $wfSteps) {
            $this->addWfSteps($wfSteps);
        }

        $this->collWfStepss = $wfStepss;
        $this->collWfStepssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related WfSteps objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related WfSteps objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countWfStepss(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collWfStepssPartial && !$this->isNew();
        if (null === $this->collWfStepss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collWfStepss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getWfStepss());
            }

            $query = ChildWfStepsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByWfMaster($this)
                ->count($con);
        }

        return count($this->collWfStepss);
    }

    /**
     * Method called to associate a ChildWfSteps object to this object
     * through the ChildWfSteps foreign key attribute.
     *
     * @param ChildWfSteps $l ChildWfSteps
     * @return $this The current object (for fluent API support)
     */
    public function addWfSteps(ChildWfSteps $l)
    {
        if ($this->collWfStepss === null) {
            $this->initWfStepss();
            $this->collWfStepssPartial = true;
        }

        if (!$this->collWfStepss->contains($l)) {
            $this->doAddWfSteps($l);

            if ($this->wfStepssScheduledForDeletion and $this->wfStepssScheduledForDeletion->contains($l)) {
                $this->wfStepssScheduledForDeletion->remove($this->wfStepssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildWfSteps $wfSteps The ChildWfSteps object to add.
     */
    protected function doAddWfSteps(ChildWfSteps $wfSteps): void
    {
        $this->collWfStepss[]= $wfSteps;
        $wfSteps->setWfMaster($this);
    }

    /**
     * @param ChildWfSteps $wfSteps The ChildWfSteps object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeWfSteps(ChildWfSteps $wfSteps)
    {
        if ($this->getWfStepss()->contains($wfSteps)) {
            $pos = $this->collWfStepss->search($wfSteps);
            $this->collWfStepss->remove($pos);
            if (null === $this->wfStepssScheduledForDeletion) {
                $this->wfStepssScheduledForDeletion = clone $this->collWfStepss;
                $this->wfStepssScheduledForDeletion->clear();
            }
            $this->wfStepssScheduledForDeletion[]= clone $wfSteps;
            $wfSteps->setWfMaster(null);
        }

        return $this;
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
        $this->wf_id = null;
        $this->wf_name = null;
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
            if ($this->collWfDocumentss) {
                foreach ($this->collWfDocumentss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collWfRequestss) {
                foreach ($this->collWfRequestss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collWfStatuses) {
                foreach ($this->collWfStatuses as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collWfStepss) {
                foreach ($this->collWfStepss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collWfDocumentss = null;
        $this->collWfRequestss = null;
        $this->collWfStatuses = null;
        $this->collWfStepss = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(WfMasterTableMap::DEFAULT_STRING_FORMAT);
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
