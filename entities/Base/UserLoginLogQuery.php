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
use entities\UserLoginLog as ChildUserLoginLog;
use entities\UserLoginLogQuery as ChildUserLoginLogQuery;
use entities\Map\UserLoginLogTableMap;

/**
 * Base class that represents a query for the `user_login_log` table.
 *
 * @method     ChildUserLoginLogQuery orderByLogId($order = Criteria::ASC) Order by the log_id column
 * @method     ChildUserLoginLogQuery orderByTimestamp($order = Criteria::ASC) Order by the timestamp column
 * @method     ChildUserLoginLogQuery orderByUserName($order = Criteria::ASC) Order by the user_name column
 * @method     ChildUserLoginLogQuery orderByIp($order = Criteria::ASC) Order by the ip column
 * @method     ChildUserLoginLogQuery orderByBrowser($order = Criteria::ASC) Order by the browser column
 * @method     ChildUserLoginLogQuery orderByStatus($order = Criteria::ASC) Order by the status column
 *
 * @method     ChildUserLoginLogQuery groupByLogId() Group by the log_id column
 * @method     ChildUserLoginLogQuery groupByTimestamp() Group by the timestamp column
 * @method     ChildUserLoginLogQuery groupByUserName() Group by the user_name column
 * @method     ChildUserLoginLogQuery groupByIp() Group by the ip column
 * @method     ChildUserLoginLogQuery groupByBrowser() Group by the browser column
 * @method     ChildUserLoginLogQuery groupByStatus() Group by the status column
 *
 * @method     ChildUserLoginLogQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildUserLoginLogQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildUserLoginLogQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildUserLoginLogQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildUserLoginLogQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildUserLoginLogQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildUserLoginLog|null findOne(?ConnectionInterface $con = null) Return the first ChildUserLoginLog matching the query
 * @method     ChildUserLoginLog findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildUserLoginLog matching the query, or a new ChildUserLoginLog object populated from the query conditions when no match is found
 *
 * @method     ChildUserLoginLog|null findOneByLogId(int $log_id) Return the first ChildUserLoginLog filtered by the log_id column
 * @method     ChildUserLoginLog|null findOneByTimestamp(string $timestamp) Return the first ChildUserLoginLog filtered by the timestamp column
 * @method     ChildUserLoginLog|null findOneByUserName(string $user_name) Return the first ChildUserLoginLog filtered by the user_name column
 * @method     ChildUserLoginLog|null findOneByIp(string $ip) Return the first ChildUserLoginLog filtered by the ip column
 * @method     ChildUserLoginLog|null findOneByBrowser(string $browser) Return the first ChildUserLoginLog filtered by the browser column
 * @method     ChildUserLoginLog|null findOneByStatus(string $status) Return the first ChildUserLoginLog filtered by the status column
 *
 * @method     ChildUserLoginLog requirePk($key, ?ConnectionInterface $con = null) Return the ChildUserLoginLog by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserLoginLog requireOne(?ConnectionInterface $con = null) Return the first ChildUserLoginLog matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUserLoginLog requireOneByLogId(int $log_id) Return the first ChildUserLoginLog filtered by the log_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserLoginLog requireOneByTimestamp(string $timestamp) Return the first ChildUserLoginLog filtered by the timestamp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserLoginLog requireOneByUserName(string $user_name) Return the first ChildUserLoginLog filtered by the user_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserLoginLog requireOneByIp(string $ip) Return the first ChildUserLoginLog filtered by the ip column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserLoginLog requireOneByBrowser(string $browser) Return the first ChildUserLoginLog filtered by the browser column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserLoginLog requireOneByStatus(string $status) Return the first ChildUserLoginLog filtered by the status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUserLoginLog[]|Collection find(?ConnectionInterface $con = null) Return ChildUserLoginLog objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildUserLoginLog> find(?ConnectionInterface $con = null) Return ChildUserLoginLog objects based on current ModelCriteria
 *
 * @method     ChildUserLoginLog[]|Collection findByLogId(int|array<int> $log_id) Return ChildUserLoginLog objects filtered by the log_id column
 * @psalm-method Collection&\Traversable<ChildUserLoginLog> findByLogId(int|array<int> $log_id) Return ChildUserLoginLog objects filtered by the log_id column
 * @method     ChildUserLoginLog[]|Collection findByTimestamp(string|array<string> $timestamp) Return ChildUserLoginLog objects filtered by the timestamp column
 * @psalm-method Collection&\Traversable<ChildUserLoginLog> findByTimestamp(string|array<string> $timestamp) Return ChildUserLoginLog objects filtered by the timestamp column
 * @method     ChildUserLoginLog[]|Collection findByUserName(string|array<string> $user_name) Return ChildUserLoginLog objects filtered by the user_name column
 * @psalm-method Collection&\Traversable<ChildUserLoginLog> findByUserName(string|array<string> $user_name) Return ChildUserLoginLog objects filtered by the user_name column
 * @method     ChildUserLoginLog[]|Collection findByIp(string|array<string> $ip) Return ChildUserLoginLog objects filtered by the ip column
 * @psalm-method Collection&\Traversable<ChildUserLoginLog> findByIp(string|array<string> $ip) Return ChildUserLoginLog objects filtered by the ip column
 * @method     ChildUserLoginLog[]|Collection findByBrowser(string|array<string> $browser) Return ChildUserLoginLog objects filtered by the browser column
 * @psalm-method Collection&\Traversable<ChildUserLoginLog> findByBrowser(string|array<string> $browser) Return ChildUserLoginLog objects filtered by the browser column
 * @method     ChildUserLoginLog[]|Collection findByStatus(string|array<string> $status) Return ChildUserLoginLog objects filtered by the status column
 * @psalm-method Collection&\Traversable<ChildUserLoginLog> findByStatus(string|array<string> $status) Return ChildUserLoginLog objects filtered by the status column
 *
 * @method     ChildUserLoginLog[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildUserLoginLog> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class UserLoginLogQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\UserLoginLogQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\UserLoginLog', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildUserLoginLogQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildUserLoginLogQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildUserLoginLogQuery) {
            return $criteria;
        }
        $query = new ChildUserLoginLogQuery();
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
     * @return ChildUserLoginLog|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(UserLoginLogTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = UserLoginLogTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildUserLoginLog A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT log_id, timestamp, user_name, ip, browser, status FROM user_login_log WHERE log_id = :p0';
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
            /** @var ChildUserLoginLog $obj */
            $obj = new ChildUserLoginLog();
            $obj->hydrate($row);
            UserLoginLogTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildUserLoginLog|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(UserLoginLogTableMap::COL_LOG_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(UserLoginLogTableMap::COL_LOG_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the log_id column
     *
     * Example usage:
     * <code>
     * $query->filterByLogId(1234); // WHERE log_id = 1234
     * $query->filterByLogId(array(12, 34)); // WHERE log_id IN (12, 34)
     * $query->filterByLogId(array('min' => 12)); // WHERE log_id > 12
     * </code>
     *
     * @param mixed $logId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLogId($logId = null, ?string $comparison = null)
    {
        if (is_array($logId)) {
            $useMinMax = false;
            if (isset($logId['min'])) {
                $this->addUsingAlias(UserLoginLogTableMap::COL_LOG_ID, $logId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($logId['max'])) {
                $this->addUsingAlias(UserLoginLogTableMap::COL_LOG_ID, $logId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UserLoginLogTableMap::COL_LOG_ID, $logId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the timestamp column
     *
     * Example usage:
     * <code>
     * $query->filterByTimestamp(1234); // WHERE timestamp = 1234
     * $query->filterByTimestamp(array(12, 34)); // WHERE timestamp IN (12, 34)
     * $query->filterByTimestamp(array('min' => 12)); // WHERE timestamp > 12
     * </code>
     *
     * @param mixed $timestamp The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTimestamp($timestamp = null, ?string $comparison = null)
    {
        if (is_array($timestamp)) {
            $useMinMax = false;
            if (isset($timestamp['min'])) {
                $this->addUsingAlias(UserLoginLogTableMap::COL_TIMESTAMP, $timestamp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($timestamp['max'])) {
                $this->addUsingAlias(UserLoginLogTableMap::COL_TIMESTAMP, $timestamp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UserLoginLogTableMap::COL_TIMESTAMP, $timestamp, $comparison);

        return $this;
    }

    /**
     * Filter the query on the user_name column
     *
     * Example usage:
     * <code>
     * $query->filterByUserName('fooValue');   // WHERE user_name = 'fooValue'
     * $query->filterByUserName('%fooValue%', Criteria::LIKE); // WHERE user_name LIKE '%fooValue%'
     * $query->filterByUserName(['foo', 'bar']); // WHERE user_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $userName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUserName($userName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($userName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UserLoginLogTableMap::COL_USER_NAME, $userName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the ip column
     *
     * Example usage:
     * <code>
     * $query->filterByIp('fooValue');   // WHERE ip = 'fooValue'
     * $query->filterByIp('%fooValue%', Criteria::LIKE); // WHERE ip LIKE '%fooValue%'
     * $query->filterByIp(['foo', 'bar']); // WHERE ip IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $ip The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIp($ip = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($ip)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UserLoginLogTableMap::COL_IP, $ip, $comparison);

        return $this;
    }

    /**
     * Filter the query on the browser column
     *
     * Example usage:
     * <code>
     * $query->filterByBrowser('fooValue');   // WHERE browser = 'fooValue'
     * $query->filterByBrowser('%fooValue%', Criteria::LIKE); // WHERE browser LIKE '%fooValue%'
     * $query->filterByBrowser(['foo', 'bar']); // WHERE browser IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $browser The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBrowser($browser = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($browser)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UserLoginLogTableMap::COL_BROWSER, $browser, $comparison);

        return $this;
    }

    /**
     * Filter the query on the status column
     *
     * Example usage:
     * <code>
     * $query->filterByStatus('fooValue');   // WHERE status = 'fooValue'
     * $query->filterByStatus('%fooValue%', Criteria::LIKE); // WHERE status LIKE '%fooValue%'
     * $query->filterByStatus(['foo', 'bar']); // WHERE status IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $status The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStatus($status = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($status)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UserLoginLogTableMap::COL_STATUS, $status, $comparison);

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildUserLoginLog $userLoginLog Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($userLoginLog = null)
    {
        if ($userLoginLog) {
            $this->addUsingAlias(UserLoginLogTableMap::COL_LOG_ID, $userLoginLog->getLogId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the user_login_log table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UserLoginLogTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            UserLoginLogTableMap::clearInstancePool();
            UserLoginLogTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(UserLoginLogTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(UserLoginLogTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            UserLoginLogTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            UserLoginLogTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
