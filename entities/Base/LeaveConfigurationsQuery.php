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
use entities\LeaveConfigurations as ChildLeaveConfigurations;
use entities\LeaveConfigurationsQuery as ChildLeaveConfigurationsQuery;
use entities\Map\LeaveConfigurationsTableMap;

/**
 * Base class that represents a query for the `leave_configurations` table.
 *
 * @method     ChildLeaveConfigurationsQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildLeaveConfigurationsQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildLeaveConfigurationsQuery orderByGradeId($order = Criteria::ASC) Order by the grade_id column
 * @method     ChildLeaveConfigurationsQuery orderByLeaveType($order = Criteria::ASC) Order by the leave_type column
 * @method     ChildLeaveConfigurationsQuery orderByPolicyYear($order = Criteria::ASC) Order by the policy_year column
 * @method     ChildLeaveConfigurationsQuery orderByLeavePoints($order = Criteria::ASC) Order by the leave_points column
 * @method     ChildLeaveConfigurationsQuery orderByIsActive($order = Criteria::ASC) Order by the is_active column
 * @method     ChildLeaveConfigurationsQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildLeaveConfigurationsQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildLeaveConfigurationsQuery orderByOrgunitids($order = Criteria::ASC) Order by the orgunitids column
 * @method     ChildLeaveConfigurationsQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildLeaveConfigurationsQuery orderByApplyDate($order = Criteria::ASC) Order by the apply_date column
 *
 * @method     ChildLeaveConfigurationsQuery groupById() Group by the id column
 * @method     ChildLeaveConfigurationsQuery groupByName() Group by the name column
 * @method     ChildLeaveConfigurationsQuery groupByGradeId() Group by the grade_id column
 * @method     ChildLeaveConfigurationsQuery groupByLeaveType() Group by the leave_type column
 * @method     ChildLeaveConfigurationsQuery groupByPolicyYear() Group by the policy_year column
 * @method     ChildLeaveConfigurationsQuery groupByLeavePoints() Group by the leave_points column
 * @method     ChildLeaveConfigurationsQuery groupByIsActive() Group by the is_active column
 * @method     ChildLeaveConfigurationsQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildLeaveConfigurationsQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildLeaveConfigurationsQuery groupByOrgunitids() Group by the orgunitids column
 * @method     ChildLeaveConfigurationsQuery groupByCompanyId() Group by the company_id column
 * @method     ChildLeaveConfigurationsQuery groupByApplyDate() Group by the apply_date column
 *
 * @method     ChildLeaveConfigurationsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildLeaveConfigurationsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildLeaveConfigurationsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildLeaveConfigurationsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildLeaveConfigurationsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildLeaveConfigurationsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildLeaveConfigurations|null findOne(?ConnectionInterface $con = null) Return the first ChildLeaveConfigurations matching the query
 * @method     ChildLeaveConfigurations findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildLeaveConfigurations matching the query, or a new ChildLeaveConfigurations object populated from the query conditions when no match is found
 *
 * @method     ChildLeaveConfigurations|null findOneById(int $id) Return the first ChildLeaveConfigurations filtered by the id column
 * @method     ChildLeaveConfigurations|null findOneByName(string $name) Return the first ChildLeaveConfigurations filtered by the name column
 * @method     ChildLeaveConfigurations|null findOneByGradeId(int $grade_id) Return the first ChildLeaveConfigurations filtered by the grade_id column
 * @method     ChildLeaveConfigurations|null findOneByLeaveType(string $leave_type) Return the first ChildLeaveConfigurations filtered by the leave_type column
 * @method     ChildLeaveConfigurations|null findOneByPolicyYear(int $policy_year) Return the first ChildLeaveConfigurations filtered by the policy_year column
 * @method     ChildLeaveConfigurations|null findOneByLeavePoints(string $leave_points) Return the first ChildLeaveConfigurations filtered by the leave_points column
 * @method     ChildLeaveConfigurations|null findOneByIsActive(boolean $is_active) Return the first ChildLeaveConfigurations filtered by the is_active column
 * @method     ChildLeaveConfigurations|null findOneByCreatedAt(string $created_at) Return the first ChildLeaveConfigurations filtered by the created_at column
 * @method     ChildLeaveConfigurations|null findOneByUpdatedAt(string $updated_at) Return the first ChildLeaveConfigurations filtered by the updated_at column
 * @method     ChildLeaveConfigurations|null findOneByOrgunitids(string $orgunitids) Return the first ChildLeaveConfigurations filtered by the orgunitids column
 * @method     ChildLeaveConfigurations|null findOneByCompanyId(int $company_id) Return the first ChildLeaveConfigurations filtered by the company_id column
 * @method     ChildLeaveConfigurations|null findOneByApplyDate(string $apply_date) Return the first ChildLeaveConfigurations filtered by the apply_date column
 *
 * @method     ChildLeaveConfigurations requirePk($key, ?ConnectionInterface $con = null) Return the ChildLeaveConfigurations by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLeaveConfigurations requireOne(?ConnectionInterface $con = null) Return the first ChildLeaveConfigurations matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildLeaveConfigurations requireOneById(int $id) Return the first ChildLeaveConfigurations filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLeaveConfigurations requireOneByName(string $name) Return the first ChildLeaveConfigurations filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLeaveConfigurations requireOneByGradeId(int $grade_id) Return the first ChildLeaveConfigurations filtered by the grade_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLeaveConfigurations requireOneByLeaveType(string $leave_type) Return the first ChildLeaveConfigurations filtered by the leave_type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLeaveConfigurations requireOneByPolicyYear(int $policy_year) Return the first ChildLeaveConfigurations filtered by the policy_year column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLeaveConfigurations requireOneByLeavePoints(string $leave_points) Return the first ChildLeaveConfigurations filtered by the leave_points column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLeaveConfigurations requireOneByIsActive(boolean $is_active) Return the first ChildLeaveConfigurations filtered by the is_active column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLeaveConfigurations requireOneByCreatedAt(string $created_at) Return the first ChildLeaveConfigurations filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLeaveConfigurations requireOneByUpdatedAt(string $updated_at) Return the first ChildLeaveConfigurations filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLeaveConfigurations requireOneByOrgunitids(string $orgunitids) Return the first ChildLeaveConfigurations filtered by the orgunitids column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLeaveConfigurations requireOneByCompanyId(int $company_id) Return the first ChildLeaveConfigurations filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLeaveConfigurations requireOneByApplyDate(string $apply_date) Return the first ChildLeaveConfigurations filtered by the apply_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildLeaveConfigurations[]|Collection find(?ConnectionInterface $con = null) Return ChildLeaveConfigurations objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildLeaveConfigurations> find(?ConnectionInterface $con = null) Return ChildLeaveConfigurations objects based on current ModelCriteria
 *
 * @method     ChildLeaveConfigurations[]|Collection findById(int|array<int> $id) Return ChildLeaveConfigurations objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildLeaveConfigurations> findById(int|array<int> $id) Return ChildLeaveConfigurations objects filtered by the id column
 * @method     ChildLeaveConfigurations[]|Collection findByName(string|array<string> $name) Return ChildLeaveConfigurations objects filtered by the name column
 * @psalm-method Collection&\Traversable<ChildLeaveConfigurations> findByName(string|array<string> $name) Return ChildLeaveConfigurations objects filtered by the name column
 * @method     ChildLeaveConfigurations[]|Collection findByGradeId(int|array<int> $grade_id) Return ChildLeaveConfigurations objects filtered by the grade_id column
 * @psalm-method Collection&\Traversable<ChildLeaveConfigurations> findByGradeId(int|array<int> $grade_id) Return ChildLeaveConfigurations objects filtered by the grade_id column
 * @method     ChildLeaveConfigurations[]|Collection findByLeaveType(string|array<string> $leave_type) Return ChildLeaveConfigurations objects filtered by the leave_type column
 * @psalm-method Collection&\Traversable<ChildLeaveConfigurations> findByLeaveType(string|array<string> $leave_type) Return ChildLeaveConfigurations objects filtered by the leave_type column
 * @method     ChildLeaveConfigurations[]|Collection findByPolicyYear(int|array<int> $policy_year) Return ChildLeaveConfigurations objects filtered by the policy_year column
 * @psalm-method Collection&\Traversable<ChildLeaveConfigurations> findByPolicyYear(int|array<int> $policy_year) Return ChildLeaveConfigurations objects filtered by the policy_year column
 * @method     ChildLeaveConfigurations[]|Collection findByLeavePoints(string|array<string> $leave_points) Return ChildLeaveConfigurations objects filtered by the leave_points column
 * @psalm-method Collection&\Traversable<ChildLeaveConfigurations> findByLeavePoints(string|array<string> $leave_points) Return ChildLeaveConfigurations objects filtered by the leave_points column
 * @method     ChildLeaveConfigurations[]|Collection findByIsActive(boolean|array<boolean> $is_active) Return ChildLeaveConfigurations objects filtered by the is_active column
 * @psalm-method Collection&\Traversable<ChildLeaveConfigurations> findByIsActive(boolean|array<boolean> $is_active) Return ChildLeaveConfigurations objects filtered by the is_active column
 * @method     ChildLeaveConfigurations[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildLeaveConfigurations objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildLeaveConfigurations> findByCreatedAt(string|array<string> $created_at) Return ChildLeaveConfigurations objects filtered by the created_at column
 * @method     ChildLeaveConfigurations[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildLeaveConfigurations objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildLeaveConfigurations> findByUpdatedAt(string|array<string> $updated_at) Return ChildLeaveConfigurations objects filtered by the updated_at column
 * @method     ChildLeaveConfigurations[]|Collection findByOrgunitids(string|array<string> $orgunitids) Return ChildLeaveConfigurations objects filtered by the orgunitids column
 * @psalm-method Collection&\Traversable<ChildLeaveConfigurations> findByOrgunitids(string|array<string> $orgunitids) Return ChildLeaveConfigurations objects filtered by the orgunitids column
 * @method     ChildLeaveConfigurations[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildLeaveConfigurations objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildLeaveConfigurations> findByCompanyId(int|array<int> $company_id) Return ChildLeaveConfigurations objects filtered by the company_id column
 * @method     ChildLeaveConfigurations[]|Collection findByApplyDate(string|array<string> $apply_date) Return ChildLeaveConfigurations objects filtered by the apply_date column
 * @psalm-method Collection&\Traversable<ChildLeaveConfigurations> findByApplyDate(string|array<string> $apply_date) Return ChildLeaveConfigurations objects filtered by the apply_date column
 *
 * @method     ChildLeaveConfigurations[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildLeaveConfigurations> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class LeaveConfigurationsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\LeaveConfigurationsQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\LeaveConfigurations', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildLeaveConfigurationsQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildLeaveConfigurationsQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildLeaveConfigurationsQuery) {
            return $criteria;
        }
        $query = new ChildLeaveConfigurationsQuery();
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
     * @return ChildLeaveConfigurations|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(LeaveConfigurationsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = LeaveConfigurationsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildLeaveConfigurations A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, name, grade_id, leave_type, policy_year, leave_points, is_active, created_at, updated_at, orgunitids, company_id, apply_date FROM leave_configurations WHERE id = :p0';
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
            /** @var ChildLeaveConfigurations $obj */
            $obj = new ChildLeaveConfigurations();
            $obj->hydrate($row);
            LeaveConfigurationsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildLeaveConfigurations|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(LeaveConfigurationsTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(LeaveConfigurationsTableMap::COL_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterById($id = null, ?string $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(LeaveConfigurationsTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(LeaveConfigurationsTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(LeaveConfigurationsTableMap::COL_ID, $id, $comparison);

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

        $this->addUsingAlias(LeaveConfigurationsTableMap::COL_NAME, $name, $comparison);

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
                $this->addUsingAlias(LeaveConfigurationsTableMap::COL_GRADE_ID, $gradeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($gradeId['max'])) {
                $this->addUsingAlias(LeaveConfigurationsTableMap::COL_GRADE_ID, $gradeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(LeaveConfigurationsTableMap::COL_GRADE_ID, $gradeId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the leave_type column
     *
     * Example usage:
     * <code>
     * $query->filterByLeaveType('fooValue');   // WHERE leave_type = 'fooValue'
     * $query->filterByLeaveType('%fooValue%', Criteria::LIKE); // WHERE leave_type LIKE '%fooValue%'
     * $query->filterByLeaveType(['foo', 'bar']); // WHERE leave_type IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $leaveType The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLeaveType($leaveType = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($leaveType)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(LeaveConfigurationsTableMap::COL_LEAVE_TYPE, $leaveType, $comparison);

        return $this;
    }

    /**
     * Filter the query on the policy_year column
     *
     * Example usage:
     * <code>
     * $query->filterByPolicyYear(1234); // WHERE policy_year = 1234
     * $query->filterByPolicyYear(array(12, 34)); // WHERE policy_year IN (12, 34)
     * $query->filterByPolicyYear(array('min' => 12)); // WHERE policy_year > 12
     * </code>
     *
     * @param mixed $policyYear The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPolicyYear($policyYear = null, ?string $comparison = null)
    {
        if (is_array($policyYear)) {
            $useMinMax = false;
            if (isset($policyYear['min'])) {
                $this->addUsingAlias(LeaveConfigurationsTableMap::COL_POLICY_YEAR, $policyYear['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($policyYear['max'])) {
                $this->addUsingAlias(LeaveConfigurationsTableMap::COL_POLICY_YEAR, $policyYear['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(LeaveConfigurationsTableMap::COL_POLICY_YEAR, $policyYear, $comparison);

        return $this;
    }

    /**
     * Filter the query on the leave_points column
     *
     * Example usage:
     * <code>
     * $query->filterByLeavePoints(1234); // WHERE leave_points = 1234
     * $query->filterByLeavePoints(array(12, 34)); // WHERE leave_points IN (12, 34)
     * $query->filterByLeavePoints(array('min' => 12)); // WHERE leave_points > 12
     * </code>
     *
     * @param mixed $leavePoints The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLeavePoints($leavePoints = null, ?string $comparison = null)
    {
        if (is_array($leavePoints)) {
            $useMinMax = false;
            if (isset($leavePoints['min'])) {
                $this->addUsingAlias(LeaveConfigurationsTableMap::COL_LEAVE_POINTS, $leavePoints['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($leavePoints['max'])) {
                $this->addUsingAlias(LeaveConfigurationsTableMap::COL_LEAVE_POINTS, $leavePoints['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(LeaveConfigurationsTableMap::COL_LEAVE_POINTS, $leavePoints, $comparison);

        return $this;
    }

    /**
     * Filter the query on the is_active column
     *
     * Example usage:
     * <code>
     * $query->filterByIsActive(true); // WHERE is_active = true
     * $query->filterByIsActive('yes'); // WHERE is_active = true
     * </code>
     *
     * @param bool|string $isActive The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIsActive($isActive = null, ?string $comparison = null)
    {
        if (is_string($isActive)) {
            $isActive = in_array(strtolower($isActive), array('false', 'off', '-', 'no', 'n', '0', ''), true) ? false : true;
        }

        $this->addUsingAlias(LeaveConfigurationsTableMap::COL_IS_ACTIVE, $isActive, $comparison);

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
                $this->addUsingAlias(LeaveConfigurationsTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(LeaveConfigurationsTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(LeaveConfigurationsTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(LeaveConfigurationsTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(LeaveConfigurationsTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(LeaveConfigurationsTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the orgunitids column
     *
     * Example usage:
     * <code>
     * $query->filterByOrgunitids('fooValue');   // WHERE orgunitids = 'fooValue'
     * $query->filterByOrgunitids('%fooValue%', Criteria::LIKE); // WHERE orgunitids LIKE '%fooValue%'
     * $query->filterByOrgunitids(['foo', 'bar']); // WHERE orgunitids IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $orgunitids The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrgunitids($orgunitids = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($orgunitids)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(LeaveConfigurationsTableMap::COL_ORGUNITIDS, $orgunitids, $comparison);

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
                $this->addUsingAlias(LeaveConfigurationsTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(LeaveConfigurationsTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(LeaveConfigurationsTableMap::COL_COMPANY_ID, $companyId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the apply_date column
     *
     * Example usage:
     * <code>
     * $query->filterByApplyDate('2011-03-14'); // WHERE apply_date = '2011-03-14'
     * $query->filterByApplyDate('now'); // WHERE apply_date = '2011-03-14'
     * $query->filterByApplyDate(array('max' => 'yesterday')); // WHERE apply_date > '2011-03-13'
     * </code>
     *
     * @param mixed $applyDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByApplyDate($applyDate = null, ?string $comparison = null)
    {
        if (is_array($applyDate)) {
            $useMinMax = false;
            if (isset($applyDate['min'])) {
                $this->addUsingAlias(LeaveConfigurationsTableMap::COL_APPLY_DATE, $applyDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($applyDate['max'])) {
                $this->addUsingAlias(LeaveConfigurationsTableMap::COL_APPLY_DATE, $applyDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(LeaveConfigurationsTableMap::COL_APPLY_DATE, $applyDate, $comparison);

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildLeaveConfigurations $leaveConfigurations Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($leaveConfigurations = null)
    {
        if ($leaveConfigurations) {
            $this->addUsingAlias(LeaveConfigurationsTableMap::COL_ID, $leaveConfigurations->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the leave_configurations table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(LeaveConfigurationsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            LeaveConfigurationsTableMap::clearInstancePool();
            LeaveConfigurationsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(LeaveConfigurationsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(LeaveConfigurationsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            LeaveConfigurationsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            LeaveConfigurationsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
