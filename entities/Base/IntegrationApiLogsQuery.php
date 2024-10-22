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
use entities\IntegrationApiLogs as ChildIntegrationApiLogs;
use entities\IntegrationApiLogsQuery as ChildIntegrationApiLogsQuery;
use entities\Map\IntegrationApiLogsTableMap;

/**
 * Base class that represents a query for the `integration_api_logs` table.
 *
 * @method     ChildIntegrationApiLogsQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildIntegrationApiLogsQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildIntegrationApiLogsQuery orderByRequestedParams($order = Criteria::ASC) Order by the requested_params column
 * @method     ChildIntegrationApiLogsQuery orderByResponse($order = Criteria::ASC) Order by the response column
 * @method     ChildIntegrationApiLogsQuery orderByResponseStatus($order = Criteria::ASC) Order by the response_status column
 * @method     ChildIntegrationApiLogsQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildIntegrationApiLogsQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildIntegrationApiLogsQuery groupById() Group by the id column
 * @method     ChildIntegrationApiLogsQuery groupByCompanyId() Group by the company_id column
 * @method     ChildIntegrationApiLogsQuery groupByRequestedParams() Group by the requested_params column
 * @method     ChildIntegrationApiLogsQuery groupByResponse() Group by the response column
 * @method     ChildIntegrationApiLogsQuery groupByResponseStatus() Group by the response_status column
 * @method     ChildIntegrationApiLogsQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildIntegrationApiLogsQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildIntegrationApiLogsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildIntegrationApiLogsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildIntegrationApiLogsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildIntegrationApiLogsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildIntegrationApiLogsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildIntegrationApiLogsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildIntegrationApiLogsQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildIntegrationApiLogsQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildIntegrationApiLogsQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildIntegrationApiLogsQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildIntegrationApiLogsQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildIntegrationApiLogsQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildIntegrationApiLogsQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     \entities\CompanyQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildIntegrationApiLogs|null findOne(?ConnectionInterface $con = null) Return the first ChildIntegrationApiLogs matching the query
 * @method     ChildIntegrationApiLogs findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildIntegrationApiLogs matching the query, or a new ChildIntegrationApiLogs object populated from the query conditions when no match is found
 *
 * @method     ChildIntegrationApiLogs|null findOneById(int $id) Return the first ChildIntegrationApiLogs filtered by the id column
 * @method     ChildIntegrationApiLogs|null findOneByCompanyId(int $company_id) Return the first ChildIntegrationApiLogs filtered by the company_id column
 * @method     ChildIntegrationApiLogs|null findOneByRequestedParams(string $requested_params) Return the first ChildIntegrationApiLogs filtered by the requested_params column
 * @method     ChildIntegrationApiLogs|null findOneByResponse(string $response) Return the first ChildIntegrationApiLogs filtered by the response column
 * @method     ChildIntegrationApiLogs|null findOneByResponseStatus(int $response_status) Return the first ChildIntegrationApiLogs filtered by the response_status column
 * @method     ChildIntegrationApiLogs|null findOneByCreatedAt(string $created_at) Return the first ChildIntegrationApiLogs filtered by the created_at column
 * @method     ChildIntegrationApiLogs|null findOneByUpdatedAt(string $updated_at) Return the first ChildIntegrationApiLogs filtered by the updated_at column
 *
 * @method     ChildIntegrationApiLogs requirePk($key, ?ConnectionInterface $con = null) Return the ChildIntegrationApiLogs by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildIntegrationApiLogs requireOne(?ConnectionInterface $con = null) Return the first ChildIntegrationApiLogs matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildIntegrationApiLogs requireOneById(int $id) Return the first ChildIntegrationApiLogs filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildIntegrationApiLogs requireOneByCompanyId(int $company_id) Return the first ChildIntegrationApiLogs filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildIntegrationApiLogs requireOneByRequestedParams(string $requested_params) Return the first ChildIntegrationApiLogs filtered by the requested_params column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildIntegrationApiLogs requireOneByResponse(string $response) Return the first ChildIntegrationApiLogs filtered by the response column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildIntegrationApiLogs requireOneByResponseStatus(int $response_status) Return the first ChildIntegrationApiLogs filtered by the response_status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildIntegrationApiLogs requireOneByCreatedAt(string $created_at) Return the first ChildIntegrationApiLogs filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildIntegrationApiLogs requireOneByUpdatedAt(string $updated_at) Return the first ChildIntegrationApiLogs filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildIntegrationApiLogs[]|Collection find(?ConnectionInterface $con = null) Return ChildIntegrationApiLogs objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildIntegrationApiLogs> find(?ConnectionInterface $con = null) Return ChildIntegrationApiLogs objects based on current ModelCriteria
 *
 * @method     ChildIntegrationApiLogs[]|Collection findById(int|array<int> $id) Return ChildIntegrationApiLogs objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildIntegrationApiLogs> findById(int|array<int> $id) Return ChildIntegrationApiLogs objects filtered by the id column
 * @method     ChildIntegrationApiLogs[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildIntegrationApiLogs objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildIntegrationApiLogs> findByCompanyId(int|array<int> $company_id) Return ChildIntegrationApiLogs objects filtered by the company_id column
 * @method     ChildIntegrationApiLogs[]|Collection findByRequestedParams(string|array<string> $requested_params) Return ChildIntegrationApiLogs objects filtered by the requested_params column
 * @psalm-method Collection&\Traversable<ChildIntegrationApiLogs> findByRequestedParams(string|array<string> $requested_params) Return ChildIntegrationApiLogs objects filtered by the requested_params column
 * @method     ChildIntegrationApiLogs[]|Collection findByResponse(string|array<string> $response) Return ChildIntegrationApiLogs objects filtered by the response column
 * @psalm-method Collection&\Traversable<ChildIntegrationApiLogs> findByResponse(string|array<string> $response) Return ChildIntegrationApiLogs objects filtered by the response column
 * @method     ChildIntegrationApiLogs[]|Collection findByResponseStatus(int|array<int> $response_status) Return ChildIntegrationApiLogs objects filtered by the response_status column
 * @psalm-method Collection&\Traversable<ChildIntegrationApiLogs> findByResponseStatus(int|array<int> $response_status) Return ChildIntegrationApiLogs objects filtered by the response_status column
 * @method     ChildIntegrationApiLogs[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildIntegrationApiLogs objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildIntegrationApiLogs> findByCreatedAt(string|array<string> $created_at) Return ChildIntegrationApiLogs objects filtered by the created_at column
 * @method     ChildIntegrationApiLogs[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildIntegrationApiLogs objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildIntegrationApiLogs> findByUpdatedAt(string|array<string> $updated_at) Return ChildIntegrationApiLogs objects filtered by the updated_at column
 *
 * @method     ChildIntegrationApiLogs[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildIntegrationApiLogs> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class IntegrationApiLogsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\IntegrationApiLogsQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\IntegrationApiLogs', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildIntegrationApiLogsQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildIntegrationApiLogsQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildIntegrationApiLogsQuery) {
            return $criteria;
        }
        $query = new ChildIntegrationApiLogsQuery();
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
     * @return ChildIntegrationApiLogs|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(IntegrationApiLogsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = IntegrationApiLogsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildIntegrationApiLogs A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, company_id, requested_params, response, response_status, created_at, updated_at FROM integration_api_logs WHERE id = :p0';
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
            /** @var ChildIntegrationApiLogs $obj */
            $obj = new ChildIntegrationApiLogs();
            $obj->hydrate($row);
            IntegrationApiLogsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildIntegrationApiLogs|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(IntegrationApiLogsTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(IntegrationApiLogsTableMap::COL_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterById($id = null, ?string $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(IntegrationApiLogsTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(IntegrationApiLogsTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(IntegrationApiLogsTableMap::COL_ID, $id, $comparison);

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
                $this->addUsingAlias(IntegrationApiLogsTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(IntegrationApiLogsTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(IntegrationApiLogsTableMap::COL_COMPANY_ID, $companyId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the requested_params column
     *
     * Example usage:
     * <code>
     * $query->filterByRequestedParams('fooValue');   // WHERE requested_params = 'fooValue'
     * $query->filterByRequestedParams('%fooValue%', Criteria::LIKE); // WHERE requested_params LIKE '%fooValue%'
     * $query->filterByRequestedParams(['foo', 'bar']); // WHERE requested_params IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $requestedParams The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRequestedParams($requestedParams = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($requestedParams)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(IntegrationApiLogsTableMap::COL_REQUESTED_PARAMS, $requestedParams, $comparison);

        return $this;
    }

    /**
     * Filter the query on the response column
     *
     * Example usage:
     * <code>
     * $query->filterByResponse('fooValue');   // WHERE response = 'fooValue'
     * $query->filterByResponse('%fooValue%', Criteria::LIKE); // WHERE response LIKE '%fooValue%'
     * $query->filterByResponse(['foo', 'bar']); // WHERE response IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $response The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByResponse($response = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($response)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(IntegrationApiLogsTableMap::COL_RESPONSE, $response, $comparison);

        return $this;
    }

    /**
     * Filter the query on the response_status column
     *
     * Example usage:
     * <code>
     * $query->filterByResponseStatus(1234); // WHERE response_status = 1234
     * $query->filterByResponseStatus(array(12, 34)); // WHERE response_status IN (12, 34)
     * $query->filterByResponseStatus(array('min' => 12)); // WHERE response_status > 12
     * </code>
     *
     * @param mixed $responseStatus The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByResponseStatus($responseStatus = null, ?string $comparison = null)
    {
        if (is_array($responseStatus)) {
            $useMinMax = false;
            if (isset($responseStatus['min'])) {
                $this->addUsingAlias(IntegrationApiLogsTableMap::COL_RESPONSE_STATUS, $responseStatus['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($responseStatus['max'])) {
                $this->addUsingAlias(IntegrationApiLogsTableMap::COL_RESPONSE_STATUS, $responseStatus['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(IntegrationApiLogsTableMap::COL_RESPONSE_STATUS, $responseStatus, $comparison);

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
                $this->addUsingAlias(IntegrationApiLogsTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(IntegrationApiLogsTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(IntegrationApiLogsTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(IntegrationApiLogsTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(IntegrationApiLogsTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(IntegrationApiLogsTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

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
                ->addUsingAlias(IntegrationApiLogsTableMap::COL_COMPANY_ID, $company->getCompanyId(), $comparison);
        } elseif ($company instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(IntegrationApiLogsTableMap::COL_COMPANY_ID, $company->toKeyValue('PrimaryKey', 'CompanyId'), $comparison);

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
     * Exclude object from result
     *
     * @param ChildIntegrationApiLogs $integrationApiLogs Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($integrationApiLogs = null)
    {
        if ($integrationApiLogs) {
            $this->addUsingAlias(IntegrationApiLogsTableMap::COL_ID, $integrationApiLogs->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the integration_api_logs table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(IntegrationApiLogsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            IntegrationApiLogsTableMap::clearInstancePool();
            IntegrationApiLogsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(IntegrationApiLogsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(IntegrationApiLogsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            IntegrationApiLogsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            IntegrationApiLogsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
