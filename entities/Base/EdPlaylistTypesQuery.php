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
use entities\EdPlaylistTypes as ChildEdPlaylistTypes;
use entities\EdPlaylistTypesQuery as ChildEdPlaylistTypesQuery;
use entities\Map\EdPlaylistTypesTableMap;

/**
 * Base class that represents a query for the `ed_playlist_types` table.
 *
 * @method     ChildEdPlaylistTypesQuery orderByEdPlaylistTypeId($order = Criteria::ASC) Order by the ed_playlist_type_id column
 * @method     ChildEdPlaylistTypesQuery orderByPlaylistTypeName($order = Criteria::ASC) Order by the playlist_type_name column
 * @method     ChildEdPlaylistTypesQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildEdPlaylistTypesQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildEdPlaylistTypesQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildEdPlaylistTypesQuery groupByEdPlaylistTypeId() Group by the ed_playlist_type_id column
 * @method     ChildEdPlaylistTypesQuery groupByPlaylistTypeName() Group by the playlist_type_name column
 * @method     ChildEdPlaylistTypesQuery groupByCompanyId() Group by the company_id column
 * @method     ChildEdPlaylistTypesQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildEdPlaylistTypesQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildEdPlaylistTypesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildEdPlaylistTypesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildEdPlaylistTypesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildEdPlaylistTypesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildEdPlaylistTypesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildEdPlaylistTypesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildEdPlaylistTypes|null findOne(?ConnectionInterface $con = null) Return the first ChildEdPlaylistTypes matching the query
 * @method     ChildEdPlaylistTypes findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildEdPlaylistTypes matching the query, or a new ChildEdPlaylistTypes object populated from the query conditions when no match is found
 *
 * @method     ChildEdPlaylistTypes|null findOneByEdPlaylistTypeId(int $ed_playlist_type_id) Return the first ChildEdPlaylistTypes filtered by the ed_playlist_type_id column
 * @method     ChildEdPlaylistTypes|null findOneByPlaylistTypeName(string $playlist_type_name) Return the first ChildEdPlaylistTypes filtered by the playlist_type_name column
 * @method     ChildEdPlaylistTypes|null findOneByCompanyId(int $company_id) Return the first ChildEdPlaylistTypes filtered by the company_id column
 * @method     ChildEdPlaylistTypes|null findOneByCreatedAt(string $created_at) Return the first ChildEdPlaylistTypes filtered by the created_at column
 * @method     ChildEdPlaylistTypes|null findOneByUpdatedAt(string $updated_at) Return the first ChildEdPlaylistTypes filtered by the updated_at column
 *
 * @method     ChildEdPlaylistTypes requirePk($key, ?ConnectionInterface $con = null) Return the ChildEdPlaylistTypes by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEdPlaylistTypes requireOne(?ConnectionInterface $con = null) Return the first ChildEdPlaylistTypes matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEdPlaylistTypes requireOneByEdPlaylistTypeId(int $ed_playlist_type_id) Return the first ChildEdPlaylistTypes filtered by the ed_playlist_type_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEdPlaylistTypes requireOneByPlaylistTypeName(string $playlist_type_name) Return the first ChildEdPlaylistTypes filtered by the playlist_type_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEdPlaylistTypes requireOneByCompanyId(int $company_id) Return the first ChildEdPlaylistTypes filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEdPlaylistTypes requireOneByCreatedAt(string $created_at) Return the first ChildEdPlaylistTypes filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEdPlaylistTypes requireOneByUpdatedAt(string $updated_at) Return the first ChildEdPlaylistTypes filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEdPlaylistTypes[]|Collection find(?ConnectionInterface $con = null) Return ChildEdPlaylistTypes objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildEdPlaylistTypes> find(?ConnectionInterface $con = null) Return ChildEdPlaylistTypes objects based on current ModelCriteria
 *
 * @method     ChildEdPlaylistTypes[]|Collection findByEdPlaylistTypeId(int|array<int> $ed_playlist_type_id) Return ChildEdPlaylistTypes objects filtered by the ed_playlist_type_id column
 * @psalm-method Collection&\Traversable<ChildEdPlaylistTypes> findByEdPlaylistTypeId(int|array<int> $ed_playlist_type_id) Return ChildEdPlaylistTypes objects filtered by the ed_playlist_type_id column
 * @method     ChildEdPlaylistTypes[]|Collection findByPlaylistTypeName(string|array<string> $playlist_type_name) Return ChildEdPlaylistTypes objects filtered by the playlist_type_name column
 * @psalm-method Collection&\Traversable<ChildEdPlaylistTypes> findByPlaylistTypeName(string|array<string> $playlist_type_name) Return ChildEdPlaylistTypes objects filtered by the playlist_type_name column
 * @method     ChildEdPlaylistTypes[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildEdPlaylistTypes objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildEdPlaylistTypes> findByCompanyId(int|array<int> $company_id) Return ChildEdPlaylistTypes objects filtered by the company_id column
 * @method     ChildEdPlaylistTypes[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildEdPlaylistTypes objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildEdPlaylistTypes> findByCreatedAt(string|array<string> $created_at) Return ChildEdPlaylistTypes objects filtered by the created_at column
 * @method     ChildEdPlaylistTypes[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildEdPlaylistTypes objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildEdPlaylistTypes> findByUpdatedAt(string|array<string> $updated_at) Return ChildEdPlaylistTypes objects filtered by the updated_at column
 *
 * @method     ChildEdPlaylistTypes[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildEdPlaylistTypes> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class EdPlaylistTypesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\EdPlaylistTypesQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\EdPlaylistTypes', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildEdPlaylistTypesQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildEdPlaylistTypesQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildEdPlaylistTypesQuery) {
            return $criteria;
        }
        $query = new ChildEdPlaylistTypesQuery();
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
     * @return ChildEdPlaylistTypes|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(EdPlaylistTypesTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = EdPlaylistTypesTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildEdPlaylistTypes A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT ed_playlist_type_id, playlist_type_name, company_id, created_at, updated_at FROM ed_playlist_types WHERE ed_playlist_type_id = :p0';
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
            /** @var ChildEdPlaylistTypes $obj */
            $obj = new ChildEdPlaylistTypes();
            $obj->hydrate($row);
            EdPlaylistTypesTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildEdPlaylistTypes|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(EdPlaylistTypesTableMap::COL_ED_PLAYLIST_TYPE_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(EdPlaylistTypesTableMap::COL_ED_PLAYLIST_TYPE_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the ed_playlist_type_id column
     *
     * Example usage:
     * <code>
     * $query->filterByEdPlaylistTypeId(1234); // WHERE ed_playlist_type_id = 1234
     * $query->filterByEdPlaylistTypeId(array(12, 34)); // WHERE ed_playlist_type_id IN (12, 34)
     * $query->filterByEdPlaylistTypeId(array('min' => 12)); // WHERE ed_playlist_type_id > 12
     * </code>
     *
     * @param mixed $edPlaylistTypeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEdPlaylistTypeId($edPlaylistTypeId = null, ?string $comparison = null)
    {
        if (is_array($edPlaylistTypeId)) {
            $useMinMax = false;
            if (isset($edPlaylistTypeId['min'])) {
                $this->addUsingAlias(EdPlaylistTypesTableMap::COL_ED_PLAYLIST_TYPE_ID, $edPlaylistTypeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($edPlaylistTypeId['max'])) {
                $this->addUsingAlias(EdPlaylistTypesTableMap::COL_ED_PLAYLIST_TYPE_ID, $edPlaylistTypeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EdPlaylistTypesTableMap::COL_ED_PLAYLIST_TYPE_ID, $edPlaylistTypeId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the playlist_type_name column
     *
     * Example usage:
     * <code>
     * $query->filterByPlaylistTypeName('fooValue');   // WHERE playlist_type_name = 'fooValue'
     * $query->filterByPlaylistTypeName('%fooValue%', Criteria::LIKE); // WHERE playlist_type_name LIKE '%fooValue%'
     * $query->filterByPlaylistTypeName(['foo', 'bar']); // WHERE playlist_type_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $playlistTypeName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPlaylistTypeName($playlistTypeName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($playlistTypeName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EdPlaylistTypesTableMap::COL_PLAYLIST_TYPE_NAME, $playlistTypeName, $comparison);

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
                $this->addUsingAlias(EdPlaylistTypesTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(EdPlaylistTypesTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EdPlaylistTypesTableMap::COL_COMPANY_ID, $companyId, $comparison);

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
                $this->addUsingAlias(EdPlaylistTypesTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(EdPlaylistTypesTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EdPlaylistTypesTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(EdPlaylistTypesTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(EdPlaylistTypesTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EdPlaylistTypesTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildEdPlaylistTypes $edPlaylistTypes Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($edPlaylistTypes = null)
    {
        if ($edPlaylistTypes) {
            $this->addUsingAlias(EdPlaylistTypesTableMap::COL_ED_PLAYLIST_TYPE_ID, $edPlaylistTypes->getEdPlaylistTypeId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the ed_playlist_types table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EdPlaylistTypesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            EdPlaylistTypesTableMap::clearInstancePool();
            EdPlaylistTypesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(EdPlaylistTypesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(EdPlaylistTypesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            EdPlaylistTypesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            EdPlaylistTypesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
