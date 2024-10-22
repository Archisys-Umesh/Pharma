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
use entities\Categories as ChildCategories;
use entities\CategoriesQuery as ChildCategoriesQuery;
use entities\Company as ChildCompany;
use entities\CompanyQuery as ChildCompanyQuery;
use entities\OrgUnit as ChildOrgUnit;
use entities\OrgUnitQuery as ChildOrgUnitQuery;
use entities\Products as ChildProducts;
use entities\ProductsQuery as ChildProductsQuery;
use entities\Map\CategoriesTableMap;
use entities\Map\ProductsTableMap;

/**
 * Base class that represents a row from the 'categories' table.
 *
 *
 *
 * @package    propel.generator.entities.Base
 */
abstract class Categories implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\entities\\Map\\CategoriesTableMap';


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
     * The value for the id field.
     *
     * @var        int
     */
    protected $id;

    /**
     * The value for the category_name field.
     *
     * @var        string
     */
    protected $category_name;

    /**
     * The value for the category_type field.
     *
     * @var        string
     */
    protected $category_type;

    /**
     * The value for the category_description field.
     *
     * @var        string|null
     */
    protected $category_description;

    /**
     * The value for the category_media field.
     *
     * @var        string|null
     */
    protected $category_media;

    /**
     * The value for the category_display_order field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $category_display_order;

    /**
     * The value for the category_parent_id field.
     *
     * @var        int|null
     */
    protected $category_parent_id;

    /**
     * The value for the category_code field.
     *
     * @var        string|null
     */
    protected $category_code;

    /**
     * The value for the additional_data field.
     *
     * @var        string|null
     */
    protected $additional_data;

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
     * The value for the orgunit_id field.
     *
     * @var        int|null
     */
    protected $orgunit_id;

    /**
     * @var        ChildOrgUnit
     */
    protected $aOrgUnit;

    /**
     * @var        ChildCompany
     */
    protected $aCompany;

    /**
     * @var        ObjectCollection|ChildProducts[] Collection to store aggregation of ChildProducts objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildProducts> Collection to store aggregation of ChildProducts objects.
     */
    protected $collProductss;
    protected $collProductssPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildProducts[]
     * @phpstan-var ObjectCollection&\Traversable<ChildProducts>
     */
    protected $productssScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues(): void
    {
        $this->category_display_order = 0;
    }

    /**
     * Initializes internal state of entities\Base\Categories object.
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
     * Compares this with another <code>Categories</code> instance.  If
     * <code>obj</code> is an instance of <code>Categories</code>, delegates to
     * <code>equals(Categories)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [id] column value.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the [category_name] column value.
     *
     * @return string
     */
    public function getCategoryName()
    {
        return $this->category_name;
    }

    /**
     * Get the [category_type] column value.
     *
     * @return string
     */
    public function getCategoryType()
    {
        return $this->category_type;
    }

    /**
     * Get the [category_description] column value.
     *
     * @return string|null
     */
    public function getCategoryDescription()
    {
        return $this->category_description;
    }

    /**
     * Get the [category_media] column value.
     *
     * @return string|null
     */
    public function getCategoryMedia()
    {
        return $this->category_media;
    }

    /**
     * Get the [category_display_order] column value.
     *
     * @return int
     */
    public function getCategoryDisplayOrder()
    {
        return $this->category_display_order;
    }

    /**
     * Get the [category_parent_id] column value.
     *
     * @return int|null
     */
    public function getCategoryParentId()
    {
        return $this->category_parent_id;
    }

    /**
     * Get the [category_code] column value.
     *
     * @return string|null
     */
    public function getCategoryCode()
    {
        return $this->category_code;
    }

    /**
     * Get the [additional_data] column value.
     *
     * @return string|null
     */
    public function getAdditionalData()
    {
        return $this->additional_data;
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
     * Get the [orgunit_id] column value.
     *
     * @return int|null
     */
    public function getOrgunitId()
    {
        return $this->orgunit_id;
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[CategoriesTableMap::COL_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [category_name] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCategoryName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->category_name !== $v) {
            $this->category_name = $v;
            $this->modifiedColumns[CategoriesTableMap::COL_CATEGORY_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [category_type] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCategoryType($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->category_type !== $v) {
            $this->category_type = $v;
            $this->modifiedColumns[CategoriesTableMap::COL_CATEGORY_TYPE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [category_description] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCategoryDescription($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->category_description !== $v) {
            $this->category_description = $v;
            $this->modifiedColumns[CategoriesTableMap::COL_CATEGORY_DESCRIPTION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [category_media] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCategoryMedia($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->category_media !== $v) {
            $this->category_media = $v;
            $this->modifiedColumns[CategoriesTableMap::COL_CATEGORY_MEDIA] = true;
        }

        return $this;
    }

    /**
     * Set the value of [category_display_order] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCategoryDisplayOrder($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->category_display_order !== $v) {
            $this->category_display_order = $v;
            $this->modifiedColumns[CategoriesTableMap::COL_CATEGORY_DISPLAY_ORDER] = true;
        }

        return $this;
    }

    /**
     * Set the value of [category_parent_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCategoryParentId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->category_parent_id !== $v) {
            $this->category_parent_id = $v;
            $this->modifiedColumns[CategoriesTableMap::COL_CATEGORY_PARENT_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [category_code] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCategoryCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->category_code !== $v) {
            $this->category_code = $v;
            $this->modifiedColumns[CategoriesTableMap::COL_CATEGORY_CODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [additional_data] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setAdditionalData($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->additional_data !== $v) {
            $this->additional_data = $v;
            $this->modifiedColumns[CategoriesTableMap::COL_ADDITIONAL_DATA] = true;
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
            $this->modifiedColumns[CategoriesTableMap::COL_COMPANY_ID] = true;
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
                $this->modifiedColumns[CategoriesTableMap::COL_CREATED_AT] = true;
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
                $this->modifiedColumns[CategoriesTableMap::COL_UPDATED_AT] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [orgunit_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOrgunitId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->orgunit_id !== $v) {
            $this->orgunit_id = $v;
            $this->modifiedColumns[CategoriesTableMap::COL_ORGUNIT_ID] = true;
        }

        if ($this->aOrgUnit !== null && $this->aOrgUnit->getOrgunitid() !== $v) {
            $this->aOrgUnit = null;
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
            if ($this->category_display_order !== 0) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : CategoriesTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : CategoriesTableMap::translateFieldName('CategoryName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->category_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : CategoriesTableMap::translateFieldName('CategoryType', TableMap::TYPE_PHPNAME, $indexType)];
            $this->category_type = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : CategoriesTableMap::translateFieldName('CategoryDescription', TableMap::TYPE_PHPNAME, $indexType)];
            $this->category_description = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : CategoriesTableMap::translateFieldName('CategoryMedia', TableMap::TYPE_PHPNAME, $indexType)];
            $this->category_media = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : CategoriesTableMap::translateFieldName('CategoryDisplayOrder', TableMap::TYPE_PHPNAME, $indexType)];
            $this->category_display_order = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : CategoriesTableMap::translateFieldName('CategoryParentId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->category_parent_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : CategoriesTableMap::translateFieldName('CategoryCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->category_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : CategoriesTableMap::translateFieldName('AdditionalData', TableMap::TYPE_PHPNAME, $indexType)];
            $this->additional_data = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : CategoriesTableMap::translateFieldName('CompanyId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->company_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : CategoriesTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : CategoriesTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : CategoriesTableMap::translateFieldName('OrgunitId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->orgunit_id = (null !== $col) ? (int) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 13; // 13 = CategoriesTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\entities\\Categories'), 0, $e);
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
        if ($this->aOrgUnit !== null && $this->orgunit_id !== $this->aOrgUnit->getOrgunitid()) {
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
            $con = Propel::getServiceContainer()->getReadConnection(CategoriesTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildCategoriesQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aOrgUnit = null;
            $this->aCompany = null;
            $this->collProductss = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see Categories::setDeleted()
     * @see Categories::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(CategoriesTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildCategoriesQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(CategoriesTableMap::DATABASE_NAME);
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
                CategoriesTableMap::addInstanceToPool($this);
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

            if ($this->aOrgUnit !== null) {
                if ($this->aOrgUnit->isModified() || $this->aOrgUnit->isNew()) {
                    $affectedRows += $this->aOrgUnit->save($con);
                }
                $this->setOrgUnit($this->aOrgUnit);
            }

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

            if ($this->productssScheduledForDeletion !== null) {
                if (!$this->productssScheduledForDeletion->isEmpty()) {
                    foreach ($this->productssScheduledForDeletion as $products) {
                        // need to save related object because we set the relation to null
                        $products->save($con);
                    }
                    $this->productssScheduledForDeletion = null;
                }
            }

            if ($this->collProductss !== null) {
                foreach ($this->collProductss as $referrerFK) {
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

        $this->modifiedColumns[CategoriesTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . CategoriesTableMap::COL_ID . ')');
        }
        if (null === $this->id) {
            try {
                $dataFetcher = $con->query("SELECT nextval('categories_id_seq')");
                $this->id = (int) $dataFetcher->fetchColumn();
            } catch (Exception $e) {
                throw new PropelException('Unable to get sequence id.', 0, $e);
            }
        }


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(CategoriesTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(CategoriesTableMap::COL_CATEGORY_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'category_name';
        }
        if ($this->isColumnModified(CategoriesTableMap::COL_CATEGORY_TYPE)) {
            $modifiedColumns[':p' . $index++]  = 'category_type';
        }
        if ($this->isColumnModified(CategoriesTableMap::COL_CATEGORY_DESCRIPTION)) {
            $modifiedColumns[':p' . $index++]  = 'category_description';
        }
        if ($this->isColumnModified(CategoriesTableMap::COL_CATEGORY_MEDIA)) {
            $modifiedColumns[':p' . $index++]  = 'category_media';
        }
        if ($this->isColumnModified(CategoriesTableMap::COL_CATEGORY_DISPLAY_ORDER)) {
            $modifiedColumns[':p' . $index++]  = 'category_display_order';
        }
        if ($this->isColumnModified(CategoriesTableMap::COL_CATEGORY_PARENT_ID)) {
            $modifiedColumns[':p' . $index++]  = 'category_parent_id';
        }
        if ($this->isColumnModified(CategoriesTableMap::COL_CATEGORY_CODE)) {
            $modifiedColumns[':p' . $index++]  = 'category_code';
        }
        if ($this->isColumnModified(CategoriesTableMap::COL_ADDITIONAL_DATA)) {
            $modifiedColumns[':p' . $index++]  = 'additional_data';
        }
        if ($this->isColumnModified(CategoriesTableMap::COL_COMPANY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'company_id';
        }
        if ($this->isColumnModified(CategoriesTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(CategoriesTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }
        if ($this->isColumnModified(CategoriesTableMap::COL_ORGUNIT_ID)) {
            $modifiedColumns[':p' . $index++]  = 'orgunit_id';
        }

        $sql = sprintf(
            'INSERT INTO categories (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id':
                        $stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);

                        break;
                    case 'category_name':
                        $stmt->bindValue($identifier, $this->category_name, PDO::PARAM_STR);

                        break;
                    case 'category_type':
                        $stmt->bindValue($identifier, $this->category_type, PDO::PARAM_STR);

                        break;
                    case 'category_description':
                        $stmt->bindValue($identifier, $this->category_description, PDO::PARAM_STR);

                        break;
                    case 'category_media':
                        $stmt->bindValue($identifier, $this->category_media, PDO::PARAM_STR);

                        break;
                    case 'category_display_order':
                        $stmt->bindValue($identifier, $this->category_display_order, PDO::PARAM_INT);

                        break;
                    case 'category_parent_id':
                        $stmt->bindValue($identifier, $this->category_parent_id, PDO::PARAM_INT);

                        break;
                    case 'category_code':
                        $stmt->bindValue($identifier, $this->category_code, PDO::PARAM_STR);

                        break;
                    case 'additional_data':
                        $stmt->bindValue($identifier, $this->additional_data, PDO::PARAM_STR);

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
                    case 'orgunit_id':
                        $stmt->bindValue($identifier, $this->orgunit_id, PDO::PARAM_INT);

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
        $pos = CategoriesTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getId();

            case 1:
                return $this->getCategoryName();

            case 2:
                return $this->getCategoryType();

            case 3:
                return $this->getCategoryDescription();

            case 4:
                return $this->getCategoryMedia();

            case 5:
                return $this->getCategoryDisplayOrder();

            case 6:
                return $this->getCategoryParentId();

            case 7:
                return $this->getCategoryCode();

            case 8:
                return $this->getAdditionalData();

            case 9:
                return $this->getCompanyId();

            case 10:
                return $this->getCreatedAt();

            case 11:
                return $this->getUpdatedAt();

            case 12:
                return $this->getOrgunitId();

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
        if (isset($alreadyDumpedObjects['Categories'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['Categories'][$this->hashCode()] = true;
        $keys = CategoriesTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getId(),
            $keys[1] => $this->getCategoryName(),
            $keys[2] => $this->getCategoryType(),
            $keys[3] => $this->getCategoryDescription(),
            $keys[4] => $this->getCategoryMedia(),
            $keys[5] => $this->getCategoryDisplayOrder(),
            $keys[6] => $this->getCategoryParentId(),
            $keys[7] => $this->getCategoryCode(),
            $keys[8] => $this->getAdditionalData(),
            $keys[9] => $this->getCompanyId(),
            $keys[10] => $this->getCreatedAt(),
            $keys[11] => $this->getUpdatedAt(),
            $keys[12] => $this->getOrgunitId(),
        ];
        if ($result[$keys[10]] instanceof \DateTimeInterface) {
            $result[$keys[10]] = $result[$keys[10]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[11]] instanceof \DateTimeInterface) {
            $result[$keys[11]] = $result[$keys[11]]->format('Y-m-d H:i:s.u');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
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
            if (null !== $this->collProductss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'productss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'productss';
                        break;
                    default:
                        $key = 'Productss';
                }

                $result[$key] = $this->collProductss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = CategoriesTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setId($value);
                break;
            case 1:
                $this->setCategoryName($value);
                break;
            case 2:
                $this->setCategoryType($value);
                break;
            case 3:
                $this->setCategoryDescription($value);
                break;
            case 4:
                $this->setCategoryMedia($value);
                break;
            case 5:
                $this->setCategoryDisplayOrder($value);
                break;
            case 6:
                $this->setCategoryParentId($value);
                break;
            case 7:
                $this->setCategoryCode($value);
                break;
            case 8:
                $this->setAdditionalData($value);
                break;
            case 9:
                $this->setCompanyId($value);
                break;
            case 10:
                $this->setCreatedAt($value);
                break;
            case 11:
                $this->setUpdatedAt($value);
                break;
            case 12:
                $this->setOrgunitId($value);
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
        $keys = CategoriesTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setCategoryName($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setCategoryType($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setCategoryDescription($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setCategoryMedia($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setCategoryDisplayOrder($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setCategoryParentId($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setCategoryCode($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setAdditionalData($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setCompanyId($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setCreatedAt($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setUpdatedAt($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setOrgunitId($arr[$keys[12]]);
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
        $criteria = new Criteria(CategoriesTableMap::DATABASE_NAME);

        if ($this->isColumnModified(CategoriesTableMap::COL_ID)) {
            $criteria->add(CategoriesTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(CategoriesTableMap::COL_CATEGORY_NAME)) {
            $criteria->add(CategoriesTableMap::COL_CATEGORY_NAME, $this->category_name);
        }
        if ($this->isColumnModified(CategoriesTableMap::COL_CATEGORY_TYPE)) {
            $criteria->add(CategoriesTableMap::COL_CATEGORY_TYPE, $this->category_type);
        }
        if ($this->isColumnModified(CategoriesTableMap::COL_CATEGORY_DESCRIPTION)) {
            $criteria->add(CategoriesTableMap::COL_CATEGORY_DESCRIPTION, $this->category_description);
        }
        if ($this->isColumnModified(CategoriesTableMap::COL_CATEGORY_MEDIA)) {
            $criteria->add(CategoriesTableMap::COL_CATEGORY_MEDIA, $this->category_media);
        }
        if ($this->isColumnModified(CategoriesTableMap::COL_CATEGORY_DISPLAY_ORDER)) {
            $criteria->add(CategoriesTableMap::COL_CATEGORY_DISPLAY_ORDER, $this->category_display_order);
        }
        if ($this->isColumnModified(CategoriesTableMap::COL_CATEGORY_PARENT_ID)) {
            $criteria->add(CategoriesTableMap::COL_CATEGORY_PARENT_ID, $this->category_parent_id);
        }
        if ($this->isColumnModified(CategoriesTableMap::COL_CATEGORY_CODE)) {
            $criteria->add(CategoriesTableMap::COL_CATEGORY_CODE, $this->category_code);
        }
        if ($this->isColumnModified(CategoriesTableMap::COL_ADDITIONAL_DATA)) {
            $criteria->add(CategoriesTableMap::COL_ADDITIONAL_DATA, $this->additional_data);
        }
        if ($this->isColumnModified(CategoriesTableMap::COL_COMPANY_ID)) {
            $criteria->add(CategoriesTableMap::COL_COMPANY_ID, $this->company_id);
        }
        if ($this->isColumnModified(CategoriesTableMap::COL_CREATED_AT)) {
            $criteria->add(CategoriesTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(CategoriesTableMap::COL_UPDATED_AT)) {
            $criteria->add(CategoriesTableMap::COL_UPDATED_AT, $this->updated_at);
        }
        if ($this->isColumnModified(CategoriesTableMap::COL_ORGUNIT_ID)) {
            $criteria->add(CategoriesTableMap::COL_ORGUNIT_ID, $this->orgunit_id);
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
        $criteria = ChildCategoriesQuery::create();
        $criteria->add(CategoriesTableMap::COL_ID, $this->id);

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
        $validPk = null !== $this->getId();

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
        return $this->getId();
    }

    /**
     * Generic method to set the primary key (id column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \entities\Categories (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setCategoryName($this->getCategoryName());
        $copyObj->setCategoryType($this->getCategoryType());
        $copyObj->setCategoryDescription($this->getCategoryDescription());
        $copyObj->setCategoryMedia($this->getCategoryMedia());
        $copyObj->setCategoryDisplayOrder($this->getCategoryDisplayOrder());
        $copyObj->setCategoryParentId($this->getCategoryParentId());
        $copyObj->setCategoryCode($this->getCategoryCode());
        $copyObj->setAdditionalData($this->getAdditionalData());
        $copyObj->setCompanyId($this->getCompanyId());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        $copyObj->setOrgunitId($this->getOrgunitId());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getProductss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addProducts($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setId(NULL); // this is a auto-increment column, so set to default value
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
     * @return \entities\Categories Clone of current object.
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
     * Declares an association between this object and a ChildOrgUnit object.
     *
     * @param ChildOrgUnit|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setOrgUnit(ChildOrgUnit $v = null)
    {
        if ($v === null) {
            $this->setOrgunitId(NULL);
        } else {
            $this->setOrgunitId($v->getOrgunitid());
        }

        $this->aOrgUnit = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildOrgUnit object, it will not be re-added.
        if ($v !== null) {
            $v->addCategories($this);
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
        if ($this->aOrgUnit === null && ($this->orgunit_id != 0)) {
            $this->aOrgUnit = ChildOrgUnitQuery::create()->findPk($this->orgunit_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aOrgUnit->addCategoriess($this);
             */
        }

        return $this->aOrgUnit;
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
            $v->addCategories($this);
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
                $this->aCompany->addCategoriess($this);
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
        if ('Products' === $relationName) {
            $this->initProductss();
            return;
        }
    }

    /**
     * Clears out the collProductss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addProductss()
     */
    public function clearProductss()
    {
        $this->collProductss = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collProductss collection loaded partially.
     *
     * @return void
     */
    public function resetPartialProductss($v = true): void
    {
        $this->collProductssPartial = $v;
    }

    /**
     * Initializes the collProductss collection.
     *
     * By default this just sets the collProductss collection to an empty array (like clearcollProductss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initProductss(bool $overrideExisting = true): void
    {
        if (null !== $this->collProductss && !$overrideExisting) {
            return;
        }

        $collectionClassName = ProductsTableMap::getTableMap()->getCollectionClassName();

        $this->collProductss = new $collectionClassName;
        $this->collProductss->setModel('\entities\Products');
    }

    /**
     * Gets an array of ChildProducts objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildCategories is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildProducts[] List of ChildProducts objects
     * @phpstan-return ObjectCollection&\Traversable<ChildProducts> List of ChildProducts objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getProductss(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collProductssPartial && !$this->isNew();
        if (null === $this->collProductss || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collProductss) {
                    $this->initProductss();
                } else {
                    $collectionClassName = ProductsTableMap::getTableMap()->getCollectionClassName();

                    $collProductss = new $collectionClassName;
                    $collProductss->setModel('\entities\Products');

                    return $collProductss;
                }
            } else {
                $collProductss = ChildProductsQuery::create(null, $criteria)
                    ->filterByCategories($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collProductssPartial && count($collProductss)) {
                        $this->initProductss(false);

                        foreach ($collProductss as $obj) {
                            if (false == $this->collProductss->contains($obj)) {
                                $this->collProductss->append($obj);
                            }
                        }

                        $this->collProductssPartial = true;
                    }

                    return $collProductss;
                }

                if ($partial && $this->collProductss) {
                    foreach ($this->collProductss as $obj) {
                        if ($obj->isNew()) {
                            $collProductss[] = $obj;
                        }
                    }
                }

                $this->collProductss = $collProductss;
                $this->collProductssPartial = false;
            }
        }

        return $this->collProductss;
    }

    /**
     * Sets a collection of ChildProducts objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $productss A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setProductss(Collection $productss, ?ConnectionInterface $con = null)
    {
        /** @var ChildProducts[] $productssToDelete */
        $productssToDelete = $this->getProductss(new Criteria(), $con)->diff($productss);


        $this->productssScheduledForDeletion = $productssToDelete;

        foreach ($productssToDelete as $productsRemoved) {
            $productsRemoved->setCategories(null);
        }

        $this->collProductss = null;
        foreach ($productss as $products) {
            $this->addProducts($products);
        }

        $this->collProductss = $productss;
        $this->collProductssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Products objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related Products objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countProductss(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collProductssPartial && !$this->isNew();
        if (null === $this->collProductss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collProductss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getProductss());
            }

            $query = ChildProductsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByCategories($this)
                ->count($con);
        }

        return count($this->collProductss);
    }

    /**
     * Method called to associate a ChildProducts object to this object
     * through the ChildProducts foreign key attribute.
     *
     * @param ChildProducts $l ChildProducts
     * @return $this The current object (for fluent API support)
     */
    public function addProducts(ChildProducts $l)
    {
        if ($this->collProductss === null) {
            $this->initProductss();
            $this->collProductssPartial = true;
        }

        if (!$this->collProductss->contains($l)) {
            $this->doAddProducts($l);

            if ($this->productssScheduledForDeletion and $this->productssScheduledForDeletion->contains($l)) {
                $this->productssScheduledForDeletion->remove($this->productssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildProducts $products The ChildProducts object to add.
     */
    protected function doAddProducts(ChildProducts $products): void
    {
        $this->collProductss[]= $products;
        $products->setCategories($this);
    }

    /**
     * @param ChildProducts $products The ChildProducts object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeProducts(ChildProducts $products)
    {
        if ($this->getProductss()->contains($products)) {
            $pos = $this->collProductss->search($products);
            $this->collProductss->remove($pos);
            if (null === $this->productssScheduledForDeletion) {
                $this->productssScheduledForDeletion = clone $this->collProductss;
                $this->productssScheduledForDeletion->clear();
            }
            $this->productssScheduledForDeletion[]= $products;
            $products->setCategories(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Categories is new, it will return
     * an empty collection; or if this Categories has previously
     * been saved, it will retrieve related Productss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Categories.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildProducts[] List of ChildProducts objects
     * @phpstan-return ObjectCollection&\Traversable<ChildProducts}> List of ChildProducts objects
     */
    public function getProductssJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildProductsQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getProductss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Categories is new, it will return
     * an empty collection; or if this Categories has previously
     * been saved, it will retrieve related Productss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Categories.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildProducts[] List of ChildProducts objects
     * @phpstan-return ObjectCollection&\Traversable<ChildProducts}> List of ChildProducts objects
     */
    public function getProductssJoinTags(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildProductsQuery::create(null, $criteria);
        $query->joinWith('Tags', $joinBehavior);

        return $this->getProductss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Categories is new, it will return
     * an empty collection; or if this Categories has previously
     * been saved, it will retrieve related Productss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Categories.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildProducts[] List of ChildProducts objects
     * @phpstan-return ObjectCollection&\Traversable<ChildProducts}> List of ChildProducts objects
     */
    public function getProductssJoinUnitmaster(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildProductsQuery::create(null, $criteria);
        $query->joinWith('Unitmaster', $joinBehavior);

        return $this->getProductss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Categories is new, it will return
     * an empty collection; or if this Categories has previously
     * been saved, it will retrieve related Productss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Categories.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildProducts[] List of ChildProducts objects
     * @phpstan-return ObjectCollection&\Traversable<ChildProducts}> List of ChildProducts objects
     */
    public function getProductssJoinBrands(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildProductsQuery::create(null, $criteria);
        $query->joinWith('Brands', $joinBehavior);

        return $this->getProductss($query, $con);
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
        if (null !== $this->aOrgUnit) {
            $this->aOrgUnit->removeCategories($this);
        }
        if (null !== $this->aCompany) {
            $this->aCompany->removeCategories($this);
        }
        $this->id = null;
        $this->category_name = null;
        $this->category_type = null;
        $this->category_description = null;
        $this->category_media = null;
        $this->category_display_order = null;
        $this->category_parent_id = null;
        $this->category_code = null;
        $this->additional_data = null;
        $this->company_id = null;
        $this->created_at = null;
        $this->updated_at = null;
        $this->orgunit_id = null;
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
            if ($this->collProductss) {
                foreach ($this->collProductss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collProductss = null;
        $this->aOrgUnit = null;
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
        return (string) $this->exportTo(CategoriesTableMap::DEFAULT_STRING_FORMAT);
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