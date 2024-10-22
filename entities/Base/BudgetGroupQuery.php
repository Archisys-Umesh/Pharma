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
use entities\BudgetGroup as ChildBudgetGroup;
use entities\BudgetGroupQuery as ChildBudgetGroupQuery;
use entities\Map\BudgetGroupTableMap;

/**
 * Base class that represents a query for the `budget_group` table.
 *
 * @method     ChildBudgetGroupQuery orderByBgid($order = Criteria::ASC) Order by the bgid column
 * @method     ChildBudgetGroupQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildBudgetGroupQuery orderByGroupName($order = Criteria::ASC) Order by the group_name column
 * @method     ChildBudgetGroupQuery orderByGroupcode($order = Criteria::ASC) Order by the groupcode column
 * @method     ChildBudgetGroupQuery orderByMaxlimit($order = Criteria::ASC) Order by the maxlimit column
 * @method     ChildBudgetGroupQuery orderByNotes($order = Criteria::ASC) Order by the notes column
 * @method     ChildBudgetGroupQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method     ChildBudgetGroupQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildBudgetGroupQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildBudgetGroupQuery orderByIsDefault($order = Criteria::ASC) Order by the is_default column
 *
 * @method     ChildBudgetGroupQuery groupByBgid() Group by the bgid column
 * @method     ChildBudgetGroupQuery groupByCompanyId() Group by the company_id column
 * @method     ChildBudgetGroupQuery groupByGroupName() Group by the group_name column
 * @method     ChildBudgetGroupQuery groupByGroupcode() Group by the groupcode column
 * @method     ChildBudgetGroupQuery groupByMaxlimit() Group by the maxlimit column
 * @method     ChildBudgetGroupQuery groupByNotes() Group by the notes column
 * @method     ChildBudgetGroupQuery groupByStatus() Group by the status column
 * @method     ChildBudgetGroupQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildBudgetGroupQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildBudgetGroupQuery groupByIsDefault() Group by the is_default column
 *
 * @method     ChildBudgetGroupQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildBudgetGroupQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildBudgetGroupQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildBudgetGroupQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildBudgetGroupQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildBudgetGroupQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildBudgetGroupQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildBudgetGroupQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildBudgetGroupQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildBudgetGroupQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildBudgetGroupQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildBudgetGroupQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildBudgetGroupQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     ChildBudgetGroupQuery leftJoinBudgetExp($relationAlias = null) Adds a LEFT JOIN clause to the query using the BudgetExp relation
 * @method     ChildBudgetGroupQuery rightJoinBudgetExp($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BudgetExp relation
 * @method     ChildBudgetGroupQuery innerJoinBudgetExp($relationAlias = null) Adds a INNER JOIN clause to the query using the BudgetExp relation
 *
 * @method     ChildBudgetGroupQuery joinWithBudgetExp($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BudgetExp relation
 *
 * @method     ChildBudgetGroupQuery leftJoinWithBudgetExp() Adds a LEFT JOIN clause and with to the query using the BudgetExp relation
 * @method     ChildBudgetGroupQuery rightJoinWithBudgetExp() Adds a RIGHT JOIN clause and with to the query using the BudgetExp relation
 * @method     ChildBudgetGroupQuery innerJoinWithBudgetExp() Adds a INNER JOIN clause and with to the query using the BudgetExp relation
 *
 * @method     ChildBudgetGroupQuery leftJoinBudgetGrades($relationAlias = null) Adds a LEFT JOIN clause to the query using the BudgetGrades relation
 * @method     ChildBudgetGroupQuery rightJoinBudgetGrades($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BudgetGrades relation
 * @method     ChildBudgetGroupQuery innerJoinBudgetGrades($relationAlias = null) Adds a INNER JOIN clause to the query using the BudgetGrades relation
 *
 * @method     ChildBudgetGroupQuery joinWithBudgetGrades($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BudgetGrades relation
 *
 * @method     ChildBudgetGroupQuery leftJoinWithBudgetGrades() Adds a LEFT JOIN clause and with to the query using the BudgetGrades relation
 * @method     ChildBudgetGroupQuery rightJoinWithBudgetGrades() Adds a RIGHT JOIN clause and with to the query using the BudgetGrades relation
 * @method     ChildBudgetGroupQuery innerJoinWithBudgetGrades() Adds a INNER JOIN clause and with to the query using the BudgetGrades relation
 *
 * @method     ChildBudgetGroupQuery leftJoinExpenses($relationAlias = null) Adds a LEFT JOIN clause to the query using the Expenses relation
 * @method     ChildBudgetGroupQuery rightJoinExpenses($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Expenses relation
 * @method     ChildBudgetGroupQuery innerJoinExpenses($relationAlias = null) Adds a INNER JOIN clause to the query using the Expenses relation
 *
 * @method     ChildBudgetGroupQuery joinWithExpenses($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Expenses relation
 *
 * @method     ChildBudgetGroupQuery leftJoinWithExpenses() Adds a LEFT JOIN clause and with to the query using the Expenses relation
 * @method     ChildBudgetGroupQuery rightJoinWithExpenses() Adds a RIGHT JOIN clause and with to the query using the Expenses relation
 * @method     ChildBudgetGroupQuery innerJoinWithExpenses() Adds a INNER JOIN clause and with to the query using the Expenses relation
 *
 * @method     \entities\CompanyQuery|\entities\BudgetExpQuery|\entities\BudgetGradesQuery|\entities\ExpensesQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildBudgetGroup|null findOne(?ConnectionInterface $con = null) Return the first ChildBudgetGroup matching the query
 * @method     ChildBudgetGroup findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildBudgetGroup matching the query, or a new ChildBudgetGroup object populated from the query conditions when no match is found
 *
 * @method     ChildBudgetGroup|null findOneByBgid(int $bgid) Return the first ChildBudgetGroup filtered by the bgid column
 * @method     ChildBudgetGroup|null findOneByCompanyId(int $company_id) Return the first ChildBudgetGroup filtered by the company_id column
 * @method     ChildBudgetGroup|null findOneByGroupName(string $group_name) Return the first ChildBudgetGroup filtered by the group_name column
 * @method     ChildBudgetGroup|null findOneByGroupcode(string $groupcode) Return the first ChildBudgetGroup filtered by the groupcode column
 * @method     ChildBudgetGroup|null findOneByMaxlimit(string $maxlimit) Return the first ChildBudgetGroup filtered by the maxlimit column
 * @method     ChildBudgetGroup|null findOneByNotes(string $notes) Return the first ChildBudgetGroup filtered by the notes column
 * @method     ChildBudgetGroup|null findOneByStatus(int $status) Return the first ChildBudgetGroup filtered by the status column
 * @method     ChildBudgetGroup|null findOneByCreatedAt(string $created_at) Return the first ChildBudgetGroup filtered by the created_at column
 * @method     ChildBudgetGroup|null findOneByUpdatedAt(string $updated_at) Return the first ChildBudgetGroup filtered by the updated_at column
 * @method     ChildBudgetGroup|null findOneByIsDefault(boolean $is_default) Return the first ChildBudgetGroup filtered by the is_default column
 *
 * @method     ChildBudgetGroup requirePk($key, ?ConnectionInterface $con = null) Return the ChildBudgetGroup by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBudgetGroup requireOne(?ConnectionInterface $con = null) Return the first ChildBudgetGroup matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBudgetGroup requireOneByBgid(int $bgid) Return the first ChildBudgetGroup filtered by the bgid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBudgetGroup requireOneByCompanyId(int $company_id) Return the first ChildBudgetGroup filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBudgetGroup requireOneByGroupName(string $group_name) Return the first ChildBudgetGroup filtered by the group_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBudgetGroup requireOneByGroupcode(string $groupcode) Return the first ChildBudgetGroup filtered by the groupcode column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBudgetGroup requireOneByMaxlimit(string $maxlimit) Return the first ChildBudgetGroup filtered by the maxlimit column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBudgetGroup requireOneByNotes(string $notes) Return the first ChildBudgetGroup filtered by the notes column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBudgetGroup requireOneByStatus(int $status) Return the first ChildBudgetGroup filtered by the status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBudgetGroup requireOneByCreatedAt(string $created_at) Return the first ChildBudgetGroup filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBudgetGroup requireOneByUpdatedAt(string $updated_at) Return the first ChildBudgetGroup filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBudgetGroup requireOneByIsDefault(boolean $is_default) Return the first ChildBudgetGroup filtered by the is_default column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBudgetGroup[]|Collection find(?ConnectionInterface $con = null) Return ChildBudgetGroup objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildBudgetGroup> find(?ConnectionInterface $con = null) Return ChildBudgetGroup objects based on current ModelCriteria
 *
 * @method     ChildBudgetGroup[]|Collection findByBgid(int|array<int> $bgid) Return ChildBudgetGroup objects filtered by the bgid column
 * @psalm-method Collection&\Traversable<ChildBudgetGroup> findByBgid(int|array<int> $bgid) Return ChildBudgetGroup objects filtered by the bgid column
 * @method     ChildBudgetGroup[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildBudgetGroup objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildBudgetGroup> findByCompanyId(int|array<int> $company_id) Return ChildBudgetGroup objects filtered by the company_id column
 * @method     ChildBudgetGroup[]|Collection findByGroupName(string|array<string> $group_name) Return ChildBudgetGroup objects filtered by the group_name column
 * @psalm-method Collection&\Traversable<ChildBudgetGroup> findByGroupName(string|array<string> $group_name) Return ChildBudgetGroup objects filtered by the group_name column
 * @method     ChildBudgetGroup[]|Collection findByGroupcode(string|array<string> $groupcode) Return ChildBudgetGroup objects filtered by the groupcode column
 * @psalm-method Collection&\Traversable<ChildBudgetGroup> findByGroupcode(string|array<string> $groupcode) Return ChildBudgetGroup objects filtered by the groupcode column
 * @method     ChildBudgetGroup[]|Collection findByMaxlimit(string|array<string> $maxlimit) Return ChildBudgetGroup objects filtered by the maxlimit column
 * @psalm-method Collection&\Traversable<ChildBudgetGroup> findByMaxlimit(string|array<string> $maxlimit) Return ChildBudgetGroup objects filtered by the maxlimit column
 * @method     ChildBudgetGroup[]|Collection findByNotes(string|array<string> $notes) Return ChildBudgetGroup objects filtered by the notes column
 * @psalm-method Collection&\Traversable<ChildBudgetGroup> findByNotes(string|array<string> $notes) Return ChildBudgetGroup objects filtered by the notes column
 * @method     ChildBudgetGroup[]|Collection findByStatus(int|array<int> $status) Return ChildBudgetGroup objects filtered by the status column
 * @psalm-method Collection&\Traversable<ChildBudgetGroup> findByStatus(int|array<int> $status) Return ChildBudgetGroup objects filtered by the status column
 * @method     ChildBudgetGroup[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildBudgetGroup objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildBudgetGroup> findByCreatedAt(string|array<string> $created_at) Return ChildBudgetGroup objects filtered by the created_at column
 * @method     ChildBudgetGroup[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildBudgetGroup objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildBudgetGroup> findByUpdatedAt(string|array<string> $updated_at) Return ChildBudgetGroup objects filtered by the updated_at column
 * @method     ChildBudgetGroup[]|Collection findByIsDefault(boolean|array<boolean> $is_default) Return ChildBudgetGroup objects filtered by the is_default column
 * @psalm-method Collection&\Traversable<ChildBudgetGroup> findByIsDefault(boolean|array<boolean> $is_default) Return ChildBudgetGroup objects filtered by the is_default column
 *
 * @method     ChildBudgetGroup[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildBudgetGroup> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class BudgetGroupQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\BudgetGroupQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\BudgetGroup', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildBudgetGroupQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildBudgetGroupQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildBudgetGroupQuery) {
            return $criteria;
        }
        $query = new ChildBudgetGroupQuery();
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
     * @return ChildBudgetGroup|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(BudgetGroupTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = BudgetGroupTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildBudgetGroup A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT bgid, company_id, group_name, groupcode, maxlimit, notes, status, created_at, updated_at, is_default FROM budget_group WHERE bgid = :p0';
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
            /** @var ChildBudgetGroup $obj */
            $obj = new ChildBudgetGroup();
            $obj->hydrate($row);
            BudgetGroupTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildBudgetGroup|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(BudgetGroupTableMap::COL_BGID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(BudgetGroupTableMap::COL_BGID, $keys, Criteria::IN);

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
                $this->addUsingAlias(BudgetGroupTableMap::COL_BGID, $bgid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($bgid['max'])) {
                $this->addUsingAlias(BudgetGroupTableMap::COL_BGID, $bgid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BudgetGroupTableMap::COL_BGID, $bgid, $comparison);

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
     * @see       filterByCompany()
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
                $this->addUsingAlias(BudgetGroupTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(BudgetGroupTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BudgetGroupTableMap::COL_COMPANY_ID, $companyId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the group_name column
     *
     * Example usage:
     * <code>
     * $query->filterByGroupName('fooValue');   // WHERE group_name = 'fooValue'
     * $query->filterByGroupName('%fooValue%', Criteria::LIKE); // WHERE group_name LIKE '%fooValue%'
     * $query->filterByGroupName(['foo', 'bar']); // WHERE group_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $groupName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByGroupName($groupName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($groupName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BudgetGroupTableMap::COL_GROUP_NAME, $groupName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the groupcode column
     *
     * Example usage:
     * <code>
     * $query->filterByGroupcode('fooValue');   // WHERE groupcode = 'fooValue'
     * $query->filterByGroupcode('%fooValue%', Criteria::LIKE); // WHERE groupcode LIKE '%fooValue%'
     * $query->filterByGroupcode(['foo', 'bar']); // WHERE groupcode IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $groupcode The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByGroupcode($groupcode = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($groupcode)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BudgetGroupTableMap::COL_GROUPCODE, $groupcode, $comparison);

        return $this;
    }

    /**
     * Filter the query on the maxlimit column
     *
     * Example usage:
     * <code>
     * $query->filterByMaxlimit(1234); // WHERE maxlimit = 1234
     * $query->filterByMaxlimit(array(12, 34)); // WHERE maxlimit IN (12, 34)
     * $query->filterByMaxlimit(array('min' => 12)); // WHERE maxlimit > 12
     * </code>
     *
     * @param mixed $maxlimit The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMaxlimit($maxlimit = null, ?string $comparison = null)
    {
        if (is_array($maxlimit)) {
            $useMinMax = false;
            if (isset($maxlimit['min'])) {
                $this->addUsingAlias(BudgetGroupTableMap::COL_MAXLIMIT, $maxlimit['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($maxlimit['max'])) {
                $this->addUsingAlias(BudgetGroupTableMap::COL_MAXLIMIT, $maxlimit['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BudgetGroupTableMap::COL_MAXLIMIT, $maxlimit, $comparison);

        return $this;
    }

    /**
     * Filter the query on the notes column
     *
     * Example usage:
     * <code>
     * $query->filterByNotes('fooValue');   // WHERE notes = 'fooValue'
     * $query->filterByNotes('%fooValue%', Criteria::LIKE); // WHERE notes LIKE '%fooValue%'
     * $query->filterByNotes(['foo', 'bar']); // WHERE notes IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $notes The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByNotes($notes = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($notes)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BudgetGroupTableMap::COL_NOTES, $notes, $comparison);

        return $this;
    }

    /**
     * Filter the query on the status column
     *
     * Example usage:
     * <code>
     * $query->filterByStatus(1234); // WHERE status = 1234
     * $query->filterByStatus(array(12, 34)); // WHERE status IN (12, 34)
     * $query->filterByStatus(array('min' => 12)); // WHERE status > 12
     * </code>
     *
     * @param mixed $status The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStatus($status = null, ?string $comparison = null)
    {
        if (is_array($status)) {
            $useMinMax = false;
            if (isset($status['min'])) {
                $this->addUsingAlias(BudgetGroupTableMap::COL_STATUS, $status['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($status['max'])) {
                $this->addUsingAlias(BudgetGroupTableMap::COL_STATUS, $status['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BudgetGroupTableMap::COL_STATUS, $status, $comparison);

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
                $this->addUsingAlias(BudgetGroupTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(BudgetGroupTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BudgetGroupTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(BudgetGroupTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(BudgetGroupTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BudgetGroupTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the is_default column
     *
     * Example usage:
     * <code>
     * $query->filterByIsDefault(true); // WHERE is_default = true
     * $query->filterByIsDefault('yes'); // WHERE is_default = true
     * </code>
     *
     * @param bool|string $isDefault The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIsDefault($isDefault = null, ?string $comparison = null)
    {
        if (is_string($isDefault)) {
            $isDefault = in_array(strtolower($isDefault), array('false', 'off', '-', 'no', 'n', '0', ''), true) ? false : true;
        }

        $this->addUsingAlias(BudgetGroupTableMap::COL_IS_DEFAULT, $isDefault, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \entities\Company object
     *
     * @param \entities\Company|ObjectCollection $company The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCompany($company, ?string $comparison = null)
    {
        if ($company instanceof \entities\Company) {
            return $this
                ->addUsingAlias(BudgetGroupTableMap::COL_COMPANY_ID, $company->getCompanyId(), $comparison);
        } elseif ($company instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(BudgetGroupTableMap::COL_COMPANY_ID, $company->toKeyValue('PrimaryKey', 'CompanyId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByCompany() only accepts arguments of type \entities\Company or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Company relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinCompany(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Company');

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
            $this->addJoinObject($join, 'Company');
        }

        return $this;
    }

    /**
     * Use the Company relation Company object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\CompanyQuery A secondary query class using the current class as primary query
     */
    public function useCompanyQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCompany($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Company', '\entities\CompanyQuery');
    }

    /**
     * Use the Company relation Company object
     *
     * @param callable(\entities\CompanyQuery):\entities\CompanyQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withCompanyQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useCompanyQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Company table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\CompanyQuery The inner query object of the EXISTS statement
     */
    public function useCompanyExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\CompanyQuery */
        $q = $this->useExistsQuery('Company', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Company table for a NOT EXISTS query.
     *
     * @see useCompanyExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\CompanyQuery The inner query object of the NOT EXISTS statement
     */
    public function useCompanyNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\CompanyQuery */
        $q = $this->useExistsQuery('Company', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Company table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\CompanyQuery The inner query object of the IN statement
     */
    public function useInCompanyQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\CompanyQuery */
        $q = $this->useInQuery('Company', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Company table for a NOT IN query.
     *
     * @see useCompanyInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\CompanyQuery The inner query object of the NOT IN statement
     */
    public function useNotInCompanyQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\CompanyQuery */
        $q = $this->useInQuery('Company', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\BudgetExp object
     *
     * @param \entities\BudgetExp|ObjectCollection $budgetExp the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBudgetExp($budgetExp, ?string $comparison = null)
    {
        if ($budgetExp instanceof \entities\BudgetExp) {
            $this
                ->addUsingAlias(BudgetGroupTableMap::COL_BGID, $budgetExp->getBgid(), $comparison);

            return $this;
        } elseif ($budgetExp instanceof ObjectCollection) {
            $this
                ->useBudgetExpQuery()
                ->filterByPrimaryKeys($budgetExp->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByBudgetExp() only accepts arguments of type \entities\BudgetExp or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BudgetExp relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinBudgetExp(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BudgetExp');

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
            $this->addJoinObject($join, 'BudgetExp');
        }

        return $this;
    }

    /**
     * Use the BudgetExp relation BudgetExp object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\BudgetExpQuery A secondary query class using the current class as primary query
     */
    public function useBudgetExpQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinBudgetExp($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BudgetExp', '\entities\BudgetExpQuery');
    }

    /**
     * Use the BudgetExp relation BudgetExp object
     *
     * @param callable(\entities\BudgetExpQuery):\entities\BudgetExpQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withBudgetExpQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useBudgetExpQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to BudgetExp table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\BudgetExpQuery The inner query object of the EXISTS statement
     */
    public function useBudgetExpExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\BudgetExpQuery */
        $q = $this->useExistsQuery('BudgetExp', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to BudgetExp table for a NOT EXISTS query.
     *
     * @see useBudgetExpExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\BudgetExpQuery The inner query object of the NOT EXISTS statement
     */
    public function useBudgetExpNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\BudgetExpQuery */
        $q = $this->useExistsQuery('BudgetExp', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to BudgetExp table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\BudgetExpQuery The inner query object of the IN statement
     */
    public function useInBudgetExpQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\BudgetExpQuery */
        $q = $this->useInQuery('BudgetExp', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to BudgetExp table for a NOT IN query.
     *
     * @see useBudgetExpInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\BudgetExpQuery The inner query object of the NOT IN statement
     */
    public function useNotInBudgetExpQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\BudgetExpQuery */
        $q = $this->useInQuery('BudgetExp', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\BudgetGrades object
     *
     * @param \entities\BudgetGrades|ObjectCollection $budgetGrades the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBudgetGrades($budgetGrades, ?string $comparison = null)
    {
        if ($budgetGrades instanceof \entities\BudgetGrades) {
            $this
                ->addUsingAlias(BudgetGroupTableMap::COL_BGID, $budgetGrades->getBgid(), $comparison);

            return $this;
        } elseif ($budgetGrades instanceof ObjectCollection) {
            $this
                ->useBudgetGradesQuery()
                ->filterByPrimaryKeys($budgetGrades->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByBudgetGrades() only accepts arguments of type \entities\BudgetGrades or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BudgetGrades relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinBudgetGrades(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BudgetGrades');

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
            $this->addJoinObject($join, 'BudgetGrades');
        }

        return $this;
    }

    /**
     * Use the BudgetGrades relation BudgetGrades object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\BudgetGradesQuery A secondary query class using the current class as primary query
     */
    public function useBudgetGradesQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinBudgetGrades($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BudgetGrades', '\entities\BudgetGradesQuery');
    }

    /**
     * Use the BudgetGrades relation BudgetGrades object
     *
     * @param callable(\entities\BudgetGradesQuery):\entities\BudgetGradesQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withBudgetGradesQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useBudgetGradesQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to BudgetGrades table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\BudgetGradesQuery The inner query object of the EXISTS statement
     */
    public function useBudgetGradesExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\BudgetGradesQuery */
        $q = $this->useExistsQuery('BudgetGrades', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to BudgetGrades table for a NOT EXISTS query.
     *
     * @see useBudgetGradesExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\BudgetGradesQuery The inner query object of the NOT EXISTS statement
     */
    public function useBudgetGradesNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\BudgetGradesQuery */
        $q = $this->useExistsQuery('BudgetGrades', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to BudgetGrades table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\BudgetGradesQuery The inner query object of the IN statement
     */
    public function useInBudgetGradesQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\BudgetGradesQuery */
        $q = $this->useInQuery('BudgetGrades', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to BudgetGrades table for a NOT IN query.
     *
     * @see useBudgetGradesInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\BudgetGradesQuery The inner query object of the NOT IN statement
     */
    public function useNotInBudgetGradesQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\BudgetGradesQuery */
        $q = $this->useInQuery('BudgetGrades', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\Expenses object
     *
     * @param \entities\Expenses|ObjectCollection $expenses the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpenses($expenses, ?string $comparison = null)
    {
        if ($expenses instanceof \entities\Expenses) {
            $this
                ->addUsingAlias(BudgetGroupTableMap::COL_BGID, $expenses->getBudgetId(), $comparison);

            return $this;
        } elseif ($expenses instanceof ObjectCollection) {
            $this
                ->useExpensesQuery()
                ->filterByPrimaryKeys($expenses->getPrimaryKeys())
                ->endUse();

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
     * @param ChildBudgetGroup $budgetGroup Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($budgetGroup = null)
    {
        if ($budgetGroup) {
            $this->addUsingAlias(BudgetGroupTableMap::COL_BGID, $budgetGroup->getBgid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the budget_group table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(BudgetGroupTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            BudgetGroupTableMap::clearInstancePool();
            BudgetGroupTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(BudgetGroupTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(BudgetGroupTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            BudgetGroupTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            BudgetGroupTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
