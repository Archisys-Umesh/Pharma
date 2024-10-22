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
use entities\GeoDistance as ChildGeoDistance;
use entities\GeoDistanceQuery as ChildGeoDistanceQuery;
use entities\Map\GeoDistanceTableMap;

/**
 * Base class that represents a query for the `geo_distance` table.
 *
 * @method     ChildGeoDistanceQuery orderByGeoDistanceId($order = Criteria::ASC) Order by the geo_distance_id column
 * @method     ChildGeoDistanceQuery orderByFromTownId($order = Criteria::ASC) Order by the from_town_id column
 * @method     ChildGeoDistanceQuery orderByToTownId($order = Criteria::ASC) Order by the to_town_id column
 * @method     ChildGeoDistanceQuery orderByDistanceKm($order = Criteria::ASC) Order by the distance_km column
 * @method     ChildGeoDistanceQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildGeoDistanceQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildGeoDistanceQuery orderByBeltName($order = Criteria::ASC) Order by the belt_name column
 * @method     ChildGeoDistanceQuery orderByFromStateId($order = Criteria::ASC) Order by the from_state_id column
 * @method     ChildGeoDistanceQuery orderByCalculationType($order = Criteria::ASC) Order by the calculation_type column
 * @method     ChildGeoDistanceQuery orderByAmount($order = Criteria::ASC) Order by the amount column
 * @method     ChildGeoDistanceQuery orderByRemark($order = Criteria::ASC) Order by the remark column
 * @method     ChildGeoDistanceQuery orderByToStateId($order = Criteria::ASC) Order by the to_state_id column
 *
 * @method     ChildGeoDistanceQuery groupByGeoDistanceId() Group by the geo_distance_id column
 * @method     ChildGeoDistanceQuery groupByFromTownId() Group by the from_town_id column
 * @method     ChildGeoDistanceQuery groupByToTownId() Group by the to_town_id column
 * @method     ChildGeoDistanceQuery groupByDistanceKm() Group by the distance_km column
 * @method     ChildGeoDistanceQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildGeoDistanceQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildGeoDistanceQuery groupByBeltName() Group by the belt_name column
 * @method     ChildGeoDistanceQuery groupByFromStateId() Group by the from_state_id column
 * @method     ChildGeoDistanceQuery groupByCalculationType() Group by the calculation_type column
 * @method     ChildGeoDistanceQuery groupByAmount() Group by the amount column
 * @method     ChildGeoDistanceQuery groupByRemark() Group by the remark column
 * @method     ChildGeoDistanceQuery groupByToStateId() Group by the to_state_id column
 *
 * @method     ChildGeoDistanceQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildGeoDistanceQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildGeoDistanceQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildGeoDistanceQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildGeoDistanceQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildGeoDistanceQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildGeoDistanceQuery leftJoinGeoTownsRelatedByFromTownId($relationAlias = null) Adds a LEFT JOIN clause to the query using the GeoTownsRelatedByFromTownId relation
 * @method     ChildGeoDistanceQuery rightJoinGeoTownsRelatedByFromTownId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the GeoTownsRelatedByFromTownId relation
 * @method     ChildGeoDistanceQuery innerJoinGeoTownsRelatedByFromTownId($relationAlias = null) Adds a INNER JOIN clause to the query using the GeoTownsRelatedByFromTownId relation
 *
 * @method     ChildGeoDistanceQuery joinWithGeoTownsRelatedByFromTownId($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the GeoTownsRelatedByFromTownId relation
 *
 * @method     ChildGeoDistanceQuery leftJoinWithGeoTownsRelatedByFromTownId() Adds a LEFT JOIN clause and with to the query using the GeoTownsRelatedByFromTownId relation
 * @method     ChildGeoDistanceQuery rightJoinWithGeoTownsRelatedByFromTownId() Adds a RIGHT JOIN clause and with to the query using the GeoTownsRelatedByFromTownId relation
 * @method     ChildGeoDistanceQuery innerJoinWithGeoTownsRelatedByFromTownId() Adds a INNER JOIN clause and with to the query using the GeoTownsRelatedByFromTownId relation
 *
 * @method     ChildGeoDistanceQuery leftJoinGeoTownsRelatedByToTownId($relationAlias = null) Adds a LEFT JOIN clause to the query using the GeoTownsRelatedByToTownId relation
 * @method     ChildGeoDistanceQuery rightJoinGeoTownsRelatedByToTownId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the GeoTownsRelatedByToTownId relation
 * @method     ChildGeoDistanceQuery innerJoinGeoTownsRelatedByToTownId($relationAlias = null) Adds a INNER JOIN clause to the query using the GeoTownsRelatedByToTownId relation
 *
 * @method     ChildGeoDistanceQuery joinWithGeoTownsRelatedByToTownId($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the GeoTownsRelatedByToTownId relation
 *
 * @method     ChildGeoDistanceQuery leftJoinWithGeoTownsRelatedByToTownId() Adds a LEFT JOIN clause and with to the query using the GeoTownsRelatedByToTownId relation
 * @method     ChildGeoDistanceQuery rightJoinWithGeoTownsRelatedByToTownId() Adds a RIGHT JOIN clause and with to the query using the GeoTownsRelatedByToTownId relation
 * @method     ChildGeoDistanceQuery innerJoinWithGeoTownsRelatedByToTownId() Adds a INNER JOIN clause and with to the query using the GeoTownsRelatedByToTownId relation
 *
 * @method     ChildGeoDistanceQuery leftJoinGeoStateRelatedByFromStateId($relationAlias = null) Adds a LEFT JOIN clause to the query using the GeoStateRelatedByFromStateId relation
 * @method     ChildGeoDistanceQuery rightJoinGeoStateRelatedByFromStateId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the GeoStateRelatedByFromStateId relation
 * @method     ChildGeoDistanceQuery innerJoinGeoStateRelatedByFromStateId($relationAlias = null) Adds a INNER JOIN clause to the query using the GeoStateRelatedByFromStateId relation
 *
 * @method     ChildGeoDistanceQuery joinWithGeoStateRelatedByFromStateId($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the GeoStateRelatedByFromStateId relation
 *
 * @method     ChildGeoDistanceQuery leftJoinWithGeoStateRelatedByFromStateId() Adds a LEFT JOIN clause and with to the query using the GeoStateRelatedByFromStateId relation
 * @method     ChildGeoDistanceQuery rightJoinWithGeoStateRelatedByFromStateId() Adds a RIGHT JOIN clause and with to the query using the GeoStateRelatedByFromStateId relation
 * @method     ChildGeoDistanceQuery innerJoinWithGeoStateRelatedByFromStateId() Adds a INNER JOIN clause and with to the query using the GeoStateRelatedByFromStateId relation
 *
 * @method     ChildGeoDistanceQuery leftJoinGeoStateRelatedByToStateId($relationAlias = null) Adds a LEFT JOIN clause to the query using the GeoStateRelatedByToStateId relation
 * @method     ChildGeoDistanceQuery rightJoinGeoStateRelatedByToStateId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the GeoStateRelatedByToStateId relation
 * @method     ChildGeoDistanceQuery innerJoinGeoStateRelatedByToStateId($relationAlias = null) Adds a INNER JOIN clause to the query using the GeoStateRelatedByToStateId relation
 *
 * @method     ChildGeoDistanceQuery joinWithGeoStateRelatedByToStateId($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the GeoStateRelatedByToStateId relation
 *
 * @method     ChildGeoDistanceQuery leftJoinWithGeoStateRelatedByToStateId() Adds a LEFT JOIN clause and with to the query using the GeoStateRelatedByToStateId relation
 * @method     ChildGeoDistanceQuery rightJoinWithGeoStateRelatedByToStateId() Adds a RIGHT JOIN clause and with to the query using the GeoStateRelatedByToStateId relation
 * @method     ChildGeoDistanceQuery innerJoinWithGeoStateRelatedByToStateId() Adds a INNER JOIN clause and with to the query using the GeoStateRelatedByToStateId relation
 *
 * @method     \entities\GeoTownsQuery|\entities\GeoTownsQuery|\entities\GeoStateQuery|\entities\GeoStateQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildGeoDistance|null findOne(?ConnectionInterface $con = null) Return the first ChildGeoDistance matching the query
 * @method     ChildGeoDistance findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildGeoDistance matching the query, or a new ChildGeoDistance object populated from the query conditions when no match is found
 *
 * @method     ChildGeoDistance|null findOneByGeoDistanceId(int $geo_distance_id) Return the first ChildGeoDistance filtered by the geo_distance_id column
 * @method     ChildGeoDistance|null findOneByFromTownId(int $from_town_id) Return the first ChildGeoDistance filtered by the from_town_id column
 * @method     ChildGeoDistance|null findOneByToTownId(int $to_town_id) Return the first ChildGeoDistance filtered by the to_town_id column
 * @method     ChildGeoDistance|null findOneByDistanceKm(string $distance_km) Return the first ChildGeoDistance filtered by the distance_km column
 * @method     ChildGeoDistance|null findOneByCreatedAt(string $created_at) Return the first ChildGeoDistance filtered by the created_at column
 * @method     ChildGeoDistance|null findOneByUpdatedAt(string $updated_at) Return the first ChildGeoDistance filtered by the updated_at column
 * @method     ChildGeoDistance|null findOneByBeltName(string $belt_name) Return the first ChildGeoDistance filtered by the belt_name column
 * @method     ChildGeoDistance|null findOneByFromStateId(int $from_state_id) Return the first ChildGeoDistance filtered by the from_state_id column
 * @method     ChildGeoDistance|null findOneByCalculationType(string $calculation_type) Return the first ChildGeoDistance filtered by the calculation_type column
 * @method     ChildGeoDistance|null findOneByAmount(string $amount) Return the first ChildGeoDistance filtered by the amount column
 * @method     ChildGeoDistance|null findOneByRemark(string $remark) Return the first ChildGeoDistance filtered by the remark column
 * @method     ChildGeoDistance|null findOneByToStateId(int $to_state_id) Return the first ChildGeoDistance filtered by the to_state_id column
 *
 * @method     ChildGeoDistance requirePk($key, ?ConnectionInterface $con = null) Return the ChildGeoDistance by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGeoDistance requireOne(?ConnectionInterface $con = null) Return the first ChildGeoDistance matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildGeoDistance requireOneByGeoDistanceId(int $geo_distance_id) Return the first ChildGeoDistance filtered by the geo_distance_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGeoDistance requireOneByFromTownId(int $from_town_id) Return the first ChildGeoDistance filtered by the from_town_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGeoDistance requireOneByToTownId(int $to_town_id) Return the first ChildGeoDistance filtered by the to_town_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGeoDistance requireOneByDistanceKm(string $distance_km) Return the first ChildGeoDistance filtered by the distance_km column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGeoDistance requireOneByCreatedAt(string $created_at) Return the first ChildGeoDistance filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGeoDistance requireOneByUpdatedAt(string $updated_at) Return the first ChildGeoDistance filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGeoDistance requireOneByBeltName(string $belt_name) Return the first ChildGeoDistance filtered by the belt_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGeoDistance requireOneByFromStateId(int $from_state_id) Return the first ChildGeoDistance filtered by the from_state_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGeoDistance requireOneByCalculationType(string $calculation_type) Return the first ChildGeoDistance filtered by the calculation_type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGeoDistance requireOneByAmount(string $amount) Return the first ChildGeoDistance filtered by the amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGeoDistance requireOneByRemark(string $remark) Return the first ChildGeoDistance filtered by the remark column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGeoDistance requireOneByToStateId(int $to_state_id) Return the first ChildGeoDistance filtered by the to_state_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildGeoDistance[]|Collection find(?ConnectionInterface $con = null) Return ChildGeoDistance objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildGeoDistance> find(?ConnectionInterface $con = null) Return ChildGeoDistance objects based on current ModelCriteria
 *
 * @method     ChildGeoDistance[]|Collection findByGeoDistanceId(int|array<int> $geo_distance_id) Return ChildGeoDistance objects filtered by the geo_distance_id column
 * @psalm-method Collection&\Traversable<ChildGeoDistance> findByGeoDistanceId(int|array<int> $geo_distance_id) Return ChildGeoDistance objects filtered by the geo_distance_id column
 * @method     ChildGeoDistance[]|Collection findByFromTownId(int|array<int> $from_town_id) Return ChildGeoDistance objects filtered by the from_town_id column
 * @psalm-method Collection&\Traversable<ChildGeoDistance> findByFromTownId(int|array<int> $from_town_id) Return ChildGeoDistance objects filtered by the from_town_id column
 * @method     ChildGeoDistance[]|Collection findByToTownId(int|array<int> $to_town_id) Return ChildGeoDistance objects filtered by the to_town_id column
 * @psalm-method Collection&\Traversable<ChildGeoDistance> findByToTownId(int|array<int> $to_town_id) Return ChildGeoDistance objects filtered by the to_town_id column
 * @method     ChildGeoDistance[]|Collection findByDistanceKm(string|array<string> $distance_km) Return ChildGeoDistance objects filtered by the distance_km column
 * @psalm-method Collection&\Traversable<ChildGeoDistance> findByDistanceKm(string|array<string> $distance_km) Return ChildGeoDistance objects filtered by the distance_km column
 * @method     ChildGeoDistance[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildGeoDistance objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildGeoDistance> findByCreatedAt(string|array<string> $created_at) Return ChildGeoDistance objects filtered by the created_at column
 * @method     ChildGeoDistance[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildGeoDistance objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildGeoDistance> findByUpdatedAt(string|array<string> $updated_at) Return ChildGeoDistance objects filtered by the updated_at column
 * @method     ChildGeoDistance[]|Collection findByBeltName(string|array<string> $belt_name) Return ChildGeoDistance objects filtered by the belt_name column
 * @psalm-method Collection&\Traversable<ChildGeoDistance> findByBeltName(string|array<string> $belt_name) Return ChildGeoDistance objects filtered by the belt_name column
 * @method     ChildGeoDistance[]|Collection findByFromStateId(int|array<int> $from_state_id) Return ChildGeoDistance objects filtered by the from_state_id column
 * @psalm-method Collection&\Traversable<ChildGeoDistance> findByFromStateId(int|array<int> $from_state_id) Return ChildGeoDistance objects filtered by the from_state_id column
 * @method     ChildGeoDistance[]|Collection findByCalculationType(string|array<string> $calculation_type) Return ChildGeoDistance objects filtered by the calculation_type column
 * @psalm-method Collection&\Traversable<ChildGeoDistance> findByCalculationType(string|array<string> $calculation_type) Return ChildGeoDistance objects filtered by the calculation_type column
 * @method     ChildGeoDistance[]|Collection findByAmount(string|array<string> $amount) Return ChildGeoDistance objects filtered by the amount column
 * @psalm-method Collection&\Traversable<ChildGeoDistance> findByAmount(string|array<string> $amount) Return ChildGeoDistance objects filtered by the amount column
 * @method     ChildGeoDistance[]|Collection findByRemark(string|array<string> $remark) Return ChildGeoDistance objects filtered by the remark column
 * @psalm-method Collection&\Traversable<ChildGeoDistance> findByRemark(string|array<string> $remark) Return ChildGeoDistance objects filtered by the remark column
 * @method     ChildGeoDistance[]|Collection findByToStateId(int|array<int> $to_state_id) Return ChildGeoDistance objects filtered by the to_state_id column
 * @psalm-method Collection&\Traversable<ChildGeoDistance> findByToStateId(int|array<int> $to_state_id) Return ChildGeoDistance objects filtered by the to_state_id column
 *
 * @method     ChildGeoDistance[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildGeoDistance> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class GeoDistanceQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\GeoDistanceQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\GeoDistance', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildGeoDistanceQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildGeoDistanceQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildGeoDistanceQuery) {
            return $criteria;
        }
        $query = new ChildGeoDistanceQuery();
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
     * @return ChildGeoDistance|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(GeoDistanceTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = GeoDistanceTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildGeoDistance A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT geo_distance_id, from_town_id, to_town_id, distance_km, created_at, updated_at, belt_name, from_state_id, calculation_type, amount, remark, to_state_id FROM geo_distance WHERE geo_distance_id = :p0';
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
            /** @var ChildGeoDistance $obj */
            $obj = new ChildGeoDistance();
            $obj->hydrate($row);
            GeoDistanceTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildGeoDistance|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(GeoDistanceTableMap::COL_GEO_DISTANCE_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(GeoDistanceTableMap::COL_GEO_DISTANCE_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the geo_distance_id column
     *
     * Example usage:
     * <code>
     * $query->filterByGeoDistanceId(1234); // WHERE geo_distance_id = 1234
     * $query->filterByGeoDistanceId(array(12, 34)); // WHERE geo_distance_id IN (12, 34)
     * $query->filterByGeoDistanceId(array('min' => 12)); // WHERE geo_distance_id > 12
     * </code>
     *
     * @param mixed $geoDistanceId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByGeoDistanceId($geoDistanceId = null, ?string $comparison = null)
    {
        if (is_array($geoDistanceId)) {
            $useMinMax = false;
            if (isset($geoDistanceId['min'])) {
                $this->addUsingAlias(GeoDistanceTableMap::COL_GEO_DISTANCE_ID, $geoDistanceId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($geoDistanceId['max'])) {
                $this->addUsingAlias(GeoDistanceTableMap::COL_GEO_DISTANCE_ID, $geoDistanceId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(GeoDistanceTableMap::COL_GEO_DISTANCE_ID, $geoDistanceId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the from_town_id column
     *
     * Example usage:
     * <code>
     * $query->filterByFromTownId(1234); // WHERE from_town_id = 1234
     * $query->filterByFromTownId(array(12, 34)); // WHERE from_town_id IN (12, 34)
     * $query->filterByFromTownId(array('min' => 12)); // WHERE from_town_id > 12
     * </code>
     *
     * @see       filterByGeoTownsRelatedByFromTownId()
     *
     * @param mixed $fromTownId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFromTownId($fromTownId = null, ?string $comparison = null)
    {
        if (is_array($fromTownId)) {
            $useMinMax = false;
            if (isset($fromTownId['min'])) {
                $this->addUsingAlias(GeoDistanceTableMap::COL_FROM_TOWN_ID, $fromTownId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fromTownId['max'])) {
                $this->addUsingAlias(GeoDistanceTableMap::COL_FROM_TOWN_ID, $fromTownId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(GeoDistanceTableMap::COL_FROM_TOWN_ID, $fromTownId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the to_town_id column
     *
     * Example usage:
     * <code>
     * $query->filterByToTownId(1234); // WHERE to_town_id = 1234
     * $query->filterByToTownId(array(12, 34)); // WHERE to_town_id IN (12, 34)
     * $query->filterByToTownId(array('min' => 12)); // WHERE to_town_id > 12
     * </code>
     *
     * @see       filterByGeoTownsRelatedByToTownId()
     *
     * @param mixed $toTownId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByToTownId($toTownId = null, ?string $comparison = null)
    {
        if (is_array($toTownId)) {
            $useMinMax = false;
            if (isset($toTownId['min'])) {
                $this->addUsingAlias(GeoDistanceTableMap::COL_TO_TOWN_ID, $toTownId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($toTownId['max'])) {
                $this->addUsingAlias(GeoDistanceTableMap::COL_TO_TOWN_ID, $toTownId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(GeoDistanceTableMap::COL_TO_TOWN_ID, $toTownId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the distance_km column
     *
     * Example usage:
     * <code>
     * $query->filterByDistanceKm(1234); // WHERE distance_km = 1234
     * $query->filterByDistanceKm(array(12, 34)); // WHERE distance_km IN (12, 34)
     * $query->filterByDistanceKm(array('min' => 12)); // WHERE distance_km > 12
     * </code>
     *
     * @param mixed $distanceKm The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDistanceKm($distanceKm = null, ?string $comparison = null)
    {
        if (is_array($distanceKm)) {
            $useMinMax = false;
            if (isset($distanceKm['min'])) {
                $this->addUsingAlias(GeoDistanceTableMap::COL_DISTANCE_KM, $distanceKm['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($distanceKm['max'])) {
                $this->addUsingAlias(GeoDistanceTableMap::COL_DISTANCE_KM, $distanceKm['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(GeoDistanceTableMap::COL_DISTANCE_KM, $distanceKm, $comparison);

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
                $this->addUsingAlias(GeoDistanceTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(GeoDistanceTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(GeoDistanceTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(GeoDistanceTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(GeoDistanceTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(GeoDistanceTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the belt_name column
     *
     * Example usage:
     * <code>
     * $query->filterByBeltName('fooValue');   // WHERE belt_name = 'fooValue'
     * $query->filterByBeltName('%fooValue%', Criteria::LIKE); // WHERE belt_name LIKE '%fooValue%'
     * $query->filterByBeltName(['foo', 'bar']); // WHERE belt_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $beltName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBeltName($beltName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($beltName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(GeoDistanceTableMap::COL_BELT_NAME, $beltName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the from_state_id column
     *
     * Example usage:
     * <code>
     * $query->filterByFromStateId(1234); // WHERE from_state_id = 1234
     * $query->filterByFromStateId(array(12, 34)); // WHERE from_state_id IN (12, 34)
     * $query->filterByFromStateId(array('min' => 12)); // WHERE from_state_id > 12
     * </code>
     *
     * @see       filterByGeoStateRelatedByFromStateId()
     *
     * @param mixed $fromStateId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFromStateId($fromStateId = null, ?string $comparison = null)
    {
        if (is_array($fromStateId)) {
            $useMinMax = false;
            if (isset($fromStateId['min'])) {
                $this->addUsingAlias(GeoDistanceTableMap::COL_FROM_STATE_ID, $fromStateId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fromStateId['max'])) {
                $this->addUsingAlias(GeoDistanceTableMap::COL_FROM_STATE_ID, $fromStateId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(GeoDistanceTableMap::COL_FROM_STATE_ID, $fromStateId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the calculation_type column
     *
     * Example usage:
     * <code>
     * $query->filterByCalculationType('fooValue');   // WHERE calculation_type = 'fooValue'
     * $query->filterByCalculationType('%fooValue%', Criteria::LIKE); // WHERE calculation_type LIKE '%fooValue%'
     * $query->filterByCalculationType(['foo', 'bar']); // WHERE calculation_type IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $calculationType The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCalculationType($calculationType = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($calculationType)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(GeoDistanceTableMap::COL_CALCULATION_TYPE, $calculationType, $comparison);

        return $this;
    }

    /**
     * Filter the query on the amount column
     *
     * Example usage:
     * <code>
     * $query->filterByAmount(1234); // WHERE amount = 1234
     * $query->filterByAmount(array(12, 34)); // WHERE amount IN (12, 34)
     * $query->filterByAmount(array('min' => 12)); // WHERE amount > 12
     * </code>
     *
     * @param mixed $amount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAmount($amount = null, ?string $comparison = null)
    {
        if (is_array($amount)) {
            $useMinMax = false;
            if (isset($amount['min'])) {
                $this->addUsingAlias(GeoDistanceTableMap::COL_AMOUNT, $amount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($amount['max'])) {
                $this->addUsingAlias(GeoDistanceTableMap::COL_AMOUNT, $amount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(GeoDistanceTableMap::COL_AMOUNT, $amount, $comparison);

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

        $this->addUsingAlias(GeoDistanceTableMap::COL_REMARK, $remark, $comparison);

        return $this;
    }

    /**
     * Filter the query on the to_state_id column
     *
     * Example usage:
     * <code>
     * $query->filterByToStateId(1234); // WHERE to_state_id = 1234
     * $query->filterByToStateId(array(12, 34)); // WHERE to_state_id IN (12, 34)
     * $query->filterByToStateId(array('min' => 12)); // WHERE to_state_id > 12
     * </code>
     *
     * @see       filterByGeoStateRelatedByToStateId()
     *
     * @param mixed $toStateId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByToStateId($toStateId = null, ?string $comparison = null)
    {
        if (is_array($toStateId)) {
            $useMinMax = false;
            if (isset($toStateId['min'])) {
                $this->addUsingAlias(GeoDistanceTableMap::COL_TO_STATE_ID, $toStateId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($toStateId['max'])) {
                $this->addUsingAlias(GeoDistanceTableMap::COL_TO_STATE_ID, $toStateId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(GeoDistanceTableMap::COL_TO_STATE_ID, $toStateId, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \entities\GeoTowns object
     *
     * @param \entities\GeoTowns|ObjectCollection $geoTowns The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByGeoTownsRelatedByFromTownId($geoTowns, ?string $comparison = null)
    {
        if ($geoTowns instanceof \entities\GeoTowns) {
            return $this
                ->addUsingAlias(GeoDistanceTableMap::COL_FROM_TOWN_ID, $geoTowns->getItownid(), $comparison);
        } elseif ($geoTowns instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(GeoDistanceTableMap::COL_FROM_TOWN_ID, $geoTowns->toKeyValue('PrimaryKey', 'Itownid'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByGeoTownsRelatedByFromTownId() only accepts arguments of type \entities\GeoTowns or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the GeoTownsRelatedByFromTownId relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinGeoTownsRelatedByFromTownId(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('GeoTownsRelatedByFromTownId');

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
            $this->addJoinObject($join, 'GeoTownsRelatedByFromTownId');
        }

        return $this;
    }

    /**
     * Use the GeoTownsRelatedByFromTownId relation GeoTowns object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\GeoTownsQuery A secondary query class using the current class as primary query
     */
    public function useGeoTownsRelatedByFromTownIdQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinGeoTownsRelatedByFromTownId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'GeoTownsRelatedByFromTownId', '\entities\GeoTownsQuery');
    }

    /**
     * Use the GeoTownsRelatedByFromTownId relation GeoTowns object
     *
     * @param callable(\entities\GeoTownsQuery):\entities\GeoTownsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withGeoTownsRelatedByFromTownIdQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useGeoTownsRelatedByFromTownIdQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the GeoTownsRelatedByFromTownId relation to the GeoTowns table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\GeoTownsQuery The inner query object of the EXISTS statement
     */
    public function useGeoTownsRelatedByFromTownIdExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\GeoTownsQuery */
        $q = $this->useExistsQuery('GeoTownsRelatedByFromTownId', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the GeoTownsRelatedByFromTownId relation to the GeoTowns table for a NOT EXISTS query.
     *
     * @see useGeoTownsRelatedByFromTownIdExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\GeoTownsQuery The inner query object of the NOT EXISTS statement
     */
    public function useGeoTownsRelatedByFromTownIdNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\GeoTownsQuery */
        $q = $this->useExistsQuery('GeoTownsRelatedByFromTownId', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the GeoTownsRelatedByFromTownId relation to the GeoTowns table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\GeoTownsQuery The inner query object of the IN statement
     */
    public function useInGeoTownsRelatedByFromTownIdQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\GeoTownsQuery */
        $q = $this->useInQuery('GeoTownsRelatedByFromTownId', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the GeoTownsRelatedByFromTownId relation to the GeoTowns table for a NOT IN query.
     *
     * @see useGeoTownsRelatedByFromTownIdInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\GeoTownsQuery The inner query object of the NOT IN statement
     */
    public function useNotInGeoTownsRelatedByFromTownIdQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\GeoTownsQuery */
        $q = $this->useInQuery('GeoTownsRelatedByFromTownId', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\GeoTowns object
     *
     * @param \entities\GeoTowns|ObjectCollection $geoTowns The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByGeoTownsRelatedByToTownId($geoTowns, ?string $comparison = null)
    {
        if ($geoTowns instanceof \entities\GeoTowns) {
            return $this
                ->addUsingAlias(GeoDistanceTableMap::COL_TO_TOWN_ID, $geoTowns->getItownid(), $comparison);
        } elseif ($geoTowns instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(GeoDistanceTableMap::COL_TO_TOWN_ID, $geoTowns->toKeyValue('PrimaryKey', 'Itownid'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByGeoTownsRelatedByToTownId() only accepts arguments of type \entities\GeoTowns or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the GeoTownsRelatedByToTownId relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinGeoTownsRelatedByToTownId(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('GeoTownsRelatedByToTownId');

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
            $this->addJoinObject($join, 'GeoTownsRelatedByToTownId');
        }

        return $this;
    }

    /**
     * Use the GeoTownsRelatedByToTownId relation GeoTowns object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\GeoTownsQuery A secondary query class using the current class as primary query
     */
    public function useGeoTownsRelatedByToTownIdQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinGeoTownsRelatedByToTownId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'GeoTownsRelatedByToTownId', '\entities\GeoTownsQuery');
    }

    /**
     * Use the GeoTownsRelatedByToTownId relation GeoTowns object
     *
     * @param callable(\entities\GeoTownsQuery):\entities\GeoTownsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withGeoTownsRelatedByToTownIdQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useGeoTownsRelatedByToTownIdQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the GeoTownsRelatedByToTownId relation to the GeoTowns table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\GeoTownsQuery The inner query object of the EXISTS statement
     */
    public function useGeoTownsRelatedByToTownIdExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\GeoTownsQuery */
        $q = $this->useExistsQuery('GeoTownsRelatedByToTownId', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the GeoTownsRelatedByToTownId relation to the GeoTowns table for a NOT EXISTS query.
     *
     * @see useGeoTownsRelatedByToTownIdExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\GeoTownsQuery The inner query object of the NOT EXISTS statement
     */
    public function useGeoTownsRelatedByToTownIdNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\GeoTownsQuery */
        $q = $this->useExistsQuery('GeoTownsRelatedByToTownId', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the GeoTownsRelatedByToTownId relation to the GeoTowns table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\GeoTownsQuery The inner query object of the IN statement
     */
    public function useInGeoTownsRelatedByToTownIdQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\GeoTownsQuery */
        $q = $this->useInQuery('GeoTownsRelatedByToTownId', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the GeoTownsRelatedByToTownId relation to the GeoTowns table for a NOT IN query.
     *
     * @see useGeoTownsRelatedByToTownIdInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\GeoTownsQuery The inner query object of the NOT IN statement
     */
    public function useNotInGeoTownsRelatedByToTownIdQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\GeoTownsQuery */
        $q = $this->useInQuery('GeoTownsRelatedByToTownId', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\GeoState object
     *
     * @param \entities\GeoState|ObjectCollection $geoState The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByGeoStateRelatedByFromStateId($geoState, ?string $comparison = null)
    {
        if ($geoState instanceof \entities\GeoState) {
            return $this
                ->addUsingAlias(GeoDistanceTableMap::COL_FROM_STATE_ID, $geoState->getIstateid(), $comparison);
        } elseif ($geoState instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(GeoDistanceTableMap::COL_FROM_STATE_ID, $geoState->toKeyValue('PrimaryKey', 'Istateid'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByGeoStateRelatedByFromStateId() only accepts arguments of type \entities\GeoState or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the GeoStateRelatedByFromStateId relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinGeoStateRelatedByFromStateId(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('GeoStateRelatedByFromStateId');

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
            $this->addJoinObject($join, 'GeoStateRelatedByFromStateId');
        }

        return $this;
    }

    /**
     * Use the GeoStateRelatedByFromStateId relation GeoState object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\GeoStateQuery A secondary query class using the current class as primary query
     */
    public function useGeoStateRelatedByFromStateIdQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinGeoStateRelatedByFromStateId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'GeoStateRelatedByFromStateId', '\entities\GeoStateQuery');
    }

    /**
     * Use the GeoStateRelatedByFromStateId relation GeoState object
     *
     * @param callable(\entities\GeoStateQuery):\entities\GeoStateQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withGeoStateRelatedByFromStateIdQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useGeoStateRelatedByFromStateIdQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the GeoStateRelatedByFromStateId relation to the GeoState table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\GeoStateQuery The inner query object of the EXISTS statement
     */
    public function useGeoStateRelatedByFromStateIdExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\GeoStateQuery */
        $q = $this->useExistsQuery('GeoStateRelatedByFromStateId', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the GeoStateRelatedByFromStateId relation to the GeoState table for a NOT EXISTS query.
     *
     * @see useGeoStateRelatedByFromStateIdExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\GeoStateQuery The inner query object of the NOT EXISTS statement
     */
    public function useGeoStateRelatedByFromStateIdNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\GeoStateQuery */
        $q = $this->useExistsQuery('GeoStateRelatedByFromStateId', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the GeoStateRelatedByFromStateId relation to the GeoState table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\GeoStateQuery The inner query object of the IN statement
     */
    public function useInGeoStateRelatedByFromStateIdQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\GeoStateQuery */
        $q = $this->useInQuery('GeoStateRelatedByFromStateId', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the GeoStateRelatedByFromStateId relation to the GeoState table for a NOT IN query.
     *
     * @see useGeoStateRelatedByFromStateIdInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\GeoStateQuery The inner query object of the NOT IN statement
     */
    public function useNotInGeoStateRelatedByFromStateIdQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\GeoStateQuery */
        $q = $this->useInQuery('GeoStateRelatedByFromStateId', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\GeoState object
     *
     * @param \entities\GeoState|ObjectCollection $geoState The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByGeoStateRelatedByToStateId($geoState, ?string $comparison = null)
    {
        if ($geoState instanceof \entities\GeoState) {
            return $this
                ->addUsingAlias(GeoDistanceTableMap::COL_TO_STATE_ID, $geoState->getIstateid(), $comparison);
        } elseif ($geoState instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(GeoDistanceTableMap::COL_TO_STATE_ID, $geoState->toKeyValue('PrimaryKey', 'Istateid'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByGeoStateRelatedByToStateId() only accepts arguments of type \entities\GeoState or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the GeoStateRelatedByToStateId relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinGeoStateRelatedByToStateId(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('GeoStateRelatedByToStateId');

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
            $this->addJoinObject($join, 'GeoStateRelatedByToStateId');
        }

        return $this;
    }

    /**
     * Use the GeoStateRelatedByToStateId relation GeoState object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\GeoStateQuery A secondary query class using the current class as primary query
     */
    public function useGeoStateRelatedByToStateIdQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinGeoStateRelatedByToStateId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'GeoStateRelatedByToStateId', '\entities\GeoStateQuery');
    }

    /**
     * Use the GeoStateRelatedByToStateId relation GeoState object
     *
     * @param callable(\entities\GeoStateQuery):\entities\GeoStateQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withGeoStateRelatedByToStateIdQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useGeoStateRelatedByToStateIdQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the GeoStateRelatedByToStateId relation to the GeoState table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\GeoStateQuery The inner query object of the EXISTS statement
     */
    public function useGeoStateRelatedByToStateIdExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\GeoStateQuery */
        $q = $this->useExistsQuery('GeoStateRelatedByToStateId', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the GeoStateRelatedByToStateId relation to the GeoState table for a NOT EXISTS query.
     *
     * @see useGeoStateRelatedByToStateIdExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\GeoStateQuery The inner query object of the NOT EXISTS statement
     */
    public function useGeoStateRelatedByToStateIdNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\GeoStateQuery */
        $q = $this->useExistsQuery('GeoStateRelatedByToStateId', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the GeoStateRelatedByToStateId relation to the GeoState table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\GeoStateQuery The inner query object of the IN statement
     */
    public function useInGeoStateRelatedByToStateIdQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\GeoStateQuery */
        $q = $this->useInQuery('GeoStateRelatedByToStateId', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the GeoStateRelatedByToStateId relation to the GeoState table for a NOT IN query.
     *
     * @see useGeoStateRelatedByToStateIdInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\GeoStateQuery The inner query object of the NOT IN statement
     */
    public function useNotInGeoStateRelatedByToStateIdQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\GeoStateQuery */
        $q = $this->useInQuery('GeoStateRelatedByToStateId', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildGeoDistance $geoDistance Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($geoDistance = null)
    {
        if ($geoDistance) {
            $this->addUsingAlias(GeoDistanceTableMap::COL_GEO_DISTANCE_ID, $geoDistance->getGeoDistanceId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the geo_distance table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(GeoDistanceTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            GeoDistanceTableMap::clearInstancePool();
            GeoDistanceTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(GeoDistanceTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(GeoDistanceTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            GeoDistanceTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            GeoDistanceTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
