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
use entities\GeoCity as ChildGeoCity;
use entities\GeoCityQuery as ChildGeoCityQuery;
use entities\Map\GeoCityTableMap;

/**
 * Base class that represents a query for the `geo_city` table.
 *
 * @method     ChildGeoCityQuery orderByIcityid($order = Criteria::ASC) Order by the icityid column
 * @method     ChildGeoCityQuery orderByScityname($order = Criteria::ASC) Order by the scityname column
 * @method     ChildGeoCityQuery orderByScitycode($order = Criteria::ASC) Order by the scitycode column
 * @method     ChildGeoCityQuery orderByIstateid($order = Criteria::ASC) Order by the istateid column
 * @method     ChildGeoCityQuery orderByIcountryid($order = Criteria::ASC) Order by the icountryid column
 * @method     ChildGeoCityQuery orderByDcreateddate($order = Criteria::ASC) Order by the dcreateddate column
 * @method     ChildGeoCityQuery orderByDmodifydate($order = Criteria::ASC) Order by the dmodifydate column
 * @method     ChildGeoCityQuery orderBySstatus($order = Criteria::ASC) Order by the sstatus column
 * @method     ChildGeoCityQuery orderByLongitude($order = Criteria::ASC) Order by the longitude column
 * @method     ChildGeoCityQuery orderByLatitude($order = Criteria::ASC) Order by the latitude column
 *
 * @method     ChildGeoCityQuery groupByIcityid() Group by the icityid column
 * @method     ChildGeoCityQuery groupByScityname() Group by the scityname column
 * @method     ChildGeoCityQuery groupByScitycode() Group by the scitycode column
 * @method     ChildGeoCityQuery groupByIstateid() Group by the istateid column
 * @method     ChildGeoCityQuery groupByIcountryid() Group by the icountryid column
 * @method     ChildGeoCityQuery groupByDcreateddate() Group by the dcreateddate column
 * @method     ChildGeoCityQuery groupByDmodifydate() Group by the dmodifydate column
 * @method     ChildGeoCityQuery groupBySstatus() Group by the sstatus column
 * @method     ChildGeoCityQuery groupByLongitude() Group by the longitude column
 * @method     ChildGeoCityQuery groupByLatitude() Group by the latitude column
 *
 * @method     ChildGeoCityQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildGeoCityQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildGeoCityQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildGeoCityQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildGeoCityQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildGeoCityQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildGeoCityQuery leftJoinGeoState($relationAlias = null) Adds a LEFT JOIN clause to the query using the GeoState relation
 * @method     ChildGeoCityQuery rightJoinGeoState($relationAlias = null) Adds a RIGHT JOIN clause to the query using the GeoState relation
 * @method     ChildGeoCityQuery innerJoinGeoState($relationAlias = null) Adds a INNER JOIN clause to the query using the GeoState relation
 *
 * @method     ChildGeoCityQuery joinWithGeoState($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the GeoState relation
 *
 * @method     ChildGeoCityQuery leftJoinWithGeoState() Adds a LEFT JOIN clause and with to the query using the GeoState relation
 * @method     ChildGeoCityQuery rightJoinWithGeoState() Adds a RIGHT JOIN clause and with to the query using the GeoState relation
 * @method     ChildGeoCityQuery innerJoinWithGeoState() Adds a INNER JOIN clause and with to the query using the GeoState relation
 *
 * @method     ChildGeoCityQuery leftJoinGeoCountry($relationAlias = null) Adds a LEFT JOIN clause to the query using the GeoCountry relation
 * @method     ChildGeoCityQuery rightJoinGeoCountry($relationAlias = null) Adds a RIGHT JOIN clause to the query using the GeoCountry relation
 * @method     ChildGeoCityQuery innerJoinGeoCountry($relationAlias = null) Adds a INNER JOIN clause to the query using the GeoCountry relation
 *
 * @method     ChildGeoCityQuery joinWithGeoCountry($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the GeoCountry relation
 *
 * @method     ChildGeoCityQuery leftJoinWithGeoCountry() Adds a LEFT JOIN clause and with to the query using the GeoCountry relation
 * @method     ChildGeoCityQuery rightJoinWithGeoCountry() Adds a RIGHT JOIN clause and with to the query using the GeoCountry relation
 * @method     ChildGeoCityQuery innerJoinWithGeoCountry() Adds a INNER JOIN clause and with to the query using the GeoCountry relation
 *
 * @method     ChildGeoCityQuery leftJoinGeoTowns($relationAlias = null) Adds a LEFT JOIN clause to the query using the GeoTowns relation
 * @method     ChildGeoCityQuery rightJoinGeoTowns($relationAlias = null) Adds a RIGHT JOIN clause to the query using the GeoTowns relation
 * @method     ChildGeoCityQuery innerJoinGeoTowns($relationAlias = null) Adds a INNER JOIN clause to the query using the GeoTowns relation
 *
 * @method     ChildGeoCityQuery joinWithGeoTowns($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the GeoTowns relation
 *
 * @method     ChildGeoCityQuery leftJoinWithGeoTowns() Adds a LEFT JOIN clause and with to the query using the GeoTowns relation
 * @method     ChildGeoCityQuery rightJoinWithGeoTowns() Adds a RIGHT JOIN clause and with to the query using the GeoTowns relation
 * @method     ChildGeoCityQuery innerJoinWithGeoTowns() Adds a INNER JOIN clause and with to the query using the GeoTowns relation
 *
 * @method     ChildGeoCityQuery leftJoinOnBoardRequestAddress($relationAlias = null) Adds a LEFT JOIN clause to the query using the OnBoardRequestAddress relation
 * @method     ChildGeoCityQuery rightJoinOnBoardRequestAddress($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OnBoardRequestAddress relation
 * @method     ChildGeoCityQuery innerJoinOnBoardRequestAddress($relationAlias = null) Adds a INNER JOIN clause to the query using the OnBoardRequestAddress relation
 *
 * @method     ChildGeoCityQuery joinWithOnBoardRequestAddress($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OnBoardRequestAddress relation
 *
 * @method     ChildGeoCityQuery leftJoinWithOnBoardRequestAddress() Adds a LEFT JOIN clause and with to the query using the OnBoardRequestAddress relation
 * @method     ChildGeoCityQuery rightJoinWithOnBoardRequestAddress() Adds a RIGHT JOIN clause and with to the query using the OnBoardRequestAddress relation
 * @method     ChildGeoCityQuery innerJoinWithOnBoardRequestAddress() Adds a INNER JOIN clause and with to the query using the OnBoardRequestAddress relation
 *
 * @method     \entities\GeoStateQuery|\entities\GeoCountryQuery|\entities\GeoTownsQuery|\entities\OnBoardRequestAddressQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildGeoCity|null findOne(?ConnectionInterface $con = null) Return the first ChildGeoCity matching the query
 * @method     ChildGeoCity findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildGeoCity matching the query, or a new ChildGeoCity object populated from the query conditions when no match is found
 *
 * @method     ChildGeoCity|null findOneByIcityid(string $icityid) Return the first ChildGeoCity filtered by the icityid column
 * @method     ChildGeoCity|null findOneByScityname(string $scityname) Return the first ChildGeoCity filtered by the scityname column
 * @method     ChildGeoCity|null findOneByScitycode(string $scitycode) Return the first ChildGeoCity filtered by the scitycode column
 * @method     ChildGeoCity|null findOneByIstateid(int $istateid) Return the first ChildGeoCity filtered by the istateid column
 * @method     ChildGeoCity|null findOneByIcountryid(int $icountryid) Return the first ChildGeoCity filtered by the icountryid column
 * @method     ChildGeoCity|null findOneByDcreateddate(string $dcreateddate) Return the first ChildGeoCity filtered by the dcreateddate column
 * @method     ChildGeoCity|null findOneByDmodifydate(string $dmodifydate) Return the first ChildGeoCity filtered by the dmodifydate column
 * @method     ChildGeoCity|null findOneBySstatus(string $sstatus) Return the first ChildGeoCity filtered by the sstatus column
 * @method     ChildGeoCity|null findOneByLongitude(string $longitude) Return the first ChildGeoCity filtered by the longitude column
 * @method     ChildGeoCity|null findOneByLatitude(string $latitude) Return the first ChildGeoCity filtered by the latitude column
 *
 * @method     ChildGeoCity requirePk($key, ?ConnectionInterface $con = null) Return the ChildGeoCity by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGeoCity requireOne(?ConnectionInterface $con = null) Return the first ChildGeoCity matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildGeoCity requireOneByIcityid(string $icityid) Return the first ChildGeoCity filtered by the icityid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGeoCity requireOneByScityname(string $scityname) Return the first ChildGeoCity filtered by the scityname column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGeoCity requireOneByScitycode(string $scitycode) Return the first ChildGeoCity filtered by the scitycode column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGeoCity requireOneByIstateid(int $istateid) Return the first ChildGeoCity filtered by the istateid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGeoCity requireOneByIcountryid(int $icountryid) Return the first ChildGeoCity filtered by the icountryid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGeoCity requireOneByDcreateddate(string $dcreateddate) Return the first ChildGeoCity filtered by the dcreateddate column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGeoCity requireOneByDmodifydate(string $dmodifydate) Return the first ChildGeoCity filtered by the dmodifydate column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGeoCity requireOneBySstatus(string $sstatus) Return the first ChildGeoCity filtered by the sstatus column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGeoCity requireOneByLongitude(string $longitude) Return the first ChildGeoCity filtered by the longitude column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGeoCity requireOneByLatitude(string $latitude) Return the first ChildGeoCity filtered by the latitude column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildGeoCity[]|Collection find(?ConnectionInterface $con = null) Return ChildGeoCity objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildGeoCity> find(?ConnectionInterface $con = null) Return ChildGeoCity objects based on current ModelCriteria
 *
 * @method     ChildGeoCity[]|Collection findByIcityid(string|array<string> $icityid) Return ChildGeoCity objects filtered by the icityid column
 * @psalm-method Collection&\Traversable<ChildGeoCity> findByIcityid(string|array<string> $icityid) Return ChildGeoCity objects filtered by the icityid column
 * @method     ChildGeoCity[]|Collection findByScityname(string|array<string> $scityname) Return ChildGeoCity objects filtered by the scityname column
 * @psalm-method Collection&\Traversable<ChildGeoCity> findByScityname(string|array<string> $scityname) Return ChildGeoCity objects filtered by the scityname column
 * @method     ChildGeoCity[]|Collection findByScitycode(string|array<string> $scitycode) Return ChildGeoCity objects filtered by the scitycode column
 * @psalm-method Collection&\Traversable<ChildGeoCity> findByScitycode(string|array<string> $scitycode) Return ChildGeoCity objects filtered by the scitycode column
 * @method     ChildGeoCity[]|Collection findByIstateid(int|array<int> $istateid) Return ChildGeoCity objects filtered by the istateid column
 * @psalm-method Collection&\Traversable<ChildGeoCity> findByIstateid(int|array<int> $istateid) Return ChildGeoCity objects filtered by the istateid column
 * @method     ChildGeoCity[]|Collection findByIcountryid(int|array<int> $icountryid) Return ChildGeoCity objects filtered by the icountryid column
 * @psalm-method Collection&\Traversable<ChildGeoCity> findByIcountryid(int|array<int> $icountryid) Return ChildGeoCity objects filtered by the icountryid column
 * @method     ChildGeoCity[]|Collection findByDcreateddate(string|array<string> $dcreateddate) Return ChildGeoCity objects filtered by the dcreateddate column
 * @psalm-method Collection&\Traversable<ChildGeoCity> findByDcreateddate(string|array<string> $dcreateddate) Return ChildGeoCity objects filtered by the dcreateddate column
 * @method     ChildGeoCity[]|Collection findByDmodifydate(string|array<string> $dmodifydate) Return ChildGeoCity objects filtered by the dmodifydate column
 * @psalm-method Collection&\Traversable<ChildGeoCity> findByDmodifydate(string|array<string> $dmodifydate) Return ChildGeoCity objects filtered by the dmodifydate column
 * @method     ChildGeoCity[]|Collection findBySstatus(string|array<string> $sstatus) Return ChildGeoCity objects filtered by the sstatus column
 * @psalm-method Collection&\Traversable<ChildGeoCity> findBySstatus(string|array<string> $sstatus) Return ChildGeoCity objects filtered by the sstatus column
 * @method     ChildGeoCity[]|Collection findByLongitude(string|array<string> $longitude) Return ChildGeoCity objects filtered by the longitude column
 * @psalm-method Collection&\Traversable<ChildGeoCity> findByLongitude(string|array<string> $longitude) Return ChildGeoCity objects filtered by the longitude column
 * @method     ChildGeoCity[]|Collection findByLatitude(string|array<string> $latitude) Return ChildGeoCity objects filtered by the latitude column
 * @psalm-method Collection&\Traversable<ChildGeoCity> findByLatitude(string|array<string> $latitude) Return ChildGeoCity objects filtered by the latitude column
 *
 * @method     ChildGeoCity[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildGeoCity> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class GeoCityQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\GeoCityQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\GeoCity', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildGeoCityQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildGeoCityQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildGeoCityQuery) {
            return $criteria;
        }
        $query = new ChildGeoCityQuery();
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
     * @return ChildGeoCity|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(GeoCityTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = GeoCityTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildGeoCity A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT icityid, scityname, scitycode, istateid, icountryid, dcreateddate, dmodifydate, sstatus, longitude, latitude FROM geo_city WHERE icityid = :p0';
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
            /** @var ChildGeoCity $obj */
            $obj = new ChildGeoCity();
            $obj->hydrate($row);
            GeoCityTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildGeoCity|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(GeoCityTableMap::COL_ICITYID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(GeoCityTableMap::COL_ICITYID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the icityid column
     *
     * Example usage:
     * <code>
     * $query->filterByIcityid(1234); // WHERE icityid = 1234
     * $query->filterByIcityid(array(12, 34)); // WHERE icityid IN (12, 34)
     * $query->filterByIcityid(array('min' => 12)); // WHERE icityid > 12
     * </code>
     *
     * @param mixed $icityid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIcityid($icityid = null, ?string $comparison = null)
    {
        if (is_array($icityid)) {
            $useMinMax = false;
            if (isset($icityid['min'])) {
                $this->addUsingAlias(GeoCityTableMap::COL_ICITYID, $icityid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($icityid['max'])) {
                $this->addUsingAlias(GeoCityTableMap::COL_ICITYID, $icityid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(GeoCityTableMap::COL_ICITYID, $icityid, $comparison);

        return $this;
    }

    /**
     * Filter the query on the scityname column
     *
     * Example usage:
     * <code>
     * $query->filterByScityname('fooValue');   // WHERE scityname = 'fooValue'
     * $query->filterByScityname('%fooValue%', Criteria::LIKE); // WHERE scityname LIKE '%fooValue%'
     * $query->filterByScityname(['foo', 'bar']); // WHERE scityname IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $scityname The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByScityname($scityname = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($scityname)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(GeoCityTableMap::COL_SCITYNAME, $scityname, $comparison);

        return $this;
    }

    /**
     * Filter the query on the scitycode column
     *
     * Example usage:
     * <code>
     * $query->filterByScitycode('fooValue');   // WHERE scitycode = 'fooValue'
     * $query->filterByScitycode('%fooValue%', Criteria::LIKE); // WHERE scitycode LIKE '%fooValue%'
     * $query->filterByScitycode(['foo', 'bar']); // WHERE scitycode IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $scitycode The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByScitycode($scitycode = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($scitycode)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(GeoCityTableMap::COL_SCITYCODE, $scitycode, $comparison);

        return $this;
    }

    /**
     * Filter the query on the istateid column
     *
     * Example usage:
     * <code>
     * $query->filterByIstateid(1234); // WHERE istateid = 1234
     * $query->filterByIstateid(array(12, 34)); // WHERE istateid IN (12, 34)
     * $query->filterByIstateid(array('min' => 12)); // WHERE istateid > 12
     * </code>
     *
     * @see       filterByGeoState()
     *
     * @param mixed $istateid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIstateid($istateid = null, ?string $comparison = null)
    {
        if (is_array($istateid)) {
            $useMinMax = false;
            if (isset($istateid['min'])) {
                $this->addUsingAlias(GeoCityTableMap::COL_ISTATEID, $istateid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($istateid['max'])) {
                $this->addUsingAlias(GeoCityTableMap::COL_ISTATEID, $istateid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(GeoCityTableMap::COL_ISTATEID, $istateid, $comparison);

        return $this;
    }

    /**
     * Filter the query on the icountryid column
     *
     * Example usage:
     * <code>
     * $query->filterByIcountryid(1234); // WHERE icountryid = 1234
     * $query->filterByIcountryid(array(12, 34)); // WHERE icountryid IN (12, 34)
     * $query->filterByIcountryid(array('min' => 12)); // WHERE icountryid > 12
     * </code>
     *
     * @see       filterByGeoCountry()
     *
     * @param mixed $icountryid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIcountryid($icountryid = null, ?string $comparison = null)
    {
        if (is_array($icountryid)) {
            $useMinMax = false;
            if (isset($icountryid['min'])) {
                $this->addUsingAlias(GeoCityTableMap::COL_ICOUNTRYID, $icountryid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($icountryid['max'])) {
                $this->addUsingAlias(GeoCityTableMap::COL_ICOUNTRYID, $icountryid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(GeoCityTableMap::COL_ICOUNTRYID, $icountryid, $comparison);

        return $this;
    }

    /**
     * Filter the query on the dcreateddate column
     *
     * Example usage:
     * <code>
     * $query->filterByDcreateddate('2011-03-14'); // WHERE dcreateddate = '2011-03-14'
     * $query->filterByDcreateddate('now'); // WHERE dcreateddate = '2011-03-14'
     * $query->filterByDcreateddate(array('max' => 'yesterday')); // WHERE dcreateddate > '2011-03-13'
     * </code>
     *
     * @param mixed $dcreateddate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDcreateddate($dcreateddate = null, ?string $comparison = null)
    {
        if (is_array($dcreateddate)) {
            $useMinMax = false;
            if (isset($dcreateddate['min'])) {
                $this->addUsingAlias(GeoCityTableMap::COL_DCREATEDDATE, $dcreateddate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dcreateddate['max'])) {
                $this->addUsingAlias(GeoCityTableMap::COL_DCREATEDDATE, $dcreateddate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(GeoCityTableMap::COL_DCREATEDDATE, $dcreateddate, $comparison);

        return $this;
    }

    /**
     * Filter the query on the dmodifydate column
     *
     * Example usage:
     * <code>
     * $query->filterByDmodifydate('2011-03-14'); // WHERE dmodifydate = '2011-03-14'
     * $query->filterByDmodifydate('now'); // WHERE dmodifydate = '2011-03-14'
     * $query->filterByDmodifydate(array('max' => 'yesterday')); // WHERE dmodifydate > '2011-03-13'
     * </code>
     *
     * @param mixed $dmodifydate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDmodifydate($dmodifydate = null, ?string $comparison = null)
    {
        if (is_array($dmodifydate)) {
            $useMinMax = false;
            if (isset($dmodifydate['min'])) {
                $this->addUsingAlias(GeoCityTableMap::COL_DMODIFYDATE, $dmodifydate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dmodifydate['max'])) {
                $this->addUsingAlias(GeoCityTableMap::COL_DMODIFYDATE, $dmodifydate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(GeoCityTableMap::COL_DMODIFYDATE, $dmodifydate, $comparison);

        return $this;
    }

    /**
     * Filter the query on the sstatus column
     *
     * Example usage:
     * <code>
     * $query->filterBySstatus('fooValue');   // WHERE sstatus = 'fooValue'
     * $query->filterBySstatus('%fooValue%', Criteria::LIKE); // WHERE sstatus LIKE '%fooValue%'
     * $query->filterBySstatus(['foo', 'bar']); // WHERE sstatus IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $sstatus The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySstatus($sstatus = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($sstatus)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(GeoCityTableMap::COL_SSTATUS, $sstatus, $comparison);

        return $this;
    }

    /**
     * Filter the query on the longitude column
     *
     * Example usage:
     * <code>
     * $query->filterByLongitude(1234); // WHERE longitude = 1234
     * $query->filterByLongitude(array(12, 34)); // WHERE longitude IN (12, 34)
     * $query->filterByLongitude(array('min' => 12)); // WHERE longitude > 12
     * </code>
     *
     * @param mixed $longitude The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLongitude($longitude = null, ?string $comparison = null)
    {
        if (is_array($longitude)) {
            $useMinMax = false;
            if (isset($longitude['min'])) {
                $this->addUsingAlias(GeoCityTableMap::COL_LONGITUDE, $longitude['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($longitude['max'])) {
                $this->addUsingAlias(GeoCityTableMap::COL_LONGITUDE, $longitude['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(GeoCityTableMap::COL_LONGITUDE, $longitude, $comparison);

        return $this;
    }

    /**
     * Filter the query on the latitude column
     *
     * Example usage:
     * <code>
     * $query->filterByLatitude(1234); // WHERE latitude = 1234
     * $query->filterByLatitude(array(12, 34)); // WHERE latitude IN (12, 34)
     * $query->filterByLatitude(array('min' => 12)); // WHERE latitude > 12
     * </code>
     *
     * @param mixed $latitude The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLatitude($latitude = null, ?string $comparison = null)
    {
        if (is_array($latitude)) {
            $useMinMax = false;
            if (isset($latitude['min'])) {
                $this->addUsingAlias(GeoCityTableMap::COL_LATITUDE, $latitude['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($latitude['max'])) {
                $this->addUsingAlias(GeoCityTableMap::COL_LATITUDE, $latitude['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(GeoCityTableMap::COL_LATITUDE, $latitude, $comparison);

        return $this;
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
    public function filterByGeoState($geoState, ?string $comparison = null)
    {
        if ($geoState instanceof \entities\GeoState) {
            return $this
                ->addUsingAlias(GeoCityTableMap::COL_ISTATEID, $geoState->getIstateid(), $comparison);
        } elseif ($geoState instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(GeoCityTableMap::COL_ISTATEID, $geoState->toKeyValue('PrimaryKey', 'Istateid'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByGeoState() only accepts arguments of type \entities\GeoState or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the GeoState relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinGeoState(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('GeoState');

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
            $this->addJoinObject($join, 'GeoState');
        }

        return $this;
    }

    /**
     * Use the GeoState relation GeoState object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\GeoStateQuery A secondary query class using the current class as primary query
     */
    public function useGeoStateQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinGeoState($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'GeoState', '\entities\GeoStateQuery');
    }

    /**
     * Use the GeoState relation GeoState object
     *
     * @param callable(\entities\GeoStateQuery):\entities\GeoStateQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withGeoStateQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useGeoStateQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to GeoState table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\GeoStateQuery The inner query object of the EXISTS statement
     */
    public function useGeoStateExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\GeoStateQuery */
        $q = $this->useExistsQuery('GeoState', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to GeoState table for a NOT EXISTS query.
     *
     * @see useGeoStateExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\GeoStateQuery The inner query object of the NOT EXISTS statement
     */
    public function useGeoStateNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\GeoStateQuery */
        $q = $this->useExistsQuery('GeoState', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to GeoState table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\GeoStateQuery The inner query object of the IN statement
     */
    public function useInGeoStateQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\GeoStateQuery */
        $q = $this->useInQuery('GeoState', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to GeoState table for a NOT IN query.
     *
     * @see useGeoStateInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\GeoStateQuery The inner query object of the NOT IN statement
     */
    public function useNotInGeoStateQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\GeoStateQuery */
        $q = $this->useInQuery('GeoState', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\GeoCountry object
     *
     * @param \entities\GeoCountry|ObjectCollection $geoCountry The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByGeoCountry($geoCountry, ?string $comparison = null)
    {
        if ($geoCountry instanceof \entities\GeoCountry) {
            return $this
                ->addUsingAlias(GeoCityTableMap::COL_ICOUNTRYID, $geoCountry->getIcountryid(), $comparison);
        } elseif ($geoCountry instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(GeoCityTableMap::COL_ICOUNTRYID, $geoCountry->toKeyValue('PrimaryKey', 'Icountryid'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByGeoCountry() only accepts arguments of type \entities\GeoCountry or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the GeoCountry relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinGeoCountry(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('GeoCountry');

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
            $this->addJoinObject($join, 'GeoCountry');
        }

        return $this;
    }

    /**
     * Use the GeoCountry relation GeoCountry object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\GeoCountryQuery A secondary query class using the current class as primary query
     */
    public function useGeoCountryQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinGeoCountry($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'GeoCountry', '\entities\GeoCountryQuery');
    }

    /**
     * Use the GeoCountry relation GeoCountry object
     *
     * @param callable(\entities\GeoCountryQuery):\entities\GeoCountryQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withGeoCountryQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useGeoCountryQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to GeoCountry table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\GeoCountryQuery The inner query object of the EXISTS statement
     */
    public function useGeoCountryExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\GeoCountryQuery */
        $q = $this->useExistsQuery('GeoCountry', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to GeoCountry table for a NOT EXISTS query.
     *
     * @see useGeoCountryExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\GeoCountryQuery The inner query object of the NOT EXISTS statement
     */
    public function useGeoCountryNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\GeoCountryQuery */
        $q = $this->useExistsQuery('GeoCountry', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to GeoCountry table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\GeoCountryQuery The inner query object of the IN statement
     */
    public function useInGeoCountryQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\GeoCountryQuery */
        $q = $this->useInQuery('GeoCountry', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to GeoCountry table for a NOT IN query.
     *
     * @see useGeoCountryInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\GeoCountryQuery The inner query object of the NOT IN statement
     */
    public function useNotInGeoCountryQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\GeoCountryQuery */
        $q = $this->useInQuery('GeoCountry', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\GeoTowns object
     *
     * @param \entities\GeoTowns|ObjectCollection $geoTowns the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByGeoTowns($geoTowns, ?string $comparison = null)
    {
        if ($geoTowns instanceof \entities\GeoTowns) {
            $this
                ->addUsingAlias(GeoCityTableMap::COL_ICITYID, $geoTowns->getIcityid(), $comparison);

            return $this;
        } elseif ($geoTowns instanceof ObjectCollection) {
            $this
                ->useGeoTownsQuery()
                ->filterByPrimaryKeys($geoTowns->getPrimaryKeys())
                ->endUse();

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
    public function joinGeoTowns(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
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
    public function useGeoTownsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
        ?string $joinType = Criteria::LEFT_JOIN
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
     * Filter the query by a related \entities\OnBoardRequestAddress object
     *
     * @param \entities\OnBoardRequestAddress|ObjectCollection $onBoardRequestAddress the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOnBoardRequestAddress($onBoardRequestAddress, ?string $comparison = null)
    {
        if ($onBoardRequestAddress instanceof \entities\OnBoardRequestAddress) {
            $this
                ->addUsingAlias(GeoCityTableMap::COL_ICITYID, $onBoardRequestAddress->getIcityid(), $comparison);

            return $this;
        } elseif ($onBoardRequestAddress instanceof ObjectCollection) {
            $this
                ->useOnBoardRequestAddressQuery()
                ->filterByPrimaryKeys($onBoardRequestAddress->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByOnBoardRequestAddress() only accepts arguments of type \entities\OnBoardRequestAddress or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OnBoardRequestAddress relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOnBoardRequestAddress(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OnBoardRequestAddress');

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
            $this->addJoinObject($join, 'OnBoardRequestAddress');
        }

        return $this;
    }

    /**
     * Use the OnBoardRequestAddress relation OnBoardRequestAddress object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\OnBoardRequestAddressQuery A secondary query class using the current class as primary query
     */
    public function useOnBoardRequestAddressQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinOnBoardRequestAddress($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OnBoardRequestAddress', '\entities\OnBoardRequestAddressQuery');
    }

    /**
     * Use the OnBoardRequestAddress relation OnBoardRequestAddress object
     *
     * @param callable(\entities\OnBoardRequestAddressQuery):\entities\OnBoardRequestAddressQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOnBoardRequestAddressQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useOnBoardRequestAddressQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to OnBoardRequestAddress table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\OnBoardRequestAddressQuery The inner query object of the EXISTS statement
     */
    public function useOnBoardRequestAddressExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\OnBoardRequestAddressQuery */
        $q = $this->useExistsQuery('OnBoardRequestAddress', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to OnBoardRequestAddress table for a NOT EXISTS query.
     *
     * @see useOnBoardRequestAddressExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\OnBoardRequestAddressQuery The inner query object of the NOT EXISTS statement
     */
    public function useOnBoardRequestAddressNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OnBoardRequestAddressQuery */
        $q = $this->useExistsQuery('OnBoardRequestAddress', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to OnBoardRequestAddress table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\OnBoardRequestAddressQuery The inner query object of the IN statement
     */
    public function useInOnBoardRequestAddressQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\OnBoardRequestAddressQuery */
        $q = $this->useInQuery('OnBoardRequestAddress', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to OnBoardRequestAddress table for a NOT IN query.
     *
     * @see useOnBoardRequestAddressInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\OnBoardRequestAddressQuery The inner query object of the NOT IN statement
     */
    public function useNotInOnBoardRequestAddressQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OnBoardRequestAddressQuery */
        $q = $this->useInQuery('OnBoardRequestAddress', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildGeoCity $geoCity Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($geoCity = null)
    {
        if ($geoCity) {
            $this->addUsingAlias(GeoCityTableMap::COL_ICITYID, $geoCity->getIcityid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the geo_city table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(GeoCityTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            GeoCityTableMap::clearInstancePool();
            GeoCityTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(GeoCityTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(GeoCityTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            GeoCityTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            GeoCityTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
