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
use entities\Shippingorder as ChildShippingorder;
use entities\ShippingorderQuery as ChildShippingorderQuery;
use entities\StockTransaction as ChildStockTransaction;
use entities\StockTransactionQuery as ChildStockTransactionQuery;
use entities\StockVoucher as ChildStockVoucher;
use entities\StockVoucherQuery as ChildStockVoucherQuery;
use entities\Users as ChildUsers;
use entities\UsersQuery as ChildUsersQuery;
use entities\Map\ShippingorderTableMap;
use entities\Map\StockTransactionTableMap;
use entities\Map\StockVoucherTableMap;

/**
 * Base class that represents a row from the 'stock_voucher' table.
 *
 *
 *
 * @package    propel.generator.entities.Base
 */
abstract class StockVoucher implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\entities\\Map\\StockVoucherTableMap';


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
     * The value for the svid field.
     *
     * @var        string
     */
    protected $svid;

    /**
     * The value for the sv_user_id field.
     *
     * @var        int
     */
    protected $sv_user_id;

    /**
     * The value for the sv_date field.
     *
     * Note: this column has a database default value of: (expression) CURRENT_TIMESTAMP
     * @var        DateTime
     */
    protected $sv_date;

    /**
     * The value for the company_id field.
     *
     * @var        int
     */
    protected $company_id;

    /**
     * The value for the sv_remark field.
     *
     * Note: this column has a database default value of: ''
     * @var        string
     */
    protected $sv_remark;

    /**
     * The value for the sv_desc field.
     *
     * Note: this column has a database default value of: ''
     * @var        string
     */
    protected $sv_desc;

    /**
     * The value for the sv_type field.
     *
     * @var        string
     */
    protected $sv_type;

    /**
     * The value for the total_qty field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $total_qty;

    /**
     * The value for the sv_error field.
     *
     * @var        string|null
     */
    protected $sv_error;

    /**
     * The value for the sv_status field.
     *
     * Note: this column has a database default value of: 'Draft'
     * @var        string
     */
    protected $sv_status;

    /**
     * @var        ChildCompany
     */
    protected $aCompany;

    /**
     * @var        ChildUsers
     */
    protected $aUsers;

    /**
     * @var        ObjectCollection|ChildShippingorder[] Collection to store aggregation of ChildShippingorder objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildShippingorder> Collection to store aggregation of ChildShippingorder objects.
     */
    protected $collShippingorders;
    protected $collShippingordersPartial;

    /**
     * @var        ObjectCollection|ChildStockTransaction[] Collection to store aggregation of ChildStockTransaction objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildStockTransaction> Collection to store aggregation of ChildStockTransaction objects.
     */
    protected $collStockTransactions;
    protected $collStockTransactionsPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildShippingorder[]
     * @phpstan-var ObjectCollection&\Traversable<ChildShippingorder>
     */
    protected $shippingordersScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildStockTransaction[]
     * @phpstan-var ObjectCollection&\Traversable<ChildStockTransaction>
     */
    protected $stockTransactionsScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues(): void
    {
        $this->sv_remark = '';
        $this->sv_desc = '';
        $this->total_qty = 0;
        $this->sv_status = 'Draft';
    }

    /**
     * Initializes internal state of entities\Base\StockVoucher object.
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
     * Compares this with another <code>StockVoucher</code> instance.  If
     * <code>obj</code> is an instance of <code>StockVoucher</code>, delegates to
     * <code>equals(StockVoucher)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [svid] column value.
     *
     * @return string
     */
    public function getSvid()
    {
        return $this->svid;
    }

    /**
     * Get the [sv_user_id] column value.
     *
     * @return int
     */
    public function getSvUserId()
    {
        return $this->sv_user_id;
    }

    /**
     * Get the [optionally formatted] temporal [sv_date] column value.
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
    public function getSvDate($format = null)
    {
        if ($format === null) {
            return $this->sv_date;
        } else {
            return $this->sv_date instanceof \DateTimeInterface ? $this->sv_date->format($format) : null;
        }
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
     * Get the [sv_remark] column value.
     *
     * @return string
     */
    public function getSvRemark()
    {
        return $this->sv_remark;
    }

    /**
     * Get the [sv_desc] column value.
     *
     * @return string
     */
    public function getSvDesc()
    {
        return $this->sv_desc;
    }

    /**
     * Get the [sv_type] column value.
     *
     * @return string
     */
    public function getSvType()
    {
        return $this->sv_type;
    }

    /**
     * Get the [total_qty] column value.
     *
     * @return int
     */
    public function getTotalQty()
    {
        return $this->total_qty;
    }

    /**
     * Get the [sv_error] column value.
     *
     * @return string|null
     */
    public function getSvError()
    {
        return $this->sv_error;
    }

    /**
     * Get the [sv_status] column value.
     *
     * @return string
     */
    public function getSvStatus()
    {
        return $this->sv_status;
    }

    /**
     * Set the value of [svid] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setSvid($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->svid !== $v) {
            $this->svid = $v;
            $this->modifiedColumns[StockVoucherTableMap::COL_SVID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [sv_user_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setSvUserId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->sv_user_id !== $v) {
            $this->sv_user_id = $v;
            $this->modifiedColumns[StockVoucherTableMap::COL_SV_USER_ID] = true;
        }

        if ($this->aUsers !== null && $this->aUsers->getUserId() !== $v) {
            $this->aUsers = null;
        }

        return $this;
    }

    /**
     * Sets the value of [sv_date] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setSvDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->sv_date !== null || $dt !== null) {
            if ($this->sv_date === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->sv_date->format("Y-m-d H:i:s.u")) {
                $this->sv_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[StockVoucherTableMap::COL_SV_DATE] = true;
            }
        } // if either are not null

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
            $this->modifiedColumns[StockVoucherTableMap::COL_COMPANY_ID] = true;
        }

        if ($this->aCompany !== null && $this->aCompany->getCompanyId() !== $v) {
            $this->aCompany = null;
        }

        return $this;
    }

    /**
     * Set the value of [sv_remark] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setSvRemark($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->sv_remark !== $v) {
            $this->sv_remark = $v;
            $this->modifiedColumns[StockVoucherTableMap::COL_SV_REMARK] = true;
        }

        return $this;
    }

    /**
     * Set the value of [sv_desc] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setSvDesc($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->sv_desc !== $v) {
            $this->sv_desc = $v;
            $this->modifiedColumns[StockVoucherTableMap::COL_SV_DESC] = true;
        }

        return $this;
    }

    /**
     * Set the value of [sv_type] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setSvType($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->sv_type !== $v) {
            $this->sv_type = $v;
            $this->modifiedColumns[StockVoucherTableMap::COL_SV_TYPE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [total_qty] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setTotalQty($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->total_qty !== $v) {
            $this->total_qty = $v;
            $this->modifiedColumns[StockVoucherTableMap::COL_TOTAL_QTY] = true;
        }

        return $this;
    }

    /**
     * Set the value of [sv_error] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setSvError($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->sv_error !== $v) {
            $this->sv_error = $v;
            $this->modifiedColumns[StockVoucherTableMap::COL_SV_ERROR] = true;
        }

        return $this;
    }

    /**
     * Set the value of [sv_status] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setSvStatus($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->sv_status !== $v) {
            $this->sv_status = $v;
            $this->modifiedColumns[StockVoucherTableMap::COL_SV_STATUS] = true;
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
            if ($this->sv_remark !== '') {
                return false;
            }

            if ($this->sv_desc !== '') {
                return false;
            }

            if ($this->total_qty !== 0) {
                return false;
            }

            if ($this->sv_status !== 'Draft') {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : StockVoucherTableMap::translateFieldName('Svid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->svid = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : StockVoucherTableMap::translateFieldName('SvUserId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->sv_user_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : StockVoucherTableMap::translateFieldName('SvDate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->sv_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : StockVoucherTableMap::translateFieldName('CompanyId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->company_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : StockVoucherTableMap::translateFieldName('SvRemark', TableMap::TYPE_PHPNAME, $indexType)];
            $this->sv_remark = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : StockVoucherTableMap::translateFieldName('SvDesc', TableMap::TYPE_PHPNAME, $indexType)];
            $this->sv_desc = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : StockVoucherTableMap::translateFieldName('SvType', TableMap::TYPE_PHPNAME, $indexType)];
            $this->sv_type = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : StockVoucherTableMap::translateFieldName('TotalQty', TableMap::TYPE_PHPNAME, $indexType)];
            $this->total_qty = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : StockVoucherTableMap::translateFieldName('SvError', TableMap::TYPE_PHPNAME, $indexType)];
            $this->sv_error = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : StockVoucherTableMap::translateFieldName('SvStatus', TableMap::TYPE_PHPNAME, $indexType)];
            $this->sv_status = (null !== $col) ? (string) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 10; // 10 = StockVoucherTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\entities\\StockVoucher'), 0, $e);
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
        if ($this->aUsers !== null && $this->sv_user_id !== $this->aUsers->getUserId()) {
            $this->aUsers = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(StockVoucherTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildStockVoucherQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aCompany = null;
            $this->aUsers = null;
            $this->collShippingorders = null;

            $this->collStockTransactions = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see StockVoucher::setDeleted()
     * @see StockVoucher::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(StockVoucherTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildStockVoucherQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(StockVoucherTableMap::DATABASE_NAME);
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
                StockVoucherTableMap::addInstanceToPool($this);
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

            if ($this->shippingordersScheduledForDeletion !== null) {
                if (!$this->shippingordersScheduledForDeletion->isEmpty()) {
                    foreach ($this->shippingordersScheduledForDeletion as $shippingorder) {
                        // need to save related object because we set the relation to null
                        $shippingorder->save($con);
                    }
                    $this->shippingordersScheduledForDeletion = null;
                }
            }

            if ($this->collShippingorders !== null) {
                foreach ($this->collShippingorders as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->stockTransactionsScheduledForDeletion !== null) {
                if (!$this->stockTransactionsScheduledForDeletion->isEmpty()) {
                    \entities\StockTransactionQuery::create()
                        ->filterByPrimaryKeys($this->stockTransactionsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->stockTransactionsScheduledForDeletion = null;
                }
            }

            if ($this->collStockTransactions !== null) {
                foreach ($this->collStockTransactions as $referrerFK) {
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

        $this->modifiedColumns[StockVoucherTableMap::COL_SVID] = true;
        if (null !== $this->svid) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . StockVoucherTableMap::COL_SVID . ')');
        }
        if (null === $this->svid) {
            try {
                $dataFetcher = $con->query("SELECT nextval('stock_voucher_svid_seq')");
                $this->svid = (string) $dataFetcher->fetchColumn();
            } catch (Exception $e) {
                throw new PropelException('Unable to get sequence id.', 0, $e);
            }
        }


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(StockVoucherTableMap::COL_SVID)) {
            $modifiedColumns[':p' . $index++]  = 'svid';
        }
        if ($this->isColumnModified(StockVoucherTableMap::COL_SV_USER_ID)) {
            $modifiedColumns[':p' . $index++]  = 'sv_user_id';
        }
        if ($this->isColumnModified(StockVoucherTableMap::COL_SV_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'sv_date';
        }
        if ($this->isColumnModified(StockVoucherTableMap::COL_COMPANY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'company_id';
        }
        if ($this->isColumnModified(StockVoucherTableMap::COL_SV_REMARK)) {
            $modifiedColumns[':p' . $index++]  = 'sv_remark';
        }
        if ($this->isColumnModified(StockVoucherTableMap::COL_SV_DESC)) {
            $modifiedColumns[':p' . $index++]  = 'sv_desc';
        }
        if ($this->isColumnModified(StockVoucherTableMap::COL_SV_TYPE)) {
            $modifiedColumns[':p' . $index++]  = 'sv_type';
        }
        if ($this->isColumnModified(StockVoucherTableMap::COL_TOTAL_QTY)) {
            $modifiedColumns[':p' . $index++]  = 'total_qty';
        }
        if ($this->isColumnModified(StockVoucherTableMap::COL_SV_ERROR)) {
            $modifiedColumns[':p' . $index++]  = 'sv_error';
        }
        if ($this->isColumnModified(StockVoucherTableMap::COL_SV_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'sv_status';
        }

        $sql = sprintf(
            'INSERT INTO stock_voucher (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'svid':
                        $stmt->bindValue($identifier, $this->svid, PDO::PARAM_INT);

                        break;
                    case 'sv_user_id':
                        $stmt->bindValue($identifier, $this->sv_user_id, PDO::PARAM_INT);

                        break;
                    case 'sv_date':
                        $stmt->bindValue($identifier, $this->sv_date ? $this->sv_date->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'company_id':
                        $stmt->bindValue($identifier, $this->company_id, PDO::PARAM_INT);

                        break;
                    case 'sv_remark':
                        $stmt->bindValue($identifier, $this->sv_remark, PDO::PARAM_STR);

                        break;
                    case 'sv_desc':
                        $stmt->bindValue($identifier, $this->sv_desc, PDO::PARAM_STR);

                        break;
                    case 'sv_type':
                        $stmt->bindValue($identifier, $this->sv_type, PDO::PARAM_STR);

                        break;
                    case 'total_qty':
                        $stmt->bindValue($identifier, $this->total_qty, PDO::PARAM_INT);

                        break;
                    case 'sv_error':
                        $stmt->bindValue($identifier, $this->sv_error, PDO::PARAM_STR);

                        break;
                    case 'sv_status':
                        $stmt->bindValue($identifier, $this->sv_status, PDO::PARAM_STR);

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
        $pos = StockVoucherTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getSvid();

            case 1:
                return $this->getSvUserId();

            case 2:
                return $this->getSvDate();

            case 3:
                return $this->getCompanyId();

            case 4:
                return $this->getSvRemark();

            case 5:
                return $this->getSvDesc();

            case 6:
                return $this->getSvType();

            case 7:
                return $this->getTotalQty();

            case 8:
                return $this->getSvError();

            case 9:
                return $this->getSvStatus();

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
        if (isset($alreadyDumpedObjects['StockVoucher'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['StockVoucher'][$this->hashCode()] = true;
        $keys = StockVoucherTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getSvid(),
            $keys[1] => $this->getSvUserId(),
            $keys[2] => $this->getSvDate(),
            $keys[3] => $this->getCompanyId(),
            $keys[4] => $this->getSvRemark(),
            $keys[5] => $this->getSvDesc(),
            $keys[6] => $this->getSvType(),
            $keys[7] => $this->getTotalQty(),
            $keys[8] => $this->getSvError(),
            $keys[9] => $this->getSvStatus(),
        ];
        if ($result[$keys[2]] instanceof \DateTimeInterface) {
            $result[$keys[2]] = $result[$keys[2]]->format('Y-m-d H:i:s.u');
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
            if (null !== $this->collShippingorders) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'shippingorders';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'shippingorders';
                        break;
                    default:
                        $key = 'Shippingorders';
                }

                $result[$key] = $this->collShippingorders->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collStockTransactions) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'stockTransactions';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'stock_transactions';
                        break;
                    default:
                        $key = 'StockTransactions';
                }

                $result[$key] = $this->collStockTransactions->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = StockVoucherTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setSvid($value);
                break;
            case 1:
                $this->setSvUserId($value);
                break;
            case 2:
                $this->setSvDate($value);
                break;
            case 3:
                $this->setCompanyId($value);
                break;
            case 4:
                $this->setSvRemark($value);
                break;
            case 5:
                $this->setSvDesc($value);
                break;
            case 6:
                $this->setSvType($value);
                break;
            case 7:
                $this->setTotalQty($value);
                break;
            case 8:
                $this->setSvError($value);
                break;
            case 9:
                $this->setSvStatus($value);
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
        $keys = StockVoucherTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setSvid($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setSvUserId($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setSvDate($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setCompanyId($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setSvRemark($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setSvDesc($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setSvType($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setTotalQty($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setSvError($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setSvStatus($arr[$keys[9]]);
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
        $criteria = new Criteria(StockVoucherTableMap::DATABASE_NAME);

        if ($this->isColumnModified(StockVoucherTableMap::COL_SVID)) {
            $criteria->add(StockVoucherTableMap::COL_SVID, $this->svid);
        }
        if ($this->isColumnModified(StockVoucherTableMap::COL_SV_USER_ID)) {
            $criteria->add(StockVoucherTableMap::COL_SV_USER_ID, $this->sv_user_id);
        }
        if ($this->isColumnModified(StockVoucherTableMap::COL_SV_DATE)) {
            $criteria->add(StockVoucherTableMap::COL_SV_DATE, $this->sv_date);
        }
        if ($this->isColumnModified(StockVoucherTableMap::COL_COMPANY_ID)) {
            $criteria->add(StockVoucherTableMap::COL_COMPANY_ID, $this->company_id);
        }
        if ($this->isColumnModified(StockVoucherTableMap::COL_SV_REMARK)) {
            $criteria->add(StockVoucherTableMap::COL_SV_REMARK, $this->sv_remark);
        }
        if ($this->isColumnModified(StockVoucherTableMap::COL_SV_DESC)) {
            $criteria->add(StockVoucherTableMap::COL_SV_DESC, $this->sv_desc);
        }
        if ($this->isColumnModified(StockVoucherTableMap::COL_SV_TYPE)) {
            $criteria->add(StockVoucherTableMap::COL_SV_TYPE, $this->sv_type);
        }
        if ($this->isColumnModified(StockVoucherTableMap::COL_TOTAL_QTY)) {
            $criteria->add(StockVoucherTableMap::COL_TOTAL_QTY, $this->total_qty);
        }
        if ($this->isColumnModified(StockVoucherTableMap::COL_SV_ERROR)) {
            $criteria->add(StockVoucherTableMap::COL_SV_ERROR, $this->sv_error);
        }
        if ($this->isColumnModified(StockVoucherTableMap::COL_SV_STATUS)) {
            $criteria->add(StockVoucherTableMap::COL_SV_STATUS, $this->sv_status);
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
        $criteria = ChildStockVoucherQuery::create();
        $criteria->add(StockVoucherTableMap::COL_SVID, $this->svid);

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
        $validPk = null !== $this->getSvid();

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
        return $this->getSvid();
    }

    /**
     * Generic method to set the primary key (svid column).
     *
     * @param string|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?string $key = null): void
    {
        $this->setSvid($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getSvid();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \entities\StockVoucher (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setSvUserId($this->getSvUserId());
        $copyObj->setSvDate($this->getSvDate());
        $copyObj->setCompanyId($this->getCompanyId());
        $copyObj->setSvRemark($this->getSvRemark());
        $copyObj->setSvDesc($this->getSvDesc());
        $copyObj->setSvType($this->getSvType());
        $copyObj->setTotalQty($this->getTotalQty());
        $copyObj->setSvError($this->getSvError());
        $copyObj->setSvStatus($this->getSvStatus());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getShippingorders() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addShippingorder($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getStockTransactions() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addStockTransaction($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setSvid(NULL); // this is a auto-increment column, so set to default value
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
     * @return \entities\StockVoucher Clone of current object.
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
            $v->addStockVoucher($this);
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
                $this->aCompany->addStockVouchers($this);
             */
        }

        return $this->aCompany;
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
            $this->setSvUserId(NULL);
        } else {
            $this->setSvUserId($v->getUserId());
        }

        $this->aUsers = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildUsers object, it will not be re-added.
        if ($v !== null) {
            $v->addStockVoucher($this);
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
        if ($this->aUsers === null && ($this->sv_user_id != 0)) {
            $this->aUsers = ChildUsersQuery::create()->findPk($this->sv_user_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aUsers->addStockVouchers($this);
             */
        }

        return $this->aUsers;
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
        if ('Shippingorder' === $relationName) {
            $this->initShippingorders();
            return;
        }
        if ('StockTransaction' === $relationName) {
            $this->initStockTransactions();
            return;
        }
    }

    /**
     * Clears out the collShippingorders collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addShippingorders()
     */
    public function clearShippingorders()
    {
        $this->collShippingorders = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collShippingorders collection loaded partially.
     *
     * @return void
     */
    public function resetPartialShippingorders($v = true): void
    {
        $this->collShippingordersPartial = $v;
    }

    /**
     * Initializes the collShippingorders collection.
     *
     * By default this just sets the collShippingorders collection to an empty array (like clearcollShippingorders());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initShippingorders(bool $overrideExisting = true): void
    {
        if (null !== $this->collShippingorders && !$overrideExisting) {
            return;
        }

        $collectionClassName = ShippingorderTableMap::getTableMap()->getCollectionClassName();

        $this->collShippingorders = new $collectionClassName;
        $this->collShippingorders->setModel('\entities\Shippingorder');
    }

    /**
     * Gets an array of ChildShippingorder objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildStockVoucher is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildShippingorder[] List of ChildShippingorder objects
     * @phpstan-return ObjectCollection&\Traversable<ChildShippingorder> List of ChildShippingorder objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getShippingorders(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collShippingordersPartial && !$this->isNew();
        if (null === $this->collShippingorders || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collShippingorders) {
                    $this->initShippingorders();
                } else {
                    $collectionClassName = ShippingorderTableMap::getTableMap()->getCollectionClassName();

                    $collShippingorders = new $collectionClassName;
                    $collShippingorders->setModel('\entities\Shippingorder');

                    return $collShippingorders;
                }
            } else {
                $collShippingorders = ChildShippingorderQuery::create(null, $criteria)
                    ->filterByStockVoucher($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collShippingordersPartial && count($collShippingorders)) {
                        $this->initShippingorders(false);

                        foreach ($collShippingorders as $obj) {
                            if (false == $this->collShippingorders->contains($obj)) {
                                $this->collShippingorders->append($obj);
                            }
                        }

                        $this->collShippingordersPartial = true;
                    }

                    return $collShippingorders;
                }

                if ($partial && $this->collShippingorders) {
                    foreach ($this->collShippingorders as $obj) {
                        if ($obj->isNew()) {
                            $collShippingorders[] = $obj;
                        }
                    }
                }

                $this->collShippingorders = $collShippingorders;
                $this->collShippingordersPartial = false;
            }
        }

        return $this->collShippingorders;
    }

    /**
     * Sets a collection of ChildShippingorder objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $shippingorders A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setShippingorders(Collection $shippingorders, ?ConnectionInterface $con = null)
    {
        /** @var ChildShippingorder[] $shippingordersToDelete */
        $shippingordersToDelete = $this->getShippingorders(new Criteria(), $con)->diff($shippingorders);


        $this->shippingordersScheduledForDeletion = $shippingordersToDelete;

        foreach ($shippingordersToDelete as $shippingorderRemoved) {
            $shippingorderRemoved->setStockVoucher(null);
        }

        $this->collShippingorders = null;
        foreach ($shippingorders as $shippingorder) {
            $this->addShippingorder($shippingorder);
        }

        $this->collShippingorders = $shippingorders;
        $this->collShippingordersPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Shippingorder objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related Shippingorder objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countShippingorders(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collShippingordersPartial && !$this->isNew();
        if (null === $this->collShippingorders || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collShippingorders) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getShippingorders());
            }

            $query = ChildShippingorderQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByStockVoucher($this)
                ->count($con);
        }

        return count($this->collShippingorders);
    }

    /**
     * Method called to associate a ChildShippingorder object to this object
     * through the ChildShippingorder foreign key attribute.
     *
     * @param ChildShippingorder $l ChildShippingorder
     * @return $this The current object (for fluent API support)
     */
    public function addShippingorder(ChildShippingorder $l)
    {
        if ($this->collShippingorders === null) {
            $this->initShippingorders();
            $this->collShippingordersPartial = true;
        }

        if (!$this->collShippingorders->contains($l)) {
            $this->doAddShippingorder($l);

            if ($this->shippingordersScheduledForDeletion and $this->shippingordersScheduledForDeletion->contains($l)) {
                $this->shippingordersScheduledForDeletion->remove($this->shippingordersScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildShippingorder $shippingorder The ChildShippingorder object to add.
     */
    protected function doAddShippingorder(ChildShippingorder $shippingorder): void
    {
        $this->collShippingorders[]= $shippingorder;
        $shippingorder->setStockVoucher($this);
    }

    /**
     * @param ChildShippingorder $shippingorder The ChildShippingorder object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeShippingorder(ChildShippingorder $shippingorder)
    {
        if ($this->getShippingorders()->contains($shippingorder)) {
            $pos = $this->collShippingorders->search($shippingorder);
            $this->collShippingorders->remove($pos);
            if (null === $this->shippingordersScheduledForDeletion) {
                $this->shippingordersScheduledForDeletion = clone $this->collShippingorders;
                $this->shippingordersScheduledForDeletion->clear();
            }
            $this->shippingordersScheduledForDeletion[]= $shippingorder;
            $shippingorder->setStockVoucher(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this StockVoucher is new, it will return
     * an empty collection; or if this StockVoucher has previously
     * been saved, it will retrieve related Shippingorders from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in StockVoucher.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildShippingorder[] List of ChildShippingorder objects
     * @phpstan-return ObjectCollection&\Traversable<ChildShippingorder}> List of ChildShippingorder objects
     */
    public function getShippingordersJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildShippingorderQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getShippingorders($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this StockVoucher is new, it will return
     * an empty collection; or if this StockVoucher has previously
     * been saved, it will retrieve related Shippingorders from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in StockVoucher.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildShippingorder[] List of ChildShippingorder objects
     * @phpstan-return ObjectCollection&\Traversable<ChildShippingorder}> List of ChildShippingorder objects
     */
    public function getShippingordersJoinOrders(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildShippingorderQuery::create(null, $criteria);
        $query->joinWith('Orders', $joinBehavior);

        return $this->getShippingorders($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this StockVoucher is new, it will return
     * an empty collection; or if this StockVoucher has previously
     * been saved, it will retrieve related Shippingorders from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in StockVoucher.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildShippingorder[] List of ChildShippingorder objects
     * @phpstan-return ObjectCollection&\Traversable<ChildShippingorder}> List of ChildShippingorder objects
     */
    public function getShippingordersJoinUsers(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildShippingorderQuery::create(null, $criteria);
        $query->joinWith('Users', $joinBehavior);

        return $this->getShippingorders($query, $con);
    }

    /**
     * Clears out the collStockTransactions collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addStockTransactions()
     */
    public function clearStockTransactions()
    {
        $this->collStockTransactions = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collStockTransactions collection loaded partially.
     *
     * @return void
     */
    public function resetPartialStockTransactions($v = true): void
    {
        $this->collStockTransactionsPartial = $v;
    }

    /**
     * Initializes the collStockTransactions collection.
     *
     * By default this just sets the collStockTransactions collection to an empty array (like clearcollStockTransactions());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initStockTransactions(bool $overrideExisting = true): void
    {
        if (null !== $this->collStockTransactions && !$overrideExisting) {
            return;
        }

        $collectionClassName = StockTransactionTableMap::getTableMap()->getCollectionClassName();

        $this->collStockTransactions = new $collectionClassName;
        $this->collStockTransactions->setModel('\entities\StockTransaction');
    }

    /**
     * Gets an array of ChildStockTransaction objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildStockVoucher is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildStockTransaction[] List of ChildStockTransaction objects
     * @phpstan-return ObjectCollection&\Traversable<ChildStockTransaction> List of ChildStockTransaction objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getStockTransactions(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collStockTransactionsPartial && !$this->isNew();
        if (null === $this->collStockTransactions || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collStockTransactions) {
                    $this->initStockTransactions();
                } else {
                    $collectionClassName = StockTransactionTableMap::getTableMap()->getCollectionClassName();

                    $collStockTransactions = new $collectionClassName;
                    $collStockTransactions->setModel('\entities\StockTransaction');

                    return $collStockTransactions;
                }
            } else {
                $collStockTransactions = ChildStockTransactionQuery::create(null, $criteria)
                    ->filterByStockVoucher($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collStockTransactionsPartial && count($collStockTransactions)) {
                        $this->initStockTransactions(false);

                        foreach ($collStockTransactions as $obj) {
                            if (false == $this->collStockTransactions->contains($obj)) {
                                $this->collStockTransactions->append($obj);
                            }
                        }

                        $this->collStockTransactionsPartial = true;
                    }

                    return $collStockTransactions;
                }

                if ($partial && $this->collStockTransactions) {
                    foreach ($this->collStockTransactions as $obj) {
                        if ($obj->isNew()) {
                            $collStockTransactions[] = $obj;
                        }
                    }
                }

                $this->collStockTransactions = $collStockTransactions;
                $this->collStockTransactionsPartial = false;
            }
        }

        return $this->collStockTransactions;
    }

    /**
     * Sets a collection of ChildStockTransaction objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $stockTransactions A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setStockTransactions(Collection $stockTransactions, ?ConnectionInterface $con = null)
    {
        /** @var ChildStockTransaction[] $stockTransactionsToDelete */
        $stockTransactionsToDelete = $this->getStockTransactions(new Criteria(), $con)->diff($stockTransactions);


        $this->stockTransactionsScheduledForDeletion = $stockTransactionsToDelete;

        foreach ($stockTransactionsToDelete as $stockTransactionRemoved) {
            $stockTransactionRemoved->setStockVoucher(null);
        }

        $this->collStockTransactions = null;
        foreach ($stockTransactions as $stockTransaction) {
            $this->addStockTransaction($stockTransaction);
        }

        $this->collStockTransactions = $stockTransactions;
        $this->collStockTransactionsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related StockTransaction objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related StockTransaction objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countStockTransactions(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collStockTransactionsPartial && !$this->isNew();
        if (null === $this->collStockTransactions || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collStockTransactions) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getStockTransactions());
            }

            $query = ChildStockTransactionQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByStockVoucher($this)
                ->count($con);
        }

        return count($this->collStockTransactions);
    }

    /**
     * Method called to associate a ChildStockTransaction object to this object
     * through the ChildStockTransaction foreign key attribute.
     *
     * @param ChildStockTransaction $l ChildStockTransaction
     * @return $this The current object (for fluent API support)
     */
    public function addStockTransaction(ChildStockTransaction $l)
    {
        if ($this->collStockTransactions === null) {
            $this->initStockTransactions();
            $this->collStockTransactionsPartial = true;
        }

        if (!$this->collStockTransactions->contains($l)) {
            $this->doAddStockTransaction($l);

            if ($this->stockTransactionsScheduledForDeletion and $this->stockTransactionsScheduledForDeletion->contains($l)) {
                $this->stockTransactionsScheduledForDeletion->remove($this->stockTransactionsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildStockTransaction $stockTransaction The ChildStockTransaction object to add.
     */
    protected function doAddStockTransaction(ChildStockTransaction $stockTransaction): void
    {
        $this->collStockTransactions[]= $stockTransaction;
        $stockTransaction->setStockVoucher($this);
    }

    /**
     * @param ChildStockTransaction $stockTransaction The ChildStockTransaction object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeStockTransaction(ChildStockTransaction $stockTransaction)
    {
        if ($this->getStockTransactions()->contains($stockTransaction)) {
            $pos = $this->collStockTransactions->search($stockTransaction);
            $this->collStockTransactions->remove($pos);
            if (null === $this->stockTransactionsScheduledForDeletion) {
                $this->stockTransactionsScheduledForDeletion = clone $this->collStockTransactions;
                $this->stockTransactionsScheduledForDeletion->clear();
            }
            $this->stockTransactionsScheduledForDeletion[]= clone $stockTransaction;
            $stockTransaction->setStockVoucher(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this StockVoucher is new, it will return
     * an empty collection; or if this StockVoucher has previously
     * been saved, it will retrieve related StockTransactions from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in StockVoucher.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildStockTransaction[] List of ChildStockTransaction objects
     * @phpstan-return ObjectCollection&\Traversable<ChildStockTransaction}> List of ChildStockTransaction objects
     */
    public function getStockTransactionsJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildStockTransactionQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getStockTransactions($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this StockVoucher is new, it will return
     * an empty collection; or if this StockVoucher has previously
     * been saved, it will retrieve related StockTransactions from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in StockVoucher.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildStockTransaction[] List of ChildStockTransaction objects
     * @phpstan-return ObjectCollection&\Traversable<ChildStockTransaction}> List of ChildStockTransaction objects
     */
    public function getStockTransactionsJoinOutlets(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildStockTransactionQuery::create(null, $criteria);
        $query->joinWith('Outlets', $joinBehavior);

        return $this->getStockTransactions($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this StockVoucher is new, it will return
     * an empty collection; or if this StockVoucher has previously
     * been saved, it will retrieve related StockTransactions from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in StockVoucher.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildStockTransaction[] List of ChildStockTransaction objects
     * @phpstan-return ObjectCollection&\Traversable<ChildStockTransaction}> List of ChildStockTransaction objects
     */
    public function getStockTransactionsJoinProducts(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildStockTransactionQuery::create(null, $criteria);
        $query->joinWith('Products', $joinBehavior);

        return $this->getStockTransactions($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this StockVoucher is new, it will return
     * an empty collection; or if this StockVoucher has previously
     * been saved, it will retrieve related StockTransactions from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in StockVoucher.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildStockTransaction[] List of ChildStockTransaction objects
     * @phpstan-return ObjectCollection&\Traversable<ChildStockTransaction}> List of ChildStockTransaction objects
     */
    public function getStockTransactionsJoinUsers(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildStockTransactionQuery::create(null, $criteria);
        $query->joinWith('Users', $joinBehavior);

        return $this->getStockTransactions($query, $con);
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
            $this->aCompany->removeStockVoucher($this);
        }
        if (null !== $this->aUsers) {
            $this->aUsers->removeStockVoucher($this);
        }
        $this->svid = null;
        $this->sv_user_id = null;
        $this->sv_date = null;
        $this->company_id = null;
        $this->sv_remark = null;
        $this->sv_desc = null;
        $this->sv_type = null;
        $this->total_qty = null;
        $this->sv_error = null;
        $this->sv_status = null;
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
            if ($this->collShippingorders) {
                foreach ($this->collShippingorders as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collStockTransactions) {
                foreach ($this->collStockTransactions as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collShippingorders = null;
        $this->collStockTransactions = null;
        $this->aCompany = null;
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
        return (string) $this->exportTo(StockVoucherTableMap::DEFAULT_STRING_FORMAT);
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
