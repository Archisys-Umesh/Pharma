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
use entities\PolicyRows as ChildPolicyRows;
use entities\PolicyRowsQuery as ChildPolicyRowsQuery;
use entities\Map\PolicyRowsTableMap;

/**
 * Base class that represents a query for the `policy_rows` table.
 *
 * @method     ChildPolicyRowsQuery orderByPrId($order = Criteria::ASC) Order by the pr_id column
 * @method     ChildPolicyRowsQuery orderByPolicyId($order = Criteria::ASC) Order by the policy_id column
 * @method     ChildPolicyRowsQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildPolicyRowsQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildPolicyRowsQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildPolicyRowsQuery orderByPolicykey($order = Criteria::ASC) Order by the policykey column
 * @method     ChildPolicyRowsQuery orderByLimit1($order = Criteria::ASC) Order by the limit1 column
 * @method     ChildPolicyRowsQuery orderByLimit2($order = Criteria::ASC) Order by the limit2 column
 * @method     ChildPolicyRowsQuery orderByNocheck($order = Criteria::ASC) Order by the nocheck column
 * @method     ChildPolicyRowsQuery orderByIsReadonly($order = Criteria::ASC) Order by the is_readonly column
 *
 * @method     ChildPolicyRowsQuery groupByPrId() Group by the pr_id column
 * @method     ChildPolicyRowsQuery groupByPolicyId() Group by the policy_id column
 * @method     ChildPolicyRowsQuery groupByCompanyId() Group by the company_id column
 * @method     ChildPolicyRowsQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildPolicyRowsQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildPolicyRowsQuery groupByPolicykey() Group by the policykey column
 * @method     ChildPolicyRowsQuery groupByLimit1() Group by the limit1 column
 * @method     ChildPolicyRowsQuery groupByLimit2() Group by the limit2 column
 * @method     ChildPolicyRowsQuery groupByNocheck() Group by the nocheck column
 * @method     ChildPolicyRowsQuery groupByIsReadonly() Group by the is_readonly column
 *
 * @method     ChildPolicyRowsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPolicyRowsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPolicyRowsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPolicyRowsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildPolicyRowsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildPolicyRowsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildPolicyRowsQuery leftJoinPolicyMaster($relationAlias = null) Adds a LEFT JOIN clause to the query using the PolicyMaster relation
 * @method     ChildPolicyRowsQuery rightJoinPolicyMaster($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PolicyMaster relation
 * @method     ChildPolicyRowsQuery innerJoinPolicyMaster($relationAlias = null) Adds a INNER JOIN clause to the query using the PolicyMaster relation
 *
 * @method     ChildPolicyRowsQuery joinWithPolicyMaster($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PolicyMaster relation
 *
 * @method     ChildPolicyRowsQuery leftJoinWithPolicyMaster() Adds a LEFT JOIN clause and with to the query using the PolicyMaster relation
 * @method     ChildPolicyRowsQuery rightJoinWithPolicyMaster() Adds a RIGHT JOIN clause and with to the query using the PolicyMaster relation
 * @method     ChildPolicyRowsQuery innerJoinWithPolicyMaster() Adds a INNER JOIN clause and with to the query using the PolicyMaster relation
 *
 * @method     \entities\PolicyMasterQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildPolicyRows|null findOne(?ConnectionInterface $con = null) Return the first ChildPolicyRows matching the query
 * @method     ChildPolicyRows findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildPolicyRows matching the query, or a new ChildPolicyRows object populated from the query conditions when no match is found
 *
 * @method     ChildPolicyRows|null findOneByPrId(int $pr_id) Return the first ChildPolicyRows filtered by the pr_id column
 * @method     ChildPolicyRows|null findOneByPolicyId(int $policy_id) Return the first ChildPolicyRows filtered by the policy_id column
 * @method     ChildPolicyRows|null findOneByCompanyId(int $company_id) Return the first ChildPolicyRows filtered by the company_id column
 * @method     ChildPolicyRows|null findOneByCreatedAt(string $created_at) Return the first ChildPolicyRows filtered by the created_at column
 * @method     ChildPolicyRows|null findOneByUpdatedAt(string $updated_at) Return the first ChildPolicyRows filtered by the updated_at column
 * @method     ChildPolicyRows|null findOneByPolicykey(string $policykey) Return the first ChildPolicyRows filtered by the policykey column
 * @method     ChildPolicyRows|null findOneByLimit1(string $limit1) Return the first ChildPolicyRows filtered by the limit1 column
 * @method     ChildPolicyRows|null findOneByLimit2(string $limit2) Return the first ChildPolicyRows filtered by the limit2 column
 * @method     ChildPolicyRows|null findOneByNocheck(boolean $nocheck) Return the first ChildPolicyRows filtered by the nocheck column
 * @method     ChildPolicyRows|null findOneByIsReadonly(boolean $is_readonly) Return the first ChildPolicyRows filtered by the is_readonly column
 *
 * @method     ChildPolicyRows requirePk($key, ?ConnectionInterface $con = null) Return the ChildPolicyRows by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPolicyRows requireOne(?ConnectionInterface $con = null) Return the first ChildPolicyRows matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPolicyRows requireOneByPrId(int $pr_id) Return the first ChildPolicyRows filtered by the pr_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPolicyRows requireOneByPolicyId(int $policy_id) Return the first ChildPolicyRows filtered by the policy_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPolicyRows requireOneByCompanyId(int $company_id) Return the first ChildPolicyRows filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPolicyRows requireOneByCreatedAt(string $created_at) Return the first ChildPolicyRows filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPolicyRows requireOneByUpdatedAt(string $updated_at) Return the first ChildPolicyRows filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPolicyRows requireOneByPolicykey(string $policykey) Return the first ChildPolicyRows filtered by the policykey column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPolicyRows requireOneByLimit1(string $limit1) Return the first ChildPolicyRows filtered by the limit1 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPolicyRows requireOneByLimit2(string $limit2) Return the first ChildPolicyRows filtered by the limit2 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPolicyRows requireOneByNocheck(boolean $nocheck) Return the first ChildPolicyRows filtered by the nocheck column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPolicyRows requireOneByIsReadonly(boolean $is_readonly) Return the first ChildPolicyRows filtered by the is_readonly column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPolicyRows[]|Collection find(?ConnectionInterface $con = null) Return ChildPolicyRows objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildPolicyRows> find(?ConnectionInterface $con = null) Return ChildPolicyRows objects based on current ModelCriteria
 *
 * @method     ChildPolicyRows[]|Collection findByPrId(int|array<int> $pr_id) Return ChildPolicyRows objects filtered by the pr_id column
 * @psalm-method Collection&\Traversable<ChildPolicyRows> findByPrId(int|array<int> $pr_id) Return ChildPolicyRows objects filtered by the pr_id column
 * @method     ChildPolicyRows[]|Collection findByPolicyId(int|array<int> $policy_id) Return ChildPolicyRows objects filtered by the policy_id column
 * @psalm-method Collection&\Traversable<ChildPolicyRows> findByPolicyId(int|array<int> $policy_id) Return ChildPolicyRows objects filtered by the policy_id column
 * @method     ChildPolicyRows[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildPolicyRows objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildPolicyRows> findByCompanyId(int|array<int> $company_id) Return ChildPolicyRows objects filtered by the company_id column
 * @method     ChildPolicyRows[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildPolicyRows objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildPolicyRows> findByCreatedAt(string|array<string> $created_at) Return ChildPolicyRows objects filtered by the created_at column
 * @method     ChildPolicyRows[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildPolicyRows objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildPolicyRows> findByUpdatedAt(string|array<string> $updated_at) Return ChildPolicyRows objects filtered by the updated_at column
 * @method     ChildPolicyRows[]|Collection findByPolicykey(string|array<string> $policykey) Return ChildPolicyRows objects filtered by the policykey column
 * @psalm-method Collection&\Traversable<ChildPolicyRows> findByPolicykey(string|array<string> $policykey) Return ChildPolicyRows objects filtered by the policykey column
 * @method     ChildPolicyRows[]|Collection findByLimit1(string|array<string> $limit1) Return ChildPolicyRows objects filtered by the limit1 column
 * @psalm-method Collection&\Traversable<ChildPolicyRows> findByLimit1(string|array<string> $limit1) Return ChildPolicyRows objects filtered by the limit1 column
 * @method     ChildPolicyRows[]|Collection findByLimit2(string|array<string> $limit2) Return ChildPolicyRows objects filtered by the limit2 column
 * @psalm-method Collection&\Traversable<ChildPolicyRows> findByLimit2(string|array<string> $limit2) Return ChildPolicyRows objects filtered by the limit2 column
 * @method     ChildPolicyRows[]|Collection findByNocheck(boolean|array<boolean> $nocheck) Return ChildPolicyRows objects filtered by the nocheck column
 * @psalm-method Collection&\Traversable<ChildPolicyRows> findByNocheck(boolean|array<boolean> $nocheck) Return ChildPolicyRows objects filtered by the nocheck column
 * @method     ChildPolicyRows[]|Collection findByIsReadonly(boolean|array<boolean> $is_readonly) Return ChildPolicyRows objects filtered by the is_readonly column
 * @psalm-method Collection&\Traversable<ChildPolicyRows> findByIsReadonly(boolean|array<boolean> $is_readonly) Return ChildPolicyRows objects filtered by the is_readonly column
 *
 * @method     ChildPolicyRows[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildPolicyRows> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class PolicyRowsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\PolicyRowsQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\PolicyRows', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPolicyRowsQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPolicyRowsQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildPolicyRowsQuery) {
            return $criteria;
        }
        $query = new ChildPolicyRowsQuery();
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
     * @return ChildPolicyRows|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PolicyRowsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = PolicyRowsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildPolicyRows A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT pr_id, policy_id, company_id, created_at, updated_at, policykey, limit1, limit2, nocheck, is_readonly FROM policy_rows WHERE pr_id = :p0';
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
            /** @var ChildPolicyRows $obj */
            $obj = new ChildPolicyRows();
            $obj->hydrate($row);
            PolicyRowsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildPolicyRows|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(PolicyRowsTableMap::COL_PR_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(PolicyRowsTableMap::COL_PR_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the pr_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPrId(1234); // WHERE pr_id = 1234
     * $query->filterByPrId(array(12, 34)); // WHERE pr_id IN (12, 34)
     * $query->filterByPrId(array('min' => 12)); // WHERE pr_id > 12
     * </code>
     *
     * @param mixed $prId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrId($prId = null, ?string $comparison = null)
    {
        if (is_array($prId)) {
            $useMinMax = false;
            if (isset($prId['min'])) {
                $this->addUsingAlias(PolicyRowsTableMap::COL_PR_ID, $prId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($prId['max'])) {
                $this->addUsingAlias(PolicyRowsTableMap::COL_PR_ID, $prId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PolicyRowsTableMap::COL_PR_ID, $prId, $comparison);

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
     * @see       filterByPolicyMaster()
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
                $this->addUsingAlias(PolicyRowsTableMap::COL_POLICY_ID, $policyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($policyId['max'])) {
                $this->addUsingAlias(PolicyRowsTableMap::COL_POLICY_ID, $policyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PolicyRowsTableMap::COL_POLICY_ID, $policyId, $comparison);

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
                $this->addUsingAlias(PolicyRowsTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(PolicyRowsTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PolicyRowsTableMap::COL_COMPANY_ID, $companyId, $comparison);

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
                $this->addUsingAlias(PolicyRowsTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(PolicyRowsTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PolicyRowsTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(PolicyRowsTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(PolicyRowsTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PolicyRowsTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the policykey column
     *
     * Example usage:
     * <code>
     * $query->filterByPolicykey('fooValue');   // WHERE policykey = 'fooValue'
     * $query->filterByPolicykey('%fooValue%', Criteria::LIKE); // WHERE policykey LIKE '%fooValue%'
     * $query->filterByPolicykey(['foo', 'bar']); // WHERE policykey IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $policykey The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPolicykey($policykey = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($policykey)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PolicyRowsTableMap::COL_POLICYKEY, $policykey, $comparison);

        return $this;
    }

    /**
     * Filter the query on the limit1 column
     *
     * Example usage:
     * <code>
     * $query->filterByLimit1(1234); // WHERE limit1 = 1234
     * $query->filterByLimit1(array(12, 34)); // WHERE limit1 IN (12, 34)
     * $query->filterByLimit1(array('min' => 12)); // WHERE limit1 > 12
     * </code>
     *
     * @param mixed $limit1 The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLimit1($limit1 = null, ?string $comparison = null)
    {
        if (is_array($limit1)) {
            $useMinMax = false;
            if (isset($limit1['min'])) {
                $this->addUsingAlias(PolicyRowsTableMap::COL_LIMIT1, $limit1['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($limit1['max'])) {
                $this->addUsingAlias(PolicyRowsTableMap::COL_LIMIT1, $limit1['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PolicyRowsTableMap::COL_LIMIT1, $limit1, $comparison);

        return $this;
    }

    /**
     * Filter the query on the limit2 column
     *
     * Example usage:
     * <code>
     * $query->filterByLimit2(1234); // WHERE limit2 = 1234
     * $query->filterByLimit2(array(12, 34)); // WHERE limit2 IN (12, 34)
     * $query->filterByLimit2(array('min' => 12)); // WHERE limit2 > 12
     * </code>
     *
     * @param mixed $limit2 The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLimit2($limit2 = null, ?string $comparison = null)
    {
        if (is_array($limit2)) {
            $useMinMax = false;
            if (isset($limit2['min'])) {
                $this->addUsingAlias(PolicyRowsTableMap::COL_LIMIT2, $limit2['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($limit2['max'])) {
                $this->addUsingAlias(PolicyRowsTableMap::COL_LIMIT2, $limit2['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PolicyRowsTableMap::COL_LIMIT2, $limit2, $comparison);

        return $this;
    }

    /**
     * Filter the query on the nocheck column
     *
     * Example usage:
     * <code>
     * $query->filterByNocheck(true); // WHERE nocheck = true
     * $query->filterByNocheck('yes'); // WHERE nocheck = true
     * </code>
     *
     * @param bool|string $nocheck The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByNocheck($nocheck = null, ?string $comparison = null)
    {
        if (is_string($nocheck)) {
            $nocheck = in_array(strtolower($nocheck), array('false', 'off', '-', 'no', 'n', '0', ''), true) ? false : true;
        }

        $this->addUsingAlias(PolicyRowsTableMap::COL_NOCHECK, $nocheck, $comparison);

        return $this;
    }

    /**
     * Filter the query on the is_readonly column
     *
     * Example usage:
     * <code>
     * $query->filterByIsReadonly(true); // WHERE is_readonly = true
     * $query->filterByIsReadonly('yes'); // WHERE is_readonly = true
     * </code>
     *
     * @param bool|string $isReadonly The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIsReadonly($isReadonly = null, ?string $comparison = null)
    {
        if (is_string($isReadonly)) {
            $isReadonly = in_array(strtolower($isReadonly), array('false', 'off', '-', 'no', 'n', '0', ''), true) ? false : true;
        }

        $this->addUsingAlias(PolicyRowsTableMap::COL_IS_READONLY, $isReadonly, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \entities\PolicyMaster object
     *
     * @param \entities\PolicyMaster|ObjectCollection $policyMaster The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPolicyMaster($policyMaster, ?string $comparison = null)
    {
        if ($policyMaster instanceof \entities\PolicyMaster) {
            return $this
                ->addUsingAlias(PolicyRowsTableMap::COL_POLICY_ID, $policyMaster->getPolicyId(), $comparison);
        } elseif ($policyMaster instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(PolicyRowsTableMap::COL_POLICY_ID, $policyMaster->toKeyValue('PrimaryKey', 'PolicyId'), $comparison);

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
    public function joinPolicyMaster(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
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
    public function usePolicyMasterQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
        ?string $joinType = Criteria::INNER_JOIN
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
     * @param ChildPolicyRows $policyRows Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($policyRows = null)
    {
        if ($policyRows) {
            $this->addUsingAlias(PolicyRowsTableMap::COL_PR_ID, $policyRows->getPrId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the policy_rows table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PolicyRowsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PolicyRowsTableMap::clearInstancePool();
            PolicyRowsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(PolicyRowsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PolicyRowsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            PolicyRowsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            PolicyRowsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
