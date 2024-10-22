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
use entities\HrUserExperiences as ChildHrUserExperiences;
use entities\HrUserExperiencesQuery as ChildHrUserExperiencesQuery;
use entities\Map\HrUserExperiencesTableMap;

/**
 * Base class that represents a query for the `hr_user_experiences` table.
 *
 * @method     ChildHrUserExperiencesQuery orderByHrexId($order = Criteria::ASC) Order by the hrex_id column
 * @method     ChildHrUserExperiencesQuery orderByEmployeeId($order = Criteria::ASC) Order by the employee_id column
 * @method     ChildHrUserExperiencesQuery orderByNameOfCompany($order = Criteria::ASC) Order by the name_of_company column
 * @method     ChildHrUserExperiencesQuery orderByDesignation($order = Criteria::ASC) Order by the designation column
 * @method     ChildHrUserExperiencesQuery orderByFromDate($order = Criteria::ASC) Order by the from_date column
 * @method     ChildHrUserExperiencesQuery orderByToDate($order = Criteria::ASC) Order by the to_date column
 * @method     ChildHrUserExperiencesQuery orderByJob($order = Criteria::ASC) Order by the job column
 * @method     ChildHrUserExperiencesQuery orderByStartSalary($order = Criteria::ASC) Order by the start_salary column
 * @method     ChildHrUserExperiencesQuery orderByEndSalary($order = Criteria::ASC) Order by the end_salary column
 * @method     ChildHrUserExperiencesQuery orderByReasonForDepart($order = Criteria::ASC) Order by the reason_for_depart column
 * @method     ChildHrUserExperiencesQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildHrUserExperiencesQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildHrUserExperiencesQuery groupByHrexId() Group by the hrex_id column
 * @method     ChildHrUserExperiencesQuery groupByEmployeeId() Group by the employee_id column
 * @method     ChildHrUserExperiencesQuery groupByNameOfCompany() Group by the name_of_company column
 * @method     ChildHrUserExperiencesQuery groupByDesignation() Group by the designation column
 * @method     ChildHrUserExperiencesQuery groupByFromDate() Group by the from_date column
 * @method     ChildHrUserExperiencesQuery groupByToDate() Group by the to_date column
 * @method     ChildHrUserExperiencesQuery groupByJob() Group by the job column
 * @method     ChildHrUserExperiencesQuery groupByStartSalary() Group by the start_salary column
 * @method     ChildHrUserExperiencesQuery groupByEndSalary() Group by the end_salary column
 * @method     ChildHrUserExperiencesQuery groupByReasonForDepart() Group by the reason_for_depart column
 * @method     ChildHrUserExperiencesQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildHrUserExperiencesQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildHrUserExperiencesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildHrUserExperiencesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildHrUserExperiencesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildHrUserExperiencesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildHrUserExperiencesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildHrUserExperiencesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildHrUserExperiencesQuery leftJoinEmployee($relationAlias = null) Adds a LEFT JOIN clause to the query using the Employee relation
 * @method     ChildHrUserExperiencesQuery rightJoinEmployee($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Employee relation
 * @method     ChildHrUserExperiencesQuery innerJoinEmployee($relationAlias = null) Adds a INNER JOIN clause to the query using the Employee relation
 *
 * @method     ChildHrUserExperiencesQuery joinWithEmployee($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Employee relation
 *
 * @method     ChildHrUserExperiencesQuery leftJoinWithEmployee() Adds a LEFT JOIN clause and with to the query using the Employee relation
 * @method     ChildHrUserExperiencesQuery rightJoinWithEmployee() Adds a RIGHT JOIN clause and with to the query using the Employee relation
 * @method     ChildHrUserExperiencesQuery innerJoinWithEmployee() Adds a INNER JOIN clause and with to the query using the Employee relation
 *
 * @method     \entities\EmployeeQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildHrUserExperiences|null findOne(?ConnectionInterface $con = null) Return the first ChildHrUserExperiences matching the query
 * @method     ChildHrUserExperiences findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildHrUserExperiences matching the query, or a new ChildHrUserExperiences object populated from the query conditions when no match is found
 *
 * @method     ChildHrUserExperiences|null findOneByHrexId(int $hrex_id) Return the first ChildHrUserExperiences filtered by the hrex_id column
 * @method     ChildHrUserExperiences|null findOneByEmployeeId(int $employee_id) Return the first ChildHrUserExperiences filtered by the employee_id column
 * @method     ChildHrUserExperiences|null findOneByNameOfCompany(string $name_of_company) Return the first ChildHrUserExperiences filtered by the name_of_company column
 * @method     ChildHrUserExperiences|null findOneByDesignation(string $designation) Return the first ChildHrUserExperiences filtered by the designation column
 * @method     ChildHrUserExperiences|null findOneByFromDate(string $from_date) Return the first ChildHrUserExperiences filtered by the from_date column
 * @method     ChildHrUserExperiences|null findOneByToDate(string $to_date) Return the first ChildHrUserExperiences filtered by the to_date column
 * @method     ChildHrUserExperiences|null findOneByJob(string $job) Return the first ChildHrUserExperiences filtered by the job column
 * @method     ChildHrUserExperiences|null findOneByStartSalary(double $start_salary) Return the first ChildHrUserExperiences filtered by the start_salary column
 * @method     ChildHrUserExperiences|null findOneByEndSalary(double $end_salary) Return the first ChildHrUserExperiences filtered by the end_salary column
 * @method     ChildHrUserExperiences|null findOneByReasonForDepart(string $reason_for_depart) Return the first ChildHrUserExperiences filtered by the reason_for_depart column
 * @method     ChildHrUserExperiences|null findOneByCreatedAt(string $created_at) Return the first ChildHrUserExperiences filtered by the created_at column
 * @method     ChildHrUserExperiences|null findOneByUpdatedAt(string $updated_at) Return the first ChildHrUserExperiences filtered by the updated_at column
 *
 * @method     ChildHrUserExperiences requirePk($key, ?ConnectionInterface $con = null) Return the ChildHrUserExperiences by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHrUserExperiences requireOne(?ConnectionInterface $con = null) Return the first ChildHrUserExperiences matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildHrUserExperiences requireOneByHrexId(int $hrex_id) Return the first ChildHrUserExperiences filtered by the hrex_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHrUserExperiences requireOneByEmployeeId(int $employee_id) Return the first ChildHrUserExperiences filtered by the employee_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHrUserExperiences requireOneByNameOfCompany(string $name_of_company) Return the first ChildHrUserExperiences filtered by the name_of_company column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHrUserExperiences requireOneByDesignation(string $designation) Return the first ChildHrUserExperiences filtered by the designation column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHrUserExperiences requireOneByFromDate(string $from_date) Return the first ChildHrUserExperiences filtered by the from_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHrUserExperiences requireOneByToDate(string $to_date) Return the first ChildHrUserExperiences filtered by the to_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHrUserExperiences requireOneByJob(string $job) Return the first ChildHrUserExperiences filtered by the job column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHrUserExperiences requireOneByStartSalary(double $start_salary) Return the first ChildHrUserExperiences filtered by the start_salary column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHrUserExperiences requireOneByEndSalary(double $end_salary) Return the first ChildHrUserExperiences filtered by the end_salary column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHrUserExperiences requireOneByReasonForDepart(string $reason_for_depart) Return the first ChildHrUserExperiences filtered by the reason_for_depart column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHrUserExperiences requireOneByCreatedAt(string $created_at) Return the first ChildHrUserExperiences filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHrUserExperiences requireOneByUpdatedAt(string $updated_at) Return the first ChildHrUserExperiences filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildHrUserExperiences[]|Collection find(?ConnectionInterface $con = null) Return ChildHrUserExperiences objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildHrUserExperiences> find(?ConnectionInterface $con = null) Return ChildHrUserExperiences objects based on current ModelCriteria
 *
 * @method     ChildHrUserExperiences[]|Collection findByHrexId(int|array<int> $hrex_id) Return ChildHrUserExperiences objects filtered by the hrex_id column
 * @psalm-method Collection&\Traversable<ChildHrUserExperiences> findByHrexId(int|array<int> $hrex_id) Return ChildHrUserExperiences objects filtered by the hrex_id column
 * @method     ChildHrUserExperiences[]|Collection findByEmployeeId(int|array<int> $employee_id) Return ChildHrUserExperiences objects filtered by the employee_id column
 * @psalm-method Collection&\Traversable<ChildHrUserExperiences> findByEmployeeId(int|array<int> $employee_id) Return ChildHrUserExperiences objects filtered by the employee_id column
 * @method     ChildHrUserExperiences[]|Collection findByNameOfCompany(string|array<string> $name_of_company) Return ChildHrUserExperiences objects filtered by the name_of_company column
 * @psalm-method Collection&\Traversable<ChildHrUserExperiences> findByNameOfCompany(string|array<string> $name_of_company) Return ChildHrUserExperiences objects filtered by the name_of_company column
 * @method     ChildHrUserExperiences[]|Collection findByDesignation(string|array<string> $designation) Return ChildHrUserExperiences objects filtered by the designation column
 * @psalm-method Collection&\Traversable<ChildHrUserExperiences> findByDesignation(string|array<string> $designation) Return ChildHrUserExperiences objects filtered by the designation column
 * @method     ChildHrUserExperiences[]|Collection findByFromDate(string|array<string> $from_date) Return ChildHrUserExperiences objects filtered by the from_date column
 * @psalm-method Collection&\Traversable<ChildHrUserExperiences> findByFromDate(string|array<string> $from_date) Return ChildHrUserExperiences objects filtered by the from_date column
 * @method     ChildHrUserExperiences[]|Collection findByToDate(string|array<string> $to_date) Return ChildHrUserExperiences objects filtered by the to_date column
 * @psalm-method Collection&\Traversable<ChildHrUserExperiences> findByToDate(string|array<string> $to_date) Return ChildHrUserExperiences objects filtered by the to_date column
 * @method     ChildHrUserExperiences[]|Collection findByJob(string|array<string> $job) Return ChildHrUserExperiences objects filtered by the job column
 * @psalm-method Collection&\Traversable<ChildHrUserExperiences> findByJob(string|array<string> $job) Return ChildHrUserExperiences objects filtered by the job column
 * @method     ChildHrUserExperiences[]|Collection findByStartSalary(double|array<double> $start_salary) Return ChildHrUserExperiences objects filtered by the start_salary column
 * @psalm-method Collection&\Traversable<ChildHrUserExperiences> findByStartSalary(double|array<double> $start_salary) Return ChildHrUserExperiences objects filtered by the start_salary column
 * @method     ChildHrUserExperiences[]|Collection findByEndSalary(double|array<double> $end_salary) Return ChildHrUserExperiences objects filtered by the end_salary column
 * @psalm-method Collection&\Traversable<ChildHrUserExperiences> findByEndSalary(double|array<double> $end_salary) Return ChildHrUserExperiences objects filtered by the end_salary column
 * @method     ChildHrUserExperiences[]|Collection findByReasonForDepart(string|array<string> $reason_for_depart) Return ChildHrUserExperiences objects filtered by the reason_for_depart column
 * @psalm-method Collection&\Traversable<ChildHrUserExperiences> findByReasonForDepart(string|array<string> $reason_for_depart) Return ChildHrUserExperiences objects filtered by the reason_for_depart column
 * @method     ChildHrUserExperiences[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildHrUserExperiences objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildHrUserExperiences> findByCreatedAt(string|array<string> $created_at) Return ChildHrUserExperiences objects filtered by the created_at column
 * @method     ChildHrUserExperiences[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildHrUserExperiences objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildHrUserExperiences> findByUpdatedAt(string|array<string> $updated_at) Return ChildHrUserExperiences objects filtered by the updated_at column
 *
 * @method     ChildHrUserExperiences[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildHrUserExperiences> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class HrUserExperiencesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\HrUserExperiencesQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\HrUserExperiences', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildHrUserExperiencesQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildHrUserExperiencesQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildHrUserExperiencesQuery) {
            return $criteria;
        }
        $query = new ChildHrUserExperiencesQuery();
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
     * @return ChildHrUserExperiences|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(HrUserExperiencesTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = HrUserExperiencesTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildHrUserExperiences A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT hrex_id, employee_id, name_of_company, designation, from_date, to_date, job, start_salary, end_salary, reason_for_depart, created_at, updated_at FROM hr_user_experiences WHERE hrex_id = :p0';
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
            /** @var ChildHrUserExperiences $obj */
            $obj = new ChildHrUserExperiences();
            $obj->hydrate($row);
            HrUserExperiencesTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildHrUserExperiences|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(HrUserExperiencesTableMap::COL_HREX_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(HrUserExperiencesTableMap::COL_HREX_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the hrex_id column
     *
     * Example usage:
     * <code>
     * $query->filterByHrexId(1234); // WHERE hrex_id = 1234
     * $query->filterByHrexId(array(12, 34)); // WHERE hrex_id IN (12, 34)
     * $query->filterByHrexId(array('min' => 12)); // WHERE hrex_id > 12
     * </code>
     *
     * @param mixed $hrexId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByHrexId($hrexId = null, ?string $comparison = null)
    {
        if (is_array($hrexId)) {
            $useMinMax = false;
            if (isset($hrexId['min'])) {
                $this->addUsingAlias(HrUserExperiencesTableMap::COL_HREX_ID, $hrexId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($hrexId['max'])) {
                $this->addUsingAlias(HrUserExperiencesTableMap::COL_HREX_ID, $hrexId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(HrUserExperiencesTableMap::COL_HREX_ID, $hrexId, $comparison);

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
                $this->addUsingAlias(HrUserExperiencesTableMap::COL_EMPLOYEE_ID, $employeeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($employeeId['max'])) {
                $this->addUsingAlias(HrUserExperiencesTableMap::COL_EMPLOYEE_ID, $employeeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(HrUserExperiencesTableMap::COL_EMPLOYEE_ID, $employeeId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the name_of_company column
     *
     * Example usage:
     * <code>
     * $query->filterByNameOfCompany('fooValue');   // WHERE name_of_company = 'fooValue'
     * $query->filterByNameOfCompany('%fooValue%', Criteria::LIKE); // WHERE name_of_company LIKE '%fooValue%'
     * $query->filterByNameOfCompany(['foo', 'bar']); // WHERE name_of_company IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $nameOfCompany The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByNameOfCompany($nameOfCompany = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nameOfCompany)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(HrUserExperiencesTableMap::COL_NAME_OF_COMPANY, $nameOfCompany, $comparison);

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

        $this->addUsingAlias(HrUserExperiencesTableMap::COL_DESIGNATION, $designation, $comparison);

        return $this;
    }

    /**
     * Filter the query on the from_date column
     *
     * Example usage:
     * <code>
     * $query->filterByFromDate('2011-03-14'); // WHERE from_date = '2011-03-14'
     * $query->filterByFromDate('now'); // WHERE from_date = '2011-03-14'
     * $query->filterByFromDate(array('max' => 'yesterday')); // WHERE from_date > '2011-03-13'
     * </code>
     *
     * @param mixed $fromDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFromDate($fromDate = null, ?string $comparison = null)
    {
        if (is_array($fromDate)) {
            $useMinMax = false;
            if (isset($fromDate['min'])) {
                $this->addUsingAlias(HrUserExperiencesTableMap::COL_FROM_DATE, $fromDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fromDate['max'])) {
                $this->addUsingAlias(HrUserExperiencesTableMap::COL_FROM_DATE, $fromDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(HrUserExperiencesTableMap::COL_FROM_DATE, $fromDate, $comparison);

        return $this;
    }

    /**
     * Filter the query on the to_date column
     *
     * Example usage:
     * <code>
     * $query->filterByToDate('2011-03-14'); // WHERE to_date = '2011-03-14'
     * $query->filterByToDate('now'); // WHERE to_date = '2011-03-14'
     * $query->filterByToDate(array('max' => 'yesterday')); // WHERE to_date > '2011-03-13'
     * </code>
     *
     * @param mixed $toDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByToDate($toDate = null, ?string $comparison = null)
    {
        if (is_array($toDate)) {
            $useMinMax = false;
            if (isset($toDate['min'])) {
                $this->addUsingAlias(HrUserExperiencesTableMap::COL_TO_DATE, $toDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($toDate['max'])) {
                $this->addUsingAlias(HrUserExperiencesTableMap::COL_TO_DATE, $toDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(HrUserExperiencesTableMap::COL_TO_DATE, $toDate, $comparison);

        return $this;
    }

    /**
     * Filter the query on the job column
     *
     * Example usage:
     * <code>
     * $query->filterByJob('fooValue');   // WHERE job = 'fooValue'
     * $query->filterByJob('%fooValue%', Criteria::LIKE); // WHERE job LIKE '%fooValue%'
     * $query->filterByJob(['foo', 'bar']); // WHERE job IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $job The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByJob($job = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($job)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(HrUserExperiencesTableMap::COL_JOB, $job, $comparison);

        return $this;
    }

    /**
     * Filter the query on the start_salary column
     *
     * Example usage:
     * <code>
     * $query->filterByStartSalary(1234); // WHERE start_salary = 1234
     * $query->filterByStartSalary(array(12, 34)); // WHERE start_salary IN (12, 34)
     * $query->filterByStartSalary(array('min' => 12)); // WHERE start_salary > 12
     * </code>
     *
     * @param mixed $startSalary The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStartSalary($startSalary = null, ?string $comparison = null)
    {
        if (is_array($startSalary)) {
            $useMinMax = false;
            if (isset($startSalary['min'])) {
                $this->addUsingAlias(HrUserExperiencesTableMap::COL_START_SALARY, $startSalary['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($startSalary['max'])) {
                $this->addUsingAlias(HrUserExperiencesTableMap::COL_START_SALARY, $startSalary['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(HrUserExperiencesTableMap::COL_START_SALARY, $startSalary, $comparison);

        return $this;
    }

    /**
     * Filter the query on the end_salary column
     *
     * Example usage:
     * <code>
     * $query->filterByEndSalary(1234); // WHERE end_salary = 1234
     * $query->filterByEndSalary(array(12, 34)); // WHERE end_salary IN (12, 34)
     * $query->filterByEndSalary(array('min' => 12)); // WHERE end_salary > 12
     * </code>
     *
     * @param mixed $endSalary The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEndSalary($endSalary = null, ?string $comparison = null)
    {
        if (is_array($endSalary)) {
            $useMinMax = false;
            if (isset($endSalary['min'])) {
                $this->addUsingAlias(HrUserExperiencesTableMap::COL_END_SALARY, $endSalary['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($endSalary['max'])) {
                $this->addUsingAlias(HrUserExperiencesTableMap::COL_END_SALARY, $endSalary['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(HrUserExperiencesTableMap::COL_END_SALARY, $endSalary, $comparison);

        return $this;
    }

    /**
     * Filter the query on the reason_for_depart column
     *
     * Example usage:
     * <code>
     * $query->filterByReasonForDepart('fooValue');   // WHERE reason_for_depart = 'fooValue'
     * $query->filterByReasonForDepart('%fooValue%', Criteria::LIKE); // WHERE reason_for_depart LIKE '%fooValue%'
     * $query->filterByReasonForDepart(['foo', 'bar']); // WHERE reason_for_depart IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $reasonForDepart The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByReasonForDepart($reasonForDepart = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($reasonForDepart)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(HrUserExperiencesTableMap::COL_REASON_FOR_DEPART, $reasonForDepart, $comparison);

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
                $this->addUsingAlias(HrUserExperiencesTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(HrUserExperiencesTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(HrUserExperiencesTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(HrUserExperiencesTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(HrUserExperiencesTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(HrUserExperiencesTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

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
                ->addUsingAlias(HrUserExperiencesTableMap::COL_EMPLOYEE_ID, $employee->getEmployeeId(), $comparison);
        } elseif ($employee instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(HrUserExperiencesTableMap::COL_EMPLOYEE_ID, $employee->toKeyValue('PrimaryKey', 'EmployeeId'), $comparison);

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
     * @param ChildHrUserExperiences $hrUserExperiences Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($hrUserExperiences = null)
    {
        if ($hrUserExperiences) {
            $this->addUsingAlias(HrUserExperiencesTableMap::COL_HREX_ID, $hrUserExperiences->getHrexId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the hr_user_experiences table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(HrUserExperiencesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            HrUserExperiencesTableMap::clearInstancePool();
            HrUserExperiencesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(HrUserExperiencesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(HrUserExperiencesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            HrUserExperiencesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            HrUserExperiencesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
