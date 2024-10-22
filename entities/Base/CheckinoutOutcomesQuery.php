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
use entities\CheckinoutOutcomes as ChildCheckinoutOutcomes;
use entities\CheckinoutOutcomesQuery as ChildCheckinoutOutcomesQuery;
use entities\Map\CheckinoutOutcomesTableMap;

/**
 * Base class that represents a query for the `checkinout_outcomes` table.
 *
 * @method     ChildCheckinoutOutcomesQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildCheckinoutOutcomesQuery orderByOutcomeName($order = Criteria::ASC) Order by the outcome_name column
 * @method     ChildCheckinoutOutcomesQuery orderByOutcomeFactor($order = Criteria::ASC) Order by the outcome_factor column
 * @method     ChildCheckinoutOutcomesQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 *
 * @method     ChildCheckinoutOutcomesQuery groupById() Group by the id column
 * @method     ChildCheckinoutOutcomesQuery groupByOutcomeName() Group by the outcome_name column
 * @method     ChildCheckinoutOutcomesQuery groupByOutcomeFactor() Group by the outcome_factor column
 * @method     ChildCheckinoutOutcomesQuery groupByCompanyId() Group by the company_id column
 *
 * @method     ChildCheckinoutOutcomesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCheckinoutOutcomesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCheckinoutOutcomesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCheckinoutOutcomesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildCheckinoutOutcomesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildCheckinoutOutcomesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildCheckinoutOutcomesQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildCheckinoutOutcomesQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildCheckinoutOutcomesQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildCheckinoutOutcomesQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildCheckinoutOutcomesQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildCheckinoutOutcomesQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildCheckinoutOutcomesQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     \entities\CompanyQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildCheckinoutOutcomes|null findOne(?ConnectionInterface $con = null) Return the first ChildCheckinoutOutcomes matching the query
 * @method     ChildCheckinoutOutcomes findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildCheckinoutOutcomes matching the query, or a new ChildCheckinoutOutcomes object populated from the query conditions when no match is found
 *
 * @method     ChildCheckinoutOutcomes|null findOneById(int $id) Return the first ChildCheckinoutOutcomes filtered by the id column
 * @method     ChildCheckinoutOutcomes|null findOneByOutcomeName(string $outcome_name) Return the first ChildCheckinoutOutcomes filtered by the outcome_name column
 * @method     ChildCheckinoutOutcomes|null findOneByOutcomeFactor(int $outcome_factor) Return the first ChildCheckinoutOutcomes filtered by the outcome_factor column
 * @method     ChildCheckinoutOutcomes|null findOneByCompanyId(int $company_id) Return the first ChildCheckinoutOutcomes filtered by the company_id column
 *
 * @method     ChildCheckinoutOutcomes requirePk($key, ?ConnectionInterface $con = null) Return the ChildCheckinoutOutcomes by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCheckinoutOutcomes requireOne(?ConnectionInterface $con = null) Return the first ChildCheckinoutOutcomes matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCheckinoutOutcomes requireOneById(int $id) Return the first ChildCheckinoutOutcomes filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCheckinoutOutcomes requireOneByOutcomeName(string $outcome_name) Return the first ChildCheckinoutOutcomes filtered by the outcome_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCheckinoutOutcomes requireOneByOutcomeFactor(int $outcome_factor) Return the first ChildCheckinoutOutcomes filtered by the outcome_factor column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCheckinoutOutcomes requireOneByCompanyId(int $company_id) Return the first ChildCheckinoutOutcomes filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCheckinoutOutcomes[]|Collection find(?ConnectionInterface $con = null) Return ChildCheckinoutOutcomes objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildCheckinoutOutcomes> find(?ConnectionInterface $con = null) Return ChildCheckinoutOutcomes objects based on current ModelCriteria
 *
 * @method     ChildCheckinoutOutcomes[]|Collection findById(int|array<int> $id) Return ChildCheckinoutOutcomes objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildCheckinoutOutcomes> findById(int|array<int> $id) Return ChildCheckinoutOutcomes objects filtered by the id column
 * @method     ChildCheckinoutOutcomes[]|Collection findByOutcomeName(string|array<string> $outcome_name) Return ChildCheckinoutOutcomes objects filtered by the outcome_name column
 * @psalm-method Collection&\Traversable<ChildCheckinoutOutcomes> findByOutcomeName(string|array<string> $outcome_name) Return ChildCheckinoutOutcomes objects filtered by the outcome_name column
 * @method     ChildCheckinoutOutcomes[]|Collection findByOutcomeFactor(int|array<int> $outcome_factor) Return ChildCheckinoutOutcomes objects filtered by the outcome_factor column
 * @psalm-method Collection&\Traversable<ChildCheckinoutOutcomes> findByOutcomeFactor(int|array<int> $outcome_factor) Return ChildCheckinoutOutcomes objects filtered by the outcome_factor column
 * @method     ChildCheckinoutOutcomes[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildCheckinoutOutcomes objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildCheckinoutOutcomes> findByCompanyId(int|array<int> $company_id) Return ChildCheckinoutOutcomes objects filtered by the company_id column
 *
 * @method     ChildCheckinoutOutcomes[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildCheckinoutOutcomes> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class CheckinoutOutcomesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\CheckinoutOutcomesQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\CheckinoutOutcomes', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCheckinoutOutcomesQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCheckinoutOutcomesQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildCheckinoutOutcomesQuery) {
            return $criteria;
        }
        $query = new ChildCheckinoutOutcomesQuery();
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
     * @return ChildCheckinoutOutcomes|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CheckinoutOutcomesTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = CheckinoutOutcomesTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildCheckinoutOutcomes A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, outcome_name, outcome_factor, company_id FROM checkinout_outcomes WHERE id = :p0';
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
            /** @var ChildCheckinoutOutcomes $obj */
            $obj = new ChildCheckinoutOutcomes();
            $obj->hydrate($row);
            CheckinoutOutcomesTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildCheckinoutOutcomes|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(CheckinoutOutcomesTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(CheckinoutOutcomesTableMap::COL_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterById($id = null, ?string $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(CheckinoutOutcomesTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(CheckinoutOutcomesTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CheckinoutOutcomesTableMap::COL_ID, $id, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outcome_name column
     *
     * Example usage:
     * <code>
     * $query->filterByOutcomeName('fooValue');   // WHERE outcome_name = 'fooValue'
     * $query->filterByOutcomeName('%fooValue%', Criteria::LIKE); // WHERE outcome_name LIKE '%fooValue%'
     * $query->filterByOutcomeName(['foo', 'bar']); // WHERE outcome_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $outcomeName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutcomeName($outcomeName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($outcomeName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CheckinoutOutcomesTableMap::COL_OUTCOME_NAME, $outcomeName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outcome_factor column
     *
     * Example usage:
     * <code>
     * $query->filterByOutcomeFactor(1234); // WHERE outcome_factor = 1234
     * $query->filterByOutcomeFactor(array(12, 34)); // WHERE outcome_factor IN (12, 34)
     * $query->filterByOutcomeFactor(array('min' => 12)); // WHERE outcome_factor > 12
     * </code>
     *
     * @param mixed $outcomeFactor The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutcomeFactor($outcomeFactor = null, ?string $comparison = null)
    {
        if (is_array($outcomeFactor)) {
            $useMinMax = false;
            if (isset($outcomeFactor['min'])) {
                $this->addUsingAlias(CheckinoutOutcomesTableMap::COL_OUTCOME_FACTOR, $outcomeFactor['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outcomeFactor['max'])) {
                $this->addUsingAlias(CheckinoutOutcomesTableMap::COL_OUTCOME_FACTOR, $outcomeFactor['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CheckinoutOutcomesTableMap::COL_OUTCOME_FACTOR, $outcomeFactor, $comparison);

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
                $this->addUsingAlias(CheckinoutOutcomesTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(CheckinoutOutcomesTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CheckinoutOutcomesTableMap::COL_COMPANY_ID, $companyId, $comparison);

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
                ->addUsingAlias(CheckinoutOutcomesTableMap::COL_COMPANY_ID, $company->getCompanyId(), $comparison);
        } elseif ($company instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(CheckinoutOutcomesTableMap::COL_COMPANY_ID, $company->toKeyValue('PrimaryKey', 'CompanyId'), $comparison);

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
     * Exclude object from result
     *
     * @param ChildCheckinoutOutcomes $checkinoutOutcomes Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($checkinoutOutcomes = null)
    {
        if ($checkinoutOutcomes) {
            $this->addUsingAlias(CheckinoutOutcomesTableMap::COL_ID, $checkinoutOutcomes->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the checkinout_outcomes table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CheckinoutOutcomesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CheckinoutOutcomesTableMap::clearInstancePool();
            CheckinoutOutcomesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(CheckinoutOutcomesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CheckinoutOutcomesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            CheckinoutOutcomesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            CheckinoutOutcomesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
