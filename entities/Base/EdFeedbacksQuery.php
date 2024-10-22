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
use entities\EdFeedbacks as ChildEdFeedbacks;
use entities\EdFeedbacksQuery as ChildEdFeedbacksQuery;
use entities\Map\EdFeedbacksTableMap;

/**
 * Base class that represents a query for the `ed_feedbacks` table.
 *
 * @method     ChildEdFeedbacksQuery orderByEdFeedbackId($order = Criteria::ASC) Order by the ed_feedback_id column
 * @method     ChildEdFeedbacksQuery orderByOutletOrgDataId($order = Criteria::ASC) Order by the outlet_org_data_id column
 * @method     ChildEdFeedbacksQuery orderByPresentationId($order = Criteria::ASC) Order by the presentation_id column
 * @method     ChildEdFeedbacksQuery orderBySlideIndex($order = Criteria::ASC) Order by the slide_index column
 * @method     ChildEdFeedbacksQuery orderBySlideName($order = Criteria::ASC) Order by the slide_name column
 * @method     ChildEdFeedbacksQuery orderByEmployeeId($order = Criteria::ASC) Order by the employee_id column
 * @method     ChildEdFeedbacksQuery orderBySlideLike($order = Criteria::ASC) Order by the slide_like column
 * @method     ChildEdFeedbacksQuery orderByIlike($order = Criteria::ASC) Order by the ilike column
 * @method     ChildEdFeedbacksQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildEdFeedbacksQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildEdFeedbacksQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 *
 * @method     ChildEdFeedbacksQuery groupByEdFeedbackId() Group by the ed_feedback_id column
 * @method     ChildEdFeedbacksQuery groupByOutletOrgDataId() Group by the outlet_org_data_id column
 * @method     ChildEdFeedbacksQuery groupByPresentationId() Group by the presentation_id column
 * @method     ChildEdFeedbacksQuery groupBySlideIndex() Group by the slide_index column
 * @method     ChildEdFeedbacksQuery groupBySlideName() Group by the slide_name column
 * @method     ChildEdFeedbacksQuery groupByEmployeeId() Group by the employee_id column
 * @method     ChildEdFeedbacksQuery groupBySlideLike() Group by the slide_like column
 * @method     ChildEdFeedbacksQuery groupByIlike() Group by the ilike column
 * @method     ChildEdFeedbacksQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildEdFeedbacksQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildEdFeedbacksQuery groupByCompanyId() Group by the company_id column
 *
 * @method     ChildEdFeedbacksQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildEdFeedbacksQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildEdFeedbacksQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildEdFeedbacksQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildEdFeedbacksQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildEdFeedbacksQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildEdFeedbacksQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildEdFeedbacksQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildEdFeedbacksQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildEdFeedbacksQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildEdFeedbacksQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildEdFeedbacksQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildEdFeedbacksQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     ChildEdFeedbacksQuery leftJoinEdPresentations($relationAlias = null) Adds a LEFT JOIN clause to the query using the EdPresentations relation
 * @method     ChildEdFeedbacksQuery rightJoinEdPresentations($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EdPresentations relation
 * @method     ChildEdFeedbacksQuery innerJoinEdPresentations($relationAlias = null) Adds a INNER JOIN clause to the query using the EdPresentations relation
 *
 * @method     ChildEdFeedbacksQuery joinWithEdPresentations($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the EdPresentations relation
 *
 * @method     ChildEdFeedbacksQuery leftJoinWithEdPresentations() Adds a LEFT JOIN clause and with to the query using the EdPresentations relation
 * @method     ChildEdFeedbacksQuery rightJoinWithEdPresentations() Adds a RIGHT JOIN clause and with to the query using the EdPresentations relation
 * @method     ChildEdFeedbacksQuery innerJoinWithEdPresentations() Adds a INNER JOIN clause and with to the query using the EdPresentations relation
 *
 * @method     ChildEdFeedbacksQuery leftJoinOutletOrgData($relationAlias = null) Adds a LEFT JOIN clause to the query using the OutletOrgData relation
 * @method     ChildEdFeedbacksQuery rightJoinOutletOrgData($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OutletOrgData relation
 * @method     ChildEdFeedbacksQuery innerJoinOutletOrgData($relationAlias = null) Adds a INNER JOIN clause to the query using the OutletOrgData relation
 *
 * @method     ChildEdFeedbacksQuery joinWithOutletOrgData($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OutletOrgData relation
 *
 * @method     ChildEdFeedbacksQuery leftJoinWithOutletOrgData() Adds a LEFT JOIN clause and with to the query using the OutletOrgData relation
 * @method     ChildEdFeedbacksQuery rightJoinWithOutletOrgData() Adds a RIGHT JOIN clause and with to the query using the OutletOrgData relation
 * @method     ChildEdFeedbacksQuery innerJoinWithOutletOrgData() Adds a INNER JOIN clause and with to the query using the OutletOrgData relation
 *
 * @method     \entities\CompanyQuery|\entities\EdPresentationsQuery|\entities\OutletOrgDataQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildEdFeedbacks|null findOne(?ConnectionInterface $con = null) Return the first ChildEdFeedbacks matching the query
 * @method     ChildEdFeedbacks findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildEdFeedbacks matching the query, or a new ChildEdFeedbacks object populated from the query conditions when no match is found
 *
 * @method     ChildEdFeedbacks|null findOneByEdFeedbackId(int $ed_feedback_id) Return the first ChildEdFeedbacks filtered by the ed_feedback_id column
 * @method     ChildEdFeedbacks|null findOneByOutletOrgDataId(int $outlet_org_data_id) Return the first ChildEdFeedbacks filtered by the outlet_org_data_id column
 * @method     ChildEdFeedbacks|null findOneByPresentationId(int $presentation_id) Return the first ChildEdFeedbacks filtered by the presentation_id column
 * @method     ChildEdFeedbacks|null findOneBySlideIndex(int $slide_index) Return the first ChildEdFeedbacks filtered by the slide_index column
 * @method     ChildEdFeedbacks|null findOneBySlideName(string $slide_name) Return the first ChildEdFeedbacks filtered by the slide_name column
 * @method     ChildEdFeedbacks|null findOneByEmployeeId(int $employee_id) Return the first ChildEdFeedbacks filtered by the employee_id column
 * @method     ChildEdFeedbacks|null findOneBySlideLike(int $slide_like) Return the first ChildEdFeedbacks filtered by the slide_like column
 * @method     ChildEdFeedbacks|null findOneByIlike(int $ilike) Return the first ChildEdFeedbacks filtered by the ilike column
 * @method     ChildEdFeedbacks|null findOneByCreatedAt(string $created_at) Return the first ChildEdFeedbacks filtered by the created_at column
 * @method     ChildEdFeedbacks|null findOneByUpdatedAt(string $updated_at) Return the first ChildEdFeedbacks filtered by the updated_at column
 * @method     ChildEdFeedbacks|null findOneByCompanyId(int $company_id) Return the first ChildEdFeedbacks filtered by the company_id column
 *
 * @method     ChildEdFeedbacks requirePk($key, ?ConnectionInterface $con = null) Return the ChildEdFeedbacks by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEdFeedbacks requireOne(?ConnectionInterface $con = null) Return the first ChildEdFeedbacks matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEdFeedbacks requireOneByEdFeedbackId(int $ed_feedback_id) Return the first ChildEdFeedbacks filtered by the ed_feedback_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEdFeedbacks requireOneByOutletOrgDataId(int $outlet_org_data_id) Return the first ChildEdFeedbacks filtered by the outlet_org_data_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEdFeedbacks requireOneByPresentationId(int $presentation_id) Return the first ChildEdFeedbacks filtered by the presentation_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEdFeedbacks requireOneBySlideIndex(int $slide_index) Return the first ChildEdFeedbacks filtered by the slide_index column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEdFeedbacks requireOneBySlideName(string $slide_name) Return the first ChildEdFeedbacks filtered by the slide_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEdFeedbacks requireOneByEmployeeId(int $employee_id) Return the first ChildEdFeedbacks filtered by the employee_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEdFeedbacks requireOneBySlideLike(int $slide_like) Return the first ChildEdFeedbacks filtered by the slide_like column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEdFeedbacks requireOneByIlike(int $ilike) Return the first ChildEdFeedbacks filtered by the ilike column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEdFeedbacks requireOneByCreatedAt(string $created_at) Return the first ChildEdFeedbacks filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEdFeedbacks requireOneByUpdatedAt(string $updated_at) Return the first ChildEdFeedbacks filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEdFeedbacks requireOneByCompanyId(int $company_id) Return the first ChildEdFeedbacks filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEdFeedbacks[]|Collection find(?ConnectionInterface $con = null) Return ChildEdFeedbacks objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildEdFeedbacks> find(?ConnectionInterface $con = null) Return ChildEdFeedbacks objects based on current ModelCriteria
 *
 * @method     ChildEdFeedbacks[]|Collection findByEdFeedbackId(int|array<int> $ed_feedback_id) Return ChildEdFeedbacks objects filtered by the ed_feedback_id column
 * @psalm-method Collection&\Traversable<ChildEdFeedbacks> findByEdFeedbackId(int|array<int> $ed_feedback_id) Return ChildEdFeedbacks objects filtered by the ed_feedback_id column
 * @method     ChildEdFeedbacks[]|Collection findByOutletOrgDataId(int|array<int> $outlet_org_data_id) Return ChildEdFeedbacks objects filtered by the outlet_org_data_id column
 * @psalm-method Collection&\Traversable<ChildEdFeedbacks> findByOutletOrgDataId(int|array<int> $outlet_org_data_id) Return ChildEdFeedbacks objects filtered by the outlet_org_data_id column
 * @method     ChildEdFeedbacks[]|Collection findByPresentationId(int|array<int> $presentation_id) Return ChildEdFeedbacks objects filtered by the presentation_id column
 * @psalm-method Collection&\Traversable<ChildEdFeedbacks> findByPresentationId(int|array<int> $presentation_id) Return ChildEdFeedbacks objects filtered by the presentation_id column
 * @method     ChildEdFeedbacks[]|Collection findBySlideIndex(int|array<int> $slide_index) Return ChildEdFeedbacks objects filtered by the slide_index column
 * @psalm-method Collection&\Traversable<ChildEdFeedbacks> findBySlideIndex(int|array<int> $slide_index) Return ChildEdFeedbacks objects filtered by the slide_index column
 * @method     ChildEdFeedbacks[]|Collection findBySlideName(string|array<string> $slide_name) Return ChildEdFeedbacks objects filtered by the slide_name column
 * @psalm-method Collection&\Traversable<ChildEdFeedbacks> findBySlideName(string|array<string> $slide_name) Return ChildEdFeedbacks objects filtered by the slide_name column
 * @method     ChildEdFeedbacks[]|Collection findByEmployeeId(int|array<int> $employee_id) Return ChildEdFeedbacks objects filtered by the employee_id column
 * @psalm-method Collection&\Traversable<ChildEdFeedbacks> findByEmployeeId(int|array<int> $employee_id) Return ChildEdFeedbacks objects filtered by the employee_id column
 * @method     ChildEdFeedbacks[]|Collection findBySlideLike(int|array<int> $slide_like) Return ChildEdFeedbacks objects filtered by the slide_like column
 * @psalm-method Collection&\Traversable<ChildEdFeedbacks> findBySlideLike(int|array<int> $slide_like) Return ChildEdFeedbacks objects filtered by the slide_like column
 * @method     ChildEdFeedbacks[]|Collection findByIlike(int|array<int> $ilike) Return ChildEdFeedbacks objects filtered by the ilike column
 * @psalm-method Collection&\Traversable<ChildEdFeedbacks> findByIlike(int|array<int> $ilike) Return ChildEdFeedbacks objects filtered by the ilike column
 * @method     ChildEdFeedbacks[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildEdFeedbacks objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildEdFeedbacks> findByCreatedAt(string|array<string> $created_at) Return ChildEdFeedbacks objects filtered by the created_at column
 * @method     ChildEdFeedbacks[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildEdFeedbacks objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildEdFeedbacks> findByUpdatedAt(string|array<string> $updated_at) Return ChildEdFeedbacks objects filtered by the updated_at column
 * @method     ChildEdFeedbacks[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildEdFeedbacks objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildEdFeedbacks> findByCompanyId(int|array<int> $company_id) Return ChildEdFeedbacks objects filtered by the company_id column
 *
 * @method     ChildEdFeedbacks[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildEdFeedbacks> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class EdFeedbacksQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\EdFeedbacksQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\EdFeedbacks', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildEdFeedbacksQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildEdFeedbacksQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildEdFeedbacksQuery) {
            return $criteria;
        }
        $query = new ChildEdFeedbacksQuery();
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
     * @return ChildEdFeedbacks|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(EdFeedbacksTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = EdFeedbacksTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildEdFeedbacks A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT ed_feedback_id, outlet_org_data_id, presentation_id, slide_index, slide_name, employee_id, slide_like, ilike, created_at, updated_at, company_id FROM ed_feedbacks WHERE ed_feedback_id = :p0';
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
            /** @var ChildEdFeedbacks $obj */
            $obj = new ChildEdFeedbacks();
            $obj->hydrate($row);
            EdFeedbacksTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildEdFeedbacks|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(EdFeedbacksTableMap::COL_ED_FEEDBACK_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(EdFeedbacksTableMap::COL_ED_FEEDBACK_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the ed_feedback_id column
     *
     * Example usage:
     * <code>
     * $query->filterByEdFeedbackId(1234); // WHERE ed_feedback_id = 1234
     * $query->filterByEdFeedbackId(array(12, 34)); // WHERE ed_feedback_id IN (12, 34)
     * $query->filterByEdFeedbackId(array('min' => 12)); // WHERE ed_feedback_id > 12
     * </code>
     *
     * @param mixed $edFeedbackId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEdFeedbackId($edFeedbackId = null, ?string $comparison = null)
    {
        if (is_array($edFeedbackId)) {
            $useMinMax = false;
            if (isset($edFeedbackId['min'])) {
                $this->addUsingAlias(EdFeedbacksTableMap::COL_ED_FEEDBACK_ID, $edFeedbackId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($edFeedbackId['max'])) {
                $this->addUsingAlias(EdFeedbacksTableMap::COL_ED_FEEDBACK_ID, $edFeedbackId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EdFeedbacksTableMap::COL_ED_FEEDBACK_ID, $edFeedbackId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_org_data_id column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletOrgDataId(1234); // WHERE outlet_org_data_id = 1234
     * $query->filterByOutletOrgDataId(array(12, 34)); // WHERE outlet_org_data_id IN (12, 34)
     * $query->filterByOutletOrgDataId(array('min' => 12)); // WHERE outlet_org_data_id > 12
     * </code>
     *
     * @see       filterByOutletOrgData()
     *
     * @param mixed $outletOrgDataId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletOrgDataId($outletOrgDataId = null, ?string $comparison = null)
    {
        if (is_array($outletOrgDataId)) {
            $useMinMax = false;
            if (isset($outletOrgDataId['min'])) {
                $this->addUsingAlias(EdFeedbacksTableMap::COL_OUTLET_ORG_DATA_ID, $outletOrgDataId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outletOrgDataId['max'])) {
                $this->addUsingAlias(EdFeedbacksTableMap::COL_OUTLET_ORG_DATA_ID, $outletOrgDataId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EdFeedbacksTableMap::COL_OUTLET_ORG_DATA_ID, $outletOrgDataId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the presentation_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPresentationId(1234); // WHERE presentation_id = 1234
     * $query->filterByPresentationId(array(12, 34)); // WHERE presentation_id IN (12, 34)
     * $query->filterByPresentationId(array('min' => 12)); // WHERE presentation_id > 12
     * </code>
     *
     * @see       filterByEdPresentations()
     *
     * @param mixed $presentationId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPresentationId($presentationId = null, ?string $comparison = null)
    {
        if (is_array($presentationId)) {
            $useMinMax = false;
            if (isset($presentationId['min'])) {
                $this->addUsingAlias(EdFeedbacksTableMap::COL_PRESENTATION_ID, $presentationId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($presentationId['max'])) {
                $this->addUsingAlias(EdFeedbacksTableMap::COL_PRESENTATION_ID, $presentationId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EdFeedbacksTableMap::COL_PRESENTATION_ID, $presentationId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the slide_index column
     *
     * Example usage:
     * <code>
     * $query->filterBySlideIndex(1234); // WHERE slide_index = 1234
     * $query->filterBySlideIndex(array(12, 34)); // WHERE slide_index IN (12, 34)
     * $query->filterBySlideIndex(array('min' => 12)); // WHERE slide_index > 12
     * </code>
     *
     * @param mixed $slideIndex The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySlideIndex($slideIndex = null, ?string $comparison = null)
    {
        if (is_array($slideIndex)) {
            $useMinMax = false;
            if (isset($slideIndex['min'])) {
                $this->addUsingAlias(EdFeedbacksTableMap::COL_SLIDE_INDEX, $slideIndex['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($slideIndex['max'])) {
                $this->addUsingAlias(EdFeedbacksTableMap::COL_SLIDE_INDEX, $slideIndex['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EdFeedbacksTableMap::COL_SLIDE_INDEX, $slideIndex, $comparison);

        return $this;
    }

    /**
     * Filter the query on the slide_name column
     *
     * Example usage:
     * <code>
     * $query->filterBySlideName('fooValue');   // WHERE slide_name = 'fooValue'
     * $query->filterBySlideName('%fooValue%', Criteria::LIKE); // WHERE slide_name LIKE '%fooValue%'
     * $query->filterBySlideName(['foo', 'bar']); // WHERE slide_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $slideName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySlideName($slideName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($slideName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EdFeedbacksTableMap::COL_SLIDE_NAME, $slideName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the employee_id column
     *
     * Example usage:
     * <code>
     * $query->filterByEmployeeId(1234); // WHERE employee_id = 1234
     * $query->filterByEmployeeId(array(12, 34)); // WHERE employee_id IN (12, 34)
     * $query->filterByEmployeeId(array('min' => 12)); // WHERE employee_id > 12
     * </code>
     *
     * @param mixed $employeeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmployeeId($employeeId = null, ?string $comparison = null)
    {
        if (is_array($employeeId)) {
            $useMinMax = false;
            if (isset($employeeId['min'])) {
                $this->addUsingAlias(EdFeedbacksTableMap::COL_EMPLOYEE_ID, $employeeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($employeeId['max'])) {
                $this->addUsingAlias(EdFeedbacksTableMap::COL_EMPLOYEE_ID, $employeeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EdFeedbacksTableMap::COL_EMPLOYEE_ID, $employeeId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the slide_like column
     *
     * Example usage:
     * <code>
     * $query->filterBySlideLike(1234); // WHERE slide_like = 1234
     * $query->filterBySlideLike(array(12, 34)); // WHERE slide_like IN (12, 34)
     * $query->filterBySlideLike(array('min' => 12)); // WHERE slide_like > 12
     * </code>
     *
     * @param mixed $slideLike The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySlideLike($slideLike = null, ?string $comparison = null)
    {
        if (is_array($slideLike)) {
            $useMinMax = false;
            if (isset($slideLike['min'])) {
                $this->addUsingAlias(EdFeedbacksTableMap::COL_SLIDE_LIKE, $slideLike['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($slideLike['max'])) {
                $this->addUsingAlias(EdFeedbacksTableMap::COL_SLIDE_LIKE, $slideLike['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EdFeedbacksTableMap::COL_SLIDE_LIKE, $slideLike, $comparison);

        return $this;
    }

    /**
     * Filter the query on the ilike column
     *
     * Example usage:
     * <code>
     * $query->filterByIlike(1234); // WHERE ilike = 1234
     * $query->filterByIlike(array(12, 34)); // WHERE ilike IN (12, 34)
     * $query->filterByIlike(array('min' => 12)); // WHERE ilike > 12
     * </code>
     *
     * @param mixed $ilike The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIlike($ilike = null, ?string $comparison = null)
    {
        if (is_array($ilike)) {
            $useMinMax = false;
            if (isset($ilike['min'])) {
                $this->addUsingAlias(EdFeedbacksTableMap::COL_ILIKE, $ilike['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($ilike['max'])) {
                $this->addUsingAlias(EdFeedbacksTableMap::COL_ILIKE, $ilike['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EdFeedbacksTableMap::COL_ILIKE, $ilike, $comparison);

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
                $this->addUsingAlias(EdFeedbacksTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(EdFeedbacksTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EdFeedbacksTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(EdFeedbacksTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(EdFeedbacksTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EdFeedbacksTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

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
                $this->addUsingAlias(EdFeedbacksTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(EdFeedbacksTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EdFeedbacksTableMap::COL_COMPANY_ID, $companyId, $comparison);

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
                ->addUsingAlias(EdFeedbacksTableMap::COL_COMPANY_ID, $company->getCompanyId(), $comparison);
        } elseif ($company instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(EdFeedbacksTableMap::COL_COMPANY_ID, $company->toKeyValue('PrimaryKey', 'CompanyId'), $comparison);

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
    public function joinCompany(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
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
    public function useCompanyQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
        ?string $joinType = Criteria::LEFT_JOIN
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
     * Filter the query by a related \entities\EdPresentations object
     *
     * @param \entities\EdPresentations|ObjectCollection $edPresentations The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEdPresentations($edPresentations, ?string $comparison = null)
    {
        if ($edPresentations instanceof \entities\EdPresentations) {
            return $this
                ->addUsingAlias(EdFeedbacksTableMap::COL_PRESENTATION_ID, $edPresentations->getPresentationId(), $comparison);
        } elseif ($edPresentations instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(EdFeedbacksTableMap::COL_PRESENTATION_ID, $edPresentations->toKeyValue('PrimaryKey', 'PresentationId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByEdPresentations() only accepts arguments of type \entities\EdPresentations or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the EdPresentations relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinEdPresentations(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('EdPresentations');

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
            $this->addJoinObject($join, 'EdPresentations');
        }

        return $this;
    }

    /**
     * Use the EdPresentations relation EdPresentations object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\EdPresentationsQuery A secondary query class using the current class as primary query
     */
    public function useEdPresentationsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinEdPresentations($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'EdPresentations', '\entities\EdPresentationsQuery');
    }

    /**
     * Use the EdPresentations relation EdPresentations object
     *
     * @param callable(\entities\EdPresentationsQuery):\entities\EdPresentationsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withEdPresentationsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useEdPresentationsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to EdPresentations table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\EdPresentationsQuery The inner query object of the EXISTS statement
     */
    public function useEdPresentationsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\EdPresentationsQuery */
        $q = $this->useExistsQuery('EdPresentations', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to EdPresentations table for a NOT EXISTS query.
     *
     * @see useEdPresentationsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\EdPresentationsQuery The inner query object of the NOT EXISTS statement
     */
    public function useEdPresentationsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\EdPresentationsQuery */
        $q = $this->useExistsQuery('EdPresentations', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to EdPresentations table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\EdPresentationsQuery The inner query object of the IN statement
     */
    public function useInEdPresentationsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\EdPresentationsQuery */
        $q = $this->useInQuery('EdPresentations', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to EdPresentations table for a NOT IN query.
     *
     * @see useEdPresentationsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\EdPresentationsQuery The inner query object of the NOT IN statement
     */
    public function useNotInEdPresentationsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\EdPresentationsQuery */
        $q = $this->useInQuery('EdPresentations', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\OutletOrgData object
     *
     * @param \entities\OutletOrgData|ObjectCollection $outletOrgData The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletOrgData($outletOrgData, ?string $comparison = null)
    {
        if ($outletOrgData instanceof \entities\OutletOrgData) {
            return $this
                ->addUsingAlias(EdFeedbacksTableMap::COL_OUTLET_ORG_DATA_ID, $outletOrgData->getOutletOrgId(), $comparison);
        } elseif ($outletOrgData instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(EdFeedbacksTableMap::COL_OUTLET_ORG_DATA_ID, $outletOrgData->toKeyValue('PrimaryKey', 'OutletOrgId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByOutletOrgData() only accepts arguments of type \entities\OutletOrgData or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OutletOrgData relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOutletOrgData(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OutletOrgData');

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
            $this->addJoinObject($join, 'OutletOrgData');
        }

        return $this;
    }

    /**
     * Use the OutletOrgData relation OutletOrgData object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\OutletOrgDataQuery A secondary query class using the current class as primary query
     */
    public function useOutletOrgDataQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinOutletOrgData($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OutletOrgData', '\entities\OutletOrgDataQuery');
    }

    /**
     * Use the OutletOrgData relation OutletOrgData object
     *
     * @param callable(\entities\OutletOrgDataQuery):\entities\OutletOrgDataQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOutletOrgDataQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useOutletOrgDataQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to OutletOrgData table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\OutletOrgDataQuery The inner query object of the EXISTS statement
     */
    public function useOutletOrgDataExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\OutletOrgDataQuery */
        $q = $this->useExistsQuery('OutletOrgData', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to OutletOrgData table for a NOT EXISTS query.
     *
     * @see useOutletOrgDataExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\OutletOrgDataQuery The inner query object of the NOT EXISTS statement
     */
    public function useOutletOrgDataNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OutletOrgDataQuery */
        $q = $this->useExistsQuery('OutletOrgData', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to OutletOrgData table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\OutletOrgDataQuery The inner query object of the IN statement
     */
    public function useInOutletOrgDataQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\OutletOrgDataQuery */
        $q = $this->useInQuery('OutletOrgData', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to OutletOrgData table for a NOT IN query.
     *
     * @see useOutletOrgDataInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\OutletOrgDataQuery The inner query object of the NOT IN statement
     */
    public function useNotInOutletOrgDataQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OutletOrgDataQuery */
        $q = $this->useInQuery('OutletOrgData', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildEdFeedbacks $edFeedbacks Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($edFeedbacks = null)
    {
        if ($edFeedbacks) {
            $this->addUsingAlias(EdFeedbacksTableMap::COL_ED_FEEDBACK_ID, $edFeedbacks->getEdFeedbackId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the ed_feedbacks table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EdFeedbacksTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            EdFeedbacksTableMap::clearInstancePool();
            EdFeedbacksTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(EdFeedbacksTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(EdFeedbacksTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            EdFeedbacksTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            EdFeedbacksTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}