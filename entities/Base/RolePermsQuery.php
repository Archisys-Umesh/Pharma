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
use entities\RolePerms as ChildRolePerms;
use entities\RolePermsQuery as ChildRolePermsQuery;
use entities\Map\RolePermsTableMap;

/**
 * Base class that represents a query for the `role_perms` table.
 *
 * @method     ChildRolePermsQuery orderByPermId($order = Criteria::ASC) Order by the perm_id column
 * @method     ChildRolePermsQuery orderByPermKey($order = Criteria::ASC) Order by the perm_key column
 * @method     ChildRolePermsQuery orderByPermDesc($order = Criteria::ASC) Order by the perm_desc column
 * @method     ChildRolePermsQuery orderByPermGroup($order = Criteria::ASC) Order by the perm_group column
 *
 * @method     ChildRolePermsQuery groupByPermId() Group by the perm_id column
 * @method     ChildRolePermsQuery groupByPermKey() Group by the perm_key column
 * @method     ChildRolePermsQuery groupByPermDesc() Group by the perm_desc column
 * @method     ChildRolePermsQuery groupByPermGroup() Group by the perm_group column
 *
 * @method     ChildRolePermsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildRolePermsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildRolePermsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildRolePermsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildRolePermsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildRolePermsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildRolePerms|null findOne(?ConnectionInterface $con = null) Return the first ChildRolePerms matching the query
 * @method     ChildRolePerms findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildRolePerms matching the query, or a new ChildRolePerms object populated from the query conditions when no match is found
 *
 * @method     ChildRolePerms|null findOneByPermId(int $perm_id) Return the first ChildRolePerms filtered by the perm_id column
 * @method     ChildRolePerms|null findOneByPermKey(string $perm_key) Return the first ChildRolePerms filtered by the perm_key column
 * @method     ChildRolePerms|null findOneByPermDesc(string $perm_desc) Return the first ChildRolePerms filtered by the perm_desc column
 * @method     ChildRolePerms|null findOneByPermGroup(string $perm_group) Return the first ChildRolePerms filtered by the perm_group column
 *
 * @method     ChildRolePerms requirePk($key, ?ConnectionInterface $con = null) Return the ChildRolePerms by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRolePerms requireOne(?ConnectionInterface $con = null) Return the first ChildRolePerms matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildRolePerms requireOneByPermId(int $perm_id) Return the first ChildRolePerms filtered by the perm_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRolePerms requireOneByPermKey(string $perm_key) Return the first ChildRolePerms filtered by the perm_key column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRolePerms requireOneByPermDesc(string $perm_desc) Return the first ChildRolePerms filtered by the perm_desc column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRolePerms requireOneByPermGroup(string $perm_group) Return the first ChildRolePerms filtered by the perm_group column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildRolePerms[]|Collection find(?ConnectionInterface $con = null) Return ChildRolePerms objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildRolePerms> find(?ConnectionInterface $con = null) Return ChildRolePerms objects based on current ModelCriteria
 *
 * @method     ChildRolePerms[]|Collection findByPermId(int|array<int> $perm_id) Return ChildRolePerms objects filtered by the perm_id column
 * @psalm-method Collection&\Traversable<ChildRolePerms> findByPermId(int|array<int> $perm_id) Return ChildRolePerms objects filtered by the perm_id column
 * @method     ChildRolePerms[]|Collection findByPermKey(string|array<string> $perm_key) Return ChildRolePerms objects filtered by the perm_key column
 * @psalm-method Collection&\Traversable<ChildRolePerms> findByPermKey(string|array<string> $perm_key) Return ChildRolePerms objects filtered by the perm_key column
 * @method     ChildRolePerms[]|Collection findByPermDesc(string|array<string> $perm_desc) Return ChildRolePerms objects filtered by the perm_desc column
 * @psalm-method Collection&\Traversable<ChildRolePerms> findByPermDesc(string|array<string> $perm_desc) Return ChildRolePerms objects filtered by the perm_desc column
 * @method     ChildRolePerms[]|Collection findByPermGroup(string|array<string> $perm_group) Return ChildRolePerms objects filtered by the perm_group column
 * @psalm-method Collection&\Traversable<ChildRolePerms> findByPermGroup(string|array<string> $perm_group) Return ChildRolePerms objects filtered by the perm_group column
 *
 * @method     ChildRolePerms[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildRolePerms> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class RolePermsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\RolePermsQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\RolePerms', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildRolePermsQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildRolePermsQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildRolePermsQuery) {
            return $criteria;
        }
        $query = new ChildRolePermsQuery();
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
     * @return ChildRolePerms|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(RolePermsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = RolePermsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildRolePerms A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT perm_id, perm_key, perm_desc, perm_group FROM role_perms WHERE perm_id = :p0';
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
            /** @var ChildRolePerms $obj */
            $obj = new ChildRolePerms();
            $obj->hydrate($row);
            RolePermsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildRolePerms|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(RolePermsTableMap::COL_PERM_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(RolePermsTableMap::COL_PERM_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the perm_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPermId(1234); // WHERE perm_id = 1234
     * $query->filterByPermId(array(12, 34)); // WHERE perm_id IN (12, 34)
     * $query->filterByPermId(array('min' => 12)); // WHERE perm_id > 12
     * </code>
     *
     * @param mixed $permId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPermId($permId = null, ?string $comparison = null)
    {
        if (is_array($permId)) {
            $useMinMax = false;
            if (isset($permId['min'])) {
                $this->addUsingAlias(RolePermsTableMap::COL_PERM_ID, $permId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($permId['max'])) {
                $this->addUsingAlias(RolePermsTableMap::COL_PERM_ID, $permId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(RolePermsTableMap::COL_PERM_ID, $permId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the perm_key column
     *
     * Example usage:
     * <code>
     * $query->filterByPermKey('fooValue');   // WHERE perm_key = 'fooValue'
     * $query->filterByPermKey('%fooValue%', Criteria::LIKE); // WHERE perm_key LIKE '%fooValue%'
     * $query->filterByPermKey(['foo', 'bar']); // WHERE perm_key IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $permKey The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPermKey($permKey = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($permKey)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(RolePermsTableMap::COL_PERM_KEY, $permKey, $comparison);

        return $this;
    }

    /**
     * Filter the query on the perm_desc column
     *
     * Example usage:
     * <code>
     * $query->filterByPermDesc('fooValue');   // WHERE perm_desc = 'fooValue'
     * $query->filterByPermDesc('%fooValue%', Criteria::LIKE); // WHERE perm_desc LIKE '%fooValue%'
     * $query->filterByPermDesc(['foo', 'bar']); // WHERE perm_desc IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $permDesc The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPermDesc($permDesc = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($permDesc)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(RolePermsTableMap::COL_PERM_DESC, $permDesc, $comparison);

        return $this;
    }

    /**
     * Filter the query on the perm_group column
     *
     * Example usage:
     * <code>
     * $query->filterByPermGroup('fooValue');   // WHERE perm_group = 'fooValue'
     * $query->filterByPermGroup('%fooValue%', Criteria::LIKE); // WHERE perm_group LIKE '%fooValue%'
     * $query->filterByPermGroup(['foo', 'bar']); // WHERE perm_group IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $permGroup The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPermGroup($permGroup = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($permGroup)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(RolePermsTableMap::COL_PERM_GROUP, $permGroup, $comparison);

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildRolePerms $rolePerms Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($rolePerms = null)
    {
        if ($rolePerms) {
            $this->addUsingAlias(RolePermsTableMap::COL_PERM_ID, $rolePerms->getPermId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the role_perms table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(RolePermsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            RolePermsTableMap::clearInstancePool();
            RolePermsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(RolePermsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(RolePermsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            RolePermsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            RolePermsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
