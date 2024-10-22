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
use entities\Outlettypemodules as ChildOutlettypemodules;
use entities\OutlettypemodulesQuery as ChildOutlettypemodulesQuery;
use entities\Map\OutlettypemodulesTableMap;

/**
 * Base class that represents a query for the `outlettypemodules` table.
 *
 * @method     ChildOutlettypemodulesQuery orderByOutlettypemoduleid($order = Criteria::ASC) Order by the outlettypemoduleid column
 * @method     ChildOutlettypemodulesQuery orderByOutlettypeid($order = Criteria::ASC) Order by the outlettypeid column
 * @method     ChildOutlettypemodulesQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildOutlettypemodulesQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildOutlettypemodulesQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildOutlettypemodulesQuery orderByModuleName($order = Criteria::ASC) Order by the module_name column
 *
 * @method     ChildOutlettypemodulesQuery groupByOutlettypemoduleid() Group by the outlettypemoduleid column
 * @method     ChildOutlettypemodulesQuery groupByOutlettypeid() Group by the outlettypeid column
 * @method     ChildOutlettypemodulesQuery groupByCompanyId() Group by the company_id column
 * @method     ChildOutlettypemodulesQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildOutlettypemodulesQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildOutlettypemodulesQuery groupByModuleName() Group by the module_name column
 *
 * @method     ChildOutlettypemodulesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildOutlettypemodulesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildOutlettypemodulesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildOutlettypemodulesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildOutlettypemodulesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildOutlettypemodulesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildOutlettypemodulesQuery leftJoinOutletType($relationAlias = null) Adds a LEFT JOIN clause to the query using the OutletType relation
 * @method     ChildOutlettypemodulesQuery rightJoinOutletType($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OutletType relation
 * @method     ChildOutlettypemodulesQuery innerJoinOutletType($relationAlias = null) Adds a INNER JOIN clause to the query using the OutletType relation
 *
 * @method     ChildOutlettypemodulesQuery joinWithOutletType($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OutletType relation
 *
 * @method     ChildOutlettypemodulesQuery leftJoinWithOutletType() Adds a LEFT JOIN clause and with to the query using the OutletType relation
 * @method     ChildOutlettypemodulesQuery rightJoinWithOutletType() Adds a RIGHT JOIN clause and with to the query using the OutletType relation
 * @method     ChildOutlettypemodulesQuery innerJoinWithOutletType() Adds a INNER JOIN clause and with to the query using the OutletType relation
 *
 * @method     \entities\OutletTypeQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildOutlettypemodules|null findOne(?ConnectionInterface $con = null) Return the first ChildOutlettypemodules matching the query
 * @method     ChildOutlettypemodules findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildOutlettypemodules matching the query, or a new ChildOutlettypemodules object populated from the query conditions when no match is found
 *
 * @method     ChildOutlettypemodules|null findOneByOutlettypemoduleid(int $outlettypemoduleid) Return the first ChildOutlettypemodules filtered by the outlettypemoduleid column
 * @method     ChildOutlettypemodules|null findOneByOutlettypeid(int $outlettypeid) Return the first ChildOutlettypemodules filtered by the outlettypeid column
 * @method     ChildOutlettypemodules|null findOneByCompanyId(int $company_id) Return the first ChildOutlettypemodules filtered by the company_id column
 * @method     ChildOutlettypemodules|null findOneByCreatedAt(string $created_at) Return the first ChildOutlettypemodules filtered by the created_at column
 * @method     ChildOutlettypemodules|null findOneByUpdatedAt(string $updated_at) Return the first ChildOutlettypemodules filtered by the updated_at column
 * @method     ChildOutlettypemodules|null findOneByModuleName(string $module_name) Return the first ChildOutlettypemodules filtered by the module_name column
 *
 * @method     ChildOutlettypemodules requirePk($key, ?ConnectionInterface $con = null) Return the ChildOutlettypemodules by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutlettypemodules requireOne(?ConnectionInterface $con = null) Return the first ChildOutlettypemodules matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOutlettypemodules requireOneByOutlettypemoduleid(int $outlettypemoduleid) Return the first ChildOutlettypemodules filtered by the outlettypemoduleid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutlettypemodules requireOneByOutlettypeid(int $outlettypeid) Return the first ChildOutlettypemodules filtered by the outlettypeid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutlettypemodules requireOneByCompanyId(int $company_id) Return the first ChildOutlettypemodules filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutlettypemodules requireOneByCreatedAt(string $created_at) Return the first ChildOutlettypemodules filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutlettypemodules requireOneByUpdatedAt(string $updated_at) Return the first ChildOutlettypemodules filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutlettypemodules requireOneByModuleName(string $module_name) Return the first ChildOutlettypemodules filtered by the module_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOutlettypemodules[]|Collection find(?ConnectionInterface $con = null) Return ChildOutlettypemodules objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildOutlettypemodules> find(?ConnectionInterface $con = null) Return ChildOutlettypemodules objects based on current ModelCriteria
 *
 * @method     ChildOutlettypemodules[]|Collection findByOutlettypemoduleid(int|array<int> $outlettypemoduleid) Return ChildOutlettypemodules objects filtered by the outlettypemoduleid column
 * @psalm-method Collection&\Traversable<ChildOutlettypemodules> findByOutlettypemoduleid(int|array<int> $outlettypemoduleid) Return ChildOutlettypemodules objects filtered by the outlettypemoduleid column
 * @method     ChildOutlettypemodules[]|Collection findByOutlettypeid(int|array<int> $outlettypeid) Return ChildOutlettypemodules objects filtered by the outlettypeid column
 * @psalm-method Collection&\Traversable<ChildOutlettypemodules> findByOutlettypeid(int|array<int> $outlettypeid) Return ChildOutlettypemodules objects filtered by the outlettypeid column
 * @method     ChildOutlettypemodules[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildOutlettypemodules objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildOutlettypemodules> findByCompanyId(int|array<int> $company_id) Return ChildOutlettypemodules objects filtered by the company_id column
 * @method     ChildOutlettypemodules[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildOutlettypemodules objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildOutlettypemodules> findByCreatedAt(string|array<string> $created_at) Return ChildOutlettypemodules objects filtered by the created_at column
 * @method     ChildOutlettypemodules[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildOutlettypemodules objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildOutlettypemodules> findByUpdatedAt(string|array<string> $updated_at) Return ChildOutlettypemodules objects filtered by the updated_at column
 * @method     ChildOutlettypemodules[]|Collection findByModuleName(string|array<string> $module_name) Return ChildOutlettypemodules objects filtered by the module_name column
 * @psalm-method Collection&\Traversable<ChildOutlettypemodules> findByModuleName(string|array<string> $module_name) Return ChildOutlettypemodules objects filtered by the module_name column
 *
 * @method     ChildOutlettypemodules[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildOutlettypemodules> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class OutlettypemodulesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\OutlettypemodulesQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\Outlettypemodules', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildOutlettypemodulesQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildOutlettypemodulesQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildOutlettypemodulesQuery) {
            return $criteria;
        }
        $query = new ChildOutlettypemodulesQuery();
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
     * @return ChildOutlettypemodules|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(OutlettypemodulesTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = OutlettypemodulesTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildOutlettypemodules A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT outlettypemoduleid, outlettypeid, company_id, created_at, updated_at, module_name FROM outlettypemodules WHERE outlettypemoduleid = :p0';
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
            /** @var ChildOutlettypemodules $obj */
            $obj = new ChildOutlettypemodules();
            $obj->hydrate($row);
            OutlettypemodulesTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildOutlettypemodules|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(OutlettypemodulesTableMap::COL_OUTLETTYPEMODULEID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(OutlettypemodulesTableMap::COL_OUTLETTYPEMODULEID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the outlettypemoduleid column
     *
     * Example usage:
     * <code>
     * $query->filterByOutlettypemoduleid(1234); // WHERE outlettypemoduleid = 1234
     * $query->filterByOutlettypemoduleid(array(12, 34)); // WHERE outlettypemoduleid IN (12, 34)
     * $query->filterByOutlettypemoduleid(array('min' => 12)); // WHERE outlettypemoduleid > 12
     * </code>
     *
     * @param mixed $outlettypemoduleid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutlettypemoduleid($outlettypemoduleid = null, ?string $comparison = null)
    {
        if (is_array($outlettypemoduleid)) {
            $useMinMax = false;
            if (isset($outlettypemoduleid['min'])) {
                $this->addUsingAlias(OutlettypemodulesTableMap::COL_OUTLETTYPEMODULEID, $outlettypemoduleid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outlettypemoduleid['max'])) {
                $this->addUsingAlias(OutlettypemodulesTableMap::COL_OUTLETTYPEMODULEID, $outlettypemoduleid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutlettypemodulesTableMap::COL_OUTLETTYPEMODULEID, $outlettypemoduleid, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlettypeid column
     *
     * Example usage:
     * <code>
     * $query->filterByOutlettypeid(1234); // WHERE outlettypeid = 1234
     * $query->filterByOutlettypeid(array(12, 34)); // WHERE outlettypeid IN (12, 34)
     * $query->filterByOutlettypeid(array('min' => 12)); // WHERE outlettypeid > 12
     * </code>
     *
     * @see       filterByOutletType()
     *
     * @param mixed $outlettypeid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutlettypeid($outlettypeid = null, ?string $comparison = null)
    {
        if (is_array($outlettypeid)) {
            $useMinMax = false;
            if (isset($outlettypeid['min'])) {
                $this->addUsingAlias(OutlettypemodulesTableMap::COL_OUTLETTYPEID, $outlettypeid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outlettypeid['max'])) {
                $this->addUsingAlias(OutlettypemodulesTableMap::COL_OUTLETTYPEID, $outlettypeid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutlettypemodulesTableMap::COL_OUTLETTYPEID, $outlettypeid, $comparison);

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
                $this->addUsingAlias(OutlettypemodulesTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(OutlettypemodulesTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutlettypemodulesTableMap::COL_COMPANY_ID, $companyId, $comparison);

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
                $this->addUsingAlias(OutlettypemodulesTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(OutlettypemodulesTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutlettypemodulesTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(OutlettypemodulesTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(OutlettypemodulesTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutlettypemodulesTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the module_name column
     *
     * Example usage:
     * <code>
     * $query->filterByModuleName('fooValue');   // WHERE module_name = 'fooValue'
     * $query->filterByModuleName('%fooValue%', Criteria::LIKE); // WHERE module_name LIKE '%fooValue%'
     * $query->filterByModuleName(['foo', 'bar']); // WHERE module_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $moduleName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByModuleName($moduleName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($moduleName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutlettypemodulesTableMap::COL_MODULE_NAME, $moduleName, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \entities\OutletType object
     *
     * @param \entities\OutletType|ObjectCollection $outletType The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletType($outletType, ?string $comparison = null)
    {
        if ($outletType instanceof \entities\OutletType) {
            return $this
                ->addUsingAlias(OutlettypemodulesTableMap::COL_OUTLETTYPEID, $outletType->getOutlettypeId(), $comparison);
        } elseif ($outletType instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(OutlettypemodulesTableMap::COL_OUTLETTYPEID, $outletType->toKeyValue('PrimaryKey', 'OutlettypeId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByOutletType() only accepts arguments of type \entities\OutletType or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OutletType relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOutletType(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OutletType');

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
            $this->addJoinObject($join, 'OutletType');
        }

        return $this;
    }

    /**
     * Use the OutletType relation OutletType object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\OutletTypeQuery A secondary query class using the current class as primary query
     */
    public function useOutletTypeQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinOutletType($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OutletType', '\entities\OutletTypeQuery');
    }

    /**
     * Use the OutletType relation OutletType object
     *
     * @param callable(\entities\OutletTypeQuery):\entities\OutletTypeQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOutletTypeQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useOutletTypeQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to OutletType table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\OutletTypeQuery The inner query object of the EXISTS statement
     */
    public function useOutletTypeExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\OutletTypeQuery */
        $q = $this->useExistsQuery('OutletType', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to OutletType table for a NOT EXISTS query.
     *
     * @see useOutletTypeExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\OutletTypeQuery The inner query object of the NOT EXISTS statement
     */
    public function useOutletTypeNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OutletTypeQuery */
        $q = $this->useExistsQuery('OutletType', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to OutletType table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\OutletTypeQuery The inner query object of the IN statement
     */
    public function useInOutletTypeQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\OutletTypeQuery */
        $q = $this->useInQuery('OutletType', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to OutletType table for a NOT IN query.
     *
     * @see useOutletTypeInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\OutletTypeQuery The inner query object of the NOT IN statement
     */
    public function useNotInOutletTypeQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OutletTypeQuery */
        $q = $this->useInQuery('OutletType', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildOutlettypemodules $outlettypemodules Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($outlettypemodules = null)
    {
        if ($outlettypemodules) {
            $this->addUsingAlias(OutlettypemodulesTableMap::COL_OUTLETTYPEMODULEID, $outlettypemodules->getOutlettypemoduleid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the outlettypemodules table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OutlettypemodulesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            OutlettypemodulesTableMap::clearInstancePool();
            OutlettypemodulesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(OutlettypemodulesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(OutlettypemodulesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            OutlettypemodulesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            OutlettypemodulesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
