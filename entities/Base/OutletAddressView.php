<?php

namespace entities\Base;

use \DateTime;
use \Exception;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;
use entities\OutletAddressViewQuery as ChildOutletAddressViewQuery;
use entities\Map\OutletAddressViewTableMap;

/**
 * Base class that represents a row from the 'outlet_address_view' table.
 *
 *
 *
 * @package    propel.generator.entities.Base
 */
abstract class OutletAddressView implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\entities\\Map\\OutletAddressViewTableMap';


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
     * The value for the outlet_address_id field.
     *
     * @var        int
     */
    protected $outlet_address_id;

    /**
     * The value for the outlet_address field.
     *
     * @var        string|null
     */
    protected $outlet_address;

    /**
     * The value for the outlet_street_name field.
     *
     * @var        string|null
     */
    protected $outlet_street_name;

    /**
     * The value for the outlet_city field.
     *
     * @var        string|null
     */
    protected $outlet_city;

    /**
     * The value for the outlet_state field.
     *
     * @var        string|null
     */
    protected $outlet_state;

    /**
     * The value for the outlet_country field.
     *
     * @var        string|null
     */
    protected $outlet_country;

    /**
     * The value for the outlet_pincode field.
     *
     * @var        string|null
     */
    protected $outlet_pincode;

    /**
     * The value for the outlet_id field.
     *
     * @var        int|null
     */
    protected $outlet_id;

    /**
     * The value for the outlet_gps field.
     *
     * @var        string|null
     */
    protected $outlet_gps;

    /**
     * The value for the company_id field.
     *
     * @var        int|null
     */
    protected $company_id;

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
     * The value for the address_name field.
     *
     * @var        string|null
     */
    protected $address_name;

    /**
     * The value for the is_default field.
     *
     * @var        int|null
     */
    protected $is_default;

    /**
     * The value for the outlet_org_id field.
     *
     * @var        int|null
     */
    protected $outlet_org_id;

    /**
     * The value for the org_unit_id field.
     *
     * @var        int|null
     */
    protected $org_unit_id;

    /**
     * The value for the territory_id field.
     *
     * @var        int|null
     */
    protected $territory_id;

    /**
     * The value for the territory_name field.
     *
     * @var        string|null
     */
    protected $territory_name;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * Initializes internal state of entities\Base\OutletAddressView object.
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
     * Compares this with another <code>OutletAddressView</code> instance.  If
     * <code>obj</code> is an instance of <code>OutletAddressView</code>, delegates to
     * <code>equals(OutletAddressView)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [outlet_address_id] column value.
     *
     * @return int
     */
    public function getOutletAddressId()
    {
        return $this->outlet_address_id;
    }

    /**
     * Get the [outlet_address] column value.
     *
     * @return string|null
     */
    public function getOutletAddress()
    {
        return $this->outlet_address;
    }

    /**
     * Get the [outlet_street_name] column value.
     *
     * @return string|null
     */
    public function getOutletStreetName()
    {
        return $this->outlet_street_name;
    }

    /**
     * Get the [outlet_city] column value.
     *
     * @return string|null
     */
    public function getOutletCity()
    {
        return $this->outlet_city;
    }

    /**
     * Get the [outlet_state] column value.
     *
     * @return string|null
     */
    public function getOutletState()
    {
        return $this->outlet_state;
    }

    /**
     * Get the [outlet_country] column value.
     *
     * @return string|null
     */
    public function getOutletCountry()
    {
        return $this->outlet_country;
    }

    /**
     * Get the [outlet_pincode] column value.
     *
     * @return string|null
     */
    public function getOutletPincode()
    {
        return $this->outlet_pincode;
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
     * Get the [outlet_gps] column value.
     *
     * @return string|null
     */
    public function getOutletGps()
    {
        return $this->outlet_gps;
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
     * Get the [address_name] column value.
     *
     * @return string|null
     */
    public function getAddressName()
    {
        return $this->address_name;
    }

    /**
     * Get the [is_default] column value.
     *
     * @return int|null
     */
    public function getIsDefault()
    {
        return $this->is_default;
    }

    /**
     * Get the [outlet_org_id] column value.
     *
     * @return int|null
     */
    public function getOutletOrgId()
    {
        return $this->outlet_org_id;
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
     * Get the [territory_id] column value.
     *
     * @return int|null
     */
    public function getTerritoryId()
    {
        return $this->territory_id;
    }

    /**
     * Get the [territory_name] column value.
     *
     * @return string|null
     */
    public function getTerritoryName()
    {
        return $this->territory_name;
    }

    /**
     * Set the value of [outlet_address_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOutletAddressId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->outlet_address_id !== $v) {
            $this->outlet_address_id = $v;
            $this->modifiedColumns[OutletAddressViewTableMap::COL_OUTLET_ADDRESS_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_address] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOutletAddress($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->outlet_address !== $v) {
            $this->outlet_address = $v;
            $this->modifiedColumns[OutletAddressViewTableMap::COL_OUTLET_ADDRESS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_street_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOutletStreetName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->outlet_street_name !== $v) {
            $this->outlet_street_name = $v;
            $this->modifiedColumns[OutletAddressViewTableMap::COL_OUTLET_STREET_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_city] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOutletCity($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->outlet_city !== $v) {
            $this->outlet_city = $v;
            $this->modifiedColumns[OutletAddressViewTableMap::COL_OUTLET_CITY] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_state] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOutletState($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->outlet_state !== $v) {
            $this->outlet_state = $v;
            $this->modifiedColumns[OutletAddressViewTableMap::COL_OUTLET_STATE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_country] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOutletCountry($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->outlet_country !== $v) {
            $this->outlet_country = $v;
            $this->modifiedColumns[OutletAddressViewTableMap::COL_OUTLET_COUNTRY] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_pincode] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOutletPincode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->outlet_pincode !== $v) {
            $this->outlet_pincode = $v;
            $this->modifiedColumns[OutletAddressViewTableMap::COL_OUTLET_PINCODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOutletId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->outlet_id !== $v) {
            $this->outlet_id = $v;
            $this->modifiedColumns[OutletAddressViewTableMap::COL_OUTLET_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_gps] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOutletGps($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->outlet_gps !== $v) {
            $this->outlet_gps = $v;
            $this->modifiedColumns[OutletAddressViewTableMap::COL_OUTLET_GPS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [company_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setCompanyId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->company_id !== $v) {
            $this->company_id = $v;
            $this->modifiedColumns[OutletAddressViewTableMap::COL_COMPANY_ID] = true;
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
    protected function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            if ($this->created_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->created_at->format("Y-m-d H:i:s.u")) {
                $this->created_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[OutletAddressViewTableMap::COL_CREATED_AT] = true;
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
    protected function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            if ($this->updated_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->updated_at->format("Y-m-d H:i:s.u")) {
                $this->updated_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[OutletAddressViewTableMap::COL_UPDATED_AT] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [address_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setAddressName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->address_name !== $v) {
            $this->address_name = $v;
            $this->modifiedColumns[OutletAddressViewTableMap::COL_ADDRESS_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [is_default] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setIsDefault($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->is_default !== $v) {
            $this->is_default = $v;
            $this->modifiedColumns[OutletAddressViewTableMap::COL_IS_DEFAULT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_org_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOutletOrgId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->outlet_org_id !== $v) {
            $this->outlet_org_id = $v;
            $this->modifiedColumns[OutletAddressViewTableMap::COL_OUTLET_ORG_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [org_unit_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOrgUnitId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->org_unit_id !== $v) {
            $this->org_unit_id = $v;
            $this->modifiedColumns[OutletAddressViewTableMap::COL_ORG_UNIT_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [territory_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setTerritoryId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->territory_id !== $v) {
            $this->territory_id = $v;
            $this->modifiedColumns[OutletAddressViewTableMap::COL_TERRITORY_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [territory_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setTerritoryName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->territory_name !== $v) {
            $this->territory_name = $v;
            $this->modifiedColumns[OutletAddressViewTableMap::COL_TERRITORY_NAME] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : OutletAddressViewTableMap::translateFieldName('OutletAddressId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_address_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : OutletAddressViewTableMap::translateFieldName('OutletAddress', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_address = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : OutletAddressViewTableMap::translateFieldName('OutletStreetName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_street_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : OutletAddressViewTableMap::translateFieldName('OutletCity', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_city = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : OutletAddressViewTableMap::translateFieldName('OutletState', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_state = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : OutletAddressViewTableMap::translateFieldName('OutletCountry', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_country = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : OutletAddressViewTableMap::translateFieldName('OutletPincode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_pincode = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : OutletAddressViewTableMap::translateFieldName('OutletId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : OutletAddressViewTableMap::translateFieldName('OutletGps', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_gps = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : OutletAddressViewTableMap::translateFieldName('CompanyId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->company_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : OutletAddressViewTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : OutletAddressViewTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : OutletAddressViewTableMap::translateFieldName('AddressName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->address_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : OutletAddressViewTableMap::translateFieldName('IsDefault', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_default = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : OutletAddressViewTableMap::translateFieldName('OutletOrgId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_org_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : OutletAddressViewTableMap::translateFieldName('OrgUnitId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->org_unit_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : OutletAddressViewTableMap::translateFieldName('TerritoryId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->territory_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : OutletAddressViewTableMap::translateFieldName('TerritoryName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->territory_name = (null !== $col) ? (string) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 18; // 18 = OutletAddressViewTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\entities\\OutletAddressView'), 0, $e);
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
        $pos = OutletAddressViewTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getOutletAddressId();

            case 1:
                return $this->getOutletAddress();

            case 2:
                return $this->getOutletStreetName();

            case 3:
                return $this->getOutletCity();

            case 4:
                return $this->getOutletState();

            case 5:
                return $this->getOutletCountry();

            case 6:
                return $this->getOutletPincode();

            case 7:
                return $this->getOutletId();

            case 8:
                return $this->getOutletGps();

            case 9:
                return $this->getCompanyId();

            case 10:
                return $this->getCreatedAt();

            case 11:
                return $this->getUpdatedAt();

            case 12:
                return $this->getAddressName();

            case 13:
                return $this->getIsDefault();

            case 14:
                return $this->getOutletOrgId();

            case 15:
                return $this->getOrgUnitId();

            case 16:
                return $this->getTerritoryId();

            case 17:
                return $this->getTerritoryName();

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
        if (isset($alreadyDumpedObjects['OutletAddressView'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['OutletAddressView'][$this->hashCode()] = true;
        $keys = OutletAddressViewTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getOutletAddressId(),
            $keys[1] => $this->getOutletAddress(),
            $keys[2] => $this->getOutletStreetName(),
            $keys[3] => $this->getOutletCity(),
            $keys[4] => $this->getOutletState(),
            $keys[5] => $this->getOutletCountry(),
            $keys[6] => $this->getOutletPincode(),
            $keys[7] => $this->getOutletId(),
            $keys[8] => $this->getOutletGps(),
            $keys[9] => $this->getCompanyId(),
            $keys[10] => $this->getCreatedAt(),
            $keys[11] => $this->getUpdatedAt(),
            $keys[12] => $this->getAddressName(),
            $keys[13] => $this->getIsDefault(),
            $keys[14] => $this->getOutletOrgId(),
            $keys[15] => $this->getOrgUnitId(),
            $keys[16] => $this->getTerritoryId(),
            $keys[17] => $this->getTerritoryName(),
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


        return $result;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return \Propel\Runtime\ActiveQuery\Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria(): Criteria
    {
        $criteria = new Criteria(OutletAddressViewTableMap::DATABASE_NAME);

        if ($this->isColumnModified(OutletAddressViewTableMap::COL_OUTLET_ADDRESS_ID)) {
            $criteria->add(OutletAddressViewTableMap::COL_OUTLET_ADDRESS_ID, $this->outlet_address_id);
        }
        if ($this->isColumnModified(OutletAddressViewTableMap::COL_OUTLET_ADDRESS)) {
            $criteria->add(OutletAddressViewTableMap::COL_OUTLET_ADDRESS, $this->outlet_address);
        }
        if ($this->isColumnModified(OutletAddressViewTableMap::COL_OUTLET_STREET_NAME)) {
            $criteria->add(OutletAddressViewTableMap::COL_OUTLET_STREET_NAME, $this->outlet_street_name);
        }
        if ($this->isColumnModified(OutletAddressViewTableMap::COL_OUTLET_CITY)) {
            $criteria->add(OutletAddressViewTableMap::COL_OUTLET_CITY, $this->outlet_city);
        }
        if ($this->isColumnModified(OutletAddressViewTableMap::COL_OUTLET_STATE)) {
            $criteria->add(OutletAddressViewTableMap::COL_OUTLET_STATE, $this->outlet_state);
        }
        if ($this->isColumnModified(OutletAddressViewTableMap::COL_OUTLET_COUNTRY)) {
            $criteria->add(OutletAddressViewTableMap::COL_OUTLET_COUNTRY, $this->outlet_country);
        }
        if ($this->isColumnModified(OutletAddressViewTableMap::COL_OUTLET_PINCODE)) {
            $criteria->add(OutletAddressViewTableMap::COL_OUTLET_PINCODE, $this->outlet_pincode);
        }
        if ($this->isColumnModified(OutletAddressViewTableMap::COL_OUTLET_ID)) {
            $criteria->add(OutletAddressViewTableMap::COL_OUTLET_ID, $this->outlet_id);
        }
        if ($this->isColumnModified(OutletAddressViewTableMap::COL_OUTLET_GPS)) {
            $criteria->add(OutletAddressViewTableMap::COL_OUTLET_GPS, $this->outlet_gps);
        }
        if ($this->isColumnModified(OutletAddressViewTableMap::COL_COMPANY_ID)) {
            $criteria->add(OutletAddressViewTableMap::COL_COMPANY_ID, $this->company_id);
        }
        if ($this->isColumnModified(OutletAddressViewTableMap::COL_CREATED_AT)) {
            $criteria->add(OutletAddressViewTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(OutletAddressViewTableMap::COL_UPDATED_AT)) {
            $criteria->add(OutletAddressViewTableMap::COL_UPDATED_AT, $this->updated_at);
        }
        if ($this->isColumnModified(OutletAddressViewTableMap::COL_ADDRESS_NAME)) {
            $criteria->add(OutletAddressViewTableMap::COL_ADDRESS_NAME, $this->address_name);
        }
        if ($this->isColumnModified(OutletAddressViewTableMap::COL_IS_DEFAULT)) {
            $criteria->add(OutletAddressViewTableMap::COL_IS_DEFAULT, $this->is_default);
        }
        if ($this->isColumnModified(OutletAddressViewTableMap::COL_OUTLET_ORG_ID)) {
            $criteria->add(OutletAddressViewTableMap::COL_OUTLET_ORG_ID, $this->outlet_org_id);
        }
        if ($this->isColumnModified(OutletAddressViewTableMap::COL_ORG_UNIT_ID)) {
            $criteria->add(OutletAddressViewTableMap::COL_ORG_UNIT_ID, $this->org_unit_id);
        }
        if ($this->isColumnModified(OutletAddressViewTableMap::COL_TERRITORY_ID)) {
            $criteria->add(OutletAddressViewTableMap::COL_TERRITORY_ID, $this->territory_id);
        }
        if ($this->isColumnModified(OutletAddressViewTableMap::COL_TERRITORY_NAME)) {
            $criteria->add(OutletAddressViewTableMap::COL_TERRITORY_NAME, $this->territory_name);
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
        $criteria = ChildOutletAddressViewQuery::create();
        $criteria->add(OutletAddressViewTableMap::COL_OUTLET_ADDRESS_ID, $this->outlet_address_id);

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
        $validPk = null !== $this->getOutletAddressId();

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
        return $this->getOutletAddressId();
    }

    /**
     * Generic method to set the primary key (outlet_address_id column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setOutletAddressId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getOutletAddressId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \entities\OutletAddressView (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setOutletAddressId($this->getOutletAddressId());
        $copyObj->setOutletAddress($this->getOutletAddress());
        $copyObj->setOutletStreetName($this->getOutletStreetName());
        $copyObj->setOutletCity($this->getOutletCity());
        $copyObj->setOutletState($this->getOutletState());
        $copyObj->setOutletCountry($this->getOutletCountry());
        $copyObj->setOutletPincode($this->getOutletPincode());
        $copyObj->setOutletId($this->getOutletId());
        $copyObj->setOutletGps($this->getOutletGps());
        $copyObj->setCompanyId($this->getCompanyId());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        $copyObj->setAddressName($this->getAddressName());
        $copyObj->setIsDefault($this->getIsDefault());
        $copyObj->setOutletOrgId($this->getOutletOrgId());
        $copyObj->setOrgUnitId($this->getOrgUnitId());
        $copyObj->setTerritoryId($this->getTerritoryId());
        $copyObj->setTerritoryName($this->getTerritoryName());
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
     * @return \entities\OutletAddressView Clone of current object.
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
        $this->outlet_address_id = null;
        $this->outlet_address = null;
        $this->outlet_street_name = null;
        $this->outlet_city = null;
        $this->outlet_state = null;
        $this->outlet_country = null;
        $this->outlet_pincode = null;
        $this->outlet_id = null;
        $this->outlet_gps = null;
        $this->company_id = null;
        $this->created_at = null;
        $this->updated_at = null;
        $this->address_name = null;
        $this->is_default = null;
        $this->outlet_org_id = null;
        $this->org_unit_id = null;
        $this->territory_id = null;
        $this->territory_name = null;
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
        return (string) $this->exportTo(OutletAddressViewTableMap::DEFAULT_STRING_FORMAT);
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
