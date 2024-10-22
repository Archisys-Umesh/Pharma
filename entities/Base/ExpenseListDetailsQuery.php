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
use entities\ExpenseListDetails as ChildExpenseListDetails;
use entities\ExpenseListDetailsQuery as ChildExpenseListDetailsQuery;
use entities\Map\ExpenseListDetailsTableMap;

/**
 * Base class that represents a query for the `expense_list_details` table.
 *
 * @method     ChildExpenseListDetailsQuery orderByExpDetId($order = Criteria::ASC) Order by the exp_det_id column
 * @method     ChildExpenseListDetailsQuery orderByExpListId($order = Criteria::ASC) Order by the exp_list_id column
 * @method     ChildExpenseListDetailsQuery orderByImage($order = Criteria::ASC) Order by the image column
 * @method     ChildExpenseListDetailsQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ChildExpenseListDetailsQuery orderByAmount($order = Criteria::ASC) Order by the amount column
 * @method     ChildExpenseListDetailsQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildExpenseListDetailsQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildExpenseListDetailsQuery groupByExpDetId() Group by the exp_det_id column
 * @method     ChildExpenseListDetailsQuery groupByExpListId() Group by the exp_list_id column
 * @method     ChildExpenseListDetailsQuery groupByImage() Group by the image column
 * @method     ChildExpenseListDetailsQuery groupByDescription() Group by the description column
 * @method     ChildExpenseListDetailsQuery groupByAmount() Group by the amount column
 * @method     ChildExpenseListDetailsQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildExpenseListDetailsQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildExpenseListDetailsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildExpenseListDetailsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildExpenseListDetailsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildExpenseListDetailsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildExpenseListDetailsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildExpenseListDetailsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildExpenseListDetailsQuery leftJoinExpenseList($relationAlias = null) Adds a LEFT JOIN clause to the query using the ExpenseList relation
 * @method     ChildExpenseListDetailsQuery rightJoinExpenseList($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ExpenseList relation
 * @method     ChildExpenseListDetailsQuery innerJoinExpenseList($relationAlias = null) Adds a INNER JOIN clause to the query using the ExpenseList relation
 *
 * @method     ChildExpenseListDetailsQuery joinWithExpenseList($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ExpenseList relation
 *
 * @method     ChildExpenseListDetailsQuery leftJoinWithExpenseList() Adds a LEFT JOIN clause and with to the query using the ExpenseList relation
 * @method     ChildExpenseListDetailsQuery rightJoinWithExpenseList() Adds a RIGHT JOIN clause and with to the query using the ExpenseList relation
 * @method     ChildExpenseListDetailsQuery innerJoinWithExpenseList() Adds a INNER JOIN clause and with to the query using the ExpenseList relation
 *
 * @method     \entities\ExpenseListQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildExpenseListDetails|null findOne(?ConnectionInterface $con = null) Return the first ChildExpenseListDetails matching the query
 * @method     ChildExpenseListDetails findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildExpenseListDetails matching the query, or a new ChildExpenseListDetails object populated from the query conditions when no match is found
 *
 * @method     ChildExpenseListDetails|null findOneByExpDetId(int $exp_det_id) Return the first ChildExpenseListDetails filtered by the exp_det_id column
 * @method     ChildExpenseListDetails|null findOneByExpListId(int $exp_list_id) Return the first ChildExpenseListDetails filtered by the exp_list_id column
 * @method     ChildExpenseListDetails|null findOneByImage(string $image) Return the first ChildExpenseListDetails filtered by the image column
 * @method     ChildExpenseListDetails|null findOneByDescription(string $description) Return the first ChildExpenseListDetails filtered by the description column
 * @method     ChildExpenseListDetails|null findOneByAmount(string $amount) Return the first ChildExpenseListDetails filtered by the amount column
 * @method     ChildExpenseListDetails|null findOneByCreatedAt(string $created_at) Return the first ChildExpenseListDetails filtered by the created_at column
 * @method     ChildExpenseListDetails|null findOneByUpdatedAt(string $updated_at) Return the first ChildExpenseListDetails filtered by the updated_at column
 *
 * @method     ChildExpenseListDetails requirePk($key, ?ConnectionInterface $con = null) Return the ChildExpenseListDetails by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseListDetails requireOne(?ConnectionInterface $con = null) Return the first ChildExpenseListDetails matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildExpenseListDetails requireOneByExpDetId(int $exp_det_id) Return the first ChildExpenseListDetails filtered by the exp_det_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseListDetails requireOneByExpListId(int $exp_list_id) Return the first ChildExpenseListDetails filtered by the exp_list_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseListDetails requireOneByImage(string $image) Return the first ChildExpenseListDetails filtered by the image column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseListDetails requireOneByDescription(string $description) Return the first ChildExpenseListDetails filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseListDetails requireOneByAmount(string $amount) Return the first ChildExpenseListDetails filtered by the amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseListDetails requireOneByCreatedAt(string $created_at) Return the first ChildExpenseListDetails filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseListDetails requireOneByUpdatedAt(string $updated_at) Return the first ChildExpenseListDetails filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildExpenseListDetails[]|Collection find(?ConnectionInterface $con = null) Return ChildExpenseListDetails objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildExpenseListDetails> find(?ConnectionInterface $con = null) Return ChildExpenseListDetails objects based on current ModelCriteria
 *
 * @method     ChildExpenseListDetails[]|Collection findByExpDetId(int|array<int> $exp_det_id) Return ChildExpenseListDetails objects filtered by the exp_det_id column
 * @psalm-method Collection&\Traversable<ChildExpenseListDetails> findByExpDetId(int|array<int> $exp_det_id) Return ChildExpenseListDetails objects filtered by the exp_det_id column
 * @method     ChildExpenseListDetails[]|Collection findByExpListId(int|array<int> $exp_list_id) Return ChildExpenseListDetails objects filtered by the exp_list_id column
 * @psalm-method Collection&\Traversable<ChildExpenseListDetails> findByExpListId(int|array<int> $exp_list_id) Return ChildExpenseListDetails objects filtered by the exp_list_id column
 * @method     ChildExpenseListDetails[]|Collection findByImage(string|array<string> $image) Return ChildExpenseListDetails objects filtered by the image column
 * @psalm-method Collection&\Traversable<ChildExpenseListDetails> findByImage(string|array<string> $image) Return ChildExpenseListDetails objects filtered by the image column
 * @method     ChildExpenseListDetails[]|Collection findByDescription(string|array<string> $description) Return ChildExpenseListDetails objects filtered by the description column
 * @psalm-method Collection&\Traversable<ChildExpenseListDetails> findByDescription(string|array<string> $description) Return ChildExpenseListDetails objects filtered by the description column
 * @method     ChildExpenseListDetails[]|Collection findByAmount(string|array<string> $amount) Return ChildExpenseListDetails objects filtered by the amount column
 * @psalm-method Collection&\Traversable<ChildExpenseListDetails> findByAmount(string|array<string> $amount) Return ChildExpenseListDetails objects filtered by the amount column
 * @method     ChildExpenseListDetails[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildExpenseListDetails objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildExpenseListDetails> findByCreatedAt(string|array<string> $created_at) Return ChildExpenseListDetails objects filtered by the created_at column
 * @method     ChildExpenseListDetails[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildExpenseListDetails objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildExpenseListDetails> findByUpdatedAt(string|array<string> $updated_at) Return ChildExpenseListDetails objects filtered by the updated_at column
 *
 * @method     ChildExpenseListDetails[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildExpenseListDetails> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class ExpenseListDetailsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\ExpenseListDetailsQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\ExpenseListDetails', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildExpenseListDetailsQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildExpenseListDetailsQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildExpenseListDetailsQuery) {
            return $criteria;
        }
        $query = new ChildExpenseListDetailsQuery();
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
     * @return ChildExpenseListDetails|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ExpenseListDetailsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ExpenseListDetailsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildExpenseListDetails A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT exp_det_id, exp_list_id, image, description, amount, created_at, updated_at FROM expense_list_details WHERE exp_det_id = :p0';
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
            /** @var ChildExpenseListDetails $obj */
            $obj = new ChildExpenseListDetails();
            $obj->hydrate($row);
            ExpenseListDetailsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildExpenseListDetails|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(ExpenseListDetailsTableMap::COL_EXP_DET_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(ExpenseListDetailsTableMap::COL_EXP_DET_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the exp_det_id column
     *
     * Example usage:
     * <code>
     * $query->filterByExpDetId(1234); // WHERE exp_det_id = 1234
     * $query->filterByExpDetId(array(12, 34)); // WHERE exp_det_id IN (12, 34)
     * $query->filterByExpDetId(array('min' => 12)); // WHERE exp_det_id > 12
     * </code>
     *
     * @param mixed $expDetId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpDetId($expDetId = null, ?string $comparison = null)
    {
        if (is_array($expDetId)) {
            $useMinMax = false;
            if (isset($expDetId['min'])) {
                $this->addUsingAlias(ExpenseListDetailsTableMap::COL_EXP_DET_ID, $expDetId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($expDetId['max'])) {
                $this->addUsingAlias(ExpenseListDetailsTableMap::COL_EXP_DET_ID, $expDetId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpenseListDetailsTableMap::COL_EXP_DET_ID, $expDetId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the exp_list_id column
     *
     * Example usage:
     * <code>
     * $query->filterByExpListId(1234); // WHERE exp_list_id = 1234
     * $query->filterByExpListId(array(12, 34)); // WHERE exp_list_id IN (12, 34)
     * $query->filterByExpListId(array('min' => 12)); // WHERE exp_list_id > 12
     * </code>
     *
     * @see       filterByExpenseList()
     *
     * @param mixed $expListId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpListId($expListId = null, ?string $comparison = null)
    {
        if (is_array($expListId)) {
            $useMinMax = false;
            if (isset($expListId['min'])) {
                $this->addUsingAlias(ExpenseListDetailsTableMap::COL_EXP_LIST_ID, $expListId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($expListId['max'])) {
                $this->addUsingAlias(ExpenseListDetailsTableMap::COL_EXP_LIST_ID, $expListId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpenseListDetailsTableMap::COL_EXP_LIST_ID, $expListId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the image column
     *
     * Example usage:
     * <code>
     * $query->filterByImage('fooValue');   // WHERE image = 'fooValue'
     * $query->filterByImage('%fooValue%', Criteria::LIKE); // WHERE image LIKE '%fooValue%'
     * $query->filterByImage(['foo', 'bar']); // WHERE image IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $image The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByImage($image = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($image)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpenseListDetailsTableMap::COL_IMAGE, $image, $comparison);

        return $this;
    }

    /**
     * Filter the query on the description column
     *
     * Example usage:
     * <code>
     * $query->filterByDescription('fooValue');   // WHERE description = 'fooValue'
     * $query->filterByDescription('%fooValue%', Criteria::LIKE); // WHERE description LIKE '%fooValue%'
     * $query->filterByDescription(['foo', 'bar']); // WHERE description IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $description The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDescription($description = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpenseListDetailsTableMap::COL_DESCRIPTION, $description, $comparison);

        return $this;
    }

    /**
     * Filter the query on the amount column
     *
     * Example usage:
     * <code>
     * $query->filterByAmount(1234); // WHERE amount = 1234
     * $query->filterByAmount(array(12, 34)); // WHERE amount IN (12, 34)
     * $query->filterByAmount(array('min' => 12)); // WHERE amount > 12
     * </code>
     *
     * @param mixed $amount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAmount($amount = null, ?string $comparison = null)
    {
        if (is_array($amount)) {
            $useMinMax = false;
            if (isset($amount['min'])) {
                $this->addUsingAlias(ExpenseListDetailsTableMap::COL_AMOUNT, $amount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($amount['max'])) {
                $this->addUsingAlias(ExpenseListDetailsTableMap::COL_AMOUNT, $amount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpenseListDetailsTableMap::COL_AMOUNT, $amount, $comparison);

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
                $this->addUsingAlias(ExpenseListDetailsTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(ExpenseListDetailsTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpenseListDetailsTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(ExpenseListDetailsTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(ExpenseListDetailsTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpenseListDetailsTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \entities\ExpenseList object
     *
     * @param \entities\ExpenseList|ObjectCollection $expenseList The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpenseList($expenseList, ?string $comparison = null)
    {
        if ($expenseList instanceof \entities\ExpenseList) {
            return $this
                ->addUsingAlias(ExpenseListDetailsTableMap::COL_EXP_LIST_ID, $expenseList->getExpListId(), $comparison);
        } elseif ($expenseList instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(ExpenseListDetailsTableMap::COL_EXP_LIST_ID, $expenseList->toKeyValue('PrimaryKey', 'ExpListId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByExpenseList() only accepts arguments of type \entities\ExpenseList or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ExpenseList relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinExpenseList(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ExpenseList');

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
            $this->addJoinObject($join, 'ExpenseList');
        }

        return $this;
    }

    /**
     * Use the ExpenseList relation ExpenseList object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\ExpenseListQuery A secondary query class using the current class as primary query
     */
    public function useExpenseListQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinExpenseList($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ExpenseList', '\entities\ExpenseListQuery');
    }

    /**
     * Use the ExpenseList relation ExpenseList object
     *
     * @param callable(\entities\ExpenseListQuery):\entities\ExpenseListQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withExpenseListQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useExpenseListQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to ExpenseList table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\ExpenseListQuery The inner query object of the EXISTS statement
     */
    public function useExpenseListExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\ExpenseListQuery */
        $q = $this->useExistsQuery('ExpenseList', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to ExpenseList table for a NOT EXISTS query.
     *
     * @see useExpenseListExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\ExpenseListQuery The inner query object of the NOT EXISTS statement
     */
    public function useExpenseListNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\ExpenseListQuery */
        $q = $this->useExistsQuery('ExpenseList', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to ExpenseList table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\ExpenseListQuery The inner query object of the IN statement
     */
    public function useInExpenseListQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\ExpenseListQuery */
        $q = $this->useInQuery('ExpenseList', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to ExpenseList table for a NOT IN query.
     *
     * @see useExpenseListInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\ExpenseListQuery The inner query object of the NOT IN statement
     */
    public function useNotInExpenseListQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\ExpenseListQuery */
        $q = $this->useInQuery('ExpenseList', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildExpenseListDetails $expenseListDetails Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($expenseListDetails = null)
    {
        if ($expenseListDetails) {
            $this->addUsingAlias(ExpenseListDetailsTableMap::COL_EXP_DET_ID, $expenseListDetails->getExpDetId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the expense_list_details table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ExpenseListDetailsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ExpenseListDetailsTableMap::clearInstancePool();
            ExpenseListDetailsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ExpenseListDetailsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ExpenseListDetailsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ExpenseListDetailsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ExpenseListDetailsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
