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
use entities\Territories as ChildTerritories;
use entities\TerritoriesQuery as ChildTerritoriesQuery;
use entities\Map\TerritoriesTableMap;

/**
 * Base class that represents a query for the `territories` table.
 *
 * @method     ChildTerritoriesQuery orderByTerritoryId($order = Criteria::ASC) Order by the territory_id column
 * @method     ChildTerritoriesQuery orderByTerritoryCode($order = Criteria::ASC) Order by the territory_code column
 * @method     ChildTerritoriesQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildTerritoriesQuery orderByTerritoryName($order = Criteria::ASC) Order by the territory_name column
 * @method     ChildTerritoriesQuery orderByOrgunitid($order = Criteria::ASC) Order by the orgunitid column
 * @method     ChildTerritoriesQuery orderByPositionId($order = Criteria::ASC) Order by the position_id column
 * @method     ChildTerritoriesQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildTerritoriesQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildTerritoriesQuery orderByOnBoardingStatus($order = Criteria::ASC) Order by the on_boarding_status column
 * @method     ChildTerritoriesQuery orderByStartDate($order = Criteria::ASC) Order by the start_date column
 * @method     ChildTerritoriesQuery orderByEndDate($order = Criteria::ASC) Order by the end_date column
 * @method     ChildTerritoriesQuery orderByIstateid($order = Criteria::ASC) Order by the istateid column
 *
 * @method     ChildTerritoriesQuery groupByTerritoryId() Group by the territory_id column
 * @method     ChildTerritoriesQuery groupByTerritoryCode() Group by the territory_code column
 * @method     ChildTerritoriesQuery groupByCompanyId() Group by the company_id column
 * @method     ChildTerritoriesQuery groupByTerritoryName() Group by the territory_name column
 * @method     ChildTerritoriesQuery groupByOrgunitid() Group by the orgunitid column
 * @method     ChildTerritoriesQuery groupByPositionId() Group by the position_id column
 * @method     ChildTerritoriesQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildTerritoriesQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildTerritoriesQuery groupByOnBoardingStatus() Group by the on_boarding_status column
 * @method     ChildTerritoriesQuery groupByStartDate() Group by the start_date column
 * @method     ChildTerritoriesQuery groupByEndDate() Group by the end_date column
 * @method     ChildTerritoriesQuery groupByIstateid() Group by the istateid column
 *
 * @method     ChildTerritoriesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildTerritoriesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildTerritoriesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildTerritoriesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildTerritoriesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildTerritoriesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildTerritoriesQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildTerritoriesQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildTerritoriesQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildTerritoriesQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildTerritoriesQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildTerritoriesQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildTerritoriesQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     ChildTerritoriesQuery leftJoinOrgUnit($relationAlias = null) Adds a LEFT JOIN clause to the query using the OrgUnit relation
 * @method     ChildTerritoriesQuery rightJoinOrgUnit($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OrgUnit relation
 * @method     ChildTerritoriesQuery innerJoinOrgUnit($relationAlias = null) Adds a INNER JOIN clause to the query using the OrgUnit relation
 *
 * @method     ChildTerritoriesQuery joinWithOrgUnit($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OrgUnit relation
 *
 * @method     ChildTerritoriesQuery leftJoinWithOrgUnit() Adds a LEFT JOIN clause and with to the query using the OrgUnit relation
 * @method     ChildTerritoriesQuery rightJoinWithOrgUnit() Adds a RIGHT JOIN clause and with to the query using the OrgUnit relation
 * @method     ChildTerritoriesQuery innerJoinWithOrgUnit() Adds a INNER JOIN clause and with to the query using the OrgUnit relation
 *
 * @method     ChildTerritoriesQuery leftJoinPositions($relationAlias = null) Adds a LEFT JOIN clause to the query using the Positions relation
 * @method     ChildTerritoriesQuery rightJoinPositions($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Positions relation
 * @method     ChildTerritoriesQuery innerJoinPositions($relationAlias = null) Adds a INNER JOIN clause to the query using the Positions relation
 *
 * @method     ChildTerritoriesQuery joinWithPositions($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Positions relation
 *
 * @method     ChildTerritoriesQuery leftJoinWithPositions() Adds a LEFT JOIN clause and with to the query using the Positions relation
 * @method     ChildTerritoriesQuery rightJoinWithPositions() Adds a RIGHT JOIN clause and with to the query using the Positions relation
 * @method     ChildTerritoriesQuery innerJoinWithPositions() Adds a INNER JOIN clause and with to the query using the Positions relation
 *
 * @method     ChildTerritoriesQuery leftJoinBeats($relationAlias = null) Adds a LEFT JOIN clause to the query using the Beats relation
 * @method     ChildTerritoriesQuery rightJoinBeats($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Beats relation
 * @method     ChildTerritoriesQuery innerJoinBeats($relationAlias = null) Adds a INNER JOIN clause to the query using the Beats relation
 *
 * @method     ChildTerritoriesQuery joinWithBeats($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Beats relation
 *
 * @method     ChildTerritoriesQuery leftJoinWithBeats() Adds a LEFT JOIN clause and with to the query using the Beats relation
 * @method     ChildTerritoriesQuery rightJoinWithBeats() Adds a RIGHT JOIN clause and with to the query using the Beats relation
 * @method     ChildTerritoriesQuery innerJoinWithBeats() Adds a INNER JOIN clause and with to the query using the Beats relation
 *
 * @method     ChildTerritoriesQuery leftJoinOnBoardRequest($relationAlias = null) Adds a LEFT JOIN clause to the query using the OnBoardRequest relation
 * @method     ChildTerritoriesQuery rightJoinOnBoardRequest($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OnBoardRequest relation
 * @method     ChildTerritoriesQuery innerJoinOnBoardRequest($relationAlias = null) Adds a INNER JOIN clause to the query using the OnBoardRequest relation
 *
 * @method     ChildTerritoriesQuery joinWithOnBoardRequest($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OnBoardRequest relation
 *
 * @method     ChildTerritoriesQuery leftJoinWithOnBoardRequest() Adds a LEFT JOIN clause and with to the query using the OnBoardRequest relation
 * @method     ChildTerritoriesQuery rightJoinWithOnBoardRequest() Adds a RIGHT JOIN clause and with to the query using the OnBoardRequest relation
 * @method     ChildTerritoriesQuery innerJoinWithOnBoardRequest() Adds a INNER JOIN clause and with to the query using the OnBoardRequest relation
 *
 * @method     ChildTerritoriesQuery leftJoinOrders($relationAlias = null) Adds a LEFT JOIN clause to the query using the Orders relation
 * @method     ChildTerritoriesQuery rightJoinOrders($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Orders relation
 * @method     ChildTerritoriesQuery innerJoinOrders($relationAlias = null) Adds a INNER JOIN clause to the query using the Orders relation
 *
 * @method     ChildTerritoriesQuery joinWithOrders($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Orders relation
 *
 * @method     ChildTerritoriesQuery leftJoinWithOrders() Adds a LEFT JOIN clause and with to the query using the Orders relation
 * @method     ChildTerritoriesQuery rightJoinWithOrders() Adds a RIGHT JOIN clause and with to the query using the Orders relation
 * @method     ChildTerritoriesQuery innerJoinWithOrders() Adds a INNER JOIN clause and with to the query using the Orders relation
 *
 * @method     ChildTerritoriesQuery leftJoinPrescriberData($relationAlias = null) Adds a LEFT JOIN clause to the query using the PrescriberData relation
 * @method     ChildTerritoriesQuery rightJoinPrescriberData($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PrescriberData relation
 * @method     ChildTerritoriesQuery innerJoinPrescriberData($relationAlias = null) Adds a INNER JOIN clause to the query using the PrescriberData relation
 *
 * @method     ChildTerritoriesQuery joinWithPrescriberData($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PrescriberData relation
 *
 * @method     ChildTerritoriesQuery leftJoinWithPrescriberData() Adds a LEFT JOIN clause and with to the query using the PrescriberData relation
 * @method     ChildTerritoriesQuery rightJoinWithPrescriberData() Adds a RIGHT JOIN clause and with to the query using the PrescriberData relation
 * @method     ChildTerritoriesQuery innerJoinWithPrescriberData() Adds a INNER JOIN clause and with to the query using the PrescriberData relation
 *
 * @method     ChildTerritoriesQuery leftJoinPrescriberTallySummary($relationAlias = null) Adds a LEFT JOIN clause to the query using the PrescriberTallySummary relation
 * @method     ChildTerritoriesQuery rightJoinPrescriberTallySummary($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PrescriberTallySummary relation
 * @method     ChildTerritoriesQuery innerJoinPrescriberTallySummary($relationAlias = null) Adds a INNER JOIN clause to the query using the PrescriberTallySummary relation
 *
 * @method     ChildTerritoriesQuery joinWithPrescriberTallySummary($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PrescriberTallySummary relation
 *
 * @method     ChildTerritoriesQuery leftJoinWithPrescriberTallySummary() Adds a LEFT JOIN clause and with to the query using the PrescriberTallySummary relation
 * @method     ChildTerritoriesQuery rightJoinWithPrescriberTallySummary() Adds a RIGHT JOIN clause and with to the query using the PrescriberTallySummary relation
 * @method     ChildTerritoriesQuery innerJoinWithPrescriberTallySummary() Adds a INNER JOIN clause and with to the query using the PrescriberTallySummary relation
 *
 * @method     ChildTerritoriesQuery leftJoinTerritoryTowns($relationAlias = null) Adds a LEFT JOIN clause to the query using the TerritoryTowns relation
 * @method     ChildTerritoriesQuery rightJoinTerritoryTowns($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TerritoryTowns relation
 * @method     ChildTerritoriesQuery innerJoinTerritoryTowns($relationAlias = null) Adds a INNER JOIN clause to the query using the TerritoryTowns relation
 *
 * @method     ChildTerritoriesQuery joinWithTerritoryTowns($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the TerritoryTowns relation
 *
 * @method     ChildTerritoriesQuery leftJoinWithTerritoryTowns() Adds a LEFT JOIN clause and with to the query using the TerritoryTowns relation
 * @method     ChildTerritoriesQuery rightJoinWithTerritoryTowns() Adds a RIGHT JOIN clause and with to the query using the TerritoryTowns relation
 * @method     ChildTerritoriesQuery innerJoinWithTerritoryTowns() Adds a INNER JOIN clause and with to the query using the TerritoryTowns relation
 *
 * @method     ChildTerritoriesQuery leftJoinStpWeek($relationAlias = null) Adds a LEFT JOIN clause to the query using the StpWeek relation
 * @method     ChildTerritoriesQuery rightJoinStpWeek($relationAlias = null) Adds a RIGHT JOIN clause to the query using the StpWeek relation
 * @method     ChildTerritoriesQuery innerJoinStpWeek($relationAlias = null) Adds a INNER JOIN clause to the query using the StpWeek relation
 *
 * @method     ChildTerritoriesQuery joinWithStpWeek($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the StpWeek relation
 *
 * @method     ChildTerritoriesQuery leftJoinWithStpWeek() Adds a LEFT JOIN clause and with to the query using the StpWeek relation
 * @method     ChildTerritoriesQuery rightJoinWithStpWeek() Adds a RIGHT JOIN clause and with to the query using the StpWeek relation
 * @method     ChildTerritoriesQuery innerJoinWithStpWeek() Adds a INNER JOIN clause and with to the query using the StpWeek relation
 *
 * @method     \entities\CompanyQuery|\entities\OrgUnitQuery|\entities\PositionsQuery|\entities\BeatsQuery|\entities\OnBoardRequestQuery|\entities\OrdersQuery|\entities\PrescriberDataQuery|\entities\PrescriberTallySummaryQuery|\entities\TerritoryTownsQuery|\entities\StpWeekQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildTerritories|null findOne(?ConnectionInterface $con = null) Return the first ChildTerritories matching the query
 * @method     ChildTerritories findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildTerritories matching the query, or a new ChildTerritories object populated from the query conditions when no match is found
 *
 * @method     ChildTerritories|null findOneByTerritoryId(int $territory_id) Return the first ChildTerritories filtered by the territory_id column
 * @method     ChildTerritories|null findOneByTerritoryCode(string $territory_code) Return the first ChildTerritories filtered by the territory_code column
 * @method     ChildTerritories|null findOneByCompanyId(int $company_id) Return the first ChildTerritories filtered by the company_id column
 * @method     ChildTerritories|null findOneByTerritoryName(string $territory_name) Return the first ChildTerritories filtered by the territory_name column
 * @method     ChildTerritories|null findOneByOrgunitid(int $orgunitid) Return the first ChildTerritories filtered by the orgunitid column
 * @method     ChildTerritories|null findOneByPositionId(int $position_id) Return the first ChildTerritories filtered by the position_id column
 * @method     ChildTerritories|null findOneByCreatedAt(string $created_at) Return the first ChildTerritories filtered by the created_at column
 * @method     ChildTerritories|null findOneByUpdatedAt(string $updated_at) Return the first ChildTerritories filtered by the updated_at column
 * @method     ChildTerritories|null findOneByOnBoardingStatus(int $on_boarding_status) Return the first ChildTerritories filtered by the on_boarding_status column
 * @method     ChildTerritories|null findOneByStartDate(string $start_date) Return the first ChildTerritories filtered by the start_date column
 * @method     ChildTerritories|null findOneByEndDate(string $end_date) Return the first ChildTerritories filtered by the end_date column
 * @method     ChildTerritories|null findOneByIstateid(int $istateid) Return the first ChildTerritories filtered by the istateid column
 *
 * @method     ChildTerritories requirePk($key, ?ConnectionInterface $con = null) Return the ChildTerritories by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTerritories requireOne(?ConnectionInterface $con = null) Return the first ChildTerritories matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTerritories requireOneByTerritoryId(int $territory_id) Return the first ChildTerritories filtered by the territory_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTerritories requireOneByTerritoryCode(string $territory_code) Return the first ChildTerritories filtered by the territory_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTerritories requireOneByCompanyId(int $company_id) Return the first ChildTerritories filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTerritories requireOneByTerritoryName(string $territory_name) Return the first ChildTerritories filtered by the territory_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTerritories requireOneByOrgunitid(int $orgunitid) Return the first ChildTerritories filtered by the orgunitid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTerritories requireOneByPositionId(int $position_id) Return the first ChildTerritories filtered by the position_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTerritories requireOneByCreatedAt(string $created_at) Return the first ChildTerritories filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTerritories requireOneByUpdatedAt(string $updated_at) Return the first ChildTerritories filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTerritories requireOneByOnBoardingStatus(int $on_boarding_status) Return the first ChildTerritories filtered by the on_boarding_status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTerritories requireOneByStartDate(string $start_date) Return the first ChildTerritories filtered by the start_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTerritories requireOneByEndDate(string $end_date) Return the first ChildTerritories filtered by the end_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTerritories requireOneByIstateid(int $istateid) Return the first ChildTerritories filtered by the istateid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTerritories[]|Collection find(?ConnectionInterface $con = null) Return ChildTerritories objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildTerritories> find(?ConnectionInterface $con = null) Return ChildTerritories objects based on current ModelCriteria
 *
 * @method     ChildTerritories[]|Collection findByTerritoryId(int|array<int> $territory_id) Return ChildTerritories objects filtered by the territory_id column
 * @psalm-method Collection&\Traversable<ChildTerritories> findByTerritoryId(int|array<int> $territory_id) Return ChildTerritories objects filtered by the territory_id column
 * @method     ChildTerritories[]|Collection findByTerritoryCode(string|array<string> $territory_code) Return ChildTerritories objects filtered by the territory_code column
 * @psalm-method Collection&\Traversable<ChildTerritories> findByTerritoryCode(string|array<string> $territory_code) Return ChildTerritories objects filtered by the territory_code column
 * @method     ChildTerritories[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildTerritories objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildTerritories> findByCompanyId(int|array<int> $company_id) Return ChildTerritories objects filtered by the company_id column
 * @method     ChildTerritories[]|Collection findByTerritoryName(string|array<string> $territory_name) Return ChildTerritories objects filtered by the territory_name column
 * @psalm-method Collection&\Traversable<ChildTerritories> findByTerritoryName(string|array<string> $territory_name) Return ChildTerritories objects filtered by the territory_name column
 * @method     ChildTerritories[]|Collection findByOrgunitid(int|array<int> $orgunitid) Return ChildTerritories objects filtered by the orgunitid column
 * @psalm-method Collection&\Traversable<ChildTerritories> findByOrgunitid(int|array<int> $orgunitid) Return ChildTerritories objects filtered by the orgunitid column
 * @method     ChildTerritories[]|Collection findByPositionId(int|array<int> $position_id) Return ChildTerritories objects filtered by the position_id column
 * @psalm-method Collection&\Traversable<ChildTerritories> findByPositionId(int|array<int> $position_id) Return ChildTerritories objects filtered by the position_id column
 * @method     ChildTerritories[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildTerritories objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildTerritories> findByCreatedAt(string|array<string> $created_at) Return ChildTerritories objects filtered by the created_at column
 * @method     ChildTerritories[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildTerritories objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildTerritories> findByUpdatedAt(string|array<string> $updated_at) Return ChildTerritories objects filtered by the updated_at column
 * @method     ChildTerritories[]|Collection findByOnBoardingStatus(int|array<int> $on_boarding_status) Return ChildTerritories objects filtered by the on_boarding_status column
 * @psalm-method Collection&\Traversable<ChildTerritories> findByOnBoardingStatus(int|array<int> $on_boarding_status) Return ChildTerritories objects filtered by the on_boarding_status column
 * @method     ChildTerritories[]|Collection findByStartDate(string|array<string> $start_date) Return ChildTerritories objects filtered by the start_date column
 * @psalm-method Collection&\Traversable<ChildTerritories> findByStartDate(string|array<string> $start_date) Return ChildTerritories objects filtered by the start_date column
 * @method     ChildTerritories[]|Collection findByEndDate(string|array<string> $end_date) Return ChildTerritories objects filtered by the end_date column
 * @psalm-method Collection&\Traversable<ChildTerritories> findByEndDate(string|array<string> $end_date) Return ChildTerritories objects filtered by the end_date column
 * @method     ChildTerritories[]|Collection findByIstateid(int|array<int> $istateid) Return ChildTerritories objects filtered by the istateid column
 * @psalm-method Collection&\Traversable<ChildTerritories> findByIstateid(int|array<int> $istateid) Return ChildTerritories objects filtered by the istateid column
 *
 * @method     ChildTerritories[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildTerritories> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class TerritoriesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\TerritoriesQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\Territories', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildTerritoriesQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildTerritoriesQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildTerritoriesQuery) {
            return $criteria;
        }
        $query = new ChildTerritoriesQuery();
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
     * @return ChildTerritories|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(TerritoriesTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = TerritoriesTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildTerritories A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT territory_id, territory_code, company_id, territory_name, orgunitid, position_id, created_at, updated_at, on_boarding_status, start_date, end_date, istateid FROM territories WHERE territory_id = :p0';
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
            /** @var ChildTerritories $obj */
            $obj = new ChildTerritories();
            $obj->hydrate($row);
            TerritoriesTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildTerritories|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(TerritoriesTableMap::COL_TERRITORY_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(TerritoriesTableMap::COL_TERRITORY_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(TerritoriesTableMap::COL_TERRITORY_ID, $territoryId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($territoryId['max'])) {
                $this->addUsingAlias(TerritoriesTableMap::COL_TERRITORY_ID, $territoryId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TerritoriesTableMap::COL_TERRITORY_ID, $territoryId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the territory_code column
     *
     * Example usage:
     * <code>
     * $query->filterByTerritoryCode('fooValue');   // WHERE territory_code = 'fooValue'
     * $query->filterByTerritoryCode('%fooValue%', Criteria::LIKE); // WHERE territory_code LIKE '%fooValue%'
     * $query->filterByTerritoryCode(['foo', 'bar']); // WHERE territory_code IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $territoryCode The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTerritoryCode($territoryCode = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($territoryCode)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TerritoriesTableMap::COL_TERRITORY_CODE, $territoryCode, $comparison);

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
                $this->addUsingAlias(TerritoriesTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(TerritoriesTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TerritoriesTableMap::COL_COMPANY_ID, $companyId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the territory_name column
     *
     * Example usage:
     * <code>
     * $query->filterByTerritoryName('fooValue');   // WHERE territory_name = 'fooValue'
     * $query->filterByTerritoryName('%fooValue%', Criteria::LIKE); // WHERE territory_name LIKE '%fooValue%'
     * $query->filterByTerritoryName(['foo', 'bar']); // WHERE territory_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $territoryName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTerritoryName($territoryName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($territoryName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TerritoriesTableMap::COL_TERRITORY_NAME, $territoryName, $comparison);

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
     * @see       filterByOrgUnit()
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
                $this->addUsingAlias(TerritoriesTableMap::COL_ORGUNITID, $orgunitid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($orgunitid['max'])) {
                $this->addUsingAlias(TerritoriesTableMap::COL_ORGUNITID, $orgunitid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TerritoriesTableMap::COL_ORGUNITID, $orgunitid, $comparison);

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
     * @see       filterByPositions()
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
                $this->addUsingAlias(TerritoriesTableMap::COL_POSITION_ID, $positionId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($positionId['max'])) {
                $this->addUsingAlias(TerritoriesTableMap::COL_POSITION_ID, $positionId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TerritoriesTableMap::COL_POSITION_ID, $positionId, $comparison);

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
                $this->addUsingAlias(TerritoriesTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(TerritoriesTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TerritoriesTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(TerritoriesTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(TerritoriesTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TerritoriesTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the on_boarding_status column
     *
     * Example usage:
     * <code>
     * $query->filterByOnBoardingStatus(1234); // WHERE on_boarding_status = 1234
     * $query->filterByOnBoardingStatus(array(12, 34)); // WHERE on_boarding_status IN (12, 34)
     * $query->filterByOnBoardingStatus(array('min' => 12)); // WHERE on_boarding_status > 12
     * </code>
     *
     * @param mixed $onBoardingStatus The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOnBoardingStatus($onBoardingStatus = null, ?string $comparison = null)
    {
        if (is_array($onBoardingStatus)) {
            $useMinMax = false;
            if (isset($onBoardingStatus['min'])) {
                $this->addUsingAlias(TerritoriesTableMap::COL_ON_BOARDING_STATUS, $onBoardingStatus['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($onBoardingStatus['max'])) {
                $this->addUsingAlias(TerritoriesTableMap::COL_ON_BOARDING_STATUS, $onBoardingStatus['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TerritoriesTableMap::COL_ON_BOARDING_STATUS, $onBoardingStatus, $comparison);

        return $this;
    }

    /**
     * Filter the query on the start_date column
     *
     * Example usage:
     * <code>
     * $query->filterByStartDate('2011-03-14'); // WHERE start_date = '2011-03-14'
     * $query->filterByStartDate('now'); // WHERE start_date = '2011-03-14'
     * $query->filterByStartDate(array('max' => 'yesterday')); // WHERE start_date > '2011-03-13'
     * </code>
     *
     * @param mixed $startDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStartDate($startDate = null, ?string $comparison = null)
    {
        if (is_array($startDate)) {
            $useMinMax = false;
            if (isset($startDate['min'])) {
                $this->addUsingAlias(TerritoriesTableMap::COL_START_DATE, $startDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($startDate['max'])) {
                $this->addUsingAlias(TerritoriesTableMap::COL_START_DATE, $startDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TerritoriesTableMap::COL_START_DATE, $startDate, $comparison);

        return $this;
    }

    /**
     * Filter the query on the end_date column
     *
     * Example usage:
     * <code>
     * $query->filterByEndDate('2011-03-14'); // WHERE end_date = '2011-03-14'
     * $query->filterByEndDate('now'); // WHERE end_date = '2011-03-14'
     * $query->filterByEndDate(array('max' => 'yesterday')); // WHERE end_date > '2011-03-13'
     * </code>
     *
     * @param mixed $endDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEndDate($endDate = null, ?string $comparison = null)
    {
        if (is_array($endDate)) {
            $useMinMax = false;
            if (isset($endDate['min'])) {
                $this->addUsingAlias(TerritoriesTableMap::COL_END_DATE, $endDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($endDate['max'])) {
                $this->addUsingAlias(TerritoriesTableMap::COL_END_DATE, $endDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TerritoriesTableMap::COL_END_DATE, $endDate, $comparison);

        return $this;
    }

    /**
     * Filter the query on the istateid column
     *
     * Example usage:
     * <code>
     * $query->filterByIstateid(1234); // WHERE istateid = 1234
     * $query->filterByIstateid(array(12, 34)); // WHERE istateid IN (12, 34)
     * $query->filterByIstateid(array('min' => 12)); // WHERE istateid > 12
     * </code>
     *
     * @param mixed $istateid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIstateid($istateid = null, ?string $comparison = null)
    {
        if (is_array($istateid)) {
            $useMinMax = false;
            if (isset($istateid['min'])) {
                $this->addUsingAlias(TerritoriesTableMap::COL_ISTATEID, $istateid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($istateid['max'])) {
                $this->addUsingAlias(TerritoriesTableMap::COL_ISTATEID, $istateid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TerritoriesTableMap::COL_ISTATEID, $istateid, $comparison);

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
                ->addUsingAlias(TerritoriesTableMap::COL_COMPANY_ID, $company->getCompanyId(), $comparison);
        } elseif ($company instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(TerritoriesTableMap::COL_COMPANY_ID, $company->toKeyValue('PrimaryKey', 'CompanyId'), $comparison);

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
                ->addUsingAlias(TerritoriesTableMap::COL_ORGUNITID, $orgUnit->getOrgunitid(), $comparison);
        } elseif ($orgUnit instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(TerritoriesTableMap::COL_ORGUNITID, $orgUnit->toKeyValue('PrimaryKey', 'Orgunitid'), $comparison);

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
     * Filter the query by a related \entities\Positions object
     *
     * @param \entities\Positions|ObjectCollection $positions The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPositions($positions, ?string $comparison = null)
    {
        if ($positions instanceof \entities\Positions) {
            return $this
                ->addUsingAlias(TerritoriesTableMap::COL_POSITION_ID, $positions->getPositionId(), $comparison);
        } elseif ($positions instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(TerritoriesTableMap::COL_POSITION_ID, $positions->toKeyValue('PrimaryKey', 'PositionId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByPositions() only accepts arguments of type \entities\Positions or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Positions relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinPositions(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Positions');

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
            $this->addJoinObject($join, 'Positions');
        }

        return $this;
    }

    /**
     * Use the Positions relation Positions object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\PositionsQuery A secondary query class using the current class as primary query
     */
    public function usePositionsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinPositions($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Positions', '\entities\PositionsQuery');
    }

    /**
     * Use the Positions relation Positions object
     *
     * @param callable(\entities\PositionsQuery):\entities\PositionsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withPositionsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->usePositionsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Positions table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\PositionsQuery The inner query object of the EXISTS statement
     */
    public function usePositionsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\PositionsQuery */
        $q = $this->useExistsQuery('Positions', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Positions table for a NOT EXISTS query.
     *
     * @see usePositionsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\PositionsQuery The inner query object of the NOT EXISTS statement
     */
    public function usePositionsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\PositionsQuery */
        $q = $this->useExistsQuery('Positions', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Positions table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\PositionsQuery The inner query object of the IN statement
     */
    public function useInPositionsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\PositionsQuery */
        $q = $this->useInQuery('Positions', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Positions table for a NOT IN query.
     *
     * @see usePositionsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\PositionsQuery The inner query object of the NOT IN statement
     */
    public function useNotInPositionsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\PositionsQuery */
        $q = $this->useInQuery('Positions', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\Beats object
     *
     * @param \entities\Beats|ObjectCollection $beats the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBeats($beats, ?string $comparison = null)
    {
        if ($beats instanceof \entities\Beats) {
            $this
                ->addUsingAlias(TerritoriesTableMap::COL_TERRITORY_ID, $beats->getTerritoryId(), $comparison);

            return $this;
        } elseif ($beats instanceof ObjectCollection) {
            $this
                ->useBeatsQuery()
                ->filterByPrimaryKeys($beats->getPrimaryKeys())
                ->endUse();

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
    public function joinBeats(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
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
    public function useBeatsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
        ?string $joinType = Criteria::LEFT_JOIN
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
     * Filter the query by a related \entities\OnBoardRequest object
     *
     * @param \entities\OnBoardRequest|ObjectCollection $onBoardRequest the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOnBoardRequest($onBoardRequest, ?string $comparison = null)
    {
        if ($onBoardRequest instanceof \entities\OnBoardRequest) {
            $this
                ->addUsingAlias(TerritoriesTableMap::COL_TERRITORY_ID, $onBoardRequest->getTerritory(), $comparison);

            return $this;
        } elseif ($onBoardRequest instanceof ObjectCollection) {
            $this
                ->useOnBoardRequestQuery()
                ->filterByPrimaryKeys($onBoardRequest->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByOnBoardRequest() only accepts arguments of type \entities\OnBoardRequest or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OnBoardRequest relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOnBoardRequest(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OnBoardRequest');

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
            $this->addJoinObject($join, 'OnBoardRequest');
        }

        return $this;
    }

    /**
     * Use the OnBoardRequest relation OnBoardRequest object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\OnBoardRequestQuery A secondary query class using the current class as primary query
     */
    public function useOnBoardRequestQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinOnBoardRequest($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OnBoardRequest', '\entities\OnBoardRequestQuery');
    }

    /**
     * Use the OnBoardRequest relation OnBoardRequest object
     *
     * @param callable(\entities\OnBoardRequestQuery):\entities\OnBoardRequestQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOnBoardRequestQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useOnBoardRequestQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to OnBoardRequest table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\OnBoardRequestQuery The inner query object of the EXISTS statement
     */
    public function useOnBoardRequestExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\OnBoardRequestQuery */
        $q = $this->useExistsQuery('OnBoardRequest', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to OnBoardRequest table for a NOT EXISTS query.
     *
     * @see useOnBoardRequestExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\OnBoardRequestQuery The inner query object of the NOT EXISTS statement
     */
    public function useOnBoardRequestNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OnBoardRequestQuery */
        $q = $this->useExistsQuery('OnBoardRequest', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to OnBoardRequest table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\OnBoardRequestQuery The inner query object of the IN statement
     */
    public function useInOnBoardRequestQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\OnBoardRequestQuery */
        $q = $this->useInQuery('OnBoardRequest', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to OnBoardRequest table for a NOT IN query.
     *
     * @see useOnBoardRequestInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\OnBoardRequestQuery The inner query object of the NOT IN statement
     */
    public function useNotInOnBoardRequestQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OnBoardRequestQuery */
        $q = $this->useInQuery('OnBoardRequest', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(TerritoriesTableMap::COL_TERRITORY_ID, $orders->getTerritoryId(), $comparison);

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
     * Filter the query by a related \entities\PrescriberData object
     *
     * @param \entities\PrescriberData|ObjectCollection $prescriberData the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrescriberData($prescriberData, ?string $comparison = null)
    {
        if ($prescriberData instanceof \entities\PrescriberData) {
            $this
                ->addUsingAlias(TerritoriesTableMap::COL_TERRITORY_ID, $prescriberData->getTerritoryId(), $comparison);

            return $this;
        } elseif ($prescriberData instanceof ObjectCollection) {
            $this
                ->usePrescriberDataQuery()
                ->filterByPrimaryKeys($prescriberData->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByPrescriberData() only accepts arguments of type \entities\PrescriberData or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PrescriberData relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinPrescriberData(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PrescriberData');

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
            $this->addJoinObject($join, 'PrescriberData');
        }

        return $this;
    }

    /**
     * Use the PrescriberData relation PrescriberData object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\PrescriberDataQuery A secondary query class using the current class as primary query
     */
    public function usePrescriberDataQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPrescriberData($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PrescriberData', '\entities\PrescriberDataQuery');
    }

    /**
     * Use the PrescriberData relation PrescriberData object
     *
     * @param callable(\entities\PrescriberDataQuery):\entities\PrescriberDataQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withPrescriberDataQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->usePrescriberDataQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to PrescriberData table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\PrescriberDataQuery The inner query object of the EXISTS statement
     */
    public function usePrescriberDataExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\PrescriberDataQuery */
        $q = $this->useExistsQuery('PrescriberData', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to PrescriberData table for a NOT EXISTS query.
     *
     * @see usePrescriberDataExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\PrescriberDataQuery The inner query object of the NOT EXISTS statement
     */
    public function usePrescriberDataNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\PrescriberDataQuery */
        $q = $this->useExistsQuery('PrescriberData', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to PrescriberData table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\PrescriberDataQuery The inner query object of the IN statement
     */
    public function useInPrescriberDataQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\PrescriberDataQuery */
        $q = $this->useInQuery('PrescriberData', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to PrescriberData table for a NOT IN query.
     *
     * @see usePrescriberDataInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\PrescriberDataQuery The inner query object of the NOT IN statement
     */
    public function useNotInPrescriberDataQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\PrescriberDataQuery */
        $q = $this->useInQuery('PrescriberData', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\PrescriberTallySummary object
     *
     * @param \entities\PrescriberTallySummary|ObjectCollection $prescriberTallySummary the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrescriberTallySummary($prescriberTallySummary, ?string $comparison = null)
    {
        if ($prescriberTallySummary instanceof \entities\PrescriberTallySummary) {
            $this
                ->addUsingAlias(TerritoriesTableMap::COL_TERRITORY_ID, $prescriberTallySummary->getTerritoryId(), $comparison);

            return $this;
        } elseif ($prescriberTallySummary instanceof ObjectCollection) {
            $this
                ->usePrescriberTallySummaryQuery()
                ->filterByPrimaryKeys($prescriberTallySummary->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByPrescriberTallySummary() only accepts arguments of type \entities\PrescriberTallySummary or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PrescriberTallySummary relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinPrescriberTallySummary(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PrescriberTallySummary');

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
            $this->addJoinObject($join, 'PrescriberTallySummary');
        }

        return $this;
    }

    /**
     * Use the PrescriberTallySummary relation PrescriberTallySummary object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\PrescriberTallySummaryQuery A secondary query class using the current class as primary query
     */
    public function usePrescriberTallySummaryQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPrescriberTallySummary($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PrescriberTallySummary', '\entities\PrescriberTallySummaryQuery');
    }

    /**
     * Use the PrescriberTallySummary relation PrescriberTallySummary object
     *
     * @param callable(\entities\PrescriberTallySummaryQuery):\entities\PrescriberTallySummaryQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withPrescriberTallySummaryQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->usePrescriberTallySummaryQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to PrescriberTallySummary table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\PrescriberTallySummaryQuery The inner query object of the EXISTS statement
     */
    public function usePrescriberTallySummaryExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\PrescriberTallySummaryQuery */
        $q = $this->useExistsQuery('PrescriberTallySummary', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to PrescriberTallySummary table for a NOT EXISTS query.
     *
     * @see usePrescriberTallySummaryExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\PrescriberTallySummaryQuery The inner query object of the NOT EXISTS statement
     */
    public function usePrescriberTallySummaryNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\PrescriberTallySummaryQuery */
        $q = $this->useExistsQuery('PrescriberTallySummary', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to PrescriberTallySummary table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\PrescriberTallySummaryQuery The inner query object of the IN statement
     */
    public function useInPrescriberTallySummaryQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\PrescriberTallySummaryQuery */
        $q = $this->useInQuery('PrescriberTallySummary', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to PrescriberTallySummary table for a NOT IN query.
     *
     * @see usePrescriberTallySummaryInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\PrescriberTallySummaryQuery The inner query object of the NOT IN statement
     */
    public function useNotInPrescriberTallySummaryQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\PrescriberTallySummaryQuery */
        $q = $this->useInQuery('PrescriberTallySummary', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\TerritoryTowns object
     *
     * @param \entities\TerritoryTowns|ObjectCollection $territoryTowns the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTerritoryTowns($territoryTowns, ?string $comparison = null)
    {
        if ($territoryTowns instanceof \entities\TerritoryTowns) {
            $this
                ->addUsingAlias(TerritoriesTableMap::COL_TERRITORY_ID, $territoryTowns->getTerritoryId(), $comparison);

            return $this;
        } elseif ($territoryTowns instanceof ObjectCollection) {
            $this
                ->useTerritoryTownsQuery()
                ->filterByPrimaryKeys($territoryTowns->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByTerritoryTowns() only accepts arguments of type \entities\TerritoryTowns or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TerritoryTowns relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinTerritoryTowns(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TerritoryTowns');

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
            $this->addJoinObject($join, 'TerritoryTowns');
        }

        return $this;
    }

    /**
     * Use the TerritoryTowns relation TerritoryTowns object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\TerritoryTownsQuery A secondary query class using the current class as primary query
     */
    public function useTerritoryTownsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTerritoryTowns($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TerritoryTowns', '\entities\TerritoryTownsQuery');
    }

    /**
     * Use the TerritoryTowns relation TerritoryTowns object
     *
     * @param callable(\entities\TerritoryTownsQuery):\entities\TerritoryTownsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withTerritoryTownsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useTerritoryTownsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to TerritoryTowns table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\TerritoryTownsQuery The inner query object of the EXISTS statement
     */
    public function useTerritoryTownsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\TerritoryTownsQuery */
        $q = $this->useExistsQuery('TerritoryTowns', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to TerritoryTowns table for a NOT EXISTS query.
     *
     * @see useTerritoryTownsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\TerritoryTownsQuery The inner query object of the NOT EXISTS statement
     */
    public function useTerritoryTownsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\TerritoryTownsQuery */
        $q = $this->useExistsQuery('TerritoryTowns', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to TerritoryTowns table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\TerritoryTownsQuery The inner query object of the IN statement
     */
    public function useInTerritoryTownsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\TerritoryTownsQuery */
        $q = $this->useInQuery('TerritoryTowns', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to TerritoryTowns table for a NOT IN query.
     *
     * @see useTerritoryTownsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\TerritoryTownsQuery The inner query object of the NOT IN statement
     */
    public function useNotInTerritoryTownsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\TerritoryTownsQuery */
        $q = $this->useInQuery('TerritoryTowns', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(TerritoriesTableMap::COL_TERRITORY_ID, $stpWeek->getTerritoryId(), $comparison);

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
     * @param ChildTerritories $territories Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($territories = null)
    {
        if ($territories) {
            $this->addUsingAlias(TerritoriesTableMap::COL_TERRITORY_ID, $territories->getTerritoryId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the territories table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(TerritoriesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            TerritoriesTableMap::clearInstancePool();
            TerritoriesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(TerritoriesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(TerritoriesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            TerritoriesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            TerritoriesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
