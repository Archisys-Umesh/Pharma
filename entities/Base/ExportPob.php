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
use entities\Map\ExportPobTableMap;

/**
 * Base class that represents a row from the 'export_pob' table.
 *
 *
 *
 * @package    propel.generator.entities.Base
 */
abstract class ExportPob implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\entities\\Map\\ExportPobTableMap';


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
     * The value for the bu_name field.
     *
     * @var        string|null
     */
    protected $bu_name;

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
     * The value for the employee field.
     *
     * @var        string|null
     */
    protected $employee;

    /**
     * The value for the designation field.
     *
     * @var        string|null
     */
    protected $designation;

    /**
     * The value for the from_outlet_type field.
     *
     * @var        string|null
     */
    protected $from_outlet_type;

    /**
     * The value for the from_outlet_code field.
     *
     * @var        string|null
     */
    protected $from_outlet_code;

    /**
     * The value for the from_outlet_name field.
     *
     * @var        string|null
     */
    protected $from_outlet_name;

    /**
     * The value for the from_outlet_classification field.
     *
     * @var        string|null
     */
    protected $from_outlet_classification;

    /**
     * The value for the to_outlet_type field.
     *
     * @var        string|null
     */
    protected $to_outlet_type;

    /**
     * The value for the to_outlet_code field.
     *
     * @var        string|null
     */
    protected $to_outlet_code;

    /**
     * The value for the to_outlet_name field.
     *
     * @var        string|null
     */
    protected $to_outlet_name;

    /**
     * The value for the to_outlet_classification field.
     *
     * @var        string|null
     */
    protected $to_outlet_classification;

    /**
     * The value for the product_name field.
     *
     * @var        string|null
     */
    protected $product_name;

    /**
     * The value for the product_sku field.
     *
     * @var        string|null
     */
    protected $product_sku;

    /**
     * The value for the rate field.
     *
     * @var        string|null
     */
    protected $rate;

    /**
     * The value for the qty field.
     *
     * @var        int|null
     */
    protected $qty;

    /**
     * The value for the total_amt field.
     *
     * @var        string|null
     */
    protected $total_amt;

    /**
     * The value for the order_date field.
     *
     * @var        DateTime|null
     */
    protected $order_date;

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
     * Initializes internal state of entities\Base\ExportPob object.
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
     * Compares this with another <code>ExportPob</code> instance.  If
     * <code>obj</code> is an instance of <code>ExportPob</code>, delegates to
     * <code>equals(ExportPob)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [bu_name] column value.
     *
     * @return string|null
     */
    public function getBuName()
    {
        return $this->bu_name;
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
     * Get the [employee] column value.
     *
     * @return string|null
     */
    public function getEmployee()
    {
        return $this->employee;
    }

    /**
     * Get the [designation] column value.
     *
     * @return string|null
     */
    public function getDesignation()
    {
        return $this->designation;
    }

    /**
     * Get the [from_outlet_type] column value.
     *
     * @return string|null
     */
    public function getFromOutletType()
    {
        return $this->from_outlet_type;
    }

    /**
     * Get the [from_outlet_code] column value.
     *
     * @return string|null
     */
    public function getFromOutletCode()
    {
        return $this->from_outlet_code;
    }

    /**
     * Get the [from_outlet_name] column value.
     *
     * @return string|null
     */
    public function getFromOutletName()
    {
        return $this->from_outlet_name;
    }

    /**
     * Get the [from_outlet_classification] column value.
     *
     * @return string|null
     */
    public function getFromOutletClassification()
    {
        return $this->from_outlet_classification;
    }

    /**
     * Get the [to_outlet_type] column value.
     *
     * @return string|null
     */
    public function getToOutletType()
    {
        return $this->to_outlet_type;
    }

    /**
     * Get the [to_outlet_code] column value.
     *
     * @return string|null
     */
    public function getToOutletCode()
    {
        return $this->to_outlet_code;
    }

    /**
     * Get the [to_outlet_name] column value.
     *
     * @return string|null
     */
    public function getToOutletName()
    {
        return $this->to_outlet_name;
    }

    /**
     * Get the [to_outlet_classification] column value.
     *
     * @return string|null
     */
    public function getToOutletClassification()
    {
        return $this->to_outlet_classification;
    }

    /**
     * Get the [product_name] column value.
     *
     * @return string|null
     */
    public function getProductName()
    {
        return $this->product_name;
    }

    /**
     * Get the [product_sku] column value.
     *
     * @return string|null
     */
    public function getProductSku()
    {
        return $this->product_sku;
    }

    /**
     * Get the [rate] column value.
     *
     * @return string|null
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * Get the [qty] column value.
     *
     * @return int|null
     */
    public function getQty()
    {
        return $this->qty;
    }

    /**
     * Get the [total_amt] column value.
     *
     * @return string|null
     */
    public function getTotalAmt()
    {
        return $this->total_amt;
    }

    /**
     * Get the [optionally formatted] temporal [order_date] column value.
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
    public function getOrderDate($format = null)
    {
        if ($format === null) {
            return $this->order_date;
        } else {
            return $this->order_date instanceof \DateTimeInterface ? $this->order_date->format($format) : null;
        }
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
     * Set the value of [bu_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setBuName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->bu_name !== $v) {
            $this->bu_name = $v;
            $this->modifiedColumns[ExportPobTableMap::COL_BU_NAME] = true;
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
            $this->modifiedColumns[ExportPobTableMap::COL_ZM_MANAGER_BRANCH] = true;
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
            $this->modifiedColumns[ExportPobTableMap::COL_ZM_MANAGER_TOWN] = true;
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
            $this->modifiedColumns[ExportPobTableMap::COL_RM_MANAGER_BRANCH] = true;
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
            $this->modifiedColumns[ExportPobTableMap::COL_RM_MANAGER_TOWN] = true;
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
            $this->modifiedColumns[ExportPobTableMap::COL_AM_MANAGER_BRANCH] = true;
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
            $this->modifiedColumns[ExportPobTableMap::COL_AM_MANAGER_TOWN] = true;
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
            $this->modifiedColumns[ExportPobTableMap::COL_ZM_POSITION_CODE] = true;
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
            $this->modifiedColumns[ExportPobTableMap::COL_RM_POSITION_CODE] = true;
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
            $this->modifiedColumns[ExportPobTableMap::COL_AM_POSITION_CODE] = true;
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
            $this->modifiedColumns[ExportPobTableMap::COL_EMP_POSITION_CODE] = true;
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
            $this->modifiedColumns[ExportPobTableMap::COL_EMP_POSITION_NAME] = true;
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
            $this->modifiedColumns[ExportPobTableMap::COL_EMP_LEVEL] = true;
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
            $this->modifiedColumns[ExportPobTableMap::COL_EMPLOYEE_CODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [employee] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setEmployee($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->employee !== $v) {
            $this->employee = $v;
            $this->modifiedColumns[ExportPobTableMap::COL_EMPLOYEE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [designation] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setDesignation($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->designation !== $v) {
            $this->designation = $v;
            $this->modifiedColumns[ExportPobTableMap::COL_DESIGNATION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [from_outlet_type] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setFromOutletType($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->from_outlet_type !== $v) {
            $this->from_outlet_type = $v;
            $this->modifiedColumns[ExportPobTableMap::COL_FROM_OUTLET_TYPE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [from_outlet_code] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setFromOutletCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->from_outlet_code !== $v) {
            $this->from_outlet_code = $v;
            $this->modifiedColumns[ExportPobTableMap::COL_FROM_OUTLET_CODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [from_outlet_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setFromOutletName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->from_outlet_name !== $v) {
            $this->from_outlet_name = $v;
            $this->modifiedColumns[ExportPobTableMap::COL_FROM_OUTLET_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [from_outlet_classification] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setFromOutletClassification($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->from_outlet_classification !== $v) {
            $this->from_outlet_classification = $v;
            $this->modifiedColumns[ExportPobTableMap::COL_FROM_OUTLET_CLASSIFICATION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [to_outlet_type] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setToOutletType($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->to_outlet_type !== $v) {
            $this->to_outlet_type = $v;
            $this->modifiedColumns[ExportPobTableMap::COL_TO_OUTLET_TYPE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [to_outlet_code] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setToOutletCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->to_outlet_code !== $v) {
            $this->to_outlet_code = $v;
            $this->modifiedColumns[ExportPobTableMap::COL_TO_OUTLET_CODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [to_outlet_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setToOutletName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->to_outlet_name !== $v) {
            $this->to_outlet_name = $v;
            $this->modifiedColumns[ExportPobTableMap::COL_TO_OUTLET_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [to_outlet_classification] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setToOutletClassification($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->to_outlet_classification !== $v) {
            $this->to_outlet_classification = $v;
            $this->modifiedColumns[ExportPobTableMap::COL_TO_OUTLET_CLASSIFICATION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [product_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setProductName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->product_name !== $v) {
            $this->product_name = $v;
            $this->modifiedColumns[ExportPobTableMap::COL_PRODUCT_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [product_sku] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setProductSku($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->product_sku !== $v) {
            $this->product_sku = $v;
            $this->modifiedColumns[ExportPobTableMap::COL_PRODUCT_SKU] = true;
        }

        return $this;
    }

    /**
     * Set the value of [rate] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setRate($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->rate !== $v) {
            $this->rate = $v;
            $this->modifiedColumns[ExportPobTableMap::COL_RATE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [qty] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setQty($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->qty !== $v) {
            $this->qty = $v;
            $this->modifiedColumns[ExportPobTableMap::COL_QTY] = true;
        }

        return $this;
    }

    /**
     * Set the value of [total_amt] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setTotalAmt($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->total_amt !== $v) {
            $this->total_amt = $v;
            $this->modifiedColumns[ExportPobTableMap::COL_TOTAL_AMT] = true;
        }

        return $this;
    }

    /**
     * Sets the value of [order_date] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    protected function setOrderDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->order_date !== null || $dt !== null) {
            if ($this->order_date === null || $dt === null || $dt->format("Y-m-d") !== $this->order_date->format("Y-m-d")) {
                $this->order_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[ExportPobTableMap::COL_ORDER_DATE] = true;
            }
        } // if either are not null

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
            $this->modifiedColumns[ExportPobTableMap::COL_EMP_TERRITORY] = true;
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
            $this->modifiedColumns[ExportPobTableMap::COL_EMP_BRANCH] = true;
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
            $this->modifiedColumns[ExportPobTableMap::COL_EMP_TOWN] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : ExportPobTableMap::translateFieldName('BuName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->bu_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : ExportPobTableMap::translateFieldName('ZmManagerBranch', TableMap::TYPE_PHPNAME, $indexType)];
            $this->zm_manager_branch = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : ExportPobTableMap::translateFieldName('ZmManagerTown', TableMap::TYPE_PHPNAME, $indexType)];
            $this->zm_manager_town = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : ExportPobTableMap::translateFieldName('RmManagerBranch', TableMap::TYPE_PHPNAME, $indexType)];
            $this->rm_manager_branch = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : ExportPobTableMap::translateFieldName('RmManagerTown', TableMap::TYPE_PHPNAME, $indexType)];
            $this->rm_manager_town = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : ExportPobTableMap::translateFieldName('AmManagerBranch', TableMap::TYPE_PHPNAME, $indexType)];
            $this->am_manager_branch = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : ExportPobTableMap::translateFieldName('AmManagerTown', TableMap::TYPE_PHPNAME, $indexType)];
            $this->am_manager_town = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : ExportPobTableMap::translateFieldName('ZmPositionCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->zm_position_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : ExportPobTableMap::translateFieldName('RmPositionCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->rm_position_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : ExportPobTableMap::translateFieldName('AmPositionCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->am_position_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : ExportPobTableMap::translateFieldName('EmpPositionCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->emp_position_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : ExportPobTableMap::translateFieldName('EmpPositionName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->emp_position_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : ExportPobTableMap::translateFieldName('EmpLevel', TableMap::TYPE_PHPNAME, $indexType)];
            $this->emp_level = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : ExportPobTableMap::translateFieldName('EmployeeCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->employee_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : ExportPobTableMap::translateFieldName('Employee', TableMap::TYPE_PHPNAME, $indexType)];
            $this->employee = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : ExportPobTableMap::translateFieldName('Designation', TableMap::TYPE_PHPNAME, $indexType)];
            $this->designation = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : ExportPobTableMap::translateFieldName('FromOutletType', TableMap::TYPE_PHPNAME, $indexType)];
            $this->from_outlet_type = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : ExportPobTableMap::translateFieldName('FromOutletCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->from_outlet_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 18 + $startcol : ExportPobTableMap::translateFieldName('FromOutletName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->from_outlet_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 19 + $startcol : ExportPobTableMap::translateFieldName('FromOutletClassification', TableMap::TYPE_PHPNAME, $indexType)];
            $this->from_outlet_classification = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 20 + $startcol : ExportPobTableMap::translateFieldName('ToOutletType', TableMap::TYPE_PHPNAME, $indexType)];
            $this->to_outlet_type = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 21 + $startcol : ExportPobTableMap::translateFieldName('ToOutletCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->to_outlet_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 22 + $startcol : ExportPobTableMap::translateFieldName('ToOutletName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->to_outlet_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 23 + $startcol : ExportPobTableMap::translateFieldName('ToOutletClassification', TableMap::TYPE_PHPNAME, $indexType)];
            $this->to_outlet_classification = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 24 + $startcol : ExportPobTableMap::translateFieldName('ProductName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->product_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 25 + $startcol : ExportPobTableMap::translateFieldName('ProductSku', TableMap::TYPE_PHPNAME, $indexType)];
            $this->product_sku = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 26 + $startcol : ExportPobTableMap::translateFieldName('Rate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->rate = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 27 + $startcol : ExportPobTableMap::translateFieldName('Qty', TableMap::TYPE_PHPNAME, $indexType)];
            $this->qty = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 28 + $startcol : ExportPobTableMap::translateFieldName('TotalAmt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->total_amt = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 29 + $startcol : ExportPobTableMap::translateFieldName('OrderDate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->order_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 30 + $startcol : ExportPobTableMap::translateFieldName('EmpTerritory', TableMap::TYPE_PHPNAME, $indexType)];
            $this->emp_territory = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 31 + $startcol : ExportPobTableMap::translateFieldName('EmpBranch', TableMap::TYPE_PHPNAME, $indexType)];
            $this->emp_branch = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 32 + $startcol : ExportPobTableMap::translateFieldName('EmpTown', TableMap::TYPE_PHPNAME, $indexType)];
            $this->emp_town = (null !== $col) ? (string) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 33; // 33 = ExportPobTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\entities\\ExportPob'), 0, $e);
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
        $pos = ExportPobTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getBuName();

            case 1:
                return $this->getZmManagerBranch();

            case 2:
                return $this->getZmManagerTown();

            case 3:
                return $this->getRmManagerBranch();

            case 4:
                return $this->getRmManagerTown();

            case 5:
                return $this->getAmManagerBranch();

            case 6:
                return $this->getAmManagerTown();

            case 7:
                return $this->getZmPositionCode();

            case 8:
                return $this->getRmPositionCode();

            case 9:
                return $this->getAmPositionCode();

            case 10:
                return $this->getEmpPositionCode();

            case 11:
                return $this->getEmpPositionName();

            case 12:
                return $this->getEmpLevel();

            case 13:
                return $this->getEmployeeCode();

            case 14:
                return $this->getEmployee();

            case 15:
                return $this->getDesignation();

            case 16:
                return $this->getFromOutletType();

            case 17:
                return $this->getFromOutletCode();

            case 18:
                return $this->getFromOutletName();

            case 19:
                return $this->getFromOutletClassification();

            case 20:
                return $this->getToOutletType();

            case 21:
                return $this->getToOutletCode();

            case 22:
                return $this->getToOutletName();

            case 23:
                return $this->getToOutletClassification();

            case 24:
                return $this->getProductName();

            case 25:
                return $this->getProductSku();

            case 26:
                return $this->getRate();

            case 27:
                return $this->getQty();

            case 28:
                return $this->getTotalAmt();

            case 29:
                return $this->getOrderDate();

            case 30:
                return $this->getEmpTerritory();

            case 31:
                return $this->getEmpBranch();

            case 32:
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
        if (isset($alreadyDumpedObjects['ExportPob'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['ExportPob'][$this->hashCode()] = true;
        $keys = ExportPobTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getBuName(),
            $keys[1] => $this->getZmManagerBranch(),
            $keys[2] => $this->getZmManagerTown(),
            $keys[3] => $this->getRmManagerBranch(),
            $keys[4] => $this->getRmManagerTown(),
            $keys[5] => $this->getAmManagerBranch(),
            $keys[6] => $this->getAmManagerTown(),
            $keys[7] => $this->getZmPositionCode(),
            $keys[8] => $this->getRmPositionCode(),
            $keys[9] => $this->getAmPositionCode(),
            $keys[10] => $this->getEmpPositionCode(),
            $keys[11] => $this->getEmpPositionName(),
            $keys[12] => $this->getEmpLevel(),
            $keys[13] => $this->getEmployeeCode(),
            $keys[14] => $this->getEmployee(),
            $keys[15] => $this->getDesignation(),
            $keys[16] => $this->getFromOutletType(),
            $keys[17] => $this->getFromOutletCode(),
            $keys[18] => $this->getFromOutletName(),
            $keys[19] => $this->getFromOutletClassification(),
            $keys[20] => $this->getToOutletType(),
            $keys[21] => $this->getToOutletCode(),
            $keys[22] => $this->getToOutletName(),
            $keys[23] => $this->getToOutletClassification(),
            $keys[24] => $this->getProductName(),
            $keys[25] => $this->getProductSku(),
            $keys[26] => $this->getRate(),
            $keys[27] => $this->getQty(),
            $keys[28] => $this->getTotalAmt(),
            $keys[29] => $this->getOrderDate(),
            $keys[30] => $this->getEmpTerritory(),
            $keys[31] => $this->getEmpBranch(),
            $keys[32] => $this->getEmpTown(),
        ];
        if ($result[$keys[29]] instanceof \DateTimeInterface) {
            $result[$keys[29]] = $result[$keys[29]]->format('Y-m-d');
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
        $criteria = new Criteria(ExportPobTableMap::DATABASE_NAME);

        if ($this->isColumnModified(ExportPobTableMap::COL_BU_NAME)) {
            $criteria->add(ExportPobTableMap::COL_BU_NAME, $this->bu_name);
        }
        if ($this->isColumnModified(ExportPobTableMap::COL_ZM_MANAGER_BRANCH)) {
            $criteria->add(ExportPobTableMap::COL_ZM_MANAGER_BRANCH, $this->zm_manager_branch);
        }
        if ($this->isColumnModified(ExportPobTableMap::COL_ZM_MANAGER_TOWN)) {
            $criteria->add(ExportPobTableMap::COL_ZM_MANAGER_TOWN, $this->zm_manager_town);
        }
        if ($this->isColumnModified(ExportPobTableMap::COL_RM_MANAGER_BRANCH)) {
            $criteria->add(ExportPobTableMap::COL_RM_MANAGER_BRANCH, $this->rm_manager_branch);
        }
        if ($this->isColumnModified(ExportPobTableMap::COL_RM_MANAGER_TOWN)) {
            $criteria->add(ExportPobTableMap::COL_RM_MANAGER_TOWN, $this->rm_manager_town);
        }
        if ($this->isColumnModified(ExportPobTableMap::COL_AM_MANAGER_BRANCH)) {
            $criteria->add(ExportPobTableMap::COL_AM_MANAGER_BRANCH, $this->am_manager_branch);
        }
        if ($this->isColumnModified(ExportPobTableMap::COL_AM_MANAGER_TOWN)) {
            $criteria->add(ExportPobTableMap::COL_AM_MANAGER_TOWN, $this->am_manager_town);
        }
        if ($this->isColumnModified(ExportPobTableMap::COL_ZM_POSITION_CODE)) {
            $criteria->add(ExportPobTableMap::COL_ZM_POSITION_CODE, $this->zm_position_code);
        }
        if ($this->isColumnModified(ExportPobTableMap::COL_RM_POSITION_CODE)) {
            $criteria->add(ExportPobTableMap::COL_RM_POSITION_CODE, $this->rm_position_code);
        }
        if ($this->isColumnModified(ExportPobTableMap::COL_AM_POSITION_CODE)) {
            $criteria->add(ExportPobTableMap::COL_AM_POSITION_CODE, $this->am_position_code);
        }
        if ($this->isColumnModified(ExportPobTableMap::COL_EMP_POSITION_CODE)) {
            $criteria->add(ExportPobTableMap::COL_EMP_POSITION_CODE, $this->emp_position_code);
        }
        if ($this->isColumnModified(ExportPobTableMap::COL_EMP_POSITION_NAME)) {
            $criteria->add(ExportPobTableMap::COL_EMP_POSITION_NAME, $this->emp_position_name);
        }
        if ($this->isColumnModified(ExportPobTableMap::COL_EMP_LEVEL)) {
            $criteria->add(ExportPobTableMap::COL_EMP_LEVEL, $this->emp_level);
        }
        if ($this->isColumnModified(ExportPobTableMap::COL_EMPLOYEE_CODE)) {
            $criteria->add(ExportPobTableMap::COL_EMPLOYEE_CODE, $this->employee_code);
        }
        if ($this->isColumnModified(ExportPobTableMap::COL_EMPLOYEE)) {
            $criteria->add(ExportPobTableMap::COL_EMPLOYEE, $this->employee);
        }
        if ($this->isColumnModified(ExportPobTableMap::COL_DESIGNATION)) {
            $criteria->add(ExportPobTableMap::COL_DESIGNATION, $this->designation);
        }
        if ($this->isColumnModified(ExportPobTableMap::COL_FROM_OUTLET_TYPE)) {
            $criteria->add(ExportPobTableMap::COL_FROM_OUTLET_TYPE, $this->from_outlet_type);
        }
        if ($this->isColumnModified(ExportPobTableMap::COL_FROM_OUTLET_CODE)) {
            $criteria->add(ExportPobTableMap::COL_FROM_OUTLET_CODE, $this->from_outlet_code);
        }
        if ($this->isColumnModified(ExportPobTableMap::COL_FROM_OUTLET_NAME)) {
            $criteria->add(ExportPobTableMap::COL_FROM_OUTLET_NAME, $this->from_outlet_name);
        }
        if ($this->isColumnModified(ExportPobTableMap::COL_FROM_OUTLET_CLASSIFICATION)) {
            $criteria->add(ExportPobTableMap::COL_FROM_OUTLET_CLASSIFICATION, $this->from_outlet_classification);
        }
        if ($this->isColumnModified(ExportPobTableMap::COL_TO_OUTLET_TYPE)) {
            $criteria->add(ExportPobTableMap::COL_TO_OUTLET_TYPE, $this->to_outlet_type);
        }
        if ($this->isColumnModified(ExportPobTableMap::COL_TO_OUTLET_CODE)) {
            $criteria->add(ExportPobTableMap::COL_TO_OUTLET_CODE, $this->to_outlet_code);
        }
        if ($this->isColumnModified(ExportPobTableMap::COL_TO_OUTLET_NAME)) {
            $criteria->add(ExportPobTableMap::COL_TO_OUTLET_NAME, $this->to_outlet_name);
        }
        if ($this->isColumnModified(ExportPobTableMap::COL_TO_OUTLET_CLASSIFICATION)) {
            $criteria->add(ExportPobTableMap::COL_TO_OUTLET_CLASSIFICATION, $this->to_outlet_classification);
        }
        if ($this->isColumnModified(ExportPobTableMap::COL_PRODUCT_NAME)) {
            $criteria->add(ExportPobTableMap::COL_PRODUCT_NAME, $this->product_name);
        }
        if ($this->isColumnModified(ExportPobTableMap::COL_PRODUCT_SKU)) {
            $criteria->add(ExportPobTableMap::COL_PRODUCT_SKU, $this->product_sku);
        }
        if ($this->isColumnModified(ExportPobTableMap::COL_RATE)) {
            $criteria->add(ExportPobTableMap::COL_RATE, $this->rate);
        }
        if ($this->isColumnModified(ExportPobTableMap::COL_QTY)) {
            $criteria->add(ExportPobTableMap::COL_QTY, $this->qty);
        }
        if ($this->isColumnModified(ExportPobTableMap::COL_TOTAL_AMT)) {
            $criteria->add(ExportPobTableMap::COL_TOTAL_AMT, $this->total_amt);
        }
        if ($this->isColumnModified(ExportPobTableMap::COL_ORDER_DATE)) {
            $criteria->add(ExportPobTableMap::COL_ORDER_DATE, $this->order_date);
        }
        if ($this->isColumnModified(ExportPobTableMap::COL_EMP_TERRITORY)) {
            $criteria->add(ExportPobTableMap::COL_EMP_TERRITORY, $this->emp_territory);
        }
        if ($this->isColumnModified(ExportPobTableMap::COL_EMP_BRANCH)) {
            $criteria->add(ExportPobTableMap::COL_EMP_BRANCH, $this->emp_branch);
        }
        if ($this->isColumnModified(ExportPobTableMap::COL_EMP_TOWN)) {
            $criteria->add(ExportPobTableMap::COL_EMP_TOWN, $this->emp_town);
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
        throw new LogicException('The ExportPob object has no primary key');

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
     * @param object $copyObj An object of \entities\ExportPob (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setBuName($this->getBuName());
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
        $copyObj->setEmployee($this->getEmployee());
        $copyObj->setDesignation($this->getDesignation());
        $copyObj->setFromOutletType($this->getFromOutletType());
        $copyObj->setFromOutletCode($this->getFromOutletCode());
        $copyObj->setFromOutletName($this->getFromOutletName());
        $copyObj->setFromOutletClassification($this->getFromOutletClassification());
        $copyObj->setToOutletType($this->getToOutletType());
        $copyObj->setToOutletCode($this->getToOutletCode());
        $copyObj->setToOutletName($this->getToOutletName());
        $copyObj->setToOutletClassification($this->getToOutletClassification());
        $copyObj->setProductName($this->getProductName());
        $copyObj->setProductSku($this->getProductSku());
        $copyObj->setRate($this->getRate());
        $copyObj->setQty($this->getQty());
        $copyObj->setTotalAmt($this->getTotalAmt());
        $copyObj->setOrderDate($this->getOrderDate());
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
     * @return \entities\ExportPob Clone of current object.
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
        $this->bu_name = null;
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
        $this->employee = null;
        $this->designation = null;
        $this->from_outlet_type = null;
        $this->from_outlet_code = null;
        $this->from_outlet_name = null;
        $this->from_outlet_classification = null;
        $this->to_outlet_type = null;
        $this->to_outlet_code = null;
        $this->to_outlet_name = null;
        $this->to_outlet_classification = null;
        $this->product_name = null;
        $this->product_sku = null;
        $this->rate = null;
        $this->qty = null;
        $this->total_amt = null;
        $this->order_date = null;
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
        return (string) $this->exportTo(ExportPobTableMap::DEFAULT_STRING_FORMAT);
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
