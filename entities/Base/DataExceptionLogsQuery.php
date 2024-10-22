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
use entities\DataExceptionLogs as ChildDataExceptionLogs;
use entities\DataExceptionLogsQuery as ChildDataExceptionLogsQuery;
use entities\Map\DataExceptionLogsTableMap;

/**
 * Base class that represents a query for the `data_exception_logs` table.
 *
 * @method     ChildDataExceptionLogsQuery orderByDataExceptionLogId($order = Criteria::ASC) Order by the data_exception_log_id column
 * @method     ChildDataExceptionLogsQuery orderByDataExceptionId($order = Criteria::ASC) Order by the data_exception_id column
 * @method     ChildDataExceptionLogsQuery orderByDate($order = Criteria::ASC) Order by the date column
 * @method     ChildDataExceptionLogsQuery orderByHasException($order = Criteria::ASC) Order by the has_exception column
 * @method     ChildDataExceptionLogsQuery orderByExceptionData($order = Criteria::ASC) Order by the exception_data column
 * @method     ChildDataExceptionLogsQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildDataExceptionLogsQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildDataExceptionLogsQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 *
 * @method     ChildDataExceptionLogsQuery groupByDataExceptionLogId() Group by the data_exception_log_id column
 * @method     ChildDataExceptionLogsQuery groupByDataExceptionId() Group by the data_exception_id column
 * @method     ChildDataExceptionLogsQuery groupByDate() Group by the date column
 * @method     ChildDataExceptionLogsQuery groupByHasException() Group by the has_exception column
 * @method     ChildDataExceptionLogsQuery groupByExceptionData() Group by the exception_data column
 * @method     ChildDataExceptionLogsQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildDataExceptionLogsQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildDataExceptionLogsQuery groupByCompanyId() Group by the company_id column
 *
 * @method     ChildDataExceptionLogsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildDataExceptionLogsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildDataExceptionLogsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildDataExceptionLogsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildDataExceptionLogsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildDataExceptionLogsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildDataExceptionLogsQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildDataExceptionLogsQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildDataExceptionLogsQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildDataExceptionLogsQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildDataExceptionLogsQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildDataExceptionLogsQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildDataExceptionLogsQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     ChildDataExceptionLogsQuery leftJoinDataExceptions($relationAlias = null) Adds a LEFT JOIN clause to the query using the DataExceptions relation
 * @method     ChildDataExceptionLogsQuery rightJoinDataExceptions($relationAlias = null) Adds a RIGHT JOIN clause to the query using the DataExceptions relation
 * @method     ChildDataExceptionLogsQuery innerJoinDataExceptions($relationAlias = null) Adds a INNER JOIN clause to the query using the DataExceptions relation
 *
 * @method     ChildDataExceptionLogsQuery joinWithDataExceptions($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the DataExceptions relation
 *
 * @method     ChildDataExceptionLogsQuery leftJoinWithDataExceptions() Adds a LEFT JOIN clause and with to the query using the DataExceptions relation
 * @method     ChildDataExceptionLogsQuery rightJoinWithDataExceptions() Adds a RIGHT JOIN clause and with to the query using the DataExceptions relation
 * @method     ChildDataExceptionLogsQuery innerJoinWithDataExceptions() Adds a INNER JOIN clause and with to the query using the DataExceptions relation
 *
 * @method     \entities\CompanyQuery|\entities\DataExceptionsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildDataExceptionLogs|null findOne(?ConnectionInterface $con = null) Return the first ChildDataExceptionLogs matching the query
 * @method     ChildDataExceptionLogs findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildDataExceptionLogs matching the query, or a new ChildDataExceptionLogs object populated from the query conditions when no match is found
 *
 * @method     ChildDataExceptionLogs|null findOneByDataExceptionLogId(int $data_exception_log_id) Return the first ChildDataExceptionLogs filtered by the data_exception_log_id column
 * @method     ChildDataExceptionLogs|null findOneByDataExceptionId(int $data_exception_id) Return the first ChildDataExceptionLogs filtered by the data_exception_id column
 * @method     ChildDataExceptionLogs|null findOneByDate(string $date) Return the first ChildDataExceptionLogs filtered by the date column
 * @method     ChildDataExceptionLogs|null findOneByHasException(boolean $has_exception) Return the first ChildDataExceptionLogs filtered by the has_exception column
 * @method     ChildDataExceptionLogs|null findOneByExceptionData(string $exception_data) Return the first ChildDataExceptionLogs filtered by the exception_data column
 * @method     ChildDataExceptionLogs|null findOneByCreatedAt(string $created_at) Return the first ChildDataExceptionLogs filtered by the created_at column
 * @method     ChildDataExceptionLogs|null findOneByUpdatedAt(string $updated_at) Return the first ChildDataExceptionLogs filtered by the updated_at column
 * @method     ChildDataExceptionLogs|null findOneByCompanyId(int $company_id) Return the first ChildDataExceptionLogs filtered by the company_id column
 *
 * @method     ChildDataExceptionLogs requirePk($key, ?ConnectionInterface $con = null) Return the ChildDataExceptionLogs by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDataExceptionLogs requireOne(?ConnectionInterface $con = null) Return the first ChildDataExceptionLogs matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDataExceptionLogs requireOneByDataExceptionLogId(int $data_exception_log_id) Return the first ChildDataExceptionLogs filtered by the data_exception_log_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDataExceptionLogs requireOneByDataExceptionId(int $data_exception_id) Return the first ChildDataExceptionLogs filtered by the data_exception_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDataExceptionLogs requireOneByDate(string $date) Return the first ChildDataExceptionLogs filtered by the date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDataExceptionLogs requireOneByHasException(boolean $has_exception) Return the first ChildDataExceptionLogs filtered by the has_exception column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDataExceptionLogs requireOneByExceptionData(string $exception_data) Return the first ChildDataExceptionLogs filtered by the exception_data column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDataExceptionLogs requireOneByCreatedAt(string $created_at) Return the first ChildDataExceptionLogs filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDataExceptionLogs requireOneByUpdatedAt(string $updated_at) Return the first ChildDataExceptionLogs filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDataExceptionLogs requireOneByCompanyId(int $company_id) Return the first ChildDataExceptionLogs filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDataExceptionLogs[]|Collection find(?ConnectionInterface $con = null) Return ChildDataExceptionLogs objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildDataExceptionLogs> find(?ConnectionInterface $con = null) Return ChildDataExceptionLogs objects based on current ModelCriteria
 *
 * @method     ChildDataExceptionLogs[]|Collection findByDataExceptionLogId(int|array<int> $data_exception_log_id) Return ChildDataExceptionLogs objects filtered by the data_exception_log_id column
 * @psalm-method Collection&\Traversable<ChildDataExceptionLogs> findByDataExceptionLogId(int|array<int> $data_exception_log_id) Return ChildDataExceptionLogs objects filtered by the data_exception_log_id column
 * @method     ChildDataExceptionLogs[]|Collection findByDataExceptionId(int|array<int> $data_exception_id) Return ChildDataExceptionLogs objects filtered by the data_exception_id column
 * @psalm-method Collection&\Traversable<ChildDataExceptionLogs> findByDataExceptionId(int|array<int> $data_exception_id) Return ChildDataExceptionLogs objects filtered by the data_exception_id column
 * @method     ChildDataExceptionLogs[]|Collection findByDate(string|array<string> $date) Return ChildDataExceptionLogs objects filtered by the date column
 * @psalm-method Collection&\Traversable<ChildDataExceptionLogs> findByDate(string|array<string> $date) Return ChildDataExceptionLogs objects filtered by the date column
 * @method     ChildDataExceptionLogs[]|Collection findByHasException(boolean|array<boolean> $has_exception) Return ChildDataExceptionLogs objects filtered by the has_exception column
 * @psalm-method Collection&\Traversable<ChildDataExceptionLogs> findByHasException(boolean|array<boolean> $has_exception) Return ChildDataExceptionLogs objects filtered by the has_exception column
 * @method     ChildDataExceptionLogs[]|Collection findByExceptionData(string|array<string> $exception_data) Return ChildDataExceptionLogs objects filtered by the exception_data column
 * @psalm-method Collection&\Traversable<ChildDataExceptionLogs> findByExceptionData(string|array<string> $exception_data) Return ChildDataExceptionLogs objects filtered by the exception_data column
 * @method     ChildDataExceptionLogs[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildDataExceptionLogs objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildDataExceptionLogs> findByCreatedAt(string|array<string> $created_at) Return ChildDataExceptionLogs objects filtered by the created_at column
 * @method     ChildDataExceptionLogs[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildDataExceptionLogs objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildDataExceptionLogs> findByUpdatedAt(string|array<string> $updated_at) Return ChildDataExceptionLogs objects filtered by the updated_at column
 * @method     ChildDataExceptionLogs[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildDataExceptionLogs objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildDataExceptionLogs> findByCompanyId(int|array<int> $company_id) Return ChildDataExceptionLogs objects filtered by the company_id column
 *
 * @method     ChildDataExceptionLogs[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildDataExceptionLogs> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class DataExceptionLogsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\DataExceptionLogsQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\DataExceptionLogs', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildDataExceptionLogsQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildDataExceptionLogsQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildDataExceptionLogsQuery) {
            return $criteria;
        }
        $query = new ChildDataExceptionLogsQuery();
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
     * @return ChildDataExceptionLogs|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(DataExceptionLogsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = DataExceptionLogsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildDataExceptionLogs A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT data_exception_log_id, data_exception_id, date, has_exception, exception_data, created_at, updated_at, company_id FROM data_exception_logs WHERE data_exception_log_id = :p0';
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
            /** @var ChildDataExceptionLogs $obj */
            $obj = new ChildDataExceptionLogs();
            $obj->hydrate($row);
            DataExceptionLogsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildDataExceptionLogs|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(DataExceptionLogsTableMap::COL_DATA_EXCEPTION_LOG_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(DataExceptionLogsTableMap::COL_DATA_EXCEPTION_LOG_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the data_exception_log_id column
     *
     * Example usage:
     * <code>
     * $query->filterByDataExceptionLogId(1234); // WHERE data_exception_log_id = 1234
     * $query->filterByDataExceptionLogId(array(12, 34)); // WHERE data_exception_log_id IN (12, 34)
     * $query->filterByDataExceptionLogId(array('min' => 12)); // WHERE data_exception_log_id > 12
     * </code>
     *
     * @param mixed $dataExceptionLogId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDataExceptionLogId($dataExceptionLogId = null, ?string $comparison = null)
    {
        if (is_array($dataExceptionLogId)) {
            $useMinMax = false;
            if (isset($dataExceptionLogId['min'])) {
                $this->addUsingAlias(DataExceptionLogsTableMap::COL_DATA_EXCEPTION_LOG_ID, $dataExceptionLogId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dataExceptionLogId['max'])) {
                $this->addUsingAlias(DataExceptionLogsTableMap::COL_DATA_EXCEPTION_LOG_ID, $dataExceptionLogId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DataExceptionLogsTableMap::COL_DATA_EXCEPTION_LOG_ID, $dataExceptionLogId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the data_exception_id column
     *
     * Example usage:
     * <code>
     * $query->filterByDataExceptionId(1234); // WHERE data_exception_id = 1234
     * $query->filterByDataExceptionId(array(12, 34)); // WHERE data_exception_id IN (12, 34)
     * $query->filterByDataExceptionId(array('min' => 12)); // WHERE data_exception_id > 12
     * </code>
     *
     * @see       filterByDataExceptions()
     *
     * @param mixed $dataExceptionId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDataExceptionId($dataExceptionId = null, ?string $comparison = null)
    {
        if (is_array($dataExceptionId)) {
            $useMinMax = false;
            if (isset($dataExceptionId['min'])) {
                $this->addUsingAlias(DataExceptionLogsTableMap::COL_DATA_EXCEPTION_ID, $dataExceptionId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dataExceptionId['max'])) {
                $this->addUsingAlias(DataExceptionLogsTableMap::COL_DATA_EXCEPTION_ID, $dataExceptionId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DataExceptionLogsTableMap::COL_DATA_EXCEPTION_ID, $dataExceptionId, $comparison);

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
                $this->addUsingAlias(DataExceptionLogsTableMap::COL_DATE, $date['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($date['max'])) {
                $this->addUsingAlias(DataExceptionLogsTableMap::COL_DATE, $date['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DataExceptionLogsTableMap::COL_DATE, $date, $comparison);

        return $this;
    }

    /**
     * Filter the query on the has_exception column
     *
     * Example usage:
     * <code>
     * $query->filterByHasException(true); // WHERE has_exception = true
     * $query->filterByHasException('yes'); // WHERE has_exception = true
     * </code>
     *
     * @param bool|string $hasException The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByHasException($hasException = null, ?string $comparison = null)
    {
        if (is_string($hasException)) {
            $hasException = in_array(strtolower($hasException), array('false', 'off', '-', 'no', 'n', '0', ''), true) ? false : true;
        }

        $this->addUsingAlias(DataExceptionLogsTableMap::COL_HAS_EXCEPTION, $hasException, $comparison);

        return $this;
    }

    /**
     * Filter the query on the exception_data column
     *
     * Example usage:
     * <code>
     * $query->filterByExceptionData('fooValue');   // WHERE exception_data = 'fooValue'
     * $query->filterByExceptionData('%fooValue%', Criteria::LIKE); // WHERE exception_data LIKE '%fooValue%'
     * $query->filterByExceptionData(['foo', 'bar']); // WHERE exception_data IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $exceptionData The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExceptionData($exceptionData = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($exceptionData)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DataExceptionLogsTableMap::COL_EXCEPTION_DATA, $exceptionData, $comparison);

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
                $this->addUsingAlias(DataExceptionLogsTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(DataExceptionLogsTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DataExceptionLogsTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(DataExceptionLogsTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(DataExceptionLogsTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DataExceptionLogsTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

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
                $this->addUsingAlias(DataExceptionLogsTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(DataExceptionLogsTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DataExceptionLogsTableMap::COL_COMPANY_ID, $companyId, $comparison);

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
                ->addUsingAlias(DataExceptionLogsTableMap::COL_COMPANY_ID, $company->getCompanyId(), $comparison);
        } elseif ($company instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(DataExceptionLogsTableMap::COL_COMPANY_ID, $company->toKeyValue('PrimaryKey', 'CompanyId'), $comparison);

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
     * Filter the query by a related \entities\DataExceptions object
     *
     * @param \entities\DataExceptions|ObjectCollection $dataExceptions The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDataExceptions($dataExceptions, ?string $comparison = null)
    {
        if ($dataExceptions instanceof \entities\DataExceptions) {
            return $this
                ->addUsingAlias(DataExceptionLogsTableMap::COL_DATA_EXCEPTION_ID, $dataExceptions->getDataExceptionId(), $comparison);
        } elseif ($dataExceptions instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(DataExceptionLogsTableMap::COL_DATA_EXCEPTION_ID, $dataExceptions->toKeyValue('PrimaryKey', 'DataExceptionId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByDataExceptions() only accepts arguments of type \entities\DataExceptions or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the DataExceptions relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinDataExceptions(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('DataExceptions');

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
            $this->addJoinObject($join, 'DataExceptions');
        }

        return $this;
    }

    /**
     * Use the DataExceptions relation DataExceptions object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\DataExceptionsQuery A secondary query class using the current class as primary query
     */
    public function useDataExceptionsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinDataExceptions($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'DataExceptions', '\entities\DataExceptionsQuery');
    }

    /**
     * Use the DataExceptions relation DataExceptions object
     *
     * @param callable(\entities\DataExceptionsQuery):\entities\DataExceptionsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withDataExceptionsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useDataExceptionsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to DataExceptions table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\DataExceptionsQuery The inner query object of the EXISTS statement
     */
    public function useDataExceptionsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\DataExceptionsQuery */
        $q = $this->useExistsQuery('DataExceptions', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to DataExceptions table for a NOT EXISTS query.
     *
     * @see useDataExceptionsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\DataExceptionsQuery The inner query object of the NOT EXISTS statement
     */
    public function useDataExceptionsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\DataExceptionsQuery */
        $q = $this->useExistsQuery('DataExceptions', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to DataExceptions table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\DataExceptionsQuery The inner query object of the IN statement
     */
    public function useInDataExceptionsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\DataExceptionsQuery */
        $q = $this->useInQuery('DataExceptions', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to DataExceptions table for a NOT IN query.
     *
     * @see useDataExceptionsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\DataExceptionsQuery The inner query object of the NOT IN statement
     */
    public function useNotInDataExceptionsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\DataExceptionsQuery */
        $q = $this->useInQuery('DataExceptions', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildDataExceptionLogs $dataExceptionLogs Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($dataExceptionLogs = null)
    {
        if ($dataExceptionLogs) {
            $this->addUsingAlias(DataExceptionLogsTableMap::COL_DATA_EXCEPTION_LOG_ID, $dataExceptionLogs->getDataExceptionLogId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the data_exception_logs table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DataExceptionLogsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            DataExceptionLogsTableMap::clearInstancePool();
            DataExceptionLogsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(DataExceptionLogsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(DataExceptionLogsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            DataExceptionLogsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            DataExceptionLogsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
