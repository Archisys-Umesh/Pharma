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
use entities\EmployeeLog as ChildEmployeeLog;
use entities\EmployeeLogQuery as ChildEmployeeLogQuery;
use entities\Map\EmployeeLogTableMap;

/**
 * Base class that represents a query for the `employee_log` table.
 *
 * @method     ChildEmployeeLogQuery orderByLogId($order = Criteria::ASC) Order by the log_id column
 * @method     ChildEmployeeLogQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 * @method     ChildEmployeeLogQuery orderByPin($order = Criteria::ASC) Order by the pin column
 * @method     ChildEmployeeLogQuery orderByDeviceName($order = Criteria::ASC) Order by the device_name column
 * @method     ChildEmployeeLogQuery orderByDeviceBattery($order = Criteria::ASC) Order by the device_battery column
 * @method     ChildEmployeeLogQuery orderByDeviceTime($order = Criteria::ASC) Order by the device_time column
 *
 * @method     ChildEmployeeLogQuery groupByLogId() Group by the log_id column
 * @method     ChildEmployeeLogQuery groupByUserId() Group by the user_id column
 * @method     ChildEmployeeLogQuery groupByPin() Group by the pin column
 * @method     ChildEmployeeLogQuery groupByDeviceName() Group by the device_name column
 * @method     ChildEmployeeLogQuery groupByDeviceBattery() Group by the device_battery column
 * @method     ChildEmployeeLogQuery groupByDeviceTime() Group by the device_time column
 *
 * @method     ChildEmployeeLogQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildEmployeeLogQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildEmployeeLogQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildEmployeeLogQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildEmployeeLogQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildEmployeeLogQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildEmployeeLogQuery leftJoinUsers($relationAlias = null) Adds a LEFT JOIN clause to the query using the Users relation
 * @method     ChildEmployeeLogQuery rightJoinUsers($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Users relation
 * @method     ChildEmployeeLogQuery innerJoinUsers($relationAlias = null) Adds a INNER JOIN clause to the query using the Users relation
 *
 * @method     ChildEmployeeLogQuery joinWithUsers($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Users relation
 *
 * @method     ChildEmployeeLogQuery leftJoinWithUsers() Adds a LEFT JOIN clause and with to the query using the Users relation
 * @method     ChildEmployeeLogQuery rightJoinWithUsers() Adds a RIGHT JOIN clause and with to the query using the Users relation
 * @method     ChildEmployeeLogQuery innerJoinWithUsers() Adds a INNER JOIN clause and with to the query using the Users relation
 *
 * @method     \entities\UsersQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildEmployeeLog|null findOne(?ConnectionInterface $con = null) Return the first ChildEmployeeLog matching the query
 * @method     ChildEmployeeLog findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildEmployeeLog matching the query, or a new ChildEmployeeLog object populated from the query conditions when no match is found
 *
 * @method     ChildEmployeeLog|null findOneByLogId(int $log_id) Return the first ChildEmployeeLog filtered by the log_id column
 * @method     ChildEmployeeLog|null findOneByUserId(int $user_id) Return the first ChildEmployeeLog filtered by the user_id column
 * @method     ChildEmployeeLog|null findOneByPin(string $pin) Return the first ChildEmployeeLog filtered by the pin column
 * @method     ChildEmployeeLog|null findOneByDeviceName(string $device_name) Return the first ChildEmployeeLog filtered by the device_name column
 * @method     ChildEmployeeLog|null findOneByDeviceBattery(string $device_battery) Return the first ChildEmployeeLog filtered by the device_battery column
 * @method     ChildEmployeeLog|null findOneByDeviceTime(string $device_time) Return the first ChildEmployeeLog filtered by the device_time column
 *
 * @method     ChildEmployeeLog requirePk($key, ?ConnectionInterface $con = null) Return the ChildEmployeeLog by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeeLog requireOne(?ConnectionInterface $con = null) Return the first ChildEmployeeLog matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEmployeeLog requireOneByLogId(int $log_id) Return the first ChildEmployeeLog filtered by the log_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeeLog requireOneByUserId(int $user_id) Return the first ChildEmployeeLog filtered by the user_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeeLog requireOneByPin(string $pin) Return the first ChildEmployeeLog filtered by the pin column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeeLog requireOneByDeviceName(string $device_name) Return the first ChildEmployeeLog filtered by the device_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeeLog requireOneByDeviceBattery(string $device_battery) Return the first ChildEmployeeLog filtered by the device_battery column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployeeLog requireOneByDeviceTime(string $device_time) Return the first ChildEmployeeLog filtered by the device_time column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEmployeeLog[]|Collection find(?ConnectionInterface $con = null) Return ChildEmployeeLog objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildEmployeeLog> find(?ConnectionInterface $con = null) Return ChildEmployeeLog objects based on current ModelCriteria
 *
 * @method     ChildEmployeeLog[]|Collection findByLogId(int|array<int> $log_id) Return ChildEmployeeLog objects filtered by the log_id column
 * @psalm-method Collection&\Traversable<ChildEmployeeLog> findByLogId(int|array<int> $log_id) Return ChildEmployeeLog objects filtered by the log_id column
 * @method     ChildEmployeeLog[]|Collection findByUserId(int|array<int> $user_id) Return ChildEmployeeLog objects filtered by the user_id column
 * @psalm-method Collection&\Traversable<ChildEmployeeLog> findByUserId(int|array<int> $user_id) Return ChildEmployeeLog objects filtered by the user_id column
 * @method     ChildEmployeeLog[]|Collection findByPin(string|array<string> $pin) Return ChildEmployeeLog objects filtered by the pin column
 * @psalm-method Collection&\Traversable<ChildEmployeeLog> findByPin(string|array<string> $pin) Return ChildEmployeeLog objects filtered by the pin column
 * @method     ChildEmployeeLog[]|Collection findByDeviceName(string|array<string> $device_name) Return ChildEmployeeLog objects filtered by the device_name column
 * @psalm-method Collection&\Traversable<ChildEmployeeLog> findByDeviceName(string|array<string> $device_name) Return ChildEmployeeLog objects filtered by the device_name column
 * @method     ChildEmployeeLog[]|Collection findByDeviceBattery(string|array<string> $device_battery) Return ChildEmployeeLog objects filtered by the device_battery column
 * @psalm-method Collection&\Traversable<ChildEmployeeLog> findByDeviceBattery(string|array<string> $device_battery) Return ChildEmployeeLog objects filtered by the device_battery column
 * @method     ChildEmployeeLog[]|Collection findByDeviceTime(string|array<string> $device_time) Return ChildEmployeeLog objects filtered by the device_time column
 * @psalm-method Collection&\Traversable<ChildEmployeeLog> findByDeviceTime(string|array<string> $device_time) Return ChildEmployeeLog objects filtered by the device_time column
 *
 * @method     ChildEmployeeLog[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildEmployeeLog> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class EmployeeLogQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\EmployeeLogQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\EmployeeLog', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildEmployeeLogQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildEmployeeLogQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildEmployeeLogQuery) {
            return $criteria;
        }
        $query = new ChildEmployeeLogQuery();
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
     * @return ChildEmployeeLog|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(EmployeeLogTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = EmployeeLogTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildEmployeeLog A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT log_id, user_id, pin, device_name, device_battery, device_time FROM employee_log WHERE log_id = :p0';
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
            /** @var ChildEmployeeLog $obj */
            $obj = new ChildEmployeeLog();
            $obj->hydrate($row);
            EmployeeLogTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildEmployeeLog|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(EmployeeLogTableMap::COL_LOG_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(EmployeeLogTableMap::COL_LOG_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(EmployeeLogTableMap::COL_LOG_ID, $logId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($logId['max'])) {
                $this->addUsingAlias(EmployeeLogTableMap::COL_LOG_ID, $logId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmployeeLogTableMap::COL_LOG_ID, $logId, $comparison);

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
                $this->addUsingAlias(EmployeeLogTableMap::COL_USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userId['max'])) {
                $this->addUsingAlias(EmployeeLogTableMap::COL_USER_ID, $userId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmployeeLogTableMap::COL_USER_ID, $userId, $comparison);

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

        $this->addUsingAlias(EmployeeLogTableMap::COL_PIN, $pin, $comparison);

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

        $this->addUsingAlias(EmployeeLogTableMap::COL_DEVICE_NAME, $deviceName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the device_battery column
     *
     * Example usage:
     * <code>
     * $query->filterByDeviceBattery('fooValue');   // WHERE device_battery = 'fooValue'
     * $query->filterByDeviceBattery('%fooValue%', Criteria::LIKE); // WHERE device_battery LIKE '%fooValue%'
     * $query->filterByDeviceBattery(['foo', 'bar']); // WHERE device_battery IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $deviceBattery The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDeviceBattery($deviceBattery = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($deviceBattery)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmployeeLogTableMap::COL_DEVICE_BATTERY, $deviceBattery, $comparison);

        return $this;
    }

    /**
     * Filter the query on the device_time column
     *
     * Example usage:
     * <code>
     * $query->filterByDeviceTime('2011-03-14'); // WHERE device_time = '2011-03-14'
     * $query->filterByDeviceTime('now'); // WHERE device_time = '2011-03-14'
     * $query->filterByDeviceTime(array('max' => 'yesterday')); // WHERE device_time > '2011-03-13'
     * </code>
     *
     * @param mixed $deviceTime The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDeviceTime($deviceTime = null, ?string $comparison = null)
    {
        if (is_array($deviceTime)) {
            $useMinMax = false;
            if (isset($deviceTime['min'])) {
                $this->addUsingAlias(EmployeeLogTableMap::COL_DEVICE_TIME, $deviceTime['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($deviceTime['max'])) {
                $this->addUsingAlias(EmployeeLogTableMap::COL_DEVICE_TIME, $deviceTime['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmployeeLogTableMap::COL_DEVICE_TIME, $deviceTime, $comparison);

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
                ->addUsingAlias(EmployeeLogTableMap::COL_USER_ID, $users->getUserId(), $comparison);
        } elseif ($users instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(EmployeeLogTableMap::COL_USER_ID, $users->toKeyValue('PrimaryKey', 'UserId'), $comparison);

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
    public function joinUsers(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
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
    public function useUsersQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
        ?string $joinType = Criteria::INNER_JOIN
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
     * @param ChildEmployeeLog $employeeLog Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($employeeLog = null)
    {
        if ($employeeLog) {
            $this->addUsingAlias(EmployeeLogTableMap::COL_LOG_ID, $employeeLog->getLogId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the employee_log table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EmployeeLogTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            EmployeeLogTableMap::clearInstancePool();
            EmployeeLogTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(EmployeeLogTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(EmployeeLogTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            EmployeeLogTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            EmployeeLogTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
