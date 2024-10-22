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
use entities\Events as ChildEvents;
use entities\EventsQuery as ChildEventsQuery;
use entities\Map\EventsTableMap;

/**
 * Base class that represents a query for the `events` table.
 *
 * @method     ChildEventsQuery orderByEventId($order = Criteria::ASC) Order by the event_id column
 * @method     ChildEventsQuery orderByEventDate($order = Criteria::ASC) Order by the event_date column
 * @method     ChildEventsQuery orderByEmployeeId($order = Criteria::ASC) Order by the employee_id column
 * @method     ChildEventsQuery orderByEventTypeId($order = Criteria::ASC) Order by the event_type_id column
 * @method     ChildEventsQuery orderByEventRemark($order = Criteria::ASC) Order by the event_remark column
 * @method     ChildEventsQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildEventsQuery orderByApproverEmpId($order = Criteria::ASC) Order by the approver_emp_id column
 * @method     ChildEventsQuery orderByEventStatus($order = Criteria::ASC) Order by the event_status column
 *
 * @method     ChildEventsQuery groupByEventId() Group by the event_id column
 * @method     ChildEventsQuery groupByEventDate() Group by the event_date column
 * @method     ChildEventsQuery groupByEmployeeId() Group by the employee_id column
 * @method     ChildEventsQuery groupByEventTypeId() Group by the event_type_id column
 * @method     ChildEventsQuery groupByEventRemark() Group by the event_remark column
 * @method     ChildEventsQuery groupByCompanyId() Group by the company_id column
 * @method     ChildEventsQuery groupByApproverEmpId() Group by the approver_emp_id column
 * @method     ChildEventsQuery groupByEventStatus() Group by the event_status column
 *
 * @method     ChildEventsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildEventsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildEventsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildEventsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildEventsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildEventsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildEventsQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildEventsQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildEventsQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildEventsQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildEventsQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildEventsQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildEventsQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     ChildEventsQuery leftJoinEmployeeRelatedByEmployeeId($relationAlias = null) Adds a LEFT JOIN clause to the query using the EmployeeRelatedByEmployeeId relation
 * @method     ChildEventsQuery rightJoinEmployeeRelatedByEmployeeId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EmployeeRelatedByEmployeeId relation
 * @method     ChildEventsQuery innerJoinEmployeeRelatedByEmployeeId($relationAlias = null) Adds a INNER JOIN clause to the query using the EmployeeRelatedByEmployeeId relation
 *
 * @method     ChildEventsQuery joinWithEmployeeRelatedByEmployeeId($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the EmployeeRelatedByEmployeeId relation
 *
 * @method     ChildEventsQuery leftJoinWithEmployeeRelatedByEmployeeId() Adds a LEFT JOIN clause and with to the query using the EmployeeRelatedByEmployeeId relation
 * @method     ChildEventsQuery rightJoinWithEmployeeRelatedByEmployeeId() Adds a RIGHT JOIN clause and with to the query using the EmployeeRelatedByEmployeeId relation
 * @method     ChildEventsQuery innerJoinWithEmployeeRelatedByEmployeeId() Adds a INNER JOIN clause and with to the query using the EmployeeRelatedByEmployeeId relation
 *
 * @method     ChildEventsQuery leftJoinEventTypes($relationAlias = null) Adds a LEFT JOIN clause to the query using the EventTypes relation
 * @method     ChildEventsQuery rightJoinEventTypes($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EventTypes relation
 * @method     ChildEventsQuery innerJoinEventTypes($relationAlias = null) Adds a INNER JOIN clause to the query using the EventTypes relation
 *
 * @method     ChildEventsQuery joinWithEventTypes($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the EventTypes relation
 *
 * @method     ChildEventsQuery leftJoinWithEventTypes() Adds a LEFT JOIN clause and with to the query using the EventTypes relation
 * @method     ChildEventsQuery rightJoinWithEventTypes() Adds a RIGHT JOIN clause and with to the query using the EventTypes relation
 * @method     ChildEventsQuery innerJoinWithEventTypes() Adds a INNER JOIN clause and with to the query using the EventTypes relation
 *
 * @method     ChildEventsQuery leftJoinEmployeeRelatedByApproverEmpId($relationAlias = null) Adds a LEFT JOIN clause to the query using the EmployeeRelatedByApproverEmpId relation
 * @method     ChildEventsQuery rightJoinEmployeeRelatedByApproverEmpId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EmployeeRelatedByApproverEmpId relation
 * @method     ChildEventsQuery innerJoinEmployeeRelatedByApproverEmpId($relationAlias = null) Adds a INNER JOIN clause to the query using the EmployeeRelatedByApproverEmpId relation
 *
 * @method     ChildEventsQuery joinWithEmployeeRelatedByApproverEmpId($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the EmployeeRelatedByApproverEmpId relation
 *
 * @method     ChildEventsQuery leftJoinWithEmployeeRelatedByApproverEmpId() Adds a LEFT JOIN clause and with to the query using the EmployeeRelatedByApproverEmpId relation
 * @method     ChildEventsQuery rightJoinWithEmployeeRelatedByApproverEmpId() Adds a RIGHT JOIN clause and with to the query using the EmployeeRelatedByApproverEmpId relation
 * @method     ChildEventsQuery innerJoinWithEmployeeRelatedByApproverEmpId() Adds a INNER JOIN clause and with to the query using the EmployeeRelatedByApproverEmpId relation
 *
 * @method     \entities\CompanyQuery|\entities\EmployeeQuery|\entities\EventTypesQuery|\entities\EmployeeQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildEvents|null findOne(?ConnectionInterface $con = null) Return the first ChildEvents matching the query
 * @method     ChildEvents findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildEvents matching the query, or a new ChildEvents object populated from the query conditions when no match is found
 *
 * @method     ChildEvents|null findOneByEventId(int $event_id) Return the first ChildEvents filtered by the event_id column
 * @method     ChildEvents|null findOneByEventDate(string $event_date) Return the first ChildEvents filtered by the event_date column
 * @method     ChildEvents|null findOneByEmployeeId(int $employee_id) Return the first ChildEvents filtered by the employee_id column
 * @method     ChildEvents|null findOneByEventTypeId(int $event_type_id) Return the first ChildEvents filtered by the event_type_id column
 * @method     ChildEvents|null findOneByEventRemark(string $event_remark) Return the first ChildEvents filtered by the event_remark column
 * @method     ChildEvents|null findOneByCompanyId(int $company_id) Return the first ChildEvents filtered by the company_id column
 * @method     ChildEvents|null findOneByApproverEmpId(int $approver_emp_id) Return the first ChildEvents filtered by the approver_emp_id column
 * @method     ChildEvents|null findOneByEventStatus(int $event_status) Return the first ChildEvents filtered by the event_status column
 *
 * @method     ChildEvents requirePk($key, ?ConnectionInterface $con = null) Return the ChildEvents by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEvents requireOne(?ConnectionInterface $con = null) Return the first ChildEvents matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEvents requireOneByEventId(int $event_id) Return the first ChildEvents filtered by the event_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEvents requireOneByEventDate(string $event_date) Return the first ChildEvents filtered by the event_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEvents requireOneByEmployeeId(int $employee_id) Return the first ChildEvents filtered by the employee_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEvents requireOneByEventTypeId(int $event_type_id) Return the first ChildEvents filtered by the event_type_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEvents requireOneByEventRemark(string $event_remark) Return the first ChildEvents filtered by the event_remark column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEvents requireOneByCompanyId(int $company_id) Return the first ChildEvents filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEvents requireOneByApproverEmpId(int $approver_emp_id) Return the first ChildEvents filtered by the approver_emp_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEvents requireOneByEventStatus(int $event_status) Return the first ChildEvents filtered by the event_status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEvents[]|Collection find(?ConnectionInterface $con = null) Return ChildEvents objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildEvents> find(?ConnectionInterface $con = null) Return ChildEvents objects based on current ModelCriteria
 *
 * @method     ChildEvents[]|Collection findByEventId(int|array<int> $event_id) Return ChildEvents objects filtered by the event_id column
 * @psalm-method Collection&\Traversable<ChildEvents> findByEventId(int|array<int> $event_id) Return ChildEvents objects filtered by the event_id column
 * @method     ChildEvents[]|Collection findByEventDate(string|array<string> $event_date) Return ChildEvents objects filtered by the event_date column
 * @psalm-method Collection&\Traversable<ChildEvents> findByEventDate(string|array<string> $event_date) Return ChildEvents objects filtered by the event_date column
 * @method     ChildEvents[]|Collection findByEmployeeId(int|array<int> $employee_id) Return ChildEvents objects filtered by the employee_id column
 * @psalm-method Collection&\Traversable<ChildEvents> findByEmployeeId(int|array<int> $employee_id) Return ChildEvents objects filtered by the employee_id column
 * @method     ChildEvents[]|Collection findByEventTypeId(int|array<int> $event_type_id) Return ChildEvents objects filtered by the event_type_id column
 * @psalm-method Collection&\Traversable<ChildEvents> findByEventTypeId(int|array<int> $event_type_id) Return ChildEvents objects filtered by the event_type_id column
 * @method     ChildEvents[]|Collection findByEventRemark(string|array<string> $event_remark) Return ChildEvents objects filtered by the event_remark column
 * @psalm-method Collection&\Traversable<ChildEvents> findByEventRemark(string|array<string> $event_remark) Return ChildEvents objects filtered by the event_remark column
 * @method     ChildEvents[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildEvents objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildEvents> findByCompanyId(int|array<int> $company_id) Return ChildEvents objects filtered by the company_id column
 * @method     ChildEvents[]|Collection findByApproverEmpId(int|array<int> $approver_emp_id) Return ChildEvents objects filtered by the approver_emp_id column
 * @psalm-method Collection&\Traversable<ChildEvents> findByApproverEmpId(int|array<int> $approver_emp_id) Return ChildEvents objects filtered by the approver_emp_id column
 * @method     ChildEvents[]|Collection findByEventStatus(int|array<int> $event_status) Return ChildEvents objects filtered by the event_status column
 * @psalm-method Collection&\Traversable<ChildEvents> findByEventStatus(int|array<int> $event_status) Return ChildEvents objects filtered by the event_status column
 *
 * @method     ChildEvents[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildEvents> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class EventsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\EventsQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\Events', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildEventsQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildEventsQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildEventsQuery) {
            return $criteria;
        }
        $query = new ChildEventsQuery();
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
     * @return ChildEvents|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(EventsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = EventsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildEvents A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT event_id, event_date, employee_id, event_type_id, event_remark, company_id, approver_emp_id, event_status FROM events WHERE event_id = :p0';
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
            /** @var ChildEvents $obj */
            $obj = new ChildEvents();
            $obj->hydrate($row);
            EventsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildEvents|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(EventsTableMap::COL_EVENT_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(EventsTableMap::COL_EVENT_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the event_id column
     *
     * Example usage:
     * <code>
     * $query->filterByEventId(1234); // WHERE event_id = 1234
     * $query->filterByEventId(array(12, 34)); // WHERE event_id IN (12, 34)
     * $query->filterByEventId(array('min' => 12)); // WHERE event_id > 12
     * </code>
     *
     * @param mixed $eventId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEventId($eventId = null, ?string $comparison = null)
    {
        if (is_array($eventId)) {
            $useMinMax = false;
            if (isset($eventId['min'])) {
                $this->addUsingAlias(EventsTableMap::COL_EVENT_ID, $eventId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($eventId['max'])) {
                $this->addUsingAlias(EventsTableMap::COL_EVENT_ID, $eventId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EventsTableMap::COL_EVENT_ID, $eventId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the event_date column
     *
     * Example usage:
     * <code>
     * $query->filterByEventDate('2011-03-14'); // WHERE event_date = '2011-03-14'
     * $query->filterByEventDate('now'); // WHERE event_date = '2011-03-14'
     * $query->filterByEventDate(array('max' => 'yesterday')); // WHERE event_date > '2011-03-13'
     * </code>
     *
     * @param mixed $eventDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEventDate($eventDate = null, ?string $comparison = null)
    {
        if (is_array($eventDate)) {
            $useMinMax = false;
            if (isset($eventDate['min'])) {
                $this->addUsingAlias(EventsTableMap::COL_EVENT_DATE, $eventDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($eventDate['max'])) {
                $this->addUsingAlias(EventsTableMap::COL_EVENT_DATE, $eventDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EventsTableMap::COL_EVENT_DATE, $eventDate, $comparison);

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
     * @see       filterByEmployeeRelatedByEmployeeId()
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
                $this->addUsingAlias(EventsTableMap::COL_EMPLOYEE_ID, $employeeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($employeeId['max'])) {
                $this->addUsingAlias(EventsTableMap::COL_EMPLOYEE_ID, $employeeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EventsTableMap::COL_EMPLOYEE_ID, $employeeId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the event_type_id column
     *
     * Example usage:
     * <code>
     * $query->filterByEventTypeId(1234); // WHERE event_type_id = 1234
     * $query->filterByEventTypeId(array(12, 34)); // WHERE event_type_id IN (12, 34)
     * $query->filterByEventTypeId(array('min' => 12)); // WHERE event_type_id > 12
     * </code>
     *
     * @see       filterByEventTypes()
     *
     * @param mixed $eventTypeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEventTypeId($eventTypeId = null, ?string $comparison = null)
    {
        if (is_array($eventTypeId)) {
            $useMinMax = false;
            if (isset($eventTypeId['min'])) {
                $this->addUsingAlias(EventsTableMap::COL_EVENT_TYPE_ID, $eventTypeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($eventTypeId['max'])) {
                $this->addUsingAlias(EventsTableMap::COL_EVENT_TYPE_ID, $eventTypeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EventsTableMap::COL_EVENT_TYPE_ID, $eventTypeId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the event_remark column
     *
     * Example usage:
     * <code>
     * $query->filterByEventRemark('fooValue');   // WHERE event_remark = 'fooValue'
     * $query->filterByEventRemark('%fooValue%', Criteria::LIKE); // WHERE event_remark LIKE '%fooValue%'
     * $query->filterByEventRemark(['foo', 'bar']); // WHERE event_remark IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $eventRemark The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEventRemark($eventRemark = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($eventRemark)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EventsTableMap::COL_EVENT_REMARK, $eventRemark, $comparison);

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
                $this->addUsingAlias(EventsTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(EventsTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EventsTableMap::COL_COMPANY_ID, $companyId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the approver_emp_id column
     *
     * Example usage:
     * <code>
     * $query->filterByApproverEmpId(1234); // WHERE approver_emp_id = 1234
     * $query->filterByApproverEmpId(array(12, 34)); // WHERE approver_emp_id IN (12, 34)
     * $query->filterByApproverEmpId(array('min' => 12)); // WHERE approver_emp_id > 12
     * </code>
     *
     * @see       filterByEmployeeRelatedByApproverEmpId()
     *
     * @param mixed $approverEmpId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByApproverEmpId($approverEmpId = null, ?string $comparison = null)
    {
        if (is_array($approverEmpId)) {
            $useMinMax = false;
            if (isset($approverEmpId['min'])) {
                $this->addUsingAlias(EventsTableMap::COL_APPROVER_EMP_ID, $approverEmpId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($approverEmpId['max'])) {
                $this->addUsingAlias(EventsTableMap::COL_APPROVER_EMP_ID, $approverEmpId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EventsTableMap::COL_APPROVER_EMP_ID, $approverEmpId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the event_status column
     *
     * Example usage:
     * <code>
     * $query->filterByEventStatus(1234); // WHERE event_status = 1234
     * $query->filterByEventStatus(array(12, 34)); // WHERE event_status IN (12, 34)
     * $query->filterByEventStatus(array('min' => 12)); // WHERE event_status > 12
     * </code>
     *
     * @param mixed $eventStatus The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEventStatus($eventStatus = null, ?string $comparison = null)
    {
        if (is_array($eventStatus)) {
            $useMinMax = false;
            if (isset($eventStatus['min'])) {
                $this->addUsingAlias(EventsTableMap::COL_EVENT_STATUS, $eventStatus['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($eventStatus['max'])) {
                $this->addUsingAlias(EventsTableMap::COL_EVENT_STATUS, $eventStatus['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EventsTableMap::COL_EVENT_STATUS, $eventStatus, $comparison);

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
                ->addUsingAlias(EventsTableMap::COL_COMPANY_ID, $company->getCompanyId(), $comparison);
        } elseif ($company instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(EventsTableMap::COL_COMPANY_ID, $company->toKeyValue('PrimaryKey', 'CompanyId'), $comparison);

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
    public function filterByEmployeeRelatedByEmployeeId($employee, ?string $comparison = null)
    {
        if ($employee instanceof \entities\Employee) {
            return $this
                ->addUsingAlias(EventsTableMap::COL_EMPLOYEE_ID, $employee->getEmployeeId(), $comparison);
        } elseif ($employee instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(EventsTableMap::COL_EMPLOYEE_ID, $employee->toKeyValue('PrimaryKey', 'EmployeeId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByEmployeeRelatedByEmployeeId() only accepts arguments of type \entities\Employee or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the EmployeeRelatedByEmployeeId relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinEmployeeRelatedByEmployeeId(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('EmployeeRelatedByEmployeeId');

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
            $this->addJoinObject($join, 'EmployeeRelatedByEmployeeId');
        }

        return $this;
    }

    /**
     * Use the EmployeeRelatedByEmployeeId relation Employee object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\EmployeeQuery A secondary query class using the current class as primary query
     */
    public function useEmployeeRelatedByEmployeeIdQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinEmployeeRelatedByEmployeeId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'EmployeeRelatedByEmployeeId', '\entities\EmployeeQuery');
    }

    /**
     * Use the EmployeeRelatedByEmployeeId relation Employee object
     *
     * @param callable(\entities\EmployeeQuery):\entities\EmployeeQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withEmployeeRelatedByEmployeeIdQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useEmployeeRelatedByEmployeeIdQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the EmployeeRelatedByEmployeeId relation to the Employee table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\EmployeeQuery The inner query object of the EXISTS statement
     */
    public function useEmployeeRelatedByEmployeeIdExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\EmployeeQuery */
        $q = $this->useExistsQuery('EmployeeRelatedByEmployeeId', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the EmployeeRelatedByEmployeeId relation to the Employee table for a NOT EXISTS query.
     *
     * @see useEmployeeRelatedByEmployeeIdExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\EmployeeQuery The inner query object of the NOT EXISTS statement
     */
    public function useEmployeeRelatedByEmployeeIdNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\EmployeeQuery */
        $q = $this->useExistsQuery('EmployeeRelatedByEmployeeId', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the EmployeeRelatedByEmployeeId relation to the Employee table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\EmployeeQuery The inner query object of the IN statement
     */
    public function useInEmployeeRelatedByEmployeeIdQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\EmployeeQuery */
        $q = $this->useInQuery('EmployeeRelatedByEmployeeId', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the EmployeeRelatedByEmployeeId relation to the Employee table for a NOT IN query.
     *
     * @see useEmployeeRelatedByEmployeeIdInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\EmployeeQuery The inner query object of the NOT IN statement
     */
    public function useNotInEmployeeRelatedByEmployeeIdQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\EmployeeQuery */
        $q = $this->useInQuery('EmployeeRelatedByEmployeeId', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\EventTypes object
     *
     * @param \entities\EventTypes|ObjectCollection $eventTypes The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEventTypes($eventTypes, ?string $comparison = null)
    {
        if ($eventTypes instanceof \entities\EventTypes) {
            return $this
                ->addUsingAlias(EventsTableMap::COL_EVENT_TYPE_ID, $eventTypes->getEventTypeId(), $comparison);
        } elseif ($eventTypes instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(EventsTableMap::COL_EVENT_TYPE_ID, $eventTypes->toKeyValue('PrimaryKey', 'EventTypeId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByEventTypes() only accepts arguments of type \entities\EventTypes or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the EventTypes relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinEventTypes(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('EventTypes');

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
            $this->addJoinObject($join, 'EventTypes');
        }

        return $this;
    }

    /**
     * Use the EventTypes relation EventTypes object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\EventTypesQuery A secondary query class using the current class as primary query
     */
    public function useEventTypesQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinEventTypes($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'EventTypes', '\entities\EventTypesQuery');
    }

    /**
     * Use the EventTypes relation EventTypes object
     *
     * @param callable(\entities\EventTypesQuery):\entities\EventTypesQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withEventTypesQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useEventTypesQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to EventTypes table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\EventTypesQuery The inner query object of the EXISTS statement
     */
    public function useEventTypesExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\EventTypesQuery */
        $q = $this->useExistsQuery('EventTypes', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to EventTypes table for a NOT EXISTS query.
     *
     * @see useEventTypesExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\EventTypesQuery The inner query object of the NOT EXISTS statement
     */
    public function useEventTypesNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\EventTypesQuery */
        $q = $this->useExistsQuery('EventTypes', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to EventTypes table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\EventTypesQuery The inner query object of the IN statement
     */
    public function useInEventTypesQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\EventTypesQuery */
        $q = $this->useInQuery('EventTypes', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to EventTypes table for a NOT IN query.
     *
     * @see useEventTypesInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\EventTypesQuery The inner query object of the NOT IN statement
     */
    public function useNotInEventTypesQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\EventTypesQuery */
        $q = $this->useInQuery('EventTypes', $modelAlias, $queryClass, 'NOT IN');
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
    public function filterByEmployeeRelatedByApproverEmpId($employee, ?string $comparison = null)
    {
        if ($employee instanceof \entities\Employee) {
            return $this
                ->addUsingAlias(EventsTableMap::COL_APPROVER_EMP_ID, $employee->getEmployeeId(), $comparison);
        } elseif ($employee instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(EventsTableMap::COL_APPROVER_EMP_ID, $employee->toKeyValue('PrimaryKey', 'EmployeeId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByEmployeeRelatedByApproverEmpId() only accepts arguments of type \entities\Employee or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the EmployeeRelatedByApproverEmpId relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinEmployeeRelatedByApproverEmpId(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('EmployeeRelatedByApproverEmpId');

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
            $this->addJoinObject($join, 'EmployeeRelatedByApproverEmpId');
        }

        return $this;
    }

    /**
     * Use the EmployeeRelatedByApproverEmpId relation Employee object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\EmployeeQuery A secondary query class using the current class as primary query
     */
    public function useEmployeeRelatedByApproverEmpIdQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinEmployeeRelatedByApproverEmpId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'EmployeeRelatedByApproverEmpId', '\entities\EmployeeQuery');
    }

    /**
     * Use the EmployeeRelatedByApproverEmpId relation Employee object
     *
     * @param callable(\entities\EmployeeQuery):\entities\EmployeeQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withEmployeeRelatedByApproverEmpIdQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useEmployeeRelatedByApproverEmpIdQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the EmployeeRelatedByApproverEmpId relation to the Employee table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\EmployeeQuery The inner query object of the EXISTS statement
     */
    public function useEmployeeRelatedByApproverEmpIdExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\EmployeeQuery */
        $q = $this->useExistsQuery('EmployeeRelatedByApproverEmpId', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the EmployeeRelatedByApproverEmpId relation to the Employee table for a NOT EXISTS query.
     *
     * @see useEmployeeRelatedByApproverEmpIdExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\EmployeeQuery The inner query object of the NOT EXISTS statement
     */
    public function useEmployeeRelatedByApproverEmpIdNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\EmployeeQuery */
        $q = $this->useExistsQuery('EmployeeRelatedByApproverEmpId', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the EmployeeRelatedByApproverEmpId relation to the Employee table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\EmployeeQuery The inner query object of the IN statement
     */
    public function useInEmployeeRelatedByApproverEmpIdQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\EmployeeQuery */
        $q = $this->useInQuery('EmployeeRelatedByApproverEmpId', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the EmployeeRelatedByApproverEmpId relation to the Employee table for a NOT IN query.
     *
     * @see useEmployeeRelatedByApproverEmpIdInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\EmployeeQuery The inner query object of the NOT IN statement
     */
    public function useNotInEmployeeRelatedByApproverEmpIdQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\EmployeeQuery */
        $q = $this->useInQuery('EmployeeRelatedByApproverEmpId', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildEvents $events Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($events = null)
    {
        if ($events) {
            $this->addUsingAlias(EventsTableMap::COL_EVENT_ID, $events->getEventId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the events table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EventsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            EventsTableMap::clearInstancePool();
            EventsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(EventsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(EventsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            EventsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            EventsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
