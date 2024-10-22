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
use entities\Currencies as ChildCurrencies;
use entities\CurrenciesQuery as ChildCurrenciesQuery;
use entities\GeoCity as ChildGeoCity;
use entities\GeoCityQuery as ChildGeoCityQuery;
use entities\GeoCountry as ChildGeoCountry;
use entities\GeoCountryQuery as ChildGeoCountryQuery;
use entities\GeoState as ChildGeoState;
use entities\GeoStateQuery as ChildGeoStateQuery;
use entities\OrgUnit as ChildOrgUnit;
use entities\OrgUnitQuery as ChildOrgUnitQuery;
use entities\Map\GeoCityTableMap;
use entities\Map\GeoCountryTableMap;
use entities\Map\GeoStateTableMap;
use entities\Map\OrgUnitTableMap;

/**
 * Base class that represents a row from the 'geo_country' table.
 *
 *
 *
 * @package    propel.generator.entities.Base
 */
abstract class GeoCountry implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\entities\\Map\\GeoCountryTableMap';


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
     * The value for the icountryid field.
     *
     * @var        int
     */
    protected $icountryid;

    /**
     * The value for the scountry field.
     *
     * @var        string
     */
    protected $scountry;

    /**
     * The value for the scurrency field.
     *
     * @var        int|null
     */
    protected $scurrency;

    /**
     * The value for the drate field.
     *
     * Note: this column has a database default value of: '0.00'
     * @var        string|null
     */
    protected $drate;

    /**
     * The value for the code field.
     *
     * Note: this column has a database default value of: '0.00'
     * @var        string|null
     */
    protected $code;

    /**
     * @var        ChildCurrencies
     */
    protected $aCurrencies;

    /**
     * @var        ObjectCollection|ChildGeoCity[] Collection to store aggregation of ChildGeoCity objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildGeoCity> Collection to store aggregation of ChildGeoCity objects.
     */
    protected $collGeoCities;
    protected $collGeoCitiesPartial;

    /**
     * @var        ObjectCollection|ChildGeoState[] Collection to store aggregation of ChildGeoState objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildGeoState> Collection to store aggregation of ChildGeoState objects.
     */
    protected $collGeoStates;
    protected $collGeoStatesPartial;

    /**
     * @var        ObjectCollection|ChildOrgUnit[] Collection to store aggregation of ChildOrgUnit objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildOrgUnit> Collection to store aggregation of ChildOrgUnit objects.
     */
    protected $collOrgUnits;
    protected $collOrgUnitsPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildGeoCity[]
     * @phpstan-var ObjectCollection&\Traversable<ChildGeoCity>
     */
    protected $geoCitiesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildGeoState[]
     * @phpstan-var ObjectCollection&\Traversable<ChildGeoState>
     */
    protected $geoStatesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildOrgUnit[]
     * @phpstan-var ObjectCollection&\Traversable<ChildOrgUnit>
     */
    protected $orgUnitsScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues(): void
    {
        $this->drate = '0.00';
        $this->code = '0.00';
    }

    /**
     * Initializes internal state of entities\Base\GeoCountry object.
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
     * Compares this with another <code>GeoCountry</code> instance.  If
     * <code>obj</code> is an instance of <code>GeoCountry</code>, delegates to
     * <code>equals(GeoCountry)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [icountryid] column value.
     *
     * @return int
     */
    public function getIcountryid()
    {
        return $this->icountryid;
    }

    /**
     * Get the [scountry] column value.
     *
     * @return string
     */
    public function getScountry()
    {
        return $this->scountry;
    }

    /**
     * Get the [scurrency] column value.
     *
     * @return int|null
     */
    public function getScurrency()
    {
        return $this->scurrency;
    }

    /**
     * Get the [drate] column value.
     *
     * @return string|null
     */
    public function getDrate()
    {
        return $this->drate;
    }

    /**
     * Get the [code] column value.
     *
     * @return string|null
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set the value of [icountryid] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIcountryid($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->icountryid !== $v) {
            $this->icountryid = $v;
            $this->modifiedColumns[GeoCountryTableMap::COL_ICOUNTRYID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [scountry] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setScountry($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->scountry !== $v) {
            $this->scountry = $v;
            $this->modifiedColumns[GeoCountryTableMap::COL_SCOUNTRY] = true;
        }

        return $this;
    }

    /**
     * Set the value of [scurrency] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setScurrency($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->scurrency !== $v) {
            $this->scurrency = $v;
            $this->modifiedColumns[GeoCountryTableMap::COL_SCURRENCY] = true;
        }

        if ($this->aCurrencies !== null && $this->aCurrencies->getCurrencyId() !== $v) {
            $this->aCurrencies = null;
        }

        return $this;
    }

    /**
     * Set the value of [drate] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setDrate($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->drate !== $v) {
            $this->drate = $v;
            $this->modifiedColumns[GeoCountryTableMap::COL_DRATE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [code] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->code !== $v) {
            $this->code = $v;
            $this->modifiedColumns[GeoCountryTableMap::COL_CODE] = true;
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
            if ($this->drate !== '0.00') {
                return false;
            }

            if ($this->code !== '0.00') {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : GeoCountryTableMap::translateFieldName('Icountryid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->icountryid = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : GeoCountryTableMap::translateFieldName('Scountry', TableMap::TYPE_PHPNAME, $indexType)];
            $this->scountry = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : GeoCountryTableMap::translateFieldName('Scurrency', TableMap::TYPE_PHPNAME, $indexType)];
            $this->scurrency = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : GeoCountryTableMap::translateFieldName('Drate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->drate = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : GeoCountryTableMap::translateFieldName('Code', TableMap::TYPE_PHPNAME, $indexType)];
            $this->code = (null !== $col) ? (string) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 5; // 5 = GeoCountryTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\entities\\GeoCountry'), 0, $e);
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
        if ($this->aCurrencies !== null && $this->scurrency !== $this->aCurrencies->getCurrencyId()) {
            $this->aCurrencies = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(GeoCountryTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildGeoCountryQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aCurrencies = null;
            $this->collGeoCities = null;

            $this->collGeoStates = null;

            $this->collOrgUnits = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see GeoCountry::setDeleted()
     * @see GeoCountry::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(GeoCountryTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildGeoCountryQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(GeoCountryTableMap::DATABASE_NAME);
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
                GeoCountryTableMap::addInstanceToPool($this);
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

            if ($this->aCurrencies !== null) {
                if ($this->aCurrencies->isModified() || $this->aCurrencies->isNew()) {
                    $affectedRows += $this->aCurrencies->save($con);
                }
                $this->setCurrencies($this->aCurrencies);
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

            if ($this->geoCitiesScheduledForDeletion !== null) {
                if (!$this->geoCitiesScheduledForDeletion->isEmpty()) {
                    foreach ($this->geoCitiesScheduledForDeletion as $geoCity) {
                        // need to save related object because we set the relation to null
                        $geoCity->save($con);
                    }
                    $this->geoCitiesScheduledForDeletion = null;
                }
            }

            if ($this->collGeoCities !== null) {
                foreach ($this->collGeoCities as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->geoStatesScheduledForDeletion !== null) {
                if (!$this->geoStatesScheduledForDeletion->isEmpty()) {
                    foreach ($this->geoStatesScheduledForDeletion as $geoState) {
                        // need to save related object because we set the relation to null
                        $geoState->save($con);
                    }
                    $this->geoStatesScheduledForDeletion = null;
                }
            }

            if ($this->collGeoStates !== null) {
                foreach ($this->collGeoStates as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->orgUnitsScheduledForDeletion !== null) {
                if (!$this->orgUnitsScheduledForDeletion->isEmpty()) {
                    \entities\OrgUnitQuery::create()
                        ->filterByPrimaryKeys($this->orgUnitsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->orgUnitsScheduledForDeletion = null;
                }
            }

            if ($this->collOrgUnits !== null) {
                foreach ($this->collOrgUnits as $referrerFK) {
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

        $this->modifiedColumns[GeoCountryTableMap::COL_ICOUNTRYID] = true;
        if (null !== $this->icountryid) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . GeoCountryTableMap::COL_ICOUNTRYID . ')');
        }
        if (null === $this->icountryid) {
            try {
                $dataFetcher = $con->query("SELECT nextval('geo_country_icountryid_seq')");
                $this->icountryid = (int) $dataFetcher->fetchColumn();
            } catch (Exception $e) {
                throw new PropelException('Unable to get sequence id.', 0, $e);
            }
        }


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(GeoCountryTableMap::COL_ICOUNTRYID)) {
            $modifiedColumns[':p' . $index++]  = 'icountryid';
        }
        if ($this->isColumnModified(GeoCountryTableMap::COL_SCOUNTRY)) {
            $modifiedColumns[':p' . $index++]  = 'scountry';
        }
        if ($this->isColumnModified(GeoCountryTableMap::COL_SCURRENCY)) {
            $modifiedColumns[':p' . $index++]  = 'scurrency';
        }
        if ($this->isColumnModified(GeoCountryTableMap::COL_DRATE)) {
            $modifiedColumns[':p' . $index++]  = 'drate';
        }
        if ($this->isColumnModified(GeoCountryTableMap::COL_CODE)) {
            $modifiedColumns[':p' . $index++]  = 'code';
        }

        $sql = sprintf(
            'INSERT INTO geo_country (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'icountryid':
                        $stmt->bindValue($identifier, $this->icountryid, PDO::PARAM_INT);

                        break;
                    case 'scountry':
                        $stmt->bindValue($identifier, $this->scountry, PDO::PARAM_STR);

                        break;
                    case 'scurrency':
                        $stmt->bindValue($identifier, $this->scurrency, PDO::PARAM_INT);

                        break;
                    case 'drate':
                        $stmt->bindValue($identifier, $this->drate, PDO::PARAM_STR);

                        break;
                    case 'code':
                        $stmt->bindValue($identifier, $this->code, PDO::PARAM_STR);

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
        $pos = GeoCountryTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIcountryid();

            case 1:
                return $this->getScountry();

            case 2:
                return $this->getScurrency();

            case 3:
                return $this->getDrate();

            case 4:
                return $this->getCode();

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
        if (isset($alreadyDumpedObjects['GeoCountry'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['GeoCountry'][$this->hashCode()] = true;
        $keys = GeoCountryTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getIcountryid(),
            $keys[1] => $this->getScountry(),
            $keys[2] => $this->getScurrency(),
            $keys[3] => $this->getDrate(),
            $keys[4] => $this->getCode(),
        ];
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aCurrencies) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'currencies';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'currencies';
                        break;
                    default:
                        $key = 'Currencies';
                }

                $result[$key] = $this->aCurrencies->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collGeoCities) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'geoCities';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'geo_cities';
                        break;
                    default:
                        $key = 'GeoCities';
                }

                $result[$key] = $this->collGeoCities->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collGeoStates) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'geoStates';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'geo_states';
                        break;
                    default:
                        $key = 'GeoStates';
                }

                $result[$key] = $this->collGeoStates->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collOrgUnits) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'orgUnits';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'org_units';
                        break;
                    default:
                        $key = 'OrgUnits';
                }

                $result[$key] = $this->collOrgUnits->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = GeoCountryTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setIcountryid($value);
                break;
            case 1:
                $this->setScountry($value);
                break;
            case 2:
                $this->setScurrency($value);
                break;
            case 3:
                $this->setDrate($value);
                break;
            case 4:
                $this->setCode($value);
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
        $keys = GeoCountryTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIcountryid($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setScountry($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setScurrency($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setDrate($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setCode($arr[$keys[4]]);
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
        $criteria = new Criteria(GeoCountryTableMap::DATABASE_NAME);

        if ($this->isColumnModified(GeoCountryTableMap::COL_ICOUNTRYID)) {
            $criteria->add(GeoCountryTableMap::COL_ICOUNTRYID, $this->icountryid);
        }
        if ($this->isColumnModified(GeoCountryTableMap::COL_SCOUNTRY)) {
            $criteria->add(GeoCountryTableMap::COL_SCOUNTRY, $this->scountry);
        }
        if ($this->isColumnModified(GeoCountryTableMap::COL_SCURRENCY)) {
            $criteria->add(GeoCountryTableMap::COL_SCURRENCY, $this->scurrency);
        }
        if ($this->isColumnModified(GeoCountryTableMap::COL_DRATE)) {
            $criteria->add(GeoCountryTableMap::COL_DRATE, $this->drate);
        }
        if ($this->isColumnModified(GeoCountryTableMap::COL_CODE)) {
            $criteria->add(GeoCountryTableMap::COL_CODE, $this->code);
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
        $criteria = ChildGeoCountryQuery::create();
        $criteria->add(GeoCountryTableMap::COL_ICOUNTRYID, $this->icountryid);

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
        $validPk = null !== $this->getIcountryid();

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
        return $this->getIcountryid();
    }

    /**
     * Generic method to set the primary key (icountryid column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setIcountryid($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getIcountryid();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \entities\GeoCountry (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setScountry($this->getScountry());
        $copyObj->setScurrency($this->getScurrency());
        $copyObj->setDrate($this->getDrate());
        $copyObj->setCode($this->getCode());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getGeoCities() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addGeoCity($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getGeoStates() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addGeoState($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getOrgUnits() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOrgUnit($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIcountryid(NULL); // this is a auto-increment column, so set to default value
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
     * @return \entities\GeoCountry Clone of current object.
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
     * Declares an association between this object and a ChildCurrencies object.
     *
     * @param ChildCurrencies|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setCurrencies(ChildCurrencies $v = null)
    {
        if ($v === null) {
            $this->setScurrency(NULL);
        } else {
            $this->setScurrency($v->getCurrencyId());
        }

        $this->aCurrencies = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildCurrencies object, it will not be re-added.
        if ($v !== null) {
            $v->addGeoCountry($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildCurrencies object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildCurrencies|null The associated ChildCurrencies object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getCurrencies(?ConnectionInterface $con = null)
    {
        if ($this->aCurrencies === null && ($this->scurrency != 0)) {
            $this->aCurrencies = ChildCurrenciesQuery::create()->findPk($this->scurrency, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aCurrencies->addGeoCountries($this);
             */
        }

        return $this->aCurrencies;
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
        if ('GeoCity' === $relationName) {
            $this->initGeoCities();
            return;
        }
        if ('GeoState' === $relationName) {
            $this->initGeoStates();
            return;
        }
        if ('OrgUnit' === $relationName) {
            $this->initOrgUnits();
            return;
        }
    }

    /**
     * Clears out the collGeoCities collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addGeoCities()
     */
    public function clearGeoCities()
    {
        $this->collGeoCities = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collGeoCities collection loaded partially.
     *
     * @return void
     */
    public function resetPartialGeoCities($v = true): void
    {
        $this->collGeoCitiesPartial = $v;
    }

    /**
     * Initializes the collGeoCities collection.
     *
     * By default this just sets the collGeoCities collection to an empty array (like clearcollGeoCities());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initGeoCities(bool $overrideExisting = true): void
    {
        if (null !== $this->collGeoCities && !$overrideExisting) {
            return;
        }

        $collectionClassName = GeoCityTableMap::getTableMap()->getCollectionClassName();

        $this->collGeoCities = new $collectionClassName;
        $this->collGeoCities->setModel('\entities\GeoCity');
    }

    /**
     * Gets an array of ChildGeoCity objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildGeoCountry is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildGeoCity[] List of ChildGeoCity objects
     * @phpstan-return ObjectCollection&\Traversable<ChildGeoCity> List of ChildGeoCity objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getGeoCities(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collGeoCitiesPartial && !$this->isNew();
        if (null === $this->collGeoCities || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collGeoCities) {
                    $this->initGeoCities();
                } else {
                    $collectionClassName = GeoCityTableMap::getTableMap()->getCollectionClassName();

                    $collGeoCities = new $collectionClassName;
                    $collGeoCities->setModel('\entities\GeoCity');

                    return $collGeoCities;
                }
            } else {
                $collGeoCities = ChildGeoCityQuery::create(null, $criteria)
                    ->filterByGeoCountry($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collGeoCitiesPartial && count($collGeoCities)) {
                        $this->initGeoCities(false);

                        foreach ($collGeoCities as $obj) {
                            if (false == $this->collGeoCities->contains($obj)) {
                                $this->collGeoCities->append($obj);
                            }
                        }

                        $this->collGeoCitiesPartial = true;
                    }

                    return $collGeoCities;
                }

                if ($partial && $this->collGeoCities) {
                    foreach ($this->collGeoCities as $obj) {
                        if ($obj->isNew()) {
                            $collGeoCities[] = $obj;
                        }
                    }
                }

                $this->collGeoCities = $collGeoCities;
                $this->collGeoCitiesPartial = false;
            }
        }

        return $this->collGeoCities;
    }

    /**
     * Sets a collection of ChildGeoCity objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $geoCities A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setGeoCities(Collection $geoCities, ?ConnectionInterface $con = null)
    {
        /** @var ChildGeoCity[] $geoCitiesToDelete */
        $geoCitiesToDelete = $this->getGeoCities(new Criteria(), $con)->diff($geoCities);


        $this->geoCitiesScheduledForDeletion = $geoCitiesToDelete;

        foreach ($geoCitiesToDelete as $geoCityRemoved) {
            $geoCityRemoved->setGeoCountry(null);
        }

        $this->collGeoCities = null;
        foreach ($geoCities as $geoCity) {
            $this->addGeoCity($geoCity);
        }

        $this->collGeoCities = $geoCities;
        $this->collGeoCitiesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related GeoCity objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related GeoCity objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countGeoCities(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collGeoCitiesPartial && !$this->isNew();
        if (null === $this->collGeoCities || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collGeoCities) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getGeoCities());
            }

            $query = ChildGeoCityQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByGeoCountry($this)
                ->count($con);
        }

        return count($this->collGeoCities);
    }

    /**
     * Method called to associate a ChildGeoCity object to this object
     * through the ChildGeoCity foreign key attribute.
     *
     * @param ChildGeoCity $l ChildGeoCity
     * @return $this The current object (for fluent API support)
     */
    public function addGeoCity(ChildGeoCity $l)
    {
        if ($this->collGeoCities === null) {
            $this->initGeoCities();
            $this->collGeoCitiesPartial = true;
        }

        if (!$this->collGeoCities->contains($l)) {
            $this->doAddGeoCity($l);

            if ($this->geoCitiesScheduledForDeletion and $this->geoCitiesScheduledForDeletion->contains($l)) {
                $this->geoCitiesScheduledForDeletion->remove($this->geoCitiesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildGeoCity $geoCity The ChildGeoCity object to add.
     */
    protected function doAddGeoCity(ChildGeoCity $geoCity): void
    {
        $this->collGeoCities[]= $geoCity;
        $geoCity->setGeoCountry($this);
    }

    /**
     * @param ChildGeoCity $geoCity The ChildGeoCity object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeGeoCity(ChildGeoCity $geoCity)
    {
        if ($this->getGeoCities()->contains($geoCity)) {
            $pos = $this->collGeoCities->search($geoCity);
            $this->collGeoCities->remove($pos);
            if (null === $this->geoCitiesScheduledForDeletion) {
                $this->geoCitiesScheduledForDeletion = clone $this->collGeoCities;
                $this->geoCitiesScheduledForDeletion->clear();
            }
            $this->geoCitiesScheduledForDeletion[]= $geoCity;
            $geoCity->setGeoCountry(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this GeoCountry is new, it will return
     * an empty collection; or if this GeoCountry has previously
     * been saved, it will retrieve related GeoCities from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GeoCountry.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildGeoCity[] List of ChildGeoCity objects
     * @phpstan-return ObjectCollection&\Traversable<ChildGeoCity}> List of ChildGeoCity objects
     */
    public function getGeoCitiesJoinGeoState(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildGeoCityQuery::create(null, $criteria);
        $query->joinWith('GeoState', $joinBehavior);

        return $this->getGeoCities($query, $con);
    }

    /**
     * Clears out the collGeoStates collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addGeoStates()
     */
    public function clearGeoStates()
    {
        $this->collGeoStates = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collGeoStates collection loaded partially.
     *
     * @return void
     */
    public function resetPartialGeoStates($v = true): void
    {
        $this->collGeoStatesPartial = $v;
    }

    /**
     * Initializes the collGeoStates collection.
     *
     * By default this just sets the collGeoStates collection to an empty array (like clearcollGeoStates());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initGeoStates(bool $overrideExisting = true): void
    {
        if (null !== $this->collGeoStates && !$overrideExisting) {
            return;
        }

        $collectionClassName = GeoStateTableMap::getTableMap()->getCollectionClassName();

        $this->collGeoStates = new $collectionClassName;
        $this->collGeoStates->setModel('\entities\GeoState');
    }

    /**
     * Gets an array of ChildGeoState objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildGeoCountry is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildGeoState[] List of ChildGeoState objects
     * @phpstan-return ObjectCollection&\Traversable<ChildGeoState> List of ChildGeoState objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getGeoStates(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collGeoStatesPartial && !$this->isNew();
        if (null === $this->collGeoStates || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collGeoStates) {
                    $this->initGeoStates();
                } else {
                    $collectionClassName = GeoStateTableMap::getTableMap()->getCollectionClassName();

                    $collGeoStates = new $collectionClassName;
                    $collGeoStates->setModel('\entities\GeoState');

                    return $collGeoStates;
                }
            } else {
                $collGeoStates = ChildGeoStateQuery::create(null, $criteria)
                    ->filterByGeoCountry($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collGeoStatesPartial && count($collGeoStates)) {
                        $this->initGeoStates(false);

                        foreach ($collGeoStates as $obj) {
                            if (false == $this->collGeoStates->contains($obj)) {
                                $this->collGeoStates->append($obj);
                            }
                        }

                        $this->collGeoStatesPartial = true;
                    }

                    return $collGeoStates;
                }

                if ($partial && $this->collGeoStates) {
                    foreach ($this->collGeoStates as $obj) {
                        if ($obj->isNew()) {
                            $collGeoStates[] = $obj;
                        }
                    }
                }

                $this->collGeoStates = $collGeoStates;
                $this->collGeoStatesPartial = false;
            }
        }

        return $this->collGeoStates;
    }

    /**
     * Sets a collection of ChildGeoState objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $geoStates A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setGeoStates(Collection $geoStates, ?ConnectionInterface $con = null)
    {
        /** @var ChildGeoState[] $geoStatesToDelete */
        $geoStatesToDelete = $this->getGeoStates(new Criteria(), $con)->diff($geoStates);


        $this->geoStatesScheduledForDeletion = $geoStatesToDelete;

        foreach ($geoStatesToDelete as $geoStateRemoved) {
            $geoStateRemoved->setGeoCountry(null);
        }

        $this->collGeoStates = null;
        foreach ($geoStates as $geoState) {
            $this->addGeoState($geoState);
        }

        $this->collGeoStates = $geoStates;
        $this->collGeoStatesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related GeoState objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related GeoState objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countGeoStates(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collGeoStatesPartial && !$this->isNew();
        if (null === $this->collGeoStates || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collGeoStates) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getGeoStates());
            }

            $query = ChildGeoStateQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByGeoCountry($this)
                ->count($con);
        }

        return count($this->collGeoStates);
    }

    /**
     * Method called to associate a ChildGeoState object to this object
     * through the ChildGeoState foreign key attribute.
     *
     * @param ChildGeoState $l ChildGeoState
     * @return $this The current object (for fluent API support)
     */
    public function addGeoState(ChildGeoState $l)
    {
        if ($this->collGeoStates === null) {
            $this->initGeoStates();
            $this->collGeoStatesPartial = true;
        }

        if (!$this->collGeoStates->contains($l)) {
            $this->doAddGeoState($l);

            if ($this->geoStatesScheduledForDeletion and $this->geoStatesScheduledForDeletion->contains($l)) {
                $this->geoStatesScheduledForDeletion->remove($this->geoStatesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildGeoState $geoState The ChildGeoState object to add.
     */
    protected function doAddGeoState(ChildGeoState $geoState): void
    {
        $this->collGeoStates[]= $geoState;
        $geoState->setGeoCountry($this);
    }

    /**
     * @param ChildGeoState $geoState The ChildGeoState object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeGeoState(ChildGeoState $geoState)
    {
        if ($this->getGeoStates()->contains($geoState)) {
            $pos = $this->collGeoStates->search($geoState);
            $this->collGeoStates->remove($pos);
            if (null === $this->geoStatesScheduledForDeletion) {
                $this->geoStatesScheduledForDeletion = clone $this->collGeoStates;
                $this->geoStatesScheduledForDeletion->clear();
            }
            $this->geoStatesScheduledForDeletion[]= $geoState;
            $geoState->setGeoCountry(null);
        }

        return $this;
    }

    /**
     * Clears out the collOrgUnits collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addOrgUnits()
     */
    public function clearOrgUnits()
    {
        $this->collOrgUnits = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collOrgUnits collection loaded partially.
     *
     * @return void
     */
    public function resetPartialOrgUnits($v = true): void
    {
        $this->collOrgUnitsPartial = $v;
    }

    /**
     * Initializes the collOrgUnits collection.
     *
     * By default this just sets the collOrgUnits collection to an empty array (like clearcollOrgUnits());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initOrgUnits(bool $overrideExisting = true): void
    {
        if (null !== $this->collOrgUnits && !$overrideExisting) {
            return;
        }

        $collectionClassName = OrgUnitTableMap::getTableMap()->getCollectionClassName();

        $this->collOrgUnits = new $collectionClassName;
        $this->collOrgUnits->setModel('\entities\OrgUnit');
    }

    /**
     * Gets an array of ChildOrgUnit objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildGeoCountry is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildOrgUnit[] List of ChildOrgUnit objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrgUnit> List of ChildOrgUnit objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOrgUnits(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collOrgUnitsPartial && !$this->isNew();
        if (null === $this->collOrgUnits || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collOrgUnits) {
                    $this->initOrgUnits();
                } else {
                    $collectionClassName = OrgUnitTableMap::getTableMap()->getCollectionClassName();

                    $collOrgUnits = new $collectionClassName;
                    $collOrgUnits->setModel('\entities\OrgUnit');

                    return $collOrgUnits;
                }
            } else {
                $collOrgUnits = ChildOrgUnitQuery::create(null, $criteria)
                    ->filterByGeoCountry($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collOrgUnitsPartial && count($collOrgUnits)) {
                        $this->initOrgUnits(false);

                        foreach ($collOrgUnits as $obj) {
                            if (false == $this->collOrgUnits->contains($obj)) {
                                $this->collOrgUnits->append($obj);
                            }
                        }

                        $this->collOrgUnitsPartial = true;
                    }

                    return $collOrgUnits;
                }

                if ($partial && $this->collOrgUnits) {
                    foreach ($this->collOrgUnits as $obj) {
                        if ($obj->isNew()) {
                            $collOrgUnits[] = $obj;
                        }
                    }
                }

                $this->collOrgUnits = $collOrgUnits;
                $this->collOrgUnitsPartial = false;
            }
        }

        return $this->collOrgUnits;
    }

    /**
     * Sets a collection of ChildOrgUnit objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $orgUnits A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setOrgUnits(Collection $orgUnits, ?ConnectionInterface $con = null)
    {
        /** @var ChildOrgUnit[] $orgUnitsToDelete */
        $orgUnitsToDelete = $this->getOrgUnits(new Criteria(), $con)->diff($orgUnits);


        $this->orgUnitsScheduledForDeletion = $orgUnitsToDelete;

        foreach ($orgUnitsToDelete as $orgUnitRemoved) {
            $orgUnitRemoved->setGeoCountry(null);
        }

        $this->collOrgUnits = null;
        foreach ($orgUnits as $orgUnit) {
            $this->addOrgUnit($orgUnit);
        }

        $this->collOrgUnits = $orgUnits;
        $this->collOrgUnitsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related OrgUnit objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related OrgUnit objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countOrgUnits(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collOrgUnitsPartial && !$this->isNew();
        if (null === $this->collOrgUnits || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collOrgUnits) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getOrgUnits());
            }

            $query = ChildOrgUnitQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByGeoCountry($this)
                ->count($con);
        }

        return count($this->collOrgUnits);
    }

    /**
     * Method called to associate a ChildOrgUnit object to this object
     * through the ChildOrgUnit foreign key attribute.
     *
     * @param ChildOrgUnit $l ChildOrgUnit
     * @return $this The current object (for fluent API support)
     */
    public function addOrgUnit(ChildOrgUnit $l)
    {
        if ($this->collOrgUnits === null) {
            $this->initOrgUnits();
            $this->collOrgUnitsPartial = true;
        }

        if (!$this->collOrgUnits->contains($l)) {
            $this->doAddOrgUnit($l);

            if ($this->orgUnitsScheduledForDeletion and $this->orgUnitsScheduledForDeletion->contains($l)) {
                $this->orgUnitsScheduledForDeletion->remove($this->orgUnitsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildOrgUnit $orgUnit The ChildOrgUnit object to add.
     */
    protected function doAddOrgUnit(ChildOrgUnit $orgUnit): void
    {
        $this->collOrgUnits[]= $orgUnit;
        $orgUnit->setGeoCountry($this);
    }

    /**
     * @param ChildOrgUnit $orgUnit The ChildOrgUnit object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeOrgUnit(ChildOrgUnit $orgUnit)
    {
        if ($this->getOrgUnits()->contains($orgUnit)) {
            $pos = $this->collOrgUnits->search($orgUnit);
            $this->collOrgUnits->remove($pos);
            if (null === $this->orgUnitsScheduledForDeletion) {
                $this->orgUnitsScheduledForDeletion = clone $this->collOrgUnits;
                $this->orgUnitsScheduledForDeletion->clear();
            }
            $this->orgUnitsScheduledForDeletion[]= clone $orgUnit;
            $orgUnit->setGeoCountry(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this GeoCountry is new, it will return
     * an empty collection; or if this GeoCountry has previously
     * been saved, it will retrieve related OrgUnits from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GeoCountry.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOrgUnit[] List of ChildOrgUnit objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrgUnit}> List of ChildOrgUnit objects
     */
    public function getOrgUnitsJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOrgUnitQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getOrgUnits($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this GeoCountry is new, it will return
     * an empty collection; or if this GeoCountry has previously
     * been saved, it will retrieve related OrgUnits from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in GeoCountry.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOrgUnit[] List of ChildOrgUnit objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrgUnit}> List of ChildOrgUnit objects
     */
    public function getOrgUnitsJoinCurrencies(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOrgUnitQuery::create(null, $criteria);
        $query->joinWith('Currencies', $joinBehavior);

        return $this->getOrgUnits($query, $con);
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
        if (null !== $this->aCurrencies) {
            $this->aCurrencies->removeGeoCountry($this);
        }
        $this->icountryid = null;
        $this->scountry = null;
        $this->scurrency = null;
        $this->drate = null;
        $this->code = null;
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
            if ($this->collGeoCities) {
                foreach ($this->collGeoCities as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collGeoStates) {
                foreach ($this->collGeoStates as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collOrgUnits) {
                foreach ($this->collOrgUnits as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collGeoCities = null;
        $this->collGeoStates = null;
        $this->collOrgUnits = null;
        $this->aCurrencies = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(GeoCountryTableMap::DEFAULT_STRING_FORMAT);
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
