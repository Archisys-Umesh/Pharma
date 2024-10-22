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
use entities\Tourplans as ChildTourplans;
use entities\TourplansQuery as ChildTourplansQuery;
use entities\Map\TourplansTableMap;

/**
 * Base class that represents a query for the `tourplans` table.
 *
 * @method     ChildTourplansQuery orderByTpId($order = Criteria::ASC) Order by the tp_id column
 * @method     ChildTourplansQuery orderByTpDate($order = Criteria::ASC) Order by the tp_date column
 * @method     ChildTourplansQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildTourplansQuery orderByTpRemark($order = Criteria::ASC) Order by the tp_remark column
 * @method     ChildTourplansQuery orderByPositionId($order = Criteria::ASC) Order by the position_id column
 * @method     ChildTourplansQuery orderByAgendacontroltype($order = Criteria::ASC) Order by the agendacontroltype column
 * @method     ChildTourplansQuery orderByBeatId($order = Criteria::ASC) Order by the beat_id column
 * @method     ChildTourplansQuery orderByItownid($order = Criteria::ASC) Order by the itownid column
 * @method     ChildTourplansQuery orderByWeekday($order = Criteria::ASC) Order by the weekday column
 * @method     ChildTourplansQuery orderByWeeknumber($order = Criteria::ASC) Order by the weeknumber column
 * @method     ChildTourplansQuery orderByAgendaId($order = Criteria::ASC) Order by the agenda_id column
 * @method     ChildTourplansQuery orderByIsjw($order = Criteria::ASC) Order by the isjw column
 * @method     ChildTourplansQuery orderByOutletOrgDataId($order = Criteria::ASC) Order by the outlet_org_data_id column
 * @method     ChildTourplansQuery orderByMtpId($order = Criteria::ASC) Order by the mtp_id column
 * @method     ChildTourplansQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildTourplansQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildTourplansQuery orderByMtpDayId($order = Criteria::ASC) Order by the mtp_day_id column
 * @method     ChildTourplansQuery orderByCampaignVisitPlanId($order = Criteria::ASC) Order by the campaign_visit_plan_id column
 *
 * @method     ChildTourplansQuery groupByTpId() Group by the tp_id column
 * @method     ChildTourplansQuery groupByTpDate() Group by the tp_date column
 * @method     ChildTourplansQuery groupByCompanyId() Group by the company_id column
 * @method     ChildTourplansQuery groupByTpRemark() Group by the tp_remark column
 * @method     ChildTourplansQuery groupByPositionId() Group by the position_id column
 * @method     ChildTourplansQuery groupByAgendacontroltype() Group by the agendacontroltype column
 * @method     ChildTourplansQuery groupByBeatId() Group by the beat_id column
 * @method     ChildTourplansQuery groupByItownid() Group by the itownid column
 * @method     ChildTourplansQuery groupByWeekday() Group by the weekday column
 * @method     ChildTourplansQuery groupByWeeknumber() Group by the weeknumber column
 * @method     ChildTourplansQuery groupByAgendaId() Group by the agenda_id column
 * @method     ChildTourplansQuery groupByIsjw() Group by the isjw column
 * @method     ChildTourplansQuery groupByOutletOrgDataId() Group by the outlet_org_data_id column
 * @method     ChildTourplansQuery groupByMtpId() Group by the mtp_id column
 * @method     ChildTourplansQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildTourplansQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildTourplansQuery groupByMtpDayId() Group by the mtp_day_id column
 * @method     ChildTourplansQuery groupByCampaignVisitPlanId() Group by the campaign_visit_plan_id column
 *
 * @method     ChildTourplansQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildTourplansQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildTourplansQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildTourplansQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildTourplansQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildTourplansQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildTourplansQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildTourplansQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildTourplansQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildTourplansQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildTourplansQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildTourplansQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildTourplansQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     ChildTourplansQuery leftJoinAgendatypes($relationAlias = null) Adds a LEFT JOIN clause to the query using the Agendatypes relation
 * @method     ChildTourplansQuery rightJoinAgendatypes($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Agendatypes relation
 * @method     ChildTourplansQuery innerJoinAgendatypes($relationAlias = null) Adds a INNER JOIN clause to the query using the Agendatypes relation
 *
 * @method     ChildTourplansQuery joinWithAgendatypes($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Agendatypes relation
 *
 * @method     ChildTourplansQuery leftJoinWithAgendatypes() Adds a LEFT JOIN clause and with to the query using the Agendatypes relation
 * @method     ChildTourplansQuery rightJoinWithAgendatypes() Adds a RIGHT JOIN clause and with to the query using the Agendatypes relation
 * @method     ChildTourplansQuery innerJoinWithAgendatypes() Adds a INNER JOIN clause and with to the query using the Agendatypes relation
 *
 * @method     ChildTourplansQuery leftJoinBeats($relationAlias = null) Adds a LEFT JOIN clause to the query using the Beats relation
 * @method     ChildTourplansQuery rightJoinBeats($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Beats relation
 * @method     ChildTourplansQuery innerJoinBeats($relationAlias = null) Adds a INNER JOIN clause to the query using the Beats relation
 *
 * @method     ChildTourplansQuery joinWithBeats($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Beats relation
 *
 * @method     ChildTourplansQuery leftJoinWithBeats() Adds a LEFT JOIN clause and with to the query using the Beats relation
 * @method     ChildTourplansQuery rightJoinWithBeats() Adds a RIGHT JOIN clause and with to the query using the Beats relation
 * @method     ChildTourplansQuery innerJoinWithBeats() Adds a INNER JOIN clause and with to the query using the Beats relation
 *
 * @method     ChildTourplansQuery leftJoinMtpDay($relationAlias = null) Adds a LEFT JOIN clause to the query using the MtpDay relation
 * @method     ChildTourplansQuery rightJoinMtpDay($relationAlias = null) Adds a RIGHT JOIN clause to the query using the MtpDay relation
 * @method     ChildTourplansQuery innerJoinMtpDay($relationAlias = null) Adds a INNER JOIN clause to the query using the MtpDay relation
 *
 * @method     ChildTourplansQuery joinWithMtpDay($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the MtpDay relation
 *
 * @method     ChildTourplansQuery leftJoinWithMtpDay() Adds a LEFT JOIN clause and with to the query using the MtpDay relation
 * @method     ChildTourplansQuery rightJoinWithMtpDay() Adds a RIGHT JOIN clause and with to the query using the MtpDay relation
 * @method     ChildTourplansQuery innerJoinWithMtpDay() Adds a INNER JOIN clause and with to the query using the MtpDay relation
 *
 * @method     ChildTourplansQuery leftJoinGeoTowns($relationAlias = null) Adds a LEFT JOIN clause to the query using the GeoTowns relation
 * @method     ChildTourplansQuery rightJoinGeoTowns($relationAlias = null) Adds a RIGHT JOIN clause to the query using the GeoTowns relation
 * @method     ChildTourplansQuery innerJoinGeoTowns($relationAlias = null) Adds a INNER JOIN clause to the query using the GeoTowns relation
 *
 * @method     ChildTourplansQuery joinWithGeoTowns($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the GeoTowns relation
 *
 * @method     ChildTourplansQuery leftJoinWithGeoTowns() Adds a LEFT JOIN clause and with to the query using the GeoTowns relation
 * @method     ChildTourplansQuery rightJoinWithGeoTowns() Adds a RIGHT JOIN clause and with to the query using the GeoTowns relation
 * @method     ChildTourplansQuery innerJoinWithGeoTowns() Adds a INNER JOIN clause and with to the query using the GeoTowns relation
 *
 * @method     ChildTourplansQuery leftJoinMtp($relationAlias = null) Adds a LEFT JOIN clause to the query using the Mtp relation
 * @method     ChildTourplansQuery rightJoinMtp($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Mtp relation
 * @method     ChildTourplansQuery innerJoinMtp($relationAlias = null) Adds a INNER JOIN clause to the query using the Mtp relation
 *
 * @method     ChildTourplansQuery joinWithMtp($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Mtp relation
 *
 * @method     ChildTourplansQuery leftJoinWithMtp() Adds a LEFT JOIN clause and with to the query using the Mtp relation
 * @method     ChildTourplansQuery rightJoinWithMtp() Adds a RIGHT JOIN clause and with to the query using the Mtp relation
 * @method     ChildTourplansQuery innerJoinWithMtp() Adds a INNER JOIN clause and with to the query using the Mtp relation
 *
 * @method     ChildTourplansQuery leftJoinOutletOrgData($relationAlias = null) Adds a LEFT JOIN clause to the query using the OutletOrgData relation
 * @method     ChildTourplansQuery rightJoinOutletOrgData($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OutletOrgData relation
 * @method     ChildTourplansQuery innerJoinOutletOrgData($relationAlias = null) Adds a INNER JOIN clause to the query using the OutletOrgData relation
 *
 * @method     ChildTourplansQuery joinWithOutletOrgData($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OutletOrgData relation
 *
 * @method     ChildTourplansQuery leftJoinWithOutletOrgData() Adds a LEFT JOIN clause and with to the query using the OutletOrgData relation
 * @method     ChildTourplansQuery rightJoinWithOutletOrgData() Adds a RIGHT JOIN clause and with to the query using the OutletOrgData relation
 * @method     ChildTourplansQuery innerJoinWithOutletOrgData() Adds a INNER JOIN clause and with to the query using the OutletOrgData relation
 *
 * @method     ChildTourplansQuery leftJoinPositions($relationAlias = null) Adds a LEFT JOIN clause to the query using the Positions relation
 * @method     ChildTourplansQuery rightJoinPositions($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Positions relation
 * @method     ChildTourplansQuery innerJoinPositions($relationAlias = null) Adds a INNER JOIN clause to the query using the Positions relation
 *
 * @method     ChildTourplansQuery joinWithPositions($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Positions relation
 *
 * @method     ChildTourplansQuery leftJoinWithPositions() Adds a LEFT JOIN clause and with to the query using the Positions relation
 * @method     ChildTourplansQuery rightJoinWithPositions() Adds a RIGHT JOIN clause and with to the query using the Positions relation
 * @method     ChildTourplansQuery innerJoinWithPositions() Adds a INNER JOIN clause and with to the query using the Positions relation
 *
 * @method     ChildTourplansQuery leftJoinBrandCampiagnVisitPlan($relationAlias = null) Adds a LEFT JOIN clause to the query using the BrandCampiagnVisitPlan relation
 * @method     ChildTourplansQuery rightJoinBrandCampiagnVisitPlan($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BrandCampiagnVisitPlan relation
 * @method     ChildTourplansQuery innerJoinBrandCampiagnVisitPlan($relationAlias = null) Adds a INNER JOIN clause to the query using the BrandCampiagnVisitPlan relation
 *
 * @method     ChildTourplansQuery joinWithBrandCampiagnVisitPlan($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BrandCampiagnVisitPlan relation
 *
 * @method     ChildTourplansQuery leftJoinWithBrandCampiagnVisitPlan() Adds a LEFT JOIN clause and with to the query using the BrandCampiagnVisitPlan relation
 * @method     ChildTourplansQuery rightJoinWithBrandCampiagnVisitPlan() Adds a RIGHT JOIN clause and with to the query using the BrandCampiagnVisitPlan relation
 * @method     ChildTourplansQuery innerJoinWithBrandCampiagnVisitPlan() Adds a INNER JOIN clause and with to the query using the BrandCampiagnVisitPlan relation
 *
 * @method     \entities\CompanyQuery|\entities\AgendatypesQuery|\entities\BeatsQuery|\entities\MtpDayQuery|\entities\GeoTownsQuery|\entities\MtpQuery|\entities\OutletOrgDataQuery|\entities\PositionsQuery|\entities\BrandCampiagnVisitPlanQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildTourplans|null findOne(?ConnectionInterface $con = null) Return the first ChildTourplans matching the query
 * @method     ChildTourplans findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildTourplans matching the query, or a new ChildTourplans object populated from the query conditions when no match is found
 *
 * @method     ChildTourplans|null findOneByTpId(int $tp_id) Return the first ChildTourplans filtered by the tp_id column
 * @method     ChildTourplans|null findOneByTpDate(string $tp_date) Return the first ChildTourplans filtered by the tp_date column
 * @method     ChildTourplans|null findOneByCompanyId(int $company_id) Return the first ChildTourplans filtered by the company_id column
 * @method     ChildTourplans|null findOneByTpRemark(string $tp_remark) Return the first ChildTourplans filtered by the tp_remark column
 * @method     ChildTourplans|null findOneByPositionId(int $position_id) Return the first ChildTourplans filtered by the position_id column
 * @method     ChildTourplans|null findOneByAgendacontroltype(string $agendacontroltype) Return the first ChildTourplans filtered by the agendacontroltype column
 * @method     ChildTourplans|null findOneByBeatId(int $beat_id) Return the first ChildTourplans filtered by the beat_id column
 * @method     ChildTourplans|null findOneByItownid(string $itownid) Return the first ChildTourplans filtered by the itownid column
 * @method     ChildTourplans|null findOneByWeekday(int $weekday) Return the first ChildTourplans filtered by the weekday column
 * @method     ChildTourplans|null findOneByWeeknumber(int $weeknumber) Return the first ChildTourplans filtered by the weeknumber column
 * @method     ChildTourplans|null findOneByAgendaId(int $agenda_id) Return the first ChildTourplans filtered by the agenda_id column
 * @method     ChildTourplans|null findOneByIsjw(boolean $isjw) Return the first ChildTourplans filtered by the isjw column
 * @method     ChildTourplans|null findOneByOutletOrgDataId(string $outlet_org_data_id) Return the first ChildTourplans filtered by the outlet_org_data_id column
 * @method     ChildTourplans|null findOneByMtpId(int $mtp_id) Return the first ChildTourplans filtered by the mtp_id column
 * @method     ChildTourplans|null findOneByCreatedAt(string $created_at) Return the first ChildTourplans filtered by the created_at column
 * @method     ChildTourplans|null findOneByUpdatedAt(string $updated_at) Return the first ChildTourplans filtered by the updated_at column
 * @method     ChildTourplans|null findOneByMtpDayId(int $mtp_day_id) Return the first ChildTourplans filtered by the mtp_day_id column
 * @method     ChildTourplans|null findOneByCampaignVisitPlanId(int $campaign_visit_plan_id) Return the first ChildTourplans filtered by the campaign_visit_plan_id column
 *
 * @method     ChildTourplans requirePk($key, ?ConnectionInterface $con = null) Return the ChildTourplans by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTourplans requireOne(?ConnectionInterface $con = null) Return the first ChildTourplans matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTourplans requireOneByTpId(int $tp_id) Return the first ChildTourplans filtered by the tp_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTourplans requireOneByTpDate(string $tp_date) Return the first ChildTourplans filtered by the tp_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTourplans requireOneByCompanyId(int $company_id) Return the first ChildTourplans filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTourplans requireOneByTpRemark(string $tp_remark) Return the first ChildTourplans filtered by the tp_remark column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTourplans requireOneByPositionId(int $position_id) Return the first ChildTourplans filtered by the position_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTourplans requireOneByAgendacontroltype(string $agendacontroltype) Return the first ChildTourplans filtered by the agendacontroltype column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTourplans requireOneByBeatId(int $beat_id) Return the first ChildTourplans filtered by the beat_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTourplans requireOneByItownid(string $itownid) Return the first ChildTourplans filtered by the itownid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTourplans requireOneByWeekday(int $weekday) Return the first ChildTourplans filtered by the weekday column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTourplans requireOneByWeeknumber(int $weeknumber) Return the first ChildTourplans filtered by the weeknumber column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTourplans requireOneByAgendaId(int $agenda_id) Return the first ChildTourplans filtered by the agenda_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTourplans requireOneByIsjw(boolean $isjw) Return the first ChildTourplans filtered by the isjw column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTourplans requireOneByOutletOrgDataId(string $outlet_org_data_id) Return the first ChildTourplans filtered by the outlet_org_data_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTourplans requireOneByMtpId(int $mtp_id) Return the first ChildTourplans filtered by the mtp_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTourplans requireOneByCreatedAt(string $created_at) Return the first ChildTourplans filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTourplans requireOneByUpdatedAt(string $updated_at) Return the first ChildTourplans filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTourplans requireOneByMtpDayId(int $mtp_day_id) Return the first ChildTourplans filtered by the mtp_day_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTourplans requireOneByCampaignVisitPlanId(int $campaign_visit_plan_id) Return the first ChildTourplans filtered by the campaign_visit_plan_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTourplans[]|Collection find(?ConnectionInterface $con = null) Return ChildTourplans objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildTourplans> find(?ConnectionInterface $con = null) Return ChildTourplans objects based on current ModelCriteria
 *
 * @method     ChildTourplans[]|Collection findByTpId(int|array<int> $tp_id) Return ChildTourplans objects filtered by the tp_id column
 * @psalm-method Collection&\Traversable<ChildTourplans> findByTpId(int|array<int> $tp_id) Return ChildTourplans objects filtered by the tp_id column
 * @method     ChildTourplans[]|Collection findByTpDate(string|array<string> $tp_date) Return ChildTourplans objects filtered by the tp_date column
 * @psalm-method Collection&\Traversable<ChildTourplans> findByTpDate(string|array<string> $tp_date) Return ChildTourplans objects filtered by the tp_date column
 * @method     ChildTourplans[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildTourplans objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildTourplans> findByCompanyId(int|array<int> $company_id) Return ChildTourplans objects filtered by the company_id column
 * @method     ChildTourplans[]|Collection findByTpRemark(string|array<string> $tp_remark) Return ChildTourplans objects filtered by the tp_remark column
 * @psalm-method Collection&\Traversable<ChildTourplans> findByTpRemark(string|array<string> $tp_remark) Return ChildTourplans objects filtered by the tp_remark column
 * @method     ChildTourplans[]|Collection findByPositionId(int|array<int> $position_id) Return ChildTourplans objects filtered by the position_id column
 * @psalm-method Collection&\Traversable<ChildTourplans> findByPositionId(int|array<int> $position_id) Return ChildTourplans objects filtered by the position_id column
 * @method     ChildTourplans[]|Collection findByAgendacontroltype(string|array<string> $agendacontroltype) Return ChildTourplans objects filtered by the agendacontroltype column
 * @psalm-method Collection&\Traversable<ChildTourplans> findByAgendacontroltype(string|array<string> $agendacontroltype) Return ChildTourplans objects filtered by the agendacontroltype column
 * @method     ChildTourplans[]|Collection findByBeatId(int|array<int> $beat_id) Return ChildTourplans objects filtered by the beat_id column
 * @psalm-method Collection&\Traversable<ChildTourplans> findByBeatId(int|array<int> $beat_id) Return ChildTourplans objects filtered by the beat_id column
 * @method     ChildTourplans[]|Collection findByItownid(string|array<string> $itownid) Return ChildTourplans objects filtered by the itownid column
 * @psalm-method Collection&\Traversable<ChildTourplans> findByItownid(string|array<string> $itownid) Return ChildTourplans objects filtered by the itownid column
 * @method     ChildTourplans[]|Collection findByWeekday(int|array<int> $weekday) Return ChildTourplans objects filtered by the weekday column
 * @psalm-method Collection&\Traversable<ChildTourplans> findByWeekday(int|array<int> $weekday) Return ChildTourplans objects filtered by the weekday column
 * @method     ChildTourplans[]|Collection findByWeeknumber(int|array<int> $weeknumber) Return ChildTourplans objects filtered by the weeknumber column
 * @psalm-method Collection&\Traversable<ChildTourplans> findByWeeknumber(int|array<int> $weeknumber) Return ChildTourplans objects filtered by the weeknumber column
 * @method     ChildTourplans[]|Collection findByAgendaId(int|array<int> $agenda_id) Return ChildTourplans objects filtered by the agenda_id column
 * @psalm-method Collection&\Traversable<ChildTourplans> findByAgendaId(int|array<int> $agenda_id) Return ChildTourplans objects filtered by the agenda_id column
 * @method     ChildTourplans[]|Collection findByIsjw(boolean|array<boolean> $isjw) Return ChildTourplans objects filtered by the isjw column
 * @psalm-method Collection&\Traversable<ChildTourplans> findByIsjw(boolean|array<boolean> $isjw) Return ChildTourplans objects filtered by the isjw column
 * @method     ChildTourplans[]|Collection findByOutletOrgDataId(string|array<string> $outlet_org_data_id) Return ChildTourplans objects filtered by the outlet_org_data_id column
 * @psalm-method Collection&\Traversable<ChildTourplans> findByOutletOrgDataId(string|array<string> $outlet_org_data_id) Return ChildTourplans objects filtered by the outlet_org_data_id column
 * @method     ChildTourplans[]|Collection findByMtpId(int|array<int> $mtp_id) Return ChildTourplans objects filtered by the mtp_id column
 * @psalm-method Collection&\Traversable<ChildTourplans> findByMtpId(int|array<int> $mtp_id) Return ChildTourplans objects filtered by the mtp_id column
 * @method     ChildTourplans[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildTourplans objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildTourplans> findByCreatedAt(string|array<string> $created_at) Return ChildTourplans objects filtered by the created_at column
 * @method     ChildTourplans[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildTourplans objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildTourplans> findByUpdatedAt(string|array<string> $updated_at) Return ChildTourplans objects filtered by the updated_at column
 * @method     ChildTourplans[]|Collection findByMtpDayId(int|array<int> $mtp_day_id) Return ChildTourplans objects filtered by the mtp_day_id column
 * @psalm-method Collection&\Traversable<ChildTourplans> findByMtpDayId(int|array<int> $mtp_day_id) Return ChildTourplans objects filtered by the mtp_day_id column
 * @method     ChildTourplans[]|Collection findByCampaignVisitPlanId(int|array<int> $campaign_visit_plan_id) Return ChildTourplans objects filtered by the campaign_visit_plan_id column
 * @psalm-method Collection&\Traversable<ChildTourplans> findByCampaignVisitPlanId(int|array<int> $campaign_visit_plan_id) Return ChildTourplans objects filtered by the campaign_visit_plan_id column
 *
 * @method     ChildTourplans[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildTourplans> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class TourplansQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\TourplansQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\Tourplans', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildTourplansQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildTourplansQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildTourplansQuery) {
            return $criteria;
        }
        $query = new ChildTourplansQuery();
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
     * @return ChildTourplans|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(TourplansTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = TourplansTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildTourplans A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT tp_id, tp_date, company_id, tp_remark, position_id, agendacontroltype, beat_id, itownid, weekday, weeknumber, agenda_id, isjw, outlet_org_data_id, mtp_id, created_at, updated_at, mtp_day_id, campaign_visit_plan_id FROM tourplans WHERE tp_id = :p0';
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
            /** @var ChildTourplans $obj */
            $obj = new ChildTourplans();
            $obj->hydrate($row);
            TourplansTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildTourplans|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(TourplansTableMap::COL_TP_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(TourplansTableMap::COL_TP_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the tp_id column
     *
     * Example usage:
     * <code>
     * $query->filterByTpId(1234); // WHERE tp_id = 1234
     * $query->filterByTpId(array(12, 34)); // WHERE tp_id IN (12, 34)
     * $query->filterByTpId(array('min' => 12)); // WHERE tp_id > 12
     * </code>
     *
     * @param mixed $tpId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTpId($tpId = null, ?string $comparison = null)
    {
        if (is_array($tpId)) {
            $useMinMax = false;
            if (isset($tpId['min'])) {
                $this->addUsingAlias(TourplansTableMap::COL_TP_ID, $tpId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($tpId['max'])) {
                $this->addUsingAlias(TourplansTableMap::COL_TP_ID, $tpId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TourplansTableMap::COL_TP_ID, $tpId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the tp_date column
     *
     * Example usage:
     * <code>
     * $query->filterByTpDate('2011-03-14'); // WHERE tp_date = '2011-03-14'
     * $query->filterByTpDate('now'); // WHERE tp_date = '2011-03-14'
     * $query->filterByTpDate(array('max' => 'yesterday')); // WHERE tp_date > '2011-03-13'
     * </code>
     *
     * @param mixed $tpDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTpDate($tpDate = null, ?string $comparison = null)
    {
        if (is_array($tpDate)) {
            $useMinMax = false;
            if (isset($tpDate['min'])) {
                $this->addUsingAlias(TourplansTableMap::COL_TP_DATE, $tpDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($tpDate['max'])) {
                $this->addUsingAlias(TourplansTableMap::COL_TP_DATE, $tpDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TourplansTableMap::COL_TP_DATE, $tpDate, $comparison);

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
                $this->addUsingAlias(TourplansTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(TourplansTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TourplansTableMap::COL_COMPANY_ID, $companyId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the tp_remark column
     *
     * Example usage:
     * <code>
     * $query->filterByTpRemark('fooValue');   // WHERE tp_remark = 'fooValue'
     * $query->filterByTpRemark('%fooValue%', Criteria::LIKE); // WHERE tp_remark LIKE '%fooValue%'
     * $query->filterByTpRemark(['foo', 'bar']); // WHERE tp_remark IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $tpRemark The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTpRemark($tpRemark = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tpRemark)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TourplansTableMap::COL_TP_REMARK, $tpRemark, $comparison);

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
                $this->addUsingAlias(TourplansTableMap::COL_POSITION_ID, $positionId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($positionId['max'])) {
                $this->addUsingAlias(TourplansTableMap::COL_POSITION_ID, $positionId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TourplansTableMap::COL_POSITION_ID, $positionId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the agendacontroltype column
     *
     * Example usage:
     * <code>
     * $query->filterByAgendacontroltype('fooValue');   // WHERE agendacontroltype = 'fooValue'
     * $query->filterByAgendacontroltype('%fooValue%', Criteria::LIKE); // WHERE agendacontroltype LIKE '%fooValue%'
     * $query->filterByAgendacontroltype(['foo', 'bar']); // WHERE agendacontroltype IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $agendacontroltype The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAgendacontroltype($agendacontroltype = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($agendacontroltype)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TourplansTableMap::COL_AGENDACONTROLTYPE, $agendacontroltype, $comparison);

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
                $this->addUsingAlias(TourplansTableMap::COL_BEAT_ID, $beatId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($beatId['max'])) {
                $this->addUsingAlias(TourplansTableMap::COL_BEAT_ID, $beatId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TourplansTableMap::COL_BEAT_ID, $beatId, $comparison);

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
                $this->addUsingAlias(TourplansTableMap::COL_ITOWNID, $itownid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($itownid['max'])) {
                $this->addUsingAlias(TourplansTableMap::COL_ITOWNID, $itownid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TourplansTableMap::COL_ITOWNID, $itownid, $comparison);

        return $this;
    }

    /**
     * Filter the query on the weekday column
     *
     * Example usage:
     * <code>
     * $query->filterByWeekday(1234); // WHERE weekday = 1234
     * $query->filterByWeekday(array(12, 34)); // WHERE weekday IN (12, 34)
     * $query->filterByWeekday(array('min' => 12)); // WHERE weekday > 12
     * </code>
     *
     * @param mixed $weekday The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWeekday($weekday = null, ?string $comparison = null)
    {
        if (is_array($weekday)) {
            $useMinMax = false;
            if (isset($weekday['min'])) {
                $this->addUsingAlias(TourplansTableMap::COL_WEEKDAY, $weekday['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($weekday['max'])) {
                $this->addUsingAlias(TourplansTableMap::COL_WEEKDAY, $weekday['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TourplansTableMap::COL_WEEKDAY, $weekday, $comparison);

        return $this;
    }

    /**
     * Filter the query on the weeknumber column
     *
     * Example usage:
     * <code>
     * $query->filterByWeeknumber(1234); // WHERE weeknumber = 1234
     * $query->filterByWeeknumber(array(12, 34)); // WHERE weeknumber IN (12, 34)
     * $query->filterByWeeknumber(array('min' => 12)); // WHERE weeknumber > 12
     * </code>
     *
     * @param mixed $weeknumber The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWeeknumber($weeknumber = null, ?string $comparison = null)
    {
        if (is_array($weeknumber)) {
            $useMinMax = false;
            if (isset($weeknumber['min'])) {
                $this->addUsingAlias(TourplansTableMap::COL_WEEKNUMBER, $weeknumber['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($weeknumber['max'])) {
                $this->addUsingAlias(TourplansTableMap::COL_WEEKNUMBER, $weeknumber['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TourplansTableMap::COL_WEEKNUMBER, $weeknumber, $comparison);

        return $this;
    }

    /**
     * Filter the query on the agenda_id column
     *
     * Example usage:
     * <code>
     * $query->filterByAgendaId(1234); // WHERE agenda_id = 1234
     * $query->filterByAgendaId(array(12, 34)); // WHERE agenda_id IN (12, 34)
     * $query->filterByAgendaId(array('min' => 12)); // WHERE agenda_id > 12
     * </code>
     *
     * @see       filterByAgendatypes()
     *
     * @param mixed $agendaId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAgendaId($agendaId = null, ?string $comparison = null)
    {
        if (is_array($agendaId)) {
            $useMinMax = false;
            if (isset($agendaId['min'])) {
                $this->addUsingAlias(TourplansTableMap::COL_AGENDA_ID, $agendaId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($agendaId['max'])) {
                $this->addUsingAlias(TourplansTableMap::COL_AGENDA_ID, $agendaId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TourplansTableMap::COL_AGENDA_ID, $agendaId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the isjw column
     *
     * Example usage:
     * <code>
     * $query->filterByIsjw(true); // WHERE isjw = true
     * $query->filterByIsjw('yes'); // WHERE isjw = true
     * </code>
     *
     * @param bool|string $isjw The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIsjw($isjw = null, ?string $comparison = null)
    {
        if (is_string($isjw)) {
            $isjw = in_array(strtolower($isjw), array('false', 'off', '-', 'no', 'n', '0', ''), true) ? false : true;
        }

        $this->addUsingAlias(TourplansTableMap::COL_ISJW, $isjw, $comparison);

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
     * @see       filterByOutletOrgData()
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
                $this->addUsingAlias(TourplansTableMap::COL_OUTLET_ORG_DATA_ID, $outletOrgDataId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outletOrgDataId['max'])) {
                $this->addUsingAlias(TourplansTableMap::COL_OUTLET_ORG_DATA_ID, $outletOrgDataId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TourplansTableMap::COL_OUTLET_ORG_DATA_ID, $outletOrgDataId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the mtp_id column
     *
     * Example usage:
     * <code>
     * $query->filterByMtpId(1234); // WHERE mtp_id = 1234
     * $query->filterByMtpId(array(12, 34)); // WHERE mtp_id IN (12, 34)
     * $query->filterByMtpId(array('min' => 12)); // WHERE mtp_id > 12
     * </code>
     *
     * @see       filterByMtp()
     *
     * @param mixed $mtpId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMtpId($mtpId = null, ?string $comparison = null)
    {
        if (is_array($mtpId)) {
            $useMinMax = false;
            if (isset($mtpId['min'])) {
                $this->addUsingAlias(TourplansTableMap::COL_MTP_ID, $mtpId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($mtpId['max'])) {
                $this->addUsingAlias(TourplansTableMap::COL_MTP_ID, $mtpId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TourplansTableMap::COL_MTP_ID, $mtpId, $comparison);

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
                $this->addUsingAlias(TourplansTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(TourplansTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TourplansTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(TourplansTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(TourplansTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TourplansTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the mtp_day_id column
     *
     * Example usage:
     * <code>
     * $query->filterByMtpDayId(1234); // WHERE mtp_day_id = 1234
     * $query->filterByMtpDayId(array(12, 34)); // WHERE mtp_day_id IN (12, 34)
     * $query->filterByMtpDayId(array('min' => 12)); // WHERE mtp_day_id > 12
     * </code>
     *
     * @see       filterByMtpDay()
     *
     * @param mixed $mtpDayId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMtpDayId($mtpDayId = null, ?string $comparison = null)
    {
        if (is_array($mtpDayId)) {
            $useMinMax = false;
            if (isset($mtpDayId['min'])) {
                $this->addUsingAlias(TourplansTableMap::COL_MTP_DAY_ID, $mtpDayId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($mtpDayId['max'])) {
                $this->addUsingAlias(TourplansTableMap::COL_MTP_DAY_ID, $mtpDayId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TourplansTableMap::COL_MTP_DAY_ID, $mtpDayId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the campaign_visit_plan_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCampaignVisitPlanId(1234); // WHERE campaign_visit_plan_id = 1234
     * $query->filterByCampaignVisitPlanId(array(12, 34)); // WHERE campaign_visit_plan_id IN (12, 34)
     * $query->filterByCampaignVisitPlanId(array('min' => 12)); // WHERE campaign_visit_plan_id > 12
     * </code>
     *
     * @see       filterByBrandCampiagnVisitPlan()
     *
     * @param mixed $campaignVisitPlanId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCampaignVisitPlanId($campaignVisitPlanId = null, ?string $comparison = null)
    {
        if (is_array($campaignVisitPlanId)) {
            $useMinMax = false;
            if (isset($campaignVisitPlanId['min'])) {
                $this->addUsingAlias(TourplansTableMap::COL_CAMPAIGN_VISIT_PLAN_ID, $campaignVisitPlanId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($campaignVisitPlanId['max'])) {
                $this->addUsingAlias(TourplansTableMap::COL_CAMPAIGN_VISIT_PLAN_ID, $campaignVisitPlanId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TourplansTableMap::COL_CAMPAIGN_VISIT_PLAN_ID, $campaignVisitPlanId, $comparison);

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
                ->addUsingAlias(TourplansTableMap::COL_COMPANY_ID, $company->getCompanyId(), $comparison);
        } elseif ($company instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(TourplansTableMap::COL_COMPANY_ID, $company->toKeyValue('PrimaryKey', 'CompanyId'), $comparison);

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
    public function joinCompany(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
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
    public function useCompanyQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
        ?string $joinType = Criteria::LEFT_JOIN
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
     * Filter the query by a related \entities\Agendatypes object
     *
     * @param \entities\Agendatypes|ObjectCollection $agendatypes The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAgendatypes($agendatypes, ?string $comparison = null)
    {
        if ($agendatypes instanceof \entities\Agendatypes) {
            return $this
                ->addUsingAlias(TourplansTableMap::COL_AGENDA_ID, $agendatypes->getAgendaid(), $comparison);
        } elseif ($agendatypes instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(TourplansTableMap::COL_AGENDA_ID, $agendatypes->toKeyValue('PrimaryKey', 'Agendaid'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByAgendatypes() only accepts arguments of type \entities\Agendatypes or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Agendatypes relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinAgendatypes(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Agendatypes');

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
            $this->addJoinObject($join, 'Agendatypes');
        }

        return $this;
    }

    /**
     * Use the Agendatypes relation Agendatypes object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\AgendatypesQuery A secondary query class using the current class as primary query
     */
    public function useAgendatypesQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinAgendatypes($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Agendatypes', '\entities\AgendatypesQuery');
    }

    /**
     * Use the Agendatypes relation Agendatypes object
     *
     * @param callable(\entities\AgendatypesQuery):\entities\AgendatypesQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withAgendatypesQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useAgendatypesQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Agendatypes table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\AgendatypesQuery The inner query object of the EXISTS statement
     */
    public function useAgendatypesExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\AgendatypesQuery */
        $q = $this->useExistsQuery('Agendatypes', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Agendatypes table for a NOT EXISTS query.
     *
     * @see useAgendatypesExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\AgendatypesQuery The inner query object of the NOT EXISTS statement
     */
    public function useAgendatypesNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\AgendatypesQuery */
        $q = $this->useExistsQuery('Agendatypes', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Agendatypes table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\AgendatypesQuery The inner query object of the IN statement
     */
    public function useInAgendatypesQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\AgendatypesQuery */
        $q = $this->useInQuery('Agendatypes', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Agendatypes table for a NOT IN query.
     *
     * @see useAgendatypesInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\AgendatypesQuery The inner query object of the NOT IN statement
     */
    public function useNotInAgendatypesQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\AgendatypesQuery */
        $q = $this->useInQuery('Agendatypes', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(TourplansTableMap::COL_BEAT_ID, $beats->getBeatId(), $comparison);
        } elseif ($beats instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(TourplansTableMap::COL_BEAT_ID, $beats->toKeyValue('PrimaryKey', 'BeatId'), $comparison);

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
     * Filter the query by a related \entities\MtpDay object
     *
     * @param \entities\MtpDay|ObjectCollection $mtpDay The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMtpDay($mtpDay, ?string $comparison = null)
    {
        if ($mtpDay instanceof \entities\MtpDay) {
            return $this
                ->addUsingAlias(TourplansTableMap::COL_MTP_DAY_ID, $mtpDay->getMtpDayId(), $comparison);
        } elseif ($mtpDay instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(TourplansTableMap::COL_MTP_DAY_ID, $mtpDay->toKeyValue('PrimaryKey', 'MtpDayId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByMtpDay() only accepts arguments of type \entities\MtpDay or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the MtpDay relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinMtpDay(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('MtpDay');

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
            $this->addJoinObject($join, 'MtpDay');
        }

        return $this;
    }

    /**
     * Use the MtpDay relation MtpDay object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\MtpDayQuery A secondary query class using the current class as primary query
     */
    public function useMtpDayQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinMtpDay($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'MtpDay', '\entities\MtpDayQuery');
    }

    /**
     * Use the MtpDay relation MtpDay object
     *
     * @param callable(\entities\MtpDayQuery):\entities\MtpDayQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withMtpDayQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useMtpDayQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to MtpDay table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\MtpDayQuery The inner query object of the EXISTS statement
     */
    public function useMtpDayExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\MtpDayQuery */
        $q = $this->useExistsQuery('MtpDay', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to MtpDay table for a NOT EXISTS query.
     *
     * @see useMtpDayExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\MtpDayQuery The inner query object of the NOT EXISTS statement
     */
    public function useMtpDayNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\MtpDayQuery */
        $q = $this->useExistsQuery('MtpDay', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to MtpDay table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\MtpDayQuery The inner query object of the IN statement
     */
    public function useInMtpDayQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\MtpDayQuery */
        $q = $this->useInQuery('MtpDay', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to MtpDay table for a NOT IN query.
     *
     * @see useMtpDayInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\MtpDayQuery The inner query object of the NOT IN statement
     */
    public function useNotInMtpDayQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\MtpDayQuery */
        $q = $this->useInQuery('MtpDay', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(TourplansTableMap::COL_ITOWNID, $geoTowns->getItownid(), $comparison);
        } elseif ($geoTowns instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(TourplansTableMap::COL_ITOWNID, $geoTowns->toKeyValue('PrimaryKey', 'Itownid'), $comparison);

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
     * Filter the query by a related \entities\Mtp object
     *
     * @param \entities\Mtp|ObjectCollection $mtp The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMtp($mtp, ?string $comparison = null)
    {
        if ($mtp instanceof \entities\Mtp) {
            return $this
                ->addUsingAlias(TourplansTableMap::COL_MTP_ID, $mtp->getMtpId(), $comparison);
        } elseif ($mtp instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(TourplansTableMap::COL_MTP_ID, $mtp->toKeyValue('PrimaryKey', 'MtpId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByMtp() only accepts arguments of type \entities\Mtp or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Mtp relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinMtp(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Mtp');

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
            $this->addJoinObject($join, 'Mtp');
        }

        return $this;
    }

    /**
     * Use the Mtp relation Mtp object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\MtpQuery A secondary query class using the current class as primary query
     */
    public function useMtpQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinMtp($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Mtp', '\entities\MtpQuery');
    }

    /**
     * Use the Mtp relation Mtp object
     *
     * @param callable(\entities\MtpQuery):\entities\MtpQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withMtpQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useMtpQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Mtp table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\MtpQuery The inner query object of the EXISTS statement
     */
    public function useMtpExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\MtpQuery */
        $q = $this->useExistsQuery('Mtp', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Mtp table for a NOT EXISTS query.
     *
     * @see useMtpExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\MtpQuery The inner query object of the NOT EXISTS statement
     */
    public function useMtpNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\MtpQuery */
        $q = $this->useExistsQuery('Mtp', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Mtp table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\MtpQuery The inner query object of the IN statement
     */
    public function useInMtpQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\MtpQuery */
        $q = $this->useInQuery('Mtp', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Mtp table for a NOT IN query.
     *
     * @see useMtpInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\MtpQuery The inner query object of the NOT IN statement
     */
    public function useNotInMtpQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\MtpQuery */
        $q = $this->useInQuery('Mtp', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(TourplansTableMap::COL_OUTLET_ORG_DATA_ID, $outletOrgData->getOutletOrgId(), $comparison);
        } elseif ($outletOrgData instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(TourplansTableMap::COL_OUTLET_ORG_DATA_ID, $outletOrgData->toKeyValue('PrimaryKey', 'OutletOrgId'), $comparison);

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
                ->addUsingAlias(TourplansTableMap::COL_POSITION_ID, $positions->getPositionId(), $comparison);
        } elseif ($positions instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(TourplansTableMap::COL_POSITION_ID, $positions->toKeyValue('PrimaryKey', 'PositionId'), $comparison);

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
     * Filter the query by a related \entities\BrandCampiagnVisitPlan object
     *
     * @param \entities\BrandCampiagnVisitPlan|ObjectCollection $brandCampiagnVisitPlan The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBrandCampiagnVisitPlan($brandCampiagnVisitPlan, ?string $comparison = null)
    {
        if ($brandCampiagnVisitPlan instanceof \entities\BrandCampiagnVisitPlan) {
            return $this
                ->addUsingAlias(TourplansTableMap::COL_CAMPAIGN_VISIT_PLAN_ID, $brandCampiagnVisitPlan->getBrandCampiagnVisitPlanId(), $comparison);
        } elseif ($brandCampiagnVisitPlan instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(TourplansTableMap::COL_CAMPAIGN_VISIT_PLAN_ID, $brandCampiagnVisitPlan->toKeyValue('PrimaryKey', 'BrandCampiagnVisitPlanId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByBrandCampiagnVisitPlan() only accepts arguments of type \entities\BrandCampiagnVisitPlan or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BrandCampiagnVisitPlan relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinBrandCampiagnVisitPlan(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BrandCampiagnVisitPlan');

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
            $this->addJoinObject($join, 'BrandCampiagnVisitPlan');
        }

        return $this;
    }

    /**
     * Use the BrandCampiagnVisitPlan relation BrandCampiagnVisitPlan object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\BrandCampiagnVisitPlanQuery A secondary query class using the current class as primary query
     */
    public function useBrandCampiagnVisitPlanQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinBrandCampiagnVisitPlan($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BrandCampiagnVisitPlan', '\entities\BrandCampiagnVisitPlanQuery');
    }

    /**
     * Use the BrandCampiagnVisitPlan relation BrandCampiagnVisitPlan object
     *
     * @param callable(\entities\BrandCampiagnVisitPlanQuery):\entities\BrandCampiagnVisitPlanQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withBrandCampiagnVisitPlanQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useBrandCampiagnVisitPlanQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to BrandCampiagnVisitPlan table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\BrandCampiagnVisitPlanQuery The inner query object of the EXISTS statement
     */
    public function useBrandCampiagnVisitPlanExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\BrandCampiagnVisitPlanQuery */
        $q = $this->useExistsQuery('BrandCampiagnVisitPlan', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to BrandCampiagnVisitPlan table for a NOT EXISTS query.
     *
     * @see useBrandCampiagnVisitPlanExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\BrandCampiagnVisitPlanQuery The inner query object of the NOT EXISTS statement
     */
    public function useBrandCampiagnVisitPlanNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\BrandCampiagnVisitPlanQuery */
        $q = $this->useExistsQuery('BrandCampiagnVisitPlan', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to BrandCampiagnVisitPlan table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\BrandCampiagnVisitPlanQuery The inner query object of the IN statement
     */
    public function useInBrandCampiagnVisitPlanQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\BrandCampiagnVisitPlanQuery */
        $q = $this->useInQuery('BrandCampiagnVisitPlan', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to BrandCampiagnVisitPlan table for a NOT IN query.
     *
     * @see useBrandCampiagnVisitPlanInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\BrandCampiagnVisitPlanQuery The inner query object of the NOT IN statement
     */
    public function useNotInBrandCampiagnVisitPlanQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\BrandCampiagnVisitPlanQuery */
        $q = $this->useInQuery('BrandCampiagnVisitPlan', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildTourplans $tourplans Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($tourplans = null)
    {
        if ($tourplans) {
            $this->addUsingAlias(TourplansTableMap::COL_TP_ID, $tourplans->getTpId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the tourplans table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(TourplansTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            TourplansTableMap::clearInstancePool();
            TourplansTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(TourplansTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(TourplansTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            TourplansTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            TourplansTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
