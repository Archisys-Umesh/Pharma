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
use entities\WdbSyncLog as ChildWdbSyncLog;
use entities\WdbSyncLogQuery as ChildWdbSyncLogQuery;
use entities\Map\WdbSyncLogTableMap;

/**
 * Base class that represents a query for the `wdb_sync_log` table.
 *
 * @method     ChildWdbSyncLogQuery orderByWdbId($order = Criteria::ASC) Order by the wdb_id column
 * @method     ChildWdbSyncLogQuery orderBySysTable($order = Criteria::ASC) Order by the sys_table column
 * @method     ChildWdbSyncLogQuery orderBySysOperation($order = Criteria::ASC) Order by the sys_operation column
 * @method     ChildWdbSyncLogQuery orderBySysBody($order = Criteria::ASC) Order by the sys_body column
 * @method     ChildWdbSyncLogQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 * @method     ChildWdbSyncLogQuery orderByTokenId($order = Criteria::ASC) Order by the token_id column
 * @method     ChildWdbSyncLogQuery orderByDeviceInfo($order = Criteria::ASC) Order by the device_info column
 * @method     ChildWdbSyncLogQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildWdbSyncLogQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildWdbSyncLogQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildWdbSyncLogQuery orderByWdbKey($order = Criteria::ASC) Order by the wdb_key column
 * @method     ChildWdbSyncLogQuery orderByNewpk($order = Criteria::ASC) Order by the newpk column
 * @method     ChildWdbSyncLogQuery orderByResMessage($order = Criteria::ASC) Order by the res_message column
 * @method     ChildWdbSyncLogQuery orderByDeviceTimestamp($order = Criteria::ASC) Order by the device_timestamp column
 *
 * @method     ChildWdbSyncLogQuery groupByWdbId() Group by the wdb_id column
 * @method     ChildWdbSyncLogQuery groupBySysTable() Group by the sys_table column
 * @method     ChildWdbSyncLogQuery groupBySysOperation() Group by the sys_operation column
 * @method     ChildWdbSyncLogQuery groupBySysBody() Group by the sys_body column
 * @method     ChildWdbSyncLogQuery groupByUserId() Group by the user_id column
 * @method     ChildWdbSyncLogQuery groupByTokenId() Group by the token_id column
 * @method     ChildWdbSyncLogQuery groupByDeviceInfo() Group by the device_info column
 * @method     ChildWdbSyncLogQuery groupByCompanyId() Group by the company_id column
 * @method     ChildWdbSyncLogQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildWdbSyncLogQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildWdbSyncLogQuery groupByWdbKey() Group by the wdb_key column
 * @method     ChildWdbSyncLogQuery groupByNewpk() Group by the newpk column
 * @method     ChildWdbSyncLogQuery groupByResMessage() Group by the res_message column
 * @method     ChildWdbSyncLogQuery groupByDeviceTimestamp() Group by the device_timestamp column
 *
 * @method     ChildWdbSyncLogQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildWdbSyncLogQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildWdbSyncLogQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildWdbSyncLogQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildWdbSyncLogQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildWdbSyncLogQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildWdbSyncLogQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildWdbSyncLogQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildWdbSyncLogQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildWdbSyncLogQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildWdbSyncLogQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildWdbSyncLogQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildWdbSyncLogQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     ChildWdbSyncLogQuery leftJoinUsers($relationAlias = null) Adds a LEFT JOIN clause to the query using the Users relation
 * @method     ChildWdbSyncLogQuery rightJoinUsers($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Users relation
 * @method     ChildWdbSyncLogQuery innerJoinUsers($relationAlias = null) Adds a INNER JOIN clause to the query using the Users relation
 *
 * @method     ChildWdbSyncLogQuery joinWithUsers($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Users relation
 *
 * @method     ChildWdbSyncLogQuery leftJoinWithUsers() Adds a LEFT JOIN clause and with to the query using the Users relation
 * @method     ChildWdbSyncLogQuery rightJoinWithUsers() Adds a RIGHT JOIN clause and with to the query using the Users relation
 * @method     ChildWdbSyncLogQuery innerJoinWithUsers() Adds a INNER JOIN clause and with to the query using the Users relation
 *
 * @method     \entities\CompanyQuery|\entities\UsersQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildWdbSyncLog|null findOne(?ConnectionInterface $con = null) Return the first ChildWdbSyncLog matching the query
 * @method     ChildWdbSyncLog findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildWdbSyncLog matching the query, or a new ChildWdbSyncLog object populated from the query conditions when no match is found
 *
 * @method     ChildWdbSyncLog|null findOneByWdbId(string $wdb_id) Return the first ChildWdbSyncLog filtered by the wdb_id column
 * @method     ChildWdbSyncLog|null findOneBySysTable(string $sys_table) Return the first ChildWdbSyncLog filtered by the sys_table column
 * @method     ChildWdbSyncLog|null findOneBySysOperation(string $sys_operation) Return the first ChildWdbSyncLog filtered by the sys_operation column
 * @method     ChildWdbSyncLog|null findOneBySysBody(string $sys_body) Return the first ChildWdbSyncLog filtered by the sys_body column
 * @method     ChildWdbSyncLog|null findOneByUserId(int $user_id) Return the first ChildWdbSyncLog filtered by the user_id column
 * @method     ChildWdbSyncLog|null findOneByTokenId(string $token_id) Return the first ChildWdbSyncLog filtered by the token_id column
 * @method     ChildWdbSyncLog|null findOneByDeviceInfo(string $device_info) Return the first ChildWdbSyncLog filtered by the device_info column
 * @method     ChildWdbSyncLog|null findOneByCompanyId(int $company_id) Return the first ChildWdbSyncLog filtered by the company_id column
 * @method     ChildWdbSyncLog|null findOneByCreatedAt(string $created_at) Return the first ChildWdbSyncLog filtered by the created_at column
 * @method     ChildWdbSyncLog|null findOneByUpdatedAt(string $updated_at) Return the first ChildWdbSyncLog filtered by the updated_at column
 * @method     ChildWdbSyncLog|null findOneByWdbKey(string $wdb_key) Return the first ChildWdbSyncLog filtered by the wdb_key column
 * @method     ChildWdbSyncLog|null findOneByNewpk(int $newpk) Return the first ChildWdbSyncLog filtered by the newpk column
 * @method     ChildWdbSyncLog|null findOneByResMessage(string $res_message) Return the first ChildWdbSyncLog filtered by the res_message column
 * @method     ChildWdbSyncLog|null findOneByDeviceTimestamp(int $device_timestamp) Return the first ChildWdbSyncLog filtered by the device_timestamp column
 *
 * @method     ChildWdbSyncLog requirePk($key, ?ConnectionInterface $con = null) Return the ChildWdbSyncLog by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWdbSyncLog requireOne(?ConnectionInterface $con = null) Return the first ChildWdbSyncLog matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildWdbSyncLog requireOneByWdbId(string $wdb_id) Return the first ChildWdbSyncLog filtered by the wdb_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWdbSyncLog requireOneBySysTable(string $sys_table) Return the first ChildWdbSyncLog filtered by the sys_table column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWdbSyncLog requireOneBySysOperation(string $sys_operation) Return the first ChildWdbSyncLog filtered by the sys_operation column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWdbSyncLog requireOneBySysBody(string $sys_body) Return the first ChildWdbSyncLog filtered by the sys_body column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWdbSyncLog requireOneByUserId(int $user_id) Return the first ChildWdbSyncLog filtered by the user_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWdbSyncLog requireOneByTokenId(string $token_id) Return the first ChildWdbSyncLog filtered by the token_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWdbSyncLog requireOneByDeviceInfo(string $device_info) Return the first ChildWdbSyncLog filtered by the device_info column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWdbSyncLog requireOneByCompanyId(int $company_id) Return the first ChildWdbSyncLog filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWdbSyncLog requireOneByCreatedAt(string $created_at) Return the first ChildWdbSyncLog filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWdbSyncLog requireOneByUpdatedAt(string $updated_at) Return the first ChildWdbSyncLog filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWdbSyncLog requireOneByWdbKey(string $wdb_key) Return the first ChildWdbSyncLog filtered by the wdb_key column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWdbSyncLog requireOneByNewpk(int $newpk) Return the first ChildWdbSyncLog filtered by the newpk column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWdbSyncLog requireOneByResMessage(string $res_message) Return the first ChildWdbSyncLog filtered by the res_message column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWdbSyncLog requireOneByDeviceTimestamp(int $device_timestamp) Return the first ChildWdbSyncLog filtered by the device_timestamp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildWdbSyncLog[]|Collection find(?ConnectionInterface $con = null) Return ChildWdbSyncLog objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildWdbSyncLog> find(?ConnectionInterface $con = null) Return ChildWdbSyncLog objects based on current ModelCriteria
 *
 * @method     ChildWdbSyncLog[]|Collection findByWdbId(string|array<string> $wdb_id) Return ChildWdbSyncLog objects filtered by the wdb_id column
 * @psalm-method Collection&\Traversable<ChildWdbSyncLog> findByWdbId(string|array<string> $wdb_id) Return ChildWdbSyncLog objects filtered by the wdb_id column
 * @method     ChildWdbSyncLog[]|Collection findBySysTable(string|array<string> $sys_table) Return ChildWdbSyncLog objects filtered by the sys_table column
 * @psalm-method Collection&\Traversable<ChildWdbSyncLog> findBySysTable(string|array<string> $sys_table) Return ChildWdbSyncLog objects filtered by the sys_table column
 * @method     ChildWdbSyncLog[]|Collection findBySysOperation(string|array<string> $sys_operation) Return ChildWdbSyncLog objects filtered by the sys_operation column
 * @psalm-method Collection&\Traversable<ChildWdbSyncLog> findBySysOperation(string|array<string> $sys_operation) Return ChildWdbSyncLog objects filtered by the sys_operation column
 * @method     ChildWdbSyncLog[]|Collection findBySysBody(string|array<string> $sys_body) Return ChildWdbSyncLog objects filtered by the sys_body column
 * @psalm-method Collection&\Traversable<ChildWdbSyncLog> findBySysBody(string|array<string> $sys_body) Return ChildWdbSyncLog objects filtered by the sys_body column
 * @method     ChildWdbSyncLog[]|Collection findByUserId(int|array<int> $user_id) Return ChildWdbSyncLog objects filtered by the user_id column
 * @psalm-method Collection&\Traversable<ChildWdbSyncLog> findByUserId(int|array<int> $user_id) Return ChildWdbSyncLog objects filtered by the user_id column
 * @method     ChildWdbSyncLog[]|Collection findByTokenId(string|array<string> $token_id) Return ChildWdbSyncLog objects filtered by the token_id column
 * @psalm-method Collection&\Traversable<ChildWdbSyncLog> findByTokenId(string|array<string> $token_id) Return ChildWdbSyncLog objects filtered by the token_id column
 * @method     ChildWdbSyncLog[]|Collection findByDeviceInfo(string|array<string> $device_info) Return ChildWdbSyncLog objects filtered by the device_info column
 * @psalm-method Collection&\Traversable<ChildWdbSyncLog> findByDeviceInfo(string|array<string> $device_info) Return ChildWdbSyncLog objects filtered by the device_info column
 * @method     ChildWdbSyncLog[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildWdbSyncLog objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildWdbSyncLog> findByCompanyId(int|array<int> $company_id) Return ChildWdbSyncLog objects filtered by the company_id column
 * @method     ChildWdbSyncLog[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildWdbSyncLog objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildWdbSyncLog> findByCreatedAt(string|array<string> $created_at) Return ChildWdbSyncLog objects filtered by the created_at column
 * @method     ChildWdbSyncLog[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildWdbSyncLog objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildWdbSyncLog> findByUpdatedAt(string|array<string> $updated_at) Return ChildWdbSyncLog objects filtered by the updated_at column
 * @method     ChildWdbSyncLog[]|Collection findByWdbKey(string|array<string> $wdb_key) Return ChildWdbSyncLog objects filtered by the wdb_key column
 * @psalm-method Collection&\Traversable<ChildWdbSyncLog> findByWdbKey(string|array<string> $wdb_key) Return ChildWdbSyncLog objects filtered by the wdb_key column
 * @method     ChildWdbSyncLog[]|Collection findByNewpk(int|array<int> $newpk) Return ChildWdbSyncLog objects filtered by the newpk column
 * @psalm-method Collection&\Traversable<ChildWdbSyncLog> findByNewpk(int|array<int> $newpk) Return ChildWdbSyncLog objects filtered by the newpk column
 * @method     ChildWdbSyncLog[]|Collection findByResMessage(string|array<string> $res_message) Return ChildWdbSyncLog objects filtered by the res_message column
 * @psalm-method Collection&\Traversable<ChildWdbSyncLog> findByResMessage(string|array<string> $res_message) Return ChildWdbSyncLog objects filtered by the res_message column
 * @method     ChildWdbSyncLog[]|Collection findByDeviceTimestamp(int|array<int> $device_timestamp) Return ChildWdbSyncLog objects filtered by the device_timestamp column
 * @psalm-method Collection&\Traversable<ChildWdbSyncLog> findByDeviceTimestamp(int|array<int> $device_timestamp) Return ChildWdbSyncLog objects filtered by the device_timestamp column
 *
 * @method     ChildWdbSyncLog[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildWdbSyncLog> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class WdbSyncLogQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\WdbSyncLogQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\WdbSyncLog', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildWdbSyncLogQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildWdbSyncLogQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildWdbSyncLogQuery) {
            return $criteria;
        }
        $query = new ChildWdbSyncLogQuery();
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
     * @return ChildWdbSyncLog|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(WdbSyncLogTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = WdbSyncLogTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildWdbSyncLog A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT wdb_id, sys_table, sys_operation, sys_body, user_id, token_id, device_info, company_id, created_at, updated_at, wdb_key, newpk, res_message, device_timestamp FROM wdb_sync_log WHERE wdb_id = :p0';
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
            /** @var ChildWdbSyncLog $obj */
            $obj = new ChildWdbSyncLog();
            $obj->hydrate($row);
            WdbSyncLogTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildWdbSyncLog|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(WdbSyncLogTableMap::COL_WDB_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(WdbSyncLogTableMap::COL_WDB_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the wdb_id column
     *
     * Example usage:
     * <code>
     * $query->filterByWdbId(1234); // WHERE wdb_id = 1234
     * $query->filterByWdbId(array(12, 34)); // WHERE wdb_id IN (12, 34)
     * $query->filterByWdbId(array('min' => 12)); // WHERE wdb_id > 12
     * </code>
     *
     * @param mixed $wdbId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWdbId($wdbId = null, ?string $comparison = null)
    {
        if (is_array($wdbId)) {
            $useMinMax = false;
            if (isset($wdbId['min'])) {
                $this->addUsingAlias(WdbSyncLogTableMap::COL_WDB_ID, $wdbId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($wdbId['max'])) {
                $this->addUsingAlias(WdbSyncLogTableMap::COL_WDB_ID, $wdbId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WdbSyncLogTableMap::COL_WDB_ID, $wdbId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the sys_table column
     *
     * Example usage:
     * <code>
     * $query->filterBySysTable('fooValue');   // WHERE sys_table = 'fooValue'
     * $query->filterBySysTable('%fooValue%', Criteria::LIKE); // WHERE sys_table LIKE '%fooValue%'
     * $query->filterBySysTable(['foo', 'bar']); // WHERE sys_table IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $sysTable The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySysTable($sysTable = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($sysTable)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WdbSyncLogTableMap::COL_SYS_TABLE, $sysTable, $comparison);

        return $this;
    }

    /**
     * Filter the query on the sys_operation column
     *
     * Example usage:
     * <code>
     * $query->filterBySysOperation('fooValue');   // WHERE sys_operation = 'fooValue'
     * $query->filterBySysOperation('%fooValue%', Criteria::LIKE); // WHERE sys_operation LIKE '%fooValue%'
     * $query->filterBySysOperation(['foo', 'bar']); // WHERE sys_operation IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $sysOperation The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySysOperation($sysOperation = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($sysOperation)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WdbSyncLogTableMap::COL_SYS_OPERATION, $sysOperation, $comparison);

        return $this;
    }

    /**
     * Filter the query on the sys_body column
     *
     * Example usage:
     * <code>
     * $query->filterBySysBody('fooValue');   // WHERE sys_body = 'fooValue'
     * $query->filterBySysBody('%fooValue%', Criteria::LIKE); // WHERE sys_body LIKE '%fooValue%'
     * $query->filterBySysBody(['foo', 'bar']); // WHERE sys_body IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $sysBody The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySysBody($sysBody = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($sysBody)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WdbSyncLogTableMap::COL_SYS_BODY, $sysBody, $comparison);

        return $this;
    }

    /**
     * Filter the query on the user_id column
     *
     * Example usage:
     * <code>
     * $query->filterByUserId(1234); // WHERE user_id = 1234
     * $query->filterByUserId(array(12, 34)); // WHERE user_id IN (12, 34)
     * $query->filterByUserId(array('min' => 12)); // WHERE user_id > 12
     * </code>
     *
     * @see       filterByUsers()
     *
     * @param mixed $userId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUserId($userId = null, ?string $comparison = null)
    {
        if (is_array($userId)) {
            $useMinMax = false;
            if (isset($userId['min'])) {
                $this->addUsingAlias(WdbSyncLogTableMap::COL_USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userId['max'])) {
                $this->addUsingAlias(WdbSyncLogTableMap::COL_USER_ID, $userId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WdbSyncLogTableMap::COL_USER_ID, $userId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the token_id column
     *
     * Example usage:
     * <code>
     * $query->filterByTokenId('fooValue');   // WHERE token_id = 'fooValue'
     * $query->filterByTokenId('%fooValue%', Criteria::LIKE); // WHERE token_id LIKE '%fooValue%'
     * $query->filterByTokenId(['foo', 'bar']); // WHERE token_id IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $tokenId The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTokenId($tokenId = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tokenId)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WdbSyncLogTableMap::COL_TOKEN_ID, $tokenId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the device_info column
     *
     * Example usage:
     * <code>
     * $query->filterByDeviceInfo('fooValue');   // WHERE device_info = 'fooValue'
     * $query->filterByDeviceInfo('%fooValue%', Criteria::LIKE); // WHERE device_info LIKE '%fooValue%'
     * $query->filterByDeviceInfo(['foo', 'bar']); // WHERE device_info IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $deviceInfo The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDeviceInfo($deviceInfo = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($deviceInfo)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WdbSyncLogTableMap::COL_DEVICE_INFO, $deviceInfo, $comparison);

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
                $this->addUsingAlias(WdbSyncLogTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(WdbSyncLogTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WdbSyncLogTableMap::COL_COMPANY_ID, $companyId, $comparison);

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
                $this->addUsingAlias(WdbSyncLogTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(WdbSyncLogTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WdbSyncLogTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(WdbSyncLogTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(WdbSyncLogTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WdbSyncLogTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the wdb_key column
     *
     * Example usage:
     * <code>
     * $query->filterByWdbKey('fooValue');   // WHERE wdb_key = 'fooValue'
     * $query->filterByWdbKey('%fooValue%', Criteria::LIKE); // WHERE wdb_key LIKE '%fooValue%'
     * $query->filterByWdbKey(['foo', 'bar']); // WHERE wdb_key IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $wdbKey The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWdbKey($wdbKey = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($wdbKey)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WdbSyncLogTableMap::COL_WDB_KEY, $wdbKey, $comparison);

        return $this;
    }

    /**
     * Filter the query on the newpk column
     *
     * Example usage:
     * <code>
     * $query->filterByNewpk(1234); // WHERE newpk = 1234
     * $query->filterByNewpk(array(12, 34)); // WHERE newpk IN (12, 34)
     * $query->filterByNewpk(array('min' => 12)); // WHERE newpk > 12
     * </code>
     *
     * @param mixed $newpk The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByNewpk($newpk = null, ?string $comparison = null)
    {
        if (is_array($newpk)) {
            $useMinMax = false;
            if (isset($newpk['min'])) {
                $this->addUsingAlias(WdbSyncLogTableMap::COL_NEWPK, $newpk['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($newpk['max'])) {
                $this->addUsingAlias(WdbSyncLogTableMap::COL_NEWPK, $newpk['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WdbSyncLogTableMap::COL_NEWPK, $newpk, $comparison);

        return $this;
    }

    /**
     * Filter the query on the res_message column
     *
     * Example usage:
     * <code>
     * $query->filterByResMessage('fooValue');   // WHERE res_message = 'fooValue'
     * $query->filterByResMessage('%fooValue%', Criteria::LIKE); // WHERE res_message LIKE '%fooValue%'
     * $query->filterByResMessage(['foo', 'bar']); // WHERE res_message IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $resMessage The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByResMessage($resMessage = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($resMessage)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WdbSyncLogTableMap::COL_RES_MESSAGE, $resMessage, $comparison);

        return $this;
    }

    /**
     * Filter the query on the device_timestamp column
     *
     * Example usage:
     * <code>
     * $query->filterByDeviceTimestamp(1234); // WHERE device_timestamp = 1234
     * $query->filterByDeviceTimestamp(array(12, 34)); // WHERE device_timestamp IN (12, 34)
     * $query->filterByDeviceTimestamp(array('min' => 12)); // WHERE device_timestamp > 12
     * </code>
     *
     * @param mixed $deviceTimestamp The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDeviceTimestamp($deviceTimestamp = null, ?string $comparison = null)
    {
        if (is_array($deviceTimestamp)) {
            $useMinMax = false;
            if (isset($deviceTimestamp['min'])) {
                $this->addUsingAlias(WdbSyncLogTableMap::COL_DEVICE_TIMESTAMP, $deviceTimestamp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($deviceTimestamp['max'])) {
                $this->addUsingAlias(WdbSyncLogTableMap::COL_DEVICE_TIMESTAMP, $deviceTimestamp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WdbSyncLogTableMap::COL_DEVICE_TIMESTAMP, $deviceTimestamp, $comparison);

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
                ->addUsingAlias(WdbSyncLogTableMap::COL_COMPANY_ID, $company->getCompanyId(), $comparison);
        } elseif ($company instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(WdbSyncLogTableMap::COL_COMPANY_ID, $company->toKeyValue('PrimaryKey', 'CompanyId'), $comparison);

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
     * Filter the query by a related \entities\Users object
     *
     * @param \entities\Users|ObjectCollection $users The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUsers($users, ?string $comparison = null)
    {
        if ($users instanceof \entities\Users) {
            return $this
                ->addUsingAlias(WdbSyncLogTableMap::COL_USER_ID, $users->getUserId(), $comparison);
        } elseif ($users instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(WdbSyncLogTableMap::COL_USER_ID, $users->toKeyValue('PrimaryKey', 'UserId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByUsers() only accepts arguments of type \entities\Users or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Users relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinUsers(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Users');

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
            $this->addJoinObject($join, 'Users');
        }

        return $this;
    }

    /**
     * Use the Users relation Users object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\UsersQuery A secondary query class using the current class as primary query
     */
    public function useUsersQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinUsers($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Users', '\entities\UsersQuery');
    }

    /**
     * Use the Users relation Users object
     *
     * @param callable(\entities\UsersQuery):\entities\UsersQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withUsersQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useUsersQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Users table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\UsersQuery The inner query object of the EXISTS statement
     */
    public function useUsersExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\UsersQuery */
        $q = $this->useExistsQuery('Users', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Users table for a NOT EXISTS query.
     *
     * @see useUsersExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\UsersQuery The inner query object of the NOT EXISTS statement
     */
    public function useUsersNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\UsersQuery */
        $q = $this->useExistsQuery('Users', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Users table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\UsersQuery The inner query object of the IN statement
     */
    public function useInUsersQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\UsersQuery */
        $q = $this->useInQuery('Users', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Users table for a NOT IN query.
     *
     * @see useUsersInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\UsersQuery The inner query object of the NOT IN statement
     */
    public function useNotInUsersQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\UsersQuery */
        $q = $this->useInQuery('Users', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildWdbSyncLog $wdbSyncLog Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($wdbSyncLog = null)
    {
        if ($wdbSyncLog) {
            $this->addUsingAlias(WdbSyncLogTableMap::COL_WDB_ID, $wdbSyncLog->getWdbId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the wdb_sync_log table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(WdbSyncLogTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            WdbSyncLogTableMap::clearInstancePool();
            WdbSyncLogTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(WdbSyncLogTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(WdbSyncLogTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            WdbSyncLogTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            WdbSyncLogTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
