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
use entities\Unitmaster as ChildUnitmaster;
use entities\UnitmasterQuery as ChildUnitmasterQuery;
use entities\Map\UnitmasterTableMap;

/**
 * Base class that represents a query for the `unitmaster` table.
 *
 * @method     ChildUnitmasterQuery orderByUnitId($order = Criteria::ASC) Order by the unit_id column
 * @method     ChildUnitmasterQuery orderByUnitCode($order = Criteria::ASC) Order by the unit_code column
 * @method     ChildUnitmasterQuery orderByUnitDescription($order = Criteria::ASC) Order by the unit_description column
 * @method     ChildUnitmasterQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildUnitmasterQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildUnitmasterQuery groupByUnitId() Group by the unit_id column
 * @method     ChildUnitmasterQuery groupByUnitCode() Group by the unit_code column
 * @method     ChildUnitmasterQuery groupByUnitDescription() Group by the unit_description column
 * @method     ChildUnitmasterQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildUnitmasterQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildUnitmasterQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildUnitmasterQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildUnitmasterQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildUnitmasterQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildUnitmasterQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildUnitmasterQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildUnitmasterQuery leftJoinCompetitionMapping($relationAlias = null) Adds a LEFT JOIN clause to the query using the CompetitionMapping relation
 * @method     ChildUnitmasterQuery rightJoinCompetitionMapping($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CompetitionMapping relation
 * @method     ChildUnitmasterQuery innerJoinCompetitionMapping($relationAlias = null) Adds a INNER JOIN clause to the query using the CompetitionMapping relation
 *
 * @method     ChildUnitmasterQuery joinWithCompetitionMapping($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the CompetitionMapping relation
 *
 * @method     ChildUnitmasterQuery leftJoinWithCompetitionMapping() Adds a LEFT JOIN clause and with to the query using the CompetitionMapping relation
 * @method     ChildUnitmasterQuery rightJoinWithCompetitionMapping() Adds a RIGHT JOIN clause and with to the query using the CompetitionMapping relation
 * @method     ChildUnitmasterQuery innerJoinWithCompetitionMapping() Adds a INNER JOIN clause and with to the query using the CompetitionMapping relation
 *
 * @method     ChildUnitmasterQuery leftJoinOrderlines($relationAlias = null) Adds a LEFT JOIN clause to the query using the Orderlines relation
 * @method     ChildUnitmasterQuery rightJoinOrderlines($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Orderlines relation
 * @method     ChildUnitmasterQuery innerJoinOrderlines($relationAlias = null) Adds a INNER JOIN clause to the query using the Orderlines relation
 *
 * @method     ChildUnitmasterQuery joinWithOrderlines($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Orderlines relation
 *
 * @method     ChildUnitmasterQuery leftJoinWithOrderlines() Adds a LEFT JOIN clause and with to the query using the Orderlines relation
 * @method     ChildUnitmasterQuery rightJoinWithOrderlines() Adds a RIGHT JOIN clause and with to the query using the Orderlines relation
 * @method     ChildUnitmasterQuery innerJoinWithOrderlines() Adds a INNER JOIN clause and with to the query using the Orderlines relation
 *
 * @method     ChildUnitmasterQuery leftJoinProducts($relationAlias = null) Adds a LEFT JOIN clause to the query using the Products relation
 * @method     ChildUnitmasterQuery rightJoinProducts($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Products relation
 * @method     ChildUnitmasterQuery innerJoinProducts($relationAlias = null) Adds a INNER JOIN clause to the query using the Products relation
 *
 * @method     ChildUnitmasterQuery joinWithProducts($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Products relation
 *
 * @method     ChildUnitmasterQuery leftJoinWithProducts() Adds a LEFT JOIN clause and with to the query using the Products relation
 * @method     ChildUnitmasterQuery rightJoinWithProducts() Adds a RIGHT JOIN clause and with to the query using the Products relation
 * @method     ChildUnitmasterQuery innerJoinWithProducts() Adds a INNER JOIN clause and with to the query using the Products relation
 *
 * @method     \entities\CompetitionMappingQuery|\entities\OrderlinesQuery|\entities\ProductsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildUnitmaster|null findOne(?ConnectionInterface $con = null) Return the first ChildUnitmaster matching the query
 * @method     ChildUnitmaster findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildUnitmaster matching the query, or a new ChildUnitmaster object populated from the query conditions when no match is found
 *
 * @method     ChildUnitmaster|null findOneByUnitId(int $unit_id) Return the first ChildUnitmaster filtered by the unit_id column
 * @method     ChildUnitmaster|null findOneByUnitCode(string $unit_code) Return the first ChildUnitmaster filtered by the unit_code column
 * @method     ChildUnitmaster|null findOneByUnitDescription(string $unit_description) Return the first ChildUnitmaster filtered by the unit_description column
 * @method     ChildUnitmaster|null findOneByCreatedAt(string $created_at) Return the first ChildUnitmaster filtered by the created_at column
 * @method     ChildUnitmaster|null findOneByUpdatedAt(string $updated_at) Return the first ChildUnitmaster filtered by the updated_at column
 *
 * @method     ChildUnitmaster requirePk($key, ?ConnectionInterface $con = null) Return the ChildUnitmaster by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUnitmaster requireOne(?ConnectionInterface $con = null) Return the first ChildUnitmaster matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUnitmaster requireOneByUnitId(int $unit_id) Return the first ChildUnitmaster filtered by the unit_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUnitmaster requireOneByUnitCode(string $unit_code) Return the first ChildUnitmaster filtered by the unit_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUnitmaster requireOneByUnitDescription(string $unit_description) Return the first ChildUnitmaster filtered by the unit_description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUnitmaster requireOneByCreatedAt(string $created_at) Return the first ChildUnitmaster filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUnitmaster requireOneByUpdatedAt(string $updated_at) Return the first ChildUnitmaster filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUnitmaster[]|Collection find(?ConnectionInterface $con = null) Return ChildUnitmaster objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildUnitmaster> find(?ConnectionInterface $con = null) Return ChildUnitmaster objects based on current ModelCriteria
 *
 * @method     ChildUnitmaster[]|Collection findByUnitId(int|array<int> $unit_id) Return ChildUnitmaster objects filtered by the unit_id column
 * @psalm-method Collection&\Traversable<ChildUnitmaster> findByUnitId(int|array<int> $unit_id) Return ChildUnitmaster objects filtered by the unit_id column
 * @method     ChildUnitmaster[]|Collection findByUnitCode(string|array<string> $unit_code) Return ChildUnitmaster objects filtered by the unit_code column
 * @psalm-method Collection&\Traversable<ChildUnitmaster> findByUnitCode(string|array<string> $unit_code) Return ChildUnitmaster objects filtered by the unit_code column
 * @method     ChildUnitmaster[]|Collection findByUnitDescription(string|array<string> $unit_description) Return ChildUnitmaster objects filtered by the unit_description column
 * @psalm-method Collection&\Traversable<ChildUnitmaster> findByUnitDescription(string|array<string> $unit_description) Return ChildUnitmaster objects filtered by the unit_description column
 * @method     ChildUnitmaster[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildUnitmaster objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildUnitmaster> findByCreatedAt(string|array<string> $created_at) Return ChildUnitmaster objects filtered by the created_at column
 * @method     ChildUnitmaster[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildUnitmaster objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildUnitmaster> findByUpdatedAt(string|array<string> $updated_at) Return ChildUnitmaster objects filtered by the updated_at column
 *
 * @method     ChildUnitmaster[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildUnitmaster> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class UnitmasterQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\UnitmasterQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\Unitmaster', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildUnitmasterQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildUnitmasterQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildUnitmasterQuery) {
            return $criteria;
        }
        $query = new ChildUnitmasterQuery();
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
     * @return ChildUnitmaster|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(UnitmasterTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = UnitmasterTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildUnitmaster A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT unit_id, unit_code, unit_description, created_at, updated_at FROM unitmaster WHERE unit_id = :p0';
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
            /** @var ChildUnitmaster $obj */
            $obj = new ChildUnitmaster();
            $obj->hydrate($row);
            UnitmasterTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildUnitmaster|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(UnitmasterTableMap::COL_UNIT_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(UnitmasterTableMap::COL_UNIT_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the unit_id column
     *
     * Example usage:
     * <code>
     * $query->filterByUnitId(1234); // WHERE unit_id = 1234
     * $query->filterByUnitId(array(12, 34)); // WHERE unit_id IN (12, 34)
     * $query->filterByUnitId(array('min' => 12)); // WHERE unit_id > 12
     * </code>
     *
     * @param mixed $unitId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUnitId($unitId = null, ?string $comparison = null)
    {
        if (is_array($unitId)) {
            $useMinMax = false;
            if (isset($unitId['min'])) {
                $this->addUsingAlias(UnitmasterTableMap::COL_UNIT_ID, $unitId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($unitId['max'])) {
                $this->addUsingAlias(UnitmasterTableMap::COL_UNIT_ID, $unitId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UnitmasterTableMap::COL_UNIT_ID, $unitId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the unit_code column
     *
     * Example usage:
     * <code>
     * $query->filterByUnitCode('fooValue');   // WHERE unit_code = 'fooValue'
     * $query->filterByUnitCode('%fooValue%', Criteria::LIKE); // WHERE unit_code LIKE '%fooValue%'
     * $query->filterByUnitCode(['foo', 'bar']); // WHERE unit_code IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $unitCode The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUnitCode($unitCode = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($unitCode)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UnitmasterTableMap::COL_UNIT_CODE, $unitCode, $comparison);

        return $this;
    }

    /**
     * Filter the query on the unit_description column
     *
     * Example usage:
     * <code>
     * $query->filterByUnitDescription('fooValue');   // WHERE unit_description = 'fooValue'
     * $query->filterByUnitDescription('%fooValue%', Criteria::LIKE); // WHERE unit_description LIKE '%fooValue%'
     * $query->filterByUnitDescription(['foo', 'bar']); // WHERE unit_description IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $unitDescription The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUnitDescription($unitDescription = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($unitDescription)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UnitmasterTableMap::COL_UNIT_DESCRIPTION, $unitDescription, $comparison);

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
                $this->addUsingAlias(UnitmasterTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(UnitmasterTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UnitmasterTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(UnitmasterTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(UnitmasterTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UnitmasterTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
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
                ->addUsingAlias(UnitmasterTableMap::COL_UNIT_ID, $competitionMapping->getUnitId(), $comparison);

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
     * Filter the query by a related \entities\Orderlines object
     *
     * @param \entities\Orderlines|ObjectCollection $orderlines the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrderlines($orderlines, ?string $comparison = null)
    {
        if ($orderlines instanceof \entities\Orderlines) {
            $this
                ->addUsingAlias(UnitmasterTableMap::COL_UNIT_ID, $orderlines->getUnitId(), $comparison);

            return $this;
        } elseif ($orderlines instanceof ObjectCollection) {
            $this
                ->useOrderlinesQuery()
                ->filterByPrimaryKeys($orderlines->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByOrderlines() only accepts arguments of type \entities\Orderlines or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Orderlines relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOrderlines(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Orderlines');

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
            $this->addJoinObject($join, 'Orderlines');
        }

        return $this;
    }

    /**
     * Use the Orderlines relation Orderlines object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\OrderlinesQuery A secondary query class using the current class as primary query
     */
    public function useOrderlinesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinOrderlines($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Orderlines', '\entities\OrderlinesQuery');
    }

    /**
     * Use the Orderlines relation Orderlines object
     *
     * @param callable(\entities\OrderlinesQuery):\entities\OrderlinesQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOrderlinesQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useOrderlinesQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Orderlines table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\OrderlinesQuery The inner query object of the EXISTS statement
     */
    public function useOrderlinesExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\OrderlinesQuery */
        $q = $this->useExistsQuery('Orderlines', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Orderlines table for a NOT EXISTS query.
     *
     * @see useOrderlinesExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\OrderlinesQuery The inner query object of the NOT EXISTS statement
     */
    public function useOrderlinesNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OrderlinesQuery */
        $q = $this->useExistsQuery('Orderlines', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Orderlines table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\OrderlinesQuery The inner query object of the IN statement
     */
    public function useInOrderlinesQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\OrderlinesQuery */
        $q = $this->useInQuery('Orderlines', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Orderlines table for a NOT IN query.
     *
     * @see useOrderlinesInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\OrderlinesQuery The inner query object of the NOT IN statement
     */
    public function useNotInOrderlinesQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OrderlinesQuery */
        $q = $this->useInQuery('Orderlines', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\Products object
     *
     * @param \entities\Products|ObjectCollection $products the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProducts($products, ?string $comparison = null)
    {
        if ($products instanceof \entities\Products) {
            $this
                ->addUsingAlias(UnitmasterTableMap::COL_UNIT_ID, $products->getUnitD(), $comparison);

            return $this;
        } elseif ($products instanceof ObjectCollection) {
            $this
                ->useProductsQuery()
                ->filterByPrimaryKeys($products->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByProducts() only accepts arguments of type \entities\Products or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Products relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinProducts(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Products');

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
            $this->addJoinObject($join, 'Products');
        }

        return $this;
    }

    /**
     * Use the Products relation Products object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\ProductsQuery A secondary query class using the current class as primary query
     */
    public function useProductsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinProducts($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Products', '\entities\ProductsQuery');
    }

    /**
     * Use the Products relation Products object
     *
     * @param callable(\entities\ProductsQuery):\entities\ProductsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withProductsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useProductsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Products table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\ProductsQuery The inner query object of the EXISTS statement
     */
    public function useProductsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\ProductsQuery */
        $q = $this->useExistsQuery('Products', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Products table for a NOT EXISTS query.
     *
     * @see useProductsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\ProductsQuery The inner query object of the NOT EXISTS statement
     */
    public function useProductsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\ProductsQuery */
        $q = $this->useExistsQuery('Products', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Products table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\ProductsQuery The inner query object of the IN statement
     */
    public function useInProductsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\ProductsQuery */
        $q = $this->useInQuery('Products', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Products table for a NOT IN query.
     *
     * @see useProductsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\ProductsQuery The inner query object of the NOT IN statement
     */
    public function useNotInProductsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\ProductsQuery */
        $q = $this->useInQuery('Products', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildUnitmaster $unitmaster Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($unitmaster = null)
    {
        if ($unitmaster) {
            $this->addUsingAlias(UnitmasterTableMap::COL_UNIT_ID, $unitmaster->getUnitId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the unitmaster table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UnitmasterTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            UnitmasterTableMap::clearInstancePool();
            UnitmasterTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(UnitmasterTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(UnitmasterTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            UnitmasterTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            UnitmasterTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
