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
use entities\BudgetExp as ChildBudgetExp;
use entities\BudgetExpQuery as ChildBudgetExpQuery;
use entities\Company as ChildCompany;
use entities\CompanyQuery as ChildCompanyQuery;
use entities\ExpenseList as ChildExpenseList;
use entities\ExpenseListQuery as ChildExpenseListQuery;
use entities\ExpenseMaster as ChildExpenseMaster;
use entities\ExpenseMasterQuery as ChildExpenseMasterQuery;
use entities\ExpenseRepellent as ChildExpenseRepellent;
use entities\ExpenseRepellentQuery as ChildExpenseRepellentQuery;
use entities\Map\BudgetExpTableMap;
use entities\Map\CompanyTableMap;
use entities\Map\ExpenseListTableMap;
use entities\Map\ExpenseMasterTableMap;
use entities\Map\ExpenseRepellentTableMap;

/**
 * Base class that represents a row from the 'expense_master' table.
 *
 *
 *
 * @package    propel.generator.entities.Base
 */
abstract class ExpenseMaster implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\entities\\Map\\ExpenseMasterTableMap';


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
     * The value for the expense_id field.
     *
     * @var        int
     */
    protected $expense_id;

    /**
     * The value for the company_id field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $company_id;

    /**
     * The value for the expense_name field.
     *
     * @var        string
     */
    protected $expense_name;

    /**
     * The value for the default_policykey field.
     *
     * @var        string
     */
    protected $default_policykey;

    /**
     * The value for the checkcity field.
     *
     * @var        int|null
     */
    protected $checkcity;

    /**
     * The value for the policykeya field.
     *
     * @var        string|null
     */
    protected $policykeya;

    /**
     * The value for the policykeyb field.
     *
     * @var        string|null
     */
    protected $policykeyb;

    /**
     * The value for the policykeyc field.
     *
     * @var        string|null
     */
    protected $policykeyc;

    /**
     * The value for the trips field.
     *
     * @var        int|null
     */
    protected $trips;

    /**
     * The value for the permonth field.
     *
     * @var        int|null
     */
    protected $permonth;

    /**
     * The value for the nonreimbursable field.
     *
     * @var        int|null
     */
    protected $nonreimbursable;

    /**
     * The value for the isdaily field.
     *
     * @var        int|null
     */
    protected $isdaily;

    /**
     * The value for the israteapplied field.
     *
     * @var        int|null
     */
    protected $israteapplied;

    /**
     * The value for the rate field.
     *
     * @var        string|null
     */
    protected $rate;

    /**
     * The value for the mode field.
     *
     * @var        string|null
     */
    protected $mode;

    /**
     * The value for the commentreq field.
     *
     * @var        int|null
     */
    protected $commentreq;

    /**
     * The value for the additional_text field.
     *
     * @var        int|null
     */
    protected $additional_text;

    /**
     * The value for the is_prefilled field.
     *
     * @var        int|null
     */
    protected $is_prefilled;

    /**
     * The value for the is_mandatory field.
     *
     * @var        int|null
     */
    protected $is_mandatory;

    /**
     * The value for the can_repeat field.
     *
     * @var        int|null
     */
    protected $can_repeat;

    /**
     * The value for the expense_tempate_name field.
     *
     * @var        string|null
     */
    protected $expense_tempate_name;

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
     * The value for the is_editable field.
     *
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $is_editable;

    /**
     * The value for the attachment_required field.
     *
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $attachment_required;

    /**
     * The value for the sort_order field.
     *
     * @var        int|null
     */
    protected $sort_order;

    /**
     * @var        ChildCompany
     */
    protected $aCompanyRelatedByCompanyId;

    /**
     * @var        ObjectCollection|ChildBudgetExp[] Collection to store aggregation of ChildBudgetExp objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildBudgetExp> Collection to store aggregation of ChildBudgetExp objects.
     */
    protected $collBudgetExps;
    protected $collBudgetExpsPartial;

    /**
     * @var        ObjectCollection|ChildCompany[] Collection to store aggregation of ChildCompany objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildCompany> Collection to store aggregation of ChildCompany objects.
     */
    protected $collCompaniesRelatedByAutoCalculatedTa;
    protected $collCompaniesRelatedByAutoCalculatedTaPartial;

    /**
     * @var        ObjectCollection|ChildExpenseList[] Collection to store aggregation of ChildExpenseList objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildExpenseList> Collection to store aggregation of ChildExpenseList objects.
     */
    protected $collExpenseLists;
    protected $collExpenseListsPartial;

    /**
     * @var        ObjectCollection|ChildExpenseRepellent[] Collection to store aggregation of ChildExpenseRepellent objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildExpenseRepellent> Collection to store aggregation of ChildExpenseRepellent objects.
     */
    protected $collExpenseRepellents;
    protected $collExpenseRepellentsPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildBudgetExp[]
     * @phpstan-var ObjectCollection&\Traversable<ChildBudgetExp>
     */
    protected $budgetExpsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildCompany[]
     * @phpstan-var ObjectCollection&\Traversable<ChildCompany>
     */
    protected $companiesRelatedByAutoCalculatedTaScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildExpenseList[]
     * @phpstan-var ObjectCollection&\Traversable<ChildExpenseList>
     */
    protected $expenseListsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildExpenseRepellent[]
     * @phpstan-var ObjectCollection&\Traversable<ChildExpenseRepellent>
     */
    protected $expenseRepellentsScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues(): void
    {
        $this->company_id = 0;
        $this->is_editable = false;
        $this->attachment_required = false;
    }

    /**
     * Initializes internal state of entities\Base\ExpenseMaster object.
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
     * Compares this with another <code>ExpenseMaster</code> instance.  If
     * <code>obj</code> is an instance of <code>ExpenseMaster</code>, delegates to
     * <code>equals(ExpenseMaster)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [expense_id] column value.
     *
     * @return int
     */
    public function getExpenseId()
    {
        return $this->expense_id;
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
     * Get the [expense_name] column value.
     *
     * @return string
     */
    public function getExpenseName()
    {
        return $this->expense_name;
    }

    /**
     * Get the [default_policykey] column value.
     *
     * @return string
     */
    public function getDefaultPolicykey()
    {
        return $this->default_policykey;
    }

    /**
     * Get the [checkcity] column value.
     *
     * @return int|null
     */
    public function getCheckcity()
    {
        return $this->checkcity;
    }

    /**
     * Get the [policykeya] column value.
     *
     * @return string|null
     */
    public function getPolicykeya()
    {
        return $this->policykeya;
    }

    /**
     * Get the [policykeyb] column value.
     *
     * @return string|null
     */
    public function getPolicykeyb()
    {
        return $this->policykeyb;
    }

    /**
     * Get the [policykeyc] column value.
     *
     * @return string|null
     */
    public function getPolicykeyc()
    {
        return $this->policykeyc;
    }

    /**
     * Get the [trips] column value.
     *
     * @return int|null
     */
    public function getTrips()
    {
        return $this->trips;
    }

    /**
     * Get the [permonth] column value.
     *
     * @return int|null
     */
    public function getPermonth()
    {
        return $this->permonth;
    }

    /**
     * Get the [nonreimbursable] column value.
     *
     * @return int|null
     */
    public function getNonreimbursable()
    {
        return $this->nonreimbursable;
    }

    /**
     * Get the [isdaily] column value.
     *
     * @return int|null
     */
    public function getIsdaily()
    {
        return $this->isdaily;
    }

    /**
     * Get the [israteapplied] column value.
     *
     * @return int|null
     */
    public function getIsrateapplied()
    {
        return $this->israteapplied;
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
     * Get the [mode] column value.
     *
     * @return string|null
     */
    public function getMode()
    {
        return $this->mode;
    }

    /**
     * Get the [commentreq] column value.
     *
     * @return int|null
     */
    public function getCommentreq()
    {
        return $this->commentreq;
    }

    /**
     * Get the [additional_text] column value.
     *
     * @return int|null
     */
    public function getAdditionalText()
    {
        return $this->additional_text;
    }

    /**
     * Get the [is_prefilled] column value.
     *
     * @return int|null
     */
    public function getIsPrefilled()
    {
        return $this->is_prefilled;
    }

    /**
     * Get the [is_mandatory] column value.
     *
     * @return int|null
     */
    public function getIsMandatory()
    {
        return $this->is_mandatory;
    }

    /**
     * Get the [can_repeat] column value.
     *
     * @return int|null
     */
    public function getCanRepeat()
    {
        return $this->can_repeat;
    }

    /**
     * Get the [expense_tempate_name] column value.
     *
     * @return string|null
     */
    public function getExpenseTempateName()
    {
        return $this->expense_tempate_name;
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
     * Get the [is_editable] column value.
     *
     * @return boolean
     */
    public function getIsEditable()
    {
        return $this->is_editable;
    }

    /**
     * Get the [is_editable] column value.
     *
     * @return boolean
     */
    public function isEditable()
    {
        return $this->getIsEditable();
    }

    /**
     * Get the [attachment_required] column value.
     *
     * @return boolean
     */
    public function getAttachmentRequired()
    {
        return $this->attachment_required;
    }

    /**
     * Get the [attachment_required] column value.
     *
     * @return boolean
     */
    public function isAttachmentRequired()
    {
        return $this->getAttachmentRequired();
    }

    /**
     * Get the [sort_order] column value.
     *
     * @return int|null
     */
    public function getSortOrder()
    {
        return $this->sort_order;
    }

    /**
     * Set the value of [expense_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setExpenseId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->expense_id !== $v) {
            $this->expense_id = $v;
            $this->modifiedColumns[ExpenseMasterTableMap::COL_EXPENSE_ID] = true;
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
            $this->modifiedColumns[ExpenseMasterTableMap::COL_COMPANY_ID] = true;
        }

        if ($this->aCompanyRelatedByCompanyId !== null && $this->aCompanyRelatedByCompanyId->getCompanyId() !== $v) {
            $this->aCompanyRelatedByCompanyId = null;
        }

        return $this;
    }

    /**
     * Set the value of [expense_name] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setExpenseName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->expense_name !== $v) {
            $this->expense_name = $v;
            $this->modifiedColumns[ExpenseMasterTableMap::COL_EXPENSE_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [default_policykey] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setDefaultPolicykey($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->default_policykey !== $v) {
            $this->default_policykey = $v;
            $this->modifiedColumns[ExpenseMasterTableMap::COL_DEFAULT_POLICYKEY] = true;
        }

        return $this;
    }

    /**
     * Set the value of [checkcity] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCheckcity($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->checkcity !== $v) {
            $this->checkcity = $v;
            $this->modifiedColumns[ExpenseMasterTableMap::COL_CHECKCITY] = true;
        }

        return $this;
    }

    /**
     * Set the value of [policykeya] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPolicykeya($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->policykeya !== $v) {
            $this->policykeya = $v;
            $this->modifiedColumns[ExpenseMasterTableMap::COL_POLICYKEYA] = true;
        }

        return $this;
    }

    /**
     * Set the value of [policykeyb] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPolicykeyb($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->policykeyb !== $v) {
            $this->policykeyb = $v;
            $this->modifiedColumns[ExpenseMasterTableMap::COL_POLICYKEYB] = true;
        }

        return $this;
    }

    /**
     * Set the value of [policykeyc] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPolicykeyc($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->policykeyc !== $v) {
            $this->policykeyc = $v;
            $this->modifiedColumns[ExpenseMasterTableMap::COL_POLICYKEYC] = true;
        }

        return $this;
    }

    /**
     * Set the value of [trips] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setTrips($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->trips !== $v) {
            $this->trips = $v;
            $this->modifiedColumns[ExpenseMasterTableMap::COL_TRIPS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [permonth] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPermonth($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->permonth !== $v) {
            $this->permonth = $v;
            $this->modifiedColumns[ExpenseMasterTableMap::COL_PERMONTH] = true;
        }

        return $this;
    }

    /**
     * Set the value of [nonreimbursable] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setNonreimbursable($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->nonreimbursable !== $v) {
            $this->nonreimbursable = $v;
            $this->modifiedColumns[ExpenseMasterTableMap::COL_NONREIMBURSABLE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [isdaily] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIsdaily($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->isdaily !== $v) {
            $this->isdaily = $v;
            $this->modifiedColumns[ExpenseMasterTableMap::COL_ISDAILY] = true;
        }

        return $this;
    }

    /**
     * Set the value of [israteapplied] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIsrateapplied($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->israteapplied !== $v) {
            $this->israteapplied = $v;
            $this->modifiedColumns[ExpenseMasterTableMap::COL_ISRATEAPPLIED] = true;
        }

        return $this;
    }

    /**
     * Set the value of [rate] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setRate($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->rate !== $v) {
            $this->rate = $v;
            $this->modifiedColumns[ExpenseMasterTableMap::COL_RATE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [mode] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setMode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->mode !== $v) {
            $this->mode = $v;
            $this->modifiedColumns[ExpenseMasterTableMap::COL_MODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [commentreq] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCommentreq($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->commentreq !== $v) {
            $this->commentreq = $v;
            $this->modifiedColumns[ExpenseMasterTableMap::COL_COMMENTREQ] = true;
        }

        return $this;
    }

    /**
     * Set the value of [additional_text] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setAdditionalText($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->additional_text !== $v) {
            $this->additional_text = $v;
            $this->modifiedColumns[ExpenseMasterTableMap::COL_ADDITIONAL_TEXT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [is_prefilled] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIsPrefilled($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->is_prefilled !== $v) {
            $this->is_prefilled = $v;
            $this->modifiedColumns[ExpenseMasterTableMap::COL_IS_PREFILLED] = true;
        }

        return $this;
    }

    /**
     * Set the value of [is_mandatory] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIsMandatory($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->is_mandatory !== $v) {
            $this->is_mandatory = $v;
            $this->modifiedColumns[ExpenseMasterTableMap::COL_IS_MANDATORY] = true;
        }

        return $this;
    }

    /**
     * Set the value of [can_repeat] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCanRepeat($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->can_repeat !== $v) {
            $this->can_repeat = $v;
            $this->modifiedColumns[ExpenseMasterTableMap::COL_CAN_REPEAT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [expense_tempate_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setExpenseTempateName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->expense_tempate_name !== $v) {
            $this->expense_tempate_name = $v;
            $this->modifiedColumns[ExpenseMasterTableMap::COL_EXPENSE_TEMPATE_NAME] = true;
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
                $this->modifiedColumns[ExpenseMasterTableMap::COL_CREATED_AT] = true;
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
                $this->modifiedColumns[ExpenseMasterTableMap::COL_UPDATED_AT] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Sets the value of the [is_editable] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param bool|integer|string $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setIsEditable($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->is_editable !== $v) {
            $this->is_editable = $v;
            $this->modifiedColumns[ExpenseMasterTableMap::COL_IS_EDITABLE] = true;
        }

        return $this;
    }

    /**
     * Sets the value of the [attachment_required] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param bool|integer|string $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setAttachmentRequired($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->attachment_required !== $v) {
            $this->attachment_required = $v;
            $this->modifiedColumns[ExpenseMasterTableMap::COL_ATTACHMENT_REQUIRED] = true;
        }

        return $this;
    }

    /**
     * Set the value of [sort_order] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setSortOrder($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->sort_order !== $v) {
            $this->sort_order = $v;
            $this->modifiedColumns[ExpenseMasterTableMap::COL_SORT_ORDER] = true;
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

            if ($this->is_editable !== false) {
                return false;
            }

            if ($this->attachment_required !== false) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : ExpenseMasterTableMap::translateFieldName('ExpenseId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->expense_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : ExpenseMasterTableMap::translateFieldName('CompanyId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->company_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : ExpenseMasterTableMap::translateFieldName('ExpenseName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->expense_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : ExpenseMasterTableMap::translateFieldName('DefaultPolicykey', TableMap::TYPE_PHPNAME, $indexType)];
            $this->default_policykey = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : ExpenseMasterTableMap::translateFieldName('Checkcity', TableMap::TYPE_PHPNAME, $indexType)];
            $this->checkcity = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : ExpenseMasterTableMap::translateFieldName('Policykeya', TableMap::TYPE_PHPNAME, $indexType)];
            $this->policykeya = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : ExpenseMasterTableMap::translateFieldName('Policykeyb', TableMap::TYPE_PHPNAME, $indexType)];
            $this->policykeyb = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : ExpenseMasterTableMap::translateFieldName('Policykeyc', TableMap::TYPE_PHPNAME, $indexType)];
            $this->policykeyc = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : ExpenseMasterTableMap::translateFieldName('Trips', TableMap::TYPE_PHPNAME, $indexType)];
            $this->trips = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : ExpenseMasterTableMap::translateFieldName('Permonth', TableMap::TYPE_PHPNAME, $indexType)];
            $this->permonth = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : ExpenseMasterTableMap::translateFieldName('Nonreimbursable', TableMap::TYPE_PHPNAME, $indexType)];
            $this->nonreimbursable = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : ExpenseMasterTableMap::translateFieldName('Isdaily', TableMap::TYPE_PHPNAME, $indexType)];
            $this->isdaily = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : ExpenseMasterTableMap::translateFieldName('Israteapplied', TableMap::TYPE_PHPNAME, $indexType)];
            $this->israteapplied = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : ExpenseMasterTableMap::translateFieldName('Rate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->rate = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : ExpenseMasterTableMap::translateFieldName('Mode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->mode = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : ExpenseMasterTableMap::translateFieldName('Commentreq', TableMap::TYPE_PHPNAME, $indexType)];
            $this->commentreq = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : ExpenseMasterTableMap::translateFieldName('AdditionalText', TableMap::TYPE_PHPNAME, $indexType)];
            $this->additional_text = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : ExpenseMasterTableMap::translateFieldName('IsPrefilled', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_prefilled = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 18 + $startcol : ExpenseMasterTableMap::translateFieldName('IsMandatory', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_mandatory = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 19 + $startcol : ExpenseMasterTableMap::translateFieldName('CanRepeat', TableMap::TYPE_PHPNAME, $indexType)];
            $this->can_repeat = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 20 + $startcol : ExpenseMasterTableMap::translateFieldName('ExpenseTempateName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->expense_tempate_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 21 + $startcol : ExpenseMasterTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 22 + $startcol : ExpenseMasterTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 23 + $startcol : ExpenseMasterTableMap::translateFieldName('IsEditable', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_editable = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 24 + $startcol : ExpenseMasterTableMap::translateFieldName('AttachmentRequired', TableMap::TYPE_PHPNAME, $indexType)];
            $this->attachment_required = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 25 + $startcol : ExpenseMasterTableMap::translateFieldName('SortOrder', TableMap::TYPE_PHPNAME, $indexType)];
            $this->sort_order = (null !== $col) ? (int) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 26; // 26 = ExpenseMasterTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\entities\\ExpenseMaster'), 0, $e);
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
        if ($this->aCompanyRelatedByCompanyId !== null && $this->company_id !== $this->aCompanyRelatedByCompanyId->getCompanyId()) {
            $this->aCompanyRelatedByCompanyId = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(ExpenseMasterTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildExpenseMasterQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aCompanyRelatedByCompanyId = null;
            $this->collBudgetExps = null;

            $this->collCompaniesRelatedByAutoCalculatedTa = null;

            $this->collExpenseLists = null;

            $this->collExpenseRepellents = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see ExpenseMaster::setDeleted()
     * @see ExpenseMaster::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(ExpenseMasterTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildExpenseMasterQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(ExpenseMasterTableMap::DATABASE_NAME);
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
                ExpenseMasterTableMap::addInstanceToPool($this);
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

            if ($this->aCompanyRelatedByCompanyId !== null) {
                if ($this->aCompanyRelatedByCompanyId->isModified() || $this->aCompanyRelatedByCompanyId->isNew()) {
                    $affectedRows += $this->aCompanyRelatedByCompanyId->save($con);
                }
                $this->setCompanyRelatedByCompanyId($this->aCompanyRelatedByCompanyId);
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

            if ($this->budgetExpsScheduledForDeletion !== null) {
                if (!$this->budgetExpsScheduledForDeletion->isEmpty()) {
                    \entities\BudgetExpQuery::create()
                        ->filterByPrimaryKeys($this->budgetExpsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->budgetExpsScheduledForDeletion = null;
                }
            }

            if ($this->collBudgetExps !== null) {
                foreach ($this->collBudgetExps as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->companiesRelatedByAutoCalculatedTaScheduledForDeletion !== null) {
                if (!$this->companiesRelatedByAutoCalculatedTaScheduledForDeletion->isEmpty()) {
                    foreach ($this->companiesRelatedByAutoCalculatedTaScheduledForDeletion as $companyRelatedByAutoCalculatedTa) {
                        // need to save related object because we set the relation to null
                        $companyRelatedByAutoCalculatedTa->save($con);
                    }
                    $this->companiesRelatedByAutoCalculatedTaScheduledForDeletion = null;
                }
            }

            if ($this->collCompaniesRelatedByAutoCalculatedTa !== null) {
                foreach ($this->collCompaniesRelatedByAutoCalculatedTa as $referrerFK) {
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

            if ($this->expenseRepellentsScheduledForDeletion !== null) {
                if (!$this->expenseRepellentsScheduledForDeletion->isEmpty()) {
                    foreach ($this->expenseRepellentsScheduledForDeletion as $expenseRepellent) {
                        // need to save related object because we set the relation to null
                        $expenseRepellent->save($con);
                    }
                    $this->expenseRepellentsScheduledForDeletion = null;
                }
            }

            if ($this->collExpenseRepellents !== null) {
                foreach ($this->collExpenseRepellents as $referrerFK) {
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

        $this->modifiedColumns[ExpenseMasterTableMap::COL_EXPENSE_ID] = true;
        if (null !== $this->expense_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . ExpenseMasterTableMap::COL_EXPENSE_ID . ')');
        }
        if (null === $this->expense_id) {
            try {
                $dataFetcher = $con->query("SELECT nextval('expense_master_expense_id_seq')");
                $this->expense_id = (int) $dataFetcher->fetchColumn();
            } catch (Exception $e) {
                throw new PropelException('Unable to get sequence id.', 0, $e);
            }
        }


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(ExpenseMasterTableMap::COL_EXPENSE_ID)) {
            $modifiedColumns[':p' . $index++]  = 'expense_id';
        }
        if ($this->isColumnModified(ExpenseMasterTableMap::COL_COMPANY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'company_id';
        }
        if ($this->isColumnModified(ExpenseMasterTableMap::COL_EXPENSE_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'expense_name';
        }
        if ($this->isColumnModified(ExpenseMasterTableMap::COL_DEFAULT_POLICYKEY)) {
            $modifiedColumns[':p' . $index++]  = 'default_policykey';
        }
        if ($this->isColumnModified(ExpenseMasterTableMap::COL_CHECKCITY)) {
            $modifiedColumns[':p' . $index++]  = 'checkcity';
        }
        if ($this->isColumnModified(ExpenseMasterTableMap::COL_POLICYKEYA)) {
            $modifiedColumns[':p' . $index++]  = 'policykeya';
        }
        if ($this->isColumnModified(ExpenseMasterTableMap::COL_POLICYKEYB)) {
            $modifiedColumns[':p' . $index++]  = 'policykeyb';
        }
        if ($this->isColumnModified(ExpenseMasterTableMap::COL_POLICYKEYC)) {
            $modifiedColumns[':p' . $index++]  = 'policykeyc';
        }
        if ($this->isColumnModified(ExpenseMasterTableMap::COL_TRIPS)) {
            $modifiedColumns[':p' . $index++]  = 'trips';
        }
        if ($this->isColumnModified(ExpenseMasterTableMap::COL_PERMONTH)) {
            $modifiedColumns[':p' . $index++]  = 'permonth';
        }
        if ($this->isColumnModified(ExpenseMasterTableMap::COL_NONREIMBURSABLE)) {
            $modifiedColumns[':p' . $index++]  = 'nonreimbursable';
        }
        if ($this->isColumnModified(ExpenseMasterTableMap::COL_ISDAILY)) {
            $modifiedColumns[':p' . $index++]  = 'isdaily';
        }
        if ($this->isColumnModified(ExpenseMasterTableMap::COL_ISRATEAPPLIED)) {
            $modifiedColumns[':p' . $index++]  = 'israteapplied';
        }
        if ($this->isColumnModified(ExpenseMasterTableMap::COL_RATE)) {
            $modifiedColumns[':p' . $index++]  = 'rate';
        }
        if ($this->isColumnModified(ExpenseMasterTableMap::COL_MODE)) {
            $modifiedColumns[':p' . $index++]  = 'mode';
        }
        if ($this->isColumnModified(ExpenseMasterTableMap::COL_COMMENTREQ)) {
            $modifiedColumns[':p' . $index++]  = 'commentreq';
        }
        if ($this->isColumnModified(ExpenseMasterTableMap::COL_ADDITIONAL_TEXT)) {
            $modifiedColumns[':p' . $index++]  = 'additional_text';
        }
        if ($this->isColumnModified(ExpenseMasterTableMap::COL_IS_PREFILLED)) {
            $modifiedColumns[':p' . $index++]  = 'is_prefilled';
        }
        if ($this->isColumnModified(ExpenseMasterTableMap::COL_IS_MANDATORY)) {
            $modifiedColumns[':p' . $index++]  = 'is_mandatory';
        }
        if ($this->isColumnModified(ExpenseMasterTableMap::COL_CAN_REPEAT)) {
            $modifiedColumns[':p' . $index++]  = 'can_repeat';
        }
        if ($this->isColumnModified(ExpenseMasterTableMap::COL_EXPENSE_TEMPATE_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'expense_tempate_name';
        }
        if ($this->isColumnModified(ExpenseMasterTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(ExpenseMasterTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }
        if ($this->isColumnModified(ExpenseMasterTableMap::COL_IS_EDITABLE)) {
            $modifiedColumns[':p' . $index++]  = 'is_editable';
        }
        if ($this->isColumnModified(ExpenseMasterTableMap::COL_ATTACHMENT_REQUIRED)) {
            $modifiedColumns[':p' . $index++]  = 'attachment_required';
        }
        if ($this->isColumnModified(ExpenseMasterTableMap::COL_SORT_ORDER)) {
            $modifiedColumns[':p' . $index++]  = 'sort_order';
        }

        $sql = sprintf(
            'INSERT INTO expense_master (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'expense_id':
                        $stmt->bindValue($identifier, $this->expense_id, PDO::PARAM_INT);

                        break;
                    case 'company_id':
                        $stmt->bindValue($identifier, $this->company_id, PDO::PARAM_INT);

                        break;
                    case 'expense_name':
                        $stmt->bindValue($identifier, $this->expense_name, PDO::PARAM_STR);

                        break;
                    case 'default_policykey':
                        $stmt->bindValue($identifier, $this->default_policykey, PDO::PARAM_STR);

                        break;
                    case 'checkcity':
                        $stmt->bindValue($identifier, $this->checkcity, PDO::PARAM_INT);

                        break;
                    case 'policykeya':
                        $stmt->bindValue($identifier, $this->policykeya, PDO::PARAM_STR);

                        break;
                    case 'policykeyb':
                        $stmt->bindValue($identifier, $this->policykeyb, PDO::PARAM_STR);

                        break;
                    case 'policykeyc':
                        $stmt->bindValue($identifier, $this->policykeyc, PDO::PARAM_STR);

                        break;
                    case 'trips':
                        $stmt->bindValue($identifier, $this->trips, PDO::PARAM_INT);

                        break;
                    case 'permonth':
                        $stmt->bindValue($identifier, $this->permonth, PDO::PARAM_INT);

                        break;
                    case 'nonreimbursable':
                        $stmt->bindValue($identifier, $this->nonreimbursable, PDO::PARAM_INT);

                        break;
                    case 'isdaily':
                        $stmt->bindValue($identifier, $this->isdaily, PDO::PARAM_INT);

                        break;
                    case 'israteapplied':
                        $stmt->bindValue($identifier, $this->israteapplied, PDO::PARAM_INT);

                        break;
                    case 'rate':
                        $stmt->bindValue($identifier, $this->rate, PDO::PARAM_STR);

                        break;
                    case 'mode':
                        $stmt->bindValue($identifier, $this->mode, PDO::PARAM_STR);

                        break;
                    case 'commentreq':
                        $stmt->bindValue($identifier, $this->commentreq, PDO::PARAM_INT);

                        break;
                    case 'additional_text':
                        $stmt->bindValue($identifier, $this->additional_text, PDO::PARAM_INT);

                        break;
                    case 'is_prefilled':
                        $stmt->bindValue($identifier, $this->is_prefilled, PDO::PARAM_INT);

                        break;
                    case 'is_mandatory':
                        $stmt->bindValue($identifier, $this->is_mandatory, PDO::PARAM_INT);

                        break;
                    case 'can_repeat':
                        $stmt->bindValue($identifier, $this->can_repeat, PDO::PARAM_INT);

                        break;
                    case 'expense_tempate_name':
                        $stmt->bindValue($identifier, $this->expense_tempate_name, PDO::PARAM_STR);

                        break;
                    case 'created_at':
                        $stmt->bindValue($identifier, $this->created_at ? $this->created_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'updated_at':
                        $stmt->bindValue($identifier, $this->updated_at ? $this->updated_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'is_editable':
                        $stmt->bindValue($identifier, $this->is_editable, PDO::PARAM_BOOL);

                        break;
                    case 'attachment_required':
                        $stmt->bindValue($identifier, $this->attachment_required, PDO::PARAM_BOOL);

                        break;
                    case 'sort_order':
                        $stmt->bindValue($identifier, $this->sort_order, PDO::PARAM_INT);

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
        $pos = ExpenseMasterTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getExpenseId();

            case 1:
                return $this->getCompanyId();

            case 2:
                return $this->getExpenseName();

            case 3:
                return $this->getDefaultPolicykey();

            case 4:
                return $this->getCheckcity();

            case 5:
                return $this->getPolicykeya();

            case 6:
                return $this->getPolicykeyb();

            case 7:
                return $this->getPolicykeyc();

            case 8:
                return $this->getTrips();

            case 9:
                return $this->getPermonth();

            case 10:
                return $this->getNonreimbursable();

            case 11:
                return $this->getIsdaily();

            case 12:
                return $this->getIsrateapplied();

            case 13:
                return $this->getRate();

            case 14:
                return $this->getMode();

            case 15:
                return $this->getCommentreq();

            case 16:
                return $this->getAdditionalText();

            case 17:
                return $this->getIsPrefilled();

            case 18:
                return $this->getIsMandatory();

            case 19:
                return $this->getCanRepeat();

            case 20:
                return $this->getExpenseTempateName();

            case 21:
                return $this->getCreatedAt();

            case 22:
                return $this->getUpdatedAt();

            case 23:
                return $this->getIsEditable();

            case 24:
                return $this->getAttachmentRequired();

            case 25:
                return $this->getSortOrder();

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
        if (isset($alreadyDumpedObjects['ExpenseMaster'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['ExpenseMaster'][$this->hashCode()] = true;
        $keys = ExpenseMasterTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getExpenseId(),
            $keys[1] => $this->getCompanyId(),
            $keys[2] => $this->getExpenseName(),
            $keys[3] => $this->getDefaultPolicykey(),
            $keys[4] => $this->getCheckcity(),
            $keys[5] => $this->getPolicykeya(),
            $keys[6] => $this->getPolicykeyb(),
            $keys[7] => $this->getPolicykeyc(),
            $keys[8] => $this->getTrips(),
            $keys[9] => $this->getPermonth(),
            $keys[10] => $this->getNonreimbursable(),
            $keys[11] => $this->getIsdaily(),
            $keys[12] => $this->getIsrateapplied(),
            $keys[13] => $this->getRate(),
            $keys[14] => $this->getMode(),
            $keys[15] => $this->getCommentreq(),
            $keys[16] => $this->getAdditionalText(),
            $keys[17] => $this->getIsPrefilled(),
            $keys[18] => $this->getIsMandatory(),
            $keys[19] => $this->getCanRepeat(),
            $keys[20] => $this->getExpenseTempateName(),
            $keys[21] => $this->getCreatedAt(),
            $keys[22] => $this->getUpdatedAt(),
            $keys[23] => $this->getIsEditable(),
            $keys[24] => $this->getAttachmentRequired(),
            $keys[25] => $this->getSortOrder(),
        ];
        if ($result[$keys[21]] instanceof \DateTimeInterface) {
            $result[$keys[21]] = $result[$keys[21]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[22]] instanceof \DateTimeInterface) {
            $result[$keys[22]] = $result[$keys[22]]->format('Y-m-d H:i:s.u');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aCompanyRelatedByCompanyId) {

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

                $result[$key] = $this->aCompanyRelatedByCompanyId->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collBudgetExps) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'budgetExps';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'budget_exps';
                        break;
                    default:
                        $key = 'BudgetExps';
                }

                $result[$key] = $this->collBudgetExps->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collCompaniesRelatedByAutoCalculatedTa) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'companies';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'companies';
                        break;
                    default:
                        $key = 'Companies';
                }

                $result[$key] = $this->collCompaniesRelatedByAutoCalculatedTa->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
            if (null !== $this->collExpenseRepellents) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'expenseRepellents';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'expense_repellents';
                        break;
                    default:
                        $key = 'ExpenseRepellents';
                }

                $result[$key] = $this->collExpenseRepellents->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = ExpenseMasterTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setExpenseId($value);
                break;
            case 1:
                $this->setCompanyId($value);
                break;
            case 2:
                $this->setExpenseName($value);
                break;
            case 3:
                $this->setDefaultPolicykey($value);
                break;
            case 4:
                $this->setCheckcity($value);
                break;
            case 5:
                $this->setPolicykeya($value);
                break;
            case 6:
                $this->setPolicykeyb($value);
                break;
            case 7:
                $this->setPolicykeyc($value);
                break;
            case 8:
                $this->setTrips($value);
                break;
            case 9:
                $this->setPermonth($value);
                break;
            case 10:
                $this->setNonreimbursable($value);
                break;
            case 11:
                $this->setIsdaily($value);
                break;
            case 12:
                $this->setIsrateapplied($value);
                break;
            case 13:
                $this->setRate($value);
                break;
            case 14:
                $this->setMode($value);
                break;
            case 15:
                $this->setCommentreq($value);
                break;
            case 16:
                $this->setAdditionalText($value);
                break;
            case 17:
                $this->setIsPrefilled($value);
                break;
            case 18:
                $this->setIsMandatory($value);
                break;
            case 19:
                $this->setCanRepeat($value);
                break;
            case 20:
                $this->setExpenseTempateName($value);
                break;
            case 21:
                $this->setCreatedAt($value);
                break;
            case 22:
                $this->setUpdatedAt($value);
                break;
            case 23:
                $this->setIsEditable($value);
                break;
            case 24:
                $this->setAttachmentRequired($value);
                break;
            case 25:
                $this->setSortOrder($value);
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
        $keys = ExpenseMasterTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setExpenseId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setCompanyId($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setExpenseName($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setDefaultPolicykey($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setCheckcity($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setPolicykeya($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setPolicykeyb($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setPolicykeyc($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setTrips($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setPermonth($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setNonreimbursable($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setIsdaily($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setIsrateapplied($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setRate($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setMode($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setCommentreq($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setAdditionalText($arr[$keys[16]]);
        }
        if (array_key_exists($keys[17], $arr)) {
            $this->setIsPrefilled($arr[$keys[17]]);
        }
        if (array_key_exists($keys[18], $arr)) {
            $this->setIsMandatory($arr[$keys[18]]);
        }
        if (array_key_exists($keys[19], $arr)) {
            $this->setCanRepeat($arr[$keys[19]]);
        }
        if (array_key_exists($keys[20], $arr)) {
            $this->setExpenseTempateName($arr[$keys[20]]);
        }
        if (array_key_exists($keys[21], $arr)) {
            $this->setCreatedAt($arr[$keys[21]]);
        }
        if (array_key_exists($keys[22], $arr)) {
            $this->setUpdatedAt($arr[$keys[22]]);
        }
        if (array_key_exists($keys[23], $arr)) {
            $this->setIsEditable($arr[$keys[23]]);
        }
        if (array_key_exists($keys[24], $arr)) {
            $this->setAttachmentRequired($arr[$keys[24]]);
        }
        if (array_key_exists($keys[25], $arr)) {
            $this->setSortOrder($arr[$keys[25]]);
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
        $criteria = new Criteria(ExpenseMasterTableMap::DATABASE_NAME);

        if ($this->isColumnModified(ExpenseMasterTableMap::COL_EXPENSE_ID)) {
            $criteria->add(ExpenseMasterTableMap::COL_EXPENSE_ID, $this->expense_id);
        }
        if ($this->isColumnModified(ExpenseMasterTableMap::COL_COMPANY_ID)) {
            $criteria->add(ExpenseMasterTableMap::COL_COMPANY_ID, $this->company_id);
        }
        if ($this->isColumnModified(ExpenseMasterTableMap::COL_EXPENSE_NAME)) {
            $criteria->add(ExpenseMasterTableMap::COL_EXPENSE_NAME, $this->expense_name);
        }
        if ($this->isColumnModified(ExpenseMasterTableMap::COL_DEFAULT_POLICYKEY)) {
            $criteria->add(ExpenseMasterTableMap::COL_DEFAULT_POLICYKEY, $this->default_policykey);
        }
        if ($this->isColumnModified(ExpenseMasterTableMap::COL_CHECKCITY)) {
            $criteria->add(ExpenseMasterTableMap::COL_CHECKCITY, $this->checkcity);
        }
        if ($this->isColumnModified(ExpenseMasterTableMap::COL_POLICYKEYA)) {
            $criteria->add(ExpenseMasterTableMap::COL_POLICYKEYA, $this->policykeya);
        }
        if ($this->isColumnModified(ExpenseMasterTableMap::COL_POLICYKEYB)) {
            $criteria->add(ExpenseMasterTableMap::COL_POLICYKEYB, $this->policykeyb);
        }
        if ($this->isColumnModified(ExpenseMasterTableMap::COL_POLICYKEYC)) {
            $criteria->add(ExpenseMasterTableMap::COL_POLICYKEYC, $this->policykeyc);
        }
        if ($this->isColumnModified(ExpenseMasterTableMap::COL_TRIPS)) {
            $criteria->add(ExpenseMasterTableMap::COL_TRIPS, $this->trips);
        }
        if ($this->isColumnModified(ExpenseMasterTableMap::COL_PERMONTH)) {
            $criteria->add(ExpenseMasterTableMap::COL_PERMONTH, $this->permonth);
        }
        if ($this->isColumnModified(ExpenseMasterTableMap::COL_NONREIMBURSABLE)) {
            $criteria->add(ExpenseMasterTableMap::COL_NONREIMBURSABLE, $this->nonreimbursable);
        }
        if ($this->isColumnModified(ExpenseMasterTableMap::COL_ISDAILY)) {
            $criteria->add(ExpenseMasterTableMap::COL_ISDAILY, $this->isdaily);
        }
        if ($this->isColumnModified(ExpenseMasterTableMap::COL_ISRATEAPPLIED)) {
            $criteria->add(ExpenseMasterTableMap::COL_ISRATEAPPLIED, $this->israteapplied);
        }
        if ($this->isColumnModified(ExpenseMasterTableMap::COL_RATE)) {
            $criteria->add(ExpenseMasterTableMap::COL_RATE, $this->rate);
        }
        if ($this->isColumnModified(ExpenseMasterTableMap::COL_MODE)) {
            $criteria->add(ExpenseMasterTableMap::COL_MODE, $this->mode);
        }
        if ($this->isColumnModified(ExpenseMasterTableMap::COL_COMMENTREQ)) {
            $criteria->add(ExpenseMasterTableMap::COL_COMMENTREQ, $this->commentreq);
        }
        if ($this->isColumnModified(ExpenseMasterTableMap::COL_ADDITIONAL_TEXT)) {
            $criteria->add(ExpenseMasterTableMap::COL_ADDITIONAL_TEXT, $this->additional_text);
        }
        if ($this->isColumnModified(ExpenseMasterTableMap::COL_IS_PREFILLED)) {
            $criteria->add(ExpenseMasterTableMap::COL_IS_PREFILLED, $this->is_prefilled);
        }
        if ($this->isColumnModified(ExpenseMasterTableMap::COL_IS_MANDATORY)) {
            $criteria->add(ExpenseMasterTableMap::COL_IS_MANDATORY, $this->is_mandatory);
        }
        if ($this->isColumnModified(ExpenseMasterTableMap::COL_CAN_REPEAT)) {
            $criteria->add(ExpenseMasterTableMap::COL_CAN_REPEAT, $this->can_repeat);
        }
        if ($this->isColumnModified(ExpenseMasterTableMap::COL_EXPENSE_TEMPATE_NAME)) {
            $criteria->add(ExpenseMasterTableMap::COL_EXPENSE_TEMPATE_NAME, $this->expense_tempate_name);
        }
        if ($this->isColumnModified(ExpenseMasterTableMap::COL_CREATED_AT)) {
            $criteria->add(ExpenseMasterTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(ExpenseMasterTableMap::COL_UPDATED_AT)) {
            $criteria->add(ExpenseMasterTableMap::COL_UPDATED_AT, $this->updated_at);
        }
        if ($this->isColumnModified(ExpenseMasterTableMap::COL_IS_EDITABLE)) {
            $criteria->add(ExpenseMasterTableMap::COL_IS_EDITABLE, $this->is_editable);
        }
        if ($this->isColumnModified(ExpenseMasterTableMap::COL_ATTACHMENT_REQUIRED)) {
            $criteria->add(ExpenseMasterTableMap::COL_ATTACHMENT_REQUIRED, $this->attachment_required);
        }
        if ($this->isColumnModified(ExpenseMasterTableMap::COL_SORT_ORDER)) {
            $criteria->add(ExpenseMasterTableMap::COL_SORT_ORDER, $this->sort_order);
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
        $criteria = ChildExpenseMasterQuery::create();
        $criteria->add(ExpenseMasterTableMap::COL_EXPENSE_ID, $this->expense_id);

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
        $validPk = null !== $this->getExpenseId();

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
        return $this->getExpenseId();
    }

    /**
     * Generic method to set the primary key (expense_id column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setExpenseId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getExpenseId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \entities\ExpenseMaster (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setCompanyId($this->getCompanyId());
        $copyObj->setExpenseName($this->getExpenseName());
        $copyObj->setDefaultPolicykey($this->getDefaultPolicykey());
        $copyObj->setCheckcity($this->getCheckcity());
        $copyObj->setPolicykeya($this->getPolicykeya());
        $copyObj->setPolicykeyb($this->getPolicykeyb());
        $copyObj->setPolicykeyc($this->getPolicykeyc());
        $copyObj->setTrips($this->getTrips());
        $copyObj->setPermonth($this->getPermonth());
        $copyObj->setNonreimbursable($this->getNonreimbursable());
        $copyObj->setIsdaily($this->getIsdaily());
        $copyObj->setIsrateapplied($this->getIsrateapplied());
        $copyObj->setRate($this->getRate());
        $copyObj->setMode($this->getMode());
        $copyObj->setCommentreq($this->getCommentreq());
        $copyObj->setAdditionalText($this->getAdditionalText());
        $copyObj->setIsPrefilled($this->getIsPrefilled());
        $copyObj->setIsMandatory($this->getIsMandatory());
        $copyObj->setCanRepeat($this->getCanRepeat());
        $copyObj->setExpenseTempateName($this->getExpenseTempateName());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        $copyObj->setIsEditable($this->getIsEditable());
        $copyObj->setAttachmentRequired($this->getAttachmentRequired());
        $copyObj->setSortOrder($this->getSortOrder());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getBudgetExps() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBudgetExp($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getCompaniesRelatedByAutoCalculatedTa() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addCompanyRelatedByAutoCalculatedTa($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getExpenseLists() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addExpenseList($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getExpenseRepellents() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addExpenseRepellent($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setExpenseId(NULL); // this is a auto-increment column, so set to default value
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
     * @return \entities\ExpenseMaster Clone of current object.
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
    public function setCompanyRelatedByCompanyId(ChildCompany $v = null)
    {
        if ($v === null) {
            $this->setCompanyId(0);
        } else {
            $this->setCompanyId($v->getCompanyId());
        }

        $this->aCompanyRelatedByCompanyId = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildCompany object, it will not be re-added.
        if ($v !== null) {
            $v->addExpenseMasterRelatedByCompanyId($this);
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
    public function getCompanyRelatedByCompanyId(?ConnectionInterface $con = null)
    {
        if ($this->aCompanyRelatedByCompanyId === null && ($this->company_id != 0)) {
            $this->aCompanyRelatedByCompanyId = ChildCompanyQuery::create()->findPk($this->company_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aCompanyRelatedByCompanyId->addExpenseMastersRelatedByCompanyId($this);
             */
        }

        return $this->aCompanyRelatedByCompanyId;
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
        if ('BudgetExp' === $relationName) {
            $this->initBudgetExps();
            return;
        }
        if ('CompanyRelatedByAutoCalculatedTa' === $relationName) {
            $this->initCompaniesRelatedByAutoCalculatedTa();
            return;
        }
        if ('ExpenseList' === $relationName) {
            $this->initExpenseLists();
            return;
        }
        if ('ExpenseRepellent' === $relationName) {
            $this->initExpenseRepellents();
            return;
        }
    }

    /**
     * Clears out the collBudgetExps collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addBudgetExps()
     */
    public function clearBudgetExps()
    {
        $this->collBudgetExps = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collBudgetExps collection loaded partially.
     *
     * @return void
     */
    public function resetPartialBudgetExps($v = true): void
    {
        $this->collBudgetExpsPartial = $v;
    }

    /**
     * Initializes the collBudgetExps collection.
     *
     * By default this just sets the collBudgetExps collection to an empty array (like clearcollBudgetExps());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBudgetExps(bool $overrideExisting = true): void
    {
        if (null !== $this->collBudgetExps && !$overrideExisting) {
            return;
        }

        $collectionClassName = BudgetExpTableMap::getTableMap()->getCollectionClassName();

        $this->collBudgetExps = new $collectionClassName;
        $this->collBudgetExps->setModel('\entities\BudgetExp');
    }

    /**
     * Gets an array of ChildBudgetExp objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildExpenseMaster is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildBudgetExp[] List of ChildBudgetExp objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBudgetExp> List of ChildBudgetExp objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getBudgetExps(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collBudgetExpsPartial && !$this->isNew();
        if (null === $this->collBudgetExps || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collBudgetExps) {
                    $this->initBudgetExps();
                } else {
                    $collectionClassName = BudgetExpTableMap::getTableMap()->getCollectionClassName();

                    $collBudgetExps = new $collectionClassName;
                    $collBudgetExps->setModel('\entities\BudgetExp');

                    return $collBudgetExps;
                }
            } else {
                $collBudgetExps = ChildBudgetExpQuery::create(null, $criteria)
                    ->filterByExpenseMaster($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collBudgetExpsPartial && count($collBudgetExps)) {
                        $this->initBudgetExps(false);

                        foreach ($collBudgetExps as $obj) {
                            if (false == $this->collBudgetExps->contains($obj)) {
                                $this->collBudgetExps->append($obj);
                            }
                        }

                        $this->collBudgetExpsPartial = true;
                    }

                    return $collBudgetExps;
                }

                if ($partial && $this->collBudgetExps) {
                    foreach ($this->collBudgetExps as $obj) {
                        if ($obj->isNew()) {
                            $collBudgetExps[] = $obj;
                        }
                    }
                }

                $this->collBudgetExps = $collBudgetExps;
                $this->collBudgetExpsPartial = false;
            }
        }

        return $this->collBudgetExps;
    }

    /**
     * Sets a collection of ChildBudgetExp objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $budgetExps A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setBudgetExps(Collection $budgetExps, ?ConnectionInterface $con = null)
    {
        /** @var ChildBudgetExp[] $budgetExpsToDelete */
        $budgetExpsToDelete = $this->getBudgetExps(new Criteria(), $con)->diff($budgetExps);


        $this->budgetExpsScheduledForDeletion = $budgetExpsToDelete;

        foreach ($budgetExpsToDelete as $budgetExpRemoved) {
            $budgetExpRemoved->setExpenseMaster(null);
        }

        $this->collBudgetExps = null;
        foreach ($budgetExps as $budgetExp) {
            $this->addBudgetExp($budgetExp);
        }

        $this->collBudgetExps = $budgetExps;
        $this->collBudgetExpsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BudgetExp objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BudgetExp objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countBudgetExps(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collBudgetExpsPartial && !$this->isNew();
        if (null === $this->collBudgetExps || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBudgetExps) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getBudgetExps());
            }

            $query = ChildBudgetExpQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByExpenseMaster($this)
                ->count($con);
        }

        return count($this->collBudgetExps);
    }

    /**
     * Method called to associate a ChildBudgetExp object to this object
     * through the ChildBudgetExp foreign key attribute.
     *
     * @param ChildBudgetExp $l ChildBudgetExp
     * @return $this The current object (for fluent API support)
     */
    public function addBudgetExp(ChildBudgetExp $l)
    {
        if ($this->collBudgetExps === null) {
            $this->initBudgetExps();
            $this->collBudgetExpsPartial = true;
        }

        if (!$this->collBudgetExps->contains($l)) {
            $this->doAddBudgetExp($l);

            if ($this->budgetExpsScheduledForDeletion and $this->budgetExpsScheduledForDeletion->contains($l)) {
                $this->budgetExpsScheduledForDeletion->remove($this->budgetExpsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildBudgetExp $budgetExp The ChildBudgetExp object to add.
     */
    protected function doAddBudgetExp(ChildBudgetExp $budgetExp): void
    {
        $this->collBudgetExps[]= $budgetExp;
        $budgetExp->setExpenseMaster($this);
    }

    /**
     * @param ChildBudgetExp $budgetExp The ChildBudgetExp object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeBudgetExp(ChildBudgetExp $budgetExp)
    {
        if ($this->getBudgetExps()->contains($budgetExp)) {
            $pos = $this->collBudgetExps->search($budgetExp);
            $this->collBudgetExps->remove($pos);
            if (null === $this->budgetExpsScheduledForDeletion) {
                $this->budgetExpsScheduledForDeletion = clone $this->collBudgetExps;
                $this->budgetExpsScheduledForDeletion->clear();
            }
            $this->budgetExpsScheduledForDeletion[]= clone $budgetExp;
            $budgetExp->setExpenseMaster(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this ExpenseMaster is new, it will return
     * an empty collection; or if this ExpenseMaster has previously
     * been saved, it will retrieve related BudgetExps from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in ExpenseMaster.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBudgetExp[] List of ChildBudgetExp objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBudgetExp}> List of ChildBudgetExp objects
     */
    public function getBudgetExpsJoinBudgetGroup(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBudgetExpQuery::create(null, $criteria);
        $query->joinWith('BudgetGroup', $joinBehavior);

        return $this->getBudgetExps($query, $con);
    }

    /**
     * Clears out the collCompaniesRelatedByAutoCalculatedTa collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addCompaniesRelatedByAutoCalculatedTa()
     */
    public function clearCompaniesRelatedByAutoCalculatedTa()
    {
        $this->collCompaniesRelatedByAutoCalculatedTa = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collCompaniesRelatedByAutoCalculatedTa collection loaded partially.
     *
     * @return void
     */
    public function resetPartialCompaniesRelatedByAutoCalculatedTa($v = true): void
    {
        $this->collCompaniesRelatedByAutoCalculatedTaPartial = $v;
    }

    /**
     * Initializes the collCompaniesRelatedByAutoCalculatedTa collection.
     *
     * By default this just sets the collCompaniesRelatedByAutoCalculatedTa collection to an empty array (like clearcollCompaniesRelatedByAutoCalculatedTa());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initCompaniesRelatedByAutoCalculatedTa(bool $overrideExisting = true): void
    {
        if (null !== $this->collCompaniesRelatedByAutoCalculatedTa && !$overrideExisting) {
            return;
        }

        $collectionClassName = CompanyTableMap::getTableMap()->getCollectionClassName();

        $this->collCompaniesRelatedByAutoCalculatedTa = new $collectionClassName;
        $this->collCompaniesRelatedByAutoCalculatedTa->setModel('\entities\Company');
    }

    /**
     * Gets an array of ChildCompany objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildExpenseMaster is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildCompany[] List of ChildCompany objects
     * @phpstan-return ObjectCollection&\Traversable<ChildCompany> List of ChildCompany objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getCompaniesRelatedByAutoCalculatedTa(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collCompaniesRelatedByAutoCalculatedTaPartial && !$this->isNew();
        if (null === $this->collCompaniesRelatedByAutoCalculatedTa || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collCompaniesRelatedByAutoCalculatedTa) {
                    $this->initCompaniesRelatedByAutoCalculatedTa();
                } else {
                    $collectionClassName = CompanyTableMap::getTableMap()->getCollectionClassName();

                    $collCompaniesRelatedByAutoCalculatedTa = new $collectionClassName;
                    $collCompaniesRelatedByAutoCalculatedTa->setModel('\entities\Company');

                    return $collCompaniesRelatedByAutoCalculatedTa;
                }
            } else {
                $collCompaniesRelatedByAutoCalculatedTa = ChildCompanyQuery::create(null, $criteria)
                    ->filterByExpenseMasterRelatedByAutoCalculatedTa($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collCompaniesRelatedByAutoCalculatedTaPartial && count($collCompaniesRelatedByAutoCalculatedTa)) {
                        $this->initCompaniesRelatedByAutoCalculatedTa(false);

                        foreach ($collCompaniesRelatedByAutoCalculatedTa as $obj) {
                            if (false == $this->collCompaniesRelatedByAutoCalculatedTa->contains($obj)) {
                                $this->collCompaniesRelatedByAutoCalculatedTa->append($obj);
                            }
                        }

                        $this->collCompaniesRelatedByAutoCalculatedTaPartial = true;
                    }

                    return $collCompaniesRelatedByAutoCalculatedTa;
                }

                if ($partial && $this->collCompaniesRelatedByAutoCalculatedTa) {
                    foreach ($this->collCompaniesRelatedByAutoCalculatedTa as $obj) {
                        if ($obj->isNew()) {
                            $collCompaniesRelatedByAutoCalculatedTa[] = $obj;
                        }
                    }
                }

                $this->collCompaniesRelatedByAutoCalculatedTa = $collCompaniesRelatedByAutoCalculatedTa;
                $this->collCompaniesRelatedByAutoCalculatedTaPartial = false;
            }
        }

        return $this->collCompaniesRelatedByAutoCalculatedTa;
    }

    /**
     * Sets a collection of ChildCompany objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $companiesRelatedByAutoCalculatedTa A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setCompaniesRelatedByAutoCalculatedTa(Collection $companiesRelatedByAutoCalculatedTa, ?ConnectionInterface $con = null)
    {
        /** @var ChildCompany[] $companiesRelatedByAutoCalculatedTaToDelete */
        $companiesRelatedByAutoCalculatedTaToDelete = $this->getCompaniesRelatedByAutoCalculatedTa(new Criteria(), $con)->diff($companiesRelatedByAutoCalculatedTa);


        $this->companiesRelatedByAutoCalculatedTaScheduledForDeletion = $companiesRelatedByAutoCalculatedTaToDelete;

        foreach ($companiesRelatedByAutoCalculatedTaToDelete as $companyRelatedByAutoCalculatedTaRemoved) {
            $companyRelatedByAutoCalculatedTaRemoved->setExpenseMasterRelatedByAutoCalculatedTa(null);
        }

        $this->collCompaniesRelatedByAutoCalculatedTa = null;
        foreach ($companiesRelatedByAutoCalculatedTa as $companyRelatedByAutoCalculatedTa) {
            $this->addCompanyRelatedByAutoCalculatedTa($companyRelatedByAutoCalculatedTa);
        }

        $this->collCompaniesRelatedByAutoCalculatedTa = $companiesRelatedByAutoCalculatedTa;
        $this->collCompaniesRelatedByAutoCalculatedTaPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Company objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related Company objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countCompaniesRelatedByAutoCalculatedTa(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collCompaniesRelatedByAutoCalculatedTaPartial && !$this->isNew();
        if (null === $this->collCompaniesRelatedByAutoCalculatedTa || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collCompaniesRelatedByAutoCalculatedTa) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getCompaniesRelatedByAutoCalculatedTa());
            }

            $query = ChildCompanyQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByExpenseMasterRelatedByAutoCalculatedTa($this)
                ->count($con);
        }

        return count($this->collCompaniesRelatedByAutoCalculatedTa);
    }

    /**
     * Method called to associate a ChildCompany object to this object
     * through the ChildCompany foreign key attribute.
     *
     * @param ChildCompany $l ChildCompany
     * @return $this The current object (for fluent API support)
     */
    public function addCompanyRelatedByAutoCalculatedTa(ChildCompany $l)
    {
        if ($this->collCompaniesRelatedByAutoCalculatedTa === null) {
            $this->initCompaniesRelatedByAutoCalculatedTa();
            $this->collCompaniesRelatedByAutoCalculatedTaPartial = true;
        }

        if (!$this->collCompaniesRelatedByAutoCalculatedTa->contains($l)) {
            $this->doAddCompanyRelatedByAutoCalculatedTa($l);

            if ($this->companiesRelatedByAutoCalculatedTaScheduledForDeletion and $this->companiesRelatedByAutoCalculatedTaScheduledForDeletion->contains($l)) {
                $this->companiesRelatedByAutoCalculatedTaScheduledForDeletion->remove($this->companiesRelatedByAutoCalculatedTaScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildCompany $companyRelatedByAutoCalculatedTa The ChildCompany object to add.
     */
    protected function doAddCompanyRelatedByAutoCalculatedTa(ChildCompany $companyRelatedByAutoCalculatedTa): void
    {
        $this->collCompaniesRelatedByAutoCalculatedTa[]= $companyRelatedByAutoCalculatedTa;
        $companyRelatedByAutoCalculatedTa->setExpenseMasterRelatedByAutoCalculatedTa($this);
    }

    /**
     * @param ChildCompany $companyRelatedByAutoCalculatedTa The ChildCompany object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeCompanyRelatedByAutoCalculatedTa(ChildCompany $companyRelatedByAutoCalculatedTa)
    {
        if ($this->getCompaniesRelatedByAutoCalculatedTa()->contains($companyRelatedByAutoCalculatedTa)) {
            $pos = $this->collCompaniesRelatedByAutoCalculatedTa->search($companyRelatedByAutoCalculatedTa);
            $this->collCompaniesRelatedByAutoCalculatedTa->remove($pos);
            if (null === $this->companiesRelatedByAutoCalculatedTaScheduledForDeletion) {
                $this->companiesRelatedByAutoCalculatedTaScheduledForDeletion = clone $this->collCompaniesRelatedByAutoCalculatedTa;
                $this->companiesRelatedByAutoCalculatedTaScheduledForDeletion->clear();
            }
            $this->companiesRelatedByAutoCalculatedTaScheduledForDeletion[]= $companyRelatedByAutoCalculatedTa;
            $companyRelatedByAutoCalculatedTa->setExpenseMasterRelatedByAutoCalculatedTa(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this ExpenseMaster is new, it will return
     * an empty collection; or if this ExpenseMaster has previously
     * been saved, it will retrieve related CompaniesRelatedByAutoCalculatedTa from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in ExpenseMaster.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildCompany[] List of ChildCompany objects
     * @phpstan-return ObjectCollection&\Traversable<ChildCompany}> List of ChildCompany objects
     */
    public function getCompaniesRelatedByAutoCalculatedTaJoinCurrencies(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildCompanyQuery::create(null, $criteria);
        $query->joinWith('Currencies', $joinBehavior);

        return $this->getCompaniesRelatedByAutoCalculatedTa($query, $con);
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
     * If this ChildExpenseMaster is new, it will return
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
                    ->filterByExpenseMaster($this)
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
            $expenseListRemoved->setExpenseMaster(null);
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
                ->filterByExpenseMaster($this)
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
        $expenseList->setExpenseMaster($this);
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
            $expenseList->setExpenseMaster(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this ExpenseMaster is new, it will return
     * an empty collection; or if this ExpenseMaster has previously
     * been saved, it will retrieve related ExpenseLists from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in ExpenseMaster.
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
     * Otherwise if this ExpenseMaster is new, it will return
     * an empty collection; or if this ExpenseMaster has previously
     * been saved, it will retrieve related ExpenseLists from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in ExpenseMaster.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildExpenseList[] List of ChildExpenseList objects
     * @phpstan-return ObjectCollection&\Traversable<ChildExpenseList}> List of ChildExpenseList objects
     */
    public function getExpenseListsJoinExpenses(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildExpenseListQuery::create(null, $criteria);
        $query->joinWith('Expenses', $joinBehavior);

        return $this->getExpenseLists($query, $con);
    }

    /**
     * Clears out the collExpenseRepellents collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addExpenseRepellents()
     */
    public function clearExpenseRepellents()
    {
        $this->collExpenseRepellents = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collExpenseRepellents collection loaded partially.
     *
     * @return void
     */
    public function resetPartialExpenseRepellents($v = true): void
    {
        $this->collExpenseRepellentsPartial = $v;
    }

    /**
     * Initializes the collExpenseRepellents collection.
     *
     * By default this just sets the collExpenseRepellents collection to an empty array (like clearcollExpenseRepellents());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initExpenseRepellents(bool $overrideExisting = true): void
    {
        if (null !== $this->collExpenseRepellents && !$overrideExisting) {
            return;
        }

        $collectionClassName = ExpenseRepellentTableMap::getTableMap()->getCollectionClassName();

        $this->collExpenseRepellents = new $collectionClassName;
        $this->collExpenseRepellents->setModel('\entities\ExpenseRepellent');
    }

    /**
     * Gets an array of ChildExpenseRepellent objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildExpenseMaster is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildExpenseRepellent[] List of ChildExpenseRepellent objects
     * @phpstan-return ObjectCollection&\Traversable<ChildExpenseRepellent> List of ChildExpenseRepellent objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getExpenseRepellents(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collExpenseRepellentsPartial && !$this->isNew();
        if (null === $this->collExpenseRepellents || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collExpenseRepellents) {
                    $this->initExpenseRepellents();
                } else {
                    $collectionClassName = ExpenseRepellentTableMap::getTableMap()->getCollectionClassName();

                    $collExpenseRepellents = new $collectionClassName;
                    $collExpenseRepellents->setModel('\entities\ExpenseRepellent');

                    return $collExpenseRepellents;
                }
            } else {
                $collExpenseRepellents = ChildExpenseRepellentQuery::create(null, $criteria)
                    ->filterByExpenseMaster($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collExpenseRepellentsPartial && count($collExpenseRepellents)) {
                        $this->initExpenseRepellents(false);

                        foreach ($collExpenseRepellents as $obj) {
                            if (false == $this->collExpenseRepellents->contains($obj)) {
                                $this->collExpenseRepellents->append($obj);
                            }
                        }

                        $this->collExpenseRepellentsPartial = true;
                    }

                    return $collExpenseRepellents;
                }

                if ($partial && $this->collExpenseRepellents) {
                    foreach ($this->collExpenseRepellents as $obj) {
                        if ($obj->isNew()) {
                            $collExpenseRepellents[] = $obj;
                        }
                    }
                }

                $this->collExpenseRepellents = $collExpenseRepellents;
                $this->collExpenseRepellentsPartial = false;
            }
        }

        return $this->collExpenseRepellents;
    }

    /**
     * Sets a collection of ChildExpenseRepellent objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $expenseRepellents A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setExpenseRepellents(Collection $expenseRepellents, ?ConnectionInterface $con = null)
    {
        /** @var ChildExpenseRepellent[] $expenseRepellentsToDelete */
        $expenseRepellentsToDelete = $this->getExpenseRepellents(new Criteria(), $con)->diff($expenseRepellents);


        $this->expenseRepellentsScheduledForDeletion = $expenseRepellentsToDelete;

        foreach ($expenseRepellentsToDelete as $expenseRepellentRemoved) {
            $expenseRepellentRemoved->setExpenseMaster(null);
        }

        $this->collExpenseRepellents = null;
        foreach ($expenseRepellents as $expenseRepellent) {
            $this->addExpenseRepellent($expenseRepellent);
        }

        $this->collExpenseRepellents = $expenseRepellents;
        $this->collExpenseRepellentsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related ExpenseRepellent objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related ExpenseRepellent objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countExpenseRepellents(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collExpenseRepellentsPartial && !$this->isNew();
        if (null === $this->collExpenseRepellents || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collExpenseRepellents) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getExpenseRepellents());
            }

            $query = ChildExpenseRepellentQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByExpenseMaster($this)
                ->count($con);
        }

        return count($this->collExpenseRepellents);
    }

    /**
     * Method called to associate a ChildExpenseRepellent object to this object
     * through the ChildExpenseRepellent foreign key attribute.
     *
     * @param ChildExpenseRepellent $l ChildExpenseRepellent
     * @return $this The current object (for fluent API support)
     */
    public function addExpenseRepellent(ChildExpenseRepellent $l)
    {
        if ($this->collExpenseRepellents === null) {
            $this->initExpenseRepellents();
            $this->collExpenseRepellentsPartial = true;
        }

        if (!$this->collExpenseRepellents->contains($l)) {
            $this->doAddExpenseRepellent($l);

            if ($this->expenseRepellentsScheduledForDeletion and $this->expenseRepellentsScheduledForDeletion->contains($l)) {
                $this->expenseRepellentsScheduledForDeletion->remove($this->expenseRepellentsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildExpenseRepellent $expenseRepellent The ChildExpenseRepellent object to add.
     */
    protected function doAddExpenseRepellent(ChildExpenseRepellent $expenseRepellent): void
    {
        $this->collExpenseRepellents[]= $expenseRepellent;
        $expenseRepellent->setExpenseMaster($this);
    }

    /**
     * @param ChildExpenseRepellent $expenseRepellent The ChildExpenseRepellent object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeExpenseRepellent(ChildExpenseRepellent $expenseRepellent)
    {
        if ($this->getExpenseRepellents()->contains($expenseRepellent)) {
            $pos = $this->collExpenseRepellents->search($expenseRepellent);
            $this->collExpenseRepellents->remove($pos);
            if (null === $this->expenseRepellentsScheduledForDeletion) {
                $this->expenseRepellentsScheduledForDeletion = clone $this->collExpenseRepellents;
                $this->expenseRepellentsScheduledForDeletion->clear();
            }
            $this->expenseRepellentsScheduledForDeletion[]= $expenseRepellent;
            $expenseRepellent->setExpenseMaster(null);
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
        if (null !== $this->aCompanyRelatedByCompanyId) {
            $this->aCompanyRelatedByCompanyId->removeExpenseMasterRelatedByCompanyId($this);
        }
        $this->expense_id = null;
        $this->company_id = null;
        $this->expense_name = null;
        $this->default_policykey = null;
        $this->checkcity = null;
        $this->policykeya = null;
        $this->policykeyb = null;
        $this->policykeyc = null;
        $this->trips = null;
        $this->permonth = null;
        $this->nonreimbursable = null;
        $this->isdaily = null;
        $this->israteapplied = null;
        $this->rate = null;
        $this->mode = null;
        $this->commentreq = null;
        $this->additional_text = null;
        $this->is_prefilled = null;
        $this->is_mandatory = null;
        $this->can_repeat = null;
        $this->expense_tempate_name = null;
        $this->created_at = null;
        $this->updated_at = null;
        $this->is_editable = null;
        $this->attachment_required = null;
        $this->sort_order = null;
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
            if ($this->collBudgetExps) {
                foreach ($this->collBudgetExps as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collCompaniesRelatedByAutoCalculatedTa) {
                foreach ($this->collCompaniesRelatedByAutoCalculatedTa as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collExpenseLists) {
                foreach ($this->collExpenseLists as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collExpenseRepellents) {
                foreach ($this->collExpenseRepellents as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collBudgetExps = null;
        $this->collCompaniesRelatedByAutoCalculatedTa = null;
        $this->collExpenseLists = null;
        $this->collExpenseRepellents = null;
        $this->aCompanyRelatedByCompanyId = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(ExpenseMasterTableMap::DEFAULT_STRING_FORMAT);
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
