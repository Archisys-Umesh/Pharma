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
use entities\BrandCampiagnVisits as ChildBrandCampiagnVisits;
use entities\BrandCampiagnVisitsQuery as ChildBrandCampiagnVisitsQuery;
use entities\Map\BrandCampiagnVisitsTableMap;

/**
 * Base class that represents a query for the `brand_campiagn_visits` table.
 *
 * @method     ChildBrandCampiagnVisitsQuery orderByBrandCampiagnVisitId($order = Criteria::ASC) Order by the brand_campiagn_visit_id column
 * @method     ChildBrandCampiagnVisitsQuery orderByBrandCampiagnId($order = Criteria::ASC) Order by the brand_campiagn_id column
 * @method     ChildBrandCampiagnVisitsQuery orderByBrandCampiagnVisitPlanId($order = Criteria::ASC) Order by the brand_campiagn_visit_plan_id column
 * @method     ChildBrandCampiagnVisitsQuery orderByOutletId($order = Criteria::ASC) Order by the outlet_id column
 * @method     ChildBrandCampiagnVisitsQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildBrandCampiagnVisitsQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildBrandCampiagnVisitsQuery orderByOutletOrgDataId($order = Criteria::ASC) Order by the outlet_org_data_id column
 * @method     ChildBrandCampiagnVisitsQuery orderByIsVisited($order = Criteria::ASC) Order by the is_visited column
 * @method     ChildBrandCampiagnVisitsQuery orderByVisitedDatetime($order = Criteria::ASC) Order by the visited_datetime column
 * @method     ChildBrandCampiagnVisitsQuery orderByDcrId($order = Criteria::ASC) Order by the dcr_id column
 * @method     ChildBrandCampiagnVisitsQuery orderByPositionId($order = Criteria::ASC) Order by the position_id column
 * @method     ChildBrandCampiagnVisitsQuery orderByComment($order = Criteria::ASC) Order by the comment column
 *
 * @method     ChildBrandCampiagnVisitsQuery groupByBrandCampiagnVisitId() Group by the brand_campiagn_visit_id column
 * @method     ChildBrandCampiagnVisitsQuery groupByBrandCampiagnId() Group by the brand_campiagn_id column
 * @method     ChildBrandCampiagnVisitsQuery groupByBrandCampiagnVisitPlanId() Group by the brand_campiagn_visit_plan_id column
 * @method     ChildBrandCampiagnVisitsQuery groupByOutletId() Group by the outlet_id column
 * @method     ChildBrandCampiagnVisitsQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildBrandCampiagnVisitsQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildBrandCampiagnVisitsQuery groupByOutletOrgDataId() Group by the outlet_org_data_id column
 * @method     ChildBrandCampiagnVisitsQuery groupByIsVisited() Group by the is_visited column
 * @method     ChildBrandCampiagnVisitsQuery groupByVisitedDatetime() Group by the visited_datetime column
 * @method     ChildBrandCampiagnVisitsQuery groupByDcrId() Group by the dcr_id column
 * @method     ChildBrandCampiagnVisitsQuery groupByPositionId() Group by the position_id column
 * @method     ChildBrandCampiagnVisitsQuery groupByComment() Group by the comment column
 *
 * @method     ChildBrandCampiagnVisitsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildBrandCampiagnVisitsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildBrandCampiagnVisitsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildBrandCampiagnVisitsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildBrandCampiagnVisitsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildBrandCampiagnVisitsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildBrandCampiagnVisitsQuery leftJoinBrandCampiagn($relationAlias = null) Adds a LEFT JOIN clause to the query using the BrandCampiagn relation
 * @method     ChildBrandCampiagnVisitsQuery rightJoinBrandCampiagn($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BrandCampiagn relation
 * @method     ChildBrandCampiagnVisitsQuery innerJoinBrandCampiagn($relationAlias = null) Adds a INNER JOIN clause to the query using the BrandCampiagn relation
 *
 * @method     ChildBrandCampiagnVisitsQuery joinWithBrandCampiagn($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BrandCampiagn relation
 *
 * @method     ChildBrandCampiagnVisitsQuery leftJoinWithBrandCampiagn() Adds a LEFT JOIN clause and with to the query using the BrandCampiagn relation
 * @method     ChildBrandCampiagnVisitsQuery rightJoinWithBrandCampiagn() Adds a RIGHT JOIN clause and with to the query using the BrandCampiagn relation
 * @method     ChildBrandCampiagnVisitsQuery innerJoinWithBrandCampiagn() Adds a INNER JOIN clause and with to the query using the BrandCampiagn relation
 *
 * @method     ChildBrandCampiagnVisitsQuery leftJoinOutlets($relationAlias = null) Adds a LEFT JOIN clause to the query using the Outlets relation
 * @method     ChildBrandCampiagnVisitsQuery rightJoinOutlets($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Outlets relation
 * @method     ChildBrandCampiagnVisitsQuery innerJoinOutlets($relationAlias = null) Adds a INNER JOIN clause to the query using the Outlets relation
 *
 * @method     ChildBrandCampiagnVisitsQuery joinWithOutlets($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Outlets relation
 *
 * @method     ChildBrandCampiagnVisitsQuery leftJoinWithOutlets() Adds a LEFT JOIN clause and with to the query using the Outlets relation
 * @method     ChildBrandCampiagnVisitsQuery rightJoinWithOutlets() Adds a RIGHT JOIN clause and with to the query using the Outlets relation
 * @method     ChildBrandCampiagnVisitsQuery innerJoinWithOutlets() Adds a INNER JOIN clause and with to the query using the Outlets relation
 *
 * @method     ChildBrandCampiagnVisitsQuery leftJoinBrandCampiagnVisitPlan($relationAlias = null) Adds a LEFT JOIN clause to the query using the BrandCampiagnVisitPlan relation
 * @method     ChildBrandCampiagnVisitsQuery rightJoinBrandCampiagnVisitPlan($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BrandCampiagnVisitPlan relation
 * @method     ChildBrandCampiagnVisitsQuery innerJoinBrandCampiagnVisitPlan($relationAlias = null) Adds a INNER JOIN clause to the query using the BrandCampiagnVisitPlan relation
 *
 * @method     ChildBrandCampiagnVisitsQuery joinWithBrandCampiagnVisitPlan($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BrandCampiagnVisitPlan relation
 *
 * @method     ChildBrandCampiagnVisitsQuery leftJoinWithBrandCampiagnVisitPlan() Adds a LEFT JOIN clause and with to the query using the BrandCampiagnVisitPlan relation
 * @method     ChildBrandCampiagnVisitsQuery rightJoinWithBrandCampiagnVisitPlan() Adds a RIGHT JOIN clause and with to the query using the BrandCampiagnVisitPlan relation
 * @method     ChildBrandCampiagnVisitsQuery innerJoinWithBrandCampiagnVisitPlan() Adds a INNER JOIN clause and with to the query using the BrandCampiagnVisitPlan relation
 *
 * @method     ChildBrandCampiagnVisitsQuery leftJoinDailycalls($relationAlias = null) Adds a LEFT JOIN clause to the query using the Dailycalls relation
 * @method     ChildBrandCampiagnVisitsQuery rightJoinDailycalls($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Dailycalls relation
 * @method     ChildBrandCampiagnVisitsQuery innerJoinDailycalls($relationAlias = null) Adds a INNER JOIN clause to the query using the Dailycalls relation
 *
 * @method     ChildBrandCampiagnVisitsQuery joinWithDailycalls($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Dailycalls relation
 *
 * @method     ChildBrandCampiagnVisitsQuery leftJoinWithDailycalls() Adds a LEFT JOIN clause and with to the query using the Dailycalls relation
 * @method     ChildBrandCampiagnVisitsQuery rightJoinWithDailycalls() Adds a RIGHT JOIN clause and with to the query using the Dailycalls relation
 * @method     ChildBrandCampiagnVisitsQuery innerJoinWithDailycalls() Adds a INNER JOIN clause and with to the query using the Dailycalls relation
 *
 * @method     ChildBrandCampiagnVisitsQuery leftJoinPositions($relationAlias = null) Adds a LEFT JOIN clause to the query using the Positions relation
 * @method     ChildBrandCampiagnVisitsQuery rightJoinPositions($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Positions relation
 * @method     ChildBrandCampiagnVisitsQuery innerJoinPositions($relationAlias = null) Adds a INNER JOIN clause to the query using the Positions relation
 *
 * @method     ChildBrandCampiagnVisitsQuery joinWithPositions($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Positions relation
 *
 * @method     ChildBrandCampiagnVisitsQuery leftJoinWithPositions() Adds a LEFT JOIN clause and with to the query using the Positions relation
 * @method     ChildBrandCampiagnVisitsQuery rightJoinWithPositions() Adds a RIGHT JOIN clause and with to the query using the Positions relation
 * @method     ChildBrandCampiagnVisitsQuery innerJoinWithPositions() Adds a INNER JOIN clause and with to the query using the Positions relation
 *
 * @method     \entities\BrandCampiagnQuery|\entities\OutletsQuery|\entities\BrandCampiagnVisitPlanQuery|\entities\DailycallsQuery|\entities\PositionsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildBrandCampiagnVisits|null findOne(?ConnectionInterface $con = null) Return the first ChildBrandCampiagnVisits matching the query
 * @method     ChildBrandCampiagnVisits findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildBrandCampiagnVisits matching the query, or a new ChildBrandCampiagnVisits object populated from the query conditions when no match is found
 *
 * @method     ChildBrandCampiagnVisits|null findOneByBrandCampiagnVisitId(int $brand_campiagn_visit_id) Return the first ChildBrandCampiagnVisits filtered by the brand_campiagn_visit_id column
 * @method     ChildBrandCampiagnVisits|null findOneByBrandCampiagnId(int $brand_campiagn_id) Return the first ChildBrandCampiagnVisits filtered by the brand_campiagn_id column
 * @method     ChildBrandCampiagnVisits|null findOneByBrandCampiagnVisitPlanId(int $brand_campiagn_visit_plan_id) Return the first ChildBrandCampiagnVisits filtered by the brand_campiagn_visit_plan_id column
 * @method     ChildBrandCampiagnVisits|null findOneByOutletId(int $outlet_id) Return the first ChildBrandCampiagnVisits filtered by the outlet_id column
 * @method     ChildBrandCampiagnVisits|null findOneByCreatedAt(string $created_at) Return the first ChildBrandCampiagnVisits filtered by the created_at column
 * @method     ChildBrandCampiagnVisits|null findOneByUpdatedAt(string $updated_at) Return the first ChildBrandCampiagnVisits filtered by the updated_at column
 * @method     ChildBrandCampiagnVisits|null findOneByOutletOrgDataId(int $outlet_org_data_id) Return the first ChildBrandCampiagnVisits filtered by the outlet_org_data_id column
 * @method     ChildBrandCampiagnVisits|null findOneByIsVisited(boolean $is_visited) Return the first ChildBrandCampiagnVisits filtered by the is_visited column
 * @method     ChildBrandCampiagnVisits|null findOneByVisitedDatetime(string $visited_datetime) Return the first ChildBrandCampiagnVisits filtered by the visited_datetime column
 * @method     ChildBrandCampiagnVisits|null findOneByDcrId(int $dcr_id) Return the first ChildBrandCampiagnVisits filtered by the dcr_id column
 * @method     ChildBrandCampiagnVisits|null findOneByPositionId(int $position_id) Return the first ChildBrandCampiagnVisits filtered by the position_id column
 * @method     ChildBrandCampiagnVisits|null findOneByComment(string $comment) Return the first ChildBrandCampiagnVisits filtered by the comment column
 *
 * @method     ChildBrandCampiagnVisits requirePk($key, ?ConnectionInterface $con = null) Return the ChildBrandCampiagnVisits by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandCampiagnVisits requireOne(?ConnectionInterface $con = null) Return the first ChildBrandCampiagnVisits matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBrandCampiagnVisits requireOneByBrandCampiagnVisitId(int $brand_campiagn_visit_id) Return the first ChildBrandCampiagnVisits filtered by the brand_campiagn_visit_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandCampiagnVisits requireOneByBrandCampiagnId(int $brand_campiagn_id) Return the first ChildBrandCampiagnVisits filtered by the brand_campiagn_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandCampiagnVisits requireOneByBrandCampiagnVisitPlanId(int $brand_campiagn_visit_plan_id) Return the first ChildBrandCampiagnVisits filtered by the brand_campiagn_visit_plan_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandCampiagnVisits requireOneByOutletId(int $outlet_id) Return the first ChildBrandCampiagnVisits filtered by the outlet_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandCampiagnVisits requireOneByCreatedAt(string $created_at) Return the first ChildBrandCampiagnVisits filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandCampiagnVisits requireOneByUpdatedAt(string $updated_at) Return the first ChildBrandCampiagnVisits filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandCampiagnVisits requireOneByOutletOrgDataId(int $outlet_org_data_id) Return the first ChildBrandCampiagnVisits filtered by the outlet_org_data_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandCampiagnVisits requireOneByIsVisited(boolean $is_visited) Return the first ChildBrandCampiagnVisits filtered by the is_visited column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandCampiagnVisits requireOneByVisitedDatetime(string $visited_datetime) Return the first ChildBrandCampiagnVisits filtered by the visited_datetime column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandCampiagnVisits requireOneByDcrId(int $dcr_id) Return the first ChildBrandCampiagnVisits filtered by the dcr_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandCampiagnVisits requireOneByPositionId(int $position_id) Return the first ChildBrandCampiagnVisits filtered by the position_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandCampiagnVisits requireOneByComment(string $comment) Return the first ChildBrandCampiagnVisits filtered by the comment column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBrandCampiagnVisits[]|Collection find(?ConnectionInterface $con = null) Return ChildBrandCampiagnVisits objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildBrandCampiagnVisits> find(?ConnectionInterface $con = null) Return ChildBrandCampiagnVisits objects based on current ModelCriteria
 *
 * @method     ChildBrandCampiagnVisits[]|Collection findByBrandCampiagnVisitId(int|array<int> $brand_campiagn_visit_id) Return ChildBrandCampiagnVisits objects filtered by the brand_campiagn_visit_id column
 * @psalm-method Collection&\Traversable<ChildBrandCampiagnVisits> findByBrandCampiagnVisitId(int|array<int> $brand_campiagn_visit_id) Return ChildBrandCampiagnVisits objects filtered by the brand_campiagn_visit_id column
 * @method     ChildBrandCampiagnVisits[]|Collection findByBrandCampiagnId(int|array<int> $brand_campiagn_id) Return ChildBrandCampiagnVisits objects filtered by the brand_campiagn_id column
 * @psalm-method Collection&\Traversable<ChildBrandCampiagnVisits> findByBrandCampiagnId(int|array<int> $brand_campiagn_id) Return ChildBrandCampiagnVisits objects filtered by the brand_campiagn_id column
 * @method     ChildBrandCampiagnVisits[]|Collection findByBrandCampiagnVisitPlanId(int|array<int> $brand_campiagn_visit_plan_id) Return ChildBrandCampiagnVisits objects filtered by the brand_campiagn_visit_plan_id column
 * @psalm-method Collection&\Traversable<ChildBrandCampiagnVisits> findByBrandCampiagnVisitPlanId(int|array<int> $brand_campiagn_visit_plan_id) Return ChildBrandCampiagnVisits objects filtered by the brand_campiagn_visit_plan_id column
 * @method     ChildBrandCampiagnVisits[]|Collection findByOutletId(int|array<int> $outlet_id) Return ChildBrandCampiagnVisits objects filtered by the outlet_id column
 * @psalm-method Collection&\Traversable<ChildBrandCampiagnVisits> findByOutletId(int|array<int> $outlet_id) Return ChildBrandCampiagnVisits objects filtered by the outlet_id column
 * @method     ChildBrandCampiagnVisits[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildBrandCampiagnVisits objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildBrandCampiagnVisits> findByCreatedAt(string|array<string> $created_at) Return ChildBrandCampiagnVisits objects filtered by the created_at column
 * @method     ChildBrandCampiagnVisits[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildBrandCampiagnVisits objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildBrandCampiagnVisits> findByUpdatedAt(string|array<string> $updated_at) Return ChildBrandCampiagnVisits objects filtered by the updated_at column
 * @method     ChildBrandCampiagnVisits[]|Collection findByOutletOrgDataId(int|array<int> $outlet_org_data_id) Return ChildBrandCampiagnVisits objects filtered by the outlet_org_data_id column
 * @psalm-method Collection&\Traversable<ChildBrandCampiagnVisits> findByOutletOrgDataId(int|array<int> $outlet_org_data_id) Return ChildBrandCampiagnVisits objects filtered by the outlet_org_data_id column
 * @method     ChildBrandCampiagnVisits[]|Collection findByIsVisited(boolean|array<boolean> $is_visited) Return ChildBrandCampiagnVisits objects filtered by the is_visited column
 * @psalm-method Collection&\Traversable<ChildBrandCampiagnVisits> findByIsVisited(boolean|array<boolean> $is_visited) Return ChildBrandCampiagnVisits objects filtered by the is_visited column
 * @method     ChildBrandCampiagnVisits[]|Collection findByVisitedDatetime(string|array<string> $visited_datetime) Return ChildBrandCampiagnVisits objects filtered by the visited_datetime column
 * @psalm-method Collection&\Traversable<ChildBrandCampiagnVisits> findByVisitedDatetime(string|array<string> $visited_datetime) Return ChildBrandCampiagnVisits objects filtered by the visited_datetime column
 * @method     ChildBrandCampiagnVisits[]|Collection findByDcrId(int|array<int> $dcr_id) Return ChildBrandCampiagnVisits objects filtered by the dcr_id column
 * @psalm-method Collection&\Traversable<ChildBrandCampiagnVisits> findByDcrId(int|array<int> $dcr_id) Return ChildBrandCampiagnVisits objects filtered by the dcr_id column
 * @method     ChildBrandCampiagnVisits[]|Collection findByPositionId(int|array<int> $position_id) Return ChildBrandCampiagnVisits objects filtered by the position_id column
 * @psalm-method Collection&\Traversable<ChildBrandCampiagnVisits> findByPositionId(int|array<int> $position_id) Return ChildBrandCampiagnVisits objects filtered by the position_id column
 * @method     ChildBrandCampiagnVisits[]|Collection findByComment(string|array<string> $comment) Return ChildBrandCampiagnVisits objects filtered by the comment column
 * @psalm-method Collection&\Traversable<ChildBrandCampiagnVisits> findByComment(string|array<string> $comment) Return ChildBrandCampiagnVisits objects filtered by the comment column
 *
 * @method     ChildBrandCampiagnVisits[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildBrandCampiagnVisits> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class BrandCampiagnVisitsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\BrandCampiagnVisitsQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\BrandCampiagnVisits', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildBrandCampiagnVisitsQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildBrandCampiagnVisitsQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildBrandCampiagnVisitsQuery) {
            return $criteria;
        }
        $query = new ChildBrandCampiagnVisitsQuery();
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
     * @return ChildBrandCampiagnVisits|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(BrandCampiagnVisitsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = BrandCampiagnVisitsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildBrandCampiagnVisits A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT brand_campiagn_visit_id, brand_campiagn_id, brand_campiagn_visit_plan_id, outlet_id, created_at, updated_at, outlet_org_data_id, is_visited, visited_datetime, dcr_id, position_id, comment FROM brand_campiagn_visits WHERE brand_campiagn_visit_id = :p0';
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
            /** @var ChildBrandCampiagnVisits $obj */
            $obj = new ChildBrandCampiagnVisits();
            $obj->hydrate($row);
            BrandCampiagnVisitsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildBrandCampiagnVisits|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(BrandCampiagnVisitsTableMap::COL_BRAND_CAMPIAGN_VISIT_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(BrandCampiagnVisitsTableMap::COL_BRAND_CAMPIAGN_VISIT_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the brand_campiagn_visit_id column
     *
     * Example usage:
     * <code>
     * $query->filterByBrandCampiagnVisitId(1234); // WHERE brand_campiagn_visit_id = 1234
     * $query->filterByBrandCampiagnVisitId(array(12, 34)); // WHERE brand_campiagn_visit_id IN (12, 34)
     * $query->filterByBrandCampiagnVisitId(array('min' => 12)); // WHERE brand_campiagn_visit_id > 12
     * </code>
     *
     * @param mixed $brandCampiagnVisitId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBrandCampiagnVisitId($brandCampiagnVisitId = null, ?string $comparison = null)
    {
        if (is_array($brandCampiagnVisitId)) {
            $useMinMax = false;
            if (isset($brandCampiagnVisitId['min'])) {
                $this->addUsingAlias(BrandCampiagnVisitsTableMap::COL_BRAND_CAMPIAGN_VISIT_ID, $brandCampiagnVisitId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($brandCampiagnVisitId['max'])) {
                $this->addUsingAlias(BrandCampiagnVisitsTableMap::COL_BRAND_CAMPIAGN_VISIT_ID, $brandCampiagnVisitId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandCampiagnVisitsTableMap::COL_BRAND_CAMPIAGN_VISIT_ID, $brandCampiagnVisitId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the brand_campiagn_id column
     *
     * Example usage:
     * <code>
     * $query->filterByBrandCampiagnId(1234); // WHERE brand_campiagn_id = 1234
     * $query->filterByBrandCampiagnId(array(12, 34)); // WHERE brand_campiagn_id IN (12, 34)
     * $query->filterByBrandCampiagnId(array('min' => 12)); // WHERE brand_campiagn_id > 12
     * </code>
     *
     * @see       filterByBrandCampiagn()
     *
     * @param mixed $brandCampiagnId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBrandCampiagnId($brandCampiagnId = null, ?string $comparison = null)
    {
        if (is_array($brandCampiagnId)) {
            $useMinMax = false;
            if (isset($brandCampiagnId['min'])) {
                $this->addUsingAlias(BrandCampiagnVisitsTableMap::COL_BRAND_CAMPIAGN_ID, $brandCampiagnId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($brandCampiagnId['max'])) {
                $this->addUsingAlias(BrandCampiagnVisitsTableMap::COL_BRAND_CAMPIAGN_ID, $brandCampiagnId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandCampiagnVisitsTableMap::COL_BRAND_CAMPIAGN_ID, $brandCampiagnId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the brand_campiagn_visit_plan_id column
     *
     * Example usage:
     * <code>
     * $query->filterByBrandCampiagnVisitPlanId(1234); // WHERE brand_campiagn_visit_plan_id = 1234
     * $query->filterByBrandCampiagnVisitPlanId(array(12, 34)); // WHERE brand_campiagn_visit_plan_id IN (12, 34)
     * $query->filterByBrandCampiagnVisitPlanId(array('min' => 12)); // WHERE brand_campiagn_visit_plan_id > 12
     * </code>
     *
     * @see       filterByBrandCampiagnVisitPlan()
     *
     * @param mixed $brandCampiagnVisitPlanId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBrandCampiagnVisitPlanId($brandCampiagnVisitPlanId = null, ?string $comparison = null)
    {
        if (is_array($brandCampiagnVisitPlanId)) {
            $useMinMax = false;
            if (isset($brandCampiagnVisitPlanId['min'])) {
                $this->addUsingAlias(BrandCampiagnVisitsTableMap::COL_BRAND_CAMPIAGN_VISIT_PLAN_ID, $brandCampiagnVisitPlanId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($brandCampiagnVisitPlanId['max'])) {
                $this->addUsingAlias(BrandCampiagnVisitsTableMap::COL_BRAND_CAMPIAGN_VISIT_PLAN_ID, $brandCampiagnVisitPlanId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandCampiagnVisitsTableMap::COL_BRAND_CAMPIAGN_VISIT_PLAN_ID, $brandCampiagnVisitPlanId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_id column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletId(1234); // WHERE outlet_id = 1234
     * $query->filterByOutletId(array(12, 34)); // WHERE outlet_id IN (12, 34)
     * $query->filterByOutletId(array('min' => 12)); // WHERE outlet_id > 12
     * </code>
     *
     * @see       filterByOutlets()
     *
     * @param mixed $outletId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletId($outletId = null, ?string $comparison = null)
    {
        if (is_array($outletId)) {
            $useMinMax = false;
            if (isset($outletId['min'])) {
                $this->addUsingAlias(BrandCampiagnVisitsTableMap::COL_OUTLET_ID, $outletId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outletId['max'])) {
                $this->addUsingAlias(BrandCampiagnVisitsTableMap::COL_OUTLET_ID, $outletId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandCampiagnVisitsTableMap::COL_OUTLET_ID, $outletId, $comparison);

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
                $this->addUsingAlias(BrandCampiagnVisitsTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(BrandCampiagnVisitsTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandCampiagnVisitsTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(BrandCampiagnVisitsTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(BrandCampiagnVisitsTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandCampiagnVisitsTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

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
                $this->addUsingAlias(BrandCampiagnVisitsTableMap::COL_OUTLET_ORG_DATA_ID, $outletOrgDataId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outletOrgDataId['max'])) {
                $this->addUsingAlias(BrandCampiagnVisitsTableMap::COL_OUTLET_ORG_DATA_ID, $outletOrgDataId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandCampiagnVisitsTableMap::COL_OUTLET_ORG_DATA_ID, $outletOrgDataId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the is_visited column
     *
     * Example usage:
     * <code>
     * $query->filterByIsVisited(true); // WHERE is_visited = true
     * $query->filterByIsVisited('yes'); // WHERE is_visited = true
     * </code>
     *
     * @param bool|string $isVisited The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIsVisited($isVisited = null, ?string $comparison = null)
    {
        if (is_string($isVisited)) {
            $isVisited = in_array(strtolower($isVisited), array('false', 'off', '-', 'no', 'n', '0', ''), true) ? false : true;
        }

        $this->addUsingAlias(BrandCampiagnVisitsTableMap::COL_IS_VISITED, $isVisited, $comparison);

        return $this;
    }

    /**
     * Filter the query on the visited_datetime column
     *
     * Example usage:
     * <code>
     * $query->filterByVisitedDatetime('2011-03-14'); // WHERE visited_datetime = '2011-03-14'
     * $query->filterByVisitedDatetime('now'); // WHERE visited_datetime = '2011-03-14'
     * $query->filterByVisitedDatetime(array('max' => 'yesterday')); // WHERE visited_datetime > '2011-03-13'
     * </code>
     *
     * @param mixed $visitedDatetime The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByVisitedDatetime($visitedDatetime = null, ?string $comparison = null)
    {
        if (is_array($visitedDatetime)) {
            $useMinMax = false;
            if (isset($visitedDatetime['min'])) {
                $this->addUsingAlias(BrandCampiagnVisitsTableMap::COL_VISITED_DATETIME, $visitedDatetime['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($visitedDatetime['max'])) {
                $this->addUsingAlias(BrandCampiagnVisitsTableMap::COL_VISITED_DATETIME, $visitedDatetime['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandCampiagnVisitsTableMap::COL_VISITED_DATETIME, $visitedDatetime, $comparison);

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
                $this->addUsingAlias(BrandCampiagnVisitsTableMap::COL_DCR_ID, $dcrId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dcrId['max'])) {
                $this->addUsingAlias(BrandCampiagnVisitsTableMap::COL_DCR_ID, $dcrId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandCampiagnVisitsTableMap::COL_DCR_ID, $dcrId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the position_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPositionId(1234); // WHERE position_id = 1234
     * $query->filterByPositionId(array(12, 34)); // WHERE position_id IN (12, 34)
     * $query->filterByPositionId(array('min' => 12)); // WHERE position_id > 12
     * </code>
     *
     * @see       filterByPositions()
     *
     * @param mixed $positionId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPositionId($positionId = null, ?string $comparison = null)
    {
        if (is_array($positionId)) {
            $useMinMax = false;
            if (isset($positionId['min'])) {
                $this->addUsingAlias(BrandCampiagnVisitsTableMap::COL_POSITION_ID, $positionId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($positionId['max'])) {
                $this->addUsingAlias(BrandCampiagnVisitsTableMap::COL_POSITION_ID, $positionId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandCampiagnVisitsTableMap::COL_POSITION_ID, $positionId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the comment column
     *
     * Example usage:
     * <code>
     * $query->filterByComment('fooValue');   // WHERE comment = 'fooValue'
     * $query->filterByComment('%fooValue%', Criteria::LIKE); // WHERE comment LIKE '%fooValue%'
     * $query->filterByComment(['foo', 'bar']); // WHERE comment IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $comment The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByComment($comment = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($comment)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandCampiagnVisitsTableMap::COL_COMMENT, $comment, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \entities\BrandCampiagn object
     *
     * @param \entities\BrandCampiagn|ObjectCollection $brandCampiagn The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBrandCampiagn($brandCampiagn, ?string $comparison = null)
    {
        if ($brandCampiagn instanceof \entities\BrandCampiagn) {
            return $this
                ->addUsingAlias(BrandCampiagnVisitsTableMap::COL_BRAND_CAMPIAGN_ID, $brandCampiagn->getBrandCampiagnId(), $comparison);
        } elseif ($brandCampiagn instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(BrandCampiagnVisitsTableMap::COL_BRAND_CAMPIAGN_ID, $brandCampiagn->toKeyValue('PrimaryKey', 'BrandCampiagnId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByBrandCampiagn() only accepts arguments of type \entities\BrandCampiagn or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BrandCampiagn relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinBrandCampiagn(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BrandCampiagn');

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
            $this->addJoinObject($join, 'BrandCampiagn');
        }

        return $this;
    }

    /**
     * Use the BrandCampiagn relation BrandCampiagn object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\BrandCampiagnQuery A secondary query class using the current class as primary query
     */
    public function useBrandCampiagnQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinBrandCampiagn($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BrandCampiagn', '\entities\BrandCampiagnQuery');
    }

    /**
     * Use the BrandCampiagn relation BrandCampiagn object
     *
     * @param callable(\entities\BrandCampiagnQuery):\entities\BrandCampiagnQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withBrandCampiagnQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useBrandCampiagnQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to BrandCampiagn table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\BrandCampiagnQuery The inner query object of the EXISTS statement
     */
    public function useBrandCampiagnExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\BrandCampiagnQuery */
        $q = $this->useExistsQuery('BrandCampiagn', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to BrandCampiagn table for a NOT EXISTS query.
     *
     * @see useBrandCampiagnExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\BrandCampiagnQuery The inner query object of the NOT EXISTS statement
     */
    public function useBrandCampiagnNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\BrandCampiagnQuery */
        $q = $this->useExistsQuery('BrandCampiagn', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to BrandCampiagn table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\BrandCampiagnQuery The inner query object of the IN statement
     */
    public function useInBrandCampiagnQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\BrandCampiagnQuery */
        $q = $this->useInQuery('BrandCampiagn', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to BrandCampiagn table for a NOT IN query.
     *
     * @see useBrandCampiagnInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\BrandCampiagnQuery The inner query object of the NOT IN statement
     */
    public function useNotInBrandCampiagnQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\BrandCampiagnQuery */
        $q = $this->useInQuery('BrandCampiagn', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\Outlets object
     *
     * @param \entities\Outlets|ObjectCollection $outlets The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutlets($outlets, ?string $comparison = null)
    {
        if ($outlets instanceof \entities\Outlets) {
            return $this
                ->addUsingAlias(BrandCampiagnVisitsTableMap::COL_OUTLET_ID, $outlets->getId(), $comparison);
        } elseif ($outlets instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(BrandCampiagnVisitsTableMap::COL_OUTLET_ID, $outlets->toKeyValue('PrimaryKey', 'Id'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByOutlets() only accepts arguments of type \entities\Outlets or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Outlets relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOutlets(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Outlets');

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
            $this->addJoinObject($join, 'Outlets');
        }

        return $this;
    }

    /**
     * Use the Outlets relation Outlets object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\OutletsQuery A secondary query class using the current class as primary query
     */
    public function useOutletsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinOutlets($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Outlets', '\entities\OutletsQuery');
    }

    /**
     * Use the Outlets relation Outlets object
     *
     * @param callable(\entities\OutletsQuery):\entities\OutletsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOutletsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useOutletsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Outlets table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\OutletsQuery The inner query object of the EXISTS statement
     */
    public function useOutletsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\OutletsQuery */
        $q = $this->useExistsQuery('Outlets', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Outlets table for a NOT EXISTS query.
     *
     * @see useOutletsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\OutletsQuery The inner query object of the NOT EXISTS statement
     */
    public function useOutletsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OutletsQuery */
        $q = $this->useExistsQuery('Outlets', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Outlets table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\OutletsQuery The inner query object of the IN statement
     */
    public function useInOutletsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\OutletsQuery */
        $q = $this->useInQuery('Outlets', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Outlets table for a NOT IN query.
     *
     * @see useOutletsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\OutletsQuery The inner query object of the NOT IN statement
     */
    public function useNotInOutletsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OutletsQuery */
        $q = $this->useInQuery('Outlets', $modelAlias, $queryClass, 'NOT IN');
        return $q;
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
                ->addUsingAlias(BrandCampiagnVisitsTableMap::COL_BRAND_CAMPIAGN_VISIT_PLAN_ID, $brandCampiagnVisitPlan->getBrandCampiagnVisitPlanId(), $comparison);
        } elseif ($brandCampiagnVisitPlan instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(BrandCampiagnVisitsTableMap::COL_BRAND_CAMPIAGN_VISIT_PLAN_ID, $brandCampiagnVisitPlan->toKeyValue('PrimaryKey', 'BrandCampiagnVisitPlanId'), $comparison);

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
                ->addUsingAlias(BrandCampiagnVisitsTableMap::COL_DCR_ID, $dailycalls->getDcrId(), $comparison);
        } elseif ($dailycalls instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(BrandCampiagnVisitsTableMap::COL_DCR_ID, $dailycalls->toKeyValue('PrimaryKey', 'DcrId'), $comparison);

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
     * Filter the query by a related \entities\Positions object
     *
     * @param \entities\Positions|ObjectCollection $positions The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPositions($positions, ?string $comparison = null)
    {
        if ($positions instanceof \entities\Positions) {
            return $this
                ->addUsingAlias(BrandCampiagnVisitsTableMap::COL_POSITION_ID, $positions->getPositionId(), $comparison);
        } elseif ($positions instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(BrandCampiagnVisitsTableMap::COL_POSITION_ID, $positions->toKeyValue('PrimaryKey', 'PositionId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByPositions() only accepts arguments of type \entities\Positions or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Positions relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinPositions(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Positions');

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
            $this->addJoinObject($join, 'Positions');
        }

        return $this;
    }

    /**
     * Use the Positions relation Positions object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\PositionsQuery A secondary query class using the current class as primary query
     */
    public function usePositionsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinPositions($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Positions', '\entities\PositionsQuery');
    }

    /**
     * Use the Positions relation Positions object
     *
     * @param callable(\entities\PositionsQuery):\entities\PositionsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withPositionsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->usePositionsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Positions table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\PositionsQuery The inner query object of the EXISTS statement
     */
    public function usePositionsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\PositionsQuery */
        $q = $this->useExistsQuery('Positions', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Positions table for a NOT EXISTS query.
     *
     * @see usePositionsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\PositionsQuery The inner query object of the NOT EXISTS statement
     */
    public function usePositionsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\PositionsQuery */
        $q = $this->useExistsQuery('Positions', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Positions table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\PositionsQuery The inner query object of the IN statement
     */
    public function useInPositionsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\PositionsQuery */
        $q = $this->useInQuery('Positions', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Positions table for a NOT IN query.
     *
     * @see usePositionsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\PositionsQuery The inner query object of the NOT IN statement
     */
    public function useNotInPositionsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\PositionsQuery */
        $q = $this->useInQuery('Positions', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildBrandCampiagnVisits $brandCampiagnVisits Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($brandCampiagnVisits = null)
    {
        if ($brandCampiagnVisits) {
            $this->addUsingAlias(BrandCampiagnVisitsTableMap::COL_BRAND_CAMPIAGN_VISIT_ID, $brandCampiagnVisits->getBrandCampiagnVisitId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the brand_campiagn_visits table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(BrandCampiagnVisitsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            BrandCampiagnVisitsTableMap::clearInstancePool();
            BrandCampiagnVisitsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(BrandCampiagnVisitsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(BrandCampiagnVisitsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            BrandCampiagnVisitsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            BrandCampiagnVisitsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
