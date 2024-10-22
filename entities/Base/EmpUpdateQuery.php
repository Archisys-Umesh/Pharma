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
use entities\EmpUpdate as ChildEmpUpdate;
use entities\EmpUpdateQuery as ChildEmpUpdateQuery;
use entities\Map\EmpUpdateTableMap;

/**
 * Base class that represents a query for the `emp_update` table.
 *
 * @method     ChildEmpUpdateQuery orderByEmpId($order = Criteria::ASC) Order by the emp_id column
 * @method     ChildEmpUpdateQuery orderByColumn2($order = Criteria::ASC) Order by the column2 column
 * @method     ChildEmpUpdateQuery orderByGradeId($order = Criteria::ASC) Order by the grade_id column
 * @method     ChildEmpUpdateQuery orderByActual($order = Criteria::ASC) Order by the actual column
 * @method     ChildEmpUpdateQuery orderByChange($order = Criteria::ASC) Order by the change column
 *
 * @method     ChildEmpUpdateQuery groupByEmpId() Group by the emp_id column
 * @method     ChildEmpUpdateQuery groupByColumn2() Group by the column2 column
 * @method     ChildEmpUpdateQuery groupByGradeId() Group by the grade_id column
 * @method     ChildEmpUpdateQuery groupByActual() Group by the actual column
 * @method     ChildEmpUpdateQuery groupByChange() Group by the change column
 *
 * @method     ChildEmpUpdateQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildEmpUpdateQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildEmpUpdateQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildEmpUpdateQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildEmpUpdateQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildEmpUpdateQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildEmpUpdate|null findOne(?ConnectionInterface $con = null) Return the first ChildEmpUpdate matching the query
 * @method     ChildEmpUpdate findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildEmpUpdate matching the query, or a new ChildEmpUpdate object populated from the query conditions when no match is found
 *
 * @method     ChildEmpUpdate|null findOneByEmpId(int $emp_id) Return the first ChildEmpUpdate filtered by the emp_id column
 * @method     ChildEmpUpdate|null findOneByColumn2(string $column2) Return the first ChildEmpUpdate filtered by the column2 column
 * @method     ChildEmpUpdate|null findOneByGradeId(int $grade_id) Return the first ChildEmpUpdate filtered by the grade_id column
 * @method     ChildEmpUpdate|null findOneByActual(string $actual) Return the first ChildEmpUpdate filtered by the actual column
 * @method     ChildEmpUpdate|null findOneByChange(string $change) Return the first ChildEmpUpdate filtered by the change column
 *
 * @method     ChildEmpUpdate requirePk($key, ?ConnectionInterface $con = null) Return the ChildEmpUpdate by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmpUpdate requireOne(?ConnectionInterface $con = null) Return the first ChildEmpUpdate matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEmpUpdate requireOneByEmpId(int $emp_id) Return the first ChildEmpUpdate filtered by the emp_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmpUpdate requireOneByColumn2(string $column2) Return the first ChildEmpUpdate filtered by the column2 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmpUpdate requireOneByGradeId(int $grade_id) Return the first ChildEmpUpdate filtered by the grade_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmpUpdate requireOneByActual(string $actual) Return the first ChildEmpUpdate filtered by the actual column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmpUpdate requireOneByChange(string $change) Return the first ChildEmpUpdate filtered by the change column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEmpUpdate[]|Collection find(?ConnectionInterface $con = null) Return ChildEmpUpdate objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildEmpUpdate> find(?ConnectionInterface $con = null) Return ChildEmpUpdate objects based on current ModelCriteria
 *
 * @method     ChildEmpUpdate[]|Collection findByEmpId(int|array<int> $emp_id) Return ChildEmpUpdate objects filtered by the emp_id column
 * @psalm-method Collection&\Traversable<ChildEmpUpdate> findByEmpId(int|array<int> $emp_id) Return ChildEmpUpdate objects filtered by the emp_id column
 * @method     ChildEmpUpdate[]|Collection findByColumn2(string|array<string> $column2) Return ChildEmpUpdate objects filtered by the column2 column
 * @psalm-method Collection&\Traversable<ChildEmpUpdate> findByColumn2(string|array<string> $column2) Return ChildEmpUpdate objects filtered by the column2 column
 * @method     ChildEmpUpdate[]|Collection findByGradeId(int|array<int> $grade_id) Return ChildEmpUpdate objects filtered by the grade_id column
 * @psalm-method Collection&\Traversable<ChildEmpUpdate> findByGradeId(int|array<int> $grade_id) Return ChildEmpUpdate objects filtered by the grade_id column
 * @method     ChildEmpUpdate[]|Collection findByActual(string|array<string> $actual) Return ChildEmpUpdate objects filtered by the actual column
 * @psalm-method Collection&\Traversable<ChildEmpUpdate> findByActual(string|array<string> $actual) Return ChildEmpUpdate objects filtered by the actual column
 * @method     ChildEmpUpdate[]|Collection findByChange(string|array<string> $change) Return ChildEmpUpdate objects filtered by the change column
 * @psalm-method Collection&\Traversable<ChildEmpUpdate> findByChange(string|array<string> $change) Return ChildEmpUpdate objects filtered by the change column
 *
 * @method     ChildEmpUpdate[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildEmpUpdate> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class EmpUpdateQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\EmpUpdateQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\EmpUpdate', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildEmpUpdateQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildEmpUpdateQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildEmpUpdateQuery) {
            return $criteria;
        }
        $query = new ChildEmpUpdateQuery();
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
     * @return ChildEmpUpdate|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        throw new LogicException('The EmpUpdate object has no primary key');
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
        throw new LogicException('The EmpUpdate object has no primary key');
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
        throw new LogicException('The EmpUpdate object has no primary key');
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
        throw new LogicException('The EmpUpdate object has no primary key');
    }

    /**
     * Filter the query on the emp_id column
     *
     * Example usage:
     * <code>
     * $query->filterByEmpId(1234); // WHERE emp_id = 1234
     * $query->filterByEmpId(array(12, 34)); // WHERE emp_id IN (12, 34)
     * $query->filterByEmpId(array('min' => 12)); // WHERE emp_id > 12
     * </code>
     *
     * @param mixed $empId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmpId($empId = null, ?string $comparison = null)
    {
        if (is_array($empId)) {
            $useMinMax = false;
            if (isset($empId['min'])) {
                $this->addUsingAlias(EmpUpdateTableMap::COL_EMP_ID, $empId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($empId['max'])) {
                $this->addUsingAlias(EmpUpdateTableMap::COL_EMP_ID, $empId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmpUpdateTableMap::COL_EMP_ID, $empId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the column2 column
     *
     * Example usage:
     * <code>
     * $query->filterByColumn2('fooValue');   // WHERE column2 = 'fooValue'
     * $query->filterByColumn2('%fooValue%', Criteria::LIKE); // WHERE column2 LIKE '%fooValue%'
     * $query->filterByColumn2(['foo', 'bar']); // WHERE column2 IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $column2 The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByColumn2($column2 = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($column2)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmpUpdateTableMap::COL_COLUMN2, $column2, $comparison);

        return $this;
    }

    /**
     * Filter the query on the grade_id column
     *
     * Example usage:
     * <code>
     * $query->filterByGradeId(1234); // WHERE grade_id = 1234
     * $query->filterByGradeId(array(12, 34)); // WHERE grade_id IN (12, 34)
     * $query->filterByGradeId(array('min' => 12)); // WHERE grade_id > 12
     * </code>
     *
     * @param mixed $gradeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByGradeId($gradeId = null, ?string $comparison = null)
    {
        if (is_array($gradeId)) {
            $useMinMax = false;
            if (isset($gradeId['min'])) {
                $this->addUsingAlias(EmpUpdateTableMap::COL_GRADE_ID, $gradeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($gradeId['max'])) {
                $this->addUsingAlias(EmpUpdateTableMap::COL_GRADE_ID, $gradeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmpUpdateTableMap::COL_GRADE_ID, $gradeId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the actual column
     *
     * Example usage:
     * <code>
     * $query->filterByActual('fooValue');   // WHERE actual = 'fooValue'
     * $query->filterByActual('%fooValue%', Criteria::LIKE); // WHERE actual LIKE '%fooValue%'
     * $query->filterByActual(['foo', 'bar']); // WHERE actual IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $actual The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByActual($actual = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($actual)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmpUpdateTableMap::COL_ACTUAL, $actual, $comparison);

        return $this;
    }

    /**
     * Filter the query on the change column
     *
     * Example usage:
     * <code>
     * $query->filterByChange('fooValue');   // WHERE change = 'fooValue'
     * $query->filterByChange('%fooValue%', Criteria::LIKE); // WHERE change LIKE '%fooValue%'
     * $query->filterByChange(['foo', 'bar']); // WHERE change IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $change The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByChange($change = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($change)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmpUpdateTableMap::COL_CHANGE, $change, $comparison);

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildEmpUpdate $empUpdate Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($empUpdate = null)
    {
        if ($empUpdate) {
            throw new LogicException('EmpUpdate object has no primary key');

        }

        return $this;
    }

    /**
     * Deletes all rows from the emp_update table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EmpUpdateTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            EmpUpdateTableMap::clearInstancePool();
            EmpUpdateTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(EmpUpdateTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(EmpUpdateTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            EmpUpdateTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            EmpUpdateTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
