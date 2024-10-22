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
use entities\BudgetGrades as ChildBudgetGrades;
use entities\BudgetGradesQuery as ChildBudgetGradesQuery;
use entities\Map\BudgetGradesTableMap;

/**
 * Base class that represents a query for the `budget_grades` table.
 *
 * @method     ChildBudgetGradesQuery orderByBudgradeid($order = Criteria::ASC) Order by the budgradeid column
 * @method     ChildBudgetGradesQuery orderByBgid($order = Criteria::ASC) Order by the bgid column
 * @method     ChildBudgetGradesQuery orderByGradeId($order = Criteria::ASC) Order by the grade_id column
 * @method     ChildBudgetGradesQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 *
 * @method     ChildBudgetGradesQuery groupByBudgradeid() Group by the budgradeid column
 * @method     ChildBudgetGradesQuery groupByBgid() Group by the bgid column
 * @method     ChildBudgetGradesQuery groupByGradeId() Group by the grade_id column
 * @method     ChildBudgetGradesQuery groupByCreatedAt() Group by the created_at column
 *
 * @method     ChildBudgetGradesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildBudgetGradesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildBudgetGradesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildBudgetGradesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildBudgetGradesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildBudgetGradesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildBudgetGradesQuery leftJoinBudgetGroup($relationAlias = null) Adds a LEFT JOIN clause to the query using the BudgetGroup relation
 * @method     ChildBudgetGradesQuery rightJoinBudgetGroup($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BudgetGroup relation
 * @method     ChildBudgetGradesQuery innerJoinBudgetGroup($relationAlias = null) Adds a INNER JOIN clause to the query using the BudgetGroup relation
 *
 * @method     ChildBudgetGradesQuery joinWithBudgetGroup($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BudgetGroup relation
 *
 * @method     ChildBudgetGradesQuery leftJoinWithBudgetGroup() Adds a LEFT JOIN clause and with to the query using the BudgetGroup relation
 * @method     ChildBudgetGradesQuery rightJoinWithBudgetGroup() Adds a RIGHT JOIN clause and with to the query using the BudgetGroup relation
 * @method     ChildBudgetGradesQuery innerJoinWithBudgetGroup() Adds a INNER JOIN clause and with to the query using the BudgetGroup relation
 *
 * @method     ChildBudgetGradesQuery leftJoinGradeMaster($relationAlias = null) Adds a LEFT JOIN clause to the query using the GradeMaster relation
 * @method     ChildBudgetGradesQuery rightJoinGradeMaster($relationAlias = null) Adds a RIGHT JOIN clause to the query using the GradeMaster relation
 * @method     ChildBudgetGradesQuery innerJoinGradeMaster($relationAlias = null) Adds a INNER JOIN clause to the query using the GradeMaster relation
 *
 * @method     ChildBudgetGradesQuery joinWithGradeMaster($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the GradeMaster relation
 *
 * @method     ChildBudgetGradesQuery leftJoinWithGradeMaster() Adds a LEFT JOIN clause and with to the query using the GradeMaster relation
 * @method     ChildBudgetGradesQuery rightJoinWithGradeMaster() Adds a RIGHT JOIN clause and with to the query using the GradeMaster relation
 * @method     ChildBudgetGradesQuery innerJoinWithGradeMaster() Adds a INNER JOIN clause and with to the query using the GradeMaster relation
 *
 * @method     \entities\BudgetGroupQuery|\entities\GradeMasterQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildBudgetGrades|null findOne(?ConnectionInterface $con = null) Return the first ChildBudgetGrades matching the query
 * @method     ChildBudgetGrades findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildBudgetGrades matching the query, or a new ChildBudgetGrades object populated from the query conditions when no match is found
 *
 * @method     ChildBudgetGrades|null findOneByBudgradeid(int $budgradeid) Return the first ChildBudgetGrades filtered by the budgradeid column
 * @method     ChildBudgetGrades|null findOneByBgid(int $bgid) Return the first ChildBudgetGrades filtered by the bgid column
 * @method     ChildBudgetGrades|null findOneByGradeId(int $grade_id) Return the first ChildBudgetGrades filtered by the grade_id column
 * @method     ChildBudgetGrades|null findOneByCreatedAt(string $created_at) Return the first ChildBudgetGrades filtered by the created_at column
 *
 * @method     ChildBudgetGrades requirePk($key, ?ConnectionInterface $con = null) Return the ChildBudgetGrades by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBudgetGrades requireOne(?ConnectionInterface $con = null) Return the first ChildBudgetGrades matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBudgetGrades requireOneByBudgradeid(int $budgradeid) Return the first ChildBudgetGrades filtered by the budgradeid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBudgetGrades requireOneByBgid(int $bgid) Return the first ChildBudgetGrades filtered by the bgid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBudgetGrades requireOneByGradeId(int $grade_id) Return the first ChildBudgetGrades filtered by the grade_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBudgetGrades requireOneByCreatedAt(string $created_at) Return the first ChildBudgetGrades filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBudgetGrades[]|Collection find(?ConnectionInterface $con = null) Return ChildBudgetGrades objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildBudgetGrades> find(?ConnectionInterface $con = null) Return ChildBudgetGrades objects based on current ModelCriteria
 *
 * @method     ChildBudgetGrades[]|Collection findByBudgradeid(int|array<int> $budgradeid) Return ChildBudgetGrades objects filtered by the budgradeid column
 * @psalm-method Collection&\Traversable<ChildBudgetGrades> findByBudgradeid(int|array<int> $budgradeid) Return ChildBudgetGrades objects filtered by the budgradeid column
 * @method     ChildBudgetGrades[]|Collection findByBgid(int|array<int> $bgid) Return ChildBudgetGrades objects filtered by the bgid column
 * @psalm-method Collection&\Traversable<ChildBudgetGrades> findByBgid(int|array<int> $bgid) Return ChildBudgetGrades objects filtered by the bgid column
 * @method     ChildBudgetGrades[]|Collection findByGradeId(int|array<int> $grade_id) Return ChildBudgetGrades objects filtered by the grade_id column
 * @psalm-method Collection&\Traversable<ChildBudgetGrades> findByGradeId(int|array<int> $grade_id) Return ChildBudgetGrades objects filtered by the grade_id column
 * @method     ChildBudgetGrades[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildBudgetGrades objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildBudgetGrades> findByCreatedAt(string|array<string> $created_at) Return ChildBudgetGrades objects filtered by the created_at column
 *
 * @method     ChildBudgetGrades[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildBudgetGrades> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class BudgetGradesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\BudgetGradesQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\BudgetGrades', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildBudgetGradesQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildBudgetGradesQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildBudgetGradesQuery) {
            return $criteria;
        }
        $query = new ChildBudgetGradesQuery();
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
     * @return ChildBudgetGrades|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(BudgetGradesTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = BudgetGradesTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildBudgetGrades A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT budgradeid, bgid, grade_id, created_at FROM budget_grades WHERE budgradeid = :p0';
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
            /** @var ChildBudgetGrades $obj */
            $obj = new ChildBudgetGrades();
            $obj->hydrate($row);
            BudgetGradesTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildBudgetGrades|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(BudgetGradesTableMap::COL_BUDGRADEID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(BudgetGradesTableMap::COL_BUDGRADEID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the budgradeid column
     *
     * Example usage:
     * <code>
     * $query->filterByBudgradeid(1234); // WHERE budgradeid = 1234
     * $query->filterByBudgradeid(array(12, 34)); // WHERE budgradeid IN (12, 34)
     * $query->filterByBudgradeid(array('min' => 12)); // WHERE budgradeid > 12
     * </code>
     *
     * @param mixed $budgradeid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBudgradeid($budgradeid = null, ?string $comparison = null)
    {
        if (is_array($budgradeid)) {
            $useMinMax = false;
            if (isset($budgradeid['min'])) {
                $this->addUsingAlias(BudgetGradesTableMap::COL_BUDGRADEID, $budgradeid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($budgradeid['max'])) {
                $this->addUsingAlias(BudgetGradesTableMap::COL_BUDGRADEID, $budgradeid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BudgetGradesTableMap::COL_BUDGRADEID, $budgradeid, $comparison);

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
                $this->addUsingAlias(BudgetGradesTableMap::COL_BGID, $bgid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($bgid['max'])) {
                $this->addUsingAlias(BudgetGradesTableMap::COL_BGID, $bgid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BudgetGradesTableMap::COL_BGID, $bgid, $comparison);

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
     * @see       filterByGradeMaster()
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
                $this->addUsingAlias(BudgetGradesTableMap::COL_GRADE_ID, $gradeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($gradeId['max'])) {
                $this->addUsingAlias(BudgetGradesTableMap::COL_GRADE_ID, $gradeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BudgetGradesTableMap::COL_GRADE_ID, $gradeId, $comparison);

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
                $this->addUsingAlias(BudgetGradesTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(BudgetGradesTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BudgetGradesTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                ->addUsingAlias(BudgetGradesTableMap::COL_BGID, $budgetGroup->getBgid(), $comparison);
        } elseif ($budgetGroup instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(BudgetGradesTableMap::COL_BGID, $budgetGroup->toKeyValue('PrimaryKey', 'Bgid'), $comparison);

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
    public function joinBudgetGroup(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
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
    public function useBudgetGroupQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
        ?string $joinType = Criteria::LEFT_JOIN
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
     * Filter the query by a related \entities\GradeMaster object
     *
     * @param \entities\GradeMaster|ObjectCollection $gradeMaster The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByGradeMaster($gradeMaster, ?string $comparison = null)
    {
        if ($gradeMaster instanceof \entities\GradeMaster) {
            return $this
                ->addUsingAlias(BudgetGradesTableMap::COL_GRADE_ID, $gradeMaster->getGradeid(), $comparison);
        } elseif ($gradeMaster instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(BudgetGradesTableMap::COL_GRADE_ID, $gradeMaster->toKeyValue('PrimaryKey', 'Gradeid'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByGradeMaster() only accepts arguments of type \entities\GradeMaster or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the GradeMaster relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinGradeMaster(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('GradeMaster');

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
            $this->addJoinObject($join, 'GradeMaster');
        }

        return $this;
    }

    /**
     * Use the GradeMaster relation GradeMaster object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\GradeMasterQuery A secondary query class using the current class as primary query
     */
    public function useGradeMasterQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinGradeMaster($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'GradeMaster', '\entities\GradeMasterQuery');
    }

    /**
     * Use the GradeMaster relation GradeMaster object
     *
     * @param callable(\entities\GradeMasterQuery):\entities\GradeMasterQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withGradeMasterQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useGradeMasterQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to GradeMaster table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\GradeMasterQuery The inner query object of the EXISTS statement
     */
    public function useGradeMasterExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\GradeMasterQuery */
        $q = $this->useExistsQuery('GradeMaster', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to GradeMaster table for a NOT EXISTS query.
     *
     * @see useGradeMasterExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\GradeMasterQuery The inner query object of the NOT EXISTS statement
     */
    public function useGradeMasterNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\GradeMasterQuery */
        $q = $this->useExistsQuery('GradeMaster', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to GradeMaster table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\GradeMasterQuery The inner query object of the IN statement
     */
    public function useInGradeMasterQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\GradeMasterQuery */
        $q = $this->useInQuery('GradeMaster', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to GradeMaster table for a NOT IN query.
     *
     * @see useGradeMasterInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\GradeMasterQuery The inner query object of the NOT IN statement
     */
    public function useNotInGradeMasterQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\GradeMasterQuery */
        $q = $this->useInQuery('GradeMaster', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildBudgetGrades $budgetGrades Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($budgetGrades = null)
    {
        if ($budgetGrades) {
            $this->addUsingAlias(BudgetGradesTableMap::COL_BUDGRADEID, $budgetGrades->getBudgradeid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the budget_grades table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(BudgetGradesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            BudgetGradesTableMap::clearInstancePool();
            BudgetGradesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(BudgetGradesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(BudgetGradesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            BudgetGradesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            BudgetGradesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
