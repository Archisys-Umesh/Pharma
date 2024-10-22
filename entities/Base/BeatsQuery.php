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
use entities\Beats as ChildBeats;
use entities\BeatsQuery as ChildBeatsQuery;
use entities\Map\BeatsTableMap;

/**
 * Base class that represents a query for the `beats` table.
 *
 * @method     ChildBeatsQuery orderByBeatId($order = Criteria::ASC) Order by the beat_id column
 * @method     ChildBeatsQuery orderByBeatName($order = Criteria::ASC) Order by the beat_name column
 * @method     ChildBeatsQuery orderByBeatRemark($order = Criteria::ASC) Order by the beat_remark column
 * @method     ChildBeatsQuery orderByBeatCode($order = Criteria::ASC) Order by the beat_code column
 * @method     ChildBeatsQuery orderByTerritoryId($order = Criteria::ASC) Order by the territory_id column
 * @method     ChildBeatsQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildBeatsQuery orderByItownid($order = Criteria::ASC) Order by the itownid column
 * @method     ChildBeatsQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildBeatsQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildBeatsQuery orderByOrgUnitId($order = Criteria::ASC) Order by the org_unit_id column
 *
 * @method     ChildBeatsQuery groupByBeatId() Group by the beat_id column
 * @method     ChildBeatsQuery groupByBeatName() Group by the beat_name column
 * @method     ChildBeatsQuery groupByBeatRemark() Group by the beat_remark column
 * @method     ChildBeatsQuery groupByBeatCode() Group by the beat_code column
 * @method     ChildBeatsQuery groupByTerritoryId() Group by the territory_id column
 * @method     ChildBeatsQuery groupByCompanyId() Group by the company_id column
 * @method     ChildBeatsQuery groupByItownid() Group by the itownid column
 * @method     ChildBeatsQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildBeatsQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildBeatsQuery groupByOrgUnitId() Group by the org_unit_id column
 *
 * @method     ChildBeatsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildBeatsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildBeatsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildBeatsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildBeatsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildBeatsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildBeatsQuery leftJoinOrgUnit($relationAlias = null) Adds a LEFT JOIN clause to the query using the OrgUnit relation
 * @method     ChildBeatsQuery rightJoinOrgUnit($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OrgUnit relation
 * @method     ChildBeatsQuery innerJoinOrgUnit($relationAlias = null) Adds a INNER JOIN clause to the query using the OrgUnit relation
 *
 * @method     ChildBeatsQuery joinWithOrgUnit($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OrgUnit relation
 *
 * @method     ChildBeatsQuery leftJoinWithOrgUnit() Adds a LEFT JOIN clause and with to the query using the OrgUnit relation
 * @method     ChildBeatsQuery rightJoinWithOrgUnit() Adds a RIGHT JOIN clause and with to the query using the OrgUnit relation
 * @method     ChildBeatsQuery innerJoinWithOrgUnit() Adds a INNER JOIN clause and with to the query using the OrgUnit relation
 *
 * @method     ChildBeatsQuery leftJoinGeoTowns($relationAlias = null) Adds a LEFT JOIN clause to the query using the GeoTowns relation
 * @method     ChildBeatsQuery rightJoinGeoTowns($relationAlias = null) Adds a RIGHT JOIN clause to the query using the GeoTowns relation
 * @method     ChildBeatsQuery innerJoinGeoTowns($relationAlias = null) Adds a INNER JOIN clause to the query using the GeoTowns relation
 *
 * @method     ChildBeatsQuery joinWithGeoTowns($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the GeoTowns relation
 *
 * @method     ChildBeatsQuery leftJoinWithGeoTowns() Adds a LEFT JOIN clause and with to the query using the GeoTowns relation
 * @method     ChildBeatsQuery rightJoinWithGeoTowns() Adds a RIGHT JOIN clause and with to the query using the GeoTowns relation
 * @method     ChildBeatsQuery innerJoinWithGeoTowns() Adds a INNER JOIN clause and with to the query using the GeoTowns relation
 *
 * @method     ChildBeatsQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildBeatsQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildBeatsQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildBeatsQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildBeatsQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildBeatsQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildBeatsQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     ChildBeatsQuery leftJoinTerritories($relationAlias = null) Adds a LEFT JOIN clause to the query using the Territories relation
 * @method     ChildBeatsQuery rightJoinTerritories($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Territories relation
 * @method     ChildBeatsQuery innerJoinTerritories($relationAlias = null) Adds a INNER JOIN clause to the query using the Territories relation
 *
 * @method     ChildBeatsQuery joinWithTerritories($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Territories relation
 *
 * @method     ChildBeatsQuery leftJoinWithTerritories() Adds a LEFT JOIN clause and with to the query using the Territories relation
 * @method     ChildBeatsQuery rightJoinWithTerritories() Adds a RIGHT JOIN clause and with to the query using the Territories relation
 * @method     ChildBeatsQuery innerJoinWithTerritories() Adds a INNER JOIN clause and with to the query using the Territories relation
 *
 * @method     ChildBeatsQuery leftJoinBeatOutlets($relationAlias = null) Adds a LEFT JOIN clause to the query using the BeatOutlets relation
 * @method     ChildBeatsQuery rightJoinBeatOutlets($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BeatOutlets relation
 * @method     ChildBeatsQuery innerJoinBeatOutlets($relationAlias = null) Adds a INNER JOIN clause to the query using the BeatOutlets relation
 *
 * @method     ChildBeatsQuery joinWithBeatOutlets($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BeatOutlets relation
 *
 * @method     ChildBeatsQuery leftJoinWithBeatOutlets() Adds a LEFT JOIN clause and with to the query using the BeatOutlets relation
 * @method     ChildBeatsQuery rightJoinWithBeatOutlets() Adds a RIGHT JOIN clause and with to the query using the BeatOutlets relation
 * @method     ChildBeatsQuery innerJoinWithBeatOutlets() Adds a INNER JOIN clause and with to the query using the BeatOutlets relation
 *
 * @method     ChildBeatsQuery leftJoinDayplan($relationAlias = null) Adds a LEFT JOIN clause to the query using the Dayplan relation
 * @method     ChildBeatsQuery rightJoinDayplan($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Dayplan relation
 * @method     ChildBeatsQuery innerJoinDayplan($relationAlias = null) Adds a INNER JOIN clause to the query using the Dayplan relation
 *
 * @method     ChildBeatsQuery joinWithDayplan($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Dayplan relation
 *
 * @method     ChildBeatsQuery leftJoinWithDayplan() Adds a LEFT JOIN clause and with to the query using the Dayplan relation
 * @method     ChildBeatsQuery rightJoinWithDayplan() Adds a RIGHT JOIN clause and with to the query using the Dayplan relation
 * @method     ChildBeatsQuery innerJoinWithDayplan() Adds a INNER JOIN clause and with to the query using the Dayplan relation
 *
 * @method     ChildBeatsQuery leftJoinOnBoardRequestAddress($relationAlias = null) Adds a LEFT JOIN clause to the query using the OnBoardRequestAddress relation
 * @method     ChildBeatsQuery rightJoinOnBoardRequestAddress($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OnBoardRequestAddress relation
 * @method     ChildBeatsQuery innerJoinOnBoardRequestAddress($relationAlias = null) Adds a INNER JOIN clause to the query using the OnBoardRequestAddress relation
 *
 * @method     ChildBeatsQuery joinWithOnBoardRequestAddress($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OnBoardRequestAddress relation
 *
 * @method     ChildBeatsQuery leftJoinWithOnBoardRequestAddress() Adds a LEFT JOIN clause and with to the query using the OnBoardRequestAddress relation
 * @method     ChildBeatsQuery rightJoinWithOnBoardRequestAddress() Adds a RIGHT JOIN clause and with to the query using the OnBoardRequestAddress relation
 * @method     ChildBeatsQuery innerJoinWithOnBoardRequestAddress() Adds a INNER JOIN clause and with to the query using the OnBoardRequestAddress relation
 *
 * @method     ChildBeatsQuery leftJoinOrders($relationAlias = null) Adds a LEFT JOIN clause to the query using the Orders relation
 * @method     ChildBeatsQuery rightJoinOrders($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Orders relation
 * @method     ChildBeatsQuery innerJoinOrders($relationAlias = null) Adds a INNER JOIN clause to the query using the Orders relation
 *
 * @method     ChildBeatsQuery joinWithOrders($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Orders relation
 *
 * @method     ChildBeatsQuery leftJoinWithOrders() Adds a LEFT JOIN clause and with to the query using the Orders relation
 * @method     ChildBeatsQuery rightJoinWithOrders() Adds a RIGHT JOIN clause and with to the query using the Orders relation
 * @method     ChildBeatsQuery innerJoinWithOrders() Adds a INNER JOIN clause and with to the query using the Orders relation
 *
 * @method     ChildBeatsQuery leftJoinTourplans($relationAlias = null) Adds a LEFT JOIN clause to the query using the Tourplans relation
 * @method     ChildBeatsQuery rightJoinTourplans($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Tourplans relation
 * @method     ChildBeatsQuery innerJoinTourplans($relationAlias = null) Adds a INNER JOIN clause to the query using the Tourplans relation
 *
 * @method     ChildBeatsQuery joinWithTourplans($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Tourplans relation
 *
 * @method     ChildBeatsQuery leftJoinWithTourplans() Adds a LEFT JOIN clause and with to the query using the Tourplans relation
 * @method     ChildBeatsQuery rightJoinWithTourplans() Adds a RIGHT JOIN clause and with to the query using the Tourplans relation
 * @method     ChildBeatsQuery innerJoinWithTourplans() Adds a INNER JOIN clause and with to the query using the Tourplans relation
 *
 * @method     ChildBeatsQuery leftJoinStpWeek($relationAlias = null) Adds a LEFT JOIN clause to the query using the StpWeek relation
 * @method     ChildBeatsQuery rightJoinStpWeek($relationAlias = null) Adds a RIGHT JOIN clause to the query using the StpWeek relation
 * @method     ChildBeatsQuery innerJoinStpWeek($relationAlias = null) Adds a INNER JOIN clause to the query using the StpWeek relation
 *
 * @method     ChildBeatsQuery joinWithStpWeek($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the StpWeek relation
 *
 * @method     ChildBeatsQuery leftJoinWithStpWeek() Adds a LEFT JOIN clause and with to the query using the StpWeek relation
 * @method     ChildBeatsQuery rightJoinWithStpWeek() Adds a RIGHT JOIN clause and with to the query using the StpWeek relation
 * @method     ChildBeatsQuery innerJoinWithStpWeek() Adds a INNER JOIN clause and with to the query using the StpWeek relation
 *
 * @method     \entities\OrgUnitQuery|\entities\GeoTownsQuery|\entities\CompanyQuery|\entities\TerritoriesQuery|\entities\BeatOutletsQuery|\entities\DayplanQuery|\entities\OnBoardRequestAddressQuery|\entities\OrdersQuery|\entities\TourplansQuery|\entities\StpWeekQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildBeats|null findOne(?ConnectionInterface $con = null) Return the first ChildBeats matching the query
 * @method     ChildBeats findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildBeats matching the query, or a new ChildBeats object populated from the query conditions when no match is found
 *
 * @method     ChildBeats|null findOneByBeatId(int $beat_id) Return the first ChildBeats filtered by the beat_id column
 * @method     ChildBeats|null findOneByBeatName(string $beat_name) Return the first ChildBeats filtered by the beat_name column
 * @method     ChildBeats|null findOneByBeatRemark(string $beat_remark) Return the first ChildBeats filtered by the beat_remark column
 * @method     ChildBeats|null findOneByBeatCode(string $beat_code) Return the first ChildBeats filtered by the beat_code column
 * @method     ChildBeats|null findOneByTerritoryId(int $territory_id) Return the first ChildBeats filtered by the territory_id column
 * @method     ChildBeats|null findOneByCompanyId(int $company_id) Return the first ChildBeats filtered by the company_id column
 * @method     ChildBeats|null findOneByItownid(string $itownid) Return the first ChildBeats filtered by the itownid column
 * @method     ChildBeats|null findOneByCreatedAt(string $created_at) Return the first ChildBeats filtered by the created_at column
 * @method     ChildBeats|null findOneByUpdatedAt(string $updated_at) Return the first ChildBeats filtered by the updated_at column
 * @method     ChildBeats|null findOneByOrgUnitId(int $org_unit_id) Return the first ChildBeats filtered by the org_unit_id column
 *
 * @method     ChildBeats requirePk($key, ?ConnectionInterface $con = null) Return the ChildBeats by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBeats requireOne(?ConnectionInterface $con = null) Return the first ChildBeats matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBeats requireOneByBeatId(int $beat_id) Return the first ChildBeats filtered by the beat_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBeats requireOneByBeatName(string $beat_name) Return the first ChildBeats filtered by the beat_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBeats requireOneByBeatRemark(string $beat_remark) Return the first ChildBeats filtered by the beat_remark column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBeats requireOneByBeatCode(string $beat_code) Return the first ChildBeats filtered by the beat_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBeats requireOneByTerritoryId(int $territory_id) Return the first ChildBeats filtered by the territory_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBeats requireOneByCompanyId(int $company_id) Return the first ChildBeats filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBeats requireOneByItownid(string $itownid) Return the first ChildBeats filtered by the itownid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBeats requireOneByCreatedAt(string $created_at) Return the first ChildBeats filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBeats requireOneByUpdatedAt(string $updated_at) Return the first ChildBeats filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBeats requireOneByOrgUnitId(int $org_unit_id) Return the first ChildBeats filtered by the org_unit_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBeats[]|Collection find(?ConnectionInterface $con = null) Return ChildBeats objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildBeats> find(?ConnectionInterface $con = null) Return ChildBeats objects based on current ModelCriteria
 *
 * @method     ChildBeats[]|Collection findByBeatId(int|array<int> $beat_id) Return ChildBeats objects filtered by the beat_id column
 * @psalm-method Collection&\Traversable<ChildBeats> findByBeatId(int|array<int> $beat_id) Return ChildBeats objects filtered by the beat_id column
 * @method     ChildBeats[]|Collection findByBeatName(string|array<string> $beat_name) Return ChildBeats objects filtered by the beat_name column
 * @psalm-method Collection&\Traversable<ChildBeats> findByBeatName(string|array<string> $beat_name) Return ChildBeats objects filtered by the beat_name column
 * @method     ChildBeats[]|Collection findByBeatRemark(string|array<string> $beat_remark) Return ChildBeats objects filtered by the beat_remark column
 * @psalm-method Collection&\Traversable<ChildBeats> findByBeatRemark(string|array<string> $beat_remark) Return ChildBeats objects filtered by the beat_remark column
 * @method     ChildBeats[]|Collection findByBeatCode(string|array<string> $beat_code) Return ChildBeats objects filtered by the beat_code column
 * @psalm-method Collection&\Traversable<ChildBeats> findByBeatCode(string|array<string> $beat_code) Return ChildBeats objects filtered by the beat_code column
 * @method     ChildBeats[]|Collection findByTerritoryId(int|array<int> $territory_id) Return ChildBeats objects filtered by the territory_id column
 * @psalm-method Collection&\Traversable<ChildBeats> findByTerritoryId(int|array<int> $territory_id) Return ChildBeats objects filtered by the territory_id column
 * @method     ChildBeats[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildBeats objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildBeats> findByCompanyId(int|array<int> $company_id) Return ChildBeats objects filtered by the company_id column
 * @method     ChildBeats[]|Collection findByItownid(string|array<string> $itownid) Return ChildBeats objects filtered by the itownid column
 * @psalm-method Collection&\Traversable<ChildBeats> findByItownid(string|array<string> $itownid) Return ChildBeats objects filtered by the itownid column
 * @method     ChildBeats[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildBeats objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildBeats> findByCreatedAt(string|array<string> $created_at) Return ChildBeats objects filtered by the created_at column
 * @method     ChildBeats[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildBeats objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildBeats> findByUpdatedAt(string|array<string> $updated_at) Return ChildBeats objects filtered by the updated_at column
 * @method     ChildBeats[]|Collection findByOrgUnitId(int|array<int> $org_unit_id) Return ChildBeats objects filtered by the org_unit_id column
 * @psalm-method Collection&\Traversable<ChildBeats> findByOrgUnitId(int|array<int> $org_unit_id) Return ChildBeats objects filtered by the org_unit_id column
 *
 * @method     ChildBeats[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildBeats> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class BeatsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\BeatsQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\Beats', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildBeatsQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildBeatsQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildBeatsQuery) {
            return $criteria;
        }
        $query = new ChildBeatsQuery();
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
     * @return ChildBeats|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(BeatsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = BeatsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildBeats A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT beat_id, beat_name, beat_remark, beat_code, territory_id, company_id, itownid, created_at, updated_at, org_unit_id FROM beats WHERE beat_id = :p0';
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
            /** @var ChildBeats $obj */
            $obj = new ChildBeats();
            $obj->hydrate($row);
            BeatsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildBeats|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(BeatsTableMap::COL_BEAT_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(BeatsTableMap::COL_BEAT_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(BeatsTableMap::COL_BEAT_ID, $beatId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($beatId['max'])) {
                $this->addUsingAlias(BeatsTableMap::COL_BEAT_ID, $beatId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BeatsTableMap::COL_BEAT_ID, $beatId, $comparison);

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

        $this->addUsingAlias(BeatsTableMap::COL_BEAT_NAME, $beatName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the beat_remark column
     *
     * Example usage:
     * <code>
     * $query->filterByBeatRemark('fooValue');   // WHERE beat_remark = 'fooValue'
     * $query->filterByBeatRemark('%fooValue%', Criteria::LIKE); // WHERE beat_remark LIKE '%fooValue%'
     * $query->filterByBeatRemark(['foo', 'bar']); // WHERE beat_remark IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $beatRemark The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBeatRemark($beatRemark = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($beatRemark)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BeatsTableMap::COL_BEAT_REMARK, $beatRemark, $comparison);

        return $this;
    }

    /**
     * Filter the query on the beat_code column
     *
     * Example usage:
     * <code>
     * $query->filterByBeatCode('fooValue');   // WHERE beat_code = 'fooValue'
     * $query->filterByBeatCode('%fooValue%', Criteria::LIKE); // WHERE beat_code LIKE '%fooValue%'
     * $query->filterByBeatCode(['foo', 'bar']); // WHERE beat_code IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $beatCode The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBeatCode($beatCode = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($beatCode)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BeatsTableMap::COL_BEAT_CODE, $beatCode, $comparison);

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
     * @see       filterByTerritories()
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
                $this->addUsingAlias(BeatsTableMap::COL_TERRITORY_ID, $territoryId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($territoryId['max'])) {
                $this->addUsingAlias(BeatsTableMap::COL_TERRITORY_ID, $territoryId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BeatsTableMap::COL_TERRITORY_ID, $territoryId, $comparison);

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
                $this->addUsingAlias(BeatsTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(BeatsTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BeatsTableMap::COL_COMPANY_ID, $companyId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the itownid column
     *
     * Example usage:
     * <code>
     * $query->filterByItownid(1234); // WHERE itownid = 1234
     * $query->filterByItownid(array(12, 34)); // WHERE itownid IN (12, 34)
     * $query->filterByItownid(array('min' => 12)); // WHERE itownid > 12
     * </code>
     *
     * @see       filterByGeoTowns()
     *
     * @param mixed $itownid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByItownid($itownid = null, ?string $comparison = null)
    {
        if (is_array($itownid)) {
            $useMinMax = false;
            if (isset($itownid['min'])) {
                $this->addUsingAlias(BeatsTableMap::COL_ITOWNID, $itownid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($itownid['max'])) {
                $this->addUsingAlias(BeatsTableMap::COL_ITOWNID, $itownid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BeatsTableMap::COL_ITOWNID, $itownid, $comparison);

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
                $this->addUsingAlias(BeatsTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(BeatsTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BeatsTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(BeatsTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(BeatsTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BeatsTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the org_unit_id column
     *
     * Example usage:
     * <code>
     * $query->filterByOrgUnitId(1234); // WHERE org_unit_id = 1234
     * $query->filterByOrgUnitId(array(12, 34)); // WHERE org_unit_id IN (12, 34)
     * $query->filterByOrgUnitId(array('min' => 12)); // WHERE org_unit_id > 12
     * </code>
     *
     * @see       filterByOrgUnit()
     *
     * @param mixed $orgUnitId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrgUnitId($orgUnitId = null, ?string $comparison = null)
    {
        if (is_array($orgUnitId)) {
            $useMinMax = false;
            if (isset($orgUnitId['min'])) {
                $this->addUsingAlias(BeatsTableMap::COL_ORG_UNIT_ID, $orgUnitId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($orgUnitId['max'])) {
                $this->addUsingAlias(BeatsTableMap::COL_ORG_UNIT_ID, $orgUnitId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BeatsTableMap::COL_ORG_UNIT_ID, $orgUnitId, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \entities\OrgUnit object
     *
     * @param \entities\OrgUnit|ObjectCollection $orgUnit The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrgUnit($orgUnit, ?string $comparison = null)
    {
        if ($orgUnit instanceof \entities\OrgUnit) {
            return $this
                ->addUsingAlias(BeatsTableMap::COL_ORG_UNIT_ID, $orgUnit->getOrgunitid(), $comparison);
        } elseif ($orgUnit instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(BeatsTableMap::COL_ORG_UNIT_ID, $orgUnit->toKeyValue('PrimaryKey', 'Orgunitid'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByOrgUnit() only accepts arguments of type \entities\OrgUnit or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OrgUnit relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOrgUnit(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OrgUnit');

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
            $this->addJoinObject($join, 'OrgUnit');
        }

        return $this;
    }

    /**
     * Use the OrgUnit relation OrgUnit object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\OrgUnitQuery A secondary query class using the current class as primary query
     */
    public function useOrgUnitQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinOrgUnit($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OrgUnit', '\entities\OrgUnitQuery');
    }

    /**
     * Use the OrgUnit relation OrgUnit object
     *
     * @param callable(\entities\OrgUnitQuery):\entities\OrgUnitQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOrgUnitQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useOrgUnitQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to OrgUnit table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\OrgUnitQuery The inner query object of the EXISTS statement
     */
    public function useOrgUnitExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\OrgUnitQuery */
        $q = $this->useExistsQuery('OrgUnit', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to OrgUnit table for a NOT EXISTS query.
     *
     * @see useOrgUnitExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\OrgUnitQuery The inner query object of the NOT EXISTS statement
     */
    public function useOrgUnitNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OrgUnitQuery */
        $q = $this->useExistsQuery('OrgUnit', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to OrgUnit table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\OrgUnitQuery The inner query object of the IN statement
     */
    public function useInOrgUnitQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\OrgUnitQuery */
        $q = $this->useInQuery('OrgUnit', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to OrgUnit table for a NOT IN query.
     *
     * @see useOrgUnitInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\OrgUnitQuery The inner query object of the NOT IN statement
     */
    public function useNotInOrgUnitQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OrgUnitQuery */
        $q = $this->useInQuery('OrgUnit', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\GeoTowns object
     *
     * @param \entities\GeoTowns|ObjectCollection $geoTowns The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByGeoTowns($geoTowns, ?string $comparison = null)
    {
        if ($geoTowns instanceof \entities\GeoTowns) {
            return $this
                ->addUsingAlias(BeatsTableMap::COL_ITOWNID, $geoTowns->getItownid(), $comparison);
        } elseif ($geoTowns instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(BeatsTableMap::COL_ITOWNID, $geoTowns->toKeyValue('PrimaryKey', 'Itownid'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByGeoTowns() only accepts arguments of type \entities\GeoTowns or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the GeoTowns relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinGeoTowns(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('GeoTowns');

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
            $this->addJoinObject($join, 'GeoTowns');
        }

        return $this;
    }

    /**
     * Use the GeoTowns relation GeoTowns object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\GeoTownsQuery A secondary query class using the current class as primary query
     */
    public function useGeoTownsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinGeoTowns($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'GeoTowns', '\entities\GeoTownsQuery');
    }

    /**
     * Use the GeoTowns relation GeoTowns object
     *
     * @param callable(\entities\GeoTownsQuery):\entities\GeoTownsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withGeoTownsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useGeoTownsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to GeoTowns table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\GeoTownsQuery The inner query object of the EXISTS statement
     */
    public function useGeoTownsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\GeoTownsQuery */
        $q = $this->useExistsQuery('GeoTowns', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to GeoTowns table for a NOT EXISTS query.
     *
     * @see useGeoTownsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\GeoTownsQuery The inner query object of the NOT EXISTS statement
     */
    public function useGeoTownsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\GeoTownsQuery */
        $q = $this->useExistsQuery('GeoTowns', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to GeoTowns table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\GeoTownsQuery The inner query object of the IN statement
     */
    public function useInGeoTownsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\GeoTownsQuery */
        $q = $this->useInQuery('GeoTowns', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to GeoTowns table for a NOT IN query.
     *
     * @see useGeoTownsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\GeoTownsQuery The inner query object of the NOT IN statement
     */
    public function useNotInGeoTownsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\GeoTownsQuery */
        $q = $this->useInQuery('GeoTowns', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(BeatsTableMap::COL_COMPANY_ID, $company->getCompanyId(), $comparison);
        } elseif ($company instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(BeatsTableMap::COL_COMPANY_ID, $company->toKeyValue('PrimaryKey', 'CompanyId'), $comparison);

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
     * Filter the query by a related \entities\Territories object
     *
     * @param \entities\Territories|ObjectCollection $territories The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTerritories($territories, ?string $comparison = null)
    {
        if ($territories instanceof \entities\Territories) {
            return $this
                ->addUsingAlias(BeatsTableMap::COL_TERRITORY_ID, $territories->getTerritoryId(), $comparison);
        } elseif ($territories instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(BeatsTableMap::COL_TERRITORY_ID, $territories->toKeyValue('PrimaryKey', 'TerritoryId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByTerritories() only accepts arguments of type \entities\Territories or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Territories relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinTerritories(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Territories');

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
            $this->addJoinObject($join, 'Territories');
        }

        return $this;
    }

    /**
     * Use the Territories relation Territories object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\TerritoriesQuery A secondary query class using the current class as primary query
     */
    public function useTerritoriesQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinTerritories($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Territories', '\entities\TerritoriesQuery');
    }

    /**
     * Use the Territories relation Territories object
     *
     * @param callable(\entities\TerritoriesQuery):\entities\TerritoriesQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withTerritoriesQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useTerritoriesQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Territories table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\TerritoriesQuery The inner query object of the EXISTS statement
     */
    public function useTerritoriesExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\TerritoriesQuery */
        $q = $this->useExistsQuery('Territories', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Territories table for a NOT EXISTS query.
     *
     * @see useTerritoriesExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\TerritoriesQuery The inner query object of the NOT EXISTS statement
     */
    public function useTerritoriesNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\TerritoriesQuery */
        $q = $this->useExistsQuery('Territories', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Territories table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\TerritoriesQuery The inner query object of the IN statement
     */
    public function useInTerritoriesQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\TerritoriesQuery */
        $q = $this->useInQuery('Territories', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Territories table for a NOT IN query.
     *
     * @see useTerritoriesInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\TerritoriesQuery The inner query object of the NOT IN statement
     */
    public function useNotInTerritoriesQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\TerritoriesQuery */
        $q = $this->useInQuery('Territories', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\BeatOutlets object
     *
     * @param \entities\BeatOutlets|ObjectCollection $beatOutlets the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBeatOutlets($beatOutlets, ?string $comparison = null)
    {
        if ($beatOutlets instanceof \entities\BeatOutlets) {
            $this
                ->addUsingAlias(BeatsTableMap::COL_BEAT_ID, $beatOutlets->getBeatId(), $comparison);

            return $this;
        } elseif ($beatOutlets instanceof ObjectCollection) {
            $this
                ->useBeatOutletsQuery()
                ->filterByPrimaryKeys($beatOutlets->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByBeatOutlets() only accepts arguments of type \entities\BeatOutlets or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BeatOutlets relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinBeatOutlets(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BeatOutlets');

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
            $this->addJoinObject($join, 'BeatOutlets');
        }

        return $this;
    }

    /**
     * Use the BeatOutlets relation BeatOutlets object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\BeatOutletsQuery A secondary query class using the current class as primary query
     */
    public function useBeatOutletsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinBeatOutlets($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BeatOutlets', '\entities\BeatOutletsQuery');
    }

    /**
     * Use the BeatOutlets relation BeatOutlets object
     *
     * @param callable(\entities\BeatOutletsQuery):\entities\BeatOutletsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withBeatOutletsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useBeatOutletsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to BeatOutlets table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\BeatOutletsQuery The inner query object of the EXISTS statement
     */
    public function useBeatOutletsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\BeatOutletsQuery */
        $q = $this->useExistsQuery('BeatOutlets', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to BeatOutlets table for a NOT EXISTS query.
     *
     * @see useBeatOutletsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\BeatOutletsQuery The inner query object of the NOT EXISTS statement
     */
    public function useBeatOutletsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\BeatOutletsQuery */
        $q = $this->useExistsQuery('BeatOutlets', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to BeatOutlets table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\BeatOutletsQuery The inner query object of the IN statement
     */
    public function useInBeatOutletsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\BeatOutletsQuery */
        $q = $this->useInQuery('BeatOutlets', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to BeatOutlets table for a NOT IN query.
     *
     * @see useBeatOutletsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\BeatOutletsQuery The inner query object of the NOT IN statement
     */
    public function useNotInBeatOutletsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\BeatOutletsQuery */
        $q = $this->useInQuery('BeatOutlets', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\Dayplan object
     *
     * @param \entities\Dayplan|ObjectCollection $dayplan the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDayplan($dayplan, ?string $comparison = null)
    {
        if ($dayplan instanceof \entities\Dayplan) {
            $this
                ->addUsingAlias(BeatsTableMap::COL_BEAT_ID, $dayplan->getBeatId(), $comparison);

            return $this;
        } elseif ($dayplan instanceof ObjectCollection) {
            $this
                ->useDayplanQuery()
                ->filterByPrimaryKeys($dayplan->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByDayplan() only accepts arguments of type \entities\Dayplan or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Dayplan relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinDayplan(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Dayplan');

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
            $this->addJoinObject($join, 'Dayplan');
        }

        return $this;
    }

    /**
     * Use the Dayplan relation Dayplan object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\DayplanQuery A secondary query class using the current class as primary query
     */
    public function useDayplanQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinDayplan($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Dayplan', '\entities\DayplanQuery');
    }

    /**
     * Use the Dayplan relation Dayplan object
     *
     * @param callable(\entities\DayplanQuery):\entities\DayplanQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withDayplanQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useDayplanQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Dayplan table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\DayplanQuery The inner query object of the EXISTS statement
     */
    public function useDayplanExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\DayplanQuery */
        $q = $this->useExistsQuery('Dayplan', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Dayplan table for a NOT EXISTS query.
     *
     * @see useDayplanExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\DayplanQuery The inner query object of the NOT EXISTS statement
     */
    public function useDayplanNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\DayplanQuery */
        $q = $this->useExistsQuery('Dayplan', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Dayplan table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\DayplanQuery The inner query object of the IN statement
     */
    public function useInDayplanQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\DayplanQuery */
        $q = $this->useInQuery('Dayplan', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Dayplan table for a NOT IN query.
     *
     * @see useDayplanInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\DayplanQuery The inner query object of the NOT IN statement
     */
    public function useNotInDayplanQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\DayplanQuery */
        $q = $this->useInQuery('Dayplan', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\OnBoardRequestAddress object
     *
     * @param \entities\OnBoardRequestAddress|ObjectCollection $onBoardRequestAddress the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOnBoardRequestAddress($onBoardRequestAddress, ?string $comparison = null)
    {
        if ($onBoardRequestAddress instanceof \entities\OnBoardRequestAddress) {
            $this
                ->addUsingAlias(BeatsTableMap::COL_BEAT_ID, $onBoardRequestAddress->getBeatId(), $comparison);

            return $this;
        } elseif ($onBoardRequestAddress instanceof ObjectCollection) {
            $this
                ->useOnBoardRequestAddressQuery()
                ->filterByPrimaryKeys($onBoardRequestAddress->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByOnBoardRequestAddress() only accepts arguments of type \entities\OnBoardRequestAddress or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OnBoardRequestAddress relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOnBoardRequestAddress(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OnBoardRequestAddress');

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
            $this->addJoinObject($join, 'OnBoardRequestAddress');
        }

        return $this;
    }

    /**
     * Use the OnBoardRequestAddress relation OnBoardRequestAddress object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\OnBoardRequestAddressQuery A secondary query class using the current class as primary query
     */
    public function useOnBoardRequestAddressQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinOnBoardRequestAddress($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OnBoardRequestAddress', '\entities\OnBoardRequestAddressQuery');
    }

    /**
     * Use the OnBoardRequestAddress relation OnBoardRequestAddress object
     *
     * @param callable(\entities\OnBoardRequestAddressQuery):\entities\OnBoardRequestAddressQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOnBoardRequestAddressQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useOnBoardRequestAddressQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to OnBoardRequestAddress table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\OnBoardRequestAddressQuery The inner query object of the EXISTS statement
     */
    public function useOnBoardRequestAddressExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\OnBoardRequestAddressQuery */
        $q = $this->useExistsQuery('OnBoardRequestAddress', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to OnBoardRequestAddress table for a NOT EXISTS query.
     *
     * @see useOnBoardRequestAddressExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\OnBoardRequestAddressQuery The inner query object of the NOT EXISTS statement
     */
    public function useOnBoardRequestAddressNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OnBoardRequestAddressQuery */
        $q = $this->useExistsQuery('OnBoardRequestAddress', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to OnBoardRequestAddress table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\OnBoardRequestAddressQuery The inner query object of the IN statement
     */
    public function useInOnBoardRequestAddressQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\OnBoardRequestAddressQuery */
        $q = $this->useInQuery('OnBoardRequestAddress', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to OnBoardRequestAddress table for a NOT IN query.
     *
     * @see useOnBoardRequestAddressInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\OnBoardRequestAddressQuery The inner query object of the NOT IN statement
     */
    public function useNotInOnBoardRequestAddressQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OnBoardRequestAddressQuery */
        $q = $this->useInQuery('OnBoardRequestAddress', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\Orders object
     *
     * @param \entities\Orders|ObjectCollection $orders the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrders($orders, ?string $comparison = null)
    {
        if ($orders instanceof \entities\Orders) {
            $this
                ->addUsingAlias(BeatsTableMap::COL_BEAT_ID, $orders->getBeatId(), $comparison);

            return $this;
        } elseif ($orders instanceof ObjectCollection) {
            $this
                ->useOrdersQuery()
                ->filterByPrimaryKeys($orders->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByOrders() only accepts arguments of type \entities\Orders or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Orders relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOrders(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Orders');

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
            $this->addJoinObject($join, 'Orders');
        }

        return $this;
    }

    /**
     * Use the Orders relation Orders object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\OrdersQuery A secondary query class using the current class as primary query
     */
    public function useOrdersQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinOrders($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Orders', '\entities\OrdersQuery');
    }

    /**
     * Use the Orders relation Orders object
     *
     * @param callable(\entities\OrdersQuery):\entities\OrdersQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOrdersQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useOrdersQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Orders table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\OrdersQuery The inner query object of the EXISTS statement
     */
    public function useOrdersExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\OrdersQuery */
        $q = $this->useExistsQuery('Orders', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Orders table for a NOT EXISTS query.
     *
     * @see useOrdersExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\OrdersQuery The inner query object of the NOT EXISTS statement
     */
    public function useOrdersNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OrdersQuery */
        $q = $this->useExistsQuery('Orders', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Orders table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\OrdersQuery The inner query object of the IN statement
     */
    public function useInOrdersQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\OrdersQuery */
        $q = $this->useInQuery('Orders', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Orders table for a NOT IN query.
     *
     * @see useOrdersInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\OrdersQuery The inner query object of the NOT IN statement
     */
    public function useNotInOrdersQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OrdersQuery */
        $q = $this->useInQuery('Orders', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\Tourplans object
     *
     * @param \entities\Tourplans|ObjectCollection $tourplans the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTourplans($tourplans, ?string $comparison = null)
    {
        if ($tourplans instanceof \entities\Tourplans) {
            $this
                ->addUsingAlias(BeatsTableMap::COL_BEAT_ID, $tourplans->getBeatId(), $comparison);

            return $this;
        } elseif ($tourplans instanceof ObjectCollection) {
            $this
                ->useTourplansQuery()
                ->filterByPrimaryKeys($tourplans->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByTourplans() only accepts arguments of type \entities\Tourplans or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Tourplans relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinTourplans(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Tourplans');

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
            $this->addJoinObject($join, 'Tourplans');
        }

        return $this;
    }

    /**
     * Use the Tourplans relation Tourplans object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\TourplansQuery A secondary query class using the current class as primary query
     */
    public function useTourplansQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinTourplans($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Tourplans', '\entities\TourplansQuery');
    }

    /**
     * Use the Tourplans relation Tourplans object
     *
     * @param callable(\entities\TourplansQuery):\entities\TourplansQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withTourplansQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useTourplansQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Tourplans table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\TourplansQuery The inner query object of the EXISTS statement
     */
    public function useTourplansExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\TourplansQuery */
        $q = $this->useExistsQuery('Tourplans', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Tourplans table for a NOT EXISTS query.
     *
     * @see useTourplansExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\TourplansQuery The inner query object of the NOT EXISTS statement
     */
    public function useTourplansNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\TourplansQuery */
        $q = $this->useExistsQuery('Tourplans', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Tourplans table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\TourplansQuery The inner query object of the IN statement
     */
    public function useInTourplansQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\TourplansQuery */
        $q = $this->useInQuery('Tourplans', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Tourplans table for a NOT IN query.
     *
     * @see useTourplansInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\TourplansQuery The inner query object of the NOT IN statement
     */
    public function useNotInTourplansQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\TourplansQuery */
        $q = $this->useInQuery('Tourplans', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\StpWeek object
     *
     * @param \entities\StpWeek|ObjectCollection $stpWeek the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStpWeek($stpWeek, ?string $comparison = null)
    {
        if ($stpWeek instanceof \entities\StpWeek) {
            $this
                ->addUsingAlias(BeatsTableMap::COL_BEAT_ID, $stpWeek->getBeatId(), $comparison);

            return $this;
        } elseif ($stpWeek instanceof ObjectCollection) {
            $this
                ->useStpWeekQuery()
                ->filterByPrimaryKeys($stpWeek->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByStpWeek() only accepts arguments of type \entities\StpWeek or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the StpWeek relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinStpWeek(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('StpWeek');

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
            $this->addJoinObject($join, 'StpWeek');
        }

        return $this;
    }

    /**
     * Use the StpWeek relation StpWeek object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\StpWeekQuery A secondary query class using the current class as primary query
     */
    public function useStpWeekQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinStpWeek($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'StpWeek', '\entities\StpWeekQuery');
    }

    /**
     * Use the StpWeek relation StpWeek object
     *
     * @param callable(\entities\StpWeekQuery):\entities\StpWeekQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withStpWeekQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useStpWeekQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to StpWeek table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\StpWeekQuery The inner query object of the EXISTS statement
     */
    public function useStpWeekExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\StpWeekQuery */
        $q = $this->useExistsQuery('StpWeek', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to StpWeek table for a NOT EXISTS query.
     *
     * @see useStpWeekExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\StpWeekQuery The inner query object of the NOT EXISTS statement
     */
    public function useStpWeekNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\StpWeekQuery */
        $q = $this->useExistsQuery('StpWeek', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to StpWeek table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\StpWeekQuery The inner query object of the IN statement
     */
    public function useInStpWeekQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\StpWeekQuery */
        $q = $this->useInQuery('StpWeek', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to StpWeek table for a NOT IN query.
     *
     * @see useStpWeekInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\StpWeekQuery The inner query object of the NOT IN statement
     */
    public function useNotInStpWeekQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\StpWeekQuery */
        $q = $this->useInQuery('StpWeek', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildBeats $beats Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($beats = null)
    {
        if ($beats) {
            $this->addUsingAlias(BeatsTableMap::COL_BEAT_ID, $beats->getBeatId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the beats table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(BeatsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            BeatsTableMap::clearInstancePool();
            BeatsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(BeatsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(BeatsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            BeatsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            BeatsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
