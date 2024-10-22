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
use entities\SgpiTrans as ChildSgpiTrans;
use entities\SgpiTransQuery as ChildSgpiTransQuery;
use entities\Map\SgpiTransTableMap;

/**
 * Base class that represents a query for the `sgpi_trans` table.
 *
 * @method     ChildSgpiTransQuery orderBySgpiTranId($order = Criteria::ASC) Order by the sgpi_tran_id column
 * @method     ChildSgpiTransQuery orderBySgpiId($order = Criteria::ASC) Order by the sgpi_id column
 * @method     ChildSgpiTransQuery orderBySgpiAccountId($order = Criteria::ASC) Order by the sgpi_account_id column
 * @method     ChildSgpiTransQuery orderByCd($order = Criteria::ASC) Order by the cd column
 * @method     ChildSgpiTransQuery orderByQty($order = Criteria::ASC) Order by the qty column
 * @method     ChildSgpiTransQuery orderByVoucherNo($order = Criteria::ASC) Order by the voucher_no column
 * @method     ChildSgpiTransQuery orderByRemark($order = Criteria::ASC) Order by the remark column
 * @method     ChildSgpiTransQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildSgpiTransQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildSgpiTransQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildSgpiTransQuery orderByOutletOrgId($order = Criteria::ASC) Order by the outlet_org_id column
 *
 * @method     ChildSgpiTransQuery groupBySgpiTranId() Group by the sgpi_tran_id column
 * @method     ChildSgpiTransQuery groupBySgpiId() Group by the sgpi_id column
 * @method     ChildSgpiTransQuery groupBySgpiAccountId() Group by the sgpi_account_id column
 * @method     ChildSgpiTransQuery groupByCd() Group by the cd column
 * @method     ChildSgpiTransQuery groupByQty() Group by the qty column
 * @method     ChildSgpiTransQuery groupByVoucherNo() Group by the voucher_no column
 * @method     ChildSgpiTransQuery groupByRemark() Group by the remark column
 * @method     ChildSgpiTransQuery groupByCompanyId() Group by the company_id column
 * @method     ChildSgpiTransQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildSgpiTransQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildSgpiTransQuery groupByOutletOrgId() Group by the outlet_org_id column
 *
 * @method     ChildSgpiTransQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSgpiTransQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSgpiTransQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSgpiTransQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSgpiTransQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSgpiTransQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSgpiTransQuery leftJoinSgpiAccounts($relationAlias = null) Adds a LEFT JOIN clause to the query using the SgpiAccounts relation
 * @method     ChildSgpiTransQuery rightJoinSgpiAccounts($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SgpiAccounts relation
 * @method     ChildSgpiTransQuery innerJoinSgpiAccounts($relationAlias = null) Adds a INNER JOIN clause to the query using the SgpiAccounts relation
 *
 * @method     ChildSgpiTransQuery joinWithSgpiAccounts($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SgpiAccounts relation
 *
 * @method     ChildSgpiTransQuery leftJoinWithSgpiAccounts() Adds a LEFT JOIN clause and with to the query using the SgpiAccounts relation
 * @method     ChildSgpiTransQuery rightJoinWithSgpiAccounts() Adds a RIGHT JOIN clause and with to the query using the SgpiAccounts relation
 * @method     ChildSgpiTransQuery innerJoinWithSgpiAccounts() Adds a INNER JOIN clause and with to the query using the SgpiAccounts relation
 *
 * @method     ChildSgpiTransQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildSgpiTransQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildSgpiTransQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildSgpiTransQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildSgpiTransQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildSgpiTransQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildSgpiTransQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     ChildSgpiTransQuery leftJoinSgpiMaster($relationAlias = null) Adds a LEFT JOIN clause to the query using the SgpiMaster relation
 * @method     ChildSgpiTransQuery rightJoinSgpiMaster($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SgpiMaster relation
 * @method     ChildSgpiTransQuery innerJoinSgpiMaster($relationAlias = null) Adds a INNER JOIN clause to the query using the SgpiMaster relation
 *
 * @method     ChildSgpiTransQuery joinWithSgpiMaster($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SgpiMaster relation
 *
 * @method     ChildSgpiTransQuery leftJoinWithSgpiMaster() Adds a LEFT JOIN clause and with to the query using the SgpiMaster relation
 * @method     ChildSgpiTransQuery rightJoinWithSgpiMaster() Adds a RIGHT JOIN clause and with to the query using the SgpiMaster relation
 * @method     ChildSgpiTransQuery innerJoinWithSgpiMaster() Adds a INNER JOIN clause and with to the query using the SgpiMaster relation
 *
 * @method     \entities\SgpiAccountsQuery|\entities\CompanyQuery|\entities\SgpiMasterQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSgpiTrans|null findOne(?ConnectionInterface $con = null) Return the first ChildSgpiTrans matching the query
 * @method     ChildSgpiTrans findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSgpiTrans matching the query, or a new ChildSgpiTrans object populated from the query conditions when no match is found
 *
 * @method     ChildSgpiTrans|null findOneBySgpiTranId(int $sgpi_tran_id) Return the first ChildSgpiTrans filtered by the sgpi_tran_id column
 * @method     ChildSgpiTrans|null findOneBySgpiId(int $sgpi_id) Return the first ChildSgpiTrans filtered by the sgpi_id column
 * @method     ChildSgpiTrans|null findOneBySgpiAccountId(int $sgpi_account_id) Return the first ChildSgpiTrans filtered by the sgpi_account_id column
 * @method     ChildSgpiTrans|null findOneByCd(string $cd) Return the first ChildSgpiTrans filtered by the cd column
 * @method     ChildSgpiTrans|null findOneByQty(int $qty) Return the first ChildSgpiTrans filtered by the qty column
 * @method     ChildSgpiTrans|null findOneByVoucherNo(string $voucher_no) Return the first ChildSgpiTrans filtered by the voucher_no column
 * @method     ChildSgpiTrans|null findOneByRemark(string $remark) Return the first ChildSgpiTrans filtered by the remark column
 * @method     ChildSgpiTrans|null findOneByCompanyId(int $company_id) Return the first ChildSgpiTrans filtered by the company_id column
 * @method     ChildSgpiTrans|null findOneByCreatedAt(string $created_at) Return the first ChildSgpiTrans filtered by the created_at column
 * @method     ChildSgpiTrans|null findOneByUpdatedAt(string $updated_at) Return the first ChildSgpiTrans filtered by the updated_at column
 * @method     ChildSgpiTrans|null findOneByOutletOrgId(int $outlet_org_id) Return the first ChildSgpiTrans filtered by the outlet_org_id column
 *
 * @method     ChildSgpiTrans requirePk($key, ?ConnectionInterface $con = null) Return the ChildSgpiTrans by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiTrans requireOne(?ConnectionInterface $con = null) Return the first ChildSgpiTrans matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSgpiTrans requireOneBySgpiTranId(int $sgpi_tran_id) Return the first ChildSgpiTrans filtered by the sgpi_tran_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiTrans requireOneBySgpiId(int $sgpi_id) Return the first ChildSgpiTrans filtered by the sgpi_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiTrans requireOneBySgpiAccountId(int $sgpi_account_id) Return the first ChildSgpiTrans filtered by the sgpi_account_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiTrans requireOneByCd(string $cd) Return the first ChildSgpiTrans filtered by the cd column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiTrans requireOneByQty(int $qty) Return the first ChildSgpiTrans filtered by the qty column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiTrans requireOneByVoucherNo(string $voucher_no) Return the first ChildSgpiTrans filtered by the voucher_no column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiTrans requireOneByRemark(string $remark) Return the first ChildSgpiTrans filtered by the remark column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiTrans requireOneByCompanyId(int $company_id) Return the first ChildSgpiTrans filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiTrans requireOneByCreatedAt(string $created_at) Return the first ChildSgpiTrans filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiTrans requireOneByUpdatedAt(string $updated_at) Return the first ChildSgpiTrans filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiTrans requireOneByOutletOrgId(int $outlet_org_id) Return the first ChildSgpiTrans filtered by the outlet_org_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSgpiTrans[]|Collection find(?ConnectionInterface $con = null) Return ChildSgpiTrans objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSgpiTrans> find(?ConnectionInterface $con = null) Return ChildSgpiTrans objects based on current ModelCriteria
 *
 * @method     ChildSgpiTrans[]|Collection findBySgpiTranId(int|array<int> $sgpi_tran_id) Return ChildSgpiTrans objects filtered by the sgpi_tran_id column
 * @psalm-method Collection&\Traversable<ChildSgpiTrans> findBySgpiTranId(int|array<int> $sgpi_tran_id) Return ChildSgpiTrans objects filtered by the sgpi_tran_id column
 * @method     ChildSgpiTrans[]|Collection findBySgpiId(int|array<int> $sgpi_id) Return ChildSgpiTrans objects filtered by the sgpi_id column
 * @psalm-method Collection&\Traversable<ChildSgpiTrans> findBySgpiId(int|array<int> $sgpi_id) Return ChildSgpiTrans objects filtered by the sgpi_id column
 * @method     ChildSgpiTrans[]|Collection findBySgpiAccountId(int|array<int> $sgpi_account_id) Return ChildSgpiTrans objects filtered by the sgpi_account_id column
 * @psalm-method Collection&\Traversable<ChildSgpiTrans> findBySgpiAccountId(int|array<int> $sgpi_account_id) Return ChildSgpiTrans objects filtered by the sgpi_account_id column
 * @method     ChildSgpiTrans[]|Collection findByCd(string|array<string> $cd) Return ChildSgpiTrans objects filtered by the cd column
 * @psalm-method Collection&\Traversable<ChildSgpiTrans> findByCd(string|array<string> $cd) Return ChildSgpiTrans objects filtered by the cd column
 * @method     ChildSgpiTrans[]|Collection findByQty(int|array<int> $qty) Return ChildSgpiTrans objects filtered by the qty column
 * @psalm-method Collection&\Traversable<ChildSgpiTrans> findByQty(int|array<int> $qty) Return ChildSgpiTrans objects filtered by the qty column
 * @method     ChildSgpiTrans[]|Collection findByVoucherNo(string|array<string> $voucher_no) Return ChildSgpiTrans objects filtered by the voucher_no column
 * @psalm-method Collection&\Traversable<ChildSgpiTrans> findByVoucherNo(string|array<string> $voucher_no) Return ChildSgpiTrans objects filtered by the voucher_no column
 * @method     ChildSgpiTrans[]|Collection findByRemark(string|array<string> $remark) Return ChildSgpiTrans objects filtered by the remark column
 * @psalm-method Collection&\Traversable<ChildSgpiTrans> findByRemark(string|array<string> $remark) Return ChildSgpiTrans objects filtered by the remark column
 * @method     ChildSgpiTrans[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildSgpiTrans objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildSgpiTrans> findByCompanyId(int|array<int> $company_id) Return ChildSgpiTrans objects filtered by the company_id column
 * @method     ChildSgpiTrans[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildSgpiTrans objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildSgpiTrans> findByCreatedAt(string|array<string> $created_at) Return ChildSgpiTrans objects filtered by the created_at column
 * @method     ChildSgpiTrans[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildSgpiTrans objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildSgpiTrans> findByUpdatedAt(string|array<string> $updated_at) Return ChildSgpiTrans objects filtered by the updated_at column
 * @method     ChildSgpiTrans[]|Collection findByOutletOrgId(int|array<int> $outlet_org_id) Return ChildSgpiTrans objects filtered by the outlet_org_id column
 * @psalm-method Collection&\Traversable<ChildSgpiTrans> findByOutletOrgId(int|array<int> $outlet_org_id) Return ChildSgpiTrans objects filtered by the outlet_org_id column
 *
 * @method     ChildSgpiTrans[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSgpiTrans> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SgpiTransQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\SgpiTransQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\SgpiTrans', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSgpiTransQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSgpiTransQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSgpiTransQuery) {
            return $criteria;
        }
        $query = new ChildSgpiTransQuery();
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
     * @return ChildSgpiTrans|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SgpiTransTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = SgpiTransTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSgpiTrans A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT sgpi_tran_id, sgpi_id, sgpi_account_id, cd, qty, voucher_no, remark, company_id, created_at, updated_at, outlet_org_id FROM sgpi_trans WHERE sgpi_tran_id = :p0';
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
            /** @var ChildSgpiTrans $obj */
            $obj = new ChildSgpiTrans();
            $obj->hydrate($row);
            SgpiTransTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSgpiTrans|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SgpiTransTableMap::COL_SGPI_TRAN_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SgpiTransTableMap::COL_SGPI_TRAN_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the sgpi_tran_id column
     *
     * Example usage:
     * <code>
     * $query->filterBySgpiTranId(1234); // WHERE sgpi_tran_id = 1234
     * $query->filterBySgpiTranId(array(12, 34)); // WHERE sgpi_tran_id IN (12, 34)
     * $query->filterBySgpiTranId(array('min' => 12)); // WHERE sgpi_tran_id > 12
     * </code>
     *
     * @param mixed $sgpiTranId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySgpiTranId($sgpiTranId = null, ?string $comparison = null)
    {
        if (is_array($sgpiTranId)) {
            $useMinMax = false;
            if (isset($sgpiTranId['min'])) {
                $this->addUsingAlias(SgpiTransTableMap::COL_SGPI_TRAN_ID, $sgpiTranId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($sgpiTranId['max'])) {
                $this->addUsingAlias(SgpiTransTableMap::COL_SGPI_TRAN_ID, $sgpiTranId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiTransTableMap::COL_SGPI_TRAN_ID, $sgpiTranId, $comparison);

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
                $this->addUsingAlias(SgpiTransTableMap::COL_SGPI_ID, $sgpiId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($sgpiId['max'])) {
                $this->addUsingAlias(SgpiTransTableMap::COL_SGPI_ID, $sgpiId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiTransTableMap::COL_SGPI_ID, $sgpiId, $comparison);

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
     * @see       filterBySgpiAccounts()
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
                $this->addUsingAlias(SgpiTransTableMap::COL_SGPI_ACCOUNT_ID, $sgpiAccountId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($sgpiAccountId['max'])) {
                $this->addUsingAlias(SgpiTransTableMap::COL_SGPI_ACCOUNT_ID, $sgpiAccountId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiTransTableMap::COL_SGPI_ACCOUNT_ID, $sgpiAccountId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the cd column
     *
     * Example usage:
     * <code>
     * $query->filterByCd('fooValue');   // WHERE cd = 'fooValue'
     * $query->filterByCd('%fooValue%', Criteria::LIKE); // WHERE cd LIKE '%fooValue%'
     * $query->filterByCd(['foo', 'bar']); // WHERE cd IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $cd The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCd($cd = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cd)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiTransTableMap::COL_CD, $cd, $comparison);

        return $this;
    }

    /**
     * Filter the query on the qty column
     *
     * Example usage:
     * <code>
     * $query->filterByQty(1234); // WHERE qty = 1234
     * $query->filterByQty(array(12, 34)); // WHERE qty IN (12, 34)
     * $query->filterByQty(array('min' => 12)); // WHERE qty > 12
     * </code>
     *
     * @param mixed $qty The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByQty($qty = null, ?string $comparison = null)
    {
        if (is_array($qty)) {
            $useMinMax = false;
            if (isset($qty['min'])) {
                $this->addUsingAlias(SgpiTransTableMap::COL_QTY, $qty['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($qty['max'])) {
                $this->addUsingAlias(SgpiTransTableMap::COL_QTY, $qty['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiTransTableMap::COL_QTY, $qty, $comparison);

        return $this;
    }

    /**
     * Filter the query on the voucher_no column
     *
     * Example usage:
     * <code>
     * $query->filterByVoucherNo(1234); // WHERE voucher_no = 1234
     * $query->filterByVoucherNo(array(12, 34)); // WHERE voucher_no IN (12, 34)
     * $query->filterByVoucherNo(array('min' => 12)); // WHERE voucher_no > 12
     * </code>
     *
     * @param mixed $voucherNo The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByVoucherNo($voucherNo = null, ?string $comparison = null)
    {
        if (is_array($voucherNo)) {
            $useMinMax = false;
            if (isset($voucherNo['min'])) {
                $this->addUsingAlias(SgpiTransTableMap::COL_VOUCHER_NO, $voucherNo['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($voucherNo['max'])) {
                $this->addUsingAlias(SgpiTransTableMap::COL_VOUCHER_NO, $voucherNo['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiTransTableMap::COL_VOUCHER_NO, $voucherNo, $comparison);

        return $this;
    }

    /**
     * Filter the query on the remark column
     *
     * Example usage:
     * <code>
     * $query->filterByRemark('fooValue');   // WHERE remark = 'fooValue'
     * $query->filterByRemark('%fooValue%', Criteria::LIKE); // WHERE remark LIKE '%fooValue%'
     * $query->filterByRemark(['foo', 'bar']); // WHERE remark IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $remark The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRemark($remark = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($remark)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiTransTableMap::COL_REMARK, $remark, $comparison);

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
                $this->addUsingAlias(SgpiTransTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(SgpiTransTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiTransTableMap::COL_COMPANY_ID, $companyId, $comparison);

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
                $this->addUsingAlias(SgpiTransTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(SgpiTransTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiTransTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(SgpiTransTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(SgpiTransTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiTransTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_org_id column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletOrgId(1234); // WHERE outlet_org_id = 1234
     * $query->filterByOutletOrgId(array(12, 34)); // WHERE outlet_org_id IN (12, 34)
     * $query->filterByOutletOrgId(array('min' => 12)); // WHERE outlet_org_id > 12
     * </code>
     *
     * @param mixed $outletOrgId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletOrgId($outletOrgId = null, ?string $comparison = null)
    {
        if (is_array($outletOrgId)) {
            $useMinMax = false;
            if (isset($outletOrgId['min'])) {
                $this->addUsingAlias(SgpiTransTableMap::COL_OUTLET_ORG_ID, $outletOrgId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outletOrgId['max'])) {
                $this->addUsingAlias(SgpiTransTableMap::COL_OUTLET_ORG_ID, $outletOrgId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiTransTableMap::COL_OUTLET_ORG_ID, $outletOrgId, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \entities\SgpiAccounts object
     *
     * @param \entities\SgpiAccounts|ObjectCollection $sgpiAccounts The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySgpiAccounts($sgpiAccounts, ?string $comparison = null)
    {
        if ($sgpiAccounts instanceof \entities\SgpiAccounts) {
            return $this
                ->addUsingAlias(SgpiTransTableMap::COL_SGPI_ACCOUNT_ID, $sgpiAccounts->getSgpiAccountId(), $comparison);
        } elseif ($sgpiAccounts instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SgpiTransTableMap::COL_SGPI_ACCOUNT_ID, $sgpiAccounts->toKeyValue('PrimaryKey', 'SgpiAccountId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterBySgpiAccounts() only accepts arguments of type \entities\SgpiAccounts or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SgpiAccounts relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSgpiAccounts(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SgpiAccounts');

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
            $this->addJoinObject($join, 'SgpiAccounts');
        }

        return $this;
    }

    /**
     * Use the SgpiAccounts relation SgpiAccounts object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\SgpiAccountsQuery A secondary query class using the current class as primary query
     */
    public function useSgpiAccountsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSgpiAccounts($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SgpiAccounts', '\entities\SgpiAccountsQuery');
    }

    /**
     * Use the SgpiAccounts relation SgpiAccounts object
     *
     * @param callable(\entities\SgpiAccountsQuery):\entities\SgpiAccountsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSgpiAccountsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useSgpiAccountsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SgpiAccounts table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\SgpiAccountsQuery The inner query object of the EXISTS statement
     */
    public function useSgpiAccountsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\SgpiAccountsQuery */
        $q = $this->useExistsQuery('SgpiAccounts', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SgpiAccounts table for a NOT EXISTS query.
     *
     * @see useSgpiAccountsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\SgpiAccountsQuery The inner query object of the NOT EXISTS statement
     */
    public function useSgpiAccountsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\SgpiAccountsQuery */
        $q = $this->useExistsQuery('SgpiAccounts', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SgpiAccounts table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\SgpiAccountsQuery The inner query object of the IN statement
     */
    public function useInSgpiAccountsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\SgpiAccountsQuery */
        $q = $this->useInQuery('SgpiAccounts', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SgpiAccounts table for a NOT IN query.
     *
     * @see useSgpiAccountsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\SgpiAccountsQuery The inner query object of the NOT IN statement
     */
    public function useNotInSgpiAccountsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\SgpiAccountsQuery */
        $q = $this->useInQuery('SgpiAccounts', $modelAlias, $queryClass, 'NOT IN');
        return $q;
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
                ->addUsingAlias(SgpiTransTableMap::COL_COMPANY_ID, $company->getCompanyId(), $comparison);
        } elseif ($company instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SgpiTransTableMap::COL_COMPANY_ID, $company->toKeyValue('PrimaryKey', 'CompanyId'), $comparison);

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
                ->addUsingAlias(SgpiTransTableMap::COL_SGPI_ID, $sgpiMaster->getSgpiId(), $comparison);
        } elseif ($sgpiMaster instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SgpiTransTableMap::COL_SGPI_ID, $sgpiMaster->toKeyValue('PrimaryKey', 'SgpiId'), $comparison);

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
     * Exclude object from result
     *
     * @param ChildSgpiTrans $sgpiTrans Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($sgpiTrans = null)
    {
        if ($sgpiTrans) {
            $this->addUsingAlias(SgpiTransTableMap::COL_SGPI_TRAN_ID, $sgpiTrans->getSgpiTranId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the sgpi_trans table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SgpiTransTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SgpiTransTableMap::clearInstancePool();
            SgpiTransTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SgpiTransTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SgpiTransTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SgpiTransTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SgpiTransTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
