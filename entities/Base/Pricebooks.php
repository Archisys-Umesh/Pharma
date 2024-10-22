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
use entities\Company as ChildCompany;
use entities\CompanyQuery as ChildCompanyQuery;
use entities\OnBoardRequestOutletMapping as ChildOnBoardRequestOutletMapping;
use entities\OnBoardRequestOutletMappingQuery as ChildOnBoardRequestOutletMappingQuery;
use entities\Orders as ChildOrders;
use entities\OrdersQuery as ChildOrdersQuery;
use entities\OrgUnit as ChildOrgUnit;
use entities\OrgUnitQuery as ChildOrgUnitQuery;
use entities\OutletMapping as ChildOutletMapping;
use entities\OutletMappingQuery as ChildOutletMappingQuery;
use entities\Pricebooklines as ChildPricebooklines;
use entities\PricebooklinesQuery as ChildPricebooklinesQuery;
use entities\Pricebooks as ChildPricebooks;
use entities\PricebooksQuery as ChildPricebooksQuery;
use entities\Map\OnBoardRequestOutletMappingTableMap;
use entities\Map\OrdersTableMap;
use entities\Map\OutletMappingTableMap;
use entities\Map\PricebooklinesTableMap;
use entities\Map\PricebooksTableMap;

/**
 * Base class that represents a row from the 'pricebooks' table.
 *
 *
 *
 * @package    propel.generator.entities.Base
 */
abstract class Pricebooks implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\entities\\Map\\PricebooksTableMap';


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
     * The value for the pricebook_id field.
     *
     * @var        int
     */
    protected $pricebook_id;

    /**
     * The value for the pricebook_name field.
     *
     * @var        string
     */
    protected $pricebook_name;

    /**
     * The value for the pricebook_description field.
     *
     * @var        string|null
     */
    protected $pricebook_description;

    /**
     * The value for the pricebook_code field.
     *
     * @var        string|null
     */
    protected $pricebook_code;

    /**
     * The value for the company_id field.
     *
     * @var        int|null
     */
    protected $company_id;

    /**
     * The value for the org_id field.
     *
     * @var        int|null
     */
    protected $org_id;

    /**
     * The value for the integration_id field.
     *
     * @var        string|null
     */
    protected $integration_id;

    /**
     * @var        ChildCompany
     */
    protected $aCompany;

    /**
     * @var        ChildOrgUnit
     */
    protected $aOrgUnit;

    /**
     * @var        ObjectCollection|ChildOnBoardRequestOutletMapping[] Collection to store aggregation of ChildOnBoardRequestOutletMapping objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildOnBoardRequestOutletMapping> Collection to store aggregation of ChildOnBoardRequestOutletMapping objects.
     */
    protected $collOnBoardRequestOutletMappings;
    protected $collOnBoardRequestOutletMappingsPartial;

    /**
     * @var        ObjectCollection|ChildOrders[] Collection to store aggregation of ChildOrders objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildOrders> Collection to store aggregation of ChildOrders objects.
     */
    protected $collOrderss;
    protected $collOrderssPartial;

    /**
     * @var        ObjectCollection|ChildOutletMapping[] Collection to store aggregation of ChildOutletMapping objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildOutletMapping> Collection to store aggregation of ChildOutletMapping objects.
     */
    protected $collOutletMappings;
    protected $collOutletMappingsPartial;

    /**
     * @var        ObjectCollection|ChildPricebooklines[] Collection to store aggregation of ChildPricebooklines objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildPricebooklines> Collection to store aggregation of ChildPricebooklines objects.
     */
    protected $collPricebookliness;
    protected $collPricebooklinessPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildOnBoardRequestOutletMapping[]
     * @phpstan-var ObjectCollection&\Traversable<ChildOnBoardRequestOutletMapping>
     */
    protected $onBoardRequestOutletMappingsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildOrders[]
     * @phpstan-var ObjectCollection&\Traversable<ChildOrders>
     */
    protected $orderssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildOutletMapping[]
     * @phpstan-var ObjectCollection&\Traversable<ChildOutletMapping>
     */
    protected $outletMappingsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildPricebooklines[]
     * @phpstan-var ObjectCollection&\Traversable<ChildPricebooklines>
     */
    protected $pricebooklinessScheduledForDeletion = null;

    /**
     * Initializes internal state of entities\Base\Pricebooks object.
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
     * Compares this with another <code>Pricebooks</code> instance.  If
     * <code>obj</code> is an instance of <code>Pricebooks</code>, delegates to
     * <code>equals(Pricebooks)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [pricebook_id] column value.
     *
     * @return int
     */
    public function getPricebookId()
    {
        return $this->pricebook_id;
    }

    /**
     * Get the [pricebook_name] column value.
     *
     * @return string
     */
    public function getPricebookName()
    {
        return $this->pricebook_name;
    }

    /**
     * Get the [pricebook_description] column value.
     *
     * @return string|null
     */
    public function getPricebookDescription()
    {
        return $this->pricebook_description;
    }

    /**
     * Get the [pricebook_code] column value.
     *
     * @return string|null
     */
    public function getPricebookCode()
    {
        return $this->pricebook_code;
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
     * Get the [org_id] column value.
     *
     * @return int|null
     */
    public function getOrgId()
    {
        return $this->org_id;
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
     * Set the value of [pricebook_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPricebookId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->pricebook_id !== $v) {
            $this->pricebook_id = $v;
            $this->modifiedColumns[PricebooksTableMap::COL_PRICEBOOK_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [pricebook_name] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPricebookName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->pricebook_name !== $v) {
            $this->pricebook_name = $v;
            $this->modifiedColumns[PricebooksTableMap::COL_PRICEBOOK_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [pricebook_description] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPricebookDescription($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->pricebook_description !== $v) {
            $this->pricebook_description = $v;
            $this->modifiedColumns[PricebooksTableMap::COL_PRICEBOOK_DESCRIPTION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [pricebook_code] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPricebookCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->pricebook_code !== $v) {
            $this->pricebook_code = $v;
            $this->modifiedColumns[PricebooksTableMap::COL_PRICEBOOK_CODE] = true;
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
            $this->modifiedColumns[PricebooksTableMap::COL_COMPANY_ID] = true;
        }

        if ($this->aCompany !== null && $this->aCompany->getCompanyId() !== $v) {
            $this->aCompany = null;
        }

        return $this;
    }

    /**
     * Set the value of [org_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOrgId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->org_id !== $v) {
            $this->org_id = $v;
            $this->modifiedColumns[PricebooksTableMap::COL_ORG_ID] = true;
        }

        if ($this->aOrgUnit !== null && $this->aOrgUnit->getOrgunitid() !== $v) {
            $this->aOrgUnit = null;
        }

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
            $this->modifiedColumns[PricebooksTableMap::COL_INTEGRATION_ID] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : PricebooksTableMap::translateFieldName('PricebookId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->pricebook_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : PricebooksTableMap::translateFieldName('PricebookName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->pricebook_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : PricebooksTableMap::translateFieldName('PricebookDescription', TableMap::TYPE_PHPNAME, $indexType)];
            $this->pricebook_description = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : PricebooksTableMap::translateFieldName('PricebookCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->pricebook_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : PricebooksTableMap::translateFieldName('CompanyId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->company_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : PricebooksTableMap::translateFieldName('OrgId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->org_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : PricebooksTableMap::translateFieldName('IntegrationId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->integration_id = (null !== $col) ? (string) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 7; // 7 = PricebooksTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\entities\\Pricebooks'), 0, $e);
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
        if ($this->aOrgUnit !== null && $this->org_id !== $this->aOrgUnit->getOrgunitid()) {
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
            $con = Propel::getServiceContainer()->getReadConnection(PricebooksTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildPricebooksQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aCompany = null;
            $this->aOrgUnit = null;
            $this->collOnBoardRequestOutletMappings = null;

            $this->collOrderss = null;

            $this->collOutletMappings = null;

            $this->collPricebookliness = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see Pricebooks::setDeleted()
     * @see Pricebooks::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(PricebooksTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildPricebooksQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(PricebooksTableMap::DATABASE_NAME);
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
                PricebooksTableMap::addInstanceToPool($this);
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

            if ($this->aOrgUnit !== null) {
                if ($this->aOrgUnit->isModified() || $this->aOrgUnit->isNew()) {
                    $affectedRows += $this->aOrgUnit->save($con);
                }
                $this->setOrgUnit($this->aOrgUnit);
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

            if ($this->onBoardRequestOutletMappingsScheduledForDeletion !== null) {
                if (!$this->onBoardRequestOutletMappingsScheduledForDeletion->isEmpty()) {
                    foreach ($this->onBoardRequestOutletMappingsScheduledForDeletion as $onBoardRequestOutletMapping) {
                        // need to save related object because we set the relation to null
                        $onBoardRequestOutletMapping->save($con);
                    }
                    $this->onBoardRequestOutletMappingsScheduledForDeletion = null;
                }
            }

            if ($this->collOnBoardRequestOutletMappings !== null) {
                foreach ($this->collOnBoardRequestOutletMappings as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->orderssScheduledForDeletion !== null) {
                if (!$this->orderssScheduledForDeletion->isEmpty()) {
                    foreach ($this->orderssScheduledForDeletion as $orders) {
                        // need to save related object because we set the relation to null
                        $orders->save($con);
                    }
                    $this->orderssScheduledForDeletion = null;
                }
            }

            if ($this->collOrderss !== null) {
                foreach ($this->collOrderss as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->outletMappingsScheduledForDeletion !== null) {
                if (!$this->outletMappingsScheduledForDeletion->isEmpty()) {
                    foreach ($this->outletMappingsScheduledForDeletion as $outletMapping) {
                        // need to save related object because we set the relation to null
                        $outletMapping->save($con);
                    }
                    $this->outletMappingsScheduledForDeletion = null;
                }
            }

            if ($this->collOutletMappings !== null) {
                foreach ($this->collOutletMappings as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->pricebooklinessScheduledForDeletion !== null) {
                if (!$this->pricebooklinessScheduledForDeletion->isEmpty()) {
                    \entities\PricebooklinesQuery::create()
                        ->filterByPrimaryKeys($this->pricebooklinessScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->pricebooklinessScheduledForDeletion = null;
                }
            }

            if ($this->collPricebookliness !== null) {
                foreach ($this->collPricebookliness as $referrerFK) {
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

        $this->modifiedColumns[PricebooksTableMap::COL_PRICEBOOK_ID] = true;
        if (null !== $this->pricebook_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . PricebooksTableMap::COL_PRICEBOOK_ID . ')');
        }
        if (null === $this->pricebook_id) {
            try {
                $dataFetcher = $con->query("SELECT nextval('pricebooks_pricebook_id_seq')");
                $this->pricebook_id = (int) $dataFetcher->fetchColumn();
            } catch (Exception $e) {
                throw new PropelException('Unable to get sequence id.', 0, $e);
            }
        }


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(PricebooksTableMap::COL_PRICEBOOK_ID)) {
            $modifiedColumns[':p' . $index++]  = 'pricebook_id';
        }
        if ($this->isColumnModified(PricebooksTableMap::COL_PRICEBOOK_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'pricebook_name';
        }
        if ($this->isColumnModified(PricebooksTableMap::COL_PRICEBOOK_DESCRIPTION)) {
            $modifiedColumns[':p' . $index++]  = 'pricebook_description';
        }
        if ($this->isColumnModified(PricebooksTableMap::COL_PRICEBOOK_CODE)) {
            $modifiedColumns[':p' . $index++]  = 'pricebook_code';
        }
        if ($this->isColumnModified(PricebooksTableMap::COL_COMPANY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'company_id';
        }
        if ($this->isColumnModified(PricebooksTableMap::COL_ORG_ID)) {
            $modifiedColumns[':p' . $index++]  = 'org_id';
        }
        if ($this->isColumnModified(PricebooksTableMap::COL_INTEGRATION_ID)) {
            $modifiedColumns[':p' . $index++]  = 'integration_id';
        }

        $sql = sprintf(
            'INSERT INTO pricebooks (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'pricebook_id':
                        $stmt->bindValue($identifier, $this->pricebook_id, PDO::PARAM_INT);

                        break;
                    case 'pricebook_name':
                        $stmt->bindValue($identifier, $this->pricebook_name, PDO::PARAM_STR);

                        break;
                    case 'pricebook_description':
                        $stmt->bindValue($identifier, $this->pricebook_description, PDO::PARAM_STR);

                        break;
                    case 'pricebook_code':
                        $stmt->bindValue($identifier, $this->pricebook_code, PDO::PARAM_STR);

                        break;
                    case 'company_id':
                        $stmt->bindValue($identifier, $this->company_id, PDO::PARAM_INT);

                        break;
                    case 'org_id':
                        $stmt->bindValue($identifier, $this->org_id, PDO::PARAM_INT);

                        break;
                    case 'integration_id':
                        $stmt->bindValue($identifier, $this->integration_id, PDO::PARAM_STR);

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
        $pos = PricebooksTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getPricebookId();

            case 1:
                return $this->getPricebookName();

            case 2:
                return $this->getPricebookDescription();

            case 3:
                return $this->getPricebookCode();

            case 4:
                return $this->getCompanyId();

            case 5:
                return $this->getOrgId();

            case 6:
                return $this->getIntegrationId();

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
        if (isset($alreadyDumpedObjects['Pricebooks'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['Pricebooks'][$this->hashCode()] = true;
        $keys = PricebooksTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getPricebookId(),
            $keys[1] => $this->getPricebookName(),
            $keys[2] => $this->getPricebookDescription(),
            $keys[3] => $this->getPricebookCode(),
            $keys[4] => $this->getCompanyId(),
            $keys[5] => $this->getOrgId(),
            $keys[6] => $this->getIntegrationId(),
        ];
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
            if (null !== $this->collOnBoardRequestOutletMappings) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'onBoardRequestOutletMappings';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'on_board_request_outlet_mappings';
                        break;
                    default:
                        $key = 'OnBoardRequestOutletMappings';
                }

                $result[$key] = $this->collOnBoardRequestOutletMappings->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collOrderss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'orderss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'orderss';
                        break;
                    default:
                        $key = 'Orderss';
                }

                $result[$key] = $this->collOrderss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collOutletMappings) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'outletMappings';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'outlet_mappings';
                        break;
                    default:
                        $key = 'OutletMappings';
                }

                $result[$key] = $this->collOutletMappings->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collPricebookliness) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'pricebookliness';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'pricebookliness';
                        break;
                    default:
                        $key = 'Pricebookliness';
                }

                $result[$key] = $this->collPricebookliness->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = PricebooksTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setPricebookId($value);
                break;
            case 1:
                $this->setPricebookName($value);
                break;
            case 2:
                $this->setPricebookDescription($value);
                break;
            case 3:
                $this->setPricebookCode($value);
                break;
            case 4:
                $this->setCompanyId($value);
                break;
            case 5:
                $this->setOrgId($value);
                break;
            case 6:
                $this->setIntegrationId($value);
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
        $keys = PricebooksTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setPricebookId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setPricebookName($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setPricebookDescription($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setPricebookCode($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setCompanyId($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setOrgId($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setIntegrationId($arr[$keys[6]]);
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
        $criteria = new Criteria(PricebooksTableMap::DATABASE_NAME);

        if ($this->isColumnModified(PricebooksTableMap::COL_PRICEBOOK_ID)) {
            $criteria->add(PricebooksTableMap::COL_PRICEBOOK_ID, $this->pricebook_id);
        }
        if ($this->isColumnModified(PricebooksTableMap::COL_PRICEBOOK_NAME)) {
            $criteria->add(PricebooksTableMap::COL_PRICEBOOK_NAME, $this->pricebook_name);
        }
        if ($this->isColumnModified(PricebooksTableMap::COL_PRICEBOOK_DESCRIPTION)) {
            $criteria->add(PricebooksTableMap::COL_PRICEBOOK_DESCRIPTION, $this->pricebook_description);
        }
        if ($this->isColumnModified(PricebooksTableMap::COL_PRICEBOOK_CODE)) {
            $criteria->add(PricebooksTableMap::COL_PRICEBOOK_CODE, $this->pricebook_code);
        }
        if ($this->isColumnModified(PricebooksTableMap::COL_COMPANY_ID)) {
            $criteria->add(PricebooksTableMap::COL_COMPANY_ID, $this->company_id);
        }
        if ($this->isColumnModified(PricebooksTableMap::COL_ORG_ID)) {
            $criteria->add(PricebooksTableMap::COL_ORG_ID, $this->org_id);
        }
        if ($this->isColumnModified(PricebooksTableMap::COL_INTEGRATION_ID)) {
            $criteria->add(PricebooksTableMap::COL_INTEGRATION_ID, $this->integration_id);
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
        $criteria = ChildPricebooksQuery::create();
        $criteria->add(PricebooksTableMap::COL_PRICEBOOK_ID, $this->pricebook_id);

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
        $validPk = null !== $this->getPricebookId();

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
        return $this->getPricebookId();
    }

    /**
     * Generic method to set the primary key (pricebook_id column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setPricebookId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getPricebookId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \entities\Pricebooks (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setPricebookName($this->getPricebookName());
        $copyObj->setPricebookDescription($this->getPricebookDescription());
        $copyObj->setPricebookCode($this->getPricebookCode());
        $copyObj->setCompanyId($this->getCompanyId());
        $copyObj->setOrgId($this->getOrgId());
        $copyObj->setIntegrationId($this->getIntegrationId());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getOnBoardRequestOutletMappings() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOnBoardRequestOutletMapping($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getOrderss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOrders($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getOutletMappings() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOutletMapping($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getPricebookliness() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPricebooklines($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setPricebookId(NULL); // this is a auto-increment column, so set to default value
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
     * @return \entities\Pricebooks Clone of current object.
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
            $v->addPricebooks($this);
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
                $this->aCompany->addPricebookss($this);
             */
        }

        return $this->aCompany;
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
            $this->setOrgId(NULL);
        } else {
            $this->setOrgId($v->getOrgunitid());
        }

        $this->aOrgUnit = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildOrgUnit object, it will not be re-added.
        if ($v !== null) {
            $v->addPricebooks($this);
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
        if ($this->aOrgUnit === null && ($this->org_id != 0)) {
            $this->aOrgUnit = ChildOrgUnitQuery::create()->findPk($this->org_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aOrgUnit->addPricebookss($this);
             */
        }

        return $this->aOrgUnit;
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
        if ('OnBoardRequestOutletMapping' === $relationName) {
            $this->initOnBoardRequestOutletMappings();
            return;
        }
        if ('Orders' === $relationName) {
            $this->initOrderss();
            return;
        }
        if ('OutletMapping' === $relationName) {
            $this->initOutletMappings();
            return;
        }
        if ('Pricebooklines' === $relationName) {
            $this->initPricebookliness();
            return;
        }
    }

    /**
     * Clears out the collOnBoardRequestOutletMappings collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addOnBoardRequestOutletMappings()
     */
    public function clearOnBoardRequestOutletMappings()
    {
        $this->collOnBoardRequestOutletMappings = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collOnBoardRequestOutletMappings collection loaded partially.
     *
     * @return void
     */
    public function resetPartialOnBoardRequestOutletMappings($v = true): void
    {
        $this->collOnBoardRequestOutletMappingsPartial = $v;
    }

    /**
     * Initializes the collOnBoardRequestOutletMappings collection.
     *
     * By default this just sets the collOnBoardRequestOutletMappings collection to an empty array (like clearcollOnBoardRequestOutletMappings());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initOnBoardRequestOutletMappings(bool $overrideExisting = true): void
    {
        if (null !== $this->collOnBoardRequestOutletMappings && !$overrideExisting) {
            return;
        }

        $collectionClassName = OnBoardRequestOutletMappingTableMap::getTableMap()->getCollectionClassName();

        $this->collOnBoardRequestOutletMappings = new $collectionClassName;
        $this->collOnBoardRequestOutletMappings->setModel('\entities\OnBoardRequestOutletMapping');
    }

    /**
     * Gets an array of ChildOnBoardRequestOutletMapping objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildPricebooks is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildOnBoardRequestOutletMapping[] List of ChildOnBoardRequestOutletMapping objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequestOutletMapping> List of ChildOnBoardRequestOutletMapping objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOnBoardRequestOutletMappings(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collOnBoardRequestOutletMappingsPartial && !$this->isNew();
        if (null === $this->collOnBoardRequestOutletMappings || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collOnBoardRequestOutletMappings) {
                    $this->initOnBoardRequestOutletMappings();
                } else {
                    $collectionClassName = OnBoardRequestOutletMappingTableMap::getTableMap()->getCollectionClassName();

                    $collOnBoardRequestOutletMappings = new $collectionClassName;
                    $collOnBoardRequestOutletMappings->setModel('\entities\OnBoardRequestOutletMapping');

                    return $collOnBoardRequestOutletMappings;
                }
            } else {
                $collOnBoardRequestOutletMappings = ChildOnBoardRequestOutletMappingQuery::create(null, $criteria)
                    ->filterByPricebooks($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collOnBoardRequestOutletMappingsPartial && count($collOnBoardRequestOutletMappings)) {
                        $this->initOnBoardRequestOutletMappings(false);

                        foreach ($collOnBoardRequestOutletMappings as $obj) {
                            if (false == $this->collOnBoardRequestOutletMappings->contains($obj)) {
                                $this->collOnBoardRequestOutletMappings->append($obj);
                            }
                        }

                        $this->collOnBoardRequestOutletMappingsPartial = true;
                    }

                    return $collOnBoardRequestOutletMappings;
                }

                if ($partial && $this->collOnBoardRequestOutletMappings) {
                    foreach ($this->collOnBoardRequestOutletMappings as $obj) {
                        if ($obj->isNew()) {
                            $collOnBoardRequestOutletMappings[] = $obj;
                        }
                    }
                }

                $this->collOnBoardRequestOutletMappings = $collOnBoardRequestOutletMappings;
                $this->collOnBoardRequestOutletMappingsPartial = false;
            }
        }

        return $this->collOnBoardRequestOutletMappings;
    }

    /**
     * Sets a collection of ChildOnBoardRequestOutletMapping objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $onBoardRequestOutletMappings A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setOnBoardRequestOutletMappings(Collection $onBoardRequestOutletMappings, ?ConnectionInterface $con = null)
    {
        /** @var ChildOnBoardRequestOutletMapping[] $onBoardRequestOutletMappingsToDelete */
        $onBoardRequestOutletMappingsToDelete = $this->getOnBoardRequestOutletMappings(new Criteria(), $con)->diff($onBoardRequestOutletMappings);


        $this->onBoardRequestOutletMappingsScheduledForDeletion = $onBoardRequestOutletMappingsToDelete;

        foreach ($onBoardRequestOutletMappingsToDelete as $onBoardRequestOutletMappingRemoved) {
            $onBoardRequestOutletMappingRemoved->setPricebooks(null);
        }

        $this->collOnBoardRequestOutletMappings = null;
        foreach ($onBoardRequestOutletMappings as $onBoardRequestOutletMapping) {
            $this->addOnBoardRequestOutletMapping($onBoardRequestOutletMapping);
        }

        $this->collOnBoardRequestOutletMappings = $onBoardRequestOutletMappings;
        $this->collOnBoardRequestOutletMappingsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related OnBoardRequestOutletMapping objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related OnBoardRequestOutletMapping objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countOnBoardRequestOutletMappings(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collOnBoardRequestOutletMappingsPartial && !$this->isNew();
        if (null === $this->collOnBoardRequestOutletMappings || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collOnBoardRequestOutletMappings) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getOnBoardRequestOutletMappings());
            }

            $query = ChildOnBoardRequestOutletMappingQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPricebooks($this)
                ->count($con);
        }

        return count($this->collOnBoardRequestOutletMappings);
    }

    /**
     * Method called to associate a ChildOnBoardRequestOutletMapping object to this object
     * through the ChildOnBoardRequestOutletMapping foreign key attribute.
     *
     * @param ChildOnBoardRequestOutletMapping $l ChildOnBoardRequestOutletMapping
     * @return $this The current object (for fluent API support)
     */
    public function addOnBoardRequestOutletMapping(ChildOnBoardRequestOutletMapping $l)
    {
        if ($this->collOnBoardRequestOutletMappings === null) {
            $this->initOnBoardRequestOutletMappings();
            $this->collOnBoardRequestOutletMappingsPartial = true;
        }

        if (!$this->collOnBoardRequestOutletMappings->contains($l)) {
            $this->doAddOnBoardRequestOutletMapping($l);

            if ($this->onBoardRequestOutletMappingsScheduledForDeletion and $this->onBoardRequestOutletMappingsScheduledForDeletion->contains($l)) {
                $this->onBoardRequestOutletMappingsScheduledForDeletion->remove($this->onBoardRequestOutletMappingsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildOnBoardRequestOutletMapping $onBoardRequestOutletMapping The ChildOnBoardRequestOutletMapping object to add.
     */
    protected function doAddOnBoardRequestOutletMapping(ChildOnBoardRequestOutletMapping $onBoardRequestOutletMapping): void
    {
        $this->collOnBoardRequestOutletMappings[]= $onBoardRequestOutletMapping;
        $onBoardRequestOutletMapping->setPricebooks($this);
    }

    /**
     * @param ChildOnBoardRequestOutletMapping $onBoardRequestOutletMapping The ChildOnBoardRequestOutletMapping object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeOnBoardRequestOutletMapping(ChildOnBoardRequestOutletMapping $onBoardRequestOutletMapping)
    {
        if ($this->getOnBoardRequestOutletMappings()->contains($onBoardRequestOutletMapping)) {
            $pos = $this->collOnBoardRequestOutletMappings->search($onBoardRequestOutletMapping);
            $this->collOnBoardRequestOutletMappings->remove($pos);
            if (null === $this->onBoardRequestOutletMappingsScheduledForDeletion) {
                $this->onBoardRequestOutletMappingsScheduledForDeletion = clone $this->collOnBoardRequestOutletMappings;
                $this->onBoardRequestOutletMappingsScheduledForDeletion->clear();
            }
            $this->onBoardRequestOutletMappingsScheduledForDeletion[]= $onBoardRequestOutletMapping;
            $onBoardRequestOutletMapping->setPricebooks(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Pricebooks is new, it will return
     * an empty collection; or if this Pricebooks has previously
     * been saved, it will retrieve related OnBoardRequestOutletMappings from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Pricebooks.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequestOutletMapping[] List of ChildOnBoardRequestOutletMapping objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequestOutletMapping}> List of ChildOnBoardRequestOutletMapping objects
     */
    public function getOnBoardRequestOutletMappingsJoinOnBoardRequest(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestOutletMappingQuery::create(null, $criteria);
        $query->joinWith('OnBoardRequest', $joinBehavior);

        return $this->getOnBoardRequestOutletMappings($query, $con);
    }

    /**
     * Clears out the collOrderss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addOrderss()
     */
    public function clearOrderss()
    {
        $this->collOrderss = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collOrderss collection loaded partially.
     *
     * @return void
     */
    public function resetPartialOrderss($v = true): void
    {
        $this->collOrderssPartial = $v;
    }

    /**
     * Initializes the collOrderss collection.
     *
     * By default this just sets the collOrderss collection to an empty array (like clearcollOrderss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initOrderss(bool $overrideExisting = true): void
    {
        if (null !== $this->collOrderss && !$overrideExisting) {
            return;
        }

        $collectionClassName = OrdersTableMap::getTableMap()->getCollectionClassName();

        $this->collOrderss = new $collectionClassName;
        $this->collOrderss->setModel('\entities\Orders');
    }

    /**
     * Gets an array of ChildOrders objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildPricebooks is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildOrders[] List of ChildOrders objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrders> List of ChildOrders objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOrderss(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collOrderssPartial && !$this->isNew();
        if (null === $this->collOrderss || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collOrderss) {
                    $this->initOrderss();
                } else {
                    $collectionClassName = OrdersTableMap::getTableMap()->getCollectionClassName();

                    $collOrderss = new $collectionClassName;
                    $collOrderss->setModel('\entities\Orders');

                    return $collOrderss;
                }
            } else {
                $collOrderss = ChildOrdersQuery::create(null, $criteria)
                    ->filterByPricebooks($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collOrderssPartial && count($collOrderss)) {
                        $this->initOrderss(false);

                        foreach ($collOrderss as $obj) {
                            if (false == $this->collOrderss->contains($obj)) {
                                $this->collOrderss->append($obj);
                            }
                        }

                        $this->collOrderssPartial = true;
                    }

                    return $collOrderss;
                }

                if ($partial && $this->collOrderss) {
                    foreach ($this->collOrderss as $obj) {
                        if ($obj->isNew()) {
                            $collOrderss[] = $obj;
                        }
                    }
                }

                $this->collOrderss = $collOrderss;
                $this->collOrderssPartial = false;
            }
        }

        return $this->collOrderss;
    }

    /**
     * Sets a collection of ChildOrders objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $orderss A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setOrderss(Collection $orderss, ?ConnectionInterface $con = null)
    {
        /** @var ChildOrders[] $orderssToDelete */
        $orderssToDelete = $this->getOrderss(new Criteria(), $con)->diff($orderss);


        $this->orderssScheduledForDeletion = $orderssToDelete;

        foreach ($orderssToDelete as $ordersRemoved) {
            $ordersRemoved->setPricebooks(null);
        }

        $this->collOrderss = null;
        foreach ($orderss as $orders) {
            $this->addOrders($orders);
        }

        $this->collOrderss = $orderss;
        $this->collOrderssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Orders objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related Orders objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countOrderss(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collOrderssPartial && !$this->isNew();
        if (null === $this->collOrderss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collOrderss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getOrderss());
            }

            $query = ChildOrdersQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPricebooks($this)
                ->count($con);
        }

        return count($this->collOrderss);
    }

    /**
     * Method called to associate a ChildOrders object to this object
     * through the ChildOrders foreign key attribute.
     *
     * @param ChildOrders $l ChildOrders
     * @return $this The current object (for fluent API support)
     */
    public function addOrders(ChildOrders $l)
    {
        if ($this->collOrderss === null) {
            $this->initOrderss();
            $this->collOrderssPartial = true;
        }

        if (!$this->collOrderss->contains($l)) {
            $this->doAddOrders($l);

            if ($this->orderssScheduledForDeletion and $this->orderssScheduledForDeletion->contains($l)) {
                $this->orderssScheduledForDeletion->remove($this->orderssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildOrders $orders The ChildOrders object to add.
     */
    protected function doAddOrders(ChildOrders $orders): void
    {
        $this->collOrderss[]= $orders;
        $orders->setPricebooks($this);
    }

    /**
     * @param ChildOrders $orders The ChildOrders object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeOrders(ChildOrders $orders)
    {
        if ($this->getOrderss()->contains($orders)) {
            $pos = $this->collOrderss->search($orders);
            $this->collOrderss->remove($pos);
            if (null === $this->orderssScheduledForDeletion) {
                $this->orderssScheduledForDeletion = clone $this->collOrderss;
                $this->orderssScheduledForDeletion->clear();
            }
            $this->orderssScheduledForDeletion[]= $orders;
            $orders->setPricebooks(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Pricebooks is new, it will return
     * an empty collection; or if this Pricebooks has previously
     * been saved, it will retrieve related Orderss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Pricebooks.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOrders[] List of ChildOrders objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrders}> List of ChildOrders objects
     */
    public function getOrderssJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOrdersQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getOrderss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Pricebooks is new, it will return
     * an empty collection; or if this Pricebooks has previously
     * been saved, it will retrieve related Orderss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Pricebooks.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOrders[] List of ChildOrders objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrders}> List of ChildOrders objects
     */
    public function getOrderssJoinEmployee(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOrdersQuery::create(null, $criteria);
        $query->joinWith('Employee', $joinBehavior);

        return $this->getOrderss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Pricebooks is new, it will return
     * an empty collection; or if this Pricebooks has previously
     * been saved, it will retrieve related Orderss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Pricebooks.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOrders[] List of ChildOrders objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrders}> List of ChildOrders objects
     */
    public function getOrderssJoinOutletsRelatedByOutletFrom(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOrdersQuery::create(null, $criteria);
        $query->joinWith('OutletsRelatedByOutletFrom', $joinBehavior);

        return $this->getOrderss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Pricebooks is new, it will return
     * an empty collection; or if this Pricebooks has previously
     * been saved, it will retrieve related Orderss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Pricebooks.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOrders[] List of ChildOrders objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrders}> List of ChildOrders objects
     */
    public function getOrderssJoinOutletsRelatedByOutletTo(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOrdersQuery::create(null, $criteria);
        $query->joinWith('OutletsRelatedByOutletTo', $joinBehavior);

        return $this->getOrderss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Pricebooks is new, it will return
     * an empty collection; or if this Pricebooks has previously
     * been saved, it will retrieve related Orderss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Pricebooks.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOrders[] List of ChildOrders objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrders}> List of ChildOrders objects
     */
    public function getOrderssJoinTerritories(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOrdersQuery::create(null, $criteria);
        $query->joinWith('Territories', $joinBehavior);

        return $this->getOrderss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Pricebooks is new, it will return
     * an empty collection; or if this Pricebooks has previously
     * been saved, it will retrieve related Orderss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Pricebooks.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOrders[] List of ChildOrders objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrders}> List of ChildOrders objects
     */
    public function getOrderssJoinBeats(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOrdersQuery::create(null, $criteria);
        $query->joinWith('Beats', $joinBehavior);

        return $this->getOrderss($query, $con);
    }

    /**
     * Clears out the collOutletMappings collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addOutletMappings()
     */
    public function clearOutletMappings()
    {
        $this->collOutletMappings = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collOutletMappings collection loaded partially.
     *
     * @return void
     */
    public function resetPartialOutletMappings($v = true): void
    {
        $this->collOutletMappingsPartial = $v;
    }

    /**
     * Initializes the collOutletMappings collection.
     *
     * By default this just sets the collOutletMappings collection to an empty array (like clearcollOutletMappings());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initOutletMappings(bool $overrideExisting = true): void
    {
        if (null !== $this->collOutletMappings && !$overrideExisting) {
            return;
        }

        $collectionClassName = OutletMappingTableMap::getTableMap()->getCollectionClassName();

        $this->collOutletMappings = new $collectionClassName;
        $this->collOutletMappings->setModel('\entities\OutletMapping');
    }

    /**
     * Gets an array of ChildOutletMapping objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildPricebooks is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildOutletMapping[] List of ChildOutletMapping objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOutletMapping> List of ChildOutletMapping objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOutletMappings(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collOutletMappingsPartial && !$this->isNew();
        if (null === $this->collOutletMappings || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collOutletMappings) {
                    $this->initOutletMappings();
                } else {
                    $collectionClassName = OutletMappingTableMap::getTableMap()->getCollectionClassName();

                    $collOutletMappings = new $collectionClassName;
                    $collOutletMappings->setModel('\entities\OutletMapping');

                    return $collOutletMappings;
                }
            } else {
                $collOutletMappings = ChildOutletMappingQuery::create(null, $criteria)
                    ->filterByPricebooks($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collOutletMappingsPartial && count($collOutletMappings)) {
                        $this->initOutletMappings(false);

                        foreach ($collOutletMappings as $obj) {
                            if (false == $this->collOutletMappings->contains($obj)) {
                                $this->collOutletMappings->append($obj);
                            }
                        }

                        $this->collOutletMappingsPartial = true;
                    }

                    return $collOutletMappings;
                }

                if ($partial && $this->collOutletMappings) {
                    foreach ($this->collOutletMappings as $obj) {
                        if ($obj->isNew()) {
                            $collOutletMappings[] = $obj;
                        }
                    }
                }

                $this->collOutletMappings = $collOutletMappings;
                $this->collOutletMappingsPartial = false;
            }
        }

        return $this->collOutletMappings;
    }

    /**
     * Sets a collection of ChildOutletMapping objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $outletMappings A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setOutletMappings(Collection $outletMappings, ?ConnectionInterface $con = null)
    {
        /** @var ChildOutletMapping[] $outletMappingsToDelete */
        $outletMappingsToDelete = $this->getOutletMappings(new Criteria(), $con)->diff($outletMappings);


        $this->outletMappingsScheduledForDeletion = $outletMappingsToDelete;

        foreach ($outletMappingsToDelete as $outletMappingRemoved) {
            $outletMappingRemoved->setPricebooks(null);
        }

        $this->collOutletMappings = null;
        foreach ($outletMappings as $outletMapping) {
            $this->addOutletMapping($outletMapping);
        }

        $this->collOutletMappings = $outletMappings;
        $this->collOutletMappingsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related OutletMapping objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related OutletMapping objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countOutletMappings(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collOutletMappingsPartial && !$this->isNew();
        if (null === $this->collOutletMappings || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collOutletMappings) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getOutletMappings());
            }

            $query = ChildOutletMappingQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPricebooks($this)
                ->count($con);
        }

        return count($this->collOutletMappings);
    }

    /**
     * Method called to associate a ChildOutletMapping object to this object
     * through the ChildOutletMapping foreign key attribute.
     *
     * @param ChildOutletMapping $l ChildOutletMapping
     * @return $this The current object (for fluent API support)
     */
    public function addOutletMapping(ChildOutletMapping $l)
    {
        if ($this->collOutletMappings === null) {
            $this->initOutletMappings();
            $this->collOutletMappingsPartial = true;
        }

        if (!$this->collOutletMappings->contains($l)) {
            $this->doAddOutletMapping($l);

            if ($this->outletMappingsScheduledForDeletion and $this->outletMappingsScheduledForDeletion->contains($l)) {
                $this->outletMappingsScheduledForDeletion->remove($this->outletMappingsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildOutletMapping $outletMapping The ChildOutletMapping object to add.
     */
    protected function doAddOutletMapping(ChildOutletMapping $outletMapping): void
    {
        $this->collOutletMappings[]= $outletMapping;
        $outletMapping->setPricebooks($this);
    }

    /**
     * @param ChildOutletMapping $outletMapping The ChildOutletMapping object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeOutletMapping(ChildOutletMapping $outletMapping)
    {
        if ($this->getOutletMappings()->contains($outletMapping)) {
            $pos = $this->collOutletMappings->search($outletMapping);
            $this->collOutletMappings->remove($pos);
            if (null === $this->outletMappingsScheduledForDeletion) {
                $this->outletMappingsScheduledForDeletion = clone $this->collOutletMappings;
                $this->outletMappingsScheduledForDeletion->clear();
            }
            $this->outletMappingsScheduledForDeletion[]= $outletMapping;
            $outletMapping->setPricebooks(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Pricebooks is new, it will return
     * an empty collection; or if this Pricebooks has previously
     * been saved, it will retrieve related OutletMappings from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Pricebooks.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOutletMapping[] List of ChildOutletMapping objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOutletMapping}> List of ChildOutletMapping objects
     */
    public function getOutletMappingsJoinOutlets(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOutletMappingQuery::create(null, $criteria);
        $query->joinWith('Outlets', $joinBehavior);

        return $this->getOutletMappings($query, $con);
    }

    /**
     * Clears out the collPricebookliness collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addPricebookliness()
     */
    public function clearPricebookliness()
    {
        $this->collPricebookliness = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collPricebookliness collection loaded partially.
     *
     * @return void
     */
    public function resetPartialPricebookliness($v = true): void
    {
        $this->collPricebooklinessPartial = $v;
    }

    /**
     * Initializes the collPricebookliness collection.
     *
     * By default this just sets the collPricebookliness collection to an empty array (like clearcollPricebookliness());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPricebookliness(bool $overrideExisting = true): void
    {
        if (null !== $this->collPricebookliness && !$overrideExisting) {
            return;
        }

        $collectionClassName = PricebooklinesTableMap::getTableMap()->getCollectionClassName();

        $this->collPricebookliness = new $collectionClassName;
        $this->collPricebookliness->setModel('\entities\Pricebooklines');
    }

    /**
     * Gets an array of ChildPricebooklines objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildPricebooks is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildPricebooklines[] List of ChildPricebooklines objects
     * @phpstan-return ObjectCollection&\Traversable<ChildPricebooklines> List of ChildPricebooklines objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getPricebookliness(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collPricebooklinessPartial && !$this->isNew();
        if (null === $this->collPricebookliness || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collPricebookliness) {
                    $this->initPricebookliness();
                } else {
                    $collectionClassName = PricebooklinesTableMap::getTableMap()->getCollectionClassName();

                    $collPricebookliness = new $collectionClassName;
                    $collPricebookliness->setModel('\entities\Pricebooklines');

                    return $collPricebookliness;
                }
            } else {
                $collPricebookliness = ChildPricebooklinesQuery::create(null, $criteria)
                    ->filterByPricebooks($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collPricebooklinessPartial && count($collPricebookliness)) {
                        $this->initPricebookliness(false);

                        foreach ($collPricebookliness as $obj) {
                            if (false == $this->collPricebookliness->contains($obj)) {
                                $this->collPricebookliness->append($obj);
                            }
                        }

                        $this->collPricebooklinessPartial = true;
                    }

                    return $collPricebookliness;
                }

                if ($partial && $this->collPricebookliness) {
                    foreach ($this->collPricebookliness as $obj) {
                        if ($obj->isNew()) {
                            $collPricebookliness[] = $obj;
                        }
                    }
                }

                $this->collPricebookliness = $collPricebookliness;
                $this->collPricebooklinessPartial = false;
            }
        }

        return $this->collPricebookliness;
    }

    /**
     * Sets a collection of ChildPricebooklines objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $pricebookliness A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setPricebookliness(Collection $pricebookliness, ?ConnectionInterface $con = null)
    {
        /** @var ChildPricebooklines[] $pricebooklinessToDelete */
        $pricebooklinessToDelete = $this->getPricebookliness(new Criteria(), $con)->diff($pricebookliness);


        $this->pricebooklinessScheduledForDeletion = $pricebooklinessToDelete;

        foreach ($pricebooklinessToDelete as $pricebooklinesRemoved) {
            $pricebooklinesRemoved->setPricebooks(null);
        }

        $this->collPricebookliness = null;
        foreach ($pricebookliness as $pricebooklines) {
            $this->addPricebooklines($pricebooklines);
        }

        $this->collPricebookliness = $pricebookliness;
        $this->collPricebooklinessPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Pricebooklines objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related Pricebooklines objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countPricebookliness(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collPricebooklinessPartial && !$this->isNew();
        if (null === $this->collPricebookliness || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPricebookliness) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPricebookliness());
            }

            $query = ChildPricebooklinesQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPricebooks($this)
                ->count($con);
        }

        return count($this->collPricebookliness);
    }

    /**
     * Method called to associate a ChildPricebooklines object to this object
     * through the ChildPricebooklines foreign key attribute.
     *
     * @param ChildPricebooklines $l ChildPricebooklines
     * @return $this The current object (for fluent API support)
     */
    public function addPricebooklines(ChildPricebooklines $l)
    {
        if ($this->collPricebookliness === null) {
            $this->initPricebookliness();
            $this->collPricebooklinessPartial = true;
        }

        if (!$this->collPricebookliness->contains($l)) {
            $this->doAddPricebooklines($l);

            if ($this->pricebooklinessScheduledForDeletion and $this->pricebooklinessScheduledForDeletion->contains($l)) {
                $this->pricebooklinessScheduledForDeletion->remove($this->pricebooklinessScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildPricebooklines $pricebooklines The ChildPricebooklines object to add.
     */
    protected function doAddPricebooklines(ChildPricebooklines $pricebooklines): void
    {
        $this->collPricebookliness[]= $pricebooklines;
        $pricebooklines->setPricebooks($this);
    }

    /**
     * @param ChildPricebooklines $pricebooklines The ChildPricebooklines object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removePricebooklines(ChildPricebooklines $pricebooklines)
    {
        if ($this->getPricebookliness()->contains($pricebooklines)) {
            $pos = $this->collPricebookliness->search($pricebooklines);
            $this->collPricebookliness->remove($pos);
            if (null === $this->pricebooklinessScheduledForDeletion) {
                $this->pricebooklinessScheduledForDeletion = clone $this->collPricebookliness;
                $this->pricebooklinessScheduledForDeletion->clear();
            }
            $this->pricebooklinessScheduledForDeletion[]= clone $pricebooklines;
            $pricebooklines->setPricebooks(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Pricebooks is new, it will return
     * an empty collection; or if this Pricebooks has previously
     * been saved, it will retrieve related Pricebookliness from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Pricebooks.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPricebooklines[] List of ChildPricebooklines objects
     * @phpstan-return ObjectCollection&\Traversable<ChildPricebooklines}> List of ChildPricebooklines objects
     */
    public function getPricebooklinessJoinProducts(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPricebooklinesQuery::create(null, $criteria);
        $query->joinWith('Products', $joinBehavior);

        return $this->getPricebookliness($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Pricebooks is new, it will return
     * an empty collection; or if this Pricebooks has previously
     * been saved, it will retrieve related Pricebookliness from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Pricebooks.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPricebooklines[] List of ChildPricebooklines objects
     * @phpstan-return ObjectCollection&\Traversable<ChildPricebooklines}> List of ChildPricebooklines objects
     */
    public function getPricebooklinessJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPricebooklinesQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getPricebookliness($query, $con);
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
            $this->aCompany->removePricebooks($this);
        }
        if (null !== $this->aOrgUnit) {
            $this->aOrgUnit->removePricebooks($this);
        }
        $this->pricebook_id = null;
        $this->pricebook_name = null;
        $this->pricebook_description = null;
        $this->pricebook_code = null;
        $this->company_id = null;
        $this->org_id = null;
        $this->integration_id = null;
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
            if ($this->collOnBoardRequestOutletMappings) {
                foreach ($this->collOnBoardRequestOutletMappings as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collOrderss) {
                foreach ($this->collOrderss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collOutletMappings) {
                foreach ($this->collOutletMappings as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPricebookliness) {
                foreach ($this->collPricebookliness as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collOnBoardRequestOutletMappings = null;
        $this->collOrderss = null;
        $this->collOutletMappings = null;
        $this->collPricebookliness = null;
        $this->aCompany = null;
        $this->aOrgUnit = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(PricebooksTableMap::DEFAULT_STRING_FORMAT);
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
