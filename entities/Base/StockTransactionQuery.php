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
use entities\StockTransaction as ChildStockTransaction;
use entities\StockTransactionQuery as ChildStockTransactionQuery;
use entities\Map\StockTransactionTableMap;

/**
 * Base class that represents a query for the `stock_transaction` table.
 *
 * @method     ChildStockTransactionQuery orderByStid($order = Criteria::ASC) Order by the stid column
 * @method     ChildStockTransactionQuery orderBySvId($order = Criteria::ASC) Order by the sv_id column
 * @method     ChildStockTransactionQuery orderBySku($order = Criteria::ASC) Order by the sku column
 * @method     ChildStockTransactionQuery orderBySerialNo($order = Criteria::ASC) Order by the serial_no column
 * @method     ChildStockTransactionQuery orderByBatchNo($order = Criteria::ASC) Order by the batch_no column
 * @method     ChildStockTransactionQuery orderByQty($order = Criteria::ASC) Order by the qty column
 * @method     ChildStockTransactionQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildStockTransactionQuery orderByProductId($order = Criteria::ASC) Order by the product_id column
 * @method     ChildStockTransactionQuery orderByOutletId($order = Criteria::ASC) Order by the outlet_id column
 * @method     ChildStockTransactionQuery orderByTranType($order = Criteria::ASC) Order by the tran_type column
 * @method     ChildStockTransactionQuery orderByRefNum($order = Criteria::ASC) Order by the ref_num column
 * @method     ChildStockTransactionQuery orderByRefDesc($order = Criteria::ASC) Order by the ref_desc column
 * @method     ChildStockTransactionQuery orderByTranDate($order = Criteria::ASC) Order by the tran_date column
 * @method     ChildStockTransactionQuery orderByCreatedUser($order = Criteria::ASC) Order by the created_user column
 *
 * @method     ChildStockTransactionQuery groupByStid() Group by the stid column
 * @method     ChildStockTransactionQuery groupBySvId() Group by the sv_id column
 * @method     ChildStockTransactionQuery groupBySku() Group by the sku column
 * @method     ChildStockTransactionQuery groupBySerialNo() Group by the serial_no column
 * @method     ChildStockTransactionQuery groupByBatchNo() Group by the batch_no column
 * @method     ChildStockTransactionQuery groupByQty() Group by the qty column
 * @method     ChildStockTransactionQuery groupByCompanyId() Group by the company_id column
 * @method     ChildStockTransactionQuery groupByProductId() Group by the product_id column
 * @method     ChildStockTransactionQuery groupByOutletId() Group by the outlet_id column
 * @method     ChildStockTransactionQuery groupByTranType() Group by the tran_type column
 * @method     ChildStockTransactionQuery groupByRefNum() Group by the ref_num column
 * @method     ChildStockTransactionQuery groupByRefDesc() Group by the ref_desc column
 * @method     ChildStockTransactionQuery groupByTranDate() Group by the tran_date column
 * @method     ChildStockTransactionQuery groupByCreatedUser() Group by the created_user column
 *
 * @method     ChildStockTransactionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildStockTransactionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildStockTransactionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildStockTransactionQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildStockTransactionQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildStockTransactionQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildStockTransactionQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildStockTransactionQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildStockTransactionQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildStockTransactionQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildStockTransactionQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildStockTransactionQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildStockTransactionQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     ChildStockTransactionQuery leftJoinOutlets($relationAlias = null) Adds a LEFT JOIN clause to the query using the Outlets relation
 * @method     ChildStockTransactionQuery rightJoinOutlets($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Outlets relation
 * @method     ChildStockTransactionQuery innerJoinOutlets($relationAlias = null) Adds a INNER JOIN clause to the query using the Outlets relation
 *
 * @method     ChildStockTransactionQuery joinWithOutlets($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Outlets relation
 *
 * @method     ChildStockTransactionQuery leftJoinWithOutlets() Adds a LEFT JOIN clause and with to the query using the Outlets relation
 * @method     ChildStockTransactionQuery rightJoinWithOutlets() Adds a RIGHT JOIN clause and with to the query using the Outlets relation
 * @method     ChildStockTransactionQuery innerJoinWithOutlets() Adds a INNER JOIN clause and with to the query using the Outlets relation
 *
 * @method     ChildStockTransactionQuery leftJoinProducts($relationAlias = null) Adds a LEFT JOIN clause to the query using the Products relation
 * @method     ChildStockTransactionQuery rightJoinProducts($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Products relation
 * @method     ChildStockTransactionQuery innerJoinProducts($relationAlias = null) Adds a INNER JOIN clause to the query using the Products relation
 *
 * @method     ChildStockTransactionQuery joinWithProducts($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Products relation
 *
 * @method     ChildStockTransactionQuery leftJoinWithProducts() Adds a LEFT JOIN clause and with to the query using the Products relation
 * @method     ChildStockTransactionQuery rightJoinWithProducts() Adds a RIGHT JOIN clause and with to the query using the Products relation
 * @method     ChildStockTransactionQuery innerJoinWithProducts() Adds a INNER JOIN clause and with to the query using the Products relation
 *
 * @method     ChildStockTransactionQuery leftJoinStockVoucher($relationAlias = null) Adds a LEFT JOIN clause to the query using the StockVoucher relation
 * @method     ChildStockTransactionQuery rightJoinStockVoucher($relationAlias = null) Adds a RIGHT JOIN clause to the query using the StockVoucher relation
 * @method     ChildStockTransactionQuery innerJoinStockVoucher($relationAlias = null) Adds a INNER JOIN clause to the query using the StockVoucher relation
 *
 * @method     ChildStockTransactionQuery joinWithStockVoucher($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the StockVoucher relation
 *
 * @method     ChildStockTransactionQuery leftJoinWithStockVoucher() Adds a LEFT JOIN clause and with to the query using the StockVoucher relation
 * @method     ChildStockTransactionQuery rightJoinWithStockVoucher() Adds a RIGHT JOIN clause and with to the query using the StockVoucher relation
 * @method     ChildStockTransactionQuery innerJoinWithStockVoucher() Adds a INNER JOIN clause and with to the query using the StockVoucher relation
 *
 * @method     ChildStockTransactionQuery leftJoinUsers($relationAlias = null) Adds a LEFT JOIN clause to the query using the Users relation
 * @method     ChildStockTransactionQuery rightJoinUsers($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Users relation
 * @method     ChildStockTransactionQuery innerJoinUsers($relationAlias = null) Adds a INNER JOIN clause to the query using the Users relation
 *
 * @method     ChildStockTransactionQuery joinWithUsers($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Users relation
 *
 * @method     ChildStockTransactionQuery leftJoinWithUsers() Adds a LEFT JOIN clause and with to the query using the Users relation
 * @method     ChildStockTransactionQuery rightJoinWithUsers() Adds a RIGHT JOIN clause and with to the query using the Users relation
 * @method     ChildStockTransactionQuery innerJoinWithUsers() Adds a INNER JOIN clause and with to the query using the Users relation
 *
 * @method     \entities\CompanyQuery|\entities\OutletsQuery|\entities\ProductsQuery|\entities\StockVoucherQuery|\entities\UsersQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildStockTransaction|null findOne(?ConnectionInterface $con = null) Return the first ChildStockTransaction matching the query
 * @method     ChildStockTransaction findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildStockTransaction matching the query, or a new ChildStockTransaction object populated from the query conditions when no match is found
 *
 * @method     ChildStockTransaction|null findOneByStid(string $stid) Return the first ChildStockTransaction filtered by the stid column
 * @method     ChildStockTransaction|null findOneBySvId(string $sv_id) Return the first ChildStockTransaction filtered by the sv_id column
 * @method     ChildStockTransaction|null findOneBySku(string $sku) Return the first ChildStockTransaction filtered by the sku column
 * @method     ChildStockTransaction|null findOneBySerialNo(string $serial_no) Return the first ChildStockTransaction filtered by the serial_no column
 * @method     ChildStockTransaction|null findOneByBatchNo(string $batch_no) Return the first ChildStockTransaction filtered by the batch_no column
 * @method     ChildStockTransaction|null findOneByQty(string $qty) Return the first ChildStockTransaction filtered by the qty column
 * @method     ChildStockTransaction|null findOneByCompanyId(int $company_id) Return the first ChildStockTransaction filtered by the company_id column
 * @method     ChildStockTransaction|null findOneByProductId(int $product_id) Return the first ChildStockTransaction filtered by the product_id column
 * @method     ChildStockTransaction|null findOneByOutletId(int $outlet_id) Return the first ChildStockTransaction filtered by the outlet_id column
 * @method     ChildStockTransaction|null findOneByTranType(string $tran_type) Return the first ChildStockTransaction filtered by the tran_type column
 * @method     ChildStockTransaction|null findOneByRefNum(string $ref_num) Return the first ChildStockTransaction filtered by the ref_num column
 * @method     ChildStockTransaction|null findOneByRefDesc(string $ref_desc) Return the first ChildStockTransaction filtered by the ref_desc column
 * @method     ChildStockTransaction|null findOneByTranDate(string $tran_date) Return the first ChildStockTransaction filtered by the tran_date column
 * @method     ChildStockTransaction|null findOneByCreatedUser(int $created_user) Return the first ChildStockTransaction filtered by the created_user column
 *
 * @method     ChildStockTransaction requirePk($key, ?ConnectionInterface $con = null) Return the ChildStockTransaction by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStockTransaction requireOne(?ConnectionInterface $con = null) Return the first ChildStockTransaction matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildStockTransaction requireOneByStid(string $stid) Return the first ChildStockTransaction filtered by the stid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStockTransaction requireOneBySvId(string $sv_id) Return the first ChildStockTransaction filtered by the sv_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStockTransaction requireOneBySku(string $sku) Return the first ChildStockTransaction filtered by the sku column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStockTransaction requireOneBySerialNo(string $serial_no) Return the first ChildStockTransaction filtered by the serial_no column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStockTransaction requireOneByBatchNo(string $batch_no) Return the first ChildStockTransaction filtered by the batch_no column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStockTransaction requireOneByQty(string $qty) Return the first ChildStockTransaction filtered by the qty column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStockTransaction requireOneByCompanyId(int $company_id) Return the first ChildStockTransaction filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStockTransaction requireOneByProductId(int $product_id) Return the first ChildStockTransaction filtered by the product_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStockTransaction requireOneByOutletId(int $outlet_id) Return the first ChildStockTransaction filtered by the outlet_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStockTransaction requireOneByTranType(string $tran_type) Return the first ChildStockTransaction filtered by the tran_type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStockTransaction requireOneByRefNum(string $ref_num) Return the first ChildStockTransaction filtered by the ref_num column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStockTransaction requireOneByRefDesc(string $ref_desc) Return the first ChildStockTransaction filtered by the ref_desc column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStockTransaction requireOneByTranDate(string $tran_date) Return the first ChildStockTransaction filtered by the tran_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStockTransaction requireOneByCreatedUser(int $created_user) Return the first ChildStockTransaction filtered by the created_user column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildStockTransaction[]|Collection find(?ConnectionInterface $con = null) Return ChildStockTransaction objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildStockTransaction> find(?ConnectionInterface $con = null) Return ChildStockTransaction objects based on current ModelCriteria
 *
 * @method     ChildStockTransaction[]|Collection findByStid(string|array<string> $stid) Return ChildStockTransaction objects filtered by the stid column
 * @psalm-method Collection&\Traversable<ChildStockTransaction> findByStid(string|array<string> $stid) Return ChildStockTransaction objects filtered by the stid column
 * @method     ChildStockTransaction[]|Collection findBySvId(string|array<string> $sv_id) Return ChildStockTransaction objects filtered by the sv_id column
 * @psalm-method Collection&\Traversable<ChildStockTransaction> findBySvId(string|array<string> $sv_id) Return ChildStockTransaction objects filtered by the sv_id column
 * @method     ChildStockTransaction[]|Collection findBySku(string|array<string> $sku) Return ChildStockTransaction objects filtered by the sku column
 * @psalm-method Collection&\Traversable<ChildStockTransaction> findBySku(string|array<string> $sku) Return ChildStockTransaction objects filtered by the sku column
 * @method     ChildStockTransaction[]|Collection findBySerialNo(string|array<string> $serial_no) Return ChildStockTransaction objects filtered by the serial_no column
 * @psalm-method Collection&\Traversable<ChildStockTransaction> findBySerialNo(string|array<string> $serial_no) Return ChildStockTransaction objects filtered by the serial_no column
 * @method     ChildStockTransaction[]|Collection findByBatchNo(string|array<string> $batch_no) Return ChildStockTransaction objects filtered by the batch_no column
 * @psalm-method Collection&\Traversable<ChildStockTransaction> findByBatchNo(string|array<string> $batch_no) Return ChildStockTransaction objects filtered by the batch_no column
 * @method     ChildStockTransaction[]|Collection findByQty(string|array<string> $qty) Return ChildStockTransaction objects filtered by the qty column
 * @psalm-method Collection&\Traversable<ChildStockTransaction> findByQty(string|array<string> $qty) Return ChildStockTransaction objects filtered by the qty column
 * @method     ChildStockTransaction[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildStockTransaction objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildStockTransaction> findByCompanyId(int|array<int> $company_id) Return ChildStockTransaction objects filtered by the company_id column
 * @method     ChildStockTransaction[]|Collection findByProductId(int|array<int> $product_id) Return ChildStockTransaction objects filtered by the product_id column
 * @psalm-method Collection&\Traversable<ChildStockTransaction> findByProductId(int|array<int> $product_id) Return ChildStockTransaction objects filtered by the product_id column
 * @method     ChildStockTransaction[]|Collection findByOutletId(int|array<int> $outlet_id) Return ChildStockTransaction objects filtered by the outlet_id column
 * @psalm-method Collection&\Traversable<ChildStockTransaction> findByOutletId(int|array<int> $outlet_id) Return ChildStockTransaction objects filtered by the outlet_id column
 * @method     ChildStockTransaction[]|Collection findByTranType(string|array<string> $tran_type) Return ChildStockTransaction objects filtered by the tran_type column
 * @psalm-method Collection&\Traversable<ChildStockTransaction> findByTranType(string|array<string> $tran_type) Return ChildStockTransaction objects filtered by the tran_type column
 * @method     ChildStockTransaction[]|Collection findByRefNum(string|array<string> $ref_num) Return ChildStockTransaction objects filtered by the ref_num column
 * @psalm-method Collection&\Traversable<ChildStockTransaction> findByRefNum(string|array<string> $ref_num) Return ChildStockTransaction objects filtered by the ref_num column
 * @method     ChildStockTransaction[]|Collection findByRefDesc(string|array<string> $ref_desc) Return ChildStockTransaction objects filtered by the ref_desc column
 * @psalm-method Collection&\Traversable<ChildStockTransaction> findByRefDesc(string|array<string> $ref_desc) Return ChildStockTransaction objects filtered by the ref_desc column
 * @method     ChildStockTransaction[]|Collection findByTranDate(string|array<string> $tran_date) Return ChildStockTransaction objects filtered by the tran_date column
 * @psalm-method Collection&\Traversable<ChildStockTransaction> findByTranDate(string|array<string> $tran_date) Return ChildStockTransaction objects filtered by the tran_date column
 * @method     ChildStockTransaction[]|Collection findByCreatedUser(int|array<int> $created_user) Return ChildStockTransaction objects filtered by the created_user column
 * @psalm-method Collection&\Traversable<ChildStockTransaction> findByCreatedUser(int|array<int> $created_user) Return ChildStockTransaction objects filtered by the created_user column
 *
 * @method     ChildStockTransaction[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildStockTransaction> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class StockTransactionQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\StockTransactionQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\StockTransaction', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildStockTransactionQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildStockTransactionQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildStockTransactionQuery) {
            return $criteria;
        }
        $query = new ChildStockTransactionQuery();
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
     * @return ChildStockTransaction|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(StockTransactionTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = StockTransactionTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildStockTransaction A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT stid, sv_id, sku, serial_no, batch_no, qty, company_id, product_id, outlet_id, tran_type, ref_num, ref_desc, tran_date, created_user FROM stock_transaction WHERE stid = :p0';
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
            /** @var ChildStockTransaction $obj */
            $obj = new ChildStockTransaction();
            $obj->hydrate($row);
            StockTransactionTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildStockTransaction|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(StockTransactionTableMap::COL_STID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(StockTransactionTableMap::COL_STID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the stid column
     *
     * Example usage:
     * <code>
     * $query->filterByStid(1234); // WHERE stid = 1234
     * $query->filterByStid(array(12, 34)); // WHERE stid IN (12, 34)
     * $query->filterByStid(array('min' => 12)); // WHERE stid > 12
     * </code>
     *
     * @param mixed $stid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStid($stid = null, ?string $comparison = null)
    {
        if (is_array($stid)) {
            $useMinMax = false;
            if (isset($stid['min'])) {
                $this->addUsingAlias(StockTransactionTableMap::COL_STID, $stid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($stid['max'])) {
                $this->addUsingAlias(StockTransactionTableMap::COL_STID, $stid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StockTransactionTableMap::COL_STID, $stid, $comparison);

        return $this;
    }

    /**
     * Filter the query on the sv_id column
     *
     * Example usage:
     * <code>
     * $query->filterBySvId(1234); // WHERE sv_id = 1234
     * $query->filterBySvId(array(12, 34)); // WHERE sv_id IN (12, 34)
     * $query->filterBySvId(array('min' => 12)); // WHERE sv_id > 12
     * </code>
     *
     * @see       filterByStockVoucher()
     *
     * @param mixed $svId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySvId($svId = null, ?string $comparison = null)
    {
        if (is_array($svId)) {
            $useMinMax = false;
            if (isset($svId['min'])) {
                $this->addUsingAlias(StockTransactionTableMap::COL_SV_ID, $svId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($svId['max'])) {
                $this->addUsingAlias(StockTransactionTableMap::COL_SV_ID, $svId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StockTransactionTableMap::COL_SV_ID, $svId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the sku column
     *
     * Example usage:
     * <code>
     * $query->filterBySku('fooValue');   // WHERE sku = 'fooValue'
     * $query->filterBySku('%fooValue%', Criteria::LIKE); // WHERE sku LIKE '%fooValue%'
     * $query->filterBySku(['foo', 'bar']); // WHERE sku IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $sku The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySku($sku = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($sku)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StockTransactionTableMap::COL_SKU, $sku, $comparison);

        return $this;
    }

    /**
     * Filter the query on the serial_no column
     *
     * Example usage:
     * <code>
     * $query->filterBySerialNo('fooValue');   // WHERE serial_no = 'fooValue'
     * $query->filterBySerialNo('%fooValue%', Criteria::LIKE); // WHERE serial_no LIKE '%fooValue%'
     * $query->filterBySerialNo(['foo', 'bar']); // WHERE serial_no IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $serialNo The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySerialNo($serialNo = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($serialNo)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StockTransactionTableMap::COL_SERIAL_NO, $serialNo, $comparison);

        return $this;
    }

    /**
     * Filter the query on the batch_no column
     *
     * Example usage:
     * <code>
     * $query->filterByBatchNo('fooValue');   // WHERE batch_no = 'fooValue'
     * $query->filterByBatchNo('%fooValue%', Criteria::LIKE); // WHERE batch_no LIKE '%fooValue%'
     * $query->filterByBatchNo(['foo', 'bar']); // WHERE batch_no IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $batchNo The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBatchNo($batchNo = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($batchNo)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StockTransactionTableMap::COL_BATCH_NO, $batchNo, $comparison);

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
                $this->addUsingAlias(StockTransactionTableMap::COL_QTY, $qty['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($qty['max'])) {
                $this->addUsingAlias(StockTransactionTableMap::COL_QTY, $qty['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StockTransactionTableMap::COL_QTY, $qty, $comparison);

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
                $this->addUsingAlias(StockTransactionTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(StockTransactionTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StockTransactionTableMap::COL_COMPANY_ID, $companyId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the product_id column
     *
     * Example usage:
     * <code>
     * $query->filterByProductId(1234); // WHERE product_id = 1234
     * $query->filterByProductId(array(12, 34)); // WHERE product_id IN (12, 34)
     * $query->filterByProductId(array('min' => 12)); // WHERE product_id > 12
     * </code>
     *
     * @see       filterByProducts()
     *
     * @param mixed $productId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProductId($productId = null, ?string $comparison = null)
    {
        if (is_array($productId)) {
            $useMinMax = false;
            if (isset($productId['min'])) {
                $this->addUsingAlias(StockTransactionTableMap::COL_PRODUCT_ID, $productId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($productId['max'])) {
                $this->addUsingAlias(StockTransactionTableMap::COL_PRODUCT_ID, $productId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StockTransactionTableMap::COL_PRODUCT_ID, $productId, $comparison);

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
                $this->addUsingAlias(StockTransactionTableMap::COL_OUTLET_ID, $outletId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outletId['max'])) {
                $this->addUsingAlias(StockTransactionTableMap::COL_OUTLET_ID, $outletId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StockTransactionTableMap::COL_OUTLET_ID, $outletId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the tran_type column
     *
     * Example usage:
     * <code>
     * $query->filterByTranType('fooValue');   // WHERE tran_type = 'fooValue'
     * $query->filterByTranType('%fooValue%', Criteria::LIKE); // WHERE tran_type LIKE '%fooValue%'
     * $query->filterByTranType(['foo', 'bar']); // WHERE tran_type IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $tranType The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTranType($tranType = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tranType)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StockTransactionTableMap::COL_TRAN_TYPE, $tranType, $comparison);

        return $this;
    }

    /**
     * Filter the query on the ref_num column
     *
     * Example usage:
     * <code>
     * $query->filterByRefNum('fooValue');   // WHERE ref_num = 'fooValue'
     * $query->filterByRefNum('%fooValue%', Criteria::LIKE); // WHERE ref_num LIKE '%fooValue%'
     * $query->filterByRefNum(['foo', 'bar']); // WHERE ref_num IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $refNum The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRefNum($refNum = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($refNum)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StockTransactionTableMap::COL_REF_NUM, $refNum, $comparison);

        return $this;
    }

    /**
     * Filter the query on the ref_desc column
     *
     * Example usage:
     * <code>
     * $query->filterByRefDesc('fooValue');   // WHERE ref_desc = 'fooValue'
     * $query->filterByRefDesc('%fooValue%', Criteria::LIKE); // WHERE ref_desc LIKE '%fooValue%'
     * $query->filterByRefDesc(['foo', 'bar']); // WHERE ref_desc IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $refDesc The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRefDesc($refDesc = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($refDesc)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StockTransactionTableMap::COL_REF_DESC, $refDesc, $comparison);

        return $this;
    }

    /**
     * Filter the query on the tran_date column
     *
     * Example usage:
     * <code>
     * $query->filterByTranDate('2011-03-14'); // WHERE tran_date = '2011-03-14'
     * $query->filterByTranDate('now'); // WHERE tran_date = '2011-03-14'
     * $query->filterByTranDate(array('max' => 'yesterday')); // WHERE tran_date > '2011-03-13'
     * </code>
     *
     * @param mixed $tranDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTranDate($tranDate = null, ?string $comparison = null)
    {
        if (is_array($tranDate)) {
            $useMinMax = false;
            if (isset($tranDate['min'])) {
                $this->addUsingAlias(StockTransactionTableMap::COL_TRAN_DATE, $tranDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($tranDate['max'])) {
                $this->addUsingAlias(StockTransactionTableMap::COL_TRAN_DATE, $tranDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StockTransactionTableMap::COL_TRAN_DATE, $tranDate, $comparison);

        return $this;
    }

    /**
     * Filter the query on the created_user column
     *
     * Example usage:
     * <code>
     * $query->filterByCreatedUser(1234); // WHERE created_user = 1234
     * $query->filterByCreatedUser(array(12, 34)); // WHERE created_user IN (12, 34)
     * $query->filterByCreatedUser(array('min' => 12)); // WHERE created_user > 12
     * </code>
     *
     * @see       filterByUsers()
     *
     * @param mixed $createdUser The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCreatedUser($createdUser = null, ?string $comparison = null)
    {
        if (is_array($createdUser)) {
            $useMinMax = false;
            if (isset($createdUser['min'])) {
                $this->addUsingAlias(StockTransactionTableMap::COL_CREATED_USER, $createdUser['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdUser['max'])) {
                $this->addUsingAlias(StockTransactionTableMap::COL_CREATED_USER, $createdUser['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StockTransactionTableMap::COL_CREATED_USER, $createdUser, $comparison);

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
                ->addUsingAlias(StockTransactionTableMap::COL_COMPANY_ID, $company->getCompanyId(), $comparison);
        } elseif ($company instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(StockTransactionTableMap::COL_COMPANY_ID, $company->toKeyValue('PrimaryKey', 'CompanyId'), $comparison);

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
                ->addUsingAlias(StockTransactionTableMap::COL_OUTLET_ID, $outlets->getId(), $comparison);
        } elseif ($outlets instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(StockTransactionTableMap::COL_OUTLET_ID, $outlets->toKeyValue('PrimaryKey', 'Id'), $comparison);

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
    public function joinOutlets(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
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
    public function useOutletsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
        ?string $joinType = Criteria::INNER_JOIN
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
     * Filter the query by a related \entities\Products object
     *
     * @param \entities\Products|ObjectCollection $products The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProducts($products, ?string $comparison = null)
    {
        if ($products instanceof \entities\Products) {
            return $this
                ->addUsingAlias(StockTransactionTableMap::COL_PRODUCT_ID, $products->getId(), $comparison);
        } elseif ($products instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(StockTransactionTableMap::COL_PRODUCT_ID, $products->toKeyValue('PrimaryKey', 'Id'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByProducts() only accepts arguments of type \entities\Products or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Products relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinProducts(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Products');

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
            $this->addJoinObject($join, 'Products');
        }

        return $this;
    }

    /**
     * Use the Products relation Products object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\ProductsQuery A secondary query class using the current class as primary query
     */
    public function useProductsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProducts($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Products', '\entities\ProductsQuery');
    }

    /**
     * Use the Products relation Products object
     *
     * @param callable(\entities\ProductsQuery):\entities\ProductsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withProductsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useProductsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Products table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\ProductsQuery The inner query object of the EXISTS statement
     */
    public function useProductsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\ProductsQuery */
        $q = $this->useExistsQuery('Products', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Products table for a NOT EXISTS query.
     *
     * @see useProductsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\ProductsQuery The inner query object of the NOT EXISTS statement
     */
    public function useProductsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\ProductsQuery */
        $q = $this->useExistsQuery('Products', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Products table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\ProductsQuery The inner query object of the IN statement
     */
    public function useInProductsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\ProductsQuery */
        $q = $this->useInQuery('Products', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Products table for a NOT IN query.
     *
     * @see useProductsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\ProductsQuery The inner query object of the NOT IN statement
     */
    public function useNotInProductsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\ProductsQuery */
        $q = $this->useInQuery('Products', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\StockVoucher object
     *
     * @param \entities\StockVoucher|ObjectCollection $stockVoucher The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStockVoucher($stockVoucher, ?string $comparison = null)
    {
        if ($stockVoucher instanceof \entities\StockVoucher) {
            return $this
                ->addUsingAlias(StockTransactionTableMap::COL_SV_ID, $stockVoucher->getSvid(), $comparison);
        } elseif ($stockVoucher instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(StockTransactionTableMap::COL_SV_ID, $stockVoucher->toKeyValue('PrimaryKey', 'Svid'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByStockVoucher() only accepts arguments of type \entities\StockVoucher or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the StockVoucher relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinStockVoucher(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('StockVoucher');

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
            $this->addJoinObject($join, 'StockVoucher');
        }

        return $this;
    }

    /**
     * Use the StockVoucher relation StockVoucher object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\StockVoucherQuery A secondary query class using the current class as primary query
     */
    public function useStockVoucherQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinStockVoucher($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'StockVoucher', '\entities\StockVoucherQuery');
    }

    /**
     * Use the StockVoucher relation StockVoucher object
     *
     * @param callable(\entities\StockVoucherQuery):\entities\StockVoucherQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withStockVoucherQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useStockVoucherQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to StockVoucher table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\StockVoucherQuery The inner query object of the EXISTS statement
     */
    public function useStockVoucherExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\StockVoucherQuery */
        $q = $this->useExistsQuery('StockVoucher', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to StockVoucher table for a NOT EXISTS query.
     *
     * @see useStockVoucherExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\StockVoucherQuery The inner query object of the NOT EXISTS statement
     */
    public function useStockVoucherNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\StockVoucherQuery */
        $q = $this->useExistsQuery('StockVoucher', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to StockVoucher table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\StockVoucherQuery The inner query object of the IN statement
     */
    public function useInStockVoucherQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\StockVoucherQuery */
        $q = $this->useInQuery('StockVoucher', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to StockVoucher table for a NOT IN query.
     *
     * @see useStockVoucherInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\StockVoucherQuery The inner query object of the NOT IN statement
     */
    public function useNotInStockVoucherQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\StockVoucherQuery */
        $q = $this->useInQuery('StockVoucher', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(StockTransactionTableMap::COL_CREATED_USER, $users->getUserId(), $comparison);
        } elseif ($users instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(StockTransactionTableMap::COL_CREATED_USER, $users->toKeyValue('PrimaryKey', 'UserId'), $comparison);

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
     * Exclude object from result
     *
     * @param ChildStockTransaction $stockTransaction Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($stockTransaction = null)
    {
        if ($stockTransaction) {
            $this->addUsingAlias(StockTransactionTableMap::COL_STID, $stockTransaction->getStid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the stock_transaction table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(StockTransactionTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            StockTransactionTableMap::clearInstancePool();
            StockTransactionTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(StockTransactionTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(StockTransactionTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            StockTransactionTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            StockTransactionTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
