<?php

namespace entities\Base;

use \Exception;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\LogicException;
use entities\OutletSgpiCompliantView as ChildOutletSgpiCompliantView;
use entities\OutletSgpiCompliantViewQuery as ChildOutletSgpiCompliantViewQuery;
use entities\Map\OutletSgpiCompliantViewTableMap;

/**
 * Base class that represents a query for the `outlet_sgpi_compliant_view` table.
 *
 * @method     ChildOutletSgpiCompliantViewQuery orderByMoye($order = Criteria::ASC) Order by the moye column
 * @method     ChildOutletSgpiCompliantViewQuery orderByOrgDataId($order = Criteria::ASC) Order by the org_data_id column
 * @method     ChildOutletSgpiCompliantViewQuery orderByBrandId($order = Criteria::ASC) Order by the brand_id column
 * @method     ChildOutletSgpiCompliantViewQuery orderBySgpiStatus($order = Criteria::ASC) Order by the sgpi_status column
 * @method     ChildOutletSgpiCompliantViewQuery orderBySgpiId($order = Criteria::ASC) Order by the sgpi_id column
 * @method     ChildOutletSgpiCompliantViewQuery orderBySgpiType($order = Criteria::ASC) Order by the sgpi_type column
 * @method     ChildOutletSgpiCompliantViewQuery orderByPositionId($order = Criteria::ASC) Order by the position_id column
 * @method     ChildOutletSgpiCompliantViewQuery orderByEmployeeId($order = Criteria::ASC) Order by the employee_id column
 * @method     ChildOutletSgpiCompliantViewQuery orderByTotalQty($order = Criteria::ASC) Order by the total_qty column
 * @method     ChildOutletSgpiCompliantViewQuery orderByCompliant($order = Criteria::ASC) Order by the compliant column
 *
 * @method     ChildOutletSgpiCompliantViewQuery groupByMoye() Group by the moye column
 * @method     ChildOutletSgpiCompliantViewQuery groupByOrgDataId() Group by the org_data_id column
 * @method     ChildOutletSgpiCompliantViewQuery groupByBrandId() Group by the brand_id column
 * @method     ChildOutletSgpiCompliantViewQuery groupBySgpiStatus() Group by the sgpi_status column
 * @method     ChildOutletSgpiCompliantViewQuery groupBySgpiId() Group by the sgpi_id column
 * @method     ChildOutletSgpiCompliantViewQuery groupBySgpiType() Group by the sgpi_type column
 * @method     ChildOutletSgpiCompliantViewQuery groupByPositionId() Group by the position_id column
 * @method     ChildOutletSgpiCompliantViewQuery groupByEmployeeId() Group by the employee_id column
 * @method     ChildOutletSgpiCompliantViewQuery groupByTotalQty() Group by the total_qty column
 * @method     ChildOutletSgpiCompliantViewQuery groupByCompliant() Group by the compliant column
 *
 * @method     ChildOutletSgpiCompliantViewQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildOutletSgpiCompliantViewQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildOutletSgpiCompliantViewQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildOutletSgpiCompliantViewQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildOutletSgpiCompliantViewQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildOutletSgpiCompliantViewQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildOutletSgpiCompliantView|null findOne(?ConnectionInterface $con = null) Return the first ChildOutletSgpiCompliantView matching the query
 * @method     ChildOutletSgpiCompliantView findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildOutletSgpiCompliantView matching the query, or a new ChildOutletSgpiCompliantView object populated from the query conditions when no match is found
 *
 * @method     ChildOutletSgpiCompliantView|null findOneByMoye(string $moye) Return the first ChildOutletSgpiCompliantView filtered by the moye column
 * @method     ChildOutletSgpiCompliantView|null findOneByOrgDataId(int $org_data_id) Return the first ChildOutletSgpiCompliantView filtered by the org_data_id column
 * @method     ChildOutletSgpiCompliantView|null findOneByBrandId(int $brand_id) Return the first ChildOutletSgpiCompliantView filtered by the brand_id column
 * @method     ChildOutletSgpiCompliantView|null findOneBySgpiStatus(boolean $sgpi_status) Return the first ChildOutletSgpiCompliantView filtered by the sgpi_status column
 * @method     ChildOutletSgpiCompliantView|null findOneBySgpiId(int $sgpi_id) Return the first ChildOutletSgpiCompliantView filtered by the sgpi_id column
 * @method     ChildOutletSgpiCompliantView|null findOneBySgpiType(string $sgpi_type) Return the first ChildOutletSgpiCompliantView filtered by the sgpi_type column
 * @method     ChildOutletSgpiCompliantView|null findOneByPositionId(int $position_id) Return the first ChildOutletSgpiCompliantView filtered by the position_id column
 * @method     ChildOutletSgpiCompliantView|null findOneByEmployeeId(int $employee_id) Return the first ChildOutletSgpiCompliantView filtered by the employee_id column
 * @method     ChildOutletSgpiCompliantView|null findOneByTotalQty(int $total_qty) Return the first ChildOutletSgpiCompliantView filtered by the total_qty column
 * @method     ChildOutletSgpiCompliantView|null findOneByCompliant(string $compliant) Return the first ChildOutletSgpiCompliantView filtered by the compliant column
 *
 * @method     ChildOutletSgpiCompliantView requirePk($key, ?ConnectionInterface $con = null) Return the ChildOutletSgpiCompliantView by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletSgpiCompliantView requireOne(?ConnectionInterface $con = null) Return the first ChildOutletSgpiCompliantView matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOutletSgpiCompliantView requireOneByMoye(string $moye) Return the first ChildOutletSgpiCompliantView filtered by the moye column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletSgpiCompliantView requireOneByOrgDataId(int $org_data_id) Return the first ChildOutletSgpiCompliantView filtered by the org_data_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletSgpiCompliantView requireOneByBrandId(int $brand_id) Return the first ChildOutletSgpiCompliantView filtered by the brand_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletSgpiCompliantView requireOneBySgpiStatus(boolean $sgpi_status) Return the first ChildOutletSgpiCompliantView filtered by the sgpi_status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletSgpiCompliantView requireOneBySgpiId(int $sgpi_id) Return the first ChildOutletSgpiCompliantView filtered by the sgpi_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletSgpiCompliantView requireOneBySgpiType(string $sgpi_type) Return the first ChildOutletSgpiCompliantView filtered by the sgpi_type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletSgpiCompliantView requireOneByPositionId(int $position_id) Return the first ChildOutletSgpiCompliantView filtered by the position_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletSgpiCompliantView requireOneByEmployeeId(int $employee_id) Return the first ChildOutletSgpiCompliantView filtered by the employee_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletSgpiCompliantView requireOneByTotalQty(int $total_qty) Return the first ChildOutletSgpiCompliantView filtered by the total_qty column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletSgpiCompliantView requireOneByCompliant(string $compliant) Return the first ChildOutletSgpiCompliantView filtered by the compliant column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOutletSgpiCompliantView[]|Collection find(?ConnectionInterface $con = null) Return ChildOutletSgpiCompliantView objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildOutletSgpiCompliantView> find(?ConnectionInterface $con = null) Return ChildOutletSgpiCompliantView objects based on current ModelCriteria
 *
 * @method     ChildOutletSgpiCompliantView[]|Collection findByMoye(string|array<string> $moye) Return ChildOutletSgpiCompliantView objects filtered by the moye column
 * @psalm-method Collection&\Traversable<ChildOutletSgpiCompliantView> findByMoye(string|array<string> $moye) Return ChildOutletSgpiCompliantView objects filtered by the moye column
 * @method     ChildOutletSgpiCompliantView[]|Collection findByOrgDataId(int|array<int> $org_data_id) Return ChildOutletSgpiCompliantView objects filtered by the org_data_id column
 * @psalm-method Collection&\Traversable<ChildOutletSgpiCompliantView> findByOrgDataId(int|array<int> $org_data_id) Return ChildOutletSgpiCompliantView objects filtered by the org_data_id column
 * @method     ChildOutletSgpiCompliantView[]|Collection findByBrandId(int|array<int> $brand_id) Return ChildOutletSgpiCompliantView objects filtered by the brand_id column
 * @psalm-method Collection&\Traversable<ChildOutletSgpiCompliantView> findByBrandId(int|array<int> $brand_id) Return ChildOutletSgpiCompliantView objects filtered by the brand_id column
 * @method     ChildOutletSgpiCompliantView[]|Collection findBySgpiStatus(boolean|array<boolean> $sgpi_status) Return ChildOutletSgpiCompliantView objects filtered by the sgpi_status column
 * @psalm-method Collection&\Traversable<ChildOutletSgpiCompliantView> findBySgpiStatus(boolean|array<boolean> $sgpi_status) Return ChildOutletSgpiCompliantView objects filtered by the sgpi_status column
 * @method     ChildOutletSgpiCompliantView[]|Collection findBySgpiId(int|array<int> $sgpi_id) Return ChildOutletSgpiCompliantView objects filtered by the sgpi_id column
 * @psalm-method Collection&\Traversable<ChildOutletSgpiCompliantView> findBySgpiId(int|array<int> $sgpi_id) Return ChildOutletSgpiCompliantView objects filtered by the sgpi_id column
 * @method     ChildOutletSgpiCompliantView[]|Collection findBySgpiType(string|array<string> $sgpi_type) Return ChildOutletSgpiCompliantView objects filtered by the sgpi_type column
 * @psalm-method Collection&\Traversable<ChildOutletSgpiCompliantView> findBySgpiType(string|array<string> $sgpi_type) Return ChildOutletSgpiCompliantView objects filtered by the sgpi_type column
 * @method     ChildOutletSgpiCompliantView[]|Collection findByPositionId(int|array<int> $position_id) Return ChildOutletSgpiCompliantView objects filtered by the position_id column
 * @psalm-method Collection&\Traversable<ChildOutletSgpiCompliantView> findByPositionId(int|array<int> $position_id) Return ChildOutletSgpiCompliantView objects filtered by the position_id column
 * @method     ChildOutletSgpiCompliantView[]|Collection findByEmployeeId(int|array<int> $employee_id) Return ChildOutletSgpiCompliantView objects filtered by the employee_id column
 * @psalm-method Collection&\Traversable<ChildOutletSgpiCompliantView> findByEmployeeId(int|array<int> $employee_id) Return ChildOutletSgpiCompliantView objects filtered by the employee_id column
 * @method     ChildOutletSgpiCompliantView[]|Collection findByTotalQty(int|array<int> $total_qty) Return ChildOutletSgpiCompliantView objects filtered by the total_qty column
 * @psalm-method Collection&\Traversable<ChildOutletSgpiCompliantView> findByTotalQty(int|array<int> $total_qty) Return ChildOutletSgpiCompliantView objects filtered by the total_qty column
 * @method     ChildOutletSgpiCompliantView[]|Collection findByCompliant(string|array<string> $compliant) Return ChildOutletSgpiCompliantView objects filtered by the compliant column
 * @psalm-method Collection&\Traversable<ChildOutletSgpiCompliantView> findByCompliant(string|array<string> $compliant) Return ChildOutletSgpiCompliantView objects filtered by the compliant column
 *
 * @method     ChildOutletSgpiCompliantView[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildOutletSgpiCompliantView> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class OutletSgpiCompliantViewQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\OutletSgpiCompliantViewQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\OutletSgpiCompliantView', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildOutletSgpiCompliantViewQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildOutletSgpiCompliantViewQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildOutletSgpiCompliantViewQuery) {
            return $criteria;
        }
        $query = new ChildOutletSgpiCompliantViewQuery();
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
     * @return ChildOutletSgpiCompliantView|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        throw new LogicException('The OutletSgpiCompliantView object has no primary key');
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
        throw new LogicException('The OutletSgpiCompliantView object has no primary key');
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
        throw new LogicException('The OutletSgpiCompliantView object has no primary key');
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
        throw new LogicException('The OutletSgpiCompliantView object has no primary key');
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

        $this->addUsingAlias(OutletSgpiCompliantViewTableMap::COL_MOYE, $moye, $comparison);

        return $this;
    }

    /**
     * Filter the query on the org_data_id column
     *
     * Example usage:
     * <code>
     * $query->filterByOrgDataId(1234); // WHERE org_data_id = 1234
     * $query->filterByOrgDataId(array(12, 34)); // WHERE org_data_id IN (12, 34)
     * $query->filterByOrgDataId(array('min' => 12)); // WHERE org_data_id > 12
     * </code>
     *
     * @param mixed $orgDataId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrgDataId($orgDataId = null, ?string $comparison = null)
    {
        if (is_array($orgDataId)) {
            $useMinMax = false;
            if (isset($orgDataId['min'])) {
                $this->addUsingAlias(OutletSgpiCompliantViewTableMap::COL_ORG_DATA_ID, $orgDataId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($orgDataId['max'])) {
                $this->addUsingAlias(OutletSgpiCompliantViewTableMap::COL_ORG_DATA_ID, $orgDataId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletSgpiCompliantViewTableMap::COL_ORG_DATA_ID, $orgDataId, $comparison);

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
                $this->addUsingAlias(OutletSgpiCompliantViewTableMap::COL_BRAND_ID, $brandId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($brandId['max'])) {
                $this->addUsingAlias(OutletSgpiCompliantViewTableMap::COL_BRAND_ID, $brandId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletSgpiCompliantViewTableMap::COL_BRAND_ID, $brandId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the sgpi_status column
     *
     * Example usage:
     * <code>
     * $query->filterBySgpiStatus(true); // WHERE sgpi_status = true
     * $query->filterBySgpiStatus('yes'); // WHERE sgpi_status = true
     * </code>
     *
     * @param bool|string $sgpiStatus The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySgpiStatus($sgpiStatus = null, ?string $comparison = null)
    {
        if (is_string($sgpiStatus)) {
            $sgpiStatus = in_array(strtolower($sgpiStatus), array('false', 'off', '-', 'no', 'n', '0', ''), true) ? false : true;
        }

        $this->addUsingAlias(OutletSgpiCompliantViewTableMap::COL_SGPI_STATUS, $sgpiStatus, $comparison);

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
                $this->addUsingAlias(OutletSgpiCompliantViewTableMap::COL_SGPI_ID, $sgpiId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($sgpiId['max'])) {
                $this->addUsingAlias(OutletSgpiCompliantViewTableMap::COL_SGPI_ID, $sgpiId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletSgpiCompliantViewTableMap::COL_SGPI_ID, $sgpiId, $comparison);

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

        $this->addUsingAlias(OutletSgpiCompliantViewTableMap::COL_SGPI_TYPE, $sgpiType, $comparison);

        return $this;
    }

    /**
     * Filter the query on the position_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPositionId(1234); // WHERE position_id = 1234
     * $query->filterByPositionId(array(12, 34)); // WHERE position_id IN (12, 34)
     * $query->filterByPositionId(array('min' => 12)); // WHERE position_id > 12
     * </code>
     *
     * @param mixed $positionId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPositionId($positionId = null, ?string $comparison = null)
    {
        if (is_array($positionId)) {
            $useMinMax = false;
            if (isset($positionId['min'])) {
                $this->addUsingAlias(OutletSgpiCompliantViewTableMap::COL_POSITION_ID, $positionId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($positionId['max'])) {
                $this->addUsingAlias(OutletSgpiCompliantViewTableMap::COL_POSITION_ID, $positionId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletSgpiCompliantViewTableMap::COL_POSITION_ID, $positionId, $comparison);

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
                $this->addUsingAlias(OutletSgpiCompliantViewTableMap::COL_EMPLOYEE_ID, $employeeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($employeeId['max'])) {
                $this->addUsingAlias(OutletSgpiCompliantViewTableMap::COL_EMPLOYEE_ID, $employeeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletSgpiCompliantViewTableMap::COL_EMPLOYEE_ID, $employeeId, $comparison);

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
                $this->addUsingAlias(OutletSgpiCompliantViewTableMap::COL_TOTAL_QTY, $totalQty['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($totalQty['max'])) {
                $this->addUsingAlias(OutletSgpiCompliantViewTableMap::COL_TOTAL_QTY, $totalQty['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletSgpiCompliantViewTableMap::COL_TOTAL_QTY, $totalQty, $comparison);

        return $this;
    }

    /**
     * Filter the query on the compliant column
     *
     * Example usage:
     * <code>
     * $query->filterByCompliant('fooValue');   // WHERE compliant = 'fooValue'
     * $query->filterByCompliant('%fooValue%', Criteria::LIKE); // WHERE compliant LIKE '%fooValue%'
     * $query->filterByCompliant(['foo', 'bar']); // WHERE compliant IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $compliant The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCompliant($compliant = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($compliant)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletSgpiCompliantViewTableMap::COL_COMPLIANT, $compliant, $comparison);

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildOutletSgpiCompliantView $outletSgpiCompliantView Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($outletSgpiCompliantView = null)
    {
        if ($outletSgpiCompliantView) {
            throw new LogicException('OutletSgpiCompliantView object has no primary key');

        }

        return $this;
    }

}
