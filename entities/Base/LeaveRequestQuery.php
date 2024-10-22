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
use entities\LeaveRequest as ChildLeaveRequest;
use entities\LeaveRequestQuery as ChildLeaveRequestQuery;
use entities\Map\LeaveRequestTableMap;

/**
 * Base class that represents a query for the `leave_request` table.
 *
 * @method     ChildLeaveRequestQuery orderByLeaveReqId($order = Criteria::ASC) Order by the leave_req_id column
 * @method     ChildLeaveRequestQuery orderByEmployeeId($order = Criteria::ASC) Order by the employee_id column
 * @method     ChildLeaveRequestQuery orderByLeaveType($order = Criteria::ASC) Order by the leave_type column
 * @method     ChildLeaveRequestQuery orderByLeaveFrom($order = Criteria::ASC) Order by the leave_from column
 * @method     ChildLeaveRequestQuery orderByLeaveTo($order = Criteria::ASC) Order by the leave_to column
 * @method     ChildLeaveRequestQuery orderByLeaveStatus($order = Criteria::ASC) Order by the leave_status column
 * @method     ChildLeaveRequestQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildLeaveRequestQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildLeaveRequestQuery orderByLeaveReason($order = Criteria::ASC) Order by the leave_reason column
 * @method     ChildLeaveRequestQuery orderByLeaveRejectRemark($order = Criteria::ASC) Order by the leave_reject_remark column
 * @method     ChildLeaveRequestQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildLeaveRequestQuery orderByLeaveDays($order = Criteria::ASC) Order by the leave_days column
 *
 * @method     ChildLeaveRequestQuery groupByLeaveReqId() Group by the leave_req_id column
 * @method     ChildLeaveRequestQuery groupByEmployeeId() Group by the employee_id column
 * @method     ChildLeaveRequestQuery groupByLeaveType() Group by the leave_type column
 * @method     ChildLeaveRequestQuery groupByLeaveFrom() Group by the leave_from column
 * @method     ChildLeaveRequestQuery groupByLeaveTo() Group by the leave_to column
 * @method     ChildLeaveRequestQuery groupByLeaveStatus() Group by the leave_status column
 * @method     ChildLeaveRequestQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildLeaveRequestQuery groupByCompanyId() Group by the company_id column
 * @method     ChildLeaveRequestQuery groupByLeaveReason() Group by the leave_reason column
 * @method     ChildLeaveRequestQuery groupByLeaveRejectRemark() Group by the leave_reject_remark column
 * @method     ChildLeaveRequestQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildLeaveRequestQuery groupByLeaveDays() Group by the leave_days column
 *
 * @method     ChildLeaveRequestQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildLeaveRequestQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildLeaveRequestQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildLeaveRequestQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildLeaveRequestQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildLeaveRequestQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildLeaveRequestQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildLeaveRequestQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildLeaveRequestQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildLeaveRequestQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildLeaveRequestQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildLeaveRequestQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildLeaveRequestQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     ChildLeaveRequestQuery leftJoinEmployee($relationAlias = null) Adds a LEFT JOIN clause to the query using the Employee relation
 * @method     ChildLeaveRequestQuery rightJoinEmployee($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Employee relation
 * @method     ChildLeaveRequestQuery innerJoinEmployee($relationAlias = null) Adds a INNER JOIN clause to the query using the Employee relation
 *
 * @method     ChildLeaveRequestQuery joinWithEmployee($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Employee relation
 *
 * @method     ChildLeaveRequestQuery leftJoinWithEmployee() Adds a LEFT JOIN clause and with to the query using the Employee relation
 * @method     ChildLeaveRequestQuery rightJoinWithEmployee() Adds a RIGHT JOIN clause and with to the query using the Employee relation
 * @method     ChildLeaveRequestQuery innerJoinWithEmployee() Adds a INNER JOIN clause and with to the query using the Employee relation
 *
 * @method     \entities\CompanyQuery|\entities\EmployeeQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildLeaveRequest|null findOne(?ConnectionInterface $con = null) Return the first ChildLeaveRequest matching the query
 * @method     ChildLeaveRequest findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildLeaveRequest matching the query, or a new ChildLeaveRequest object populated from the query conditions when no match is found
 *
 * @method     ChildLeaveRequest|null findOneByLeaveReqId(int $leave_req_id) Return the first ChildLeaveRequest filtered by the leave_req_id column
 * @method     ChildLeaveRequest|null findOneByEmployeeId(int $employee_id) Return the first ChildLeaveRequest filtered by the employee_id column
 * @method     ChildLeaveRequest|null findOneByLeaveType(string $leave_type) Return the first ChildLeaveRequest filtered by the leave_type column
 * @method     ChildLeaveRequest|null findOneByLeaveFrom(string $leave_from) Return the first ChildLeaveRequest filtered by the leave_from column
 * @method     ChildLeaveRequest|null findOneByLeaveTo(string $leave_to) Return the first ChildLeaveRequest filtered by the leave_to column
 * @method     ChildLeaveRequest|null findOneByLeaveStatus(int $leave_status) Return the first ChildLeaveRequest filtered by the leave_status column
 * @method     ChildLeaveRequest|null findOneByCreatedAt(string $created_at) Return the first ChildLeaveRequest filtered by the created_at column
 * @method     ChildLeaveRequest|null findOneByCompanyId(int $company_id) Return the first ChildLeaveRequest filtered by the company_id column
 * @method     ChildLeaveRequest|null findOneByLeaveReason(string $leave_reason) Return the first ChildLeaveRequest filtered by the leave_reason column
 * @method     ChildLeaveRequest|null findOneByLeaveRejectRemark(string $leave_reject_remark) Return the first ChildLeaveRequest filtered by the leave_reject_remark column
 * @method     ChildLeaveRequest|null findOneByUpdatedAt(string $updated_at) Return the first ChildLeaveRequest filtered by the updated_at column
 * @method     ChildLeaveRequest|null findOneByLeaveDays(int $leave_days) Return the first ChildLeaveRequest filtered by the leave_days column
 *
 * @method     ChildLeaveRequest requirePk($key, ?ConnectionInterface $con = null) Return the ChildLeaveRequest by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLeaveRequest requireOne(?ConnectionInterface $con = null) Return the first ChildLeaveRequest matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildLeaveRequest requireOneByLeaveReqId(int $leave_req_id) Return the first ChildLeaveRequest filtered by the leave_req_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLeaveRequest requireOneByEmployeeId(int $employee_id) Return the first ChildLeaveRequest filtered by the employee_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLeaveRequest requireOneByLeaveType(string $leave_type) Return the first ChildLeaveRequest filtered by the leave_type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLeaveRequest requireOneByLeaveFrom(string $leave_from) Return the first ChildLeaveRequest filtered by the leave_from column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLeaveRequest requireOneByLeaveTo(string $leave_to) Return the first ChildLeaveRequest filtered by the leave_to column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLeaveRequest requireOneByLeaveStatus(int $leave_status) Return the first ChildLeaveRequest filtered by the leave_status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLeaveRequest requireOneByCreatedAt(string $created_at) Return the first ChildLeaveRequest filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLeaveRequest requireOneByCompanyId(int $company_id) Return the first ChildLeaveRequest filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLeaveRequest requireOneByLeaveReason(string $leave_reason) Return the first ChildLeaveRequest filtered by the leave_reason column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLeaveRequest requireOneByLeaveRejectRemark(string $leave_reject_remark) Return the first ChildLeaveRequest filtered by the leave_reject_remark column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLeaveRequest requireOneByUpdatedAt(string $updated_at) Return the first ChildLeaveRequest filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLeaveRequest requireOneByLeaveDays(int $leave_days) Return the first ChildLeaveRequest filtered by the leave_days column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildLeaveRequest[]|Collection find(?ConnectionInterface $con = null) Return ChildLeaveRequest objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildLeaveRequest> find(?ConnectionInterface $con = null) Return ChildLeaveRequest objects based on current ModelCriteria
 *
 * @method     ChildLeaveRequest[]|Collection findByLeaveReqId(int|array<int> $leave_req_id) Return ChildLeaveRequest objects filtered by the leave_req_id column
 * @psalm-method Collection&\Traversable<ChildLeaveRequest> findByLeaveReqId(int|array<int> $leave_req_id) Return ChildLeaveRequest objects filtered by the leave_req_id column
 * @method     ChildLeaveRequest[]|Collection findByEmployeeId(int|array<int> $employee_id) Return ChildLeaveRequest objects filtered by the employee_id column
 * @psalm-method Collection&\Traversable<ChildLeaveRequest> findByEmployeeId(int|array<int> $employee_id) Return ChildLeaveRequest objects filtered by the employee_id column
 * @method     ChildLeaveRequest[]|Collection findByLeaveType(string|array<string> $leave_type) Return ChildLeaveRequest objects filtered by the leave_type column
 * @psalm-method Collection&\Traversable<ChildLeaveRequest> findByLeaveType(string|array<string> $leave_type) Return ChildLeaveRequest objects filtered by the leave_type column
 * @method     ChildLeaveRequest[]|Collection findByLeaveFrom(string|array<string> $leave_from) Return ChildLeaveRequest objects filtered by the leave_from column
 * @psalm-method Collection&\Traversable<ChildLeaveRequest> findByLeaveFrom(string|array<string> $leave_from) Return ChildLeaveRequest objects filtered by the leave_from column
 * @method     ChildLeaveRequest[]|Collection findByLeaveTo(string|array<string> $leave_to) Return ChildLeaveRequest objects filtered by the leave_to column
 * @psalm-method Collection&\Traversable<ChildLeaveRequest> findByLeaveTo(string|array<string> $leave_to) Return ChildLeaveRequest objects filtered by the leave_to column
 * @method     ChildLeaveRequest[]|Collection findByLeaveStatus(int|array<int> $leave_status) Return ChildLeaveRequest objects filtered by the leave_status column
 * @psalm-method Collection&\Traversable<ChildLeaveRequest> findByLeaveStatus(int|array<int> $leave_status) Return ChildLeaveRequest objects filtered by the leave_status column
 * @method     ChildLeaveRequest[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildLeaveRequest objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildLeaveRequest> findByCreatedAt(string|array<string> $created_at) Return ChildLeaveRequest objects filtered by the created_at column
 * @method     ChildLeaveRequest[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildLeaveRequest objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildLeaveRequest> findByCompanyId(int|array<int> $company_id) Return ChildLeaveRequest objects filtered by the company_id column
 * @method     ChildLeaveRequest[]|Collection findByLeaveReason(string|array<string> $leave_reason) Return ChildLeaveRequest objects filtered by the leave_reason column
 * @psalm-method Collection&\Traversable<ChildLeaveRequest> findByLeaveReason(string|array<string> $leave_reason) Return ChildLeaveRequest objects filtered by the leave_reason column
 * @method     ChildLeaveRequest[]|Collection findByLeaveRejectRemark(string|array<string> $leave_reject_remark) Return ChildLeaveRequest objects filtered by the leave_reject_remark column
 * @psalm-method Collection&\Traversable<ChildLeaveRequest> findByLeaveRejectRemark(string|array<string> $leave_reject_remark) Return ChildLeaveRequest objects filtered by the leave_reject_remark column
 * @method     ChildLeaveRequest[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildLeaveRequest objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildLeaveRequest> findByUpdatedAt(string|array<string> $updated_at) Return ChildLeaveRequest objects filtered by the updated_at column
 * @method     ChildLeaveRequest[]|Collection findByLeaveDays(int|array<int> $leave_days) Return ChildLeaveRequest objects filtered by the leave_days column
 * @psalm-method Collection&\Traversable<ChildLeaveRequest> findByLeaveDays(int|array<int> $leave_days) Return ChildLeaveRequest objects filtered by the leave_days column
 *
 * @method     ChildLeaveRequest[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildLeaveRequest> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class LeaveRequestQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\LeaveRequestQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\LeaveRequest', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildLeaveRequestQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildLeaveRequestQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildLeaveRequestQuery) {
            return $criteria;
        }
        $query = new ChildLeaveRequestQuery();
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
     * @return ChildLeaveRequest|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(LeaveRequestTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = LeaveRequestTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildLeaveRequest A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT leave_req_id, employee_id, leave_type, leave_from, leave_to, leave_status, created_at, company_id, leave_reason, leave_reject_remark, updated_at, leave_days FROM leave_request WHERE leave_req_id = :p0';
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
            /** @var ChildLeaveRequest $obj */
            $obj = new ChildLeaveRequest();
            $obj->hydrate($row);
            LeaveRequestTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildLeaveRequest|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(LeaveRequestTableMap::COL_LEAVE_REQ_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(LeaveRequestTableMap::COL_LEAVE_REQ_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the leave_req_id column
     *
     * Example usage:
     * <code>
     * $query->filterByLeaveReqId(1234); // WHERE leave_req_id = 1234
     * $query->filterByLeaveReqId(array(12, 34)); // WHERE leave_req_id IN (12, 34)
     * $query->filterByLeaveReqId(array('min' => 12)); // WHERE leave_req_id > 12
     * </code>
     *
     * @param mixed $leaveReqId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLeaveReqId($leaveReqId = null, ?string $comparison = null)
    {
        if (is_array($leaveReqId)) {
            $useMinMax = false;
            if (isset($leaveReqId['min'])) {
                $this->addUsingAlias(LeaveRequestTableMap::COL_LEAVE_REQ_ID, $leaveReqId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($leaveReqId['max'])) {
                $this->addUsingAlias(LeaveRequestTableMap::COL_LEAVE_REQ_ID, $leaveReqId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(LeaveRequestTableMap::COL_LEAVE_REQ_ID, $leaveReqId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the employee_id column
     *
     * Example usage:
     * <code>
     * $query->filterByEmployeeId(1234); // WHERE employee_id = 1234
     * $query->filterByEmployeeId(array(12, 34)); // WHERE employee_id IN (12, 34)
     * $query->filterByEmployeeId(array('min' => 12)); // WHERE employee_id > 12
     * </code>
     *
     * @see       filterByEmployee()
     *
     * @param mixed $employeeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmployeeId($employeeId = null, ?string $comparison = null)
    {
        if (is_array($employeeId)) {
            $useMinMax = false;
            if (isset($employeeId['min'])) {
                $this->addUsingAlias(LeaveRequestTableMap::COL_EMPLOYEE_ID, $employeeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($employeeId['max'])) {
                $this->addUsingAlias(LeaveRequestTableMap::COL_EMPLOYEE_ID, $employeeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(LeaveRequestTableMap::COL_EMPLOYEE_ID, $employeeId, $comparison);

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

        $this->addUsingAlias(LeaveRequestTableMap::COL_LEAVE_TYPE, $leaveType, $comparison);

        return $this;
    }

    /**
     * Filter the query on the leave_from column
     *
     * Example usage:
     * <code>
     * $query->filterByLeaveFrom('2011-03-14'); // WHERE leave_from = '2011-03-14'
     * $query->filterByLeaveFrom('now'); // WHERE leave_from = '2011-03-14'
     * $query->filterByLeaveFrom(array('max' => 'yesterday')); // WHERE leave_from > '2011-03-13'
     * </code>
     *
     * @param mixed $leaveFrom The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLeaveFrom($leaveFrom = null, ?string $comparison = null)
    {
        if (is_array($leaveFrom)) {
            $useMinMax = false;
            if (isset($leaveFrom['min'])) {
                $this->addUsingAlias(LeaveRequestTableMap::COL_LEAVE_FROM, $leaveFrom['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($leaveFrom['max'])) {
                $this->addUsingAlias(LeaveRequestTableMap::COL_LEAVE_FROM, $leaveFrom['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(LeaveRequestTableMap::COL_LEAVE_FROM, $leaveFrom, $comparison);

        return $this;
    }

    /**
     * Filter the query on the leave_to column
     *
     * Example usage:
     * <code>
     * $query->filterByLeaveTo('2011-03-14'); // WHERE leave_to = '2011-03-14'
     * $query->filterByLeaveTo('now'); // WHERE leave_to = '2011-03-14'
     * $query->filterByLeaveTo(array('max' => 'yesterday')); // WHERE leave_to > '2011-03-13'
     * </code>
     *
     * @param mixed $leaveTo The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLeaveTo($leaveTo = null, ?string $comparison = null)
    {
        if (is_array($leaveTo)) {
            $useMinMax = false;
            if (isset($leaveTo['min'])) {
                $this->addUsingAlias(LeaveRequestTableMap::COL_LEAVE_TO, $leaveTo['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($leaveTo['max'])) {
                $this->addUsingAlias(LeaveRequestTableMap::COL_LEAVE_TO, $leaveTo['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(LeaveRequestTableMap::COL_LEAVE_TO, $leaveTo, $comparison);

        return $this;
    }

    /**
     * Filter the query on the leave_status column
     *
     * Example usage:
     * <code>
     * $query->filterByLeaveStatus(1234); // WHERE leave_status = 1234
     * $query->filterByLeaveStatus(array(12, 34)); // WHERE leave_status IN (12, 34)
     * $query->filterByLeaveStatus(array('min' => 12)); // WHERE leave_status > 12
     * </code>
     *
     * @param mixed $leaveStatus The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLeaveStatus($leaveStatus = null, ?string $comparison = null)
    {
        if (is_array($leaveStatus)) {
            $useMinMax = false;
            if (isset($leaveStatus['min'])) {
                $this->addUsingAlias(LeaveRequestTableMap::COL_LEAVE_STATUS, $leaveStatus['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($leaveStatus['max'])) {
                $this->addUsingAlias(LeaveRequestTableMap::COL_LEAVE_STATUS, $leaveStatus['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(LeaveRequestTableMap::COL_LEAVE_STATUS, $leaveStatus, $comparison);

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
                $this->addUsingAlias(LeaveRequestTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(LeaveRequestTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(LeaveRequestTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(LeaveRequestTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(LeaveRequestTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(LeaveRequestTableMap::COL_COMPANY_ID, $companyId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the leave_reason column
     *
     * Example usage:
     * <code>
     * $query->filterByLeaveReason('fooValue');   // WHERE leave_reason = 'fooValue'
     * $query->filterByLeaveReason('%fooValue%', Criteria::LIKE); // WHERE leave_reason LIKE '%fooValue%'
     * $query->filterByLeaveReason(['foo', 'bar']); // WHERE leave_reason IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $leaveReason The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLeaveReason($leaveReason = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($leaveReason)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(LeaveRequestTableMap::COL_LEAVE_REASON, $leaveReason, $comparison);

        return $this;
    }

    /**
     * Filter the query on the leave_reject_remark column
     *
     * Example usage:
     * <code>
     * $query->filterByLeaveRejectRemark('fooValue');   // WHERE leave_reject_remark = 'fooValue'
     * $query->filterByLeaveRejectRemark('%fooValue%', Criteria::LIKE); // WHERE leave_reject_remark LIKE '%fooValue%'
     * $query->filterByLeaveRejectRemark(['foo', 'bar']); // WHERE leave_reject_remark IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $leaveRejectRemark The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLeaveRejectRemark($leaveRejectRemark = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($leaveRejectRemark)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(LeaveRequestTableMap::COL_LEAVE_REJECT_REMARK, $leaveRejectRemark, $comparison);

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
                $this->addUsingAlias(LeaveRequestTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(LeaveRequestTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(LeaveRequestTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the leave_days column
     *
     * Example usage:
     * <code>
     * $query->filterByLeaveDays(1234); // WHERE leave_days = 1234
     * $query->filterByLeaveDays(array(12, 34)); // WHERE leave_days IN (12, 34)
     * $query->filterByLeaveDays(array('min' => 12)); // WHERE leave_days > 12
     * </code>
     *
     * @param mixed $leaveDays The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLeaveDays($leaveDays = null, ?string $comparison = null)
    {
        if (is_array($leaveDays)) {
            $useMinMax = false;
            if (isset($leaveDays['min'])) {
                $this->addUsingAlias(LeaveRequestTableMap::COL_LEAVE_DAYS, $leaveDays['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($leaveDays['max'])) {
                $this->addUsingAlias(LeaveRequestTableMap::COL_LEAVE_DAYS, $leaveDays['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(LeaveRequestTableMap::COL_LEAVE_DAYS, $leaveDays, $comparison);

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
                ->addUsingAlias(LeaveRequestTableMap::COL_COMPANY_ID, $company->getCompanyId(), $comparison);
        } elseif ($company instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(LeaveRequestTableMap::COL_COMPANY_ID, $company->toKeyValue('PrimaryKey', 'CompanyId'), $comparison);

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
     * Filter the query by a related \entities\Employee object
     *
     * @param \entities\Employee|ObjectCollection $employee The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmployee($employee, ?string $comparison = null)
    {
        if ($employee instanceof \entities\Employee) {
            return $this
                ->addUsingAlias(LeaveRequestTableMap::COL_EMPLOYEE_ID, $employee->getEmployeeId(), $comparison);
        } elseif ($employee instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(LeaveRequestTableMap::COL_EMPLOYEE_ID, $employee->toKeyValue('PrimaryKey', 'EmployeeId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByEmployee() only accepts arguments of type \entities\Employee or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Employee relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinEmployee(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Employee');

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
            $this->addJoinObject($join, 'Employee');
        }

        return $this;
    }

    /**
     * Use the Employee relation Employee object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\EmployeeQuery A secondary query class using the current class as primary query
     */
    public function useEmployeeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinEmployee($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Employee', '\entities\EmployeeQuery');
    }

    /**
     * Use the Employee relation Employee object
     *
     * @param callable(\entities\EmployeeQuery):\entities\EmployeeQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withEmployeeQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useEmployeeQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Employee table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\EmployeeQuery The inner query object of the EXISTS statement
     */
    public function useEmployeeExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\EmployeeQuery */
        $q = $this->useExistsQuery('Employee', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Employee table for a NOT EXISTS query.
     *
     * @see useEmployeeExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\EmployeeQuery The inner query object of the NOT EXISTS statement
     */
    public function useEmployeeNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\EmployeeQuery */
        $q = $this->useExistsQuery('Employee', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Employee table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\EmployeeQuery The inner query object of the IN statement
     */
    public function useInEmployeeQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\EmployeeQuery */
        $q = $this->useInQuery('Employee', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Employee table for a NOT IN query.
     *
     * @see useEmployeeInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\EmployeeQuery The inner query object of the NOT IN statement
     */
    public function useNotInEmployeeQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\EmployeeQuery */
        $q = $this->useInQuery('Employee', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildLeaveRequest $leaveRequest Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($leaveRequest = null)
    {
        if ($leaveRequest) {
            $this->addUsingAlias(LeaveRequestTableMap::COL_LEAVE_REQ_ID, $leaveRequest->getLeaveReqId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the leave_request table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(LeaveRequestTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            LeaveRequestTableMap::clearInstancePool();
            LeaveRequestTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(LeaveRequestTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(LeaveRequestTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            LeaveRequestTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            LeaveRequestTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
