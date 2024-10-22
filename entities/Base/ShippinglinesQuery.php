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
use entities\Shippinglines as ChildShippinglines;
use entities\ShippinglinesQuery as ChildShippinglinesQuery;
use entities\Map\ShippinglinesTableMap;

/**
 * Base class that represents a query for the `shippinglines` table.
 *
 * @method     ChildShippinglinesQuery orderBySolid($order = Criteria::ASC) Order by the solid column
 * @method     ChildShippinglinesQuery orderBySoid($order = Criteria::ASC) Order by the soid column
 * @method     ChildShippinglinesQuery orderByProductId($order = Criteria::ASC) Order by the product_id column
 * @method     ChildShippinglinesQuery orderByQty($order = Criteria::ASC) Order by the qty column
 * @method     ChildShippinglinesQuery orderByAllocatedQty($order = Criteria::ASC) Order by the allocated_qty column
 * @method     ChildShippinglinesQuery orderByRate($order = Criteria::ASC) Order by the rate column
 * @method     ChildShippinglinesQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildShippinglinesQuery orderByOrderlineId($order = Criteria::ASC) Order by the orderline_id column
 * @method     ChildShippinglinesQuery orderByCreatedDate($order = Criteria::ASC) Order by the created_date column
 * @method     ChildShippinglinesQuery orderByIntegrationId($order = Criteria::ASC) Order by the integration_id column
 *
 * @method     ChildShippinglinesQuery groupBySolid() Group by the solid column
 * @method     ChildShippinglinesQuery groupBySoid() Group by the soid column
 * @method     ChildShippinglinesQuery groupByProductId() Group by the product_id column
 * @method     ChildShippinglinesQuery groupByQty() Group by the qty column
 * @method     ChildShippinglinesQuery groupByAllocatedQty() Group by the allocated_qty column
 * @method     ChildShippinglinesQuery groupByRate() Group by the rate column
 * @method     ChildShippinglinesQuery groupByCompanyId() Group by the company_id column
 * @method     ChildShippinglinesQuery groupByOrderlineId() Group by the orderline_id column
 * @method     ChildShippinglinesQuery groupByCreatedDate() Group by the created_date column
 * @method     ChildShippinglinesQuery groupByIntegrationId() Group by the integration_id column
 *
 * @method     ChildShippinglinesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildShippinglinesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildShippinglinesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildShippinglinesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildShippinglinesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildShippinglinesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildShippinglinesQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildShippinglinesQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildShippinglinesQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildShippinglinesQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildShippinglinesQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildShippinglinesQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildShippinglinesQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     ChildShippinglinesQuery leftJoinOrderlines($relationAlias = null) Adds a LEFT JOIN clause to the query using the Orderlines relation
 * @method     ChildShippinglinesQuery rightJoinOrderlines($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Orderlines relation
 * @method     ChildShippinglinesQuery innerJoinOrderlines($relationAlias = null) Adds a INNER JOIN clause to the query using the Orderlines relation
 *
 * @method     ChildShippinglinesQuery joinWithOrderlines($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Orderlines relation
 *
 * @method     ChildShippinglinesQuery leftJoinWithOrderlines() Adds a LEFT JOIN clause and with to the query using the Orderlines relation
 * @method     ChildShippinglinesQuery rightJoinWithOrderlines() Adds a RIGHT JOIN clause and with to the query using the Orderlines relation
 * @method     ChildShippinglinesQuery innerJoinWithOrderlines() Adds a INNER JOIN clause and with to the query using the Orderlines relation
 *
 * @method     ChildShippinglinesQuery leftJoinProducts($relationAlias = null) Adds a LEFT JOIN clause to the query using the Products relation
 * @method     ChildShippinglinesQuery rightJoinProducts($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Products relation
 * @method     ChildShippinglinesQuery innerJoinProducts($relationAlias = null) Adds a INNER JOIN clause to the query using the Products relation
 *
 * @method     ChildShippinglinesQuery joinWithProducts($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Products relation
 *
 * @method     ChildShippinglinesQuery leftJoinWithProducts() Adds a LEFT JOIN clause and with to the query using the Products relation
 * @method     ChildShippinglinesQuery rightJoinWithProducts() Adds a RIGHT JOIN clause and with to the query using the Products relation
 * @method     ChildShippinglinesQuery innerJoinWithProducts() Adds a INNER JOIN clause and with to the query using the Products relation
 *
 * @method     ChildShippinglinesQuery leftJoinShippingorder($relationAlias = null) Adds a LEFT JOIN clause to the query using the Shippingorder relation
 * @method     ChildShippinglinesQuery rightJoinShippingorder($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Shippingorder relation
 * @method     ChildShippinglinesQuery innerJoinShippingorder($relationAlias = null) Adds a INNER JOIN clause to the query using the Shippingorder relation
 *
 * @method     ChildShippinglinesQuery joinWithShippingorder($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Shippingorder relation
 *
 * @method     ChildShippinglinesQuery leftJoinWithShippingorder() Adds a LEFT JOIN clause and with to the query using the Shippingorder relation
 * @method     ChildShippinglinesQuery rightJoinWithShippingorder() Adds a RIGHT JOIN clause and with to the query using the Shippingorder relation
 * @method     ChildShippinglinesQuery innerJoinWithShippingorder() Adds a INNER JOIN clause and with to the query using the Shippingorder relation
 *
 * @method     ChildShippinglinesQuery leftJoinShippinglineallocation($relationAlias = null) Adds a LEFT JOIN clause to the query using the Shippinglineallocation relation
 * @method     ChildShippinglinesQuery rightJoinShippinglineallocation($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Shippinglineallocation relation
 * @method     ChildShippinglinesQuery innerJoinShippinglineallocation($relationAlias = null) Adds a INNER JOIN clause to the query using the Shippinglineallocation relation
 *
 * @method     ChildShippinglinesQuery joinWithShippinglineallocation($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Shippinglineallocation relation
 *
 * @method     ChildShippinglinesQuery leftJoinWithShippinglineallocation() Adds a LEFT JOIN clause and with to the query using the Shippinglineallocation relation
 * @method     ChildShippinglinesQuery rightJoinWithShippinglineallocation() Adds a RIGHT JOIN clause and with to the query using the Shippinglineallocation relation
 * @method     ChildShippinglinesQuery innerJoinWithShippinglineallocation() Adds a INNER JOIN clause and with to the query using the Shippinglineallocation relation
 *
 * @method     \entities\CompanyQuery|\entities\OrderlinesQuery|\entities\ProductsQuery|\entities\ShippingorderQuery|\entities\ShippinglineallocationQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildShippinglines|null findOne(?ConnectionInterface $con = null) Return the first ChildShippinglines matching the query
 * @method     ChildShippinglines findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildShippinglines matching the query, or a new ChildShippinglines object populated from the query conditions when no match is found
 *
 * @method     ChildShippinglines|null findOneBySolid(string $solid) Return the first ChildShippinglines filtered by the solid column
 * @method     ChildShippinglines|null findOneBySoid(string $soid) Return the first ChildShippinglines filtered by the soid column
 * @method     ChildShippinglines|null findOneByProductId(int $product_id) Return the first ChildShippinglines filtered by the product_id column
 * @method     ChildShippinglines|null findOneByQty(int $qty) Return the first ChildShippinglines filtered by the qty column
 * @method     ChildShippinglines|null findOneByAllocatedQty(int $allocated_qty) Return the first ChildShippinglines filtered by the allocated_qty column
 * @method     ChildShippinglines|null findOneByRate(string $rate) Return the first ChildShippinglines filtered by the rate column
 * @method     ChildShippinglines|null findOneByCompanyId(int $company_id) Return the first ChildShippinglines filtered by the company_id column
 * @method     ChildShippinglines|null findOneByOrderlineId(string $orderline_id) Return the first ChildShippinglines filtered by the orderline_id column
 * @method     ChildShippinglines|null findOneByCreatedDate(string $created_date) Return the first ChildShippinglines filtered by the created_date column
 * @method     ChildShippinglines|null findOneByIntegrationId(string $integration_id) Return the first ChildShippinglines filtered by the integration_id column
 *
 * @method     ChildShippinglines requirePk($key, ?ConnectionInterface $con = null) Return the ChildShippinglines by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShippinglines requireOne(?ConnectionInterface $con = null) Return the first ChildShippinglines matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildShippinglines requireOneBySolid(string $solid) Return the first ChildShippinglines filtered by the solid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShippinglines requireOneBySoid(string $soid) Return the first ChildShippinglines filtered by the soid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShippinglines requireOneByProductId(int $product_id) Return the first ChildShippinglines filtered by the product_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShippinglines requireOneByQty(int $qty) Return the first ChildShippinglines filtered by the qty column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShippinglines requireOneByAllocatedQty(int $allocated_qty) Return the first ChildShippinglines filtered by the allocated_qty column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShippinglines requireOneByRate(string $rate) Return the first ChildShippinglines filtered by the rate column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShippinglines requireOneByCompanyId(int $company_id) Return the first ChildShippinglines filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShippinglines requireOneByOrderlineId(string $orderline_id) Return the first ChildShippinglines filtered by the orderline_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShippinglines requireOneByCreatedDate(string $created_date) Return the first ChildShippinglines filtered by the created_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShippinglines requireOneByIntegrationId(string $integration_id) Return the first ChildShippinglines filtered by the integration_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildShippinglines[]|Collection find(?ConnectionInterface $con = null) Return ChildShippinglines objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildShippinglines> find(?ConnectionInterface $con = null) Return ChildShippinglines objects based on current ModelCriteria
 *
 * @method     ChildShippinglines[]|Collection findBySolid(string|array<string> $solid) Return ChildShippinglines objects filtered by the solid column
 * @psalm-method Collection&\Traversable<ChildShippinglines> findBySolid(string|array<string> $solid) Return ChildShippinglines objects filtered by the solid column
 * @method     ChildShippinglines[]|Collection findBySoid(string|array<string> $soid) Return ChildShippinglines objects filtered by the soid column
 * @psalm-method Collection&\Traversable<ChildShippinglines> findBySoid(string|array<string> $soid) Return ChildShippinglines objects filtered by the soid column
 * @method     ChildShippinglines[]|Collection findByProductId(int|array<int> $product_id) Return ChildShippinglines objects filtered by the product_id column
 * @psalm-method Collection&\Traversable<ChildShippinglines> findByProductId(int|array<int> $product_id) Return ChildShippinglines objects filtered by the product_id column
 * @method     ChildShippinglines[]|Collection findByQty(int|array<int> $qty) Return ChildShippinglines objects filtered by the qty column
 * @psalm-method Collection&\Traversable<ChildShippinglines> findByQty(int|array<int> $qty) Return ChildShippinglines objects filtered by the qty column
 * @method     ChildShippinglines[]|Collection findByAllocatedQty(int|array<int> $allocated_qty) Return ChildShippinglines objects filtered by the allocated_qty column
 * @psalm-method Collection&\Traversable<ChildShippinglines> findByAllocatedQty(int|array<int> $allocated_qty) Return ChildShippinglines objects filtered by the allocated_qty column
 * @method     ChildShippinglines[]|Collection findByRate(string|array<string> $rate) Return ChildShippinglines objects filtered by the rate column
 * @psalm-method Collection&\Traversable<ChildShippinglines> findByRate(string|array<string> $rate) Return ChildShippinglines objects filtered by the rate column
 * @method     ChildShippinglines[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildShippinglines objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildShippinglines> findByCompanyId(int|array<int> $company_id) Return ChildShippinglines objects filtered by the company_id column
 * @method     ChildShippinglines[]|Collection findByOrderlineId(string|array<string> $orderline_id) Return ChildShippinglines objects filtered by the orderline_id column
 * @psalm-method Collection&\Traversable<ChildShippinglines> findByOrderlineId(string|array<string> $orderline_id) Return ChildShippinglines objects filtered by the orderline_id column
 * @method     ChildShippinglines[]|Collection findByCreatedDate(string|array<string> $created_date) Return ChildShippinglines objects filtered by the created_date column
 * @psalm-method Collection&\Traversable<ChildShippinglines> findByCreatedDate(string|array<string> $created_date) Return ChildShippinglines objects filtered by the created_date column
 * @method     ChildShippinglines[]|Collection findByIntegrationId(string|array<string> $integration_id) Return ChildShippinglines objects filtered by the integration_id column
 * @psalm-method Collection&\Traversable<ChildShippinglines> findByIntegrationId(string|array<string> $integration_id) Return ChildShippinglines objects filtered by the integration_id column
 *
 * @method     ChildShippinglines[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildShippinglines> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class ShippinglinesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\ShippinglinesQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\Shippinglines', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildShippinglinesQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildShippinglinesQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildShippinglinesQuery) {
            return $criteria;
        }
        $query = new ChildShippinglinesQuery();
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
     * @return ChildShippinglines|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ShippinglinesTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ShippinglinesTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildShippinglines A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT solid, soid, product_id, qty, allocated_qty, rate, company_id, orderline_id, created_date, integration_id FROM shippinglines WHERE solid = :p0';
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
            /** @var ChildShippinglines $obj */
            $obj = new ChildShippinglines();
            $obj->hydrate($row);
            ShippinglinesTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildShippinglines|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(ShippinglinesTableMap::COL_SOLID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(ShippinglinesTableMap::COL_SOLID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the solid column
     *
     * Example usage:
     * <code>
     * $query->filterBySolid(1234); // WHERE solid = 1234
     * $query->filterBySolid(array(12, 34)); // WHERE solid IN (12, 34)
     * $query->filterBySolid(array('min' => 12)); // WHERE solid > 12
     * </code>
     *
     * @param mixed $solid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySolid($solid = null, ?string $comparison = null)
    {
        if (is_array($solid)) {
            $useMinMax = false;
            if (isset($solid['min'])) {
                $this->addUsingAlias(ShippinglinesTableMap::COL_SOLID, $solid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($solid['max'])) {
                $this->addUsingAlias(ShippinglinesTableMap::COL_SOLID, $solid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ShippinglinesTableMap::COL_SOLID, $solid, $comparison);

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
     * @see       filterByShippingorder()
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
                $this->addUsingAlias(ShippinglinesTableMap::COL_SOID, $soid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($soid['max'])) {
                $this->addUsingAlias(ShippinglinesTableMap::COL_SOID, $soid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ShippinglinesTableMap::COL_SOID, $soid, $comparison);

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
                $this->addUsingAlias(ShippinglinesTableMap::COL_PRODUCT_ID, $productId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($productId['max'])) {
                $this->addUsingAlias(ShippinglinesTableMap::COL_PRODUCT_ID, $productId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ShippinglinesTableMap::COL_PRODUCT_ID, $productId, $comparison);

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
                $this->addUsingAlias(ShippinglinesTableMap::COL_QTY, $qty['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($qty['max'])) {
                $this->addUsingAlias(ShippinglinesTableMap::COL_QTY, $qty['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ShippinglinesTableMap::COL_QTY, $qty, $comparison);

        return $this;
    }

    /**
     * Filter the query on the allocated_qty column
     *
     * Example usage:
     * <code>
     * $query->filterByAllocatedQty(1234); // WHERE allocated_qty = 1234
     * $query->filterByAllocatedQty(array(12, 34)); // WHERE allocated_qty IN (12, 34)
     * $query->filterByAllocatedQty(array('min' => 12)); // WHERE allocated_qty > 12
     * </code>
     *
     * @param mixed $allocatedQty The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAllocatedQty($allocatedQty = null, ?string $comparison = null)
    {
        if (is_array($allocatedQty)) {
            $useMinMax = false;
            if (isset($allocatedQty['min'])) {
                $this->addUsingAlias(ShippinglinesTableMap::COL_ALLOCATED_QTY, $allocatedQty['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($allocatedQty['max'])) {
                $this->addUsingAlias(ShippinglinesTableMap::COL_ALLOCATED_QTY, $allocatedQty['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ShippinglinesTableMap::COL_ALLOCATED_QTY, $allocatedQty, $comparison);

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
                $this->addUsingAlias(ShippinglinesTableMap::COL_RATE, $rate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($rate['max'])) {
                $this->addUsingAlias(ShippinglinesTableMap::COL_RATE, $rate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ShippinglinesTableMap::COL_RATE, $rate, $comparison);

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
                $this->addUsingAlias(ShippinglinesTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(ShippinglinesTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ShippinglinesTableMap::COL_COMPANY_ID, $companyId, $comparison);

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
     * @see       filterByOrderlines()
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
                $this->addUsingAlias(ShippinglinesTableMap::COL_ORDERLINE_ID, $orderlineId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($orderlineId['max'])) {
                $this->addUsingAlias(ShippinglinesTableMap::COL_ORDERLINE_ID, $orderlineId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ShippinglinesTableMap::COL_ORDERLINE_ID, $orderlineId, $comparison);

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
                $this->addUsingAlias(ShippinglinesTableMap::COL_CREATED_DATE, $createdDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdDate['max'])) {
                $this->addUsingAlias(ShippinglinesTableMap::COL_CREATED_DATE, $createdDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ShippinglinesTableMap::COL_CREATED_DATE, $createdDate, $comparison);

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

        $this->addUsingAlias(ShippinglinesTableMap::COL_INTEGRATION_ID, $integrationId, $comparison);

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
                ->addUsingAlias(ShippinglinesTableMap::COL_COMPANY_ID, $company->getCompanyId(), $comparison);
        } elseif ($company instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(ShippinglinesTableMap::COL_COMPANY_ID, $company->toKeyValue('PrimaryKey', 'CompanyId'), $comparison);

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
     * Filter the query by a related \entities\Orderlines object
     *
     * @param \entities\Orderlines|ObjectCollection $orderlines The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrderlines($orderlines, ?string $comparison = null)
    {
        if ($orderlines instanceof \entities\Orderlines) {
            return $this
                ->addUsingAlias(ShippinglinesTableMap::COL_ORDERLINE_ID, $orderlines->getOrderlineId(), $comparison);
        } elseif ($orderlines instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(ShippinglinesTableMap::COL_ORDERLINE_ID, $orderlines->toKeyValue('PrimaryKey', 'OrderlineId'), $comparison);

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
                ->addUsingAlias(ShippinglinesTableMap::COL_PRODUCT_ID, $products->getId(), $comparison);
        } elseif ($products instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(ShippinglinesTableMap::COL_PRODUCT_ID, $products->toKeyValue('PrimaryKey', 'Id'), $comparison);

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
     * Filter the query by a related \entities\Shippingorder object
     *
     * @param \entities\Shippingorder|ObjectCollection $shippingorder The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByShippingorder($shippingorder, ?string $comparison = null)
    {
        if ($shippingorder instanceof \entities\Shippingorder) {
            return $this
                ->addUsingAlias(ShippinglinesTableMap::COL_SOID, $shippingorder->getSoid(), $comparison);
        } elseif ($shippingorder instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(ShippinglinesTableMap::COL_SOID, $shippingorder->toKeyValue('PrimaryKey', 'Soid'), $comparison);

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
     * Filter the query by a related \entities\Shippinglineallocation object
     *
     * @param \entities\Shippinglineallocation|ObjectCollection $shippinglineallocation the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByShippinglineallocation($shippinglineallocation, ?string $comparison = null)
    {
        if ($shippinglineallocation instanceof \entities\Shippinglineallocation) {
            $this
                ->addUsingAlias(ShippinglinesTableMap::COL_SOLID, $shippinglineallocation->getSolid(), $comparison);

            return $this;
        } elseif ($shippinglineallocation instanceof ObjectCollection) {
            $this
                ->useShippinglineallocationQuery()
                ->filterByPrimaryKeys($shippinglineallocation->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByShippinglineallocation() only accepts arguments of type \entities\Shippinglineallocation or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Shippinglineallocation relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinShippinglineallocation(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Shippinglineallocation');

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
            $this->addJoinObject($join, 'Shippinglineallocation');
        }

        return $this;
    }

    /**
     * Use the Shippinglineallocation relation Shippinglineallocation object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\ShippinglineallocationQuery A secondary query class using the current class as primary query
     */
    public function useShippinglineallocationQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinShippinglineallocation($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Shippinglineallocation', '\entities\ShippinglineallocationQuery');
    }

    /**
     * Use the Shippinglineallocation relation Shippinglineallocation object
     *
     * @param callable(\entities\ShippinglineallocationQuery):\entities\ShippinglineallocationQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withShippinglineallocationQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useShippinglineallocationQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Shippinglineallocation table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\ShippinglineallocationQuery The inner query object of the EXISTS statement
     */
    public function useShippinglineallocationExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\ShippinglineallocationQuery */
        $q = $this->useExistsQuery('Shippinglineallocation', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Shippinglineallocation table for a NOT EXISTS query.
     *
     * @see useShippinglineallocationExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\ShippinglineallocationQuery The inner query object of the NOT EXISTS statement
     */
    public function useShippinglineallocationNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\ShippinglineallocationQuery */
        $q = $this->useExistsQuery('Shippinglineallocation', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Shippinglineallocation table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\ShippinglineallocationQuery The inner query object of the IN statement
     */
    public function useInShippinglineallocationQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\ShippinglineallocationQuery */
        $q = $this->useInQuery('Shippinglineallocation', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Shippinglineallocation table for a NOT IN query.
     *
     * @see useShippinglineallocationInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\ShippinglineallocationQuery The inner query object of the NOT IN statement
     */
    public function useNotInShippinglineallocationQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\ShippinglineallocationQuery */
        $q = $this->useInQuery('Shippinglineallocation', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildShippinglines $shippinglines Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($shippinglines = null)
    {
        if ($shippinglines) {
            $this->addUsingAlias(ShippinglinesTableMap::COL_SOLID, $shippinglines->getSolid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the shippinglines table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ShippinglinesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ShippinglinesTableMap::clearInstancePool();
            ShippinglinesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ShippinglinesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ShippinglinesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ShippinglinesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ShippinglinesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
