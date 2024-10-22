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
use entities\WfDocuments as ChildWfDocuments;
use entities\WfDocumentsQuery as ChildWfDocumentsQuery;
use entities\Map\WfDocumentsTableMap;

/**
 * Base class that represents a query for the `wf_documents` table.
 *
 * @method     ChildWfDocumentsQuery orderByWfDocId($order = Criteria::ASC) Order by the wf_doc_id column
 * @method     ChildWfDocumentsQuery orderByWfId($order = Criteria::ASC) Order by the wf_id column
 * @method     ChildWfDocumentsQuery orderByWfDocName($order = Criteria::ASC) Order by the wf_doc_name column
 * @method     ChildWfDocumentsQuery orderByWfEntityName($order = Criteria::ASC) Order by the wf_entity_name column
 * @method     ChildWfDocumentsQuery orderByWfPkName($order = Criteria::ASC) Order by the wf_pk_name column
 * @method     ChildWfDocumentsQuery orderByWfActionRoute($order = Criteria::ASC) Order by the wf_action_route column
 * @method     ChildWfDocumentsQuery orderByWfUrlPk($order = Criteria::ASC) Order by the wf_url_pk column
 * @method     ChildWfDocumentsQuery orderByWfStepsRoute($order = Criteria::ASC) Order by the wf_steps_route column
 * @method     ChildWfDocumentsQuery orderByWfStatusKey($order = Criteria::ASC) Order by the wf_status_key column
 *
 * @method     ChildWfDocumentsQuery groupByWfDocId() Group by the wf_doc_id column
 * @method     ChildWfDocumentsQuery groupByWfId() Group by the wf_id column
 * @method     ChildWfDocumentsQuery groupByWfDocName() Group by the wf_doc_name column
 * @method     ChildWfDocumentsQuery groupByWfEntityName() Group by the wf_entity_name column
 * @method     ChildWfDocumentsQuery groupByWfPkName() Group by the wf_pk_name column
 * @method     ChildWfDocumentsQuery groupByWfActionRoute() Group by the wf_action_route column
 * @method     ChildWfDocumentsQuery groupByWfUrlPk() Group by the wf_url_pk column
 * @method     ChildWfDocumentsQuery groupByWfStepsRoute() Group by the wf_steps_route column
 * @method     ChildWfDocumentsQuery groupByWfStatusKey() Group by the wf_status_key column
 *
 * @method     ChildWfDocumentsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildWfDocumentsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildWfDocumentsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildWfDocumentsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildWfDocumentsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildWfDocumentsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildWfDocumentsQuery leftJoinWfMaster($relationAlias = null) Adds a LEFT JOIN clause to the query using the WfMaster relation
 * @method     ChildWfDocumentsQuery rightJoinWfMaster($relationAlias = null) Adds a RIGHT JOIN clause to the query using the WfMaster relation
 * @method     ChildWfDocumentsQuery innerJoinWfMaster($relationAlias = null) Adds a INNER JOIN clause to the query using the WfMaster relation
 *
 * @method     ChildWfDocumentsQuery joinWithWfMaster($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the WfMaster relation
 *
 * @method     ChildWfDocumentsQuery leftJoinWithWfMaster() Adds a LEFT JOIN clause and with to the query using the WfMaster relation
 * @method     ChildWfDocumentsQuery rightJoinWithWfMaster() Adds a RIGHT JOIN clause and with to the query using the WfMaster relation
 * @method     ChildWfDocumentsQuery innerJoinWithWfMaster() Adds a INNER JOIN clause and with to the query using the WfMaster relation
 *
 * @method     ChildWfDocumentsQuery leftJoinWfLog($relationAlias = null) Adds a LEFT JOIN clause to the query using the WfLog relation
 * @method     ChildWfDocumentsQuery rightJoinWfLog($relationAlias = null) Adds a RIGHT JOIN clause to the query using the WfLog relation
 * @method     ChildWfDocumentsQuery innerJoinWfLog($relationAlias = null) Adds a INNER JOIN clause to the query using the WfLog relation
 *
 * @method     ChildWfDocumentsQuery joinWithWfLog($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the WfLog relation
 *
 * @method     ChildWfDocumentsQuery leftJoinWithWfLog() Adds a LEFT JOIN clause and with to the query using the WfLog relation
 * @method     ChildWfDocumentsQuery rightJoinWithWfLog() Adds a RIGHT JOIN clause and with to the query using the WfLog relation
 * @method     ChildWfDocumentsQuery innerJoinWithWfLog() Adds a INNER JOIN clause and with to the query using the WfLog relation
 *
 * @method     ChildWfDocumentsQuery leftJoinWfRequests($relationAlias = null) Adds a LEFT JOIN clause to the query using the WfRequests relation
 * @method     ChildWfDocumentsQuery rightJoinWfRequests($relationAlias = null) Adds a RIGHT JOIN clause to the query using the WfRequests relation
 * @method     ChildWfDocumentsQuery innerJoinWfRequests($relationAlias = null) Adds a INNER JOIN clause to the query using the WfRequests relation
 *
 * @method     ChildWfDocumentsQuery joinWithWfRequests($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the WfRequests relation
 *
 * @method     ChildWfDocumentsQuery leftJoinWithWfRequests() Adds a LEFT JOIN clause and with to the query using the WfRequests relation
 * @method     ChildWfDocumentsQuery rightJoinWithWfRequests() Adds a RIGHT JOIN clause and with to the query using the WfRequests relation
 * @method     ChildWfDocumentsQuery innerJoinWithWfRequests() Adds a INNER JOIN clause and with to the query using the WfRequests relation
 *
 * @method     \entities\WfMasterQuery|\entities\WfLogQuery|\entities\WfRequestsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildWfDocuments|null findOne(?ConnectionInterface $con = null) Return the first ChildWfDocuments matching the query
 * @method     ChildWfDocuments findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildWfDocuments matching the query, or a new ChildWfDocuments object populated from the query conditions when no match is found
 *
 * @method     ChildWfDocuments|null findOneByWfDocId(int $wf_doc_id) Return the first ChildWfDocuments filtered by the wf_doc_id column
 * @method     ChildWfDocuments|null findOneByWfId(int $wf_id) Return the first ChildWfDocuments filtered by the wf_id column
 * @method     ChildWfDocuments|null findOneByWfDocName(string $wf_doc_name) Return the first ChildWfDocuments filtered by the wf_doc_name column
 * @method     ChildWfDocuments|null findOneByWfEntityName(string $wf_entity_name) Return the first ChildWfDocuments filtered by the wf_entity_name column
 * @method     ChildWfDocuments|null findOneByWfPkName(string $wf_pk_name) Return the first ChildWfDocuments filtered by the wf_pk_name column
 * @method     ChildWfDocuments|null findOneByWfActionRoute(string $wf_action_route) Return the first ChildWfDocuments filtered by the wf_action_route column
 * @method     ChildWfDocuments|null findOneByWfUrlPk(int $wf_url_pk) Return the first ChildWfDocuments filtered by the wf_url_pk column
 * @method     ChildWfDocuments|null findOneByWfStepsRoute(string $wf_steps_route) Return the first ChildWfDocuments filtered by the wf_steps_route column
 * @method     ChildWfDocuments|null findOneByWfStatusKey(string $wf_status_key) Return the first ChildWfDocuments filtered by the wf_status_key column
 *
 * @method     ChildWfDocuments requirePk($key, ?ConnectionInterface $con = null) Return the ChildWfDocuments by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWfDocuments requireOne(?ConnectionInterface $con = null) Return the first ChildWfDocuments matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildWfDocuments requireOneByWfDocId(int $wf_doc_id) Return the first ChildWfDocuments filtered by the wf_doc_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWfDocuments requireOneByWfId(int $wf_id) Return the first ChildWfDocuments filtered by the wf_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWfDocuments requireOneByWfDocName(string $wf_doc_name) Return the first ChildWfDocuments filtered by the wf_doc_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWfDocuments requireOneByWfEntityName(string $wf_entity_name) Return the first ChildWfDocuments filtered by the wf_entity_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWfDocuments requireOneByWfPkName(string $wf_pk_name) Return the first ChildWfDocuments filtered by the wf_pk_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWfDocuments requireOneByWfActionRoute(string $wf_action_route) Return the first ChildWfDocuments filtered by the wf_action_route column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWfDocuments requireOneByWfUrlPk(int $wf_url_pk) Return the first ChildWfDocuments filtered by the wf_url_pk column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWfDocuments requireOneByWfStepsRoute(string $wf_steps_route) Return the first ChildWfDocuments filtered by the wf_steps_route column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWfDocuments requireOneByWfStatusKey(string $wf_status_key) Return the first ChildWfDocuments filtered by the wf_status_key column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildWfDocuments[]|Collection find(?ConnectionInterface $con = null) Return ChildWfDocuments objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildWfDocuments> find(?ConnectionInterface $con = null) Return ChildWfDocuments objects based on current ModelCriteria
 *
 * @method     ChildWfDocuments[]|Collection findByWfDocId(int|array<int> $wf_doc_id) Return ChildWfDocuments objects filtered by the wf_doc_id column
 * @psalm-method Collection&\Traversable<ChildWfDocuments> findByWfDocId(int|array<int> $wf_doc_id) Return ChildWfDocuments objects filtered by the wf_doc_id column
 * @method     ChildWfDocuments[]|Collection findByWfId(int|array<int> $wf_id) Return ChildWfDocuments objects filtered by the wf_id column
 * @psalm-method Collection&\Traversable<ChildWfDocuments> findByWfId(int|array<int> $wf_id) Return ChildWfDocuments objects filtered by the wf_id column
 * @method     ChildWfDocuments[]|Collection findByWfDocName(string|array<string> $wf_doc_name) Return ChildWfDocuments objects filtered by the wf_doc_name column
 * @psalm-method Collection&\Traversable<ChildWfDocuments> findByWfDocName(string|array<string> $wf_doc_name) Return ChildWfDocuments objects filtered by the wf_doc_name column
 * @method     ChildWfDocuments[]|Collection findByWfEntityName(string|array<string> $wf_entity_name) Return ChildWfDocuments objects filtered by the wf_entity_name column
 * @psalm-method Collection&\Traversable<ChildWfDocuments> findByWfEntityName(string|array<string> $wf_entity_name) Return ChildWfDocuments objects filtered by the wf_entity_name column
 * @method     ChildWfDocuments[]|Collection findByWfPkName(string|array<string> $wf_pk_name) Return ChildWfDocuments objects filtered by the wf_pk_name column
 * @psalm-method Collection&\Traversable<ChildWfDocuments> findByWfPkName(string|array<string> $wf_pk_name) Return ChildWfDocuments objects filtered by the wf_pk_name column
 * @method     ChildWfDocuments[]|Collection findByWfActionRoute(string|array<string> $wf_action_route) Return ChildWfDocuments objects filtered by the wf_action_route column
 * @psalm-method Collection&\Traversable<ChildWfDocuments> findByWfActionRoute(string|array<string> $wf_action_route) Return ChildWfDocuments objects filtered by the wf_action_route column
 * @method     ChildWfDocuments[]|Collection findByWfUrlPk(int|array<int> $wf_url_pk) Return ChildWfDocuments objects filtered by the wf_url_pk column
 * @psalm-method Collection&\Traversable<ChildWfDocuments> findByWfUrlPk(int|array<int> $wf_url_pk) Return ChildWfDocuments objects filtered by the wf_url_pk column
 * @method     ChildWfDocuments[]|Collection findByWfStepsRoute(string|array<string> $wf_steps_route) Return ChildWfDocuments objects filtered by the wf_steps_route column
 * @psalm-method Collection&\Traversable<ChildWfDocuments> findByWfStepsRoute(string|array<string> $wf_steps_route) Return ChildWfDocuments objects filtered by the wf_steps_route column
 * @method     ChildWfDocuments[]|Collection findByWfStatusKey(string|array<string> $wf_status_key) Return ChildWfDocuments objects filtered by the wf_status_key column
 * @psalm-method Collection&\Traversable<ChildWfDocuments> findByWfStatusKey(string|array<string> $wf_status_key) Return ChildWfDocuments objects filtered by the wf_status_key column
 *
 * @method     ChildWfDocuments[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildWfDocuments> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class WfDocumentsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\WfDocumentsQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\WfDocuments', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildWfDocumentsQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildWfDocumentsQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildWfDocumentsQuery) {
            return $criteria;
        }
        $query = new ChildWfDocumentsQuery();
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
     * @return ChildWfDocuments|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(WfDocumentsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = WfDocumentsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildWfDocuments A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT wf_doc_id, wf_id, wf_doc_name, wf_entity_name, wf_pk_name, wf_action_route, wf_url_pk, wf_steps_route, wf_status_key FROM wf_documents WHERE wf_doc_id = :p0';
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
            /** @var ChildWfDocuments $obj */
            $obj = new ChildWfDocuments();
            $obj->hydrate($row);
            WfDocumentsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildWfDocuments|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(WfDocumentsTableMap::COL_WF_DOC_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(WfDocumentsTableMap::COL_WF_DOC_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the wf_doc_id column
     *
     * Example usage:
     * <code>
     * $query->filterByWfDocId(1234); // WHERE wf_doc_id = 1234
     * $query->filterByWfDocId(array(12, 34)); // WHERE wf_doc_id IN (12, 34)
     * $query->filterByWfDocId(array('min' => 12)); // WHERE wf_doc_id > 12
     * </code>
     *
     * @param mixed $wfDocId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWfDocId($wfDocId = null, ?string $comparison = null)
    {
        if (is_array($wfDocId)) {
            $useMinMax = false;
            if (isset($wfDocId['min'])) {
                $this->addUsingAlias(WfDocumentsTableMap::COL_WF_DOC_ID, $wfDocId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($wfDocId['max'])) {
                $this->addUsingAlias(WfDocumentsTableMap::COL_WF_DOC_ID, $wfDocId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WfDocumentsTableMap::COL_WF_DOC_ID, $wfDocId, $comparison);

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
                $this->addUsingAlias(WfDocumentsTableMap::COL_WF_ID, $wfId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($wfId['max'])) {
                $this->addUsingAlias(WfDocumentsTableMap::COL_WF_ID, $wfId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WfDocumentsTableMap::COL_WF_ID, $wfId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the wf_doc_name column
     *
     * Example usage:
     * <code>
     * $query->filterByWfDocName('fooValue');   // WHERE wf_doc_name = 'fooValue'
     * $query->filterByWfDocName('%fooValue%', Criteria::LIKE); // WHERE wf_doc_name LIKE '%fooValue%'
     * $query->filterByWfDocName(['foo', 'bar']); // WHERE wf_doc_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $wfDocName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWfDocName($wfDocName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($wfDocName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WfDocumentsTableMap::COL_WF_DOC_NAME, $wfDocName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the wf_entity_name column
     *
     * Example usage:
     * <code>
     * $query->filterByWfEntityName('fooValue');   // WHERE wf_entity_name = 'fooValue'
     * $query->filterByWfEntityName('%fooValue%', Criteria::LIKE); // WHERE wf_entity_name LIKE '%fooValue%'
     * $query->filterByWfEntityName(['foo', 'bar']); // WHERE wf_entity_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $wfEntityName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWfEntityName($wfEntityName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($wfEntityName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WfDocumentsTableMap::COL_WF_ENTITY_NAME, $wfEntityName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the wf_pk_name column
     *
     * Example usage:
     * <code>
     * $query->filterByWfPkName('fooValue');   // WHERE wf_pk_name = 'fooValue'
     * $query->filterByWfPkName('%fooValue%', Criteria::LIKE); // WHERE wf_pk_name LIKE '%fooValue%'
     * $query->filterByWfPkName(['foo', 'bar']); // WHERE wf_pk_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $wfPkName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWfPkName($wfPkName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($wfPkName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WfDocumentsTableMap::COL_WF_PK_NAME, $wfPkName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the wf_action_route column
     *
     * Example usage:
     * <code>
     * $query->filterByWfActionRoute('fooValue');   // WHERE wf_action_route = 'fooValue'
     * $query->filterByWfActionRoute('%fooValue%', Criteria::LIKE); // WHERE wf_action_route LIKE '%fooValue%'
     * $query->filterByWfActionRoute(['foo', 'bar']); // WHERE wf_action_route IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $wfActionRoute The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWfActionRoute($wfActionRoute = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($wfActionRoute)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WfDocumentsTableMap::COL_WF_ACTION_ROUTE, $wfActionRoute, $comparison);

        return $this;
    }

    /**
     * Filter the query on the wf_url_pk column
     *
     * Example usage:
     * <code>
     * $query->filterByWfUrlPk(1234); // WHERE wf_url_pk = 1234
     * $query->filterByWfUrlPk(array(12, 34)); // WHERE wf_url_pk IN (12, 34)
     * $query->filterByWfUrlPk(array('min' => 12)); // WHERE wf_url_pk > 12
     * </code>
     *
     * @param mixed $wfUrlPk The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWfUrlPk($wfUrlPk = null, ?string $comparison = null)
    {
        if (is_array($wfUrlPk)) {
            $useMinMax = false;
            if (isset($wfUrlPk['min'])) {
                $this->addUsingAlias(WfDocumentsTableMap::COL_WF_URL_PK, $wfUrlPk['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($wfUrlPk['max'])) {
                $this->addUsingAlias(WfDocumentsTableMap::COL_WF_URL_PK, $wfUrlPk['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WfDocumentsTableMap::COL_WF_URL_PK, $wfUrlPk, $comparison);

        return $this;
    }

    /**
     * Filter the query on the wf_steps_route column
     *
     * Example usage:
     * <code>
     * $query->filterByWfStepsRoute('fooValue');   // WHERE wf_steps_route = 'fooValue'
     * $query->filterByWfStepsRoute('%fooValue%', Criteria::LIKE); // WHERE wf_steps_route LIKE '%fooValue%'
     * $query->filterByWfStepsRoute(['foo', 'bar']); // WHERE wf_steps_route IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $wfStepsRoute The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWfStepsRoute($wfStepsRoute = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($wfStepsRoute)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WfDocumentsTableMap::COL_WF_STEPS_ROUTE, $wfStepsRoute, $comparison);

        return $this;
    }

    /**
     * Filter the query on the wf_status_key column
     *
     * Example usage:
     * <code>
     * $query->filterByWfStatusKey('fooValue');   // WHERE wf_status_key = 'fooValue'
     * $query->filterByWfStatusKey('%fooValue%', Criteria::LIKE); // WHERE wf_status_key LIKE '%fooValue%'
     * $query->filterByWfStatusKey(['foo', 'bar']); // WHERE wf_status_key IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $wfStatusKey The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWfStatusKey($wfStatusKey = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($wfStatusKey)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WfDocumentsTableMap::COL_WF_STATUS_KEY, $wfStatusKey, $comparison);

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
                ->addUsingAlias(WfDocumentsTableMap::COL_WF_ID, $wfMaster->getWfId(), $comparison);
        } elseif ($wfMaster instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(WfDocumentsTableMap::COL_WF_ID, $wfMaster->toKeyValue('PrimaryKey', 'WfId'), $comparison);

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
     * Filter the query by a related \entities\WfLog object
     *
     * @param \entities\WfLog|ObjectCollection $wfLog the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWfLog($wfLog, ?string $comparison = null)
    {
        if ($wfLog instanceof \entities\WfLog) {
            $this
                ->addUsingAlias(WfDocumentsTableMap::COL_WF_DOC_ID, $wfLog->getWfDocId(), $comparison);

            return $this;
        } elseif ($wfLog instanceof ObjectCollection) {
            $this
                ->useWfLogQuery()
                ->filterByPrimaryKeys($wfLog->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByWfLog() only accepts arguments of type \entities\WfLog or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the WfLog relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinWfLog(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('WfLog');

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
            $this->addJoinObject($join, 'WfLog');
        }

        return $this;
    }

    /**
     * Use the WfLog relation WfLog object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\WfLogQuery A secondary query class using the current class as primary query
     */
    public function useWfLogQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinWfLog($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'WfLog', '\entities\WfLogQuery');
    }

    /**
     * Use the WfLog relation WfLog object
     *
     * @param callable(\entities\WfLogQuery):\entities\WfLogQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withWfLogQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useWfLogQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to WfLog table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\WfLogQuery The inner query object of the EXISTS statement
     */
    public function useWfLogExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\WfLogQuery */
        $q = $this->useExistsQuery('WfLog', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to WfLog table for a NOT EXISTS query.
     *
     * @see useWfLogExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\WfLogQuery The inner query object of the NOT EXISTS statement
     */
    public function useWfLogNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\WfLogQuery */
        $q = $this->useExistsQuery('WfLog', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to WfLog table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\WfLogQuery The inner query object of the IN statement
     */
    public function useInWfLogQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\WfLogQuery */
        $q = $this->useInQuery('WfLog', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to WfLog table for a NOT IN query.
     *
     * @see useWfLogInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\WfLogQuery The inner query object of the NOT IN statement
     */
    public function useNotInWfLogQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\WfLogQuery */
        $q = $this->useInQuery('WfLog', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(WfDocumentsTableMap::COL_WF_DOC_ID, $wfRequests->getWfDocId(), $comparison);

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
     * Exclude object from result
     *
     * @param ChildWfDocuments $wfDocuments Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($wfDocuments = null)
    {
        if ($wfDocuments) {
            $this->addUsingAlias(WfDocumentsTableMap::COL_WF_DOC_ID, $wfDocuments->getWfDocId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the wf_documents table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(WfDocumentsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            WfDocumentsTableMap::clearInstancePool();
            WfDocumentsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(WfDocumentsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(WfDocumentsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            WfDocumentsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            WfDocumentsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
