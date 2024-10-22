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
use entities\OutletMapping as ChildOutletMapping;
use entities\OutletMappingQuery as ChildOutletMappingQuery;
use entities\Map\OutletMappingTableMap;

/**
 * Base class that represents a query for the `outlet_mapping` table.
 *
 * @method     ChildOutletMappingQuery orderByMappingId($order = Criteria::ASC) Order by the mapping_id column
 * @method     ChildOutletMappingQuery orderByPrimaryOutletId($order = Criteria::ASC) Order by the primary_outlet_id column
 * @method     ChildOutletMappingQuery orderBySecondaryOutletId($order = Criteria::ASC) Order by the secondary_outlet_id column
 * @method     ChildOutletMappingQuery orderByPricebookId($order = Criteria::ASC) Order by the pricebook_id column
 * @method     ChildOutletMappingQuery orderByIsdefault($order = Criteria::ASC) Order by the isdefault column
 * @method     ChildOutletMappingQuery orderByCategoryType($order = Criteria::ASC) Order by the category_type column
 * @method     ChildOutletMappingQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildOutletMappingQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildOutletMappingQuery groupByMappingId() Group by the mapping_id column
 * @method     ChildOutletMappingQuery groupByPrimaryOutletId() Group by the primary_outlet_id column
 * @method     ChildOutletMappingQuery groupBySecondaryOutletId() Group by the secondary_outlet_id column
 * @method     ChildOutletMappingQuery groupByPricebookId() Group by the pricebook_id column
 * @method     ChildOutletMappingQuery groupByIsdefault() Group by the isdefault column
 * @method     ChildOutletMappingQuery groupByCategoryType() Group by the category_type column
 * @method     ChildOutletMappingQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildOutletMappingQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildOutletMappingQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildOutletMappingQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildOutletMappingQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildOutletMappingQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildOutletMappingQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildOutletMappingQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildOutletMappingQuery leftJoinOutlets($relationAlias = null) Adds a LEFT JOIN clause to the query using the Outlets relation
 * @method     ChildOutletMappingQuery rightJoinOutlets($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Outlets relation
 * @method     ChildOutletMappingQuery innerJoinOutlets($relationAlias = null) Adds a INNER JOIN clause to the query using the Outlets relation
 *
 * @method     ChildOutletMappingQuery joinWithOutlets($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Outlets relation
 *
 * @method     ChildOutletMappingQuery leftJoinWithOutlets() Adds a LEFT JOIN clause and with to the query using the Outlets relation
 * @method     ChildOutletMappingQuery rightJoinWithOutlets() Adds a RIGHT JOIN clause and with to the query using the Outlets relation
 * @method     ChildOutletMappingQuery innerJoinWithOutlets() Adds a INNER JOIN clause and with to the query using the Outlets relation
 *
 * @method     ChildOutletMappingQuery leftJoinPricebooks($relationAlias = null) Adds a LEFT JOIN clause to the query using the Pricebooks relation
 * @method     ChildOutletMappingQuery rightJoinPricebooks($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Pricebooks relation
 * @method     ChildOutletMappingQuery innerJoinPricebooks($relationAlias = null) Adds a INNER JOIN clause to the query using the Pricebooks relation
 *
 * @method     ChildOutletMappingQuery joinWithPricebooks($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Pricebooks relation
 *
 * @method     ChildOutletMappingQuery leftJoinWithPricebooks() Adds a LEFT JOIN clause and with to the query using the Pricebooks relation
 * @method     ChildOutletMappingQuery rightJoinWithPricebooks() Adds a RIGHT JOIN clause and with to the query using the Pricebooks relation
 * @method     ChildOutletMappingQuery innerJoinWithPricebooks() Adds a INNER JOIN clause and with to the query using the Pricebooks relation
 *
 * @method     \entities\OutletsQuery|\entities\PricebooksQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildOutletMapping|null findOne(?ConnectionInterface $con = null) Return the first ChildOutletMapping matching the query
 * @method     ChildOutletMapping findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildOutletMapping matching the query, or a new ChildOutletMapping object populated from the query conditions when no match is found
 *
 * @method     ChildOutletMapping|null findOneByMappingId(int $mapping_id) Return the first ChildOutletMapping filtered by the mapping_id column
 * @method     ChildOutletMapping|null findOneByPrimaryOutletId(int $primary_outlet_id) Return the first ChildOutletMapping filtered by the primary_outlet_id column
 * @method     ChildOutletMapping|null findOneBySecondaryOutletId(int $secondary_outlet_id) Return the first ChildOutletMapping filtered by the secondary_outlet_id column
 * @method     ChildOutletMapping|null findOneByPricebookId(int $pricebook_id) Return the first ChildOutletMapping filtered by the pricebook_id column
 * @method     ChildOutletMapping|null findOneByIsdefault(int $isdefault) Return the first ChildOutletMapping filtered by the isdefault column
 * @method     ChildOutletMapping|null findOneByCategoryType(string $category_type) Return the first ChildOutletMapping filtered by the category_type column
 * @method     ChildOutletMapping|null findOneByCreatedAt(string $created_at) Return the first ChildOutletMapping filtered by the created_at column
 * @method     ChildOutletMapping|null findOneByUpdatedAt(string $updated_at) Return the first ChildOutletMapping filtered by the updated_at column
 *
 * @method     ChildOutletMapping requirePk($key, ?ConnectionInterface $con = null) Return the ChildOutletMapping by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletMapping requireOne(?ConnectionInterface $con = null) Return the first ChildOutletMapping matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOutletMapping requireOneByMappingId(int $mapping_id) Return the first ChildOutletMapping filtered by the mapping_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletMapping requireOneByPrimaryOutletId(int $primary_outlet_id) Return the first ChildOutletMapping filtered by the primary_outlet_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletMapping requireOneBySecondaryOutletId(int $secondary_outlet_id) Return the first ChildOutletMapping filtered by the secondary_outlet_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletMapping requireOneByPricebookId(int $pricebook_id) Return the first ChildOutletMapping filtered by the pricebook_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletMapping requireOneByIsdefault(int $isdefault) Return the first ChildOutletMapping filtered by the isdefault column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletMapping requireOneByCategoryType(string $category_type) Return the first ChildOutletMapping filtered by the category_type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletMapping requireOneByCreatedAt(string $created_at) Return the first ChildOutletMapping filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletMapping requireOneByUpdatedAt(string $updated_at) Return the first ChildOutletMapping filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOutletMapping[]|Collection find(?ConnectionInterface $con = null) Return ChildOutletMapping objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildOutletMapping> find(?ConnectionInterface $con = null) Return ChildOutletMapping objects based on current ModelCriteria
 *
 * @method     ChildOutletMapping[]|Collection findByMappingId(int|array<int> $mapping_id) Return ChildOutletMapping objects filtered by the mapping_id column
 * @psalm-method Collection&\Traversable<ChildOutletMapping> findByMappingId(int|array<int> $mapping_id) Return ChildOutletMapping objects filtered by the mapping_id column
 * @method     ChildOutletMapping[]|Collection findByPrimaryOutletId(int|array<int> $primary_outlet_id) Return ChildOutletMapping objects filtered by the primary_outlet_id column
 * @psalm-method Collection&\Traversable<ChildOutletMapping> findByPrimaryOutletId(int|array<int> $primary_outlet_id) Return ChildOutletMapping objects filtered by the primary_outlet_id column
 * @method     ChildOutletMapping[]|Collection findBySecondaryOutletId(int|array<int> $secondary_outlet_id) Return ChildOutletMapping objects filtered by the secondary_outlet_id column
 * @psalm-method Collection&\Traversable<ChildOutletMapping> findBySecondaryOutletId(int|array<int> $secondary_outlet_id) Return ChildOutletMapping objects filtered by the secondary_outlet_id column
 * @method     ChildOutletMapping[]|Collection findByPricebookId(int|array<int> $pricebook_id) Return ChildOutletMapping objects filtered by the pricebook_id column
 * @psalm-method Collection&\Traversable<ChildOutletMapping> findByPricebookId(int|array<int> $pricebook_id) Return ChildOutletMapping objects filtered by the pricebook_id column
 * @method     ChildOutletMapping[]|Collection findByIsdefault(int|array<int> $isdefault) Return ChildOutletMapping objects filtered by the isdefault column
 * @psalm-method Collection&\Traversable<ChildOutletMapping> findByIsdefault(int|array<int> $isdefault) Return ChildOutletMapping objects filtered by the isdefault column
 * @method     ChildOutletMapping[]|Collection findByCategoryType(string|array<string> $category_type) Return ChildOutletMapping objects filtered by the category_type column
 * @psalm-method Collection&\Traversable<ChildOutletMapping> findByCategoryType(string|array<string> $category_type) Return ChildOutletMapping objects filtered by the category_type column
 * @method     ChildOutletMapping[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildOutletMapping objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildOutletMapping> findByCreatedAt(string|array<string> $created_at) Return ChildOutletMapping objects filtered by the created_at column
 * @method     ChildOutletMapping[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildOutletMapping objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildOutletMapping> findByUpdatedAt(string|array<string> $updated_at) Return ChildOutletMapping objects filtered by the updated_at column
 *
 * @method     ChildOutletMapping[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildOutletMapping> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class OutletMappingQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\OutletMappingQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\OutletMapping', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildOutletMappingQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildOutletMappingQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildOutletMappingQuery) {
            return $criteria;
        }
        $query = new ChildOutletMappingQuery();
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
     * @return ChildOutletMapping|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(OutletMappingTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = OutletMappingTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildOutletMapping A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT mapping_id, primary_outlet_id, secondary_outlet_id, pricebook_id, isdefault, category_type, created_at, updated_at FROM outlet_mapping WHERE mapping_id = :p0';
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
            /** @var ChildOutletMapping $obj */
            $obj = new ChildOutletMapping();
            $obj->hydrate($row);
            OutletMappingTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildOutletMapping|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(OutletMappingTableMap::COL_MAPPING_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(OutletMappingTableMap::COL_MAPPING_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the mapping_id column
     *
     * Example usage:
     * <code>
     * $query->filterByMappingId(1234); // WHERE mapping_id = 1234
     * $query->filterByMappingId(array(12, 34)); // WHERE mapping_id IN (12, 34)
     * $query->filterByMappingId(array('min' => 12)); // WHERE mapping_id > 12
     * </code>
     *
     * @param mixed $mappingId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMappingId($mappingId = null, ?string $comparison = null)
    {
        if (is_array($mappingId)) {
            $useMinMax = false;
            if (isset($mappingId['min'])) {
                $this->addUsingAlias(OutletMappingTableMap::COL_MAPPING_ID, $mappingId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($mappingId['max'])) {
                $this->addUsingAlias(OutletMappingTableMap::COL_MAPPING_ID, $mappingId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletMappingTableMap::COL_MAPPING_ID, $mappingId, $comparison);

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
     * @see       filterByOutlets()
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
                $this->addUsingAlias(OutletMappingTableMap::COL_PRIMARY_OUTLET_ID, $primaryOutletId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($primaryOutletId['max'])) {
                $this->addUsingAlias(OutletMappingTableMap::COL_PRIMARY_OUTLET_ID, $primaryOutletId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletMappingTableMap::COL_PRIMARY_OUTLET_ID, $primaryOutletId, $comparison);

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
                $this->addUsingAlias(OutletMappingTableMap::COL_SECONDARY_OUTLET_ID, $secondaryOutletId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($secondaryOutletId['max'])) {
                $this->addUsingAlias(OutletMappingTableMap::COL_SECONDARY_OUTLET_ID, $secondaryOutletId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletMappingTableMap::COL_SECONDARY_OUTLET_ID, $secondaryOutletId, $comparison);

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
                $this->addUsingAlias(OutletMappingTableMap::COL_PRICEBOOK_ID, $pricebookId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($pricebookId['max'])) {
                $this->addUsingAlias(OutletMappingTableMap::COL_PRICEBOOK_ID, $pricebookId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletMappingTableMap::COL_PRICEBOOK_ID, $pricebookId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the isdefault column
     *
     * Example usage:
     * <code>
     * $query->filterByIsdefault(1234); // WHERE isdefault = 1234
     * $query->filterByIsdefault(array(12, 34)); // WHERE isdefault IN (12, 34)
     * $query->filterByIsdefault(array('min' => 12)); // WHERE isdefault > 12
     * </code>
     *
     * @param mixed $isdefault The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIsdefault($isdefault = null, ?string $comparison = null)
    {
        if (is_array($isdefault)) {
            $useMinMax = false;
            if (isset($isdefault['min'])) {
                $this->addUsingAlias(OutletMappingTableMap::COL_ISDEFAULT, $isdefault['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($isdefault['max'])) {
                $this->addUsingAlias(OutletMappingTableMap::COL_ISDEFAULT, $isdefault['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletMappingTableMap::COL_ISDEFAULT, $isdefault, $comparison);

        return $this;
    }

    /**
     * Filter the query on the category_type column
     *
     * Example usage:
     * <code>
     * $query->filterByCategoryType('fooValue');   // WHERE category_type = 'fooValue'
     * $query->filterByCategoryType('%fooValue%', Criteria::LIKE); // WHERE category_type LIKE '%fooValue%'
     * $query->filterByCategoryType(['foo', 'bar']); // WHERE category_type IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $categoryType The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCategoryType($categoryType = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($categoryType)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletMappingTableMap::COL_CATEGORY_TYPE, $categoryType, $comparison);

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
                $this->addUsingAlias(OutletMappingTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(OutletMappingTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletMappingTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(OutletMappingTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(OutletMappingTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletMappingTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
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
    public function filterByOutlets($outlets, ?string $comparison = null)
    {
        if ($outlets instanceof \entities\Outlets) {
            return $this
                ->addUsingAlias(OutletMappingTableMap::COL_PRIMARY_OUTLET_ID, $outlets->getId(), $comparison);
        } elseif ($outlets instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(OutletMappingTableMap::COL_PRIMARY_OUTLET_ID, $outlets->toKeyValue('PrimaryKey', 'Id'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByOutlets() only accepts arguments of type \entities\Outlets or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Outlets relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOutlets(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Outlets');

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
            $this->addJoinObject($join, 'Outlets');
        }

        return $this;
    }

    /**
     * Use the Outlets relation Outlets object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\OutletsQuery A secondary query class using the current class as primary query
     */
    public function useOutletsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinOutlets($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Outlets', '\entities\OutletsQuery');
    }

    /**
     * Use the Outlets relation Outlets object
     *
     * @param callable(\entities\OutletsQuery):\entities\OutletsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOutletsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useOutletsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Outlets table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\OutletsQuery The inner query object of the EXISTS statement
     */
    public function useOutletsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\OutletsQuery */
        $q = $this->useExistsQuery('Outlets', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Outlets table for a NOT EXISTS query.
     *
     * @see useOutletsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\OutletsQuery The inner query object of the NOT EXISTS statement
     */
    public function useOutletsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OutletsQuery */
        $q = $this->useExistsQuery('Outlets', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Outlets table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\OutletsQuery The inner query object of the IN statement
     */
    public function useInOutletsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\OutletsQuery */
        $q = $this->useInQuery('Outlets', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Outlets table for a NOT IN query.
     *
     * @see useOutletsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\OutletsQuery The inner query object of the NOT IN statement
     */
    public function useNotInOutletsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OutletsQuery */
        $q = $this->useInQuery('Outlets', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(OutletMappingTableMap::COL_PRICEBOOK_ID, $pricebooks->getPricebookId(), $comparison);
        } elseif ($pricebooks instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(OutletMappingTableMap::COL_PRICEBOOK_ID, $pricebooks->toKeyValue('PrimaryKey', 'PricebookId'), $comparison);

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
     * @param ChildOutletMapping $outletMapping Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($outletMapping = null)
    {
        if ($outletMapping) {
            $this->addUsingAlias(OutletMappingTableMap::COL_MAPPING_ID, $outletMapping->getMappingId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the outlet_mapping table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OutletMappingTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            OutletMappingTableMap::clearInstancePool();
            OutletMappingTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(OutletMappingTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(OutletMappingTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            OutletMappingTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            OutletMappingTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
