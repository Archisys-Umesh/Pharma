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
use entities\ExpenseFiles as ChildExpenseFiles;
use entities\ExpenseFilesQuery as ChildExpenseFilesQuery;
use entities\Map\ExpenseFilesTableMap;

/**
 * Base class that represents a query for the `expense_files` table.
 *
 * @method     ChildExpenseFilesQuery orderByExpFileId($order = Criteria::ASC) Order by the exp_file_id column
 * @method     ChildExpenseFilesQuery orderByExpFileName($order = Criteria::ASC) Order by the exp_file_name column
 * @method     ChildExpenseFilesQuery orderByExpFullName($order = Criteria::ASC) Order by the exp_full_name column
 * @method     ChildExpenseFilesQuery orderByExpMime($order = Criteria::ASC) Order by the exp_mime column
 * @method     ChildExpenseFilesQuery orderByExpFileSize($order = Criteria::ASC) Order by the exp_file_size column
 * @method     ChildExpenseFilesQuery orderByExpId($order = Criteria::ASC) Order by the exp_id column
 *
 * @method     ChildExpenseFilesQuery groupByExpFileId() Group by the exp_file_id column
 * @method     ChildExpenseFilesQuery groupByExpFileName() Group by the exp_file_name column
 * @method     ChildExpenseFilesQuery groupByExpFullName() Group by the exp_full_name column
 * @method     ChildExpenseFilesQuery groupByExpMime() Group by the exp_mime column
 * @method     ChildExpenseFilesQuery groupByExpFileSize() Group by the exp_file_size column
 * @method     ChildExpenseFilesQuery groupByExpId() Group by the exp_id column
 *
 * @method     ChildExpenseFilesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildExpenseFilesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildExpenseFilesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildExpenseFilesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildExpenseFilesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildExpenseFilesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildExpenseFilesQuery leftJoinExpenses($relationAlias = null) Adds a LEFT JOIN clause to the query using the Expenses relation
 * @method     ChildExpenseFilesQuery rightJoinExpenses($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Expenses relation
 * @method     ChildExpenseFilesQuery innerJoinExpenses($relationAlias = null) Adds a INNER JOIN clause to the query using the Expenses relation
 *
 * @method     ChildExpenseFilesQuery joinWithExpenses($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Expenses relation
 *
 * @method     ChildExpenseFilesQuery leftJoinWithExpenses() Adds a LEFT JOIN clause and with to the query using the Expenses relation
 * @method     ChildExpenseFilesQuery rightJoinWithExpenses() Adds a RIGHT JOIN clause and with to the query using the Expenses relation
 * @method     ChildExpenseFilesQuery innerJoinWithExpenses() Adds a INNER JOIN clause and with to the query using the Expenses relation
 *
 * @method     \entities\ExpensesQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildExpenseFiles|null findOne(?ConnectionInterface $con = null) Return the first ChildExpenseFiles matching the query
 * @method     ChildExpenseFiles findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildExpenseFiles matching the query, or a new ChildExpenseFiles object populated from the query conditions when no match is found
 *
 * @method     ChildExpenseFiles|null findOneByExpFileId(int $exp_file_id) Return the first ChildExpenseFiles filtered by the exp_file_id column
 * @method     ChildExpenseFiles|null findOneByExpFileName(string $exp_file_name) Return the first ChildExpenseFiles filtered by the exp_file_name column
 * @method     ChildExpenseFiles|null findOneByExpFullName(string $exp_full_name) Return the first ChildExpenseFiles filtered by the exp_full_name column
 * @method     ChildExpenseFiles|null findOneByExpMime(string $exp_mime) Return the first ChildExpenseFiles filtered by the exp_mime column
 * @method     ChildExpenseFiles|null findOneByExpFileSize(string $exp_file_size) Return the first ChildExpenseFiles filtered by the exp_file_size column
 * @method     ChildExpenseFiles|null findOneByExpId(int $exp_id) Return the first ChildExpenseFiles filtered by the exp_id column
 *
 * @method     ChildExpenseFiles requirePk($key, ?ConnectionInterface $con = null) Return the ChildExpenseFiles by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseFiles requireOne(?ConnectionInterface $con = null) Return the first ChildExpenseFiles matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildExpenseFiles requireOneByExpFileId(int $exp_file_id) Return the first ChildExpenseFiles filtered by the exp_file_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseFiles requireOneByExpFileName(string $exp_file_name) Return the first ChildExpenseFiles filtered by the exp_file_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseFiles requireOneByExpFullName(string $exp_full_name) Return the first ChildExpenseFiles filtered by the exp_full_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseFiles requireOneByExpMime(string $exp_mime) Return the first ChildExpenseFiles filtered by the exp_mime column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseFiles requireOneByExpFileSize(string $exp_file_size) Return the first ChildExpenseFiles filtered by the exp_file_size column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseFiles requireOneByExpId(int $exp_id) Return the first ChildExpenseFiles filtered by the exp_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildExpenseFiles[]|Collection find(?ConnectionInterface $con = null) Return ChildExpenseFiles objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildExpenseFiles> find(?ConnectionInterface $con = null) Return ChildExpenseFiles objects based on current ModelCriteria
 *
 * @method     ChildExpenseFiles[]|Collection findByExpFileId(int|array<int> $exp_file_id) Return ChildExpenseFiles objects filtered by the exp_file_id column
 * @psalm-method Collection&\Traversable<ChildExpenseFiles> findByExpFileId(int|array<int> $exp_file_id) Return ChildExpenseFiles objects filtered by the exp_file_id column
 * @method     ChildExpenseFiles[]|Collection findByExpFileName(string|array<string> $exp_file_name) Return ChildExpenseFiles objects filtered by the exp_file_name column
 * @psalm-method Collection&\Traversable<ChildExpenseFiles> findByExpFileName(string|array<string> $exp_file_name) Return ChildExpenseFiles objects filtered by the exp_file_name column
 * @method     ChildExpenseFiles[]|Collection findByExpFullName(string|array<string> $exp_full_name) Return ChildExpenseFiles objects filtered by the exp_full_name column
 * @psalm-method Collection&\Traversable<ChildExpenseFiles> findByExpFullName(string|array<string> $exp_full_name) Return ChildExpenseFiles objects filtered by the exp_full_name column
 * @method     ChildExpenseFiles[]|Collection findByExpMime(string|array<string> $exp_mime) Return ChildExpenseFiles objects filtered by the exp_mime column
 * @psalm-method Collection&\Traversable<ChildExpenseFiles> findByExpMime(string|array<string> $exp_mime) Return ChildExpenseFiles objects filtered by the exp_mime column
 * @method     ChildExpenseFiles[]|Collection findByExpFileSize(string|array<string> $exp_file_size) Return ChildExpenseFiles objects filtered by the exp_file_size column
 * @psalm-method Collection&\Traversable<ChildExpenseFiles> findByExpFileSize(string|array<string> $exp_file_size) Return ChildExpenseFiles objects filtered by the exp_file_size column
 * @method     ChildExpenseFiles[]|Collection findByExpId(int|array<int> $exp_id) Return ChildExpenseFiles objects filtered by the exp_id column
 * @psalm-method Collection&\Traversable<ChildExpenseFiles> findByExpId(int|array<int> $exp_id) Return ChildExpenseFiles objects filtered by the exp_id column
 *
 * @method     ChildExpenseFiles[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildExpenseFiles> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class ExpenseFilesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\ExpenseFilesQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\ExpenseFiles', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildExpenseFilesQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildExpenseFilesQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildExpenseFilesQuery) {
            return $criteria;
        }
        $query = new ChildExpenseFilesQuery();
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
     * @return ChildExpenseFiles|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ExpenseFilesTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ExpenseFilesTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildExpenseFiles A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT exp_file_id, exp_file_name, exp_full_name, exp_mime, exp_file_size, exp_id FROM expense_files WHERE exp_file_id = :p0';
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
            /** @var ChildExpenseFiles $obj */
            $obj = new ChildExpenseFiles();
            $obj->hydrate($row);
            ExpenseFilesTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildExpenseFiles|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(ExpenseFilesTableMap::COL_EXP_FILE_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(ExpenseFilesTableMap::COL_EXP_FILE_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the exp_file_id column
     *
     * Example usage:
     * <code>
     * $query->filterByExpFileId(1234); // WHERE exp_file_id = 1234
     * $query->filterByExpFileId(array(12, 34)); // WHERE exp_file_id IN (12, 34)
     * $query->filterByExpFileId(array('min' => 12)); // WHERE exp_file_id > 12
     * </code>
     *
     * @param mixed $expFileId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpFileId($expFileId = null, ?string $comparison = null)
    {
        if (is_array($expFileId)) {
            $useMinMax = false;
            if (isset($expFileId['min'])) {
                $this->addUsingAlias(ExpenseFilesTableMap::COL_EXP_FILE_ID, $expFileId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($expFileId['max'])) {
                $this->addUsingAlias(ExpenseFilesTableMap::COL_EXP_FILE_ID, $expFileId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpenseFilesTableMap::COL_EXP_FILE_ID, $expFileId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the exp_file_name column
     *
     * Example usage:
     * <code>
     * $query->filterByExpFileName('fooValue');   // WHERE exp_file_name = 'fooValue'
     * $query->filterByExpFileName('%fooValue%', Criteria::LIKE); // WHERE exp_file_name LIKE '%fooValue%'
     * $query->filterByExpFileName(['foo', 'bar']); // WHERE exp_file_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $expFileName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpFileName($expFileName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($expFileName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpenseFilesTableMap::COL_EXP_FILE_NAME, $expFileName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the exp_full_name column
     *
     * Example usage:
     * <code>
     * $query->filterByExpFullName('fooValue');   // WHERE exp_full_name = 'fooValue'
     * $query->filterByExpFullName('%fooValue%', Criteria::LIKE); // WHERE exp_full_name LIKE '%fooValue%'
     * $query->filterByExpFullName(['foo', 'bar']); // WHERE exp_full_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $expFullName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpFullName($expFullName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($expFullName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpenseFilesTableMap::COL_EXP_FULL_NAME, $expFullName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the exp_mime column
     *
     * Example usage:
     * <code>
     * $query->filterByExpMime('fooValue');   // WHERE exp_mime = 'fooValue'
     * $query->filterByExpMime('%fooValue%', Criteria::LIKE); // WHERE exp_mime LIKE '%fooValue%'
     * $query->filterByExpMime(['foo', 'bar']); // WHERE exp_mime IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $expMime The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpMime($expMime = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($expMime)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpenseFilesTableMap::COL_EXP_MIME, $expMime, $comparison);

        return $this;
    }

    /**
     * Filter the query on the exp_file_size column
     *
     * Example usage:
     * <code>
     * $query->filterByExpFileSize('fooValue');   // WHERE exp_file_size = 'fooValue'
     * $query->filterByExpFileSize('%fooValue%', Criteria::LIKE); // WHERE exp_file_size LIKE '%fooValue%'
     * $query->filterByExpFileSize(['foo', 'bar']); // WHERE exp_file_size IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $expFileSize The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpFileSize($expFileSize = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($expFileSize)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpenseFilesTableMap::COL_EXP_FILE_SIZE, $expFileSize, $comparison);

        return $this;
    }

    /**
     * Filter the query on the exp_id column
     *
     * Example usage:
     * <code>
     * $query->filterByExpId(1234); // WHERE exp_id = 1234
     * $query->filterByExpId(array(12, 34)); // WHERE exp_id IN (12, 34)
     * $query->filterByExpId(array('min' => 12)); // WHERE exp_id > 12
     * </code>
     *
     * @see       filterByExpenses()
     *
     * @param mixed $expId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpId($expId = null, ?string $comparison = null)
    {
        if (is_array($expId)) {
            $useMinMax = false;
            if (isset($expId['min'])) {
                $this->addUsingAlias(ExpenseFilesTableMap::COL_EXP_ID, $expId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($expId['max'])) {
                $this->addUsingAlias(ExpenseFilesTableMap::COL_EXP_ID, $expId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpenseFilesTableMap::COL_EXP_ID, $expId, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \entities\Expenses object
     *
     * @param \entities\Expenses|ObjectCollection $expenses The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpenses($expenses, ?string $comparison = null)
    {
        if ($expenses instanceof \entities\Expenses) {
            return $this
                ->addUsingAlias(ExpenseFilesTableMap::COL_EXP_ID, $expenses->getExpId(), $comparison);
        } elseif ($expenses instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(ExpenseFilesTableMap::COL_EXP_ID, $expenses->toKeyValue('PrimaryKey', 'ExpId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByExpenses() only accepts arguments of type \entities\Expenses or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Expenses relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinExpenses(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Expenses');

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
            $this->addJoinObject($join, 'Expenses');
        }

        return $this;
    }

    /**
     * Use the Expenses relation Expenses object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\ExpensesQuery A secondary query class using the current class as primary query
     */
    public function useExpensesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinExpenses($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Expenses', '\entities\ExpensesQuery');
    }

    /**
     * Use the Expenses relation Expenses object
     *
     * @param callable(\entities\ExpensesQuery):\entities\ExpensesQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withExpensesQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useExpensesQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Expenses table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\ExpensesQuery The inner query object of the EXISTS statement
     */
    public function useExpensesExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\ExpensesQuery */
        $q = $this->useExistsQuery('Expenses', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Expenses table for a NOT EXISTS query.
     *
     * @see useExpensesExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\ExpensesQuery The inner query object of the NOT EXISTS statement
     */
    public function useExpensesNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\ExpensesQuery */
        $q = $this->useExistsQuery('Expenses', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Expenses table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\ExpensesQuery The inner query object of the IN statement
     */
    public function useInExpensesQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\ExpensesQuery */
        $q = $this->useInQuery('Expenses', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Expenses table for a NOT IN query.
     *
     * @see useExpensesInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\ExpensesQuery The inner query object of the NOT IN statement
     */
    public function useNotInExpensesQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\ExpensesQuery */
        $q = $this->useInQuery('Expenses', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildExpenseFiles $expenseFiles Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($expenseFiles = null)
    {
        if ($expenseFiles) {
            $this->addUsingAlias(ExpenseFilesTableMap::COL_EXP_FILE_ID, $expenseFiles->getExpFileId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the expense_files table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ExpenseFilesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ExpenseFilesTableMap::clearInstancePool();
            ExpenseFilesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ExpenseFilesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ExpenseFilesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ExpenseFilesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ExpenseFilesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
