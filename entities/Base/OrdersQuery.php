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
use entities\Orders as ChildOrders;
use entities\OrdersQuery as ChildOrdersQuery;
use entities\Map\OrdersTableMap;

/**
 * Base class that represents a query for the `orders` table.
 *
 * @method     ChildOrdersQuery orderByOrderId($order = Criteria::ASC) Order by the order_id column
 * @method     ChildOrdersQuery orderByOrderNumber($order = Criteria::ASC) Order by the order_number column
 * @method     ChildOrdersQuery orderByOrderType($order = Criteria::ASC) Order by the order_type column
 * @method     ChildOrdersQuery orderByOutletFrom($order = Criteria::ASC) Order by the outlet_from column
 * @method     ChildOrdersQuery orderByOutletTo($order = Criteria::ASC) Order by the outlet_to column
 * @method     ChildOrdersQuery orderByPricebookId($order = Criteria::ASC) Order by the pricebook_id column
 * @method     ChildOrdersQuery orderByOrderDate($order = Criteria::ASC) Order by the order_date column
 * @method     ChildOrdersQuery orderByOrderSubtotal($order = Criteria::ASC) Order by the order_subtotal column
 * @method     ChildOrdersQuery orderByOrderDiscount($order = Criteria::ASC) Order by the order_discount column
 * @method     ChildOrdersQuery orderByOrderTotal($order = Criteria::ASC) Order by the order_total column
 * @method     ChildOrdersQuery orderByOrderQty($order = Criteria::ASC) Order by the order_qty column
 * @method     ChildOrdersQuery orderByEmployeeId($order = Criteria::ASC) Order by the employee_id column
 * @method     ChildOrdersQuery orderByBookingDate($order = Criteria::ASC) Order by the booking_date column
 * @method     ChildOrdersQuery orderByTerritoryId($order = Criteria::ASC) Order by the territory_id column
 * @method     ChildOrdersQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildOrdersQuery orderByOrderStatus($order = Criteria::ASC) Order by the order_status column
 * @method     ChildOrdersQuery orderByOrderRerference($order = Criteria::ASC) Order by the order_rerference column
 * @method     ChildOrdersQuery orderByOrderRemark($order = Criteria::ASC) Order by the order_remark column
 * @method     ChildOrdersQuery orderByOtpReqId($order = Criteria::ASC) Order by the otp_req_id column
 * @method     ChildOrdersQuery orderByBeatId($order = Criteria::ASC) Order by the beat_id column
 * @method     ChildOrdersQuery orderByIntegrationId($order = Criteria::ASC) Order by the integration_id column
 *
 * @method     ChildOrdersQuery groupByOrderId() Group by the order_id column
 * @method     ChildOrdersQuery groupByOrderNumber() Group by the order_number column
 * @method     ChildOrdersQuery groupByOrderType() Group by the order_type column
 * @method     ChildOrdersQuery groupByOutletFrom() Group by the outlet_from column
 * @method     ChildOrdersQuery groupByOutletTo() Group by the outlet_to column
 * @method     ChildOrdersQuery groupByPricebookId() Group by the pricebook_id column
 * @method     ChildOrdersQuery groupByOrderDate() Group by the order_date column
 * @method     ChildOrdersQuery groupByOrderSubtotal() Group by the order_subtotal column
 * @method     ChildOrdersQuery groupByOrderDiscount() Group by the order_discount column
 * @method     ChildOrdersQuery groupByOrderTotal() Group by the order_total column
 * @method     ChildOrdersQuery groupByOrderQty() Group by the order_qty column
 * @method     ChildOrdersQuery groupByEmployeeId() Group by the employee_id column
 * @method     ChildOrdersQuery groupByBookingDate() Group by the booking_date column
 * @method     ChildOrdersQuery groupByTerritoryId() Group by the territory_id column
 * @method     ChildOrdersQuery groupByCompanyId() Group by the company_id column
 * @method     ChildOrdersQuery groupByOrderStatus() Group by the order_status column
 * @method     ChildOrdersQuery groupByOrderRerference() Group by the order_rerference column
 * @method     ChildOrdersQuery groupByOrderRemark() Group by the order_remark column
 * @method     ChildOrdersQuery groupByOtpReqId() Group by the otp_req_id column
 * @method     ChildOrdersQuery groupByBeatId() Group by the beat_id column
 * @method     ChildOrdersQuery groupByIntegrationId() Group by the integration_id column
 *
 * @method     ChildOrdersQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildOrdersQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildOrdersQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildOrdersQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildOrdersQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildOrdersQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildOrdersQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildOrdersQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildOrdersQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildOrdersQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildOrdersQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildOrdersQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildOrdersQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     ChildOrdersQuery leftJoinEmployee($relationAlias = null) Adds a LEFT JOIN clause to the query using the Employee relation
 * @method     ChildOrdersQuery rightJoinEmployee($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Employee relation
 * @method     ChildOrdersQuery innerJoinEmployee($relationAlias = null) Adds a INNER JOIN clause to the query using the Employee relation
 *
 * @method     ChildOrdersQuery joinWithEmployee($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Employee relation
 *
 * @method     ChildOrdersQuery leftJoinWithEmployee() Adds a LEFT JOIN clause and with to the query using the Employee relation
 * @method     ChildOrdersQuery rightJoinWithEmployee() Adds a RIGHT JOIN clause and with to the query using the Employee relation
 * @method     ChildOrdersQuery innerJoinWithEmployee() Adds a INNER JOIN clause and with to the query using the Employee relation
 *
 * @method     ChildOrdersQuery leftJoinOutletsRelatedByOutletFrom($relationAlias = null) Adds a LEFT JOIN clause to the query using the OutletsRelatedByOutletFrom relation
 * @method     ChildOrdersQuery rightJoinOutletsRelatedByOutletFrom($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OutletsRelatedByOutletFrom relation
 * @method     ChildOrdersQuery innerJoinOutletsRelatedByOutletFrom($relationAlias = null) Adds a INNER JOIN clause to the query using the OutletsRelatedByOutletFrom relation
 *
 * @method     ChildOrdersQuery joinWithOutletsRelatedByOutletFrom($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OutletsRelatedByOutletFrom relation
 *
 * @method     ChildOrdersQuery leftJoinWithOutletsRelatedByOutletFrom() Adds a LEFT JOIN clause and with to the query using the OutletsRelatedByOutletFrom relation
 * @method     ChildOrdersQuery rightJoinWithOutletsRelatedByOutletFrom() Adds a RIGHT JOIN clause and with to the query using the OutletsRelatedByOutletFrom relation
 * @method     ChildOrdersQuery innerJoinWithOutletsRelatedByOutletFrom() Adds a INNER JOIN clause and with to the query using the OutletsRelatedByOutletFrom relation
 *
 * @method     ChildOrdersQuery leftJoinOutletsRelatedByOutletTo($relationAlias = null) Adds a LEFT JOIN clause to the query using the OutletsRelatedByOutletTo relation
 * @method     ChildOrdersQuery rightJoinOutletsRelatedByOutletTo($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OutletsRelatedByOutletTo relation
 * @method     ChildOrdersQuery innerJoinOutletsRelatedByOutletTo($relationAlias = null) Adds a INNER JOIN clause to the query using the OutletsRelatedByOutletTo relation
 *
 * @method     ChildOrdersQuery joinWithOutletsRelatedByOutletTo($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OutletsRelatedByOutletTo relation
 *
 * @method     ChildOrdersQuery leftJoinWithOutletsRelatedByOutletTo() Adds a LEFT JOIN clause and with to the query using the OutletsRelatedByOutletTo relation
 * @method     ChildOrdersQuery rightJoinWithOutletsRelatedByOutletTo() Adds a RIGHT JOIN clause and with to the query using the OutletsRelatedByOutletTo relation
 * @method     ChildOrdersQuery innerJoinWithOutletsRelatedByOutletTo() Adds a INNER JOIN clause and with to the query using the OutletsRelatedByOutletTo relation
 *
 * @method     ChildOrdersQuery leftJoinTerritories($relationAlias = null) Adds a LEFT JOIN clause to the query using the Territories relation
 * @method     ChildOrdersQuery rightJoinTerritories($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Territories relation
 * @method     ChildOrdersQuery innerJoinTerritories($relationAlias = null) Adds a INNER JOIN clause to the query using the Territories relation
 *
 * @method     ChildOrdersQuery joinWithTerritories($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Territories relation
 *
 * @method     ChildOrdersQuery leftJoinWithTerritories() Adds a LEFT JOIN clause and with to the query using the Territories relation
 * @method     ChildOrdersQuery rightJoinWithTerritories() Adds a RIGHT JOIN clause and with to the query using the Territories relation
 * @method     ChildOrdersQuery innerJoinWithTerritories() Adds a INNER JOIN clause and with to the query using the Territories relation
 *
 * @method     ChildOrdersQuery leftJoinBeats($relationAlias = null) Adds a LEFT JOIN clause to the query using the Beats relation
 * @method     ChildOrdersQuery rightJoinBeats($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Beats relation
 * @method     ChildOrdersQuery innerJoinBeats($relationAlias = null) Adds a INNER JOIN clause to the query using the Beats relation
 *
 * @method     ChildOrdersQuery joinWithBeats($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Beats relation
 *
 * @method     ChildOrdersQuery leftJoinWithBeats() Adds a LEFT JOIN clause and with to the query using the Beats relation
 * @method     ChildOrdersQuery rightJoinWithBeats() Adds a RIGHT JOIN clause and with to the query using the Beats relation
 * @method     ChildOrdersQuery innerJoinWithBeats() Adds a INNER JOIN clause and with to the query using the Beats relation
 *
 * @method     ChildOrdersQuery leftJoinPricebooks($relationAlias = null) Adds a LEFT JOIN clause to the query using the Pricebooks relation
 * @method     ChildOrdersQuery rightJoinPricebooks($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Pricebooks relation
 * @method     ChildOrdersQuery innerJoinPricebooks($relationAlias = null) Adds a INNER JOIN clause to the query using the Pricebooks relation
 *
 * @method     ChildOrdersQuery joinWithPricebooks($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Pricebooks relation
 *
 * @method     ChildOrdersQuery leftJoinWithPricebooks() Adds a LEFT JOIN clause and with to the query using the Pricebooks relation
 * @method     ChildOrdersQuery rightJoinWithPricebooks() Adds a RIGHT JOIN clause and with to the query using the Pricebooks relation
 * @method     ChildOrdersQuery innerJoinWithPricebooks() Adds a INNER JOIN clause and with to the query using the Pricebooks relation
 *
 * @method     ChildOrdersQuery leftJoinOrderLog($relationAlias = null) Adds a LEFT JOIN clause to the query using the OrderLog relation
 * @method     ChildOrdersQuery rightJoinOrderLog($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OrderLog relation
 * @method     ChildOrdersQuery innerJoinOrderLog($relationAlias = null) Adds a INNER JOIN clause to the query using the OrderLog relation
 *
 * @method     ChildOrdersQuery joinWithOrderLog($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OrderLog relation
 *
 * @method     ChildOrdersQuery leftJoinWithOrderLog() Adds a LEFT JOIN clause and with to the query using the OrderLog relation
 * @method     ChildOrdersQuery rightJoinWithOrderLog() Adds a RIGHT JOIN clause and with to the query using the OrderLog relation
 * @method     ChildOrdersQuery innerJoinWithOrderLog() Adds a INNER JOIN clause and with to the query using the OrderLog relation
 *
 * @method     ChildOrdersQuery leftJoinOrderlines($relationAlias = null) Adds a LEFT JOIN clause to the query using the Orderlines relation
 * @method     ChildOrdersQuery rightJoinOrderlines($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Orderlines relation
 * @method     ChildOrdersQuery innerJoinOrderlines($relationAlias = null) Adds a INNER JOIN clause to the query using the Orderlines relation
 *
 * @method     ChildOrdersQuery joinWithOrderlines($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Orderlines relation
 *
 * @method     ChildOrdersQuery leftJoinWithOrderlines() Adds a LEFT JOIN clause and with to the query using the Orderlines relation
 * @method     ChildOrdersQuery rightJoinWithOrderlines() Adds a RIGHT JOIN clause and with to the query using the Orderlines relation
 * @method     ChildOrdersQuery innerJoinWithOrderlines() Adds a INNER JOIN clause and with to the query using the Orderlines relation
 *
 * @method     ChildOrdersQuery leftJoinShippingorder($relationAlias = null) Adds a LEFT JOIN clause to the query using the Shippingorder relation
 * @method     ChildOrdersQuery rightJoinShippingorder($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Shippingorder relation
 * @method     ChildOrdersQuery innerJoinShippingorder($relationAlias = null) Adds a INNER JOIN clause to the query using the Shippingorder relation
 *
 * @method     ChildOrdersQuery joinWithShippingorder($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Shippingorder relation
 *
 * @method     ChildOrdersQuery leftJoinWithShippingorder() Adds a LEFT JOIN clause and with to the query using the Shippingorder relation
 * @method     ChildOrdersQuery rightJoinWithShippingorder() Adds a RIGHT JOIN clause and with to the query using the Shippingorder relation
 * @method     ChildOrdersQuery innerJoinWithShippingorder() Adds a INNER JOIN clause and with to the query using the Shippingorder relation
 *
 * @method     \entities\CompanyQuery|\entities\EmployeeQuery|\entities\OutletsQuery|\entities\OutletsQuery|\entities\TerritoriesQuery|\entities\BeatsQuery|\entities\PricebooksQuery|\entities\OrderLogQuery|\entities\OrderlinesQuery|\entities\ShippingorderQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildOrders|null findOne(?ConnectionInterface $con = null) Return the first ChildOrders matching the query
 * @method     ChildOrders findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildOrders matching the query, or a new ChildOrders object populated from the query conditions when no match is found
 *
 * @method     ChildOrders|null findOneByOrderId(string $order_id) Return the first ChildOrders filtered by the order_id column
 * @method     ChildOrders|null findOneByOrderNumber(string $order_number) Return the first ChildOrders filtered by the order_number column
 * @method     ChildOrders|null findOneByOrderType(string $order_type) Return the first ChildOrders filtered by the order_type column
 * @method     ChildOrders|null findOneByOutletFrom(int $outlet_from) Return the first ChildOrders filtered by the outlet_from column
 * @method     ChildOrders|null findOneByOutletTo(int $outlet_to) Return the first ChildOrders filtered by the outlet_to column
 * @method     ChildOrders|null findOneByPricebookId(int $pricebook_id) Return the first ChildOrders filtered by the pricebook_id column
 * @method     ChildOrders|null findOneByOrderDate(string $order_date) Return the first ChildOrders filtered by the order_date column
 * @method     ChildOrders|null findOneByOrderSubtotal(string $order_subtotal) Return the first ChildOrders filtered by the order_subtotal column
 * @method     ChildOrders|null findOneByOrderDiscount(string $order_discount) Return the first ChildOrders filtered by the order_discount column
 * @method     ChildOrders|null findOneByOrderTotal(string $order_total) Return the first ChildOrders filtered by the order_total column
 * @method     ChildOrders|null findOneByOrderQty(string $order_qty) Return the first ChildOrders filtered by the order_qty column
 * @method     ChildOrders|null findOneByEmployeeId(int $employee_id) Return the first ChildOrders filtered by the employee_id column
 * @method     ChildOrders|null findOneByBookingDate(string $booking_date) Return the first ChildOrders filtered by the booking_date column
 * @method     ChildOrders|null findOneByTerritoryId(int $territory_id) Return the first ChildOrders filtered by the territory_id column
 * @method     ChildOrders|null findOneByCompanyId(int $company_id) Return the first ChildOrders filtered by the company_id column
 * @method     ChildOrders|null findOneByOrderStatus(string $order_status) Return the first ChildOrders filtered by the order_status column
 * @method     ChildOrders|null findOneByOrderRerference(string $order_rerference) Return the first ChildOrders filtered by the order_rerference column
 * @method     ChildOrders|null findOneByOrderRemark(string $order_remark) Return the first ChildOrders filtered by the order_remark column
 * @method     ChildOrders|null findOneByOtpReqId(int $otp_req_id) Return the first ChildOrders filtered by the otp_req_id column
 * @method     ChildOrders|null findOneByBeatId(int $beat_id) Return the first ChildOrders filtered by the beat_id column
 * @method     ChildOrders|null findOneByIntegrationId(string $integration_id) Return the first ChildOrders filtered by the integration_id column
 *
 * @method     ChildOrders requirePk($key, ?ConnectionInterface $con = null) Return the ChildOrders by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrders requireOne(?ConnectionInterface $con = null) Return the first ChildOrders matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOrders requireOneByOrderId(string $order_id) Return the first ChildOrders filtered by the order_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrders requireOneByOrderNumber(string $order_number) Return the first ChildOrders filtered by the order_number column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrders requireOneByOrderType(string $order_type) Return the first ChildOrders filtered by the order_type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrders requireOneByOutletFrom(int $outlet_from) Return the first ChildOrders filtered by the outlet_from column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrders requireOneByOutletTo(int $outlet_to) Return the first ChildOrders filtered by the outlet_to column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrders requireOneByPricebookId(int $pricebook_id) Return the first ChildOrders filtered by the pricebook_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrders requireOneByOrderDate(string $order_date) Return the first ChildOrders filtered by the order_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrders requireOneByOrderSubtotal(string $order_subtotal) Return the first ChildOrders filtered by the order_subtotal column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrders requireOneByOrderDiscount(string $order_discount) Return the first ChildOrders filtered by the order_discount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrders requireOneByOrderTotal(string $order_total) Return the first ChildOrders filtered by the order_total column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrders requireOneByOrderQty(string $order_qty) Return the first ChildOrders filtered by the order_qty column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrders requireOneByEmployeeId(int $employee_id) Return the first ChildOrders filtered by the employee_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrders requireOneByBookingDate(string $booking_date) Return the first ChildOrders filtered by the booking_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrders requireOneByTerritoryId(int $territory_id) Return the first ChildOrders filtered by the territory_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrders requireOneByCompanyId(int $company_id) Return the first ChildOrders filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrders requireOneByOrderStatus(string $order_status) Return the first ChildOrders filtered by the order_status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrders requireOneByOrderRerference(string $order_rerference) Return the first ChildOrders filtered by the order_rerference column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrders requireOneByOrderRemark(string $order_remark) Return the first ChildOrders filtered by the order_remark column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrders requireOneByOtpReqId(int $otp_req_id) Return the first ChildOrders filtered by the otp_req_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrders requireOneByBeatId(int $beat_id) Return the first ChildOrders filtered by the beat_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrders requireOneByIntegrationId(string $integration_id) Return the first ChildOrders filtered by the integration_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOrders[]|Collection find(?ConnectionInterface $con = null) Return ChildOrders objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildOrders> find(?ConnectionInterface $con = null) Return ChildOrders objects based on current ModelCriteria
 *
 * @method     ChildOrders[]|Collection findByOrderId(string|array<string> $order_id) Return ChildOrders objects filtered by the order_id column
 * @psalm-method Collection&\Traversable<ChildOrders> findByOrderId(string|array<string> $order_id) Return ChildOrders objects filtered by the order_id column
 * @method     ChildOrders[]|Collection findByOrderNumber(string|array<string> $order_number) Return ChildOrders objects filtered by the order_number column
 * @psalm-method Collection&\Traversable<ChildOrders> findByOrderNumber(string|array<string> $order_number) Return ChildOrders objects filtered by the order_number column
 * @method     ChildOrders[]|Collection findByOrderType(string|array<string> $order_type) Return ChildOrders objects filtered by the order_type column
 * @psalm-method Collection&\Traversable<ChildOrders> findByOrderType(string|array<string> $order_type) Return ChildOrders objects filtered by the order_type column
 * @method     ChildOrders[]|Collection findByOutletFrom(int|array<int> $outlet_from) Return ChildOrders objects filtered by the outlet_from column
 * @psalm-method Collection&\Traversable<ChildOrders> findByOutletFrom(int|array<int> $outlet_from) Return ChildOrders objects filtered by the outlet_from column
 * @method     ChildOrders[]|Collection findByOutletTo(int|array<int> $outlet_to) Return ChildOrders objects filtered by the outlet_to column
 * @psalm-method Collection&\Traversable<ChildOrders> findByOutletTo(int|array<int> $outlet_to) Return ChildOrders objects filtered by the outlet_to column
 * @method     ChildOrders[]|Collection findByPricebookId(int|array<int> $pricebook_id) Return ChildOrders objects filtered by the pricebook_id column
 * @psalm-method Collection&\Traversable<ChildOrders> findByPricebookId(int|array<int> $pricebook_id) Return ChildOrders objects filtered by the pricebook_id column
 * @method     ChildOrders[]|Collection findByOrderDate(string|array<string> $order_date) Return ChildOrders objects filtered by the order_date column
 * @psalm-method Collection&\Traversable<ChildOrders> findByOrderDate(string|array<string> $order_date) Return ChildOrders objects filtered by the order_date column
 * @method     ChildOrders[]|Collection findByOrderSubtotal(string|array<string> $order_subtotal) Return ChildOrders objects filtered by the order_subtotal column
 * @psalm-method Collection&\Traversable<ChildOrders> findByOrderSubtotal(string|array<string> $order_subtotal) Return ChildOrders objects filtered by the order_subtotal column
 * @method     ChildOrders[]|Collection findByOrderDiscount(string|array<string> $order_discount) Return ChildOrders objects filtered by the order_discount column
 * @psalm-method Collection&\Traversable<ChildOrders> findByOrderDiscount(string|array<string> $order_discount) Return ChildOrders objects filtered by the order_discount column
 * @method     ChildOrders[]|Collection findByOrderTotal(string|array<string> $order_total) Return ChildOrders objects filtered by the order_total column
 * @psalm-method Collection&\Traversable<ChildOrders> findByOrderTotal(string|array<string> $order_total) Return ChildOrders objects filtered by the order_total column
 * @method     ChildOrders[]|Collection findByOrderQty(string|array<string> $order_qty) Return ChildOrders objects filtered by the order_qty column
 * @psalm-method Collection&\Traversable<ChildOrders> findByOrderQty(string|array<string> $order_qty) Return ChildOrders objects filtered by the order_qty column
 * @method     ChildOrders[]|Collection findByEmployeeId(int|array<int> $employee_id) Return ChildOrders objects filtered by the employee_id column
 * @psalm-method Collection&\Traversable<ChildOrders> findByEmployeeId(int|array<int> $employee_id) Return ChildOrders objects filtered by the employee_id column
 * @method     ChildOrders[]|Collection findByBookingDate(string|array<string> $booking_date) Return ChildOrders objects filtered by the booking_date column
 * @psalm-method Collection&\Traversable<ChildOrders> findByBookingDate(string|array<string> $booking_date) Return ChildOrders objects filtered by the booking_date column
 * @method     ChildOrders[]|Collection findByTerritoryId(int|array<int> $territory_id) Return ChildOrders objects filtered by the territory_id column
 * @psalm-method Collection&\Traversable<ChildOrders> findByTerritoryId(int|array<int> $territory_id) Return ChildOrders objects filtered by the territory_id column
 * @method     ChildOrders[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildOrders objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildOrders> findByCompanyId(int|array<int> $company_id) Return ChildOrders objects filtered by the company_id column
 * @method     ChildOrders[]|Collection findByOrderStatus(string|array<string> $order_status) Return ChildOrders objects filtered by the order_status column
 * @psalm-method Collection&\Traversable<ChildOrders> findByOrderStatus(string|array<string> $order_status) Return ChildOrders objects filtered by the order_status column
 * @method     ChildOrders[]|Collection findByOrderRerference(string|array<string> $order_rerference) Return ChildOrders objects filtered by the order_rerference column
 * @psalm-method Collection&\Traversable<ChildOrders> findByOrderRerference(string|array<string> $order_rerference) Return ChildOrders objects filtered by the order_rerference column
 * @method     ChildOrders[]|Collection findByOrderRemark(string|array<string> $order_remark) Return ChildOrders objects filtered by the order_remark column
 * @psalm-method Collection&\Traversable<ChildOrders> findByOrderRemark(string|array<string> $order_remark) Return ChildOrders objects filtered by the order_remark column
 * @method     ChildOrders[]|Collection findByOtpReqId(int|array<int> $otp_req_id) Return ChildOrders objects filtered by the otp_req_id column
 * @psalm-method Collection&\Traversable<ChildOrders> findByOtpReqId(int|array<int> $otp_req_id) Return ChildOrders objects filtered by the otp_req_id column
 * @method     ChildOrders[]|Collection findByBeatId(int|array<int> $beat_id) Return ChildOrders objects filtered by the beat_id column
 * @psalm-method Collection&\Traversable<ChildOrders> findByBeatId(int|array<int> $beat_id) Return ChildOrders objects filtered by the beat_id column
 * @method     ChildOrders[]|Collection findByIntegrationId(string|array<string> $integration_id) Return ChildOrders objects filtered by the integration_id column
 * @psalm-method Collection&\Traversable<ChildOrders> findByIntegrationId(string|array<string> $integration_id) Return ChildOrders objects filtered by the integration_id column
 *
 * @method     ChildOrders[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildOrders> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class OrdersQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\OrdersQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\Orders', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildOrdersQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildOrdersQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildOrdersQuery) {
            return $criteria;
        }
        $query = new ChildOrdersQuery();
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
     * @return ChildOrders|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(OrdersTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = OrdersTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildOrders A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT order_id, order_number, order_type, outlet_from, outlet_to, pricebook_id, order_date, order_subtotal, order_discount, order_total, order_qty, employee_id, booking_date, territory_id, company_id, order_status, order_rerference, order_remark, otp_req_id, beat_id, integration_id FROM orders WHERE order_id = :p0';
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
            /** @var ChildOrders $obj */
            $obj = new ChildOrders();
            $obj->hydrate($row);
            OrdersTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildOrders|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(OrdersTableMap::COL_ORDER_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(OrdersTableMap::COL_ORDER_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(OrdersTableMap::COL_ORDER_ID, $orderId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($orderId['max'])) {
                $this->addUsingAlias(OrdersTableMap::COL_ORDER_ID, $orderId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OrdersTableMap::COL_ORDER_ID, $orderId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the order_number column
     *
     * Example usage:
     * <code>
     * $query->filterByOrderNumber('fooValue');   // WHERE order_number = 'fooValue'
     * $query->filterByOrderNumber('%fooValue%', Criteria::LIKE); // WHERE order_number LIKE '%fooValue%'
     * $query->filterByOrderNumber(['foo', 'bar']); // WHERE order_number IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $orderNumber The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrderNumber($orderNumber = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($orderNumber)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OrdersTableMap::COL_ORDER_NUMBER, $orderNumber, $comparison);

        return $this;
    }

    /**
     * Filter the query on the order_type column
     *
     * Example usage:
     * <code>
     * $query->filterByOrderType('fooValue');   // WHERE order_type = 'fooValue'
     * $query->filterByOrderType('%fooValue%', Criteria::LIKE); // WHERE order_type LIKE '%fooValue%'
     * $query->filterByOrderType(['foo', 'bar']); // WHERE order_type IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $orderType The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrderType($orderType = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($orderType)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OrdersTableMap::COL_ORDER_TYPE, $orderType, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_from column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletFrom(1234); // WHERE outlet_from = 1234
     * $query->filterByOutletFrom(array(12, 34)); // WHERE outlet_from IN (12, 34)
     * $query->filterByOutletFrom(array('min' => 12)); // WHERE outlet_from > 12
     * </code>
     *
     * @see       filterByOutletsRelatedByOutletFrom()
     *
     * @param mixed $outletFrom The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletFrom($outletFrom = null, ?string $comparison = null)
    {
        if (is_array($outletFrom)) {
            $useMinMax = false;
            if (isset($outletFrom['min'])) {
                $this->addUsingAlias(OrdersTableMap::COL_OUTLET_FROM, $outletFrom['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outletFrom['max'])) {
                $this->addUsingAlias(OrdersTableMap::COL_OUTLET_FROM, $outletFrom['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OrdersTableMap::COL_OUTLET_FROM, $outletFrom, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_to column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletTo(1234); // WHERE outlet_to = 1234
     * $query->filterByOutletTo(array(12, 34)); // WHERE outlet_to IN (12, 34)
     * $query->filterByOutletTo(array('min' => 12)); // WHERE outlet_to > 12
     * </code>
     *
     * @see       filterByOutletsRelatedByOutletTo()
     *
     * @param mixed $outletTo The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletTo($outletTo = null, ?string $comparison = null)
    {
        if (is_array($outletTo)) {
            $useMinMax = false;
            if (isset($outletTo['min'])) {
                $this->addUsingAlias(OrdersTableMap::COL_OUTLET_TO, $outletTo['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outletTo['max'])) {
                $this->addUsingAlias(OrdersTableMap::COL_OUTLET_TO, $outletTo['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OrdersTableMap::COL_OUTLET_TO, $outletTo, $comparison);

        return $this;
    }

    /**
     * Filter the query on the pricebook_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPricebookId(1234); // WHERE pricebook_id = 1234
     * $query->filterByPricebookId(array(12, 34)); // WHERE pricebook_id IN (12, 34)
     * $query->filterByPricebookId(array('min' => 12)); // WHERE pricebook_id > 12
     * </code>
     *
     * @see       filterByPricebooks()
     *
     * @param mixed $pricebookId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPricebookId($pricebookId = null, ?string $comparison = null)
    {
        if (is_array($pricebookId)) {
            $useMinMax = false;
            if (isset($pricebookId['min'])) {
                $this->addUsingAlias(OrdersTableMap::COL_PRICEBOOK_ID, $pricebookId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($pricebookId['max'])) {
                $this->addUsingAlias(OrdersTableMap::COL_PRICEBOOK_ID, $pricebookId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OrdersTableMap::COL_PRICEBOOK_ID, $pricebookId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the order_date column
     *
     * Example usage:
     * <code>
     * $query->filterByOrderDate('2011-03-14'); // WHERE order_date = '2011-03-14'
     * $query->filterByOrderDate('now'); // WHERE order_date = '2011-03-14'
     * $query->filterByOrderDate(array('max' => 'yesterday')); // WHERE order_date > '2011-03-13'
     * </code>
     *
     * @param mixed $orderDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrderDate($orderDate = null, ?string $comparison = null)
    {
        if (is_array($orderDate)) {
            $useMinMax = false;
            if (isset($orderDate['min'])) {
                $this->addUsingAlias(OrdersTableMap::COL_ORDER_DATE, $orderDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($orderDate['max'])) {
                $this->addUsingAlias(OrdersTableMap::COL_ORDER_DATE, $orderDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OrdersTableMap::COL_ORDER_DATE, $orderDate, $comparison);

        return $this;
    }

    /**
     * Filter the query on the order_subtotal column
     *
     * Example usage:
     * <code>
     * $query->filterByOrderSubtotal(1234); // WHERE order_subtotal = 1234
     * $query->filterByOrderSubtotal(array(12, 34)); // WHERE order_subtotal IN (12, 34)
     * $query->filterByOrderSubtotal(array('min' => 12)); // WHERE order_subtotal > 12
     * </code>
     *
     * @param mixed $orderSubtotal The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrderSubtotal($orderSubtotal = null, ?string $comparison = null)
    {
        if (is_array($orderSubtotal)) {
            $useMinMax = false;
            if (isset($orderSubtotal['min'])) {
                $this->addUsingAlias(OrdersTableMap::COL_ORDER_SUBTOTAL, $orderSubtotal['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($orderSubtotal['max'])) {
                $this->addUsingAlias(OrdersTableMap::COL_ORDER_SUBTOTAL, $orderSubtotal['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OrdersTableMap::COL_ORDER_SUBTOTAL, $orderSubtotal, $comparison);

        return $this;
    }

    /**
     * Filter the query on the order_discount column
     *
     * Example usage:
     * <code>
     * $query->filterByOrderDiscount(1234); // WHERE order_discount = 1234
     * $query->filterByOrderDiscount(array(12, 34)); // WHERE order_discount IN (12, 34)
     * $query->filterByOrderDiscount(array('min' => 12)); // WHERE order_discount > 12
     * </code>
     *
     * @param mixed $orderDiscount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrderDiscount($orderDiscount = null, ?string $comparison = null)
    {
        if (is_array($orderDiscount)) {
            $useMinMax = false;
            if (isset($orderDiscount['min'])) {
                $this->addUsingAlias(OrdersTableMap::COL_ORDER_DISCOUNT, $orderDiscount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($orderDiscount['max'])) {
                $this->addUsingAlias(OrdersTableMap::COL_ORDER_DISCOUNT, $orderDiscount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OrdersTableMap::COL_ORDER_DISCOUNT, $orderDiscount, $comparison);

        return $this;
    }

    /**
     * Filter the query on the order_total column
     *
     * Example usage:
     * <code>
     * $query->filterByOrderTotal(1234); // WHERE order_total = 1234
     * $query->filterByOrderTotal(array(12, 34)); // WHERE order_total IN (12, 34)
     * $query->filterByOrderTotal(array('min' => 12)); // WHERE order_total > 12
     * </code>
     *
     * @param mixed $orderTotal The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrderTotal($orderTotal = null, ?string $comparison = null)
    {
        if (is_array($orderTotal)) {
            $useMinMax = false;
            if (isset($orderTotal['min'])) {
                $this->addUsingAlias(OrdersTableMap::COL_ORDER_TOTAL, $orderTotal['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($orderTotal['max'])) {
                $this->addUsingAlias(OrdersTableMap::COL_ORDER_TOTAL, $orderTotal['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OrdersTableMap::COL_ORDER_TOTAL, $orderTotal, $comparison);

        return $this;
    }

    /**
     * Filter the query on the order_qty column
     *
     * Example usage:
     * <code>
     * $query->filterByOrderQty(1234); // WHERE order_qty = 1234
     * $query->filterByOrderQty(array(12, 34)); // WHERE order_qty IN (12, 34)
     * $query->filterByOrderQty(array('min' => 12)); // WHERE order_qty > 12
     * </code>
     *
     * @param mixed $orderQty The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrderQty($orderQty = null, ?string $comparison = null)
    {
        if (is_array($orderQty)) {
            $useMinMax = false;
            if (isset($orderQty['min'])) {
                $this->addUsingAlias(OrdersTableMap::COL_ORDER_QTY, $orderQty['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($orderQty['max'])) {
                $this->addUsingAlias(OrdersTableMap::COL_ORDER_QTY, $orderQty['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OrdersTableMap::COL_ORDER_QTY, $orderQty, $comparison);

        return $this;
    }

    /**
     * Filter the query on the employee_id column
     *
     * Example usage:
     * <code>
     * $query->filterByEmployeeId(1234); // WHERE employee_id = 1234
     * $query->filterByEmployeeId(array(12, 34)); // WHERE employee_id IN (12, 34)
     * $query->filterByEmployeeId(array('min' => 12)); // WHERE employee_id > 12
     * </code>
     *
     * @see       filterByEmployee()
     *
     * @param mixed $employeeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmployeeId($employeeId = null, ?string $comparison = null)
    {
        if (is_array($employeeId)) {
            $useMinMax = false;
            if (isset($employeeId['min'])) {
                $this->addUsingAlias(OrdersTableMap::COL_EMPLOYEE_ID, $employeeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($employeeId['max'])) {
                $this->addUsingAlias(OrdersTableMap::COL_EMPLOYEE_ID, $employeeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OrdersTableMap::COL_EMPLOYEE_ID, $employeeId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the booking_date column
     *
     * Example usage:
     * <code>
     * $query->filterByBookingDate('2011-03-14'); // WHERE booking_date = '2011-03-14'
     * $query->filterByBookingDate('now'); // WHERE booking_date = '2011-03-14'
     * $query->filterByBookingDate(array('max' => 'yesterday')); // WHERE booking_date > '2011-03-13'
     * </code>
     *
     * @param mixed $bookingDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBookingDate($bookingDate = null, ?string $comparison = null)
    {
        if (is_array($bookingDate)) {
            $useMinMax = false;
            if (isset($bookingDate['min'])) {
                $this->addUsingAlias(OrdersTableMap::COL_BOOKING_DATE, $bookingDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($bookingDate['max'])) {
                $this->addUsingAlias(OrdersTableMap::COL_BOOKING_DATE, $bookingDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OrdersTableMap::COL_BOOKING_DATE, $bookingDate, $comparison);

        return $this;
    }

    /**
     * Filter the query on the territory_id column
     *
     * Example usage:
     * <code>
     * $query->filterByTerritoryId(1234); // WHERE territory_id = 1234
     * $query->filterByTerritoryId(array(12, 34)); // WHERE territory_id IN (12, 34)
     * $query->filterByTerritoryId(array('min' => 12)); // WHERE territory_id > 12
     * </code>
     *
     * @see       filterByTerritories()
     *
     * @param mixed $territoryId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTerritoryId($territoryId = null, ?string $comparison = null)
    {
        if (is_array($territoryId)) {
            $useMinMax = false;
            if (isset($territoryId['min'])) {
                $this->addUsingAlias(OrdersTableMap::COL_TERRITORY_ID, $territoryId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($territoryId['max'])) {
                $this->addUsingAlias(OrdersTableMap::COL_TERRITORY_ID, $territoryId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OrdersTableMap::COL_TERRITORY_ID, $territoryId, $comparison);

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
                $this->addUsingAlias(OrdersTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(OrdersTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OrdersTableMap::COL_COMPANY_ID, $companyId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the order_status column
     *
     * Example usage:
     * <code>
     * $query->filterByOrderStatus('fooValue');   // WHERE order_status = 'fooValue'
     * $query->filterByOrderStatus('%fooValue%', Criteria::LIKE); // WHERE order_status LIKE '%fooValue%'
     * $query->filterByOrderStatus(['foo', 'bar']); // WHERE order_status IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $orderStatus The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrderStatus($orderStatus = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($orderStatus)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OrdersTableMap::COL_ORDER_STATUS, $orderStatus, $comparison);

        return $this;
    }

    /**
     * Filter the query on the order_rerference column
     *
     * Example usage:
     * <code>
     * $query->filterByOrderRerference('fooValue');   // WHERE order_rerference = 'fooValue'
     * $query->filterByOrderRerference('%fooValue%', Criteria::LIKE); // WHERE order_rerference LIKE '%fooValue%'
     * $query->filterByOrderRerference(['foo', 'bar']); // WHERE order_rerference IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $orderRerference The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrderRerference($orderRerference = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($orderRerference)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OrdersTableMap::COL_ORDER_RERFERENCE, $orderRerference, $comparison);

        return $this;
    }

    /**
     * Filter the query on the order_remark column
     *
     * Example usage:
     * <code>
     * $query->filterByOrderRemark('fooValue');   // WHERE order_remark = 'fooValue'
     * $query->filterByOrderRemark('%fooValue%', Criteria::LIKE); // WHERE order_remark LIKE '%fooValue%'
     * $query->filterByOrderRemark(['foo', 'bar']); // WHERE order_remark IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $orderRemark The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrderRemark($orderRemark = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($orderRemark)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OrdersTableMap::COL_ORDER_REMARK, $orderRemark, $comparison);

        return $this;
    }

    /**
     * Filter the query on the otp_req_id column
     *
     * Example usage:
     * <code>
     * $query->filterByOtpReqId(1234); // WHERE otp_req_id = 1234
     * $query->filterByOtpReqId(array(12, 34)); // WHERE otp_req_id IN (12, 34)
     * $query->filterByOtpReqId(array('min' => 12)); // WHERE otp_req_id > 12
     * </code>
     *
     * @param mixed $otpReqId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOtpReqId($otpReqId = null, ?string $comparison = null)
    {
        if (is_array($otpReqId)) {
            $useMinMax = false;
            if (isset($otpReqId['min'])) {
                $this->addUsingAlias(OrdersTableMap::COL_OTP_REQ_ID, $otpReqId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($otpReqId['max'])) {
                $this->addUsingAlias(OrdersTableMap::COL_OTP_REQ_ID, $otpReqId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OrdersTableMap::COL_OTP_REQ_ID, $otpReqId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the beat_id column
     *
     * Example usage:
     * <code>
     * $query->filterByBeatId(1234); // WHERE beat_id = 1234
     * $query->filterByBeatId(array(12, 34)); // WHERE beat_id IN (12, 34)
     * $query->filterByBeatId(array('min' => 12)); // WHERE beat_id > 12
     * </code>
     *
     * @see       filterByBeats()
     *
     * @param mixed $beatId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBeatId($beatId = null, ?string $comparison = null)
    {
        if (is_array($beatId)) {
            $useMinMax = false;
            if (isset($beatId['min'])) {
                $this->addUsingAlias(OrdersTableMap::COL_BEAT_ID, $beatId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($beatId['max'])) {
                $this->addUsingAlias(OrdersTableMap::COL_BEAT_ID, $beatId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OrdersTableMap::COL_BEAT_ID, $beatId, $comparison);

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

        $this->addUsingAlias(OrdersTableMap::COL_INTEGRATION_ID, $integrationId, $comparison);

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
                ->addUsingAlias(OrdersTableMap::COL_COMPANY_ID, $company->getCompanyId(), $comparison);
        } elseif ($company instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(OrdersTableMap::COL_COMPANY_ID, $company->toKeyValue('PrimaryKey', 'CompanyId'), $comparison);

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
    public function joinCompany(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
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
    public function useCompanyQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
        ?string $joinType = Criteria::LEFT_JOIN
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
     * Filter the query by a related \entities\Employee object
     *
     * @param \entities\Employee|ObjectCollection $employee The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmployee($employee, ?string $comparison = null)
    {
        if ($employee instanceof \entities\Employee) {
            return $this
                ->addUsingAlias(OrdersTableMap::COL_EMPLOYEE_ID, $employee->getEmployeeId(), $comparison);
        } elseif ($employee instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(OrdersTableMap::COL_EMPLOYEE_ID, $employee->toKeyValue('PrimaryKey', 'EmployeeId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByEmployee() only accepts arguments of type \entities\Employee or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Employee relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinEmployee(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Employee');

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
            $this->addJoinObject($join, 'Employee');
        }

        return $this;
    }

    /**
     * Use the Employee relation Employee object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\EmployeeQuery A secondary query class using the current class as primary query
     */
    public function useEmployeeQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinEmployee($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Employee', '\entities\EmployeeQuery');
    }

    /**
     * Use the Employee relation Employee object
     *
     * @param callable(\entities\EmployeeQuery):\entities\EmployeeQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withEmployeeQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useEmployeeQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Employee table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\EmployeeQuery The inner query object of the EXISTS statement
     */
    public function useEmployeeExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\EmployeeQuery */
        $q = $this->useExistsQuery('Employee', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Employee table for a NOT EXISTS query.
     *
     * @see useEmployeeExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\EmployeeQuery The inner query object of the NOT EXISTS statement
     */
    public function useEmployeeNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\EmployeeQuery */
        $q = $this->useExistsQuery('Employee', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Employee table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\EmployeeQuery The inner query object of the IN statement
     */
    public function useInEmployeeQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\EmployeeQuery */
        $q = $this->useInQuery('Employee', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Employee table for a NOT IN query.
     *
     * @see useEmployeeInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\EmployeeQuery The inner query object of the NOT IN statement
     */
    public function useNotInEmployeeQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\EmployeeQuery */
        $q = $this->useInQuery('Employee', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\Outlets object
     *
     * @param \entities\Outlets|ObjectCollection $outlets The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletsRelatedByOutletFrom($outlets, ?string $comparison = null)
    {
        if ($outlets instanceof \entities\Outlets) {
            return $this
                ->addUsingAlias(OrdersTableMap::COL_OUTLET_FROM, $outlets->getId(), $comparison);
        } elseif ($outlets instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(OrdersTableMap::COL_OUTLET_FROM, $outlets->toKeyValue('PrimaryKey', 'Id'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByOutletsRelatedByOutletFrom() only accepts arguments of type \entities\Outlets or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OutletsRelatedByOutletFrom relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOutletsRelatedByOutletFrom(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OutletsRelatedByOutletFrom');

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
            $this->addJoinObject($join, 'OutletsRelatedByOutletFrom');
        }

        return $this;
    }

    /**
     * Use the OutletsRelatedByOutletFrom relation Outlets object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\OutletsQuery A secondary query class using the current class as primary query
     */
    public function useOutletsRelatedByOutletFromQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinOutletsRelatedByOutletFrom($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OutletsRelatedByOutletFrom', '\entities\OutletsQuery');
    }

    /**
     * Use the OutletsRelatedByOutletFrom relation Outlets object
     *
     * @param callable(\entities\OutletsQuery):\entities\OutletsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOutletsRelatedByOutletFromQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useOutletsRelatedByOutletFromQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the OutletsRelatedByOutletFrom relation to the Outlets table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\OutletsQuery The inner query object of the EXISTS statement
     */
    public function useOutletsRelatedByOutletFromExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\OutletsQuery */
        $q = $this->useExistsQuery('OutletsRelatedByOutletFrom', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the OutletsRelatedByOutletFrom relation to the Outlets table for a NOT EXISTS query.
     *
     * @see useOutletsRelatedByOutletFromExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\OutletsQuery The inner query object of the NOT EXISTS statement
     */
    public function useOutletsRelatedByOutletFromNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OutletsQuery */
        $q = $this->useExistsQuery('OutletsRelatedByOutletFrom', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the OutletsRelatedByOutletFrom relation to the Outlets table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\OutletsQuery The inner query object of the IN statement
     */
    public function useInOutletsRelatedByOutletFromQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\OutletsQuery */
        $q = $this->useInQuery('OutletsRelatedByOutletFrom', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the OutletsRelatedByOutletFrom relation to the Outlets table for a NOT IN query.
     *
     * @see useOutletsRelatedByOutletFromInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\OutletsQuery The inner query object of the NOT IN statement
     */
    public function useNotInOutletsRelatedByOutletFromQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OutletsQuery */
        $q = $this->useInQuery('OutletsRelatedByOutletFrom', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\Outlets object
     *
     * @param \entities\Outlets|ObjectCollection $outlets The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletsRelatedByOutletTo($outlets, ?string $comparison = null)
    {
        if ($outlets instanceof \entities\Outlets) {
            return $this
                ->addUsingAlias(OrdersTableMap::COL_OUTLET_TO, $outlets->getId(), $comparison);
        } elseif ($outlets instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(OrdersTableMap::COL_OUTLET_TO, $outlets->toKeyValue('PrimaryKey', 'Id'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByOutletsRelatedByOutletTo() only accepts arguments of type \entities\Outlets or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OutletsRelatedByOutletTo relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOutletsRelatedByOutletTo(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OutletsRelatedByOutletTo');

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
            $this->addJoinObject($join, 'OutletsRelatedByOutletTo');
        }

        return $this;
    }

    /**
     * Use the OutletsRelatedByOutletTo relation Outlets object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\OutletsQuery A secondary query class using the current class as primary query
     */
    public function useOutletsRelatedByOutletToQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinOutletsRelatedByOutletTo($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OutletsRelatedByOutletTo', '\entities\OutletsQuery');
    }

    /**
     * Use the OutletsRelatedByOutletTo relation Outlets object
     *
     * @param callable(\entities\OutletsQuery):\entities\OutletsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOutletsRelatedByOutletToQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useOutletsRelatedByOutletToQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the OutletsRelatedByOutletTo relation to the Outlets table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\OutletsQuery The inner query object of the EXISTS statement
     */
    public function useOutletsRelatedByOutletToExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\OutletsQuery */
        $q = $this->useExistsQuery('OutletsRelatedByOutletTo', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the OutletsRelatedByOutletTo relation to the Outlets table for a NOT EXISTS query.
     *
     * @see useOutletsRelatedByOutletToExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\OutletsQuery The inner query object of the NOT EXISTS statement
     */
    public function useOutletsRelatedByOutletToNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OutletsQuery */
        $q = $this->useExistsQuery('OutletsRelatedByOutletTo', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the OutletsRelatedByOutletTo relation to the Outlets table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\OutletsQuery The inner query object of the IN statement
     */
    public function useInOutletsRelatedByOutletToQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\OutletsQuery */
        $q = $this->useInQuery('OutletsRelatedByOutletTo', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the OutletsRelatedByOutletTo relation to the Outlets table for a NOT IN query.
     *
     * @see useOutletsRelatedByOutletToInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\OutletsQuery The inner query object of the NOT IN statement
     */
    public function useNotInOutletsRelatedByOutletToQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OutletsQuery */
        $q = $this->useInQuery('OutletsRelatedByOutletTo', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\Territories object
     *
     * @param \entities\Territories|ObjectCollection $territories The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTerritories($territories, ?string $comparison = null)
    {
        if ($territories instanceof \entities\Territories) {
            return $this
                ->addUsingAlias(OrdersTableMap::COL_TERRITORY_ID, $territories->getTerritoryId(), $comparison);
        } elseif ($territories instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(OrdersTableMap::COL_TERRITORY_ID, $territories->toKeyValue('PrimaryKey', 'TerritoryId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByTerritories() only accepts arguments of type \entities\Territories or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Territories relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinTerritories(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Territories');

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
            $this->addJoinObject($join, 'Territories');
        }

        return $this;
    }

    /**
     * Use the Territories relation Territories object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\TerritoriesQuery A secondary query class using the current class as primary query
     */
    public function useTerritoriesQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinTerritories($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Territories', '\entities\TerritoriesQuery');
    }

    /**
     * Use the Territories relation Territories object
     *
     * @param callable(\entities\TerritoriesQuery):\entities\TerritoriesQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withTerritoriesQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useTerritoriesQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Territories table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\TerritoriesQuery The inner query object of the EXISTS statement
     */
    public function useTerritoriesExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\TerritoriesQuery */
        $q = $this->useExistsQuery('Territories', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Territories table for a NOT EXISTS query.
     *
     * @see useTerritoriesExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\TerritoriesQuery The inner query object of the NOT EXISTS statement
     */
    public function useTerritoriesNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\TerritoriesQuery */
        $q = $this->useExistsQuery('Territories', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Territories table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\TerritoriesQuery The inner query object of the IN statement
     */
    public function useInTerritoriesQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\TerritoriesQuery */
        $q = $this->useInQuery('Territories', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Territories table for a NOT IN query.
     *
     * @see useTerritoriesInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\TerritoriesQuery The inner query object of the NOT IN statement
     */
    public function useNotInTerritoriesQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\TerritoriesQuery */
        $q = $this->useInQuery('Territories', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\Beats object
     *
     * @param \entities\Beats|ObjectCollection $beats The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBeats($beats, ?string $comparison = null)
    {
        if ($beats instanceof \entities\Beats) {
            return $this
                ->addUsingAlias(OrdersTableMap::COL_BEAT_ID, $beats->getBeatId(), $comparison);
        } elseif ($beats instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(OrdersTableMap::COL_BEAT_ID, $beats->toKeyValue('PrimaryKey', 'BeatId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByBeats() only accepts arguments of type \entities\Beats or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Beats relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinBeats(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Beats');

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
            $this->addJoinObject($join, 'Beats');
        }

        return $this;
    }

    /**
     * Use the Beats relation Beats object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\BeatsQuery A secondary query class using the current class as primary query
     */
    public function useBeatsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinBeats($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Beats', '\entities\BeatsQuery');
    }

    /**
     * Use the Beats relation Beats object
     *
     * @param callable(\entities\BeatsQuery):\entities\BeatsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withBeatsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useBeatsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Beats table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\BeatsQuery The inner query object of the EXISTS statement
     */
    public function useBeatsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\BeatsQuery */
        $q = $this->useExistsQuery('Beats', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Beats table for a NOT EXISTS query.
     *
     * @see useBeatsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\BeatsQuery The inner query object of the NOT EXISTS statement
     */
    public function useBeatsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\BeatsQuery */
        $q = $this->useExistsQuery('Beats', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Beats table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\BeatsQuery The inner query object of the IN statement
     */
    public function useInBeatsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\BeatsQuery */
        $q = $this->useInQuery('Beats', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Beats table for a NOT IN query.
     *
     * @see useBeatsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\BeatsQuery The inner query object of the NOT IN statement
     */
    public function useNotInBeatsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\BeatsQuery */
        $q = $this->useInQuery('Beats', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\Pricebooks object
     *
     * @param \entities\Pricebooks|ObjectCollection $pricebooks The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPricebooks($pricebooks, ?string $comparison = null)
    {
        if ($pricebooks instanceof \entities\Pricebooks) {
            return $this
                ->addUsingAlias(OrdersTableMap::COL_PRICEBOOK_ID, $pricebooks->getPricebookId(), $comparison);
        } elseif ($pricebooks instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(OrdersTableMap::COL_PRICEBOOK_ID, $pricebooks->toKeyValue('PrimaryKey', 'PricebookId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByPricebooks() only accepts arguments of type \entities\Pricebooks or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Pricebooks relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinPricebooks(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Pricebooks');

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
            $this->addJoinObject($join, 'Pricebooks');
        }

        return $this;
    }

    /**
     * Use the Pricebooks relation Pricebooks object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\PricebooksQuery A secondary query class using the current class as primary query
     */
    public function usePricebooksQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinPricebooks($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Pricebooks', '\entities\PricebooksQuery');
    }

    /**
     * Use the Pricebooks relation Pricebooks object
     *
     * @param callable(\entities\PricebooksQuery):\entities\PricebooksQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withPricebooksQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->usePricebooksQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Pricebooks table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\PricebooksQuery The inner query object of the EXISTS statement
     */
    public function usePricebooksExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\PricebooksQuery */
        $q = $this->useExistsQuery('Pricebooks', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Pricebooks table for a NOT EXISTS query.
     *
     * @see usePricebooksExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\PricebooksQuery The inner query object of the NOT EXISTS statement
     */
    public function usePricebooksNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\PricebooksQuery */
        $q = $this->useExistsQuery('Pricebooks', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Pricebooks table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\PricebooksQuery The inner query object of the IN statement
     */
    public function useInPricebooksQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\PricebooksQuery */
        $q = $this->useInQuery('Pricebooks', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Pricebooks table for a NOT IN query.
     *
     * @see usePricebooksInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\PricebooksQuery The inner query object of the NOT IN statement
     */
    public function useNotInPricebooksQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\PricebooksQuery */
        $q = $this->useInQuery('Pricebooks', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\OrderLog object
     *
     * @param \entities\OrderLog|ObjectCollection $orderLog the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrderLog($orderLog, ?string $comparison = null)
    {
        if ($orderLog instanceof \entities\OrderLog) {
            $this
                ->addUsingAlias(OrdersTableMap::COL_ORDER_ID, $orderLog->getOrderId(), $comparison);

            return $this;
        } elseif ($orderLog instanceof ObjectCollection) {
            $this
                ->useOrderLogQuery()
                ->filterByPrimaryKeys($orderLog->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByOrderLog() only accepts arguments of type \entities\OrderLog or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OrderLog relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOrderLog(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OrderLog');

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
            $this->addJoinObject($join, 'OrderLog');
        }

        return $this;
    }

    /**
     * Use the OrderLog relation OrderLog object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\OrderLogQuery A secondary query class using the current class as primary query
     */
    public function useOrderLogQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinOrderLog($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OrderLog', '\entities\OrderLogQuery');
    }

    /**
     * Use the OrderLog relation OrderLog object
     *
     * @param callable(\entities\OrderLogQuery):\entities\OrderLogQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOrderLogQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useOrderLogQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to OrderLog table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\OrderLogQuery The inner query object of the EXISTS statement
     */
    public function useOrderLogExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\OrderLogQuery */
        $q = $this->useExistsQuery('OrderLog', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to OrderLog table for a NOT EXISTS query.
     *
     * @see useOrderLogExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\OrderLogQuery The inner query object of the NOT EXISTS statement
     */
    public function useOrderLogNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OrderLogQuery */
        $q = $this->useExistsQuery('OrderLog', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to OrderLog table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\OrderLogQuery The inner query object of the IN statement
     */
    public function useInOrderLogQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\OrderLogQuery */
        $q = $this->useInQuery('OrderLog', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to OrderLog table for a NOT IN query.
     *
     * @see useOrderLogInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\OrderLogQuery The inner query object of the NOT IN statement
     */
    public function useNotInOrderLogQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OrderLogQuery */
        $q = $this->useInQuery('OrderLog', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\Orderlines object
     *
     * @param \entities\Orderlines|ObjectCollection $orderlines the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrderlines($orderlines, ?string $comparison = null)
    {
        if ($orderlines instanceof \entities\Orderlines) {
            $this
                ->addUsingAlias(OrdersTableMap::COL_ORDER_ID, $orderlines->getOrderId(), $comparison);

            return $this;
        } elseif ($orderlines instanceof ObjectCollection) {
            $this
                ->useOrderlinesQuery()
                ->filterByPrimaryKeys($orderlines->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByOrderlines() only accepts arguments of type \entities\Orderlines or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Orderlines relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOrderlines(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Orderlines');

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
            $this->addJoinObject($join, 'Orderlines');
        }

        return $this;
    }

    /**
     * Use the Orderlines relation Orderlines object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\OrderlinesQuery A secondary query class using the current class as primary query
     */
    public function useOrderlinesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinOrderlines($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Orderlines', '\entities\OrderlinesQuery');
    }

    /**
     * Use the Orderlines relation Orderlines object
     *
     * @param callable(\entities\OrderlinesQuery):\entities\OrderlinesQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOrderlinesQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useOrderlinesQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Orderlines table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\OrderlinesQuery The inner query object of the EXISTS statement
     */
    public function useOrderlinesExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\OrderlinesQuery */
        $q = $this->useExistsQuery('Orderlines', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Orderlines table for a NOT EXISTS query.
     *
     * @see useOrderlinesExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\OrderlinesQuery The inner query object of the NOT EXISTS statement
     */
    public function useOrderlinesNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OrderlinesQuery */
        $q = $this->useExistsQuery('Orderlines', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Orderlines table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\OrderlinesQuery The inner query object of the IN statement
     */
    public function useInOrderlinesQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\OrderlinesQuery */
        $q = $this->useInQuery('Orderlines', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Orderlines table for a NOT IN query.
     *
     * @see useOrderlinesInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\OrderlinesQuery The inner query object of the NOT IN statement
     */
    public function useNotInOrderlinesQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OrderlinesQuery */
        $q = $this->useInQuery('Orderlines', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\Shippingorder object
     *
     * @param \entities\Shippingorder|ObjectCollection $shippingorder the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByShippingorder($shippingorder, ?string $comparison = null)
    {
        if ($shippingorder instanceof \entities\Shippingorder) {
            $this
                ->addUsingAlias(OrdersTableMap::COL_ORDER_ID, $shippingorder->getOrderId(), $comparison);

            return $this;
        } elseif ($shippingorder instanceof ObjectCollection) {
            $this
                ->useShippingorderQuery()
                ->filterByPrimaryKeys($shippingorder->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByShippingorder() only accepts arguments of type \entities\Shippingorder or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Shippingorder relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinShippingorder(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Shippingorder');

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
            $this->addJoinObject($join, 'Shippingorder');
        }

        return $this;
    }

    /**
     * Use the Shippingorder relation Shippingorder object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\ShippingorderQuery A secondary query class using the current class as primary query
     */
    public function useShippingorderQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinShippingorder($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Shippingorder', '\entities\ShippingorderQuery');
    }

    /**
     * Use the Shippingorder relation Shippingorder object
     *
     * @param callable(\entities\ShippingorderQuery):\entities\ShippingorderQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withShippingorderQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useShippingorderQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Shippingorder table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\ShippingorderQuery The inner query object of the EXISTS statement
     */
    public function useShippingorderExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\ShippingorderQuery */
        $q = $this->useExistsQuery('Shippingorder', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Shippingorder table for a NOT EXISTS query.
     *
     * @see useShippingorderExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\ShippingorderQuery The inner query object of the NOT EXISTS statement
     */
    public function useShippingorderNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\ShippingorderQuery */
        $q = $this->useExistsQuery('Shippingorder', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Shippingorder table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\ShippingorderQuery The inner query object of the IN statement
     */
    public function useInShippingorderQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\ShippingorderQuery */
        $q = $this->useInQuery('Shippingorder', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Shippingorder table for a NOT IN query.
     *
     * @see useShippingorderInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\ShippingorderQuery The inner query object of the NOT IN statement
     */
    public function useNotInShippingorderQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\ShippingorderQuery */
        $q = $this->useInQuery('Shippingorder', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildOrders $orders Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($orders = null)
    {
        if ($orders) {
            $this->addUsingAlias(OrdersTableMap::COL_ORDER_ID, $orders->getOrderId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the orders table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OrdersTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            OrdersTableMap::clearInstancePool();
            OrdersTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(OrdersTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(OrdersTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            OrdersTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            OrdersTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
