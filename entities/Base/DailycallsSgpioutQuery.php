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
use entities\DailycallsSgpiout as ChildDailycallsSgpiout;
use entities\DailycallsSgpioutQuery as ChildDailycallsSgpioutQuery;
use entities\Map\DailycallsSgpioutTableMap;

/**
 * Base class that represents a query for the `dailycalls_sgpiout` table.
 *
 * @method     ChildDailycallsSgpioutQuery orderBySgpiOutId($order = Criteria::ASC) Order by the sgpi_out_id column
 * @method     ChildDailycallsSgpioutQuery orderByDailycallId($order = Criteria::ASC) Order by the dailycall_id column
 * @method     ChildDailycallsSgpioutQuery orderBySgpiId($order = Criteria::ASC) Order by the sgpi_id column
 * @method     ChildDailycallsSgpioutQuery orderBySgpiQty($order = Criteria::ASC) Order by the sgpi_qty column
 * @method     ChildDailycallsSgpioutQuery orderBySgpiVoucherId($order = Criteria::ASC) Order by the sgpi_voucher_id column
 * @method     ChildDailycallsSgpioutQuery orderBySgpiName($order = Criteria::ASC) Order by the sgpi_name column
 * @method     ChildDailycallsSgpioutQuery orderBySgpiSku($order = Criteria::ASC) Order by the sgpi_sku column
 * @method     ChildDailycallsSgpioutQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildDailycallsSgpioutQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildDailycallsSgpioutQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildDailycallsSgpioutQuery orderByEmployeeId($order = Criteria::ASC) Order by the employee_id column
 * @method     ChildDailycallsSgpioutQuery orderByOutletId($order = Criteria::ASC) Order by the outlet_id column
 * @method     ChildDailycallsSgpioutQuery orderByOutletOrgdataId($order = Criteria::ASC) Order by the outlet_orgdata_id column
 *
 * @method     ChildDailycallsSgpioutQuery groupBySgpiOutId() Group by the sgpi_out_id column
 * @method     ChildDailycallsSgpioutQuery groupByDailycallId() Group by the dailycall_id column
 * @method     ChildDailycallsSgpioutQuery groupBySgpiId() Group by the sgpi_id column
 * @method     ChildDailycallsSgpioutQuery groupBySgpiQty() Group by the sgpi_qty column
 * @method     ChildDailycallsSgpioutQuery groupBySgpiVoucherId() Group by the sgpi_voucher_id column
 * @method     ChildDailycallsSgpioutQuery groupBySgpiName() Group by the sgpi_name column
 * @method     ChildDailycallsSgpioutQuery groupBySgpiSku() Group by the sgpi_sku column
 * @method     ChildDailycallsSgpioutQuery groupByCompanyId() Group by the company_id column
 * @method     ChildDailycallsSgpioutQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildDailycallsSgpioutQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildDailycallsSgpioutQuery groupByEmployeeId() Group by the employee_id column
 * @method     ChildDailycallsSgpioutQuery groupByOutletId() Group by the outlet_id column
 * @method     ChildDailycallsSgpioutQuery groupByOutletOrgdataId() Group by the outlet_orgdata_id column
 *
 * @method     ChildDailycallsSgpioutQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildDailycallsSgpioutQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildDailycallsSgpioutQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildDailycallsSgpioutQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildDailycallsSgpioutQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildDailycallsSgpioutQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildDailycallsSgpioutQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildDailycallsSgpioutQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildDailycallsSgpioutQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildDailycallsSgpioutQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildDailycallsSgpioutQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildDailycallsSgpioutQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildDailycallsSgpioutQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     ChildDailycallsSgpioutQuery leftJoinSgpiMaster($relationAlias = null) Adds a LEFT JOIN clause to the query using the SgpiMaster relation
 * @method     ChildDailycallsSgpioutQuery rightJoinSgpiMaster($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SgpiMaster relation
 * @method     ChildDailycallsSgpioutQuery innerJoinSgpiMaster($relationAlias = null) Adds a INNER JOIN clause to the query using the SgpiMaster relation
 *
 * @method     ChildDailycallsSgpioutQuery joinWithSgpiMaster($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SgpiMaster relation
 *
 * @method     ChildDailycallsSgpioutQuery leftJoinWithSgpiMaster() Adds a LEFT JOIN clause and with to the query using the SgpiMaster relation
 * @method     ChildDailycallsSgpioutQuery rightJoinWithSgpiMaster() Adds a RIGHT JOIN clause and with to the query using the SgpiMaster relation
 * @method     ChildDailycallsSgpioutQuery innerJoinWithSgpiMaster() Adds a INNER JOIN clause and with to the query using the SgpiMaster relation
 *
 * @method     ChildDailycallsSgpioutQuery leftJoinEmployee($relationAlias = null) Adds a LEFT JOIN clause to the query using the Employee relation
 * @method     ChildDailycallsSgpioutQuery rightJoinEmployee($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Employee relation
 * @method     ChildDailycallsSgpioutQuery innerJoinEmployee($relationAlias = null) Adds a INNER JOIN clause to the query using the Employee relation
 *
 * @method     ChildDailycallsSgpioutQuery joinWithEmployee($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Employee relation
 *
 * @method     ChildDailycallsSgpioutQuery leftJoinWithEmployee() Adds a LEFT JOIN clause and with to the query using the Employee relation
 * @method     ChildDailycallsSgpioutQuery rightJoinWithEmployee() Adds a RIGHT JOIN clause and with to the query using the Employee relation
 * @method     ChildDailycallsSgpioutQuery innerJoinWithEmployee() Adds a INNER JOIN clause and with to the query using the Employee relation
 *
 * @method     ChildDailycallsSgpioutQuery leftJoinOutlets($relationAlias = null) Adds a LEFT JOIN clause to the query using the Outlets relation
 * @method     ChildDailycallsSgpioutQuery rightJoinOutlets($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Outlets relation
 * @method     ChildDailycallsSgpioutQuery innerJoinOutlets($relationAlias = null) Adds a INNER JOIN clause to the query using the Outlets relation
 *
 * @method     ChildDailycallsSgpioutQuery joinWithOutlets($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Outlets relation
 *
 * @method     ChildDailycallsSgpioutQuery leftJoinWithOutlets() Adds a LEFT JOIN clause and with to the query using the Outlets relation
 * @method     ChildDailycallsSgpioutQuery rightJoinWithOutlets() Adds a RIGHT JOIN clause and with to the query using the Outlets relation
 * @method     ChildDailycallsSgpioutQuery innerJoinWithOutlets() Adds a INNER JOIN clause and with to the query using the Outlets relation
 *
 * @method     ChildDailycallsSgpioutQuery leftJoinOutletOrgData($relationAlias = null) Adds a LEFT JOIN clause to the query using the OutletOrgData relation
 * @method     ChildDailycallsSgpioutQuery rightJoinOutletOrgData($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OutletOrgData relation
 * @method     ChildDailycallsSgpioutQuery innerJoinOutletOrgData($relationAlias = null) Adds a INNER JOIN clause to the query using the OutletOrgData relation
 *
 * @method     ChildDailycallsSgpioutQuery joinWithOutletOrgData($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OutletOrgData relation
 *
 * @method     ChildDailycallsSgpioutQuery leftJoinWithOutletOrgData() Adds a LEFT JOIN clause and with to the query using the OutletOrgData relation
 * @method     ChildDailycallsSgpioutQuery rightJoinWithOutletOrgData() Adds a RIGHT JOIN clause and with to the query using the OutletOrgData relation
 * @method     ChildDailycallsSgpioutQuery innerJoinWithOutletOrgData() Adds a INNER JOIN clause and with to the query using the OutletOrgData relation
 *
 * @method     \entities\CompanyQuery|\entities\SgpiMasterQuery|\entities\EmployeeQuery|\entities\OutletsQuery|\entities\OutletOrgDataQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildDailycallsSgpiout|null findOne(?ConnectionInterface $con = null) Return the first ChildDailycallsSgpiout matching the query
 * @method     ChildDailycallsSgpiout findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildDailycallsSgpiout matching the query, or a new ChildDailycallsSgpiout object populated from the query conditions when no match is found
 *
 * @method     ChildDailycallsSgpiout|null findOneBySgpiOutId(int $sgpi_out_id) Return the first ChildDailycallsSgpiout filtered by the sgpi_out_id column
 * @method     ChildDailycallsSgpiout|null findOneByDailycallId(int $dailycall_id) Return the first ChildDailycallsSgpiout filtered by the dailycall_id column
 * @method     ChildDailycallsSgpiout|null findOneBySgpiId(int $sgpi_id) Return the first ChildDailycallsSgpiout filtered by the sgpi_id column
 * @method     ChildDailycallsSgpiout|null findOneBySgpiQty(int $sgpi_qty) Return the first ChildDailycallsSgpiout filtered by the sgpi_qty column
 * @method     ChildDailycallsSgpiout|null findOneBySgpiVoucherId(string $sgpi_voucher_id) Return the first ChildDailycallsSgpiout filtered by the sgpi_voucher_id column
 * @method     ChildDailycallsSgpiout|null findOneBySgpiName(string $sgpi_name) Return the first ChildDailycallsSgpiout filtered by the sgpi_name column
 * @method     ChildDailycallsSgpiout|null findOneBySgpiSku(string $sgpi_sku) Return the first ChildDailycallsSgpiout filtered by the sgpi_sku column
 * @method     ChildDailycallsSgpiout|null findOneByCompanyId(int $company_id) Return the first ChildDailycallsSgpiout filtered by the company_id column
 * @method     ChildDailycallsSgpiout|null findOneByCreatedAt(string $created_at) Return the first ChildDailycallsSgpiout filtered by the created_at column
 * @method     ChildDailycallsSgpiout|null findOneByUpdatedAt(string $updated_at) Return the first ChildDailycallsSgpiout filtered by the updated_at column
 * @method     ChildDailycallsSgpiout|null findOneByEmployeeId(int $employee_id) Return the first ChildDailycallsSgpiout filtered by the employee_id column
 * @method     ChildDailycallsSgpiout|null findOneByOutletId(int $outlet_id) Return the first ChildDailycallsSgpiout filtered by the outlet_id column
 * @method     ChildDailycallsSgpiout|null findOneByOutletOrgdataId(int $outlet_orgdata_id) Return the first ChildDailycallsSgpiout filtered by the outlet_orgdata_id column
 *
 * @method     ChildDailycallsSgpiout requirePk($key, ?ConnectionInterface $con = null) Return the ChildDailycallsSgpiout by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDailycallsSgpiout requireOne(?ConnectionInterface $con = null) Return the first ChildDailycallsSgpiout matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDailycallsSgpiout requireOneBySgpiOutId(int $sgpi_out_id) Return the first ChildDailycallsSgpiout filtered by the sgpi_out_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDailycallsSgpiout requireOneByDailycallId(int $dailycall_id) Return the first ChildDailycallsSgpiout filtered by the dailycall_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDailycallsSgpiout requireOneBySgpiId(int $sgpi_id) Return the first ChildDailycallsSgpiout filtered by the sgpi_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDailycallsSgpiout requireOneBySgpiQty(int $sgpi_qty) Return the first ChildDailycallsSgpiout filtered by the sgpi_qty column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDailycallsSgpiout requireOneBySgpiVoucherId(string $sgpi_voucher_id) Return the first ChildDailycallsSgpiout filtered by the sgpi_voucher_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDailycallsSgpiout requireOneBySgpiName(string $sgpi_name) Return the first ChildDailycallsSgpiout filtered by the sgpi_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDailycallsSgpiout requireOneBySgpiSku(string $sgpi_sku) Return the first ChildDailycallsSgpiout filtered by the sgpi_sku column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDailycallsSgpiout requireOneByCompanyId(int $company_id) Return the first ChildDailycallsSgpiout filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDailycallsSgpiout requireOneByCreatedAt(string $created_at) Return the first ChildDailycallsSgpiout filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDailycallsSgpiout requireOneByUpdatedAt(string $updated_at) Return the first ChildDailycallsSgpiout filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDailycallsSgpiout requireOneByEmployeeId(int $employee_id) Return the first ChildDailycallsSgpiout filtered by the employee_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDailycallsSgpiout requireOneByOutletId(int $outlet_id) Return the first ChildDailycallsSgpiout filtered by the outlet_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDailycallsSgpiout requireOneByOutletOrgdataId(int $outlet_orgdata_id) Return the first ChildDailycallsSgpiout filtered by the outlet_orgdata_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDailycallsSgpiout[]|Collection find(?ConnectionInterface $con = null) Return ChildDailycallsSgpiout objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildDailycallsSgpiout> find(?ConnectionInterface $con = null) Return ChildDailycallsSgpiout objects based on current ModelCriteria
 *
 * @method     ChildDailycallsSgpiout[]|Collection findBySgpiOutId(int|array<int> $sgpi_out_id) Return ChildDailycallsSgpiout objects filtered by the sgpi_out_id column
 * @psalm-method Collection&\Traversable<ChildDailycallsSgpiout> findBySgpiOutId(int|array<int> $sgpi_out_id) Return ChildDailycallsSgpiout objects filtered by the sgpi_out_id column
 * @method     ChildDailycallsSgpiout[]|Collection findByDailycallId(int|array<int> $dailycall_id) Return ChildDailycallsSgpiout objects filtered by the dailycall_id column
 * @psalm-method Collection&\Traversable<ChildDailycallsSgpiout> findByDailycallId(int|array<int> $dailycall_id) Return ChildDailycallsSgpiout objects filtered by the dailycall_id column
 * @method     ChildDailycallsSgpiout[]|Collection findBySgpiId(int|array<int> $sgpi_id) Return ChildDailycallsSgpiout objects filtered by the sgpi_id column
 * @psalm-method Collection&\Traversable<ChildDailycallsSgpiout> findBySgpiId(int|array<int> $sgpi_id) Return ChildDailycallsSgpiout objects filtered by the sgpi_id column
 * @method     ChildDailycallsSgpiout[]|Collection findBySgpiQty(int|array<int> $sgpi_qty) Return ChildDailycallsSgpiout objects filtered by the sgpi_qty column
 * @psalm-method Collection&\Traversable<ChildDailycallsSgpiout> findBySgpiQty(int|array<int> $sgpi_qty) Return ChildDailycallsSgpiout objects filtered by the sgpi_qty column
 * @method     ChildDailycallsSgpiout[]|Collection findBySgpiVoucherId(string|array<string> $sgpi_voucher_id) Return ChildDailycallsSgpiout objects filtered by the sgpi_voucher_id column
 * @psalm-method Collection&\Traversable<ChildDailycallsSgpiout> findBySgpiVoucherId(string|array<string> $sgpi_voucher_id) Return ChildDailycallsSgpiout objects filtered by the sgpi_voucher_id column
 * @method     ChildDailycallsSgpiout[]|Collection findBySgpiName(string|array<string> $sgpi_name) Return ChildDailycallsSgpiout objects filtered by the sgpi_name column
 * @psalm-method Collection&\Traversable<ChildDailycallsSgpiout> findBySgpiName(string|array<string> $sgpi_name) Return ChildDailycallsSgpiout objects filtered by the sgpi_name column
 * @method     ChildDailycallsSgpiout[]|Collection findBySgpiSku(string|array<string> $sgpi_sku) Return ChildDailycallsSgpiout objects filtered by the sgpi_sku column
 * @psalm-method Collection&\Traversable<ChildDailycallsSgpiout> findBySgpiSku(string|array<string> $sgpi_sku) Return ChildDailycallsSgpiout objects filtered by the sgpi_sku column
 * @method     ChildDailycallsSgpiout[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildDailycallsSgpiout objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildDailycallsSgpiout> findByCompanyId(int|array<int> $company_id) Return ChildDailycallsSgpiout objects filtered by the company_id column
 * @method     ChildDailycallsSgpiout[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildDailycallsSgpiout objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildDailycallsSgpiout> findByCreatedAt(string|array<string> $created_at) Return ChildDailycallsSgpiout objects filtered by the created_at column
 * @method     ChildDailycallsSgpiout[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildDailycallsSgpiout objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildDailycallsSgpiout> findByUpdatedAt(string|array<string> $updated_at) Return ChildDailycallsSgpiout objects filtered by the updated_at column
 * @method     ChildDailycallsSgpiout[]|Collection findByEmployeeId(int|array<int> $employee_id) Return ChildDailycallsSgpiout objects filtered by the employee_id column
 * @psalm-method Collection&\Traversable<ChildDailycallsSgpiout> findByEmployeeId(int|array<int> $employee_id) Return ChildDailycallsSgpiout objects filtered by the employee_id column
 * @method     ChildDailycallsSgpiout[]|Collection findByOutletId(int|array<int> $outlet_id) Return ChildDailycallsSgpiout objects filtered by the outlet_id column
 * @psalm-method Collection&\Traversable<ChildDailycallsSgpiout> findByOutletId(int|array<int> $outlet_id) Return ChildDailycallsSgpiout objects filtered by the outlet_id column
 * @method     ChildDailycallsSgpiout[]|Collection findByOutletOrgdataId(int|array<int> $outlet_orgdata_id) Return ChildDailycallsSgpiout objects filtered by the outlet_orgdata_id column
 * @psalm-method Collection&\Traversable<ChildDailycallsSgpiout> findByOutletOrgdataId(int|array<int> $outlet_orgdata_id) Return ChildDailycallsSgpiout objects filtered by the outlet_orgdata_id column
 *
 * @method     ChildDailycallsSgpiout[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildDailycallsSgpiout> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class DailycallsSgpioutQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\DailycallsSgpioutQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\DailycallsSgpiout', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildDailycallsSgpioutQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildDailycallsSgpioutQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildDailycallsSgpioutQuery) {
            return $criteria;
        }
        $query = new ChildDailycallsSgpioutQuery();
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
     * @return ChildDailycallsSgpiout|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(DailycallsSgpioutTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = DailycallsSgpioutTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildDailycallsSgpiout A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT sgpi_out_id, dailycall_id, sgpi_id, sgpi_qty, sgpi_voucher_id, sgpi_name, sgpi_sku, company_id, created_at, updated_at, employee_id, outlet_id, outlet_orgdata_id FROM dailycalls_sgpiout WHERE sgpi_out_id = :p0';
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
            /** @var ChildDailycallsSgpiout $obj */
            $obj = new ChildDailycallsSgpiout();
            $obj->hydrate($row);
            DailycallsSgpioutTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildDailycallsSgpiout|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(DailycallsSgpioutTableMap::COL_SGPI_OUT_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(DailycallsSgpioutTableMap::COL_SGPI_OUT_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the sgpi_out_id column
     *
     * Example usage:
     * <code>
     * $query->filterBySgpiOutId(1234); // WHERE sgpi_out_id = 1234
     * $query->filterBySgpiOutId(array(12, 34)); // WHERE sgpi_out_id IN (12, 34)
     * $query->filterBySgpiOutId(array('min' => 12)); // WHERE sgpi_out_id > 12
     * </code>
     *
     * @param mixed $sgpiOutId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySgpiOutId($sgpiOutId = null, ?string $comparison = null)
    {
        if (is_array($sgpiOutId)) {
            $useMinMax = false;
            if (isset($sgpiOutId['min'])) {
                $this->addUsingAlias(DailycallsSgpioutTableMap::COL_SGPI_OUT_ID, $sgpiOutId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($sgpiOutId['max'])) {
                $this->addUsingAlias(DailycallsSgpioutTableMap::COL_SGPI_OUT_ID, $sgpiOutId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DailycallsSgpioutTableMap::COL_SGPI_OUT_ID, $sgpiOutId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the dailycall_id column
     *
     * Example usage:
     * <code>
     * $query->filterByDailycallId(1234); // WHERE dailycall_id = 1234
     * $query->filterByDailycallId(array(12, 34)); // WHERE dailycall_id IN (12, 34)
     * $query->filterByDailycallId(array('min' => 12)); // WHERE dailycall_id > 12
     * </code>
     *
     * @param mixed $dailycallId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDailycallId($dailycallId = null, ?string $comparison = null)
    {
        if (is_array($dailycallId)) {
            $useMinMax = false;
            if (isset($dailycallId['min'])) {
                $this->addUsingAlias(DailycallsSgpioutTableMap::COL_DAILYCALL_ID, $dailycallId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dailycallId['max'])) {
                $this->addUsingAlias(DailycallsSgpioutTableMap::COL_DAILYCALL_ID, $dailycallId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DailycallsSgpioutTableMap::COL_DAILYCALL_ID, $dailycallId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the sgpi_id column
     *
     * Example usage:
     * <code>
     * $query->filterBySgpiId(1234); // WHERE sgpi_id = 1234
     * $query->filterBySgpiId(array(12, 34)); // WHERE sgpi_id IN (12, 34)
     * $query->filterBySgpiId(array('min' => 12)); // WHERE sgpi_id > 12
     * </code>
     *
     * @see       filterBySgpiMaster()
     *
     * @param mixed $sgpiId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySgpiId($sgpiId = null, ?string $comparison = null)
    {
        if (is_array($sgpiId)) {
            $useMinMax = false;
            if (isset($sgpiId['min'])) {
                $this->addUsingAlias(DailycallsSgpioutTableMap::COL_SGPI_ID, $sgpiId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($sgpiId['max'])) {
                $this->addUsingAlias(DailycallsSgpioutTableMap::COL_SGPI_ID, $sgpiId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DailycallsSgpioutTableMap::COL_SGPI_ID, $sgpiId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the sgpi_qty column
     *
     * Example usage:
     * <code>
     * $query->filterBySgpiQty(1234); // WHERE sgpi_qty = 1234
     * $query->filterBySgpiQty(array(12, 34)); // WHERE sgpi_qty IN (12, 34)
     * $query->filterBySgpiQty(array('min' => 12)); // WHERE sgpi_qty > 12
     * </code>
     *
     * @param mixed $sgpiQty The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySgpiQty($sgpiQty = null, ?string $comparison = null)
    {
        if (is_array($sgpiQty)) {
            $useMinMax = false;
            if (isset($sgpiQty['min'])) {
                $this->addUsingAlias(DailycallsSgpioutTableMap::COL_SGPI_QTY, $sgpiQty['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($sgpiQty['max'])) {
                $this->addUsingAlias(DailycallsSgpioutTableMap::COL_SGPI_QTY, $sgpiQty['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DailycallsSgpioutTableMap::COL_SGPI_QTY, $sgpiQty, $comparison);

        return $this;
    }

    /**
     * Filter the query on the sgpi_voucher_id column
     *
     * Example usage:
     * <code>
     * $query->filterBySgpiVoucherId(1234); // WHERE sgpi_voucher_id = 1234
     * $query->filterBySgpiVoucherId(array(12, 34)); // WHERE sgpi_voucher_id IN (12, 34)
     * $query->filterBySgpiVoucherId(array('min' => 12)); // WHERE sgpi_voucher_id > 12
     * </code>
     *
     * @param mixed $sgpiVoucherId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySgpiVoucherId($sgpiVoucherId = null, ?string $comparison = null)
    {
        if (is_array($sgpiVoucherId)) {
            $useMinMax = false;
            if (isset($sgpiVoucherId['min'])) {
                $this->addUsingAlias(DailycallsSgpioutTableMap::COL_SGPI_VOUCHER_ID, $sgpiVoucherId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($sgpiVoucherId['max'])) {
                $this->addUsingAlias(DailycallsSgpioutTableMap::COL_SGPI_VOUCHER_ID, $sgpiVoucherId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DailycallsSgpioutTableMap::COL_SGPI_VOUCHER_ID, $sgpiVoucherId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the sgpi_name column
     *
     * Example usage:
     * <code>
     * $query->filterBySgpiName('fooValue');   // WHERE sgpi_name = 'fooValue'
     * $query->filterBySgpiName('%fooValue%', Criteria::LIKE); // WHERE sgpi_name LIKE '%fooValue%'
     * $query->filterBySgpiName(['foo', 'bar']); // WHERE sgpi_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $sgpiName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySgpiName($sgpiName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($sgpiName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DailycallsSgpioutTableMap::COL_SGPI_NAME, $sgpiName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the sgpi_sku column
     *
     * Example usage:
     * <code>
     * $query->filterBySgpiSku('fooValue');   // WHERE sgpi_sku = 'fooValue'
     * $query->filterBySgpiSku('%fooValue%', Criteria::LIKE); // WHERE sgpi_sku LIKE '%fooValue%'
     * $query->filterBySgpiSku(['foo', 'bar']); // WHERE sgpi_sku IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $sgpiSku The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySgpiSku($sgpiSku = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($sgpiSku)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DailycallsSgpioutTableMap::COL_SGPI_SKU, $sgpiSku, $comparison);

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
                $this->addUsingAlias(DailycallsSgpioutTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(DailycallsSgpioutTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DailycallsSgpioutTableMap::COL_COMPANY_ID, $companyId, $comparison);

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
                $this->addUsingAlias(DailycallsSgpioutTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(DailycallsSgpioutTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DailycallsSgpioutTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(DailycallsSgpioutTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(DailycallsSgpioutTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DailycallsSgpioutTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

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
                $this->addUsingAlias(DailycallsSgpioutTableMap::COL_EMPLOYEE_ID, $employeeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($employeeId['max'])) {
                $this->addUsingAlias(DailycallsSgpioutTableMap::COL_EMPLOYEE_ID, $employeeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DailycallsSgpioutTableMap::COL_EMPLOYEE_ID, $employeeId, $comparison);

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
                $this->addUsingAlias(DailycallsSgpioutTableMap::COL_OUTLET_ID, $outletId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outletId['max'])) {
                $this->addUsingAlias(DailycallsSgpioutTableMap::COL_OUTLET_ID, $outletId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DailycallsSgpioutTableMap::COL_OUTLET_ID, $outletId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_orgdata_id column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletOrgdataId(1234); // WHERE outlet_orgdata_id = 1234
     * $query->filterByOutletOrgdataId(array(12, 34)); // WHERE outlet_orgdata_id IN (12, 34)
     * $query->filterByOutletOrgdataId(array('min' => 12)); // WHERE outlet_orgdata_id > 12
     * </code>
     *
     * @see       filterByOutletOrgData()
     *
     * @param mixed $outletOrgdataId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletOrgdataId($outletOrgdataId = null, ?string $comparison = null)
    {
        if (is_array($outletOrgdataId)) {
            $useMinMax = false;
            if (isset($outletOrgdataId['min'])) {
                $this->addUsingAlias(DailycallsSgpioutTableMap::COL_OUTLET_ORGDATA_ID, $outletOrgdataId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outletOrgdataId['max'])) {
                $this->addUsingAlias(DailycallsSgpioutTableMap::COL_OUTLET_ORGDATA_ID, $outletOrgdataId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DailycallsSgpioutTableMap::COL_OUTLET_ORGDATA_ID, $outletOrgdataId, $comparison);

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
                ->addUsingAlias(DailycallsSgpioutTableMap::COL_COMPANY_ID, $company->getCompanyId(), $comparison);
        } elseif ($company instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(DailycallsSgpioutTableMap::COL_COMPANY_ID, $company->toKeyValue('PrimaryKey', 'CompanyId'), $comparison);

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
     * Filter the query by a related \entities\SgpiMaster object
     *
     * @param \entities\SgpiMaster|ObjectCollection $sgpiMaster The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySgpiMaster($sgpiMaster, ?string $comparison = null)
    {
        if ($sgpiMaster instanceof \entities\SgpiMaster) {
            return $this
                ->addUsingAlias(DailycallsSgpioutTableMap::COL_SGPI_ID, $sgpiMaster->getSgpiId(), $comparison);
        } elseif ($sgpiMaster instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(DailycallsSgpioutTableMap::COL_SGPI_ID, $sgpiMaster->toKeyValue('PrimaryKey', 'SgpiId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterBySgpiMaster() only accepts arguments of type \entities\SgpiMaster or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SgpiMaster relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSgpiMaster(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SgpiMaster');

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
            $this->addJoinObject($join, 'SgpiMaster');
        }

        return $this;
    }

    /**
     * Use the SgpiMaster relation SgpiMaster object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\SgpiMasterQuery A secondary query class using the current class as primary query
     */
    public function useSgpiMasterQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSgpiMaster($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SgpiMaster', '\entities\SgpiMasterQuery');
    }

    /**
     * Use the SgpiMaster relation SgpiMaster object
     *
     * @param callable(\entities\SgpiMasterQuery):\entities\SgpiMasterQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSgpiMasterQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useSgpiMasterQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SgpiMaster table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\SgpiMasterQuery The inner query object of the EXISTS statement
     */
    public function useSgpiMasterExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\SgpiMasterQuery */
        $q = $this->useExistsQuery('SgpiMaster', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SgpiMaster table for a NOT EXISTS query.
     *
     * @see useSgpiMasterExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\SgpiMasterQuery The inner query object of the NOT EXISTS statement
     */
    public function useSgpiMasterNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\SgpiMasterQuery */
        $q = $this->useExistsQuery('SgpiMaster', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SgpiMaster table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\SgpiMasterQuery The inner query object of the IN statement
     */
    public function useInSgpiMasterQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\SgpiMasterQuery */
        $q = $this->useInQuery('SgpiMaster', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SgpiMaster table for a NOT IN query.
     *
     * @see useSgpiMasterInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\SgpiMasterQuery The inner query object of the NOT IN statement
     */
    public function useNotInSgpiMasterQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\SgpiMasterQuery */
        $q = $this->useInQuery('SgpiMaster', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(DailycallsSgpioutTableMap::COL_EMPLOYEE_ID, $employee->getEmployeeId(), $comparison);
        } elseif ($employee instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(DailycallsSgpioutTableMap::COL_EMPLOYEE_ID, $employee->toKeyValue('PrimaryKey', 'EmployeeId'), $comparison);

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
                ->addUsingAlias(DailycallsSgpioutTableMap::COL_OUTLET_ID, $outlets->getId(), $comparison);
        } elseif ($outlets instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(DailycallsSgpioutTableMap::COL_OUTLET_ID, $outlets->toKeyValue('PrimaryKey', 'Id'), $comparison);

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
                ->addUsingAlias(DailycallsSgpioutTableMap::COL_OUTLET_ORGDATA_ID, $outletOrgData->getOutletOrgId(), $comparison);
        } elseif ($outletOrgData instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(DailycallsSgpioutTableMap::COL_OUTLET_ORGDATA_ID, $outletOrgData->toKeyValue('PrimaryKey', 'OutletOrgId'), $comparison);

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
     * @param ChildDailycallsSgpiout $dailycallsSgpiout Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($dailycallsSgpiout = null)
    {
        if ($dailycallsSgpiout) {
            $this->addUsingAlias(DailycallsSgpioutTableMap::COL_SGPI_OUT_ID, $dailycallsSgpiout->getSgpiOutId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the dailycalls_sgpiout table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DailycallsSgpioutTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            DailycallsSgpioutTableMap::clearInstancePool();
            DailycallsSgpioutTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(DailycallsSgpioutTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(DailycallsSgpioutTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            DailycallsSgpioutTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            DailycallsSgpioutTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
