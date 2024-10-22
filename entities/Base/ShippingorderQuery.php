<?php

namespace entities\Base;

use \Exception;
use \PDO;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;
use entities\Shippingorder as ChildShippingorder;
use entities\ShippingorderQuery as ChildShippingorderQuery;
use entities\Map\ShippingorderTableMap;

/**
 * Base class that represents a query for the `shippingorder` table.
 *
 * @method     ChildShippingorderQuery orderBySoid($order = Criteria::ASC) Order by the soid column
 * @method     ChildShippingorderQuery orderByOrderId($order = Criteria::ASC) Order by the order_id column
 * @method     ChildShippingorderQuery orderBySoNumber($order = Criteria::ASC) Order by the so_number column
 * @method     ChildShippingorderQuery orderByShippingOrderDate($order = Criteria::ASC) Order by the shipping_order_date column
 * @method     ChildShippingorderQuery orderBySoStatus($order = Criteria::ASC) Order by the so_status column
 * @method     ChildShippingorderQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 * @method     ChildShippingorderQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildShippingorderQuery orderByInvoiceNumber($order = Criteria::ASC) Order by the invoice_number column
 * @method     ChildShippingorderQuery orderByShippingMode($order = Criteria::ASC) Order by the shipping_mode column
 * @method     ChildShippingorderQuery orderByShippingPartner($order = Criteria::ASC) Order by the shipping_partner column
 * @method     ChildShippingorderQuery orderByTrackingNumber($order = Criteria::ASC) Order by the tracking_number column
 * @method     ChildShippingorderQuery orderByInvoiceAmount($order = Criteria::ASC) Order by the invoice_amount column
 * @method     ChildShippingorderQuery orderByInvoiceFile($order = Criteria::ASC) Order by the invoice_file column
 * @method     ChildShippingorderQuery orderByCreatedDate($order = Criteria::ASC) Order by the created_date column
 * @method     ChildShippingorderQuery orderByBilledbyOutlet($order = Criteria::ASC) Order by the billedby_outlet column
 * @method     ChildShippingorderQuery orderByBilledtoOutlet($order = Criteria::ASC) Order by the billedto_outlet column
 * @method     ChildShippingorderQuery orderBySvId($order = Criteria::ASC) Order by the sv_id column
 * @method     ChildShippingorderQuery orderByPaymentMode($order = Criteria::ASC) Order by the payment_mode column
 * @method     ChildShippingorderQuery orderByPaymentRemark($order = Criteria::ASC) Order by the payment_remark column
 * @method     ChildShippingorderQuery orderByPaymentStatus($order = Criteria::ASC) Order by the payment_status column
 * @method     ChildShippingorderQuery orderByIntegrationId($order = Criteria::ASC) Order by the integration_id column
 *
 * @method     ChildShippingorderQuery groupBySoid() Group by the soid column
 * @method     ChildShippingorderQuery groupByOrderId() Group by the order_id column
 * @method     ChildShippingorderQuery groupBySoNumber() Group by the so_number column
 * @method     ChildShippingorderQuery groupByShippingOrderDate() Group by the shipping_order_date column
 * @method     ChildShippingorderQuery groupBySoStatus() Group by the so_status column
 * @method     ChildShippingorderQuery groupByUserId() Group by the user_id column
 * @method     ChildShippingorderQuery groupByCompanyId() Group by the company_id column
 * @method     ChildShippingorderQuery groupByInvoiceNumber() Group by the invoice_number column
 * @method     ChildShippingorderQuery groupByShippingMode() Group by the shipping_mode column
 * @method     ChildShippingorderQuery groupByShippingPartner() Group by the shipping_partner column
 * @method     ChildShippingorderQuery groupByTrackingNumber() Group by the tracking_number column
 * @method     ChildShippingorderQuery groupByInvoiceAmount() Group by the invoice_amount column
 * @method     ChildShippingorderQuery groupByInvoiceFile() Group by the invoice_file column
 * @method     ChildShippingorderQuery groupByCreatedDate() Group by the created_date column
 * @method     ChildShippingorderQuery groupByBilledbyOutlet() Group by the billedby_outlet column
 * @method     ChildShippingorderQuery groupByBilledtoOutlet() Group by the billedto_outlet column
 * @method     ChildShippingorderQuery groupBySvId() Group by the sv_id column
 * @method     ChildShippingorderQuery groupByPaymentMode() Group by the payment_mode column
 * @method     ChildShippingorderQuery groupByPaymentRemark() Group by the payment_remark column
 * @method     ChildShippingorderQuery groupByPaymentStatus() Group by the payment_status column
 * @method     ChildShippingorderQuery groupByIntegrationId() Group by the integration_id column
 *
 * @method     ChildShippingorderQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildShippingorderQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildShippingorderQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildShippingorderQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildShippingorderQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildShippingorderQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildShippingorderQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildShippingorderQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildShippingorderQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildShippingorderQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildShippingorderQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildShippingorderQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildShippingorderQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     ChildShippingorderQuery leftJoinOrders($relationAlias = null) Adds a LEFT JOIN clause to the query using the Orders relation
 * @method     ChildShippingorderQuery rightJoinOrders($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Orders relation
 * @method     ChildShippingorderQuery innerJoinOrders($relationAlias = null) Adds a INNER JOIN clause to the query using the Orders relation
 *
 * @method     ChildShippingorderQuery joinWithOrders($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Orders relation
 *
 * @method     ChildShippingorderQuery leftJoinWithOrders() Adds a LEFT JOIN clause and with to the query using the Orders relation
 * @method     ChildShippingorderQuery rightJoinWithOrders() Adds a RIGHT JOIN clause and with to the query using the Orders relation
 * @method     ChildShippingorderQuery innerJoinWithOrders() Adds a INNER JOIN clause and with to the query using the Orders relation
 *
 * @method     ChildShippingorderQuery leftJoinStockVoucher($relationAlias = null) Adds a LEFT JOIN clause to the query using the StockVoucher relation
 * @method     ChildShippingorderQuery rightJoinStockVoucher($relationAlias = null) Adds a RIGHT JOIN clause to the query using the StockVoucher relation
 * @method     ChildShippingorderQuery innerJoinStockVoucher($relationAlias = null) Adds a INNER JOIN clause to the query using the StockVoucher relation
 *
 * @method     ChildShippingorderQuery joinWithStockVoucher($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the StockVoucher relation
 *
 * @method     ChildShippingorderQuery leftJoinWithStockVoucher() Adds a LEFT JOIN clause and with to the query using the StockVoucher relation
 * @method     ChildShippingorderQuery rightJoinWithStockVoucher() Adds a RIGHT JOIN clause and with to the query using the StockVoucher relation
 * @method     ChildShippingorderQuery innerJoinWithStockVoucher() Adds a INNER JOIN clause and with to the query using the StockVoucher relation
 *
 * @method     ChildShippingorderQuery leftJoinUsers($relationAlias = null) Adds a LEFT JOIN clause to the query using the Users relation
 * @method     ChildShippingorderQuery rightJoinUsers($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Users relation
 * @method     ChildShippingorderQuery innerJoinUsers($relationAlias = null) Adds a INNER JOIN clause to the query using the Users relation
 *
 * @method     ChildShippingorderQuery joinWithUsers($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Users relation
 *
 * @method     ChildShippingorderQuery leftJoinWithUsers() Adds a LEFT JOIN clause and with to the query using the Users relation
 * @method     ChildShippingorderQuery rightJoinWithUsers() Adds a RIGHT JOIN clause and with to the query using the Users relation
 * @method     ChildShippingorderQuery innerJoinWithUsers() Adds a INNER JOIN clause and with to the query using the Users relation
 *
 * @method     ChildShippingorderQuery leftJoinShippinglines($relationAlias = null) Adds a LEFT JOIN clause to the query using the Shippinglines relation
 * @method     ChildShippingorderQuery rightJoinShippinglines($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Shippinglines relation
 * @method     ChildShippingorderQuery innerJoinShippinglines($relationAlias = null) Adds a INNER JOIN clause to the query using the Shippinglines relation
 *
 * @method     ChildShippingorderQuery joinWithShippinglines($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Shippinglines relation
 *
 * @method     ChildShippingorderQuery leftJoinWithShippinglines() Adds a LEFT JOIN clause and with to the query using the Shippinglines relation
 * @method     ChildShippingorderQuery rightJoinWithShippinglines() Adds a RIGHT JOIN clause and with to the query using the Shippinglines relation
 * @method     ChildShippingorderQuery innerJoinWithShippinglines() Adds a INNER JOIN clause and with to the query using the Shippinglines relation
 *
 * @method     \entities\CompanyQuery|\entities\OrdersQuery|\entities\StockVoucherQuery|\entities\UsersQuery|\entities\ShippinglinesQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildShippingorder|null findOne(?ConnectionInterface $con = null) Return the first ChildShippingorder matching the query
 * @method     ChildShippingorder findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildShippingorder matching the query, or a new ChildShippingorder object populated from the query conditions when no match is found
 *
 * @method     ChildShippingorder|null findOneBySoid(string $soid) Return the first ChildShippingorder filtered by the soid column
 * @method     ChildShippingorder|null findOneByOrderId(string $order_id) Return the first ChildShippingorder filtered by the order_id column
 * @method     ChildShippingorder|null findOneBySoNumber(string $so_number) Return the first ChildShippingorder filtered by the so_number column
 * @method     ChildShippingorder|null findOneByShippingOrderDate(string $shipping_order_date) Return the first ChildShippingorder filtered by the shipping_order_date column
 * @method     ChildShippingorder|null findOneBySoStatus(string $so_status) Return the first ChildShippingorder filtered by the so_status column
 * @method     ChildShippingorder|null findOneByUserId(int $user_id) Return the first ChildShippingorder filtered by the user_id column
 * @method     ChildShippingorder|null findOneByCompanyId(int $company_id) Return the first ChildShippingorder filtered by the company_id column
 * @method     ChildShippingorder|null findOneByInvoiceNumber(string $invoice_number) Return the first ChildShippingorder filtered by the invoice_number column
 * @method     ChildShippingorder|null findOneByShippingMode(string $shipping_mode) Return the first ChildShippingorder filtered by the shipping_mode column
 * @method     ChildShippingorder|null findOneByShippingPartner(string $shipping_partner) Return the first ChildShippingorder filtered by the shipping_partner column
 * @method     ChildShippingorder|null findOneByTrackingNumber(string $tracking_number) Return the first ChildShippingorder filtered by the tracking_number column
 * @method     ChildShippingorder|null findOneByInvoiceAmount(string $invoice_amount) Return the first ChildShippingorder filtered by the invoice_amount column
 * @method     ChildShippingorder|null findOneByInvoiceFile(string $invoice_file) Return the first ChildShippingorder filtered by the invoice_file column
 * @method     ChildShippingorder|null findOneByCreatedDate(string $created_date) Return the first ChildShippingorder filtered by the created_date column
 * @method     ChildShippingorder|null findOneByBilledbyOutlet(int $billedby_outlet) Return the first ChildShippingorder filtered by the billedby_outlet column
 * @method     ChildShippingorder|null findOneByBilledtoOutlet(int $billedto_outlet) Return the first ChildShippingorder filtered by the billedto_outlet column
 * @method     ChildShippingorder|null findOneBySvId(string $sv_id) Return the first ChildShippingorder filtered by the sv_id column
 * @method     ChildShippingorder|null findOneByPaymentMode(string $payment_mode) Return the first ChildShippingorder filtered by the payment_mode column
 * @method     ChildShippingorder|null findOneByPaymentRemark(string $payment_remark) Return the first ChildShippingorder filtered by the payment_remark column
 * @method     ChildShippingorder|null findOneByPaymentStatus(string $payment_status) Return the first ChildShippingorder filtered by the payment_status column
 * @method     ChildShippingorder|null findOneByIntegrationId(string $integration_id) Return the first ChildShippingorder filtered by the integration_id column
 *
 * @method     ChildShippingorder requirePk($key, ?ConnectionInterface $con = null) Return the ChildShippingorder by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShippingorder requireOne(?ConnectionInterface $con = null) Return the first ChildShippingorder matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildShippingorder requireOneBySoid(string $soid) Return the first ChildShippingorder filtered by the soid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShippingorder requireOneByOrderId(string $order_id) Return the first ChildShippingorder filtered by the order_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShippingorder requireOneBySoNumber(string $so_number) Return the first ChildShippingorder filtered by the so_number column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShippingorder requireOneByShippingOrderDate(string $shipping_order_date) Return the first ChildShippingorder filtered by the shipping_order_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShippingorder requireOneBySoStatus(string $so_status) Return the first ChildShippingorder filtered by the so_status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShippingorder requireOneByUserId(int $user_id) Return the first ChildShippingorder filtered by the user_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShippingorder requireOneByCompanyId(int $company_id) Return the first ChildShippingorder filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShippingorder requireOneByInvoiceNumber(string $invoice_number) Return the first ChildShippingorder filtered by the invoice_number column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShippingorder requireOneByShippingMode(string $shipping_mode) Return the first ChildShippingorder filtered by the shipping_mode column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShippingorder requireOneByShippingPartner(string $shipping_partner) Return the first ChildShippingorder filtered by the shipping_partner column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShippingorder requireOneByTrackingNumber(string $tracking_number) Return the first ChildShippingorder filtered by the tracking_number column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShippingorder requireOneByInvoiceAmount(string $invoice_amount) Return the first ChildShippingorder filtered by the invoice_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShippingorder requireOneByInvoiceFile(string $invoice_file) Return the first ChildShippingorder filtered by the invoice_file column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShippingorder requireOneByCreatedDate(string $created_date) Return the first ChildShippingorder filtered by the created_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShippingorder requireOneByBilledbyOutlet(int $billedby_outlet) Return the first ChildShippingorder filtered by the billedby_outlet column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShippingorder requireOneByBilledtoOutlet(int $billedto_outlet) Return the first ChildShippingorder filtered by the billedto_outlet column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShippingorder requireOneBySvId(string $sv_id) Return the first ChildShippingorder filtered by the sv_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShippingorder requireOneByPaymentMode(string $payment_mode) Return the first ChildShippingorder filtered by the payment_mode column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShippingorder requireOneByPaymentRemark(string $payment_remark) Return the first ChildShippingorder filtered by the payment_remark column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShippingorder requireOneByPaymentStatus(string $payment_status) Return the first ChildShippingorder filtered by the payment_status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShippingorder requireOneByIntegrationId(string $integration_id) Return the first ChildShippingorder filtered by the integration_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildShippingorder[]|Collection find(?ConnectionInterface $con = null) Return ChildShippingorder objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildShippingorder> find(?ConnectionInterface $con = null) Return ChildShippingorder objects based on current ModelCriteria
 *
 * @method     ChildShippingorder[]|Collection findBySoid(string|array<string> $soid) Return ChildShippingorder objects filtered by the soid column
 * @psalm-method Collection&\Traversable<ChildShippingorder> findBySoid(string|array<string> $soid) Return ChildShippingorder objects filtered by the soid column
 * @method     ChildShippingorder[]|Collection findByOrderId(string|array<string> $order_id) Return ChildShippingorder objects filtered by the order_id column
 * @psalm-method Collection&\Traversable<ChildShippingorder> findByOrderId(string|array<string> $order_id) Return ChildShippingorder objects filtered by the order_id column
 * @method     ChildShippingorder[]|Collection findBySoNumber(string|array<string> $so_number) Return ChildShippingorder objects filtered by the so_number column
 * @psalm-method Collection&\Traversable<ChildShippingorder> findBySoNumber(string|array<string> $so_number) Return ChildShippingorder objects filtered by the so_number column
 * @method     ChildShippingorder[]|Collection findByShippingOrderDate(string|array<string> $shipping_order_date) Return ChildShippingorder objects filtered by the shipping_order_date column
 * @psalm-method Collection&\Traversable<ChildShippingorder> findByShippingOrderDate(string|array<string> $shipping_order_date) Return ChildShippingorder objects filtered by the shipping_order_date column
 * @method     ChildShippingorder[]|Collection findBySoStatus(string|array<string> $so_status) Return ChildShippingorder objects filtered by the so_status column
 * @psalm-method Collection&\Traversable<ChildShippingorder> findBySoStatus(string|array<string> $so_status) Return ChildShippingorder objects filtered by the so_status column
 * @method     ChildShippingorder[]|Collection findByUserId(int|array<int> $user_id) Return ChildShippingorder objects filtered by the user_id column
 * @psalm-method Collection&\Traversable<ChildShippingorder> findByUserId(int|array<int> $user_id) Return ChildShippingorder objects filtered by the user_id column
 * @method     ChildShippingorder[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildShippingorder objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildShippingorder> findByCompanyId(int|array<int> $company_id) Return ChildShippingorder objects filtered by the company_id column
 * @method     ChildShippingorder[]|Collection findByInvoiceNumber(string|array<string> $invoice_number) Return ChildShippingorder objects filtered by the invoice_number column
 * @psalm-method Collection&\Traversable<ChildShippingorder> findByInvoiceNumber(string|array<string> $invoice_number) Return ChildShippingorder objects filtered by the invoice_number column
 * @method     ChildShippingorder[]|Collection findByShippingMode(string|array<string> $shipping_mode) Return ChildShippingorder objects filtered by the shipping_mode column
 * @psalm-method Collection&\Traversable<ChildShippingorder> findByShippingMode(string|array<string> $shipping_mode) Return ChildShippingorder objects filtered by the shipping_mode column
 * @method     ChildShippingorder[]|Collection findByShippingPartner(string|array<string> $shipping_partner) Return ChildShippingorder objects filtered by the shipping_partner column
 * @psalm-method Collection&\Traversable<ChildShippingorder> findByShippingPartner(string|array<string> $shipping_partner) Return ChildShippingorder objects filtered by the shipping_partner column
 * @method     ChildShippingorder[]|Collection findByTrackingNumber(string|array<string> $tracking_number) Return ChildShippingorder objects filtered by the tracking_number column
 * @psalm-method Collection&\Traversable<ChildShippingorder> findByTrackingNumber(string|array<string> $tracking_number) Return ChildShippingorder objects filtered by the tracking_number column
 * @method     ChildShippingorder[]|Collection findByInvoiceAmount(string|array<string> $invoice_amount) Return ChildShippingorder objects filtered by the invoice_amount column
 * @psalm-method Collection&\Traversable<ChildShippingorder> findByInvoiceAmount(string|array<string> $invoice_amount) Return ChildShippingorder objects filtered by the invoice_amount column
 * @method     ChildShippingorder[]|Collection findByInvoiceFile(string|array<string> $invoice_file) Return ChildShippingorder objects filtered by the invoice_file column
 * @psalm-method Collection&\Traversable<ChildShippingorder> findByInvoiceFile(string|array<string> $invoice_file) Return ChildShippingorder objects filtered by the invoice_file column
 * @method     ChildShippingorder[]|Collection findByCreatedDate(string|array<string> $created_date) Return ChildShippingorder objects filtered by the created_date column
 * @psalm-method Collection&\Traversable<ChildShippingorder> findByCreatedDate(string|array<string> $created_date) Return ChildShippingorder objects filtered by the created_date column
 * @method     ChildShippingorder[]|Collection findByBilledbyOutlet(int|array<int> $billedby_outlet) Return ChildShippingorder objects filtered by the billedby_outlet column
 * @psalm-method Collection&\Traversable<ChildShippingorder> findByBilledbyOutlet(int|array<int> $billedby_outlet) Return ChildShippingorder objects filtered by the billedby_outlet column
 * @method     ChildShippingorder[]|Collection findByBilledtoOutlet(int|array<int> $billedto_outlet) Return ChildShippingorder objects filtered by the billedto_outlet column
 * @psalm-method Collection&\Traversable<ChildShippingorder> findByBilledtoOutlet(int|array<int> $billedto_outlet) Return ChildShippingorder objects filtered by the billedto_outlet column
 * @method     ChildShippingorder[]|Collection findBySvId(string|array<string> $sv_id) Return ChildShippingorder objects filtered by the sv_id column
 * @psalm-method Collection&\Traversable<ChildShippingorder> findBySvId(string|array<string> $sv_id) Return ChildShippingorder objects filtered by the sv_id column
 * @method     ChildShippingorder[]|Collection findByPaymentMode(string|array<string> $payment_mode) Return ChildShippingorder objects filtered by the payment_mode column
 * @psalm-method Collection&\Traversable<ChildShippingorder> findByPaymentMode(string|array<string> $payment_mode) Return ChildShippingorder objects filtered by the payment_mode column
 * @method     ChildShippingorder[]|Collection findByPaymentRemark(string|array<string> $payment_remark) Return ChildShippingorder objects filtered by the payment_remark column
 * @psalm-method Collection&\Traversable<ChildShippingorder> findByPaymentRemark(string|array<string> $payment_remark) Return ChildShippingorder objects filtered by the payment_remark column
 * @method     ChildShippingorder[]|Collection findByPaymentStatus(string|array<string> $payment_status) Return ChildShippingorder objects filtered by the payment_status column
 * @psalm-method Collection&\Traversable<ChildShippingorder> findByPaymentStatus(string|array<string> $payment_status) Return ChildShippingorder objects filtered by the payment_status column
 * @method     ChildShippingorder[]|Collection findByIntegrationId(string|array<string> $integration_id) Return ChildShippingorder objects filtered by the integration_id column
 * @psalm-method Collection&\Traversable<ChildShippingorder> findByIntegrationId(string|array<string> $integration_id) Return ChildShippingorder objects filtered by the integration_id column
 *
 * @method     ChildShippingorder[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildShippingorder> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class ShippingorderQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\ShippingorderQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\Shippingorder', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildShippingorderQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildShippingorderQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildShippingorderQuery) {
            return $criteria;
        }
        $query = new ChildShippingorderQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildShippingorder|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ShippingorderTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ShippingorderTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildShippingorder A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT soid, order_id, so_number, shipping_order_date, so_status, user_id, company_id, invoice_number, shipping_mode, shipping_partner, tracking_number, invoice_amount, invoice_file, created_date, billedby_outlet, billedto_outlet, sv_id, payment_mode, payment_remark, payment_status, integration_id FROM shippingorder WHERE soid = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildShippingorder $obj */
            $obj = new ChildShippingorder();
            $obj->hydrate($row);
            ShippingorderTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con A connection object
     *
     * @return ChildShippingorder|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param array $keys Primary keys to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return Collection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param mixed $key Primary key to use for the query
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        $this->addUsingAlias(ShippingorderTableMap::COL_SOID, $key, Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param array|int $keys The list of primary key to use for the query
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        $this->addUsingAlias(ShippingorderTableMap::COL_SOID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the soid column
     *
     * Example usage:
     * <code>
     * $query->filterBySoid(1234); // WHERE soid = 1234
     * $query->filterBySoid(array(12, 34)); // WHERE soid IN (12, 34)
     * $query->filterBySoid(array('min' => 12)); // WHERE soid > 12
     * </code>
     *
     * @param mixed $soid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySoid($soid = null, ?string $comparison = null)
    {
        if (is_array($soid)) {
            $useMinMax = false;
            if (isset($soid['min'])) {
                $this->addUsingAlias(ShippingorderTableMap::COL_SOID, $soid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($soid['max'])) {
                $this->addUsingAlias(ShippingorderTableMap::COL_SOID, $soid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ShippingorderTableMap::COL_SOID, $soid, $comparison);

        return $this;
    }

    /**
     * Filter the query on the order_id column
     *
     * Example usage:
     * <code>
     * $query->filterByOrderId(1234); // WHERE order_id = 1234
     * $query->filterByOrderId(array(12, 34)); // WHERE order_id IN (12, 34)
     * $query->filterByOrderId(array('min' => 12)); // WHERE order_id > 12
     * </code>
     *
     * @see       filterByOrders()
     *
     * @param mixed $orderId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrderId($orderId = null, ?string $comparison = null)
    {
        if (is_array($orderId)) {
            $useMinMax = false;
            if (isset($orderId['min'])) {
                $this->addUsingAlias(ShippingorderTableMap::COL_ORDER_ID, $orderId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($orderId['max'])) {
                $this->addUsingAlias(ShippingorderTableMap::COL_ORDER_ID, $orderId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ShippingorderTableMap::COL_ORDER_ID, $orderId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the so_number column
     *
     * Example usage:
     * <code>
     * $query->filterBySoNumber('fooValue');   // WHERE so_number = 'fooValue'
     * $query->filterBySoNumber('%fooValue%', Criteria::LIKE); // WHERE so_number LIKE '%fooValue%'
     * $query->filterBySoNumber(['foo', 'bar']); // WHERE so_number IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $soNumber The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySoNumber($soNumber = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($soNumber)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ShippingorderTableMap::COL_SO_NUMBER, $soNumber, $comparison);

        return $this;
    }

    /**
     * Filter the query on the shipping_order_date column
     *
     * Example usage:
     * <code>
     * $query->filterByShippingOrderDate('2011-03-14'); // WHERE shipping_order_date = '2011-03-14'
     * $query->filterByShippingOrderDate('now'); // WHERE shipping_order_date = '2011-03-14'
     * $query->filterByShippingOrderDate(array('max' => 'yesterday')); // WHERE shipping_order_date > '2011-03-13'
     * </code>
     *
     * @param mixed $shippingOrderDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByShippingOrderDate($shippingOrderDate = null, ?string $comparison = null)
    {
        if (is_array($shippingOrderDate)) {
            $useMinMax = false;
            if (isset($shippingOrderDate['min'])) {
                $this->addUsingAlias(ShippingorderTableMap::COL_SHIPPING_ORDER_DATE, $shippingOrderDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($shippingOrderDate['max'])) {
                $this->addUsingAlias(ShippingorderTableMap::COL_SHIPPING_ORDER_DATE, $shippingOrderDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ShippingorderTableMap::COL_SHIPPING_ORDER_DATE, $shippingOrderDate, $comparison);

        return $this;
    }

    /**
     * Filter the query on the so_status column
     *
     * Example usage:
     * <code>
     * $query->filterBySoStatus('fooValue');   // WHERE so_status = 'fooValue'
     * $query->filterBySoStatus('%fooValue%', Criteria::LIKE); // WHERE so_status LIKE '%fooValue%'
     * $query->filterBySoStatus(['foo', 'bar']); // WHERE so_status IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $soStatus The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySoStatus($soStatus = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($soStatus)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ShippingorderTableMap::COL_SO_STATUS, $soStatus, $comparison);

        return $this;
    }

    /**
     * Filter the query on the user_id column
     *
     * Example usage:
     * <code>
     * $query->filterByUserId(1234); // WHERE user_id = 1234
     * $query->filterByUserId(array(12, 34)); // WHERE user_id IN (12, 34)
     * $query->filterByUserId(array('min' => 12)); // WHERE user_id > 12
     * </code>
     *
     * @see       filterByUsers()
     *
     * @param mixed $userId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUserId($userId = null, ?string $comparison = null)
    {
        if (is_array($userId)) {
            $useMinMax = false;
            if (isset($userId['min'])) {
                $this->addUsingAlias(ShippingorderTableMap::COL_USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userId['max'])) {
                $this->addUsingAlias(ShippingorderTableMap::COL_USER_ID, $userId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ShippingorderTableMap::COL_USER_ID, $userId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the company_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCompanyId(1234); // WHERE company_id = 1234
     * $query->filterByCompanyId(array(12, 34)); // WHERE company_id IN (12, 34)
     * $query->filterByCompanyId(array('min' => 12)); // WHERE company_id > 12
     * </code>
     *
     * @see       filterByCompany()
     *
     * @param mixed $companyId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCompanyId($companyId = null, ?string $comparison = null)
    {
        if (is_array($companyId)) {
            $useMinMax = false;
            if (isset($companyId['min'])) {
                $this->addUsingAlias(ShippingorderTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(ShippingorderTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ShippingorderTableMap::COL_COMPANY_ID, $companyId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the invoice_number column
     *
     * Example usage:
     * <code>
     * $query->filterByInvoiceNumber('fooValue');   // WHERE invoice_number = 'fooValue'
     * $query->filterByInvoiceNumber('%fooValue%', Criteria::LIKE); // WHERE invoice_number LIKE '%fooValue%'
     * $query->filterByInvoiceNumber(['foo', 'bar']); // WHERE invoice_number IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $invoiceNumber The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByInvoiceNumber($invoiceNumber = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($invoiceNumber)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ShippingorderTableMap::COL_INVOICE_NUMBER, $invoiceNumber, $comparison);

        return $this;
    }

    /**
     * Filter the query on the shipping_mode column
     *
     * Example usage:
     * <code>
     * $query->filterByShippingMode('fooValue');   // WHERE shipping_mode = 'fooValue'
     * $query->filterByShippingMode('%fooValue%', Criteria::LIKE); // WHERE shipping_mode LIKE '%fooValue%'
     * $query->filterByShippingMode(['foo', 'bar']); // WHERE shipping_mode IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $shippingMode The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByShippingMode($shippingMode = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($shippingMode)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ShippingorderTableMap::COL_SHIPPING_MODE, $shippingMode, $comparison);

        return $this;
    }

    /**
     * Filter the query on the shipping_partner column
     *
     * Example usage:
     * <code>
     * $query->filterByShippingPartner('fooValue');   // WHERE shipping_partner = 'fooValue'
     * $query->filterByShippingPartner('%fooValue%', Criteria::LIKE); // WHERE shipping_partner LIKE '%fooValue%'
     * $query->filterByShippingPartner(['foo', 'bar']); // WHERE shipping_partner IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $shippingPartner The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByShippingPartner($shippingPartner = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($shippingPartner)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ShippingorderTableMap::COL_SHIPPING_PARTNER, $shippingPartner, $comparison);

        return $this;
    }

    /**
     * Filter the query on the tracking_number column
     *
     * Example usage:
     * <code>
     * $query->filterByTrackingNumber('fooValue');   // WHERE tracking_number = 'fooValue'
     * $query->filterByTrackingNumber('%fooValue%', Criteria::LIKE); // WHERE tracking_number LIKE '%fooValue%'
     * $query->filterByTrackingNumber(['foo', 'bar']); // WHERE tracking_number IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $trackingNumber The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTrackingNumber($trackingNumber = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($trackingNumber)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ShippingorderTableMap::COL_TRACKING_NUMBER, $trackingNumber, $comparison);

        return $this;
    }

    /**
     * Filter the query on the invoice_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByInvoiceAmount(1234); // WHERE invoice_amount = 1234
     * $query->filterByInvoiceAmount(array(12, 34)); // WHERE invoice_amount IN (12, 34)
     * $query->filterByInvoiceAmount(array('min' => 12)); // WHERE invoice_amount > 12
     * </code>
     *
     * @param mixed $invoiceAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByInvoiceAmount($invoiceAmount = null, ?string $comparison = null)
    {
        if (is_array($invoiceAmount)) {
            $useMinMax = false;
            if (isset($invoiceAmount['min'])) {
                $this->addUsingAlias(ShippingorderTableMap::COL_INVOICE_AMOUNT, $invoiceAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($invoiceAmount['max'])) {
                $this->addUsingAlias(ShippingorderTableMap::COL_INVOICE_AMOUNT, $invoiceAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ShippingorderTableMap::COL_INVOICE_AMOUNT, $invoiceAmount, $comparison);

        return $this;
    }

    /**
     * Filter the query on the invoice_file column
     *
     * Example usage:
     * <code>
     * $query->filterByInvoiceFile('fooValue');   // WHERE invoice_file = 'fooValue'
     * $query->filterByInvoiceFile('%fooValue%', Criteria::LIKE); // WHERE invoice_file LIKE '%fooValue%'
     * $query->filterByInvoiceFile(['foo', 'bar']); // WHERE invoice_file IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $invoiceFile The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByInvoiceFile($invoiceFile = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($invoiceFile)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ShippingorderTableMap::COL_INVOICE_FILE, $invoiceFile, $comparison);

        return $this;
    }

    /**
     * Filter the query on the created_date column
     *
     * Example usage:
     * <code>
     * $query->filterByCreatedDate('2011-03-14'); // WHERE created_date = '2011-03-14'
     * $query->filterByCreatedDate('now'); // WHERE created_date = '2011-03-14'
     * $query->filterByCreatedDate(array('max' => 'yesterday')); // WHERE created_date > '2011-03-13'
     * </code>
     *
     * @param mixed $createdDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCreatedDate($createdDate = null, ?string $comparison = null)
    {
        if (is_array($createdDate)) {
            $useMinMax = false;
            if (isset($createdDate['min'])) {
                $this->addUsingAlias(ShippingorderTableMap::COL_CREATED_DATE, $createdDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdDate['max'])) {
                $this->addUsingAlias(ShippingorderTableMap::COL_CREATED_DATE, $createdDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ShippingorderTableMap::COL_CREATED_DATE, $createdDate, $comparison);

        return $this;
    }

    /**
     * Filter the query on the billedby_outlet column
     *
     * Example usage:
     * <code>
     * $query->filterByBilledbyOutlet(1234); // WHERE billedby_outlet = 1234
     * $query->filterByBilledbyOutlet(array(12, 34)); // WHERE billedby_outlet IN (12, 34)
     * $query->filterByBilledbyOutlet(array('min' => 12)); // WHERE billedby_outlet > 12
     * </code>
     *
     * @param mixed $billedbyOutlet The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBilledbyOutlet($billedbyOutlet = null, ?string $comparison = null)
    {
        if (is_array($billedbyOutlet)) {
            $useMinMax = false;
            if (isset($billedbyOutlet['min'])) {
                $this->addUsingAlias(ShippingorderTableMap::COL_BILLEDBY_OUTLET, $billedbyOutlet['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($billedbyOutlet['max'])) {
                $this->addUsingAlias(ShippingorderTableMap::COL_BILLEDBY_OUTLET, $billedbyOutlet['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ShippingorderTableMap::COL_BILLEDBY_OUTLET, $billedbyOutlet, $comparison);

        return $this;
    }

    /**
     * Filter the query on the billedto_outlet column
     *
     * Example usage:
     * <code>
     * $query->filterByBilledtoOutlet(1234); // WHERE billedto_outlet = 1234
     * $query->filterByBilledtoOutlet(array(12, 34)); // WHERE billedto_outlet IN (12, 34)
     * $query->filterByBilledtoOutlet(array('min' => 12)); // WHERE billedto_outlet > 12
     * </code>
     *
     * @param mixed $billedtoOutlet The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBilledtoOutlet($billedtoOutlet = null, ?string $comparison = null)
    {
        if (is_array($billedtoOutlet)) {
            $useMinMax = false;
            if (isset($billedtoOutlet['min'])) {
                $this->addUsingAlias(ShippingorderTableMap::COL_BILLEDTO_OUTLET, $billedtoOutlet['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($billedtoOutlet['max'])) {
                $this->addUsingAlias(ShippingorderTableMap::COL_BILLEDTO_OUTLET, $billedtoOutlet['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ShippingorderTableMap::COL_BILLEDTO_OUTLET, $billedtoOutlet, $comparison);

        return $this;
    }

    /**
     * Filter the query on the sv_id column
     *
     * Example usage:
     * <code>
     * $query->filterBySvId(1234); // WHERE sv_id = 1234
     * $query->filterBySvId(array(12, 34)); // WHERE sv_id IN (12, 34)
     * $query->filterBySvId(array('min' => 12)); // WHERE sv_id > 12
     * </code>
     *
     * @see       filterByStockVoucher()
     *
     * @param mixed $svId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySvId($svId = null, ?string $comparison = null)
    {
        if (is_array($svId)) {
            $useMinMax = false;
            if (isset($svId['min'])) {
                $this->addUsingAlias(ShippingorderTableMap::COL_SV_ID, $svId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($svId['max'])) {
                $this->addUsingAlias(ShippingorderTableMap::COL_SV_ID, $svId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ShippingorderTableMap::COL_SV_ID, $svId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the payment_mode column
     *
     * Example usage:
     * <code>
     * $query->filterByPaymentMode('fooValue');   // WHERE payment_mode = 'fooValue'
     * $query->filterByPaymentMode('%fooValue%', Criteria::LIKE); // WHERE payment_mode LIKE '%fooValue%'
     * $query->filterByPaymentMode(['foo', 'bar']); // WHERE payment_mode IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $paymentMode The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPaymentMode($paymentMode = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($paymentMode)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ShippingorderTableMap::COL_PAYMENT_MODE, $paymentMode, $comparison);

        return $this;
    }

    /**
     * Filter the query on the payment_remark column
     *
     * Example usage:
     * <code>
     * $query->filterByPaymentRemark('fooValue');   // WHERE payment_remark = 'fooValue'
     * $query->filterByPaymentRemark('%fooValue%', Criteria::LIKE); // WHERE payment_remark LIKE '%fooValue%'
     * $query->filterByPaymentRemark(['foo', 'bar']); // WHERE payment_remark IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $paymentRemark The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPaymentRemark($paymentRemark = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($paymentRemark)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ShippingorderTableMap::COL_PAYMENT_REMARK, $paymentRemark, $comparison);

        return $this;
    }

    /**
     * Filter the query on the payment_status column
     *
     * Example usage:
     * <code>
     * $query->filterByPaymentStatus('fooValue');   // WHERE payment_status = 'fooValue'
     * $query->filterByPaymentStatus('%fooValue%', Criteria::LIKE); // WHERE payment_status LIKE '%fooValue%'
     * $query->filterByPaymentStatus(['foo', 'bar']); // WHERE payment_status IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $paymentStatus The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPaymentStatus($paymentStatus = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($paymentStatus)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ShippingorderTableMap::COL_PAYMENT_STATUS, $paymentStatus, $comparison);

        return $this;
    }

    /**
     * Filter the query on the integration_id column
     *
     * Example usage:
     * <code>
     * $query->filterByIntegrationId('fooValue');   // WHERE integration_id = 'fooValue'
     * $query->filterByIntegrationId('%fooValue%', Criteria::LIKE); // WHERE integration_id LIKE '%fooValue%'
     * $query->filterByIntegrationId(['foo', 'bar']); // WHERE integration_id IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $integrationId The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIntegrationId($integrationId = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($integrationId)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ShippingorderTableMap::COL_INTEGRATION_ID, $integrationId, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \entities\Company object
     *
     * @param \entities\Company|ObjectCollection $company The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCompany($company, ?string $comparison = null)
    {
        if ($company instanceof \entities\Company) {
            return $this
                ->addUsingAlias(ShippingorderTableMap::COL_COMPANY_ID, $company->getCompanyId(), $comparison);
        } elseif ($company instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(ShippingorderTableMap::COL_COMPANY_ID, $company->toKeyValue('PrimaryKey', 'CompanyId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByCompany() only accepts arguments of type \entities\Company or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Company relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinCompany(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Company');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Company');
        }

        return $this;
    }

    /**
     * Use the Company relation Company object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\CompanyQuery A secondary query class using the current class as primary query
     */
    public function useCompanyQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCompany($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Company', '\entities\CompanyQuery');
    }

    /**
     * Use the Company relation Company object
     *
     * @param callable(\entities\CompanyQuery):\entities\CompanyQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withCompanyQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useCompanyQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Company table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\CompanyQuery The inner query object of the EXISTS statement
     */
    public function useCompanyExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\CompanyQuery */
        $q = $this->useExistsQuery('Company', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Company table for a NOT EXISTS query.
     *
     * @see useCompanyExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\CompanyQuery The inner query object of the NOT EXISTS statement
     */
    public function useCompanyNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\CompanyQuery */
        $q = $this->useExistsQuery('Company', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Company table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\CompanyQuery The inner query object of the IN statement
     */
    public function useInCompanyQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\CompanyQuery */
        $q = $this->useInQuery('Company', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Company table for a NOT IN query.
     *
     * @see useCompanyInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\CompanyQuery The inner query object of the NOT IN statement
     */
    public function useNotInCompanyQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\CompanyQuery */
        $q = $this->useInQuery('Company', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\Orders object
     *
     * @param \entities\Orders|ObjectCollection $orders The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrders($orders, ?string $comparison = null)
    {
        if ($orders instanceof \entities\Orders) {
            return $this
                ->addUsingAlias(ShippingorderTableMap::COL_ORDER_ID, $orders->getOrderId(), $comparison);
        } elseif ($orders instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(ShippingorderTableMap::COL_ORDER_ID, $orders->toKeyValue('PrimaryKey', 'OrderId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByOrders() only accepts arguments of type \entities\Orders or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Orders relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOrders(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Orders');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Orders');
        }

        return $this;
    }

    /**
     * Use the Orders relation Orders object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\OrdersQuery A secondary query class using the current class as primary query
     */
    public function useOrdersQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinOrders($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Orders', '\entities\OrdersQuery');
    }

    /**
     * Use the Orders relation Orders object
     *
     * @param callable(\entities\OrdersQuery):\entities\OrdersQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOrdersQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useOrdersQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Orders table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\OrdersQuery The inner query object of the EXISTS statement
     */
    public function useOrdersExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\OrdersQuery */
        $q = $this->useExistsQuery('Orders', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Orders table for a NOT EXISTS query.
     *
     * @see useOrdersExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\OrdersQuery The inner query object of the NOT EXISTS statement
     */
    public function useOrdersNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OrdersQuery */
        $q = $this->useExistsQuery('Orders', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Orders table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\OrdersQuery The inner query object of the IN statement
     */
    public function useInOrdersQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\OrdersQuery */
        $q = $this->useInQuery('Orders', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Orders table for a NOT IN query.
     *
     * @see useOrdersInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\OrdersQuery The inner query object of the NOT IN statement
     */
    public function useNotInOrdersQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OrdersQuery */
        $q = $this->useInQuery('Orders', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\StockVoucher object
     *
     * @param \entities\StockVoucher|ObjectCollection $stockVoucher The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStockVoucher($stockVoucher, ?string $comparison = null)
    {
        if ($stockVoucher instanceof \entities\StockVoucher) {
            return $this
                ->addUsingAlias(ShippingorderTableMap::COL_SV_ID, $stockVoucher->getSvid(), $comparison);
        } elseif ($stockVoucher instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(ShippingorderTableMap::COL_SV_ID, $stockVoucher->toKeyValue('PrimaryKey', 'Svid'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByStockVoucher() only accepts arguments of type \entities\StockVoucher or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the StockVoucher relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinStockVoucher(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('StockVoucher');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'StockVoucher');
        }

        return $this;
    }

    /**
     * Use the StockVoucher relation StockVoucher object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\StockVoucherQuery A secondary query class using the current class as primary query
     */
    public function useStockVoucherQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinStockVoucher($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'StockVoucher', '\entities\StockVoucherQuery');
    }

    /**
     * Use the StockVoucher relation StockVoucher object
     *
     * @param callable(\entities\StockVoucherQuery):\entities\StockVoucherQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withStockVoucherQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useStockVoucherQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to StockVoucher table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\StockVoucherQuery The inner query object of the EXISTS statement
     */
    public function useStockVoucherExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\StockVoucherQuery */
        $q = $this->useExistsQuery('StockVoucher', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to StockVoucher table for a NOT EXISTS query.
     *
     * @see useStockVoucherExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\StockVoucherQuery The inner query object of the NOT EXISTS statement
     */
    public function useStockVoucherNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\StockVoucherQuery */
        $q = $this->useExistsQuery('StockVoucher', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to StockVoucher table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\StockVoucherQuery The inner query object of the IN statement
     */
    public function useInStockVoucherQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\StockVoucherQuery */
        $q = $this->useInQuery('StockVoucher', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to StockVoucher table for a NOT IN query.
     *
     * @see useStockVoucherInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\StockVoucherQuery The inner query object of the NOT IN statement
     */
    public function useNotInStockVoucherQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\StockVoucherQuery */
        $q = $this->useInQuery('StockVoucher', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\Users object
     *
     * @param \entities\Users|ObjectCollection $users The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUsers($users, ?string $comparison = null)
    {
        if ($users instanceof \entities\Users) {
            return $this
                ->addUsingAlias(ShippingorderTableMap::COL_USER_ID, $users->getUserId(), $comparison);
        } elseif ($users instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(ShippingorderTableMap::COL_USER_ID, $users->toKeyValue('PrimaryKey', 'UserId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByUsers() only accepts arguments of type \entities\Users or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Users relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinUsers(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Users');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Users');
        }

        return $this;
    }

    /**
     * Use the Users relation Users object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\UsersQuery A secondary query class using the current class as primary query
     */
    public function useUsersQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUsers($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Users', '\entities\UsersQuery');
    }

    /**
     * Use the Users relation Users object
     *
     * @param callable(\entities\UsersQuery):\entities\UsersQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withUsersQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useUsersQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Users table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\UsersQuery The inner query object of the EXISTS statement
     */
    public function useUsersExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\UsersQuery */
        $q = $this->useExistsQuery('Users', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Users table for a NOT EXISTS query.
     *
     * @see useUsersExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\UsersQuery The inner query object of the NOT EXISTS statement
     */
    public function useUsersNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\UsersQuery */
        $q = $this->useExistsQuery('Users', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Users table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\UsersQuery The inner query object of the IN statement
     */
    public function useInUsersQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\UsersQuery */
        $q = $this->useInQuery('Users', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Users table for a NOT IN query.
     *
     * @see useUsersInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\UsersQuery The inner query object of the NOT IN statement
     */
    public function useNotInUsersQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\UsersQuery */
        $q = $this->useInQuery('Users', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\Shippinglines object
     *
     * @param \entities\Shippinglines|ObjectCollection $shippinglines the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByShippinglines($shippinglines, ?string $comparison = null)
    {
        if ($shippinglines instanceof \entities\Shippinglines) {
            $this
                ->addUsingAlias(ShippingorderTableMap::COL_SOID, $shippinglines->getSoid(), $comparison);

            return $this;
        } elseif ($shippinglines instanceof ObjectCollection) {
            $this
                ->useShippinglinesQuery()
                ->filterByPrimaryKeys($shippinglines->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByShippinglines() only accepts arguments of type \entities\Shippinglines or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Shippinglines relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinShippinglines(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Shippinglines');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Shippinglines');
        }

        return $this;
    }

    /**
     * Use the Shippinglines relation Shippinglines object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\ShippinglinesQuery A secondary query class using the current class as primary query
     */
    public function useShippinglinesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinShippinglines($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Shippinglines', '\entities\ShippinglinesQuery');
    }

    /**
     * Use the Shippinglines relation Shippinglines object
     *
     * @param callable(\entities\ShippinglinesQuery):\entities\ShippinglinesQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withShippinglinesQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useShippinglinesQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Shippinglines table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\ShippinglinesQuery The inner query object of the EXISTS statement
     */
    public function useShippinglinesExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\ShippinglinesQuery */
        $q = $this->useExistsQuery('Shippinglines', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Shippinglines table for a NOT EXISTS query.
     *
     * @see useShippinglinesExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\ShippinglinesQuery The inner query object of the NOT EXISTS statement
     */
    public function useShippinglinesNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\ShippinglinesQuery */
        $q = $this->useExistsQuery('Shippinglines', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Shippinglines table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\ShippinglinesQuery The inner query object of the IN statement
     */
    public function useInShippinglinesQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\ShippinglinesQuery */
        $q = $this->useInQuery('Shippinglines', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Shippinglines table for a NOT IN query.
     *
     * @see useShippinglinesInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\ShippinglinesQuery The inner query object of the NOT IN statement
     */
    public function useNotInShippinglinesQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\ShippinglinesQuery */
        $q = $this->useInQuery('Shippinglines', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildShippingorder $shippingorder Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($shippingorder = null)
    {
        if ($shippingorder) {
            $this->addUsingAlias(ShippingorderTableMap::COL_SOID, $shippingorder->getSoid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the shippingorder table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ShippingorderTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ShippingorderTableMap::clearInstancePool();
            ShippingorderTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ShippingorderTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ShippingorderTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ShippingorderTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ShippingorderTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
