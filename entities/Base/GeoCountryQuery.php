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
use entities\GeoCountry as ChildGeoCountry;
use entities\GeoCountryQuery as ChildGeoCountryQuery;
use entities\Map\GeoCountryTableMap;

/**
 * Base class that represents a query for the `geo_country` table.
 *
 * @method     ChildGeoCountryQuery orderByIcountryid($order = Criteria::ASC) Order by the icountryid column
 * @method     ChildGeoCountryQuery orderByScountry($order = Criteria::ASC) Order by the scountry column
 * @method     ChildGeoCountryQuery orderByScurrency($order = Criteria::ASC) Order by the scurrency column
 * @method     ChildGeoCountryQuery orderByDrate($order = Criteria::ASC) Order by the drate column
 * @method     ChildGeoCountryQuery orderByCode($order = Criteria::ASC) Order by the code column
 *
 * @method     ChildGeoCountryQuery groupByIcountryid() Group by the icountryid column
 * @method     ChildGeoCountryQuery groupByScountry() Group by the scountry column
 * @method     ChildGeoCountryQuery groupByScurrency() Group by the scurrency column
 * @method     ChildGeoCountryQuery groupByDrate() Group by the drate column
 * @method     ChildGeoCountryQuery groupByCode() Group by the code column
 *
 * @method     ChildGeoCountryQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildGeoCountryQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildGeoCountryQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildGeoCountryQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildGeoCountryQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildGeoCountryQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildGeoCountryQuery leftJoinCurrencies($relationAlias = null) Adds a LEFT JOIN clause to the query using the Currencies relation
 * @method     ChildGeoCountryQuery rightJoinCurrencies($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Currencies relation
 * @method     ChildGeoCountryQuery innerJoinCurrencies($relationAlias = null) Adds a INNER JOIN clause to the query using the Currencies relation
 *
 * @method     ChildGeoCountryQuery joinWithCurrencies($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Currencies relation
 *
 * @method     ChildGeoCountryQuery leftJoinWithCurrencies() Adds a LEFT JOIN clause and with to the query using the Currencies relation
 * @method     ChildGeoCountryQuery rightJoinWithCurrencies() Adds a RIGHT JOIN clause and with to the query using the Currencies relation
 * @method     ChildGeoCountryQuery innerJoinWithCurrencies() Adds a INNER JOIN clause and with to the query using the Currencies relation
 *
 * @method     ChildGeoCountryQuery leftJoinGeoCity($relationAlias = null) Adds a LEFT JOIN clause to the query using the GeoCity relation
 * @method     ChildGeoCountryQuery rightJoinGeoCity($relationAlias = null) Adds a RIGHT JOIN clause to the query using the GeoCity relation
 * @method     ChildGeoCountryQuery innerJoinGeoCity($relationAlias = null) Adds a INNER JOIN clause to the query using the GeoCity relation
 *
 * @method     ChildGeoCountryQuery joinWithGeoCity($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the GeoCity relation
 *
 * @method     ChildGeoCountryQuery leftJoinWithGeoCity() Adds a LEFT JOIN clause and with to the query using the GeoCity relation
 * @method     ChildGeoCountryQuery rightJoinWithGeoCity() Adds a RIGHT JOIN clause and with to the query using the GeoCity relation
 * @method     ChildGeoCountryQuery innerJoinWithGeoCity() Adds a INNER JOIN clause and with to the query using the GeoCity relation
 *
 * @method     ChildGeoCountryQuery leftJoinGeoState($relationAlias = null) Adds a LEFT JOIN clause to the query using the GeoState relation
 * @method     ChildGeoCountryQuery rightJoinGeoState($relationAlias = null) Adds a RIGHT JOIN clause to the query using the GeoState relation
 * @method     ChildGeoCountryQuery innerJoinGeoState($relationAlias = null) Adds a INNER JOIN clause to the query using the GeoState relation
 *
 * @method     ChildGeoCountryQuery joinWithGeoState($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the GeoState relation
 *
 * @method     ChildGeoCountryQuery leftJoinWithGeoState() Adds a LEFT JOIN clause and with to the query using the GeoState relation
 * @method     ChildGeoCountryQuery rightJoinWithGeoState() Adds a RIGHT JOIN clause and with to the query using the GeoState relation
 * @method     ChildGeoCountryQuery innerJoinWithGeoState() Adds a INNER JOIN clause and with to the query using the GeoState relation
 *
 * @method     ChildGeoCountryQuery leftJoinOrgUnit($relationAlias = null) Adds a LEFT JOIN clause to the query using the OrgUnit relation
 * @method     ChildGeoCountryQuery rightJoinOrgUnit($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OrgUnit relation
 * @method     ChildGeoCountryQuery innerJoinOrgUnit($relationAlias = null) Adds a INNER JOIN clause to the query using the OrgUnit relation
 *
 * @method     ChildGeoCountryQuery joinWithOrgUnit($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OrgUnit relation
 *
 * @method     ChildGeoCountryQuery leftJoinWithOrgUnit() Adds a LEFT JOIN clause and with to the query using the OrgUnit relation
 * @method     ChildGeoCountryQuery rightJoinWithOrgUnit() Adds a RIGHT JOIN clause and with to the query using the OrgUnit relation
 * @method     ChildGeoCountryQuery innerJoinWithOrgUnit() Adds a INNER JOIN clause and with to the query using the OrgUnit relation
 *
 * @method     \entities\CurrenciesQuery|\entities\GeoCityQuery|\entities\GeoStateQuery|\entities\OrgUnitQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildGeoCountry|null findOne(?ConnectionInterface $con = null) Return the first ChildGeoCountry matching the query
 * @method     ChildGeoCountry findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildGeoCountry matching the query, or a new ChildGeoCountry object populated from the query conditions when no match is found
 *
 * @method     ChildGeoCountry|null findOneByIcountryid(int $icountryid) Return the first ChildGeoCountry filtered by the icountryid column
 * @method     ChildGeoCountry|null findOneByScountry(string $scountry) Return the first ChildGeoCountry filtered by the scountry column
 * @method     ChildGeoCountry|null findOneByScurrency(int $scurrency) Return the first ChildGeoCountry filtered by the scurrency column
 * @method     ChildGeoCountry|null findOneByDrate(string $drate) Return the first ChildGeoCountry filtered by the drate column
 * @method     ChildGeoCountry|null findOneByCode(string $code) Return the first ChildGeoCountry filtered by the code column
 *
 * @method     ChildGeoCountry requirePk($key, ?ConnectionInterface $con = null) Return the ChildGeoCountry by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGeoCountry requireOne(?ConnectionInterface $con = null) Return the first ChildGeoCountry matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildGeoCountry requireOneByIcountryid(int $icountryid) Return the first ChildGeoCountry filtered by the icountryid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGeoCountry requireOneByScountry(string $scountry) Return the first ChildGeoCountry filtered by the scountry column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGeoCountry requireOneByScurrency(int $scurrency) Return the first ChildGeoCountry filtered by the scurrency column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGeoCountry requireOneByDrate(string $drate) Return the first ChildGeoCountry filtered by the drate column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGeoCountry requireOneByCode(string $code) Return the first ChildGeoCountry filtered by the code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildGeoCountry[]|Collection find(?ConnectionInterface $con = null) Return ChildGeoCountry objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildGeoCountry> find(?ConnectionInterface $con = null) Return ChildGeoCountry objects based on current ModelCriteria
 *
 * @method     ChildGeoCountry[]|Collection findByIcountryid(int|array<int> $icountryid) Return ChildGeoCountry objects filtered by the icountryid column
 * @psalm-method Collection&\Traversable<ChildGeoCountry> findByIcountryid(int|array<int> $icountryid) Return ChildGeoCountry objects filtered by the icountryid column
 * @method     ChildGeoCountry[]|Collection findByScountry(string|array<string> $scountry) Return ChildGeoCountry objects filtered by the scountry column
 * @psalm-method Collection&\Traversable<ChildGeoCountry> findByScountry(string|array<string> $scountry) Return ChildGeoCountry objects filtered by the scountry column
 * @method     ChildGeoCountry[]|Collection findByScurrency(int|array<int> $scurrency) Return ChildGeoCountry objects filtered by the scurrency column
 * @psalm-method Collection&\Traversable<ChildGeoCountry> findByScurrency(int|array<int> $scurrency) Return ChildGeoCountry objects filtered by the scurrency column
 * @method     ChildGeoCountry[]|Collection findByDrate(string|array<string> $drate) Return ChildGeoCountry objects filtered by the drate column
 * @psalm-method Collection&\Traversable<ChildGeoCountry> findByDrate(string|array<string> $drate) Return ChildGeoCountry objects filtered by the drate column
 * @method     ChildGeoCountry[]|Collection findByCode(string|array<string> $code) Return ChildGeoCountry objects filtered by the code column
 * @psalm-method Collection&\Traversable<ChildGeoCountry> findByCode(string|array<string> $code) Return ChildGeoCountry objects filtered by the code column
 *
 * @method     ChildGeoCountry[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildGeoCountry> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class GeoCountryQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\GeoCountryQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\GeoCountry', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildGeoCountryQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildGeoCountryQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildGeoCountryQuery) {
            return $criteria;
        }
        $query = new ChildGeoCountryQuery();
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
     * @return ChildGeoCountry|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(GeoCountryTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = GeoCountryTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildGeoCountry A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT icountryid, scountry, scurrency, drate, code FROM geo_country WHERE icountryid = :p0';
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
            /** @var ChildGeoCountry $obj */
            $obj = new ChildGeoCountry();
            $obj->hydrate($row);
            GeoCountryTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildGeoCountry|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(GeoCountryTableMap::COL_ICOUNTRYID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(GeoCountryTableMap::COL_ICOUNTRYID, $keys, Criteria::IN);

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
                $this->addUsingAlias(GeoCountryTableMap::COL_ICOUNTRYID, $icountryid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($icountryid['max'])) {
                $this->addUsingAlias(GeoCountryTableMap::COL_ICOUNTRYID, $icountryid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(GeoCountryTableMap::COL_ICOUNTRYID, $icountryid, $comparison);

        return $this;
    }

    /**
     * Filter the query on the scountry column
     *
     * Example usage:
     * <code>
     * $query->filterByScountry('fooValue');   // WHERE scountry = 'fooValue'
     * $query->filterByScountry('%fooValue%', Criteria::LIKE); // WHERE scountry LIKE '%fooValue%'
     * $query->filterByScountry(['foo', 'bar']); // WHERE scountry IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $scountry The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByScountry($scountry = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($scountry)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(GeoCountryTableMap::COL_SCOUNTRY, $scountry, $comparison);

        return $this;
    }

    /**
     * Filter the query on the scurrency column
     *
     * Example usage:
     * <code>
     * $query->filterByScurrency(1234); // WHERE scurrency = 1234
     * $query->filterByScurrency(array(12, 34)); // WHERE scurrency IN (12, 34)
     * $query->filterByScurrency(array('min' => 12)); // WHERE scurrency > 12
     * </code>
     *
     * @see       filterByCurrencies()
     *
     * @param mixed $scurrency The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByScurrency($scurrency = null, ?string $comparison = null)
    {
        if (is_array($scurrency)) {
            $useMinMax = false;
            if (isset($scurrency['min'])) {
                $this->addUsingAlias(GeoCountryTableMap::COL_SCURRENCY, $scurrency['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($scurrency['max'])) {
                $this->addUsingAlias(GeoCountryTableMap::COL_SCURRENCY, $scurrency['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(GeoCountryTableMap::COL_SCURRENCY, $scurrency, $comparison);

        return $this;
    }

    /**
     * Filter the query on the drate column
     *
     * Example usage:
     * <code>
     * $query->filterByDrate(1234); // WHERE drate = 1234
     * $query->filterByDrate(array(12, 34)); // WHERE drate IN (12, 34)
     * $query->filterByDrate(array('min' => 12)); // WHERE drate > 12
     * </code>
     *
     * @param mixed $drate The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDrate($drate = null, ?string $comparison = null)
    {
        if (is_array($drate)) {
            $useMinMax = false;
            if (isset($drate['min'])) {
                $this->addUsingAlias(GeoCountryTableMap::COL_DRATE, $drate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($drate['max'])) {
                $this->addUsingAlias(GeoCountryTableMap::COL_DRATE, $drate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(GeoCountryTableMap::COL_DRATE, $drate, $comparison);

        return $this;
    }

    /**
     * Filter the query on the code column
     *
     * Example usage:
     * <code>
     * $query->filterByCode('fooValue');   // WHERE code = 'fooValue'
     * $query->filterByCode('%fooValue%', Criteria::LIKE); // WHERE code LIKE '%fooValue%'
     * $query->filterByCode(['foo', 'bar']); // WHERE code IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $code The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCode($code = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($code)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(GeoCountryTableMap::COL_CODE, $code, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \entities\Currencies object
     *
     * @param \entities\Currencies|ObjectCollection $currencies The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCurrencies($currencies, ?string $comparison = null)
    {
        if ($currencies instanceof \entities\Currencies) {
            return $this
                ->addUsingAlias(GeoCountryTableMap::COL_SCURRENCY, $currencies->getCurrencyId(), $comparison);
        } elseif ($currencies instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(GeoCountryTableMap::COL_SCURRENCY, $currencies->toKeyValue('PrimaryKey', 'CurrencyId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByCurrencies() only accepts arguments of type \entities\Currencies or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Currencies relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinCurrencies(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Currencies');

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
            $this->addJoinObject($join, 'Currencies');
        }

        return $this;
    }

    /**
     * Use the Currencies relation Currencies object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\CurrenciesQuery A secondary query class using the current class as primary query
     */
    public function useCurrenciesQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinCurrencies($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Currencies', '\entities\CurrenciesQuery');
    }

    /**
     * Use the Currencies relation Currencies object
     *
     * @param callable(\entities\CurrenciesQuery):\entities\CurrenciesQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withCurrenciesQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useCurrenciesQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Currencies table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\CurrenciesQuery The inner query object of the EXISTS statement
     */
    public function useCurrenciesExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\CurrenciesQuery */
        $q = $this->useExistsQuery('Currencies', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Currencies table for a NOT EXISTS query.
     *
     * @see useCurrenciesExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\CurrenciesQuery The inner query object of the NOT EXISTS statement
     */
    public function useCurrenciesNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\CurrenciesQuery */
        $q = $this->useExistsQuery('Currencies', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Currencies table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\CurrenciesQuery The inner query object of the IN statement
     */
    public function useInCurrenciesQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\CurrenciesQuery */
        $q = $this->useInQuery('Currencies', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Currencies table for a NOT IN query.
     *
     * @see useCurrenciesInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\CurrenciesQuery The inner query object of the NOT IN statement
     */
    public function useNotInCurrenciesQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\CurrenciesQuery */
        $q = $this->useInQuery('Currencies', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(GeoCountryTableMap::COL_ICOUNTRYID, $geoCity->getIcountryid(), $comparison);

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
     * Filter the query by a related \entities\GeoState object
     *
     * @param \entities\GeoState|ObjectCollection $geoState the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByGeoState($geoState, ?string $comparison = null)
    {
        if ($geoState instanceof \entities\GeoState) {
            $this
                ->addUsingAlias(GeoCountryTableMap::COL_ICOUNTRYID, $geoState->getCountryId(), $comparison);

            return $this;
        } elseif ($geoState instanceof ObjectCollection) {
            $this
                ->useGeoStateQuery()
                ->filterByPrimaryKeys($geoState->getPrimaryKeys())
                ->endUse();

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
     * Filter the query by a related \entities\OrgUnit object
     *
     * @param \entities\OrgUnit|ObjectCollection $orgUnit the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrgUnit($orgUnit, ?string $comparison = null)
    {
        if ($orgUnit instanceof \entities\OrgUnit) {
            $this
                ->addUsingAlias(GeoCountryTableMap::COL_ICOUNTRYID, $orgUnit->getCountryId(), $comparison);

            return $this;
        } elseif ($orgUnit instanceof ObjectCollection) {
            $this
                ->useOrgUnitQuery()
                ->filterByPrimaryKeys($orgUnit->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByOrgUnit() only accepts arguments of type \entities\OrgUnit or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OrgUnit relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOrgUnit(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OrgUnit');

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
            $this->addJoinObject($join, 'OrgUnit');
        }

        return $this;
    }

    /**
     * Use the OrgUnit relation OrgUnit object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\OrgUnitQuery A secondary query class using the current class as primary query
     */
    public function useOrgUnitQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinOrgUnit($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OrgUnit', '\entities\OrgUnitQuery');
    }

    /**
     * Use the OrgUnit relation OrgUnit object
     *
     * @param callable(\entities\OrgUnitQuery):\entities\OrgUnitQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOrgUnitQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useOrgUnitQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to OrgUnit table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\OrgUnitQuery The inner query object of the EXISTS statement
     */
    public function useOrgUnitExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\OrgUnitQuery */
        $q = $this->useExistsQuery('OrgUnit', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to OrgUnit table for a NOT EXISTS query.
     *
     * @see useOrgUnitExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\OrgUnitQuery The inner query object of the NOT EXISTS statement
     */
    public function useOrgUnitNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OrgUnitQuery */
        $q = $this->useExistsQuery('OrgUnit', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to OrgUnit table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\OrgUnitQuery The inner query object of the IN statement
     */
    public function useInOrgUnitQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\OrgUnitQuery */
        $q = $this->useInQuery('OrgUnit', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to OrgUnit table for a NOT IN query.
     *
     * @see useOrgUnitInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\OrgUnitQuery The inner query object of the NOT IN statement
     */
    public function useNotInOrgUnitQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OrgUnitQuery */
        $q = $this->useInQuery('OrgUnit', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildGeoCountry $geoCountry Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($geoCountry = null)
    {
        if ($geoCountry) {
            $this->addUsingAlias(GeoCountryTableMap::COL_ICOUNTRYID, $geoCountry->getIcountryid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the geo_country table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(GeoCountryTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            GeoCountryTableMap::clearInstancePool();
            GeoCountryTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(GeoCountryTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(GeoCountryTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            GeoCountryTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            GeoCountryTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
