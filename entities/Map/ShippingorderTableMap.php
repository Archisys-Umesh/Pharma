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
use entities\Shippingorder;
use entities\ShippingorderQuery;


/**
 * This class defines the structure of the 'shippingorder' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class ShippingorderTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.ShippingorderTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'shippingorder';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'Shippingorder';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\Shippingorder';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.Shippingorder';

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
     * the column name for the soid field
     */
    public const COL_SOID = 'shippingorder.soid';

    /**
     * the column name for the order_id field
     */
    public const COL_ORDER_ID = 'shippingorder.order_id';

    /**
     * the column name for the so_number field
     */
    public const COL_SO_NUMBER = 'shippingorder.so_number';

    /**
     * the column name for the shipping_order_date field
     */
    public const COL_SHIPPING_ORDER_DATE = 'shippingorder.shipping_order_date';

    /**
     * the column name for the so_status field
     */
    public const COL_SO_STATUS = 'shippingorder.so_status';

    /**
     * the column name for the user_id field
     */
    public const COL_USER_ID = 'shippingorder.user_id';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'shippingorder.company_id';

    /**
     * the column name for the invoice_number field
     */
    public const COL_INVOICE_NUMBER = 'shippingorder.invoice_number';

    /**
     * the column name for the shipping_mode field
     */
    public const COL_SHIPPING_MODE = 'shippingorder.shipping_mode';

    /**
     * the column name for the shipping_partner field
     */
    public const COL_SHIPPING_PARTNER = 'shippingorder.shipping_partner';

    /**
     * the column name for the tracking_number field
     */
    public const COL_TRACKING_NUMBER = 'shippingorder.tracking_number';

    /**
     * the column name for the invoice_amount field
     */
    public const COL_INVOICE_AMOUNT = 'shippingorder.invoice_amount';

    /**
     * the column name for the invoice_file field
     */
    public const COL_INVOICE_FILE = 'shippingorder.invoice_file';

    /**
     * the column name for the created_date field
     */
    public const COL_CREATED_DATE = 'shippingorder.created_date';

    /**
     * the column name for the billedby_outlet field
     */
    public const COL_BILLEDBY_OUTLET = 'shippingorder.billedby_outlet';

    /**
     * the column name for the billedto_outlet field
     */
    public const COL_BILLEDTO_OUTLET = 'shippingorder.billedto_outlet';

    /**
     * the column name for the sv_id field
     */
    public const COL_SV_ID = 'shippingorder.sv_id';

    /**
     * the column name for the payment_mode field
     */
    public const COL_PAYMENT_MODE = 'shippingorder.payment_mode';

    /**
     * the column name for the payment_remark field
     */
    public const COL_PAYMENT_REMARK = 'shippingorder.payment_remark';

    /**
     * the column name for the payment_status field
     */
    public const COL_PAYMENT_STATUS = 'shippingorder.payment_status';

    /**
     * the column name for the integration_id field
     */
    public const COL_INTEGRATION_ID = 'shippingorder.integration_id';

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
        self::TYPE_PHPNAME       => ['Soid', 'OrderId', 'SoNumber', 'ShippingOrderDate', 'SoStatus', 'UserId', 'CompanyId', 'InvoiceNumber', 'ShippingMode', 'ShippingPartner', 'TrackingNumber', 'InvoiceAmount', 'InvoiceFile', 'CreatedDate', 'BilledbyOutlet', 'BilledtoOutlet', 'SvId', 'PaymentMode', 'PaymentRemark', 'PaymentStatus', 'IntegrationId', ],
        self::TYPE_CAMELNAME     => ['soid', 'orderId', 'soNumber', 'shippingOrderDate', 'soStatus', 'userId', 'companyId', 'invoiceNumber', 'shippingMode', 'shippingPartner', 'trackingNumber', 'invoiceAmount', 'invoiceFile', 'createdDate', 'billedbyOutlet', 'billedtoOutlet', 'svId', 'paymentMode', 'paymentRemark', 'paymentStatus', 'integrationId', ],
        self::TYPE_COLNAME       => [ShippingorderTableMap::COL_SOID, ShippingorderTableMap::COL_ORDER_ID, ShippingorderTableMap::COL_SO_NUMBER, ShippingorderTableMap::COL_SHIPPING_ORDER_DATE, ShippingorderTableMap::COL_SO_STATUS, ShippingorderTableMap::COL_USER_ID, ShippingorderTableMap::COL_COMPANY_ID, ShippingorderTableMap::COL_INVOICE_NUMBER, ShippingorderTableMap::COL_SHIPPING_MODE, ShippingorderTableMap::COL_SHIPPING_PARTNER, ShippingorderTableMap::COL_TRACKING_NUMBER, ShippingorderTableMap::COL_INVOICE_AMOUNT, ShippingorderTableMap::COL_INVOICE_FILE, ShippingorderTableMap::COL_CREATED_DATE, ShippingorderTableMap::COL_BILLEDBY_OUTLET, ShippingorderTableMap::COL_BILLEDTO_OUTLET, ShippingorderTableMap::COL_SV_ID, ShippingorderTableMap::COL_PAYMENT_MODE, ShippingorderTableMap::COL_PAYMENT_REMARK, ShippingorderTableMap::COL_PAYMENT_STATUS, ShippingorderTableMap::COL_INTEGRATION_ID, ],
        self::TYPE_FIELDNAME     => ['soid', 'order_id', 'so_number', 'shipping_order_date', 'so_status', 'user_id', 'company_id', 'invoice_number', 'shipping_mode', 'shipping_partner', 'tracking_number', 'invoice_amount', 'invoice_file', 'created_date', 'billedby_outlet', 'billedto_outlet', 'sv_id', 'payment_mode', 'payment_remark', 'payment_status', 'integration_id', ],
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
        self::TYPE_PHPNAME       => ['Soid' => 0, 'OrderId' => 1, 'SoNumber' => 2, 'ShippingOrderDate' => 3, 'SoStatus' => 4, 'UserId' => 5, 'CompanyId' => 6, 'InvoiceNumber' => 7, 'ShippingMode' => 8, 'ShippingPartner' => 9, 'TrackingNumber' => 10, 'InvoiceAmount' => 11, 'InvoiceFile' => 12, 'CreatedDate' => 13, 'BilledbyOutlet' => 14, 'BilledtoOutlet' => 15, 'SvId' => 16, 'PaymentMode' => 17, 'PaymentRemark' => 18, 'PaymentStatus' => 19, 'IntegrationId' => 20, ],
        self::TYPE_CAMELNAME     => ['soid' => 0, 'orderId' => 1, 'soNumber' => 2, 'shippingOrderDate' => 3, 'soStatus' => 4, 'userId' => 5, 'companyId' => 6, 'invoiceNumber' => 7, 'shippingMode' => 8, 'shippingPartner' => 9, 'trackingNumber' => 10, 'invoiceAmount' => 11, 'invoiceFile' => 12, 'createdDate' => 13, 'billedbyOutlet' => 14, 'billedtoOutlet' => 15, 'svId' => 16, 'paymentMode' => 17, 'paymentRemark' => 18, 'paymentStatus' => 19, 'integrationId' => 20, ],
        self::TYPE_COLNAME       => [ShippingorderTableMap::COL_SOID => 0, ShippingorderTableMap::COL_ORDER_ID => 1, ShippingorderTableMap::COL_SO_NUMBER => 2, ShippingorderTableMap::COL_SHIPPING_ORDER_DATE => 3, ShippingorderTableMap::COL_SO_STATUS => 4, ShippingorderTableMap::COL_USER_ID => 5, ShippingorderTableMap::COL_COMPANY_ID => 6, ShippingorderTableMap::COL_INVOICE_NUMBER => 7, ShippingorderTableMap::COL_SHIPPING_MODE => 8, ShippingorderTableMap::COL_SHIPPING_PARTNER => 9, ShippingorderTableMap::COL_TRACKING_NUMBER => 10, ShippingorderTableMap::COL_INVOICE_AMOUNT => 11, ShippingorderTableMap::COL_INVOICE_FILE => 12, ShippingorderTableMap::COL_CREATED_DATE => 13, ShippingorderTableMap::COL_BILLEDBY_OUTLET => 14, ShippingorderTableMap::COL_BILLEDTO_OUTLET => 15, ShippingorderTableMap::COL_SV_ID => 16, ShippingorderTableMap::COL_PAYMENT_MODE => 17, ShippingorderTableMap::COL_PAYMENT_REMARK => 18, ShippingorderTableMap::COL_PAYMENT_STATUS => 19, ShippingorderTableMap::COL_INTEGRATION_ID => 20, ],
        self::TYPE_FIELDNAME     => ['soid' => 0, 'order_id' => 1, 'so_number' => 2, 'shipping_order_date' => 3, 'so_status' => 4, 'user_id' => 5, 'company_id' => 6, 'invoice_number' => 7, 'shipping_mode' => 8, 'shipping_partner' => 9, 'tracking_number' => 10, 'invoice_amount' => 11, 'invoice_file' => 12, 'created_date' => 13, 'billedby_outlet' => 14, 'billedto_outlet' => 15, 'sv_id' => 16, 'payment_mode' => 17, 'payment_remark' => 18, 'payment_status' => 19, 'integration_id' => 20, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Soid' => 'SOID',
        'Shippingorder.Soid' => 'SOID',
        'soid' => 'SOID',
        'shippingorder.soid' => 'SOID',
        'ShippingorderTableMap::COL_SOID' => 'SOID',
        'COL_SOID' => 'SOID',
        'OrderId' => 'ORDER_ID',
        'Shippingorder.OrderId' => 'ORDER_ID',
        'orderId' => 'ORDER_ID',
        'shippingorder.orderId' => 'ORDER_ID',
        'ShippingorderTableMap::COL_ORDER_ID' => 'ORDER_ID',
        'COL_ORDER_ID' => 'ORDER_ID',
        'order_id' => 'ORDER_ID',
        'shippingorder.order_id' => 'ORDER_ID',
        'SoNumber' => 'SO_NUMBER',
        'Shippingorder.SoNumber' => 'SO_NUMBER',
        'soNumber' => 'SO_NUMBER',
        'shippingorder.soNumber' => 'SO_NUMBER',
        'ShippingorderTableMap::COL_SO_NUMBER' => 'SO_NUMBER',
        'COL_SO_NUMBER' => 'SO_NUMBER',
        'so_number' => 'SO_NUMBER',
        'shippingorder.so_number' => 'SO_NUMBER',
        'ShippingOrderDate' => 'SHIPPING_ORDER_DATE',
        'Shippingorder.ShippingOrderDate' => 'SHIPPING_ORDER_DATE',
        'shippingOrderDate' => 'SHIPPING_ORDER_DATE',
        'shippingorder.shippingOrderDate' => 'SHIPPING_ORDER_DATE',
        'ShippingorderTableMap::COL_SHIPPING_ORDER_DATE' => 'SHIPPING_ORDER_DATE',
        'COL_SHIPPING_ORDER_DATE' => 'SHIPPING_ORDER_DATE',
        'shipping_order_date' => 'SHIPPING_ORDER_DATE',
        'shippingorder.shipping_order_date' => 'SHIPPING_ORDER_DATE',
        'SoStatus' => 'SO_STATUS',
        'Shippingorder.SoStatus' => 'SO_STATUS',
        'soStatus' => 'SO_STATUS',
        'shippingorder.soStatus' => 'SO_STATUS',
        'ShippingorderTableMap::COL_SO_STATUS' => 'SO_STATUS',
        'COL_SO_STATUS' => 'SO_STATUS',
        'so_status' => 'SO_STATUS',
        'shippingorder.so_status' => 'SO_STATUS',
        'UserId' => 'USER_ID',
        'Shippingorder.UserId' => 'USER_ID',
        'userId' => 'USER_ID',
        'shippingorder.userId' => 'USER_ID',
        'ShippingorderTableMap::COL_USER_ID' => 'USER_ID',
        'COL_USER_ID' => 'USER_ID',
        'user_id' => 'USER_ID',
        'shippingorder.user_id' => 'USER_ID',
        'CompanyId' => 'COMPANY_ID',
        'Shippingorder.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'shippingorder.companyId' => 'COMPANY_ID',
        'ShippingorderTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'shippingorder.company_id' => 'COMPANY_ID',
        'InvoiceNumber' => 'INVOICE_NUMBER',
        'Shippingorder.InvoiceNumber' => 'INVOICE_NUMBER',
        'invoiceNumber' => 'INVOICE_NUMBER',
        'shippingorder.invoiceNumber' => 'INVOICE_NUMBER',
        'ShippingorderTableMap::COL_INVOICE_NUMBER' => 'INVOICE_NUMBER',
        'COL_INVOICE_NUMBER' => 'INVOICE_NUMBER',
        'invoice_number' => 'INVOICE_NUMBER',
        'shippingorder.invoice_number' => 'INVOICE_NUMBER',
        'ShippingMode' => 'SHIPPING_MODE',
        'Shippingorder.ShippingMode' => 'SHIPPING_MODE',
        'shippingMode' => 'SHIPPING_MODE',
        'shippingorder.shippingMode' => 'SHIPPING_MODE',
        'ShippingorderTableMap::COL_SHIPPING_MODE' => 'SHIPPING_MODE',
        'COL_SHIPPING_MODE' => 'SHIPPING_MODE',
        'shipping_mode' => 'SHIPPING_MODE',
        'shippingorder.shipping_mode' => 'SHIPPING_MODE',
        'ShippingPartner' => 'SHIPPING_PARTNER',
        'Shippingorder.ShippingPartner' => 'SHIPPING_PARTNER',
        'shippingPartner' => 'SHIPPING_PARTNER',
        'shippingorder.shippingPartner' => 'SHIPPING_PARTNER',
        'ShippingorderTableMap::COL_SHIPPING_PARTNER' => 'SHIPPING_PARTNER',
        'COL_SHIPPING_PARTNER' => 'SHIPPING_PARTNER',
        'shipping_partner' => 'SHIPPING_PARTNER',
        'shippingorder.shipping_partner' => 'SHIPPING_PARTNER',
        'TrackingNumber' => 'TRACKING_NUMBER',
        'Shippingorder.TrackingNumber' => 'TRACKING_NUMBER',
        'trackingNumber' => 'TRACKING_NUMBER',
        'shippingorder.trackingNumber' => 'TRACKING_NUMBER',
        'ShippingorderTableMap::COL_TRACKING_NUMBER' => 'TRACKING_NUMBER',
        'COL_TRACKING_NUMBER' => 'TRACKING_NUMBER',
        'tracking_number' => 'TRACKING_NUMBER',
        'shippingorder.tracking_number' => 'TRACKING_NUMBER',
        'InvoiceAmount' => 'INVOICE_AMOUNT',
        'Shippingorder.InvoiceAmount' => 'INVOICE_AMOUNT',
        'invoiceAmount' => 'INVOICE_AMOUNT',
        'shippingorder.invoiceAmount' => 'INVOICE_AMOUNT',
        'ShippingorderTableMap::COL_INVOICE_AMOUNT' => 'INVOICE_AMOUNT',
        'COL_INVOICE_AMOUNT' => 'INVOICE_AMOUNT',
        'invoice_amount' => 'INVOICE_AMOUNT',
        'shippingorder.invoice_amount' => 'INVOICE_AMOUNT',
        'InvoiceFile' => 'INVOICE_FILE',
        'Shippingorder.InvoiceFile' => 'INVOICE_FILE',
        'invoiceFile' => 'INVOICE_FILE',
        'shippingorder.invoiceFile' => 'INVOICE_FILE',
        'ShippingorderTableMap::COL_INVOICE_FILE' => 'INVOICE_FILE',
        'COL_INVOICE_FILE' => 'INVOICE_FILE',
        'invoice_file' => 'INVOICE_FILE',
        'shippingorder.invoice_file' => 'INVOICE_FILE',
        'CreatedDate' => 'CREATED_DATE',
        'Shippingorder.CreatedDate' => 'CREATED_DATE',
        'createdDate' => 'CREATED_DATE',
        'shippingorder.createdDate' => 'CREATED_DATE',
        'ShippingorderTableMap::COL_CREATED_DATE' => 'CREATED_DATE',
        'COL_CREATED_DATE' => 'CREATED_DATE',
        'created_date' => 'CREATED_DATE',
        'shippingorder.created_date' => 'CREATED_DATE',
        'BilledbyOutlet' => 'BILLEDBY_OUTLET',
        'Shippingorder.BilledbyOutlet' => 'BILLEDBY_OUTLET',
        'billedbyOutlet' => 'BILLEDBY_OUTLET',
        'shippingorder.billedbyOutlet' => 'BILLEDBY_OUTLET',
        'ShippingorderTableMap::COL_BILLEDBY_OUTLET' => 'BILLEDBY_OUTLET',
        'COL_BILLEDBY_OUTLET' => 'BILLEDBY_OUTLET',
        'billedby_outlet' => 'BILLEDBY_OUTLET',
        'shippingorder.billedby_outlet' => 'BILLEDBY_OUTLET',
        'BilledtoOutlet' => 'BILLEDTO_OUTLET',
        'Shippingorder.BilledtoOutlet' => 'BILLEDTO_OUTLET',
        'billedtoOutlet' => 'BILLEDTO_OUTLET',
        'shippingorder.billedtoOutlet' => 'BILLEDTO_OUTLET',
        'ShippingorderTableMap::COL_BILLEDTO_OUTLET' => 'BILLEDTO_OUTLET',
        'COL_BILLEDTO_OUTLET' => 'BILLEDTO_OUTLET',
        'billedto_outlet' => 'BILLEDTO_OUTLET',
        'shippingorder.billedto_outlet' => 'BILLEDTO_OUTLET',
        'SvId' => 'SV_ID',
        'Shippingorder.SvId' => 'SV_ID',
        'svId' => 'SV_ID',
        'shippingorder.svId' => 'SV_ID',
        'ShippingorderTableMap::COL_SV_ID' => 'SV_ID',
        'COL_SV_ID' => 'SV_ID',
        'sv_id' => 'SV_ID',
        'shippingorder.sv_id' => 'SV_ID',
        'PaymentMode' => 'PAYMENT_MODE',
        'Shippingorder.PaymentMode' => 'PAYMENT_MODE',
        'paymentMode' => 'PAYMENT_MODE',
        'shippingorder.paymentMode' => 'PAYMENT_MODE',
        'ShippingorderTableMap::COL_PAYMENT_MODE' => 'PAYMENT_MODE',
        'COL_PAYMENT_MODE' => 'PAYMENT_MODE',
        'payment_mode' => 'PAYMENT_MODE',
        'shippingorder.payment_mode' => 'PAYMENT_MODE',
        'PaymentRemark' => 'PAYMENT_REMARK',
        'Shippingorder.PaymentRemark' => 'PAYMENT_REMARK',
        'paymentRemark' => 'PAYMENT_REMARK',
        'shippingorder.paymentRemark' => 'PAYMENT_REMARK',
        'ShippingorderTableMap::COL_PAYMENT_REMARK' => 'PAYMENT_REMARK',
        'COL_PAYMENT_REMARK' => 'PAYMENT_REMARK',
        'payment_remark' => 'PAYMENT_REMARK',
        'shippingorder.payment_remark' => 'PAYMENT_REMARK',
        'PaymentStatus' => 'PAYMENT_STATUS',
        'Shippingorder.PaymentStatus' => 'PAYMENT_STATUS',
        'paymentStatus' => 'PAYMENT_STATUS',
        'shippingorder.paymentStatus' => 'PAYMENT_STATUS',
        'ShippingorderTableMap::COL_PAYMENT_STATUS' => 'PAYMENT_STATUS',
        'COL_PAYMENT_STATUS' => 'PAYMENT_STATUS',
        'payment_status' => 'PAYMENT_STATUS',
        'shippingorder.payment_status' => 'PAYMENT_STATUS',
        'IntegrationId' => 'INTEGRATION_ID',
        'Shippingorder.IntegrationId' => 'INTEGRATION_ID',
        'integrationId' => 'INTEGRATION_ID',
        'shippingorder.integrationId' => 'INTEGRATION_ID',
        'ShippingorderTableMap::COL_INTEGRATION_ID' => 'INTEGRATION_ID',
        'COL_INTEGRATION_ID' => 'INTEGRATION_ID',
        'integration_id' => 'INTEGRATION_ID',
        'shippingorder.integration_id' => 'INTEGRATION_ID',
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
        $this->setName('shippingorder');
        $this->setPhpName('Shippingorder');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\Shippingorder');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('shippingorder_soid_seq');
        // columns
        $this->addPrimaryKey('soid', 'Soid', 'BIGINT', true, null, null);
        $this->addForeignKey('order_id', 'OrderId', 'BIGINT', 'orders', 'order_id', true, null, null);
        $this->addColumn('so_number', 'SoNumber', 'VARCHAR', true, 50, '');
        $this->addColumn('shipping_order_date', 'ShippingOrderDate', 'DATE', true, null, null);
        $this->addColumn('so_status', 'SoStatus', 'VARCHAR', true, 50, null);
        $this->addForeignKey('user_id', 'UserId', 'INTEGER', 'users', 'user_id', true, null, 0);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', true, null, 0);
        $this->addColumn('invoice_number', 'InvoiceNumber', 'VARCHAR', true, 50, '0');
        $this->addColumn('shipping_mode', 'ShippingMode', 'VARCHAR', true, 50, '0');
        $this->addColumn('shipping_partner', 'ShippingPartner', 'VARCHAR', true, 50, '0');
        $this->addColumn('tracking_number', 'TrackingNumber', 'VARCHAR', true, 50, '0');
        $this->addColumn('invoice_amount', 'InvoiceAmount', 'DECIMAL', true, 20, 0.00);
        $this->addColumn('invoice_file', 'InvoiceFile', 'VARCHAR', true, 200, '0');
        $this->addColumn('created_date', 'CreatedDate', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('billedby_outlet', 'BilledbyOutlet', 'INTEGER', true, null, 0);
        $this->addColumn('billedto_outlet', 'BilledtoOutlet', 'INTEGER', true, null, 0);
        $this->addForeignKey('sv_id', 'SvId', 'BIGINT', 'stock_voucher', 'svid', false, null, 0);
        $this->addColumn('payment_mode', 'PaymentMode', 'VARCHAR', false, 50, null);
        $this->addColumn('payment_remark', 'PaymentRemark', 'VARCHAR', false, 50, null);
        $this->addColumn('payment_status', 'PaymentStatus', 'VARCHAR', false, 50, 'DUE');
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
        $this->addRelation('Orders', '\\entities\\Orders', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':order_id',
    1 => ':order_id',
  ),
), null, null, null, false);
        $this->addRelation('StockVoucher', '\\entities\\StockVoucher', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':sv_id',
    1 => ':svid',
  ),
), null, null, null, false);
        $this->addRelation('Users', '\\entities\\Users', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':user_id',
    1 => ':user_id',
  ),
), null, null, null, false);
        $this->addRelation('Shippinglines', '\\entities\\Shippinglines', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':soid',
    1 => ':soid',
  ),
), null, null, 'Shippingliness', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Soid', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Soid', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Soid', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Soid', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Soid', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Soid', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('Soid', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? ShippingorderTableMap::CLASS_DEFAULT : ShippingorderTableMap::OM_CLASS;
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
     * @return array (Shippingorder object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = ShippingorderTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ShippingorderTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ShippingorderTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ShippingorderTableMap::OM_CLASS;
            /** @var Shippingorder $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ShippingorderTableMap::addInstanceToPool($obj, $key);
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
            $key = ShippingorderTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ShippingorderTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Shippingorder $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ShippingorderTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(ShippingorderTableMap::COL_SOID);
            $criteria->addSelectColumn(ShippingorderTableMap::COL_ORDER_ID);
            $criteria->addSelectColumn(ShippingorderTableMap::COL_SO_NUMBER);
            $criteria->addSelectColumn(ShippingorderTableMap::COL_SHIPPING_ORDER_DATE);
            $criteria->addSelectColumn(ShippingorderTableMap::COL_SO_STATUS);
            $criteria->addSelectColumn(ShippingorderTableMap::COL_USER_ID);
            $criteria->addSelectColumn(ShippingorderTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(ShippingorderTableMap::COL_INVOICE_NUMBER);
            $criteria->addSelectColumn(ShippingorderTableMap::COL_SHIPPING_MODE);
            $criteria->addSelectColumn(ShippingorderTableMap::COL_SHIPPING_PARTNER);
            $criteria->addSelectColumn(ShippingorderTableMap::COL_TRACKING_NUMBER);
            $criteria->addSelectColumn(ShippingorderTableMap::COL_INVOICE_AMOUNT);
            $criteria->addSelectColumn(ShippingorderTableMap::COL_INVOICE_FILE);
            $criteria->addSelectColumn(ShippingorderTableMap::COL_CREATED_DATE);
            $criteria->addSelectColumn(ShippingorderTableMap::COL_BILLEDBY_OUTLET);
            $criteria->addSelectColumn(ShippingorderTableMap::COL_BILLEDTO_OUTLET);
            $criteria->addSelectColumn(ShippingorderTableMap::COL_SV_ID);
            $criteria->addSelectColumn(ShippingorderTableMap::COL_PAYMENT_MODE);
            $criteria->addSelectColumn(ShippingorderTableMap::COL_PAYMENT_REMARK);
            $criteria->addSelectColumn(ShippingorderTableMap::COL_PAYMENT_STATUS);
            $criteria->addSelectColumn(ShippingorderTableMap::COL_INTEGRATION_ID);
        } else {
            $criteria->addSelectColumn($alias . '.soid');
            $criteria->addSelectColumn($alias . '.order_id');
            $criteria->addSelectColumn($alias . '.so_number');
            $criteria->addSelectColumn($alias . '.shipping_order_date');
            $criteria->addSelectColumn($alias . '.so_status');
            $criteria->addSelectColumn($alias . '.user_id');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.invoice_number');
            $criteria->addSelectColumn($alias . '.shipping_mode');
            $criteria->addSelectColumn($alias . '.shipping_partner');
            $criteria->addSelectColumn($alias . '.tracking_number');
            $criteria->addSelectColumn($alias . '.invoice_amount');
            $criteria->addSelectColumn($alias . '.invoice_file');
            $criteria->addSelectColumn($alias . '.created_date');
            $criteria->addSelectColumn($alias . '.billedby_outlet');
            $criteria->addSelectColumn($alias . '.billedto_outlet');
            $criteria->addSelectColumn($alias . '.sv_id');
            $criteria->addSelectColumn($alias . '.payment_mode');
            $criteria->addSelectColumn($alias . '.payment_remark');
            $criteria->addSelectColumn($alias . '.payment_status');
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
            $criteria->removeSelectColumn(ShippingorderTableMap::COL_SOID);
            $criteria->removeSelectColumn(ShippingorderTableMap::COL_ORDER_ID);
            $criteria->removeSelectColumn(ShippingorderTableMap::COL_SO_NUMBER);
            $criteria->removeSelectColumn(ShippingorderTableMap::COL_SHIPPING_ORDER_DATE);
            $criteria->removeSelectColumn(ShippingorderTableMap::COL_SO_STATUS);
            $criteria->removeSelectColumn(ShippingorderTableMap::COL_USER_ID);
            $criteria->removeSelectColumn(ShippingorderTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(ShippingorderTableMap::COL_INVOICE_NUMBER);
            $criteria->removeSelectColumn(ShippingorderTableMap::COL_SHIPPING_MODE);
            $criteria->removeSelectColumn(ShippingorderTableMap::COL_SHIPPING_PARTNER);
            $criteria->removeSelectColumn(ShippingorderTableMap::COL_TRACKING_NUMBER);
            $criteria->removeSelectColumn(ShippingorderTableMap::COL_INVOICE_AMOUNT);
            $criteria->removeSelectColumn(ShippingorderTableMap::COL_INVOICE_FILE);
            $criteria->removeSelectColumn(ShippingorderTableMap::COL_CREATED_DATE);
            $criteria->removeSelectColumn(ShippingorderTableMap::COL_BILLEDBY_OUTLET);
            $criteria->removeSelectColumn(ShippingorderTableMap::COL_BILLEDTO_OUTLET);
            $criteria->removeSelectColumn(ShippingorderTableMap::COL_SV_ID);
            $criteria->removeSelectColumn(ShippingorderTableMap::COL_PAYMENT_MODE);
            $criteria->removeSelectColumn(ShippingorderTableMap::COL_PAYMENT_REMARK);
            $criteria->removeSelectColumn(ShippingorderTableMap::COL_PAYMENT_STATUS);
            $criteria->removeSelectColumn(ShippingorderTableMap::COL_INTEGRATION_ID);
        } else {
            $criteria->removeSelectColumn($alias . '.soid');
            $criteria->removeSelectColumn($alias . '.order_id');
            $criteria->removeSelectColumn($alias . '.so_number');
            $criteria->removeSelectColumn($alias . '.shipping_order_date');
            $criteria->removeSelectColumn($alias . '.so_status');
            $criteria->removeSelectColumn($alias . '.user_id');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.invoice_number');
            $criteria->removeSelectColumn($alias . '.shipping_mode');
            $criteria->removeSelectColumn($alias . '.shipping_partner');
            $criteria->removeSelectColumn($alias . '.tracking_number');
            $criteria->removeSelectColumn($alias . '.invoice_amount');
            $criteria->removeSelectColumn($alias . '.invoice_file');
            $criteria->removeSelectColumn($alias . '.created_date');
            $criteria->removeSelectColumn($alias . '.billedby_outlet');
            $criteria->removeSelectColumn($alias . '.billedto_outlet');
            $criteria->removeSelectColumn($alias . '.sv_id');
            $criteria->removeSelectColumn($alias . '.payment_mode');
            $criteria->removeSelectColumn($alias . '.payment_remark');
            $criteria->removeSelectColumn($alias . '.payment_status');
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
        return Propel::getServiceContainer()->getDatabaseMap(ShippingorderTableMap::DATABASE_NAME)->getTable(ShippingorderTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Shippingorder or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or Shippingorder object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(ShippingorderTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\Shippingorder) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ShippingorderTableMap::DATABASE_NAME);
            $criteria->add(ShippingorderTableMap::COL_SOID, (array) $values, Criteria::IN);
        }

        $query = ShippingorderQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ShippingorderTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ShippingorderTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the shippingorder table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return ShippingorderQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Shippingorder or Criteria object.
     *
     * @param mixed $criteria Criteria or Shippingorder object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ShippingorderTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Shippingorder object
        }

        if ($criteria->containsKey(ShippingorderTableMap::COL_SOID) && $criteria->keyContainsValue(ShippingorderTableMap::COL_SOID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.ShippingorderTableMap::COL_SOID.')');
        }


        // Set the correct dbName
        $query = ShippingorderQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
