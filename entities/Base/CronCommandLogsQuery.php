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
use entities\CronCommandLogs as ChildCronCommandLogs;
use entities\CronCommandLogsQuery as ChildCronCommandLogsQuery;
use entities\Map\CronCommandLogsTableMap;

/**
 * Base class that represents a query for the `cron_command_logs` table.
 *
 * @method     ChildCronCommandLogsQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildCronCommandLogsQuery orderByCronCommandId($order = Criteria::ASC) Order by the cron_command_id column
 * @method     ChildCronCommandLogsQuery orderByDate($order = Criteria::ASC) Order by the date column
 * @method     ChildCronCommandLogsQuery orderByCommandKey($order = Criteria::ASC) Order by the command_key column
 * @method     ChildCronCommandLogsQuery orderByStartTime($order = Criteria::ASC) Order by the start_time column
 * @method     ChildCronCommandLogsQuery orderByEndTime($order = Criteria::ASC) Order by the end_time column
 * @method     ChildCronCommandLogsQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildCronCommandLogsQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildCronCommandLogsQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildCronCommandLogsQuery groupById() Group by the id column
 * @method     ChildCronCommandLogsQuery groupByCronCommandId() Group by the cron_command_id column
 * @method     ChildCronCommandLogsQuery groupByDate() Group by the date column
 * @method     ChildCronCommandLogsQuery groupByCommandKey() Group by the command_key column
 * @method     ChildCronCommandLogsQuery groupByStartTime() Group by the start_time column
 * @method     ChildCronCommandLogsQuery groupByEndTime() Group by the end_time column
 * @method     ChildCronCommandLogsQuery groupByCompanyId() Group by the company_id column
 * @method     ChildCronCommandLogsQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildCronCommandLogsQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildCronCommandLogsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCronCommandLogsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCronCommandLogsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCronCommandLogsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildCronCommandLogsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildCronCommandLogsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildCronCommandLogsQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildCronCommandLogsQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildCronCommandLogsQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildCronCommandLogsQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildCronCommandLogsQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildCronCommandLogsQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildCronCommandLogsQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     ChildCronCommandLogsQuery leftJoinCronCommands($relationAlias = null) Adds a LEFT JOIN clause to the query using the CronCommands relation
 * @method     ChildCronCommandLogsQuery rightJoinCronCommands($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CronCommands relation
 * @method     ChildCronCommandLogsQuery innerJoinCronCommands($relationAlias = null) Adds a INNER JOIN clause to the query using the CronCommands relation
 *
 * @method     ChildCronCommandLogsQuery joinWithCronCommands($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the CronCommands relation
 *
 * @method     ChildCronCommandLogsQuery leftJoinWithCronCommands() Adds a LEFT JOIN clause and with to the query using the CronCommands relation
 * @method     ChildCronCommandLogsQuery rightJoinWithCronCommands() Adds a RIGHT JOIN clause and with to the query using the CronCommands relation
 * @method     ChildCronCommandLogsQuery innerJoinWithCronCommands() Adds a INNER JOIN clause and with to the query using the CronCommands relation
 *
 * @method     \entities\CompanyQuery|\entities\CronCommandsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildCronCommandLogs|null findOne(?ConnectionInterface $con = null) Return the first ChildCronCommandLogs matching the query
 * @method     ChildCronCommandLogs findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildCronCommandLogs matching the query, or a new ChildCronCommandLogs object populated from the query conditions when no match is found
 *
 * @method     ChildCronCommandLogs|null findOneById(int $id) Return the first ChildCronCommandLogs filtered by the id column
 * @method     ChildCronCommandLogs|null findOneByCronCommandId(int $cron_command_id) Return the first ChildCronCommandLogs filtered by the cron_command_id column
 * @method     ChildCronCommandLogs|null findOneByDate(string $date) Return the first ChildCronCommandLogs filtered by the date column
 * @method     ChildCronCommandLogs|null findOneByCommandKey(string $command_key) Return the first ChildCronCommandLogs filtered by the command_key column
 * @method     ChildCronCommandLogs|null findOneByStartTime(string $start_time) Return the first ChildCronCommandLogs filtered by the start_time column
 * @method     ChildCronCommandLogs|null findOneByEndTime(string $end_time) Return the first ChildCronCommandLogs filtered by the end_time column
 * @method     ChildCronCommandLogs|null findOneByCompanyId(int $company_id) Return the first ChildCronCommandLogs filtered by the company_id column
 * @method     ChildCronCommandLogs|null findOneByCreatedAt(string $created_at) Return the first ChildCronCommandLogs filtered by the created_at column
 * @method     ChildCronCommandLogs|null findOneByUpdatedAt(string $updated_at) Return the first ChildCronCommandLogs filtered by the updated_at column
 *
 * @method     ChildCronCommandLogs requirePk($key, ?ConnectionInterface $con = null) Return the ChildCronCommandLogs by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCronCommandLogs requireOne(?ConnectionInterface $con = null) Return the first ChildCronCommandLogs matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCronCommandLogs requireOneById(int $id) Return the first ChildCronCommandLogs filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCronCommandLogs requireOneByCronCommandId(int $cron_command_id) Return the first ChildCronCommandLogs filtered by the cron_command_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCronCommandLogs requireOneByDate(string $date) Return the first ChildCronCommandLogs filtered by the date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCronCommandLogs requireOneByCommandKey(string $command_key) Return the first ChildCronCommandLogs filtered by the command_key column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCronCommandLogs requireOneByStartTime(string $start_time) Return the first ChildCronCommandLogs filtered by the start_time column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCronCommandLogs requireOneByEndTime(string $end_time) Return the first ChildCronCommandLogs filtered by the end_time column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCronCommandLogs requireOneByCompanyId(int $company_id) Return the first ChildCronCommandLogs filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCronCommandLogs requireOneByCreatedAt(string $created_at) Return the first ChildCronCommandLogs filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCronCommandLogs requireOneByUpdatedAt(string $updated_at) Return the first ChildCronCommandLogs filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCronCommandLogs[]|Collection find(?ConnectionInterface $con = null) Return ChildCronCommandLogs objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildCronCommandLogs> find(?ConnectionInterface $con = null) Return ChildCronCommandLogs objects based on current ModelCriteria
 *
 * @method     ChildCronCommandLogs[]|Collection findById(int|array<int> $id) Return ChildCronCommandLogs objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildCronCommandLogs> findById(int|array<int> $id) Return ChildCronCommandLogs objects filtered by the id column
 * @method     ChildCronCommandLogs[]|Collection findByCronCommandId(int|array<int> $cron_command_id) Return ChildCronCommandLogs objects filtered by the cron_command_id column
 * @psalm-method Collection&\Traversable<ChildCronCommandLogs> findByCronCommandId(int|array<int> $cron_command_id) Return ChildCronCommandLogs objects filtered by the cron_command_id column
 * @method     ChildCronCommandLogs[]|Collection findByDate(string|array<string> $date) Return ChildCronCommandLogs objects filtered by the date column
 * @psalm-method Collection&\Traversable<ChildCronCommandLogs> findByDate(string|array<string> $date) Return ChildCronCommandLogs objects filtered by the date column
 * @method     ChildCronCommandLogs[]|Collection findByCommandKey(string|array<string> $command_key) Return ChildCronCommandLogs objects filtered by the command_key column
 * @psalm-method Collection&\Traversable<ChildCronCommandLogs> findByCommandKey(string|array<string> $command_key) Return ChildCronCommandLogs objects filtered by the command_key column
 * @method     ChildCronCommandLogs[]|Collection findByStartTime(string|array<string> $start_time) Return ChildCronCommandLogs objects filtered by the start_time column
 * @psalm-method Collection&\Traversable<ChildCronCommandLogs> findByStartTime(string|array<string> $start_time) Return ChildCronCommandLogs objects filtered by the start_time column
 * @method     ChildCronCommandLogs[]|Collection findByEndTime(string|array<string> $end_time) Return ChildCronCommandLogs objects filtered by the end_time column
 * @psalm-method Collection&\Traversable<ChildCronCommandLogs> findByEndTime(string|array<string> $end_time) Return ChildCronCommandLogs objects filtered by the end_time column
 * @method     ChildCronCommandLogs[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildCronCommandLogs objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildCronCommandLogs> findByCompanyId(int|array<int> $company_id) Return ChildCronCommandLogs objects filtered by the company_id column
 * @method     ChildCronCommandLogs[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildCronCommandLogs objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildCronCommandLogs> findByCreatedAt(string|array<string> $created_at) Return ChildCronCommandLogs objects filtered by the created_at column
 * @method     ChildCronCommandLogs[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildCronCommandLogs objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildCronCommandLogs> findByUpdatedAt(string|array<string> $updated_at) Return ChildCronCommandLogs objects filtered by the updated_at column
 *
 * @method     ChildCronCommandLogs[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildCronCommandLogs> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class CronCommandLogsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\CronCommandLogsQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\CronCommandLogs', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCronCommandLogsQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCronCommandLogsQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildCronCommandLogsQuery) {
            return $criteria;
        }
        $query = new ChildCronCommandLogsQuery();
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
     * @return ChildCronCommandLogs|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CronCommandLogsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = CronCommandLogsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildCronCommandLogs A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, cron_command_id, date, command_key, start_time, end_time, company_id, created_at, updated_at FROM cron_command_logs WHERE id = :p0';
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
            /** @var ChildCronCommandLogs $obj */
            $obj = new ChildCronCommandLogs();
            $obj->hydrate($row);
            CronCommandLogsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildCronCommandLogs|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(CronCommandLogsTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(CronCommandLogsTableMap::COL_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(CronCommandLogsTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(CronCommandLogsTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CronCommandLogsTableMap::COL_ID, $id, $comparison);

        return $this;
    }

    /**
     * Filter the query on the cron_command_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCronCommandId(1234); // WHERE cron_command_id = 1234
     * $query->filterByCronCommandId(array(12, 34)); // WHERE cron_command_id IN (12, 34)
     * $query->filterByCronCommandId(array('min' => 12)); // WHERE cron_command_id > 12
     * </code>
     *
     * @see       filterByCronCommands()
     *
     * @param mixed $cronCommandId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCronCommandId($cronCommandId = null, ?string $comparison = null)
    {
        if (is_array($cronCommandId)) {
            $useMinMax = false;
            if (isset($cronCommandId['min'])) {
                $this->addUsingAlias(CronCommandLogsTableMap::COL_CRON_COMMAND_ID, $cronCommandId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($cronCommandId['max'])) {
                $this->addUsingAlias(CronCommandLogsTableMap::COL_CRON_COMMAND_ID, $cronCommandId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CronCommandLogsTableMap::COL_CRON_COMMAND_ID, $cronCommandId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the date column
     *
     * Example usage:
     * <code>
     * $query->filterByDate('2011-03-14'); // WHERE date = '2011-03-14'
     * $query->filterByDate('now'); // WHERE date = '2011-03-14'
     * $query->filterByDate(array('max' => 'yesterday')); // WHERE date > '2011-03-13'
     * </code>
     *
     * @param mixed $date The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDate($date = null, ?string $comparison = null)
    {
        if (is_array($date)) {
            $useMinMax = false;
            if (isset($date['min'])) {
                $this->addUsingAlias(CronCommandLogsTableMap::COL_DATE, $date['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($date['max'])) {
                $this->addUsingAlias(CronCommandLogsTableMap::COL_DATE, $date['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CronCommandLogsTableMap::COL_DATE, $date, $comparison);

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

        $this->addUsingAlias(CronCommandLogsTableMap::COL_COMMAND_KEY, $commandKey, $comparison);

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
                $this->addUsingAlias(CronCommandLogsTableMap::COL_START_TIME, $startTime['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($startTime['max'])) {
                $this->addUsingAlias(CronCommandLogsTableMap::COL_START_TIME, $startTime['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CronCommandLogsTableMap::COL_START_TIME, $startTime, $comparison);

        return $this;
    }

    /**
     * Filter the query on the end_time column
     *
     * Example usage:
     * <code>
     * $query->filterByEndTime('2011-03-14'); // WHERE end_time = '2011-03-14'
     * $query->filterByEndTime('now'); // WHERE end_time = '2011-03-14'
     * $query->filterByEndTime(array('max' => 'yesterday')); // WHERE end_time > '2011-03-13'
     * </code>
     *
     * @param mixed $endTime The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEndTime($endTime = null, ?string $comparison = null)
    {
        if (is_array($endTime)) {
            $useMinMax = false;
            if (isset($endTime['min'])) {
                $this->addUsingAlias(CronCommandLogsTableMap::COL_END_TIME, $endTime['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($endTime['max'])) {
                $this->addUsingAlias(CronCommandLogsTableMap::COL_END_TIME, $endTime['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CronCommandLogsTableMap::COL_END_TIME, $endTime, $comparison);

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
                $this->addUsingAlias(CronCommandLogsTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(CronCommandLogsTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CronCommandLogsTableMap::COL_COMPANY_ID, $companyId, $comparison);

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
                $this->addUsingAlias(CronCommandLogsTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(CronCommandLogsTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CronCommandLogsTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(CronCommandLogsTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(CronCommandLogsTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CronCommandLogsTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

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
                ->addUsingAlias(CronCommandLogsTableMap::COL_COMPANY_ID, $company->getCompanyId(), $comparison);
        } elseif ($company instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(CronCommandLogsTableMap::COL_COMPANY_ID, $company->toKeyValue('PrimaryKey', 'CompanyId'), $comparison);

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
     * Filter the query by a related \entities\CronCommands object
     *
     * @param \entities\CronCommands|ObjectCollection $cronCommands The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCronCommands($cronCommands, ?string $comparison = null)
    {
        if ($cronCommands instanceof \entities\CronCommands) {
            return $this
                ->addUsingAlias(CronCommandLogsTableMap::COL_CRON_COMMAND_ID, $cronCommands->getId(), $comparison);
        } elseif ($cronCommands instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(CronCommandLogsTableMap::COL_CRON_COMMAND_ID, $cronCommands->toKeyValue('PrimaryKey', 'Id'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByCronCommands() only accepts arguments of type \entities\CronCommands or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CronCommands relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinCronCommands(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CronCommands');

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
            $this->addJoinObject($join, 'CronCommands');
        }

        return $this;
    }

    /**
     * Use the CronCommands relation CronCommands object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\CronCommandsQuery A secondary query class using the current class as primary query
     */
    public function useCronCommandsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinCronCommands($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CronCommands', '\entities\CronCommandsQuery');
    }

    /**
     * Use the CronCommands relation CronCommands object
     *
     * @param callable(\entities\CronCommandsQuery):\entities\CronCommandsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withCronCommandsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useCronCommandsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to CronCommands table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\CronCommandsQuery The inner query object of the EXISTS statement
     */
    public function useCronCommandsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\CronCommandsQuery */
        $q = $this->useExistsQuery('CronCommands', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to CronCommands table for a NOT EXISTS query.
     *
     * @see useCronCommandsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\CronCommandsQuery The inner query object of the NOT EXISTS statement
     */
    public function useCronCommandsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\CronCommandsQuery */
        $q = $this->useExistsQuery('CronCommands', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to CronCommands table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\CronCommandsQuery The inner query object of the IN statement
     */
    public function useInCronCommandsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\CronCommandsQuery */
        $q = $this->useInQuery('CronCommands', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to CronCommands table for a NOT IN query.
     *
     * @see useCronCommandsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\CronCommandsQuery The inner query object of the NOT IN statement
     */
    public function useNotInCronCommandsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\CronCommandsQuery */
        $q = $this->useInQuery('CronCommands', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildCronCommandLogs $cronCommandLogs Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($cronCommandLogs = null)
    {
        if ($cronCommandLogs) {
            $this->addUsingAlias(CronCommandLogsTableMap::COL_ID, $cronCommandLogs->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the cron_command_logs table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CronCommandLogsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CronCommandLogsTableMap::clearInstancePool();
            CronCommandLogsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(CronCommandLogsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CronCommandLogsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            CronCommandLogsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            CronCommandLogsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
