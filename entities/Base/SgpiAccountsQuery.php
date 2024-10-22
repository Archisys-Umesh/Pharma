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
use entities\SgpiAccounts as ChildSgpiAccounts;
use entities\SgpiAccountsQuery as ChildSgpiAccountsQuery;
use entities\Map\SgpiAccountsTableMap;

/**
 * Base class that represents a query for the `sgpi_accounts` table.
 *
 * @method     ChildSgpiAccountsQuery orderBySgpiAccountId($order = Criteria::ASC) Order by the sgpi_account_id column
 * @method     ChildSgpiAccountsQuery orderByAccountName($order = Criteria::ASC) Order by the account_name column
 * @method     ChildSgpiAccountsQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildSgpiAccountsQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildSgpiAccountsQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildSgpiAccountsQuery orderByEmployeeId($order = Criteria::ASC) Order by the employee_id column
 *
 * @method     ChildSgpiAccountsQuery groupBySgpiAccountId() Group by the sgpi_account_id column
 * @method     ChildSgpiAccountsQuery groupByAccountName() Group by the account_name column
 * @method     ChildSgpiAccountsQuery groupByCompanyId() Group by the company_id column
 * @method     ChildSgpiAccountsQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildSgpiAccountsQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildSgpiAccountsQuery groupByEmployeeId() Group by the employee_id column
 *
 * @method     ChildSgpiAccountsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSgpiAccountsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSgpiAccountsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSgpiAccountsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSgpiAccountsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSgpiAccountsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSgpiAccountsQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildSgpiAccountsQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildSgpiAccountsQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildSgpiAccountsQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildSgpiAccountsQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildSgpiAccountsQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildSgpiAccountsQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     ChildSgpiAccountsQuery leftJoinSgpiTrans($relationAlias = null) Adds a LEFT JOIN clause to the query using the SgpiTrans relation
 * @method     ChildSgpiAccountsQuery rightJoinSgpiTrans($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SgpiTrans relation
 * @method     ChildSgpiAccountsQuery innerJoinSgpiTrans($relationAlias = null) Adds a INNER JOIN clause to the query using the SgpiTrans relation
 *
 * @method     ChildSgpiAccountsQuery joinWithSgpiTrans($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SgpiTrans relation
 *
 * @method     ChildSgpiAccountsQuery leftJoinWithSgpiTrans() Adds a LEFT JOIN clause and with to the query using the SgpiTrans relation
 * @method     ChildSgpiAccountsQuery rightJoinWithSgpiTrans() Adds a RIGHT JOIN clause and with to the query using the SgpiTrans relation
 * @method     ChildSgpiAccountsQuery innerJoinWithSgpiTrans() Adds a INNER JOIN clause and with to the query using the SgpiTrans relation
 *
 * @method     \entities\CompanyQuery|\entities\SgpiTransQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSgpiAccounts|null findOne(?ConnectionInterface $con = null) Return the first ChildSgpiAccounts matching the query
 * @method     ChildSgpiAccounts findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSgpiAccounts matching the query, or a new ChildSgpiAccounts object populated from the query conditions when no match is found
 *
 * @method     ChildSgpiAccounts|null findOneBySgpiAccountId(int $sgpi_account_id) Return the first ChildSgpiAccounts filtered by the sgpi_account_id column
 * @method     ChildSgpiAccounts|null findOneByAccountName(string $account_name) Return the first ChildSgpiAccounts filtered by the account_name column
 * @method     ChildSgpiAccounts|null findOneByCompanyId(int $company_id) Return the first ChildSgpiAccounts filtered by the company_id column
 * @method     ChildSgpiAccounts|null findOneByCreatedAt(string $created_at) Return the first ChildSgpiAccounts filtered by the created_at column
 * @method     ChildSgpiAccounts|null findOneByUpdatedAt(string $updated_at) Return the first ChildSgpiAccounts filtered by the updated_at column
 * @method     ChildSgpiAccounts|null findOneByEmployeeId(int $employee_id) Return the first ChildSgpiAccounts filtered by the employee_id column
 *
 * @method     ChildSgpiAccounts requirePk($key, ?ConnectionInterface $con = null) Return the ChildSgpiAccounts by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiAccounts requireOne(?ConnectionInterface $con = null) Return the first ChildSgpiAccounts matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSgpiAccounts requireOneBySgpiAccountId(int $sgpi_account_id) Return the first ChildSgpiAccounts filtered by the sgpi_account_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiAccounts requireOneByAccountName(string $account_name) Return the first ChildSgpiAccounts filtered by the account_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiAccounts requireOneByCompanyId(int $company_id) Return the first ChildSgpiAccounts filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiAccounts requireOneByCreatedAt(string $created_at) Return the first ChildSgpiAccounts filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiAccounts requireOneByUpdatedAt(string $updated_at) Return the first ChildSgpiAccounts filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiAccounts requireOneByEmployeeId(int $employee_id) Return the first ChildSgpiAccounts filtered by the employee_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSgpiAccounts[]|Collection find(?ConnectionInterface $con = null) Return ChildSgpiAccounts objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSgpiAccounts> find(?ConnectionInterface $con = null) Return ChildSgpiAccounts objects based on current ModelCriteria
 *
 * @method     ChildSgpiAccounts[]|Collection findBySgpiAccountId(int|array<int> $sgpi_account_id) Return ChildSgpiAccounts objects filtered by the sgpi_account_id column
 * @psalm-method Collection&\Traversable<ChildSgpiAccounts> findBySgpiAccountId(int|array<int> $sgpi_account_id) Return ChildSgpiAccounts objects filtered by the sgpi_account_id column
 * @method     ChildSgpiAccounts[]|Collection findByAccountName(string|array<string> $account_name) Return ChildSgpiAccounts objects filtered by the account_name column
 * @psalm-method Collection&\Traversable<ChildSgpiAccounts> findByAccountName(string|array<string> $account_name) Return ChildSgpiAccounts objects filtered by the account_name column
 * @method     ChildSgpiAccounts[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildSgpiAccounts objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildSgpiAccounts> findByCompanyId(int|array<int> $company_id) Return ChildSgpiAccounts objects filtered by the company_id column
 * @method     ChildSgpiAccounts[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildSgpiAccounts objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildSgpiAccounts> findByCreatedAt(string|array<string> $created_at) Return ChildSgpiAccounts objects filtered by the created_at column
 * @method     ChildSgpiAccounts[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildSgpiAccounts objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildSgpiAccounts> findByUpdatedAt(string|array<string> $updated_at) Return ChildSgpiAccounts objects filtered by the updated_at column
 * @method     ChildSgpiAccounts[]|Collection findByEmployeeId(int|array<int> $employee_id) Return ChildSgpiAccounts objects filtered by the employee_id column
 * @psalm-method Collection&\Traversable<ChildSgpiAccounts> findByEmployeeId(int|array<int> $employee_id) Return ChildSgpiAccounts objects filtered by the employee_id column
 *
 * @method     ChildSgpiAccounts[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSgpiAccounts> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SgpiAccountsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\SgpiAccountsQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\SgpiAccounts', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSgpiAccountsQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSgpiAccountsQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSgpiAccountsQuery) {
            return $criteria;
        }
        $query = new ChildSgpiAccountsQuery();
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
     * @return ChildSgpiAccounts|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SgpiAccountsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = SgpiAccountsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSgpiAccounts A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT sgpi_account_id, account_name, company_id, created_at, updated_at, employee_id FROM sgpi_accounts WHERE sgpi_account_id = :p0';
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
            /** @var ChildSgpiAccounts $obj */
            $obj = new ChildSgpiAccounts();
            $obj->hydrate($row);
            SgpiAccountsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSgpiAccounts|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SgpiAccountsTableMap::COL_SGPI_ACCOUNT_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SgpiAccountsTableMap::COL_SGPI_ACCOUNT_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the sgpi_account_id column
     *
     * Example usage:
     * <code>
     * $query->filterBySgpiAccountId(1234); // WHERE sgpi_account_id = 1234
     * $query->filterBySgpiAccountId(array(12, 34)); // WHERE sgpi_account_id IN (12, 34)
     * $query->filterBySgpiAccountId(array('min' => 12)); // WHERE sgpi_account_id > 12
     * </code>
     *
     * @param mixed $sgpiAccountId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySgpiAccountId($sgpiAccountId = null, ?string $comparison = null)
    {
        if (is_array($sgpiAccountId)) {
            $useMinMax = false;
            if (isset($sgpiAccountId['min'])) {
                $this->addUsingAlias(SgpiAccountsTableMap::COL_SGPI_ACCOUNT_ID, $sgpiAccountId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($sgpiAccountId['max'])) {
                $this->addUsingAlias(SgpiAccountsTableMap::COL_SGPI_ACCOUNT_ID, $sgpiAccountId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiAccountsTableMap::COL_SGPI_ACCOUNT_ID, $sgpiAccountId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the account_name column
     *
     * Example usage:
     * <code>
     * $query->filterByAccountName('fooValue');   // WHERE account_name = 'fooValue'
     * $query->filterByAccountName('%fooValue%', Criteria::LIKE); // WHERE account_name LIKE '%fooValue%'
     * $query->filterByAccountName(['foo', 'bar']); // WHERE account_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $accountName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAccountName($accountName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($accountName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiAccountsTableMap::COL_ACCOUNT_NAME, $accountName, $comparison);

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
                $this->addUsingAlias(SgpiAccountsTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(SgpiAccountsTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiAccountsTableMap::COL_COMPANY_ID, $companyId, $comparison);

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
                $this->addUsingAlias(SgpiAccountsTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(SgpiAccountsTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiAccountsTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(SgpiAccountsTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(SgpiAccountsTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiAccountsTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

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
                $this->addUsingAlias(SgpiAccountsTableMap::COL_EMPLOYEE_ID, $employeeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($employeeId['max'])) {
                $this->addUsingAlias(SgpiAccountsTableMap::COL_EMPLOYEE_ID, $employeeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiAccountsTableMap::COL_EMPLOYEE_ID, $employeeId, $comparison);

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
                ->addUsingAlias(SgpiAccountsTableMap::COL_COMPANY_ID, $company->getCompanyId(), $comparison);
        } elseif ($company instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SgpiAccountsTableMap::COL_COMPANY_ID, $company->toKeyValue('PrimaryKey', 'CompanyId'), $comparison);

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
     * Filter the query by a related \entities\SgpiTrans object
     *
     * @param \entities\SgpiTrans|ObjectCollection $sgpiTrans the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySgpiTrans($sgpiTrans, ?string $comparison = null)
    {
        if ($sgpiTrans instanceof \entities\SgpiTrans) {
            $this
                ->addUsingAlias(SgpiAccountsTableMap::COL_SGPI_ACCOUNT_ID, $sgpiTrans->getSgpiAccountId(), $comparison);

            return $this;
        } elseif ($sgpiTrans instanceof ObjectCollection) {
            $this
                ->useSgpiTransQuery()
                ->filterByPrimaryKeys($sgpiTrans->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySgpiTrans() only accepts arguments of type \entities\SgpiTrans or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SgpiTrans relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSgpiTrans(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SgpiTrans');

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
            $this->addJoinObject($join, 'SgpiTrans');
        }

        return $this;
    }

    /**
     * Use the SgpiTrans relation SgpiTrans object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\SgpiTransQuery A secondary query class using the current class as primary query
     */
    public function useSgpiTransQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSgpiTrans($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SgpiTrans', '\entities\SgpiTransQuery');
    }

    /**
     * Use the SgpiTrans relation SgpiTrans object
     *
     * @param callable(\entities\SgpiTransQuery):\entities\SgpiTransQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSgpiTransQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useSgpiTransQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SgpiTrans table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\SgpiTransQuery The inner query object of the EXISTS statement
     */
    public function useSgpiTransExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\SgpiTransQuery */
        $q = $this->useExistsQuery('SgpiTrans', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SgpiTrans table for a NOT EXISTS query.
     *
     * @see useSgpiTransExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\SgpiTransQuery The inner query object of the NOT EXISTS statement
     */
    public function useSgpiTransNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\SgpiTransQuery */
        $q = $this->useExistsQuery('SgpiTrans', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SgpiTrans table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\SgpiTransQuery The inner query object of the IN statement
     */
    public function useInSgpiTransQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\SgpiTransQuery */
        $q = $this->useInQuery('SgpiTrans', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SgpiTrans table for a NOT IN query.
     *
     * @see useSgpiTransInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\SgpiTransQuery The inner query object of the NOT IN statement
     */
    public function useNotInSgpiTransQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\SgpiTransQuery */
        $q = $this->useInQuery('SgpiTrans', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSgpiAccounts $sgpiAccounts Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($sgpiAccounts = null)
    {
        if ($sgpiAccounts) {
            $this->addUsingAlias(SgpiAccountsTableMap::COL_SGPI_ACCOUNT_ID, $sgpiAccounts->getSgpiAccountId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the sgpi_accounts table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SgpiAccountsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SgpiAccountsTableMap::clearInstancePool();
            SgpiAccountsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SgpiAccountsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SgpiAccountsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SgpiAccountsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SgpiAccountsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
