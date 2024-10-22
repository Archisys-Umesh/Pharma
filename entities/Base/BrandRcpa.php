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
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;
use entities\BrandRcpaQuery as ChildBrandRcpaQuery;
use entities\Brands as ChildBrands;
use entities\BrandsQuery as ChildBrandsQuery;
use entities\Company as ChildCompany;
use entities\CompanyQuery as ChildCompanyQuery;
use entities\Employee as ChildEmployee;
use entities\EmployeeQuery as ChildEmployeeQuery;
use entities\Outlets as ChildOutlets;
use entities\OutletsQuery as ChildOutletsQuery;
use entities\Map\BrandRcpaTableMap;

/**
 * Base class that represents a row from the 'brand_rcpa' table.
 *
 *
 *
 * @package    propel.generator.entities.Base
 */
abstract class BrandRcpa implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\entities\\Map\\BrandRcpaTableMap';


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
     * The value for the brcpa_id field.
     *
     * @var        int
     */
    protected $brcpa_id;

    /**
     * The value for the outlet_id field.
     *
     * @var        int|null
     */
    protected $outlet_id;

    /**
     * The value for the retail_outlet_id field.
     *
     * @var        int|null
     */
    protected $retail_outlet_id;

    /**
     * The value for the employee_id field.
     *
     * @var        int|null
     */
    protected $employee_id;

    /**
     * The value for the rcpa_value field.
     *
     * @var        string|null
     */
    protected $rcpa_value;

    /**
     * The value for the brand_id field.
     *
     * @var        int|null
     */
    protected $brand_id;

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
     * The value for the rcpa_moye field.
     *
     * @var        string|null
     */
    protected $rcpa_moye;

    /**
     * The value for the competitor_id field.
     *
     * @var        int|null
     */
    protected $competitor_id;

    /**
     * The value for the ref_name field.
     *
     * @var        string|null
     */
    protected $ref_name;

    /**
     * The value for the product_id field.
     *
     * @var        int|null
     */
    protected $product_id;

    /**
     * The value for the brand_rcpa_lat_long field.
     *
     * @var        string|null
     */
    protected $brand_rcpa_lat_long;

    /**
     * The value for the brand_rcpa_address field.
     *
     * @var        string|null
     */
    protected $brand_rcpa_address;

    /**
     * @var        ChildCompany
     */
    protected $aCompany;

    /**
     * @var        ChildBrands
     */
    protected $aBrands;

    /**
     * @var        ChildEmployee
     */
    protected $aEmployee;

    /**
     * @var        ChildOutlets
     */
    protected $aOutlets;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

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
     * Initializes internal state of entities\Base\BrandRcpa object.
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
     * Compares this with another <code>BrandRcpa</code> instance.  If
     * <code>obj</code> is an instance of <code>BrandRcpa</code>, delegates to
     * <code>equals(BrandRcpa)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [brcpa_id] column value.
     *
     * @return int
     */
    public function getBrcpaId()
    {
        return $this->brcpa_id;
    }

    /**
     * Get the [outlet_id] column value.
     *
     * @return int|null
     */
    public function getOutletId()
    {
        return $this->outlet_id;
    }

    /**
     * Get the [retail_outlet_id] column value.
     *
     * @return int|null
     */
    public function getRetailOutletId()
    {
        return $this->retail_outlet_id;
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
     * Get the [rcpa_value] column value.
     *
     * @return string|null
     */
    public function getRcpaValue()
    {
        return $this->rcpa_value;
    }

    /**
     * Get the [brand_id] column value.
     *
     * @return int|null
     */
    public function getBrandId()
    {
        return $this->brand_id;
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
     * Get the [rcpa_moye] column value.
     *
     * @return string|null
     */
    public function getRcpaMoye()
    {
        return $this->rcpa_moye;
    }

    /**
     * Get the [competitor_id] column value.
     *
     * @return int|null
     */
    public function getCompetitorId()
    {
        return $this->competitor_id;
    }

    /**
     * Get the [ref_name] column value.
     *
     * @return string|null
     */
    public function getRefName()
    {
        return $this->ref_name;
    }

    /**
     * Get the [product_id] column value.
     *
     * @return int|null
     */
    public function getProductId()
    {
        return $this->product_id;
    }

    /**
     * Get the [brand_rcpa_lat_long] column value.
     *
     * @return string|null
     */
    public function getBrandRcpaLatLong()
    {
        return $this->brand_rcpa_lat_long;
    }

    /**
     * Get the [brand_rcpa_address] column value.
     *
     * @return string|null
     */
    public function getBrandRcpaAddress()
    {
        return $this->brand_rcpa_address;
    }

    /**
     * Set the value of [brcpa_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setBrcpaId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->brcpa_id !== $v) {
            $this->brcpa_id = $v;
            $this->modifiedColumns[BrandRcpaTableMap::COL_BRCPA_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOutletId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->outlet_id !== $v) {
            $this->outlet_id = $v;
            $this->modifiedColumns[BrandRcpaTableMap::COL_OUTLET_ID] = true;
        }

        if ($this->aOutlets !== null && $this->aOutlets->getId() !== $v) {
            $this->aOutlets = null;
        }

        return $this;
    }

    /**
     * Set the value of [retail_outlet_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setRetailOutletId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->retail_outlet_id !== $v) {
            $this->retail_outlet_id = $v;
            $this->modifiedColumns[BrandRcpaTableMap::COL_RETAIL_OUTLET_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [employee_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setEmployeeId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->employee_id !== $v) {
            $this->employee_id = $v;
            $this->modifiedColumns[BrandRcpaTableMap::COL_EMPLOYEE_ID] = true;
        }

        if ($this->aEmployee !== null && $this->aEmployee->getEmployeeId() !== $v) {
            $this->aEmployee = null;
        }

        return $this;
    }

    /**
     * Set the value of [rcpa_value] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setRcpaValue($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->rcpa_value !== $v) {
            $this->rcpa_value = $v;
            $this->modifiedColumns[BrandRcpaTableMap::COL_RCPA_VALUE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [brand_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setBrandId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->brand_id !== $v) {
            $this->brand_id = $v;
            $this->modifiedColumns[BrandRcpaTableMap::COL_BRAND_ID] = true;
        }

        if ($this->aBrands !== null && $this->aBrands->getBrandId() !== $v) {
            $this->aBrands = null;
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
            $this->modifiedColumns[BrandRcpaTableMap::COL_COMPANY_ID] = true;
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
                $this->modifiedColumns[BrandRcpaTableMap::COL_CREATED_AT] = true;
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
                $this->modifiedColumns[BrandRcpaTableMap::COL_UPDATED_AT] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [rcpa_moye] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setRcpaMoye($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->rcpa_moye !== $v) {
            $this->rcpa_moye = $v;
            $this->modifiedColumns[BrandRcpaTableMap::COL_RCPA_MOYE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [competitor_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCompetitorId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->competitor_id !== $v) {
            $this->competitor_id = $v;
            $this->modifiedColumns[BrandRcpaTableMap::COL_COMPETITOR_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [ref_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setRefName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->ref_name !== $v) {
            $this->ref_name = $v;
            $this->modifiedColumns[BrandRcpaTableMap::COL_REF_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [product_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setProductId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->product_id !== $v) {
            $this->product_id = $v;
            $this->modifiedColumns[BrandRcpaTableMap::COL_PRODUCT_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [brand_rcpa_lat_long] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setBrandRcpaLatLong($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->brand_rcpa_lat_long !== $v) {
            $this->brand_rcpa_lat_long = $v;
            $this->modifiedColumns[BrandRcpaTableMap::COL_BRAND_RCPA_LAT_LONG] = true;
        }

        return $this;
    }

    /**
     * Set the value of [brand_rcpa_address] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setBrandRcpaAddress($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->brand_rcpa_address !== $v) {
            $this->brand_rcpa_address = $v;
            $this->modifiedColumns[BrandRcpaTableMap::COL_BRAND_RCPA_ADDRESS] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : BrandRcpaTableMap::translateFieldName('BrcpaId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->brcpa_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : BrandRcpaTableMap::translateFieldName('OutletId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : BrandRcpaTableMap::translateFieldName('RetailOutletId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->retail_outlet_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : BrandRcpaTableMap::translateFieldName('EmployeeId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->employee_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : BrandRcpaTableMap::translateFieldName('RcpaValue', TableMap::TYPE_PHPNAME, $indexType)];
            $this->rcpa_value = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : BrandRcpaTableMap::translateFieldName('BrandId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->brand_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : BrandRcpaTableMap::translateFieldName('CompanyId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->company_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : BrandRcpaTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : BrandRcpaTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : BrandRcpaTableMap::translateFieldName('RcpaMoye', TableMap::TYPE_PHPNAME, $indexType)];
            $this->rcpa_moye = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : BrandRcpaTableMap::translateFieldName('CompetitorId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->competitor_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : BrandRcpaTableMap::translateFieldName('RefName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->ref_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : BrandRcpaTableMap::translateFieldName('ProductId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->product_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : BrandRcpaTableMap::translateFieldName('BrandRcpaLatLong', TableMap::TYPE_PHPNAME, $indexType)];
            $this->brand_rcpa_lat_long = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : BrandRcpaTableMap::translateFieldName('BrandRcpaAddress', TableMap::TYPE_PHPNAME, $indexType)];
            $this->brand_rcpa_address = (null !== $col) ? (string) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 15; // 15 = BrandRcpaTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\entities\\BrandRcpa'), 0, $e);
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
        if ($this->aOutlets !== null && $this->outlet_id !== $this->aOutlets->getId()) {
            $this->aOutlets = null;
        }
        if ($this->aEmployee !== null && $this->employee_id !== $this->aEmployee->getEmployeeId()) {
            $this->aEmployee = null;
        }
        if ($this->aBrands !== null && $this->brand_id !== $this->aBrands->getBrandId()) {
            $this->aBrands = null;
        }
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
            $con = Propel::getServiceContainer()->getReadConnection(BrandRcpaTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildBrandRcpaQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aCompany = null;
            $this->aBrands = null;
            $this->aEmployee = null;
            $this->aOutlets = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see BrandRcpa::setDeleted()
     * @see BrandRcpa::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(BrandRcpaTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildBrandRcpaQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(BrandRcpaTableMap::DATABASE_NAME);
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
                BrandRcpaTableMap::addInstanceToPool($this);
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

            if ($this->aBrands !== null) {
                if ($this->aBrands->isModified() || $this->aBrands->isNew()) {
                    $affectedRows += $this->aBrands->save($con);
                }
                $this->setBrands($this->aBrands);
            }

            if ($this->aEmployee !== null) {
                if ($this->aEmployee->isModified() || $this->aEmployee->isNew()) {
                    $affectedRows += $this->aEmployee->save($con);
                }
                $this->setEmployee($this->aEmployee);
            }

            if ($this->aOutlets !== null) {
                if ($this->aOutlets->isModified() || $this->aOutlets->isNew()) {
                    $affectedRows += $this->aOutlets->save($con);
                }
                $this->setOutlets($this->aOutlets);
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

        $this->modifiedColumns[BrandRcpaTableMap::COL_BRCPA_ID] = true;
        if (null !== $this->brcpa_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . BrandRcpaTableMap::COL_BRCPA_ID . ')');
        }
        if (null === $this->brcpa_id) {
            try {
                $dataFetcher = $con->query("SELECT nextval('brand_rcpa_brcpa_id_seq')");
                $this->brcpa_id = (int) $dataFetcher->fetchColumn();
            } catch (Exception $e) {
                throw new PropelException('Unable to get sequence id.', 0, $e);
            }
        }


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(BrandRcpaTableMap::COL_BRCPA_ID)) {
            $modifiedColumns[':p' . $index++]  = 'brcpa_id';
        }
        if ($this->isColumnModified(BrandRcpaTableMap::COL_OUTLET_ID)) {
            $modifiedColumns[':p' . $index++]  = 'outlet_id';
        }
        if ($this->isColumnModified(BrandRcpaTableMap::COL_RETAIL_OUTLET_ID)) {
            $modifiedColumns[':p' . $index++]  = 'retail_outlet_id';
        }
        if ($this->isColumnModified(BrandRcpaTableMap::COL_EMPLOYEE_ID)) {
            $modifiedColumns[':p' . $index++]  = 'employee_id';
        }
        if ($this->isColumnModified(BrandRcpaTableMap::COL_RCPA_VALUE)) {
            $modifiedColumns[':p' . $index++]  = 'rcpa_value';
        }
        if ($this->isColumnModified(BrandRcpaTableMap::COL_BRAND_ID)) {
            $modifiedColumns[':p' . $index++]  = 'brand_id';
        }
        if ($this->isColumnModified(BrandRcpaTableMap::COL_COMPANY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'company_id';
        }
        if ($this->isColumnModified(BrandRcpaTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(BrandRcpaTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }
        if ($this->isColumnModified(BrandRcpaTableMap::COL_RCPA_MOYE)) {
            $modifiedColumns[':p' . $index++]  = 'rcpa_moye';
        }
        if ($this->isColumnModified(BrandRcpaTableMap::COL_COMPETITOR_ID)) {
            $modifiedColumns[':p' . $index++]  = 'competitor_id';
        }
        if ($this->isColumnModified(BrandRcpaTableMap::COL_REF_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'ref_name';
        }
        if ($this->isColumnModified(BrandRcpaTableMap::COL_PRODUCT_ID)) {
            $modifiedColumns[':p' . $index++]  = 'product_id';
        }
        if ($this->isColumnModified(BrandRcpaTableMap::COL_BRAND_RCPA_LAT_LONG)) {
            $modifiedColumns[':p' . $index++]  = 'brand_rcpa_lat_long';
        }
        if ($this->isColumnModified(BrandRcpaTableMap::COL_BRAND_RCPA_ADDRESS)) {
            $modifiedColumns[':p' . $index++]  = 'brand_rcpa_address';
        }

        $sql = sprintf(
            'INSERT INTO brand_rcpa (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'brcpa_id':
                        $stmt->bindValue($identifier, $this->brcpa_id, PDO::PARAM_INT);

                        break;
                    case 'outlet_id':
                        $stmt->bindValue($identifier, $this->outlet_id, PDO::PARAM_INT);

                        break;
                    case 'retail_outlet_id':
                        $stmt->bindValue($identifier, $this->retail_outlet_id, PDO::PARAM_INT);

                        break;
                    case 'employee_id':
                        $stmt->bindValue($identifier, $this->employee_id, PDO::PARAM_INT);

                        break;
                    case 'rcpa_value':
                        $stmt->bindValue($identifier, $this->rcpa_value, PDO::PARAM_STR);

                        break;
                    case 'brand_id':
                        $stmt->bindValue($identifier, $this->brand_id, PDO::PARAM_INT);

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
                    case 'rcpa_moye':
                        $stmt->bindValue($identifier, $this->rcpa_moye, PDO::PARAM_STR);

                        break;
                    case 'competitor_id':
                        $stmt->bindValue($identifier, $this->competitor_id, PDO::PARAM_INT);

                        break;
                    case 'ref_name':
                        $stmt->bindValue($identifier, $this->ref_name, PDO::PARAM_STR);

                        break;
                    case 'product_id':
                        $stmt->bindValue($identifier, $this->product_id, PDO::PARAM_INT);

                        break;
                    case 'brand_rcpa_lat_long':
                        $stmt->bindValue($identifier, $this->brand_rcpa_lat_long, PDO::PARAM_STR);

                        break;
                    case 'brand_rcpa_address':
                        $stmt->bindValue($identifier, $this->brand_rcpa_address, PDO::PARAM_STR);

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
        $pos = BrandRcpaTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getBrcpaId();

            case 1:
                return $this->getOutletId();

            case 2:
                return $this->getRetailOutletId();

            case 3:
                return $this->getEmployeeId();

            case 4:
                return $this->getRcpaValue();

            case 5:
                return $this->getBrandId();

            case 6:
                return $this->getCompanyId();

            case 7:
                return $this->getCreatedAt();

            case 8:
                return $this->getUpdatedAt();

            case 9:
                return $this->getRcpaMoye();

            case 10:
                return $this->getCompetitorId();

            case 11:
                return $this->getRefName();

            case 12:
                return $this->getProductId();

            case 13:
                return $this->getBrandRcpaLatLong();

            case 14:
                return $this->getBrandRcpaAddress();

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
        if (isset($alreadyDumpedObjects['BrandRcpa'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['BrandRcpa'][$this->hashCode()] = true;
        $keys = BrandRcpaTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getBrcpaId(),
            $keys[1] => $this->getOutletId(),
            $keys[2] => $this->getRetailOutletId(),
            $keys[3] => $this->getEmployeeId(),
            $keys[4] => $this->getRcpaValue(),
            $keys[5] => $this->getBrandId(),
            $keys[6] => $this->getCompanyId(),
            $keys[7] => $this->getCreatedAt(),
            $keys[8] => $this->getUpdatedAt(),
            $keys[9] => $this->getRcpaMoye(),
            $keys[10] => $this->getCompetitorId(),
            $keys[11] => $this->getRefName(),
            $keys[12] => $this->getProductId(),
            $keys[13] => $this->getBrandRcpaLatLong(),
            $keys[14] => $this->getBrandRcpaAddress(),
        ];
        if ($result[$keys[7]] instanceof \DateTimeInterface) {
            $result[$keys[7]] = $result[$keys[7]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[8]] instanceof \DateTimeInterface) {
            $result[$keys[8]] = $result[$keys[8]]->format('Y-m-d H:i:s.u');
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
            if (null !== $this->aBrands) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'brands';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'brands';
                        break;
                    default:
                        $key = 'Brands';
                }

                $result[$key] = $this->aBrands->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aEmployee) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'employee';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'employee';
                        break;
                    default:
                        $key = 'Employee';
                }

                $result[$key] = $this->aEmployee->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aOutlets) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'outlets';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'outlets';
                        break;
                    default:
                        $key = 'Outlets';
                }

                $result[$key] = $this->aOutlets->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
        $pos = BrandRcpaTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setBrcpaId($value);
                break;
            case 1:
                $this->setOutletId($value);
                break;
            case 2:
                $this->setRetailOutletId($value);
                break;
            case 3:
                $this->setEmployeeId($value);
                break;
            case 4:
                $this->setRcpaValue($value);
                break;
            case 5:
                $this->setBrandId($value);
                break;
            case 6:
                $this->setCompanyId($value);
                break;
            case 7:
                $this->setCreatedAt($value);
                break;
            case 8:
                $this->setUpdatedAt($value);
                break;
            case 9:
                $this->setRcpaMoye($value);
                break;
            case 10:
                $this->setCompetitorId($value);
                break;
            case 11:
                $this->setRefName($value);
                break;
            case 12:
                $this->setProductId($value);
                break;
            case 13:
                $this->setBrandRcpaLatLong($value);
                break;
            case 14:
                $this->setBrandRcpaAddress($value);
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
        $keys = BrandRcpaTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setBrcpaId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setOutletId($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setRetailOutletId($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setEmployeeId($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setRcpaValue($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setBrandId($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setCompanyId($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setCreatedAt($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setUpdatedAt($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setRcpaMoye($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setCompetitorId($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setRefName($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setProductId($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setBrandRcpaLatLong($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setBrandRcpaAddress($arr[$keys[14]]);
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
        $criteria = new Criteria(BrandRcpaTableMap::DATABASE_NAME);

        if ($this->isColumnModified(BrandRcpaTableMap::COL_BRCPA_ID)) {
            $criteria->add(BrandRcpaTableMap::COL_BRCPA_ID, $this->brcpa_id);
        }
        if ($this->isColumnModified(BrandRcpaTableMap::COL_OUTLET_ID)) {
            $criteria->add(BrandRcpaTableMap::COL_OUTLET_ID, $this->outlet_id);
        }
        if ($this->isColumnModified(BrandRcpaTableMap::COL_RETAIL_OUTLET_ID)) {
            $criteria->add(BrandRcpaTableMap::COL_RETAIL_OUTLET_ID, $this->retail_outlet_id);
        }
        if ($this->isColumnModified(BrandRcpaTableMap::COL_EMPLOYEE_ID)) {
            $criteria->add(BrandRcpaTableMap::COL_EMPLOYEE_ID, $this->employee_id);
        }
        if ($this->isColumnModified(BrandRcpaTableMap::COL_RCPA_VALUE)) {
            $criteria->add(BrandRcpaTableMap::COL_RCPA_VALUE, $this->rcpa_value);
        }
        if ($this->isColumnModified(BrandRcpaTableMap::COL_BRAND_ID)) {
            $criteria->add(BrandRcpaTableMap::COL_BRAND_ID, $this->brand_id);
        }
        if ($this->isColumnModified(BrandRcpaTableMap::COL_COMPANY_ID)) {
            $criteria->add(BrandRcpaTableMap::COL_COMPANY_ID, $this->company_id);
        }
        if ($this->isColumnModified(BrandRcpaTableMap::COL_CREATED_AT)) {
            $criteria->add(BrandRcpaTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(BrandRcpaTableMap::COL_UPDATED_AT)) {
            $criteria->add(BrandRcpaTableMap::COL_UPDATED_AT, $this->updated_at);
        }
        if ($this->isColumnModified(BrandRcpaTableMap::COL_RCPA_MOYE)) {
            $criteria->add(BrandRcpaTableMap::COL_RCPA_MOYE, $this->rcpa_moye);
        }
        if ($this->isColumnModified(BrandRcpaTableMap::COL_COMPETITOR_ID)) {
            $criteria->add(BrandRcpaTableMap::COL_COMPETITOR_ID, $this->competitor_id);
        }
        if ($this->isColumnModified(BrandRcpaTableMap::COL_REF_NAME)) {
            $criteria->add(BrandRcpaTableMap::COL_REF_NAME, $this->ref_name);
        }
        if ($this->isColumnModified(BrandRcpaTableMap::COL_PRODUCT_ID)) {
            $criteria->add(BrandRcpaTableMap::COL_PRODUCT_ID, $this->product_id);
        }
        if ($this->isColumnModified(BrandRcpaTableMap::COL_BRAND_RCPA_LAT_LONG)) {
            $criteria->add(BrandRcpaTableMap::COL_BRAND_RCPA_LAT_LONG, $this->brand_rcpa_lat_long);
        }
        if ($this->isColumnModified(BrandRcpaTableMap::COL_BRAND_RCPA_ADDRESS)) {
            $criteria->add(BrandRcpaTableMap::COL_BRAND_RCPA_ADDRESS, $this->brand_rcpa_address);
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
        $criteria = ChildBrandRcpaQuery::create();
        $criteria->add(BrandRcpaTableMap::COL_BRCPA_ID, $this->brcpa_id);

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
        $validPk = null !== $this->getBrcpaId();

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
        return $this->getBrcpaId();
    }

    /**
     * Generic method to set the primary key (brcpa_id column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setBrcpaId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getBrcpaId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \entities\BrandRcpa (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setOutletId($this->getOutletId());
        $copyObj->setRetailOutletId($this->getRetailOutletId());
        $copyObj->setEmployeeId($this->getEmployeeId());
        $copyObj->setRcpaValue($this->getRcpaValue());
        $copyObj->setBrandId($this->getBrandId());
        $copyObj->setCompanyId($this->getCompanyId());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        $copyObj->setRcpaMoye($this->getRcpaMoye());
        $copyObj->setCompetitorId($this->getCompetitorId());
        $copyObj->setRefName($this->getRefName());
        $copyObj->setProductId($this->getProductId());
        $copyObj->setBrandRcpaLatLong($this->getBrandRcpaLatLong());
        $copyObj->setBrandRcpaAddress($this->getBrandRcpaAddress());
        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setBrcpaId(NULL); // this is a auto-increment column, so set to default value
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
     * @return \entities\BrandRcpa Clone of current object.
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
            $v->addBrandRcpa($this);
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
                $this->aCompany->addBrandRcpas($this);
             */
        }

        return $this->aCompany;
    }

    /**
     * Declares an association between this object and a ChildBrands object.
     *
     * @param ChildBrands|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setBrands(ChildBrands $v = null)
    {
        if ($v === null) {
            $this->setBrandId(NULL);
        } else {
            $this->setBrandId($v->getBrandId());
        }

        $this->aBrands = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildBrands object, it will not be re-added.
        if ($v !== null) {
            $v->addBrandRcpa($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildBrands object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildBrands|null The associated ChildBrands object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getBrands(?ConnectionInterface $con = null)
    {
        if ($this->aBrands === null && ($this->brand_id != 0)) {
            $this->aBrands = ChildBrandsQuery::create()->findPk($this->brand_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aBrands->addBrandRcpas($this);
             */
        }

        return $this->aBrands;
    }

    /**
     * Declares an association between this object and a ChildEmployee object.
     *
     * @param ChildEmployee|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setEmployee(ChildEmployee $v = null)
    {
        if ($v === null) {
            $this->setEmployeeId(NULL);
        } else {
            $this->setEmployeeId($v->getEmployeeId());
        }

        $this->aEmployee = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildEmployee object, it will not be re-added.
        if ($v !== null) {
            $v->addBrandRcpa($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildEmployee object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildEmployee|null The associated ChildEmployee object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getEmployee(?ConnectionInterface $con = null)
    {
        if ($this->aEmployee === null && ($this->employee_id != 0)) {
            $this->aEmployee = ChildEmployeeQuery::create()->findPk($this->employee_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aEmployee->addBrandRcpas($this);
             */
        }

        return $this->aEmployee;
    }

    /**
     * Declares an association between this object and a ChildOutlets object.
     *
     * @param ChildOutlets|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setOutlets(ChildOutlets $v = null)
    {
        if ($v === null) {
            $this->setOutletId(NULL);
        } else {
            $this->setOutletId($v->getId());
        }

        $this->aOutlets = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildOutlets object, it will not be re-added.
        if ($v !== null) {
            $v->addBrandRcpa($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildOutlets object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildOutlets|null The associated ChildOutlets object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOutlets(?ConnectionInterface $con = null)
    {
        if ($this->aOutlets === null && ($this->outlet_id != 0)) {
            $this->aOutlets = ChildOutletsQuery::create()->findPk($this->outlet_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aOutlets->addBrandRcpas($this);
             */
        }

        return $this->aOutlets;
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
            $this->aCompany->removeBrandRcpa($this);
        }
        if (null !== $this->aBrands) {
            $this->aBrands->removeBrandRcpa($this);
        }
        if (null !== $this->aEmployee) {
            $this->aEmployee->removeBrandRcpa($this);
        }
        if (null !== $this->aOutlets) {
            $this->aOutlets->removeBrandRcpa($this);
        }
        $this->brcpa_id = null;
        $this->outlet_id = null;
        $this->retail_outlet_id = null;
        $this->employee_id = null;
        $this->rcpa_value = null;
        $this->brand_id = null;
        $this->company_id = null;
        $this->created_at = null;
        $this->updated_at = null;
        $this->rcpa_moye = null;
        $this->competitor_id = null;
        $this->ref_name = null;
        $this->product_id = null;
        $this->brand_rcpa_lat_long = null;
        $this->brand_rcpa_address = null;
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
        } // if ($deep)

        $this->aCompany = null;
        $this->aBrands = null;
        $this->aEmployee = null;
        $this->aOutlets = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(BrandRcpaTableMap::DEFAULT_STRING_FORMAT);
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
