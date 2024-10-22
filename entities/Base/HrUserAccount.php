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
use entities\Employee as ChildEmployee;
use entities\EmployeeQuery as ChildEmployeeQuery;
use entities\HrUserAccountQuery as ChildHrUserAccountQuery;
use entities\Map\HrUserAccountTableMap;

/**
 * Base class that represents a row from the 'hr_user_account' table.
 *
 *
 *
 * @package    propel.generator.entities.Base
 */
abstract class HrUserAccount implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\entities\\Map\\HrUserAccountTableMap';


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
     * The value for the hrua_id field.
     *
     * @var        int
     */
    protected $hrua_id;

    /**
     * The value for the employee_id field.
     *
     * @var        int|null
     */
    protected $employee_id;

    /**
     * The value for the personal_bank field.
     *
     * @var        string|null
     */
    protected $personal_bank;

    /**
     * The value for the personal_account_number field.
     *
     * @var        string|null
     */
    protected $personal_account_number;

    /**
     * The value for the pf_esic_contribution field.
     *
     * @var        int|null
     */
    protected $pf_esic_contribution;

    /**
     * The value for the pf_number field.
     *
     * @var        string|null
     */
    protected $pf_number;

    /**
     * The value for the esci_number field.
     *
     * @var        string|null
     */
    protected $esci_number;

    /**
     * The value for the gross_salary field.
     *
     * @var        double|null
     */
    protected $gross_salary;

    /**
     * The value for the payment_mode field.
     *
     * @var        string|null
     */
    protected $payment_mode;

    /**
     * The value for the salary_bank field.
     *
     * @var        string|null
     */
    protected $salary_bank;

    /**
     * The value for the salary_account_number field.
     *
     * @var        string|null
     */
    protected $salary_account_number;

    /**
     * The value for the tds_status field.
     *
     * @var        int|null
     */
    protected $tds_status;

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
     * @var        ChildEmployee
     */
    protected $aEmployee;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * Initializes internal state of entities\Base\HrUserAccount object.
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
     * Compares this with another <code>HrUserAccount</code> instance.  If
     * <code>obj</code> is an instance of <code>HrUserAccount</code>, delegates to
     * <code>equals(HrUserAccount)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [hrua_id] column value.
     *
     * @return int
     */
    public function getHruaId()
    {
        return $this->hrua_id;
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
     * Get the [personal_bank] column value.
     *
     * @return string|null
     */
    public function getPersonalBank()
    {
        return $this->personal_bank;
    }

    /**
     * Get the [personal_account_number] column value.
     *
     * @return string|null
     */
    public function getPersonalAccountNumber()
    {
        return $this->personal_account_number;
    }

    /**
     * Get the [pf_esic_contribution] column value.
     *
     * @return int|null
     */
    public function getPfEsicContribution()
    {
        return $this->pf_esic_contribution;
    }

    /**
     * Get the [pf_number] column value.
     *
     * @return string|null
     */
    public function getPfNumber()
    {
        return $this->pf_number;
    }

    /**
     * Get the [esci_number] column value.
     *
     * @return string|null
     */
    public function getEsciNumber()
    {
        return $this->esci_number;
    }

    /**
     * Get the [gross_salary] column value.
     *
     * @return double|null
     */
    public function getGrossSalary()
    {
        return $this->gross_salary;
    }

    /**
     * Get the [payment_mode] column value.
     *
     * @return string|null
     */
    public function getPaymentMode()
    {
        return $this->payment_mode;
    }

    /**
     * Get the [salary_bank] column value.
     *
     * @return string|null
     */
    public function getSalaryBank()
    {
        return $this->salary_bank;
    }

    /**
     * Get the [salary_account_number] column value.
     *
     * @return string|null
     */
    public function getSalaryAccountNumber()
    {
        return $this->salary_account_number;
    }

    /**
     * Get the [tds_status] column value.
     *
     * @return int|null
     */
    public function getTdsStatus()
    {
        return $this->tds_status;
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
     * Set the value of [hrua_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setHruaId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->hrua_id !== $v) {
            $this->hrua_id = $v;
            $this->modifiedColumns[HrUserAccountTableMap::COL_HRUA_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [employee_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setEmployeeId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->employee_id !== $v) {
            $this->employee_id = $v;
            $this->modifiedColumns[HrUserAccountTableMap::COL_EMPLOYEE_ID] = true;
        }

        if ($this->aEmployee !== null && $this->aEmployee->getEmployeeId() !== $v) {
            $this->aEmployee = null;
        }

        return $this;
    }

    /**
     * Set the value of [personal_bank] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPersonalBank($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->personal_bank !== $v) {
            $this->personal_bank = $v;
            $this->modifiedColumns[HrUserAccountTableMap::COL_PERSONAL_BANK] = true;
        }

        return $this;
    }

    /**
     * Set the value of [personal_account_number] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPersonalAccountNumber($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->personal_account_number !== $v) {
            $this->personal_account_number = $v;
            $this->modifiedColumns[HrUserAccountTableMap::COL_PERSONAL_ACCOUNT_NUMBER] = true;
        }

        return $this;
    }

    /**
     * Set the value of [pf_esic_contribution] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPfEsicContribution($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->pf_esic_contribution !== $v) {
            $this->pf_esic_contribution = $v;
            $this->modifiedColumns[HrUserAccountTableMap::COL_PF_ESIC_CONTRIBUTION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [pf_number] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPfNumber($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->pf_number !== $v) {
            $this->pf_number = $v;
            $this->modifiedColumns[HrUserAccountTableMap::COL_PF_NUMBER] = true;
        }

        return $this;
    }

    /**
     * Set the value of [esci_number] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setEsciNumber($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->esci_number !== $v) {
            $this->esci_number = $v;
            $this->modifiedColumns[HrUserAccountTableMap::COL_ESCI_NUMBER] = true;
        }

        return $this;
    }

    /**
     * Set the value of [gross_salary] column.
     *
     * @param double|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setGrossSalary($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->gross_salary !== $v) {
            $this->gross_salary = $v;
            $this->modifiedColumns[HrUserAccountTableMap::COL_GROSS_SALARY] = true;
        }

        return $this;
    }

    /**
     * Set the value of [payment_mode] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPaymentMode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->payment_mode !== $v) {
            $this->payment_mode = $v;
            $this->modifiedColumns[HrUserAccountTableMap::COL_PAYMENT_MODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [salary_bank] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setSalaryBank($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->salary_bank !== $v) {
            $this->salary_bank = $v;
            $this->modifiedColumns[HrUserAccountTableMap::COL_SALARY_BANK] = true;
        }

        return $this;
    }

    /**
     * Set the value of [salary_account_number] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setSalaryAccountNumber($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->salary_account_number !== $v) {
            $this->salary_account_number = $v;
            $this->modifiedColumns[HrUserAccountTableMap::COL_SALARY_ACCOUNT_NUMBER] = true;
        }

        return $this;
    }

    /**
     * Set the value of [tds_status] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setTdsStatus($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->tds_status !== $v) {
            $this->tds_status = $v;
            $this->modifiedColumns[HrUserAccountTableMap::COL_TDS_STATUS] = true;
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
                $this->modifiedColumns[HrUserAccountTableMap::COL_CREATED_AT] = true;
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
                $this->modifiedColumns[HrUserAccountTableMap::COL_UPDATED_AT] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : HrUserAccountTableMap::translateFieldName('HruaId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->hrua_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : HrUserAccountTableMap::translateFieldName('EmployeeId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->employee_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : HrUserAccountTableMap::translateFieldName('PersonalBank', TableMap::TYPE_PHPNAME, $indexType)];
            $this->personal_bank = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : HrUserAccountTableMap::translateFieldName('PersonalAccountNumber', TableMap::TYPE_PHPNAME, $indexType)];
            $this->personal_account_number = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : HrUserAccountTableMap::translateFieldName('PfEsicContribution', TableMap::TYPE_PHPNAME, $indexType)];
            $this->pf_esic_contribution = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : HrUserAccountTableMap::translateFieldName('PfNumber', TableMap::TYPE_PHPNAME, $indexType)];
            $this->pf_number = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : HrUserAccountTableMap::translateFieldName('EsciNumber', TableMap::TYPE_PHPNAME, $indexType)];
            $this->esci_number = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : HrUserAccountTableMap::translateFieldName('GrossSalary', TableMap::TYPE_PHPNAME, $indexType)];
            $this->gross_salary = (null !== $col) ? (double) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : HrUserAccountTableMap::translateFieldName('PaymentMode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->payment_mode = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : HrUserAccountTableMap::translateFieldName('SalaryBank', TableMap::TYPE_PHPNAME, $indexType)];
            $this->salary_bank = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : HrUserAccountTableMap::translateFieldName('SalaryAccountNumber', TableMap::TYPE_PHPNAME, $indexType)];
            $this->salary_account_number = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : HrUserAccountTableMap::translateFieldName('TdsStatus', TableMap::TYPE_PHPNAME, $indexType)];
            $this->tds_status = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : HrUserAccountTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : HrUserAccountTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 14; // 14 = HrUserAccountTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\entities\\HrUserAccount'), 0, $e);
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
        if ($this->aEmployee !== null && $this->employee_id !== $this->aEmployee->getEmployeeId()) {
            $this->aEmployee = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(HrUserAccountTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildHrUserAccountQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aEmployee = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see HrUserAccount::setDeleted()
     * @see HrUserAccount::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(HrUserAccountTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildHrUserAccountQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(HrUserAccountTableMap::DATABASE_NAME);
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
                HrUserAccountTableMap::addInstanceToPool($this);
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

            if ($this->aEmployee !== null) {
                if ($this->aEmployee->isModified() || $this->aEmployee->isNew()) {
                    $affectedRows += $this->aEmployee->save($con);
                }
                $this->setEmployee($this->aEmployee);
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

        $this->modifiedColumns[HrUserAccountTableMap::COL_HRUA_ID] = true;
        if (null !== $this->hrua_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . HrUserAccountTableMap::COL_HRUA_ID . ')');
        }
        if (null === $this->hrua_id) {
            try {
                $dataFetcher = $con->query("SELECT nextval('hr_user_account_hrua_id_seq')");
                $this->hrua_id = (int) $dataFetcher->fetchColumn();
            } catch (Exception $e) {
                throw new PropelException('Unable to get sequence id.', 0, $e);
            }
        }


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(HrUserAccountTableMap::COL_HRUA_ID)) {
            $modifiedColumns[':p' . $index++]  = 'hrua_id';
        }
        if ($this->isColumnModified(HrUserAccountTableMap::COL_EMPLOYEE_ID)) {
            $modifiedColumns[':p' . $index++]  = 'employee_id';
        }
        if ($this->isColumnModified(HrUserAccountTableMap::COL_PERSONAL_BANK)) {
            $modifiedColumns[':p' . $index++]  = 'personal_bank';
        }
        if ($this->isColumnModified(HrUserAccountTableMap::COL_PERSONAL_ACCOUNT_NUMBER)) {
            $modifiedColumns[':p' . $index++]  = 'personal_account_number';
        }
        if ($this->isColumnModified(HrUserAccountTableMap::COL_PF_ESIC_CONTRIBUTION)) {
            $modifiedColumns[':p' . $index++]  = 'pf_esic_contribution';
        }
        if ($this->isColumnModified(HrUserAccountTableMap::COL_PF_NUMBER)) {
            $modifiedColumns[':p' . $index++]  = 'pf_number';
        }
        if ($this->isColumnModified(HrUserAccountTableMap::COL_ESCI_NUMBER)) {
            $modifiedColumns[':p' . $index++]  = 'esci_number';
        }
        if ($this->isColumnModified(HrUserAccountTableMap::COL_GROSS_SALARY)) {
            $modifiedColumns[':p' . $index++]  = 'gross_salary';
        }
        if ($this->isColumnModified(HrUserAccountTableMap::COL_PAYMENT_MODE)) {
            $modifiedColumns[':p' . $index++]  = 'payment_mode';
        }
        if ($this->isColumnModified(HrUserAccountTableMap::COL_SALARY_BANK)) {
            $modifiedColumns[':p' . $index++]  = 'salary_bank';
        }
        if ($this->isColumnModified(HrUserAccountTableMap::COL_SALARY_ACCOUNT_NUMBER)) {
            $modifiedColumns[':p' . $index++]  = 'salary_account_number';
        }
        if ($this->isColumnModified(HrUserAccountTableMap::COL_TDS_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'tds_status';
        }
        if ($this->isColumnModified(HrUserAccountTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(HrUserAccountTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }

        $sql = sprintf(
            'INSERT INTO hr_user_account (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'hrua_id':
                        $stmt->bindValue($identifier, $this->hrua_id, PDO::PARAM_INT);

                        break;
                    case 'employee_id':
                        $stmt->bindValue($identifier, $this->employee_id, PDO::PARAM_INT);

                        break;
                    case 'personal_bank':
                        $stmt->bindValue($identifier, $this->personal_bank, PDO::PARAM_STR);

                        break;
                    case 'personal_account_number':
                        $stmt->bindValue($identifier, $this->personal_account_number, PDO::PARAM_STR);

                        break;
                    case 'pf_esic_contribution':
                        $stmt->bindValue($identifier, $this->pf_esic_contribution, PDO::PARAM_INT);

                        break;
                    case 'pf_number':
                        $stmt->bindValue($identifier, $this->pf_number, PDO::PARAM_STR);

                        break;
                    case 'esci_number':
                        $stmt->bindValue($identifier, $this->esci_number, PDO::PARAM_STR);

                        break;
                    case 'gross_salary':
                        $stmt->bindValue($identifier, $this->gross_salary, PDO::PARAM_STR);

                        break;
                    case 'payment_mode':
                        $stmt->bindValue($identifier, $this->payment_mode, PDO::PARAM_STR);

                        break;
                    case 'salary_bank':
                        $stmt->bindValue($identifier, $this->salary_bank, PDO::PARAM_STR);

                        break;
                    case 'salary_account_number':
                        $stmt->bindValue($identifier, $this->salary_account_number, PDO::PARAM_STR);

                        break;
                    case 'tds_status':
                        $stmt->bindValue($identifier, $this->tds_status, PDO::PARAM_INT);

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
        $pos = HrUserAccountTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getHruaId();

            case 1:
                return $this->getEmployeeId();

            case 2:
                return $this->getPersonalBank();

            case 3:
                return $this->getPersonalAccountNumber();

            case 4:
                return $this->getPfEsicContribution();

            case 5:
                return $this->getPfNumber();

            case 6:
                return $this->getEsciNumber();

            case 7:
                return $this->getGrossSalary();

            case 8:
                return $this->getPaymentMode();

            case 9:
                return $this->getSalaryBank();

            case 10:
                return $this->getSalaryAccountNumber();

            case 11:
                return $this->getTdsStatus();

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
     * @param bool $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array An associative array containing the field names (as keys) and field values
     */
    public function toArray(string $keyType = TableMap::TYPE_PHPNAME, bool $includeLazyLoadColumns = true, array $alreadyDumpedObjects = [], bool $includeForeignObjects = false): array
    {
        if (isset($alreadyDumpedObjects['HrUserAccount'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['HrUserAccount'][$this->hashCode()] = true;
        $keys = HrUserAccountTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getHruaId(),
            $keys[1] => $this->getEmployeeId(),
            $keys[2] => $this->getPersonalBank(),
            $keys[3] => $this->getPersonalAccountNumber(),
            $keys[4] => $this->getPfEsicContribution(),
            $keys[5] => $this->getPfNumber(),
            $keys[6] => $this->getEsciNumber(),
            $keys[7] => $this->getGrossSalary(),
            $keys[8] => $this->getPaymentMode(),
            $keys[9] => $this->getSalaryBank(),
            $keys[10] => $this->getSalaryAccountNumber(),
            $keys[11] => $this->getTdsStatus(),
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

        if ($includeForeignObjects) {
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
        $pos = HrUserAccountTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setHruaId($value);
                break;
            case 1:
                $this->setEmployeeId($value);
                break;
            case 2:
                $this->setPersonalBank($value);
                break;
            case 3:
                $this->setPersonalAccountNumber($value);
                break;
            case 4:
                $this->setPfEsicContribution($value);
                break;
            case 5:
                $this->setPfNumber($value);
                break;
            case 6:
                $this->setEsciNumber($value);
                break;
            case 7:
                $this->setGrossSalary($value);
                break;
            case 8:
                $this->setPaymentMode($value);
                break;
            case 9:
                $this->setSalaryBank($value);
                break;
            case 10:
                $this->setSalaryAccountNumber($value);
                break;
            case 11:
                $this->setTdsStatus($value);
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
        $keys = HrUserAccountTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setHruaId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setEmployeeId($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setPersonalBank($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setPersonalAccountNumber($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setPfEsicContribution($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setPfNumber($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setEsciNumber($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setGrossSalary($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setPaymentMode($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setSalaryBank($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setSalaryAccountNumber($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setTdsStatus($arr[$keys[11]]);
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
        $criteria = new Criteria(HrUserAccountTableMap::DATABASE_NAME);

        if ($this->isColumnModified(HrUserAccountTableMap::COL_HRUA_ID)) {
            $criteria->add(HrUserAccountTableMap::COL_HRUA_ID, $this->hrua_id);
        }
        if ($this->isColumnModified(HrUserAccountTableMap::COL_EMPLOYEE_ID)) {
            $criteria->add(HrUserAccountTableMap::COL_EMPLOYEE_ID, $this->employee_id);
        }
        if ($this->isColumnModified(HrUserAccountTableMap::COL_PERSONAL_BANK)) {
            $criteria->add(HrUserAccountTableMap::COL_PERSONAL_BANK, $this->personal_bank);
        }
        if ($this->isColumnModified(HrUserAccountTableMap::COL_PERSONAL_ACCOUNT_NUMBER)) {
            $criteria->add(HrUserAccountTableMap::COL_PERSONAL_ACCOUNT_NUMBER, $this->personal_account_number);
        }
        if ($this->isColumnModified(HrUserAccountTableMap::COL_PF_ESIC_CONTRIBUTION)) {
            $criteria->add(HrUserAccountTableMap::COL_PF_ESIC_CONTRIBUTION, $this->pf_esic_contribution);
        }
        if ($this->isColumnModified(HrUserAccountTableMap::COL_PF_NUMBER)) {
            $criteria->add(HrUserAccountTableMap::COL_PF_NUMBER, $this->pf_number);
        }
        if ($this->isColumnModified(HrUserAccountTableMap::COL_ESCI_NUMBER)) {
            $criteria->add(HrUserAccountTableMap::COL_ESCI_NUMBER, $this->esci_number);
        }
        if ($this->isColumnModified(HrUserAccountTableMap::COL_GROSS_SALARY)) {
            $criteria->add(HrUserAccountTableMap::COL_GROSS_SALARY, $this->gross_salary);
        }
        if ($this->isColumnModified(HrUserAccountTableMap::COL_PAYMENT_MODE)) {
            $criteria->add(HrUserAccountTableMap::COL_PAYMENT_MODE, $this->payment_mode);
        }
        if ($this->isColumnModified(HrUserAccountTableMap::COL_SALARY_BANK)) {
            $criteria->add(HrUserAccountTableMap::COL_SALARY_BANK, $this->salary_bank);
        }
        if ($this->isColumnModified(HrUserAccountTableMap::COL_SALARY_ACCOUNT_NUMBER)) {
            $criteria->add(HrUserAccountTableMap::COL_SALARY_ACCOUNT_NUMBER, $this->salary_account_number);
        }
        if ($this->isColumnModified(HrUserAccountTableMap::COL_TDS_STATUS)) {
            $criteria->add(HrUserAccountTableMap::COL_TDS_STATUS, $this->tds_status);
        }
        if ($this->isColumnModified(HrUserAccountTableMap::COL_CREATED_AT)) {
            $criteria->add(HrUserAccountTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(HrUserAccountTableMap::COL_UPDATED_AT)) {
            $criteria->add(HrUserAccountTableMap::COL_UPDATED_AT, $this->updated_at);
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
        $criteria = ChildHrUserAccountQuery::create();
        $criteria->add(HrUserAccountTableMap::COL_HRUA_ID, $this->hrua_id);

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
        $validPk = null !== $this->getHruaId();

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
        return $this->getHruaId();
    }

    /**
     * Generic method to set the primary key (hrua_id column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setHruaId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getHruaId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \entities\HrUserAccount (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setEmployeeId($this->getEmployeeId());
        $copyObj->setPersonalBank($this->getPersonalBank());
        $copyObj->setPersonalAccountNumber($this->getPersonalAccountNumber());
        $copyObj->setPfEsicContribution($this->getPfEsicContribution());
        $copyObj->setPfNumber($this->getPfNumber());
        $copyObj->setEsciNumber($this->getEsciNumber());
        $copyObj->setGrossSalary($this->getGrossSalary());
        $copyObj->setPaymentMode($this->getPaymentMode());
        $copyObj->setSalaryBank($this->getSalaryBank());
        $copyObj->setSalaryAccountNumber($this->getSalaryAccountNumber());
        $copyObj->setTdsStatus($this->getTdsStatus());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setHruaId(NULL); // this is a auto-increment column, so set to default value
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
     * @return \entities\HrUserAccount Clone of current object.
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
     * Declares an association between this object and a ChildEmployee object.
     *
     * @param ChildEmployee|null $v
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
            $v->addHrUserAccount($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildEmployee object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildEmployee|null The associated ChildEmployee object.
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
                $this->aEmployee->addHrUserAccounts($this);
             */
        }

        return $this->aEmployee;
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
        if (null !== $this->aEmployee) {
            $this->aEmployee->removeHrUserAccount($this);
        }
        $this->hrua_id = null;
        $this->employee_id = null;
        $this->personal_bank = null;
        $this->personal_account_number = null;
        $this->pf_esic_contribution = null;
        $this->pf_number = null;
        $this->esci_number = null;
        $this->gross_salary = null;
        $this->payment_mode = null;
        $this->salary_bank = null;
        $this->salary_account_number = null;
        $this->tds_status = null;
        $this->created_at = null;
        $this->updated_at = null;
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

        $this->aEmployee = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(HrUserAccountTableMap::DEFAULT_STRING_FORMAT);
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
