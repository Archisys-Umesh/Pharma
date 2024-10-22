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
use entities\StockVoucher as ChildStockVoucher;
use entities\StockVoucherQuery as ChildStockVoucherQuery;
use entities\Map\StockVoucherTableMap;

/**
 * Base class that represents a query for the `stock_voucher` table.
 *
 * @method     ChildStockVoucherQuery orderBySvid($order = Criteria::ASC) Order by the svid column
 * @method     ChildStockVoucherQuery orderBySvUserId($order = Criteria::ASC) Order by the sv_user_id column
 * @method     ChildStockVoucherQuery orderBySvDate($order = Criteria::ASC) Order by the sv_date column
 * @method     ChildStockVoucherQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildStockVoucherQuery orderBySvRemark($order = Criteria::ASC) Order by the sv_remark column
 * @method     ChildStockVoucherQuery orderBySvDesc($order = Criteria::ASC) Order by the sv_desc column
 * @method     ChildStockVoucherQuery orderBySvType($order = Criteria::ASC) Order by the sv_type column
 * @method     ChildStockVoucherQuery orderByTotalQty($order = Criteria::ASC) Order by the total_qty column
 * @method     ChildStockVoucherQuery orderBySvError($order = Criteria::ASC) Order by the sv_error column
 * @method     ChildStockVoucherQuery orderBySvStatus($order = Criteria::ASC) Order by the sv_status column
 *
 * @method     ChildStockVoucherQuery groupBySvid() Group by the svid column
 * @method     ChildStockVoucherQuery groupBySvUserId() Group by the sv_user_id column
 * @method     ChildStockVoucherQuery groupBySvDate() Group by the sv_date column
 * @method     ChildStockVoucherQuery groupByCompanyId() Group by the company_id column
 * @method     ChildStockVoucherQuery groupBySvRemark() Group by the sv_remark column
 * @method     ChildStockVoucherQuery groupBySvDesc() Group by the sv_desc column
 * @method     ChildStockVoucherQuery groupBySvType() Group by the sv_type column
 * @method     ChildStockVoucherQuery groupByTotalQty() Group by the total_qty column
 * @method     ChildStockVoucherQuery groupBySvError() Group by the sv_error column
 * @method     ChildStockVoucherQuery groupBySvStatus() Group by the sv_status column
 *
 * @method     ChildStockVoucherQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildStockVoucherQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildStockVoucherQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildStockVoucherQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildStockVoucherQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildStockVoucherQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildStockVoucherQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildStockVoucherQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildStockVoucherQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildStockVoucherQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildStockVoucherQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildStockVoucherQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildStockVoucherQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     ChildStockVoucherQuery leftJoinUsers($relationAlias = null) Adds a LEFT JOIN clause to the query using the Users relation
 * @method     ChildStockVoucherQuery rightJoinUsers($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Users relation
 * @method     ChildStockVoucherQuery innerJoinUsers($relationAlias = null) Adds a INNER JOIN clause to the query using the Users relation
 *
 * @method     ChildStockVoucherQuery joinWithUsers($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Users relation
 *
 * @method     ChildStockVoucherQuery leftJoinWithUsers() Adds a LEFT JOIN clause and with to the query using the Users relation
 * @method     ChildStockVoucherQuery rightJoinWithUsers() Adds a RIGHT JOIN clause and with to the query using the Users relation
 * @method     ChildStockVoucherQuery innerJoinWithUsers() Adds a INNER JOIN clause and with to the query using the Users relation
 *
 * @method     ChildStockVoucherQuery leftJoinShippingorder($relationAlias = null) Adds a LEFT JOIN clause to the query using the Shippingorder relation
 * @method     ChildStockVoucherQuery rightJoinShippingorder($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Shippingorder relation
 * @method     ChildStockVoucherQuery innerJoinShippingorder($relationAlias = null) Adds a INNER JOIN clause to the query using the Shippingorder relation
 *
 * @method     ChildStockVoucherQuery joinWithShippingorder($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Shippingorder relation
 *
 * @method     ChildStockVoucherQuery leftJoinWithShippingorder() Adds a LEFT JOIN clause and with to the query using the Shippingorder relation
 * @method     ChildStockVoucherQuery rightJoinWithShippingorder() Adds a RIGHT JOIN clause and with to the query using the Shippingorder relation
 * @method     ChildStockVoucherQuery innerJoinWithShippingorder() Adds a INNER JOIN clause and with to the query using the Shippingorder relation
 *
 * @method     ChildStockVoucherQuery leftJoinStockTransaction($relationAlias = null) Adds a LEFT JOIN clause to the query using the StockTransaction relation
 * @method     ChildStockVoucherQuery rightJoinStockTransaction($relationAlias = null) Adds a RIGHT JOIN clause to the query using the StockTransaction relation
 * @method     ChildStockVoucherQuery innerJoinStockTransaction($relationAlias = null) Adds a INNER JOIN clause to the query using the StockTransaction relation
 *
 * @method     ChildStockVoucherQuery joinWithStockTransaction($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the StockTransaction relation
 *
 * @method     ChildStockVoucherQuery leftJoinWithStockTransaction() Adds a LEFT JOIN clause and with to the query using the StockTransaction relation
 * @method     ChildStockVoucherQuery rightJoinWithStockTransaction() Adds a RIGHT JOIN clause and with to the query using the StockTransaction relation
 * @method     ChildStockVoucherQuery innerJoinWithStockTransaction() Adds a INNER JOIN clause and with to the query using the StockTransaction relation
 *
 * @method     \entities\CompanyQuery|\entities\UsersQuery|\entities\ShippingorderQuery|\entities\StockTransactionQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildStockVoucher|null findOne(?ConnectionInterface $con = null) Return the first ChildStockVoucher matching the query
 * @method     ChildStockVoucher findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildStockVoucher matching the query, or a new ChildStockVoucher object populated from the query conditions when no match is found
 *
 * @method     ChildStockVoucher|null findOneBySvid(string $svid) Return the first ChildStockVoucher filtered by the svid column
 * @method     ChildStockVoucher|null findOneBySvUserId(int $sv_user_id) Return the first ChildStockVoucher filtered by the sv_user_id column
 * @method     ChildStockVoucher|null findOneBySvDate(string $sv_date) Return the first ChildStockVoucher filtered by the sv_date column
 * @method     ChildStockVoucher|null findOneByCompanyId(int $company_id) Return the first ChildStockVoucher filtered by the company_id column
 * @method     ChildStockVoucher|null findOneBySvRemark(string $sv_remark) Return the first ChildStockVoucher filtered by the sv_remark column
 * @method     ChildStockVoucher|null findOneBySvDesc(string $sv_desc) Return the first ChildStockVoucher filtered by the sv_desc column
 * @method     ChildStockVoucher|null findOneBySvType(string $sv_type) Return the first ChildStockVoucher filtered by the sv_type column
 * @method     ChildStockVoucher|null findOneByTotalQty(int $total_qty) Return the first ChildStockVoucher filtered by the total_qty column
 * @method     ChildStockVoucher|null findOneBySvError(string $sv_error) Return the first ChildStockVoucher filtered by the sv_error column
 * @method     ChildStockVoucher|null findOneBySvStatus(string $sv_status) Return the first ChildStockVoucher filtered by the sv_status column
 *
 * @method     ChildStockVoucher requirePk($key, ?ConnectionInterface $con = null) Return the ChildStockVoucher by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStockVoucher requireOne(?ConnectionInterface $con = null) Return the first ChildStockVoucher matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildStockVoucher requireOneBySvid(string $svid) Return the first ChildStockVoucher filtered by the svid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStockVoucher requireOneBySvUserId(int $sv_user_id) Return the first ChildStockVoucher filtered by the sv_user_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStockVoucher requireOneBySvDate(string $sv_date) Return the first ChildStockVoucher filtered by the sv_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStockVoucher requireOneByCompanyId(int $company_id) Return the first ChildStockVoucher filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStockVoucher requireOneBySvRemark(string $sv_remark) Return the first ChildStockVoucher filtered by the sv_remark column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStockVoucher requireOneBySvDesc(string $sv_desc) Return the first ChildStockVoucher filtered by the sv_desc column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStockVoucher requireOneBySvType(string $sv_type) Return the first ChildStockVoucher filtered by the sv_type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStockVoucher requireOneByTotalQty(int $total_qty) Return the first ChildStockVoucher filtered by the total_qty column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStockVoucher requireOneBySvError(string $sv_error) Return the first ChildStockVoucher filtered by the sv_error column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStockVoucher requireOneBySvStatus(string $sv_status) Return the first ChildStockVoucher filtered by the sv_status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildStockVoucher[]|Collection find(?ConnectionInterface $con = null) Return ChildStockVoucher objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildStockVoucher> find(?ConnectionInterface $con = null) Return ChildStockVoucher objects based on current ModelCriteria
 *
 * @method     ChildStockVoucher[]|Collection findBySvid(string|array<string> $svid) Return ChildStockVoucher objects filtered by the svid column
 * @psalm-method Collection&\Traversable<ChildStockVoucher> findBySvid(string|array<string> $svid) Return ChildStockVoucher objects filtered by the svid column
 * @method     ChildStockVoucher[]|Collection findBySvUserId(int|array<int> $sv_user_id) Return ChildStockVoucher objects filtered by the sv_user_id column
 * @psalm-method Collection&\Traversable<ChildStockVoucher> findBySvUserId(int|array<int> $sv_user_id) Return ChildStockVoucher objects filtered by the sv_user_id column
 * @method     ChildStockVoucher[]|Collection findBySvDate(string|array<string> $sv_date) Return ChildStockVoucher objects filtered by the sv_date column
 * @psalm-method Collection&\Traversable<ChildStockVoucher> findBySvDate(string|array<string> $sv_date) Return ChildStockVoucher objects filtered by the sv_date column
 * @method     ChildStockVoucher[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildStockVoucher objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildStockVoucher> findByCompanyId(int|array<int> $company_id) Return ChildStockVoucher objects filtered by the company_id column
 * @method     ChildStockVoucher[]|Collection findBySvRemark(string|array<string> $sv_remark) Return ChildStockVoucher objects filtered by the sv_remark column
 * @psalm-method Collection&\Traversable<ChildStockVoucher> findBySvRemark(string|array<string> $sv_remark) Return ChildStockVoucher objects filtered by the sv_remark column
 * @method     ChildStockVoucher[]|Collection findBySvDesc(string|array<string> $sv_desc) Return ChildStockVoucher objects filtered by the sv_desc column
 * @psalm-method Collection&\Traversable<ChildStockVoucher> findBySvDesc(string|array<string> $sv_desc) Return ChildStockVoucher objects filtered by the sv_desc column
 * @method     ChildStockVoucher[]|Collection findBySvType(string|array<string> $sv_type) Return ChildStockVoucher objects filtered by the sv_type column
 * @psalm-method Collection&\Traversable<ChildStockVoucher> findBySvType(string|array<string> $sv_type) Return ChildStockVoucher objects filtered by the sv_type column
 * @method     ChildStockVoucher[]|Collection findByTotalQty(int|array<int> $total_qty) Return ChildStockVoucher objects filtered by the total_qty column
 * @psalm-method Collection&\Traversable<ChildStockVoucher> findByTotalQty(int|array<int> $total_qty) Return ChildStockVoucher objects filtered by the total_qty column
 * @method     ChildStockVoucher[]|Collection findBySvError(string|array<string> $sv_error) Return ChildStockVoucher objects filtered by the sv_error column
 * @psalm-method Collection&\Traversable<ChildStockVoucher> findBySvError(string|array<string> $sv_error) Return ChildStockVoucher objects filtered by the sv_error column
 * @method     ChildStockVoucher[]|Collection findBySvStatus(string|array<string> $sv_status) Return ChildStockVoucher objects filtered by the sv_status column
 * @psalm-method Collection&\Traversable<ChildStockVoucher> findBySvStatus(string|array<string> $sv_status) Return ChildStockVoucher objects filtered by the sv_status column
 *
 * @method     ChildStockVoucher[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildStockVoucher> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class StockVoucherQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\StockVoucherQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\StockVoucher', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildStockVoucherQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildStockVoucherQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildStockVoucherQuery) {
            return $criteria;
        }
        $query = new ChildStockVoucherQuery();
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
     * @return ChildStockVoucher|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(StockVoucherTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = StockVoucherTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildStockVoucher A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT svid, sv_user_id, sv_date, company_id, sv_remark, sv_desc, sv_type, total_qty, sv_error, sv_status FROM stock_voucher WHERE svid = :p0';
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
            /** @var ChildStockVoucher $obj */
            $obj = new ChildStockVoucher();
            $obj->hydrate($row);
            StockVoucherTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildStockVoucher|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(StockVoucherTableMap::COL_SVID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(StockVoucherTableMap::COL_SVID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the svid column
     *
     * Example usage:
     * <code>
     * $query->filterBySvid(1234); // WHERE svid = 1234
     * $query->filterBySvid(array(12, 34)); // WHERE svid IN (12, 34)
     * $query->filterBySvid(array('min' => 12)); // WHERE svid > 12
     * </code>
     *
     * @param mixed $svid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySvid($svid = null, ?string $comparison = null)
    {
        if (is_array($svid)) {
            $useMinMax = false;
            if (isset($svid['min'])) {
                $this->addUsingAlias(StockVoucherTableMap::COL_SVID, $svid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($svid['max'])) {
                $this->addUsingAlias(StockVoucherTableMap::COL_SVID, $svid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StockVoucherTableMap::COL_SVID, $svid, $comparison);

        return $this;
    }

    /**
     * Filter the query on the sv_user_id column
     *
     * Example usage:
     * <code>
     * $query->filterBySvUserId(1234); // WHERE sv_user_id = 1234
     * $query->filterBySvUserId(array(12, 34)); // WHERE sv_user_id IN (12, 34)
     * $query->filterBySvUserId(array('min' => 12)); // WHERE sv_user_id > 12
     * </code>
     *
     * @see       filterByUsers()
     *
     * @param mixed $svUserId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySvUserId($svUserId = null, ?string $comparison = null)
    {
        if (is_array($svUserId)) {
            $useMinMax = false;
            if (isset($svUserId['min'])) {
                $this->addUsingAlias(StockVoucherTableMap::COL_SV_USER_ID, $svUserId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($svUserId['max'])) {
                $this->addUsingAlias(StockVoucherTableMap::COL_SV_USER_ID, $svUserId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StockVoucherTableMap::COL_SV_USER_ID, $svUserId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the sv_date column
     *
     * Example usage:
     * <code>
     * $query->filterBySvDate('2011-03-14'); // WHERE sv_date = '2011-03-14'
     * $query->filterBySvDate('now'); // WHERE sv_date = '2011-03-14'
     * $query->filterBySvDate(array('max' => 'yesterday')); // WHERE sv_date > '2011-03-13'
     * </code>
     *
     * @param mixed $svDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySvDate($svDate = null, ?string $comparison = null)
    {
        if (is_array($svDate)) {
            $useMinMax = false;
            if (isset($svDate['min'])) {
                $this->addUsingAlias(StockVoucherTableMap::COL_SV_DATE, $svDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($svDate['max'])) {
                $this->addUsingAlias(StockVoucherTableMap::COL_SV_DATE, $svDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StockVoucherTableMap::COL_SV_DATE, $svDate, $comparison);

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
                $this->addUsingAlias(StockVoucherTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(StockVoucherTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StockVoucherTableMap::COL_COMPANY_ID, $companyId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the sv_remark column
     *
     * Example usage:
     * <code>
     * $query->filterBySvRemark('fooValue');   // WHERE sv_remark = 'fooValue'
     * $query->filterBySvRemark('%fooValue%', Criteria::LIKE); // WHERE sv_remark LIKE '%fooValue%'
     * $query->filterBySvRemark(['foo', 'bar']); // WHERE sv_remark IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $svRemark The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySvRemark($svRemark = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($svRemark)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StockVoucherTableMap::COL_SV_REMARK, $svRemark, $comparison);

        return $this;
    }

    /**
     * Filter the query on the sv_desc column
     *
     * Example usage:
     * <code>
     * $query->filterBySvDesc('fooValue');   // WHERE sv_desc = 'fooValue'
     * $query->filterBySvDesc('%fooValue%', Criteria::LIKE); // WHERE sv_desc LIKE '%fooValue%'
     * $query->filterBySvDesc(['foo', 'bar']); // WHERE sv_desc IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $svDesc The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySvDesc($svDesc = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($svDesc)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StockVoucherTableMap::COL_SV_DESC, $svDesc, $comparison);

        return $this;
    }

    /**
     * Filter the query on the sv_type column
     *
     * Example usage:
     * <code>
     * $query->filterBySvType('fooValue');   // WHERE sv_type = 'fooValue'
     * $query->filterBySvType('%fooValue%', Criteria::LIKE); // WHERE sv_type LIKE '%fooValue%'
     * $query->filterBySvType(['foo', 'bar']); // WHERE sv_type IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $svType The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySvType($svType = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($svType)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StockVoucherTableMap::COL_SV_TYPE, $svType, $comparison);

        return $this;
    }

    /**
     * Filter the query on the total_qty column
     *
     * Example usage:
     * <code>
     * $query->filterByTotalQty(1234); // WHERE total_qty = 1234
     * $query->filterByTotalQty(array(12, 34)); // WHERE total_qty IN (12, 34)
     * $query->filterByTotalQty(array('min' => 12)); // WHERE total_qty > 12
     * </code>
     *
     * @param mixed $totalQty The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTotalQty($totalQty = null, ?string $comparison = null)
    {
        if (is_array($totalQty)) {
            $useMinMax = false;
            if (isset($totalQty['min'])) {
                $this->addUsingAlias(StockVoucherTableMap::COL_TOTAL_QTY, $totalQty['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($totalQty['max'])) {
                $this->addUsingAlias(StockVoucherTableMap::COL_TOTAL_QTY, $totalQty['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StockVoucherTableMap::COL_TOTAL_QTY, $totalQty, $comparison);

        return $this;
    }

    /**
     * Filter the query on the sv_error column
     *
     * Example usage:
     * <code>
     * $query->filterBySvError('fooValue');   // WHERE sv_error = 'fooValue'
     * $query->filterBySvError('%fooValue%', Criteria::LIKE); // WHERE sv_error LIKE '%fooValue%'
     * $query->filterBySvError(['foo', 'bar']); // WHERE sv_error IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $svError The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySvError($svError = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($svError)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StockVoucherTableMap::COL_SV_ERROR, $svError, $comparison);

        return $this;
    }

    /**
     * Filter the query on the sv_status column
     *
     * Example usage:
     * <code>
     * $query->filterBySvStatus('fooValue');   // WHERE sv_status = 'fooValue'
     * $query->filterBySvStatus('%fooValue%', Criteria::LIKE); // WHERE sv_status LIKE '%fooValue%'
     * $query->filterBySvStatus(['foo', 'bar']); // WHERE sv_status IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $svStatus The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySvStatus($svStatus = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($svStatus)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StockVoucherTableMap::COL_SV_STATUS, $svStatus, $comparison);

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
                ->addUsingAlias(StockVoucherTableMap::COL_COMPANY_ID, $company->getCompanyId(), $comparison);
        } elseif ($company instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(StockVoucherTableMap::COL_COMPANY_ID, $company->toKeyValue('PrimaryKey', 'CompanyId'), $comparison);

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
     * Filter the query by a related \entities\Users object
     *
     * @param \entities\Users|ObjectCollection $users The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUsers($users, ?string $comparison = null)
    {
        if ($users instanceof \entities\Users) {
            return $this
                ->addUsingAlias(StockVoucherTableMap::COL_SV_USER_ID, $users->getUserId(), $comparison);
        } elseif ($users instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(StockVoucherTableMap::COL_SV_USER_ID, $users->toKeyValue('PrimaryKey', 'UserId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByUsers() only accepts arguments of type \entities\Users or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Users relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinUsers(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Users');

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
            $this->addJoinObject($join, 'Users');
        }

        return $this;
    }

    /**
     * Use the Users relation Users object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\UsersQuery A secondary query class using the current class as primary query
     */
    public function useUsersQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUsers($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Users', '\entities\UsersQuery');
    }

    /**
     * Use the Users relation Users object
     *
     * @param callable(\entities\UsersQuery):\entities\UsersQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withUsersQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useUsersQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Users table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\UsersQuery The inner query object of the EXISTS statement
     */
    public function useUsersExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\UsersQuery */
        $q = $this->useExistsQuery('Users', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Users table for a NOT EXISTS query.
     *
     * @see useUsersExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\UsersQuery The inner query object of the NOT EXISTS statement
     */
    public function useUsersNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\UsersQuery */
        $q = $this->useExistsQuery('Users', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Users table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\UsersQuery The inner query object of the IN statement
     */
    public function useInUsersQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\UsersQuery */
        $q = $this->useInQuery('Users', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Users table for a NOT IN query.
     *
     * @see useUsersInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\UsersQuery The inner query object of the NOT IN statement
     */
    public function useNotInUsersQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\UsersQuery */
        $q = $this->useInQuery('Users', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\Shippingorder object
     *
     * @param \entities\Shippingorder|ObjectCollection $shippingorder the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByShippingorder($shippingorder, ?string $comparison = null)
    {
        if ($shippingorder instanceof \entities\Shippingorder) {
            $this
                ->addUsingAlias(StockVoucherTableMap::COL_SVID, $shippingorder->getSvId(), $comparison);

            return $this;
        } elseif ($shippingorder instanceof ObjectCollection) {
            $this
                ->useShippingorderQuery()
                ->filterByPrimaryKeys($shippingorder->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByShippingorder() only accepts arguments of type \entities\Shippingorder or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Shippingorder relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinShippingorder(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Shippingorder');

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
            $this->addJoinObject($join, 'Shippingorder');
        }

        return $this;
    }

    /**
     * Use the Shippingorder relation Shippingorder object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\ShippingorderQuery A secondary query class using the current class as primary query
     */
    public function useShippingorderQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinShippingorder($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Shippingorder', '\entities\ShippingorderQuery');
    }

    /**
     * Use the Shippingorder relation Shippingorder object
     *
     * @param callable(\entities\ShippingorderQuery):\entities\ShippingorderQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withShippingorderQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useShippingorderQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Shippingorder table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\ShippingorderQuery The inner query object of the EXISTS statement
     */
    public function useShippingorderExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\ShippingorderQuery */
        $q = $this->useExistsQuery('Shippingorder', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Shippingorder table for a NOT EXISTS query.
     *
     * @see useShippingorderExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\ShippingorderQuery The inner query object of the NOT EXISTS statement
     */
    public function useShippingorderNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\ShippingorderQuery */
        $q = $this->useExistsQuery('Shippingorder', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Shippingorder table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\ShippingorderQuery The inner query object of the IN statement
     */
    public function useInShippingorderQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\ShippingorderQuery */
        $q = $this->useInQuery('Shippingorder', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Shippingorder table for a NOT IN query.
     *
     * @see useShippingorderInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\ShippingorderQuery The inner query object of the NOT IN statement
     */
    public function useNotInShippingorderQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\ShippingorderQuery */
        $q = $this->useInQuery('Shippingorder', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\StockTransaction object
     *
     * @param \entities\StockTransaction|ObjectCollection $stockTransaction the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStockTransaction($stockTransaction, ?string $comparison = null)
    {
        if ($stockTransaction instanceof \entities\StockTransaction) {
            $this
                ->addUsingAlias(StockVoucherTableMap::COL_SVID, $stockTransaction->getSvId(), $comparison);

            return $this;
        } elseif ($stockTransaction instanceof ObjectCollection) {
            $this
                ->useStockTransactionQuery()
                ->filterByPrimaryKeys($stockTransaction->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByStockTransaction() only accepts arguments of type \entities\StockTransaction or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the StockTransaction relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinStockTransaction(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('StockTransaction');

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
            $this->addJoinObject($join, 'StockTransaction');
        }

        return $this;
    }

    /**
     * Use the StockTransaction relation StockTransaction object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\StockTransactionQuery A secondary query class using the current class as primary query
     */
    public function useStockTransactionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinStockTransaction($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'StockTransaction', '\entities\StockTransactionQuery');
    }

    /**
     * Use the StockTransaction relation StockTransaction object
     *
     * @param callable(\entities\StockTransactionQuery):\entities\StockTransactionQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withStockTransactionQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useStockTransactionQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to StockTransaction table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\StockTransactionQuery The inner query object of the EXISTS statement
     */
    public function useStockTransactionExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\StockTransactionQuery */
        $q = $this->useExistsQuery('StockTransaction', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to StockTransaction table for a NOT EXISTS query.
     *
     * @see useStockTransactionExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\StockTransactionQuery The inner query object of the NOT EXISTS statement
     */
    public function useStockTransactionNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\StockTransactionQuery */
        $q = $this->useExistsQuery('StockTransaction', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to StockTransaction table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\StockTransactionQuery The inner query object of the IN statement
     */
    public function useInStockTransactionQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\StockTransactionQuery */
        $q = $this->useInQuery('StockTransaction', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to StockTransaction table for a NOT IN query.
     *
     * @see useStockTransactionInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\StockTransactionQuery The inner query object of the NOT IN statement
     */
    public function useNotInStockTransactionQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\StockTransactionQuery */
        $q = $this->useInQuery('StockTransaction', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildStockVoucher $stockVoucher Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($stockVoucher = null)
    {
        if ($stockVoucher) {
            $this->addUsingAlias(StockVoucherTableMap::COL_SVID, $stockVoucher->getSvid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the stock_voucher table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(StockVoucherTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            StockVoucherTableMap::clearInstancePool();
            StockVoucherTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(StockVoucherTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(StockVoucherTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            StockVoucherTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            StockVoucherTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
