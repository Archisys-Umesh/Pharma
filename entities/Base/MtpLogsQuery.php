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
use entities\MtpLogs as ChildMtpLogs;
use entities\MtpLogsQuery as ChildMtpLogsQuery;
use entities\Map\MtpLogsTableMap;

/**
 * Base class that represents a query for the `mtp_logs` table.
 *
 * @method     ChildMtpLogsQuery orderByMtpLogId($order = Criteria::ASC) Order by the mtp_log_id column
 * @method     ChildMtpLogsQuery orderByMtpId($order = Criteria::ASC) Order by the mtp_id column
 * @method     ChildMtpLogsQuery orderByLogFunction($order = Criteria::ASC) Order by the log_function column
 * @method     ChildMtpLogsQuery orderByLogDescription($order = Criteria::ASC) Order by the log_description column
 * @method     ChildMtpLogsQuery orderByDebugData($order = Criteria::ASC) Order by the debug_data column
 * @method     ChildMtpLogsQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildMtpLogsQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildMtpLogsQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildMtpLogsQuery groupByMtpLogId() Group by the mtp_log_id column
 * @method     ChildMtpLogsQuery groupByMtpId() Group by the mtp_id column
 * @method     ChildMtpLogsQuery groupByLogFunction() Group by the log_function column
 * @method     ChildMtpLogsQuery groupByLogDescription() Group by the log_description column
 * @method     ChildMtpLogsQuery groupByDebugData() Group by the debug_data column
 * @method     ChildMtpLogsQuery groupByCompanyId() Group by the company_id column
 * @method     ChildMtpLogsQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildMtpLogsQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildMtpLogsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildMtpLogsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildMtpLogsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildMtpLogsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildMtpLogsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildMtpLogsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildMtpLogsQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildMtpLogsQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildMtpLogsQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildMtpLogsQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildMtpLogsQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildMtpLogsQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildMtpLogsQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     ChildMtpLogsQuery leftJoinMtp($relationAlias = null) Adds a LEFT JOIN clause to the query using the Mtp relation
 * @method     ChildMtpLogsQuery rightJoinMtp($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Mtp relation
 * @method     ChildMtpLogsQuery innerJoinMtp($relationAlias = null) Adds a INNER JOIN clause to the query using the Mtp relation
 *
 * @method     ChildMtpLogsQuery joinWithMtp($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Mtp relation
 *
 * @method     ChildMtpLogsQuery leftJoinWithMtp() Adds a LEFT JOIN clause and with to the query using the Mtp relation
 * @method     ChildMtpLogsQuery rightJoinWithMtp() Adds a RIGHT JOIN clause and with to the query using the Mtp relation
 * @method     ChildMtpLogsQuery innerJoinWithMtp() Adds a INNER JOIN clause and with to the query using the Mtp relation
 *
 * @method     \entities\CompanyQuery|\entities\MtpQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildMtpLogs|null findOne(?ConnectionInterface $con = null) Return the first ChildMtpLogs matching the query
 * @method     ChildMtpLogs findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildMtpLogs matching the query, or a new ChildMtpLogs object populated from the query conditions when no match is found
 *
 * @method     ChildMtpLogs|null findOneByMtpLogId(int $mtp_log_id) Return the first ChildMtpLogs filtered by the mtp_log_id column
 * @method     ChildMtpLogs|null findOneByMtpId(int $mtp_id) Return the first ChildMtpLogs filtered by the mtp_id column
 * @method     ChildMtpLogs|null findOneByLogFunction(string $log_function) Return the first ChildMtpLogs filtered by the log_function column
 * @method     ChildMtpLogs|null findOneByLogDescription(string $log_description) Return the first ChildMtpLogs filtered by the log_description column
 * @method     ChildMtpLogs|null findOneByDebugData(string $debug_data) Return the first ChildMtpLogs filtered by the debug_data column
 * @method     ChildMtpLogs|null findOneByCompanyId(int $company_id) Return the first ChildMtpLogs filtered by the company_id column
 * @method     ChildMtpLogs|null findOneByCreatedAt(string $created_at) Return the first ChildMtpLogs filtered by the created_at column
 * @method     ChildMtpLogs|null findOneByUpdatedAt(string $updated_at) Return the first ChildMtpLogs filtered by the updated_at column
 *
 * @method     ChildMtpLogs requirePk($key, ?ConnectionInterface $con = null) Return the ChildMtpLogs by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMtpLogs requireOne(?ConnectionInterface $con = null) Return the first ChildMtpLogs matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildMtpLogs requireOneByMtpLogId(int $mtp_log_id) Return the first ChildMtpLogs filtered by the mtp_log_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMtpLogs requireOneByMtpId(int $mtp_id) Return the first ChildMtpLogs filtered by the mtp_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMtpLogs requireOneByLogFunction(string $log_function) Return the first ChildMtpLogs filtered by the log_function column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMtpLogs requireOneByLogDescription(string $log_description) Return the first ChildMtpLogs filtered by the log_description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMtpLogs requireOneByDebugData(string $debug_data) Return the first ChildMtpLogs filtered by the debug_data column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMtpLogs requireOneByCompanyId(int $company_id) Return the first ChildMtpLogs filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMtpLogs requireOneByCreatedAt(string $created_at) Return the first ChildMtpLogs filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMtpLogs requireOneByUpdatedAt(string $updated_at) Return the first ChildMtpLogs filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildMtpLogs[]|Collection find(?ConnectionInterface $con = null) Return ChildMtpLogs objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildMtpLogs> find(?ConnectionInterface $con = null) Return ChildMtpLogs objects based on current ModelCriteria
 *
 * @method     ChildMtpLogs[]|Collection findByMtpLogId(int|array<int> $mtp_log_id) Return ChildMtpLogs objects filtered by the mtp_log_id column
 * @psalm-method Collection&\Traversable<ChildMtpLogs> findByMtpLogId(int|array<int> $mtp_log_id) Return ChildMtpLogs objects filtered by the mtp_log_id column
 * @method     ChildMtpLogs[]|Collection findByMtpId(int|array<int> $mtp_id) Return ChildMtpLogs objects filtered by the mtp_id column
 * @psalm-method Collection&\Traversable<ChildMtpLogs> findByMtpId(int|array<int> $mtp_id) Return ChildMtpLogs objects filtered by the mtp_id column
 * @method     ChildMtpLogs[]|Collection findByLogFunction(string|array<string> $log_function) Return ChildMtpLogs objects filtered by the log_function column
 * @psalm-method Collection&\Traversable<ChildMtpLogs> findByLogFunction(string|array<string> $log_function) Return ChildMtpLogs objects filtered by the log_function column
 * @method     ChildMtpLogs[]|Collection findByLogDescription(string|array<string> $log_description) Return ChildMtpLogs objects filtered by the log_description column
 * @psalm-method Collection&\Traversable<ChildMtpLogs> findByLogDescription(string|array<string> $log_description) Return ChildMtpLogs objects filtered by the log_description column
 * @method     ChildMtpLogs[]|Collection findByDebugData(string|array<string> $debug_data) Return ChildMtpLogs objects filtered by the debug_data column
 * @psalm-method Collection&\Traversable<ChildMtpLogs> findByDebugData(string|array<string> $debug_data) Return ChildMtpLogs objects filtered by the debug_data column
 * @method     ChildMtpLogs[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildMtpLogs objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildMtpLogs> findByCompanyId(int|array<int> $company_id) Return ChildMtpLogs objects filtered by the company_id column
 * @method     ChildMtpLogs[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildMtpLogs objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildMtpLogs> findByCreatedAt(string|array<string> $created_at) Return ChildMtpLogs objects filtered by the created_at column
 * @method     ChildMtpLogs[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildMtpLogs objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildMtpLogs> findByUpdatedAt(string|array<string> $updated_at) Return ChildMtpLogs objects filtered by the updated_at column
 *
 * @method     ChildMtpLogs[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildMtpLogs> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class MtpLogsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\MtpLogsQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\MtpLogs', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildMtpLogsQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildMtpLogsQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildMtpLogsQuery) {
            return $criteria;
        }
        $query = new ChildMtpLogsQuery();
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
     * @return ChildMtpLogs|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(MtpLogsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = MtpLogsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildMtpLogs A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT mtp_log_id, mtp_id, log_function, log_description, debug_data, company_id, created_at, updated_at FROM mtp_logs WHERE mtp_log_id = :p0';
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
            /** @var ChildMtpLogs $obj */
            $obj = new ChildMtpLogs();
            $obj->hydrate($row);
            MtpLogsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildMtpLogs|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(MtpLogsTableMap::COL_MTP_LOG_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(MtpLogsTableMap::COL_MTP_LOG_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the mtp_log_id column
     *
     * Example usage:
     * <code>
     * $query->filterByMtpLogId(1234); // WHERE mtp_log_id = 1234
     * $query->filterByMtpLogId(array(12, 34)); // WHERE mtp_log_id IN (12, 34)
     * $query->filterByMtpLogId(array('min' => 12)); // WHERE mtp_log_id > 12
     * </code>
     *
     * @param mixed $mtpLogId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMtpLogId($mtpLogId = null, ?string $comparison = null)
    {
        if (is_array($mtpLogId)) {
            $useMinMax = false;
            if (isset($mtpLogId['min'])) {
                $this->addUsingAlias(MtpLogsTableMap::COL_MTP_LOG_ID, $mtpLogId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($mtpLogId['max'])) {
                $this->addUsingAlias(MtpLogsTableMap::COL_MTP_LOG_ID, $mtpLogId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MtpLogsTableMap::COL_MTP_LOG_ID, $mtpLogId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the mtp_id column
     *
     * Example usage:
     * <code>
     * $query->filterByMtpId(1234); // WHERE mtp_id = 1234
     * $query->filterByMtpId(array(12, 34)); // WHERE mtp_id IN (12, 34)
     * $query->filterByMtpId(array('min' => 12)); // WHERE mtp_id > 12
     * </code>
     *
     * @see       filterByMtp()
     *
     * @param mixed $mtpId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMtpId($mtpId = null, ?string $comparison = null)
    {
        if (is_array($mtpId)) {
            $useMinMax = false;
            if (isset($mtpId['min'])) {
                $this->addUsingAlias(MtpLogsTableMap::COL_MTP_ID, $mtpId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($mtpId['max'])) {
                $this->addUsingAlias(MtpLogsTableMap::COL_MTP_ID, $mtpId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MtpLogsTableMap::COL_MTP_ID, $mtpId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the log_function column
     *
     * Example usage:
     * <code>
     * $query->filterByLogFunction('fooValue');   // WHERE log_function = 'fooValue'
     * $query->filterByLogFunction('%fooValue%', Criteria::LIKE); // WHERE log_function LIKE '%fooValue%'
     * $query->filterByLogFunction(['foo', 'bar']); // WHERE log_function IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $logFunction The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLogFunction($logFunction = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($logFunction)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MtpLogsTableMap::COL_LOG_FUNCTION, $logFunction, $comparison);

        return $this;
    }

    /**
     * Filter the query on the log_description column
     *
     * Example usage:
     * <code>
     * $query->filterByLogDescription('fooValue');   // WHERE log_description = 'fooValue'
     * $query->filterByLogDescription('%fooValue%', Criteria::LIKE); // WHERE log_description LIKE '%fooValue%'
     * $query->filterByLogDescription(['foo', 'bar']); // WHERE log_description IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $logDescription The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLogDescription($logDescription = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($logDescription)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MtpLogsTableMap::COL_LOG_DESCRIPTION, $logDescription, $comparison);

        return $this;
    }

    /**
     * Filter the query on the debug_data column
     *
     * Example usage:
     * <code>
     * $query->filterByDebugData('fooValue');   // WHERE debug_data = 'fooValue'
     * $query->filterByDebugData('%fooValue%', Criteria::LIKE); // WHERE debug_data LIKE '%fooValue%'
     * $query->filterByDebugData(['foo', 'bar']); // WHERE debug_data IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $debugData The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDebugData($debugData = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($debugData)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MtpLogsTableMap::COL_DEBUG_DATA, $debugData, $comparison);

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
                $this->addUsingAlias(MtpLogsTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(MtpLogsTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MtpLogsTableMap::COL_COMPANY_ID, $companyId, $comparison);

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
                $this->addUsingAlias(MtpLogsTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(MtpLogsTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MtpLogsTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(MtpLogsTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(MtpLogsTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MtpLogsTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

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
                ->addUsingAlias(MtpLogsTableMap::COL_COMPANY_ID, $company->getCompanyId(), $comparison);
        } elseif ($company instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(MtpLogsTableMap::COL_COMPANY_ID, $company->toKeyValue('PrimaryKey', 'CompanyId'), $comparison);

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
     * Filter the query by a related \entities\Mtp object
     *
     * @param \entities\Mtp|ObjectCollection $mtp The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMtp($mtp, ?string $comparison = null)
    {
        if ($mtp instanceof \entities\Mtp) {
            return $this
                ->addUsingAlias(MtpLogsTableMap::COL_MTP_ID, $mtp->getMtpId(), $comparison);
        } elseif ($mtp instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(MtpLogsTableMap::COL_MTP_ID, $mtp->toKeyValue('PrimaryKey', 'MtpId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByMtp() only accepts arguments of type \entities\Mtp or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Mtp relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinMtp(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Mtp');

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
            $this->addJoinObject($join, 'Mtp');
        }

        return $this;
    }

    /**
     * Use the Mtp relation Mtp object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\MtpQuery A secondary query class using the current class as primary query
     */
    public function useMtpQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinMtp($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Mtp', '\entities\MtpQuery');
    }

    /**
     * Use the Mtp relation Mtp object
     *
     * @param callable(\entities\MtpQuery):\entities\MtpQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withMtpQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useMtpQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Mtp table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\MtpQuery The inner query object of the EXISTS statement
     */
    public function useMtpExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\MtpQuery */
        $q = $this->useExistsQuery('Mtp', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Mtp table for a NOT EXISTS query.
     *
     * @see useMtpExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\MtpQuery The inner query object of the NOT EXISTS statement
     */
    public function useMtpNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\MtpQuery */
        $q = $this->useExistsQuery('Mtp', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Mtp table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\MtpQuery The inner query object of the IN statement
     */
    public function useInMtpQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\MtpQuery */
        $q = $this->useInQuery('Mtp', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Mtp table for a NOT IN query.
     *
     * @see useMtpInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\MtpQuery The inner query object of the NOT IN statement
     */
    public function useNotInMtpQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\MtpQuery */
        $q = $this->useInQuery('Mtp', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildMtpLogs $mtpLogs Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($mtpLogs = null)
    {
        if ($mtpLogs) {
            $this->addUsingAlias(MtpLogsTableMap::COL_MTP_LOG_ID, $mtpLogs->getMtpLogId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the mtp_logs table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(MtpLogsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            MtpLogsTableMap::clearInstancePool();
            MtpLogsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(MtpLogsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(MtpLogsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            MtpLogsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            MtpLogsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
