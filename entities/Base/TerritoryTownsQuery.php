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
use entities\TerritoryTowns as ChildTerritoryTowns;
use entities\TerritoryTownsQuery as ChildTerritoryTownsQuery;
use entities\Map\TerritoryTownsTableMap;

/**
 * Base class that represents a query for the `territory_towns` table.
 *
 * @method     ChildTerritoryTownsQuery orderByTerritoryTownsId($order = Criteria::ASC) Order by the territory_towns_id column
 * @method     ChildTerritoryTownsQuery orderByTerritoryId($order = Criteria::ASC) Order by the territory_id column
 * @method     ChildTerritoryTownsQuery orderByItownid($order = Criteria::ASC) Order by the itownid column
 * @method     ChildTerritoryTownsQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildTerritoryTownsQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildTerritoryTownsQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildTerritoryTownsQuery orderByNca($order = Criteria::ASC) Order by the nca column
 * @method     ChildTerritoryTownsQuery orderByAssignToTripType($order = Criteria::ASC) Order by the assign_to_trip_type column
 * @method     ChildTerritoryTownsQuery orderByOthersTripType($order = Criteria::ASC) Order by the others_trip_type column
 * @method     ChildTerritoryTownsQuery orderByTripType($order = Criteria::ASC) Order by the trip_type column
 * @method     ChildTerritoryTownsQuery orderByOnlyNca($order = Criteria::ASC) Order by the only_nca column
 *
 * @method     ChildTerritoryTownsQuery groupByTerritoryTownsId() Group by the territory_towns_id column
 * @method     ChildTerritoryTownsQuery groupByTerritoryId() Group by the territory_id column
 * @method     ChildTerritoryTownsQuery groupByItownid() Group by the itownid column
 * @method     ChildTerritoryTownsQuery groupByCompanyId() Group by the company_id column
 * @method     ChildTerritoryTownsQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildTerritoryTownsQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildTerritoryTownsQuery groupByNca() Group by the nca column
 * @method     ChildTerritoryTownsQuery groupByAssignToTripType() Group by the assign_to_trip_type column
 * @method     ChildTerritoryTownsQuery groupByOthersTripType() Group by the others_trip_type column
 * @method     ChildTerritoryTownsQuery groupByTripType() Group by the trip_type column
 * @method     ChildTerritoryTownsQuery groupByOnlyNca() Group by the only_nca column
 *
 * @method     ChildTerritoryTownsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildTerritoryTownsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildTerritoryTownsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildTerritoryTownsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildTerritoryTownsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildTerritoryTownsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildTerritoryTownsQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildTerritoryTownsQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildTerritoryTownsQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildTerritoryTownsQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildTerritoryTownsQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildTerritoryTownsQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildTerritoryTownsQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     ChildTerritoryTownsQuery leftJoinTerritories($relationAlias = null) Adds a LEFT JOIN clause to the query using the Territories relation
 * @method     ChildTerritoryTownsQuery rightJoinTerritories($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Territories relation
 * @method     ChildTerritoryTownsQuery innerJoinTerritories($relationAlias = null) Adds a INNER JOIN clause to the query using the Territories relation
 *
 * @method     ChildTerritoryTownsQuery joinWithTerritories($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Territories relation
 *
 * @method     ChildTerritoryTownsQuery leftJoinWithTerritories() Adds a LEFT JOIN clause and with to the query using the Territories relation
 * @method     ChildTerritoryTownsQuery rightJoinWithTerritories() Adds a RIGHT JOIN clause and with to the query using the Territories relation
 * @method     ChildTerritoryTownsQuery innerJoinWithTerritories() Adds a INNER JOIN clause and with to the query using the Territories relation
 *
 * @method     ChildTerritoryTownsQuery leftJoinGeoTowns($relationAlias = null) Adds a LEFT JOIN clause to the query using the GeoTowns relation
 * @method     ChildTerritoryTownsQuery rightJoinGeoTowns($relationAlias = null) Adds a RIGHT JOIN clause to the query using the GeoTowns relation
 * @method     ChildTerritoryTownsQuery innerJoinGeoTowns($relationAlias = null) Adds a INNER JOIN clause to the query using the GeoTowns relation
 *
 * @method     ChildTerritoryTownsQuery joinWithGeoTowns($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the GeoTowns relation
 *
 * @method     ChildTerritoryTownsQuery leftJoinWithGeoTowns() Adds a LEFT JOIN clause and with to the query using the GeoTowns relation
 * @method     ChildTerritoryTownsQuery rightJoinWithGeoTowns() Adds a RIGHT JOIN clause and with to the query using the GeoTowns relation
 * @method     ChildTerritoryTownsQuery innerJoinWithGeoTowns() Adds a INNER JOIN clause and with to the query using the GeoTowns relation
 *
 * @method     \entities\CompanyQuery|\entities\TerritoriesQuery|\entities\GeoTownsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildTerritoryTowns|null findOne(?ConnectionInterface $con = null) Return the first ChildTerritoryTowns matching the query
 * @method     ChildTerritoryTowns findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildTerritoryTowns matching the query, or a new ChildTerritoryTowns object populated from the query conditions when no match is found
 *
 * @method     ChildTerritoryTowns|null findOneByTerritoryTownsId(int $territory_towns_id) Return the first ChildTerritoryTowns filtered by the territory_towns_id column
 * @method     ChildTerritoryTowns|null findOneByTerritoryId(int $territory_id) Return the first ChildTerritoryTowns filtered by the territory_id column
 * @method     ChildTerritoryTowns|null findOneByItownid(int $itownid) Return the first ChildTerritoryTowns filtered by the itownid column
 * @method     ChildTerritoryTowns|null findOneByCompanyId(int $company_id) Return the first ChildTerritoryTowns filtered by the company_id column
 * @method     ChildTerritoryTowns|null findOneByCreatedAt(string $created_at) Return the first ChildTerritoryTowns filtered by the created_at column
 * @method     ChildTerritoryTowns|null findOneByUpdatedAt(string $updated_at) Return the first ChildTerritoryTowns filtered by the updated_at column
 * @method     ChildTerritoryTowns|null findOneByNca(boolean $nca) Return the first ChildTerritoryTowns filtered by the nca column
 * @method     ChildTerritoryTowns|null findOneByAssignToTripType(string $assign_to_trip_type) Return the first ChildTerritoryTowns filtered by the assign_to_trip_type column
 * @method     ChildTerritoryTowns|null findOneByOthersTripType(string $others_trip_type) Return the first ChildTerritoryTowns filtered by the others_trip_type column
 * @method     ChildTerritoryTowns|null findOneByTripType(string $trip_type) Return the first ChildTerritoryTowns filtered by the trip_type column
 * @method     ChildTerritoryTowns|null findOneByOnlyNca(boolean $only_nca) Return the first ChildTerritoryTowns filtered by the only_nca column
 *
 * @method     ChildTerritoryTowns requirePk($key, ?ConnectionInterface $con = null) Return the ChildTerritoryTowns by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTerritoryTowns requireOne(?ConnectionInterface $con = null) Return the first ChildTerritoryTowns matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTerritoryTowns requireOneByTerritoryTownsId(int $territory_towns_id) Return the first ChildTerritoryTowns filtered by the territory_towns_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTerritoryTowns requireOneByTerritoryId(int $territory_id) Return the first ChildTerritoryTowns filtered by the territory_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTerritoryTowns requireOneByItownid(int $itownid) Return the first ChildTerritoryTowns filtered by the itownid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTerritoryTowns requireOneByCompanyId(int $company_id) Return the first ChildTerritoryTowns filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTerritoryTowns requireOneByCreatedAt(string $created_at) Return the first ChildTerritoryTowns filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTerritoryTowns requireOneByUpdatedAt(string $updated_at) Return the first ChildTerritoryTowns filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTerritoryTowns requireOneByNca(boolean $nca) Return the first ChildTerritoryTowns filtered by the nca column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTerritoryTowns requireOneByAssignToTripType(string $assign_to_trip_type) Return the first ChildTerritoryTowns filtered by the assign_to_trip_type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTerritoryTowns requireOneByOthersTripType(string $others_trip_type) Return the first ChildTerritoryTowns filtered by the others_trip_type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTerritoryTowns requireOneByTripType(string $trip_type) Return the first ChildTerritoryTowns filtered by the trip_type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTerritoryTowns requireOneByOnlyNca(boolean $only_nca) Return the first ChildTerritoryTowns filtered by the only_nca column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTerritoryTowns[]|Collection find(?ConnectionInterface $con = null) Return ChildTerritoryTowns objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildTerritoryTowns> find(?ConnectionInterface $con = null) Return ChildTerritoryTowns objects based on current ModelCriteria
 *
 * @method     ChildTerritoryTowns[]|Collection findByTerritoryTownsId(int|array<int> $territory_towns_id) Return ChildTerritoryTowns objects filtered by the territory_towns_id column
 * @psalm-method Collection&\Traversable<ChildTerritoryTowns> findByTerritoryTownsId(int|array<int> $territory_towns_id) Return ChildTerritoryTowns objects filtered by the territory_towns_id column
 * @method     ChildTerritoryTowns[]|Collection findByTerritoryId(int|array<int> $territory_id) Return ChildTerritoryTowns objects filtered by the territory_id column
 * @psalm-method Collection&\Traversable<ChildTerritoryTowns> findByTerritoryId(int|array<int> $territory_id) Return ChildTerritoryTowns objects filtered by the territory_id column
 * @method     ChildTerritoryTowns[]|Collection findByItownid(int|array<int> $itownid) Return ChildTerritoryTowns objects filtered by the itownid column
 * @psalm-method Collection&\Traversable<ChildTerritoryTowns> findByItownid(int|array<int> $itownid) Return ChildTerritoryTowns objects filtered by the itownid column
 * @method     ChildTerritoryTowns[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildTerritoryTowns objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildTerritoryTowns> findByCompanyId(int|array<int> $company_id) Return ChildTerritoryTowns objects filtered by the company_id column
 * @method     ChildTerritoryTowns[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildTerritoryTowns objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildTerritoryTowns> findByCreatedAt(string|array<string> $created_at) Return ChildTerritoryTowns objects filtered by the created_at column
 * @method     ChildTerritoryTowns[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildTerritoryTowns objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildTerritoryTowns> findByUpdatedAt(string|array<string> $updated_at) Return ChildTerritoryTowns objects filtered by the updated_at column
 * @method     ChildTerritoryTowns[]|Collection findByNca(boolean|array<boolean> $nca) Return ChildTerritoryTowns objects filtered by the nca column
 * @psalm-method Collection&\Traversable<ChildTerritoryTowns> findByNca(boolean|array<boolean> $nca) Return ChildTerritoryTowns objects filtered by the nca column
 * @method     ChildTerritoryTowns[]|Collection findByAssignToTripType(string|array<string> $assign_to_trip_type) Return ChildTerritoryTowns objects filtered by the assign_to_trip_type column
 * @psalm-method Collection&\Traversable<ChildTerritoryTowns> findByAssignToTripType(string|array<string> $assign_to_trip_type) Return ChildTerritoryTowns objects filtered by the assign_to_trip_type column
 * @method     ChildTerritoryTowns[]|Collection findByOthersTripType(string|array<string> $others_trip_type) Return ChildTerritoryTowns objects filtered by the others_trip_type column
 * @psalm-method Collection&\Traversable<ChildTerritoryTowns> findByOthersTripType(string|array<string> $others_trip_type) Return ChildTerritoryTowns objects filtered by the others_trip_type column
 * @method     ChildTerritoryTowns[]|Collection findByTripType(string|array<string> $trip_type) Return ChildTerritoryTowns objects filtered by the trip_type column
 * @psalm-method Collection&\Traversable<ChildTerritoryTowns> findByTripType(string|array<string> $trip_type) Return ChildTerritoryTowns objects filtered by the trip_type column
 * @method     ChildTerritoryTowns[]|Collection findByOnlyNca(boolean|array<boolean> $only_nca) Return ChildTerritoryTowns objects filtered by the only_nca column
 * @psalm-method Collection&\Traversable<ChildTerritoryTowns> findByOnlyNca(boolean|array<boolean> $only_nca) Return ChildTerritoryTowns objects filtered by the only_nca column
 *
 * @method     ChildTerritoryTowns[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildTerritoryTowns> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class TerritoryTownsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\TerritoryTownsQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\TerritoryTowns', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildTerritoryTownsQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildTerritoryTownsQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildTerritoryTownsQuery) {
            return $criteria;
        }
        $query = new ChildTerritoryTownsQuery();
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
     * @return ChildTerritoryTowns|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(TerritoryTownsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = TerritoryTownsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildTerritoryTowns A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT territory_towns_id, territory_id, itownid, company_id, created_at, updated_at, nca, assign_to_trip_type, others_trip_type, trip_type, only_nca FROM territory_towns WHERE territory_towns_id = :p0';
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
            /** @var ChildTerritoryTowns $obj */
            $obj = new ChildTerritoryTowns();
            $obj->hydrate($row);
            TerritoryTownsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildTerritoryTowns|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(TerritoryTownsTableMap::COL_TERRITORY_TOWNS_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(TerritoryTownsTableMap::COL_TERRITORY_TOWNS_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the territory_towns_id column
     *
     * Example usage:
     * <code>
     * $query->filterByTerritoryTownsId(1234); // WHERE territory_towns_id = 1234
     * $query->filterByTerritoryTownsId(array(12, 34)); // WHERE territory_towns_id IN (12, 34)
     * $query->filterByTerritoryTownsId(array('min' => 12)); // WHERE territory_towns_id > 12
     * </code>
     *
     * @param mixed $territoryTownsId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTerritoryTownsId($territoryTownsId = null, ?string $comparison = null)
    {
        if (is_array($territoryTownsId)) {
            $useMinMax = false;
            if (isset($territoryTownsId['min'])) {
                $this->addUsingAlias(TerritoryTownsTableMap::COL_TERRITORY_TOWNS_ID, $territoryTownsId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($territoryTownsId['max'])) {
                $this->addUsingAlias(TerritoryTownsTableMap::COL_TERRITORY_TOWNS_ID, $territoryTownsId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TerritoryTownsTableMap::COL_TERRITORY_TOWNS_ID, $territoryTownsId, $comparison);

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
                $this->addUsingAlias(TerritoryTownsTableMap::COL_TERRITORY_ID, $territoryId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($territoryId['max'])) {
                $this->addUsingAlias(TerritoryTownsTableMap::COL_TERRITORY_ID, $territoryId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TerritoryTownsTableMap::COL_TERRITORY_ID, $territoryId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the itownid column
     *
     * Example usage:
     * <code>
     * $query->filterByItownid(1234); // WHERE itownid = 1234
     * $query->filterByItownid(array(12, 34)); // WHERE itownid IN (12, 34)
     * $query->filterByItownid(array('min' => 12)); // WHERE itownid > 12
     * </code>
     *
     * @see       filterByGeoTowns()
     *
     * @param mixed $itownid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByItownid($itownid = null, ?string $comparison = null)
    {
        if (is_array($itownid)) {
            $useMinMax = false;
            if (isset($itownid['min'])) {
                $this->addUsingAlias(TerritoryTownsTableMap::COL_ITOWNID, $itownid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($itownid['max'])) {
                $this->addUsingAlias(TerritoryTownsTableMap::COL_ITOWNID, $itownid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TerritoryTownsTableMap::COL_ITOWNID, $itownid, $comparison);

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
                $this->addUsingAlias(TerritoryTownsTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(TerritoryTownsTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TerritoryTownsTableMap::COL_COMPANY_ID, $companyId, $comparison);

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
                $this->addUsingAlias(TerritoryTownsTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(TerritoryTownsTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TerritoryTownsTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(TerritoryTownsTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(TerritoryTownsTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TerritoryTownsTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the nca column
     *
     * Example usage:
     * <code>
     * $query->filterByNca(true); // WHERE nca = true
     * $query->filterByNca('yes'); // WHERE nca = true
     * </code>
     *
     * @param bool|string $nca The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByNca($nca = null, ?string $comparison = null)
    {
        if (is_string($nca)) {
            $nca = in_array(strtolower($nca), array('false', 'off', '-', 'no', 'n', '0', ''), true) ? false : true;
        }

        $this->addUsingAlias(TerritoryTownsTableMap::COL_NCA, $nca, $comparison);

        return $this;
    }

    /**
     * Filter the query on the assign_to_trip_type column
     *
     * Example usage:
     * <code>
     * $query->filterByAssignToTripType('fooValue');   // WHERE assign_to_trip_type = 'fooValue'
     * $query->filterByAssignToTripType('%fooValue%', Criteria::LIKE); // WHERE assign_to_trip_type LIKE '%fooValue%'
     * $query->filterByAssignToTripType(['foo', 'bar']); // WHERE assign_to_trip_type IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $assignToTripType The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAssignToTripType($assignToTripType = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($assignToTripType)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TerritoryTownsTableMap::COL_ASSIGN_TO_TRIP_TYPE, $assignToTripType, $comparison);

        return $this;
    }

    /**
     * Filter the query on the others_trip_type column
     *
     * Example usage:
     * <code>
     * $query->filterByOthersTripType('fooValue');   // WHERE others_trip_type = 'fooValue'
     * $query->filterByOthersTripType('%fooValue%', Criteria::LIKE); // WHERE others_trip_type LIKE '%fooValue%'
     * $query->filterByOthersTripType(['foo', 'bar']); // WHERE others_trip_type IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $othersTripType The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOthersTripType($othersTripType = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($othersTripType)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TerritoryTownsTableMap::COL_OTHERS_TRIP_TYPE, $othersTripType, $comparison);

        return $this;
    }

    /**
     * Filter the query on the trip_type column
     *
     * Example usage:
     * <code>
     * $query->filterByTripType('fooValue');   // WHERE trip_type = 'fooValue'
     * $query->filterByTripType('%fooValue%', Criteria::LIKE); // WHERE trip_type LIKE '%fooValue%'
     * $query->filterByTripType(['foo', 'bar']); // WHERE trip_type IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $tripType The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTripType($tripType = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tripType)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TerritoryTownsTableMap::COL_TRIP_TYPE, $tripType, $comparison);

        return $this;
    }

    /**
     * Filter the query on the only_nca column
     *
     * Example usage:
     * <code>
     * $query->filterByOnlyNca(true); // WHERE only_nca = true
     * $query->filterByOnlyNca('yes'); // WHERE only_nca = true
     * </code>
     *
     * @param bool|string $onlyNca The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOnlyNca($onlyNca = null, ?string $comparison = null)
    {
        if (is_string($onlyNca)) {
            $onlyNca = in_array(strtolower($onlyNca), array('false', 'off', '-', 'no', 'n', '0', ''), true) ? false : true;
        }

        $this->addUsingAlias(TerritoryTownsTableMap::COL_ONLY_NCA, $onlyNca, $comparison);

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
                ->addUsingAlias(TerritoryTownsTableMap::COL_COMPANY_ID, $company->getCompanyId(), $comparison);
        } elseif ($company instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(TerritoryTownsTableMap::COL_COMPANY_ID, $company->toKeyValue('PrimaryKey', 'CompanyId'), $comparison);

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
                ->addUsingAlias(TerritoryTownsTableMap::COL_TERRITORY_ID, $territories->getTerritoryId(), $comparison);
        } elseif ($territories instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(TerritoryTownsTableMap::COL_TERRITORY_ID, $territories->toKeyValue('PrimaryKey', 'TerritoryId'), $comparison);

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
    public function joinTerritories(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
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
    public function useTerritoriesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
        ?string $joinType = Criteria::INNER_JOIN
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
     * Filter the query by a related \entities\GeoTowns object
     *
     * @param \entities\GeoTowns|ObjectCollection $geoTowns The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByGeoTowns($geoTowns, ?string $comparison = null)
    {
        if ($geoTowns instanceof \entities\GeoTowns) {
            return $this
                ->addUsingAlias(TerritoryTownsTableMap::COL_ITOWNID, $geoTowns->getItownid(), $comparison);
        } elseif ($geoTowns instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(TerritoryTownsTableMap::COL_ITOWNID, $geoTowns->toKeyValue('PrimaryKey', 'Itownid'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByGeoTowns() only accepts arguments of type \entities\GeoTowns or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the GeoTowns relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinGeoTowns(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('GeoTowns');

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
            $this->addJoinObject($join, 'GeoTowns');
        }

        return $this;
    }

    /**
     * Use the GeoTowns relation GeoTowns object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\GeoTownsQuery A secondary query class using the current class as primary query
     */
    public function useGeoTownsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinGeoTowns($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'GeoTowns', '\entities\GeoTownsQuery');
    }

    /**
     * Use the GeoTowns relation GeoTowns object
     *
     * @param callable(\entities\GeoTownsQuery):\entities\GeoTownsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withGeoTownsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useGeoTownsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to GeoTowns table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\GeoTownsQuery The inner query object of the EXISTS statement
     */
    public function useGeoTownsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\GeoTownsQuery */
        $q = $this->useExistsQuery('GeoTowns', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to GeoTowns table for a NOT EXISTS query.
     *
     * @see useGeoTownsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\GeoTownsQuery The inner query object of the NOT EXISTS statement
     */
    public function useGeoTownsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\GeoTownsQuery */
        $q = $this->useExistsQuery('GeoTowns', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to GeoTowns table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\GeoTownsQuery The inner query object of the IN statement
     */
    public function useInGeoTownsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\GeoTownsQuery */
        $q = $this->useInQuery('GeoTowns', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to GeoTowns table for a NOT IN query.
     *
     * @see useGeoTownsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\GeoTownsQuery The inner query object of the NOT IN statement
     */
    public function useNotInGeoTownsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\GeoTownsQuery */
        $q = $this->useInQuery('GeoTowns', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildTerritoryTowns $territoryTowns Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($territoryTowns = null)
    {
        if ($territoryTowns) {
            $this->addUsingAlias(TerritoryTownsTableMap::COL_TERRITORY_TOWNS_ID, $territoryTowns->getTerritoryTownsId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the territory_towns table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(TerritoryTownsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            TerritoryTownsTableMap::clearInstancePool();
            TerritoryTownsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(TerritoryTownsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(TerritoryTownsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            TerritoryTownsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            TerritoryTownsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
