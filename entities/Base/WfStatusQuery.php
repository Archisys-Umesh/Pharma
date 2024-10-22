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
use entities\WfStatus as ChildWfStatus;
use entities\WfStatusQuery as ChildWfStatusQuery;
use entities\Map\WfStatusTableMap;

/**
 * Base class that represents a query for the `wf_status` table.
 *
 * @method     ChildWfStatusQuery orderByWfId($order = Criteria::ASC) Order by the wf_id column
 * @method     ChildWfStatusQuery orderByWfStatusId($order = Criteria::ASC) Order by the wf_status_id column
 * @method     ChildWfStatusQuery orderByWfStatusName($order = Criteria::ASC) Order by the wf_status_name column
 * @method     ChildWfStatusQuery orderByWfCssClass($order = Criteria::ASC) Order by the wf_css_class column
 *
 * @method     ChildWfStatusQuery groupByWfId() Group by the wf_id column
 * @method     ChildWfStatusQuery groupByWfStatusId() Group by the wf_status_id column
 * @method     ChildWfStatusQuery groupByWfStatusName() Group by the wf_status_name column
 * @method     ChildWfStatusQuery groupByWfCssClass() Group by the wf_css_class column
 *
 * @method     ChildWfStatusQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildWfStatusQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildWfStatusQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildWfStatusQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildWfStatusQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildWfStatusQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildWfStatusQuery leftJoinWfMaster($relationAlias = null) Adds a LEFT JOIN clause to the query using the WfMaster relation
 * @method     ChildWfStatusQuery rightJoinWfMaster($relationAlias = null) Adds a RIGHT JOIN clause to the query using the WfMaster relation
 * @method     ChildWfStatusQuery innerJoinWfMaster($relationAlias = null) Adds a INNER JOIN clause to the query using the WfMaster relation
 *
 * @method     ChildWfStatusQuery joinWithWfMaster($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the WfMaster relation
 *
 * @method     ChildWfStatusQuery leftJoinWithWfMaster() Adds a LEFT JOIN clause and with to the query using the WfMaster relation
 * @method     ChildWfStatusQuery rightJoinWithWfMaster() Adds a RIGHT JOIN clause and with to the query using the WfMaster relation
 * @method     ChildWfStatusQuery innerJoinWithWfMaster() Adds a INNER JOIN clause and with to the query using the WfMaster relation
 *
 * @method     \entities\WfMasterQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildWfStatus|null findOne(?ConnectionInterface $con = null) Return the first ChildWfStatus matching the query
 * @method     ChildWfStatus findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildWfStatus matching the query, or a new ChildWfStatus object populated from the query conditions when no match is found
 *
 * @method     ChildWfStatus|null findOneByWfId(int $wf_id) Return the first ChildWfStatus filtered by the wf_id column
 * @method     ChildWfStatus|null findOneByWfStatusId(int $wf_status_id) Return the first ChildWfStatus filtered by the wf_status_id column
 * @method     ChildWfStatus|null findOneByWfStatusName(string $wf_status_name) Return the first ChildWfStatus filtered by the wf_status_name column
 * @method     ChildWfStatus|null findOneByWfCssClass(string $wf_css_class) Return the first ChildWfStatus filtered by the wf_css_class column
 *
 * @method     ChildWfStatus requirePk($key, ?ConnectionInterface $con = null) Return the ChildWfStatus by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWfStatus requireOne(?ConnectionInterface $con = null) Return the first ChildWfStatus matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildWfStatus requireOneByWfId(int $wf_id) Return the first ChildWfStatus filtered by the wf_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWfStatus requireOneByWfStatusId(int $wf_status_id) Return the first ChildWfStatus filtered by the wf_status_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWfStatus requireOneByWfStatusName(string $wf_status_name) Return the first ChildWfStatus filtered by the wf_status_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWfStatus requireOneByWfCssClass(string $wf_css_class) Return the first ChildWfStatus filtered by the wf_css_class column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildWfStatus[]|Collection find(?ConnectionInterface $con = null) Return ChildWfStatus objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildWfStatus> find(?ConnectionInterface $con = null) Return ChildWfStatus objects based on current ModelCriteria
 *
 * @method     ChildWfStatus[]|Collection findByWfId(int|array<int> $wf_id) Return ChildWfStatus objects filtered by the wf_id column
 * @psalm-method Collection&\Traversable<ChildWfStatus> findByWfId(int|array<int> $wf_id) Return ChildWfStatus objects filtered by the wf_id column
 * @method     ChildWfStatus[]|Collection findByWfStatusId(int|array<int> $wf_status_id) Return ChildWfStatus objects filtered by the wf_status_id column
 * @psalm-method Collection&\Traversable<ChildWfStatus> findByWfStatusId(int|array<int> $wf_status_id) Return ChildWfStatus objects filtered by the wf_status_id column
 * @method     ChildWfStatus[]|Collection findByWfStatusName(string|array<string> $wf_status_name) Return ChildWfStatus objects filtered by the wf_status_name column
 * @psalm-method Collection&\Traversable<ChildWfStatus> findByWfStatusName(string|array<string> $wf_status_name) Return ChildWfStatus objects filtered by the wf_status_name column
 * @method     ChildWfStatus[]|Collection findByWfCssClass(string|array<string> $wf_css_class) Return ChildWfStatus objects filtered by the wf_css_class column
 * @psalm-method Collection&\Traversable<ChildWfStatus> findByWfCssClass(string|array<string> $wf_css_class) Return ChildWfStatus objects filtered by the wf_css_class column
 *
 * @method     ChildWfStatus[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildWfStatus> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class WfStatusQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\WfStatusQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\WfStatus', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildWfStatusQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildWfStatusQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildWfStatusQuery) {
            return $criteria;
        }
        $query = new ChildWfStatusQuery();
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
     * $obj = $c->findPk(array(12, 34), $con);
     * </code>
     *
     * @param array[$wf_id, $wf_status_id] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildWfStatus|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(WfStatusTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = WfStatusTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]))))) {
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
     * @return ChildWfStatus A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT wf_id, wf_status_id, wf_status_name, wf_css_class FROM wf_status WHERE wf_id = :p0 AND wf_status_id = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildWfStatus $obj */
            $obj = new ChildWfStatus();
            $obj->hydrate($row);
            WfStatusTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildWfStatus|array|mixed the result, formatted by the current formatter
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
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
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
        $this->addUsingAlias(WfStatusTableMap::COL_WF_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(WfStatusTableMap::COL_WF_STATUS_ID, $key[1], Criteria::EQUAL);

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
        if (empty($keys)) {
            $this->add(null, '1<>1', Criteria::CUSTOM);

            return $this;
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(WfStatusTableMap::COL_WF_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(WfStatusTableMap::COL_WF_STATUS_ID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the wf_id column
     *
     * Example usage:
     * <code>
     * $query->filterByWfId(1234); // WHERE wf_id = 1234
     * $query->filterByWfId(array(12, 34)); // WHERE wf_id IN (12, 34)
     * $query->filterByWfId(array('min' => 12)); // WHERE wf_id > 12
     * </code>
     *
     * @see       filterByWfMaster()
     *
     * @param mixed $wfId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWfId($wfId = null, ?string $comparison = null)
    {
        if (is_array($wfId)) {
            $useMinMax = false;
            if (isset($wfId['min'])) {
                $this->addUsingAlias(WfStatusTableMap::COL_WF_ID, $wfId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($wfId['max'])) {
                $this->addUsingAlias(WfStatusTableMap::COL_WF_ID, $wfId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WfStatusTableMap::COL_WF_ID, $wfId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the wf_status_id column
     *
     * Example usage:
     * <code>
     * $query->filterByWfStatusId(1234); // WHERE wf_status_id = 1234
     * $query->filterByWfStatusId(array(12, 34)); // WHERE wf_status_id IN (12, 34)
     * $query->filterByWfStatusId(array('min' => 12)); // WHERE wf_status_id > 12
     * </code>
     *
     * @param mixed $wfStatusId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWfStatusId($wfStatusId = null, ?string $comparison = null)
    {
        if (is_array($wfStatusId)) {
            $useMinMax = false;
            if (isset($wfStatusId['min'])) {
                $this->addUsingAlias(WfStatusTableMap::COL_WF_STATUS_ID, $wfStatusId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($wfStatusId['max'])) {
                $this->addUsingAlias(WfStatusTableMap::COL_WF_STATUS_ID, $wfStatusId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WfStatusTableMap::COL_WF_STATUS_ID, $wfStatusId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the wf_status_name column
     *
     * Example usage:
     * <code>
     * $query->filterByWfStatusName('fooValue');   // WHERE wf_status_name = 'fooValue'
     * $query->filterByWfStatusName('%fooValue%', Criteria::LIKE); // WHERE wf_status_name LIKE '%fooValue%'
     * $query->filterByWfStatusName(['foo', 'bar']); // WHERE wf_status_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $wfStatusName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWfStatusName($wfStatusName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($wfStatusName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WfStatusTableMap::COL_WF_STATUS_NAME, $wfStatusName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the wf_css_class column
     *
     * Example usage:
     * <code>
     * $query->filterByWfCssClass('fooValue');   // WHERE wf_css_class = 'fooValue'
     * $query->filterByWfCssClass('%fooValue%', Criteria::LIKE); // WHERE wf_css_class LIKE '%fooValue%'
     * $query->filterByWfCssClass(['foo', 'bar']); // WHERE wf_css_class IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $wfCssClass The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWfCssClass($wfCssClass = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($wfCssClass)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WfStatusTableMap::COL_WF_CSS_CLASS, $wfCssClass, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \entities\WfMaster object
     *
     * @param \entities\WfMaster|ObjectCollection $wfMaster The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWfMaster($wfMaster, ?string $comparison = null)
    {
        if ($wfMaster instanceof \entities\WfMaster) {
            return $this
                ->addUsingAlias(WfStatusTableMap::COL_WF_ID, $wfMaster->getWfId(), $comparison);
        } elseif ($wfMaster instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(WfStatusTableMap::COL_WF_ID, $wfMaster->toKeyValue('PrimaryKey', 'WfId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByWfMaster() only accepts arguments of type \entities\WfMaster or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the WfMaster relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinWfMaster(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('WfMaster');

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
            $this->addJoinObject($join, 'WfMaster');
        }

        return $this;
    }

    /**
     * Use the WfMaster relation WfMaster object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\WfMasterQuery A secondary query class using the current class as primary query
     */
    public function useWfMasterQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinWfMaster($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'WfMaster', '\entities\WfMasterQuery');
    }

    /**
     * Use the WfMaster relation WfMaster object
     *
     * @param callable(\entities\WfMasterQuery):\entities\WfMasterQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withWfMasterQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useWfMasterQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to WfMaster table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\WfMasterQuery The inner query object of the EXISTS statement
     */
    public function useWfMasterExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\WfMasterQuery */
        $q = $this->useExistsQuery('WfMaster', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to WfMaster table for a NOT EXISTS query.
     *
     * @see useWfMasterExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\WfMasterQuery The inner query object of the NOT EXISTS statement
     */
    public function useWfMasterNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\WfMasterQuery */
        $q = $this->useExistsQuery('WfMaster', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to WfMaster table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\WfMasterQuery The inner query object of the IN statement
     */
    public function useInWfMasterQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\WfMasterQuery */
        $q = $this->useInQuery('WfMaster', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to WfMaster table for a NOT IN query.
     *
     * @see useWfMasterInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\WfMasterQuery The inner query object of the NOT IN statement
     */
    public function useNotInWfMasterQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\WfMasterQuery */
        $q = $this->useInQuery('WfMaster', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildWfStatus $wfStatus Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($wfStatus = null)
    {
        if ($wfStatus) {
            $this->addCond('pruneCond0', $this->getAliasedColName(WfStatusTableMap::COL_WF_ID), $wfStatus->getWfId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(WfStatusTableMap::COL_WF_STATUS_ID), $wfStatus->getWfStatusId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the wf_status table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(WfStatusTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            WfStatusTableMap::clearInstancePool();
            WfStatusTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(WfStatusTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(WfStatusTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            WfStatusTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            WfStatusTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
