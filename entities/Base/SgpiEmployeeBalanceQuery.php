<?php

namespace entities\Base;

use \Exception;
use \PDO;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;
use entities\SgpiEmployeeBalance as ChildSgpiEmployeeBalance;
use entities\SgpiEmployeeBalanceQuery as ChildSgpiEmployeeBalanceQuery;
use entities\Map\SgpiEmployeeBalanceTableMap;

/**
 * Base class that represents a query for the `sgpi_employee_balance` table.
 *
 * @method     ChildSgpiEmployeeBalanceQuery orderByUniquecode($order = Criteria::ASC) Order by the uniquecode column
 * @method     ChildSgpiEmployeeBalanceQuery orderByEmployeeId($order = Criteria::ASC) Order by the employee_id column
 * @method     ChildSgpiEmployeeBalanceQuery orderBySgpiAccountId($order = Criteria::ASC) Order by the sgpi_account_id column
 * @method     ChildSgpiEmployeeBalanceQuery orderBySgpiId($order = Criteria::ASC) Order by the sgpi_id column
 * @method     ChildSgpiEmployeeBalanceQuery orderBySgpiMedia($order = Criteria::ASC) Order by the sgpi_media column
 * @method     ChildSgpiEmployeeBalanceQuery orderBySgpiName($order = Criteria::ASC) Order by the sgpi_name column
 * @method     ChildSgpiEmployeeBalanceQuery orderBySgpiType($order = Criteria::ASC) Order by the sgpi_type column
 * @method     ChildSgpiEmployeeBalanceQuery orderByUseStartDate($order = Criteria::ASC) Order by the use_start_date column
 * @method     ChildSgpiEmployeeBalanceQuery orderByUseEndDate($order = Criteria::ASC) Order by the use_end_date column
 * @method     ChildSgpiEmployeeBalanceQuery orderByMaxQty($order = Criteria::ASC) Order by the max_qty column
 * @method     ChildSgpiEmployeeBalanceQuery orderByBalance($order = Criteria::ASC) Order by the balance column
 * @method     ChildSgpiEmployeeBalanceQuery orderByCredits($order = Criteria::ASC) Order by the credits column
 * @method     ChildSgpiEmployeeBalanceQuery orderByDebits($order = Criteria::ASC) Order by the debits column
 * @method     ChildSgpiEmployeeBalanceQuery orderByMoye($order = Criteria::ASC) Order by the moye column
 * @method     ChildSgpiEmployeeBalanceQuery orderByBrandId($order = Criteria::ASC) Order by the brand_id column
 * @method     ChildSgpiEmployeeBalanceQuery orderByOutlettypeId($order = Criteria::ASC) Order by the outlettype_id column
 * @method     ChildSgpiEmployeeBalanceQuery orderByIsStrategic($order = Criteria::ASC) Order by the is_strategic column
 *
 * @method     ChildSgpiEmployeeBalanceQuery groupByUniquecode() Group by the uniquecode column
 * @method     ChildSgpiEmployeeBalanceQuery groupByEmployeeId() Group by the employee_id column
 * @method     ChildSgpiEmployeeBalanceQuery groupBySgpiAccountId() Group by the sgpi_account_id column
 * @method     ChildSgpiEmployeeBalanceQuery groupBySgpiId() Group by the sgpi_id column
 * @method     ChildSgpiEmployeeBalanceQuery groupBySgpiMedia() Group by the sgpi_media column
 * @method     ChildSgpiEmployeeBalanceQuery groupBySgpiName() Group by the sgpi_name column
 * @method     ChildSgpiEmployeeBalanceQuery groupBySgpiType() Group by the sgpi_type column
 * @method     ChildSgpiEmployeeBalanceQuery groupByUseStartDate() Group by the use_start_date column
 * @method     ChildSgpiEmployeeBalanceQuery groupByUseEndDate() Group by the use_end_date column
 * @method     ChildSgpiEmployeeBalanceQuery groupByMaxQty() Group by the max_qty column
 * @method     ChildSgpiEmployeeBalanceQuery groupByBalance() Group by the balance column
 * @method     ChildSgpiEmployeeBalanceQuery groupByCredits() Group by the credits column
 * @method     ChildSgpiEmployeeBalanceQuery groupByDebits() Group by the debits column
 * @method     ChildSgpiEmployeeBalanceQuery groupByMoye() Group by the moye column
 * @method     ChildSgpiEmployeeBalanceQuery groupByBrandId() Group by the brand_id column
 * @method     ChildSgpiEmployeeBalanceQuery groupByOutlettypeId() Group by the outlettype_id column
 * @method     ChildSgpiEmployeeBalanceQuery groupByIsStrategic() Group by the is_strategic column
 *
 * @method     ChildSgpiEmployeeBalanceQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSgpiEmployeeBalanceQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSgpiEmployeeBalanceQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSgpiEmployeeBalanceQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSgpiEmployeeBalanceQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSgpiEmployeeBalanceQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSgpiEmployeeBalance|null findOne(?ConnectionInterface $con = null) Return the first ChildSgpiEmployeeBalance matching the query
 * @method     ChildSgpiEmployeeBalance findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSgpiEmployeeBalance matching the query, or a new ChildSgpiEmployeeBalance object populated from the query conditions when no match is found
 *
 * @method     ChildSgpiEmployeeBalance|null findOneByUniquecode(string $uniquecode) Return the first ChildSgpiEmployeeBalance filtered by the uniquecode column
 * @method     ChildSgpiEmployeeBalance|null findOneByEmployeeId(int $employee_id) Return the first ChildSgpiEmployeeBalance filtered by the employee_id column
 * @method     ChildSgpiEmployeeBalance|null findOneBySgpiAccountId(int $sgpi_account_id) Return the first ChildSgpiEmployeeBalance filtered by the sgpi_account_id column
 * @method     ChildSgpiEmployeeBalance|null findOneBySgpiId(int $sgpi_id) Return the first ChildSgpiEmployeeBalance filtered by the sgpi_id column
 * @method     ChildSgpiEmployeeBalance|null findOneBySgpiMedia(int $sgpi_media) Return the first ChildSgpiEmployeeBalance filtered by the sgpi_media column
 * @method     ChildSgpiEmployeeBalance|null findOneBySgpiName(string $sgpi_name) Return the first ChildSgpiEmployeeBalance filtered by the sgpi_name column
 * @method     ChildSgpiEmployeeBalance|null findOneBySgpiType(string $sgpi_type) Return the first ChildSgpiEmployeeBalance filtered by the sgpi_type column
 * @method     ChildSgpiEmployeeBalance|null findOneByUseStartDate(string $use_start_date) Return the first ChildSgpiEmployeeBalance filtered by the use_start_date column
 * @method     ChildSgpiEmployeeBalance|null findOneByUseEndDate(string $use_end_date) Return the first ChildSgpiEmployeeBalance filtered by the use_end_date column
 * @method     ChildSgpiEmployeeBalance|null findOneByMaxQty(int $max_qty) Return the first ChildSgpiEmployeeBalance filtered by the max_qty column
 * @method     ChildSgpiEmployeeBalance|null findOneByBalance(int $balance) Return the first ChildSgpiEmployeeBalance filtered by the balance column
 * @method     ChildSgpiEmployeeBalance|null findOneByCredits(int $credits) Return the first ChildSgpiEmployeeBalance filtered by the credits column
 * @method     ChildSgpiEmployeeBalance|null findOneByDebits(int $debits) Return the first ChildSgpiEmployeeBalance filtered by the debits column
 * @method     ChildSgpiEmployeeBalance|null findOneByMoye(string $moye) Return the first ChildSgpiEmployeeBalance filtered by the moye column
 * @method     ChildSgpiEmployeeBalance|null findOneByBrandId(int $brand_id) Return the first ChildSgpiEmployeeBalance filtered by the brand_id column
 * @method     ChildSgpiEmployeeBalance|null findOneByOutlettypeId(int $outlettype_id) Return the first ChildSgpiEmployeeBalance filtered by the outlettype_id column
 * @method     ChildSgpiEmployeeBalance|null findOneByIsStrategic(boolean $is_strategic) Return the first ChildSgpiEmployeeBalance filtered by the is_strategic column
 *
 * @method     ChildSgpiEmployeeBalance requirePk($key, ?ConnectionInterface $con = null) Return the ChildSgpiEmployeeBalance by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiEmployeeBalance requireOne(?ConnectionInterface $con = null) Return the first ChildSgpiEmployeeBalance matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSgpiEmployeeBalance requireOneByUniquecode(string $uniquecode) Return the first ChildSgpiEmployeeBalance filtered by the uniquecode column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiEmployeeBalance requireOneByEmployeeId(int $employee_id) Return the first ChildSgpiEmployeeBalance filtered by the employee_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiEmployeeBalance requireOneBySgpiAccountId(int $sgpi_account_id) Return the first ChildSgpiEmployeeBalance filtered by the sgpi_account_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiEmployeeBalance requireOneBySgpiId(int $sgpi_id) Return the first ChildSgpiEmployeeBalance filtered by the sgpi_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiEmployeeBalance requireOneBySgpiMedia(int $sgpi_media) Return the first ChildSgpiEmployeeBalance filtered by the sgpi_media column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiEmployeeBalance requireOneBySgpiName(string $sgpi_name) Return the first ChildSgpiEmployeeBalance filtered by the sgpi_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiEmployeeBalance requireOneBySgpiType(string $sgpi_type) Return the first ChildSgpiEmployeeBalance filtered by the sgpi_type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiEmployeeBalance requireOneByUseStartDate(string $use_start_date) Return the first ChildSgpiEmployeeBalance filtered by the use_start_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiEmployeeBalance requireOneByUseEndDate(string $use_end_date) Return the first ChildSgpiEmployeeBalance filtered by the use_end_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiEmployeeBalance requireOneByMaxQty(int $max_qty) Return the first ChildSgpiEmployeeBalance filtered by the max_qty column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiEmployeeBalance requireOneByBalance(int $balance) Return the first ChildSgpiEmployeeBalance filtered by the balance column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiEmployeeBalance requireOneByCredits(int $credits) Return the first ChildSgpiEmployeeBalance filtered by the credits column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiEmployeeBalance requireOneByDebits(int $debits) Return the first ChildSgpiEmployeeBalance filtered by the debits column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiEmployeeBalance requireOneByMoye(string $moye) Return the first ChildSgpiEmployeeBalance filtered by the moye column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiEmployeeBalance requireOneByBrandId(int $brand_id) Return the first ChildSgpiEmployeeBalance filtered by the brand_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiEmployeeBalance requireOneByOutlettypeId(int $outlettype_id) Return the first ChildSgpiEmployeeBalance filtered by the outlettype_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiEmployeeBalance requireOneByIsStrategic(boolean $is_strategic) Return the first ChildSgpiEmployeeBalance filtered by the is_strategic column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSgpiEmployeeBalance[]|Collection find(?ConnectionInterface $con = null) Return ChildSgpiEmployeeBalance objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSgpiEmployeeBalance> find(?ConnectionInterface $con = null) Return ChildSgpiEmployeeBalance objects based on current ModelCriteria
 *
 * @method     ChildSgpiEmployeeBalance[]|Collection findByUniquecode(string|array<string> $uniquecode) Return ChildSgpiEmployeeBalance objects filtered by the uniquecode column
 * @psalm-method Collection&\Traversable<ChildSgpiEmployeeBalance> findByUniquecode(string|array<string> $uniquecode) Return ChildSgpiEmployeeBalance objects filtered by the uniquecode column
 * @method     ChildSgpiEmployeeBalance[]|Collection findByEmployeeId(int|array<int> $employee_id) Return ChildSgpiEmployeeBalance objects filtered by the employee_id column
 * @psalm-method Collection&\Traversable<ChildSgpiEmployeeBalance> findByEmployeeId(int|array<int> $employee_id) Return ChildSgpiEmployeeBalance objects filtered by the employee_id column
 * @method     ChildSgpiEmployeeBalance[]|Collection findBySgpiAccountId(int|array<int> $sgpi_account_id) Return ChildSgpiEmployeeBalance objects filtered by the sgpi_account_id column
 * @psalm-method Collection&\Traversable<ChildSgpiEmployeeBalance> findBySgpiAccountId(int|array<int> $sgpi_account_id) Return ChildSgpiEmployeeBalance objects filtered by the sgpi_account_id column
 * @method     ChildSgpiEmployeeBalance[]|Collection findBySgpiId(int|array<int> $sgpi_id) Return ChildSgpiEmployeeBalance objects filtered by the sgpi_id column
 * @psalm-method Collection&\Traversable<ChildSgpiEmployeeBalance> findBySgpiId(int|array<int> $sgpi_id) Return ChildSgpiEmployeeBalance objects filtered by the sgpi_id column
 * @method     ChildSgpiEmployeeBalance[]|Collection findBySgpiMedia(int|array<int> $sgpi_media) Return ChildSgpiEmployeeBalance objects filtered by the sgpi_media column
 * @psalm-method Collection&\Traversable<ChildSgpiEmployeeBalance> findBySgpiMedia(int|array<int> $sgpi_media) Return ChildSgpiEmployeeBalance objects filtered by the sgpi_media column
 * @method     ChildSgpiEmployeeBalance[]|Collection findBySgpiName(string|array<string> $sgpi_name) Return ChildSgpiEmployeeBalance objects filtered by the sgpi_name column
 * @psalm-method Collection&\Traversable<ChildSgpiEmployeeBalance> findBySgpiName(string|array<string> $sgpi_name) Return ChildSgpiEmployeeBalance objects filtered by the sgpi_name column
 * @method     ChildSgpiEmployeeBalance[]|Collection findBySgpiType(string|array<string> $sgpi_type) Return ChildSgpiEmployeeBalance objects filtered by the sgpi_type column
 * @psalm-method Collection&\Traversable<ChildSgpiEmployeeBalance> findBySgpiType(string|array<string> $sgpi_type) Return ChildSgpiEmployeeBalance objects filtered by the sgpi_type column
 * @method     ChildSgpiEmployeeBalance[]|Collection findByUseStartDate(string|array<string> $use_start_date) Return ChildSgpiEmployeeBalance objects filtered by the use_start_date column
 * @psalm-method Collection&\Traversable<ChildSgpiEmployeeBalance> findByUseStartDate(string|array<string> $use_start_date) Return ChildSgpiEmployeeBalance objects filtered by the use_start_date column
 * @method     ChildSgpiEmployeeBalance[]|Collection findByUseEndDate(string|array<string> $use_end_date) Return ChildSgpiEmployeeBalance objects filtered by the use_end_date column
 * @psalm-method Collection&\Traversable<ChildSgpiEmployeeBalance> findByUseEndDate(string|array<string> $use_end_date) Return ChildSgpiEmployeeBalance objects filtered by the use_end_date column
 * @method     ChildSgpiEmployeeBalance[]|Collection findByMaxQty(int|array<int> $max_qty) Return ChildSgpiEmployeeBalance objects filtered by the max_qty column
 * @psalm-method Collection&\Traversable<ChildSgpiEmployeeBalance> findByMaxQty(int|array<int> $max_qty) Return ChildSgpiEmployeeBalance objects filtered by the max_qty column
 * @method     ChildSgpiEmployeeBalance[]|Collection findByBalance(int|array<int> $balance) Return ChildSgpiEmployeeBalance objects filtered by the balance column
 * @psalm-method Collection&\Traversable<ChildSgpiEmployeeBalance> findByBalance(int|array<int> $balance) Return ChildSgpiEmployeeBalance objects filtered by the balance column
 * @method     ChildSgpiEmployeeBalance[]|Collection findByCredits(int|array<int> $credits) Return ChildSgpiEmployeeBalance objects filtered by the credits column
 * @psalm-method Collection&\Traversable<ChildSgpiEmployeeBalance> findByCredits(int|array<int> $credits) Return ChildSgpiEmployeeBalance objects filtered by the credits column
 * @method     ChildSgpiEmployeeBalance[]|Collection findByDebits(int|array<int> $debits) Return ChildSgpiEmployeeBalance objects filtered by the debits column
 * @psalm-method Collection&\Traversable<ChildSgpiEmployeeBalance> findByDebits(int|array<int> $debits) Return ChildSgpiEmployeeBalance objects filtered by the debits column
 * @method     ChildSgpiEmployeeBalance[]|Collection findByMoye(string|array<string> $moye) Return ChildSgpiEmployeeBalance objects filtered by the moye column
 * @psalm-method Collection&\Traversable<ChildSgpiEmployeeBalance> findByMoye(string|array<string> $moye) Return ChildSgpiEmployeeBalance objects filtered by the moye column
 * @method     ChildSgpiEmployeeBalance[]|Collection findByBrandId(int|array<int> $brand_id) Return ChildSgpiEmployeeBalance objects filtered by the brand_id column
 * @psalm-method Collection&\Traversable<ChildSgpiEmployeeBalance> findByBrandId(int|array<int> $brand_id) Return ChildSgpiEmployeeBalance objects filtered by the brand_id column
 * @method     ChildSgpiEmployeeBalance[]|Collection findByOutlettypeId(int|array<int> $outlettype_id) Return ChildSgpiEmployeeBalance objects filtered by the outlettype_id column
 * @psalm-method Collection&\Traversable<ChildSgpiEmployeeBalance> findByOutlettypeId(int|array<int> $outlettype_id) Return ChildSgpiEmployeeBalance objects filtered by the outlettype_id column
 * @method     ChildSgpiEmployeeBalance[]|Collection findByIsStrategic(boolean|array<boolean> $is_strategic) Return ChildSgpiEmployeeBalance objects filtered by the is_strategic column
 * @psalm-method Collection&\Traversable<ChildSgpiEmployeeBalance> findByIsStrategic(boolean|array<boolean> $is_strategic) Return ChildSgpiEmployeeBalance objects filtered by the is_strategic column
 *
 * @method     ChildSgpiEmployeeBalance[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSgpiEmployeeBalance> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SgpiEmployeeBalanceQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\SgpiEmployeeBalanceQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\SgpiEmployeeBalance', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSgpiEmployeeBalanceQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSgpiEmployeeBalanceQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSgpiEmployeeBalanceQuery) {
            return $criteria;
        }
        $query = new ChildSgpiEmployeeBalanceQuery();
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
     * @return ChildSgpiEmployeeBalance|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SgpiEmployeeBalanceTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = SgpiEmployeeBalanceTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSgpiEmployeeBalance A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT uniquecode, employee_id, sgpi_account_id, sgpi_id, sgpi_media, sgpi_name, sgpi_type, use_start_date, use_end_date, max_qty, balance, credits, debits, moye, brand_id, outlettype_id, is_strategic FROM sgpi_employee_balance WHERE uniquecode = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildSgpiEmployeeBalance $obj */
            $obj = new ChildSgpiEmployeeBalance();
            $obj->hydrate($row);
            SgpiEmployeeBalanceTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSgpiEmployeeBalance|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SgpiEmployeeBalanceTableMap::COL_UNIQUECODE, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SgpiEmployeeBalanceTableMap::COL_UNIQUECODE, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the uniquecode column
     *
     * Example usage:
     * <code>
     * $query->filterByUniquecode('fooValue');   // WHERE uniquecode = 'fooValue'
     * $query->filterByUniquecode('%fooValue%', Criteria::LIKE); // WHERE uniquecode LIKE '%fooValue%'
     * $query->filterByUniquecode(['foo', 'bar']); // WHERE uniquecode IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $uniquecode The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUniquecode($uniquecode = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($uniquecode)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiEmployeeBalanceTableMap::COL_UNIQUECODE, $uniquecode, $comparison);

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
                $this->addUsingAlias(SgpiEmployeeBalanceTableMap::COL_EMPLOYEE_ID, $employeeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($employeeId['max'])) {
                $this->addUsingAlias(SgpiEmployeeBalanceTableMap::COL_EMPLOYEE_ID, $employeeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiEmployeeBalanceTableMap::COL_EMPLOYEE_ID, $employeeId, $comparison);

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
                $this->addUsingAlias(SgpiEmployeeBalanceTableMap::COL_SGPI_ACCOUNT_ID, $sgpiAccountId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($sgpiAccountId['max'])) {
                $this->addUsingAlias(SgpiEmployeeBalanceTableMap::COL_SGPI_ACCOUNT_ID, $sgpiAccountId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiEmployeeBalanceTableMap::COL_SGPI_ACCOUNT_ID, $sgpiAccountId, $comparison);

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
                $this->addUsingAlias(SgpiEmployeeBalanceTableMap::COL_SGPI_ID, $sgpiId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($sgpiId['max'])) {
                $this->addUsingAlias(SgpiEmployeeBalanceTableMap::COL_SGPI_ID, $sgpiId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiEmployeeBalanceTableMap::COL_SGPI_ID, $sgpiId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the sgpi_media column
     *
     * Example usage:
     * <code>
     * $query->filterBySgpiMedia(1234); // WHERE sgpi_media = 1234
     * $query->filterBySgpiMedia(array(12, 34)); // WHERE sgpi_media IN (12, 34)
     * $query->filterBySgpiMedia(array('min' => 12)); // WHERE sgpi_media > 12
     * </code>
     *
     * @param mixed $sgpiMedia The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySgpiMedia($sgpiMedia = null, ?string $comparison = null)
    {
        if (is_array($sgpiMedia)) {
            $useMinMax = false;
            if (isset($sgpiMedia['min'])) {
                $this->addUsingAlias(SgpiEmployeeBalanceTableMap::COL_SGPI_MEDIA, $sgpiMedia['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($sgpiMedia['max'])) {
                $this->addUsingAlias(SgpiEmployeeBalanceTableMap::COL_SGPI_MEDIA, $sgpiMedia['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiEmployeeBalanceTableMap::COL_SGPI_MEDIA, $sgpiMedia, $comparison);

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

        $this->addUsingAlias(SgpiEmployeeBalanceTableMap::COL_SGPI_NAME, $sgpiName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the sgpi_type column
     *
     * Example usage:
     * <code>
     * $query->filterBySgpiType('fooValue');   // WHERE sgpi_type = 'fooValue'
     * $query->filterBySgpiType('%fooValue%', Criteria::LIKE); // WHERE sgpi_type LIKE '%fooValue%'
     * $query->filterBySgpiType(['foo', 'bar']); // WHERE sgpi_type IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $sgpiType The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySgpiType($sgpiType = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($sgpiType)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiEmployeeBalanceTableMap::COL_SGPI_TYPE, $sgpiType, $comparison);

        return $this;
    }

    /**
     * Filter the query on the use_start_date column
     *
     * Example usage:
     * <code>
     * $query->filterByUseStartDate('2011-03-14'); // WHERE use_start_date = '2011-03-14'
     * $query->filterByUseStartDate('now'); // WHERE use_start_date = '2011-03-14'
     * $query->filterByUseStartDate(array('max' => 'yesterday')); // WHERE use_start_date > '2011-03-13'
     * </code>
     *
     * @param mixed $useStartDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUseStartDate($useStartDate = null, ?string $comparison = null)
    {
        if (is_array($useStartDate)) {
            $useMinMax = false;
            if (isset($useStartDate['min'])) {
                $this->addUsingAlias(SgpiEmployeeBalanceTableMap::COL_USE_START_DATE, $useStartDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($useStartDate['max'])) {
                $this->addUsingAlias(SgpiEmployeeBalanceTableMap::COL_USE_START_DATE, $useStartDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiEmployeeBalanceTableMap::COL_USE_START_DATE, $useStartDate, $comparison);

        return $this;
    }

    /**
     * Filter the query on the use_end_date column
     *
     * Example usage:
     * <code>
     * $query->filterByUseEndDate('2011-03-14'); // WHERE use_end_date = '2011-03-14'
     * $query->filterByUseEndDate('now'); // WHERE use_end_date = '2011-03-14'
     * $query->filterByUseEndDate(array('max' => 'yesterday')); // WHERE use_end_date > '2011-03-13'
     * </code>
     *
     * @param mixed $useEndDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUseEndDate($useEndDate = null, ?string $comparison = null)
    {
        if (is_array($useEndDate)) {
            $useMinMax = false;
            if (isset($useEndDate['min'])) {
                $this->addUsingAlias(SgpiEmployeeBalanceTableMap::COL_USE_END_DATE, $useEndDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($useEndDate['max'])) {
                $this->addUsingAlias(SgpiEmployeeBalanceTableMap::COL_USE_END_DATE, $useEndDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiEmployeeBalanceTableMap::COL_USE_END_DATE, $useEndDate, $comparison);

        return $this;
    }

    /**
     * Filter the query on the max_qty column
     *
     * Example usage:
     * <code>
     * $query->filterByMaxQty(1234); // WHERE max_qty = 1234
     * $query->filterByMaxQty(array(12, 34)); // WHERE max_qty IN (12, 34)
     * $query->filterByMaxQty(array('min' => 12)); // WHERE max_qty > 12
     * </code>
     *
     * @param mixed $maxQty The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMaxQty($maxQty = null, ?string $comparison = null)
    {
        if (is_array($maxQty)) {
            $useMinMax = false;
            if (isset($maxQty['min'])) {
                $this->addUsingAlias(SgpiEmployeeBalanceTableMap::COL_MAX_QTY, $maxQty['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($maxQty['max'])) {
                $this->addUsingAlias(SgpiEmployeeBalanceTableMap::COL_MAX_QTY, $maxQty['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiEmployeeBalanceTableMap::COL_MAX_QTY, $maxQty, $comparison);

        return $this;
    }

    /**
     * Filter the query on the balance column
     *
     * Example usage:
     * <code>
     * $query->filterByBalance(1234); // WHERE balance = 1234
     * $query->filterByBalance(array(12, 34)); // WHERE balance IN (12, 34)
     * $query->filterByBalance(array('min' => 12)); // WHERE balance > 12
     * </code>
     *
     * @param mixed $balance The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBalance($balance = null, ?string $comparison = null)
    {
        if (is_array($balance)) {
            $useMinMax = false;
            if (isset($balance['min'])) {
                $this->addUsingAlias(SgpiEmployeeBalanceTableMap::COL_BALANCE, $balance['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($balance['max'])) {
                $this->addUsingAlias(SgpiEmployeeBalanceTableMap::COL_BALANCE, $balance['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiEmployeeBalanceTableMap::COL_BALANCE, $balance, $comparison);

        return $this;
    }

    /**
     * Filter the query on the credits column
     *
     * Example usage:
     * <code>
     * $query->filterByCredits(1234); // WHERE credits = 1234
     * $query->filterByCredits(array(12, 34)); // WHERE credits IN (12, 34)
     * $query->filterByCredits(array('min' => 12)); // WHERE credits > 12
     * </code>
     *
     * @param mixed $credits The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCredits($credits = null, ?string $comparison = null)
    {
        if (is_array($credits)) {
            $useMinMax = false;
            if (isset($credits['min'])) {
                $this->addUsingAlias(SgpiEmployeeBalanceTableMap::COL_CREDITS, $credits['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($credits['max'])) {
                $this->addUsingAlias(SgpiEmployeeBalanceTableMap::COL_CREDITS, $credits['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiEmployeeBalanceTableMap::COL_CREDITS, $credits, $comparison);

        return $this;
    }

    /**
     * Filter the query on the debits column
     *
     * Example usage:
     * <code>
     * $query->filterByDebits(1234); // WHERE debits = 1234
     * $query->filterByDebits(array(12, 34)); // WHERE debits IN (12, 34)
     * $query->filterByDebits(array('min' => 12)); // WHERE debits > 12
     * </code>
     *
     * @param mixed $debits The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDebits($debits = null, ?string $comparison = null)
    {
        if (is_array($debits)) {
            $useMinMax = false;
            if (isset($debits['min'])) {
                $this->addUsingAlias(SgpiEmployeeBalanceTableMap::COL_DEBITS, $debits['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($debits['max'])) {
                $this->addUsingAlias(SgpiEmployeeBalanceTableMap::COL_DEBITS, $debits['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiEmployeeBalanceTableMap::COL_DEBITS, $debits, $comparison);

        return $this;
    }

    /**
     * Filter the query on the moye column
     *
     * Example usage:
     * <code>
     * $query->filterByMoye('fooValue');   // WHERE moye = 'fooValue'
     * $query->filterByMoye('%fooValue%', Criteria::LIKE); // WHERE moye LIKE '%fooValue%'
     * $query->filterByMoye(['foo', 'bar']); // WHERE moye IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $moye The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMoye($moye = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($moye)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiEmployeeBalanceTableMap::COL_MOYE, $moye, $comparison);

        return $this;
    }

    /**
     * Filter the query on the brand_id column
     *
     * Example usage:
     * <code>
     * $query->filterByBrandId(1234); // WHERE brand_id = 1234
     * $query->filterByBrandId(array(12, 34)); // WHERE brand_id IN (12, 34)
     * $query->filterByBrandId(array('min' => 12)); // WHERE brand_id > 12
     * </code>
     *
     * @param mixed $brandId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBrandId($brandId = null, ?string $comparison = null)
    {
        if (is_array($brandId)) {
            $useMinMax = false;
            if (isset($brandId['min'])) {
                $this->addUsingAlias(SgpiEmployeeBalanceTableMap::COL_BRAND_ID, $brandId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($brandId['max'])) {
                $this->addUsingAlias(SgpiEmployeeBalanceTableMap::COL_BRAND_ID, $brandId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiEmployeeBalanceTableMap::COL_BRAND_ID, $brandId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlettype_id column
     *
     * Example usage:
     * <code>
     * $query->filterByOutlettypeId(1234); // WHERE outlettype_id = 1234
     * $query->filterByOutlettypeId(array(12, 34)); // WHERE outlettype_id IN (12, 34)
     * $query->filterByOutlettypeId(array('min' => 12)); // WHERE outlettype_id > 12
     * </code>
     *
     * @param mixed $outlettypeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutlettypeId($outlettypeId = null, ?string $comparison = null)
    {
        if (is_array($outlettypeId)) {
            $useMinMax = false;
            if (isset($outlettypeId['min'])) {
                $this->addUsingAlias(SgpiEmployeeBalanceTableMap::COL_OUTLETTYPE_ID, $outlettypeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outlettypeId['max'])) {
                $this->addUsingAlias(SgpiEmployeeBalanceTableMap::COL_OUTLETTYPE_ID, $outlettypeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiEmployeeBalanceTableMap::COL_OUTLETTYPE_ID, $outlettypeId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the is_strategic column
     *
     * Example usage:
     * <code>
     * $query->filterByIsStrategic(true); // WHERE is_strategic = true
     * $query->filterByIsStrategic('yes'); // WHERE is_strategic = true
     * </code>
     *
     * @param bool|string $isStrategic The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIsStrategic($isStrategic = null, ?string $comparison = null)
    {
        if (is_string($isStrategic)) {
            $isStrategic = in_array(strtolower($isStrategic), array('false', 'off', '-', 'no', 'n', '0', ''), true) ? false : true;
        }

        $this->addUsingAlias(SgpiEmployeeBalanceTableMap::COL_IS_STRATEGIC, $isStrategic, $comparison);

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSgpiEmployeeBalance $sgpiEmployeeBalance Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($sgpiEmployeeBalance = null)
    {
        if ($sgpiEmployeeBalance) {
            $this->addUsingAlias(SgpiEmployeeBalanceTableMap::COL_UNIQUECODE, $sgpiEmployeeBalance->getUniquecode(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
