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
use entities\WfLog as ChildWfLog;
use entities\WfLogQuery as ChildWfLogQuery;
use entities\Map\WfLogTableMap;

/**
 * Base class that represents a query for the `wf_log` table.
 *
 * @method     ChildWfLogQuery orderByWfLogId($order = Criteria::ASC) Order by the wf_log_id column
 * @method     ChildWfLogQuery orderByWfDocId($order = Criteria::ASC) Order by the wf_doc_id column
 * @method     ChildWfLogQuery orderByWfDocPk($order = Criteria::ASC) Order by the wf_doc_pk column
 * @method     ChildWfLogQuery orderByWfStatusId($order = Criteria::ASC) Order by the wf_status_id column
 * @method     ChildWfLogQuery orderByWfOldStatusId($order = Criteria::ASC) Order by the wf_old_status_id column
 * @method     ChildWfLogQuery orderByWfLevel($order = Criteria::ASC) Order by the wf_level column
 * @method     ChildWfLogQuery orderByWfEmployeeId($order = Criteria::ASC) Order by the wf_employee_id column
 * @method     ChildWfLogQuery orderByWfTitle($order = Criteria::ASC) Order by the wf_title column
 * @method     ChildWfLogQuery orderByWfNote($order = Criteria::ASC) Order by the wf_note column
 * @method     ChildWfLogQuery orderByWfRequestId($order = Criteria::ASC) Order by the wf_request_id column
 * @method     ChildWfLogQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 *
 * @method     ChildWfLogQuery groupByWfLogId() Group by the wf_log_id column
 * @method     ChildWfLogQuery groupByWfDocId() Group by the wf_doc_id column
 * @method     ChildWfLogQuery groupByWfDocPk() Group by the wf_doc_pk column
 * @method     ChildWfLogQuery groupByWfStatusId() Group by the wf_status_id column
 * @method     ChildWfLogQuery groupByWfOldStatusId() Group by the wf_old_status_id column
 * @method     ChildWfLogQuery groupByWfLevel() Group by the wf_level column
 * @method     ChildWfLogQuery groupByWfEmployeeId() Group by the wf_employee_id column
 * @method     ChildWfLogQuery groupByWfTitle() Group by the wf_title column
 * @method     ChildWfLogQuery groupByWfNote() Group by the wf_note column
 * @method     ChildWfLogQuery groupByWfRequestId() Group by the wf_request_id column
 * @method     ChildWfLogQuery groupByCreatedAt() Group by the created_at column
 *
 * @method     ChildWfLogQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildWfLogQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildWfLogQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildWfLogQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildWfLogQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildWfLogQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildWfLogQuery leftJoinEmployee($relationAlias = null) Adds a LEFT JOIN clause to the query using the Employee relation
 * @method     ChildWfLogQuery rightJoinEmployee($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Employee relation
 * @method     ChildWfLogQuery innerJoinEmployee($relationAlias = null) Adds a INNER JOIN clause to the query using the Employee relation
 *
 * @method     ChildWfLogQuery joinWithEmployee($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Employee relation
 *
 * @method     ChildWfLogQuery leftJoinWithEmployee() Adds a LEFT JOIN clause and with to the query using the Employee relation
 * @method     ChildWfLogQuery rightJoinWithEmployee() Adds a RIGHT JOIN clause and with to the query using the Employee relation
 * @method     ChildWfLogQuery innerJoinWithEmployee() Adds a INNER JOIN clause and with to the query using the Employee relation
 *
 * @method     ChildWfLogQuery leftJoinWfDocuments($relationAlias = null) Adds a LEFT JOIN clause to the query using the WfDocuments relation
 * @method     ChildWfLogQuery rightJoinWfDocuments($relationAlias = null) Adds a RIGHT JOIN clause to the query using the WfDocuments relation
 * @method     ChildWfLogQuery innerJoinWfDocuments($relationAlias = null) Adds a INNER JOIN clause to the query using the WfDocuments relation
 *
 * @method     ChildWfLogQuery joinWithWfDocuments($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the WfDocuments relation
 *
 * @method     ChildWfLogQuery leftJoinWithWfDocuments() Adds a LEFT JOIN clause and with to the query using the WfDocuments relation
 * @method     ChildWfLogQuery rightJoinWithWfDocuments() Adds a RIGHT JOIN clause and with to the query using the WfDocuments relation
 * @method     ChildWfLogQuery innerJoinWithWfDocuments() Adds a INNER JOIN clause and with to the query using the WfDocuments relation
 *
 * @method     \entities\EmployeeQuery|\entities\WfDocumentsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildWfLog|null findOne(?ConnectionInterface $con = null) Return the first ChildWfLog matching the query
 * @method     ChildWfLog findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildWfLog matching the query, or a new ChildWfLog object populated from the query conditions when no match is found
 *
 * @method     ChildWfLog|null findOneByWfLogId(int $wf_log_id) Return the first ChildWfLog filtered by the wf_log_id column
 * @method     ChildWfLog|null findOneByWfDocId(int $wf_doc_id) Return the first ChildWfLog filtered by the wf_doc_id column
 * @method     ChildWfLog|null findOneByWfDocPk(int $wf_doc_pk) Return the first ChildWfLog filtered by the wf_doc_pk column
 * @method     ChildWfLog|null findOneByWfStatusId(int $wf_status_id) Return the first ChildWfLog filtered by the wf_status_id column
 * @method     ChildWfLog|null findOneByWfOldStatusId(int $wf_old_status_id) Return the first ChildWfLog filtered by the wf_old_status_id column
 * @method     ChildWfLog|null findOneByWfLevel(int $wf_level) Return the first ChildWfLog filtered by the wf_level column
 * @method     ChildWfLog|null findOneByWfEmployeeId(int $wf_employee_id) Return the first ChildWfLog filtered by the wf_employee_id column
 * @method     ChildWfLog|null findOneByWfTitle(string $wf_title) Return the first ChildWfLog filtered by the wf_title column
 * @method     ChildWfLog|null findOneByWfNote(string $wf_note) Return the first ChildWfLog filtered by the wf_note column
 * @method     ChildWfLog|null findOneByWfRequestId(int $wf_request_id) Return the first ChildWfLog filtered by the wf_request_id column
 * @method     ChildWfLog|null findOneByCreatedAt(string $created_at) Return the first ChildWfLog filtered by the created_at column
 *
 * @method     ChildWfLog requirePk($key, ?ConnectionInterface $con = null) Return the ChildWfLog by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWfLog requireOne(?ConnectionInterface $con = null) Return the first ChildWfLog matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildWfLog requireOneByWfLogId(int $wf_log_id) Return the first ChildWfLog filtered by the wf_log_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWfLog requireOneByWfDocId(int $wf_doc_id) Return the first ChildWfLog filtered by the wf_doc_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWfLog requireOneByWfDocPk(int $wf_doc_pk) Return the first ChildWfLog filtered by the wf_doc_pk column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWfLog requireOneByWfStatusId(int $wf_status_id) Return the first ChildWfLog filtered by the wf_status_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWfLog requireOneByWfOldStatusId(int $wf_old_status_id) Return the first ChildWfLog filtered by the wf_old_status_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWfLog requireOneByWfLevel(int $wf_level) Return the first ChildWfLog filtered by the wf_level column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWfLog requireOneByWfEmployeeId(int $wf_employee_id) Return the first ChildWfLog filtered by the wf_employee_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWfLog requireOneByWfTitle(string $wf_title) Return the first ChildWfLog filtered by the wf_title column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWfLog requireOneByWfNote(string $wf_note) Return the first ChildWfLog filtered by the wf_note column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWfLog requireOneByWfRequestId(int $wf_request_id) Return the first ChildWfLog filtered by the wf_request_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWfLog requireOneByCreatedAt(string $created_at) Return the first ChildWfLog filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildWfLog[]|Collection find(?ConnectionInterface $con = null) Return ChildWfLog objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildWfLog> find(?ConnectionInterface $con = null) Return ChildWfLog objects based on current ModelCriteria
 *
 * @method     ChildWfLog[]|Collection findByWfLogId(int|array<int> $wf_log_id) Return ChildWfLog objects filtered by the wf_log_id column
 * @psalm-method Collection&\Traversable<ChildWfLog> findByWfLogId(int|array<int> $wf_log_id) Return ChildWfLog objects filtered by the wf_log_id column
 * @method     ChildWfLog[]|Collection findByWfDocId(int|array<int> $wf_doc_id) Return ChildWfLog objects filtered by the wf_doc_id column
 * @psalm-method Collection&\Traversable<ChildWfLog> findByWfDocId(int|array<int> $wf_doc_id) Return ChildWfLog objects filtered by the wf_doc_id column
 * @method     ChildWfLog[]|Collection findByWfDocPk(int|array<int> $wf_doc_pk) Return ChildWfLog objects filtered by the wf_doc_pk column
 * @psalm-method Collection&\Traversable<ChildWfLog> findByWfDocPk(int|array<int> $wf_doc_pk) Return ChildWfLog objects filtered by the wf_doc_pk column
 * @method     ChildWfLog[]|Collection findByWfStatusId(int|array<int> $wf_status_id) Return ChildWfLog objects filtered by the wf_status_id column
 * @psalm-method Collection&\Traversable<ChildWfLog> findByWfStatusId(int|array<int> $wf_status_id) Return ChildWfLog objects filtered by the wf_status_id column
 * @method     ChildWfLog[]|Collection findByWfOldStatusId(int|array<int> $wf_old_status_id) Return ChildWfLog objects filtered by the wf_old_status_id column
 * @psalm-method Collection&\Traversable<ChildWfLog> findByWfOldStatusId(int|array<int> $wf_old_status_id) Return ChildWfLog objects filtered by the wf_old_status_id column
 * @method     ChildWfLog[]|Collection findByWfLevel(int|array<int> $wf_level) Return ChildWfLog objects filtered by the wf_level column
 * @psalm-method Collection&\Traversable<ChildWfLog> findByWfLevel(int|array<int> $wf_level) Return ChildWfLog objects filtered by the wf_level column
 * @method     ChildWfLog[]|Collection findByWfEmployeeId(int|array<int> $wf_employee_id) Return ChildWfLog objects filtered by the wf_employee_id column
 * @psalm-method Collection&\Traversable<ChildWfLog> findByWfEmployeeId(int|array<int> $wf_employee_id) Return ChildWfLog objects filtered by the wf_employee_id column
 * @method     ChildWfLog[]|Collection findByWfTitle(string|array<string> $wf_title) Return ChildWfLog objects filtered by the wf_title column
 * @psalm-method Collection&\Traversable<ChildWfLog> findByWfTitle(string|array<string> $wf_title) Return ChildWfLog objects filtered by the wf_title column
 * @method     ChildWfLog[]|Collection findByWfNote(string|array<string> $wf_note) Return ChildWfLog objects filtered by the wf_note column
 * @psalm-method Collection&\Traversable<ChildWfLog> findByWfNote(string|array<string> $wf_note) Return ChildWfLog objects filtered by the wf_note column
 * @method     ChildWfLog[]|Collection findByWfRequestId(int|array<int> $wf_request_id) Return ChildWfLog objects filtered by the wf_request_id column
 * @psalm-method Collection&\Traversable<ChildWfLog> findByWfRequestId(int|array<int> $wf_request_id) Return ChildWfLog objects filtered by the wf_request_id column
 * @method     ChildWfLog[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildWfLog objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildWfLog> findByCreatedAt(string|array<string> $created_at) Return ChildWfLog objects filtered by the created_at column
 *
 * @method     ChildWfLog[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildWfLog> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class WfLogQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\WfLogQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\WfLog', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildWfLogQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildWfLogQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildWfLogQuery) {
            return $criteria;
        }
        $query = new ChildWfLogQuery();
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
     * @return ChildWfLog|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(WfLogTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = WfLogTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildWfLog A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT wf_log_id, wf_doc_id, wf_doc_pk, wf_status_id, wf_old_status_id, wf_level, wf_employee_id, wf_title, wf_note, wf_request_id, created_at FROM wf_log WHERE wf_log_id = :p0';
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
            /** @var ChildWfLog $obj */
            $obj = new ChildWfLog();
            $obj->hydrate($row);
            WfLogTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildWfLog|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(WfLogTableMap::COL_WF_LOG_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(WfLogTableMap::COL_WF_LOG_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the wf_log_id column
     *
     * Example usage:
     * <code>
     * $query->filterByWfLogId(1234); // WHERE wf_log_id = 1234
     * $query->filterByWfLogId(array(12, 34)); // WHERE wf_log_id IN (12, 34)
     * $query->filterByWfLogId(array('min' => 12)); // WHERE wf_log_id > 12
     * </code>
     *
     * @param mixed $wfLogId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWfLogId($wfLogId = null, ?string $comparison = null)
    {
        if (is_array($wfLogId)) {
            $useMinMax = false;
            if (isset($wfLogId['min'])) {
                $this->addUsingAlias(WfLogTableMap::COL_WF_LOG_ID, $wfLogId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($wfLogId['max'])) {
                $this->addUsingAlias(WfLogTableMap::COL_WF_LOG_ID, $wfLogId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WfLogTableMap::COL_WF_LOG_ID, $wfLogId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the wf_doc_id column
     *
     * Example usage:
     * <code>
     * $query->filterByWfDocId(1234); // WHERE wf_doc_id = 1234
     * $query->filterByWfDocId(array(12, 34)); // WHERE wf_doc_id IN (12, 34)
     * $query->filterByWfDocId(array('min' => 12)); // WHERE wf_doc_id > 12
     * </code>
     *
     * @see       filterByWfDocuments()
     *
     * @param mixed $wfDocId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWfDocId($wfDocId = null, ?string $comparison = null)
    {
        if (is_array($wfDocId)) {
            $useMinMax = false;
            if (isset($wfDocId['min'])) {
                $this->addUsingAlias(WfLogTableMap::COL_WF_DOC_ID, $wfDocId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($wfDocId['max'])) {
                $this->addUsingAlias(WfLogTableMap::COL_WF_DOC_ID, $wfDocId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WfLogTableMap::COL_WF_DOC_ID, $wfDocId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the wf_doc_pk column
     *
     * Example usage:
     * <code>
     * $query->filterByWfDocPk(1234); // WHERE wf_doc_pk = 1234
     * $query->filterByWfDocPk(array(12, 34)); // WHERE wf_doc_pk IN (12, 34)
     * $query->filterByWfDocPk(array('min' => 12)); // WHERE wf_doc_pk > 12
     * </code>
     *
     * @param mixed $wfDocPk The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWfDocPk($wfDocPk = null, ?string $comparison = null)
    {
        if (is_array($wfDocPk)) {
            $useMinMax = false;
            if (isset($wfDocPk['min'])) {
                $this->addUsingAlias(WfLogTableMap::COL_WF_DOC_PK, $wfDocPk['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($wfDocPk['max'])) {
                $this->addUsingAlias(WfLogTableMap::COL_WF_DOC_PK, $wfDocPk['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WfLogTableMap::COL_WF_DOC_PK, $wfDocPk, $comparison);

        return $this;
    }

    /**
     * Filter the query on the wf_status_id column
     *
     * Example usage:
     * <code>
     * $query->filterByWfStatusId(1234); // WHERE wf_status_id = 1234
     * $query->filterByWfStatusId(array(12, 34)); // WHERE wf_status_id IN (12, 34)
     * $query->filterByWfStatusId(array('min' => 12)); // WHERE wf_status_id > 12
     * </code>
     *
     * @param mixed $wfStatusId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWfStatusId($wfStatusId = null, ?string $comparison = null)
    {
        if (is_array($wfStatusId)) {
            $useMinMax = false;
            if (isset($wfStatusId['min'])) {
                $this->addUsingAlias(WfLogTableMap::COL_WF_STATUS_ID, $wfStatusId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($wfStatusId['max'])) {
                $this->addUsingAlias(WfLogTableMap::COL_WF_STATUS_ID, $wfStatusId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WfLogTableMap::COL_WF_STATUS_ID, $wfStatusId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the wf_old_status_id column
     *
     * Example usage:
     * <code>
     * $query->filterByWfOldStatusId(1234); // WHERE wf_old_status_id = 1234
     * $query->filterByWfOldStatusId(array(12, 34)); // WHERE wf_old_status_id IN (12, 34)
     * $query->filterByWfOldStatusId(array('min' => 12)); // WHERE wf_old_status_id > 12
     * </code>
     *
     * @param mixed $wfOldStatusId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWfOldStatusId($wfOldStatusId = null, ?string $comparison = null)
    {
        if (is_array($wfOldStatusId)) {
            $useMinMax = false;
            if (isset($wfOldStatusId['min'])) {
                $this->addUsingAlias(WfLogTableMap::COL_WF_OLD_STATUS_ID, $wfOldStatusId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($wfOldStatusId['max'])) {
                $this->addUsingAlias(WfLogTableMap::COL_WF_OLD_STATUS_ID, $wfOldStatusId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WfLogTableMap::COL_WF_OLD_STATUS_ID, $wfOldStatusId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the wf_level column
     *
     * Example usage:
     * <code>
     * $query->filterByWfLevel(1234); // WHERE wf_level = 1234
     * $query->filterByWfLevel(array(12, 34)); // WHERE wf_level IN (12, 34)
     * $query->filterByWfLevel(array('min' => 12)); // WHERE wf_level > 12
     * </code>
     *
     * @param mixed $wfLevel The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWfLevel($wfLevel = null, ?string $comparison = null)
    {
        if (is_array($wfLevel)) {
            $useMinMax = false;
            if (isset($wfLevel['min'])) {
                $this->addUsingAlias(WfLogTableMap::COL_WF_LEVEL, $wfLevel['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($wfLevel['max'])) {
                $this->addUsingAlias(WfLogTableMap::COL_WF_LEVEL, $wfLevel['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WfLogTableMap::COL_WF_LEVEL, $wfLevel, $comparison);

        return $this;
    }

    /**
     * Filter the query on the wf_employee_id column
     *
     * Example usage:
     * <code>
     * $query->filterByWfEmployeeId(1234); // WHERE wf_employee_id = 1234
     * $query->filterByWfEmployeeId(array(12, 34)); // WHERE wf_employee_id IN (12, 34)
     * $query->filterByWfEmployeeId(array('min' => 12)); // WHERE wf_employee_id > 12
     * </code>
     *
     * @see       filterByEmployee()
     *
     * @param mixed $wfEmployeeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWfEmployeeId($wfEmployeeId = null, ?string $comparison = null)
    {
        if (is_array($wfEmployeeId)) {
            $useMinMax = false;
            if (isset($wfEmployeeId['min'])) {
                $this->addUsingAlias(WfLogTableMap::COL_WF_EMPLOYEE_ID, $wfEmployeeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($wfEmployeeId['max'])) {
                $this->addUsingAlias(WfLogTableMap::COL_WF_EMPLOYEE_ID, $wfEmployeeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WfLogTableMap::COL_WF_EMPLOYEE_ID, $wfEmployeeId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the wf_title column
     *
     * Example usage:
     * <code>
     * $query->filterByWfTitle('fooValue');   // WHERE wf_title = 'fooValue'
     * $query->filterByWfTitle('%fooValue%', Criteria::LIKE); // WHERE wf_title LIKE '%fooValue%'
     * $query->filterByWfTitle(['foo', 'bar']); // WHERE wf_title IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $wfTitle The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWfTitle($wfTitle = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($wfTitle)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WfLogTableMap::COL_WF_TITLE, $wfTitle, $comparison);

        return $this;
    }

    /**
     * Filter the query on the wf_note column
     *
     * Example usage:
     * <code>
     * $query->filterByWfNote('fooValue');   // WHERE wf_note = 'fooValue'
     * $query->filterByWfNote('%fooValue%', Criteria::LIKE); // WHERE wf_note LIKE '%fooValue%'
     * $query->filterByWfNote(['foo', 'bar']); // WHERE wf_note IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $wfNote The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWfNote($wfNote = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($wfNote)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WfLogTableMap::COL_WF_NOTE, $wfNote, $comparison);

        return $this;
    }

    /**
     * Filter the query on the wf_request_id column
     *
     * Example usage:
     * <code>
     * $query->filterByWfRequestId(1234); // WHERE wf_request_id = 1234
     * $query->filterByWfRequestId(array(12, 34)); // WHERE wf_request_id IN (12, 34)
     * $query->filterByWfRequestId(array('min' => 12)); // WHERE wf_request_id > 12
     * </code>
     *
     * @param mixed $wfRequestId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWfRequestId($wfRequestId = null, ?string $comparison = null)
    {
        if (is_array($wfRequestId)) {
            $useMinMax = false;
            if (isset($wfRequestId['min'])) {
                $this->addUsingAlias(WfLogTableMap::COL_WF_REQUEST_ID, $wfRequestId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($wfRequestId['max'])) {
                $this->addUsingAlias(WfLogTableMap::COL_WF_REQUEST_ID, $wfRequestId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WfLogTableMap::COL_WF_REQUEST_ID, $wfRequestId, $comparison);

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
                $this->addUsingAlias(WfLogTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(WfLogTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WfLogTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                ->addUsingAlias(WfLogTableMap::COL_WF_EMPLOYEE_ID, $employee->getEmployeeId(), $comparison);
        } elseif ($employee instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(WfLogTableMap::COL_WF_EMPLOYEE_ID, $employee->toKeyValue('PrimaryKey', 'EmployeeId'), $comparison);

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
    public function joinEmployee(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
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
    public function useEmployeeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
        ?string $joinType = Criteria::INNER_JOIN
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
     * Filter the query by a related \entities\WfDocuments object
     *
     * @param \entities\WfDocuments|ObjectCollection $wfDocuments The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWfDocuments($wfDocuments, ?string $comparison = null)
    {
        if ($wfDocuments instanceof \entities\WfDocuments) {
            return $this
                ->addUsingAlias(WfLogTableMap::COL_WF_DOC_ID, $wfDocuments->getWfDocId(), $comparison);
        } elseif ($wfDocuments instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(WfLogTableMap::COL_WF_DOC_ID, $wfDocuments->toKeyValue('PrimaryKey', 'WfDocId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByWfDocuments() only accepts arguments of type \entities\WfDocuments or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the WfDocuments relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinWfDocuments(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('WfDocuments');

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
            $this->addJoinObject($join, 'WfDocuments');
        }

        return $this;
    }

    /**
     * Use the WfDocuments relation WfDocuments object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\WfDocumentsQuery A secondary query class using the current class as primary query
     */
    public function useWfDocumentsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinWfDocuments($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'WfDocuments', '\entities\WfDocumentsQuery');
    }

    /**
     * Use the WfDocuments relation WfDocuments object
     *
     * @param callable(\entities\WfDocumentsQuery):\entities\WfDocumentsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withWfDocumentsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useWfDocumentsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to WfDocuments table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\WfDocumentsQuery The inner query object of the EXISTS statement
     */
    public function useWfDocumentsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\WfDocumentsQuery */
        $q = $this->useExistsQuery('WfDocuments', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to WfDocuments table for a NOT EXISTS query.
     *
     * @see useWfDocumentsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\WfDocumentsQuery The inner query object of the NOT EXISTS statement
     */
    public function useWfDocumentsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\WfDocumentsQuery */
        $q = $this->useExistsQuery('WfDocuments', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to WfDocuments table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\WfDocumentsQuery The inner query object of the IN statement
     */
    public function useInWfDocumentsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\WfDocumentsQuery */
        $q = $this->useInQuery('WfDocuments', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to WfDocuments table for a NOT IN query.
     *
     * @see useWfDocumentsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\WfDocumentsQuery The inner query object of the NOT IN statement
     */
    public function useNotInWfDocumentsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\WfDocumentsQuery */
        $q = $this->useInQuery('WfDocuments', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildWfLog $wfLog Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($wfLog = null)
    {
        if ($wfLog) {
            $this->addUsingAlias(WfLogTableMap::COL_WF_LOG_ID, $wfLog->getWfLogId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the wf_log table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(WfLogTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            WfLogTableMap::clearInstancePool();
            WfLogTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(WfLogTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(WfLogTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            WfLogTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            WfLogTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
