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
use entities\Leaves as ChildLeaves;
use entities\LeavesQuery as ChildLeavesQuery;
use entities\Map\LeavesTableMap;

/**
 * Base class that represents a query for the `leaves` table.
 *
 * @method     ChildLeavesQuery orderByLeaveId($order = Criteria::ASC) Order by the leave_id column
 * @method     ChildLeavesQuery orderByEmployeeId($order = Criteria::ASC) Order by the employee_id column
 * @method     ChildLeavesQuery orderByLeaveRequestId($order = Criteria::ASC) Order by the leave_request_id column
 * @method     ChildLeavesQuery orderByLeaveDate($order = Criteria::ASC) Order by the leave_date column
 * @method     ChildLeavesQuery orderByLeaveType($order = Criteria::ASC) Order by the leave_type column
 * @method     ChildLeavesQuery orderByLeaveRemark($order = Criteria::ASC) Order by the leave_remark column
 * @method     ChildLeavesQuery orderByLeavePoints($order = Criteria::ASC) Order by the leave_points column
 * @method     ChildLeavesQuery orderByLeaveSystemRemarks($order = Criteria::ASC) Order by the leave_system_remarks column
 * @method     ChildLeavesQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildLeavesQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildLeavesQuery orderByLeaveTranMode($order = Criteria::ASC) Order by the leave_tran_mode column
 * @method     ChildLeavesQuery orderByLeaveDays($order = Criteria::ASC) Order by the leave_days column
 *
 * @method     ChildLeavesQuery groupByLeaveId() Group by the leave_id column
 * @method     ChildLeavesQuery groupByEmployeeId() Group by the employee_id column
 * @method     ChildLeavesQuery groupByLeaveRequestId() Group by the leave_request_id column
 * @method     ChildLeavesQuery groupByLeaveDate() Group by the leave_date column
 * @method     ChildLeavesQuery groupByLeaveType() Group by the leave_type column
 * @method     ChildLeavesQuery groupByLeaveRemark() Group by the leave_remark column
 * @method     ChildLeavesQuery groupByLeavePoints() Group by the leave_points column
 * @method     ChildLeavesQuery groupByLeaveSystemRemarks() Group by the leave_system_remarks column
 * @method     ChildLeavesQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildLeavesQuery groupByCompanyId() Group by the company_id column
 * @method     ChildLeavesQuery groupByLeaveTranMode() Group by the leave_tran_mode column
 * @method     ChildLeavesQuery groupByLeaveDays() Group by the leave_days column
 *
 * @method     ChildLeavesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildLeavesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildLeavesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildLeavesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildLeavesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildLeavesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildLeavesQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildLeavesQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildLeavesQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildLeavesQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildLeavesQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildLeavesQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildLeavesQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     ChildLeavesQuery leftJoinEmployee($relationAlias = null) Adds a LEFT JOIN clause to the query using the Employee relation
 * @method     ChildLeavesQuery rightJoinEmployee($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Employee relation
 * @method     ChildLeavesQuery innerJoinEmployee($relationAlias = null) Adds a INNER JOIN clause to the query using the Employee relation
 *
 * @method     ChildLeavesQuery joinWithEmployee($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Employee relation
 *
 * @method     ChildLeavesQuery leftJoinWithEmployee() Adds a LEFT JOIN clause and with to the query using the Employee relation
 * @method     ChildLeavesQuery rightJoinWithEmployee() Adds a RIGHT JOIN clause and with to the query using the Employee relation
 * @method     ChildLeavesQuery innerJoinWithEmployee() Adds a INNER JOIN clause and with to the query using the Employee relation
 *
 * @method     \entities\CompanyQuery|\entities\EmployeeQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildLeaves|null findOne(?ConnectionInterface $con = null) Return the first ChildLeaves matching the query
 * @method     ChildLeaves findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildLeaves matching the query, or a new ChildLeaves object populated from the query conditions when no match is found
 *
 * @method     ChildLeaves|null findOneByLeaveId(int $leave_id) Return the first ChildLeaves filtered by the leave_id column
 * @method     ChildLeaves|null findOneByEmployeeId(int $employee_id) Return the first ChildLeaves filtered by the employee_id column
 * @method     ChildLeaves|null findOneByLeaveRequestId(int $leave_request_id) Return the first ChildLeaves filtered by the leave_request_id column
 * @method     ChildLeaves|null findOneByLeaveDate(string $leave_date) Return the first ChildLeaves filtered by the leave_date column
 * @method     ChildLeaves|null findOneByLeaveType(string $leave_type) Return the first ChildLeaves filtered by the leave_type column
 * @method     ChildLeaves|null findOneByLeaveRemark(string $leave_remark) Return the first ChildLeaves filtered by the leave_remark column
 * @method     ChildLeaves|null findOneByLeavePoints(string $leave_points) Return the first ChildLeaves filtered by the leave_points column
 * @method     ChildLeaves|null findOneByLeaveSystemRemarks(string $leave_system_remarks) Return the first ChildLeaves filtered by the leave_system_remarks column
 * @method     ChildLeaves|null findOneByCreatedAt(string $created_at) Return the first ChildLeaves filtered by the created_at column
 * @method     ChildLeaves|null findOneByCompanyId(int $company_id) Return the first ChildLeaves filtered by the company_id column
 * @method     ChildLeaves|null findOneByLeaveTranMode(string $leave_tran_mode) Return the first ChildLeaves filtered by the leave_tran_mode column
 * @method     ChildLeaves|null findOneByLeaveDays(int $leave_days) Return the first ChildLeaves filtered by the leave_days column
 *
 * @method     ChildLeaves requirePk($key, ?ConnectionInterface $con = null) Return the ChildLeaves by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLeaves requireOne(?ConnectionInterface $con = null) Return the first ChildLeaves matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildLeaves requireOneByLeaveId(int $leave_id) Return the first ChildLeaves filtered by the leave_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLeaves requireOneByEmployeeId(int $employee_id) Return the first ChildLeaves filtered by the employee_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLeaves requireOneByLeaveRequestId(int $leave_request_id) Return the first ChildLeaves filtered by the leave_request_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLeaves requireOneByLeaveDate(string $leave_date) Return the first ChildLeaves filtered by the leave_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLeaves requireOneByLeaveType(string $leave_type) Return the first ChildLeaves filtered by the leave_type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLeaves requireOneByLeaveRemark(string $leave_remark) Return the first ChildLeaves filtered by the leave_remark column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLeaves requireOneByLeavePoints(string $leave_points) Return the first ChildLeaves filtered by the leave_points column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLeaves requireOneByLeaveSystemRemarks(string $leave_system_remarks) Return the first ChildLeaves filtered by the leave_system_remarks column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLeaves requireOneByCreatedAt(string $created_at) Return the first ChildLeaves filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLeaves requireOneByCompanyId(int $company_id) Return the first ChildLeaves filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLeaves requireOneByLeaveTranMode(string $leave_tran_mode) Return the first ChildLeaves filtered by the leave_tran_mode column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLeaves requireOneByLeaveDays(int $leave_days) Return the first ChildLeaves filtered by the leave_days column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildLeaves[]|Collection find(?ConnectionInterface $con = null) Return ChildLeaves objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildLeaves> find(?ConnectionInterface $con = null) Return ChildLeaves objects based on current ModelCriteria
 *
 * @method     ChildLeaves[]|Collection findByLeaveId(int|array<int> $leave_id) Return ChildLeaves objects filtered by the leave_id column
 * @psalm-method Collection&\Traversable<ChildLeaves> findByLeaveId(int|array<int> $leave_id) Return ChildLeaves objects filtered by the leave_id column
 * @method     ChildLeaves[]|Collection findByEmployeeId(int|array<int> $employee_id) Return ChildLeaves objects filtered by the employee_id column
 * @psalm-method Collection&\Traversable<ChildLeaves> findByEmployeeId(int|array<int> $employee_id) Return ChildLeaves objects filtered by the employee_id column
 * @method     ChildLeaves[]|Collection findByLeaveRequestId(int|array<int> $leave_request_id) Return ChildLeaves objects filtered by the leave_request_id column
 * @psalm-method Collection&\Traversable<ChildLeaves> findByLeaveRequestId(int|array<int> $leave_request_id) Return ChildLeaves objects filtered by the leave_request_id column
 * @method     ChildLeaves[]|Collection findByLeaveDate(string|array<string> $leave_date) Return ChildLeaves objects filtered by the leave_date column
 * @psalm-method Collection&\Traversable<ChildLeaves> findByLeaveDate(string|array<string> $leave_date) Return ChildLeaves objects filtered by the leave_date column
 * @method     ChildLeaves[]|Collection findByLeaveType(string|array<string> $leave_type) Return ChildLeaves objects filtered by the leave_type column
 * @psalm-method Collection&\Traversable<ChildLeaves> findByLeaveType(string|array<string> $leave_type) Return ChildLeaves objects filtered by the leave_type column
 * @method     ChildLeaves[]|Collection findByLeaveRemark(string|array<string> $leave_remark) Return ChildLeaves objects filtered by the leave_remark column
 * @psalm-method Collection&\Traversable<ChildLeaves> findByLeaveRemark(string|array<string> $leave_remark) Return ChildLeaves objects filtered by the leave_remark column
 * @method     ChildLeaves[]|Collection findByLeavePoints(string|array<string> $leave_points) Return ChildLeaves objects filtered by the leave_points column
 * @psalm-method Collection&\Traversable<ChildLeaves> findByLeavePoints(string|array<string> $leave_points) Return ChildLeaves objects filtered by the leave_points column
 * @method     ChildLeaves[]|Collection findByLeaveSystemRemarks(string|array<string> $leave_system_remarks) Return ChildLeaves objects filtered by the leave_system_remarks column
 * @psalm-method Collection&\Traversable<ChildLeaves> findByLeaveSystemRemarks(string|array<string> $leave_system_remarks) Return ChildLeaves objects filtered by the leave_system_remarks column
 * @method     ChildLeaves[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildLeaves objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildLeaves> findByCreatedAt(string|array<string> $created_at) Return ChildLeaves objects filtered by the created_at column
 * @method     ChildLeaves[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildLeaves objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildLeaves> findByCompanyId(int|array<int> $company_id) Return ChildLeaves objects filtered by the company_id column
 * @method     ChildLeaves[]|Collection findByLeaveTranMode(string|array<string> $leave_tran_mode) Return ChildLeaves objects filtered by the leave_tran_mode column
 * @psalm-method Collection&\Traversable<ChildLeaves> findByLeaveTranMode(string|array<string> $leave_tran_mode) Return ChildLeaves objects filtered by the leave_tran_mode column
 * @method     ChildLeaves[]|Collection findByLeaveDays(int|array<int> $leave_days) Return ChildLeaves objects filtered by the leave_days column
 * @psalm-method Collection&\Traversable<ChildLeaves> findByLeaveDays(int|array<int> $leave_days) Return ChildLeaves objects filtered by the leave_days column
 *
 * @method     ChildLeaves[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildLeaves> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class LeavesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\LeavesQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\Leaves', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildLeavesQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildLeavesQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildLeavesQuery) {
            return $criteria;
        }
        $query = new ChildLeavesQuery();
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
     * @return ChildLeaves|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(LeavesTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = LeavesTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildLeaves A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT leave_id, employee_id, leave_request_id, leave_date, leave_type, leave_remark, leave_points, leave_system_remarks, created_at, company_id, leave_tran_mode, leave_days FROM leaves WHERE leave_id = :p0';
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
            /** @var ChildLeaves $obj */
            $obj = new ChildLeaves();
            $obj->hydrate($row);
            LeavesTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildLeaves|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(LeavesTableMap::COL_LEAVE_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(LeavesTableMap::COL_LEAVE_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the leave_id column
     *
     * Example usage:
     * <code>
     * $query->filterByLeaveId(1234); // WHERE leave_id = 1234
     * $query->filterByLeaveId(array(12, 34)); // WHERE leave_id IN (12, 34)
     * $query->filterByLeaveId(array('min' => 12)); // WHERE leave_id > 12
     * </code>
     *
     * @param mixed $leaveId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLeaveId($leaveId = null, ?string $comparison = null)
    {
        if (is_array($leaveId)) {
            $useMinMax = false;
            if (isset($leaveId['min'])) {
                $this->addUsingAlias(LeavesTableMap::COL_LEAVE_ID, $leaveId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($leaveId['max'])) {
                $this->addUsingAlias(LeavesTableMap::COL_LEAVE_ID, $leaveId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(LeavesTableMap::COL_LEAVE_ID, $leaveId, $comparison);

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
                $this->addUsingAlias(LeavesTableMap::COL_EMPLOYEE_ID, $employeeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($employeeId['max'])) {
                $this->addUsingAlias(LeavesTableMap::COL_EMPLOYEE_ID, $employeeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(LeavesTableMap::COL_EMPLOYEE_ID, $employeeId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the leave_request_id column
     *
     * Example usage:
     * <code>
     * $query->filterByLeaveRequestId(1234); // WHERE leave_request_id = 1234
     * $query->filterByLeaveRequestId(array(12, 34)); // WHERE leave_request_id IN (12, 34)
     * $query->filterByLeaveRequestId(array('min' => 12)); // WHERE leave_request_id > 12
     * </code>
     *
     * @param mixed $leaveRequestId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLeaveRequestId($leaveRequestId = null, ?string $comparison = null)
    {
        if (is_array($leaveRequestId)) {
            $useMinMax = false;
            if (isset($leaveRequestId['min'])) {
                $this->addUsingAlias(LeavesTableMap::COL_LEAVE_REQUEST_ID, $leaveRequestId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($leaveRequestId['max'])) {
                $this->addUsingAlias(LeavesTableMap::COL_LEAVE_REQUEST_ID, $leaveRequestId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(LeavesTableMap::COL_LEAVE_REQUEST_ID, $leaveRequestId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the leave_date column
     *
     * Example usage:
     * <code>
     * $query->filterByLeaveDate('2011-03-14'); // WHERE leave_date = '2011-03-14'
     * $query->filterByLeaveDate('now'); // WHERE leave_date = '2011-03-14'
     * $query->filterByLeaveDate(array('max' => 'yesterday')); // WHERE leave_date > '2011-03-13'
     * </code>
     *
     * @param mixed $leaveDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLeaveDate($leaveDate = null, ?string $comparison = null)
    {
        if (is_array($leaveDate)) {
            $useMinMax = false;
            if (isset($leaveDate['min'])) {
                $this->addUsingAlias(LeavesTableMap::COL_LEAVE_DATE, $leaveDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($leaveDate['max'])) {
                $this->addUsingAlias(LeavesTableMap::COL_LEAVE_DATE, $leaveDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(LeavesTableMap::COL_LEAVE_DATE, $leaveDate, $comparison);

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

        $this->addUsingAlias(LeavesTableMap::COL_LEAVE_TYPE, $leaveType, $comparison);

        return $this;
    }

    /**
     * Filter the query on the leave_remark column
     *
     * Example usage:
     * <code>
     * $query->filterByLeaveRemark('fooValue');   // WHERE leave_remark = 'fooValue'
     * $query->filterByLeaveRemark('%fooValue%', Criteria::LIKE); // WHERE leave_remark LIKE '%fooValue%'
     * $query->filterByLeaveRemark(['foo', 'bar']); // WHERE leave_remark IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $leaveRemark The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLeaveRemark($leaveRemark = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($leaveRemark)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(LeavesTableMap::COL_LEAVE_REMARK, $leaveRemark, $comparison);

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
                $this->addUsingAlias(LeavesTableMap::COL_LEAVE_POINTS, $leavePoints['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($leavePoints['max'])) {
                $this->addUsingAlias(LeavesTableMap::COL_LEAVE_POINTS, $leavePoints['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(LeavesTableMap::COL_LEAVE_POINTS, $leavePoints, $comparison);

        return $this;
    }

    /**
     * Filter the query on the leave_system_remarks column
     *
     * Example usage:
     * <code>
     * $query->filterByLeaveSystemRemarks('fooValue');   // WHERE leave_system_remarks = 'fooValue'
     * $query->filterByLeaveSystemRemarks('%fooValue%', Criteria::LIKE); // WHERE leave_system_remarks LIKE '%fooValue%'
     * $query->filterByLeaveSystemRemarks(['foo', 'bar']); // WHERE leave_system_remarks IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $leaveSystemRemarks The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLeaveSystemRemarks($leaveSystemRemarks = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($leaveSystemRemarks)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(LeavesTableMap::COL_LEAVE_SYSTEM_REMARKS, $leaveSystemRemarks, $comparison);

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
                $this->addUsingAlias(LeavesTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(LeavesTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(LeavesTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(LeavesTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(LeavesTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(LeavesTableMap::COL_COMPANY_ID, $companyId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the leave_tran_mode column
     *
     * Example usage:
     * <code>
     * $query->filterByLeaveTranMode('fooValue');   // WHERE leave_tran_mode = 'fooValue'
     * $query->filterByLeaveTranMode('%fooValue%', Criteria::LIKE); // WHERE leave_tran_mode LIKE '%fooValue%'
     * $query->filterByLeaveTranMode(['foo', 'bar']); // WHERE leave_tran_mode IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $leaveTranMode The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLeaveTranMode($leaveTranMode = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($leaveTranMode)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(LeavesTableMap::COL_LEAVE_TRAN_MODE, $leaveTranMode, $comparison);

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
                $this->addUsingAlias(LeavesTableMap::COL_LEAVE_DAYS, $leaveDays['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($leaveDays['max'])) {
                $this->addUsingAlias(LeavesTableMap::COL_LEAVE_DAYS, $leaveDays['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(LeavesTableMap::COL_LEAVE_DAYS, $leaveDays, $comparison);

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
                ->addUsingAlias(LeavesTableMap::COL_COMPANY_ID, $company->getCompanyId(), $comparison);
        } elseif ($company instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(LeavesTableMap::COL_COMPANY_ID, $company->toKeyValue('PrimaryKey', 'CompanyId'), $comparison);

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
                ->addUsingAlias(LeavesTableMap::COL_EMPLOYEE_ID, $employee->getEmployeeId(), $comparison);
        } elseif ($employee instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(LeavesTableMap::COL_EMPLOYEE_ID, $employee->toKeyValue('PrimaryKey', 'EmployeeId'), $comparison);

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
    public function joinEmployee(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
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
    public function useEmployeeQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
        ?string $joinType = Criteria::LEFT_JOIN
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
     * @param ChildLeaves $leaves Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($leaves = null)
    {
        if ($leaves) {
            $this->addUsingAlias(LeavesTableMap::COL_LEAVE_ID, $leaves->getLeaveId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the leaves table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(LeavesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            LeavesTableMap::clearInstancePool();
            LeavesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(LeavesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(LeavesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            LeavesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            LeavesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
