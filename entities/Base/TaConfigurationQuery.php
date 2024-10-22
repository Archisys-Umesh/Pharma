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
use entities\TaConfiguration as ChildTaConfiguration;
use entities\TaConfigurationQuery as ChildTaConfigurationQuery;
use entities\Map\TaConfigurationTableMap;

/**
 * Base class that represents a query for the `ta_configuration` table.
 *
 * @method     ChildTaConfigurationQuery orderByTaConfigId($order = Criteria::ASC) Order by the ta_config_id column
 * @method     ChildTaConfigurationQuery orderByFromKm($order = Criteria::ASC) Order by the from_km column
 * @method     ChildTaConfigurationQuery orderByToKm($order = Criteria::ASC) Order by the to_km column
 * @method     ChildTaConfigurationQuery orderByPolicyKey($order = Criteria::ASC) Order by the policy_key column
 * @method     ChildTaConfigurationQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildTaConfigurationQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildTaConfigurationQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildTaConfigurationQuery groupByTaConfigId() Group by the ta_config_id column
 * @method     ChildTaConfigurationQuery groupByFromKm() Group by the from_km column
 * @method     ChildTaConfigurationQuery groupByToKm() Group by the to_km column
 * @method     ChildTaConfigurationQuery groupByPolicyKey() Group by the policy_key column
 * @method     ChildTaConfigurationQuery groupByCompanyId() Group by the company_id column
 * @method     ChildTaConfigurationQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildTaConfigurationQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildTaConfigurationQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildTaConfigurationQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildTaConfigurationQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildTaConfigurationQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildTaConfigurationQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildTaConfigurationQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildTaConfigurationQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildTaConfigurationQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildTaConfigurationQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildTaConfigurationQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildTaConfigurationQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildTaConfigurationQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildTaConfigurationQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     \entities\CompanyQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildTaConfiguration|null findOne(?ConnectionInterface $con = null) Return the first ChildTaConfiguration matching the query
 * @method     ChildTaConfiguration findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildTaConfiguration matching the query, or a new ChildTaConfiguration object populated from the query conditions when no match is found
 *
 * @method     ChildTaConfiguration|null findOneByTaConfigId(int $ta_config_id) Return the first ChildTaConfiguration filtered by the ta_config_id column
 * @method     ChildTaConfiguration|null findOneByFromKm(int $from_km) Return the first ChildTaConfiguration filtered by the from_km column
 * @method     ChildTaConfiguration|null findOneByToKm(int $to_km) Return the first ChildTaConfiguration filtered by the to_km column
 * @method     ChildTaConfiguration|null findOneByPolicyKey(string $policy_key) Return the first ChildTaConfiguration filtered by the policy_key column
 * @method     ChildTaConfiguration|null findOneByCompanyId(int $company_id) Return the first ChildTaConfiguration filtered by the company_id column
 * @method     ChildTaConfiguration|null findOneByCreatedAt(string $created_at) Return the first ChildTaConfiguration filtered by the created_at column
 * @method     ChildTaConfiguration|null findOneByUpdatedAt(string $updated_at) Return the first ChildTaConfiguration filtered by the updated_at column
 *
 * @method     ChildTaConfiguration requirePk($key, ?ConnectionInterface $con = null) Return the ChildTaConfiguration by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTaConfiguration requireOne(?ConnectionInterface $con = null) Return the first ChildTaConfiguration matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTaConfiguration requireOneByTaConfigId(int $ta_config_id) Return the first ChildTaConfiguration filtered by the ta_config_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTaConfiguration requireOneByFromKm(int $from_km) Return the first ChildTaConfiguration filtered by the from_km column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTaConfiguration requireOneByToKm(int $to_km) Return the first ChildTaConfiguration filtered by the to_km column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTaConfiguration requireOneByPolicyKey(string $policy_key) Return the first ChildTaConfiguration filtered by the policy_key column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTaConfiguration requireOneByCompanyId(int $company_id) Return the first ChildTaConfiguration filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTaConfiguration requireOneByCreatedAt(string $created_at) Return the first ChildTaConfiguration filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTaConfiguration requireOneByUpdatedAt(string $updated_at) Return the first ChildTaConfiguration filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTaConfiguration[]|Collection find(?ConnectionInterface $con = null) Return ChildTaConfiguration objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildTaConfiguration> find(?ConnectionInterface $con = null) Return ChildTaConfiguration objects based on current ModelCriteria
 *
 * @method     ChildTaConfiguration[]|Collection findByTaConfigId(int|array<int> $ta_config_id) Return ChildTaConfiguration objects filtered by the ta_config_id column
 * @psalm-method Collection&\Traversable<ChildTaConfiguration> findByTaConfigId(int|array<int> $ta_config_id) Return ChildTaConfiguration objects filtered by the ta_config_id column
 * @method     ChildTaConfiguration[]|Collection findByFromKm(int|array<int> $from_km) Return ChildTaConfiguration objects filtered by the from_km column
 * @psalm-method Collection&\Traversable<ChildTaConfiguration> findByFromKm(int|array<int> $from_km) Return ChildTaConfiguration objects filtered by the from_km column
 * @method     ChildTaConfiguration[]|Collection findByToKm(int|array<int> $to_km) Return ChildTaConfiguration objects filtered by the to_km column
 * @psalm-method Collection&\Traversable<ChildTaConfiguration> findByToKm(int|array<int> $to_km) Return ChildTaConfiguration objects filtered by the to_km column
 * @method     ChildTaConfiguration[]|Collection findByPolicyKey(string|array<string> $policy_key) Return ChildTaConfiguration objects filtered by the policy_key column
 * @psalm-method Collection&\Traversable<ChildTaConfiguration> findByPolicyKey(string|array<string> $policy_key) Return ChildTaConfiguration objects filtered by the policy_key column
 * @method     ChildTaConfiguration[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildTaConfiguration objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildTaConfiguration> findByCompanyId(int|array<int> $company_id) Return ChildTaConfiguration objects filtered by the company_id column
 * @method     ChildTaConfiguration[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildTaConfiguration objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildTaConfiguration> findByCreatedAt(string|array<string> $created_at) Return ChildTaConfiguration objects filtered by the created_at column
 * @method     ChildTaConfiguration[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildTaConfiguration objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildTaConfiguration> findByUpdatedAt(string|array<string> $updated_at) Return ChildTaConfiguration objects filtered by the updated_at column
 *
 * @method     ChildTaConfiguration[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildTaConfiguration> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class TaConfigurationQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\TaConfigurationQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\TaConfiguration', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildTaConfigurationQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildTaConfigurationQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildTaConfigurationQuery) {
            return $criteria;
        }
        $query = new ChildTaConfigurationQuery();
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
     * @return ChildTaConfiguration|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(TaConfigurationTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = TaConfigurationTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildTaConfiguration A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT ta_config_id, from_km, to_km, policy_key, company_id, created_at, updated_at FROM ta_configuration WHERE ta_config_id = :p0';
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
            /** @var ChildTaConfiguration $obj */
            $obj = new ChildTaConfiguration();
            $obj->hydrate($row);
            TaConfigurationTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildTaConfiguration|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(TaConfigurationTableMap::COL_TA_CONFIG_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(TaConfigurationTableMap::COL_TA_CONFIG_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the ta_config_id column
     *
     * Example usage:
     * <code>
     * $query->filterByTaConfigId(1234); // WHERE ta_config_id = 1234
     * $query->filterByTaConfigId(array(12, 34)); // WHERE ta_config_id IN (12, 34)
     * $query->filterByTaConfigId(array('min' => 12)); // WHERE ta_config_id > 12
     * </code>
     *
     * @param mixed $taConfigId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTaConfigId($taConfigId = null, ?string $comparison = null)
    {
        if (is_array($taConfigId)) {
            $useMinMax = false;
            if (isset($taConfigId['min'])) {
                $this->addUsingAlias(TaConfigurationTableMap::COL_TA_CONFIG_ID, $taConfigId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($taConfigId['max'])) {
                $this->addUsingAlias(TaConfigurationTableMap::COL_TA_CONFIG_ID, $taConfigId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TaConfigurationTableMap::COL_TA_CONFIG_ID, $taConfigId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the from_km column
     *
     * Example usage:
     * <code>
     * $query->filterByFromKm(1234); // WHERE from_km = 1234
     * $query->filterByFromKm(array(12, 34)); // WHERE from_km IN (12, 34)
     * $query->filterByFromKm(array('min' => 12)); // WHERE from_km > 12
     * </code>
     *
     * @param mixed $fromKm The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFromKm($fromKm = null, ?string $comparison = null)
    {
        if (is_array($fromKm)) {
            $useMinMax = false;
            if (isset($fromKm['min'])) {
                $this->addUsingAlias(TaConfigurationTableMap::COL_FROM_KM, $fromKm['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fromKm['max'])) {
                $this->addUsingAlias(TaConfigurationTableMap::COL_FROM_KM, $fromKm['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TaConfigurationTableMap::COL_FROM_KM, $fromKm, $comparison);

        return $this;
    }

    /**
     * Filter the query on the to_km column
     *
     * Example usage:
     * <code>
     * $query->filterByToKm(1234); // WHERE to_km = 1234
     * $query->filterByToKm(array(12, 34)); // WHERE to_km IN (12, 34)
     * $query->filterByToKm(array('min' => 12)); // WHERE to_km > 12
     * </code>
     *
     * @param mixed $toKm The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByToKm($toKm = null, ?string $comparison = null)
    {
        if (is_array($toKm)) {
            $useMinMax = false;
            if (isset($toKm['min'])) {
                $this->addUsingAlias(TaConfigurationTableMap::COL_TO_KM, $toKm['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($toKm['max'])) {
                $this->addUsingAlias(TaConfigurationTableMap::COL_TO_KM, $toKm['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TaConfigurationTableMap::COL_TO_KM, $toKm, $comparison);

        return $this;
    }

    /**
     * Filter the query on the policy_key column
     *
     * Example usage:
     * <code>
     * $query->filterByPolicyKey('fooValue');   // WHERE policy_key = 'fooValue'
     * $query->filterByPolicyKey('%fooValue%', Criteria::LIKE); // WHERE policy_key LIKE '%fooValue%'
     * $query->filterByPolicyKey(['foo', 'bar']); // WHERE policy_key IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $policyKey The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPolicyKey($policyKey = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($policyKey)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TaConfigurationTableMap::COL_POLICY_KEY, $policyKey, $comparison);

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
                $this->addUsingAlias(TaConfigurationTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(TaConfigurationTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TaConfigurationTableMap::COL_COMPANY_ID, $companyId, $comparison);

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
                $this->addUsingAlias(TaConfigurationTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(TaConfigurationTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TaConfigurationTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(TaConfigurationTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(TaConfigurationTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TaConfigurationTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

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
                ->addUsingAlias(TaConfigurationTableMap::COL_COMPANY_ID, $company->getCompanyId(), $comparison);
        } elseif ($company instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(TaConfigurationTableMap::COL_COMPANY_ID, $company->toKeyValue('PrimaryKey', 'CompanyId'), $comparison);

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
     * Exclude object from result
     *
     * @param ChildTaConfiguration $taConfiguration Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($taConfiguration = null)
    {
        if ($taConfiguration) {
            $this->addUsingAlias(TaConfigurationTableMap::COL_TA_CONFIG_ID, $taConfiguration->getTaConfigId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the ta_configuration table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(TaConfigurationTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            TaConfigurationTableMap::clearInstancePool();
            TaConfigurationTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(TaConfigurationTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(TaConfigurationTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            TaConfigurationTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            TaConfigurationTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
