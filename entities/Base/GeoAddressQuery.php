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
use entities\GeoAddress as ChildGeoAddress;
use entities\GeoAddressQuery as ChildGeoAddressQuery;
use entities\Map\GeoAddressTableMap;

/**
 * Base class that represents a query for the `geo_address` table.
 *
 * @method     ChildGeoAddressQuery orderByGeoAddressId($order = Criteria::ASC) Order by the geo_address_id column
 * @method     ChildGeoAddressQuery orderByLatLong($order = Criteria::ASC) Order by the lat_long column
 * @method     ChildGeoAddressQuery orderByZipcode($order = Criteria::ASC) Order by the zipcode column
 * @method     ChildGeoAddressQuery orderByAddress($order = Criteria::ASC) Order by the address column
 * @method     ChildGeoAddressQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildGeoAddressQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildGeoAddressQuery groupByGeoAddressId() Group by the geo_address_id column
 * @method     ChildGeoAddressQuery groupByLatLong() Group by the lat_long column
 * @method     ChildGeoAddressQuery groupByZipcode() Group by the zipcode column
 * @method     ChildGeoAddressQuery groupByAddress() Group by the address column
 * @method     ChildGeoAddressQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildGeoAddressQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildGeoAddressQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildGeoAddressQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildGeoAddressQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildGeoAddressQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildGeoAddressQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildGeoAddressQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildGeoAddress|null findOne(?ConnectionInterface $con = null) Return the first ChildGeoAddress matching the query
 * @method     ChildGeoAddress findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildGeoAddress matching the query, or a new ChildGeoAddress object populated from the query conditions when no match is found
 *
 * @method     ChildGeoAddress|null findOneByGeoAddressId(int $geo_address_id) Return the first ChildGeoAddress filtered by the geo_address_id column
 * @method     ChildGeoAddress|null findOneByLatLong(string $lat_long) Return the first ChildGeoAddress filtered by the lat_long column
 * @method     ChildGeoAddress|null findOneByZipcode(string $zipcode) Return the first ChildGeoAddress filtered by the zipcode column
 * @method     ChildGeoAddress|null findOneByAddress(string $address) Return the first ChildGeoAddress filtered by the address column
 * @method     ChildGeoAddress|null findOneByCreatedAt(string $created_at) Return the first ChildGeoAddress filtered by the created_at column
 * @method     ChildGeoAddress|null findOneByUpdatedAt(string $updated_at) Return the first ChildGeoAddress filtered by the updated_at column
 *
 * @method     ChildGeoAddress requirePk($key, ?ConnectionInterface $con = null) Return the ChildGeoAddress by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGeoAddress requireOne(?ConnectionInterface $con = null) Return the first ChildGeoAddress matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildGeoAddress requireOneByGeoAddressId(int $geo_address_id) Return the first ChildGeoAddress filtered by the geo_address_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGeoAddress requireOneByLatLong(string $lat_long) Return the first ChildGeoAddress filtered by the lat_long column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGeoAddress requireOneByZipcode(string $zipcode) Return the first ChildGeoAddress filtered by the zipcode column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGeoAddress requireOneByAddress(string $address) Return the first ChildGeoAddress filtered by the address column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGeoAddress requireOneByCreatedAt(string $created_at) Return the first ChildGeoAddress filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGeoAddress requireOneByUpdatedAt(string $updated_at) Return the first ChildGeoAddress filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildGeoAddress[]|Collection find(?ConnectionInterface $con = null) Return ChildGeoAddress objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildGeoAddress> find(?ConnectionInterface $con = null) Return ChildGeoAddress objects based on current ModelCriteria
 *
 * @method     ChildGeoAddress[]|Collection findByGeoAddressId(int|array<int> $geo_address_id) Return ChildGeoAddress objects filtered by the geo_address_id column
 * @psalm-method Collection&\Traversable<ChildGeoAddress> findByGeoAddressId(int|array<int> $geo_address_id) Return ChildGeoAddress objects filtered by the geo_address_id column
 * @method     ChildGeoAddress[]|Collection findByLatLong(string|array<string> $lat_long) Return ChildGeoAddress objects filtered by the lat_long column
 * @psalm-method Collection&\Traversable<ChildGeoAddress> findByLatLong(string|array<string> $lat_long) Return ChildGeoAddress objects filtered by the lat_long column
 * @method     ChildGeoAddress[]|Collection findByZipcode(string|array<string> $zipcode) Return ChildGeoAddress objects filtered by the zipcode column
 * @psalm-method Collection&\Traversable<ChildGeoAddress> findByZipcode(string|array<string> $zipcode) Return ChildGeoAddress objects filtered by the zipcode column
 * @method     ChildGeoAddress[]|Collection findByAddress(string|array<string> $address) Return ChildGeoAddress objects filtered by the address column
 * @psalm-method Collection&\Traversable<ChildGeoAddress> findByAddress(string|array<string> $address) Return ChildGeoAddress objects filtered by the address column
 * @method     ChildGeoAddress[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildGeoAddress objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildGeoAddress> findByCreatedAt(string|array<string> $created_at) Return ChildGeoAddress objects filtered by the created_at column
 * @method     ChildGeoAddress[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildGeoAddress objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildGeoAddress> findByUpdatedAt(string|array<string> $updated_at) Return ChildGeoAddress objects filtered by the updated_at column
 *
 * @method     ChildGeoAddress[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildGeoAddress> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class GeoAddressQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\GeoAddressQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\GeoAddress', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildGeoAddressQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildGeoAddressQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildGeoAddressQuery) {
            return $criteria;
        }
        $query = new ChildGeoAddressQuery();
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
     * @return ChildGeoAddress|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(GeoAddressTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = GeoAddressTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildGeoAddress A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT geo_address_id, lat_long, zipcode, address, created_at, updated_at FROM geo_address WHERE geo_address_id = :p0';
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
            /** @var ChildGeoAddress $obj */
            $obj = new ChildGeoAddress();
            $obj->hydrate($row);
            GeoAddressTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildGeoAddress|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(GeoAddressTableMap::COL_GEO_ADDRESS_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(GeoAddressTableMap::COL_GEO_ADDRESS_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the geo_address_id column
     *
     * Example usage:
     * <code>
     * $query->filterByGeoAddressId(1234); // WHERE geo_address_id = 1234
     * $query->filterByGeoAddressId(array(12, 34)); // WHERE geo_address_id IN (12, 34)
     * $query->filterByGeoAddressId(array('min' => 12)); // WHERE geo_address_id > 12
     * </code>
     *
     * @param mixed $geoAddressId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByGeoAddressId($geoAddressId = null, ?string $comparison = null)
    {
        if (is_array($geoAddressId)) {
            $useMinMax = false;
            if (isset($geoAddressId['min'])) {
                $this->addUsingAlias(GeoAddressTableMap::COL_GEO_ADDRESS_ID, $geoAddressId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($geoAddressId['max'])) {
                $this->addUsingAlias(GeoAddressTableMap::COL_GEO_ADDRESS_ID, $geoAddressId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(GeoAddressTableMap::COL_GEO_ADDRESS_ID, $geoAddressId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the lat_long column
     *
     * Example usage:
     * <code>
     * $query->filterByLatLong('fooValue');   // WHERE lat_long = 'fooValue'
     * $query->filterByLatLong('%fooValue%', Criteria::LIKE); // WHERE lat_long LIKE '%fooValue%'
     * $query->filterByLatLong(['foo', 'bar']); // WHERE lat_long IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $latLong The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLatLong($latLong = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($latLong)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(GeoAddressTableMap::COL_LAT_LONG, $latLong, $comparison);

        return $this;
    }

    /**
     * Filter the query on the zipcode column
     *
     * Example usage:
     * <code>
     * $query->filterByZipcode('fooValue');   // WHERE zipcode = 'fooValue'
     * $query->filterByZipcode('%fooValue%', Criteria::LIKE); // WHERE zipcode LIKE '%fooValue%'
     * $query->filterByZipcode(['foo', 'bar']); // WHERE zipcode IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $zipcode The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByZipcode($zipcode = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($zipcode)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(GeoAddressTableMap::COL_ZIPCODE, $zipcode, $comparison);

        return $this;
    }

    /**
     * Filter the query on the address column
     *
     * Example usage:
     * <code>
     * $query->filterByAddress('fooValue');   // WHERE address = 'fooValue'
     * $query->filterByAddress('%fooValue%', Criteria::LIKE); // WHERE address LIKE '%fooValue%'
     * $query->filterByAddress(['foo', 'bar']); // WHERE address IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $address The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAddress($address = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($address)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(GeoAddressTableMap::COL_ADDRESS, $address, $comparison);

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
                $this->addUsingAlias(GeoAddressTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(GeoAddressTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(GeoAddressTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(GeoAddressTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(GeoAddressTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(GeoAddressTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildGeoAddress $geoAddress Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($geoAddress = null)
    {
        if ($geoAddress) {
            $this->addUsingAlias(GeoAddressTableMap::COL_GEO_ADDRESS_ID, $geoAddress->getGeoAddressId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the geo_address table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(GeoAddressTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            GeoAddressTableMap::clearInstancePool();
            GeoAddressTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(GeoAddressTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(GeoAddressTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            GeoAddressTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            GeoAddressTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
