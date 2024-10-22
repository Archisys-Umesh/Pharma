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
use entities\Company as ChildCompany;
use entities\CompanyQuery as ChildCompanyQuery;
use entities\ExpenseList as ChildExpenseList;
use entities\ExpenseListDetails as ChildExpenseListDetails;
use entities\ExpenseListDetailsQuery as ChildExpenseListDetailsQuery;
use entities\ExpenseListQuery as ChildExpenseListQuery;
use entities\ExpenseMaster as ChildExpenseMaster;
use entities\ExpenseMasterQuery as ChildExpenseMasterQuery;
use entities\Expenses as ChildExpenses;
use entities\ExpensesQuery as ChildExpensesQuery;
use entities\Map\ExpenseListDetailsTableMap;
use entities\Map\ExpenseListTableMap;

/**
 * Base class that represents a row from the 'expense_list' table.
 *
 *
 *
 * @package    propel.generator.entities.Base
 */
abstract class ExpenseList implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\entities\\Map\\ExpenseListTableMap';


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
     * The value for the exp_list_id field.
     *
     * @var        int
     */
    protected $exp_list_id;

    /**
     * The value for the exp_id field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $exp_id;

    /**
     * The value for the exp_master_id field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $exp_master_id;

    /**
     * The value for the exp_note field.
     *
     * Note: this column has a database default value of: ''
     * @var        string|null
     */
    protected $exp_note;

    /**
     * The value for the exp_remark field.
     *
     * Note: this column has a database default value of: ''
     * @var        string|null
     */
    protected $exp_remark;

    /**
     * The value for the exp_audit_remark field.
     *
     * Note: this column has a database default value of: ''
     * @var        string|null
     */
    protected $exp_audit_remark;

    /**
     * The value for the exp_date field.
     *
     * @var        DateTime
     */
    protected $exp_date;

    /**
     * The value for the exp_tax_amount field.
     *
     * @var        string|null
     */
    protected $exp_tax_amount;

    /**
     * The value for the exp_claimed_tax field.
     *
     * @var        string|null
     */
    protected $exp_claimed_tax;

    /**
     * The value for the exp_test_amount field.
     *
     * Note: this column has a database default value of: '0.00'
     * @var        string|null
     */
    protected $exp_test_amount;

    /**
     * The value for the exp_rate_qty field.
     *
     * @var        string|null
     */
    protected $exp_rate_qty;

    /**
     * The value for the exp_rate_mode field.
     *
     * @var        string|null
     */
    protected $exp_rate_mode;

    /**
     * The value for the exp_il_amount field.
     *
     * Note: this column has a database default value of: '0.00'
     * @var        string|null
     */
    protected $exp_il_amount;

    /**
     * The value for the exp_req_amount field.
     *
     * @var        string|null
     */
    protected $exp_req_amount;

    /**
     * The value for the exp_apr_amount field.
     *
     * @var        string|null
     */
    protected $exp_apr_amount;

    /**
     * The value for the exp_audit_amount field.
     *
     * @var        string|null
     */
    protected $exp_audit_amount;

    /**
     * The value for the exp_final_amount field.
     *
     * @var        string
     */
    protected $exp_final_amount;

    /**
     * The value for the exp_policy_key field.
     *
     * @var        string
     */
    protected $exp_policy_key;

    /**
     * The value for the exp_limit1 field.
     *
     * @var        string
     */
    protected $exp_limit1;

    /**
     * The value for the employee_id field.
     *
     * @var        int
     */
    protected $employee_id;

    /**
     * The value for the cmp_card field.
     *
     * @var        int|null
     */
    protected $cmp_card;

    /**
     * The value for the company_id field.
     *
     * @var        int
     */
    protected $company_id;

    /**
     * The value for the is_readonly field.
     *
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $is_readonly;

    /**
     * @var        ChildCompany
     */
    protected $aCompany;

    /**
     * @var        ChildExpenseMaster
     */
    protected $aExpenseMaster;

    /**
     * @var        ChildExpenses
     */
    protected $aExpenses;

    /**
     * @var        ObjectCollection|ChildExpenseListDetails[] Collection to store aggregation of ChildExpenseListDetails objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildExpenseListDetails> Collection to store aggregation of ChildExpenseListDetails objects.
     */
    protected $collExpenseListDetailss;
    protected $collExpenseListDetailssPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildExpenseListDetails[]
     * @phpstan-var ObjectCollection&\Traversable<ChildExpenseListDetails>
     */
    protected $expenseListDetailssScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues(): void
    {
        $this->exp_id = 0;
        $this->exp_master_id = 0;
        $this->exp_note = '';
        $this->exp_remark = '';
        $this->exp_audit_remark = '';
        $this->exp_test_amount = '0.00';
        $this->exp_il_amount = '0.00';
        $this->is_readonly = false;
    }

    /**
     * Initializes internal state of entities\Base\ExpenseList object.
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
     * Compares this with another <code>ExpenseList</code> instance.  If
     * <code>obj</code> is an instance of <code>ExpenseList</code>, delegates to
     * <code>equals(ExpenseList)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [exp_list_id] column value.
     *
     * @return int
     */
    public function getExpListId()
    {
        return $this->exp_list_id;
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
     * Get the [exp_master_id] column value.
     *
     * @return int
     */
    public function getExpMasterId()
    {
        return $this->exp_master_id;
    }

    /**
     * Get the [exp_note] column value.
     *
     * @return string|null
     */
    public function getExpNote()
    {
        return $this->exp_note;
    }

    /**
     * Get the [exp_remark] column value.
     *
     * @return string|null
     */
    public function getExpRemark()
    {
        return $this->exp_remark;
    }

    /**
     * Get the [exp_audit_remark] column value.
     *
     * @return string|null
     */
    public function getExpAuditRemark()
    {
        return $this->exp_audit_remark;
    }

    /**
     * Get the [optionally formatted] temporal [exp_date] column value.
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
    public function getExpDate($format = null)
    {
        if ($format === null) {
            return $this->exp_date;
        } else {
            return $this->exp_date instanceof \DateTimeInterface ? $this->exp_date->format($format) : null;
        }
    }

    /**
     * Get the [exp_tax_amount] column value.
     *
     * @return string|null
     */
    public function getExpTaxAmount()
    {
        return $this->exp_tax_amount;
    }

    /**
     * Get the [exp_claimed_tax] column value.
     *
     * @return string|null
     */
    public function getExpClaimedTax()
    {
        return $this->exp_claimed_tax;
    }

    /**
     * Get the [exp_test_amount] column value.
     *
     * @return string|null
     */
    public function getExpTestAmount()
    {
        return $this->exp_test_amount;
    }

    /**
     * Get the [exp_rate_qty] column value.
     *
     * @return string|null
     */
    public function getExpRateQty()
    {
        return $this->exp_rate_qty;
    }

    /**
     * Get the [exp_rate_mode] column value.
     *
     * @return string|null
     */
    public function getExpRateMode()
    {
        return $this->exp_rate_mode;
    }

    /**
     * Get the [exp_il_amount] column value.
     *
     * @return string|null
     */
    public function getExpIlAmount()
    {
        return $this->exp_il_amount;
    }

    /**
     * Get the [exp_req_amount] column value.
     *
     * @return string|null
     */
    public function getExpReqAmount()
    {
        return $this->exp_req_amount;
    }

    /**
     * Get the [exp_apr_amount] column value.
     *
     * @return string|null
     */
    public function getExpAprAmount()
    {
        return $this->exp_apr_amount;
    }

    /**
     * Get the [exp_audit_amount] column value.
     *
     * @return string|null
     */
    public function getExpAuditAmount()
    {
        return $this->exp_audit_amount;
    }

    /**
     * Get the [exp_final_amount] column value.
     *
     * @return string
     */
    public function getExpFinalAmount()
    {
        return $this->exp_final_amount;
    }

    /**
     * Get the [exp_policy_key] column value.
     *
     * @return string
     */
    public function getExpPolicyKey()
    {
        return $this->exp_policy_key;
    }

    /**
     * Get the [exp_limit1] column value.
     *
     * @return string
     */
    public function getExpLimit1()
    {
        return $this->exp_limit1;
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
     * Get the [cmp_card] column value.
     *
     * @return int|null
     */
    public function getCmpCard()
    {
        return $this->cmp_card;
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
     * Get the [is_readonly] column value.
     *
     * @return boolean
     */
    public function getIsReadonly()
    {
        return $this->is_readonly;
    }

    /**
     * Get the [is_readonly] column value.
     *
     * @return boolean
     */
    public function isReadonly()
    {
        return $this->getIsReadonly();
    }

    /**
     * Set the value of [exp_list_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setExpListId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->exp_list_id !== $v) {
            $this->exp_list_id = $v;
            $this->modifiedColumns[ExpenseListTableMap::COL_EXP_LIST_ID] = true;
        }

        return $this;
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
            $this->modifiedColumns[ExpenseListTableMap::COL_EXP_ID] = true;
        }

        if ($this->aExpenses !== null && $this->aExpenses->getExpId() !== $v) {
            $this->aExpenses = null;
        }

        return $this;
    }

    /**
     * Set the value of [exp_master_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setExpMasterId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->exp_master_id !== $v) {
            $this->exp_master_id = $v;
            $this->modifiedColumns[ExpenseListTableMap::COL_EXP_MASTER_ID] = true;
        }

        if ($this->aExpenseMaster !== null && $this->aExpenseMaster->getExpenseId() !== $v) {
            $this->aExpenseMaster = null;
        }

        return $this;
    }

    /**
     * Set the value of [exp_note] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setExpNote($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->exp_note !== $v) {
            $this->exp_note = $v;
            $this->modifiedColumns[ExpenseListTableMap::COL_EXP_NOTE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [exp_remark] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setExpRemark($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->exp_remark !== $v) {
            $this->exp_remark = $v;
            $this->modifiedColumns[ExpenseListTableMap::COL_EXP_REMARK] = true;
        }

        return $this;
    }

    /**
     * Set the value of [exp_audit_remark] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setExpAuditRemark($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->exp_audit_remark !== $v) {
            $this->exp_audit_remark = $v;
            $this->modifiedColumns[ExpenseListTableMap::COL_EXP_AUDIT_REMARK] = true;
        }

        return $this;
    }

    /**
     * Sets the value of [exp_date] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setExpDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->exp_date !== null || $dt !== null) {
            if ($this->exp_date === null || $dt === null || $dt->format("Y-m-d") !== $this->exp_date->format("Y-m-d")) {
                $this->exp_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[ExpenseListTableMap::COL_EXP_DATE] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [exp_tax_amount] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setExpTaxAmount($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->exp_tax_amount !== $v) {
            $this->exp_tax_amount = $v;
            $this->modifiedColumns[ExpenseListTableMap::COL_EXP_TAX_AMOUNT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [exp_claimed_tax] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setExpClaimedTax($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->exp_claimed_tax !== $v) {
            $this->exp_claimed_tax = $v;
            $this->modifiedColumns[ExpenseListTableMap::COL_EXP_CLAIMED_TAX] = true;
        }

        return $this;
    }

    /**
     * Set the value of [exp_test_amount] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setExpTestAmount($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->exp_test_amount !== $v) {
            $this->exp_test_amount = $v;
            $this->modifiedColumns[ExpenseListTableMap::COL_EXP_TEST_AMOUNT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [exp_rate_qty] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setExpRateQty($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->exp_rate_qty !== $v) {
            $this->exp_rate_qty = $v;
            $this->modifiedColumns[ExpenseListTableMap::COL_EXP_RATE_QTY] = true;
        }

        return $this;
    }

    /**
     * Set the value of [exp_rate_mode] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setExpRateMode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->exp_rate_mode !== $v) {
            $this->exp_rate_mode = $v;
            $this->modifiedColumns[ExpenseListTableMap::COL_EXP_RATE_MODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [exp_il_amount] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setExpIlAmount($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->exp_il_amount !== $v) {
            $this->exp_il_amount = $v;
            $this->modifiedColumns[ExpenseListTableMap::COL_EXP_IL_AMOUNT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [exp_req_amount] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setExpReqAmount($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->exp_req_amount !== $v) {
            $this->exp_req_amount = $v;
            $this->modifiedColumns[ExpenseListTableMap::COL_EXP_REQ_AMOUNT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [exp_apr_amount] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setExpAprAmount($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->exp_apr_amount !== $v) {
            $this->exp_apr_amount = $v;
            $this->modifiedColumns[ExpenseListTableMap::COL_EXP_APR_AMOUNT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [exp_audit_amount] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setExpAuditAmount($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->exp_audit_amount !== $v) {
            $this->exp_audit_amount = $v;
            $this->modifiedColumns[ExpenseListTableMap::COL_EXP_AUDIT_AMOUNT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [exp_final_amount] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setExpFinalAmount($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->exp_final_amount !== $v) {
            $this->exp_final_amount = $v;
            $this->modifiedColumns[ExpenseListTableMap::COL_EXP_FINAL_AMOUNT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [exp_policy_key] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setExpPolicyKey($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->exp_policy_key !== $v) {
            $this->exp_policy_key = $v;
            $this->modifiedColumns[ExpenseListTableMap::COL_EXP_POLICY_KEY] = true;
        }

        return $this;
    }

    /**
     * Set the value of [exp_limit1] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setExpLimit1($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->exp_limit1 !== $v) {
            $this->exp_limit1 = $v;
            $this->modifiedColumns[ExpenseListTableMap::COL_EXP_LIMIT1] = true;
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
            $this->modifiedColumns[ExpenseListTableMap::COL_EMPLOYEE_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [cmp_card] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCmpCard($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->cmp_card !== $v) {
            $this->cmp_card = $v;
            $this->modifiedColumns[ExpenseListTableMap::COL_CMP_CARD] = true;
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
            $this->modifiedColumns[ExpenseListTableMap::COL_COMPANY_ID] = true;
        }

        if ($this->aCompany !== null && $this->aCompany->getCompanyId() !== $v) {
            $this->aCompany = null;
        }

        return $this;
    }

    /**
     * Sets the value of the [is_readonly] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param bool|integer|string $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setIsReadonly($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->is_readonly !== $v) {
            $this->is_readonly = $v;
            $this->modifiedColumns[ExpenseListTableMap::COL_IS_READONLY] = true;
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
            if ($this->exp_id !== 0) {
                return false;
            }

            if ($this->exp_master_id !== 0) {
                return false;
            }

            if ($this->exp_note !== '') {
                return false;
            }

            if ($this->exp_remark !== '') {
                return false;
            }

            if ($this->exp_audit_remark !== '') {
                return false;
            }

            if ($this->exp_test_amount !== '0.00') {
                return false;
            }

            if ($this->exp_il_amount !== '0.00') {
                return false;
            }

            if ($this->is_readonly !== false) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : ExpenseListTableMap::translateFieldName('ExpListId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->exp_list_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : ExpenseListTableMap::translateFieldName('ExpId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->exp_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : ExpenseListTableMap::translateFieldName('ExpMasterId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->exp_master_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : ExpenseListTableMap::translateFieldName('ExpNote', TableMap::TYPE_PHPNAME, $indexType)];
            $this->exp_note = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : ExpenseListTableMap::translateFieldName('ExpRemark', TableMap::TYPE_PHPNAME, $indexType)];
            $this->exp_remark = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : ExpenseListTableMap::translateFieldName('ExpAuditRemark', TableMap::TYPE_PHPNAME, $indexType)];
            $this->exp_audit_remark = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : ExpenseListTableMap::translateFieldName('ExpDate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->exp_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : ExpenseListTableMap::translateFieldName('ExpTaxAmount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->exp_tax_amount = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : ExpenseListTableMap::translateFieldName('ExpClaimedTax', TableMap::TYPE_PHPNAME, $indexType)];
            $this->exp_claimed_tax = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : ExpenseListTableMap::translateFieldName('ExpTestAmount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->exp_test_amount = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : ExpenseListTableMap::translateFieldName('ExpRateQty', TableMap::TYPE_PHPNAME, $indexType)];
            $this->exp_rate_qty = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : ExpenseListTableMap::translateFieldName('ExpRateMode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->exp_rate_mode = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : ExpenseListTableMap::translateFieldName('ExpIlAmount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->exp_il_amount = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : ExpenseListTableMap::translateFieldName('ExpReqAmount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->exp_req_amount = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : ExpenseListTableMap::translateFieldName('ExpAprAmount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->exp_apr_amount = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : ExpenseListTableMap::translateFieldName('ExpAuditAmount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->exp_audit_amount = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : ExpenseListTableMap::translateFieldName('ExpFinalAmount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->exp_final_amount = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : ExpenseListTableMap::translateFieldName('ExpPolicyKey', TableMap::TYPE_PHPNAME, $indexType)];
            $this->exp_policy_key = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 18 + $startcol : ExpenseListTableMap::translateFieldName('ExpLimit1', TableMap::TYPE_PHPNAME, $indexType)];
            $this->exp_limit1 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 19 + $startcol : ExpenseListTableMap::translateFieldName('EmployeeId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->employee_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 20 + $startcol : ExpenseListTableMap::translateFieldName('CmpCard', TableMap::TYPE_PHPNAME, $indexType)];
            $this->cmp_card = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 21 + $startcol : ExpenseListTableMap::translateFieldName('CompanyId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->company_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 22 + $startcol : ExpenseListTableMap::translateFieldName('IsReadonly', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_readonly = (null !== $col) ? (boolean) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 23; // 23 = ExpenseListTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\entities\\ExpenseList'), 0, $e);
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
        if ($this->aExpenses !== null && $this->exp_id !== $this->aExpenses->getExpId()) {
            $this->aExpenses = null;
        }
        if ($this->aExpenseMaster !== null && $this->exp_master_id !== $this->aExpenseMaster->getExpenseId()) {
            $this->aExpenseMaster = null;
        }
        if ($this->aCompany !== null && $this->company_id !== $this->aCompany->getCompanyId()) {
            $this->aCompany = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(ExpenseListTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildExpenseListQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aCompany = null;
            $this->aExpenseMaster = null;
            $this->aExpenses = null;
            $this->collExpenseListDetailss = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see ExpenseList::setDeleted()
     * @see ExpenseList::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(ExpenseListTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildExpenseListQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(ExpenseListTableMap::DATABASE_NAME);
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
                ExpenseListTableMap::addInstanceToPool($this);
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

            if ($this->aExpenseMaster !== null) {
                if ($this->aExpenseMaster->isModified() || $this->aExpenseMaster->isNew()) {
                    $affectedRows += $this->aExpenseMaster->save($con);
                }
                $this->setExpenseMaster($this->aExpenseMaster);
            }

            if ($this->aExpenses !== null) {
                if ($this->aExpenses->isModified() || $this->aExpenses->isNew()) {
                    $affectedRows += $this->aExpenses->save($con);
                }
                $this->setExpenses($this->aExpenses);
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

            if ($this->expenseListDetailssScheduledForDeletion !== null) {
                if (!$this->expenseListDetailssScheduledForDeletion->isEmpty()) {
                    \entities\ExpenseListDetailsQuery::create()
                        ->filterByPrimaryKeys($this->expenseListDetailssScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->expenseListDetailssScheduledForDeletion = null;
                }
            }

            if ($this->collExpenseListDetailss !== null) {
                foreach ($this->collExpenseListDetailss as $referrerFK) {
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

        $this->modifiedColumns[ExpenseListTableMap::COL_EXP_LIST_ID] = true;
        if (null !== $this->exp_list_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . ExpenseListTableMap::COL_EXP_LIST_ID . ')');
        }
        if (null === $this->exp_list_id) {
            try {
                $dataFetcher = $con->query("SELECT nextval('expense_list_exp_list_id_seq')");
                $this->exp_list_id = (int) $dataFetcher->fetchColumn();
            } catch (Exception $e) {
                throw new PropelException('Unable to get sequence id.', 0, $e);
            }
        }


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(ExpenseListTableMap::COL_EXP_LIST_ID)) {
            $modifiedColumns[':p' . $index++]  = 'exp_list_id';
        }
        if ($this->isColumnModified(ExpenseListTableMap::COL_EXP_ID)) {
            $modifiedColumns[':p' . $index++]  = 'exp_id';
        }
        if ($this->isColumnModified(ExpenseListTableMap::COL_EXP_MASTER_ID)) {
            $modifiedColumns[':p' . $index++]  = 'exp_master_id';
        }
        if ($this->isColumnModified(ExpenseListTableMap::COL_EXP_NOTE)) {
            $modifiedColumns[':p' . $index++]  = 'exp_note';
        }
        if ($this->isColumnModified(ExpenseListTableMap::COL_EXP_REMARK)) {
            $modifiedColumns[':p' . $index++]  = 'exp_remark';
        }
        if ($this->isColumnModified(ExpenseListTableMap::COL_EXP_AUDIT_REMARK)) {
            $modifiedColumns[':p' . $index++]  = 'exp_audit_remark';
        }
        if ($this->isColumnModified(ExpenseListTableMap::COL_EXP_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'exp_date';
        }
        if ($this->isColumnModified(ExpenseListTableMap::COL_EXP_TAX_AMOUNT)) {
            $modifiedColumns[':p' . $index++]  = 'exp_tax_amount';
        }
        if ($this->isColumnModified(ExpenseListTableMap::COL_EXP_CLAIMED_TAX)) {
            $modifiedColumns[':p' . $index++]  = 'exp_claimed_tax';
        }
        if ($this->isColumnModified(ExpenseListTableMap::COL_EXP_TEST_AMOUNT)) {
            $modifiedColumns[':p' . $index++]  = 'exp_test_amount';
        }
        if ($this->isColumnModified(ExpenseListTableMap::COL_EXP_RATE_QTY)) {
            $modifiedColumns[':p' . $index++]  = 'exp_rate_qty';
        }
        if ($this->isColumnModified(ExpenseListTableMap::COL_EXP_RATE_MODE)) {
            $modifiedColumns[':p' . $index++]  = 'exp_rate_mode';
        }
        if ($this->isColumnModified(ExpenseListTableMap::COL_EXP_IL_AMOUNT)) {
            $modifiedColumns[':p' . $index++]  = 'exp_il_amount';
        }
        if ($this->isColumnModified(ExpenseListTableMap::COL_EXP_REQ_AMOUNT)) {
            $modifiedColumns[':p' . $index++]  = 'exp_req_amount';
        }
        if ($this->isColumnModified(ExpenseListTableMap::COL_EXP_APR_AMOUNT)) {
            $modifiedColumns[':p' . $index++]  = 'exp_apr_amount';
        }
        if ($this->isColumnModified(ExpenseListTableMap::COL_EXP_AUDIT_AMOUNT)) {
            $modifiedColumns[':p' . $index++]  = 'exp_audit_amount';
        }
        if ($this->isColumnModified(ExpenseListTableMap::COL_EXP_FINAL_AMOUNT)) {
            $modifiedColumns[':p' . $index++]  = 'exp_final_amount';
        }
        if ($this->isColumnModified(ExpenseListTableMap::COL_EXP_POLICY_KEY)) {
            $modifiedColumns[':p' . $index++]  = 'exp_policy_key';
        }
        if ($this->isColumnModified(ExpenseListTableMap::COL_EXP_LIMIT1)) {
            $modifiedColumns[':p' . $index++]  = 'exp_limit1';
        }
        if ($this->isColumnModified(ExpenseListTableMap::COL_EMPLOYEE_ID)) {
            $modifiedColumns[':p' . $index++]  = 'employee_id';
        }
        if ($this->isColumnModified(ExpenseListTableMap::COL_CMP_CARD)) {
            $modifiedColumns[':p' . $index++]  = 'cmp_card';
        }
        if ($this->isColumnModified(ExpenseListTableMap::COL_COMPANY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'company_id';
        }
        if ($this->isColumnModified(ExpenseListTableMap::COL_IS_READONLY)) {
            $modifiedColumns[':p' . $index++]  = 'is_readonly';
        }

        $sql = sprintf(
            'INSERT INTO expense_list (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'exp_list_id':
                        $stmt->bindValue($identifier, $this->exp_list_id, PDO::PARAM_INT);

                        break;
                    case 'exp_id':
                        $stmt->bindValue($identifier, $this->exp_id, PDO::PARAM_INT);

                        break;
                    case 'exp_master_id':
                        $stmt->bindValue($identifier, $this->exp_master_id, PDO::PARAM_INT);

                        break;
                    case 'exp_note':
                        $stmt->bindValue($identifier, $this->exp_note, PDO::PARAM_STR);

                        break;
                    case 'exp_remark':
                        $stmt->bindValue($identifier, $this->exp_remark, PDO::PARAM_STR);

                        break;
                    case 'exp_audit_remark':
                        $stmt->bindValue($identifier, $this->exp_audit_remark, PDO::PARAM_STR);

                        break;
                    case 'exp_date':
                        $stmt->bindValue($identifier, $this->exp_date ? $this->exp_date->format("Y-m-d") : null, PDO::PARAM_STR);

                        break;
                    case 'exp_tax_amount':
                        $stmt->bindValue($identifier, $this->exp_tax_amount, PDO::PARAM_STR);

                        break;
                    case 'exp_claimed_tax':
                        $stmt->bindValue($identifier, $this->exp_claimed_tax, PDO::PARAM_STR);

                        break;
                    case 'exp_test_amount':
                        $stmt->bindValue($identifier, $this->exp_test_amount, PDO::PARAM_STR);

                        break;
                    case 'exp_rate_qty':
                        $stmt->bindValue($identifier, $this->exp_rate_qty, PDO::PARAM_STR);

                        break;
                    case 'exp_rate_mode':
                        $stmt->bindValue($identifier, $this->exp_rate_mode, PDO::PARAM_STR);

                        break;
                    case 'exp_il_amount':
                        $stmt->bindValue($identifier, $this->exp_il_amount, PDO::PARAM_STR);

                        break;
                    case 'exp_req_amount':
                        $stmt->bindValue($identifier, $this->exp_req_amount, PDO::PARAM_STR);

                        break;
                    case 'exp_apr_amount':
                        $stmt->bindValue($identifier, $this->exp_apr_amount, PDO::PARAM_STR);

                        break;
                    case 'exp_audit_amount':
                        $stmt->bindValue($identifier, $this->exp_audit_amount, PDO::PARAM_STR);

                        break;
                    case 'exp_final_amount':
                        $stmt->bindValue($identifier, $this->exp_final_amount, PDO::PARAM_STR);

                        break;
                    case 'exp_policy_key':
                        $stmt->bindValue($identifier, $this->exp_policy_key, PDO::PARAM_STR);

                        break;
                    case 'exp_limit1':
                        $stmt->bindValue($identifier, $this->exp_limit1, PDO::PARAM_STR);

                        break;
                    case 'employee_id':
                        $stmt->bindValue($identifier, $this->employee_id, PDO::PARAM_INT);

                        break;
                    case 'cmp_card':
                        $stmt->bindValue($identifier, $this->cmp_card, PDO::PARAM_INT);

                        break;
                    case 'company_id':
                        $stmt->bindValue($identifier, $this->company_id, PDO::PARAM_INT);

                        break;
                    case 'is_readonly':
                        $stmt->bindValue($identifier, $this->is_readonly, PDO::PARAM_BOOL);

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
        $pos = ExpenseListTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getExpListId();

            case 1:
                return $this->getExpId();

            case 2:
                return $this->getExpMasterId();

            case 3:
                return $this->getExpNote();

            case 4:
                return $this->getExpRemark();

            case 5:
                return $this->getExpAuditRemark();

            case 6:
                return $this->getExpDate();

            case 7:
                return $this->getExpTaxAmount();

            case 8:
                return $this->getExpClaimedTax();

            case 9:
                return $this->getExpTestAmount();

            case 10:
                return $this->getExpRateQty();

            case 11:
                return $this->getExpRateMode();

            case 12:
                return $this->getExpIlAmount();

            case 13:
                return $this->getExpReqAmount();

            case 14:
                return $this->getExpAprAmount();

            case 15:
                return $this->getExpAuditAmount();

            case 16:
                return $this->getExpFinalAmount();

            case 17:
                return $this->getExpPolicyKey();

            case 18:
                return $this->getExpLimit1();

            case 19:
                return $this->getEmployeeId();

            case 20:
                return $this->getCmpCard();

            case 21:
                return $this->getCompanyId();

            case 22:
                return $this->getIsReadonly();

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
        if (isset($alreadyDumpedObjects['ExpenseList'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['ExpenseList'][$this->hashCode()] = true;
        $keys = ExpenseListTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getExpListId(),
            $keys[1] => $this->getExpId(),
            $keys[2] => $this->getExpMasterId(),
            $keys[3] => $this->getExpNote(),
            $keys[4] => $this->getExpRemark(),
            $keys[5] => $this->getExpAuditRemark(),
            $keys[6] => $this->getExpDate(),
            $keys[7] => $this->getExpTaxAmount(),
            $keys[8] => $this->getExpClaimedTax(),
            $keys[9] => $this->getExpTestAmount(),
            $keys[10] => $this->getExpRateQty(),
            $keys[11] => $this->getExpRateMode(),
            $keys[12] => $this->getExpIlAmount(),
            $keys[13] => $this->getExpReqAmount(),
            $keys[14] => $this->getExpAprAmount(),
            $keys[15] => $this->getExpAuditAmount(),
            $keys[16] => $this->getExpFinalAmount(),
            $keys[17] => $this->getExpPolicyKey(),
            $keys[18] => $this->getExpLimit1(),
            $keys[19] => $this->getEmployeeId(),
            $keys[20] => $this->getCmpCard(),
            $keys[21] => $this->getCompanyId(),
            $keys[22] => $this->getIsReadonly(),
        ];
        if ($result[$keys[6]] instanceof \DateTimeInterface) {
            $result[$keys[6]] = $result[$keys[6]]->format('Y-m-d');
        }

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
            if (null !== $this->aExpenseMaster) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'expenseMaster';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'expense_master';
                        break;
                    default:
                        $key = 'ExpenseMaster';
                }

                $result[$key] = $this->aExpenseMaster->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aExpenses) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'expenses';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'expenses';
                        break;
                    default:
                        $key = 'Expenses';
                }

                $result[$key] = $this->aExpenses->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collExpenseListDetailss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'expenseListDetailss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'expense_list_detailss';
                        break;
                    default:
                        $key = 'ExpenseListDetailss';
                }

                $result[$key] = $this->collExpenseListDetailss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = ExpenseListTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setExpListId($value);
                break;
            case 1:
                $this->setExpId($value);
                break;
            case 2:
                $this->setExpMasterId($value);
                break;
            case 3:
                $this->setExpNote($value);
                break;
            case 4:
                $this->setExpRemark($value);
                break;
            case 5:
                $this->setExpAuditRemark($value);
                break;
            case 6:
                $this->setExpDate($value);
                break;
            case 7:
                $this->setExpTaxAmount($value);
                break;
            case 8:
                $this->setExpClaimedTax($value);
                break;
            case 9:
                $this->setExpTestAmount($value);
                break;
            case 10:
                $this->setExpRateQty($value);
                break;
            case 11:
                $this->setExpRateMode($value);
                break;
            case 12:
                $this->setExpIlAmount($value);
                break;
            case 13:
                $this->setExpReqAmount($value);
                break;
            case 14:
                $this->setExpAprAmount($value);
                break;
            case 15:
                $this->setExpAuditAmount($value);
                break;
            case 16:
                $this->setExpFinalAmount($value);
                break;
            case 17:
                $this->setExpPolicyKey($value);
                break;
            case 18:
                $this->setExpLimit1($value);
                break;
            case 19:
                $this->setEmployeeId($value);
                break;
            case 20:
                $this->setCmpCard($value);
                break;
            case 21:
                $this->setCompanyId($value);
                break;
            case 22:
                $this->setIsReadonly($value);
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
        $keys = ExpenseListTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setExpListId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setExpId($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setExpMasterId($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setExpNote($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setExpRemark($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setExpAuditRemark($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setExpDate($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setExpTaxAmount($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setExpClaimedTax($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setExpTestAmount($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setExpRateQty($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setExpRateMode($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setExpIlAmount($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setExpReqAmount($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setExpAprAmount($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setExpAuditAmount($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setExpFinalAmount($arr[$keys[16]]);
        }
        if (array_key_exists($keys[17], $arr)) {
            $this->setExpPolicyKey($arr[$keys[17]]);
        }
        if (array_key_exists($keys[18], $arr)) {
            $this->setExpLimit1($arr[$keys[18]]);
        }
        if (array_key_exists($keys[19], $arr)) {
            $this->setEmployeeId($arr[$keys[19]]);
        }
        if (array_key_exists($keys[20], $arr)) {
            $this->setCmpCard($arr[$keys[20]]);
        }
        if (array_key_exists($keys[21], $arr)) {
            $this->setCompanyId($arr[$keys[21]]);
        }
        if (array_key_exists($keys[22], $arr)) {
            $this->setIsReadonly($arr[$keys[22]]);
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
        $criteria = new Criteria(ExpenseListTableMap::DATABASE_NAME);

        if ($this->isColumnModified(ExpenseListTableMap::COL_EXP_LIST_ID)) {
            $criteria->add(ExpenseListTableMap::COL_EXP_LIST_ID, $this->exp_list_id);
        }
        if ($this->isColumnModified(ExpenseListTableMap::COL_EXP_ID)) {
            $criteria->add(ExpenseListTableMap::COL_EXP_ID, $this->exp_id);
        }
        if ($this->isColumnModified(ExpenseListTableMap::COL_EXP_MASTER_ID)) {
            $criteria->add(ExpenseListTableMap::COL_EXP_MASTER_ID, $this->exp_master_id);
        }
        if ($this->isColumnModified(ExpenseListTableMap::COL_EXP_NOTE)) {
            $criteria->add(ExpenseListTableMap::COL_EXP_NOTE, $this->exp_note);
        }
        if ($this->isColumnModified(ExpenseListTableMap::COL_EXP_REMARK)) {
            $criteria->add(ExpenseListTableMap::COL_EXP_REMARK, $this->exp_remark);
        }
        if ($this->isColumnModified(ExpenseListTableMap::COL_EXP_AUDIT_REMARK)) {
            $criteria->add(ExpenseListTableMap::COL_EXP_AUDIT_REMARK, $this->exp_audit_remark);
        }
        if ($this->isColumnModified(ExpenseListTableMap::COL_EXP_DATE)) {
            $criteria->add(ExpenseListTableMap::COL_EXP_DATE, $this->exp_date);
        }
        if ($this->isColumnModified(ExpenseListTableMap::COL_EXP_TAX_AMOUNT)) {
            $criteria->add(ExpenseListTableMap::COL_EXP_TAX_AMOUNT, $this->exp_tax_amount);
        }
        if ($this->isColumnModified(ExpenseListTableMap::COL_EXP_CLAIMED_TAX)) {
            $criteria->add(ExpenseListTableMap::COL_EXP_CLAIMED_TAX, $this->exp_claimed_tax);
        }
        if ($this->isColumnModified(ExpenseListTableMap::COL_EXP_TEST_AMOUNT)) {
            $criteria->add(ExpenseListTableMap::COL_EXP_TEST_AMOUNT, $this->exp_test_amount);
        }
        if ($this->isColumnModified(ExpenseListTableMap::COL_EXP_RATE_QTY)) {
            $criteria->add(ExpenseListTableMap::COL_EXP_RATE_QTY, $this->exp_rate_qty);
        }
        if ($this->isColumnModified(ExpenseListTableMap::COL_EXP_RATE_MODE)) {
            $criteria->add(ExpenseListTableMap::COL_EXP_RATE_MODE, $this->exp_rate_mode);
        }
        if ($this->isColumnModified(ExpenseListTableMap::COL_EXP_IL_AMOUNT)) {
            $criteria->add(ExpenseListTableMap::COL_EXP_IL_AMOUNT, $this->exp_il_amount);
        }
        if ($this->isColumnModified(ExpenseListTableMap::COL_EXP_REQ_AMOUNT)) {
            $criteria->add(ExpenseListTableMap::COL_EXP_REQ_AMOUNT, $this->exp_req_amount);
        }
        if ($this->isColumnModified(ExpenseListTableMap::COL_EXP_APR_AMOUNT)) {
            $criteria->add(ExpenseListTableMap::COL_EXP_APR_AMOUNT, $this->exp_apr_amount);
        }
        if ($this->isColumnModified(ExpenseListTableMap::COL_EXP_AUDIT_AMOUNT)) {
            $criteria->add(ExpenseListTableMap::COL_EXP_AUDIT_AMOUNT, $this->exp_audit_amount);
        }
        if ($this->isColumnModified(ExpenseListTableMap::COL_EXP_FINAL_AMOUNT)) {
            $criteria->add(ExpenseListTableMap::COL_EXP_FINAL_AMOUNT, $this->exp_final_amount);
        }
        if ($this->isColumnModified(ExpenseListTableMap::COL_EXP_POLICY_KEY)) {
            $criteria->add(ExpenseListTableMap::COL_EXP_POLICY_KEY, $this->exp_policy_key);
        }
        if ($this->isColumnModified(ExpenseListTableMap::COL_EXP_LIMIT1)) {
            $criteria->add(ExpenseListTableMap::COL_EXP_LIMIT1, $this->exp_limit1);
        }
        if ($this->isColumnModified(ExpenseListTableMap::COL_EMPLOYEE_ID)) {
            $criteria->add(ExpenseListTableMap::COL_EMPLOYEE_ID, $this->employee_id);
        }
        if ($this->isColumnModified(ExpenseListTableMap::COL_CMP_CARD)) {
            $criteria->add(ExpenseListTableMap::COL_CMP_CARD, $this->cmp_card);
        }
        if ($this->isColumnModified(ExpenseListTableMap::COL_COMPANY_ID)) {
            $criteria->add(ExpenseListTableMap::COL_COMPANY_ID, $this->company_id);
        }
        if ($this->isColumnModified(ExpenseListTableMap::COL_IS_READONLY)) {
            $criteria->add(ExpenseListTableMap::COL_IS_READONLY, $this->is_readonly);
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
        $criteria = ChildExpenseListQuery::create();
        $criteria->add(ExpenseListTableMap::COL_EXP_LIST_ID, $this->exp_list_id);

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
        $validPk = null !== $this->getExpListId();

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
        return $this->getExpListId();
    }

    /**
     * Generic method to set the primary key (exp_list_id column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setExpListId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getExpListId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \entities\ExpenseList (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setExpId($this->getExpId());
        $copyObj->setExpMasterId($this->getExpMasterId());
        $copyObj->setExpNote($this->getExpNote());
        $copyObj->setExpRemark($this->getExpRemark());
        $copyObj->setExpAuditRemark($this->getExpAuditRemark());
        $copyObj->setExpDate($this->getExpDate());
        $copyObj->setExpTaxAmount($this->getExpTaxAmount());
        $copyObj->setExpClaimedTax($this->getExpClaimedTax());
        $copyObj->setExpTestAmount($this->getExpTestAmount());
        $copyObj->setExpRateQty($this->getExpRateQty());
        $copyObj->setExpRateMode($this->getExpRateMode());
        $copyObj->setExpIlAmount($this->getExpIlAmount());
        $copyObj->setExpReqAmount($this->getExpReqAmount());
        $copyObj->setExpAprAmount($this->getExpAprAmount());
        $copyObj->setExpAuditAmount($this->getExpAuditAmount());
        $copyObj->setExpFinalAmount($this->getExpFinalAmount());
        $copyObj->setExpPolicyKey($this->getExpPolicyKey());
        $copyObj->setExpLimit1($this->getExpLimit1());
        $copyObj->setEmployeeId($this->getEmployeeId());
        $copyObj->setCmpCard($this->getCmpCard());
        $copyObj->setCompanyId($this->getCompanyId());
        $copyObj->setIsReadonly($this->getIsReadonly());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getExpenseListDetailss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addExpenseListDetails($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setExpListId(NULL); // this is a auto-increment column, so set to default value
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
     * @return \entities\ExpenseList Clone of current object.
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
            $v->addExpenseList($this);
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
                $this->aCompany->addExpenseLists($this);
             */
        }

        return $this->aCompany;
    }

    /**
     * Declares an association between this object and a ChildExpenseMaster object.
     *
     * @param ChildExpenseMaster $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setExpenseMaster(ChildExpenseMaster $v = null)
    {
        if ($v === null) {
            $this->setExpMasterId(0);
        } else {
            $this->setExpMasterId($v->getExpenseId());
        }

        $this->aExpenseMaster = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildExpenseMaster object, it will not be re-added.
        if ($v !== null) {
            $v->addExpenseList($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildExpenseMaster object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildExpenseMaster The associated ChildExpenseMaster object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getExpenseMaster(?ConnectionInterface $con = null)
    {
        if ($this->aExpenseMaster === null && ($this->exp_master_id != 0)) {
            $this->aExpenseMaster = ChildExpenseMasterQuery::create()->findPk($this->exp_master_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aExpenseMaster->addExpenseLists($this);
             */
        }

        return $this->aExpenseMaster;
    }

    /**
     * Declares an association between this object and a ChildExpenses object.
     *
     * @param ChildExpenses $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setExpenses(ChildExpenses $v = null)
    {
        if ($v === null) {
            $this->setExpId(0);
        } else {
            $this->setExpId($v->getExpId());
        }

        $this->aExpenses = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildExpenses object, it will not be re-added.
        if ($v !== null) {
            $v->addExpenseList($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildExpenses object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildExpenses The associated ChildExpenses object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getExpenses(?ConnectionInterface $con = null)
    {
        if ($this->aExpenses === null && ($this->exp_id != 0)) {
            $this->aExpenses = ChildExpensesQuery::create()->findPk($this->exp_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aExpenses->addExpenseLists($this);
             */
        }

        return $this->aExpenses;
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
        if ('ExpenseListDetails' === $relationName) {
            $this->initExpenseListDetailss();
            return;
        }
    }

    /**
     * Clears out the collExpenseListDetailss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addExpenseListDetailss()
     */
    public function clearExpenseListDetailss()
    {
        $this->collExpenseListDetailss = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collExpenseListDetailss collection loaded partially.
     *
     * @return void
     */
    public function resetPartialExpenseListDetailss($v = true): void
    {
        $this->collExpenseListDetailssPartial = $v;
    }

    /**
     * Initializes the collExpenseListDetailss collection.
     *
     * By default this just sets the collExpenseListDetailss collection to an empty array (like clearcollExpenseListDetailss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initExpenseListDetailss(bool $overrideExisting = true): void
    {
        if (null !== $this->collExpenseListDetailss && !$overrideExisting) {
            return;
        }

        $collectionClassName = ExpenseListDetailsTableMap::getTableMap()->getCollectionClassName();

        $this->collExpenseListDetailss = new $collectionClassName;
        $this->collExpenseListDetailss->setModel('\entities\ExpenseListDetails');
    }

    /**
     * Gets an array of ChildExpenseListDetails objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildExpenseList is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildExpenseListDetails[] List of ChildExpenseListDetails objects
     * @phpstan-return ObjectCollection&\Traversable<ChildExpenseListDetails> List of ChildExpenseListDetails objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getExpenseListDetailss(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collExpenseListDetailssPartial && !$this->isNew();
        if (null === $this->collExpenseListDetailss || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collExpenseListDetailss) {
                    $this->initExpenseListDetailss();
                } else {
                    $collectionClassName = ExpenseListDetailsTableMap::getTableMap()->getCollectionClassName();

                    $collExpenseListDetailss = new $collectionClassName;
                    $collExpenseListDetailss->setModel('\entities\ExpenseListDetails');

                    return $collExpenseListDetailss;
                }
            } else {
                $collExpenseListDetailss = ChildExpenseListDetailsQuery::create(null, $criteria)
                    ->filterByExpenseList($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collExpenseListDetailssPartial && count($collExpenseListDetailss)) {
                        $this->initExpenseListDetailss(false);

                        foreach ($collExpenseListDetailss as $obj) {
                            if (false == $this->collExpenseListDetailss->contains($obj)) {
                                $this->collExpenseListDetailss->append($obj);
                            }
                        }

                        $this->collExpenseListDetailssPartial = true;
                    }

                    return $collExpenseListDetailss;
                }

                if ($partial && $this->collExpenseListDetailss) {
                    foreach ($this->collExpenseListDetailss as $obj) {
                        if ($obj->isNew()) {
                            $collExpenseListDetailss[] = $obj;
                        }
                    }
                }

                $this->collExpenseListDetailss = $collExpenseListDetailss;
                $this->collExpenseListDetailssPartial = false;
            }
        }

        return $this->collExpenseListDetailss;
    }

    /**
     * Sets a collection of ChildExpenseListDetails objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $expenseListDetailss A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setExpenseListDetailss(Collection $expenseListDetailss, ?ConnectionInterface $con = null)
    {
        /** @var ChildExpenseListDetails[] $expenseListDetailssToDelete */
        $expenseListDetailssToDelete = $this->getExpenseListDetailss(new Criteria(), $con)->diff($expenseListDetailss);


        $this->expenseListDetailssScheduledForDeletion = $expenseListDetailssToDelete;

        foreach ($expenseListDetailssToDelete as $expenseListDetailsRemoved) {
            $expenseListDetailsRemoved->setExpenseList(null);
        }

        $this->collExpenseListDetailss = null;
        foreach ($expenseListDetailss as $expenseListDetails) {
            $this->addExpenseListDetails($expenseListDetails);
        }

        $this->collExpenseListDetailss = $expenseListDetailss;
        $this->collExpenseListDetailssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related ExpenseListDetails objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related ExpenseListDetails objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countExpenseListDetailss(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collExpenseListDetailssPartial && !$this->isNew();
        if (null === $this->collExpenseListDetailss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collExpenseListDetailss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getExpenseListDetailss());
            }

            $query = ChildExpenseListDetailsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByExpenseList($this)
                ->count($con);
        }

        return count($this->collExpenseListDetailss);
    }

    /**
     * Method called to associate a ChildExpenseListDetails object to this object
     * through the ChildExpenseListDetails foreign key attribute.
     *
     * @param ChildExpenseListDetails $l ChildExpenseListDetails
     * @return $this The current object (for fluent API support)
     */
    public function addExpenseListDetails(ChildExpenseListDetails $l)
    {
        if ($this->collExpenseListDetailss === null) {
            $this->initExpenseListDetailss();
            $this->collExpenseListDetailssPartial = true;
        }

        if (!$this->collExpenseListDetailss->contains($l)) {
            $this->doAddExpenseListDetails($l);

            if ($this->expenseListDetailssScheduledForDeletion and $this->expenseListDetailssScheduledForDeletion->contains($l)) {
                $this->expenseListDetailssScheduledForDeletion->remove($this->expenseListDetailssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildExpenseListDetails $expenseListDetails The ChildExpenseListDetails object to add.
     */
    protected function doAddExpenseListDetails(ChildExpenseListDetails $expenseListDetails): void
    {
        $this->collExpenseListDetailss[]= $expenseListDetails;
        $expenseListDetails->setExpenseList($this);
    }

    /**
     * @param ChildExpenseListDetails $expenseListDetails The ChildExpenseListDetails object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeExpenseListDetails(ChildExpenseListDetails $expenseListDetails)
    {
        if ($this->getExpenseListDetailss()->contains($expenseListDetails)) {
            $pos = $this->collExpenseListDetailss->search($expenseListDetails);
            $this->collExpenseListDetailss->remove($pos);
            if (null === $this->expenseListDetailssScheduledForDeletion) {
                $this->expenseListDetailssScheduledForDeletion = clone $this->collExpenseListDetailss;
                $this->expenseListDetailssScheduledForDeletion->clear();
            }
            $this->expenseListDetailssScheduledForDeletion[]= clone $expenseListDetails;
            $expenseListDetails->setExpenseList(null);
        }

        return $this;
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
            $this->aCompany->removeExpenseList($this);
        }
        if (null !== $this->aExpenseMaster) {
            $this->aExpenseMaster->removeExpenseList($this);
        }
        if (null !== $this->aExpenses) {
            $this->aExpenses->removeExpenseList($this);
        }
        $this->exp_list_id = null;
        $this->exp_id = null;
        $this->exp_master_id = null;
        $this->exp_note = null;
        $this->exp_remark = null;
        $this->exp_audit_remark = null;
        $this->exp_date = null;
        $this->exp_tax_amount = null;
        $this->exp_claimed_tax = null;
        $this->exp_test_amount = null;
        $this->exp_rate_qty = null;
        $this->exp_rate_mode = null;
        $this->exp_il_amount = null;
        $this->exp_req_amount = null;
        $this->exp_apr_amount = null;
        $this->exp_audit_amount = null;
        $this->exp_final_amount = null;
        $this->exp_policy_key = null;
        $this->exp_limit1 = null;
        $this->employee_id = null;
        $this->cmp_card = null;
        $this->company_id = null;
        $this->is_readonly = null;
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
            if ($this->collExpenseListDetailss) {
                foreach ($this->collExpenseListDetailss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collExpenseListDetailss = null;
        $this->aCompany = null;
        $this->aExpenseMaster = null;
        $this->aExpenses = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(ExpenseListTableMap::DEFAULT_STRING_FORMAT);
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
