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
use entities\GradeMaster as ChildGradeMaster;
use entities\GradeMasterQuery as ChildGradeMasterQuery;
use entities\Map\GradeMasterTableMap;

/**
 * Base class that represents a query for the `grade_master` table.
 *
 * @method     ChildGradeMasterQuery orderByGradeid($order = Criteria::ASC) Order by the gradeid column
 * @method     ChildGradeMasterQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildGradeMasterQuery orderByGradeName($order = Criteria::ASC) Order by the grade_name column
 *
 * @method     ChildGradeMasterQuery groupByGradeid() Group by the gradeid column
 * @method     ChildGradeMasterQuery groupByCompanyId() Group by the company_id column
 * @method     ChildGradeMasterQuery groupByGradeName() Group by the grade_name column
 *
 * @method     ChildGradeMasterQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildGradeMasterQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildGradeMasterQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildGradeMasterQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildGradeMasterQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildGradeMasterQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildGradeMasterQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildGradeMasterQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildGradeMasterQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildGradeMasterQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildGradeMasterQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildGradeMasterQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildGradeMasterQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     ChildGradeMasterQuery leftJoinBudgetGrades($relationAlias = null) Adds a LEFT JOIN clause to the query using the BudgetGrades relation
 * @method     ChildGradeMasterQuery rightJoinBudgetGrades($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BudgetGrades relation
 * @method     ChildGradeMasterQuery innerJoinBudgetGrades($relationAlias = null) Adds a INNER JOIN clause to the query using the BudgetGrades relation
 *
 * @method     ChildGradeMasterQuery joinWithBudgetGrades($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BudgetGrades relation
 *
 * @method     ChildGradeMasterQuery leftJoinWithBudgetGrades() Adds a LEFT JOIN clause and with to the query using the BudgetGrades relation
 * @method     ChildGradeMasterQuery rightJoinWithBudgetGrades() Adds a RIGHT JOIN clause and with to the query using the BudgetGrades relation
 * @method     ChildGradeMasterQuery innerJoinWithBudgetGrades() Adds a INNER JOIN clause and with to the query using the BudgetGrades relation
 *
 * @method     ChildGradeMasterQuery leftJoinCitycategory($relationAlias = null) Adds a LEFT JOIN clause to the query using the Citycategory relation
 * @method     ChildGradeMasterQuery rightJoinCitycategory($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Citycategory relation
 * @method     ChildGradeMasterQuery innerJoinCitycategory($relationAlias = null) Adds a INNER JOIN clause to the query using the Citycategory relation
 *
 * @method     ChildGradeMasterQuery joinWithCitycategory($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Citycategory relation
 *
 * @method     ChildGradeMasterQuery leftJoinWithCitycategory() Adds a LEFT JOIN clause and with to the query using the Citycategory relation
 * @method     ChildGradeMasterQuery rightJoinWithCitycategory() Adds a RIGHT JOIN clause and with to the query using the Citycategory relation
 * @method     ChildGradeMasterQuery innerJoinWithCitycategory() Adds a INNER JOIN clause and with to the query using the Citycategory relation
 *
 * @method     ChildGradeMasterQuery leftJoinEmployee($relationAlias = null) Adds a LEFT JOIN clause to the query using the Employee relation
 * @method     ChildGradeMasterQuery rightJoinEmployee($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Employee relation
 * @method     ChildGradeMasterQuery innerJoinEmployee($relationAlias = null) Adds a INNER JOIN clause to the query using the Employee relation
 *
 * @method     ChildGradeMasterQuery joinWithEmployee($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Employee relation
 *
 * @method     ChildGradeMasterQuery leftJoinWithEmployee() Adds a LEFT JOIN clause and with to the query using the Employee relation
 * @method     ChildGradeMasterQuery rightJoinWithEmployee() Adds a RIGHT JOIN clause and with to the query using the Employee relation
 * @method     ChildGradeMasterQuery innerJoinWithEmployee() Adds a INNER JOIN clause and with to the query using the Employee relation
 *
 * @method     ChildGradeMasterQuery leftJoinGradePolicy($relationAlias = null) Adds a LEFT JOIN clause to the query using the GradePolicy relation
 * @method     ChildGradeMasterQuery rightJoinGradePolicy($relationAlias = null) Adds a RIGHT JOIN clause to the query using the GradePolicy relation
 * @method     ChildGradeMasterQuery innerJoinGradePolicy($relationAlias = null) Adds a INNER JOIN clause to the query using the GradePolicy relation
 *
 * @method     ChildGradeMasterQuery joinWithGradePolicy($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the GradePolicy relation
 *
 * @method     ChildGradeMasterQuery leftJoinWithGradePolicy() Adds a LEFT JOIN clause and with to the query using the GradePolicy relation
 * @method     ChildGradeMasterQuery rightJoinWithGradePolicy() Adds a RIGHT JOIN clause and with to the query using the GradePolicy relation
 * @method     ChildGradeMasterQuery innerJoinWithGradePolicy() Adds a INNER JOIN clause and with to the query using the GradePolicy relation
 *
 * @method     \entities\CompanyQuery|\entities\BudgetGradesQuery|\entities\CitycategoryQuery|\entities\EmployeeQuery|\entities\GradePolicyQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildGradeMaster|null findOne(?ConnectionInterface $con = null) Return the first ChildGradeMaster matching the query
 * @method     ChildGradeMaster findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildGradeMaster matching the query, or a new ChildGradeMaster object populated from the query conditions when no match is found
 *
 * @method     ChildGradeMaster|null findOneByGradeid(int $gradeid) Return the first ChildGradeMaster filtered by the gradeid column
 * @method     ChildGradeMaster|null findOneByCompanyId(int $company_id) Return the first ChildGradeMaster filtered by the company_id column
 * @method     ChildGradeMaster|null findOneByGradeName(string $grade_name) Return the first ChildGradeMaster filtered by the grade_name column
 *
 * @method     ChildGradeMaster requirePk($key, ?ConnectionInterface $con = null) Return the ChildGradeMaster by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGradeMaster requireOne(?ConnectionInterface $con = null) Return the first ChildGradeMaster matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildGradeMaster requireOneByGradeid(int $gradeid) Return the first ChildGradeMaster filtered by the gradeid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGradeMaster requireOneByCompanyId(int $company_id) Return the first ChildGradeMaster filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGradeMaster requireOneByGradeName(string $grade_name) Return the first ChildGradeMaster filtered by the grade_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildGradeMaster[]|Collection find(?ConnectionInterface $con = null) Return ChildGradeMaster objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildGradeMaster> find(?ConnectionInterface $con = null) Return ChildGradeMaster objects based on current ModelCriteria
 *
 * @method     ChildGradeMaster[]|Collection findByGradeid(int|array<int> $gradeid) Return ChildGradeMaster objects filtered by the gradeid column
 * @psalm-method Collection&\Traversable<ChildGradeMaster> findByGradeid(int|array<int> $gradeid) Return ChildGradeMaster objects filtered by the gradeid column
 * @method     ChildGradeMaster[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildGradeMaster objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildGradeMaster> findByCompanyId(int|array<int> $company_id) Return ChildGradeMaster objects filtered by the company_id column
 * @method     ChildGradeMaster[]|Collection findByGradeName(string|array<string> $grade_name) Return ChildGradeMaster objects filtered by the grade_name column
 * @psalm-method Collection&\Traversable<ChildGradeMaster> findByGradeName(string|array<string> $grade_name) Return ChildGradeMaster objects filtered by the grade_name column
 *
 * @method     ChildGradeMaster[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildGradeMaster> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class GradeMasterQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\GradeMasterQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\GradeMaster', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildGradeMasterQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildGradeMasterQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildGradeMasterQuery) {
            return $criteria;
        }
        $query = new ChildGradeMasterQuery();
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
     * @return ChildGradeMaster|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(GradeMasterTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = GradeMasterTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildGradeMaster A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT gradeid, company_id, grade_name FROM grade_master WHERE gradeid = :p0';
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
            /** @var ChildGradeMaster $obj */
            $obj = new ChildGradeMaster();
            $obj->hydrate($row);
            GradeMasterTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildGradeMaster|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(GradeMasterTableMap::COL_GRADEID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(GradeMasterTableMap::COL_GRADEID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the gradeid column
     *
     * Example usage:
     * <code>
     * $query->filterByGradeid(1234); // WHERE gradeid = 1234
     * $query->filterByGradeid(array(12, 34)); // WHERE gradeid IN (12, 34)
     * $query->filterByGradeid(array('min' => 12)); // WHERE gradeid > 12
     * </code>
     *
     * @param mixed $gradeid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByGradeid($gradeid = null, ?string $comparison = null)
    {
        if (is_array($gradeid)) {
            $useMinMax = false;
            if (isset($gradeid['min'])) {
                $this->addUsingAlias(GradeMasterTableMap::COL_GRADEID, $gradeid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($gradeid['max'])) {
                $this->addUsingAlias(GradeMasterTableMap::COL_GRADEID, $gradeid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(GradeMasterTableMap::COL_GRADEID, $gradeid, $comparison);

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
                $this->addUsingAlias(GradeMasterTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(GradeMasterTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(GradeMasterTableMap::COL_COMPANY_ID, $companyId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the grade_name column
     *
     * Example usage:
     * <code>
     * $query->filterByGradeName('fooValue');   // WHERE grade_name = 'fooValue'
     * $query->filterByGradeName('%fooValue%', Criteria::LIKE); // WHERE grade_name LIKE '%fooValue%'
     * $query->filterByGradeName(['foo', 'bar']); // WHERE grade_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $gradeName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByGradeName($gradeName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($gradeName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(GradeMasterTableMap::COL_GRADE_NAME, $gradeName, $comparison);

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
                ->addUsingAlias(GradeMasterTableMap::COL_COMPANY_ID, $company->getCompanyId(), $comparison);
        } elseif ($company instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(GradeMasterTableMap::COL_COMPANY_ID, $company->toKeyValue('PrimaryKey', 'CompanyId'), $comparison);

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
                ->addUsingAlias(GradeMasterTableMap::COL_GRADEID, $budgetGrades->getGradeId(), $comparison);

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
     * Filter the query by a related \entities\Citycategory object
     *
     * @param \entities\Citycategory|ObjectCollection $citycategory the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCitycategory($citycategory, ?string $comparison = null)
    {
        if ($citycategory instanceof \entities\Citycategory) {
            $this
                ->addUsingAlias(GradeMasterTableMap::COL_GRADEID, $citycategory->getGradeId(), $comparison);

            return $this;
        } elseif ($citycategory instanceof ObjectCollection) {
            $this
                ->useCitycategoryQuery()
                ->filterByPrimaryKeys($citycategory->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByCitycategory() only accepts arguments of type \entities\Citycategory or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Citycategory relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinCitycategory(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Citycategory');

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
            $this->addJoinObject($join, 'Citycategory');
        }

        return $this;
    }

    /**
     * Use the Citycategory relation Citycategory object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\CitycategoryQuery A secondary query class using the current class as primary query
     */
    public function useCitycategoryQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinCitycategory($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Citycategory', '\entities\CitycategoryQuery');
    }

    /**
     * Use the Citycategory relation Citycategory object
     *
     * @param callable(\entities\CitycategoryQuery):\entities\CitycategoryQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withCitycategoryQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useCitycategoryQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Citycategory table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\CitycategoryQuery The inner query object of the EXISTS statement
     */
    public function useCitycategoryExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\CitycategoryQuery */
        $q = $this->useExistsQuery('Citycategory', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Citycategory table for a NOT EXISTS query.
     *
     * @see useCitycategoryExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\CitycategoryQuery The inner query object of the NOT EXISTS statement
     */
    public function useCitycategoryNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\CitycategoryQuery */
        $q = $this->useExistsQuery('Citycategory', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Citycategory table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\CitycategoryQuery The inner query object of the IN statement
     */
    public function useInCitycategoryQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\CitycategoryQuery */
        $q = $this->useInQuery('Citycategory', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Citycategory table for a NOT IN query.
     *
     * @see useCitycategoryInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\CitycategoryQuery The inner query object of the NOT IN statement
     */
    public function useNotInCitycategoryQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\CitycategoryQuery */
        $q = $this->useInQuery('Citycategory', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\Employee object
     *
     * @param \entities\Employee|ObjectCollection $employee the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmployee($employee, ?string $comparison = null)
    {
        if ($employee instanceof \entities\Employee) {
            $this
                ->addUsingAlias(GradeMasterTableMap::COL_GRADEID, $employee->getGradeId(), $comparison);

            return $this;
        } elseif ($employee instanceof ObjectCollection) {
            $this
                ->useEmployeeQuery()
                ->filterByPrimaryKeys($employee->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByEmployee() only accepts arguments of type \entities\Employee or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Employee relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinEmployee(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Employee');

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
            $this->addJoinObject($join, 'Employee');
        }

        return $this;
    }

    /**
     * Use the Employee relation Employee object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\EmployeeQuery A secondary query class using the current class as primary query
     */
    public function useEmployeeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinEmployee($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Employee', '\entities\EmployeeQuery');
    }

    /**
     * Use the Employee relation Employee object
     *
     * @param callable(\entities\EmployeeQuery):\entities\EmployeeQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withEmployeeQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useEmployeeQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Employee table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\EmployeeQuery The inner query object of the EXISTS statement
     */
    public function useEmployeeExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\EmployeeQuery */
        $q = $this->useExistsQuery('Employee', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Employee table for a NOT EXISTS query.
     *
     * @see useEmployeeExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\EmployeeQuery The inner query object of the NOT EXISTS statement
     */
    public function useEmployeeNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\EmployeeQuery */
        $q = $this->useExistsQuery('Employee', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Employee table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\EmployeeQuery The inner query object of the IN statement
     */
    public function useInEmployeeQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\EmployeeQuery */
        $q = $this->useInQuery('Employee', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Employee table for a NOT IN query.
     *
     * @see useEmployeeInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\EmployeeQuery The inner query object of the NOT IN statement
     */
    public function useNotInEmployeeQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\EmployeeQuery */
        $q = $this->useInQuery('Employee', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\GradePolicy object
     *
     * @param \entities\GradePolicy|ObjectCollection $gradePolicy the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByGradePolicy($gradePolicy, ?string $comparison = null)
    {
        if ($gradePolicy instanceof \entities\GradePolicy) {
            $this
                ->addUsingAlias(GradeMasterTableMap::COL_GRADEID, $gradePolicy->getGradeid(), $comparison);

            return $this;
        } elseif ($gradePolicy instanceof ObjectCollection) {
            $this
                ->useGradePolicyQuery()
                ->filterByPrimaryKeys($gradePolicy->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByGradePolicy() only accepts arguments of type \entities\GradePolicy or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the GradePolicy relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinGradePolicy(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('GradePolicy');

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
            $this->addJoinObject($join, 'GradePolicy');
        }

        return $this;
    }

    /**
     * Use the GradePolicy relation GradePolicy object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\GradePolicyQuery A secondary query class using the current class as primary query
     */
    public function useGradePolicyQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinGradePolicy($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'GradePolicy', '\entities\GradePolicyQuery');
    }

    /**
     * Use the GradePolicy relation GradePolicy object
     *
     * @param callable(\entities\GradePolicyQuery):\entities\GradePolicyQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withGradePolicyQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useGradePolicyQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to GradePolicy table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\GradePolicyQuery The inner query object of the EXISTS statement
     */
    public function useGradePolicyExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\GradePolicyQuery */
        $q = $this->useExistsQuery('GradePolicy', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to GradePolicy table for a NOT EXISTS query.
     *
     * @see useGradePolicyExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\GradePolicyQuery The inner query object of the NOT EXISTS statement
     */
    public function useGradePolicyNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\GradePolicyQuery */
        $q = $this->useExistsQuery('GradePolicy', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to GradePolicy table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\GradePolicyQuery The inner query object of the IN statement
     */
    public function useInGradePolicyQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\GradePolicyQuery */
        $q = $this->useInQuery('GradePolicy', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to GradePolicy table for a NOT IN query.
     *
     * @see useGradePolicyInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\GradePolicyQuery The inner query object of the NOT IN statement
     */
    public function useNotInGradePolicyQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\GradePolicyQuery */
        $q = $this->useInQuery('GradePolicy', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildGradeMaster $gradeMaster Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($gradeMaster = null)
    {
        if ($gradeMaster) {
            $this->addUsingAlias(GradeMasterTableMap::COL_GRADEID, $gradeMaster->getGradeid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the grade_master table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(GradeMasterTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            GradeMasterTableMap::clearInstancePool();
            GradeMasterTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(GradeMasterTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(GradeMasterTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            GradeMasterTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            GradeMasterTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
