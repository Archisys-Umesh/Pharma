<?php

namespace entities\Base;

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
use entities\BeatCorrectionQuery as ChildBeatCorrectionQuery;
use entities\Map\BeatCorrectionTableMap;

/**
 * Base class that represents a row from the 'beat_correction' table.
 *
 *
 *
 * @package    propel.generator.entities.Base
 */
abstract class BeatCorrection implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\entities\\Map\\BeatCorrectionTableMap';


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
     * The value for the on_board_request_address_id field.
     *
     * @var        int
     */
    protected $on_board_request_address_id;

    /**
     * The value for the territory field.
     *
     * @var        int|null
     */
    protected $territory;

    /**
     * The value for the obra_unit_name field.
     *
     * @var        string|null
     */
    protected $obra_unit_name;

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
     * The value for the address field.
     *
     * @var        string|null
     */
    protected $address;

    /**
     * The value for the beat_unit_name field.
     *
     * @var        string|null
     */
    protected $beat_unit_name;

    /**
     * The value for the beat_name field.
     *
     * @var        string|null
     */
    protected $beat_name;

    /**
     * The value for the beat_options field.
     *
     * @var        string|null
     */
    protected $beat_options;

    /**
     * The value for the correct_beat_name field.
     *
     * @var        string|null
     */
    protected $correct_beat_name;

    /**
     * The value for the status field.
     *
     * @var        int|null
     */
    protected $status;

    /**
     * The value for the beat_org_unit_id field.
     *
     * @var        int|null
     */
    protected $beat_org_unit_id;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * Initializes internal state of entities\Base\BeatCorrection object.
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
     * Compares this with another <code>BeatCorrection</code> instance.  If
     * <code>obj</code> is an instance of <code>BeatCorrection</code>, delegates to
     * <code>equals(BeatCorrection)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [on_board_request_address_id] column value.
     *
     * @return int
     */
    public function getOnBoardRequestAddressId()
    {
        return $this->on_board_request_address_id;
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
     * Get the [obra_unit_name] column value.
     *
     * @return string|null
     */
    public function getObraUnitName()
    {
        return $this->obra_unit_name;
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
     * Get the [address] column value.
     *
     * @return string|null
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Get the [beat_unit_name] column value.
     *
     * @return string|null
     */
    public function getBeatUnitName()
    {
        return $this->beat_unit_name;
    }

    /**
     * Get the [beat_name] column value.
     *
     * @return string|null
     */
    public function getBeatName()
    {
        return $this->beat_name;
    }

    /**
     * Get the [beat_options] column value.
     *
     * @return string|null
     */
    public function getBeatOptions()
    {
        return $this->beat_options;
    }

    /**
     * Get the [correct_beat_name] column value.
     *
     * @return string|null
     */
    public function getCorrectBeatName()
    {
        return $this->correct_beat_name;
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
     * Get the [beat_org_unit_id] column value.
     *
     * @return int|null
     */
    public function getBeatOrgUnitId()
    {
        return $this->beat_org_unit_id;
    }

    /**
     * Set the value of [on_board_request_address_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOnBoardRequestAddressId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->on_board_request_address_id !== $v) {
            $this->on_board_request_address_id = $v;
            $this->modifiedColumns[BeatCorrectionTableMap::COL_ON_BOARD_REQUEST_ADDRESS_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [territory] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setTerritory($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->territory !== $v) {
            $this->territory = $v;
            $this->modifiedColumns[BeatCorrectionTableMap::COL_TERRITORY] = true;
        }

        return $this;
    }

    /**
     * Set the value of [obra_unit_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setObraUnitName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->obra_unit_name !== $v) {
            $this->obra_unit_name = $v;
            $this->modifiedColumns[BeatCorrectionTableMap::COL_OBRA_UNIT_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [first_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFirstName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->first_name !== $v) {
            $this->first_name = $v;
            $this->modifiedColumns[BeatCorrectionTableMap::COL_FIRST_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [last_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setLastName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->last_name !== $v) {
            $this->last_name = $v;
            $this->modifiedColumns[BeatCorrectionTableMap::COL_LAST_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [address] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setAddress($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->address !== $v) {
            $this->address = $v;
            $this->modifiedColumns[BeatCorrectionTableMap::COL_ADDRESS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [beat_unit_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setBeatUnitName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->beat_unit_name !== $v) {
            $this->beat_unit_name = $v;
            $this->modifiedColumns[BeatCorrectionTableMap::COL_BEAT_UNIT_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [beat_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setBeatName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->beat_name !== $v) {
            $this->beat_name = $v;
            $this->modifiedColumns[BeatCorrectionTableMap::COL_BEAT_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [beat_options] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setBeatOptions($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->beat_options !== $v) {
            $this->beat_options = $v;
            $this->modifiedColumns[BeatCorrectionTableMap::COL_BEAT_OPTIONS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [correct_beat_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCorrectBeatName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->correct_beat_name !== $v) {
            $this->correct_beat_name = $v;
            $this->modifiedColumns[BeatCorrectionTableMap::COL_CORRECT_BEAT_NAME] = true;
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
            $this->modifiedColumns[BeatCorrectionTableMap::COL_STATUS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [beat_org_unit_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setBeatOrgUnitId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->beat_org_unit_id !== $v) {
            $this->beat_org_unit_id = $v;
            $this->modifiedColumns[BeatCorrectionTableMap::COL_BEAT_ORG_UNIT_ID] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : BeatCorrectionTableMap::translateFieldName('OnBoardRequestAddressId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->on_board_request_address_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : BeatCorrectionTableMap::translateFieldName('Territory', TableMap::TYPE_PHPNAME, $indexType)];
            $this->territory = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : BeatCorrectionTableMap::translateFieldName('ObraUnitName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->obra_unit_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : BeatCorrectionTableMap::translateFieldName('FirstName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->first_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : BeatCorrectionTableMap::translateFieldName('LastName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->last_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : BeatCorrectionTableMap::translateFieldName('Address', TableMap::TYPE_PHPNAME, $indexType)];
            $this->address = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : BeatCorrectionTableMap::translateFieldName('BeatUnitName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->beat_unit_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : BeatCorrectionTableMap::translateFieldName('BeatName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->beat_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : BeatCorrectionTableMap::translateFieldName('BeatOptions', TableMap::TYPE_PHPNAME, $indexType)];
            $this->beat_options = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : BeatCorrectionTableMap::translateFieldName('CorrectBeatName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->correct_beat_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : BeatCorrectionTableMap::translateFieldName('Status', TableMap::TYPE_PHPNAME, $indexType)];
            $this->status = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : BeatCorrectionTableMap::translateFieldName('BeatOrgUnitId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->beat_org_unit_id = (null !== $col) ? (int) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 12; // 12 = BeatCorrectionTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\entities\\BeatCorrection'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(BeatCorrectionTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildBeatCorrectionQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see BeatCorrection::setDeleted()
     * @see BeatCorrection::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(BeatCorrectionTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildBeatCorrectionQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(BeatCorrectionTableMap::DATABASE_NAME);
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
                BeatCorrectionTableMap::addInstanceToPool($this);
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


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(BeatCorrectionTableMap::COL_ON_BOARD_REQUEST_ADDRESS_ID)) {
            $modifiedColumns[':p' . $index++]  = 'on_board_request_address_id';
        }
        if ($this->isColumnModified(BeatCorrectionTableMap::COL_TERRITORY)) {
            $modifiedColumns[':p' . $index++]  = 'territory';
        }
        if ($this->isColumnModified(BeatCorrectionTableMap::COL_OBRA_UNIT_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'obra_unit_name';
        }
        if ($this->isColumnModified(BeatCorrectionTableMap::COL_FIRST_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'first_name';
        }
        if ($this->isColumnModified(BeatCorrectionTableMap::COL_LAST_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'last_name';
        }
        if ($this->isColumnModified(BeatCorrectionTableMap::COL_ADDRESS)) {
            $modifiedColumns[':p' . $index++]  = 'address';
        }
        if ($this->isColumnModified(BeatCorrectionTableMap::COL_BEAT_UNIT_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'beat_unit_name';
        }
        if ($this->isColumnModified(BeatCorrectionTableMap::COL_BEAT_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'beat_name';
        }
        if ($this->isColumnModified(BeatCorrectionTableMap::COL_BEAT_OPTIONS)) {
            $modifiedColumns[':p' . $index++]  = 'beat_options';
        }
        if ($this->isColumnModified(BeatCorrectionTableMap::COL_CORRECT_BEAT_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'correct_beat_name';
        }
        if ($this->isColumnModified(BeatCorrectionTableMap::COL_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'status';
        }
        if ($this->isColumnModified(BeatCorrectionTableMap::COL_BEAT_ORG_UNIT_ID)) {
            $modifiedColumns[':p' . $index++]  = 'beat_org_unit_id';
        }

        $sql = sprintf(
            'INSERT INTO beat_correction (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'on_board_request_address_id':
                        $stmt->bindValue($identifier, $this->on_board_request_address_id, PDO::PARAM_INT);

                        break;
                    case 'territory':
                        $stmt->bindValue($identifier, $this->territory, PDO::PARAM_INT);

                        break;
                    case 'obra_unit_name':
                        $stmt->bindValue($identifier, $this->obra_unit_name, PDO::PARAM_STR);

                        break;
                    case 'first_name':
                        $stmt->bindValue($identifier, $this->first_name, PDO::PARAM_STR);

                        break;
                    case 'last_name':
                        $stmt->bindValue($identifier, $this->last_name, PDO::PARAM_STR);

                        break;
                    case 'address':
                        $stmt->bindValue($identifier, $this->address, PDO::PARAM_STR);

                        break;
                    case 'beat_unit_name':
                        $stmt->bindValue($identifier, $this->beat_unit_name, PDO::PARAM_STR);

                        break;
                    case 'beat_name':
                        $stmt->bindValue($identifier, $this->beat_name, PDO::PARAM_STR);

                        break;
                    case 'beat_options':
                        $stmt->bindValue($identifier, $this->beat_options, PDO::PARAM_STR);

                        break;
                    case 'correct_beat_name':
                        $stmt->bindValue($identifier, $this->correct_beat_name, PDO::PARAM_STR);

                        break;
                    case 'status':
                        $stmt->bindValue($identifier, $this->status, PDO::PARAM_INT);

                        break;
                    case 'beat_org_unit_id':
                        $stmt->bindValue($identifier, $this->beat_org_unit_id, PDO::PARAM_INT);

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
        $pos = BeatCorrectionTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getOnBoardRequestAddressId();

            case 1:
                return $this->getTerritory();

            case 2:
                return $this->getObraUnitName();

            case 3:
                return $this->getFirstName();

            case 4:
                return $this->getLastName();

            case 5:
                return $this->getAddress();

            case 6:
                return $this->getBeatUnitName();

            case 7:
                return $this->getBeatName();

            case 8:
                return $this->getBeatOptions();

            case 9:
                return $this->getCorrectBeatName();

            case 10:
                return $this->getStatus();

            case 11:
                return $this->getBeatOrgUnitId();

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
        if (isset($alreadyDumpedObjects['BeatCorrection'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['BeatCorrection'][$this->hashCode()] = true;
        $keys = BeatCorrectionTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getOnBoardRequestAddressId(),
            $keys[1] => $this->getTerritory(),
            $keys[2] => $this->getObraUnitName(),
            $keys[3] => $this->getFirstName(),
            $keys[4] => $this->getLastName(),
            $keys[5] => $this->getAddress(),
            $keys[6] => $this->getBeatUnitName(),
            $keys[7] => $this->getBeatName(),
            $keys[8] => $this->getBeatOptions(),
            $keys[9] => $this->getCorrectBeatName(),
            $keys[10] => $this->getStatus(),
            $keys[11] => $this->getBeatOrgUnitId(),
        ];
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
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
        $pos = BeatCorrectionTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setOnBoardRequestAddressId($value);
                break;
            case 1:
                $this->setTerritory($value);
                break;
            case 2:
                $this->setObraUnitName($value);
                break;
            case 3:
                $this->setFirstName($value);
                break;
            case 4:
                $this->setLastName($value);
                break;
            case 5:
                $this->setAddress($value);
                break;
            case 6:
                $this->setBeatUnitName($value);
                break;
            case 7:
                $this->setBeatName($value);
                break;
            case 8:
                $this->setBeatOptions($value);
                break;
            case 9:
                $this->setCorrectBeatName($value);
                break;
            case 10:
                $this->setStatus($value);
                break;
            case 11:
                $this->setBeatOrgUnitId($value);
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
        $keys = BeatCorrectionTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setOnBoardRequestAddressId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setTerritory($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setObraUnitName($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setFirstName($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setLastName($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setAddress($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setBeatUnitName($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setBeatName($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setBeatOptions($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setCorrectBeatName($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setStatus($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setBeatOrgUnitId($arr[$keys[11]]);
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
        $criteria = new Criteria(BeatCorrectionTableMap::DATABASE_NAME);

        if ($this->isColumnModified(BeatCorrectionTableMap::COL_ON_BOARD_REQUEST_ADDRESS_ID)) {
            $criteria->add(BeatCorrectionTableMap::COL_ON_BOARD_REQUEST_ADDRESS_ID, $this->on_board_request_address_id);
        }
        if ($this->isColumnModified(BeatCorrectionTableMap::COL_TERRITORY)) {
            $criteria->add(BeatCorrectionTableMap::COL_TERRITORY, $this->territory);
        }
        if ($this->isColumnModified(BeatCorrectionTableMap::COL_OBRA_UNIT_NAME)) {
            $criteria->add(BeatCorrectionTableMap::COL_OBRA_UNIT_NAME, $this->obra_unit_name);
        }
        if ($this->isColumnModified(BeatCorrectionTableMap::COL_FIRST_NAME)) {
            $criteria->add(BeatCorrectionTableMap::COL_FIRST_NAME, $this->first_name);
        }
        if ($this->isColumnModified(BeatCorrectionTableMap::COL_LAST_NAME)) {
            $criteria->add(BeatCorrectionTableMap::COL_LAST_NAME, $this->last_name);
        }
        if ($this->isColumnModified(BeatCorrectionTableMap::COL_ADDRESS)) {
            $criteria->add(BeatCorrectionTableMap::COL_ADDRESS, $this->address);
        }
        if ($this->isColumnModified(BeatCorrectionTableMap::COL_BEAT_UNIT_NAME)) {
            $criteria->add(BeatCorrectionTableMap::COL_BEAT_UNIT_NAME, $this->beat_unit_name);
        }
        if ($this->isColumnModified(BeatCorrectionTableMap::COL_BEAT_NAME)) {
            $criteria->add(BeatCorrectionTableMap::COL_BEAT_NAME, $this->beat_name);
        }
        if ($this->isColumnModified(BeatCorrectionTableMap::COL_BEAT_OPTIONS)) {
            $criteria->add(BeatCorrectionTableMap::COL_BEAT_OPTIONS, $this->beat_options);
        }
        if ($this->isColumnModified(BeatCorrectionTableMap::COL_CORRECT_BEAT_NAME)) {
            $criteria->add(BeatCorrectionTableMap::COL_CORRECT_BEAT_NAME, $this->correct_beat_name);
        }
        if ($this->isColumnModified(BeatCorrectionTableMap::COL_STATUS)) {
            $criteria->add(BeatCorrectionTableMap::COL_STATUS, $this->status);
        }
        if ($this->isColumnModified(BeatCorrectionTableMap::COL_BEAT_ORG_UNIT_ID)) {
            $criteria->add(BeatCorrectionTableMap::COL_BEAT_ORG_UNIT_ID, $this->beat_org_unit_id);
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
        $criteria = ChildBeatCorrectionQuery::create();
        $criteria->add(BeatCorrectionTableMap::COL_ON_BOARD_REQUEST_ADDRESS_ID, $this->on_board_request_address_id);

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
        $validPk = null !== $this->getOnBoardRequestAddressId();

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
        return $this->getOnBoardRequestAddressId();
    }

    /**
     * Generic method to set the primary key (on_board_request_address_id column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setOnBoardRequestAddressId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getOnBoardRequestAddressId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \entities\BeatCorrection (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setOnBoardRequestAddressId($this->getOnBoardRequestAddressId());
        $copyObj->setTerritory($this->getTerritory());
        $copyObj->setObraUnitName($this->getObraUnitName());
        $copyObj->setFirstName($this->getFirstName());
        $copyObj->setLastName($this->getLastName());
        $copyObj->setAddress($this->getAddress());
        $copyObj->setBeatUnitName($this->getBeatUnitName());
        $copyObj->setBeatName($this->getBeatName());
        $copyObj->setBeatOptions($this->getBeatOptions());
        $copyObj->setCorrectBeatName($this->getCorrectBeatName());
        $copyObj->setStatus($this->getStatus());
        $copyObj->setBeatOrgUnitId($this->getBeatOrgUnitId());
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
     * @return \entities\BeatCorrection Clone of current object.
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
        $this->on_board_request_address_id = null;
        $this->territory = null;
        $this->obra_unit_name = null;
        $this->first_name = null;
        $this->last_name = null;
        $this->address = null;
        $this->beat_unit_name = null;
        $this->beat_name = null;
        $this->beat_options = null;
        $this->correct_beat_name = null;
        $this->status = null;
        $this->beat_org_unit_id = null;
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
        return (string) $this->exportTo(BeatCorrectionTableMap::DEFAULT_STRING_FORMAT);
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
