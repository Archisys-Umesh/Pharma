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
use entities\DailycallsAttendees as ChildDailycallsAttendees;
use entities\DailycallsAttendeesQuery as ChildDailycallsAttendeesQuery;
use entities\Map\DailycallsAttendeesTableMap;

/**
 * Base class that represents a query for the `dailycalls_attendees` table.
 *
 * @method     ChildDailycallsAttendeesQuery orderByDailycallsAttendeesId($order = Criteria::ASC) Order by the dailycalls_attendees_id column
 * @method     ChildDailycallsAttendeesQuery orderByBrandCampaignVisitPlanId($order = Criteria::ASC) Order by the brand_campaign_visit_plan_id column
 * @method     ChildDailycallsAttendeesQuery orderByOutletOrgDataId($order = Criteria::ASC) Order by the outlet_org_data_id column
 * @method     ChildDailycallsAttendeesQuery orderByDcrId($order = Criteria::ASC) Order by the dcr_id column
 * @method     ChildDailycallsAttendeesQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildDailycallsAttendeesQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildDailycallsAttendeesQuery orderByPlannedCall($order = Criteria::ASC) Order by the planned_call column
 *
 * @method     ChildDailycallsAttendeesQuery groupByDailycallsAttendeesId() Group by the dailycalls_attendees_id column
 * @method     ChildDailycallsAttendeesQuery groupByBrandCampaignVisitPlanId() Group by the brand_campaign_visit_plan_id column
 * @method     ChildDailycallsAttendeesQuery groupByOutletOrgDataId() Group by the outlet_org_data_id column
 * @method     ChildDailycallsAttendeesQuery groupByDcrId() Group by the dcr_id column
 * @method     ChildDailycallsAttendeesQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildDailycallsAttendeesQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildDailycallsAttendeesQuery groupByPlannedCall() Group by the planned_call column
 *
 * @method     ChildDailycallsAttendeesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildDailycallsAttendeesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildDailycallsAttendeesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildDailycallsAttendeesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildDailycallsAttendeesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildDailycallsAttendeesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildDailycallsAttendeesQuery leftJoinBrandCampiagnVisitPlan($relationAlias = null) Adds a LEFT JOIN clause to the query using the BrandCampiagnVisitPlan relation
 * @method     ChildDailycallsAttendeesQuery rightJoinBrandCampiagnVisitPlan($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BrandCampiagnVisitPlan relation
 * @method     ChildDailycallsAttendeesQuery innerJoinBrandCampiagnVisitPlan($relationAlias = null) Adds a INNER JOIN clause to the query using the BrandCampiagnVisitPlan relation
 *
 * @method     ChildDailycallsAttendeesQuery joinWithBrandCampiagnVisitPlan($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BrandCampiagnVisitPlan relation
 *
 * @method     ChildDailycallsAttendeesQuery leftJoinWithBrandCampiagnVisitPlan() Adds a LEFT JOIN clause and with to the query using the BrandCampiagnVisitPlan relation
 * @method     ChildDailycallsAttendeesQuery rightJoinWithBrandCampiagnVisitPlan() Adds a RIGHT JOIN clause and with to the query using the BrandCampiagnVisitPlan relation
 * @method     ChildDailycallsAttendeesQuery innerJoinWithBrandCampiagnVisitPlan() Adds a INNER JOIN clause and with to the query using the BrandCampiagnVisitPlan relation
 *
 * @method     ChildDailycallsAttendeesQuery leftJoinDailycalls($relationAlias = null) Adds a LEFT JOIN clause to the query using the Dailycalls relation
 * @method     ChildDailycallsAttendeesQuery rightJoinDailycalls($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Dailycalls relation
 * @method     ChildDailycallsAttendeesQuery innerJoinDailycalls($relationAlias = null) Adds a INNER JOIN clause to the query using the Dailycalls relation
 *
 * @method     ChildDailycallsAttendeesQuery joinWithDailycalls($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Dailycalls relation
 *
 * @method     ChildDailycallsAttendeesQuery leftJoinWithDailycalls() Adds a LEFT JOIN clause and with to the query using the Dailycalls relation
 * @method     ChildDailycallsAttendeesQuery rightJoinWithDailycalls() Adds a RIGHT JOIN clause and with to the query using the Dailycalls relation
 * @method     ChildDailycallsAttendeesQuery innerJoinWithDailycalls() Adds a INNER JOIN clause and with to the query using the Dailycalls relation
 *
 * @method     ChildDailycallsAttendeesQuery leftJoinOutletOrgData($relationAlias = null) Adds a LEFT JOIN clause to the query using the OutletOrgData relation
 * @method     ChildDailycallsAttendeesQuery rightJoinOutletOrgData($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OutletOrgData relation
 * @method     ChildDailycallsAttendeesQuery innerJoinOutletOrgData($relationAlias = null) Adds a INNER JOIN clause to the query using the OutletOrgData relation
 *
 * @method     ChildDailycallsAttendeesQuery joinWithOutletOrgData($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OutletOrgData relation
 *
 * @method     ChildDailycallsAttendeesQuery leftJoinWithOutletOrgData() Adds a LEFT JOIN clause and with to the query using the OutletOrgData relation
 * @method     ChildDailycallsAttendeesQuery rightJoinWithOutletOrgData() Adds a RIGHT JOIN clause and with to the query using the OutletOrgData relation
 * @method     ChildDailycallsAttendeesQuery innerJoinWithOutletOrgData() Adds a INNER JOIN clause and with to the query using the OutletOrgData relation
 *
 * @method     \entities\BrandCampiagnVisitPlanQuery|\entities\DailycallsQuery|\entities\OutletOrgDataQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildDailycallsAttendees|null findOne(?ConnectionInterface $con = null) Return the first ChildDailycallsAttendees matching the query
 * @method     ChildDailycallsAttendees findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildDailycallsAttendees matching the query, or a new ChildDailycallsAttendees object populated from the query conditions when no match is found
 *
 * @method     ChildDailycallsAttendees|null findOneByDailycallsAttendeesId(int $dailycalls_attendees_id) Return the first ChildDailycallsAttendees filtered by the dailycalls_attendees_id column
 * @method     ChildDailycallsAttendees|null findOneByBrandCampaignVisitPlanId(int $brand_campaign_visit_plan_id) Return the first ChildDailycallsAttendees filtered by the brand_campaign_visit_plan_id column
 * @method     ChildDailycallsAttendees|null findOneByOutletOrgDataId(int $outlet_org_data_id) Return the first ChildDailycallsAttendees filtered by the outlet_org_data_id column
 * @method     ChildDailycallsAttendees|null findOneByDcrId(int $dcr_id) Return the first ChildDailycallsAttendees filtered by the dcr_id column
 * @method     ChildDailycallsAttendees|null findOneByCreatedAt(string $created_at) Return the first ChildDailycallsAttendees filtered by the created_at column
 * @method     ChildDailycallsAttendees|null findOneByUpdatedAt(string $updated_at) Return the first ChildDailycallsAttendees filtered by the updated_at column
 * @method     ChildDailycallsAttendees|null findOneByPlannedCall(string $planned_call) Return the first ChildDailycallsAttendees filtered by the planned_call column
 *
 * @method     ChildDailycallsAttendees requirePk($key, ?ConnectionInterface $con = null) Return the ChildDailycallsAttendees by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDailycallsAttendees requireOne(?ConnectionInterface $con = null) Return the first ChildDailycallsAttendees matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDailycallsAttendees requireOneByDailycallsAttendeesId(int $dailycalls_attendees_id) Return the first ChildDailycallsAttendees filtered by the dailycalls_attendees_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDailycallsAttendees requireOneByBrandCampaignVisitPlanId(int $brand_campaign_visit_plan_id) Return the first ChildDailycallsAttendees filtered by the brand_campaign_visit_plan_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDailycallsAttendees requireOneByOutletOrgDataId(int $outlet_org_data_id) Return the first ChildDailycallsAttendees filtered by the outlet_org_data_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDailycallsAttendees requireOneByDcrId(int $dcr_id) Return the first ChildDailycallsAttendees filtered by the dcr_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDailycallsAttendees requireOneByCreatedAt(string $created_at) Return the first ChildDailycallsAttendees filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDailycallsAttendees requireOneByUpdatedAt(string $updated_at) Return the first ChildDailycallsAttendees filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDailycallsAttendees requireOneByPlannedCall(string $planned_call) Return the first ChildDailycallsAttendees filtered by the planned_call column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDailycallsAttendees[]|Collection find(?ConnectionInterface $con = null) Return ChildDailycallsAttendees objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildDailycallsAttendees> find(?ConnectionInterface $con = null) Return ChildDailycallsAttendees objects based on current ModelCriteria
 *
 * @method     ChildDailycallsAttendees[]|Collection findByDailycallsAttendeesId(int|array<int> $dailycalls_attendees_id) Return ChildDailycallsAttendees objects filtered by the dailycalls_attendees_id column
 * @psalm-method Collection&\Traversable<ChildDailycallsAttendees> findByDailycallsAttendeesId(int|array<int> $dailycalls_attendees_id) Return ChildDailycallsAttendees objects filtered by the dailycalls_attendees_id column
 * @method     ChildDailycallsAttendees[]|Collection findByBrandCampaignVisitPlanId(int|array<int> $brand_campaign_visit_plan_id) Return ChildDailycallsAttendees objects filtered by the brand_campaign_visit_plan_id column
 * @psalm-method Collection&\Traversable<ChildDailycallsAttendees> findByBrandCampaignVisitPlanId(int|array<int> $brand_campaign_visit_plan_id) Return ChildDailycallsAttendees objects filtered by the brand_campaign_visit_plan_id column
 * @method     ChildDailycallsAttendees[]|Collection findByOutletOrgDataId(int|array<int> $outlet_org_data_id) Return ChildDailycallsAttendees objects filtered by the outlet_org_data_id column
 * @psalm-method Collection&\Traversable<ChildDailycallsAttendees> findByOutletOrgDataId(int|array<int> $outlet_org_data_id) Return ChildDailycallsAttendees objects filtered by the outlet_org_data_id column
 * @method     ChildDailycallsAttendees[]|Collection findByDcrId(int|array<int> $dcr_id) Return ChildDailycallsAttendees objects filtered by the dcr_id column
 * @psalm-method Collection&\Traversable<ChildDailycallsAttendees> findByDcrId(int|array<int> $dcr_id) Return ChildDailycallsAttendees objects filtered by the dcr_id column
 * @method     ChildDailycallsAttendees[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildDailycallsAttendees objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildDailycallsAttendees> findByCreatedAt(string|array<string> $created_at) Return ChildDailycallsAttendees objects filtered by the created_at column
 * @method     ChildDailycallsAttendees[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildDailycallsAttendees objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildDailycallsAttendees> findByUpdatedAt(string|array<string> $updated_at) Return ChildDailycallsAttendees objects filtered by the updated_at column
 * @method     ChildDailycallsAttendees[]|Collection findByPlannedCall(string|array<string> $planned_call) Return ChildDailycallsAttendees objects filtered by the planned_call column
 * @psalm-method Collection&\Traversable<ChildDailycallsAttendees> findByPlannedCall(string|array<string> $planned_call) Return ChildDailycallsAttendees objects filtered by the planned_call column
 *
 * @method     ChildDailycallsAttendees[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildDailycallsAttendees> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class DailycallsAttendeesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\DailycallsAttendeesQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\DailycallsAttendees', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildDailycallsAttendeesQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildDailycallsAttendeesQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildDailycallsAttendeesQuery) {
            return $criteria;
        }
        $query = new ChildDailycallsAttendeesQuery();
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
     * @return ChildDailycallsAttendees|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(DailycallsAttendeesTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = DailycallsAttendeesTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildDailycallsAttendees A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT dailycalls_attendees_id, brand_campaign_visit_plan_id, outlet_org_data_id, dcr_id, created_at, updated_at, planned_call FROM dailycalls_attendees WHERE dailycalls_attendees_id = :p0';
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
            /** @var ChildDailycallsAttendees $obj */
            $obj = new ChildDailycallsAttendees();
            $obj->hydrate($row);
            DailycallsAttendeesTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildDailycallsAttendees|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(DailycallsAttendeesTableMap::COL_DAILYCALLS_ATTENDEES_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(DailycallsAttendeesTableMap::COL_DAILYCALLS_ATTENDEES_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the dailycalls_attendees_id column
     *
     * Example usage:
     * <code>
     * $query->filterByDailycallsAttendeesId(1234); // WHERE dailycalls_attendees_id = 1234
     * $query->filterByDailycallsAttendeesId(array(12, 34)); // WHERE dailycalls_attendees_id IN (12, 34)
     * $query->filterByDailycallsAttendeesId(array('min' => 12)); // WHERE dailycalls_attendees_id > 12
     * </code>
     *
     * @param mixed $dailycallsAttendeesId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDailycallsAttendeesId($dailycallsAttendeesId = null, ?string $comparison = null)
    {
        if (is_array($dailycallsAttendeesId)) {
            $useMinMax = false;
            if (isset($dailycallsAttendeesId['min'])) {
                $this->addUsingAlias(DailycallsAttendeesTableMap::COL_DAILYCALLS_ATTENDEES_ID, $dailycallsAttendeesId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dailycallsAttendeesId['max'])) {
                $this->addUsingAlias(DailycallsAttendeesTableMap::COL_DAILYCALLS_ATTENDEES_ID, $dailycallsAttendeesId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DailycallsAttendeesTableMap::COL_DAILYCALLS_ATTENDEES_ID, $dailycallsAttendeesId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the brand_campaign_visit_plan_id column
     *
     * Example usage:
     * <code>
     * $query->filterByBrandCampaignVisitPlanId(1234); // WHERE brand_campaign_visit_plan_id = 1234
     * $query->filterByBrandCampaignVisitPlanId(array(12, 34)); // WHERE brand_campaign_visit_plan_id IN (12, 34)
     * $query->filterByBrandCampaignVisitPlanId(array('min' => 12)); // WHERE brand_campaign_visit_plan_id > 12
     * </code>
     *
     * @see       filterByBrandCampiagnVisitPlan()
     *
     * @param mixed $brandCampaignVisitPlanId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBrandCampaignVisitPlanId($brandCampaignVisitPlanId = null, ?string $comparison = null)
    {
        if (is_array($brandCampaignVisitPlanId)) {
            $useMinMax = false;
            if (isset($brandCampaignVisitPlanId['min'])) {
                $this->addUsingAlias(DailycallsAttendeesTableMap::COL_BRAND_CAMPAIGN_VISIT_PLAN_ID, $brandCampaignVisitPlanId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($brandCampaignVisitPlanId['max'])) {
                $this->addUsingAlias(DailycallsAttendeesTableMap::COL_BRAND_CAMPAIGN_VISIT_PLAN_ID, $brandCampaignVisitPlanId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DailycallsAttendeesTableMap::COL_BRAND_CAMPAIGN_VISIT_PLAN_ID, $brandCampaignVisitPlanId, $comparison);

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
                $this->addUsingAlias(DailycallsAttendeesTableMap::COL_OUTLET_ORG_DATA_ID, $outletOrgDataId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outletOrgDataId['max'])) {
                $this->addUsingAlias(DailycallsAttendeesTableMap::COL_OUTLET_ORG_DATA_ID, $outletOrgDataId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DailycallsAttendeesTableMap::COL_OUTLET_ORG_DATA_ID, $outletOrgDataId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the dcr_id column
     *
     * Example usage:
     * <code>
     * $query->filterByDcrId(1234); // WHERE dcr_id = 1234
     * $query->filterByDcrId(array(12, 34)); // WHERE dcr_id IN (12, 34)
     * $query->filterByDcrId(array('min' => 12)); // WHERE dcr_id > 12
     * </code>
     *
     * @see       filterByDailycalls()
     *
     * @param mixed $dcrId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDcrId($dcrId = null, ?string $comparison = null)
    {
        if (is_array($dcrId)) {
            $useMinMax = false;
            if (isset($dcrId['min'])) {
                $this->addUsingAlias(DailycallsAttendeesTableMap::COL_DCR_ID, $dcrId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dcrId['max'])) {
                $this->addUsingAlias(DailycallsAttendeesTableMap::COL_DCR_ID, $dcrId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DailycallsAttendeesTableMap::COL_DCR_ID, $dcrId, $comparison);

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
                $this->addUsingAlias(DailycallsAttendeesTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(DailycallsAttendeesTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DailycallsAttendeesTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(DailycallsAttendeesTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(DailycallsAttendeesTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DailycallsAttendeesTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the planned_call column
     *
     * Example usage:
     * <code>
     * $query->filterByPlannedCall('fooValue');   // WHERE planned_call = 'fooValue'
     * $query->filterByPlannedCall('%fooValue%', Criteria::LIKE); // WHERE planned_call LIKE '%fooValue%'
     * $query->filterByPlannedCall(['foo', 'bar']); // WHERE planned_call IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $plannedCall The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPlannedCall($plannedCall = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($plannedCall)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DailycallsAttendeesTableMap::COL_PLANNED_CALL, $plannedCall, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \entities\BrandCampiagnVisitPlan object
     *
     * @param \entities\BrandCampiagnVisitPlan|ObjectCollection $brandCampiagnVisitPlan The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBrandCampiagnVisitPlan($brandCampiagnVisitPlan, ?string $comparison = null)
    {
        if ($brandCampiagnVisitPlan instanceof \entities\BrandCampiagnVisitPlan) {
            return $this
                ->addUsingAlias(DailycallsAttendeesTableMap::COL_BRAND_CAMPAIGN_VISIT_PLAN_ID, $brandCampiagnVisitPlan->getBrandCampiagnVisitPlanId(), $comparison);
        } elseif ($brandCampiagnVisitPlan instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(DailycallsAttendeesTableMap::COL_BRAND_CAMPAIGN_VISIT_PLAN_ID, $brandCampiagnVisitPlan->toKeyValue('PrimaryKey', 'BrandCampiagnVisitPlanId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByBrandCampiagnVisitPlan() only accepts arguments of type \entities\BrandCampiagnVisitPlan or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BrandCampiagnVisitPlan relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinBrandCampiagnVisitPlan(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BrandCampiagnVisitPlan');

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
            $this->addJoinObject($join, 'BrandCampiagnVisitPlan');
        }

        return $this;
    }

    /**
     * Use the BrandCampiagnVisitPlan relation BrandCampiagnVisitPlan object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\BrandCampiagnVisitPlanQuery A secondary query class using the current class as primary query
     */
    public function useBrandCampiagnVisitPlanQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinBrandCampiagnVisitPlan($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BrandCampiagnVisitPlan', '\entities\BrandCampiagnVisitPlanQuery');
    }

    /**
     * Use the BrandCampiagnVisitPlan relation BrandCampiagnVisitPlan object
     *
     * @param callable(\entities\BrandCampiagnVisitPlanQuery):\entities\BrandCampiagnVisitPlanQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withBrandCampiagnVisitPlanQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useBrandCampiagnVisitPlanQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to BrandCampiagnVisitPlan table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\BrandCampiagnVisitPlanQuery The inner query object of the EXISTS statement
     */
    public function useBrandCampiagnVisitPlanExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\BrandCampiagnVisitPlanQuery */
        $q = $this->useExistsQuery('BrandCampiagnVisitPlan', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to BrandCampiagnVisitPlan table for a NOT EXISTS query.
     *
     * @see useBrandCampiagnVisitPlanExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\BrandCampiagnVisitPlanQuery The inner query object of the NOT EXISTS statement
     */
    public function useBrandCampiagnVisitPlanNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\BrandCampiagnVisitPlanQuery */
        $q = $this->useExistsQuery('BrandCampiagnVisitPlan', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to BrandCampiagnVisitPlan table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\BrandCampiagnVisitPlanQuery The inner query object of the IN statement
     */
    public function useInBrandCampiagnVisitPlanQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\BrandCampiagnVisitPlanQuery */
        $q = $this->useInQuery('BrandCampiagnVisitPlan', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to BrandCampiagnVisitPlan table for a NOT IN query.
     *
     * @see useBrandCampiagnVisitPlanInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\BrandCampiagnVisitPlanQuery The inner query object of the NOT IN statement
     */
    public function useNotInBrandCampiagnVisitPlanQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\BrandCampiagnVisitPlanQuery */
        $q = $this->useInQuery('BrandCampiagnVisitPlan', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\Dailycalls object
     *
     * @param \entities\Dailycalls|ObjectCollection $dailycalls The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDailycalls($dailycalls, ?string $comparison = null)
    {
        if ($dailycalls instanceof \entities\Dailycalls) {
            return $this
                ->addUsingAlias(DailycallsAttendeesTableMap::COL_DCR_ID, $dailycalls->getDcrId(), $comparison);
        } elseif ($dailycalls instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(DailycallsAttendeesTableMap::COL_DCR_ID, $dailycalls->toKeyValue('PrimaryKey', 'DcrId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByDailycalls() only accepts arguments of type \entities\Dailycalls or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Dailycalls relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinDailycalls(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Dailycalls');

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
            $this->addJoinObject($join, 'Dailycalls');
        }

        return $this;
    }

    /**
     * Use the Dailycalls relation Dailycalls object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\DailycallsQuery A secondary query class using the current class as primary query
     */
    public function useDailycallsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinDailycalls($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Dailycalls', '\entities\DailycallsQuery');
    }

    /**
     * Use the Dailycalls relation Dailycalls object
     *
     * @param callable(\entities\DailycallsQuery):\entities\DailycallsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withDailycallsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useDailycallsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Dailycalls table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\DailycallsQuery The inner query object of the EXISTS statement
     */
    public function useDailycallsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\DailycallsQuery */
        $q = $this->useExistsQuery('Dailycalls', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Dailycalls table for a NOT EXISTS query.
     *
     * @see useDailycallsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\DailycallsQuery The inner query object of the NOT EXISTS statement
     */
    public function useDailycallsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\DailycallsQuery */
        $q = $this->useExistsQuery('Dailycalls', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Dailycalls table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\DailycallsQuery The inner query object of the IN statement
     */
    public function useInDailycallsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\DailycallsQuery */
        $q = $this->useInQuery('Dailycalls', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Dailycalls table for a NOT IN query.
     *
     * @see useDailycallsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\DailycallsQuery The inner query object of the NOT IN statement
     */
    public function useNotInDailycallsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\DailycallsQuery */
        $q = $this->useInQuery('Dailycalls', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(DailycallsAttendeesTableMap::COL_OUTLET_ORG_DATA_ID, $outletOrgData->getOutletOrgId(), $comparison);
        } elseif ($outletOrgData instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(DailycallsAttendeesTableMap::COL_OUTLET_ORG_DATA_ID, $outletOrgData->toKeyValue('PrimaryKey', 'OutletOrgId'), $comparison);

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
     * @param ChildDailycallsAttendees $dailycallsAttendees Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($dailycallsAttendees = null)
    {
        if ($dailycallsAttendees) {
            $this->addUsingAlias(DailycallsAttendeesTableMap::COL_DAILYCALLS_ATTENDEES_ID, $dailycallsAttendees->getDailycallsAttendeesId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the dailycalls_attendees table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DailycallsAttendeesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            DailycallsAttendeesTableMap::clearInstancePool();
            DailycallsAttendeesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(DailycallsAttendeesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(DailycallsAttendeesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            DailycallsAttendeesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            DailycallsAttendeesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
