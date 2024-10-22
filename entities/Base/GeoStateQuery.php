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
use entities\GeoState as ChildGeoState;
use entities\GeoStateQuery as ChildGeoStateQuery;
use entities\Map\GeoStateTableMap;

/**
 * Base class that represents a query for the `geo_state` table.
 *
 * @method     ChildGeoStateQuery orderByIstateid($order = Criteria::ASC) Order by the istateid column
 * @method     ChildGeoStateQuery orderBySstatename($order = Criteria::ASC) Order by the sstatename column
 * @method     ChildGeoStateQuery orderBySstatecode($order = Criteria::ASC) Order by the sstatecode column
 * @method     ChildGeoStateQuery orderByDcreateddate($order = Criteria::ASC) Order by the dcreateddate column
 * @method     ChildGeoStateQuery orderByDmodifydate($order = Criteria::ASC) Order by the dmodifydate column
 * @method     ChildGeoStateQuery orderByCountryId($order = Criteria::ASC) Order by the country_id column
 * @method     ChildGeoStateQuery orderBySstatus($order = Criteria::ASC) Order by the sstatus column
 *
 * @method     ChildGeoStateQuery groupByIstateid() Group by the istateid column
 * @method     ChildGeoStateQuery groupBySstatename() Group by the sstatename column
 * @method     ChildGeoStateQuery groupBySstatecode() Group by the sstatecode column
 * @method     ChildGeoStateQuery groupByDcreateddate() Group by the dcreateddate column
 * @method     ChildGeoStateQuery groupByDmodifydate() Group by the dmodifydate column
 * @method     ChildGeoStateQuery groupByCountryId() Group by the country_id column
 * @method     ChildGeoStateQuery groupBySstatus() Group by the sstatus column
 *
 * @method     ChildGeoStateQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildGeoStateQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildGeoStateQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildGeoStateQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildGeoStateQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildGeoStateQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildGeoStateQuery leftJoinGeoCountry($relationAlias = null) Adds a LEFT JOIN clause to the query using the GeoCountry relation
 * @method     ChildGeoStateQuery rightJoinGeoCountry($relationAlias = null) Adds a RIGHT JOIN clause to the query using the GeoCountry relation
 * @method     ChildGeoStateQuery innerJoinGeoCountry($relationAlias = null) Adds a INNER JOIN clause to the query using the GeoCountry relation
 *
 * @method     ChildGeoStateQuery joinWithGeoCountry($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the GeoCountry relation
 *
 * @method     ChildGeoStateQuery leftJoinWithGeoCountry() Adds a LEFT JOIN clause and with to the query using the GeoCountry relation
 * @method     ChildGeoStateQuery rightJoinWithGeoCountry() Adds a RIGHT JOIN clause and with to the query using the GeoCountry relation
 * @method     ChildGeoStateQuery innerJoinWithGeoCountry() Adds a INNER JOIN clause and with to the query using the GeoCountry relation
 *
 * @method     ChildGeoStateQuery leftJoinBranch($relationAlias = null) Adds a LEFT JOIN clause to the query using the Branch relation
 * @method     ChildGeoStateQuery rightJoinBranch($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Branch relation
 * @method     ChildGeoStateQuery innerJoinBranch($relationAlias = null) Adds a INNER JOIN clause to the query using the Branch relation
 *
 * @method     ChildGeoStateQuery joinWithBranch($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Branch relation
 *
 * @method     ChildGeoStateQuery leftJoinWithBranch() Adds a LEFT JOIN clause and with to the query using the Branch relation
 * @method     ChildGeoStateQuery rightJoinWithBranch() Adds a RIGHT JOIN clause and with to the query using the Branch relation
 * @method     ChildGeoStateQuery innerJoinWithBranch() Adds a INNER JOIN clause and with to the query using the Branch relation
 *
 * @method     ChildGeoStateQuery leftJoinGeoCity($relationAlias = null) Adds a LEFT JOIN clause to the query using the GeoCity relation
 * @method     ChildGeoStateQuery rightJoinGeoCity($relationAlias = null) Adds a RIGHT JOIN clause to the query using the GeoCity relation
 * @method     ChildGeoStateQuery innerJoinGeoCity($relationAlias = null) Adds a INNER JOIN clause to the query using the GeoCity relation
 *
 * @method     ChildGeoStateQuery joinWithGeoCity($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the GeoCity relation
 *
 * @method     ChildGeoStateQuery leftJoinWithGeoCity() Adds a LEFT JOIN clause and with to the query using the GeoCity relation
 * @method     ChildGeoStateQuery rightJoinWithGeoCity() Adds a RIGHT JOIN clause and with to the query using the GeoCity relation
 * @method     ChildGeoStateQuery innerJoinWithGeoCity() Adds a INNER JOIN clause and with to the query using the GeoCity relation
 *
 * @method     ChildGeoStateQuery leftJoinGeoDistanceRelatedByFromStateId($relationAlias = null) Adds a LEFT JOIN clause to the query using the GeoDistanceRelatedByFromStateId relation
 * @method     ChildGeoStateQuery rightJoinGeoDistanceRelatedByFromStateId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the GeoDistanceRelatedByFromStateId relation
 * @method     ChildGeoStateQuery innerJoinGeoDistanceRelatedByFromStateId($relationAlias = null) Adds a INNER JOIN clause to the query using the GeoDistanceRelatedByFromStateId relation
 *
 * @method     ChildGeoStateQuery joinWithGeoDistanceRelatedByFromStateId($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the GeoDistanceRelatedByFromStateId relation
 *
 * @method     ChildGeoStateQuery leftJoinWithGeoDistanceRelatedByFromStateId() Adds a LEFT JOIN clause and with to the query using the GeoDistanceRelatedByFromStateId relation
 * @method     ChildGeoStateQuery rightJoinWithGeoDistanceRelatedByFromStateId() Adds a RIGHT JOIN clause and with to the query using the GeoDistanceRelatedByFromStateId relation
 * @method     ChildGeoStateQuery innerJoinWithGeoDistanceRelatedByFromStateId() Adds a INNER JOIN clause and with to the query using the GeoDistanceRelatedByFromStateId relation
 *
 * @method     ChildGeoStateQuery leftJoinGeoDistanceRelatedByToStateId($relationAlias = null) Adds a LEFT JOIN clause to the query using the GeoDistanceRelatedByToStateId relation
 * @method     ChildGeoStateQuery rightJoinGeoDistanceRelatedByToStateId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the GeoDistanceRelatedByToStateId relation
 * @method     ChildGeoStateQuery innerJoinGeoDistanceRelatedByToStateId($relationAlias = null) Adds a INNER JOIN clause to the query using the GeoDistanceRelatedByToStateId relation
 *
 * @method     ChildGeoStateQuery joinWithGeoDistanceRelatedByToStateId($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the GeoDistanceRelatedByToStateId relation
 *
 * @method     ChildGeoStateQuery leftJoinWithGeoDistanceRelatedByToStateId() Adds a LEFT JOIN clause and with to the query using the GeoDistanceRelatedByToStateId relation
 * @method     ChildGeoStateQuery rightJoinWithGeoDistanceRelatedByToStateId() Adds a RIGHT JOIN clause and with to the query using the GeoDistanceRelatedByToStateId relation
 * @method     ChildGeoStateQuery innerJoinWithGeoDistanceRelatedByToStateId() Adds a INNER JOIN clause and with to the query using the GeoDistanceRelatedByToStateId relation
 *
 * @method     ChildGeoStateQuery leftJoinHolidays($relationAlias = null) Adds a LEFT JOIN clause to the query using the Holidays relation
 * @method     ChildGeoStateQuery rightJoinHolidays($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Holidays relation
 * @method     ChildGeoStateQuery innerJoinHolidays($relationAlias = null) Adds a INNER JOIN clause to the query using the Holidays relation
 *
 * @method     ChildGeoStateQuery joinWithHolidays($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Holidays relation
 *
 * @method     ChildGeoStateQuery leftJoinWithHolidays() Adds a LEFT JOIN clause and with to the query using the Holidays relation
 * @method     ChildGeoStateQuery rightJoinWithHolidays() Adds a RIGHT JOIN clause and with to the query using the Holidays relation
 * @method     ChildGeoStateQuery innerJoinWithHolidays() Adds a INNER JOIN clause and with to the query using the Holidays relation
 *
 * @method     ChildGeoStateQuery leftJoinOnBoardRequestAddress($relationAlias = null) Adds a LEFT JOIN clause to the query using the OnBoardRequestAddress relation
 * @method     ChildGeoStateQuery rightJoinOnBoardRequestAddress($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OnBoardRequestAddress relation
 * @method     ChildGeoStateQuery innerJoinOnBoardRequestAddress($relationAlias = null) Adds a INNER JOIN clause to the query using the OnBoardRequestAddress relation
 *
 * @method     ChildGeoStateQuery joinWithOnBoardRequestAddress($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OnBoardRequestAddress relation
 *
 * @method     ChildGeoStateQuery leftJoinWithOnBoardRequestAddress() Adds a LEFT JOIN clause and with to the query using the OnBoardRequestAddress relation
 * @method     ChildGeoStateQuery rightJoinWithOnBoardRequestAddress() Adds a RIGHT JOIN clause and with to the query using the OnBoardRequestAddress relation
 * @method     ChildGeoStateQuery innerJoinWithOnBoardRequestAddress() Adds a INNER JOIN clause and with to the query using the OnBoardRequestAddress relation
 *
 * @method     \entities\GeoCountryQuery|\entities\BranchQuery|\entities\GeoCityQuery|\entities\GeoDistanceQuery|\entities\GeoDistanceQuery|\entities\HolidaysQuery|\entities\OnBoardRequestAddressQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildGeoState|null findOne(?ConnectionInterface $con = null) Return the first ChildGeoState matching the query
 * @method     ChildGeoState findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildGeoState matching the query, or a new ChildGeoState object populated from the query conditions when no match is found
 *
 * @method     ChildGeoState|null findOneByIstateid(int $istateid) Return the first ChildGeoState filtered by the istateid column
 * @method     ChildGeoState|null findOneBySstatename(string $sstatename) Return the first ChildGeoState filtered by the sstatename column
 * @method     ChildGeoState|null findOneBySstatecode(string $sstatecode) Return the first ChildGeoState filtered by the sstatecode column
 * @method     ChildGeoState|null findOneByDcreateddate(string $dcreateddate) Return the first ChildGeoState filtered by the dcreateddate column
 * @method     ChildGeoState|null findOneByDmodifydate(string $dmodifydate) Return the first ChildGeoState filtered by the dmodifydate column
 * @method     ChildGeoState|null findOneByCountryId(int $country_id) Return the first ChildGeoState filtered by the country_id column
 * @method     ChildGeoState|null findOneBySstatus(string $sstatus) Return the first ChildGeoState filtered by the sstatus column
 *
 * @method     ChildGeoState requirePk($key, ?ConnectionInterface $con = null) Return the ChildGeoState by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGeoState requireOne(?ConnectionInterface $con = null) Return the first ChildGeoState matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildGeoState requireOneByIstateid(int $istateid) Return the first ChildGeoState filtered by the istateid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGeoState requireOneBySstatename(string $sstatename) Return the first ChildGeoState filtered by the sstatename column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGeoState requireOneBySstatecode(string $sstatecode) Return the first ChildGeoState filtered by the sstatecode column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGeoState requireOneByDcreateddate(string $dcreateddate) Return the first ChildGeoState filtered by the dcreateddate column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGeoState requireOneByDmodifydate(string $dmodifydate) Return the first ChildGeoState filtered by the dmodifydate column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGeoState requireOneByCountryId(int $country_id) Return the first ChildGeoState filtered by the country_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGeoState requireOneBySstatus(string $sstatus) Return the first ChildGeoState filtered by the sstatus column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildGeoState[]|Collection find(?ConnectionInterface $con = null) Return ChildGeoState objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildGeoState> find(?ConnectionInterface $con = null) Return ChildGeoState objects based on current ModelCriteria
 *
 * @method     ChildGeoState[]|Collection findByIstateid(int|array<int> $istateid) Return ChildGeoState objects filtered by the istateid column
 * @psalm-method Collection&\Traversable<ChildGeoState> findByIstateid(int|array<int> $istateid) Return ChildGeoState objects filtered by the istateid column
 * @method     ChildGeoState[]|Collection findBySstatename(string|array<string> $sstatename) Return ChildGeoState objects filtered by the sstatename column
 * @psalm-method Collection&\Traversable<ChildGeoState> findBySstatename(string|array<string> $sstatename) Return ChildGeoState objects filtered by the sstatename column
 * @method     ChildGeoState[]|Collection findBySstatecode(string|array<string> $sstatecode) Return ChildGeoState objects filtered by the sstatecode column
 * @psalm-method Collection&\Traversable<ChildGeoState> findBySstatecode(string|array<string> $sstatecode) Return ChildGeoState objects filtered by the sstatecode column
 * @method     ChildGeoState[]|Collection findByDcreateddate(string|array<string> $dcreateddate) Return ChildGeoState objects filtered by the dcreateddate column
 * @psalm-method Collection&\Traversable<ChildGeoState> findByDcreateddate(string|array<string> $dcreateddate) Return ChildGeoState objects filtered by the dcreateddate column
 * @method     ChildGeoState[]|Collection findByDmodifydate(string|array<string> $dmodifydate) Return ChildGeoState objects filtered by the dmodifydate column
 * @psalm-method Collection&\Traversable<ChildGeoState> findByDmodifydate(string|array<string> $dmodifydate) Return ChildGeoState objects filtered by the dmodifydate column
 * @method     ChildGeoState[]|Collection findByCountryId(int|array<int> $country_id) Return ChildGeoState objects filtered by the country_id column
 * @psalm-method Collection&\Traversable<ChildGeoState> findByCountryId(int|array<int> $country_id) Return ChildGeoState objects filtered by the country_id column
 * @method     ChildGeoState[]|Collection findBySstatus(string|array<string> $sstatus) Return ChildGeoState objects filtered by the sstatus column
 * @psalm-method Collection&\Traversable<ChildGeoState> findBySstatus(string|array<string> $sstatus) Return ChildGeoState objects filtered by the sstatus column
 *
 * @method     ChildGeoState[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildGeoState> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class GeoStateQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\GeoStateQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\GeoState', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildGeoStateQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildGeoStateQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildGeoStateQuery) {
            return $criteria;
        }
        $query = new ChildGeoStateQuery();
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
     * @return ChildGeoState|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(GeoStateTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = GeoStateTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildGeoState A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT istateid, sstatename, sstatecode, dcreateddate, dmodifydate, country_id, sstatus FROM geo_state WHERE istateid = :p0';
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
            /** @var ChildGeoState $obj */
            $obj = new ChildGeoState();
            $obj->hydrate($row);
            GeoStateTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildGeoState|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(GeoStateTableMap::COL_ISTATEID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(GeoStateTableMap::COL_ISTATEID, $keys, Criteria::IN);

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
                $this->addUsingAlias(GeoStateTableMap::COL_ISTATEID, $istateid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($istateid['max'])) {
                $this->addUsingAlias(GeoStateTableMap::COL_ISTATEID, $istateid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(GeoStateTableMap::COL_ISTATEID, $istateid, $comparison);

        return $this;
    }

    /**
     * Filter the query on the sstatename column
     *
     * Example usage:
     * <code>
     * $query->filterBySstatename('fooValue');   // WHERE sstatename = 'fooValue'
     * $query->filterBySstatename('%fooValue%', Criteria::LIKE); // WHERE sstatename LIKE '%fooValue%'
     * $query->filterBySstatename(['foo', 'bar']); // WHERE sstatename IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $sstatename The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySstatename($sstatename = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($sstatename)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(GeoStateTableMap::COL_SSTATENAME, $sstatename, $comparison);

        return $this;
    }

    /**
     * Filter the query on the sstatecode column
     *
     * Example usage:
     * <code>
     * $query->filterBySstatecode('fooValue');   // WHERE sstatecode = 'fooValue'
     * $query->filterBySstatecode('%fooValue%', Criteria::LIKE); // WHERE sstatecode LIKE '%fooValue%'
     * $query->filterBySstatecode(['foo', 'bar']); // WHERE sstatecode IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $sstatecode The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySstatecode($sstatecode = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($sstatecode)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(GeoStateTableMap::COL_SSTATECODE, $sstatecode, $comparison);

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
                $this->addUsingAlias(GeoStateTableMap::COL_DCREATEDDATE, $dcreateddate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dcreateddate['max'])) {
                $this->addUsingAlias(GeoStateTableMap::COL_DCREATEDDATE, $dcreateddate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(GeoStateTableMap::COL_DCREATEDDATE, $dcreateddate, $comparison);

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
                $this->addUsingAlias(GeoStateTableMap::COL_DMODIFYDATE, $dmodifydate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dmodifydate['max'])) {
                $this->addUsingAlias(GeoStateTableMap::COL_DMODIFYDATE, $dmodifydate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(GeoStateTableMap::COL_DMODIFYDATE, $dmodifydate, $comparison);

        return $this;
    }

    /**
     * Filter the query on the country_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCountryId(1234); // WHERE country_id = 1234
     * $query->filterByCountryId(array(12, 34)); // WHERE country_id IN (12, 34)
     * $query->filterByCountryId(array('min' => 12)); // WHERE country_id > 12
     * </code>
     *
     * @see       filterByGeoCountry()
     *
     * @param mixed $countryId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCountryId($countryId = null, ?string $comparison = null)
    {
        if (is_array($countryId)) {
            $useMinMax = false;
            if (isset($countryId['min'])) {
                $this->addUsingAlias(GeoStateTableMap::COL_COUNTRY_ID, $countryId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($countryId['max'])) {
                $this->addUsingAlias(GeoStateTableMap::COL_COUNTRY_ID, $countryId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(GeoStateTableMap::COL_COUNTRY_ID, $countryId, $comparison);

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

        $this->addUsingAlias(GeoStateTableMap::COL_SSTATUS, $sstatus, $comparison);

        return $this;
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
                ->addUsingAlias(GeoStateTableMap::COL_COUNTRY_ID, $geoCountry->getIcountryid(), $comparison);
        } elseif ($geoCountry instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(GeoStateTableMap::COL_COUNTRY_ID, $geoCountry->toKeyValue('PrimaryKey', 'Icountryid'), $comparison);

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
     * Filter the query by a related \entities\Branch object
     *
     * @param \entities\Branch|ObjectCollection $branch the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBranch($branch, ?string $comparison = null)
    {
        if ($branch instanceof \entities\Branch) {
            $this
                ->addUsingAlias(GeoStateTableMap::COL_ISTATEID, $branch->getIstateid(), $comparison);

            return $this;
        } elseif ($branch instanceof ObjectCollection) {
            $this
                ->useBranchQuery()
                ->filterByPrimaryKeys($branch->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByBranch() only accepts arguments of type \entities\Branch or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Branch relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinBranch(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Branch');

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
            $this->addJoinObject($join, 'Branch');
        }

        return $this;
    }

    /**
     * Use the Branch relation Branch object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\BranchQuery A secondary query class using the current class as primary query
     */
    public function useBranchQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinBranch($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Branch', '\entities\BranchQuery');
    }

    /**
     * Use the Branch relation Branch object
     *
     * @param callable(\entities\BranchQuery):\entities\BranchQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withBranchQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useBranchQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Branch table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\BranchQuery The inner query object of the EXISTS statement
     */
    public function useBranchExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\BranchQuery */
        $q = $this->useExistsQuery('Branch', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Branch table for a NOT EXISTS query.
     *
     * @see useBranchExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\BranchQuery The inner query object of the NOT EXISTS statement
     */
    public function useBranchNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\BranchQuery */
        $q = $this->useExistsQuery('Branch', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Branch table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\BranchQuery The inner query object of the IN statement
     */
    public function useInBranchQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\BranchQuery */
        $q = $this->useInQuery('Branch', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Branch table for a NOT IN query.
     *
     * @see useBranchInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\BranchQuery The inner query object of the NOT IN statement
     */
    public function useNotInBranchQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\BranchQuery */
        $q = $this->useInQuery('Branch', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\GeoCity object
     *
     * @param \entities\GeoCity|ObjectCollection $geoCity the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByGeoCity($geoCity, ?string $comparison = null)
    {
        if ($geoCity instanceof \entities\GeoCity) {
            $this
                ->addUsingAlias(GeoStateTableMap::COL_ISTATEID, $geoCity->getIstateid(), $comparison);

            return $this;
        } elseif ($geoCity instanceof ObjectCollection) {
            $this
                ->useGeoCityQuery()
                ->filterByPrimaryKeys($geoCity->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByGeoCity() only accepts arguments of type \entities\GeoCity or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the GeoCity relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinGeoCity(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('GeoCity');

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
            $this->addJoinObject($join, 'GeoCity');
        }

        return $this;
    }

    /**
     * Use the GeoCity relation GeoCity object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\GeoCityQuery A secondary query class using the current class as primary query
     */
    public function useGeoCityQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinGeoCity($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'GeoCity', '\entities\GeoCityQuery');
    }

    /**
     * Use the GeoCity relation GeoCity object
     *
     * @param callable(\entities\GeoCityQuery):\entities\GeoCityQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withGeoCityQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useGeoCityQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to GeoCity table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\GeoCityQuery The inner query object of the EXISTS statement
     */
    public function useGeoCityExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\GeoCityQuery */
        $q = $this->useExistsQuery('GeoCity', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to GeoCity table for a NOT EXISTS query.
     *
     * @see useGeoCityExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\GeoCityQuery The inner query object of the NOT EXISTS statement
     */
    public function useGeoCityNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\GeoCityQuery */
        $q = $this->useExistsQuery('GeoCity', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to GeoCity table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\GeoCityQuery The inner query object of the IN statement
     */
    public function useInGeoCityQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\GeoCityQuery */
        $q = $this->useInQuery('GeoCity', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to GeoCity table for a NOT IN query.
     *
     * @see useGeoCityInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\GeoCityQuery The inner query object of the NOT IN statement
     */
    public function useNotInGeoCityQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\GeoCityQuery */
        $q = $this->useInQuery('GeoCity', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\GeoDistance object
     *
     * @param \entities\GeoDistance|ObjectCollection $geoDistance the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByGeoDistanceRelatedByFromStateId($geoDistance, ?string $comparison = null)
    {
        if ($geoDistance instanceof \entities\GeoDistance) {
            $this
                ->addUsingAlias(GeoStateTableMap::COL_ISTATEID, $geoDistance->getFromStateId(), $comparison);

            return $this;
        } elseif ($geoDistance instanceof ObjectCollection) {
            $this
                ->useGeoDistanceRelatedByFromStateIdQuery()
                ->filterByPrimaryKeys($geoDistance->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByGeoDistanceRelatedByFromStateId() only accepts arguments of type \entities\GeoDistance or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the GeoDistanceRelatedByFromStateId relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinGeoDistanceRelatedByFromStateId(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('GeoDistanceRelatedByFromStateId');

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
            $this->addJoinObject($join, 'GeoDistanceRelatedByFromStateId');
        }

        return $this;
    }

    /**
     * Use the GeoDistanceRelatedByFromStateId relation GeoDistance object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\GeoDistanceQuery A secondary query class using the current class as primary query
     */
    public function useGeoDistanceRelatedByFromStateIdQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinGeoDistanceRelatedByFromStateId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'GeoDistanceRelatedByFromStateId', '\entities\GeoDistanceQuery');
    }

    /**
     * Use the GeoDistanceRelatedByFromStateId relation GeoDistance object
     *
     * @param callable(\entities\GeoDistanceQuery):\entities\GeoDistanceQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withGeoDistanceRelatedByFromStateIdQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useGeoDistanceRelatedByFromStateIdQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the GeoDistanceRelatedByFromStateId relation to the GeoDistance table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\GeoDistanceQuery The inner query object of the EXISTS statement
     */
    public function useGeoDistanceRelatedByFromStateIdExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\GeoDistanceQuery */
        $q = $this->useExistsQuery('GeoDistanceRelatedByFromStateId', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the GeoDistanceRelatedByFromStateId relation to the GeoDistance table for a NOT EXISTS query.
     *
     * @see useGeoDistanceRelatedByFromStateIdExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\GeoDistanceQuery The inner query object of the NOT EXISTS statement
     */
    public function useGeoDistanceRelatedByFromStateIdNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\GeoDistanceQuery */
        $q = $this->useExistsQuery('GeoDistanceRelatedByFromStateId', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the GeoDistanceRelatedByFromStateId relation to the GeoDistance table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\GeoDistanceQuery The inner query object of the IN statement
     */
    public function useInGeoDistanceRelatedByFromStateIdQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\GeoDistanceQuery */
        $q = $this->useInQuery('GeoDistanceRelatedByFromStateId', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the GeoDistanceRelatedByFromStateId relation to the GeoDistance table for a NOT IN query.
     *
     * @see useGeoDistanceRelatedByFromStateIdInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\GeoDistanceQuery The inner query object of the NOT IN statement
     */
    public function useNotInGeoDistanceRelatedByFromStateIdQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\GeoDistanceQuery */
        $q = $this->useInQuery('GeoDistanceRelatedByFromStateId', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\GeoDistance object
     *
     * @param \entities\GeoDistance|ObjectCollection $geoDistance the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByGeoDistanceRelatedByToStateId($geoDistance, ?string $comparison = null)
    {
        if ($geoDistance instanceof \entities\GeoDistance) {
            $this
                ->addUsingAlias(GeoStateTableMap::COL_ISTATEID, $geoDistance->getToStateId(), $comparison);

            return $this;
        } elseif ($geoDistance instanceof ObjectCollection) {
            $this
                ->useGeoDistanceRelatedByToStateIdQuery()
                ->filterByPrimaryKeys($geoDistance->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByGeoDistanceRelatedByToStateId() only accepts arguments of type \entities\GeoDistance or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the GeoDistanceRelatedByToStateId relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinGeoDistanceRelatedByToStateId(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('GeoDistanceRelatedByToStateId');

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
            $this->addJoinObject($join, 'GeoDistanceRelatedByToStateId');
        }

        return $this;
    }

    /**
     * Use the GeoDistanceRelatedByToStateId relation GeoDistance object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\GeoDistanceQuery A secondary query class using the current class as primary query
     */
    public function useGeoDistanceRelatedByToStateIdQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinGeoDistanceRelatedByToStateId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'GeoDistanceRelatedByToStateId', '\entities\GeoDistanceQuery');
    }

    /**
     * Use the GeoDistanceRelatedByToStateId relation GeoDistance object
     *
     * @param callable(\entities\GeoDistanceQuery):\entities\GeoDistanceQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withGeoDistanceRelatedByToStateIdQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useGeoDistanceRelatedByToStateIdQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the GeoDistanceRelatedByToStateId relation to the GeoDistance table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\GeoDistanceQuery The inner query object of the EXISTS statement
     */
    public function useGeoDistanceRelatedByToStateIdExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\GeoDistanceQuery */
        $q = $this->useExistsQuery('GeoDistanceRelatedByToStateId', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the GeoDistanceRelatedByToStateId relation to the GeoDistance table for a NOT EXISTS query.
     *
     * @see useGeoDistanceRelatedByToStateIdExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\GeoDistanceQuery The inner query object of the NOT EXISTS statement
     */
    public function useGeoDistanceRelatedByToStateIdNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\GeoDistanceQuery */
        $q = $this->useExistsQuery('GeoDistanceRelatedByToStateId', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the GeoDistanceRelatedByToStateId relation to the GeoDistance table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\GeoDistanceQuery The inner query object of the IN statement
     */
    public function useInGeoDistanceRelatedByToStateIdQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\GeoDistanceQuery */
        $q = $this->useInQuery('GeoDistanceRelatedByToStateId', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the GeoDistanceRelatedByToStateId relation to the GeoDistance table for a NOT IN query.
     *
     * @see useGeoDistanceRelatedByToStateIdInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\GeoDistanceQuery The inner query object of the NOT IN statement
     */
    public function useNotInGeoDistanceRelatedByToStateIdQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\GeoDistanceQuery */
        $q = $this->useInQuery('GeoDistanceRelatedByToStateId', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\Holidays object
     *
     * @param \entities\Holidays|ObjectCollection $holidays the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByHolidays($holidays, ?string $comparison = null)
    {
        if ($holidays instanceof \entities\Holidays) {
            $this
                ->addUsingAlias(GeoStateTableMap::COL_ISTATEID, $holidays->getIstateid(), $comparison);

            return $this;
        } elseif ($holidays instanceof ObjectCollection) {
            $this
                ->useHolidaysQuery()
                ->filterByPrimaryKeys($holidays->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByHolidays() only accepts arguments of type \entities\Holidays or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Holidays relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinHolidays(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Holidays');

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
            $this->addJoinObject($join, 'Holidays');
        }

        return $this;
    }

    /**
     * Use the Holidays relation Holidays object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\HolidaysQuery A secondary query class using the current class as primary query
     */
    public function useHolidaysQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinHolidays($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Holidays', '\entities\HolidaysQuery');
    }

    /**
     * Use the Holidays relation Holidays object
     *
     * @param callable(\entities\HolidaysQuery):\entities\HolidaysQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withHolidaysQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useHolidaysQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Holidays table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\HolidaysQuery The inner query object of the EXISTS statement
     */
    public function useHolidaysExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\HolidaysQuery */
        $q = $this->useExistsQuery('Holidays', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Holidays table for a NOT EXISTS query.
     *
     * @see useHolidaysExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\HolidaysQuery The inner query object of the NOT EXISTS statement
     */
    public function useHolidaysNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\HolidaysQuery */
        $q = $this->useExistsQuery('Holidays', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Holidays table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\HolidaysQuery The inner query object of the IN statement
     */
    public function useInHolidaysQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\HolidaysQuery */
        $q = $this->useInQuery('Holidays', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Holidays table for a NOT IN query.
     *
     * @see useHolidaysInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\HolidaysQuery The inner query object of the NOT IN statement
     */
    public function useNotInHolidaysQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\HolidaysQuery */
        $q = $this->useInQuery('Holidays', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(GeoStateTableMap::COL_ISTATEID, $onBoardRequestAddress->getIstateid(), $comparison);

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
     * @param ChildGeoState $geoState Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($geoState = null)
    {
        if ($geoState) {
            $this->addUsingAlias(GeoStateTableMap::COL_ISTATEID, $geoState->getIstateid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the geo_state table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(GeoStateTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            GeoStateTableMap::clearInstancePool();
            GeoStateTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(GeoStateTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(GeoStateTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            GeoStateTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            GeoStateTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
