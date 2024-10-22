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
use entities\Citycategory as ChildCitycategory;
use entities\CitycategoryQuery as ChildCitycategoryQuery;
use entities\Map\CitycategoryTableMap;

/**
 * Base class that represents a query for the `citycategory` table.
 *
 * @method     ChildCitycategoryQuery orderByCitycategoryid($order = Criteria::ASC) Order by the citycategoryid column
 * @method     ChildCitycategoryQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildCitycategoryQuery orderByItownid($order = Criteria::ASC) Order by the itownid column
 * @method     ChildCitycategoryQuery orderByCityname($order = Criteria::ASC) Order by the cityname column
 * @method     ChildCitycategoryQuery orderByScope($order = Criteria::ASC) Order by the scope column
 * @method     ChildCitycategoryQuery orderByIdentityKey($order = Criteria::ASC) Order by the identity_key column
 * @method     ChildCitycategoryQuery orderByCategory($order = Criteria::ASC) Order by the category column
 * @method     ChildCitycategoryQuery orderByGradeId($order = Criteria::ASC) Order by the grade_id column
 *
 * @method     ChildCitycategoryQuery groupByCitycategoryid() Group by the citycategoryid column
 * @method     ChildCitycategoryQuery groupByCompanyId() Group by the company_id column
 * @method     ChildCitycategoryQuery groupByItownid() Group by the itownid column
 * @method     ChildCitycategoryQuery groupByCityname() Group by the cityname column
 * @method     ChildCitycategoryQuery groupByScope() Group by the scope column
 * @method     ChildCitycategoryQuery groupByIdentityKey() Group by the identity_key column
 * @method     ChildCitycategoryQuery groupByCategory() Group by the category column
 * @method     ChildCitycategoryQuery groupByGradeId() Group by the grade_id column
 *
 * @method     ChildCitycategoryQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCitycategoryQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCitycategoryQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCitycategoryQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildCitycategoryQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildCitycategoryQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildCitycategoryQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildCitycategoryQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildCitycategoryQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildCitycategoryQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildCitycategoryQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildCitycategoryQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildCitycategoryQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     ChildCitycategoryQuery leftJoinGeoTowns($relationAlias = null) Adds a LEFT JOIN clause to the query using the GeoTowns relation
 * @method     ChildCitycategoryQuery rightJoinGeoTowns($relationAlias = null) Adds a RIGHT JOIN clause to the query using the GeoTowns relation
 * @method     ChildCitycategoryQuery innerJoinGeoTowns($relationAlias = null) Adds a INNER JOIN clause to the query using the GeoTowns relation
 *
 * @method     ChildCitycategoryQuery joinWithGeoTowns($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the GeoTowns relation
 *
 * @method     ChildCitycategoryQuery leftJoinWithGeoTowns() Adds a LEFT JOIN clause and with to the query using the GeoTowns relation
 * @method     ChildCitycategoryQuery rightJoinWithGeoTowns() Adds a RIGHT JOIN clause and with to the query using the GeoTowns relation
 * @method     ChildCitycategoryQuery innerJoinWithGeoTowns() Adds a INNER JOIN clause and with to the query using the GeoTowns relation
 *
 * @method     ChildCitycategoryQuery leftJoinGradeMaster($relationAlias = null) Adds a LEFT JOIN clause to the query using the GradeMaster relation
 * @method     ChildCitycategoryQuery rightJoinGradeMaster($relationAlias = null) Adds a RIGHT JOIN clause to the query using the GradeMaster relation
 * @method     ChildCitycategoryQuery innerJoinGradeMaster($relationAlias = null) Adds a INNER JOIN clause to the query using the GradeMaster relation
 *
 * @method     ChildCitycategoryQuery joinWithGradeMaster($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the GradeMaster relation
 *
 * @method     ChildCitycategoryQuery leftJoinWithGradeMaster() Adds a LEFT JOIN clause and with to the query using the GradeMaster relation
 * @method     ChildCitycategoryQuery rightJoinWithGradeMaster() Adds a RIGHT JOIN clause and with to the query using the GradeMaster relation
 * @method     ChildCitycategoryQuery innerJoinWithGradeMaster() Adds a INNER JOIN clause and with to the query using the GradeMaster relation
 *
 * @method     \entities\CompanyQuery|\entities\GeoTownsQuery|\entities\GradeMasterQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildCitycategory|null findOne(?ConnectionInterface $con = null) Return the first ChildCitycategory matching the query
 * @method     ChildCitycategory findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildCitycategory matching the query, or a new ChildCitycategory object populated from the query conditions when no match is found
 *
 * @method     ChildCitycategory|null findOneByCitycategoryid(int $citycategoryid) Return the first ChildCitycategory filtered by the citycategoryid column
 * @method     ChildCitycategory|null findOneByCompanyId(int $company_id) Return the first ChildCitycategory filtered by the company_id column
 * @method     ChildCitycategory|null findOneByItownid(string $itownid) Return the first ChildCitycategory filtered by the itownid column
 * @method     ChildCitycategory|null findOneByCityname(string $cityname) Return the first ChildCitycategory filtered by the cityname column
 * @method     ChildCitycategory|null findOneByScope(int $scope) Return the first ChildCitycategory filtered by the scope column
 * @method     ChildCitycategory|null findOneByIdentityKey(int $identity_key) Return the first ChildCitycategory filtered by the identity_key column
 * @method     ChildCitycategory|null findOneByCategory(string $category) Return the first ChildCitycategory filtered by the category column
 * @method     ChildCitycategory|null findOneByGradeId(int $grade_id) Return the first ChildCitycategory filtered by the grade_id column
 *
 * @method     ChildCitycategory requirePk($key, ?ConnectionInterface $con = null) Return the ChildCitycategory by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCitycategory requireOne(?ConnectionInterface $con = null) Return the first ChildCitycategory matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCitycategory requireOneByCitycategoryid(int $citycategoryid) Return the first ChildCitycategory filtered by the citycategoryid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCitycategory requireOneByCompanyId(int $company_id) Return the first ChildCitycategory filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCitycategory requireOneByItownid(string $itownid) Return the first ChildCitycategory filtered by the itownid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCitycategory requireOneByCityname(string $cityname) Return the first ChildCitycategory filtered by the cityname column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCitycategory requireOneByScope(int $scope) Return the first ChildCitycategory filtered by the scope column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCitycategory requireOneByIdentityKey(int $identity_key) Return the first ChildCitycategory filtered by the identity_key column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCitycategory requireOneByCategory(string $category) Return the first ChildCitycategory filtered by the category column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCitycategory requireOneByGradeId(int $grade_id) Return the first ChildCitycategory filtered by the grade_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCitycategory[]|Collection find(?ConnectionInterface $con = null) Return ChildCitycategory objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildCitycategory> find(?ConnectionInterface $con = null) Return ChildCitycategory objects based on current ModelCriteria
 *
 * @method     ChildCitycategory[]|Collection findByCitycategoryid(int|array<int> $citycategoryid) Return ChildCitycategory objects filtered by the citycategoryid column
 * @psalm-method Collection&\Traversable<ChildCitycategory> findByCitycategoryid(int|array<int> $citycategoryid) Return ChildCitycategory objects filtered by the citycategoryid column
 * @method     ChildCitycategory[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildCitycategory objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildCitycategory> findByCompanyId(int|array<int> $company_id) Return ChildCitycategory objects filtered by the company_id column
 * @method     ChildCitycategory[]|Collection findByItownid(string|array<string> $itownid) Return ChildCitycategory objects filtered by the itownid column
 * @psalm-method Collection&\Traversable<ChildCitycategory> findByItownid(string|array<string> $itownid) Return ChildCitycategory objects filtered by the itownid column
 * @method     ChildCitycategory[]|Collection findByCityname(string|array<string> $cityname) Return ChildCitycategory objects filtered by the cityname column
 * @psalm-method Collection&\Traversable<ChildCitycategory> findByCityname(string|array<string> $cityname) Return ChildCitycategory objects filtered by the cityname column
 * @method     ChildCitycategory[]|Collection findByScope(int|array<int> $scope) Return ChildCitycategory objects filtered by the scope column
 * @psalm-method Collection&\Traversable<ChildCitycategory> findByScope(int|array<int> $scope) Return ChildCitycategory objects filtered by the scope column
 * @method     ChildCitycategory[]|Collection findByIdentityKey(int|array<int> $identity_key) Return ChildCitycategory objects filtered by the identity_key column
 * @psalm-method Collection&\Traversable<ChildCitycategory> findByIdentityKey(int|array<int> $identity_key) Return ChildCitycategory objects filtered by the identity_key column
 * @method     ChildCitycategory[]|Collection findByCategory(string|array<string> $category) Return ChildCitycategory objects filtered by the category column
 * @psalm-method Collection&\Traversable<ChildCitycategory> findByCategory(string|array<string> $category) Return ChildCitycategory objects filtered by the category column
 * @method     ChildCitycategory[]|Collection findByGradeId(int|array<int> $grade_id) Return ChildCitycategory objects filtered by the grade_id column
 * @psalm-method Collection&\Traversable<ChildCitycategory> findByGradeId(int|array<int> $grade_id) Return ChildCitycategory objects filtered by the grade_id column
 *
 * @method     ChildCitycategory[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildCitycategory> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class CitycategoryQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\CitycategoryQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\Citycategory', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCitycategoryQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCitycategoryQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildCitycategoryQuery) {
            return $criteria;
        }
        $query = new ChildCitycategoryQuery();
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
     * @return ChildCitycategory|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CitycategoryTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = CitycategoryTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildCitycategory A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT citycategoryid, company_id, itownid, cityname, scope, identity_key, category, grade_id FROM citycategory WHERE citycategoryid = :p0';
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
            /** @var ChildCitycategory $obj */
            $obj = new ChildCitycategory();
            $obj->hydrate($row);
            CitycategoryTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildCitycategory|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(CitycategoryTableMap::COL_CITYCATEGORYID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(CitycategoryTableMap::COL_CITYCATEGORYID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the citycategoryid column
     *
     * Example usage:
     * <code>
     * $query->filterByCitycategoryid(1234); // WHERE citycategoryid = 1234
     * $query->filterByCitycategoryid(array(12, 34)); // WHERE citycategoryid IN (12, 34)
     * $query->filterByCitycategoryid(array('min' => 12)); // WHERE citycategoryid > 12
     * </code>
     *
     * @param mixed $citycategoryid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCitycategoryid($citycategoryid = null, ?string $comparison = null)
    {
        if (is_array($citycategoryid)) {
            $useMinMax = false;
            if (isset($citycategoryid['min'])) {
                $this->addUsingAlias(CitycategoryTableMap::COL_CITYCATEGORYID, $citycategoryid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($citycategoryid['max'])) {
                $this->addUsingAlias(CitycategoryTableMap::COL_CITYCATEGORYID, $citycategoryid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CitycategoryTableMap::COL_CITYCATEGORYID, $citycategoryid, $comparison);

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
                $this->addUsingAlias(CitycategoryTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(CitycategoryTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CitycategoryTableMap::COL_COMPANY_ID, $companyId, $comparison);

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
                $this->addUsingAlias(CitycategoryTableMap::COL_ITOWNID, $itownid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($itownid['max'])) {
                $this->addUsingAlias(CitycategoryTableMap::COL_ITOWNID, $itownid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CitycategoryTableMap::COL_ITOWNID, $itownid, $comparison);

        return $this;
    }

    /**
     * Filter the query on the cityname column
     *
     * Example usage:
     * <code>
     * $query->filterByCityname('fooValue');   // WHERE cityname = 'fooValue'
     * $query->filterByCityname('%fooValue%', Criteria::LIKE); // WHERE cityname LIKE '%fooValue%'
     * $query->filterByCityname(['foo', 'bar']); // WHERE cityname IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $cityname The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCityname($cityname = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cityname)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CitycategoryTableMap::COL_CITYNAME, $cityname, $comparison);

        return $this;
    }

    /**
     * Filter the query on the scope column
     *
     * Example usage:
     * <code>
     * $query->filterByScope(1234); // WHERE scope = 1234
     * $query->filterByScope(array(12, 34)); // WHERE scope IN (12, 34)
     * $query->filterByScope(array('min' => 12)); // WHERE scope > 12
     * </code>
     *
     * @param mixed $scope The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByScope($scope = null, ?string $comparison = null)
    {
        if (is_array($scope)) {
            $useMinMax = false;
            if (isset($scope['min'])) {
                $this->addUsingAlias(CitycategoryTableMap::COL_SCOPE, $scope['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($scope['max'])) {
                $this->addUsingAlias(CitycategoryTableMap::COL_SCOPE, $scope['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CitycategoryTableMap::COL_SCOPE, $scope, $comparison);

        return $this;
    }

    /**
     * Filter the query on the identity_key column
     *
     * Example usage:
     * <code>
     * $query->filterByIdentityKey(1234); // WHERE identity_key = 1234
     * $query->filterByIdentityKey(array(12, 34)); // WHERE identity_key IN (12, 34)
     * $query->filterByIdentityKey(array('min' => 12)); // WHERE identity_key > 12
     * </code>
     *
     * @param mixed $identityKey The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdentityKey($identityKey = null, ?string $comparison = null)
    {
        if (is_array($identityKey)) {
            $useMinMax = false;
            if (isset($identityKey['min'])) {
                $this->addUsingAlias(CitycategoryTableMap::COL_IDENTITY_KEY, $identityKey['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($identityKey['max'])) {
                $this->addUsingAlias(CitycategoryTableMap::COL_IDENTITY_KEY, $identityKey['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CitycategoryTableMap::COL_IDENTITY_KEY, $identityKey, $comparison);

        return $this;
    }

    /**
     * Filter the query on the category column
     *
     * Example usage:
     * <code>
     * $query->filterByCategory('fooValue');   // WHERE category = 'fooValue'
     * $query->filterByCategory('%fooValue%', Criteria::LIKE); // WHERE category LIKE '%fooValue%'
     * $query->filterByCategory(['foo', 'bar']); // WHERE category IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $category The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCategory($category = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($category)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CitycategoryTableMap::COL_CATEGORY, $category, $comparison);

        return $this;
    }

    /**
     * Filter the query on the grade_id column
     *
     * Example usage:
     * <code>
     * $query->filterByGradeId(1234); // WHERE grade_id = 1234
     * $query->filterByGradeId(array(12, 34)); // WHERE grade_id IN (12, 34)
     * $query->filterByGradeId(array('min' => 12)); // WHERE grade_id > 12
     * </code>
     *
     * @see       filterByGradeMaster()
     *
     * @param mixed $gradeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByGradeId($gradeId = null, ?string $comparison = null)
    {
        if (is_array($gradeId)) {
            $useMinMax = false;
            if (isset($gradeId['min'])) {
                $this->addUsingAlias(CitycategoryTableMap::COL_GRADE_ID, $gradeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($gradeId['max'])) {
                $this->addUsingAlias(CitycategoryTableMap::COL_GRADE_ID, $gradeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CitycategoryTableMap::COL_GRADE_ID, $gradeId, $comparison);

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
                ->addUsingAlias(CitycategoryTableMap::COL_COMPANY_ID, $company->getCompanyId(), $comparison);
        } elseif ($company instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(CitycategoryTableMap::COL_COMPANY_ID, $company->toKeyValue('PrimaryKey', 'CompanyId'), $comparison);

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
                ->addUsingAlias(CitycategoryTableMap::COL_ITOWNID, $geoTowns->getItownid(), $comparison);
        } elseif ($geoTowns instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(CitycategoryTableMap::COL_ITOWNID, $geoTowns->toKeyValue('PrimaryKey', 'Itownid'), $comparison);

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
     * Filter the query by a related \entities\GradeMaster object
     *
     * @param \entities\GradeMaster|ObjectCollection $gradeMaster The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByGradeMaster($gradeMaster, ?string $comparison = null)
    {
        if ($gradeMaster instanceof \entities\GradeMaster) {
            return $this
                ->addUsingAlias(CitycategoryTableMap::COL_GRADE_ID, $gradeMaster->getGradeid(), $comparison);
        } elseif ($gradeMaster instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(CitycategoryTableMap::COL_GRADE_ID, $gradeMaster->toKeyValue('PrimaryKey', 'Gradeid'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByGradeMaster() only accepts arguments of type \entities\GradeMaster or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the GradeMaster relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinGradeMaster(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('GradeMaster');

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
            $this->addJoinObject($join, 'GradeMaster');
        }

        return $this;
    }

    /**
     * Use the GradeMaster relation GradeMaster object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\GradeMasterQuery A secondary query class using the current class as primary query
     */
    public function useGradeMasterQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinGradeMaster($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'GradeMaster', '\entities\GradeMasterQuery');
    }

    /**
     * Use the GradeMaster relation GradeMaster object
     *
     * @param callable(\entities\GradeMasterQuery):\entities\GradeMasterQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withGradeMasterQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useGradeMasterQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to GradeMaster table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\GradeMasterQuery The inner query object of the EXISTS statement
     */
    public function useGradeMasterExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\GradeMasterQuery */
        $q = $this->useExistsQuery('GradeMaster', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to GradeMaster table for a NOT EXISTS query.
     *
     * @see useGradeMasterExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\GradeMasterQuery The inner query object of the NOT EXISTS statement
     */
    public function useGradeMasterNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\GradeMasterQuery */
        $q = $this->useExistsQuery('GradeMaster', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to GradeMaster table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\GradeMasterQuery The inner query object of the IN statement
     */
    public function useInGradeMasterQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\GradeMasterQuery */
        $q = $this->useInQuery('GradeMaster', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to GradeMaster table for a NOT IN query.
     *
     * @see useGradeMasterInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\GradeMasterQuery The inner query object of the NOT IN statement
     */
    public function useNotInGradeMasterQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\GradeMasterQuery */
        $q = $this->useInQuery('GradeMaster', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildCitycategory $citycategory Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($citycategory = null)
    {
        if ($citycategory) {
            $this->addUsingAlias(CitycategoryTableMap::COL_CITYCATEGORYID, $citycategory->getCitycategoryid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the citycategory table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CitycategoryTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CitycategoryTableMap::clearInstancePool();
            CitycategoryTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(CitycategoryTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CitycategoryTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            CitycategoryTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            CitycategoryTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
