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
use entities\BeatOutlets as ChildBeatOutlets;
use entities\BeatOutletsQuery as ChildBeatOutletsQuery;
use entities\Map\BeatOutletsTableMap;

/**
 * Base class that represents a query for the `beat_outlets` table.
 *
 * @method     ChildBeatOutletsQuery orderByBeatOutletMapid($order = Criteria::ASC) Order by the beat_outlet_mapid column
 * @method     ChildBeatOutletsQuery orderByBeatId($order = Criteria::ASC) Order by the beat_id column
 * @method     ChildBeatOutletsQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildBeatOutletsQuery orderByBeatOrgOutlet($order = Criteria::ASC) Order by the beat_org_outlet column
 * @method     ChildBeatOutletsQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method     ChildBeatOutletsQuery orderByActiveDate($order = Criteria::ASC) Order by the active_date column
 * @method     ChildBeatOutletsQuery orderByInactiveDate($order = Criteria::ASC) Order by the inactive_date column
 * @method     ChildBeatOutletsQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildBeatOutletsQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildBeatOutletsQuery orderByReportEndDate($order = Criteria::ASC) Order by the report_end_date column
 *
 * @method     ChildBeatOutletsQuery groupByBeatOutletMapid() Group by the beat_outlet_mapid column
 * @method     ChildBeatOutletsQuery groupByBeatId() Group by the beat_id column
 * @method     ChildBeatOutletsQuery groupByCompanyId() Group by the company_id column
 * @method     ChildBeatOutletsQuery groupByBeatOrgOutlet() Group by the beat_org_outlet column
 * @method     ChildBeatOutletsQuery groupByStatus() Group by the status column
 * @method     ChildBeatOutletsQuery groupByActiveDate() Group by the active_date column
 * @method     ChildBeatOutletsQuery groupByInactiveDate() Group by the inactive_date column
 * @method     ChildBeatOutletsQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildBeatOutletsQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildBeatOutletsQuery groupByReportEndDate() Group by the report_end_date column
 *
 * @method     ChildBeatOutletsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildBeatOutletsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildBeatOutletsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildBeatOutletsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildBeatOutletsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildBeatOutletsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildBeatOutletsQuery leftJoinOutletOrgData($relationAlias = null) Adds a LEFT JOIN clause to the query using the OutletOrgData relation
 * @method     ChildBeatOutletsQuery rightJoinOutletOrgData($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OutletOrgData relation
 * @method     ChildBeatOutletsQuery innerJoinOutletOrgData($relationAlias = null) Adds a INNER JOIN clause to the query using the OutletOrgData relation
 *
 * @method     ChildBeatOutletsQuery joinWithOutletOrgData($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OutletOrgData relation
 *
 * @method     ChildBeatOutletsQuery leftJoinWithOutletOrgData() Adds a LEFT JOIN clause and with to the query using the OutletOrgData relation
 * @method     ChildBeatOutletsQuery rightJoinWithOutletOrgData() Adds a RIGHT JOIN clause and with to the query using the OutletOrgData relation
 * @method     ChildBeatOutletsQuery innerJoinWithOutletOrgData() Adds a INNER JOIN clause and with to the query using the OutletOrgData relation
 *
 * @method     ChildBeatOutletsQuery leftJoinBeats($relationAlias = null) Adds a LEFT JOIN clause to the query using the Beats relation
 * @method     ChildBeatOutletsQuery rightJoinBeats($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Beats relation
 * @method     ChildBeatOutletsQuery innerJoinBeats($relationAlias = null) Adds a INNER JOIN clause to the query using the Beats relation
 *
 * @method     ChildBeatOutletsQuery joinWithBeats($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Beats relation
 *
 * @method     ChildBeatOutletsQuery leftJoinWithBeats() Adds a LEFT JOIN clause and with to the query using the Beats relation
 * @method     ChildBeatOutletsQuery rightJoinWithBeats() Adds a RIGHT JOIN clause and with to the query using the Beats relation
 * @method     ChildBeatOutletsQuery innerJoinWithBeats() Adds a INNER JOIN clause and with to the query using the Beats relation
 *
 * @method     ChildBeatOutletsQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildBeatOutletsQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildBeatOutletsQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildBeatOutletsQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildBeatOutletsQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildBeatOutletsQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildBeatOutletsQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     \entities\OutletOrgDataQuery|\entities\BeatsQuery|\entities\CompanyQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildBeatOutlets|null findOne(?ConnectionInterface $con = null) Return the first ChildBeatOutlets matching the query
 * @method     ChildBeatOutlets findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildBeatOutlets matching the query, or a new ChildBeatOutlets object populated from the query conditions when no match is found
 *
 * @method     ChildBeatOutlets|null findOneByBeatOutletMapid(int $beat_outlet_mapid) Return the first ChildBeatOutlets filtered by the beat_outlet_mapid column
 * @method     ChildBeatOutlets|null findOneByBeatId(int $beat_id) Return the first ChildBeatOutlets filtered by the beat_id column
 * @method     ChildBeatOutlets|null findOneByCompanyId(int $company_id) Return the first ChildBeatOutlets filtered by the company_id column
 * @method     ChildBeatOutlets|null findOneByBeatOrgOutlet(string $beat_org_outlet) Return the first ChildBeatOutlets filtered by the beat_org_outlet column
 * @method     ChildBeatOutlets|null findOneByStatus(string $status) Return the first ChildBeatOutlets filtered by the status column
 * @method     ChildBeatOutlets|null findOneByActiveDate(string $active_date) Return the first ChildBeatOutlets filtered by the active_date column
 * @method     ChildBeatOutlets|null findOneByInactiveDate(string $inactive_date) Return the first ChildBeatOutlets filtered by the inactive_date column
 * @method     ChildBeatOutlets|null findOneByCreatedAt(string $created_at) Return the first ChildBeatOutlets filtered by the created_at column
 * @method     ChildBeatOutlets|null findOneByUpdatedAt(string $updated_at) Return the first ChildBeatOutlets filtered by the updated_at column
 * @method     ChildBeatOutlets|null findOneByReportEndDate(string $report_end_date) Return the first ChildBeatOutlets filtered by the report_end_date column
 *
 * @method     ChildBeatOutlets requirePk($key, ?ConnectionInterface $con = null) Return the ChildBeatOutlets by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBeatOutlets requireOne(?ConnectionInterface $con = null) Return the first ChildBeatOutlets matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBeatOutlets requireOneByBeatOutletMapid(int $beat_outlet_mapid) Return the first ChildBeatOutlets filtered by the beat_outlet_mapid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBeatOutlets requireOneByBeatId(int $beat_id) Return the first ChildBeatOutlets filtered by the beat_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBeatOutlets requireOneByCompanyId(int $company_id) Return the first ChildBeatOutlets filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBeatOutlets requireOneByBeatOrgOutlet(string $beat_org_outlet) Return the first ChildBeatOutlets filtered by the beat_org_outlet column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBeatOutlets requireOneByStatus(string $status) Return the first ChildBeatOutlets filtered by the status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBeatOutlets requireOneByActiveDate(string $active_date) Return the first ChildBeatOutlets filtered by the active_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBeatOutlets requireOneByInactiveDate(string $inactive_date) Return the first ChildBeatOutlets filtered by the inactive_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBeatOutlets requireOneByCreatedAt(string $created_at) Return the first ChildBeatOutlets filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBeatOutlets requireOneByUpdatedAt(string $updated_at) Return the first ChildBeatOutlets filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBeatOutlets requireOneByReportEndDate(string $report_end_date) Return the first ChildBeatOutlets filtered by the report_end_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBeatOutlets[]|Collection find(?ConnectionInterface $con = null) Return ChildBeatOutlets objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildBeatOutlets> find(?ConnectionInterface $con = null) Return ChildBeatOutlets objects based on current ModelCriteria
 *
 * @method     ChildBeatOutlets[]|Collection findByBeatOutletMapid(int|array<int> $beat_outlet_mapid) Return ChildBeatOutlets objects filtered by the beat_outlet_mapid column
 * @psalm-method Collection&\Traversable<ChildBeatOutlets> findByBeatOutletMapid(int|array<int> $beat_outlet_mapid) Return ChildBeatOutlets objects filtered by the beat_outlet_mapid column
 * @method     ChildBeatOutlets[]|Collection findByBeatId(int|array<int> $beat_id) Return ChildBeatOutlets objects filtered by the beat_id column
 * @psalm-method Collection&\Traversable<ChildBeatOutlets> findByBeatId(int|array<int> $beat_id) Return ChildBeatOutlets objects filtered by the beat_id column
 * @method     ChildBeatOutlets[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildBeatOutlets objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildBeatOutlets> findByCompanyId(int|array<int> $company_id) Return ChildBeatOutlets objects filtered by the company_id column
 * @method     ChildBeatOutlets[]|Collection findByBeatOrgOutlet(string|array<string> $beat_org_outlet) Return ChildBeatOutlets objects filtered by the beat_org_outlet column
 * @psalm-method Collection&\Traversable<ChildBeatOutlets> findByBeatOrgOutlet(string|array<string> $beat_org_outlet) Return ChildBeatOutlets objects filtered by the beat_org_outlet column
 * @method     ChildBeatOutlets[]|Collection findByStatus(string|array<string> $status) Return ChildBeatOutlets objects filtered by the status column
 * @psalm-method Collection&\Traversable<ChildBeatOutlets> findByStatus(string|array<string> $status) Return ChildBeatOutlets objects filtered by the status column
 * @method     ChildBeatOutlets[]|Collection findByActiveDate(string|array<string> $active_date) Return ChildBeatOutlets objects filtered by the active_date column
 * @psalm-method Collection&\Traversable<ChildBeatOutlets> findByActiveDate(string|array<string> $active_date) Return ChildBeatOutlets objects filtered by the active_date column
 * @method     ChildBeatOutlets[]|Collection findByInactiveDate(string|array<string> $inactive_date) Return ChildBeatOutlets objects filtered by the inactive_date column
 * @psalm-method Collection&\Traversable<ChildBeatOutlets> findByInactiveDate(string|array<string> $inactive_date) Return ChildBeatOutlets objects filtered by the inactive_date column
 * @method     ChildBeatOutlets[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildBeatOutlets objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildBeatOutlets> findByCreatedAt(string|array<string> $created_at) Return ChildBeatOutlets objects filtered by the created_at column
 * @method     ChildBeatOutlets[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildBeatOutlets objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildBeatOutlets> findByUpdatedAt(string|array<string> $updated_at) Return ChildBeatOutlets objects filtered by the updated_at column
 * @method     ChildBeatOutlets[]|Collection findByReportEndDate(string|array<string> $report_end_date) Return ChildBeatOutlets objects filtered by the report_end_date column
 * @psalm-method Collection&\Traversable<ChildBeatOutlets> findByReportEndDate(string|array<string> $report_end_date) Return ChildBeatOutlets objects filtered by the report_end_date column
 *
 * @method     ChildBeatOutlets[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildBeatOutlets> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class BeatOutletsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\BeatOutletsQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\BeatOutlets', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildBeatOutletsQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildBeatOutletsQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildBeatOutletsQuery) {
            return $criteria;
        }
        $query = new ChildBeatOutletsQuery();
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
     * @return ChildBeatOutlets|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(BeatOutletsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = BeatOutletsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildBeatOutlets A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT beat_outlet_mapid, beat_id, company_id, beat_org_outlet, status, active_date, inactive_date, created_at, updated_at, report_end_date FROM beat_outlets WHERE beat_outlet_mapid = :p0';
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
            /** @var ChildBeatOutlets $obj */
            $obj = new ChildBeatOutlets();
            $obj->hydrate($row);
            BeatOutletsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildBeatOutlets|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(BeatOutletsTableMap::COL_BEAT_OUTLET_MAPID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(BeatOutletsTableMap::COL_BEAT_OUTLET_MAPID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the beat_outlet_mapid column
     *
     * Example usage:
     * <code>
     * $query->filterByBeatOutletMapid(1234); // WHERE beat_outlet_mapid = 1234
     * $query->filterByBeatOutletMapid(array(12, 34)); // WHERE beat_outlet_mapid IN (12, 34)
     * $query->filterByBeatOutletMapid(array('min' => 12)); // WHERE beat_outlet_mapid > 12
     * </code>
     *
     * @param mixed $beatOutletMapid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBeatOutletMapid($beatOutletMapid = null, ?string $comparison = null)
    {
        if (is_array($beatOutletMapid)) {
            $useMinMax = false;
            if (isset($beatOutletMapid['min'])) {
                $this->addUsingAlias(BeatOutletsTableMap::COL_BEAT_OUTLET_MAPID, $beatOutletMapid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($beatOutletMapid['max'])) {
                $this->addUsingAlias(BeatOutletsTableMap::COL_BEAT_OUTLET_MAPID, $beatOutletMapid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BeatOutletsTableMap::COL_BEAT_OUTLET_MAPID, $beatOutletMapid, $comparison);

        return $this;
    }

    /**
     * Filter the query on the beat_id column
     *
     * Example usage:
     * <code>
     * $query->filterByBeatId(1234); // WHERE beat_id = 1234
     * $query->filterByBeatId(array(12, 34)); // WHERE beat_id IN (12, 34)
     * $query->filterByBeatId(array('min' => 12)); // WHERE beat_id > 12
     * </code>
     *
     * @see       filterByBeats()
     *
     * @param mixed $beatId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBeatId($beatId = null, ?string $comparison = null)
    {
        if (is_array($beatId)) {
            $useMinMax = false;
            if (isset($beatId['min'])) {
                $this->addUsingAlias(BeatOutletsTableMap::COL_BEAT_ID, $beatId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($beatId['max'])) {
                $this->addUsingAlias(BeatOutletsTableMap::COL_BEAT_ID, $beatId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BeatOutletsTableMap::COL_BEAT_ID, $beatId, $comparison);

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
                $this->addUsingAlias(BeatOutletsTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(BeatOutletsTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BeatOutletsTableMap::COL_COMPANY_ID, $companyId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the beat_org_outlet column
     *
     * Example usage:
     * <code>
     * $query->filterByBeatOrgOutlet(1234); // WHERE beat_org_outlet = 1234
     * $query->filterByBeatOrgOutlet(array(12, 34)); // WHERE beat_org_outlet IN (12, 34)
     * $query->filterByBeatOrgOutlet(array('min' => 12)); // WHERE beat_org_outlet > 12
     * </code>
     *
     * @see       filterByOutletOrgData()
     *
     * @param mixed $beatOrgOutlet The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBeatOrgOutlet($beatOrgOutlet = null, ?string $comparison = null)
    {
        if (is_array($beatOrgOutlet)) {
            $useMinMax = false;
            if (isset($beatOrgOutlet['min'])) {
                $this->addUsingAlias(BeatOutletsTableMap::COL_BEAT_ORG_OUTLET, $beatOrgOutlet['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($beatOrgOutlet['max'])) {
                $this->addUsingAlias(BeatOutletsTableMap::COL_BEAT_ORG_OUTLET, $beatOrgOutlet['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BeatOutletsTableMap::COL_BEAT_ORG_OUTLET, $beatOrgOutlet, $comparison);

        return $this;
    }

    /**
     * Filter the query on the status column
     *
     * Example usage:
     * <code>
     * $query->filterByStatus('fooValue');   // WHERE status = 'fooValue'
     * $query->filterByStatus('%fooValue%', Criteria::LIKE); // WHERE status LIKE '%fooValue%'
     * $query->filterByStatus(['foo', 'bar']); // WHERE status IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $status The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStatus($status = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($status)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BeatOutletsTableMap::COL_STATUS, $status, $comparison);

        return $this;
    }

    /**
     * Filter the query on the active_date column
     *
     * Example usage:
     * <code>
     * $query->filterByActiveDate('2011-03-14'); // WHERE active_date = '2011-03-14'
     * $query->filterByActiveDate('now'); // WHERE active_date = '2011-03-14'
     * $query->filterByActiveDate(array('max' => 'yesterday')); // WHERE active_date > '2011-03-13'
     * </code>
     *
     * @param mixed $activeDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByActiveDate($activeDate = null, ?string $comparison = null)
    {
        if (is_array($activeDate)) {
            $useMinMax = false;
            if (isset($activeDate['min'])) {
                $this->addUsingAlias(BeatOutletsTableMap::COL_ACTIVE_DATE, $activeDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($activeDate['max'])) {
                $this->addUsingAlias(BeatOutletsTableMap::COL_ACTIVE_DATE, $activeDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BeatOutletsTableMap::COL_ACTIVE_DATE, $activeDate, $comparison);

        return $this;
    }

    /**
     * Filter the query on the inactive_date column
     *
     * Example usage:
     * <code>
     * $query->filterByInactiveDate('2011-03-14'); // WHERE inactive_date = '2011-03-14'
     * $query->filterByInactiveDate('now'); // WHERE inactive_date = '2011-03-14'
     * $query->filterByInactiveDate(array('max' => 'yesterday')); // WHERE inactive_date > '2011-03-13'
     * </code>
     *
     * @param mixed $inactiveDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByInactiveDate($inactiveDate = null, ?string $comparison = null)
    {
        if (is_array($inactiveDate)) {
            $useMinMax = false;
            if (isset($inactiveDate['min'])) {
                $this->addUsingAlias(BeatOutletsTableMap::COL_INACTIVE_DATE, $inactiveDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($inactiveDate['max'])) {
                $this->addUsingAlias(BeatOutletsTableMap::COL_INACTIVE_DATE, $inactiveDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BeatOutletsTableMap::COL_INACTIVE_DATE, $inactiveDate, $comparison);

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
                $this->addUsingAlias(BeatOutletsTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(BeatOutletsTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BeatOutletsTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(BeatOutletsTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(BeatOutletsTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BeatOutletsTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the report_end_date column
     *
     * Example usage:
     * <code>
     * $query->filterByReportEndDate('2011-03-14'); // WHERE report_end_date = '2011-03-14'
     * $query->filterByReportEndDate('now'); // WHERE report_end_date = '2011-03-14'
     * $query->filterByReportEndDate(array('max' => 'yesterday')); // WHERE report_end_date > '2011-03-13'
     * </code>
     *
     * @param mixed $reportEndDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByReportEndDate($reportEndDate = null, ?string $comparison = null)
    {
        if (is_array($reportEndDate)) {
            $useMinMax = false;
            if (isset($reportEndDate['min'])) {
                $this->addUsingAlias(BeatOutletsTableMap::COL_REPORT_END_DATE, $reportEndDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($reportEndDate['max'])) {
                $this->addUsingAlias(BeatOutletsTableMap::COL_REPORT_END_DATE, $reportEndDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BeatOutletsTableMap::COL_REPORT_END_DATE, $reportEndDate, $comparison);

        return $this;
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
                ->addUsingAlias(BeatOutletsTableMap::COL_BEAT_ORG_OUTLET, $outletOrgData->getOutletOrgId(), $comparison);
        } elseif ($outletOrgData instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(BeatOutletsTableMap::COL_BEAT_ORG_OUTLET, $outletOrgData->toKeyValue('PrimaryKey', 'OutletOrgId'), $comparison);

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
     * Filter the query by a related \entities\Beats object
     *
     * @param \entities\Beats|ObjectCollection $beats The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBeats($beats, ?string $comparison = null)
    {
        if ($beats instanceof \entities\Beats) {
            return $this
                ->addUsingAlias(BeatOutletsTableMap::COL_BEAT_ID, $beats->getBeatId(), $comparison);
        } elseif ($beats instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(BeatOutletsTableMap::COL_BEAT_ID, $beats->toKeyValue('PrimaryKey', 'BeatId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByBeats() only accepts arguments of type \entities\Beats or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Beats relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinBeats(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Beats');

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
            $this->addJoinObject($join, 'Beats');
        }

        return $this;
    }

    /**
     * Use the Beats relation Beats object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\BeatsQuery A secondary query class using the current class as primary query
     */
    public function useBeatsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinBeats($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Beats', '\entities\BeatsQuery');
    }

    /**
     * Use the Beats relation Beats object
     *
     * @param callable(\entities\BeatsQuery):\entities\BeatsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withBeatsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useBeatsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Beats table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\BeatsQuery The inner query object of the EXISTS statement
     */
    public function useBeatsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\BeatsQuery */
        $q = $this->useExistsQuery('Beats', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Beats table for a NOT EXISTS query.
     *
     * @see useBeatsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\BeatsQuery The inner query object of the NOT EXISTS statement
     */
    public function useBeatsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\BeatsQuery */
        $q = $this->useExistsQuery('Beats', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Beats table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\BeatsQuery The inner query object of the IN statement
     */
    public function useInBeatsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\BeatsQuery */
        $q = $this->useInQuery('Beats', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Beats table for a NOT IN query.
     *
     * @see useBeatsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\BeatsQuery The inner query object of the NOT IN statement
     */
    public function useNotInBeatsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\BeatsQuery */
        $q = $this->useInQuery('Beats', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(BeatOutletsTableMap::COL_COMPANY_ID, $company->getCompanyId(), $comparison);
        } elseif ($company instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(BeatOutletsTableMap::COL_COMPANY_ID, $company->toKeyValue('PrimaryKey', 'CompanyId'), $comparison);

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
     * Exclude object from result
     *
     * @param ChildBeatOutlets $beatOutlets Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($beatOutlets = null)
    {
        if ($beatOutlets) {
            $this->addUsingAlias(BeatOutletsTableMap::COL_BEAT_OUTLET_MAPID, $beatOutlets->getBeatOutletMapid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the beat_outlets table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(BeatOutletsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            BeatOutletsTableMap::clearInstancePool();
            BeatOutletsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(BeatOutletsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(BeatOutletsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            BeatOutletsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            BeatOutletsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
