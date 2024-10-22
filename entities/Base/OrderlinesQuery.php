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
use entities\Orderlines as ChildOrderlines;
use entities\OrderlinesQuery as ChildOrderlinesQuery;
use entities\Map\OrderlinesTableMap;

/**
 * Base class that represents a query for the `orderlines` table.
 *
 * @method     ChildOrderlinesQuery orderByOrderlineId($order = Criteria::ASC) Order by the orderline_id column
 * @method     ChildOrderlinesQuery orderByOrderId($order = Criteria::ASC) Order by the order_id column
 * @method     ChildOrderlinesQuery orderByProductId($order = Criteria::ASC) Order by the product_id column
 * @method     ChildOrderlinesQuery orderByMrp($order = Criteria::ASC) Order by the mrp column
 * @method     ChildOrderlinesQuery orderByRate($order = Criteria::ASC) Order by the rate column
 * @method     ChildOrderlinesQuery orderByQty($order = Criteria::ASC) Order by the qty column
 * @method     ChildOrderlinesQuery orderByShipQty($order = Criteria::ASC) Order by the ship_qty column
 * @method     ChildOrderlinesQuery orderByUnitId($order = Criteria::ASC) Order by the unit_id column
 * @method     ChildOrderlinesQuery orderByTotalAmt($order = Criteria::ASC) Order by the total_amt column
 * @method     ChildOrderlinesQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildOrderlinesQuery orderByRemark($order = Criteria::ASC) Order by the remark column
 * @method     ChildOrderlinesQuery orderByPricebookLine($order = Criteria::ASC) Order by the pricebook_line column
 * @method     ChildOrderlinesQuery orderByIntegrationId($order = Criteria::ASC) Order by the integration_id column
 *
 * @method     ChildOrderlinesQuery groupByOrderlineId() Group by the orderline_id column
 * @method     ChildOrderlinesQuery groupByOrderId() Group by the order_id column
 * @method     ChildOrderlinesQuery groupByProductId() Group by the product_id column
 * @method     ChildOrderlinesQuery groupByMrp() Group by the mrp column
 * @method     ChildOrderlinesQuery groupByRate() Group by the rate column
 * @method     ChildOrderlinesQuery groupByQty() Group by the qty column
 * @method     ChildOrderlinesQuery groupByShipQty() Group by the ship_qty column
 * @method     ChildOrderlinesQuery groupByUnitId() Group by the unit_id column
 * @method     ChildOrderlinesQuery groupByTotalAmt() Group by the total_amt column
 * @method     ChildOrderlinesQuery groupByCompanyId() Group by the company_id column
 * @method     ChildOrderlinesQuery groupByRemark() Group by the remark column
 * @method     ChildOrderlinesQuery groupByPricebookLine() Group by the pricebook_line column
 * @method     ChildOrderlinesQuery groupByIntegrationId() Group by the integration_id column
 *
 * @method     ChildOrderlinesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildOrderlinesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildOrderlinesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildOrderlinesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildOrderlinesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildOrderlinesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildOrderlinesQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildOrderlinesQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildOrderlinesQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildOrderlinesQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildOrderlinesQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildOrderlinesQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildOrderlinesQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     ChildOrderlinesQuery leftJoinOrders($relationAlias = null) Adds a LEFT JOIN clause to the query using the Orders relation
 * @method     ChildOrderlinesQuery rightJoinOrders($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Orders relation
 * @method     ChildOrderlinesQuery innerJoinOrders($relationAlias = null) Adds a INNER JOIN clause to the query using the Orders relation
 *
 * @method     ChildOrderlinesQuery joinWithOrders($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Orders relation
 *
 * @method     ChildOrderlinesQuery leftJoinWithOrders() Adds a LEFT JOIN clause and with to the query using the Orders relation
 * @method     ChildOrderlinesQuery rightJoinWithOrders() Adds a RIGHT JOIN clause and with to the query using the Orders relation
 * @method     ChildOrderlinesQuery innerJoinWithOrders() Adds a INNER JOIN clause and with to the query using the Orders relation
 *
 * @method     ChildOrderlinesQuery leftJoinProducts($relationAlias = null) Adds a LEFT JOIN clause to the query using the Products relation
 * @method     ChildOrderlinesQuery rightJoinProducts($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Products relation
 * @method     ChildOrderlinesQuery innerJoinProducts($relationAlias = null) Adds a INNER JOIN clause to the query using the Products relation
 *
 * @method     ChildOrderlinesQuery joinWithProducts($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Products relation
 *
 * @method     ChildOrderlinesQuery leftJoinWithProducts() Adds a LEFT JOIN clause and with to the query using the Products relation
 * @method     ChildOrderlinesQuery rightJoinWithProducts() Adds a RIGHT JOIN clause and with to the query using the Products relation
 * @method     ChildOrderlinesQuery innerJoinWithProducts() Adds a INNER JOIN clause and with to the query using the Products relation
 *
 * @method     ChildOrderlinesQuery leftJoinUnitmaster($relationAlias = null) Adds a LEFT JOIN clause to the query using the Unitmaster relation
 * @method     ChildOrderlinesQuery rightJoinUnitmaster($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Unitmaster relation
 * @method     ChildOrderlinesQuery innerJoinUnitmaster($relationAlias = null) Adds a INNER JOIN clause to the query using the Unitmaster relation
 *
 * @method     ChildOrderlinesQuery joinWithUnitmaster($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Unitmaster relation
 *
 * @method     ChildOrderlinesQuery leftJoinWithUnitmaster() Adds a LEFT JOIN clause and with to the query using the Unitmaster relation
 * @method     ChildOrderlinesQuery rightJoinWithUnitmaster() Adds a RIGHT JOIN clause and with to the query using the Unitmaster relation
 * @method     ChildOrderlinesQuery innerJoinWithUnitmaster() Adds a INNER JOIN clause and with to the query using the Unitmaster relation
 *
 * @method     ChildOrderlinesQuery leftJoinShippinglines($relationAlias = null) Adds a LEFT JOIN clause to the query using the Shippinglines relation
 * @method     ChildOrderlinesQuery rightJoinShippinglines($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Shippinglines relation
 * @method     ChildOrderlinesQuery innerJoinShippinglines($relationAlias = null) Adds a INNER JOIN clause to the query using the Shippinglines relation
 *
 * @method     ChildOrderlinesQuery joinWithShippinglines($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Shippinglines relation
 *
 * @method     ChildOrderlinesQuery leftJoinWithShippinglines() Adds a LEFT JOIN clause and with to the query using the Shippinglines relation
 * @method     ChildOrderlinesQuery rightJoinWithShippinglines() Adds a RIGHT JOIN clause and with to the query using the Shippinglines relation
 * @method     ChildOrderlinesQuery innerJoinWithShippinglines() Adds a INNER JOIN clause and with to the query using the Shippinglines relation
 *
 * @method     \entities\CompanyQuery|\entities\OrdersQuery|\entities\ProductsQuery|\entities\UnitmasterQuery|\entities\ShippinglinesQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildOrderlines|null findOne(?ConnectionInterface $con = null) Return the first ChildOrderlines matching the query
 * @method     ChildOrderlines findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildOrderlines matching the query, or a new ChildOrderlines object populated from the query conditions when no match is found
 *
 * @method     ChildOrderlines|null findOneByOrderlineId(string $orderline_id) Return the first ChildOrderlines filtered by the orderline_id column
 * @method     ChildOrderlines|null findOneByOrderId(string $order_id) Return the first ChildOrderlines filtered by the order_id column
 * @method     ChildOrderlines|null findOneByProductId(int $product_id) Return the first ChildOrderlines filtered by the product_id column
 * @method     ChildOrderlines|null findOneByMrp(string $mrp) Return the first ChildOrderlines filtered by the mrp column
 * @method     ChildOrderlines|null findOneByRate(string $rate) Return the first ChildOrderlines filtered by the rate column
 * @method     ChildOrderlines|null findOneByQty(int $qty) Return the first ChildOrderlines filtered by the qty column
 * @method     ChildOrderlines|null findOneByShipQty(int $ship_qty) Return the first ChildOrderlines filtered by the ship_qty column
 * @method     ChildOrderlines|null findOneByUnitId(int $unit_id) Return the first ChildOrderlines filtered by the unit_id column
 * @method     ChildOrderlines|null findOneByTotalAmt(string $total_amt) Return the first ChildOrderlines filtered by the total_amt column
 * @method     ChildOrderlines|null findOneByCompanyId(int $company_id) Return the first ChildOrderlines filtered by the company_id column
 * @method     ChildOrderlines|null findOneByRemark(string $remark) Return the first ChildOrderlines filtered by the remark column
 * @method     ChildOrderlines|null findOneByPricebookLine(int $pricebook_line) Return the first ChildOrderlines filtered by the pricebook_line column
 * @method     ChildOrderlines|null findOneByIntegrationId(string $integration_id) Return the first ChildOrderlines filtered by the integration_id column
 *
 * @method     ChildOrderlines requirePk($key, ?ConnectionInterface $con = null) Return the ChildOrderlines by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrderlines requireOne(?ConnectionInterface $con = null) Return the first ChildOrderlines matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOrderlines requireOneByOrderlineId(string $orderline_id) Return the first ChildOrderlines filtered by the orderline_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrderlines requireOneByOrderId(string $order_id) Return the first ChildOrderlines filtered by the order_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrderlines requireOneByProductId(int $product_id) Return the first ChildOrderlines filtered by the product_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrderlines requireOneByMrp(string $mrp) Return the first ChildOrderlines filtered by the mrp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrderlines requireOneByRate(string $rate) Return the first ChildOrderlines filtered by the rate column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrderlines requireOneByQty(int $qty) Return the first ChildOrderlines filtered by the qty column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrderlines requireOneByShipQty(int $ship_qty) Return the first ChildOrderlines filtered by the ship_qty column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrderlines requireOneByUnitId(int $unit_id) Return the first ChildOrderlines filtered by the unit_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrderlines requireOneByTotalAmt(string $total_amt) Return the first ChildOrderlines filtered by the total_amt column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrderlines requireOneByCompanyId(int $company_id) Return the first ChildOrderlines filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrderlines requireOneByRemark(string $remark) Return the first ChildOrderlines filtered by the remark column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrderlines requireOneByPricebookLine(int $pricebook_line) Return the first ChildOrderlines filtered by the pricebook_line column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrderlines requireOneByIntegrationId(string $integration_id) Return the first ChildOrderlines filtered by the integration_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOrderlines[]|Collection find(?ConnectionInterface $con = null) Return ChildOrderlines objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildOrderlines> find(?ConnectionInterface $con = null) Return ChildOrderlines objects based on current ModelCriteria
 *
 * @method     ChildOrderlines[]|Collection findByOrderlineId(string|array<string> $orderline_id) Return ChildOrderlines objects filtered by the orderline_id column
 * @psalm-method Collection&\Traversable<ChildOrderlines> findByOrderlineId(string|array<string> $orderline_id) Return ChildOrderlines objects filtered by the orderline_id column
 * @method     ChildOrderlines[]|Collection findByOrderId(string|array<string> $order_id) Return ChildOrderlines objects filtered by the order_id column
 * @psalm-method Collection&\Traversable<ChildOrderlines> findByOrderId(string|array<string> $order_id) Return ChildOrderlines objects filtered by the order_id column
 * @method     ChildOrderlines[]|Collection findByProductId(int|array<int> $product_id) Return ChildOrderlines objects filtered by the product_id column
 * @psalm-method Collection&\Traversable<ChildOrderlines> findByProductId(int|array<int> $product_id) Return ChildOrderlines objects filtered by the product_id column
 * @method     ChildOrderlines[]|Collection findByMrp(string|array<string> $mrp) Return ChildOrderlines objects filtered by the mrp column
 * @psalm-method Collection&\Traversable<ChildOrderlines> findByMrp(string|array<string> $mrp) Return ChildOrderlines objects filtered by the mrp column
 * @method     ChildOrderlines[]|Collection findByRate(string|array<string> $rate) Return ChildOrderlines objects filtered by the rate column
 * @psalm-method Collection&\Traversable<ChildOrderlines> findByRate(string|array<string> $rate) Return ChildOrderlines objects filtered by the rate column
 * @method     ChildOrderlines[]|Collection findByQty(int|array<int> $qty) Return ChildOrderlines objects filtered by the qty column
 * @psalm-method Collection&\Traversable<ChildOrderlines> findByQty(int|array<int> $qty) Return ChildOrderlines objects filtered by the qty column
 * @method     ChildOrderlines[]|Collection findByShipQty(int|array<int> $ship_qty) Return ChildOrderlines objects filtered by the ship_qty column
 * @psalm-method Collection&\Traversable<ChildOrderlines> findByShipQty(int|array<int> $ship_qty) Return ChildOrderlines objects filtered by the ship_qty column
 * @method     ChildOrderlines[]|Collection findByUnitId(int|array<int> $unit_id) Return ChildOrderlines objects filtered by the unit_id column
 * @psalm-method Collection&\Traversable<ChildOrderlines> findByUnitId(int|array<int> $unit_id) Return ChildOrderlines objects filtered by the unit_id column
 * @method     ChildOrderlines[]|Collection findByTotalAmt(string|array<string> $total_amt) Return ChildOrderlines objects filtered by the total_amt column
 * @psalm-method Collection&\Traversable<ChildOrderlines> findByTotalAmt(string|array<string> $total_amt) Return ChildOrderlines objects filtered by the total_amt column
 * @method     ChildOrderlines[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildOrderlines objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildOrderlines> findByCompanyId(int|array<int> $company_id) Return ChildOrderlines objects filtered by the company_id column
 * @method     ChildOrderlines[]|Collection findByRemark(string|array<string> $remark) Return ChildOrderlines objects filtered by the remark column
 * @psalm-method Collection&\Traversable<ChildOrderlines> findByRemark(string|array<string> $remark) Return ChildOrderlines objects filtered by the remark column
 * @method     ChildOrderlines[]|Collection findByPricebookLine(int|array<int> $pricebook_line) Return ChildOrderlines objects filtered by the pricebook_line column
 * @psalm-method Collection&\Traversable<ChildOrderlines> findByPricebookLine(int|array<int> $pricebook_line) Return ChildOrderlines objects filtered by the pricebook_line column
 * @method     ChildOrderlines[]|Collection findByIntegrationId(string|array<string> $integration_id) Return ChildOrderlines objects filtered by the integration_id column
 * @psalm-method Collection&\Traversable<ChildOrderlines> findByIntegrationId(string|array<string> $integration_id) Return ChildOrderlines objects filtered by the integration_id column
 *
 * @method     ChildOrderlines[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildOrderlines> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class OrderlinesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\OrderlinesQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\Orderlines', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildOrderlinesQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildOrderlinesQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildOrderlinesQuery) {
            return $criteria;
        }
        $query = new ChildOrderlinesQuery();
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
     * @return ChildOrderlines|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(OrderlinesTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = OrderlinesTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildOrderlines A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT orderline_id, order_id, product_id, mrp, rate, qty, ship_qty, unit_id, total_amt, company_id, remark, pricebook_line, integration_id FROM orderlines WHERE orderline_id = :p0';
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
            /** @var ChildOrderlines $obj */
            $obj = new ChildOrderlines();
            $obj->hydrate($row);
            OrderlinesTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildOrderlines|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(OrderlinesTableMap::COL_ORDERLINE_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(OrderlinesTableMap::COL_ORDERLINE_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the orderline_id column
     *
     * Example usage:
     * <code>
     * $query->filterByOrderlineId(1234); // WHERE orderline_id = 1234
     * $query->filterByOrderlineId(array(12, 34)); // WHERE orderline_id IN (12, 34)
     * $query->filterByOrderlineId(array('min' => 12)); // WHERE orderline_id > 12
     * </code>
     *
     * @param mixed $orderlineId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrderlineId($orderlineId = null, ?string $comparison = null)
    {
        if (is_array($orderlineId)) {
            $useMinMax = false;
            if (isset($orderlineId['min'])) {
                $this->addUsingAlias(OrderlinesTableMap::COL_ORDERLINE_ID, $orderlineId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($orderlineId['max'])) {
                $this->addUsingAlias(OrderlinesTableMap::COL_ORDERLINE_ID, $orderlineId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OrderlinesTableMap::COL_ORDERLINE_ID, $orderlineId, $comparison);

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
                $this->addUsingAlias(OrderlinesTableMap::COL_ORDER_ID, $orderId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($orderId['max'])) {
                $this->addUsingAlias(OrderlinesTableMap::COL_ORDER_ID, $orderId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OrderlinesTableMap::COL_ORDER_ID, $orderId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the product_id column
     *
     * Example usage:
     * <code>
     * $query->filterByProductId(1234); // WHERE product_id = 1234
     * $query->filterByProductId(array(12, 34)); // WHERE product_id IN (12, 34)
     * $query->filterByProductId(array('min' => 12)); // WHERE product_id > 12
     * </code>
     *
     * @see       filterByProducts()
     *
     * @param mixed $productId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProductId($productId = null, ?string $comparison = null)
    {
        if (is_array($productId)) {
            $useMinMax = false;
            if (isset($productId['min'])) {
                $this->addUsingAlias(OrderlinesTableMap::COL_PRODUCT_ID, $productId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($productId['max'])) {
                $this->addUsingAlias(OrderlinesTableMap::COL_PRODUCT_ID, $productId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OrderlinesTableMap::COL_PRODUCT_ID, $productId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the mrp column
     *
     * Example usage:
     * <code>
     * $query->filterByMrp(1234); // WHERE mrp = 1234
     * $query->filterByMrp(array(12, 34)); // WHERE mrp IN (12, 34)
     * $query->filterByMrp(array('min' => 12)); // WHERE mrp > 12
     * </code>
     *
     * @param mixed $mrp The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMrp($mrp = null, ?string $comparison = null)
    {
        if (is_array($mrp)) {
            $useMinMax = false;
            if (isset($mrp['min'])) {
                $this->addUsingAlias(OrderlinesTableMap::COL_MRP, $mrp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($mrp['max'])) {
                $this->addUsingAlias(OrderlinesTableMap::COL_MRP, $mrp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OrderlinesTableMap::COL_MRP, $mrp, $comparison);

        return $this;
    }

    /**
     * Filter the query on the rate column
     *
     * Example usage:
     * <code>
     * $query->filterByRate(1234); // WHERE rate = 1234
     * $query->filterByRate(array(12, 34)); // WHERE rate IN (12, 34)
     * $query->filterByRate(array('min' => 12)); // WHERE rate > 12
     * </code>
     *
     * @param mixed $rate The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRate($rate = null, ?string $comparison = null)
    {
        if (is_array($rate)) {
            $useMinMax = false;
            if (isset($rate['min'])) {
                $this->addUsingAlias(OrderlinesTableMap::COL_RATE, $rate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($rate['max'])) {
                $this->addUsingAlias(OrderlinesTableMap::COL_RATE, $rate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OrderlinesTableMap::COL_RATE, $rate, $comparison);

        return $this;
    }

    /**
     * Filter the query on the qty column
     *
     * Example usage:
     * <code>
     * $query->filterByQty(1234); // WHERE qty = 1234
     * $query->filterByQty(array(12, 34)); // WHERE qty IN (12, 34)
     * $query->filterByQty(array('min' => 12)); // WHERE qty > 12
     * </code>
     *
     * @param mixed $qty The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByQty($qty = null, ?string $comparison = null)
    {
        if (is_array($qty)) {
            $useMinMax = false;
            if (isset($qty['min'])) {
                $this->addUsingAlias(OrderlinesTableMap::COL_QTY, $qty['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($qty['max'])) {
                $this->addUsingAlias(OrderlinesTableMap::COL_QTY, $qty['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OrderlinesTableMap::COL_QTY, $qty, $comparison);

        return $this;
    }

    /**
     * Filter the query on the ship_qty column
     *
     * Example usage:
     * <code>
     * $query->filterByShipQty(1234); // WHERE ship_qty = 1234
     * $query->filterByShipQty(array(12, 34)); // WHERE ship_qty IN (12, 34)
     * $query->filterByShipQty(array('min' => 12)); // WHERE ship_qty > 12
     * </code>
     *
     * @param mixed $shipQty The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByShipQty($shipQty = null, ?string $comparison = null)
    {
        if (is_array($shipQty)) {
            $useMinMax = false;
            if (isset($shipQty['min'])) {
                $this->addUsingAlias(OrderlinesTableMap::COL_SHIP_QTY, $shipQty['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($shipQty['max'])) {
                $this->addUsingAlias(OrderlinesTableMap::COL_SHIP_QTY, $shipQty['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OrderlinesTableMap::COL_SHIP_QTY, $shipQty, $comparison);

        return $this;
    }

    /**
     * Filter the query on the unit_id column
     *
     * Example usage:
     * <code>
     * $query->filterByUnitId(1234); // WHERE unit_id = 1234
     * $query->filterByUnitId(array(12, 34)); // WHERE unit_id IN (12, 34)
     * $query->filterByUnitId(array('min' => 12)); // WHERE unit_id > 12
     * </code>
     *
     * @see       filterByUnitmaster()
     *
     * @param mixed $unitId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUnitId($unitId = null, ?string $comparison = null)
    {
        if (is_array($unitId)) {
            $useMinMax = false;
            if (isset($unitId['min'])) {
                $this->addUsingAlias(OrderlinesTableMap::COL_UNIT_ID, $unitId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($unitId['max'])) {
                $this->addUsingAlias(OrderlinesTableMap::COL_UNIT_ID, $unitId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OrderlinesTableMap::COL_UNIT_ID, $unitId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the total_amt column
     *
     * Example usage:
     * <code>
     * $query->filterByTotalAmt(1234); // WHERE total_amt = 1234
     * $query->filterByTotalAmt(array(12, 34)); // WHERE total_amt IN (12, 34)
     * $query->filterByTotalAmt(array('min' => 12)); // WHERE total_amt > 12
     * </code>
     *
     * @param mixed $totalAmt The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTotalAmt($totalAmt = null, ?string $comparison = null)
    {
        if (is_array($totalAmt)) {
            $useMinMax = false;
            if (isset($totalAmt['min'])) {
                $this->addUsingAlias(OrderlinesTableMap::COL_TOTAL_AMT, $totalAmt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($totalAmt['max'])) {
                $this->addUsingAlias(OrderlinesTableMap::COL_TOTAL_AMT, $totalAmt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OrderlinesTableMap::COL_TOTAL_AMT, $totalAmt, $comparison);

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
                $this->addUsingAlias(OrderlinesTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(OrderlinesTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OrderlinesTableMap::COL_COMPANY_ID, $companyId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the remark column
     *
     * Example usage:
     * <code>
     * $query->filterByRemark('fooValue');   // WHERE remark = 'fooValue'
     * $query->filterByRemark('%fooValue%', Criteria::LIKE); // WHERE remark LIKE '%fooValue%'
     * $query->filterByRemark(['foo', 'bar']); // WHERE remark IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $remark The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRemark($remark = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($remark)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OrderlinesTableMap::COL_REMARK, $remark, $comparison);

        return $this;
    }

    /**
     * Filter the query on the pricebook_line column
     *
     * Example usage:
     * <code>
     * $query->filterByPricebookLine(1234); // WHERE pricebook_line = 1234
     * $query->filterByPricebookLine(array(12, 34)); // WHERE pricebook_line IN (12, 34)
     * $query->filterByPricebookLine(array('min' => 12)); // WHERE pricebook_line > 12
     * </code>
     *
     * @param mixed $pricebookLine The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPricebookLine($pricebookLine = null, ?string $comparison = null)
    {
        if (is_array($pricebookLine)) {
            $useMinMax = false;
            if (isset($pricebookLine['min'])) {
                $this->addUsingAlias(OrderlinesTableMap::COL_PRICEBOOK_LINE, $pricebookLine['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($pricebookLine['max'])) {
                $this->addUsingAlias(OrderlinesTableMap::COL_PRICEBOOK_LINE, $pricebookLine['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OrderlinesTableMap::COL_PRICEBOOK_LINE, $pricebookLine, $comparison);

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

        $this->addUsingAlias(OrderlinesTableMap::COL_INTEGRATION_ID, $integrationId, $comparison);

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
                ->addUsingAlias(OrderlinesTableMap::COL_COMPANY_ID, $company->getCompanyId(), $comparison);
        } elseif ($company instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(OrderlinesTableMap::COL_COMPANY_ID, $company->toKeyValue('PrimaryKey', 'CompanyId'), $comparison);

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
                ->addUsingAlias(OrderlinesTableMap::COL_ORDER_ID, $orders->getOrderId(), $comparison);
        } elseif ($orders instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(OrderlinesTableMap::COL_ORDER_ID, $orders->toKeyValue('PrimaryKey', 'OrderId'), $comparison);

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
     * Filter the query by a related \entities\Products object
     *
     * @param \entities\Products|ObjectCollection $products The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProducts($products, ?string $comparison = null)
    {
        if ($products instanceof \entities\Products) {
            return $this
                ->addUsingAlias(OrderlinesTableMap::COL_PRODUCT_ID, $products->getId(), $comparison);
        } elseif ($products instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(OrderlinesTableMap::COL_PRODUCT_ID, $products->toKeyValue('PrimaryKey', 'Id'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByProducts() only accepts arguments of type \entities\Products or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Products relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinProducts(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Products');

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
            $this->addJoinObject($join, 'Products');
        }

        return $this;
    }

    /**
     * Use the Products relation Products object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\ProductsQuery A secondary query class using the current class as primary query
     */
    public function useProductsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProducts($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Products', '\entities\ProductsQuery');
    }

    /**
     * Use the Products relation Products object
     *
     * @param callable(\entities\ProductsQuery):\entities\ProductsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withProductsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useProductsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Products table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\ProductsQuery The inner query object of the EXISTS statement
     */
    public function useProductsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\ProductsQuery */
        $q = $this->useExistsQuery('Products', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Products table for a NOT EXISTS query.
     *
     * @see useProductsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\ProductsQuery The inner query object of the NOT EXISTS statement
     */
    public function useProductsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\ProductsQuery */
        $q = $this->useExistsQuery('Products', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Products table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\ProductsQuery The inner query object of the IN statement
     */
    public function useInProductsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\ProductsQuery */
        $q = $this->useInQuery('Products', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Products table for a NOT IN query.
     *
     * @see useProductsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\ProductsQuery The inner query object of the NOT IN statement
     */
    public function useNotInProductsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\ProductsQuery */
        $q = $this->useInQuery('Products', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\Unitmaster object
     *
     * @param \entities\Unitmaster|ObjectCollection $unitmaster The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUnitmaster($unitmaster, ?string $comparison = null)
    {
        if ($unitmaster instanceof \entities\Unitmaster) {
            return $this
                ->addUsingAlias(OrderlinesTableMap::COL_UNIT_ID, $unitmaster->getUnitId(), $comparison);
        } elseif ($unitmaster instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(OrderlinesTableMap::COL_UNIT_ID, $unitmaster->toKeyValue('PrimaryKey', 'UnitId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByUnitmaster() only accepts arguments of type \entities\Unitmaster or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Unitmaster relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinUnitmaster(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Unitmaster');

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
            $this->addJoinObject($join, 'Unitmaster');
        }

        return $this;
    }

    /**
     * Use the Unitmaster relation Unitmaster object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\UnitmasterQuery A secondary query class using the current class as primary query
     */
    public function useUnitmasterQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUnitmaster($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Unitmaster', '\entities\UnitmasterQuery');
    }

    /**
     * Use the Unitmaster relation Unitmaster object
     *
     * @param callable(\entities\UnitmasterQuery):\entities\UnitmasterQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withUnitmasterQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useUnitmasterQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Unitmaster table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\UnitmasterQuery The inner query object of the EXISTS statement
     */
    public function useUnitmasterExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\UnitmasterQuery */
        $q = $this->useExistsQuery('Unitmaster', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Unitmaster table for a NOT EXISTS query.
     *
     * @see useUnitmasterExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\UnitmasterQuery The inner query object of the NOT EXISTS statement
     */
    public function useUnitmasterNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\UnitmasterQuery */
        $q = $this->useExistsQuery('Unitmaster', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Unitmaster table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\UnitmasterQuery The inner query object of the IN statement
     */
    public function useInUnitmasterQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\UnitmasterQuery */
        $q = $this->useInQuery('Unitmaster', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Unitmaster table for a NOT IN query.
     *
     * @see useUnitmasterInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\UnitmasterQuery The inner query object of the NOT IN statement
     */
    public function useNotInUnitmasterQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\UnitmasterQuery */
        $q = $this->useInQuery('Unitmaster', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(OrderlinesTableMap::COL_ORDERLINE_ID, $shippinglines->getOrderlineId(), $comparison);

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
     * @param ChildOrderlines $orderlines Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($orderlines = null)
    {
        if ($orderlines) {
            $this->addUsingAlias(OrderlinesTableMap::COL_ORDERLINE_ID, $orderlines->getOrderlineId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the orderlines table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OrderlinesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            OrderlinesTableMap::clearInstancePool();
            OrderlinesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(OrderlinesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(OrderlinesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            OrderlinesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            OrderlinesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
