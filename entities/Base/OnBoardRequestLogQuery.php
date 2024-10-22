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
use entities\OnBoardRequestLog as ChildOnBoardRequestLog;
use entities\OnBoardRequestLogQuery as ChildOnBoardRequestLogQuery;
use entities\Map\OnBoardRequestLogTableMap;

/**
 * Base class that represents a query for the `on_board_request_log` table.
 *
 * @method     ChildOnBoardRequestLogQuery orderByOnBoardRequestLogId($order = Criteria::ASC) Order by the on_board_request_log_id column
 * @method     ChildOnBoardRequestLogQuery orderByOnBoardRequestId($order = Criteria::ASC) Order by the on_board_request_id column
 * @method     ChildOnBoardRequestLogQuery orderByOnBoardRequestFromStatusId($order = Criteria::ASC) Order by the on_board_request_from_status_id column
 * @method     ChildOnBoardRequestLogQuery orderByOnBoardRequestToStatusId($order = Criteria::ASC) Order by the on_board_request_to_status_id column
 * @method     ChildOnBoardRequestLogQuery orderByEmployeeId($order = Criteria::ASC) Order by the employee_id column
 * @method     ChildOnBoardRequestLogQuery orderByEmployeePositionId($order = Criteria::ASC) Order by the employee_position_id column
 * @method     ChildOnBoardRequestLogQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ChildOnBoardRequestLogQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 *
 * @method     ChildOnBoardRequestLogQuery groupByOnBoardRequestLogId() Group by the on_board_request_log_id column
 * @method     ChildOnBoardRequestLogQuery groupByOnBoardRequestId() Group by the on_board_request_id column
 * @method     ChildOnBoardRequestLogQuery groupByOnBoardRequestFromStatusId() Group by the on_board_request_from_status_id column
 * @method     ChildOnBoardRequestLogQuery groupByOnBoardRequestToStatusId() Group by the on_board_request_to_status_id column
 * @method     ChildOnBoardRequestLogQuery groupByEmployeeId() Group by the employee_id column
 * @method     ChildOnBoardRequestLogQuery groupByEmployeePositionId() Group by the employee_position_id column
 * @method     ChildOnBoardRequestLogQuery groupByDescription() Group by the description column
 * @method     ChildOnBoardRequestLogQuery groupByCreatedAt() Group by the created_at column
 *
 * @method     ChildOnBoardRequestLogQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildOnBoardRequestLogQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildOnBoardRequestLogQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildOnBoardRequestLogQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildOnBoardRequestLogQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildOnBoardRequestLogQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildOnBoardRequestLogQuery leftJoinEmployee($relationAlias = null) Adds a LEFT JOIN clause to the query using the Employee relation
 * @method     ChildOnBoardRequestLogQuery rightJoinEmployee($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Employee relation
 * @method     ChildOnBoardRequestLogQuery innerJoinEmployee($relationAlias = null) Adds a INNER JOIN clause to the query using the Employee relation
 *
 * @method     ChildOnBoardRequestLogQuery joinWithEmployee($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Employee relation
 *
 * @method     ChildOnBoardRequestLogQuery leftJoinWithEmployee() Adds a LEFT JOIN clause and with to the query using the Employee relation
 * @method     ChildOnBoardRequestLogQuery rightJoinWithEmployee() Adds a RIGHT JOIN clause and with to the query using the Employee relation
 * @method     ChildOnBoardRequestLogQuery innerJoinWithEmployee() Adds a INNER JOIN clause and with to the query using the Employee relation
 *
 * @method     ChildOnBoardRequestLogQuery leftJoinPositions($relationAlias = null) Adds a LEFT JOIN clause to the query using the Positions relation
 * @method     ChildOnBoardRequestLogQuery rightJoinPositions($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Positions relation
 * @method     ChildOnBoardRequestLogQuery innerJoinPositions($relationAlias = null) Adds a INNER JOIN clause to the query using the Positions relation
 *
 * @method     ChildOnBoardRequestLogQuery joinWithPositions($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Positions relation
 *
 * @method     ChildOnBoardRequestLogQuery leftJoinWithPositions() Adds a LEFT JOIN clause and with to the query using the Positions relation
 * @method     ChildOnBoardRequestLogQuery rightJoinWithPositions() Adds a RIGHT JOIN clause and with to the query using the Positions relation
 * @method     ChildOnBoardRequestLogQuery innerJoinWithPositions() Adds a INNER JOIN clause and with to the query using the Positions relation
 *
 * @method     ChildOnBoardRequestLogQuery leftJoinOnBoardRequest($relationAlias = null) Adds a LEFT JOIN clause to the query using the OnBoardRequest relation
 * @method     ChildOnBoardRequestLogQuery rightJoinOnBoardRequest($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OnBoardRequest relation
 * @method     ChildOnBoardRequestLogQuery innerJoinOnBoardRequest($relationAlias = null) Adds a INNER JOIN clause to the query using the OnBoardRequest relation
 *
 * @method     ChildOnBoardRequestLogQuery joinWithOnBoardRequest($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OnBoardRequest relation
 *
 * @method     ChildOnBoardRequestLogQuery leftJoinWithOnBoardRequest() Adds a LEFT JOIN clause and with to the query using the OnBoardRequest relation
 * @method     ChildOnBoardRequestLogQuery rightJoinWithOnBoardRequest() Adds a RIGHT JOIN clause and with to the query using the OnBoardRequest relation
 * @method     ChildOnBoardRequestLogQuery innerJoinWithOnBoardRequest() Adds a INNER JOIN clause and with to the query using the OnBoardRequest relation
 *
 * @method     \entities\EmployeeQuery|\entities\PositionsQuery|\entities\OnBoardRequestQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildOnBoardRequestLog|null findOne(?ConnectionInterface $con = null) Return the first ChildOnBoardRequestLog matching the query
 * @method     ChildOnBoardRequestLog findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildOnBoardRequestLog matching the query, or a new ChildOnBoardRequestLog object populated from the query conditions when no match is found
 *
 * @method     ChildOnBoardRequestLog|null findOneByOnBoardRequestLogId(int $on_board_request_log_id) Return the first ChildOnBoardRequestLog filtered by the on_board_request_log_id column
 * @method     ChildOnBoardRequestLog|null findOneByOnBoardRequestId(int $on_board_request_id) Return the first ChildOnBoardRequestLog filtered by the on_board_request_id column
 * @method     ChildOnBoardRequestLog|null findOneByOnBoardRequestFromStatusId(int $on_board_request_from_status_id) Return the first ChildOnBoardRequestLog filtered by the on_board_request_from_status_id column
 * @method     ChildOnBoardRequestLog|null findOneByOnBoardRequestToStatusId(int $on_board_request_to_status_id) Return the first ChildOnBoardRequestLog filtered by the on_board_request_to_status_id column
 * @method     ChildOnBoardRequestLog|null findOneByEmployeeId(int $employee_id) Return the first ChildOnBoardRequestLog filtered by the employee_id column
 * @method     ChildOnBoardRequestLog|null findOneByEmployeePositionId(int $employee_position_id) Return the first ChildOnBoardRequestLog filtered by the employee_position_id column
 * @method     ChildOnBoardRequestLog|null findOneByDescription(string $description) Return the first ChildOnBoardRequestLog filtered by the description column
 * @method     ChildOnBoardRequestLog|null findOneByCreatedAt(string $created_at) Return the first ChildOnBoardRequestLog filtered by the created_at column
 *
 * @method     ChildOnBoardRequestLog requirePk($key, ?ConnectionInterface $con = null) Return the ChildOnBoardRequestLog by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnBoardRequestLog requireOne(?ConnectionInterface $con = null) Return the first ChildOnBoardRequestLog matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOnBoardRequestLog requireOneByOnBoardRequestLogId(int $on_board_request_log_id) Return the first ChildOnBoardRequestLog filtered by the on_board_request_log_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnBoardRequestLog requireOneByOnBoardRequestId(int $on_board_request_id) Return the first ChildOnBoardRequestLog filtered by the on_board_request_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnBoardRequestLog requireOneByOnBoardRequestFromStatusId(int $on_board_request_from_status_id) Return the first ChildOnBoardRequestLog filtered by the on_board_request_from_status_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnBoardRequestLog requireOneByOnBoardRequestToStatusId(int $on_board_request_to_status_id) Return the first ChildOnBoardRequestLog filtered by the on_board_request_to_status_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnBoardRequestLog requireOneByEmployeeId(int $employee_id) Return the first ChildOnBoardRequestLog filtered by the employee_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnBoardRequestLog requireOneByEmployeePositionId(int $employee_position_id) Return the first ChildOnBoardRequestLog filtered by the employee_position_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnBoardRequestLog requireOneByDescription(string $description) Return the first ChildOnBoardRequestLog filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnBoardRequestLog requireOneByCreatedAt(string $created_at) Return the first ChildOnBoardRequestLog filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOnBoardRequestLog[]|Collection find(?ConnectionInterface $con = null) Return ChildOnBoardRequestLog objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildOnBoardRequestLog> find(?ConnectionInterface $con = null) Return ChildOnBoardRequestLog objects based on current ModelCriteria
 *
 * @method     ChildOnBoardRequestLog[]|Collection findByOnBoardRequestLogId(int|array<int> $on_board_request_log_id) Return ChildOnBoardRequestLog objects filtered by the on_board_request_log_id column
 * @psalm-method Collection&\Traversable<ChildOnBoardRequestLog> findByOnBoardRequestLogId(int|array<int> $on_board_request_log_id) Return ChildOnBoardRequestLog objects filtered by the on_board_request_log_id column
 * @method     ChildOnBoardRequestLog[]|Collection findByOnBoardRequestId(int|array<int> $on_board_request_id) Return ChildOnBoardRequestLog objects filtered by the on_board_request_id column
 * @psalm-method Collection&\Traversable<ChildOnBoardRequestLog> findByOnBoardRequestId(int|array<int> $on_board_request_id) Return ChildOnBoardRequestLog objects filtered by the on_board_request_id column
 * @method     ChildOnBoardRequestLog[]|Collection findByOnBoardRequestFromStatusId(int|array<int> $on_board_request_from_status_id) Return ChildOnBoardRequestLog objects filtered by the on_board_request_from_status_id column
 * @psalm-method Collection&\Traversable<ChildOnBoardRequestLog> findByOnBoardRequestFromStatusId(int|array<int> $on_board_request_from_status_id) Return ChildOnBoardRequestLog objects filtered by the on_board_request_from_status_id column
 * @method     ChildOnBoardRequestLog[]|Collection findByOnBoardRequestToStatusId(int|array<int> $on_board_request_to_status_id) Return ChildOnBoardRequestLog objects filtered by the on_board_request_to_status_id column
 * @psalm-method Collection&\Traversable<ChildOnBoardRequestLog> findByOnBoardRequestToStatusId(int|array<int> $on_board_request_to_status_id) Return ChildOnBoardRequestLog objects filtered by the on_board_request_to_status_id column
 * @method     ChildOnBoardRequestLog[]|Collection findByEmployeeId(int|array<int> $employee_id) Return ChildOnBoardRequestLog objects filtered by the employee_id column
 * @psalm-method Collection&\Traversable<ChildOnBoardRequestLog> findByEmployeeId(int|array<int> $employee_id) Return ChildOnBoardRequestLog objects filtered by the employee_id column
 * @method     ChildOnBoardRequestLog[]|Collection findByEmployeePositionId(int|array<int> $employee_position_id) Return ChildOnBoardRequestLog objects filtered by the employee_position_id column
 * @psalm-method Collection&\Traversable<ChildOnBoardRequestLog> findByEmployeePositionId(int|array<int> $employee_position_id) Return ChildOnBoardRequestLog objects filtered by the employee_position_id column
 * @method     ChildOnBoardRequestLog[]|Collection findByDescription(string|array<string> $description) Return ChildOnBoardRequestLog objects filtered by the description column
 * @psalm-method Collection&\Traversable<ChildOnBoardRequestLog> findByDescription(string|array<string> $description) Return ChildOnBoardRequestLog objects filtered by the description column
 * @method     ChildOnBoardRequestLog[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildOnBoardRequestLog objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildOnBoardRequestLog> findByCreatedAt(string|array<string> $created_at) Return ChildOnBoardRequestLog objects filtered by the created_at column
 *
 * @method     ChildOnBoardRequestLog[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildOnBoardRequestLog> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class OnBoardRequestLogQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\OnBoardRequestLogQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\OnBoardRequestLog', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildOnBoardRequestLogQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildOnBoardRequestLogQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildOnBoardRequestLogQuery) {
            return $criteria;
        }
        $query = new ChildOnBoardRequestLogQuery();
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
     * @return ChildOnBoardRequestLog|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(OnBoardRequestLogTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = OnBoardRequestLogTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildOnBoardRequestLog A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT on_board_request_log_id, on_board_request_id, on_board_request_from_status_id, on_board_request_to_status_id, employee_id, employee_position_id, description, created_at FROM on_board_request_log WHERE on_board_request_log_id = :p0';
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
            /** @var ChildOnBoardRequestLog $obj */
            $obj = new ChildOnBoardRequestLog();
            $obj->hydrate($row);
            OnBoardRequestLogTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildOnBoardRequestLog|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(OnBoardRequestLogTableMap::COL_ON_BOARD_REQUEST_LOG_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(OnBoardRequestLogTableMap::COL_ON_BOARD_REQUEST_LOG_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the on_board_request_log_id column
     *
     * Example usage:
     * <code>
     * $query->filterByOnBoardRequestLogId(1234); // WHERE on_board_request_log_id = 1234
     * $query->filterByOnBoardRequestLogId(array(12, 34)); // WHERE on_board_request_log_id IN (12, 34)
     * $query->filterByOnBoardRequestLogId(array('min' => 12)); // WHERE on_board_request_log_id > 12
     * </code>
     *
     * @param mixed $onBoardRequestLogId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOnBoardRequestLogId($onBoardRequestLogId = null, ?string $comparison = null)
    {
        if (is_array($onBoardRequestLogId)) {
            $useMinMax = false;
            if (isset($onBoardRequestLogId['min'])) {
                $this->addUsingAlias(OnBoardRequestLogTableMap::COL_ON_BOARD_REQUEST_LOG_ID, $onBoardRequestLogId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($onBoardRequestLogId['max'])) {
                $this->addUsingAlias(OnBoardRequestLogTableMap::COL_ON_BOARD_REQUEST_LOG_ID, $onBoardRequestLogId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnBoardRequestLogTableMap::COL_ON_BOARD_REQUEST_LOG_ID, $onBoardRequestLogId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the on_board_request_id column
     *
     * Example usage:
     * <code>
     * $query->filterByOnBoardRequestId(1234); // WHERE on_board_request_id = 1234
     * $query->filterByOnBoardRequestId(array(12, 34)); // WHERE on_board_request_id IN (12, 34)
     * $query->filterByOnBoardRequestId(array('min' => 12)); // WHERE on_board_request_id > 12
     * </code>
     *
     * @see       filterByOnBoardRequest()
     *
     * @param mixed $onBoardRequestId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOnBoardRequestId($onBoardRequestId = null, ?string $comparison = null)
    {
        if (is_array($onBoardRequestId)) {
            $useMinMax = false;
            if (isset($onBoardRequestId['min'])) {
                $this->addUsingAlias(OnBoardRequestLogTableMap::COL_ON_BOARD_REQUEST_ID, $onBoardRequestId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($onBoardRequestId['max'])) {
                $this->addUsingAlias(OnBoardRequestLogTableMap::COL_ON_BOARD_REQUEST_ID, $onBoardRequestId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnBoardRequestLogTableMap::COL_ON_BOARD_REQUEST_ID, $onBoardRequestId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the on_board_request_from_status_id column
     *
     * Example usage:
     * <code>
     * $query->filterByOnBoardRequestFromStatusId(1234); // WHERE on_board_request_from_status_id = 1234
     * $query->filterByOnBoardRequestFromStatusId(array(12, 34)); // WHERE on_board_request_from_status_id IN (12, 34)
     * $query->filterByOnBoardRequestFromStatusId(array('min' => 12)); // WHERE on_board_request_from_status_id > 12
     * </code>
     *
     * @param mixed $onBoardRequestFromStatusId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOnBoardRequestFromStatusId($onBoardRequestFromStatusId = null, ?string $comparison = null)
    {
        if (is_array($onBoardRequestFromStatusId)) {
            $useMinMax = false;
            if (isset($onBoardRequestFromStatusId['min'])) {
                $this->addUsingAlias(OnBoardRequestLogTableMap::COL_ON_BOARD_REQUEST_FROM_STATUS_ID, $onBoardRequestFromStatusId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($onBoardRequestFromStatusId['max'])) {
                $this->addUsingAlias(OnBoardRequestLogTableMap::COL_ON_BOARD_REQUEST_FROM_STATUS_ID, $onBoardRequestFromStatusId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnBoardRequestLogTableMap::COL_ON_BOARD_REQUEST_FROM_STATUS_ID, $onBoardRequestFromStatusId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the on_board_request_to_status_id column
     *
     * Example usage:
     * <code>
     * $query->filterByOnBoardRequestToStatusId(1234); // WHERE on_board_request_to_status_id = 1234
     * $query->filterByOnBoardRequestToStatusId(array(12, 34)); // WHERE on_board_request_to_status_id IN (12, 34)
     * $query->filterByOnBoardRequestToStatusId(array('min' => 12)); // WHERE on_board_request_to_status_id > 12
     * </code>
     *
     * @param mixed $onBoardRequestToStatusId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOnBoardRequestToStatusId($onBoardRequestToStatusId = null, ?string $comparison = null)
    {
        if (is_array($onBoardRequestToStatusId)) {
            $useMinMax = false;
            if (isset($onBoardRequestToStatusId['min'])) {
                $this->addUsingAlias(OnBoardRequestLogTableMap::COL_ON_BOARD_REQUEST_TO_STATUS_ID, $onBoardRequestToStatusId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($onBoardRequestToStatusId['max'])) {
                $this->addUsingAlias(OnBoardRequestLogTableMap::COL_ON_BOARD_REQUEST_TO_STATUS_ID, $onBoardRequestToStatusId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnBoardRequestLogTableMap::COL_ON_BOARD_REQUEST_TO_STATUS_ID, $onBoardRequestToStatusId, $comparison);

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
                $this->addUsingAlias(OnBoardRequestLogTableMap::COL_EMPLOYEE_ID, $employeeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($employeeId['max'])) {
                $this->addUsingAlias(OnBoardRequestLogTableMap::COL_EMPLOYEE_ID, $employeeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnBoardRequestLogTableMap::COL_EMPLOYEE_ID, $employeeId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the employee_position_id column
     *
     * Example usage:
     * <code>
     * $query->filterByEmployeePositionId(1234); // WHERE employee_position_id = 1234
     * $query->filterByEmployeePositionId(array(12, 34)); // WHERE employee_position_id IN (12, 34)
     * $query->filterByEmployeePositionId(array('min' => 12)); // WHERE employee_position_id > 12
     * </code>
     *
     * @see       filterByPositions()
     *
     * @param mixed $employeePositionId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmployeePositionId($employeePositionId = null, ?string $comparison = null)
    {
        if (is_array($employeePositionId)) {
            $useMinMax = false;
            if (isset($employeePositionId['min'])) {
                $this->addUsingAlias(OnBoardRequestLogTableMap::COL_EMPLOYEE_POSITION_ID, $employeePositionId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($employeePositionId['max'])) {
                $this->addUsingAlias(OnBoardRequestLogTableMap::COL_EMPLOYEE_POSITION_ID, $employeePositionId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnBoardRequestLogTableMap::COL_EMPLOYEE_POSITION_ID, $employeePositionId, $comparison);

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

        $this->addUsingAlias(OnBoardRequestLogTableMap::COL_DESCRIPTION, $description, $comparison);

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
                $this->addUsingAlias(OnBoardRequestLogTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(OnBoardRequestLogTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnBoardRequestLogTableMap::COL_CREATED_AT, $createdAt, $comparison);

        return $this;
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
                ->addUsingAlias(OnBoardRequestLogTableMap::COL_EMPLOYEE_ID, $employee->getEmployeeId(), $comparison);
        } elseif ($employee instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(OnBoardRequestLogTableMap::COL_EMPLOYEE_ID, $employee->toKeyValue('PrimaryKey', 'EmployeeId'), $comparison);

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
     * Filter the query by a related \entities\Positions object
     *
     * @param \entities\Positions|ObjectCollection $positions The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPositions($positions, ?string $comparison = null)
    {
        if ($positions instanceof \entities\Positions) {
            return $this
                ->addUsingAlias(OnBoardRequestLogTableMap::COL_EMPLOYEE_POSITION_ID, $positions->getPositionId(), $comparison);
        } elseif ($positions instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(OnBoardRequestLogTableMap::COL_EMPLOYEE_POSITION_ID, $positions->toKeyValue('PrimaryKey', 'PositionId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByPositions() only accepts arguments of type \entities\Positions or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Positions relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinPositions(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Positions');

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
            $this->addJoinObject($join, 'Positions');
        }

        return $this;
    }

    /**
     * Use the Positions relation Positions object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\PositionsQuery A secondary query class using the current class as primary query
     */
    public function usePositionsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinPositions($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Positions', '\entities\PositionsQuery');
    }

    /**
     * Use the Positions relation Positions object
     *
     * @param callable(\entities\PositionsQuery):\entities\PositionsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withPositionsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->usePositionsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Positions table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\PositionsQuery The inner query object of the EXISTS statement
     */
    public function usePositionsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\PositionsQuery */
        $q = $this->useExistsQuery('Positions', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Positions table for a NOT EXISTS query.
     *
     * @see usePositionsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\PositionsQuery The inner query object of the NOT EXISTS statement
     */
    public function usePositionsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\PositionsQuery */
        $q = $this->useExistsQuery('Positions', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Positions table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\PositionsQuery The inner query object of the IN statement
     */
    public function useInPositionsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\PositionsQuery */
        $q = $this->useInQuery('Positions', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Positions table for a NOT IN query.
     *
     * @see usePositionsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\PositionsQuery The inner query object of the NOT IN statement
     */
    public function useNotInPositionsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\PositionsQuery */
        $q = $this->useInQuery('Positions', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\OnBoardRequest object
     *
     * @param \entities\OnBoardRequest|ObjectCollection $onBoardRequest The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOnBoardRequest($onBoardRequest, ?string $comparison = null)
    {
        if ($onBoardRequest instanceof \entities\OnBoardRequest) {
            return $this
                ->addUsingAlias(OnBoardRequestLogTableMap::COL_ON_BOARD_REQUEST_ID, $onBoardRequest->getOnBoardRequestId(), $comparison);
        } elseif ($onBoardRequest instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(OnBoardRequestLogTableMap::COL_ON_BOARD_REQUEST_ID, $onBoardRequest->toKeyValue('PrimaryKey', 'OnBoardRequestId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByOnBoardRequest() only accepts arguments of type \entities\OnBoardRequest or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OnBoardRequest relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOnBoardRequest(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OnBoardRequest');

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
            $this->addJoinObject($join, 'OnBoardRequest');
        }

        return $this;
    }

    /**
     * Use the OnBoardRequest relation OnBoardRequest object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\OnBoardRequestQuery A secondary query class using the current class as primary query
     */
    public function useOnBoardRequestQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinOnBoardRequest($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OnBoardRequest', '\entities\OnBoardRequestQuery');
    }

    /**
     * Use the OnBoardRequest relation OnBoardRequest object
     *
     * @param callable(\entities\OnBoardRequestQuery):\entities\OnBoardRequestQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOnBoardRequestQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useOnBoardRequestQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to OnBoardRequest table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\OnBoardRequestQuery The inner query object of the EXISTS statement
     */
    public function useOnBoardRequestExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\OnBoardRequestQuery */
        $q = $this->useExistsQuery('OnBoardRequest', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to OnBoardRequest table for a NOT EXISTS query.
     *
     * @see useOnBoardRequestExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\OnBoardRequestQuery The inner query object of the NOT EXISTS statement
     */
    public function useOnBoardRequestNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OnBoardRequestQuery */
        $q = $this->useExistsQuery('OnBoardRequest', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to OnBoardRequest table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\OnBoardRequestQuery The inner query object of the IN statement
     */
    public function useInOnBoardRequestQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\OnBoardRequestQuery */
        $q = $this->useInQuery('OnBoardRequest', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to OnBoardRequest table for a NOT IN query.
     *
     * @see useOnBoardRequestInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\OnBoardRequestQuery The inner query object of the NOT IN statement
     */
    public function useNotInOnBoardRequestQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OnBoardRequestQuery */
        $q = $this->useInQuery('OnBoardRequest', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildOnBoardRequestLog $onBoardRequestLog Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($onBoardRequestLog = null)
    {
        if ($onBoardRequestLog) {
            $this->addUsingAlias(OnBoardRequestLogTableMap::COL_ON_BOARD_REQUEST_LOG_ID, $onBoardRequestLog->getOnBoardRequestLogId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the on_board_request_log table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OnBoardRequestLogTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            OnBoardRequestLogTableMap::clearInstancePool();
            OnBoardRequestLogTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(OnBoardRequestLogTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(OnBoardRequestLogTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            OnBoardRequestLogTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            OnBoardRequestLogTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
