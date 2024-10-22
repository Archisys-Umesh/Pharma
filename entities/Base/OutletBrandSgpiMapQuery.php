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
use entities\OutletBrandSgpiMap as ChildOutletBrandSgpiMap;
use entities\OutletBrandSgpiMapQuery as ChildOutletBrandSgpiMapQuery;
use entities\Map\OutletBrandSgpiMapTableMap;

/**
 * Base class that represents a query for the `outlet_brand_sgpi_map` table.
 *
 * @method     ChildOutletBrandSgpiMapQuery orderBySgpimapId($order = Criteria::ASC) Order by the sgpimap_id column
 * @method     ChildOutletBrandSgpiMapQuery orderByOrgDataId($order = Criteria::ASC) Order by the org_data_id column
 * @method     ChildOutletBrandSgpiMapQuery orderByBrandId($order = Criteria::ASC) Order by the brand_id column
 * @method     ChildOutletBrandSgpiMapQuery orderBySgpiStatus($order = Criteria::ASC) Order by the sgpi_status column
 * @method     ChildOutletBrandSgpiMapQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildOutletBrandSgpiMapQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildOutletBrandSgpiMapQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildOutletBrandSgpiMapQuery groupBySgpimapId() Group by the sgpimap_id column
 * @method     ChildOutletBrandSgpiMapQuery groupByOrgDataId() Group by the org_data_id column
 * @method     ChildOutletBrandSgpiMapQuery groupByBrandId() Group by the brand_id column
 * @method     ChildOutletBrandSgpiMapQuery groupBySgpiStatus() Group by the sgpi_status column
 * @method     ChildOutletBrandSgpiMapQuery groupByCompanyId() Group by the company_id column
 * @method     ChildOutletBrandSgpiMapQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildOutletBrandSgpiMapQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildOutletBrandSgpiMapQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildOutletBrandSgpiMapQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildOutletBrandSgpiMapQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildOutletBrandSgpiMapQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildOutletBrandSgpiMapQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildOutletBrandSgpiMapQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildOutletBrandSgpiMap|null findOne(?ConnectionInterface $con = null) Return the first ChildOutletBrandSgpiMap matching the query
 * @method     ChildOutletBrandSgpiMap findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildOutletBrandSgpiMap matching the query, or a new ChildOutletBrandSgpiMap object populated from the query conditions when no match is found
 *
 * @method     ChildOutletBrandSgpiMap|null findOneBySgpimapId(string $sgpimap_id) Return the first ChildOutletBrandSgpiMap filtered by the sgpimap_id column
 * @method     ChildOutletBrandSgpiMap|null findOneByOrgDataId(int $org_data_id) Return the first ChildOutletBrandSgpiMap filtered by the org_data_id column
 * @method     ChildOutletBrandSgpiMap|null findOneByBrandId(int $brand_id) Return the first ChildOutletBrandSgpiMap filtered by the brand_id column
 * @method     ChildOutletBrandSgpiMap|null findOneBySgpiStatus(boolean $sgpi_status) Return the first ChildOutletBrandSgpiMap filtered by the sgpi_status column
 * @method     ChildOutletBrandSgpiMap|null findOneByCompanyId(int $company_id) Return the first ChildOutletBrandSgpiMap filtered by the company_id column
 * @method     ChildOutletBrandSgpiMap|null findOneByCreatedAt(string $created_at) Return the first ChildOutletBrandSgpiMap filtered by the created_at column
 * @method     ChildOutletBrandSgpiMap|null findOneByUpdatedAt(string $updated_at) Return the first ChildOutletBrandSgpiMap filtered by the updated_at column
 *
 * @method     ChildOutletBrandSgpiMap requirePk($key, ?ConnectionInterface $con = null) Return the ChildOutletBrandSgpiMap by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletBrandSgpiMap requireOne(?ConnectionInterface $con = null) Return the first ChildOutletBrandSgpiMap matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOutletBrandSgpiMap requireOneBySgpimapId(string $sgpimap_id) Return the first ChildOutletBrandSgpiMap filtered by the sgpimap_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletBrandSgpiMap requireOneByOrgDataId(int $org_data_id) Return the first ChildOutletBrandSgpiMap filtered by the org_data_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletBrandSgpiMap requireOneByBrandId(int $brand_id) Return the first ChildOutletBrandSgpiMap filtered by the brand_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletBrandSgpiMap requireOneBySgpiStatus(boolean $sgpi_status) Return the first ChildOutletBrandSgpiMap filtered by the sgpi_status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletBrandSgpiMap requireOneByCompanyId(int $company_id) Return the first ChildOutletBrandSgpiMap filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletBrandSgpiMap requireOneByCreatedAt(string $created_at) Return the first ChildOutletBrandSgpiMap filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletBrandSgpiMap requireOneByUpdatedAt(string $updated_at) Return the first ChildOutletBrandSgpiMap filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOutletBrandSgpiMap[]|Collection find(?ConnectionInterface $con = null) Return ChildOutletBrandSgpiMap objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildOutletBrandSgpiMap> find(?ConnectionInterface $con = null) Return ChildOutletBrandSgpiMap objects based on current ModelCriteria
 *
 * @method     ChildOutletBrandSgpiMap[]|Collection findBySgpimapId(string|array<string> $sgpimap_id) Return ChildOutletBrandSgpiMap objects filtered by the sgpimap_id column
 * @psalm-method Collection&\Traversable<ChildOutletBrandSgpiMap> findBySgpimapId(string|array<string> $sgpimap_id) Return ChildOutletBrandSgpiMap objects filtered by the sgpimap_id column
 * @method     ChildOutletBrandSgpiMap[]|Collection findByOrgDataId(int|array<int> $org_data_id) Return ChildOutletBrandSgpiMap objects filtered by the org_data_id column
 * @psalm-method Collection&\Traversable<ChildOutletBrandSgpiMap> findByOrgDataId(int|array<int> $org_data_id) Return ChildOutletBrandSgpiMap objects filtered by the org_data_id column
 * @method     ChildOutletBrandSgpiMap[]|Collection findByBrandId(int|array<int> $brand_id) Return ChildOutletBrandSgpiMap objects filtered by the brand_id column
 * @psalm-method Collection&\Traversable<ChildOutletBrandSgpiMap> findByBrandId(int|array<int> $brand_id) Return ChildOutletBrandSgpiMap objects filtered by the brand_id column
 * @method     ChildOutletBrandSgpiMap[]|Collection findBySgpiStatus(boolean|array<boolean> $sgpi_status) Return ChildOutletBrandSgpiMap objects filtered by the sgpi_status column
 * @psalm-method Collection&\Traversable<ChildOutletBrandSgpiMap> findBySgpiStatus(boolean|array<boolean> $sgpi_status) Return ChildOutletBrandSgpiMap objects filtered by the sgpi_status column
 * @method     ChildOutletBrandSgpiMap[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildOutletBrandSgpiMap objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildOutletBrandSgpiMap> findByCompanyId(int|array<int> $company_id) Return ChildOutletBrandSgpiMap objects filtered by the company_id column
 * @method     ChildOutletBrandSgpiMap[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildOutletBrandSgpiMap objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildOutletBrandSgpiMap> findByCreatedAt(string|array<string> $created_at) Return ChildOutletBrandSgpiMap objects filtered by the created_at column
 * @method     ChildOutletBrandSgpiMap[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildOutletBrandSgpiMap objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildOutletBrandSgpiMap> findByUpdatedAt(string|array<string> $updated_at) Return ChildOutletBrandSgpiMap objects filtered by the updated_at column
 *
 * @method     ChildOutletBrandSgpiMap[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildOutletBrandSgpiMap> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class OutletBrandSgpiMapQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\OutletBrandSgpiMapQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\OutletBrandSgpiMap', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildOutletBrandSgpiMapQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildOutletBrandSgpiMapQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildOutletBrandSgpiMapQuery) {
            return $criteria;
        }
        $query = new ChildOutletBrandSgpiMapQuery();
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
     * @return ChildOutletBrandSgpiMap|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(OutletBrandSgpiMapTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = OutletBrandSgpiMapTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildOutletBrandSgpiMap A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT sgpimap_id, org_data_id, brand_id, sgpi_status, company_id, created_at, updated_at FROM outlet_brand_sgpi_map WHERE sgpimap_id = :p0';
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
            /** @var ChildOutletBrandSgpiMap $obj */
            $obj = new ChildOutletBrandSgpiMap();
            $obj->hydrate($row);
            OutletBrandSgpiMapTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildOutletBrandSgpiMap|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(OutletBrandSgpiMapTableMap::COL_SGPIMAP_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(OutletBrandSgpiMapTableMap::COL_SGPIMAP_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the sgpimap_id column
     *
     * Example usage:
     * <code>
     * $query->filterBySgpimapId(1234); // WHERE sgpimap_id = 1234
     * $query->filterBySgpimapId(array(12, 34)); // WHERE sgpimap_id IN (12, 34)
     * $query->filterBySgpimapId(array('min' => 12)); // WHERE sgpimap_id > 12
     * </code>
     *
     * @param mixed $sgpimapId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySgpimapId($sgpimapId = null, ?string $comparison = null)
    {
        if (is_array($sgpimapId)) {
            $useMinMax = false;
            if (isset($sgpimapId['min'])) {
                $this->addUsingAlias(OutletBrandSgpiMapTableMap::COL_SGPIMAP_ID, $sgpimapId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($sgpimapId['max'])) {
                $this->addUsingAlias(OutletBrandSgpiMapTableMap::COL_SGPIMAP_ID, $sgpimapId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletBrandSgpiMapTableMap::COL_SGPIMAP_ID, $sgpimapId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the org_data_id column
     *
     * Example usage:
     * <code>
     * $query->filterByOrgDataId(1234); // WHERE org_data_id = 1234
     * $query->filterByOrgDataId(array(12, 34)); // WHERE org_data_id IN (12, 34)
     * $query->filterByOrgDataId(array('min' => 12)); // WHERE org_data_id > 12
     * </code>
     *
     * @param mixed $orgDataId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrgDataId($orgDataId = null, ?string $comparison = null)
    {
        if (is_array($orgDataId)) {
            $useMinMax = false;
            if (isset($orgDataId['min'])) {
                $this->addUsingAlias(OutletBrandSgpiMapTableMap::COL_ORG_DATA_ID, $orgDataId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($orgDataId['max'])) {
                $this->addUsingAlias(OutletBrandSgpiMapTableMap::COL_ORG_DATA_ID, $orgDataId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletBrandSgpiMapTableMap::COL_ORG_DATA_ID, $orgDataId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the brand_id column
     *
     * Example usage:
     * <code>
     * $query->filterByBrandId(1234); // WHERE brand_id = 1234
     * $query->filterByBrandId(array(12, 34)); // WHERE brand_id IN (12, 34)
     * $query->filterByBrandId(array('min' => 12)); // WHERE brand_id > 12
     * </code>
     *
     * @param mixed $brandId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBrandId($brandId = null, ?string $comparison = null)
    {
        if (is_array($brandId)) {
            $useMinMax = false;
            if (isset($brandId['min'])) {
                $this->addUsingAlias(OutletBrandSgpiMapTableMap::COL_BRAND_ID, $brandId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($brandId['max'])) {
                $this->addUsingAlias(OutletBrandSgpiMapTableMap::COL_BRAND_ID, $brandId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletBrandSgpiMapTableMap::COL_BRAND_ID, $brandId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the sgpi_status column
     *
     * Example usage:
     * <code>
     * $query->filterBySgpiStatus(true); // WHERE sgpi_status = true
     * $query->filterBySgpiStatus('yes'); // WHERE sgpi_status = true
     * </code>
     *
     * @param bool|string $sgpiStatus The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySgpiStatus($sgpiStatus = null, ?string $comparison = null)
    {
        if (is_string($sgpiStatus)) {
            $sgpiStatus = in_array(strtolower($sgpiStatus), array('false', 'off', '-', 'no', 'n', '0', ''), true) ? false : true;
        }

        $this->addUsingAlias(OutletBrandSgpiMapTableMap::COL_SGPI_STATUS, $sgpiStatus, $comparison);

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
                $this->addUsingAlias(OutletBrandSgpiMapTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(OutletBrandSgpiMapTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletBrandSgpiMapTableMap::COL_COMPANY_ID, $companyId, $comparison);

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
                $this->addUsingAlias(OutletBrandSgpiMapTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(OutletBrandSgpiMapTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletBrandSgpiMapTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(OutletBrandSgpiMapTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(OutletBrandSgpiMapTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletBrandSgpiMapTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildOutletBrandSgpiMap $outletBrandSgpiMap Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($outletBrandSgpiMap = null)
    {
        if ($outletBrandSgpiMap) {
            $this->addUsingAlias(OutletBrandSgpiMapTableMap::COL_SGPIMAP_ID, $outletBrandSgpiMap->getSgpimapId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the outlet_brand_sgpi_map table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OutletBrandSgpiMapTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            OutletBrandSgpiMapTableMap::clearInstancePool();
            OutletBrandSgpiMapTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(OutletBrandSgpiMapTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(OutletBrandSgpiMapTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            OutletBrandSgpiMapTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            OutletBrandSgpiMapTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
