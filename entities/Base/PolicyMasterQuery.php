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
use entities\PolicyMaster as ChildPolicyMaster;
use entities\PolicyMasterQuery as ChildPolicyMasterQuery;
use entities\Map\PolicyMasterTableMap;

/**
 * Base class that represents a query for the `policy_master` table.
 *
 * @method     ChildPolicyMasterQuery orderByPolicyId($order = Criteria::ASC) Order by the policy_id column
 * @method     ChildPolicyMasterQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildPolicyMasterQuery orderByPolicyName($order = Criteria::ASC) Order by the policy_name column
 * @method     ChildPolicyMasterQuery orderByPolicyCode($order = Criteria::ASC) Order by the policy_code column
 * @method     ChildPolicyMasterQuery orderByOrgUnitId($order = Criteria::ASC) Order by the org_unit_id column
 * @method     ChildPolicyMasterQuery orderByCurrencyId($order = Criteria::ASC) Order by the currency_id column
 * @method     ChildPolicyMasterQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildPolicyMasterQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildPolicyMasterQuery orderByStartDate($order = Criteria::ASC) Order by the start_date column
 * @method     ChildPolicyMasterQuery orderByEndDate($order = Criteria::ASC) Order by the end_date column
 *
 * @method     ChildPolicyMasterQuery groupByPolicyId() Group by the policy_id column
 * @method     ChildPolicyMasterQuery groupByCompanyId() Group by the company_id column
 * @method     ChildPolicyMasterQuery groupByPolicyName() Group by the policy_name column
 * @method     ChildPolicyMasterQuery groupByPolicyCode() Group by the policy_code column
 * @method     ChildPolicyMasterQuery groupByOrgUnitId() Group by the org_unit_id column
 * @method     ChildPolicyMasterQuery groupByCurrencyId() Group by the currency_id column
 * @method     ChildPolicyMasterQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildPolicyMasterQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildPolicyMasterQuery groupByStartDate() Group by the start_date column
 * @method     ChildPolicyMasterQuery groupByEndDate() Group by the end_date column
 *
 * @method     ChildPolicyMasterQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPolicyMasterQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPolicyMasterQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPolicyMasterQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildPolicyMasterQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildPolicyMasterQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildPolicyMasterQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildPolicyMasterQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildPolicyMasterQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildPolicyMasterQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildPolicyMasterQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildPolicyMasterQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildPolicyMasterQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     ChildPolicyMasterQuery leftJoinCurrencies($relationAlias = null) Adds a LEFT JOIN clause to the query using the Currencies relation
 * @method     ChildPolicyMasterQuery rightJoinCurrencies($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Currencies relation
 * @method     ChildPolicyMasterQuery innerJoinCurrencies($relationAlias = null) Adds a INNER JOIN clause to the query using the Currencies relation
 *
 * @method     ChildPolicyMasterQuery joinWithCurrencies($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Currencies relation
 *
 * @method     ChildPolicyMasterQuery leftJoinWithCurrencies() Adds a LEFT JOIN clause and with to the query using the Currencies relation
 * @method     ChildPolicyMasterQuery rightJoinWithCurrencies() Adds a RIGHT JOIN clause and with to the query using the Currencies relation
 * @method     ChildPolicyMasterQuery innerJoinWithCurrencies() Adds a INNER JOIN clause and with to the query using the Currencies relation
 *
 * @method     ChildPolicyMasterQuery leftJoinOrgUnit($relationAlias = null) Adds a LEFT JOIN clause to the query using the OrgUnit relation
 * @method     ChildPolicyMasterQuery rightJoinOrgUnit($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OrgUnit relation
 * @method     ChildPolicyMasterQuery innerJoinOrgUnit($relationAlias = null) Adds a INNER JOIN clause to the query using the OrgUnit relation
 *
 * @method     ChildPolicyMasterQuery joinWithOrgUnit($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OrgUnit relation
 *
 * @method     ChildPolicyMasterQuery leftJoinWithOrgUnit() Adds a LEFT JOIN clause and with to the query using the OrgUnit relation
 * @method     ChildPolicyMasterQuery rightJoinWithOrgUnit() Adds a RIGHT JOIN clause and with to the query using the OrgUnit relation
 * @method     ChildPolicyMasterQuery innerJoinWithOrgUnit() Adds a INNER JOIN clause and with to the query using the OrgUnit relation
 *
 * @method     ChildPolicyMasterQuery leftJoinGradePolicy($relationAlias = null) Adds a LEFT JOIN clause to the query using the GradePolicy relation
 * @method     ChildPolicyMasterQuery rightJoinGradePolicy($relationAlias = null) Adds a RIGHT JOIN clause to the query using the GradePolicy relation
 * @method     ChildPolicyMasterQuery innerJoinGradePolicy($relationAlias = null) Adds a INNER JOIN clause to the query using the GradePolicy relation
 *
 * @method     ChildPolicyMasterQuery joinWithGradePolicy($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the GradePolicy relation
 *
 * @method     ChildPolicyMasterQuery leftJoinWithGradePolicy() Adds a LEFT JOIN clause and with to the query using the GradePolicy relation
 * @method     ChildPolicyMasterQuery rightJoinWithGradePolicy() Adds a RIGHT JOIN clause and with to the query using the GradePolicy relation
 * @method     ChildPolicyMasterQuery innerJoinWithGradePolicy() Adds a INNER JOIN clause and with to the query using the GradePolicy relation
 *
 * @method     ChildPolicyMasterQuery leftJoinPolicyRows($relationAlias = null) Adds a LEFT JOIN clause to the query using the PolicyRows relation
 * @method     ChildPolicyMasterQuery rightJoinPolicyRows($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PolicyRows relation
 * @method     ChildPolicyMasterQuery innerJoinPolicyRows($relationAlias = null) Adds a INNER JOIN clause to the query using the PolicyRows relation
 *
 * @method     ChildPolicyMasterQuery joinWithPolicyRows($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PolicyRows relation
 *
 * @method     ChildPolicyMasterQuery leftJoinWithPolicyRows() Adds a LEFT JOIN clause and with to the query using the PolicyRows relation
 * @method     ChildPolicyMasterQuery rightJoinWithPolicyRows() Adds a RIGHT JOIN clause and with to the query using the PolicyRows relation
 * @method     ChildPolicyMasterQuery innerJoinWithPolicyRows() Adds a INNER JOIN clause and with to the query using the PolicyRows relation
 *
 * @method     \entities\CompanyQuery|\entities\CurrenciesQuery|\entities\OrgUnitQuery|\entities\GradePolicyQuery|\entities\PolicyRowsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildPolicyMaster|null findOne(?ConnectionInterface $con = null) Return the first ChildPolicyMaster matching the query
 * @method     ChildPolicyMaster findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildPolicyMaster matching the query, or a new ChildPolicyMaster object populated from the query conditions when no match is found
 *
 * @method     ChildPolicyMaster|null findOneByPolicyId(int $policy_id) Return the first ChildPolicyMaster filtered by the policy_id column
 * @method     ChildPolicyMaster|null findOneByCompanyId(int $company_id) Return the first ChildPolicyMaster filtered by the company_id column
 * @method     ChildPolicyMaster|null findOneByPolicyName(string $policy_name) Return the first ChildPolicyMaster filtered by the policy_name column
 * @method     ChildPolicyMaster|null findOneByPolicyCode(string $policy_code) Return the first ChildPolicyMaster filtered by the policy_code column
 * @method     ChildPolicyMaster|null findOneByOrgUnitId(int $org_unit_id) Return the first ChildPolicyMaster filtered by the org_unit_id column
 * @method     ChildPolicyMaster|null findOneByCurrencyId(int $currency_id) Return the first ChildPolicyMaster filtered by the currency_id column
 * @method     ChildPolicyMaster|null findOneByCreatedAt(string $created_at) Return the first ChildPolicyMaster filtered by the created_at column
 * @method     ChildPolicyMaster|null findOneByUpdatedAt(string $updated_at) Return the first ChildPolicyMaster filtered by the updated_at column
 * @method     ChildPolicyMaster|null findOneByStartDate(string $start_date) Return the first ChildPolicyMaster filtered by the start_date column
 * @method     ChildPolicyMaster|null findOneByEndDate(string $end_date) Return the first ChildPolicyMaster filtered by the end_date column
 *
 * @method     ChildPolicyMaster requirePk($key, ?ConnectionInterface $con = null) Return the ChildPolicyMaster by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPolicyMaster requireOne(?ConnectionInterface $con = null) Return the first ChildPolicyMaster matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPolicyMaster requireOneByPolicyId(int $policy_id) Return the first ChildPolicyMaster filtered by the policy_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPolicyMaster requireOneByCompanyId(int $company_id) Return the first ChildPolicyMaster filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPolicyMaster requireOneByPolicyName(string $policy_name) Return the first ChildPolicyMaster filtered by the policy_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPolicyMaster requireOneByPolicyCode(string $policy_code) Return the first ChildPolicyMaster filtered by the policy_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPolicyMaster requireOneByOrgUnitId(int $org_unit_id) Return the first ChildPolicyMaster filtered by the org_unit_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPolicyMaster requireOneByCurrencyId(int $currency_id) Return the first ChildPolicyMaster filtered by the currency_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPolicyMaster requireOneByCreatedAt(string $created_at) Return the first ChildPolicyMaster filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPolicyMaster requireOneByUpdatedAt(string $updated_at) Return the first ChildPolicyMaster filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPolicyMaster requireOneByStartDate(string $start_date) Return the first ChildPolicyMaster filtered by the start_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPolicyMaster requireOneByEndDate(string $end_date) Return the first ChildPolicyMaster filtered by the end_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPolicyMaster[]|Collection find(?ConnectionInterface $con = null) Return ChildPolicyMaster objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildPolicyMaster> find(?ConnectionInterface $con = null) Return ChildPolicyMaster objects based on current ModelCriteria
 *
 * @method     ChildPolicyMaster[]|Collection findByPolicyId(int|array<int> $policy_id) Return ChildPolicyMaster objects filtered by the policy_id column
 * @psalm-method Collection&\Traversable<ChildPolicyMaster> findByPolicyId(int|array<int> $policy_id) Return ChildPolicyMaster objects filtered by the policy_id column
 * @method     ChildPolicyMaster[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildPolicyMaster objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildPolicyMaster> findByCompanyId(int|array<int> $company_id) Return ChildPolicyMaster objects filtered by the company_id column
 * @method     ChildPolicyMaster[]|Collection findByPolicyName(string|array<string> $policy_name) Return ChildPolicyMaster objects filtered by the policy_name column
 * @psalm-method Collection&\Traversable<ChildPolicyMaster> findByPolicyName(string|array<string> $policy_name) Return ChildPolicyMaster objects filtered by the policy_name column
 * @method     ChildPolicyMaster[]|Collection findByPolicyCode(string|array<string> $policy_code) Return ChildPolicyMaster objects filtered by the policy_code column
 * @psalm-method Collection&\Traversable<ChildPolicyMaster> findByPolicyCode(string|array<string> $policy_code) Return ChildPolicyMaster objects filtered by the policy_code column
 * @method     ChildPolicyMaster[]|Collection findByOrgUnitId(int|array<int> $org_unit_id) Return ChildPolicyMaster objects filtered by the org_unit_id column
 * @psalm-method Collection&\Traversable<ChildPolicyMaster> findByOrgUnitId(int|array<int> $org_unit_id) Return ChildPolicyMaster objects filtered by the org_unit_id column
 * @method     ChildPolicyMaster[]|Collection findByCurrencyId(int|array<int> $currency_id) Return ChildPolicyMaster objects filtered by the currency_id column
 * @psalm-method Collection&\Traversable<ChildPolicyMaster> findByCurrencyId(int|array<int> $currency_id) Return ChildPolicyMaster objects filtered by the currency_id column
 * @method     ChildPolicyMaster[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildPolicyMaster objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildPolicyMaster> findByCreatedAt(string|array<string> $created_at) Return ChildPolicyMaster objects filtered by the created_at column
 * @method     ChildPolicyMaster[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildPolicyMaster objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildPolicyMaster> findByUpdatedAt(string|array<string> $updated_at) Return ChildPolicyMaster objects filtered by the updated_at column
 * @method     ChildPolicyMaster[]|Collection findByStartDate(string|array<string> $start_date) Return ChildPolicyMaster objects filtered by the start_date column
 * @psalm-method Collection&\Traversable<ChildPolicyMaster> findByStartDate(string|array<string> $start_date) Return ChildPolicyMaster objects filtered by the start_date column
 * @method     ChildPolicyMaster[]|Collection findByEndDate(string|array<string> $end_date) Return ChildPolicyMaster objects filtered by the end_date column
 * @psalm-method Collection&\Traversable<ChildPolicyMaster> findByEndDate(string|array<string> $end_date) Return ChildPolicyMaster objects filtered by the end_date column
 *
 * @method     ChildPolicyMaster[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildPolicyMaster> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class PolicyMasterQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\PolicyMasterQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\PolicyMaster', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPolicyMasterQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPolicyMasterQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildPolicyMasterQuery) {
            return $criteria;
        }
        $query = new ChildPolicyMasterQuery();
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
     * @return ChildPolicyMaster|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PolicyMasterTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = PolicyMasterTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildPolicyMaster A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT policy_id, company_id, policy_name, policy_code, org_unit_id, currency_id, created_at, updated_at, start_date, end_date FROM policy_master WHERE policy_id = :p0';
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
            /** @var ChildPolicyMaster $obj */
            $obj = new ChildPolicyMaster();
            $obj->hydrate($row);
            PolicyMasterTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildPolicyMaster|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(PolicyMasterTableMap::COL_POLICY_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(PolicyMasterTableMap::COL_POLICY_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the policy_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPolicyId(1234); // WHERE policy_id = 1234
     * $query->filterByPolicyId(array(12, 34)); // WHERE policy_id IN (12, 34)
     * $query->filterByPolicyId(array('min' => 12)); // WHERE policy_id > 12
     * </code>
     *
     * @param mixed $policyId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPolicyId($policyId = null, ?string $comparison = null)
    {
        if (is_array($policyId)) {
            $useMinMax = false;
            if (isset($policyId['min'])) {
                $this->addUsingAlias(PolicyMasterTableMap::COL_POLICY_ID, $policyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($policyId['max'])) {
                $this->addUsingAlias(PolicyMasterTableMap::COL_POLICY_ID, $policyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PolicyMasterTableMap::COL_POLICY_ID, $policyId, $comparison);

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
                $this->addUsingAlias(PolicyMasterTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(PolicyMasterTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PolicyMasterTableMap::COL_COMPANY_ID, $companyId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the policy_name column
     *
     * Example usage:
     * <code>
     * $query->filterByPolicyName('fooValue');   // WHERE policy_name = 'fooValue'
     * $query->filterByPolicyName('%fooValue%', Criteria::LIKE); // WHERE policy_name LIKE '%fooValue%'
     * $query->filterByPolicyName(['foo', 'bar']); // WHERE policy_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $policyName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPolicyName($policyName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($policyName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PolicyMasterTableMap::COL_POLICY_NAME, $policyName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the policy_code column
     *
     * Example usage:
     * <code>
     * $query->filterByPolicyCode('fooValue');   // WHERE policy_code = 'fooValue'
     * $query->filterByPolicyCode('%fooValue%', Criteria::LIKE); // WHERE policy_code LIKE '%fooValue%'
     * $query->filterByPolicyCode(['foo', 'bar']); // WHERE policy_code IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $policyCode The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPolicyCode($policyCode = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($policyCode)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PolicyMasterTableMap::COL_POLICY_CODE, $policyCode, $comparison);

        return $this;
    }

    /**
     * Filter the query on the org_unit_id column
     *
     * Example usage:
     * <code>
     * $query->filterByOrgUnitId(1234); // WHERE org_unit_id = 1234
     * $query->filterByOrgUnitId(array(12, 34)); // WHERE org_unit_id IN (12, 34)
     * $query->filterByOrgUnitId(array('min' => 12)); // WHERE org_unit_id > 12
     * </code>
     *
     * @see       filterByOrgUnit()
     *
     * @param mixed $orgUnitId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrgUnitId($orgUnitId = null, ?string $comparison = null)
    {
        if (is_array($orgUnitId)) {
            $useMinMax = false;
            if (isset($orgUnitId['min'])) {
                $this->addUsingAlias(PolicyMasterTableMap::COL_ORG_UNIT_ID, $orgUnitId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($orgUnitId['max'])) {
                $this->addUsingAlias(PolicyMasterTableMap::COL_ORG_UNIT_ID, $orgUnitId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PolicyMasterTableMap::COL_ORG_UNIT_ID, $orgUnitId, $comparison);

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
     * @see       filterByCurrencies()
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
                $this->addUsingAlias(PolicyMasterTableMap::COL_CURRENCY_ID, $currencyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($currencyId['max'])) {
                $this->addUsingAlias(PolicyMasterTableMap::COL_CURRENCY_ID, $currencyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PolicyMasterTableMap::COL_CURRENCY_ID, $currencyId, $comparison);

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
                $this->addUsingAlias(PolicyMasterTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(PolicyMasterTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PolicyMasterTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(PolicyMasterTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(PolicyMasterTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PolicyMasterTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the start_date column
     *
     * Example usage:
     * <code>
     * $query->filterByStartDate('2011-03-14'); // WHERE start_date = '2011-03-14'
     * $query->filterByStartDate('now'); // WHERE start_date = '2011-03-14'
     * $query->filterByStartDate(array('max' => 'yesterday')); // WHERE start_date > '2011-03-13'
     * </code>
     *
     * @param mixed $startDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStartDate($startDate = null, ?string $comparison = null)
    {
        if (is_array($startDate)) {
            $useMinMax = false;
            if (isset($startDate['min'])) {
                $this->addUsingAlias(PolicyMasterTableMap::COL_START_DATE, $startDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($startDate['max'])) {
                $this->addUsingAlias(PolicyMasterTableMap::COL_START_DATE, $startDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PolicyMasterTableMap::COL_START_DATE, $startDate, $comparison);

        return $this;
    }

    /**
     * Filter the query on the end_date column
     *
     * Example usage:
     * <code>
     * $query->filterByEndDate('2011-03-14'); // WHERE end_date = '2011-03-14'
     * $query->filterByEndDate('now'); // WHERE end_date = '2011-03-14'
     * $query->filterByEndDate(array('max' => 'yesterday')); // WHERE end_date > '2011-03-13'
     * </code>
     *
     * @param mixed $endDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEndDate($endDate = null, ?string $comparison = null)
    {
        if (is_array($endDate)) {
            $useMinMax = false;
            if (isset($endDate['min'])) {
                $this->addUsingAlias(PolicyMasterTableMap::COL_END_DATE, $endDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($endDate['max'])) {
                $this->addUsingAlias(PolicyMasterTableMap::COL_END_DATE, $endDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PolicyMasterTableMap::COL_END_DATE, $endDate, $comparison);

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
                ->addUsingAlias(PolicyMasterTableMap::COL_COMPANY_ID, $company->getCompanyId(), $comparison);
        } elseif ($company instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(PolicyMasterTableMap::COL_COMPANY_ID, $company->toKeyValue('PrimaryKey', 'CompanyId'), $comparison);

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
                ->addUsingAlias(PolicyMasterTableMap::COL_CURRENCY_ID, $currencies->getCurrencyId(), $comparison);
        } elseif ($currencies instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(PolicyMasterTableMap::COL_CURRENCY_ID, $currencies->toKeyValue('PrimaryKey', 'CurrencyId'), $comparison);

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
     * Filter the query by a related \entities\OrgUnit object
     *
     * @param \entities\OrgUnit|ObjectCollection $orgUnit The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrgUnit($orgUnit, ?string $comparison = null)
    {
        if ($orgUnit instanceof \entities\OrgUnit) {
            return $this
                ->addUsingAlias(PolicyMasterTableMap::COL_ORG_UNIT_ID, $orgUnit->getOrgunitid(), $comparison);
        } elseif ($orgUnit instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(PolicyMasterTableMap::COL_ORG_UNIT_ID, $orgUnit->toKeyValue('PrimaryKey', 'Orgunitid'), $comparison);

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
     * Filter the query by a related \entities\GradePolicy object
     *
     * @param \entities\GradePolicy|ObjectCollection $gradePolicy the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByGradePolicy($gradePolicy, ?string $comparison = null)
    {
        if ($gradePolicy instanceof \entities\GradePolicy) {
            $this
                ->addUsingAlias(PolicyMasterTableMap::COL_POLICY_ID, $gradePolicy->getPolicyId(), $comparison);

            return $this;
        } elseif ($gradePolicy instanceof ObjectCollection) {
            $this
                ->useGradePolicyQuery()
                ->filterByPrimaryKeys($gradePolicy->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByGradePolicy() only accepts arguments of type \entities\GradePolicy or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the GradePolicy relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinGradePolicy(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('GradePolicy');

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
            $this->addJoinObject($join, 'GradePolicy');
        }

        return $this;
    }

    /**
     * Use the GradePolicy relation GradePolicy object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\GradePolicyQuery A secondary query class using the current class as primary query
     */
    public function useGradePolicyQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinGradePolicy($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'GradePolicy', '\entities\GradePolicyQuery');
    }

    /**
     * Use the GradePolicy relation GradePolicy object
     *
     * @param callable(\entities\GradePolicyQuery):\entities\GradePolicyQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withGradePolicyQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useGradePolicyQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to GradePolicy table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\GradePolicyQuery The inner query object of the EXISTS statement
     */
    public function useGradePolicyExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\GradePolicyQuery */
        $q = $this->useExistsQuery('GradePolicy', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to GradePolicy table for a NOT EXISTS query.
     *
     * @see useGradePolicyExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\GradePolicyQuery The inner query object of the NOT EXISTS statement
     */
    public function useGradePolicyNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\GradePolicyQuery */
        $q = $this->useExistsQuery('GradePolicy', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to GradePolicy table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\GradePolicyQuery The inner query object of the IN statement
     */
    public function useInGradePolicyQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\GradePolicyQuery */
        $q = $this->useInQuery('GradePolicy', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to GradePolicy table for a NOT IN query.
     *
     * @see useGradePolicyInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\GradePolicyQuery The inner query object of the NOT IN statement
     */
    public function useNotInGradePolicyQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\GradePolicyQuery */
        $q = $this->useInQuery('GradePolicy', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\PolicyRows object
     *
     * @param \entities\PolicyRows|ObjectCollection $policyRows the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPolicyRows($policyRows, ?string $comparison = null)
    {
        if ($policyRows instanceof \entities\PolicyRows) {
            $this
                ->addUsingAlias(PolicyMasterTableMap::COL_POLICY_ID, $policyRows->getPolicyId(), $comparison);

            return $this;
        } elseif ($policyRows instanceof ObjectCollection) {
            $this
                ->usePolicyRowsQuery()
                ->filterByPrimaryKeys($policyRows->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByPolicyRows() only accepts arguments of type \entities\PolicyRows or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PolicyRows relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinPolicyRows(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PolicyRows');

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
            $this->addJoinObject($join, 'PolicyRows');
        }

        return $this;
    }

    /**
     * Use the PolicyRows relation PolicyRows object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\PolicyRowsQuery A secondary query class using the current class as primary query
     */
    public function usePolicyRowsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPolicyRows($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PolicyRows', '\entities\PolicyRowsQuery');
    }

    /**
     * Use the PolicyRows relation PolicyRows object
     *
     * @param callable(\entities\PolicyRowsQuery):\entities\PolicyRowsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withPolicyRowsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->usePolicyRowsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to PolicyRows table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\PolicyRowsQuery The inner query object of the EXISTS statement
     */
    public function usePolicyRowsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\PolicyRowsQuery */
        $q = $this->useExistsQuery('PolicyRows', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to PolicyRows table for a NOT EXISTS query.
     *
     * @see usePolicyRowsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\PolicyRowsQuery The inner query object of the NOT EXISTS statement
     */
    public function usePolicyRowsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\PolicyRowsQuery */
        $q = $this->useExistsQuery('PolicyRows', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to PolicyRows table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\PolicyRowsQuery The inner query object of the IN statement
     */
    public function useInPolicyRowsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\PolicyRowsQuery */
        $q = $this->useInQuery('PolicyRows', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to PolicyRows table for a NOT IN query.
     *
     * @see usePolicyRowsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\PolicyRowsQuery The inner query object of the NOT IN statement
     */
    public function useNotInPolicyRowsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\PolicyRowsQuery */
        $q = $this->useInQuery('PolicyRows', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildPolicyMaster $policyMaster Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($policyMaster = null)
    {
        if ($policyMaster) {
            $this->addUsingAlias(PolicyMasterTableMap::COL_POLICY_ID, $policyMaster->getPolicyId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the policy_master table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PolicyMasterTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PolicyMasterTableMap::clearInstancePool();
            PolicyMasterTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(PolicyMasterTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PolicyMasterTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            PolicyMasterTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            PolicyMasterTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
