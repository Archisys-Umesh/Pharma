<?php

namespace entities\Base;

use \Exception;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use entities\GeoPincode as ChildGeoPincode;
use entities\GeoPincodeQuery as ChildGeoPincodeQuery;
use entities\Map\GeoPincodeTableMap;

/**
 * Base class that represents a query for the `geo_pincode` table.
 *
 * @method     ChildGeoPincodeQuery orderByPoname($order = Criteria::ASC) Order by the poname column
 * @method     ChildGeoPincodeQuery orderByPincode($order = Criteria::ASC) Order by the pincode column
 * @method     ChildGeoPincodeQuery orderByTaluka($order = Criteria::ASC) Order by the taluka column
 * @method     ChildGeoPincodeQuery orderByDistrict($order = Criteria::ASC) Order by the district column
 * @method     ChildGeoPincodeQuery orderByState($order = Criteria::ASC) Order by the state column
 * @method     ChildGeoPincodeQuery orderByPhone($order = Criteria::ASC) Order by the phone column
 * @method     ChildGeoPincodeQuery orderByLongitude($order = Criteria::ASC) Order by the longitude column
 * @method     ChildGeoPincodeQuery orderByLatitude($order = Criteria::ASC) Order by the latitude column
 *
 * @method     ChildGeoPincodeQuery groupByPoname() Group by the poname column
 * @method     ChildGeoPincodeQuery groupByPincode() Group by the pincode column
 * @method     ChildGeoPincodeQuery groupByTaluka() Group by the taluka column
 * @method     ChildGeoPincodeQuery groupByDistrict() Group by the district column
 * @method     ChildGeoPincodeQuery groupByState() Group by the state column
 * @method     ChildGeoPincodeQuery groupByPhone() Group by the phone column
 * @method     ChildGeoPincodeQuery groupByLongitude() Group by the longitude column
 * @method     ChildGeoPincodeQuery groupByLatitude() Group by the latitude column
 *
 * @method     ChildGeoPincodeQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildGeoPincodeQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildGeoPincodeQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildGeoPincodeQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildGeoPincodeQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildGeoPincodeQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildGeoPincode|null findOne(?ConnectionInterface $con = null) Return the first ChildGeoPincode matching the query
 * @method     ChildGeoPincode findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildGeoPincode matching the query, or a new ChildGeoPincode object populated from the query conditions when no match is found
 *
 * @method     ChildGeoPincode|null findOneByPoname(string $poname) Return the first ChildGeoPincode filtered by the poname column
 * @method     ChildGeoPincode|null findOneByPincode(string $pincode) Return the first ChildGeoPincode filtered by the pincode column
 * @method     ChildGeoPincode|null findOneByTaluka(string $taluka) Return the first ChildGeoPincode filtered by the taluka column
 * @method     ChildGeoPincode|null findOneByDistrict(string $district) Return the first ChildGeoPincode filtered by the district column
 * @method     ChildGeoPincode|null findOneByState(string $state) Return the first ChildGeoPincode filtered by the state column
 * @method     ChildGeoPincode|null findOneByPhone(string $phone) Return the first ChildGeoPincode filtered by the phone column
 * @method     ChildGeoPincode|null findOneByLongitude(string $longitude) Return the first ChildGeoPincode filtered by the longitude column
 * @method     ChildGeoPincode|null findOneByLatitude(string $latitude) Return the first ChildGeoPincode filtered by the latitude column
 *
 * @method     ChildGeoPincode requirePk($key, ?ConnectionInterface $con = null) Return the ChildGeoPincode by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGeoPincode requireOne(?ConnectionInterface $con = null) Return the first ChildGeoPincode matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildGeoPincode requireOneByPoname(string $poname) Return the first ChildGeoPincode filtered by the poname column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGeoPincode requireOneByPincode(string $pincode) Return the first ChildGeoPincode filtered by the pincode column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGeoPincode requireOneByTaluka(string $taluka) Return the first ChildGeoPincode filtered by the taluka column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGeoPincode requireOneByDistrict(string $district) Return the first ChildGeoPincode filtered by the district column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGeoPincode requireOneByState(string $state) Return the first ChildGeoPincode filtered by the state column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGeoPincode requireOneByPhone(string $phone) Return the first ChildGeoPincode filtered by the phone column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGeoPincode requireOneByLongitude(string $longitude) Return the first ChildGeoPincode filtered by the longitude column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGeoPincode requireOneByLatitude(string $latitude) Return the first ChildGeoPincode filtered by the latitude column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildGeoPincode[]|Collection find(?ConnectionInterface $con = null) Return ChildGeoPincode objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildGeoPincode> find(?ConnectionInterface $con = null) Return ChildGeoPincode objects based on current ModelCriteria
 *
 * @method     ChildGeoPincode[]|Collection findByPoname(string|array<string> $poname) Return ChildGeoPincode objects filtered by the poname column
 * @psalm-method Collection&\Traversable<ChildGeoPincode> findByPoname(string|array<string> $poname) Return ChildGeoPincode objects filtered by the poname column
 * @method     ChildGeoPincode[]|Collection findByPincode(string|array<string> $pincode) Return ChildGeoPincode objects filtered by the pincode column
 * @psalm-method Collection&\Traversable<ChildGeoPincode> findByPincode(string|array<string> $pincode) Return ChildGeoPincode objects filtered by the pincode column
 * @method     ChildGeoPincode[]|Collection findByTaluka(string|array<string> $taluka) Return ChildGeoPincode objects filtered by the taluka column
 * @psalm-method Collection&\Traversable<ChildGeoPincode> findByTaluka(string|array<string> $taluka) Return ChildGeoPincode objects filtered by the taluka column
 * @method     ChildGeoPincode[]|Collection findByDistrict(string|array<string> $district) Return ChildGeoPincode objects filtered by the district column
 * @psalm-method Collection&\Traversable<ChildGeoPincode> findByDistrict(string|array<string> $district) Return ChildGeoPincode objects filtered by the district column
 * @method     ChildGeoPincode[]|Collection findByState(string|array<string> $state) Return ChildGeoPincode objects filtered by the state column
 * @psalm-method Collection&\Traversable<ChildGeoPincode> findByState(string|array<string> $state) Return ChildGeoPincode objects filtered by the state column
 * @method     ChildGeoPincode[]|Collection findByPhone(string|array<string> $phone) Return ChildGeoPincode objects filtered by the phone column
 * @psalm-method Collection&\Traversable<ChildGeoPincode> findByPhone(string|array<string> $phone) Return ChildGeoPincode objects filtered by the phone column
 * @method     ChildGeoPincode[]|Collection findByLongitude(string|array<string> $longitude) Return ChildGeoPincode objects filtered by the longitude column
 * @psalm-method Collection&\Traversable<ChildGeoPincode> findByLongitude(string|array<string> $longitude) Return ChildGeoPincode objects filtered by the longitude column
 * @method     ChildGeoPincode[]|Collection findByLatitude(string|array<string> $latitude) Return ChildGeoPincode objects filtered by the latitude column
 * @psalm-method Collection&\Traversable<ChildGeoPincode> findByLatitude(string|array<string> $latitude) Return ChildGeoPincode objects filtered by the latitude column
 *
 * @method     ChildGeoPincode[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildGeoPincode> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class GeoPincodeQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\GeoPincodeQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\GeoPincode', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildGeoPincodeQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildGeoPincodeQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildGeoPincodeQuery) {
            return $criteria;
        }
        $query = new ChildGeoPincodeQuery();
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
     * @return ChildGeoPincode|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        throw new LogicException('The GeoPincode object has no primary key');
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
     * </code>
     * @param array $keys Primary keys to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return Collection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ?ConnectionInterface $con = null)
    {
        throw new LogicException('The GeoPincode object has no primary key');
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
        throw new LogicException('The GeoPincode object has no primary key');
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
        throw new LogicException('The GeoPincode object has no primary key');
    }

    /**
     * Filter the query on the poname column
     *
     * Example usage:
     * <code>
     * $query->filterByPoname('fooValue');   // WHERE poname = 'fooValue'
     * $query->filterByPoname('%fooValue%', Criteria::LIKE); // WHERE poname LIKE '%fooValue%'
     * $query->filterByPoname(['foo', 'bar']); // WHERE poname IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $poname The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPoname($poname = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($poname)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(GeoPincodeTableMap::COL_PONAME, $poname, $comparison);

        return $this;
    }

    /**
     * Filter the query on the pincode column
     *
     * Example usage:
     * <code>
     * $query->filterByPincode('fooValue');   // WHERE pincode = 'fooValue'
     * $query->filterByPincode('%fooValue%', Criteria::LIKE); // WHERE pincode LIKE '%fooValue%'
     * $query->filterByPincode(['foo', 'bar']); // WHERE pincode IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $pincode The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPincode($pincode = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($pincode)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(GeoPincodeTableMap::COL_PINCODE, $pincode, $comparison);

        return $this;
    }

    /**
     * Filter the query on the taluka column
     *
     * Example usage:
     * <code>
     * $query->filterByTaluka('fooValue');   // WHERE taluka = 'fooValue'
     * $query->filterByTaluka('%fooValue%', Criteria::LIKE); // WHERE taluka LIKE '%fooValue%'
     * $query->filterByTaluka(['foo', 'bar']); // WHERE taluka IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $taluka The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTaluka($taluka = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($taluka)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(GeoPincodeTableMap::COL_TALUKA, $taluka, $comparison);

        return $this;
    }

    /**
     * Filter the query on the district column
     *
     * Example usage:
     * <code>
     * $query->filterByDistrict('fooValue');   // WHERE district = 'fooValue'
     * $query->filterByDistrict('%fooValue%', Criteria::LIKE); // WHERE district LIKE '%fooValue%'
     * $query->filterByDistrict(['foo', 'bar']); // WHERE district IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $district The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDistrict($district = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($district)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(GeoPincodeTableMap::COL_DISTRICT, $district, $comparison);

        return $this;
    }

    /**
     * Filter the query on the state column
     *
     * Example usage:
     * <code>
     * $query->filterByState('fooValue');   // WHERE state = 'fooValue'
     * $query->filterByState('%fooValue%', Criteria::LIKE); // WHERE state LIKE '%fooValue%'
     * $query->filterByState(['foo', 'bar']); // WHERE state IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $state The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByState($state = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($state)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(GeoPincodeTableMap::COL_STATE, $state, $comparison);

        return $this;
    }

    /**
     * Filter the query on the phone column
     *
     * Example usage:
     * <code>
     * $query->filterByPhone('fooValue');   // WHERE phone = 'fooValue'
     * $query->filterByPhone('%fooValue%', Criteria::LIKE); // WHERE phone LIKE '%fooValue%'
     * $query->filterByPhone(['foo', 'bar']); // WHERE phone IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $phone The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPhone($phone = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($phone)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(GeoPincodeTableMap::COL_PHONE, $phone, $comparison);

        return $this;
    }

    /**
     * Filter the query on the longitude column
     *
     * Example usage:
     * <code>
     * $query->filterByLongitude('fooValue');   // WHERE longitude = 'fooValue'
     * $query->filterByLongitude('%fooValue%', Criteria::LIKE); // WHERE longitude LIKE '%fooValue%'
     * $query->filterByLongitude(['foo', 'bar']); // WHERE longitude IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $longitude The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLongitude($longitude = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($longitude)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(GeoPincodeTableMap::COL_LONGITUDE, $longitude, $comparison);

        return $this;
    }

    /**
     * Filter the query on the latitude column
     *
     * Example usage:
     * <code>
     * $query->filterByLatitude('fooValue');   // WHERE latitude = 'fooValue'
     * $query->filterByLatitude('%fooValue%', Criteria::LIKE); // WHERE latitude LIKE '%fooValue%'
     * $query->filterByLatitude(['foo', 'bar']); // WHERE latitude IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $latitude The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLatitude($latitude = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($latitude)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(GeoPincodeTableMap::COL_LATITUDE, $latitude, $comparison);

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildGeoPincode $geoPincode Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($geoPincode = null)
    {
        if ($geoPincode) {
            throw new LogicException('GeoPincode object has no primary key');

        }

        return $this;
    }

    /**
     * Deletes all rows from the geo_pincode table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(GeoPincodeTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            GeoPincodeTableMap::clearInstancePool();
            GeoPincodeTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(GeoPincodeTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(GeoPincodeTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            GeoPincodeTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            GeoPincodeTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
