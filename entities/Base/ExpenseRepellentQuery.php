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
use entities\ExpenseRepellent as ChildExpenseRepellent;
use entities\ExpenseRepellentQuery as ChildExpenseRepellentQuery;
use entities\Map\ExpenseRepellentTableMap;

/**
 * Base class that represents a query for the `expense_repellent` table.
 *
 * @method     ChildExpenseRepellentQuery orderByExprepid($order = Criteria::ASC) Order by the exprepid column
 * @method     ChildExpenseRepellentQuery orderByExpenseId($order = Criteria::ASC) Order by the expense_id column
 * @method     ChildExpenseRepellentQuery orderByExpenseRepId($order = Criteria::ASC) Order by the expense_rep_id column
 *
 * @method     ChildExpenseRepellentQuery groupByExprepid() Group by the exprepid column
 * @method     ChildExpenseRepellentQuery groupByExpenseId() Group by the expense_id column
 * @method     ChildExpenseRepellentQuery groupByExpenseRepId() Group by the expense_rep_id column
 *
 * @method     ChildExpenseRepellentQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildExpenseRepellentQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildExpenseRepellentQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildExpenseRepellentQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildExpenseRepellentQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildExpenseRepellentQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildExpenseRepellentQuery leftJoinExpenseMaster($relationAlias = null) Adds a LEFT JOIN clause to the query using the ExpenseMaster relation
 * @method     ChildExpenseRepellentQuery rightJoinExpenseMaster($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ExpenseMaster relation
 * @method     ChildExpenseRepellentQuery innerJoinExpenseMaster($relationAlias = null) Adds a INNER JOIN clause to the query using the ExpenseMaster relation
 *
 * @method     ChildExpenseRepellentQuery joinWithExpenseMaster($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ExpenseMaster relation
 *
 * @method     ChildExpenseRepellentQuery leftJoinWithExpenseMaster() Adds a LEFT JOIN clause and with to the query using the ExpenseMaster relation
 * @method     ChildExpenseRepellentQuery rightJoinWithExpenseMaster() Adds a RIGHT JOIN clause and with to the query using the ExpenseMaster relation
 * @method     ChildExpenseRepellentQuery innerJoinWithExpenseMaster() Adds a INNER JOIN clause and with to the query using the ExpenseMaster relation
 *
 * @method     \entities\ExpenseMasterQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildExpenseRepellent|null findOne(?ConnectionInterface $con = null) Return the first ChildExpenseRepellent matching the query
 * @method     ChildExpenseRepellent findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildExpenseRepellent matching the query, or a new ChildExpenseRepellent object populated from the query conditions when no match is found
 *
 * @method     ChildExpenseRepellent|null findOneByExprepid(int $exprepid) Return the first ChildExpenseRepellent filtered by the exprepid column
 * @method     ChildExpenseRepellent|null findOneByExpenseId(int $expense_id) Return the first ChildExpenseRepellent filtered by the expense_id column
 * @method     ChildExpenseRepellent|null findOneByExpenseRepId(int $expense_rep_id) Return the first ChildExpenseRepellent filtered by the expense_rep_id column
 *
 * @method     ChildExpenseRepellent requirePk($key, ?ConnectionInterface $con = null) Return the ChildExpenseRepellent by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseRepellent requireOne(?ConnectionInterface $con = null) Return the first ChildExpenseRepellent matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildExpenseRepellent requireOneByExprepid(int $exprepid) Return the first ChildExpenseRepellent filtered by the exprepid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseRepellent requireOneByExpenseId(int $expense_id) Return the first ChildExpenseRepellent filtered by the expense_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseRepellent requireOneByExpenseRepId(int $expense_rep_id) Return the first ChildExpenseRepellent filtered by the expense_rep_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildExpenseRepellent[]|Collection find(?ConnectionInterface $con = null) Return ChildExpenseRepellent objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildExpenseRepellent> find(?ConnectionInterface $con = null) Return ChildExpenseRepellent objects based on current ModelCriteria
 *
 * @method     ChildExpenseRepellent[]|Collection findByExprepid(int|array<int> $exprepid) Return ChildExpenseRepellent objects filtered by the exprepid column
 * @psalm-method Collection&\Traversable<ChildExpenseRepellent> findByExprepid(int|array<int> $exprepid) Return ChildExpenseRepellent objects filtered by the exprepid column
 * @method     ChildExpenseRepellent[]|Collection findByExpenseId(int|array<int> $expense_id) Return ChildExpenseRepellent objects filtered by the expense_id column
 * @psalm-method Collection&\Traversable<ChildExpenseRepellent> findByExpenseId(int|array<int> $expense_id) Return ChildExpenseRepellent objects filtered by the expense_id column
 * @method     ChildExpenseRepellent[]|Collection findByExpenseRepId(int|array<int> $expense_rep_id) Return ChildExpenseRepellent objects filtered by the expense_rep_id column
 * @psalm-method Collection&\Traversable<ChildExpenseRepellent> findByExpenseRepId(int|array<int> $expense_rep_id) Return ChildExpenseRepellent objects filtered by the expense_rep_id column
 *
 * @method     ChildExpenseRepellent[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildExpenseRepellent> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class ExpenseRepellentQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\ExpenseRepellentQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\ExpenseRepellent', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildExpenseRepellentQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildExpenseRepellentQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildExpenseRepellentQuery) {
            return $criteria;
        }
        $query = new ChildExpenseRepellentQuery();
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
     * @return ChildExpenseRepellent|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ExpenseRepellentTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ExpenseRepellentTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildExpenseRepellent A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT exprepid, expense_id, expense_rep_id FROM expense_repellent WHERE exprepid = :p0';
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
            /** @var ChildExpenseRepellent $obj */
            $obj = new ChildExpenseRepellent();
            $obj->hydrate($row);
            ExpenseRepellentTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildExpenseRepellent|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(ExpenseRepellentTableMap::COL_EXPREPID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(ExpenseRepellentTableMap::COL_EXPREPID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the exprepid column
     *
     * Example usage:
     * <code>
     * $query->filterByExprepid(1234); // WHERE exprepid = 1234
     * $query->filterByExprepid(array(12, 34)); // WHERE exprepid IN (12, 34)
     * $query->filterByExprepid(array('min' => 12)); // WHERE exprepid > 12
     * </code>
     *
     * @param mixed $exprepid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExprepid($exprepid = null, ?string $comparison = null)
    {
        if (is_array($exprepid)) {
            $useMinMax = false;
            if (isset($exprepid['min'])) {
                $this->addUsingAlias(ExpenseRepellentTableMap::COL_EXPREPID, $exprepid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($exprepid['max'])) {
                $this->addUsingAlias(ExpenseRepellentTableMap::COL_EXPREPID, $exprepid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpenseRepellentTableMap::COL_EXPREPID, $exprepid, $comparison);

        return $this;
    }

    /**
     * Filter the query on the expense_id column
     *
     * Example usage:
     * <code>
     * $query->filterByExpenseId(1234); // WHERE expense_id = 1234
     * $query->filterByExpenseId(array(12, 34)); // WHERE expense_id IN (12, 34)
     * $query->filterByExpenseId(array('min' => 12)); // WHERE expense_id > 12
     * </code>
     *
     * @see       filterByExpenseMaster()
     *
     * @param mixed $expenseId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpenseId($expenseId = null, ?string $comparison = null)
    {
        if (is_array($expenseId)) {
            $useMinMax = false;
            if (isset($expenseId['min'])) {
                $this->addUsingAlias(ExpenseRepellentTableMap::COL_EXPENSE_ID, $expenseId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($expenseId['max'])) {
                $this->addUsingAlias(ExpenseRepellentTableMap::COL_EXPENSE_ID, $expenseId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpenseRepellentTableMap::COL_EXPENSE_ID, $expenseId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the expense_rep_id column
     *
     * Example usage:
     * <code>
     * $query->filterByExpenseRepId(1234); // WHERE expense_rep_id = 1234
     * $query->filterByExpenseRepId(array(12, 34)); // WHERE expense_rep_id IN (12, 34)
     * $query->filterByExpenseRepId(array('min' => 12)); // WHERE expense_rep_id > 12
     * </code>
     *
     * @param mixed $expenseRepId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpenseRepId($expenseRepId = null, ?string $comparison = null)
    {
        if (is_array($expenseRepId)) {
            $useMinMax = false;
            if (isset($expenseRepId['min'])) {
                $this->addUsingAlias(ExpenseRepellentTableMap::COL_EXPENSE_REP_ID, $expenseRepId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($expenseRepId['max'])) {
                $this->addUsingAlias(ExpenseRepellentTableMap::COL_EXPENSE_REP_ID, $expenseRepId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpenseRepellentTableMap::COL_EXPENSE_REP_ID, $expenseRepId, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \entities\ExpenseMaster object
     *
     * @param \entities\ExpenseMaster|ObjectCollection $expenseMaster The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpenseMaster($expenseMaster, ?string $comparison = null)
    {
        if ($expenseMaster instanceof \entities\ExpenseMaster) {
            return $this
                ->addUsingAlias(ExpenseRepellentTableMap::COL_EXPENSE_ID, $expenseMaster->getExpenseId(), $comparison);
        } elseif ($expenseMaster instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(ExpenseRepellentTableMap::COL_EXPENSE_ID, $expenseMaster->toKeyValue('PrimaryKey', 'ExpenseId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByExpenseMaster() only accepts arguments of type \entities\ExpenseMaster or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ExpenseMaster relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinExpenseMaster(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ExpenseMaster');

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
            $this->addJoinObject($join, 'ExpenseMaster');
        }

        return $this;
    }

    /**
     * Use the ExpenseMaster relation ExpenseMaster object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\ExpenseMasterQuery A secondary query class using the current class as primary query
     */
    public function useExpenseMasterQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinExpenseMaster($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ExpenseMaster', '\entities\ExpenseMasterQuery');
    }

    /**
     * Use the ExpenseMaster relation ExpenseMaster object
     *
     * @param callable(\entities\ExpenseMasterQuery):\entities\ExpenseMasterQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withExpenseMasterQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useExpenseMasterQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to ExpenseMaster table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\ExpenseMasterQuery The inner query object of the EXISTS statement
     */
    public function useExpenseMasterExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\ExpenseMasterQuery */
        $q = $this->useExistsQuery('ExpenseMaster', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to ExpenseMaster table for a NOT EXISTS query.
     *
     * @see useExpenseMasterExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\ExpenseMasterQuery The inner query object of the NOT EXISTS statement
     */
    public function useExpenseMasterNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\ExpenseMasterQuery */
        $q = $this->useExistsQuery('ExpenseMaster', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to ExpenseMaster table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\ExpenseMasterQuery The inner query object of the IN statement
     */
    public function useInExpenseMasterQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\ExpenseMasterQuery */
        $q = $this->useInQuery('ExpenseMaster', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to ExpenseMaster table for a NOT IN query.
     *
     * @see useExpenseMasterInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\ExpenseMasterQuery The inner query object of the NOT IN statement
     */
    public function useNotInExpenseMasterQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\ExpenseMasterQuery */
        $q = $this->useInQuery('ExpenseMaster', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildExpenseRepellent $expenseRepellent Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($expenseRepellent = null)
    {
        if ($expenseRepellent) {
            $this->addUsingAlias(ExpenseRepellentTableMap::COL_EXPREPID, $expenseRepellent->getExprepid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the expense_repellent table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ExpenseRepellentTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ExpenseRepellentTableMap::clearInstancePool();
            ExpenseRepellentTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ExpenseRepellentTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ExpenseRepellentTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ExpenseRepellentTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ExpenseRepellentTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
