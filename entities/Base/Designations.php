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
use entities\BrandCampiagn as ChildBrandCampiagn;
use entities\BrandCampiagnQuery as ChildBrandCampiagnQuery;
use entities\Company as ChildCompany;
use entities\CompanyQuery as ChildCompanyQuery;
use entities\Designations as ChildDesignations;
use entities\DesignationsQuery as ChildDesignationsQuery;
use entities\Employee as ChildEmployee;
use entities\EmployeeQuery as ChildEmployeeQuery;
use entities\Map\BrandCampiagnTableMap;
use entities\Map\DesignationsTableMap;
use entities\Map\EmployeeTableMap;

/**
 * Base class that represents a row from the 'designations' table.
 *
 *
 *
 * @package    propel.generator.entities.Base
 */
abstract class Designations implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\entities\\Map\\DesignationsTableMap';


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
     * The value for the designation_id field.
     *
     * @var        int
     */
    protected $designation_id;

    /**
     * The value for the designation field.
     *
     * @var        string|null
     */
    protected $designation;

    /**
     * The value for the designation_color field.
     *
     * @var        string|null
     */
    protected $designation_color;

    /**
     * The value for the company_id field.
     *
     * @var        int|null
     */
    protected $company_id;

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
     * @var        ChildCompany
     */
    protected $aCompany;

    /**
     * @var        ObjectCollection|ChildBrandCampiagn[] Collection to store aggregation of ChildBrandCampiagn objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildBrandCampiagn> Collection to store aggregation of ChildBrandCampiagn objects.
     */
    protected $collBrandCampiagns;
    protected $collBrandCampiagnsPartial;

    /**
     * @var        ObjectCollection|ChildEmployee[] Collection to store aggregation of ChildEmployee objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildEmployee> Collection to store aggregation of ChildEmployee objects.
     */
    protected $collEmployees;
    protected $collEmployeesPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildBrandCampiagn[]
     * @phpstan-var ObjectCollection&\Traversable<ChildBrandCampiagn>
     */
    protected $brandCampiagnsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildEmployee[]
     * @phpstan-var ObjectCollection&\Traversable<ChildEmployee>
     */
    protected $employeesScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues(): void
    {
    }

    /**
     * Initializes internal state of entities\Base\Designations object.
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
     * Compares this with another <code>Designations</code> instance.  If
     * <code>obj</code> is an instance of <code>Designations</code>, delegates to
     * <code>equals(Designations)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [designation_id] column value.
     *
     * @return int
     */
    public function getDesignationId()
    {
        return $this->designation_id;
    }

    /**
     * Get the [designation] column value.
     *
     * @return string|null
     */
    public function getDesignation()
    {
        return $this->designation;
    }

    /**
     * Get the [designation_color] column value.
     *
     * @return string|null
     */
    public function getDesignationColor()
    {
        return $this->designation_color;
    }

    /**
     * Get the [company_id] column value.
     *
     * @return int|null
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
     * Set the value of [designation_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setDesignationId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->designation_id !== $v) {
            $this->designation_id = $v;
            $this->modifiedColumns[DesignationsTableMap::COL_DESIGNATION_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [designation] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setDesignation($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->designation !== $v) {
            $this->designation = $v;
            $this->modifiedColumns[DesignationsTableMap::COL_DESIGNATION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [designation_color] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setDesignationColor($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->designation_color !== $v) {
            $this->designation_color = $v;
            $this->modifiedColumns[DesignationsTableMap::COL_DESIGNATION_COLOR] = true;
        }

        return $this;
    }

    /**
     * Set the value of [company_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCompanyId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->company_id !== $v) {
            $this->company_id = $v;
            $this->modifiedColumns[DesignationsTableMap::COL_COMPANY_ID] = true;
        }

        if ($this->aCompany !== null && $this->aCompany->getCompanyId() !== $v) {
            $this->aCompany = null;
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
                $this->modifiedColumns[DesignationsTableMap::COL_CREATED_AT] = true;
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
                $this->modifiedColumns[DesignationsTableMap::COL_UPDATED_AT] = true;
            }
        } // if either are not null

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : DesignationsTableMap::translateFieldName('DesignationId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->designation_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : DesignationsTableMap::translateFieldName('Designation', TableMap::TYPE_PHPNAME, $indexType)];
            $this->designation = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : DesignationsTableMap::translateFieldName('DesignationColor', TableMap::TYPE_PHPNAME, $indexType)];
            $this->designation_color = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : DesignationsTableMap::translateFieldName('CompanyId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->company_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : DesignationsTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : DesignationsTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 6; // 6 = DesignationsTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\entities\\Designations'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(DesignationsTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildDesignationsQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aCompany = null;
            $this->collBrandCampiagns = null;

            $this->collEmployees = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see Designations::setDeleted()
     * @see Designations::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(DesignationsTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildDesignationsQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(DesignationsTableMap::DATABASE_NAME);
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
                DesignationsTableMap::addInstanceToPool($this);
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

            if ($this->brandCampiagnsScheduledForDeletion !== null) {
                if (!$this->brandCampiagnsScheduledForDeletion->isEmpty()) {
                    foreach ($this->brandCampiagnsScheduledForDeletion as $brandCampiagn) {
                        // need to save related object because we set the relation to null
                        $brandCampiagn->save($con);
                    }
                    $this->brandCampiagnsScheduledForDeletion = null;
                }
            }

            if ($this->collBrandCampiagns !== null) {
                foreach ($this->collBrandCampiagns as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->employeesScheduledForDeletion !== null) {
                if (!$this->employeesScheduledForDeletion->isEmpty()) {
                    foreach ($this->employeesScheduledForDeletion as $employee) {
                        // need to save related object because we set the relation to null
                        $employee->save($con);
                    }
                    $this->employeesScheduledForDeletion = null;
                }
            }

            if ($this->collEmployees !== null) {
                foreach ($this->collEmployees as $referrerFK) {
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

        $this->modifiedColumns[DesignationsTableMap::COL_DESIGNATION_ID] = true;
        if (null !== $this->designation_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . DesignationsTableMap::COL_DESIGNATION_ID . ')');
        }
        if (null === $this->designation_id) {
            try {
                $dataFetcher = $con->query("SELECT nextval('designations_designation_id_seq')");
                $this->designation_id = (int) $dataFetcher->fetchColumn();
            } catch (Exception $e) {
                throw new PropelException('Unable to get sequence id.', 0, $e);
            }
        }


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(DesignationsTableMap::COL_DESIGNATION_ID)) {
            $modifiedColumns[':p' . $index++]  = 'designation_id';
        }
        if ($this->isColumnModified(DesignationsTableMap::COL_DESIGNATION)) {
            $modifiedColumns[':p' . $index++]  = 'designation';
        }
        if ($this->isColumnModified(DesignationsTableMap::COL_DESIGNATION_COLOR)) {
            $modifiedColumns[':p' . $index++]  = 'designation_color';
        }
        if ($this->isColumnModified(DesignationsTableMap::COL_COMPANY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'company_id';
        }
        if ($this->isColumnModified(DesignationsTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(DesignationsTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }

        $sql = sprintf(
            'INSERT INTO designations (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'designation_id':
                        $stmt->bindValue($identifier, $this->designation_id, PDO::PARAM_INT);

                        break;
                    case 'designation':
                        $stmt->bindValue($identifier, $this->designation, PDO::PARAM_STR);

                        break;
                    case 'designation_color':
                        $stmt->bindValue($identifier, $this->designation_color, PDO::PARAM_STR);

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
        $pos = DesignationsTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getDesignationId();

            case 1:
                return $this->getDesignation();

            case 2:
                return $this->getDesignationColor();

            case 3:
                return $this->getCompanyId();

            case 4:
                return $this->getCreatedAt();

            case 5:
                return $this->getUpdatedAt();

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
        if (isset($alreadyDumpedObjects['Designations'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['Designations'][$this->hashCode()] = true;
        $keys = DesignationsTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getDesignationId(),
            $keys[1] => $this->getDesignation(),
            $keys[2] => $this->getDesignationColor(),
            $keys[3] => $this->getCompanyId(),
            $keys[4] => $this->getCreatedAt(),
            $keys[5] => $this->getUpdatedAt(),
        ];
        if ($result[$keys[4]] instanceof \DateTimeInterface) {
            $result[$keys[4]] = $result[$keys[4]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[5]] instanceof \DateTimeInterface) {
            $result[$keys[5]] = $result[$keys[5]]->format('Y-m-d H:i:s.u');
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
            if (null !== $this->collBrandCampiagns) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'brandCampiagns';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'brand_campiagns';
                        break;
                    default:
                        $key = 'BrandCampiagns';
                }

                $result[$key] = $this->collBrandCampiagns->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collEmployees) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'employees';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'employees';
                        break;
                    default:
                        $key = 'Employees';
                }

                $result[$key] = $this->collEmployees->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = DesignationsTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setDesignationId($value);
                break;
            case 1:
                $this->setDesignation($value);
                break;
            case 2:
                $this->setDesignationColor($value);
                break;
            case 3:
                $this->setCompanyId($value);
                break;
            case 4:
                $this->setCreatedAt($value);
                break;
            case 5:
                $this->setUpdatedAt($value);
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
        $keys = DesignationsTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setDesignationId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setDesignation($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setDesignationColor($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setCompanyId($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setCreatedAt($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setUpdatedAt($arr[$keys[5]]);
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
        $criteria = new Criteria(DesignationsTableMap::DATABASE_NAME);

        if ($this->isColumnModified(DesignationsTableMap::COL_DESIGNATION_ID)) {
            $criteria->add(DesignationsTableMap::COL_DESIGNATION_ID, $this->designation_id);
        }
        if ($this->isColumnModified(DesignationsTableMap::COL_DESIGNATION)) {
            $criteria->add(DesignationsTableMap::COL_DESIGNATION, $this->designation);
        }
        if ($this->isColumnModified(DesignationsTableMap::COL_DESIGNATION_COLOR)) {
            $criteria->add(DesignationsTableMap::COL_DESIGNATION_COLOR, $this->designation_color);
        }
        if ($this->isColumnModified(DesignationsTableMap::COL_COMPANY_ID)) {
            $criteria->add(DesignationsTableMap::COL_COMPANY_ID, $this->company_id);
        }
        if ($this->isColumnModified(DesignationsTableMap::COL_CREATED_AT)) {
            $criteria->add(DesignationsTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(DesignationsTableMap::COL_UPDATED_AT)) {
            $criteria->add(DesignationsTableMap::COL_UPDATED_AT, $this->updated_at);
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
        $criteria = ChildDesignationsQuery::create();
        $criteria->add(DesignationsTableMap::COL_DESIGNATION_ID, $this->designation_id);

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
        $validPk = null !== $this->getDesignationId();

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
        return $this->getDesignationId();
    }

    /**
     * Generic method to set the primary key (designation_id column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setDesignationId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getDesignationId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \entities\Designations (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setDesignation($this->getDesignation());
        $copyObj->setDesignationColor($this->getDesignationColor());
        $copyObj->setCompanyId($this->getCompanyId());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getBrandCampiagns() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBrandCampiagn($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getEmployees() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addEmployee($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setDesignationId(NULL); // this is a auto-increment column, so set to default value
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
     * @return \entities\Designations Clone of current object.
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
     * @param ChildCompany|null $v
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
            $v->addDesignations($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildCompany object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildCompany|null The associated ChildCompany object.
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
                $this->aCompany->addDesignationss($this);
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
        if ('BrandCampiagn' === $relationName) {
            $this->initBrandCampiagns();
            return;
        }
        if ('Employee' === $relationName) {
            $this->initEmployees();
            return;
        }
    }

    /**
     * Clears out the collBrandCampiagns collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addBrandCampiagns()
     */
    public function clearBrandCampiagns()
    {
        $this->collBrandCampiagns = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collBrandCampiagns collection loaded partially.
     *
     * @return void
     */
    public function resetPartialBrandCampiagns($v = true): void
    {
        $this->collBrandCampiagnsPartial = $v;
    }

    /**
     * Initializes the collBrandCampiagns collection.
     *
     * By default this just sets the collBrandCampiagns collection to an empty array (like clearcollBrandCampiagns());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBrandCampiagns(bool $overrideExisting = true): void
    {
        if (null !== $this->collBrandCampiagns && !$overrideExisting) {
            return;
        }

        $collectionClassName = BrandCampiagnTableMap::getTableMap()->getCollectionClassName();

        $this->collBrandCampiagns = new $collectionClassName;
        $this->collBrandCampiagns->setModel('\entities\BrandCampiagn');
    }

    /**
     * Gets an array of ChildBrandCampiagn objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildDesignations is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildBrandCampiagn[] List of ChildBrandCampiagn objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBrandCampiagn> List of ChildBrandCampiagn objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getBrandCampiagns(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collBrandCampiagnsPartial && !$this->isNew();
        if (null === $this->collBrandCampiagns || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collBrandCampiagns) {
                    $this->initBrandCampiagns();
                } else {
                    $collectionClassName = BrandCampiagnTableMap::getTableMap()->getCollectionClassName();

                    $collBrandCampiagns = new $collectionClassName;
                    $collBrandCampiagns->setModel('\entities\BrandCampiagn');

                    return $collBrandCampiagns;
                }
            } else {
                $collBrandCampiagns = ChildBrandCampiagnQuery::create(null, $criteria)
                    ->filterByDesignations($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collBrandCampiagnsPartial && count($collBrandCampiagns)) {
                        $this->initBrandCampiagns(false);

                        foreach ($collBrandCampiagns as $obj) {
                            if (false == $this->collBrandCampiagns->contains($obj)) {
                                $this->collBrandCampiagns->append($obj);
                            }
                        }

                        $this->collBrandCampiagnsPartial = true;
                    }

                    return $collBrandCampiagns;
                }

                if ($partial && $this->collBrandCampiagns) {
                    foreach ($this->collBrandCampiagns as $obj) {
                        if ($obj->isNew()) {
                            $collBrandCampiagns[] = $obj;
                        }
                    }
                }

                $this->collBrandCampiagns = $collBrandCampiagns;
                $this->collBrandCampiagnsPartial = false;
            }
        }

        return $this->collBrandCampiagns;
    }

    /**
     * Sets a collection of ChildBrandCampiagn objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $brandCampiagns A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setBrandCampiagns(Collection $brandCampiagns, ?ConnectionInterface $con = null)
    {
        /** @var ChildBrandCampiagn[] $brandCampiagnsToDelete */
        $brandCampiagnsToDelete = $this->getBrandCampiagns(new Criteria(), $con)->diff($brandCampiagns);


        $this->brandCampiagnsScheduledForDeletion = $brandCampiagnsToDelete;

        foreach ($brandCampiagnsToDelete as $brandCampiagnRemoved) {
            $brandCampiagnRemoved->setDesignations(null);
        }

        $this->collBrandCampiagns = null;
        foreach ($brandCampiagns as $brandCampiagn) {
            $this->addBrandCampiagn($brandCampiagn);
        }

        $this->collBrandCampiagns = $brandCampiagns;
        $this->collBrandCampiagnsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BrandCampiagn objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BrandCampiagn objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countBrandCampiagns(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collBrandCampiagnsPartial && !$this->isNew();
        if (null === $this->collBrandCampiagns || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBrandCampiagns) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getBrandCampiagns());
            }

            $query = ChildBrandCampiagnQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByDesignations($this)
                ->count($con);
        }

        return count($this->collBrandCampiagns);
    }

    /**
     * Method called to associate a ChildBrandCampiagn object to this object
     * through the ChildBrandCampiagn foreign key attribute.
     *
     * @param ChildBrandCampiagn $l ChildBrandCampiagn
     * @return $this The current object (for fluent API support)
     */
    public function addBrandCampiagn(ChildBrandCampiagn $l)
    {
        if ($this->collBrandCampiagns === null) {
            $this->initBrandCampiagns();
            $this->collBrandCampiagnsPartial = true;
        }

        if (!$this->collBrandCampiagns->contains($l)) {
            $this->doAddBrandCampiagn($l);

            if ($this->brandCampiagnsScheduledForDeletion and $this->brandCampiagnsScheduledForDeletion->contains($l)) {
                $this->brandCampiagnsScheduledForDeletion->remove($this->brandCampiagnsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildBrandCampiagn $brandCampiagn The ChildBrandCampiagn object to add.
     */
    protected function doAddBrandCampiagn(ChildBrandCampiagn $brandCampiagn): void
    {
        $this->collBrandCampiagns[]= $brandCampiagn;
        $brandCampiagn->setDesignations($this);
    }

    /**
     * @param ChildBrandCampiagn $brandCampiagn The ChildBrandCampiagn object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeBrandCampiagn(ChildBrandCampiagn $brandCampiagn)
    {
        if ($this->getBrandCampiagns()->contains($brandCampiagn)) {
            $pos = $this->collBrandCampiagns->search($brandCampiagn);
            $this->collBrandCampiagns->remove($pos);
            if (null === $this->brandCampiagnsScheduledForDeletion) {
                $this->brandCampiagnsScheduledForDeletion = clone $this->collBrandCampiagns;
                $this->brandCampiagnsScheduledForDeletion->clear();
            }
            $this->brandCampiagnsScheduledForDeletion[]= $brandCampiagn;
            $brandCampiagn->setDesignations(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Designations is new, it will return
     * an empty collection; or if this Designations has previously
     * been saved, it will retrieve related BrandCampiagns from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Designations.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBrandCampiagn[] List of ChildBrandCampiagn objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBrandCampiagn}> List of ChildBrandCampiagn objects
     */
    public function getBrandCampiagnsJoinBrands(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBrandCampiagnQuery::create(null, $criteria);
        $query->joinWith('Brands', $joinBehavior);

        return $this->getBrandCampiagns($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Designations is new, it will return
     * an empty collection; or if this Designations has previously
     * been saved, it will retrieve related BrandCampiagns from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Designations.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBrandCampiagn[] List of ChildBrandCampiagn objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBrandCampiagn}> List of ChildBrandCampiagn objects
     */
    public function getBrandCampiagnsJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBrandCampiagnQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getBrandCampiagns($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Designations is new, it will return
     * an empty collection; or if this Designations has previously
     * been saved, it will retrieve related BrandCampiagns from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Designations.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBrandCampiagn[] List of ChildBrandCampiagn objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBrandCampiagn}> List of ChildBrandCampiagn objects
     */
    public function getBrandCampiagnsJoinOrgUnit(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBrandCampiagnQuery::create(null, $criteria);
        $query->joinWith('OrgUnit', $joinBehavior);

        return $this->getBrandCampiagns($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Designations is new, it will return
     * an empty collection; or if this Designations has previously
     * been saved, it will retrieve related BrandCampiagns from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Designations.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBrandCampiagn[] List of ChildBrandCampiagn objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBrandCampiagn}> List of ChildBrandCampiagn objects
     */
    public function getBrandCampiagnsJoinOutletType(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBrandCampiagnQuery::create(null, $criteria);
        $query->joinWith('OutletType', $joinBehavior);

        return $this->getBrandCampiagns($query, $con);
    }

    /**
     * Clears out the collEmployees collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addEmployees()
     */
    public function clearEmployees()
    {
        $this->collEmployees = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collEmployees collection loaded partially.
     *
     * @return void
     */
    public function resetPartialEmployees($v = true): void
    {
        $this->collEmployeesPartial = $v;
    }

    /**
     * Initializes the collEmployees collection.
     *
     * By default this just sets the collEmployees collection to an empty array (like clearcollEmployees());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initEmployees(bool $overrideExisting = true): void
    {
        if (null !== $this->collEmployees && !$overrideExisting) {
            return;
        }

        $collectionClassName = EmployeeTableMap::getTableMap()->getCollectionClassName();

        $this->collEmployees = new $collectionClassName;
        $this->collEmployees->setModel('\entities\Employee');
    }

    /**
     * Gets an array of ChildEmployee objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildDesignations is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildEmployee[] List of ChildEmployee objects
     * @phpstan-return ObjectCollection&\Traversable<ChildEmployee> List of ChildEmployee objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getEmployees(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collEmployeesPartial && !$this->isNew();
        if (null === $this->collEmployees || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collEmployees) {
                    $this->initEmployees();
                } else {
                    $collectionClassName = EmployeeTableMap::getTableMap()->getCollectionClassName();

                    $collEmployees = new $collectionClassName;
                    $collEmployees->setModel('\entities\Employee');

                    return $collEmployees;
                }
            } else {
                $collEmployees = ChildEmployeeQuery::create(null, $criteria)
                    ->filterByDesignations($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collEmployeesPartial && count($collEmployees)) {
                        $this->initEmployees(false);

                        foreach ($collEmployees as $obj) {
                            if (false == $this->collEmployees->contains($obj)) {
                                $this->collEmployees->append($obj);
                            }
                        }

                        $this->collEmployeesPartial = true;
                    }

                    return $collEmployees;
                }

                if ($partial && $this->collEmployees) {
                    foreach ($this->collEmployees as $obj) {
                        if ($obj->isNew()) {
                            $collEmployees[] = $obj;
                        }
                    }
                }

                $this->collEmployees = $collEmployees;
                $this->collEmployeesPartial = false;
            }
        }

        return $this->collEmployees;
    }

    /**
     * Sets a collection of ChildEmployee objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $employees A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setEmployees(Collection $employees, ?ConnectionInterface $con = null)
    {
        /** @var ChildEmployee[] $employeesToDelete */
        $employeesToDelete = $this->getEmployees(new Criteria(), $con)->diff($employees);


        $this->employeesScheduledForDeletion = $employeesToDelete;

        foreach ($employeesToDelete as $employeeRemoved) {
            $employeeRemoved->setDesignations(null);
        }

        $this->collEmployees = null;
        foreach ($employees as $employee) {
            $this->addEmployee($employee);
        }

        $this->collEmployees = $employees;
        $this->collEmployeesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Employee objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related Employee objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countEmployees(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collEmployeesPartial && !$this->isNew();
        if (null === $this->collEmployees || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collEmployees) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getEmployees());
            }

            $query = ChildEmployeeQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByDesignations($this)
                ->count($con);
        }

        return count($this->collEmployees);
    }

    /**
     * Method called to associate a ChildEmployee object to this object
     * through the ChildEmployee foreign key attribute.
     *
     * @param ChildEmployee $l ChildEmployee
     * @return $this The current object (for fluent API support)
     */
    public function addEmployee(ChildEmployee $l)
    {
        if ($this->collEmployees === null) {
            $this->initEmployees();
            $this->collEmployeesPartial = true;
        }

        if (!$this->collEmployees->contains($l)) {
            $this->doAddEmployee($l);

            if ($this->employeesScheduledForDeletion and $this->employeesScheduledForDeletion->contains($l)) {
                $this->employeesScheduledForDeletion->remove($this->employeesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildEmployee $employee The ChildEmployee object to add.
     */
    protected function doAddEmployee(ChildEmployee $employee): void
    {
        $this->collEmployees[]= $employee;
        $employee->setDesignations($this);
    }

    /**
     * @param ChildEmployee $employee The ChildEmployee object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeEmployee(ChildEmployee $employee)
    {
        if ($this->getEmployees()->contains($employee)) {
            $pos = $this->collEmployees->search($employee);
            $this->collEmployees->remove($pos);
            if (null === $this->employeesScheduledForDeletion) {
                $this->employeesScheduledForDeletion = clone $this->collEmployees;
                $this->employeesScheduledForDeletion->clear();
            }
            $this->employeesScheduledForDeletion[]= $employee;
            $employee->setDesignations(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Designations is new, it will return
     * an empty collection; or if this Designations has previously
     * been saved, it will retrieve related Employees from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Designations.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildEmployee[] List of ChildEmployee objects
     * @phpstan-return ObjectCollection&\Traversable<ChildEmployee}> List of ChildEmployee objects
     */
    public function getEmployeesJoinBranch(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildEmployeeQuery::create(null, $criteria);
        $query->joinWith('Branch', $joinBehavior);

        return $this->getEmployees($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Designations is new, it will return
     * an empty collection; or if this Designations has previously
     * been saved, it will retrieve related Employees from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Designations.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildEmployee[] List of ChildEmployee objects
     * @phpstan-return ObjectCollection&\Traversable<ChildEmployee}> List of ChildEmployee objects
     */
    public function getEmployeesJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildEmployeeQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getEmployees($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Designations is new, it will return
     * an empty collection; or if this Designations has previously
     * been saved, it will retrieve related Employees from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Designations.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildEmployee[] List of ChildEmployee objects
     * @phpstan-return ObjectCollection&\Traversable<ChildEmployee}> List of ChildEmployee objects
     */
    public function getEmployeesJoinGradeMaster(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildEmployeeQuery::create(null, $criteria);
        $query->joinWith('GradeMaster', $joinBehavior);

        return $this->getEmployees($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Designations is new, it will return
     * an empty collection; or if this Designations has previously
     * been saved, it will retrieve related Employees from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Designations.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildEmployee[] List of ChildEmployee objects
     * @phpstan-return ObjectCollection&\Traversable<ChildEmployee}> List of ChildEmployee objects
     */
    public function getEmployeesJoinOrgUnit(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildEmployeeQuery::create(null, $criteria);
        $query->joinWith('OrgUnit', $joinBehavior);

        return $this->getEmployees($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Designations is new, it will return
     * an empty collection; or if this Designations has previously
     * been saved, it will retrieve related Employees from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Designations.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildEmployee[] List of ChildEmployee objects
     * @phpstan-return ObjectCollection&\Traversable<ChildEmployee}> List of ChildEmployee objects
     */
    public function getEmployeesJoinPositionsRelatedByPositionId(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildEmployeeQuery::create(null, $criteria);
        $query->joinWith('PositionsRelatedByPositionId', $joinBehavior);

        return $this->getEmployees($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Designations is new, it will return
     * an empty collection; or if this Designations has previously
     * been saved, it will retrieve related Employees from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Designations.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildEmployee[] List of ChildEmployee objects
     * @phpstan-return ObjectCollection&\Traversable<ChildEmployee}> List of ChildEmployee objects
     */
    public function getEmployeesJoinPositionsRelatedByReportingTo(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildEmployeeQuery::create(null, $criteria);
        $query->joinWith('PositionsRelatedByReportingTo', $joinBehavior);

        return $this->getEmployees($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Designations is new, it will return
     * an empty collection; or if this Designations has previously
     * been saved, it will retrieve related Employees from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Designations.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildEmployee[] List of ChildEmployee objects
     * @phpstan-return ObjectCollection&\Traversable<ChildEmployee}> List of ChildEmployee objects
     */
    public function getEmployeesJoinGeoTowns(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildEmployeeQuery::create(null, $criteria);
        $query->joinWith('GeoTowns', $joinBehavior);

        return $this->getEmployees($query, $con);
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
            $this->aCompany->removeDesignations($this);
        }
        $this->designation_id = null;
        $this->designation = null;
        $this->designation_color = null;
        $this->company_id = null;
        $this->created_at = null;
        $this->updated_at = null;
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
            if ($this->collBrandCampiagns) {
                foreach ($this->collBrandCampiagns as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collEmployees) {
                foreach ($this->collEmployees as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collBrandCampiagns = null;
        $this->collEmployees = null;
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
        return (string) $this->exportTo(DesignationsTableMap::DEFAULT_STRING_FORMAT);
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
