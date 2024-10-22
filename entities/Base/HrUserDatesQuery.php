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
use entities\HrUserDates as ChildHrUserDates;
use entities\HrUserDatesQuery as ChildHrUserDatesQuery;
use entities\Map\HrUserDatesTableMap;

/**
 * Base class that represents a query for the `hr_user_dates` table.
 *
 * @method     ChildHrUserDatesQuery orderByHrdtId($order = Criteria::ASC) Order by the hrdt_id column
 * @method     ChildHrUserDatesQuery orderByEmployeeId($order = Criteria::ASC) Order by the employee_id column
 * @method     ChildHrUserDatesQuery orderByBirthDate($order = Criteria::ASC) Order by the birth_date column
 * @method     ChildHrUserDatesQuery orderByJoinDate($order = Criteria::ASC) Order by the join_date column
 * @method     ChildHrUserDatesQuery orderByProbationDate($order = Criteria::ASC) Order by the probation_date column
 * @method     ChildHrUserDatesQuery orderByConfirmationDate($order = Criteria::ASC) Order by the confirmation_date column
 * @method     ChildHrUserDatesQuery orderByTrainingStartDate($order = Criteria::ASC) Order by the training_start_date column
 * @method     ChildHrUserDatesQuery orderByTrainingEndDate($order = Criteria::ASC) Order by the training_end_date column
 * @method     ChildHrUserDatesQuery orderByResignDate($order = Criteria::ASC) Order by the resign_date column
 * @method     ChildHrUserDatesQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildHrUserDatesQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildHrUserDatesQuery orderByTransferDate($order = Criteria::ASC) Order by the transfer_date column
 * @method     ChildHrUserDatesQuery orderByRelivingDate($order = Criteria::ASC) Order by the reliving_date column
 * @method     ChildHrUserDatesQuery orderByNsmApproveDate($order = Criteria::ASC) Order by the nsm_approve_date column
 * @method     ChildHrUserDatesQuery orderByResignationRejectedDate($order = Criteria::ASC) Order by the resignation_rejected_date column
 *
 * @method     ChildHrUserDatesQuery groupByHrdtId() Group by the hrdt_id column
 * @method     ChildHrUserDatesQuery groupByEmployeeId() Group by the employee_id column
 * @method     ChildHrUserDatesQuery groupByBirthDate() Group by the birth_date column
 * @method     ChildHrUserDatesQuery groupByJoinDate() Group by the join_date column
 * @method     ChildHrUserDatesQuery groupByProbationDate() Group by the probation_date column
 * @method     ChildHrUserDatesQuery groupByConfirmationDate() Group by the confirmation_date column
 * @method     ChildHrUserDatesQuery groupByTrainingStartDate() Group by the training_start_date column
 * @method     ChildHrUserDatesQuery groupByTrainingEndDate() Group by the training_end_date column
 * @method     ChildHrUserDatesQuery groupByResignDate() Group by the resign_date column
 * @method     ChildHrUserDatesQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildHrUserDatesQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildHrUserDatesQuery groupByTransferDate() Group by the transfer_date column
 * @method     ChildHrUserDatesQuery groupByRelivingDate() Group by the reliving_date column
 * @method     ChildHrUserDatesQuery groupByNsmApproveDate() Group by the nsm_approve_date column
 * @method     ChildHrUserDatesQuery groupByResignationRejectedDate() Group by the resignation_rejected_date column
 *
 * @method     ChildHrUserDatesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildHrUserDatesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildHrUserDatesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildHrUserDatesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildHrUserDatesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildHrUserDatesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildHrUserDatesQuery leftJoinEmployee($relationAlias = null) Adds a LEFT JOIN clause to the query using the Employee relation
 * @method     ChildHrUserDatesQuery rightJoinEmployee($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Employee relation
 * @method     ChildHrUserDatesQuery innerJoinEmployee($relationAlias = null) Adds a INNER JOIN clause to the query using the Employee relation
 *
 * @method     ChildHrUserDatesQuery joinWithEmployee($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Employee relation
 *
 * @method     ChildHrUserDatesQuery leftJoinWithEmployee() Adds a LEFT JOIN clause and with to the query using the Employee relation
 * @method     ChildHrUserDatesQuery rightJoinWithEmployee() Adds a RIGHT JOIN clause and with to the query using the Employee relation
 * @method     ChildHrUserDatesQuery innerJoinWithEmployee() Adds a INNER JOIN clause and with to the query using the Employee relation
 *
 * @method     \entities\EmployeeQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildHrUserDates|null findOne(?ConnectionInterface $con = null) Return the first ChildHrUserDates matching the query
 * @method     ChildHrUserDates findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildHrUserDates matching the query, or a new ChildHrUserDates object populated from the query conditions when no match is found
 *
 * @method     ChildHrUserDates|null findOneByHrdtId(int $hrdt_id) Return the first ChildHrUserDates filtered by the hrdt_id column
 * @method     ChildHrUserDates|null findOneByEmployeeId(int $employee_id) Return the first ChildHrUserDates filtered by the employee_id column
 * @method     ChildHrUserDates|null findOneByBirthDate(string $birth_date) Return the first ChildHrUserDates filtered by the birth_date column
 * @method     ChildHrUserDates|null findOneByJoinDate(string $join_date) Return the first ChildHrUserDates filtered by the join_date column
 * @method     ChildHrUserDates|null findOneByProbationDate(string $probation_date) Return the first ChildHrUserDates filtered by the probation_date column
 * @method     ChildHrUserDates|null findOneByConfirmationDate(string $confirmation_date) Return the first ChildHrUserDates filtered by the confirmation_date column
 * @method     ChildHrUserDates|null findOneByTrainingStartDate(string $training_start_date) Return the first ChildHrUserDates filtered by the training_start_date column
 * @method     ChildHrUserDates|null findOneByTrainingEndDate(string $training_end_date) Return the first ChildHrUserDates filtered by the training_end_date column
 * @method     ChildHrUserDates|null findOneByResignDate(string $resign_date) Return the first ChildHrUserDates filtered by the resign_date column
 * @method     ChildHrUserDates|null findOneByCreatedAt(string $created_at) Return the first ChildHrUserDates filtered by the created_at column
 * @method     ChildHrUserDates|null findOneByUpdatedAt(string $updated_at) Return the first ChildHrUserDates filtered by the updated_at column
 * @method     ChildHrUserDates|null findOneByTransferDate(string $transfer_date) Return the first ChildHrUserDates filtered by the transfer_date column
 * @method     ChildHrUserDates|null findOneByRelivingDate(string $reliving_date) Return the first ChildHrUserDates filtered by the reliving_date column
 * @method     ChildHrUserDates|null findOneByNsmApproveDate(string $nsm_approve_date) Return the first ChildHrUserDates filtered by the nsm_approve_date column
 * @method     ChildHrUserDates|null findOneByResignationRejectedDate(string $resignation_rejected_date) Return the first ChildHrUserDates filtered by the resignation_rejected_date column
 *
 * @method     ChildHrUserDates requirePk($key, ?ConnectionInterface $con = null) Return the ChildHrUserDates by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHrUserDates requireOne(?ConnectionInterface $con = null) Return the first ChildHrUserDates matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildHrUserDates requireOneByHrdtId(int $hrdt_id) Return the first ChildHrUserDates filtered by the hrdt_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHrUserDates requireOneByEmployeeId(int $employee_id) Return the first ChildHrUserDates filtered by the employee_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHrUserDates requireOneByBirthDate(string $birth_date) Return the first ChildHrUserDates filtered by the birth_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHrUserDates requireOneByJoinDate(string $join_date) Return the first ChildHrUserDates filtered by the join_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHrUserDates requireOneByProbationDate(string $probation_date) Return the first ChildHrUserDates filtered by the probation_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHrUserDates requireOneByConfirmationDate(string $confirmation_date) Return the first ChildHrUserDates filtered by the confirmation_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHrUserDates requireOneByTrainingStartDate(string $training_start_date) Return the first ChildHrUserDates filtered by the training_start_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHrUserDates requireOneByTrainingEndDate(string $training_end_date) Return the first ChildHrUserDates filtered by the training_end_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHrUserDates requireOneByResignDate(string $resign_date) Return the first ChildHrUserDates filtered by the resign_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHrUserDates requireOneByCreatedAt(string $created_at) Return the first ChildHrUserDates filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHrUserDates requireOneByUpdatedAt(string $updated_at) Return the first ChildHrUserDates filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHrUserDates requireOneByTransferDate(string $transfer_date) Return the first ChildHrUserDates filtered by the transfer_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHrUserDates requireOneByRelivingDate(string $reliving_date) Return the first ChildHrUserDates filtered by the reliving_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHrUserDates requireOneByNsmApproveDate(string $nsm_approve_date) Return the first ChildHrUserDates filtered by the nsm_approve_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHrUserDates requireOneByResignationRejectedDate(string $resignation_rejected_date) Return the first ChildHrUserDates filtered by the resignation_rejected_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildHrUserDates[]|Collection find(?ConnectionInterface $con = null) Return ChildHrUserDates objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildHrUserDates> find(?ConnectionInterface $con = null) Return ChildHrUserDates objects based on current ModelCriteria
 *
 * @method     ChildHrUserDates[]|Collection findByHrdtId(int|array<int> $hrdt_id) Return ChildHrUserDates objects filtered by the hrdt_id column
 * @psalm-method Collection&\Traversable<ChildHrUserDates> findByHrdtId(int|array<int> $hrdt_id) Return ChildHrUserDates objects filtered by the hrdt_id column
 * @method     ChildHrUserDates[]|Collection findByEmployeeId(int|array<int> $employee_id) Return ChildHrUserDates objects filtered by the employee_id column
 * @psalm-method Collection&\Traversable<ChildHrUserDates> findByEmployeeId(int|array<int> $employee_id) Return ChildHrUserDates objects filtered by the employee_id column
 * @method     ChildHrUserDates[]|Collection findByBirthDate(string|array<string> $birth_date) Return ChildHrUserDates objects filtered by the birth_date column
 * @psalm-method Collection&\Traversable<ChildHrUserDates> findByBirthDate(string|array<string> $birth_date) Return ChildHrUserDates objects filtered by the birth_date column
 * @method     ChildHrUserDates[]|Collection findByJoinDate(string|array<string> $join_date) Return ChildHrUserDates objects filtered by the join_date column
 * @psalm-method Collection&\Traversable<ChildHrUserDates> findByJoinDate(string|array<string> $join_date) Return ChildHrUserDates objects filtered by the join_date column
 * @method     ChildHrUserDates[]|Collection findByProbationDate(string|array<string> $probation_date) Return ChildHrUserDates objects filtered by the probation_date column
 * @psalm-method Collection&\Traversable<ChildHrUserDates> findByProbationDate(string|array<string> $probation_date) Return ChildHrUserDates objects filtered by the probation_date column
 * @method     ChildHrUserDates[]|Collection findByConfirmationDate(string|array<string> $confirmation_date) Return ChildHrUserDates objects filtered by the confirmation_date column
 * @psalm-method Collection&\Traversable<ChildHrUserDates> findByConfirmationDate(string|array<string> $confirmation_date) Return ChildHrUserDates objects filtered by the confirmation_date column
 * @method     ChildHrUserDates[]|Collection findByTrainingStartDate(string|array<string> $training_start_date) Return ChildHrUserDates objects filtered by the training_start_date column
 * @psalm-method Collection&\Traversable<ChildHrUserDates> findByTrainingStartDate(string|array<string> $training_start_date) Return ChildHrUserDates objects filtered by the training_start_date column
 * @method     ChildHrUserDates[]|Collection findByTrainingEndDate(string|array<string> $training_end_date) Return ChildHrUserDates objects filtered by the training_end_date column
 * @psalm-method Collection&\Traversable<ChildHrUserDates> findByTrainingEndDate(string|array<string> $training_end_date) Return ChildHrUserDates objects filtered by the training_end_date column
 * @method     ChildHrUserDates[]|Collection findByResignDate(string|array<string> $resign_date) Return ChildHrUserDates objects filtered by the resign_date column
 * @psalm-method Collection&\Traversable<ChildHrUserDates> findByResignDate(string|array<string> $resign_date) Return ChildHrUserDates objects filtered by the resign_date column
 * @method     ChildHrUserDates[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildHrUserDates objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildHrUserDates> findByCreatedAt(string|array<string> $created_at) Return ChildHrUserDates objects filtered by the created_at column
 * @method     ChildHrUserDates[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildHrUserDates objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildHrUserDates> findByUpdatedAt(string|array<string> $updated_at) Return ChildHrUserDates objects filtered by the updated_at column
 * @method     ChildHrUserDates[]|Collection findByTransferDate(string|array<string> $transfer_date) Return ChildHrUserDates objects filtered by the transfer_date column
 * @psalm-method Collection&\Traversable<ChildHrUserDates> findByTransferDate(string|array<string> $transfer_date) Return ChildHrUserDates objects filtered by the transfer_date column
 * @method     ChildHrUserDates[]|Collection findByRelivingDate(string|array<string> $reliving_date) Return ChildHrUserDates objects filtered by the reliving_date column
 * @psalm-method Collection&\Traversable<ChildHrUserDates> findByRelivingDate(string|array<string> $reliving_date) Return ChildHrUserDates objects filtered by the reliving_date column
 * @method     ChildHrUserDates[]|Collection findByNsmApproveDate(string|array<string> $nsm_approve_date) Return ChildHrUserDates objects filtered by the nsm_approve_date column
 * @psalm-method Collection&\Traversable<ChildHrUserDates> findByNsmApproveDate(string|array<string> $nsm_approve_date) Return ChildHrUserDates objects filtered by the nsm_approve_date column
 * @method     ChildHrUserDates[]|Collection findByResignationRejectedDate(string|array<string> $resignation_rejected_date) Return ChildHrUserDates objects filtered by the resignation_rejected_date column
 * @psalm-method Collection&\Traversable<ChildHrUserDates> findByResignationRejectedDate(string|array<string> $resignation_rejected_date) Return ChildHrUserDates objects filtered by the resignation_rejected_date column
 *
 * @method     ChildHrUserDates[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildHrUserDates> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class HrUserDatesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\HrUserDatesQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\HrUserDates', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildHrUserDatesQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildHrUserDatesQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildHrUserDatesQuery) {
            return $criteria;
        }
        $query = new ChildHrUserDatesQuery();
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
     * @return ChildHrUserDates|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(HrUserDatesTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = HrUserDatesTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildHrUserDates A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT hrdt_id, employee_id, birth_date, join_date, probation_date, confirmation_date, training_start_date, training_end_date, resign_date, created_at, updated_at, transfer_date, reliving_date, nsm_approve_date, resignation_rejected_date FROM hr_user_dates WHERE hrdt_id = :p0';
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
            /** @var ChildHrUserDates $obj */
            $obj = new ChildHrUserDates();
            $obj->hydrate($row);
            HrUserDatesTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildHrUserDates|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(HrUserDatesTableMap::COL_HRDT_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(HrUserDatesTableMap::COL_HRDT_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the hrdt_id column
     *
     * Example usage:
     * <code>
     * $query->filterByHrdtId(1234); // WHERE hrdt_id = 1234
     * $query->filterByHrdtId(array(12, 34)); // WHERE hrdt_id IN (12, 34)
     * $query->filterByHrdtId(array('min' => 12)); // WHERE hrdt_id > 12
     * </code>
     *
     * @param mixed $hrdtId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByHrdtId($hrdtId = null, ?string $comparison = null)
    {
        if (is_array($hrdtId)) {
            $useMinMax = false;
            if (isset($hrdtId['min'])) {
                $this->addUsingAlias(HrUserDatesTableMap::COL_HRDT_ID, $hrdtId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($hrdtId['max'])) {
                $this->addUsingAlias(HrUserDatesTableMap::COL_HRDT_ID, $hrdtId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(HrUserDatesTableMap::COL_HRDT_ID, $hrdtId, $comparison);

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
                $this->addUsingAlias(HrUserDatesTableMap::COL_EMPLOYEE_ID, $employeeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($employeeId['max'])) {
                $this->addUsingAlias(HrUserDatesTableMap::COL_EMPLOYEE_ID, $employeeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(HrUserDatesTableMap::COL_EMPLOYEE_ID, $employeeId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the birth_date column
     *
     * Example usage:
     * <code>
     * $query->filterByBirthDate('2011-03-14'); // WHERE birth_date = '2011-03-14'
     * $query->filterByBirthDate('now'); // WHERE birth_date = '2011-03-14'
     * $query->filterByBirthDate(array('max' => 'yesterday')); // WHERE birth_date > '2011-03-13'
     * </code>
     *
     * @param mixed $birthDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBirthDate($birthDate = null, ?string $comparison = null)
    {
        if (is_array($birthDate)) {
            $useMinMax = false;
            if (isset($birthDate['min'])) {
                $this->addUsingAlias(HrUserDatesTableMap::COL_BIRTH_DATE, $birthDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($birthDate['max'])) {
                $this->addUsingAlias(HrUserDatesTableMap::COL_BIRTH_DATE, $birthDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(HrUserDatesTableMap::COL_BIRTH_DATE, $birthDate, $comparison);

        return $this;
    }

    /**
     * Filter the query on the join_date column
     *
     * Example usage:
     * <code>
     * $query->filterByJoinDate('2011-03-14'); // WHERE join_date = '2011-03-14'
     * $query->filterByJoinDate('now'); // WHERE join_date = '2011-03-14'
     * $query->filterByJoinDate(array('max' => 'yesterday')); // WHERE join_date > '2011-03-13'
     * </code>
     *
     * @param mixed $joinDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByJoinDate($joinDate = null, ?string $comparison = null)
    {
        if (is_array($joinDate)) {
            $useMinMax = false;
            if (isset($joinDate['min'])) {
                $this->addUsingAlias(HrUserDatesTableMap::COL_JOIN_DATE, $joinDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($joinDate['max'])) {
                $this->addUsingAlias(HrUserDatesTableMap::COL_JOIN_DATE, $joinDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(HrUserDatesTableMap::COL_JOIN_DATE, $joinDate, $comparison);

        return $this;
    }

    /**
     * Filter the query on the probation_date column
     *
     * Example usage:
     * <code>
     * $query->filterByProbationDate('2011-03-14'); // WHERE probation_date = '2011-03-14'
     * $query->filterByProbationDate('now'); // WHERE probation_date = '2011-03-14'
     * $query->filterByProbationDate(array('max' => 'yesterday')); // WHERE probation_date > '2011-03-13'
     * </code>
     *
     * @param mixed $probationDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProbationDate($probationDate = null, ?string $comparison = null)
    {
        if (is_array($probationDate)) {
            $useMinMax = false;
            if (isset($probationDate['min'])) {
                $this->addUsingAlias(HrUserDatesTableMap::COL_PROBATION_DATE, $probationDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($probationDate['max'])) {
                $this->addUsingAlias(HrUserDatesTableMap::COL_PROBATION_DATE, $probationDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(HrUserDatesTableMap::COL_PROBATION_DATE, $probationDate, $comparison);

        return $this;
    }

    /**
     * Filter the query on the confirmation_date column
     *
     * Example usage:
     * <code>
     * $query->filterByConfirmationDate('2011-03-14'); // WHERE confirmation_date = '2011-03-14'
     * $query->filterByConfirmationDate('now'); // WHERE confirmation_date = '2011-03-14'
     * $query->filterByConfirmationDate(array('max' => 'yesterday')); // WHERE confirmation_date > '2011-03-13'
     * </code>
     *
     * @param mixed $confirmationDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByConfirmationDate($confirmationDate = null, ?string $comparison = null)
    {
        if (is_array($confirmationDate)) {
            $useMinMax = false;
            if (isset($confirmationDate['min'])) {
                $this->addUsingAlias(HrUserDatesTableMap::COL_CONFIRMATION_DATE, $confirmationDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($confirmationDate['max'])) {
                $this->addUsingAlias(HrUserDatesTableMap::COL_CONFIRMATION_DATE, $confirmationDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(HrUserDatesTableMap::COL_CONFIRMATION_DATE, $confirmationDate, $comparison);

        return $this;
    }

    /**
     * Filter the query on the training_start_date column
     *
     * Example usage:
     * <code>
     * $query->filterByTrainingStartDate('2011-03-14'); // WHERE training_start_date = '2011-03-14'
     * $query->filterByTrainingStartDate('now'); // WHERE training_start_date = '2011-03-14'
     * $query->filterByTrainingStartDate(array('max' => 'yesterday')); // WHERE training_start_date > '2011-03-13'
     * </code>
     *
     * @param mixed $trainingStartDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTrainingStartDate($trainingStartDate = null, ?string $comparison = null)
    {
        if (is_array($trainingStartDate)) {
            $useMinMax = false;
            if (isset($trainingStartDate['min'])) {
                $this->addUsingAlias(HrUserDatesTableMap::COL_TRAINING_START_DATE, $trainingStartDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($trainingStartDate['max'])) {
                $this->addUsingAlias(HrUserDatesTableMap::COL_TRAINING_START_DATE, $trainingStartDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(HrUserDatesTableMap::COL_TRAINING_START_DATE, $trainingStartDate, $comparison);

        return $this;
    }

    /**
     * Filter the query on the training_end_date column
     *
     * Example usage:
     * <code>
     * $query->filterByTrainingEndDate('2011-03-14'); // WHERE training_end_date = '2011-03-14'
     * $query->filterByTrainingEndDate('now'); // WHERE training_end_date = '2011-03-14'
     * $query->filterByTrainingEndDate(array('max' => 'yesterday')); // WHERE training_end_date > '2011-03-13'
     * </code>
     *
     * @param mixed $trainingEndDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTrainingEndDate($trainingEndDate = null, ?string $comparison = null)
    {
        if (is_array($trainingEndDate)) {
            $useMinMax = false;
            if (isset($trainingEndDate['min'])) {
                $this->addUsingAlias(HrUserDatesTableMap::COL_TRAINING_END_DATE, $trainingEndDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($trainingEndDate['max'])) {
                $this->addUsingAlias(HrUserDatesTableMap::COL_TRAINING_END_DATE, $trainingEndDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(HrUserDatesTableMap::COL_TRAINING_END_DATE, $trainingEndDate, $comparison);

        return $this;
    }

    /**
     * Filter the query on the resign_date column
     *
     * Example usage:
     * <code>
     * $query->filterByResignDate('2011-03-14'); // WHERE resign_date = '2011-03-14'
     * $query->filterByResignDate('now'); // WHERE resign_date = '2011-03-14'
     * $query->filterByResignDate(array('max' => 'yesterday')); // WHERE resign_date > '2011-03-13'
     * </code>
     *
     * @param mixed $resignDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByResignDate($resignDate = null, ?string $comparison = null)
    {
        if (is_array($resignDate)) {
            $useMinMax = false;
            if (isset($resignDate['min'])) {
                $this->addUsingAlias(HrUserDatesTableMap::COL_RESIGN_DATE, $resignDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($resignDate['max'])) {
                $this->addUsingAlias(HrUserDatesTableMap::COL_RESIGN_DATE, $resignDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(HrUserDatesTableMap::COL_RESIGN_DATE, $resignDate, $comparison);

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
                $this->addUsingAlias(HrUserDatesTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(HrUserDatesTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(HrUserDatesTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(HrUserDatesTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(HrUserDatesTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(HrUserDatesTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the transfer_date column
     *
     * Example usage:
     * <code>
     * $query->filterByTransferDate('2011-03-14'); // WHERE transfer_date = '2011-03-14'
     * $query->filterByTransferDate('now'); // WHERE transfer_date = '2011-03-14'
     * $query->filterByTransferDate(array('max' => 'yesterday')); // WHERE transfer_date > '2011-03-13'
     * </code>
     *
     * @param mixed $transferDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTransferDate($transferDate = null, ?string $comparison = null)
    {
        if (is_array($transferDate)) {
            $useMinMax = false;
            if (isset($transferDate['min'])) {
                $this->addUsingAlias(HrUserDatesTableMap::COL_TRANSFER_DATE, $transferDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($transferDate['max'])) {
                $this->addUsingAlias(HrUserDatesTableMap::COL_TRANSFER_DATE, $transferDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(HrUserDatesTableMap::COL_TRANSFER_DATE, $transferDate, $comparison);

        return $this;
    }

    /**
     * Filter the query on the reliving_date column
     *
     * Example usage:
     * <code>
     * $query->filterByRelivingDate('2011-03-14'); // WHERE reliving_date = '2011-03-14'
     * $query->filterByRelivingDate('now'); // WHERE reliving_date = '2011-03-14'
     * $query->filterByRelivingDate(array('max' => 'yesterday')); // WHERE reliving_date > '2011-03-13'
     * </code>
     *
     * @param mixed $relivingDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRelivingDate($relivingDate = null, ?string $comparison = null)
    {
        if (is_array($relivingDate)) {
            $useMinMax = false;
            if (isset($relivingDate['min'])) {
                $this->addUsingAlias(HrUserDatesTableMap::COL_RELIVING_DATE, $relivingDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($relivingDate['max'])) {
                $this->addUsingAlias(HrUserDatesTableMap::COL_RELIVING_DATE, $relivingDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(HrUserDatesTableMap::COL_RELIVING_DATE, $relivingDate, $comparison);

        return $this;
    }

    /**
     * Filter the query on the nsm_approve_date column
     *
     * Example usage:
     * <code>
     * $query->filterByNsmApproveDate('2011-03-14'); // WHERE nsm_approve_date = '2011-03-14'
     * $query->filterByNsmApproveDate('now'); // WHERE nsm_approve_date = '2011-03-14'
     * $query->filterByNsmApproveDate(array('max' => 'yesterday')); // WHERE nsm_approve_date > '2011-03-13'
     * </code>
     *
     * @param mixed $nsmApproveDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByNsmApproveDate($nsmApproveDate = null, ?string $comparison = null)
    {
        if (is_array($nsmApproveDate)) {
            $useMinMax = false;
            if (isset($nsmApproveDate['min'])) {
                $this->addUsingAlias(HrUserDatesTableMap::COL_NSM_APPROVE_DATE, $nsmApproveDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($nsmApproveDate['max'])) {
                $this->addUsingAlias(HrUserDatesTableMap::COL_NSM_APPROVE_DATE, $nsmApproveDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(HrUserDatesTableMap::COL_NSM_APPROVE_DATE, $nsmApproveDate, $comparison);

        return $this;
    }

    /**
     * Filter the query on the resignation_rejected_date column
     *
     * Example usage:
     * <code>
     * $query->filterByResignationRejectedDate('2011-03-14'); // WHERE resignation_rejected_date = '2011-03-14'
     * $query->filterByResignationRejectedDate('now'); // WHERE resignation_rejected_date = '2011-03-14'
     * $query->filterByResignationRejectedDate(array('max' => 'yesterday')); // WHERE resignation_rejected_date > '2011-03-13'
     * </code>
     *
     * @param mixed $resignationRejectedDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByResignationRejectedDate($resignationRejectedDate = null, ?string $comparison = null)
    {
        if (is_array($resignationRejectedDate)) {
            $useMinMax = false;
            if (isset($resignationRejectedDate['min'])) {
                $this->addUsingAlias(HrUserDatesTableMap::COL_RESIGNATION_REJECTED_DATE, $resignationRejectedDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($resignationRejectedDate['max'])) {
                $this->addUsingAlias(HrUserDatesTableMap::COL_RESIGNATION_REJECTED_DATE, $resignationRejectedDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(HrUserDatesTableMap::COL_RESIGNATION_REJECTED_DATE, $resignationRejectedDate, $comparison);

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
                ->addUsingAlias(HrUserDatesTableMap::COL_EMPLOYEE_ID, $employee->getEmployeeId(), $comparison);
        } elseif ($employee instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(HrUserDatesTableMap::COL_EMPLOYEE_ID, $employee->toKeyValue('PrimaryKey', 'EmployeeId'), $comparison);

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
     * @param ChildHrUserDates $hrUserDates Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($hrUserDates = null)
    {
        if ($hrUserDates) {
            $this->addUsingAlias(HrUserDatesTableMap::COL_HRDT_ID, $hrUserDates->getHrdtId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the hr_user_dates table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(HrUserDatesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            HrUserDatesTableMap::clearInstancePool();
            HrUserDatesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(HrUserDatesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(HrUserDatesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            HrUserDatesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            HrUserDatesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
