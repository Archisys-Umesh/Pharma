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
use entities\GradePolicy as ChildGradePolicy;
use entities\GradePolicyQuery as ChildGradePolicyQuery;
use entities\Map\GradePolicyTableMap;

/**
 * Base class that represents a query for the `grade_policy` table.
 *
 * @method     ChildGradePolicyQuery orderByGpId($order = Criteria::ASC) Order by the gp_id column
 * @method     ChildGradePolicyQuery orderByGradeid($order = Criteria::ASC) Order by the gradeid column
 * @method     ChildGradePolicyQuery orderByPolicyId($order = Criteria::ASC) Order by the policy_id column
 * @method     ChildGradePolicyQuery orderByEndDate($order = Criteria::ASC) Order by the end_date column
 * @method     ChildGradePolicyQuery orderByStartDate($order = Criteria::ASC) Order by the start_date column
 *
 * @method     ChildGradePolicyQuery groupByGpId() Group by the gp_id column
 * @method     ChildGradePolicyQuery groupByGradeid() Group by the gradeid column
 * @method     ChildGradePolicyQuery groupByPolicyId() Group by the policy_id column
 * @method     ChildGradePolicyQuery groupByEndDate() Group by the end_date column
 * @method     ChildGradePolicyQuery groupByStartDate() Group by the start_date column
 *
 * @method     ChildGradePolicyQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildGradePolicyQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildGradePolicyQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildGradePolicyQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildGradePolicyQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildGradePolicyQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildGradePolicyQuery leftJoinGradeMaster($relationAlias = null) Adds a LEFT JOIN clause to the query using the GradeMaster relation
 * @method     ChildGradePolicyQuery rightJoinGradeMaster($relationAlias = null) Adds a RIGHT JOIN clause to the query using the GradeMaster relation
 * @method     ChildGradePolicyQuery innerJoinGradeMaster($relationAlias = null) Adds a INNER JOIN clause to the query using the GradeMaster relation
 *
 * @method     ChildGradePolicyQuery joinWithGradeMaster($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the GradeMaster relation
 *
 * @method     ChildGradePolicyQuery leftJoinWithGradeMaster() Adds a LEFT JOIN clause and with to the query using the GradeMaster relation
 * @method     ChildGradePolicyQuery rightJoinWithGradeMaster() Adds a RIGHT JOIN clause and with to the query using the GradeMaster relation
 * @method     ChildGradePolicyQuery innerJoinWithGradeMaster() Adds a INNER JOIN clause and with to the query using the GradeMaster relation
 *
 * @method     ChildGradePolicyQuery leftJoinPolicyMaster($relationAlias = null) Adds a LEFT JOIN clause to the query using the PolicyMaster relation
 * @method     ChildGradePolicyQuery rightJoinPolicyMaster($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PolicyMaster relation
 * @method     ChildGradePolicyQuery innerJoinPolicyMaster($relationAlias = null) Adds a INNER JOIN clause to the query using the PolicyMaster relation
 *
 * @method     ChildGradePolicyQuery joinWithPolicyMaster($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PolicyMaster relation
 *
 * @method     ChildGradePolicyQuery leftJoinWithPolicyMaster() Adds a LEFT JOIN clause and with to the query using the PolicyMaster relation
 * @method     ChildGradePolicyQuery rightJoinWithPolicyMaster() Adds a RIGHT JOIN clause and with to the query using the PolicyMaster relation
 * @method     ChildGradePolicyQuery innerJoinWithPolicyMaster() Adds a INNER JOIN clause and with to the query using the PolicyMaster relation
 *
 * @method     \entities\GradeMasterQuery|\entities\PolicyMasterQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildGradePolicy|null findOne(?ConnectionInterface $con = null) Return the first ChildGradePolicy matching the query
 * @method     ChildGradePolicy findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildGradePolicy matching the query, or a new ChildGradePolicy object populated from the query conditions when no match is found
 *
 * @method     ChildGradePolicy|null findOneByGpId(int $gp_id) Return the first ChildGradePolicy filtered by the gp_id column
 * @method     ChildGradePolicy|null findOneByGradeid(int $gradeid) Return the first ChildGradePolicy filtered by the gradeid column
 * @method     ChildGradePolicy|null findOneByPolicyId(int $policy_id) Return the first ChildGradePolicy filtered by the policy_id column
 * @method     ChildGradePolicy|null findOneByEndDate(string $end_date) Return the first ChildGradePolicy filtered by the end_date column
 * @method     ChildGradePolicy|null findOneByStartDate(string $start_date) Return the first ChildGradePolicy filtered by the start_date column
 *
 * @method     ChildGradePolicy requirePk($key, ?ConnectionInterface $con = null) Return the ChildGradePolicy by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGradePolicy requireOne(?ConnectionInterface $con = null) Return the first ChildGradePolicy matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildGradePolicy requireOneByGpId(int $gp_id) Return the first ChildGradePolicy filtered by the gp_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGradePolicy requireOneByGradeid(int $gradeid) Return the first ChildGradePolicy filtered by the gradeid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGradePolicy requireOneByPolicyId(int $policy_id) Return the first ChildGradePolicy filtered by the policy_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGradePolicy requireOneByEndDate(string $end_date) Return the first ChildGradePolicy filtered by the end_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGradePolicy requireOneByStartDate(string $start_date) Return the first ChildGradePolicy filtered by the start_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildGradePolicy[]|Collection find(?ConnectionInterface $con = null) Return ChildGradePolicy objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildGradePolicy> find(?ConnectionInterface $con = null) Return ChildGradePolicy objects based on current ModelCriteria
 *
 * @method     ChildGradePolicy[]|Collection findByGpId(int|array<int> $gp_id) Return ChildGradePolicy objects filtered by the gp_id column
 * @psalm-method Collection&\Traversable<ChildGradePolicy> findByGpId(int|array<int> $gp_id) Return ChildGradePolicy objects filtered by the gp_id column
 * @method     ChildGradePolicy[]|Collection findByGradeid(int|array<int> $gradeid) Return ChildGradePolicy objects filtered by the gradeid column
 * @psalm-method Collection&\Traversable<ChildGradePolicy> findByGradeid(int|array<int> $gradeid) Return ChildGradePolicy objects filtered by the gradeid column
 * @method     ChildGradePolicy[]|Collection findByPolicyId(int|array<int> $policy_id) Return ChildGradePolicy objects filtered by the policy_id column
 * @psalm-method Collection&\Traversable<ChildGradePolicy> findByPolicyId(int|array<int> $policy_id) Return ChildGradePolicy objects filtered by the policy_id column
 * @method     ChildGradePolicy[]|Collection findByEndDate(string|array<string> $end_date) Return ChildGradePolicy objects filtered by the end_date column
 * @psalm-method Collection&\Traversable<ChildGradePolicy> findByEndDate(string|array<string> $end_date) Return ChildGradePolicy objects filtered by the end_date column
 * @method     ChildGradePolicy[]|Collection findByStartDate(string|array<string> $start_date) Return ChildGradePolicy objects filtered by the start_date column
 * @psalm-method Collection&\Traversable<ChildGradePolicy> findByStartDate(string|array<string> $start_date) Return ChildGradePolicy objects filtered by the start_date column
 *
 * @method     ChildGradePolicy[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildGradePolicy> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class GradePolicyQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\GradePolicyQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\GradePolicy', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildGradePolicyQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildGradePolicyQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildGradePolicyQuery) {
            return $criteria;
        }
        $query = new ChildGradePolicyQuery();
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
     * @return ChildGradePolicy|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(GradePolicyTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = GradePolicyTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildGradePolicy A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT gp_id, gradeid, policy_id, end_date, start_date FROM grade_policy WHERE gp_id = :p0';
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
            /** @var ChildGradePolicy $obj */
            $obj = new ChildGradePolicy();
            $obj->hydrate($row);
            GradePolicyTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildGradePolicy|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(GradePolicyTableMap::COL_GP_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(GradePolicyTableMap::COL_GP_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the gp_id column
     *
     * Example usage:
     * <code>
     * $query->filterByGpId(1234); // WHERE gp_id = 1234
     * $query->filterByGpId(array(12, 34)); // WHERE gp_id IN (12, 34)
     * $query->filterByGpId(array('min' => 12)); // WHERE gp_id > 12
     * </code>
     *
     * @param mixed $gpId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByGpId($gpId = null, ?string $comparison = null)
    {
        if (is_array($gpId)) {
            $useMinMax = false;
            if (isset($gpId['min'])) {
                $this->addUsingAlias(GradePolicyTableMap::COL_GP_ID, $gpId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($gpId['max'])) {
                $this->addUsingAlias(GradePolicyTableMap::COL_GP_ID, $gpId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(GradePolicyTableMap::COL_GP_ID, $gpId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the gradeid column
     *
     * Example usage:
     * <code>
     * $query->filterByGradeid(1234); // WHERE gradeid = 1234
     * $query->filterByGradeid(array(12, 34)); // WHERE gradeid IN (12, 34)
     * $query->filterByGradeid(array('min' => 12)); // WHERE gradeid > 12
     * </code>
     *
     * @see       filterByGradeMaster()
     *
     * @param mixed $gradeid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByGradeid($gradeid = null, ?string $comparison = null)
    {
        if (is_array($gradeid)) {
            $useMinMax = false;
            if (isset($gradeid['min'])) {
                $this->addUsingAlias(GradePolicyTableMap::COL_GRADEID, $gradeid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($gradeid['max'])) {
                $this->addUsingAlias(GradePolicyTableMap::COL_GRADEID, $gradeid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(GradePolicyTableMap::COL_GRADEID, $gradeid, $comparison);

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
                $this->addUsingAlias(GradePolicyTableMap::COL_POLICY_ID, $policyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($policyId['max'])) {
                $this->addUsingAlias(GradePolicyTableMap::COL_POLICY_ID, $policyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(GradePolicyTableMap::COL_POLICY_ID, $policyId, $comparison);

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
                $this->addUsingAlias(GradePolicyTableMap::COL_END_DATE, $endDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($endDate['max'])) {
                $this->addUsingAlias(GradePolicyTableMap::COL_END_DATE, $endDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(GradePolicyTableMap::COL_END_DATE, $endDate, $comparison);

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
                $this->addUsingAlias(GradePolicyTableMap::COL_START_DATE, $startDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($startDate['max'])) {
                $this->addUsingAlias(GradePolicyTableMap::COL_START_DATE, $startDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(GradePolicyTableMap::COL_START_DATE, $startDate, $comparison);

        return $this;
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
                ->addUsingAlias(GradePolicyTableMap::COL_GRADEID, $gradeMaster->getGradeid(), $comparison);
        } elseif ($gradeMaster instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(GradePolicyTableMap::COL_GRADEID, $gradeMaster->toKeyValue('PrimaryKey', 'Gradeid'), $comparison);

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
    public function joinGradeMaster(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
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
    public function useGradeMasterQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
        ?string $joinType = Criteria::INNER_JOIN
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
                ->addUsingAlias(GradePolicyTableMap::COL_POLICY_ID, $policyMaster->getPolicyId(), $comparison);
        } elseif ($policyMaster instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(GradePolicyTableMap::COL_POLICY_ID, $policyMaster->toKeyValue('PrimaryKey', 'PolicyId'), $comparison);

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
     * @param ChildGradePolicy $gradePolicy Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($gradePolicy = null)
    {
        if ($gradePolicy) {
            $this->addUsingAlias(GradePolicyTableMap::COL_GP_ID, $gradePolicy->getGpId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the grade_policy table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(GradePolicyTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            GradePolicyTableMap::clearInstancePool();
            GradePolicyTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(GradePolicyTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(GradePolicyTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            GradePolicyTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            GradePolicyTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
