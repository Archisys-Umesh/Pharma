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
use entities\FtpConfigs as ChildFtpConfigs;
use entities\FtpConfigsQuery as ChildFtpConfigsQuery;
use entities\Map\FtpConfigsTableMap;

/**
 * Base class that represents a query for the `ftp_configs` table.
 *
 * @method     ChildFtpConfigsQuery orderByFtpConfigId($order = Criteria::ASC) Order by the ftp_config_id column
 * @method     ChildFtpConfigsQuery orderByHost($order = Criteria::ASC) Order by the host column
 * @method     ChildFtpConfigsQuery orderByUsername($order = Criteria::ASC) Order by the username column
 * @method     ChildFtpConfigsQuery orderByPassword($order = Criteria::ASC) Order by the password column
 * @method     ChildFtpConfigsQuery orderByPort($order = Criteria::ASC) Order by the port column
 * @method     ChildFtpConfigsQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildFtpConfigsQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildFtpConfigsQuery orderByIsenabled($order = Criteria::ASC) Order by the isenabled column
 *
 * @method     ChildFtpConfigsQuery groupByFtpConfigId() Group by the ftp_config_id column
 * @method     ChildFtpConfigsQuery groupByHost() Group by the host column
 * @method     ChildFtpConfigsQuery groupByUsername() Group by the username column
 * @method     ChildFtpConfigsQuery groupByPassword() Group by the password column
 * @method     ChildFtpConfigsQuery groupByPort() Group by the port column
 * @method     ChildFtpConfigsQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildFtpConfigsQuery groupByCompanyId() Group by the company_id column
 * @method     ChildFtpConfigsQuery groupByIsenabled() Group by the isenabled column
 *
 * @method     ChildFtpConfigsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildFtpConfigsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildFtpConfigsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildFtpConfigsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildFtpConfigsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildFtpConfigsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildFtpConfigsQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildFtpConfigsQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildFtpConfigsQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildFtpConfigsQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildFtpConfigsQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildFtpConfigsQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildFtpConfigsQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     \entities\CompanyQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildFtpConfigs|null findOne(?ConnectionInterface $con = null) Return the first ChildFtpConfigs matching the query
 * @method     ChildFtpConfigs findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildFtpConfigs matching the query, or a new ChildFtpConfigs object populated from the query conditions when no match is found
 *
 * @method     ChildFtpConfigs|null findOneByFtpConfigId(int $ftp_config_id) Return the first ChildFtpConfigs filtered by the ftp_config_id column
 * @method     ChildFtpConfigs|null findOneByHost(string $host) Return the first ChildFtpConfigs filtered by the host column
 * @method     ChildFtpConfigs|null findOneByUsername(string $username) Return the first ChildFtpConfigs filtered by the username column
 * @method     ChildFtpConfigs|null findOneByPassword(string $password) Return the first ChildFtpConfigs filtered by the password column
 * @method     ChildFtpConfigs|null findOneByPort(int $port) Return the first ChildFtpConfigs filtered by the port column
 * @method     ChildFtpConfigs|null findOneByCreatedAt(string $created_at) Return the first ChildFtpConfigs filtered by the created_at column
 * @method     ChildFtpConfigs|null findOneByCompanyId(int $company_id) Return the first ChildFtpConfigs filtered by the company_id column
 * @method     ChildFtpConfigs|null findOneByIsenabled(int $isenabled) Return the first ChildFtpConfigs filtered by the isenabled column
 *
 * @method     ChildFtpConfigs requirePk($key, ?ConnectionInterface $con = null) Return the ChildFtpConfigs by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFtpConfigs requireOne(?ConnectionInterface $con = null) Return the first ChildFtpConfigs matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildFtpConfigs requireOneByFtpConfigId(int $ftp_config_id) Return the first ChildFtpConfigs filtered by the ftp_config_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFtpConfigs requireOneByHost(string $host) Return the first ChildFtpConfigs filtered by the host column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFtpConfigs requireOneByUsername(string $username) Return the first ChildFtpConfigs filtered by the username column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFtpConfigs requireOneByPassword(string $password) Return the first ChildFtpConfigs filtered by the password column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFtpConfigs requireOneByPort(int $port) Return the first ChildFtpConfigs filtered by the port column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFtpConfigs requireOneByCreatedAt(string $created_at) Return the first ChildFtpConfigs filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFtpConfigs requireOneByCompanyId(int $company_id) Return the first ChildFtpConfigs filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFtpConfigs requireOneByIsenabled(int $isenabled) Return the first ChildFtpConfigs filtered by the isenabled column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildFtpConfigs[]|Collection find(?ConnectionInterface $con = null) Return ChildFtpConfigs objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildFtpConfigs> find(?ConnectionInterface $con = null) Return ChildFtpConfigs objects based on current ModelCriteria
 *
 * @method     ChildFtpConfigs[]|Collection findByFtpConfigId(int|array<int> $ftp_config_id) Return ChildFtpConfigs objects filtered by the ftp_config_id column
 * @psalm-method Collection&\Traversable<ChildFtpConfigs> findByFtpConfigId(int|array<int> $ftp_config_id) Return ChildFtpConfigs objects filtered by the ftp_config_id column
 * @method     ChildFtpConfigs[]|Collection findByHost(string|array<string> $host) Return ChildFtpConfigs objects filtered by the host column
 * @psalm-method Collection&\Traversable<ChildFtpConfigs> findByHost(string|array<string> $host) Return ChildFtpConfigs objects filtered by the host column
 * @method     ChildFtpConfigs[]|Collection findByUsername(string|array<string> $username) Return ChildFtpConfigs objects filtered by the username column
 * @psalm-method Collection&\Traversable<ChildFtpConfigs> findByUsername(string|array<string> $username) Return ChildFtpConfigs objects filtered by the username column
 * @method     ChildFtpConfigs[]|Collection findByPassword(string|array<string> $password) Return ChildFtpConfigs objects filtered by the password column
 * @psalm-method Collection&\Traversable<ChildFtpConfigs> findByPassword(string|array<string> $password) Return ChildFtpConfigs objects filtered by the password column
 * @method     ChildFtpConfigs[]|Collection findByPort(int|array<int> $port) Return ChildFtpConfigs objects filtered by the port column
 * @psalm-method Collection&\Traversable<ChildFtpConfigs> findByPort(int|array<int> $port) Return ChildFtpConfigs objects filtered by the port column
 * @method     ChildFtpConfigs[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildFtpConfigs objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildFtpConfigs> findByCreatedAt(string|array<string> $created_at) Return ChildFtpConfigs objects filtered by the created_at column
 * @method     ChildFtpConfigs[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildFtpConfigs objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildFtpConfigs> findByCompanyId(int|array<int> $company_id) Return ChildFtpConfigs objects filtered by the company_id column
 * @method     ChildFtpConfigs[]|Collection findByIsenabled(int|array<int> $isenabled) Return ChildFtpConfigs objects filtered by the isenabled column
 * @psalm-method Collection&\Traversable<ChildFtpConfigs> findByIsenabled(int|array<int> $isenabled) Return ChildFtpConfigs objects filtered by the isenabled column
 *
 * @method     ChildFtpConfigs[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildFtpConfigs> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class FtpConfigsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\FtpConfigsQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\FtpConfigs', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildFtpConfigsQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildFtpConfigsQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildFtpConfigsQuery) {
            return $criteria;
        }
        $query = new ChildFtpConfigsQuery();
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
     * @return ChildFtpConfigs|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(FtpConfigsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = FtpConfigsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildFtpConfigs A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT ftp_config_id, host, username, password, port, created_at, company_id, isenabled FROM ftp_configs WHERE ftp_config_id = :p0';
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
            /** @var ChildFtpConfigs $obj */
            $obj = new ChildFtpConfigs();
            $obj->hydrate($row);
            FtpConfigsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildFtpConfigs|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(FtpConfigsTableMap::COL_FTP_CONFIG_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(FtpConfigsTableMap::COL_FTP_CONFIG_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the ftp_config_id column
     *
     * Example usage:
     * <code>
     * $query->filterByFtpConfigId(1234); // WHERE ftp_config_id = 1234
     * $query->filterByFtpConfigId(array(12, 34)); // WHERE ftp_config_id IN (12, 34)
     * $query->filterByFtpConfigId(array('min' => 12)); // WHERE ftp_config_id > 12
     * </code>
     *
     * @param mixed $ftpConfigId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFtpConfigId($ftpConfigId = null, ?string $comparison = null)
    {
        if (is_array($ftpConfigId)) {
            $useMinMax = false;
            if (isset($ftpConfigId['min'])) {
                $this->addUsingAlias(FtpConfigsTableMap::COL_FTP_CONFIG_ID, $ftpConfigId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($ftpConfigId['max'])) {
                $this->addUsingAlias(FtpConfigsTableMap::COL_FTP_CONFIG_ID, $ftpConfigId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(FtpConfigsTableMap::COL_FTP_CONFIG_ID, $ftpConfigId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the host column
     *
     * Example usage:
     * <code>
     * $query->filterByHost('fooValue');   // WHERE host = 'fooValue'
     * $query->filterByHost('%fooValue%', Criteria::LIKE); // WHERE host LIKE '%fooValue%'
     * $query->filterByHost(['foo', 'bar']); // WHERE host IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $host The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByHost($host = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($host)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(FtpConfigsTableMap::COL_HOST, $host, $comparison);

        return $this;
    }

    /**
     * Filter the query on the username column
     *
     * Example usage:
     * <code>
     * $query->filterByUsername('fooValue');   // WHERE username = 'fooValue'
     * $query->filterByUsername('%fooValue%', Criteria::LIKE); // WHERE username LIKE '%fooValue%'
     * $query->filterByUsername(['foo', 'bar']); // WHERE username IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $username The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUsername($username = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($username)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(FtpConfigsTableMap::COL_USERNAME, $username, $comparison);

        return $this;
    }

    /**
     * Filter the query on the password column
     *
     * Example usage:
     * <code>
     * $query->filterByPassword('fooValue');   // WHERE password = 'fooValue'
     * $query->filterByPassword('%fooValue%', Criteria::LIKE); // WHERE password LIKE '%fooValue%'
     * $query->filterByPassword(['foo', 'bar']); // WHERE password IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $password The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPassword($password = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($password)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(FtpConfigsTableMap::COL_PASSWORD, $password, $comparison);

        return $this;
    }

    /**
     * Filter the query on the port column
     *
     * Example usage:
     * <code>
     * $query->filterByPort(1234); // WHERE port = 1234
     * $query->filterByPort(array(12, 34)); // WHERE port IN (12, 34)
     * $query->filterByPort(array('min' => 12)); // WHERE port > 12
     * </code>
     *
     * @param mixed $port The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPort($port = null, ?string $comparison = null)
    {
        if (is_array($port)) {
            $useMinMax = false;
            if (isset($port['min'])) {
                $this->addUsingAlias(FtpConfigsTableMap::COL_PORT, $port['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($port['max'])) {
                $this->addUsingAlias(FtpConfigsTableMap::COL_PORT, $port['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(FtpConfigsTableMap::COL_PORT, $port, $comparison);

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
                $this->addUsingAlias(FtpConfigsTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(FtpConfigsTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(FtpConfigsTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(FtpConfigsTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(FtpConfigsTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(FtpConfigsTableMap::COL_COMPANY_ID, $companyId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the isenabled column
     *
     * Example usage:
     * <code>
     * $query->filterByIsenabled(1234); // WHERE isenabled = 1234
     * $query->filterByIsenabled(array(12, 34)); // WHERE isenabled IN (12, 34)
     * $query->filterByIsenabled(array('min' => 12)); // WHERE isenabled > 12
     * </code>
     *
     * @param mixed $isenabled The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIsenabled($isenabled = null, ?string $comparison = null)
    {
        if (is_array($isenabled)) {
            $useMinMax = false;
            if (isset($isenabled['min'])) {
                $this->addUsingAlias(FtpConfigsTableMap::COL_ISENABLED, $isenabled['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($isenabled['max'])) {
                $this->addUsingAlias(FtpConfigsTableMap::COL_ISENABLED, $isenabled['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(FtpConfigsTableMap::COL_ISENABLED, $isenabled, $comparison);

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
                ->addUsingAlias(FtpConfigsTableMap::COL_COMPANY_ID, $company->getCompanyId(), $comparison);
        } elseif ($company instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(FtpConfigsTableMap::COL_COMPANY_ID, $company->toKeyValue('PrimaryKey', 'CompanyId'), $comparison);

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
    public function joinCompany(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
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
    public function useCompanyQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
        ?string $joinType = Criteria::INNER_JOIN
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
     * @param ChildFtpConfigs $ftpConfigs Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($ftpConfigs = null)
    {
        if ($ftpConfigs) {
            $this->addUsingAlias(FtpConfigsTableMap::COL_FTP_CONFIG_ID, $ftpConfigs->getFtpConfigId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the ftp_configs table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(FtpConfigsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            FtpConfigsTableMap::clearInstancePool();
            FtpConfigsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(FtpConfigsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(FtpConfigsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            FtpConfigsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            FtpConfigsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
