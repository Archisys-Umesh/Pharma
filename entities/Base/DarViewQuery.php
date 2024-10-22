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
use entities\DarView as ChildDarView;
use entities\DarViewQuery as ChildDarViewQuery;
use entities\Map\DarViewTableMap;

/**
 * Base class that represents a query for the `dar_view` table.
 *
 * @method     ChildDarViewQuery orderByDcrId($order = Criteria::ASC) Order by the dcr_id column
 * @method     ChildDarViewQuery orderByAgendacontroltype($order = Criteria::ASC) Order by the agendacontroltype column
 * @method     ChildDarViewQuery orderByEmployeeCode($order = Criteria::ASC) Order by the employee_code column
 * @method     ChildDarViewQuery orderByFirstName($order = Criteria::ASC) Order by the first_name column
 * @method     ChildDarViewQuery orderByOutletName($order = Criteria::ASC) Order by the outlet_name column
 * @method     ChildDarViewQuery orderByOutletId($order = Criteria::ASC) Order by the outlet_id column
 * @method     ChildDarViewQuery orderByOutletCode($order = Criteria::ASC) Order by the outlet_code column
 * @method     ChildDarViewQuery orderByAgendname($order = Criteria::ASC) Order by the agendname column
 * @method     ChildDarViewQuery orderByPositionId($order = Criteria::ASC) Order by the position_id column
 * @method     ChildDarViewQuery orderByPositionName($order = Criteria::ASC) Order by the position_name column
 * @method     ChildDarViewQuery orderByStownname($order = Criteria::ASC) Order by the stownname column
 * @method     ChildDarViewQuery orderByDcrDate($order = Criteria::ASC) Order by the dcr_date column
 * @method     ChildDarViewQuery orderByDcrStatus($order = Criteria::ASC) Order by the dcr_status column
 * @method     ChildDarViewQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildDarViewQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildDarViewQuery orderByPlanned($order = Criteria::ASC) Order by the planned column
 * @method     ChildDarViewQuery orderByUnitName($order = Criteria::ASC) Order by the unit_name column
 * @method     ChildDarViewQuery orderByDateTime($order = Criteria::ASC) Order by the datetime column
 * @method     ChildDarViewQuery orderByManagers($order = Criteria::ASC) Order by the managers column
 * @method     ChildDarViewQuery orderByBrandsDetailed($order = Criteria::ASC) Order by the brands_detailed column
 * @method     ChildDarViewQuery orderBySgpiOut($order = Criteria::ASC) Order by the sgpi_out column
 * @method     ChildDarViewQuery orderByPobTotal($order = Criteria::ASC) Order by the pob_total column
 * @method     ChildDarViewQuery orderByEmployeeId($order = Criteria::ASC) Order by the employee_id column
 * @method     ChildDarViewQuery orderByEdDuration($order = Criteria::ASC) Order by the ed_duration column
 * @method     ChildDarViewQuery orderByTerritoryId($order = Criteria::ASC) Order by the territory_id column
 * @method     ChildDarViewQuery orderByOutlettypeId($order = Criteria::ASC) Order by the outlettype_id column
 * @method     ChildDarViewQuery orderByOutlettypeName($order = Criteria::ASC) Order by the outlettype_name column
 * @method     ChildDarViewQuery orderByBeatId($order = Criteria::ASC) Order by the beat_id column
 * @method     ChildDarViewQuery orderByBeatName($order = Criteria::ASC) Order by the beat_name column
 * @method     ChildDarViewQuery orderByTags($order = Criteria::ASC) Order by the tags column
 * @method     ChildDarViewQuery orderByIsjw($order = Criteria::ASC) Order by the isjw column
 * @method     ChildDarViewQuery orderByBrandCampaignName($order = Criteria::ASC) Order by the brand_campaign_name column
 *
 * @method     ChildDarViewQuery groupByDcrId() Group by the dcr_id column
 * @method     ChildDarViewQuery groupByAgendacontroltype() Group by the agendacontroltype column
 * @method     ChildDarViewQuery groupByEmployeeCode() Group by the employee_code column
 * @method     ChildDarViewQuery groupByFirstName() Group by the first_name column
 * @method     ChildDarViewQuery groupByOutletName() Group by the outlet_name column
 * @method     ChildDarViewQuery groupByOutletId() Group by the outlet_id column
 * @method     ChildDarViewQuery groupByOutletCode() Group by the outlet_code column
 * @method     ChildDarViewQuery groupByAgendname() Group by the agendname column
 * @method     ChildDarViewQuery groupByPositionId() Group by the position_id column
 * @method     ChildDarViewQuery groupByPositionName() Group by the position_name column
 * @method     ChildDarViewQuery groupByStownname() Group by the stownname column
 * @method     ChildDarViewQuery groupByDcrDate() Group by the dcr_date column
 * @method     ChildDarViewQuery groupByDcrStatus() Group by the dcr_status column
 * @method     ChildDarViewQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildDarViewQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildDarViewQuery groupByPlanned() Group by the planned column
 * @method     ChildDarViewQuery groupByUnitName() Group by the unit_name column
 * @method     ChildDarViewQuery groupByDateTime() Group by the datetime column
 * @method     ChildDarViewQuery groupByManagers() Group by the managers column
 * @method     ChildDarViewQuery groupByBrandsDetailed() Group by the brands_detailed column
 * @method     ChildDarViewQuery groupBySgpiOut() Group by the sgpi_out column
 * @method     ChildDarViewQuery groupByPobTotal() Group by the pob_total column
 * @method     ChildDarViewQuery groupByEmployeeId() Group by the employee_id column
 * @method     ChildDarViewQuery groupByEdDuration() Group by the ed_duration column
 * @method     ChildDarViewQuery groupByTerritoryId() Group by the territory_id column
 * @method     ChildDarViewQuery groupByOutlettypeId() Group by the outlettype_id column
 * @method     ChildDarViewQuery groupByOutlettypeName() Group by the outlettype_name column
 * @method     ChildDarViewQuery groupByBeatId() Group by the beat_id column
 * @method     ChildDarViewQuery groupByBeatName() Group by the beat_name column
 * @method     ChildDarViewQuery groupByTags() Group by the tags column
 * @method     ChildDarViewQuery groupByIsjw() Group by the isjw column
 * @method     ChildDarViewQuery groupByBrandCampaignName() Group by the brand_campaign_name column
 *
 * @method     ChildDarViewQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildDarViewQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildDarViewQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildDarViewQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildDarViewQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildDarViewQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildDarView|null findOne(?ConnectionInterface $con = null) Return the first ChildDarView matching the query
 * @method     ChildDarView findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildDarView matching the query, or a new ChildDarView object populated from the query conditions when no match is found
 *
 * @method     ChildDarView|null findOneByDcrId(int $dcr_id) Return the first ChildDarView filtered by the dcr_id column
 * @method     ChildDarView|null findOneByAgendacontroltype(string $agendacontroltype) Return the first ChildDarView filtered by the agendacontroltype column
 * @method     ChildDarView|null findOneByEmployeeCode(string $employee_code) Return the first ChildDarView filtered by the employee_code column
 * @method     ChildDarView|null findOneByFirstName(string $first_name) Return the first ChildDarView filtered by the first_name column
 * @method     ChildDarView|null findOneByOutletName(string $outlet_name) Return the first ChildDarView filtered by the outlet_name column
 * @method     ChildDarView|null findOneByOutletId(int $outlet_id) Return the first ChildDarView filtered by the outlet_id column
 * @method     ChildDarView|null findOneByOutletCode(string $outlet_code) Return the first ChildDarView filtered by the outlet_code column
 * @method     ChildDarView|null findOneByAgendname(string $agendname) Return the first ChildDarView filtered by the agendname column
 * @method     ChildDarView|null findOneByPositionId(int $position_id) Return the first ChildDarView filtered by the position_id column
 * @method     ChildDarView|null findOneByPositionName(string $position_name) Return the first ChildDarView filtered by the position_name column
 * @method     ChildDarView|null findOneByStownname(string $stownname) Return the first ChildDarView filtered by the stownname column
 * @method     ChildDarView|null findOneByDcrDate(string $dcr_date) Return the first ChildDarView filtered by the dcr_date column
 * @method     ChildDarView|null findOneByDcrStatus(string $dcr_status) Return the first ChildDarView filtered by the dcr_status column
 * @method     ChildDarView|null findOneByCreatedAt(string $created_at) Return the first ChildDarView filtered by the created_at column
 * @method     ChildDarView|null findOneByUpdatedAt(string $updated_at) Return the first ChildDarView filtered by the updated_at column
 * @method     ChildDarView|null findOneByPlanned(string $planned) Return the first ChildDarView filtered by the planned column
 * @method     ChildDarView|null findOneByUnitName(string $unit_name) Return the first ChildDarView filtered by the unit_name column
 * @method     ChildDarView|null findOneByDateTime(string $datetime) Return the first ChildDarView filtered by the datetime column
 * @method     ChildDarView|null findOneByManagers(string $managers) Return the first ChildDarView filtered by the managers column
 * @method     ChildDarView|null findOneByBrandsDetailed(string $brands_detailed) Return the first ChildDarView filtered by the brands_detailed column
 * @method     ChildDarView|null findOneBySgpiOut(string $sgpi_out) Return the first ChildDarView filtered by the sgpi_out column
 * @method     ChildDarView|null findOneByPobTotal(int $pob_total) Return the first ChildDarView filtered by the pob_total column
 * @method     ChildDarView|null findOneByEmployeeId(int $employee_id) Return the first ChildDarView filtered by the employee_id column
 * @method     ChildDarView|null findOneByEdDuration(int $ed_duration) Return the first ChildDarView filtered by the ed_duration column
 * @method     ChildDarView|null findOneByTerritoryId(int $territory_id) Return the first ChildDarView filtered by the territory_id column
 * @method     ChildDarView|null findOneByOutlettypeId(int $outlettype_id) Return the first ChildDarView filtered by the outlettype_id column
 * @method     ChildDarView|null findOneByOutlettypeName(string $outlettype_name) Return the first ChildDarView filtered by the outlettype_name column
 * @method     ChildDarView|null findOneByBeatId(int $beat_id) Return the first ChildDarView filtered by the beat_id column
 * @method     ChildDarView|null findOneByBeatName(string $beat_name) Return the first ChildDarView filtered by the beat_name column
 * @method     ChildDarView|null findOneByTags(string $tags) Return the first ChildDarView filtered by the tags column
 * @method     ChildDarView|null findOneByIsjw(boolean $isjw) Return the first ChildDarView filtered by the isjw column
 * @method     ChildDarView|null findOneByBrandCampaignName(string $brand_campaign_name) Return the first ChildDarView filtered by the brand_campaign_name column
 *
 * @method     ChildDarView requirePk($key, ?ConnectionInterface $con = null) Return the ChildDarView by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDarView requireOne(?ConnectionInterface $con = null) Return the first ChildDarView matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDarView requireOneByDcrId(int $dcr_id) Return the first ChildDarView filtered by the dcr_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDarView requireOneByAgendacontroltype(string $agendacontroltype) Return the first ChildDarView filtered by the agendacontroltype column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDarView requireOneByEmployeeCode(string $employee_code) Return the first ChildDarView filtered by the employee_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDarView requireOneByFirstName(string $first_name) Return the first ChildDarView filtered by the first_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDarView requireOneByOutletName(string $outlet_name) Return the first ChildDarView filtered by the outlet_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDarView requireOneByOutletId(int $outlet_id) Return the first ChildDarView filtered by the outlet_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDarView requireOneByOutletCode(string $outlet_code) Return the first ChildDarView filtered by the outlet_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDarView requireOneByAgendname(string $agendname) Return the first ChildDarView filtered by the agendname column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDarView requireOneByPositionId(int $position_id) Return the first ChildDarView filtered by the position_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDarView requireOneByPositionName(string $position_name) Return the first ChildDarView filtered by the position_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDarView requireOneByStownname(string $stownname) Return the first ChildDarView filtered by the stownname column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDarView requireOneByDcrDate(string $dcr_date) Return the first ChildDarView filtered by the dcr_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDarView requireOneByDcrStatus(string $dcr_status) Return the first ChildDarView filtered by the dcr_status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDarView requireOneByCreatedAt(string $created_at) Return the first ChildDarView filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDarView requireOneByUpdatedAt(string $updated_at) Return the first ChildDarView filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDarView requireOneByPlanned(string $planned) Return the first ChildDarView filtered by the planned column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDarView requireOneByUnitName(string $unit_name) Return the first ChildDarView filtered by the unit_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDarView requireOneByDateTime(string $datetime) Return the first ChildDarView filtered by the datetime column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDarView requireOneByManagers(string $managers) Return the first ChildDarView filtered by the managers column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDarView requireOneByBrandsDetailed(string $brands_detailed) Return the first ChildDarView filtered by the brands_detailed column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDarView requireOneBySgpiOut(string $sgpi_out) Return the first ChildDarView filtered by the sgpi_out column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDarView requireOneByPobTotal(int $pob_total) Return the first ChildDarView filtered by the pob_total column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDarView requireOneByEmployeeId(int $employee_id) Return the first ChildDarView filtered by the employee_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDarView requireOneByEdDuration(int $ed_duration) Return the first ChildDarView filtered by the ed_duration column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDarView requireOneByTerritoryId(int $territory_id) Return the first ChildDarView filtered by the territory_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDarView requireOneByOutlettypeId(int $outlettype_id) Return the first ChildDarView filtered by the outlettype_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDarView requireOneByOutlettypeName(string $outlettype_name) Return the first ChildDarView filtered by the outlettype_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDarView requireOneByBeatId(int $beat_id) Return the first ChildDarView filtered by the beat_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDarView requireOneByBeatName(string $beat_name) Return the first ChildDarView filtered by the beat_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDarView requireOneByTags(string $tags) Return the first ChildDarView filtered by the tags column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDarView requireOneByIsjw(boolean $isjw) Return the first ChildDarView filtered by the isjw column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDarView requireOneByBrandCampaignName(string $brand_campaign_name) Return the first ChildDarView filtered by the brand_campaign_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDarView[]|Collection find(?ConnectionInterface $con = null) Return ChildDarView objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildDarView> find(?ConnectionInterface $con = null) Return ChildDarView objects based on current ModelCriteria
 *
 * @method     ChildDarView[]|Collection findByDcrId(int|array<int> $dcr_id) Return ChildDarView objects filtered by the dcr_id column
 * @psalm-method Collection&\Traversable<ChildDarView> findByDcrId(int|array<int> $dcr_id) Return ChildDarView objects filtered by the dcr_id column
 * @method     ChildDarView[]|Collection findByAgendacontroltype(string|array<string> $agendacontroltype) Return ChildDarView objects filtered by the agendacontroltype column
 * @psalm-method Collection&\Traversable<ChildDarView> findByAgendacontroltype(string|array<string> $agendacontroltype) Return ChildDarView objects filtered by the agendacontroltype column
 * @method     ChildDarView[]|Collection findByEmployeeCode(string|array<string> $employee_code) Return ChildDarView objects filtered by the employee_code column
 * @psalm-method Collection&\Traversable<ChildDarView> findByEmployeeCode(string|array<string> $employee_code) Return ChildDarView objects filtered by the employee_code column
 * @method     ChildDarView[]|Collection findByFirstName(string|array<string> $first_name) Return ChildDarView objects filtered by the first_name column
 * @psalm-method Collection&\Traversable<ChildDarView> findByFirstName(string|array<string> $first_name) Return ChildDarView objects filtered by the first_name column
 * @method     ChildDarView[]|Collection findByOutletName(string|array<string> $outlet_name) Return ChildDarView objects filtered by the outlet_name column
 * @psalm-method Collection&\Traversable<ChildDarView> findByOutletName(string|array<string> $outlet_name) Return ChildDarView objects filtered by the outlet_name column
 * @method     ChildDarView[]|Collection findByOutletId(int|array<int> $outlet_id) Return ChildDarView objects filtered by the outlet_id column
 * @psalm-method Collection&\Traversable<ChildDarView> findByOutletId(int|array<int> $outlet_id) Return ChildDarView objects filtered by the outlet_id column
 * @method     ChildDarView[]|Collection findByOutletCode(string|array<string> $outlet_code) Return ChildDarView objects filtered by the outlet_code column
 * @psalm-method Collection&\Traversable<ChildDarView> findByOutletCode(string|array<string> $outlet_code) Return ChildDarView objects filtered by the outlet_code column
 * @method     ChildDarView[]|Collection findByAgendname(string|array<string> $agendname) Return ChildDarView objects filtered by the agendname column
 * @psalm-method Collection&\Traversable<ChildDarView> findByAgendname(string|array<string> $agendname) Return ChildDarView objects filtered by the agendname column
 * @method     ChildDarView[]|Collection findByPositionId(int|array<int> $position_id) Return ChildDarView objects filtered by the position_id column
 * @psalm-method Collection&\Traversable<ChildDarView> findByPositionId(int|array<int> $position_id) Return ChildDarView objects filtered by the position_id column
 * @method     ChildDarView[]|Collection findByPositionName(string|array<string> $position_name) Return ChildDarView objects filtered by the position_name column
 * @psalm-method Collection&\Traversable<ChildDarView> findByPositionName(string|array<string> $position_name) Return ChildDarView objects filtered by the position_name column
 * @method     ChildDarView[]|Collection findByStownname(string|array<string> $stownname) Return ChildDarView objects filtered by the stownname column
 * @psalm-method Collection&\Traversable<ChildDarView> findByStownname(string|array<string> $stownname) Return ChildDarView objects filtered by the stownname column
 * @method     ChildDarView[]|Collection findByDcrDate(string|array<string> $dcr_date) Return ChildDarView objects filtered by the dcr_date column
 * @psalm-method Collection&\Traversable<ChildDarView> findByDcrDate(string|array<string> $dcr_date) Return ChildDarView objects filtered by the dcr_date column
 * @method     ChildDarView[]|Collection findByDcrStatus(string|array<string> $dcr_status) Return ChildDarView objects filtered by the dcr_status column
 * @psalm-method Collection&\Traversable<ChildDarView> findByDcrStatus(string|array<string> $dcr_status) Return ChildDarView objects filtered by the dcr_status column
 * @method     ChildDarView[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildDarView objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildDarView> findByCreatedAt(string|array<string> $created_at) Return ChildDarView objects filtered by the created_at column
 * @method     ChildDarView[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildDarView objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildDarView> findByUpdatedAt(string|array<string> $updated_at) Return ChildDarView objects filtered by the updated_at column
 * @method     ChildDarView[]|Collection findByPlanned(string|array<string> $planned) Return ChildDarView objects filtered by the planned column
 * @psalm-method Collection&\Traversable<ChildDarView> findByPlanned(string|array<string> $planned) Return ChildDarView objects filtered by the planned column
 * @method     ChildDarView[]|Collection findByUnitName(string|array<string> $unit_name) Return ChildDarView objects filtered by the unit_name column
 * @psalm-method Collection&\Traversable<ChildDarView> findByUnitName(string|array<string> $unit_name) Return ChildDarView objects filtered by the unit_name column
 * @method     ChildDarView[]|Collection findByDateTime(string|array<string> $datetime) Return ChildDarView objects filtered by the datetime column
 * @psalm-method Collection&\Traversable<ChildDarView> findByDateTime(string|array<string> $datetime) Return ChildDarView objects filtered by the datetime column
 * @method     ChildDarView[]|Collection findByManagers(string|array<string> $managers) Return ChildDarView objects filtered by the managers column
 * @psalm-method Collection&\Traversable<ChildDarView> findByManagers(string|array<string> $managers) Return ChildDarView objects filtered by the managers column
 * @method     ChildDarView[]|Collection findByBrandsDetailed(string|array<string> $brands_detailed) Return ChildDarView objects filtered by the brands_detailed column
 * @psalm-method Collection&\Traversable<ChildDarView> findByBrandsDetailed(string|array<string> $brands_detailed) Return ChildDarView objects filtered by the brands_detailed column
 * @method     ChildDarView[]|Collection findBySgpiOut(string|array<string> $sgpi_out) Return ChildDarView objects filtered by the sgpi_out column
 * @psalm-method Collection&\Traversable<ChildDarView> findBySgpiOut(string|array<string> $sgpi_out) Return ChildDarView objects filtered by the sgpi_out column
 * @method     ChildDarView[]|Collection findByPobTotal(int|array<int> $pob_total) Return ChildDarView objects filtered by the pob_total column
 * @psalm-method Collection&\Traversable<ChildDarView> findByPobTotal(int|array<int> $pob_total) Return ChildDarView objects filtered by the pob_total column
 * @method     ChildDarView[]|Collection findByEmployeeId(int|array<int> $employee_id) Return ChildDarView objects filtered by the employee_id column
 * @psalm-method Collection&\Traversable<ChildDarView> findByEmployeeId(int|array<int> $employee_id) Return ChildDarView objects filtered by the employee_id column
 * @method     ChildDarView[]|Collection findByEdDuration(int|array<int> $ed_duration) Return ChildDarView objects filtered by the ed_duration column
 * @psalm-method Collection&\Traversable<ChildDarView> findByEdDuration(int|array<int> $ed_duration) Return ChildDarView objects filtered by the ed_duration column
 * @method     ChildDarView[]|Collection findByTerritoryId(int|array<int> $territory_id) Return ChildDarView objects filtered by the territory_id column
 * @psalm-method Collection&\Traversable<ChildDarView> findByTerritoryId(int|array<int> $territory_id) Return ChildDarView objects filtered by the territory_id column
 * @method     ChildDarView[]|Collection findByOutlettypeId(int|array<int> $outlettype_id) Return ChildDarView objects filtered by the outlettype_id column
 * @psalm-method Collection&\Traversable<ChildDarView> findByOutlettypeId(int|array<int> $outlettype_id) Return ChildDarView objects filtered by the outlettype_id column
 * @method     ChildDarView[]|Collection findByOutlettypeName(string|array<string> $outlettype_name) Return ChildDarView objects filtered by the outlettype_name column
 * @psalm-method Collection&\Traversable<ChildDarView> findByOutlettypeName(string|array<string> $outlettype_name) Return ChildDarView objects filtered by the outlettype_name column
 * @method     ChildDarView[]|Collection findByBeatId(int|array<int> $beat_id) Return ChildDarView objects filtered by the beat_id column
 * @psalm-method Collection&\Traversable<ChildDarView> findByBeatId(int|array<int> $beat_id) Return ChildDarView objects filtered by the beat_id column
 * @method     ChildDarView[]|Collection findByBeatName(string|array<string> $beat_name) Return ChildDarView objects filtered by the beat_name column
 * @psalm-method Collection&\Traversable<ChildDarView> findByBeatName(string|array<string> $beat_name) Return ChildDarView objects filtered by the beat_name column
 * @method     ChildDarView[]|Collection findByTags(string|array<string> $tags) Return ChildDarView objects filtered by the tags column
 * @psalm-method Collection&\Traversable<ChildDarView> findByTags(string|array<string> $tags) Return ChildDarView objects filtered by the tags column
 * @method     ChildDarView[]|Collection findByIsjw(boolean|array<boolean> $isjw) Return ChildDarView objects filtered by the isjw column
 * @psalm-method Collection&\Traversable<ChildDarView> findByIsjw(boolean|array<boolean> $isjw) Return ChildDarView objects filtered by the isjw column
 * @method     ChildDarView[]|Collection findByBrandCampaignName(string|array<string> $brand_campaign_name) Return ChildDarView objects filtered by the brand_campaign_name column
 * @psalm-method Collection&\Traversable<ChildDarView> findByBrandCampaignName(string|array<string> $brand_campaign_name) Return ChildDarView objects filtered by the brand_campaign_name column
 *
 * @method     ChildDarView[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildDarView> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class DarViewQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\DarViewQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\DarView', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildDarViewQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildDarViewQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildDarViewQuery) {
            return $criteria;
        }
        $query = new ChildDarViewQuery();
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
     * @return ChildDarView|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(DarViewTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = DarViewTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildDarView A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT dcr_id, agendacontroltype, employee_code, first_name, outlet_name, outlet_id, outlet_code, agendname, position_id, position_name, stownname, dcr_date, dcr_status, created_at, updated_at, planned, unit_name, datetime, managers, brands_detailed, sgpi_out, pob_total, employee_id, ed_duration, territory_id, outlettype_id, outlettype_name, beat_id, beat_name, tags, isjw, brand_campaign_name FROM dar_view WHERE dcr_id = :p0';
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
            /** @var ChildDarView $obj */
            $obj = new ChildDarView();
            $obj->hydrate($row);
            DarViewTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildDarView|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(DarViewTableMap::COL_DCR_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(DarViewTableMap::COL_DCR_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the dcr_id column
     *
     * Example usage:
     * <code>
     * $query->filterByDcrId(1234); // WHERE dcr_id = 1234
     * $query->filterByDcrId(array(12, 34)); // WHERE dcr_id IN (12, 34)
     * $query->filterByDcrId(array('min' => 12)); // WHERE dcr_id > 12
     * </code>
     *
     * @param mixed $dcrId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDcrId($dcrId = null, ?string $comparison = null)
    {
        if (is_array($dcrId)) {
            $useMinMax = false;
            if (isset($dcrId['min'])) {
                $this->addUsingAlias(DarViewTableMap::COL_DCR_ID, $dcrId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dcrId['max'])) {
                $this->addUsingAlias(DarViewTableMap::COL_DCR_ID, $dcrId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DarViewTableMap::COL_DCR_ID, $dcrId, $comparison);

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

        $this->addUsingAlias(DarViewTableMap::COL_AGENDACONTROLTYPE, $agendacontroltype, $comparison);

        return $this;
    }

    /**
     * Filter the query on the employee_code column
     *
     * Example usage:
     * <code>
     * $query->filterByEmployeeCode('fooValue');   // WHERE employee_code = 'fooValue'
     * $query->filterByEmployeeCode('%fooValue%', Criteria::LIKE); // WHERE employee_code LIKE '%fooValue%'
     * $query->filterByEmployeeCode(['foo', 'bar']); // WHERE employee_code IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $employeeCode The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmployeeCode($employeeCode = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($employeeCode)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DarViewTableMap::COL_EMPLOYEE_CODE, $employeeCode, $comparison);

        return $this;
    }

    /**
     * Filter the query on the first_name column
     *
     * Example usage:
     * <code>
     * $query->filterByFirstName('fooValue');   // WHERE first_name = 'fooValue'
     * $query->filterByFirstName('%fooValue%', Criteria::LIKE); // WHERE first_name LIKE '%fooValue%'
     * $query->filterByFirstName(['foo', 'bar']); // WHERE first_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $firstName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFirstName($firstName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($firstName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DarViewTableMap::COL_FIRST_NAME, $firstName, $comparison);

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

        $this->addUsingAlias(DarViewTableMap::COL_OUTLET_NAME, $outletName, $comparison);

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
                $this->addUsingAlias(DarViewTableMap::COL_OUTLET_ID, $outletId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outletId['max'])) {
                $this->addUsingAlias(DarViewTableMap::COL_OUTLET_ID, $outletId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DarViewTableMap::COL_OUTLET_ID, $outletId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_code column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletCode('fooValue');   // WHERE outlet_code = 'fooValue'
     * $query->filterByOutletCode('%fooValue%', Criteria::LIKE); // WHERE outlet_code LIKE '%fooValue%'
     * $query->filterByOutletCode(['foo', 'bar']); // WHERE outlet_code IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $outletCode The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletCode($outletCode = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($outletCode)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DarViewTableMap::COL_OUTLET_CODE, $outletCode, $comparison);

        return $this;
    }

    /**
     * Filter the query on the agendname column
     *
     * Example usage:
     * <code>
     * $query->filterByAgendname('fooValue');   // WHERE agendname = 'fooValue'
     * $query->filterByAgendname('%fooValue%', Criteria::LIKE); // WHERE agendname LIKE '%fooValue%'
     * $query->filterByAgendname(['foo', 'bar']); // WHERE agendname IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $agendname The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAgendname($agendname = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($agendname)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DarViewTableMap::COL_AGENDNAME, $agendname, $comparison);

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
                $this->addUsingAlias(DarViewTableMap::COL_POSITION_ID, $positionId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($positionId['max'])) {
                $this->addUsingAlias(DarViewTableMap::COL_POSITION_ID, $positionId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DarViewTableMap::COL_POSITION_ID, $positionId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the position_name column
     *
     * Example usage:
     * <code>
     * $query->filterByPositionName('fooValue');   // WHERE position_name = 'fooValue'
     * $query->filterByPositionName('%fooValue%', Criteria::LIKE); // WHERE position_name LIKE '%fooValue%'
     * $query->filterByPositionName(['foo', 'bar']); // WHERE position_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $positionName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPositionName($positionName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($positionName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DarViewTableMap::COL_POSITION_NAME, $positionName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the stownname column
     *
     * Example usage:
     * <code>
     * $query->filterByStownname('fooValue');   // WHERE stownname = 'fooValue'
     * $query->filterByStownname('%fooValue%', Criteria::LIKE); // WHERE stownname LIKE '%fooValue%'
     * $query->filterByStownname(['foo', 'bar']); // WHERE stownname IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $stownname The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStownname($stownname = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($stownname)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DarViewTableMap::COL_STOWNNAME, $stownname, $comparison);

        return $this;
    }

    /**
     * Filter the query on the dcr_date column
     *
     * Example usage:
     * <code>
     * $query->filterByDcrDate('fooValue');   // WHERE dcr_date = 'fooValue'
     * $query->filterByDcrDate('%fooValue%', Criteria::LIKE); // WHERE dcr_date LIKE '%fooValue%'
     * $query->filterByDcrDate(['foo', 'bar']); // WHERE dcr_date IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $dcrDate The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDcrDate($dcrDate = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($dcrDate)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DarViewTableMap::COL_DCR_DATE, $dcrDate, $comparison);

        return $this;
    }

    /**
     * Filter the query on the dcr_status column
     *
     * Example usage:
     * <code>
     * $query->filterByDcrStatus('fooValue');   // WHERE dcr_status = 'fooValue'
     * $query->filterByDcrStatus('%fooValue%', Criteria::LIKE); // WHERE dcr_status LIKE '%fooValue%'
     * $query->filterByDcrStatus(['foo', 'bar']); // WHERE dcr_status IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $dcrStatus The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDcrStatus($dcrStatus = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($dcrStatus)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DarViewTableMap::COL_DCR_STATUS, $dcrStatus, $comparison);

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
                $this->addUsingAlias(DarViewTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(DarViewTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DarViewTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(DarViewTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(DarViewTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DarViewTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the planned column
     *
     * Example usage:
     * <code>
     * $query->filterByPlanned('fooValue');   // WHERE planned = 'fooValue'
     * $query->filterByPlanned('%fooValue%', Criteria::LIKE); // WHERE planned LIKE '%fooValue%'
     * $query->filterByPlanned(['foo', 'bar']); // WHERE planned IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $planned The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPlanned($planned = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($planned)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DarViewTableMap::COL_PLANNED, $planned, $comparison);

        return $this;
    }

    /**
     * Filter the query on the unit_name column
     *
     * Example usage:
     * <code>
     * $query->filterByUnitName('fooValue');   // WHERE unit_name = 'fooValue'
     * $query->filterByUnitName('%fooValue%', Criteria::LIKE); // WHERE unit_name LIKE '%fooValue%'
     * $query->filterByUnitName(['foo', 'bar']); // WHERE unit_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $unitName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUnitName($unitName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($unitName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DarViewTableMap::COL_UNIT_NAME, $unitName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the datetime column
     *
     * Example usage:
     * <code>
     * $query->filterByDateTime('2011-03-14'); // WHERE datetime = '2011-03-14'
     * $query->filterByDateTime('now'); // WHERE datetime = '2011-03-14'
     * $query->filterByDateTime(array('max' => 'yesterday')); // WHERE datetime > '2011-03-13'
     * </code>
     *
     * @param mixed $dateTime The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDateTime($dateTime = null, ?string $comparison = null)
    {
        if (is_array($dateTime)) {
            $useMinMax = false;
            if (isset($dateTime['min'])) {
                $this->addUsingAlias(DarViewTableMap::COL_DATETIME, $dateTime['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dateTime['max'])) {
                $this->addUsingAlias(DarViewTableMap::COL_DATETIME, $dateTime['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DarViewTableMap::COL_DATETIME, $dateTime, $comparison);

        return $this;
    }

    /**
     * Filter the query on the managers column
     *
     * Example usage:
     * <code>
     * $query->filterByManagers('fooValue');   // WHERE managers = 'fooValue'
     * $query->filterByManagers('%fooValue%', Criteria::LIKE); // WHERE managers LIKE '%fooValue%'
     * $query->filterByManagers(['foo', 'bar']); // WHERE managers IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $managers The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByManagers($managers = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($managers)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DarViewTableMap::COL_MANAGERS, $managers, $comparison);

        return $this;
    }

    /**
     * Filter the query on the brands_detailed column
     *
     * Example usage:
     * <code>
     * $query->filterByBrandsDetailed('fooValue');   // WHERE brands_detailed = 'fooValue'
     * $query->filterByBrandsDetailed('%fooValue%', Criteria::LIKE); // WHERE brands_detailed LIKE '%fooValue%'
     * $query->filterByBrandsDetailed(['foo', 'bar']); // WHERE brands_detailed IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $brandsDetailed The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBrandsDetailed($brandsDetailed = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($brandsDetailed)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DarViewTableMap::COL_BRANDS_DETAILED, $brandsDetailed, $comparison);

        return $this;
    }

    /**
     * Filter the query on the sgpi_out column
     *
     * Example usage:
     * <code>
     * $query->filterBySgpiOut('fooValue');   // WHERE sgpi_out = 'fooValue'
     * $query->filterBySgpiOut('%fooValue%', Criteria::LIKE); // WHERE sgpi_out LIKE '%fooValue%'
     * $query->filterBySgpiOut(['foo', 'bar']); // WHERE sgpi_out IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $sgpiOut The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySgpiOut($sgpiOut = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($sgpiOut)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DarViewTableMap::COL_SGPI_OUT, $sgpiOut, $comparison);

        return $this;
    }

    /**
     * Filter the query on the pob_total column
     *
     * Example usage:
     * <code>
     * $query->filterByPobTotal(1234); // WHERE pob_total = 1234
     * $query->filterByPobTotal(array(12, 34)); // WHERE pob_total IN (12, 34)
     * $query->filterByPobTotal(array('min' => 12)); // WHERE pob_total > 12
     * </code>
     *
     * @param mixed $pobTotal The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPobTotal($pobTotal = null, ?string $comparison = null)
    {
        if (is_array($pobTotal)) {
            $useMinMax = false;
            if (isset($pobTotal['min'])) {
                $this->addUsingAlias(DarViewTableMap::COL_POB_TOTAL, $pobTotal['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($pobTotal['max'])) {
                $this->addUsingAlias(DarViewTableMap::COL_POB_TOTAL, $pobTotal['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DarViewTableMap::COL_POB_TOTAL, $pobTotal, $comparison);

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
                $this->addUsingAlias(DarViewTableMap::COL_EMPLOYEE_ID, $employeeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($employeeId['max'])) {
                $this->addUsingAlias(DarViewTableMap::COL_EMPLOYEE_ID, $employeeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DarViewTableMap::COL_EMPLOYEE_ID, $employeeId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the ed_duration column
     *
     * Example usage:
     * <code>
     * $query->filterByEdDuration(1234); // WHERE ed_duration = 1234
     * $query->filterByEdDuration(array(12, 34)); // WHERE ed_duration IN (12, 34)
     * $query->filterByEdDuration(array('min' => 12)); // WHERE ed_duration > 12
     * </code>
     *
     * @param mixed $edDuration The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEdDuration($edDuration = null, ?string $comparison = null)
    {
        if (is_array($edDuration)) {
            $useMinMax = false;
            if (isset($edDuration['min'])) {
                $this->addUsingAlias(DarViewTableMap::COL_ED_DURATION, $edDuration['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($edDuration['max'])) {
                $this->addUsingAlias(DarViewTableMap::COL_ED_DURATION, $edDuration['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DarViewTableMap::COL_ED_DURATION, $edDuration, $comparison);

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
                $this->addUsingAlias(DarViewTableMap::COL_TERRITORY_ID, $territoryId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($territoryId['max'])) {
                $this->addUsingAlias(DarViewTableMap::COL_TERRITORY_ID, $territoryId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DarViewTableMap::COL_TERRITORY_ID, $territoryId, $comparison);

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
                $this->addUsingAlias(DarViewTableMap::COL_OUTLETTYPE_ID, $outlettypeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outlettypeId['max'])) {
                $this->addUsingAlias(DarViewTableMap::COL_OUTLETTYPE_ID, $outlettypeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DarViewTableMap::COL_OUTLETTYPE_ID, $outlettypeId, $comparison);

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

        $this->addUsingAlias(DarViewTableMap::COL_OUTLETTYPE_NAME, $outlettypeName, $comparison);

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
                $this->addUsingAlias(DarViewTableMap::COL_BEAT_ID, $beatId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($beatId['max'])) {
                $this->addUsingAlias(DarViewTableMap::COL_BEAT_ID, $beatId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DarViewTableMap::COL_BEAT_ID, $beatId, $comparison);

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

        $this->addUsingAlias(DarViewTableMap::COL_BEAT_NAME, $beatName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the tags column
     *
     * Example usage:
     * <code>
     * $query->filterByTags('fooValue');   // WHERE tags = 'fooValue'
     * $query->filterByTags('%fooValue%', Criteria::LIKE); // WHERE tags LIKE '%fooValue%'
     * $query->filterByTags(['foo', 'bar']); // WHERE tags IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $tags The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTags($tags = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tags)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DarViewTableMap::COL_TAGS, $tags, $comparison);

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

        $this->addUsingAlias(DarViewTableMap::COL_ISJW, $isjw, $comparison);

        return $this;
    }

    /**
     * Filter the query on the brand_campaign_name column
     *
     * Example usage:
     * <code>
     * $query->filterByBrandCampaignName('fooValue');   // WHERE brand_campaign_name = 'fooValue'
     * $query->filterByBrandCampaignName('%fooValue%', Criteria::LIKE); // WHERE brand_campaign_name LIKE '%fooValue%'
     * $query->filterByBrandCampaignName(['foo', 'bar']); // WHERE brand_campaign_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $brandCampaignName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBrandCampaignName($brandCampaignName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($brandCampaignName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DarViewTableMap::COL_BRAND_CAMPAIGN_NAME, $brandCampaignName, $comparison);

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildDarView $darView Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($darView = null)
    {
        if ($darView) {
            $this->addUsingAlias(DarViewTableMap::COL_DCR_ID, $darView->getDcrId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
