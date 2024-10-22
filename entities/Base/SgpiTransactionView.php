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
use entities\Map\SgpiTransactionViewTableMap;

/**
 * Base class that represents a row from the 'sgpi_transaction_view' table.
 *
 *
 *
 * @package    propel.generator.entities.Base
 */
abstract class SgpiTransactionView implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\entities\\Map\\SgpiTransactionViewTableMap';


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
     * The value for the sgpi_name field.
     *
     * @var        string|null
     */
    protected $sgpi_name;

    /**
     * The value for the cd field.
     *
     * @var        string|null
     */
    protected $cd;

    /**
     * The value for the qty field.
     *
     * @var        string|null
     */
    protected $qty;

    /**
     * The value for the credits field.
     *
     * @var        string|null
     */
    protected $credits;

    /**
     * The value for the debits field.
     *
     * @var        string|null
     */
    protected $debits;

    /**
     * The value for the employee_id field.
     *
     * @var        string|null
     */
    protected $employee_id;

    /**
     * The value for the voucher_no field.
     *
     * @var        string|null
     */
    protected $voucher_no;

    /**
     * The value for the remark field.
     *
     * @var        string|null
     */
    protected $remark;

    /**
     * The value for the outlet_name field.
     *
     * @var        string|null
     */
    protected $outlet_name;

    /**
     * The value for the dcr_date field.
     *
     * @var        string|null
     */
    protected $dcr_date;

    /**
     * The value for the outlettype_name field.
     *
     * @var        string|null
     */
    protected $outlettype_name;

    /**
     * The value for the beat_name field.
     *
     * @var        string|null
     */
    protected $beat_name;

    /**
     * The value for the use_start_date field.
     *
     * @var        string|null
     */
    protected $use_start_date;

    /**
     * The value for the use_end_date field.
     *
     * @var        string|null
     */
    protected $use_end_date;

    /**
     * The value for the sgpi_id field.
     *
     * @var        string|null
     */
    protected $sgpi_id;

    /**
     * The value for the employee_code field.
     *
     * @var        string|null
     */
    protected $employee_code;

    /**
     * The value for the created_at field.
     *
     * @var        string|null
     */
    protected $created_at;

    /**
     * The value for the brand_name field.
     *
     * @var        string|null
     */
    protected $brand_name;

    /**
     * The value for the outlet_code field.
     *
     * @var        string|null
     */
    protected $outlet_code;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * Initializes internal state of entities\Base\SgpiTransactionView object.
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
     * Compares this with another <code>SgpiTransactionView</code> instance.  If
     * <code>obj</code> is an instance of <code>SgpiTransactionView</code>, delegates to
     * <code>equals(SgpiTransactionView)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [sgpi_name] column value.
     *
     * @return string|null
     */
    public function getSgpiName()
    {
        return $this->sgpi_name;
    }

    /**
     * Get the [cd] column value.
     *
     * @return string|null
     */
    public function getCd()
    {
        return $this->cd;
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
     * Get the [credits] column value.
     *
     * @return string|null
     */
    public function getCredits()
    {
        return $this->credits;
    }

    /**
     * Get the [debits] column value.
     *
     * @return string|null
     */
    public function getDebits()
    {
        return $this->debits;
    }

    /**
     * Get the [employee_id] column value.
     *
     * @return string|null
     */
    public function getEmployeeId()
    {
        return $this->employee_id;
    }

    /**
     * Get the [voucher_no] column value.
     *
     * @return string|null
     */
    public function getVoucherNo()
    {
        return $this->voucher_no;
    }

    /**
     * Get the [remark] column value.
     *
     * @return string|null
     */
    public function getRemark()
    {
        return $this->remark;
    }

    /**
     * Get the [outlet_name] column value.
     *
     * @return string|null
     */
    public function getOutletName()
    {
        return $this->outlet_name;
    }

    /**
     * Get the [dcr_date] column value.
     *
     * @return string|null
     */
    public function getDcrDate()
    {
        return $this->dcr_date;
    }

    /**
     * Get the [outlettype_name] column value.
     *
     * @return string|null
     */
    public function getOutlettypeName()
    {
        return $this->outlettype_name;
    }

    /**
     * Get the [beat_name] column value.
     *
     * @return string|null
     */
    public function getBeatName()
    {
        return $this->beat_name;
    }

    /**
     * Get the [use_start_date] column value.
     *
     * @return string|null
     */
    public function getUseStartDate()
    {
        return $this->use_start_date;
    }

    /**
     * Get the [use_end_date] column value.
     *
     * @return string|null
     */
    public function getUseEndDate()
    {
        return $this->use_end_date;
    }

    /**
     * Get the [sgpi_id] column value.
     *
     * @return string|null
     */
    public function getSgpiId()
    {
        return $this->sgpi_id;
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
     * Get the [created_at] column value.
     *
     * @return string|null
     */
    public function getCreatedTa()
    {
        return $this->created_at;
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
     * Get the [outlet_code] column value.
     *
     * @return string|null
     */
    public function getOutletCode()
    {
        return $this->outlet_code;
    }

    /**
     * Set the value of [sgpi_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setSgpiName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->sgpi_name !== $v) {
            $this->sgpi_name = $v;
            $this->modifiedColumns[SgpiTransactionViewTableMap::COL_SGPI_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [cd] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setCd($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->cd !== $v) {
            $this->cd = $v;
            $this->modifiedColumns[SgpiTransactionViewTableMap::COL_CD] = true;
        }

        return $this;
    }

    /**
     * Set the value of [qty] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setQty($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->qty !== $v) {
            $this->qty = $v;
            $this->modifiedColumns[SgpiTransactionViewTableMap::COL_QTY] = true;
        }

        return $this;
    }

    /**
     * Set the value of [credits] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setCredits($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->credits !== $v) {
            $this->credits = $v;
            $this->modifiedColumns[SgpiTransactionViewTableMap::COL_CREDITS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [debits] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setDebits($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->debits !== $v) {
            $this->debits = $v;
            $this->modifiedColumns[SgpiTransactionViewTableMap::COL_DEBITS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [employee_id] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setEmployeeId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->employee_id !== $v) {
            $this->employee_id = $v;
            $this->modifiedColumns[SgpiTransactionViewTableMap::COL_EMPLOYEE_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [voucher_no] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setVoucherNo($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->voucher_no !== $v) {
            $this->voucher_no = $v;
            $this->modifiedColumns[SgpiTransactionViewTableMap::COL_VOUCHER_NO] = true;
        }

        return $this;
    }

    /**
     * Set the value of [remark] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setRemark($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->remark !== $v) {
            $this->remark = $v;
            $this->modifiedColumns[SgpiTransactionViewTableMap::COL_REMARK] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOutletName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->outlet_name !== $v) {
            $this->outlet_name = $v;
            $this->modifiedColumns[SgpiTransactionViewTableMap::COL_OUTLET_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [dcr_date] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setDcrDate($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->dcr_date !== $v) {
            $this->dcr_date = $v;
            $this->modifiedColumns[SgpiTransactionViewTableMap::COL_DCR_DATE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlettype_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOutlettypeName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->outlettype_name !== $v) {
            $this->outlettype_name = $v;
            $this->modifiedColumns[SgpiTransactionViewTableMap::COL_OUTLETTYPE_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [beat_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setBeatName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->beat_name !== $v) {
            $this->beat_name = $v;
            $this->modifiedColumns[SgpiTransactionViewTableMap::COL_BEAT_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [use_start_date] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setUseStartDate($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->use_start_date !== $v) {
            $this->use_start_date = $v;
            $this->modifiedColumns[SgpiTransactionViewTableMap::COL_USE_START_DATE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [use_end_date] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setUseEndDate($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->use_end_date !== $v) {
            $this->use_end_date = $v;
            $this->modifiedColumns[SgpiTransactionViewTableMap::COL_USE_END_DATE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [sgpi_id] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setSgpiId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->sgpi_id !== $v) {
            $this->sgpi_id = $v;
            $this->modifiedColumns[SgpiTransactionViewTableMap::COL_SGPI_ID] = true;
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
            $this->modifiedColumns[SgpiTransactionViewTableMap::COL_EMPLOYEE_CODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [created_at] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setCreatedTa($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->created_at !== $v) {
            $this->created_at = $v;
            $this->modifiedColumns[SgpiTransactionViewTableMap::COL_CREATED_AT] = true;
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
            $this->modifiedColumns[SgpiTransactionViewTableMap::COL_BRAND_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_code] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOutletCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->outlet_code !== $v) {
            $this->outlet_code = $v;
            $this->modifiedColumns[SgpiTransactionViewTableMap::COL_OUTLET_CODE] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SgpiTransactionViewTableMap::translateFieldName('SgpiName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->sgpi_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SgpiTransactionViewTableMap::translateFieldName('Cd', TableMap::TYPE_PHPNAME, $indexType)];
            $this->cd = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SgpiTransactionViewTableMap::translateFieldName('Qty', TableMap::TYPE_PHPNAME, $indexType)];
            $this->qty = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : SgpiTransactionViewTableMap::translateFieldName('Credits', TableMap::TYPE_PHPNAME, $indexType)];
            $this->credits = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : SgpiTransactionViewTableMap::translateFieldName('Debits', TableMap::TYPE_PHPNAME, $indexType)];
            $this->debits = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : SgpiTransactionViewTableMap::translateFieldName('EmployeeId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->employee_id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : SgpiTransactionViewTableMap::translateFieldName('VoucherNo', TableMap::TYPE_PHPNAME, $indexType)];
            $this->voucher_no = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : SgpiTransactionViewTableMap::translateFieldName('Remark', TableMap::TYPE_PHPNAME, $indexType)];
            $this->remark = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : SgpiTransactionViewTableMap::translateFieldName('OutletName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : SgpiTransactionViewTableMap::translateFieldName('DcrDate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->dcr_date = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : SgpiTransactionViewTableMap::translateFieldName('OutlettypeName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlettype_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : SgpiTransactionViewTableMap::translateFieldName('BeatName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->beat_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : SgpiTransactionViewTableMap::translateFieldName('UseStartDate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->use_start_date = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : SgpiTransactionViewTableMap::translateFieldName('UseEndDate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->use_end_date = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : SgpiTransactionViewTableMap::translateFieldName('SgpiId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->sgpi_id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : SgpiTransactionViewTableMap::translateFieldName('EmployeeCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->employee_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : SgpiTransactionViewTableMap::translateFieldName('CreatedTa', TableMap::TYPE_PHPNAME, $indexType)];
            $this->created_at = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : SgpiTransactionViewTableMap::translateFieldName('BrandName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->brand_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 18 + $startcol : SgpiTransactionViewTableMap::translateFieldName('OutletCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_code = (null !== $col) ? (string) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 19; // 19 = SgpiTransactionViewTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\entities\\SgpiTransactionView'), 0, $e);
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
        $pos = SgpiTransactionViewTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getSgpiName();

            case 1:
                return $this->getCd();

            case 2:
                return $this->getQty();

            case 3:
                return $this->getCredits();

            case 4:
                return $this->getDebits();

            case 5:
                return $this->getEmployeeId();

            case 6:
                return $this->getVoucherNo();

            case 7:
                return $this->getRemark();

            case 8:
                return $this->getOutletName();

            case 9:
                return $this->getDcrDate();

            case 10:
                return $this->getOutlettypeName();

            case 11:
                return $this->getBeatName();

            case 12:
                return $this->getUseStartDate();

            case 13:
                return $this->getUseEndDate();

            case 14:
                return $this->getSgpiId();

            case 15:
                return $this->getEmployeeCode();

            case 16:
                return $this->getCreatedTa();

            case 17:
                return $this->getBrandName();

            case 18:
                return $this->getOutletCode();

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
        if (isset($alreadyDumpedObjects['SgpiTransactionView'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['SgpiTransactionView'][$this->hashCode()] = true;
        $keys = SgpiTransactionViewTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getSgpiName(),
            $keys[1] => $this->getCd(),
            $keys[2] => $this->getQty(),
            $keys[3] => $this->getCredits(),
            $keys[4] => $this->getDebits(),
            $keys[5] => $this->getEmployeeId(),
            $keys[6] => $this->getVoucherNo(),
            $keys[7] => $this->getRemark(),
            $keys[8] => $this->getOutletName(),
            $keys[9] => $this->getDcrDate(),
            $keys[10] => $this->getOutlettypeName(),
            $keys[11] => $this->getBeatName(),
            $keys[12] => $this->getUseStartDate(),
            $keys[13] => $this->getUseEndDate(),
            $keys[14] => $this->getSgpiId(),
            $keys[15] => $this->getEmployeeCode(),
            $keys[16] => $this->getCreatedTa(),
            $keys[17] => $this->getBrandName(),
            $keys[18] => $this->getOutletCode(),
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
        $criteria = new Criteria(SgpiTransactionViewTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SgpiTransactionViewTableMap::COL_SGPI_NAME)) {
            $criteria->add(SgpiTransactionViewTableMap::COL_SGPI_NAME, $this->sgpi_name);
        }
        if ($this->isColumnModified(SgpiTransactionViewTableMap::COL_CD)) {
            $criteria->add(SgpiTransactionViewTableMap::COL_CD, $this->cd);
        }
        if ($this->isColumnModified(SgpiTransactionViewTableMap::COL_QTY)) {
            $criteria->add(SgpiTransactionViewTableMap::COL_QTY, $this->qty);
        }
        if ($this->isColumnModified(SgpiTransactionViewTableMap::COL_CREDITS)) {
            $criteria->add(SgpiTransactionViewTableMap::COL_CREDITS, $this->credits);
        }
        if ($this->isColumnModified(SgpiTransactionViewTableMap::COL_DEBITS)) {
            $criteria->add(SgpiTransactionViewTableMap::COL_DEBITS, $this->debits);
        }
        if ($this->isColumnModified(SgpiTransactionViewTableMap::COL_EMPLOYEE_ID)) {
            $criteria->add(SgpiTransactionViewTableMap::COL_EMPLOYEE_ID, $this->employee_id);
        }
        if ($this->isColumnModified(SgpiTransactionViewTableMap::COL_VOUCHER_NO)) {
            $criteria->add(SgpiTransactionViewTableMap::COL_VOUCHER_NO, $this->voucher_no);
        }
        if ($this->isColumnModified(SgpiTransactionViewTableMap::COL_REMARK)) {
            $criteria->add(SgpiTransactionViewTableMap::COL_REMARK, $this->remark);
        }
        if ($this->isColumnModified(SgpiTransactionViewTableMap::COL_OUTLET_NAME)) {
            $criteria->add(SgpiTransactionViewTableMap::COL_OUTLET_NAME, $this->outlet_name);
        }
        if ($this->isColumnModified(SgpiTransactionViewTableMap::COL_DCR_DATE)) {
            $criteria->add(SgpiTransactionViewTableMap::COL_DCR_DATE, $this->dcr_date);
        }
        if ($this->isColumnModified(SgpiTransactionViewTableMap::COL_OUTLETTYPE_NAME)) {
            $criteria->add(SgpiTransactionViewTableMap::COL_OUTLETTYPE_NAME, $this->outlettype_name);
        }
        if ($this->isColumnModified(SgpiTransactionViewTableMap::COL_BEAT_NAME)) {
            $criteria->add(SgpiTransactionViewTableMap::COL_BEAT_NAME, $this->beat_name);
        }
        if ($this->isColumnModified(SgpiTransactionViewTableMap::COL_USE_START_DATE)) {
            $criteria->add(SgpiTransactionViewTableMap::COL_USE_START_DATE, $this->use_start_date);
        }
        if ($this->isColumnModified(SgpiTransactionViewTableMap::COL_USE_END_DATE)) {
            $criteria->add(SgpiTransactionViewTableMap::COL_USE_END_DATE, $this->use_end_date);
        }
        if ($this->isColumnModified(SgpiTransactionViewTableMap::COL_SGPI_ID)) {
            $criteria->add(SgpiTransactionViewTableMap::COL_SGPI_ID, $this->sgpi_id);
        }
        if ($this->isColumnModified(SgpiTransactionViewTableMap::COL_EMPLOYEE_CODE)) {
            $criteria->add(SgpiTransactionViewTableMap::COL_EMPLOYEE_CODE, $this->employee_code);
        }
        if ($this->isColumnModified(SgpiTransactionViewTableMap::COL_CREATED_AT)) {
            $criteria->add(SgpiTransactionViewTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(SgpiTransactionViewTableMap::COL_BRAND_NAME)) {
            $criteria->add(SgpiTransactionViewTableMap::COL_BRAND_NAME, $this->brand_name);
        }
        if ($this->isColumnModified(SgpiTransactionViewTableMap::COL_OUTLET_CODE)) {
            $criteria->add(SgpiTransactionViewTableMap::COL_OUTLET_CODE, $this->outlet_code);
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
        throw new LogicException('The SgpiTransactionView object has no primary key');

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
     * @param object $copyObj An object of \entities\SgpiTransactionView (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setSgpiName($this->getSgpiName());
        $copyObj->setCd($this->getCd());
        $copyObj->setQty($this->getQty());
        $copyObj->setCredits($this->getCredits());
        $copyObj->setDebits($this->getDebits());
        $copyObj->setEmployeeId($this->getEmployeeId());
        $copyObj->setVoucherNo($this->getVoucherNo());
        $copyObj->setRemark($this->getRemark());
        $copyObj->setOutletName($this->getOutletName());
        $copyObj->setDcrDate($this->getDcrDate());
        $copyObj->setOutlettypeName($this->getOutlettypeName());
        $copyObj->setBeatName($this->getBeatName());
        $copyObj->setUseStartDate($this->getUseStartDate());
        $copyObj->setUseEndDate($this->getUseEndDate());
        $copyObj->setSgpiId($this->getSgpiId());
        $copyObj->setEmployeeCode($this->getEmployeeCode());
        $copyObj->setCreatedTa($this->getCreatedTa());
        $copyObj->setBrandName($this->getBrandName());
        $copyObj->setOutletCode($this->getOutletCode());
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
     * @return \entities\SgpiTransactionView Clone of current object.
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
        $this->sgpi_name = null;
        $this->cd = null;
        $this->qty = null;
        $this->credits = null;
        $this->debits = null;
        $this->employee_id = null;
        $this->voucher_no = null;
        $this->remark = null;
        $this->outlet_name = null;
        $this->dcr_date = null;
        $this->outlettype_name = null;
        $this->beat_name = null;
        $this->use_start_date = null;
        $this->use_end_date = null;
        $this->sgpi_id = null;
        $this->employee_code = null;
        $this->created_at = null;
        $this->brand_name = null;
        $this->outlet_code = null;
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
        return (string) $this->exportTo(SgpiTransactionViewTableMap::DEFAULT_STRING_FORMAT);
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
