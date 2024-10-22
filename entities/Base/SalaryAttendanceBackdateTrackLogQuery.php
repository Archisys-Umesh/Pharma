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
use entities\SalaryAttendanceBackdateTrackLog as ChildSalaryAttendanceBackdateTrackLog;
use entities\SalaryAttendanceBackdateTrackLogQuery as ChildSalaryAttendanceBackdateTrackLogQuery;
use entities\Map\SalaryAttendanceBackdateTrackLogTableMap;

/**
 * Base class that represents a query for the `salary_attendance_backdate_track_log` table.
 *
 * @method     ChildSalaryAttendanceBackdateTrackLogQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildSalaryAttendanceBackdateTrackLogQuery orderByPreviousFromDate($order = Criteria::ASC) Order by the previous_from_date column
 * @method     ChildSalaryAttendanceBackdateTrackLogQuery orderByPreviousToDate($order = Criteria::ASC) Order by the previous_to_date column
 * @method     ChildSalaryAttendanceBackdateTrackLogQuery orderByPreviousToPreviousFromDate($order = Criteria::ASC) Order by the previous_to_previous_from_date column
 * @method     ChildSalaryAttendanceBackdateTrackLogQuery orderByPreviousToPreviousToDate($order = Criteria::ASC) Order by the previous_to_previous_to_date column
 * @method     ChildSalaryAttendanceBackdateTrackLogQuery orderByBackdatePreviousDeductionDay($order = Criteria::ASC) Order by the backdate_previous_deduction_day column
 * @method     ChildSalaryAttendanceBackdateTrackLogQuery orderByBackdatePreviousDeductionDate($order = Criteria::ASC) Order by the backdate_previous_deduction_date column
 * @method     ChildSalaryAttendanceBackdateTrackLogQuery orderByBackdatePreviousToPreviousDay($order = Criteria::ASC) Order by the backdate_previous_to_previous_day column
 * @method     ChildSalaryAttendanceBackdateTrackLogQuery orderByBackdatePreviousToPreviousDate($order = Criteria::ASC) Order by the backdate_previous_to_previous_date column
 * @method     ChildSalaryAttendanceBackdateTrackLogQuery orderByPaidAmount($order = Criteria::ASC) Order by the paid_amount column
 * @method     ChildSalaryAttendanceBackdateTrackLogQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildSalaryAttendanceBackdateTrackLogQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildSalaryAttendanceBackdateTrackLogQuery orderByEmployeeId($order = Criteria::ASC) Order by the employee_id column
 *
 * @method     ChildSalaryAttendanceBackdateTrackLogQuery groupById() Group by the id column
 * @method     ChildSalaryAttendanceBackdateTrackLogQuery groupByPreviousFromDate() Group by the previous_from_date column
 * @method     ChildSalaryAttendanceBackdateTrackLogQuery groupByPreviousToDate() Group by the previous_to_date column
 * @method     ChildSalaryAttendanceBackdateTrackLogQuery groupByPreviousToPreviousFromDate() Group by the previous_to_previous_from_date column
 * @method     ChildSalaryAttendanceBackdateTrackLogQuery groupByPreviousToPreviousToDate() Group by the previous_to_previous_to_date column
 * @method     ChildSalaryAttendanceBackdateTrackLogQuery groupByBackdatePreviousDeductionDay() Group by the backdate_previous_deduction_day column
 * @method     ChildSalaryAttendanceBackdateTrackLogQuery groupByBackdatePreviousDeductionDate() Group by the backdate_previous_deduction_date column
 * @method     ChildSalaryAttendanceBackdateTrackLogQuery groupByBackdatePreviousToPreviousDay() Group by the backdate_previous_to_previous_day column
 * @method     ChildSalaryAttendanceBackdateTrackLogQuery groupByBackdatePreviousToPreviousDate() Group by the backdate_previous_to_previous_date column
 * @method     ChildSalaryAttendanceBackdateTrackLogQuery groupByPaidAmount() Group by the paid_amount column
 * @method     ChildSalaryAttendanceBackdateTrackLogQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildSalaryAttendanceBackdateTrackLogQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildSalaryAttendanceBackdateTrackLogQuery groupByEmployeeId() Group by the employee_id column
 *
 * @method     ChildSalaryAttendanceBackdateTrackLogQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSalaryAttendanceBackdateTrackLogQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSalaryAttendanceBackdateTrackLogQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSalaryAttendanceBackdateTrackLogQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSalaryAttendanceBackdateTrackLogQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSalaryAttendanceBackdateTrackLogQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSalaryAttendanceBackdateTrackLogQuery leftJoinEmployee($relationAlias = null) Adds a LEFT JOIN clause to the query using the Employee relation
 * @method     ChildSalaryAttendanceBackdateTrackLogQuery rightJoinEmployee($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Employee relation
 * @method     ChildSalaryAttendanceBackdateTrackLogQuery innerJoinEmployee($relationAlias = null) Adds a INNER JOIN clause to the query using the Employee relation
 *
 * @method     ChildSalaryAttendanceBackdateTrackLogQuery joinWithEmployee($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Employee relation
 *
 * @method     ChildSalaryAttendanceBackdateTrackLogQuery leftJoinWithEmployee() Adds a LEFT JOIN clause and with to the query using the Employee relation
 * @method     ChildSalaryAttendanceBackdateTrackLogQuery rightJoinWithEmployee() Adds a RIGHT JOIN clause and with to the query using the Employee relation
 * @method     ChildSalaryAttendanceBackdateTrackLogQuery innerJoinWithEmployee() Adds a INNER JOIN clause and with to the query using the Employee relation
 *
 * @method     \entities\EmployeeQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSalaryAttendanceBackdateTrackLog|null findOne(?ConnectionInterface $con = null) Return the first ChildSalaryAttendanceBackdateTrackLog matching the query
 * @method     ChildSalaryAttendanceBackdateTrackLog findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSalaryAttendanceBackdateTrackLog matching the query, or a new ChildSalaryAttendanceBackdateTrackLog object populated from the query conditions when no match is found
 *
 * @method     ChildSalaryAttendanceBackdateTrackLog|null findOneById(int $id) Return the first ChildSalaryAttendanceBackdateTrackLog filtered by the id column
 * @method     ChildSalaryAttendanceBackdateTrackLog|null findOneByPreviousFromDate(string $previous_from_date) Return the first ChildSalaryAttendanceBackdateTrackLog filtered by the previous_from_date column
 * @method     ChildSalaryAttendanceBackdateTrackLog|null findOneByPreviousToDate(string $previous_to_date) Return the first ChildSalaryAttendanceBackdateTrackLog filtered by the previous_to_date column
 * @method     ChildSalaryAttendanceBackdateTrackLog|null findOneByPreviousToPreviousFromDate(string $previous_to_previous_from_date) Return the first ChildSalaryAttendanceBackdateTrackLog filtered by the previous_to_previous_from_date column
 * @method     ChildSalaryAttendanceBackdateTrackLog|null findOneByPreviousToPreviousToDate(string $previous_to_previous_to_date) Return the first ChildSalaryAttendanceBackdateTrackLog filtered by the previous_to_previous_to_date column
 * @method     ChildSalaryAttendanceBackdateTrackLog|null findOneByBackdatePreviousDeductionDay(int $backdate_previous_deduction_day) Return the first ChildSalaryAttendanceBackdateTrackLog filtered by the backdate_previous_deduction_day column
 * @method     ChildSalaryAttendanceBackdateTrackLog|null findOneByBackdatePreviousDeductionDate(string $backdate_previous_deduction_date) Return the first ChildSalaryAttendanceBackdateTrackLog filtered by the backdate_previous_deduction_date column
 * @method     ChildSalaryAttendanceBackdateTrackLog|null findOneByBackdatePreviousToPreviousDay(int $backdate_previous_to_previous_day) Return the first ChildSalaryAttendanceBackdateTrackLog filtered by the backdate_previous_to_previous_day column
 * @method     ChildSalaryAttendanceBackdateTrackLog|null findOneByBackdatePreviousToPreviousDate(string $backdate_previous_to_previous_date) Return the first ChildSalaryAttendanceBackdateTrackLog filtered by the backdate_previous_to_previous_date column
 * @method     ChildSalaryAttendanceBackdateTrackLog|null findOneByPaidAmount(string $paid_amount) Return the first ChildSalaryAttendanceBackdateTrackLog filtered by the paid_amount column
 * @method     ChildSalaryAttendanceBackdateTrackLog|null findOneByCreatedAt(string $created_at) Return the first ChildSalaryAttendanceBackdateTrackLog filtered by the created_at column
 * @method     ChildSalaryAttendanceBackdateTrackLog|null findOneByUpdatedAt(string $updated_at) Return the first ChildSalaryAttendanceBackdateTrackLog filtered by the updated_at column
 * @method     ChildSalaryAttendanceBackdateTrackLog|null findOneByEmployeeId(int $employee_id) Return the first ChildSalaryAttendanceBackdateTrackLog filtered by the employee_id column
 *
 * @method     ChildSalaryAttendanceBackdateTrackLog requirePk($key, ?ConnectionInterface $con = null) Return the ChildSalaryAttendanceBackdateTrackLog by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSalaryAttendanceBackdateTrackLog requireOne(?ConnectionInterface $con = null) Return the first ChildSalaryAttendanceBackdateTrackLog matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSalaryAttendanceBackdateTrackLog requireOneById(int $id) Return the first ChildSalaryAttendanceBackdateTrackLog filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSalaryAttendanceBackdateTrackLog requireOneByPreviousFromDate(string $previous_from_date) Return the first ChildSalaryAttendanceBackdateTrackLog filtered by the previous_from_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSalaryAttendanceBackdateTrackLog requireOneByPreviousToDate(string $previous_to_date) Return the first ChildSalaryAttendanceBackdateTrackLog filtered by the previous_to_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSalaryAttendanceBackdateTrackLog requireOneByPreviousToPreviousFromDate(string $previous_to_previous_from_date) Return the first ChildSalaryAttendanceBackdateTrackLog filtered by the previous_to_previous_from_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSalaryAttendanceBackdateTrackLog requireOneByPreviousToPreviousToDate(string $previous_to_previous_to_date) Return the first ChildSalaryAttendanceBackdateTrackLog filtered by the previous_to_previous_to_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSalaryAttendanceBackdateTrackLog requireOneByBackdatePreviousDeductionDay(int $backdate_previous_deduction_day) Return the first ChildSalaryAttendanceBackdateTrackLog filtered by the backdate_previous_deduction_day column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSalaryAttendanceBackdateTrackLog requireOneByBackdatePreviousDeductionDate(string $backdate_previous_deduction_date) Return the first ChildSalaryAttendanceBackdateTrackLog filtered by the backdate_previous_deduction_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSalaryAttendanceBackdateTrackLog requireOneByBackdatePreviousToPreviousDay(int $backdate_previous_to_previous_day) Return the first ChildSalaryAttendanceBackdateTrackLog filtered by the backdate_previous_to_previous_day column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSalaryAttendanceBackdateTrackLog requireOneByBackdatePreviousToPreviousDate(string $backdate_previous_to_previous_date) Return the first ChildSalaryAttendanceBackdateTrackLog filtered by the backdate_previous_to_previous_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSalaryAttendanceBackdateTrackLog requireOneByPaidAmount(string $paid_amount) Return the first ChildSalaryAttendanceBackdateTrackLog filtered by the paid_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSalaryAttendanceBackdateTrackLog requireOneByCreatedAt(string $created_at) Return the first ChildSalaryAttendanceBackdateTrackLog filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSalaryAttendanceBackdateTrackLog requireOneByUpdatedAt(string $updated_at) Return the first ChildSalaryAttendanceBackdateTrackLog filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSalaryAttendanceBackdateTrackLog requireOneByEmployeeId(int $employee_id) Return the first ChildSalaryAttendanceBackdateTrackLog filtered by the employee_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSalaryAttendanceBackdateTrackLog[]|Collection find(?ConnectionInterface $con = null) Return ChildSalaryAttendanceBackdateTrackLog objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSalaryAttendanceBackdateTrackLog> find(?ConnectionInterface $con = null) Return ChildSalaryAttendanceBackdateTrackLog objects based on current ModelCriteria
 *
 * @method     ChildSalaryAttendanceBackdateTrackLog[]|Collection findById(int|array<int> $id) Return ChildSalaryAttendanceBackdateTrackLog objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildSalaryAttendanceBackdateTrackLog> findById(int|array<int> $id) Return ChildSalaryAttendanceBackdateTrackLog objects filtered by the id column
 * @method     ChildSalaryAttendanceBackdateTrackLog[]|Collection findByPreviousFromDate(string|array<string> $previous_from_date) Return ChildSalaryAttendanceBackdateTrackLog objects filtered by the previous_from_date column
 * @psalm-method Collection&\Traversable<ChildSalaryAttendanceBackdateTrackLog> findByPreviousFromDate(string|array<string> $previous_from_date) Return ChildSalaryAttendanceBackdateTrackLog objects filtered by the previous_from_date column
 * @method     ChildSalaryAttendanceBackdateTrackLog[]|Collection findByPreviousToDate(string|array<string> $previous_to_date) Return ChildSalaryAttendanceBackdateTrackLog objects filtered by the previous_to_date column
 * @psalm-method Collection&\Traversable<ChildSalaryAttendanceBackdateTrackLog> findByPreviousToDate(string|array<string> $previous_to_date) Return ChildSalaryAttendanceBackdateTrackLog objects filtered by the previous_to_date column
 * @method     ChildSalaryAttendanceBackdateTrackLog[]|Collection findByPreviousToPreviousFromDate(string|array<string> $previous_to_previous_from_date) Return ChildSalaryAttendanceBackdateTrackLog objects filtered by the previous_to_previous_from_date column
 * @psalm-method Collection&\Traversable<ChildSalaryAttendanceBackdateTrackLog> findByPreviousToPreviousFromDate(string|array<string> $previous_to_previous_from_date) Return ChildSalaryAttendanceBackdateTrackLog objects filtered by the previous_to_previous_from_date column
 * @method     ChildSalaryAttendanceBackdateTrackLog[]|Collection findByPreviousToPreviousToDate(string|array<string> $previous_to_previous_to_date) Return ChildSalaryAttendanceBackdateTrackLog objects filtered by the previous_to_previous_to_date column
 * @psalm-method Collection&\Traversable<ChildSalaryAttendanceBackdateTrackLog> findByPreviousToPreviousToDate(string|array<string> $previous_to_previous_to_date) Return ChildSalaryAttendanceBackdateTrackLog objects filtered by the previous_to_previous_to_date column
 * @method     ChildSalaryAttendanceBackdateTrackLog[]|Collection findByBackdatePreviousDeductionDay(int|array<int> $backdate_previous_deduction_day) Return ChildSalaryAttendanceBackdateTrackLog objects filtered by the backdate_previous_deduction_day column
 * @psalm-method Collection&\Traversable<ChildSalaryAttendanceBackdateTrackLog> findByBackdatePreviousDeductionDay(int|array<int> $backdate_previous_deduction_day) Return ChildSalaryAttendanceBackdateTrackLog objects filtered by the backdate_previous_deduction_day column
 * @method     ChildSalaryAttendanceBackdateTrackLog[]|Collection findByBackdatePreviousDeductionDate(string|array<string> $backdate_previous_deduction_date) Return ChildSalaryAttendanceBackdateTrackLog objects filtered by the backdate_previous_deduction_date column
 * @psalm-method Collection&\Traversable<ChildSalaryAttendanceBackdateTrackLog> findByBackdatePreviousDeductionDate(string|array<string> $backdate_previous_deduction_date) Return ChildSalaryAttendanceBackdateTrackLog objects filtered by the backdate_previous_deduction_date column
 * @method     ChildSalaryAttendanceBackdateTrackLog[]|Collection findByBackdatePreviousToPreviousDay(int|array<int> $backdate_previous_to_previous_day) Return ChildSalaryAttendanceBackdateTrackLog objects filtered by the backdate_previous_to_previous_day column
 * @psalm-method Collection&\Traversable<ChildSalaryAttendanceBackdateTrackLog> findByBackdatePreviousToPreviousDay(int|array<int> $backdate_previous_to_previous_day) Return ChildSalaryAttendanceBackdateTrackLog objects filtered by the backdate_previous_to_previous_day column
 * @method     ChildSalaryAttendanceBackdateTrackLog[]|Collection findByBackdatePreviousToPreviousDate(string|array<string> $backdate_previous_to_previous_date) Return ChildSalaryAttendanceBackdateTrackLog objects filtered by the backdate_previous_to_previous_date column
 * @psalm-method Collection&\Traversable<ChildSalaryAttendanceBackdateTrackLog> findByBackdatePreviousToPreviousDate(string|array<string> $backdate_previous_to_previous_date) Return ChildSalaryAttendanceBackdateTrackLog objects filtered by the backdate_previous_to_previous_date column
 * @method     ChildSalaryAttendanceBackdateTrackLog[]|Collection findByPaidAmount(string|array<string> $paid_amount) Return ChildSalaryAttendanceBackdateTrackLog objects filtered by the paid_amount column
 * @psalm-method Collection&\Traversable<ChildSalaryAttendanceBackdateTrackLog> findByPaidAmount(string|array<string> $paid_amount) Return ChildSalaryAttendanceBackdateTrackLog objects filtered by the paid_amount column
 * @method     ChildSalaryAttendanceBackdateTrackLog[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildSalaryAttendanceBackdateTrackLog objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildSalaryAttendanceBackdateTrackLog> findByCreatedAt(string|array<string> $created_at) Return ChildSalaryAttendanceBackdateTrackLog objects filtered by the created_at column
 * @method     ChildSalaryAttendanceBackdateTrackLog[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildSalaryAttendanceBackdateTrackLog objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildSalaryAttendanceBackdateTrackLog> findByUpdatedAt(string|array<string> $updated_at) Return ChildSalaryAttendanceBackdateTrackLog objects filtered by the updated_at column
 * @method     ChildSalaryAttendanceBackdateTrackLog[]|Collection findByEmployeeId(int|array<int> $employee_id) Return ChildSalaryAttendanceBackdateTrackLog objects filtered by the employee_id column
 * @psalm-method Collection&\Traversable<ChildSalaryAttendanceBackdateTrackLog> findByEmployeeId(int|array<int> $employee_id) Return ChildSalaryAttendanceBackdateTrackLog objects filtered by the employee_id column
 *
 * @method     ChildSalaryAttendanceBackdateTrackLog[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSalaryAttendanceBackdateTrackLog> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SalaryAttendanceBackdateTrackLogQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\SalaryAttendanceBackdateTrackLogQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\SalaryAttendanceBackdateTrackLog', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSalaryAttendanceBackdateTrackLogQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSalaryAttendanceBackdateTrackLogQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSalaryAttendanceBackdateTrackLogQuery) {
            return $criteria;
        }
        $query = new ChildSalaryAttendanceBackdateTrackLogQuery();
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
     * @return ChildSalaryAttendanceBackdateTrackLog|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SalaryAttendanceBackdateTrackLogTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = SalaryAttendanceBackdateTrackLogTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSalaryAttendanceBackdateTrackLog A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, previous_from_date, previous_to_date, previous_to_previous_from_date, previous_to_previous_to_date, backdate_previous_deduction_day, backdate_previous_deduction_date, backdate_previous_to_previous_day, backdate_previous_to_previous_date, paid_amount, created_at, updated_at, employee_id FROM salary_attendance_backdate_track_log WHERE id = :p0';
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
            /** @var ChildSalaryAttendanceBackdateTrackLog $obj */
            $obj = new ChildSalaryAttendanceBackdateTrackLog();
            $obj->hydrate($row);
            SalaryAttendanceBackdateTrackLogTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSalaryAttendanceBackdateTrackLog|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SalaryAttendanceBackdateTrackLogTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SalaryAttendanceBackdateTrackLogTableMap::COL_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(SalaryAttendanceBackdateTrackLogTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(SalaryAttendanceBackdateTrackLogTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SalaryAttendanceBackdateTrackLogTableMap::COL_ID, $id, $comparison);

        return $this;
    }

    /**
     * Filter the query on the previous_from_date column
     *
     * Example usage:
     * <code>
     * $query->filterByPreviousFromDate('2011-03-14'); // WHERE previous_from_date = '2011-03-14'
     * $query->filterByPreviousFromDate('now'); // WHERE previous_from_date = '2011-03-14'
     * $query->filterByPreviousFromDate(array('max' => 'yesterday')); // WHERE previous_from_date > '2011-03-13'
     * </code>
     *
     * @param mixed $previousFromDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPreviousFromDate($previousFromDate = null, ?string $comparison = null)
    {
        if (is_array($previousFromDate)) {
            $useMinMax = false;
            if (isset($previousFromDate['min'])) {
                $this->addUsingAlias(SalaryAttendanceBackdateTrackLogTableMap::COL_PREVIOUS_FROM_DATE, $previousFromDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($previousFromDate['max'])) {
                $this->addUsingAlias(SalaryAttendanceBackdateTrackLogTableMap::COL_PREVIOUS_FROM_DATE, $previousFromDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SalaryAttendanceBackdateTrackLogTableMap::COL_PREVIOUS_FROM_DATE, $previousFromDate, $comparison);

        return $this;
    }

    /**
     * Filter the query on the previous_to_date column
     *
     * Example usage:
     * <code>
     * $query->filterByPreviousToDate('2011-03-14'); // WHERE previous_to_date = '2011-03-14'
     * $query->filterByPreviousToDate('now'); // WHERE previous_to_date = '2011-03-14'
     * $query->filterByPreviousToDate(array('max' => 'yesterday')); // WHERE previous_to_date > '2011-03-13'
     * </code>
     *
     * @param mixed $previousToDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPreviousToDate($previousToDate = null, ?string $comparison = null)
    {
        if (is_array($previousToDate)) {
            $useMinMax = false;
            if (isset($previousToDate['min'])) {
                $this->addUsingAlias(SalaryAttendanceBackdateTrackLogTableMap::COL_PREVIOUS_TO_DATE, $previousToDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($previousToDate['max'])) {
                $this->addUsingAlias(SalaryAttendanceBackdateTrackLogTableMap::COL_PREVIOUS_TO_DATE, $previousToDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SalaryAttendanceBackdateTrackLogTableMap::COL_PREVIOUS_TO_DATE, $previousToDate, $comparison);

        return $this;
    }

    /**
     * Filter the query on the previous_to_previous_from_date column
     *
     * Example usage:
     * <code>
     * $query->filterByPreviousToPreviousFromDate('2011-03-14'); // WHERE previous_to_previous_from_date = '2011-03-14'
     * $query->filterByPreviousToPreviousFromDate('now'); // WHERE previous_to_previous_from_date = '2011-03-14'
     * $query->filterByPreviousToPreviousFromDate(array('max' => 'yesterday')); // WHERE previous_to_previous_from_date > '2011-03-13'
     * </code>
     *
     * @param mixed $previousToPreviousFromDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPreviousToPreviousFromDate($previousToPreviousFromDate = null, ?string $comparison = null)
    {
        if (is_array($previousToPreviousFromDate)) {
            $useMinMax = false;
            if (isset($previousToPreviousFromDate['min'])) {
                $this->addUsingAlias(SalaryAttendanceBackdateTrackLogTableMap::COL_PREVIOUS_TO_PREVIOUS_FROM_DATE, $previousToPreviousFromDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($previousToPreviousFromDate['max'])) {
                $this->addUsingAlias(SalaryAttendanceBackdateTrackLogTableMap::COL_PREVIOUS_TO_PREVIOUS_FROM_DATE, $previousToPreviousFromDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SalaryAttendanceBackdateTrackLogTableMap::COL_PREVIOUS_TO_PREVIOUS_FROM_DATE, $previousToPreviousFromDate, $comparison);

        return $this;
    }

    /**
     * Filter the query on the previous_to_previous_to_date column
     *
     * Example usage:
     * <code>
     * $query->filterByPreviousToPreviousToDate('2011-03-14'); // WHERE previous_to_previous_to_date = '2011-03-14'
     * $query->filterByPreviousToPreviousToDate('now'); // WHERE previous_to_previous_to_date = '2011-03-14'
     * $query->filterByPreviousToPreviousToDate(array('max' => 'yesterday')); // WHERE previous_to_previous_to_date > '2011-03-13'
     * </code>
     *
     * @param mixed $previousToPreviousToDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPreviousToPreviousToDate($previousToPreviousToDate = null, ?string $comparison = null)
    {
        if (is_array($previousToPreviousToDate)) {
            $useMinMax = false;
            if (isset($previousToPreviousToDate['min'])) {
                $this->addUsingAlias(SalaryAttendanceBackdateTrackLogTableMap::COL_PREVIOUS_TO_PREVIOUS_TO_DATE, $previousToPreviousToDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($previousToPreviousToDate['max'])) {
                $this->addUsingAlias(SalaryAttendanceBackdateTrackLogTableMap::COL_PREVIOUS_TO_PREVIOUS_TO_DATE, $previousToPreviousToDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SalaryAttendanceBackdateTrackLogTableMap::COL_PREVIOUS_TO_PREVIOUS_TO_DATE, $previousToPreviousToDate, $comparison);

        return $this;
    }

    /**
     * Filter the query on the backdate_previous_deduction_day column
     *
     * Example usage:
     * <code>
     * $query->filterByBackdatePreviousDeductionDay(1234); // WHERE backdate_previous_deduction_day = 1234
     * $query->filterByBackdatePreviousDeductionDay(array(12, 34)); // WHERE backdate_previous_deduction_day IN (12, 34)
     * $query->filterByBackdatePreviousDeductionDay(array('min' => 12)); // WHERE backdate_previous_deduction_day > 12
     * </code>
     *
     * @param mixed $backdatePreviousDeductionDay The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBackdatePreviousDeductionDay($backdatePreviousDeductionDay = null, ?string $comparison = null)
    {
        if (is_array($backdatePreviousDeductionDay)) {
            $useMinMax = false;
            if (isset($backdatePreviousDeductionDay['min'])) {
                $this->addUsingAlias(SalaryAttendanceBackdateTrackLogTableMap::COL_BACKDATE_PREVIOUS_DEDUCTION_DAY, $backdatePreviousDeductionDay['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($backdatePreviousDeductionDay['max'])) {
                $this->addUsingAlias(SalaryAttendanceBackdateTrackLogTableMap::COL_BACKDATE_PREVIOUS_DEDUCTION_DAY, $backdatePreviousDeductionDay['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SalaryAttendanceBackdateTrackLogTableMap::COL_BACKDATE_PREVIOUS_DEDUCTION_DAY, $backdatePreviousDeductionDay, $comparison);

        return $this;
    }

    /**
     * Filter the query on the backdate_previous_deduction_date column
     *
     * Example usage:
     * <code>
     * $query->filterByBackdatePreviousDeductionDate('fooValue');   // WHERE backdate_previous_deduction_date = 'fooValue'
     * $query->filterByBackdatePreviousDeductionDate('%fooValue%', Criteria::LIKE); // WHERE backdate_previous_deduction_date LIKE '%fooValue%'
     * $query->filterByBackdatePreviousDeductionDate(['foo', 'bar']); // WHERE backdate_previous_deduction_date IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $backdatePreviousDeductionDate The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBackdatePreviousDeductionDate($backdatePreviousDeductionDate = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($backdatePreviousDeductionDate)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SalaryAttendanceBackdateTrackLogTableMap::COL_BACKDATE_PREVIOUS_DEDUCTION_DATE, $backdatePreviousDeductionDate, $comparison);

        return $this;
    }

    /**
     * Filter the query on the backdate_previous_to_previous_day column
     *
     * Example usage:
     * <code>
     * $query->filterByBackdatePreviousToPreviousDay(1234); // WHERE backdate_previous_to_previous_day = 1234
     * $query->filterByBackdatePreviousToPreviousDay(array(12, 34)); // WHERE backdate_previous_to_previous_day IN (12, 34)
     * $query->filterByBackdatePreviousToPreviousDay(array('min' => 12)); // WHERE backdate_previous_to_previous_day > 12
     * </code>
     *
     * @param mixed $backdatePreviousToPreviousDay The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBackdatePreviousToPreviousDay($backdatePreviousToPreviousDay = null, ?string $comparison = null)
    {
        if (is_array($backdatePreviousToPreviousDay)) {
            $useMinMax = false;
            if (isset($backdatePreviousToPreviousDay['min'])) {
                $this->addUsingAlias(SalaryAttendanceBackdateTrackLogTableMap::COL_BACKDATE_PREVIOUS_TO_PREVIOUS_DAY, $backdatePreviousToPreviousDay['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($backdatePreviousToPreviousDay['max'])) {
                $this->addUsingAlias(SalaryAttendanceBackdateTrackLogTableMap::COL_BACKDATE_PREVIOUS_TO_PREVIOUS_DAY, $backdatePreviousToPreviousDay['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SalaryAttendanceBackdateTrackLogTableMap::COL_BACKDATE_PREVIOUS_TO_PREVIOUS_DAY, $backdatePreviousToPreviousDay, $comparison);

        return $this;
    }

    /**
     * Filter the query on the backdate_previous_to_previous_date column
     *
     * Example usage:
     * <code>
     * $query->filterByBackdatePreviousToPreviousDate('fooValue');   // WHERE backdate_previous_to_previous_date = 'fooValue'
     * $query->filterByBackdatePreviousToPreviousDate('%fooValue%', Criteria::LIKE); // WHERE backdate_previous_to_previous_date LIKE '%fooValue%'
     * $query->filterByBackdatePreviousToPreviousDate(['foo', 'bar']); // WHERE backdate_previous_to_previous_date IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $backdatePreviousToPreviousDate The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBackdatePreviousToPreviousDate($backdatePreviousToPreviousDate = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($backdatePreviousToPreviousDate)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SalaryAttendanceBackdateTrackLogTableMap::COL_BACKDATE_PREVIOUS_TO_PREVIOUS_DATE, $backdatePreviousToPreviousDate, $comparison);

        return $this;
    }

    /**
     * Filter the query on the paid_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByPaidAmount(1234); // WHERE paid_amount = 1234
     * $query->filterByPaidAmount(array(12, 34)); // WHERE paid_amount IN (12, 34)
     * $query->filterByPaidAmount(array('min' => 12)); // WHERE paid_amount > 12
     * </code>
     *
     * @param mixed $paidAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPaidAmount($paidAmount = null, ?string $comparison = null)
    {
        if (is_array($paidAmount)) {
            $useMinMax = false;
            if (isset($paidAmount['min'])) {
                $this->addUsingAlias(SalaryAttendanceBackdateTrackLogTableMap::COL_PAID_AMOUNT, $paidAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($paidAmount['max'])) {
                $this->addUsingAlias(SalaryAttendanceBackdateTrackLogTableMap::COL_PAID_AMOUNT, $paidAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SalaryAttendanceBackdateTrackLogTableMap::COL_PAID_AMOUNT, $paidAmount, $comparison);

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
                $this->addUsingAlias(SalaryAttendanceBackdateTrackLogTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(SalaryAttendanceBackdateTrackLogTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SalaryAttendanceBackdateTrackLogTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(SalaryAttendanceBackdateTrackLogTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(SalaryAttendanceBackdateTrackLogTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SalaryAttendanceBackdateTrackLogTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

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
     * @see       filterByEmployee()
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
                $this->addUsingAlias(SalaryAttendanceBackdateTrackLogTableMap::COL_EMPLOYEE_ID, $employeeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($employeeId['max'])) {
                $this->addUsingAlias(SalaryAttendanceBackdateTrackLogTableMap::COL_EMPLOYEE_ID, $employeeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SalaryAttendanceBackdateTrackLogTableMap::COL_EMPLOYEE_ID, $employeeId, $comparison);

        return $this;
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
                ->addUsingAlias(SalaryAttendanceBackdateTrackLogTableMap::COL_EMPLOYEE_ID, $employee->getEmployeeId(), $comparison);
        } elseif ($employee instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SalaryAttendanceBackdateTrackLogTableMap::COL_EMPLOYEE_ID, $employee->toKeyValue('PrimaryKey', 'EmployeeId'), $comparison);

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
    public function joinEmployee(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
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
    public function useEmployeeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
        ?string $joinType = Criteria::INNER_JOIN
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
     * Exclude object from result
     *
     * @param ChildSalaryAttendanceBackdateTrackLog $salaryAttendanceBackdateTrackLog Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($salaryAttendanceBackdateTrackLog = null)
    {
        if ($salaryAttendanceBackdateTrackLog) {
            $this->addUsingAlias(SalaryAttendanceBackdateTrackLogTableMap::COL_ID, $salaryAttendanceBackdateTrackLog->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the salary_attendance_backdate_track_log table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SalaryAttendanceBackdateTrackLogTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SalaryAttendanceBackdateTrackLogTableMap::clearInstancePool();
            SalaryAttendanceBackdateTrackLogTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SalaryAttendanceBackdateTrackLogTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SalaryAttendanceBackdateTrackLogTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SalaryAttendanceBackdateTrackLogTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SalaryAttendanceBackdateTrackLogTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
