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
use entities\TempPrescriberAllData as ChildTempPrescriberAllData;
use entities\TempPrescriberAllDataQuery as ChildTempPrescriberAllDataQuery;
use entities\Map\TempPrescriberAllDataTableMap;

/**
 * Base class that represents a query for the `temp_prescriber_all_data` table.
 *
 * @method     ChildTempPrescriberAllDataQuery orderByOrgunit($order = Criteria::ASC) Order by the orgunit column
 * @method     ChildTempPrescriberAllDataQuery orderByDoctorcode($order = Criteria::ASC) Order by the doctorcode column
 * @method     ChildTempPrescriberAllDataQuery orderByBrandid($order = Criteria::ASC) Order by the brandid column
 * @method     ChildTempPrescriberAllDataQuery orderByCutoff($order = Criteria::ASC) Order by the cutoff column
 * @method     ChildTempPrescriberAllDataQuery orderByMonYear($order = Criteria::ASC) Order by the mon_year column
 * @method     ChildTempPrescriberAllDataQuery orderByLmRcpaValue($order = Criteria::ASC) Order by the lm_rcpa_value column
 * @method     ChildTempPrescriberAllDataQuery orderByCmRcpaValue($order = Criteria::ASC) Order by the cm_rcpa_value column
 * @method     ChildTempPrescriberAllDataQuery orderByLmVisit($order = Criteria::ASC) Order by the lm_visit column
 * @method     ChildTempPrescriberAllDataQuery orderByCmVisit($order = Criteria::ASC) Order by the cm_visit column
 * @method     ChildTempPrescriberAllDataQuery orderByLmRcpa($order = Criteria::ASC) Order by the lm_rcpa column
 * @method     ChildTempPrescriberAllDataQuery orderByCmRcpa($order = Criteria::ASC) Order by the cm_rcpa column
 * @method     ChildTempPrescriberAllDataQuery orderByCmRxberCat($order = Criteria::ASC) Order by the cm_rxber_cat column
 * @method     ChildTempPrescriberAllDataQuery orderByComputeDate($order = Criteria::ASC) Order by the compute_date column
 *
 * @method     ChildTempPrescriberAllDataQuery groupByOrgunit() Group by the orgunit column
 * @method     ChildTempPrescriberAllDataQuery groupByDoctorcode() Group by the doctorcode column
 * @method     ChildTempPrescriberAllDataQuery groupByBrandid() Group by the brandid column
 * @method     ChildTempPrescriberAllDataQuery groupByCutoff() Group by the cutoff column
 * @method     ChildTempPrescriberAllDataQuery groupByMonYear() Group by the mon_year column
 * @method     ChildTempPrescriberAllDataQuery groupByLmRcpaValue() Group by the lm_rcpa_value column
 * @method     ChildTempPrescriberAllDataQuery groupByCmRcpaValue() Group by the cm_rcpa_value column
 * @method     ChildTempPrescriberAllDataQuery groupByLmVisit() Group by the lm_visit column
 * @method     ChildTempPrescriberAllDataQuery groupByCmVisit() Group by the cm_visit column
 * @method     ChildTempPrescriberAllDataQuery groupByLmRcpa() Group by the lm_rcpa column
 * @method     ChildTempPrescriberAllDataQuery groupByCmRcpa() Group by the cm_rcpa column
 * @method     ChildTempPrescriberAllDataQuery groupByCmRxberCat() Group by the cm_rxber_cat column
 * @method     ChildTempPrescriberAllDataQuery groupByComputeDate() Group by the compute_date column
 *
 * @method     ChildTempPrescriberAllDataQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildTempPrescriberAllDataQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildTempPrescriberAllDataQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildTempPrescriberAllDataQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildTempPrescriberAllDataQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildTempPrescriberAllDataQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildTempPrescriberAllData|null findOne(?ConnectionInterface $con = null) Return the first ChildTempPrescriberAllData matching the query
 * @method     ChildTempPrescriberAllData findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildTempPrescriberAllData matching the query, or a new ChildTempPrescriberAllData object populated from the query conditions when no match is found
 *
 * @method     ChildTempPrescriberAllData|null findOneByOrgunit(string $orgunit) Return the first ChildTempPrescriberAllData filtered by the orgunit column
 * @method     ChildTempPrescriberAllData|null findOneByDoctorcode(string $doctorcode) Return the first ChildTempPrescriberAllData filtered by the doctorcode column
 * @method     ChildTempPrescriberAllData|null findOneByBrandid(int $brandid) Return the first ChildTempPrescriberAllData filtered by the brandid column
 * @method     ChildTempPrescriberAllData|null findOneByCutoff(int $cutoff) Return the first ChildTempPrescriberAllData filtered by the cutoff column
 * @method     ChildTempPrescriberAllData|null findOneByMonYear(string $mon_year) Return the first ChildTempPrescriberAllData filtered by the mon_year column
 * @method     ChildTempPrescriberAllData|null findOneByLmRcpaValue(double $lm_rcpa_value) Return the first ChildTempPrescriberAllData filtered by the lm_rcpa_value column
 * @method     ChildTempPrescriberAllData|null findOneByCmRcpaValue(double $cm_rcpa_value) Return the first ChildTempPrescriberAllData filtered by the cm_rcpa_value column
 * @method     ChildTempPrescriberAllData|null findOneByLmVisit(string $lm_visit) Return the first ChildTempPrescriberAllData filtered by the lm_visit column
 * @method     ChildTempPrescriberAllData|null findOneByCmVisit(string $cm_visit) Return the first ChildTempPrescriberAllData filtered by the cm_visit column
 * @method     ChildTempPrescriberAllData|null findOneByLmRcpa(string $lm_rcpa) Return the first ChildTempPrescriberAllData filtered by the lm_rcpa column
 * @method     ChildTempPrescriberAllData|null findOneByCmRcpa(string $cm_rcpa) Return the first ChildTempPrescriberAllData filtered by the cm_rcpa column
 * @method     ChildTempPrescriberAllData|null findOneByCmRxberCat(string $cm_rxber_cat) Return the first ChildTempPrescriberAllData filtered by the cm_rxber_cat column
 * @method     ChildTempPrescriberAllData|null findOneByComputeDate(string $compute_date) Return the first ChildTempPrescriberAllData filtered by the compute_date column
 *
 * @method     ChildTempPrescriberAllData requirePk($key, ?ConnectionInterface $con = null) Return the ChildTempPrescriberAllData by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTempPrescriberAllData requireOne(?ConnectionInterface $con = null) Return the first ChildTempPrescriberAllData matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTempPrescriberAllData requireOneByOrgunit(string $orgunit) Return the first ChildTempPrescriberAllData filtered by the orgunit column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTempPrescriberAllData requireOneByDoctorcode(string $doctorcode) Return the first ChildTempPrescriberAllData filtered by the doctorcode column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTempPrescriberAllData requireOneByBrandid(int $brandid) Return the first ChildTempPrescriberAllData filtered by the brandid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTempPrescriberAllData requireOneByCutoff(int $cutoff) Return the first ChildTempPrescriberAllData filtered by the cutoff column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTempPrescriberAllData requireOneByMonYear(string $mon_year) Return the first ChildTempPrescriberAllData filtered by the mon_year column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTempPrescriberAllData requireOneByLmRcpaValue(double $lm_rcpa_value) Return the first ChildTempPrescriberAllData filtered by the lm_rcpa_value column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTempPrescriberAllData requireOneByCmRcpaValue(double $cm_rcpa_value) Return the first ChildTempPrescriberAllData filtered by the cm_rcpa_value column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTempPrescriberAllData requireOneByLmVisit(string $lm_visit) Return the first ChildTempPrescriberAllData filtered by the lm_visit column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTempPrescriberAllData requireOneByCmVisit(string $cm_visit) Return the first ChildTempPrescriberAllData filtered by the cm_visit column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTempPrescriberAllData requireOneByLmRcpa(string $lm_rcpa) Return the first ChildTempPrescriberAllData filtered by the lm_rcpa column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTempPrescriberAllData requireOneByCmRcpa(string $cm_rcpa) Return the first ChildTempPrescriberAllData filtered by the cm_rcpa column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTempPrescriberAllData requireOneByCmRxberCat(string $cm_rxber_cat) Return the first ChildTempPrescriberAllData filtered by the cm_rxber_cat column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTempPrescriberAllData requireOneByComputeDate(string $compute_date) Return the first ChildTempPrescriberAllData filtered by the compute_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTempPrescriberAllData[]|Collection find(?ConnectionInterface $con = null) Return ChildTempPrescriberAllData objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildTempPrescriberAllData> find(?ConnectionInterface $con = null) Return ChildTempPrescriberAllData objects based on current ModelCriteria
 *
 * @method     ChildTempPrescriberAllData[]|Collection findByOrgunit(string|array<string> $orgunit) Return ChildTempPrescriberAllData objects filtered by the orgunit column
 * @psalm-method Collection&\Traversable<ChildTempPrescriberAllData> findByOrgunit(string|array<string> $orgunit) Return ChildTempPrescriberAllData objects filtered by the orgunit column
 * @method     ChildTempPrescriberAllData[]|Collection findByDoctorcode(string|array<string> $doctorcode) Return ChildTempPrescriberAllData objects filtered by the doctorcode column
 * @psalm-method Collection&\Traversable<ChildTempPrescriberAllData> findByDoctorcode(string|array<string> $doctorcode) Return ChildTempPrescriberAllData objects filtered by the doctorcode column
 * @method     ChildTempPrescriberAllData[]|Collection findByBrandid(int|array<int> $brandid) Return ChildTempPrescriberAllData objects filtered by the brandid column
 * @psalm-method Collection&\Traversable<ChildTempPrescriberAllData> findByBrandid(int|array<int> $brandid) Return ChildTempPrescriberAllData objects filtered by the brandid column
 * @method     ChildTempPrescriberAllData[]|Collection findByCutoff(int|array<int> $cutoff) Return ChildTempPrescriberAllData objects filtered by the cutoff column
 * @psalm-method Collection&\Traversable<ChildTempPrescriberAllData> findByCutoff(int|array<int> $cutoff) Return ChildTempPrescriberAllData objects filtered by the cutoff column
 * @method     ChildTempPrescriberAllData[]|Collection findByMonYear(string|array<string> $mon_year) Return ChildTempPrescriberAllData objects filtered by the mon_year column
 * @psalm-method Collection&\Traversable<ChildTempPrescriberAllData> findByMonYear(string|array<string> $mon_year) Return ChildTempPrescriberAllData objects filtered by the mon_year column
 * @method     ChildTempPrescriberAllData[]|Collection findByLmRcpaValue(double|array<double> $lm_rcpa_value) Return ChildTempPrescriberAllData objects filtered by the lm_rcpa_value column
 * @psalm-method Collection&\Traversable<ChildTempPrescriberAllData> findByLmRcpaValue(double|array<double> $lm_rcpa_value) Return ChildTempPrescriberAllData objects filtered by the lm_rcpa_value column
 * @method     ChildTempPrescriberAllData[]|Collection findByCmRcpaValue(double|array<double> $cm_rcpa_value) Return ChildTempPrescriberAllData objects filtered by the cm_rcpa_value column
 * @psalm-method Collection&\Traversable<ChildTempPrescriberAllData> findByCmRcpaValue(double|array<double> $cm_rcpa_value) Return ChildTempPrescriberAllData objects filtered by the cm_rcpa_value column
 * @method     ChildTempPrescriberAllData[]|Collection findByLmVisit(string|array<string> $lm_visit) Return ChildTempPrescriberAllData objects filtered by the lm_visit column
 * @psalm-method Collection&\Traversable<ChildTempPrescriberAllData> findByLmVisit(string|array<string> $lm_visit) Return ChildTempPrescriberAllData objects filtered by the lm_visit column
 * @method     ChildTempPrescriberAllData[]|Collection findByCmVisit(string|array<string> $cm_visit) Return ChildTempPrescriberAllData objects filtered by the cm_visit column
 * @psalm-method Collection&\Traversable<ChildTempPrescriberAllData> findByCmVisit(string|array<string> $cm_visit) Return ChildTempPrescriberAllData objects filtered by the cm_visit column
 * @method     ChildTempPrescriberAllData[]|Collection findByLmRcpa(string|array<string> $lm_rcpa) Return ChildTempPrescriberAllData objects filtered by the lm_rcpa column
 * @psalm-method Collection&\Traversable<ChildTempPrescriberAllData> findByLmRcpa(string|array<string> $lm_rcpa) Return ChildTempPrescriberAllData objects filtered by the lm_rcpa column
 * @method     ChildTempPrescriberAllData[]|Collection findByCmRcpa(string|array<string> $cm_rcpa) Return ChildTempPrescriberAllData objects filtered by the cm_rcpa column
 * @psalm-method Collection&\Traversable<ChildTempPrescriberAllData> findByCmRcpa(string|array<string> $cm_rcpa) Return ChildTempPrescriberAllData objects filtered by the cm_rcpa column
 * @method     ChildTempPrescriberAllData[]|Collection findByCmRxberCat(string|array<string> $cm_rxber_cat) Return ChildTempPrescriberAllData objects filtered by the cm_rxber_cat column
 * @psalm-method Collection&\Traversable<ChildTempPrescriberAllData> findByCmRxberCat(string|array<string> $cm_rxber_cat) Return ChildTempPrescriberAllData objects filtered by the cm_rxber_cat column
 * @method     ChildTempPrescriberAllData[]|Collection findByComputeDate(string|array<string> $compute_date) Return ChildTempPrescriberAllData objects filtered by the compute_date column
 * @psalm-method Collection&\Traversable<ChildTempPrescriberAllData> findByComputeDate(string|array<string> $compute_date) Return ChildTempPrescriberAllData objects filtered by the compute_date column
 *
 * @method     ChildTempPrescriberAllData[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildTempPrescriberAllData> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class TempPrescriberAllDataQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\TempPrescriberAllDataQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\TempPrescriberAllData', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildTempPrescriberAllDataQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildTempPrescriberAllDataQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildTempPrescriberAllDataQuery) {
            return $criteria;
        }
        $query = new ChildTempPrescriberAllDataQuery();
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
     * @return ChildTempPrescriberAllData|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        throw new LogicException('The TempPrescriberAllData object has no primary key');
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
        throw new LogicException('The TempPrescriberAllData object has no primary key');
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
        throw new LogicException('The TempPrescriberAllData object has no primary key');
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
        throw new LogicException('The TempPrescriberAllData object has no primary key');
    }

    /**
     * Filter the query on the orgunit column
     *
     * Example usage:
     * <code>
     * $query->filterByOrgunit('fooValue');   // WHERE orgunit = 'fooValue'
     * $query->filterByOrgunit('%fooValue%', Criteria::LIKE); // WHERE orgunit LIKE '%fooValue%'
     * $query->filterByOrgunit(['foo', 'bar']); // WHERE orgunit IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $orgunit The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrgunit($orgunit = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($orgunit)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TempPrescriberAllDataTableMap::COL_ORGUNIT, $orgunit, $comparison);

        return $this;
    }

    /**
     * Filter the query on the doctorcode column
     *
     * Example usage:
     * <code>
     * $query->filterByDoctorcode('fooValue');   // WHERE doctorcode = 'fooValue'
     * $query->filterByDoctorcode('%fooValue%', Criteria::LIKE); // WHERE doctorcode LIKE '%fooValue%'
     * $query->filterByDoctorcode(['foo', 'bar']); // WHERE doctorcode IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $doctorcode The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDoctorcode($doctorcode = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($doctorcode)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TempPrescriberAllDataTableMap::COL_DOCTORCODE, $doctorcode, $comparison);

        return $this;
    }

    /**
     * Filter the query on the brandid column
     *
     * Example usage:
     * <code>
     * $query->filterByBrandid(1234); // WHERE brandid = 1234
     * $query->filterByBrandid(array(12, 34)); // WHERE brandid IN (12, 34)
     * $query->filterByBrandid(array('min' => 12)); // WHERE brandid > 12
     * </code>
     *
     * @param mixed $brandid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBrandid($brandid = null, ?string $comparison = null)
    {
        if (is_array($brandid)) {
            $useMinMax = false;
            if (isset($brandid['min'])) {
                $this->addUsingAlias(TempPrescriberAllDataTableMap::COL_BRANDID, $brandid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($brandid['max'])) {
                $this->addUsingAlias(TempPrescriberAllDataTableMap::COL_BRANDID, $brandid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TempPrescriberAllDataTableMap::COL_BRANDID, $brandid, $comparison);

        return $this;
    }

    /**
     * Filter the query on the cutoff column
     *
     * Example usage:
     * <code>
     * $query->filterByCutoff(1234); // WHERE cutoff = 1234
     * $query->filterByCutoff(array(12, 34)); // WHERE cutoff IN (12, 34)
     * $query->filterByCutoff(array('min' => 12)); // WHERE cutoff > 12
     * </code>
     *
     * @param mixed $cutoff The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCutoff($cutoff = null, ?string $comparison = null)
    {
        if (is_array($cutoff)) {
            $useMinMax = false;
            if (isset($cutoff['min'])) {
                $this->addUsingAlias(TempPrescriberAllDataTableMap::COL_CUTOFF, $cutoff['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($cutoff['max'])) {
                $this->addUsingAlias(TempPrescriberAllDataTableMap::COL_CUTOFF, $cutoff['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TempPrescriberAllDataTableMap::COL_CUTOFF, $cutoff, $comparison);

        return $this;
    }

    /**
     * Filter the query on the mon_year column
     *
     * Example usage:
     * <code>
     * $query->filterByMonYear('fooValue');   // WHERE mon_year = 'fooValue'
     * $query->filterByMonYear('%fooValue%', Criteria::LIKE); // WHERE mon_year LIKE '%fooValue%'
     * $query->filterByMonYear(['foo', 'bar']); // WHERE mon_year IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $monYear The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMonYear($monYear = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($monYear)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TempPrescriberAllDataTableMap::COL_MON_YEAR, $monYear, $comparison);

        return $this;
    }

    /**
     * Filter the query on the lm_rcpa_value column
     *
     * Example usage:
     * <code>
     * $query->filterByLmRcpaValue(1234); // WHERE lm_rcpa_value = 1234
     * $query->filterByLmRcpaValue(array(12, 34)); // WHERE lm_rcpa_value IN (12, 34)
     * $query->filterByLmRcpaValue(array('min' => 12)); // WHERE lm_rcpa_value > 12
     * </code>
     *
     * @param mixed $lmRcpaValue The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLmRcpaValue($lmRcpaValue = null, ?string $comparison = null)
    {
        if (is_array($lmRcpaValue)) {
            $useMinMax = false;
            if (isset($lmRcpaValue['min'])) {
                $this->addUsingAlias(TempPrescriberAllDataTableMap::COL_LM_RCPA_VALUE, $lmRcpaValue['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lmRcpaValue['max'])) {
                $this->addUsingAlias(TempPrescriberAllDataTableMap::COL_LM_RCPA_VALUE, $lmRcpaValue['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TempPrescriberAllDataTableMap::COL_LM_RCPA_VALUE, $lmRcpaValue, $comparison);

        return $this;
    }

    /**
     * Filter the query on the cm_rcpa_value column
     *
     * Example usage:
     * <code>
     * $query->filterByCmRcpaValue(1234); // WHERE cm_rcpa_value = 1234
     * $query->filterByCmRcpaValue(array(12, 34)); // WHERE cm_rcpa_value IN (12, 34)
     * $query->filterByCmRcpaValue(array('min' => 12)); // WHERE cm_rcpa_value > 12
     * </code>
     *
     * @param mixed $cmRcpaValue The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCmRcpaValue($cmRcpaValue = null, ?string $comparison = null)
    {
        if (is_array($cmRcpaValue)) {
            $useMinMax = false;
            if (isset($cmRcpaValue['min'])) {
                $this->addUsingAlias(TempPrescriberAllDataTableMap::COL_CM_RCPA_VALUE, $cmRcpaValue['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($cmRcpaValue['max'])) {
                $this->addUsingAlias(TempPrescriberAllDataTableMap::COL_CM_RCPA_VALUE, $cmRcpaValue['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TempPrescriberAllDataTableMap::COL_CM_RCPA_VALUE, $cmRcpaValue, $comparison);

        return $this;
    }

    /**
     * Filter the query on the lm_visit column
     *
     * Example usage:
     * <code>
     * $query->filterByLmVisit('fooValue');   // WHERE lm_visit = 'fooValue'
     * $query->filterByLmVisit('%fooValue%', Criteria::LIKE); // WHERE lm_visit LIKE '%fooValue%'
     * $query->filterByLmVisit(['foo', 'bar']); // WHERE lm_visit IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $lmVisit The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLmVisit($lmVisit = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($lmVisit)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TempPrescriberAllDataTableMap::COL_LM_VISIT, $lmVisit, $comparison);

        return $this;
    }

    /**
     * Filter the query on the cm_visit column
     *
     * Example usage:
     * <code>
     * $query->filterByCmVisit('fooValue');   // WHERE cm_visit = 'fooValue'
     * $query->filterByCmVisit('%fooValue%', Criteria::LIKE); // WHERE cm_visit LIKE '%fooValue%'
     * $query->filterByCmVisit(['foo', 'bar']); // WHERE cm_visit IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $cmVisit The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCmVisit($cmVisit = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cmVisit)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TempPrescriberAllDataTableMap::COL_CM_VISIT, $cmVisit, $comparison);

        return $this;
    }

    /**
     * Filter the query on the lm_rcpa column
     *
     * Example usage:
     * <code>
     * $query->filterByLmRcpa('fooValue');   // WHERE lm_rcpa = 'fooValue'
     * $query->filterByLmRcpa('%fooValue%', Criteria::LIKE); // WHERE lm_rcpa LIKE '%fooValue%'
     * $query->filterByLmRcpa(['foo', 'bar']); // WHERE lm_rcpa IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $lmRcpa The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLmRcpa($lmRcpa = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($lmRcpa)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TempPrescriberAllDataTableMap::COL_LM_RCPA, $lmRcpa, $comparison);

        return $this;
    }

    /**
     * Filter the query on the cm_rcpa column
     *
     * Example usage:
     * <code>
     * $query->filterByCmRcpa('fooValue');   // WHERE cm_rcpa = 'fooValue'
     * $query->filterByCmRcpa('%fooValue%', Criteria::LIKE); // WHERE cm_rcpa LIKE '%fooValue%'
     * $query->filterByCmRcpa(['foo', 'bar']); // WHERE cm_rcpa IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $cmRcpa The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCmRcpa($cmRcpa = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cmRcpa)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TempPrescriberAllDataTableMap::COL_CM_RCPA, $cmRcpa, $comparison);

        return $this;
    }

    /**
     * Filter the query on the cm_rxber_cat column
     *
     * Example usage:
     * <code>
     * $query->filterByCmRxberCat('fooValue');   // WHERE cm_rxber_cat = 'fooValue'
     * $query->filterByCmRxberCat('%fooValue%', Criteria::LIKE); // WHERE cm_rxber_cat LIKE '%fooValue%'
     * $query->filterByCmRxberCat(['foo', 'bar']); // WHERE cm_rxber_cat IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $cmRxberCat The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCmRxberCat($cmRxberCat = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cmRxberCat)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TempPrescriberAllDataTableMap::COL_CM_RXBER_CAT, $cmRxberCat, $comparison);

        return $this;
    }

    /**
     * Filter the query on the compute_date column
     *
     * Example usage:
     * <code>
     * $query->filterByComputeDate('2011-03-14'); // WHERE compute_date = '2011-03-14'
     * $query->filterByComputeDate('now'); // WHERE compute_date = '2011-03-14'
     * $query->filterByComputeDate(array('max' => 'yesterday')); // WHERE compute_date > '2011-03-13'
     * </code>
     *
     * @param mixed $computeDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByComputeDate($computeDate = null, ?string $comparison = null)
    {
        if (is_array($computeDate)) {
            $useMinMax = false;
            if (isset($computeDate['min'])) {
                $this->addUsingAlias(TempPrescriberAllDataTableMap::COL_COMPUTE_DATE, $computeDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($computeDate['max'])) {
                $this->addUsingAlias(TempPrescriberAllDataTableMap::COL_COMPUTE_DATE, $computeDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TempPrescriberAllDataTableMap::COL_COMPUTE_DATE, $computeDate, $comparison);

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildTempPrescriberAllData $tempPrescriberAllData Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($tempPrescriberAllData = null)
    {
        if ($tempPrescriberAllData) {
            throw new LogicException('TempPrescriberAllData object has no primary key');

        }

        return $this;
    }

    /**
     * Deletes all rows from the temp_prescriber_all_data table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(TempPrescriberAllDataTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            TempPrescriberAllDataTableMap::clearInstancePool();
            TempPrescriberAllDataTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(TempPrescriberAllDataTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(TempPrescriberAllDataTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            TempPrescriberAllDataTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            TempPrescriberAllDataTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
