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
use entities\DataExceptions as ChildDataExceptions;
use entities\DataExceptionsQuery as ChildDataExceptionsQuery;
use entities\Map\DataExceptionsTableMap;

/**
 * Base class that represents a query for the `data_exceptions` table.
 *
 * @method     ChildDataExceptionsQuery orderByDataExceptionId($order = Criteria::ASC) Order by the data_exception_id column
 * @method     ChildDataExceptionsQuery orderByExceptionName($order = Criteria::ASC) Order by the exception_name column
 * @method     ChildDataExceptionsQuery orderByClassPath($order = Criteria::ASC) Order by the class_path column
 * @method     ChildDataExceptionsQuery orderBySubject($order = Criteria::ASC) Order by the subject column
 * @method     ChildDataExceptionsQuery orderByActive($order = Criteria::ASC) Order by the active column
 * @method     ChildDataExceptionsQuery orderByClientEmails($order = Criteria::ASC) Order by the client_emails column
 * @method     ChildDataExceptionsQuery orderByTeamEmails($order = Criteria::ASC) Order by the team_emails column
 * @method     ChildDataExceptionsQuery orderByLoggerName($order = Criteria::ASC) Order by the logger_name column
 * @method     ChildDataExceptionsQuery orderByScheduleTime($order = Criteria::ASC) Order by the schedule_time column
 * @method     ChildDataExceptionsQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildDataExceptionsQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildDataExceptionsQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 *
 * @method     ChildDataExceptionsQuery groupByDataExceptionId() Group by the data_exception_id column
 * @method     ChildDataExceptionsQuery groupByExceptionName() Group by the exception_name column
 * @method     ChildDataExceptionsQuery groupByClassPath() Group by the class_path column
 * @method     ChildDataExceptionsQuery groupBySubject() Group by the subject column
 * @method     ChildDataExceptionsQuery groupByActive() Group by the active column
 * @method     ChildDataExceptionsQuery groupByClientEmails() Group by the client_emails column
 * @method     ChildDataExceptionsQuery groupByTeamEmails() Group by the team_emails column
 * @method     ChildDataExceptionsQuery groupByLoggerName() Group by the logger_name column
 * @method     ChildDataExceptionsQuery groupByScheduleTime() Group by the schedule_time column
 * @method     ChildDataExceptionsQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildDataExceptionsQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildDataExceptionsQuery groupByCompanyId() Group by the company_id column
 *
 * @method     ChildDataExceptionsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildDataExceptionsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildDataExceptionsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildDataExceptionsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildDataExceptionsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildDataExceptionsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildDataExceptionsQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildDataExceptionsQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildDataExceptionsQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildDataExceptionsQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildDataExceptionsQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildDataExceptionsQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildDataExceptionsQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     ChildDataExceptionsQuery leftJoinDataExceptionLogs($relationAlias = null) Adds a LEFT JOIN clause to the query using the DataExceptionLogs relation
 * @method     ChildDataExceptionsQuery rightJoinDataExceptionLogs($relationAlias = null) Adds a RIGHT JOIN clause to the query using the DataExceptionLogs relation
 * @method     ChildDataExceptionsQuery innerJoinDataExceptionLogs($relationAlias = null) Adds a INNER JOIN clause to the query using the DataExceptionLogs relation
 *
 * @method     ChildDataExceptionsQuery joinWithDataExceptionLogs($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the DataExceptionLogs relation
 *
 * @method     ChildDataExceptionsQuery leftJoinWithDataExceptionLogs() Adds a LEFT JOIN clause and with to the query using the DataExceptionLogs relation
 * @method     ChildDataExceptionsQuery rightJoinWithDataExceptionLogs() Adds a RIGHT JOIN clause and with to the query using the DataExceptionLogs relation
 * @method     ChildDataExceptionsQuery innerJoinWithDataExceptionLogs() Adds a INNER JOIN clause and with to the query using the DataExceptionLogs relation
 *
 * @method     \entities\CompanyQuery|\entities\DataExceptionLogsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildDataExceptions|null findOne(?ConnectionInterface $con = null) Return the first ChildDataExceptions matching the query
 * @method     ChildDataExceptions findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildDataExceptions matching the query, or a new ChildDataExceptions object populated from the query conditions when no match is found
 *
 * @method     ChildDataExceptions|null findOneByDataExceptionId(int $data_exception_id) Return the first ChildDataExceptions filtered by the data_exception_id column
 * @method     ChildDataExceptions|null findOneByExceptionName(string $exception_name) Return the first ChildDataExceptions filtered by the exception_name column
 * @method     ChildDataExceptions|null findOneByClassPath(string $class_path) Return the first ChildDataExceptions filtered by the class_path column
 * @method     ChildDataExceptions|null findOneBySubject(string $subject) Return the first ChildDataExceptions filtered by the subject column
 * @method     ChildDataExceptions|null findOneByActive(boolean $active) Return the first ChildDataExceptions filtered by the active column
 * @method     ChildDataExceptions|null findOneByClientEmails(string $client_emails) Return the first ChildDataExceptions filtered by the client_emails column
 * @method     ChildDataExceptions|null findOneByTeamEmails(string $team_emails) Return the first ChildDataExceptions filtered by the team_emails column
 * @method     ChildDataExceptions|null findOneByLoggerName(string $logger_name) Return the first ChildDataExceptions filtered by the logger_name column
 * @method     ChildDataExceptions|null findOneByScheduleTime(string $schedule_time) Return the first ChildDataExceptions filtered by the schedule_time column
 * @method     ChildDataExceptions|null findOneByCreatedAt(string $created_at) Return the first ChildDataExceptions filtered by the created_at column
 * @method     ChildDataExceptions|null findOneByUpdatedAt(string $updated_at) Return the first ChildDataExceptions filtered by the updated_at column
 * @method     ChildDataExceptions|null findOneByCompanyId(int $company_id) Return the first ChildDataExceptions filtered by the company_id column
 *
 * @method     ChildDataExceptions requirePk($key, ?ConnectionInterface $con = null) Return the ChildDataExceptions by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDataExceptions requireOne(?ConnectionInterface $con = null) Return the first ChildDataExceptions matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDataExceptions requireOneByDataExceptionId(int $data_exception_id) Return the first ChildDataExceptions filtered by the data_exception_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDataExceptions requireOneByExceptionName(string $exception_name) Return the first ChildDataExceptions filtered by the exception_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDataExceptions requireOneByClassPath(string $class_path) Return the first ChildDataExceptions filtered by the class_path column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDataExceptions requireOneBySubject(string $subject) Return the first ChildDataExceptions filtered by the subject column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDataExceptions requireOneByActive(boolean $active) Return the first ChildDataExceptions filtered by the active column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDataExceptions requireOneByClientEmails(string $client_emails) Return the first ChildDataExceptions filtered by the client_emails column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDataExceptions requireOneByTeamEmails(string $team_emails) Return the first ChildDataExceptions filtered by the team_emails column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDataExceptions requireOneByLoggerName(string $logger_name) Return the first ChildDataExceptions filtered by the logger_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDataExceptions requireOneByScheduleTime(string $schedule_time) Return the first ChildDataExceptions filtered by the schedule_time column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDataExceptions requireOneByCreatedAt(string $created_at) Return the first ChildDataExceptions filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDataExceptions requireOneByUpdatedAt(string $updated_at) Return the first ChildDataExceptions filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDataExceptions requireOneByCompanyId(int $company_id) Return the first ChildDataExceptions filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDataExceptions[]|Collection find(?ConnectionInterface $con = null) Return ChildDataExceptions objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildDataExceptions> find(?ConnectionInterface $con = null) Return ChildDataExceptions objects based on current ModelCriteria
 *
 * @method     ChildDataExceptions[]|Collection findByDataExceptionId(int|array<int> $data_exception_id) Return ChildDataExceptions objects filtered by the data_exception_id column
 * @psalm-method Collection&\Traversable<ChildDataExceptions> findByDataExceptionId(int|array<int> $data_exception_id) Return ChildDataExceptions objects filtered by the data_exception_id column
 * @method     ChildDataExceptions[]|Collection findByExceptionName(string|array<string> $exception_name) Return ChildDataExceptions objects filtered by the exception_name column
 * @psalm-method Collection&\Traversable<ChildDataExceptions> findByExceptionName(string|array<string> $exception_name) Return ChildDataExceptions objects filtered by the exception_name column
 * @method     ChildDataExceptions[]|Collection findByClassPath(string|array<string> $class_path) Return ChildDataExceptions objects filtered by the class_path column
 * @psalm-method Collection&\Traversable<ChildDataExceptions> findByClassPath(string|array<string> $class_path) Return ChildDataExceptions objects filtered by the class_path column
 * @method     ChildDataExceptions[]|Collection findBySubject(string|array<string> $subject) Return ChildDataExceptions objects filtered by the subject column
 * @psalm-method Collection&\Traversable<ChildDataExceptions> findBySubject(string|array<string> $subject) Return ChildDataExceptions objects filtered by the subject column
 * @method     ChildDataExceptions[]|Collection findByActive(boolean|array<boolean> $active) Return ChildDataExceptions objects filtered by the active column
 * @psalm-method Collection&\Traversable<ChildDataExceptions> findByActive(boolean|array<boolean> $active) Return ChildDataExceptions objects filtered by the active column
 * @method     ChildDataExceptions[]|Collection findByClientEmails(string|array<string> $client_emails) Return ChildDataExceptions objects filtered by the client_emails column
 * @psalm-method Collection&\Traversable<ChildDataExceptions> findByClientEmails(string|array<string> $client_emails) Return ChildDataExceptions objects filtered by the client_emails column
 * @method     ChildDataExceptions[]|Collection findByTeamEmails(string|array<string> $team_emails) Return ChildDataExceptions objects filtered by the team_emails column
 * @psalm-method Collection&\Traversable<ChildDataExceptions> findByTeamEmails(string|array<string> $team_emails) Return ChildDataExceptions objects filtered by the team_emails column
 * @method     ChildDataExceptions[]|Collection findByLoggerName(string|array<string> $logger_name) Return ChildDataExceptions objects filtered by the logger_name column
 * @psalm-method Collection&\Traversable<ChildDataExceptions> findByLoggerName(string|array<string> $logger_name) Return ChildDataExceptions objects filtered by the logger_name column
 * @method     ChildDataExceptions[]|Collection findByScheduleTime(string|array<string> $schedule_time) Return ChildDataExceptions objects filtered by the schedule_time column
 * @psalm-method Collection&\Traversable<ChildDataExceptions> findByScheduleTime(string|array<string> $schedule_time) Return ChildDataExceptions objects filtered by the schedule_time column
 * @method     ChildDataExceptions[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildDataExceptions objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildDataExceptions> findByCreatedAt(string|array<string> $created_at) Return ChildDataExceptions objects filtered by the created_at column
 * @method     ChildDataExceptions[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildDataExceptions objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildDataExceptions> findByUpdatedAt(string|array<string> $updated_at) Return ChildDataExceptions objects filtered by the updated_at column
 * @method     ChildDataExceptions[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildDataExceptions objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildDataExceptions> findByCompanyId(int|array<int> $company_id) Return ChildDataExceptions objects filtered by the company_id column
 *
 * @method     ChildDataExceptions[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildDataExceptions> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class DataExceptionsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\DataExceptionsQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\DataExceptions', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildDataExceptionsQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildDataExceptionsQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildDataExceptionsQuery) {
            return $criteria;
        }
        $query = new ChildDataExceptionsQuery();
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
     * @return ChildDataExceptions|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(DataExceptionsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = DataExceptionsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildDataExceptions A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT data_exception_id, exception_name, class_path, subject, active, client_emails, team_emails, logger_name, schedule_time, created_at, updated_at, company_id FROM data_exceptions WHERE data_exception_id = :p0';
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
            /** @var ChildDataExceptions $obj */
            $obj = new ChildDataExceptions();
            $obj->hydrate($row);
            DataExceptionsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildDataExceptions|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(DataExceptionsTableMap::COL_DATA_EXCEPTION_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(DataExceptionsTableMap::COL_DATA_EXCEPTION_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(DataExceptionsTableMap::COL_DATA_EXCEPTION_ID, $dataExceptionId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dataExceptionId['max'])) {
                $this->addUsingAlias(DataExceptionsTableMap::COL_DATA_EXCEPTION_ID, $dataExceptionId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DataExceptionsTableMap::COL_DATA_EXCEPTION_ID, $dataExceptionId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the exception_name column
     *
     * Example usage:
     * <code>
     * $query->filterByExceptionName('fooValue');   // WHERE exception_name = 'fooValue'
     * $query->filterByExceptionName('%fooValue%', Criteria::LIKE); // WHERE exception_name LIKE '%fooValue%'
     * $query->filterByExceptionName(['foo', 'bar']); // WHERE exception_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $exceptionName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExceptionName($exceptionName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($exceptionName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DataExceptionsTableMap::COL_EXCEPTION_NAME, $exceptionName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the class_path column
     *
     * Example usage:
     * <code>
     * $query->filterByClassPath('fooValue');   // WHERE class_path = 'fooValue'
     * $query->filterByClassPath('%fooValue%', Criteria::LIKE); // WHERE class_path LIKE '%fooValue%'
     * $query->filterByClassPath(['foo', 'bar']); // WHERE class_path IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $classPath The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByClassPath($classPath = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($classPath)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DataExceptionsTableMap::COL_CLASS_PATH, $classPath, $comparison);

        return $this;
    }

    /**
     * Filter the query on the subject column
     *
     * Example usage:
     * <code>
     * $query->filterBySubject('fooValue');   // WHERE subject = 'fooValue'
     * $query->filterBySubject('%fooValue%', Criteria::LIKE); // WHERE subject LIKE '%fooValue%'
     * $query->filterBySubject(['foo', 'bar']); // WHERE subject IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $subject The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySubject($subject = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($subject)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DataExceptionsTableMap::COL_SUBJECT, $subject, $comparison);

        return $this;
    }

    /**
     * Filter the query on the active column
     *
     * Example usage:
     * <code>
     * $query->filterByActive(true); // WHERE active = true
     * $query->filterByActive('yes'); // WHERE active = true
     * </code>
     *
     * @param bool|string $active The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByActive($active = null, ?string $comparison = null)
    {
        if (is_string($active)) {
            $active = in_array(strtolower($active), array('false', 'off', '-', 'no', 'n', '0', ''), true) ? false : true;
        }

        $this->addUsingAlias(DataExceptionsTableMap::COL_ACTIVE, $active, $comparison);

        return $this;
    }

    /**
     * Filter the query on the client_emails column
     *
     * Example usage:
     * <code>
     * $query->filterByClientEmails('fooValue');   // WHERE client_emails = 'fooValue'
     * $query->filterByClientEmails('%fooValue%', Criteria::LIKE); // WHERE client_emails LIKE '%fooValue%'
     * $query->filterByClientEmails(['foo', 'bar']); // WHERE client_emails IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $clientEmails The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByClientEmails($clientEmails = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($clientEmails)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DataExceptionsTableMap::COL_CLIENT_EMAILS, $clientEmails, $comparison);

        return $this;
    }

    /**
     * Filter the query on the team_emails column
     *
     * Example usage:
     * <code>
     * $query->filterByTeamEmails('fooValue');   // WHERE team_emails = 'fooValue'
     * $query->filterByTeamEmails('%fooValue%', Criteria::LIKE); // WHERE team_emails LIKE '%fooValue%'
     * $query->filterByTeamEmails(['foo', 'bar']); // WHERE team_emails IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $teamEmails The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTeamEmails($teamEmails = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($teamEmails)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DataExceptionsTableMap::COL_TEAM_EMAILS, $teamEmails, $comparison);

        return $this;
    }

    /**
     * Filter the query on the logger_name column
     *
     * Example usage:
     * <code>
     * $query->filterByLoggerName('fooValue');   // WHERE logger_name = 'fooValue'
     * $query->filterByLoggerName('%fooValue%', Criteria::LIKE); // WHERE logger_name LIKE '%fooValue%'
     * $query->filterByLoggerName(['foo', 'bar']); // WHERE logger_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $loggerName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLoggerName($loggerName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($loggerName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DataExceptionsTableMap::COL_LOGGER_NAME, $loggerName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the schedule_time column
     *
     * Example usage:
     * <code>
     * $query->filterByScheduleTime('2011-03-14'); // WHERE schedule_time = '2011-03-14'
     * $query->filterByScheduleTime('now'); // WHERE schedule_time = '2011-03-14'
     * $query->filterByScheduleTime(array('max' => 'yesterday')); // WHERE schedule_time > '2011-03-13'
     * </code>
     *
     * @param mixed $scheduleTime The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByScheduleTime($scheduleTime = null, ?string $comparison = null)
    {
        if (is_array($scheduleTime)) {
            $useMinMax = false;
            if (isset($scheduleTime['min'])) {
                $this->addUsingAlias(DataExceptionsTableMap::COL_SCHEDULE_TIME, $scheduleTime['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($scheduleTime['max'])) {
                $this->addUsingAlias(DataExceptionsTableMap::COL_SCHEDULE_TIME, $scheduleTime['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DataExceptionsTableMap::COL_SCHEDULE_TIME, $scheduleTime, $comparison);

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
                $this->addUsingAlias(DataExceptionsTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(DataExceptionsTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DataExceptionsTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(DataExceptionsTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(DataExceptionsTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DataExceptionsTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

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
                $this->addUsingAlias(DataExceptionsTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(DataExceptionsTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DataExceptionsTableMap::COL_COMPANY_ID, $companyId, $comparison);

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
                ->addUsingAlias(DataExceptionsTableMap::COL_COMPANY_ID, $company->getCompanyId(), $comparison);
        } elseif ($company instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(DataExceptionsTableMap::COL_COMPANY_ID, $company->toKeyValue('PrimaryKey', 'CompanyId'), $comparison);

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
     * Filter the query by a related \entities\DataExceptionLogs object
     *
     * @param \entities\DataExceptionLogs|ObjectCollection $dataExceptionLogs the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDataExceptionLogs($dataExceptionLogs, ?string $comparison = null)
    {
        if ($dataExceptionLogs instanceof \entities\DataExceptionLogs) {
            $this
                ->addUsingAlias(DataExceptionsTableMap::COL_DATA_EXCEPTION_ID, $dataExceptionLogs->getDataExceptionId(), $comparison);

            return $this;
        } elseif ($dataExceptionLogs instanceof ObjectCollection) {
            $this
                ->useDataExceptionLogsQuery()
                ->filterByPrimaryKeys($dataExceptionLogs->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByDataExceptionLogs() only accepts arguments of type \entities\DataExceptionLogs or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the DataExceptionLogs relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinDataExceptionLogs(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('DataExceptionLogs');

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
            $this->addJoinObject($join, 'DataExceptionLogs');
        }

        return $this;
    }

    /**
     * Use the DataExceptionLogs relation DataExceptionLogs object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\DataExceptionLogsQuery A secondary query class using the current class as primary query
     */
    public function useDataExceptionLogsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinDataExceptionLogs($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'DataExceptionLogs', '\entities\DataExceptionLogsQuery');
    }

    /**
     * Use the DataExceptionLogs relation DataExceptionLogs object
     *
     * @param callable(\entities\DataExceptionLogsQuery):\entities\DataExceptionLogsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withDataExceptionLogsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useDataExceptionLogsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to DataExceptionLogs table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\DataExceptionLogsQuery The inner query object of the EXISTS statement
     */
    public function useDataExceptionLogsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\DataExceptionLogsQuery */
        $q = $this->useExistsQuery('DataExceptionLogs', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to DataExceptionLogs table for a NOT EXISTS query.
     *
     * @see useDataExceptionLogsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\DataExceptionLogsQuery The inner query object of the NOT EXISTS statement
     */
    public function useDataExceptionLogsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\DataExceptionLogsQuery */
        $q = $this->useExistsQuery('DataExceptionLogs', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to DataExceptionLogs table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\DataExceptionLogsQuery The inner query object of the IN statement
     */
    public function useInDataExceptionLogsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\DataExceptionLogsQuery */
        $q = $this->useInQuery('DataExceptionLogs', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to DataExceptionLogs table for a NOT IN query.
     *
     * @see useDataExceptionLogsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\DataExceptionLogsQuery The inner query object of the NOT IN statement
     */
    public function useNotInDataExceptionLogsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\DataExceptionLogsQuery */
        $q = $this->useInQuery('DataExceptionLogs', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildDataExceptions $dataExceptions Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($dataExceptions = null)
    {
        if ($dataExceptions) {
            $this->addUsingAlias(DataExceptionsTableMap::COL_DATA_EXCEPTION_ID, $dataExceptions->getDataExceptionId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the data_exceptions table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DataExceptionsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            DataExceptionsTableMap::clearInstancePool();
            DataExceptionsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(DataExceptionsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(DataExceptionsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            DataExceptionsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            DataExceptionsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
