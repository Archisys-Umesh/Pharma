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
use entities\StpWeek as ChildStpWeek;
use entities\StpWeekQuery as ChildStpWeekQuery;
use entities\Map\StpWeekTableMap;

/**
 * Base class that represents a query for the `stp_week` table.
 *
 * @method     ChildStpWeekQuery orderByStpWeekId($order = Criteria::ASC) Order by the stp_week_id column
 * @method     ChildStpWeekQuery orderByStpId($order = Criteria::ASC) Order by the stp_id column
 * @method     ChildStpWeekQuery orderByWeek($order = Criteria::ASC) Order by the week column
 * @method     ChildStpWeekQuery orderByDay($order = Criteria::ASC) Order by the day column
 * @method     ChildStpWeekQuery orderByBeatId($order = Criteria::ASC) Order by the beat_id column
 * @method     ChildStpWeekQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildStpWeekQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildStpWeekQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildStpWeekQuery orderByTerritoryId($order = Criteria::ASC) Order by the territory_id column
 *
 * @method     ChildStpWeekQuery groupByStpWeekId() Group by the stp_week_id column
 * @method     ChildStpWeekQuery groupByStpId() Group by the stp_id column
 * @method     ChildStpWeekQuery groupByWeek() Group by the week column
 * @method     ChildStpWeekQuery groupByDay() Group by the day column
 * @method     ChildStpWeekQuery groupByBeatId() Group by the beat_id column
 * @method     ChildStpWeekQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildStpWeekQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildStpWeekQuery groupByCompanyId() Group by the company_id column
 * @method     ChildStpWeekQuery groupByTerritoryId() Group by the territory_id column
 *
 * @method     ChildStpWeekQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildStpWeekQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildStpWeekQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildStpWeekQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildStpWeekQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildStpWeekQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildStpWeekQuery leftJoinBeats($relationAlias = null) Adds a LEFT JOIN clause to the query using the Beats relation
 * @method     ChildStpWeekQuery rightJoinBeats($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Beats relation
 * @method     ChildStpWeekQuery innerJoinBeats($relationAlias = null) Adds a INNER JOIN clause to the query using the Beats relation
 *
 * @method     ChildStpWeekQuery joinWithBeats($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Beats relation
 *
 * @method     ChildStpWeekQuery leftJoinWithBeats() Adds a LEFT JOIN clause and with to the query using the Beats relation
 * @method     ChildStpWeekQuery rightJoinWithBeats() Adds a RIGHT JOIN clause and with to the query using the Beats relation
 * @method     ChildStpWeekQuery innerJoinWithBeats() Adds a INNER JOIN clause and with to the query using the Beats relation
 *
 * @method     ChildStpWeekQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildStpWeekQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildStpWeekQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildStpWeekQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildStpWeekQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildStpWeekQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildStpWeekQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     ChildStpWeekQuery leftJoinTerritories($relationAlias = null) Adds a LEFT JOIN clause to the query using the Territories relation
 * @method     ChildStpWeekQuery rightJoinTerritories($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Territories relation
 * @method     ChildStpWeekQuery innerJoinTerritories($relationAlias = null) Adds a INNER JOIN clause to the query using the Territories relation
 *
 * @method     ChildStpWeekQuery joinWithTerritories($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Territories relation
 *
 * @method     ChildStpWeekQuery leftJoinWithTerritories() Adds a LEFT JOIN clause and with to the query using the Territories relation
 * @method     ChildStpWeekQuery rightJoinWithTerritories() Adds a RIGHT JOIN clause and with to the query using the Territories relation
 * @method     ChildStpWeekQuery innerJoinWithTerritories() Adds a INNER JOIN clause and with to the query using the Territories relation
 *
 * @method     ChildStpWeekQuery leftJoinStp($relationAlias = null) Adds a LEFT JOIN clause to the query using the Stp relation
 * @method     ChildStpWeekQuery rightJoinStp($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Stp relation
 * @method     ChildStpWeekQuery innerJoinStp($relationAlias = null) Adds a INNER JOIN clause to the query using the Stp relation
 *
 * @method     ChildStpWeekQuery joinWithStp($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Stp relation
 *
 * @method     ChildStpWeekQuery leftJoinWithStp() Adds a LEFT JOIN clause and with to the query using the Stp relation
 * @method     ChildStpWeekQuery rightJoinWithStp() Adds a RIGHT JOIN clause and with to the query using the Stp relation
 * @method     ChildStpWeekQuery innerJoinWithStp() Adds a INNER JOIN clause and with to the query using the Stp relation
 *
 * @method     \entities\BeatsQuery|\entities\CompanyQuery|\entities\TerritoriesQuery|\entities\StpQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildStpWeek|null findOne(?ConnectionInterface $con = null) Return the first ChildStpWeek matching the query
 * @method     ChildStpWeek findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildStpWeek matching the query, or a new ChildStpWeek object populated from the query conditions when no match is found
 *
 * @method     ChildStpWeek|null findOneByStpWeekId(int $stp_week_id) Return the first ChildStpWeek filtered by the stp_week_id column
 * @method     ChildStpWeek|null findOneByStpId(int $stp_id) Return the first ChildStpWeek filtered by the stp_id column
 * @method     ChildStpWeek|null findOneByWeek(string $week) Return the first ChildStpWeek filtered by the week column
 * @method     ChildStpWeek|null findOneByDay(string $day) Return the first ChildStpWeek filtered by the day column
 * @method     ChildStpWeek|null findOneByBeatId(int $beat_id) Return the first ChildStpWeek filtered by the beat_id column
 * @method     ChildStpWeek|null findOneByCreatedAt(string $created_at) Return the first ChildStpWeek filtered by the created_at column
 * @method     ChildStpWeek|null findOneByUpdatedAt(string $updated_at) Return the first ChildStpWeek filtered by the updated_at column
 * @method     ChildStpWeek|null findOneByCompanyId(int $company_id) Return the first ChildStpWeek filtered by the company_id column
 * @method     ChildStpWeek|null findOneByTerritoryId(int $territory_id) Return the first ChildStpWeek filtered by the territory_id column
 *
 * @method     ChildStpWeek requirePk($key, ?ConnectionInterface $con = null) Return the ChildStpWeek by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStpWeek requireOne(?ConnectionInterface $con = null) Return the first ChildStpWeek matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildStpWeek requireOneByStpWeekId(int $stp_week_id) Return the first ChildStpWeek filtered by the stp_week_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStpWeek requireOneByStpId(int $stp_id) Return the first ChildStpWeek filtered by the stp_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStpWeek requireOneByWeek(string $week) Return the first ChildStpWeek filtered by the week column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStpWeek requireOneByDay(string $day) Return the first ChildStpWeek filtered by the day column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStpWeek requireOneByBeatId(int $beat_id) Return the first ChildStpWeek filtered by the beat_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStpWeek requireOneByCreatedAt(string $created_at) Return the first ChildStpWeek filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStpWeek requireOneByUpdatedAt(string $updated_at) Return the first ChildStpWeek filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStpWeek requireOneByCompanyId(int $company_id) Return the first ChildStpWeek filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStpWeek requireOneByTerritoryId(int $territory_id) Return the first ChildStpWeek filtered by the territory_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildStpWeek[]|Collection find(?ConnectionInterface $con = null) Return ChildStpWeek objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildStpWeek> find(?ConnectionInterface $con = null) Return ChildStpWeek objects based on current ModelCriteria
 *
 * @method     ChildStpWeek[]|Collection findByStpWeekId(int|array<int> $stp_week_id) Return ChildStpWeek objects filtered by the stp_week_id column
 * @psalm-method Collection&\Traversable<ChildStpWeek> findByStpWeekId(int|array<int> $stp_week_id) Return ChildStpWeek objects filtered by the stp_week_id column
 * @method     ChildStpWeek[]|Collection findByStpId(int|array<int> $stp_id) Return ChildStpWeek objects filtered by the stp_id column
 * @psalm-method Collection&\Traversable<ChildStpWeek> findByStpId(int|array<int> $stp_id) Return ChildStpWeek objects filtered by the stp_id column
 * @method     ChildStpWeek[]|Collection findByWeek(string|array<string> $week) Return ChildStpWeek objects filtered by the week column
 * @psalm-method Collection&\Traversable<ChildStpWeek> findByWeek(string|array<string> $week) Return ChildStpWeek objects filtered by the week column
 * @method     ChildStpWeek[]|Collection findByDay(string|array<string> $day) Return ChildStpWeek objects filtered by the day column
 * @psalm-method Collection&\Traversable<ChildStpWeek> findByDay(string|array<string> $day) Return ChildStpWeek objects filtered by the day column
 * @method     ChildStpWeek[]|Collection findByBeatId(int|array<int> $beat_id) Return ChildStpWeek objects filtered by the beat_id column
 * @psalm-method Collection&\Traversable<ChildStpWeek> findByBeatId(int|array<int> $beat_id) Return ChildStpWeek objects filtered by the beat_id column
 * @method     ChildStpWeek[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildStpWeek objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildStpWeek> findByCreatedAt(string|array<string> $created_at) Return ChildStpWeek objects filtered by the created_at column
 * @method     ChildStpWeek[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildStpWeek objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildStpWeek> findByUpdatedAt(string|array<string> $updated_at) Return ChildStpWeek objects filtered by the updated_at column
 * @method     ChildStpWeek[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildStpWeek objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildStpWeek> findByCompanyId(int|array<int> $company_id) Return ChildStpWeek objects filtered by the company_id column
 * @method     ChildStpWeek[]|Collection findByTerritoryId(int|array<int> $territory_id) Return ChildStpWeek objects filtered by the territory_id column
 * @psalm-method Collection&\Traversable<ChildStpWeek> findByTerritoryId(int|array<int> $territory_id) Return ChildStpWeek objects filtered by the territory_id column
 *
 * @method     ChildStpWeek[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildStpWeek> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class StpWeekQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\StpWeekQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\StpWeek', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildStpWeekQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildStpWeekQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildStpWeekQuery) {
            return $criteria;
        }
        $query = new ChildStpWeekQuery();
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
     * @return ChildStpWeek|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(StpWeekTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = StpWeekTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildStpWeek A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT stp_week_id, stp_id, week, day, beat_id, created_at, updated_at, company_id, territory_id FROM stp_week WHERE stp_week_id = :p0';
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
            /** @var ChildStpWeek $obj */
            $obj = new ChildStpWeek();
            $obj->hydrate($row);
            StpWeekTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildStpWeek|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(StpWeekTableMap::COL_STP_WEEK_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(StpWeekTableMap::COL_STP_WEEK_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the stp_week_id column
     *
     * Example usage:
     * <code>
     * $query->filterByStpWeekId(1234); // WHERE stp_week_id = 1234
     * $query->filterByStpWeekId(array(12, 34)); // WHERE stp_week_id IN (12, 34)
     * $query->filterByStpWeekId(array('min' => 12)); // WHERE stp_week_id > 12
     * </code>
     *
     * @param mixed $stpWeekId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStpWeekId($stpWeekId = null, ?string $comparison = null)
    {
        if (is_array($stpWeekId)) {
            $useMinMax = false;
            if (isset($stpWeekId['min'])) {
                $this->addUsingAlias(StpWeekTableMap::COL_STP_WEEK_ID, $stpWeekId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($stpWeekId['max'])) {
                $this->addUsingAlias(StpWeekTableMap::COL_STP_WEEK_ID, $stpWeekId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StpWeekTableMap::COL_STP_WEEK_ID, $stpWeekId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the stp_id column
     *
     * Example usage:
     * <code>
     * $query->filterByStpId(1234); // WHERE stp_id = 1234
     * $query->filterByStpId(array(12, 34)); // WHERE stp_id IN (12, 34)
     * $query->filterByStpId(array('min' => 12)); // WHERE stp_id > 12
     * </code>
     *
     * @see       filterByStp()
     *
     * @param mixed $stpId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStpId($stpId = null, ?string $comparison = null)
    {
        if (is_array($stpId)) {
            $useMinMax = false;
            if (isset($stpId['min'])) {
                $this->addUsingAlias(StpWeekTableMap::COL_STP_ID, $stpId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($stpId['max'])) {
                $this->addUsingAlias(StpWeekTableMap::COL_STP_ID, $stpId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StpWeekTableMap::COL_STP_ID, $stpId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the week column
     *
     * Example usage:
     * <code>
     * $query->filterByWeek('fooValue');   // WHERE week = 'fooValue'
     * $query->filterByWeek('%fooValue%', Criteria::LIKE); // WHERE week LIKE '%fooValue%'
     * $query->filterByWeek(['foo', 'bar']); // WHERE week IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $week The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWeek($week = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($week)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StpWeekTableMap::COL_WEEK, $week, $comparison);

        return $this;
    }

    /**
     * Filter the query on the day column
     *
     * Example usage:
     * <code>
     * $query->filterByDay('fooValue');   // WHERE day = 'fooValue'
     * $query->filterByDay('%fooValue%', Criteria::LIKE); // WHERE day LIKE '%fooValue%'
     * $query->filterByDay(['foo', 'bar']); // WHERE day IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $day The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDay($day = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($day)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StpWeekTableMap::COL_DAY, $day, $comparison);

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
                $this->addUsingAlias(StpWeekTableMap::COL_BEAT_ID, $beatId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($beatId['max'])) {
                $this->addUsingAlias(StpWeekTableMap::COL_BEAT_ID, $beatId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StpWeekTableMap::COL_BEAT_ID, $beatId, $comparison);

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
                $this->addUsingAlias(StpWeekTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(StpWeekTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StpWeekTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(StpWeekTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(StpWeekTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StpWeekTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

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
                $this->addUsingAlias(StpWeekTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(StpWeekTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StpWeekTableMap::COL_COMPANY_ID, $companyId, $comparison);

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
                $this->addUsingAlias(StpWeekTableMap::COL_TERRITORY_ID, $territoryId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($territoryId['max'])) {
                $this->addUsingAlias(StpWeekTableMap::COL_TERRITORY_ID, $territoryId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StpWeekTableMap::COL_TERRITORY_ID, $territoryId, $comparison);

        return $this;
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
                ->addUsingAlias(StpWeekTableMap::COL_BEAT_ID, $beats->getBeatId(), $comparison);
        } elseif ($beats instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(StpWeekTableMap::COL_BEAT_ID, $beats->toKeyValue('PrimaryKey', 'BeatId'), $comparison);

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
                ->addUsingAlias(StpWeekTableMap::COL_COMPANY_ID, $company->getCompanyId(), $comparison);
        } elseif ($company instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(StpWeekTableMap::COL_COMPANY_ID, $company->toKeyValue('PrimaryKey', 'CompanyId'), $comparison);

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
                ->addUsingAlias(StpWeekTableMap::COL_TERRITORY_ID, $territories->getTerritoryId(), $comparison);
        } elseif ($territories instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(StpWeekTableMap::COL_TERRITORY_ID, $territories->toKeyValue('PrimaryKey', 'TerritoryId'), $comparison);

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
     * Filter the query by a related \entities\Stp object
     *
     * @param \entities\Stp|ObjectCollection $stp The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStp($stp, ?string $comparison = null)
    {
        if ($stp instanceof \entities\Stp) {
            return $this
                ->addUsingAlias(StpWeekTableMap::COL_STP_ID, $stp->getStpId(), $comparison);
        } elseif ($stp instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(StpWeekTableMap::COL_STP_ID, $stp->toKeyValue('PrimaryKey', 'StpId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByStp() only accepts arguments of type \entities\Stp or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Stp relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinStp(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Stp');

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
            $this->addJoinObject($join, 'Stp');
        }

        return $this;
    }

    /**
     * Use the Stp relation Stp object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\StpQuery A secondary query class using the current class as primary query
     */
    public function useStpQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinStp($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Stp', '\entities\StpQuery');
    }

    /**
     * Use the Stp relation Stp object
     *
     * @param callable(\entities\StpQuery):\entities\StpQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withStpQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useStpQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Stp table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\StpQuery The inner query object of the EXISTS statement
     */
    public function useStpExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\StpQuery */
        $q = $this->useExistsQuery('Stp', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Stp table for a NOT EXISTS query.
     *
     * @see useStpExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\StpQuery The inner query object of the NOT EXISTS statement
     */
    public function useStpNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\StpQuery */
        $q = $this->useExistsQuery('Stp', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Stp table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\StpQuery The inner query object of the IN statement
     */
    public function useInStpQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\StpQuery */
        $q = $this->useInQuery('Stp', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Stp table for a NOT IN query.
     *
     * @see useStpInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\StpQuery The inner query object of the NOT IN statement
     */
    public function useNotInStpQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\StpQuery */
        $q = $this->useInQuery('Stp', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildStpWeek $stpWeek Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($stpWeek = null)
    {
        if ($stpWeek) {
            $this->addUsingAlias(StpWeekTableMap::COL_STP_WEEK_ID, $stpWeek->getStpWeekId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the stp_week table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(StpWeekTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            StpWeekTableMap::clearInstancePool();
            StpWeekTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(StpWeekTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(StpWeekTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            StpWeekTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            StpWeekTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
