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
use entities\RcpaRetailerViewQuery as ChildRcpaRetailerViewQuery;
use entities\Map\RcpaRetailerViewTableMap;

/**
 * Base class that represents a row from the 'rcpa_retailer_view' table.
 *
 *
 *
 * @package    propel.generator.entities.Base
 */
abstract class RcpaRetailerView implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\entities\\Map\\RcpaRetailerViewTableMap';


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
     * The value for the uniqueid field.
     *
     * @var        string
     */
    protected $uniqueid;

    /**
     * The value for the doctorid field.
     *
     * @var        int|null
     */
    protected $doctorid;

    /**
     * The value for the outlet_org_id field.
     *
     * @var        int|null
     */
    protected $outlet_org_id;

    /**
     * The value for the retail_outlet_id field.
     *
     * @var        int|null
     */
    protected $retail_outlet_id;

    /**
     * The value for the outlet_name field.
     *
     * @var        string|null
     */
    protected $outlet_name;

    /**
     * The value for the rcpa_moye field.
     *
     * @var        string|null
     */
    protected $rcpa_moye;

    /**
     * The value for the territory_id field.
     *
     * @var        int|null
     */
    protected $territory_id;

    /**
     * The value for the rcpa_value field.
     *
     * @var        string|null
     */
    protected $rcpa_value;

    /**
     * The value for the potential field.
     *
     * @var        string|null
     */
    protected $potential;

    /**
     * The value for the own field.
     *
     * @var        string|null
     */
    protected $own;

    /**
     * The value for the competition field.
     *
     * @var        string|null
     */
    protected $competition;

    /**
     * The value for the lastcreated field.
     *
     * @var        DateTime|null
     */
    protected $lastcreated;

    /**
     * The value for the lastupdated field.
     *
     * @var        DateTime|null
     */
    protected $lastupdated;

    /**
     * The value for the brand_name field.
     *
     * @var        string|null
     */
    protected $brand_name;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * Initializes internal state of entities\Base\RcpaRetailerView object.
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
     * Compares this with another <code>RcpaRetailerView</code> instance.  If
     * <code>obj</code> is an instance of <code>RcpaRetailerView</code>, delegates to
     * <code>equals(RcpaRetailerView)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [uniqueid] column value.
     *
     * @return string
     */
    public function getUniqueid()
    {
        return $this->uniqueid;
    }

    /**
     * Get the [doctorid] column value.
     *
     * @return int|null
     */
    public function getDoctorid()
    {
        return $this->doctorid;
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
     * Get the [retail_outlet_id] column value.
     *
     * @return int|null
     */
    public function getRetailOutletId()
    {
        return $this->retail_outlet_id;
    }

    /**
     * Get the [outlet_name] column value.
     *
     * @return string|null
     */
    public function getOutletName()
    {
        return $this->outlet_name;
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
     * Get the [territory_id] column value.
     *
     * @return int|null
     */
    public function getTerritoryId()
    {
        return $this->territory_id;
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
     * Get the [potential] column value.
     *
     * @return string|null
     */
    public function getPotential()
    {
        return $this->potential;
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
     * Get the [competition] column value.
     *
     * @return string|null
     */
    public function getCompetition()
    {
        return $this->competition;
    }

    /**
     * Get the [optionally formatted] temporal [lastcreated] column value.
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
            return $this->lastcreated;
        } else {
            return $this->lastcreated instanceof \DateTimeInterface ? $this->lastcreated->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [lastupdated] column value.
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
            return $this->lastupdated;
        } else {
            return $this->lastupdated instanceof \DateTimeInterface ? $this->lastupdated->format($format) : null;
        }
    }

    /**
     * Get the [brand_name] column value.
     *
     * @return string|null
     */
    public function getBrandName()
    {
        return $this->brand_name;
    }

    /**
     * Set the value of [uniqueid] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setUniqueid($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->uniqueid !== $v) {
            $this->uniqueid = $v;
            $this->modifiedColumns[RcpaRetailerViewTableMap::COL_UNIQUEID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [doctorid] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setDoctorid($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->doctorid !== $v) {
            $this->doctorid = $v;
            $this->modifiedColumns[RcpaRetailerViewTableMap::COL_DOCTORID] = true;
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
            $this->modifiedColumns[RcpaRetailerViewTableMap::COL_OUTLET_ORG_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [retail_outlet_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setRetailOutletId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->retail_outlet_id !== $v) {
            $this->retail_outlet_id = $v;
            $this->modifiedColumns[RcpaRetailerViewTableMap::COL_RETAIL_OUTLET_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOutletName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->outlet_name !== $v) {
            $this->outlet_name = $v;
            $this->modifiedColumns[RcpaRetailerViewTableMap::COL_OUTLET_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [rcpa_moye] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setRcpaMoye($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->rcpa_moye !== $v) {
            $this->rcpa_moye = $v;
            $this->modifiedColumns[RcpaRetailerViewTableMap::COL_RCPA_MOYE] = true;
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
            $this->modifiedColumns[RcpaRetailerViewTableMap::COL_TERRITORY_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [rcpa_value] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setRcpaValue($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->rcpa_value !== $v) {
            $this->rcpa_value = $v;
            $this->modifiedColumns[RcpaRetailerViewTableMap::COL_RCPA_VALUE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [potential] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setPotential($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->potential !== $v) {
            $this->potential = $v;
            $this->modifiedColumns[RcpaRetailerViewTableMap::COL_POTENTIAL] = true;
        }

        return $this;
    }

    /**
     * Set the value of [own] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOwn($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->own !== $v) {
            $this->own = $v;
            $this->modifiedColumns[RcpaRetailerViewTableMap::COL_OWN] = true;
        }

        return $this;
    }

    /**
     * Set the value of [competition] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setCompetition($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->competition !== $v) {
            $this->competition = $v;
            $this->modifiedColumns[RcpaRetailerViewTableMap::COL_COMPETITION] = true;
        }

        return $this;
    }

    /**
     * Sets the value of [lastcreated] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    protected function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->lastcreated !== null || $dt !== null) {
            if ($this->lastcreated === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->lastcreated->format("Y-m-d H:i:s.u")) {
                $this->lastcreated = $dt === null ? null : clone $dt;
                $this->modifiedColumns[RcpaRetailerViewTableMap::COL_LASTCREATED] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Sets the value of [lastupdated] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    protected function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->lastupdated !== null || $dt !== null) {
            if ($this->lastupdated === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->lastupdated->format("Y-m-d H:i:s.u")) {
                $this->lastupdated = $dt === null ? null : clone $dt;
                $this->modifiedColumns[RcpaRetailerViewTableMap::COL_LASTUPDATED] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [brand_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setBrandName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->brand_name !== $v) {
            $this->brand_name = $v;
            $this->modifiedColumns[RcpaRetailerViewTableMap::COL_BRAND_NAME] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : RcpaRetailerViewTableMap::translateFieldName('Uniqueid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->uniqueid = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : RcpaRetailerViewTableMap::translateFieldName('Doctorid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->doctorid = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : RcpaRetailerViewTableMap::translateFieldName('OutletOrgId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_org_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : RcpaRetailerViewTableMap::translateFieldName('RetailOutletId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->retail_outlet_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : RcpaRetailerViewTableMap::translateFieldName('OutletName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : RcpaRetailerViewTableMap::translateFieldName('RcpaMoye', TableMap::TYPE_PHPNAME, $indexType)];
            $this->rcpa_moye = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : RcpaRetailerViewTableMap::translateFieldName('TerritoryId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->territory_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : RcpaRetailerViewTableMap::translateFieldName('RcpaValue', TableMap::TYPE_PHPNAME, $indexType)];
            $this->rcpa_value = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : RcpaRetailerViewTableMap::translateFieldName('Potential', TableMap::TYPE_PHPNAME, $indexType)];
            $this->potential = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : RcpaRetailerViewTableMap::translateFieldName('Own', TableMap::TYPE_PHPNAME, $indexType)];
            $this->own = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : RcpaRetailerViewTableMap::translateFieldName('Competition', TableMap::TYPE_PHPNAME, $indexType)];
            $this->competition = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : RcpaRetailerViewTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->lastcreated = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : RcpaRetailerViewTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->lastupdated = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : RcpaRetailerViewTableMap::translateFieldName('BrandName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->brand_name = (null !== $col) ? (string) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 14; // 14 = RcpaRetailerViewTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\entities\\RcpaRetailerView'), 0, $e);
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
        $pos = RcpaRetailerViewTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getUniqueid();

            case 1:
                return $this->getDoctorid();

            case 2:
                return $this->getOutletOrgId();

            case 3:
                return $this->getRetailOutletId();

            case 4:
                return $this->getOutletName();

            case 5:
                return $this->getRcpaMoye();

            case 6:
                return $this->getTerritoryId();

            case 7:
                return $this->getRcpaValue();

            case 8:
                return $this->getPotential();

            case 9:
                return $this->getOwn();

            case 10:
                return $this->getCompetition();

            case 11:
                return $this->getCreatedAt();

            case 12:
                return $this->getUpdatedAt();

            case 13:
                return $this->getBrandName();

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
        if (isset($alreadyDumpedObjects['RcpaRetailerView'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['RcpaRetailerView'][$this->hashCode()] = true;
        $keys = RcpaRetailerViewTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getUniqueid(),
            $keys[1] => $this->getDoctorid(),
            $keys[2] => $this->getOutletOrgId(),
            $keys[3] => $this->getRetailOutletId(),
            $keys[4] => $this->getOutletName(),
            $keys[5] => $this->getRcpaMoye(),
            $keys[6] => $this->getTerritoryId(),
            $keys[7] => $this->getRcpaValue(),
            $keys[8] => $this->getPotential(),
            $keys[9] => $this->getOwn(),
            $keys[10] => $this->getCompetition(),
            $keys[11] => $this->getCreatedAt(),
            $keys[12] => $this->getUpdatedAt(),
            $keys[13] => $this->getBrandName(),
        ];
        if ($result[$keys[11]] instanceof \DateTimeInterface) {
            $result[$keys[11]] = $result[$keys[11]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[12]] instanceof \DateTimeInterface) {
            $result[$keys[12]] = $result[$keys[12]]->format('Y-m-d H:i:s.u');
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
        $criteria = new Criteria(RcpaRetailerViewTableMap::DATABASE_NAME);

        if ($this->isColumnModified(RcpaRetailerViewTableMap::COL_UNIQUEID)) {
            $criteria->add(RcpaRetailerViewTableMap::COL_UNIQUEID, $this->uniqueid);
        }
        if ($this->isColumnModified(RcpaRetailerViewTableMap::COL_DOCTORID)) {
            $criteria->add(RcpaRetailerViewTableMap::COL_DOCTORID, $this->doctorid);
        }
        if ($this->isColumnModified(RcpaRetailerViewTableMap::COL_OUTLET_ORG_ID)) {
            $criteria->add(RcpaRetailerViewTableMap::COL_OUTLET_ORG_ID, $this->outlet_org_id);
        }
        if ($this->isColumnModified(RcpaRetailerViewTableMap::COL_RETAIL_OUTLET_ID)) {
            $criteria->add(RcpaRetailerViewTableMap::COL_RETAIL_OUTLET_ID, $this->retail_outlet_id);
        }
        if ($this->isColumnModified(RcpaRetailerViewTableMap::COL_OUTLET_NAME)) {
            $criteria->add(RcpaRetailerViewTableMap::COL_OUTLET_NAME, $this->outlet_name);
        }
        if ($this->isColumnModified(RcpaRetailerViewTableMap::COL_RCPA_MOYE)) {
            $criteria->add(RcpaRetailerViewTableMap::COL_RCPA_MOYE, $this->rcpa_moye);
        }
        if ($this->isColumnModified(RcpaRetailerViewTableMap::COL_TERRITORY_ID)) {
            $criteria->add(RcpaRetailerViewTableMap::COL_TERRITORY_ID, $this->territory_id);
        }
        if ($this->isColumnModified(RcpaRetailerViewTableMap::COL_RCPA_VALUE)) {
            $criteria->add(RcpaRetailerViewTableMap::COL_RCPA_VALUE, $this->rcpa_value);
        }
        if ($this->isColumnModified(RcpaRetailerViewTableMap::COL_POTENTIAL)) {
            $criteria->add(RcpaRetailerViewTableMap::COL_POTENTIAL, $this->potential);
        }
        if ($this->isColumnModified(RcpaRetailerViewTableMap::COL_OWN)) {
            $criteria->add(RcpaRetailerViewTableMap::COL_OWN, $this->own);
        }
        if ($this->isColumnModified(RcpaRetailerViewTableMap::COL_COMPETITION)) {
            $criteria->add(RcpaRetailerViewTableMap::COL_COMPETITION, $this->competition);
        }
        if ($this->isColumnModified(RcpaRetailerViewTableMap::COL_LASTCREATED)) {
            $criteria->add(RcpaRetailerViewTableMap::COL_LASTCREATED, $this->lastcreated);
        }
        if ($this->isColumnModified(RcpaRetailerViewTableMap::COL_LASTUPDATED)) {
            $criteria->add(RcpaRetailerViewTableMap::COL_LASTUPDATED, $this->lastupdated);
        }
        if ($this->isColumnModified(RcpaRetailerViewTableMap::COL_BRAND_NAME)) {
            $criteria->add(RcpaRetailerViewTableMap::COL_BRAND_NAME, $this->brand_name);
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
        $criteria = ChildRcpaRetailerViewQuery::create();
        $criteria->add(RcpaRetailerViewTableMap::COL_UNIQUEID, $this->uniqueid);

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
        $validPk = null !== $this->getUniqueid();

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
     * @return string
     */
    public function getPrimaryKey()
    {
        return $this->getUniqueid();
    }

    /**
     * Generic method to set the primary key (uniqueid column).
     *
     * @param string|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?string $key = null): void
    {
        $this->setUniqueid($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getUniqueid();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \entities\RcpaRetailerView (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setUniqueid($this->getUniqueid());
        $copyObj->setDoctorid($this->getDoctorid());
        $copyObj->setOutletOrgId($this->getOutletOrgId());
        $copyObj->setRetailOutletId($this->getRetailOutletId());
        $copyObj->setOutletName($this->getOutletName());
        $copyObj->setRcpaMoye($this->getRcpaMoye());
        $copyObj->setTerritoryId($this->getTerritoryId());
        $copyObj->setRcpaValue($this->getRcpaValue());
        $copyObj->setPotential($this->getPotential());
        $copyObj->setOwn($this->getOwn());
        $copyObj->setCompetition($this->getCompetition());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        $copyObj->setBrandName($this->getBrandName());
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
     * @return \entities\RcpaRetailerView Clone of current object.
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
        $this->uniqueid = null;
        $this->doctorid = null;
        $this->outlet_org_id = null;
        $this->retail_outlet_id = null;
        $this->outlet_name = null;
        $this->rcpa_moye = null;
        $this->territory_id = null;
        $this->rcpa_value = null;
        $this->potential = null;
        $this->own = null;
        $this->competition = null;
        $this->lastcreated = null;
        $this->lastupdated = null;
        $this->brand_name = null;
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
        return (string) $this->exportTo(RcpaRetailerViewTableMap::DEFAULT_STRING_FORMAT);
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
