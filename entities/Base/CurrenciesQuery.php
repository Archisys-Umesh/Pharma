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
use entities\Currencies as ChildCurrencies;
use entities\CurrenciesQuery as ChildCurrenciesQuery;
use entities\Map\CurrenciesTableMap;

/**
 * Base class that represents a query for the `currencies` table.
 *
 * @method     ChildCurrenciesQuery orderByCurrencyId($order = Criteria::ASC) Order by the currency_id column
 * @method     ChildCurrenciesQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildCurrenciesQuery orderByShortcode($order = Criteria::ASC) Order by the shortcode column
 * @method     ChildCurrenciesQuery orderBySymbol($order = Criteria::ASC) Order by the symbol column
 * @method     ChildCurrenciesQuery orderByConversionrate($order = Criteria::ASC) Order by the conversionrate column
 * @method     ChildCurrenciesQuery orderByFordate($order = Criteria::ASC) Order by the fordate column
 * @method     ChildCurrenciesQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildCurrenciesQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildCurrenciesQuery groupByCurrencyId() Group by the currency_id column
 * @method     ChildCurrenciesQuery groupByName() Group by the name column
 * @method     ChildCurrenciesQuery groupByShortcode() Group by the shortcode column
 * @method     ChildCurrenciesQuery groupBySymbol() Group by the symbol column
 * @method     ChildCurrenciesQuery groupByConversionrate() Group by the conversionrate column
 * @method     ChildCurrenciesQuery groupByFordate() Group by the fordate column
 * @method     ChildCurrenciesQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildCurrenciesQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildCurrenciesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCurrenciesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCurrenciesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCurrenciesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildCurrenciesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildCurrenciesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildCurrenciesQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildCurrenciesQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildCurrenciesQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildCurrenciesQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildCurrenciesQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildCurrenciesQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildCurrenciesQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     ChildCurrenciesQuery leftJoinExpenses($relationAlias = null) Adds a LEFT JOIN clause to the query using the Expenses relation
 * @method     ChildCurrenciesQuery rightJoinExpenses($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Expenses relation
 * @method     ChildCurrenciesQuery innerJoinExpenses($relationAlias = null) Adds a INNER JOIN clause to the query using the Expenses relation
 *
 * @method     ChildCurrenciesQuery joinWithExpenses($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Expenses relation
 *
 * @method     ChildCurrenciesQuery leftJoinWithExpenses() Adds a LEFT JOIN clause and with to the query using the Expenses relation
 * @method     ChildCurrenciesQuery rightJoinWithExpenses() Adds a RIGHT JOIN clause and with to the query using the Expenses relation
 * @method     ChildCurrenciesQuery innerJoinWithExpenses() Adds a INNER JOIN clause and with to the query using the Expenses relation
 *
 * @method     ChildCurrenciesQuery leftJoinGeoCountry($relationAlias = null) Adds a LEFT JOIN clause to the query using the GeoCountry relation
 * @method     ChildCurrenciesQuery rightJoinGeoCountry($relationAlias = null) Adds a RIGHT JOIN clause to the query using the GeoCountry relation
 * @method     ChildCurrenciesQuery innerJoinGeoCountry($relationAlias = null) Adds a INNER JOIN clause to the query using the GeoCountry relation
 *
 * @method     ChildCurrenciesQuery joinWithGeoCountry($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the GeoCountry relation
 *
 * @method     ChildCurrenciesQuery leftJoinWithGeoCountry() Adds a LEFT JOIN clause and with to the query using the GeoCountry relation
 * @method     ChildCurrenciesQuery rightJoinWithGeoCountry() Adds a RIGHT JOIN clause and with to the query using the GeoCountry relation
 * @method     ChildCurrenciesQuery innerJoinWithGeoCountry() Adds a INNER JOIN clause and with to the query using the GeoCountry relation
 *
 * @method     ChildCurrenciesQuery leftJoinOrgUnit($relationAlias = null) Adds a LEFT JOIN clause to the query using the OrgUnit relation
 * @method     ChildCurrenciesQuery rightJoinOrgUnit($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OrgUnit relation
 * @method     ChildCurrenciesQuery innerJoinOrgUnit($relationAlias = null) Adds a INNER JOIN clause to the query using the OrgUnit relation
 *
 * @method     ChildCurrenciesQuery joinWithOrgUnit($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OrgUnit relation
 *
 * @method     ChildCurrenciesQuery leftJoinWithOrgUnit() Adds a LEFT JOIN clause and with to the query using the OrgUnit relation
 * @method     ChildCurrenciesQuery rightJoinWithOrgUnit() Adds a RIGHT JOIN clause and with to the query using the OrgUnit relation
 * @method     ChildCurrenciesQuery innerJoinWithOrgUnit() Adds a INNER JOIN clause and with to the query using the OrgUnit relation
 *
 * @method     ChildCurrenciesQuery leftJoinPolicyMaster($relationAlias = null) Adds a LEFT JOIN clause to the query using the PolicyMaster relation
 * @method     ChildCurrenciesQuery rightJoinPolicyMaster($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PolicyMaster relation
 * @method     ChildCurrenciesQuery innerJoinPolicyMaster($relationAlias = null) Adds a INNER JOIN clause to the query using the PolicyMaster relation
 *
 * @method     ChildCurrenciesQuery joinWithPolicyMaster($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PolicyMaster relation
 *
 * @method     ChildCurrenciesQuery leftJoinWithPolicyMaster() Adds a LEFT JOIN clause and with to the query using the PolicyMaster relation
 * @method     ChildCurrenciesQuery rightJoinWithPolicyMaster() Adds a RIGHT JOIN clause and with to the query using the PolicyMaster relation
 * @method     ChildCurrenciesQuery innerJoinWithPolicyMaster() Adds a INNER JOIN clause and with to the query using the PolicyMaster relation
 *
 * @method     \entities\CompanyQuery|\entities\ExpensesQuery|\entities\GeoCountryQuery|\entities\OrgUnitQuery|\entities\PolicyMasterQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildCurrencies|null findOne(?ConnectionInterface $con = null) Return the first ChildCurrencies matching the query
 * @method     ChildCurrencies findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildCurrencies matching the query, or a new ChildCurrencies object populated from the query conditions when no match is found
 *
 * @method     ChildCurrencies|null findOneByCurrencyId(int $currency_id) Return the first ChildCurrencies filtered by the currency_id column
 * @method     ChildCurrencies|null findOneByName(string $name) Return the first ChildCurrencies filtered by the name column
 * @method     ChildCurrencies|null findOneByShortcode(string $shortcode) Return the first ChildCurrencies filtered by the shortcode column
 * @method     ChildCurrencies|null findOneBySymbol(string $symbol) Return the first ChildCurrencies filtered by the symbol column
 * @method     ChildCurrencies|null findOneByConversionrate(double $conversionrate) Return the first ChildCurrencies filtered by the conversionrate column
 * @method     ChildCurrencies|null findOneByFordate(string $fordate) Return the first ChildCurrencies filtered by the fordate column
 * @method     ChildCurrencies|null findOneByCreatedAt(string $created_at) Return the first ChildCurrencies filtered by the created_at column
 * @method     ChildCurrencies|null findOneByUpdatedAt(string $updated_at) Return the first ChildCurrencies filtered by the updated_at column
 *
 * @method     ChildCurrencies requirePk($key, ?ConnectionInterface $con = null) Return the ChildCurrencies by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCurrencies requireOne(?ConnectionInterface $con = null) Return the first ChildCurrencies matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCurrencies requireOneByCurrencyId(int $currency_id) Return the first ChildCurrencies filtered by the currency_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCurrencies requireOneByName(string $name) Return the first ChildCurrencies filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCurrencies requireOneByShortcode(string $shortcode) Return the first ChildCurrencies filtered by the shortcode column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCurrencies requireOneBySymbol(string $symbol) Return the first ChildCurrencies filtered by the symbol column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCurrencies requireOneByConversionrate(double $conversionrate) Return the first ChildCurrencies filtered by the conversionrate column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCurrencies requireOneByFordate(string $fordate) Return the first ChildCurrencies filtered by the fordate column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCurrencies requireOneByCreatedAt(string $created_at) Return the first ChildCurrencies filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCurrencies requireOneByUpdatedAt(string $updated_at) Return the first ChildCurrencies filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCurrencies[]|Collection find(?ConnectionInterface $con = null) Return ChildCurrencies objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildCurrencies> find(?ConnectionInterface $con = null) Return ChildCurrencies objects based on current ModelCriteria
 *
 * @method     ChildCurrencies[]|Collection findByCurrencyId(int|array<int> $currency_id) Return ChildCurrencies objects filtered by the currency_id column
 * @psalm-method Collection&\Traversable<ChildCurrencies> findByCurrencyId(int|array<int> $currency_id) Return ChildCurrencies objects filtered by the currency_id column
 * @method     ChildCurrencies[]|Collection findByName(string|array<string> $name) Return ChildCurrencies objects filtered by the name column
 * @psalm-method Collection&\Traversable<ChildCurrencies> findByName(string|array<string> $name) Return ChildCurrencies objects filtered by the name column
 * @method     ChildCurrencies[]|Collection findByShortcode(string|array<string> $shortcode) Return ChildCurrencies objects filtered by the shortcode column
 * @psalm-method Collection&\Traversable<ChildCurrencies> findByShortcode(string|array<string> $shortcode) Return ChildCurrencies objects filtered by the shortcode column
 * @method     ChildCurrencies[]|Collection findBySymbol(string|array<string> $symbol) Return ChildCurrencies objects filtered by the symbol column
 * @psalm-method Collection&\Traversable<ChildCurrencies> findBySymbol(string|array<string> $symbol) Return ChildCurrencies objects filtered by the symbol column
 * @method     ChildCurrencies[]|Collection findByConversionrate(double|array<double> $conversionrate) Return ChildCurrencies objects filtered by the conversionrate column
 * @psalm-method Collection&\Traversable<ChildCurrencies> findByConversionrate(double|array<double> $conversionrate) Return ChildCurrencies objects filtered by the conversionrate column
 * @method     ChildCurrencies[]|Collection findByFordate(string|array<string> $fordate) Return ChildCurrencies objects filtered by the fordate column
 * @psalm-method Collection&\Traversable<ChildCurrencies> findByFordate(string|array<string> $fordate) Return ChildCurrencies objects filtered by the fordate column
 * @method     ChildCurrencies[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildCurrencies objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildCurrencies> findByCreatedAt(string|array<string> $created_at) Return ChildCurrencies objects filtered by the created_at column
 * @method     ChildCurrencies[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildCurrencies objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildCurrencies> findByUpdatedAt(string|array<string> $updated_at) Return ChildCurrencies objects filtered by the updated_at column
 *
 * @method     ChildCurrencies[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildCurrencies> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class CurrenciesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\CurrenciesQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\Currencies', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCurrenciesQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCurrenciesQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildCurrenciesQuery) {
            return $criteria;
        }
        $query = new ChildCurrenciesQuery();
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
     * @return ChildCurrencies|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CurrenciesTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = CurrenciesTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildCurrencies A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT currency_id, name, shortcode, symbol, conversionrate, fordate, created_at, updated_at FROM currencies WHERE currency_id = :p0';
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
            /** @var ChildCurrencies $obj */
            $obj = new ChildCurrencies();
            $obj->hydrate($row);
            CurrenciesTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildCurrencies|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(CurrenciesTableMap::COL_CURRENCY_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(CurrenciesTableMap::COL_CURRENCY_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the currency_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCurrencyId(1234); // WHERE currency_id = 1234
     * $query->filterByCurrencyId(array(12, 34)); // WHERE currency_id IN (12, 34)
     * $query->filterByCurrencyId(array('min' => 12)); // WHERE currency_id > 12
     * </code>
     *
     * @param mixed $currencyId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCurrencyId($currencyId = null, ?string $comparison = null)
    {
        if (is_array($currencyId)) {
            $useMinMax = false;
            if (isset($currencyId['min'])) {
                $this->addUsingAlias(CurrenciesTableMap::COL_CURRENCY_ID, $currencyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($currencyId['max'])) {
                $this->addUsingAlias(CurrenciesTableMap::COL_CURRENCY_ID, $currencyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CurrenciesTableMap::COL_CURRENCY_ID, $currencyId, $comparison);

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

        $this->addUsingAlias(CurrenciesTableMap::COL_NAME, $name, $comparison);

        return $this;
    }

    /**
     * Filter the query on the shortcode column
     *
     * Example usage:
     * <code>
     * $query->filterByShortcode('fooValue');   // WHERE shortcode = 'fooValue'
     * $query->filterByShortcode('%fooValue%', Criteria::LIKE); // WHERE shortcode LIKE '%fooValue%'
     * $query->filterByShortcode(['foo', 'bar']); // WHERE shortcode IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $shortcode The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByShortcode($shortcode = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($shortcode)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CurrenciesTableMap::COL_SHORTCODE, $shortcode, $comparison);

        return $this;
    }

    /**
     * Filter the query on the symbol column
     *
     * Example usage:
     * <code>
     * $query->filterBySymbol('fooValue');   // WHERE symbol = 'fooValue'
     * $query->filterBySymbol('%fooValue%', Criteria::LIKE); // WHERE symbol LIKE '%fooValue%'
     * $query->filterBySymbol(['foo', 'bar']); // WHERE symbol IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $symbol The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySymbol($symbol = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($symbol)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CurrenciesTableMap::COL_SYMBOL, $symbol, $comparison);

        return $this;
    }

    /**
     * Filter the query on the conversionrate column
     *
     * Example usage:
     * <code>
     * $query->filterByConversionrate(1234); // WHERE conversionrate = 1234
     * $query->filterByConversionrate(array(12, 34)); // WHERE conversionrate IN (12, 34)
     * $query->filterByConversionrate(array('min' => 12)); // WHERE conversionrate > 12
     * </code>
     *
     * @param mixed $conversionrate The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByConversionrate($conversionrate = null, ?string $comparison = null)
    {
        if (is_array($conversionrate)) {
            $useMinMax = false;
            if (isset($conversionrate['min'])) {
                $this->addUsingAlias(CurrenciesTableMap::COL_CONVERSIONRATE, $conversionrate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($conversionrate['max'])) {
                $this->addUsingAlias(CurrenciesTableMap::COL_CONVERSIONRATE, $conversionrate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CurrenciesTableMap::COL_CONVERSIONRATE, $conversionrate, $comparison);

        return $this;
    }

    /**
     * Filter the query on the fordate column
     *
     * Example usage:
     * <code>
     * $query->filterByFordate('2011-03-14'); // WHERE fordate = '2011-03-14'
     * $query->filterByFordate('now'); // WHERE fordate = '2011-03-14'
     * $query->filterByFordate(array('max' => 'yesterday')); // WHERE fordate > '2011-03-13'
     * </code>
     *
     * @param mixed $fordate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFordate($fordate = null, ?string $comparison = null)
    {
        if (is_array($fordate)) {
            $useMinMax = false;
            if (isset($fordate['min'])) {
                $this->addUsingAlias(CurrenciesTableMap::COL_FORDATE, $fordate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fordate['max'])) {
                $this->addUsingAlias(CurrenciesTableMap::COL_FORDATE, $fordate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CurrenciesTableMap::COL_FORDATE, $fordate, $comparison);

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
                $this->addUsingAlias(CurrenciesTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(CurrenciesTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CurrenciesTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(CurrenciesTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(CurrenciesTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CurrenciesTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \entities\Company object
     *
     * @param \entities\Company|ObjectCollection $company the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCompany($company, ?string $comparison = null)
    {
        if ($company instanceof \entities\Company) {
            $this
                ->addUsingAlias(CurrenciesTableMap::COL_CURRENCY_ID, $company->getCompanyDefaultCurrency(), $comparison);

            return $this;
        } elseif ($company instanceof ObjectCollection) {
            $this
                ->useCompanyQuery()
                ->filterByPrimaryKeys($company->getPrimaryKeys())
                ->endUse();

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
     * Filter the query by a related \entities\Expenses object
     *
     * @param \entities\Expenses|ObjectCollection $expenses the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpenses($expenses, ?string $comparison = null)
    {
        if ($expenses instanceof \entities\Expenses) {
            $this
                ->addUsingAlias(CurrenciesTableMap::COL_CURRENCY_ID, $expenses->getTripCurrency(), $comparison);

            return $this;
        } elseif ($expenses instanceof ObjectCollection) {
            $this
                ->useExpensesQuery()
                ->filterByPrimaryKeys($expenses->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByExpenses() only accepts arguments of type \entities\Expenses or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Expenses relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinExpenses(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Expenses');

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
            $this->addJoinObject($join, 'Expenses');
        }

        return $this;
    }

    /**
     * Use the Expenses relation Expenses object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\ExpensesQuery A secondary query class using the current class as primary query
     */
    public function useExpensesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinExpenses($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Expenses', '\entities\ExpensesQuery');
    }

    /**
     * Use the Expenses relation Expenses object
     *
     * @param callable(\entities\ExpensesQuery):\entities\ExpensesQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withExpensesQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useExpensesQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Expenses table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\ExpensesQuery The inner query object of the EXISTS statement
     */
    public function useExpensesExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\ExpensesQuery */
        $q = $this->useExistsQuery('Expenses', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Expenses table for a NOT EXISTS query.
     *
     * @see useExpensesExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\ExpensesQuery The inner query object of the NOT EXISTS statement
     */
    public function useExpensesNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\ExpensesQuery */
        $q = $this->useExistsQuery('Expenses', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Expenses table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\ExpensesQuery The inner query object of the IN statement
     */
    public function useInExpensesQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\ExpensesQuery */
        $q = $this->useInQuery('Expenses', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Expenses table for a NOT IN query.
     *
     * @see useExpensesInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\ExpensesQuery The inner query object of the NOT IN statement
     */
    public function useNotInExpensesQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\ExpensesQuery */
        $q = $this->useInQuery('Expenses', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\GeoCountry object
     *
     * @param \entities\GeoCountry|ObjectCollection $geoCountry the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByGeoCountry($geoCountry, ?string $comparison = null)
    {
        if ($geoCountry instanceof \entities\GeoCountry) {
            $this
                ->addUsingAlias(CurrenciesTableMap::COL_CURRENCY_ID, $geoCountry->getScurrency(), $comparison);

            return $this;
        } elseif ($geoCountry instanceof ObjectCollection) {
            $this
                ->useGeoCountryQuery()
                ->filterByPrimaryKeys($geoCountry->getPrimaryKeys())
                ->endUse();

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
                ->addUsingAlias(CurrenciesTableMap::COL_CURRENCY_ID, $orgUnit->getCurrencyId(), $comparison);

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
     * Filter the query by a related \entities\PolicyMaster object
     *
     * @param \entities\PolicyMaster|ObjectCollection $policyMaster the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPolicyMaster($policyMaster, ?string $comparison = null)
    {
        if ($policyMaster instanceof \entities\PolicyMaster) {
            $this
                ->addUsingAlias(CurrenciesTableMap::COL_CURRENCY_ID, $policyMaster->getCurrencyId(), $comparison);

            return $this;
        } elseif ($policyMaster instanceof ObjectCollection) {
            $this
                ->usePolicyMasterQuery()
                ->filterByPrimaryKeys($policyMaster->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByPolicyMaster() only accepts arguments of type \entities\PolicyMaster or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PolicyMaster relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinPolicyMaster(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PolicyMaster');

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
            $this->addJoinObject($join, 'PolicyMaster');
        }

        return $this;
    }

    /**
     * Use the PolicyMaster relation PolicyMaster object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\PolicyMasterQuery A secondary query class using the current class as primary query
     */
    public function usePolicyMasterQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinPolicyMaster($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PolicyMaster', '\entities\PolicyMasterQuery');
    }

    /**
     * Use the PolicyMaster relation PolicyMaster object
     *
     * @param callable(\entities\PolicyMasterQuery):\entities\PolicyMasterQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withPolicyMasterQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->usePolicyMasterQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to PolicyMaster table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\PolicyMasterQuery The inner query object of the EXISTS statement
     */
    public function usePolicyMasterExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\PolicyMasterQuery */
        $q = $this->useExistsQuery('PolicyMaster', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to PolicyMaster table for a NOT EXISTS query.
     *
     * @see usePolicyMasterExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\PolicyMasterQuery The inner query object of the NOT EXISTS statement
     */
    public function usePolicyMasterNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\PolicyMasterQuery */
        $q = $this->useExistsQuery('PolicyMaster', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to PolicyMaster table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\PolicyMasterQuery The inner query object of the IN statement
     */
    public function useInPolicyMasterQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\PolicyMasterQuery */
        $q = $this->useInQuery('PolicyMaster', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to PolicyMaster table for a NOT IN query.
     *
     * @see usePolicyMasterInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\PolicyMasterQuery The inner query object of the NOT IN statement
     */
    public function useNotInPolicyMasterQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\PolicyMasterQuery */
        $q = $this->useInQuery('PolicyMaster', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildCurrencies $currencies Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($currencies = null)
    {
        if ($currencies) {
            $this->addUsingAlias(CurrenciesTableMap::COL_CURRENCY_ID, $currencies->getCurrencyId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the currencies table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CurrenciesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CurrenciesTableMap::clearInstancePool();
            CurrenciesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(CurrenciesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CurrenciesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            CurrenciesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            CurrenciesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
