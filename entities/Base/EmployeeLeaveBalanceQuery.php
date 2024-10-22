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
use entities\EmployeeLeaveBalance as ChildEmployeeLeaveBalance;
use entities\EmployeeLeaveBalanceQuery as ChildEmployeeLeaveBalanceQuery;
use entities\Map\EmployeeLeaveBalanceTableMap;

/**
 * Base class that represents a query for the `employee_leave_balance` table.
 *
 * @method     ChildEmployeeLeaveBalanceQuery orderByUniquecode($order = Criteria::ASC) Order by the uniquecode column
 * @method     ChildEmployeeLeaveBalanceQuery orderByEmployeeId($order = Criteria::ASC) Order by the employee_id column
 * @method     ChildEmployeeLeaveBalanceQuery orderByLeaveYear($order = Criteria::ASC) Order by the leave_year column
 * @method     ChildEmployeeLeaveBalanceQuery orderByLeaveType($order = Criteria::ASC) Order by the leave_type column
 * @method     ChildEmployeeLeaveBalanceQuery orderByAccuration($order = Criteria::ASC) Order by the accuration column
 * @method     ChildEmployeeLeaveBalanceQuery orderByOpening($order = Criteria::ASC) Order by the opening column
 * @method     ChildEmployeeLeaveBalanceQuery orderByReward($order = Criteria::ASC) Order by the reward column
 * @method     ChildEmployeeLeaveBalanceQuery orderByConsumed($order = Criteria::ASC) Order by the consumed column
 * @method     ChildEmployeeLeaveBalanceQuery orderByBalance($order = Criteria::ASC) Order by the balance column
 *
 * @method     ChildEmployeeLeaveBalanceQuery groupByUniquecode() Group by the uniquecode column
 * @method     ChildEmployeeLeaveBalanceQuery groupByEmployeeId() Group by the employee_id column
 * @method     ChildEmployeeLeaveBalanceQuery groupByLeaveYear() Group by the leave_year column
 * @method     ChildEmployeeLeaveBalanceQuery groupByLeaveType() Group by the leave_type column
 * @method     ChildEmployeeLeaveBalanceQuery groupByAccuration() Group by the accuration column
 * @method     ChildEmployeeLeaveBalanceQuery groupByOpening() Group by the opening column
 * @method     ChildEmployeeLeaveBalanceQuery groupByReward() Group by the reward column
 * @method     ChildEmployeeLeaveBalanceQuery groupByConsumed() Group by the consumed column
 * @method     ChildEmployeeLeaveBalanceQuery groupByBalance() Group by the balance column
 *
 * @method     ChildEmployeeLeaveBalanceQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildEmployeeLeaveBalanceQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildEmployeeLeaveBalanceQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildEmployeeLeaveBalanceQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildEmployeeLeaveBalanceQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildEmployeeLeaveBalanceQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildEmployeeLeaveBalance|null findOne(?ConnectionInterface $con = null) Return the first ChildEmployeeLeaveBalance matching the query
 * @method     ChildEmployeeLeaveBalance findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildEmployeeLeaveBalance matching the query, or a new ChildEmployeeLeaveBalance object populated from the query conditions when no match is found
 *
 * @method     ChildEmployeeLeaveBalance|null findOneByUniquecode(string $uniquecode) Return the first ChildEmployeeLeaveBalance filtered by the uniquecode column
 * @method     ChildEmployeeLeaveBalance|null findOneByEmployeeId(int $employee_id) Return the first ChildEmployeeLeaveBalance filtered by the employee_id column
 * @method     ChildEmployeeLeaveBalance|null findOneByLeaveYear(string $leave_year) Return the first ChildEmployeeLeaveBalance filtered by the leave_year column
 * @method     ChildEmployeeLeaveBalance|null findOneByLeaveType(string $leave_type) Return the first ChildEmployeeLeaveBalance filtered by the leave_type column
 * @method     ChildEmployeeLeaveBalance|null findOneByAccuration(int $accuration) Return the first ChildEmployeeLeaveBalance filtered by the accuration column
 * @method     ChildEmployeeLeaveBalance|null findOneByOpening(int $opening) Return the first ChildEmployeeLeaveBalance filtered by the opening column
 * @method     ChildEmployeeLeaveBalance|null findOneByReward(int $reward) Return the first ChildEmployeeLeaveBalance filtered by the reward column
 * @method     ChildEmployeeLeaveBalance|null findOneByConsumed(int $consumed) Return the first ChildEmployeeLeaveBalance filtered by the consumed column
 * @method     ChildEmployeeLeaveBalance|null findOneByBalance(int $balance) Return the first ChildEmployeeLeaveBalance filtered by the balance column
 *
 * @method     ChildEmployeeLeaveBalance requirePk($key, ?ConnectionInterface $con = null) Return the ChildEmployeeLeaveBalance by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeeLeaveBalance requireOne(?ConnectionInterface $con = null) Return the first ChildEmployeeLeaveBalance matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEmployeeLeaveBalance requireOneByUniquecode(string $uniquecode) Return the first ChildEmployeeLeaveBalance filtered by the uniquecode column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeeLeaveBalance requireOneByEmployeeId(int $employee_id) Return the first ChildEmployeeLeaveBalance filtered by the employee_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeeLeaveBalance requireOneByLeaveYear(string $leave_year) Return the first ChildEmployeeLeaveBalance filtered by the leave_year column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeeLeaveBalance requireOneByLeaveType(string $leave_type) Return the first ChildEmployeeLeaveBalance filtered by the leave_type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeeLeaveBalance requireOneByAccuration(int $accuration) Return the first ChildEmployeeLeaveBalance filtered by the accuration column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeeLeaveBalance requireOneByOpening(int $opening) Return the first ChildEmployeeLeaveBalance filtered by the opening column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeeLeaveBalance requireOneByReward(int $reward) Return the first ChildEmployeeLeaveBalance filtered by the reward column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeeLeaveBalance requireOneByConsumed(int $consumed) Return the first ChildEmployeeLeaveBalance filtered by the consumed column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeeLeaveBalance requireOneByBalance(int $balance) Return the first ChildEmployeeLeaveBalance filtered by the balance column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEmployeeLeaveBalance[]|Collection find(?ConnectionInterface $con = null) Return ChildEmployeeLeaveBalance objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildEmployeeLeaveBalance> find(?ConnectionInterface $con = null) Return ChildEmployeeLeaveBalance objects based on current ModelCriteria
 *
 * @method     ChildEmployeeLeaveBalance[]|Collection findByUniquecode(string|array<string> $uniquecode) Return ChildEmployeeLeaveBalance objects filtered by the uniquecode column
 * @psalm-method Collection&\Traversable<ChildEmployeeLeaveBalance> findByUniquecode(string|array<string> $uniquecode) Return ChildEmployeeLeaveBalance objects filtered by the uniquecode column
 * @method     ChildEmployeeLeaveBalance[]|Collection findByEmployeeId(int|array<int> $employee_id) Return ChildEmployeeLeaveBalance objects filtered by the employee_id column
 * @psalm-method Collection&\Traversable<ChildEmployeeLeaveBalance> findByEmployeeId(int|array<int> $employee_id) Return ChildEmployeeLeaveBalance objects filtered by the employee_id column
 * @method     ChildEmployeeLeaveBalance[]|Collection findByLeaveYear(string|array<string> $leave_year) Return ChildEmployeeLeaveBalance objects filtered by the leave_year column
 * @psalm-method Collection&\Traversable<ChildEmployeeLeaveBalance> findByLeaveYear(string|array<string> $leave_year) Return ChildEmployeeLeaveBalance objects filtered by the leave_year column
 * @method     ChildEmployeeLeaveBalance[]|Collection findByLeaveType(string|array<string> $leave_type) Return ChildEmployeeLeaveBalance objects filtered by the leave_type column
 * @psalm-method Collection&\Traversable<ChildEmployeeLeaveBalance> findByLeaveType(string|array<string> $leave_type) Return ChildEmployeeLeaveBalance objects filtered by the leave_type column
 * @method     ChildEmployeeLeaveBalance[]|Collection findByAccuration(int|array<int> $accuration) Return ChildEmployeeLeaveBalance objects filtered by the accuration column
 * @psalm-method Collection&\Traversable<ChildEmployeeLeaveBalance> findByAccuration(int|array<int> $accuration) Return ChildEmployeeLeaveBalance objects filtered by the accuration column
 * @method     ChildEmployeeLeaveBalance[]|Collection findByOpening(int|array<int> $opening) Return ChildEmployeeLeaveBalance objects filtered by the opening column
 * @psalm-method Collection&\Traversable<ChildEmployeeLeaveBalance> findByOpening(int|array<int> $opening) Return ChildEmployeeLeaveBalance objects filtered by the opening column
 * @method     ChildEmployeeLeaveBalance[]|Collection findByReward(int|array<int> $reward) Return ChildEmployeeLeaveBalance objects filtered by the reward column
 * @psalm-method Collection&\Traversable<ChildEmployeeLeaveBalance> findByReward(int|array<int> $reward) Return ChildEmployeeLeaveBalance objects filtered by the reward column
 * @method     ChildEmployeeLeaveBalance[]|Collection findByConsumed(int|array<int> $consumed) Return ChildEmployeeLeaveBalance objects filtered by the consumed column
 * @psalm-method Collection&\Traversable<ChildEmployeeLeaveBalance> findByConsumed(int|array<int> $consumed) Return ChildEmployeeLeaveBalance objects filtered by the consumed column
 * @method     ChildEmployeeLeaveBalance[]|Collection findByBalance(int|array<int> $balance) Return ChildEmployeeLeaveBalance objects filtered by the balance column
 * @psalm-method Collection&\Traversable<ChildEmployeeLeaveBalance> findByBalance(int|array<int> $balance) Return ChildEmployeeLeaveBalance objects filtered by the balance column
 *
 * @method     ChildEmployeeLeaveBalance[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildEmployeeLeaveBalance> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class EmployeeLeaveBalanceQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\EmployeeLeaveBalanceQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\EmployeeLeaveBalance', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildEmployeeLeaveBalanceQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildEmployeeLeaveBalanceQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildEmployeeLeaveBalanceQuery) {
            return $criteria;
        }
        $query = new ChildEmployeeLeaveBalanceQuery();
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
     * @return ChildEmployeeLeaveBalance|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(EmployeeLeaveBalanceTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = EmployeeLeaveBalanceTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildEmployeeLeaveBalance A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT uniquecode, employee_id, leave_year, leave_type, accuration, opening, reward, consumed, balance FROM employee_leave_balance WHERE uniquecode = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildEmployeeLeaveBalance $obj */
            $obj = new ChildEmployeeLeaveBalance();
            $obj->hydrate($row);
            EmployeeLeaveBalanceTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildEmployeeLeaveBalance|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(EmployeeLeaveBalanceTableMap::COL_UNIQUECODE, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(EmployeeLeaveBalanceTableMap::COL_UNIQUECODE, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the uniquecode column
     *
     * Example usage:
     * <code>
     * $query->filterByUniquecode('fooValue');   // WHERE uniquecode = 'fooValue'
     * $query->filterByUniquecode('%fooValue%', Criteria::LIKE); // WHERE uniquecode LIKE '%fooValue%'
     * $query->filterByUniquecode(['foo', 'bar']); // WHERE uniquecode IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $uniquecode The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUniquecode($uniquecode = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($uniquecode)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmployeeLeaveBalanceTableMap::COL_UNIQUECODE, $uniquecode, $comparison);

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
                $this->addUsingAlias(EmployeeLeaveBalanceTableMap::COL_EMPLOYEE_ID, $employeeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($employeeId['max'])) {
                $this->addUsingAlias(EmployeeLeaveBalanceTableMap::COL_EMPLOYEE_ID, $employeeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmployeeLeaveBalanceTableMap::COL_EMPLOYEE_ID, $employeeId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the leave_year column
     *
     * Example usage:
     * <code>
     * $query->filterByLeaveYear('fooValue');   // WHERE leave_year = 'fooValue'
     * $query->filterByLeaveYear('%fooValue%', Criteria::LIKE); // WHERE leave_year LIKE '%fooValue%'
     * $query->filterByLeaveYear(['foo', 'bar']); // WHERE leave_year IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $leaveYear The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLeaveYear($leaveYear = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($leaveYear)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmployeeLeaveBalanceTableMap::COL_LEAVE_YEAR, $leaveYear, $comparison);

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

        $this->addUsingAlias(EmployeeLeaveBalanceTableMap::COL_LEAVE_TYPE, $leaveType, $comparison);

        return $this;
    }

    /**
     * Filter the query on the accuration column
     *
     * Example usage:
     * <code>
     * $query->filterByAccuration(1234); // WHERE accuration = 1234
     * $query->filterByAccuration(array(12, 34)); // WHERE accuration IN (12, 34)
     * $query->filterByAccuration(array('min' => 12)); // WHERE accuration > 12
     * </code>
     *
     * @param mixed $accuration The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAccuration($accuration = null, ?string $comparison = null)
    {
        if (is_array($accuration)) {
            $useMinMax = false;
            if (isset($accuration['min'])) {
                $this->addUsingAlias(EmployeeLeaveBalanceTableMap::COL_ACCURATION, $accuration['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($accuration['max'])) {
                $this->addUsingAlias(EmployeeLeaveBalanceTableMap::COL_ACCURATION, $accuration['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmployeeLeaveBalanceTableMap::COL_ACCURATION, $accuration, $comparison);

        return $this;
    }

    /**
     * Filter the query on the opening column
     *
     * Example usage:
     * <code>
     * $query->filterByOpening(1234); // WHERE opening = 1234
     * $query->filterByOpening(array(12, 34)); // WHERE opening IN (12, 34)
     * $query->filterByOpening(array('min' => 12)); // WHERE opening > 12
     * </code>
     *
     * @param mixed $opening The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOpening($opening = null, ?string $comparison = null)
    {
        if (is_array($opening)) {
            $useMinMax = false;
            if (isset($opening['min'])) {
                $this->addUsingAlias(EmployeeLeaveBalanceTableMap::COL_OPENING, $opening['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($opening['max'])) {
                $this->addUsingAlias(EmployeeLeaveBalanceTableMap::COL_OPENING, $opening['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmployeeLeaveBalanceTableMap::COL_OPENING, $opening, $comparison);

        return $this;
    }

    /**
     * Filter the query on the reward column
     *
     * Example usage:
     * <code>
     * $query->filterByReward(1234); // WHERE reward = 1234
     * $query->filterByReward(array(12, 34)); // WHERE reward IN (12, 34)
     * $query->filterByReward(array('min' => 12)); // WHERE reward > 12
     * </code>
     *
     * @param mixed $reward The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByReward($reward = null, ?string $comparison = null)
    {
        if (is_array($reward)) {
            $useMinMax = false;
            if (isset($reward['min'])) {
                $this->addUsingAlias(EmployeeLeaveBalanceTableMap::COL_REWARD, $reward['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($reward['max'])) {
                $this->addUsingAlias(EmployeeLeaveBalanceTableMap::COL_REWARD, $reward['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmployeeLeaveBalanceTableMap::COL_REWARD, $reward, $comparison);

        return $this;
    }

    /**
     * Filter the query on the consumed column
     *
     * Example usage:
     * <code>
     * $query->filterByConsumed(1234); // WHERE consumed = 1234
     * $query->filterByConsumed(array(12, 34)); // WHERE consumed IN (12, 34)
     * $query->filterByConsumed(array('min' => 12)); // WHERE consumed > 12
     * </code>
     *
     * @param mixed $consumed The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByConsumed($consumed = null, ?string $comparison = null)
    {
        if (is_array($consumed)) {
            $useMinMax = false;
            if (isset($consumed['min'])) {
                $this->addUsingAlias(EmployeeLeaveBalanceTableMap::COL_CONSUMED, $consumed['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($consumed['max'])) {
                $this->addUsingAlias(EmployeeLeaveBalanceTableMap::COL_CONSUMED, $consumed['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmployeeLeaveBalanceTableMap::COL_CONSUMED, $consumed, $comparison);

        return $this;
    }

    /**
     * Filter the query on the balance column
     *
     * Example usage:
     * <code>
     * $query->filterByBalance(1234); // WHERE balance = 1234
     * $query->filterByBalance(array(12, 34)); // WHERE balance IN (12, 34)
     * $query->filterByBalance(array('min' => 12)); // WHERE balance > 12
     * </code>
     *
     * @param mixed $balance The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBalance($balance = null, ?string $comparison = null)
    {
        if (is_array($balance)) {
            $useMinMax = false;
            if (isset($balance['min'])) {
                $this->addUsingAlias(EmployeeLeaveBalanceTableMap::COL_BALANCE, $balance['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($balance['max'])) {
                $this->addUsingAlias(EmployeeLeaveBalanceTableMap::COL_BALANCE, $balance['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmployeeLeaveBalanceTableMap::COL_BALANCE, $balance, $comparison);

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildEmployeeLeaveBalance $employeeLeaveBalance Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($employeeLeaveBalance = null)
    {
        if ($employeeLeaveBalance) {
            $this->addUsingAlias(EmployeeLeaveBalanceTableMap::COL_UNIQUECODE, $employeeLeaveBalance->getUniquecode(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
