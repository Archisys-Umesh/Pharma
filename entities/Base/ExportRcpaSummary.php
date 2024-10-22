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
use entities\Map\ExportRcpaSummaryTableMap;

/**
 * Base class that represents a row from the 'export_rcpa_summary' table.
 *
 *
 *
 * @package    propel.generator.entities.Base
 */
abstract class ExportRcpaSummary implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\entities\\Map\\ExportRcpaSummaryTableMap';


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
     * @var        string|null
     */
    protected $uniqueid;

    /**
     * The value for the orgunitid field.
     *
     * @var        string|null
     */
    protected $orgunitid;

    /**
     * The value for the zm_manager_branch field.
     *
     * @var        string|null
     */
    protected $zm_manager_branch;

    /**
     * The value for the zm_manager_town field.
     *
     * @var        string|null
     */
    protected $zm_manager_town;

    /**
     * The value for the rm_manager_branch field.
     *
     * @var        string|null
     */
    protected $rm_manager_branch;

    /**
     * The value for the rm_manager_town field.
     *
     * @var        string|null
     */
    protected $rm_manager_town;

    /**
     * The value for the am_manager_branch field.
     *
     * @var        string|null
     */
    protected $am_manager_branch;

    /**
     * The value for the am_manager_town field.
     *
     * @var        string|null
     */
    protected $am_manager_town;

    /**
     * The value for the zm_position_code field.
     *
     * @var        string|null
     */
    protected $zm_position_code;

    /**
     * The value for the rm_position_code field.
     *
     * @var        string|null
     */
    protected $rm_position_code;

    /**
     * The value for the am_position_code field.
     *
     * @var        string|null
     */
    protected $am_position_code;

    /**
     * The value for the emp_position_code field.
     *
     * @var        string|null
     */
    protected $emp_position_code;

    /**
     * The value for the emp_position_name field.
     *
     * @var        string|null
     */
    protected $emp_position_name;

    /**
     * The value for the emp_level field.
     *
     * @var        string|null
     */
    protected $emp_level;

    /**
     * The value for the employee_code field.
     *
     * @var        string|null
     */
    protected $employee_code;

    /**
     * The value for the emp_name field.
     *
     * @var        string|null
     */
    protected $emp_name;

    /**
     * The value for the drcode field.
     *
     * @var        string|null
     */
    protected $drcode;

    /**
     * The value for the drname field.
     *
     * @var        string|null
     */
    protected $drname;

    /**
     * The value for the retailercode field.
     *
     * @var        string|null
     */
    protected $retailercode;

    /**
     * The value for the retailername field.
     *
     * @var        string|null
     */
    protected $retailername;

    /**
     * The value for the outlet_classification field.
     *
     * @var        string|null
     */
    protected $outlet_classification;

    /**
     * The value for the visit_fq field.
     *
     * @var        int|null
     */
    protected $visit_fq;

    /**
     * The value for the territory field.
     *
     * @var        string|null
     */
    protected $territory;

    /**
     * The value for the tags field.
     *
     * @var        string|null
     */
    protected $tags;

    /**
     * The value for the rcpa_moye field.
     *
     * @var        string|null
     */
    protected $rcpa_moye;

    /**
     * The value for the brand_name field.
     *
     * @var        string|null
     */
    protected $brand_name;

    /**
     * The value for the competitor_name field.
     *
     * @var        string|null
     */
    protected $competitor_name;

    /**
     * The value for the rcpa_qty field.
     *
     * @var        string|null
     */
    protected $rcpa_qty;

    /**
     * The value for the own_rate field.
     *
     * @var        string|null
     */
    protected $own_rate;

    /**
     * The value for the competitor_rate field.
     *
     * @var        string|null
     */
    protected $competitor_rate;

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
     * The value for the min_value field.
     *
     * @var        int|null
     */
    protected $min_value;

    /**
     * The value for the emp_territory field.
     *
     * @var        string|null
     */
    protected $emp_territory;

    /**
     * The value for the emp_branch field.
     *
     * @var        string|null
     */
    protected $emp_branch;

    /**
     * The value for the emp_town field.
     *
     * @var        string|null
     */
    protected $emp_town;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * Initializes internal state of entities\Base\ExportRcpaSummary object.
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
     * Compares this with another <code>ExportRcpaSummary</code> instance.  If
     * <code>obj</code> is an instance of <code>ExportRcpaSummary</code>, delegates to
     * <code>equals(ExportRcpaSummary)</code>.  Otherwise, returns <code>false</code>.
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
     * @return string|null
     */
    public function getUniqueid()
    {
        return $this->uniqueid;
    }

    /**
     * Get the [orgunitid] column value.
     *
     * @return string|null
     */
    public function getOrgunitid()
    {
        return $this->orgunitid;
    }

    /**
     * Get the [zm_manager_branch] column value.
     *
     * @return string|null
     */
    public function getZmManagerBranch()
    {
        return $this->zm_manager_branch;
    }

    /**
     * Get the [zm_manager_town] column value.
     *
     * @return string|null
     */
    public function getZmManagerTown()
    {
        return $this->zm_manager_town;
    }

    /**
     * Get the [rm_manager_branch] column value.
     *
     * @return string|null
     */
    public function getRmManagerBranch()
    {
        return $this->rm_manager_branch;
    }

    /**
     * Get the [rm_manager_town] column value.
     *
     * @return string|null
     */
    public function getRmManagerTown()
    {
        return $this->rm_manager_town;
    }

    /**
     * Get the [am_manager_branch] column value.
     *
     * @return string|null
     */
    public function getAmManagerBranch()
    {
        return $this->am_manager_branch;
    }

    /**
     * Get the [am_manager_town] column value.
     *
     * @return string|null
     */
    public function getAmManagerTown()
    {
        return $this->am_manager_town;
    }

    /**
     * Get the [zm_position_code] column value.
     *
     * @return string|null
     */
    public function getZmPositionCode()
    {
        return $this->zm_position_code;
    }

    /**
     * Get the [rm_position_code] column value.
     *
     * @return string|null
     */
    public function getRmPositionCode()
    {
        return $this->rm_position_code;
    }

    /**
     * Get the [am_position_code] column value.
     *
     * @return string|null
     */
    public function getAmPositionCode()
    {
        return $this->am_position_code;
    }

    /**
     * Get the [emp_position_code] column value.
     *
     * @return string|null
     */
    public function getEmpPositionCode()
    {
        return $this->emp_position_code;
    }

    /**
     * Get the [emp_position_name] column value.
     *
     * @return string|null
     */
    public function getEmpPositionName()
    {
        return $this->emp_position_name;
    }

    /**
     * Get the [emp_level] column value.
     *
     * @return string|null
     */
    public function getEmpLevel()
    {
        return $this->emp_level;
    }

    /**
     * Get the [employee_code] column value.
     *
     * @return string|null
     */
    public function getEmployeeCode()
    {
        return $this->employee_code;
    }

    /**
     * Get the [emp_name] column value.
     *
     * @return string|null
     */
    public function getEmpName()
    {
        return $this->emp_name;
    }

    /**
     * Get the [drcode] column value.
     *
     * @return string|null
     */
    public function getDrcode()
    {
        return $this->drcode;
    }

    /**
     * Get the [drname] column value.
     *
     * @return string|null
     */
    public function getDrname()
    {
        return $this->drname;
    }

    /**
     * Get the [retailercode] column value.
     *
     * @return string|null
     */
    public function getRetailercode()
    {
        return $this->retailercode;
    }

    /**
     * Get the [retailername] column value.
     *
     * @return string|null
     */
    public function getRetailername()
    {
        return $this->retailername;
    }

    /**
     * Get the [outlet_classification] column value.
     *
     * @return string|null
     */
    public function getOutletClassification()
    {
        return $this->outlet_classification;
    }

    /**
     * Get the [visit_fq] column value.
     *
     * @return int|null
     */
    public function getVisitFq()
    {
        return $this->visit_fq;
    }

    /**
     * Get the [territory] column value.
     *
     * @return string|null
     */
    public function getTerritory()
    {
        return $this->territory;
    }

    /**
     * Get the [tags] column value.
     *
     * @return string|null
     */
    public function getTags()
    {
        return $this->tags;
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
     * Get the [brand_name] column value.
     *
     * @return string|null
     */
    public function getBrandName()
    {
        return $this->brand_name;
    }

    /**
     * Get the [competitor_name] column value.
     *
     * @return string|null
     */
    public function getCompetitorName()
    {
        return $this->competitor_name;
    }

    /**
     * Get the [rcpa_qty] column value.
     *
     * @return string|null
     */
    public function getRcpaQty()
    {
        return $this->rcpa_qty;
    }

    /**
     * Get the [own_rate] column value.
     *
     * @return string|null
     */
    public function getOwnRate()
    {
        return $this->own_rate;
    }

    /**
     * Get the [competitor_rate] column value.
     *
     * @return string|null
     */
    public function getCompetitorRate()
    {
        return $this->competitor_rate;
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
     * Get the [min_value] column value.
     *
     * @return int|null
     */
    public function getMinValue()
    {
        return $this->min_value;
    }

    /**
     * Get the [emp_territory] column value.
     *
     * @return string|null
     */
    public function getEmpTerritory()
    {
        return $this->emp_territory;
    }

    /**
     * Get the [emp_branch] column value.
     *
     * @return string|null
     */
    public function getEmpBranch()
    {
        return $this->emp_branch;
    }

    /**
     * Get the [emp_town] column value.
     *
     * @return string|null
     */
    public function getEmpTown()
    {
        return $this->emp_town;
    }

    /**
     * Set the value of [uniqueid] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setUniqueid($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->uniqueid !== $v) {
            $this->uniqueid = $v;
            $this->modifiedColumns[ExportRcpaSummaryTableMap::COL_UNIQUEID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [orgunitid] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOrgunitid($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->orgunitid !== $v) {
            $this->orgunitid = $v;
            $this->modifiedColumns[ExportRcpaSummaryTableMap::COL_ORGUNITID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [zm_manager_branch] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setZmManagerBranch($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->zm_manager_branch !== $v) {
            $this->zm_manager_branch = $v;
            $this->modifiedColumns[ExportRcpaSummaryTableMap::COL_ZM_MANAGER_BRANCH] = true;
        }

        return $this;
    }

    /**
     * Set the value of [zm_manager_town] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setZmManagerTown($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->zm_manager_town !== $v) {
            $this->zm_manager_town = $v;
            $this->modifiedColumns[ExportRcpaSummaryTableMap::COL_ZM_MANAGER_TOWN] = true;
        }

        return $this;
    }

    /**
     * Set the value of [rm_manager_branch] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setRmManagerBranch($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->rm_manager_branch !== $v) {
            $this->rm_manager_branch = $v;
            $this->modifiedColumns[ExportRcpaSummaryTableMap::COL_RM_MANAGER_BRANCH] = true;
        }

        return $this;
    }

    /**
     * Set the value of [rm_manager_town] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setRmManagerTown($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->rm_manager_town !== $v) {
            $this->rm_manager_town = $v;
            $this->modifiedColumns[ExportRcpaSummaryTableMap::COL_RM_MANAGER_TOWN] = true;
        }

        return $this;
    }

    /**
     * Set the value of [am_manager_branch] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setAmManagerBranch($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->am_manager_branch !== $v) {
            $this->am_manager_branch = $v;
            $this->modifiedColumns[ExportRcpaSummaryTableMap::COL_AM_MANAGER_BRANCH] = true;
        }

        return $this;
    }

    /**
     * Set the value of [am_manager_town] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setAmManagerTown($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->am_manager_town !== $v) {
            $this->am_manager_town = $v;
            $this->modifiedColumns[ExportRcpaSummaryTableMap::COL_AM_MANAGER_TOWN] = true;
        }

        return $this;
    }

    /**
     * Set the value of [zm_position_code] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setZmPositionCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->zm_position_code !== $v) {
            $this->zm_position_code = $v;
            $this->modifiedColumns[ExportRcpaSummaryTableMap::COL_ZM_POSITION_CODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [rm_position_code] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setRmPositionCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->rm_position_code !== $v) {
            $this->rm_position_code = $v;
            $this->modifiedColumns[ExportRcpaSummaryTableMap::COL_RM_POSITION_CODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [am_position_code] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setAmPositionCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->am_position_code !== $v) {
            $this->am_position_code = $v;
            $this->modifiedColumns[ExportRcpaSummaryTableMap::COL_AM_POSITION_CODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [emp_position_code] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setEmpPositionCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->emp_position_code !== $v) {
            $this->emp_position_code = $v;
            $this->modifiedColumns[ExportRcpaSummaryTableMap::COL_EMP_POSITION_CODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [emp_position_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setEmpPositionName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->emp_position_name !== $v) {
            $this->emp_position_name = $v;
            $this->modifiedColumns[ExportRcpaSummaryTableMap::COL_EMP_POSITION_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [emp_level] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setEmpLevel($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->emp_level !== $v) {
            $this->emp_level = $v;
            $this->modifiedColumns[ExportRcpaSummaryTableMap::COL_EMP_LEVEL] = true;
        }

        return $this;
    }

    /**
     * Set the value of [employee_code] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setEmployeeCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->employee_code !== $v) {
            $this->employee_code = $v;
            $this->modifiedColumns[ExportRcpaSummaryTableMap::COL_EMPLOYEE_CODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [emp_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setEmpName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->emp_name !== $v) {
            $this->emp_name = $v;
            $this->modifiedColumns[ExportRcpaSummaryTableMap::COL_EMP_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [drcode] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setDrcode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->drcode !== $v) {
            $this->drcode = $v;
            $this->modifiedColumns[ExportRcpaSummaryTableMap::COL_DRCODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [drname] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setDrname($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->drname !== $v) {
            $this->drname = $v;
            $this->modifiedColumns[ExportRcpaSummaryTableMap::COL_DRNAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [retailercode] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setRetailercode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->retailercode !== $v) {
            $this->retailercode = $v;
            $this->modifiedColumns[ExportRcpaSummaryTableMap::COL_RETAILERCODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [retailername] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setRetailername($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->retailername !== $v) {
            $this->retailername = $v;
            $this->modifiedColumns[ExportRcpaSummaryTableMap::COL_RETAILERNAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_classification] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOutletClassification($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->outlet_classification !== $v) {
            $this->outlet_classification = $v;
            $this->modifiedColumns[ExportRcpaSummaryTableMap::COL_OUTLET_CLASSIFICATION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [visit_fq] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setVisitFq($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->visit_fq !== $v) {
            $this->visit_fq = $v;
            $this->modifiedColumns[ExportRcpaSummaryTableMap::COL_VISIT_FQ] = true;
        }

        return $this;
    }

    /**
     * Set the value of [territory] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setTerritory($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->territory !== $v) {
            $this->territory = $v;
            $this->modifiedColumns[ExportRcpaSummaryTableMap::COL_TERRITORY] = true;
        }

        return $this;
    }

    /**
     * Set the value of [tags] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setTags($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->tags !== $v) {
            $this->tags = $v;
            $this->modifiedColumns[ExportRcpaSummaryTableMap::COL_TAGS] = true;
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
            $this->modifiedColumns[ExportRcpaSummaryTableMap::COL_RCPA_MOYE] = true;
        }

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
            $this->modifiedColumns[ExportRcpaSummaryTableMap::COL_BRAND_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [competitor_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setCompetitorName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->competitor_name !== $v) {
            $this->competitor_name = $v;
            $this->modifiedColumns[ExportRcpaSummaryTableMap::COL_COMPETITOR_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [rcpa_qty] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setRcpaQty($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->rcpa_qty !== $v) {
            $this->rcpa_qty = $v;
            $this->modifiedColumns[ExportRcpaSummaryTableMap::COL_RCPA_QTY] = true;
        }

        return $this;
    }

    /**
     * Set the value of [own_rate] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOwnRate($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->own_rate !== $v) {
            $this->own_rate = $v;
            $this->modifiedColumns[ExportRcpaSummaryTableMap::COL_OWN_RATE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [competitor_rate] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setCompetitorRate($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->competitor_rate !== $v) {
            $this->competitor_rate = $v;
            $this->modifiedColumns[ExportRcpaSummaryTableMap::COL_COMPETITOR_RATE] = true;
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
            $this->modifiedColumns[ExportRcpaSummaryTableMap::COL_POTENTIAL] = true;
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
            $this->modifiedColumns[ExportRcpaSummaryTableMap::COL_OWN] = true;
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
            $this->modifiedColumns[ExportRcpaSummaryTableMap::COL_COMPETITION] = true;
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
                $this->modifiedColumns[ExportRcpaSummaryTableMap::COL_CREATED_AT] = true;
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
                $this->modifiedColumns[ExportRcpaSummaryTableMap::COL_UPDATED_AT] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [min_value] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setMinValue($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->min_value !== $v) {
            $this->min_value = $v;
            $this->modifiedColumns[ExportRcpaSummaryTableMap::COL_MIN_VALUE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [emp_territory] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setEmpTerritory($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->emp_territory !== $v) {
            $this->emp_territory = $v;
            $this->modifiedColumns[ExportRcpaSummaryTableMap::COL_EMP_TERRITORY] = true;
        }

        return $this;
    }

    /**
     * Set the value of [emp_branch] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setEmpBranch($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->emp_branch !== $v) {
            $this->emp_branch = $v;
            $this->modifiedColumns[ExportRcpaSummaryTableMap::COL_EMP_BRANCH] = true;
        }

        return $this;
    }

    /**
     * Set the value of [emp_town] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setEmpTown($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->emp_town !== $v) {
            $this->emp_town = $v;
            $this->modifiedColumns[ExportRcpaSummaryTableMap::COL_EMP_TOWN] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : ExportRcpaSummaryTableMap::translateFieldName('Uniqueid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->uniqueid = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : ExportRcpaSummaryTableMap::translateFieldName('Orgunitid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->orgunitid = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : ExportRcpaSummaryTableMap::translateFieldName('ZmManagerBranch', TableMap::TYPE_PHPNAME, $indexType)];
            $this->zm_manager_branch = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : ExportRcpaSummaryTableMap::translateFieldName('ZmManagerTown', TableMap::TYPE_PHPNAME, $indexType)];
            $this->zm_manager_town = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : ExportRcpaSummaryTableMap::translateFieldName('RmManagerBranch', TableMap::TYPE_PHPNAME, $indexType)];
            $this->rm_manager_branch = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : ExportRcpaSummaryTableMap::translateFieldName('RmManagerTown', TableMap::TYPE_PHPNAME, $indexType)];
            $this->rm_manager_town = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : ExportRcpaSummaryTableMap::translateFieldName('AmManagerBranch', TableMap::TYPE_PHPNAME, $indexType)];
            $this->am_manager_branch = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : ExportRcpaSummaryTableMap::translateFieldName('AmManagerTown', TableMap::TYPE_PHPNAME, $indexType)];
            $this->am_manager_town = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : ExportRcpaSummaryTableMap::translateFieldName('ZmPositionCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->zm_position_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : ExportRcpaSummaryTableMap::translateFieldName('RmPositionCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->rm_position_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : ExportRcpaSummaryTableMap::translateFieldName('AmPositionCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->am_position_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : ExportRcpaSummaryTableMap::translateFieldName('EmpPositionCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->emp_position_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : ExportRcpaSummaryTableMap::translateFieldName('EmpPositionName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->emp_position_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : ExportRcpaSummaryTableMap::translateFieldName('EmpLevel', TableMap::TYPE_PHPNAME, $indexType)];
            $this->emp_level = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : ExportRcpaSummaryTableMap::translateFieldName('EmployeeCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->employee_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : ExportRcpaSummaryTableMap::translateFieldName('EmpName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->emp_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : ExportRcpaSummaryTableMap::translateFieldName('Drcode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->drcode = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : ExportRcpaSummaryTableMap::translateFieldName('Drname', TableMap::TYPE_PHPNAME, $indexType)];
            $this->drname = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 18 + $startcol : ExportRcpaSummaryTableMap::translateFieldName('Retailercode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->retailercode = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 19 + $startcol : ExportRcpaSummaryTableMap::translateFieldName('Retailername', TableMap::TYPE_PHPNAME, $indexType)];
            $this->retailername = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 20 + $startcol : ExportRcpaSummaryTableMap::translateFieldName('OutletClassification', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_classification = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 21 + $startcol : ExportRcpaSummaryTableMap::translateFieldName('VisitFq', TableMap::TYPE_PHPNAME, $indexType)];
            $this->visit_fq = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 22 + $startcol : ExportRcpaSummaryTableMap::translateFieldName('Territory', TableMap::TYPE_PHPNAME, $indexType)];
            $this->territory = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 23 + $startcol : ExportRcpaSummaryTableMap::translateFieldName('Tags', TableMap::TYPE_PHPNAME, $indexType)];
            $this->tags = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 24 + $startcol : ExportRcpaSummaryTableMap::translateFieldName('RcpaMoye', TableMap::TYPE_PHPNAME, $indexType)];
            $this->rcpa_moye = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 25 + $startcol : ExportRcpaSummaryTableMap::translateFieldName('BrandName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->brand_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 26 + $startcol : ExportRcpaSummaryTableMap::translateFieldName('CompetitorName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->competitor_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 27 + $startcol : ExportRcpaSummaryTableMap::translateFieldName('RcpaQty', TableMap::TYPE_PHPNAME, $indexType)];
            $this->rcpa_qty = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 28 + $startcol : ExportRcpaSummaryTableMap::translateFieldName('OwnRate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->own_rate = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 29 + $startcol : ExportRcpaSummaryTableMap::translateFieldName('CompetitorRate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->competitor_rate = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 30 + $startcol : ExportRcpaSummaryTableMap::translateFieldName('Potential', TableMap::TYPE_PHPNAME, $indexType)];
            $this->potential = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 31 + $startcol : ExportRcpaSummaryTableMap::translateFieldName('Own', TableMap::TYPE_PHPNAME, $indexType)];
            $this->own = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 32 + $startcol : ExportRcpaSummaryTableMap::translateFieldName('Competition', TableMap::TYPE_PHPNAME, $indexType)];
            $this->competition = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 33 + $startcol : ExportRcpaSummaryTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 34 + $startcol : ExportRcpaSummaryTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 35 + $startcol : ExportRcpaSummaryTableMap::translateFieldName('MinValue', TableMap::TYPE_PHPNAME, $indexType)];
            $this->min_value = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 36 + $startcol : ExportRcpaSummaryTableMap::translateFieldName('EmpTerritory', TableMap::TYPE_PHPNAME, $indexType)];
            $this->emp_territory = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 37 + $startcol : ExportRcpaSummaryTableMap::translateFieldName('EmpBranch', TableMap::TYPE_PHPNAME, $indexType)];
            $this->emp_branch = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 38 + $startcol : ExportRcpaSummaryTableMap::translateFieldName('EmpTown', TableMap::TYPE_PHPNAME, $indexType)];
            $this->emp_town = (null !== $col) ? (string) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 39; // 39 = ExportRcpaSummaryTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\entities\\ExportRcpaSummary'), 0, $e);
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
        $pos = ExportRcpaSummaryTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getOrgunitid();

            case 2:
                return $this->getZmManagerBranch();

            case 3:
                return $this->getZmManagerTown();

            case 4:
                return $this->getRmManagerBranch();

            case 5:
                return $this->getRmManagerTown();

            case 6:
                return $this->getAmManagerBranch();

            case 7:
                return $this->getAmManagerTown();

            case 8:
                return $this->getZmPositionCode();

            case 9:
                return $this->getRmPositionCode();

            case 10:
                return $this->getAmPositionCode();

            case 11:
                return $this->getEmpPositionCode();

            case 12:
                return $this->getEmpPositionName();

            case 13:
                return $this->getEmpLevel();

            case 14:
                return $this->getEmployeeCode();

            case 15:
                return $this->getEmpName();

            case 16:
                return $this->getDrcode();

            case 17:
                return $this->getDrname();

            case 18:
                return $this->getRetailercode();

            case 19:
                return $this->getRetailername();

            case 20:
                return $this->getOutletClassification();

            case 21:
                return $this->getVisitFq();

            case 22:
                return $this->getTerritory();

            case 23:
                return $this->getTags();

            case 24:
                return $this->getRcpaMoye();

            case 25:
                return $this->getBrandName();

            case 26:
                return $this->getCompetitorName();

            case 27:
                return $this->getRcpaQty();

            case 28:
                return $this->getOwnRate();

            case 29:
                return $this->getCompetitorRate();

            case 30:
                return $this->getPotential();

            case 31:
                return $this->getOwn();

            case 32:
                return $this->getCompetition();

            case 33:
                return $this->getCreatedAt();

            case 34:
                return $this->getUpdatedAt();

            case 35:
                return $this->getMinValue();

            case 36:
                return $this->getEmpTerritory();

            case 37:
                return $this->getEmpBranch();

            case 38:
                return $this->getEmpTown();

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
        if (isset($alreadyDumpedObjects['ExportRcpaSummary'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['ExportRcpaSummary'][$this->hashCode()] = true;
        $keys = ExportRcpaSummaryTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getUniqueid(),
            $keys[1] => $this->getOrgunitid(),
            $keys[2] => $this->getZmManagerBranch(),
            $keys[3] => $this->getZmManagerTown(),
            $keys[4] => $this->getRmManagerBranch(),
            $keys[5] => $this->getRmManagerTown(),
            $keys[6] => $this->getAmManagerBranch(),
            $keys[7] => $this->getAmManagerTown(),
            $keys[8] => $this->getZmPositionCode(),
            $keys[9] => $this->getRmPositionCode(),
            $keys[10] => $this->getAmPositionCode(),
            $keys[11] => $this->getEmpPositionCode(),
            $keys[12] => $this->getEmpPositionName(),
            $keys[13] => $this->getEmpLevel(),
            $keys[14] => $this->getEmployeeCode(),
            $keys[15] => $this->getEmpName(),
            $keys[16] => $this->getDrcode(),
            $keys[17] => $this->getDrname(),
            $keys[18] => $this->getRetailercode(),
            $keys[19] => $this->getRetailername(),
            $keys[20] => $this->getOutletClassification(),
            $keys[21] => $this->getVisitFq(),
            $keys[22] => $this->getTerritory(),
            $keys[23] => $this->getTags(),
            $keys[24] => $this->getRcpaMoye(),
            $keys[25] => $this->getBrandName(),
            $keys[26] => $this->getCompetitorName(),
            $keys[27] => $this->getRcpaQty(),
            $keys[28] => $this->getOwnRate(),
            $keys[29] => $this->getCompetitorRate(),
            $keys[30] => $this->getPotential(),
            $keys[31] => $this->getOwn(),
            $keys[32] => $this->getCompetition(),
            $keys[33] => $this->getCreatedAt(),
            $keys[34] => $this->getUpdatedAt(),
            $keys[35] => $this->getMinValue(),
            $keys[36] => $this->getEmpTerritory(),
            $keys[37] => $this->getEmpBranch(),
            $keys[38] => $this->getEmpTown(),
        ];
        if ($result[$keys[33]] instanceof \DateTimeInterface) {
            $result[$keys[33]] = $result[$keys[33]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[34]] instanceof \DateTimeInterface) {
            $result[$keys[34]] = $result[$keys[34]]->format('Y-m-d H:i:s.u');
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
        $criteria = new Criteria(ExportRcpaSummaryTableMap::DATABASE_NAME);

        if ($this->isColumnModified(ExportRcpaSummaryTableMap::COL_UNIQUEID)) {
            $criteria->add(ExportRcpaSummaryTableMap::COL_UNIQUEID, $this->uniqueid);
        }
        if ($this->isColumnModified(ExportRcpaSummaryTableMap::COL_ORGUNITID)) {
            $criteria->add(ExportRcpaSummaryTableMap::COL_ORGUNITID, $this->orgunitid);
        }
        if ($this->isColumnModified(ExportRcpaSummaryTableMap::COL_ZM_MANAGER_BRANCH)) {
            $criteria->add(ExportRcpaSummaryTableMap::COL_ZM_MANAGER_BRANCH, $this->zm_manager_branch);
        }
        if ($this->isColumnModified(ExportRcpaSummaryTableMap::COL_ZM_MANAGER_TOWN)) {
            $criteria->add(ExportRcpaSummaryTableMap::COL_ZM_MANAGER_TOWN, $this->zm_manager_town);
        }
        if ($this->isColumnModified(ExportRcpaSummaryTableMap::COL_RM_MANAGER_BRANCH)) {
            $criteria->add(ExportRcpaSummaryTableMap::COL_RM_MANAGER_BRANCH, $this->rm_manager_branch);
        }
        if ($this->isColumnModified(ExportRcpaSummaryTableMap::COL_RM_MANAGER_TOWN)) {
            $criteria->add(ExportRcpaSummaryTableMap::COL_RM_MANAGER_TOWN, $this->rm_manager_town);
        }
        if ($this->isColumnModified(ExportRcpaSummaryTableMap::COL_AM_MANAGER_BRANCH)) {
            $criteria->add(ExportRcpaSummaryTableMap::COL_AM_MANAGER_BRANCH, $this->am_manager_branch);
        }
        if ($this->isColumnModified(ExportRcpaSummaryTableMap::COL_AM_MANAGER_TOWN)) {
            $criteria->add(ExportRcpaSummaryTableMap::COL_AM_MANAGER_TOWN, $this->am_manager_town);
        }
        if ($this->isColumnModified(ExportRcpaSummaryTableMap::COL_ZM_POSITION_CODE)) {
            $criteria->add(ExportRcpaSummaryTableMap::COL_ZM_POSITION_CODE, $this->zm_position_code);
        }
        if ($this->isColumnModified(ExportRcpaSummaryTableMap::COL_RM_POSITION_CODE)) {
            $criteria->add(ExportRcpaSummaryTableMap::COL_RM_POSITION_CODE, $this->rm_position_code);
        }
        if ($this->isColumnModified(ExportRcpaSummaryTableMap::COL_AM_POSITION_CODE)) {
            $criteria->add(ExportRcpaSummaryTableMap::COL_AM_POSITION_CODE, $this->am_position_code);
        }
        if ($this->isColumnModified(ExportRcpaSummaryTableMap::COL_EMP_POSITION_CODE)) {
            $criteria->add(ExportRcpaSummaryTableMap::COL_EMP_POSITION_CODE, $this->emp_position_code);
        }
        if ($this->isColumnModified(ExportRcpaSummaryTableMap::COL_EMP_POSITION_NAME)) {
            $criteria->add(ExportRcpaSummaryTableMap::COL_EMP_POSITION_NAME, $this->emp_position_name);
        }
        if ($this->isColumnModified(ExportRcpaSummaryTableMap::COL_EMP_LEVEL)) {
            $criteria->add(ExportRcpaSummaryTableMap::COL_EMP_LEVEL, $this->emp_level);
        }
        if ($this->isColumnModified(ExportRcpaSummaryTableMap::COL_EMPLOYEE_CODE)) {
            $criteria->add(ExportRcpaSummaryTableMap::COL_EMPLOYEE_CODE, $this->employee_code);
        }
        if ($this->isColumnModified(ExportRcpaSummaryTableMap::COL_EMP_NAME)) {
            $criteria->add(ExportRcpaSummaryTableMap::COL_EMP_NAME, $this->emp_name);
        }
        if ($this->isColumnModified(ExportRcpaSummaryTableMap::COL_DRCODE)) {
            $criteria->add(ExportRcpaSummaryTableMap::COL_DRCODE, $this->drcode);
        }
        if ($this->isColumnModified(ExportRcpaSummaryTableMap::COL_DRNAME)) {
            $criteria->add(ExportRcpaSummaryTableMap::COL_DRNAME, $this->drname);
        }
        if ($this->isColumnModified(ExportRcpaSummaryTableMap::COL_RETAILERCODE)) {
            $criteria->add(ExportRcpaSummaryTableMap::COL_RETAILERCODE, $this->retailercode);
        }
        if ($this->isColumnModified(ExportRcpaSummaryTableMap::COL_RETAILERNAME)) {
            $criteria->add(ExportRcpaSummaryTableMap::COL_RETAILERNAME, $this->retailername);
        }
        if ($this->isColumnModified(ExportRcpaSummaryTableMap::COL_OUTLET_CLASSIFICATION)) {
            $criteria->add(ExportRcpaSummaryTableMap::COL_OUTLET_CLASSIFICATION, $this->outlet_classification);
        }
        if ($this->isColumnModified(ExportRcpaSummaryTableMap::COL_VISIT_FQ)) {
            $criteria->add(ExportRcpaSummaryTableMap::COL_VISIT_FQ, $this->visit_fq);
        }
        if ($this->isColumnModified(ExportRcpaSummaryTableMap::COL_TERRITORY)) {
            $criteria->add(ExportRcpaSummaryTableMap::COL_TERRITORY, $this->territory);
        }
        if ($this->isColumnModified(ExportRcpaSummaryTableMap::COL_TAGS)) {
            $criteria->add(ExportRcpaSummaryTableMap::COL_TAGS, $this->tags);
        }
        if ($this->isColumnModified(ExportRcpaSummaryTableMap::COL_RCPA_MOYE)) {
            $criteria->add(ExportRcpaSummaryTableMap::COL_RCPA_MOYE, $this->rcpa_moye);
        }
        if ($this->isColumnModified(ExportRcpaSummaryTableMap::COL_BRAND_NAME)) {
            $criteria->add(ExportRcpaSummaryTableMap::COL_BRAND_NAME, $this->brand_name);
        }
        if ($this->isColumnModified(ExportRcpaSummaryTableMap::COL_COMPETITOR_NAME)) {
            $criteria->add(ExportRcpaSummaryTableMap::COL_COMPETITOR_NAME, $this->competitor_name);
        }
        if ($this->isColumnModified(ExportRcpaSummaryTableMap::COL_RCPA_QTY)) {
            $criteria->add(ExportRcpaSummaryTableMap::COL_RCPA_QTY, $this->rcpa_qty);
        }
        if ($this->isColumnModified(ExportRcpaSummaryTableMap::COL_OWN_RATE)) {
            $criteria->add(ExportRcpaSummaryTableMap::COL_OWN_RATE, $this->own_rate);
        }
        if ($this->isColumnModified(ExportRcpaSummaryTableMap::COL_COMPETITOR_RATE)) {
            $criteria->add(ExportRcpaSummaryTableMap::COL_COMPETITOR_RATE, $this->competitor_rate);
        }
        if ($this->isColumnModified(ExportRcpaSummaryTableMap::COL_POTENTIAL)) {
            $criteria->add(ExportRcpaSummaryTableMap::COL_POTENTIAL, $this->potential);
        }
        if ($this->isColumnModified(ExportRcpaSummaryTableMap::COL_OWN)) {
            $criteria->add(ExportRcpaSummaryTableMap::COL_OWN, $this->own);
        }
        if ($this->isColumnModified(ExportRcpaSummaryTableMap::COL_COMPETITION)) {
            $criteria->add(ExportRcpaSummaryTableMap::COL_COMPETITION, $this->competition);
        }
        if ($this->isColumnModified(ExportRcpaSummaryTableMap::COL_CREATED_AT)) {
            $criteria->add(ExportRcpaSummaryTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(ExportRcpaSummaryTableMap::COL_UPDATED_AT)) {
            $criteria->add(ExportRcpaSummaryTableMap::COL_UPDATED_AT, $this->updated_at);
        }
        if ($this->isColumnModified(ExportRcpaSummaryTableMap::COL_MIN_VALUE)) {
            $criteria->add(ExportRcpaSummaryTableMap::COL_MIN_VALUE, $this->min_value);
        }
        if ($this->isColumnModified(ExportRcpaSummaryTableMap::COL_EMP_TERRITORY)) {
            $criteria->add(ExportRcpaSummaryTableMap::COL_EMP_TERRITORY, $this->emp_territory);
        }
        if ($this->isColumnModified(ExportRcpaSummaryTableMap::COL_EMP_BRANCH)) {
            $criteria->add(ExportRcpaSummaryTableMap::COL_EMP_BRANCH, $this->emp_branch);
        }
        if ($this->isColumnModified(ExportRcpaSummaryTableMap::COL_EMP_TOWN)) {
            $criteria->add(ExportRcpaSummaryTableMap::COL_EMP_TOWN, $this->emp_town);
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
        throw new LogicException('The ExportRcpaSummary object has no primary key');

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
        $validPk = false;

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
     * Returns NULL since this table doesn't have a primary key.
     * This method exists only for BC and is deprecated!
     * @return null
     */
    public function getPrimaryKey()
    {
        return null;
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return false;
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \entities\ExportRcpaSummary (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setUniqueid($this->getUniqueid());
        $copyObj->setOrgunitid($this->getOrgunitid());
        $copyObj->setZmManagerBranch($this->getZmManagerBranch());
        $copyObj->setZmManagerTown($this->getZmManagerTown());
        $copyObj->setRmManagerBranch($this->getRmManagerBranch());
        $copyObj->setRmManagerTown($this->getRmManagerTown());
        $copyObj->setAmManagerBranch($this->getAmManagerBranch());
        $copyObj->setAmManagerTown($this->getAmManagerTown());
        $copyObj->setZmPositionCode($this->getZmPositionCode());
        $copyObj->setRmPositionCode($this->getRmPositionCode());
        $copyObj->setAmPositionCode($this->getAmPositionCode());
        $copyObj->setEmpPositionCode($this->getEmpPositionCode());
        $copyObj->setEmpPositionName($this->getEmpPositionName());
        $copyObj->setEmpLevel($this->getEmpLevel());
        $copyObj->setEmployeeCode($this->getEmployeeCode());
        $copyObj->setEmpName($this->getEmpName());
        $copyObj->setDrcode($this->getDrcode());
        $copyObj->setDrname($this->getDrname());
        $copyObj->setRetailercode($this->getRetailercode());
        $copyObj->setRetailername($this->getRetailername());
        $copyObj->setOutletClassification($this->getOutletClassification());
        $copyObj->setVisitFq($this->getVisitFq());
        $copyObj->setTerritory($this->getTerritory());
        $copyObj->setTags($this->getTags());
        $copyObj->setRcpaMoye($this->getRcpaMoye());
        $copyObj->setBrandName($this->getBrandName());
        $copyObj->setCompetitorName($this->getCompetitorName());
        $copyObj->setRcpaQty($this->getRcpaQty());
        $copyObj->setOwnRate($this->getOwnRate());
        $copyObj->setCompetitorRate($this->getCompetitorRate());
        $copyObj->setPotential($this->getPotential());
        $copyObj->setOwn($this->getOwn());
        $copyObj->setCompetition($this->getCompetition());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        $copyObj->setMinValue($this->getMinValue());
        $copyObj->setEmpTerritory($this->getEmpTerritory());
        $copyObj->setEmpBranch($this->getEmpBranch());
        $copyObj->setEmpTown($this->getEmpTown());
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
     * @return \entities\ExportRcpaSummary Clone of current object.
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
        $this->orgunitid = null;
        $this->zm_manager_branch = null;
        $this->zm_manager_town = null;
        $this->rm_manager_branch = null;
        $this->rm_manager_town = null;
        $this->am_manager_branch = null;
        $this->am_manager_town = null;
        $this->zm_position_code = null;
        $this->rm_position_code = null;
        $this->am_position_code = null;
        $this->emp_position_code = null;
        $this->emp_position_name = null;
        $this->emp_level = null;
        $this->employee_code = null;
        $this->emp_name = null;
        $this->drcode = null;
        $this->drname = null;
        $this->retailercode = null;
        $this->retailername = null;
        $this->outlet_classification = null;
        $this->visit_fq = null;
        $this->territory = null;
        $this->tags = null;
        $this->rcpa_moye = null;
        $this->brand_name = null;
        $this->competitor_name = null;
        $this->rcpa_qty = null;
        $this->own_rate = null;
        $this->competitor_rate = null;
        $this->potential = null;
        $this->own = null;
        $this->competition = null;
        $this->created_at = null;
        $this->updated_at = null;
        $this->min_value = null;
        $this->emp_territory = null;
        $this->emp_branch = null;
        $this->emp_town = null;
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
        return (string) $this->exportTo(ExportRcpaSummaryTableMap::DEFAULT_STRING_FORMAT);
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
