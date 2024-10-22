<?php

namespace entities\Base;

use \Exception;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use entities\WdbSyncLogBkp as ChildWdbSyncLogBkp;
use entities\WdbSyncLogBkpQuery as ChildWdbSyncLogBkpQuery;
use entities\Map\WdbSyncLogBkpTableMap;

/**
 * Base class that represents a query for the `wdb_sync_log_bkp` table.
 *
 * @method     ChildWdbSyncLogBkpQuery orderByWdbId($order = Criteria::ASC) Order by the wdb_id column
 * @method     ChildWdbSyncLogBkpQuery orderBySysTable($order = Criteria::ASC) Order by the sys_table column
 * @method     ChildWdbSyncLogBkpQuery orderBySysOperation($order = Criteria::ASC) Order by the sys_operation column
 * @method     ChildWdbSyncLogBkpQuery orderBySysBody($order = Criteria::ASC) Order by the sys_body column
 * @method     ChildWdbSyncLogBkpQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 * @method     ChildWdbSyncLogBkpQuery orderByTokenId($order = Criteria::ASC) Order by the token_id column
 * @method     ChildWdbSyncLogBkpQuery orderByDeviceInfo($order = Criteria::ASC) Order by the device_info column
 * @method     ChildWdbSyncLogBkpQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildWdbSyncLogBkpQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildWdbSyncLogBkpQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildWdbSyncLogBkpQuery orderByWdbKey($order = Criteria::ASC) Order by the wdb_key column
 * @method     ChildWdbSyncLogBkpQuery orderByNewpk($order = Criteria::ASC) Order by the newpk column
 * @method     ChildWdbSyncLogBkpQuery orderByResMessage($order = Criteria::ASC) Order by the res_message column
 * @method     ChildWdbSyncLogBkpQuery orderByDeviceTimestamp($order = Criteria::ASC) Order by the device_timestamp column
 *
 * @method     ChildWdbSyncLogBkpQuery groupByWdbId() Group by the wdb_id column
 * @method     ChildWdbSyncLogBkpQuery groupBySysTable() Group by the sys_table column
 * @method     ChildWdbSyncLogBkpQuery groupBySysOperation() Group by the sys_operation column
 * @method     ChildWdbSyncLogBkpQuery groupBySysBody() Group by the sys_body column
 * @method     ChildWdbSyncLogBkpQuery groupByUserId() Group by the user_id column
 * @method     ChildWdbSyncLogBkpQuery groupByTokenId() Group by the token_id column
 * @method     ChildWdbSyncLogBkpQuery groupByDeviceInfo() Group by the device_info column
 * @method     ChildWdbSyncLogBkpQuery groupByCompanyId() Group by the company_id column
 * @method     ChildWdbSyncLogBkpQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildWdbSyncLogBkpQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildWdbSyncLogBkpQuery groupByWdbKey() Group by the wdb_key column
 * @method     ChildWdbSyncLogBkpQuery groupByNewpk() Group by the newpk column
 * @method     ChildWdbSyncLogBkpQuery groupByResMessage() Group by the res_message column
 * @method     ChildWdbSyncLogBkpQuery groupByDeviceTimestamp() Group by the device_timestamp column
 *
 * @method     ChildWdbSyncLogBkpQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildWdbSyncLogBkpQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildWdbSyncLogBkpQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildWdbSyncLogBkpQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildWdbSyncLogBkpQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildWdbSyncLogBkpQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildWdbSyncLogBkp|null findOne(?ConnectionInterface $con = null) Return the first ChildWdbSyncLogBkp matching the query
 * @method     ChildWdbSyncLogBkp findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildWdbSyncLogBkp matching the query, or a new ChildWdbSyncLogBkp object populated from the query conditions when no match is found
 *
 * @method     ChildWdbSyncLogBkp|null findOneByWdbId(string $wdb_id) Return the first ChildWdbSyncLogBkp filtered by the wdb_id column
 * @method     ChildWdbSyncLogBkp|null findOneBySysTable(string $sys_table) Return the first ChildWdbSyncLogBkp filtered by the sys_table column
 * @method     ChildWdbSyncLogBkp|null findOneBySysOperation(string $sys_operation) Return the first ChildWdbSyncLogBkp filtered by the sys_operation column
 * @method     ChildWdbSyncLogBkp|null findOneBySysBody(string $sys_body) Return the first ChildWdbSyncLogBkp filtered by the sys_body column
 * @method     ChildWdbSyncLogBkp|null findOneByUserId(int $user_id) Return the first ChildWdbSyncLogBkp filtered by the user_id column
 * @method     ChildWdbSyncLogBkp|null findOneByTokenId(string $token_id) Return the first ChildWdbSyncLogBkp filtered by the token_id column
 * @method     ChildWdbSyncLogBkp|null findOneByDeviceInfo(string $device_info) Return the first ChildWdbSyncLogBkp filtered by the device_info column
 * @method     ChildWdbSyncLogBkp|null findOneByCompanyId(int $company_id) Return the first ChildWdbSyncLogBkp filtered by the company_id column
 * @method     ChildWdbSyncLogBkp|null findOneByCreatedAt(string $created_at) Return the first ChildWdbSyncLogBkp filtered by the created_at column
 * @method     ChildWdbSyncLogBkp|null findOneByUpdatedAt(string $updated_at) Return the first ChildWdbSyncLogBkp filtered by the updated_at column
 * @method     ChildWdbSyncLogBkp|null findOneByWdbKey(string $wdb_key) Return the first ChildWdbSyncLogBkp filtered by the wdb_key column
 * @method     ChildWdbSyncLogBkp|null findOneByNewpk(int $newpk) Return the first ChildWdbSyncLogBkp filtered by the newpk column
 * @method     ChildWdbSyncLogBkp|null findOneByResMessage(string $res_message) Return the first ChildWdbSyncLogBkp filtered by the res_message column
 * @method     ChildWdbSyncLogBkp|null findOneByDeviceTimestamp(int $device_timestamp) Return the first ChildWdbSyncLogBkp filtered by the device_timestamp column
 *
 * @method     ChildWdbSyncLogBkp requirePk($key, ?ConnectionInterface $con = null) Return the ChildWdbSyncLogBkp by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWdbSyncLogBkp requireOne(?ConnectionInterface $con = null) Return the first ChildWdbSyncLogBkp matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildWdbSyncLogBkp requireOneByWdbId(string $wdb_id) Return the first ChildWdbSyncLogBkp filtered by the wdb_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWdbSyncLogBkp requireOneBySysTable(string $sys_table) Return the first ChildWdbSyncLogBkp filtered by the sys_table column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWdbSyncLogBkp requireOneBySysOperation(string $sys_operation) Return the first ChildWdbSyncLogBkp filtered by the sys_operation column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWdbSyncLogBkp requireOneBySysBody(string $sys_body) Return the first ChildWdbSyncLogBkp filtered by the sys_body column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWdbSyncLogBkp requireOneByUserId(int $user_id) Return the first ChildWdbSyncLogBkp filtered by the user_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWdbSyncLogBkp requireOneByTokenId(string $token_id) Return the first ChildWdbSyncLogBkp filtered by the token_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWdbSyncLogBkp requireOneByDeviceInfo(string $device_info) Return the first ChildWdbSyncLogBkp filtered by the device_info column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWdbSyncLogBkp requireOneByCompanyId(int $company_id) Return the first ChildWdbSyncLogBkp filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWdbSyncLogBkp requireOneByCreatedAt(string $created_at) Return the first ChildWdbSyncLogBkp filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWdbSyncLogBkp requireOneByUpdatedAt(string $updated_at) Return the first ChildWdbSyncLogBkp filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWdbSyncLogBkp requireOneByWdbKey(string $wdb_key) Return the first ChildWdbSyncLogBkp filtered by the wdb_key column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWdbSyncLogBkp requireOneByNewpk(int $newpk) Return the first ChildWdbSyncLogBkp filtered by the newpk column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWdbSyncLogBkp requireOneByResMessage(string $res_message) Return the first ChildWdbSyncLogBkp filtered by the res_message column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWdbSyncLogBkp requireOneByDeviceTimestamp(int $device_timestamp) Return the first ChildWdbSyncLogBkp filtered by the device_timestamp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildWdbSyncLogBkp[]|Collection find(?ConnectionInterface $con = null) Return ChildWdbSyncLogBkp objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildWdbSyncLogBkp> find(?ConnectionInterface $con = null) Return ChildWdbSyncLogBkp objects based on current ModelCriteria
 *
 * @method     ChildWdbSyncLogBkp[]|Collection findByWdbId(string|array<string> $wdb_id) Return ChildWdbSyncLogBkp objects filtered by the wdb_id column
 * @psalm-method Collection&\Traversable<ChildWdbSyncLogBkp> findByWdbId(string|array<string> $wdb_id) Return ChildWdbSyncLogBkp objects filtered by the wdb_id column
 * @method     ChildWdbSyncLogBkp[]|Collection findBySysTable(string|array<string> $sys_table) Return ChildWdbSyncLogBkp objects filtered by the sys_table column
 * @psalm-method Collection&\Traversable<ChildWdbSyncLogBkp> findBySysTable(string|array<string> $sys_table) Return ChildWdbSyncLogBkp objects filtered by the sys_table column
 * @method     ChildWdbSyncLogBkp[]|Collection findBySysOperation(string|array<string> $sys_operation) Return ChildWdbSyncLogBkp objects filtered by the sys_operation column
 * @psalm-method Collection&\Traversable<ChildWdbSyncLogBkp> findBySysOperation(string|array<string> $sys_operation) Return ChildWdbSyncLogBkp objects filtered by the sys_operation column
 * @method     ChildWdbSyncLogBkp[]|Collection findBySysBody(string|array<string> $sys_body) Return ChildWdbSyncLogBkp objects filtered by the sys_body column
 * @psalm-method Collection&\Traversable<ChildWdbSyncLogBkp> findBySysBody(string|array<string> $sys_body) Return ChildWdbSyncLogBkp objects filtered by the sys_body column
 * @method     ChildWdbSyncLogBkp[]|Collection findByUserId(int|array<int> $user_id) Return ChildWdbSyncLogBkp objects filtered by the user_id column
 * @psalm-method Collection&\Traversable<ChildWdbSyncLogBkp> findByUserId(int|array<int> $user_id) Return ChildWdbSyncLogBkp objects filtered by the user_id column
 * @method     ChildWdbSyncLogBkp[]|Collection findByTokenId(string|array<string> $token_id) Return ChildWdbSyncLogBkp objects filtered by the token_id column
 * @psalm-method Collection&\Traversable<ChildWdbSyncLogBkp> findByTokenId(string|array<string> $token_id) Return ChildWdbSyncLogBkp objects filtered by the token_id column
 * @method     ChildWdbSyncLogBkp[]|Collection findByDeviceInfo(string|array<string> $device_info) Return ChildWdbSyncLogBkp objects filtered by the device_info column
 * @psalm-method Collection&\Traversable<ChildWdbSyncLogBkp> findByDeviceInfo(string|array<string> $device_info) Return ChildWdbSyncLogBkp objects filtered by the device_info column
 * @method     ChildWdbSyncLogBkp[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildWdbSyncLogBkp objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildWdbSyncLogBkp> findByCompanyId(int|array<int> $company_id) Return ChildWdbSyncLogBkp objects filtered by the company_id column
 * @method     ChildWdbSyncLogBkp[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildWdbSyncLogBkp objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildWdbSyncLogBkp> findByCreatedAt(string|array<string> $created_at) Return ChildWdbSyncLogBkp objects filtered by the created_at column
 * @method     ChildWdbSyncLogBkp[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildWdbSyncLogBkp objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildWdbSyncLogBkp> findByUpdatedAt(string|array<string> $updated_at) Return ChildWdbSyncLogBkp objects filtered by the updated_at column
 * @method     ChildWdbSyncLogBkp[]|Collection findByWdbKey(string|array<string> $wdb_key) Return ChildWdbSyncLogBkp objects filtered by the wdb_key column
 * @psalm-method Collection&\Traversable<ChildWdbSyncLogBkp> findByWdbKey(string|array<string> $wdb_key) Return ChildWdbSyncLogBkp objects filtered by the wdb_key column
 * @method     ChildWdbSyncLogBkp[]|Collection findByNewpk(int|array<int> $newpk) Return ChildWdbSyncLogBkp objects filtered by the newpk column
 * @psalm-method Collection&\Traversable<ChildWdbSyncLogBkp> findByNewpk(int|array<int> $newpk) Return ChildWdbSyncLogBkp objects filtered by the newpk column
 * @method     ChildWdbSyncLogBkp[]|Collection findByResMessage(string|array<string> $res_message) Return ChildWdbSyncLogBkp objects filtered by the res_message column
 * @psalm-method Collection&\Traversable<ChildWdbSyncLogBkp> findByResMessage(string|array<string> $res_message) Return ChildWdbSyncLogBkp objects filtered by the res_message column
 * @method     ChildWdbSyncLogBkp[]|Collection findByDeviceTimestamp(int|array<int> $device_timestamp) Return ChildWdbSyncLogBkp objects filtered by the device_timestamp column
 * @psalm-method Collection&\Traversable<ChildWdbSyncLogBkp> findByDeviceTimestamp(int|array<int> $device_timestamp) Return ChildWdbSyncLogBkp objects filtered by the device_timestamp column
 *
 * @method     ChildWdbSyncLogBkp[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildWdbSyncLogBkp> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class WdbSyncLogBkpQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\WdbSyncLogBkpQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\WdbSyncLogBkp', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildWdbSyncLogBkpQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildWdbSyncLogBkpQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildWdbSyncLogBkpQuery) {
            return $criteria;
        }
        $query = new ChildWdbSyncLogBkpQuery();
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
     * @return ChildWdbSyncLogBkp|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        throw new LogicException('The WdbSyncLogBkp object has no primary key');
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
     * </code>
     * @param array $keys Primary keys to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return Collection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ?ConnectionInterface $con = null)
    {
        throw new LogicException('The WdbSyncLogBkp object has no primary key');
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
        throw new LogicException('The WdbSyncLogBkp object has no primary key');
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
        throw new LogicException('The WdbSyncLogBkp object has no primary key');
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
                $this->addUsingAlias(WdbSyncLogBkpTableMap::COL_WDB_ID, $wdbId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($wdbId['max'])) {
                $this->addUsingAlias(WdbSyncLogBkpTableMap::COL_WDB_ID, $wdbId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WdbSyncLogBkpTableMap::COL_WDB_ID, $wdbId, $comparison);

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

        $this->addUsingAlias(WdbSyncLogBkpTableMap::COL_SYS_TABLE, $sysTable, $comparison);

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

        $this->addUsingAlias(WdbSyncLogBkpTableMap::COL_SYS_OPERATION, $sysOperation, $comparison);

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

        $this->addUsingAlias(WdbSyncLogBkpTableMap::COL_SYS_BODY, $sysBody, $comparison);

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
                $this->addUsingAlias(WdbSyncLogBkpTableMap::COL_USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userId['max'])) {
                $this->addUsingAlias(WdbSyncLogBkpTableMap::COL_USER_ID, $userId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WdbSyncLogBkpTableMap::COL_USER_ID, $userId, $comparison);

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

        $this->addUsingAlias(WdbSyncLogBkpTableMap::COL_TOKEN_ID, $tokenId, $comparison);

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

        $this->addUsingAlias(WdbSyncLogBkpTableMap::COL_DEVICE_INFO, $deviceInfo, $comparison);

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
                $this->addUsingAlias(WdbSyncLogBkpTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(WdbSyncLogBkpTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WdbSyncLogBkpTableMap::COL_COMPANY_ID, $companyId, $comparison);

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
                $this->addUsingAlias(WdbSyncLogBkpTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(WdbSyncLogBkpTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WdbSyncLogBkpTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(WdbSyncLogBkpTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(WdbSyncLogBkpTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WdbSyncLogBkpTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

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

        $this->addUsingAlias(WdbSyncLogBkpTableMap::COL_WDB_KEY, $wdbKey, $comparison);

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
                $this->addUsingAlias(WdbSyncLogBkpTableMap::COL_NEWPK, $newpk['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($newpk['max'])) {
                $this->addUsingAlias(WdbSyncLogBkpTableMap::COL_NEWPK, $newpk['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WdbSyncLogBkpTableMap::COL_NEWPK, $newpk, $comparison);

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

        $this->addUsingAlias(WdbSyncLogBkpTableMap::COL_RES_MESSAGE, $resMessage, $comparison);

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
                $this->addUsingAlias(WdbSyncLogBkpTableMap::COL_DEVICE_TIMESTAMP, $deviceTimestamp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($deviceTimestamp['max'])) {
                $this->addUsingAlias(WdbSyncLogBkpTableMap::COL_DEVICE_TIMESTAMP, $deviceTimestamp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WdbSyncLogBkpTableMap::COL_DEVICE_TIMESTAMP, $deviceTimestamp, $comparison);

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildWdbSyncLogBkp $wdbSyncLogBkp Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($wdbSyncLogBkp = null)
    {
        if ($wdbSyncLogBkp) {
            throw new LogicException('WdbSyncLogBkp object has no primary key');

        }

        return $this;
    }

    /**
     * Deletes all rows from the wdb_sync_log_bkp table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(WdbSyncLogBkpTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            WdbSyncLogBkpTableMap::clearInstancePool();
            WdbSyncLogBkpTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(WdbSyncLogBkpTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(WdbSyncLogBkpTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            WdbSyncLogBkpTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            WdbSyncLogBkpTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
