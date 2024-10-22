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
use entities\HrUserAccount as ChildHrUserAccount;
use entities\HrUserAccountQuery as ChildHrUserAccountQuery;
use entities\Map\HrUserAccountTableMap;

/**
 * Base class that represents a query for the `hr_user_account` table.
 *
 * @method     ChildHrUserAccountQuery orderByHruaId($order = Criteria::ASC) Order by the hrua_id column
 * @method     ChildHrUserAccountQuery orderByEmployeeId($order = Criteria::ASC) Order by the employee_id column
 * @method     ChildHrUserAccountQuery orderByPersonalBank($order = Criteria::ASC) Order by the personal_bank column
 * @method     ChildHrUserAccountQuery orderByPersonalAccountNumber($order = Criteria::ASC) Order by the personal_account_number column
 * @method     ChildHrUserAccountQuery orderByPfEsicContribution($order = Criteria::ASC) Order by the pf_esic_contribution column
 * @method     ChildHrUserAccountQuery orderByPfNumber($order = Criteria::ASC) Order by the pf_number column
 * @method     ChildHrUserAccountQuery orderByEsciNumber($order = Criteria::ASC) Order by the esci_number column
 * @method     ChildHrUserAccountQuery orderByGrossSalary($order = Criteria::ASC) Order by the gross_salary column
 * @method     ChildHrUserAccountQuery orderByPaymentMode($order = Criteria::ASC) Order by the payment_mode column
 * @method     ChildHrUserAccountQuery orderBySalaryBank($order = Criteria::ASC) Order by the salary_bank column
 * @method     ChildHrUserAccountQuery orderBySalaryAccountNumber($order = Criteria::ASC) Order by the salary_account_number column
 * @method     ChildHrUserAccountQuery orderByTdsStatus($order = Criteria::ASC) Order by the tds_status column
 * @method     ChildHrUserAccountQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildHrUserAccountQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildHrUserAccountQuery groupByHruaId() Group by the hrua_id column
 * @method     ChildHrUserAccountQuery groupByEmployeeId() Group by the employee_id column
 * @method     ChildHrUserAccountQuery groupByPersonalBank() Group by the personal_bank column
 * @method     ChildHrUserAccountQuery groupByPersonalAccountNumber() Group by the personal_account_number column
 * @method     ChildHrUserAccountQuery groupByPfEsicContribution() Group by the pf_esic_contribution column
 * @method     ChildHrUserAccountQuery groupByPfNumber() Group by the pf_number column
 * @method     ChildHrUserAccountQuery groupByEsciNumber() Group by the esci_number column
 * @method     ChildHrUserAccountQuery groupByGrossSalary() Group by the gross_salary column
 * @method     ChildHrUserAccountQuery groupByPaymentMode() Group by the payment_mode column
 * @method     ChildHrUserAccountQuery groupBySalaryBank() Group by the salary_bank column
 * @method     ChildHrUserAccountQuery groupBySalaryAccountNumber() Group by the salary_account_number column
 * @method     ChildHrUserAccountQuery groupByTdsStatus() Group by the tds_status column
 * @method     ChildHrUserAccountQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildHrUserAccountQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildHrUserAccountQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildHrUserAccountQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildHrUserAccountQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildHrUserAccountQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildHrUserAccountQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildHrUserAccountQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildHrUserAccountQuery leftJoinEmployee($relationAlias = null) Adds a LEFT JOIN clause to the query using the Employee relation
 * @method     ChildHrUserAccountQuery rightJoinEmployee($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Employee relation
 * @method     ChildHrUserAccountQuery innerJoinEmployee($relationAlias = null) Adds a INNER JOIN clause to the query using the Employee relation
 *
 * @method     ChildHrUserAccountQuery joinWithEmployee($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Employee relation
 *
 * @method     ChildHrUserAccountQuery leftJoinWithEmployee() Adds a LEFT JOIN clause and with to the query using the Employee relation
 * @method     ChildHrUserAccountQuery rightJoinWithEmployee() Adds a RIGHT JOIN clause and with to the query using the Employee relation
 * @method     ChildHrUserAccountQuery innerJoinWithEmployee() Adds a INNER JOIN clause and with to the query using the Employee relation
 *
 * @method     \entities\EmployeeQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildHrUserAccount|null findOne(?ConnectionInterface $con = null) Return the first ChildHrUserAccount matching the query
 * @method     ChildHrUserAccount findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildHrUserAccount matching the query, or a new ChildHrUserAccount object populated from the query conditions when no match is found
 *
 * @method     ChildHrUserAccount|null findOneByHruaId(int $hrua_id) Return the first ChildHrUserAccount filtered by the hrua_id column
 * @method     ChildHrUserAccount|null findOneByEmployeeId(int $employee_id) Return the first ChildHrUserAccount filtered by the employee_id column
 * @method     ChildHrUserAccount|null findOneByPersonalBank(string $personal_bank) Return the first ChildHrUserAccount filtered by the personal_bank column
 * @method     ChildHrUserAccount|null findOneByPersonalAccountNumber(string $personal_account_number) Return the first ChildHrUserAccount filtered by the personal_account_number column
 * @method     ChildHrUserAccount|null findOneByPfEsicContribution(int $pf_esic_contribution) Return the first ChildHrUserAccount filtered by the pf_esic_contribution column
 * @method     ChildHrUserAccount|null findOneByPfNumber(string $pf_number) Return the first ChildHrUserAccount filtered by the pf_number column
 * @method     ChildHrUserAccount|null findOneByEsciNumber(string $esci_number) Return the first ChildHrUserAccount filtered by the esci_number column
 * @method     ChildHrUserAccount|null findOneByGrossSalary(double $gross_salary) Return the first ChildHrUserAccount filtered by the gross_salary column
 * @method     ChildHrUserAccount|null findOneByPaymentMode(string $payment_mode) Return the first ChildHrUserAccount filtered by the payment_mode column
 * @method     ChildHrUserAccount|null findOneBySalaryBank(string $salary_bank) Return the first ChildHrUserAccount filtered by the salary_bank column
 * @method     ChildHrUserAccount|null findOneBySalaryAccountNumber(string $salary_account_number) Return the first ChildHrUserAccount filtered by the salary_account_number column
 * @method     ChildHrUserAccount|null findOneByTdsStatus(int $tds_status) Return the first ChildHrUserAccount filtered by the tds_status column
 * @method     ChildHrUserAccount|null findOneByCreatedAt(string $created_at) Return the first ChildHrUserAccount filtered by the created_at column
 * @method     ChildHrUserAccount|null findOneByUpdatedAt(string $updated_at) Return the first ChildHrUserAccount filtered by the updated_at column
 *
 * @method     ChildHrUserAccount requirePk($key, ?ConnectionInterface $con = null) Return the ChildHrUserAccount by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHrUserAccount requireOne(?ConnectionInterface $con = null) Return the first ChildHrUserAccount matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildHrUserAccount requireOneByHruaId(int $hrua_id) Return the first ChildHrUserAccount filtered by the hrua_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHrUserAccount requireOneByEmployeeId(int $employee_id) Return the first ChildHrUserAccount filtered by the employee_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHrUserAccount requireOneByPersonalBank(string $personal_bank) Return the first ChildHrUserAccount filtered by the personal_bank column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHrUserAccount requireOneByPersonalAccountNumber(string $personal_account_number) Return the first ChildHrUserAccount filtered by the personal_account_number column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHrUserAccount requireOneByPfEsicContribution(int $pf_esic_contribution) Return the first ChildHrUserAccount filtered by the pf_esic_contribution column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHrUserAccount requireOneByPfNumber(string $pf_number) Return the first ChildHrUserAccount filtered by the pf_number column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHrUserAccount requireOneByEsciNumber(string $esci_number) Return the first ChildHrUserAccount filtered by the esci_number column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHrUserAccount requireOneByGrossSalary(double $gross_salary) Return the first ChildHrUserAccount filtered by the gross_salary column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHrUserAccount requireOneByPaymentMode(string $payment_mode) Return the first ChildHrUserAccount filtered by the payment_mode column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHrUserAccount requireOneBySalaryBank(string $salary_bank) Return the first ChildHrUserAccount filtered by the salary_bank column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHrUserAccount requireOneBySalaryAccountNumber(string $salary_account_number) Return the first ChildHrUserAccount filtered by the salary_account_number column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHrUserAccount requireOneByTdsStatus(int $tds_status) Return the first ChildHrUserAccount filtered by the tds_status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHrUserAccount requireOneByCreatedAt(string $created_at) Return the first ChildHrUserAccount filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHrUserAccount requireOneByUpdatedAt(string $updated_at) Return the first ChildHrUserAccount filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildHrUserAccount[]|Collection find(?ConnectionInterface $con = null) Return ChildHrUserAccount objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildHrUserAccount> find(?ConnectionInterface $con = null) Return ChildHrUserAccount objects based on current ModelCriteria
 *
 * @method     ChildHrUserAccount[]|Collection findByHruaId(int|array<int> $hrua_id) Return ChildHrUserAccount objects filtered by the hrua_id column
 * @psalm-method Collection&\Traversable<ChildHrUserAccount> findByHruaId(int|array<int> $hrua_id) Return ChildHrUserAccount objects filtered by the hrua_id column
 * @method     ChildHrUserAccount[]|Collection findByEmployeeId(int|array<int> $employee_id) Return ChildHrUserAccount objects filtered by the employee_id column
 * @psalm-method Collection&\Traversable<ChildHrUserAccount> findByEmployeeId(int|array<int> $employee_id) Return ChildHrUserAccount objects filtered by the employee_id column
 * @method     ChildHrUserAccount[]|Collection findByPersonalBank(string|array<string> $personal_bank) Return ChildHrUserAccount objects filtered by the personal_bank column
 * @psalm-method Collection&\Traversable<ChildHrUserAccount> findByPersonalBank(string|array<string> $personal_bank) Return ChildHrUserAccount objects filtered by the personal_bank column
 * @method     ChildHrUserAccount[]|Collection findByPersonalAccountNumber(string|array<string> $personal_account_number) Return ChildHrUserAccount objects filtered by the personal_account_number column
 * @psalm-method Collection&\Traversable<ChildHrUserAccount> findByPersonalAccountNumber(string|array<string> $personal_account_number) Return ChildHrUserAccount objects filtered by the personal_account_number column
 * @method     ChildHrUserAccount[]|Collection findByPfEsicContribution(int|array<int> $pf_esic_contribution) Return ChildHrUserAccount objects filtered by the pf_esic_contribution column
 * @psalm-method Collection&\Traversable<ChildHrUserAccount> findByPfEsicContribution(int|array<int> $pf_esic_contribution) Return ChildHrUserAccount objects filtered by the pf_esic_contribution column
 * @method     ChildHrUserAccount[]|Collection findByPfNumber(string|array<string> $pf_number) Return ChildHrUserAccount objects filtered by the pf_number column
 * @psalm-method Collection&\Traversable<ChildHrUserAccount> findByPfNumber(string|array<string> $pf_number) Return ChildHrUserAccount objects filtered by the pf_number column
 * @method     ChildHrUserAccount[]|Collection findByEsciNumber(string|array<string> $esci_number) Return ChildHrUserAccount objects filtered by the esci_number column
 * @psalm-method Collection&\Traversable<ChildHrUserAccount> findByEsciNumber(string|array<string> $esci_number) Return ChildHrUserAccount objects filtered by the esci_number column
 * @method     ChildHrUserAccount[]|Collection findByGrossSalary(double|array<double> $gross_salary) Return ChildHrUserAccount objects filtered by the gross_salary column
 * @psalm-method Collection&\Traversable<ChildHrUserAccount> findByGrossSalary(double|array<double> $gross_salary) Return ChildHrUserAccount objects filtered by the gross_salary column
 * @method     ChildHrUserAccount[]|Collection findByPaymentMode(string|array<string> $payment_mode) Return ChildHrUserAccount objects filtered by the payment_mode column
 * @psalm-method Collection&\Traversable<ChildHrUserAccount> findByPaymentMode(string|array<string> $payment_mode) Return ChildHrUserAccount objects filtered by the payment_mode column
 * @method     ChildHrUserAccount[]|Collection findBySalaryBank(string|array<string> $salary_bank) Return ChildHrUserAccount objects filtered by the salary_bank column
 * @psalm-method Collection&\Traversable<ChildHrUserAccount> findBySalaryBank(string|array<string> $salary_bank) Return ChildHrUserAccount objects filtered by the salary_bank column
 * @method     ChildHrUserAccount[]|Collection findBySalaryAccountNumber(string|array<string> $salary_account_number) Return ChildHrUserAccount objects filtered by the salary_account_number column
 * @psalm-method Collection&\Traversable<ChildHrUserAccount> findBySalaryAccountNumber(string|array<string> $salary_account_number) Return ChildHrUserAccount objects filtered by the salary_account_number column
 * @method     ChildHrUserAccount[]|Collection findByTdsStatus(int|array<int> $tds_status) Return ChildHrUserAccount objects filtered by the tds_status column
 * @psalm-method Collection&\Traversable<ChildHrUserAccount> findByTdsStatus(int|array<int> $tds_status) Return ChildHrUserAccount objects filtered by the tds_status column
 * @method     ChildHrUserAccount[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildHrUserAccount objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildHrUserAccount> findByCreatedAt(string|array<string> $created_at) Return ChildHrUserAccount objects filtered by the created_at column
 * @method     ChildHrUserAccount[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildHrUserAccount objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildHrUserAccount> findByUpdatedAt(string|array<string> $updated_at) Return ChildHrUserAccount objects filtered by the updated_at column
 *
 * @method     ChildHrUserAccount[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildHrUserAccount> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class HrUserAccountQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\HrUserAccountQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\HrUserAccount', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildHrUserAccountQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildHrUserAccountQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildHrUserAccountQuery) {
            return $criteria;
        }
        $query = new ChildHrUserAccountQuery();
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
     * @return ChildHrUserAccount|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(HrUserAccountTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = HrUserAccountTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildHrUserAccount A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT hrua_id, employee_id, personal_bank, personal_account_number, pf_esic_contribution, pf_number, esci_number, gross_salary, payment_mode, salary_bank, salary_account_number, tds_status, created_at, updated_at FROM hr_user_account WHERE hrua_id = :p0';
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
            /** @var ChildHrUserAccount $obj */
            $obj = new ChildHrUserAccount();
            $obj->hydrate($row);
            HrUserAccountTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildHrUserAccount|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(HrUserAccountTableMap::COL_HRUA_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(HrUserAccountTableMap::COL_HRUA_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the hrua_id column
     *
     * Example usage:
     * <code>
     * $query->filterByHruaId(1234); // WHERE hrua_id = 1234
     * $query->filterByHruaId(array(12, 34)); // WHERE hrua_id IN (12, 34)
     * $query->filterByHruaId(array('min' => 12)); // WHERE hrua_id > 12
     * </code>
     *
     * @param mixed $hruaId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByHruaId($hruaId = null, ?string $comparison = null)
    {
        if (is_array($hruaId)) {
            $useMinMax = false;
            if (isset($hruaId['min'])) {
                $this->addUsingAlias(HrUserAccountTableMap::COL_HRUA_ID, $hruaId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($hruaId['max'])) {
                $this->addUsingAlias(HrUserAccountTableMap::COL_HRUA_ID, $hruaId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(HrUserAccountTableMap::COL_HRUA_ID, $hruaId, $comparison);

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
                $this->addUsingAlias(HrUserAccountTableMap::COL_EMPLOYEE_ID, $employeeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($employeeId['max'])) {
                $this->addUsingAlias(HrUserAccountTableMap::COL_EMPLOYEE_ID, $employeeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(HrUserAccountTableMap::COL_EMPLOYEE_ID, $employeeId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the personal_bank column
     *
     * Example usage:
     * <code>
     * $query->filterByPersonalBank('fooValue');   // WHERE personal_bank = 'fooValue'
     * $query->filterByPersonalBank('%fooValue%', Criteria::LIKE); // WHERE personal_bank LIKE '%fooValue%'
     * $query->filterByPersonalBank(['foo', 'bar']); // WHERE personal_bank IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $personalBank The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPersonalBank($personalBank = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($personalBank)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(HrUserAccountTableMap::COL_PERSONAL_BANK, $personalBank, $comparison);

        return $this;
    }

    /**
     * Filter the query on the personal_account_number column
     *
     * Example usage:
     * <code>
     * $query->filterByPersonalAccountNumber('fooValue');   // WHERE personal_account_number = 'fooValue'
     * $query->filterByPersonalAccountNumber('%fooValue%', Criteria::LIKE); // WHERE personal_account_number LIKE '%fooValue%'
     * $query->filterByPersonalAccountNumber(['foo', 'bar']); // WHERE personal_account_number IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $personalAccountNumber The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPersonalAccountNumber($personalAccountNumber = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($personalAccountNumber)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(HrUserAccountTableMap::COL_PERSONAL_ACCOUNT_NUMBER, $personalAccountNumber, $comparison);

        return $this;
    }

    /**
     * Filter the query on the pf_esic_contribution column
     *
     * Example usage:
     * <code>
     * $query->filterByPfEsicContribution(1234); // WHERE pf_esic_contribution = 1234
     * $query->filterByPfEsicContribution(array(12, 34)); // WHERE pf_esic_contribution IN (12, 34)
     * $query->filterByPfEsicContribution(array('min' => 12)); // WHERE pf_esic_contribution > 12
     * </code>
     *
     * @param mixed $pfEsicContribution The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPfEsicContribution($pfEsicContribution = null, ?string $comparison = null)
    {
        if (is_array($pfEsicContribution)) {
            $useMinMax = false;
            if (isset($pfEsicContribution['min'])) {
                $this->addUsingAlias(HrUserAccountTableMap::COL_PF_ESIC_CONTRIBUTION, $pfEsicContribution['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($pfEsicContribution['max'])) {
                $this->addUsingAlias(HrUserAccountTableMap::COL_PF_ESIC_CONTRIBUTION, $pfEsicContribution['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(HrUserAccountTableMap::COL_PF_ESIC_CONTRIBUTION, $pfEsicContribution, $comparison);

        return $this;
    }

    /**
     * Filter the query on the pf_number column
     *
     * Example usage:
     * <code>
     * $query->filterByPfNumber('fooValue');   // WHERE pf_number = 'fooValue'
     * $query->filterByPfNumber('%fooValue%', Criteria::LIKE); // WHERE pf_number LIKE '%fooValue%'
     * $query->filterByPfNumber(['foo', 'bar']); // WHERE pf_number IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $pfNumber The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPfNumber($pfNumber = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($pfNumber)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(HrUserAccountTableMap::COL_PF_NUMBER, $pfNumber, $comparison);

        return $this;
    }

    /**
     * Filter the query on the esci_number column
     *
     * Example usage:
     * <code>
     * $query->filterByEsciNumber('fooValue');   // WHERE esci_number = 'fooValue'
     * $query->filterByEsciNumber('%fooValue%', Criteria::LIKE); // WHERE esci_number LIKE '%fooValue%'
     * $query->filterByEsciNumber(['foo', 'bar']); // WHERE esci_number IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $esciNumber The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEsciNumber($esciNumber = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($esciNumber)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(HrUserAccountTableMap::COL_ESCI_NUMBER, $esciNumber, $comparison);

        return $this;
    }

    /**
     * Filter the query on the gross_salary column
     *
     * Example usage:
     * <code>
     * $query->filterByGrossSalary(1234); // WHERE gross_salary = 1234
     * $query->filterByGrossSalary(array(12, 34)); // WHERE gross_salary IN (12, 34)
     * $query->filterByGrossSalary(array('min' => 12)); // WHERE gross_salary > 12
     * </code>
     *
     * @param mixed $grossSalary The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByGrossSalary($grossSalary = null, ?string $comparison = null)
    {
        if (is_array($grossSalary)) {
            $useMinMax = false;
            if (isset($grossSalary['min'])) {
                $this->addUsingAlias(HrUserAccountTableMap::COL_GROSS_SALARY, $grossSalary['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($grossSalary['max'])) {
                $this->addUsingAlias(HrUserAccountTableMap::COL_GROSS_SALARY, $grossSalary['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(HrUserAccountTableMap::COL_GROSS_SALARY, $grossSalary, $comparison);

        return $this;
    }

    /**
     * Filter the query on the payment_mode column
     *
     * Example usage:
     * <code>
     * $query->filterByPaymentMode('fooValue');   // WHERE payment_mode = 'fooValue'
     * $query->filterByPaymentMode('%fooValue%', Criteria::LIKE); // WHERE payment_mode LIKE '%fooValue%'
     * $query->filterByPaymentMode(['foo', 'bar']); // WHERE payment_mode IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $paymentMode The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPaymentMode($paymentMode = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($paymentMode)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(HrUserAccountTableMap::COL_PAYMENT_MODE, $paymentMode, $comparison);

        return $this;
    }

    /**
     * Filter the query on the salary_bank column
     *
     * Example usage:
     * <code>
     * $query->filterBySalaryBank('fooValue');   // WHERE salary_bank = 'fooValue'
     * $query->filterBySalaryBank('%fooValue%', Criteria::LIKE); // WHERE salary_bank LIKE '%fooValue%'
     * $query->filterBySalaryBank(['foo', 'bar']); // WHERE salary_bank IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $salaryBank The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySalaryBank($salaryBank = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($salaryBank)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(HrUserAccountTableMap::COL_SALARY_BANK, $salaryBank, $comparison);

        return $this;
    }

    /**
     * Filter the query on the salary_account_number column
     *
     * Example usage:
     * <code>
     * $query->filterBySalaryAccountNumber('fooValue');   // WHERE salary_account_number = 'fooValue'
     * $query->filterBySalaryAccountNumber('%fooValue%', Criteria::LIKE); // WHERE salary_account_number LIKE '%fooValue%'
     * $query->filterBySalaryAccountNumber(['foo', 'bar']); // WHERE salary_account_number IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $salaryAccountNumber The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySalaryAccountNumber($salaryAccountNumber = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($salaryAccountNumber)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(HrUserAccountTableMap::COL_SALARY_ACCOUNT_NUMBER, $salaryAccountNumber, $comparison);

        return $this;
    }

    /**
     * Filter the query on the tds_status column
     *
     * Example usage:
     * <code>
     * $query->filterByTdsStatus(1234); // WHERE tds_status = 1234
     * $query->filterByTdsStatus(array(12, 34)); // WHERE tds_status IN (12, 34)
     * $query->filterByTdsStatus(array('min' => 12)); // WHERE tds_status > 12
     * </code>
     *
     * @param mixed $tdsStatus The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTdsStatus($tdsStatus = null, ?string $comparison = null)
    {
        if (is_array($tdsStatus)) {
            $useMinMax = false;
            if (isset($tdsStatus['min'])) {
                $this->addUsingAlias(HrUserAccountTableMap::COL_TDS_STATUS, $tdsStatus['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($tdsStatus['max'])) {
                $this->addUsingAlias(HrUserAccountTableMap::COL_TDS_STATUS, $tdsStatus['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(HrUserAccountTableMap::COL_TDS_STATUS, $tdsStatus, $comparison);

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
                $this->addUsingAlias(HrUserAccountTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(HrUserAccountTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(HrUserAccountTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(HrUserAccountTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(HrUserAccountTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(HrUserAccountTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

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
                ->addUsingAlias(HrUserAccountTableMap::COL_EMPLOYEE_ID, $employee->getEmployeeId(), $comparison);
        } elseif ($employee instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(HrUserAccountTableMap::COL_EMPLOYEE_ID, $employee->toKeyValue('PrimaryKey', 'EmployeeId'), $comparison);

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
     * Exclude object from result
     *
     * @param ChildHrUserAccount $hrUserAccount Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($hrUserAccount = null)
    {
        if ($hrUserAccount) {
            $this->addUsingAlias(HrUserAccountTableMap::COL_HRUA_ID, $hrUserAccount->getHruaId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the hr_user_account table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(HrUserAccountTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            HrUserAccountTableMap::clearInstancePool();
            HrUserAccountTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(HrUserAccountTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(HrUserAccountTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            HrUserAccountTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            HrUserAccountTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
