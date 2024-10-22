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
use entities\RcpaSummaryData as ChildRcpaSummaryData;
use entities\RcpaSummaryDataQuery as ChildRcpaSummaryDataQuery;
use entities\Map\RcpaSummaryDataTableMap;

/**
 * Base class that represents a query for the `rcpa_summary_data` table.
 *
 * @method     ChildRcpaSummaryDataQuery orderByRcpaSummaryDataId($order = Criteria::ASC) Order by the rcpa_summary_data_id column
 * @method     ChildRcpaSummaryDataQuery orderByMoye($order = Criteria::ASC) Order by the moye column
 * @method     ChildRcpaSummaryDataQuery orderByTerritoryId($order = Criteria::ASC) Order by the territory_id column
 * @method     ChildRcpaSummaryDataQuery orderByPositionId($order = Criteria::ASC) Order by the position_id column
 * @method     ChildRcpaSummaryDataQuery orderByOutletId($order = Criteria::ASC) Order by the outlet_id column
 * @method     ChildRcpaSummaryDataQuery orderByOutletOrgId($order = Criteria::ASC) Order by the outlet_org_id column
 * @method     ChildRcpaSummaryDataQuery orderByBrandId($order = Criteria::ASC) Order by the brand_id column
 * @method     ChildRcpaSummaryDataQuery orderByContribution($order = Criteria::ASC) Order by the contribution column
 * @method     ChildRcpaSummaryDataQuery orderByOwn($order = Criteria::ASC) Order by the own column
 * @method     ChildRcpaSummaryDataQuery orderByMinValue($order = Criteria::ASC) Order by the min_value column
 * @method     ChildRcpaSummaryDataQuery orderByIsRxer($order = Criteria::ASC) Order by the is_rxer column
 * @method     ChildRcpaSummaryDataQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildRcpaSummaryDataQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildRcpaSummaryDataQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildRcpaSummaryDataQuery groupByRcpaSummaryDataId() Group by the rcpa_summary_data_id column
 * @method     ChildRcpaSummaryDataQuery groupByMoye() Group by the moye column
 * @method     ChildRcpaSummaryDataQuery groupByTerritoryId() Group by the territory_id column
 * @method     ChildRcpaSummaryDataQuery groupByPositionId() Group by the position_id column
 * @method     ChildRcpaSummaryDataQuery groupByOutletId() Group by the outlet_id column
 * @method     ChildRcpaSummaryDataQuery groupByOutletOrgId() Group by the outlet_org_id column
 * @method     ChildRcpaSummaryDataQuery groupByBrandId() Group by the brand_id column
 * @method     ChildRcpaSummaryDataQuery groupByContribution() Group by the contribution column
 * @method     ChildRcpaSummaryDataQuery groupByOwn() Group by the own column
 * @method     ChildRcpaSummaryDataQuery groupByMinValue() Group by the min_value column
 * @method     ChildRcpaSummaryDataQuery groupByIsRxer() Group by the is_rxer column
 * @method     ChildRcpaSummaryDataQuery groupByCompanyId() Group by the company_id column
 * @method     ChildRcpaSummaryDataQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildRcpaSummaryDataQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildRcpaSummaryDataQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildRcpaSummaryDataQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildRcpaSummaryDataQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildRcpaSummaryDataQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildRcpaSummaryDataQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildRcpaSummaryDataQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildRcpaSummaryData|null findOne(?ConnectionInterface $con = null) Return the first ChildRcpaSummaryData matching the query
 * @method     ChildRcpaSummaryData findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildRcpaSummaryData matching the query, or a new ChildRcpaSummaryData object populated from the query conditions when no match is found
 *
 * @method     ChildRcpaSummaryData|null findOneByRcpaSummaryDataId(int $rcpa_summary_data_id) Return the first ChildRcpaSummaryData filtered by the rcpa_summary_data_id column
 * @method     ChildRcpaSummaryData|null findOneByMoye(string $moye) Return the first ChildRcpaSummaryData filtered by the moye column
 * @method     ChildRcpaSummaryData|null findOneByTerritoryId(int $territory_id) Return the first ChildRcpaSummaryData filtered by the territory_id column
 * @method     ChildRcpaSummaryData|null findOneByPositionId(int $position_id) Return the first ChildRcpaSummaryData filtered by the position_id column
 * @method     ChildRcpaSummaryData|null findOneByOutletId(int $outlet_id) Return the first ChildRcpaSummaryData filtered by the outlet_id column
 * @method     ChildRcpaSummaryData|null findOneByOutletOrgId(int $outlet_org_id) Return the first ChildRcpaSummaryData filtered by the outlet_org_id column
 * @method     ChildRcpaSummaryData|null findOneByBrandId(int $brand_id) Return the first ChildRcpaSummaryData filtered by the brand_id column
 * @method     ChildRcpaSummaryData|null findOneByContribution(string $contribution) Return the first ChildRcpaSummaryData filtered by the contribution column
 * @method     ChildRcpaSummaryData|null findOneByOwn(string $own) Return the first ChildRcpaSummaryData filtered by the own column
 * @method     ChildRcpaSummaryData|null findOneByMinValue(string $min_value) Return the first ChildRcpaSummaryData filtered by the min_value column
 * @method     ChildRcpaSummaryData|null findOneByIsRxer(boolean $is_rxer) Return the first ChildRcpaSummaryData filtered by the is_rxer column
 * @method     ChildRcpaSummaryData|null findOneByCompanyId(int $company_id) Return the first ChildRcpaSummaryData filtered by the company_id column
 * @method     ChildRcpaSummaryData|null findOneByCreatedAt(string $created_at) Return the first ChildRcpaSummaryData filtered by the created_at column
 * @method     ChildRcpaSummaryData|null findOneByUpdatedAt(string $updated_at) Return the first ChildRcpaSummaryData filtered by the updated_at column
 *
 * @method     ChildRcpaSummaryData requirePk($key, ?ConnectionInterface $con = null) Return the ChildRcpaSummaryData by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRcpaSummaryData requireOne(?ConnectionInterface $con = null) Return the first ChildRcpaSummaryData matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildRcpaSummaryData requireOneByRcpaSummaryDataId(int $rcpa_summary_data_id) Return the first ChildRcpaSummaryData filtered by the rcpa_summary_data_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRcpaSummaryData requireOneByMoye(string $moye) Return the first ChildRcpaSummaryData filtered by the moye column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRcpaSummaryData requireOneByTerritoryId(int $territory_id) Return the first ChildRcpaSummaryData filtered by the territory_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRcpaSummaryData requireOneByPositionId(int $position_id) Return the first ChildRcpaSummaryData filtered by the position_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRcpaSummaryData requireOneByOutletId(int $outlet_id) Return the first ChildRcpaSummaryData filtered by the outlet_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRcpaSummaryData requireOneByOutletOrgId(int $outlet_org_id) Return the first ChildRcpaSummaryData filtered by the outlet_org_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRcpaSummaryData requireOneByBrandId(int $brand_id) Return the first ChildRcpaSummaryData filtered by the brand_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRcpaSummaryData requireOneByContribution(string $contribution) Return the first ChildRcpaSummaryData filtered by the contribution column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRcpaSummaryData requireOneByOwn(string $own) Return the first ChildRcpaSummaryData filtered by the own column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRcpaSummaryData requireOneByMinValue(string $min_value) Return the first ChildRcpaSummaryData filtered by the min_value column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRcpaSummaryData requireOneByIsRxer(boolean $is_rxer) Return the first ChildRcpaSummaryData filtered by the is_rxer column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRcpaSummaryData requireOneByCompanyId(int $company_id) Return the first ChildRcpaSummaryData filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRcpaSummaryData requireOneByCreatedAt(string $created_at) Return the first ChildRcpaSummaryData filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRcpaSummaryData requireOneByUpdatedAt(string $updated_at) Return the first ChildRcpaSummaryData filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildRcpaSummaryData[]|Collection find(?ConnectionInterface $con = null) Return ChildRcpaSummaryData objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildRcpaSummaryData> find(?ConnectionInterface $con = null) Return ChildRcpaSummaryData objects based on current ModelCriteria
 *
 * @method     ChildRcpaSummaryData[]|Collection findByRcpaSummaryDataId(int|array<int> $rcpa_summary_data_id) Return ChildRcpaSummaryData objects filtered by the rcpa_summary_data_id column
 * @psalm-method Collection&\Traversable<ChildRcpaSummaryData> findByRcpaSummaryDataId(int|array<int> $rcpa_summary_data_id) Return ChildRcpaSummaryData objects filtered by the rcpa_summary_data_id column
 * @method     ChildRcpaSummaryData[]|Collection findByMoye(string|array<string> $moye) Return ChildRcpaSummaryData objects filtered by the moye column
 * @psalm-method Collection&\Traversable<ChildRcpaSummaryData> findByMoye(string|array<string> $moye) Return ChildRcpaSummaryData objects filtered by the moye column
 * @method     ChildRcpaSummaryData[]|Collection findByTerritoryId(int|array<int> $territory_id) Return ChildRcpaSummaryData objects filtered by the territory_id column
 * @psalm-method Collection&\Traversable<ChildRcpaSummaryData> findByTerritoryId(int|array<int> $territory_id) Return ChildRcpaSummaryData objects filtered by the territory_id column
 * @method     ChildRcpaSummaryData[]|Collection findByPositionId(int|array<int> $position_id) Return ChildRcpaSummaryData objects filtered by the position_id column
 * @psalm-method Collection&\Traversable<ChildRcpaSummaryData> findByPositionId(int|array<int> $position_id) Return ChildRcpaSummaryData objects filtered by the position_id column
 * @method     ChildRcpaSummaryData[]|Collection findByOutletId(int|array<int> $outlet_id) Return ChildRcpaSummaryData objects filtered by the outlet_id column
 * @psalm-method Collection&\Traversable<ChildRcpaSummaryData> findByOutletId(int|array<int> $outlet_id) Return ChildRcpaSummaryData objects filtered by the outlet_id column
 * @method     ChildRcpaSummaryData[]|Collection findByOutletOrgId(int|array<int> $outlet_org_id) Return ChildRcpaSummaryData objects filtered by the outlet_org_id column
 * @psalm-method Collection&\Traversable<ChildRcpaSummaryData> findByOutletOrgId(int|array<int> $outlet_org_id) Return ChildRcpaSummaryData objects filtered by the outlet_org_id column
 * @method     ChildRcpaSummaryData[]|Collection findByBrandId(int|array<int> $brand_id) Return ChildRcpaSummaryData objects filtered by the brand_id column
 * @psalm-method Collection&\Traversable<ChildRcpaSummaryData> findByBrandId(int|array<int> $brand_id) Return ChildRcpaSummaryData objects filtered by the brand_id column
 * @method     ChildRcpaSummaryData[]|Collection findByContribution(string|array<string> $contribution) Return ChildRcpaSummaryData objects filtered by the contribution column
 * @psalm-method Collection&\Traversable<ChildRcpaSummaryData> findByContribution(string|array<string> $contribution) Return ChildRcpaSummaryData objects filtered by the contribution column
 * @method     ChildRcpaSummaryData[]|Collection findByOwn(string|array<string> $own) Return ChildRcpaSummaryData objects filtered by the own column
 * @psalm-method Collection&\Traversable<ChildRcpaSummaryData> findByOwn(string|array<string> $own) Return ChildRcpaSummaryData objects filtered by the own column
 * @method     ChildRcpaSummaryData[]|Collection findByMinValue(string|array<string> $min_value) Return ChildRcpaSummaryData objects filtered by the min_value column
 * @psalm-method Collection&\Traversable<ChildRcpaSummaryData> findByMinValue(string|array<string> $min_value) Return ChildRcpaSummaryData objects filtered by the min_value column
 * @method     ChildRcpaSummaryData[]|Collection findByIsRxer(boolean|array<boolean> $is_rxer) Return ChildRcpaSummaryData objects filtered by the is_rxer column
 * @psalm-method Collection&\Traversable<ChildRcpaSummaryData> findByIsRxer(boolean|array<boolean> $is_rxer) Return ChildRcpaSummaryData objects filtered by the is_rxer column
 * @method     ChildRcpaSummaryData[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildRcpaSummaryData objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildRcpaSummaryData> findByCompanyId(int|array<int> $company_id) Return ChildRcpaSummaryData objects filtered by the company_id column
 * @method     ChildRcpaSummaryData[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildRcpaSummaryData objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildRcpaSummaryData> findByCreatedAt(string|array<string> $created_at) Return ChildRcpaSummaryData objects filtered by the created_at column
 * @method     ChildRcpaSummaryData[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildRcpaSummaryData objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildRcpaSummaryData> findByUpdatedAt(string|array<string> $updated_at) Return ChildRcpaSummaryData objects filtered by the updated_at column
 *
 * @method     ChildRcpaSummaryData[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildRcpaSummaryData> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class RcpaSummaryDataQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\RcpaSummaryDataQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\RcpaSummaryData', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildRcpaSummaryDataQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildRcpaSummaryDataQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildRcpaSummaryDataQuery) {
            return $criteria;
        }
        $query = new ChildRcpaSummaryDataQuery();
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
     * @return ChildRcpaSummaryData|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(RcpaSummaryDataTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = RcpaSummaryDataTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildRcpaSummaryData A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT rcpa_summary_data_id, moye, territory_id, position_id, outlet_id, outlet_org_id, brand_id, contribution, own, min_value, is_rxer, company_id, created_at, updated_at FROM rcpa_summary_data WHERE rcpa_summary_data_id = :p0';
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
            /** @var ChildRcpaSummaryData $obj */
            $obj = new ChildRcpaSummaryData();
            $obj->hydrate($row);
            RcpaSummaryDataTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildRcpaSummaryData|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(RcpaSummaryDataTableMap::COL_RCPA_SUMMARY_DATA_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(RcpaSummaryDataTableMap::COL_RCPA_SUMMARY_DATA_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the rcpa_summary_data_id column
     *
     * Example usage:
     * <code>
     * $query->filterByRcpaSummaryDataId(1234); // WHERE rcpa_summary_data_id = 1234
     * $query->filterByRcpaSummaryDataId(array(12, 34)); // WHERE rcpa_summary_data_id IN (12, 34)
     * $query->filterByRcpaSummaryDataId(array('min' => 12)); // WHERE rcpa_summary_data_id > 12
     * </code>
     *
     * @param mixed $rcpaSummaryDataId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRcpaSummaryDataId($rcpaSummaryDataId = null, ?string $comparison = null)
    {
        if (is_array($rcpaSummaryDataId)) {
            $useMinMax = false;
            if (isset($rcpaSummaryDataId['min'])) {
                $this->addUsingAlias(RcpaSummaryDataTableMap::COL_RCPA_SUMMARY_DATA_ID, $rcpaSummaryDataId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($rcpaSummaryDataId['max'])) {
                $this->addUsingAlias(RcpaSummaryDataTableMap::COL_RCPA_SUMMARY_DATA_ID, $rcpaSummaryDataId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(RcpaSummaryDataTableMap::COL_RCPA_SUMMARY_DATA_ID, $rcpaSummaryDataId, $comparison);

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

        $this->addUsingAlias(RcpaSummaryDataTableMap::COL_MOYE, $moye, $comparison);

        return $this;
    }

    /**
     * Filter the query on the territory_id column
     *
     * Example usage:
     * <code>
     * $query->filterByTerritoryId(1234); // WHERE territory_id = 1234
     * $query->filterByTerritoryId(array(12, 34)); // WHERE territory_id IN (12, 34)
     * $query->filterByTerritoryId(array('min' => 12)); // WHERE territory_id > 12
     * </code>
     *
     * @param mixed $territoryId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTerritoryId($territoryId = null, ?string $comparison = null)
    {
        if (is_array($territoryId)) {
            $useMinMax = false;
            if (isset($territoryId['min'])) {
                $this->addUsingAlias(RcpaSummaryDataTableMap::COL_TERRITORY_ID, $territoryId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($territoryId['max'])) {
                $this->addUsingAlias(RcpaSummaryDataTableMap::COL_TERRITORY_ID, $territoryId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(RcpaSummaryDataTableMap::COL_TERRITORY_ID, $territoryId, $comparison);

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
                $this->addUsingAlias(RcpaSummaryDataTableMap::COL_POSITION_ID, $positionId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($positionId['max'])) {
                $this->addUsingAlias(RcpaSummaryDataTableMap::COL_POSITION_ID, $positionId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(RcpaSummaryDataTableMap::COL_POSITION_ID, $positionId, $comparison);

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
                $this->addUsingAlias(RcpaSummaryDataTableMap::COL_OUTLET_ID, $outletId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outletId['max'])) {
                $this->addUsingAlias(RcpaSummaryDataTableMap::COL_OUTLET_ID, $outletId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(RcpaSummaryDataTableMap::COL_OUTLET_ID, $outletId, $comparison);

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
                $this->addUsingAlias(RcpaSummaryDataTableMap::COL_OUTLET_ORG_ID, $outletOrgId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outletOrgId['max'])) {
                $this->addUsingAlias(RcpaSummaryDataTableMap::COL_OUTLET_ORG_ID, $outletOrgId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(RcpaSummaryDataTableMap::COL_OUTLET_ORG_ID, $outletOrgId, $comparison);

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
                $this->addUsingAlias(RcpaSummaryDataTableMap::COL_BRAND_ID, $brandId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($brandId['max'])) {
                $this->addUsingAlias(RcpaSummaryDataTableMap::COL_BRAND_ID, $brandId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(RcpaSummaryDataTableMap::COL_BRAND_ID, $brandId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the contribution column
     *
     * Example usage:
     * <code>
     * $query->filterByContribution(1234); // WHERE contribution = 1234
     * $query->filterByContribution(array(12, 34)); // WHERE contribution IN (12, 34)
     * $query->filterByContribution(array('min' => 12)); // WHERE contribution > 12
     * </code>
     *
     * @param mixed $contribution The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByContribution($contribution = null, ?string $comparison = null)
    {
        if (is_array($contribution)) {
            $useMinMax = false;
            if (isset($contribution['min'])) {
                $this->addUsingAlias(RcpaSummaryDataTableMap::COL_CONTRIBUTION, $contribution['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($contribution['max'])) {
                $this->addUsingAlias(RcpaSummaryDataTableMap::COL_CONTRIBUTION, $contribution['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(RcpaSummaryDataTableMap::COL_CONTRIBUTION, $contribution, $comparison);

        return $this;
    }

    /**
     * Filter the query on the own column
     *
     * Example usage:
     * <code>
     * $query->filterByOwn(1234); // WHERE own = 1234
     * $query->filterByOwn(array(12, 34)); // WHERE own IN (12, 34)
     * $query->filterByOwn(array('min' => 12)); // WHERE own > 12
     * </code>
     *
     * @param mixed $own The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOwn($own = null, ?string $comparison = null)
    {
        if (is_array($own)) {
            $useMinMax = false;
            if (isset($own['min'])) {
                $this->addUsingAlias(RcpaSummaryDataTableMap::COL_OWN, $own['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($own['max'])) {
                $this->addUsingAlias(RcpaSummaryDataTableMap::COL_OWN, $own['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(RcpaSummaryDataTableMap::COL_OWN, $own, $comparison);

        return $this;
    }

    /**
     * Filter the query on the min_value column
     *
     * Example usage:
     * <code>
     * $query->filterByMinValue(1234); // WHERE min_value = 1234
     * $query->filterByMinValue(array(12, 34)); // WHERE min_value IN (12, 34)
     * $query->filterByMinValue(array('min' => 12)); // WHERE min_value > 12
     * </code>
     *
     * @param mixed $minValue The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMinValue($minValue = null, ?string $comparison = null)
    {
        if (is_array($minValue)) {
            $useMinMax = false;
            if (isset($minValue['min'])) {
                $this->addUsingAlias(RcpaSummaryDataTableMap::COL_MIN_VALUE, $minValue['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($minValue['max'])) {
                $this->addUsingAlias(RcpaSummaryDataTableMap::COL_MIN_VALUE, $minValue['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(RcpaSummaryDataTableMap::COL_MIN_VALUE, $minValue, $comparison);

        return $this;
    }

    /**
     * Filter the query on the is_rxer column
     *
     * Example usage:
     * <code>
     * $query->filterByIsRxer(true); // WHERE is_rxer = true
     * $query->filterByIsRxer('yes'); // WHERE is_rxer = true
     * </code>
     *
     * @param bool|string $isRxer The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIsRxer($isRxer = null, ?string $comparison = null)
    {
        if (is_string($isRxer)) {
            $isRxer = in_array(strtolower($isRxer), array('false', 'off', '-', 'no', 'n', '0', ''), true) ? false : true;
        }

        $this->addUsingAlias(RcpaSummaryDataTableMap::COL_IS_RXER, $isRxer, $comparison);

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
                $this->addUsingAlias(RcpaSummaryDataTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(RcpaSummaryDataTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(RcpaSummaryDataTableMap::COL_COMPANY_ID, $companyId, $comparison);

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
                $this->addUsingAlias(RcpaSummaryDataTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(RcpaSummaryDataTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(RcpaSummaryDataTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(RcpaSummaryDataTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(RcpaSummaryDataTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(RcpaSummaryDataTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildRcpaSummaryData $rcpaSummaryData Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($rcpaSummaryData = null)
    {
        if ($rcpaSummaryData) {
            $this->addUsingAlias(RcpaSummaryDataTableMap::COL_RCPA_SUMMARY_DATA_ID, $rcpaSummaryData->getRcpaSummaryDataId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the rcpa_summary_data table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(RcpaSummaryDataTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            RcpaSummaryDataTableMap::clearInstancePool();
            RcpaSummaryDataTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(RcpaSummaryDataTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(RcpaSummaryDataTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            RcpaSummaryDataTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            RcpaSummaryDataTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
