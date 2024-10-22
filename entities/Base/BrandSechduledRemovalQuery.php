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
use entities\BrandSechduledRemoval as ChildBrandSechduledRemoval;
use entities\BrandSechduledRemovalQuery as ChildBrandSechduledRemovalQuery;
use entities\Map\BrandSechduledRemovalTableMap;

/**
 * Base class that represents a query for the `brand_sechduled_removal` table.
 *
 * @method     ChildBrandSechduledRemovalQuery orderByRemovalId($order = Criteria::ASC) Order by the removal_id column
 * @method     ChildBrandSechduledRemovalQuery orderByRemoveBrandId($order = Criteria::ASC) Order by the remove_brand_id column
 * @method     ChildBrandSechduledRemovalQuery orderByMergeBrandId($order = Criteria::ASC) Order by the merge_brand_id column
 *
 * @method     ChildBrandSechduledRemovalQuery groupByRemovalId() Group by the removal_id column
 * @method     ChildBrandSechduledRemovalQuery groupByRemoveBrandId() Group by the remove_brand_id column
 * @method     ChildBrandSechduledRemovalQuery groupByMergeBrandId() Group by the merge_brand_id column
 *
 * @method     ChildBrandSechduledRemovalQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildBrandSechduledRemovalQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildBrandSechduledRemovalQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildBrandSechduledRemovalQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildBrandSechduledRemovalQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildBrandSechduledRemovalQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildBrandSechduledRemoval|null findOne(?ConnectionInterface $con = null) Return the first ChildBrandSechduledRemoval matching the query
 * @method     ChildBrandSechduledRemoval findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildBrandSechduledRemoval matching the query, or a new ChildBrandSechduledRemoval object populated from the query conditions when no match is found
 *
 * @method     ChildBrandSechduledRemoval|null findOneByRemovalId(int $removal_id) Return the first ChildBrandSechduledRemoval filtered by the removal_id column
 * @method     ChildBrandSechduledRemoval|null findOneByRemoveBrandId(int $remove_brand_id) Return the first ChildBrandSechduledRemoval filtered by the remove_brand_id column
 * @method     ChildBrandSechduledRemoval|null findOneByMergeBrandId(int $merge_brand_id) Return the first ChildBrandSechduledRemoval filtered by the merge_brand_id column
 *
 * @method     ChildBrandSechduledRemoval requirePk($key, ?ConnectionInterface $con = null) Return the ChildBrandSechduledRemoval by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandSechduledRemoval requireOne(?ConnectionInterface $con = null) Return the first ChildBrandSechduledRemoval matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBrandSechduledRemoval requireOneByRemovalId(int $removal_id) Return the first ChildBrandSechduledRemoval filtered by the removal_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandSechduledRemoval requireOneByRemoveBrandId(int $remove_brand_id) Return the first ChildBrandSechduledRemoval filtered by the remove_brand_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandSechduledRemoval requireOneByMergeBrandId(int $merge_brand_id) Return the first ChildBrandSechduledRemoval filtered by the merge_brand_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBrandSechduledRemoval[]|Collection find(?ConnectionInterface $con = null) Return ChildBrandSechduledRemoval objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildBrandSechduledRemoval> find(?ConnectionInterface $con = null) Return ChildBrandSechduledRemoval objects based on current ModelCriteria
 *
 * @method     ChildBrandSechduledRemoval[]|Collection findByRemovalId(int|array<int> $removal_id) Return ChildBrandSechduledRemoval objects filtered by the removal_id column
 * @psalm-method Collection&\Traversable<ChildBrandSechduledRemoval> findByRemovalId(int|array<int> $removal_id) Return ChildBrandSechduledRemoval objects filtered by the removal_id column
 * @method     ChildBrandSechduledRemoval[]|Collection findByRemoveBrandId(int|array<int> $remove_brand_id) Return ChildBrandSechduledRemoval objects filtered by the remove_brand_id column
 * @psalm-method Collection&\Traversable<ChildBrandSechduledRemoval> findByRemoveBrandId(int|array<int> $remove_brand_id) Return ChildBrandSechduledRemoval objects filtered by the remove_brand_id column
 * @method     ChildBrandSechduledRemoval[]|Collection findByMergeBrandId(int|array<int> $merge_brand_id) Return ChildBrandSechduledRemoval objects filtered by the merge_brand_id column
 * @psalm-method Collection&\Traversable<ChildBrandSechduledRemoval> findByMergeBrandId(int|array<int> $merge_brand_id) Return ChildBrandSechduledRemoval objects filtered by the merge_brand_id column
 *
 * @method     ChildBrandSechduledRemoval[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildBrandSechduledRemoval> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class BrandSechduledRemovalQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\BrandSechduledRemovalQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\BrandSechduledRemoval', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildBrandSechduledRemovalQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildBrandSechduledRemovalQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildBrandSechduledRemovalQuery) {
            return $criteria;
        }
        $query = new ChildBrandSechduledRemovalQuery();
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
     * @return ChildBrandSechduledRemoval|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(BrandSechduledRemovalTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = BrandSechduledRemovalTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildBrandSechduledRemoval A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT removal_id, remove_brand_id, merge_brand_id FROM brand_sechduled_removal WHERE removal_id = :p0';
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
            /** @var ChildBrandSechduledRemoval $obj */
            $obj = new ChildBrandSechduledRemoval();
            $obj->hydrate($row);
            BrandSechduledRemovalTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildBrandSechduledRemoval|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(BrandSechduledRemovalTableMap::COL_REMOVAL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(BrandSechduledRemovalTableMap::COL_REMOVAL_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the removal_id column
     *
     * Example usage:
     * <code>
     * $query->filterByRemovalId(1234); // WHERE removal_id = 1234
     * $query->filterByRemovalId(array(12, 34)); // WHERE removal_id IN (12, 34)
     * $query->filterByRemovalId(array('min' => 12)); // WHERE removal_id > 12
     * </code>
     *
     * @param mixed $removalId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRemovalId($removalId = null, ?string $comparison = null)
    {
        if (is_array($removalId)) {
            $useMinMax = false;
            if (isset($removalId['min'])) {
                $this->addUsingAlias(BrandSechduledRemovalTableMap::COL_REMOVAL_ID, $removalId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($removalId['max'])) {
                $this->addUsingAlias(BrandSechduledRemovalTableMap::COL_REMOVAL_ID, $removalId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandSechduledRemovalTableMap::COL_REMOVAL_ID, $removalId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the remove_brand_id column
     *
     * Example usage:
     * <code>
     * $query->filterByRemoveBrandId(1234); // WHERE remove_brand_id = 1234
     * $query->filterByRemoveBrandId(array(12, 34)); // WHERE remove_brand_id IN (12, 34)
     * $query->filterByRemoveBrandId(array('min' => 12)); // WHERE remove_brand_id > 12
     * </code>
     *
     * @param mixed $removeBrandId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRemoveBrandId($removeBrandId = null, ?string $comparison = null)
    {
        if (is_array($removeBrandId)) {
            $useMinMax = false;
            if (isset($removeBrandId['min'])) {
                $this->addUsingAlias(BrandSechduledRemovalTableMap::COL_REMOVE_BRAND_ID, $removeBrandId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($removeBrandId['max'])) {
                $this->addUsingAlias(BrandSechduledRemovalTableMap::COL_REMOVE_BRAND_ID, $removeBrandId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandSechduledRemovalTableMap::COL_REMOVE_BRAND_ID, $removeBrandId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the merge_brand_id column
     *
     * Example usage:
     * <code>
     * $query->filterByMergeBrandId(1234); // WHERE merge_brand_id = 1234
     * $query->filterByMergeBrandId(array(12, 34)); // WHERE merge_brand_id IN (12, 34)
     * $query->filterByMergeBrandId(array('min' => 12)); // WHERE merge_brand_id > 12
     * </code>
     *
     * @param mixed $mergeBrandId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMergeBrandId($mergeBrandId = null, ?string $comparison = null)
    {
        if (is_array($mergeBrandId)) {
            $useMinMax = false;
            if (isset($mergeBrandId['min'])) {
                $this->addUsingAlias(BrandSechduledRemovalTableMap::COL_MERGE_BRAND_ID, $mergeBrandId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($mergeBrandId['max'])) {
                $this->addUsingAlias(BrandSechduledRemovalTableMap::COL_MERGE_BRAND_ID, $mergeBrandId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandSechduledRemovalTableMap::COL_MERGE_BRAND_ID, $mergeBrandId, $comparison);

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildBrandSechduledRemoval $brandSechduledRemoval Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($brandSechduledRemoval = null)
    {
        if ($brandSechduledRemoval) {
            $this->addUsingAlias(BrandSechduledRemovalTableMap::COL_REMOVAL_ID, $brandSechduledRemoval->getRemovalId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the brand_sechduled_removal table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(BrandSechduledRemovalTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            BrandSechduledRemovalTableMap::clearInstancePool();
            BrandSechduledRemovalTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(BrandSechduledRemovalTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(BrandSechduledRemovalTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            BrandSechduledRemovalTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            BrandSechduledRemovalTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
