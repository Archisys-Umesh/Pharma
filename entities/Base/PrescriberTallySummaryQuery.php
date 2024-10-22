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
use entities\PrescriberTallySummary as ChildPrescriberTallySummary;
use entities\PrescriberTallySummaryQuery as ChildPrescriberTallySummaryQuery;
use entities\Map\PrescriberTallySummaryTableMap;

/**
 * Base class that represents a query for the `prescriber_tally_summary` table.
 *
 * @method     ChildPrescriberTallySummaryQuery orderByPrescriberTallySummaryId($order = Criteria::ASC) Order by the prescriber_tally_summary_id column
 * @method     ChildPrescriberTallySummaryQuery orderByOrgunitId($order = Criteria::ASC) Order by the orgunit_id column
 * @method     ChildPrescriberTallySummaryQuery orderByPositionId($order = Criteria::ASC) Order by the position_id column
 * @method     ChildPrescriberTallySummaryQuery orderByTerritoryId($order = Criteria::ASC) Order by the territory_id column
 * @method     ChildPrescriberTallySummaryQuery orderByBrandId($order = Criteria::ASC) Order by the brand_id column
 * @method     ChildPrescriberTallySummaryQuery orderByMoye($order = Criteria::ASC) Order by the moye column
 * @method     ChildPrescriberTallySummaryQuery orderByTaggedDrs($order = Criteria::ASC) Order by the tagged_drs column
 * @method     ChildPrescriberTallySummaryQuery orderByLmRxbers($order = Criteria::ASC) Order by the lm_rxbers column
 * @method     ChildPrescriberTallySummaryQuery orderByCmRxbers($order = Criteria::ASC) Order by the cm_rxbers column
 * @method     ChildPrescriberTallySummaryQuery orderByGain($order = Criteria::ASC) Order by the gain column
 * @method     ChildPrescriberTallySummaryQuery orderByLoss($order = Criteria::ASC) Order by the loss column
 * @method     ChildPrescriberTallySummaryQuery orderByTwoMonthRxber($order = Criteria::ASC) Order by the two_month_rxber column
 * @method     ChildPrescriberTallySummaryQuery orderByNonrxber($order = Criteria::ASC) Order by the nonrxber column
 * @method     ChildPrescriberTallySummaryQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildPrescriberTallySummaryQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildPrescriberTallySummaryQuery orderByCmRcpa($order = Criteria::ASC) Order by the cm_rcpa column
 * @method     ChildPrescriberTallySummaryQuery orderByCmVisit($order = Criteria::ASC) Order by the cm_visit column
 *
 * @method     ChildPrescriberTallySummaryQuery groupByPrescriberTallySummaryId() Group by the prescriber_tally_summary_id column
 * @method     ChildPrescriberTallySummaryQuery groupByOrgunitId() Group by the orgunit_id column
 * @method     ChildPrescriberTallySummaryQuery groupByPositionId() Group by the position_id column
 * @method     ChildPrescriberTallySummaryQuery groupByTerritoryId() Group by the territory_id column
 * @method     ChildPrescriberTallySummaryQuery groupByBrandId() Group by the brand_id column
 * @method     ChildPrescriberTallySummaryQuery groupByMoye() Group by the moye column
 * @method     ChildPrescriberTallySummaryQuery groupByTaggedDrs() Group by the tagged_drs column
 * @method     ChildPrescriberTallySummaryQuery groupByLmRxbers() Group by the lm_rxbers column
 * @method     ChildPrescriberTallySummaryQuery groupByCmRxbers() Group by the cm_rxbers column
 * @method     ChildPrescriberTallySummaryQuery groupByGain() Group by the gain column
 * @method     ChildPrescriberTallySummaryQuery groupByLoss() Group by the loss column
 * @method     ChildPrescriberTallySummaryQuery groupByTwoMonthRxber() Group by the two_month_rxber column
 * @method     ChildPrescriberTallySummaryQuery groupByNonrxber() Group by the nonrxber column
 * @method     ChildPrescriberTallySummaryQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildPrescriberTallySummaryQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildPrescriberTallySummaryQuery groupByCmRcpa() Group by the cm_rcpa column
 * @method     ChildPrescriberTallySummaryQuery groupByCmVisit() Group by the cm_visit column
 *
 * @method     ChildPrescriberTallySummaryQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPrescriberTallySummaryQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPrescriberTallySummaryQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPrescriberTallySummaryQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildPrescriberTallySummaryQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildPrescriberTallySummaryQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildPrescriberTallySummaryQuery leftJoinOrgUnit($relationAlias = null) Adds a LEFT JOIN clause to the query using the OrgUnit relation
 * @method     ChildPrescriberTallySummaryQuery rightJoinOrgUnit($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OrgUnit relation
 * @method     ChildPrescriberTallySummaryQuery innerJoinOrgUnit($relationAlias = null) Adds a INNER JOIN clause to the query using the OrgUnit relation
 *
 * @method     ChildPrescriberTallySummaryQuery joinWithOrgUnit($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OrgUnit relation
 *
 * @method     ChildPrescriberTallySummaryQuery leftJoinWithOrgUnit() Adds a LEFT JOIN clause and with to the query using the OrgUnit relation
 * @method     ChildPrescriberTallySummaryQuery rightJoinWithOrgUnit() Adds a RIGHT JOIN clause and with to the query using the OrgUnit relation
 * @method     ChildPrescriberTallySummaryQuery innerJoinWithOrgUnit() Adds a INNER JOIN clause and with to the query using the OrgUnit relation
 *
 * @method     ChildPrescriberTallySummaryQuery leftJoinPositions($relationAlias = null) Adds a LEFT JOIN clause to the query using the Positions relation
 * @method     ChildPrescriberTallySummaryQuery rightJoinPositions($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Positions relation
 * @method     ChildPrescriberTallySummaryQuery innerJoinPositions($relationAlias = null) Adds a INNER JOIN clause to the query using the Positions relation
 *
 * @method     ChildPrescriberTallySummaryQuery joinWithPositions($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Positions relation
 *
 * @method     ChildPrescriberTallySummaryQuery leftJoinWithPositions() Adds a LEFT JOIN clause and with to the query using the Positions relation
 * @method     ChildPrescriberTallySummaryQuery rightJoinWithPositions() Adds a RIGHT JOIN clause and with to the query using the Positions relation
 * @method     ChildPrescriberTallySummaryQuery innerJoinWithPositions() Adds a INNER JOIN clause and with to the query using the Positions relation
 *
 * @method     ChildPrescriberTallySummaryQuery leftJoinTerritories($relationAlias = null) Adds a LEFT JOIN clause to the query using the Territories relation
 * @method     ChildPrescriberTallySummaryQuery rightJoinTerritories($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Territories relation
 * @method     ChildPrescriberTallySummaryQuery innerJoinTerritories($relationAlias = null) Adds a INNER JOIN clause to the query using the Territories relation
 *
 * @method     ChildPrescriberTallySummaryQuery joinWithTerritories($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Territories relation
 *
 * @method     ChildPrescriberTallySummaryQuery leftJoinWithTerritories() Adds a LEFT JOIN clause and with to the query using the Territories relation
 * @method     ChildPrescriberTallySummaryQuery rightJoinWithTerritories() Adds a RIGHT JOIN clause and with to the query using the Territories relation
 * @method     ChildPrescriberTallySummaryQuery innerJoinWithTerritories() Adds a INNER JOIN clause and with to the query using the Territories relation
 *
 * @method     ChildPrescriberTallySummaryQuery leftJoinBrands($relationAlias = null) Adds a LEFT JOIN clause to the query using the Brands relation
 * @method     ChildPrescriberTallySummaryQuery rightJoinBrands($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Brands relation
 * @method     ChildPrescriberTallySummaryQuery innerJoinBrands($relationAlias = null) Adds a INNER JOIN clause to the query using the Brands relation
 *
 * @method     ChildPrescriberTallySummaryQuery joinWithBrands($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Brands relation
 *
 * @method     ChildPrescriberTallySummaryQuery leftJoinWithBrands() Adds a LEFT JOIN clause and with to the query using the Brands relation
 * @method     ChildPrescriberTallySummaryQuery rightJoinWithBrands() Adds a RIGHT JOIN clause and with to the query using the Brands relation
 * @method     ChildPrescriberTallySummaryQuery innerJoinWithBrands() Adds a INNER JOIN clause and with to the query using the Brands relation
 *
 * @method     \entities\OrgUnitQuery|\entities\PositionsQuery|\entities\TerritoriesQuery|\entities\BrandsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildPrescriberTallySummary|null findOne(?ConnectionInterface $con = null) Return the first ChildPrescriberTallySummary matching the query
 * @method     ChildPrescriberTallySummary findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildPrescriberTallySummary matching the query, or a new ChildPrescriberTallySummary object populated from the query conditions when no match is found
 *
 * @method     ChildPrescriberTallySummary|null findOneByPrescriberTallySummaryId(int $prescriber_tally_summary_id) Return the first ChildPrescriberTallySummary filtered by the prescriber_tally_summary_id column
 * @method     ChildPrescriberTallySummary|null findOneByOrgunitId(int $orgunit_id) Return the first ChildPrescriberTallySummary filtered by the orgunit_id column
 * @method     ChildPrescriberTallySummary|null findOneByPositionId(int $position_id) Return the first ChildPrescriberTallySummary filtered by the position_id column
 * @method     ChildPrescriberTallySummary|null findOneByTerritoryId(int $territory_id) Return the first ChildPrescriberTallySummary filtered by the territory_id column
 * @method     ChildPrescriberTallySummary|null findOneByBrandId(int $brand_id) Return the first ChildPrescriberTallySummary filtered by the brand_id column
 * @method     ChildPrescriberTallySummary|null findOneByMoye(string $moye) Return the first ChildPrescriberTallySummary filtered by the moye column
 * @method     ChildPrescriberTallySummary|null findOneByTaggedDrs(int $tagged_drs) Return the first ChildPrescriberTallySummary filtered by the tagged_drs column
 * @method     ChildPrescriberTallySummary|null findOneByLmRxbers(int $lm_rxbers) Return the first ChildPrescriberTallySummary filtered by the lm_rxbers column
 * @method     ChildPrescriberTallySummary|null findOneByCmRxbers(int $cm_rxbers) Return the first ChildPrescriberTallySummary filtered by the cm_rxbers column
 * @method     ChildPrescriberTallySummary|null findOneByGain(int $gain) Return the first ChildPrescriberTallySummary filtered by the gain column
 * @method     ChildPrescriberTallySummary|null findOneByLoss(int $loss) Return the first ChildPrescriberTallySummary filtered by the loss column
 * @method     ChildPrescriberTallySummary|null findOneByTwoMonthRxber(int $two_month_rxber) Return the first ChildPrescriberTallySummary filtered by the two_month_rxber column
 * @method     ChildPrescriberTallySummary|null findOneByNonrxber(int $nonrxber) Return the first ChildPrescriberTallySummary filtered by the nonrxber column
 * @method     ChildPrescriberTallySummary|null findOneByCreatedAt(string $created_at) Return the first ChildPrescriberTallySummary filtered by the created_at column
 * @method     ChildPrescriberTallySummary|null findOneByUpdatedAt(string $updated_at) Return the first ChildPrescriberTallySummary filtered by the updated_at column
 * @method     ChildPrescriberTallySummary|null findOneByCmRcpa(string $cm_rcpa) Return the first ChildPrescriberTallySummary filtered by the cm_rcpa column
 * @method     ChildPrescriberTallySummary|null findOneByCmVisit(string $cm_visit) Return the first ChildPrescriberTallySummary filtered by the cm_visit column
 *
 * @method     ChildPrescriberTallySummary requirePk($key, ?ConnectionInterface $con = null) Return the ChildPrescriberTallySummary by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPrescriberTallySummary requireOne(?ConnectionInterface $con = null) Return the first ChildPrescriberTallySummary matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPrescriberTallySummary requireOneByPrescriberTallySummaryId(int $prescriber_tally_summary_id) Return the first ChildPrescriberTallySummary filtered by the prescriber_tally_summary_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPrescriberTallySummary requireOneByOrgunitId(int $orgunit_id) Return the first ChildPrescriberTallySummary filtered by the orgunit_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPrescriberTallySummary requireOneByPositionId(int $position_id) Return the first ChildPrescriberTallySummary filtered by the position_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPrescriberTallySummary requireOneByTerritoryId(int $territory_id) Return the first ChildPrescriberTallySummary filtered by the territory_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPrescriberTallySummary requireOneByBrandId(int $brand_id) Return the first ChildPrescriberTallySummary filtered by the brand_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPrescriberTallySummary requireOneByMoye(string $moye) Return the first ChildPrescriberTallySummary filtered by the moye column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPrescriberTallySummary requireOneByTaggedDrs(int $tagged_drs) Return the first ChildPrescriberTallySummary filtered by the tagged_drs column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPrescriberTallySummary requireOneByLmRxbers(int $lm_rxbers) Return the first ChildPrescriberTallySummary filtered by the lm_rxbers column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPrescriberTallySummary requireOneByCmRxbers(int $cm_rxbers) Return the first ChildPrescriberTallySummary filtered by the cm_rxbers column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPrescriberTallySummary requireOneByGain(int $gain) Return the first ChildPrescriberTallySummary filtered by the gain column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPrescriberTallySummary requireOneByLoss(int $loss) Return the first ChildPrescriberTallySummary filtered by the loss column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPrescriberTallySummary requireOneByTwoMonthRxber(int $two_month_rxber) Return the first ChildPrescriberTallySummary filtered by the two_month_rxber column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPrescriberTallySummary requireOneByNonrxber(int $nonrxber) Return the first ChildPrescriberTallySummary filtered by the nonrxber column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPrescriberTallySummary requireOneByCreatedAt(string $created_at) Return the first ChildPrescriberTallySummary filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPrescriberTallySummary requireOneByUpdatedAt(string $updated_at) Return the first ChildPrescriberTallySummary filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPrescriberTallySummary requireOneByCmRcpa(string $cm_rcpa) Return the first ChildPrescriberTallySummary filtered by the cm_rcpa column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPrescriberTallySummary requireOneByCmVisit(string $cm_visit) Return the first ChildPrescriberTallySummary filtered by the cm_visit column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPrescriberTallySummary[]|Collection find(?ConnectionInterface $con = null) Return ChildPrescriberTallySummary objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildPrescriberTallySummary> find(?ConnectionInterface $con = null) Return ChildPrescriberTallySummary objects based on current ModelCriteria
 *
 * @method     ChildPrescriberTallySummary[]|Collection findByPrescriberTallySummaryId(int|array<int> $prescriber_tally_summary_id) Return ChildPrescriberTallySummary objects filtered by the prescriber_tally_summary_id column
 * @psalm-method Collection&\Traversable<ChildPrescriberTallySummary> findByPrescriberTallySummaryId(int|array<int> $prescriber_tally_summary_id) Return ChildPrescriberTallySummary objects filtered by the prescriber_tally_summary_id column
 * @method     ChildPrescriberTallySummary[]|Collection findByOrgunitId(int|array<int> $orgunit_id) Return ChildPrescriberTallySummary objects filtered by the orgunit_id column
 * @psalm-method Collection&\Traversable<ChildPrescriberTallySummary> findByOrgunitId(int|array<int> $orgunit_id) Return ChildPrescriberTallySummary objects filtered by the orgunit_id column
 * @method     ChildPrescriberTallySummary[]|Collection findByPositionId(int|array<int> $position_id) Return ChildPrescriberTallySummary objects filtered by the position_id column
 * @psalm-method Collection&\Traversable<ChildPrescriberTallySummary> findByPositionId(int|array<int> $position_id) Return ChildPrescriberTallySummary objects filtered by the position_id column
 * @method     ChildPrescriberTallySummary[]|Collection findByTerritoryId(int|array<int> $territory_id) Return ChildPrescriberTallySummary objects filtered by the territory_id column
 * @psalm-method Collection&\Traversable<ChildPrescriberTallySummary> findByTerritoryId(int|array<int> $territory_id) Return ChildPrescriberTallySummary objects filtered by the territory_id column
 * @method     ChildPrescriberTallySummary[]|Collection findByBrandId(int|array<int> $brand_id) Return ChildPrescriberTallySummary objects filtered by the brand_id column
 * @psalm-method Collection&\Traversable<ChildPrescriberTallySummary> findByBrandId(int|array<int> $brand_id) Return ChildPrescriberTallySummary objects filtered by the brand_id column
 * @method     ChildPrescriberTallySummary[]|Collection findByMoye(string|array<string> $moye) Return ChildPrescriberTallySummary objects filtered by the moye column
 * @psalm-method Collection&\Traversable<ChildPrescriberTallySummary> findByMoye(string|array<string> $moye) Return ChildPrescriberTallySummary objects filtered by the moye column
 * @method     ChildPrescriberTallySummary[]|Collection findByTaggedDrs(int|array<int> $tagged_drs) Return ChildPrescriberTallySummary objects filtered by the tagged_drs column
 * @psalm-method Collection&\Traversable<ChildPrescriberTallySummary> findByTaggedDrs(int|array<int> $tagged_drs) Return ChildPrescriberTallySummary objects filtered by the tagged_drs column
 * @method     ChildPrescriberTallySummary[]|Collection findByLmRxbers(int|array<int> $lm_rxbers) Return ChildPrescriberTallySummary objects filtered by the lm_rxbers column
 * @psalm-method Collection&\Traversable<ChildPrescriberTallySummary> findByLmRxbers(int|array<int> $lm_rxbers) Return ChildPrescriberTallySummary objects filtered by the lm_rxbers column
 * @method     ChildPrescriberTallySummary[]|Collection findByCmRxbers(int|array<int> $cm_rxbers) Return ChildPrescriberTallySummary objects filtered by the cm_rxbers column
 * @psalm-method Collection&\Traversable<ChildPrescriberTallySummary> findByCmRxbers(int|array<int> $cm_rxbers) Return ChildPrescriberTallySummary objects filtered by the cm_rxbers column
 * @method     ChildPrescriberTallySummary[]|Collection findByGain(int|array<int> $gain) Return ChildPrescriberTallySummary objects filtered by the gain column
 * @psalm-method Collection&\Traversable<ChildPrescriberTallySummary> findByGain(int|array<int> $gain) Return ChildPrescriberTallySummary objects filtered by the gain column
 * @method     ChildPrescriberTallySummary[]|Collection findByLoss(int|array<int> $loss) Return ChildPrescriberTallySummary objects filtered by the loss column
 * @psalm-method Collection&\Traversable<ChildPrescriberTallySummary> findByLoss(int|array<int> $loss) Return ChildPrescriberTallySummary objects filtered by the loss column
 * @method     ChildPrescriberTallySummary[]|Collection findByTwoMonthRxber(int|array<int> $two_month_rxber) Return ChildPrescriberTallySummary objects filtered by the two_month_rxber column
 * @psalm-method Collection&\Traversable<ChildPrescriberTallySummary> findByTwoMonthRxber(int|array<int> $two_month_rxber) Return ChildPrescriberTallySummary objects filtered by the two_month_rxber column
 * @method     ChildPrescriberTallySummary[]|Collection findByNonrxber(int|array<int> $nonrxber) Return ChildPrescriberTallySummary objects filtered by the nonrxber column
 * @psalm-method Collection&\Traversable<ChildPrescriberTallySummary> findByNonrxber(int|array<int> $nonrxber) Return ChildPrescriberTallySummary objects filtered by the nonrxber column
 * @method     ChildPrescriberTallySummary[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildPrescriberTallySummary objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildPrescriberTallySummary> findByCreatedAt(string|array<string> $created_at) Return ChildPrescriberTallySummary objects filtered by the created_at column
 * @method     ChildPrescriberTallySummary[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildPrescriberTallySummary objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildPrescriberTallySummary> findByUpdatedAt(string|array<string> $updated_at) Return ChildPrescriberTallySummary objects filtered by the updated_at column
 * @method     ChildPrescriberTallySummary[]|Collection findByCmRcpa(string|array<string> $cm_rcpa) Return ChildPrescriberTallySummary objects filtered by the cm_rcpa column
 * @psalm-method Collection&\Traversable<ChildPrescriberTallySummary> findByCmRcpa(string|array<string> $cm_rcpa) Return ChildPrescriberTallySummary objects filtered by the cm_rcpa column
 * @method     ChildPrescriberTallySummary[]|Collection findByCmVisit(string|array<string> $cm_visit) Return ChildPrescriberTallySummary objects filtered by the cm_visit column
 * @psalm-method Collection&\Traversable<ChildPrescriberTallySummary> findByCmVisit(string|array<string> $cm_visit) Return ChildPrescriberTallySummary objects filtered by the cm_visit column
 *
 * @method     ChildPrescriberTallySummary[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildPrescriberTallySummary> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class PrescriberTallySummaryQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\PrescriberTallySummaryQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\PrescriberTallySummary', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPrescriberTallySummaryQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPrescriberTallySummaryQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildPrescriberTallySummaryQuery) {
            return $criteria;
        }
        $query = new ChildPrescriberTallySummaryQuery();
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
     * @return ChildPrescriberTallySummary|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PrescriberTallySummaryTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = PrescriberTallySummaryTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildPrescriberTallySummary A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT prescriber_tally_summary_id, orgunit_id, position_id, territory_id, brand_id, moye, tagged_drs, lm_rxbers, cm_rxbers, gain, loss, two_month_rxber, nonrxber, created_at, updated_at, cm_rcpa, cm_visit FROM prescriber_tally_summary WHERE prescriber_tally_summary_id = :p0';
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
            /** @var ChildPrescriberTallySummary $obj */
            $obj = new ChildPrescriberTallySummary();
            $obj->hydrate($row);
            PrescriberTallySummaryTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildPrescriberTallySummary|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(PrescriberTallySummaryTableMap::COL_PRESCRIBER_TALLY_SUMMARY_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(PrescriberTallySummaryTableMap::COL_PRESCRIBER_TALLY_SUMMARY_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the prescriber_tally_summary_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPrescriberTallySummaryId(1234); // WHERE prescriber_tally_summary_id = 1234
     * $query->filterByPrescriberTallySummaryId(array(12, 34)); // WHERE prescriber_tally_summary_id IN (12, 34)
     * $query->filterByPrescriberTallySummaryId(array('min' => 12)); // WHERE prescriber_tally_summary_id > 12
     * </code>
     *
     * @param mixed $prescriberTallySummaryId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrescriberTallySummaryId($prescriberTallySummaryId = null, ?string $comparison = null)
    {
        if (is_array($prescriberTallySummaryId)) {
            $useMinMax = false;
            if (isset($prescriberTallySummaryId['min'])) {
                $this->addUsingAlias(PrescriberTallySummaryTableMap::COL_PRESCRIBER_TALLY_SUMMARY_ID, $prescriberTallySummaryId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($prescriberTallySummaryId['max'])) {
                $this->addUsingAlias(PrescriberTallySummaryTableMap::COL_PRESCRIBER_TALLY_SUMMARY_ID, $prescriberTallySummaryId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PrescriberTallySummaryTableMap::COL_PRESCRIBER_TALLY_SUMMARY_ID, $prescriberTallySummaryId, $comparison);

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
                $this->addUsingAlias(PrescriberTallySummaryTableMap::COL_ORGUNIT_ID, $orgunitId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($orgunitId['max'])) {
                $this->addUsingAlias(PrescriberTallySummaryTableMap::COL_ORGUNIT_ID, $orgunitId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PrescriberTallySummaryTableMap::COL_ORGUNIT_ID, $orgunitId, $comparison);

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
                $this->addUsingAlias(PrescriberTallySummaryTableMap::COL_POSITION_ID, $positionId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($positionId['max'])) {
                $this->addUsingAlias(PrescriberTallySummaryTableMap::COL_POSITION_ID, $positionId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PrescriberTallySummaryTableMap::COL_POSITION_ID, $positionId, $comparison);

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
                $this->addUsingAlias(PrescriberTallySummaryTableMap::COL_TERRITORY_ID, $territoryId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($territoryId['max'])) {
                $this->addUsingAlias(PrescriberTallySummaryTableMap::COL_TERRITORY_ID, $territoryId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PrescriberTallySummaryTableMap::COL_TERRITORY_ID, $territoryId, $comparison);

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
                $this->addUsingAlias(PrescriberTallySummaryTableMap::COL_BRAND_ID, $brandId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($brandId['max'])) {
                $this->addUsingAlias(PrescriberTallySummaryTableMap::COL_BRAND_ID, $brandId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PrescriberTallySummaryTableMap::COL_BRAND_ID, $brandId, $comparison);

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

        $this->addUsingAlias(PrescriberTallySummaryTableMap::COL_MOYE, $moye, $comparison);

        return $this;
    }

    /**
     * Filter the query on the tagged_drs column
     *
     * Example usage:
     * <code>
     * $query->filterByTaggedDrs(1234); // WHERE tagged_drs = 1234
     * $query->filterByTaggedDrs(array(12, 34)); // WHERE tagged_drs IN (12, 34)
     * $query->filterByTaggedDrs(array('min' => 12)); // WHERE tagged_drs > 12
     * </code>
     *
     * @param mixed $taggedDrs The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTaggedDrs($taggedDrs = null, ?string $comparison = null)
    {
        if (is_array($taggedDrs)) {
            $useMinMax = false;
            if (isset($taggedDrs['min'])) {
                $this->addUsingAlias(PrescriberTallySummaryTableMap::COL_TAGGED_DRS, $taggedDrs['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($taggedDrs['max'])) {
                $this->addUsingAlias(PrescriberTallySummaryTableMap::COL_TAGGED_DRS, $taggedDrs['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PrescriberTallySummaryTableMap::COL_TAGGED_DRS, $taggedDrs, $comparison);

        return $this;
    }

    /**
     * Filter the query on the lm_rxbers column
     *
     * Example usage:
     * <code>
     * $query->filterByLmRxbers(1234); // WHERE lm_rxbers = 1234
     * $query->filterByLmRxbers(array(12, 34)); // WHERE lm_rxbers IN (12, 34)
     * $query->filterByLmRxbers(array('min' => 12)); // WHERE lm_rxbers > 12
     * </code>
     *
     * @param mixed $lmRxbers The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLmRxbers($lmRxbers = null, ?string $comparison = null)
    {
        if (is_array($lmRxbers)) {
            $useMinMax = false;
            if (isset($lmRxbers['min'])) {
                $this->addUsingAlias(PrescriberTallySummaryTableMap::COL_LM_RXBERS, $lmRxbers['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lmRxbers['max'])) {
                $this->addUsingAlias(PrescriberTallySummaryTableMap::COL_LM_RXBERS, $lmRxbers['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PrescriberTallySummaryTableMap::COL_LM_RXBERS, $lmRxbers, $comparison);

        return $this;
    }

    /**
     * Filter the query on the cm_rxbers column
     *
     * Example usage:
     * <code>
     * $query->filterByCmRxbers(1234); // WHERE cm_rxbers = 1234
     * $query->filterByCmRxbers(array(12, 34)); // WHERE cm_rxbers IN (12, 34)
     * $query->filterByCmRxbers(array('min' => 12)); // WHERE cm_rxbers > 12
     * </code>
     *
     * @param mixed $cmRxbers The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCmRxbers($cmRxbers = null, ?string $comparison = null)
    {
        if (is_array($cmRxbers)) {
            $useMinMax = false;
            if (isset($cmRxbers['min'])) {
                $this->addUsingAlias(PrescriberTallySummaryTableMap::COL_CM_RXBERS, $cmRxbers['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($cmRxbers['max'])) {
                $this->addUsingAlias(PrescriberTallySummaryTableMap::COL_CM_RXBERS, $cmRxbers['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PrescriberTallySummaryTableMap::COL_CM_RXBERS, $cmRxbers, $comparison);

        return $this;
    }

    /**
     * Filter the query on the gain column
     *
     * Example usage:
     * <code>
     * $query->filterByGain(1234); // WHERE gain = 1234
     * $query->filterByGain(array(12, 34)); // WHERE gain IN (12, 34)
     * $query->filterByGain(array('min' => 12)); // WHERE gain > 12
     * </code>
     *
     * @param mixed $gain The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByGain($gain = null, ?string $comparison = null)
    {
        if (is_array($gain)) {
            $useMinMax = false;
            if (isset($gain['min'])) {
                $this->addUsingAlias(PrescriberTallySummaryTableMap::COL_GAIN, $gain['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($gain['max'])) {
                $this->addUsingAlias(PrescriberTallySummaryTableMap::COL_GAIN, $gain['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PrescriberTallySummaryTableMap::COL_GAIN, $gain, $comparison);

        return $this;
    }

    /**
     * Filter the query on the loss column
     *
     * Example usage:
     * <code>
     * $query->filterByLoss(1234); // WHERE loss = 1234
     * $query->filterByLoss(array(12, 34)); // WHERE loss IN (12, 34)
     * $query->filterByLoss(array('min' => 12)); // WHERE loss > 12
     * </code>
     *
     * @param mixed $loss The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLoss($loss = null, ?string $comparison = null)
    {
        if (is_array($loss)) {
            $useMinMax = false;
            if (isset($loss['min'])) {
                $this->addUsingAlias(PrescriberTallySummaryTableMap::COL_LOSS, $loss['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($loss['max'])) {
                $this->addUsingAlias(PrescriberTallySummaryTableMap::COL_LOSS, $loss['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PrescriberTallySummaryTableMap::COL_LOSS, $loss, $comparison);

        return $this;
    }

    /**
     * Filter the query on the two_month_rxber column
     *
     * Example usage:
     * <code>
     * $query->filterByTwoMonthRxber(1234); // WHERE two_month_rxber = 1234
     * $query->filterByTwoMonthRxber(array(12, 34)); // WHERE two_month_rxber IN (12, 34)
     * $query->filterByTwoMonthRxber(array('min' => 12)); // WHERE two_month_rxber > 12
     * </code>
     *
     * @param mixed $twoMonthRxber The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTwoMonthRxber($twoMonthRxber = null, ?string $comparison = null)
    {
        if (is_array($twoMonthRxber)) {
            $useMinMax = false;
            if (isset($twoMonthRxber['min'])) {
                $this->addUsingAlias(PrescriberTallySummaryTableMap::COL_TWO_MONTH_RXBER, $twoMonthRxber['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($twoMonthRxber['max'])) {
                $this->addUsingAlias(PrescriberTallySummaryTableMap::COL_TWO_MONTH_RXBER, $twoMonthRxber['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PrescriberTallySummaryTableMap::COL_TWO_MONTH_RXBER, $twoMonthRxber, $comparison);

        return $this;
    }

    /**
     * Filter the query on the nonrxber column
     *
     * Example usage:
     * <code>
     * $query->filterByNonrxber(1234); // WHERE nonrxber = 1234
     * $query->filterByNonrxber(array(12, 34)); // WHERE nonrxber IN (12, 34)
     * $query->filterByNonrxber(array('min' => 12)); // WHERE nonrxber > 12
     * </code>
     *
     * @param mixed $nonrxber The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByNonrxber($nonrxber = null, ?string $comparison = null)
    {
        if (is_array($nonrxber)) {
            $useMinMax = false;
            if (isset($nonrxber['min'])) {
                $this->addUsingAlias(PrescriberTallySummaryTableMap::COL_NONRXBER, $nonrxber['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($nonrxber['max'])) {
                $this->addUsingAlias(PrescriberTallySummaryTableMap::COL_NONRXBER, $nonrxber['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PrescriberTallySummaryTableMap::COL_NONRXBER, $nonrxber, $comparison);

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
                $this->addUsingAlias(PrescriberTallySummaryTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(PrescriberTallySummaryTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PrescriberTallySummaryTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(PrescriberTallySummaryTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(PrescriberTallySummaryTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PrescriberTallySummaryTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

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

        $this->addUsingAlias(PrescriberTallySummaryTableMap::COL_CM_RCPA, $cmRcpa, $comparison);

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

        $this->addUsingAlias(PrescriberTallySummaryTableMap::COL_CM_VISIT, $cmVisit, $comparison);

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
                ->addUsingAlias(PrescriberTallySummaryTableMap::COL_ORGUNIT_ID, $orgUnit->getOrgunitid(), $comparison);
        } elseif ($orgUnit instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(PrescriberTallySummaryTableMap::COL_ORGUNIT_ID, $orgUnit->toKeyValue('PrimaryKey', 'Orgunitid'), $comparison);

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
                ->addUsingAlias(PrescriberTallySummaryTableMap::COL_POSITION_ID, $positions->getPositionId(), $comparison);
        } elseif ($positions instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(PrescriberTallySummaryTableMap::COL_POSITION_ID, $positions->toKeyValue('PrimaryKey', 'PositionId'), $comparison);

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
                ->addUsingAlias(PrescriberTallySummaryTableMap::COL_TERRITORY_ID, $territories->getTerritoryId(), $comparison);
        } elseif ($territories instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(PrescriberTallySummaryTableMap::COL_TERRITORY_ID, $territories->toKeyValue('PrimaryKey', 'TerritoryId'), $comparison);

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
                ->addUsingAlias(PrescriberTallySummaryTableMap::COL_BRAND_ID, $brands->getBrandId(), $comparison);
        } elseif ($brands instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(PrescriberTallySummaryTableMap::COL_BRAND_ID, $brands->toKeyValue('PrimaryKey', 'BrandId'), $comparison);

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
     * @param ChildPrescriberTallySummary $prescriberTallySummary Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($prescriberTallySummary = null)
    {
        if ($prescriberTallySummary) {
            $this->addUsingAlias(PrescriberTallySummaryTableMap::COL_PRESCRIBER_TALLY_SUMMARY_ID, $prescriberTallySummary->getPrescriberTallySummaryId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the prescriber_tally_summary table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PrescriberTallySummaryTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PrescriberTallySummaryTableMap::clearInstancePool();
            PrescriberTallySummaryTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(PrescriberTallySummaryTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PrescriberTallySummaryTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            PrescriberTallySummaryTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            PrescriberTallySummaryTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
