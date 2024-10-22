<?php

namespace entities\Base;

use \Exception;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use entities\TempEntronRcpaRestore as ChildTempEntronRcpaRestore;
use entities\TempEntronRcpaRestoreQuery as ChildTempEntronRcpaRestoreQuery;
use entities\Map\TempEntronRcpaRestoreTableMap;

/**
 * Base class that represents a query for the `temp_entron_rcpa_restore` table.
 *
 * @method     ChildTempEntronRcpaRestoreQuery orderByBrcpaId($order = Criteria::ASC) Order by the brcpa_id column
 * @method     ChildTempEntronRcpaRestoreQuery orderByOutletId($order = Criteria::ASC) Order by the outlet_id column
 * @method     ChildTempEntronRcpaRestoreQuery orderByRetailOutletId($order = Criteria::ASC) Order by the retail_outlet_id column
 * @method     ChildTempEntronRcpaRestoreQuery orderByEmployeeId($order = Criteria::ASC) Order by the employee_id column
 * @method     ChildTempEntronRcpaRestoreQuery orderByRcpaValue($order = Criteria::ASC) Order by the rcpa_value column
 * @method     ChildTempEntronRcpaRestoreQuery orderByBrandId($order = Criteria::ASC) Order by the brand_id column
 * @method     ChildTempEntronRcpaRestoreQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildTempEntronRcpaRestoreQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildTempEntronRcpaRestoreQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildTempEntronRcpaRestoreQuery orderByRcpaMoye($order = Criteria::ASC) Order by the rcpa_moye column
 * @method     ChildTempEntronRcpaRestoreQuery orderByCompetitorId($order = Criteria::ASC) Order by the competitor_id column
 * @method     ChildTempEntronRcpaRestoreQuery orderByRefName($order = Criteria::ASC) Order by the ref_name column
 * @method     ChildTempEntronRcpaRestoreQuery orderByProductId($order = Criteria::ASC) Order by the product_id column
 *
 * @method     ChildTempEntronRcpaRestoreQuery groupByBrcpaId() Group by the brcpa_id column
 * @method     ChildTempEntronRcpaRestoreQuery groupByOutletId() Group by the outlet_id column
 * @method     ChildTempEntronRcpaRestoreQuery groupByRetailOutletId() Group by the retail_outlet_id column
 * @method     ChildTempEntronRcpaRestoreQuery groupByEmployeeId() Group by the employee_id column
 * @method     ChildTempEntronRcpaRestoreQuery groupByRcpaValue() Group by the rcpa_value column
 * @method     ChildTempEntronRcpaRestoreQuery groupByBrandId() Group by the brand_id column
 * @method     ChildTempEntronRcpaRestoreQuery groupByCompanyId() Group by the company_id column
 * @method     ChildTempEntronRcpaRestoreQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildTempEntronRcpaRestoreQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildTempEntronRcpaRestoreQuery groupByRcpaMoye() Group by the rcpa_moye column
 * @method     ChildTempEntronRcpaRestoreQuery groupByCompetitorId() Group by the competitor_id column
 * @method     ChildTempEntronRcpaRestoreQuery groupByRefName() Group by the ref_name column
 * @method     ChildTempEntronRcpaRestoreQuery groupByProductId() Group by the product_id column
 *
 * @method     ChildTempEntronRcpaRestoreQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildTempEntronRcpaRestoreQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildTempEntronRcpaRestoreQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildTempEntronRcpaRestoreQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildTempEntronRcpaRestoreQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildTempEntronRcpaRestoreQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildTempEntronRcpaRestore|null findOne(?ConnectionInterface $con = null) Return the first ChildTempEntronRcpaRestore matching the query
 * @method     ChildTempEntronRcpaRestore findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildTempEntronRcpaRestore matching the query, or a new ChildTempEntronRcpaRestore object populated from the query conditions when no match is found
 *
 * @method     ChildTempEntronRcpaRestore|null findOneByBrcpaId(int $brcpa_id) Return the first ChildTempEntronRcpaRestore filtered by the brcpa_id column
 * @method     ChildTempEntronRcpaRestore|null findOneByOutletId(int $outlet_id) Return the first ChildTempEntronRcpaRestore filtered by the outlet_id column
 * @method     ChildTempEntronRcpaRestore|null findOneByRetailOutletId(int $retail_outlet_id) Return the first ChildTempEntronRcpaRestore filtered by the retail_outlet_id column
 * @method     ChildTempEntronRcpaRestore|null findOneByEmployeeId(int $employee_id) Return the first ChildTempEntronRcpaRestore filtered by the employee_id column
 * @method     ChildTempEntronRcpaRestore|null findOneByRcpaValue(string $rcpa_value) Return the first ChildTempEntronRcpaRestore filtered by the rcpa_value column
 * @method     ChildTempEntronRcpaRestore|null findOneByBrandId(int $brand_id) Return the first ChildTempEntronRcpaRestore filtered by the brand_id column
 * @method     ChildTempEntronRcpaRestore|null findOneByCompanyId(int $company_id) Return the first ChildTempEntronRcpaRestore filtered by the company_id column
 * @method     ChildTempEntronRcpaRestore|null findOneByCreatedAt(string $created_at) Return the first ChildTempEntronRcpaRestore filtered by the created_at column
 * @method     ChildTempEntronRcpaRestore|null findOneByUpdatedAt(string $updated_at) Return the first ChildTempEntronRcpaRestore filtered by the updated_at column
 * @method     ChildTempEntronRcpaRestore|null findOneByRcpaMoye(string $rcpa_moye) Return the first ChildTempEntronRcpaRestore filtered by the rcpa_moye column
 * @method     ChildTempEntronRcpaRestore|null findOneByCompetitorId(int $competitor_id) Return the first ChildTempEntronRcpaRestore filtered by the competitor_id column
 * @method     ChildTempEntronRcpaRestore|null findOneByRefName(string $ref_name) Return the first ChildTempEntronRcpaRestore filtered by the ref_name column
 * @method     ChildTempEntronRcpaRestore|null findOneByProductId(int $product_id) Return the first ChildTempEntronRcpaRestore filtered by the product_id column
 *
 * @method     ChildTempEntronRcpaRestore requirePk($key, ?ConnectionInterface $con = null) Return the ChildTempEntronRcpaRestore by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTempEntronRcpaRestore requireOne(?ConnectionInterface $con = null) Return the first ChildTempEntronRcpaRestore matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTempEntronRcpaRestore requireOneByBrcpaId(int $brcpa_id) Return the first ChildTempEntronRcpaRestore filtered by the brcpa_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTempEntronRcpaRestore requireOneByOutletId(int $outlet_id) Return the first ChildTempEntronRcpaRestore filtered by the outlet_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTempEntronRcpaRestore requireOneByRetailOutletId(int $retail_outlet_id) Return the first ChildTempEntronRcpaRestore filtered by the retail_outlet_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTempEntronRcpaRestore requireOneByEmployeeId(int $employee_id) Return the first ChildTempEntronRcpaRestore filtered by the employee_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTempEntronRcpaRestore requireOneByRcpaValue(string $rcpa_value) Return the first ChildTempEntronRcpaRestore filtered by the rcpa_value column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTempEntronRcpaRestore requireOneByBrandId(int $brand_id) Return the first ChildTempEntronRcpaRestore filtered by the brand_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTempEntronRcpaRestore requireOneByCompanyId(int $company_id) Return the first ChildTempEntronRcpaRestore filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTempEntronRcpaRestore requireOneByCreatedAt(string $created_at) Return the first ChildTempEntronRcpaRestore filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTempEntronRcpaRestore requireOneByUpdatedAt(string $updated_at) Return the first ChildTempEntronRcpaRestore filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTempEntronRcpaRestore requireOneByRcpaMoye(string $rcpa_moye) Return the first ChildTempEntronRcpaRestore filtered by the rcpa_moye column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTempEntronRcpaRestore requireOneByCompetitorId(int $competitor_id) Return the first ChildTempEntronRcpaRestore filtered by the competitor_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTempEntronRcpaRestore requireOneByRefName(string $ref_name) Return the first ChildTempEntronRcpaRestore filtered by the ref_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTempEntronRcpaRestore requireOneByProductId(int $product_id) Return the first ChildTempEntronRcpaRestore filtered by the product_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTempEntronRcpaRestore[]|Collection find(?ConnectionInterface $con = null) Return ChildTempEntronRcpaRestore objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildTempEntronRcpaRestore> find(?ConnectionInterface $con = null) Return ChildTempEntronRcpaRestore objects based on current ModelCriteria
 *
 * @method     ChildTempEntronRcpaRestore[]|Collection findByBrcpaId(int|array<int> $brcpa_id) Return ChildTempEntronRcpaRestore objects filtered by the brcpa_id column
 * @psalm-method Collection&\Traversable<ChildTempEntronRcpaRestore> findByBrcpaId(int|array<int> $brcpa_id) Return ChildTempEntronRcpaRestore objects filtered by the brcpa_id column
 * @method     ChildTempEntronRcpaRestore[]|Collection findByOutletId(int|array<int> $outlet_id) Return ChildTempEntronRcpaRestore objects filtered by the outlet_id column
 * @psalm-method Collection&\Traversable<ChildTempEntronRcpaRestore> findByOutletId(int|array<int> $outlet_id) Return ChildTempEntronRcpaRestore objects filtered by the outlet_id column
 * @method     ChildTempEntronRcpaRestore[]|Collection findByRetailOutletId(int|array<int> $retail_outlet_id) Return ChildTempEntronRcpaRestore objects filtered by the retail_outlet_id column
 * @psalm-method Collection&\Traversable<ChildTempEntronRcpaRestore> findByRetailOutletId(int|array<int> $retail_outlet_id) Return ChildTempEntronRcpaRestore objects filtered by the retail_outlet_id column
 * @method     ChildTempEntronRcpaRestore[]|Collection findByEmployeeId(int|array<int> $employee_id) Return ChildTempEntronRcpaRestore objects filtered by the employee_id column
 * @psalm-method Collection&\Traversable<ChildTempEntronRcpaRestore> findByEmployeeId(int|array<int> $employee_id) Return ChildTempEntronRcpaRestore objects filtered by the employee_id column
 * @method     ChildTempEntronRcpaRestore[]|Collection findByRcpaValue(string|array<string> $rcpa_value) Return ChildTempEntronRcpaRestore objects filtered by the rcpa_value column
 * @psalm-method Collection&\Traversable<ChildTempEntronRcpaRestore> findByRcpaValue(string|array<string> $rcpa_value) Return ChildTempEntronRcpaRestore objects filtered by the rcpa_value column
 * @method     ChildTempEntronRcpaRestore[]|Collection findByBrandId(int|array<int> $brand_id) Return ChildTempEntronRcpaRestore objects filtered by the brand_id column
 * @psalm-method Collection&\Traversable<ChildTempEntronRcpaRestore> findByBrandId(int|array<int> $brand_id) Return ChildTempEntronRcpaRestore objects filtered by the brand_id column
 * @method     ChildTempEntronRcpaRestore[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildTempEntronRcpaRestore objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildTempEntronRcpaRestore> findByCompanyId(int|array<int> $company_id) Return ChildTempEntronRcpaRestore objects filtered by the company_id column
 * @method     ChildTempEntronRcpaRestore[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildTempEntronRcpaRestore objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildTempEntronRcpaRestore> findByCreatedAt(string|array<string> $created_at) Return ChildTempEntronRcpaRestore objects filtered by the created_at column
 * @method     ChildTempEntronRcpaRestore[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildTempEntronRcpaRestore objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildTempEntronRcpaRestore> findByUpdatedAt(string|array<string> $updated_at) Return ChildTempEntronRcpaRestore objects filtered by the updated_at column
 * @method     ChildTempEntronRcpaRestore[]|Collection findByRcpaMoye(string|array<string> $rcpa_moye) Return ChildTempEntronRcpaRestore objects filtered by the rcpa_moye column
 * @psalm-method Collection&\Traversable<ChildTempEntronRcpaRestore> findByRcpaMoye(string|array<string> $rcpa_moye) Return ChildTempEntronRcpaRestore objects filtered by the rcpa_moye column
 * @method     ChildTempEntronRcpaRestore[]|Collection findByCompetitorId(int|array<int> $competitor_id) Return ChildTempEntronRcpaRestore objects filtered by the competitor_id column
 * @psalm-method Collection&\Traversable<ChildTempEntronRcpaRestore> findByCompetitorId(int|array<int> $competitor_id) Return ChildTempEntronRcpaRestore objects filtered by the competitor_id column
 * @method     ChildTempEntronRcpaRestore[]|Collection findByRefName(string|array<string> $ref_name) Return ChildTempEntronRcpaRestore objects filtered by the ref_name column
 * @psalm-method Collection&\Traversable<ChildTempEntronRcpaRestore> findByRefName(string|array<string> $ref_name) Return ChildTempEntronRcpaRestore objects filtered by the ref_name column
 * @method     ChildTempEntronRcpaRestore[]|Collection findByProductId(int|array<int> $product_id) Return ChildTempEntronRcpaRestore objects filtered by the product_id column
 * @psalm-method Collection&\Traversable<ChildTempEntronRcpaRestore> findByProductId(int|array<int> $product_id) Return ChildTempEntronRcpaRestore objects filtered by the product_id column
 *
 * @method     ChildTempEntronRcpaRestore[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildTempEntronRcpaRestore> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class TempEntronRcpaRestoreQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\TempEntronRcpaRestoreQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\TempEntronRcpaRestore', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildTempEntronRcpaRestoreQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildTempEntronRcpaRestoreQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildTempEntronRcpaRestoreQuery) {
            return $criteria;
        }
        $query = new ChildTempEntronRcpaRestoreQuery();
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
     * @return ChildTempEntronRcpaRestore|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        throw new LogicException('The TempEntronRcpaRestore object has no primary key');
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
        throw new LogicException('The TempEntronRcpaRestore object has no primary key');
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
        throw new LogicException('The TempEntronRcpaRestore object has no primary key');
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
        throw new LogicException('The TempEntronRcpaRestore object has no primary key');
    }

    /**
     * Filter the query on the brcpa_id column
     *
     * Example usage:
     * <code>
     * $query->filterByBrcpaId(1234); // WHERE brcpa_id = 1234
     * $query->filterByBrcpaId(array(12, 34)); // WHERE brcpa_id IN (12, 34)
     * $query->filterByBrcpaId(array('min' => 12)); // WHERE brcpa_id > 12
     * </code>
     *
     * @param mixed $brcpaId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBrcpaId($brcpaId = null, ?string $comparison = null)
    {
        if (is_array($brcpaId)) {
            $useMinMax = false;
            if (isset($brcpaId['min'])) {
                $this->addUsingAlias(TempEntronRcpaRestoreTableMap::COL_BRCPA_ID, $brcpaId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($brcpaId['max'])) {
                $this->addUsingAlias(TempEntronRcpaRestoreTableMap::COL_BRCPA_ID, $brcpaId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TempEntronRcpaRestoreTableMap::COL_BRCPA_ID, $brcpaId, $comparison);

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
                $this->addUsingAlias(TempEntronRcpaRestoreTableMap::COL_OUTLET_ID, $outletId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outletId['max'])) {
                $this->addUsingAlias(TempEntronRcpaRestoreTableMap::COL_OUTLET_ID, $outletId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TempEntronRcpaRestoreTableMap::COL_OUTLET_ID, $outletId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the retail_outlet_id column
     *
     * Example usage:
     * <code>
     * $query->filterByRetailOutletId(1234); // WHERE retail_outlet_id = 1234
     * $query->filterByRetailOutletId(array(12, 34)); // WHERE retail_outlet_id IN (12, 34)
     * $query->filterByRetailOutletId(array('min' => 12)); // WHERE retail_outlet_id > 12
     * </code>
     *
     * @param mixed $retailOutletId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRetailOutletId($retailOutletId = null, ?string $comparison = null)
    {
        if (is_array($retailOutletId)) {
            $useMinMax = false;
            if (isset($retailOutletId['min'])) {
                $this->addUsingAlias(TempEntronRcpaRestoreTableMap::COL_RETAIL_OUTLET_ID, $retailOutletId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($retailOutletId['max'])) {
                $this->addUsingAlias(TempEntronRcpaRestoreTableMap::COL_RETAIL_OUTLET_ID, $retailOutletId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TempEntronRcpaRestoreTableMap::COL_RETAIL_OUTLET_ID, $retailOutletId, $comparison);

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
                $this->addUsingAlias(TempEntronRcpaRestoreTableMap::COL_EMPLOYEE_ID, $employeeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($employeeId['max'])) {
                $this->addUsingAlias(TempEntronRcpaRestoreTableMap::COL_EMPLOYEE_ID, $employeeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TempEntronRcpaRestoreTableMap::COL_EMPLOYEE_ID, $employeeId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the rcpa_value column
     *
     * Example usage:
     * <code>
     * $query->filterByRcpaValue(1234); // WHERE rcpa_value = 1234
     * $query->filterByRcpaValue(array(12, 34)); // WHERE rcpa_value IN (12, 34)
     * $query->filterByRcpaValue(array('min' => 12)); // WHERE rcpa_value > 12
     * </code>
     *
     * @param mixed $rcpaValue The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRcpaValue($rcpaValue = null, ?string $comparison = null)
    {
        if (is_array($rcpaValue)) {
            $useMinMax = false;
            if (isset($rcpaValue['min'])) {
                $this->addUsingAlias(TempEntronRcpaRestoreTableMap::COL_RCPA_VALUE, $rcpaValue['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($rcpaValue['max'])) {
                $this->addUsingAlias(TempEntronRcpaRestoreTableMap::COL_RCPA_VALUE, $rcpaValue['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TempEntronRcpaRestoreTableMap::COL_RCPA_VALUE, $rcpaValue, $comparison);

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
                $this->addUsingAlias(TempEntronRcpaRestoreTableMap::COL_BRAND_ID, $brandId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($brandId['max'])) {
                $this->addUsingAlias(TempEntronRcpaRestoreTableMap::COL_BRAND_ID, $brandId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TempEntronRcpaRestoreTableMap::COL_BRAND_ID, $brandId, $comparison);

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
                $this->addUsingAlias(TempEntronRcpaRestoreTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(TempEntronRcpaRestoreTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TempEntronRcpaRestoreTableMap::COL_COMPANY_ID, $companyId, $comparison);

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
                $this->addUsingAlias(TempEntronRcpaRestoreTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(TempEntronRcpaRestoreTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TempEntronRcpaRestoreTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(TempEntronRcpaRestoreTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(TempEntronRcpaRestoreTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TempEntronRcpaRestoreTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the rcpa_moye column
     *
     * Example usage:
     * <code>
     * $query->filterByRcpaMoye('fooValue');   // WHERE rcpa_moye = 'fooValue'
     * $query->filterByRcpaMoye('%fooValue%', Criteria::LIKE); // WHERE rcpa_moye LIKE '%fooValue%'
     * $query->filterByRcpaMoye(['foo', 'bar']); // WHERE rcpa_moye IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $rcpaMoye The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRcpaMoye($rcpaMoye = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($rcpaMoye)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TempEntronRcpaRestoreTableMap::COL_RCPA_MOYE, $rcpaMoye, $comparison);

        return $this;
    }

    /**
     * Filter the query on the competitor_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCompetitorId(1234); // WHERE competitor_id = 1234
     * $query->filterByCompetitorId(array(12, 34)); // WHERE competitor_id IN (12, 34)
     * $query->filterByCompetitorId(array('min' => 12)); // WHERE competitor_id > 12
     * </code>
     *
     * @param mixed $competitorId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCompetitorId($competitorId = null, ?string $comparison = null)
    {
        if (is_array($competitorId)) {
            $useMinMax = false;
            if (isset($competitorId['min'])) {
                $this->addUsingAlias(TempEntronRcpaRestoreTableMap::COL_COMPETITOR_ID, $competitorId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($competitorId['max'])) {
                $this->addUsingAlias(TempEntronRcpaRestoreTableMap::COL_COMPETITOR_ID, $competitorId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TempEntronRcpaRestoreTableMap::COL_COMPETITOR_ID, $competitorId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the ref_name column
     *
     * Example usage:
     * <code>
     * $query->filterByRefName('fooValue');   // WHERE ref_name = 'fooValue'
     * $query->filterByRefName('%fooValue%', Criteria::LIKE); // WHERE ref_name LIKE '%fooValue%'
     * $query->filterByRefName(['foo', 'bar']); // WHERE ref_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $refName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRefName($refName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($refName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TempEntronRcpaRestoreTableMap::COL_REF_NAME, $refName, $comparison);

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
                $this->addUsingAlias(TempEntronRcpaRestoreTableMap::COL_PRODUCT_ID, $productId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($productId['max'])) {
                $this->addUsingAlias(TempEntronRcpaRestoreTableMap::COL_PRODUCT_ID, $productId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TempEntronRcpaRestoreTableMap::COL_PRODUCT_ID, $productId, $comparison);

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildTempEntronRcpaRestore $tempEntronRcpaRestore Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($tempEntronRcpaRestore = null)
    {
        if ($tempEntronRcpaRestore) {
            throw new LogicException('TempEntronRcpaRestore object has no primary key');

        }

        return $this;
    }

    /**
     * Deletes all rows from the temp_entron_rcpa_restore table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(TempEntronRcpaRestoreTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            TempEntronRcpaRestoreTableMap::clearInstancePool();
            TempEntronRcpaRestoreTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(TempEntronRcpaRestoreTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(TempEntronRcpaRestoreTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            TempEntronRcpaRestoreTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            TempEntronRcpaRestoreTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
