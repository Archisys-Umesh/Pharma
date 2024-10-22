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
use entities\TempObsmCorrection as ChildTempObsmCorrection;
use entities\TempObsmCorrectionQuery as ChildTempObsmCorrectionQuery;
use entities\Map\TempObsmCorrectionTableMap;

/**
 * Base class that represents a query for the `temp_obsm_correction` table.
 *
 * @method     ChildTempObsmCorrectionQuery orderByOrgDataId($order = Criteria::ASC) Order by the org_data_id column
 * @method     ChildTempObsmCorrectionQuery orderByBrandId($order = Criteria::ASC) Order by the brand_id column
 * @method     ChildTempObsmCorrectionQuery orderByMin($order = Criteria::ASC) Order by the min column
 * @method     ChildTempObsmCorrectionQuery orderByIds($order = Criteria::ASC) Order by the ids column
 * @method     ChildTempObsmCorrectionQuery orderByCount($order = Criteria::ASC) Order by the count column
 *
 * @method     ChildTempObsmCorrectionQuery groupByOrgDataId() Group by the org_data_id column
 * @method     ChildTempObsmCorrectionQuery groupByBrandId() Group by the brand_id column
 * @method     ChildTempObsmCorrectionQuery groupByMin() Group by the min column
 * @method     ChildTempObsmCorrectionQuery groupByIds() Group by the ids column
 * @method     ChildTempObsmCorrectionQuery groupByCount() Group by the count column
 *
 * @method     ChildTempObsmCorrectionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildTempObsmCorrectionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildTempObsmCorrectionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildTempObsmCorrectionQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildTempObsmCorrectionQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildTempObsmCorrectionQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildTempObsmCorrection|null findOne(?ConnectionInterface $con = null) Return the first ChildTempObsmCorrection matching the query
 * @method     ChildTempObsmCorrection findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildTempObsmCorrection matching the query, or a new ChildTempObsmCorrection object populated from the query conditions when no match is found
 *
 * @method     ChildTempObsmCorrection|null findOneByOrgDataId(int $org_data_id) Return the first ChildTempObsmCorrection filtered by the org_data_id column
 * @method     ChildTempObsmCorrection|null findOneByBrandId(int $brand_id) Return the first ChildTempObsmCorrection filtered by the brand_id column
 * @method     ChildTempObsmCorrection|null findOneByMin(string $min) Return the first ChildTempObsmCorrection filtered by the min column
 * @method     ChildTempObsmCorrection|null findOneByIds(string $ids) Return the first ChildTempObsmCorrection filtered by the ids column
 * @method     ChildTempObsmCorrection|null findOneByCount(string $count) Return the first ChildTempObsmCorrection filtered by the count column
 *
 * @method     ChildTempObsmCorrection requirePk($key, ?ConnectionInterface $con = null) Return the ChildTempObsmCorrection by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTempObsmCorrection requireOne(?ConnectionInterface $con = null) Return the first ChildTempObsmCorrection matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTempObsmCorrection requireOneByOrgDataId(int $org_data_id) Return the first ChildTempObsmCorrection filtered by the org_data_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTempObsmCorrection requireOneByBrandId(int $brand_id) Return the first ChildTempObsmCorrection filtered by the brand_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTempObsmCorrection requireOneByMin(string $min) Return the first ChildTempObsmCorrection filtered by the min column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTempObsmCorrection requireOneByIds(string $ids) Return the first ChildTempObsmCorrection filtered by the ids column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTempObsmCorrection requireOneByCount(string $count) Return the first ChildTempObsmCorrection filtered by the count column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTempObsmCorrection[]|Collection find(?ConnectionInterface $con = null) Return ChildTempObsmCorrection objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildTempObsmCorrection> find(?ConnectionInterface $con = null) Return ChildTempObsmCorrection objects based on current ModelCriteria
 *
 * @method     ChildTempObsmCorrection[]|Collection findByOrgDataId(int|array<int> $org_data_id) Return ChildTempObsmCorrection objects filtered by the org_data_id column
 * @psalm-method Collection&\Traversable<ChildTempObsmCorrection> findByOrgDataId(int|array<int> $org_data_id) Return ChildTempObsmCorrection objects filtered by the org_data_id column
 * @method     ChildTempObsmCorrection[]|Collection findByBrandId(int|array<int> $brand_id) Return ChildTempObsmCorrection objects filtered by the brand_id column
 * @psalm-method Collection&\Traversable<ChildTempObsmCorrection> findByBrandId(int|array<int> $brand_id) Return ChildTempObsmCorrection objects filtered by the brand_id column
 * @method     ChildTempObsmCorrection[]|Collection findByMin(string|array<string> $min) Return ChildTempObsmCorrection objects filtered by the min column
 * @psalm-method Collection&\Traversable<ChildTempObsmCorrection> findByMin(string|array<string> $min) Return ChildTempObsmCorrection objects filtered by the min column
 * @method     ChildTempObsmCorrection[]|Collection findByIds(string|array<string> $ids) Return ChildTempObsmCorrection objects filtered by the ids column
 * @psalm-method Collection&\Traversable<ChildTempObsmCorrection> findByIds(string|array<string> $ids) Return ChildTempObsmCorrection objects filtered by the ids column
 * @method     ChildTempObsmCorrection[]|Collection findByCount(string|array<string> $count) Return ChildTempObsmCorrection objects filtered by the count column
 * @psalm-method Collection&\Traversable<ChildTempObsmCorrection> findByCount(string|array<string> $count) Return ChildTempObsmCorrection objects filtered by the count column
 *
 * @method     ChildTempObsmCorrection[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildTempObsmCorrection> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class TempObsmCorrectionQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\TempObsmCorrectionQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\TempObsmCorrection', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildTempObsmCorrectionQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildTempObsmCorrectionQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildTempObsmCorrectionQuery) {
            return $criteria;
        }
        $query = new ChildTempObsmCorrectionQuery();
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
     * @return ChildTempObsmCorrection|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        throw new LogicException('The TempObsmCorrection object has no primary key');
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
        throw new LogicException('The TempObsmCorrection object has no primary key');
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
        throw new LogicException('The TempObsmCorrection object has no primary key');
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
        throw new LogicException('The TempObsmCorrection object has no primary key');
    }

    /**
     * Filter the query on the org_data_id column
     *
     * Example usage:
     * <code>
     * $query->filterByOrgDataId(1234); // WHERE org_data_id = 1234
     * $query->filterByOrgDataId(array(12, 34)); // WHERE org_data_id IN (12, 34)
     * $query->filterByOrgDataId(array('min' => 12)); // WHERE org_data_id > 12
     * </code>
     *
     * @param mixed $orgDataId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrgDataId($orgDataId = null, ?string $comparison = null)
    {
        if (is_array($orgDataId)) {
            $useMinMax = false;
            if (isset($orgDataId['min'])) {
                $this->addUsingAlias(TempObsmCorrectionTableMap::COL_ORG_DATA_ID, $orgDataId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($orgDataId['max'])) {
                $this->addUsingAlias(TempObsmCorrectionTableMap::COL_ORG_DATA_ID, $orgDataId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TempObsmCorrectionTableMap::COL_ORG_DATA_ID, $orgDataId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the brand_id column
     *
     * Example usage:
     * <code>
     * $query->filterByBrandId(1234); // WHERE brand_id = 1234
     * $query->filterByBrandId(array(12, 34)); // WHERE brand_id IN (12, 34)
     * $query->filterByBrandId(array('min' => 12)); // WHERE brand_id > 12
     * </code>
     *
     * @param mixed $brandId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBrandId($brandId = null, ?string $comparison = null)
    {
        if (is_array($brandId)) {
            $useMinMax = false;
            if (isset($brandId['min'])) {
                $this->addUsingAlias(TempObsmCorrectionTableMap::COL_BRAND_ID, $brandId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($brandId['max'])) {
                $this->addUsingAlias(TempObsmCorrectionTableMap::COL_BRAND_ID, $brandId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TempObsmCorrectionTableMap::COL_BRAND_ID, $brandId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the min column
     *
     * Example usage:
     * <code>
     * $query->filterByMin(1234); // WHERE min = 1234
     * $query->filterByMin(array(12, 34)); // WHERE min IN (12, 34)
     * $query->filterByMin(array('min' => 12)); // WHERE min > 12
     * </code>
     *
     * @param mixed $min The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMin($min = null, ?string $comparison = null)
    {
        if (is_array($min)) {
            $useMinMax = false;
            if (isset($min['min'])) {
                $this->addUsingAlias(TempObsmCorrectionTableMap::COL_MIN, $min['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($min['max'])) {
                $this->addUsingAlias(TempObsmCorrectionTableMap::COL_MIN, $min['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TempObsmCorrectionTableMap::COL_MIN, $min, $comparison);

        return $this;
    }

    /**
     * Filter the query on the ids column
     *
     * Example usage:
     * <code>
     * $query->filterByIds('fooValue');   // WHERE ids = 'fooValue'
     * $query->filterByIds('%fooValue%', Criteria::LIKE); // WHERE ids LIKE '%fooValue%'
     * $query->filterByIds(['foo', 'bar']); // WHERE ids IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $ids The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIds($ids = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($ids)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TempObsmCorrectionTableMap::COL_IDS, $ids, $comparison);

        return $this;
    }

    /**
     * Filter the query on the count column
     *
     * Example usage:
     * <code>
     * $query->filterByCount(1234); // WHERE count = 1234
     * $query->filterByCount(array(12, 34)); // WHERE count IN (12, 34)
     * $query->filterByCount(array('min' => 12)); // WHERE count > 12
     * </code>
     *
     * @param mixed $count The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCount($count = null, ?string $comparison = null)
    {
        if (is_array($count)) {
            $useMinMax = false;
            if (isset($count['min'])) {
                $this->addUsingAlias(TempObsmCorrectionTableMap::COL_COUNT, $count['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($count['max'])) {
                $this->addUsingAlias(TempObsmCorrectionTableMap::COL_COUNT, $count['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TempObsmCorrectionTableMap::COL_COUNT, $count, $comparison);

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildTempObsmCorrection $tempObsmCorrection Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($tempObsmCorrection = null)
    {
        if ($tempObsmCorrection) {
            throw new LogicException('TempObsmCorrection object has no primary key');

        }

        return $this;
    }

    /**
     * Deletes all rows from the temp_obsm_correction table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(TempObsmCorrectionTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            TempObsmCorrectionTableMap::clearInstancePool();
            TempObsmCorrectionTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(TempObsmCorrectionTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(TempObsmCorrectionTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            TempObsmCorrectionTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            TempObsmCorrectionTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
