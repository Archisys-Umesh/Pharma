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
use entities\OutletOutcomes as ChildOutletOutcomes;
use entities\OutletOutcomesQuery as ChildOutletOutcomesQuery;
use entities\Map\OutletOutcomesTableMap;

/**
 * Base class that represents a query for the `outlet_outcomes` table.
 *
 * @method     ChildOutletOutcomesQuery orderByOutletOutcomeId($order = Criteria::ASC) Order by the outlet_outcome_id column
 * @method     ChildOutletOutcomesQuery orderByReason($order = Criteria::ASC) Order by the reason column
 * @method     ChildOutletOutcomesQuery orderByType($order = Criteria::ASC) Order by the type column
 * @method     ChildOutletOutcomesQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildOutletOutcomesQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildOutletOutcomesQuery orderByOutletTypeId($order = Criteria::ASC) Order by the outlet_type_id column
 * @method     ChildOutletOutcomesQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 *
 * @method     ChildOutletOutcomesQuery groupByOutletOutcomeId() Group by the outlet_outcome_id column
 * @method     ChildOutletOutcomesQuery groupByReason() Group by the reason column
 * @method     ChildOutletOutcomesQuery groupByType() Group by the type column
 * @method     ChildOutletOutcomesQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildOutletOutcomesQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildOutletOutcomesQuery groupByOutletTypeId() Group by the outlet_type_id column
 * @method     ChildOutletOutcomesQuery groupByCompanyId() Group by the company_id column
 *
 * @method     ChildOutletOutcomesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildOutletOutcomesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildOutletOutcomesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildOutletOutcomesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildOutletOutcomesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildOutletOutcomesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildOutletOutcomesQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildOutletOutcomesQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildOutletOutcomesQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildOutletOutcomesQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildOutletOutcomesQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildOutletOutcomesQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildOutletOutcomesQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     ChildOutletOutcomesQuery leftJoinOutletType($relationAlias = null) Adds a LEFT JOIN clause to the query using the OutletType relation
 * @method     ChildOutletOutcomesQuery rightJoinOutletType($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OutletType relation
 * @method     ChildOutletOutcomesQuery innerJoinOutletType($relationAlias = null) Adds a INNER JOIN clause to the query using the OutletType relation
 *
 * @method     ChildOutletOutcomesQuery joinWithOutletType($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OutletType relation
 *
 * @method     ChildOutletOutcomesQuery leftJoinWithOutletType() Adds a LEFT JOIN clause and with to the query using the OutletType relation
 * @method     ChildOutletOutcomesQuery rightJoinWithOutletType() Adds a RIGHT JOIN clause and with to the query using the OutletType relation
 * @method     ChildOutletOutcomesQuery innerJoinWithOutletType() Adds a INNER JOIN clause and with to the query using the OutletType relation
 *
 * @method     \entities\CompanyQuery|\entities\OutletTypeQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildOutletOutcomes|null findOne(?ConnectionInterface $con = null) Return the first ChildOutletOutcomes matching the query
 * @method     ChildOutletOutcomes findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildOutletOutcomes matching the query, or a new ChildOutletOutcomes object populated from the query conditions when no match is found
 *
 * @method     ChildOutletOutcomes|null findOneByOutletOutcomeId(int $outlet_outcome_id) Return the first ChildOutletOutcomes filtered by the outlet_outcome_id column
 * @method     ChildOutletOutcomes|null findOneByReason(string $reason) Return the first ChildOutletOutcomes filtered by the reason column
 * @method     ChildOutletOutcomes|null findOneByType(string $type) Return the first ChildOutletOutcomes filtered by the type column
 * @method     ChildOutletOutcomes|null findOneByCreatedAt(string $created_at) Return the first ChildOutletOutcomes filtered by the created_at column
 * @method     ChildOutletOutcomes|null findOneByUpdatedAt(string $updated_at) Return the first ChildOutletOutcomes filtered by the updated_at column
 * @method     ChildOutletOutcomes|null findOneByOutletTypeId(int $outlet_type_id) Return the first ChildOutletOutcomes filtered by the outlet_type_id column
 * @method     ChildOutletOutcomes|null findOneByCompanyId(int $company_id) Return the first ChildOutletOutcomes filtered by the company_id column
 *
 * @method     ChildOutletOutcomes requirePk($key, ?ConnectionInterface $con = null) Return the ChildOutletOutcomes by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletOutcomes requireOne(?ConnectionInterface $con = null) Return the first ChildOutletOutcomes matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOutletOutcomes requireOneByOutletOutcomeId(int $outlet_outcome_id) Return the first ChildOutletOutcomes filtered by the outlet_outcome_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletOutcomes requireOneByReason(string $reason) Return the first ChildOutletOutcomes filtered by the reason column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletOutcomes requireOneByType(string $type) Return the first ChildOutletOutcomes filtered by the type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletOutcomes requireOneByCreatedAt(string $created_at) Return the first ChildOutletOutcomes filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletOutcomes requireOneByUpdatedAt(string $updated_at) Return the first ChildOutletOutcomes filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletOutcomes requireOneByOutletTypeId(int $outlet_type_id) Return the first ChildOutletOutcomes filtered by the outlet_type_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletOutcomes requireOneByCompanyId(int $company_id) Return the first ChildOutletOutcomes filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOutletOutcomes[]|Collection find(?ConnectionInterface $con = null) Return ChildOutletOutcomes objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildOutletOutcomes> find(?ConnectionInterface $con = null) Return ChildOutletOutcomes objects based on current ModelCriteria
 *
 * @method     ChildOutletOutcomes[]|Collection findByOutletOutcomeId(int|array<int> $outlet_outcome_id) Return ChildOutletOutcomes objects filtered by the outlet_outcome_id column
 * @psalm-method Collection&\Traversable<ChildOutletOutcomes> findByOutletOutcomeId(int|array<int> $outlet_outcome_id) Return ChildOutletOutcomes objects filtered by the outlet_outcome_id column
 * @method     ChildOutletOutcomes[]|Collection findByReason(string|array<string> $reason) Return ChildOutletOutcomes objects filtered by the reason column
 * @psalm-method Collection&\Traversable<ChildOutletOutcomes> findByReason(string|array<string> $reason) Return ChildOutletOutcomes objects filtered by the reason column
 * @method     ChildOutletOutcomes[]|Collection findByType(string|array<string> $type) Return ChildOutletOutcomes objects filtered by the type column
 * @psalm-method Collection&\Traversable<ChildOutletOutcomes> findByType(string|array<string> $type) Return ChildOutletOutcomes objects filtered by the type column
 * @method     ChildOutletOutcomes[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildOutletOutcomes objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildOutletOutcomes> findByCreatedAt(string|array<string> $created_at) Return ChildOutletOutcomes objects filtered by the created_at column
 * @method     ChildOutletOutcomes[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildOutletOutcomes objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildOutletOutcomes> findByUpdatedAt(string|array<string> $updated_at) Return ChildOutletOutcomes objects filtered by the updated_at column
 * @method     ChildOutletOutcomes[]|Collection findByOutletTypeId(int|array<int> $outlet_type_id) Return ChildOutletOutcomes objects filtered by the outlet_type_id column
 * @psalm-method Collection&\Traversable<ChildOutletOutcomes> findByOutletTypeId(int|array<int> $outlet_type_id) Return ChildOutletOutcomes objects filtered by the outlet_type_id column
 * @method     ChildOutletOutcomes[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildOutletOutcomes objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildOutletOutcomes> findByCompanyId(int|array<int> $company_id) Return ChildOutletOutcomes objects filtered by the company_id column
 *
 * @method     ChildOutletOutcomes[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildOutletOutcomes> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class OutletOutcomesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\OutletOutcomesQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\OutletOutcomes', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildOutletOutcomesQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildOutletOutcomesQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildOutletOutcomesQuery) {
            return $criteria;
        }
        $query = new ChildOutletOutcomesQuery();
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
     * @return ChildOutletOutcomes|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(OutletOutcomesTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = OutletOutcomesTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildOutletOutcomes A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT outlet_outcome_id, reason, type, created_at, updated_at, outlet_type_id, company_id FROM outlet_outcomes WHERE outlet_outcome_id = :p0';
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
            /** @var ChildOutletOutcomes $obj */
            $obj = new ChildOutletOutcomes();
            $obj->hydrate($row);
            OutletOutcomesTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildOutletOutcomes|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(OutletOutcomesTableMap::COL_OUTLET_OUTCOME_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(OutletOutcomesTableMap::COL_OUTLET_OUTCOME_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the outlet_outcome_id column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletOutcomeId(1234); // WHERE outlet_outcome_id = 1234
     * $query->filterByOutletOutcomeId(array(12, 34)); // WHERE outlet_outcome_id IN (12, 34)
     * $query->filterByOutletOutcomeId(array('min' => 12)); // WHERE outlet_outcome_id > 12
     * </code>
     *
     * @param mixed $outletOutcomeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletOutcomeId($outletOutcomeId = null, ?string $comparison = null)
    {
        if (is_array($outletOutcomeId)) {
            $useMinMax = false;
            if (isset($outletOutcomeId['min'])) {
                $this->addUsingAlias(OutletOutcomesTableMap::COL_OUTLET_OUTCOME_ID, $outletOutcomeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outletOutcomeId['max'])) {
                $this->addUsingAlias(OutletOutcomesTableMap::COL_OUTLET_OUTCOME_ID, $outletOutcomeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletOutcomesTableMap::COL_OUTLET_OUTCOME_ID, $outletOutcomeId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the reason column
     *
     * Example usage:
     * <code>
     * $query->filterByReason('fooValue');   // WHERE reason = 'fooValue'
     * $query->filterByReason('%fooValue%', Criteria::LIKE); // WHERE reason LIKE '%fooValue%'
     * $query->filterByReason(['foo', 'bar']); // WHERE reason IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $reason The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByReason($reason = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($reason)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletOutcomesTableMap::COL_REASON, $reason, $comparison);

        return $this;
    }

    /**
     * Filter the query on the type column
     *
     * Example usage:
     * <code>
     * $query->filterByType('fooValue');   // WHERE type = 'fooValue'
     * $query->filterByType('%fooValue%', Criteria::LIKE); // WHERE type LIKE '%fooValue%'
     * $query->filterByType(['foo', 'bar']); // WHERE type IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $type The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByType($type = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($type)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletOutcomesTableMap::COL_TYPE, $type, $comparison);

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
                $this->addUsingAlias(OutletOutcomesTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(OutletOutcomesTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletOutcomesTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(OutletOutcomesTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(OutletOutcomesTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletOutcomesTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_type_id column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletTypeId(1234); // WHERE outlet_type_id = 1234
     * $query->filterByOutletTypeId(array(12, 34)); // WHERE outlet_type_id IN (12, 34)
     * $query->filterByOutletTypeId(array('min' => 12)); // WHERE outlet_type_id > 12
     * </code>
     *
     * @see       filterByOutletType()
     *
     * @param mixed $outletTypeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletTypeId($outletTypeId = null, ?string $comparison = null)
    {
        if (is_array($outletTypeId)) {
            $useMinMax = false;
            if (isset($outletTypeId['min'])) {
                $this->addUsingAlias(OutletOutcomesTableMap::COL_OUTLET_TYPE_ID, $outletTypeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outletTypeId['max'])) {
                $this->addUsingAlias(OutletOutcomesTableMap::COL_OUTLET_TYPE_ID, $outletTypeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletOutcomesTableMap::COL_OUTLET_TYPE_ID, $outletTypeId, $comparison);

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
                $this->addUsingAlias(OutletOutcomesTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(OutletOutcomesTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletOutcomesTableMap::COL_COMPANY_ID, $companyId, $comparison);

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
                ->addUsingAlias(OutletOutcomesTableMap::COL_COMPANY_ID, $company->getCompanyId(), $comparison);
        } elseif ($company instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(OutletOutcomesTableMap::COL_COMPANY_ID, $company->toKeyValue('PrimaryKey', 'CompanyId'), $comparison);

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
     * Filter the query by a related \entities\OutletType object
     *
     * @param \entities\OutletType|ObjectCollection $outletType The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletType($outletType, ?string $comparison = null)
    {
        if ($outletType instanceof \entities\OutletType) {
            return $this
                ->addUsingAlias(OutletOutcomesTableMap::COL_OUTLET_TYPE_ID, $outletType->getOutlettypeId(), $comparison);
        } elseif ($outletType instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(OutletOutcomesTableMap::COL_OUTLET_TYPE_ID, $outletType->toKeyValue('PrimaryKey', 'OutlettypeId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByOutletType() only accepts arguments of type \entities\OutletType or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OutletType relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOutletType(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OutletType');

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
            $this->addJoinObject($join, 'OutletType');
        }

        return $this;
    }

    /**
     * Use the OutletType relation OutletType object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\OutletTypeQuery A secondary query class using the current class as primary query
     */
    public function useOutletTypeQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinOutletType($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OutletType', '\entities\OutletTypeQuery');
    }

    /**
     * Use the OutletType relation OutletType object
     *
     * @param callable(\entities\OutletTypeQuery):\entities\OutletTypeQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOutletTypeQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useOutletTypeQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to OutletType table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\OutletTypeQuery The inner query object of the EXISTS statement
     */
    public function useOutletTypeExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\OutletTypeQuery */
        $q = $this->useExistsQuery('OutletType', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to OutletType table for a NOT EXISTS query.
     *
     * @see useOutletTypeExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\OutletTypeQuery The inner query object of the NOT EXISTS statement
     */
    public function useOutletTypeNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OutletTypeQuery */
        $q = $this->useExistsQuery('OutletType', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to OutletType table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\OutletTypeQuery The inner query object of the IN statement
     */
    public function useInOutletTypeQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\OutletTypeQuery */
        $q = $this->useInQuery('OutletType', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to OutletType table for a NOT IN query.
     *
     * @see useOutletTypeInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\OutletTypeQuery The inner query object of the NOT IN statement
     */
    public function useNotInOutletTypeQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OutletTypeQuery */
        $q = $this->useInQuery('OutletType', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildOutletOutcomes $outletOutcomes Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($outletOutcomes = null)
    {
        if ($outletOutcomes) {
            $this->addUsingAlias(OutletOutcomesTableMap::COL_OUTLET_OUTCOME_ID, $outletOutcomes->getOutletOutcomeId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the outlet_outcomes table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OutletOutcomesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            OutletOutcomesTableMap::clearInstancePool();
            OutletOutcomesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(OutletOutcomesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(OutletOutcomesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            OutletOutcomesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            OutletOutcomesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
