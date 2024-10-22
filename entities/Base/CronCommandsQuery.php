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
use entities\CronCommands as ChildCronCommands;
use entities\CronCommandsQuery as ChildCronCommandsQuery;
use entities\Map\CronCommandsTableMap;

/**
 * Base class that represents a query for the `cron_commands` table.
 *
 * @method     ChildCronCommandsQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildCronCommandsQuery orderByCommandKey($order = Criteria::ASC) Order by the command_key column
 * @method     ChildCronCommandsQuery orderByScheduleTime($order = Criteria::ASC) Order by the schedule_time column
 * @method     ChildCronCommandsQuery orderByIsActive($order = Criteria::ASC) Order by the is_active column
 * @method     ChildCronCommandsQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildCronCommandsQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildCronCommandsQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildCronCommandsQuery groupById() Group by the id column
 * @method     ChildCronCommandsQuery groupByCommandKey() Group by the command_key column
 * @method     ChildCronCommandsQuery groupByScheduleTime() Group by the schedule_time column
 * @method     ChildCronCommandsQuery groupByIsActive() Group by the is_active column
 * @method     ChildCronCommandsQuery groupByCompanyId() Group by the company_id column
 * @method     ChildCronCommandsQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildCronCommandsQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildCronCommandsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCronCommandsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCronCommandsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCronCommandsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildCronCommandsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildCronCommandsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildCronCommandsQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildCronCommandsQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildCronCommandsQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildCronCommandsQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildCronCommandsQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildCronCommandsQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildCronCommandsQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     ChildCronCommandsQuery leftJoinCronCommandLogs($relationAlias = null) Adds a LEFT JOIN clause to the query using the CronCommandLogs relation
 * @method     ChildCronCommandsQuery rightJoinCronCommandLogs($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CronCommandLogs relation
 * @method     ChildCronCommandsQuery innerJoinCronCommandLogs($relationAlias = null) Adds a INNER JOIN clause to the query using the CronCommandLogs relation
 *
 * @method     ChildCronCommandsQuery joinWithCronCommandLogs($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the CronCommandLogs relation
 *
 * @method     ChildCronCommandsQuery leftJoinWithCronCommandLogs() Adds a LEFT JOIN clause and with to the query using the CronCommandLogs relation
 * @method     ChildCronCommandsQuery rightJoinWithCronCommandLogs() Adds a RIGHT JOIN clause and with to the query using the CronCommandLogs relation
 * @method     ChildCronCommandsQuery innerJoinWithCronCommandLogs() Adds a INNER JOIN clause and with to the query using the CronCommandLogs relation
 *
 * @method     \entities\CompanyQuery|\entities\CronCommandLogsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildCronCommands|null findOne(?ConnectionInterface $con = null) Return the first ChildCronCommands matching the query
 * @method     ChildCronCommands findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildCronCommands matching the query, or a new ChildCronCommands object populated from the query conditions when no match is found
 *
 * @method     ChildCronCommands|null findOneById(int $id) Return the first ChildCronCommands filtered by the id column
 * @method     ChildCronCommands|null findOneByCommandKey(string $command_key) Return the first ChildCronCommands filtered by the command_key column
 * @method     ChildCronCommands|null findOneByScheduleTime(string $schedule_time) Return the first ChildCronCommands filtered by the schedule_time column
 * @method     ChildCronCommands|null findOneByIsActive(boolean $is_active) Return the first ChildCronCommands filtered by the is_active column
 * @method     ChildCronCommands|null findOneByCompanyId(int $company_id) Return the first ChildCronCommands filtered by the company_id column
 * @method     ChildCronCommands|null findOneByCreatedAt(string $created_at) Return the first ChildCronCommands filtered by the created_at column
 * @method     ChildCronCommands|null findOneByUpdatedAt(string $updated_at) Return the first ChildCronCommands filtered by the updated_at column
 *
 * @method     ChildCronCommands requirePk($key, ?ConnectionInterface $con = null) Return the ChildCronCommands by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCronCommands requireOne(?ConnectionInterface $con = null) Return the first ChildCronCommands matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCronCommands requireOneById(int $id) Return the first ChildCronCommands filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCronCommands requireOneByCommandKey(string $command_key) Return the first ChildCronCommands filtered by the command_key column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCronCommands requireOneByScheduleTime(string $schedule_time) Return the first ChildCronCommands filtered by the schedule_time column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCronCommands requireOneByIsActive(boolean $is_active) Return the first ChildCronCommands filtered by the is_active column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCronCommands requireOneByCompanyId(int $company_id) Return the first ChildCronCommands filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCronCommands requireOneByCreatedAt(string $created_at) Return the first ChildCronCommands filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCronCommands requireOneByUpdatedAt(string $updated_at) Return the first ChildCronCommands filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCronCommands[]|Collection find(?ConnectionInterface $con = null) Return ChildCronCommands objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildCronCommands> find(?ConnectionInterface $con = null) Return ChildCronCommands objects based on current ModelCriteria
 *
 * @method     ChildCronCommands[]|Collection findById(int|array<int> $id) Return ChildCronCommands objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildCronCommands> findById(int|array<int> $id) Return ChildCronCommands objects filtered by the id column
 * @method     ChildCronCommands[]|Collection findByCommandKey(string|array<string> $command_key) Return ChildCronCommands objects filtered by the command_key column
 * @psalm-method Collection&\Traversable<ChildCronCommands> findByCommandKey(string|array<string> $command_key) Return ChildCronCommands objects filtered by the command_key column
 * @method     ChildCronCommands[]|Collection findByScheduleTime(string|array<string> $schedule_time) Return ChildCronCommands objects filtered by the schedule_time column
 * @psalm-method Collection&\Traversable<ChildCronCommands> findByScheduleTime(string|array<string> $schedule_time) Return ChildCronCommands objects filtered by the schedule_time column
 * @method     ChildCronCommands[]|Collection findByIsActive(boolean|array<boolean> $is_active) Return ChildCronCommands objects filtered by the is_active column
 * @psalm-method Collection&\Traversable<ChildCronCommands> findByIsActive(boolean|array<boolean> $is_active) Return ChildCronCommands objects filtered by the is_active column
 * @method     ChildCronCommands[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildCronCommands objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildCronCommands> findByCompanyId(int|array<int> $company_id) Return ChildCronCommands objects filtered by the company_id column
 * @method     ChildCronCommands[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildCronCommands objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildCronCommands> findByCreatedAt(string|array<string> $created_at) Return ChildCronCommands objects filtered by the created_at column
 * @method     ChildCronCommands[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildCronCommands objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildCronCommands> findByUpdatedAt(string|array<string> $updated_at) Return ChildCronCommands objects filtered by the updated_at column
 *
 * @method     ChildCronCommands[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildCronCommands> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class CronCommandsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\CronCommandsQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\CronCommands', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCronCommandsQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCronCommandsQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildCronCommandsQuery) {
            return $criteria;
        }
        $query = new ChildCronCommandsQuery();
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
     * @return ChildCronCommands|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CronCommandsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = CronCommandsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildCronCommands A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, command_key, schedule_time, is_active, company_id, created_at, updated_at FROM cron_commands WHERE id = :p0';
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
            /** @var ChildCronCommands $obj */
            $obj = new ChildCronCommands();
            $obj->hydrate($row);
            CronCommandsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildCronCommands|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(CronCommandsTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(CronCommandsTableMap::COL_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(CronCommandsTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(CronCommandsTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CronCommandsTableMap::COL_ID, $id, $comparison);

        return $this;
    }

    /**
     * Filter the query on the command_key column
     *
     * Example usage:
     * <code>
     * $query->filterByCommandKey('fooValue');   // WHERE command_key = 'fooValue'
     * $query->filterByCommandKey('%fooValue%', Criteria::LIKE); // WHERE command_key LIKE '%fooValue%'
     * $query->filterByCommandKey(['foo', 'bar']); // WHERE command_key IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $commandKey The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCommandKey($commandKey = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($commandKey)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CronCommandsTableMap::COL_COMMAND_KEY, $commandKey, $comparison);

        return $this;
    }

    /**
     * Filter the query on the schedule_time column
     *
     * Example usage:
     * <code>
     * $query->filterByScheduleTime('2011-03-14'); // WHERE schedule_time = '2011-03-14'
     * $query->filterByScheduleTime('now'); // WHERE schedule_time = '2011-03-14'
     * $query->filterByScheduleTime(array('max' => 'yesterday')); // WHERE schedule_time > '2011-03-13'
     * </code>
     *
     * @param mixed $scheduleTime The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByScheduleTime($scheduleTime = null, ?string $comparison = null)
    {
        if (is_array($scheduleTime)) {
            $useMinMax = false;
            if (isset($scheduleTime['min'])) {
                $this->addUsingAlias(CronCommandsTableMap::COL_SCHEDULE_TIME, $scheduleTime['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($scheduleTime['max'])) {
                $this->addUsingAlias(CronCommandsTableMap::COL_SCHEDULE_TIME, $scheduleTime['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CronCommandsTableMap::COL_SCHEDULE_TIME, $scheduleTime, $comparison);

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

        $this->addUsingAlias(CronCommandsTableMap::COL_IS_ACTIVE, $isActive, $comparison);

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
                $this->addUsingAlias(CronCommandsTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(CronCommandsTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CronCommandsTableMap::COL_COMPANY_ID, $companyId, $comparison);

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
                $this->addUsingAlias(CronCommandsTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(CronCommandsTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CronCommandsTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(CronCommandsTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(CronCommandsTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CronCommandsTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

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
                ->addUsingAlias(CronCommandsTableMap::COL_COMPANY_ID, $company->getCompanyId(), $comparison);
        } elseif ($company instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(CronCommandsTableMap::COL_COMPANY_ID, $company->toKeyValue('PrimaryKey', 'CompanyId'), $comparison);

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
     * Filter the query by a related \entities\CronCommandLogs object
     *
     * @param \entities\CronCommandLogs|ObjectCollection $cronCommandLogs the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCronCommandLogs($cronCommandLogs, ?string $comparison = null)
    {
        if ($cronCommandLogs instanceof \entities\CronCommandLogs) {
            $this
                ->addUsingAlias(CronCommandsTableMap::COL_ID, $cronCommandLogs->getCronCommandId(), $comparison);

            return $this;
        } elseif ($cronCommandLogs instanceof ObjectCollection) {
            $this
                ->useCronCommandLogsQuery()
                ->filterByPrimaryKeys($cronCommandLogs->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByCronCommandLogs() only accepts arguments of type \entities\CronCommandLogs or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CronCommandLogs relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinCronCommandLogs(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CronCommandLogs');

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
            $this->addJoinObject($join, 'CronCommandLogs');
        }

        return $this;
    }

    /**
     * Use the CronCommandLogs relation CronCommandLogs object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\CronCommandLogsQuery A secondary query class using the current class as primary query
     */
    public function useCronCommandLogsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinCronCommandLogs($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CronCommandLogs', '\entities\CronCommandLogsQuery');
    }

    /**
     * Use the CronCommandLogs relation CronCommandLogs object
     *
     * @param callable(\entities\CronCommandLogsQuery):\entities\CronCommandLogsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withCronCommandLogsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useCronCommandLogsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to CronCommandLogs table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\CronCommandLogsQuery The inner query object of the EXISTS statement
     */
    public function useCronCommandLogsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\CronCommandLogsQuery */
        $q = $this->useExistsQuery('CronCommandLogs', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to CronCommandLogs table for a NOT EXISTS query.
     *
     * @see useCronCommandLogsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\CronCommandLogsQuery The inner query object of the NOT EXISTS statement
     */
    public function useCronCommandLogsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\CronCommandLogsQuery */
        $q = $this->useExistsQuery('CronCommandLogs', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to CronCommandLogs table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\CronCommandLogsQuery The inner query object of the IN statement
     */
    public function useInCronCommandLogsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\CronCommandLogsQuery */
        $q = $this->useInQuery('CronCommandLogs', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to CronCommandLogs table for a NOT IN query.
     *
     * @see useCronCommandLogsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\CronCommandLogsQuery The inner query object of the NOT IN statement
     */
    public function useNotInCronCommandLogsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\CronCommandLogsQuery */
        $q = $this->useInQuery('CronCommandLogs', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildCronCommands $cronCommands Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($cronCommands = null)
    {
        if ($cronCommands) {
            $this->addUsingAlias(CronCommandsTableMap::COL_ID, $cronCommands->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the cron_commands table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CronCommandsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CronCommandsTableMap::clearInstancePool();
            CronCommandsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(CronCommandsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CronCommandsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            CronCommandsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            CronCommandsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
