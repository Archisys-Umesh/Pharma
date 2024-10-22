<?php

namespace entities\Base;

use \Exception;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\LogicException;
use entities\MtpDeviationView as ChildMtpDeviationView;
use entities\MtpDeviationViewQuery as ChildMtpDeviationViewQuery;
use entities\Map\MtpDeviationViewTableMap;

/**
 * Base class that represents a query for the `mtp_deviation_view` table.
 *
 * @method     ChildMtpDeviationViewQuery orderByBu($order = Criteria::ASC) Order by the bu column
 * @method     ChildMtpDeviationViewQuery orderByLevel3($order = Criteria::ASC) Order by the level3 column
 * @method     ChildMtpDeviationViewQuery orderByLevel2($order = Criteria::ASC) Order by the level2 column
 * @method     ChildMtpDeviationViewQuery orderByLevel1($order = Criteria::ASC) Order by the level1 column
 * @method     ChildMtpDeviationViewQuery orderByPositionId($order = Criteria::ASC) Order by the position_id column
 * @method     ChildMtpDeviationViewQuery orderByLocation($order = Criteria::ASC) Order by the location column
 * @method     ChildMtpDeviationViewQuery orderByRepname($order = Criteria::ASC) Order by the repname column
 * @method     ChildMtpDeviationViewQuery orderByEmployeeCode($order = Criteria::ASC) Order by the employee_code column
 * @method     ChildMtpDeviationViewQuery orderByDesignation($order = Criteria::ASC) Order by the designation column
 * @method     ChildMtpDeviationViewQuery orderByDate($order = Criteria::ASC) Order by the date column
 * @method     ChildMtpDeviationViewQuery orderByPlannedActivity($order = Criteria::ASC) Order by the planned_activity column
 * @method     ChildMtpDeviationViewQuery orderByActualActivity($order = Criteria::ASC) Order by the actual_activity column
 * @method     ChildMtpDeviationViewQuery orderByPlannedPatch($order = Criteria::ASC) Order by the planned_patch column
 * @method     ChildMtpDeviationViewQuery orderByCoveredPatch($order = Criteria::ASC) Order by the covered_patch column
 * @method     ChildMtpDeviationViewQuery orderByPlannedtown($order = Criteria::ASC) Order by the plannedtown column
 * @method     ChildMtpDeviationViewQuery orderByCoveredtown($order = Criteria::ASC) Order by the coveredtown column
 * @method     ChildMtpDeviationViewQuery orderByTotalcallsMade($order = Criteria::ASC) Order by the totalcalls_made column
 * @method     ChildMtpDeviationViewQuery orderByDoctorPlanned($order = Criteria::ASC) Order by the doctor_planned column
 * @method     ChildMtpDeviationViewQuery orderByDoctorCovered($order = Criteria::ASC) Order by the doctor_covered column
 * @method     ChildMtpDeviationViewQuery orderByRetailerPlanned($order = Criteria::ASC) Order by the retailer_planned column
 * @method     ChildMtpDeviationViewQuery orderByRetailerCovered($order = Criteria::ASC) Order by the retailer_covered column
 * @method     ChildMtpDeviationViewQuery orderByStokiestPlanned($order = Criteria::ASC) Order by the stokiest_planned column
 * @method     ChildMtpDeviationViewQuery orderByStokiestCovered($order = Criteria::ASC) Order by the stokiest_covered column
 *
 * @method     ChildMtpDeviationViewQuery groupByBu() Group by the bu column
 * @method     ChildMtpDeviationViewQuery groupByLevel3() Group by the level3 column
 * @method     ChildMtpDeviationViewQuery groupByLevel2() Group by the level2 column
 * @method     ChildMtpDeviationViewQuery groupByLevel1() Group by the level1 column
 * @method     ChildMtpDeviationViewQuery groupByPositionId() Group by the position_id column
 * @method     ChildMtpDeviationViewQuery groupByLocation() Group by the location column
 * @method     ChildMtpDeviationViewQuery groupByRepname() Group by the repname column
 * @method     ChildMtpDeviationViewQuery groupByEmployeeCode() Group by the employee_code column
 * @method     ChildMtpDeviationViewQuery groupByDesignation() Group by the designation column
 * @method     ChildMtpDeviationViewQuery groupByDate() Group by the date column
 * @method     ChildMtpDeviationViewQuery groupByPlannedActivity() Group by the planned_activity column
 * @method     ChildMtpDeviationViewQuery groupByActualActivity() Group by the actual_activity column
 * @method     ChildMtpDeviationViewQuery groupByPlannedPatch() Group by the planned_patch column
 * @method     ChildMtpDeviationViewQuery groupByCoveredPatch() Group by the covered_patch column
 * @method     ChildMtpDeviationViewQuery groupByPlannedtown() Group by the plannedtown column
 * @method     ChildMtpDeviationViewQuery groupByCoveredtown() Group by the coveredtown column
 * @method     ChildMtpDeviationViewQuery groupByTotalcallsMade() Group by the totalcalls_made column
 * @method     ChildMtpDeviationViewQuery groupByDoctorPlanned() Group by the doctor_planned column
 * @method     ChildMtpDeviationViewQuery groupByDoctorCovered() Group by the doctor_covered column
 * @method     ChildMtpDeviationViewQuery groupByRetailerPlanned() Group by the retailer_planned column
 * @method     ChildMtpDeviationViewQuery groupByRetailerCovered() Group by the retailer_covered column
 * @method     ChildMtpDeviationViewQuery groupByStokiestPlanned() Group by the stokiest_planned column
 * @method     ChildMtpDeviationViewQuery groupByStokiestCovered() Group by the stokiest_covered column
 *
 * @method     ChildMtpDeviationViewQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildMtpDeviationViewQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildMtpDeviationViewQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildMtpDeviationViewQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildMtpDeviationViewQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildMtpDeviationViewQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildMtpDeviationView|null findOne(?ConnectionInterface $con = null) Return the first ChildMtpDeviationView matching the query
 * @method     ChildMtpDeviationView findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildMtpDeviationView matching the query, or a new ChildMtpDeviationView object populated from the query conditions when no match is found
 *
 * @method     ChildMtpDeviationView|null findOneByBu(string $bu) Return the first ChildMtpDeviationView filtered by the bu column
 * @method     ChildMtpDeviationView|null findOneByLevel3(string $level3) Return the first ChildMtpDeviationView filtered by the level3 column
 * @method     ChildMtpDeviationView|null findOneByLevel2(string $level2) Return the first ChildMtpDeviationView filtered by the level2 column
 * @method     ChildMtpDeviationView|null findOneByLevel1(string $level1) Return the first ChildMtpDeviationView filtered by the level1 column
 * @method     ChildMtpDeviationView|null findOneByPositionId(int $position_id) Return the first ChildMtpDeviationView filtered by the position_id column
 * @method     ChildMtpDeviationView|null findOneByLocation(string $location) Return the first ChildMtpDeviationView filtered by the location column
 * @method     ChildMtpDeviationView|null findOneByRepname(string $repname) Return the first ChildMtpDeviationView filtered by the repname column
 * @method     ChildMtpDeviationView|null findOneByEmployeeCode(string $employee_code) Return the first ChildMtpDeviationView filtered by the employee_code column
 * @method     ChildMtpDeviationView|null findOneByDesignation(string $designation) Return the first ChildMtpDeviationView filtered by the designation column
 * @method     ChildMtpDeviationView|null findOneByDate(string $date) Return the first ChildMtpDeviationView filtered by the date column
 * @method     ChildMtpDeviationView|null findOneByPlannedActivity(string $planned_activity) Return the first ChildMtpDeviationView filtered by the planned_activity column
 * @method     ChildMtpDeviationView|null findOneByActualActivity(string $actual_activity) Return the first ChildMtpDeviationView filtered by the actual_activity column
 * @method     ChildMtpDeviationView|null findOneByPlannedPatch(string $planned_patch) Return the first ChildMtpDeviationView filtered by the planned_patch column
 * @method     ChildMtpDeviationView|null findOneByCoveredPatch(string $covered_patch) Return the first ChildMtpDeviationView filtered by the covered_patch column
 * @method     ChildMtpDeviationView|null findOneByPlannedtown(string $plannedtown) Return the first ChildMtpDeviationView filtered by the plannedtown column
 * @method     ChildMtpDeviationView|null findOneByCoveredtown(string $coveredtown) Return the first ChildMtpDeviationView filtered by the coveredtown column
 * @method     ChildMtpDeviationView|null findOneByTotalcallsMade(int $totalcalls_made) Return the first ChildMtpDeviationView filtered by the totalcalls_made column
 * @method     ChildMtpDeviationView|null findOneByDoctorPlanned(int $doctor_planned) Return the first ChildMtpDeviationView filtered by the doctor_planned column
 * @method     ChildMtpDeviationView|null findOneByDoctorCovered(int $doctor_covered) Return the first ChildMtpDeviationView filtered by the doctor_covered column
 * @method     ChildMtpDeviationView|null findOneByRetailerPlanned(int $retailer_planned) Return the first ChildMtpDeviationView filtered by the retailer_planned column
 * @method     ChildMtpDeviationView|null findOneByRetailerCovered(int $retailer_covered) Return the first ChildMtpDeviationView filtered by the retailer_covered column
 * @method     ChildMtpDeviationView|null findOneByStokiestPlanned(int $stokiest_planned) Return the first ChildMtpDeviationView filtered by the stokiest_planned column
 * @method     ChildMtpDeviationView|null findOneByStokiestCovered(int $stokiest_covered) Return the first ChildMtpDeviationView filtered by the stokiest_covered column
 *
 * @method     ChildMtpDeviationView requirePk($key, ?ConnectionInterface $con = null) Return the ChildMtpDeviationView by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMtpDeviationView requireOne(?ConnectionInterface $con = null) Return the first ChildMtpDeviationView matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildMtpDeviationView requireOneByBu(string $bu) Return the first ChildMtpDeviationView filtered by the bu column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMtpDeviationView requireOneByLevel3(string $level3) Return the first ChildMtpDeviationView filtered by the level3 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMtpDeviationView requireOneByLevel2(string $level2) Return the first ChildMtpDeviationView filtered by the level2 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMtpDeviationView requireOneByLevel1(string $level1) Return the first ChildMtpDeviationView filtered by the level1 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMtpDeviationView requireOneByPositionId(int $position_id) Return the first ChildMtpDeviationView filtered by the position_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMtpDeviationView requireOneByLocation(string $location) Return the first ChildMtpDeviationView filtered by the location column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMtpDeviationView requireOneByRepname(string $repname) Return the first ChildMtpDeviationView filtered by the repname column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMtpDeviationView requireOneByEmployeeCode(string $employee_code) Return the first ChildMtpDeviationView filtered by the employee_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMtpDeviationView requireOneByDesignation(string $designation) Return the first ChildMtpDeviationView filtered by the designation column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMtpDeviationView requireOneByDate(string $date) Return the first ChildMtpDeviationView filtered by the date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMtpDeviationView requireOneByPlannedActivity(string $planned_activity) Return the first ChildMtpDeviationView filtered by the planned_activity column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMtpDeviationView requireOneByActualActivity(string $actual_activity) Return the first ChildMtpDeviationView filtered by the actual_activity column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMtpDeviationView requireOneByPlannedPatch(string $planned_patch) Return the first ChildMtpDeviationView filtered by the planned_patch column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMtpDeviationView requireOneByCoveredPatch(string $covered_patch) Return the first ChildMtpDeviationView filtered by the covered_patch column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMtpDeviationView requireOneByPlannedtown(string $plannedtown) Return the first ChildMtpDeviationView filtered by the plannedtown column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMtpDeviationView requireOneByCoveredtown(string $coveredtown) Return the first ChildMtpDeviationView filtered by the coveredtown column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMtpDeviationView requireOneByTotalcallsMade(int $totalcalls_made) Return the first ChildMtpDeviationView filtered by the totalcalls_made column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMtpDeviationView requireOneByDoctorPlanned(int $doctor_planned) Return the first ChildMtpDeviationView filtered by the doctor_planned column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMtpDeviationView requireOneByDoctorCovered(int $doctor_covered) Return the first ChildMtpDeviationView filtered by the doctor_covered column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMtpDeviationView requireOneByRetailerPlanned(int $retailer_planned) Return the first ChildMtpDeviationView filtered by the retailer_planned column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMtpDeviationView requireOneByRetailerCovered(int $retailer_covered) Return the first ChildMtpDeviationView filtered by the retailer_covered column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMtpDeviationView requireOneByStokiestPlanned(int $stokiest_planned) Return the first ChildMtpDeviationView filtered by the stokiest_planned column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMtpDeviationView requireOneByStokiestCovered(int $stokiest_covered) Return the first ChildMtpDeviationView filtered by the stokiest_covered column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildMtpDeviationView[]|Collection find(?ConnectionInterface $con = null) Return ChildMtpDeviationView objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildMtpDeviationView> find(?ConnectionInterface $con = null) Return ChildMtpDeviationView objects based on current ModelCriteria
 *
 * @method     ChildMtpDeviationView[]|Collection findByBu(string|array<string> $bu) Return ChildMtpDeviationView objects filtered by the bu column
 * @psalm-method Collection&\Traversable<ChildMtpDeviationView> findByBu(string|array<string> $bu) Return ChildMtpDeviationView objects filtered by the bu column
 * @method     ChildMtpDeviationView[]|Collection findByLevel3(string|array<string> $level3) Return ChildMtpDeviationView objects filtered by the level3 column
 * @psalm-method Collection&\Traversable<ChildMtpDeviationView> findByLevel3(string|array<string> $level3) Return ChildMtpDeviationView objects filtered by the level3 column
 * @method     ChildMtpDeviationView[]|Collection findByLevel2(string|array<string> $level2) Return ChildMtpDeviationView objects filtered by the level2 column
 * @psalm-method Collection&\Traversable<ChildMtpDeviationView> findByLevel2(string|array<string> $level2) Return ChildMtpDeviationView objects filtered by the level2 column
 * @method     ChildMtpDeviationView[]|Collection findByLevel1(string|array<string> $level1) Return ChildMtpDeviationView objects filtered by the level1 column
 * @psalm-method Collection&\Traversable<ChildMtpDeviationView> findByLevel1(string|array<string> $level1) Return ChildMtpDeviationView objects filtered by the level1 column
 * @method     ChildMtpDeviationView[]|Collection findByPositionId(int|array<int> $position_id) Return ChildMtpDeviationView objects filtered by the position_id column
 * @psalm-method Collection&\Traversable<ChildMtpDeviationView> findByPositionId(int|array<int> $position_id) Return ChildMtpDeviationView objects filtered by the position_id column
 * @method     ChildMtpDeviationView[]|Collection findByLocation(string|array<string> $location) Return ChildMtpDeviationView objects filtered by the location column
 * @psalm-method Collection&\Traversable<ChildMtpDeviationView> findByLocation(string|array<string> $location) Return ChildMtpDeviationView objects filtered by the location column
 * @method     ChildMtpDeviationView[]|Collection findByRepname(string|array<string> $repname) Return ChildMtpDeviationView objects filtered by the repname column
 * @psalm-method Collection&\Traversable<ChildMtpDeviationView> findByRepname(string|array<string> $repname) Return ChildMtpDeviationView objects filtered by the repname column
 * @method     ChildMtpDeviationView[]|Collection findByEmployeeCode(string|array<string> $employee_code) Return ChildMtpDeviationView objects filtered by the employee_code column
 * @psalm-method Collection&\Traversable<ChildMtpDeviationView> findByEmployeeCode(string|array<string> $employee_code) Return ChildMtpDeviationView objects filtered by the employee_code column
 * @method     ChildMtpDeviationView[]|Collection findByDesignation(string|array<string> $designation) Return ChildMtpDeviationView objects filtered by the designation column
 * @psalm-method Collection&\Traversable<ChildMtpDeviationView> findByDesignation(string|array<string> $designation) Return ChildMtpDeviationView objects filtered by the designation column
 * @method     ChildMtpDeviationView[]|Collection findByDate(string|array<string> $date) Return ChildMtpDeviationView objects filtered by the date column
 * @psalm-method Collection&\Traversable<ChildMtpDeviationView> findByDate(string|array<string> $date) Return ChildMtpDeviationView objects filtered by the date column
 * @method     ChildMtpDeviationView[]|Collection findByPlannedActivity(string|array<string> $planned_activity) Return ChildMtpDeviationView objects filtered by the planned_activity column
 * @psalm-method Collection&\Traversable<ChildMtpDeviationView> findByPlannedActivity(string|array<string> $planned_activity) Return ChildMtpDeviationView objects filtered by the planned_activity column
 * @method     ChildMtpDeviationView[]|Collection findByActualActivity(string|array<string> $actual_activity) Return ChildMtpDeviationView objects filtered by the actual_activity column
 * @psalm-method Collection&\Traversable<ChildMtpDeviationView> findByActualActivity(string|array<string> $actual_activity) Return ChildMtpDeviationView objects filtered by the actual_activity column
 * @method     ChildMtpDeviationView[]|Collection findByPlannedPatch(string|array<string> $planned_patch) Return ChildMtpDeviationView objects filtered by the planned_patch column
 * @psalm-method Collection&\Traversable<ChildMtpDeviationView> findByPlannedPatch(string|array<string> $planned_patch) Return ChildMtpDeviationView objects filtered by the planned_patch column
 * @method     ChildMtpDeviationView[]|Collection findByCoveredPatch(string|array<string> $covered_patch) Return ChildMtpDeviationView objects filtered by the covered_patch column
 * @psalm-method Collection&\Traversable<ChildMtpDeviationView> findByCoveredPatch(string|array<string> $covered_patch) Return ChildMtpDeviationView objects filtered by the covered_patch column
 * @method     ChildMtpDeviationView[]|Collection findByPlannedtown(string|array<string> $plannedtown) Return ChildMtpDeviationView objects filtered by the plannedtown column
 * @psalm-method Collection&\Traversable<ChildMtpDeviationView> findByPlannedtown(string|array<string> $plannedtown) Return ChildMtpDeviationView objects filtered by the plannedtown column
 * @method     ChildMtpDeviationView[]|Collection findByCoveredtown(string|array<string> $coveredtown) Return ChildMtpDeviationView objects filtered by the coveredtown column
 * @psalm-method Collection&\Traversable<ChildMtpDeviationView> findByCoveredtown(string|array<string> $coveredtown) Return ChildMtpDeviationView objects filtered by the coveredtown column
 * @method     ChildMtpDeviationView[]|Collection findByTotalcallsMade(int|array<int> $totalcalls_made) Return ChildMtpDeviationView objects filtered by the totalcalls_made column
 * @psalm-method Collection&\Traversable<ChildMtpDeviationView> findByTotalcallsMade(int|array<int> $totalcalls_made) Return ChildMtpDeviationView objects filtered by the totalcalls_made column
 * @method     ChildMtpDeviationView[]|Collection findByDoctorPlanned(int|array<int> $doctor_planned) Return ChildMtpDeviationView objects filtered by the doctor_planned column
 * @psalm-method Collection&\Traversable<ChildMtpDeviationView> findByDoctorPlanned(int|array<int> $doctor_planned) Return ChildMtpDeviationView objects filtered by the doctor_planned column
 * @method     ChildMtpDeviationView[]|Collection findByDoctorCovered(int|array<int> $doctor_covered) Return ChildMtpDeviationView objects filtered by the doctor_covered column
 * @psalm-method Collection&\Traversable<ChildMtpDeviationView> findByDoctorCovered(int|array<int> $doctor_covered) Return ChildMtpDeviationView objects filtered by the doctor_covered column
 * @method     ChildMtpDeviationView[]|Collection findByRetailerPlanned(int|array<int> $retailer_planned) Return ChildMtpDeviationView objects filtered by the retailer_planned column
 * @psalm-method Collection&\Traversable<ChildMtpDeviationView> findByRetailerPlanned(int|array<int> $retailer_planned) Return ChildMtpDeviationView objects filtered by the retailer_planned column
 * @method     ChildMtpDeviationView[]|Collection findByRetailerCovered(int|array<int> $retailer_covered) Return ChildMtpDeviationView objects filtered by the retailer_covered column
 * @psalm-method Collection&\Traversable<ChildMtpDeviationView> findByRetailerCovered(int|array<int> $retailer_covered) Return ChildMtpDeviationView objects filtered by the retailer_covered column
 * @method     ChildMtpDeviationView[]|Collection findByStokiestPlanned(int|array<int> $stokiest_planned) Return ChildMtpDeviationView objects filtered by the stokiest_planned column
 * @psalm-method Collection&\Traversable<ChildMtpDeviationView> findByStokiestPlanned(int|array<int> $stokiest_planned) Return ChildMtpDeviationView objects filtered by the stokiest_planned column
 * @method     ChildMtpDeviationView[]|Collection findByStokiestCovered(int|array<int> $stokiest_covered) Return ChildMtpDeviationView objects filtered by the stokiest_covered column
 * @psalm-method Collection&\Traversable<ChildMtpDeviationView> findByStokiestCovered(int|array<int> $stokiest_covered) Return ChildMtpDeviationView objects filtered by the stokiest_covered column
 *
 * @method     ChildMtpDeviationView[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildMtpDeviationView> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class MtpDeviationViewQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\MtpDeviationViewQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\MtpDeviationView', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildMtpDeviationViewQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildMtpDeviationViewQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildMtpDeviationViewQuery) {
            return $criteria;
        }
        $query = new ChildMtpDeviationViewQuery();
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
     * @return ChildMtpDeviationView|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        throw new LogicException('The MtpDeviationView object has no primary key');
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
        throw new LogicException('The MtpDeviationView object has no primary key');
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
        throw new LogicException('The MtpDeviationView object has no primary key');
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
        throw new LogicException('The MtpDeviationView object has no primary key');
    }

    /**
     * Filter the query on the bu column
     *
     * Example usage:
     * <code>
     * $query->filterByBu('fooValue');   // WHERE bu = 'fooValue'
     * $query->filterByBu('%fooValue%', Criteria::LIKE); // WHERE bu LIKE '%fooValue%'
     * $query->filterByBu(['foo', 'bar']); // WHERE bu IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $bu The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBu($bu = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($bu)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MtpDeviationViewTableMap::COL_BU, $bu, $comparison);

        return $this;
    }

    /**
     * Filter the query on the level3 column
     *
     * Example usage:
     * <code>
     * $query->filterByLevel3('fooValue');   // WHERE level3 = 'fooValue'
     * $query->filterByLevel3('%fooValue%', Criteria::LIKE); // WHERE level3 LIKE '%fooValue%'
     * $query->filterByLevel3(['foo', 'bar']); // WHERE level3 IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $level3 The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLevel3($level3 = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($level3)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MtpDeviationViewTableMap::COL_LEVEL3, $level3, $comparison);

        return $this;
    }

    /**
     * Filter the query on the level2 column
     *
     * Example usage:
     * <code>
     * $query->filterByLevel2('fooValue');   // WHERE level2 = 'fooValue'
     * $query->filterByLevel2('%fooValue%', Criteria::LIKE); // WHERE level2 LIKE '%fooValue%'
     * $query->filterByLevel2(['foo', 'bar']); // WHERE level2 IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $level2 The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLevel2($level2 = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($level2)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MtpDeviationViewTableMap::COL_LEVEL2, $level2, $comparison);

        return $this;
    }

    /**
     * Filter the query on the level1 column
     *
     * Example usage:
     * <code>
     * $query->filterByLevel1('fooValue');   // WHERE level1 = 'fooValue'
     * $query->filterByLevel1('%fooValue%', Criteria::LIKE); // WHERE level1 LIKE '%fooValue%'
     * $query->filterByLevel1(['foo', 'bar']); // WHERE level1 IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $level1 The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLevel1($level1 = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($level1)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MtpDeviationViewTableMap::COL_LEVEL1, $level1, $comparison);

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
                $this->addUsingAlias(MtpDeviationViewTableMap::COL_POSITION_ID, $positionId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($positionId['max'])) {
                $this->addUsingAlias(MtpDeviationViewTableMap::COL_POSITION_ID, $positionId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MtpDeviationViewTableMap::COL_POSITION_ID, $positionId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the location column
     *
     * Example usage:
     * <code>
     * $query->filterByLocation('fooValue');   // WHERE location = 'fooValue'
     * $query->filterByLocation('%fooValue%', Criteria::LIKE); // WHERE location LIKE '%fooValue%'
     * $query->filterByLocation(['foo', 'bar']); // WHERE location IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $location The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLocation($location = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($location)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MtpDeviationViewTableMap::COL_LOCATION, $location, $comparison);

        return $this;
    }

    /**
     * Filter the query on the repname column
     *
     * Example usage:
     * <code>
     * $query->filterByRepname('fooValue');   // WHERE repname = 'fooValue'
     * $query->filterByRepname('%fooValue%', Criteria::LIKE); // WHERE repname LIKE '%fooValue%'
     * $query->filterByRepname(['foo', 'bar']); // WHERE repname IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $repname The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRepname($repname = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($repname)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MtpDeviationViewTableMap::COL_REPNAME, $repname, $comparison);

        return $this;
    }

    /**
     * Filter the query on the employee_code column
     *
     * Example usage:
     * <code>
     * $query->filterByEmployeeCode('fooValue');   // WHERE employee_code = 'fooValue'
     * $query->filterByEmployeeCode('%fooValue%', Criteria::LIKE); // WHERE employee_code LIKE '%fooValue%'
     * $query->filterByEmployeeCode(['foo', 'bar']); // WHERE employee_code IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $employeeCode The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmployeeCode($employeeCode = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($employeeCode)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MtpDeviationViewTableMap::COL_EMPLOYEE_CODE, $employeeCode, $comparison);

        return $this;
    }

    /**
     * Filter the query on the designation column
     *
     * Example usage:
     * <code>
     * $query->filterByDesignation('fooValue');   // WHERE designation = 'fooValue'
     * $query->filterByDesignation('%fooValue%', Criteria::LIKE); // WHERE designation LIKE '%fooValue%'
     * $query->filterByDesignation(['foo', 'bar']); // WHERE designation IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $designation The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDesignation($designation = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($designation)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MtpDeviationViewTableMap::COL_DESIGNATION, $designation, $comparison);

        return $this;
    }

    /**
     * Filter the query on the date column
     *
     * Example usage:
     * <code>
     * $query->filterByDate('2011-03-14'); // WHERE date = '2011-03-14'
     * $query->filterByDate('now'); // WHERE date = '2011-03-14'
     * $query->filterByDate(array('max' => 'yesterday')); // WHERE date > '2011-03-13'
     * </code>
     *
     * @param mixed $date The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDate($date = null, ?string $comparison = null)
    {
        if (is_array($date)) {
            $useMinMax = false;
            if (isset($date['min'])) {
                $this->addUsingAlias(MtpDeviationViewTableMap::COL_DATE, $date['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($date['max'])) {
                $this->addUsingAlias(MtpDeviationViewTableMap::COL_DATE, $date['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MtpDeviationViewTableMap::COL_DATE, $date, $comparison);

        return $this;
    }

    /**
     * Filter the query on the planned_activity column
     *
     * Example usage:
     * <code>
     * $query->filterByPlannedActivity('fooValue');   // WHERE planned_activity = 'fooValue'
     * $query->filterByPlannedActivity('%fooValue%', Criteria::LIKE); // WHERE planned_activity LIKE '%fooValue%'
     * $query->filterByPlannedActivity(['foo', 'bar']); // WHERE planned_activity IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $plannedActivity The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPlannedActivity($plannedActivity = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($plannedActivity)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MtpDeviationViewTableMap::COL_PLANNED_ACTIVITY, $plannedActivity, $comparison);

        return $this;
    }

    /**
     * Filter the query on the actual_activity column
     *
     * Example usage:
     * <code>
     * $query->filterByActualActivity('fooValue');   // WHERE actual_activity = 'fooValue'
     * $query->filterByActualActivity('%fooValue%', Criteria::LIKE); // WHERE actual_activity LIKE '%fooValue%'
     * $query->filterByActualActivity(['foo', 'bar']); // WHERE actual_activity IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $actualActivity The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByActualActivity($actualActivity = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($actualActivity)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MtpDeviationViewTableMap::COL_ACTUAL_ACTIVITY, $actualActivity, $comparison);

        return $this;
    }

    /**
     * Filter the query on the planned_patch column
     *
     * Example usage:
     * <code>
     * $query->filterByPlannedPatch('fooValue');   // WHERE planned_patch = 'fooValue'
     * $query->filterByPlannedPatch('%fooValue%', Criteria::LIKE); // WHERE planned_patch LIKE '%fooValue%'
     * $query->filterByPlannedPatch(['foo', 'bar']); // WHERE planned_patch IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $plannedPatch The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPlannedPatch($plannedPatch = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($plannedPatch)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MtpDeviationViewTableMap::COL_PLANNED_PATCH, $plannedPatch, $comparison);

        return $this;
    }

    /**
     * Filter the query on the covered_patch column
     *
     * Example usage:
     * <code>
     * $query->filterByCoveredPatch('fooValue');   // WHERE covered_patch = 'fooValue'
     * $query->filterByCoveredPatch('%fooValue%', Criteria::LIKE); // WHERE covered_patch LIKE '%fooValue%'
     * $query->filterByCoveredPatch(['foo', 'bar']); // WHERE covered_patch IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $coveredPatch The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCoveredPatch($coveredPatch = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($coveredPatch)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MtpDeviationViewTableMap::COL_COVERED_PATCH, $coveredPatch, $comparison);

        return $this;
    }

    /**
     * Filter the query on the plannedtown column
     *
     * Example usage:
     * <code>
     * $query->filterByPlannedtown('fooValue');   // WHERE plannedtown = 'fooValue'
     * $query->filterByPlannedtown('%fooValue%', Criteria::LIKE); // WHERE plannedtown LIKE '%fooValue%'
     * $query->filterByPlannedtown(['foo', 'bar']); // WHERE plannedtown IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $plannedtown The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPlannedtown($plannedtown = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($plannedtown)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MtpDeviationViewTableMap::COL_PLANNEDTOWN, $plannedtown, $comparison);

        return $this;
    }

    /**
     * Filter the query on the coveredtown column
     *
     * Example usage:
     * <code>
     * $query->filterByCoveredtown('fooValue');   // WHERE coveredtown = 'fooValue'
     * $query->filterByCoveredtown('%fooValue%', Criteria::LIKE); // WHERE coveredtown LIKE '%fooValue%'
     * $query->filterByCoveredtown(['foo', 'bar']); // WHERE coveredtown IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $coveredtown The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCoveredtown($coveredtown = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($coveredtown)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MtpDeviationViewTableMap::COL_COVEREDTOWN, $coveredtown, $comparison);

        return $this;
    }

    /**
     * Filter the query on the totalcalls_made column
     *
     * Example usage:
     * <code>
     * $query->filterByTotalcallsMade(1234); // WHERE totalcalls_made = 1234
     * $query->filterByTotalcallsMade(array(12, 34)); // WHERE totalcalls_made IN (12, 34)
     * $query->filterByTotalcallsMade(array('min' => 12)); // WHERE totalcalls_made > 12
     * </code>
     *
     * @param mixed $totalcallsMade The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTotalcallsMade($totalcallsMade = null, ?string $comparison = null)
    {
        if (is_array($totalcallsMade)) {
            $useMinMax = false;
            if (isset($totalcallsMade['min'])) {
                $this->addUsingAlias(MtpDeviationViewTableMap::COL_TOTALCALLS_MADE, $totalcallsMade['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($totalcallsMade['max'])) {
                $this->addUsingAlias(MtpDeviationViewTableMap::COL_TOTALCALLS_MADE, $totalcallsMade['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MtpDeviationViewTableMap::COL_TOTALCALLS_MADE, $totalcallsMade, $comparison);

        return $this;
    }

    /**
     * Filter the query on the doctor_planned column
     *
     * Example usage:
     * <code>
     * $query->filterByDoctorPlanned(1234); // WHERE doctor_planned = 1234
     * $query->filterByDoctorPlanned(array(12, 34)); // WHERE doctor_planned IN (12, 34)
     * $query->filterByDoctorPlanned(array('min' => 12)); // WHERE doctor_planned > 12
     * </code>
     *
     * @param mixed $doctorPlanned The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDoctorPlanned($doctorPlanned = null, ?string $comparison = null)
    {
        if (is_array($doctorPlanned)) {
            $useMinMax = false;
            if (isset($doctorPlanned['min'])) {
                $this->addUsingAlias(MtpDeviationViewTableMap::COL_DOCTOR_PLANNED, $doctorPlanned['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($doctorPlanned['max'])) {
                $this->addUsingAlias(MtpDeviationViewTableMap::COL_DOCTOR_PLANNED, $doctorPlanned['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MtpDeviationViewTableMap::COL_DOCTOR_PLANNED, $doctorPlanned, $comparison);

        return $this;
    }

    /**
     * Filter the query on the doctor_covered column
     *
     * Example usage:
     * <code>
     * $query->filterByDoctorCovered(1234); // WHERE doctor_covered = 1234
     * $query->filterByDoctorCovered(array(12, 34)); // WHERE doctor_covered IN (12, 34)
     * $query->filterByDoctorCovered(array('min' => 12)); // WHERE doctor_covered > 12
     * </code>
     *
     * @param mixed $doctorCovered The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDoctorCovered($doctorCovered = null, ?string $comparison = null)
    {
        if (is_array($doctorCovered)) {
            $useMinMax = false;
            if (isset($doctorCovered['min'])) {
                $this->addUsingAlias(MtpDeviationViewTableMap::COL_DOCTOR_COVERED, $doctorCovered['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($doctorCovered['max'])) {
                $this->addUsingAlias(MtpDeviationViewTableMap::COL_DOCTOR_COVERED, $doctorCovered['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MtpDeviationViewTableMap::COL_DOCTOR_COVERED, $doctorCovered, $comparison);

        return $this;
    }

    /**
     * Filter the query on the retailer_planned column
     *
     * Example usage:
     * <code>
     * $query->filterByRetailerPlanned(1234); // WHERE retailer_planned = 1234
     * $query->filterByRetailerPlanned(array(12, 34)); // WHERE retailer_planned IN (12, 34)
     * $query->filterByRetailerPlanned(array('min' => 12)); // WHERE retailer_planned > 12
     * </code>
     *
     * @param mixed $retailerPlanned The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRetailerPlanned($retailerPlanned = null, ?string $comparison = null)
    {
        if (is_array($retailerPlanned)) {
            $useMinMax = false;
            if (isset($retailerPlanned['min'])) {
                $this->addUsingAlias(MtpDeviationViewTableMap::COL_RETAILER_PLANNED, $retailerPlanned['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($retailerPlanned['max'])) {
                $this->addUsingAlias(MtpDeviationViewTableMap::COL_RETAILER_PLANNED, $retailerPlanned['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MtpDeviationViewTableMap::COL_RETAILER_PLANNED, $retailerPlanned, $comparison);

        return $this;
    }

    /**
     * Filter the query on the retailer_covered column
     *
     * Example usage:
     * <code>
     * $query->filterByRetailerCovered(1234); // WHERE retailer_covered = 1234
     * $query->filterByRetailerCovered(array(12, 34)); // WHERE retailer_covered IN (12, 34)
     * $query->filterByRetailerCovered(array('min' => 12)); // WHERE retailer_covered > 12
     * </code>
     *
     * @param mixed $retailerCovered The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRetailerCovered($retailerCovered = null, ?string $comparison = null)
    {
        if (is_array($retailerCovered)) {
            $useMinMax = false;
            if (isset($retailerCovered['min'])) {
                $this->addUsingAlias(MtpDeviationViewTableMap::COL_RETAILER_COVERED, $retailerCovered['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($retailerCovered['max'])) {
                $this->addUsingAlias(MtpDeviationViewTableMap::COL_RETAILER_COVERED, $retailerCovered['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MtpDeviationViewTableMap::COL_RETAILER_COVERED, $retailerCovered, $comparison);

        return $this;
    }

    /**
     * Filter the query on the stokiest_planned column
     *
     * Example usage:
     * <code>
     * $query->filterByStokiestPlanned(1234); // WHERE stokiest_planned = 1234
     * $query->filterByStokiestPlanned(array(12, 34)); // WHERE stokiest_planned IN (12, 34)
     * $query->filterByStokiestPlanned(array('min' => 12)); // WHERE stokiest_planned > 12
     * </code>
     *
     * @param mixed $stokiestPlanned The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStokiestPlanned($stokiestPlanned = null, ?string $comparison = null)
    {
        if (is_array($stokiestPlanned)) {
            $useMinMax = false;
            if (isset($stokiestPlanned['min'])) {
                $this->addUsingAlias(MtpDeviationViewTableMap::COL_STOKIEST_PLANNED, $stokiestPlanned['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($stokiestPlanned['max'])) {
                $this->addUsingAlias(MtpDeviationViewTableMap::COL_STOKIEST_PLANNED, $stokiestPlanned['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MtpDeviationViewTableMap::COL_STOKIEST_PLANNED, $stokiestPlanned, $comparison);

        return $this;
    }

    /**
     * Filter the query on the stokiest_covered column
     *
     * Example usage:
     * <code>
     * $query->filterByStokiestCovered(1234); // WHERE stokiest_covered = 1234
     * $query->filterByStokiestCovered(array(12, 34)); // WHERE stokiest_covered IN (12, 34)
     * $query->filterByStokiestCovered(array('min' => 12)); // WHERE stokiest_covered > 12
     * </code>
     *
     * @param mixed $stokiestCovered The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStokiestCovered($stokiestCovered = null, ?string $comparison = null)
    {
        if (is_array($stokiestCovered)) {
            $useMinMax = false;
            if (isset($stokiestCovered['min'])) {
                $this->addUsingAlias(MtpDeviationViewTableMap::COL_STOKIEST_COVERED, $stokiestCovered['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($stokiestCovered['max'])) {
                $this->addUsingAlias(MtpDeviationViewTableMap::COL_STOKIEST_COVERED, $stokiestCovered['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MtpDeviationViewTableMap::COL_STOKIEST_COVERED, $stokiestCovered, $comparison);

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildMtpDeviationView $mtpDeviationView Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($mtpDeviationView = null)
    {
        if ($mtpDeviationView) {
            throw new LogicException('MtpDeviationView object has no primary key');

        }

        return $this;
    }

}
