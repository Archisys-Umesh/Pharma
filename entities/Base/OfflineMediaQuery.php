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
use entities\OfflineMedia as ChildOfflineMedia;
use entities\OfflineMediaQuery as ChildOfflineMediaQuery;
use entities\Map\OfflineMediaTableMap;

/**
 * Base class that represents a query for the `offline_media` table.
 *
 * @method     ChildOfflineMediaQuery orderByOfflineMediaId($order = Criteria::ASC) Order by the offline_media_id column
 * @method     ChildOfflineMediaQuery orderByFileName($order = Criteria::ASC) Order by the file_name column
 * @method     ChildOfflineMediaQuery orderByFilePath($order = Criteria::ASC) Order by the file_path column
 * @method     ChildOfflineMediaQuery orderByModuleName($order = Criteria::ASC) Order by the module_name column
 * @method     ChildOfflineMediaQuery orderByModulePrimaryKey($order = Criteria::ASC) Order by the module_primary_key column
 * @method     ChildOfflineMediaQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildOfflineMediaQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildOfflineMediaQuery groupByOfflineMediaId() Group by the offline_media_id column
 * @method     ChildOfflineMediaQuery groupByFileName() Group by the file_name column
 * @method     ChildOfflineMediaQuery groupByFilePath() Group by the file_path column
 * @method     ChildOfflineMediaQuery groupByModuleName() Group by the module_name column
 * @method     ChildOfflineMediaQuery groupByModulePrimaryKey() Group by the module_primary_key column
 * @method     ChildOfflineMediaQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildOfflineMediaQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildOfflineMediaQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildOfflineMediaQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildOfflineMediaQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildOfflineMediaQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildOfflineMediaQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildOfflineMediaQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildOfflineMedia|null findOne(?ConnectionInterface $con = null) Return the first ChildOfflineMedia matching the query
 * @method     ChildOfflineMedia findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildOfflineMedia matching the query, or a new ChildOfflineMedia object populated from the query conditions when no match is found
 *
 * @method     ChildOfflineMedia|null findOneByOfflineMediaId(int $offline_media_id) Return the first ChildOfflineMedia filtered by the offline_media_id column
 * @method     ChildOfflineMedia|null findOneByFileName(string $file_name) Return the first ChildOfflineMedia filtered by the file_name column
 * @method     ChildOfflineMedia|null findOneByFilePath(string $file_path) Return the first ChildOfflineMedia filtered by the file_path column
 * @method     ChildOfflineMedia|null findOneByModuleName(string $module_name) Return the first ChildOfflineMedia filtered by the module_name column
 * @method     ChildOfflineMedia|null findOneByModulePrimaryKey(int $module_primary_key) Return the first ChildOfflineMedia filtered by the module_primary_key column
 * @method     ChildOfflineMedia|null findOneByCreatedAt(string $created_at) Return the first ChildOfflineMedia filtered by the created_at column
 * @method     ChildOfflineMedia|null findOneByUpdatedAt(string $updated_at) Return the first ChildOfflineMedia filtered by the updated_at column
 *
 * @method     ChildOfflineMedia requirePk($key, ?ConnectionInterface $con = null) Return the ChildOfflineMedia by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOfflineMedia requireOne(?ConnectionInterface $con = null) Return the first ChildOfflineMedia matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOfflineMedia requireOneByOfflineMediaId(int $offline_media_id) Return the first ChildOfflineMedia filtered by the offline_media_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOfflineMedia requireOneByFileName(string $file_name) Return the first ChildOfflineMedia filtered by the file_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOfflineMedia requireOneByFilePath(string $file_path) Return the first ChildOfflineMedia filtered by the file_path column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOfflineMedia requireOneByModuleName(string $module_name) Return the first ChildOfflineMedia filtered by the module_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOfflineMedia requireOneByModulePrimaryKey(int $module_primary_key) Return the first ChildOfflineMedia filtered by the module_primary_key column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOfflineMedia requireOneByCreatedAt(string $created_at) Return the first ChildOfflineMedia filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOfflineMedia requireOneByUpdatedAt(string $updated_at) Return the first ChildOfflineMedia filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOfflineMedia[]|Collection find(?ConnectionInterface $con = null) Return ChildOfflineMedia objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildOfflineMedia> find(?ConnectionInterface $con = null) Return ChildOfflineMedia objects based on current ModelCriteria
 *
 * @method     ChildOfflineMedia[]|Collection findByOfflineMediaId(int|array<int> $offline_media_id) Return ChildOfflineMedia objects filtered by the offline_media_id column
 * @psalm-method Collection&\Traversable<ChildOfflineMedia> findByOfflineMediaId(int|array<int> $offline_media_id) Return ChildOfflineMedia objects filtered by the offline_media_id column
 * @method     ChildOfflineMedia[]|Collection findByFileName(string|array<string> $file_name) Return ChildOfflineMedia objects filtered by the file_name column
 * @psalm-method Collection&\Traversable<ChildOfflineMedia> findByFileName(string|array<string> $file_name) Return ChildOfflineMedia objects filtered by the file_name column
 * @method     ChildOfflineMedia[]|Collection findByFilePath(string|array<string> $file_path) Return ChildOfflineMedia objects filtered by the file_path column
 * @psalm-method Collection&\Traversable<ChildOfflineMedia> findByFilePath(string|array<string> $file_path) Return ChildOfflineMedia objects filtered by the file_path column
 * @method     ChildOfflineMedia[]|Collection findByModuleName(string|array<string> $module_name) Return ChildOfflineMedia objects filtered by the module_name column
 * @psalm-method Collection&\Traversable<ChildOfflineMedia> findByModuleName(string|array<string> $module_name) Return ChildOfflineMedia objects filtered by the module_name column
 * @method     ChildOfflineMedia[]|Collection findByModulePrimaryKey(int|array<int> $module_primary_key) Return ChildOfflineMedia objects filtered by the module_primary_key column
 * @psalm-method Collection&\Traversable<ChildOfflineMedia> findByModulePrimaryKey(int|array<int> $module_primary_key) Return ChildOfflineMedia objects filtered by the module_primary_key column
 * @method     ChildOfflineMedia[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildOfflineMedia objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildOfflineMedia> findByCreatedAt(string|array<string> $created_at) Return ChildOfflineMedia objects filtered by the created_at column
 * @method     ChildOfflineMedia[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildOfflineMedia objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildOfflineMedia> findByUpdatedAt(string|array<string> $updated_at) Return ChildOfflineMedia objects filtered by the updated_at column
 *
 * @method     ChildOfflineMedia[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildOfflineMedia> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class OfflineMediaQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\OfflineMediaQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\OfflineMedia', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildOfflineMediaQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildOfflineMediaQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildOfflineMediaQuery) {
            return $criteria;
        }
        $query = new ChildOfflineMediaQuery();
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
     * @return ChildOfflineMedia|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(OfflineMediaTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = OfflineMediaTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildOfflineMedia A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT offline_media_id, file_name, file_path, module_name, module_primary_key, created_at, updated_at FROM offline_media WHERE offline_media_id = :p0';
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
            /** @var ChildOfflineMedia $obj */
            $obj = new ChildOfflineMedia();
            $obj->hydrate($row);
            OfflineMediaTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildOfflineMedia|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(OfflineMediaTableMap::COL_OFFLINE_MEDIA_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(OfflineMediaTableMap::COL_OFFLINE_MEDIA_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the offline_media_id column
     *
     * Example usage:
     * <code>
     * $query->filterByOfflineMediaId(1234); // WHERE offline_media_id = 1234
     * $query->filterByOfflineMediaId(array(12, 34)); // WHERE offline_media_id IN (12, 34)
     * $query->filterByOfflineMediaId(array('min' => 12)); // WHERE offline_media_id > 12
     * </code>
     *
     * @param mixed $offlineMediaId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOfflineMediaId($offlineMediaId = null, ?string $comparison = null)
    {
        if (is_array($offlineMediaId)) {
            $useMinMax = false;
            if (isset($offlineMediaId['min'])) {
                $this->addUsingAlias(OfflineMediaTableMap::COL_OFFLINE_MEDIA_ID, $offlineMediaId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($offlineMediaId['max'])) {
                $this->addUsingAlias(OfflineMediaTableMap::COL_OFFLINE_MEDIA_ID, $offlineMediaId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OfflineMediaTableMap::COL_OFFLINE_MEDIA_ID, $offlineMediaId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the file_name column
     *
     * Example usage:
     * <code>
     * $query->filterByFileName('fooValue');   // WHERE file_name = 'fooValue'
     * $query->filterByFileName('%fooValue%', Criteria::LIKE); // WHERE file_name LIKE '%fooValue%'
     * $query->filterByFileName(['foo', 'bar']); // WHERE file_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $fileName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFileName($fileName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fileName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OfflineMediaTableMap::COL_FILE_NAME, $fileName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the file_path column
     *
     * Example usage:
     * <code>
     * $query->filterByFilePath('fooValue');   // WHERE file_path = 'fooValue'
     * $query->filterByFilePath('%fooValue%', Criteria::LIKE); // WHERE file_path LIKE '%fooValue%'
     * $query->filterByFilePath(['foo', 'bar']); // WHERE file_path IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $filePath The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFilePath($filePath = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($filePath)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OfflineMediaTableMap::COL_FILE_PATH, $filePath, $comparison);

        return $this;
    }

    /**
     * Filter the query on the module_name column
     *
     * Example usage:
     * <code>
     * $query->filterByModuleName('fooValue');   // WHERE module_name = 'fooValue'
     * $query->filterByModuleName('%fooValue%', Criteria::LIKE); // WHERE module_name LIKE '%fooValue%'
     * $query->filterByModuleName(['foo', 'bar']); // WHERE module_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $moduleName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByModuleName($moduleName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($moduleName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OfflineMediaTableMap::COL_MODULE_NAME, $moduleName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the module_primary_key column
     *
     * Example usage:
     * <code>
     * $query->filterByModulePrimaryKey(1234); // WHERE module_primary_key = 1234
     * $query->filterByModulePrimaryKey(array(12, 34)); // WHERE module_primary_key IN (12, 34)
     * $query->filterByModulePrimaryKey(array('min' => 12)); // WHERE module_primary_key > 12
     * </code>
     *
     * @param mixed $modulePrimaryKey The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByModulePrimaryKey($modulePrimaryKey = null, ?string $comparison = null)
    {
        if (is_array($modulePrimaryKey)) {
            $useMinMax = false;
            if (isset($modulePrimaryKey['min'])) {
                $this->addUsingAlias(OfflineMediaTableMap::COL_MODULE_PRIMARY_KEY, $modulePrimaryKey['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($modulePrimaryKey['max'])) {
                $this->addUsingAlias(OfflineMediaTableMap::COL_MODULE_PRIMARY_KEY, $modulePrimaryKey['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OfflineMediaTableMap::COL_MODULE_PRIMARY_KEY, $modulePrimaryKey, $comparison);

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
                $this->addUsingAlias(OfflineMediaTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(OfflineMediaTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OfflineMediaTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(OfflineMediaTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(OfflineMediaTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OfflineMediaTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildOfflineMedia $offlineMedia Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($offlineMedia = null)
    {
        if ($offlineMedia) {
            $this->addUsingAlias(OfflineMediaTableMap::COL_OFFLINE_MEDIA_ID, $offlineMedia->getOfflineMediaId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the offline_media table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OfflineMediaTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            OfflineMediaTableMap::clearInstancePool();
            OfflineMediaTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(OfflineMediaTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(OfflineMediaTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            OfflineMediaTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            OfflineMediaTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
