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
use entities\Orders as ChildOrders;
use entities\OrdersQuery as ChildOrdersQuery;
use entities\Shippinglines as ChildShippinglines;
use entities\ShippinglinesQuery as ChildShippinglinesQuery;
use entities\Shippingorder as ChildShippingorder;
use entities\ShippingorderQuery as ChildShippingorderQuery;
use entities\StockVoucher as ChildStockVoucher;
use entities\StockVoucherQuery as ChildStockVoucherQuery;
use entities\Users as ChildUsers;
use entities\UsersQuery as ChildUsersQuery;
use entities\Map\ShippinglinesTableMap;
use entities\Map\ShippingorderTableMap;

/**
 * Base class that represents a row from the 'shippingorder' table.
 *
 *
 *
 * @package    propel.generator.entities.Base
 */
abstract class Shippingorder implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\entities\\Map\\ShippingorderTableMap';


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
     * The value for the soid field.
     *
     * @var        string
     */
    protected $soid;

    /**
     * The value for the order_id field.
     *
     * @var        string
     */
    protected $order_id;

    /**
     * The value for the so_number field.
     *
     * Note: this column has a database default value of: ''
     * @var        string
     */
    protected $so_number;

    /**
     * The value for the shipping_order_date field.
     *
     * @var        DateTime
     */
    protected $shipping_order_date;

    /**
     * The value for the so_status field.
     *
     * @var        string
     */
    protected $so_status;

    /**
     * The value for the user_id field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $user_id;

    /**
     * The value for the company_id field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $company_id;

    /**
     * The value for the invoice_number field.
     *
     * Note: this column has a database default value of: '0'
     * @var        string
     */
    protected $invoice_number;

    /**
     * The value for the shipping_mode field.
     *
     * Note: this column has a database default value of: '0'
     * @var        string
     */
    protected $shipping_mode;

    /**
     * The value for the shipping_partner field.
     *
     * Note: this column has a database default value of: '0'
     * @var        string
     */
    protected $shipping_partner;

    /**
     * The value for the tracking_number field.
     *
     * Note: this column has a database default value of: '0'
     * @var        string
     */
    protected $tracking_number;

    /**
     * The value for the invoice_amount field.
     *
     * Note: this column has a database default value of: '0.00'
     * @var        string
     */
    protected $invoice_amount;

    /**
     * The value for the invoice_file field.
     *
     * Note: this column has a database default value of: '0'
     * @var        string
     */
    protected $invoice_file;

    /**
     * The value for the created_date field.
     *
     * Note: this column has a database default value of: (expression) CURRENT_TIMESTAMP
     * @var        DateTime
     */
    protected $created_date;

    /**
     * The value for the billedby_outlet field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $billedby_outlet;

    /**
     * The value for the billedto_outlet field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $billedto_outlet;

    /**
     * The value for the sv_id field.
     *
     * Note: this column has a database default value of: '0'
     * @var        string|null
     */
    protected $sv_id;

    /**
     * The value for the payment_mode field.
     *
     * @var        string|null
     */
    protected $payment_mode;

    /**
     * The value for the payment_remark field.
     *
     * @var        string|null
     */
    protected $payment_remark;

    /**
     * The value for the payment_status field.
     *
     * Note: this column has a database default value of: 'DUE'
     * @var        string|null
     */
    protected $payment_status;

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
     * @var        ChildOrders
     */
    protected $aOrders;

    /**
     * @var        ChildStockVoucher
     */
    protected $aStockVoucher;

    /**
     * @var        ChildUsers
     */
    protected $aUsers;

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
        $this->so_number = '';
        $this->user_id = 0;
        $this->company_id = 0;
        $this->invoice_number = '0';
        $this->shipping_mode = '0';
        $this->shipping_partner = '0';
        $this->tracking_number = '0';
        $this->invoice_amount = '0.00';
        $this->invoice_file = '0';
        $this->billedby_outlet = 0;
        $this->billedto_outlet = 0;
        $this->sv_id = '0';
        $this->payment_status = 'DUE';
    }

    /**
     * Initializes internal state of entities\Base\Shippingorder object.
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
     * Compares this with another <code>Shippingorder</code> instance.  If
     * <code>obj</code> is an instance of <code>Shippingorder</code>, delegates to
     * <code>equals(Shippingorder)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [soid] column value.
     *
     * @return string
     */
    public function getSoid()
    {
        return $this->soid;
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
     * Get the [so_number] column value.
     *
     * @return string
     */
    public function getSoNumber()
    {
        return $this->so_number;
    }

    /**
     * Get the [optionally formatted] temporal [shipping_order_date] column value.
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
    public function getShippingOrderDate($format = null)
    {
        if ($format === null) {
            return $this->shipping_order_date;
        } else {
            return $this->shipping_order_date instanceof \DateTimeInterface ? $this->shipping_order_date->format($format) : null;
        }
    }

    /**
     * Get the [so_status] column value.
     *
     * @return string
     */
    public function getSoStatus()
    {
        return $this->so_status;
    }

    /**
     * Get the [user_id] column value.
     *
     * @return int
     */
    public function getUserId()
    {
        return $this->user_id;
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
     * Get the [invoice_number] column value.
     *
     * @return string
     */
    public function getInvoiceNumber()
    {
        return $this->invoice_number;
    }

    /**
     * Get the [shipping_mode] column value.
     *
     * @return string
     */
    public function getShippingMode()
    {
        return $this->shipping_mode;
    }

    /**
     * Get the [shipping_partner] column value.
     *
     * @return string
     */
    public function getShippingPartner()
    {
        return $this->shipping_partner;
    }

    /**
     * Get the [tracking_number] column value.
     *
     * @return string
     */
    public function getTrackingNumber()
    {
        return $this->tracking_number;
    }

    /**
     * Get the [invoice_amount] column value.
     *
     * @return string
     */
    public function getInvoiceAmount()
    {
        return $this->invoice_amount;
    }

    /**
     * Get the [invoice_file] column value.
     *
     * @return string
     */
    public function getInvoiceFile()
    {
        return $this->invoice_file;
    }

    /**
     * Get the [optionally formatted] temporal [created_date] column value.
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
    public function getCreatedDate($format = null)
    {
        if ($format === null) {
            return $this->created_date;
        } else {
            return $this->created_date instanceof \DateTimeInterface ? $this->created_date->format($format) : null;
        }
    }

    /**
     * Get the [billedby_outlet] column value.
     *
     * @return int
     */
    public function getBilledbyOutlet()
    {
        return $this->billedby_outlet;
    }

    /**
     * Get the [billedto_outlet] column value.
     *
     * @return int
     */
    public function getBilledtoOutlet()
    {
        return $this->billedto_outlet;
    }

    /**
     * Get the [sv_id] column value.
     *
     * @return string|null
     */
    public function getSvId()
    {
        return $this->sv_id;
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
     * Get the [payment_remark] column value.
     *
     * @return string|null
     */
    public function getPaymentRemark()
    {
        return $this->payment_remark;
    }

    /**
     * Get the [payment_status] column value.
     *
     * @return string|null
     */
    public function getPaymentStatus()
    {
        return $this->payment_status;
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
     * Set the value of [soid] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setSoid($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->soid !== $v) {
            $this->soid = $v;
            $this->modifiedColumns[ShippingorderTableMap::COL_SOID] = true;
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
            $this->modifiedColumns[ShippingorderTableMap::COL_ORDER_ID] = true;
        }

        if ($this->aOrders !== null && $this->aOrders->getOrderId() !== $v) {
            $this->aOrders = null;
        }

        return $this;
    }

    /**
     * Set the value of [so_number] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setSoNumber($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->so_number !== $v) {
            $this->so_number = $v;
            $this->modifiedColumns[ShippingorderTableMap::COL_SO_NUMBER] = true;
        }

        return $this;
    }

    /**
     * Sets the value of [shipping_order_date] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setShippingOrderDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->shipping_order_date !== null || $dt !== null) {
            if ($this->shipping_order_date === null || $dt === null || $dt->format("Y-m-d") !== $this->shipping_order_date->format("Y-m-d")) {
                $this->shipping_order_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[ShippingorderTableMap::COL_SHIPPING_ORDER_DATE] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [so_status] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setSoStatus($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->so_status !== $v) {
            $this->so_status = $v;
            $this->modifiedColumns[ShippingorderTableMap::COL_SO_STATUS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [user_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setUserId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->user_id !== $v) {
            $this->user_id = $v;
            $this->modifiedColumns[ShippingorderTableMap::COL_USER_ID] = true;
        }

        if ($this->aUsers !== null && $this->aUsers->getUserId() !== $v) {
            $this->aUsers = null;
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
            $this->modifiedColumns[ShippingorderTableMap::COL_COMPANY_ID] = true;
        }

        if ($this->aCompany !== null && $this->aCompany->getCompanyId() !== $v) {
            $this->aCompany = null;
        }

        return $this;
    }

    /**
     * Set the value of [invoice_number] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setInvoiceNumber($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->invoice_number !== $v) {
            $this->invoice_number = $v;
            $this->modifiedColumns[ShippingorderTableMap::COL_INVOICE_NUMBER] = true;
        }

        return $this;
    }

    /**
     * Set the value of [shipping_mode] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setShippingMode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->shipping_mode !== $v) {
            $this->shipping_mode = $v;
            $this->modifiedColumns[ShippingorderTableMap::COL_SHIPPING_MODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [shipping_partner] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setShippingPartner($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->shipping_partner !== $v) {
            $this->shipping_partner = $v;
            $this->modifiedColumns[ShippingorderTableMap::COL_SHIPPING_PARTNER] = true;
        }

        return $this;
    }

    /**
     * Set the value of [tracking_number] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setTrackingNumber($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->tracking_number !== $v) {
            $this->tracking_number = $v;
            $this->modifiedColumns[ShippingorderTableMap::COL_TRACKING_NUMBER] = true;
        }

        return $this;
    }

    /**
     * Set the value of [invoice_amount] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setInvoiceAmount($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->invoice_amount !== $v) {
            $this->invoice_amount = $v;
            $this->modifiedColumns[ShippingorderTableMap::COL_INVOICE_AMOUNT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [invoice_file] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setInvoiceFile($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->invoice_file !== $v) {
            $this->invoice_file = $v;
            $this->modifiedColumns[ShippingorderTableMap::COL_INVOICE_FILE] = true;
        }

        return $this;
    }

    /**
     * Sets the value of [created_date] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setCreatedDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_date !== null || $dt !== null) {
            if ($this->created_date === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->created_date->format("Y-m-d H:i:s.u")) {
                $this->created_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[ShippingorderTableMap::COL_CREATED_DATE] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [billedby_outlet] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setBilledbyOutlet($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->billedby_outlet !== $v) {
            $this->billedby_outlet = $v;
            $this->modifiedColumns[ShippingorderTableMap::COL_BILLEDBY_OUTLET] = true;
        }

        return $this;
    }

    /**
     * Set the value of [billedto_outlet] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setBilledtoOutlet($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->billedto_outlet !== $v) {
            $this->billedto_outlet = $v;
            $this->modifiedColumns[ShippingorderTableMap::COL_BILLEDTO_OUTLET] = true;
        }

        return $this;
    }

    /**
     * Set the value of [sv_id] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setSvId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->sv_id !== $v) {
            $this->sv_id = $v;
            $this->modifiedColumns[ShippingorderTableMap::COL_SV_ID] = true;
        }

        if ($this->aStockVoucher !== null && $this->aStockVoucher->getSvid() !== $v) {
            $this->aStockVoucher = null;
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
            $this->modifiedColumns[ShippingorderTableMap::COL_PAYMENT_MODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [payment_remark] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPaymentRemark($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->payment_remark !== $v) {
            $this->payment_remark = $v;
            $this->modifiedColumns[ShippingorderTableMap::COL_PAYMENT_REMARK] = true;
        }

        return $this;
    }

    /**
     * Set the value of [payment_status] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPaymentStatus($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->payment_status !== $v) {
            $this->payment_status = $v;
            $this->modifiedColumns[ShippingorderTableMap::COL_PAYMENT_STATUS] = true;
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
            $this->modifiedColumns[ShippingorderTableMap::COL_INTEGRATION_ID] = true;
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
            if ($this->so_number !== '') {
                return false;
            }

            if ($this->user_id !== 0) {
                return false;
            }

            if ($this->company_id !== 0) {
                return false;
            }

            if ($this->invoice_number !== '0') {
                return false;
            }

            if ($this->shipping_mode !== '0') {
                return false;
            }

            if ($this->shipping_partner !== '0') {
                return false;
            }

            if ($this->tracking_number !== '0') {
                return false;
            }

            if ($this->invoice_amount !== '0.00') {
                return false;
            }

            if ($this->invoice_file !== '0') {
                return false;
            }

            if ($this->billedby_outlet !== 0) {
                return false;
            }

            if ($this->billedto_outlet !== 0) {
                return false;
            }

            if ($this->sv_id !== '0') {
                return false;
            }

            if ($this->payment_status !== 'DUE') {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : ShippingorderTableMap::translateFieldName('Soid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->soid = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : ShippingorderTableMap::translateFieldName('OrderId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->order_id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : ShippingorderTableMap::translateFieldName('SoNumber', TableMap::TYPE_PHPNAME, $indexType)];
            $this->so_number = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : ShippingorderTableMap::translateFieldName('ShippingOrderDate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->shipping_order_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : ShippingorderTableMap::translateFieldName('SoStatus', TableMap::TYPE_PHPNAME, $indexType)];
            $this->so_status = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : ShippingorderTableMap::translateFieldName('UserId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->user_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : ShippingorderTableMap::translateFieldName('CompanyId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->company_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : ShippingorderTableMap::translateFieldName('InvoiceNumber', TableMap::TYPE_PHPNAME, $indexType)];
            $this->invoice_number = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : ShippingorderTableMap::translateFieldName('ShippingMode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->shipping_mode = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : ShippingorderTableMap::translateFieldName('ShippingPartner', TableMap::TYPE_PHPNAME, $indexType)];
            $this->shipping_partner = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : ShippingorderTableMap::translateFieldName('TrackingNumber', TableMap::TYPE_PHPNAME, $indexType)];
            $this->tracking_number = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : ShippingorderTableMap::translateFieldName('InvoiceAmount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->invoice_amount = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : ShippingorderTableMap::translateFieldName('InvoiceFile', TableMap::TYPE_PHPNAME, $indexType)];
            $this->invoice_file = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : ShippingorderTableMap::translateFieldName('CreatedDate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->created_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : ShippingorderTableMap::translateFieldName('BilledbyOutlet', TableMap::TYPE_PHPNAME, $indexType)];
            $this->billedby_outlet = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : ShippingorderTableMap::translateFieldName('BilledtoOutlet', TableMap::TYPE_PHPNAME, $indexType)];
            $this->billedto_outlet = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : ShippingorderTableMap::translateFieldName('SvId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->sv_id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : ShippingorderTableMap::translateFieldName('PaymentMode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->payment_mode = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 18 + $startcol : ShippingorderTableMap::translateFieldName('PaymentRemark', TableMap::TYPE_PHPNAME, $indexType)];
            $this->payment_remark = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 19 + $startcol : ShippingorderTableMap::translateFieldName('PaymentStatus', TableMap::TYPE_PHPNAME, $indexType)];
            $this->payment_status = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 20 + $startcol : ShippingorderTableMap::translateFieldName('IntegrationId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->integration_id = (null !== $col) ? (string) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 21; // 21 = ShippingorderTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\entities\\Shippingorder'), 0, $e);
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
        if ($this->aUsers !== null && $this->user_id !== $this->aUsers->getUserId()) {
            $this->aUsers = null;
        }
        if ($this->aCompany !== null && $this->company_id !== $this->aCompany->getCompanyId()) {
            $this->aCompany = null;
        }
        if ($this->aStockVoucher !== null && $this->sv_id !== $this->aStockVoucher->getSvid()) {
            $this->aStockVoucher = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(ShippingorderTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildShippingorderQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aCompany = null;
            $this->aOrders = null;
            $this->aStockVoucher = null;
            $this->aUsers = null;
            $this->collShippingliness = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see Shippingorder::setDeleted()
     * @see Shippingorder::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(ShippingorderTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildShippingorderQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(ShippingorderTableMap::DATABASE_NAME);
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
                ShippingorderTableMap::addInstanceToPool($this);
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

        $this->modifiedColumns[ShippingorderTableMap::COL_SOID] = true;
        if (null !== $this->soid) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . ShippingorderTableMap::COL_SOID . ')');
        }
        if (null === $this->soid) {
            try {
                $dataFetcher = $con->query("SELECT nextval('shippingorder_soid_seq')");
                $this->soid = (string) $dataFetcher->fetchColumn();
            } catch (Exception $e) {
                throw new PropelException('Unable to get sequence id.', 0, $e);
            }
        }


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(ShippingorderTableMap::COL_SOID)) {
            $modifiedColumns[':p' . $index++]  = 'soid';
        }
        if ($this->isColumnModified(ShippingorderTableMap::COL_ORDER_ID)) {
            $modifiedColumns[':p' . $index++]  = 'order_id';
        }
        if ($this->isColumnModified(ShippingorderTableMap::COL_SO_NUMBER)) {
            $modifiedColumns[':p' . $index++]  = 'so_number';
        }
        if ($this->isColumnModified(ShippingorderTableMap::COL_SHIPPING_ORDER_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'shipping_order_date';
        }
        if ($this->isColumnModified(ShippingorderTableMap::COL_SO_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'so_status';
        }
        if ($this->isColumnModified(ShippingorderTableMap::COL_USER_ID)) {
            $modifiedColumns[':p' . $index++]  = 'user_id';
        }
        if ($this->isColumnModified(ShippingorderTableMap::COL_COMPANY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'company_id';
        }
        if ($this->isColumnModified(ShippingorderTableMap::COL_INVOICE_NUMBER)) {
            $modifiedColumns[':p' . $index++]  = 'invoice_number';
        }
        if ($this->isColumnModified(ShippingorderTableMap::COL_SHIPPING_MODE)) {
            $modifiedColumns[':p' . $index++]  = 'shipping_mode';
        }
        if ($this->isColumnModified(ShippingorderTableMap::COL_SHIPPING_PARTNER)) {
            $modifiedColumns[':p' . $index++]  = 'shipping_partner';
        }
        if ($this->isColumnModified(ShippingorderTableMap::COL_TRACKING_NUMBER)) {
            $modifiedColumns[':p' . $index++]  = 'tracking_number';
        }
        if ($this->isColumnModified(ShippingorderTableMap::COL_INVOICE_AMOUNT)) {
            $modifiedColumns[':p' . $index++]  = 'invoice_amount';
        }
        if ($this->isColumnModified(ShippingorderTableMap::COL_INVOICE_FILE)) {
            $modifiedColumns[':p' . $index++]  = 'invoice_file';
        }
        if ($this->isColumnModified(ShippingorderTableMap::COL_CREATED_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'created_date';
        }
        if ($this->isColumnModified(ShippingorderTableMap::COL_BILLEDBY_OUTLET)) {
            $modifiedColumns[':p' . $index++]  = 'billedby_outlet';
        }
        if ($this->isColumnModified(ShippingorderTableMap::COL_BILLEDTO_OUTLET)) {
            $modifiedColumns[':p' . $index++]  = 'billedto_outlet';
        }
        if ($this->isColumnModified(ShippingorderTableMap::COL_SV_ID)) {
            $modifiedColumns[':p' . $index++]  = 'sv_id';
        }
        if ($this->isColumnModified(ShippingorderTableMap::COL_PAYMENT_MODE)) {
            $modifiedColumns[':p' . $index++]  = 'payment_mode';
        }
        if ($this->isColumnModified(ShippingorderTableMap::COL_PAYMENT_REMARK)) {
            $modifiedColumns[':p' . $index++]  = 'payment_remark';
        }
        if ($this->isColumnModified(ShippingorderTableMap::COL_PAYMENT_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'payment_status';
        }
        if ($this->isColumnModified(ShippingorderTableMap::COL_INTEGRATION_ID)) {
            $modifiedColumns[':p' . $index++]  = 'integration_id';
        }

        $sql = sprintf(
            'INSERT INTO shippingorder (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'soid':
                        $stmt->bindValue($identifier, $this->soid, PDO::PARAM_INT);

                        break;
                    case 'order_id':
                        $stmt->bindValue($identifier, $this->order_id, PDO::PARAM_INT);

                        break;
                    case 'so_number':
                        $stmt->bindValue($identifier, $this->so_number, PDO::PARAM_STR);

                        break;
                    case 'shipping_order_date':
                        $stmt->bindValue($identifier, $this->shipping_order_date ? $this->shipping_order_date->format("Y-m-d") : null, PDO::PARAM_STR);

                        break;
                    case 'so_status':
                        $stmt->bindValue($identifier, $this->so_status, PDO::PARAM_STR);

                        break;
                    case 'user_id':
                        $stmt->bindValue($identifier, $this->user_id, PDO::PARAM_INT);

                        break;
                    case 'company_id':
                        $stmt->bindValue($identifier, $this->company_id, PDO::PARAM_INT);

                        break;
                    case 'invoice_number':
                        $stmt->bindValue($identifier, $this->invoice_number, PDO::PARAM_STR);

                        break;
                    case 'shipping_mode':
                        $stmt->bindValue($identifier, $this->shipping_mode, PDO::PARAM_STR);

                        break;
                    case 'shipping_partner':
                        $stmt->bindValue($identifier, $this->shipping_partner, PDO::PARAM_STR);

                        break;
                    case 'tracking_number':
                        $stmt->bindValue($identifier, $this->tracking_number, PDO::PARAM_STR);

                        break;
                    case 'invoice_amount':
                        $stmt->bindValue($identifier, $this->invoice_amount, PDO::PARAM_STR);

                        break;
                    case 'invoice_file':
                        $stmt->bindValue($identifier, $this->invoice_file, PDO::PARAM_STR);

                        break;
                    case 'created_date':
                        $stmt->bindValue($identifier, $this->created_date ? $this->created_date->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'billedby_outlet':
                        $stmt->bindValue($identifier, $this->billedby_outlet, PDO::PARAM_INT);

                        break;
                    case 'billedto_outlet':
                        $stmt->bindValue($identifier, $this->billedto_outlet, PDO::PARAM_INT);

                        break;
                    case 'sv_id':
                        $stmt->bindValue($identifier, $this->sv_id, PDO::PARAM_INT);

                        break;
                    case 'payment_mode':
                        $stmt->bindValue($identifier, $this->payment_mode, PDO::PARAM_STR);

                        break;
                    case 'payment_remark':
                        $stmt->bindValue($identifier, $this->payment_remark, PDO::PARAM_STR);

                        break;
                    case 'payment_status':
                        $stmt->bindValue($identifier, $this->payment_status, PDO::PARAM_STR);

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
        $pos = ShippingorderTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getSoid();

            case 1:
                return $this->getOrderId();

            case 2:
                return $this->getSoNumber();

            case 3:
                return $this->getShippingOrderDate();

            case 4:
                return $this->getSoStatus();

            case 5:
                return $this->getUserId();

            case 6:
                return $this->getCompanyId();

            case 7:
                return $this->getInvoiceNumber();

            case 8:
                return $this->getShippingMode();

            case 9:
                return $this->getShippingPartner();

            case 10:
                return $this->getTrackingNumber();

            case 11:
                return $this->getInvoiceAmount();

            case 12:
                return $this->getInvoiceFile();

            case 13:
                return $this->getCreatedDate();

            case 14:
                return $this->getBilledbyOutlet();

            case 15:
                return $this->getBilledtoOutlet();

            case 16:
                return $this->getSvId();

            case 17:
                return $this->getPaymentMode();

            case 18:
                return $this->getPaymentRemark();

            case 19:
                return $this->getPaymentStatus();

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
        if (isset($alreadyDumpedObjects['Shippingorder'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['Shippingorder'][$this->hashCode()] = true;
        $keys = ShippingorderTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getSoid(),
            $keys[1] => $this->getOrderId(),
            $keys[2] => $this->getSoNumber(),
            $keys[3] => $this->getShippingOrderDate(),
            $keys[4] => $this->getSoStatus(),
            $keys[5] => $this->getUserId(),
            $keys[6] => $this->getCompanyId(),
            $keys[7] => $this->getInvoiceNumber(),
            $keys[8] => $this->getShippingMode(),
            $keys[9] => $this->getShippingPartner(),
            $keys[10] => $this->getTrackingNumber(),
            $keys[11] => $this->getInvoiceAmount(),
            $keys[12] => $this->getInvoiceFile(),
            $keys[13] => $this->getCreatedDate(),
            $keys[14] => $this->getBilledbyOutlet(),
            $keys[15] => $this->getBilledtoOutlet(),
            $keys[16] => $this->getSvId(),
            $keys[17] => $this->getPaymentMode(),
            $keys[18] => $this->getPaymentRemark(),
            $keys[19] => $this->getPaymentStatus(),
            $keys[20] => $this->getIntegrationId(),
        ];
        if ($result[$keys[3]] instanceof \DateTimeInterface) {
            $result[$keys[3]] = $result[$keys[3]]->format('Y-m-d');
        }

        if ($result[$keys[13]] instanceof \DateTimeInterface) {
            $result[$keys[13]] = $result[$keys[13]]->format('Y-m-d H:i:s.u');
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
        $pos = ShippingorderTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setSoid($value);
                break;
            case 1:
                $this->setOrderId($value);
                break;
            case 2:
                $this->setSoNumber($value);
                break;
            case 3:
                $this->setShippingOrderDate($value);
                break;
            case 4:
                $this->setSoStatus($value);
                break;
            case 5:
                $this->setUserId($value);
                break;
            case 6:
                $this->setCompanyId($value);
                break;
            case 7:
                $this->setInvoiceNumber($value);
                break;
            case 8:
                $this->setShippingMode($value);
                break;
            case 9:
                $this->setShippingPartner($value);
                break;
            case 10:
                $this->setTrackingNumber($value);
                break;
            case 11:
                $this->setInvoiceAmount($value);
                break;
            case 12:
                $this->setInvoiceFile($value);
                break;
            case 13:
                $this->setCreatedDate($value);
                break;
            case 14:
                $this->setBilledbyOutlet($value);
                break;
            case 15:
                $this->setBilledtoOutlet($value);
                break;
            case 16:
                $this->setSvId($value);
                break;
            case 17:
                $this->setPaymentMode($value);
                break;
            case 18:
                $this->setPaymentRemark($value);
                break;
            case 19:
                $this->setPaymentStatus($value);
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
        $keys = ShippingorderTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setSoid($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setOrderId($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setSoNumber($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setShippingOrderDate($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setSoStatus($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setUserId($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setCompanyId($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setInvoiceNumber($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setShippingMode($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setShippingPartner($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setTrackingNumber($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setInvoiceAmount($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setInvoiceFile($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setCreatedDate($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setBilledbyOutlet($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setBilledtoOutlet($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setSvId($arr[$keys[16]]);
        }
        if (array_key_exists($keys[17], $arr)) {
            $this->setPaymentMode($arr[$keys[17]]);
        }
        if (array_key_exists($keys[18], $arr)) {
            $this->setPaymentRemark($arr[$keys[18]]);
        }
        if (array_key_exists($keys[19], $arr)) {
            $this->setPaymentStatus($arr[$keys[19]]);
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
        $criteria = new Criteria(ShippingorderTableMap::DATABASE_NAME);

        if ($this->isColumnModified(ShippingorderTableMap::COL_SOID)) {
            $criteria->add(ShippingorderTableMap::COL_SOID, $this->soid);
        }
        if ($this->isColumnModified(ShippingorderTableMap::COL_ORDER_ID)) {
            $criteria->add(ShippingorderTableMap::COL_ORDER_ID, $this->order_id);
        }
        if ($this->isColumnModified(ShippingorderTableMap::COL_SO_NUMBER)) {
            $criteria->add(ShippingorderTableMap::COL_SO_NUMBER, $this->so_number);
        }
        if ($this->isColumnModified(ShippingorderTableMap::COL_SHIPPING_ORDER_DATE)) {
            $criteria->add(ShippingorderTableMap::COL_SHIPPING_ORDER_DATE, $this->shipping_order_date);
        }
        if ($this->isColumnModified(ShippingorderTableMap::COL_SO_STATUS)) {
            $criteria->add(ShippingorderTableMap::COL_SO_STATUS, $this->so_status);
        }
        if ($this->isColumnModified(ShippingorderTableMap::COL_USER_ID)) {
            $criteria->add(ShippingorderTableMap::COL_USER_ID, $this->user_id);
        }
        if ($this->isColumnModified(ShippingorderTableMap::COL_COMPANY_ID)) {
            $criteria->add(ShippingorderTableMap::COL_COMPANY_ID, $this->company_id);
        }
        if ($this->isColumnModified(ShippingorderTableMap::COL_INVOICE_NUMBER)) {
            $criteria->add(ShippingorderTableMap::COL_INVOICE_NUMBER, $this->invoice_number);
        }
        if ($this->isColumnModified(ShippingorderTableMap::COL_SHIPPING_MODE)) {
            $criteria->add(ShippingorderTableMap::COL_SHIPPING_MODE, $this->shipping_mode);
        }
        if ($this->isColumnModified(ShippingorderTableMap::COL_SHIPPING_PARTNER)) {
            $criteria->add(ShippingorderTableMap::COL_SHIPPING_PARTNER, $this->shipping_partner);
        }
        if ($this->isColumnModified(ShippingorderTableMap::COL_TRACKING_NUMBER)) {
            $criteria->add(ShippingorderTableMap::COL_TRACKING_NUMBER, $this->tracking_number);
        }
        if ($this->isColumnModified(ShippingorderTableMap::COL_INVOICE_AMOUNT)) {
            $criteria->add(ShippingorderTableMap::COL_INVOICE_AMOUNT, $this->invoice_amount);
        }
        if ($this->isColumnModified(ShippingorderTableMap::COL_INVOICE_FILE)) {
            $criteria->add(ShippingorderTableMap::COL_INVOICE_FILE, $this->invoice_file);
        }
        if ($this->isColumnModified(ShippingorderTableMap::COL_CREATED_DATE)) {
            $criteria->add(ShippingorderTableMap::COL_CREATED_DATE, $this->created_date);
        }
        if ($this->isColumnModified(ShippingorderTableMap::COL_BILLEDBY_OUTLET)) {
            $criteria->add(ShippingorderTableMap::COL_BILLEDBY_OUTLET, $this->billedby_outlet);
        }
        if ($this->isColumnModified(ShippingorderTableMap::COL_BILLEDTO_OUTLET)) {
            $criteria->add(ShippingorderTableMap::COL_BILLEDTO_OUTLET, $this->billedto_outlet);
        }
        if ($this->isColumnModified(ShippingorderTableMap::COL_SV_ID)) {
            $criteria->add(ShippingorderTableMap::COL_SV_ID, $this->sv_id);
        }
        if ($this->isColumnModified(ShippingorderTableMap::COL_PAYMENT_MODE)) {
            $criteria->add(ShippingorderTableMap::COL_PAYMENT_MODE, $this->payment_mode);
        }
        if ($this->isColumnModified(ShippingorderTableMap::COL_PAYMENT_REMARK)) {
            $criteria->add(ShippingorderTableMap::COL_PAYMENT_REMARK, $this->payment_remark);
        }
        if ($this->isColumnModified(ShippingorderTableMap::COL_PAYMENT_STATUS)) {
            $criteria->add(ShippingorderTableMap::COL_PAYMENT_STATUS, $this->payment_status);
        }
        if ($this->isColumnModified(ShippingorderTableMap::COL_INTEGRATION_ID)) {
            $criteria->add(ShippingorderTableMap::COL_INTEGRATION_ID, $this->integration_id);
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
        $criteria = ChildShippingorderQuery::create();
        $criteria->add(ShippingorderTableMap::COL_SOID, $this->soid);

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
        $validPk = null !== $this->getSoid();

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
        return $this->getSoid();
    }

    /**
     * Generic method to set the primary key (soid column).
     *
     * @param string|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?string $key = null): void
    {
        $this->setSoid($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getSoid();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \entities\Shippingorder (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setOrderId($this->getOrderId());
        $copyObj->setSoNumber($this->getSoNumber());
        $copyObj->setShippingOrderDate($this->getShippingOrderDate());
        $copyObj->setSoStatus($this->getSoStatus());
        $copyObj->setUserId($this->getUserId());
        $copyObj->setCompanyId($this->getCompanyId());
        $copyObj->setInvoiceNumber($this->getInvoiceNumber());
        $copyObj->setShippingMode($this->getShippingMode());
        $copyObj->setShippingPartner($this->getShippingPartner());
        $copyObj->setTrackingNumber($this->getTrackingNumber());
        $copyObj->setInvoiceAmount($this->getInvoiceAmount());
        $copyObj->setInvoiceFile($this->getInvoiceFile());
        $copyObj->setCreatedDate($this->getCreatedDate());
        $copyObj->setBilledbyOutlet($this->getBilledbyOutlet());
        $copyObj->setBilledtoOutlet($this->getBilledtoOutlet());
        $copyObj->setSvId($this->getSvId());
        $copyObj->setPaymentMode($this->getPaymentMode());
        $copyObj->setPaymentRemark($this->getPaymentRemark());
        $copyObj->setPaymentStatus($this->getPaymentStatus());
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
            $copyObj->setSoid(NULL); // this is a auto-increment column, so set to default value
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
     * @return \entities\Shippingorder Clone of current object.
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
            $v->addShippingorder($this);
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
                $this->aCompany->addShippingorders($this);
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
            $this->setOrderId(NULL);
        } else {
            $this->setOrderId($v->getOrderId());
        }

        $this->aOrders = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildOrders object, it will not be re-added.
        if ($v !== null) {
            $v->addShippingorder($this);
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
                $this->aOrders->addShippingorders($this);
             */
        }

        return $this->aOrders;
    }

    /**
     * Declares an association between this object and a ChildStockVoucher object.
     *
     * @param ChildStockVoucher|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setStockVoucher(ChildStockVoucher $v = null)
    {
        if ($v === null) {
            $this->setSvId('0');
        } else {
            $this->setSvId($v->getSvid());
        }

        $this->aStockVoucher = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildStockVoucher object, it will not be re-added.
        if ($v !== null) {
            $v->addShippingorder($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildStockVoucher object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildStockVoucher|null The associated ChildStockVoucher object.
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
                $this->aStockVoucher->addShippingorders($this);
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
            $this->setUserId(0);
        } else {
            $this->setUserId($v->getUserId());
        }

        $this->aUsers = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildUsers object, it will not be re-added.
        if ($v !== null) {
            $v->addShippingorder($this);
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
        if ($this->aUsers === null && ($this->user_id != 0)) {
            $this->aUsers = ChildUsersQuery::create()->findPk($this->user_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aUsers->addShippingorders($this);
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
     * If this ChildShippingorder is new, it will return
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
                    ->filterByShippingorder($this)
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
            $shippinglinesRemoved->setShippingorder(null);
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
                ->filterByShippingorder($this)
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
        $shippinglines->setShippingorder($this);
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
            $shippinglines->setShippingorder(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Shippingorder is new, it will return
     * an empty collection; or if this Shippingorder has previously
     * been saved, it will retrieve related Shippingliness from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Shippingorder.
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
     * Otherwise if this Shippingorder is new, it will return
     * an empty collection; or if this Shippingorder has previously
     * been saved, it will retrieve related Shippingliness from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Shippingorder.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildShippinglines[] List of ChildShippinglines objects
     * @phpstan-return ObjectCollection&\Traversable<ChildShippinglines}> List of ChildShippinglines objects
     */
    public function getShippinglinessJoinOrderlines(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildShippinglinesQuery::create(null, $criteria);
        $query->joinWith('Orderlines', $joinBehavior);

        return $this->getShippingliness($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Shippingorder is new, it will return
     * an empty collection; or if this Shippingorder has previously
     * been saved, it will retrieve related Shippingliness from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Shippingorder.
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
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     *
     * @return $this
     */
    public function clear()
    {
        if (null !== $this->aCompany) {
            $this->aCompany->removeShippingorder($this);
        }
        if (null !== $this->aOrders) {
            $this->aOrders->removeShippingorder($this);
        }
        if (null !== $this->aStockVoucher) {
            $this->aStockVoucher->removeShippingorder($this);
        }
        if (null !== $this->aUsers) {
            $this->aUsers->removeShippingorder($this);
        }
        $this->soid = null;
        $this->order_id = null;
        $this->so_number = null;
        $this->shipping_order_date = null;
        $this->so_status = null;
        $this->user_id = null;
        $this->company_id = null;
        $this->invoice_number = null;
        $this->shipping_mode = null;
        $this->shipping_partner = null;
        $this->tracking_number = null;
        $this->invoice_amount = null;
        $this->invoice_file = null;
        $this->created_date = null;
        $this->billedby_outlet = null;
        $this->billedto_outlet = null;
        $this->sv_id = null;
        $this->payment_mode = null;
        $this->payment_remark = null;
        $this->payment_status = null;
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
        return (string) $this->exportTo(ShippingorderTableMap::DEFAULT_STRING_FORMAT);
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