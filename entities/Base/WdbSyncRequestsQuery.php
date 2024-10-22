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
use entities\WdbSyncRequests as ChildWdbSyncRequests;
use entities\WdbSyncRequestsQuery as ChildWdbSyncRequestsQuery;
use entities\Map\WdbSyncRequestsTableMap;

/**
 * Base class that represents a query for the `wdb_sync_requests` table.
 *
 * @method     ChildWdbSyncRequestsQuery orderBySyncId($order = Criteria::ASC) Order by the sync_id column
 * @method     ChildWdbSyncRequestsQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 * @method     ChildWdbSyncRequestsQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method     ChildWdbSyncRequestsQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildWdbSyncRequestsQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildWdbSyncRequestsQuery orderByS3Url($order = Criteria::ASC) Order by the s3_url column
 *
 * @method     ChildWdbSyncRequestsQuery groupBySyncId() Group by the sync_id column
 * @method     ChildWdbSyncRequestsQuery groupByUserId() Group by the user_id column
 * @method     ChildWdbSyncRequestsQuery groupByStatus() Group by the status column
 * @method     ChildWdbSyncRequestsQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildWdbSyncRequestsQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildWdbSyncRequestsQuery groupByS3Url() Group by the s3_url column
 *
 * @method     ChildWdbSyncRequestsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildWdbSyncRequestsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildWdbSyncRequestsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildWdbSyncRequestsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildWdbSyncRequestsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildWdbSyncRequestsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildWdbSyncRequests|null findOne(?ConnectionInterface $con = null) Return the first ChildWdbSyncRequests matching the query
 * @method     ChildWdbSyncRequests findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildWdbSyncRequests matching the query, or a new ChildWdbSyncRequests object populated from the query conditions when no match is found
 *
 * @method     ChildWdbSyncRequests|null findOneBySyncId(int $sync_id) Return the first ChildWdbSyncRequests filtered by the sync_id column
 * @method     ChildWdbSyncRequests|null findOneByUserId(int $user_id) Return the first ChildWdbSyncRequests filtered by the user_id column
 * @method     ChildWdbSyncRequests|null findOneByStatus(string $status) Return the first ChildWdbSyncRequests filtered by the status column
 * @method     ChildWdbSyncRequests|null findOneByCreatedAt(string $created_at) Return the first ChildWdbSyncRequests filtered by the created_at column
 * @method     ChildWdbSyncRequests|null findOneByUpdatedAt(string $updated_at) Return the first ChildWdbSyncRequests filtered by the updated_at column
 * @method     ChildWdbSyncRequests|null findOneByS3Url(string $s3_url) Return the first ChildWdbSyncRequests filtered by the s3_url column
 *
 * @method     ChildWdbSyncRequests requirePk($key, ?ConnectionInterface $con = null) Return the ChildWdbSyncRequests by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWdbSyncRequests requireOne(?ConnectionInterface $con = null) Return the first ChildWdbSyncRequests matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildWdbSyncRequests requireOneBySyncId(int $sync_id) Return the first ChildWdbSyncRequests filtered by the sync_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWdbSyncRequests requireOneByUserId(int $user_id) Return the first ChildWdbSyncRequests filtered by the user_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWdbSyncRequests requireOneByStatus(string $status) Return the first ChildWdbSyncRequests filtered by the status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWdbSyncRequests requireOneByCreatedAt(string $created_at) Return the first ChildWdbSyncRequests filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWdbSyncRequests requireOneByUpdatedAt(string $updated_at) Return the first ChildWdbSyncRequests filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWdbSyncRequests requireOneByS3Url(string $s3_url) Return the first ChildWdbSyncRequests filtered by the s3_url column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildWdbSyncRequests[]|Collection find(?ConnectionInterface $con = null) Return ChildWdbSyncRequests objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildWdbSyncRequests> find(?ConnectionInterface $con = null) Return ChildWdbSyncRequests objects based on current ModelCriteria
 *
 * @method     ChildWdbSyncRequests[]|Collection findBySyncId(int|array<int> $sync_id) Return ChildWdbSyncRequests objects filtered by the sync_id column
 * @psalm-method Collection&\Traversable<ChildWdbSyncRequests> findBySyncId(int|array<int> $sync_id) Return ChildWdbSyncRequests objects filtered by the sync_id column
 * @method     ChildWdbSyncRequests[]|Collection findByUserId(int|array<int> $user_id) Return ChildWdbSyncRequests objects filtered by the user_id column
 * @psalm-method Collection&\Traversable<ChildWdbSyncRequests> findByUserId(int|array<int> $user_id) Return ChildWdbSyncRequests objects filtered by the user_id column
 * @method     ChildWdbSyncRequests[]|Collection findByStatus(string|array<string> $status) Return ChildWdbSyncRequests objects filtered by the status column
 * @psalm-method Collection&\Traversable<ChildWdbSyncRequests> findByStatus(string|array<string> $status) Return ChildWdbSyncRequests objects filtered by the status column
 * @method     ChildWdbSyncRequests[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildWdbSyncRequests objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildWdbSyncRequests> findByCreatedAt(string|array<string> $created_at) Return ChildWdbSyncRequests objects filtered by the created_at column
 * @method     ChildWdbSyncRequests[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildWdbSyncRequests objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildWdbSyncRequests> findByUpdatedAt(string|array<string> $updated_at) Return ChildWdbSyncRequests objects filtered by the updated_at column
 * @method     ChildWdbSyncRequests[]|Collection findByS3Url(string|array<string> $s3_url) Return ChildWdbSyncRequests objects filtered by the s3_url column
 * @psalm-method Collection&\Traversable<ChildWdbSyncRequests> findByS3Url(string|array<string> $s3_url) Return ChildWdbSyncRequests objects filtered by the s3_url column
 *
 * @method     ChildWdbSyncRequests[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildWdbSyncRequests> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class WdbSyncRequestsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\WdbSyncRequestsQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\WdbSyncRequests', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildWdbSyncRequestsQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildWdbSyncRequestsQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildWdbSyncRequestsQuery) {
            return $criteria;
        }
        $query = new ChildWdbSyncRequestsQuery();
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
     * @return ChildWdbSyncRequests|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(WdbSyncRequestsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = WdbSyncRequestsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildWdbSyncRequests A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT sync_id, user_id, status, created_at, updated_at, s3_url FROM wdb_sync_requests WHERE sync_id = :p0';
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
            /** @var ChildWdbSyncRequests $obj */
            $obj = new ChildWdbSyncRequests();
            $obj->hydrate($row);
            WdbSyncRequestsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildWdbSyncRequests|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(WdbSyncRequestsTableMap::COL_SYNC_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(WdbSyncRequestsTableMap::COL_SYNC_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the sync_id column
     *
     * Example usage:
     * <code>
     * $query->filterBySyncId(1234); // WHERE sync_id = 1234
     * $query->filterBySyncId(array(12, 34)); // WHERE sync_id IN (12, 34)
     * $query->filterBySyncId(array('min' => 12)); // WHERE sync_id > 12
     * </code>
     *
     * @param mixed $syncId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySyncId($syncId = null, ?string $comparison = null)
    {
        if (is_array($syncId)) {
            $useMinMax = false;
            if (isset($syncId['min'])) {
                $this->addUsingAlias(WdbSyncRequestsTableMap::COL_SYNC_ID, $syncId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($syncId['max'])) {
                $this->addUsingAlias(WdbSyncRequestsTableMap::COL_SYNC_ID, $syncId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WdbSyncRequestsTableMap::COL_SYNC_ID, $syncId, $comparison);

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
                $this->addUsingAlias(WdbSyncRequestsTableMap::COL_USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userId['max'])) {
                $this->addUsingAlias(WdbSyncRequestsTableMap::COL_USER_ID, $userId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WdbSyncRequestsTableMap::COL_USER_ID, $userId, $comparison);

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

        $this->addUsingAlias(WdbSyncRequestsTableMap::COL_STATUS, $status, $comparison);

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
                $this->addUsingAlias(WdbSyncRequestsTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(WdbSyncRequestsTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WdbSyncRequestsTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(WdbSyncRequestsTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(WdbSyncRequestsTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WdbSyncRequestsTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the s3_url column
     *
     * Example usage:
     * <code>
     * $query->filterByS3Url('fooValue');   // WHERE s3_url = 'fooValue'
     * $query->filterByS3Url('%fooValue%', Criteria::LIKE); // WHERE s3_url LIKE '%fooValue%'
     * $query->filterByS3Url(['foo', 'bar']); // WHERE s3_url IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $s3Url The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByS3Url($s3Url = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($s3Url)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WdbSyncRequestsTableMap::COL_S3_URL, $s3Url, $comparison);

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildWdbSyncRequests $wdbSyncRequests Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($wdbSyncRequests = null)
    {
        if ($wdbSyncRequests) {
            $this->addUsingAlias(WdbSyncRequestsTableMap::COL_SYNC_ID, $wdbSyncRequests->getSyncId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the wdb_sync_requests table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(WdbSyncRequestsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            WdbSyncRequestsTableMap::clearInstancePool();
            WdbSyncRequestsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(WdbSyncRequestsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(WdbSyncRequestsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            WdbSyncRequestsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            WdbSyncRequestsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
