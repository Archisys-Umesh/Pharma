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
use entities\Pricebooklines as ChildPricebooklines;
use entities\PricebooklinesQuery as ChildPricebooklinesQuery;
use entities\Map\PricebooklinesTableMap;

/**
 * Base class that represents a query for the `pricebooklines` table.
 *
 * @method     ChildPricebooklinesQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildPricebooklinesQuery orderByPricebookId($order = Criteria::ASC) Order by the pricebook_id column
 * @method     ChildPricebooklinesQuery orderByProductId($order = Criteria::ASC) Order by the product_id column
 * @method     ChildPricebooklinesQuery orderByMaxRetailPrice($order = Criteria::ASC) Order by the max_retail_price column
 * @method     ChildPricebooklinesQuery orderBySellingPrice($order = Criteria::ASC) Order by the selling_price column
 * @method     ChildPricebooklinesQuery orderByAdditionalRemark($order = Criteria::ASC) Order by the additional_remark column
 * @method     ChildPricebooklinesQuery orderByIsenabled($order = Criteria::ASC) Order by the isenabled column
 * @method     ChildPricebooklinesQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildPricebooklinesQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildPricebooklinesQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildPricebooklinesQuery groupById() Group by the id column
 * @method     ChildPricebooklinesQuery groupByPricebookId() Group by the pricebook_id column
 * @method     ChildPricebooklinesQuery groupByProductId() Group by the product_id column
 * @method     ChildPricebooklinesQuery groupByMaxRetailPrice() Group by the max_retail_price column
 * @method     ChildPricebooklinesQuery groupBySellingPrice() Group by the selling_price column
 * @method     ChildPricebooklinesQuery groupByAdditionalRemark() Group by the additional_remark column
 * @method     ChildPricebooklinesQuery groupByIsenabled() Group by the isenabled column
 * @method     ChildPricebooklinesQuery groupByCompanyId() Group by the company_id column
 * @method     ChildPricebooklinesQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildPricebooklinesQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildPricebooklinesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPricebooklinesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPricebooklinesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPricebooklinesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildPricebooklinesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildPricebooklinesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildPricebooklinesQuery leftJoinProducts($relationAlias = null) Adds a LEFT JOIN clause to the query using the Products relation
 * @method     ChildPricebooklinesQuery rightJoinProducts($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Products relation
 * @method     ChildPricebooklinesQuery innerJoinProducts($relationAlias = null) Adds a INNER JOIN clause to the query using the Products relation
 *
 * @method     ChildPricebooklinesQuery joinWithProducts($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Products relation
 *
 * @method     ChildPricebooklinesQuery leftJoinWithProducts() Adds a LEFT JOIN clause and with to the query using the Products relation
 * @method     ChildPricebooklinesQuery rightJoinWithProducts() Adds a RIGHT JOIN clause and with to the query using the Products relation
 * @method     ChildPricebooklinesQuery innerJoinWithProducts() Adds a INNER JOIN clause and with to the query using the Products relation
 *
 * @method     ChildPricebooklinesQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildPricebooklinesQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildPricebooklinesQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildPricebooklinesQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildPricebooklinesQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildPricebooklinesQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildPricebooklinesQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     ChildPricebooklinesQuery leftJoinPricebooks($relationAlias = null) Adds a LEFT JOIN clause to the query using the Pricebooks relation
 * @method     ChildPricebooklinesQuery rightJoinPricebooks($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Pricebooks relation
 * @method     ChildPricebooklinesQuery innerJoinPricebooks($relationAlias = null) Adds a INNER JOIN clause to the query using the Pricebooks relation
 *
 * @method     ChildPricebooklinesQuery joinWithPricebooks($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Pricebooks relation
 *
 * @method     ChildPricebooklinesQuery leftJoinWithPricebooks() Adds a LEFT JOIN clause and with to the query using the Pricebooks relation
 * @method     ChildPricebooklinesQuery rightJoinWithPricebooks() Adds a RIGHT JOIN clause and with to the query using the Pricebooks relation
 * @method     ChildPricebooklinesQuery innerJoinWithPricebooks() Adds a INNER JOIN clause and with to the query using the Pricebooks relation
 *
 * @method     \entities\ProductsQuery|\entities\CompanyQuery|\entities\PricebooksQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildPricebooklines|null findOne(?ConnectionInterface $con = null) Return the first ChildPricebooklines matching the query
 * @method     ChildPricebooklines findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildPricebooklines matching the query, or a new ChildPricebooklines object populated from the query conditions when no match is found
 *
 * @method     ChildPricebooklines|null findOneById(int $id) Return the first ChildPricebooklines filtered by the id column
 * @method     ChildPricebooklines|null findOneByPricebookId(int $pricebook_id) Return the first ChildPricebooklines filtered by the pricebook_id column
 * @method     ChildPricebooklines|null findOneByProductId(int $product_id) Return the first ChildPricebooklines filtered by the product_id column
 * @method     ChildPricebooklines|null findOneByMaxRetailPrice(string $max_retail_price) Return the first ChildPricebooklines filtered by the max_retail_price column
 * @method     ChildPricebooklines|null findOneBySellingPrice(string $selling_price) Return the first ChildPricebooklines filtered by the selling_price column
 * @method     ChildPricebooklines|null findOneByAdditionalRemark(string $additional_remark) Return the first ChildPricebooklines filtered by the additional_remark column
 * @method     ChildPricebooklines|null findOneByIsenabled(int $isenabled) Return the first ChildPricebooklines filtered by the isenabled column
 * @method     ChildPricebooklines|null findOneByCompanyId(int $company_id) Return the first ChildPricebooklines filtered by the company_id column
 * @method     ChildPricebooklines|null findOneByCreatedAt(string $created_at) Return the first ChildPricebooklines filtered by the created_at column
 * @method     ChildPricebooklines|null findOneByUpdatedAt(string $updated_at) Return the first ChildPricebooklines filtered by the updated_at column
 *
 * @method     ChildPricebooklines requirePk($key, ?ConnectionInterface $con = null) Return the ChildPricebooklines by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPricebooklines requireOne(?ConnectionInterface $con = null) Return the first ChildPricebooklines matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPricebooklines requireOneById(int $id) Return the first ChildPricebooklines filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPricebooklines requireOneByPricebookId(int $pricebook_id) Return the first ChildPricebooklines filtered by the pricebook_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPricebooklines requireOneByProductId(int $product_id) Return the first ChildPricebooklines filtered by the product_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPricebooklines requireOneByMaxRetailPrice(string $max_retail_price) Return the first ChildPricebooklines filtered by the max_retail_price column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPricebooklines requireOneBySellingPrice(string $selling_price) Return the first ChildPricebooklines filtered by the selling_price column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPricebooklines requireOneByAdditionalRemark(string $additional_remark) Return the first ChildPricebooklines filtered by the additional_remark column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPricebooklines requireOneByIsenabled(int $isenabled) Return the first ChildPricebooklines filtered by the isenabled column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPricebooklines requireOneByCompanyId(int $company_id) Return the first ChildPricebooklines filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPricebooklines requireOneByCreatedAt(string $created_at) Return the first ChildPricebooklines filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPricebooklines requireOneByUpdatedAt(string $updated_at) Return the first ChildPricebooklines filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPricebooklines[]|Collection find(?ConnectionInterface $con = null) Return ChildPricebooklines objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildPricebooklines> find(?ConnectionInterface $con = null) Return ChildPricebooklines objects based on current ModelCriteria
 *
 * @method     ChildPricebooklines[]|Collection findById(int|array<int> $id) Return ChildPricebooklines objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildPricebooklines> findById(int|array<int> $id) Return ChildPricebooklines objects filtered by the id column
 * @method     ChildPricebooklines[]|Collection findByPricebookId(int|array<int> $pricebook_id) Return ChildPricebooklines objects filtered by the pricebook_id column
 * @psalm-method Collection&\Traversable<ChildPricebooklines> findByPricebookId(int|array<int> $pricebook_id) Return ChildPricebooklines objects filtered by the pricebook_id column
 * @method     ChildPricebooklines[]|Collection findByProductId(int|array<int> $product_id) Return ChildPricebooklines objects filtered by the product_id column
 * @psalm-method Collection&\Traversable<ChildPricebooklines> findByProductId(int|array<int> $product_id) Return ChildPricebooklines objects filtered by the product_id column
 * @method     ChildPricebooklines[]|Collection findByMaxRetailPrice(string|array<string> $max_retail_price) Return ChildPricebooklines objects filtered by the max_retail_price column
 * @psalm-method Collection&\Traversable<ChildPricebooklines> findByMaxRetailPrice(string|array<string> $max_retail_price) Return ChildPricebooklines objects filtered by the max_retail_price column
 * @method     ChildPricebooklines[]|Collection findBySellingPrice(string|array<string> $selling_price) Return ChildPricebooklines objects filtered by the selling_price column
 * @psalm-method Collection&\Traversable<ChildPricebooklines> findBySellingPrice(string|array<string> $selling_price) Return ChildPricebooklines objects filtered by the selling_price column
 * @method     ChildPricebooklines[]|Collection findByAdditionalRemark(string|array<string> $additional_remark) Return ChildPricebooklines objects filtered by the additional_remark column
 * @psalm-method Collection&\Traversable<ChildPricebooklines> findByAdditionalRemark(string|array<string> $additional_remark) Return ChildPricebooklines objects filtered by the additional_remark column
 * @method     ChildPricebooklines[]|Collection findByIsenabled(int|array<int> $isenabled) Return ChildPricebooklines objects filtered by the isenabled column
 * @psalm-method Collection&\Traversable<ChildPricebooklines> findByIsenabled(int|array<int> $isenabled) Return ChildPricebooklines objects filtered by the isenabled column
 * @method     ChildPricebooklines[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildPricebooklines objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildPricebooklines> findByCompanyId(int|array<int> $company_id) Return ChildPricebooklines objects filtered by the company_id column
 * @method     ChildPricebooklines[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildPricebooklines objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildPricebooklines> findByCreatedAt(string|array<string> $created_at) Return ChildPricebooklines objects filtered by the created_at column
 * @method     ChildPricebooklines[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildPricebooklines objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildPricebooklines> findByUpdatedAt(string|array<string> $updated_at) Return ChildPricebooklines objects filtered by the updated_at column
 *
 * @method     ChildPricebooklines[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildPricebooklines> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class PricebooklinesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\PricebooklinesQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\Pricebooklines', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPricebooklinesQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPricebooklinesQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildPricebooklinesQuery) {
            return $criteria;
        }
        $query = new ChildPricebooklinesQuery();
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
     * @return ChildPricebooklines|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PricebooklinesTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = PricebooklinesTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildPricebooklines A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, pricebook_id, product_id, max_retail_price, selling_price, additional_remark, isenabled, company_id, created_at, updated_at FROM pricebooklines WHERE id = :p0';
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
            /** @var ChildPricebooklines $obj */
            $obj = new ChildPricebooklines();
            $obj->hydrate($row);
            PricebooklinesTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildPricebooklines|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(PricebooklinesTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(PricebooklinesTableMap::COL_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterById($id = null, ?string $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(PricebooklinesTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(PricebooklinesTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PricebooklinesTableMap::COL_ID, $id, $comparison);

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
                $this->addUsingAlias(PricebooklinesTableMap::COL_PRICEBOOK_ID, $pricebookId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($pricebookId['max'])) {
                $this->addUsingAlias(PricebooklinesTableMap::COL_PRICEBOOK_ID, $pricebookId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PricebooklinesTableMap::COL_PRICEBOOK_ID, $pricebookId, $comparison);

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
                $this->addUsingAlias(PricebooklinesTableMap::COL_PRODUCT_ID, $productId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($productId['max'])) {
                $this->addUsingAlias(PricebooklinesTableMap::COL_PRODUCT_ID, $productId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PricebooklinesTableMap::COL_PRODUCT_ID, $productId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the max_retail_price column
     *
     * Example usage:
     * <code>
     * $query->filterByMaxRetailPrice(1234); // WHERE max_retail_price = 1234
     * $query->filterByMaxRetailPrice(array(12, 34)); // WHERE max_retail_price IN (12, 34)
     * $query->filterByMaxRetailPrice(array('min' => 12)); // WHERE max_retail_price > 12
     * </code>
     *
     * @param mixed $maxRetailPrice The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMaxRetailPrice($maxRetailPrice = null, ?string $comparison = null)
    {
        if (is_array($maxRetailPrice)) {
            $useMinMax = false;
            if (isset($maxRetailPrice['min'])) {
                $this->addUsingAlias(PricebooklinesTableMap::COL_MAX_RETAIL_PRICE, $maxRetailPrice['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($maxRetailPrice['max'])) {
                $this->addUsingAlias(PricebooklinesTableMap::COL_MAX_RETAIL_PRICE, $maxRetailPrice['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PricebooklinesTableMap::COL_MAX_RETAIL_PRICE, $maxRetailPrice, $comparison);

        return $this;
    }

    /**
     * Filter the query on the selling_price column
     *
     * Example usage:
     * <code>
     * $query->filterBySellingPrice(1234); // WHERE selling_price = 1234
     * $query->filterBySellingPrice(array(12, 34)); // WHERE selling_price IN (12, 34)
     * $query->filterBySellingPrice(array('min' => 12)); // WHERE selling_price > 12
     * </code>
     *
     * @param mixed $sellingPrice The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySellingPrice($sellingPrice = null, ?string $comparison = null)
    {
        if (is_array($sellingPrice)) {
            $useMinMax = false;
            if (isset($sellingPrice['min'])) {
                $this->addUsingAlias(PricebooklinesTableMap::COL_SELLING_PRICE, $sellingPrice['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($sellingPrice['max'])) {
                $this->addUsingAlias(PricebooklinesTableMap::COL_SELLING_PRICE, $sellingPrice['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PricebooklinesTableMap::COL_SELLING_PRICE, $sellingPrice, $comparison);

        return $this;
    }

    /**
     * Filter the query on the additional_remark column
     *
     * Example usage:
     * <code>
     * $query->filterByAdditionalRemark('fooValue');   // WHERE additional_remark = 'fooValue'
     * $query->filterByAdditionalRemark('%fooValue%', Criteria::LIKE); // WHERE additional_remark LIKE '%fooValue%'
     * $query->filterByAdditionalRemark(['foo', 'bar']); // WHERE additional_remark IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $additionalRemark The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAdditionalRemark($additionalRemark = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($additionalRemark)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PricebooklinesTableMap::COL_ADDITIONAL_REMARK, $additionalRemark, $comparison);

        return $this;
    }

    /**
     * Filter the query on the isenabled column
     *
     * Example usage:
     * <code>
     * $query->filterByIsenabled(1234); // WHERE isenabled = 1234
     * $query->filterByIsenabled(array(12, 34)); // WHERE isenabled IN (12, 34)
     * $query->filterByIsenabled(array('min' => 12)); // WHERE isenabled > 12
     * </code>
     *
     * @param mixed $isenabled The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIsenabled($isenabled = null, ?string $comparison = null)
    {
        if (is_array($isenabled)) {
            $useMinMax = false;
            if (isset($isenabled['min'])) {
                $this->addUsingAlias(PricebooklinesTableMap::COL_ISENABLED, $isenabled['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($isenabled['max'])) {
                $this->addUsingAlias(PricebooklinesTableMap::COL_ISENABLED, $isenabled['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PricebooklinesTableMap::COL_ISENABLED, $isenabled, $comparison);

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
                $this->addUsingAlias(PricebooklinesTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(PricebooklinesTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PricebooklinesTableMap::COL_COMPANY_ID, $companyId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the created_at column
     *
     * Example usage:
     * <code>
     * $query->filterByCreatedAt('2011-03-14'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt('now'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt(array('max' => 'yesterday')); // WHERE created_at > '2011-03-13'
     * </code>
     *
     * @param mixed $createdAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, ?string $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(PricebooklinesTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(PricebooklinesTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PricebooklinesTableMap::COL_CREATED_AT, $createdAt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the updated_at column
     *
     * Example usage:
     * <code>
     * $query->filterByUpdatedAt('2011-03-14'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt('now'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt(array('max' => 'yesterday')); // WHERE updated_at > '2011-03-13'
     * </code>
     *
     * @param mixed $updatedAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, ?string $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(PricebooklinesTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(PricebooklinesTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PricebooklinesTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
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
                ->addUsingAlias(PricebooklinesTableMap::COL_PRODUCT_ID, $products->getId(), $comparison);
        } elseif ($products instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(PricebooklinesTableMap::COL_PRODUCT_ID, $products->toKeyValue('PrimaryKey', 'Id'), $comparison);

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
                ->addUsingAlias(PricebooklinesTableMap::COL_COMPANY_ID, $company->getCompanyId(), $comparison);
        } elseif ($company instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(PricebooklinesTableMap::COL_COMPANY_ID, $company->toKeyValue('PrimaryKey', 'CompanyId'), $comparison);

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
                ->addUsingAlias(PricebooklinesTableMap::COL_PRICEBOOK_ID, $pricebooks->getPricebookId(), $comparison);
        } elseif ($pricebooks instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(PricebooklinesTableMap::COL_PRICEBOOK_ID, $pricebooks->toKeyValue('PrimaryKey', 'PricebookId'), $comparison);

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
    public function joinPricebooks(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
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
    public function usePricebooksQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
        ?string $joinType = Criteria::INNER_JOIN
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
     * Exclude object from result
     *
     * @param ChildPricebooklines $pricebooklines Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($pricebooklines = null)
    {
        if ($pricebooklines) {
            $this->addUsingAlias(PricebooklinesTableMap::COL_ID, $pricebooklines->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the pricebooklines table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PricebooklinesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PricebooklinesTableMap::clearInstancePool();
            PricebooklinesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(PricebooklinesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PricebooklinesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            PricebooklinesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            PricebooklinesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
