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
use entities\Company as ChildCompany;
use entities\CompanyQuery as ChildCompanyQuery;
use entities\Outlets as ChildOutlets;
use entities\OutletsQuery as ChildOutletsQuery;
use entities\Products as ChildProducts;
use entities\ProductsQuery as ChildProductsQuery;
use entities\StockTransactionQuery as ChildStockTransactionQuery;
use entities\StockVoucher as ChildStockVoucher;
use entities\StockVoucherQuery as ChildStockVoucherQuery;
use entities\Users as ChildUsers;
use entities\UsersQuery as ChildUsersQuery;
use entities\Map\StockTransactionTableMap;

/**
 * Base class that represents a row from the 'stock_transaction' table.
 *
 *
 *
 * @package    propel.generator.entities.Base
 */
abstract class StockTransaction implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\entities\\Map\\StockTransactionTableMap';


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
     * The value for the stid field.
     *
     * @var        string
     */
    protected $stid;

    /**
     * The value for the sv_id field.
     *
     * @var        string
     */
    protected $sv_id;

    /**
     * The value for the sku field.
     *
     * @var        string
     */
    protected $sku;

    /**
     * The value for the serial_no field.
     *
     * Note: this column has a database default value of: '0'
     * @var        string
     */
    protected $serial_no;

    /**
     * The value for the batch_no field.
     *
     * Note: this column has a database default value of: '0'
     * @var        string
     */
    protected $batch_no;

    /**
     * The value for the qty field.
     *
     * Note: this column has a database default value of: '0.00'
     * @var        string
     */
    protected $qty;

    /**
     * The value for the company_id field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $company_id;

    /**
     * The value for the product_id field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $product_id;

    /**
     * The value for the outlet_id field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $outlet_id;

    /**
     * The value for the tran_type field.
     *
     * @var        string
     */
    protected $tran_type;

    /**
     * The value for the ref_num field.
     *
     * @var        string|null
     */
    protected $ref_num;

    /**
     * The value for the ref_desc field.
     *
     * @var        string|null
     */
    protected $ref_desc;

    /**
     * The value for the tran_date field.
     *
     * Note: this column has a database default value of: (expression) CURRENT_TIMESTAMP
     * @var        DateTime
     */
    protected $tran_date;

    /**
     * The value for the created_user field.
     *
     * @var        int
     */
    protected $created_user;

    /**
     * @var        ChildCompany
     */
    protected $aCompany;

    /**
     * @var        ChildOutlets
     */
    protected $aOutlets;

    /**
     * @var        ChildProducts
     */
    protected $aProducts;

    /**
     * @var        ChildStockVoucher
     */
    protected $aStockVoucher;

    /**
     * @var        ChildUsers
     */
    protected $aUsers;

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
        $this->serial_no = '0';
        $this->batch_no = '0';
        $this->qty = '0.00';
        $this->company_id = 0;
        $this->product_id = 0;
        $this->outlet_id = 0;
    }

    /**
     * Initializes internal state of entities\Base\StockTransaction object.
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
     * Compares this with another <code>StockTransaction</code> instance.  If
     * <code>obj</code> is an instance of <code>StockTransaction</code>, delegates to
     * <code>equals(StockTransaction)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [stid] column value.
     *
     * @return string
     */
    public function getStid()
    {
        return $this->stid;
    }

    /**
     * Get the [sv_id] column value.
     *
     * @return string
     */
    public function getSvId()
    {
        return $this->sv_id;
    }

    /**
     * Get the [sku] column value.
     *
     * @return string
     */
    public function getSku()
    {
        return $this->sku;
    }

    /**
     * Get the [serial_no] column value.
     *
     * @return string
     */
    public function getSerialNo()
    {
        return $this->serial_no;
    }

    /**
     * Get the [batch_no] column value.
     *
     * @return string
     */
    public function getBatchNo()
    {
        return $this->batch_no;
    }

    /**
     * Get the [qty] column value.
     *
     * @return string
     */
    public function getQty()
    {
        return $this->qty;
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
     * Get the [product_id] column value.
     *
     * @return int
     */
    public function getProductId()
    {
        return $this->product_id;
    }

    /**
     * Get the [outlet_id] column value.
     *
     * @return int
     */
    public function getOutletId()
    {
        return $this->outlet_id;
    }

    /**
     * Get the [tran_type] column value.
     *
     * @return string
     */
    public function getTranType()
    {
        return $this->tran_type;
    }

    /**
     * Get the [ref_num] column value.
     *
     * @return string|null
     */
    public function getRefNum()
    {
        return $this->ref_num;
    }

    /**
     * Get the [ref_desc] column value.
     *
     * @return string|null
     */
    public function getRefDesc()
    {
        return $this->ref_desc;
    }

    /**
     * Get the [optionally formatted] temporal [tran_date] column value.
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
    public function getTranDate($format = null)
    {
        if ($format === null) {
            return $this->tran_date;
        } else {
            return $this->tran_date instanceof \DateTimeInterface ? $this->tran_date->format($format) : null;
        }
    }

    /**
     * Get the [created_user] column value.
     *
     * @return int
     */
    public function getCreatedUser()
    {
        return $this->created_user;
    }

    /**
     * Set the value of [stid] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setStid($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->stid !== $v) {
            $this->stid = $v;
            $this->modifiedColumns[StockTransactionTableMap::COL_STID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [sv_id] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setSvId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->sv_id !== $v) {
            $this->sv_id = $v;
            $this->modifiedColumns[StockTransactionTableMap::COL_SV_ID] = true;
        }

        if ($this->aStockVoucher !== null && $this->aStockVoucher->getSvid() !== $v) {
            $this->aStockVoucher = null;
        }

        return $this;
    }

    /**
     * Set the value of [sku] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setSku($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->sku !== $v) {
            $this->sku = $v;
            $this->modifiedColumns[StockTransactionTableMap::COL_SKU] = true;
        }

        return $this;
    }

    /**
     * Set the value of [serial_no] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setSerialNo($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->serial_no !== $v) {
            $this->serial_no = $v;
            $this->modifiedColumns[StockTransactionTableMap::COL_SERIAL_NO] = true;
        }

        return $this;
    }

    /**
     * Set the value of [batch_no] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setBatchNo($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->batch_no !== $v) {
            $this->batch_no = $v;
            $this->modifiedColumns[StockTransactionTableMap::COL_BATCH_NO] = true;
        }

        return $this;
    }

    /**
     * Set the value of [qty] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setQty($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->qty !== $v) {
            $this->qty = $v;
            $this->modifiedColumns[StockTransactionTableMap::COL_QTY] = true;
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
            $this->modifiedColumns[StockTransactionTableMap::COL_COMPANY_ID] = true;
        }

        if ($this->aCompany !== null && $this->aCompany->getCompanyId() !== $v) {
            $this->aCompany = null;
        }

        return $this;
    }

    /**
     * Set the value of [product_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setProductId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->product_id !== $v) {
            $this->product_id = $v;
            $this->modifiedColumns[StockTransactionTableMap::COL_PRODUCT_ID] = true;
        }

        if ($this->aProducts !== null && $this->aProducts->getId() !== $v) {
            $this->aProducts = null;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOutletId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->outlet_id !== $v) {
            $this->outlet_id = $v;
            $this->modifiedColumns[StockTransactionTableMap::COL_OUTLET_ID] = true;
        }

        if ($this->aOutlets !== null && $this->aOutlets->getId() !== $v) {
            $this->aOutlets = null;
        }

        return $this;
    }

    /**
     * Set the value of [tran_type] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setTranType($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->tran_type !== $v) {
            $this->tran_type = $v;
            $this->modifiedColumns[StockTransactionTableMap::COL_TRAN_TYPE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [ref_num] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setRefNum($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->ref_num !== $v) {
            $this->ref_num = $v;
            $this->modifiedColumns[StockTransactionTableMap::COL_REF_NUM] = true;
        }

        return $this;
    }

    /**
     * Set the value of [ref_desc] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setRefDesc($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->ref_desc !== $v) {
            $this->ref_desc = $v;
            $this->modifiedColumns[StockTransactionTableMap::COL_REF_DESC] = true;
        }

        return $this;
    }

    /**
     * Sets the value of [tran_date] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setTranDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->tran_date !== null || $dt !== null) {
            if ($this->tran_date === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->tran_date->format("Y-m-d H:i:s.u")) {
                $this->tran_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[StockTransactionTableMap::COL_TRAN_DATE] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [created_user] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCreatedUser($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->created_user !== $v) {
            $this->created_user = $v;
            $this->modifiedColumns[StockTransactionTableMap::COL_CREATED_USER] = true;
        }

        if ($this->aUsers !== null && $this->aUsers->getUserId() !== $v) {
            $this->aUsers = null;
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
            if ($this->serial_no !== '0') {
                return false;
            }

            if ($this->batch_no !== '0') {
                return false;
            }

            if ($this->qty !== '0.00') {
                return false;
            }

            if ($this->company_id !== 0) {
                return false;
            }

            if ($this->product_id !== 0) {
                return false;
            }

            if ($this->outlet_id !== 0) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : StockTransactionTableMap::translateFieldName('Stid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->stid = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : StockTransactionTableMap::translateFieldName('SvId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->sv_id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : StockTransactionTableMap::translateFieldName('Sku', TableMap::TYPE_PHPNAME, $indexType)];
            $this->sku = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : StockTransactionTableMap::translateFieldName('SerialNo', TableMap::TYPE_PHPNAME, $indexType)];
            $this->serial_no = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : StockTransactionTableMap::translateFieldName('BatchNo', TableMap::TYPE_PHPNAME, $indexType)];
            $this->batch_no = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : StockTransactionTableMap::translateFieldName('Qty', TableMap::TYPE_PHPNAME, $indexType)];
            $this->qty = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : StockTransactionTableMap::translateFieldName('CompanyId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->company_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : StockTransactionTableMap::translateFieldName('ProductId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->product_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : StockTransactionTableMap::translateFieldName('OutletId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : StockTransactionTableMap::translateFieldName('TranType', TableMap::TYPE_PHPNAME, $indexType)];
            $this->tran_type = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : StockTransactionTableMap::translateFieldName('RefNum', TableMap::TYPE_PHPNAME, $indexType)];
            $this->ref_num = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : StockTransactionTableMap::translateFieldName('RefDesc', TableMap::TYPE_PHPNAME, $indexType)];
            $this->ref_desc = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : StockTransactionTableMap::translateFieldName('TranDate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->tran_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : StockTransactionTableMap::translateFieldName('CreatedUser', TableMap::TYPE_PHPNAME, $indexType)];
            $this->created_user = (null !== $col) ? (int) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 14; // 14 = StockTransactionTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\entities\\StockTransaction'), 0, $e);
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
        if ($this->aStockVoucher !== null && $this->sv_id !== $this->aStockVoucher->getSvid()) {
            $this->aStockVoucher = null;
        }
        if ($this->aCompany !== null && $this->company_id !== $this->aCompany->getCompanyId()) {
            $this->aCompany = null;
        }
        if ($this->aProducts !== null && $this->product_id !== $this->aProducts->getId()) {
            $this->aProducts = null;
        }
        if ($this->aOutlets !== null && $this->outlet_id !== $this->aOutlets->getId()) {
            $this->aOutlets = null;
        }
        if ($this->aUsers !== null && $this->created_user !== $this->aUsers->getUserId()) {
            $this->aUsers = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(StockTransactionTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildStockTransactionQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aCompany = null;
            $this->aOutlets = null;
            $this->aProducts = null;
            $this->aStockVoucher = null;
            $this->aUsers = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see StockTransaction::setDeleted()
     * @see StockTransaction::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(StockTransactionTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildStockTransactionQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(StockTransactionTableMap::DATABASE_NAME);
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
                StockTransactionTableMap::addInstanceToPool($this);
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

            if ($this->aOutlets !== null) {
                if ($this->aOutlets->isModified() || $this->aOutlets->isNew()) {
                    $affectedRows += $this->aOutlets->save($con);
                }
                $this->setOutlets($this->aOutlets);
            }

            if ($this->aProducts !== null) {
                if ($this->aProducts->isModified() || $this->aProducts->isNew()) {
                    $affectedRows += $this->aProducts->save($con);
                }
                $this->setProducts($this->aProducts);
            }

            if ($this->aStockVoucher !== null) {
                if ($this->aStockVoucher->isModified() || $this->aStockVoucher->isNew()) {
                    $affectedRows += $this->aStockVoucher->save($con);
                }
                $this->setStockVoucher($this->aStockVoucher);
            }

            if ($this->aUsers !== null) {
                if ($this->aUsers->isModified() || $this->aUsers->isNew()) {
                    $affectedRows += $this->aUsers->save($con);
                }
                $this->setUsers($this->aUsers);
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

        $this->modifiedColumns[StockTransactionTableMap::COL_STID] = true;
        if (null !== $this->stid) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . StockTransactionTableMap::COL_STID . ')');
        }
        if (null === $this->stid) {
            try {
                $dataFetcher = $con->query("SELECT nextval('stock_transaction_stid_seq')");
                $this->stid = (string) $dataFetcher->fetchColumn();
            } catch (Exception $e) {
                throw new PropelException('Unable to get sequence id.', 0, $e);
            }
        }


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(StockTransactionTableMap::COL_STID)) {
            $modifiedColumns[':p' . $index++]  = 'stid';
        }
        if ($this->isColumnModified(StockTransactionTableMap::COL_SV_ID)) {
            $modifiedColumns[':p' . $index++]  = 'sv_id';
        }
        if ($this->isColumnModified(StockTransactionTableMap::COL_SKU)) {
            $modifiedColumns[':p' . $index++]  = 'sku';
        }
        if ($this->isColumnModified(StockTransactionTableMap::COL_SERIAL_NO)) {
            $modifiedColumns[':p' . $index++]  = 'serial_no';
        }
        if ($this->isColumnModified(StockTransactionTableMap::COL_BATCH_NO)) {
            $modifiedColumns[':p' . $index++]  = 'batch_no';
        }
        if ($this->isColumnModified(StockTransactionTableMap::COL_QTY)) {
            $modifiedColumns[':p' . $index++]  = 'qty';
        }
        if ($this->isColumnModified(StockTransactionTableMap::COL_COMPANY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'company_id';
        }
        if ($this->isColumnModified(StockTransactionTableMap::COL_PRODUCT_ID)) {
            $modifiedColumns[':p' . $index++]  = 'product_id';
        }
        if ($this->isColumnModified(StockTransactionTableMap::COL_OUTLET_ID)) {
            $modifiedColumns[':p' . $index++]  = 'outlet_id';
        }
        if ($this->isColumnModified(StockTransactionTableMap::COL_TRAN_TYPE)) {
            $modifiedColumns[':p' . $index++]  = 'tran_type';
        }
        if ($this->isColumnModified(StockTransactionTableMap::COL_REF_NUM)) {
            $modifiedColumns[':p' . $index++]  = 'ref_num';
        }
        if ($this->isColumnModified(StockTransactionTableMap::COL_REF_DESC)) {
            $modifiedColumns[':p' . $index++]  = 'ref_desc';
        }
        if ($this->isColumnModified(StockTransactionTableMap::COL_TRAN_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'tran_date';
        }
        if ($this->isColumnModified(StockTransactionTableMap::COL_CREATED_USER)) {
            $modifiedColumns[':p' . $index++]  = 'created_user';
        }

        $sql = sprintf(
            'INSERT INTO stock_transaction (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'stid':
                        $stmt->bindValue($identifier, $this->stid, PDO::PARAM_INT);

                        break;
                    case 'sv_id':
                        $stmt->bindValue($identifier, $this->sv_id, PDO::PARAM_INT);

                        break;
                    case 'sku':
                        $stmt->bindValue($identifier, $this->sku, PDO::PARAM_STR);

                        break;
                    case 'serial_no':
                        $stmt->bindValue($identifier, $this->serial_no, PDO::PARAM_STR);

                        break;
                    case 'batch_no':
                        $stmt->bindValue($identifier, $this->batch_no, PDO::PARAM_STR);

                        break;
                    case 'qty':
                        $stmt->bindValue($identifier, $this->qty, PDO::PARAM_STR);

                        break;
                    case 'company_id':
                        $stmt->bindValue($identifier, $this->company_id, PDO::PARAM_INT);

                        break;
                    case 'product_id':
                        $stmt->bindValue($identifier, $this->product_id, PDO::PARAM_INT);

                        break;
                    case 'outlet_id':
                        $stmt->bindValue($identifier, $this->outlet_id, PDO::PARAM_INT);

                        break;
                    case 'tran_type':
                        $stmt->bindValue($identifier, $this->tran_type, PDO::PARAM_STR);

                        break;
                    case 'ref_num':
                        $stmt->bindValue($identifier, $this->ref_num, PDO::PARAM_STR);

                        break;
                    case 'ref_desc':
                        $stmt->bindValue($identifier, $this->ref_desc, PDO::PARAM_STR);

                        break;
                    case 'tran_date':
                        $stmt->bindValue($identifier, $this->tran_date ? $this->tran_date->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'created_user':
                        $stmt->bindValue($identifier, $this->created_user, PDO::PARAM_INT);

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
        $pos = StockTransactionTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getStid();

            case 1:
                return $this->getSvId();

            case 2:
                return $this->getSku();

            case 3:
                return $this->getSerialNo();

            case 4:
                return $this->getBatchNo();

            case 5:
                return $this->getQty();

            case 6:
                return $this->getCompanyId();

            case 7:
                return $this->getProductId();

            case 8:
                return $this->getOutletId();

            case 9:
                return $this->getTranType();

            case 10:
                return $this->getRefNum();

            case 11:
                return $this->getRefDesc();

            case 12:
                return $this->getTranDate();

            case 13:
                return $this->getCreatedUser();

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
        if (isset($alreadyDumpedObjects['StockTransaction'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['StockTransaction'][$this->hashCode()] = true;
        $keys = StockTransactionTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getStid(),
            $keys[1] => $this->getSvId(),
            $keys[2] => $this->getSku(),
            $keys[3] => $this->getSerialNo(),
            $keys[4] => $this->getBatchNo(),
            $keys[5] => $this->getQty(),
            $keys[6] => $this->getCompanyId(),
            $keys[7] => $this->getProductId(),
            $keys[8] => $this->getOutletId(),
            $keys[9] => $this->getTranType(),
            $keys[10] => $this->getRefNum(),
            $keys[11] => $this->getRefDesc(),
            $keys[12] => $this->getTranDate(),
            $keys[13] => $this->getCreatedUser(),
        ];
        if ($result[$keys[12]] instanceof \DateTimeInterface) {
            $result[$keys[12]] = $result[$keys[12]]->format('Y-m-d H:i:s.u');
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
            if (null !== $this->aOutlets) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'outlets';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'outlets';
                        break;
                    default:
                        $key = 'Outlets';
                }

                $result[$key] = $this->aOutlets->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aProducts) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'products';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'products';
                        break;
                    default:
                        $key = 'Products';
                }

                $result[$key] = $this->aProducts->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aStockVoucher) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'stockVoucher';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'stock_voucher';
                        break;
                    default:
                        $key = 'StockVoucher';
                }

                $result[$key] = $this->aStockVoucher->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aUsers) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'users';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'users';
                        break;
                    default:
                        $key = 'Users';
                }

                $result[$key] = $this->aUsers->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
        $pos = StockTransactionTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setStid($value);
                break;
            case 1:
                $this->setSvId($value);
                break;
            case 2:
                $this->setSku($value);
                break;
            case 3:
                $this->setSerialNo($value);
                break;
            case 4:
                $this->setBatchNo($value);
                break;
            case 5:
                $this->setQty($value);
                break;
            case 6:
                $this->setCompanyId($value);
                break;
            case 7:
                $this->setProductId($value);
                break;
            case 8:
                $this->setOutletId($value);
                break;
            case 9:
                $this->setTranType($value);
                break;
            case 10:
                $this->setRefNum($value);
                break;
            case 11:
                $this->setRefDesc($value);
                break;
            case 12:
                $this->setTranDate($value);
                break;
            case 13:
                $this->setCreatedUser($value);
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
        $keys = StockTransactionTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setStid($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setSvId($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setSku($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setSerialNo($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setBatchNo($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setQty($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setCompanyId($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setProductId($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setOutletId($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setTranType($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setRefNum($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setRefDesc($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setTranDate($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setCreatedUser($arr[$keys[13]]);
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
        $criteria = new Criteria(StockTransactionTableMap::DATABASE_NAME);

        if ($this->isColumnModified(StockTransactionTableMap::COL_STID)) {
            $criteria->add(StockTransactionTableMap::COL_STID, $this->stid);
        }
        if ($this->isColumnModified(StockTransactionTableMap::COL_SV_ID)) {
            $criteria->add(StockTransactionTableMap::COL_SV_ID, $this->sv_id);
        }
        if ($this->isColumnModified(StockTransactionTableMap::COL_SKU)) {
            $criteria->add(StockTransactionTableMap::COL_SKU, $this->sku);
        }
        if ($this->isColumnModified(StockTransactionTableMap::COL_SERIAL_NO)) {
            $criteria->add(StockTransactionTableMap::COL_SERIAL_NO, $this->serial_no);
        }
        if ($this->isColumnModified(StockTransactionTableMap::COL_BATCH_NO)) {
            $criteria->add(StockTransactionTableMap::COL_BATCH_NO, $this->batch_no);
        }
        if ($this->isColumnModified(StockTransactionTableMap::COL_QTY)) {
            $criteria->add(StockTransactionTableMap::COL_QTY, $this->qty);
        }
        if ($this->isColumnModified(StockTransactionTableMap::COL_COMPANY_ID)) {
            $criteria->add(StockTransactionTableMap::COL_COMPANY_ID, $this->company_id);
        }
        if ($this->isColumnModified(StockTransactionTableMap::COL_PRODUCT_ID)) {
            $criteria->add(StockTransactionTableMap::COL_PRODUCT_ID, $this->product_id);
        }
        if ($this->isColumnModified(StockTransactionTableMap::COL_OUTLET_ID)) {
            $criteria->add(StockTransactionTableMap::COL_OUTLET_ID, $this->outlet_id);
        }
        if ($this->isColumnModified(StockTransactionTableMap::COL_TRAN_TYPE)) {
            $criteria->add(StockTransactionTableMap::COL_TRAN_TYPE, $this->tran_type);
        }
        if ($this->isColumnModified(StockTransactionTableMap::COL_REF_NUM)) {
            $criteria->add(StockTransactionTableMap::COL_REF_NUM, $this->ref_num);
        }
        if ($this->isColumnModified(StockTransactionTableMap::COL_REF_DESC)) {
            $criteria->add(StockTransactionTableMap::COL_REF_DESC, $this->ref_desc);
        }
        if ($this->isColumnModified(StockTransactionTableMap::COL_TRAN_DATE)) {
            $criteria->add(StockTransactionTableMap::COL_TRAN_DATE, $this->tran_date);
        }
        if ($this->isColumnModified(StockTransactionTableMap::COL_CREATED_USER)) {
            $criteria->add(StockTransactionTableMap::COL_CREATED_USER, $this->created_user);
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
        $criteria = ChildStockTransactionQuery::create();
        $criteria->add(StockTransactionTableMap::COL_STID, $this->stid);

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
        $validPk = null !== $this->getStid();

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
     * @return string
     */
    public function getPrimaryKey()
    {
        return $this->getStid();
    }

    /**
     * Generic method to set the primary key (stid column).
     *
     * @param string|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?string $key = null): void
    {
        $this->setStid($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getStid();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \entities\StockTransaction (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setSvId($this->getSvId());
        $copyObj->setSku($this->getSku());
        $copyObj->setSerialNo($this->getSerialNo());
        $copyObj->setBatchNo($this->getBatchNo());
        $copyObj->setQty($this->getQty());
        $copyObj->setCompanyId($this->getCompanyId());
        $copyObj->setProductId($this->getProductId());
        $copyObj->setOutletId($this->getOutletId());
        $copyObj->setTranType($this->getTranType());
        $copyObj->setRefNum($this->getRefNum());
        $copyObj->setRefDesc($this->getRefDesc());
        $copyObj->setTranDate($this->getTranDate());
        $copyObj->setCreatedUser($this->getCreatedUser());
        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setStid(NULL); // this is a auto-increment column, so set to default value
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
     * @return \entities\StockTransaction Clone of current object.
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
            $this->setCompanyId(0);
        } else {
            $this->setCompanyId($v->getCompanyId());
        }

        $this->aCompany = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildCompany object, it will not be re-added.
        if ($v !== null) {
            $v->addStockTransaction($this);
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
                $this->aCompany->addStockTransactions($this);
             */
        }

        return $this->aCompany;
    }

    /**
     * Declares an association between this object and a ChildOutlets object.
     *
     * @param ChildOutlets $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setOutlets(ChildOutlets $v = null)
    {
        if ($v === null) {
            $this->setOutletId(0);
        } else {
            $this->setOutletId($v->getId());
        }

        $this->aOutlets = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildOutlets object, it will not be re-added.
        if ($v !== null) {
            $v->addStockTransaction($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildOutlets object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildOutlets The associated ChildOutlets object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOutlets(?ConnectionInterface $con = null)
    {
        if ($this->aOutlets === null && ($this->outlet_id != 0)) {
            $this->aOutlets = ChildOutletsQuery::create()->findPk($this->outlet_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aOutlets->addStockTransactions($this);
             */
        }

        return $this->aOutlets;
    }

    /**
     * Declares an association between this object and a ChildProducts object.
     *
     * @param ChildProducts $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setProducts(ChildProducts $v = null)
    {
        if ($v === null) {
            $this->setProductId(0);
        } else {
            $this->setProductId($v->getId());
        }

        $this->aProducts = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildProducts object, it will not be re-added.
        if ($v !== null) {
            $v->addStockTransaction($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildProducts object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildProducts The associated ChildProducts object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getProducts(?ConnectionInterface $con = null)
    {
        if ($this->aProducts === null && ($this->product_id != 0)) {
            $this->aProducts = ChildProductsQuery::create()->findPk($this->product_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aProducts->addStockTransactions($this);
             */
        }

        return $this->aProducts;
    }

    /**
     * Declares an association between this object and a ChildStockVoucher object.
     *
     * @param ChildStockVoucher $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setStockVoucher(ChildStockVoucher $v = null)
    {
        if ($v === null) {
            $this->setSvId(NULL);
        } else {
            $this->setSvId($v->getSvid());
        }

        $this->aStockVoucher = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildStockVoucher object, it will not be re-added.
        if ($v !== null) {
            $v->addStockTransaction($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildStockVoucher object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildStockVoucher The associated ChildStockVoucher object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getStockVoucher(?ConnectionInterface $con = null)
    {
        if ($this->aStockVoucher === null && (($this->sv_id !== "" && $this->sv_id !== null))) {
            $this->aStockVoucher = ChildStockVoucherQuery::create()->findPk($this->sv_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aStockVoucher->addStockTransactions($this);
             */
        }

        return $this->aStockVoucher;
    }

    /**
     * Declares an association between this object and a ChildUsers object.
     *
     * @param ChildUsers $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setUsers(ChildUsers $v = null)
    {
        if ($v === null) {
            $this->setCreatedUser(NULL);
        } else {
            $this->setCreatedUser($v->getUserId());
        }

        $this->aUsers = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildUsers object, it will not be re-added.
        if ($v !== null) {
            $v->addStockTransaction($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildUsers object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildUsers The associated ChildUsers object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getUsers(?ConnectionInterface $con = null)
    {
        if ($this->aUsers === null && ($this->created_user != 0)) {
            $this->aUsers = ChildUsersQuery::create()->findPk($this->created_user, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aUsers->addStockTransactions($this);
             */
        }

        return $this->aUsers;
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
            $this->aCompany->removeStockTransaction($this);
        }
        if (null !== $this->aOutlets) {
            $this->aOutlets->removeStockTransaction($this);
        }
        if (null !== $this->aProducts) {
            $this->aProducts->removeStockTransaction($this);
        }
        if (null !== $this->aStockVoucher) {
            $this->aStockVoucher->removeStockTransaction($this);
        }
        if (null !== $this->aUsers) {
            $this->aUsers->removeStockTransaction($this);
        }
        $this->stid = null;
        $this->sv_id = null;
        $this->sku = null;
        $this->serial_no = null;
        $this->batch_no = null;
        $this->qty = null;
        $this->company_id = null;
        $this->product_id = null;
        $this->outlet_id = null;
        $this->tran_type = null;
        $this->ref_num = null;
        $this->ref_desc = null;
        $this->tran_date = null;
        $this->created_user = null;
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

        $this->aCompany = null;
        $this->aOutlets = null;
        $this->aProducts = null;
        $this->aStockVoucher = null;
        $this->aUsers = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(StockTransactionTableMap::DEFAULT_STRING_FORMAT);
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
