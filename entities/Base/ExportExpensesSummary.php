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
use entities\ExportExpensesSummaryQuery as ChildExportExpensesSummaryQuery;
use entities\Map\ExportExpensesSummaryTableMap;

/**
 * Base class that represents a row from the 'export_expenses_summary' table.
 *
 *
 *
 * @package    propel.generator.entities.Base
 */
abstract class ExportExpensesSummary implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\entities\\Map\\ExportExpensesSummaryTableMap';


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
     * The value for the requested_da_hq_amount field.
     *
     * @var        string|null
     */
    protected $requested_da_hq_amount;

    /**
     * The value for the requested_da_ex_hq_amount field.
     *
     * @var        string|null
     */
    protected $requested_da_ex_hq_amount;

    /**
     * The value for the requested_da_os_amount field.
     *
     * @var        string|null
     */
    protected $requested_da_os_amount;

    /**
     * The value for the requested_da_transit_amount field.
     *
     * @var        string|null
     */
    protected $requested_da_transit_amount;

    /**
     * The value for the requested_da_last_day_os_amount field.
     *
     * @var        string|null
     */
    protected $requested_da_last_day_os_amount;

    /**
     * The value for the requested_ta_amount field.
     *
     * @var        string|null
     */
    protected $requested_ta_amount;

    /**
     * The value for the requested_internet_bill_amount field.
     *
     * @var        string|null
     */
    protected $requested_internet_bill_amount;

    /**
     * The value for the requested_os_petrol_allowance_amount field.
     *
     * @var        string|null
     */
    protected $requested_os_petrol_allowance_amount;

    /**
     * The value for the requested_isbt_amount field.
     *
     * @var        string|null
     */
    protected $requested_isbt_amount;

    /**
     * The value for the requested_hill_allowance_amount field.
     *
     * @var        string|null
     */
    protected $requested_hill_allowance_amount;

    /**
     * The value for the requested_ilp_amount field.
     *
     * @var        string|null
     */
    protected $requested_ilp_amount;

    /**
     * The value for the requested_mr_conveyance_amount field.
     *
     * @var        string|null
     */
    protected $requested_mr_conveyance_amount;

    /**
     * The value for the requested_am_conveyance_amount field.
     *
     * @var        string|null
     */
    protected $requested_am_conveyance_amount;

    /**
     * The value for the requested_rm_lodging_and_food_amount field.
     *
     * @var        string|null
     */
    protected $requested_rm_lodging_and_food_amount;

    /**
     * The value for the requested_handset_amount field.
     *
     * @var        string|null
     */
    protected $requested_handset_amount;

    /**
     * The value for the requested_hq_petrol_allowance_amount field.
     *
     * @var        string|null
     */
    protected $requested_hq_petrol_allowance_amount;

    /**
     * The value for the requested_zm_lodging_and_food_amount field.
     *
     * @var        string|null
     */
    protected $requested_zm_lodging_and_food_amount;

    /**
     * The value for the requested_rm_mobile_bill_amount field.
     *
     * @var        string|null
     */
    protected $requested_rm_mobile_bill_amount;

    /**
     * The value for the requested_zm_local_conveyance_amount field.
     *
     * @var        string|null
     */
    protected $requested_zm_local_conveyance_amount;

    /**
     * The value for the requested_rm_local_conveyance_amount field.
     *
     * @var        string|null
     */
    protected $requested_rm_local_conveyance_amount;

    /**
     * The value for the requested_zm_mobile_bill_amount field.
     *
     * @var        string|null
     */
    protected $requested_zm_mobile_bill_amount;

    /**
     * The value for the requested_stationery_amount field.
     *
     * @var        string|null
     */
    protected $requested_stationery_amount;

    /**
     * The value for the requested_event_amount field.
     *
     * @var        string|null
     */
    protected $requested_event_amount;

    /**
     * The value for the requested_own_stay_amount field.
     *
     * @var        string|null
     */
    protected $requested_own_stay_amount;

    /**
     * The value for the requested_other_zm_local_conveyance_amount field.
     *
     * @var        string|null
     */
    protected $requested_other_zm_local_conveyance_amount;

    /**
     * The value for the requested_other_os_petrol_allowance_amount field.
     *
     * @var        string|null
     */
    protected $requested_other_os_petrol_allowance_amount;

    /**
     * The value for the requested_other_rm_local_conveyance_amount field.
     *
     * @var        string|null
     */
    protected $requested_other_rm_local_conveyance_amount;

    /**
     * The value for the final_da_hq_amount field.
     *
     * @var        string|null
     */
    protected $final_da_hq_amount;

    /**
     * The value for the final_da_ex_hq_amount field.
     *
     * @var        string|null
     */
    protected $final_da_ex_hq_amount;

    /**
     * The value for the final_da_os_amount field.
     *
     * @var        string|null
     */
    protected $final_da_os_amount;

    /**
     * The value for the final_da_transit_amount field.
     *
     * @var        string|null
     */
    protected $final_da_transit_amount;

    /**
     * The value for the final_da_last_day_os_amount field.
     *
     * @var        string|null
     */
    protected $final_da_last_day_os_amount;

    /**
     * The value for the final_ta_amount field.
     *
     * @var        string|null
     */
    protected $final_ta_amount;

    /**
     * The value for the final_internet_bill_amount field.
     *
     * @var        string|null
     */
    protected $final_internet_bill_amount;

    /**
     * The value for the final_os_petrol_allowance_amount field.
     *
     * @var        string|null
     */
    protected $final_os_petrol_allowance_amount;

    /**
     * The value for the final_isbt_amount field.
     *
     * @var        string|null
     */
    protected $final_isbt_amount;

    /**
     * The value for the final_hill_allowance_amount field.
     *
     * @var        string|null
     */
    protected $final_hill_allowance_amount;

    /**
     * The value for the final_ilp_amount field.
     *
     * @var        string|null
     */
    protected $final_ilp_amount;

    /**
     * The value for the final_mr_conveyance_amount field.
     *
     * @var        string|null
     */
    protected $final_mr_conveyance_amount;

    /**
     * The value for the final_am_conveyance_amount field.
     *
     * @var        string|null
     */
    protected $final_am_conveyance_amount;

    /**
     * The value for the final_rm_lodging_and_food_amount field.
     *
     * @var        string|null
     */
    protected $final_rm_lodging_and_food_amount;

    /**
     * The value for the final_handset_amount field.
     *
     * @var        string|null
     */
    protected $final_handset_amount;

    /**
     * The value for the final_hq_petrol_allowance_amount field.
     *
     * @var        string|null
     */
    protected $final_hq_petrol_allowance_amount;

    /**
     * The value for the final_zm_lodging_and_food_amount field.
     *
     * @var        string|null
     */
    protected $final_zm_lodging_and_food_amount;

    /**
     * The value for the final_rm_mobile_bill_amount field.
     *
     * @var        string|null
     */
    protected $final_rm_mobile_bill_amount;

    /**
     * The value for the final_zm_local_conveyance_amount field.
     *
     * @var        string|null
     */
    protected $final_zm_local_conveyance_amount;

    /**
     * The value for the final_rm_local_conveyance_amount field.
     *
     * @var        string|null
     */
    protected $final_rm_local_conveyance_amount;

    /**
     * The value for the final_zm_mobile_bill_amount field.
     *
     * @var        string|null
     */
    protected $final_zm_mobile_bill_amount;

    /**
     * The value for the final_stationery_amount field.
     *
     * @var        string|null
     */
    protected $final_stationery_amount;

    /**
     * The value for the final_event_amount field.
     *
     * @var        string|null
     */
    protected $final_event_amount;

    /**
     * The value for the final_own_stay_amount field.
     *
     * @var        string|null
     */
    protected $final_own_stay_amount;

    /**
     * The value for the final_other_zm_local_conveyance_amount field.
     *
     * @var        string|null
     */
    protected $final_other_zm_local_conveyance_amount;

    /**
     * The value for the final_other_os_petrol_allowance_amount field.
     *
     * @var        string|null
     */
    protected $final_other_os_petrol_allowance_amount;

    /**
     * The value for the final_other_rm_local_conveyance_amount field.
     *
     * @var        string|null
     */
    protected $final_other_rm_local_conveyance_amount;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * Initializes internal state of entities\Base\ExportExpensesSummary object.
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
     * Compares this with another <code>ExportExpensesSummary</code> instance.  If
     * <code>obj</code> is an instance of <code>ExportExpensesSummary</code>, delegates to
     * <code>equals(ExportExpensesSummary)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [requested_da_hq_amount] column value.
     *
     * @return string|null
     */
    public function getRequestedDaHqAmount()
    {
        return $this->requested_da_hq_amount;
    }

    /**
     * Get the [requested_da_ex_hq_amount] column value.
     *
     * @return string|null
     */
    public function getRequestedDaExHqAmount()
    {
        return $this->requested_da_ex_hq_amount;
    }

    /**
     * Get the [requested_da_os_amount] column value.
     *
     * @return string|null
     */
    public function getRequestedDaOsAmount()
    {
        return $this->requested_da_os_amount;
    }

    /**
     * Get the [requested_da_transit_amount] column value.
     *
     * @return string|null
     */
    public function getRequestedAaTransitAmount()
    {
        return $this->requested_da_transit_amount;
    }

    /**
     * Get the [requested_da_last_day_os_amount] column value.
     *
     * @return string|null
     */
    public function getRequestedDaLastDayOsAmount()
    {
        return $this->requested_da_last_day_os_amount;
    }

    /**
     * Get the [requested_ta_amount] column value.
     *
     * @return string|null
     */
    public function getRequestedTaAmount()
    {
        return $this->requested_ta_amount;
    }

    /**
     * Get the [requested_internet_bill_amount] column value.
     *
     * @return string|null
     */
    public function getRequestedInternetBillAmount()
    {
        return $this->requested_internet_bill_amount;
    }

    /**
     * Get the [requested_os_petrol_allowance_amount] column value.
     *
     * @return string|null
     */
    public function getRequestedOsPetrolAllowanceAmount()
    {
        return $this->requested_os_petrol_allowance_amount;
    }

    /**
     * Get the [requested_isbt_amount] column value.
     *
     * @return string|null
     */
    public function getRequestedIsbtAmount()
    {
        return $this->requested_isbt_amount;
    }

    /**
     * Get the [requested_hill_allowance_amount] column value.
     *
     * @return string|null
     */
    public function getRequestedHillAllowanceAmount()
    {
        return $this->requested_hill_allowance_amount;
    }

    /**
     * Get the [requested_ilp_amount] column value.
     *
     * @return string|null
     */
    public function getRequestedIlpAmount()
    {
        return $this->requested_ilp_amount;
    }

    /**
     * Get the [requested_mr_conveyance_amount] column value.
     *
     * @return string|null
     */
    public function getRequestedMrConveyanceAmount()
    {
        return $this->requested_mr_conveyance_amount;
    }

    /**
     * Get the [requested_am_conveyance_amount] column value.
     *
     * @return string|null
     */
    public function getRequestedAmConveyanceAmount()
    {
        return $this->requested_am_conveyance_amount;
    }

    /**
     * Get the [requested_rm_lodging_and_food_amount] column value.
     *
     * @return string|null
     */
    public function getRequestedRmLodgingAndFoodAmount()
    {
        return $this->requested_rm_lodging_and_food_amount;
    }

    /**
     * Get the [requested_handset_amount] column value.
     *
     * @return string|null
     */
    public function getRequestedHandsetAmount()
    {
        return $this->requested_handset_amount;
    }

    /**
     * Get the [requested_hq_petrol_allowance_amount] column value.
     *
     * @return string|null
     */
    public function getRequestedHqPetrolAllowanceAmount()
    {
        return $this->requested_hq_petrol_allowance_amount;
    }

    /**
     * Get the [requested_zm_lodging_and_food_amount] column value.
     *
     * @return string|null
     */
    public function getRequestedZmLodgingAndFoodAmount()
    {
        return $this->requested_zm_lodging_and_food_amount;
    }

    /**
     * Get the [requested_rm_mobile_bill_amount] column value.
     *
     * @return string|null
     */
    public function getRequestedRmMobileBillAmount()
    {
        return $this->requested_rm_mobile_bill_amount;
    }

    /**
     * Get the [requested_zm_local_conveyance_amount] column value.
     *
     * @return string|null
     */
    public function getRequestedZmLocalConveyanceAmount()
    {
        return $this->requested_zm_local_conveyance_amount;
    }

    /**
     * Get the [requested_rm_local_conveyance_amount] column value.
     *
     * @return string|null
     */
    public function getRequestedRmLocalConveyanceAmount()
    {
        return $this->requested_rm_local_conveyance_amount;
    }

    /**
     * Get the [requested_zm_mobile_bill_amount] column value.
     *
     * @return string|null
     */
    public function getRequestedZmMobileBillAmount()
    {
        return $this->requested_zm_mobile_bill_amount;
    }

    /**
     * Get the [requested_stationery_amount] column value.
     *
     * @return string|null
     */
    public function getRequestedStationeryAmount()
    {
        return $this->requested_stationery_amount;
    }

    /**
     * Get the [requested_event_amount] column value.
     *
     * @return string|null
     */
    public function getRequestedEventAmount()
    {
        return $this->requested_event_amount;
    }

    /**
     * Get the [requested_own_stay_amount] column value.
     *
     * @return string|null
     */
    public function getRequestedOwnStayAmount()
    {
        return $this->requested_own_stay_amount;
    }

    /**
     * Get the [requested_other_zm_local_conveyance_amount] column value.
     *
     * @return string|null
     */
    public function getRequestedOtherZmLocalConveyanceAmount()
    {
        return $this->requested_other_zm_local_conveyance_amount;
    }

    /**
     * Get the [requested_other_os_petrol_allowance_amount] column value.
     *
     * @return string|null
     */
    public function getRequestedOtherOsPetrolAllowanceAmount()
    {
        return $this->requested_other_os_petrol_allowance_amount;
    }

    /**
     * Get the [requested_other_rm_local_conveyance_amount] column value.
     *
     * @return string|null
     */
    public function getRequestedOtherRmLocalConveyanceAmount()
    {
        return $this->requested_other_rm_local_conveyance_amount;
    }

    /**
     * Get the [final_da_hq_amount] column value.
     *
     * @return string|null
     */
    public function getFinalDaHqAmount()
    {
        return $this->final_da_hq_amount;
    }

    /**
     * Get the [final_da_ex_hq_amount] column value.
     *
     * @return string|null
     */
    public function getFinalDaExHqAmount()
    {
        return $this->final_da_ex_hq_amount;
    }

    /**
     * Get the [final_da_os_amount] column value.
     *
     * @return string|null
     */
    public function getFinalDaOsAmount()
    {
        return $this->final_da_os_amount;
    }

    /**
     * Get the [final_da_transit_amount] column value.
     *
     * @return string|null
     */
    public function getFinalDaTransitAmount()
    {
        return $this->final_da_transit_amount;
    }

    /**
     * Get the [final_da_last_day_os_amount] column value.
     *
     * @return string|null
     */
    public function getFinalDaLastDayOsAmount()
    {
        return $this->final_da_last_day_os_amount;
    }

    /**
     * Get the [final_ta_amount] column value.
     *
     * @return string|null
     */
    public function getFinalTaAmount()
    {
        return $this->final_ta_amount;
    }

    /**
     * Get the [final_internet_bill_amount] column value.
     *
     * @return string|null
     */
    public function getFinalInternetBillAmount()
    {
        return $this->final_internet_bill_amount;
    }

    /**
     * Get the [final_os_petrol_allowance_amount] column value.
     *
     * @return string|null
     */
    public function getFinalOsPetrolAllowanceAmount()
    {
        return $this->final_os_petrol_allowance_amount;
    }

    /**
     * Get the [final_isbt_amount] column value.
     *
     * @return string|null
     */
    public function getFinalIsbtAmount()
    {
        return $this->final_isbt_amount;
    }

    /**
     * Get the [final_hill_allowance_amount] column value.
     *
     * @return string|null
     */
    public function getFinalHillAllowanceAmount()
    {
        return $this->final_hill_allowance_amount;
    }

    /**
     * Get the [final_ilp_amount] column value.
     *
     * @return string|null
     */
    public function getFinalIlpAmount()
    {
        return $this->final_ilp_amount;
    }

    /**
     * Get the [final_mr_conveyance_amount] column value.
     *
     * @return string|null
     */
    public function getFinalMrConveyanceAmount()
    {
        return $this->final_mr_conveyance_amount;
    }

    /**
     * Get the [final_am_conveyance_amount] column value.
     *
     * @return string|null
     */
    public function getFinalAmConveyanceAmount()
    {
        return $this->final_am_conveyance_amount;
    }

    /**
     * Get the [final_rm_lodging_and_food_amount] column value.
     *
     * @return string|null
     */
    public function getFinalRmLodgingAndFoodAmount()
    {
        return $this->final_rm_lodging_and_food_amount;
    }

    /**
     * Get the [final_handset_amount] column value.
     *
     * @return string|null
     */
    public function getFinalHandsetAmount()
    {
        return $this->final_handset_amount;
    }

    /**
     * Get the [final_hq_petrol_allowance_amount] column value.
     *
     * @return string|null
     */
    public function getFinalHqPetrolAllowanceAmount()
    {
        return $this->final_hq_petrol_allowance_amount;
    }

    /**
     * Get the [final_zm_lodging_and_food_amount] column value.
     *
     * @return string|null
     */
    public function getFinalZmLodgingAndFoodAmount()
    {
        return $this->final_zm_lodging_and_food_amount;
    }

    /**
     * Get the [final_rm_mobile_bill_amount] column value.
     *
     * @return string|null
     */
    public function getFinalRmMobileBillAmount()
    {
        return $this->final_rm_mobile_bill_amount;
    }

    /**
     * Get the [final_zm_local_conveyance_amount] column value.
     *
     * @return string|null
     */
    public function getFinalZmLocalConveyanceAmount()
    {
        return $this->final_zm_local_conveyance_amount;
    }

    /**
     * Get the [final_rm_local_conveyance_amount] column value.
     *
     * @return string|null
     */
    public function getFinalRmLocalConveyanceAmount()
    {
        return $this->final_rm_local_conveyance_amount;
    }

    /**
     * Get the [final_zm_mobile_bill_amount] column value.
     *
     * @return string|null
     */
    public function getFinalZmMobileBillAmount()
    {
        return $this->final_zm_mobile_bill_amount;
    }

    /**
     * Get the [final_stationery_amount] column value.
     *
     * @return string|null
     */
    public function getFinalStationeryAmount()
    {
        return $this->final_stationery_amount;
    }

    /**
     * Get the [final_event_amount] column value.
     *
     * @return string|null
     */
    public function getFinalEventAmount()
    {
        return $this->final_event_amount;
    }

    /**
     * Get the [final_own_stay_amount] column value.
     *
     * @return string|null
     */
    public function getFinal_own_stay_amount()
    {
        return $this->final_own_stay_amount;
    }

    /**
     * Get the [final_other_zm_local_conveyance_amount] column value.
     *
     * @return string|null
     */
    public function getFinalOtherZmLocalConveyanceAmount()
    {
        return $this->final_other_zm_local_conveyance_amount;
    }

    /**
     * Get the [final_other_os_petrol_allowance_amount] column value.
     *
     * @return string|null
     */
    public function getFinalOtherOsPetrolAllowanceAmount()
    {
        return $this->final_other_os_petrol_allowance_amount;
    }

    /**
     * Get the [final_other_rm_local_conveyance_amount] column value.
     *
     * @return string|null
     */
    public function getFinalOtherRmLocalConveyanceAmount()
    {
        return $this->final_other_rm_local_conveyance_amount;
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
            $this->modifiedColumns[ExportExpensesSummaryTableMap::COL_UNIQUEID] = true;
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
            $this->modifiedColumns[ExportExpensesSummaryTableMap::COL_EMPLOYEE_ID] = true;
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
            $this->modifiedColumns[ExportExpensesSummaryTableMap::COL_POSITION_ID] = true;
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
            $this->modifiedColumns[ExportExpensesSummaryTableMap::COL_ORGUNITID] = true;
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
            $this->modifiedColumns[ExportExpensesSummaryTableMap::COL_BU_NAME] = true;
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
            $this->modifiedColumns[ExportExpensesSummaryTableMap::COL_EMP_POSITION_CODE] = true;
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
            $this->modifiedColumns[ExportExpensesSummaryTableMap::COL_EMP_POSITION_NAME] = true;
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
            $this->modifiedColumns[ExportExpensesSummaryTableMap::COL_EMP_LEVEL] = true;
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
            $this->modifiedColumns[ExportExpensesSummaryTableMap::COL_EMPLOYEE_CODE] = true;
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
            $this->modifiedColumns[ExportExpensesSummaryTableMap::COL_EMPLOYEE_NAME] = true;
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
            $this->modifiedColumns[ExportExpensesSummaryTableMap::COL_REPORTING_TO_EMPLOYEE_NAME] = true;
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
            $this->modifiedColumns[ExportExpensesSummaryTableMap::COL_REPORTING_TO_EMPLOYEE_CODE] = true;
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
            $this->modifiedColumns[ExportExpensesSummaryTableMap::COL_EMP_TOWN] = true;
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
            $this->modifiedColumns[ExportExpensesSummaryTableMap::COL_EMP_BRANCH] = true;
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
            $this->modifiedColumns[ExportExpensesSummaryTableMap::COL_DESIGNATION] = true;
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
            $this->modifiedColumns[ExportExpensesSummaryTableMap::COL_GRADE] = true;
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
            $this->modifiedColumns[ExportExpensesSummaryTableMap::COL_STATUS] = true;
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
            $this->modifiedColumns[ExportExpensesSummaryTableMap::COL_MONTH] = true;
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
            $this->modifiedColumns[ExportExpensesSummaryTableMap::COL_REQUESTED_AMOUNT] = true;
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
            $this->modifiedColumns[ExportExpensesSummaryTableMap::COL_APPROVED_AMOUNT] = true;
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
            $this->modifiedColumns[ExportExpensesSummaryTableMap::COL_FINAL_AMOUNT] = true;
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
            $this->modifiedColumns[ExportExpensesSummaryTableMap::COL_EXPENSE_STATUS] = true;
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
            $this->modifiedColumns[ExportExpensesSummaryTableMap::COL_TOTAL_EXPENSES] = true;
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
            $this->modifiedColumns[ExportExpensesSummaryTableMap::COL_EXPENSE_DATES] = true;
        }

        return $this;
    }

    /**
     * Set the value of [requested_da_hq_amount] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setRequestedDaHqAmount($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->requested_da_hq_amount !== $v) {
            $this->requested_da_hq_amount = $v;
            $this->modifiedColumns[ExportExpensesSummaryTableMap::COL_REQUESTED_DA_HQ_AMOUNT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [requested_da_ex_hq_amount] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setRequestedDaExHqAmount($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->requested_da_ex_hq_amount !== $v) {
            $this->requested_da_ex_hq_amount = $v;
            $this->modifiedColumns[ExportExpensesSummaryTableMap::COL_REQUESTED_DA_EX_HQ_AMOUNT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [requested_da_os_amount] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setRequestedDaOsAmount($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->requested_da_os_amount !== $v) {
            $this->requested_da_os_amount = $v;
            $this->modifiedColumns[ExportExpensesSummaryTableMap::COL_REQUESTED_DA_OS_AMOUNT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [requested_da_transit_amount] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setRequestedAaTransitAmount($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->requested_da_transit_amount !== $v) {
            $this->requested_da_transit_amount = $v;
            $this->modifiedColumns[ExportExpensesSummaryTableMap::COL_REQUESTED_DA_TRANSIT_AMOUNT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [requested_da_last_day_os_amount] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setRequestedDaLastDayOsAmount($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->requested_da_last_day_os_amount !== $v) {
            $this->requested_da_last_day_os_amount = $v;
            $this->modifiedColumns[ExportExpensesSummaryTableMap::COL_REQUESTED_DA_LAST_DAY_OS_AMOUNT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [requested_ta_amount] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setRequestedTaAmount($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->requested_ta_amount !== $v) {
            $this->requested_ta_amount = $v;
            $this->modifiedColumns[ExportExpensesSummaryTableMap::COL_REQUESTED_TA_AMOUNT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [requested_internet_bill_amount] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setRequestedInternetBillAmount($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->requested_internet_bill_amount !== $v) {
            $this->requested_internet_bill_amount = $v;
            $this->modifiedColumns[ExportExpensesSummaryTableMap::COL_REQUESTED_INTERNET_BILL_AMOUNT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [requested_os_petrol_allowance_amount] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setRequestedOsPetrolAllowanceAmount($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->requested_os_petrol_allowance_amount !== $v) {
            $this->requested_os_petrol_allowance_amount = $v;
            $this->modifiedColumns[ExportExpensesSummaryTableMap::COL_REQUESTED_OS_PETROL_ALLOWANCE_AMOUNT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [requested_isbt_amount] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setRequestedIsbtAmount($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->requested_isbt_amount !== $v) {
            $this->requested_isbt_amount = $v;
            $this->modifiedColumns[ExportExpensesSummaryTableMap::COL_REQUESTED_ISBT_AMOUNT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [requested_hill_allowance_amount] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setRequestedHillAllowanceAmount($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->requested_hill_allowance_amount !== $v) {
            $this->requested_hill_allowance_amount = $v;
            $this->modifiedColumns[ExportExpensesSummaryTableMap::COL_REQUESTED_HILL_ALLOWANCE_AMOUNT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [requested_ilp_amount] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setRequestedIlpAmount($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->requested_ilp_amount !== $v) {
            $this->requested_ilp_amount = $v;
            $this->modifiedColumns[ExportExpensesSummaryTableMap::COL_REQUESTED_ILP_AMOUNT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [requested_mr_conveyance_amount] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setRequestedMrConveyanceAmount($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->requested_mr_conveyance_amount !== $v) {
            $this->requested_mr_conveyance_amount = $v;
            $this->modifiedColumns[ExportExpensesSummaryTableMap::COL_REQUESTED_MR_CONVEYANCE_AMOUNT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [requested_am_conveyance_amount] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setRequestedAmConveyanceAmount($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->requested_am_conveyance_amount !== $v) {
            $this->requested_am_conveyance_amount = $v;
            $this->modifiedColumns[ExportExpensesSummaryTableMap::COL_REQUESTED_AM_CONVEYANCE_AMOUNT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [requested_rm_lodging_and_food_amount] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setRequestedRmLodgingAndFoodAmount($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->requested_rm_lodging_and_food_amount !== $v) {
            $this->requested_rm_lodging_and_food_amount = $v;
            $this->modifiedColumns[ExportExpensesSummaryTableMap::COL_REQUESTED_RM_LODGING_AND_FOOD_AMOUNT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [requested_handset_amount] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setRequestedHandsetAmount($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->requested_handset_amount !== $v) {
            $this->requested_handset_amount = $v;
            $this->modifiedColumns[ExportExpensesSummaryTableMap::COL_REQUESTED_HANDSET_AMOUNT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [requested_hq_petrol_allowance_amount] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setRequestedHqPetrolAllowanceAmount($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->requested_hq_petrol_allowance_amount !== $v) {
            $this->requested_hq_petrol_allowance_amount = $v;
            $this->modifiedColumns[ExportExpensesSummaryTableMap::COL_REQUESTED_HQ_PETROL_ALLOWANCE_AMOUNT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [requested_zm_lodging_and_food_amount] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setRequestedZmLodgingAndFoodAmount($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->requested_zm_lodging_and_food_amount !== $v) {
            $this->requested_zm_lodging_and_food_amount = $v;
            $this->modifiedColumns[ExportExpensesSummaryTableMap::COL_REQUESTED_ZM_LODGING_AND_FOOD_AMOUNT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [requested_rm_mobile_bill_amount] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setRequestedRmMobileBillAmount($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->requested_rm_mobile_bill_amount !== $v) {
            $this->requested_rm_mobile_bill_amount = $v;
            $this->modifiedColumns[ExportExpensesSummaryTableMap::COL_REQUESTED_RM_MOBILE_BILL_AMOUNT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [requested_zm_local_conveyance_amount] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setRequestedZmLocalConveyanceAmount($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->requested_zm_local_conveyance_amount !== $v) {
            $this->requested_zm_local_conveyance_amount = $v;
            $this->modifiedColumns[ExportExpensesSummaryTableMap::COL_REQUESTED_ZM_LOCAL_CONVEYANCE_AMOUNT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [requested_rm_local_conveyance_amount] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setRequestedRmLocalConveyanceAmount($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->requested_rm_local_conveyance_amount !== $v) {
            $this->requested_rm_local_conveyance_amount = $v;
            $this->modifiedColumns[ExportExpensesSummaryTableMap::COL_REQUESTED_RM_LOCAL_CONVEYANCE_AMOUNT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [requested_zm_mobile_bill_amount] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setRequestedZmMobileBillAmount($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->requested_zm_mobile_bill_amount !== $v) {
            $this->requested_zm_mobile_bill_amount = $v;
            $this->modifiedColumns[ExportExpensesSummaryTableMap::COL_REQUESTED_ZM_MOBILE_BILL_AMOUNT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [requested_stationery_amount] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setRequestedStationeryAmount($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->requested_stationery_amount !== $v) {
            $this->requested_stationery_amount = $v;
            $this->modifiedColumns[ExportExpensesSummaryTableMap::COL_REQUESTED_STATIONERY_AMOUNT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [requested_event_amount] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setRequestedEventAmount($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->requested_event_amount !== $v) {
            $this->requested_event_amount = $v;
            $this->modifiedColumns[ExportExpensesSummaryTableMap::COL_REQUESTED_EVENT_AMOUNT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [requested_own_stay_amount] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setRequestedOwnStayAmount($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->requested_own_stay_amount !== $v) {
            $this->requested_own_stay_amount = $v;
            $this->modifiedColumns[ExportExpensesSummaryTableMap::COL_REQUESTED_OWN_STAY_AMOUNT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [requested_other_zm_local_conveyance_amount] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setRequestedOtherZmLocalConveyanceAmount($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->requested_other_zm_local_conveyance_amount !== $v) {
            $this->requested_other_zm_local_conveyance_amount = $v;
            $this->modifiedColumns[ExportExpensesSummaryTableMap::COL_REQUESTED_OTHER_ZM_LOCAL_CONVEYANCE_AMOUNT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [requested_other_os_petrol_allowance_amount] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setRequestedOtherOsPetrolAllowanceAmount($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->requested_other_os_petrol_allowance_amount !== $v) {
            $this->requested_other_os_petrol_allowance_amount = $v;
            $this->modifiedColumns[ExportExpensesSummaryTableMap::COL_REQUESTED_OTHER_OS_PETROL_ALLOWANCE_AMOUNT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [requested_other_rm_local_conveyance_amount] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setRequestedOtherRmLocalConveyanceAmount($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->requested_other_rm_local_conveyance_amount !== $v) {
            $this->requested_other_rm_local_conveyance_amount = $v;
            $this->modifiedColumns[ExportExpensesSummaryTableMap::COL_REQUESTED_OTHER_RM_LOCAL_CONVEYANCE_AMOUNT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [final_da_hq_amount] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setFinalDaHqAmount($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->final_da_hq_amount !== $v) {
            $this->final_da_hq_amount = $v;
            $this->modifiedColumns[ExportExpensesSummaryTableMap::COL_FINAL_DA_HQ_AMOUNT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [final_da_ex_hq_amount] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setFinalDaExHqAmount($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->final_da_ex_hq_amount !== $v) {
            $this->final_da_ex_hq_amount = $v;
            $this->modifiedColumns[ExportExpensesSummaryTableMap::COL_FINAL_DA_EX_HQ_AMOUNT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [final_da_os_amount] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setFinalDaOsAmount($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->final_da_os_amount !== $v) {
            $this->final_da_os_amount = $v;
            $this->modifiedColumns[ExportExpensesSummaryTableMap::COL_FINAL_DA_OS_AMOUNT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [final_da_transit_amount] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setFinalDaTransitAmount($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->final_da_transit_amount !== $v) {
            $this->final_da_transit_amount = $v;
            $this->modifiedColumns[ExportExpensesSummaryTableMap::COL_FINAL_DA_TRANSIT_AMOUNT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [final_da_last_day_os_amount] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setFinalDaLastDayOsAmount($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->final_da_last_day_os_amount !== $v) {
            $this->final_da_last_day_os_amount = $v;
            $this->modifiedColumns[ExportExpensesSummaryTableMap::COL_FINAL_DA_LAST_DAY_OS_AMOUNT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [final_ta_amount] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setFinalTaAmount($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->final_ta_amount !== $v) {
            $this->final_ta_amount = $v;
            $this->modifiedColumns[ExportExpensesSummaryTableMap::COL_FINAL_TA_AMOUNT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [final_internet_bill_amount] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setFinalInternetBillAmount($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->final_internet_bill_amount !== $v) {
            $this->final_internet_bill_amount = $v;
            $this->modifiedColumns[ExportExpensesSummaryTableMap::COL_FINAL_INTERNET_BILL_AMOUNT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [final_os_petrol_allowance_amount] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setFinalOsPetrolAllowanceAmount($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->final_os_petrol_allowance_amount !== $v) {
            $this->final_os_petrol_allowance_amount = $v;
            $this->modifiedColumns[ExportExpensesSummaryTableMap::COL_FINAL_OS_PETROL_ALLOWANCE_AMOUNT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [final_isbt_amount] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setFinalIsbtAmount($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->final_isbt_amount !== $v) {
            $this->final_isbt_amount = $v;
            $this->modifiedColumns[ExportExpensesSummaryTableMap::COL_FINAL_ISBT_AMOUNT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [final_hill_allowance_amount] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setFinalHillAllowanceAmount($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->final_hill_allowance_amount !== $v) {
            $this->final_hill_allowance_amount = $v;
            $this->modifiedColumns[ExportExpensesSummaryTableMap::COL_FINAL_HILL_ALLOWANCE_AMOUNT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [final_ilp_amount] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setFinalIlpAmount($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->final_ilp_amount !== $v) {
            $this->final_ilp_amount = $v;
            $this->modifiedColumns[ExportExpensesSummaryTableMap::COL_FINAL_ILP_AMOUNT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [final_mr_conveyance_amount] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setFinalMrConveyanceAmount($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->final_mr_conveyance_amount !== $v) {
            $this->final_mr_conveyance_amount = $v;
            $this->modifiedColumns[ExportExpensesSummaryTableMap::COL_FINAL_MR_CONVEYANCE_AMOUNT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [final_am_conveyance_amount] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setFinalAmConveyanceAmount($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->final_am_conveyance_amount !== $v) {
            $this->final_am_conveyance_amount = $v;
            $this->modifiedColumns[ExportExpensesSummaryTableMap::COL_FINAL_AM_CONVEYANCE_AMOUNT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [final_rm_lodging_and_food_amount] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setFinalRmLodgingAndFoodAmount($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->final_rm_lodging_and_food_amount !== $v) {
            $this->final_rm_lodging_and_food_amount = $v;
            $this->modifiedColumns[ExportExpensesSummaryTableMap::COL_FINAL_RM_LODGING_AND_FOOD_AMOUNT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [final_handset_amount] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setFinalHandsetAmount($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->final_handset_amount !== $v) {
            $this->final_handset_amount = $v;
            $this->modifiedColumns[ExportExpensesSummaryTableMap::COL_FINAL_HANDSET_AMOUNT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [final_hq_petrol_allowance_amount] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setFinalHqPetrolAllowanceAmount($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->final_hq_petrol_allowance_amount !== $v) {
            $this->final_hq_petrol_allowance_amount = $v;
            $this->modifiedColumns[ExportExpensesSummaryTableMap::COL_FINAL_HQ_PETROL_ALLOWANCE_AMOUNT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [final_zm_lodging_and_food_amount] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setFinalZmLodgingAndFoodAmount($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->final_zm_lodging_and_food_amount !== $v) {
            $this->final_zm_lodging_and_food_amount = $v;
            $this->modifiedColumns[ExportExpensesSummaryTableMap::COL_FINAL_ZM_LODGING_AND_FOOD_AMOUNT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [final_rm_mobile_bill_amount] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setFinalRmMobileBillAmount($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->final_rm_mobile_bill_amount !== $v) {
            $this->final_rm_mobile_bill_amount = $v;
            $this->modifiedColumns[ExportExpensesSummaryTableMap::COL_FINAL_RM_MOBILE_BILL_AMOUNT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [final_zm_local_conveyance_amount] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setFinalZmLocalConveyanceAmount($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->final_zm_local_conveyance_amount !== $v) {
            $this->final_zm_local_conveyance_amount = $v;
            $this->modifiedColumns[ExportExpensesSummaryTableMap::COL_FINAL_ZM_LOCAL_CONVEYANCE_AMOUNT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [final_rm_local_conveyance_amount] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setFinalRmLocalConveyanceAmount($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->final_rm_local_conveyance_amount !== $v) {
            $this->final_rm_local_conveyance_amount = $v;
            $this->modifiedColumns[ExportExpensesSummaryTableMap::COL_FINAL_RM_LOCAL_CONVEYANCE_AMOUNT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [final_zm_mobile_bill_amount] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setFinalZmMobileBillAmount($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->final_zm_mobile_bill_amount !== $v) {
            $this->final_zm_mobile_bill_amount = $v;
            $this->modifiedColumns[ExportExpensesSummaryTableMap::COL_FINAL_ZM_MOBILE_BILL_AMOUNT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [final_stationery_amount] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setFinalStationeryAmount($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->final_stationery_amount !== $v) {
            $this->final_stationery_amount = $v;
            $this->modifiedColumns[ExportExpensesSummaryTableMap::COL_FINAL_STATIONERY_AMOUNT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [final_event_amount] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setFinalEventAmount($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->final_event_amount !== $v) {
            $this->final_event_amount = $v;
            $this->modifiedColumns[ExportExpensesSummaryTableMap::COL_FINAL_EVENT_AMOUNT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [final_own_stay_amount] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setFinal_own_stay_amount($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->final_own_stay_amount !== $v) {
            $this->final_own_stay_amount = $v;
            $this->modifiedColumns[ExportExpensesSummaryTableMap::COL_FINAL_OWN_STAY_AMOUNT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [final_other_zm_local_conveyance_amount] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setFinalOtherZmLocalConveyanceAmount($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->final_other_zm_local_conveyance_amount !== $v) {
            $this->final_other_zm_local_conveyance_amount = $v;
            $this->modifiedColumns[ExportExpensesSummaryTableMap::COL_FINAL_OTHER_ZM_LOCAL_CONVEYANCE_AMOUNT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [final_other_os_petrol_allowance_amount] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setFinalOtherOsPetrolAllowanceAmount($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->final_other_os_petrol_allowance_amount !== $v) {
            $this->final_other_os_petrol_allowance_amount = $v;
            $this->modifiedColumns[ExportExpensesSummaryTableMap::COL_FINAL_OTHER_OS_PETROL_ALLOWANCE_AMOUNT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [final_other_rm_local_conveyance_amount] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setFinalOtherRmLocalConveyanceAmount($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->final_other_rm_local_conveyance_amount !== $v) {
            $this->final_other_rm_local_conveyance_amount = $v;
            $this->modifiedColumns[ExportExpensesSummaryTableMap::COL_FINAL_OTHER_RM_LOCAL_CONVEYANCE_AMOUNT] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : ExportExpensesSummaryTableMap::translateFieldName('Uniqueid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->uniqueid = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : ExportExpensesSummaryTableMap::translateFieldName('EmployeeId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->employee_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : ExportExpensesSummaryTableMap::translateFieldName('PositionId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->position_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : ExportExpensesSummaryTableMap::translateFieldName('Orgunitid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->orgunitid = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : ExportExpensesSummaryTableMap::translateFieldName('BuName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->bu_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : ExportExpensesSummaryTableMap::translateFieldName('EmpPositionCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->emp_position_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : ExportExpensesSummaryTableMap::translateFieldName('EmpPositionName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->emp_position_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : ExportExpensesSummaryTableMap::translateFieldName('EmpLevel', TableMap::TYPE_PHPNAME, $indexType)];
            $this->emp_level = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : ExportExpensesSummaryTableMap::translateFieldName('EmployeeCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->employee_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : ExportExpensesSummaryTableMap::translateFieldName('EmployeeName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->employee_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : ExportExpensesSummaryTableMap::translateFieldName('ReportingToEmployeeName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->reporting_to_employee_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : ExportExpensesSummaryTableMap::translateFieldName('ReportingToEmployeeCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->reporting_to_employee_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : ExportExpensesSummaryTableMap::translateFieldName('EmpTown', TableMap::TYPE_PHPNAME, $indexType)];
            $this->emp_town = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : ExportExpensesSummaryTableMap::translateFieldName('EmpBranch', TableMap::TYPE_PHPNAME, $indexType)];
            $this->emp_branch = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : ExportExpensesSummaryTableMap::translateFieldName('Designation', TableMap::TYPE_PHPNAME, $indexType)];
            $this->designation = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : ExportExpensesSummaryTableMap::translateFieldName('Grade', TableMap::TYPE_PHPNAME, $indexType)];
            $this->grade = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : ExportExpensesSummaryTableMap::translateFieldName('Status', TableMap::TYPE_PHPNAME, $indexType)];
            $this->status = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : ExportExpensesSummaryTableMap::translateFieldName('Month', TableMap::TYPE_PHPNAME, $indexType)];
            $this->month = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 18 + $startcol : ExportExpensesSummaryTableMap::translateFieldName('RequestedAmount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->requested_amount = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 19 + $startcol : ExportExpensesSummaryTableMap::translateFieldName('ApprovedAmount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->approved_amount = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 20 + $startcol : ExportExpensesSummaryTableMap::translateFieldName('FinalAmount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->final_amount = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 21 + $startcol : ExportExpensesSummaryTableMap::translateFieldName('ExpenseStatus', TableMap::TYPE_PHPNAME, $indexType)];
            $this->expense_status = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 22 + $startcol : ExportExpensesSummaryTableMap::translateFieldName('TotalExpenses', TableMap::TYPE_PHPNAME, $indexType)];
            $this->total_expenses = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 23 + $startcol : ExportExpensesSummaryTableMap::translateFieldName('ExpenseDates', TableMap::TYPE_PHPNAME, $indexType)];
            $this->expense_dates = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 24 + $startcol : ExportExpensesSummaryTableMap::translateFieldName('RequestedDaHqAmount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->requested_da_hq_amount = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 25 + $startcol : ExportExpensesSummaryTableMap::translateFieldName('RequestedDaExHqAmount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->requested_da_ex_hq_amount = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 26 + $startcol : ExportExpensesSummaryTableMap::translateFieldName('RequestedDaOsAmount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->requested_da_os_amount = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 27 + $startcol : ExportExpensesSummaryTableMap::translateFieldName('RequestedAaTransitAmount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->requested_da_transit_amount = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 28 + $startcol : ExportExpensesSummaryTableMap::translateFieldName('RequestedDaLastDayOsAmount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->requested_da_last_day_os_amount = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 29 + $startcol : ExportExpensesSummaryTableMap::translateFieldName('RequestedTaAmount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->requested_ta_amount = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 30 + $startcol : ExportExpensesSummaryTableMap::translateFieldName('RequestedInternetBillAmount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->requested_internet_bill_amount = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 31 + $startcol : ExportExpensesSummaryTableMap::translateFieldName('RequestedOsPetrolAllowanceAmount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->requested_os_petrol_allowance_amount = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 32 + $startcol : ExportExpensesSummaryTableMap::translateFieldName('RequestedIsbtAmount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->requested_isbt_amount = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 33 + $startcol : ExportExpensesSummaryTableMap::translateFieldName('RequestedHillAllowanceAmount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->requested_hill_allowance_amount = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 34 + $startcol : ExportExpensesSummaryTableMap::translateFieldName('RequestedIlpAmount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->requested_ilp_amount = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 35 + $startcol : ExportExpensesSummaryTableMap::translateFieldName('RequestedMrConveyanceAmount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->requested_mr_conveyance_amount = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 36 + $startcol : ExportExpensesSummaryTableMap::translateFieldName('RequestedAmConveyanceAmount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->requested_am_conveyance_amount = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 37 + $startcol : ExportExpensesSummaryTableMap::translateFieldName('RequestedRmLodgingAndFoodAmount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->requested_rm_lodging_and_food_amount = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 38 + $startcol : ExportExpensesSummaryTableMap::translateFieldName('RequestedHandsetAmount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->requested_handset_amount = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 39 + $startcol : ExportExpensesSummaryTableMap::translateFieldName('RequestedHqPetrolAllowanceAmount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->requested_hq_petrol_allowance_amount = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 40 + $startcol : ExportExpensesSummaryTableMap::translateFieldName('RequestedZmLodgingAndFoodAmount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->requested_zm_lodging_and_food_amount = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 41 + $startcol : ExportExpensesSummaryTableMap::translateFieldName('RequestedRmMobileBillAmount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->requested_rm_mobile_bill_amount = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 42 + $startcol : ExportExpensesSummaryTableMap::translateFieldName('RequestedZmLocalConveyanceAmount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->requested_zm_local_conveyance_amount = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 43 + $startcol : ExportExpensesSummaryTableMap::translateFieldName('RequestedRmLocalConveyanceAmount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->requested_rm_local_conveyance_amount = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 44 + $startcol : ExportExpensesSummaryTableMap::translateFieldName('RequestedZmMobileBillAmount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->requested_zm_mobile_bill_amount = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 45 + $startcol : ExportExpensesSummaryTableMap::translateFieldName('RequestedStationeryAmount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->requested_stationery_amount = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 46 + $startcol : ExportExpensesSummaryTableMap::translateFieldName('RequestedEventAmount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->requested_event_amount = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 47 + $startcol : ExportExpensesSummaryTableMap::translateFieldName('RequestedOwnStayAmount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->requested_own_stay_amount = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 48 + $startcol : ExportExpensesSummaryTableMap::translateFieldName('RequestedOtherZmLocalConveyanceAmount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->requested_other_zm_local_conveyance_amount = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 49 + $startcol : ExportExpensesSummaryTableMap::translateFieldName('RequestedOtherOsPetrolAllowanceAmount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->requested_other_os_petrol_allowance_amount = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 50 + $startcol : ExportExpensesSummaryTableMap::translateFieldName('RequestedOtherRmLocalConveyanceAmount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->requested_other_rm_local_conveyance_amount = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 51 + $startcol : ExportExpensesSummaryTableMap::translateFieldName('FinalDaHqAmount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->final_da_hq_amount = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 52 + $startcol : ExportExpensesSummaryTableMap::translateFieldName('FinalDaExHqAmount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->final_da_ex_hq_amount = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 53 + $startcol : ExportExpensesSummaryTableMap::translateFieldName('FinalDaOsAmount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->final_da_os_amount = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 54 + $startcol : ExportExpensesSummaryTableMap::translateFieldName('FinalDaTransitAmount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->final_da_transit_amount = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 55 + $startcol : ExportExpensesSummaryTableMap::translateFieldName('FinalDaLastDayOsAmount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->final_da_last_day_os_amount = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 56 + $startcol : ExportExpensesSummaryTableMap::translateFieldName('FinalTaAmount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->final_ta_amount = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 57 + $startcol : ExportExpensesSummaryTableMap::translateFieldName('FinalInternetBillAmount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->final_internet_bill_amount = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 58 + $startcol : ExportExpensesSummaryTableMap::translateFieldName('FinalOsPetrolAllowanceAmount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->final_os_petrol_allowance_amount = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 59 + $startcol : ExportExpensesSummaryTableMap::translateFieldName('FinalIsbtAmount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->final_isbt_amount = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 60 + $startcol : ExportExpensesSummaryTableMap::translateFieldName('FinalHillAllowanceAmount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->final_hill_allowance_amount = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 61 + $startcol : ExportExpensesSummaryTableMap::translateFieldName('FinalIlpAmount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->final_ilp_amount = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 62 + $startcol : ExportExpensesSummaryTableMap::translateFieldName('FinalMrConveyanceAmount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->final_mr_conveyance_amount = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 63 + $startcol : ExportExpensesSummaryTableMap::translateFieldName('FinalAmConveyanceAmount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->final_am_conveyance_amount = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 64 + $startcol : ExportExpensesSummaryTableMap::translateFieldName('FinalRmLodgingAndFoodAmount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->final_rm_lodging_and_food_amount = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 65 + $startcol : ExportExpensesSummaryTableMap::translateFieldName('FinalHandsetAmount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->final_handset_amount = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 66 + $startcol : ExportExpensesSummaryTableMap::translateFieldName('FinalHqPetrolAllowanceAmount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->final_hq_petrol_allowance_amount = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 67 + $startcol : ExportExpensesSummaryTableMap::translateFieldName('FinalZmLodgingAndFoodAmount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->final_zm_lodging_and_food_amount = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 68 + $startcol : ExportExpensesSummaryTableMap::translateFieldName('FinalRmMobileBillAmount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->final_rm_mobile_bill_amount = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 69 + $startcol : ExportExpensesSummaryTableMap::translateFieldName('FinalZmLocalConveyanceAmount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->final_zm_local_conveyance_amount = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 70 + $startcol : ExportExpensesSummaryTableMap::translateFieldName('FinalRmLocalConveyanceAmount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->final_rm_local_conveyance_amount = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 71 + $startcol : ExportExpensesSummaryTableMap::translateFieldName('FinalZmMobileBillAmount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->final_zm_mobile_bill_amount = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 72 + $startcol : ExportExpensesSummaryTableMap::translateFieldName('FinalStationeryAmount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->final_stationery_amount = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 73 + $startcol : ExportExpensesSummaryTableMap::translateFieldName('FinalEventAmount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->final_event_amount = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 74 + $startcol : ExportExpensesSummaryTableMap::translateFieldName('Final_own_stay_amount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->final_own_stay_amount = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 75 + $startcol : ExportExpensesSummaryTableMap::translateFieldName('FinalOtherZmLocalConveyanceAmount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->final_other_zm_local_conveyance_amount = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 76 + $startcol : ExportExpensesSummaryTableMap::translateFieldName('FinalOtherOsPetrolAllowanceAmount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->final_other_os_petrol_allowance_amount = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 77 + $startcol : ExportExpensesSummaryTableMap::translateFieldName('FinalOtherRmLocalConveyanceAmount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->final_other_rm_local_conveyance_amount = (null !== $col) ? (string) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 78; // 78 = ExportExpensesSummaryTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\entities\\ExportExpensesSummary'), 0, $e);
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
        $pos = ExportExpensesSummaryTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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

            case 24:
                return $this->getRequestedDaHqAmount();

            case 25:
                return $this->getRequestedDaExHqAmount();

            case 26:
                return $this->getRequestedDaOsAmount();

            case 27:
                return $this->getRequestedAaTransitAmount();

            case 28:
                return $this->getRequestedDaLastDayOsAmount();

            case 29:
                return $this->getRequestedTaAmount();

            case 30:
                return $this->getRequestedInternetBillAmount();

            case 31:
                return $this->getRequestedOsPetrolAllowanceAmount();

            case 32:
                return $this->getRequestedIsbtAmount();

            case 33:
                return $this->getRequestedHillAllowanceAmount();

            case 34:
                return $this->getRequestedIlpAmount();

            case 35:
                return $this->getRequestedMrConveyanceAmount();

            case 36:
                return $this->getRequestedAmConveyanceAmount();

            case 37:
                return $this->getRequestedRmLodgingAndFoodAmount();

            case 38:
                return $this->getRequestedHandsetAmount();

            case 39:
                return $this->getRequestedHqPetrolAllowanceAmount();

            case 40:
                return $this->getRequestedZmLodgingAndFoodAmount();

            case 41:
                return $this->getRequestedRmMobileBillAmount();

            case 42:
                return $this->getRequestedZmLocalConveyanceAmount();

            case 43:
                return $this->getRequestedRmLocalConveyanceAmount();

            case 44:
                return $this->getRequestedZmMobileBillAmount();

            case 45:
                return $this->getRequestedStationeryAmount();

            case 46:
                return $this->getRequestedEventAmount();

            case 47:
                return $this->getRequestedOwnStayAmount();

            case 48:
                return $this->getRequestedOtherZmLocalConveyanceAmount();

            case 49:
                return $this->getRequestedOtherOsPetrolAllowanceAmount();

            case 50:
                return $this->getRequestedOtherRmLocalConveyanceAmount();

            case 51:
                return $this->getFinalDaHqAmount();

            case 52:
                return $this->getFinalDaExHqAmount();

            case 53:
                return $this->getFinalDaOsAmount();

            case 54:
                return $this->getFinalDaTransitAmount();

            case 55:
                return $this->getFinalDaLastDayOsAmount();

            case 56:
                return $this->getFinalTaAmount();

            case 57:
                return $this->getFinalInternetBillAmount();

            case 58:
                return $this->getFinalOsPetrolAllowanceAmount();

            case 59:
                return $this->getFinalIsbtAmount();

            case 60:
                return $this->getFinalHillAllowanceAmount();

            case 61:
                return $this->getFinalIlpAmount();

            case 62:
                return $this->getFinalMrConveyanceAmount();

            case 63:
                return $this->getFinalAmConveyanceAmount();

            case 64:
                return $this->getFinalRmLodgingAndFoodAmount();

            case 65:
                return $this->getFinalHandsetAmount();

            case 66:
                return $this->getFinalHqPetrolAllowanceAmount();

            case 67:
                return $this->getFinalZmLodgingAndFoodAmount();

            case 68:
                return $this->getFinalRmMobileBillAmount();

            case 69:
                return $this->getFinalZmLocalConveyanceAmount();

            case 70:
                return $this->getFinalRmLocalConveyanceAmount();

            case 71:
                return $this->getFinalZmMobileBillAmount();

            case 72:
                return $this->getFinalStationeryAmount();

            case 73:
                return $this->getFinalEventAmount();

            case 74:
                return $this->getFinal_own_stay_amount();

            case 75:
                return $this->getFinalOtherZmLocalConveyanceAmount();

            case 76:
                return $this->getFinalOtherOsPetrolAllowanceAmount();

            case 77:
                return $this->getFinalOtherRmLocalConveyanceAmount();

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
        if (isset($alreadyDumpedObjects['ExportExpensesSummary'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['ExportExpensesSummary'][$this->hashCode()] = true;
        $keys = ExportExpensesSummaryTableMap::getFieldNames($keyType);
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
            $keys[24] => $this->getRequestedDaHqAmount(),
            $keys[25] => $this->getRequestedDaExHqAmount(),
            $keys[26] => $this->getRequestedDaOsAmount(),
            $keys[27] => $this->getRequestedAaTransitAmount(),
            $keys[28] => $this->getRequestedDaLastDayOsAmount(),
            $keys[29] => $this->getRequestedTaAmount(),
            $keys[30] => $this->getRequestedInternetBillAmount(),
            $keys[31] => $this->getRequestedOsPetrolAllowanceAmount(),
            $keys[32] => $this->getRequestedIsbtAmount(),
            $keys[33] => $this->getRequestedHillAllowanceAmount(),
            $keys[34] => $this->getRequestedIlpAmount(),
            $keys[35] => $this->getRequestedMrConveyanceAmount(),
            $keys[36] => $this->getRequestedAmConveyanceAmount(),
            $keys[37] => $this->getRequestedRmLodgingAndFoodAmount(),
            $keys[38] => $this->getRequestedHandsetAmount(),
            $keys[39] => $this->getRequestedHqPetrolAllowanceAmount(),
            $keys[40] => $this->getRequestedZmLodgingAndFoodAmount(),
            $keys[41] => $this->getRequestedRmMobileBillAmount(),
            $keys[42] => $this->getRequestedZmLocalConveyanceAmount(),
            $keys[43] => $this->getRequestedRmLocalConveyanceAmount(),
            $keys[44] => $this->getRequestedZmMobileBillAmount(),
            $keys[45] => $this->getRequestedStationeryAmount(),
            $keys[46] => $this->getRequestedEventAmount(),
            $keys[47] => $this->getRequestedOwnStayAmount(),
            $keys[48] => $this->getRequestedOtherZmLocalConveyanceAmount(),
            $keys[49] => $this->getRequestedOtherOsPetrolAllowanceAmount(),
            $keys[50] => $this->getRequestedOtherRmLocalConveyanceAmount(),
            $keys[51] => $this->getFinalDaHqAmount(),
            $keys[52] => $this->getFinalDaExHqAmount(),
            $keys[53] => $this->getFinalDaOsAmount(),
            $keys[54] => $this->getFinalDaTransitAmount(),
            $keys[55] => $this->getFinalDaLastDayOsAmount(),
            $keys[56] => $this->getFinalTaAmount(),
            $keys[57] => $this->getFinalInternetBillAmount(),
            $keys[58] => $this->getFinalOsPetrolAllowanceAmount(),
            $keys[59] => $this->getFinalIsbtAmount(),
            $keys[60] => $this->getFinalHillAllowanceAmount(),
            $keys[61] => $this->getFinalIlpAmount(),
            $keys[62] => $this->getFinalMrConveyanceAmount(),
            $keys[63] => $this->getFinalAmConveyanceAmount(),
            $keys[64] => $this->getFinalRmLodgingAndFoodAmount(),
            $keys[65] => $this->getFinalHandsetAmount(),
            $keys[66] => $this->getFinalHqPetrolAllowanceAmount(),
            $keys[67] => $this->getFinalZmLodgingAndFoodAmount(),
            $keys[68] => $this->getFinalRmMobileBillAmount(),
            $keys[69] => $this->getFinalZmLocalConveyanceAmount(),
            $keys[70] => $this->getFinalRmLocalConveyanceAmount(),
            $keys[71] => $this->getFinalZmMobileBillAmount(),
            $keys[72] => $this->getFinalStationeryAmount(),
            $keys[73] => $this->getFinalEventAmount(),
            $keys[74] => $this->getFinal_own_stay_amount(),
            $keys[75] => $this->getFinalOtherZmLocalConveyanceAmount(),
            $keys[76] => $this->getFinalOtherOsPetrolAllowanceAmount(),
            $keys[77] => $this->getFinalOtherRmLocalConveyanceAmount(),
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
        $criteria = new Criteria(ExportExpensesSummaryTableMap::DATABASE_NAME);

        if ($this->isColumnModified(ExportExpensesSummaryTableMap::COL_UNIQUEID)) {
            $criteria->add(ExportExpensesSummaryTableMap::COL_UNIQUEID, $this->uniqueid);
        }
        if ($this->isColumnModified(ExportExpensesSummaryTableMap::COL_EMPLOYEE_ID)) {
            $criteria->add(ExportExpensesSummaryTableMap::COL_EMPLOYEE_ID, $this->employee_id);
        }
        if ($this->isColumnModified(ExportExpensesSummaryTableMap::COL_POSITION_ID)) {
            $criteria->add(ExportExpensesSummaryTableMap::COL_POSITION_ID, $this->position_id);
        }
        if ($this->isColumnModified(ExportExpensesSummaryTableMap::COL_ORGUNITID)) {
            $criteria->add(ExportExpensesSummaryTableMap::COL_ORGUNITID, $this->orgunitid);
        }
        if ($this->isColumnModified(ExportExpensesSummaryTableMap::COL_BU_NAME)) {
            $criteria->add(ExportExpensesSummaryTableMap::COL_BU_NAME, $this->bu_name);
        }
        if ($this->isColumnModified(ExportExpensesSummaryTableMap::COL_EMP_POSITION_CODE)) {
            $criteria->add(ExportExpensesSummaryTableMap::COL_EMP_POSITION_CODE, $this->emp_position_code);
        }
        if ($this->isColumnModified(ExportExpensesSummaryTableMap::COL_EMP_POSITION_NAME)) {
            $criteria->add(ExportExpensesSummaryTableMap::COL_EMP_POSITION_NAME, $this->emp_position_name);
        }
        if ($this->isColumnModified(ExportExpensesSummaryTableMap::COL_EMP_LEVEL)) {
            $criteria->add(ExportExpensesSummaryTableMap::COL_EMP_LEVEL, $this->emp_level);
        }
        if ($this->isColumnModified(ExportExpensesSummaryTableMap::COL_EMPLOYEE_CODE)) {
            $criteria->add(ExportExpensesSummaryTableMap::COL_EMPLOYEE_CODE, $this->employee_code);
        }
        if ($this->isColumnModified(ExportExpensesSummaryTableMap::COL_EMPLOYEE_NAME)) {
            $criteria->add(ExportExpensesSummaryTableMap::COL_EMPLOYEE_NAME, $this->employee_name);
        }
        if ($this->isColumnModified(ExportExpensesSummaryTableMap::COL_REPORTING_TO_EMPLOYEE_NAME)) {
            $criteria->add(ExportExpensesSummaryTableMap::COL_REPORTING_TO_EMPLOYEE_NAME, $this->reporting_to_employee_name);
        }
        if ($this->isColumnModified(ExportExpensesSummaryTableMap::COL_REPORTING_TO_EMPLOYEE_CODE)) {
            $criteria->add(ExportExpensesSummaryTableMap::COL_REPORTING_TO_EMPLOYEE_CODE, $this->reporting_to_employee_code);
        }
        if ($this->isColumnModified(ExportExpensesSummaryTableMap::COL_EMP_TOWN)) {
            $criteria->add(ExportExpensesSummaryTableMap::COL_EMP_TOWN, $this->emp_town);
        }
        if ($this->isColumnModified(ExportExpensesSummaryTableMap::COL_EMP_BRANCH)) {
            $criteria->add(ExportExpensesSummaryTableMap::COL_EMP_BRANCH, $this->emp_branch);
        }
        if ($this->isColumnModified(ExportExpensesSummaryTableMap::COL_DESIGNATION)) {
            $criteria->add(ExportExpensesSummaryTableMap::COL_DESIGNATION, $this->designation);
        }
        if ($this->isColumnModified(ExportExpensesSummaryTableMap::COL_GRADE)) {
            $criteria->add(ExportExpensesSummaryTableMap::COL_GRADE, $this->grade);
        }
        if ($this->isColumnModified(ExportExpensesSummaryTableMap::COL_STATUS)) {
            $criteria->add(ExportExpensesSummaryTableMap::COL_STATUS, $this->status);
        }
        if ($this->isColumnModified(ExportExpensesSummaryTableMap::COL_MONTH)) {
            $criteria->add(ExportExpensesSummaryTableMap::COL_MONTH, $this->month);
        }
        if ($this->isColumnModified(ExportExpensesSummaryTableMap::COL_REQUESTED_AMOUNT)) {
            $criteria->add(ExportExpensesSummaryTableMap::COL_REQUESTED_AMOUNT, $this->requested_amount);
        }
        if ($this->isColumnModified(ExportExpensesSummaryTableMap::COL_APPROVED_AMOUNT)) {
            $criteria->add(ExportExpensesSummaryTableMap::COL_APPROVED_AMOUNT, $this->approved_amount);
        }
        if ($this->isColumnModified(ExportExpensesSummaryTableMap::COL_FINAL_AMOUNT)) {
            $criteria->add(ExportExpensesSummaryTableMap::COL_FINAL_AMOUNT, $this->final_amount);
        }
        if ($this->isColumnModified(ExportExpensesSummaryTableMap::COL_EXPENSE_STATUS)) {
            $criteria->add(ExportExpensesSummaryTableMap::COL_EXPENSE_STATUS, $this->expense_status);
        }
        if ($this->isColumnModified(ExportExpensesSummaryTableMap::COL_TOTAL_EXPENSES)) {
            $criteria->add(ExportExpensesSummaryTableMap::COL_TOTAL_EXPENSES, $this->total_expenses);
        }
        if ($this->isColumnModified(ExportExpensesSummaryTableMap::COL_EXPENSE_DATES)) {
            $criteria->add(ExportExpensesSummaryTableMap::COL_EXPENSE_DATES, $this->expense_dates);
        }
        if ($this->isColumnModified(ExportExpensesSummaryTableMap::COL_REQUESTED_DA_HQ_AMOUNT)) {
            $criteria->add(ExportExpensesSummaryTableMap::COL_REQUESTED_DA_HQ_AMOUNT, $this->requested_da_hq_amount);
        }
        if ($this->isColumnModified(ExportExpensesSummaryTableMap::COL_REQUESTED_DA_EX_HQ_AMOUNT)) {
            $criteria->add(ExportExpensesSummaryTableMap::COL_REQUESTED_DA_EX_HQ_AMOUNT, $this->requested_da_ex_hq_amount);
        }
        if ($this->isColumnModified(ExportExpensesSummaryTableMap::COL_REQUESTED_DA_OS_AMOUNT)) {
            $criteria->add(ExportExpensesSummaryTableMap::COL_REQUESTED_DA_OS_AMOUNT, $this->requested_da_os_amount);
        }
        if ($this->isColumnModified(ExportExpensesSummaryTableMap::COL_REQUESTED_DA_TRANSIT_AMOUNT)) {
            $criteria->add(ExportExpensesSummaryTableMap::COL_REQUESTED_DA_TRANSIT_AMOUNT, $this->requested_da_transit_amount);
        }
        if ($this->isColumnModified(ExportExpensesSummaryTableMap::COL_REQUESTED_DA_LAST_DAY_OS_AMOUNT)) {
            $criteria->add(ExportExpensesSummaryTableMap::COL_REQUESTED_DA_LAST_DAY_OS_AMOUNT, $this->requested_da_last_day_os_amount);
        }
        if ($this->isColumnModified(ExportExpensesSummaryTableMap::COL_REQUESTED_TA_AMOUNT)) {
            $criteria->add(ExportExpensesSummaryTableMap::COL_REQUESTED_TA_AMOUNT, $this->requested_ta_amount);
        }
        if ($this->isColumnModified(ExportExpensesSummaryTableMap::COL_REQUESTED_INTERNET_BILL_AMOUNT)) {
            $criteria->add(ExportExpensesSummaryTableMap::COL_REQUESTED_INTERNET_BILL_AMOUNT, $this->requested_internet_bill_amount);
        }
        if ($this->isColumnModified(ExportExpensesSummaryTableMap::COL_REQUESTED_OS_PETROL_ALLOWANCE_AMOUNT)) {
            $criteria->add(ExportExpensesSummaryTableMap::COL_REQUESTED_OS_PETROL_ALLOWANCE_AMOUNT, $this->requested_os_petrol_allowance_amount);
        }
        if ($this->isColumnModified(ExportExpensesSummaryTableMap::COL_REQUESTED_ISBT_AMOUNT)) {
            $criteria->add(ExportExpensesSummaryTableMap::COL_REQUESTED_ISBT_AMOUNT, $this->requested_isbt_amount);
        }
        if ($this->isColumnModified(ExportExpensesSummaryTableMap::COL_REQUESTED_HILL_ALLOWANCE_AMOUNT)) {
            $criteria->add(ExportExpensesSummaryTableMap::COL_REQUESTED_HILL_ALLOWANCE_AMOUNT, $this->requested_hill_allowance_amount);
        }
        if ($this->isColumnModified(ExportExpensesSummaryTableMap::COL_REQUESTED_ILP_AMOUNT)) {
            $criteria->add(ExportExpensesSummaryTableMap::COL_REQUESTED_ILP_AMOUNT, $this->requested_ilp_amount);
        }
        if ($this->isColumnModified(ExportExpensesSummaryTableMap::COL_REQUESTED_MR_CONVEYANCE_AMOUNT)) {
            $criteria->add(ExportExpensesSummaryTableMap::COL_REQUESTED_MR_CONVEYANCE_AMOUNT, $this->requested_mr_conveyance_amount);
        }
        if ($this->isColumnModified(ExportExpensesSummaryTableMap::COL_REQUESTED_AM_CONVEYANCE_AMOUNT)) {
            $criteria->add(ExportExpensesSummaryTableMap::COL_REQUESTED_AM_CONVEYANCE_AMOUNT, $this->requested_am_conveyance_amount);
        }
        if ($this->isColumnModified(ExportExpensesSummaryTableMap::COL_REQUESTED_RM_LODGING_AND_FOOD_AMOUNT)) {
            $criteria->add(ExportExpensesSummaryTableMap::COL_REQUESTED_RM_LODGING_AND_FOOD_AMOUNT, $this->requested_rm_lodging_and_food_amount);
        }
        if ($this->isColumnModified(ExportExpensesSummaryTableMap::COL_REQUESTED_HANDSET_AMOUNT)) {
            $criteria->add(ExportExpensesSummaryTableMap::COL_REQUESTED_HANDSET_AMOUNT, $this->requested_handset_amount);
        }
        if ($this->isColumnModified(ExportExpensesSummaryTableMap::COL_REQUESTED_HQ_PETROL_ALLOWANCE_AMOUNT)) {
            $criteria->add(ExportExpensesSummaryTableMap::COL_REQUESTED_HQ_PETROL_ALLOWANCE_AMOUNT, $this->requested_hq_petrol_allowance_amount);
        }
        if ($this->isColumnModified(ExportExpensesSummaryTableMap::COL_REQUESTED_ZM_LODGING_AND_FOOD_AMOUNT)) {
            $criteria->add(ExportExpensesSummaryTableMap::COL_REQUESTED_ZM_LODGING_AND_FOOD_AMOUNT, $this->requested_zm_lodging_and_food_amount);
        }
        if ($this->isColumnModified(ExportExpensesSummaryTableMap::COL_REQUESTED_RM_MOBILE_BILL_AMOUNT)) {
            $criteria->add(ExportExpensesSummaryTableMap::COL_REQUESTED_RM_MOBILE_BILL_AMOUNT, $this->requested_rm_mobile_bill_amount);
        }
        if ($this->isColumnModified(ExportExpensesSummaryTableMap::COL_REQUESTED_ZM_LOCAL_CONVEYANCE_AMOUNT)) {
            $criteria->add(ExportExpensesSummaryTableMap::COL_REQUESTED_ZM_LOCAL_CONVEYANCE_AMOUNT, $this->requested_zm_local_conveyance_amount);
        }
        if ($this->isColumnModified(ExportExpensesSummaryTableMap::COL_REQUESTED_RM_LOCAL_CONVEYANCE_AMOUNT)) {
            $criteria->add(ExportExpensesSummaryTableMap::COL_REQUESTED_RM_LOCAL_CONVEYANCE_AMOUNT, $this->requested_rm_local_conveyance_amount);
        }
        if ($this->isColumnModified(ExportExpensesSummaryTableMap::COL_REQUESTED_ZM_MOBILE_BILL_AMOUNT)) {
            $criteria->add(ExportExpensesSummaryTableMap::COL_REQUESTED_ZM_MOBILE_BILL_AMOUNT, $this->requested_zm_mobile_bill_amount);
        }
        if ($this->isColumnModified(ExportExpensesSummaryTableMap::COL_REQUESTED_STATIONERY_AMOUNT)) {
            $criteria->add(ExportExpensesSummaryTableMap::COL_REQUESTED_STATIONERY_AMOUNT, $this->requested_stationery_amount);
        }
        if ($this->isColumnModified(ExportExpensesSummaryTableMap::COL_REQUESTED_EVENT_AMOUNT)) {
            $criteria->add(ExportExpensesSummaryTableMap::COL_REQUESTED_EVENT_AMOUNT, $this->requested_event_amount);
        }
        if ($this->isColumnModified(ExportExpensesSummaryTableMap::COL_REQUESTED_OWN_STAY_AMOUNT)) {
            $criteria->add(ExportExpensesSummaryTableMap::COL_REQUESTED_OWN_STAY_AMOUNT, $this->requested_own_stay_amount);
        }
        if ($this->isColumnModified(ExportExpensesSummaryTableMap::COL_REQUESTED_OTHER_ZM_LOCAL_CONVEYANCE_AMOUNT)) {
            $criteria->add(ExportExpensesSummaryTableMap::COL_REQUESTED_OTHER_ZM_LOCAL_CONVEYANCE_AMOUNT, $this->requested_other_zm_local_conveyance_amount);
        }
        if ($this->isColumnModified(ExportExpensesSummaryTableMap::COL_REQUESTED_OTHER_OS_PETROL_ALLOWANCE_AMOUNT)) {
            $criteria->add(ExportExpensesSummaryTableMap::COL_REQUESTED_OTHER_OS_PETROL_ALLOWANCE_AMOUNT, $this->requested_other_os_petrol_allowance_amount);
        }
        if ($this->isColumnModified(ExportExpensesSummaryTableMap::COL_REQUESTED_OTHER_RM_LOCAL_CONVEYANCE_AMOUNT)) {
            $criteria->add(ExportExpensesSummaryTableMap::COL_REQUESTED_OTHER_RM_LOCAL_CONVEYANCE_AMOUNT, $this->requested_other_rm_local_conveyance_amount);
        }
        if ($this->isColumnModified(ExportExpensesSummaryTableMap::COL_FINAL_DA_HQ_AMOUNT)) {
            $criteria->add(ExportExpensesSummaryTableMap::COL_FINAL_DA_HQ_AMOUNT, $this->final_da_hq_amount);
        }
        if ($this->isColumnModified(ExportExpensesSummaryTableMap::COL_FINAL_DA_EX_HQ_AMOUNT)) {
            $criteria->add(ExportExpensesSummaryTableMap::COL_FINAL_DA_EX_HQ_AMOUNT, $this->final_da_ex_hq_amount);
        }
        if ($this->isColumnModified(ExportExpensesSummaryTableMap::COL_FINAL_DA_OS_AMOUNT)) {
            $criteria->add(ExportExpensesSummaryTableMap::COL_FINAL_DA_OS_AMOUNT, $this->final_da_os_amount);
        }
        if ($this->isColumnModified(ExportExpensesSummaryTableMap::COL_FINAL_DA_TRANSIT_AMOUNT)) {
            $criteria->add(ExportExpensesSummaryTableMap::COL_FINAL_DA_TRANSIT_AMOUNT, $this->final_da_transit_amount);
        }
        if ($this->isColumnModified(ExportExpensesSummaryTableMap::COL_FINAL_DA_LAST_DAY_OS_AMOUNT)) {
            $criteria->add(ExportExpensesSummaryTableMap::COL_FINAL_DA_LAST_DAY_OS_AMOUNT, $this->final_da_last_day_os_amount);
        }
        if ($this->isColumnModified(ExportExpensesSummaryTableMap::COL_FINAL_TA_AMOUNT)) {
            $criteria->add(ExportExpensesSummaryTableMap::COL_FINAL_TA_AMOUNT, $this->final_ta_amount);
        }
        if ($this->isColumnModified(ExportExpensesSummaryTableMap::COL_FINAL_INTERNET_BILL_AMOUNT)) {
            $criteria->add(ExportExpensesSummaryTableMap::COL_FINAL_INTERNET_BILL_AMOUNT, $this->final_internet_bill_amount);
        }
        if ($this->isColumnModified(ExportExpensesSummaryTableMap::COL_FINAL_OS_PETROL_ALLOWANCE_AMOUNT)) {
            $criteria->add(ExportExpensesSummaryTableMap::COL_FINAL_OS_PETROL_ALLOWANCE_AMOUNT, $this->final_os_petrol_allowance_amount);
        }
        if ($this->isColumnModified(ExportExpensesSummaryTableMap::COL_FINAL_ISBT_AMOUNT)) {
            $criteria->add(ExportExpensesSummaryTableMap::COL_FINAL_ISBT_AMOUNT, $this->final_isbt_amount);
        }
        if ($this->isColumnModified(ExportExpensesSummaryTableMap::COL_FINAL_HILL_ALLOWANCE_AMOUNT)) {
            $criteria->add(ExportExpensesSummaryTableMap::COL_FINAL_HILL_ALLOWANCE_AMOUNT, $this->final_hill_allowance_amount);
        }
        if ($this->isColumnModified(ExportExpensesSummaryTableMap::COL_FINAL_ILP_AMOUNT)) {
            $criteria->add(ExportExpensesSummaryTableMap::COL_FINAL_ILP_AMOUNT, $this->final_ilp_amount);
        }
        if ($this->isColumnModified(ExportExpensesSummaryTableMap::COL_FINAL_MR_CONVEYANCE_AMOUNT)) {
            $criteria->add(ExportExpensesSummaryTableMap::COL_FINAL_MR_CONVEYANCE_AMOUNT, $this->final_mr_conveyance_amount);
        }
        if ($this->isColumnModified(ExportExpensesSummaryTableMap::COL_FINAL_AM_CONVEYANCE_AMOUNT)) {
            $criteria->add(ExportExpensesSummaryTableMap::COL_FINAL_AM_CONVEYANCE_AMOUNT, $this->final_am_conveyance_amount);
        }
        if ($this->isColumnModified(ExportExpensesSummaryTableMap::COL_FINAL_RM_LODGING_AND_FOOD_AMOUNT)) {
            $criteria->add(ExportExpensesSummaryTableMap::COL_FINAL_RM_LODGING_AND_FOOD_AMOUNT, $this->final_rm_lodging_and_food_amount);
        }
        if ($this->isColumnModified(ExportExpensesSummaryTableMap::COL_FINAL_HANDSET_AMOUNT)) {
            $criteria->add(ExportExpensesSummaryTableMap::COL_FINAL_HANDSET_AMOUNT, $this->final_handset_amount);
        }
        if ($this->isColumnModified(ExportExpensesSummaryTableMap::COL_FINAL_HQ_PETROL_ALLOWANCE_AMOUNT)) {
            $criteria->add(ExportExpensesSummaryTableMap::COL_FINAL_HQ_PETROL_ALLOWANCE_AMOUNT, $this->final_hq_petrol_allowance_amount);
        }
        if ($this->isColumnModified(ExportExpensesSummaryTableMap::COL_FINAL_ZM_LODGING_AND_FOOD_AMOUNT)) {
            $criteria->add(ExportExpensesSummaryTableMap::COL_FINAL_ZM_LODGING_AND_FOOD_AMOUNT, $this->final_zm_lodging_and_food_amount);
        }
        if ($this->isColumnModified(ExportExpensesSummaryTableMap::COL_FINAL_RM_MOBILE_BILL_AMOUNT)) {
            $criteria->add(ExportExpensesSummaryTableMap::COL_FINAL_RM_MOBILE_BILL_AMOUNT, $this->final_rm_mobile_bill_amount);
        }
        if ($this->isColumnModified(ExportExpensesSummaryTableMap::COL_FINAL_ZM_LOCAL_CONVEYANCE_AMOUNT)) {
            $criteria->add(ExportExpensesSummaryTableMap::COL_FINAL_ZM_LOCAL_CONVEYANCE_AMOUNT, $this->final_zm_local_conveyance_amount);
        }
        if ($this->isColumnModified(ExportExpensesSummaryTableMap::COL_FINAL_RM_LOCAL_CONVEYANCE_AMOUNT)) {
            $criteria->add(ExportExpensesSummaryTableMap::COL_FINAL_RM_LOCAL_CONVEYANCE_AMOUNT, $this->final_rm_local_conveyance_amount);
        }
        if ($this->isColumnModified(ExportExpensesSummaryTableMap::COL_FINAL_ZM_MOBILE_BILL_AMOUNT)) {
            $criteria->add(ExportExpensesSummaryTableMap::COL_FINAL_ZM_MOBILE_BILL_AMOUNT, $this->final_zm_mobile_bill_amount);
        }
        if ($this->isColumnModified(ExportExpensesSummaryTableMap::COL_FINAL_STATIONERY_AMOUNT)) {
            $criteria->add(ExportExpensesSummaryTableMap::COL_FINAL_STATIONERY_AMOUNT, $this->final_stationery_amount);
        }
        if ($this->isColumnModified(ExportExpensesSummaryTableMap::COL_FINAL_EVENT_AMOUNT)) {
            $criteria->add(ExportExpensesSummaryTableMap::COL_FINAL_EVENT_AMOUNT, $this->final_event_amount);
        }
        if ($this->isColumnModified(ExportExpensesSummaryTableMap::COL_FINAL_OWN_STAY_AMOUNT)) {
            $criteria->add(ExportExpensesSummaryTableMap::COL_FINAL_OWN_STAY_AMOUNT, $this->final_own_stay_amount);
        }
        if ($this->isColumnModified(ExportExpensesSummaryTableMap::COL_FINAL_OTHER_ZM_LOCAL_CONVEYANCE_AMOUNT)) {
            $criteria->add(ExportExpensesSummaryTableMap::COL_FINAL_OTHER_ZM_LOCAL_CONVEYANCE_AMOUNT, $this->final_other_zm_local_conveyance_amount);
        }
        if ($this->isColumnModified(ExportExpensesSummaryTableMap::COL_FINAL_OTHER_OS_PETROL_ALLOWANCE_AMOUNT)) {
            $criteria->add(ExportExpensesSummaryTableMap::COL_FINAL_OTHER_OS_PETROL_ALLOWANCE_AMOUNT, $this->final_other_os_petrol_allowance_amount);
        }
        if ($this->isColumnModified(ExportExpensesSummaryTableMap::COL_FINAL_OTHER_RM_LOCAL_CONVEYANCE_AMOUNT)) {
            $criteria->add(ExportExpensesSummaryTableMap::COL_FINAL_OTHER_RM_LOCAL_CONVEYANCE_AMOUNT, $this->final_other_rm_local_conveyance_amount);
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
        $criteria = ChildExportExpensesSummaryQuery::create();
        $criteria->add(ExportExpensesSummaryTableMap::COL_UNIQUEID, $this->uniqueid);

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
     * @param object $copyObj An object of \entities\ExportExpensesSummary (or compatible) type.
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
        $copyObj->setRequestedDaHqAmount($this->getRequestedDaHqAmount());
        $copyObj->setRequestedDaExHqAmount($this->getRequestedDaExHqAmount());
        $copyObj->setRequestedDaOsAmount($this->getRequestedDaOsAmount());
        $copyObj->setRequestedAaTransitAmount($this->getRequestedAaTransitAmount());
        $copyObj->setRequestedDaLastDayOsAmount($this->getRequestedDaLastDayOsAmount());
        $copyObj->setRequestedTaAmount($this->getRequestedTaAmount());
        $copyObj->setRequestedInternetBillAmount($this->getRequestedInternetBillAmount());
        $copyObj->setRequestedOsPetrolAllowanceAmount($this->getRequestedOsPetrolAllowanceAmount());
        $copyObj->setRequestedIsbtAmount($this->getRequestedIsbtAmount());
        $copyObj->setRequestedHillAllowanceAmount($this->getRequestedHillAllowanceAmount());
        $copyObj->setRequestedIlpAmount($this->getRequestedIlpAmount());
        $copyObj->setRequestedMrConveyanceAmount($this->getRequestedMrConveyanceAmount());
        $copyObj->setRequestedAmConveyanceAmount($this->getRequestedAmConveyanceAmount());
        $copyObj->setRequestedRmLodgingAndFoodAmount($this->getRequestedRmLodgingAndFoodAmount());
        $copyObj->setRequestedHandsetAmount($this->getRequestedHandsetAmount());
        $copyObj->setRequestedHqPetrolAllowanceAmount($this->getRequestedHqPetrolAllowanceAmount());
        $copyObj->setRequestedZmLodgingAndFoodAmount($this->getRequestedZmLodgingAndFoodAmount());
        $copyObj->setRequestedRmMobileBillAmount($this->getRequestedRmMobileBillAmount());
        $copyObj->setRequestedZmLocalConveyanceAmount($this->getRequestedZmLocalConveyanceAmount());
        $copyObj->setRequestedRmLocalConveyanceAmount($this->getRequestedRmLocalConveyanceAmount());
        $copyObj->setRequestedZmMobileBillAmount($this->getRequestedZmMobileBillAmount());
        $copyObj->setRequestedStationeryAmount($this->getRequestedStationeryAmount());
        $copyObj->setRequestedEventAmount($this->getRequestedEventAmount());
        $copyObj->setRequestedOwnStayAmount($this->getRequestedOwnStayAmount());
        $copyObj->setRequestedOtherZmLocalConveyanceAmount($this->getRequestedOtherZmLocalConveyanceAmount());
        $copyObj->setRequestedOtherOsPetrolAllowanceAmount($this->getRequestedOtherOsPetrolAllowanceAmount());
        $copyObj->setRequestedOtherRmLocalConveyanceAmount($this->getRequestedOtherRmLocalConveyanceAmount());
        $copyObj->setFinalDaHqAmount($this->getFinalDaHqAmount());
        $copyObj->setFinalDaExHqAmount($this->getFinalDaExHqAmount());
        $copyObj->setFinalDaOsAmount($this->getFinalDaOsAmount());
        $copyObj->setFinalDaTransitAmount($this->getFinalDaTransitAmount());
        $copyObj->setFinalDaLastDayOsAmount($this->getFinalDaLastDayOsAmount());
        $copyObj->setFinalTaAmount($this->getFinalTaAmount());
        $copyObj->setFinalInternetBillAmount($this->getFinalInternetBillAmount());
        $copyObj->setFinalOsPetrolAllowanceAmount($this->getFinalOsPetrolAllowanceAmount());
        $copyObj->setFinalIsbtAmount($this->getFinalIsbtAmount());
        $copyObj->setFinalHillAllowanceAmount($this->getFinalHillAllowanceAmount());
        $copyObj->setFinalIlpAmount($this->getFinalIlpAmount());
        $copyObj->setFinalMrConveyanceAmount($this->getFinalMrConveyanceAmount());
        $copyObj->setFinalAmConveyanceAmount($this->getFinalAmConveyanceAmount());
        $copyObj->setFinalRmLodgingAndFoodAmount($this->getFinalRmLodgingAndFoodAmount());
        $copyObj->setFinalHandsetAmount($this->getFinalHandsetAmount());
        $copyObj->setFinalHqPetrolAllowanceAmount($this->getFinalHqPetrolAllowanceAmount());
        $copyObj->setFinalZmLodgingAndFoodAmount($this->getFinalZmLodgingAndFoodAmount());
        $copyObj->setFinalRmMobileBillAmount($this->getFinalRmMobileBillAmount());
        $copyObj->setFinalZmLocalConveyanceAmount($this->getFinalZmLocalConveyanceAmount());
        $copyObj->setFinalRmLocalConveyanceAmount($this->getFinalRmLocalConveyanceAmount());
        $copyObj->setFinalZmMobileBillAmount($this->getFinalZmMobileBillAmount());
        $copyObj->setFinalStationeryAmount($this->getFinalStationeryAmount());
        $copyObj->setFinalEventAmount($this->getFinalEventAmount());
        $copyObj->setFinal_own_stay_amount($this->getFinal_own_stay_amount());
        $copyObj->setFinalOtherZmLocalConveyanceAmount($this->getFinalOtherZmLocalConveyanceAmount());
        $copyObj->setFinalOtherOsPetrolAllowanceAmount($this->getFinalOtherOsPetrolAllowanceAmount());
        $copyObj->setFinalOtherRmLocalConveyanceAmount($this->getFinalOtherRmLocalConveyanceAmount());
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
     * @return \entities\ExportExpensesSummary Clone of current object.
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
        $this->requested_da_hq_amount = null;
        $this->requested_da_ex_hq_amount = null;
        $this->requested_da_os_amount = null;
        $this->requested_da_transit_amount = null;
        $this->requested_da_last_day_os_amount = null;
        $this->requested_ta_amount = null;
        $this->requested_internet_bill_amount = null;
        $this->requested_os_petrol_allowance_amount = null;
        $this->requested_isbt_amount = null;
        $this->requested_hill_allowance_amount = null;
        $this->requested_ilp_amount = null;
        $this->requested_mr_conveyance_amount = null;
        $this->requested_am_conveyance_amount = null;
        $this->requested_rm_lodging_and_food_amount = null;
        $this->requested_handset_amount = null;
        $this->requested_hq_petrol_allowance_amount = null;
        $this->requested_zm_lodging_and_food_amount = null;
        $this->requested_rm_mobile_bill_amount = null;
        $this->requested_zm_local_conveyance_amount = null;
        $this->requested_rm_local_conveyance_amount = null;
        $this->requested_zm_mobile_bill_amount = null;
        $this->requested_stationery_amount = null;
        $this->requested_event_amount = null;
        $this->requested_own_stay_amount = null;
        $this->requested_other_zm_local_conveyance_amount = null;
        $this->requested_other_os_petrol_allowance_amount = null;
        $this->requested_other_rm_local_conveyance_amount = null;
        $this->final_da_hq_amount = null;
        $this->final_da_ex_hq_amount = null;
        $this->final_da_os_amount = null;
        $this->final_da_transit_amount = null;
        $this->final_da_last_day_os_amount = null;
        $this->final_ta_amount = null;
        $this->final_internet_bill_amount = null;
        $this->final_os_petrol_allowance_amount = null;
        $this->final_isbt_amount = null;
        $this->final_hill_allowance_amount = null;
        $this->final_ilp_amount = null;
        $this->final_mr_conveyance_amount = null;
        $this->final_am_conveyance_amount = null;
        $this->final_rm_lodging_and_food_amount = null;
        $this->final_handset_amount = null;
        $this->final_hq_petrol_allowance_amount = null;
        $this->final_zm_lodging_and_food_amount = null;
        $this->final_rm_mobile_bill_amount = null;
        $this->final_zm_local_conveyance_amount = null;
        $this->final_rm_local_conveyance_amount = null;
        $this->final_zm_mobile_bill_amount = null;
        $this->final_stationery_amount = null;
        $this->final_event_amount = null;
        $this->final_own_stay_amount = null;
        $this->final_other_zm_local_conveyance_amount = null;
        $this->final_other_os_petrol_allowance_amount = null;
        $this->final_other_rm_local_conveyance_amount = null;
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
        return (string) $this->exportTo(ExportExpensesSummaryTableMap::DEFAULT_STRING_FORMAT);
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
