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
use entities\RcpaSummaryDataQuery as ChildRcpaSummaryDataQuery;
use entities\Map\RcpaSummaryDataTableMap;

/**
 * Base class that represents a row from the 'rcpa_summary_data' table.
 *
 *
 *
 * @package    propel.generator.entities.Base
 */
abstract class RcpaSummaryData implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\entities\\Map\\RcpaSummaryDataTableMap';


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
     * The value for the rcpa_summary_data_id field.
     *
     * @var        int
     */
    protected $rcpa_summary_data_id;

    /**
     * The value for the moye field.
     *
     * @var        string|null
     */
    protected $moye;

    /**
     * The value for the territory_id field.
     *
     * @var        int|null
     */
    protected $territory_id;

    /**
     * The value for the position_id field.
     *
     * @var        int|null
     */
    protected $position_id;

    /**
     * The value for the outlet_id field.
     *
     * @var        int|null
     */
    protected $outlet_id;

    /**
     * The value for the outlet_org_id field.
     *
     * @var        int|null
     */
    protected $outlet_org_id;

    /**
     * The value for the brand_id field.
     *
     * @var        int|null
     */
    protected $brand_id;

    /**
     * The value for the contribution field.
     *
     * @var        string|null
     */
    protected $contribution;

    /**
     * The value for the own field.
     *
     * @var        string|null
     */
    protected $own;

    /**
     * The value for the min_value field.
     *
     * @var        string|null
     */
    protected $min_value;

    /**
     * The value for the is_rxer field.
     *
     * @var        boolean|null
     */
    protected $is_rxer;

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
     * Initializes internal state of entities\Base\RcpaSummaryData object.
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
     * Compares this with another <code>RcpaSummaryData</code> instance.  If
     * <code>obj</code> is an instance of <code>RcpaSummaryData</code>, delegates to
     * <code>equals(RcpaSummaryData)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [rcpa_summary_data_id] column value.
     *
     * @return int
     */
    public function getRcpaSummaryDataId()
    {
        return $this->rcpa_summary_data_id;
    }

    /**
     * Get the [moye] column value.
     *
     * @return string|null
     */
    public function getMoye()
    {
        return $this->moye;
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
     * Get the [position_id] column value.
     *
     * @return int|null
     */
    public function getPositionId()
    {
        return $this->position_id;
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
     * Get the [outlet_org_id] column value.
     *
     * @return int|null
     */
    public function getOutletOrgId()
    {
        return $this->outlet_org_id;
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
     * Get the [contribution] column value.
     *
     * @return string|null
     */
    public function getContribution()
    {
        return $this->contribution;
    }

    /**
     * Get the [own] column value.
     *
     * @return string|null
     */
    public function getOwn()
    {
        return $this->own;
    }

    /**
     * Get the [min_value] column value.
     *
     * @return string|null
     */
    public function getMinValue()
    {
        return $this->min_value;
    }

    /**
     * Get the [is_rxer] column value.
     *
     * @return boolean|null
     */
    public function getIsRxer()
    {
        return $this->is_rxer;
    }

    /**
     * Get the [is_rxer] column value.
     *
     * @return boolean|null
     */
    public function isRxer()
    {
        return $this->getIsRxer();
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
     * Set the value of [rcpa_summary_data_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setRcpaSummaryDataId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->rcpa_summary_data_id !== $v) {
            $this->rcpa_summary_data_id = $v;
            $this->modifiedColumns[RcpaSummaryDataTableMap::COL_RCPA_SUMMARY_DATA_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [moye] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setMoye($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->moye !== $v) {
            $this->moye = $v;
            $this->modifiedColumns[RcpaSummaryDataTableMap::COL_MOYE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [territory_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setTerritoryId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->territory_id !== $v) {
            $this->territory_id = $v;
            $this->modifiedColumns[RcpaSummaryDataTableMap::COL_TERRITORY_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [position_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPositionId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->position_id !== $v) {
            $this->position_id = $v;
            $this->modifiedColumns[RcpaSummaryDataTableMap::COL_POSITION_ID] = true;
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
            $this->modifiedColumns[RcpaSummaryDataTableMap::COL_OUTLET_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_org_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOutletOrgId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->outlet_org_id !== $v) {
            $this->outlet_org_id = $v;
            $this->modifiedColumns[RcpaSummaryDataTableMap::COL_OUTLET_ORG_ID] = true;
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
            $this->modifiedColumns[RcpaSummaryDataTableMap::COL_BRAND_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [contribution] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setContribution($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->contribution !== $v) {
            $this->contribution = $v;
            $this->modifiedColumns[RcpaSummaryDataTableMap::COL_CONTRIBUTION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [own] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOwn($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->own !== $v) {
            $this->own = $v;
            $this->modifiedColumns[RcpaSummaryDataTableMap::COL_OWN] = true;
        }

        return $this;
    }

    /**
     * Set the value of [min_value] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setMinValue($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->min_value !== $v) {
            $this->min_value = $v;
            $this->modifiedColumns[RcpaSummaryDataTableMap::COL_MIN_VALUE] = true;
        }

        return $this;
    }

    /**
     * Sets the value of the [is_rxer] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param bool|integer|string|null $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setIsRxer($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->is_rxer !== $v) {
            $this->is_rxer = $v;
            $this->modifiedColumns[RcpaSummaryDataTableMap::COL_IS_RXER] = true;
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
            $this->modifiedColumns[RcpaSummaryDataTableMap::COL_COMPANY_ID] = true;
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
                $this->modifiedColumns[RcpaSummaryDataTableMap::COL_CREATED_AT] = true;
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
                $this->modifiedColumns[RcpaSummaryDataTableMap::COL_UPDATED_AT] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : RcpaSummaryDataTableMap::translateFieldName('RcpaSummaryDataId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->rcpa_summary_data_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : RcpaSummaryDataTableMap::translateFieldName('Moye', TableMap::TYPE_PHPNAME, $indexType)];
            $this->moye = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : RcpaSummaryDataTableMap::translateFieldName('TerritoryId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->territory_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : RcpaSummaryDataTableMap::translateFieldName('PositionId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->position_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : RcpaSummaryDataTableMap::translateFieldName('OutletId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : RcpaSummaryDataTableMap::translateFieldName('OutletOrgId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_org_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : RcpaSummaryDataTableMap::translateFieldName('BrandId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->brand_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : RcpaSummaryDataTableMap::translateFieldName('Contribution', TableMap::TYPE_PHPNAME, $indexType)];
            $this->contribution = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : RcpaSummaryDataTableMap::translateFieldName('Own', TableMap::TYPE_PHPNAME, $indexType)];
            $this->own = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : RcpaSummaryDataTableMap::translateFieldName('MinValue', TableMap::TYPE_PHPNAME, $indexType)];
            $this->min_value = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : RcpaSummaryDataTableMap::translateFieldName('IsRxer', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_rxer = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : RcpaSummaryDataTableMap::translateFieldName('CompanyId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->company_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : RcpaSummaryDataTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : RcpaSummaryDataTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 14; // 14 = RcpaSummaryDataTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\entities\\RcpaSummaryData'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(RcpaSummaryDataTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildRcpaSummaryDataQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
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
     * @see RcpaSummaryData::setDeleted()
     * @see RcpaSummaryData::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(RcpaSummaryDataTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildRcpaSummaryDataQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(RcpaSummaryDataTableMap::DATABASE_NAME);
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
                RcpaSummaryDataTableMap::addInstanceToPool($this);
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

        $this->modifiedColumns[RcpaSummaryDataTableMap::COL_RCPA_SUMMARY_DATA_ID] = true;
        if (null !== $this->rcpa_summary_data_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . RcpaSummaryDataTableMap::COL_RCPA_SUMMARY_DATA_ID . ')');
        }
        if (null === $this->rcpa_summary_data_id) {
            try {
                $dataFetcher = $con->query("SELECT nextval('rcpa_summary_data_rcpa_summary_data_id_seq')");
                $this->rcpa_summary_data_id = (int) $dataFetcher->fetchColumn();
            } catch (Exception $e) {
                throw new PropelException('Unable to get sequence id.', 0, $e);
            }
        }


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(RcpaSummaryDataTableMap::COL_RCPA_SUMMARY_DATA_ID)) {
            $modifiedColumns[':p' . $index++]  = 'rcpa_summary_data_id';
        }
        if ($this->isColumnModified(RcpaSummaryDataTableMap::COL_MOYE)) {
            $modifiedColumns[':p' . $index++]  = 'moye';
        }
        if ($this->isColumnModified(RcpaSummaryDataTableMap::COL_TERRITORY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'territory_id';
        }
        if ($this->isColumnModified(RcpaSummaryDataTableMap::COL_POSITION_ID)) {
            $modifiedColumns[':p' . $index++]  = 'position_id';
        }
        if ($this->isColumnModified(RcpaSummaryDataTableMap::COL_OUTLET_ID)) {
            $modifiedColumns[':p' . $index++]  = 'outlet_id';
        }
        if ($this->isColumnModified(RcpaSummaryDataTableMap::COL_OUTLET_ORG_ID)) {
            $modifiedColumns[':p' . $index++]  = 'outlet_org_id';
        }
        if ($this->isColumnModified(RcpaSummaryDataTableMap::COL_BRAND_ID)) {
            $modifiedColumns[':p' . $index++]  = 'brand_id';
        }
        if ($this->isColumnModified(RcpaSummaryDataTableMap::COL_CONTRIBUTION)) {
            $modifiedColumns[':p' . $index++]  = 'contribution';
        }
        if ($this->isColumnModified(RcpaSummaryDataTableMap::COL_OWN)) {
            $modifiedColumns[':p' . $index++]  = 'own';
        }
        if ($this->isColumnModified(RcpaSummaryDataTableMap::COL_MIN_VALUE)) {
            $modifiedColumns[':p' . $index++]  = 'min_value';
        }
        if ($this->isColumnModified(RcpaSummaryDataTableMap::COL_IS_RXER)) {
            $modifiedColumns[':p' . $index++]  = 'is_rxer';
        }
        if ($this->isColumnModified(RcpaSummaryDataTableMap::COL_COMPANY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'company_id';
        }
        if ($this->isColumnModified(RcpaSummaryDataTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(RcpaSummaryDataTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }

        $sql = sprintf(
            'INSERT INTO rcpa_summary_data (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'rcpa_summary_data_id':
                        $stmt->bindValue($identifier, $this->rcpa_summary_data_id, PDO::PARAM_INT);

                        break;
                    case 'moye':
                        $stmt->bindValue($identifier, $this->moye, PDO::PARAM_STR);

                        break;
                    case 'territory_id':
                        $stmt->bindValue($identifier, $this->territory_id, PDO::PARAM_INT);

                        break;
                    case 'position_id':
                        $stmt->bindValue($identifier, $this->position_id, PDO::PARAM_INT);

                        break;
                    case 'outlet_id':
                        $stmt->bindValue($identifier, $this->outlet_id, PDO::PARAM_INT);

                        break;
                    case 'outlet_org_id':
                        $stmt->bindValue($identifier, $this->outlet_org_id, PDO::PARAM_INT);

                        break;
                    case 'brand_id':
                        $stmt->bindValue($identifier, $this->brand_id, PDO::PARAM_INT);

                        break;
                    case 'contribution':
                        $stmt->bindValue($identifier, $this->contribution, PDO::PARAM_STR);

                        break;
                    case 'own':
                        $stmt->bindValue($identifier, $this->own, PDO::PARAM_STR);

                        break;
                    case 'min_value':
                        $stmt->bindValue($identifier, $this->min_value, PDO::PARAM_STR);

                        break;
                    case 'is_rxer':
                        $stmt->bindValue($identifier, $this->is_rxer, PDO::PARAM_BOOL);

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
        $pos = RcpaSummaryDataTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getRcpaSummaryDataId();

            case 1:
                return $this->getMoye();

            case 2:
                return $this->getTerritoryId();

            case 3:
                return $this->getPositionId();

            case 4:
                return $this->getOutletId();

            case 5:
                return $this->getOutletOrgId();

            case 6:
                return $this->getBrandId();

            case 7:
                return $this->getContribution();

            case 8:
                return $this->getOwn();

            case 9:
                return $this->getMinValue();

            case 10:
                return $this->getIsRxer();

            case 11:
                return $this->getCompanyId();

            case 12:
                return $this->getCreatedAt();

            case 13:
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
     *
     * @return array An associative array containing the field names (as keys) and field values
     */
    public function toArray(string $keyType = TableMap::TYPE_PHPNAME, bool $includeLazyLoadColumns = true, array $alreadyDumpedObjects = []): array
    {
        if (isset($alreadyDumpedObjects['RcpaSummaryData'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['RcpaSummaryData'][$this->hashCode()] = true;
        $keys = RcpaSummaryDataTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getRcpaSummaryDataId(),
            $keys[1] => $this->getMoye(),
            $keys[2] => $this->getTerritoryId(),
            $keys[3] => $this->getPositionId(),
            $keys[4] => $this->getOutletId(),
            $keys[5] => $this->getOutletOrgId(),
            $keys[6] => $this->getBrandId(),
            $keys[7] => $this->getContribution(),
            $keys[8] => $this->getOwn(),
            $keys[9] => $this->getMinValue(),
            $keys[10] => $this->getIsRxer(),
            $keys[11] => $this->getCompanyId(),
            $keys[12] => $this->getCreatedAt(),
            $keys[13] => $this->getUpdatedAt(),
        ];
        if ($result[$keys[12]] instanceof \DateTimeInterface) {
            $result[$keys[12]] = $result[$keys[12]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[13]] instanceof \DateTimeInterface) {
            $result[$keys[13]] = $result[$keys[13]]->format('Y-m-d H:i:s.u');
        }

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
        $pos = RcpaSummaryDataTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setRcpaSummaryDataId($value);
                break;
            case 1:
                $this->setMoye($value);
                break;
            case 2:
                $this->setTerritoryId($value);
                break;
            case 3:
                $this->setPositionId($value);
                break;
            case 4:
                $this->setOutletId($value);
                break;
            case 5:
                $this->setOutletOrgId($value);
                break;
            case 6:
                $this->setBrandId($value);
                break;
            case 7:
                $this->setContribution($value);
                break;
            case 8:
                $this->setOwn($value);
                break;
            case 9:
                $this->setMinValue($value);
                break;
            case 10:
                $this->setIsRxer($value);
                break;
            case 11:
                $this->setCompanyId($value);
                break;
            case 12:
                $this->setCreatedAt($value);
                break;
            case 13:
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
        $keys = RcpaSummaryDataTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setRcpaSummaryDataId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setMoye($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setTerritoryId($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setPositionId($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setOutletId($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setOutletOrgId($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setBrandId($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setContribution($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setOwn($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setMinValue($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setIsRxer($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setCompanyId($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setCreatedAt($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setUpdatedAt($arr[$keys[13]]);
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
        $criteria = new Criteria(RcpaSummaryDataTableMap::DATABASE_NAME);

        if ($this->isColumnModified(RcpaSummaryDataTableMap::COL_RCPA_SUMMARY_DATA_ID)) {
            $criteria->add(RcpaSummaryDataTableMap::COL_RCPA_SUMMARY_DATA_ID, $this->rcpa_summary_data_id);
        }
        if ($this->isColumnModified(RcpaSummaryDataTableMap::COL_MOYE)) {
            $criteria->add(RcpaSummaryDataTableMap::COL_MOYE, $this->moye);
        }
        if ($this->isColumnModified(RcpaSummaryDataTableMap::COL_TERRITORY_ID)) {
            $criteria->add(RcpaSummaryDataTableMap::COL_TERRITORY_ID, $this->territory_id);
        }
        if ($this->isColumnModified(RcpaSummaryDataTableMap::COL_POSITION_ID)) {
            $criteria->add(RcpaSummaryDataTableMap::COL_POSITION_ID, $this->position_id);
        }
        if ($this->isColumnModified(RcpaSummaryDataTableMap::COL_OUTLET_ID)) {
            $criteria->add(RcpaSummaryDataTableMap::COL_OUTLET_ID, $this->outlet_id);
        }
        if ($this->isColumnModified(RcpaSummaryDataTableMap::COL_OUTLET_ORG_ID)) {
            $criteria->add(RcpaSummaryDataTableMap::COL_OUTLET_ORG_ID, $this->outlet_org_id);
        }
        if ($this->isColumnModified(RcpaSummaryDataTableMap::COL_BRAND_ID)) {
            $criteria->add(RcpaSummaryDataTableMap::COL_BRAND_ID, $this->brand_id);
        }
        if ($this->isColumnModified(RcpaSummaryDataTableMap::COL_CONTRIBUTION)) {
            $criteria->add(RcpaSummaryDataTableMap::COL_CONTRIBUTION, $this->contribution);
        }
        if ($this->isColumnModified(RcpaSummaryDataTableMap::COL_OWN)) {
            $criteria->add(RcpaSummaryDataTableMap::COL_OWN, $this->own);
        }
        if ($this->isColumnModified(RcpaSummaryDataTableMap::COL_MIN_VALUE)) {
            $criteria->add(RcpaSummaryDataTableMap::COL_MIN_VALUE, $this->min_value);
        }
        if ($this->isColumnModified(RcpaSummaryDataTableMap::COL_IS_RXER)) {
            $criteria->add(RcpaSummaryDataTableMap::COL_IS_RXER, $this->is_rxer);
        }
        if ($this->isColumnModified(RcpaSummaryDataTableMap::COL_COMPANY_ID)) {
            $criteria->add(RcpaSummaryDataTableMap::COL_COMPANY_ID, $this->company_id);
        }
        if ($this->isColumnModified(RcpaSummaryDataTableMap::COL_CREATED_AT)) {
            $criteria->add(RcpaSummaryDataTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(RcpaSummaryDataTableMap::COL_UPDATED_AT)) {
            $criteria->add(RcpaSummaryDataTableMap::COL_UPDATED_AT, $this->updated_at);
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
        $criteria = ChildRcpaSummaryDataQuery::create();
        $criteria->add(RcpaSummaryDataTableMap::COL_RCPA_SUMMARY_DATA_ID, $this->rcpa_summary_data_id);

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
        $validPk = null !== $this->getRcpaSummaryDataId();

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
        return $this->getRcpaSummaryDataId();
    }

    /**
     * Generic method to set the primary key (rcpa_summary_data_id column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setRcpaSummaryDataId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getRcpaSummaryDataId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \entities\RcpaSummaryData (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setMoye($this->getMoye());
        $copyObj->setTerritoryId($this->getTerritoryId());
        $copyObj->setPositionId($this->getPositionId());
        $copyObj->setOutletId($this->getOutletId());
        $copyObj->setOutletOrgId($this->getOutletOrgId());
        $copyObj->setBrandId($this->getBrandId());
        $copyObj->setContribution($this->getContribution());
        $copyObj->setOwn($this->getOwn());
        $copyObj->setMinValue($this->getMinValue());
        $copyObj->setIsRxer($this->getIsRxer());
        $copyObj->setCompanyId($this->getCompanyId());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setRcpaSummaryDataId(NULL); // this is a auto-increment column, so set to default value
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
     * @return \entities\RcpaSummaryData Clone of current object.
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
        $this->rcpa_summary_data_id = null;
        $this->moye = null;
        $this->territory_id = null;
        $this->position_id = null;
        $this->outlet_id = null;
        $this->outlet_org_id = null;
        $this->brand_id = null;
        $this->contribution = null;
        $this->own = null;
        $this->min_value = null;
        $this->is_rxer = null;
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
        return (string) $this->exportTo(RcpaSummaryDataTableMap::DEFAULT_STRING_FORMAT);
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
