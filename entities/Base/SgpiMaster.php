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
use entities\Brands as ChildBrands;
use entities\BrandsQuery as ChildBrandsQuery;
use entities\Company as ChildCompany;
use entities\CompanyQuery as ChildCompanyQuery;
use entities\DailycallsSgpiout as ChildDailycallsSgpiout;
use entities\DailycallsSgpioutQuery as ChildDailycallsSgpioutQuery;
use entities\OrgUnit as ChildOrgUnit;
use entities\OrgUnitQuery as ChildOrgUnitQuery;
use entities\OutletType as ChildOutletType;
use entities\OutletTypeQuery as ChildOutletTypeQuery;
use entities\SgpiMaster as ChildSgpiMaster;
use entities\SgpiMasterQuery as ChildSgpiMasterQuery;
use entities\SgpiTrans as ChildSgpiTrans;
use entities\SgpiTransQuery as ChildSgpiTransQuery;
use entities\Map\DailycallsSgpioutTableMap;
use entities\Map\SgpiMasterTableMap;
use entities\Map\SgpiTransTableMap;

/**
 * Base class that represents a row from the 'sgpi_master' table.
 *
 *
 *
 * @package    propel.generator.entities.Base
 */
abstract class SgpiMaster implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\entities\\Map\\SgpiMasterTableMap';


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
     * The value for the sgpi_id field.
     *
     * @var        int
     */
    protected $sgpi_id;

    /**
     * The value for the sgpi_name field.
     *
     * @var        string|null
     */
    protected $sgpi_name;

    /**
     * The value for the sgpi_code field.
     *
     * @var        string|null
     */
    protected $sgpi_code;

    /**
     * The value for the company_id field.
     *
     * @var        int|null
     */
    protected $company_id;

    /**
     * The value for the sgpi_status field.
     *
     * @var        string|null
     */
    protected $sgpi_status;

    /**
     * The value for the sgpi_media field.
     *
     * @var        int|null
     */
    protected $sgpi_media;

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
     * The value for the material_sku field.
     *
     * @var        string|null
     */
    protected $material_sku;

    /**
     * The value for the sgpi_type field.
     *
     * @var        string|null
     */
    protected $sgpi_type;

    /**
     * The value for the use_start_date field.
     *
     * @var        DateTime|null
     */
    protected $use_start_date;

    /**
     * The value for the use_end_date field.
     *
     * @var        DateTime|null
     */
    protected $use_end_date;

    /**
     * The value for the org_unit_id field.
     *
     * @var        int|null
     */
    protected $org_unit_id;

    /**
     * The value for the brand_id field.
     *
     * @var        int|null
     */
    protected $brand_id;

    /**
     * The value for the max_qty field.
     *
     * @var        int|null
     */
    protected $max_qty;

    /**
     * The value for the outlettype_id field.
     *
     * @var        int|null
     */
    protected $outlettype_id;

    /**
     * The value for the is_strategic field.
     *
     * Note: this column has a database default value of: false
     * @var        boolean|null
     */
    protected $is_strategic;

    /**
     * @var        ChildCompany
     */
    protected $aCompany;

    /**
     * @var        ChildBrands
     */
    protected $aBrands;

    /**
     * @var        ChildOrgUnit
     */
    protected $aOrgUnit;

    /**
     * @var        ChildOutletType
     */
    protected $aOutletType;

    /**
     * @var        ObjectCollection|ChildDailycallsSgpiout[] Collection to store aggregation of ChildDailycallsSgpiout objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildDailycallsSgpiout> Collection to store aggregation of ChildDailycallsSgpiout objects.
     */
    protected $collDailycallsSgpiouts;
    protected $collDailycallsSgpioutsPartial;

    /**
     * @var        ObjectCollection|ChildSgpiTrans[] Collection to store aggregation of ChildSgpiTrans objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSgpiTrans> Collection to store aggregation of ChildSgpiTrans objects.
     */
    protected $collSgpiTranss;
    protected $collSgpiTranssPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildDailycallsSgpiout[]
     * @phpstan-var ObjectCollection&\Traversable<ChildDailycallsSgpiout>
     */
    protected $dailycallsSgpioutsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSgpiTrans[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSgpiTrans>
     */
    protected $sgpiTranssScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues(): void
    {
        $this->is_strategic = false;
    }

    /**
     * Initializes internal state of entities\Base\SgpiMaster object.
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
     * Compares this with another <code>SgpiMaster</code> instance.  If
     * <code>obj</code> is an instance of <code>SgpiMaster</code>, delegates to
     * <code>equals(SgpiMaster)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [sgpi_id] column value.
     *
     * @return int
     */
    public function getSgpiId()
    {
        return $this->sgpi_id;
    }

    /**
     * Get the [sgpi_name] column value.
     *
     * @return string|null
     */
    public function getSgpiName()
    {
        return $this->sgpi_name;
    }

    /**
     * Get the [sgpi_code] column value.
     *
     * @return string|null
     */
    public function getSgpiCode()
    {
        return $this->sgpi_code;
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
     * Get the [sgpi_status] column value.
     *
     * @return string|null
     */
    public function getSgpiStatus()
    {
        return $this->sgpi_status;
    }

    /**
     * Get the [sgpi_media] column value.
     *
     * @return int|null
     */
    public function getSgpiMedia()
    {
        return $this->sgpi_media;
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
     * Get the [material_sku] column value.
     *
     * @return string|null
     */
    public function getMaterialSku()
    {
        return $this->material_sku;
    }

    /**
     * Get the [sgpi_type] column value.
     *
     * @return string|null
     */
    public function getSgpiType()
    {
        return $this->sgpi_type;
    }

    /**
     * Get the [optionally formatted] temporal [use_start_date] column value.
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
    public function getUseStartDate($format = null)
    {
        if ($format === null) {
            return $this->use_start_date;
        } else {
            return $this->use_start_date instanceof \DateTimeInterface ? $this->use_start_date->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [use_end_date] column value.
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
    public function getUseEndDate($format = null)
    {
        if ($format === null) {
            return $this->use_end_date;
        } else {
            return $this->use_end_date instanceof \DateTimeInterface ? $this->use_end_date->format($format) : null;
        }
    }

    /**
     * Get the [org_unit_id] column value.
     *
     * @return int|null
     */
    public function getOrgUnitId()
    {
        return $this->org_unit_id;
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
     * Get the [max_qty] column value.
     *
     * @return int|null
     */
    public function getMaxQty()
    {
        return $this->max_qty;
    }

    /**
     * Get the [outlettype_id] column value.
     *
     * @return int|null
     */
    public function getOutlettypeId()
    {
        return $this->outlettype_id;
    }

    /**
     * Get the [is_strategic] column value.
     *
     * @return boolean|null
     */
    public function getIsStrategic()
    {
        return $this->is_strategic;
    }

    /**
     * Get the [is_strategic] column value.
     *
     * @return boolean|null
     */
    public function isStrategic()
    {
        return $this->getIsStrategic();
    }

    /**
     * Set the value of [sgpi_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setSgpiId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->sgpi_id !== $v) {
            $this->sgpi_id = $v;
            $this->modifiedColumns[SgpiMasterTableMap::COL_SGPI_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [sgpi_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setSgpiName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->sgpi_name !== $v) {
            $this->sgpi_name = $v;
            $this->modifiedColumns[SgpiMasterTableMap::COL_SGPI_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [sgpi_code] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setSgpiCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->sgpi_code !== $v) {
            $this->sgpi_code = $v;
            $this->modifiedColumns[SgpiMasterTableMap::COL_SGPI_CODE] = true;
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
            $this->modifiedColumns[SgpiMasterTableMap::COL_COMPANY_ID] = true;
        }

        if ($this->aCompany !== null && $this->aCompany->getCompanyId() !== $v) {
            $this->aCompany = null;
        }

        return $this;
    }

    /**
     * Set the value of [sgpi_status] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setSgpiStatus($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->sgpi_status !== $v) {
            $this->sgpi_status = $v;
            $this->modifiedColumns[SgpiMasterTableMap::COL_SGPI_STATUS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [sgpi_media] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setSgpiMedia($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->sgpi_media !== $v) {
            $this->sgpi_media = $v;
            $this->modifiedColumns[SgpiMasterTableMap::COL_SGPI_MEDIA] = true;
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
                $this->modifiedColumns[SgpiMasterTableMap::COL_CREATED_AT] = true;
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
                $this->modifiedColumns[SgpiMasterTableMap::COL_UPDATED_AT] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [material_sku] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setMaterialSku($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->material_sku !== $v) {
            $this->material_sku = $v;
            $this->modifiedColumns[SgpiMasterTableMap::COL_MATERIAL_SKU] = true;
        }

        return $this;
    }

    /**
     * Set the value of [sgpi_type] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setSgpiType($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->sgpi_type !== $v) {
            $this->sgpi_type = $v;
            $this->modifiedColumns[SgpiMasterTableMap::COL_SGPI_TYPE] = true;
        }

        return $this;
    }

    /**
     * Sets the value of [use_start_date] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setUseStartDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->use_start_date !== null || $dt !== null) {
            if ($this->use_start_date === null || $dt === null || $dt->format("Y-m-d") !== $this->use_start_date->format("Y-m-d")) {
                $this->use_start_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[SgpiMasterTableMap::COL_USE_START_DATE] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Sets the value of [use_end_date] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setUseEndDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->use_end_date !== null || $dt !== null) {
            if ($this->use_end_date === null || $dt === null || $dt->format("Y-m-d") !== $this->use_end_date->format("Y-m-d")) {
                $this->use_end_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[SgpiMasterTableMap::COL_USE_END_DATE] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [org_unit_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOrgUnitId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->org_unit_id !== $v) {
            $this->org_unit_id = $v;
            $this->modifiedColumns[SgpiMasterTableMap::COL_ORG_UNIT_ID] = true;
        }

        if ($this->aOrgUnit !== null && $this->aOrgUnit->getOrgunitid() !== $v) {
            $this->aOrgUnit = null;
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
            $this->modifiedColumns[SgpiMasterTableMap::COL_BRAND_ID] = true;
        }

        if ($this->aBrands !== null && $this->aBrands->getBrandId() !== $v) {
            $this->aBrands = null;
        }

        return $this;
    }

    /**
     * Set the value of [max_qty] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setMaxQty($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->max_qty !== $v) {
            $this->max_qty = $v;
            $this->modifiedColumns[SgpiMasterTableMap::COL_MAX_QTY] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlettype_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOutlettypeId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->outlettype_id !== $v) {
            $this->outlettype_id = $v;
            $this->modifiedColumns[SgpiMasterTableMap::COL_OUTLETTYPE_ID] = true;
        }

        if ($this->aOutletType !== null && $this->aOutletType->getOutlettypeId() !== $v) {
            $this->aOutletType = null;
        }

        return $this;
    }

    /**
     * Sets the value of the [is_strategic] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param bool|integer|string|null $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setIsStrategic($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->is_strategic !== $v) {
            $this->is_strategic = $v;
            $this->modifiedColumns[SgpiMasterTableMap::COL_IS_STRATEGIC] = true;
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
            if ($this->is_strategic !== false) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SgpiMasterTableMap::translateFieldName('SgpiId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->sgpi_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SgpiMasterTableMap::translateFieldName('SgpiName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->sgpi_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SgpiMasterTableMap::translateFieldName('SgpiCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->sgpi_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : SgpiMasterTableMap::translateFieldName('CompanyId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->company_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : SgpiMasterTableMap::translateFieldName('SgpiStatus', TableMap::TYPE_PHPNAME, $indexType)];
            $this->sgpi_status = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : SgpiMasterTableMap::translateFieldName('SgpiMedia', TableMap::TYPE_PHPNAME, $indexType)];
            $this->sgpi_media = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : SgpiMasterTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : SgpiMasterTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : SgpiMasterTableMap::translateFieldName('MaterialSku', TableMap::TYPE_PHPNAME, $indexType)];
            $this->material_sku = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : SgpiMasterTableMap::translateFieldName('SgpiType', TableMap::TYPE_PHPNAME, $indexType)];
            $this->sgpi_type = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : SgpiMasterTableMap::translateFieldName('UseStartDate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->use_start_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : SgpiMasterTableMap::translateFieldName('UseEndDate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->use_end_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : SgpiMasterTableMap::translateFieldName('OrgUnitId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->org_unit_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : SgpiMasterTableMap::translateFieldName('BrandId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->brand_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : SgpiMasterTableMap::translateFieldName('MaxQty', TableMap::TYPE_PHPNAME, $indexType)];
            $this->max_qty = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : SgpiMasterTableMap::translateFieldName('OutlettypeId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlettype_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : SgpiMasterTableMap::translateFieldName('IsStrategic', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_strategic = (null !== $col) ? (boolean) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 17; // 17 = SgpiMasterTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\entities\\SgpiMaster'), 0, $e);
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
        if ($this->aOrgUnit !== null && $this->org_unit_id !== $this->aOrgUnit->getOrgunitid()) {
            $this->aOrgUnit = null;
        }
        if ($this->aBrands !== null && $this->brand_id !== $this->aBrands->getBrandId()) {
            $this->aBrands = null;
        }
        if ($this->aOutletType !== null && $this->outlettype_id !== $this->aOutletType->getOutlettypeId()) {
            $this->aOutletType = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(SgpiMasterTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSgpiMasterQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aCompany = null;
            $this->aBrands = null;
            $this->aOrgUnit = null;
            $this->aOutletType = null;
            $this->collDailycallsSgpiouts = null;

            $this->collSgpiTranss = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see SgpiMaster::setDeleted()
     * @see SgpiMaster::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SgpiMasterTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSgpiMasterQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(SgpiMasterTableMap::DATABASE_NAME);
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
                SgpiMasterTableMap::addInstanceToPool($this);
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

            if ($this->aOrgUnit !== null) {
                if ($this->aOrgUnit->isModified() || $this->aOrgUnit->isNew()) {
                    $affectedRows += $this->aOrgUnit->save($con);
                }
                $this->setOrgUnit($this->aOrgUnit);
            }

            if ($this->aOutletType !== null) {
                if ($this->aOutletType->isModified() || $this->aOutletType->isNew()) {
                    $affectedRows += $this->aOutletType->save($con);
                }
                $this->setOutletType($this->aOutletType);
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

            if ($this->dailycallsSgpioutsScheduledForDeletion !== null) {
                if (!$this->dailycallsSgpioutsScheduledForDeletion->isEmpty()) {
                    foreach ($this->dailycallsSgpioutsScheduledForDeletion as $dailycallsSgpiout) {
                        // need to save related object because we set the relation to null
                        $dailycallsSgpiout->save($con);
                    }
                    $this->dailycallsSgpioutsScheduledForDeletion = null;
                }
            }

            if ($this->collDailycallsSgpiouts !== null) {
                foreach ($this->collDailycallsSgpiouts as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->sgpiTranssScheduledForDeletion !== null) {
                if (!$this->sgpiTranssScheduledForDeletion->isEmpty()) {
                    foreach ($this->sgpiTranssScheduledForDeletion as $sgpiTrans) {
                        // need to save related object because we set the relation to null
                        $sgpiTrans->save($con);
                    }
                    $this->sgpiTranssScheduledForDeletion = null;
                }
            }

            if ($this->collSgpiTranss !== null) {
                foreach ($this->collSgpiTranss as $referrerFK) {
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

        $this->modifiedColumns[SgpiMasterTableMap::COL_SGPI_ID] = true;
        if (null !== $this->sgpi_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . SgpiMasterTableMap::COL_SGPI_ID . ')');
        }
        if (null === $this->sgpi_id) {
            try {
                $dataFetcher = $con->query("SELECT nextval('sgpi_master_sgpi_id_seq')");
                $this->sgpi_id = (int) $dataFetcher->fetchColumn();
            } catch (Exception $e) {
                throw new PropelException('Unable to get sequence id.', 0, $e);
            }
        }


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SgpiMasterTableMap::COL_SGPI_ID)) {
            $modifiedColumns[':p' . $index++]  = 'sgpi_id';
        }
        if ($this->isColumnModified(SgpiMasterTableMap::COL_SGPI_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'sgpi_name';
        }
        if ($this->isColumnModified(SgpiMasterTableMap::COL_SGPI_CODE)) {
            $modifiedColumns[':p' . $index++]  = 'sgpi_code';
        }
        if ($this->isColumnModified(SgpiMasterTableMap::COL_COMPANY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'company_id';
        }
        if ($this->isColumnModified(SgpiMasterTableMap::COL_SGPI_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'sgpi_status';
        }
        if ($this->isColumnModified(SgpiMasterTableMap::COL_SGPI_MEDIA)) {
            $modifiedColumns[':p' . $index++]  = 'sgpi_media';
        }
        if ($this->isColumnModified(SgpiMasterTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(SgpiMasterTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }
        if ($this->isColumnModified(SgpiMasterTableMap::COL_MATERIAL_SKU)) {
            $modifiedColumns[':p' . $index++]  = 'material_sku';
        }
        if ($this->isColumnModified(SgpiMasterTableMap::COL_SGPI_TYPE)) {
            $modifiedColumns[':p' . $index++]  = 'sgpi_type';
        }
        if ($this->isColumnModified(SgpiMasterTableMap::COL_USE_START_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'use_start_date';
        }
        if ($this->isColumnModified(SgpiMasterTableMap::COL_USE_END_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'use_end_date';
        }
        if ($this->isColumnModified(SgpiMasterTableMap::COL_ORG_UNIT_ID)) {
            $modifiedColumns[':p' . $index++]  = 'org_unit_id';
        }
        if ($this->isColumnModified(SgpiMasterTableMap::COL_BRAND_ID)) {
            $modifiedColumns[':p' . $index++]  = 'brand_id';
        }
        if ($this->isColumnModified(SgpiMasterTableMap::COL_MAX_QTY)) {
            $modifiedColumns[':p' . $index++]  = 'max_qty';
        }
        if ($this->isColumnModified(SgpiMasterTableMap::COL_OUTLETTYPE_ID)) {
            $modifiedColumns[':p' . $index++]  = 'outlettype_id';
        }
        if ($this->isColumnModified(SgpiMasterTableMap::COL_IS_STRATEGIC)) {
            $modifiedColumns[':p' . $index++]  = 'is_strategic';
        }

        $sql = sprintf(
            'INSERT INTO sgpi_master (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'sgpi_id':
                        $stmt->bindValue($identifier, $this->sgpi_id, PDO::PARAM_INT);

                        break;
                    case 'sgpi_name':
                        $stmt->bindValue($identifier, $this->sgpi_name, PDO::PARAM_STR);

                        break;
                    case 'sgpi_code':
                        $stmt->bindValue($identifier, $this->sgpi_code, PDO::PARAM_STR);

                        break;
                    case 'company_id':
                        $stmt->bindValue($identifier, $this->company_id, PDO::PARAM_INT);

                        break;
                    case 'sgpi_status':
                        $stmt->bindValue($identifier, $this->sgpi_status, PDO::PARAM_STR);

                        break;
                    case 'sgpi_media':
                        $stmt->bindValue($identifier, $this->sgpi_media, PDO::PARAM_INT);

                        break;
                    case 'created_at':
                        $stmt->bindValue($identifier, $this->created_at ? $this->created_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'updated_at':
                        $stmt->bindValue($identifier, $this->updated_at ? $this->updated_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'material_sku':
                        $stmt->bindValue($identifier, $this->material_sku, PDO::PARAM_STR);

                        break;
                    case 'sgpi_type':
                        $stmt->bindValue($identifier, $this->sgpi_type, PDO::PARAM_STR);

                        break;
                    case 'use_start_date':
                        $stmt->bindValue($identifier, $this->use_start_date ? $this->use_start_date->format("Y-m-d") : null, PDO::PARAM_STR);

                        break;
                    case 'use_end_date':
                        $stmt->bindValue($identifier, $this->use_end_date ? $this->use_end_date->format("Y-m-d") : null, PDO::PARAM_STR);

                        break;
                    case 'org_unit_id':
                        $stmt->bindValue($identifier, $this->org_unit_id, PDO::PARAM_INT);

                        break;
                    case 'brand_id':
                        $stmt->bindValue($identifier, $this->brand_id, PDO::PARAM_INT);

                        break;
                    case 'max_qty':
                        $stmt->bindValue($identifier, $this->max_qty, PDO::PARAM_INT);

                        break;
                    case 'outlettype_id':
                        $stmt->bindValue($identifier, $this->outlettype_id, PDO::PARAM_INT);

                        break;
                    case 'is_strategic':
                        $stmt->bindValue($identifier, $this->is_strategic, PDO::PARAM_BOOL);

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
        $pos = SgpiMasterTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getSgpiId();

            case 1:
                return $this->getSgpiName();

            case 2:
                return $this->getSgpiCode();

            case 3:
                return $this->getCompanyId();

            case 4:
                return $this->getSgpiStatus();

            case 5:
                return $this->getSgpiMedia();

            case 6:
                return $this->getCreatedAt();

            case 7:
                return $this->getUpdatedAt();

            case 8:
                return $this->getMaterialSku();

            case 9:
                return $this->getSgpiType();

            case 10:
                return $this->getUseStartDate();

            case 11:
                return $this->getUseEndDate();

            case 12:
                return $this->getOrgUnitId();

            case 13:
                return $this->getBrandId();

            case 14:
                return $this->getMaxQty();

            case 15:
                return $this->getOutlettypeId();

            case 16:
                return $this->getIsStrategic();

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
        if (isset($alreadyDumpedObjects['SgpiMaster'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['SgpiMaster'][$this->hashCode()] = true;
        $keys = SgpiMasterTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getSgpiId(),
            $keys[1] => $this->getSgpiName(),
            $keys[2] => $this->getSgpiCode(),
            $keys[3] => $this->getCompanyId(),
            $keys[4] => $this->getSgpiStatus(),
            $keys[5] => $this->getSgpiMedia(),
            $keys[6] => $this->getCreatedAt(),
            $keys[7] => $this->getUpdatedAt(),
            $keys[8] => $this->getMaterialSku(),
            $keys[9] => $this->getSgpiType(),
            $keys[10] => $this->getUseStartDate(),
            $keys[11] => $this->getUseEndDate(),
            $keys[12] => $this->getOrgUnitId(),
            $keys[13] => $this->getBrandId(),
            $keys[14] => $this->getMaxQty(),
            $keys[15] => $this->getOutlettypeId(),
            $keys[16] => $this->getIsStrategic(),
        ];
        if ($result[$keys[6]] instanceof \DateTimeInterface) {
            $result[$keys[6]] = $result[$keys[6]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[7]] instanceof \DateTimeInterface) {
            $result[$keys[7]] = $result[$keys[7]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[10]] instanceof \DateTimeInterface) {
            $result[$keys[10]] = $result[$keys[10]]->format('Y-m-d');
        }

        if ($result[$keys[11]] instanceof \DateTimeInterface) {
            $result[$keys[11]] = $result[$keys[11]]->format('Y-m-d');
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
            if (null !== $this->aOutletType) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'outletType';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'outlet_type';
                        break;
                    default:
                        $key = 'OutletType';
                }

                $result[$key] = $this->aOutletType->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collDailycallsSgpiouts) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'dailycallsSgpiouts';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'dailycalls_sgpiouts';
                        break;
                    default:
                        $key = 'DailycallsSgpiouts';
                }

                $result[$key] = $this->collDailycallsSgpiouts->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSgpiTranss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'sgpiTranss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'sgpi_transs';
                        break;
                    default:
                        $key = 'SgpiTranss';
                }

                $result[$key] = $this->collSgpiTranss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = SgpiMasterTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setSgpiId($value);
                break;
            case 1:
                $this->setSgpiName($value);
                break;
            case 2:
                $this->setSgpiCode($value);
                break;
            case 3:
                $this->setCompanyId($value);
                break;
            case 4:
                $this->setSgpiStatus($value);
                break;
            case 5:
                $this->setSgpiMedia($value);
                break;
            case 6:
                $this->setCreatedAt($value);
                break;
            case 7:
                $this->setUpdatedAt($value);
                break;
            case 8:
                $this->setMaterialSku($value);
                break;
            case 9:
                $this->setSgpiType($value);
                break;
            case 10:
                $this->setUseStartDate($value);
                break;
            case 11:
                $this->setUseEndDate($value);
                break;
            case 12:
                $this->setOrgUnitId($value);
                break;
            case 13:
                $this->setBrandId($value);
                break;
            case 14:
                $this->setMaxQty($value);
                break;
            case 15:
                $this->setOutlettypeId($value);
                break;
            case 16:
                $this->setIsStrategic($value);
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
        $keys = SgpiMasterTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setSgpiId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setSgpiName($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setSgpiCode($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setCompanyId($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setSgpiStatus($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setSgpiMedia($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setCreatedAt($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setUpdatedAt($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setMaterialSku($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setSgpiType($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setUseStartDate($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setUseEndDate($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setOrgUnitId($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setBrandId($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setMaxQty($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setOutlettypeId($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setIsStrategic($arr[$keys[16]]);
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
        $criteria = new Criteria(SgpiMasterTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SgpiMasterTableMap::COL_SGPI_ID)) {
            $criteria->add(SgpiMasterTableMap::COL_SGPI_ID, $this->sgpi_id);
        }
        if ($this->isColumnModified(SgpiMasterTableMap::COL_SGPI_NAME)) {
            $criteria->add(SgpiMasterTableMap::COL_SGPI_NAME, $this->sgpi_name);
        }
        if ($this->isColumnModified(SgpiMasterTableMap::COL_SGPI_CODE)) {
            $criteria->add(SgpiMasterTableMap::COL_SGPI_CODE, $this->sgpi_code);
        }
        if ($this->isColumnModified(SgpiMasterTableMap::COL_COMPANY_ID)) {
            $criteria->add(SgpiMasterTableMap::COL_COMPANY_ID, $this->company_id);
        }
        if ($this->isColumnModified(SgpiMasterTableMap::COL_SGPI_STATUS)) {
            $criteria->add(SgpiMasterTableMap::COL_SGPI_STATUS, $this->sgpi_status);
        }
        if ($this->isColumnModified(SgpiMasterTableMap::COL_SGPI_MEDIA)) {
            $criteria->add(SgpiMasterTableMap::COL_SGPI_MEDIA, $this->sgpi_media);
        }
        if ($this->isColumnModified(SgpiMasterTableMap::COL_CREATED_AT)) {
            $criteria->add(SgpiMasterTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(SgpiMasterTableMap::COL_UPDATED_AT)) {
            $criteria->add(SgpiMasterTableMap::COL_UPDATED_AT, $this->updated_at);
        }
        if ($this->isColumnModified(SgpiMasterTableMap::COL_MATERIAL_SKU)) {
            $criteria->add(SgpiMasterTableMap::COL_MATERIAL_SKU, $this->material_sku);
        }
        if ($this->isColumnModified(SgpiMasterTableMap::COL_SGPI_TYPE)) {
            $criteria->add(SgpiMasterTableMap::COL_SGPI_TYPE, $this->sgpi_type);
        }
        if ($this->isColumnModified(SgpiMasterTableMap::COL_USE_START_DATE)) {
            $criteria->add(SgpiMasterTableMap::COL_USE_START_DATE, $this->use_start_date);
        }
        if ($this->isColumnModified(SgpiMasterTableMap::COL_USE_END_DATE)) {
            $criteria->add(SgpiMasterTableMap::COL_USE_END_DATE, $this->use_end_date);
        }
        if ($this->isColumnModified(SgpiMasterTableMap::COL_ORG_UNIT_ID)) {
            $criteria->add(SgpiMasterTableMap::COL_ORG_UNIT_ID, $this->org_unit_id);
        }
        if ($this->isColumnModified(SgpiMasterTableMap::COL_BRAND_ID)) {
            $criteria->add(SgpiMasterTableMap::COL_BRAND_ID, $this->brand_id);
        }
        if ($this->isColumnModified(SgpiMasterTableMap::COL_MAX_QTY)) {
            $criteria->add(SgpiMasterTableMap::COL_MAX_QTY, $this->max_qty);
        }
        if ($this->isColumnModified(SgpiMasterTableMap::COL_OUTLETTYPE_ID)) {
            $criteria->add(SgpiMasterTableMap::COL_OUTLETTYPE_ID, $this->outlettype_id);
        }
        if ($this->isColumnModified(SgpiMasterTableMap::COL_IS_STRATEGIC)) {
            $criteria->add(SgpiMasterTableMap::COL_IS_STRATEGIC, $this->is_strategic);
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
        $criteria = ChildSgpiMasterQuery::create();
        $criteria->add(SgpiMasterTableMap::COL_SGPI_ID, $this->sgpi_id);

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
        $validPk = null !== $this->getSgpiId();

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
        return $this->getSgpiId();
    }

    /**
     * Generic method to set the primary key (sgpi_id column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setSgpiId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getSgpiId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \entities\SgpiMaster (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setSgpiName($this->getSgpiName());
        $copyObj->setSgpiCode($this->getSgpiCode());
        $copyObj->setCompanyId($this->getCompanyId());
        $copyObj->setSgpiStatus($this->getSgpiStatus());
        $copyObj->setSgpiMedia($this->getSgpiMedia());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        $copyObj->setMaterialSku($this->getMaterialSku());
        $copyObj->setSgpiType($this->getSgpiType());
        $copyObj->setUseStartDate($this->getUseStartDate());
        $copyObj->setUseEndDate($this->getUseEndDate());
        $copyObj->setOrgUnitId($this->getOrgUnitId());
        $copyObj->setBrandId($this->getBrandId());
        $copyObj->setMaxQty($this->getMaxQty());
        $copyObj->setOutlettypeId($this->getOutlettypeId());
        $copyObj->setIsStrategic($this->getIsStrategic());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getDailycallsSgpiouts() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addDailycallsSgpiout($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSgpiTranss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSgpiTrans($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setSgpiId(NULL); // this is a auto-increment column, so set to default value
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
     * @return \entities\SgpiMaster Clone of current object.
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
            $v->addSgpiMaster($this);
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
                $this->aCompany->addSgpiMasters($this);
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
            $v->addSgpiMaster($this);
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
                $this->aBrands->addSgpiMasters($this);
             */
        }

        return $this->aBrands;
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
            $this->setOrgUnitId(NULL);
        } else {
            $this->setOrgUnitId($v->getOrgunitid());
        }

        $this->aOrgUnit = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildOrgUnit object, it will not be re-added.
        if ($v !== null) {
            $v->addSgpiMaster($this);
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
        if ($this->aOrgUnit === null && ($this->org_unit_id != 0)) {
            $this->aOrgUnit = ChildOrgUnitQuery::create()->findPk($this->org_unit_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aOrgUnit->addSgpiMasters($this);
             */
        }

        return $this->aOrgUnit;
    }

    /**
     * Declares an association between this object and a ChildOutletType object.
     *
     * @param ChildOutletType|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setOutletType(ChildOutletType $v = null)
    {
        if ($v === null) {
            $this->setOutlettypeId(NULL);
        } else {
            $this->setOutlettypeId($v->getOutlettypeId());
        }

        $this->aOutletType = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildOutletType object, it will not be re-added.
        if ($v !== null) {
            $v->addSgpiMaster($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildOutletType object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildOutletType|null The associated ChildOutletType object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOutletType(?ConnectionInterface $con = null)
    {
        if ($this->aOutletType === null && ($this->outlettype_id != 0)) {
            $this->aOutletType = ChildOutletTypeQuery::create()->findPk($this->outlettype_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aOutletType->addSgpiMasters($this);
             */
        }

        return $this->aOutletType;
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
        if ('DailycallsSgpiout' === $relationName) {
            $this->initDailycallsSgpiouts();
            return;
        }
        if ('SgpiTrans' === $relationName) {
            $this->initSgpiTranss();
            return;
        }
    }

    /**
     * Clears out the collDailycallsSgpiouts collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addDailycallsSgpiouts()
     */
    public function clearDailycallsSgpiouts()
    {
        $this->collDailycallsSgpiouts = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collDailycallsSgpiouts collection loaded partially.
     *
     * @return void
     */
    public function resetPartialDailycallsSgpiouts($v = true): void
    {
        $this->collDailycallsSgpioutsPartial = $v;
    }

    /**
     * Initializes the collDailycallsSgpiouts collection.
     *
     * By default this just sets the collDailycallsSgpiouts collection to an empty array (like clearcollDailycallsSgpiouts());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initDailycallsSgpiouts(bool $overrideExisting = true): void
    {
        if (null !== $this->collDailycallsSgpiouts && !$overrideExisting) {
            return;
        }

        $collectionClassName = DailycallsSgpioutTableMap::getTableMap()->getCollectionClassName();

        $this->collDailycallsSgpiouts = new $collectionClassName;
        $this->collDailycallsSgpiouts->setModel('\entities\DailycallsSgpiout');
    }

    /**
     * Gets an array of ChildDailycallsSgpiout objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSgpiMaster is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildDailycallsSgpiout[] List of ChildDailycallsSgpiout objects
     * @phpstan-return ObjectCollection&\Traversable<ChildDailycallsSgpiout> List of ChildDailycallsSgpiout objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getDailycallsSgpiouts(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collDailycallsSgpioutsPartial && !$this->isNew();
        if (null === $this->collDailycallsSgpiouts || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collDailycallsSgpiouts) {
                    $this->initDailycallsSgpiouts();
                } else {
                    $collectionClassName = DailycallsSgpioutTableMap::getTableMap()->getCollectionClassName();

                    $collDailycallsSgpiouts = new $collectionClassName;
                    $collDailycallsSgpiouts->setModel('\entities\DailycallsSgpiout');

                    return $collDailycallsSgpiouts;
                }
            } else {
                $collDailycallsSgpiouts = ChildDailycallsSgpioutQuery::create(null, $criteria)
                    ->filterBySgpiMaster($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collDailycallsSgpioutsPartial && count($collDailycallsSgpiouts)) {
                        $this->initDailycallsSgpiouts(false);

                        foreach ($collDailycallsSgpiouts as $obj) {
                            if (false == $this->collDailycallsSgpiouts->contains($obj)) {
                                $this->collDailycallsSgpiouts->append($obj);
                            }
                        }

                        $this->collDailycallsSgpioutsPartial = true;
                    }

                    return $collDailycallsSgpiouts;
                }

                if ($partial && $this->collDailycallsSgpiouts) {
                    foreach ($this->collDailycallsSgpiouts as $obj) {
                        if ($obj->isNew()) {
                            $collDailycallsSgpiouts[] = $obj;
                        }
                    }
                }

                $this->collDailycallsSgpiouts = $collDailycallsSgpiouts;
                $this->collDailycallsSgpioutsPartial = false;
            }
        }

        return $this->collDailycallsSgpiouts;
    }

    /**
     * Sets a collection of ChildDailycallsSgpiout objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $dailycallsSgpiouts A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setDailycallsSgpiouts(Collection $dailycallsSgpiouts, ?ConnectionInterface $con = null)
    {
        /** @var ChildDailycallsSgpiout[] $dailycallsSgpioutsToDelete */
        $dailycallsSgpioutsToDelete = $this->getDailycallsSgpiouts(new Criteria(), $con)->diff($dailycallsSgpiouts);


        $this->dailycallsSgpioutsScheduledForDeletion = $dailycallsSgpioutsToDelete;

        foreach ($dailycallsSgpioutsToDelete as $dailycallsSgpioutRemoved) {
            $dailycallsSgpioutRemoved->setSgpiMaster(null);
        }

        $this->collDailycallsSgpiouts = null;
        foreach ($dailycallsSgpiouts as $dailycallsSgpiout) {
            $this->addDailycallsSgpiout($dailycallsSgpiout);
        }

        $this->collDailycallsSgpiouts = $dailycallsSgpiouts;
        $this->collDailycallsSgpioutsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related DailycallsSgpiout objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related DailycallsSgpiout objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countDailycallsSgpiouts(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collDailycallsSgpioutsPartial && !$this->isNew();
        if (null === $this->collDailycallsSgpiouts || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collDailycallsSgpiouts) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getDailycallsSgpiouts());
            }

            $query = ChildDailycallsSgpioutQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySgpiMaster($this)
                ->count($con);
        }

        return count($this->collDailycallsSgpiouts);
    }

    /**
     * Method called to associate a ChildDailycallsSgpiout object to this object
     * through the ChildDailycallsSgpiout foreign key attribute.
     *
     * @param ChildDailycallsSgpiout $l ChildDailycallsSgpiout
     * @return $this The current object (for fluent API support)
     */
    public function addDailycallsSgpiout(ChildDailycallsSgpiout $l)
    {
        if ($this->collDailycallsSgpiouts === null) {
            $this->initDailycallsSgpiouts();
            $this->collDailycallsSgpioutsPartial = true;
        }

        if (!$this->collDailycallsSgpiouts->contains($l)) {
            $this->doAddDailycallsSgpiout($l);

            if ($this->dailycallsSgpioutsScheduledForDeletion and $this->dailycallsSgpioutsScheduledForDeletion->contains($l)) {
                $this->dailycallsSgpioutsScheduledForDeletion->remove($this->dailycallsSgpioutsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildDailycallsSgpiout $dailycallsSgpiout The ChildDailycallsSgpiout object to add.
     */
    protected function doAddDailycallsSgpiout(ChildDailycallsSgpiout $dailycallsSgpiout): void
    {
        $this->collDailycallsSgpiouts[]= $dailycallsSgpiout;
        $dailycallsSgpiout->setSgpiMaster($this);
    }

    /**
     * @param ChildDailycallsSgpiout $dailycallsSgpiout The ChildDailycallsSgpiout object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeDailycallsSgpiout(ChildDailycallsSgpiout $dailycallsSgpiout)
    {
        if ($this->getDailycallsSgpiouts()->contains($dailycallsSgpiout)) {
            $pos = $this->collDailycallsSgpiouts->search($dailycallsSgpiout);
            $this->collDailycallsSgpiouts->remove($pos);
            if (null === $this->dailycallsSgpioutsScheduledForDeletion) {
                $this->dailycallsSgpioutsScheduledForDeletion = clone $this->collDailycallsSgpiouts;
                $this->dailycallsSgpioutsScheduledForDeletion->clear();
            }
            $this->dailycallsSgpioutsScheduledForDeletion[]= $dailycallsSgpiout;
            $dailycallsSgpiout->setSgpiMaster(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SgpiMaster is new, it will return
     * an empty collection; or if this SgpiMaster has previously
     * been saved, it will retrieve related DailycallsSgpiouts from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SgpiMaster.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildDailycallsSgpiout[] List of ChildDailycallsSgpiout objects
     * @phpstan-return ObjectCollection&\Traversable<ChildDailycallsSgpiout}> List of ChildDailycallsSgpiout objects
     */
    public function getDailycallsSgpioutsJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildDailycallsSgpioutQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getDailycallsSgpiouts($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SgpiMaster is new, it will return
     * an empty collection; or if this SgpiMaster has previously
     * been saved, it will retrieve related DailycallsSgpiouts from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SgpiMaster.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildDailycallsSgpiout[] List of ChildDailycallsSgpiout objects
     * @phpstan-return ObjectCollection&\Traversable<ChildDailycallsSgpiout}> List of ChildDailycallsSgpiout objects
     */
    public function getDailycallsSgpioutsJoinEmployee(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildDailycallsSgpioutQuery::create(null, $criteria);
        $query->joinWith('Employee', $joinBehavior);

        return $this->getDailycallsSgpiouts($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SgpiMaster is new, it will return
     * an empty collection; or if this SgpiMaster has previously
     * been saved, it will retrieve related DailycallsSgpiouts from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SgpiMaster.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildDailycallsSgpiout[] List of ChildDailycallsSgpiout objects
     * @phpstan-return ObjectCollection&\Traversable<ChildDailycallsSgpiout}> List of ChildDailycallsSgpiout objects
     */
    public function getDailycallsSgpioutsJoinOutlets(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildDailycallsSgpioutQuery::create(null, $criteria);
        $query->joinWith('Outlets', $joinBehavior);

        return $this->getDailycallsSgpiouts($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SgpiMaster is new, it will return
     * an empty collection; or if this SgpiMaster has previously
     * been saved, it will retrieve related DailycallsSgpiouts from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SgpiMaster.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildDailycallsSgpiout[] List of ChildDailycallsSgpiout objects
     * @phpstan-return ObjectCollection&\Traversable<ChildDailycallsSgpiout}> List of ChildDailycallsSgpiout objects
     */
    public function getDailycallsSgpioutsJoinOutletOrgData(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildDailycallsSgpioutQuery::create(null, $criteria);
        $query->joinWith('OutletOrgData', $joinBehavior);

        return $this->getDailycallsSgpiouts($query, $con);
    }

    /**
     * Clears out the collSgpiTranss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSgpiTranss()
     */
    public function clearSgpiTranss()
    {
        $this->collSgpiTranss = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSgpiTranss collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSgpiTranss($v = true): void
    {
        $this->collSgpiTranssPartial = $v;
    }

    /**
     * Initializes the collSgpiTranss collection.
     *
     * By default this just sets the collSgpiTranss collection to an empty array (like clearcollSgpiTranss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSgpiTranss(bool $overrideExisting = true): void
    {
        if (null !== $this->collSgpiTranss && !$overrideExisting) {
            return;
        }

        $collectionClassName = SgpiTransTableMap::getTableMap()->getCollectionClassName();

        $this->collSgpiTranss = new $collectionClassName;
        $this->collSgpiTranss->setModel('\entities\SgpiTrans');
    }

    /**
     * Gets an array of ChildSgpiTrans objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSgpiMaster is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSgpiTrans[] List of ChildSgpiTrans objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSgpiTrans> List of ChildSgpiTrans objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSgpiTranss(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSgpiTranssPartial && !$this->isNew();
        if (null === $this->collSgpiTranss || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSgpiTranss) {
                    $this->initSgpiTranss();
                } else {
                    $collectionClassName = SgpiTransTableMap::getTableMap()->getCollectionClassName();

                    $collSgpiTranss = new $collectionClassName;
                    $collSgpiTranss->setModel('\entities\SgpiTrans');

                    return $collSgpiTranss;
                }
            } else {
                $collSgpiTranss = ChildSgpiTransQuery::create(null, $criteria)
                    ->filterBySgpiMaster($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSgpiTranssPartial && count($collSgpiTranss)) {
                        $this->initSgpiTranss(false);

                        foreach ($collSgpiTranss as $obj) {
                            if (false == $this->collSgpiTranss->contains($obj)) {
                                $this->collSgpiTranss->append($obj);
                            }
                        }

                        $this->collSgpiTranssPartial = true;
                    }

                    return $collSgpiTranss;
                }

                if ($partial && $this->collSgpiTranss) {
                    foreach ($this->collSgpiTranss as $obj) {
                        if ($obj->isNew()) {
                            $collSgpiTranss[] = $obj;
                        }
                    }
                }

                $this->collSgpiTranss = $collSgpiTranss;
                $this->collSgpiTranssPartial = false;
            }
        }

        return $this->collSgpiTranss;
    }

    /**
     * Sets a collection of ChildSgpiTrans objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $sgpiTranss A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSgpiTranss(Collection $sgpiTranss, ?ConnectionInterface $con = null)
    {
        /** @var ChildSgpiTrans[] $sgpiTranssToDelete */
        $sgpiTranssToDelete = $this->getSgpiTranss(new Criteria(), $con)->diff($sgpiTranss);


        $this->sgpiTranssScheduledForDeletion = $sgpiTranssToDelete;

        foreach ($sgpiTranssToDelete as $sgpiTransRemoved) {
            $sgpiTransRemoved->setSgpiMaster(null);
        }

        $this->collSgpiTranss = null;
        foreach ($sgpiTranss as $sgpiTrans) {
            $this->addSgpiTrans($sgpiTrans);
        }

        $this->collSgpiTranss = $sgpiTranss;
        $this->collSgpiTranssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SgpiTrans objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SgpiTrans objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSgpiTranss(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSgpiTranssPartial && !$this->isNew();
        if (null === $this->collSgpiTranss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSgpiTranss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSgpiTranss());
            }

            $query = ChildSgpiTransQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySgpiMaster($this)
                ->count($con);
        }

        return count($this->collSgpiTranss);
    }

    /**
     * Method called to associate a ChildSgpiTrans object to this object
     * through the ChildSgpiTrans foreign key attribute.
     *
     * @param ChildSgpiTrans $l ChildSgpiTrans
     * @return $this The current object (for fluent API support)
     */
    public function addSgpiTrans(ChildSgpiTrans $l)
    {
        if ($this->collSgpiTranss === null) {
            $this->initSgpiTranss();
            $this->collSgpiTranssPartial = true;
        }

        if (!$this->collSgpiTranss->contains($l)) {
            $this->doAddSgpiTrans($l);

            if ($this->sgpiTranssScheduledForDeletion and $this->sgpiTranssScheduledForDeletion->contains($l)) {
                $this->sgpiTranssScheduledForDeletion->remove($this->sgpiTranssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSgpiTrans $sgpiTrans The ChildSgpiTrans object to add.
     */
    protected function doAddSgpiTrans(ChildSgpiTrans $sgpiTrans): void
    {
        $this->collSgpiTranss[]= $sgpiTrans;
        $sgpiTrans->setSgpiMaster($this);
    }

    /**
     * @param ChildSgpiTrans $sgpiTrans The ChildSgpiTrans object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSgpiTrans(ChildSgpiTrans $sgpiTrans)
    {
        if ($this->getSgpiTranss()->contains($sgpiTrans)) {
            $pos = $this->collSgpiTranss->search($sgpiTrans);
            $this->collSgpiTranss->remove($pos);
            if (null === $this->sgpiTranssScheduledForDeletion) {
                $this->sgpiTranssScheduledForDeletion = clone $this->collSgpiTranss;
                $this->sgpiTranssScheduledForDeletion->clear();
            }
            $this->sgpiTranssScheduledForDeletion[]= $sgpiTrans;
            $sgpiTrans->setSgpiMaster(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SgpiMaster is new, it will return
     * an empty collection; or if this SgpiMaster has previously
     * been saved, it will retrieve related SgpiTranss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SgpiMaster.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSgpiTrans[] List of ChildSgpiTrans objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSgpiTrans}> List of ChildSgpiTrans objects
     */
    public function getSgpiTranssJoinSgpiAccounts(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSgpiTransQuery::create(null, $criteria);
        $query->joinWith('SgpiAccounts', $joinBehavior);

        return $this->getSgpiTranss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SgpiMaster is new, it will return
     * an empty collection; or if this SgpiMaster has previously
     * been saved, it will retrieve related SgpiTranss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SgpiMaster.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSgpiTrans[] List of ChildSgpiTrans objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSgpiTrans}> List of ChildSgpiTrans objects
     */
    public function getSgpiTranssJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSgpiTransQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getSgpiTranss($query, $con);
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
            $this->aCompany->removeSgpiMaster($this);
        }
        if (null !== $this->aBrands) {
            $this->aBrands->removeSgpiMaster($this);
        }
        if (null !== $this->aOrgUnit) {
            $this->aOrgUnit->removeSgpiMaster($this);
        }
        if (null !== $this->aOutletType) {
            $this->aOutletType->removeSgpiMaster($this);
        }
        $this->sgpi_id = null;
        $this->sgpi_name = null;
        $this->sgpi_code = null;
        $this->company_id = null;
        $this->sgpi_status = null;
        $this->sgpi_media = null;
        $this->created_at = null;
        $this->updated_at = null;
        $this->material_sku = null;
        $this->sgpi_type = null;
        $this->use_start_date = null;
        $this->use_end_date = null;
        $this->org_unit_id = null;
        $this->brand_id = null;
        $this->max_qty = null;
        $this->outlettype_id = null;
        $this->is_strategic = null;
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
            if ($this->collDailycallsSgpiouts) {
                foreach ($this->collDailycallsSgpiouts as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSgpiTranss) {
                foreach ($this->collSgpiTranss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collDailycallsSgpiouts = null;
        $this->collSgpiTranss = null;
        $this->aCompany = null;
        $this->aBrands = null;
        $this->aOrgUnit = null;
        $this->aOutletType = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SgpiMasterTableMap::DEFAULT_STRING_FORMAT);
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
