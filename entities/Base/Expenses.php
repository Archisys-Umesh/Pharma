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
use entities\Attendance as ChildAttendance;
use entities\AttendanceQuery as ChildAttendanceQuery;
use entities\BudgetGroup as ChildBudgetGroup;
use entities\BudgetGroupQuery as ChildBudgetGroupQuery;
use entities\Company as ChildCompany;
use entities\CompanyQuery as ChildCompanyQuery;
use entities\Currencies as ChildCurrencies;
use entities\CurrenciesQuery as ChildCurrenciesQuery;
use entities\Employee as ChildEmployee;
use entities\EmployeeQuery as ChildEmployeeQuery;
use entities\EmployeeWorkLog as ChildEmployeeWorkLog;
use entities\EmployeeWorkLogQuery as ChildEmployeeWorkLogQuery;
use entities\ExpenseFiles as ChildExpenseFiles;
use entities\ExpenseFilesQuery as ChildExpenseFilesQuery;
use entities\ExpenseList as ChildExpenseList;
use entities\ExpenseListQuery as ChildExpenseListQuery;
use entities\Expenses as ChildExpenses;
use entities\ExpensesQuery as ChildExpensesQuery;
use entities\OrgUnit as ChildOrgUnit;
use entities\OrgUnitQuery as ChildOrgUnitQuery;
use entities\Map\AttendanceTableMap;
use entities\Map\EmployeeWorkLogTableMap;
use entities\Map\ExpenseFilesTableMap;
use entities\Map\ExpenseListTableMap;
use entities\Map\ExpensesTableMap;

/**
 * Base class that represents a row from the 'expenses' table.
 *
 *
 *
 * @package    propel.generator.entities.Base
 */
abstract class Expenses implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\entities\\Map\\ExpensesTableMap';


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
     * The value for the exp_id field.
     *
     * @var        int
     */
    protected $exp_id;

    /**
     * The value for the company_id field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $company_id;

    /**
     * The value for the expense_date field.
     *
     * @var        DateTime
     */
    protected $expense_date;

    /**
     * The value for the budget_id field.
     *
     * @var        int
     */
    protected $budget_id;

    /**
     * The value for the expense_trip field.
     *
     * @var        int
     */
    protected $expense_trip;

    /**
     * The value for the expense_placewrk field.
     *
     * @var        string
     */
    protected $expense_placewrk;

    /**
     * The value for the expense_req_amt field.
     *
     * @var        string
     */
    protected $expense_req_amt;

    /**
     * The value for the expense_approved_amt field.
     *
     * @var        string|null
     */
    protected $expense_approved_amt;

    /**
     * The value for the expense_additional_amt field.
     *
     * @var        string|null
     */
    protected $expense_additional_amt;

    /**
     * The value for the expense_tax_amt field.
     *
     * @var        string|null
     */
    protected $expense_tax_amt;

    /**
     * The value for the expense_final_amt field.
     *
     * @var        string|null
     */
    protected $expense_final_amt;

    /**
     * The value for the expense_status field.
     *
     * @var        int
     */
    protected $expense_status;

    /**
     * The value for the employee_id field.
     *
     * @var        int
     */
    protected $employee_id;

    /**
     * The value for the expense_mode field.
     *
     * @var        int|null
     */
    protected $expense_mode;

    /**
     * The value for the expense_note field.
     *
     * @var        string|null
     */
    protected $expense_note;

    /**
     * The value for the orgunit_id field.
     *
     * Note: this column has a database default value of: 1
     * @var        int
     */
    protected $orgunit_id;

    /**
     * The value for the trip_currency field.
     *
     * Note: this column has a database default value of: 1
     * @var        int
     */
    protected $trip_currency;

    /**
     * The value for the readflag field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $readflag;

    /**
     * The value for the created_at field.
     *
     * Note: this column has a database default value of: (expression) CURRENT_TIMESTAMP
     * @var        DateTime
     */
    protected $created_at;

    /**
     * The value for the updated_at field.
     *
     * Note: this column has a database default value of: (expression) CURRENT_TIMESTAMP
     * @var        DateTime|null
     */
    protected $updated_at;

    /**
     * The value for the pin field.
     *
     * @var        string|null
     */
    protected $pin;

    /**
     * The value for the device_name field.
     *
     * @var        string|null
     */
    protected $device_name;

    /**
     * The value for the device_battery field.
     *
     * @var        string|null
     */
    protected $device_battery;

    /**
     * The value for the device_time field.
     *
     * @var        string|null
     */
    protected $device_time;

    /**
     * The value for the settled_amount field.
     *
     * @var        string|null
     */
    protected $settled_amount;

    /**
     * The value for the settled_date field.
     *
     * @var        DateTime|null
     */
    protected $settled_date;

    /**
     * The value for the settled_desc field.
     *
     * @var        string|null
     */
    protected $settled_desc;

    /**
     * The value for the trip_type field.
     *
     * @var        string|null
     */
    protected $trip_type;

    /**
     * The value for the do_verify field.
     *
     * Note: this column has a database default value of: false
     * @var        boolean|null
     */
    protected $do_verify;

    /**
     * @var        ChildBudgetGroup
     */
    protected $aBudgetGroup;

    /**
     * @var        ChildCompany
     */
    protected $aCompany;

    /**
     * @var        ChildCurrencies
     */
    protected $aCurrencies;

    /**
     * @var        ChildEmployee
     */
    protected $aEmployee;

    /**
     * @var        ChildOrgUnit
     */
    protected $aOrgUnit;

    /**
     * @var        ObjectCollection|ChildAttendance[] Collection to store aggregation of ChildAttendance objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildAttendance> Collection to store aggregation of ChildAttendance objects.
     */
    protected $collAttendances;
    protected $collAttendancesPartial;

    /**
     * @var        ObjectCollection|ChildEmployeeWorkLog[] Collection to store aggregation of ChildEmployeeWorkLog objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildEmployeeWorkLog> Collection to store aggregation of ChildEmployeeWorkLog objects.
     */
    protected $collEmployeeWorkLogs;
    protected $collEmployeeWorkLogsPartial;

    /**
     * @var        ObjectCollection|ChildExpenseFiles[] Collection to store aggregation of ChildExpenseFiles objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildExpenseFiles> Collection to store aggregation of ChildExpenseFiles objects.
     */
    protected $collExpenseFiless;
    protected $collExpenseFilessPartial;

    /**
     * @var        ObjectCollection|ChildExpenseList[] Collection to store aggregation of ChildExpenseList objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildExpenseList> Collection to store aggregation of ChildExpenseList objects.
     */
    protected $collExpenseLists;
    protected $collExpenseListsPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildAttendance[]
     * @phpstan-var ObjectCollection&\Traversable<ChildAttendance>
     */
    protected $attendancesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildEmployeeWorkLog[]
     * @phpstan-var ObjectCollection&\Traversable<ChildEmployeeWorkLog>
     */
    protected $employeeWorkLogsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildExpenseFiles[]
     * @phpstan-var ObjectCollection&\Traversable<ChildExpenseFiles>
     */
    protected $expenseFilessScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildExpenseList[]
     * @phpstan-var ObjectCollection&\Traversable<ChildExpenseList>
     */
    protected $expenseListsScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues(): void
    {
        $this->company_id = 0;
        $this->orgunit_id = 1;
        $this->trip_currency = 1;
        $this->readflag = 0;
        $this->do_verify = false;
    }

    /**
     * Initializes internal state of entities\Base\Expenses object.
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
     * Compares this with another <code>Expenses</code> instance.  If
     * <code>obj</code> is an instance of <code>Expenses</code>, delegates to
     * <code>equals(Expenses)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [exp_id] column value.
     *
     * @return int
     */
    public function getExpId()
    {
        return $this->exp_id;
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
     * Get the [optionally formatted] temporal [expense_date] column value.
     *
     *
     * @param string|null $format The date/time format string (either date()-style or strftime()-style).
     *   If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL).
     *
     * @throws \Propel\Runtime\Exception\PropelException - if unable to parse/validate the date/time value.
     *
     * @psalm-return ($format is null ? DateTime : string)
     */
    public function getExpenseDate($format = null)
    {
        if ($format === null) {
            return $this->expense_date;
        } else {
            return $this->expense_date instanceof \DateTimeInterface ? $this->expense_date->format($format) : null;
        }
    }

    /**
     * Get the [budget_id] column value.
     *
     * @return int
     */
    public function getBudgetId()
    {
        return $this->budget_id;
    }

    /**
     * Get the [expense_trip] column value.
     *
     * @return int
     */
    public function getExpenseTrip()
    {
        return $this->expense_trip;
    }

    /**
     * Get the [expense_placewrk] column value.
     *
     * @return string
     */
    public function getExpensePlacewrk()
    {
        return $this->expense_placewrk;
    }

    /**
     * Get the [expense_req_amt] column value.
     *
     * @return string
     */
    public function getExpenseReqAmt()
    {
        return $this->expense_req_amt;
    }

    /**
     * Get the [expense_approved_amt] column value.
     *
     * @return string|null
     */
    public function getExpenseApprovedAmt()
    {
        return $this->expense_approved_amt;
    }

    /**
     * Get the [expense_additional_amt] column value.
     *
     * @return string|null
     */
    public function getExpenseAdditionalAmt()
    {
        return $this->expense_additional_amt;
    }

    /**
     * Get the [expense_tax_amt] column value.
     *
     * @return string|null
     */
    public function getExpenseTaxAmt()
    {
        return $this->expense_tax_amt;
    }

    /**
     * Get the [expense_final_amt] column value.
     *
     * @return string|null
     */
    public function getExpenseFinalAmt()
    {
        return $this->expense_final_amt;
    }

    /**
     * Get the [expense_status] column value.
     *
     * @return int
     */
    public function getExpenseStatus()
    {
        return $this->expense_status;
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
     * Get the [expense_mode] column value.
     *
     * @return int|null
     */
    public function getExpenseMode()
    {
        return $this->expense_mode;
    }

    /**
     * Get the [expense_note] column value.
     *
     * @return string|null
     */
    public function getExpenseNote()
    {
        return $this->expense_note;
    }

    /**
     * Get the [orgunit_id] column value.
     *
     * @return int
     */
    public function getOrgunitId()
    {
        return $this->orgunit_id;
    }

    /**
     * Get the [trip_currency] column value.
     *
     * @return int
     */
    public function getTripCurrency()
    {
        return $this->trip_currency;
    }

    /**
     * Get the [readflag] column value.
     *
     * @return int
     */
    public function getReadflag()
    {
        return $this->readflag;
    }

    /**
     * Get the [optionally formatted] temporal [created_at] column value.
     *
     *
     * @param string|null $format The date/time format string (either date()-style or strftime()-style).
     *   If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL).
     *
     * @throws \Propel\Runtime\Exception\PropelException - if unable to parse/validate the date/time value.
     *
     * @psalm-return ($format is null ? DateTime : string)
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
     * Get the [pin] column value.
     *
     * @return string|null
     */
    public function getPin()
    {
        return $this->pin;
    }

    /**
     * Get the [device_name] column value.
     *
     * @return string|null
     */
    public function getDeviceName()
    {
        return $this->device_name;
    }

    /**
     * Get the [device_battery] column value.
     *
     * @return string|null
     */
    public function getDeviceBattery()
    {
        return $this->device_battery;
    }

    /**
     * Get the [device_time] column value.
     *
     * @return string|null
     */
    public function getDeviceTime()
    {
        return $this->device_time;
    }

    /**
     * Get the [settled_amount] column value.
     *
     * @return string|null
     */
    public function getSettledAmount()
    {
        return $this->settled_amount;
    }

    /**
     * Get the [optionally formatted] temporal [settled_date] column value.
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
    public function getSettledDate($format = null)
    {
        if ($format === null) {
            return $this->settled_date;
        } else {
            return $this->settled_date instanceof \DateTimeInterface ? $this->settled_date->format($format) : null;
        }
    }

    /**
     * Get the [settled_desc] column value.
     *
     * @return string|null
     */
    public function getSettledDesc()
    {
        return $this->settled_desc;
    }

    /**
     * Get the [trip_type] column value.
     *
     * @return string|null
     */
    public function getTripType()
    {
        return $this->trip_type;
    }

    /**
     * Get the [do_verify] column value.
     *
     * @return boolean|null
     */
    public function getDoVerify()
    {
        return $this->do_verify;
    }

    /**
     * Get the [do_verify] column value.
     *
     * @return boolean|null
     */
    public function isDoVerify()
    {
        return $this->getDoVerify();
    }

    /**
     * Set the value of [exp_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setExpId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->exp_id !== $v) {
            $this->exp_id = $v;
            $this->modifiedColumns[ExpensesTableMap::COL_EXP_ID] = true;
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
            $this->modifiedColumns[ExpensesTableMap::COL_COMPANY_ID] = true;
        }

        if ($this->aCompany !== null && $this->aCompany->getCompanyId() !== $v) {
            $this->aCompany = null;
        }

        return $this;
    }

    /**
     * Sets the value of [expense_date] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setExpenseDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->expense_date !== null || $dt !== null) {
            if ($this->expense_date === null || $dt === null || $dt->format("Y-m-d") !== $this->expense_date->format("Y-m-d")) {
                $this->expense_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[ExpensesTableMap::COL_EXPENSE_DATE] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [budget_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setBudgetId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->budget_id !== $v) {
            $this->budget_id = $v;
            $this->modifiedColumns[ExpensesTableMap::COL_BUDGET_ID] = true;
        }

        if ($this->aBudgetGroup !== null && $this->aBudgetGroup->getBgid() !== $v) {
            $this->aBudgetGroup = null;
        }

        return $this;
    }

    /**
     * Set the value of [expense_trip] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setExpenseTrip($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->expense_trip !== $v) {
            $this->expense_trip = $v;
            $this->modifiedColumns[ExpensesTableMap::COL_EXPENSE_TRIP] = true;
        }

        return $this;
    }

    /**
     * Set the value of [expense_placewrk] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setExpensePlacewrk($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->expense_placewrk !== $v) {
            $this->expense_placewrk = $v;
            $this->modifiedColumns[ExpensesTableMap::COL_EXPENSE_PLACEWRK] = true;
        }

        return $this;
    }

    /**
     * Set the value of [expense_req_amt] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setExpenseReqAmt($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->expense_req_amt !== $v) {
            $this->expense_req_amt = $v;
            $this->modifiedColumns[ExpensesTableMap::COL_EXPENSE_REQ_AMT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [expense_approved_amt] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setExpenseApprovedAmt($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->expense_approved_amt !== $v) {
            $this->expense_approved_amt = $v;
            $this->modifiedColumns[ExpensesTableMap::COL_EXPENSE_APPROVED_AMT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [expense_additional_amt] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setExpenseAdditionalAmt($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->expense_additional_amt !== $v) {
            $this->expense_additional_amt = $v;
            $this->modifiedColumns[ExpensesTableMap::COL_EXPENSE_ADDITIONAL_AMT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [expense_tax_amt] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setExpenseTaxAmt($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->expense_tax_amt !== $v) {
            $this->expense_tax_amt = $v;
            $this->modifiedColumns[ExpensesTableMap::COL_EXPENSE_TAX_AMT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [expense_final_amt] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setExpenseFinalAmt($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->expense_final_amt !== $v) {
            $this->expense_final_amt = $v;
            $this->modifiedColumns[ExpensesTableMap::COL_EXPENSE_FINAL_AMT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [expense_status] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setExpenseStatus($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->expense_status !== $v) {
            $this->expense_status = $v;
            $this->modifiedColumns[ExpensesTableMap::COL_EXPENSE_STATUS] = true;
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
            $this->modifiedColumns[ExpensesTableMap::COL_EMPLOYEE_ID] = true;
        }

        if ($this->aEmployee !== null && $this->aEmployee->getEmployeeId() !== $v) {
            $this->aEmployee = null;
        }

        return $this;
    }

    /**
     * Set the value of [expense_mode] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setExpenseMode($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->expense_mode !== $v) {
            $this->expense_mode = $v;
            $this->modifiedColumns[ExpensesTableMap::COL_EXPENSE_MODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [expense_note] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setExpenseNote($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->expense_note !== $v) {
            $this->expense_note = $v;
            $this->modifiedColumns[ExpensesTableMap::COL_EXPENSE_NOTE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [orgunit_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOrgunitId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->orgunit_id !== $v) {
            $this->orgunit_id = $v;
            $this->modifiedColumns[ExpensesTableMap::COL_ORGUNIT_ID] = true;
        }

        if ($this->aOrgUnit !== null && $this->aOrgUnit->getOrgunitid() !== $v) {
            $this->aOrgUnit = null;
        }

        return $this;
    }

    /**
     * Set the value of [trip_currency] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setTripCurrency($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->trip_currency !== $v) {
            $this->trip_currency = $v;
            $this->modifiedColumns[ExpensesTableMap::COL_TRIP_CURRENCY] = true;
        }

        if ($this->aCurrencies !== null && $this->aCurrencies->getCurrencyId() !== $v) {
            $this->aCurrencies = null;
        }

        return $this;
    }

    /**
     * Set the value of [readflag] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setReadflag($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->readflag !== $v) {
            $this->readflag = $v;
            $this->modifiedColumns[ExpensesTableMap::COL_READFLAG] = true;
        }

        return $this;
    }

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            if ($this->created_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->created_at->format("Y-m-d H:i:s.u")) {
                $this->created_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[ExpensesTableMap::COL_CREATED_AT] = true;
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
                $this->modifiedColumns[ExpensesTableMap::COL_UPDATED_AT] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [pin] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPin($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->pin !== $v) {
            $this->pin = $v;
            $this->modifiedColumns[ExpensesTableMap::COL_PIN] = true;
        }

        return $this;
    }

    /**
     * Set the value of [device_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setDeviceName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->device_name !== $v) {
            $this->device_name = $v;
            $this->modifiedColumns[ExpensesTableMap::COL_DEVICE_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [device_battery] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setDeviceBattery($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->device_battery !== $v) {
            $this->device_battery = $v;
            $this->modifiedColumns[ExpensesTableMap::COL_DEVICE_BATTERY] = true;
        }

        return $this;
    }

    /**
     * Set the value of [device_time] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setDeviceTime($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->device_time !== $v) {
            $this->device_time = $v;
            $this->modifiedColumns[ExpensesTableMap::COL_DEVICE_TIME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [settled_amount] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setSettledAmount($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->settled_amount !== $v) {
            $this->settled_amount = $v;
            $this->modifiedColumns[ExpensesTableMap::COL_SETTLED_AMOUNT] = true;
        }

        return $this;
    }

    /**
     * Sets the value of [settled_date] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setSettledDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->settled_date !== null || $dt !== null) {
            if ($this->settled_date === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->settled_date->format("Y-m-d H:i:s.u")) {
                $this->settled_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[ExpensesTableMap::COL_SETTLED_DATE] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [settled_desc] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setSettledDesc($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->settled_desc !== $v) {
            $this->settled_desc = $v;
            $this->modifiedColumns[ExpensesTableMap::COL_SETTLED_DESC] = true;
        }

        return $this;
    }

    /**
     * Set the value of [trip_type] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setTripType($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->trip_type !== $v) {
            $this->trip_type = $v;
            $this->modifiedColumns[ExpensesTableMap::COL_TRIP_TYPE] = true;
        }

        return $this;
    }

    /**
     * Sets the value of the [do_verify] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param bool|integer|string|null $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setDoVerify($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->do_verify !== $v) {
            $this->do_verify = $v;
            $this->modifiedColumns[ExpensesTableMap::COL_DO_VERIFY] = true;
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
            if ($this->company_id !== 0) {
                return false;
            }

            if ($this->orgunit_id !== 1) {
                return false;
            }

            if ($this->trip_currency !== 1) {
                return false;
            }

            if ($this->readflag !== 0) {
                return false;
            }

            if ($this->do_verify !== false) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : ExpensesTableMap::translateFieldName('ExpId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->exp_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : ExpensesTableMap::translateFieldName('CompanyId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->company_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : ExpensesTableMap::translateFieldName('ExpenseDate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->expense_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : ExpensesTableMap::translateFieldName('BudgetId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->budget_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : ExpensesTableMap::translateFieldName('ExpenseTrip', TableMap::TYPE_PHPNAME, $indexType)];
            $this->expense_trip = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : ExpensesTableMap::translateFieldName('ExpensePlacewrk', TableMap::TYPE_PHPNAME, $indexType)];
            $this->expense_placewrk = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : ExpensesTableMap::translateFieldName('ExpenseReqAmt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->expense_req_amt = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : ExpensesTableMap::translateFieldName('ExpenseApprovedAmt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->expense_approved_amt = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : ExpensesTableMap::translateFieldName('ExpenseAdditionalAmt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->expense_additional_amt = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : ExpensesTableMap::translateFieldName('ExpenseTaxAmt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->expense_tax_amt = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : ExpensesTableMap::translateFieldName('ExpenseFinalAmt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->expense_final_amt = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : ExpensesTableMap::translateFieldName('ExpenseStatus', TableMap::TYPE_PHPNAME, $indexType)];
            $this->expense_status = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : ExpensesTableMap::translateFieldName('EmployeeId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->employee_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : ExpensesTableMap::translateFieldName('ExpenseMode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->expense_mode = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : ExpensesTableMap::translateFieldName('ExpenseNote', TableMap::TYPE_PHPNAME, $indexType)];
            $this->expense_note = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : ExpensesTableMap::translateFieldName('OrgunitId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->orgunit_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : ExpensesTableMap::translateFieldName('TripCurrency', TableMap::TYPE_PHPNAME, $indexType)];
            $this->trip_currency = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : ExpensesTableMap::translateFieldName('Readflag', TableMap::TYPE_PHPNAME, $indexType)];
            $this->readflag = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 18 + $startcol : ExpensesTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 19 + $startcol : ExpensesTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 20 + $startcol : ExpensesTableMap::translateFieldName('Pin', TableMap::TYPE_PHPNAME, $indexType)];
            $this->pin = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 21 + $startcol : ExpensesTableMap::translateFieldName('DeviceName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->device_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 22 + $startcol : ExpensesTableMap::translateFieldName('DeviceBattery', TableMap::TYPE_PHPNAME, $indexType)];
            $this->device_battery = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 23 + $startcol : ExpensesTableMap::translateFieldName('DeviceTime', TableMap::TYPE_PHPNAME, $indexType)];
            $this->device_time = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 24 + $startcol : ExpensesTableMap::translateFieldName('SettledAmount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->settled_amount = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 25 + $startcol : ExpensesTableMap::translateFieldName('SettledDate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->settled_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 26 + $startcol : ExpensesTableMap::translateFieldName('SettledDesc', TableMap::TYPE_PHPNAME, $indexType)];
            $this->settled_desc = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 27 + $startcol : ExpensesTableMap::translateFieldName('TripType', TableMap::TYPE_PHPNAME, $indexType)];
            $this->trip_type = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 28 + $startcol : ExpensesTableMap::translateFieldName('DoVerify', TableMap::TYPE_PHPNAME, $indexType)];
            $this->do_verify = (null !== $col) ? (boolean) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 29; // 29 = ExpensesTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\entities\\Expenses'), 0, $e);
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
        if ($this->aBudgetGroup !== null && $this->budget_id !== $this->aBudgetGroup->getBgid()) {
            $this->aBudgetGroup = null;
        }
        if ($this->aEmployee !== null && $this->employee_id !== $this->aEmployee->getEmployeeId()) {
            $this->aEmployee = null;
        }
        if ($this->aOrgUnit !== null && $this->orgunit_id !== $this->aOrgUnit->getOrgunitid()) {
            $this->aOrgUnit = null;
        }
        if ($this->aCurrencies !== null && $this->trip_currency !== $this->aCurrencies->getCurrencyId()) {
            $this->aCurrencies = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(ExpensesTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildExpensesQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aBudgetGroup = null;
            $this->aCompany = null;
            $this->aCurrencies = null;
            $this->aEmployee = null;
            $this->aOrgUnit = null;
            $this->collAttendances = null;

            $this->collEmployeeWorkLogs = null;

            $this->collExpenseFiless = null;

            $this->collExpenseLists = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see Expenses::setDeleted()
     * @see Expenses::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(ExpensesTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildExpensesQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(ExpensesTableMap::DATABASE_NAME);
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
                ExpensesTableMap::addInstanceToPool($this);
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

            if ($this->aBudgetGroup !== null) {
                if ($this->aBudgetGroup->isModified() || $this->aBudgetGroup->isNew()) {
                    $affectedRows += $this->aBudgetGroup->save($con);
                }
                $this->setBudgetGroup($this->aBudgetGroup);
            }

            if ($this->aCompany !== null) {
                if ($this->aCompany->isModified() || $this->aCompany->isNew()) {
                    $affectedRows += $this->aCompany->save($con);
                }
                $this->setCompany($this->aCompany);
            }

            if ($this->aCurrencies !== null) {
                if ($this->aCurrencies->isModified() || $this->aCurrencies->isNew()) {
                    $affectedRows += $this->aCurrencies->save($con);
                }
                $this->setCurrencies($this->aCurrencies);
            }

            if ($this->aEmployee !== null) {
                if ($this->aEmployee->isModified() || $this->aEmployee->isNew()) {
                    $affectedRows += $this->aEmployee->save($con);
                }
                $this->setEmployee($this->aEmployee);
            }

            if ($this->aOrgUnit !== null) {
                if ($this->aOrgUnit->isModified() || $this->aOrgUnit->isNew()) {
                    $affectedRows += $this->aOrgUnit->save($con);
                }
                $this->setOrgUnit($this->aOrgUnit);
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

            if ($this->attendancesScheduledForDeletion !== null) {
                if (!$this->attendancesScheduledForDeletion->isEmpty()) {
                    foreach ($this->attendancesScheduledForDeletion as $attendance) {
                        // need to save related object because we set the relation to null
                        $attendance->save($con);
                    }
                    $this->attendancesScheduledForDeletion = null;
                }
            }

            if ($this->collAttendances !== null) {
                foreach ($this->collAttendances as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->employeeWorkLogsScheduledForDeletion !== null) {
                if (!$this->employeeWorkLogsScheduledForDeletion->isEmpty()) {
                    \entities\EmployeeWorkLogQuery::create()
                        ->filterByPrimaryKeys($this->employeeWorkLogsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->employeeWorkLogsScheduledForDeletion = null;
                }
            }

            if ($this->collEmployeeWorkLogs !== null) {
                foreach ($this->collEmployeeWorkLogs as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->expenseFilessScheduledForDeletion !== null) {
                if (!$this->expenseFilessScheduledForDeletion->isEmpty()) {
                    \entities\ExpenseFilesQuery::create()
                        ->filterByPrimaryKeys($this->expenseFilessScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->expenseFilessScheduledForDeletion = null;
                }
            }

            if ($this->collExpenseFiless !== null) {
                foreach ($this->collExpenseFiless as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->expenseListsScheduledForDeletion !== null) {
                if (!$this->expenseListsScheduledForDeletion->isEmpty()) {
                    \entities\ExpenseListQuery::create()
                        ->filterByPrimaryKeys($this->expenseListsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->expenseListsScheduledForDeletion = null;
                }
            }

            if ($this->collExpenseLists !== null) {
                foreach ($this->collExpenseLists as $referrerFK) {
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

        $this->modifiedColumns[ExpensesTableMap::COL_EXP_ID] = true;
        if (null !== $this->exp_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . ExpensesTableMap::COL_EXP_ID . ')');
        }
        if (null === $this->exp_id) {
            try {
                $dataFetcher = $con->query("SELECT nextval('expenses_exp_id_seq')");
                $this->exp_id = (int) $dataFetcher->fetchColumn();
            } catch (Exception $e) {
                throw new PropelException('Unable to get sequence id.', 0, $e);
            }
        }


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(ExpensesTableMap::COL_EXP_ID)) {
            $modifiedColumns[':p' . $index++]  = 'exp_id';
        }
        if ($this->isColumnModified(ExpensesTableMap::COL_COMPANY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'company_id';
        }
        if ($this->isColumnModified(ExpensesTableMap::COL_EXPENSE_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'expense_date';
        }
        if ($this->isColumnModified(ExpensesTableMap::COL_BUDGET_ID)) {
            $modifiedColumns[':p' . $index++]  = 'budget_id';
        }
        if ($this->isColumnModified(ExpensesTableMap::COL_EXPENSE_TRIP)) {
            $modifiedColumns[':p' . $index++]  = 'expense_trip';
        }
        if ($this->isColumnModified(ExpensesTableMap::COL_EXPENSE_PLACEWRK)) {
            $modifiedColumns[':p' . $index++]  = 'expense_placewrk';
        }
        if ($this->isColumnModified(ExpensesTableMap::COL_EXPENSE_REQ_AMT)) {
            $modifiedColumns[':p' . $index++]  = 'expense_req_amt';
        }
        if ($this->isColumnModified(ExpensesTableMap::COL_EXPENSE_APPROVED_AMT)) {
            $modifiedColumns[':p' . $index++]  = 'expense_approved_amt';
        }
        if ($this->isColumnModified(ExpensesTableMap::COL_EXPENSE_ADDITIONAL_AMT)) {
            $modifiedColumns[':p' . $index++]  = 'expense_additional_amt';
        }
        if ($this->isColumnModified(ExpensesTableMap::COL_EXPENSE_TAX_AMT)) {
            $modifiedColumns[':p' . $index++]  = 'expense_tax_amt';
        }
        if ($this->isColumnModified(ExpensesTableMap::COL_EXPENSE_FINAL_AMT)) {
            $modifiedColumns[':p' . $index++]  = 'expense_final_amt';
        }
        if ($this->isColumnModified(ExpensesTableMap::COL_EXPENSE_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'expense_status';
        }
        if ($this->isColumnModified(ExpensesTableMap::COL_EMPLOYEE_ID)) {
            $modifiedColumns[':p' . $index++]  = 'employee_id';
        }
        if ($this->isColumnModified(ExpensesTableMap::COL_EXPENSE_MODE)) {
            $modifiedColumns[':p' . $index++]  = 'expense_mode';
        }
        if ($this->isColumnModified(ExpensesTableMap::COL_EXPENSE_NOTE)) {
            $modifiedColumns[':p' . $index++]  = 'expense_note';
        }
        if ($this->isColumnModified(ExpensesTableMap::COL_ORGUNIT_ID)) {
            $modifiedColumns[':p' . $index++]  = 'orgunit_id';
        }
        if ($this->isColumnModified(ExpensesTableMap::COL_TRIP_CURRENCY)) {
            $modifiedColumns[':p' . $index++]  = 'trip_currency';
        }
        if ($this->isColumnModified(ExpensesTableMap::COL_READFLAG)) {
            $modifiedColumns[':p' . $index++]  = 'readflag';
        }
        if ($this->isColumnModified(ExpensesTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(ExpensesTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }
        if ($this->isColumnModified(ExpensesTableMap::COL_PIN)) {
            $modifiedColumns[':p' . $index++]  = 'pin';
        }
        if ($this->isColumnModified(ExpensesTableMap::COL_DEVICE_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'device_name';
        }
        if ($this->isColumnModified(ExpensesTableMap::COL_DEVICE_BATTERY)) {
            $modifiedColumns[':p' . $index++]  = 'device_battery';
        }
        if ($this->isColumnModified(ExpensesTableMap::COL_DEVICE_TIME)) {
            $modifiedColumns[':p' . $index++]  = 'device_time';
        }
        if ($this->isColumnModified(ExpensesTableMap::COL_SETTLED_AMOUNT)) {
            $modifiedColumns[':p' . $index++]  = 'settled_amount';
        }
        if ($this->isColumnModified(ExpensesTableMap::COL_SETTLED_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'settled_date';
        }
        if ($this->isColumnModified(ExpensesTableMap::COL_SETTLED_DESC)) {
            $modifiedColumns[':p' . $index++]  = 'settled_desc';
        }
        if ($this->isColumnModified(ExpensesTableMap::COL_TRIP_TYPE)) {
            $modifiedColumns[':p' . $index++]  = 'trip_type';
        }
        if ($this->isColumnModified(ExpensesTableMap::COL_DO_VERIFY)) {
            $modifiedColumns[':p' . $index++]  = 'do_verify';
        }

        $sql = sprintf(
            'INSERT INTO expenses (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'exp_id':
                        $stmt->bindValue($identifier, $this->exp_id, PDO::PARAM_INT);

                        break;
                    case 'company_id':
                        $stmt->bindValue($identifier, $this->company_id, PDO::PARAM_INT);

                        break;
                    case 'expense_date':
                        $stmt->bindValue($identifier, $this->expense_date ? $this->expense_date->format("Y-m-d") : null, PDO::PARAM_STR);

                        break;
                    case 'budget_id':
                        $stmt->bindValue($identifier, $this->budget_id, PDO::PARAM_INT);

                        break;
                    case 'expense_trip':
                        $stmt->bindValue($identifier, $this->expense_trip, PDO::PARAM_INT);

                        break;
                    case 'expense_placewrk':
                        $stmt->bindValue($identifier, $this->expense_placewrk, PDO::PARAM_STR);

                        break;
                    case 'expense_req_amt':
                        $stmt->bindValue($identifier, $this->expense_req_amt, PDO::PARAM_STR);

                        break;
                    case 'expense_approved_amt':
                        $stmt->bindValue($identifier, $this->expense_approved_amt, PDO::PARAM_STR);

                        break;
                    case 'expense_additional_amt':
                        $stmt->bindValue($identifier, $this->expense_additional_amt, PDO::PARAM_STR);

                        break;
                    case 'expense_tax_amt':
                        $stmt->bindValue($identifier, $this->expense_tax_amt, PDO::PARAM_STR);

                        break;
                    case 'expense_final_amt':
                        $stmt->bindValue($identifier, $this->expense_final_amt, PDO::PARAM_STR);

                        break;
                    case 'expense_status':
                        $stmt->bindValue($identifier, $this->expense_status, PDO::PARAM_INT);

                        break;
                    case 'employee_id':
                        $stmt->bindValue($identifier, $this->employee_id, PDO::PARAM_INT);

                        break;
                    case 'expense_mode':
                        $stmt->bindValue($identifier, $this->expense_mode, PDO::PARAM_INT);

                        break;
                    case 'expense_note':
                        $stmt->bindValue($identifier, $this->expense_note, PDO::PARAM_STR);

                        break;
                    case 'orgunit_id':
                        $stmt->bindValue($identifier, $this->orgunit_id, PDO::PARAM_INT);

                        break;
                    case 'trip_currency':
                        $stmt->bindValue($identifier, $this->trip_currency, PDO::PARAM_INT);

                        break;
                    case 'readflag':
                        $stmt->bindValue($identifier, $this->readflag, PDO::PARAM_INT);

                        break;
                    case 'created_at':
                        $stmt->bindValue($identifier, $this->created_at ? $this->created_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'updated_at':
                        $stmt->bindValue($identifier, $this->updated_at ? $this->updated_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'pin':
                        $stmt->bindValue($identifier, $this->pin, PDO::PARAM_STR);

                        break;
                    case 'device_name':
                        $stmt->bindValue($identifier, $this->device_name, PDO::PARAM_STR);

                        break;
                    case 'device_battery':
                        $stmt->bindValue($identifier, $this->device_battery, PDO::PARAM_STR);

                        break;
                    case 'device_time':
                        $stmt->bindValue($identifier, $this->device_time, PDO::PARAM_STR);

                        break;
                    case 'settled_amount':
                        $stmt->bindValue($identifier, $this->settled_amount, PDO::PARAM_STR);

                        break;
                    case 'settled_date':
                        $stmt->bindValue($identifier, $this->settled_date ? $this->settled_date->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'settled_desc':
                        $stmt->bindValue($identifier, $this->settled_desc, PDO::PARAM_STR);

                        break;
                    case 'trip_type':
                        $stmt->bindValue($identifier, $this->trip_type, PDO::PARAM_STR);

                        break;
                    case 'do_verify':
                        $stmt->bindValue($identifier, $this->do_verify, PDO::PARAM_BOOL);

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
        $pos = ExpensesTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getExpId();

            case 1:
                return $this->getCompanyId();

            case 2:
                return $this->getExpenseDate();

            case 3:
                return $this->getBudgetId();

            case 4:
                return $this->getExpenseTrip();

            case 5:
                return $this->getExpensePlacewrk();

            case 6:
                return $this->getExpenseReqAmt();

            case 7:
                return $this->getExpenseApprovedAmt();

            case 8:
                return $this->getExpenseAdditionalAmt();

            case 9:
                return $this->getExpenseTaxAmt();

            case 10:
                return $this->getExpenseFinalAmt();

            case 11:
                return $this->getExpenseStatus();

            case 12:
                return $this->getEmployeeId();

            case 13:
                return $this->getExpenseMode();

            case 14:
                return $this->getExpenseNote();

            case 15:
                return $this->getOrgunitId();

            case 16:
                return $this->getTripCurrency();

            case 17:
                return $this->getReadflag();

            case 18:
                return $this->getCreatedAt();

            case 19:
                return $this->getUpdatedAt();

            case 20:
                return $this->getPin();

            case 21:
                return $this->getDeviceName();

            case 22:
                return $this->getDeviceBattery();

            case 23:
                return $this->getDeviceTime();

            case 24:
                return $this->getSettledAmount();

            case 25:
                return $this->getSettledDate();

            case 26:
                return $this->getSettledDesc();

            case 27:
                return $this->getTripType();

            case 28:
                return $this->getDoVerify();

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
        if (isset($alreadyDumpedObjects['Expenses'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['Expenses'][$this->hashCode()] = true;
        $keys = ExpensesTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getExpId(),
            $keys[1] => $this->getCompanyId(),
            $keys[2] => $this->getExpenseDate(),
            $keys[3] => $this->getBudgetId(),
            $keys[4] => $this->getExpenseTrip(),
            $keys[5] => $this->getExpensePlacewrk(),
            $keys[6] => $this->getExpenseReqAmt(),
            $keys[7] => $this->getExpenseApprovedAmt(),
            $keys[8] => $this->getExpenseAdditionalAmt(),
            $keys[9] => $this->getExpenseTaxAmt(),
            $keys[10] => $this->getExpenseFinalAmt(),
            $keys[11] => $this->getExpenseStatus(),
            $keys[12] => $this->getEmployeeId(),
            $keys[13] => $this->getExpenseMode(),
            $keys[14] => $this->getExpenseNote(),
            $keys[15] => $this->getOrgunitId(),
            $keys[16] => $this->getTripCurrency(),
            $keys[17] => $this->getReadflag(),
            $keys[18] => $this->getCreatedAt(),
            $keys[19] => $this->getUpdatedAt(),
            $keys[20] => $this->getPin(),
            $keys[21] => $this->getDeviceName(),
            $keys[22] => $this->getDeviceBattery(),
            $keys[23] => $this->getDeviceTime(),
            $keys[24] => $this->getSettledAmount(),
            $keys[25] => $this->getSettledDate(),
            $keys[26] => $this->getSettledDesc(),
            $keys[27] => $this->getTripType(),
            $keys[28] => $this->getDoVerify(),
        ];
        if ($result[$keys[2]] instanceof \DateTimeInterface) {
            $result[$keys[2]] = $result[$keys[2]]->format('Y-m-d');
        }

        if ($result[$keys[18]] instanceof \DateTimeInterface) {
            $result[$keys[18]] = $result[$keys[18]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[19]] instanceof \DateTimeInterface) {
            $result[$keys[19]] = $result[$keys[19]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[25]] instanceof \DateTimeInterface) {
            $result[$keys[25]] = $result[$keys[25]]->format('Y-m-d H:i:s.u');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aBudgetGroup) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'budgetGroup';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'budget_group';
                        break;
                    default:
                        $key = 'BudgetGroup';
                }

                $result[$key] = $this->aBudgetGroup->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
            if (null !== $this->aCurrencies) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'currencies';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'currencies';
                        break;
                    default:
                        $key = 'Currencies';
                }

                $result[$key] = $this->aCurrencies->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
            if (null !== $this->collAttendances) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'attendances';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'attendances';
                        break;
                    default:
                        $key = 'Attendances';
                }

                $result[$key] = $this->collAttendances->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collEmployeeWorkLogs) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'employeeWorkLogs';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'employee_work_logs';
                        break;
                    default:
                        $key = 'EmployeeWorkLogs';
                }

                $result[$key] = $this->collEmployeeWorkLogs->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collExpenseFiless) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'expenseFiless';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'expense_filess';
                        break;
                    default:
                        $key = 'ExpenseFiless';
                }

                $result[$key] = $this->collExpenseFiless->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collExpenseLists) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'expenseLists';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'expense_lists';
                        break;
                    default:
                        $key = 'ExpenseLists';
                }

                $result[$key] = $this->collExpenseLists->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = ExpensesTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setExpId($value);
                break;
            case 1:
                $this->setCompanyId($value);
                break;
            case 2:
                $this->setExpenseDate($value);
                break;
            case 3:
                $this->setBudgetId($value);
                break;
            case 4:
                $this->setExpenseTrip($value);
                break;
            case 5:
                $this->setExpensePlacewrk($value);
                break;
            case 6:
                $this->setExpenseReqAmt($value);
                break;
            case 7:
                $this->setExpenseApprovedAmt($value);
                break;
            case 8:
                $this->setExpenseAdditionalAmt($value);
                break;
            case 9:
                $this->setExpenseTaxAmt($value);
                break;
            case 10:
                $this->setExpenseFinalAmt($value);
                break;
            case 11:
                $this->setExpenseStatus($value);
                break;
            case 12:
                $this->setEmployeeId($value);
                break;
            case 13:
                $this->setExpenseMode($value);
                break;
            case 14:
                $this->setExpenseNote($value);
                break;
            case 15:
                $this->setOrgunitId($value);
                break;
            case 16:
                $this->setTripCurrency($value);
                break;
            case 17:
                $this->setReadflag($value);
                break;
            case 18:
                $this->setCreatedAt($value);
                break;
            case 19:
                $this->setUpdatedAt($value);
                break;
            case 20:
                $this->setPin($value);
                break;
            case 21:
                $this->setDeviceName($value);
                break;
            case 22:
                $this->setDeviceBattery($value);
                break;
            case 23:
                $this->setDeviceTime($value);
                break;
            case 24:
                $this->setSettledAmount($value);
                break;
            case 25:
                $this->setSettledDate($value);
                break;
            case 26:
                $this->setSettledDesc($value);
                break;
            case 27:
                $this->setTripType($value);
                break;
            case 28:
                $this->setDoVerify($value);
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
        $keys = ExpensesTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setExpId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setCompanyId($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setExpenseDate($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setBudgetId($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setExpenseTrip($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setExpensePlacewrk($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setExpenseReqAmt($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setExpenseApprovedAmt($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setExpenseAdditionalAmt($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setExpenseTaxAmt($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setExpenseFinalAmt($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setExpenseStatus($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setEmployeeId($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setExpenseMode($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setExpenseNote($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setOrgunitId($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setTripCurrency($arr[$keys[16]]);
        }
        if (array_key_exists($keys[17], $arr)) {
            $this->setReadflag($arr[$keys[17]]);
        }
        if (array_key_exists($keys[18], $arr)) {
            $this->setCreatedAt($arr[$keys[18]]);
        }
        if (array_key_exists($keys[19], $arr)) {
            $this->setUpdatedAt($arr[$keys[19]]);
        }
        if (array_key_exists($keys[20], $arr)) {
            $this->setPin($arr[$keys[20]]);
        }
        if (array_key_exists($keys[21], $arr)) {
            $this->setDeviceName($arr[$keys[21]]);
        }
        if (array_key_exists($keys[22], $arr)) {
            $this->setDeviceBattery($arr[$keys[22]]);
        }
        if (array_key_exists($keys[23], $arr)) {
            $this->setDeviceTime($arr[$keys[23]]);
        }
        if (array_key_exists($keys[24], $arr)) {
            $this->setSettledAmount($arr[$keys[24]]);
        }
        if (array_key_exists($keys[25], $arr)) {
            $this->setSettledDate($arr[$keys[25]]);
        }
        if (array_key_exists($keys[26], $arr)) {
            $this->setSettledDesc($arr[$keys[26]]);
        }
        if (array_key_exists($keys[27], $arr)) {
            $this->setTripType($arr[$keys[27]]);
        }
        if (array_key_exists($keys[28], $arr)) {
            $this->setDoVerify($arr[$keys[28]]);
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
        $criteria = new Criteria(ExpensesTableMap::DATABASE_NAME);

        if ($this->isColumnModified(ExpensesTableMap::COL_EXP_ID)) {
            $criteria->add(ExpensesTableMap::COL_EXP_ID, $this->exp_id);
        }
        if ($this->isColumnModified(ExpensesTableMap::COL_COMPANY_ID)) {
            $criteria->add(ExpensesTableMap::COL_COMPANY_ID, $this->company_id);
        }
        if ($this->isColumnModified(ExpensesTableMap::COL_EXPENSE_DATE)) {
            $criteria->add(ExpensesTableMap::COL_EXPENSE_DATE, $this->expense_date);
        }
        if ($this->isColumnModified(ExpensesTableMap::COL_BUDGET_ID)) {
            $criteria->add(ExpensesTableMap::COL_BUDGET_ID, $this->budget_id);
        }
        if ($this->isColumnModified(ExpensesTableMap::COL_EXPENSE_TRIP)) {
            $criteria->add(ExpensesTableMap::COL_EXPENSE_TRIP, $this->expense_trip);
        }
        if ($this->isColumnModified(ExpensesTableMap::COL_EXPENSE_PLACEWRK)) {
            $criteria->add(ExpensesTableMap::COL_EXPENSE_PLACEWRK, $this->expense_placewrk);
        }
        if ($this->isColumnModified(ExpensesTableMap::COL_EXPENSE_REQ_AMT)) {
            $criteria->add(ExpensesTableMap::COL_EXPENSE_REQ_AMT, $this->expense_req_amt);
        }
        if ($this->isColumnModified(ExpensesTableMap::COL_EXPENSE_APPROVED_AMT)) {
            $criteria->add(ExpensesTableMap::COL_EXPENSE_APPROVED_AMT, $this->expense_approved_amt);
        }
        if ($this->isColumnModified(ExpensesTableMap::COL_EXPENSE_ADDITIONAL_AMT)) {
            $criteria->add(ExpensesTableMap::COL_EXPENSE_ADDITIONAL_AMT, $this->expense_additional_amt);
        }
        if ($this->isColumnModified(ExpensesTableMap::COL_EXPENSE_TAX_AMT)) {
            $criteria->add(ExpensesTableMap::COL_EXPENSE_TAX_AMT, $this->expense_tax_amt);
        }
        if ($this->isColumnModified(ExpensesTableMap::COL_EXPENSE_FINAL_AMT)) {
            $criteria->add(ExpensesTableMap::COL_EXPENSE_FINAL_AMT, $this->expense_final_amt);
        }
        if ($this->isColumnModified(ExpensesTableMap::COL_EXPENSE_STATUS)) {
            $criteria->add(ExpensesTableMap::COL_EXPENSE_STATUS, $this->expense_status);
        }
        if ($this->isColumnModified(ExpensesTableMap::COL_EMPLOYEE_ID)) {
            $criteria->add(ExpensesTableMap::COL_EMPLOYEE_ID, $this->employee_id);
        }
        if ($this->isColumnModified(ExpensesTableMap::COL_EXPENSE_MODE)) {
            $criteria->add(ExpensesTableMap::COL_EXPENSE_MODE, $this->expense_mode);
        }
        if ($this->isColumnModified(ExpensesTableMap::COL_EXPENSE_NOTE)) {
            $criteria->add(ExpensesTableMap::COL_EXPENSE_NOTE, $this->expense_note);
        }
        if ($this->isColumnModified(ExpensesTableMap::COL_ORGUNIT_ID)) {
            $criteria->add(ExpensesTableMap::COL_ORGUNIT_ID, $this->orgunit_id);
        }
        if ($this->isColumnModified(ExpensesTableMap::COL_TRIP_CURRENCY)) {
            $criteria->add(ExpensesTableMap::COL_TRIP_CURRENCY, $this->trip_currency);
        }
        if ($this->isColumnModified(ExpensesTableMap::COL_READFLAG)) {
            $criteria->add(ExpensesTableMap::COL_READFLAG, $this->readflag);
        }
        if ($this->isColumnModified(ExpensesTableMap::COL_CREATED_AT)) {
            $criteria->add(ExpensesTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(ExpensesTableMap::COL_UPDATED_AT)) {
            $criteria->add(ExpensesTableMap::COL_UPDATED_AT, $this->updated_at);
        }
        if ($this->isColumnModified(ExpensesTableMap::COL_PIN)) {
            $criteria->add(ExpensesTableMap::COL_PIN, $this->pin);
        }
        if ($this->isColumnModified(ExpensesTableMap::COL_DEVICE_NAME)) {
            $criteria->add(ExpensesTableMap::COL_DEVICE_NAME, $this->device_name);
        }
        if ($this->isColumnModified(ExpensesTableMap::COL_DEVICE_BATTERY)) {
            $criteria->add(ExpensesTableMap::COL_DEVICE_BATTERY, $this->device_battery);
        }
        if ($this->isColumnModified(ExpensesTableMap::COL_DEVICE_TIME)) {
            $criteria->add(ExpensesTableMap::COL_DEVICE_TIME, $this->device_time);
        }
        if ($this->isColumnModified(ExpensesTableMap::COL_SETTLED_AMOUNT)) {
            $criteria->add(ExpensesTableMap::COL_SETTLED_AMOUNT, $this->settled_amount);
        }
        if ($this->isColumnModified(ExpensesTableMap::COL_SETTLED_DATE)) {
            $criteria->add(ExpensesTableMap::COL_SETTLED_DATE, $this->settled_date);
        }
        if ($this->isColumnModified(ExpensesTableMap::COL_SETTLED_DESC)) {
            $criteria->add(ExpensesTableMap::COL_SETTLED_DESC, $this->settled_desc);
        }
        if ($this->isColumnModified(ExpensesTableMap::COL_TRIP_TYPE)) {
            $criteria->add(ExpensesTableMap::COL_TRIP_TYPE, $this->trip_type);
        }
        if ($this->isColumnModified(ExpensesTableMap::COL_DO_VERIFY)) {
            $criteria->add(ExpensesTableMap::COL_DO_VERIFY, $this->do_verify);
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
        $criteria = ChildExpensesQuery::create();
        $criteria->add(ExpensesTableMap::COL_EXP_ID, $this->exp_id);

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
        $validPk = null !== $this->getExpId();

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
        return $this->getExpId();
    }

    /**
     * Generic method to set the primary key (exp_id column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setExpId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getExpId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \entities\Expenses (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setCompanyId($this->getCompanyId());
        $copyObj->setExpenseDate($this->getExpenseDate());
        $copyObj->setBudgetId($this->getBudgetId());
        $copyObj->setExpenseTrip($this->getExpenseTrip());
        $copyObj->setExpensePlacewrk($this->getExpensePlacewrk());
        $copyObj->setExpenseReqAmt($this->getExpenseReqAmt());
        $copyObj->setExpenseApprovedAmt($this->getExpenseApprovedAmt());
        $copyObj->setExpenseAdditionalAmt($this->getExpenseAdditionalAmt());
        $copyObj->setExpenseTaxAmt($this->getExpenseTaxAmt());
        $copyObj->setExpenseFinalAmt($this->getExpenseFinalAmt());
        $copyObj->setExpenseStatus($this->getExpenseStatus());
        $copyObj->setEmployeeId($this->getEmployeeId());
        $copyObj->setExpenseMode($this->getExpenseMode());
        $copyObj->setExpenseNote($this->getExpenseNote());
        $copyObj->setOrgunitId($this->getOrgunitId());
        $copyObj->setTripCurrency($this->getTripCurrency());
        $copyObj->setReadflag($this->getReadflag());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        $copyObj->setPin($this->getPin());
        $copyObj->setDeviceName($this->getDeviceName());
        $copyObj->setDeviceBattery($this->getDeviceBattery());
        $copyObj->setDeviceTime($this->getDeviceTime());
        $copyObj->setSettledAmount($this->getSettledAmount());
        $copyObj->setSettledDate($this->getSettledDate());
        $copyObj->setSettledDesc($this->getSettledDesc());
        $copyObj->setTripType($this->getTripType());
        $copyObj->setDoVerify($this->getDoVerify());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getAttendances() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addAttendance($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getEmployeeWorkLogs() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addEmployeeWorkLog($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getExpenseFiless() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addExpenseFiles($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getExpenseLists() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addExpenseList($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setExpId(NULL); // this is a auto-increment column, so set to default value
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
     * @return \entities\Expenses Clone of current object.
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
     * Declares an association between this object and a ChildBudgetGroup object.
     *
     * @param ChildBudgetGroup $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setBudgetGroup(ChildBudgetGroup $v = null)
    {
        if ($v === null) {
            $this->setBudgetId(NULL);
        } else {
            $this->setBudgetId($v->getBgid());
        }

        $this->aBudgetGroup = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildBudgetGroup object, it will not be re-added.
        if ($v !== null) {
            $v->addExpenses($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildBudgetGroup object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildBudgetGroup The associated ChildBudgetGroup object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getBudgetGroup(?ConnectionInterface $con = null)
    {
        if ($this->aBudgetGroup === null && ($this->budget_id != 0)) {
            $this->aBudgetGroup = ChildBudgetGroupQuery::create()->findPk($this->budget_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aBudgetGroup->addExpensess($this);
             */
        }

        return $this->aBudgetGroup;
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
            $this->setCompanyId(0);
        } else {
            $this->setCompanyId($v->getCompanyId());
        }

        $this->aCompany = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildCompany object, it will not be re-added.
        if ($v !== null) {
            $v->addExpenses($this);
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
                $this->aCompany->addExpensess($this);
             */
        }

        return $this->aCompany;
    }

    /**
     * Declares an association between this object and a ChildCurrencies object.
     *
     * @param ChildCurrencies $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setCurrencies(ChildCurrencies $v = null)
    {
        if ($v === null) {
            $this->setTripCurrency(1);
        } else {
            $this->setTripCurrency($v->getCurrencyId());
        }

        $this->aCurrencies = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildCurrencies object, it will not be re-added.
        if ($v !== null) {
            $v->addExpenses($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildCurrencies object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildCurrencies The associated ChildCurrencies object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getCurrencies(?ConnectionInterface $con = null)
    {
        if ($this->aCurrencies === null && ($this->trip_currency != 0)) {
            $this->aCurrencies = ChildCurrenciesQuery::create()->findPk($this->trip_currency, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aCurrencies->addExpensess($this);
             */
        }

        return $this->aCurrencies;
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
            $v->addExpenses($this);
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
                $this->aEmployee->addExpensess($this);
             */
        }

        return $this->aEmployee;
    }

    /**
     * Declares an association between this object and a ChildOrgUnit object.
     *
     * @param ChildOrgUnit $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setOrgUnit(ChildOrgUnit $v = null)
    {
        if ($v === null) {
            $this->setOrgunitId(1);
        } else {
            $this->setOrgunitId($v->getOrgunitid());
        }

        $this->aOrgUnit = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildOrgUnit object, it will not be re-added.
        if ($v !== null) {
            $v->addExpenses($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildOrgUnit object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildOrgUnit The associated ChildOrgUnit object.
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
                $this->aOrgUnit->addExpensess($this);
             */
        }

        return $this->aOrgUnit;
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
        if ('Attendance' === $relationName) {
            $this->initAttendances();
            return;
        }
        if ('EmployeeWorkLog' === $relationName) {
            $this->initEmployeeWorkLogs();
            return;
        }
        if ('ExpenseFiles' === $relationName) {
            $this->initExpenseFiless();
            return;
        }
        if ('ExpenseList' === $relationName) {
            $this->initExpenseLists();
            return;
        }
    }

    /**
     * Clears out the collAttendances collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addAttendances()
     */
    public function clearAttendances()
    {
        $this->collAttendances = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collAttendances collection loaded partially.
     *
     * @return void
     */
    public function resetPartialAttendances($v = true): void
    {
        $this->collAttendancesPartial = $v;
    }

    /**
     * Initializes the collAttendances collection.
     *
     * By default this just sets the collAttendances collection to an empty array (like clearcollAttendances());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initAttendances(bool $overrideExisting = true): void
    {
        if (null !== $this->collAttendances && !$overrideExisting) {
            return;
        }

        $collectionClassName = AttendanceTableMap::getTableMap()->getCollectionClassName();

        $this->collAttendances = new $collectionClassName;
        $this->collAttendances->setModel('\entities\Attendance');
    }

    /**
     * Gets an array of ChildAttendance objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildExpenses is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildAttendance[] List of ChildAttendance objects
     * @phpstan-return ObjectCollection&\Traversable<ChildAttendance> List of ChildAttendance objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getAttendances(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collAttendancesPartial && !$this->isNew();
        if (null === $this->collAttendances || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collAttendances) {
                    $this->initAttendances();
                } else {
                    $collectionClassName = AttendanceTableMap::getTableMap()->getCollectionClassName();

                    $collAttendances = new $collectionClassName;
                    $collAttendances->setModel('\entities\Attendance');

                    return $collAttendances;
                }
            } else {
                $collAttendances = ChildAttendanceQuery::create(null, $criteria)
                    ->filterByExpenses($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collAttendancesPartial && count($collAttendances)) {
                        $this->initAttendances(false);

                        foreach ($collAttendances as $obj) {
                            if (false == $this->collAttendances->contains($obj)) {
                                $this->collAttendances->append($obj);
                            }
                        }

                        $this->collAttendancesPartial = true;
                    }

                    return $collAttendances;
                }

                if ($partial && $this->collAttendances) {
                    foreach ($this->collAttendances as $obj) {
                        if ($obj->isNew()) {
                            $collAttendances[] = $obj;
                        }
                    }
                }

                $this->collAttendances = $collAttendances;
                $this->collAttendancesPartial = false;
            }
        }

        return $this->collAttendances;
    }

    /**
     * Sets a collection of ChildAttendance objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $attendances A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setAttendances(Collection $attendances, ?ConnectionInterface $con = null)
    {
        /** @var ChildAttendance[] $attendancesToDelete */
        $attendancesToDelete = $this->getAttendances(new Criteria(), $con)->diff($attendances);


        $this->attendancesScheduledForDeletion = $attendancesToDelete;

        foreach ($attendancesToDelete as $attendanceRemoved) {
            $attendanceRemoved->setExpenses(null);
        }

        $this->collAttendances = null;
        foreach ($attendances as $attendance) {
            $this->addAttendance($attendance);
        }

        $this->collAttendances = $attendances;
        $this->collAttendancesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Attendance objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related Attendance objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countAttendances(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collAttendancesPartial && !$this->isNew();
        if (null === $this->collAttendances || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collAttendances) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getAttendances());
            }

            $query = ChildAttendanceQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByExpenses($this)
                ->count($con);
        }

        return count($this->collAttendances);
    }

    /**
     * Method called to associate a ChildAttendance object to this object
     * through the ChildAttendance foreign key attribute.
     *
     * @param ChildAttendance $l ChildAttendance
     * @return $this The current object (for fluent API support)
     */
    public function addAttendance(ChildAttendance $l)
    {
        if ($this->collAttendances === null) {
            $this->initAttendances();
            $this->collAttendancesPartial = true;
        }

        if (!$this->collAttendances->contains($l)) {
            $this->doAddAttendance($l);

            if ($this->attendancesScheduledForDeletion and $this->attendancesScheduledForDeletion->contains($l)) {
                $this->attendancesScheduledForDeletion->remove($this->attendancesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildAttendance $attendance The ChildAttendance object to add.
     */
    protected function doAddAttendance(ChildAttendance $attendance): void
    {
        $this->collAttendances[]= $attendance;
        $attendance->setExpenses($this);
    }

    /**
     * @param ChildAttendance $attendance The ChildAttendance object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeAttendance(ChildAttendance $attendance)
    {
        if ($this->getAttendances()->contains($attendance)) {
            $pos = $this->collAttendances->search($attendance);
            $this->collAttendances->remove($pos);
            if (null === $this->attendancesScheduledForDeletion) {
                $this->attendancesScheduledForDeletion = clone $this->collAttendances;
                $this->attendancesScheduledForDeletion->clear();
            }
            $this->attendancesScheduledForDeletion[]= $attendance;
            $attendance->setExpenses(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Expenses is new, it will return
     * an empty collection; or if this Expenses has previously
     * been saved, it will retrieve related Attendances from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Expenses.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildAttendance[] List of ChildAttendance objects
     * @phpstan-return ObjectCollection&\Traversable<ChildAttendance}> List of ChildAttendance objects
     */
    public function getAttendancesJoinGeoTownsRelatedByEndItownid(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildAttendanceQuery::create(null, $criteria);
        $query->joinWith('GeoTownsRelatedByEndItownid', $joinBehavior);

        return $this->getAttendances($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Expenses is new, it will return
     * an empty collection; or if this Expenses has previously
     * been saved, it will retrieve related Attendances from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Expenses.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildAttendance[] List of ChildAttendance objects
     * @phpstan-return ObjectCollection&\Traversable<ChildAttendance}> List of ChildAttendance objects
     */
    public function getAttendancesJoinGeoTownsRelatedByStartItownid(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildAttendanceQuery::create(null, $criteria);
        $query->joinWith('GeoTownsRelatedByStartItownid', $joinBehavior);

        return $this->getAttendances($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Expenses is new, it will return
     * an empty collection; or if this Expenses has previously
     * been saved, it will retrieve related Attendances from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Expenses.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildAttendance[] List of ChildAttendance objects
     * @phpstan-return ObjectCollection&\Traversable<ChildAttendance}> List of ChildAttendance objects
     */
    public function getAttendancesJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildAttendanceQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getAttendances($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Expenses is new, it will return
     * an empty collection; or if this Expenses has previously
     * been saved, it will retrieve related Attendances from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Expenses.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildAttendance[] List of ChildAttendance objects
     * @phpstan-return ObjectCollection&\Traversable<ChildAttendance}> List of ChildAttendance objects
     */
    public function getAttendancesJoinEmployee(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildAttendanceQuery::create(null, $criteria);
        $query->joinWith('Employee', $joinBehavior);

        return $this->getAttendances($query, $con);
    }

    /**
     * Clears out the collEmployeeWorkLogs collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addEmployeeWorkLogs()
     */
    public function clearEmployeeWorkLogs()
    {
        $this->collEmployeeWorkLogs = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collEmployeeWorkLogs collection loaded partially.
     *
     * @return void
     */
    public function resetPartialEmployeeWorkLogs($v = true): void
    {
        $this->collEmployeeWorkLogsPartial = $v;
    }

    /**
     * Initializes the collEmployeeWorkLogs collection.
     *
     * By default this just sets the collEmployeeWorkLogs collection to an empty array (like clearcollEmployeeWorkLogs());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initEmployeeWorkLogs(bool $overrideExisting = true): void
    {
        if (null !== $this->collEmployeeWorkLogs && !$overrideExisting) {
            return;
        }

        $collectionClassName = EmployeeWorkLogTableMap::getTableMap()->getCollectionClassName();

        $this->collEmployeeWorkLogs = new $collectionClassName;
        $this->collEmployeeWorkLogs->setModel('\entities\EmployeeWorkLog');
    }

    /**
     * Gets an array of ChildEmployeeWorkLog objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildExpenses is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildEmployeeWorkLog[] List of ChildEmployeeWorkLog objects
     * @phpstan-return ObjectCollection&\Traversable<ChildEmployeeWorkLog> List of ChildEmployeeWorkLog objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getEmployeeWorkLogs(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collEmployeeWorkLogsPartial && !$this->isNew();
        if (null === $this->collEmployeeWorkLogs || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collEmployeeWorkLogs) {
                    $this->initEmployeeWorkLogs();
                } else {
                    $collectionClassName = EmployeeWorkLogTableMap::getTableMap()->getCollectionClassName();

                    $collEmployeeWorkLogs = new $collectionClassName;
                    $collEmployeeWorkLogs->setModel('\entities\EmployeeWorkLog');

                    return $collEmployeeWorkLogs;
                }
            } else {
                $collEmployeeWorkLogs = ChildEmployeeWorkLogQuery::create(null, $criteria)
                    ->filterByExpenses($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collEmployeeWorkLogsPartial && count($collEmployeeWorkLogs)) {
                        $this->initEmployeeWorkLogs(false);

                        foreach ($collEmployeeWorkLogs as $obj) {
                            if (false == $this->collEmployeeWorkLogs->contains($obj)) {
                                $this->collEmployeeWorkLogs->append($obj);
                            }
                        }

                        $this->collEmployeeWorkLogsPartial = true;
                    }

                    return $collEmployeeWorkLogs;
                }

                if ($partial && $this->collEmployeeWorkLogs) {
                    foreach ($this->collEmployeeWorkLogs as $obj) {
                        if ($obj->isNew()) {
                            $collEmployeeWorkLogs[] = $obj;
                        }
                    }
                }

                $this->collEmployeeWorkLogs = $collEmployeeWorkLogs;
                $this->collEmployeeWorkLogsPartial = false;
            }
        }

        return $this->collEmployeeWorkLogs;
    }

    /**
     * Sets a collection of ChildEmployeeWorkLog objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $employeeWorkLogs A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setEmployeeWorkLogs(Collection $employeeWorkLogs, ?ConnectionInterface $con = null)
    {
        /** @var ChildEmployeeWorkLog[] $employeeWorkLogsToDelete */
        $employeeWorkLogsToDelete = $this->getEmployeeWorkLogs(new Criteria(), $con)->diff($employeeWorkLogs);


        $this->employeeWorkLogsScheduledForDeletion = $employeeWorkLogsToDelete;

        foreach ($employeeWorkLogsToDelete as $employeeWorkLogRemoved) {
            $employeeWorkLogRemoved->setExpenses(null);
        }

        $this->collEmployeeWorkLogs = null;
        foreach ($employeeWorkLogs as $employeeWorkLog) {
            $this->addEmployeeWorkLog($employeeWorkLog);
        }

        $this->collEmployeeWorkLogs = $employeeWorkLogs;
        $this->collEmployeeWorkLogsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related EmployeeWorkLog objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related EmployeeWorkLog objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countEmployeeWorkLogs(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collEmployeeWorkLogsPartial && !$this->isNew();
        if (null === $this->collEmployeeWorkLogs || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collEmployeeWorkLogs) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getEmployeeWorkLogs());
            }

            $query = ChildEmployeeWorkLogQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByExpenses($this)
                ->count($con);
        }

        return count($this->collEmployeeWorkLogs);
    }

    /**
     * Method called to associate a ChildEmployeeWorkLog object to this object
     * through the ChildEmployeeWorkLog foreign key attribute.
     *
     * @param ChildEmployeeWorkLog $l ChildEmployeeWorkLog
     * @return $this The current object (for fluent API support)
     */
    public function addEmployeeWorkLog(ChildEmployeeWorkLog $l)
    {
        if ($this->collEmployeeWorkLogs === null) {
            $this->initEmployeeWorkLogs();
            $this->collEmployeeWorkLogsPartial = true;
        }

        if (!$this->collEmployeeWorkLogs->contains($l)) {
            $this->doAddEmployeeWorkLog($l);

            if ($this->employeeWorkLogsScheduledForDeletion and $this->employeeWorkLogsScheduledForDeletion->contains($l)) {
                $this->employeeWorkLogsScheduledForDeletion->remove($this->employeeWorkLogsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildEmployeeWorkLog $employeeWorkLog The ChildEmployeeWorkLog object to add.
     */
    protected function doAddEmployeeWorkLog(ChildEmployeeWorkLog $employeeWorkLog): void
    {
        $this->collEmployeeWorkLogs[]= $employeeWorkLog;
        $employeeWorkLog->setExpenses($this);
    }

    /**
     * @param ChildEmployeeWorkLog $employeeWorkLog The ChildEmployeeWorkLog object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeEmployeeWorkLog(ChildEmployeeWorkLog $employeeWorkLog)
    {
        if ($this->getEmployeeWorkLogs()->contains($employeeWorkLog)) {
            $pos = $this->collEmployeeWorkLogs->search($employeeWorkLog);
            $this->collEmployeeWorkLogs->remove($pos);
            if (null === $this->employeeWorkLogsScheduledForDeletion) {
                $this->employeeWorkLogsScheduledForDeletion = clone $this->collEmployeeWorkLogs;
                $this->employeeWorkLogsScheduledForDeletion->clear();
            }
            $this->employeeWorkLogsScheduledForDeletion[]= clone $employeeWorkLog;
            $employeeWorkLog->setExpenses(null);
        }

        return $this;
    }

    /**
     * Clears out the collExpenseFiless collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addExpenseFiless()
     */
    public function clearExpenseFiless()
    {
        $this->collExpenseFiless = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collExpenseFiless collection loaded partially.
     *
     * @return void
     */
    public function resetPartialExpenseFiless($v = true): void
    {
        $this->collExpenseFilessPartial = $v;
    }

    /**
     * Initializes the collExpenseFiless collection.
     *
     * By default this just sets the collExpenseFiless collection to an empty array (like clearcollExpenseFiless());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initExpenseFiless(bool $overrideExisting = true): void
    {
        if (null !== $this->collExpenseFiless && !$overrideExisting) {
            return;
        }

        $collectionClassName = ExpenseFilesTableMap::getTableMap()->getCollectionClassName();

        $this->collExpenseFiless = new $collectionClassName;
        $this->collExpenseFiless->setModel('\entities\ExpenseFiles');
    }

    /**
     * Gets an array of ChildExpenseFiles objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildExpenses is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildExpenseFiles[] List of ChildExpenseFiles objects
     * @phpstan-return ObjectCollection&\Traversable<ChildExpenseFiles> List of ChildExpenseFiles objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getExpenseFiless(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collExpenseFilessPartial && !$this->isNew();
        if (null === $this->collExpenseFiless || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collExpenseFiless) {
                    $this->initExpenseFiless();
                } else {
                    $collectionClassName = ExpenseFilesTableMap::getTableMap()->getCollectionClassName();

                    $collExpenseFiless = new $collectionClassName;
                    $collExpenseFiless->setModel('\entities\ExpenseFiles');

                    return $collExpenseFiless;
                }
            } else {
                $collExpenseFiless = ChildExpenseFilesQuery::create(null, $criteria)
                    ->filterByExpenses($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collExpenseFilessPartial && count($collExpenseFiless)) {
                        $this->initExpenseFiless(false);

                        foreach ($collExpenseFiless as $obj) {
                            if (false == $this->collExpenseFiless->contains($obj)) {
                                $this->collExpenseFiless->append($obj);
                            }
                        }

                        $this->collExpenseFilessPartial = true;
                    }

                    return $collExpenseFiless;
                }

                if ($partial && $this->collExpenseFiless) {
                    foreach ($this->collExpenseFiless as $obj) {
                        if ($obj->isNew()) {
                            $collExpenseFiless[] = $obj;
                        }
                    }
                }

                $this->collExpenseFiless = $collExpenseFiless;
                $this->collExpenseFilessPartial = false;
            }
        }

        return $this->collExpenseFiless;
    }

    /**
     * Sets a collection of ChildExpenseFiles objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $expenseFiless A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setExpenseFiless(Collection $expenseFiless, ?ConnectionInterface $con = null)
    {
        /** @var ChildExpenseFiles[] $expenseFilessToDelete */
        $expenseFilessToDelete = $this->getExpenseFiless(new Criteria(), $con)->diff($expenseFiless);


        $this->expenseFilessScheduledForDeletion = $expenseFilessToDelete;

        foreach ($expenseFilessToDelete as $expenseFilesRemoved) {
            $expenseFilesRemoved->setExpenses(null);
        }

        $this->collExpenseFiless = null;
        foreach ($expenseFiless as $expenseFiles) {
            $this->addExpenseFiles($expenseFiles);
        }

        $this->collExpenseFiless = $expenseFiless;
        $this->collExpenseFilessPartial = false;

        return $this;
    }

    /**
     * Returns the number of related ExpenseFiles objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related ExpenseFiles objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countExpenseFiless(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collExpenseFilessPartial && !$this->isNew();
        if (null === $this->collExpenseFiless || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collExpenseFiless) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getExpenseFiless());
            }

            $query = ChildExpenseFilesQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByExpenses($this)
                ->count($con);
        }

        return count($this->collExpenseFiless);
    }

    /**
     * Method called to associate a ChildExpenseFiles object to this object
     * through the ChildExpenseFiles foreign key attribute.
     *
     * @param ChildExpenseFiles $l ChildExpenseFiles
     * @return $this The current object (for fluent API support)
     */
    public function addExpenseFiles(ChildExpenseFiles $l)
    {
        if ($this->collExpenseFiless === null) {
            $this->initExpenseFiless();
            $this->collExpenseFilessPartial = true;
        }

        if (!$this->collExpenseFiless->contains($l)) {
            $this->doAddExpenseFiles($l);

            if ($this->expenseFilessScheduledForDeletion and $this->expenseFilessScheduledForDeletion->contains($l)) {
                $this->expenseFilessScheduledForDeletion->remove($this->expenseFilessScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildExpenseFiles $expenseFiles The ChildExpenseFiles object to add.
     */
    protected function doAddExpenseFiles(ChildExpenseFiles $expenseFiles): void
    {
        $this->collExpenseFiless[]= $expenseFiles;
        $expenseFiles->setExpenses($this);
    }

    /**
     * @param ChildExpenseFiles $expenseFiles The ChildExpenseFiles object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeExpenseFiles(ChildExpenseFiles $expenseFiles)
    {
        if ($this->getExpenseFiless()->contains($expenseFiles)) {
            $pos = $this->collExpenseFiless->search($expenseFiles);
            $this->collExpenseFiless->remove($pos);
            if (null === $this->expenseFilessScheduledForDeletion) {
                $this->expenseFilessScheduledForDeletion = clone $this->collExpenseFiless;
                $this->expenseFilessScheduledForDeletion->clear();
            }
            $this->expenseFilessScheduledForDeletion[]= clone $expenseFiles;
            $expenseFiles->setExpenses(null);
        }

        return $this;
    }

    /**
     * Clears out the collExpenseLists collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addExpenseLists()
     */
    public function clearExpenseLists()
    {
        $this->collExpenseLists = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collExpenseLists collection loaded partially.
     *
     * @return void
     */
    public function resetPartialExpenseLists($v = true): void
    {
        $this->collExpenseListsPartial = $v;
    }

    /**
     * Initializes the collExpenseLists collection.
     *
     * By default this just sets the collExpenseLists collection to an empty array (like clearcollExpenseLists());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initExpenseLists(bool $overrideExisting = true): void
    {
        if (null !== $this->collExpenseLists && !$overrideExisting) {
            return;
        }

        $collectionClassName = ExpenseListTableMap::getTableMap()->getCollectionClassName();

        $this->collExpenseLists = new $collectionClassName;
        $this->collExpenseLists->setModel('\entities\ExpenseList');
    }

    /**
     * Gets an array of ChildExpenseList objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildExpenses is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildExpenseList[] List of ChildExpenseList objects
     * @phpstan-return ObjectCollection&\Traversable<ChildExpenseList> List of ChildExpenseList objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getExpenseLists(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collExpenseListsPartial && !$this->isNew();
        if (null === $this->collExpenseLists || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collExpenseLists) {
                    $this->initExpenseLists();
                } else {
                    $collectionClassName = ExpenseListTableMap::getTableMap()->getCollectionClassName();

                    $collExpenseLists = new $collectionClassName;
                    $collExpenseLists->setModel('\entities\ExpenseList');

                    return $collExpenseLists;
                }
            } else {
                $collExpenseLists = ChildExpenseListQuery::create(null, $criteria)
                    ->filterByExpenses($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collExpenseListsPartial && count($collExpenseLists)) {
                        $this->initExpenseLists(false);

                        foreach ($collExpenseLists as $obj) {
                            if (false == $this->collExpenseLists->contains($obj)) {
                                $this->collExpenseLists->append($obj);
                            }
                        }

                        $this->collExpenseListsPartial = true;
                    }

                    return $collExpenseLists;
                }

                if ($partial && $this->collExpenseLists) {
                    foreach ($this->collExpenseLists as $obj) {
                        if ($obj->isNew()) {
                            $collExpenseLists[] = $obj;
                        }
                    }
                }

                $this->collExpenseLists = $collExpenseLists;
                $this->collExpenseListsPartial = false;
            }
        }

        return $this->collExpenseLists;
    }

    /**
     * Sets a collection of ChildExpenseList objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $expenseLists A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setExpenseLists(Collection $expenseLists, ?ConnectionInterface $con = null)
    {
        /** @var ChildExpenseList[] $expenseListsToDelete */
        $expenseListsToDelete = $this->getExpenseLists(new Criteria(), $con)->diff($expenseLists);


        $this->expenseListsScheduledForDeletion = $expenseListsToDelete;

        foreach ($expenseListsToDelete as $expenseListRemoved) {
            $expenseListRemoved->setExpenses(null);
        }

        $this->collExpenseLists = null;
        foreach ($expenseLists as $expenseList) {
            $this->addExpenseList($expenseList);
        }

        $this->collExpenseLists = $expenseLists;
        $this->collExpenseListsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related ExpenseList objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related ExpenseList objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countExpenseLists(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collExpenseListsPartial && !$this->isNew();
        if (null === $this->collExpenseLists || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collExpenseLists) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getExpenseLists());
            }

            $query = ChildExpenseListQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByExpenses($this)
                ->count($con);
        }

        return count($this->collExpenseLists);
    }

    /**
     * Method called to associate a ChildExpenseList object to this object
     * through the ChildExpenseList foreign key attribute.
     *
     * @param ChildExpenseList $l ChildExpenseList
     * @return $this The current object (for fluent API support)
     */
    public function addExpenseList(ChildExpenseList $l)
    {
        if ($this->collExpenseLists === null) {
            $this->initExpenseLists();
            $this->collExpenseListsPartial = true;
        }

        if (!$this->collExpenseLists->contains($l)) {
            $this->doAddExpenseList($l);

            if ($this->expenseListsScheduledForDeletion and $this->expenseListsScheduledForDeletion->contains($l)) {
                $this->expenseListsScheduledForDeletion->remove($this->expenseListsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildExpenseList $expenseList The ChildExpenseList object to add.
     */
    protected function doAddExpenseList(ChildExpenseList $expenseList): void
    {
        $this->collExpenseLists[]= $expenseList;
        $expenseList->setExpenses($this);
    }

    /**
     * @param ChildExpenseList $expenseList The ChildExpenseList object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeExpenseList(ChildExpenseList $expenseList)
    {
        if ($this->getExpenseLists()->contains($expenseList)) {
            $pos = $this->collExpenseLists->search($expenseList);
            $this->collExpenseLists->remove($pos);
            if (null === $this->expenseListsScheduledForDeletion) {
                $this->expenseListsScheduledForDeletion = clone $this->collExpenseLists;
                $this->expenseListsScheduledForDeletion->clear();
            }
            $this->expenseListsScheduledForDeletion[]= clone $expenseList;
            $expenseList->setExpenses(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Expenses is new, it will return
     * an empty collection; or if this Expenses has previously
     * been saved, it will retrieve related ExpenseLists from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Expenses.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildExpenseList[] List of ChildExpenseList objects
     * @phpstan-return ObjectCollection&\Traversable<ChildExpenseList}> List of ChildExpenseList objects
     */
    public function getExpenseListsJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildExpenseListQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getExpenseLists($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Expenses is new, it will return
     * an empty collection; or if this Expenses has previously
     * been saved, it will retrieve related ExpenseLists from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Expenses.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildExpenseList[] List of ChildExpenseList objects
     * @phpstan-return ObjectCollection&\Traversable<ChildExpenseList}> List of ChildExpenseList objects
     */
    public function getExpenseListsJoinExpenseMaster(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildExpenseListQuery::create(null, $criteria);
        $query->joinWith('ExpenseMaster', $joinBehavior);

        return $this->getExpenseLists($query, $con);
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
        if (null !== $this->aBudgetGroup) {
            $this->aBudgetGroup->removeExpenses($this);
        }
        if (null !== $this->aCompany) {
            $this->aCompany->removeExpenses($this);
        }
        if (null !== $this->aCurrencies) {
            $this->aCurrencies->removeExpenses($this);
        }
        if (null !== $this->aEmployee) {
            $this->aEmployee->removeExpenses($this);
        }
        if (null !== $this->aOrgUnit) {
            $this->aOrgUnit->removeExpenses($this);
        }
        $this->exp_id = null;
        $this->company_id = null;
        $this->expense_date = null;
        $this->budget_id = null;
        $this->expense_trip = null;
        $this->expense_placewrk = null;
        $this->expense_req_amt = null;
        $this->expense_approved_amt = null;
        $this->expense_additional_amt = null;
        $this->expense_tax_amt = null;
        $this->expense_final_amt = null;
        $this->expense_status = null;
        $this->employee_id = null;
        $this->expense_mode = null;
        $this->expense_note = null;
        $this->orgunit_id = null;
        $this->trip_currency = null;
        $this->readflag = null;
        $this->created_at = null;
        $this->updated_at = null;
        $this->pin = null;
        $this->device_name = null;
        $this->device_battery = null;
        $this->device_time = null;
        $this->settled_amount = null;
        $this->settled_date = null;
        $this->settled_desc = null;
        $this->trip_type = null;
        $this->do_verify = null;
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
            if ($this->collAttendances) {
                foreach ($this->collAttendances as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collEmployeeWorkLogs) {
                foreach ($this->collEmployeeWorkLogs as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collExpenseFiless) {
                foreach ($this->collExpenseFiless as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collExpenseLists) {
                foreach ($this->collExpenseLists as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collAttendances = null;
        $this->collEmployeeWorkLogs = null;
        $this->collExpenseFiless = null;
        $this->collExpenseLists = null;
        $this->aBudgetGroup = null;
        $this->aCompany = null;
        $this->aCurrencies = null;
        $this->aEmployee = null;
        $this->aOrgUnit = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(ExpensesTableMap::DEFAULT_STRING_FORMAT);
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
