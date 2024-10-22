<?php

namespace entities\Base;

use \Exception;
use \PDO;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;
use entities\Geolocations as ChildGeolocations;
use entities\GeolocationsQuery as ChildGeolocationsQuery;
use entities\Map\GeolocationsTableMap;

/**
 * Base class that represents a query for the `geolocations` table.
 *
 * @method     ChildGeolocationsQuery orderByGeonameid($order = Criteria::ASC) Order by the geonameid column
 * @method     ChildGeolocationsQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildGeolocationsQuery orderByAsciiname($order = Criteria::ASC) Order by the asciiname column
 * @method     ChildGeolocationsQuery orderByAlternatenames($order = Criteria::ASC) Order by the alternatenames column
 * @method     ChildGeolocationsQuery orderByLatitude($order = Criteria::ASC) Order by the latitude column
 * @method     ChildGeolocationsQuery orderByLongitude($order = Criteria::ASC) Order by the longitude column
 * @method     ChildGeolocationsQuery orderByCountryCode($order = Criteria::ASC) Order by the country_code column
 *
 * @method     ChildGeolocationsQuery groupByGeonameid() Group by the geonameid column
 * @method     ChildGeolocationsQuery groupByName() Group by the name column
 * @method     ChildGeolocationsQuery groupByAsciiname() Group by the asciiname column
 * @method     ChildGeolocationsQuery groupByAlternatenames() Group by the alternatenames column
 * @method     ChildGeolocationsQuery groupByLatitude() Group by the latitude column
 * @method     ChildGeolocationsQuery groupByLongitude() Group by the longitude column
 * @method     ChildGeolocationsQuery groupByCountryCode() Group by the country_code column
 *
 * @method     ChildGeolocationsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildGeolocationsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildGeolocationsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildGeolocationsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildGeolocationsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildGeolocationsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildGeolocations|null findOne(?ConnectionInterface $con = null) Return the first ChildGeolocations matching the query
 * @method     ChildGeolocations findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildGeolocations matching the query, or a new ChildGeolocations object populated from the query conditions when no match is found
 *
 * @method     ChildGeolocations|null findOneByGeonameid(int $geonameid) Return the first ChildGeolocations filtered by the geonameid column
 * @method     ChildGeolocations|null findOneByName(string $name) Return the first ChildGeolocations filtered by the name column
 * @method     ChildGeolocations|null findOneByAsciiname(string $asciiname) Return the first ChildGeolocations filtered by the asciiname column
 * @method     ChildGeolocations|null findOneByAlternatenames(string $alternatenames) Return the first ChildGeolocations filtered by the alternatenames column
 * @method     ChildGeolocations|null findOneByLatitude(double $latitude) Return the first ChildGeolocations filtered by the latitude column
 * @method     ChildGeolocations|null findOneByLongitude(double $longitude) Return the first ChildGeolocations filtered by the longitude column
 * @method     ChildGeolocations|null findOneByCountryCode(string $country_code) Return the first ChildGeolocations filtered by the country_code column
 *
 * @method     ChildGeolocations requirePk($key, ?ConnectionInterface $con = null) Return the ChildGeolocations by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGeolocations requireOne(?ConnectionInterface $con = null) Return the first ChildGeolocations matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildGeolocations requireOneByGeonameid(int $geonameid) Return the first ChildGeolocations filtered by the geonameid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGeolocations requireOneByName(string $name) Return the first ChildGeolocations filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGeolocations requireOneByAsciiname(string $asciiname) Return the first ChildGeolocations filtered by the asciiname column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGeolocations requireOneByAlternatenames(string $alternatenames) Return the first ChildGeolocations filtered by the alternatenames column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGeolocations requireOneByLatitude(double $latitude) Return the first ChildGeolocations filtered by the latitude column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGeolocations requireOneByLongitude(double $longitude) Return the first ChildGeolocations filtered by the longitude column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGeolocations requireOneByCountryCode(string $country_code) Return the first ChildGeolocations filtered by the country_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildGeolocations[]|Collection find(?ConnectionInterface $con = null) Return ChildGeolocations objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildGeolocations> find(?ConnectionInterface $con = null) Return ChildGeolocations objects based on current ModelCriteria
 *
 * @method     ChildGeolocations[]|Collection findByGeonameid(int|array<int> $geonameid) Return ChildGeolocations objects filtered by the geonameid column
 * @psalm-method Collection&\Traversable<ChildGeolocations> findByGeonameid(int|array<int> $geonameid) Return ChildGeolocations objects filtered by the geonameid column
 * @method     ChildGeolocations[]|Collection findByName(string|array<string> $name) Return ChildGeolocations objects filtered by the name column
 * @psalm-method Collection&\Traversable<ChildGeolocations> findByName(string|array<string> $name) Return ChildGeolocations objects filtered by the name column
 * @method     ChildGeolocations[]|Collection findByAsciiname(string|array<string> $asciiname) Return ChildGeolocations objects filtered by the asciiname column
 * @psalm-method Collection&\Traversable<ChildGeolocations> findByAsciiname(string|array<string> $asciiname) Return ChildGeolocations objects filtered by the asciiname column
 * @method     ChildGeolocations[]|Collection findByAlternatenames(string|array<string> $alternatenames) Return ChildGeolocations objects filtered by the alternatenames column
 * @psalm-method Collection&\Traversable<ChildGeolocations> findByAlternatenames(string|array<string> $alternatenames) Return ChildGeolocations objects filtered by the alternatenames column
 * @method     ChildGeolocations[]|Collection findByLatitude(double|array<double> $latitude) Return ChildGeolocations objects filtered by the latitude column
 * @psalm-method Collection&\Traversable<ChildGeolocations> findByLatitude(double|array<double> $latitude) Return ChildGeolocations objects filtered by the latitude column
 * @method     ChildGeolocations[]|Collection findByLongitude(double|array<double> $longitude) Return ChildGeolocations objects filtered by the longitude column
 * @psalm-method Collection&\Traversable<ChildGeolocations> findByLongitude(double|array<double> $longitude) Return ChildGeolocations objects filtered by the longitude column
 * @method     ChildGeolocations[]|Collection findByCountryCode(string|array<string> $country_code) Return ChildGeolocations objects filtered by the country_code column
 * @psalm-method Collection&\Traversable<ChildGeolocations> findByCountryCode(string|array<string> $country_code) Return ChildGeolocations objects filtered by the country_code column
 *
 * @method     ChildGeolocations[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildGeolocations> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class GeolocationsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\GeolocationsQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\Geolocations', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildGeolocationsQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildGeolocationsQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildGeolocationsQuery) {
            return $criteria;
        }
        $query = new ChildGeolocationsQuery();
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
     * @return ChildGeolocations|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(GeolocationsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = GeolocationsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildGeolocations A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT geonameid, name, asciiname, alternatenames, latitude, longitude, country_code FROM geolocations WHERE geonameid = :p0';
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
            /** @var ChildGeolocations $obj */
            $obj = new ChildGeolocations();
            $obj->hydrate($row);
            GeolocationsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildGeolocations|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(GeolocationsTableMap::COL_GEONAMEID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(GeolocationsTableMap::COL_GEONAMEID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the geonameid column
     *
     * Example usage:
     * <code>
     * $query->filterByGeonameid(1234); // WHERE geonameid = 1234
     * $query->filterByGeonameid(array(12, 34)); // WHERE geonameid IN (12, 34)
     * $query->filterByGeonameid(array('min' => 12)); // WHERE geonameid > 12
     * </code>
     *
     * @param mixed $geonameid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByGeonameid($geonameid = null, ?string $comparison = null)
    {
        if (is_array($geonameid)) {
            $useMinMax = false;
            if (isset($geonameid['min'])) {
                $this->addUsingAlias(GeolocationsTableMap::COL_GEONAMEID, $geonameid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($geonameid['max'])) {
                $this->addUsingAlias(GeolocationsTableMap::COL_GEONAMEID, $geonameid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(GeolocationsTableMap::COL_GEONAMEID, $geonameid, $comparison);

        return $this;
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%', Criteria::LIKE); // WHERE name LIKE '%fooValue%'
     * $query->filterByName(['foo', 'bar']); // WHERE name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $name The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByName($name = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(GeolocationsTableMap::COL_NAME, $name, $comparison);

        return $this;
    }

    /**
     * Filter the query on the asciiname column
     *
     * Example usage:
     * <code>
     * $query->filterByAsciiname('fooValue');   // WHERE asciiname = 'fooValue'
     * $query->filterByAsciiname('%fooValue%', Criteria::LIKE); // WHERE asciiname LIKE '%fooValue%'
     * $query->filterByAsciiname(['foo', 'bar']); // WHERE asciiname IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $asciiname The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAsciiname($asciiname = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($asciiname)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(GeolocationsTableMap::COL_ASCIINAME, $asciiname, $comparison);

        return $this;
    }

    /**
     * Filter the query on the alternatenames column
     *
     * Example usage:
     * <code>
     * $query->filterByAlternatenames('fooValue');   // WHERE alternatenames = 'fooValue'
     * $query->filterByAlternatenames('%fooValue%', Criteria::LIKE); // WHERE alternatenames LIKE '%fooValue%'
     * $query->filterByAlternatenames(['foo', 'bar']); // WHERE alternatenames IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $alternatenames The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAlternatenames($alternatenames = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($alternatenames)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(GeolocationsTableMap::COL_ALTERNATENAMES, $alternatenames, $comparison);

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
                $this->addUsingAlias(GeolocationsTableMap::COL_LATITUDE, $latitude['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($latitude['max'])) {
                $this->addUsingAlias(GeolocationsTableMap::COL_LATITUDE, $latitude['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(GeolocationsTableMap::COL_LATITUDE, $latitude, $comparison);

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
                $this->addUsingAlias(GeolocationsTableMap::COL_LONGITUDE, $longitude['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($longitude['max'])) {
                $this->addUsingAlias(GeolocationsTableMap::COL_LONGITUDE, $longitude['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(GeolocationsTableMap::COL_LONGITUDE, $longitude, $comparison);

        return $this;
    }

    /**
     * Filter the query on the country_code column
     *
     * Example usage:
     * <code>
     * $query->filterByCountryCode('fooValue');   // WHERE country_code = 'fooValue'
     * $query->filterByCountryCode('%fooValue%', Criteria::LIKE); // WHERE country_code LIKE '%fooValue%'
     * $query->filterByCountryCode(['foo', 'bar']); // WHERE country_code IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $countryCode The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCountryCode($countryCode = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($countryCode)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(GeolocationsTableMap::COL_COUNTRY_CODE, $countryCode, $comparison);

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildGeolocations $geolocations Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($geolocations = null)
    {
        if ($geolocations) {
            $this->addUsingAlias(GeolocationsTableMap::COL_GEONAMEID, $geolocations->getGeonameid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the geolocations table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(GeolocationsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            GeolocationsTableMap::clearInstancePool();
            GeolocationsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(GeolocationsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(GeolocationsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            GeolocationsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            GeolocationsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
