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
use entities\EdStatsBackup as ChildEdStatsBackup;
use entities\EdStatsBackupQuery as ChildEdStatsBackupQuery;
use entities\Map\EdStatsBackupTableMap;

/**
 * Base class that represents a query for the `ed_stats_backup` table.
 *
 * @method     ChildEdStatsBackupQuery orderByEdStatsId($order = Criteria::ASC) Order by the ed_stats_id column
 * @method     ChildEdStatsBackupQuery orderByOutletOrgId($order = Criteria::ASC) Order by the outlet_org_id column
 * @method     ChildEdStatsBackupQuery orderByBrandId($order = Criteria::ASC) Order by the brand_id column
 * @method     ChildEdStatsBackupQuery orderBySessionId($order = Criteria::ASC) Order by the session_id column
 * @method     ChildEdStatsBackupQuery orderByEdOrder($order = Criteria::ASC) Order by the ed_order column
 * @method     ChildEdStatsBackupQuery orderByDeviceStartTime($order = Criteria::ASC) Order by the device_start_time column
 * @method     ChildEdStatsBackupQuery orderByDeviceEndTime($order = Criteria::ASC) Order by the device_end_time column
 * @method     ChildEdStatsBackupQuery orderByDuration($order = Criteria::ASC) Order by the duration column
 * @method     ChildEdStatsBackupQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildEdStatsBackupQuery orderByOrgunitid($order = Criteria::ASC) Order by the orgunitid column
 * @method     ChildEdStatsBackupQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildEdStatsBackupQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildEdStatsBackupQuery orderByEmployeeId($order = Criteria::ASC) Order by the employee_id column
 * @method     ChildEdStatsBackupQuery orderByPositionId($order = Criteria::ASC) Order by the position_id column
 * @method     ChildEdStatsBackupQuery orderByPresentationId($order = Criteria::ASC) Order by the presentation_id column
 * @method     ChildEdStatsBackupQuery orderByPlaylistId($order = Criteria::ASC) Order by the playlist_id column
 * @method     ChildEdStatsBackupQuery orderByEdDate($order = Criteria::ASC) Order by the ed_date column
 * @method     ChildEdStatsBackupQuery orderByPresentationName($order = Criteria::ASC) Order by the presentation_name column
 *
 * @method     ChildEdStatsBackupQuery groupByEdStatsId() Group by the ed_stats_id column
 * @method     ChildEdStatsBackupQuery groupByOutletOrgId() Group by the outlet_org_id column
 * @method     ChildEdStatsBackupQuery groupByBrandId() Group by the brand_id column
 * @method     ChildEdStatsBackupQuery groupBySessionId() Group by the session_id column
 * @method     ChildEdStatsBackupQuery groupByEdOrder() Group by the ed_order column
 * @method     ChildEdStatsBackupQuery groupByDeviceStartTime() Group by the device_start_time column
 * @method     ChildEdStatsBackupQuery groupByDeviceEndTime() Group by the device_end_time column
 * @method     ChildEdStatsBackupQuery groupByDuration() Group by the duration column
 * @method     ChildEdStatsBackupQuery groupByCompanyId() Group by the company_id column
 * @method     ChildEdStatsBackupQuery groupByOrgunitid() Group by the orgunitid column
 * @method     ChildEdStatsBackupQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildEdStatsBackupQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildEdStatsBackupQuery groupByEmployeeId() Group by the employee_id column
 * @method     ChildEdStatsBackupQuery groupByPositionId() Group by the position_id column
 * @method     ChildEdStatsBackupQuery groupByPresentationId() Group by the presentation_id column
 * @method     ChildEdStatsBackupQuery groupByPlaylistId() Group by the playlist_id column
 * @method     ChildEdStatsBackupQuery groupByEdDate() Group by the ed_date column
 * @method     ChildEdStatsBackupQuery groupByPresentationName() Group by the presentation_name column
 *
 * @method     ChildEdStatsBackupQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildEdStatsBackupQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildEdStatsBackupQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildEdStatsBackupQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildEdStatsBackupQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildEdStatsBackupQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildEdStatsBackup|null findOne(?ConnectionInterface $con = null) Return the first ChildEdStatsBackup matching the query
 * @method     ChildEdStatsBackup findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildEdStatsBackup matching the query, or a new ChildEdStatsBackup object populated from the query conditions when no match is found
 *
 * @method     ChildEdStatsBackup|null findOneByEdStatsId(int $ed_stats_id) Return the first ChildEdStatsBackup filtered by the ed_stats_id column
 * @method     ChildEdStatsBackup|null findOneByOutletOrgId(int $outlet_org_id) Return the first ChildEdStatsBackup filtered by the outlet_org_id column
 * @method     ChildEdStatsBackup|null findOneByBrandId(int $brand_id) Return the first ChildEdStatsBackup filtered by the brand_id column
 * @method     ChildEdStatsBackup|null findOneBySessionId(string $session_id) Return the first ChildEdStatsBackup filtered by the session_id column
 * @method     ChildEdStatsBackup|null findOneByEdOrder(int $ed_order) Return the first ChildEdStatsBackup filtered by the ed_order column
 * @method     ChildEdStatsBackup|null findOneByDeviceStartTime(string $device_start_time) Return the first ChildEdStatsBackup filtered by the device_start_time column
 * @method     ChildEdStatsBackup|null findOneByDeviceEndTime(string $device_end_time) Return the first ChildEdStatsBackup filtered by the device_end_time column
 * @method     ChildEdStatsBackup|null findOneByDuration(int $duration) Return the first ChildEdStatsBackup filtered by the duration column
 * @method     ChildEdStatsBackup|null findOneByCompanyId(int $company_id) Return the first ChildEdStatsBackup filtered by the company_id column
 * @method     ChildEdStatsBackup|null findOneByOrgunitid(int $orgunitid) Return the first ChildEdStatsBackup filtered by the orgunitid column
 * @method     ChildEdStatsBackup|null findOneByCreatedAt(string $created_at) Return the first ChildEdStatsBackup filtered by the created_at column
 * @method     ChildEdStatsBackup|null findOneByUpdatedAt(string $updated_at) Return the first ChildEdStatsBackup filtered by the updated_at column
 * @method     ChildEdStatsBackup|null findOneByEmployeeId(int $employee_id) Return the first ChildEdStatsBackup filtered by the employee_id column
 * @method     ChildEdStatsBackup|null findOneByPositionId(int $position_id) Return the first ChildEdStatsBackup filtered by the position_id column
 * @method     ChildEdStatsBackup|null findOneByPresentationId(int $presentation_id) Return the first ChildEdStatsBackup filtered by the presentation_id column
 * @method     ChildEdStatsBackup|null findOneByPlaylistId(int $playlist_id) Return the first ChildEdStatsBackup filtered by the playlist_id column
 * @method     ChildEdStatsBackup|null findOneByEdDate(string $ed_date) Return the first ChildEdStatsBackup filtered by the ed_date column
 * @method     ChildEdStatsBackup|null findOneByPresentationName(string $presentation_name) Return the first ChildEdStatsBackup filtered by the presentation_name column
 *
 * @method     ChildEdStatsBackup requirePk($key, ?ConnectionInterface $con = null) Return the ChildEdStatsBackup by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEdStatsBackup requireOne(?ConnectionInterface $con = null) Return the first ChildEdStatsBackup matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEdStatsBackup requireOneByEdStatsId(int $ed_stats_id) Return the first ChildEdStatsBackup filtered by the ed_stats_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEdStatsBackup requireOneByOutletOrgId(int $outlet_org_id) Return the first ChildEdStatsBackup filtered by the outlet_org_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEdStatsBackup requireOneByBrandId(int $brand_id) Return the first ChildEdStatsBackup filtered by the brand_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEdStatsBackup requireOneBySessionId(string $session_id) Return the first ChildEdStatsBackup filtered by the session_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEdStatsBackup requireOneByEdOrder(int $ed_order) Return the first ChildEdStatsBackup filtered by the ed_order column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEdStatsBackup requireOneByDeviceStartTime(string $device_start_time) Return the first ChildEdStatsBackup filtered by the device_start_time column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEdStatsBackup requireOneByDeviceEndTime(string $device_end_time) Return the first ChildEdStatsBackup filtered by the device_end_time column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEdStatsBackup requireOneByDuration(int $duration) Return the first ChildEdStatsBackup filtered by the duration column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEdStatsBackup requireOneByCompanyId(int $company_id) Return the first ChildEdStatsBackup filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEdStatsBackup requireOneByOrgunitid(int $orgunitid) Return the first ChildEdStatsBackup filtered by the orgunitid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEdStatsBackup requireOneByCreatedAt(string $created_at) Return the first ChildEdStatsBackup filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEdStatsBackup requireOneByUpdatedAt(string $updated_at) Return the first ChildEdStatsBackup filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEdStatsBackup requireOneByEmployeeId(int $employee_id) Return the first ChildEdStatsBackup filtered by the employee_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEdStatsBackup requireOneByPositionId(int $position_id) Return the first ChildEdStatsBackup filtered by the position_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEdStatsBackup requireOneByPresentationId(int $presentation_id) Return the first ChildEdStatsBackup filtered by the presentation_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEdStatsBackup requireOneByPlaylistId(int $playlist_id) Return the first ChildEdStatsBackup filtered by the playlist_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEdStatsBackup requireOneByEdDate(string $ed_date) Return the first ChildEdStatsBackup filtered by the ed_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEdStatsBackup requireOneByPresentationName(string $presentation_name) Return the first ChildEdStatsBackup filtered by the presentation_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEdStatsBackup[]|Collection find(?ConnectionInterface $con = null) Return ChildEdStatsBackup objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildEdStatsBackup> find(?ConnectionInterface $con = null) Return ChildEdStatsBackup objects based on current ModelCriteria
 *
 * @method     ChildEdStatsBackup[]|Collection findByEdStatsId(int|array<int> $ed_stats_id) Return ChildEdStatsBackup objects filtered by the ed_stats_id column
 * @psalm-method Collection&\Traversable<ChildEdStatsBackup> findByEdStatsId(int|array<int> $ed_stats_id) Return ChildEdStatsBackup objects filtered by the ed_stats_id column
 * @method     ChildEdStatsBackup[]|Collection findByOutletOrgId(int|array<int> $outlet_org_id) Return ChildEdStatsBackup objects filtered by the outlet_org_id column
 * @psalm-method Collection&\Traversable<ChildEdStatsBackup> findByOutletOrgId(int|array<int> $outlet_org_id) Return ChildEdStatsBackup objects filtered by the outlet_org_id column
 * @method     ChildEdStatsBackup[]|Collection findByBrandId(int|array<int> $brand_id) Return ChildEdStatsBackup objects filtered by the brand_id column
 * @psalm-method Collection&\Traversable<ChildEdStatsBackup> findByBrandId(int|array<int> $brand_id) Return ChildEdStatsBackup objects filtered by the brand_id column
 * @method     ChildEdStatsBackup[]|Collection findBySessionId(string|array<string> $session_id) Return ChildEdStatsBackup objects filtered by the session_id column
 * @psalm-method Collection&\Traversable<ChildEdStatsBackup> findBySessionId(string|array<string> $session_id) Return ChildEdStatsBackup objects filtered by the session_id column
 * @method     ChildEdStatsBackup[]|Collection findByEdOrder(int|array<int> $ed_order) Return ChildEdStatsBackup objects filtered by the ed_order column
 * @psalm-method Collection&\Traversable<ChildEdStatsBackup> findByEdOrder(int|array<int> $ed_order) Return ChildEdStatsBackup objects filtered by the ed_order column
 * @method     ChildEdStatsBackup[]|Collection findByDeviceStartTime(string|array<string> $device_start_time) Return ChildEdStatsBackup objects filtered by the device_start_time column
 * @psalm-method Collection&\Traversable<ChildEdStatsBackup> findByDeviceStartTime(string|array<string> $device_start_time) Return ChildEdStatsBackup objects filtered by the device_start_time column
 * @method     ChildEdStatsBackup[]|Collection findByDeviceEndTime(string|array<string> $device_end_time) Return ChildEdStatsBackup objects filtered by the device_end_time column
 * @psalm-method Collection&\Traversable<ChildEdStatsBackup> findByDeviceEndTime(string|array<string> $device_end_time) Return ChildEdStatsBackup objects filtered by the device_end_time column
 * @method     ChildEdStatsBackup[]|Collection findByDuration(int|array<int> $duration) Return ChildEdStatsBackup objects filtered by the duration column
 * @psalm-method Collection&\Traversable<ChildEdStatsBackup> findByDuration(int|array<int> $duration) Return ChildEdStatsBackup objects filtered by the duration column
 * @method     ChildEdStatsBackup[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildEdStatsBackup objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildEdStatsBackup> findByCompanyId(int|array<int> $company_id) Return ChildEdStatsBackup objects filtered by the company_id column
 * @method     ChildEdStatsBackup[]|Collection findByOrgunitid(int|array<int> $orgunitid) Return ChildEdStatsBackup objects filtered by the orgunitid column
 * @psalm-method Collection&\Traversable<ChildEdStatsBackup> findByOrgunitid(int|array<int> $orgunitid) Return ChildEdStatsBackup objects filtered by the orgunitid column
 * @method     ChildEdStatsBackup[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildEdStatsBackup objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildEdStatsBackup> findByCreatedAt(string|array<string> $created_at) Return ChildEdStatsBackup objects filtered by the created_at column
 * @method     ChildEdStatsBackup[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildEdStatsBackup objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildEdStatsBackup> findByUpdatedAt(string|array<string> $updated_at) Return ChildEdStatsBackup objects filtered by the updated_at column
 * @method     ChildEdStatsBackup[]|Collection findByEmployeeId(int|array<int> $employee_id) Return ChildEdStatsBackup objects filtered by the employee_id column
 * @psalm-method Collection&\Traversable<ChildEdStatsBackup> findByEmployeeId(int|array<int> $employee_id) Return ChildEdStatsBackup objects filtered by the employee_id column
 * @method     ChildEdStatsBackup[]|Collection findByPositionId(int|array<int> $position_id) Return ChildEdStatsBackup objects filtered by the position_id column
 * @psalm-method Collection&\Traversable<ChildEdStatsBackup> findByPositionId(int|array<int> $position_id) Return ChildEdStatsBackup objects filtered by the position_id column
 * @method     ChildEdStatsBackup[]|Collection findByPresentationId(int|array<int> $presentation_id) Return ChildEdStatsBackup objects filtered by the presentation_id column
 * @psalm-method Collection&\Traversable<ChildEdStatsBackup> findByPresentationId(int|array<int> $presentation_id) Return ChildEdStatsBackup objects filtered by the presentation_id column
 * @method     ChildEdStatsBackup[]|Collection findByPlaylistId(int|array<int> $playlist_id) Return ChildEdStatsBackup objects filtered by the playlist_id column
 * @psalm-method Collection&\Traversable<ChildEdStatsBackup> findByPlaylistId(int|array<int> $playlist_id) Return ChildEdStatsBackup objects filtered by the playlist_id column
 * @method     ChildEdStatsBackup[]|Collection findByEdDate(string|array<string> $ed_date) Return ChildEdStatsBackup objects filtered by the ed_date column
 * @psalm-method Collection&\Traversable<ChildEdStatsBackup> findByEdDate(string|array<string> $ed_date) Return ChildEdStatsBackup objects filtered by the ed_date column
 * @method     ChildEdStatsBackup[]|Collection findByPresentationName(string|array<string> $presentation_name) Return ChildEdStatsBackup objects filtered by the presentation_name column
 * @psalm-method Collection&\Traversable<ChildEdStatsBackup> findByPresentationName(string|array<string> $presentation_name) Return ChildEdStatsBackup objects filtered by the presentation_name column
 *
 * @method     ChildEdStatsBackup[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildEdStatsBackup> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class EdStatsBackupQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\EdStatsBackupQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\EdStatsBackup', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildEdStatsBackupQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildEdStatsBackupQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildEdStatsBackupQuery) {
            return $criteria;
        }
        $query = new ChildEdStatsBackupQuery();
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
     * @return ChildEdStatsBackup|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        throw new LogicException('The EdStatsBackup object has no primary key');
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
        throw new LogicException('The EdStatsBackup object has no primary key');
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
        throw new LogicException('The EdStatsBackup object has no primary key');
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
        throw new LogicException('The EdStatsBackup object has no primary key');
    }

    /**
     * Filter the query on the ed_stats_id column
     *
     * Example usage:
     * <code>
     * $query->filterByEdStatsId(1234); // WHERE ed_stats_id = 1234
     * $query->filterByEdStatsId(array(12, 34)); // WHERE ed_stats_id IN (12, 34)
     * $query->filterByEdStatsId(array('min' => 12)); // WHERE ed_stats_id > 12
     * </code>
     *
     * @param mixed $edStatsId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEdStatsId($edStatsId = null, ?string $comparison = null)
    {
        if (is_array($edStatsId)) {
            $useMinMax = false;
            if (isset($edStatsId['min'])) {
                $this->addUsingAlias(EdStatsBackupTableMap::COL_ED_STATS_ID, $edStatsId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($edStatsId['max'])) {
                $this->addUsingAlias(EdStatsBackupTableMap::COL_ED_STATS_ID, $edStatsId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EdStatsBackupTableMap::COL_ED_STATS_ID, $edStatsId, $comparison);

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
                $this->addUsingAlias(EdStatsBackupTableMap::COL_OUTLET_ORG_ID, $outletOrgId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outletOrgId['max'])) {
                $this->addUsingAlias(EdStatsBackupTableMap::COL_OUTLET_ORG_ID, $outletOrgId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EdStatsBackupTableMap::COL_OUTLET_ORG_ID, $outletOrgId, $comparison);

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
                $this->addUsingAlias(EdStatsBackupTableMap::COL_BRAND_ID, $brandId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($brandId['max'])) {
                $this->addUsingAlias(EdStatsBackupTableMap::COL_BRAND_ID, $brandId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EdStatsBackupTableMap::COL_BRAND_ID, $brandId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the session_id column
     *
     * Example usage:
     * <code>
     * $query->filterBySessionId('fooValue');   // WHERE session_id = 'fooValue'
     * $query->filterBySessionId('%fooValue%', Criteria::LIKE); // WHERE session_id LIKE '%fooValue%'
     * $query->filterBySessionId(['foo', 'bar']); // WHERE session_id IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $sessionId The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySessionId($sessionId = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($sessionId)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EdStatsBackupTableMap::COL_SESSION_ID, $sessionId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the ed_order column
     *
     * Example usage:
     * <code>
     * $query->filterByEdOrder(1234); // WHERE ed_order = 1234
     * $query->filterByEdOrder(array(12, 34)); // WHERE ed_order IN (12, 34)
     * $query->filterByEdOrder(array('min' => 12)); // WHERE ed_order > 12
     * </code>
     *
     * @param mixed $edOrder The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEdOrder($edOrder = null, ?string $comparison = null)
    {
        if (is_array($edOrder)) {
            $useMinMax = false;
            if (isset($edOrder['min'])) {
                $this->addUsingAlias(EdStatsBackupTableMap::COL_ED_ORDER, $edOrder['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($edOrder['max'])) {
                $this->addUsingAlias(EdStatsBackupTableMap::COL_ED_ORDER, $edOrder['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EdStatsBackupTableMap::COL_ED_ORDER, $edOrder, $comparison);

        return $this;
    }

    /**
     * Filter the query on the device_start_time column
     *
     * Example usage:
     * <code>
     * $query->filterByDeviceStartTime('2011-03-14'); // WHERE device_start_time = '2011-03-14'
     * $query->filterByDeviceStartTime('now'); // WHERE device_start_time = '2011-03-14'
     * $query->filterByDeviceStartTime(array('max' => 'yesterday')); // WHERE device_start_time > '2011-03-13'
     * </code>
     *
     * @param mixed $deviceStartTime The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDeviceStartTime($deviceStartTime = null, ?string $comparison = null)
    {
        if (is_array($deviceStartTime)) {
            $useMinMax = false;
            if (isset($deviceStartTime['min'])) {
                $this->addUsingAlias(EdStatsBackupTableMap::COL_DEVICE_START_TIME, $deviceStartTime['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($deviceStartTime['max'])) {
                $this->addUsingAlias(EdStatsBackupTableMap::COL_DEVICE_START_TIME, $deviceStartTime['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EdStatsBackupTableMap::COL_DEVICE_START_TIME, $deviceStartTime, $comparison);

        return $this;
    }

    /**
     * Filter the query on the device_end_time column
     *
     * Example usage:
     * <code>
     * $query->filterByDeviceEndTime('2011-03-14'); // WHERE device_end_time = '2011-03-14'
     * $query->filterByDeviceEndTime('now'); // WHERE device_end_time = '2011-03-14'
     * $query->filterByDeviceEndTime(array('max' => 'yesterday')); // WHERE device_end_time > '2011-03-13'
     * </code>
     *
     * @param mixed $deviceEndTime The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDeviceEndTime($deviceEndTime = null, ?string $comparison = null)
    {
        if (is_array($deviceEndTime)) {
            $useMinMax = false;
            if (isset($deviceEndTime['min'])) {
                $this->addUsingAlias(EdStatsBackupTableMap::COL_DEVICE_END_TIME, $deviceEndTime['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($deviceEndTime['max'])) {
                $this->addUsingAlias(EdStatsBackupTableMap::COL_DEVICE_END_TIME, $deviceEndTime['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EdStatsBackupTableMap::COL_DEVICE_END_TIME, $deviceEndTime, $comparison);

        return $this;
    }

    /**
     * Filter the query on the duration column
     *
     * Example usage:
     * <code>
     * $query->filterByDuration(1234); // WHERE duration = 1234
     * $query->filterByDuration(array(12, 34)); // WHERE duration IN (12, 34)
     * $query->filterByDuration(array('min' => 12)); // WHERE duration > 12
     * </code>
     *
     * @param mixed $duration The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDuration($duration = null, ?string $comparison = null)
    {
        if (is_array($duration)) {
            $useMinMax = false;
            if (isset($duration['min'])) {
                $this->addUsingAlias(EdStatsBackupTableMap::COL_DURATION, $duration['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($duration['max'])) {
                $this->addUsingAlias(EdStatsBackupTableMap::COL_DURATION, $duration['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EdStatsBackupTableMap::COL_DURATION, $duration, $comparison);

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
                $this->addUsingAlias(EdStatsBackupTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(EdStatsBackupTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EdStatsBackupTableMap::COL_COMPANY_ID, $companyId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the orgunitid column
     *
     * Example usage:
     * <code>
     * $query->filterByOrgunitid(1234); // WHERE orgunitid = 1234
     * $query->filterByOrgunitid(array(12, 34)); // WHERE orgunitid IN (12, 34)
     * $query->filterByOrgunitid(array('min' => 12)); // WHERE orgunitid > 12
     * </code>
     *
     * @param mixed $orgunitid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrgunitid($orgunitid = null, ?string $comparison = null)
    {
        if (is_array($orgunitid)) {
            $useMinMax = false;
            if (isset($orgunitid['min'])) {
                $this->addUsingAlias(EdStatsBackupTableMap::COL_ORGUNITID, $orgunitid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($orgunitid['max'])) {
                $this->addUsingAlias(EdStatsBackupTableMap::COL_ORGUNITID, $orgunitid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EdStatsBackupTableMap::COL_ORGUNITID, $orgunitid, $comparison);

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
                $this->addUsingAlias(EdStatsBackupTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(EdStatsBackupTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EdStatsBackupTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(EdStatsBackupTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(EdStatsBackupTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EdStatsBackupTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

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
                $this->addUsingAlias(EdStatsBackupTableMap::COL_EMPLOYEE_ID, $employeeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($employeeId['max'])) {
                $this->addUsingAlias(EdStatsBackupTableMap::COL_EMPLOYEE_ID, $employeeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EdStatsBackupTableMap::COL_EMPLOYEE_ID, $employeeId, $comparison);

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
                $this->addUsingAlias(EdStatsBackupTableMap::COL_POSITION_ID, $positionId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($positionId['max'])) {
                $this->addUsingAlias(EdStatsBackupTableMap::COL_POSITION_ID, $positionId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EdStatsBackupTableMap::COL_POSITION_ID, $positionId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the presentation_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPresentationId(1234); // WHERE presentation_id = 1234
     * $query->filterByPresentationId(array(12, 34)); // WHERE presentation_id IN (12, 34)
     * $query->filterByPresentationId(array('min' => 12)); // WHERE presentation_id > 12
     * </code>
     *
     * @param mixed $presentationId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPresentationId($presentationId = null, ?string $comparison = null)
    {
        if (is_array($presentationId)) {
            $useMinMax = false;
            if (isset($presentationId['min'])) {
                $this->addUsingAlias(EdStatsBackupTableMap::COL_PRESENTATION_ID, $presentationId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($presentationId['max'])) {
                $this->addUsingAlias(EdStatsBackupTableMap::COL_PRESENTATION_ID, $presentationId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EdStatsBackupTableMap::COL_PRESENTATION_ID, $presentationId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the playlist_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPlaylistId(1234); // WHERE playlist_id = 1234
     * $query->filterByPlaylistId(array(12, 34)); // WHERE playlist_id IN (12, 34)
     * $query->filterByPlaylistId(array('min' => 12)); // WHERE playlist_id > 12
     * </code>
     *
     * @param mixed $playlistId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPlaylistId($playlistId = null, ?string $comparison = null)
    {
        if (is_array($playlistId)) {
            $useMinMax = false;
            if (isset($playlistId['min'])) {
                $this->addUsingAlias(EdStatsBackupTableMap::COL_PLAYLIST_ID, $playlistId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($playlistId['max'])) {
                $this->addUsingAlias(EdStatsBackupTableMap::COL_PLAYLIST_ID, $playlistId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EdStatsBackupTableMap::COL_PLAYLIST_ID, $playlistId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the ed_date column
     *
     * Example usage:
     * <code>
     * $query->filterByEdDate('2011-03-14'); // WHERE ed_date = '2011-03-14'
     * $query->filterByEdDate('now'); // WHERE ed_date = '2011-03-14'
     * $query->filterByEdDate(array('max' => 'yesterday')); // WHERE ed_date > '2011-03-13'
     * </code>
     *
     * @param mixed $edDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEdDate($edDate = null, ?string $comparison = null)
    {
        if (is_array($edDate)) {
            $useMinMax = false;
            if (isset($edDate['min'])) {
                $this->addUsingAlias(EdStatsBackupTableMap::COL_ED_DATE, $edDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($edDate['max'])) {
                $this->addUsingAlias(EdStatsBackupTableMap::COL_ED_DATE, $edDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EdStatsBackupTableMap::COL_ED_DATE, $edDate, $comparison);

        return $this;
    }

    /**
     * Filter the query on the presentation_name column
     *
     * Example usage:
     * <code>
     * $query->filterByPresentationName('fooValue');   // WHERE presentation_name = 'fooValue'
     * $query->filterByPresentationName('%fooValue%', Criteria::LIKE); // WHERE presentation_name LIKE '%fooValue%'
     * $query->filterByPresentationName(['foo', 'bar']); // WHERE presentation_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $presentationName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPresentationName($presentationName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($presentationName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EdStatsBackupTableMap::COL_PRESENTATION_NAME, $presentationName, $comparison);

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildEdStatsBackup $edStatsBackup Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($edStatsBackup = null)
    {
        if ($edStatsBackup) {
            throw new LogicException('EdStatsBackup object has no primary key');

        }

        return $this;
    }

    /**
     * Deletes all rows from the ed_stats_backup table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EdStatsBackupTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            EdStatsBackupTableMap::clearInstancePool();
            EdStatsBackupTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(EdStatsBackupTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(EdStatsBackupTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            EdStatsBackupTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            EdStatsBackupTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
