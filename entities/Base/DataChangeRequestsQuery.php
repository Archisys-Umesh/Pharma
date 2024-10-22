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
use entities\DataChangeRequests as ChildDataChangeRequests;
use entities\DataChangeRequestsQuery as ChildDataChangeRequestsQuery;
use entities\Map\DataChangeRequestsTableMap;

/**
 * Base class that represents a query for the `data_change_requests` table.
 *
 * @method     ChildDataChangeRequestsQuery orderByDataChangeRequestId($order = Criteria::ASC) Order by the data_change_request_id column
 * @method     ChildDataChangeRequestsQuery orderByImportTemplate($order = Criteria::ASC) Order by the import_template column
 * @method     ChildDataChangeRequestsQuery orderByImportFilePath($order = Criteria::ASC) Order by the import_file_path column
 * @method     ChildDataChangeRequestsQuery orderByRequestedData($order = Criteria::ASC) Order by the requested_data column
 * @method     ChildDataChangeRequestsQuery orderByActionType($order = Criteria::ASC) Order by the action_type column
 * @method     ChildDataChangeRequestsQuery orderByScheduleDate($order = Criteria::ASC) Order by the schedule_date column
 * @method     ChildDataChangeRequestsQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method     ChildDataChangeRequestsQuery orderByHasError($order = Criteria::ASC) Order by the has_error column
 * @method     ChildDataChangeRequestsQuery orderByErrorMessage($order = Criteria::ASC) Order by the error_message column
 * @method     ChildDataChangeRequestsQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildDataChangeRequestsQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildDataChangeRequestsQuery orderByImportFileLogId($order = Criteria::ASC) Order by the import_file_log_id column
 * @method     ChildDataChangeRequestsQuery orderBySuccessIds($order = Criteria::ASC) Order by the success_ids column
 *
 * @method     ChildDataChangeRequestsQuery groupByDataChangeRequestId() Group by the data_change_request_id column
 * @method     ChildDataChangeRequestsQuery groupByImportTemplate() Group by the import_template column
 * @method     ChildDataChangeRequestsQuery groupByImportFilePath() Group by the import_file_path column
 * @method     ChildDataChangeRequestsQuery groupByRequestedData() Group by the requested_data column
 * @method     ChildDataChangeRequestsQuery groupByActionType() Group by the action_type column
 * @method     ChildDataChangeRequestsQuery groupByScheduleDate() Group by the schedule_date column
 * @method     ChildDataChangeRequestsQuery groupByStatus() Group by the status column
 * @method     ChildDataChangeRequestsQuery groupByHasError() Group by the has_error column
 * @method     ChildDataChangeRequestsQuery groupByErrorMessage() Group by the error_message column
 * @method     ChildDataChangeRequestsQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildDataChangeRequestsQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildDataChangeRequestsQuery groupByImportFileLogId() Group by the import_file_log_id column
 * @method     ChildDataChangeRequestsQuery groupBySuccessIds() Group by the success_ids column
 *
 * @method     ChildDataChangeRequestsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildDataChangeRequestsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildDataChangeRequestsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildDataChangeRequestsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildDataChangeRequestsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildDataChangeRequestsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildDataChangeRequests|null findOne(?ConnectionInterface $con = null) Return the first ChildDataChangeRequests matching the query
 * @method     ChildDataChangeRequests findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildDataChangeRequests matching the query, or a new ChildDataChangeRequests object populated from the query conditions when no match is found
 *
 * @method     ChildDataChangeRequests|null findOneByDataChangeRequestId(int $data_change_request_id) Return the first ChildDataChangeRequests filtered by the data_change_request_id column
 * @method     ChildDataChangeRequests|null findOneByImportTemplate(string $import_template) Return the first ChildDataChangeRequests filtered by the import_template column
 * @method     ChildDataChangeRequests|null findOneByImportFilePath(string $import_file_path) Return the first ChildDataChangeRequests filtered by the import_file_path column
 * @method     ChildDataChangeRequests|null findOneByRequestedData(string $requested_data) Return the first ChildDataChangeRequests filtered by the requested_data column
 * @method     ChildDataChangeRequests|null findOneByActionType(string $action_type) Return the first ChildDataChangeRequests filtered by the action_type column
 * @method     ChildDataChangeRequests|null findOneByScheduleDate(string $schedule_date) Return the first ChildDataChangeRequests filtered by the schedule_date column
 * @method     ChildDataChangeRequests|null findOneByStatus(string $status) Return the first ChildDataChangeRequests filtered by the status column
 * @method     ChildDataChangeRequests|null findOneByHasError(boolean $has_error) Return the first ChildDataChangeRequests filtered by the has_error column
 * @method     ChildDataChangeRequests|null findOneByErrorMessage(string $error_message) Return the first ChildDataChangeRequests filtered by the error_message column
 * @method     ChildDataChangeRequests|null findOneByCreatedAt(string $created_at) Return the first ChildDataChangeRequests filtered by the created_at column
 * @method     ChildDataChangeRequests|null findOneByUpdatedAt(string $updated_at) Return the first ChildDataChangeRequests filtered by the updated_at column
 * @method     ChildDataChangeRequests|null findOneByImportFileLogId(int $import_file_log_id) Return the first ChildDataChangeRequests filtered by the import_file_log_id column
 * @method     ChildDataChangeRequests|null findOneBySuccessIds(string $success_ids) Return the first ChildDataChangeRequests filtered by the success_ids column
 *
 * @method     ChildDataChangeRequests requirePk($key, ?ConnectionInterface $con = null) Return the ChildDataChangeRequests by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDataChangeRequests requireOne(?ConnectionInterface $con = null) Return the first ChildDataChangeRequests matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDataChangeRequests requireOneByDataChangeRequestId(int $data_change_request_id) Return the first ChildDataChangeRequests filtered by the data_change_request_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDataChangeRequests requireOneByImportTemplate(string $import_template) Return the first ChildDataChangeRequests filtered by the import_template column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDataChangeRequests requireOneByImportFilePath(string $import_file_path) Return the first ChildDataChangeRequests filtered by the import_file_path column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDataChangeRequests requireOneByRequestedData(string $requested_data) Return the first ChildDataChangeRequests filtered by the requested_data column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDataChangeRequests requireOneByActionType(string $action_type) Return the first ChildDataChangeRequests filtered by the action_type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDataChangeRequests requireOneByScheduleDate(string $schedule_date) Return the first ChildDataChangeRequests filtered by the schedule_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDataChangeRequests requireOneByStatus(string $status) Return the first ChildDataChangeRequests filtered by the status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDataChangeRequests requireOneByHasError(boolean $has_error) Return the first ChildDataChangeRequests filtered by the has_error column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDataChangeRequests requireOneByErrorMessage(string $error_message) Return the first ChildDataChangeRequests filtered by the error_message column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDataChangeRequests requireOneByCreatedAt(string $created_at) Return the first ChildDataChangeRequests filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDataChangeRequests requireOneByUpdatedAt(string $updated_at) Return the first ChildDataChangeRequests filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDataChangeRequests requireOneByImportFileLogId(int $import_file_log_id) Return the first ChildDataChangeRequests filtered by the import_file_log_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDataChangeRequests requireOneBySuccessIds(string $success_ids) Return the first ChildDataChangeRequests filtered by the success_ids column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDataChangeRequests[]|Collection find(?ConnectionInterface $con = null) Return ChildDataChangeRequests objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildDataChangeRequests> find(?ConnectionInterface $con = null) Return ChildDataChangeRequests objects based on current ModelCriteria
 *
 * @method     ChildDataChangeRequests[]|Collection findByDataChangeRequestId(int|array<int> $data_change_request_id) Return ChildDataChangeRequests objects filtered by the data_change_request_id column
 * @psalm-method Collection&\Traversable<ChildDataChangeRequests> findByDataChangeRequestId(int|array<int> $data_change_request_id) Return ChildDataChangeRequests objects filtered by the data_change_request_id column
 * @method     ChildDataChangeRequests[]|Collection findByImportTemplate(string|array<string> $import_template) Return ChildDataChangeRequests objects filtered by the import_template column
 * @psalm-method Collection&\Traversable<ChildDataChangeRequests> findByImportTemplate(string|array<string> $import_template) Return ChildDataChangeRequests objects filtered by the import_template column
 * @method     ChildDataChangeRequests[]|Collection findByImportFilePath(string|array<string> $import_file_path) Return ChildDataChangeRequests objects filtered by the import_file_path column
 * @psalm-method Collection&\Traversable<ChildDataChangeRequests> findByImportFilePath(string|array<string> $import_file_path) Return ChildDataChangeRequests objects filtered by the import_file_path column
 * @method     ChildDataChangeRequests[]|Collection findByRequestedData(string|array<string> $requested_data) Return ChildDataChangeRequests objects filtered by the requested_data column
 * @psalm-method Collection&\Traversable<ChildDataChangeRequests> findByRequestedData(string|array<string> $requested_data) Return ChildDataChangeRequests objects filtered by the requested_data column
 * @method     ChildDataChangeRequests[]|Collection findByActionType(string|array<string> $action_type) Return ChildDataChangeRequests objects filtered by the action_type column
 * @psalm-method Collection&\Traversable<ChildDataChangeRequests> findByActionType(string|array<string> $action_type) Return ChildDataChangeRequests objects filtered by the action_type column
 * @method     ChildDataChangeRequests[]|Collection findByScheduleDate(string|array<string> $schedule_date) Return ChildDataChangeRequests objects filtered by the schedule_date column
 * @psalm-method Collection&\Traversable<ChildDataChangeRequests> findByScheduleDate(string|array<string> $schedule_date) Return ChildDataChangeRequests objects filtered by the schedule_date column
 * @method     ChildDataChangeRequests[]|Collection findByStatus(string|array<string> $status) Return ChildDataChangeRequests objects filtered by the status column
 * @psalm-method Collection&\Traversable<ChildDataChangeRequests> findByStatus(string|array<string> $status) Return ChildDataChangeRequests objects filtered by the status column
 * @method     ChildDataChangeRequests[]|Collection findByHasError(boolean|array<boolean> $has_error) Return ChildDataChangeRequests objects filtered by the has_error column
 * @psalm-method Collection&\Traversable<ChildDataChangeRequests> findByHasError(boolean|array<boolean> $has_error) Return ChildDataChangeRequests objects filtered by the has_error column
 * @method     ChildDataChangeRequests[]|Collection findByErrorMessage(string|array<string> $error_message) Return ChildDataChangeRequests objects filtered by the error_message column
 * @psalm-method Collection&\Traversable<ChildDataChangeRequests> findByErrorMessage(string|array<string> $error_message) Return ChildDataChangeRequests objects filtered by the error_message column
 * @method     ChildDataChangeRequests[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildDataChangeRequests objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildDataChangeRequests> findByCreatedAt(string|array<string> $created_at) Return ChildDataChangeRequests objects filtered by the created_at column
 * @method     ChildDataChangeRequests[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildDataChangeRequests objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildDataChangeRequests> findByUpdatedAt(string|array<string> $updated_at) Return ChildDataChangeRequests objects filtered by the updated_at column
 * @method     ChildDataChangeRequests[]|Collection findByImportFileLogId(int|array<int> $import_file_log_id) Return ChildDataChangeRequests objects filtered by the import_file_log_id column
 * @psalm-method Collection&\Traversable<ChildDataChangeRequests> findByImportFileLogId(int|array<int> $import_file_log_id) Return ChildDataChangeRequests objects filtered by the import_file_log_id column
 * @method     ChildDataChangeRequests[]|Collection findBySuccessIds(string|array<string> $success_ids) Return ChildDataChangeRequests objects filtered by the success_ids column
 * @psalm-method Collection&\Traversable<ChildDataChangeRequests> findBySuccessIds(string|array<string> $success_ids) Return ChildDataChangeRequests objects filtered by the success_ids column
 *
 * @method     ChildDataChangeRequests[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildDataChangeRequests> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class DataChangeRequestsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\DataChangeRequestsQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\DataChangeRequests', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildDataChangeRequestsQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildDataChangeRequestsQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildDataChangeRequestsQuery) {
            return $criteria;
        }
        $query = new ChildDataChangeRequestsQuery();
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
     * @return ChildDataChangeRequests|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(DataChangeRequestsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = DataChangeRequestsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildDataChangeRequests A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT data_change_request_id, import_template, import_file_path, requested_data, action_type, schedule_date, status, has_error, error_message, created_at, updated_at, import_file_log_id, success_ids FROM data_change_requests WHERE data_change_request_id = :p0';
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
            /** @var ChildDataChangeRequests $obj */
            $obj = new ChildDataChangeRequests();
            $obj->hydrate($row);
            DataChangeRequestsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildDataChangeRequests|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(DataChangeRequestsTableMap::COL_DATA_CHANGE_REQUEST_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(DataChangeRequestsTableMap::COL_DATA_CHANGE_REQUEST_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the data_change_request_id column
     *
     * Example usage:
     * <code>
     * $query->filterByDataChangeRequestId(1234); // WHERE data_change_request_id = 1234
     * $query->filterByDataChangeRequestId(array(12, 34)); // WHERE data_change_request_id IN (12, 34)
     * $query->filterByDataChangeRequestId(array('min' => 12)); // WHERE data_change_request_id > 12
     * </code>
     *
     * @param mixed $dataChangeRequestId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDataChangeRequestId($dataChangeRequestId = null, ?string $comparison = null)
    {
        if (is_array($dataChangeRequestId)) {
            $useMinMax = false;
            if (isset($dataChangeRequestId['min'])) {
                $this->addUsingAlias(DataChangeRequestsTableMap::COL_DATA_CHANGE_REQUEST_ID, $dataChangeRequestId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dataChangeRequestId['max'])) {
                $this->addUsingAlias(DataChangeRequestsTableMap::COL_DATA_CHANGE_REQUEST_ID, $dataChangeRequestId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DataChangeRequestsTableMap::COL_DATA_CHANGE_REQUEST_ID, $dataChangeRequestId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the import_template column
     *
     * Example usage:
     * <code>
     * $query->filterByImportTemplate('fooValue');   // WHERE import_template = 'fooValue'
     * $query->filterByImportTemplate('%fooValue%', Criteria::LIKE); // WHERE import_template LIKE '%fooValue%'
     * $query->filterByImportTemplate(['foo', 'bar']); // WHERE import_template IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $importTemplate The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByImportTemplate($importTemplate = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($importTemplate)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DataChangeRequestsTableMap::COL_IMPORT_TEMPLATE, $importTemplate, $comparison);

        return $this;
    }

    /**
     * Filter the query on the import_file_path column
     *
     * Example usage:
     * <code>
     * $query->filterByImportFilePath('fooValue');   // WHERE import_file_path = 'fooValue'
     * $query->filterByImportFilePath('%fooValue%', Criteria::LIKE); // WHERE import_file_path LIKE '%fooValue%'
     * $query->filterByImportFilePath(['foo', 'bar']); // WHERE import_file_path IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $importFilePath The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByImportFilePath($importFilePath = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($importFilePath)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DataChangeRequestsTableMap::COL_IMPORT_FILE_PATH, $importFilePath, $comparison);

        return $this;
    }

    /**
     * Filter the query on the requested_data column
     *
     * Example usage:
     * <code>
     * $query->filterByRequestedData('fooValue');   // WHERE requested_data = 'fooValue'
     * $query->filterByRequestedData('%fooValue%', Criteria::LIKE); // WHERE requested_data LIKE '%fooValue%'
     * $query->filterByRequestedData(['foo', 'bar']); // WHERE requested_data IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $requestedData The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRequestedData($requestedData = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($requestedData)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DataChangeRequestsTableMap::COL_REQUESTED_DATA, $requestedData, $comparison);

        return $this;
    }

    /**
     * Filter the query on the action_type column
     *
     * Example usage:
     * <code>
     * $query->filterByActionType('fooValue');   // WHERE action_type = 'fooValue'
     * $query->filterByActionType('%fooValue%', Criteria::LIKE); // WHERE action_type LIKE '%fooValue%'
     * $query->filterByActionType(['foo', 'bar']); // WHERE action_type IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $actionType The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByActionType($actionType = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($actionType)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DataChangeRequestsTableMap::COL_ACTION_TYPE, $actionType, $comparison);

        return $this;
    }

    /**
     * Filter the query on the schedule_date column
     *
     * Example usage:
     * <code>
     * $query->filterByScheduleDate('2011-03-14'); // WHERE schedule_date = '2011-03-14'
     * $query->filterByScheduleDate('now'); // WHERE schedule_date = '2011-03-14'
     * $query->filterByScheduleDate(array('max' => 'yesterday')); // WHERE schedule_date > '2011-03-13'
     * </code>
     *
     * @param mixed $scheduleDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByScheduleDate($scheduleDate = null, ?string $comparison = null)
    {
        if (is_array($scheduleDate)) {
            $useMinMax = false;
            if (isset($scheduleDate['min'])) {
                $this->addUsingAlias(DataChangeRequestsTableMap::COL_SCHEDULE_DATE, $scheduleDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($scheduleDate['max'])) {
                $this->addUsingAlias(DataChangeRequestsTableMap::COL_SCHEDULE_DATE, $scheduleDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DataChangeRequestsTableMap::COL_SCHEDULE_DATE, $scheduleDate, $comparison);

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

        $this->addUsingAlias(DataChangeRequestsTableMap::COL_STATUS, $status, $comparison);

        return $this;
    }

    /**
     * Filter the query on the has_error column
     *
     * Example usage:
     * <code>
     * $query->filterByHasError(true); // WHERE has_error = true
     * $query->filterByHasError('yes'); // WHERE has_error = true
     * </code>
     *
     * @param bool|string $hasError The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByHasError($hasError = null, ?string $comparison = null)
    {
        if (is_string($hasError)) {
            $hasError = in_array(strtolower($hasError), array('false', 'off', '-', 'no', 'n', '0', ''), true) ? false : true;
        }

        $this->addUsingAlias(DataChangeRequestsTableMap::COL_HAS_ERROR, $hasError, $comparison);

        return $this;
    }

    /**
     * Filter the query on the error_message column
     *
     * Example usage:
     * <code>
     * $query->filterByErrorMessage('fooValue');   // WHERE error_message = 'fooValue'
     * $query->filterByErrorMessage('%fooValue%', Criteria::LIKE); // WHERE error_message LIKE '%fooValue%'
     * $query->filterByErrorMessage(['foo', 'bar']); // WHERE error_message IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $errorMessage The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByErrorMessage($errorMessage = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($errorMessage)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DataChangeRequestsTableMap::COL_ERROR_MESSAGE, $errorMessage, $comparison);

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
                $this->addUsingAlias(DataChangeRequestsTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(DataChangeRequestsTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DataChangeRequestsTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(DataChangeRequestsTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(DataChangeRequestsTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DataChangeRequestsTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the import_file_log_id column
     *
     * Example usage:
     * <code>
     * $query->filterByImportFileLogId(1234); // WHERE import_file_log_id = 1234
     * $query->filterByImportFileLogId(array(12, 34)); // WHERE import_file_log_id IN (12, 34)
     * $query->filterByImportFileLogId(array('min' => 12)); // WHERE import_file_log_id > 12
     * </code>
     *
     * @param mixed $importFileLogId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByImportFileLogId($importFileLogId = null, ?string $comparison = null)
    {
        if (is_array($importFileLogId)) {
            $useMinMax = false;
            if (isset($importFileLogId['min'])) {
                $this->addUsingAlias(DataChangeRequestsTableMap::COL_IMPORT_FILE_LOG_ID, $importFileLogId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($importFileLogId['max'])) {
                $this->addUsingAlias(DataChangeRequestsTableMap::COL_IMPORT_FILE_LOG_ID, $importFileLogId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DataChangeRequestsTableMap::COL_IMPORT_FILE_LOG_ID, $importFileLogId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the success_ids column
     *
     * Example usage:
     * <code>
     * $query->filterBySuccessIds('fooValue');   // WHERE success_ids = 'fooValue'
     * $query->filterBySuccessIds('%fooValue%', Criteria::LIKE); // WHERE success_ids LIKE '%fooValue%'
     * $query->filterBySuccessIds(['foo', 'bar']); // WHERE success_ids IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $successIds The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySuccessIds($successIds = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($successIds)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DataChangeRequestsTableMap::COL_SUCCESS_IDS, $successIds, $comparison);

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildDataChangeRequests $dataChangeRequests Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($dataChangeRequests = null)
    {
        if ($dataChangeRequests) {
            $this->addUsingAlias(DataChangeRequestsTableMap::COL_DATA_CHANGE_REQUEST_ID, $dataChangeRequests->getDataChangeRequestId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the data_change_requests table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DataChangeRequestsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            DataChangeRequestsTableMap::clearInstancePool();
            DataChangeRequestsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(DataChangeRequestsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(DataChangeRequestsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            DataChangeRequestsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            DataChangeRequestsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
