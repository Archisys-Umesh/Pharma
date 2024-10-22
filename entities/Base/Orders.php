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
use entities\Beats as ChildBeats;
use entities\BeatsQuery as ChildBeatsQuery;
use entities\Company as ChildCompany;
use entities\CompanyQuery as ChildCompanyQuery;
use entities\Employee as ChildEmployee;
use entities\EmployeeQuery as ChildEmployeeQuery;
use entities\OrderLog as ChildOrderLog;
use entities\OrderLogQuery as ChildOrderLogQuery;
use entities\Orderlines as ChildOrderlines;
use entities\OrderlinesQuery as ChildOrderlinesQuery;
use entities\Orders as ChildOrders;
use entities\OrdersQuery as ChildOrdersQuery;
use entities\Outlets as ChildOutlets;
use entities\OutletsQuery as ChildOutletsQuery;
use entities\Pricebooks as ChildPricebooks;
use entities\PricebooksQuery as ChildPricebooksQuery;
use entities\Shippingorder as ChildShippingorder;
use entities\ShippingorderQuery as ChildShippingorderQuery;
use entities\Territories as ChildTerritories;
use entities\TerritoriesQuery as ChildTerritoriesQuery;
use entities\Map\OrderLogTableMap;
use entities\Map\OrderlinesTableMap;
use entities\Map\OrdersTableMap;
use entities\Map\ShippingorderTableMap;

/**
 * Base class that represents a row from the 'orders' table.
 *
 *
 *
 * @package    propel.generator.entities.Base
 */
abstract class Orders implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\entities\\Map\\OrdersTableMap';


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
     * The value for the order_id field.
     *
     * @var        string
     */
    protected $order_id;

    /**
     * The value for the order_number field.
     *
     * @var        string|null
     */
    protected $order_number;

    /**
     * The value for the order_type field.
     *
     * @var        string|null
     */
    protected $order_type;

    /**
     * The value for the outlet_from field.
     *
     * @var        int|null
     */
    protected $outlet_from;

    /**
     * The value for the outlet_to field.
     *
     * @var        int|null
     */
    protected $outlet_to;

    /**
     * The value for the pricebook_id field.
     *
     * @var        int|null
     */
    protected $pricebook_id;

    /**
     * The value for the order_date field.
     *
     * @var        DateTime|null
     */
    protected $order_date;

    /**
     * The value for the order_subtotal field.
     *
     * @var        string|null
     */
    protected $order_subtotal;

    /**
     * The value for the order_discount field.
     *
     * @var        string|null
     */
    protected $order_discount;

    /**
     * The value for the order_total field.
     *
     * @var        string|null
     */
    protected $order_total;

    /**
     * The value for the order_qty field.
     *
     * @var        string|null
     */
    protected $order_qty;

    /**
     * The value for the employee_id field.
     *
     * @var        int|null
     */
    protected $employee_id;

    /**
     * The value for the booking_date field.
     *
     * @var        DateTime|null
     */
    protected $booking_date;

    /**
     * The value for the territory_id field.
     *
     * @var        int|null
     */
    protected $territory_id;

    /**
     * The value for the company_id field.
     *
     * @var        int|null
     */
    protected $company_id;

    /**
     * The value for the order_status field.
     *
     * @var        string|null
     */
    protected $order_status;

    /**
     * The value for the order_rerference field.
     *
     * @var        string|null
     */
    protected $order_rerference;

    /**
     * The value for the order_remark field.
     *
     * @var        string|null
     */
    protected $order_remark;

    /**
     * The value for the otp_req_id field.
     *
     * @var        int|null
     */
    protected $otp_req_id;

    /**
     * The value for the beat_id field.
     *
     * @var        int|null
     */
    protected $beat_id;

    /**
     * The value for the integration_id field.
     *
     * @var        string|null
     */
    protected $integration_id;

    /**
     * @var        ChildCompany
     */
    protected $aCompany;

    /**
     * @var        ChildEmployee
     */
    protected $aEmployee;

    /**
     * @var        ChildOutlets
     */
    protected $aOutletsRelatedByOutletFrom;

    /**
     * @var        ChildOutlets
     */
    protected $aOutletsRelatedByOutletTo;

    /**
     * @var        ChildTerritories
     */
    protected $aTerritories;

    /**
     * @var        ChildBeats
     */
    protected $aBeats;

    /**
     * @var        ChildPricebooks
     */
    protected $aPricebooks;

    /**
     * @var        ObjectCollection|ChildOrderLog[] Collection to store aggregation of ChildOrderLog objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildOrderLog> Collection to store aggregation of ChildOrderLog objects.
     */
    protected $collOrderLogs;
    protected $collOrderLogsPartial;

    /**
     * @var        ObjectCollection|ChildOrderlines[] Collection to store aggregation of ChildOrderlines objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildOrderlines> Collection to store aggregation of ChildOrderlines objects.
     */
    protected $collOrderliness;
    protected $collOrderlinessPartial;

    /**
     * @var        ObjectCollection|ChildShippingorder[] Collection to store aggregation of ChildShippingorder objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildShippingorder> Collection to store aggregation of ChildShippingorder objects.
     */
    protected $collShippingorders;
    protected $collShippingordersPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildOrderLog[]
     * @phpstan-var ObjectCollection&\Traversable<ChildOrderLog>
     */
    protected $orderLogsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildOrderlines[]
     * @phpstan-var ObjectCollection&\Traversable<ChildOrderlines>
     */
    protected $orderlinessScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildShippingorder[]
     * @phpstan-var ObjectCollection&\Traversable<ChildShippingorder>
     */
    protected $shippingordersScheduledForDeletion = null;

    /**
     * Initializes internal state of entities\Base\Orders object.
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
     * Compares this with another <code>Orders</code> instance.  If
     * <code>obj</code> is an instance of <code>Orders</code>, delegates to
     * <code>equals(Orders)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [order_id] column value.
     *
     * @return string
     */
    public function getOrderId()
    {
        return $this->order_id;
    }

    /**
     * Get the [order_number] column value.
     *
     * @return string|null
     */
    public function getOrderNumber()
    {
        return $this->order_number;
    }

    /**
     * Get the [order_type] column value.
     *
     * @return string|null
     */
    public function getOrderType()
    {
        return $this->order_type;
    }

    /**
     * Get the [outlet_from] column value.
     *
     * @return int|null
     */
    public function getOutletFrom()
    {
        return $this->outlet_from;
    }

    /**
     * Get the [outlet_to] column value.
     *
     * @return int|null
     */
    public function getOutletTo()
    {
        return $this->outlet_to;
    }

    /**
     * Get the [pricebook_id] column value.
     *
     * @return int|null
     */
    public function getPricebookId()
    {
        return $this->pricebook_id;
    }

    /**
     * Get the [optionally formatted] temporal [order_date] column value.
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
    public function getOrderDate($format = null)
    {
        if ($format === null) {
            return $this->order_date;
        } else {
            return $this->order_date instanceof \DateTimeInterface ? $this->order_date->format($format) : null;
        }
    }

    /**
     * Get the [order_subtotal] column value.
     *
     * @return string|null
     */
    public function getOrderSubtotal()
    {
        return $this->order_subtotal;
    }

    /**
     * Get the [order_discount] column value.
     *
     * @return string|null
     */
    public function getOrderDiscount()
    {
        return $this->order_discount;
    }

    /**
     * Get the [order_total] column value.
     *
     * @return string|null
     */
    public function getOrderTotal()
    {
        return $this->order_total;
    }

    /**
     * Get the [order_qty] column value.
     *
     * @return string|null
     */
    public function getOrderQty()
    {
        return $this->order_qty;
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
     * Get the [optionally formatted] temporal [booking_date] column value.
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
    public function getBookingDate($format = null)
    {
        if ($format === null) {
            return $this->booking_date;
        } else {
            return $this->booking_date instanceof \DateTimeInterface ? $this->booking_date->format($format) : null;
        }
    }

    /**
     * Get the [territory_id] column value.
     *
     * @return int|null
     */
    public function getTerritoryId()
    {
        return $this->territory_id;
    }

    /**
     * Get the [company_id] column value.
     *
     * @return int|null
     */
    public function getCompanyId()
    {
        return $this->company_id;
    }

    /**
     * Get the [order_status] column value.
     *
     * @return string|null
     */
    public function getOrderStatus()
    {
        return $this->order_status;
    }

    /**
     * Get the [order_rerference] column value.
     *
     * @return string|null
     */
    public function getOrderRerference()
    {
        return $this->order_rerference;
    }

    /**
     * Get the [order_remark] column value.
     *
     * @return string|null
     */
    public function getOrderRemark()
    {
        return $this->order_remark;
    }

    /**
     * Get the [otp_req_id] column value.
     *
     * @return int|null
     */
    public function getOtpReqId()
    {
        return $this->otp_req_id;
    }

    /**
     * Get the [beat_id] column value.
     *
     * @return int|null
     */
    public function getBeatId()
    {
        return $this->beat_id;
    }

    /**
     * Get the [integration_id] column value.
     *
     * @return string|null
     */
    public function getIntegrationId()
    {
        return $this->integration_id;
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
            $this->modifiedColumns[OrdersTableMap::COL_ORDER_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [order_number] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOrderNumber($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->order_number !== $v) {
            $this->order_number = $v;
            $this->modifiedColumns[OrdersTableMap::COL_ORDER_NUMBER] = true;
        }

        return $this;
    }

    /**
     * Set the value of [order_type] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOrderType($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->order_type !== $v) {
            $this->order_type = $v;
            $this->modifiedColumns[OrdersTableMap::COL_ORDER_TYPE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_from] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOutletFrom($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->outlet_from !== $v) {
            $this->outlet_from = $v;
            $this->modifiedColumns[OrdersTableMap::COL_OUTLET_FROM] = true;
        }

        if ($this->aOutletsRelatedByOutletFrom !== null && $this->aOutletsRelatedByOutletFrom->getId() !== $v) {
            $this->aOutletsRelatedByOutletFrom = null;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_to] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOutletTo($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->outlet_to !== $v) {
            $this->outlet_to = $v;
            $this->modifiedColumns[OrdersTableMap::COL_OUTLET_TO] = true;
        }

        if ($this->aOutletsRelatedByOutletTo !== null && $this->aOutletsRelatedByOutletTo->getId() !== $v) {
            $this->aOutletsRelatedByOutletTo = null;
        }

        return $this;
    }

    /**
     * Set the value of [pricebook_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPricebookId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->pricebook_id !== $v) {
            $this->pricebook_id = $v;
            $this->modifiedColumns[OrdersTableMap::COL_PRICEBOOK_ID] = true;
        }

        if ($this->aPricebooks !== null && $this->aPricebooks->getPricebookId() !== $v) {
            $this->aPricebooks = null;
        }

        return $this;
    }

    /**
     * Sets the value of [order_date] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setOrderDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->order_date !== null || $dt !== null) {
            if ($this->order_date === null || $dt === null || $dt->format("Y-m-d") !== $this->order_date->format("Y-m-d")) {
                $this->order_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[OrdersTableMap::COL_ORDER_DATE] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [order_subtotal] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOrderSubtotal($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->order_subtotal !== $v) {
            $this->order_subtotal = $v;
            $this->modifiedColumns[OrdersTableMap::COL_ORDER_SUBTOTAL] = true;
        }

        return $this;
    }

    /**
     * Set the value of [order_discount] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOrderDiscount($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->order_discount !== $v) {
            $this->order_discount = $v;
            $this->modifiedColumns[OrdersTableMap::COL_ORDER_DISCOUNT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [order_total] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOrderTotal($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->order_total !== $v) {
            $this->order_total = $v;
            $this->modifiedColumns[OrdersTableMap::COL_ORDER_TOTAL] = true;
        }

        return $this;
    }

    /**
     * Set the value of [order_qty] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOrderQty($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->order_qty !== $v) {
            $this->order_qty = $v;
            $this->modifiedColumns[OrdersTableMap::COL_ORDER_QTY] = true;
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
            $this->modifiedColumns[OrdersTableMap::COL_EMPLOYEE_ID] = true;
        }

        if ($this->aEmployee !== null && $this->aEmployee->getEmployeeId() !== $v) {
            $this->aEmployee = null;
        }

        return $this;
    }

    /**
     * Sets the value of [booking_date] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setBookingDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->booking_date !== null || $dt !== null) {
            if ($this->booking_date === null || $dt === null || $dt->format("Y-m-d") !== $this->booking_date->format("Y-m-d")) {
                $this->booking_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[OrdersTableMap::COL_BOOKING_DATE] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [territory_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setTerritoryId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->territory_id !== $v) {
            $this->territory_id = $v;
            $this->modifiedColumns[OrdersTableMap::COL_TERRITORY_ID] = true;
        }

        if ($this->aTerritories !== null && $this->aTerritories->getTerritoryId() !== $v) {
            $this->aTerritories = null;
        }

        return $this;
    }

    /**
     * Set the value of [company_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCompanyId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->company_id !== $v) {
            $this->company_id = $v;
            $this->modifiedColumns[OrdersTableMap::COL_COMPANY_ID] = true;
        }

        if ($this->aCompany !== null && $this->aCompany->getCompanyId() !== $v) {
            $this->aCompany = null;
        }

        return $this;
    }

    /**
     * Set the value of [order_status] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOrderStatus($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->order_status !== $v) {
            $this->order_status = $v;
            $this->modifiedColumns[OrdersTableMap::COL_ORDER_STATUS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [order_rerference] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOrderRerference($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->order_rerference !== $v) {
            $this->order_rerference = $v;
            $this->modifiedColumns[OrdersTableMap::COL_ORDER_RERFERENCE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [order_remark] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOrderRemark($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->order_remark !== $v) {
            $this->order_remark = $v;
            $this->modifiedColumns[OrdersTableMap::COL_ORDER_REMARK] = true;
        }

        return $this;
    }

    /**
     * Set the value of [otp_req_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOtpReqId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->otp_req_id !== $v) {
            $this->otp_req_id = $v;
            $this->modifiedColumns[OrdersTableMap::COL_OTP_REQ_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [beat_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setBeatId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->beat_id !== $v) {
            $this->beat_id = $v;
            $this->modifiedColumns[OrdersTableMap::COL_BEAT_ID] = true;
        }

        if ($this->aBeats !== null && $this->aBeats->getBeatId() !== $v) {
            $this->aBeats = null;
        }

        return $this;
    }

    /**
     * Set the value of [integration_id] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIntegrationId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->integration_id !== $v) {
            $this->integration_id = $v;
            $this->modifiedColumns[OrdersTableMap::COL_INTEGRATION_ID] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : OrdersTableMap::translateFieldName('OrderId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->order_id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : OrdersTableMap::translateFieldName('OrderNumber', TableMap::TYPE_PHPNAME, $indexType)];
            $this->order_number = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : OrdersTableMap::translateFieldName('OrderType', TableMap::TYPE_PHPNAME, $indexType)];
            $this->order_type = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : OrdersTableMap::translateFieldName('OutletFrom', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_from = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : OrdersTableMap::translateFieldName('OutletTo', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_to = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : OrdersTableMap::translateFieldName('PricebookId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->pricebook_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : OrdersTableMap::translateFieldName('OrderDate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->order_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : OrdersTableMap::translateFieldName('OrderSubtotal', TableMap::TYPE_PHPNAME, $indexType)];
            $this->order_subtotal = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : OrdersTableMap::translateFieldName('OrderDiscount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->order_discount = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : OrdersTableMap::translateFieldName('OrderTotal', TableMap::TYPE_PHPNAME, $indexType)];
            $this->order_total = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : OrdersTableMap::translateFieldName('OrderQty', TableMap::TYPE_PHPNAME, $indexType)];
            $this->order_qty = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : OrdersTableMap::translateFieldName('EmployeeId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->employee_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : OrdersTableMap::translateFieldName('BookingDate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->booking_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : OrdersTableMap::translateFieldName('TerritoryId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->territory_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : OrdersTableMap::translateFieldName('CompanyId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->company_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : OrdersTableMap::translateFieldName('OrderStatus', TableMap::TYPE_PHPNAME, $indexType)];
            $this->order_status = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : OrdersTableMap::translateFieldName('OrderRerference', TableMap::TYPE_PHPNAME, $indexType)];
            $this->order_rerference = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : OrdersTableMap::translateFieldName('OrderRemark', TableMap::TYPE_PHPNAME, $indexType)];
            $this->order_remark = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 18 + $startcol : OrdersTableMap::translateFieldName('OtpReqId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->otp_req_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 19 + $startcol : OrdersTableMap::translateFieldName('BeatId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->beat_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 20 + $startcol : OrdersTableMap::translateFieldName('IntegrationId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->integration_id = (null !== $col) ? (string) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 21; // 21 = OrdersTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\entities\\Orders'), 0, $e);
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
        if ($this->aOutletsRelatedByOutletFrom !== null && $this->outlet_from !== $this->aOutletsRelatedByOutletFrom->getId()) {
            $this->aOutletsRelatedByOutletFrom = null;
        }
        if ($this->aOutletsRelatedByOutletTo !== null && $this->outlet_to !== $this->aOutletsRelatedByOutletTo->getId()) {
            $this->aOutletsRelatedByOutletTo = null;
        }
        if ($this->aPricebooks !== null && $this->pricebook_id !== $this->aPricebooks->getPricebookId()) {
            $this->aPricebooks = null;
        }
        if ($this->aEmployee !== null && $this->employee_id !== $this->aEmployee->getEmployeeId()) {
            $this->aEmployee = null;
        }
        if ($this->aTerritories !== null && $this->territory_id !== $this->aTerritories->getTerritoryId()) {
            $this->aTerritories = null;
        }
        if ($this->aCompany !== null && $this->company_id !== $this->aCompany->getCompanyId()) {
            $this->aCompany = null;
        }
        if ($this->aBeats !== null && $this->beat_id !== $this->aBeats->getBeatId()) {
            $this->aBeats = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(OrdersTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildOrdersQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aCompany = null;
            $this->aEmployee = null;
            $this->aOutletsRelatedByOutletFrom = null;
            $this->aOutletsRelatedByOutletTo = null;
            $this->aTerritories = null;
            $this->aBeats = null;
            $this->aPricebooks = null;
            $this->collOrderLogs = null;

            $this->collOrderliness = null;

            $this->collShippingorders = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see Orders::setDeleted()
     * @see Orders::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(OrdersTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildOrdersQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(OrdersTableMap::DATABASE_NAME);
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
                OrdersTableMap::addInstanceToPool($this);
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

            if ($this->aEmployee !== null) {
                if ($this->aEmployee->isModified() || $this->aEmployee->isNew()) {
                    $affectedRows += $this->aEmployee->save($con);
                }
                $this->setEmployee($this->aEmployee);
            }

            if ($this->aOutletsRelatedByOutletFrom !== null) {
                if ($this->aOutletsRelatedByOutletFrom->isModified() || $this->aOutletsRelatedByOutletFrom->isNew()) {
                    $affectedRows += $this->aOutletsRelatedByOutletFrom->save($con);
                }
                $this->setOutletsRelatedByOutletFrom($this->aOutletsRelatedByOutletFrom);
            }

            if ($this->aOutletsRelatedByOutletTo !== null) {
                if ($this->aOutletsRelatedByOutletTo->isModified() || $this->aOutletsRelatedByOutletTo->isNew()) {
                    $affectedRows += $this->aOutletsRelatedByOutletTo->save($con);
                }
                $this->setOutletsRelatedByOutletTo($this->aOutletsRelatedByOutletTo);
            }

            if ($this->aTerritories !== null) {
                if ($this->aTerritories->isModified() || $this->aTerritories->isNew()) {
                    $affectedRows += $this->aTerritories->save($con);
                }
                $this->setTerritories($this->aTerritories);
            }

            if ($this->aBeats !== null) {
                if ($this->aBeats->isModified() || $this->aBeats->isNew()) {
                    $affectedRows += $this->aBeats->save($con);
                }
                $this->setBeats($this->aBeats);
            }

            if ($this->aPricebooks !== null) {
                if ($this->aPricebooks->isModified() || $this->aPricebooks->isNew()) {
                    $affectedRows += $this->aPricebooks->save($con);
                }
                $this->setPricebooks($this->aPricebooks);
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

            if ($this->orderLogsScheduledForDeletion !== null) {
                if (!$this->orderLogsScheduledForDeletion->isEmpty()) {
                    \entities\OrderLogQuery::create()
                        ->filterByPrimaryKeys($this->orderLogsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->orderLogsScheduledForDeletion = null;
                }
            }

            if ($this->collOrderLogs !== null) {
                foreach ($this->collOrderLogs as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->orderlinessScheduledForDeletion !== null) {
                if (!$this->orderlinessScheduledForDeletion->isEmpty()) {
                    \entities\OrderlinesQuery::create()
                        ->filterByPrimaryKeys($this->orderlinessScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->orderlinessScheduledForDeletion = null;
                }
            }

            if ($this->collOrderliness !== null) {
                foreach ($this->collOrderliness as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->shippingordersScheduledForDeletion !== null) {
                if (!$this->shippingordersScheduledForDeletion->isEmpty()) {
                    \entities\ShippingorderQuery::create()
                        ->filterByPrimaryKeys($this->shippingordersScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
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

        $this->modifiedColumns[OrdersTableMap::COL_ORDER_ID] = true;
        if (null !== $this->order_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . OrdersTableMap::COL_ORDER_ID . ')');
        }
        if (null === $this->order_id) {
            try {
                $dataFetcher = $con->query("SELECT nextval('orders_order_id_seq')");
                $this->order_id = (string) $dataFetcher->fetchColumn();
            } catch (Exception $e) {
                throw new PropelException('Unable to get sequence id.', 0, $e);
            }
        }


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(OrdersTableMap::COL_ORDER_ID)) {
            $modifiedColumns[':p' . $index++]  = 'order_id';
        }
        if ($this->isColumnModified(OrdersTableMap::COL_ORDER_NUMBER)) {
            $modifiedColumns[':p' . $index++]  = 'order_number';
        }
        if ($this->isColumnModified(OrdersTableMap::COL_ORDER_TYPE)) {
            $modifiedColumns[':p' . $index++]  = 'order_type';
        }
        if ($this->isColumnModified(OrdersTableMap::COL_OUTLET_FROM)) {
            $modifiedColumns[':p' . $index++]  = 'outlet_from';
        }
        if ($this->isColumnModified(OrdersTableMap::COL_OUTLET_TO)) {
            $modifiedColumns[':p' . $index++]  = 'outlet_to';
        }
        if ($this->isColumnModified(OrdersTableMap::COL_PRICEBOOK_ID)) {
            $modifiedColumns[':p' . $index++]  = 'pricebook_id';
        }
        if ($this->isColumnModified(OrdersTableMap::COL_ORDER_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'order_date';
        }
        if ($this->isColumnModified(OrdersTableMap::COL_ORDER_SUBTOTAL)) {
            $modifiedColumns[':p' . $index++]  = 'order_subtotal';
        }
        if ($this->isColumnModified(OrdersTableMap::COL_ORDER_DISCOUNT)) {
            $modifiedColumns[':p' . $index++]  = 'order_discount';
        }
        if ($this->isColumnModified(OrdersTableMap::COL_ORDER_TOTAL)) {
            $modifiedColumns[':p' . $index++]  = 'order_total';
        }
        if ($this->isColumnModified(OrdersTableMap::COL_ORDER_QTY)) {
            $modifiedColumns[':p' . $index++]  = 'order_qty';
        }
        if ($this->isColumnModified(OrdersTableMap::COL_EMPLOYEE_ID)) {
            $modifiedColumns[':p' . $index++]  = 'employee_id';
        }
        if ($this->isColumnModified(OrdersTableMap::COL_BOOKING_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'booking_date';
        }
        if ($this->isColumnModified(OrdersTableMap::COL_TERRITORY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'territory_id';
        }
        if ($this->isColumnModified(OrdersTableMap::COL_COMPANY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'company_id';
        }
        if ($this->isColumnModified(OrdersTableMap::COL_ORDER_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'order_status';
        }
        if ($this->isColumnModified(OrdersTableMap::COL_ORDER_RERFERENCE)) {
            $modifiedColumns[':p' . $index++]  = 'order_rerference';
        }
        if ($this->isColumnModified(OrdersTableMap::COL_ORDER_REMARK)) {
            $modifiedColumns[':p' . $index++]  = 'order_remark';
        }
        if ($this->isColumnModified(OrdersTableMap::COL_OTP_REQ_ID)) {
            $modifiedColumns[':p' . $index++]  = 'otp_req_id';
        }
        if ($this->isColumnModified(OrdersTableMap::COL_BEAT_ID)) {
            $modifiedColumns[':p' . $index++]  = 'beat_id';
        }
        if ($this->isColumnModified(OrdersTableMap::COL_INTEGRATION_ID)) {
            $modifiedColumns[':p' . $index++]  = 'integration_id';
        }

        $sql = sprintf(
            'INSERT INTO orders (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'order_id':
                        $stmt->bindValue($identifier, $this->order_id, PDO::PARAM_INT);

                        break;
                    case 'order_number':
                        $stmt->bindValue($identifier, $this->order_number, PDO::PARAM_STR);

                        break;
                    case 'order_type':
                        $stmt->bindValue($identifier, $this->order_type, PDO::PARAM_STR);

                        break;
                    case 'outlet_from':
                        $stmt->bindValue($identifier, $this->outlet_from, PDO::PARAM_INT);

                        break;
                    case 'outlet_to':
                        $stmt->bindValue($identifier, $this->outlet_to, PDO::PARAM_INT);

                        break;
                    case 'pricebook_id':
                        $stmt->bindValue($identifier, $this->pricebook_id, PDO::PARAM_INT);

                        break;
                    case 'order_date':
                        $stmt->bindValue($identifier, $this->order_date ? $this->order_date->format("Y-m-d") : null, PDO::PARAM_STR);

                        break;
                    case 'order_subtotal':
                        $stmt->bindValue($identifier, $this->order_subtotal, PDO::PARAM_STR);

                        break;
                    case 'order_discount':
                        $stmt->bindValue($identifier, $this->order_discount, PDO::PARAM_STR);

                        break;
                    case 'order_total':
                        $stmt->bindValue($identifier, $this->order_total, PDO::PARAM_STR);

                        break;
                    case 'order_qty':
                        $stmt->bindValue($identifier, $this->order_qty, PDO::PARAM_STR);

                        break;
                    case 'employee_id':
                        $stmt->bindValue($identifier, $this->employee_id, PDO::PARAM_INT);

                        break;
                    case 'booking_date':
                        $stmt->bindValue($identifier, $this->booking_date ? $this->booking_date->format("Y-m-d") : null, PDO::PARAM_STR);

                        break;
                    case 'territory_id':
                        $stmt->bindValue($identifier, $this->territory_id, PDO::PARAM_INT);

                        break;
                    case 'company_id':
                        $stmt->bindValue($identifier, $this->company_id, PDO::PARAM_INT);

                        break;
                    case 'order_status':
                        $stmt->bindValue($identifier, $this->order_status, PDO::PARAM_STR);

                        break;
                    case 'order_rerference':
                        $stmt->bindValue($identifier, $this->order_rerference, PDO::PARAM_STR);

                        break;
                    case 'order_remark':
                        $stmt->bindValue($identifier, $this->order_remark, PDO::PARAM_STR);

                        break;
                    case 'otp_req_id':
                        $stmt->bindValue($identifier, $this->otp_req_id, PDO::PARAM_INT);

                        break;
                    case 'beat_id':
                        $stmt->bindValue($identifier, $this->beat_id, PDO::PARAM_INT);

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
        $pos = OrdersTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getOrderId();

            case 1:
                return $this->getOrderNumber();

            case 2:
                return $this->getOrderType();

            case 3:
                return $this->getOutletFrom();

            case 4:
                return $this->getOutletTo();

            case 5:
                return $this->getPricebookId();

            case 6:
                return $this->getOrderDate();

            case 7:
                return $this->getOrderSubtotal();

            case 8:
                return $this->getOrderDiscount();

            case 9:
                return $this->getOrderTotal();

            case 10:
                return $this->getOrderQty();

            case 11:
                return $this->getEmployeeId();

            case 12:
                return $this->getBookingDate();

            case 13:
                return $this->getTerritoryId();

            case 14:
                return $this->getCompanyId();

            case 15:
                return $this->getOrderStatus();

            case 16:
                return $this->getOrderRerference();

            case 17:
                return $this->getOrderRemark();

            case 18:
                return $this->getOtpReqId();

            case 19:
                return $this->getBeatId();

            case 20:
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
        if (isset($alreadyDumpedObjects['Orders'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['Orders'][$this->hashCode()] = true;
        $keys = OrdersTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getOrderId(),
            $keys[1] => $this->getOrderNumber(),
            $keys[2] => $this->getOrderType(),
            $keys[3] => $this->getOutletFrom(),
            $keys[4] => $this->getOutletTo(),
            $keys[5] => $this->getPricebookId(),
            $keys[6] => $this->getOrderDate(),
            $keys[7] => $this->getOrderSubtotal(),
            $keys[8] => $this->getOrderDiscount(),
            $keys[9] => $this->getOrderTotal(),
            $keys[10] => $this->getOrderQty(),
            $keys[11] => $this->getEmployeeId(),
            $keys[12] => $this->getBookingDate(),
            $keys[13] => $this->getTerritoryId(),
            $keys[14] => $this->getCompanyId(),
            $keys[15] => $this->getOrderStatus(),
            $keys[16] => $this->getOrderRerference(),
            $keys[17] => $this->getOrderRemark(),
            $keys[18] => $this->getOtpReqId(),
            $keys[19] => $this->getBeatId(),
            $keys[20] => $this->getIntegrationId(),
        ];
        if ($result[$keys[6]] instanceof \DateTimeInterface) {
            $result[$keys[6]] = $result[$keys[6]]->format('Y-m-d');
        }

        if ($result[$keys[12]] instanceof \DateTimeInterface) {
            $result[$keys[12]] = $result[$keys[12]]->format('Y-m-d');
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
            if (null !== $this->aOutletsRelatedByOutletFrom) {

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

                $result[$key] = $this->aOutletsRelatedByOutletFrom->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aOutletsRelatedByOutletTo) {

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

                $result[$key] = $this->aOutletsRelatedByOutletTo->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aTerritories) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'territories';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'territories';
                        break;
                    default:
                        $key = 'Territories';
                }

                $result[$key] = $this->aTerritories->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aBeats) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'beats';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'beats';
                        break;
                    default:
                        $key = 'Beats';
                }

                $result[$key] = $this->aBeats->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aPricebooks) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'pricebooks';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'pricebooks';
                        break;
                    default:
                        $key = 'Pricebooks';
                }

                $result[$key] = $this->aPricebooks->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collOrderLogs) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'orderLogs';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'order_logs';
                        break;
                    default:
                        $key = 'OrderLogs';
                }

                $result[$key] = $this->collOrderLogs->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collOrderliness) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'orderliness';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'orderliness';
                        break;
                    default:
                        $key = 'Orderliness';
                }

                $result[$key] = $this->collOrderliness->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = OrdersTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setOrderId($value);
                break;
            case 1:
                $this->setOrderNumber($value);
                break;
            case 2:
                $this->setOrderType($value);
                break;
            case 3:
                $this->setOutletFrom($value);
                break;
            case 4:
                $this->setOutletTo($value);
                break;
            case 5:
                $this->setPricebookId($value);
                break;
            case 6:
                $this->setOrderDate($value);
                break;
            case 7:
                $this->setOrderSubtotal($value);
                break;
            case 8:
                $this->setOrderDiscount($value);
                break;
            case 9:
                $this->setOrderTotal($value);
                break;
            case 10:
                $this->setOrderQty($value);
                break;
            case 11:
                $this->setEmployeeId($value);
                break;
            case 12:
                $this->setBookingDate($value);
                break;
            case 13:
                $this->setTerritoryId($value);
                break;
            case 14:
                $this->setCompanyId($value);
                break;
            case 15:
                $this->setOrderStatus($value);
                break;
            case 16:
                $this->setOrderRerference($value);
                break;
            case 17:
                $this->setOrderRemark($value);
                break;
            case 18:
                $this->setOtpReqId($value);
                break;
            case 19:
                $this->setBeatId($value);
                break;
            case 20:
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
        $keys = OrdersTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setOrderId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setOrderNumber($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setOrderType($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setOutletFrom($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setOutletTo($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setPricebookId($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setOrderDate($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setOrderSubtotal($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setOrderDiscount($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setOrderTotal($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setOrderQty($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setEmployeeId($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setBookingDate($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setTerritoryId($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setCompanyId($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setOrderStatus($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setOrderRerference($arr[$keys[16]]);
        }
        if (array_key_exists($keys[17], $arr)) {
            $this->setOrderRemark($arr[$keys[17]]);
        }
        if (array_key_exists($keys[18], $arr)) {
            $this->setOtpReqId($arr[$keys[18]]);
        }
        if (array_key_exists($keys[19], $arr)) {
            $this->setBeatId($arr[$keys[19]]);
        }
        if (array_key_exists($keys[20], $arr)) {
            $this->setIntegrationId($arr[$keys[20]]);
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
        $criteria = new Criteria(OrdersTableMap::DATABASE_NAME);

        if ($this->isColumnModified(OrdersTableMap::COL_ORDER_ID)) {
            $criteria->add(OrdersTableMap::COL_ORDER_ID, $this->order_id);
        }
        if ($this->isColumnModified(OrdersTableMap::COL_ORDER_NUMBER)) {
            $criteria->add(OrdersTableMap::COL_ORDER_NUMBER, $this->order_number);
        }
        if ($this->isColumnModified(OrdersTableMap::COL_ORDER_TYPE)) {
            $criteria->add(OrdersTableMap::COL_ORDER_TYPE, $this->order_type);
        }
        if ($this->isColumnModified(OrdersTableMap::COL_OUTLET_FROM)) {
            $criteria->add(OrdersTableMap::COL_OUTLET_FROM, $this->outlet_from);
        }
        if ($this->isColumnModified(OrdersTableMap::COL_OUTLET_TO)) {
            $criteria->add(OrdersTableMap::COL_OUTLET_TO, $this->outlet_to);
        }
        if ($this->isColumnModified(OrdersTableMap::COL_PRICEBOOK_ID)) {
            $criteria->add(OrdersTableMap::COL_PRICEBOOK_ID, $this->pricebook_id);
        }
        if ($this->isColumnModified(OrdersTableMap::COL_ORDER_DATE)) {
            $criteria->add(OrdersTableMap::COL_ORDER_DATE, $this->order_date);
        }
        if ($this->isColumnModified(OrdersTableMap::COL_ORDER_SUBTOTAL)) {
            $criteria->add(OrdersTableMap::COL_ORDER_SUBTOTAL, $this->order_subtotal);
        }
        if ($this->isColumnModified(OrdersTableMap::COL_ORDER_DISCOUNT)) {
            $criteria->add(OrdersTableMap::COL_ORDER_DISCOUNT, $this->order_discount);
        }
        if ($this->isColumnModified(OrdersTableMap::COL_ORDER_TOTAL)) {
            $criteria->add(OrdersTableMap::COL_ORDER_TOTAL, $this->order_total);
        }
        if ($this->isColumnModified(OrdersTableMap::COL_ORDER_QTY)) {
            $criteria->add(OrdersTableMap::COL_ORDER_QTY, $this->order_qty);
        }
        if ($this->isColumnModified(OrdersTableMap::COL_EMPLOYEE_ID)) {
            $criteria->add(OrdersTableMap::COL_EMPLOYEE_ID, $this->employee_id);
        }
        if ($this->isColumnModified(OrdersTableMap::COL_BOOKING_DATE)) {
            $criteria->add(OrdersTableMap::COL_BOOKING_DATE, $this->booking_date);
        }
        if ($this->isColumnModified(OrdersTableMap::COL_TERRITORY_ID)) {
            $criteria->add(OrdersTableMap::COL_TERRITORY_ID, $this->territory_id);
        }
        if ($this->isColumnModified(OrdersTableMap::COL_COMPANY_ID)) {
            $criteria->add(OrdersTableMap::COL_COMPANY_ID, $this->company_id);
        }
        if ($this->isColumnModified(OrdersTableMap::COL_ORDER_STATUS)) {
            $criteria->add(OrdersTableMap::COL_ORDER_STATUS, $this->order_status);
        }
        if ($this->isColumnModified(OrdersTableMap::COL_ORDER_RERFERENCE)) {
            $criteria->add(OrdersTableMap::COL_ORDER_RERFERENCE, $this->order_rerference);
        }
        if ($this->isColumnModified(OrdersTableMap::COL_ORDER_REMARK)) {
            $criteria->add(OrdersTableMap::COL_ORDER_REMARK, $this->order_remark);
        }
        if ($this->isColumnModified(OrdersTableMap::COL_OTP_REQ_ID)) {
            $criteria->add(OrdersTableMap::COL_OTP_REQ_ID, $this->otp_req_id);
        }
        if ($this->isColumnModified(OrdersTableMap::COL_BEAT_ID)) {
            $criteria->add(OrdersTableMap::COL_BEAT_ID, $this->beat_id);
        }
        if ($this->isColumnModified(OrdersTableMap::COL_INTEGRATION_ID)) {
            $criteria->add(OrdersTableMap::COL_INTEGRATION_ID, $this->integration_id);
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
        $criteria = ChildOrdersQuery::create();
        $criteria->add(OrdersTableMap::COL_ORDER_ID, $this->order_id);

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
        $validPk = null !== $this->getOrderId();

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
        return $this->getOrderId();
    }

    /**
     * Generic method to set the primary key (order_id column).
     *
     * @param string|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?string $key = null): void
    {
        $this->setOrderId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getOrderId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \entities\Orders (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setOrderNumber($this->getOrderNumber());
        $copyObj->setOrderType($this->getOrderType());
        $copyObj->setOutletFrom($this->getOutletFrom());
        $copyObj->setOutletTo($this->getOutletTo());
        $copyObj->setPricebookId($this->getPricebookId());
        $copyObj->setOrderDate($this->getOrderDate());
        $copyObj->setOrderSubtotal($this->getOrderSubtotal());
        $copyObj->setOrderDiscount($this->getOrderDiscount());
        $copyObj->setOrderTotal($this->getOrderTotal());
        $copyObj->setOrderQty($this->getOrderQty());
        $copyObj->setEmployeeId($this->getEmployeeId());
        $copyObj->setBookingDate($this->getBookingDate());
        $copyObj->setTerritoryId($this->getTerritoryId());
        $copyObj->setCompanyId($this->getCompanyId());
        $copyObj->setOrderStatus($this->getOrderStatus());
        $copyObj->setOrderRerference($this->getOrderRerference());
        $copyObj->setOrderRemark($this->getOrderRemark());
        $copyObj->setOtpReqId($this->getOtpReqId());
        $copyObj->setBeatId($this->getBeatId());
        $copyObj->setIntegrationId($this->getIntegrationId());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getOrderLogs() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOrderLog($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getOrderliness() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOrderlines($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getShippingorders() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addShippingorder($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setOrderId(NULL); // this is a auto-increment column, so set to default value
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
     * @return \entities\Orders Clone of current object.
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
     * @param ChildCompany|null $v
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
            $v->addOrders($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildCompany object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildCompany|null The associated ChildCompany object.
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
                $this->aCompany->addOrderss($this);
             */
        }

        return $this->aCompany;
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
            $v->addOrders($this);
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
                $this->aEmployee->addOrderss($this);
             */
        }

        return $this->aEmployee;
    }

    /**
     * Declares an association between this object and a ChildOutlets object.
     *
     * @param ChildOutlets|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setOutletsRelatedByOutletFrom(ChildOutlets $v = null)
    {
        if ($v === null) {
            $this->setOutletFrom(NULL);
        } else {
            $this->setOutletFrom($v->getId());
        }

        $this->aOutletsRelatedByOutletFrom = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildOutlets object, it will not be re-added.
        if ($v !== null) {
            $v->addOrdersRelatedByOutletFrom($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildOutlets object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildOutlets|null The associated ChildOutlets object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOutletsRelatedByOutletFrom(?ConnectionInterface $con = null)
    {
        if ($this->aOutletsRelatedByOutletFrom === null && ($this->outlet_from != 0)) {
            $this->aOutletsRelatedByOutletFrom = ChildOutletsQuery::create()->findPk($this->outlet_from, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aOutletsRelatedByOutletFrom->addOrderssRelatedByOutletFrom($this);
             */
        }

        return $this->aOutletsRelatedByOutletFrom;
    }

    /**
     * Declares an association between this object and a ChildOutlets object.
     *
     * @param ChildOutlets|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setOutletsRelatedByOutletTo(ChildOutlets $v = null)
    {
        if ($v === null) {
            $this->setOutletTo(NULL);
        } else {
            $this->setOutletTo($v->getId());
        }

        $this->aOutletsRelatedByOutletTo = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildOutlets object, it will not be re-added.
        if ($v !== null) {
            $v->addOrdersRelatedByOutletTo($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildOutlets object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildOutlets|null The associated ChildOutlets object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOutletsRelatedByOutletTo(?ConnectionInterface $con = null)
    {
        if ($this->aOutletsRelatedByOutletTo === null && ($this->outlet_to != 0)) {
            $this->aOutletsRelatedByOutletTo = ChildOutletsQuery::create()->findPk($this->outlet_to, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aOutletsRelatedByOutletTo->addOrderssRelatedByOutletTo($this);
             */
        }

        return $this->aOutletsRelatedByOutletTo;
    }

    /**
     * Declares an association between this object and a ChildTerritories object.
     *
     * @param ChildTerritories|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setTerritories(ChildTerritories $v = null)
    {
        if ($v === null) {
            $this->setTerritoryId(NULL);
        } else {
            $this->setTerritoryId($v->getTerritoryId());
        }

        $this->aTerritories = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildTerritories object, it will not be re-added.
        if ($v !== null) {
            $v->addOrders($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildTerritories object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildTerritories|null The associated ChildTerritories object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getTerritories(?ConnectionInterface $con = null)
    {
        if ($this->aTerritories === null && ($this->territory_id != 0)) {
            $this->aTerritories = ChildTerritoriesQuery::create()->findPk($this->territory_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aTerritories->addOrderss($this);
             */
        }

        return $this->aTerritories;
    }

    /**
     * Declares an association between this object and a ChildBeats object.
     *
     * @param ChildBeats|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setBeats(ChildBeats $v = null)
    {
        if ($v === null) {
            $this->setBeatId(NULL);
        } else {
            $this->setBeatId($v->getBeatId());
        }

        $this->aBeats = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildBeats object, it will not be re-added.
        if ($v !== null) {
            $v->addOrders($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildBeats object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildBeats|null The associated ChildBeats object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getBeats(?ConnectionInterface $con = null)
    {
        if ($this->aBeats === null && ($this->beat_id != 0)) {
            $this->aBeats = ChildBeatsQuery::create()->findPk($this->beat_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aBeats->addOrderss($this);
             */
        }

        return $this->aBeats;
    }

    /**
     * Declares an association between this object and a ChildPricebooks object.
     *
     * @param ChildPricebooks|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setPricebooks(ChildPricebooks $v = null)
    {
        if ($v === null) {
            $this->setPricebookId(NULL);
        } else {
            $this->setPricebookId($v->getPricebookId());
        }

        $this->aPricebooks = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildPricebooks object, it will not be re-added.
        if ($v !== null) {
            $v->addOrders($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildPricebooks object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildPricebooks|null The associated ChildPricebooks object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getPricebooks(?ConnectionInterface $con = null)
    {
        if ($this->aPricebooks === null && ($this->pricebook_id != 0)) {
            $this->aPricebooks = ChildPricebooksQuery::create()->findPk($this->pricebook_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aPricebooks->addOrderss($this);
             */
        }

        return $this->aPricebooks;
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
        if ('OrderLog' === $relationName) {
            $this->initOrderLogs();
            return;
        }
        if ('Orderlines' === $relationName) {
            $this->initOrderliness();
            return;
        }
        if ('Shippingorder' === $relationName) {
            $this->initShippingorders();
            return;
        }
    }

    /**
     * Clears out the collOrderLogs collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addOrderLogs()
     */
    public function clearOrderLogs()
    {
        $this->collOrderLogs = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collOrderLogs collection loaded partially.
     *
     * @return void
     */
    public function resetPartialOrderLogs($v = true): void
    {
        $this->collOrderLogsPartial = $v;
    }

    /**
     * Initializes the collOrderLogs collection.
     *
     * By default this just sets the collOrderLogs collection to an empty array (like clearcollOrderLogs());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initOrderLogs(bool $overrideExisting = true): void
    {
        if (null !== $this->collOrderLogs && !$overrideExisting) {
            return;
        }

        $collectionClassName = OrderLogTableMap::getTableMap()->getCollectionClassName();

        $this->collOrderLogs = new $collectionClassName;
        $this->collOrderLogs->setModel('\entities\OrderLog');
    }

    /**
     * Gets an array of ChildOrderLog objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildOrders is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildOrderLog[] List of ChildOrderLog objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrderLog> List of ChildOrderLog objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOrderLogs(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collOrderLogsPartial && !$this->isNew();
        if (null === $this->collOrderLogs || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collOrderLogs) {
                    $this->initOrderLogs();
                } else {
                    $collectionClassName = OrderLogTableMap::getTableMap()->getCollectionClassName();

                    $collOrderLogs = new $collectionClassName;
                    $collOrderLogs->setModel('\entities\OrderLog');

                    return $collOrderLogs;
                }
            } else {
                $collOrderLogs = ChildOrderLogQuery::create(null, $criteria)
                    ->filterByOrders($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collOrderLogsPartial && count($collOrderLogs)) {
                        $this->initOrderLogs(false);

                        foreach ($collOrderLogs as $obj) {
                            if (false == $this->collOrderLogs->contains($obj)) {
                                $this->collOrderLogs->append($obj);
                            }
                        }

                        $this->collOrderLogsPartial = true;
                    }

                    return $collOrderLogs;
                }

                if ($partial && $this->collOrderLogs) {
                    foreach ($this->collOrderLogs as $obj) {
                        if ($obj->isNew()) {
                            $collOrderLogs[] = $obj;
                        }
                    }
                }

                $this->collOrderLogs = $collOrderLogs;
                $this->collOrderLogsPartial = false;
            }
        }

        return $this->collOrderLogs;
    }

    /**
     * Sets a collection of ChildOrderLog objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $orderLogs A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setOrderLogs(Collection $orderLogs, ?ConnectionInterface $con = null)
    {
        /** @var ChildOrderLog[] $orderLogsToDelete */
        $orderLogsToDelete = $this->getOrderLogs(new Criteria(), $con)->diff($orderLogs);


        $this->orderLogsScheduledForDeletion = $orderLogsToDelete;

        foreach ($orderLogsToDelete as $orderLogRemoved) {
            $orderLogRemoved->setOrders(null);
        }

        $this->collOrderLogs = null;
        foreach ($orderLogs as $orderLog) {
            $this->addOrderLog($orderLog);
        }

        $this->collOrderLogs = $orderLogs;
        $this->collOrderLogsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related OrderLog objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related OrderLog objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countOrderLogs(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collOrderLogsPartial && !$this->isNew();
        if (null === $this->collOrderLogs || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collOrderLogs) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getOrderLogs());
            }

            $query = ChildOrderLogQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOrders($this)
                ->count($con);
        }

        return count($this->collOrderLogs);
    }

    /**
     * Method called to associate a ChildOrderLog object to this object
     * through the ChildOrderLog foreign key attribute.
     *
     * @param ChildOrderLog $l ChildOrderLog
     * @return $this The current object (for fluent API support)
     */
    public function addOrderLog(ChildOrderLog $l)
    {
        if ($this->collOrderLogs === null) {
            $this->initOrderLogs();
            $this->collOrderLogsPartial = true;
        }

        if (!$this->collOrderLogs->contains($l)) {
            $this->doAddOrderLog($l);

            if ($this->orderLogsScheduledForDeletion and $this->orderLogsScheduledForDeletion->contains($l)) {
                $this->orderLogsScheduledForDeletion->remove($this->orderLogsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildOrderLog $orderLog The ChildOrderLog object to add.
     */
    protected function doAddOrderLog(ChildOrderLog $orderLog): void
    {
        $this->collOrderLogs[]= $orderLog;
        $orderLog->setOrders($this);
    }

    /**
     * @param ChildOrderLog $orderLog The ChildOrderLog object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeOrderLog(ChildOrderLog $orderLog)
    {
        if ($this->getOrderLogs()->contains($orderLog)) {
            $pos = $this->collOrderLogs->search($orderLog);
            $this->collOrderLogs->remove($pos);
            if (null === $this->orderLogsScheduledForDeletion) {
                $this->orderLogsScheduledForDeletion = clone $this->collOrderLogs;
                $this->orderLogsScheduledForDeletion->clear();
            }
            $this->orderLogsScheduledForDeletion[]= clone $orderLog;
            $orderLog->setOrders(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Orders is new, it will return
     * an empty collection; or if this Orders has previously
     * been saved, it will retrieve related OrderLogs from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Orders.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOrderLog[] List of ChildOrderLog objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrderLog}> List of ChildOrderLog objects
     */
    public function getOrderLogsJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOrderLogQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getOrderLogs($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Orders is new, it will return
     * an empty collection; or if this Orders has previously
     * been saved, it will retrieve related OrderLogs from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Orders.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOrderLog[] List of ChildOrderLog objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrderLog}> List of ChildOrderLog objects
     */
    public function getOrderLogsJoinUsers(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOrderLogQuery::create(null, $criteria);
        $query->joinWith('Users', $joinBehavior);

        return $this->getOrderLogs($query, $con);
    }

    /**
     * Clears out the collOrderliness collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addOrderliness()
     */
    public function clearOrderliness()
    {
        $this->collOrderliness = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collOrderliness collection loaded partially.
     *
     * @return void
     */
    public function resetPartialOrderliness($v = true): void
    {
        $this->collOrderlinessPartial = $v;
    }

    /**
     * Initializes the collOrderliness collection.
     *
     * By default this just sets the collOrderliness collection to an empty array (like clearcollOrderliness());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initOrderliness(bool $overrideExisting = true): void
    {
        if (null !== $this->collOrderliness && !$overrideExisting) {
            return;
        }

        $collectionClassName = OrderlinesTableMap::getTableMap()->getCollectionClassName();

        $this->collOrderliness = new $collectionClassName;
        $this->collOrderliness->setModel('\entities\Orderlines');
    }

    /**
     * Gets an array of ChildOrderlines objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildOrders is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildOrderlines[] List of ChildOrderlines objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrderlines> List of ChildOrderlines objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOrderliness(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collOrderlinessPartial && !$this->isNew();
        if (null === $this->collOrderliness || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collOrderliness) {
                    $this->initOrderliness();
                } else {
                    $collectionClassName = OrderlinesTableMap::getTableMap()->getCollectionClassName();

                    $collOrderliness = new $collectionClassName;
                    $collOrderliness->setModel('\entities\Orderlines');

                    return $collOrderliness;
                }
            } else {
                $collOrderliness = ChildOrderlinesQuery::create(null, $criteria)
                    ->filterByOrders($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collOrderlinessPartial && count($collOrderliness)) {
                        $this->initOrderliness(false);

                        foreach ($collOrderliness as $obj) {
                            if (false == $this->collOrderliness->contains($obj)) {
                                $this->collOrderliness->append($obj);
                            }
                        }

                        $this->collOrderlinessPartial = true;
                    }

                    return $collOrderliness;
                }

                if ($partial && $this->collOrderliness) {
                    foreach ($this->collOrderliness as $obj) {
                        if ($obj->isNew()) {
                            $collOrderliness[] = $obj;
                        }
                    }
                }

                $this->collOrderliness = $collOrderliness;
                $this->collOrderlinessPartial = false;
            }
        }

        return $this->collOrderliness;
    }

    /**
     * Sets a collection of ChildOrderlines objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $orderliness A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setOrderliness(Collection $orderliness, ?ConnectionInterface $con = null)
    {
        /** @var ChildOrderlines[] $orderlinessToDelete */
        $orderlinessToDelete = $this->getOrderliness(new Criteria(), $con)->diff($orderliness);


        $this->orderlinessScheduledForDeletion = $orderlinessToDelete;

        foreach ($orderlinessToDelete as $orderlinesRemoved) {
            $orderlinesRemoved->setOrders(null);
        }

        $this->collOrderliness = null;
        foreach ($orderliness as $orderlines) {
            $this->addOrderlines($orderlines);
        }

        $this->collOrderliness = $orderliness;
        $this->collOrderlinessPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Orderlines objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related Orderlines objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countOrderliness(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collOrderlinessPartial && !$this->isNew();
        if (null === $this->collOrderliness || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collOrderliness) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getOrderliness());
            }

            $query = ChildOrderlinesQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOrders($this)
                ->count($con);
        }

        return count($this->collOrderliness);
    }

    /**
     * Method called to associate a ChildOrderlines object to this object
     * through the ChildOrderlines foreign key attribute.
     *
     * @param ChildOrderlines $l ChildOrderlines
     * @return $this The current object (for fluent API support)
     */
    public function addOrderlines(ChildOrderlines $l)
    {
        if ($this->collOrderliness === null) {
            $this->initOrderliness();
            $this->collOrderlinessPartial = true;
        }

        if (!$this->collOrderliness->contains($l)) {
            $this->doAddOrderlines($l);

            if ($this->orderlinessScheduledForDeletion and $this->orderlinessScheduledForDeletion->contains($l)) {
                $this->orderlinessScheduledForDeletion->remove($this->orderlinessScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildOrderlines $orderlines The ChildOrderlines object to add.
     */
    protected function doAddOrderlines(ChildOrderlines $orderlines): void
    {
        $this->collOrderliness[]= $orderlines;
        $orderlines->setOrders($this);
    }

    /**
     * @param ChildOrderlines $orderlines The ChildOrderlines object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeOrderlines(ChildOrderlines $orderlines)
    {
        if ($this->getOrderliness()->contains($orderlines)) {
            $pos = $this->collOrderliness->search($orderlines);
            $this->collOrderliness->remove($pos);
            if (null === $this->orderlinessScheduledForDeletion) {
                $this->orderlinessScheduledForDeletion = clone $this->collOrderliness;
                $this->orderlinessScheduledForDeletion->clear();
            }
            $this->orderlinessScheduledForDeletion[]= clone $orderlines;
            $orderlines->setOrders(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Orders is new, it will return
     * an empty collection; or if this Orders has previously
     * been saved, it will retrieve related Orderliness from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Orders.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOrderlines[] List of ChildOrderlines objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrderlines}> List of ChildOrderlines objects
     */
    public function getOrderlinessJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOrderlinesQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getOrderliness($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Orders is new, it will return
     * an empty collection; or if this Orders has previously
     * been saved, it will retrieve related Orderliness from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Orders.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOrderlines[] List of ChildOrderlines objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrderlines}> List of ChildOrderlines objects
     */
    public function getOrderlinessJoinProducts(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOrderlinesQuery::create(null, $criteria);
        $query->joinWith('Products', $joinBehavior);

        return $this->getOrderliness($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Orders is new, it will return
     * an empty collection; or if this Orders has previously
     * been saved, it will retrieve related Orderliness from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Orders.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOrderlines[] List of ChildOrderlines objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrderlines}> List of ChildOrderlines objects
     */
    public function getOrderlinessJoinUnitmaster(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOrderlinesQuery::create(null, $criteria);
        $query->joinWith('Unitmaster', $joinBehavior);

        return $this->getOrderliness($query, $con);
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
     * If this ChildOrders is new, it will return
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
                    ->filterByOrders($this)
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
            $shippingorderRemoved->setOrders(null);
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
                ->filterByOrders($this)
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
        $shippingorder->setOrders($this);
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
            $this->shippingordersScheduledForDeletion[]= clone $shippingorder;
            $shippingorder->setOrders(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Orders is new, it will return
     * an empty collection; or if this Orders has previously
     * been saved, it will retrieve related Shippingorders from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Orders.
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
     * Otherwise if this Orders is new, it will return
     * an empty collection; or if this Orders has previously
     * been saved, it will retrieve related Shippingorders from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Orders.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildShippingorder[] List of ChildShippingorder objects
     * @phpstan-return ObjectCollection&\Traversable<ChildShippingorder}> List of ChildShippingorder objects
     */
    public function getShippingordersJoinStockVoucher(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildShippingorderQuery::create(null, $criteria);
        $query->joinWith('StockVoucher', $joinBehavior);

        return $this->getShippingorders($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Orders is new, it will return
     * an empty collection; or if this Orders has previously
     * been saved, it will retrieve related Shippingorders from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Orders.
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
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     *
     * @return $this
     */
    public function clear()
    {
        if (null !== $this->aCompany) {
            $this->aCompany->removeOrders($this);
        }
        if (null !== $this->aEmployee) {
            $this->aEmployee->removeOrders($this);
        }
        if (null !== $this->aOutletsRelatedByOutletFrom) {
            $this->aOutletsRelatedByOutletFrom->removeOrdersRelatedByOutletFrom($this);
        }
        if (null !== $this->aOutletsRelatedByOutletTo) {
            $this->aOutletsRelatedByOutletTo->removeOrdersRelatedByOutletTo($this);
        }
        if (null !== $this->aTerritories) {
            $this->aTerritories->removeOrders($this);
        }
        if (null !== $this->aBeats) {
            $this->aBeats->removeOrders($this);
        }
        if (null !== $this->aPricebooks) {
            $this->aPricebooks->removeOrders($this);
        }
        $this->order_id = null;
        $this->order_number = null;
        $this->order_type = null;
        $this->outlet_from = null;
        $this->outlet_to = null;
        $this->pricebook_id = null;
        $this->order_date = null;
        $this->order_subtotal = null;
        $this->order_discount = null;
        $this->order_total = null;
        $this->order_qty = null;
        $this->employee_id = null;
        $this->booking_date = null;
        $this->territory_id = null;
        $this->company_id = null;
        $this->order_status = null;
        $this->order_rerference = null;
        $this->order_remark = null;
        $this->otp_req_id = null;
        $this->beat_id = null;
        $this->integration_id = null;
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
            if ($this->collOrderLogs) {
                foreach ($this->collOrderLogs as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collOrderliness) {
                foreach ($this->collOrderliness as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collShippingorders) {
                foreach ($this->collShippingorders as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collOrderLogs = null;
        $this->collOrderliness = null;
        $this->collShippingorders = null;
        $this->aCompany = null;
        $this->aEmployee = null;
        $this->aOutletsRelatedByOutletFrom = null;
        $this->aOutletsRelatedByOutletTo = null;
        $this->aTerritories = null;
        $this->aBeats = null;
        $this->aPricebooks = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(OrdersTableMap::DEFAULT_STRING_FORMAT);
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
