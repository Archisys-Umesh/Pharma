<?php

namespace entities\Base;

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
use entities\Company as ChildCompany;
use entities\CompanyQuery as ChildCompanyQuery;
use entities\CompetitionMappingQuery as ChildCompetitionMappingQuery;
use entities\Competitor as ChildCompetitor;
use entities\CompetitorQuery as ChildCompetitorQuery;
use entities\Employee as ChildEmployee;
use entities\EmployeeQuery as ChildEmployeeQuery;
use entities\Outlets as ChildOutlets;
use entities\OutletsQuery as ChildOutletsQuery;
use entities\Unitmaster as ChildUnitmaster;
use entities\UnitmasterQuery as ChildUnitmasterQuery;
use entities\Map\CompetitionMappingTableMap;

/**
 * Base class that represents a row from the 'competition_mapping' table.
 *
 *
 *
 * @package    propel.generator.entities.Base
 */
abstract class CompetitionMapping implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\entities\\Map\\CompetitionMappingTableMap';


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
     * The value for the competition_name field.
     *
     * @var        string|null
     */
    protected $competition_name;

    /**
     * The value for the competition_sku field.
     *
     * @var        string|null
     */
    protected $competition_sku;

    /**
     * The value for the competition_mrp field.
     *
     * @var        string|null
     */
    protected $competition_mrp;

    /**
     * The value for the competition_features field.
     *
     * @var        string|null
     */
    protected $competition_features;

    /**
     * The value for the competition_remark field.
     *
     * @var        string|null
     */
    protected $competition_remark;

    /**
     * The value for the consumer_feedback field.
     *
     * @var        string|null
     */
    protected $consumer_feedback;

    /**
     * The value for the media_id field.
     *
     * @var        string|null
     */
    protected $media_id;

    /**
     * The value for the company_id field.
     *
     * @var        int
     */
    protected $company_id;

    /**
     * The value for the employee_id field.
     *
     * @var        int
     */
    protected $employee_id;

    /**
     * The value for the outlet_id field.
     *
     * @var        int
     */
    protected $outlet_id;

    /**
     * The value for the competitor_id field.
     *
     * @var        int|null
     */
    protected $competitor_id;

    /**
     * The value for the unit_id field.
     *
     * @var        int|null
     */
    protected $unit_id;

    /**
     * The value for the qty field.
     *
     * @var        string|null
     */
    protected $qty;

    /**
     * @var        ChildCompany
     */
    protected $aCompany;

    /**
     * @var        ChildEmployee
     */
    protected $aEmployee;

    /**
     * @var        ChildOutlets
     */
    protected $aOutlets;

    /**
     * @var        ChildCompetitor
     */
    protected $aCompetitor;

    /**
     * @var        ChildUnitmaster
     */
    protected $aUnitmaster;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * Initializes internal state of entities\Base\CompetitionMapping object.
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
     * Compares this with another <code>CompetitionMapping</code> instance.  If
     * <code>obj</code> is an instance of <code>CompetitionMapping</code>, delegates to
     * <code>equals(CompetitionMapping)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [competition_name] column value.
     *
     * @return string|null
     */
    public function getCompetitionName()
    {
        return $this->competition_name;
    }

    /**
     * Get the [competition_sku] column value.
     *
     * @return string|null
     */
    public function getCompetitionSku()
    {
        return $this->competition_sku;
    }

    /**
     * Get the [competition_mrp] column value.
     *
     * @return string|null
     */
    public function getCompetitionMrp()
    {
        return $this->competition_mrp;
    }

    /**
     * Get the [competition_features] column value.
     *
     * @return string|null
     */
    public function getCompetitionFeatures()
    {
        return $this->competition_features;
    }

    /**
     * Get the [competition_remark] column value.
     *
     * @return string|null
     */
    public function getCompetitionRemark()
    {
        return $this->competition_remark;
    }

    /**
     * Get the [consumer_feedback] column value.
     *
     * @return string|null
     */
    public function getConsumerFeedback()
    {
        return $this->consumer_feedback;
    }

    /**
     * Get the [media_id] column value.
     *
     * @return string|null
     */
    public function getMediaId()
    {
        return $this->media_id;
    }

    /**
     * Get the [company_id] column value.
     *
     * @return int
     */
    public function getCompanyId()
    {
        return $this->company_id;
    }

    /**
     * Get the [employee_id] column value.
     *
     * @return int
     */
    public function getEmployeeId()
    {
        return $this->employee_id;
    }

    /**
     * Get the [outlet_id] column value.
     *
     * @return int
     */
    public function getOutletId()
    {
        return $this->outlet_id;
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
     * Get the [unit_id] column value.
     *
     * @return int|null
     */
    public function getUnitId()
    {
        return $this->unit_id;
    }

    /**
     * Get the [qty] column value.
     *
     * @return string|null
     */
    public function getQty()
    {
        return $this->qty;
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
            $this->modifiedColumns[CompetitionMappingTableMap::COL_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [competition_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCompetitionName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->competition_name !== $v) {
            $this->competition_name = $v;
            $this->modifiedColumns[CompetitionMappingTableMap::COL_COMPETITION_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [competition_sku] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCompetitionSku($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->competition_sku !== $v) {
            $this->competition_sku = $v;
            $this->modifiedColumns[CompetitionMappingTableMap::COL_COMPETITION_SKU] = true;
        }

        return $this;
    }

    /**
     * Set the value of [competition_mrp] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCompetitionMrp($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->competition_mrp !== $v) {
            $this->competition_mrp = $v;
            $this->modifiedColumns[CompetitionMappingTableMap::COL_COMPETITION_MRP] = true;
        }

        return $this;
    }

    /**
     * Set the value of [competition_features] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCompetitionFeatures($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->competition_features !== $v) {
            $this->competition_features = $v;
            $this->modifiedColumns[CompetitionMappingTableMap::COL_COMPETITION_FEATURES] = true;
        }

        return $this;
    }

    /**
     * Set the value of [competition_remark] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCompetitionRemark($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->competition_remark !== $v) {
            $this->competition_remark = $v;
            $this->modifiedColumns[CompetitionMappingTableMap::COL_COMPETITION_REMARK] = true;
        }

        return $this;
    }

    /**
     * Set the value of [consumer_feedback] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setConsumerFeedback($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->consumer_feedback !== $v) {
            $this->consumer_feedback = $v;
            $this->modifiedColumns[CompetitionMappingTableMap::COL_CONSUMER_FEEDBACK] = true;
        }

        return $this;
    }

    /**
     * Set the value of [media_id] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setMediaId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->media_id !== $v) {
            $this->media_id = $v;
            $this->modifiedColumns[CompetitionMappingTableMap::COL_MEDIA_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [company_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCompanyId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->company_id !== $v) {
            $this->company_id = $v;
            $this->modifiedColumns[CompetitionMappingTableMap::COL_COMPANY_ID] = true;
        }

        if ($this->aCompany !== null && $this->aCompany->getCompanyId() !== $v) {
            $this->aCompany = null;
        }

        return $this;
    }

    /**
     * Set the value of [employee_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setEmployeeId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->employee_id !== $v) {
            $this->employee_id = $v;
            $this->modifiedColumns[CompetitionMappingTableMap::COL_EMPLOYEE_ID] = true;
        }

        if ($this->aEmployee !== null && $this->aEmployee->getEmployeeId() !== $v) {
            $this->aEmployee = null;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOutletId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->outlet_id !== $v) {
            $this->outlet_id = $v;
            $this->modifiedColumns[CompetitionMappingTableMap::COL_OUTLET_ID] = true;
        }

        if ($this->aOutlets !== null && $this->aOutlets->getId() !== $v) {
            $this->aOutlets = null;
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
            $this->modifiedColumns[CompetitionMappingTableMap::COL_COMPETITOR_ID] = true;
        }

        if ($this->aCompetitor !== null && $this->aCompetitor->getId() !== $v) {
            $this->aCompetitor = null;
        }

        return $this;
    }

    /**
     * Set the value of [unit_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setUnitId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->unit_id !== $v) {
            $this->unit_id = $v;
            $this->modifiedColumns[CompetitionMappingTableMap::COL_UNIT_ID] = true;
        }

        if ($this->aUnitmaster !== null && $this->aUnitmaster->getUnitId() !== $v) {
            $this->aUnitmaster = null;
        }

        return $this;
    }

    /**
     * Set the value of [qty] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setQty($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->qty !== $v) {
            $this->qty = $v;
            $this->modifiedColumns[CompetitionMappingTableMap::COL_QTY] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : CompetitionMappingTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : CompetitionMappingTableMap::translateFieldName('CompetitionName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->competition_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : CompetitionMappingTableMap::translateFieldName('CompetitionSku', TableMap::TYPE_PHPNAME, $indexType)];
            $this->competition_sku = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : CompetitionMappingTableMap::translateFieldName('CompetitionMrp', TableMap::TYPE_PHPNAME, $indexType)];
            $this->competition_mrp = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : CompetitionMappingTableMap::translateFieldName('CompetitionFeatures', TableMap::TYPE_PHPNAME, $indexType)];
            $this->competition_features = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : CompetitionMappingTableMap::translateFieldName('CompetitionRemark', TableMap::TYPE_PHPNAME, $indexType)];
            $this->competition_remark = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : CompetitionMappingTableMap::translateFieldName('ConsumerFeedback', TableMap::TYPE_PHPNAME, $indexType)];
            $this->consumer_feedback = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : CompetitionMappingTableMap::translateFieldName('MediaId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->media_id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : CompetitionMappingTableMap::translateFieldName('CompanyId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->company_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : CompetitionMappingTableMap::translateFieldName('EmployeeId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->employee_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : CompetitionMappingTableMap::translateFieldName('OutletId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : CompetitionMappingTableMap::translateFieldName('CompetitorId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->competitor_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : CompetitionMappingTableMap::translateFieldName('UnitId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->unit_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : CompetitionMappingTableMap::translateFieldName('Qty', TableMap::TYPE_PHPNAME, $indexType)];
            $this->qty = (null !== $col) ? (string) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 14; // 14 = CompetitionMappingTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\entities\\CompetitionMapping'), 0, $e);
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
        if ($this->aEmployee !== null && $this->employee_id !== $this->aEmployee->getEmployeeId()) {
            $this->aEmployee = null;
        }
        if ($this->aOutlets !== null && $this->outlet_id !== $this->aOutlets->getId()) {
            $this->aOutlets = null;
        }
        if ($this->aCompetitor !== null && $this->competitor_id !== $this->aCompetitor->getId()) {
            $this->aCompetitor = null;
        }
        if ($this->aUnitmaster !== null && $this->unit_id !== $this->aUnitmaster->getUnitId()) {
            $this->aUnitmaster = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(CompetitionMappingTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildCompetitionMappingQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aCompany = null;
            $this->aEmployee = null;
            $this->aOutlets = null;
            $this->aCompetitor = null;
            $this->aUnitmaster = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see CompetitionMapping::setDeleted()
     * @see CompetitionMapping::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(CompetitionMappingTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildCompetitionMappingQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(CompetitionMappingTableMap::DATABASE_NAME);
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
                CompetitionMappingTableMap::addInstanceToPool($this);
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

            if ($this->aCompetitor !== null) {
                if ($this->aCompetitor->isModified() || $this->aCompetitor->isNew()) {
                    $affectedRows += $this->aCompetitor->save($con);
                }
                $this->setCompetitor($this->aCompetitor);
            }

            if ($this->aUnitmaster !== null) {
                if ($this->aUnitmaster->isModified() || $this->aUnitmaster->isNew()) {
                    $affectedRows += $this->aUnitmaster->save($con);
                }
                $this->setUnitmaster($this->aUnitmaster);
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

        $this->modifiedColumns[CompetitionMappingTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . CompetitionMappingTableMap::COL_ID . ')');
        }
        if (null === $this->id) {
            try {
                $dataFetcher = $con->query("SELECT nextval('competition_mapping_id_seq')");
                $this->id = (int) $dataFetcher->fetchColumn();
            } catch (Exception $e) {
                throw new PropelException('Unable to get sequence id.', 0, $e);
            }
        }


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(CompetitionMappingTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(CompetitionMappingTableMap::COL_COMPETITION_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'competition_name';
        }
        if ($this->isColumnModified(CompetitionMappingTableMap::COL_COMPETITION_SKU)) {
            $modifiedColumns[':p' . $index++]  = 'competition_sku';
        }
        if ($this->isColumnModified(CompetitionMappingTableMap::COL_COMPETITION_MRP)) {
            $modifiedColumns[':p' . $index++]  = 'competition_mrp';
        }
        if ($this->isColumnModified(CompetitionMappingTableMap::COL_COMPETITION_FEATURES)) {
            $modifiedColumns[':p' . $index++]  = 'competition_features';
        }
        if ($this->isColumnModified(CompetitionMappingTableMap::COL_COMPETITION_REMARK)) {
            $modifiedColumns[':p' . $index++]  = 'competition_remark';
        }
        if ($this->isColumnModified(CompetitionMappingTableMap::COL_CONSUMER_FEEDBACK)) {
            $modifiedColumns[':p' . $index++]  = 'consumer_feedback';
        }
        if ($this->isColumnModified(CompetitionMappingTableMap::COL_MEDIA_ID)) {
            $modifiedColumns[':p' . $index++]  = 'media_id';
        }
        if ($this->isColumnModified(CompetitionMappingTableMap::COL_COMPANY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'company_id';
        }
        if ($this->isColumnModified(CompetitionMappingTableMap::COL_EMPLOYEE_ID)) {
            $modifiedColumns[':p' . $index++]  = 'employee_id';
        }
        if ($this->isColumnModified(CompetitionMappingTableMap::COL_OUTLET_ID)) {
            $modifiedColumns[':p' . $index++]  = 'outlet_id';
        }
        if ($this->isColumnModified(CompetitionMappingTableMap::COL_COMPETITOR_ID)) {
            $modifiedColumns[':p' . $index++]  = 'competitor_id';
        }
        if ($this->isColumnModified(CompetitionMappingTableMap::COL_UNIT_ID)) {
            $modifiedColumns[':p' . $index++]  = 'unit_id';
        }
        if ($this->isColumnModified(CompetitionMappingTableMap::COL_QTY)) {
            $modifiedColumns[':p' . $index++]  = 'qty';
        }

        $sql = sprintf(
            'INSERT INTO competition_mapping (%s) VALUES (%s)',
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
                    case 'competition_name':
                        $stmt->bindValue($identifier, $this->competition_name, PDO::PARAM_STR);

                        break;
                    case 'competition_sku':
                        $stmt->bindValue($identifier, $this->competition_sku, PDO::PARAM_STR);

                        break;
                    case 'competition_mrp':
                        $stmt->bindValue($identifier, $this->competition_mrp, PDO::PARAM_STR);

                        break;
                    case 'competition_features':
                        $stmt->bindValue($identifier, $this->competition_features, PDO::PARAM_STR);

                        break;
                    case 'competition_remark':
                        $stmt->bindValue($identifier, $this->competition_remark, PDO::PARAM_STR);

                        break;
                    case 'consumer_feedback':
                        $stmt->bindValue($identifier, $this->consumer_feedback, PDO::PARAM_STR);

                        break;
                    case 'media_id':
                        $stmt->bindValue($identifier, $this->media_id, PDO::PARAM_STR);

                        break;
                    case 'company_id':
                        $stmt->bindValue($identifier, $this->company_id, PDO::PARAM_INT);

                        break;
                    case 'employee_id':
                        $stmt->bindValue($identifier, $this->employee_id, PDO::PARAM_INT);

                        break;
                    case 'outlet_id':
                        $stmt->bindValue($identifier, $this->outlet_id, PDO::PARAM_INT);

                        break;
                    case 'competitor_id':
                        $stmt->bindValue($identifier, $this->competitor_id, PDO::PARAM_INT);

                        break;
                    case 'unit_id':
                        $stmt->bindValue($identifier, $this->unit_id, PDO::PARAM_INT);

                        break;
                    case 'qty':
                        $stmt->bindValue($identifier, $this->qty, PDO::PARAM_STR);

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
        $pos = CompetitionMappingTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getCompetitionName();

            case 2:
                return $this->getCompetitionSku();

            case 3:
                return $this->getCompetitionMrp();

            case 4:
                return $this->getCompetitionFeatures();

            case 5:
                return $this->getCompetitionRemark();

            case 6:
                return $this->getConsumerFeedback();

            case 7:
                return $this->getMediaId();

            case 8:
                return $this->getCompanyId();

            case 9:
                return $this->getEmployeeId();

            case 10:
                return $this->getOutletId();

            case 11:
                return $this->getCompetitorId();

            case 12:
                return $this->getUnitId();

            case 13:
                return $this->getQty();

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
        if (isset($alreadyDumpedObjects['CompetitionMapping'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['CompetitionMapping'][$this->hashCode()] = true;
        $keys = CompetitionMappingTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getId(),
            $keys[1] => $this->getCompetitionName(),
            $keys[2] => $this->getCompetitionSku(),
            $keys[3] => $this->getCompetitionMrp(),
            $keys[4] => $this->getCompetitionFeatures(),
            $keys[5] => $this->getCompetitionRemark(),
            $keys[6] => $this->getConsumerFeedback(),
            $keys[7] => $this->getMediaId(),
            $keys[8] => $this->getCompanyId(),
            $keys[9] => $this->getEmployeeId(),
            $keys[10] => $this->getOutletId(),
            $keys[11] => $this->getCompetitorId(),
            $keys[12] => $this->getUnitId(),
            $keys[13] => $this->getQty(),
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
            if (null !== $this->aCompetitor) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'competitor';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'competitor';
                        break;
                    default:
                        $key = 'Competitor';
                }

                $result[$key] = $this->aCompetitor->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aUnitmaster) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'unitmaster';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'unitmaster';
                        break;
                    default:
                        $key = 'Unitmaster';
                }

                $result[$key] = $this->aUnitmaster->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
        $pos = CompetitionMappingTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setCompetitionName($value);
                break;
            case 2:
                $this->setCompetitionSku($value);
                break;
            case 3:
                $this->setCompetitionMrp($value);
                break;
            case 4:
                $this->setCompetitionFeatures($value);
                break;
            case 5:
                $this->setCompetitionRemark($value);
                break;
            case 6:
                $this->setConsumerFeedback($value);
                break;
            case 7:
                $this->setMediaId($value);
                break;
            case 8:
                $this->setCompanyId($value);
                break;
            case 9:
                $this->setEmployeeId($value);
                break;
            case 10:
                $this->setOutletId($value);
                break;
            case 11:
                $this->setCompetitorId($value);
                break;
            case 12:
                $this->setUnitId($value);
                break;
            case 13:
                $this->setQty($value);
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
        $keys = CompetitionMappingTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setCompetitionName($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setCompetitionSku($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setCompetitionMrp($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setCompetitionFeatures($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setCompetitionRemark($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setConsumerFeedback($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setMediaId($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setCompanyId($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setEmployeeId($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setOutletId($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setCompetitorId($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setUnitId($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setQty($arr[$keys[13]]);
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
        $criteria = new Criteria(CompetitionMappingTableMap::DATABASE_NAME);

        if ($this->isColumnModified(CompetitionMappingTableMap::COL_ID)) {
            $criteria->add(CompetitionMappingTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(CompetitionMappingTableMap::COL_COMPETITION_NAME)) {
            $criteria->add(CompetitionMappingTableMap::COL_COMPETITION_NAME, $this->competition_name);
        }
        if ($this->isColumnModified(CompetitionMappingTableMap::COL_COMPETITION_SKU)) {
            $criteria->add(CompetitionMappingTableMap::COL_COMPETITION_SKU, $this->competition_sku);
        }
        if ($this->isColumnModified(CompetitionMappingTableMap::COL_COMPETITION_MRP)) {
            $criteria->add(CompetitionMappingTableMap::COL_COMPETITION_MRP, $this->competition_mrp);
        }
        if ($this->isColumnModified(CompetitionMappingTableMap::COL_COMPETITION_FEATURES)) {
            $criteria->add(CompetitionMappingTableMap::COL_COMPETITION_FEATURES, $this->competition_features);
        }
        if ($this->isColumnModified(CompetitionMappingTableMap::COL_COMPETITION_REMARK)) {
            $criteria->add(CompetitionMappingTableMap::COL_COMPETITION_REMARK, $this->competition_remark);
        }
        if ($this->isColumnModified(CompetitionMappingTableMap::COL_CONSUMER_FEEDBACK)) {
            $criteria->add(CompetitionMappingTableMap::COL_CONSUMER_FEEDBACK, $this->consumer_feedback);
        }
        if ($this->isColumnModified(CompetitionMappingTableMap::COL_MEDIA_ID)) {
            $criteria->add(CompetitionMappingTableMap::COL_MEDIA_ID, $this->media_id);
        }
        if ($this->isColumnModified(CompetitionMappingTableMap::COL_COMPANY_ID)) {
            $criteria->add(CompetitionMappingTableMap::COL_COMPANY_ID, $this->company_id);
        }
        if ($this->isColumnModified(CompetitionMappingTableMap::COL_EMPLOYEE_ID)) {
            $criteria->add(CompetitionMappingTableMap::COL_EMPLOYEE_ID, $this->employee_id);
        }
        if ($this->isColumnModified(CompetitionMappingTableMap::COL_OUTLET_ID)) {
            $criteria->add(CompetitionMappingTableMap::COL_OUTLET_ID, $this->outlet_id);
        }
        if ($this->isColumnModified(CompetitionMappingTableMap::COL_COMPETITOR_ID)) {
            $criteria->add(CompetitionMappingTableMap::COL_COMPETITOR_ID, $this->competitor_id);
        }
        if ($this->isColumnModified(CompetitionMappingTableMap::COL_UNIT_ID)) {
            $criteria->add(CompetitionMappingTableMap::COL_UNIT_ID, $this->unit_id);
        }
        if ($this->isColumnModified(CompetitionMappingTableMap::COL_QTY)) {
            $criteria->add(CompetitionMappingTableMap::COL_QTY, $this->qty);
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
        $criteria = ChildCompetitionMappingQuery::create();
        $criteria->add(CompetitionMappingTableMap::COL_ID, $this->id);

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
     * @param object $copyObj An object of \entities\CompetitionMapping (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setCompetitionName($this->getCompetitionName());
        $copyObj->setCompetitionSku($this->getCompetitionSku());
        $copyObj->setCompetitionMrp($this->getCompetitionMrp());
        $copyObj->setCompetitionFeatures($this->getCompetitionFeatures());
        $copyObj->setCompetitionRemark($this->getCompetitionRemark());
        $copyObj->setConsumerFeedback($this->getConsumerFeedback());
        $copyObj->setMediaId($this->getMediaId());
        $copyObj->setCompanyId($this->getCompanyId());
        $copyObj->setEmployeeId($this->getEmployeeId());
        $copyObj->setOutletId($this->getOutletId());
        $copyObj->setCompetitorId($this->getCompetitorId());
        $copyObj->setUnitId($this->getUnitId());
        $copyObj->setQty($this->getQty());
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
     * @return \entities\CompetitionMapping Clone of current object.
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
     * @param ChildCompany $v
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
            $v->addCompetitionMapping($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildCompany object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildCompany The associated ChildCompany object.
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
                $this->aCompany->addCompetitionMappings($this);
             */
        }

        return $this->aCompany;
    }

    /**
     * Declares an association between this object and a ChildEmployee object.
     *
     * @param ChildEmployee $v
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
            $v->addCompetitionMapping($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildEmployee object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildEmployee The associated ChildEmployee object.
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
                $this->aEmployee->addCompetitionMappings($this);
             */
        }

        return $this->aEmployee;
    }

    /**
     * Declares an association between this object and a ChildOutlets object.
     *
     * @param ChildOutlets $v
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
            $v->addCompetitionMapping($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildOutlets object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildOutlets The associated ChildOutlets object.
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
                $this->aOutlets->addCompetitionMappings($this);
             */
        }

        return $this->aOutlets;
    }

    /**
     * Declares an association between this object and a ChildCompetitor object.
     *
     * @param ChildCompetitor|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setCompetitor(ChildCompetitor $v = null)
    {
        if ($v === null) {
            $this->setCompetitorId(NULL);
        } else {
            $this->setCompetitorId($v->getId());
        }

        $this->aCompetitor = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildCompetitor object, it will not be re-added.
        if ($v !== null) {
            $v->addCompetitionMapping($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildCompetitor object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildCompetitor|null The associated ChildCompetitor object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getCompetitor(?ConnectionInterface $con = null)
    {
        if ($this->aCompetitor === null && ($this->competitor_id != 0)) {
            $this->aCompetitor = ChildCompetitorQuery::create()->findPk($this->competitor_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aCompetitor->addCompetitionMappings($this);
             */
        }

        return $this->aCompetitor;
    }

    /**
     * Declares an association between this object and a ChildUnitmaster object.
     *
     * @param ChildUnitmaster|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setUnitmaster(ChildUnitmaster $v = null)
    {
        if ($v === null) {
            $this->setUnitId(NULL);
        } else {
            $this->setUnitId($v->getUnitId());
        }

        $this->aUnitmaster = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildUnitmaster object, it will not be re-added.
        if ($v !== null) {
            $v->addCompetitionMapping($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildUnitmaster object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildUnitmaster|null The associated ChildUnitmaster object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getUnitmaster(?ConnectionInterface $con = null)
    {
        if ($this->aUnitmaster === null && ($this->unit_id != 0)) {
            $this->aUnitmaster = ChildUnitmasterQuery::create()->findPk($this->unit_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aUnitmaster->addCompetitionMappings($this);
             */
        }

        return $this->aUnitmaster;
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
            $this->aCompany->removeCompetitionMapping($this);
        }
        if (null !== $this->aEmployee) {
            $this->aEmployee->removeCompetitionMapping($this);
        }
        if (null !== $this->aOutlets) {
            $this->aOutlets->removeCompetitionMapping($this);
        }
        if (null !== $this->aCompetitor) {
            $this->aCompetitor->removeCompetitionMapping($this);
        }
        if (null !== $this->aUnitmaster) {
            $this->aUnitmaster->removeCompetitionMapping($this);
        }
        $this->id = null;
        $this->competition_name = null;
        $this->competition_sku = null;
        $this->competition_mrp = null;
        $this->competition_features = null;
        $this->competition_remark = null;
        $this->consumer_feedback = null;
        $this->media_id = null;
        $this->company_id = null;
        $this->employee_id = null;
        $this->outlet_id = null;
        $this->competitor_id = null;
        $this->unit_id = null;
        $this->qty = null;
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

        $this->aCompany = null;
        $this->aEmployee = null;
        $this->aOutlets = null;
        $this->aCompetitor = null;
        $this->aUnitmaster = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(CompetitionMappingTableMap::DEFAULT_STRING_FORMAT);
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
