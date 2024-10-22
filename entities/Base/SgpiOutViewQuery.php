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
use entities\SgpiOutView as ChildSgpiOutView;
use entities\SgpiOutViewQuery as ChildSgpiOutViewQuery;
use entities\Map\SgpiOutViewTableMap;

/**
 * Base class that represents a query for the `sgpi_out_view` table.
 *
 * @method     ChildSgpiOutViewQuery orderBySgpiVoucherId($order = Criteria::ASC) Order by the sgpi_voucher_id column
 * @method     ChildSgpiOutViewQuery orderByOutlet_orgId($order = Criteria::ASC) Order by the outlet_org_id column
 * @method     ChildSgpiOutViewQuery orderByOrgUnitId($order = Criteria::ASC) Order by the org_unit_id column
 * @method     ChildSgpiOutViewQuery orderByTerritoryId($order = Criteria::ASC) Order by the territory_id column
 * @method     ChildSgpiOutViewQuery orderByPositionId($order = Criteria::ASC) Order by the position_id column
 * @method     ChildSgpiOutViewQuery orderByPositionName($order = Criteria::ASC) Order by the position_name column
 * @method     ChildSgpiOutViewQuery orderByTerritoryName($order = Criteria::ASC) Order by the territory_name column
 * @method     ChildSgpiOutViewQuery orderByBeatId($order = Criteria::ASC) Order by the beat_id column
 * @method     ChildSgpiOutViewQuery orderByBeatName($order = Criteria::ASC) Order by the beat_name column
 * @method     ChildSgpiOutViewQuery orderByTags($order = Criteria::ASC) Order by the tags column
 * @method     ChildSgpiOutViewQuery orderByVisitFq($order = Criteria::ASC) Order by the visit_fq column
 * @method     ChildSgpiOutViewQuery orderByOutletSalutation($order = Criteria::ASC) Order by the outlet_salutation column
 * @method     ChildSgpiOutViewQuery orderByOutletName($order = Criteria::ASC) Order by the outlet_name column
 * @method     ChildSgpiOutViewQuery orderByClassification($order = Criteria::ASC) Order by the classification column
 * @method     ChildSgpiOutViewQuery orderByOutlettypeName($order = Criteria::ASC) Order by the outlettype_name column
 * @method     ChildSgpiOutViewQuery orderBySgpiName($order = Criteria::ASC) Order by the sgpi_name column
 * @method     ChildSgpiOutViewQuery orderBySgpiCode($order = Criteria::ASC) Order by the sgpi_code column
 * @method     ChildSgpiOutViewQuery orderByMaterialSku($order = Criteria::ASC) Order by the material_sku column
 * @method     ChildSgpiOutViewQuery orderBySgpiType($order = Criteria::ASC) Order by the sgpi_type column
 * @method     ChildSgpiOutViewQuery orderBySgpiQty($order = Criteria::ASC) Order by the sgpi_qty column
 * @method     ChildSgpiOutViewQuery orderByDcrId($order = Criteria::ASC) Order by the dcr_id column
 * @method     ChildSgpiOutViewQuery orderByDcrDate($order = Criteria::ASC) Order by the dcr_date column
 * @method     ChildSgpiOutViewQuery orderByBrandsDetailed($order = Criteria::ASC) Order by the brands_detailed column
 * @method     ChildSgpiOutViewQuery orderByDeviceTime($order = Criteria::ASC) Order by the device_time column
 * @method     ChildSgpiOutViewQuery orderByManagers($order = Criteria::ASC) Order by the managers column
 * @method     ChildSgpiOutViewQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildSgpiOutViewQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildSgpiOutViewQuery orderByBrandId($order = Criteria::ASC) Order by the brand_id column
 *
 * @method     ChildSgpiOutViewQuery groupBySgpiVoucherId() Group by the sgpi_voucher_id column
 * @method     ChildSgpiOutViewQuery groupByOutlet_orgId() Group by the outlet_org_id column
 * @method     ChildSgpiOutViewQuery groupByOrgUnitId() Group by the org_unit_id column
 * @method     ChildSgpiOutViewQuery groupByTerritoryId() Group by the territory_id column
 * @method     ChildSgpiOutViewQuery groupByPositionId() Group by the position_id column
 * @method     ChildSgpiOutViewQuery groupByPositionName() Group by the position_name column
 * @method     ChildSgpiOutViewQuery groupByTerritoryName() Group by the territory_name column
 * @method     ChildSgpiOutViewQuery groupByBeatId() Group by the beat_id column
 * @method     ChildSgpiOutViewQuery groupByBeatName() Group by the beat_name column
 * @method     ChildSgpiOutViewQuery groupByTags() Group by the tags column
 * @method     ChildSgpiOutViewQuery groupByVisitFq() Group by the visit_fq column
 * @method     ChildSgpiOutViewQuery groupByOutletSalutation() Group by the outlet_salutation column
 * @method     ChildSgpiOutViewQuery groupByOutletName() Group by the outlet_name column
 * @method     ChildSgpiOutViewQuery groupByClassification() Group by the classification column
 * @method     ChildSgpiOutViewQuery groupByOutlettypeName() Group by the outlettype_name column
 * @method     ChildSgpiOutViewQuery groupBySgpiName() Group by the sgpi_name column
 * @method     ChildSgpiOutViewQuery groupBySgpiCode() Group by the sgpi_code column
 * @method     ChildSgpiOutViewQuery groupByMaterialSku() Group by the material_sku column
 * @method     ChildSgpiOutViewQuery groupBySgpiType() Group by the sgpi_type column
 * @method     ChildSgpiOutViewQuery groupBySgpiQty() Group by the sgpi_qty column
 * @method     ChildSgpiOutViewQuery groupByDcrId() Group by the dcr_id column
 * @method     ChildSgpiOutViewQuery groupByDcrDate() Group by the dcr_date column
 * @method     ChildSgpiOutViewQuery groupByBrandsDetailed() Group by the brands_detailed column
 * @method     ChildSgpiOutViewQuery groupByDeviceTime() Group by the device_time column
 * @method     ChildSgpiOutViewQuery groupByManagers() Group by the managers column
 * @method     ChildSgpiOutViewQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildSgpiOutViewQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildSgpiOutViewQuery groupByBrandId() Group by the brand_id column
 *
 * @method     ChildSgpiOutViewQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSgpiOutViewQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSgpiOutViewQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSgpiOutViewQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSgpiOutViewQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSgpiOutViewQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSgpiOutView|null findOne(?ConnectionInterface $con = null) Return the first ChildSgpiOutView matching the query
 * @method     ChildSgpiOutView findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSgpiOutView matching the query, or a new ChildSgpiOutView object populated from the query conditions when no match is found
 *
 * @method     ChildSgpiOutView|null findOneBySgpiVoucherId(int $sgpi_voucher_id) Return the first ChildSgpiOutView filtered by the sgpi_voucher_id column
 * @method     ChildSgpiOutView|null findOneByOutlet_orgId(int $outlet_org_id) Return the first ChildSgpiOutView filtered by the outlet_org_id column
 * @method     ChildSgpiOutView|null findOneByOrgUnitId(int $org_unit_id) Return the first ChildSgpiOutView filtered by the org_unit_id column
 * @method     ChildSgpiOutView|null findOneByTerritoryId(int $territory_id) Return the first ChildSgpiOutView filtered by the territory_id column
 * @method     ChildSgpiOutView|null findOneByPositionId(int $position_id) Return the first ChildSgpiOutView filtered by the position_id column
 * @method     ChildSgpiOutView|null findOneByPositionName(string $position_name) Return the first ChildSgpiOutView filtered by the position_name column
 * @method     ChildSgpiOutView|null findOneByTerritoryName(string $territory_name) Return the first ChildSgpiOutView filtered by the territory_name column
 * @method     ChildSgpiOutView|null findOneByBeatId(int $beat_id) Return the first ChildSgpiOutView filtered by the beat_id column
 * @method     ChildSgpiOutView|null findOneByBeatName(string $beat_name) Return the first ChildSgpiOutView filtered by the beat_name column
 * @method     ChildSgpiOutView|null findOneByTags(string $tags) Return the first ChildSgpiOutView filtered by the tags column
 * @method     ChildSgpiOutView|null findOneByVisitFq(int $visit_fq) Return the first ChildSgpiOutView filtered by the visit_fq column
 * @method     ChildSgpiOutView|null findOneByOutletSalutation(string $outlet_salutation) Return the first ChildSgpiOutView filtered by the outlet_salutation column
 * @method     ChildSgpiOutView|null findOneByOutletName(string $outlet_name) Return the first ChildSgpiOutView filtered by the outlet_name column
 * @method     ChildSgpiOutView|null findOneByClassification(string $classification) Return the first ChildSgpiOutView filtered by the classification column
 * @method     ChildSgpiOutView|null findOneByOutlettypeName(string $outlettype_name) Return the first ChildSgpiOutView filtered by the outlettype_name column
 * @method     ChildSgpiOutView|null findOneBySgpiName(string $sgpi_name) Return the first ChildSgpiOutView filtered by the sgpi_name column
 * @method     ChildSgpiOutView|null findOneBySgpiCode(string $sgpi_code) Return the first ChildSgpiOutView filtered by the sgpi_code column
 * @method     ChildSgpiOutView|null findOneByMaterialSku(string $material_sku) Return the first ChildSgpiOutView filtered by the material_sku column
 * @method     ChildSgpiOutView|null findOneBySgpiType(string $sgpi_type) Return the first ChildSgpiOutView filtered by the sgpi_type column
 * @method     ChildSgpiOutView|null findOneBySgpiQty(int $sgpi_qty) Return the first ChildSgpiOutView filtered by the sgpi_qty column
 * @method     ChildSgpiOutView|null findOneByDcrId(int $dcr_id) Return the first ChildSgpiOutView filtered by the dcr_id column
 * @method     ChildSgpiOutView|null findOneByDcrDate(string $dcr_date) Return the first ChildSgpiOutView filtered by the dcr_date column
 * @method     ChildSgpiOutView|null findOneByBrandsDetailed(string $brands_detailed) Return the first ChildSgpiOutView filtered by the brands_detailed column
 * @method     ChildSgpiOutView|null findOneByDeviceTime(string $device_time) Return the first ChildSgpiOutView filtered by the device_time column
 * @method     ChildSgpiOutView|null findOneByManagers(string $managers) Return the first ChildSgpiOutView filtered by the managers column
 * @method     ChildSgpiOutView|null findOneByCreatedAt(string $created_at) Return the first ChildSgpiOutView filtered by the created_at column
 * @method     ChildSgpiOutView|null findOneByUpdatedAt(string $updated_at) Return the first ChildSgpiOutView filtered by the updated_at column
 * @method     ChildSgpiOutView|null findOneByBrandId(int $brand_id) Return the first ChildSgpiOutView filtered by the brand_id column
 *
 * @method     ChildSgpiOutView requirePk($key, ?ConnectionInterface $con = null) Return the ChildSgpiOutView by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiOutView requireOne(?ConnectionInterface $con = null) Return the first ChildSgpiOutView matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSgpiOutView requireOneBySgpiVoucherId(int $sgpi_voucher_id) Return the first ChildSgpiOutView filtered by the sgpi_voucher_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiOutView requireOneByOutlet_orgId(int $outlet_org_id) Return the first ChildSgpiOutView filtered by the outlet_org_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiOutView requireOneByOrgUnitId(int $org_unit_id) Return the first ChildSgpiOutView filtered by the org_unit_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiOutView requireOneByTerritoryId(int $territory_id) Return the first ChildSgpiOutView filtered by the territory_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiOutView requireOneByPositionId(int $position_id) Return the first ChildSgpiOutView filtered by the position_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiOutView requireOneByPositionName(string $position_name) Return the first ChildSgpiOutView filtered by the position_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiOutView requireOneByTerritoryName(string $territory_name) Return the first ChildSgpiOutView filtered by the territory_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiOutView requireOneByBeatId(int $beat_id) Return the first ChildSgpiOutView filtered by the beat_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiOutView requireOneByBeatName(string $beat_name) Return the first ChildSgpiOutView filtered by the beat_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiOutView requireOneByTags(string $tags) Return the first ChildSgpiOutView filtered by the tags column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiOutView requireOneByVisitFq(int $visit_fq) Return the first ChildSgpiOutView filtered by the visit_fq column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiOutView requireOneByOutletSalutation(string $outlet_salutation) Return the first ChildSgpiOutView filtered by the outlet_salutation column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiOutView requireOneByOutletName(string $outlet_name) Return the first ChildSgpiOutView filtered by the outlet_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiOutView requireOneByClassification(string $classification) Return the first ChildSgpiOutView filtered by the classification column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiOutView requireOneByOutlettypeName(string $outlettype_name) Return the first ChildSgpiOutView filtered by the outlettype_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiOutView requireOneBySgpiName(string $sgpi_name) Return the first ChildSgpiOutView filtered by the sgpi_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiOutView requireOneBySgpiCode(string $sgpi_code) Return the first ChildSgpiOutView filtered by the sgpi_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiOutView requireOneByMaterialSku(string $material_sku) Return the first ChildSgpiOutView filtered by the material_sku column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiOutView requireOneBySgpiType(string $sgpi_type) Return the first ChildSgpiOutView filtered by the sgpi_type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiOutView requireOneBySgpiQty(int $sgpi_qty) Return the first ChildSgpiOutView filtered by the sgpi_qty column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiOutView requireOneByDcrId(int $dcr_id) Return the first ChildSgpiOutView filtered by the dcr_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiOutView requireOneByDcrDate(string $dcr_date) Return the first ChildSgpiOutView filtered by the dcr_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiOutView requireOneByBrandsDetailed(string $brands_detailed) Return the first ChildSgpiOutView filtered by the brands_detailed column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiOutView requireOneByDeviceTime(string $device_time) Return the first ChildSgpiOutView filtered by the device_time column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiOutView requireOneByManagers(string $managers) Return the first ChildSgpiOutView filtered by the managers column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiOutView requireOneByCreatedAt(string $created_at) Return the first ChildSgpiOutView filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiOutView requireOneByUpdatedAt(string $updated_at) Return the first ChildSgpiOutView filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiOutView requireOneByBrandId(int $brand_id) Return the first ChildSgpiOutView filtered by the brand_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSgpiOutView[]|Collection find(?ConnectionInterface $con = null) Return ChildSgpiOutView objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSgpiOutView> find(?ConnectionInterface $con = null) Return ChildSgpiOutView objects based on current ModelCriteria
 *
 * @method     ChildSgpiOutView[]|Collection findBySgpiVoucherId(int|array<int> $sgpi_voucher_id) Return ChildSgpiOutView objects filtered by the sgpi_voucher_id column
 * @psalm-method Collection&\Traversable<ChildSgpiOutView> findBySgpiVoucherId(int|array<int> $sgpi_voucher_id) Return ChildSgpiOutView objects filtered by the sgpi_voucher_id column
 * @method     ChildSgpiOutView[]|Collection findByOutlet_orgId(int|array<int> $outlet_org_id) Return ChildSgpiOutView objects filtered by the outlet_org_id column
 * @psalm-method Collection&\Traversable<ChildSgpiOutView> findByOutlet_orgId(int|array<int> $outlet_org_id) Return ChildSgpiOutView objects filtered by the outlet_org_id column
 * @method     ChildSgpiOutView[]|Collection findByOrgUnitId(int|array<int> $org_unit_id) Return ChildSgpiOutView objects filtered by the org_unit_id column
 * @psalm-method Collection&\Traversable<ChildSgpiOutView> findByOrgUnitId(int|array<int> $org_unit_id) Return ChildSgpiOutView objects filtered by the org_unit_id column
 * @method     ChildSgpiOutView[]|Collection findByTerritoryId(int|array<int> $territory_id) Return ChildSgpiOutView objects filtered by the territory_id column
 * @psalm-method Collection&\Traversable<ChildSgpiOutView> findByTerritoryId(int|array<int> $territory_id) Return ChildSgpiOutView objects filtered by the territory_id column
 * @method     ChildSgpiOutView[]|Collection findByPositionId(int|array<int> $position_id) Return ChildSgpiOutView objects filtered by the position_id column
 * @psalm-method Collection&\Traversable<ChildSgpiOutView> findByPositionId(int|array<int> $position_id) Return ChildSgpiOutView objects filtered by the position_id column
 * @method     ChildSgpiOutView[]|Collection findByPositionName(string|array<string> $position_name) Return ChildSgpiOutView objects filtered by the position_name column
 * @psalm-method Collection&\Traversable<ChildSgpiOutView> findByPositionName(string|array<string> $position_name) Return ChildSgpiOutView objects filtered by the position_name column
 * @method     ChildSgpiOutView[]|Collection findByTerritoryName(string|array<string> $territory_name) Return ChildSgpiOutView objects filtered by the territory_name column
 * @psalm-method Collection&\Traversable<ChildSgpiOutView> findByTerritoryName(string|array<string> $territory_name) Return ChildSgpiOutView objects filtered by the territory_name column
 * @method     ChildSgpiOutView[]|Collection findByBeatId(int|array<int> $beat_id) Return ChildSgpiOutView objects filtered by the beat_id column
 * @psalm-method Collection&\Traversable<ChildSgpiOutView> findByBeatId(int|array<int> $beat_id) Return ChildSgpiOutView objects filtered by the beat_id column
 * @method     ChildSgpiOutView[]|Collection findByBeatName(string|array<string> $beat_name) Return ChildSgpiOutView objects filtered by the beat_name column
 * @psalm-method Collection&\Traversable<ChildSgpiOutView> findByBeatName(string|array<string> $beat_name) Return ChildSgpiOutView objects filtered by the beat_name column
 * @method     ChildSgpiOutView[]|Collection findByTags(string|array<string> $tags) Return ChildSgpiOutView objects filtered by the tags column
 * @psalm-method Collection&\Traversable<ChildSgpiOutView> findByTags(string|array<string> $tags) Return ChildSgpiOutView objects filtered by the tags column
 * @method     ChildSgpiOutView[]|Collection findByVisitFq(int|array<int> $visit_fq) Return ChildSgpiOutView objects filtered by the visit_fq column
 * @psalm-method Collection&\Traversable<ChildSgpiOutView> findByVisitFq(int|array<int> $visit_fq) Return ChildSgpiOutView objects filtered by the visit_fq column
 * @method     ChildSgpiOutView[]|Collection findByOutletSalutation(string|array<string> $outlet_salutation) Return ChildSgpiOutView objects filtered by the outlet_salutation column
 * @psalm-method Collection&\Traversable<ChildSgpiOutView> findByOutletSalutation(string|array<string> $outlet_salutation) Return ChildSgpiOutView objects filtered by the outlet_salutation column
 * @method     ChildSgpiOutView[]|Collection findByOutletName(string|array<string> $outlet_name) Return ChildSgpiOutView objects filtered by the outlet_name column
 * @psalm-method Collection&\Traversable<ChildSgpiOutView> findByOutletName(string|array<string> $outlet_name) Return ChildSgpiOutView objects filtered by the outlet_name column
 * @method     ChildSgpiOutView[]|Collection findByClassification(string|array<string> $classification) Return ChildSgpiOutView objects filtered by the classification column
 * @psalm-method Collection&\Traversable<ChildSgpiOutView> findByClassification(string|array<string> $classification) Return ChildSgpiOutView objects filtered by the classification column
 * @method     ChildSgpiOutView[]|Collection findByOutlettypeName(string|array<string> $outlettype_name) Return ChildSgpiOutView objects filtered by the outlettype_name column
 * @psalm-method Collection&\Traversable<ChildSgpiOutView> findByOutlettypeName(string|array<string> $outlettype_name) Return ChildSgpiOutView objects filtered by the outlettype_name column
 * @method     ChildSgpiOutView[]|Collection findBySgpiName(string|array<string> $sgpi_name) Return ChildSgpiOutView objects filtered by the sgpi_name column
 * @psalm-method Collection&\Traversable<ChildSgpiOutView> findBySgpiName(string|array<string> $sgpi_name) Return ChildSgpiOutView objects filtered by the sgpi_name column
 * @method     ChildSgpiOutView[]|Collection findBySgpiCode(string|array<string> $sgpi_code) Return ChildSgpiOutView objects filtered by the sgpi_code column
 * @psalm-method Collection&\Traversable<ChildSgpiOutView> findBySgpiCode(string|array<string> $sgpi_code) Return ChildSgpiOutView objects filtered by the sgpi_code column
 * @method     ChildSgpiOutView[]|Collection findByMaterialSku(string|array<string> $material_sku) Return ChildSgpiOutView objects filtered by the material_sku column
 * @psalm-method Collection&\Traversable<ChildSgpiOutView> findByMaterialSku(string|array<string> $material_sku) Return ChildSgpiOutView objects filtered by the material_sku column
 * @method     ChildSgpiOutView[]|Collection findBySgpiType(string|array<string> $sgpi_type) Return ChildSgpiOutView objects filtered by the sgpi_type column
 * @psalm-method Collection&\Traversable<ChildSgpiOutView> findBySgpiType(string|array<string> $sgpi_type) Return ChildSgpiOutView objects filtered by the sgpi_type column
 * @method     ChildSgpiOutView[]|Collection findBySgpiQty(int|array<int> $sgpi_qty) Return ChildSgpiOutView objects filtered by the sgpi_qty column
 * @psalm-method Collection&\Traversable<ChildSgpiOutView> findBySgpiQty(int|array<int> $sgpi_qty) Return ChildSgpiOutView objects filtered by the sgpi_qty column
 * @method     ChildSgpiOutView[]|Collection findByDcrId(int|array<int> $dcr_id) Return ChildSgpiOutView objects filtered by the dcr_id column
 * @psalm-method Collection&\Traversable<ChildSgpiOutView> findByDcrId(int|array<int> $dcr_id) Return ChildSgpiOutView objects filtered by the dcr_id column
 * @method     ChildSgpiOutView[]|Collection findByDcrDate(string|array<string> $dcr_date) Return ChildSgpiOutView objects filtered by the dcr_date column
 * @psalm-method Collection&\Traversable<ChildSgpiOutView> findByDcrDate(string|array<string> $dcr_date) Return ChildSgpiOutView objects filtered by the dcr_date column
 * @method     ChildSgpiOutView[]|Collection findByBrandsDetailed(string|array<string> $brands_detailed) Return ChildSgpiOutView objects filtered by the brands_detailed column
 * @psalm-method Collection&\Traversable<ChildSgpiOutView> findByBrandsDetailed(string|array<string> $brands_detailed) Return ChildSgpiOutView objects filtered by the brands_detailed column
 * @method     ChildSgpiOutView[]|Collection findByDeviceTime(string|array<string> $device_time) Return ChildSgpiOutView objects filtered by the device_time column
 * @psalm-method Collection&\Traversable<ChildSgpiOutView> findByDeviceTime(string|array<string> $device_time) Return ChildSgpiOutView objects filtered by the device_time column
 * @method     ChildSgpiOutView[]|Collection findByManagers(string|array<string> $managers) Return ChildSgpiOutView objects filtered by the managers column
 * @psalm-method Collection&\Traversable<ChildSgpiOutView> findByManagers(string|array<string> $managers) Return ChildSgpiOutView objects filtered by the managers column
 * @method     ChildSgpiOutView[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildSgpiOutView objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildSgpiOutView> findByCreatedAt(string|array<string> $created_at) Return ChildSgpiOutView objects filtered by the created_at column
 * @method     ChildSgpiOutView[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildSgpiOutView objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildSgpiOutView> findByUpdatedAt(string|array<string> $updated_at) Return ChildSgpiOutView objects filtered by the updated_at column
 * @method     ChildSgpiOutView[]|Collection findByBrandId(int|array<int> $brand_id) Return ChildSgpiOutView objects filtered by the brand_id column
 * @psalm-method Collection&\Traversable<ChildSgpiOutView> findByBrandId(int|array<int> $brand_id) Return ChildSgpiOutView objects filtered by the brand_id column
 *
 * @method     ChildSgpiOutView[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSgpiOutView> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SgpiOutViewQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\SgpiOutViewQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\SgpiOutView', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSgpiOutViewQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSgpiOutViewQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSgpiOutViewQuery) {
            return $criteria;
        }
        $query = new ChildSgpiOutViewQuery();
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
     * @return ChildSgpiOutView|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SgpiOutViewTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = SgpiOutViewTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSgpiOutView A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT sgpi_voucher_id, outlet_org_id, org_unit_id, territory_id, position_id, position_name, territory_name, beat_id, beat_name, tags, visit_fq, outlet_salutation, outlet_name, classification, outlettype_name, sgpi_name, sgpi_code, material_sku, sgpi_type, sgpi_qty, dcr_id, dcr_date, brands_detailed, device_time, managers, created_at, updated_at, brand_id FROM sgpi_out_view WHERE sgpi_voucher_id = :p0';
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
            /** @var ChildSgpiOutView $obj */
            $obj = new ChildSgpiOutView();
            $obj->hydrate($row);
            SgpiOutViewTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSgpiOutView|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SgpiOutViewTableMap::COL_SGPI_VOUCHER_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SgpiOutViewTableMap::COL_SGPI_VOUCHER_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the sgpi_voucher_id column
     *
     * Example usage:
     * <code>
     * $query->filterBySgpiVoucherId(1234); // WHERE sgpi_voucher_id = 1234
     * $query->filterBySgpiVoucherId(array(12, 34)); // WHERE sgpi_voucher_id IN (12, 34)
     * $query->filterBySgpiVoucherId(array('min' => 12)); // WHERE sgpi_voucher_id > 12
     * </code>
     *
     * @param mixed $sgpiVoucherId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySgpiVoucherId($sgpiVoucherId = null, ?string $comparison = null)
    {
        if (is_array($sgpiVoucherId)) {
            $useMinMax = false;
            if (isset($sgpiVoucherId['min'])) {
                $this->addUsingAlias(SgpiOutViewTableMap::COL_SGPI_VOUCHER_ID, $sgpiVoucherId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($sgpiVoucherId['max'])) {
                $this->addUsingAlias(SgpiOutViewTableMap::COL_SGPI_VOUCHER_ID, $sgpiVoucherId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiOutViewTableMap::COL_SGPI_VOUCHER_ID, $sgpiVoucherId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_org_id column
     *
     * Example usage:
     * <code>
     * $query->filterByOutlet_orgId(1234); // WHERE outlet_org_id = 1234
     * $query->filterByOutlet_orgId(array(12, 34)); // WHERE outlet_org_id IN (12, 34)
     * $query->filterByOutlet_orgId(array('min' => 12)); // WHERE outlet_org_id > 12
     * </code>
     *
     * @param mixed $outlet_orgId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutlet_orgId($outlet_orgId = null, ?string $comparison = null)
    {
        if (is_array($outlet_orgId)) {
            $useMinMax = false;
            if (isset($outlet_orgId['min'])) {
                $this->addUsingAlias(SgpiOutViewTableMap::COL_OUTLET_ORG_ID, $outlet_orgId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outlet_orgId['max'])) {
                $this->addUsingAlias(SgpiOutViewTableMap::COL_OUTLET_ORG_ID, $outlet_orgId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiOutViewTableMap::COL_OUTLET_ORG_ID, $outlet_orgId, $comparison);

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
                $this->addUsingAlias(SgpiOutViewTableMap::COL_ORG_UNIT_ID, $orgUnitId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($orgUnitId['max'])) {
                $this->addUsingAlias(SgpiOutViewTableMap::COL_ORG_UNIT_ID, $orgUnitId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiOutViewTableMap::COL_ORG_UNIT_ID, $orgUnitId, $comparison);

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
                $this->addUsingAlias(SgpiOutViewTableMap::COL_TERRITORY_ID, $territoryId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($territoryId['max'])) {
                $this->addUsingAlias(SgpiOutViewTableMap::COL_TERRITORY_ID, $territoryId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiOutViewTableMap::COL_TERRITORY_ID, $territoryId, $comparison);

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
                $this->addUsingAlias(SgpiOutViewTableMap::COL_POSITION_ID, $positionId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($positionId['max'])) {
                $this->addUsingAlias(SgpiOutViewTableMap::COL_POSITION_ID, $positionId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiOutViewTableMap::COL_POSITION_ID, $positionId, $comparison);

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

        $this->addUsingAlias(SgpiOutViewTableMap::COL_POSITION_NAME, $positionName, $comparison);

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

        $this->addUsingAlias(SgpiOutViewTableMap::COL_TERRITORY_NAME, $territoryName, $comparison);

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
                $this->addUsingAlias(SgpiOutViewTableMap::COL_BEAT_ID, $beatId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($beatId['max'])) {
                $this->addUsingAlias(SgpiOutViewTableMap::COL_BEAT_ID, $beatId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiOutViewTableMap::COL_BEAT_ID, $beatId, $comparison);

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

        $this->addUsingAlias(SgpiOutViewTableMap::COL_BEAT_NAME, $beatName, $comparison);

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

        $this->addUsingAlias(SgpiOutViewTableMap::COL_TAGS, $tags, $comparison);

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
                $this->addUsingAlias(SgpiOutViewTableMap::COL_VISIT_FQ, $visitFq['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($visitFq['max'])) {
                $this->addUsingAlias(SgpiOutViewTableMap::COL_VISIT_FQ, $visitFq['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiOutViewTableMap::COL_VISIT_FQ, $visitFq, $comparison);

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

        $this->addUsingAlias(SgpiOutViewTableMap::COL_OUTLET_SALUTATION, $outletSalutation, $comparison);

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

        $this->addUsingAlias(SgpiOutViewTableMap::COL_OUTLET_NAME, $outletName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the classification column
     *
     * Example usage:
     * <code>
     * $query->filterByClassification('fooValue');   // WHERE classification = 'fooValue'
     * $query->filterByClassification('%fooValue%', Criteria::LIKE); // WHERE classification LIKE '%fooValue%'
     * $query->filterByClassification(['foo', 'bar']); // WHERE classification IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $classification The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByClassification($classification = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($classification)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiOutViewTableMap::COL_CLASSIFICATION, $classification, $comparison);

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

        $this->addUsingAlias(SgpiOutViewTableMap::COL_OUTLETTYPE_NAME, $outlettypeName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the sgpi_name column
     *
     * Example usage:
     * <code>
     * $query->filterBySgpiName('fooValue');   // WHERE sgpi_name = 'fooValue'
     * $query->filterBySgpiName('%fooValue%', Criteria::LIKE); // WHERE sgpi_name LIKE '%fooValue%'
     * $query->filterBySgpiName(['foo', 'bar']); // WHERE sgpi_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $sgpiName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySgpiName($sgpiName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($sgpiName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiOutViewTableMap::COL_SGPI_NAME, $sgpiName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the sgpi_code column
     *
     * Example usage:
     * <code>
     * $query->filterBySgpiCode('fooValue');   // WHERE sgpi_code = 'fooValue'
     * $query->filterBySgpiCode('%fooValue%', Criteria::LIKE); // WHERE sgpi_code LIKE '%fooValue%'
     * $query->filterBySgpiCode(['foo', 'bar']); // WHERE sgpi_code IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $sgpiCode The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySgpiCode($sgpiCode = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($sgpiCode)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiOutViewTableMap::COL_SGPI_CODE, $sgpiCode, $comparison);

        return $this;
    }

    /**
     * Filter the query on the material_sku column
     *
     * Example usage:
     * <code>
     * $query->filterByMaterialSku('fooValue');   // WHERE material_sku = 'fooValue'
     * $query->filterByMaterialSku('%fooValue%', Criteria::LIKE); // WHERE material_sku LIKE '%fooValue%'
     * $query->filterByMaterialSku(['foo', 'bar']); // WHERE material_sku IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $materialSku The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMaterialSku($materialSku = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($materialSku)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiOutViewTableMap::COL_MATERIAL_SKU, $materialSku, $comparison);

        return $this;
    }

    /**
     * Filter the query on the sgpi_type column
     *
     * Example usage:
     * <code>
     * $query->filterBySgpiType('fooValue');   // WHERE sgpi_type = 'fooValue'
     * $query->filterBySgpiType('%fooValue%', Criteria::LIKE); // WHERE sgpi_type LIKE '%fooValue%'
     * $query->filterBySgpiType(['foo', 'bar']); // WHERE sgpi_type IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $sgpiType The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySgpiType($sgpiType = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($sgpiType)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiOutViewTableMap::COL_SGPI_TYPE, $sgpiType, $comparison);

        return $this;
    }

    /**
     * Filter the query on the sgpi_qty column
     *
     * Example usage:
     * <code>
     * $query->filterBySgpiQty(1234); // WHERE sgpi_qty = 1234
     * $query->filterBySgpiQty(array(12, 34)); // WHERE sgpi_qty IN (12, 34)
     * $query->filterBySgpiQty(array('min' => 12)); // WHERE sgpi_qty > 12
     * </code>
     *
     * @param mixed $sgpiQty The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySgpiQty($sgpiQty = null, ?string $comparison = null)
    {
        if (is_array($sgpiQty)) {
            $useMinMax = false;
            if (isset($sgpiQty['min'])) {
                $this->addUsingAlias(SgpiOutViewTableMap::COL_SGPI_QTY, $sgpiQty['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($sgpiQty['max'])) {
                $this->addUsingAlias(SgpiOutViewTableMap::COL_SGPI_QTY, $sgpiQty['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiOutViewTableMap::COL_SGPI_QTY, $sgpiQty, $comparison);

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
                $this->addUsingAlias(SgpiOutViewTableMap::COL_DCR_ID, $dcrId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dcrId['max'])) {
                $this->addUsingAlias(SgpiOutViewTableMap::COL_DCR_ID, $dcrId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiOutViewTableMap::COL_DCR_ID, $dcrId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the dcr_date column
     *
     * Example usage:
     * <code>
     * $query->filterByDcrDate('2011-03-14'); // WHERE dcr_date = '2011-03-14'
     * $query->filterByDcrDate('now'); // WHERE dcr_date = '2011-03-14'
     * $query->filterByDcrDate(array('max' => 'yesterday')); // WHERE dcr_date > '2011-03-13'
     * </code>
     *
     * @param mixed $dcrDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDcrDate($dcrDate = null, ?string $comparison = null)
    {
        if (is_array($dcrDate)) {
            $useMinMax = false;
            if (isset($dcrDate['min'])) {
                $this->addUsingAlias(SgpiOutViewTableMap::COL_DCR_DATE, $dcrDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dcrDate['max'])) {
                $this->addUsingAlias(SgpiOutViewTableMap::COL_DCR_DATE, $dcrDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiOutViewTableMap::COL_DCR_DATE, $dcrDate, $comparison);

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

        $this->addUsingAlias(SgpiOutViewTableMap::COL_BRANDS_DETAILED, $brandsDetailed, $comparison);

        return $this;
    }

    /**
     * Filter the query on the device_time column
     *
     * Example usage:
     * <code>
     * $query->filterByDeviceTime('fooValue');   // WHERE device_time = 'fooValue'
     * $query->filterByDeviceTime('%fooValue%', Criteria::LIKE); // WHERE device_time LIKE '%fooValue%'
     * $query->filterByDeviceTime(['foo', 'bar']); // WHERE device_time IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $deviceTime The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDeviceTime($deviceTime = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($deviceTime)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiOutViewTableMap::COL_DEVICE_TIME, $deviceTime, $comparison);

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

        $this->addUsingAlias(SgpiOutViewTableMap::COL_MANAGERS, $managers, $comparison);

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
                $this->addUsingAlias(SgpiOutViewTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(SgpiOutViewTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiOutViewTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(SgpiOutViewTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(SgpiOutViewTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiOutViewTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

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
                $this->addUsingAlias(SgpiOutViewTableMap::COL_BRAND_ID, $brandId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($brandId['max'])) {
                $this->addUsingAlias(SgpiOutViewTableMap::COL_BRAND_ID, $brandId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiOutViewTableMap::COL_BRAND_ID, $brandId, $comparison);

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSgpiOutView $sgpiOutView Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($sgpiOutView = null)
    {
        if ($sgpiOutView) {
            $this->addUsingAlias(SgpiOutViewTableMap::COL_SGPI_VOUCHER_ID, $sgpiOutView->getSgpiVoucherId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
