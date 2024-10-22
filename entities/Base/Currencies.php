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
use entities\Company as ChildCompany;
use entities\CompanyQuery as ChildCompanyQuery;
use entities\Currencies as ChildCurrencies;
use entities\CurrenciesQuery as ChildCurrenciesQuery;
use entities\Expenses as ChildExpenses;
use entities\ExpensesQuery as ChildExpensesQuery;
use entities\GeoCountry as ChildGeoCountry;
use entities\GeoCountryQuery as ChildGeoCountryQuery;
use entities\OrgUnit as ChildOrgUnit;
use entities\OrgUnitQuery as ChildOrgUnitQuery;
use entities\PolicyMaster as ChildPolicyMaster;
use entities\PolicyMasterQuery as ChildPolicyMasterQuery;
use entities\Map\CompanyTableMap;
use entities\Map\CurrenciesTableMap;
use entities\Map\ExpensesTableMap;
use entities\Map\GeoCountryTableMap;
use entities\Map\OrgUnitTableMap;
use entities\Map\PolicyMasterTableMap;

/**
 * Base class that represents a row from the 'currencies' table.
 *
 *
 *
 * @package    propel.generator.entities.Base
 */
abstract class Currencies implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\entities\\Map\\CurrenciesTableMap';


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
     * The value for the currency_id field.
     *
     * @var        int
     */
    protected $currency_id;

    /**
     * The value for the name field.
     *
     * @var        string
     */
    protected $name;

    /**
     * The value for the shortcode field.
     *
     * @var        string
     */
    protected $shortcode;

    /**
     * The value for the symbol field.
     *
     * @var        string
     */
    protected $symbol;

    /**
     * The value for the conversionrate field.
     *
     * @var        double
     */
    protected $conversionrate;

    /**
     * The value for the fordate field.
     *
     * @var        DateTime|null
     */
    protected $fordate;

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
     * @var        ObjectCollection|ChildCompany[] Collection to store aggregation of ChildCompany objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildCompany> Collection to store aggregation of ChildCompany objects.
     */
    protected $collCompanies;
    protected $collCompaniesPartial;

    /**
     * @var        ObjectCollection|ChildExpenses[] Collection to store aggregation of ChildExpenses objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildExpenses> Collection to store aggregation of ChildExpenses objects.
     */
    protected $collExpensess;
    protected $collExpensessPartial;

    /**
     * @var        ObjectCollection|ChildGeoCountry[] Collection to store aggregation of ChildGeoCountry objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildGeoCountry> Collection to store aggregation of ChildGeoCountry objects.
     */
    protected $collGeoCountries;
    protected $collGeoCountriesPartial;

    /**
     * @var        ObjectCollection|ChildOrgUnit[] Collection to store aggregation of ChildOrgUnit objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildOrgUnit> Collection to store aggregation of ChildOrgUnit objects.
     */
    protected $collOrgUnits;
    protected $collOrgUnitsPartial;

    /**
     * @var        ObjectCollection|ChildPolicyMaster[] Collection to store aggregation of ChildPolicyMaster objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildPolicyMaster> Collection to store aggregation of ChildPolicyMaster objects.
     */
    protected $collPolicyMasters;
    protected $collPolicyMastersPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildCompany[]
     * @phpstan-var ObjectCollection&\Traversable<ChildCompany>
     */
    protected $companiesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildExpenses[]
     * @phpstan-var ObjectCollection&\Traversable<ChildExpenses>
     */
    protected $expensessScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildGeoCountry[]
     * @phpstan-var ObjectCollection&\Traversable<ChildGeoCountry>
     */
    protected $geoCountriesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildOrgUnit[]
     * @phpstan-var ObjectCollection&\Traversable<ChildOrgUnit>
     */
    protected $orgUnitsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildPolicyMaster[]
     * @phpstan-var ObjectCollection&\Traversable<ChildPolicyMaster>
     */
    protected $policyMastersScheduledForDeletion = null;

    /**
     * Initializes internal state of entities\Base\Currencies object.
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
     * Compares this with another <code>Currencies</code> instance.  If
     * <code>obj</code> is an instance of <code>Currencies</code>, delegates to
     * <code>equals(Currencies)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [currency_id] column value.
     *
     * @return int
     */
    public function getCurrencyId()
    {
        return $this->currency_id;
    }

    /**
     * Get the [name] column value.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the [shortcode] column value.
     *
     * @return string
     */
    public function getShortcode()
    {
        return $this->shortcode;
    }

    /**
     * Get the [symbol] column value.
     *
     * @return string
     */
    public function getSymbol()
    {
        return $this->symbol;
    }

    /**
     * Get the [conversionrate] column value.
     *
     * @return double
     */
    public function getConversionrate()
    {
        return $this->conversionrate;
    }

    /**
     * Get the [optionally formatted] temporal [fordate] column value.
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
    public function getFordate($format = null)
    {
        if ($format === null) {
            return $this->fordate;
        } else {
            return $this->fordate instanceof \DateTimeInterface ? $this->fordate->format($format) : null;
        }
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
     * Set the value of [currency_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCurrencyId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->currency_id !== $v) {
            $this->currency_id = $v;
            $this->modifiedColumns[CurrenciesTableMap::COL_CURRENCY_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [name] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->name !== $v) {
            $this->name = $v;
            $this->modifiedColumns[CurrenciesTableMap::COL_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [shortcode] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setShortcode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->shortcode !== $v) {
            $this->shortcode = $v;
            $this->modifiedColumns[CurrenciesTableMap::COL_SHORTCODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [symbol] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setSymbol($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->symbol !== $v) {
            $this->symbol = $v;
            $this->modifiedColumns[CurrenciesTableMap::COL_SYMBOL] = true;
        }

        return $this;
    }

    /**
     * Set the value of [conversionrate] column.
     *
     * @param double $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setConversionrate($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->conversionrate !== $v) {
            $this->conversionrate = $v;
            $this->modifiedColumns[CurrenciesTableMap::COL_CONVERSIONRATE] = true;
        }

        return $this;
    }

    /**
     * Sets the value of [fordate] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setFordate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->fordate !== null || $dt !== null) {
            if ($this->fordate === null || $dt === null || $dt->format("Y-m-d") !== $this->fordate->format("Y-m-d")) {
                $this->fordate = $dt === null ? null : clone $dt;
                $this->modifiedColumns[CurrenciesTableMap::COL_FORDATE] = true;
            }
        } // if either are not null

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
                $this->modifiedColumns[CurrenciesTableMap::COL_CREATED_AT] = true;
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
                $this->modifiedColumns[CurrenciesTableMap::COL_UPDATED_AT] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : CurrenciesTableMap::translateFieldName('CurrencyId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->currency_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : CurrenciesTableMap::translateFieldName('Name', TableMap::TYPE_PHPNAME, $indexType)];
            $this->name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : CurrenciesTableMap::translateFieldName('Shortcode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->shortcode = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : CurrenciesTableMap::translateFieldName('Symbol', TableMap::TYPE_PHPNAME, $indexType)];
            $this->symbol = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : CurrenciesTableMap::translateFieldName('Conversionrate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->conversionrate = (null !== $col) ? (double) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : CurrenciesTableMap::translateFieldName('Fordate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fordate = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : CurrenciesTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : CurrenciesTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 8; // 8 = CurrenciesTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\entities\\Currencies'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(CurrenciesTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildCurrenciesQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collCompanies = null;

            $this->collExpensess = null;

            $this->collGeoCountries = null;

            $this->collOrgUnits = null;

            $this->collPolicyMasters = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see Currencies::setDeleted()
     * @see Currencies::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(CurrenciesTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildCurrenciesQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(CurrenciesTableMap::DATABASE_NAME);
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
                CurrenciesTableMap::addInstanceToPool($this);
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

            if ($this->companiesScheduledForDeletion !== null) {
                if (!$this->companiesScheduledForDeletion->isEmpty()) {
                    foreach ($this->companiesScheduledForDeletion as $company) {
                        // need to save related object because we set the relation to null
                        $company->save($con);
                    }
                    $this->companiesScheduledForDeletion = null;
                }
            }

            if ($this->collCompanies !== null) {
                foreach ($this->collCompanies as $referrerFK) {
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

            if ($this->geoCountriesScheduledForDeletion !== null) {
                if (!$this->geoCountriesScheduledForDeletion->isEmpty()) {
                    foreach ($this->geoCountriesScheduledForDeletion as $geoCountry) {
                        // need to save related object because we set the relation to null
                        $geoCountry->save($con);
                    }
                    $this->geoCountriesScheduledForDeletion = null;
                }
            }

            if ($this->collGeoCountries !== null) {
                foreach ($this->collGeoCountries as $referrerFK) {
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

            if ($this->policyMastersScheduledForDeletion !== null) {
                if (!$this->policyMastersScheduledForDeletion->isEmpty()) {
                    foreach ($this->policyMastersScheduledForDeletion as $policyMaster) {
                        // need to save related object because we set the relation to null
                        $policyMaster->save($con);
                    }
                    $this->policyMastersScheduledForDeletion = null;
                }
            }

            if ($this->collPolicyMasters !== null) {
                foreach ($this->collPolicyMasters as $referrerFK) {
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

        $this->modifiedColumns[CurrenciesTableMap::COL_CURRENCY_ID] = true;
        if (null !== $this->currency_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . CurrenciesTableMap::COL_CURRENCY_ID . ')');
        }
        if (null === $this->currency_id) {
            try {
                $dataFetcher = $con->query("SELECT nextval('currencies_currency_id_seq')");
                $this->currency_id = (int) $dataFetcher->fetchColumn();
            } catch (Exception $e) {
                throw new PropelException('Unable to get sequence id.', 0, $e);
            }
        }


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(CurrenciesTableMap::COL_CURRENCY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'currency_id';
        }
        if ($this->isColumnModified(CurrenciesTableMap::COL_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'name';
        }
        if ($this->isColumnModified(CurrenciesTableMap::COL_SHORTCODE)) {
            $modifiedColumns[':p' . $index++]  = 'shortcode';
        }
        if ($this->isColumnModified(CurrenciesTableMap::COL_SYMBOL)) {
            $modifiedColumns[':p' . $index++]  = 'symbol';
        }
        if ($this->isColumnModified(CurrenciesTableMap::COL_CONVERSIONRATE)) {
            $modifiedColumns[':p' . $index++]  = 'conversionrate';
        }
        if ($this->isColumnModified(CurrenciesTableMap::COL_FORDATE)) {
            $modifiedColumns[':p' . $index++]  = 'fordate';
        }
        if ($this->isColumnModified(CurrenciesTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(CurrenciesTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }

        $sql = sprintf(
            'INSERT INTO currencies (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'currency_id':
                        $stmt->bindValue($identifier, $this->currency_id, PDO::PARAM_INT);

                        break;
                    case 'name':
                        $stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);

                        break;
                    case 'shortcode':
                        $stmt->bindValue($identifier, $this->shortcode, PDO::PARAM_STR);

                        break;
                    case 'symbol':
                        $stmt->bindValue($identifier, $this->symbol, PDO::PARAM_STR);

                        break;
                    case 'conversionrate':
                        $stmt->bindValue($identifier, $this->conversionrate, PDO::PARAM_STR);

                        break;
                    case 'fordate':
                        $stmt->bindValue($identifier, $this->fordate ? $this->fordate->format("Y-m-d") : null, PDO::PARAM_STR);

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
        $pos = CurrenciesTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getCurrencyId();

            case 1:
                return $this->getName();

            case 2:
                return $this->getShortcode();

            case 3:
                return $this->getSymbol();

            case 4:
                return $this->getConversionrate();

            case 5:
                return $this->getFordate();

            case 6:
                return $this->getCreatedAt();

            case 7:
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
        if (isset($alreadyDumpedObjects['Currencies'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['Currencies'][$this->hashCode()] = true;
        $keys = CurrenciesTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getCurrencyId(),
            $keys[1] => $this->getName(),
            $keys[2] => $this->getShortcode(),
            $keys[3] => $this->getSymbol(),
            $keys[4] => $this->getConversionrate(),
            $keys[5] => $this->getFordate(),
            $keys[6] => $this->getCreatedAt(),
            $keys[7] => $this->getUpdatedAt(),
        ];
        if ($result[$keys[5]] instanceof \DateTimeInterface) {
            $result[$keys[5]] = $result[$keys[5]]->format('Y-m-d');
        }

        if ($result[$keys[6]] instanceof \DateTimeInterface) {
            $result[$keys[6]] = $result[$keys[6]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[7]] instanceof \DateTimeInterface) {
            $result[$keys[7]] = $result[$keys[7]]->format('Y-m-d H:i:s.u');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collCompanies) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'companies';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'companies';
                        break;
                    default:
                        $key = 'Companies';
                }

                $result[$key] = $this->collCompanies->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
            if (null !== $this->collGeoCountries) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'geoCountries';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'geo_countries';
                        break;
                    default:
                        $key = 'GeoCountries';
                }

                $result[$key] = $this->collGeoCountries->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
            if (null !== $this->collPolicyMasters) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'policyMasters';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'policy_masters';
                        break;
                    default:
                        $key = 'PolicyMasters';
                }

                $result[$key] = $this->collPolicyMasters->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = CurrenciesTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setCurrencyId($value);
                break;
            case 1:
                $this->setName($value);
                break;
            case 2:
                $this->setShortcode($value);
                break;
            case 3:
                $this->setSymbol($value);
                break;
            case 4:
                $this->setConversionrate($value);
                break;
            case 5:
                $this->setFordate($value);
                break;
            case 6:
                $this->setCreatedAt($value);
                break;
            case 7:
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
        $keys = CurrenciesTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setCurrencyId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setName($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setShortcode($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setSymbol($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setConversionrate($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setFordate($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setCreatedAt($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setUpdatedAt($arr[$keys[7]]);
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
        $criteria = new Criteria(CurrenciesTableMap::DATABASE_NAME);

        if ($this->isColumnModified(CurrenciesTableMap::COL_CURRENCY_ID)) {
            $criteria->add(CurrenciesTableMap::COL_CURRENCY_ID, $this->currency_id);
        }
        if ($this->isColumnModified(CurrenciesTableMap::COL_NAME)) {
            $criteria->add(CurrenciesTableMap::COL_NAME, $this->name);
        }
        if ($this->isColumnModified(CurrenciesTableMap::COL_SHORTCODE)) {
            $criteria->add(CurrenciesTableMap::COL_SHORTCODE, $this->shortcode);
        }
        if ($this->isColumnModified(CurrenciesTableMap::COL_SYMBOL)) {
            $criteria->add(CurrenciesTableMap::COL_SYMBOL, $this->symbol);
        }
        if ($this->isColumnModified(CurrenciesTableMap::COL_CONVERSIONRATE)) {
            $criteria->add(CurrenciesTableMap::COL_CONVERSIONRATE, $this->conversionrate);
        }
        if ($this->isColumnModified(CurrenciesTableMap::COL_FORDATE)) {
            $criteria->add(CurrenciesTableMap::COL_FORDATE, $this->fordate);
        }
        if ($this->isColumnModified(CurrenciesTableMap::COL_CREATED_AT)) {
            $criteria->add(CurrenciesTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(CurrenciesTableMap::COL_UPDATED_AT)) {
            $criteria->add(CurrenciesTableMap::COL_UPDATED_AT, $this->updated_at);
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
        $criteria = ChildCurrenciesQuery::create();
        $criteria->add(CurrenciesTableMap::COL_CURRENCY_ID, $this->currency_id);

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
        $validPk = null !== $this->getCurrencyId();

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
        return $this->getCurrencyId();
    }

    /**
     * Generic method to set the primary key (currency_id column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setCurrencyId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getCurrencyId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \entities\Currencies (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setName($this->getName());
        $copyObj->setShortcode($this->getShortcode());
        $copyObj->setSymbol($this->getSymbol());
        $copyObj->setConversionrate($this->getConversionrate());
        $copyObj->setFordate($this->getFordate());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getCompanies() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addCompany($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getExpensess() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addExpenses($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getGeoCountries() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addGeoCountry($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getOrgUnits() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOrgUnit($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getPolicyMasters() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPolicyMaster($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setCurrencyId(NULL); // this is a auto-increment column, so set to default value
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
     * @return \entities\Currencies Clone of current object.
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
        if ('Company' === $relationName) {
            $this->initCompanies();
            return;
        }
        if ('Expenses' === $relationName) {
            $this->initExpensess();
            return;
        }
        if ('GeoCountry' === $relationName) {
            $this->initGeoCountries();
            return;
        }
        if ('OrgUnit' === $relationName) {
            $this->initOrgUnits();
            return;
        }
        if ('PolicyMaster' === $relationName) {
            $this->initPolicyMasters();
            return;
        }
    }

    /**
     * Clears out the collCompanies collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addCompanies()
     */
    public function clearCompanies()
    {
        $this->collCompanies = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collCompanies collection loaded partially.
     *
     * @return void
     */
    public function resetPartialCompanies($v = true): void
    {
        $this->collCompaniesPartial = $v;
    }

    /**
     * Initializes the collCompanies collection.
     *
     * By default this just sets the collCompanies collection to an empty array (like clearcollCompanies());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initCompanies(bool $overrideExisting = true): void
    {
        if (null !== $this->collCompanies && !$overrideExisting) {
            return;
        }

        $collectionClassName = CompanyTableMap::getTableMap()->getCollectionClassName();

        $this->collCompanies = new $collectionClassName;
        $this->collCompanies->setModel('\entities\Company');
    }

    /**
     * Gets an array of ChildCompany objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildCurrencies is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildCompany[] List of ChildCompany objects
     * @phpstan-return ObjectCollection&\Traversable<ChildCompany> List of ChildCompany objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getCompanies(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collCompaniesPartial && !$this->isNew();
        if (null === $this->collCompanies || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collCompanies) {
                    $this->initCompanies();
                } else {
                    $collectionClassName = CompanyTableMap::getTableMap()->getCollectionClassName();

                    $collCompanies = new $collectionClassName;
                    $collCompanies->setModel('\entities\Company');

                    return $collCompanies;
                }
            } else {
                $collCompanies = ChildCompanyQuery::create(null, $criteria)
                    ->filterByCurrencies($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collCompaniesPartial && count($collCompanies)) {
                        $this->initCompanies(false);

                        foreach ($collCompanies as $obj) {
                            if (false == $this->collCompanies->contains($obj)) {
                                $this->collCompanies->append($obj);
                            }
                        }

                        $this->collCompaniesPartial = true;
                    }

                    return $collCompanies;
                }

                if ($partial && $this->collCompanies) {
                    foreach ($this->collCompanies as $obj) {
                        if ($obj->isNew()) {
                            $collCompanies[] = $obj;
                        }
                    }
                }

                $this->collCompanies = $collCompanies;
                $this->collCompaniesPartial = false;
            }
        }

        return $this->collCompanies;
    }

    /**
     * Sets a collection of ChildCompany objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $companies A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setCompanies(Collection $companies, ?ConnectionInterface $con = null)
    {
        /** @var ChildCompany[] $companiesToDelete */
        $companiesToDelete = $this->getCompanies(new Criteria(), $con)->diff($companies);


        $this->companiesScheduledForDeletion = $companiesToDelete;

        foreach ($companiesToDelete as $companyRemoved) {
            $companyRemoved->setCurrencies(null);
        }

        $this->collCompanies = null;
        foreach ($companies as $company) {
            $this->addCompany($company);
        }

        $this->collCompanies = $companies;
        $this->collCompaniesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Company objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related Company objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countCompanies(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collCompaniesPartial && !$this->isNew();
        if (null === $this->collCompanies || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collCompanies) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getCompanies());
            }

            $query = ChildCompanyQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByCurrencies($this)
                ->count($con);
        }

        return count($this->collCompanies);
    }

    /**
     * Method called to associate a ChildCompany object to this object
     * through the ChildCompany foreign key attribute.
     *
     * @param ChildCompany $l ChildCompany
     * @return $this The current object (for fluent API support)
     */
    public function addCompany(ChildCompany $l)
    {
        if ($this->collCompanies === null) {
            $this->initCompanies();
            $this->collCompaniesPartial = true;
        }

        if (!$this->collCompanies->contains($l)) {
            $this->doAddCompany($l);

            if ($this->companiesScheduledForDeletion and $this->companiesScheduledForDeletion->contains($l)) {
                $this->companiesScheduledForDeletion->remove($this->companiesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildCompany $company The ChildCompany object to add.
     */
    protected function doAddCompany(ChildCompany $company): void
    {
        $this->collCompanies[]= $company;
        $company->setCurrencies($this);
    }

    /**
     * @param ChildCompany $company The ChildCompany object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeCompany(ChildCompany $company)
    {
        if ($this->getCompanies()->contains($company)) {
            $pos = $this->collCompanies->search($company);
            $this->collCompanies->remove($pos);
            if (null === $this->companiesScheduledForDeletion) {
                $this->companiesScheduledForDeletion = clone $this->collCompanies;
                $this->companiesScheduledForDeletion->clear();
            }
            $this->companiesScheduledForDeletion[]= $company;
            $company->setCurrencies(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Currencies is new, it will return
     * an empty collection; or if this Currencies has previously
     * been saved, it will retrieve related Companies from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Currencies.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildCompany[] List of ChildCompany objects
     * @phpstan-return ObjectCollection&\Traversable<ChildCompany}> List of ChildCompany objects
     */
    public function getCompaniesJoinExpenseMasterRelatedByAutoCalculatedTa(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildCompanyQuery::create(null, $criteria);
        $query->joinWith('ExpenseMasterRelatedByAutoCalculatedTa', $joinBehavior);

        return $this->getCompanies($query, $con);
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
     * If this ChildCurrencies is new, it will return
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
                    ->filterByCurrencies($this)
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
            $expensesRemoved->setCurrencies(null);
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
                ->filterByCurrencies($this)
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
        $expenses->setCurrencies($this);
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
            $expenses->setCurrencies(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Currencies is new, it will return
     * an empty collection; or if this Currencies has previously
     * been saved, it will retrieve related Expensess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Currencies.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildExpenses[] List of ChildExpenses objects
     * @phpstan-return ObjectCollection&\Traversable<ChildExpenses}> List of ChildExpenses objects
     */
    public function getExpensessJoinBudgetGroup(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildExpensesQuery::create(null, $criteria);
        $query->joinWith('BudgetGroup', $joinBehavior);

        return $this->getExpensess($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Currencies is new, it will return
     * an empty collection; or if this Currencies has previously
     * been saved, it will retrieve related Expensess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Currencies.
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
     * Otherwise if this Currencies is new, it will return
     * an empty collection; or if this Currencies has previously
     * been saved, it will retrieve related Expensess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Currencies.
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
     * Otherwise if this Currencies is new, it will return
     * an empty collection; or if this Currencies has previously
     * been saved, it will retrieve related Expensess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Currencies.
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
     * Clears out the collGeoCountries collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addGeoCountries()
     */
    public function clearGeoCountries()
    {
        $this->collGeoCountries = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collGeoCountries collection loaded partially.
     *
     * @return void
     */
    public function resetPartialGeoCountries($v = true): void
    {
        $this->collGeoCountriesPartial = $v;
    }

    /**
     * Initializes the collGeoCountries collection.
     *
     * By default this just sets the collGeoCountries collection to an empty array (like clearcollGeoCountries());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initGeoCountries(bool $overrideExisting = true): void
    {
        if (null !== $this->collGeoCountries && !$overrideExisting) {
            return;
        }

        $collectionClassName = GeoCountryTableMap::getTableMap()->getCollectionClassName();

        $this->collGeoCountries = new $collectionClassName;
        $this->collGeoCountries->setModel('\entities\GeoCountry');
    }

    /**
     * Gets an array of ChildGeoCountry objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildCurrencies is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildGeoCountry[] List of ChildGeoCountry objects
     * @phpstan-return ObjectCollection&\Traversable<ChildGeoCountry> List of ChildGeoCountry objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getGeoCountries(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collGeoCountriesPartial && !$this->isNew();
        if (null === $this->collGeoCountries || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collGeoCountries) {
                    $this->initGeoCountries();
                } else {
                    $collectionClassName = GeoCountryTableMap::getTableMap()->getCollectionClassName();

                    $collGeoCountries = new $collectionClassName;
                    $collGeoCountries->setModel('\entities\GeoCountry');

                    return $collGeoCountries;
                }
            } else {
                $collGeoCountries = ChildGeoCountryQuery::create(null, $criteria)
                    ->filterByCurrencies($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collGeoCountriesPartial && count($collGeoCountries)) {
                        $this->initGeoCountries(false);

                        foreach ($collGeoCountries as $obj) {
                            if (false == $this->collGeoCountries->contains($obj)) {
                                $this->collGeoCountries->append($obj);
                            }
                        }

                        $this->collGeoCountriesPartial = true;
                    }

                    return $collGeoCountries;
                }

                if ($partial && $this->collGeoCountries) {
                    foreach ($this->collGeoCountries as $obj) {
                        if ($obj->isNew()) {
                            $collGeoCountries[] = $obj;
                        }
                    }
                }

                $this->collGeoCountries = $collGeoCountries;
                $this->collGeoCountriesPartial = false;
            }
        }

        return $this->collGeoCountries;
    }

    /**
     * Sets a collection of ChildGeoCountry objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $geoCountries A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setGeoCountries(Collection $geoCountries, ?ConnectionInterface $con = null)
    {
        /** @var ChildGeoCountry[] $geoCountriesToDelete */
        $geoCountriesToDelete = $this->getGeoCountries(new Criteria(), $con)->diff($geoCountries);


        $this->geoCountriesScheduledForDeletion = $geoCountriesToDelete;

        foreach ($geoCountriesToDelete as $geoCountryRemoved) {
            $geoCountryRemoved->setCurrencies(null);
        }

        $this->collGeoCountries = null;
        foreach ($geoCountries as $geoCountry) {
            $this->addGeoCountry($geoCountry);
        }

        $this->collGeoCountries = $geoCountries;
        $this->collGeoCountriesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related GeoCountry objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related GeoCountry objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countGeoCountries(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collGeoCountriesPartial && !$this->isNew();
        if (null === $this->collGeoCountries || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collGeoCountries) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getGeoCountries());
            }

            $query = ChildGeoCountryQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByCurrencies($this)
                ->count($con);
        }

        return count($this->collGeoCountries);
    }

    /**
     * Method called to associate a ChildGeoCountry object to this object
     * through the ChildGeoCountry foreign key attribute.
     *
     * @param ChildGeoCountry $l ChildGeoCountry
     * @return $this The current object (for fluent API support)
     */
    public function addGeoCountry(ChildGeoCountry $l)
    {
        if ($this->collGeoCountries === null) {
            $this->initGeoCountries();
            $this->collGeoCountriesPartial = true;
        }

        if (!$this->collGeoCountries->contains($l)) {
            $this->doAddGeoCountry($l);

            if ($this->geoCountriesScheduledForDeletion and $this->geoCountriesScheduledForDeletion->contains($l)) {
                $this->geoCountriesScheduledForDeletion->remove($this->geoCountriesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildGeoCountry $geoCountry The ChildGeoCountry object to add.
     */
    protected function doAddGeoCountry(ChildGeoCountry $geoCountry): void
    {
        $this->collGeoCountries[]= $geoCountry;
        $geoCountry->setCurrencies($this);
    }

    /**
     * @param ChildGeoCountry $geoCountry The ChildGeoCountry object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeGeoCountry(ChildGeoCountry $geoCountry)
    {
        if ($this->getGeoCountries()->contains($geoCountry)) {
            $pos = $this->collGeoCountries->search($geoCountry);
            $this->collGeoCountries->remove($pos);
            if (null === $this->geoCountriesScheduledForDeletion) {
                $this->geoCountriesScheduledForDeletion = clone $this->collGeoCountries;
                $this->geoCountriesScheduledForDeletion->clear();
            }
            $this->geoCountriesScheduledForDeletion[]= $geoCountry;
            $geoCountry->setCurrencies(null);
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
     * If this ChildCurrencies is new, it will return
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
                    ->filterByCurrencies($this)
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
            $orgUnitRemoved->setCurrencies(null);
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
                ->filterByCurrencies($this)
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
        $orgUnit->setCurrencies($this);
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
            $orgUnit->setCurrencies(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Currencies is new, it will return
     * an empty collection; or if this Currencies has previously
     * been saved, it will retrieve related OrgUnits from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Currencies.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOrgUnit[] List of ChildOrgUnit objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrgUnit}> List of ChildOrgUnit objects
     */
    public function getOrgUnitsJoinGeoCountry(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOrgUnitQuery::create(null, $criteria);
        $query->joinWith('GeoCountry', $joinBehavior);

        return $this->getOrgUnits($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Currencies is new, it will return
     * an empty collection; or if this Currencies has previously
     * been saved, it will retrieve related OrgUnits from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Currencies.
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
     * Clears out the collPolicyMasters collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addPolicyMasters()
     */
    public function clearPolicyMasters()
    {
        $this->collPolicyMasters = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collPolicyMasters collection loaded partially.
     *
     * @return void
     */
    public function resetPartialPolicyMasters($v = true): void
    {
        $this->collPolicyMastersPartial = $v;
    }

    /**
     * Initializes the collPolicyMasters collection.
     *
     * By default this just sets the collPolicyMasters collection to an empty array (like clearcollPolicyMasters());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPolicyMasters(bool $overrideExisting = true): void
    {
        if (null !== $this->collPolicyMasters && !$overrideExisting) {
            return;
        }

        $collectionClassName = PolicyMasterTableMap::getTableMap()->getCollectionClassName();

        $this->collPolicyMasters = new $collectionClassName;
        $this->collPolicyMasters->setModel('\entities\PolicyMaster');
    }

    /**
     * Gets an array of ChildPolicyMaster objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildCurrencies is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildPolicyMaster[] List of ChildPolicyMaster objects
     * @phpstan-return ObjectCollection&\Traversable<ChildPolicyMaster> List of ChildPolicyMaster objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getPolicyMasters(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collPolicyMastersPartial && !$this->isNew();
        if (null === $this->collPolicyMasters || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collPolicyMasters) {
                    $this->initPolicyMasters();
                } else {
                    $collectionClassName = PolicyMasterTableMap::getTableMap()->getCollectionClassName();

                    $collPolicyMasters = new $collectionClassName;
                    $collPolicyMasters->setModel('\entities\PolicyMaster');

                    return $collPolicyMasters;
                }
            } else {
                $collPolicyMasters = ChildPolicyMasterQuery::create(null, $criteria)
                    ->filterByCurrencies($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collPolicyMastersPartial && count($collPolicyMasters)) {
                        $this->initPolicyMasters(false);

                        foreach ($collPolicyMasters as $obj) {
                            if (false == $this->collPolicyMasters->contains($obj)) {
                                $this->collPolicyMasters->append($obj);
                            }
                        }

                        $this->collPolicyMastersPartial = true;
                    }

                    return $collPolicyMasters;
                }

                if ($partial && $this->collPolicyMasters) {
                    foreach ($this->collPolicyMasters as $obj) {
                        if ($obj->isNew()) {
                            $collPolicyMasters[] = $obj;
                        }
                    }
                }

                $this->collPolicyMasters = $collPolicyMasters;
                $this->collPolicyMastersPartial = false;
            }
        }

        return $this->collPolicyMasters;
    }

    /**
     * Sets a collection of ChildPolicyMaster objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $policyMasters A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setPolicyMasters(Collection $policyMasters, ?ConnectionInterface $con = null)
    {
        /** @var ChildPolicyMaster[] $policyMastersToDelete */
        $policyMastersToDelete = $this->getPolicyMasters(new Criteria(), $con)->diff($policyMasters);


        $this->policyMastersScheduledForDeletion = $policyMastersToDelete;

        foreach ($policyMastersToDelete as $policyMasterRemoved) {
            $policyMasterRemoved->setCurrencies(null);
        }

        $this->collPolicyMasters = null;
        foreach ($policyMasters as $policyMaster) {
            $this->addPolicyMaster($policyMaster);
        }

        $this->collPolicyMasters = $policyMasters;
        $this->collPolicyMastersPartial = false;

        return $this;
    }

    /**
     * Returns the number of related PolicyMaster objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related PolicyMaster objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countPolicyMasters(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collPolicyMastersPartial && !$this->isNew();
        if (null === $this->collPolicyMasters || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPolicyMasters) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPolicyMasters());
            }

            $query = ChildPolicyMasterQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByCurrencies($this)
                ->count($con);
        }

        return count($this->collPolicyMasters);
    }

    /**
     * Method called to associate a ChildPolicyMaster object to this object
     * through the ChildPolicyMaster foreign key attribute.
     *
     * @param ChildPolicyMaster $l ChildPolicyMaster
     * @return $this The current object (for fluent API support)
     */
    public function addPolicyMaster(ChildPolicyMaster $l)
    {
        if ($this->collPolicyMasters === null) {
            $this->initPolicyMasters();
            $this->collPolicyMastersPartial = true;
        }

        if (!$this->collPolicyMasters->contains($l)) {
            $this->doAddPolicyMaster($l);

            if ($this->policyMastersScheduledForDeletion and $this->policyMastersScheduledForDeletion->contains($l)) {
                $this->policyMastersScheduledForDeletion->remove($this->policyMastersScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildPolicyMaster $policyMaster The ChildPolicyMaster object to add.
     */
    protected function doAddPolicyMaster(ChildPolicyMaster $policyMaster): void
    {
        $this->collPolicyMasters[]= $policyMaster;
        $policyMaster->setCurrencies($this);
    }

    /**
     * @param ChildPolicyMaster $policyMaster The ChildPolicyMaster object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removePolicyMaster(ChildPolicyMaster $policyMaster)
    {
        if ($this->getPolicyMasters()->contains($policyMaster)) {
            $pos = $this->collPolicyMasters->search($policyMaster);
            $this->collPolicyMasters->remove($pos);
            if (null === $this->policyMastersScheduledForDeletion) {
                $this->policyMastersScheduledForDeletion = clone $this->collPolicyMasters;
                $this->policyMastersScheduledForDeletion->clear();
            }
            $this->policyMastersScheduledForDeletion[]= $policyMaster;
            $policyMaster->setCurrencies(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Currencies is new, it will return
     * an empty collection; or if this Currencies has previously
     * been saved, it will retrieve related PolicyMasters from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Currencies.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPolicyMaster[] List of ChildPolicyMaster objects
     * @phpstan-return ObjectCollection&\Traversable<ChildPolicyMaster}> List of ChildPolicyMaster objects
     */
    public function getPolicyMastersJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPolicyMasterQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getPolicyMasters($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Currencies is new, it will return
     * an empty collection; or if this Currencies has previously
     * been saved, it will retrieve related PolicyMasters from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Currencies.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPolicyMaster[] List of ChildPolicyMaster objects
     * @phpstan-return ObjectCollection&\Traversable<ChildPolicyMaster}> List of ChildPolicyMaster objects
     */
    public function getPolicyMastersJoinOrgUnit(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPolicyMasterQuery::create(null, $criteria);
        $query->joinWith('OrgUnit', $joinBehavior);

        return $this->getPolicyMasters($query, $con);
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
        $this->currency_id = null;
        $this->name = null;
        $this->shortcode = null;
        $this->symbol = null;
        $this->conversionrate = null;
        $this->fordate = null;
        $this->created_at = null;
        $this->updated_at = null;
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
            if ($this->collCompanies) {
                foreach ($this->collCompanies as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collExpensess) {
                foreach ($this->collExpensess as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collGeoCountries) {
                foreach ($this->collGeoCountries as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collOrgUnits) {
                foreach ($this->collOrgUnits as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPolicyMasters) {
                foreach ($this->collPolicyMasters as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collCompanies = null;
        $this->collExpensess = null;
        $this->collGeoCountries = null;
        $this->collOrgUnits = null;
        $this->collPolicyMasters = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(CurrenciesTableMap::DEFAULT_STRING_FORMAT);
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
