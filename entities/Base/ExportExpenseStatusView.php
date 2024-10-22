<?php

namespace entities\Base;

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
use entities\ExportExpenseStatusViewQuery as ChildExportExpenseStatusViewQuery;
use entities\Map\ExportExpenseStatusViewTableMap;

/**
 * Base class that represents a row from the 'export_expense_status_view' table.
 *
 *
 *
 * @package    propel.generator.entities.Base
 */
abstract class ExportExpenseStatusView implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\entities\\Map\\ExportExpenseStatusViewTableMap';


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
     * @var        int
     */
    protected $uniqueid;

    /**
     * The value for the employee_id field.
     *
     * @var        int|null
     */
    protected $employee_id;

    /**
     * The value for the position_id field.
     *
     * @var        int|null
     */
    protected $position_id;

    /**
     * The value for the orgunitid field.
     *
     * @var        int|null
     */
    protected $orgunitid;

    /**
     * The value for the bu_name field.
     *
     * @var        string|null
     */
    protected $bu_name;

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
     * The value for the employee_name field.
     *
     * @var        string|null
     */
    protected $employee_name;

    /**
     * The value for the reporting_to_employee_name field.
     *
     * @var        string|null
     */
    protected $reporting_to_employee_name;

    /**
     * The value for the reporting_to_employee_code field.
     *
     * @var        string|null
     */
    protected $reporting_to_employee_code;

    /**
     * The value for the emp_town field.
     *
     * @var        string|null
     */
    protected $emp_town;

    /**
     * The value for the emp_branch field.
     *
     * @var        string|null
     */
    protected $emp_branch;

    /**
     * The value for the designation field.
     *
     * @var        string|null
     */
    protected $designation;

    /**
     * The value for the grade field.
     *
     * @var        string|null
     */
    protected $grade;

    /**
     * The value for the status field.
     *
     * @var        string|null
     */
    protected $status;

    /**
     * The value for the month field.
     *
     * @var        string|null
     */
    protected $month;

    /**
     * The value for the requested_amount field.
     *
     * @var        string|null
     */
    protected $requested_amount;

    /**
     * The value for the approved_amount field.
     *
     * @var        string|null
     */
    protected $approved_amount;

    /**
     * The value for the final_amount field.
     *
     * @var        string|null
     */
    protected $final_amount;

    /**
     * The value for the expense_status field.
     *
     * @var        string|null
     */
    protected $expense_status;

    /**
     * The value for the total_expenses field.
     *
     * @var        int|null
     */
    protected $total_expenses;

    /**
     * The value for the expense_dates field.
     *
     * @var        string|null
     */
    protected $expense_dates;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * Initializes internal state of entities\Base\ExportExpenseStatusView object.
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
     * Compares this with another <code>ExportExpenseStatusView</code> instance.  If
     * <code>obj</code> is an instance of <code>ExportExpenseStatusView</code>, delegates to
     * <code>equals(ExportExpenseStatusView)</code>.  Otherwise, returns <code>false</code>.
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
     * @return int
     */
    public function getUniqueid()
    {
        return $this->uniqueid;
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
     * Get the [position_id] column value.
     *
     * @return int|null
     */
    public function getPositionId()
    {
        return $this->position_id;
    }

    /**
     * Get the [orgunitid] column value.
     *
     * @return int|null
     */
    public function getOrgunitid()
    {
        return $this->orgunitid;
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
     * Get the [employee_name] column value.
     *
     * @return string|null
     */
    public function getEmployeeName()
    {
        return $this->employee_name;
    }

    /**
     * Get the [reporting_to_employee_name] column value.
     *
     * @return string|null
     */
    public function getReportingToEmployeeName()
    {
        return $this->reporting_to_employee_name;
    }

    /**
     * Get the [reporting_to_employee_code] column value.
     *
     * @return string|null
     */
    public function getReportingToEmployeeCode()
    {
        return $this->reporting_to_employee_code;
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
     * Get the [emp_branch] column value.
     *
     * @return string|null
     */
    public function getEmpBranch()
    {
        return $this->emp_branch;
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
     * Get the [grade] column value.
     *
     * @return string|null
     */
    public function getGrade()
    {
        return $this->grade;
    }

    /**
     * Get the [status] column value.
     *
     * @return string|null
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Get the [month] column value.
     *
     * @return string|null
     */
    public function getMonth()
    {
        return $this->month;
    }

    /**
     * Get the [requested_amount] column value.
     *
     * @return string|null
     */
    public function getRequestedAmount()
    {
        return $this->requested_amount;
    }

    /**
     * Get the [approved_amount] column value.
     *
     * @return string|null
     */
    public function getApprovedAmount()
    {
        return $this->approved_amount;
    }

    /**
     * Get the [final_amount] column value.
     *
     * @return string|null
     */
    public function getFinalAmount()
    {
        return $this->final_amount;
    }

    /**
     * Get the [expense_status] column value.
     *
     * @return string|null
     */
    public function getExpenseStatus()
    {
        return $this->expense_status;
    }

    /**
     * Get the [total_expenses] column value.
     *
     * @return int|null
     */
    public function getTotalExpenses()
    {
        return $this->total_expenses;
    }

    /**
     * Get the [expense_dates] column value.
     *
     * @return string|null
     */
    public function getExpenseDates()
    {
        return $this->expense_dates;
    }

    /**
     * Set the value of [uniqueid] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setUniqueid($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->uniqueid !== $v) {
            $this->uniqueid = $v;
            $this->modifiedColumns[ExportExpenseStatusViewTableMap::COL_UNIQUEID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [employee_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setEmployeeId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->employee_id !== $v) {
            $this->employee_id = $v;
            $this->modifiedColumns[ExportExpenseStatusViewTableMap::COL_EMPLOYEE_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [position_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setPositionId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->position_id !== $v) {
            $this->position_id = $v;
            $this->modifiedColumns[ExportExpenseStatusViewTableMap::COL_POSITION_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [orgunitid] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOrgunitid($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->orgunitid !== $v) {
            $this->orgunitid = $v;
            $this->modifiedColumns[ExportExpenseStatusViewTableMap::COL_ORGUNITID] = true;
        }

        return $this;
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
            $this->modifiedColumns[ExportExpenseStatusViewTableMap::COL_BU_NAME] = true;
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
            $this->modifiedColumns[ExportExpenseStatusViewTableMap::COL_EMP_POSITION_CODE] = true;
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
            $this->modifiedColumns[ExportExpenseStatusViewTableMap::COL_EMP_POSITION_NAME] = true;
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
            $this->modifiedColumns[ExportExpenseStatusViewTableMap::COL_EMP_LEVEL] = true;
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
            $this->modifiedColumns[ExportExpenseStatusViewTableMap::COL_EMPLOYEE_CODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [employee_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setEmployeeName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->employee_name !== $v) {
            $this->employee_name = $v;
            $this->modifiedColumns[ExportExpenseStatusViewTableMap::COL_EMPLOYEE_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [reporting_to_employee_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setReportingToEmployeeName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->reporting_to_employee_name !== $v) {
            $this->reporting_to_employee_name = $v;
            $this->modifiedColumns[ExportExpenseStatusViewTableMap::COL_REPORTING_TO_EMPLOYEE_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [reporting_to_employee_code] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setReportingToEmployeeCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->reporting_to_employee_code !== $v) {
            $this->reporting_to_employee_code = $v;
            $this->modifiedColumns[ExportExpenseStatusViewTableMap::COL_REPORTING_TO_EMPLOYEE_CODE] = true;
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
            $this->modifiedColumns[ExportExpenseStatusViewTableMap::COL_EMP_TOWN] = true;
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
            $this->modifiedColumns[ExportExpenseStatusViewTableMap::COL_EMP_BRANCH] = true;
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
            $this->modifiedColumns[ExportExpenseStatusViewTableMap::COL_DESIGNATION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [grade] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setGrade($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->grade !== $v) {
            $this->grade = $v;
            $this->modifiedColumns[ExportExpenseStatusViewTableMap::COL_GRADE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [status] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setStatus($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->status !== $v) {
            $this->status = $v;
            $this->modifiedColumns[ExportExpenseStatusViewTableMap::COL_STATUS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [month] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setMonth($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->month !== $v) {
            $this->month = $v;
            $this->modifiedColumns[ExportExpenseStatusViewTableMap::COL_MONTH] = true;
        }

        return $this;
    }

    /**
     * Set the value of [requested_amount] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setRequestedAmount($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->requested_amount !== $v) {
            $this->requested_amount = $v;
            $this->modifiedColumns[ExportExpenseStatusViewTableMap::COL_REQUESTED_AMOUNT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [approved_amount] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setApprovedAmount($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->approved_amount !== $v) {
            $this->approved_amount = $v;
            $this->modifiedColumns[ExportExpenseStatusViewTableMap::COL_APPROVED_AMOUNT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [final_amount] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setFinalAmount($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->final_amount !== $v) {
            $this->final_amount = $v;
            $this->modifiedColumns[ExportExpenseStatusViewTableMap::COL_FINAL_AMOUNT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [expense_status] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setExpenseStatus($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->expense_status !== $v) {
            $this->expense_status = $v;
            $this->modifiedColumns[ExportExpenseStatusViewTableMap::COL_EXPENSE_STATUS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [total_expenses] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setTotalExpenses($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->total_expenses !== $v) {
            $this->total_expenses = $v;
            $this->modifiedColumns[ExportExpenseStatusViewTableMap::COL_TOTAL_EXPENSES] = true;
        }

        return $this;
    }

    /**
     * Set the value of [expense_dates] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setExpenseDates($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->expense_dates !== $v) {
            $this->expense_dates = $v;
            $this->modifiedColumns[ExportExpenseStatusViewTableMap::COL_EXPENSE_DATES] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : ExportExpenseStatusViewTableMap::translateFieldName('Uniqueid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->uniqueid = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : ExportExpenseStatusViewTableMap::translateFieldName('EmployeeId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->employee_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : ExportExpenseStatusViewTableMap::translateFieldName('PositionId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->position_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : ExportExpenseStatusViewTableMap::translateFieldName('Orgunitid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->orgunitid = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : ExportExpenseStatusViewTableMap::translateFieldName('BuName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->bu_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : ExportExpenseStatusViewTableMap::translateFieldName('EmpPositionCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->emp_position_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : ExportExpenseStatusViewTableMap::translateFieldName('EmpPositionName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->emp_position_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : ExportExpenseStatusViewTableMap::translateFieldName('EmpLevel', TableMap::TYPE_PHPNAME, $indexType)];
            $this->emp_level = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : ExportExpenseStatusViewTableMap::translateFieldName('EmployeeCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->employee_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : ExportExpenseStatusViewTableMap::translateFieldName('EmployeeName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->employee_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : ExportExpenseStatusViewTableMap::translateFieldName('ReportingToEmployeeName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->reporting_to_employee_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : ExportExpenseStatusViewTableMap::translateFieldName('ReportingToEmployeeCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->reporting_to_employee_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : ExportExpenseStatusViewTableMap::translateFieldName('EmpTown', TableMap::TYPE_PHPNAME, $indexType)];
            $this->emp_town = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : ExportExpenseStatusViewTableMap::translateFieldName('EmpBranch', TableMap::TYPE_PHPNAME, $indexType)];
            $this->emp_branch = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : ExportExpenseStatusViewTableMap::translateFieldName('Designation', TableMap::TYPE_PHPNAME, $indexType)];
            $this->designation = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : ExportExpenseStatusViewTableMap::translateFieldName('Grade', TableMap::TYPE_PHPNAME, $indexType)];
            $this->grade = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : ExportExpenseStatusViewTableMap::translateFieldName('Status', TableMap::TYPE_PHPNAME, $indexType)];
            $this->status = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : ExportExpenseStatusViewTableMap::translateFieldName('Month', TableMap::TYPE_PHPNAME, $indexType)];
            $this->month = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 18 + $startcol : ExportExpenseStatusViewTableMap::translateFieldName('RequestedAmount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->requested_amount = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 19 + $startcol : ExportExpenseStatusViewTableMap::translateFieldName('ApprovedAmount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->approved_amount = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 20 + $startcol : ExportExpenseStatusViewTableMap::translateFieldName('FinalAmount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->final_amount = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 21 + $startcol : ExportExpenseStatusViewTableMap::translateFieldName('ExpenseStatus', TableMap::TYPE_PHPNAME, $indexType)];
            $this->expense_status = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 22 + $startcol : ExportExpenseStatusViewTableMap::translateFieldName('TotalExpenses', TableMap::TYPE_PHPNAME, $indexType)];
            $this->total_expenses = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 23 + $startcol : ExportExpenseStatusViewTableMap::translateFieldName('ExpenseDates', TableMap::TYPE_PHPNAME, $indexType)];
            $this->expense_dates = (null !== $col) ? (string) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 24; // 24 = ExportExpenseStatusViewTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\entities\\ExportExpenseStatusView'), 0, $e);
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
        $pos = ExportExpenseStatusViewTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getEmployeeId();

            case 2:
                return $this->getPositionId();

            case 3:
                return $this->getOrgunitid();

            case 4:
                return $this->getBuName();

            case 5:
                return $this->getEmpPositionCode();

            case 6:
                return $this->getEmpPositionName();

            case 7:
                return $this->getEmpLevel();

            case 8:
                return $this->getEmployeeCode();

            case 9:
                return $this->getEmployeeName();

            case 10:
                return $this->getReportingToEmployeeName();

            case 11:
                return $this->getReportingToEmployeeCode();

            case 12:
                return $this->getEmpTown();

            case 13:
                return $this->getEmpBranch();

            case 14:
                return $this->getDesignation();

            case 15:
                return $this->getGrade();

            case 16:
                return $this->getStatus();

            case 17:
                return $this->getMonth();

            case 18:
                return $this->getRequestedAmount();

            case 19:
                return $this->getApprovedAmount();

            case 20:
                return $this->getFinalAmount();

            case 21:
                return $this->getExpenseStatus();

            case 22:
                return $this->getTotalExpenses();

            case 23:
                return $this->getExpenseDates();

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
        if (isset($alreadyDumpedObjects['ExportExpenseStatusView'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['ExportExpenseStatusView'][$this->hashCode()] = true;
        $keys = ExportExpenseStatusViewTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getUniqueid(),
            $keys[1] => $this->getEmployeeId(),
            $keys[2] => $this->getPositionId(),
            $keys[3] => $this->getOrgunitid(),
            $keys[4] => $this->getBuName(),
            $keys[5] => $this->getEmpPositionCode(),
            $keys[6] => $this->getEmpPositionName(),
            $keys[7] => $this->getEmpLevel(),
            $keys[8] => $this->getEmployeeCode(),
            $keys[9] => $this->getEmployeeName(),
            $keys[10] => $this->getReportingToEmployeeName(),
            $keys[11] => $this->getReportingToEmployeeCode(),
            $keys[12] => $this->getEmpTown(),
            $keys[13] => $this->getEmpBranch(),
            $keys[14] => $this->getDesignation(),
            $keys[15] => $this->getGrade(),
            $keys[16] => $this->getStatus(),
            $keys[17] => $this->getMonth(),
            $keys[18] => $this->getRequestedAmount(),
            $keys[19] => $this->getApprovedAmount(),
            $keys[20] => $this->getFinalAmount(),
            $keys[21] => $this->getExpenseStatus(),
            $keys[22] => $this->getTotalExpenses(),
            $keys[23] => $this->getExpenseDates(),
        ];
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
        $criteria = new Criteria(ExportExpenseStatusViewTableMap::DATABASE_NAME);

        if ($this->isColumnModified(ExportExpenseStatusViewTableMap::COL_UNIQUEID)) {
            $criteria->add(ExportExpenseStatusViewTableMap::COL_UNIQUEID, $this->uniqueid);
        }
        if ($this->isColumnModified(ExportExpenseStatusViewTableMap::COL_EMPLOYEE_ID)) {
            $criteria->add(ExportExpenseStatusViewTableMap::COL_EMPLOYEE_ID, $this->employee_id);
        }
        if ($this->isColumnModified(ExportExpenseStatusViewTableMap::COL_POSITION_ID)) {
            $criteria->add(ExportExpenseStatusViewTableMap::COL_POSITION_ID, $this->position_id);
        }
        if ($this->isColumnModified(ExportExpenseStatusViewTableMap::COL_ORGUNITID)) {
            $criteria->add(ExportExpenseStatusViewTableMap::COL_ORGUNITID, $this->orgunitid);
        }
        if ($this->isColumnModified(ExportExpenseStatusViewTableMap::COL_BU_NAME)) {
            $criteria->add(ExportExpenseStatusViewTableMap::COL_BU_NAME, $this->bu_name);
        }
        if ($this->isColumnModified(ExportExpenseStatusViewTableMap::COL_EMP_POSITION_CODE)) {
            $criteria->add(ExportExpenseStatusViewTableMap::COL_EMP_POSITION_CODE, $this->emp_position_code);
        }
        if ($this->isColumnModified(ExportExpenseStatusViewTableMap::COL_EMP_POSITION_NAME)) {
            $criteria->add(ExportExpenseStatusViewTableMap::COL_EMP_POSITION_NAME, $this->emp_position_name);
        }
        if ($this->isColumnModified(ExportExpenseStatusViewTableMap::COL_EMP_LEVEL)) {
            $criteria->add(ExportExpenseStatusViewTableMap::COL_EMP_LEVEL, $this->emp_level);
        }
        if ($this->isColumnModified(ExportExpenseStatusViewTableMap::COL_EMPLOYEE_CODE)) {
            $criteria->add(ExportExpenseStatusViewTableMap::COL_EMPLOYEE_CODE, $this->employee_code);
        }
        if ($this->isColumnModified(ExportExpenseStatusViewTableMap::COL_EMPLOYEE_NAME)) {
            $criteria->add(ExportExpenseStatusViewTableMap::COL_EMPLOYEE_NAME, $this->employee_name);
        }
        if ($this->isColumnModified(ExportExpenseStatusViewTableMap::COL_REPORTING_TO_EMPLOYEE_NAME)) {
            $criteria->add(ExportExpenseStatusViewTableMap::COL_REPORTING_TO_EMPLOYEE_NAME, $this->reporting_to_employee_name);
        }
        if ($this->isColumnModified(ExportExpenseStatusViewTableMap::COL_REPORTING_TO_EMPLOYEE_CODE)) {
            $criteria->add(ExportExpenseStatusViewTableMap::COL_REPORTING_TO_EMPLOYEE_CODE, $this->reporting_to_employee_code);
        }
        if ($this->isColumnModified(ExportExpenseStatusViewTableMap::COL_EMP_TOWN)) {
            $criteria->add(ExportExpenseStatusViewTableMap::COL_EMP_TOWN, $this->emp_town);
        }
        if ($this->isColumnModified(ExportExpenseStatusViewTableMap::COL_EMP_BRANCH)) {
            $criteria->add(ExportExpenseStatusViewTableMap::COL_EMP_BRANCH, $this->emp_branch);
        }
        if ($this->isColumnModified(ExportExpenseStatusViewTableMap::COL_DESIGNATION)) {
            $criteria->add(ExportExpenseStatusViewTableMap::COL_DESIGNATION, $this->designation);
        }
        if ($this->isColumnModified(ExportExpenseStatusViewTableMap::COL_GRADE)) {
            $criteria->add(ExportExpenseStatusViewTableMap::COL_GRADE, $this->grade);
        }
        if ($this->isColumnModified(ExportExpenseStatusViewTableMap::COL_STATUS)) {
            $criteria->add(ExportExpenseStatusViewTableMap::COL_STATUS, $this->status);
        }
        if ($this->isColumnModified(ExportExpenseStatusViewTableMap::COL_MONTH)) {
            $criteria->add(ExportExpenseStatusViewTableMap::COL_MONTH, $this->month);
        }
        if ($this->isColumnModified(ExportExpenseStatusViewTableMap::COL_REQUESTED_AMOUNT)) {
            $criteria->add(ExportExpenseStatusViewTableMap::COL_REQUESTED_AMOUNT, $this->requested_amount);
        }
        if ($this->isColumnModified(ExportExpenseStatusViewTableMap::COL_APPROVED_AMOUNT)) {
            $criteria->add(ExportExpenseStatusViewTableMap::COL_APPROVED_AMOUNT, $this->approved_amount);
        }
        if ($this->isColumnModified(ExportExpenseStatusViewTableMap::COL_FINAL_AMOUNT)) {
            $criteria->add(ExportExpenseStatusViewTableMap::COL_FINAL_AMOUNT, $this->final_amount);
        }
        if ($this->isColumnModified(ExportExpenseStatusViewTableMap::COL_EXPENSE_STATUS)) {
            $criteria->add(ExportExpenseStatusViewTableMap::COL_EXPENSE_STATUS, $this->expense_status);
        }
        if ($this->isColumnModified(ExportExpenseStatusViewTableMap::COL_TOTAL_EXPENSES)) {
            $criteria->add(ExportExpenseStatusViewTableMap::COL_TOTAL_EXPENSES, $this->total_expenses);
        }
        if ($this->isColumnModified(ExportExpenseStatusViewTableMap::COL_EXPENSE_DATES)) {
            $criteria->add(ExportExpenseStatusViewTableMap::COL_EXPENSE_DATES, $this->expense_dates);
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
        $criteria = ChildExportExpenseStatusViewQuery::create();
        $criteria->add(ExportExpenseStatusViewTableMap::COL_UNIQUEID, $this->uniqueid);

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
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getUniqueid();
    }

    /**
     * Generic method to set the primary key (uniqueid column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
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
     * @param object $copyObj An object of \entities\ExportExpenseStatusView (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setUniqueid($this->getUniqueid());
        $copyObj->setEmployeeId($this->getEmployeeId());
        $copyObj->setPositionId($this->getPositionId());
        $copyObj->setOrgunitid($this->getOrgunitid());
        $copyObj->setBuName($this->getBuName());
        $copyObj->setEmpPositionCode($this->getEmpPositionCode());
        $copyObj->setEmpPositionName($this->getEmpPositionName());
        $copyObj->setEmpLevel($this->getEmpLevel());
        $copyObj->setEmployeeCode($this->getEmployeeCode());
        $copyObj->setEmployeeName($this->getEmployeeName());
        $copyObj->setReportingToEmployeeName($this->getReportingToEmployeeName());
        $copyObj->setReportingToEmployeeCode($this->getReportingToEmployeeCode());
        $copyObj->setEmpTown($this->getEmpTown());
        $copyObj->setEmpBranch($this->getEmpBranch());
        $copyObj->setDesignation($this->getDesignation());
        $copyObj->setGrade($this->getGrade());
        $copyObj->setStatus($this->getStatus());
        $copyObj->setMonth($this->getMonth());
        $copyObj->setRequestedAmount($this->getRequestedAmount());
        $copyObj->setApprovedAmount($this->getApprovedAmount());
        $copyObj->setFinalAmount($this->getFinalAmount());
        $copyObj->setExpenseStatus($this->getExpenseStatus());
        $copyObj->setTotalExpenses($this->getTotalExpenses());
        $copyObj->setExpenseDates($this->getExpenseDates());
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
     * @return \entities\ExportExpenseStatusView Clone of current object.
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
        $this->employee_id = null;
        $this->position_id = null;
        $this->orgunitid = null;
        $this->bu_name = null;
        $this->emp_position_code = null;
        $this->emp_position_name = null;
        $this->emp_level = null;
        $this->employee_code = null;
        $this->employee_name = null;
        $this->reporting_to_employee_name = null;
        $this->reporting_to_employee_code = null;
        $this->emp_town = null;
        $this->emp_branch = null;
        $this->designation = null;
        $this->grade = null;
        $this->status = null;
        $this->month = null;
        $this->requested_amount = null;
        $this->approved_amount = null;
        $this->final_amount = null;
        $this->expense_status = null;
        $this->total_expenses = null;
        $this->expense_dates = null;
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
        return (string) $this->exportTo(ExportExpenseStatusViewTableMap::DEFAULT_STRING_FORMAT);
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
