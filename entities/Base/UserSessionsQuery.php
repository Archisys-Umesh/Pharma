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
use entities\UserSessions as ChildUserSessions;
use entities\UserSessionsQuery as ChildUserSessionsQuery;
use entities\Map\UserSessionsTableMap;

/**
 * Base class that represents a query for the `user_sessions` table.
 *
 * @method     ChildUserSessionsQuery orderBySessionId($order = Criteria::ASC) Order by the session_id column
 * @method     ChildUserSessionsQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 * @method     ChildUserSessionsQuery orderBySessionToken($order = Criteria::ASC) Order by the session_token column
 * @method     ChildUserSessionsQuery orderByIpAddress($order = Criteria::ASC) Order by the ip_address column
 * @method     ChildUserSessionsQuery orderByDevice($order = Criteria::ASC) Order by the device column
 * @method     ChildUserSessionsQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildUserSessionsQuery orderByFcmToken($order = Criteria::ASC) Order by the fcm_token column
 * @method     ChildUserSessionsQuery orderByDeviceName($order = Criteria::ASC) Order by the device_name column
 * @method     ChildUserSessionsQuery orderByAppVersion($order = Criteria::ASC) Order by the app_version column
 * @method     ChildUserSessionsQuery orderByAction($order = Criteria::ASC) Order by the action column
 * @method     ChildUserSessionsQuery orderByActivityTime($order = Criteria::ASC) Order by the activity_time column
 *
 * @method     ChildUserSessionsQuery groupBySessionId() Group by the session_id column
 * @method     ChildUserSessionsQuery groupByUserId() Group by the user_id column
 * @method     ChildUserSessionsQuery groupBySessionToken() Group by the session_token column
 * @method     ChildUserSessionsQuery groupByIpAddress() Group by the ip_address column
 * @method     ChildUserSessionsQuery groupByDevice() Group by the device column
 * @method     ChildUserSessionsQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildUserSessionsQuery groupByFcmToken() Group by the fcm_token column
 * @method     ChildUserSessionsQuery groupByDeviceName() Group by the device_name column
 * @method     ChildUserSessionsQuery groupByAppVersion() Group by the app_version column
 * @method     ChildUserSessionsQuery groupByAction() Group by the action column
 * @method     ChildUserSessionsQuery groupByActivityTime() Group by the activity_time column
 *
 * @method     ChildUserSessionsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildUserSessionsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildUserSessionsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildUserSessionsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildUserSessionsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildUserSessionsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildUserSessionsQuery leftJoinUsers($relationAlias = null) Adds a LEFT JOIN clause to the query using the Users relation
 * @method     ChildUserSessionsQuery rightJoinUsers($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Users relation
 * @method     ChildUserSessionsQuery innerJoinUsers($relationAlias = null) Adds a INNER JOIN clause to the query using the Users relation
 *
 * @method     ChildUserSessionsQuery joinWithUsers($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Users relation
 *
 * @method     ChildUserSessionsQuery leftJoinWithUsers() Adds a LEFT JOIN clause and with to the query using the Users relation
 * @method     ChildUserSessionsQuery rightJoinWithUsers() Adds a RIGHT JOIN clause and with to the query using the Users relation
 * @method     ChildUserSessionsQuery innerJoinWithUsers() Adds a INNER JOIN clause and with to the query using the Users relation
 *
 * @method     \entities\UsersQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildUserSessions|null findOne(?ConnectionInterface $con = null) Return the first ChildUserSessions matching the query
 * @method     ChildUserSessions findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildUserSessions matching the query, or a new ChildUserSessions object populated from the query conditions when no match is found
 *
 * @method     ChildUserSessions|null findOneBySessionId(int $session_id) Return the first ChildUserSessions filtered by the session_id column
 * @method     ChildUserSessions|null findOneByUserId(int $user_id) Return the first ChildUserSessions filtered by the user_id column
 * @method     ChildUserSessions|null findOneBySessionToken(string $session_token) Return the first ChildUserSessions filtered by the session_token column
 * @method     ChildUserSessions|null findOneByIpAddress(string $ip_address) Return the first ChildUserSessions filtered by the ip_address column
 * @method     ChildUserSessions|null findOneByDevice(string $device) Return the first ChildUserSessions filtered by the device column
 * @method     ChildUserSessions|null findOneByCreatedAt(string $created_at) Return the first ChildUserSessions filtered by the created_at column
 * @method     ChildUserSessions|null findOneByFcmToken(string $fcm_token) Return the first ChildUserSessions filtered by the fcm_token column
 * @method     ChildUserSessions|null findOneByDeviceName(string $device_name) Return the first ChildUserSessions filtered by the device_name column
 * @method     ChildUserSessions|null findOneByAppVersion(string $app_version) Return the first ChildUserSessions filtered by the app_version column
 * @method     ChildUserSessions|null findOneByAction(string $action) Return the first ChildUserSessions filtered by the action column
 * @method     ChildUserSessions|null findOneByActivityTime(string $activity_time) Return the first ChildUserSessions filtered by the activity_time column
 *
 * @method     ChildUserSessions requirePk($key, ?ConnectionInterface $con = null) Return the ChildUserSessions by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserSessions requireOne(?ConnectionInterface $con = null) Return the first ChildUserSessions matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUserSessions requireOneBySessionId(int $session_id) Return the first ChildUserSessions filtered by the session_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserSessions requireOneByUserId(int $user_id) Return the first ChildUserSessions filtered by the user_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserSessions requireOneBySessionToken(string $session_token) Return the first ChildUserSessions filtered by the session_token column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserSessions requireOneByIpAddress(string $ip_address) Return the first ChildUserSessions filtered by the ip_address column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserSessions requireOneByDevice(string $device) Return the first ChildUserSessions filtered by the device column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserSessions requireOneByCreatedAt(string $created_at) Return the first ChildUserSessions filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserSessions requireOneByFcmToken(string $fcm_token) Return the first ChildUserSessions filtered by the fcm_token column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserSessions requireOneByDeviceName(string $device_name) Return the first ChildUserSessions filtered by the device_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserSessions requireOneByAppVersion(string $app_version) Return the first ChildUserSessions filtered by the app_version column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserSessions requireOneByAction(string $action) Return the first ChildUserSessions filtered by the action column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserSessions requireOneByActivityTime(string $activity_time) Return the first ChildUserSessions filtered by the activity_time column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUserSessions[]|Collection find(?ConnectionInterface $con = null) Return ChildUserSessions objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildUserSessions> find(?ConnectionInterface $con = null) Return ChildUserSessions objects based on current ModelCriteria
 *
 * @method     ChildUserSessions[]|Collection findBySessionId(int|array<int> $session_id) Return ChildUserSessions objects filtered by the session_id column
 * @psalm-method Collection&\Traversable<ChildUserSessions> findBySessionId(int|array<int> $session_id) Return ChildUserSessions objects filtered by the session_id column
 * @method     ChildUserSessions[]|Collection findByUserId(int|array<int> $user_id) Return ChildUserSessions objects filtered by the user_id column
 * @psalm-method Collection&\Traversable<ChildUserSessions> findByUserId(int|array<int> $user_id) Return ChildUserSessions objects filtered by the user_id column
 * @method     ChildUserSessions[]|Collection findBySessionToken(string|array<string> $session_token) Return ChildUserSessions objects filtered by the session_token column
 * @psalm-method Collection&\Traversable<ChildUserSessions> findBySessionToken(string|array<string> $session_token) Return ChildUserSessions objects filtered by the session_token column
 * @method     ChildUserSessions[]|Collection findByIpAddress(string|array<string> $ip_address) Return ChildUserSessions objects filtered by the ip_address column
 * @psalm-method Collection&\Traversable<ChildUserSessions> findByIpAddress(string|array<string> $ip_address) Return ChildUserSessions objects filtered by the ip_address column
 * @method     ChildUserSessions[]|Collection findByDevice(string|array<string> $device) Return ChildUserSessions objects filtered by the device column
 * @psalm-method Collection&\Traversable<ChildUserSessions> findByDevice(string|array<string> $device) Return ChildUserSessions objects filtered by the device column
 * @method     ChildUserSessions[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildUserSessions objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildUserSessions> findByCreatedAt(string|array<string> $created_at) Return ChildUserSessions objects filtered by the created_at column
 * @method     ChildUserSessions[]|Collection findByFcmToken(string|array<string> $fcm_token) Return ChildUserSessions objects filtered by the fcm_token column
 * @psalm-method Collection&\Traversable<ChildUserSessions> findByFcmToken(string|array<string> $fcm_token) Return ChildUserSessions objects filtered by the fcm_token column
 * @method     ChildUserSessions[]|Collection findByDeviceName(string|array<string> $device_name) Return ChildUserSessions objects filtered by the device_name column
 * @psalm-method Collection&\Traversable<ChildUserSessions> findByDeviceName(string|array<string> $device_name) Return ChildUserSessions objects filtered by the device_name column
 * @method     ChildUserSessions[]|Collection findByAppVersion(string|array<string> $app_version) Return ChildUserSessions objects filtered by the app_version column
 * @psalm-method Collection&\Traversable<ChildUserSessions> findByAppVersion(string|array<string> $app_version) Return ChildUserSessions objects filtered by the app_version column
 * @method     ChildUserSessions[]|Collection findByAction(string|array<string> $action) Return ChildUserSessions objects filtered by the action column
 * @psalm-method Collection&\Traversable<ChildUserSessions> findByAction(string|array<string> $action) Return ChildUserSessions objects filtered by the action column
 * @method     ChildUserSessions[]|Collection findByActivityTime(string|array<string> $activity_time) Return ChildUserSessions objects filtered by the activity_time column
 * @psalm-method Collection&\Traversable<ChildUserSessions> findByActivityTime(string|array<string> $activity_time) Return ChildUserSessions objects filtered by the activity_time column
 *
 * @method     ChildUserSessions[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildUserSessions> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class UserSessionsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\UserSessionsQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\UserSessions', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildUserSessionsQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildUserSessionsQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildUserSessionsQuery) {
            return $criteria;
        }
        $query = new ChildUserSessionsQuery();
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
     * @return ChildUserSessions|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(UserSessionsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = UserSessionsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildUserSessions A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT session_id, user_id, session_token, ip_address, device, created_at, fcm_token, device_name, app_version, action, activity_time FROM user_sessions WHERE session_id = :p0';
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
            /** @var ChildUserSessions $obj */
            $obj = new ChildUserSessions();
            $obj->hydrate($row);
            UserSessionsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildUserSessions|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(UserSessionsTableMap::COL_SESSION_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(UserSessionsTableMap::COL_SESSION_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the session_id column
     *
     * Example usage:
     * <code>
     * $query->filterBySessionId(1234); // WHERE session_id = 1234
     * $query->filterBySessionId(array(12, 34)); // WHERE session_id IN (12, 34)
     * $query->filterBySessionId(array('min' => 12)); // WHERE session_id > 12
     * </code>
     *
     * @param mixed $sessionId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySessionId($sessionId = null, ?string $comparison = null)
    {
        if (is_array($sessionId)) {
            $useMinMax = false;
            if (isset($sessionId['min'])) {
                $this->addUsingAlias(UserSessionsTableMap::COL_SESSION_ID, $sessionId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($sessionId['max'])) {
                $this->addUsingAlias(UserSessionsTableMap::COL_SESSION_ID, $sessionId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UserSessionsTableMap::COL_SESSION_ID, $sessionId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the user_id column
     *
     * Example usage:
     * <code>
     * $query->filterByUserId(1234); // WHERE user_id = 1234
     * $query->filterByUserId(array(12, 34)); // WHERE user_id IN (12, 34)
     * $query->filterByUserId(array('min' => 12)); // WHERE user_id > 12
     * </code>
     *
     * @see       filterByUsers()
     *
     * @param mixed $userId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUserId($userId = null, ?string $comparison = null)
    {
        if (is_array($userId)) {
            $useMinMax = false;
            if (isset($userId['min'])) {
                $this->addUsingAlias(UserSessionsTableMap::COL_USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userId['max'])) {
                $this->addUsingAlias(UserSessionsTableMap::COL_USER_ID, $userId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UserSessionsTableMap::COL_USER_ID, $userId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the session_token column
     *
     * Example usage:
     * <code>
     * $query->filterBySessionToken('fooValue');   // WHERE session_token = 'fooValue'
     * $query->filterBySessionToken('%fooValue%', Criteria::LIKE); // WHERE session_token LIKE '%fooValue%'
     * $query->filterBySessionToken(['foo', 'bar']); // WHERE session_token IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $sessionToken The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySessionToken($sessionToken = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($sessionToken)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UserSessionsTableMap::COL_SESSION_TOKEN, $sessionToken, $comparison);

        return $this;
    }

    /**
     * Filter the query on the ip_address column
     *
     * Example usage:
     * <code>
     * $query->filterByIpAddress('fooValue');   // WHERE ip_address = 'fooValue'
     * $query->filterByIpAddress('%fooValue%', Criteria::LIKE); // WHERE ip_address LIKE '%fooValue%'
     * $query->filterByIpAddress(['foo', 'bar']); // WHERE ip_address IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $ipAddress The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIpAddress($ipAddress = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($ipAddress)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UserSessionsTableMap::COL_IP_ADDRESS, $ipAddress, $comparison);

        return $this;
    }

    /**
     * Filter the query on the device column
     *
     * Example usage:
     * <code>
     * $query->filterByDevice('fooValue');   // WHERE device = 'fooValue'
     * $query->filterByDevice('%fooValue%', Criteria::LIKE); // WHERE device LIKE '%fooValue%'
     * $query->filterByDevice(['foo', 'bar']); // WHERE device IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $device The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDevice($device = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($device)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UserSessionsTableMap::COL_DEVICE, $device, $comparison);

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
                $this->addUsingAlias(UserSessionsTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(UserSessionsTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UserSessionsTableMap::COL_CREATED_AT, $createdAt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the fcm_token column
     *
     * Example usage:
     * <code>
     * $query->filterByFcmToken('fooValue');   // WHERE fcm_token = 'fooValue'
     * $query->filterByFcmToken('%fooValue%', Criteria::LIKE); // WHERE fcm_token LIKE '%fooValue%'
     * $query->filterByFcmToken(['foo', 'bar']); // WHERE fcm_token IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $fcmToken The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFcmToken($fcmToken = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fcmToken)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UserSessionsTableMap::COL_FCM_TOKEN, $fcmToken, $comparison);

        return $this;
    }

    /**
     * Filter the query on the device_name column
     *
     * Example usage:
     * <code>
     * $query->filterByDeviceName('fooValue');   // WHERE device_name = 'fooValue'
     * $query->filterByDeviceName('%fooValue%', Criteria::LIKE); // WHERE device_name LIKE '%fooValue%'
     * $query->filterByDeviceName(['foo', 'bar']); // WHERE device_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $deviceName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDeviceName($deviceName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($deviceName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UserSessionsTableMap::COL_DEVICE_NAME, $deviceName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the app_version column
     *
     * Example usage:
     * <code>
     * $query->filterByAppVersion('fooValue');   // WHERE app_version = 'fooValue'
     * $query->filterByAppVersion('%fooValue%', Criteria::LIKE); // WHERE app_version LIKE '%fooValue%'
     * $query->filterByAppVersion(['foo', 'bar']); // WHERE app_version IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $appVersion The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAppVersion($appVersion = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($appVersion)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UserSessionsTableMap::COL_APP_VERSION, $appVersion, $comparison);

        return $this;
    }

    /**
     * Filter the query on the action column
     *
     * Example usage:
     * <code>
     * $query->filterByAction('fooValue');   // WHERE action = 'fooValue'
     * $query->filterByAction('%fooValue%', Criteria::LIKE); // WHERE action LIKE '%fooValue%'
     * $query->filterByAction(['foo', 'bar']); // WHERE action IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $action The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAction($action = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($action)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UserSessionsTableMap::COL_ACTION, $action, $comparison);

        return $this;
    }

    /**
     * Filter the query on the activity_time column
     *
     * Example usage:
     * <code>
     * $query->filterByActivityTime('2011-03-14'); // WHERE activity_time = '2011-03-14'
     * $query->filterByActivityTime('now'); // WHERE activity_time = '2011-03-14'
     * $query->filterByActivityTime(array('max' => 'yesterday')); // WHERE activity_time > '2011-03-13'
     * </code>
     *
     * @param mixed $activityTime The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByActivityTime($activityTime = null, ?string $comparison = null)
    {
        if (is_array($activityTime)) {
            $useMinMax = false;
            if (isset($activityTime['min'])) {
                $this->addUsingAlias(UserSessionsTableMap::COL_ACTIVITY_TIME, $activityTime['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($activityTime['max'])) {
                $this->addUsingAlias(UserSessionsTableMap::COL_ACTIVITY_TIME, $activityTime['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UserSessionsTableMap::COL_ACTIVITY_TIME, $activityTime, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \entities\Users object
     *
     * @param \entities\Users|ObjectCollection $users The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUsers($users, ?string $comparison = null)
    {
        if ($users instanceof \entities\Users) {
            return $this
                ->addUsingAlias(UserSessionsTableMap::COL_USER_ID, $users->getUserId(), $comparison);
        } elseif ($users instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(UserSessionsTableMap::COL_USER_ID, $users->toKeyValue('PrimaryKey', 'UserId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByUsers() only accepts arguments of type \entities\Users or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Users relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinUsers(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Users');

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
            $this->addJoinObject($join, 'Users');
        }

        return $this;
    }

    /**
     * Use the Users relation Users object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\UsersQuery A secondary query class using the current class as primary query
     */
    public function useUsersQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinUsers($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Users', '\entities\UsersQuery');
    }

    /**
     * Use the Users relation Users object
     *
     * @param callable(\entities\UsersQuery):\entities\UsersQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withUsersQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useUsersQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Users table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\UsersQuery The inner query object of the EXISTS statement
     */
    public function useUsersExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\UsersQuery */
        $q = $this->useExistsQuery('Users', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Users table for a NOT EXISTS query.
     *
     * @see useUsersExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\UsersQuery The inner query object of the NOT EXISTS statement
     */
    public function useUsersNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\UsersQuery */
        $q = $this->useExistsQuery('Users', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Users table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\UsersQuery The inner query object of the IN statement
     */
    public function useInUsersQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\UsersQuery */
        $q = $this->useInQuery('Users', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Users table for a NOT IN query.
     *
     * @see useUsersInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\UsersQuery The inner query object of the NOT IN statement
     */
    public function useNotInUsersQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\UsersQuery */
        $q = $this->useInQuery('Users', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildUserSessions $userSessions Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($userSessions = null)
    {
        if ($userSessions) {
            $this->addUsingAlias(UserSessionsTableMap::COL_SESSION_ID, $userSessions->getSessionId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the user_sessions table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UserSessionsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            UserSessionsTableMap::clearInstancePool();
            UserSessionsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(UserSessionsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(UserSessionsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            UserSessionsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            UserSessionsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
