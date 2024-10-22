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
use entities\PrescriberData as ChildPrescriberData;
use entities\PrescriberDataQuery as ChildPrescriberDataQuery;
use entities\Map\PrescriberDataTableMap;

/**
 * Base class that represents a query for the `prescriber_data` table.
 *
 * @method     ChildPrescriberDataQuery orderByPrescriberTallyDataId($order = Criteria::ASC) Order by the prescriber_tally_data_id column
 * @method     ChildPrescriberDataQuery orderByOrgunitId($order = Criteria::ASC) Order by the orgunit_id column
 * @method     ChildPrescriberDataQuery orderByPositionId($order = Criteria::ASC) Order by the position_id column
 * @method     ChildPrescriberDataQuery orderByTerritoryId($order = Criteria::ASC) Order by the territory_id column
 * @method     ChildPrescriberDataQuery orderByOutletOrgId($order = Criteria::ASC) Order by the outlet_org_id column
 * @method     ChildPrescriberDataQuery orderByBrandId($order = Criteria::ASC) Order by the brand_id column
 * @method     ChildPrescriberDataQuery orderByMoye($order = Criteria::ASC) Order by the moye column
 * @method     ChildPrescriberDataQuery orderByCutOff($order = Criteria::ASC) Order by the cut_off column
 * @method     ChildPrescriberDataQuery orderByLmRcpaValue($order = Criteria::ASC) Order by the lm_rcpa_value column
 * @method     ChildPrescriberDataQuery orderByCmRcpaValue($order = Criteria::ASC) Order by the cm_rcpa_value column
 * @method     ChildPrescriberDataQuery orderByLmVisit($order = Criteria::ASC) Order by the lm_visit column
 * @method     ChildPrescriberDataQuery orderByCmVisit($order = Criteria::ASC) Order by the cm_visit column
 * @method     ChildPrescriberDataQuery orderByLmRcpa($order = Criteria::ASC) Order by the lm_rcpa column
 * @method     ChildPrescriberDataQuery orderByCmRcpa($order = Criteria::ASC) Order by the cm_rcpa column
 * @method     ChildPrescriberDataQuery orderByCmRxberCat($order = Criteria::ASC) Order by the cm_rxber_cat column
 * @method     ChildPrescriberDataQuery orderByComputeDate($order = Criteria::ASC) Order by the compute_date column
 * @method     ChildPrescriberDataQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildPrescriberDataQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildPrescriberDataQuery groupByPrescriberTallyDataId() Group by the prescriber_tally_data_id column
 * @method     ChildPrescriberDataQuery groupByOrgunitId() Group by the orgunit_id column
 * @method     ChildPrescriberDataQuery groupByPositionId() Group by the position_id column
 * @method     ChildPrescriberDataQuery groupByTerritoryId() Group by the territory_id column
 * @method     ChildPrescriberDataQuery groupByOutletOrgId() Group by the outlet_org_id column
 * @method     ChildPrescriberDataQuery groupByBrandId() Group by the brand_id column
 * @method     ChildPrescriberDataQuery groupByMoye() Group by the moye column
 * @method     ChildPrescriberDataQuery groupByCutOff() Group by the cut_off column
 * @method     ChildPrescriberDataQuery groupByLmRcpaValue() Group by the lm_rcpa_value column
 * @method     ChildPrescriberDataQuery groupByCmRcpaValue() Group by the cm_rcpa_value column
 * @method     ChildPrescriberDataQuery groupByLmVisit() Group by the lm_visit column
 * @method     ChildPrescriberDataQuery groupByCmVisit() Group by the cm_visit column
 * @method     ChildPrescriberDataQuery groupByLmRcpa() Group by the lm_rcpa column
 * @method     ChildPrescriberDataQuery groupByCmRcpa() Group by the cm_rcpa column
 * @method     ChildPrescriberDataQuery groupByCmRxberCat() Group by the cm_rxber_cat column
 * @method     ChildPrescriberDataQuery groupByComputeDate() Group by the compute_date column
 * @method     ChildPrescriberDataQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildPrescriberDataQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildPrescriberDataQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPrescriberDataQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPrescriberDataQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPrescriberDataQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildPrescriberDataQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildPrescriberDataQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildPrescriberDataQuery leftJoinOrgUnit($relationAlias = null) Adds a LEFT JOIN clause to the query using the OrgUnit relation
 * @method     ChildPrescriberDataQuery rightJoinOrgUnit($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OrgUnit relation
 * @method     ChildPrescriberDataQuery innerJoinOrgUnit($relationAlias = null) Adds a INNER JOIN clause to the query using the OrgUnit relation
 *
 * @method     ChildPrescriberDataQuery joinWithOrgUnit($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OrgUnit relation
 *
 * @method     ChildPrescriberDataQuery leftJoinWithOrgUnit() Adds a LEFT JOIN clause and with to the query using the OrgUnit relation
 * @method     ChildPrescriberDataQuery rightJoinWithOrgUnit() Adds a RIGHT JOIN clause and with to the query using the OrgUnit relation
 * @method     ChildPrescriberDataQuery innerJoinWithOrgUnit() Adds a INNER JOIN clause and with to the query using the OrgUnit relation
 *
 * @method     ChildPrescriberDataQuery leftJoinPositions($relationAlias = null) Adds a LEFT JOIN clause to the query using the Positions relation
 * @method     ChildPrescriberDataQuery rightJoinPositions($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Positions relation
 * @method     ChildPrescriberDataQuery innerJoinPositions($relationAlias = null) Adds a INNER JOIN clause to the query using the Positions relation
 *
 * @method     ChildPrescriberDataQuery joinWithPositions($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Positions relation
 *
 * @method     ChildPrescriberDataQuery leftJoinWithPositions() Adds a LEFT JOIN clause and with to the query using the Positions relation
 * @method     ChildPrescriberDataQuery rightJoinWithPositions() Adds a RIGHT JOIN clause and with to the query using the Positions relation
 * @method     ChildPrescriberDataQuery innerJoinWithPositions() Adds a INNER JOIN clause and with to the query using the Positions relation
 *
 * @method     ChildPrescriberDataQuery leftJoinTerritories($relationAlias = null) Adds a LEFT JOIN clause to the query using the Territories relation
 * @method     ChildPrescriberDataQuery rightJoinTerritories($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Territories relation
 * @method     ChildPrescriberDataQuery innerJoinTerritories($relationAlias = null) Adds a INNER JOIN clause to the query using the Territories relation
 *
 * @method     ChildPrescriberDataQuery joinWithTerritories($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Territories relation
 *
 * @method     ChildPrescriberDataQuery leftJoinWithTerritories() Adds a LEFT JOIN clause and with to the query using the Territories relation
 * @method     ChildPrescriberDataQuery rightJoinWithTerritories() Adds a RIGHT JOIN clause and with to the query using the Territories relation
 * @method     ChildPrescriberDataQuery innerJoinWithTerritories() Adds a INNER JOIN clause and with to the query using the Territories relation
 *
 * @method     ChildPrescriberDataQuery leftJoinOutletOrgData($relationAlias = null) Adds a LEFT JOIN clause to the query using the OutletOrgData relation
 * @method     ChildPrescriberDataQuery rightJoinOutletOrgData($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OutletOrgData relation
 * @method     ChildPrescriberDataQuery innerJoinOutletOrgData($relationAlias = null) Adds a INNER JOIN clause to the query using the OutletOrgData relation
 *
 * @method     ChildPrescriberDataQuery joinWithOutletOrgData($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OutletOrgData relation
 *
 * @method     ChildPrescriberDataQuery leftJoinWithOutletOrgData() Adds a LEFT JOIN clause and with to the query using the OutletOrgData relation
 * @method     ChildPrescriberDataQuery rightJoinWithOutletOrgData() Adds a RIGHT JOIN clause and with to the query using the OutletOrgData relation
 * @method     ChildPrescriberDataQuery innerJoinWithOutletOrgData() Adds a INNER JOIN clause and with to the query using the OutletOrgData relation
 *
 * @method     ChildPrescriberDataQuery leftJoinBrands($relationAlias = null) Adds a LEFT JOIN clause to the query using the Brands relation
 * @method     ChildPrescriberDataQuery rightJoinBrands($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Brands relation
 * @method     ChildPrescriberDataQuery innerJoinBrands($relationAlias = null) Adds a INNER JOIN clause to the query using the Brands relation
 *
 * @method     ChildPrescriberDataQuery joinWithBrands($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Brands relation
 *
 * @method     ChildPrescriberDataQuery leftJoinWithBrands() Adds a LEFT JOIN clause and with to the query using the Brands relation
 * @method     ChildPrescriberDataQuery rightJoinWithBrands() Adds a RIGHT JOIN clause and with to the query using the Brands relation
 * @method     ChildPrescriberDataQuery innerJoinWithBrands() Adds a INNER JOIN clause and with to the query using the Brands relation
 *
 * @method     \entities\OrgUnitQuery|\entities\PositionsQuery|\entities\TerritoriesQuery|\entities\OutletOrgDataQuery|\entities\BrandsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildPrescriberData|null findOne(?ConnectionInterface $con = null) Return the first ChildPrescriberData matching the query
 * @method     ChildPrescriberData findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildPrescriberData matching the query, or a new ChildPrescriberData object populated from the query conditions when no match is found
 *
 * @method     ChildPrescriberData|null findOneByPrescriberTallyDataId(int $prescriber_tally_data_id) Return the first ChildPrescriberData filtered by the prescriber_tally_data_id column
 * @method     ChildPrescriberData|null findOneByOrgunitId(int $orgunit_id) Return the first ChildPrescriberData filtered by the orgunit_id column
 * @method     ChildPrescriberData|null findOneByPositionId(int $position_id) Return the first ChildPrescriberData filtered by the position_id column
 * @method     ChildPrescriberData|null findOneByTerritoryId(int $territory_id) Return the first ChildPrescriberData filtered by the territory_id column
 * @method     ChildPrescriberData|null findOneByOutletOrgId(int $outlet_org_id) Return the first ChildPrescriberData filtered by the outlet_org_id column
 * @method     ChildPrescriberData|null findOneByBrandId(int $brand_id) Return the first ChildPrescriberData filtered by the brand_id column
 * @method     ChildPrescriberData|null findOneByMoye(string $moye) Return the first ChildPrescriberData filtered by the moye column
 * @method     ChildPrescriberData|null findOneByCutOff(int $cut_off) Return the first ChildPrescriberData filtered by the cut_off column
 * @method     ChildPrescriberData|null findOneByLmRcpaValue(int $lm_rcpa_value) Return the first ChildPrescriberData filtered by the lm_rcpa_value column
 * @method     ChildPrescriberData|null findOneByCmRcpaValue(int $cm_rcpa_value) Return the first ChildPrescriberData filtered by the cm_rcpa_value column
 * @method     ChildPrescriberData|null findOneByLmVisit(string $lm_visit) Return the first ChildPrescriberData filtered by the lm_visit column
 * @method     ChildPrescriberData|null findOneByCmVisit(string $cm_visit) Return the first ChildPrescriberData filtered by the cm_visit column
 * @method     ChildPrescriberData|null findOneByLmRcpa(string $lm_rcpa) Return the first ChildPrescriberData filtered by the lm_rcpa column
 * @method     ChildPrescriberData|null findOneByCmRcpa(string $cm_rcpa) Return the first ChildPrescriberData filtered by the cm_rcpa column
 * @method     ChildPrescriberData|null findOneByCmRxberCat(string $cm_rxber_cat) Return the first ChildPrescriberData filtered by the cm_rxber_cat column
 * @method     ChildPrescriberData|null findOneByComputeDate(string $compute_date) Return the first ChildPrescriberData filtered by the compute_date column
 * @method     ChildPrescriberData|null findOneByCreatedAt(string $created_at) Return the first ChildPrescriberData filtered by the created_at column
 * @method     ChildPrescriberData|null findOneByUpdatedAt(string $updated_at) Return the first ChildPrescriberData filtered by the updated_at column
 *
 * @method     ChildPrescriberData requirePk($key, ?ConnectionInterface $con = null) Return the ChildPrescriberData by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPrescriberData requireOne(?ConnectionInterface $con = null) Return the first ChildPrescriberData matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPrescriberData requireOneByPrescriberTallyDataId(int $prescriber_tally_data_id) Return the first ChildPrescriberData filtered by the prescriber_tally_data_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPrescriberData requireOneByOrgunitId(int $orgunit_id) Return the first ChildPrescriberData filtered by the orgunit_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPrescriberData requireOneByPositionId(int $position_id) Return the first ChildPrescriberData filtered by the position_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPrescriberData requireOneByTerritoryId(int $territory_id) Return the first ChildPrescriberData filtered by the territory_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPrescriberData requireOneByOutletOrgId(int $outlet_org_id) Return the first ChildPrescriberData filtered by the outlet_org_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPrescriberData requireOneByBrandId(int $brand_id) Return the first ChildPrescriberData filtered by the brand_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPrescriberData requireOneByMoye(string $moye) Return the first ChildPrescriberData filtered by the moye column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPrescriberData requireOneByCutOff(int $cut_off) Return the first ChildPrescriberData filtered by the cut_off column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPrescriberData requireOneByLmRcpaValue(int $lm_rcpa_value) Return the first ChildPrescriberData filtered by the lm_rcpa_value column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPrescriberData requireOneByCmRcpaValue(int $cm_rcpa_value) Return the first ChildPrescriberData filtered by the cm_rcpa_value column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPrescriberData requireOneByLmVisit(string $lm_visit) Return the first ChildPrescriberData filtered by the lm_visit column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPrescriberData requireOneByCmVisit(string $cm_visit) Return the first ChildPrescriberData filtered by the cm_visit column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPrescriberData requireOneByLmRcpa(string $lm_rcpa) Return the first ChildPrescriberData filtered by the lm_rcpa column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPrescriberData requireOneByCmRcpa(string $cm_rcpa) Return the first ChildPrescriberData filtered by the cm_rcpa column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPrescriberData requireOneByCmRxberCat(string $cm_rxber_cat) Return the first ChildPrescriberData filtered by the cm_rxber_cat column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPrescriberData requireOneByComputeDate(string $compute_date) Return the first ChildPrescriberData filtered by the compute_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPrescriberData requireOneByCreatedAt(string $created_at) Return the first ChildPrescriberData filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPrescriberData requireOneByUpdatedAt(string $updated_at) Return the first ChildPrescriberData filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPrescriberData[]|Collection find(?ConnectionInterface $con = null) Return ChildPrescriberData objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildPrescriberData> find(?ConnectionInterface $con = null) Return ChildPrescriberData objects based on current ModelCriteria
 *
 * @method     ChildPrescriberData[]|Collection findByPrescriberTallyDataId(int|array<int> $prescriber_tally_data_id) Return ChildPrescriberData objects filtered by the prescriber_tally_data_id column
 * @psalm-method Collection&\Traversable<ChildPrescriberData> findByPrescriberTallyDataId(int|array<int> $prescriber_tally_data_id) Return ChildPrescriberData objects filtered by the prescriber_tally_data_id column
 * @method     ChildPrescriberData[]|Collection findByOrgunitId(int|array<int> $orgunit_id) Return ChildPrescriberData objects filtered by the orgunit_id column
 * @psalm-method Collection&\Traversable<ChildPrescriberData> findByOrgunitId(int|array<int> $orgunit_id) Return ChildPrescriberData objects filtered by the orgunit_id column
 * @method     ChildPrescriberData[]|Collection findByPositionId(int|array<int> $position_id) Return ChildPrescriberData objects filtered by the position_id column
 * @psalm-method Collection&\Traversable<ChildPrescriberData> findByPositionId(int|array<int> $position_id) Return ChildPrescriberData objects filtered by the position_id column
 * @method     ChildPrescriberData[]|Collection findByTerritoryId(int|array<int> $territory_id) Return ChildPrescriberData objects filtered by the territory_id column
 * @psalm-method Collection&\Traversable<ChildPrescriberData> findByTerritoryId(int|array<int> $territory_id) Return ChildPrescriberData objects filtered by the territory_id column
 * @method     ChildPrescriberData[]|Collection findByOutletOrgId(int|array<int> $outlet_org_id) Return ChildPrescriberData objects filtered by the outlet_org_id column
 * @psalm-method Collection&\Traversable<ChildPrescriberData> findByOutletOrgId(int|array<int> $outlet_org_id) Return ChildPrescriberData objects filtered by the outlet_org_id column
 * @method     ChildPrescriberData[]|Collection findByBrandId(int|array<int> $brand_id) Return ChildPrescriberData objects filtered by the brand_id column
 * @psalm-method Collection&\Traversable<ChildPrescriberData> findByBrandId(int|array<int> $brand_id) Return ChildPrescriberData objects filtered by the brand_id column
 * @method     ChildPrescriberData[]|Collection findByMoye(string|array<string> $moye) Return ChildPrescriberData objects filtered by the moye column
 * @psalm-method Collection&\Traversable<ChildPrescriberData> findByMoye(string|array<string> $moye) Return ChildPrescriberData objects filtered by the moye column
 * @method     ChildPrescriberData[]|Collection findByCutOff(int|array<int> $cut_off) Return ChildPrescriberData objects filtered by the cut_off column
 * @psalm-method Collection&\Traversable<ChildPrescriberData> findByCutOff(int|array<int> $cut_off) Return ChildPrescriberData objects filtered by the cut_off column
 * @method     ChildPrescriberData[]|Collection findByLmRcpaValue(int|array<int> $lm_rcpa_value) Return ChildPrescriberData objects filtered by the lm_rcpa_value column
 * @psalm-method Collection&\Traversable<ChildPrescriberData> findByLmRcpaValue(int|array<int> $lm_rcpa_value) Return ChildPrescriberData objects filtered by the lm_rcpa_value column
 * @method     ChildPrescriberData[]|Collection findByCmRcpaValue(int|array<int> $cm_rcpa_value) Return ChildPrescriberData objects filtered by the cm_rcpa_value column
 * @psalm-method Collection&\Traversable<ChildPrescriberData> findByCmRcpaValue(int|array<int> $cm_rcpa_value) Return ChildPrescriberData objects filtered by the cm_rcpa_value column
 * @method     ChildPrescriberData[]|Collection findByLmVisit(string|array<string> $lm_visit) Return ChildPrescriberData objects filtered by the lm_visit column
 * @psalm-method Collection&\Traversable<ChildPrescriberData> findByLmVisit(string|array<string> $lm_visit) Return ChildPrescriberData objects filtered by the lm_visit column
 * @method     ChildPrescriberData[]|Collection findByCmVisit(string|array<string> $cm_visit) Return ChildPrescriberData objects filtered by the cm_visit column
 * @psalm-method Collection&\Traversable<ChildPrescriberData> findByCmVisit(string|array<string> $cm_visit) Return ChildPrescriberData objects filtered by the cm_visit column
 * @method     ChildPrescriberData[]|Collection findByLmRcpa(string|array<string> $lm_rcpa) Return ChildPrescriberData objects filtered by the lm_rcpa column
 * @psalm-method Collection&\Traversable<ChildPrescriberData> findByLmRcpa(string|array<string> $lm_rcpa) Return ChildPrescriberData objects filtered by the lm_rcpa column
 * @method     ChildPrescriberData[]|Collection findByCmRcpa(string|array<string> $cm_rcpa) Return ChildPrescriberData objects filtered by the cm_rcpa column
 * @psalm-method Collection&\Traversable<ChildPrescriberData> findByCmRcpa(string|array<string> $cm_rcpa) Return ChildPrescriberData objects filtered by the cm_rcpa column
 * @method     ChildPrescriberData[]|Collection findByCmRxberCat(string|array<string> $cm_rxber_cat) Return ChildPrescriberData objects filtered by the cm_rxber_cat column
 * @psalm-method Collection&\Traversable<ChildPrescriberData> findByCmRxberCat(string|array<string> $cm_rxber_cat) Return ChildPrescriberData objects filtered by the cm_rxber_cat column
 * @method     ChildPrescriberData[]|Collection findByComputeDate(string|array<string> $compute_date) Return ChildPrescriberData objects filtered by the compute_date column
 * @psalm-method Collection&\Traversable<ChildPrescriberData> findByComputeDate(string|array<string> $compute_date) Return ChildPrescriberData objects filtered by the compute_date column
 * @method     ChildPrescriberData[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildPrescriberData objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildPrescriberData> findByCreatedAt(string|array<string> $created_at) Return ChildPrescriberData objects filtered by the created_at column
 * @method     ChildPrescriberData[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildPrescriberData objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildPrescriberData> findByUpdatedAt(string|array<string> $updated_at) Return ChildPrescriberData objects filtered by the updated_at column
 *
 * @method     ChildPrescriberData[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildPrescriberData> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class PrescriberDataQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\PrescriberDataQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\PrescriberData', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPrescriberDataQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPrescriberDataQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildPrescriberDataQuery) {
            return $criteria;
        }
        $query = new ChildPrescriberDataQuery();
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
     * @return ChildPrescriberData|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PrescriberDataTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = PrescriberDataTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildPrescriberData A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT prescriber_tally_data_id, orgunit_id, position_id, territory_id, outlet_org_id, brand_id, moye, cut_off, lm_rcpa_value, cm_rcpa_value, lm_visit, cm_visit, lm_rcpa, cm_rcpa, cm_rxber_cat, compute_date, created_at, updated_at FROM prescriber_data WHERE prescriber_tally_data_id = :p0';
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
            /** @var ChildPrescriberData $obj */
            $obj = new ChildPrescriberData();
            $obj->hydrate($row);
            PrescriberDataTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildPrescriberData|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(PrescriberDataTableMap::COL_PRESCRIBER_TALLY_DATA_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(PrescriberDataTableMap::COL_PRESCRIBER_TALLY_DATA_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the prescriber_tally_data_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPrescriberTallyDataId(1234); // WHERE prescriber_tally_data_id = 1234
     * $query->filterByPrescriberTallyDataId(array(12, 34)); // WHERE prescriber_tally_data_id IN (12, 34)
     * $query->filterByPrescriberTallyDataId(array('min' => 12)); // WHERE prescriber_tally_data_id > 12
     * </code>
     *
     * @param mixed $prescriberTallyDataId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrescriberTallyDataId($prescriberTallyDataId = null, ?string $comparison = null)
    {
        if (is_array($prescriberTallyDataId)) {
            $useMinMax = false;
            if (isset($prescriberTallyDataId['min'])) {
                $this->addUsingAlias(PrescriberDataTableMap::COL_PRESCRIBER_TALLY_DATA_ID, $prescriberTallyDataId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($prescriberTallyDataId['max'])) {
                $this->addUsingAlias(PrescriberDataTableMap::COL_PRESCRIBER_TALLY_DATA_ID, $prescriberTallyDataId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PrescriberDataTableMap::COL_PRESCRIBER_TALLY_DATA_ID, $prescriberTallyDataId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the orgunit_id column
     *
     * Example usage:
     * <code>
     * $query->filterByOrgunitId(1234); // WHERE orgunit_id = 1234
     * $query->filterByOrgunitId(array(12, 34)); // WHERE orgunit_id IN (12, 34)
     * $query->filterByOrgunitId(array('min' => 12)); // WHERE orgunit_id > 12
     * </code>
     *
     * @see       filterByOrgUnit()
     *
     * @param mixed $orgunitId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrgunitId($orgunitId = null, ?string $comparison = null)
    {
        if (is_array($orgunitId)) {
            $useMinMax = false;
            if (isset($orgunitId['min'])) {
                $this->addUsingAlias(PrescriberDataTableMap::COL_ORGUNIT_ID, $orgunitId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($orgunitId['max'])) {
                $this->addUsingAlias(PrescriberDataTableMap::COL_ORGUNIT_ID, $orgunitId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PrescriberDataTableMap::COL_ORGUNIT_ID, $orgunitId, $comparison);

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
                $this->addUsingAlias(PrescriberDataTableMap::COL_POSITION_ID, $positionId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($positionId['max'])) {
                $this->addUsingAlias(PrescriberDataTableMap::COL_POSITION_ID, $positionId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PrescriberDataTableMap::COL_POSITION_ID, $positionId, $comparison);

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
                $this->addUsingAlias(PrescriberDataTableMap::COL_TERRITORY_ID, $territoryId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($territoryId['max'])) {
                $this->addUsingAlias(PrescriberDataTableMap::COL_TERRITORY_ID, $territoryId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PrescriberDataTableMap::COL_TERRITORY_ID, $territoryId, $comparison);

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
     * @see       filterByOutletOrgData()
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
                $this->addUsingAlias(PrescriberDataTableMap::COL_OUTLET_ORG_ID, $outletOrgId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outletOrgId['max'])) {
                $this->addUsingAlias(PrescriberDataTableMap::COL_OUTLET_ORG_ID, $outletOrgId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PrescriberDataTableMap::COL_OUTLET_ORG_ID, $outletOrgId, $comparison);

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
     * @see       filterByBrands()
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
                $this->addUsingAlias(PrescriberDataTableMap::COL_BRAND_ID, $brandId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($brandId['max'])) {
                $this->addUsingAlias(PrescriberDataTableMap::COL_BRAND_ID, $brandId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PrescriberDataTableMap::COL_BRAND_ID, $brandId, $comparison);

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

        $this->addUsingAlias(PrescriberDataTableMap::COL_MOYE, $moye, $comparison);

        return $this;
    }

    /**
     * Filter the query on the cut_off column
     *
     * Example usage:
     * <code>
     * $query->filterByCutOff(1234); // WHERE cut_off = 1234
     * $query->filterByCutOff(array(12, 34)); // WHERE cut_off IN (12, 34)
     * $query->filterByCutOff(array('min' => 12)); // WHERE cut_off > 12
     * </code>
     *
     * @param mixed $cutOff The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCutOff($cutOff = null, ?string $comparison = null)
    {
        if (is_array($cutOff)) {
            $useMinMax = false;
            if (isset($cutOff['min'])) {
                $this->addUsingAlias(PrescriberDataTableMap::COL_CUT_OFF, $cutOff['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($cutOff['max'])) {
                $this->addUsingAlias(PrescriberDataTableMap::COL_CUT_OFF, $cutOff['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PrescriberDataTableMap::COL_CUT_OFF, $cutOff, $comparison);

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
                $this->addUsingAlias(PrescriberDataTableMap::COL_LM_RCPA_VALUE, $lmRcpaValue['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lmRcpaValue['max'])) {
                $this->addUsingAlias(PrescriberDataTableMap::COL_LM_RCPA_VALUE, $lmRcpaValue['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PrescriberDataTableMap::COL_LM_RCPA_VALUE, $lmRcpaValue, $comparison);

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
                $this->addUsingAlias(PrescriberDataTableMap::COL_CM_RCPA_VALUE, $cmRcpaValue['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($cmRcpaValue['max'])) {
                $this->addUsingAlias(PrescriberDataTableMap::COL_CM_RCPA_VALUE, $cmRcpaValue['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PrescriberDataTableMap::COL_CM_RCPA_VALUE, $cmRcpaValue, $comparison);

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

        $this->addUsingAlias(PrescriberDataTableMap::COL_LM_VISIT, $lmVisit, $comparison);

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

        $this->addUsingAlias(PrescriberDataTableMap::COL_CM_VISIT, $cmVisit, $comparison);

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

        $this->addUsingAlias(PrescriberDataTableMap::COL_LM_RCPA, $lmRcpa, $comparison);

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

        $this->addUsingAlias(PrescriberDataTableMap::COL_CM_RCPA, $cmRcpa, $comparison);

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

        $this->addUsingAlias(PrescriberDataTableMap::COL_CM_RXBER_CAT, $cmRxberCat, $comparison);

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
                $this->addUsingAlias(PrescriberDataTableMap::COL_COMPUTE_DATE, $computeDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($computeDate['max'])) {
                $this->addUsingAlias(PrescriberDataTableMap::COL_COMPUTE_DATE, $computeDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PrescriberDataTableMap::COL_COMPUTE_DATE, $computeDate, $comparison);

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
                $this->addUsingAlias(PrescriberDataTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(PrescriberDataTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PrescriberDataTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(PrescriberDataTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(PrescriberDataTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PrescriberDataTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

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
                ->addUsingAlias(PrescriberDataTableMap::COL_ORGUNIT_ID, $orgUnit->getOrgunitid(), $comparison);
        } elseif ($orgUnit instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(PrescriberDataTableMap::COL_ORGUNIT_ID, $orgUnit->toKeyValue('PrimaryKey', 'Orgunitid'), $comparison);

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
    public function joinOrgUnit(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
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
    public function useOrgUnitQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
        ?string $joinType = Criteria::INNER_JOIN
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
                ->addUsingAlias(PrescriberDataTableMap::COL_POSITION_ID, $positions->getPositionId(), $comparison);
        } elseif ($positions instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(PrescriberDataTableMap::COL_POSITION_ID, $positions->toKeyValue('PrimaryKey', 'PositionId'), $comparison);

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
    public function joinPositions(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
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
    public function usePositionsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
        ?string $joinType = Criteria::INNER_JOIN
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
                ->addUsingAlias(PrescriberDataTableMap::COL_TERRITORY_ID, $territories->getTerritoryId(), $comparison);
        } elseif ($territories instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(PrescriberDataTableMap::COL_TERRITORY_ID, $territories->toKeyValue('PrimaryKey', 'TerritoryId'), $comparison);

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
    public function joinTerritories(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
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
    public function useTerritoriesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
        ?string $joinType = Criteria::INNER_JOIN
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
                ->addUsingAlias(PrescriberDataTableMap::COL_OUTLET_ORG_ID, $outletOrgData->getOutletOrgId(), $comparison);
        } elseif ($outletOrgData instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(PrescriberDataTableMap::COL_OUTLET_ORG_ID, $outletOrgData->toKeyValue('PrimaryKey', 'OutletOrgId'), $comparison);

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
    public function joinOutletOrgData(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
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
    public function useOutletOrgDataQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
        ?string $joinType = Criteria::INNER_JOIN
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
     * Filter the query by a related \entities\Brands object
     *
     * @param \entities\Brands|ObjectCollection $brands The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBrands($brands, ?string $comparison = null)
    {
        if ($brands instanceof \entities\Brands) {
            return $this
                ->addUsingAlias(PrescriberDataTableMap::COL_BRAND_ID, $brands->getBrandId(), $comparison);
        } elseif ($brands instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(PrescriberDataTableMap::COL_BRAND_ID, $brands->toKeyValue('PrimaryKey', 'BrandId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByBrands() only accepts arguments of type \entities\Brands or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Brands relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinBrands(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Brands');

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
            $this->addJoinObject($join, 'Brands');
        }

        return $this;
    }

    /**
     * Use the Brands relation Brands object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\BrandsQuery A secondary query class using the current class as primary query
     */
    public function useBrandsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinBrands($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Brands', '\entities\BrandsQuery');
    }

    /**
     * Use the Brands relation Brands object
     *
     * @param callable(\entities\BrandsQuery):\entities\BrandsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withBrandsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useBrandsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Brands table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\BrandsQuery The inner query object of the EXISTS statement
     */
    public function useBrandsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\BrandsQuery */
        $q = $this->useExistsQuery('Brands', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Brands table for a NOT EXISTS query.
     *
     * @see useBrandsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\BrandsQuery The inner query object of the NOT EXISTS statement
     */
    public function useBrandsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\BrandsQuery */
        $q = $this->useExistsQuery('Brands', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Brands table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\BrandsQuery The inner query object of the IN statement
     */
    public function useInBrandsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\BrandsQuery */
        $q = $this->useInQuery('Brands', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Brands table for a NOT IN query.
     *
     * @see useBrandsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\BrandsQuery The inner query object of the NOT IN statement
     */
    public function useNotInBrandsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\BrandsQuery */
        $q = $this->useInQuery('Brands', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildPrescriberData $prescriberData Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($prescriberData = null)
    {
        if ($prescriberData) {
            $this->addUsingAlias(PrescriberDataTableMap::COL_PRESCRIBER_TALLY_DATA_ID, $prescriberData->getPrescriberTallyDataId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the prescriber_data table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PrescriberDataTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PrescriberDataTableMap::clearInstancePool();
            PrescriberDataTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(PrescriberDataTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PrescriberDataTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            PrescriberDataTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            PrescriberDataTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
