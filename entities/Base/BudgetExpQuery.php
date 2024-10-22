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
use entities\BudgetExp as ChildBudgetExp;
use entities\BudgetExpQuery as ChildBudgetExpQuery;
use entities\Map\BudgetExpTableMap;

/**
 * Base class that represents a query for the `budget_exp` table.
 *
 * @method     ChildBudgetExpQuery orderByBlid($order = Criteria::ASC) Order by the blid column
 * @method     ChildBudgetExpQuery orderByBgid($order = Criteria::ASC) Order by the bgid column
 * @method     ChildBudgetExpQuery orderByExpenseId($order = Criteria::ASC) Order by the expense_id column
 *
 * @method     ChildBudgetExpQuery groupByBlid() Group by the blid column
 * @method     ChildBudgetExpQuery groupByBgid() Group by the bgid column
 * @method     ChildBudgetExpQuery groupByExpenseId() Group by the expense_id column
 *
 * @method     ChildBudgetExpQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildBudgetExpQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildBudgetExpQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildBudgetExpQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildBudgetExpQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildBudgetExpQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildBudgetExpQuery leftJoinBudgetGroup($relationAlias = null) Adds a LEFT JOIN clause to the query using the BudgetGroup relation
 * @method     ChildBudgetExpQuery rightJoinBudgetGroup($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BudgetGroup relation
 * @method     ChildBudgetExpQuery innerJoinBudgetGroup($relationAlias = null) Adds a INNER JOIN clause to the query using the BudgetGroup relation
 *
 * @method     ChildBudgetExpQuery joinWithBudgetGroup($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BudgetGroup relation
 *
 * @method     ChildBudgetExpQuery leftJoinWithBudgetGroup() Adds a LEFT JOIN clause and with to the query using the BudgetGroup relation
 * @method     ChildBudgetExpQuery rightJoinWithBudgetGroup() Adds a RIGHT JOIN clause and with to the query using the BudgetGroup relation
 * @method     ChildBudgetExpQuery innerJoinWithBudgetGroup() Adds a INNER JOIN clause and with to the query using the BudgetGroup relation
 *
 * @method     ChildBudgetExpQuery leftJoinExpenseMaster($relationAlias = null) Adds a LEFT JOIN clause to the query using the ExpenseMaster relation
 * @method     ChildBudgetExpQuery rightJoinExpenseMaster($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ExpenseMaster relation
 * @method     ChildBudgetExpQuery innerJoinExpenseMaster($relationAlias = null) Adds a INNER JOIN clause to the query using the ExpenseMaster relation
 *
 * @method     ChildBudgetExpQuery joinWithExpenseMaster($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ExpenseMaster relation
 *
 * @method     ChildBudgetExpQuery leftJoinWithExpenseMaster() Adds a LEFT JOIN clause and with to the query using the ExpenseMaster relation
 * @method     ChildBudgetExpQuery rightJoinWithExpenseMaster() Adds a RIGHT JOIN clause and with to the query using the ExpenseMaster relation
 * @method     ChildBudgetExpQuery innerJoinWithExpenseMaster() Adds a INNER JOIN clause and with to the query using the ExpenseMaster relation
 *
 * @method     \entities\BudgetGroupQuery|\entities\ExpenseMasterQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildBudgetExp|null findOne(?ConnectionInterface $con = null) Return the first ChildBudgetExp matching the query
 * @method     ChildBudgetExp findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildBudgetExp matching the query, or a new ChildBudgetExp object populated from the query conditions when no match is found
 *
 * @method     ChildBudgetExp|null findOneByBlid(int $blid) Return the first ChildBudgetExp filtered by the blid column
 * @method     ChildBudgetExp|null findOneByBgid(int $bgid) Return the first ChildBudgetExp filtered by the bgid column
 * @method     ChildBudgetExp|null findOneByExpenseId(int $expense_id) Return the first ChildBudgetExp filtered by the expense_id column
 *
 * @method     ChildBudgetExp requirePk($key, ?ConnectionInterface $con = null) Return the ChildBudgetExp by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBudgetExp requireOne(?ConnectionInterface $con = null) Return the first ChildBudgetExp matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBudgetExp requireOneByBlid(int $blid) Return the first ChildBudgetExp filtered by the blid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBudgetExp requireOneByBgid(int $bgid) Return the first ChildBudgetExp filtered by the bgid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBudgetExp requireOneByExpenseId(int $expense_id) Return the first ChildBudgetExp filtered by the expense_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBudgetExp[]|Collection find(?ConnectionInterface $con = null) Return ChildBudgetExp objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildBudgetExp> find(?ConnectionInterface $con = null) Return ChildBudgetExp objects based on current ModelCriteria
 *
 * @method     ChildBudgetExp[]|Collection findByBlid(int|array<int> $blid) Return ChildBudgetExp objects filtered by the blid column
 * @psalm-method Collection&\Traversable<ChildBudgetExp> findByBlid(int|array<int> $blid) Return ChildBudgetExp objects filtered by the blid column
 * @method     ChildBudgetExp[]|Collection findByBgid(int|array<int> $bgid) Return ChildBudgetExp objects filtered by the bgid column
 * @psalm-method Collection&\Traversable<ChildBudgetExp> findByBgid(int|array<int> $bgid) Return ChildBudgetExp objects filtered by the bgid column
 * @method     ChildBudgetExp[]|Collection findByExpenseId(int|array<int> $expense_id) Return ChildBudgetExp objects filtered by the expense_id column
 * @psalm-method Collection&\Traversable<ChildBudgetExp> findByExpenseId(int|array<int> $expense_id) Return ChildBudgetExp objects filtered by the expense_id column
 *
 * @method     ChildBudgetExp[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildBudgetExp> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class BudgetExpQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\BudgetExpQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\BudgetExp', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildBudgetExpQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildBudgetExpQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildBudgetExpQuery) {
            return $criteria;
        }
        $query = new ChildBudgetExpQuery();
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
     * @return ChildBudgetExp|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(BudgetExpTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = BudgetExpTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildBudgetExp A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT blid, bgid, expense_id FROM budget_exp WHERE blid = :p0';
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
            /** @var ChildBudgetExp $obj */
            $obj = new ChildBudgetExp();
            $obj->hydrate($row);
            BudgetExpTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildBudgetExp|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(BudgetExpTableMap::COL_BLID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(BudgetExpTableMap::COL_BLID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the blid column
     *
     * Example usage:
     * <code>
     * $query->filterByBlid(1234); // WHERE blid = 1234
     * $query->filterByBlid(array(12, 34)); // WHERE blid IN (12, 34)
     * $query->filterByBlid(array('min' => 12)); // WHERE blid > 12
     * </code>
     *
     * @param mixed $blid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBlid($blid = null, ?string $comparison = null)
    {
        if (is_array($blid)) {
            $useMinMax = false;
            if (isset($blid['min'])) {
                $this->addUsingAlias(BudgetExpTableMap::COL_BLID, $blid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($blid['max'])) {
                $this->addUsingAlias(BudgetExpTableMap::COL_BLID, $blid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BudgetExpTableMap::COL_BLID, $blid, $comparison);

        return $this;
    }

    /**
     * Filter the query on the bgid column
     *
     * Example usage:
     * <code>
     * $query->filterByBgid(1234); // WHERE bgid = 1234
     * $query->filterByBgid(array(12, 34)); // WHERE bgid IN (12, 34)
     * $query->filterByBgid(array('min' => 12)); // WHERE bgid > 12
     * </code>
     *
     * @see       filterByBudgetGroup()
     *
     * @param mixed $bgid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBgid($bgid = null, ?string $comparison = null)
    {
        if (is_array($bgid)) {
            $useMinMax = false;
            if (isset($bgid['min'])) {
                $this->addUsingAlias(BudgetExpTableMap::COL_BGID, $bgid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($bgid['max'])) {
                $this->addUsingAlias(BudgetExpTableMap::COL_BGID, $bgid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BudgetExpTableMap::COL_BGID, $bgid, $comparison);

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
                $this->addUsingAlias(BudgetExpTableMap::COL_EXPENSE_ID, $expenseId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($expenseId['max'])) {
                $this->addUsingAlias(BudgetExpTableMap::COL_EXPENSE_ID, $expenseId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BudgetExpTableMap::COL_EXPENSE_ID, $expenseId, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \entities\BudgetGroup object
     *
     * @param \entities\BudgetGroup|ObjectCollection $budgetGroup The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBudgetGroup($budgetGroup, ?string $comparison = null)
    {
        if ($budgetGroup instanceof \entities\BudgetGroup) {
            return $this
                ->addUsingAlias(BudgetExpTableMap::COL_BGID, $budgetGroup->getBgid(), $comparison);
        } elseif ($budgetGroup instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(BudgetExpTableMap::COL_BGID, $budgetGroup->toKeyValue('PrimaryKey', 'Bgid'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByBudgetGroup() only accepts arguments of type \entities\BudgetGroup or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BudgetGroup relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinBudgetGroup(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BudgetGroup');

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
            $this->addJoinObject($join, 'BudgetGroup');
        }

        return $this;
    }

    /**
     * Use the BudgetGroup relation BudgetGroup object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\BudgetGroupQuery A secondary query class using the current class as primary query
     */
    public function useBudgetGroupQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinBudgetGroup($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BudgetGroup', '\entities\BudgetGroupQuery');
    }

    /**
     * Use the BudgetGroup relation BudgetGroup object
     *
     * @param callable(\entities\BudgetGroupQuery):\entities\BudgetGroupQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withBudgetGroupQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useBudgetGroupQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to BudgetGroup table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\BudgetGroupQuery The inner query object of the EXISTS statement
     */
    public function useBudgetGroupExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\BudgetGroupQuery */
        $q = $this->useExistsQuery('BudgetGroup', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to BudgetGroup table for a NOT EXISTS query.
     *
     * @see useBudgetGroupExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\BudgetGroupQuery The inner query object of the NOT EXISTS statement
     */
    public function useBudgetGroupNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\BudgetGroupQuery */
        $q = $this->useExistsQuery('BudgetGroup', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to BudgetGroup table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\BudgetGroupQuery The inner query object of the IN statement
     */
    public function useInBudgetGroupQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\BudgetGroupQuery */
        $q = $this->useInQuery('BudgetGroup', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to BudgetGroup table for a NOT IN query.
     *
     * @see useBudgetGroupInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\BudgetGroupQuery The inner query object of the NOT IN statement
     */
    public function useNotInBudgetGroupQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\BudgetGroupQuery */
        $q = $this->useInQuery('BudgetGroup', $modelAlias, $queryClass, 'NOT IN');
        return $q;
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
                ->addUsingAlias(BudgetExpTableMap::COL_EXPENSE_ID, $expenseMaster->getExpenseId(), $comparison);
        } elseif ($expenseMaster instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(BudgetExpTableMap::COL_EXPENSE_ID, $expenseMaster->toKeyValue('PrimaryKey', 'ExpenseId'), $comparison);

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
    public function joinExpenseMaster(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
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
    public function useExpenseMasterQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
        ?string $joinType = Criteria::INNER_JOIN
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
     * @param ChildBudgetExp $budgetExp Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($budgetExp = null)
    {
        if ($budgetExp) {
            $this->addUsingAlias(BudgetExpTableMap::COL_BLID, $budgetExp->getBlid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the budget_exp table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(BudgetExpTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            BudgetExpTableMap::clearInstancePool();
            BudgetExpTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(BudgetExpTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(BudgetExpTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            BudgetExpTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            BudgetExpTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
