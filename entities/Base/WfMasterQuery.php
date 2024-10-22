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
use entities\WfMaster as ChildWfMaster;
use entities\WfMasterQuery as ChildWfMasterQuery;
use entities\Map\WfMasterTableMap;

/**
 * Base class that represents a query for the `wf_master` table.
 *
 * @method     ChildWfMasterQuery orderByWfId($order = Criteria::ASC) Order by the wf_id column
 * @method     ChildWfMasterQuery orderByWfName($order = Criteria::ASC) Order by the wf_name column
 *
 * @method     ChildWfMasterQuery groupByWfId() Group by the wf_id column
 * @method     ChildWfMasterQuery groupByWfName() Group by the wf_name column
 *
 * @method     ChildWfMasterQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildWfMasterQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildWfMasterQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildWfMasterQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildWfMasterQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildWfMasterQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildWfMasterQuery leftJoinWfDocuments($relationAlias = null) Adds a LEFT JOIN clause to the query using the WfDocuments relation
 * @method     ChildWfMasterQuery rightJoinWfDocuments($relationAlias = null) Adds a RIGHT JOIN clause to the query using the WfDocuments relation
 * @method     ChildWfMasterQuery innerJoinWfDocuments($relationAlias = null) Adds a INNER JOIN clause to the query using the WfDocuments relation
 *
 * @method     ChildWfMasterQuery joinWithWfDocuments($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the WfDocuments relation
 *
 * @method     ChildWfMasterQuery leftJoinWithWfDocuments() Adds a LEFT JOIN clause and with to the query using the WfDocuments relation
 * @method     ChildWfMasterQuery rightJoinWithWfDocuments() Adds a RIGHT JOIN clause and with to the query using the WfDocuments relation
 * @method     ChildWfMasterQuery innerJoinWithWfDocuments() Adds a INNER JOIN clause and with to the query using the WfDocuments relation
 *
 * @method     ChildWfMasterQuery leftJoinWfRequests($relationAlias = null) Adds a LEFT JOIN clause to the query using the WfRequests relation
 * @method     ChildWfMasterQuery rightJoinWfRequests($relationAlias = null) Adds a RIGHT JOIN clause to the query using the WfRequests relation
 * @method     ChildWfMasterQuery innerJoinWfRequests($relationAlias = null) Adds a INNER JOIN clause to the query using the WfRequests relation
 *
 * @method     ChildWfMasterQuery joinWithWfRequests($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the WfRequests relation
 *
 * @method     ChildWfMasterQuery leftJoinWithWfRequests() Adds a LEFT JOIN clause and with to the query using the WfRequests relation
 * @method     ChildWfMasterQuery rightJoinWithWfRequests() Adds a RIGHT JOIN clause and with to the query using the WfRequests relation
 * @method     ChildWfMasterQuery innerJoinWithWfRequests() Adds a INNER JOIN clause and with to the query using the WfRequests relation
 *
 * @method     ChildWfMasterQuery leftJoinWfStatus($relationAlias = null) Adds a LEFT JOIN clause to the query using the WfStatus relation
 * @method     ChildWfMasterQuery rightJoinWfStatus($relationAlias = null) Adds a RIGHT JOIN clause to the query using the WfStatus relation
 * @method     ChildWfMasterQuery innerJoinWfStatus($relationAlias = null) Adds a INNER JOIN clause to the query using the WfStatus relation
 *
 * @method     ChildWfMasterQuery joinWithWfStatus($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the WfStatus relation
 *
 * @method     ChildWfMasterQuery leftJoinWithWfStatus() Adds a LEFT JOIN clause and with to the query using the WfStatus relation
 * @method     ChildWfMasterQuery rightJoinWithWfStatus() Adds a RIGHT JOIN clause and with to the query using the WfStatus relation
 * @method     ChildWfMasterQuery innerJoinWithWfStatus() Adds a INNER JOIN clause and with to the query using the WfStatus relation
 *
 * @method     ChildWfMasterQuery leftJoinWfSteps($relationAlias = null) Adds a LEFT JOIN clause to the query using the WfSteps relation
 * @method     ChildWfMasterQuery rightJoinWfSteps($relationAlias = null) Adds a RIGHT JOIN clause to the query using the WfSteps relation
 * @method     ChildWfMasterQuery innerJoinWfSteps($relationAlias = null) Adds a INNER JOIN clause to the query using the WfSteps relation
 *
 * @method     ChildWfMasterQuery joinWithWfSteps($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the WfSteps relation
 *
 * @method     ChildWfMasterQuery leftJoinWithWfSteps() Adds a LEFT JOIN clause and with to the query using the WfSteps relation
 * @method     ChildWfMasterQuery rightJoinWithWfSteps() Adds a RIGHT JOIN clause and with to the query using the WfSteps relation
 * @method     ChildWfMasterQuery innerJoinWithWfSteps() Adds a INNER JOIN clause and with to the query using the WfSteps relation
 *
 * @method     \entities\WfDocumentsQuery|\entities\WfRequestsQuery|\entities\WfStatusQuery|\entities\WfStepsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildWfMaster|null findOne(?ConnectionInterface $con = null) Return the first ChildWfMaster matching the query
 * @method     ChildWfMaster findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildWfMaster matching the query, or a new ChildWfMaster object populated from the query conditions when no match is found
 *
 * @method     ChildWfMaster|null findOneByWfId(int $wf_id) Return the first ChildWfMaster filtered by the wf_id column
 * @method     ChildWfMaster|null findOneByWfName(string $wf_name) Return the first ChildWfMaster filtered by the wf_name column
 *
 * @method     ChildWfMaster requirePk($key, ?ConnectionInterface $con = null) Return the ChildWfMaster by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWfMaster requireOne(?ConnectionInterface $con = null) Return the first ChildWfMaster matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildWfMaster requireOneByWfId(int $wf_id) Return the first ChildWfMaster filtered by the wf_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWfMaster requireOneByWfName(string $wf_name) Return the first ChildWfMaster filtered by the wf_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildWfMaster[]|Collection find(?ConnectionInterface $con = null) Return ChildWfMaster objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildWfMaster> find(?ConnectionInterface $con = null) Return ChildWfMaster objects based on current ModelCriteria
 *
 * @method     ChildWfMaster[]|Collection findByWfId(int|array<int> $wf_id) Return ChildWfMaster objects filtered by the wf_id column
 * @psalm-method Collection&\Traversable<ChildWfMaster> findByWfId(int|array<int> $wf_id) Return ChildWfMaster objects filtered by the wf_id column
 * @method     ChildWfMaster[]|Collection findByWfName(string|array<string> $wf_name) Return ChildWfMaster objects filtered by the wf_name column
 * @psalm-method Collection&\Traversable<ChildWfMaster> findByWfName(string|array<string> $wf_name) Return ChildWfMaster objects filtered by the wf_name column
 *
 * @method     ChildWfMaster[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildWfMaster> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class WfMasterQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\WfMasterQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\WfMaster', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildWfMasterQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildWfMasterQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildWfMasterQuery) {
            return $criteria;
        }
        $query = new ChildWfMasterQuery();
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
     * @return ChildWfMaster|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(WfMasterTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = WfMasterTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildWfMaster A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT wf_id, wf_name FROM wf_master WHERE wf_id = :p0';
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
            /** @var ChildWfMaster $obj */
            $obj = new ChildWfMaster();
            $obj->hydrate($row);
            WfMasterTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildWfMaster|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(WfMasterTableMap::COL_WF_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(WfMasterTableMap::COL_WF_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(WfMasterTableMap::COL_WF_ID, $wfId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($wfId['max'])) {
                $this->addUsingAlias(WfMasterTableMap::COL_WF_ID, $wfId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WfMasterTableMap::COL_WF_ID, $wfId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the wf_name column
     *
     * Example usage:
     * <code>
     * $query->filterByWfName('fooValue');   // WHERE wf_name = 'fooValue'
     * $query->filterByWfName('%fooValue%', Criteria::LIKE); // WHERE wf_name LIKE '%fooValue%'
     * $query->filterByWfName(['foo', 'bar']); // WHERE wf_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $wfName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWfName($wfName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($wfName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WfMasterTableMap::COL_WF_NAME, $wfName, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \entities\WfDocuments object
     *
     * @param \entities\WfDocuments|ObjectCollection $wfDocuments the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWfDocuments($wfDocuments, ?string $comparison = null)
    {
        if ($wfDocuments instanceof \entities\WfDocuments) {
            $this
                ->addUsingAlias(WfMasterTableMap::COL_WF_ID, $wfDocuments->getWfId(), $comparison);

            return $this;
        } elseif ($wfDocuments instanceof ObjectCollection) {
            $this
                ->useWfDocumentsQuery()
                ->filterByPrimaryKeys($wfDocuments->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByWfDocuments() only accepts arguments of type \entities\WfDocuments or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the WfDocuments relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinWfDocuments(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('WfDocuments');

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
            $this->addJoinObject($join, 'WfDocuments');
        }

        return $this;
    }

    /**
     * Use the WfDocuments relation WfDocuments object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\WfDocumentsQuery A secondary query class using the current class as primary query
     */
    public function useWfDocumentsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinWfDocuments($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'WfDocuments', '\entities\WfDocumentsQuery');
    }

    /**
     * Use the WfDocuments relation WfDocuments object
     *
     * @param callable(\entities\WfDocumentsQuery):\entities\WfDocumentsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withWfDocumentsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useWfDocumentsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to WfDocuments table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\WfDocumentsQuery The inner query object of the EXISTS statement
     */
    public function useWfDocumentsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\WfDocumentsQuery */
        $q = $this->useExistsQuery('WfDocuments', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to WfDocuments table for a NOT EXISTS query.
     *
     * @see useWfDocumentsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\WfDocumentsQuery The inner query object of the NOT EXISTS statement
     */
    public function useWfDocumentsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\WfDocumentsQuery */
        $q = $this->useExistsQuery('WfDocuments', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to WfDocuments table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\WfDocumentsQuery The inner query object of the IN statement
     */
    public function useInWfDocumentsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\WfDocumentsQuery */
        $q = $this->useInQuery('WfDocuments', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to WfDocuments table for a NOT IN query.
     *
     * @see useWfDocumentsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\WfDocumentsQuery The inner query object of the NOT IN statement
     */
    public function useNotInWfDocumentsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\WfDocumentsQuery */
        $q = $this->useInQuery('WfDocuments', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\WfRequests object
     *
     * @param \entities\WfRequests|ObjectCollection $wfRequests the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWfRequests($wfRequests, ?string $comparison = null)
    {
        if ($wfRequests instanceof \entities\WfRequests) {
            $this
                ->addUsingAlias(WfMasterTableMap::COL_WF_ID, $wfRequests->getWfId(), $comparison);

            return $this;
        } elseif ($wfRequests instanceof ObjectCollection) {
            $this
                ->useWfRequestsQuery()
                ->filterByPrimaryKeys($wfRequests->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByWfRequests() only accepts arguments of type \entities\WfRequests or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the WfRequests relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinWfRequests(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('WfRequests');

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
            $this->addJoinObject($join, 'WfRequests');
        }

        return $this;
    }

    /**
     * Use the WfRequests relation WfRequests object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\WfRequestsQuery A secondary query class using the current class as primary query
     */
    public function useWfRequestsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinWfRequests($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'WfRequests', '\entities\WfRequestsQuery');
    }

    /**
     * Use the WfRequests relation WfRequests object
     *
     * @param callable(\entities\WfRequestsQuery):\entities\WfRequestsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withWfRequestsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useWfRequestsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to WfRequests table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\WfRequestsQuery The inner query object of the EXISTS statement
     */
    public function useWfRequestsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\WfRequestsQuery */
        $q = $this->useExistsQuery('WfRequests', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to WfRequests table for a NOT EXISTS query.
     *
     * @see useWfRequestsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\WfRequestsQuery The inner query object of the NOT EXISTS statement
     */
    public function useWfRequestsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\WfRequestsQuery */
        $q = $this->useExistsQuery('WfRequests', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to WfRequests table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\WfRequestsQuery The inner query object of the IN statement
     */
    public function useInWfRequestsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\WfRequestsQuery */
        $q = $this->useInQuery('WfRequests', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to WfRequests table for a NOT IN query.
     *
     * @see useWfRequestsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\WfRequestsQuery The inner query object of the NOT IN statement
     */
    public function useNotInWfRequestsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\WfRequestsQuery */
        $q = $this->useInQuery('WfRequests', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\WfStatus object
     *
     * @param \entities\WfStatus|ObjectCollection $wfStatus the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWfStatus($wfStatus, ?string $comparison = null)
    {
        if ($wfStatus instanceof \entities\WfStatus) {
            $this
                ->addUsingAlias(WfMasterTableMap::COL_WF_ID, $wfStatus->getWfId(), $comparison);

            return $this;
        } elseif ($wfStatus instanceof ObjectCollection) {
            $this
                ->useWfStatusQuery()
                ->filterByPrimaryKeys($wfStatus->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByWfStatus() only accepts arguments of type \entities\WfStatus or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the WfStatus relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinWfStatus(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('WfStatus');

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
            $this->addJoinObject($join, 'WfStatus');
        }

        return $this;
    }

    /**
     * Use the WfStatus relation WfStatus object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\WfStatusQuery A secondary query class using the current class as primary query
     */
    public function useWfStatusQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinWfStatus($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'WfStatus', '\entities\WfStatusQuery');
    }

    /**
     * Use the WfStatus relation WfStatus object
     *
     * @param callable(\entities\WfStatusQuery):\entities\WfStatusQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withWfStatusQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useWfStatusQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to WfStatus table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\WfStatusQuery The inner query object of the EXISTS statement
     */
    public function useWfStatusExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\WfStatusQuery */
        $q = $this->useExistsQuery('WfStatus', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to WfStatus table for a NOT EXISTS query.
     *
     * @see useWfStatusExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\WfStatusQuery The inner query object of the NOT EXISTS statement
     */
    public function useWfStatusNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\WfStatusQuery */
        $q = $this->useExistsQuery('WfStatus', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to WfStatus table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\WfStatusQuery The inner query object of the IN statement
     */
    public function useInWfStatusQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\WfStatusQuery */
        $q = $this->useInQuery('WfStatus', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to WfStatus table for a NOT IN query.
     *
     * @see useWfStatusInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\WfStatusQuery The inner query object of the NOT IN statement
     */
    public function useNotInWfStatusQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\WfStatusQuery */
        $q = $this->useInQuery('WfStatus', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\WfSteps object
     *
     * @param \entities\WfSteps|ObjectCollection $wfSteps the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWfSteps($wfSteps, ?string $comparison = null)
    {
        if ($wfSteps instanceof \entities\WfSteps) {
            $this
                ->addUsingAlias(WfMasterTableMap::COL_WF_ID, $wfSteps->getWfId(), $comparison);

            return $this;
        } elseif ($wfSteps instanceof ObjectCollection) {
            $this
                ->useWfStepsQuery()
                ->filterByPrimaryKeys($wfSteps->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByWfSteps() only accepts arguments of type \entities\WfSteps or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the WfSteps relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinWfSteps(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('WfSteps');

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
            $this->addJoinObject($join, 'WfSteps');
        }

        return $this;
    }

    /**
     * Use the WfSteps relation WfSteps object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\WfStepsQuery A secondary query class using the current class as primary query
     */
    public function useWfStepsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinWfSteps($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'WfSteps', '\entities\WfStepsQuery');
    }

    /**
     * Use the WfSteps relation WfSteps object
     *
     * @param callable(\entities\WfStepsQuery):\entities\WfStepsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withWfStepsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useWfStepsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to WfSteps table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\WfStepsQuery The inner query object of the EXISTS statement
     */
    public function useWfStepsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\WfStepsQuery */
        $q = $this->useExistsQuery('WfSteps', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to WfSteps table for a NOT EXISTS query.
     *
     * @see useWfStepsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\WfStepsQuery The inner query object of the NOT EXISTS statement
     */
    public function useWfStepsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\WfStepsQuery */
        $q = $this->useExistsQuery('WfSteps', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to WfSteps table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\WfStepsQuery The inner query object of the IN statement
     */
    public function useInWfStepsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\WfStepsQuery */
        $q = $this->useInQuery('WfSteps', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to WfSteps table for a NOT IN query.
     *
     * @see useWfStepsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\WfStepsQuery The inner query object of the NOT IN statement
     */
    public function useNotInWfStepsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\WfStepsQuery */
        $q = $this->useInQuery('WfSteps', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildWfMaster $wfMaster Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($wfMaster = null)
    {
        if ($wfMaster) {
            $this->addUsingAlias(WfMasterTableMap::COL_WF_ID, $wfMaster->getWfId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the wf_master table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(WfMasterTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            WfMasterTableMap::clearInstancePool();
            WfMasterTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(WfMasterTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(WfMasterTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            WfMasterTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            WfMasterTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
