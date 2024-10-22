<?php

namespace entities\Base;

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
use entities\Company as ChildCompany;
use entities\CompanyQuery as ChildCompanyQuery;
use entities\Orderlines as ChildOrderlines;
use entities\OrderlinesQuery as ChildOrderlinesQuery;
use entities\Orders as ChildOrders;
use entities\OrdersQuery as ChildOrdersQuery;
use entities\Products as ChildProducts;
use entities\ProductsQuery as ChildProductsQuery;
use entities\Shippinglines as ChildShippinglines;
use entities\ShippinglinesQuery as ChildShippinglinesQuery;
use entities\Unitmaster as ChildUnitmaster;
use entities\UnitmasterQuery as ChildUnitmasterQuery;
use entities\Map\OrderlinesTableMap;
use entities\Map\ShippinglinesTableMap;

/**
 * Base class that represents a row from the 'orderlines' table.
 *
 *
 *
 * @package    propel.generator.entities.Base
 */
abstract class Orderlines implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\entities\\Map\\OrderlinesTableMap';


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
     * The value for the orderline_id field.
     *
     * @var        string
     */
    protected $orderline_id;

    /**
     * The value for the order_id field.
     *
     * Note: this column has a database default value of: '0'
     * @var        string
     */
    protected $order_id;

    /**
     * The value for the product_id field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $product_id;

    /**
     * The value for the mrp field.
     *
     * Note: this column has a database default value of: '0.00'
     * @var        string
     */
    protected $mrp;

    /**
     * The value for the rate field.
     *
     * Note: this column has a database default value of: '0.00'
     * @var        string
     */
    protected $rate;

    /**
     * The value for the qty field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $qty;

    /**
     * The value for the ship_qty field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $ship_qty;

    /**
     * The value for the unit_id field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $unit_id;

    /**
     * The value for the total_amt field.
     *
     * Note: this column has a database default value of: '0.00'
     * @var        string
     */
    protected $total_amt;

    /**
     * The value for the company_id field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $company_id;

    /**
     * The value for the remark field.
     *
     * Note: this column has a database default value of: '0'
     * @var        string
     */
    protected $remark;

    /**
     * The value for the pricebook_line field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $pricebook_line;

    /**
     * The value for the integration_id field.
     *
     * Note: this column has a database default value of: '0'
     * @var        string
     */
    protected $integration_id;

    /**
     * @var        ChildCompany
     */
    protected $aCompany;

    /**
     * @var        ChildOrders
     */
    protected $aOrders;

    /**
     * @var        ChildProducts
     */
    protected $aProducts;

    /**
     * @var        ChildUnitmaster
     */
    protected $aUnitmaster;

    /**
     * @var        ObjectCollection|ChildShippinglines[] Collection to store aggregation of ChildShippinglines objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildShippinglines> Collection to store aggregation of ChildShippinglines objects.
     */
    protected $collShippingliness;
    protected $collShippinglinessPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildShippinglines[]
     * @phpstan-var ObjectCollection&\Traversable<ChildShippinglines>
     */
    protected $shippinglinessScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues(): void
    {
        $this->order_id = '0';
        $this->product_id = 0;
        $this->mrp = '0.00';
        $this->rate = '0.00';
        $this->qty = 0;
        $this->ship_qty = 0;
        $this->unit_id = 0;
        $this->total_amt = '0.00';
        $this->company_id = 0;
        $this->remark = '0';
        $this->pricebook_line = 0;
        $this->integration_id = '0';
    }

    /**
     * Initializes internal state of entities\Base\Orderlines object.
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
     * Compares this with another <code>Orderlines</code> instance.  If
     * <code>obj</code> is an instance of <code>Orderlines</code>, delegates to
     * <code>equals(Orderlines)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [orderline_id] column value.
     *
     * @return string
     */
    public function getOrderlineId()
    {
        return $this->orderline_id;
    }

    /**
     * Get the [order_id] column value.
     *
     * @return string
     */
    public function getOrderId()
    {
        return $this->order_id;
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
     * Get the [mrp] column value.
     *
     * @return string
     */
    public function getMrp()
    {
        return $this->mrp;
    }

    /**
     * Get the [rate] column value.
     *
     * @return string
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * Get the [qty] column value.
     *
     * @return int
     */
    public function getQty()
    {
        return $this->qty;
    }

    /**
     * Get the [ship_qty] column value.
     *
     * @return int
     */
    public function getShipQty()
    {
        return $this->ship_qty;
    }

    /**
     * Get the [unit_id] column value.
     *
     * @return int
     */
    public function getUnitId()
    {
        return $this->unit_id;
    }

    /**
     * Get the [total_amt] column value.
     *
     * @return string
     */
    public function getTotalAmt()
    {
        return $this->total_amt;
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
     * Get the [remark] column value.
     *
     * @return string
     */
    public function getRemark()
    {
        return $this->remark;
    }

    /**
     * Get the [pricebook_line] column value.
     *
     * @return int
     */
    public function getPricebookLine()
    {
        return $this->pricebook_line;
    }

    /**
     * Get the [integration_id] column value.
     *
     * @return string
     */
    public function getIntegrationId()
    {
        return $this->integration_id;
    }

    /**
     * Set the value of [orderline_id] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOrderlineId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->orderline_id !== $v) {
            $this->orderline_id = $v;
            $this->modifiedColumns[OrderlinesTableMap::COL_ORDERLINE_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [order_id] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOrderId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->order_id !== $v) {
            $this->order_id = $v;
            $this->modifiedColumns[OrderlinesTableMap::COL_ORDER_ID] = true;
        }

        if ($this->aOrders !== null && $this->aOrders->getOrderId() !== $v) {
            $this->aOrders = null;
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
            $this->modifiedColumns[OrderlinesTableMap::COL_PRODUCT_ID] = true;
        }

        if ($this->aProducts !== null && $this->aProducts->getId() !== $v) {
            $this->aProducts = null;
        }

        return $this;
    }

    /**
     * Set the value of [mrp] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setMrp($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->mrp !== $v) {
            $this->mrp = $v;
            $this->modifiedColumns[OrderlinesTableMap::COL_MRP] = true;
        }

        return $this;
    }

    /**
     * Set the value of [rate] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setRate($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->rate !== $v) {
            $this->rate = $v;
            $this->modifiedColumns[OrderlinesTableMap::COL_RATE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [qty] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setQty($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->qty !== $v) {
            $this->qty = $v;
            $this->modifiedColumns[OrderlinesTableMap::COL_QTY] = true;
        }

        return $this;
    }

    /**
     * Set the value of [ship_qty] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setShipQty($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->ship_qty !== $v) {
            $this->ship_qty = $v;
            $this->modifiedColumns[OrderlinesTableMap::COL_SHIP_QTY] = true;
        }

        return $this;
    }

    /**
     * Set the value of [unit_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setUnitId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->unit_id !== $v) {
            $this->unit_id = $v;
            $this->modifiedColumns[OrderlinesTableMap::COL_UNIT_ID] = true;
        }

        if ($this->aUnitmaster !== null && $this->aUnitmaster->getUnitId() !== $v) {
            $this->aUnitmaster = null;
        }

        return $this;
    }

    /**
     * Set the value of [total_amt] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setTotalAmt($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->total_amt !== $v) {
            $this->total_amt = $v;
            $this->modifiedColumns[OrderlinesTableMap::COL_TOTAL_AMT] = true;
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
            $this->modifiedColumns[OrderlinesTableMap::COL_COMPANY_ID] = true;
        }

        if ($this->aCompany !== null && $this->aCompany->getCompanyId() !== $v) {
            $this->aCompany = null;
        }

        return $this;
    }

    /**
     * Set the value of [remark] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setRemark($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->remark !== $v) {
            $this->remark = $v;
            $this->modifiedColumns[OrderlinesTableMap::COL_REMARK] = true;
        }

        return $this;
    }

    /**
     * Set the value of [pricebook_line] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPricebookLine($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->pricebook_line !== $v) {
            $this->pricebook_line = $v;
            $this->modifiedColumns[OrderlinesTableMap::COL_PRICEBOOK_LINE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [integration_id] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIntegrationId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->integration_id !== $v) {
            $this->integration_id = $v;
            $this->modifiedColumns[OrderlinesTableMap::COL_INTEGRATION_ID] = true;
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
            if ($this->order_id !== '0') {
                return false;
            }

            if ($this->product_id !== 0) {
                return false;
            }

            if ($this->mrp !== '0.00') {
                return false;
            }

            if ($this->rate !== '0.00') {
                return false;
            }

            if ($this->qty !== 0) {
                return false;
            }

            if ($this->ship_qty !== 0) {
                return false;
            }

            if ($this->unit_id !== 0) {
                return false;
            }

            if ($this->total_amt !== '0.00') {
                return false;
            }

            if ($this->company_id !== 0) {
                return false;
            }

            if ($this->remark !== '0') {
                return false;
            }

            if ($this->pricebook_line !== 0) {
                return false;
            }

            if ($this->integration_id !== '0') {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : OrderlinesTableMap::translateFieldName('OrderlineId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->orderline_id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : OrderlinesTableMap::translateFieldName('OrderId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->order_id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : OrderlinesTableMap::translateFieldName('ProductId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->product_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : OrderlinesTableMap::translateFieldName('Mrp', TableMap::TYPE_PHPNAME, $indexType)];
            $this->mrp = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : OrderlinesTableMap::translateFieldName('Rate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->rate = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : OrderlinesTableMap::translateFieldName('Qty', TableMap::TYPE_PHPNAME, $indexType)];
            $this->qty = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : OrderlinesTableMap::translateFieldName('ShipQty', TableMap::TYPE_PHPNAME, $indexType)];
            $this->ship_qty = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : OrderlinesTableMap::translateFieldName('UnitId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->unit_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : OrderlinesTableMap::translateFieldName('TotalAmt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->total_amt = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : OrderlinesTableMap::translateFieldName('CompanyId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->company_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : OrderlinesTableMap::translateFieldName('Remark', TableMap::TYPE_PHPNAME, $indexType)];
            $this->remark = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : OrderlinesTableMap::translateFieldName('PricebookLine', TableMap::TYPE_PHPNAME, $indexType)];
            $this->pricebook_line = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : OrderlinesTableMap::translateFieldName('IntegrationId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->integration_id = (null !== $col) ? (string) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 13; // 13 = OrderlinesTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\entities\\Orderlines'), 0, $e);
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
        if ($this->aOrders !== null && $this->order_id !== $this->aOrders->getOrderId()) {
            $this->aOrders = null;
        }
        if ($this->aProducts !== null && $this->product_id !== $this->aProducts->getId()) {
            $this->aProducts = null;
        }
        if ($this->aUnitmaster !== null && $this->unit_id !== $this->aUnitmaster->getUnitId()) {
            $this->aUnitmaster = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(OrderlinesTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildOrderlinesQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aCompany = null;
            $this->aOrders = null;
            $this->aProducts = null;
            $this->aUnitmaster = null;
            $this->collShippingliness = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see Orderlines::setDeleted()
     * @see Orderlines::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(OrderlinesTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildOrderlinesQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(OrderlinesTableMap::DATABASE_NAME);
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
                OrderlinesTableMap::addInstanceToPool($this);
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

            if ($this->aOrders !== null) {
                if ($this->aOrders->isModified() || $this->aOrders->isNew()) {
                    $affectedRows += $this->aOrders->save($con);
                }
                $this->setOrders($this->aOrders);
            }

            if ($this->aProducts !== null) {
                if ($this->aProducts->isModified() || $this->aProducts->isNew()) {
                    $affectedRows += $this->aProducts->save($con);
                }
                $this->setProducts($this->aProducts);
            }

            if ($this->aUnitmaster !== null) {
                if ($this->aUnitmaster->isModified() || $this->aUnitmaster->isNew()) {
                    $affectedRows += $this->aUnitmaster->save($con);
                }
                $this->setUnitmaster($this->aUnitmaster);
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

            if ($this->shippinglinessScheduledForDeletion !== null) {
                if (!$this->shippinglinessScheduledForDeletion->isEmpty()) {
                    \entities\ShippinglinesQuery::create()
                        ->filterByPrimaryKeys($this->shippinglinessScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->shippinglinessScheduledForDeletion = null;
                }
            }

            if ($this->collShippingliness !== null) {
                foreach ($this->collShippingliness as $referrerFK) {
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

        $this->modifiedColumns[OrderlinesTableMap::COL_ORDERLINE_ID] = true;
        if (null !== $this->orderline_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . OrderlinesTableMap::COL_ORDERLINE_ID . ')');
        }
        if (null === $this->orderline_id) {
            try {
                $dataFetcher = $con->query("SELECT nextval('orderlines_orderline_id_seq')");
                $this->orderline_id = (string) $dataFetcher->fetchColumn();
            } catch (Exception $e) {
                throw new PropelException('Unable to get sequence id.', 0, $e);
            }
        }


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(OrderlinesTableMap::COL_ORDERLINE_ID)) {
            $modifiedColumns[':p' . $index++]  = 'orderline_id';
        }
        if ($this->isColumnModified(OrderlinesTableMap::COL_ORDER_ID)) {
            $modifiedColumns[':p' . $index++]  = 'order_id';
        }
        if ($this->isColumnModified(OrderlinesTableMap::COL_PRODUCT_ID)) {
            $modifiedColumns[':p' . $index++]  = 'product_id';
        }
        if ($this->isColumnModified(OrderlinesTableMap::COL_MRP)) {
            $modifiedColumns[':p' . $index++]  = 'mrp';
        }
        if ($this->isColumnModified(OrderlinesTableMap::COL_RATE)) {
            $modifiedColumns[':p' . $index++]  = 'rate';
        }
        if ($this->isColumnModified(OrderlinesTableMap::COL_QTY)) {
            $modifiedColumns[':p' . $index++]  = 'qty';
        }
        if ($this->isColumnModified(OrderlinesTableMap::COL_SHIP_QTY)) {
            $modifiedColumns[':p' . $index++]  = 'ship_qty';
        }
        if ($this->isColumnModified(OrderlinesTableMap::COL_UNIT_ID)) {
            $modifiedColumns[':p' . $index++]  = 'unit_id';
        }
        if ($this->isColumnModified(OrderlinesTableMap::COL_TOTAL_AMT)) {
            $modifiedColumns[':p' . $index++]  = 'total_amt';
        }
        if ($this->isColumnModified(OrderlinesTableMap::COL_COMPANY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'company_id';
        }
        if ($this->isColumnModified(OrderlinesTableMap::COL_REMARK)) {
            $modifiedColumns[':p' . $index++]  = 'remark';
        }
        if ($this->isColumnModified(OrderlinesTableMap::COL_PRICEBOOK_LINE)) {
            $modifiedColumns[':p' . $index++]  = 'pricebook_line';
        }
        if ($this->isColumnModified(OrderlinesTableMap::COL_INTEGRATION_ID)) {
            $modifiedColumns[':p' . $index++]  = 'integration_id';
        }

        $sql = sprintf(
            'INSERT INTO orderlines (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'orderline_id':
                        $stmt->bindValue($identifier, $this->orderline_id, PDO::PARAM_INT);

                        break;
                    case 'order_id':
                        $stmt->bindValue($identifier, $this->order_id, PDO::PARAM_INT);

                        break;
                    case 'product_id':
                        $stmt->bindValue($identifier, $this->product_id, PDO::PARAM_INT);

                        break;
                    case 'mrp':
                        $stmt->bindValue($identifier, $this->mrp, PDO::PARAM_STR);

                        break;
                    case 'rate':
                        $stmt->bindValue($identifier, $this->rate, PDO::PARAM_STR);

                        break;
                    case 'qty':
                        $stmt->bindValue($identifier, $this->qty, PDO::PARAM_INT);

                        break;
                    case 'ship_qty':
                        $stmt->bindValue($identifier, $this->ship_qty, PDO::PARAM_INT);

                        break;
                    case 'unit_id':
                        $stmt->bindValue($identifier, $this->unit_id, PDO::PARAM_INT);

                        break;
                    case 'total_amt':
                        $stmt->bindValue($identifier, $this->total_amt, PDO::PARAM_STR);

                        break;
                    case 'company_id':
                        $stmt->bindValue($identifier, $this->company_id, PDO::PARAM_INT);

                        break;
                    case 'remark':
                        $stmt->bindValue($identifier, $this->remark, PDO::PARAM_STR);

                        break;
                    case 'pricebook_line':
                        $stmt->bindValue($identifier, $this->pricebook_line, PDO::PARAM_INT);

                        break;
                    case 'integration_id':
                        $stmt->bindValue($identifier, $this->integration_id, PDO::PARAM_STR);

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
        $pos = OrderlinesTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getOrderlineId();

            case 1:
                return $this->getOrderId();

            case 2:
                return $this->getProductId();

            case 3:
                return $this->getMrp();

            case 4:
                return $this->getRate();

            case 5:
                return $this->getQty();

            case 6:
                return $this->getShipQty();

            case 7:
                return $this->getUnitId();

            case 8:
                return $this->getTotalAmt();

            case 9:
                return $this->getCompanyId();

            case 10:
                return $this->getRemark();

            case 11:
                return $this->getPricebookLine();

            case 12:
                return $this->getIntegrationId();

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
        if (isset($alreadyDumpedObjects['Orderlines'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['Orderlines'][$this->hashCode()] = true;
        $keys = OrderlinesTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getOrderlineId(),
            $keys[1] => $this->getOrderId(),
            $keys[2] => $this->getProductId(),
            $keys[3] => $this->getMrp(),
            $keys[4] => $this->getRate(),
            $keys[5] => $this->getQty(),
            $keys[6] => $this->getShipQty(),
            $keys[7] => $this->getUnitId(),
            $keys[8] => $this->getTotalAmt(),
            $keys[9] => $this->getCompanyId(),
            $keys[10] => $this->getRemark(),
            $keys[11] => $this->getPricebookLine(),
            $keys[12] => $this->getIntegrationId(),
        ];
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
            if (null !== $this->aOrders) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'orders';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'orders';
                        break;
                    default:
                        $key = 'Orders';
                }

                $result[$key] = $this->aOrders->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
            if (null !== $this->aUnitmaster) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'unitmaster';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'unitmaster';
                        break;
                    default:
                        $key = 'Unitmaster';
                }

                $result[$key] = $this->aUnitmaster->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collShippingliness) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'shippingliness';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'shippingliness';
                        break;
                    default:
                        $key = 'Shippingliness';
                }

                $result[$key] = $this->collShippingliness->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = OrderlinesTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setOrderlineId($value);
                break;
            case 1:
                $this->setOrderId($value);
                break;
            case 2:
                $this->setProductId($value);
                break;
            case 3:
                $this->setMrp($value);
                break;
            case 4:
                $this->setRate($value);
                break;
            case 5:
                $this->setQty($value);
                break;
            case 6:
                $this->setShipQty($value);
                break;
            case 7:
                $this->setUnitId($value);
                break;
            case 8:
                $this->setTotalAmt($value);
                break;
            case 9:
                $this->setCompanyId($value);
                break;
            case 10:
                $this->setRemark($value);
                break;
            case 11:
                $this->setPricebookLine($value);
                break;
            case 12:
                $this->setIntegrationId($value);
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
        $keys = OrderlinesTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setOrderlineId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setOrderId($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setProductId($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setMrp($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setRate($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setQty($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setShipQty($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setUnitId($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setTotalAmt($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setCompanyId($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setRemark($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setPricebookLine($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setIntegrationId($arr[$keys[12]]);
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
        $criteria = new Criteria(OrderlinesTableMap::DATABASE_NAME);

        if ($this->isColumnModified(OrderlinesTableMap::COL_ORDERLINE_ID)) {
            $criteria->add(OrderlinesTableMap::COL_ORDERLINE_ID, $this->orderline_id);
        }
        if ($this->isColumnModified(OrderlinesTableMap::COL_ORDER_ID)) {
            $criteria->add(OrderlinesTableMap::COL_ORDER_ID, $this->order_id);
        }
        if ($this->isColumnModified(OrderlinesTableMap::COL_PRODUCT_ID)) {
            $criteria->add(OrderlinesTableMap::COL_PRODUCT_ID, $this->product_id);
        }
        if ($this->isColumnModified(OrderlinesTableMap::COL_MRP)) {
            $criteria->add(OrderlinesTableMap::COL_MRP, $this->mrp);
        }
        if ($this->isColumnModified(OrderlinesTableMap::COL_RATE)) {
            $criteria->add(OrderlinesTableMap::COL_RATE, $this->rate);
        }
        if ($this->isColumnModified(OrderlinesTableMap::COL_QTY)) {
            $criteria->add(OrderlinesTableMap::COL_QTY, $this->qty);
        }
        if ($this->isColumnModified(OrderlinesTableMap::COL_SHIP_QTY)) {
            $criteria->add(OrderlinesTableMap::COL_SHIP_QTY, $this->ship_qty);
        }
        if ($this->isColumnModified(OrderlinesTableMap::COL_UNIT_ID)) {
            $criteria->add(OrderlinesTableMap::COL_UNIT_ID, $this->unit_id);
        }
        if ($this->isColumnModified(OrderlinesTableMap::COL_TOTAL_AMT)) {
            $criteria->add(OrderlinesTableMap::COL_TOTAL_AMT, $this->total_amt);
        }
        if ($this->isColumnModified(OrderlinesTableMap::COL_COMPANY_ID)) {
            $criteria->add(OrderlinesTableMap::COL_COMPANY_ID, $this->company_id);
        }
        if ($this->isColumnModified(OrderlinesTableMap::COL_REMARK)) {
            $criteria->add(OrderlinesTableMap::COL_REMARK, $this->remark);
        }
        if ($this->isColumnModified(OrderlinesTableMap::COL_PRICEBOOK_LINE)) {
            $criteria->add(OrderlinesTableMap::COL_PRICEBOOK_LINE, $this->pricebook_line);
        }
        if ($this->isColumnModified(OrderlinesTableMap::COL_INTEGRATION_ID)) {
            $criteria->add(OrderlinesTableMap::COL_INTEGRATION_ID, $this->integration_id);
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
        $criteria = ChildOrderlinesQuery::create();
        $criteria->add(OrderlinesTableMap::COL_ORDERLINE_ID, $this->orderline_id);

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
        $validPk = null !== $this->getOrderlineId();

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
        return $this->getOrderlineId();
    }

    /**
     * Generic method to set the primary key (orderline_id column).
     *
     * @param string|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?string $key = null): void
    {
        $this->setOrderlineId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getOrderlineId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \entities\Orderlines (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setOrderId($this->getOrderId());
        $copyObj->setProductId($this->getProductId());
        $copyObj->setMrp($this->getMrp());
        $copyObj->setRate($this->getRate());
        $copyObj->setQty($this->getQty());
        $copyObj->setShipQty($this->getShipQty());
        $copyObj->setUnitId($this->getUnitId());
        $copyObj->setTotalAmt($this->getTotalAmt());
        $copyObj->setCompanyId($this->getCompanyId());
        $copyObj->setRemark($this->getRemark());
        $copyObj->setPricebookLine($this->getPricebookLine());
        $copyObj->setIntegrationId($this->getIntegrationId());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getShippingliness() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addShippinglines($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setOrderlineId(NULL); // this is a auto-increment column, so set to default value
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
     * @return \entities\Orderlines Clone of current object.
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
            $v->addOrderlines($this);
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
                $this->aCompany->addOrderliness($this);
             */
        }

        return $this->aCompany;
    }

    /**
     * Declares an association between this object and a ChildOrders object.
     *
     * @param ChildOrders $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setOrders(ChildOrders $v = null)
    {
        if ($v === null) {
            $this->setOrderId('0');
        } else {
            $this->setOrderId($v->getOrderId());
        }

        $this->aOrders = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildOrders object, it will not be re-added.
        if ($v !== null) {
            $v->addOrderlines($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildOrders object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildOrders The associated ChildOrders object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOrders(?ConnectionInterface $con = null)
    {
        if ($this->aOrders === null && (($this->order_id !== "" && $this->order_id !== null))) {
            $this->aOrders = ChildOrdersQuery::create()->findPk($this->order_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aOrders->addOrderliness($this);
             */
        }

        return $this->aOrders;
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
            $v->addOrderlines($this);
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
                $this->aProducts->addOrderliness($this);
             */
        }

        return $this->aProducts;
    }

    /**
     * Declares an association between this object and a ChildUnitmaster object.
     *
     * @param ChildUnitmaster $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setUnitmaster(ChildUnitmaster $v = null)
    {
        if ($v === null) {
            $this->setUnitId(0);
        } else {
            $this->setUnitId($v->getUnitId());
        }

        $this->aUnitmaster = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildUnitmaster object, it will not be re-added.
        if ($v !== null) {
            $v->addOrderlines($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildUnitmaster object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildUnitmaster The associated ChildUnitmaster object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getUnitmaster(?ConnectionInterface $con = null)
    {
        if ($this->aUnitmaster === null && ($this->unit_id != 0)) {
            $this->aUnitmaster = ChildUnitmasterQuery::create()->findPk($this->unit_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aUnitmaster->addOrderliness($this);
             */
        }

        return $this->aUnitmaster;
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
        if ('Shippinglines' === $relationName) {
            $this->initShippingliness();
            return;
        }
    }

    /**
     * Clears out the collShippingliness collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addShippingliness()
     */
    public function clearShippingliness()
    {
        $this->collShippingliness = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collShippingliness collection loaded partially.
     *
     * @return void
     */
    public function resetPartialShippingliness($v = true): void
    {
        $this->collShippinglinessPartial = $v;
    }

    /**
     * Initializes the collShippingliness collection.
     *
     * By default this just sets the collShippingliness collection to an empty array (like clearcollShippingliness());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initShippingliness(bool $overrideExisting = true): void
    {
        if (null !== $this->collShippingliness && !$overrideExisting) {
            return;
        }

        $collectionClassName = ShippinglinesTableMap::getTableMap()->getCollectionClassName();

        $this->collShippingliness = new $collectionClassName;
        $this->collShippingliness->setModel('\entities\Shippinglines');
    }

    /**
     * Gets an array of ChildShippinglines objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildOrderlines is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildShippinglines[] List of ChildShippinglines objects
     * @phpstan-return ObjectCollection&\Traversable<ChildShippinglines> List of ChildShippinglines objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getShippingliness(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collShippinglinessPartial && !$this->isNew();
        if (null === $this->collShippingliness || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collShippingliness) {
                    $this->initShippingliness();
                } else {
                    $collectionClassName = ShippinglinesTableMap::getTableMap()->getCollectionClassName();

                    $collShippingliness = new $collectionClassName;
                    $collShippingliness->setModel('\entities\Shippinglines');

                    return $collShippingliness;
                }
            } else {
                $collShippingliness = ChildShippinglinesQuery::create(null, $criteria)
                    ->filterByOrderlines($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collShippinglinessPartial && count($collShippingliness)) {
                        $this->initShippingliness(false);

                        foreach ($collShippingliness as $obj) {
                            if (false == $this->collShippingliness->contains($obj)) {
                                $this->collShippingliness->append($obj);
                            }
                        }

                        $this->collShippinglinessPartial = true;
                    }

                    return $collShippingliness;
                }

                if ($partial && $this->collShippingliness) {
                    foreach ($this->collShippingliness as $obj) {
                        if ($obj->isNew()) {
                            $collShippingliness[] = $obj;
                        }
                    }
                }

                $this->collShippingliness = $collShippingliness;
                $this->collShippinglinessPartial = false;
            }
        }

        return $this->collShippingliness;
    }

    /**
     * Sets a collection of ChildShippinglines objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $shippingliness A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setShippingliness(Collection $shippingliness, ?ConnectionInterface $con = null)
    {
        /** @var ChildShippinglines[] $shippinglinessToDelete */
        $shippinglinessToDelete = $this->getShippingliness(new Criteria(), $con)->diff($shippingliness);


        $this->shippinglinessScheduledForDeletion = $shippinglinessToDelete;

        foreach ($shippinglinessToDelete as $shippinglinesRemoved) {
            $shippinglinesRemoved->setOrderlines(null);
        }

        $this->collShippingliness = null;
        foreach ($shippingliness as $shippinglines) {
            $this->addShippinglines($shippinglines);
        }

        $this->collShippingliness = $shippingliness;
        $this->collShippinglinessPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Shippinglines objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related Shippinglines objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countShippingliness(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collShippinglinessPartial && !$this->isNew();
        if (null === $this->collShippingliness || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collShippingliness) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getShippingliness());
            }

            $query = ChildShippinglinesQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOrderlines($this)
                ->count($con);
        }

        return count($this->collShippingliness);
    }

    /**
     * Method called to associate a ChildShippinglines object to this object
     * through the ChildShippinglines foreign key attribute.
     *
     * @param ChildShippinglines $l ChildShippinglines
     * @return $this The current object (for fluent API support)
     */
    public function addShippinglines(ChildShippinglines $l)
    {
        if ($this->collShippingliness === null) {
            $this->initShippingliness();
            $this->collShippinglinessPartial = true;
        }

        if (!$this->collShippingliness->contains($l)) {
            $this->doAddShippinglines($l);

            if ($this->shippinglinessScheduledForDeletion and $this->shippinglinessScheduledForDeletion->contains($l)) {
                $this->shippinglinessScheduledForDeletion->remove($this->shippinglinessScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildShippinglines $shippinglines The ChildShippinglines object to add.
     */
    protected function doAddShippinglines(ChildShippinglines $shippinglines): void
    {
        $this->collShippingliness[]= $shippinglines;
        $shippinglines->setOrderlines($this);
    }

    /**
     * @param ChildShippinglines $shippinglines The ChildShippinglines object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeShippinglines(ChildShippinglines $shippinglines)
    {
        if ($this->getShippingliness()->contains($shippinglines)) {
            $pos = $this->collShippingliness->search($shippinglines);
            $this->collShippingliness->remove($pos);
            if (null === $this->shippinglinessScheduledForDeletion) {
                $this->shippinglinessScheduledForDeletion = clone $this->collShippingliness;
                $this->shippinglinessScheduledForDeletion->clear();
            }
            $this->shippinglinessScheduledForDeletion[]= clone $shippinglines;
            $shippinglines->setOrderlines(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Orderlines is new, it will return
     * an empty collection; or if this Orderlines has previously
     * been saved, it will retrieve related Shippingliness from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Orderlines.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildShippinglines[] List of ChildShippinglines objects
     * @phpstan-return ObjectCollection&\Traversable<ChildShippinglines}> List of ChildShippinglines objects
     */
    public function getShippinglinessJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildShippinglinesQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getShippingliness($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Orderlines is new, it will return
     * an empty collection; or if this Orderlines has previously
     * been saved, it will retrieve related Shippingliness from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Orderlines.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildShippinglines[] List of ChildShippinglines objects
     * @phpstan-return ObjectCollection&\Traversable<ChildShippinglines}> List of ChildShippinglines objects
     */
    public function getShippinglinessJoinProducts(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildShippinglinesQuery::create(null, $criteria);
        $query->joinWith('Products', $joinBehavior);

        return $this->getShippingliness($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Orderlines is new, it will return
     * an empty collection; or if this Orderlines has previously
     * been saved, it will retrieve related Shippingliness from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Orderlines.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildShippinglines[] List of ChildShippinglines objects
     * @phpstan-return ObjectCollection&\Traversable<ChildShippinglines}> List of ChildShippinglines objects
     */
    public function getShippinglinessJoinShippingorder(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildShippinglinesQuery::create(null, $criteria);
        $query->joinWith('Shippingorder', $joinBehavior);

        return $this->getShippingliness($query, $con);
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
            $this->aCompany->removeOrderlines($this);
        }
        if (null !== $this->aOrders) {
            $this->aOrders->removeOrderlines($this);
        }
        if (null !== $this->aProducts) {
            $this->aProducts->removeOrderlines($this);
        }
        if (null !== $this->aUnitmaster) {
            $this->aUnitmaster->removeOrderlines($this);
        }
        $this->orderline_id = null;
        $this->order_id = null;
        $this->product_id = null;
        $this->mrp = null;
        $this->rate = null;
        $this->qty = null;
        $this->ship_qty = null;
        $this->unit_id = null;
        $this->total_amt = null;
        $this->company_id = null;
        $this->remark = null;
        $this->pricebook_line = null;
        $this->integration_id = null;
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
            if ($this->collShippingliness) {
                foreach ($this->collShippingliness as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collShippingliness = null;
        $this->aCompany = null;
        $this->aOrders = null;
        $this->aProducts = null;
        $this->aUnitmaster = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(OrderlinesTableMap::DEFAULT_STRING_FORMAT);
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
