<?php

namespace entities\Map;

use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;
use entities\Orders;
use entities\OrdersQuery;


/**
 * This class defines the structure of the 'orders' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class OrdersTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.OrdersTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'orders';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'Orders';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\Orders';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.Orders';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 21;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 21;

    /**
     * the column name for the order_id field
     */
    public const COL_ORDER_ID = 'orders.order_id';

    /**
     * the column name for the order_number field
     */
    public const COL_ORDER_NUMBER = 'orders.order_number';

    /**
     * the column name for the order_type field
     */
    public const COL_ORDER_TYPE = 'orders.order_type';

    /**
     * the column name for the outlet_from field
     */
    public const COL_OUTLET_FROM = 'orders.outlet_from';

    /**
     * the column name for the outlet_to field
     */
    public const COL_OUTLET_TO = 'orders.outlet_to';

    /**
     * the column name for the pricebook_id field
     */
    public const COL_PRICEBOOK_ID = 'orders.pricebook_id';

    /**
     * the column name for the order_date field
     */
    public const COL_ORDER_DATE = 'orders.order_date';

    /**
     * the column name for the order_subtotal field
     */
    public const COL_ORDER_SUBTOTAL = 'orders.order_subtotal';

    /**
     * the column name for the order_discount field
     */
    public const COL_ORDER_DISCOUNT = 'orders.order_discount';

    /**
     * the column name for the order_total field
     */
    public const COL_ORDER_TOTAL = 'orders.order_total';

    /**
     * the column name for the order_qty field
     */
    public const COL_ORDER_QTY = 'orders.order_qty';

    /**
     * the column name for the employee_id field
     */
    public const COL_EMPLOYEE_ID = 'orders.employee_id';

    /**
     * the column name for the booking_date field
     */
    public const COL_BOOKING_DATE = 'orders.booking_date';

    /**
     * the column name for the territory_id field
     */
    public const COL_TERRITORY_ID = 'orders.territory_id';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'orders.company_id';

    /**
     * the column name for the order_status field
     */
    public const COL_ORDER_STATUS = 'orders.order_status';

    /**
     * the column name for the order_rerference field
     */
    public const COL_ORDER_RERFERENCE = 'orders.order_rerference';

    /**
     * the column name for the order_remark field
     */
    public const COL_ORDER_REMARK = 'orders.order_remark';

    /**
     * the column name for the otp_req_id field
     */
    public const COL_OTP_REQ_ID = 'orders.otp_req_id';

    /**
     * the column name for the beat_id field
     */
    public const COL_BEAT_ID = 'orders.beat_id';

    /**
     * the column name for the integration_id field
     */
    public const COL_INTEGRATION_ID = 'orders.integration_id';

    /**
     * The default string format for model objects of the related table
     */
    public const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     *
     * @var array<string, mixed>
     */
    protected static $fieldNames = [
        self::TYPE_PHPNAME       => ['OrderId', 'OrderNumber', 'OrderType', 'OutletFrom', 'OutletTo', 'PricebookId', 'OrderDate', 'OrderSubtotal', 'OrderDiscount', 'OrderTotal', 'OrderQty', 'EmployeeId', 'BookingDate', 'TerritoryId', 'CompanyId', 'OrderStatus', 'OrderRerference', 'OrderRemark', 'OtpReqId', 'BeatId', 'IntegrationId', ],
        self::TYPE_CAMELNAME     => ['orderId', 'orderNumber', 'orderType', 'outletFrom', 'outletTo', 'pricebookId', 'orderDate', 'orderSubtotal', 'orderDiscount', 'orderTotal', 'orderQty', 'employeeId', 'bookingDate', 'territoryId', 'companyId', 'orderStatus', 'orderRerference', 'orderRemark', 'otpReqId', 'beatId', 'integrationId', ],
        self::TYPE_COLNAME       => [OrdersTableMap::COL_ORDER_ID, OrdersTableMap::COL_ORDER_NUMBER, OrdersTableMap::COL_ORDER_TYPE, OrdersTableMap::COL_OUTLET_FROM, OrdersTableMap::COL_OUTLET_TO, OrdersTableMap::COL_PRICEBOOK_ID, OrdersTableMap::COL_ORDER_DATE, OrdersTableMap::COL_ORDER_SUBTOTAL, OrdersTableMap::COL_ORDER_DISCOUNT, OrdersTableMap::COL_ORDER_TOTAL, OrdersTableMap::COL_ORDER_QTY, OrdersTableMap::COL_EMPLOYEE_ID, OrdersTableMap::COL_BOOKING_DATE, OrdersTableMap::COL_TERRITORY_ID, OrdersTableMap::COL_COMPANY_ID, OrdersTableMap::COL_ORDER_STATUS, OrdersTableMap::COL_ORDER_RERFERENCE, OrdersTableMap::COL_ORDER_REMARK, OrdersTableMap::COL_OTP_REQ_ID, OrdersTableMap::COL_BEAT_ID, OrdersTableMap::COL_INTEGRATION_ID, ],
        self::TYPE_FIELDNAME     => ['order_id', 'order_number', 'order_type', 'outlet_from', 'outlet_to', 'pricebook_id', 'order_date', 'order_subtotal', 'order_discount', 'order_total', 'order_qty', 'employee_id', 'booking_date', 'territory_id', 'company_id', 'order_status', 'order_rerference', 'order_remark', 'otp_req_id', 'beat_id', 'integration_id', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, ]
    ];

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     *
     * @var array<string, mixed>
     */
    protected static $fieldKeys = [
        self::TYPE_PHPNAME       => ['OrderId' => 0, 'OrderNumber' => 1, 'OrderType' => 2, 'OutletFrom' => 3, 'OutletTo' => 4, 'PricebookId' => 5, 'OrderDate' => 6, 'OrderSubtotal' => 7, 'OrderDiscount' => 8, 'OrderTotal' => 9, 'OrderQty' => 10, 'EmployeeId' => 11, 'BookingDate' => 12, 'TerritoryId' => 13, 'CompanyId' => 14, 'OrderStatus' => 15, 'OrderRerference' => 16, 'OrderRemark' => 17, 'OtpReqId' => 18, 'BeatId' => 19, 'IntegrationId' => 20, ],
        self::TYPE_CAMELNAME     => ['orderId' => 0, 'orderNumber' => 1, 'orderType' => 2, 'outletFrom' => 3, 'outletTo' => 4, 'pricebookId' => 5, 'orderDate' => 6, 'orderSubtotal' => 7, 'orderDiscount' => 8, 'orderTotal' => 9, 'orderQty' => 10, 'employeeId' => 11, 'bookingDate' => 12, 'territoryId' => 13, 'companyId' => 14, 'orderStatus' => 15, 'orderRerference' => 16, 'orderRemark' => 17, 'otpReqId' => 18, 'beatId' => 19, 'integrationId' => 20, ],
        self::TYPE_COLNAME       => [OrdersTableMap::COL_ORDER_ID => 0, OrdersTableMap::COL_ORDER_NUMBER => 1, OrdersTableMap::COL_ORDER_TYPE => 2, OrdersTableMap::COL_OUTLET_FROM => 3, OrdersTableMap::COL_OUTLET_TO => 4, OrdersTableMap::COL_PRICEBOOK_ID => 5, OrdersTableMap::COL_ORDER_DATE => 6, OrdersTableMap::COL_ORDER_SUBTOTAL => 7, OrdersTableMap::COL_ORDER_DISCOUNT => 8, OrdersTableMap::COL_ORDER_TOTAL => 9, OrdersTableMap::COL_ORDER_QTY => 10, OrdersTableMap::COL_EMPLOYEE_ID => 11, OrdersTableMap::COL_BOOKING_DATE => 12, OrdersTableMap::COL_TERRITORY_ID => 13, OrdersTableMap::COL_COMPANY_ID => 14, OrdersTableMap::COL_ORDER_STATUS => 15, OrdersTableMap::COL_ORDER_RERFERENCE => 16, OrdersTableMap::COL_ORDER_REMARK => 17, OrdersTableMap::COL_OTP_REQ_ID => 18, OrdersTableMap::COL_BEAT_ID => 19, OrdersTableMap::COL_INTEGRATION_ID => 20, ],
        self::TYPE_FIELDNAME     => ['order_id' => 0, 'order_number' => 1, 'order_type' => 2, 'outlet_from' => 3, 'outlet_to' => 4, 'pricebook_id' => 5, 'order_date' => 6, 'order_subtotal' => 7, 'order_discount' => 8, 'order_total' => 9, 'order_qty' => 10, 'employee_id' => 11, 'booking_date' => 12, 'territory_id' => 13, 'company_id' => 14, 'order_status' => 15, 'order_rerference' => 16, 'order_remark' => 17, 'otp_req_id' => 18, 'beat_id' => 19, 'integration_id' => 20, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'OrderId' => 'ORDER_ID',
        'Orders.OrderId' => 'ORDER_ID',
        'orderId' => 'ORDER_ID',
        'orders.orderId' => 'ORDER_ID',
        'OrdersTableMap::COL_ORDER_ID' => 'ORDER_ID',
        'COL_ORDER_ID' => 'ORDER_ID',
        'order_id' => 'ORDER_ID',
        'orders.order_id' => 'ORDER_ID',
        'OrderNumber' => 'ORDER_NUMBER',
        'Orders.OrderNumber' => 'ORDER_NUMBER',
        'orderNumber' => 'ORDER_NUMBER',
        'orders.orderNumber' => 'ORDER_NUMBER',
        'OrdersTableMap::COL_ORDER_NUMBER' => 'ORDER_NUMBER',
        'COL_ORDER_NUMBER' => 'ORDER_NUMBER',
        'order_number' => 'ORDER_NUMBER',
        'orders.order_number' => 'ORDER_NUMBER',
        'OrderType' => 'ORDER_TYPE',
        'Orders.OrderType' => 'ORDER_TYPE',
        'orderType' => 'ORDER_TYPE',
        'orders.orderType' => 'ORDER_TYPE',
        'OrdersTableMap::COL_ORDER_TYPE' => 'ORDER_TYPE',
        'COL_ORDER_TYPE' => 'ORDER_TYPE',
        'order_type' => 'ORDER_TYPE',
        'orders.order_type' => 'ORDER_TYPE',
        'OutletFrom' => 'OUTLET_FROM',
        'Orders.OutletFrom' => 'OUTLET_FROM',
        'outletFrom' => 'OUTLET_FROM',
        'orders.outletFrom' => 'OUTLET_FROM',
        'OrdersTableMap::COL_OUTLET_FROM' => 'OUTLET_FROM',
        'COL_OUTLET_FROM' => 'OUTLET_FROM',
        'outlet_from' => 'OUTLET_FROM',
        'orders.outlet_from' => 'OUTLET_FROM',
        'OutletTo' => 'OUTLET_TO',
        'Orders.OutletTo' => 'OUTLET_TO',
        'outletTo' => 'OUTLET_TO',
        'orders.outletTo' => 'OUTLET_TO',
        'OrdersTableMap::COL_OUTLET_TO' => 'OUTLET_TO',
        'COL_OUTLET_TO' => 'OUTLET_TO',
        'outlet_to' => 'OUTLET_TO',
        'orders.outlet_to' => 'OUTLET_TO',
        'PricebookId' => 'PRICEBOOK_ID',
        'Orders.PricebookId' => 'PRICEBOOK_ID',
        'pricebookId' => 'PRICEBOOK_ID',
        'orders.pricebookId' => 'PRICEBOOK_ID',
        'OrdersTableMap::COL_PRICEBOOK_ID' => 'PRICEBOOK_ID',
        'COL_PRICEBOOK_ID' => 'PRICEBOOK_ID',
        'pricebook_id' => 'PRICEBOOK_ID',
        'orders.pricebook_id' => 'PRICEBOOK_ID',
        'OrderDate' => 'ORDER_DATE',
        'Orders.OrderDate' => 'ORDER_DATE',
        'orderDate' => 'ORDER_DATE',
        'orders.orderDate' => 'ORDER_DATE',
        'OrdersTableMap::COL_ORDER_DATE' => 'ORDER_DATE',
        'COL_ORDER_DATE' => 'ORDER_DATE',
        'order_date' => 'ORDER_DATE',
        'orders.order_date' => 'ORDER_DATE',
        'OrderSubtotal' => 'ORDER_SUBTOTAL',
        'Orders.OrderSubtotal' => 'ORDER_SUBTOTAL',
        'orderSubtotal' => 'ORDER_SUBTOTAL',
        'orders.orderSubtotal' => 'ORDER_SUBTOTAL',
        'OrdersTableMap::COL_ORDER_SUBTOTAL' => 'ORDER_SUBTOTAL',
        'COL_ORDER_SUBTOTAL' => 'ORDER_SUBTOTAL',
        'order_subtotal' => 'ORDER_SUBTOTAL',
        'orders.order_subtotal' => 'ORDER_SUBTOTAL',
        'OrderDiscount' => 'ORDER_DISCOUNT',
        'Orders.OrderDiscount' => 'ORDER_DISCOUNT',
        'orderDiscount' => 'ORDER_DISCOUNT',
        'orders.orderDiscount' => 'ORDER_DISCOUNT',
        'OrdersTableMap::COL_ORDER_DISCOUNT' => 'ORDER_DISCOUNT',
        'COL_ORDER_DISCOUNT' => 'ORDER_DISCOUNT',
        'order_discount' => 'ORDER_DISCOUNT',
        'orders.order_discount' => 'ORDER_DISCOUNT',
        'OrderTotal' => 'ORDER_TOTAL',
        'Orders.OrderTotal' => 'ORDER_TOTAL',
        'orderTotal' => 'ORDER_TOTAL',
        'orders.orderTotal' => 'ORDER_TOTAL',
        'OrdersTableMap::COL_ORDER_TOTAL' => 'ORDER_TOTAL',
        'COL_ORDER_TOTAL' => 'ORDER_TOTAL',
        'order_total' => 'ORDER_TOTAL',
        'orders.order_total' => 'ORDER_TOTAL',
        'OrderQty' => 'ORDER_QTY',
        'Orders.OrderQty' => 'ORDER_QTY',
        'orderQty' => 'ORDER_QTY',
        'orders.orderQty' => 'ORDER_QTY',
        'OrdersTableMap::COL_ORDER_QTY' => 'ORDER_QTY',
        'COL_ORDER_QTY' => 'ORDER_QTY',
        'order_qty' => 'ORDER_QTY',
        'orders.order_qty' => 'ORDER_QTY',
        'EmployeeId' => 'EMPLOYEE_ID',
        'Orders.EmployeeId' => 'EMPLOYEE_ID',
        'employeeId' => 'EMPLOYEE_ID',
        'orders.employeeId' => 'EMPLOYEE_ID',
        'OrdersTableMap::COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'employee_id' => 'EMPLOYEE_ID',
        'orders.employee_id' => 'EMPLOYEE_ID',
        'BookingDate' => 'BOOKING_DATE',
        'Orders.BookingDate' => 'BOOKING_DATE',
        'bookingDate' => 'BOOKING_DATE',
        'orders.bookingDate' => 'BOOKING_DATE',
        'OrdersTableMap::COL_BOOKING_DATE' => 'BOOKING_DATE',
        'COL_BOOKING_DATE' => 'BOOKING_DATE',
        'booking_date' => 'BOOKING_DATE',
        'orders.booking_date' => 'BOOKING_DATE',
        'TerritoryId' => 'TERRITORY_ID',
        'Orders.TerritoryId' => 'TERRITORY_ID',
        'territoryId' => 'TERRITORY_ID',
        'orders.territoryId' => 'TERRITORY_ID',
        'OrdersTableMap::COL_TERRITORY_ID' => 'TERRITORY_ID',
        'COL_TERRITORY_ID' => 'TERRITORY_ID',
        'territory_id' => 'TERRITORY_ID',
        'orders.territory_id' => 'TERRITORY_ID',
        'CompanyId' => 'COMPANY_ID',
        'Orders.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'orders.companyId' => 'COMPANY_ID',
        'OrdersTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'orders.company_id' => 'COMPANY_ID',
        'OrderStatus' => 'ORDER_STATUS',
        'Orders.OrderStatus' => 'ORDER_STATUS',
        'orderStatus' => 'ORDER_STATUS',
        'orders.orderStatus' => 'ORDER_STATUS',
        'OrdersTableMap::COL_ORDER_STATUS' => 'ORDER_STATUS',
        'COL_ORDER_STATUS' => 'ORDER_STATUS',
        'order_status' => 'ORDER_STATUS',
        'orders.order_status' => 'ORDER_STATUS',
        'OrderRerference' => 'ORDER_RERFERENCE',
        'Orders.OrderRerference' => 'ORDER_RERFERENCE',
        'orderRerference' => 'ORDER_RERFERENCE',
        'orders.orderRerference' => 'ORDER_RERFERENCE',
        'OrdersTableMap::COL_ORDER_RERFERENCE' => 'ORDER_RERFERENCE',
        'COL_ORDER_RERFERENCE' => 'ORDER_RERFERENCE',
        'order_rerference' => 'ORDER_RERFERENCE',
        'orders.order_rerference' => 'ORDER_RERFERENCE',
        'OrderRemark' => 'ORDER_REMARK',
        'Orders.OrderRemark' => 'ORDER_REMARK',
        'orderRemark' => 'ORDER_REMARK',
        'orders.orderRemark' => 'ORDER_REMARK',
        'OrdersTableMap::COL_ORDER_REMARK' => 'ORDER_REMARK',
        'COL_ORDER_REMARK' => 'ORDER_REMARK',
        'order_remark' => 'ORDER_REMARK',
        'orders.order_remark' => 'ORDER_REMARK',
        'OtpReqId' => 'OTP_REQ_ID',
        'Orders.OtpReqId' => 'OTP_REQ_ID',
        'otpReqId' => 'OTP_REQ_ID',
        'orders.otpReqId' => 'OTP_REQ_ID',
        'OrdersTableMap::COL_OTP_REQ_ID' => 'OTP_REQ_ID',
        'COL_OTP_REQ_ID' => 'OTP_REQ_ID',
        'otp_req_id' => 'OTP_REQ_ID',
        'orders.otp_req_id' => 'OTP_REQ_ID',
        'BeatId' => 'BEAT_ID',
        'Orders.BeatId' => 'BEAT_ID',
        'beatId' => 'BEAT_ID',
        'orders.beatId' => 'BEAT_ID',
        'OrdersTableMap::COL_BEAT_ID' => 'BEAT_ID',
        'COL_BEAT_ID' => 'BEAT_ID',
        'beat_id' => 'BEAT_ID',
        'orders.beat_id' => 'BEAT_ID',
        'IntegrationId' => 'INTEGRATION_ID',
        'Orders.IntegrationId' => 'INTEGRATION_ID',
        'integrationId' => 'INTEGRATION_ID',
        'orders.integrationId' => 'INTEGRATION_ID',
        'OrdersTableMap::COL_INTEGRATION_ID' => 'INTEGRATION_ID',
        'COL_INTEGRATION_ID' => 'INTEGRATION_ID',
        'integration_id' => 'INTEGRATION_ID',
        'orders.integration_id' => 'INTEGRATION_ID',
    ];

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function initialize(): void
    {
        // attributes
        $this->setName('orders');
        $this->setPhpName('Orders');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\Orders');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('orders_order_id_seq');
        // columns
        $this->addPrimaryKey('order_id', 'OrderId', 'BIGINT', true, null, null);
        $this->addColumn('order_number', 'OrderNumber', 'VARCHAR', false, 50, null);
        $this->addColumn('order_type', 'OrderType', 'VARCHAR', false, 50, null);
        $this->addForeignKey('outlet_from', 'OutletFrom', 'INTEGER', 'outlets', 'id', false, null, null);
        $this->addForeignKey('outlet_to', 'OutletTo', 'INTEGER', 'outlets', 'id', false, null, null);
        $this->addForeignKey('pricebook_id', 'PricebookId', 'INTEGER', 'pricebooks', 'pricebook_id', false, null, null);
        $this->addColumn('order_date', 'OrderDate', 'DATE', false, null, null);
        $this->addColumn('order_subtotal', 'OrderSubtotal', 'DECIMAL', false, 20, null);
        $this->addColumn('order_discount', 'OrderDiscount', 'DECIMAL', false, 20, null);
        $this->addColumn('order_total', 'OrderTotal', 'DECIMAL', false, 20, null);
        $this->addColumn('order_qty', 'OrderQty', 'DECIMAL', false, 20, null);
        $this->addForeignKey('employee_id', 'EmployeeId', 'INTEGER', 'employee', 'employee_id', false, null, null);
        $this->addColumn('booking_date', 'BookingDate', 'DATE', false, null, null);
        $this->addForeignKey('territory_id', 'TerritoryId', 'INTEGER', 'territories', 'territory_id', false, null, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', false, null, null);
        $this->addColumn('order_status', 'OrderStatus', 'VARCHAR', false, 50, null);
        $this->addColumn('order_rerference', 'OrderRerference', 'VARCHAR', false, 50, null);
        $this->addColumn('order_remark', 'OrderRemark', 'VARCHAR', false, 150, null);
        $this->addColumn('otp_req_id', 'OtpReqId', 'INTEGER', false, null, null);
        $this->addForeignKey('beat_id', 'BeatId', 'INTEGER', 'beats', 'beat_id', false, null, null);
        $this->addColumn('integration_id', 'IntegrationId', 'VARCHAR', false, 50, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('Company', '\\entities\\Company', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, null, false);
        $this->addRelation('Employee', '\\entities\\Employee', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':employee_id',
    1 => ':employee_id',
  ),
), null, null, null, false);
        $this->addRelation('OutletsRelatedByOutletFrom', '\\entities\\Outlets', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':outlet_from',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('OutletsRelatedByOutletTo', '\\entities\\Outlets', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':outlet_to',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('Territories', '\\entities\\Territories', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':territory_id',
    1 => ':territory_id',
  ),
), null, null, null, false);
        $this->addRelation('Beats', '\\entities\\Beats', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':beat_id',
    1 => ':beat_id',
  ),
), null, null, null, false);
        $this->addRelation('Pricebooks', '\\entities\\Pricebooks', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':pricebook_id',
    1 => ':pricebook_id',
  ),
), null, null, null, false);
        $this->addRelation('OrderLog', '\\entities\\OrderLog', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':order_id',
    1 => ':order_id',
  ),
), null, null, 'OrderLogs', false);
        $this->addRelation('Orderlines', '\\entities\\Orderlines', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':order_id',
    1 => ':order_id',
  ),
), null, null, 'Orderliness', false);
        $this->addRelation('Shippingorder', '\\entities\\Shippingorder', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':order_id',
    1 => ':order_id',
  ),
), null, null, 'Shippingorders', false);
    }

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array $row Resultset row.
     * @param int $offset The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string|null The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): ?string
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OrderId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OrderId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OrderId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OrderId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OrderId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OrderId', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array $row Resultset row.
     * @param int $offset The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM)
    {
        return (string) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('OrderId', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param bool $withPrefix Whether to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass(bool $withPrefix = true): string
    {
        return $withPrefix ? OrdersTableMap::CLASS_DEFAULT : OrdersTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array $row Row returned by DataFetcher->fetch().
     * @param int $offset The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array (Orders object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = OrdersTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = OrdersTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + OrdersTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = OrdersTableMap::OM_CLASS;
            /** @var Orders $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            OrdersTableMap::addInstanceToPool($obj, $key);
        }

        return [$obj, $col];
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array<object>
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher): array
    {
        $results = [];

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = OrdersTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = OrdersTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Orders $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                OrdersTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria Object containing the columns to add.
     * @param string|null $alias Optional table alias
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return void
     */
    public static function addSelectColumns(Criteria $criteria, ?string $alias = null): void
    {
        if (null === $alias) {
            $criteria->addSelectColumn(OrdersTableMap::COL_ORDER_ID);
            $criteria->addSelectColumn(OrdersTableMap::COL_ORDER_NUMBER);
            $criteria->addSelectColumn(OrdersTableMap::COL_ORDER_TYPE);
            $criteria->addSelectColumn(OrdersTableMap::COL_OUTLET_FROM);
            $criteria->addSelectColumn(OrdersTableMap::COL_OUTLET_TO);
            $criteria->addSelectColumn(OrdersTableMap::COL_PRICEBOOK_ID);
            $criteria->addSelectColumn(OrdersTableMap::COL_ORDER_DATE);
            $criteria->addSelectColumn(OrdersTableMap::COL_ORDER_SUBTOTAL);
            $criteria->addSelectColumn(OrdersTableMap::COL_ORDER_DISCOUNT);
            $criteria->addSelectColumn(OrdersTableMap::COL_ORDER_TOTAL);
            $criteria->addSelectColumn(OrdersTableMap::COL_ORDER_QTY);
            $criteria->addSelectColumn(OrdersTableMap::COL_EMPLOYEE_ID);
            $criteria->addSelectColumn(OrdersTableMap::COL_BOOKING_DATE);
            $criteria->addSelectColumn(OrdersTableMap::COL_TERRITORY_ID);
            $criteria->addSelectColumn(OrdersTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(OrdersTableMap::COL_ORDER_STATUS);
            $criteria->addSelectColumn(OrdersTableMap::COL_ORDER_RERFERENCE);
            $criteria->addSelectColumn(OrdersTableMap::COL_ORDER_REMARK);
            $criteria->addSelectColumn(OrdersTableMap::COL_OTP_REQ_ID);
            $criteria->addSelectColumn(OrdersTableMap::COL_BEAT_ID);
            $criteria->addSelectColumn(OrdersTableMap::COL_INTEGRATION_ID);
        } else {
            $criteria->addSelectColumn($alias . '.order_id');
            $criteria->addSelectColumn($alias . '.order_number');
            $criteria->addSelectColumn($alias . '.order_type');
            $criteria->addSelectColumn($alias . '.outlet_from');
            $criteria->addSelectColumn($alias . '.outlet_to');
            $criteria->addSelectColumn($alias . '.pricebook_id');
            $criteria->addSelectColumn($alias . '.order_date');
            $criteria->addSelectColumn($alias . '.order_subtotal');
            $criteria->addSelectColumn($alias . '.order_discount');
            $criteria->addSelectColumn($alias . '.order_total');
            $criteria->addSelectColumn($alias . '.order_qty');
            $criteria->addSelectColumn($alias . '.employee_id');
            $criteria->addSelectColumn($alias . '.booking_date');
            $criteria->addSelectColumn($alias . '.territory_id');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.order_status');
            $criteria->addSelectColumn($alias . '.order_rerference');
            $criteria->addSelectColumn($alias . '.order_remark');
            $criteria->addSelectColumn($alias . '.otp_req_id');
            $criteria->addSelectColumn($alias . '.beat_id');
            $criteria->addSelectColumn($alias . '.integration_id');
        }
    }

    /**
     * Remove all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be removed as they are only loaded on demand.
     *
     * @param Criteria $criteria Object containing the columns to remove.
     * @param string|null $alias Optional table alias
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return void
     */
    public static function removeSelectColumns(Criteria $criteria, ?string $alias = null): void
    {
        if (null === $alias) {
            $criteria->removeSelectColumn(OrdersTableMap::COL_ORDER_ID);
            $criteria->removeSelectColumn(OrdersTableMap::COL_ORDER_NUMBER);
            $criteria->removeSelectColumn(OrdersTableMap::COL_ORDER_TYPE);
            $criteria->removeSelectColumn(OrdersTableMap::COL_OUTLET_FROM);
            $criteria->removeSelectColumn(OrdersTableMap::COL_OUTLET_TO);
            $criteria->removeSelectColumn(OrdersTableMap::COL_PRICEBOOK_ID);
            $criteria->removeSelectColumn(OrdersTableMap::COL_ORDER_DATE);
            $criteria->removeSelectColumn(OrdersTableMap::COL_ORDER_SUBTOTAL);
            $criteria->removeSelectColumn(OrdersTableMap::COL_ORDER_DISCOUNT);
            $criteria->removeSelectColumn(OrdersTableMap::COL_ORDER_TOTAL);
            $criteria->removeSelectColumn(OrdersTableMap::COL_ORDER_QTY);
            $criteria->removeSelectColumn(OrdersTableMap::COL_EMPLOYEE_ID);
            $criteria->removeSelectColumn(OrdersTableMap::COL_BOOKING_DATE);
            $criteria->removeSelectColumn(OrdersTableMap::COL_TERRITORY_ID);
            $criteria->removeSelectColumn(OrdersTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(OrdersTableMap::COL_ORDER_STATUS);
            $criteria->removeSelectColumn(OrdersTableMap::COL_ORDER_RERFERENCE);
            $criteria->removeSelectColumn(OrdersTableMap::COL_ORDER_REMARK);
            $criteria->removeSelectColumn(OrdersTableMap::COL_OTP_REQ_ID);
            $criteria->removeSelectColumn(OrdersTableMap::COL_BEAT_ID);
            $criteria->removeSelectColumn(OrdersTableMap::COL_INTEGRATION_ID);
        } else {
            $criteria->removeSelectColumn($alias . '.order_id');
            $criteria->removeSelectColumn($alias . '.order_number');
            $criteria->removeSelectColumn($alias . '.order_type');
            $criteria->removeSelectColumn($alias . '.outlet_from');
            $criteria->removeSelectColumn($alias . '.outlet_to');
            $criteria->removeSelectColumn($alias . '.pricebook_id');
            $criteria->removeSelectColumn($alias . '.order_date');
            $criteria->removeSelectColumn($alias . '.order_subtotal');
            $criteria->removeSelectColumn($alias . '.order_discount');
            $criteria->removeSelectColumn($alias . '.order_total');
            $criteria->removeSelectColumn($alias . '.order_qty');
            $criteria->removeSelectColumn($alias . '.employee_id');
            $criteria->removeSelectColumn($alias . '.booking_date');
            $criteria->removeSelectColumn($alias . '.territory_id');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.order_status');
            $criteria->removeSelectColumn($alias . '.order_rerference');
            $criteria->removeSelectColumn($alias . '.order_remark');
            $criteria->removeSelectColumn($alias . '.otp_req_id');
            $criteria->removeSelectColumn($alias . '.beat_id');
            $criteria->removeSelectColumn($alias . '.integration_id');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap(): TableMap
    {
        return Propel::getServiceContainer()->getDatabaseMap(OrdersTableMap::DATABASE_NAME)->getTable(OrdersTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Orders or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or Orders object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ?ConnectionInterface $con = null): int
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OrdersTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\Orders) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(OrdersTableMap::DATABASE_NAME);
            $criteria->add(OrdersTableMap::COL_ORDER_ID, (array) $values, Criteria::IN);
        }

        $query = OrdersQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            OrdersTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                OrdersTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the orders table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return OrdersQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Orders or Criteria object.
     *
     * @param mixed $criteria Criteria or Orders object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OrdersTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Orders object
        }

        if ($criteria->containsKey(OrdersTableMap::COL_ORDER_ID) && $criteria->keyContainsValue(OrdersTableMap::COL_ORDER_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.OrdersTableMap::COL_ORDER_ID.')');
        }


        // Set the correct dbName
        $query = OrdersQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
