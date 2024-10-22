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
use entities\WfSteps as ChildWfSteps;
use entities\WfStepsQuery as ChildWfStepsQuery;
use entities\Map\WfStepsTableMap;

/**
 * Base class that represents a query for the `wf_steps` table.
 *
 * @method     ChildWfStepsQuery orderByWfStepsId($order = Criteria::ASC) Order by the wf_steps_id column
 * @method     ChildWfStepsQuery orderByWfId($order = Criteria::ASC) Order by the wf_id column
 * @method     ChildWfStepsQuery orderByWfInStatus($order = Criteria::ASC) Order by the wf_in_status column
 * @method     ChildWfStepsQuery orderByRequestUp($order = Criteria::ASC) Order by the request_up column
 * @method     ChildWfStepsQuery orderByWfOutStatus($order = Criteria::ASC) Order by the wf_out_status column
 * @method     ChildWfStepsQuery orderByWfRequestDesc($order = Criteria::ASC) Order by the wf_request_desc column
 * @method     ChildWfStepsQuery orderByWfStepLevel($order = Criteria::ASC) Order by the wf_step_level column
 * @method     ChildWfStepsQuery orderByWfBtnDesc($order = Criteria::ASC) Order by the wf_btn_desc column
 * @method     ChildWfStepsQuery orderByNotificationStatus($order = Criteria::ASC) Order by the notification_status column
 *
 * @method     ChildWfStepsQuery groupByWfStepsId() Group by the wf_steps_id column
 * @method     ChildWfStepsQuery groupByWfId() Group by the wf_id column
 * @method     ChildWfStepsQuery groupByWfInStatus() Group by the wf_in_status column
 * @method     ChildWfStepsQuery groupByRequestUp() Group by the request_up column
 * @method     ChildWfStepsQuery groupByWfOutStatus() Group by the wf_out_status column
 * @method     ChildWfStepsQuery groupByWfRequestDesc() Group by the wf_request_desc column
 * @method     ChildWfStepsQuery groupByWfStepLevel() Group by the wf_step_level column
 * @method     ChildWfStepsQuery groupByWfBtnDesc() Group by the wf_btn_desc column
 * @method     ChildWfStepsQuery groupByNotificationStatus() Group by the notification_status column
 *
 * @method     ChildWfStepsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildWfStepsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildWfStepsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildWfStepsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildWfStepsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildWfStepsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildWfStepsQuery leftJoinWfMaster($relationAlias = null) Adds a LEFT JOIN clause to the query using the WfMaster relation
 * @method     ChildWfStepsQuery rightJoinWfMaster($relationAlias = null) Adds a RIGHT JOIN clause to the query using the WfMaster relation
 * @method     ChildWfStepsQuery innerJoinWfMaster($relationAlias = null) Adds a INNER JOIN clause to the query using the WfMaster relation
 *
 * @method     ChildWfStepsQuery joinWithWfMaster($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the WfMaster relation
 *
 * @method     ChildWfStepsQuery leftJoinWithWfMaster() Adds a LEFT JOIN clause and with to the query using the WfMaster relation
 * @method     ChildWfStepsQuery rightJoinWithWfMaster() Adds a RIGHT JOIN clause and with to the query using the WfMaster relation
 * @method     ChildWfStepsQuery innerJoinWithWfMaster() Adds a INNER JOIN clause and with to the query using the WfMaster relation
 *
 * @method     ChildWfStepsQuery leftJoinWfRequests($relationAlias = null) Adds a LEFT JOIN clause to the query using the WfRequests relation
 * @method     ChildWfStepsQuery rightJoinWfRequests($relationAlias = null) Adds a RIGHT JOIN clause to the query using the WfRequests relation
 * @method     ChildWfStepsQuery innerJoinWfRequests($relationAlias = null) Adds a INNER JOIN clause to the query using the WfRequests relation
 *
 * @method     ChildWfStepsQuery joinWithWfRequests($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the WfRequests relation
 *
 * @method     ChildWfStepsQuery leftJoinWithWfRequests() Adds a LEFT JOIN clause and with to the query using the WfRequests relation
 * @method     ChildWfStepsQuery rightJoinWithWfRequests() Adds a RIGHT JOIN clause and with to the query using the WfRequests relation
 * @method     ChildWfStepsQuery innerJoinWithWfRequests() Adds a INNER JOIN clause and with to the query using the WfRequests relation
 *
 * @method     \entities\WfMasterQuery|\entities\WfRequestsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildWfSteps|null findOne(?ConnectionInterface $con = null) Return the first ChildWfSteps matching the query
 * @method     ChildWfSteps findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildWfSteps matching the query, or a new ChildWfSteps object populated from the query conditions when no match is found
 *
 * @method     ChildWfSteps|null findOneByWfStepsId(int $wf_steps_id) Return the first ChildWfSteps filtered by the wf_steps_id column
 * @method     ChildWfSteps|null findOneByWfId(int $wf_id) Return the first ChildWfSteps filtered by the wf_id column
 * @method     ChildWfSteps|null findOneByWfInStatus(string $wf_in_status) Return the first ChildWfSteps filtered by the wf_in_status column
 * @method     ChildWfSteps|null findOneByRequestUp(int $request_up) Return the first ChildWfSteps filtered by the request_up column
 * @method     ChildWfSteps|null findOneByWfOutStatus(string $wf_out_status) Return the first ChildWfSteps filtered by the wf_out_status column
 * @method     ChildWfSteps|null findOneByWfRequestDesc(string $wf_request_desc) Return the first ChildWfSteps filtered by the wf_request_desc column
 * @method     ChildWfSteps|null findOneByWfStepLevel(string $wf_step_level) Return the first ChildWfSteps filtered by the wf_step_level column
 * @method     ChildWfSteps|null findOneByWfBtnDesc(string $wf_btn_desc) Return the first ChildWfSteps filtered by the wf_btn_desc column
 * @method     ChildWfSteps|null findOneByNotificationStatus(int $notification_status) Return the first ChildWfSteps filtered by the notification_status column
 *
 * @method     ChildWfSteps requirePk($key, ?ConnectionInterface $con = null) Return the ChildWfSteps by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWfSteps requireOne(?ConnectionInterface $con = null) Return the first ChildWfSteps matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildWfSteps requireOneByWfStepsId(int $wf_steps_id) Return the first ChildWfSteps filtered by the wf_steps_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWfSteps requireOneByWfId(int $wf_id) Return the first ChildWfSteps filtered by the wf_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWfSteps requireOneByWfInStatus(string $wf_in_status) Return the first ChildWfSteps filtered by the wf_in_status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWfSteps requireOneByRequestUp(int $request_up) Return the first ChildWfSteps filtered by the request_up column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWfSteps requireOneByWfOutStatus(string $wf_out_status) Return the first ChildWfSteps filtered by the wf_out_status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWfSteps requireOneByWfRequestDesc(string $wf_request_desc) Return the first ChildWfSteps filtered by the wf_request_desc column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWfSteps requireOneByWfStepLevel(string $wf_step_level) Return the first ChildWfSteps filtered by the wf_step_level column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWfSteps requireOneByWfBtnDesc(string $wf_btn_desc) Return the first ChildWfSteps filtered by the wf_btn_desc column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWfSteps requireOneByNotificationStatus(int $notification_status) Return the first ChildWfSteps filtered by the notification_status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildWfSteps[]|Collection find(?ConnectionInterface $con = null) Return ChildWfSteps objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildWfSteps> find(?ConnectionInterface $con = null) Return ChildWfSteps objects based on current ModelCriteria
 *
 * @method     ChildWfSteps[]|Collection findByWfStepsId(int|array<int> $wf_steps_id) Return ChildWfSteps objects filtered by the wf_steps_id column
 * @psalm-method Collection&\Traversable<ChildWfSteps> findByWfStepsId(int|array<int> $wf_steps_id) Return ChildWfSteps objects filtered by the wf_steps_id column
 * @method     ChildWfSteps[]|Collection findByWfId(int|array<int> $wf_id) Return ChildWfSteps objects filtered by the wf_id column
 * @psalm-method Collection&\Traversable<ChildWfSteps> findByWfId(int|array<int> $wf_id) Return ChildWfSteps objects filtered by the wf_id column
 * @method     ChildWfSteps[]|Collection findByWfInStatus(string|array<string> $wf_in_status) Return ChildWfSteps objects filtered by the wf_in_status column
 * @psalm-method Collection&\Traversable<ChildWfSteps> findByWfInStatus(string|array<string> $wf_in_status) Return ChildWfSteps objects filtered by the wf_in_status column
 * @method     ChildWfSteps[]|Collection findByRequestUp(int|array<int> $request_up) Return ChildWfSteps objects filtered by the request_up column
 * @psalm-method Collection&\Traversable<ChildWfSteps> findByRequestUp(int|array<int> $request_up) Return ChildWfSteps objects filtered by the request_up column
 * @method     ChildWfSteps[]|Collection findByWfOutStatus(string|array<string> $wf_out_status) Return ChildWfSteps objects filtered by the wf_out_status column
 * @psalm-method Collection&\Traversable<ChildWfSteps> findByWfOutStatus(string|array<string> $wf_out_status) Return ChildWfSteps objects filtered by the wf_out_status column
 * @method     ChildWfSteps[]|Collection findByWfRequestDesc(string|array<string> $wf_request_desc) Return ChildWfSteps objects filtered by the wf_request_desc column
 * @psalm-method Collection&\Traversable<ChildWfSteps> findByWfRequestDesc(string|array<string> $wf_request_desc) Return ChildWfSteps objects filtered by the wf_request_desc column
 * @method     ChildWfSteps[]|Collection findByWfStepLevel(string|array<string> $wf_step_level) Return ChildWfSteps objects filtered by the wf_step_level column
 * @psalm-method Collection&\Traversable<ChildWfSteps> findByWfStepLevel(string|array<string> $wf_step_level) Return ChildWfSteps objects filtered by the wf_step_level column
 * @method     ChildWfSteps[]|Collection findByWfBtnDesc(string|array<string> $wf_btn_desc) Return ChildWfSteps objects filtered by the wf_btn_desc column
 * @psalm-method Collection&\Traversable<ChildWfSteps> findByWfBtnDesc(string|array<string> $wf_btn_desc) Return ChildWfSteps objects filtered by the wf_btn_desc column
 * @method     ChildWfSteps[]|Collection findByNotificationStatus(int|array<int> $notification_status) Return ChildWfSteps objects filtered by the notification_status column
 * @psalm-method Collection&\Traversable<ChildWfSteps> findByNotificationStatus(int|array<int> $notification_status) Return ChildWfSteps objects filtered by the notification_status column
 *
 * @method     ChildWfSteps[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildWfSteps> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class WfStepsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\WfStepsQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\WfSteps', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildWfStepsQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildWfStepsQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildWfStepsQuery) {
            return $criteria;
        }
        $query = new ChildWfStepsQuery();
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
     * @return ChildWfSteps|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(WfStepsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = WfStepsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildWfSteps A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT wf_steps_id, wf_id, wf_in_status, request_up, wf_out_status, wf_request_desc, wf_step_level, wf_btn_desc, notification_status FROM wf_steps WHERE wf_steps_id = :p0';
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
            /** @var ChildWfSteps $obj */
            $obj = new ChildWfSteps();
            $obj->hydrate($row);
            WfStepsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildWfSteps|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(WfStepsTableMap::COL_WF_STEPS_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(WfStepsTableMap::COL_WF_STEPS_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the wf_steps_id column
     *
     * Example usage:
     * <code>
     * $query->filterByWfStepsId(1234); // WHERE wf_steps_id = 1234
     * $query->filterByWfStepsId(array(12, 34)); // WHERE wf_steps_id IN (12, 34)
     * $query->filterByWfStepsId(array('min' => 12)); // WHERE wf_steps_id > 12
     * </code>
     *
     * @param mixed $wfStepsId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWfStepsId($wfStepsId = null, ?string $comparison = null)
    {
        if (is_array($wfStepsId)) {
            $useMinMax = false;
            if (isset($wfStepsId['min'])) {
                $this->addUsingAlias(WfStepsTableMap::COL_WF_STEPS_ID, $wfStepsId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($wfStepsId['max'])) {
                $this->addUsingAlias(WfStepsTableMap::COL_WF_STEPS_ID, $wfStepsId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WfStepsTableMap::COL_WF_STEPS_ID, $wfStepsId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the wf_id column
     *
     * Example usage:
     * <code>
     * $query->filterByWfId(1234); // WHERE wf_id = 1234
     * $query->filterByWfId(array(12, 34)); // WHERE wf_id IN (12, 34)
     * $query->filterByWfId(array('min' => 12)); // WHERE wf_id > 12
     * </code>
     *
     * @see       filterByWfMaster()
     *
     * @param mixed $wfId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWfId($wfId = null, ?string $comparison = null)
    {
        if (is_array($wfId)) {
            $useMinMax = false;
            if (isset($wfId['min'])) {
                $this->addUsingAlias(WfStepsTableMap::COL_WF_ID, $wfId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($wfId['max'])) {
                $this->addUsingAlias(WfStepsTableMap::COL_WF_ID, $wfId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WfStepsTableMap::COL_WF_ID, $wfId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the wf_in_status column
     *
     * Example usage:
     * <code>
     * $query->filterByWfInStatus('fooValue');   // WHERE wf_in_status = 'fooValue'
     * $query->filterByWfInStatus('%fooValue%', Criteria::LIKE); // WHERE wf_in_status LIKE '%fooValue%'
     * $query->filterByWfInStatus(['foo', 'bar']); // WHERE wf_in_status IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $wfInStatus The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWfInStatus($wfInStatus = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($wfInStatus)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WfStepsTableMap::COL_WF_IN_STATUS, $wfInStatus, $comparison);

        return $this;
    }

    /**
     * Filter the query on the request_up column
     *
     * Example usage:
     * <code>
     * $query->filterByRequestUp(1234); // WHERE request_up = 1234
     * $query->filterByRequestUp(array(12, 34)); // WHERE request_up IN (12, 34)
     * $query->filterByRequestUp(array('min' => 12)); // WHERE request_up > 12
     * </code>
     *
     * @param mixed $requestUp The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRequestUp($requestUp = null, ?string $comparison = null)
    {
        if (is_array($requestUp)) {
            $useMinMax = false;
            if (isset($requestUp['min'])) {
                $this->addUsingAlias(WfStepsTableMap::COL_REQUEST_UP, $requestUp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($requestUp['max'])) {
                $this->addUsingAlias(WfStepsTableMap::COL_REQUEST_UP, $requestUp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WfStepsTableMap::COL_REQUEST_UP, $requestUp, $comparison);

        return $this;
    }

    /**
     * Filter the query on the wf_out_status column
     *
     * Example usage:
     * <code>
     * $query->filterByWfOutStatus('fooValue');   // WHERE wf_out_status = 'fooValue'
     * $query->filterByWfOutStatus('%fooValue%', Criteria::LIKE); // WHERE wf_out_status LIKE '%fooValue%'
     * $query->filterByWfOutStatus(['foo', 'bar']); // WHERE wf_out_status IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $wfOutStatus The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWfOutStatus($wfOutStatus = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($wfOutStatus)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WfStepsTableMap::COL_WF_OUT_STATUS, $wfOutStatus, $comparison);

        return $this;
    }

    /**
     * Filter the query on the wf_request_desc column
     *
     * Example usage:
     * <code>
     * $query->filterByWfRequestDesc('fooValue');   // WHERE wf_request_desc = 'fooValue'
     * $query->filterByWfRequestDesc('%fooValue%', Criteria::LIKE); // WHERE wf_request_desc LIKE '%fooValue%'
     * $query->filterByWfRequestDesc(['foo', 'bar']); // WHERE wf_request_desc IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $wfRequestDesc The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWfRequestDesc($wfRequestDesc = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($wfRequestDesc)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WfStepsTableMap::COL_WF_REQUEST_DESC, $wfRequestDesc, $comparison);

        return $this;
    }

    /**
     * Filter the query on the wf_step_level column
     *
     * Example usage:
     * <code>
     * $query->filterByWfStepLevel('fooValue');   // WHERE wf_step_level = 'fooValue'
     * $query->filterByWfStepLevel('%fooValue%', Criteria::LIKE); // WHERE wf_step_level LIKE '%fooValue%'
     * $query->filterByWfStepLevel(['foo', 'bar']); // WHERE wf_step_level IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $wfStepLevel The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWfStepLevel($wfStepLevel = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($wfStepLevel)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WfStepsTableMap::COL_WF_STEP_LEVEL, $wfStepLevel, $comparison);

        return $this;
    }

    /**
     * Filter the query on the wf_btn_desc column
     *
     * Example usage:
     * <code>
     * $query->filterByWfBtnDesc('fooValue');   // WHERE wf_btn_desc = 'fooValue'
     * $query->filterByWfBtnDesc('%fooValue%', Criteria::LIKE); // WHERE wf_btn_desc LIKE '%fooValue%'
     * $query->filterByWfBtnDesc(['foo', 'bar']); // WHERE wf_btn_desc IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $wfBtnDesc The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWfBtnDesc($wfBtnDesc = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($wfBtnDesc)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WfStepsTableMap::COL_WF_BTN_DESC, $wfBtnDesc, $comparison);

        return $this;
    }

    /**
     * Filter the query on the notification_status column
     *
     * Example usage:
     * <code>
     * $query->filterByNotificationStatus(1234); // WHERE notification_status = 1234
     * $query->filterByNotificationStatus(array(12, 34)); // WHERE notification_status IN (12, 34)
     * $query->filterByNotificationStatus(array('min' => 12)); // WHERE notification_status > 12
     * </code>
     *
     * @param mixed $notificationStatus The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByNotificationStatus($notificationStatus = null, ?string $comparison = null)
    {
        if (is_array($notificationStatus)) {
            $useMinMax = false;
            if (isset($notificationStatus['min'])) {
                $this->addUsingAlias(WfStepsTableMap::COL_NOTIFICATION_STATUS, $notificationStatus['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($notificationStatus['max'])) {
                $this->addUsingAlias(WfStepsTableMap::COL_NOTIFICATION_STATUS, $notificationStatus['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WfStepsTableMap::COL_NOTIFICATION_STATUS, $notificationStatus, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \entities\WfMaster object
     *
     * @param \entities\WfMaster|ObjectCollection $wfMaster The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWfMaster($wfMaster, ?string $comparison = null)
    {
        if ($wfMaster instanceof \entities\WfMaster) {
            return $this
                ->addUsingAlias(WfStepsTableMap::COL_WF_ID, $wfMaster->getWfId(), $comparison);
        } elseif ($wfMaster instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(WfStepsTableMap::COL_WF_ID, $wfMaster->toKeyValue('PrimaryKey', 'WfId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByWfMaster() only accepts arguments of type \entities\WfMaster or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the WfMaster relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinWfMaster(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('WfMaster');

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
            $this->addJoinObject($join, 'WfMaster');
        }

        return $this;
    }

    /**
     * Use the WfMaster relation WfMaster object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\WfMasterQuery A secondary query class using the current class as primary query
     */
    public function useWfMasterQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinWfMaster($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'WfMaster', '\entities\WfMasterQuery');
    }

    /**
     * Use the WfMaster relation WfMaster object
     *
     * @param callable(\entities\WfMasterQuery):\entities\WfMasterQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withWfMasterQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useWfMasterQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to WfMaster table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\WfMasterQuery The inner query object of the EXISTS statement
     */
    public function useWfMasterExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\WfMasterQuery */
        $q = $this->useExistsQuery('WfMaster', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to WfMaster table for a NOT EXISTS query.
     *
     * @see useWfMasterExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\WfMasterQuery The inner query object of the NOT EXISTS statement
     */
    public function useWfMasterNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\WfMasterQuery */
        $q = $this->useExistsQuery('WfMaster', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to WfMaster table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\WfMasterQuery The inner query object of the IN statement
     */
    public function useInWfMasterQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\WfMasterQuery */
        $q = $this->useInQuery('WfMaster', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to WfMaster table for a NOT IN query.
     *
     * @see useWfMasterInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\WfMasterQuery The inner query object of the NOT IN statement
     */
    public function useNotInWfMasterQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\WfMasterQuery */
        $q = $this->useInQuery('WfMaster', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\WfRequests object
     *
     * @param \entities\WfRequests|ObjectCollection $wfRequests the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWfRequests($wfRequests, ?string $comparison = null)
    {
        if ($wfRequests instanceof \entities\WfRequests) {
            $this
                ->addUsingAlias(WfStepsTableMap::COL_WF_STEPS_ID, $wfRequests->getWfStepId(), $comparison);

            return $this;
        } elseif ($wfRequests instanceof ObjectCollection) {
            $this
                ->useWfRequestsQuery()
                ->filterByPrimaryKeys($wfRequests->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByWfRequests() only accepts arguments of type \entities\WfRequests or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the WfRequests relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinWfRequests(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('WfRequests');

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
            $this->addJoinObject($join, 'WfRequests');
        }

        return $this;
    }

    /**
     * Use the WfRequests relation WfRequests object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\WfRequestsQuery A secondary query class using the current class as primary query
     */
    public function useWfRequestsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinWfRequests($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'WfRequests', '\entities\WfRequestsQuery');
    }

    /**
     * Use the WfRequests relation WfRequests object
     *
     * @param callable(\entities\WfRequestsQuery):\entities\WfRequestsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withWfRequestsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useWfRequestsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to WfRequests table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\WfRequestsQuery The inner query object of the EXISTS statement
     */
    public function useWfRequestsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\WfRequestsQuery */
        $q = $this->useExistsQuery('WfRequests', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to WfRequests table for a NOT EXISTS query.
     *
     * @see useWfRequestsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\WfRequestsQuery The inner query object of the NOT EXISTS statement
     */
    public function useWfRequestsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\WfRequestsQuery */
        $q = $this->useExistsQuery('WfRequests', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to WfRequests table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\WfRequestsQuery The inner query object of the IN statement
     */
    public function useInWfRequestsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\WfRequestsQuery */
        $q = $this->useInQuery('WfRequests', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to WfRequests table for a NOT IN query.
     *
     * @see useWfRequestsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\WfRequestsQuery The inner query object of the NOT IN statement
     */
    public function useNotInWfRequestsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\WfRequestsQuery */
        $q = $this->useInQuery('WfRequests', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildWfSteps $wfSteps Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($wfSteps = null)
    {
        if ($wfSteps) {
            $this->addUsingAlias(WfStepsTableMap::COL_WF_STEPS_ID, $wfSteps->getWfStepsId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the wf_steps table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(WfStepsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            WfStepsTableMap::clearInstancePool();
            WfStepsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(WfStepsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(WfStepsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            WfStepsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            WfStepsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
