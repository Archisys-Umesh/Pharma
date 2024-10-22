<?php

namespace entities\Base;

use \Exception;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\LogicException;
use entities\SgpiTransactionView as ChildSgpiTransactionView;
use entities\SgpiTransactionViewQuery as ChildSgpiTransactionViewQuery;
use entities\Map\SgpiTransactionViewTableMap;

/**
 * Base class that represents a query for the `sgpi_transaction_view` table.
 *
 * @method     ChildSgpiTransactionViewQuery orderBySgpiName($order = Criteria::ASC) Order by the sgpi_name column
 * @method     ChildSgpiTransactionViewQuery orderByCd($order = Criteria::ASC) Order by the cd column
 * @method     ChildSgpiTransactionViewQuery orderByQty($order = Criteria::ASC) Order by the qty column
 * @method     ChildSgpiTransactionViewQuery orderByCredits($order = Criteria::ASC) Order by the credits column
 * @method     ChildSgpiTransactionViewQuery orderByDebits($order = Criteria::ASC) Order by the debits column
 * @method     ChildSgpiTransactionViewQuery orderByEmployeeId($order = Criteria::ASC) Order by the employee_id column
 * @method     ChildSgpiTransactionViewQuery orderByVoucherNo($order = Criteria::ASC) Order by the voucher_no column
 * @method     ChildSgpiTransactionViewQuery orderByRemark($order = Criteria::ASC) Order by the remark column
 * @method     ChildSgpiTransactionViewQuery orderByOutletName($order = Criteria::ASC) Order by the outlet_name column
 * @method     ChildSgpiTransactionViewQuery orderByDcrDate($order = Criteria::ASC) Order by the dcr_date column
 * @method     ChildSgpiTransactionViewQuery orderByOutlettypeName($order = Criteria::ASC) Order by the outlettype_name column
 * @method     ChildSgpiTransactionViewQuery orderByBeatName($order = Criteria::ASC) Order by the beat_name column
 * @method     ChildSgpiTransactionViewQuery orderByUseStartDate($order = Criteria::ASC) Order by the use_start_date column
 * @method     ChildSgpiTransactionViewQuery orderByUseEndDate($order = Criteria::ASC) Order by the use_end_date column
 * @method     ChildSgpiTransactionViewQuery orderBySgpiId($order = Criteria::ASC) Order by the sgpi_id column
 * @method     ChildSgpiTransactionViewQuery orderByEmployeeCode($order = Criteria::ASC) Order by the employee_code column
 * @method     ChildSgpiTransactionViewQuery orderByCreatedTa($order = Criteria::ASC) Order by the created_at column
 * @method     ChildSgpiTransactionViewQuery orderByBrandName($order = Criteria::ASC) Order by the brand_name column
 * @method     ChildSgpiTransactionViewQuery orderByOutletCode($order = Criteria::ASC) Order by the outlet_code column
 *
 * @method     ChildSgpiTransactionViewQuery groupBySgpiName() Group by the sgpi_name column
 * @method     ChildSgpiTransactionViewQuery groupByCd() Group by the cd column
 * @method     ChildSgpiTransactionViewQuery groupByQty() Group by the qty column
 * @method     ChildSgpiTransactionViewQuery groupByCredits() Group by the credits column
 * @method     ChildSgpiTransactionViewQuery groupByDebits() Group by the debits column
 * @method     ChildSgpiTransactionViewQuery groupByEmployeeId() Group by the employee_id column
 * @method     ChildSgpiTransactionViewQuery groupByVoucherNo() Group by the voucher_no column
 * @method     ChildSgpiTransactionViewQuery groupByRemark() Group by the remark column
 * @method     ChildSgpiTransactionViewQuery groupByOutletName() Group by the outlet_name column
 * @method     ChildSgpiTransactionViewQuery groupByDcrDate() Group by the dcr_date column
 * @method     ChildSgpiTransactionViewQuery groupByOutlettypeName() Group by the outlettype_name column
 * @method     ChildSgpiTransactionViewQuery groupByBeatName() Group by the beat_name column
 * @method     ChildSgpiTransactionViewQuery groupByUseStartDate() Group by the use_start_date column
 * @method     ChildSgpiTransactionViewQuery groupByUseEndDate() Group by the use_end_date column
 * @method     ChildSgpiTransactionViewQuery groupBySgpiId() Group by the sgpi_id column
 * @method     ChildSgpiTransactionViewQuery groupByEmployeeCode() Group by the employee_code column
 * @method     ChildSgpiTransactionViewQuery groupByCreatedTa() Group by the created_at column
 * @method     ChildSgpiTransactionViewQuery groupByBrandName() Group by the brand_name column
 * @method     ChildSgpiTransactionViewQuery groupByOutletCode() Group by the outlet_code column
 *
 * @method     ChildSgpiTransactionViewQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSgpiTransactionViewQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSgpiTransactionViewQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSgpiTransactionViewQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSgpiTransactionViewQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSgpiTransactionViewQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSgpiTransactionView|null findOne(?ConnectionInterface $con = null) Return the first ChildSgpiTransactionView matching the query
 * @method     ChildSgpiTransactionView findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSgpiTransactionView matching the query, or a new ChildSgpiTransactionView object populated from the query conditions when no match is found
 *
 * @method     ChildSgpiTransactionView|null findOneBySgpiName(string $sgpi_name) Return the first ChildSgpiTransactionView filtered by the sgpi_name column
 * @method     ChildSgpiTransactionView|null findOneByCd(string $cd) Return the first ChildSgpiTransactionView filtered by the cd column
 * @method     ChildSgpiTransactionView|null findOneByQty(string $qty) Return the first ChildSgpiTransactionView filtered by the qty column
 * @method     ChildSgpiTransactionView|null findOneByCredits(string $credits) Return the first ChildSgpiTransactionView filtered by the credits column
 * @method     ChildSgpiTransactionView|null findOneByDebits(string $debits) Return the first ChildSgpiTransactionView filtered by the debits column
 * @method     ChildSgpiTransactionView|null findOneByEmployeeId(string $employee_id) Return the first ChildSgpiTransactionView filtered by the employee_id column
 * @method     ChildSgpiTransactionView|null findOneByVoucherNo(string $voucher_no) Return the first ChildSgpiTransactionView filtered by the voucher_no column
 * @method     ChildSgpiTransactionView|null findOneByRemark(string $remark) Return the first ChildSgpiTransactionView filtered by the remark column
 * @method     ChildSgpiTransactionView|null findOneByOutletName(string $outlet_name) Return the first ChildSgpiTransactionView filtered by the outlet_name column
 * @method     ChildSgpiTransactionView|null findOneByDcrDate(string $dcr_date) Return the first ChildSgpiTransactionView filtered by the dcr_date column
 * @method     ChildSgpiTransactionView|null findOneByOutlettypeName(string $outlettype_name) Return the first ChildSgpiTransactionView filtered by the outlettype_name column
 * @method     ChildSgpiTransactionView|null findOneByBeatName(string $beat_name) Return the first ChildSgpiTransactionView filtered by the beat_name column
 * @method     ChildSgpiTransactionView|null findOneByUseStartDate(string $use_start_date) Return the first ChildSgpiTransactionView filtered by the use_start_date column
 * @method     ChildSgpiTransactionView|null findOneByUseEndDate(string $use_end_date) Return the first ChildSgpiTransactionView filtered by the use_end_date column
 * @method     ChildSgpiTransactionView|null findOneBySgpiId(string $sgpi_id) Return the first ChildSgpiTransactionView filtered by the sgpi_id column
 * @method     ChildSgpiTransactionView|null findOneByEmployeeCode(string $employee_code) Return the first ChildSgpiTransactionView filtered by the employee_code column
 * @method     ChildSgpiTransactionView|null findOneByCreatedTa(string $created_at) Return the first ChildSgpiTransactionView filtered by the created_at column
 * @method     ChildSgpiTransactionView|null findOneByBrandName(string $brand_name) Return the first ChildSgpiTransactionView filtered by the brand_name column
 * @method     ChildSgpiTransactionView|null findOneByOutletCode(string $outlet_code) Return the first ChildSgpiTransactionView filtered by the outlet_code column
 *
 * @method     ChildSgpiTransactionView requirePk($key, ?ConnectionInterface $con = null) Return the ChildSgpiTransactionView by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiTransactionView requireOne(?ConnectionInterface $con = null) Return the first ChildSgpiTransactionView matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSgpiTransactionView requireOneBySgpiName(string $sgpi_name) Return the first ChildSgpiTransactionView filtered by the sgpi_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiTransactionView requireOneByCd(string $cd) Return the first ChildSgpiTransactionView filtered by the cd column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiTransactionView requireOneByQty(string $qty) Return the first ChildSgpiTransactionView filtered by the qty column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiTransactionView requireOneByCredits(string $credits) Return the first ChildSgpiTransactionView filtered by the credits column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiTransactionView requireOneByDebits(string $debits) Return the first ChildSgpiTransactionView filtered by the debits column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiTransactionView requireOneByEmployeeId(string $employee_id) Return the first ChildSgpiTransactionView filtered by the employee_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiTransactionView requireOneByVoucherNo(string $voucher_no) Return the first ChildSgpiTransactionView filtered by the voucher_no column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiTransactionView requireOneByRemark(string $remark) Return the first ChildSgpiTransactionView filtered by the remark column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiTransactionView requireOneByOutletName(string $outlet_name) Return the first ChildSgpiTransactionView filtered by the outlet_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiTransactionView requireOneByDcrDate(string $dcr_date) Return the first ChildSgpiTransactionView filtered by the dcr_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiTransactionView requireOneByOutlettypeName(string $outlettype_name) Return the first ChildSgpiTransactionView filtered by the outlettype_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiTransactionView requireOneByBeatName(string $beat_name) Return the first ChildSgpiTransactionView filtered by the beat_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiTransactionView requireOneByUseStartDate(string $use_start_date) Return the first ChildSgpiTransactionView filtered by the use_start_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiTransactionView requireOneByUseEndDate(string $use_end_date) Return the first ChildSgpiTransactionView filtered by the use_end_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiTransactionView requireOneBySgpiId(string $sgpi_id) Return the first ChildSgpiTransactionView filtered by the sgpi_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiTransactionView requireOneByEmployeeCode(string $employee_code) Return the first ChildSgpiTransactionView filtered by the employee_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiTransactionView requireOneByCreatedTa(string $created_at) Return the first ChildSgpiTransactionView filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiTransactionView requireOneByBrandName(string $brand_name) Return the first ChildSgpiTransactionView filtered by the brand_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiTransactionView requireOneByOutletCode(string $outlet_code) Return the first ChildSgpiTransactionView filtered by the outlet_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSgpiTransactionView[]|Collection find(?ConnectionInterface $con = null) Return ChildSgpiTransactionView objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSgpiTransactionView> find(?ConnectionInterface $con = null) Return ChildSgpiTransactionView objects based on current ModelCriteria
 *
 * @method     ChildSgpiTransactionView[]|Collection findBySgpiName(string|array<string> $sgpi_name) Return ChildSgpiTransactionView objects filtered by the sgpi_name column
 * @psalm-method Collection&\Traversable<ChildSgpiTransactionView> findBySgpiName(string|array<string> $sgpi_name) Return ChildSgpiTransactionView objects filtered by the sgpi_name column
 * @method     ChildSgpiTransactionView[]|Collection findByCd(string|array<string> $cd) Return ChildSgpiTransactionView objects filtered by the cd column
 * @psalm-method Collection&\Traversable<ChildSgpiTransactionView> findByCd(string|array<string> $cd) Return ChildSgpiTransactionView objects filtered by the cd column
 * @method     ChildSgpiTransactionView[]|Collection findByQty(string|array<string> $qty) Return ChildSgpiTransactionView objects filtered by the qty column
 * @psalm-method Collection&\Traversable<ChildSgpiTransactionView> findByQty(string|array<string> $qty) Return ChildSgpiTransactionView objects filtered by the qty column
 * @method     ChildSgpiTransactionView[]|Collection findByCredits(string|array<string> $credits) Return ChildSgpiTransactionView objects filtered by the credits column
 * @psalm-method Collection&\Traversable<ChildSgpiTransactionView> findByCredits(string|array<string> $credits) Return ChildSgpiTransactionView objects filtered by the credits column
 * @method     ChildSgpiTransactionView[]|Collection findByDebits(string|array<string> $debits) Return ChildSgpiTransactionView objects filtered by the debits column
 * @psalm-method Collection&\Traversable<ChildSgpiTransactionView> findByDebits(string|array<string> $debits) Return ChildSgpiTransactionView objects filtered by the debits column
 * @method     ChildSgpiTransactionView[]|Collection findByEmployeeId(string|array<string> $employee_id) Return ChildSgpiTransactionView objects filtered by the employee_id column
 * @psalm-method Collection&\Traversable<ChildSgpiTransactionView> findByEmployeeId(string|array<string> $employee_id) Return ChildSgpiTransactionView objects filtered by the employee_id column
 * @method     ChildSgpiTransactionView[]|Collection findByVoucherNo(string|array<string> $voucher_no) Return ChildSgpiTransactionView objects filtered by the voucher_no column
 * @psalm-method Collection&\Traversable<ChildSgpiTransactionView> findByVoucherNo(string|array<string> $voucher_no) Return ChildSgpiTransactionView objects filtered by the voucher_no column
 * @method     ChildSgpiTransactionView[]|Collection findByRemark(string|array<string> $remark) Return ChildSgpiTransactionView objects filtered by the remark column
 * @psalm-method Collection&\Traversable<ChildSgpiTransactionView> findByRemark(string|array<string> $remark) Return ChildSgpiTransactionView objects filtered by the remark column
 * @method     ChildSgpiTransactionView[]|Collection findByOutletName(string|array<string> $outlet_name) Return ChildSgpiTransactionView objects filtered by the outlet_name column
 * @psalm-method Collection&\Traversable<ChildSgpiTransactionView> findByOutletName(string|array<string> $outlet_name) Return ChildSgpiTransactionView objects filtered by the outlet_name column
 * @method     ChildSgpiTransactionView[]|Collection findByDcrDate(string|array<string> $dcr_date) Return ChildSgpiTransactionView objects filtered by the dcr_date column
 * @psalm-method Collection&\Traversable<ChildSgpiTransactionView> findByDcrDate(string|array<string> $dcr_date) Return ChildSgpiTransactionView objects filtered by the dcr_date column
 * @method     ChildSgpiTransactionView[]|Collection findByOutlettypeName(string|array<string> $outlettype_name) Return ChildSgpiTransactionView objects filtered by the outlettype_name column
 * @psalm-method Collection&\Traversable<ChildSgpiTransactionView> findByOutlettypeName(string|array<string> $outlettype_name) Return ChildSgpiTransactionView objects filtered by the outlettype_name column
 * @method     ChildSgpiTransactionView[]|Collection findByBeatName(string|array<string> $beat_name) Return ChildSgpiTransactionView objects filtered by the beat_name column
 * @psalm-method Collection&\Traversable<ChildSgpiTransactionView> findByBeatName(string|array<string> $beat_name) Return ChildSgpiTransactionView objects filtered by the beat_name column
 * @method     ChildSgpiTransactionView[]|Collection findByUseStartDate(string|array<string> $use_start_date) Return ChildSgpiTransactionView objects filtered by the use_start_date column
 * @psalm-method Collection&\Traversable<ChildSgpiTransactionView> findByUseStartDate(string|array<string> $use_start_date) Return ChildSgpiTransactionView objects filtered by the use_start_date column
 * @method     ChildSgpiTransactionView[]|Collection findByUseEndDate(string|array<string> $use_end_date) Return ChildSgpiTransactionView objects filtered by the use_end_date column
 * @psalm-method Collection&\Traversable<ChildSgpiTransactionView> findByUseEndDate(string|array<string> $use_end_date) Return ChildSgpiTransactionView objects filtered by the use_end_date column
 * @method     ChildSgpiTransactionView[]|Collection findBySgpiId(string|array<string> $sgpi_id) Return ChildSgpiTransactionView objects filtered by the sgpi_id column
 * @psalm-method Collection&\Traversable<ChildSgpiTransactionView> findBySgpiId(string|array<string> $sgpi_id) Return ChildSgpiTransactionView objects filtered by the sgpi_id column
 * @method     ChildSgpiTransactionView[]|Collection findByEmployeeCode(string|array<string> $employee_code) Return ChildSgpiTransactionView objects filtered by the employee_code column
 * @psalm-method Collection&\Traversable<ChildSgpiTransactionView> findByEmployeeCode(string|array<string> $employee_code) Return ChildSgpiTransactionView objects filtered by the employee_code column
 * @method     ChildSgpiTransactionView[]|Collection findByCreatedTa(string|array<string> $created_at) Return ChildSgpiTransactionView objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildSgpiTransactionView> findByCreatedTa(string|array<string> $created_at) Return ChildSgpiTransactionView objects filtered by the created_at column
 * @method     ChildSgpiTransactionView[]|Collection findByBrandName(string|array<string> $brand_name) Return ChildSgpiTransactionView objects filtered by the brand_name column
 * @psalm-method Collection&\Traversable<ChildSgpiTransactionView> findByBrandName(string|array<string> $brand_name) Return ChildSgpiTransactionView objects filtered by the brand_name column
 * @method     ChildSgpiTransactionView[]|Collection findByOutletCode(string|array<string> $outlet_code) Return ChildSgpiTransactionView objects filtered by the outlet_code column
 * @psalm-method Collection&\Traversable<ChildSgpiTransactionView> findByOutletCode(string|array<string> $outlet_code) Return ChildSgpiTransactionView objects filtered by the outlet_code column
 *
 * @method     ChildSgpiTransactionView[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSgpiTransactionView> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SgpiTransactionViewQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\SgpiTransactionViewQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\SgpiTransactionView', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSgpiTransactionViewQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSgpiTransactionViewQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSgpiTransactionViewQuery) {
            return $criteria;
        }
        $query = new ChildSgpiTransactionViewQuery();
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
     * @return ChildSgpiTransactionView|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        throw new LogicException('The SgpiTransactionView object has no primary key');
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
     * </code>
     * @param array $keys Primary keys to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return Collection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ?ConnectionInterface $con = null)
    {
        throw new LogicException('The SgpiTransactionView object has no primary key');
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
        throw new LogicException('The SgpiTransactionView object has no primary key');
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
        throw new LogicException('The SgpiTransactionView object has no primary key');
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

        $this->addUsingAlias(SgpiTransactionViewTableMap::COL_SGPI_NAME, $sgpiName, $comparison);

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

        $this->addUsingAlias(SgpiTransactionViewTableMap::COL_CD, $cd, $comparison);

        return $this;
    }

    /**
     * Filter the query on the qty column
     *
     * Example usage:
     * <code>
     * $query->filterByQty('fooValue');   // WHERE qty = 'fooValue'
     * $query->filterByQty('%fooValue%', Criteria::LIKE); // WHERE qty LIKE '%fooValue%'
     * $query->filterByQty(['foo', 'bar']); // WHERE qty IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $qty The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByQty($qty = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($qty)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiTransactionViewTableMap::COL_QTY, $qty, $comparison);

        return $this;
    }

    /**
     * Filter the query on the credits column
     *
     * Example usage:
     * <code>
     * $query->filterByCredits('fooValue');   // WHERE credits = 'fooValue'
     * $query->filterByCredits('%fooValue%', Criteria::LIKE); // WHERE credits LIKE '%fooValue%'
     * $query->filterByCredits(['foo', 'bar']); // WHERE credits IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $credits The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCredits($credits = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($credits)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiTransactionViewTableMap::COL_CREDITS, $credits, $comparison);

        return $this;
    }

    /**
     * Filter the query on the debits column
     *
     * Example usage:
     * <code>
     * $query->filterByDebits('fooValue');   // WHERE debits = 'fooValue'
     * $query->filterByDebits('%fooValue%', Criteria::LIKE); // WHERE debits LIKE '%fooValue%'
     * $query->filterByDebits(['foo', 'bar']); // WHERE debits IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $debits The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDebits($debits = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($debits)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiTransactionViewTableMap::COL_DEBITS, $debits, $comparison);

        return $this;
    }

    /**
     * Filter the query on the employee_id column
     *
     * Example usage:
     * <code>
     * $query->filterByEmployeeId('fooValue');   // WHERE employee_id = 'fooValue'
     * $query->filterByEmployeeId('%fooValue%', Criteria::LIKE); // WHERE employee_id LIKE '%fooValue%'
     * $query->filterByEmployeeId(['foo', 'bar']); // WHERE employee_id IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $employeeId The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmployeeId($employeeId = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($employeeId)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiTransactionViewTableMap::COL_EMPLOYEE_ID, $employeeId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the voucher_no column
     *
     * Example usage:
     * <code>
     * $query->filterByVoucherNo('fooValue');   // WHERE voucher_no = 'fooValue'
     * $query->filterByVoucherNo('%fooValue%', Criteria::LIKE); // WHERE voucher_no LIKE '%fooValue%'
     * $query->filterByVoucherNo(['foo', 'bar']); // WHERE voucher_no IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $voucherNo The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByVoucherNo($voucherNo = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($voucherNo)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiTransactionViewTableMap::COL_VOUCHER_NO, $voucherNo, $comparison);

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

        $this->addUsingAlias(SgpiTransactionViewTableMap::COL_REMARK, $remark, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_name column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletName('fooValue');   // WHERE outlet_name = 'fooValue'
     * $query->filterByOutletName('%fooValue%', Criteria::LIKE); // WHERE outlet_name LIKE '%fooValue%'
     * $query->filterByOutletName(['foo', 'bar']); // WHERE outlet_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $outletName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletName($outletName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($outletName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiTransactionViewTableMap::COL_OUTLET_NAME, $outletName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the dcr_date column
     *
     * Example usage:
     * <code>
     * $query->filterByDcrDate('fooValue');   // WHERE dcr_date = 'fooValue'
     * $query->filterByDcrDate('%fooValue%', Criteria::LIKE); // WHERE dcr_date LIKE '%fooValue%'
     * $query->filterByDcrDate(['foo', 'bar']); // WHERE dcr_date IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $dcrDate The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDcrDate($dcrDate = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($dcrDate)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiTransactionViewTableMap::COL_DCR_DATE, $dcrDate, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlettype_name column
     *
     * Example usage:
     * <code>
     * $query->filterByOutlettypeName('fooValue');   // WHERE outlettype_name = 'fooValue'
     * $query->filterByOutlettypeName('%fooValue%', Criteria::LIKE); // WHERE outlettype_name LIKE '%fooValue%'
     * $query->filterByOutlettypeName(['foo', 'bar']); // WHERE outlettype_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $outlettypeName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutlettypeName($outlettypeName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($outlettypeName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiTransactionViewTableMap::COL_OUTLETTYPE_NAME, $outlettypeName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the beat_name column
     *
     * Example usage:
     * <code>
     * $query->filterByBeatName('fooValue');   // WHERE beat_name = 'fooValue'
     * $query->filterByBeatName('%fooValue%', Criteria::LIKE); // WHERE beat_name LIKE '%fooValue%'
     * $query->filterByBeatName(['foo', 'bar']); // WHERE beat_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $beatName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBeatName($beatName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($beatName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiTransactionViewTableMap::COL_BEAT_NAME, $beatName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the use_start_date column
     *
     * Example usage:
     * <code>
     * $query->filterByUseStartDate('fooValue');   // WHERE use_start_date = 'fooValue'
     * $query->filterByUseStartDate('%fooValue%', Criteria::LIKE); // WHERE use_start_date LIKE '%fooValue%'
     * $query->filterByUseStartDate(['foo', 'bar']); // WHERE use_start_date IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $useStartDate The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUseStartDate($useStartDate = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($useStartDate)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiTransactionViewTableMap::COL_USE_START_DATE, $useStartDate, $comparison);

        return $this;
    }

    /**
     * Filter the query on the use_end_date column
     *
     * Example usage:
     * <code>
     * $query->filterByUseEndDate('fooValue');   // WHERE use_end_date = 'fooValue'
     * $query->filterByUseEndDate('%fooValue%', Criteria::LIKE); // WHERE use_end_date LIKE '%fooValue%'
     * $query->filterByUseEndDate(['foo', 'bar']); // WHERE use_end_date IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $useEndDate The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUseEndDate($useEndDate = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($useEndDate)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiTransactionViewTableMap::COL_USE_END_DATE, $useEndDate, $comparison);

        return $this;
    }

    /**
     * Filter the query on the sgpi_id column
     *
     * Example usage:
     * <code>
     * $query->filterBySgpiId('fooValue');   // WHERE sgpi_id = 'fooValue'
     * $query->filterBySgpiId('%fooValue%', Criteria::LIKE); // WHERE sgpi_id LIKE '%fooValue%'
     * $query->filterBySgpiId(['foo', 'bar']); // WHERE sgpi_id IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $sgpiId The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySgpiId($sgpiId = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($sgpiId)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiTransactionViewTableMap::COL_SGPI_ID, $sgpiId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the employee_code column
     *
     * Example usage:
     * <code>
     * $query->filterByEmployeeCode('fooValue');   // WHERE employee_code = 'fooValue'
     * $query->filterByEmployeeCode('%fooValue%', Criteria::LIKE); // WHERE employee_code LIKE '%fooValue%'
     * $query->filterByEmployeeCode(['foo', 'bar']); // WHERE employee_code IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $employeeCode The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmployeeCode($employeeCode = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($employeeCode)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiTransactionViewTableMap::COL_EMPLOYEE_CODE, $employeeCode, $comparison);

        return $this;
    }

    /**
     * Filter the query on the created_at column
     *
     * Example usage:
     * <code>
     * $query->filterByCreatedTa('fooValue');   // WHERE created_at = 'fooValue'
     * $query->filterByCreatedTa('%fooValue%', Criteria::LIKE); // WHERE created_at LIKE '%fooValue%'
     * $query->filterByCreatedTa(['foo', 'bar']); // WHERE created_at IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $createdTa The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCreatedTa($createdTa = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($createdTa)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiTransactionViewTableMap::COL_CREATED_AT, $createdTa, $comparison);

        return $this;
    }

    /**
     * Filter the query on the brand_name column
     *
     * Example usage:
     * <code>
     * $query->filterByBrandName('fooValue');   // WHERE brand_name = 'fooValue'
     * $query->filterByBrandName('%fooValue%', Criteria::LIKE); // WHERE brand_name LIKE '%fooValue%'
     * $query->filterByBrandName(['foo', 'bar']); // WHERE brand_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $brandName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBrandName($brandName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($brandName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiTransactionViewTableMap::COL_BRAND_NAME, $brandName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_code column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletCode('fooValue');   // WHERE outlet_code = 'fooValue'
     * $query->filterByOutletCode('%fooValue%', Criteria::LIKE); // WHERE outlet_code LIKE '%fooValue%'
     * $query->filterByOutletCode(['foo', 'bar']); // WHERE outlet_code IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $outletCode The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletCode($outletCode = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($outletCode)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiTransactionViewTableMap::COL_OUTLET_CODE, $outletCode, $comparison);

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSgpiTransactionView $sgpiTransactionView Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($sgpiTransactionView = null)
    {
        if ($sgpiTransactionView) {
            throw new LogicException('SgpiTransactionView object has no primary key');

        }

        return $this;
    }

}
