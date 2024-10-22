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
use entities\WriteMasQuery as ChildWriteMasQuery;
use entities\Map\WriteMasTableMap;

/**
 * Base class that represents a row from the 'write_mas' table.
 *
 *
 *
 * @package    propel.generator.entities.Base
 */
abstract class WriteMas implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\entities\\Map\\WriteMasTableMap';


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
     * The value for the org_unit_name field.
     *
     * @var        string|null
     */
    protected $org_unit_name;

    /**
     * The value for the rep_code field.
     *
     * @var        string|null
     */
    protected $rep_code;

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
     * The value for the am_position field.
     *
     * @var        string|null
     */
    protected $am_position;

    /**
     * The value for the rm_position field.
     *
     * @var        string|null
     */
    protected $rm_position;

    /**
     * The value for the zm_position field.
     *
     * @var        string|null
     */
    protected $zm_position;

    /**
     * The value for the location field.
     *
     * @var        string|null
     */
    protected $location;

    /**
     * The value for the month_year field.
     *
     * @var        string|null
     */
    protected $month_year;

    /**
     * The value for the working_days field.
     *
     * @var        string|null
     */
    protected $working_days;

    /**
     * The value for the fwd field.
     *
     * @var        string|null
     */
    protected $fwd;

    /**
     * The value for the nca field.
     *
     * @var        string|null
     */
    protected $nca;

    /**
     * The value for the total_doctors field.
     *
     * @var        string|null
     */
    protected $total_doctors;

    /**
     * The value for the dr_met field.
     *
     * @var        string|null
     */
    protected $dr_met;

    /**
     * The value for the dr_vf_met field.
     *
     * @var        string|null
     */
    protected $dr_vf_met;

    /**
     * The value for the drca_l field.
     *
     * @var        string|null
     */
    protected $drca_l;

    /**
     * The value for the drcvrg field.
     *
     * @var        string|null
     */
    protected $drcvrg;

    /**
     * The value for the drvfcvrg field.
     *
     * @var        string|null
     */
    protected $drvfcvrg;

    /**
     * The value for the missed_dr field.
     *
     * @var        string|null
     */
    protected $missed_dr;

    /**
     * The value for the missed_dr_calls field.
     *
     * @var        string|null
     */
    protected $missed_dr_calls;

    /**
     * The value for the total_chemist field.
     *
     * @var        string|null
     */
    protected $total_chemist;

    /**
     * The value for the pob_value field.
     *
     * @var        string|null
     */
    protected $pob_value;

    /**
     * The value for the rcpa_value_for_own_brand field.
     *
     * @var        string|null
     */
    protected $rcpa_value_for_own_brand;

    /**
     * The value for the rcpa_value_for_comp_brand field.
     *
     * @var        string|null
     */
    protected $rcpa_value_for_comp_brand;

    /**
     * The value for the joint_work_total_calls field.
     *
     * @var        string|null
     */
    protected $joint_work_total_calls;

    /**
     * The value for the leave_days field.
     *
     * @var        string|null
     */
    protected $leave_days;

    /**
     * The value for the joint_working field.
     *
     * @var        string|null
     */
    protected $joint_working;

    /**
     * The value for the no_dr_call field.
     *
     * @var        string|null
     */
    protected $no_dr_call;

    /**
     * The value for the agenda field.
     *
     * @var        string|null
     */
    protected $agenda;

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
     * The value for the employee_status field.
     *
     * @var        string|null
     */
    protected $employee_status;

    /**
     * The value for the employee_position_code field.
     *
     * @var        string|null
     */
    protected $employee_position_code;

    /**
     * The value for the employee_position_name field.
     *
     * @var        string|null
     */
    protected $employee_position_name;

    /**
     * The value for the employee_level field.
     *
     * @var        string|null
     */
    protected $employee_level;

    /**
     * The value for the mas_report_id field.
     *
     * @var        int
     */
    protected $mas_report_id;

    /**
     * The value for the chemist_met field.
     *
     * @var        string|null
     */
    protected $chemist_met;

    /**
     * The value for the chemist_calls field.
     *
     * @var        string|null
     */
    protected $chemist_calls;

    /**
     * The value for the chemist_call_avg field.
     *
     * @var        string|null
     */
    protected $chemist_call_avg;

    /**
     * The value for the total_stockists field.
     *
     * @var        string|null
     */
    protected $total_stockists;

    /**
     * The value for the dr_addition field.
     *
     * @var        string|null
     */
    protected $dr_addition;

    /**
     * The value for the dr_deletion field.
     *
     * @var        string|null
     */
    protected $dr_deletion;

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
     * Initializes internal state of entities\Base\WriteMas object.
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
     * Compares this with another <code>WriteMas</code> instance.  If
     * <code>obj</code> is an instance of <code>WriteMas</code>, delegates to
     * <code>equals(WriteMas)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [org_unit_name] column value.
     *
     * @return string|null
     */
    public function getOrgUnitName()
    {
        return $this->org_unit_name;
    }

    /**
     * Get the [rep_code] column value.
     *
     * @return string|null
     */
    public function getRepCode()
    {
        return $this->rep_code;
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
     * Get the [am_position] column value.
     *
     * @return string|null
     */
    public function getAmPosition()
    {
        return $this->am_position;
    }

    /**
     * Get the [rm_position] column value.
     *
     * @return string|null
     */
    public function getRmPosition()
    {
        return $this->rm_position;
    }

    /**
     * Get the [zm_position] column value.
     *
     * @return string|null
     */
    public function getZmPosition()
    {
        return $this->zm_position;
    }

    /**
     * Get the [location] column value.
     *
     * @return string|null
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Get the [month_year] column value.
     *
     * @return string|null
     */
    public function getMonthYear()
    {
        return $this->month_year;
    }

    /**
     * Get the [working_days] column value.
     *
     * @return string|null
     */
    public function getWorkingDays()
    {
        return $this->working_days;
    }

    /**
     * Get the [fwd] column value.
     *
     * @return string|null
     */
    public function getFwd()
    {
        return $this->fwd;
    }

    /**
     * Get the [nca] column value.
     *
     * @return string|null
     */
    public function getNca()
    {
        return $this->nca;
    }

    /**
     * Get the [total_doctors] column value.
     *
     * @return string|null
     */
    public function getTotalDoctors()
    {
        return $this->total_doctors;
    }

    /**
     * Get the [dr_met] column value.
     *
     * @return string|null
     */
    public function getDrMet()
    {
        return $this->dr_met;
    }

    /**
     * Get the [dr_vf_met] column value.
     *
     * @return string|null
     */
    public function getDrVfMet()
    {
        return $this->dr_vf_met;
    }

    /**
     * Get the [drca_l] column value.
     *
     * @return string|null
     */
    public function getDrcaL()
    {
        return $this->drca_l;
    }

    /**
     * Get the [drcvrg] column value.
     *
     * @return string|null
     */
    public function getDrcvrg()
    {
        return $this->drcvrg;
    }

    /**
     * Get the [drvfcvrg] column value.
     *
     * @return string|null
     */
    public function getDrvfcvrg()
    {
        return $this->drvfcvrg;
    }

    /**
     * Get the [missed_dr] column value.
     *
     * @return string|null
     */
    public function getMissedDr()
    {
        return $this->missed_dr;
    }

    /**
     * Get the [missed_dr_calls] column value.
     *
     * @return string|null
     */
    public function getMissedDrCalls()
    {
        return $this->missed_dr_calls;
    }

    /**
     * Get the [total_chemist] column value.
     *
     * @return string|null
     */
    public function getTotalChemist()
    {
        return $this->total_chemist;
    }

    /**
     * Get the [pob_value] column value.
     *
     * @return string|null
     */
    public function getPobValue()
    {
        return $this->pob_value;
    }

    /**
     * Get the [rcpa_value_for_own_brand] column value.
     *
     * @return string|null
     */
    public function getRcpaValueForOwnBrand()
    {
        return $this->rcpa_value_for_own_brand;
    }

    /**
     * Get the [rcpa_value_for_comp_brand] column value.
     *
     * @return string|null
     */
    public function getRcpaValueForCompBrand()
    {
        return $this->rcpa_value_for_comp_brand;
    }

    /**
     * Get the [joint_work_total_calls] column value.
     *
     * @return string|null
     */
    public function getJointWorkTotalCalls()
    {
        return $this->joint_work_total_calls;
    }

    /**
     * Get the [leave_days] column value.
     *
     * @return string|null
     */
    public function getLeaveDays()
    {
        return $this->leave_days;
    }

    /**
     * Get the [joint_working] column value.
     *
     * @return string|null
     */
    public function getJointWorking()
    {
        return $this->joint_working;
    }

    /**
     * Get the [no_dr_call] column value.
     *
     * @return string|null
     */
    public function getNoDrCall()
    {
        return $this->no_dr_call;
    }

    /**
     * Get the [agenda] column value.
     *
     * @return string|null
     */
    public function getAgenda()
    {
        return $this->agenda;
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
     * Get the [employee_status] column value.
     *
     * @return string|null
     */
    public function getEmployeeStatus()
    {
        return $this->employee_status;
    }

    /**
     * Get the [employee_position_code] column value.
     *
     * @return string|null
     */
    public function getEmployeePositionCode()
    {
        return $this->employee_position_code;
    }

    /**
     * Get the [employee_position_name] column value.
     *
     * @return string|null
     */
    public function getEmployeePositionName()
    {
        return $this->employee_position_name;
    }

    /**
     * Get the [employee_level] column value.
     *
     * @return string|null
     */
    public function getEmployeeLevel()
    {
        return $this->employee_level;
    }

    /**
     * Get the [mas_report_id] column value.
     *
     * @return int
     */
    public function getMasReportId()
    {
        return $this->mas_report_id;
    }

    /**
     * Get the [chemist_met] column value.
     *
     * @return string|null
     */
    public function getChemistMet()
    {
        return $this->chemist_met;
    }

    /**
     * Get the [chemist_calls] column value.
     *
     * @return string|null
     */
    public function getChemistCalls()
    {
        return $this->chemist_calls;
    }

    /**
     * Get the [chemist_call_avg] column value.
     *
     * @return string|null
     */
    public function getChemistCallAvg()
    {
        return $this->chemist_call_avg;
    }

    /**
     * Get the [total_stockists] column value.
     *
     * @return string|null
     */
    public function getTotalStockists()
    {
        return $this->total_stockists;
    }

    /**
     * Get the [dr_addition] column value.
     *
     * @return string|null
     */
    public function getDrAddition()
    {
        return $this->dr_addition;
    }

    /**
     * Get the [dr_deletion] column value.
     *
     * @return string|null
     */
    public function getDrDeletion()
    {
        return $this->dr_deletion;
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
     * Set the value of [org_unit_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOrgUnitName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->org_unit_name !== $v) {
            $this->org_unit_name = $v;
            $this->modifiedColumns[WriteMasTableMap::COL_ORG_UNIT_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [rep_code] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setRepCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->rep_code !== $v) {
            $this->rep_code = $v;
            $this->modifiedColumns[WriteMasTableMap::COL_REP_CODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [employee_code] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setEmployeeCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->employee_code !== $v) {
            $this->employee_code = $v;
            $this->modifiedColumns[WriteMasTableMap::COL_EMPLOYEE_CODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [employee_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setEmployeeName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->employee_name !== $v) {
            $this->employee_name = $v;
            $this->modifiedColumns[WriteMasTableMap::COL_EMPLOYEE_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [am_position] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setAmPosition($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->am_position !== $v) {
            $this->am_position = $v;
            $this->modifiedColumns[WriteMasTableMap::COL_AM_POSITION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [rm_position] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setRmPosition($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->rm_position !== $v) {
            $this->rm_position = $v;
            $this->modifiedColumns[WriteMasTableMap::COL_RM_POSITION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [zm_position] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setZmPosition($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->zm_position !== $v) {
            $this->zm_position = $v;
            $this->modifiedColumns[WriteMasTableMap::COL_ZM_POSITION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [location] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setLocation($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->location !== $v) {
            $this->location = $v;
            $this->modifiedColumns[WriteMasTableMap::COL_LOCATION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [month_year] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setMonthYear($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->month_year !== $v) {
            $this->month_year = $v;
            $this->modifiedColumns[WriteMasTableMap::COL_MONTH_YEAR] = true;
        }

        return $this;
    }

    /**
     * Set the value of [working_days] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setWorkingDays($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->working_days !== $v) {
            $this->working_days = $v;
            $this->modifiedColumns[WriteMasTableMap::COL_WORKING_DAYS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [fwd] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFwd($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->fwd !== $v) {
            $this->fwd = $v;
            $this->modifiedColumns[WriteMasTableMap::COL_FWD] = true;
        }

        return $this;
    }

    /**
     * Set the value of [nca] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setNca($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->nca !== $v) {
            $this->nca = $v;
            $this->modifiedColumns[WriteMasTableMap::COL_NCA] = true;
        }

        return $this;
    }

    /**
     * Set the value of [total_doctors] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setTotalDoctors($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->total_doctors !== $v) {
            $this->total_doctors = $v;
            $this->modifiedColumns[WriteMasTableMap::COL_TOTAL_DOCTORS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [dr_met] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setDrMet($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->dr_met !== $v) {
            $this->dr_met = $v;
            $this->modifiedColumns[WriteMasTableMap::COL_DR_MET] = true;
        }

        return $this;
    }

    /**
     * Set the value of [dr_vf_met] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setDrVfMet($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->dr_vf_met !== $v) {
            $this->dr_vf_met = $v;
            $this->modifiedColumns[WriteMasTableMap::COL_DR_VF_MET] = true;
        }

        return $this;
    }

    /**
     * Set the value of [drca_l] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setDrcaL($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->drca_l !== $v) {
            $this->drca_l = $v;
            $this->modifiedColumns[WriteMasTableMap::COL_DRCA_L] = true;
        }

        return $this;
    }

    /**
     * Set the value of [drcvrg] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setDrcvrg($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->drcvrg !== $v) {
            $this->drcvrg = $v;
            $this->modifiedColumns[WriteMasTableMap::COL_DRCVRG] = true;
        }

        return $this;
    }

    /**
     * Set the value of [drvfcvrg] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setDrvfcvrg($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->drvfcvrg !== $v) {
            $this->drvfcvrg = $v;
            $this->modifiedColumns[WriteMasTableMap::COL_DRVFCVRG] = true;
        }

        return $this;
    }

    /**
     * Set the value of [missed_dr] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setMissedDr($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->missed_dr !== $v) {
            $this->missed_dr = $v;
            $this->modifiedColumns[WriteMasTableMap::COL_MISSED_DR] = true;
        }

        return $this;
    }

    /**
     * Set the value of [missed_dr_calls] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setMissedDrCalls($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->missed_dr_calls !== $v) {
            $this->missed_dr_calls = $v;
            $this->modifiedColumns[WriteMasTableMap::COL_MISSED_DR_CALLS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [total_chemist] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setTotalChemist($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->total_chemist !== $v) {
            $this->total_chemist = $v;
            $this->modifiedColumns[WriteMasTableMap::COL_TOTAL_CHEMIST] = true;
        }

        return $this;
    }

    /**
     * Set the value of [pob_value] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPobValue($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->pob_value !== $v) {
            $this->pob_value = $v;
            $this->modifiedColumns[WriteMasTableMap::COL_POB_VALUE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [rcpa_value_for_own_brand] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setRcpaValueForOwnBrand($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->rcpa_value_for_own_brand !== $v) {
            $this->rcpa_value_for_own_brand = $v;
            $this->modifiedColumns[WriteMasTableMap::COL_RCPA_VALUE_FOR_OWN_BRAND] = true;
        }

        return $this;
    }

    /**
     * Set the value of [rcpa_value_for_comp_brand] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setRcpaValueForCompBrand($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->rcpa_value_for_comp_brand !== $v) {
            $this->rcpa_value_for_comp_brand = $v;
            $this->modifiedColumns[WriteMasTableMap::COL_RCPA_VALUE_FOR_COMP_BRAND] = true;
        }

        return $this;
    }

    /**
     * Set the value of [joint_work_total_calls] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setJointWorkTotalCalls($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->joint_work_total_calls !== $v) {
            $this->joint_work_total_calls = $v;
            $this->modifiedColumns[WriteMasTableMap::COL_JOINT_WORK_TOTAL_CALLS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [leave_days] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setLeaveDays($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->leave_days !== $v) {
            $this->leave_days = $v;
            $this->modifiedColumns[WriteMasTableMap::COL_LEAVE_DAYS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [joint_working] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setJointWorking($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->joint_working !== $v) {
            $this->joint_working = $v;
            $this->modifiedColumns[WriteMasTableMap::COL_JOINT_WORKING] = true;
        }

        return $this;
    }

    /**
     * Set the value of [no_dr_call] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setNoDrCall($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->no_dr_call !== $v) {
            $this->no_dr_call = $v;
            $this->modifiedColumns[WriteMasTableMap::COL_NO_DR_CALL] = true;
        }

        return $this;
    }

    /**
     * Set the value of [agenda] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setAgenda($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->agenda !== $v) {
            $this->agenda = $v;
            $this->modifiedColumns[WriteMasTableMap::COL_AGENDA] = true;
        }

        return $this;
    }

    /**
     * Set the value of [zm_position_code] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setZmPositionCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->zm_position_code !== $v) {
            $this->zm_position_code = $v;
            $this->modifiedColumns[WriteMasTableMap::COL_ZM_POSITION_CODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [rm_position_code] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setRmPositionCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->rm_position_code !== $v) {
            $this->rm_position_code = $v;
            $this->modifiedColumns[WriteMasTableMap::COL_RM_POSITION_CODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [am_position_code] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setAmPositionCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->am_position_code !== $v) {
            $this->am_position_code = $v;
            $this->modifiedColumns[WriteMasTableMap::COL_AM_POSITION_CODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [employee_status] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setEmployeeStatus($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->employee_status !== $v) {
            $this->employee_status = $v;
            $this->modifiedColumns[WriteMasTableMap::COL_EMPLOYEE_STATUS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [employee_position_code] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setEmployeePositionCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->employee_position_code !== $v) {
            $this->employee_position_code = $v;
            $this->modifiedColumns[WriteMasTableMap::COL_EMPLOYEE_POSITION_CODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [employee_position_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setEmployeePositionName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->employee_position_name !== $v) {
            $this->employee_position_name = $v;
            $this->modifiedColumns[WriteMasTableMap::COL_EMPLOYEE_POSITION_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [employee_level] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setEmployeeLevel($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->employee_level !== $v) {
            $this->employee_level = $v;
            $this->modifiedColumns[WriteMasTableMap::COL_EMPLOYEE_LEVEL] = true;
        }

        return $this;
    }

    /**
     * Set the value of [mas_report_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setMasReportId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->mas_report_id !== $v) {
            $this->mas_report_id = $v;
            $this->modifiedColumns[WriteMasTableMap::COL_MAS_REPORT_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [chemist_met] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setChemistMet($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->chemist_met !== $v) {
            $this->chemist_met = $v;
            $this->modifiedColumns[WriteMasTableMap::COL_CHEMIST_MET] = true;
        }

        return $this;
    }

    /**
     * Set the value of [chemist_calls] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setChemistCalls($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->chemist_calls !== $v) {
            $this->chemist_calls = $v;
            $this->modifiedColumns[WriteMasTableMap::COL_CHEMIST_CALLS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [chemist_call_avg] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setChemistCallAvg($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->chemist_call_avg !== $v) {
            $this->chemist_call_avg = $v;
            $this->modifiedColumns[WriteMasTableMap::COL_CHEMIST_CALL_AVG] = true;
        }

        return $this;
    }

    /**
     * Set the value of [total_stockists] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setTotalStockists($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->total_stockists !== $v) {
            $this->total_stockists = $v;
            $this->modifiedColumns[WriteMasTableMap::COL_TOTAL_STOCKISTS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [dr_addition] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setDrAddition($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->dr_addition !== $v) {
            $this->dr_addition = $v;
            $this->modifiedColumns[WriteMasTableMap::COL_DR_ADDITION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [dr_deletion] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setDrDeletion($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->dr_deletion !== $v) {
            $this->dr_deletion = $v;
            $this->modifiedColumns[WriteMasTableMap::COL_DR_DELETION] = true;
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
                $this->modifiedColumns[WriteMasTableMap::COL_CREATED_AT] = true;
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
                $this->modifiedColumns[WriteMasTableMap::COL_UPDATED_AT] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : WriteMasTableMap::translateFieldName('OrgUnitName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->org_unit_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : WriteMasTableMap::translateFieldName('RepCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->rep_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : WriteMasTableMap::translateFieldName('EmployeeCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->employee_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : WriteMasTableMap::translateFieldName('EmployeeName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->employee_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : WriteMasTableMap::translateFieldName('AmPosition', TableMap::TYPE_PHPNAME, $indexType)];
            $this->am_position = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : WriteMasTableMap::translateFieldName('RmPosition', TableMap::TYPE_PHPNAME, $indexType)];
            $this->rm_position = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : WriteMasTableMap::translateFieldName('ZmPosition', TableMap::TYPE_PHPNAME, $indexType)];
            $this->zm_position = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : WriteMasTableMap::translateFieldName('Location', TableMap::TYPE_PHPNAME, $indexType)];
            $this->location = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : WriteMasTableMap::translateFieldName('MonthYear', TableMap::TYPE_PHPNAME, $indexType)];
            $this->month_year = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : WriteMasTableMap::translateFieldName('WorkingDays', TableMap::TYPE_PHPNAME, $indexType)];
            $this->working_days = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : WriteMasTableMap::translateFieldName('Fwd', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fwd = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : WriteMasTableMap::translateFieldName('Nca', TableMap::TYPE_PHPNAME, $indexType)];
            $this->nca = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : WriteMasTableMap::translateFieldName('TotalDoctors', TableMap::TYPE_PHPNAME, $indexType)];
            $this->total_doctors = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : WriteMasTableMap::translateFieldName('DrMet', TableMap::TYPE_PHPNAME, $indexType)];
            $this->dr_met = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : WriteMasTableMap::translateFieldName('DrVfMet', TableMap::TYPE_PHPNAME, $indexType)];
            $this->dr_vf_met = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : WriteMasTableMap::translateFieldName('DrcaL', TableMap::TYPE_PHPNAME, $indexType)];
            $this->drca_l = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : WriteMasTableMap::translateFieldName('Drcvrg', TableMap::TYPE_PHPNAME, $indexType)];
            $this->drcvrg = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : WriteMasTableMap::translateFieldName('Drvfcvrg', TableMap::TYPE_PHPNAME, $indexType)];
            $this->drvfcvrg = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 18 + $startcol : WriteMasTableMap::translateFieldName('MissedDr', TableMap::TYPE_PHPNAME, $indexType)];
            $this->missed_dr = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 19 + $startcol : WriteMasTableMap::translateFieldName('MissedDrCalls', TableMap::TYPE_PHPNAME, $indexType)];
            $this->missed_dr_calls = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 20 + $startcol : WriteMasTableMap::translateFieldName('TotalChemist', TableMap::TYPE_PHPNAME, $indexType)];
            $this->total_chemist = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 21 + $startcol : WriteMasTableMap::translateFieldName('PobValue', TableMap::TYPE_PHPNAME, $indexType)];
            $this->pob_value = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 22 + $startcol : WriteMasTableMap::translateFieldName('RcpaValueForOwnBrand', TableMap::TYPE_PHPNAME, $indexType)];
            $this->rcpa_value_for_own_brand = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 23 + $startcol : WriteMasTableMap::translateFieldName('RcpaValueForCompBrand', TableMap::TYPE_PHPNAME, $indexType)];
            $this->rcpa_value_for_comp_brand = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 24 + $startcol : WriteMasTableMap::translateFieldName('JointWorkTotalCalls', TableMap::TYPE_PHPNAME, $indexType)];
            $this->joint_work_total_calls = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 25 + $startcol : WriteMasTableMap::translateFieldName('LeaveDays', TableMap::TYPE_PHPNAME, $indexType)];
            $this->leave_days = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 26 + $startcol : WriteMasTableMap::translateFieldName('JointWorking', TableMap::TYPE_PHPNAME, $indexType)];
            $this->joint_working = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 27 + $startcol : WriteMasTableMap::translateFieldName('NoDrCall', TableMap::TYPE_PHPNAME, $indexType)];
            $this->no_dr_call = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 28 + $startcol : WriteMasTableMap::translateFieldName('Agenda', TableMap::TYPE_PHPNAME, $indexType)];
            $this->agenda = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 29 + $startcol : WriteMasTableMap::translateFieldName('ZmPositionCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->zm_position_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 30 + $startcol : WriteMasTableMap::translateFieldName('RmPositionCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->rm_position_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 31 + $startcol : WriteMasTableMap::translateFieldName('AmPositionCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->am_position_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 32 + $startcol : WriteMasTableMap::translateFieldName('EmployeeStatus', TableMap::TYPE_PHPNAME, $indexType)];
            $this->employee_status = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 33 + $startcol : WriteMasTableMap::translateFieldName('EmployeePositionCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->employee_position_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 34 + $startcol : WriteMasTableMap::translateFieldName('EmployeePositionName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->employee_position_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 35 + $startcol : WriteMasTableMap::translateFieldName('EmployeeLevel', TableMap::TYPE_PHPNAME, $indexType)];
            $this->employee_level = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 36 + $startcol : WriteMasTableMap::translateFieldName('MasReportId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->mas_report_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 37 + $startcol : WriteMasTableMap::translateFieldName('ChemistMet', TableMap::TYPE_PHPNAME, $indexType)];
            $this->chemist_met = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 38 + $startcol : WriteMasTableMap::translateFieldName('ChemistCalls', TableMap::TYPE_PHPNAME, $indexType)];
            $this->chemist_calls = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 39 + $startcol : WriteMasTableMap::translateFieldName('ChemistCallAvg', TableMap::TYPE_PHPNAME, $indexType)];
            $this->chemist_call_avg = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 40 + $startcol : WriteMasTableMap::translateFieldName('TotalStockists', TableMap::TYPE_PHPNAME, $indexType)];
            $this->total_stockists = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 41 + $startcol : WriteMasTableMap::translateFieldName('DrAddition', TableMap::TYPE_PHPNAME, $indexType)];
            $this->dr_addition = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 42 + $startcol : WriteMasTableMap::translateFieldName('DrDeletion', TableMap::TYPE_PHPNAME, $indexType)];
            $this->dr_deletion = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 43 + $startcol : WriteMasTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 44 + $startcol : WriteMasTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 45; // 45 = WriteMasTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\entities\\WriteMas'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(WriteMasTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildWriteMasQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
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
     * @see WriteMas::setDeleted()
     * @see WriteMas::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(WriteMasTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildWriteMasQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(WriteMasTableMap::DATABASE_NAME);
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
                WriteMasTableMap::addInstanceToPool($this);
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

        $this->modifiedColumns[WriteMasTableMap::COL_MAS_REPORT_ID] = true;
        if (null !== $this->mas_report_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . WriteMasTableMap::COL_MAS_REPORT_ID . ')');
        }
        if (null === $this->mas_report_id) {
            try {
                $dataFetcher = $con->query("SELECT nextval('write_mas_mas_report_id_seq')");
                $this->mas_report_id = (int) $dataFetcher->fetchColumn();
            } catch (Exception $e) {
                throw new PropelException('Unable to get sequence id.', 0, $e);
            }
        }


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(WriteMasTableMap::COL_ORG_UNIT_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'org_unit_name';
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_REP_CODE)) {
            $modifiedColumns[':p' . $index++]  = 'rep_code';
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_EMPLOYEE_CODE)) {
            $modifiedColumns[':p' . $index++]  = 'employee_code';
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_EMPLOYEE_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'employee_name';
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_AM_POSITION)) {
            $modifiedColumns[':p' . $index++]  = 'am_position';
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_RM_POSITION)) {
            $modifiedColumns[':p' . $index++]  = 'rm_position';
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_ZM_POSITION)) {
            $modifiedColumns[':p' . $index++]  = 'zm_position';
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_LOCATION)) {
            $modifiedColumns[':p' . $index++]  = 'location';
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_MONTH_YEAR)) {
            $modifiedColumns[':p' . $index++]  = 'month_year';
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_WORKING_DAYS)) {
            $modifiedColumns[':p' . $index++]  = 'working_days';
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_FWD)) {
            $modifiedColumns[':p' . $index++]  = 'fwd';
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_NCA)) {
            $modifiedColumns[':p' . $index++]  = 'nca';
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_TOTAL_DOCTORS)) {
            $modifiedColumns[':p' . $index++]  = 'total_doctors';
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_DR_MET)) {
            $modifiedColumns[':p' . $index++]  = 'dr_met';
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_DR_VF_MET)) {
            $modifiedColumns[':p' . $index++]  = 'dr_vf_met';
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_DRCA_L)) {
            $modifiedColumns[':p' . $index++]  = 'drca_l';
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_DRCVRG)) {
            $modifiedColumns[':p' . $index++]  = 'drcvrg';
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_DRVFCVRG)) {
            $modifiedColumns[':p' . $index++]  = 'drvfcvrg';
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_MISSED_DR)) {
            $modifiedColumns[':p' . $index++]  = 'missed_dr';
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_MISSED_DR_CALLS)) {
            $modifiedColumns[':p' . $index++]  = 'missed_dr_calls';
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_TOTAL_CHEMIST)) {
            $modifiedColumns[':p' . $index++]  = 'total_chemist';
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_POB_VALUE)) {
            $modifiedColumns[':p' . $index++]  = 'pob_value';
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_RCPA_VALUE_FOR_OWN_BRAND)) {
            $modifiedColumns[':p' . $index++]  = 'rcpa_value_for_own_brand';
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_RCPA_VALUE_FOR_COMP_BRAND)) {
            $modifiedColumns[':p' . $index++]  = 'rcpa_value_for_comp_brand';
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_JOINT_WORK_TOTAL_CALLS)) {
            $modifiedColumns[':p' . $index++]  = 'joint_work_total_calls';
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_LEAVE_DAYS)) {
            $modifiedColumns[':p' . $index++]  = 'leave_days';
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_JOINT_WORKING)) {
            $modifiedColumns[':p' . $index++]  = 'joint_working';
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_NO_DR_CALL)) {
            $modifiedColumns[':p' . $index++]  = 'no_dr_call';
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_AGENDA)) {
            $modifiedColumns[':p' . $index++]  = 'agenda';
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_ZM_POSITION_CODE)) {
            $modifiedColumns[':p' . $index++]  = 'zm_position_code';
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_RM_POSITION_CODE)) {
            $modifiedColumns[':p' . $index++]  = 'rm_position_code';
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_AM_POSITION_CODE)) {
            $modifiedColumns[':p' . $index++]  = 'am_position_code';
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_EMPLOYEE_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'employee_status';
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_EMPLOYEE_POSITION_CODE)) {
            $modifiedColumns[':p' . $index++]  = 'employee_position_code';
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_EMPLOYEE_POSITION_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'employee_position_name';
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_EMPLOYEE_LEVEL)) {
            $modifiedColumns[':p' . $index++]  = 'employee_level';
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_MAS_REPORT_ID)) {
            $modifiedColumns[':p' . $index++]  = 'mas_report_id';
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_CHEMIST_MET)) {
            $modifiedColumns[':p' . $index++]  = 'chemist_met';
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_CHEMIST_CALLS)) {
            $modifiedColumns[':p' . $index++]  = 'chemist_calls';
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_CHEMIST_CALL_AVG)) {
            $modifiedColumns[':p' . $index++]  = 'chemist_call_avg';
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_TOTAL_STOCKISTS)) {
            $modifiedColumns[':p' . $index++]  = 'total_stockists';
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_DR_ADDITION)) {
            $modifiedColumns[':p' . $index++]  = 'dr_addition';
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_DR_DELETION)) {
            $modifiedColumns[':p' . $index++]  = 'dr_deletion';
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }

        $sql = sprintf(
            'INSERT INTO write_mas (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'org_unit_name':
                        $stmt->bindValue($identifier, $this->org_unit_name, PDO::PARAM_STR);

                        break;
                    case 'rep_code':
                        $stmt->bindValue($identifier, $this->rep_code, PDO::PARAM_STR);

                        break;
                    case 'employee_code':
                        $stmt->bindValue($identifier, $this->employee_code, PDO::PARAM_STR);

                        break;
                    case 'employee_name':
                        $stmt->bindValue($identifier, $this->employee_name, PDO::PARAM_STR);

                        break;
                    case 'am_position':
                        $stmt->bindValue($identifier, $this->am_position, PDO::PARAM_STR);

                        break;
                    case 'rm_position':
                        $stmt->bindValue($identifier, $this->rm_position, PDO::PARAM_STR);

                        break;
                    case 'zm_position':
                        $stmt->bindValue($identifier, $this->zm_position, PDO::PARAM_STR);

                        break;
                    case 'location':
                        $stmt->bindValue($identifier, $this->location, PDO::PARAM_STR);

                        break;
                    case 'month_year':
                        $stmt->bindValue($identifier, $this->month_year, PDO::PARAM_STR);

                        break;
                    case 'working_days':
                        $stmt->bindValue($identifier, $this->working_days, PDO::PARAM_STR);

                        break;
                    case 'fwd':
                        $stmt->bindValue($identifier, $this->fwd, PDO::PARAM_STR);

                        break;
                    case 'nca':
                        $stmt->bindValue($identifier, $this->nca, PDO::PARAM_STR);

                        break;
                    case 'total_doctors':
                        $stmt->bindValue($identifier, $this->total_doctors, PDO::PARAM_STR);

                        break;
                    case 'dr_met':
                        $stmt->bindValue($identifier, $this->dr_met, PDO::PARAM_STR);

                        break;
                    case 'dr_vf_met':
                        $stmt->bindValue($identifier, $this->dr_vf_met, PDO::PARAM_STR);

                        break;
                    case 'drca_l':
                        $stmt->bindValue($identifier, $this->drca_l, PDO::PARAM_STR);

                        break;
                    case 'drcvrg':
                        $stmt->bindValue($identifier, $this->drcvrg, PDO::PARAM_STR);

                        break;
                    case 'drvfcvrg':
                        $stmt->bindValue($identifier, $this->drvfcvrg, PDO::PARAM_STR);

                        break;
                    case 'missed_dr':
                        $stmt->bindValue($identifier, $this->missed_dr, PDO::PARAM_STR);

                        break;
                    case 'missed_dr_calls':
                        $stmt->bindValue($identifier, $this->missed_dr_calls, PDO::PARAM_STR);

                        break;
                    case 'total_chemist':
                        $stmt->bindValue($identifier, $this->total_chemist, PDO::PARAM_STR);

                        break;
                    case 'pob_value':
                        $stmt->bindValue($identifier, $this->pob_value, PDO::PARAM_STR);

                        break;
                    case 'rcpa_value_for_own_brand':
                        $stmt->bindValue($identifier, $this->rcpa_value_for_own_brand, PDO::PARAM_STR);

                        break;
                    case 'rcpa_value_for_comp_brand':
                        $stmt->bindValue($identifier, $this->rcpa_value_for_comp_brand, PDO::PARAM_STR);

                        break;
                    case 'joint_work_total_calls':
                        $stmt->bindValue($identifier, $this->joint_work_total_calls, PDO::PARAM_STR);

                        break;
                    case 'leave_days':
                        $stmt->bindValue($identifier, $this->leave_days, PDO::PARAM_STR);

                        break;
                    case 'joint_working':
                        $stmt->bindValue($identifier, $this->joint_working, PDO::PARAM_STR);

                        break;
                    case 'no_dr_call':
                        $stmt->bindValue($identifier, $this->no_dr_call, PDO::PARAM_STR);

                        break;
                    case 'agenda':
                        $stmt->bindValue($identifier, $this->agenda, PDO::PARAM_STR);

                        break;
                    case 'zm_position_code':
                        $stmt->bindValue($identifier, $this->zm_position_code, PDO::PARAM_STR);

                        break;
                    case 'rm_position_code':
                        $stmt->bindValue($identifier, $this->rm_position_code, PDO::PARAM_STR);

                        break;
                    case 'am_position_code':
                        $stmt->bindValue($identifier, $this->am_position_code, PDO::PARAM_STR);

                        break;
                    case 'employee_status':
                        $stmt->bindValue($identifier, $this->employee_status, PDO::PARAM_STR);

                        break;
                    case 'employee_position_code':
                        $stmt->bindValue($identifier, $this->employee_position_code, PDO::PARAM_STR);

                        break;
                    case 'employee_position_name':
                        $stmt->bindValue($identifier, $this->employee_position_name, PDO::PARAM_STR);

                        break;
                    case 'employee_level':
                        $stmt->bindValue($identifier, $this->employee_level, PDO::PARAM_STR);

                        break;
                    case 'mas_report_id':
                        $stmt->bindValue($identifier, $this->mas_report_id, PDO::PARAM_INT);

                        break;
                    case 'chemist_met':
                        $stmt->bindValue($identifier, $this->chemist_met, PDO::PARAM_STR);

                        break;
                    case 'chemist_calls':
                        $stmt->bindValue($identifier, $this->chemist_calls, PDO::PARAM_STR);

                        break;
                    case 'chemist_call_avg':
                        $stmt->bindValue($identifier, $this->chemist_call_avg, PDO::PARAM_STR);

                        break;
                    case 'total_stockists':
                        $stmt->bindValue($identifier, $this->total_stockists, PDO::PARAM_STR);

                        break;
                    case 'dr_addition':
                        $stmt->bindValue($identifier, $this->dr_addition, PDO::PARAM_STR);

                        break;
                    case 'dr_deletion':
                        $stmt->bindValue($identifier, $this->dr_deletion, PDO::PARAM_STR);

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
        $pos = WriteMasTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getOrgUnitName();

            case 1:
                return $this->getRepCode();

            case 2:
                return $this->getEmployeeCode();

            case 3:
                return $this->getEmployeeName();

            case 4:
                return $this->getAmPosition();

            case 5:
                return $this->getRmPosition();

            case 6:
                return $this->getZmPosition();

            case 7:
                return $this->getLocation();

            case 8:
                return $this->getMonthYear();

            case 9:
                return $this->getWorkingDays();

            case 10:
                return $this->getFwd();

            case 11:
                return $this->getNca();

            case 12:
                return $this->getTotalDoctors();

            case 13:
                return $this->getDrMet();

            case 14:
                return $this->getDrVfMet();

            case 15:
                return $this->getDrcaL();

            case 16:
                return $this->getDrcvrg();

            case 17:
                return $this->getDrvfcvrg();

            case 18:
                return $this->getMissedDr();

            case 19:
                return $this->getMissedDrCalls();

            case 20:
                return $this->getTotalChemist();

            case 21:
                return $this->getPobValue();

            case 22:
                return $this->getRcpaValueForOwnBrand();

            case 23:
                return $this->getRcpaValueForCompBrand();

            case 24:
                return $this->getJointWorkTotalCalls();

            case 25:
                return $this->getLeaveDays();

            case 26:
                return $this->getJointWorking();

            case 27:
                return $this->getNoDrCall();

            case 28:
                return $this->getAgenda();

            case 29:
                return $this->getZmPositionCode();

            case 30:
                return $this->getRmPositionCode();

            case 31:
                return $this->getAmPositionCode();

            case 32:
                return $this->getEmployeeStatus();

            case 33:
                return $this->getEmployeePositionCode();

            case 34:
                return $this->getEmployeePositionName();

            case 35:
                return $this->getEmployeeLevel();

            case 36:
                return $this->getMasReportId();

            case 37:
                return $this->getChemistMet();

            case 38:
                return $this->getChemistCalls();

            case 39:
                return $this->getChemistCallAvg();

            case 40:
                return $this->getTotalStockists();

            case 41:
                return $this->getDrAddition();

            case 42:
                return $this->getDrDeletion();

            case 43:
                return $this->getCreatedAt();

            case 44:
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
        if (isset($alreadyDumpedObjects['WriteMas'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['WriteMas'][$this->hashCode()] = true;
        $keys = WriteMasTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getOrgUnitName(),
            $keys[1] => $this->getRepCode(),
            $keys[2] => $this->getEmployeeCode(),
            $keys[3] => $this->getEmployeeName(),
            $keys[4] => $this->getAmPosition(),
            $keys[5] => $this->getRmPosition(),
            $keys[6] => $this->getZmPosition(),
            $keys[7] => $this->getLocation(),
            $keys[8] => $this->getMonthYear(),
            $keys[9] => $this->getWorkingDays(),
            $keys[10] => $this->getFwd(),
            $keys[11] => $this->getNca(),
            $keys[12] => $this->getTotalDoctors(),
            $keys[13] => $this->getDrMet(),
            $keys[14] => $this->getDrVfMet(),
            $keys[15] => $this->getDrcaL(),
            $keys[16] => $this->getDrcvrg(),
            $keys[17] => $this->getDrvfcvrg(),
            $keys[18] => $this->getMissedDr(),
            $keys[19] => $this->getMissedDrCalls(),
            $keys[20] => $this->getTotalChemist(),
            $keys[21] => $this->getPobValue(),
            $keys[22] => $this->getRcpaValueForOwnBrand(),
            $keys[23] => $this->getRcpaValueForCompBrand(),
            $keys[24] => $this->getJointWorkTotalCalls(),
            $keys[25] => $this->getLeaveDays(),
            $keys[26] => $this->getJointWorking(),
            $keys[27] => $this->getNoDrCall(),
            $keys[28] => $this->getAgenda(),
            $keys[29] => $this->getZmPositionCode(),
            $keys[30] => $this->getRmPositionCode(),
            $keys[31] => $this->getAmPositionCode(),
            $keys[32] => $this->getEmployeeStatus(),
            $keys[33] => $this->getEmployeePositionCode(),
            $keys[34] => $this->getEmployeePositionName(),
            $keys[35] => $this->getEmployeeLevel(),
            $keys[36] => $this->getMasReportId(),
            $keys[37] => $this->getChemistMet(),
            $keys[38] => $this->getChemistCalls(),
            $keys[39] => $this->getChemistCallAvg(),
            $keys[40] => $this->getTotalStockists(),
            $keys[41] => $this->getDrAddition(),
            $keys[42] => $this->getDrDeletion(),
            $keys[43] => $this->getCreatedAt(),
            $keys[44] => $this->getUpdatedAt(),
        ];
        if ($result[$keys[43]] instanceof \DateTimeInterface) {
            $result[$keys[43]] = $result[$keys[43]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[44]] instanceof \DateTimeInterface) {
            $result[$keys[44]] = $result[$keys[44]]->format('Y-m-d H:i:s.u');
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
        $pos = WriteMasTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setOrgUnitName($value);
                break;
            case 1:
                $this->setRepCode($value);
                break;
            case 2:
                $this->setEmployeeCode($value);
                break;
            case 3:
                $this->setEmployeeName($value);
                break;
            case 4:
                $this->setAmPosition($value);
                break;
            case 5:
                $this->setRmPosition($value);
                break;
            case 6:
                $this->setZmPosition($value);
                break;
            case 7:
                $this->setLocation($value);
                break;
            case 8:
                $this->setMonthYear($value);
                break;
            case 9:
                $this->setWorkingDays($value);
                break;
            case 10:
                $this->setFwd($value);
                break;
            case 11:
                $this->setNca($value);
                break;
            case 12:
                $this->setTotalDoctors($value);
                break;
            case 13:
                $this->setDrMet($value);
                break;
            case 14:
                $this->setDrVfMet($value);
                break;
            case 15:
                $this->setDrcaL($value);
                break;
            case 16:
                $this->setDrcvrg($value);
                break;
            case 17:
                $this->setDrvfcvrg($value);
                break;
            case 18:
                $this->setMissedDr($value);
                break;
            case 19:
                $this->setMissedDrCalls($value);
                break;
            case 20:
                $this->setTotalChemist($value);
                break;
            case 21:
                $this->setPobValue($value);
                break;
            case 22:
                $this->setRcpaValueForOwnBrand($value);
                break;
            case 23:
                $this->setRcpaValueForCompBrand($value);
                break;
            case 24:
                $this->setJointWorkTotalCalls($value);
                break;
            case 25:
                $this->setLeaveDays($value);
                break;
            case 26:
                $this->setJointWorking($value);
                break;
            case 27:
                $this->setNoDrCall($value);
                break;
            case 28:
                $this->setAgenda($value);
                break;
            case 29:
                $this->setZmPositionCode($value);
                break;
            case 30:
                $this->setRmPositionCode($value);
                break;
            case 31:
                $this->setAmPositionCode($value);
                break;
            case 32:
                $this->setEmployeeStatus($value);
                break;
            case 33:
                $this->setEmployeePositionCode($value);
                break;
            case 34:
                $this->setEmployeePositionName($value);
                break;
            case 35:
                $this->setEmployeeLevel($value);
                break;
            case 36:
                $this->setMasReportId($value);
                break;
            case 37:
                $this->setChemistMet($value);
                break;
            case 38:
                $this->setChemistCalls($value);
                break;
            case 39:
                $this->setChemistCallAvg($value);
                break;
            case 40:
                $this->setTotalStockists($value);
                break;
            case 41:
                $this->setDrAddition($value);
                break;
            case 42:
                $this->setDrDeletion($value);
                break;
            case 43:
                $this->setCreatedAt($value);
                break;
            case 44:
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
        $keys = WriteMasTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setOrgUnitName($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setRepCode($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setEmployeeCode($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setEmployeeName($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setAmPosition($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setRmPosition($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setZmPosition($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setLocation($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setMonthYear($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setWorkingDays($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setFwd($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setNca($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setTotalDoctors($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setDrMet($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setDrVfMet($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setDrcaL($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setDrcvrg($arr[$keys[16]]);
        }
        if (array_key_exists($keys[17], $arr)) {
            $this->setDrvfcvrg($arr[$keys[17]]);
        }
        if (array_key_exists($keys[18], $arr)) {
            $this->setMissedDr($arr[$keys[18]]);
        }
        if (array_key_exists($keys[19], $arr)) {
            $this->setMissedDrCalls($arr[$keys[19]]);
        }
        if (array_key_exists($keys[20], $arr)) {
            $this->setTotalChemist($arr[$keys[20]]);
        }
        if (array_key_exists($keys[21], $arr)) {
            $this->setPobValue($arr[$keys[21]]);
        }
        if (array_key_exists($keys[22], $arr)) {
            $this->setRcpaValueForOwnBrand($arr[$keys[22]]);
        }
        if (array_key_exists($keys[23], $arr)) {
            $this->setRcpaValueForCompBrand($arr[$keys[23]]);
        }
        if (array_key_exists($keys[24], $arr)) {
            $this->setJointWorkTotalCalls($arr[$keys[24]]);
        }
        if (array_key_exists($keys[25], $arr)) {
            $this->setLeaveDays($arr[$keys[25]]);
        }
        if (array_key_exists($keys[26], $arr)) {
            $this->setJointWorking($arr[$keys[26]]);
        }
        if (array_key_exists($keys[27], $arr)) {
            $this->setNoDrCall($arr[$keys[27]]);
        }
        if (array_key_exists($keys[28], $arr)) {
            $this->setAgenda($arr[$keys[28]]);
        }
        if (array_key_exists($keys[29], $arr)) {
            $this->setZmPositionCode($arr[$keys[29]]);
        }
        if (array_key_exists($keys[30], $arr)) {
            $this->setRmPositionCode($arr[$keys[30]]);
        }
        if (array_key_exists($keys[31], $arr)) {
            $this->setAmPositionCode($arr[$keys[31]]);
        }
        if (array_key_exists($keys[32], $arr)) {
            $this->setEmployeeStatus($arr[$keys[32]]);
        }
        if (array_key_exists($keys[33], $arr)) {
            $this->setEmployeePositionCode($arr[$keys[33]]);
        }
        if (array_key_exists($keys[34], $arr)) {
            $this->setEmployeePositionName($arr[$keys[34]]);
        }
        if (array_key_exists($keys[35], $arr)) {
            $this->setEmployeeLevel($arr[$keys[35]]);
        }
        if (array_key_exists($keys[36], $arr)) {
            $this->setMasReportId($arr[$keys[36]]);
        }
        if (array_key_exists($keys[37], $arr)) {
            $this->setChemistMet($arr[$keys[37]]);
        }
        if (array_key_exists($keys[38], $arr)) {
            $this->setChemistCalls($arr[$keys[38]]);
        }
        if (array_key_exists($keys[39], $arr)) {
            $this->setChemistCallAvg($arr[$keys[39]]);
        }
        if (array_key_exists($keys[40], $arr)) {
            $this->setTotalStockists($arr[$keys[40]]);
        }
        if (array_key_exists($keys[41], $arr)) {
            $this->setDrAddition($arr[$keys[41]]);
        }
        if (array_key_exists($keys[42], $arr)) {
            $this->setDrDeletion($arr[$keys[42]]);
        }
        if (array_key_exists($keys[43], $arr)) {
            $this->setCreatedAt($arr[$keys[43]]);
        }
        if (array_key_exists($keys[44], $arr)) {
            $this->setUpdatedAt($arr[$keys[44]]);
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
        $criteria = new Criteria(WriteMasTableMap::DATABASE_NAME);

        if ($this->isColumnModified(WriteMasTableMap::COL_ORG_UNIT_NAME)) {
            $criteria->add(WriteMasTableMap::COL_ORG_UNIT_NAME, $this->org_unit_name);
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_REP_CODE)) {
            $criteria->add(WriteMasTableMap::COL_REP_CODE, $this->rep_code);
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_EMPLOYEE_CODE)) {
            $criteria->add(WriteMasTableMap::COL_EMPLOYEE_CODE, $this->employee_code);
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_EMPLOYEE_NAME)) {
            $criteria->add(WriteMasTableMap::COL_EMPLOYEE_NAME, $this->employee_name);
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_AM_POSITION)) {
            $criteria->add(WriteMasTableMap::COL_AM_POSITION, $this->am_position);
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_RM_POSITION)) {
            $criteria->add(WriteMasTableMap::COL_RM_POSITION, $this->rm_position);
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_ZM_POSITION)) {
            $criteria->add(WriteMasTableMap::COL_ZM_POSITION, $this->zm_position);
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_LOCATION)) {
            $criteria->add(WriteMasTableMap::COL_LOCATION, $this->location);
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_MONTH_YEAR)) {
            $criteria->add(WriteMasTableMap::COL_MONTH_YEAR, $this->month_year);
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_WORKING_DAYS)) {
            $criteria->add(WriteMasTableMap::COL_WORKING_DAYS, $this->working_days);
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_FWD)) {
            $criteria->add(WriteMasTableMap::COL_FWD, $this->fwd);
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_NCA)) {
            $criteria->add(WriteMasTableMap::COL_NCA, $this->nca);
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_TOTAL_DOCTORS)) {
            $criteria->add(WriteMasTableMap::COL_TOTAL_DOCTORS, $this->total_doctors);
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_DR_MET)) {
            $criteria->add(WriteMasTableMap::COL_DR_MET, $this->dr_met);
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_DR_VF_MET)) {
            $criteria->add(WriteMasTableMap::COL_DR_VF_MET, $this->dr_vf_met);
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_DRCA_L)) {
            $criteria->add(WriteMasTableMap::COL_DRCA_L, $this->drca_l);
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_DRCVRG)) {
            $criteria->add(WriteMasTableMap::COL_DRCVRG, $this->drcvrg);
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_DRVFCVRG)) {
            $criteria->add(WriteMasTableMap::COL_DRVFCVRG, $this->drvfcvrg);
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_MISSED_DR)) {
            $criteria->add(WriteMasTableMap::COL_MISSED_DR, $this->missed_dr);
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_MISSED_DR_CALLS)) {
            $criteria->add(WriteMasTableMap::COL_MISSED_DR_CALLS, $this->missed_dr_calls);
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_TOTAL_CHEMIST)) {
            $criteria->add(WriteMasTableMap::COL_TOTAL_CHEMIST, $this->total_chemist);
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_POB_VALUE)) {
            $criteria->add(WriteMasTableMap::COL_POB_VALUE, $this->pob_value);
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_RCPA_VALUE_FOR_OWN_BRAND)) {
            $criteria->add(WriteMasTableMap::COL_RCPA_VALUE_FOR_OWN_BRAND, $this->rcpa_value_for_own_brand);
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_RCPA_VALUE_FOR_COMP_BRAND)) {
            $criteria->add(WriteMasTableMap::COL_RCPA_VALUE_FOR_COMP_BRAND, $this->rcpa_value_for_comp_brand);
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_JOINT_WORK_TOTAL_CALLS)) {
            $criteria->add(WriteMasTableMap::COL_JOINT_WORK_TOTAL_CALLS, $this->joint_work_total_calls);
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_LEAVE_DAYS)) {
            $criteria->add(WriteMasTableMap::COL_LEAVE_DAYS, $this->leave_days);
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_JOINT_WORKING)) {
            $criteria->add(WriteMasTableMap::COL_JOINT_WORKING, $this->joint_working);
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_NO_DR_CALL)) {
            $criteria->add(WriteMasTableMap::COL_NO_DR_CALL, $this->no_dr_call);
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_AGENDA)) {
            $criteria->add(WriteMasTableMap::COL_AGENDA, $this->agenda);
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_ZM_POSITION_CODE)) {
            $criteria->add(WriteMasTableMap::COL_ZM_POSITION_CODE, $this->zm_position_code);
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_RM_POSITION_CODE)) {
            $criteria->add(WriteMasTableMap::COL_RM_POSITION_CODE, $this->rm_position_code);
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_AM_POSITION_CODE)) {
            $criteria->add(WriteMasTableMap::COL_AM_POSITION_CODE, $this->am_position_code);
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_EMPLOYEE_STATUS)) {
            $criteria->add(WriteMasTableMap::COL_EMPLOYEE_STATUS, $this->employee_status);
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_EMPLOYEE_POSITION_CODE)) {
            $criteria->add(WriteMasTableMap::COL_EMPLOYEE_POSITION_CODE, $this->employee_position_code);
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_EMPLOYEE_POSITION_NAME)) {
            $criteria->add(WriteMasTableMap::COL_EMPLOYEE_POSITION_NAME, $this->employee_position_name);
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_EMPLOYEE_LEVEL)) {
            $criteria->add(WriteMasTableMap::COL_EMPLOYEE_LEVEL, $this->employee_level);
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_MAS_REPORT_ID)) {
            $criteria->add(WriteMasTableMap::COL_MAS_REPORT_ID, $this->mas_report_id);
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_CHEMIST_MET)) {
            $criteria->add(WriteMasTableMap::COL_CHEMIST_MET, $this->chemist_met);
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_CHEMIST_CALLS)) {
            $criteria->add(WriteMasTableMap::COL_CHEMIST_CALLS, $this->chemist_calls);
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_CHEMIST_CALL_AVG)) {
            $criteria->add(WriteMasTableMap::COL_CHEMIST_CALL_AVG, $this->chemist_call_avg);
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_TOTAL_STOCKISTS)) {
            $criteria->add(WriteMasTableMap::COL_TOTAL_STOCKISTS, $this->total_stockists);
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_DR_ADDITION)) {
            $criteria->add(WriteMasTableMap::COL_DR_ADDITION, $this->dr_addition);
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_DR_DELETION)) {
            $criteria->add(WriteMasTableMap::COL_DR_DELETION, $this->dr_deletion);
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_CREATED_AT)) {
            $criteria->add(WriteMasTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(WriteMasTableMap::COL_UPDATED_AT)) {
            $criteria->add(WriteMasTableMap::COL_UPDATED_AT, $this->updated_at);
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
        $criteria = ChildWriteMasQuery::create();
        $criteria->add(WriteMasTableMap::COL_MAS_REPORT_ID, $this->mas_report_id);

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
        $validPk = null !== $this->getMasReportId();

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
        return $this->getMasReportId();
    }

    /**
     * Generic method to set the primary key (mas_report_id column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setMasReportId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getMasReportId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \entities\WriteMas (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setOrgUnitName($this->getOrgUnitName());
        $copyObj->setRepCode($this->getRepCode());
        $copyObj->setEmployeeCode($this->getEmployeeCode());
        $copyObj->setEmployeeName($this->getEmployeeName());
        $copyObj->setAmPosition($this->getAmPosition());
        $copyObj->setRmPosition($this->getRmPosition());
        $copyObj->setZmPosition($this->getZmPosition());
        $copyObj->setLocation($this->getLocation());
        $copyObj->setMonthYear($this->getMonthYear());
        $copyObj->setWorkingDays($this->getWorkingDays());
        $copyObj->setFwd($this->getFwd());
        $copyObj->setNca($this->getNca());
        $copyObj->setTotalDoctors($this->getTotalDoctors());
        $copyObj->setDrMet($this->getDrMet());
        $copyObj->setDrVfMet($this->getDrVfMet());
        $copyObj->setDrcaL($this->getDrcaL());
        $copyObj->setDrcvrg($this->getDrcvrg());
        $copyObj->setDrvfcvrg($this->getDrvfcvrg());
        $copyObj->setMissedDr($this->getMissedDr());
        $copyObj->setMissedDrCalls($this->getMissedDrCalls());
        $copyObj->setTotalChemist($this->getTotalChemist());
        $copyObj->setPobValue($this->getPobValue());
        $copyObj->setRcpaValueForOwnBrand($this->getRcpaValueForOwnBrand());
        $copyObj->setRcpaValueForCompBrand($this->getRcpaValueForCompBrand());
        $copyObj->setJointWorkTotalCalls($this->getJointWorkTotalCalls());
        $copyObj->setLeaveDays($this->getLeaveDays());
        $copyObj->setJointWorking($this->getJointWorking());
        $copyObj->setNoDrCall($this->getNoDrCall());
        $copyObj->setAgenda($this->getAgenda());
        $copyObj->setZmPositionCode($this->getZmPositionCode());
        $copyObj->setRmPositionCode($this->getRmPositionCode());
        $copyObj->setAmPositionCode($this->getAmPositionCode());
        $copyObj->setEmployeeStatus($this->getEmployeeStatus());
        $copyObj->setEmployeePositionCode($this->getEmployeePositionCode());
        $copyObj->setEmployeePositionName($this->getEmployeePositionName());
        $copyObj->setEmployeeLevel($this->getEmployeeLevel());
        $copyObj->setChemistMet($this->getChemistMet());
        $copyObj->setChemistCalls($this->getChemistCalls());
        $copyObj->setChemistCallAvg($this->getChemistCallAvg());
        $copyObj->setTotalStockists($this->getTotalStockists());
        $copyObj->setDrAddition($this->getDrAddition());
        $copyObj->setDrDeletion($this->getDrDeletion());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setMasReportId(NULL); // this is a auto-increment column, so set to default value
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
     * @return \entities\WriteMas Clone of current object.
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
        $this->org_unit_name = null;
        $this->rep_code = null;
        $this->employee_code = null;
        $this->employee_name = null;
        $this->am_position = null;
        $this->rm_position = null;
        $this->zm_position = null;
        $this->location = null;
        $this->month_year = null;
        $this->working_days = null;
        $this->fwd = null;
        $this->nca = null;
        $this->total_doctors = null;
        $this->dr_met = null;
        $this->dr_vf_met = null;
        $this->drca_l = null;
        $this->drcvrg = null;
        $this->drvfcvrg = null;
        $this->missed_dr = null;
        $this->missed_dr_calls = null;
        $this->total_chemist = null;
        $this->pob_value = null;
        $this->rcpa_value_for_own_brand = null;
        $this->rcpa_value_for_comp_brand = null;
        $this->joint_work_total_calls = null;
        $this->leave_days = null;
        $this->joint_working = null;
        $this->no_dr_call = null;
        $this->agenda = null;
        $this->zm_position_code = null;
        $this->rm_position_code = null;
        $this->am_position_code = null;
        $this->employee_status = null;
        $this->employee_position_code = null;
        $this->employee_position_name = null;
        $this->employee_level = null;
        $this->mas_report_id = null;
        $this->chemist_met = null;
        $this->chemist_calls = null;
        $this->chemist_call_avg = null;
        $this->total_stockists = null;
        $this->dr_addition = null;
        $this->dr_deletion = null;
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
        return (string) $this->exportTo(WriteMasTableMap::DEFAULT_STRING_FORMAT);
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
