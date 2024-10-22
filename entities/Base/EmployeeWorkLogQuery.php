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
use entities\EmployeeWorkLog as ChildEmployeeWorkLog;
use entities\EmployeeWorkLogQuery as ChildEmployeeWorkLogQuery;
use entities\Map\EmployeeWorkLogTableMap;

/**
 * Base class that represents a query for the `employee_work_log` table.
 *
 * @method     ChildEmployeeWorkLogQuery orderByWorkLogId($order = Criteria::ASC) Order by the work_log_id column
 * @method     ChildEmployeeWorkLogQuery orderByExpId($order = Criteria::ASC) Order by the exp_id column
 * @method     ChildEmployeeWorkLogQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ChildEmployeeWorkLogQuery orderByStartTime($order = Criteria::ASC) Order by the start_time column
 * @method     ChildEmployeeWorkLogQuery orderByMinutes($order = Criteria::ASC) Order by the minutes column
 * @method     ChildEmployeeWorkLogQuery orderByLocation($order = Criteria::ASC) Order by the location column
 * @method     ChildEmployeeWorkLogQuery orderByPin($order = Criteria::ASC) Order by the pin column
 * @method     ChildEmployeeWorkLogQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildEmployeeWorkLogQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildEmployeeWorkLogQuery groupByWorkLogId() Group by the work_log_id column
 * @method     ChildEmployeeWorkLogQuery groupByExpId() Group by the exp_id column
 * @method     ChildEmployeeWorkLogQuery groupByDescription() Group by the description column
 * @method     ChildEmployeeWorkLogQuery groupByStartTime() Group by the start_time column
 * @method     ChildEmployeeWorkLogQuery groupByMinutes() Group by the minutes column
 * @method     ChildEmployeeWorkLogQuery groupByLocation() Group by the location column
 * @method     ChildEmployeeWorkLogQuery groupByPin() Group by the pin column
 * @method     ChildEmployeeWorkLogQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildEmployeeWorkLogQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildEmployeeWorkLogQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildEmployeeWorkLogQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildEmployeeWorkLogQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildEmployeeWorkLogQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildEmployeeWorkLogQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildEmployeeWorkLogQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildEmployeeWorkLogQuery leftJoinExpenses($relationAlias = null) Adds a LEFT JOIN clause to the query using the Expenses relation
 * @method     ChildEmployeeWorkLogQuery rightJoinExpenses($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Expenses relation
 * @method     ChildEmployeeWorkLogQuery innerJoinExpenses($relationAlias = null) Adds a INNER JOIN clause to the query using the Expenses relation
 *
 * @method     ChildEmployeeWorkLogQuery joinWithExpenses($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Expenses relation
 *
 * @method     ChildEmployeeWorkLogQuery leftJoinWithExpenses() Adds a LEFT JOIN clause and with to the query using the Expenses relation
 * @method     ChildEmployeeWorkLogQuery rightJoinWithExpenses() Adds a RIGHT JOIN clause and with to the query using the Expenses relation
 * @method     ChildEmployeeWorkLogQuery innerJoinWithExpenses() Adds a INNER JOIN clause and with to the query using the Expenses relation
 *
 * @method     \entities\ExpensesQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildEmployeeWorkLog|null findOne(?ConnectionInterface $con = null) Return the first ChildEmployeeWorkLog matching the query
 * @method     ChildEmployeeWorkLog findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildEmployeeWorkLog matching the query, or a new ChildEmployeeWorkLog object populated from the query conditions when no match is found
 *
 * @method     ChildEmployeeWorkLog|null findOneByWorkLogId(int $work_log_id) Return the first ChildEmployeeWorkLog filtered by the work_log_id column
 * @method     ChildEmployeeWorkLog|null findOneByExpId(int $exp_id) Return the first ChildEmployeeWorkLog filtered by the exp_id column
 * @method     ChildEmployeeWorkLog|null findOneByDescription(string $description) Return the first ChildEmployeeWorkLog filtered by the description column
 * @method     ChildEmployeeWorkLog|null findOneByStartTime(string $start_time) Return the first ChildEmployeeWorkLog filtered by the start_time column
 * @method     ChildEmployeeWorkLog|null findOneByMinutes(int $minutes) Return the first ChildEmployeeWorkLog filtered by the minutes column
 * @method     ChildEmployeeWorkLog|null findOneByLocation(string $location) Return the first ChildEmployeeWorkLog filtered by the location column
 * @method     ChildEmployeeWorkLog|null findOneByPin(string $pin) Return the first ChildEmployeeWorkLog filtered by the pin column
 * @method     ChildEmployeeWorkLog|null findOneByCreatedAt(string $created_at) Return the first ChildEmployeeWorkLog filtered by the created_at column
 * @method     ChildEmployeeWorkLog|null findOneByUpdatedAt(string $updated_at) Return the first ChildEmployeeWorkLog filtered by the updated_at column
 *
 * @method     ChildEmployeeWorkLog requirePk($key, ?ConnectionInterface $con = null) Return the ChildEmployeeWorkLog by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeeWorkLog requireOne(?ConnectionInterface $con = null) Return the first ChildEmployeeWorkLog matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEmployeeWorkLog requireOneByWorkLogId(int $work_log_id) Return the first ChildEmployeeWorkLog filtered by the work_log_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeeWorkLog requireOneByExpId(int $exp_id) Return the first ChildEmployeeWorkLog filtered by the exp_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeeWorkLog requireOneByDescription(string $description) Return the first ChildEmployeeWorkLog filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeeWorkLog requireOneByStartTime(string $start_time) Return the first ChildEmployeeWorkLog filtered by the start_time column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeeWorkLog requireOneByMinutes(int $minutes) Return the first ChildEmployeeWorkLog filtered by the minutes column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeeWorkLog requireOneByLocation(string $location) Return the first ChildEmployeeWorkLog filtered by the location column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeeWorkLog requireOneByPin(string $pin) Return the first ChildEmployeeWorkLog filtered by the pin column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeeWorkLog requireOneByCreatedAt(string $created_at) Return the first ChildEmployeeWorkLog filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeeWorkLog requireOneByUpdatedAt(string $updated_at) Return the first ChildEmployeeWorkLog filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEmployeeWorkLog[]|Collection find(?ConnectionInterface $con = null) Return ChildEmployeeWorkLog objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildEmployeeWorkLog> find(?ConnectionInterface $con = null) Return ChildEmployeeWorkLog objects based on current ModelCriteria
 *
 * @method     ChildEmployeeWorkLog[]|Collection findByWorkLogId(int|array<int> $work_log_id) Return ChildEmployeeWorkLog objects filtered by the work_log_id column
 * @psalm-method Collection&\Traversable<ChildEmployeeWorkLog> findByWorkLogId(int|array<int> $work_log_id) Return ChildEmployeeWorkLog objects filtered by the work_log_id column
 * @method     ChildEmployeeWorkLog[]|Collection findByExpId(int|array<int> $exp_id) Return ChildEmployeeWorkLog objects filtered by the exp_id column
 * @psalm-method Collection&\Traversable<ChildEmployeeWorkLog> findByExpId(int|array<int> $exp_id) Return ChildEmployeeWorkLog objects filtered by the exp_id column
 * @method     ChildEmployeeWorkLog[]|Collection findByDescription(string|array<string> $description) Return ChildEmployeeWorkLog objects filtered by the description column
 * @psalm-method Collection&\Traversable<ChildEmployeeWorkLog> findByDescription(string|array<string> $description) Return ChildEmployeeWorkLog objects filtered by the description column
 * @method     ChildEmployeeWorkLog[]|Collection findByStartTime(string|array<string> $start_time) Return ChildEmployeeWorkLog objects filtered by the start_time column
 * @psalm-method Collection&\Traversable<ChildEmployeeWorkLog> findByStartTime(string|array<string> $start_time) Return ChildEmployeeWorkLog objects filtered by the start_time column
 * @method     ChildEmployeeWorkLog[]|Collection findByMinutes(int|array<int> $minutes) Return ChildEmployeeWorkLog objects filtered by the minutes column
 * @psalm-method Collection&\Traversable<ChildEmployeeWorkLog> findByMinutes(int|array<int> $minutes) Return ChildEmployeeWorkLog objects filtered by the minutes column
 * @method     ChildEmployeeWorkLog[]|Collection findByLocation(string|array<string> $location) Return ChildEmployeeWorkLog objects filtered by the location column
 * @psalm-method Collection&\Traversable<ChildEmployeeWorkLog> findByLocation(string|array<string> $location) Return ChildEmployeeWorkLog objects filtered by the location column
 * @method     ChildEmployeeWorkLog[]|Collection findByPin(string|array<string> $pin) Return ChildEmployeeWorkLog objects filtered by the pin column
 * @psalm-method Collection&\Traversable<ChildEmployeeWorkLog> findByPin(string|array<string> $pin) Return ChildEmployeeWorkLog objects filtered by the pin column
 * @method     ChildEmployeeWorkLog[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildEmployeeWorkLog objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildEmployeeWorkLog> findByCreatedAt(string|array<string> $created_at) Return ChildEmployeeWorkLog objects filtered by the created_at column
 * @method     ChildEmployeeWorkLog[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildEmployeeWorkLog objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildEmployeeWorkLog> findByUpdatedAt(string|array<string> $updated_at) Return ChildEmployeeWorkLog objects filtered by the updated_at column
 *
 * @method     ChildEmployeeWorkLog[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildEmployeeWorkLog> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class EmployeeWorkLogQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\EmployeeWorkLogQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\EmployeeWorkLog', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildEmployeeWorkLogQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildEmployeeWorkLogQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildEmployeeWorkLogQuery) {
            return $criteria;
        }
        $query = new ChildEmployeeWorkLogQuery();
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
     * @return ChildEmployeeWorkLog|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(EmployeeWorkLogTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = EmployeeWorkLogTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildEmployeeWorkLog A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT work_log_id, exp_id, description, start_time, minutes, location, pin, created_at, updated_at FROM employee_work_log WHERE work_log_id = :p0';
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
            /** @var ChildEmployeeWorkLog $obj */
            $obj = new ChildEmployeeWorkLog();
            $obj->hydrate($row);
            EmployeeWorkLogTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildEmployeeWorkLog|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(EmployeeWorkLogTableMap::COL_WORK_LOG_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(EmployeeWorkLogTableMap::COL_WORK_LOG_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the work_log_id column
     *
     * Example usage:
     * <code>
     * $query->filterByWorkLogId(1234); // WHERE work_log_id = 1234
     * $query->filterByWorkLogId(array(12, 34)); // WHERE work_log_id IN (12, 34)
     * $query->filterByWorkLogId(array('min' => 12)); // WHERE work_log_id > 12
     * </code>
     *
     * @param mixed $workLogId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWorkLogId($workLogId = null, ?string $comparison = null)
    {
        if (is_array($workLogId)) {
            $useMinMax = false;
            if (isset($workLogId['min'])) {
                $this->addUsingAlias(EmployeeWorkLogTableMap::COL_WORK_LOG_ID, $workLogId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($workLogId['max'])) {
                $this->addUsingAlias(EmployeeWorkLogTableMap::COL_WORK_LOG_ID, $workLogId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmployeeWorkLogTableMap::COL_WORK_LOG_ID, $workLogId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the exp_id column
     *
     * Example usage:
     * <code>
     * $query->filterByExpId(1234); // WHERE exp_id = 1234
     * $query->filterByExpId(array(12, 34)); // WHERE exp_id IN (12, 34)
     * $query->filterByExpId(array('min' => 12)); // WHERE exp_id > 12
     * </code>
     *
     * @see       filterByExpenses()
     *
     * @param mixed $expId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpId($expId = null, ?string $comparison = null)
    {
        if (is_array($expId)) {
            $useMinMax = false;
            if (isset($expId['min'])) {
                $this->addUsingAlias(EmployeeWorkLogTableMap::COL_EXP_ID, $expId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($expId['max'])) {
                $this->addUsingAlias(EmployeeWorkLogTableMap::COL_EXP_ID, $expId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmployeeWorkLogTableMap::COL_EXP_ID, $expId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the description column
     *
     * Example usage:
     * <code>
     * $query->filterByDescription('fooValue');   // WHERE description = 'fooValue'
     * $query->filterByDescription('%fooValue%', Criteria::LIKE); // WHERE description LIKE '%fooValue%'
     * $query->filterByDescription(['foo', 'bar']); // WHERE description IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $description The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDescription($description = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmployeeWorkLogTableMap::COL_DESCRIPTION, $description, $comparison);

        return $this;
    }

    /**
     * Filter the query on the start_time column
     *
     * Example usage:
     * <code>
     * $query->filterByStartTime('2011-03-14'); // WHERE start_time = '2011-03-14'
     * $query->filterByStartTime('now'); // WHERE start_time = '2011-03-14'
     * $query->filterByStartTime(array('max' => 'yesterday')); // WHERE start_time > '2011-03-13'
     * </code>
     *
     * @param mixed $startTime The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStartTime($startTime = null, ?string $comparison = null)
    {
        if (is_array($startTime)) {
            $useMinMax = false;
            if (isset($startTime['min'])) {
                $this->addUsingAlias(EmployeeWorkLogTableMap::COL_START_TIME, $startTime['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($startTime['max'])) {
                $this->addUsingAlias(EmployeeWorkLogTableMap::COL_START_TIME, $startTime['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmployeeWorkLogTableMap::COL_START_TIME, $startTime, $comparison);

        return $this;
    }

    /**
     * Filter the query on the minutes column
     *
     * Example usage:
     * <code>
     * $query->filterByMinutes(1234); // WHERE minutes = 1234
     * $query->filterByMinutes(array(12, 34)); // WHERE minutes IN (12, 34)
     * $query->filterByMinutes(array('min' => 12)); // WHERE minutes > 12
     * </code>
     *
     * @param mixed $minutes The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMinutes($minutes = null, ?string $comparison = null)
    {
        if (is_array($minutes)) {
            $useMinMax = false;
            if (isset($minutes['min'])) {
                $this->addUsingAlias(EmployeeWorkLogTableMap::COL_MINUTES, $minutes['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($minutes['max'])) {
                $this->addUsingAlias(EmployeeWorkLogTableMap::COL_MINUTES, $minutes['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmployeeWorkLogTableMap::COL_MINUTES, $minutes, $comparison);

        return $this;
    }

    /**
     * Filter the query on the location column
     *
     * Example usage:
     * <code>
     * $query->filterByLocation('fooValue');   // WHERE location = 'fooValue'
     * $query->filterByLocation('%fooValue%', Criteria::LIKE); // WHERE location LIKE '%fooValue%'
     * $query->filterByLocation(['foo', 'bar']); // WHERE location IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $location The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLocation($location = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($location)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmployeeWorkLogTableMap::COL_LOCATION, $location, $comparison);

        return $this;
    }

    /**
     * Filter the query on the pin column
     *
     * Example usage:
     * <code>
     * $query->filterByPin('fooValue');   // WHERE pin = 'fooValue'
     * $query->filterByPin('%fooValue%', Criteria::LIKE); // WHERE pin LIKE '%fooValue%'
     * $query->filterByPin(['foo', 'bar']); // WHERE pin IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $pin The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPin($pin = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($pin)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmployeeWorkLogTableMap::COL_PIN, $pin, $comparison);

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
                $this->addUsingAlias(EmployeeWorkLogTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(EmployeeWorkLogTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmployeeWorkLogTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(EmployeeWorkLogTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(EmployeeWorkLogTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmployeeWorkLogTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \entities\Expenses object
     *
     * @param \entities\Expenses|ObjectCollection $expenses The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpenses($expenses, ?string $comparison = null)
    {
        if ($expenses instanceof \entities\Expenses) {
            return $this
                ->addUsingAlias(EmployeeWorkLogTableMap::COL_EXP_ID, $expenses->getExpId(), $comparison);
        } elseif ($expenses instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(EmployeeWorkLogTableMap::COL_EXP_ID, $expenses->toKeyValue('PrimaryKey', 'ExpId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByExpenses() only accepts arguments of type \entities\Expenses or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Expenses relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinExpenses(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Expenses');

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
            $this->addJoinObject($join, 'Expenses');
        }

        return $this;
    }

    /**
     * Use the Expenses relation Expenses object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\ExpensesQuery A secondary query class using the current class as primary query
     */
    public function useExpensesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinExpenses($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Expenses', '\entities\ExpensesQuery');
    }

    /**
     * Use the Expenses relation Expenses object
     *
     * @param callable(\entities\ExpensesQuery):\entities\ExpensesQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withExpensesQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useExpensesQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Expenses table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\ExpensesQuery The inner query object of the EXISTS statement
     */
    public function useExpensesExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\ExpensesQuery */
        $q = $this->useExistsQuery('Expenses', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Expenses table for a NOT EXISTS query.
     *
     * @see useExpensesExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\ExpensesQuery The inner query object of the NOT EXISTS statement
     */
    public function useExpensesNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\ExpensesQuery */
        $q = $this->useExistsQuery('Expenses', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Expenses table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\ExpensesQuery The inner query object of the IN statement
     */
    public function useInExpensesQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\ExpensesQuery */
        $q = $this->useInQuery('Expenses', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Expenses table for a NOT IN query.
     *
     * @see useExpensesInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\ExpensesQuery The inner query object of the NOT IN statement
     */
    public function useNotInExpensesQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\ExpensesQuery */
        $q = $this->useInQuery('Expenses', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildEmployeeWorkLog $employeeWorkLog Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($employeeWorkLog = null)
    {
        if ($employeeWorkLog) {
            $this->addUsingAlias(EmployeeWorkLogTableMap::COL_WORK_LOG_ID, $employeeWorkLog->getWorkLogId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the employee_work_log table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EmployeeWorkLogTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            EmployeeWorkLogTableMap::clearInstancePool();
            EmployeeWorkLogTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(EmployeeWorkLogTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(EmployeeWorkLogTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            EmployeeWorkLogTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            EmployeeWorkLogTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
