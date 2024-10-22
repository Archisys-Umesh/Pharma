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
use entities\Mtp as ChildMtp;
use entities\MtpQuery as ChildMtpQuery;
use entities\Map\MtpTableMap;

/**
 * Base class that represents a query for the `mtp` table.
 *
 * @method     ChildMtpQuery orderByMtpId($order = Criteria::ASC) Order by the mtp_id column
 * @method     ChildMtpQuery orderByPositionId($order = Criteria::ASC) Order by the position_id column
 * @method     ChildMtpQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildMtpQuery orderByMonth($order = Criteria::ASC) Order by the month column
 * @method     ChildMtpQuery orderByMtpStatus($order = Criteria::ASC) Order by the mtp_status column
 * @method     ChildMtpQuery orderByMtpApprovedBy($order = Criteria::ASC) Order by the mtp_approved_by column
 * @method     ChildMtpQuery orderByApprovedDate($order = Criteria::ASC) Order by the approved_date column
 * @method     ChildMtpQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildMtpQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildMtpQuery orderByOutletsCovered($order = Criteria::ASC) Order by the outlets_covered column
 * @method     ChildMtpQuery orderByMonthDays($order = Criteria::ASC) Order by the month_days column
 * @method     ChildMtpQuery orderByWorkingDays($order = Criteria::ASC) Order by the working_days column
 * @method     ChildMtpQuery orderByAgendaDays($order = Criteria::ASC) Order by the agenda_days column
 * @method     ChildMtpQuery orderByTotalOutlets($order = Criteria::ASC) Order by the total_outlets column
 * @method     ChildMtpQuery orderByTotalVisits($order = Criteria::ASC) Order by the total_visits column
 * @method     ChildMtpQuery orderByVisitsFq($order = Criteria::ASC) Order by the visits_fq column
 * @method     ChildMtpQuery orderByIsProcessed($order = Criteria::ASC) Order by the is_processed column
 * @method     ChildMtpQuery orderByIsMtpGenerating($order = Criteria::ASC) Order by the is_mtp_generating column
 *
 * @method     ChildMtpQuery groupByMtpId() Group by the mtp_id column
 * @method     ChildMtpQuery groupByPositionId() Group by the position_id column
 * @method     ChildMtpQuery groupByCompanyId() Group by the company_id column
 * @method     ChildMtpQuery groupByMonth() Group by the month column
 * @method     ChildMtpQuery groupByMtpStatus() Group by the mtp_status column
 * @method     ChildMtpQuery groupByMtpApprovedBy() Group by the mtp_approved_by column
 * @method     ChildMtpQuery groupByApprovedDate() Group by the approved_date column
 * @method     ChildMtpQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildMtpQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildMtpQuery groupByOutletsCovered() Group by the outlets_covered column
 * @method     ChildMtpQuery groupByMonthDays() Group by the month_days column
 * @method     ChildMtpQuery groupByWorkingDays() Group by the working_days column
 * @method     ChildMtpQuery groupByAgendaDays() Group by the agenda_days column
 * @method     ChildMtpQuery groupByTotalOutlets() Group by the total_outlets column
 * @method     ChildMtpQuery groupByTotalVisits() Group by the total_visits column
 * @method     ChildMtpQuery groupByVisitsFq() Group by the visits_fq column
 * @method     ChildMtpQuery groupByIsProcessed() Group by the is_processed column
 * @method     ChildMtpQuery groupByIsMtpGenerating() Group by the is_mtp_generating column
 *
 * @method     ChildMtpQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildMtpQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildMtpQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildMtpQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildMtpQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildMtpQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildMtpQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildMtpQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildMtpQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildMtpQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildMtpQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildMtpQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildMtpQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     ChildMtpQuery leftJoinEmployee($relationAlias = null) Adds a LEFT JOIN clause to the query using the Employee relation
 * @method     ChildMtpQuery rightJoinEmployee($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Employee relation
 * @method     ChildMtpQuery innerJoinEmployee($relationAlias = null) Adds a INNER JOIN clause to the query using the Employee relation
 *
 * @method     ChildMtpQuery joinWithEmployee($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Employee relation
 *
 * @method     ChildMtpQuery leftJoinWithEmployee() Adds a LEFT JOIN clause and with to the query using the Employee relation
 * @method     ChildMtpQuery rightJoinWithEmployee() Adds a RIGHT JOIN clause and with to the query using the Employee relation
 * @method     ChildMtpQuery innerJoinWithEmployee() Adds a INNER JOIN clause and with to the query using the Employee relation
 *
 * @method     ChildMtpQuery leftJoinPositions($relationAlias = null) Adds a LEFT JOIN clause to the query using the Positions relation
 * @method     ChildMtpQuery rightJoinPositions($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Positions relation
 * @method     ChildMtpQuery innerJoinPositions($relationAlias = null) Adds a INNER JOIN clause to the query using the Positions relation
 *
 * @method     ChildMtpQuery joinWithPositions($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Positions relation
 *
 * @method     ChildMtpQuery leftJoinWithPositions() Adds a LEFT JOIN clause and with to the query using the Positions relation
 * @method     ChildMtpQuery rightJoinWithPositions() Adds a RIGHT JOIN clause and with to the query using the Positions relation
 * @method     ChildMtpQuery innerJoinWithPositions() Adds a INNER JOIN clause and with to the query using the Positions relation
 *
 * @method     ChildMtpQuery leftJoinMtpDay($relationAlias = null) Adds a LEFT JOIN clause to the query using the MtpDay relation
 * @method     ChildMtpQuery rightJoinMtpDay($relationAlias = null) Adds a RIGHT JOIN clause to the query using the MtpDay relation
 * @method     ChildMtpQuery innerJoinMtpDay($relationAlias = null) Adds a INNER JOIN clause to the query using the MtpDay relation
 *
 * @method     ChildMtpQuery joinWithMtpDay($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the MtpDay relation
 *
 * @method     ChildMtpQuery leftJoinWithMtpDay() Adds a LEFT JOIN clause and with to the query using the MtpDay relation
 * @method     ChildMtpQuery rightJoinWithMtpDay() Adds a RIGHT JOIN clause and with to the query using the MtpDay relation
 * @method     ChildMtpQuery innerJoinWithMtpDay() Adds a INNER JOIN clause and with to the query using the MtpDay relation
 *
 * @method     ChildMtpQuery leftJoinMtpLogs($relationAlias = null) Adds a LEFT JOIN clause to the query using the MtpLogs relation
 * @method     ChildMtpQuery rightJoinMtpLogs($relationAlias = null) Adds a RIGHT JOIN clause to the query using the MtpLogs relation
 * @method     ChildMtpQuery innerJoinMtpLogs($relationAlias = null) Adds a INNER JOIN clause to the query using the MtpLogs relation
 *
 * @method     ChildMtpQuery joinWithMtpLogs($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the MtpLogs relation
 *
 * @method     ChildMtpQuery leftJoinWithMtpLogs() Adds a LEFT JOIN clause and with to the query using the MtpLogs relation
 * @method     ChildMtpQuery rightJoinWithMtpLogs() Adds a RIGHT JOIN clause and with to the query using the MtpLogs relation
 * @method     ChildMtpQuery innerJoinWithMtpLogs() Adds a INNER JOIN clause and with to the query using the MtpLogs relation
 *
 * @method     ChildMtpQuery leftJoinTourplans($relationAlias = null) Adds a LEFT JOIN clause to the query using the Tourplans relation
 * @method     ChildMtpQuery rightJoinTourplans($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Tourplans relation
 * @method     ChildMtpQuery innerJoinTourplans($relationAlias = null) Adds a INNER JOIN clause to the query using the Tourplans relation
 *
 * @method     ChildMtpQuery joinWithTourplans($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Tourplans relation
 *
 * @method     ChildMtpQuery leftJoinWithTourplans() Adds a LEFT JOIN clause and with to the query using the Tourplans relation
 * @method     ChildMtpQuery rightJoinWithTourplans() Adds a RIGHT JOIN clause and with to the query using the Tourplans relation
 * @method     ChildMtpQuery innerJoinWithTourplans() Adds a INNER JOIN clause and with to the query using the Tourplans relation
 *
 * @method     \entities\CompanyQuery|\entities\EmployeeQuery|\entities\PositionsQuery|\entities\MtpDayQuery|\entities\MtpLogsQuery|\entities\TourplansQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildMtp|null findOne(?ConnectionInterface $con = null) Return the first ChildMtp matching the query
 * @method     ChildMtp findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildMtp matching the query, or a new ChildMtp object populated from the query conditions when no match is found
 *
 * @method     ChildMtp|null findOneByMtpId(int $mtp_id) Return the first ChildMtp filtered by the mtp_id column
 * @method     ChildMtp|null findOneByPositionId(int $position_id) Return the first ChildMtp filtered by the position_id column
 * @method     ChildMtp|null findOneByCompanyId(int $company_id) Return the first ChildMtp filtered by the company_id column
 * @method     ChildMtp|null findOneByMonth(string $month) Return the first ChildMtp filtered by the month column
 * @method     ChildMtp|null findOneByMtpStatus(string $mtp_status) Return the first ChildMtp filtered by the mtp_status column
 * @method     ChildMtp|null findOneByMtpApprovedBy(int $mtp_approved_by) Return the first ChildMtp filtered by the mtp_approved_by column
 * @method     ChildMtp|null findOneByApprovedDate(string $approved_date) Return the first ChildMtp filtered by the approved_date column
 * @method     ChildMtp|null findOneByCreatedAt(string $created_at) Return the first ChildMtp filtered by the created_at column
 * @method     ChildMtp|null findOneByUpdatedAt(string $updated_at) Return the first ChildMtp filtered by the updated_at column
 * @method     ChildMtp|null findOneByOutletsCovered(int $outlets_covered) Return the first ChildMtp filtered by the outlets_covered column
 * @method     ChildMtp|null findOneByMonthDays(int $month_days) Return the first ChildMtp filtered by the month_days column
 * @method     ChildMtp|null findOneByWorkingDays(int $working_days) Return the first ChildMtp filtered by the working_days column
 * @method     ChildMtp|null findOneByAgendaDays(string $agenda_days) Return the first ChildMtp filtered by the agenda_days column
 * @method     ChildMtp|null findOneByTotalOutlets(string $total_outlets) Return the first ChildMtp filtered by the total_outlets column
 * @method     ChildMtp|null findOneByTotalVisits(int $total_visits) Return the first ChildMtp filtered by the total_visits column
 * @method     ChildMtp|null findOneByVisitsFq(int $visits_fq) Return the first ChildMtp filtered by the visits_fq column
 * @method     ChildMtp|null findOneByIsProcessed(boolean $is_processed) Return the first ChildMtp filtered by the is_processed column
 * @method     ChildMtp|null findOneByIsMtpGenerating(boolean $is_mtp_generating) Return the first ChildMtp filtered by the is_mtp_generating column
 *
 * @method     ChildMtp requirePk($key, ?ConnectionInterface $con = null) Return the ChildMtp by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMtp requireOne(?ConnectionInterface $con = null) Return the first ChildMtp matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildMtp requireOneByMtpId(int $mtp_id) Return the first ChildMtp filtered by the mtp_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMtp requireOneByPositionId(int $position_id) Return the first ChildMtp filtered by the position_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMtp requireOneByCompanyId(int $company_id) Return the first ChildMtp filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMtp requireOneByMonth(string $month) Return the first ChildMtp filtered by the month column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMtp requireOneByMtpStatus(string $mtp_status) Return the first ChildMtp filtered by the mtp_status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMtp requireOneByMtpApprovedBy(int $mtp_approved_by) Return the first ChildMtp filtered by the mtp_approved_by column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMtp requireOneByApprovedDate(string $approved_date) Return the first ChildMtp filtered by the approved_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMtp requireOneByCreatedAt(string $created_at) Return the first ChildMtp filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMtp requireOneByUpdatedAt(string $updated_at) Return the first ChildMtp filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMtp requireOneByOutletsCovered(int $outlets_covered) Return the first ChildMtp filtered by the outlets_covered column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMtp requireOneByMonthDays(int $month_days) Return the first ChildMtp filtered by the month_days column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMtp requireOneByWorkingDays(int $working_days) Return the first ChildMtp filtered by the working_days column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMtp requireOneByAgendaDays(string $agenda_days) Return the first ChildMtp filtered by the agenda_days column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMtp requireOneByTotalOutlets(string $total_outlets) Return the first ChildMtp filtered by the total_outlets column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMtp requireOneByTotalVisits(int $total_visits) Return the first ChildMtp filtered by the total_visits column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMtp requireOneByVisitsFq(int $visits_fq) Return the first ChildMtp filtered by the visits_fq column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMtp requireOneByIsProcessed(boolean $is_processed) Return the first ChildMtp filtered by the is_processed column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMtp requireOneByIsMtpGenerating(boolean $is_mtp_generating) Return the first ChildMtp filtered by the is_mtp_generating column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildMtp[]|Collection find(?ConnectionInterface $con = null) Return ChildMtp objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildMtp> find(?ConnectionInterface $con = null) Return ChildMtp objects based on current ModelCriteria
 *
 * @method     ChildMtp[]|Collection findByMtpId(int|array<int> $mtp_id) Return ChildMtp objects filtered by the mtp_id column
 * @psalm-method Collection&\Traversable<ChildMtp> findByMtpId(int|array<int> $mtp_id) Return ChildMtp objects filtered by the mtp_id column
 * @method     ChildMtp[]|Collection findByPositionId(int|array<int> $position_id) Return ChildMtp objects filtered by the position_id column
 * @psalm-method Collection&\Traversable<ChildMtp> findByPositionId(int|array<int> $position_id) Return ChildMtp objects filtered by the position_id column
 * @method     ChildMtp[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildMtp objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildMtp> findByCompanyId(int|array<int> $company_id) Return ChildMtp objects filtered by the company_id column
 * @method     ChildMtp[]|Collection findByMonth(string|array<string> $month) Return ChildMtp objects filtered by the month column
 * @psalm-method Collection&\Traversable<ChildMtp> findByMonth(string|array<string> $month) Return ChildMtp objects filtered by the month column
 * @method     ChildMtp[]|Collection findByMtpStatus(string|array<string> $mtp_status) Return ChildMtp objects filtered by the mtp_status column
 * @psalm-method Collection&\Traversable<ChildMtp> findByMtpStatus(string|array<string> $mtp_status) Return ChildMtp objects filtered by the mtp_status column
 * @method     ChildMtp[]|Collection findByMtpApprovedBy(int|array<int> $mtp_approved_by) Return ChildMtp objects filtered by the mtp_approved_by column
 * @psalm-method Collection&\Traversable<ChildMtp> findByMtpApprovedBy(int|array<int> $mtp_approved_by) Return ChildMtp objects filtered by the mtp_approved_by column
 * @method     ChildMtp[]|Collection findByApprovedDate(string|array<string> $approved_date) Return ChildMtp objects filtered by the approved_date column
 * @psalm-method Collection&\Traversable<ChildMtp> findByApprovedDate(string|array<string> $approved_date) Return ChildMtp objects filtered by the approved_date column
 * @method     ChildMtp[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildMtp objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildMtp> findByCreatedAt(string|array<string> $created_at) Return ChildMtp objects filtered by the created_at column
 * @method     ChildMtp[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildMtp objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildMtp> findByUpdatedAt(string|array<string> $updated_at) Return ChildMtp objects filtered by the updated_at column
 * @method     ChildMtp[]|Collection findByOutletsCovered(int|array<int> $outlets_covered) Return ChildMtp objects filtered by the outlets_covered column
 * @psalm-method Collection&\Traversable<ChildMtp> findByOutletsCovered(int|array<int> $outlets_covered) Return ChildMtp objects filtered by the outlets_covered column
 * @method     ChildMtp[]|Collection findByMonthDays(int|array<int> $month_days) Return ChildMtp objects filtered by the month_days column
 * @psalm-method Collection&\Traversable<ChildMtp> findByMonthDays(int|array<int> $month_days) Return ChildMtp objects filtered by the month_days column
 * @method     ChildMtp[]|Collection findByWorkingDays(int|array<int> $working_days) Return ChildMtp objects filtered by the working_days column
 * @psalm-method Collection&\Traversable<ChildMtp> findByWorkingDays(int|array<int> $working_days) Return ChildMtp objects filtered by the working_days column
 * @method     ChildMtp[]|Collection findByAgendaDays(string|array<string> $agenda_days) Return ChildMtp objects filtered by the agenda_days column
 * @psalm-method Collection&\Traversable<ChildMtp> findByAgendaDays(string|array<string> $agenda_days) Return ChildMtp objects filtered by the agenda_days column
 * @method     ChildMtp[]|Collection findByTotalOutlets(string|array<string> $total_outlets) Return ChildMtp objects filtered by the total_outlets column
 * @psalm-method Collection&\Traversable<ChildMtp> findByTotalOutlets(string|array<string> $total_outlets) Return ChildMtp objects filtered by the total_outlets column
 * @method     ChildMtp[]|Collection findByTotalVisits(int|array<int> $total_visits) Return ChildMtp objects filtered by the total_visits column
 * @psalm-method Collection&\Traversable<ChildMtp> findByTotalVisits(int|array<int> $total_visits) Return ChildMtp objects filtered by the total_visits column
 * @method     ChildMtp[]|Collection findByVisitsFq(int|array<int> $visits_fq) Return ChildMtp objects filtered by the visits_fq column
 * @psalm-method Collection&\Traversable<ChildMtp> findByVisitsFq(int|array<int> $visits_fq) Return ChildMtp objects filtered by the visits_fq column
 * @method     ChildMtp[]|Collection findByIsProcessed(boolean|array<boolean> $is_processed) Return ChildMtp objects filtered by the is_processed column
 * @psalm-method Collection&\Traversable<ChildMtp> findByIsProcessed(boolean|array<boolean> $is_processed) Return ChildMtp objects filtered by the is_processed column
 * @method     ChildMtp[]|Collection findByIsMtpGenerating(boolean|array<boolean> $is_mtp_generating) Return ChildMtp objects filtered by the is_mtp_generating column
 * @psalm-method Collection&\Traversable<ChildMtp> findByIsMtpGenerating(boolean|array<boolean> $is_mtp_generating) Return ChildMtp objects filtered by the is_mtp_generating column
 *
 * @method     ChildMtp[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildMtp> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class MtpQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\MtpQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\Mtp', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildMtpQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildMtpQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildMtpQuery) {
            return $criteria;
        }
        $query = new ChildMtpQuery();
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
     * @return ChildMtp|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(MtpTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = MtpTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildMtp A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT mtp_id, position_id, company_id, month, mtp_status, mtp_approved_by, approved_date, created_at, updated_at, outlets_covered, month_days, working_days, agenda_days, total_outlets, total_visits, visits_fq, is_processed, is_mtp_generating FROM mtp WHERE mtp_id = :p0';
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
            /** @var ChildMtp $obj */
            $obj = new ChildMtp();
            $obj->hydrate($row);
            MtpTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildMtp|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(MtpTableMap::COL_MTP_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(MtpTableMap::COL_MTP_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the mtp_id column
     *
     * Example usage:
     * <code>
     * $query->filterByMtpId(1234); // WHERE mtp_id = 1234
     * $query->filterByMtpId(array(12, 34)); // WHERE mtp_id IN (12, 34)
     * $query->filterByMtpId(array('min' => 12)); // WHERE mtp_id > 12
     * </code>
     *
     * @param mixed $mtpId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMtpId($mtpId = null, ?string $comparison = null)
    {
        if (is_array($mtpId)) {
            $useMinMax = false;
            if (isset($mtpId['min'])) {
                $this->addUsingAlias(MtpTableMap::COL_MTP_ID, $mtpId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($mtpId['max'])) {
                $this->addUsingAlias(MtpTableMap::COL_MTP_ID, $mtpId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MtpTableMap::COL_MTP_ID, $mtpId, $comparison);

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
                $this->addUsingAlias(MtpTableMap::COL_POSITION_ID, $positionId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($positionId['max'])) {
                $this->addUsingAlias(MtpTableMap::COL_POSITION_ID, $positionId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MtpTableMap::COL_POSITION_ID, $positionId, $comparison);

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
                $this->addUsingAlias(MtpTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(MtpTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MtpTableMap::COL_COMPANY_ID, $companyId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the month column
     *
     * Example usage:
     * <code>
     * $query->filterByMonth('fooValue');   // WHERE month = 'fooValue'
     * $query->filterByMonth('%fooValue%', Criteria::LIKE); // WHERE month LIKE '%fooValue%'
     * $query->filterByMonth(['foo', 'bar']); // WHERE month IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $month The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMonth($month = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($month)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MtpTableMap::COL_MONTH, $month, $comparison);

        return $this;
    }

    /**
     * Filter the query on the mtp_status column
     *
     * Example usage:
     * <code>
     * $query->filterByMtpStatus('fooValue');   // WHERE mtp_status = 'fooValue'
     * $query->filterByMtpStatus('%fooValue%', Criteria::LIKE); // WHERE mtp_status LIKE '%fooValue%'
     * $query->filterByMtpStatus(['foo', 'bar']); // WHERE mtp_status IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $mtpStatus The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMtpStatus($mtpStatus = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($mtpStatus)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MtpTableMap::COL_MTP_STATUS, $mtpStatus, $comparison);

        return $this;
    }

    /**
     * Filter the query on the mtp_approved_by column
     *
     * Example usage:
     * <code>
     * $query->filterByMtpApprovedBy(1234); // WHERE mtp_approved_by = 1234
     * $query->filterByMtpApprovedBy(array(12, 34)); // WHERE mtp_approved_by IN (12, 34)
     * $query->filterByMtpApprovedBy(array('min' => 12)); // WHERE mtp_approved_by > 12
     * </code>
     *
     * @see       filterByEmployee()
     *
     * @param mixed $mtpApprovedBy The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMtpApprovedBy($mtpApprovedBy = null, ?string $comparison = null)
    {
        if (is_array($mtpApprovedBy)) {
            $useMinMax = false;
            if (isset($mtpApprovedBy['min'])) {
                $this->addUsingAlias(MtpTableMap::COL_MTP_APPROVED_BY, $mtpApprovedBy['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($mtpApprovedBy['max'])) {
                $this->addUsingAlias(MtpTableMap::COL_MTP_APPROVED_BY, $mtpApprovedBy['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MtpTableMap::COL_MTP_APPROVED_BY, $mtpApprovedBy, $comparison);

        return $this;
    }

    /**
     * Filter the query on the approved_date column
     *
     * Example usage:
     * <code>
     * $query->filterByApprovedDate('2011-03-14'); // WHERE approved_date = '2011-03-14'
     * $query->filterByApprovedDate('now'); // WHERE approved_date = '2011-03-14'
     * $query->filterByApprovedDate(array('max' => 'yesterday')); // WHERE approved_date > '2011-03-13'
     * </code>
     *
     * @param mixed $approvedDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByApprovedDate($approvedDate = null, ?string $comparison = null)
    {
        if (is_array($approvedDate)) {
            $useMinMax = false;
            if (isset($approvedDate['min'])) {
                $this->addUsingAlias(MtpTableMap::COL_APPROVED_DATE, $approvedDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($approvedDate['max'])) {
                $this->addUsingAlias(MtpTableMap::COL_APPROVED_DATE, $approvedDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MtpTableMap::COL_APPROVED_DATE, $approvedDate, $comparison);

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
                $this->addUsingAlias(MtpTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(MtpTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MtpTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(MtpTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(MtpTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MtpTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlets_covered column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletsCovered(1234); // WHERE outlets_covered = 1234
     * $query->filterByOutletsCovered(array(12, 34)); // WHERE outlets_covered IN (12, 34)
     * $query->filterByOutletsCovered(array('min' => 12)); // WHERE outlets_covered > 12
     * </code>
     *
     * @param mixed $outletsCovered The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletsCovered($outletsCovered = null, ?string $comparison = null)
    {
        if (is_array($outletsCovered)) {
            $useMinMax = false;
            if (isset($outletsCovered['min'])) {
                $this->addUsingAlias(MtpTableMap::COL_OUTLETS_COVERED, $outletsCovered['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outletsCovered['max'])) {
                $this->addUsingAlias(MtpTableMap::COL_OUTLETS_COVERED, $outletsCovered['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MtpTableMap::COL_OUTLETS_COVERED, $outletsCovered, $comparison);

        return $this;
    }

    /**
     * Filter the query on the month_days column
     *
     * Example usage:
     * <code>
     * $query->filterByMonthDays(1234); // WHERE month_days = 1234
     * $query->filterByMonthDays(array(12, 34)); // WHERE month_days IN (12, 34)
     * $query->filterByMonthDays(array('min' => 12)); // WHERE month_days > 12
     * </code>
     *
     * @param mixed $monthDays The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMonthDays($monthDays = null, ?string $comparison = null)
    {
        if (is_array($monthDays)) {
            $useMinMax = false;
            if (isset($monthDays['min'])) {
                $this->addUsingAlias(MtpTableMap::COL_MONTH_DAYS, $monthDays['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($monthDays['max'])) {
                $this->addUsingAlias(MtpTableMap::COL_MONTH_DAYS, $monthDays['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MtpTableMap::COL_MONTH_DAYS, $monthDays, $comparison);

        return $this;
    }

    /**
     * Filter the query on the working_days column
     *
     * Example usage:
     * <code>
     * $query->filterByWorkingDays(1234); // WHERE working_days = 1234
     * $query->filterByWorkingDays(array(12, 34)); // WHERE working_days IN (12, 34)
     * $query->filterByWorkingDays(array('min' => 12)); // WHERE working_days > 12
     * </code>
     *
     * @param mixed $workingDays The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWorkingDays($workingDays = null, ?string $comparison = null)
    {
        if (is_array($workingDays)) {
            $useMinMax = false;
            if (isset($workingDays['min'])) {
                $this->addUsingAlias(MtpTableMap::COL_WORKING_DAYS, $workingDays['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($workingDays['max'])) {
                $this->addUsingAlias(MtpTableMap::COL_WORKING_DAYS, $workingDays['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MtpTableMap::COL_WORKING_DAYS, $workingDays, $comparison);

        return $this;
    }

    /**
     * Filter the query on the agenda_days column
     *
     * Example usage:
     * <code>
     * $query->filterByAgendaDays('fooValue');   // WHERE agenda_days = 'fooValue'
     * $query->filterByAgendaDays('%fooValue%', Criteria::LIKE); // WHERE agenda_days LIKE '%fooValue%'
     * $query->filterByAgendaDays(['foo', 'bar']); // WHERE agenda_days IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $agendaDays The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAgendaDays($agendaDays = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($agendaDays)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MtpTableMap::COL_AGENDA_DAYS, $agendaDays, $comparison);

        return $this;
    }

    /**
     * Filter the query on the total_outlets column
     *
     * Example usage:
     * <code>
     * $query->filterByTotalOutlets('fooValue');   // WHERE total_outlets = 'fooValue'
     * $query->filterByTotalOutlets('%fooValue%', Criteria::LIKE); // WHERE total_outlets LIKE '%fooValue%'
     * $query->filterByTotalOutlets(['foo', 'bar']); // WHERE total_outlets IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $totalOutlets The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTotalOutlets($totalOutlets = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($totalOutlets)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MtpTableMap::COL_TOTAL_OUTLETS, $totalOutlets, $comparison);

        return $this;
    }

    /**
     * Filter the query on the total_visits column
     *
     * Example usage:
     * <code>
     * $query->filterByTotalVisits(1234); // WHERE total_visits = 1234
     * $query->filterByTotalVisits(array(12, 34)); // WHERE total_visits IN (12, 34)
     * $query->filterByTotalVisits(array('min' => 12)); // WHERE total_visits > 12
     * </code>
     *
     * @param mixed $totalVisits The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTotalVisits($totalVisits = null, ?string $comparison = null)
    {
        if (is_array($totalVisits)) {
            $useMinMax = false;
            if (isset($totalVisits['min'])) {
                $this->addUsingAlias(MtpTableMap::COL_TOTAL_VISITS, $totalVisits['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($totalVisits['max'])) {
                $this->addUsingAlias(MtpTableMap::COL_TOTAL_VISITS, $totalVisits['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MtpTableMap::COL_TOTAL_VISITS, $totalVisits, $comparison);

        return $this;
    }

    /**
     * Filter the query on the visits_fq column
     *
     * Example usage:
     * <code>
     * $query->filterByVisitsFq(1234); // WHERE visits_fq = 1234
     * $query->filterByVisitsFq(array(12, 34)); // WHERE visits_fq IN (12, 34)
     * $query->filterByVisitsFq(array('min' => 12)); // WHERE visits_fq > 12
     * </code>
     *
     * @param mixed $visitsFq The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByVisitsFq($visitsFq = null, ?string $comparison = null)
    {
        if (is_array($visitsFq)) {
            $useMinMax = false;
            if (isset($visitsFq['min'])) {
                $this->addUsingAlias(MtpTableMap::COL_VISITS_FQ, $visitsFq['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($visitsFq['max'])) {
                $this->addUsingAlias(MtpTableMap::COL_VISITS_FQ, $visitsFq['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MtpTableMap::COL_VISITS_FQ, $visitsFq, $comparison);

        return $this;
    }

    /**
     * Filter the query on the is_processed column
     *
     * Example usage:
     * <code>
     * $query->filterByIsProcessed(true); // WHERE is_processed = true
     * $query->filterByIsProcessed('yes'); // WHERE is_processed = true
     * </code>
     *
     * @param bool|string $isProcessed The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIsProcessed($isProcessed = null, ?string $comparison = null)
    {
        if (is_string($isProcessed)) {
            $isProcessed = in_array(strtolower($isProcessed), array('false', 'off', '-', 'no', 'n', '0', ''), true) ? false : true;
        }

        $this->addUsingAlias(MtpTableMap::COL_IS_PROCESSED, $isProcessed, $comparison);

        return $this;
    }

    /**
     * Filter the query on the is_mtp_generating column
     *
     * Example usage:
     * <code>
     * $query->filterByIsMtpGenerating(true); // WHERE is_mtp_generating = true
     * $query->filterByIsMtpGenerating('yes'); // WHERE is_mtp_generating = true
     * </code>
     *
     * @param bool|string $isMtpGenerating The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIsMtpGenerating($isMtpGenerating = null, ?string $comparison = null)
    {
        if (is_string($isMtpGenerating)) {
            $isMtpGenerating = in_array(strtolower($isMtpGenerating), array('false', 'off', '-', 'no', 'n', '0', ''), true) ? false : true;
        }

        $this->addUsingAlias(MtpTableMap::COL_IS_MTP_GENERATING, $isMtpGenerating, $comparison);

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
                ->addUsingAlias(MtpTableMap::COL_COMPANY_ID, $company->getCompanyId(), $comparison);
        } elseif ($company instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(MtpTableMap::COL_COMPANY_ID, $company->toKeyValue('PrimaryKey', 'CompanyId'), $comparison);

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
     * Filter the query by a related \entities\Employee object
     *
     * @param \entities\Employee|ObjectCollection $employee The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmployee($employee, ?string $comparison = null)
    {
        if ($employee instanceof \entities\Employee) {
            return $this
                ->addUsingAlias(MtpTableMap::COL_MTP_APPROVED_BY, $employee->getEmployeeId(), $comparison);
        } elseif ($employee instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(MtpTableMap::COL_MTP_APPROVED_BY, $employee->toKeyValue('PrimaryKey', 'EmployeeId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByEmployee() only accepts arguments of type \entities\Employee or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Employee relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinEmployee(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Employee');

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
            $this->addJoinObject($join, 'Employee');
        }

        return $this;
    }

    /**
     * Use the Employee relation Employee object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\EmployeeQuery A secondary query class using the current class as primary query
     */
    public function useEmployeeQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinEmployee($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Employee', '\entities\EmployeeQuery');
    }

    /**
     * Use the Employee relation Employee object
     *
     * @param callable(\entities\EmployeeQuery):\entities\EmployeeQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withEmployeeQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useEmployeeQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Employee table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\EmployeeQuery The inner query object of the EXISTS statement
     */
    public function useEmployeeExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\EmployeeQuery */
        $q = $this->useExistsQuery('Employee', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Employee table for a NOT EXISTS query.
     *
     * @see useEmployeeExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\EmployeeQuery The inner query object of the NOT EXISTS statement
     */
    public function useEmployeeNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\EmployeeQuery */
        $q = $this->useExistsQuery('Employee', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Employee table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\EmployeeQuery The inner query object of the IN statement
     */
    public function useInEmployeeQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\EmployeeQuery */
        $q = $this->useInQuery('Employee', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Employee table for a NOT IN query.
     *
     * @see useEmployeeInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\EmployeeQuery The inner query object of the NOT IN statement
     */
    public function useNotInEmployeeQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\EmployeeQuery */
        $q = $this->useInQuery('Employee', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(MtpTableMap::COL_POSITION_ID, $positions->getPositionId(), $comparison);
        } elseif ($positions instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(MtpTableMap::COL_POSITION_ID, $positions->toKeyValue('PrimaryKey', 'PositionId'), $comparison);

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
    public function joinPositions(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
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
    public function usePositionsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
        ?string $joinType = Criteria::INNER_JOIN
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
     * Filter the query by a related \entities\MtpDay object
     *
     * @param \entities\MtpDay|ObjectCollection $mtpDay the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMtpDay($mtpDay, ?string $comparison = null)
    {
        if ($mtpDay instanceof \entities\MtpDay) {
            $this
                ->addUsingAlias(MtpTableMap::COL_MTP_ID, $mtpDay->getMtpId(), $comparison);

            return $this;
        } elseif ($mtpDay instanceof ObjectCollection) {
            $this
                ->useMtpDayQuery()
                ->filterByPrimaryKeys($mtpDay->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByMtpDay() only accepts arguments of type \entities\MtpDay or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the MtpDay relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinMtpDay(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('MtpDay');

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
            $this->addJoinObject($join, 'MtpDay');
        }

        return $this;
    }

    /**
     * Use the MtpDay relation MtpDay object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\MtpDayQuery A secondary query class using the current class as primary query
     */
    public function useMtpDayQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinMtpDay($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'MtpDay', '\entities\MtpDayQuery');
    }

    /**
     * Use the MtpDay relation MtpDay object
     *
     * @param callable(\entities\MtpDayQuery):\entities\MtpDayQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withMtpDayQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useMtpDayQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to MtpDay table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\MtpDayQuery The inner query object of the EXISTS statement
     */
    public function useMtpDayExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\MtpDayQuery */
        $q = $this->useExistsQuery('MtpDay', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to MtpDay table for a NOT EXISTS query.
     *
     * @see useMtpDayExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\MtpDayQuery The inner query object of the NOT EXISTS statement
     */
    public function useMtpDayNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\MtpDayQuery */
        $q = $this->useExistsQuery('MtpDay', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to MtpDay table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\MtpDayQuery The inner query object of the IN statement
     */
    public function useInMtpDayQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\MtpDayQuery */
        $q = $this->useInQuery('MtpDay', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to MtpDay table for a NOT IN query.
     *
     * @see useMtpDayInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\MtpDayQuery The inner query object of the NOT IN statement
     */
    public function useNotInMtpDayQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\MtpDayQuery */
        $q = $this->useInQuery('MtpDay', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\MtpLogs object
     *
     * @param \entities\MtpLogs|ObjectCollection $mtpLogs the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMtpLogs($mtpLogs, ?string $comparison = null)
    {
        if ($mtpLogs instanceof \entities\MtpLogs) {
            $this
                ->addUsingAlias(MtpTableMap::COL_MTP_ID, $mtpLogs->getMtpId(), $comparison);

            return $this;
        } elseif ($mtpLogs instanceof ObjectCollection) {
            $this
                ->useMtpLogsQuery()
                ->filterByPrimaryKeys($mtpLogs->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByMtpLogs() only accepts arguments of type \entities\MtpLogs or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the MtpLogs relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinMtpLogs(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('MtpLogs');

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
            $this->addJoinObject($join, 'MtpLogs');
        }

        return $this;
    }

    /**
     * Use the MtpLogs relation MtpLogs object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\MtpLogsQuery A secondary query class using the current class as primary query
     */
    public function useMtpLogsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinMtpLogs($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'MtpLogs', '\entities\MtpLogsQuery');
    }

    /**
     * Use the MtpLogs relation MtpLogs object
     *
     * @param callable(\entities\MtpLogsQuery):\entities\MtpLogsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withMtpLogsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useMtpLogsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to MtpLogs table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\MtpLogsQuery The inner query object of the EXISTS statement
     */
    public function useMtpLogsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\MtpLogsQuery */
        $q = $this->useExistsQuery('MtpLogs', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to MtpLogs table for a NOT EXISTS query.
     *
     * @see useMtpLogsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\MtpLogsQuery The inner query object of the NOT EXISTS statement
     */
    public function useMtpLogsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\MtpLogsQuery */
        $q = $this->useExistsQuery('MtpLogs', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to MtpLogs table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\MtpLogsQuery The inner query object of the IN statement
     */
    public function useInMtpLogsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\MtpLogsQuery */
        $q = $this->useInQuery('MtpLogs', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to MtpLogs table for a NOT IN query.
     *
     * @see useMtpLogsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\MtpLogsQuery The inner query object of the NOT IN statement
     */
    public function useNotInMtpLogsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\MtpLogsQuery */
        $q = $this->useInQuery('MtpLogs', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\Tourplans object
     *
     * @param \entities\Tourplans|ObjectCollection $tourplans the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTourplans($tourplans, ?string $comparison = null)
    {
        if ($tourplans instanceof \entities\Tourplans) {
            $this
                ->addUsingAlias(MtpTableMap::COL_MTP_ID, $tourplans->getMtpId(), $comparison);

            return $this;
        } elseif ($tourplans instanceof ObjectCollection) {
            $this
                ->useTourplansQuery()
                ->filterByPrimaryKeys($tourplans->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByTourplans() only accepts arguments of type \entities\Tourplans or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Tourplans relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinTourplans(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Tourplans');

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
            $this->addJoinObject($join, 'Tourplans');
        }

        return $this;
    }

    /**
     * Use the Tourplans relation Tourplans object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\TourplansQuery A secondary query class using the current class as primary query
     */
    public function useTourplansQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTourplans($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Tourplans', '\entities\TourplansQuery');
    }

    /**
     * Use the Tourplans relation Tourplans object
     *
     * @param callable(\entities\TourplansQuery):\entities\TourplansQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withTourplansQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useTourplansQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Tourplans table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\TourplansQuery The inner query object of the EXISTS statement
     */
    public function useTourplansExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\TourplansQuery */
        $q = $this->useExistsQuery('Tourplans', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Tourplans table for a NOT EXISTS query.
     *
     * @see useTourplansExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\TourplansQuery The inner query object of the NOT EXISTS statement
     */
    public function useTourplansNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\TourplansQuery */
        $q = $this->useExistsQuery('Tourplans', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Tourplans table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\TourplansQuery The inner query object of the IN statement
     */
    public function useInTourplansQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\TourplansQuery */
        $q = $this->useInQuery('Tourplans', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Tourplans table for a NOT IN query.
     *
     * @see useTourplansInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\TourplansQuery The inner query object of the NOT IN statement
     */
    public function useNotInTourplansQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\TourplansQuery */
        $q = $this->useInQuery('Tourplans', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildMtp $mtp Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($mtp = null)
    {
        if ($mtp) {
            $this->addUsingAlias(MtpTableMap::COL_MTP_ID, $mtp->getMtpId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the mtp table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(MtpTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            MtpTableMap::clearInstancePool();
            MtpTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(MtpTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(MtpTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            MtpTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            MtpTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
