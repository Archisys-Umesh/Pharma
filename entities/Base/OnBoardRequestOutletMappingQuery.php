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
use entities\OnBoardRequestOutletMapping as ChildOnBoardRequestOutletMapping;
use entities\OnBoardRequestOutletMappingQuery as ChildOnBoardRequestOutletMappingQuery;
use entities\Map\OnBoardRequestOutletMappingTableMap;

/**
 * Base class that represents a query for the `on_board_request_outlet_mapping` table.
 *
 * @method     ChildOnBoardRequestOutletMappingQuery orderByOnBoardRequestOutletMappingId($order = Criteria::ASC) Order by the on_board_request_outlet_mapping_id column
 * @method     ChildOnBoardRequestOutletMappingQuery orderByOnBoardRequestId($order = Criteria::ASC) Order by the on_board_request_id column
 * @method     ChildOnBoardRequestOutletMappingQuery orderByPrimaryOutletId($order = Criteria::ASC) Order by the primary_outlet_id column
 * @method     ChildOnBoardRequestOutletMappingQuery orderByPricebookId($order = Criteria::ASC) Order by the pricebook_id column
 * @method     ChildOnBoardRequestOutletMappingQuery orderByCategory($order = Criteria::ASC) Order by the category column
 * @method     ChildOnBoardRequestOutletMappingQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildOnBoardRequestOutletMappingQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildOnBoardRequestOutletMappingQuery orderBySecondaryOutletId($order = Criteria::ASC) Order by the secondary_outlet_id column
 *
 * @method     ChildOnBoardRequestOutletMappingQuery groupByOnBoardRequestOutletMappingId() Group by the on_board_request_outlet_mapping_id column
 * @method     ChildOnBoardRequestOutletMappingQuery groupByOnBoardRequestId() Group by the on_board_request_id column
 * @method     ChildOnBoardRequestOutletMappingQuery groupByPrimaryOutletId() Group by the primary_outlet_id column
 * @method     ChildOnBoardRequestOutletMappingQuery groupByPricebookId() Group by the pricebook_id column
 * @method     ChildOnBoardRequestOutletMappingQuery groupByCategory() Group by the category column
 * @method     ChildOnBoardRequestOutletMappingQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildOnBoardRequestOutletMappingQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildOnBoardRequestOutletMappingQuery groupBySecondaryOutletId() Group by the secondary_outlet_id column
 *
 * @method     ChildOnBoardRequestOutletMappingQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildOnBoardRequestOutletMappingQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildOnBoardRequestOutletMappingQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildOnBoardRequestOutletMappingQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildOnBoardRequestOutletMappingQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildOnBoardRequestOutletMappingQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildOnBoardRequestOutletMappingQuery leftJoinOnBoardRequest($relationAlias = null) Adds a LEFT JOIN clause to the query using the OnBoardRequest relation
 * @method     ChildOnBoardRequestOutletMappingQuery rightJoinOnBoardRequest($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OnBoardRequest relation
 * @method     ChildOnBoardRequestOutletMappingQuery innerJoinOnBoardRequest($relationAlias = null) Adds a INNER JOIN clause to the query using the OnBoardRequest relation
 *
 * @method     ChildOnBoardRequestOutletMappingQuery joinWithOnBoardRequest($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OnBoardRequest relation
 *
 * @method     ChildOnBoardRequestOutletMappingQuery leftJoinWithOnBoardRequest() Adds a LEFT JOIN clause and with to the query using the OnBoardRequest relation
 * @method     ChildOnBoardRequestOutletMappingQuery rightJoinWithOnBoardRequest() Adds a RIGHT JOIN clause and with to the query using the OnBoardRequest relation
 * @method     ChildOnBoardRequestOutletMappingQuery innerJoinWithOnBoardRequest() Adds a INNER JOIN clause and with to the query using the OnBoardRequest relation
 *
 * @method     ChildOnBoardRequestOutletMappingQuery leftJoinPricebooks($relationAlias = null) Adds a LEFT JOIN clause to the query using the Pricebooks relation
 * @method     ChildOnBoardRequestOutletMappingQuery rightJoinPricebooks($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Pricebooks relation
 * @method     ChildOnBoardRequestOutletMappingQuery innerJoinPricebooks($relationAlias = null) Adds a INNER JOIN clause to the query using the Pricebooks relation
 *
 * @method     ChildOnBoardRequestOutletMappingQuery joinWithPricebooks($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Pricebooks relation
 *
 * @method     ChildOnBoardRequestOutletMappingQuery leftJoinWithPricebooks() Adds a LEFT JOIN clause and with to the query using the Pricebooks relation
 * @method     ChildOnBoardRequestOutletMappingQuery rightJoinWithPricebooks() Adds a RIGHT JOIN clause and with to the query using the Pricebooks relation
 * @method     ChildOnBoardRequestOutletMappingQuery innerJoinWithPricebooks() Adds a INNER JOIN clause and with to the query using the Pricebooks relation
 *
 * @method     \entities\OnBoardRequestQuery|\entities\PricebooksQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildOnBoardRequestOutletMapping|null findOne(?ConnectionInterface $con = null) Return the first ChildOnBoardRequestOutletMapping matching the query
 * @method     ChildOnBoardRequestOutletMapping findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildOnBoardRequestOutletMapping matching the query, or a new ChildOnBoardRequestOutletMapping object populated from the query conditions when no match is found
 *
 * @method     ChildOnBoardRequestOutletMapping|null findOneByOnBoardRequestOutletMappingId(int $on_board_request_outlet_mapping_id) Return the first ChildOnBoardRequestOutletMapping filtered by the on_board_request_outlet_mapping_id column
 * @method     ChildOnBoardRequestOutletMapping|null findOneByOnBoardRequestId(int $on_board_request_id) Return the first ChildOnBoardRequestOutletMapping filtered by the on_board_request_id column
 * @method     ChildOnBoardRequestOutletMapping|null findOneByPrimaryOutletId(int $primary_outlet_id) Return the first ChildOnBoardRequestOutletMapping filtered by the primary_outlet_id column
 * @method     ChildOnBoardRequestOutletMapping|null findOneByPricebookId(int $pricebook_id) Return the first ChildOnBoardRequestOutletMapping filtered by the pricebook_id column
 * @method     ChildOnBoardRequestOutletMapping|null findOneByCategory(string $category) Return the first ChildOnBoardRequestOutletMapping filtered by the category column
 * @method     ChildOnBoardRequestOutletMapping|null findOneByCreatedAt(string $created_at) Return the first ChildOnBoardRequestOutletMapping filtered by the created_at column
 * @method     ChildOnBoardRequestOutletMapping|null findOneByUpdatedAt(string $updated_at) Return the first ChildOnBoardRequestOutletMapping filtered by the updated_at column
 * @method     ChildOnBoardRequestOutletMapping|null findOneBySecondaryOutletId(int $secondary_outlet_id) Return the first ChildOnBoardRequestOutletMapping filtered by the secondary_outlet_id column
 *
 * @method     ChildOnBoardRequestOutletMapping requirePk($key, ?ConnectionInterface $con = null) Return the ChildOnBoardRequestOutletMapping by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnBoardRequestOutletMapping requireOne(?ConnectionInterface $con = null) Return the first ChildOnBoardRequestOutletMapping matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOnBoardRequestOutletMapping requireOneByOnBoardRequestOutletMappingId(int $on_board_request_outlet_mapping_id) Return the first ChildOnBoardRequestOutletMapping filtered by the on_board_request_outlet_mapping_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnBoardRequestOutletMapping requireOneByOnBoardRequestId(int $on_board_request_id) Return the first ChildOnBoardRequestOutletMapping filtered by the on_board_request_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnBoardRequestOutletMapping requireOneByPrimaryOutletId(int $primary_outlet_id) Return the first ChildOnBoardRequestOutletMapping filtered by the primary_outlet_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnBoardRequestOutletMapping requireOneByPricebookId(int $pricebook_id) Return the first ChildOnBoardRequestOutletMapping filtered by the pricebook_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnBoardRequestOutletMapping requireOneByCategory(string $category) Return the first ChildOnBoardRequestOutletMapping filtered by the category column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnBoardRequestOutletMapping requireOneByCreatedAt(string $created_at) Return the first ChildOnBoardRequestOutletMapping filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnBoardRequestOutletMapping requireOneByUpdatedAt(string $updated_at) Return the first ChildOnBoardRequestOutletMapping filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnBoardRequestOutletMapping requireOneBySecondaryOutletId(int $secondary_outlet_id) Return the first ChildOnBoardRequestOutletMapping filtered by the secondary_outlet_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOnBoardRequestOutletMapping[]|Collection find(?ConnectionInterface $con = null) Return ChildOnBoardRequestOutletMapping objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildOnBoardRequestOutletMapping> find(?ConnectionInterface $con = null) Return ChildOnBoardRequestOutletMapping objects based on current ModelCriteria
 *
 * @method     ChildOnBoardRequestOutletMapping[]|Collection findByOnBoardRequestOutletMappingId(int|array<int> $on_board_request_outlet_mapping_id) Return ChildOnBoardRequestOutletMapping objects filtered by the on_board_request_outlet_mapping_id column
 * @psalm-method Collection&\Traversable<ChildOnBoardRequestOutletMapping> findByOnBoardRequestOutletMappingId(int|array<int> $on_board_request_outlet_mapping_id) Return ChildOnBoardRequestOutletMapping objects filtered by the on_board_request_outlet_mapping_id column
 * @method     ChildOnBoardRequestOutletMapping[]|Collection findByOnBoardRequestId(int|array<int> $on_board_request_id) Return ChildOnBoardRequestOutletMapping objects filtered by the on_board_request_id column
 * @psalm-method Collection&\Traversable<ChildOnBoardRequestOutletMapping> findByOnBoardRequestId(int|array<int> $on_board_request_id) Return ChildOnBoardRequestOutletMapping objects filtered by the on_board_request_id column
 * @method     ChildOnBoardRequestOutletMapping[]|Collection findByPrimaryOutletId(int|array<int> $primary_outlet_id) Return ChildOnBoardRequestOutletMapping objects filtered by the primary_outlet_id column
 * @psalm-method Collection&\Traversable<ChildOnBoardRequestOutletMapping> findByPrimaryOutletId(int|array<int> $primary_outlet_id) Return ChildOnBoardRequestOutletMapping objects filtered by the primary_outlet_id column
 * @method     ChildOnBoardRequestOutletMapping[]|Collection findByPricebookId(int|array<int> $pricebook_id) Return ChildOnBoardRequestOutletMapping objects filtered by the pricebook_id column
 * @psalm-method Collection&\Traversable<ChildOnBoardRequestOutletMapping> findByPricebookId(int|array<int> $pricebook_id) Return ChildOnBoardRequestOutletMapping objects filtered by the pricebook_id column
 * @method     ChildOnBoardRequestOutletMapping[]|Collection findByCategory(string|array<string> $category) Return ChildOnBoardRequestOutletMapping objects filtered by the category column
 * @psalm-method Collection&\Traversable<ChildOnBoardRequestOutletMapping> findByCategory(string|array<string> $category) Return ChildOnBoardRequestOutletMapping objects filtered by the category column
 * @method     ChildOnBoardRequestOutletMapping[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildOnBoardRequestOutletMapping objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildOnBoardRequestOutletMapping> findByCreatedAt(string|array<string> $created_at) Return ChildOnBoardRequestOutletMapping objects filtered by the created_at column
 * @method     ChildOnBoardRequestOutletMapping[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildOnBoardRequestOutletMapping objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildOnBoardRequestOutletMapping> findByUpdatedAt(string|array<string> $updated_at) Return ChildOnBoardRequestOutletMapping objects filtered by the updated_at column
 * @method     ChildOnBoardRequestOutletMapping[]|Collection findBySecondaryOutletId(int|array<int> $secondary_outlet_id) Return ChildOnBoardRequestOutletMapping objects filtered by the secondary_outlet_id column
 * @psalm-method Collection&\Traversable<ChildOnBoardRequestOutletMapping> findBySecondaryOutletId(int|array<int> $secondary_outlet_id) Return ChildOnBoardRequestOutletMapping objects filtered by the secondary_outlet_id column
 *
 * @method     ChildOnBoardRequestOutletMapping[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildOnBoardRequestOutletMapping> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class OnBoardRequestOutletMappingQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\OnBoardRequestOutletMappingQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\OnBoardRequestOutletMapping', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildOnBoardRequestOutletMappingQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildOnBoardRequestOutletMappingQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildOnBoardRequestOutletMappingQuery) {
            return $criteria;
        }
        $query = new ChildOnBoardRequestOutletMappingQuery();
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
     * @return ChildOnBoardRequestOutletMapping|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(OnBoardRequestOutletMappingTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = OnBoardRequestOutletMappingTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildOnBoardRequestOutletMapping A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT on_board_request_outlet_mapping_id, on_board_request_id, primary_outlet_id, pricebook_id, category, created_at, updated_at, secondary_outlet_id FROM on_board_request_outlet_mapping WHERE on_board_request_outlet_mapping_id = :p0';
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
            /** @var ChildOnBoardRequestOutletMapping $obj */
            $obj = new ChildOnBoardRequestOutletMapping();
            $obj->hydrate($row);
            OnBoardRequestOutletMappingTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildOnBoardRequestOutletMapping|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(OnBoardRequestOutletMappingTableMap::COL_ON_BOARD_REQUEST_OUTLET_MAPPING_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(OnBoardRequestOutletMappingTableMap::COL_ON_BOARD_REQUEST_OUTLET_MAPPING_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the on_board_request_outlet_mapping_id column
     *
     * Example usage:
     * <code>
     * $query->filterByOnBoardRequestOutletMappingId(1234); // WHERE on_board_request_outlet_mapping_id = 1234
     * $query->filterByOnBoardRequestOutletMappingId(array(12, 34)); // WHERE on_board_request_outlet_mapping_id IN (12, 34)
     * $query->filterByOnBoardRequestOutletMappingId(array('min' => 12)); // WHERE on_board_request_outlet_mapping_id > 12
     * </code>
     *
     * @param mixed $onBoardRequestOutletMappingId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOnBoardRequestOutletMappingId($onBoardRequestOutletMappingId = null, ?string $comparison = null)
    {
        if (is_array($onBoardRequestOutletMappingId)) {
            $useMinMax = false;
            if (isset($onBoardRequestOutletMappingId['min'])) {
                $this->addUsingAlias(OnBoardRequestOutletMappingTableMap::COL_ON_BOARD_REQUEST_OUTLET_MAPPING_ID, $onBoardRequestOutletMappingId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($onBoardRequestOutletMappingId['max'])) {
                $this->addUsingAlias(OnBoardRequestOutletMappingTableMap::COL_ON_BOARD_REQUEST_OUTLET_MAPPING_ID, $onBoardRequestOutletMappingId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnBoardRequestOutletMappingTableMap::COL_ON_BOARD_REQUEST_OUTLET_MAPPING_ID, $onBoardRequestOutletMappingId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the on_board_request_id column
     *
     * Example usage:
     * <code>
     * $query->filterByOnBoardRequestId(1234); // WHERE on_board_request_id = 1234
     * $query->filterByOnBoardRequestId(array(12, 34)); // WHERE on_board_request_id IN (12, 34)
     * $query->filterByOnBoardRequestId(array('min' => 12)); // WHERE on_board_request_id > 12
     * </code>
     *
     * @see       filterByOnBoardRequest()
     *
     * @param mixed $onBoardRequestId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOnBoardRequestId($onBoardRequestId = null, ?string $comparison = null)
    {
        if (is_array($onBoardRequestId)) {
            $useMinMax = false;
            if (isset($onBoardRequestId['min'])) {
                $this->addUsingAlias(OnBoardRequestOutletMappingTableMap::COL_ON_BOARD_REQUEST_ID, $onBoardRequestId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($onBoardRequestId['max'])) {
                $this->addUsingAlias(OnBoardRequestOutletMappingTableMap::COL_ON_BOARD_REQUEST_ID, $onBoardRequestId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnBoardRequestOutletMappingTableMap::COL_ON_BOARD_REQUEST_ID, $onBoardRequestId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the primary_outlet_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPrimaryOutletId(1234); // WHERE primary_outlet_id = 1234
     * $query->filterByPrimaryOutletId(array(12, 34)); // WHERE primary_outlet_id IN (12, 34)
     * $query->filterByPrimaryOutletId(array('min' => 12)); // WHERE primary_outlet_id > 12
     * </code>
     *
     * @param mixed $primaryOutletId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrimaryOutletId($primaryOutletId = null, ?string $comparison = null)
    {
        if (is_array($primaryOutletId)) {
            $useMinMax = false;
            if (isset($primaryOutletId['min'])) {
                $this->addUsingAlias(OnBoardRequestOutletMappingTableMap::COL_PRIMARY_OUTLET_ID, $primaryOutletId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($primaryOutletId['max'])) {
                $this->addUsingAlias(OnBoardRequestOutletMappingTableMap::COL_PRIMARY_OUTLET_ID, $primaryOutletId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnBoardRequestOutletMappingTableMap::COL_PRIMARY_OUTLET_ID, $primaryOutletId, $comparison);

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
                $this->addUsingAlias(OnBoardRequestOutletMappingTableMap::COL_PRICEBOOK_ID, $pricebookId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($pricebookId['max'])) {
                $this->addUsingAlias(OnBoardRequestOutletMappingTableMap::COL_PRICEBOOK_ID, $pricebookId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnBoardRequestOutletMappingTableMap::COL_PRICEBOOK_ID, $pricebookId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the category column
     *
     * Example usage:
     * <code>
     * $query->filterByCategory('fooValue');   // WHERE category = 'fooValue'
     * $query->filterByCategory('%fooValue%', Criteria::LIKE); // WHERE category LIKE '%fooValue%'
     * $query->filterByCategory(['foo', 'bar']); // WHERE category IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $category The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCategory($category = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($category)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnBoardRequestOutletMappingTableMap::COL_CATEGORY, $category, $comparison);

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
                $this->addUsingAlias(OnBoardRequestOutletMappingTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(OnBoardRequestOutletMappingTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnBoardRequestOutletMappingTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(OnBoardRequestOutletMappingTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(OnBoardRequestOutletMappingTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnBoardRequestOutletMappingTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the secondary_outlet_id column
     *
     * Example usage:
     * <code>
     * $query->filterBySecondaryOutletId(1234); // WHERE secondary_outlet_id = 1234
     * $query->filterBySecondaryOutletId(array(12, 34)); // WHERE secondary_outlet_id IN (12, 34)
     * $query->filterBySecondaryOutletId(array('min' => 12)); // WHERE secondary_outlet_id > 12
     * </code>
     *
     * @param mixed $secondaryOutletId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySecondaryOutletId($secondaryOutletId = null, ?string $comparison = null)
    {
        if (is_array($secondaryOutletId)) {
            $useMinMax = false;
            if (isset($secondaryOutletId['min'])) {
                $this->addUsingAlias(OnBoardRequestOutletMappingTableMap::COL_SECONDARY_OUTLET_ID, $secondaryOutletId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($secondaryOutletId['max'])) {
                $this->addUsingAlias(OnBoardRequestOutletMappingTableMap::COL_SECONDARY_OUTLET_ID, $secondaryOutletId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnBoardRequestOutletMappingTableMap::COL_SECONDARY_OUTLET_ID, $secondaryOutletId, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \entities\OnBoardRequest object
     *
     * @param \entities\OnBoardRequest|ObjectCollection $onBoardRequest The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOnBoardRequest($onBoardRequest, ?string $comparison = null)
    {
        if ($onBoardRequest instanceof \entities\OnBoardRequest) {
            return $this
                ->addUsingAlias(OnBoardRequestOutletMappingTableMap::COL_ON_BOARD_REQUEST_ID, $onBoardRequest->getOnBoardRequestId(), $comparison);
        } elseif ($onBoardRequest instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(OnBoardRequestOutletMappingTableMap::COL_ON_BOARD_REQUEST_ID, $onBoardRequest->toKeyValue('PrimaryKey', 'OnBoardRequestId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByOnBoardRequest() only accepts arguments of type \entities\OnBoardRequest or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OnBoardRequest relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOnBoardRequest(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OnBoardRequest');

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
            $this->addJoinObject($join, 'OnBoardRequest');
        }

        return $this;
    }

    /**
     * Use the OnBoardRequest relation OnBoardRequest object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\OnBoardRequestQuery A secondary query class using the current class as primary query
     */
    public function useOnBoardRequestQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinOnBoardRequest($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OnBoardRequest', '\entities\OnBoardRequestQuery');
    }

    /**
     * Use the OnBoardRequest relation OnBoardRequest object
     *
     * @param callable(\entities\OnBoardRequestQuery):\entities\OnBoardRequestQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOnBoardRequestQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useOnBoardRequestQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to OnBoardRequest table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\OnBoardRequestQuery The inner query object of the EXISTS statement
     */
    public function useOnBoardRequestExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\OnBoardRequestQuery */
        $q = $this->useExistsQuery('OnBoardRequest', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to OnBoardRequest table for a NOT EXISTS query.
     *
     * @see useOnBoardRequestExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\OnBoardRequestQuery The inner query object of the NOT EXISTS statement
     */
    public function useOnBoardRequestNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OnBoardRequestQuery */
        $q = $this->useExistsQuery('OnBoardRequest', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to OnBoardRequest table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\OnBoardRequestQuery The inner query object of the IN statement
     */
    public function useInOnBoardRequestQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\OnBoardRequestQuery */
        $q = $this->useInQuery('OnBoardRequest', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to OnBoardRequest table for a NOT IN query.
     *
     * @see useOnBoardRequestInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\OnBoardRequestQuery The inner query object of the NOT IN statement
     */
    public function useNotInOnBoardRequestQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OnBoardRequestQuery */
        $q = $this->useInQuery('OnBoardRequest', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(OnBoardRequestOutletMappingTableMap::COL_PRICEBOOK_ID, $pricebooks->getPricebookId(), $comparison);
        } elseif ($pricebooks instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(OnBoardRequestOutletMappingTableMap::COL_PRICEBOOK_ID, $pricebooks->toKeyValue('PrimaryKey', 'PricebookId'), $comparison);

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
     * Exclude object from result
     *
     * @param ChildOnBoardRequestOutletMapping $onBoardRequestOutletMapping Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($onBoardRequestOutletMapping = null)
    {
        if ($onBoardRequestOutletMapping) {
            $this->addUsingAlias(OnBoardRequestOutletMappingTableMap::COL_ON_BOARD_REQUEST_OUTLET_MAPPING_ID, $onBoardRequestOutletMapping->getOnBoardRequestOutletMappingId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the on_board_request_outlet_mapping table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OnBoardRequestOutletMappingTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            OnBoardRequestOutletMappingTableMap::clearInstancePool();
            OnBoardRequestOutletMappingTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(OnBoardRequestOutletMappingTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(OnBoardRequestOutletMappingTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            OnBoardRequestOutletMappingTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            OnBoardRequestOutletMappingTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
