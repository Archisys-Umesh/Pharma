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
use entities\Competitor as ChildCompetitor;
use entities\CompetitorQuery as ChildCompetitorQuery;
use entities\Map\CompetitorTableMap;

/**
 * Base class that represents a query for the `competitor` table.
 *
 * @method     ChildCompetitorQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildCompetitorQuery orderByCompetitorName($order = Criteria::ASC) Order by the competitor_name column
 * @method     ChildCompetitorQuery orderByCompetitorProducts($order = Criteria::ASC) Order by the competitor_products column
 * @method     ChildCompetitorQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 *
 * @method     ChildCompetitorQuery groupById() Group by the id column
 * @method     ChildCompetitorQuery groupByCompetitorName() Group by the competitor_name column
 * @method     ChildCompetitorQuery groupByCompetitorProducts() Group by the competitor_products column
 * @method     ChildCompetitorQuery groupByCompanyId() Group by the company_id column
 *
 * @method     ChildCompetitorQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCompetitorQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCompetitorQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCompetitorQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildCompetitorQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildCompetitorQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildCompetitorQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildCompetitorQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildCompetitorQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildCompetitorQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildCompetitorQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildCompetitorQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildCompetitorQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     ChildCompetitorQuery leftJoinCompetitionMapping($relationAlias = null) Adds a LEFT JOIN clause to the query using the CompetitionMapping relation
 * @method     ChildCompetitorQuery rightJoinCompetitionMapping($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CompetitionMapping relation
 * @method     ChildCompetitorQuery innerJoinCompetitionMapping($relationAlias = null) Adds a INNER JOIN clause to the query using the CompetitionMapping relation
 *
 * @method     ChildCompetitorQuery joinWithCompetitionMapping($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the CompetitionMapping relation
 *
 * @method     ChildCompetitorQuery leftJoinWithCompetitionMapping() Adds a LEFT JOIN clause and with to the query using the CompetitionMapping relation
 * @method     ChildCompetitorQuery rightJoinWithCompetitionMapping() Adds a RIGHT JOIN clause and with to the query using the CompetitionMapping relation
 * @method     ChildCompetitorQuery innerJoinWithCompetitionMapping() Adds a INNER JOIN clause and with to the query using the CompetitionMapping relation
 *
 * @method     \entities\CompanyQuery|\entities\CompetitionMappingQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildCompetitor|null findOne(?ConnectionInterface $con = null) Return the first ChildCompetitor matching the query
 * @method     ChildCompetitor findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildCompetitor matching the query, or a new ChildCompetitor object populated from the query conditions when no match is found
 *
 * @method     ChildCompetitor|null findOneById(int $id) Return the first ChildCompetitor filtered by the id column
 * @method     ChildCompetitor|null findOneByCompetitorName(string $competitor_name) Return the first ChildCompetitor filtered by the competitor_name column
 * @method     ChildCompetitor|null findOneByCompetitorProducts(string $competitor_products) Return the first ChildCompetitor filtered by the competitor_products column
 * @method     ChildCompetitor|null findOneByCompanyId(int $company_id) Return the first ChildCompetitor filtered by the company_id column
 *
 * @method     ChildCompetitor requirePk($key, ?ConnectionInterface $con = null) Return the ChildCompetitor by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCompetitor requireOne(?ConnectionInterface $con = null) Return the first ChildCompetitor matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCompetitor requireOneById(int $id) Return the first ChildCompetitor filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCompetitor requireOneByCompetitorName(string $competitor_name) Return the first ChildCompetitor filtered by the competitor_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCompetitor requireOneByCompetitorProducts(string $competitor_products) Return the first ChildCompetitor filtered by the competitor_products column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCompetitor requireOneByCompanyId(int $company_id) Return the first ChildCompetitor filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCompetitor[]|Collection find(?ConnectionInterface $con = null) Return ChildCompetitor objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildCompetitor> find(?ConnectionInterface $con = null) Return ChildCompetitor objects based on current ModelCriteria
 *
 * @method     ChildCompetitor[]|Collection findById(int|array<int> $id) Return ChildCompetitor objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildCompetitor> findById(int|array<int> $id) Return ChildCompetitor objects filtered by the id column
 * @method     ChildCompetitor[]|Collection findByCompetitorName(string|array<string> $competitor_name) Return ChildCompetitor objects filtered by the competitor_name column
 * @psalm-method Collection&\Traversable<ChildCompetitor> findByCompetitorName(string|array<string> $competitor_name) Return ChildCompetitor objects filtered by the competitor_name column
 * @method     ChildCompetitor[]|Collection findByCompetitorProducts(string|array<string> $competitor_products) Return ChildCompetitor objects filtered by the competitor_products column
 * @psalm-method Collection&\Traversable<ChildCompetitor> findByCompetitorProducts(string|array<string> $competitor_products) Return ChildCompetitor objects filtered by the competitor_products column
 * @method     ChildCompetitor[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildCompetitor objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildCompetitor> findByCompanyId(int|array<int> $company_id) Return ChildCompetitor objects filtered by the company_id column
 *
 * @method     ChildCompetitor[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildCompetitor> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class CompetitorQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\CompetitorQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\Competitor', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCompetitorQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCompetitorQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildCompetitorQuery) {
            return $criteria;
        }
        $query = new ChildCompetitorQuery();
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
     * @return ChildCompetitor|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CompetitorTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = CompetitorTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildCompetitor A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, competitor_name, competitor_products, company_id FROM competitor WHERE id = :p0';
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
            /** @var ChildCompetitor $obj */
            $obj = new ChildCompetitor();
            $obj->hydrate($row);
            CompetitorTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildCompetitor|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(CompetitorTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(CompetitorTableMap::COL_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(CompetitorTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(CompetitorTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CompetitorTableMap::COL_ID, $id, $comparison);

        return $this;
    }

    /**
     * Filter the query on the competitor_name column
     *
     * Example usage:
     * <code>
     * $query->filterByCompetitorName('fooValue');   // WHERE competitor_name = 'fooValue'
     * $query->filterByCompetitorName('%fooValue%', Criteria::LIKE); // WHERE competitor_name LIKE '%fooValue%'
     * $query->filterByCompetitorName(['foo', 'bar']); // WHERE competitor_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $competitorName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCompetitorName($competitorName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($competitorName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CompetitorTableMap::COL_COMPETITOR_NAME, $competitorName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the competitor_products column
     *
     * Example usage:
     * <code>
     * $query->filterByCompetitorProducts('fooValue');   // WHERE competitor_products = 'fooValue'
     * $query->filterByCompetitorProducts('%fooValue%', Criteria::LIKE); // WHERE competitor_products LIKE '%fooValue%'
     * $query->filterByCompetitorProducts(['foo', 'bar']); // WHERE competitor_products IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $competitorProducts The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCompetitorProducts($competitorProducts = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($competitorProducts)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CompetitorTableMap::COL_COMPETITOR_PRODUCTS, $competitorProducts, $comparison);

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
                $this->addUsingAlias(CompetitorTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(CompetitorTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CompetitorTableMap::COL_COMPANY_ID, $companyId, $comparison);

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
                ->addUsingAlias(CompetitorTableMap::COL_COMPANY_ID, $company->getCompanyId(), $comparison);
        } elseif ($company instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(CompetitorTableMap::COL_COMPANY_ID, $company->toKeyValue('PrimaryKey', 'CompanyId'), $comparison);

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
     * Filter the query by a related \entities\CompetitionMapping object
     *
     * @param \entities\CompetitionMapping|ObjectCollection $competitionMapping the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCompetitionMapping($competitionMapping, ?string $comparison = null)
    {
        if ($competitionMapping instanceof \entities\CompetitionMapping) {
            $this
                ->addUsingAlias(CompetitorTableMap::COL_ID, $competitionMapping->getCompetitorId(), $comparison);

            return $this;
        } elseif ($competitionMapping instanceof ObjectCollection) {
            $this
                ->useCompetitionMappingQuery()
                ->filterByPrimaryKeys($competitionMapping->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByCompetitionMapping() only accepts arguments of type \entities\CompetitionMapping or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CompetitionMapping relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinCompetitionMapping(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CompetitionMapping');

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
            $this->addJoinObject($join, 'CompetitionMapping');
        }

        return $this;
    }

    /**
     * Use the CompetitionMapping relation CompetitionMapping object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\CompetitionMappingQuery A secondary query class using the current class as primary query
     */
    public function useCompetitionMappingQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinCompetitionMapping($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CompetitionMapping', '\entities\CompetitionMappingQuery');
    }

    /**
     * Use the CompetitionMapping relation CompetitionMapping object
     *
     * @param callable(\entities\CompetitionMappingQuery):\entities\CompetitionMappingQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withCompetitionMappingQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useCompetitionMappingQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to CompetitionMapping table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\CompetitionMappingQuery The inner query object of the EXISTS statement
     */
    public function useCompetitionMappingExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\CompetitionMappingQuery */
        $q = $this->useExistsQuery('CompetitionMapping', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to CompetitionMapping table for a NOT EXISTS query.
     *
     * @see useCompetitionMappingExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\CompetitionMappingQuery The inner query object of the NOT EXISTS statement
     */
    public function useCompetitionMappingNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\CompetitionMappingQuery */
        $q = $this->useExistsQuery('CompetitionMapping', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to CompetitionMapping table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\CompetitionMappingQuery The inner query object of the IN statement
     */
    public function useInCompetitionMappingQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\CompetitionMappingQuery */
        $q = $this->useInQuery('CompetitionMapping', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to CompetitionMapping table for a NOT IN query.
     *
     * @see useCompetitionMappingInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\CompetitionMappingQuery The inner query object of the NOT IN statement
     */
    public function useNotInCompetitionMappingQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\CompetitionMappingQuery */
        $q = $this->useInQuery('CompetitionMapping', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildCompetitor $competitor Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($competitor = null)
    {
        if ($competitor) {
            $this->addUsingAlias(CompetitorTableMap::COL_ID, $competitor->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the competitor table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CompetitorTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CompetitorTableMap::clearInstancePool();
            CompetitorTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(CompetitorTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CompetitorTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            CompetitorTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            CompetitorTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
