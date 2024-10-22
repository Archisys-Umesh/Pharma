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
use entities\OutletVisitsView as ChildOutletVisitsView;
use entities\OutletVisitsViewQuery as ChildOutletVisitsViewQuery;
use entities\Map\OutletVisitsViewTableMap;

/**
 * Base class that represents a query for the `outlet_visits_view` table.
 *
 * @method     ChildOutletVisitsViewQuery orderByUniqueId($order = Criteria::ASC) Order by the unique_id column
 * @method     ChildOutletVisitsViewQuery orderByMoye($order = Criteria::ASC) Order by the moye column
 * @method     ChildOutletVisitsViewQuery orderByPsitionName($order = Criteria::ASC) Order by the position_name column
 * @method     ChildOutletVisitsViewQuery orderByPositionId($order = Criteria::ASC) Order by the position_id column
 * @method     ChildOutletVisitsViewQuery orderByCavPositionsUp($order = Criteria::ASC) Order by the cav_positions_up column
 * @method     ChildOutletVisitsViewQuery orderByTerritoryId($order = Criteria::ASC) Order by the territory_id column
 * @method     ChildOutletVisitsViewQuery orderByTerritoryName($order = Criteria::ASC) Order by the territory_name column
 * @method     ChildOutletVisitsViewQuery orderByBeatId($order = Criteria::ASC) Order by the beat_id column
 * @method     ChildOutletVisitsViewQuery orderByBeatName($order = Criteria::ASC) Order by the beat_name column
 * @method     ChildOutletVisitsViewQuery orderByOutletOrgDataId($order = Criteria::ASC) Order by the outlet_org_data_id column
 * @method     ChildOutletVisitsViewQuery orderByOutletId($order = Criteria::ASC) Order by the outlet_id column
 * @method     ChildOutletVisitsViewQuery orderByOutlettypeId($order = Criteria::ASC) Order by the outlettype_id column
 * @method     ChildOutletVisitsViewQuery orderByOutlettypeName($order = Criteria::ASC) Order by the outlettype_name column
 * @method     ChildOutletVisitsViewQuery orderByOutletSalutation($order = Criteria::ASC) Order by the outlet_salutation column
 * @method     ChildOutletVisitsViewQuery orderByOutletName($order = Criteria::ASC) Order by the outlet_name column
 * @method     ChildOutletVisitsViewQuery orderByOutletContactNo($order = Criteria::ASC) Order by the outlet_contact_no column
 * @method     ChildOutletVisitsViewQuery orderByVisitFq($order = Criteria::ASC) Order by the visit_fq column
 * @method     ChildOutletVisitsViewQuery orderByVfcovered($order = Criteria::ASC) Order by the vfcovered column
 * @method     ChildOutletVisitsViewQuery orderByVisits($order = Criteria::ASC) Order by the visits column
 * @method     ChildOutletVisitsViewQuery orderByRcpaDone($order = Criteria::ASC) Order by the rcpa_done column
 * @method     ChildOutletVisitsViewQuery orderBySgpiDone($order = Criteria::ASC) Order by the sgpi_done column
 * @method     ChildOutletVisitsViewQuery orderByOutletClassification($order = Criteria::ASC) Order by the outlet_classification column
 * @method     ChildOutletVisitsViewQuery orderByEmployeeId($order = Criteria::ASC) Order by the employee_id column
 * @method     ChildOutletVisitsViewQuery orderByTerritoryPosition($order = Criteria::ASC) Order by the territory_position column
 * @method     ChildOutletVisitsViewQuery orderByIncharge($order = Criteria::ASC) Order by the incharge column
 *
 * @method     ChildOutletVisitsViewQuery groupByUniqueId() Group by the unique_id column
 * @method     ChildOutletVisitsViewQuery groupByMoye() Group by the moye column
 * @method     ChildOutletVisitsViewQuery groupByPsitionName() Group by the position_name column
 * @method     ChildOutletVisitsViewQuery groupByPositionId() Group by the position_id column
 * @method     ChildOutletVisitsViewQuery groupByCavPositionsUp() Group by the cav_positions_up column
 * @method     ChildOutletVisitsViewQuery groupByTerritoryId() Group by the territory_id column
 * @method     ChildOutletVisitsViewQuery groupByTerritoryName() Group by the territory_name column
 * @method     ChildOutletVisitsViewQuery groupByBeatId() Group by the beat_id column
 * @method     ChildOutletVisitsViewQuery groupByBeatName() Group by the beat_name column
 * @method     ChildOutletVisitsViewQuery groupByOutletOrgDataId() Group by the outlet_org_data_id column
 * @method     ChildOutletVisitsViewQuery groupByOutletId() Group by the outlet_id column
 * @method     ChildOutletVisitsViewQuery groupByOutlettypeId() Group by the outlettype_id column
 * @method     ChildOutletVisitsViewQuery groupByOutlettypeName() Group by the outlettype_name column
 * @method     ChildOutletVisitsViewQuery groupByOutletSalutation() Group by the outlet_salutation column
 * @method     ChildOutletVisitsViewQuery groupByOutletName() Group by the outlet_name column
 * @method     ChildOutletVisitsViewQuery groupByOutletContactNo() Group by the outlet_contact_no column
 * @method     ChildOutletVisitsViewQuery groupByVisitFq() Group by the visit_fq column
 * @method     ChildOutletVisitsViewQuery groupByVfcovered() Group by the vfcovered column
 * @method     ChildOutletVisitsViewQuery groupByVisits() Group by the visits column
 * @method     ChildOutletVisitsViewQuery groupByRcpaDone() Group by the rcpa_done column
 * @method     ChildOutletVisitsViewQuery groupBySgpiDone() Group by the sgpi_done column
 * @method     ChildOutletVisitsViewQuery groupByOutletClassification() Group by the outlet_classification column
 * @method     ChildOutletVisitsViewQuery groupByEmployeeId() Group by the employee_id column
 * @method     ChildOutletVisitsViewQuery groupByTerritoryPosition() Group by the territory_position column
 * @method     ChildOutletVisitsViewQuery groupByIncharge() Group by the incharge column
 *
 * @method     ChildOutletVisitsViewQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildOutletVisitsViewQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildOutletVisitsViewQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildOutletVisitsViewQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildOutletVisitsViewQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildOutletVisitsViewQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildOutletVisitsView|null findOne(?ConnectionInterface $con = null) Return the first ChildOutletVisitsView matching the query
 * @method     ChildOutletVisitsView findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildOutletVisitsView matching the query, or a new ChildOutletVisitsView object populated from the query conditions when no match is found
 *
 * @method     ChildOutletVisitsView|null findOneByUniqueId(string $unique_id) Return the first ChildOutletVisitsView filtered by the unique_id column
 * @method     ChildOutletVisitsView|null findOneByMoye(string $moye) Return the first ChildOutletVisitsView filtered by the moye column
 * @method     ChildOutletVisitsView|null findOneByPsitionName(string $position_name) Return the first ChildOutletVisitsView filtered by the position_name column
 * @method     ChildOutletVisitsView|null findOneByPositionId(int $position_id) Return the first ChildOutletVisitsView filtered by the position_id column
 * @method     ChildOutletVisitsView|null findOneByCavPositionsUp(string $cav_positions_up) Return the first ChildOutletVisitsView filtered by the cav_positions_up column
 * @method     ChildOutletVisitsView|null findOneByTerritoryId(int $territory_id) Return the first ChildOutletVisitsView filtered by the territory_id column
 * @method     ChildOutletVisitsView|null findOneByTerritoryName(string $territory_name) Return the first ChildOutletVisitsView filtered by the territory_name column
 * @method     ChildOutletVisitsView|null findOneByBeatId(int $beat_id) Return the first ChildOutletVisitsView filtered by the beat_id column
 * @method     ChildOutletVisitsView|null findOneByBeatName(string $beat_name) Return the first ChildOutletVisitsView filtered by the beat_name column
 * @method     ChildOutletVisitsView|null findOneByOutletOrgDataId(int $outlet_org_data_id) Return the first ChildOutletVisitsView filtered by the outlet_org_data_id column
 * @method     ChildOutletVisitsView|null findOneByOutletId(int $outlet_id) Return the first ChildOutletVisitsView filtered by the outlet_id column
 * @method     ChildOutletVisitsView|null findOneByOutlettypeId(int $outlettype_id) Return the first ChildOutletVisitsView filtered by the outlettype_id column
 * @method     ChildOutletVisitsView|null findOneByOutlettypeName(string $outlettype_name) Return the first ChildOutletVisitsView filtered by the outlettype_name column
 * @method     ChildOutletVisitsView|null findOneByOutletSalutation(string $outlet_salutation) Return the first ChildOutletVisitsView filtered by the outlet_salutation column
 * @method     ChildOutletVisitsView|null findOneByOutletName(string $outlet_name) Return the first ChildOutletVisitsView filtered by the outlet_name column
 * @method     ChildOutletVisitsView|null findOneByOutletContactNo(string $outlet_contact_no) Return the first ChildOutletVisitsView filtered by the outlet_contact_no column
 * @method     ChildOutletVisitsView|null findOneByVisitFq(int $visit_fq) Return the first ChildOutletVisitsView filtered by the visit_fq column
 * @method     ChildOutletVisitsView|null findOneByVfcovered(int $vfcovered) Return the first ChildOutletVisitsView filtered by the vfcovered column
 * @method     ChildOutletVisitsView|null findOneByVisits(int $visits) Return the first ChildOutletVisitsView filtered by the visits column
 * @method     ChildOutletVisitsView|null findOneByRcpaDone(int $rcpa_done) Return the first ChildOutletVisitsView filtered by the rcpa_done column
 * @method     ChildOutletVisitsView|null findOneBySgpiDone(int $sgpi_done) Return the first ChildOutletVisitsView filtered by the sgpi_done column
 * @method     ChildOutletVisitsView|null findOneByOutletClassification(int $outlet_classification) Return the first ChildOutletVisitsView filtered by the outlet_classification column
 * @method     ChildOutletVisitsView|null findOneByEmployeeId(int $employee_id) Return the first ChildOutletVisitsView filtered by the employee_id column
 * @method     ChildOutletVisitsView|null findOneByTerritoryPosition(int $territory_position) Return the first ChildOutletVisitsView filtered by the territory_position column
 * @method     ChildOutletVisitsView|null findOneByIncharge(int $incharge) Return the first ChildOutletVisitsView filtered by the incharge column
 *
 * @method     ChildOutletVisitsView requirePk($key, ?ConnectionInterface $con = null) Return the ChildOutletVisitsView by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletVisitsView requireOne(?ConnectionInterface $con = null) Return the first ChildOutletVisitsView matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOutletVisitsView requireOneByUniqueId(string $unique_id) Return the first ChildOutletVisitsView filtered by the unique_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletVisitsView requireOneByMoye(string $moye) Return the first ChildOutletVisitsView filtered by the moye column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletVisitsView requireOneByPsitionName(string $position_name) Return the first ChildOutletVisitsView filtered by the position_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletVisitsView requireOneByPositionId(int $position_id) Return the first ChildOutletVisitsView filtered by the position_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletVisitsView requireOneByCavPositionsUp(string $cav_positions_up) Return the first ChildOutletVisitsView filtered by the cav_positions_up column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletVisitsView requireOneByTerritoryId(int $territory_id) Return the first ChildOutletVisitsView filtered by the territory_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletVisitsView requireOneByTerritoryName(string $territory_name) Return the first ChildOutletVisitsView filtered by the territory_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletVisitsView requireOneByBeatId(int $beat_id) Return the first ChildOutletVisitsView filtered by the beat_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletVisitsView requireOneByBeatName(string $beat_name) Return the first ChildOutletVisitsView filtered by the beat_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletVisitsView requireOneByOutletOrgDataId(int $outlet_org_data_id) Return the first ChildOutletVisitsView filtered by the outlet_org_data_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletVisitsView requireOneByOutletId(int $outlet_id) Return the first ChildOutletVisitsView filtered by the outlet_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletVisitsView requireOneByOutlettypeId(int $outlettype_id) Return the first ChildOutletVisitsView filtered by the outlettype_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletVisitsView requireOneByOutlettypeName(string $outlettype_name) Return the first ChildOutletVisitsView filtered by the outlettype_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletVisitsView requireOneByOutletSalutation(string $outlet_salutation) Return the first ChildOutletVisitsView filtered by the outlet_salutation column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletVisitsView requireOneByOutletName(string $outlet_name) Return the first ChildOutletVisitsView filtered by the outlet_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletVisitsView requireOneByOutletContactNo(string $outlet_contact_no) Return the first ChildOutletVisitsView filtered by the outlet_contact_no column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletVisitsView requireOneByVisitFq(int $visit_fq) Return the first ChildOutletVisitsView filtered by the visit_fq column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletVisitsView requireOneByVfcovered(int $vfcovered) Return the first ChildOutletVisitsView filtered by the vfcovered column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletVisitsView requireOneByVisits(int $visits) Return the first ChildOutletVisitsView filtered by the visits column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletVisitsView requireOneByRcpaDone(int $rcpa_done) Return the first ChildOutletVisitsView filtered by the rcpa_done column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletVisitsView requireOneBySgpiDone(int $sgpi_done) Return the first ChildOutletVisitsView filtered by the sgpi_done column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletVisitsView requireOneByOutletClassification(int $outlet_classification) Return the first ChildOutletVisitsView filtered by the outlet_classification column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletVisitsView requireOneByEmployeeId(int $employee_id) Return the first ChildOutletVisitsView filtered by the employee_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletVisitsView requireOneByTerritoryPosition(int $territory_position) Return the first ChildOutletVisitsView filtered by the territory_position column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletVisitsView requireOneByIncharge(int $incharge) Return the first ChildOutletVisitsView filtered by the incharge column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOutletVisitsView[]|Collection find(?ConnectionInterface $con = null) Return ChildOutletVisitsView objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildOutletVisitsView> find(?ConnectionInterface $con = null) Return ChildOutletVisitsView objects based on current ModelCriteria
 *
 * @method     ChildOutletVisitsView[]|Collection findByUniqueId(string|array<string> $unique_id) Return ChildOutletVisitsView objects filtered by the unique_id column
 * @psalm-method Collection&\Traversable<ChildOutletVisitsView> findByUniqueId(string|array<string> $unique_id) Return ChildOutletVisitsView objects filtered by the unique_id column
 * @method     ChildOutletVisitsView[]|Collection findByMoye(string|array<string> $moye) Return ChildOutletVisitsView objects filtered by the moye column
 * @psalm-method Collection&\Traversable<ChildOutletVisitsView> findByMoye(string|array<string> $moye) Return ChildOutletVisitsView objects filtered by the moye column
 * @method     ChildOutletVisitsView[]|Collection findByPsitionName(string|array<string> $position_name) Return ChildOutletVisitsView objects filtered by the position_name column
 * @psalm-method Collection&\Traversable<ChildOutletVisitsView> findByPsitionName(string|array<string> $position_name) Return ChildOutletVisitsView objects filtered by the position_name column
 * @method     ChildOutletVisitsView[]|Collection findByPositionId(int|array<int> $position_id) Return ChildOutletVisitsView objects filtered by the position_id column
 * @psalm-method Collection&\Traversable<ChildOutletVisitsView> findByPositionId(int|array<int> $position_id) Return ChildOutletVisitsView objects filtered by the position_id column
 * @method     ChildOutletVisitsView[]|Collection findByCavPositionsUp(string|array<string> $cav_positions_up) Return ChildOutletVisitsView objects filtered by the cav_positions_up column
 * @psalm-method Collection&\Traversable<ChildOutletVisitsView> findByCavPositionsUp(string|array<string> $cav_positions_up) Return ChildOutletVisitsView objects filtered by the cav_positions_up column
 * @method     ChildOutletVisitsView[]|Collection findByTerritoryId(int|array<int> $territory_id) Return ChildOutletVisitsView objects filtered by the territory_id column
 * @psalm-method Collection&\Traversable<ChildOutletVisitsView> findByTerritoryId(int|array<int> $territory_id) Return ChildOutletVisitsView objects filtered by the territory_id column
 * @method     ChildOutletVisitsView[]|Collection findByTerritoryName(string|array<string> $territory_name) Return ChildOutletVisitsView objects filtered by the territory_name column
 * @psalm-method Collection&\Traversable<ChildOutletVisitsView> findByTerritoryName(string|array<string> $territory_name) Return ChildOutletVisitsView objects filtered by the territory_name column
 * @method     ChildOutletVisitsView[]|Collection findByBeatId(int|array<int> $beat_id) Return ChildOutletVisitsView objects filtered by the beat_id column
 * @psalm-method Collection&\Traversable<ChildOutletVisitsView> findByBeatId(int|array<int> $beat_id) Return ChildOutletVisitsView objects filtered by the beat_id column
 * @method     ChildOutletVisitsView[]|Collection findByBeatName(string|array<string> $beat_name) Return ChildOutletVisitsView objects filtered by the beat_name column
 * @psalm-method Collection&\Traversable<ChildOutletVisitsView> findByBeatName(string|array<string> $beat_name) Return ChildOutletVisitsView objects filtered by the beat_name column
 * @method     ChildOutletVisitsView[]|Collection findByOutletOrgDataId(int|array<int> $outlet_org_data_id) Return ChildOutletVisitsView objects filtered by the outlet_org_data_id column
 * @psalm-method Collection&\Traversable<ChildOutletVisitsView> findByOutletOrgDataId(int|array<int> $outlet_org_data_id) Return ChildOutletVisitsView objects filtered by the outlet_org_data_id column
 * @method     ChildOutletVisitsView[]|Collection findByOutletId(int|array<int> $outlet_id) Return ChildOutletVisitsView objects filtered by the outlet_id column
 * @psalm-method Collection&\Traversable<ChildOutletVisitsView> findByOutletId(int|array<int> $outlet_id) Return ChildOutletVisitsView objects filtered by the outlet_id column
 * @method     ChildOutletVisitsView[]|Collection findByOutlettypeId(int|array<int> $outlettype_id) Return ChildOutletVisitsView objects filtered by the outlettype_id column
 * @psalm-method Collection&\Traversable<ChildOutletVisitsView> findByOutlettypeId(int|array<int> $outlettype_id) Return ChildOutletVisitsView objects filtered by the outlettype_id column
 * @method     ChildOutletVisitsView[]|Collection findByOutlettypeName(string|array<string> $outlettype_name) Return ChildOutletVisitsView objects filtered by the outlettype_name column
 * @psalm-method Collection&\Traversable<ChildOutletVisitsView> findByOutlettypeName(string|array<string> $outlettype_name) Return ChildOutletVisitsView objects filtered by the outlettype_name column
 * @method     ChildOutletVisitsView[]|Collection findByOutletSalutation(string|array<string> $outlet_salutation) Return ChildOutletVisitsView objects filtered by the outlet_salutation column
 * @psalm-method Collection&\Traversable<ChildOutletVisitsView> findByOutletSalutation(string|array<string> $outlet_salutation) Return ChildOutletVisitsView objects filtered by the outlet_salutation column
 * @method     ChildOutletVisitsView[]|Collection findByOutletName(string|array<string> $outlet_name) Return ChildOutletVisitsView objects filtered by the outlet_name column
 * @psalm-method Collection&\Traversable<ChildOutletVisitsView> findByOutletName(string|array<string> $outlet_name) Return ChildOutletVisitsView objects filtered by the outlet_name column
 * @method     ChildOutletVisitsView[]|Collection findByOutletContactNo(string|array<string> $outlet_contact_no) Return ChildOutletVisitsView objects filtered by the outlet_contact_no column
 * @psalm-method Collection&\Traversable<ChildOutletVisitsView> findByOutletContactNo(string|array<string> $outlet_contact_no) Return ChildOutletVisitsView objects filtered by the outlet_contact_no column
 * @method     ChildOutletVisitsView[]|Collection findByVisitFq(int|array<int> $visit_fq) Return ChildOutletVisitsView objects filtered by the visit_fq column
 * @psalm-method Collection&\Traversable<ChildOutletVisitsView> findByVisitFq(int|array<int> $visit_fq) Return ChildOutletVisitsView objects filtered by the visit_fq column
 * @method     ChildOutletVisitsView[]|Collection findByVfcovered(int|array<int> $vfcovered) Return ChildOutletVisitsView objects filtered by the vfcovered column
 * @psalm-method Collection&\Traversable<ChildOutletVisitsView> findByVfcovered(int|array<int> $vfcovered) Return ChildOutletVisitsView objects filtered by the vfcovered column
 * @method     ChildOutletVisitsView[]|Collection findByVisits(int|array<int> $visits) Return ChildOutletVisitsView objects filtered by the visits column
 * @psalm-method Collection&\Traversable<ChildOutletVisitsView> findByVisits(int|array<int> $visits) Return ChildOutletVisitsView objects filtered by the visits column
 * @method     ChildOutletVisitsView[]|Collection findByRcpaDone(int|array<int> $rcpa_done) Return ChildOutletVisitsView objects filtered by the rcpa_done column
 * @psalm-method Collection&\Traversable<ChildOutletVisitsView> findByRcpaDone(int|array<int> $rcpa_done) Return ChildOutletVisitsView objects filtered by the rcpa_done column
 * @method     ChildOutletVisitsView[]|Collection findBySgpiDone(int|array<int> $sgpi_done) Return ChildOutletVisitsView objects filtered by the sgpi_done column
 * @psalm-method Collection&\Traversable<ChildOutletVisitsView> findBySgpiDone(int|array<int> $sgpi_done) Return ChildOutletVisitsView objects filtered by the sgpi_done column
 * @method     ChildOutletVisitsView[]|Collection findByOutletClassification(int|array<int> $outlet_classification) Return ChildOutletVisitsView objects filtered by the outlet_classification column
 * @psalm-method Collection&\Traversable<ChildOutletVisitsView> findByOutletClassification(int|array<int> $outlet_classification) Return ChildOutletVisitsView objects filtered by the outlet_classification column
 * @method     ChildOutletVisitsView[]|Collection findByEmployeeId(int|array<int> $employee_id) Return ChildOutletVisitsView objects filtered by the employee_id column
 * @psalm-method Collection&\Traversable<ChildOutletVisitsView> findByEmployeeId(int|array<int> $employee_id) Return ChildOutletVisitsView objects filtered by the employee_id column
 * @method     ChildOutletVisitsView[]|Collection findByTerritoryPosition(int|array<int> $territory_position) Return ChildOutletVisitsView objects filtered by the territory_position column
 * @psalm-method Collection&\Traversable<ChildOutletVisitsView> findByTerritoryPosition(int|array<int> $territory_position) Return ChildOutletVisitsView objects filtered by the territory_position column
 * @method     ChildOutletVisitsView[]|Collection findByIncharge(int|array<int> $incharge) Return ChildOutletVisitsView objects filtered by the incharge column
 * @psalm-method Collection&\Traversable<ChildOutletVisitsView> findByIncharge(int|array<int> $incharge) Return ChildOutletVisitsView objects filtered by the incharge column
 *
 * @method     ChildOutletVisitsView[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildOutletVisitsView> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class OutletVisitsViewQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\OutletVisitsViewQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\OutletVisitsView', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildOutletVisitsViewQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildOutletVisitsViewQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildOutletVisitsViewQuery) {
            return $criteria;
        }
        $query = new ChildOutletVisitsViewQuery();
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
     * @return ChildOutletVisitsView|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(OutletVisitsViewTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = OutletVisitsViewTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildOutletVisitsView A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT unique_id, moye, position_name, position_id, cav_positions_up, territory_id, territory_name, beat_id, beat_name, outlet_org_data_id, outlet_id, outlettype_id, outlettype_name, outlet_salutation, outlet_name, outlet_contact_no, visit_fq, vfcovered, visits, rcpa_done, sgpi_done, outlet_classification, employee_id, territory_position, incharge FROM outlet_visits_view WHERE unique_id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildOutletVisitsView $obj */
            $obj = new ChildOutletVisitsView();
            $obj->hydrate($row);
            OutletVisitsViewTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildOutletVisitsView|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(OutletVisitsViewTableMap::COL_UNIQUE_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(OutletVisitsViewTableMap::COL_UNIQUE_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the unique_id column
     *
     * Example usage:
     * <code>
     * $query->filterByUniqueId('fooValue');   // WHERE unique_id = 'fooValue'
     * $query->filterByUniqueId('%fooValue%', Criteria::LIKE); // WHERE unique_id LIKE '%fooValue%'
     * $query->filterByUniqueId(['foo', 'bar']); // WHERE unique_id IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $uniqueId The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUniqueId($uniqueId = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($uniqueId)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletVisitsViewTableMap::COL_UNIQUE_ID, $uniqueId, $comparison);

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

        $this->addUsingAlias(OutletVisitsViewTableMap::COL_MOYE, $moye, $comparison);

        return $this;
    }

    /**
     * Filter the query on the position_name column
     *
     * Example usage:
     * <code>
     * $query->filterByPsitionName('fooValue');   // WHERE position_name = 'fooValue'
     * $query->filterByPsitionName('%fooValue%', Criteria::LIKE); // WHERE position_name LIKE '%fooValue%'
     * $query->filterByPsitionName(['foo', 'bar']); // WHERE position_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $psitionName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPsitionName($psitionName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($psitionName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletVisitsViewTableMap::COL_POSITION_NAME, $psitionName, $comparison);

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
                $this->addUsingAlias(OutletVisitsViewTableMap::COL_POSITION_ID, $positionId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($positionId['max'])) {
                $this->addUsingAlias(OutletVisitsViewTableMap::COL_POSITION_ID, $positionId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletVisitsViewTableMap::COL_POSITION_ID, $positionId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the cav_positions_up column
     *
     * Example usage:
     * <code>
     * $query->filterByCavPositionsUp('fooValue');   // WHERE cav_positions_up = 'fooValue'
     * $query->filterByCavPositionsUp('%fooValue%', Criteria::LIKE); // WHERE cav_positions_up LIKE '%fooValue%'
     * $query->filterByCavPositionsUp(['foo', 'bar']); // WHERE cav_positions_up IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $cavPositionsUp The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCavPositionsUp($cavPositionsUp = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cavPositionsUp)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletVisitsViewTableMap::COL_CAV_POSITIONS_UP, $cavPositionsUp, $comparison);

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
                $this->addUsingAlias(OutletVisitsViewTableMap::COL_TERRITORY_ID, $territoryId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($territoryId['max'])) {
                $this->addUsingAlias(OutletVisitsViewTableMap::COL_TERRITORY_ID, $territoryId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletVisitsViewTableMap::COL_TERRITORY_ID, $territoryId, $comparison);

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

        $this->addUsingAlias(OutletVisitsViewTableMap::COL_TERRITORY_NAME, $territoryName, $comparison);

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
                $this->addUsingAlias(OutletVisitsViewTableMap::COL_BEAT_ID, $beatId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($beatId['max'])) {
                $this->addUsingAlias(OutletVisitsViewTableMap::COL_BEAT_ID, $beatId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletVisitsViewTableMap::COL_BEAT_ID, $beatId, $comparison);

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

        $this->addUsingAlias(OutletVisitsViewTableMap::COL_BEAT_NAME, $beatName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_org_data_id column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletOrgDataId(1234); // WHERE outlet_org_data_id = 1234
     * $query->filterByOutletOrgDataId(array(12, 34)); // WHERE outlet_org_data_id IN (12, 34)
     * $query->filterByOutletOrgDataId(array('min' => 12)); // WHERE outlet_org_data_id > 12
     * </code>
     *
     * @param mixed $outletOrgDataId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletOrgDataId($outletOrgDataId = null, ?string $comparison = null)
    {
        if (is_array($outletOrgDataId)) {
            $useMinMax = false;
            if (isset($outletOrgDataId['min'])) {
                $this->addUsingAlias(OutletVisitsViewTableMap::COL_OUTLET_ORG_DATA_ID, $outletOrgDataId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outletOrgDataId['max'])) {
                $this->addUsingAlias(OutletVisitsViewTableMap::COL_OUTLET_ORG_DATA_ID, $outletOrgDataId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletVisitsViewTableMap::COL_OUTLET_ORG_DATA_ID, $outletOrgDataId, $comparison);

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
                $this->addUsingAlias(OutletVisitsViewTableMap::COL_OUTLET_ID, $outletId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outletId['max'])) {
                $this->addUsingAlias(OutletVisitsViewTableMap::COL_OUTLET_ID, $outletId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletVisitsViewTableMap::COL_OUTLET_ID, $outletId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlettype_id column
     *
     * Example usage:
     * <code>
     * $query->filterByOutlettypeId(1234); // WHERE outlettype_id = 1234
     * $query->filterByOutlettypeId(array(12, 34)); // WHERE outlettype_id IN (12, 34)
     * $query->filterByOutlettypeId(array('min' => 12)); // WHERE outlettype_id > 12
     * </code>
     *
     * @param mixed $outlettypeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutlettypeId($outlettypeId = null, ?string $comparison = null)
    {
        if (is_array($outlettypeId)) {
            $useMinMax = false;
            if (isset($outlettypeId['min'])) {
                $this->addUsingAlias(OutletVisitsViewTableMap::COL_OUTLETTYPE_ID, $outlettypeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outlettypeId['max'])) {
                $this->addUsingAlias(OutletVisitsViewTableMap::COL_OUTLETTYPE_ID, $outlettypeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletVisitsViewTableMap::COL_OUTLETTYPE_ID, $outlettypeId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlettype_name column
     *
     * Example usage:
     * <code>
     * $query->filterByOutlettypeName('fooValue');   // WHERE outlettype_name = 'fooValue'
     * $query->filterByOutlettypeName('%fooValue%', Criteria::LIKE); // WHERE outlettype_name LIKE '%fooValue%'
     * $query->filterByOutlettypeName(['foo', 'bar']); // WHERE outlettype_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $outlettypeName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutlettypeName($outlettypeName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($outlettypeName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletVisitsViewTableMap::COL_OUTLETTYPE_NAME, $outlettypeName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_salutation column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletSalutation('fooValue');   // WHERE outlet_salutation = 'fooValue'
     * $query->filterByOutletSalutation('%fooValue%', Criteria::LIKE); // WHERE outlet_salutation LIKE '%fooValue%'
     * $query->filterByOutletSalutation(['foo', 'bar']); // WHERE outlet_salutation IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $outletSalutation The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletSalutation($outletSalutation = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($outletSalutation)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletVisitsViewTableMap::COL_OUTLET_SALUTATION, $outletSalutation, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_name column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletName('fooValue');   // WHERE outlet_name = 'fooValue'
     * $query->filterByOutletName('%fooValue%', Criteria::LIKE); // WHERE outlet_name LIKE '%fooValue%'
     * $query->filterByOutletName(['foo', 'bar']); // WHERE outlet_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $outletName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletName($outletName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($outletName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletVisitsViewTableMap::COL_OUTLET_NAME, $outletName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_contact_no column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletContactNo('fooValue');   // WHERE outlet_contact_no = 'fooValue'
     * $query->filterByOutletContactNo('%fooValue%', Criteria::LIKE); // WHERE outlet_contact_no LIKE '%fooValue%'
     * $query->filterByOutletContactNo(['foo', 'bar']); // WHERE outlet_contact_no IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $outletContactNo The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletContactNo($outletContactNo = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($outletContactNo)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletVisitsViewTableMap::COL_OUTLET_CONTACT_NO, $outletContactNo, $comparison);

        return $this;
    }

    /**
     * Filter the query on the visit_fq column
     *
     * Example usage:
     * <code>
     * $query->filterByVisitFq(1234); // WHERE visit_fq = 1234
     * $query->filterByVisitFq(array(12, 34)); // WHERE visit_fq IN (12, 34)
     * $query->filterByVisitFq(array('min' => 12)); // WHERE visit_fq > 12
     * </code>
     *
     * @param mixed $visitFq The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByVisitFq($visitFq = null, ?string $comparison = null)
    {
        if (is_array($visitFq)) {
            $useMinMax = false;
            if (isset($visitFq['min'])) {
                $this->addUsingAlias(OutletVisitsViewTableMap::COL_VISIT_FQ, $visitFq['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($visitFq['max'])) {
                $this->addUsingAlias(OutletVisitsViewTableMap::COL_VISIT_FQ, $visitFq['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletVisitsViewTableMap::COL_VISIT_FQ, $visitFq, $comparison);

        return $this;
    }

    /**
     * Filter the query on the vfcovered column
     *
     * Example usage:
     * <code>
     * $query->filterByVfcovered(1234); // WHERE vfcovered = 1234
     * $query->filterByVfcovered(array(12, 34)); // WHERE vfcovered IN (12, 34)
     * $query->filterByVfcovered(array('min' => 12)); // WHERE vfcovered > 12
     * </code>
     *
     * @param mixed $vfcovered The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByVfcovered($vfcovered = null, ?string $comparison = null)
    {
        if (is_array($vfcovered)) {
            $useMinMax = false;
            if (isset($vfcovered['min'])) {
                $this->addUsingAlias(OutletVisitsViewTableMap::COL_VFCOVERED, $vfcovered['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($vfcovered['max'])) {
                $this->addUsingAlias(OutletVisitsViewTableMap::COL_VFCOVERED, $vfcovered['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletVisitsViewTableMap::COL_VFCOVERED, $vfcovered, $comparison);

        return $this;
    }

    /**
     * Filter the query on the visits column
     *
     * Example usage:
     * <code>
     * $query->filterByVisits(1234); // WHERE visits = 1234
     * $query->filterByVisits(array(12, 34)); // WHERE visits IN (12, 34)
     * $query->filterByVisits(array('min' => 12)); // WHERE visits > 12
     * </code>
     *
     * @param mixed $visits The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByVisits($visits = null, ?string $comparison = null)
    {
        if (is_array($visits)) {
            $useMinMax = false;
            if (isset($visits['min'])) {
                $this->addUsingAlias(OutletVisitsViewTableMap::COL_VISITS, $visits['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($visits['max'])) {
                $this->addUsingAlias(OutletVisitsViewTableMap::COL_VISITS, $visits['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletVisitsViewTableMap::COL_VISITS, $visits, $comparison);

        return $this;
    }

    /**
     * Filter the query on the rcpa_done column
     *
     * Example usage:
     * <code>
     * $query->filterByRcpaDone(1234); // WHERE rcpa_done = 1234
     * $query->filterByRcpaDone(array(12, 34)); // WHERE rcpa_done IN (12, 34)
     * $query->filterByRcpaDone(array('min' => 12)); // WHERE rcpa_done > 12
     * </code>
     *
     * @param mixed $rcpaDone The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRcpaDone($rcpaDone = null, ?string $comparison = null)
    {
        if (is_array($rcpaDone)) {
            $useMinMax = false;
            if (isset($rcpaDone['min'])) {
                $this->addUsingAlias(OutletVisitsViewTableMap::COL_RCPA_DONE, $rcpaDone['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($rcpaDone['max'])) {
                $this->addUsingAlias(OutletVisitsViewTableMap::COL_RCPA_DONE, $rcpaDone['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletVisitsViewTableMap::COL_RCPA_DONE, $rcpaDone, $comparison);

        return $this;
    }

    /**
     * Filter the query on the sgpi_done column
     *
     * Example usage:
     * <code>
     * $query->filterBySgpiDone(1234); // WHERE sgpi_done = 1234
     * $query->filterBySgpiDone(array(12, 34)); // WHERE sgpi_done IN (12, 34)
     * $query->filterBySgpiDone(array('min' => 12)); // WHERE sgpi_done > 12
     * </code>
     *
     * @param mixed $sgpiDone The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySgpiDone($sgpiDone = null, ?string $comparison = null)
    {
        if (is_array($sgpiDone)) {
            $useMinMax = false;
            if (isset($sgpiDone['min'])) {
                $this->addUsingAlias(OutletVisitsViewTableMap::COL_SGPI_DONE, $sgpiDone['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($sgpiDone['max'])) {
                $this->addUsingAlias(OutletVisitsViewTableMap::COL_SGPI_DONE, $sgpiDone['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletVisitsViewTableMap::COL_SGPI_DONE, $sgpiDone, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_classification column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletClassification(1234); // WHERE outlet_classification = 1234
     * $query->filterByOutletClassification(array(12, 34)); // WHERE outlet_classification IN (12, 34)
     * $query->filterByOutletClassification(array('min' => 12)); // WHERE outlet_classification > 12
     * </code>
     *
     * @param mixed $outletClassification The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletClassification($outletClassification = null, ?string $comparison = null)
    {
        if (is_array($outletClassification)) {
            $useMinMax = false;
            if (isset($outletClassification['min'])) {
                $this->addUsingAlias(OutletVisitsViewTableMap::COL_OUTLET_CLASSIFICATION, $outletClassification['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outletClassification['max'])) {
                $this->addUsingAlias(OutletVisitsViewTableMap::COL_OUTLET_CLASSIFICATION, $outletClassification['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletVisitsViewTableMap::COL_OUTLET_CLASSIFICATION, $outletClassification, $comparison);

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
                $this->addUsingAlias(OutletVisitsViewTableMap::COL_EMPLOYEE_ID, $employeeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($employeeId['max'])) {
                $this->addUsingAlias(OutletVisitsViewTableMap::COL_EMPLOYEE_ID, $employeeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletVisitsViewTableMap::COL_EMPLOYEE_ID, $employeeId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the territory_position column
     *
     * Example usage:
     * <code>
     * $query->filterByTerritoryPosition(1234); // WHERE territory_position = 1234
     * $query->filterByTerritoryPosition(array(12, 34)); // WHERE territory_position IN (12, 34)
     * $query->filterByTerritoryPosition(array('min' => 12)); // WHERE territory_position > 12
     * </code>
     *
     * @param mixed $territoryPosition The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTerritoryPosition($territoryPosition = null, ?string $comparison = null)
    {
        if (is_array($territoryPosition)) {
            $useMinMax = false;
            if (isset($territoryPosition['min'])) {
                $this->addUsingAlias(OutletVisitsViewTableMap::COL_TERRITORY_POSITION, $territoryPosition['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($territoryPosition['max'])) {
                $this->addUsingAlias(OutletVisitsViewTableMap::COL_TERRITORY_POSITION, $territoryPosition['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletVisitsViewTableMap::COL_TERRITORY_POSITION, $territoryPosition, $comparison);

        return $this;
    }

    /**
     * Filter the query on the incharge column
     *
     * Example usage:
     * <code>
     * $query->filterByIncharge(1234); // WHERE incharge = 1234
     * $query->filterByIncharge(array(12, 34)); // WHERE incharge IN (12, 34)
     * $query->filterByIncharge(array('min' => 12)); // WHERE incharge > 12
     * </code>
     *
     * @param mixed $incharge The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIncharge($incharge = null, ?string $comparison = null)
    {
        if (is_array($incharge)) {
            $useMinMax = false;
            if (isset($incharge['min'])) {
                $this->addUsingAlias(OutletVisitsViewTableMap::COL_INCHARGE, $incharge['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($incharge['max'])) {
                $this->addUsingAlias(OutletVisitsViewTableMap::COL_INCHARGE, $incharge['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletVisitsViewTableMap::COL_INCHARGE, $incharge, $comparison);

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildOutletVisitsView $outletVisitsView Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($outletVisitsView = null)
    {
        if ($outletVisitsView) {
            $this->addUsingAlias(OutletVisitsViewTableMap::COL_UNIQUE_ID, $outletVisitsView->getUniqueId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
