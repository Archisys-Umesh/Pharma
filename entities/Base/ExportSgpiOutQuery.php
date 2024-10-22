<?php

namespace entities\Base;

use \Exception;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\LogicException;
use entities\ExportSgpiOut as ChildExportSgpiOut;
use entities\ExportSgpiOutQuery as ChildExportSgpiOutQuery;
use entities\Map\ExportSgpiOutTableMap;

/**
 * Base class that represents a query for the `export_sgpi_out` table.
 *
 * @method     ChildExportSgpiOutQuery orderBySgpiVoucherId($order = Criteria::ASC) Order by the sgpi_voucher_id column
 * @method     ChildExportSgpiOutQuery orderByBuName($order = Criteria::ASC) Order by the bu_name column
 * @method     ChildExportSgpiOutQuery orderByZmManagerBranch($order = Criteria::ASC) Order by the zm_manager_branch column
 * @method     ChildExportSgpiOutQuery orderByZmManagerTown($order = Criteria::ASC) Order by the zm_manager_town column
 * @method     ChildExportSgpiOutQuery orderByRmManagerBranch($order = Criteria::ASC) Order by the rm_manager_branch column
 * @method     ChildExportSgpiOutQuery orderByRmManagerTown($order = Criteria::ASC) Order by the rm_manager_town column
 * @method     ChildExportSgpiOutQuery orderByAmManagerBranch($order = Criteria::ASC) Order by the am_manager_branch column
 * @method     ChildExportSgpiOutQuery orderByAmManagerTown($order = Criteria::ASC) Order by the am_manager_town column
 * @method     ChildExportSgpiOutQuery orderByZmPositionCode($order = Criteria::ASC) Order by the zm_position_code column
 * @method     ChildExportSgpiOutQuery orderByRmPositionCode($order = Criteria::ASC) Order by the rm_position_code column
 * @method     ChildExportSgpiOutQuery orderByAmPositionCode($order = Criteria::ASC) Order by the am_position_code column
 * @method     ChildExportSgpiOutQuery orderByEmpPositionCode($order = Criteria::ASC) Order by the emp_position_code column
 * @method     ChildExportSgpiOutQuery orderByEmpPositionName($order = Criteria::ASC) Order by the emp_position_name column
 * @method     ChildExportSgpiOutQuery orderByEmpLevel($order = Criteria::ASC) Order by the emp_level column
 * @method     ChildExportSgpiOutQuery orderByEmployeeCode($order = Criteria::ASC) Order by the employee_code column
 * @method     ChildExportSgpiOutQuery orderByEmployeeName($order = Criteria::ASC) Order by the employee_name column
 * @method     ChildExportSgpiOutQuery orderByOutletCode($order = Criteria::ASC) Order by the outlet_code column
 * @method     ChildExportSgpiOutQuery orderByBrandFocus($order = Criteria::ASC) Order by the brand_focus column
 * @method     ChildExportSgpiOutQuery orderByOutletOrgId($order = Criteria::ASC) Order by the outlet_org_id column
 * @method     ChildExportSgpiOutQuery orderByOrgUnitId($order = Criteria::ASC) Order by the org_unit_id column
 * @method     ChildExportSgpiOutQuery orderByTerritoryId($order = Criteria::ASC) Order by the territory_id column
 * @method     ChildExportSgpiOutQuery orderByTerritoryName($order = Criteria::ASC) Order by the territory_name column
 * @method     ChildExportSgpiOutQuery orderByBeatId($order = Criteria::ASC) Order by the beat_id column
 * @method     ChildExportSgpiOutQuery orderByBeatName($order = Criteria::ASC) Order by the beat_name column
 * @method     ChildExportSgpiOutQuery orderByTags($order = Criteria::ASC) Order by the tags column
 * @method     ChildExportSgpiOutQuery orderByVisitFq($order = Criteria::ASC) Order by the visit_fq column
 * @method     ChildExportSgpiOutQuery orderByOutletSalutation($order = Criteria::ASC) Order by the outlet_salutation column
 * @method     ChildExportSgpiOutQuery orderByOutletName($order = Criteria::ASC) Order by the outlet_name column
 * @method     ChildExportSgpiOutQuery orderByClassification($order = Criteria::ASC) Order by the classification column
 * @method     ChildExportSgpiOutQuery orderByOutlettypeName($order = Criteria::ASC) Order by the outlettype_name column
 * @method     ChildExportSgpiOutQuery orderBySgpiName($order = Criteria::ASC) Order by the sgpi_name column
 * @method     ChildExportSgpiOutQuery orderBySgpiCode($order = Criteria::ASC) Order by the sgpi_code column
 * @method     ChildExportSgpiOutQuery orderByMaterialSku($order = Criteria::ASC) Order by the material_sku column
 * @method     ChildExportSgpiOutQuery orderBySgpiType($order = Criteria::ASC) Order by the sgpi_type column
 * @method     ChildExportSgpiOutQuery orderBySgpiQty($order = Criteria::ASC) Order by the sgpi_qty column
 * @method     ChildExportSgpiOutQuery orderByDcrId($order = Criteria::ASC) Order by the dcr_id column
 * @method     ChildExportSgpiOutQuery orderByDcrDate($order = Criteria::ASC) Order by the dcr_date column
 * @method     ChildExportSgpiOutQuery orderByBrandName($order = Criteria::ASC) Order by the brand_name column
 * @method     ChildExportSgpiOutQuery orderByDeviceTime($order = Criteria::ASC) Order by the device_time column
 * @method     ChildExportSgpiOutQuery orderByManagers($order = Criteria::ASC) Order by the managers column
 * @method     ChildExportSgpiOutQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildExportSgpiOutQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildExportSgpiOutQuery orderByEmpTerritory($order = Criteria::ASC) Order by the emp_territory column
 * @method     ChildExportSgpiOutQuery orderByEmpBranch($order = Criteria::ASC) Order by the emp_branch column
 * @method     ChildExportSgpiOutQuery orderByEmpTown($order = Criteria::ASC) Order by the emp_town column
 *
 * @method     ChildExportSgpiOutQuery groupBySgpiVoucherId() Group by the sgpi_voucher_id column
 * @method     ChildExportSgpiOutQuery groupByBuName() Group by the bu_name column
 * @method     ChildExportSgpiOutQuery groupByZmManagerBranch() Group by the zm_manager_branch column
 * @method     ChildExportSgpiOutQuery groupByZmManagerTown() Group by the zm_manager_town column
 * @method     ChildExportSgpiOutQuery groupByRmManagerBranch() Group by the rm_manager_branch column
 * @method     ChildExportSgpiOutQuery groupByRmManagerTown() Group by the rm_manager_town column
 * @method     ChildExportSgpiOutQuery groupByAmManagerBranch() Group by the am_manager_branch column
 * @method     ChildExportSgpiOutQuery groupByAmManagerTown() Group by the am_manager_town column
 * @method     ChildExportSgpiOutQuery groupByZmPositionCode() Group by the zm_position_code column
 * @method     ChildExportSgpiOutQuery groupByRmPositionCode() Group by the rm_position_code column
 * @method     ChildExportSgpiOutQuery groupByAmPositionCode() Group by the am_position_code column
 * @method     ChildExportSgpiOutQuery groupByEmpPositionCode() Group by the emp_position_code column
 * @method     ChildExportSgpiOutQuery groupByEmpPositionName() Group by the emp_position_name column
 * @method     ChildExportSgpiOutQuery groupByEmpLevel() Group by the emp_level column
 * @method     ChildExportSgpiOutQuery groupByEmployeeCode() Group by the employee_code column
 * @method     ChildExportSgpiOutQuery groupByEmployeeName() Group by the employee_name column
 * @method     ChildExportSgpiOutQuery groupByOutletCode() Group by the outlet_code column
 * @method     ChildExportSgpiOutQuery groupByBrandFocus() Group by the brand_focus column
 * @method     ChildExportSgpiOutQuery groupByOutletOrgId() Group by the outlet_org_id column
 * @method     ChildExportSgpiOutQuery groupByOrgUnitId() Group by the org_unit_id column
 * @method     ChildExportSgpiOutQuery groupByTerritoryId() Group by the territory_id column
 * @method     ChildExportSgpiOutQuery groupByTerritoryName() Group by the territory_name column
 * @method     ChildExportSgpiOutQuery groupByBeatId() Group by the beat_id column
 * @method     ChildExportSgpiOutQuery groupByBeatName() Group by the beat_name column
 * @method     ChildExportSgpiOutQuery groupByTags() Group by the tags column
 * @method     ChildExportSgpiOutQuery groupByVisitFq() Group by the visit_fq column
 * @method     ChildExportSgpiOutQuery groupByOutletSalutation() Group by the outlet_salutation column
 * @method     ChildExportSgpiOutQuery groupByOutletName() Group by the outlet_name column
 * @method     ChildExportSgpiOutQuery groupByClassification() Group by the classification column
 * @method     ChildExportSgpiOutQuery groupByOutlettypeName() Group by the outlettype_name column
 * @method     ChildExportSgpiOutQuery groupBySgpiName() Group by the sgpi_name column
 * @method     ChildExportSgpiOutQuery groupBySgpiCode() Group by the sgpi_code column
 * @method     ChildExportSgpiOutQuery groupByMaterialSku() Group by the material_sku column
 * @method     ChildExportSgpiOutQuery groupBySgpiType() Group by the sgpi_type column
 * @method     ChildExportSgpiOutQuery groupBySgpiQty() Group by the sgpi_qty column
 * @method     ChildExportSgpiOutQuery groupByDcrId() Group by the dcr_id column
 * @method     ChildExportSgpiOutQuery groupByDcrDate() Group by the dcr_date column
 * @method     ChildExportSgpiOutQuery groupByBrandName() Group by the brand_name column
 * @method     ChildExportSgpiOutQuery groupByDeviceTime() Group by the device_time column
 * @method     ChildExportSgpiOutQuery groupByManagers() Group by the managers column
 * @method     ChildExportSgpiOutQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildExportSgpiOutQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildExportSgpiOutQuery groupByEmpTerritory() Group by the emp_territory column
 * @method     ChildExportSgpiOutQuery groupByEmpBranch() Group by the emp_branch column
 * @method     ChildExportSgpiOutQuery groupByEmpTown() Group by the emp_town column
 *
 * @method     ChildExportSgpiOutQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildExportSgpiOutQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildExportSgpiOutQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildExportSgpiOutQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildExportSgpiOutQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildExportSgpiOutQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildExportSgpiOut|null findOne(?ConnectionInterface $con = null) Return the first ChildExportSgpiOut matching the query
 * @method     ChildExportSgpiOut findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildExportSgpiOut matching the query, or a new ChildExportSgpiOut object populated from the query conditions when no match is found
 *
 * @method     ChildExportSgpiOut|null findOneBySgpiVoucherId(int $sgpi_voucher_id) Return the first ChildExportSgpiOut filtered by the sgpi_voucher_id column
 * @method     ChildExportSgpiOut|null findOneByBuName(string $bu_name) Return the first ChildExportSgpiOut filtered by the bu_name column
 * @method     ChildExportSgpiOut|null findOneByZmManagerBranch(string $zm_manager_branch) Return the first ChildExportSgpiOut filtered by the zm_manager_branch column
 * @method     ChildExportSgpiOut|null findOneByZmManagerTown(string $zm_manager_town) Return the first ChildExportSgpiOut filtered by the zm_manager_town column
 * @method     ChildExportSgpiOut|null findOneByRmManagerBranch(string $rm_manager_branch) Return the first ChildExportSgpiOut filtered by the rm_manager_branch column
 * @method     ChildExportSgpiOut|null findOneByRmManagerTown(string $rm_manager_town) Return the first ChildExportSgpiOut filtered by the rm_manager_town column
 * @method     ChildExportSgpiOut|null findOneByAmManagerBranch(string $am_manager_branch) Return the first ChildExportSgpiOut filtered by the am_manager_branch column
 * @method     ChildExportSgpiOut|null findOneByAmManagerTown(string $am_manager_town) Return the first ChildExportSgpiOut filtered by the am_manager_town column
 * @method     ChildExportSgpiOut|null findOneByZmPositionCode(string $zm_position_code) Return the first ChildExportSgpiOut filtered by the zm_position_code column
 * @method     ChildExportSgpiOut|null findOneByRmPositionCode(string $rm_position_code) Return the first ChildExportSgpiOut filtered by the rm_position_code column
 * @method     ChildExportSgpiOut|null findOneByAmPositionCode(string $am_position_code) Return the first ChildExportSgpiOut filtered by the am_position_code column
 * @method     ChildExportSgpiOut|null findOneByEmpPositionCode(string $emp_position_code) Return the first ChildExportSgpiOut filtered by the emp_position_code column
 * @method     ChildExportSgpiOut|null findOneByEmpPositionName(string $emp_position_name) Return the first ChildExportSgpiOut filtered by the emp_position_name column
 * @method     ChildExportSgpiOut|null findOneByEmpLevel(string $emp_level) Return the first ChildExportSgpiOut filtered by the emp_level column
 * @method     ChildExportSgpiOut|null findOneByEmployeeCode(string $employee_code) Return the first ChildExportSgpiOut filtered by the employee_code column
 * @method     ChildExportSgpiOut|null findOneByEmployeeName(string $employee_name) Return the first ChildExportSgpiOut filtered by the employee_name column
 * @method     ChildExportSgpiOut|null findOneByOutletCode(string $outlet_code) Return the first ChildExportSgpiOut filtered by the outlet_code column
 * @method     ChildExportSgpiOut|null findOneByBrandFocus(string $brand_focus) Return the first ChildExportSgpiOut filtered by the brand_focus column
 * @method     ChildExportSgpiOut|null findOneByOutletOrgId(int $outlet_org_id) Return the first ChildExportSgpiOut filtered by the outlet_org_id column
 * @method     ChildExportSgpiOut|null findOneByOrgUnitId(int $org_unit_id) Return the first ChildExportSgpiOut filtered by the org_unit_id column
 * @method     ChildExportSgpiOut|null findOneByTerritoryId(int $territory_id) Return the first ChildExportSgpiOut filtered by the territory_id column
 * @method     ChildExportSgpiOut|null findOneByTerritoryName(string $territory_name) Return the first ChildExportSgpiOut filtered by the territory_name column
 * @method     ChildExportSgpiOut|null findOneByBeatId(int $beat_id) Return the first ChildExportSgpiOut filtered by the beat_id column
 * @method     ChildExportSgpiOut|null findOneByBeatName(string $beat_name) Return the first ChildExportSgpiOut filtered by the beat_name column
 * @method     ChildExportSgpiOut|null findOneByTags(string $tags) Return the first ChildExportSgpiOut filtered by the tags column
 * @method     ChildExportSgpiOut|null findOneByVisitFq(int $visit_fq) Return the first ChildExportSgpiOut filtered by the visit_fq column
 * @method     ChildExportSgpiOut|null findOneByOutletSalutation(string $outlet_salutation) Return the first ChildExportSgpiOut filtered by the outlet_salutation column
 * @method     ChildExportSgpiOut|null findOneByOutletName(string $outlet_name) Return the first ChildExportSgpiOut filtered by the outlet_name column
 * @method     ChildExportSgpiOut|null findOneByClassification(string $classification) Return the first ChildExportSgpiOut filtered by the classification column
 * @method     ChildExportSgpiOut|null findOneByOutlettypeName(string $outlettype_name) Return the first ChildExportSgpiOut filtered by the outlettype_name column
 * @method     ChildExportSgpiOut|null findOneBySgpiName(string $sgpi_name) Return the first ChildExportSgpiOut filtered by the sgpi_name column
 * @method     ChildExportSgpiOut|null findOneBySgpiCode(string $sgpi_code) Return the first ChildExportSgpiOut filtered by the sgpi_code column
 * @method     ChildExportSgpiOut|null findOneByMaterialSku(string $material_sku) Return the first ChildExportSgpiOut filtered by the material_sku column
 * @method     ChildExportSgpiOut|null findOneBySgpiType(string $sgpi_type) Return the first ChildExportSgpiOut filtered by the sgpi_type column
 * @method     ChildExportSgpiOut|null findOneBySgpiQty(int $sgpi_qty) Return the first ChildExportSgpiOut filtered by the sgpi_qty column
 * @method     ChildExportSgpiOut|null findOneByDcrId(int $dcr_id) Return the first ChildExportSgpiOut filtered by the dcr_id column
 * @method     ChildExportSgpiOut|null findOneByDcrDate(string $dcr_date) Return the first ChildExportSgpiOut filtered by the dcr_date column
 * @method     ChildExportSgpiOut|null findOneByBrandName(string $brand_name) Return the first ChildExportSgpiOut filtered by the brand_name column
 * @method     ChildExportSgpiOut|null findOneByDeviceTime(string $device_time) Return the first ChildExportSgpiOut filtered by the device_time column
 * @method     ChildExportSgpiOut|null findOneByManagers(string $managers) Return the first ChildExportSgpiOut filtered by the managers column
 * @method     ChildExportSgpiOut|null findOneByCreatedAt(string $created_at) Return the first ChildExportSgpiOut filtered by the created_at column
 * @method     ChildExportSgpiOut|null findOneByUpdatedAt(string $updated_at) Return the first ChildExportSgpiOut filtered by the updated_at column
 * @method     ChildExportSgpiOut|null findOneByEmpTerritory(string $emp_territory) Return the first ChildExportSgpiOut filtered by the emp_territory column
 * @method     ChildExportSgpiOut|null findOneByEmpBranch(string $emp_branch) Return the first ChildExportSgpiOut filtered by the emp_branch column
 * @method     ChildExportSgpiOut|null findOneByEmpTown(string $emp_town) Return the first ChildExportSgpiOut filtered by the emp_town column
 *
 * @method     ChildExportSgpiOut requirePk($key, ?ConnectionInterface $con = null) Return the ChildExportSgpiOut by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportSgpiOut requireOne(?ConnectionInterface $con = null) Return the first ChildExportSgpiOut matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildExportSgpiOut requireOneBySgpiVoucherId(int $sgpi_voucher_id) Return the first ChildExportSgpiOut filtered by the sgpi_voucher_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportSgpiOut requireOneByBuName(string $bu_name) Return the first ChildExportSgpiOut filtered by the bu_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportSgpiOut requireOneByZmManagerBranch(string $zm_manager_branch) Return the first ChildExportSgpiOut filtered by the zm_manager_branch column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportSgpiOut requireOneByZmManagerTown(string $zm_manager_town) Return the first ChildExportSgpiOut filtered by the zm_manager_town column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportSgpiOut requireOneByRmManagerBranch(string $rm_manager_branch) Return the first ChildExportSgpiOut filtered by the rm_manager_branch column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportSgpiOut requireOneByRmManagerTown(string $rm_manager_town) Return the first ChildExportSgpiOut filtered by the rm_manager_town column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportSgpiOut requireOneByAmManagerBranch(string $am_manager_branch) Return the first ChildExportSgpiOut filtered by the am_manager_branch column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportSgpiOut requireOneByAmManagerTown(string $am_manager_town) Return the first ChildExportSgpiOut filtered by the am_manager_town column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportSgpiOut requireOneByZmPositionCode(string $zm_position_code) Return the first ChildExportSgpiOut filtered by the zm_position_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportSgpiOut requireOneByRmPositionCode(string $rm_position_code) Return the first ChildExportSgpiOut filtered by the rm_position_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportSgpiOut requireOneByAmPositionCode(string $am_position_code) Return the first ChildExportSgpiOut filtered by the am_position_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportSgpiOut requireOneByEmpPositionCode(string $emp_position_code) Return the first ChildExportSgpiOut filtered by the emp_position_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportSgpiOut requireOneByEmpPositionName(string $emp_position_name) Return the first ChildExportSgpiOut filtered by the emp_position_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportSgpiOut requireOneByEmpLevel(string $emp_level) Return the first ChildExportSgpiOut filtered by the emp_level column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportSgpiOut requireOneByEmployeeCode(string $employee_code) Return the first ChildExportSgpiOut filtered by the employee_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportSgpiOut requireOneByEmployeeName(string $employee_name) Return the first ChildExportSgpiOut filtered by the employee_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportSgpiOut requireOneByOutletCode(string $outlet_code) Return the first ChildExportSgpiOut filtered by the outlet_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportSgpiOut requireOneByBrandFocus(string $brand_focus) Return the first ChildExportSgpiOut filtered by the brand_focus column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportSgpiOut requireOneByOutletOrgId(int $outlet_org_id) Return the first ChildExportSgpiOut filtered by the outlet_org_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportSgpiOut requireOneByOrgUnitId(int $org_unit_id) Return the first ChildExportSgpiOut filtered by the org_unit_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportSgpiOut requireOneByTerritoryId(int $territory_id) Return the first ChildExportSgpiOut filtered by the territory_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportSgpiOut requireOneByTerritoryName(string $territory_name) Return the first ChildExportSgpiOut filtered by the territory_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportSgpiOut requireOneByBeatId(int $beat_id) Return the first ChildExportSgpiOut filtered by the beat_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportSgpiOut requireOneByBeatName(string $beat_name) Return the first ChildExportSgpiOut filtered by the beat_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportSgpiOut requireOneByTags(string $tags) Return the first ChildExportSgpiOut filtered by the tags column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportSgpiOut requireOneByVisitFq(int $visit_fq) Return the first ChildExportSgpiOut filtered by the visit_fq column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportSgpiOut requireOneByOutletSalutation(string $outlet_salutation) Return the first ChildExportSgpiOut filtered by the outlet_salutation column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportSgpiOut requireOneByOutletName(string $outlet_name) Return the first ChildExportSgpiOut filtered by the outlet_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportSgpiOut requireOneByClassification(string $classification) Return the first ChildExportSgpiOut filtered by the classification column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportSgpiOut requireOneByOutlettypeName(string $outlettype_name) Return the first ChildExportSgpiOut filtered by the outlettype_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportSgpiOut requireOneBySgpiName(string $sgpi_name) Return the first ChildExportSgpiOut filtered by the sgpi_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportSgpiOut requireOneBySgpiCode(string $sgpi_code) Return the first ChildExportSgpiOut filtered by the sgpi_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportSgpiOut requireOneByMaterialSku(string $material_sku) Return the first ChildExportSgpiOut filtered by the material_sku column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportSgpiOut requireOneBySgpiType(string $sgpi_type) Return the first ChildExportSgpiOut filtered by the sgpi_type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportSgpiOut requireOneBySgpiQty(int $sgpi_qty) Return the first ChildExportSgpiOut filtered by the sgpi_qty column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportSgpiOut requireOneByDcrId(int $dcr_id) Return the first ChildExportSgpiOut filtered by the dcr_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportSgpiOut requireOneByDcrDate(string $dcr_date) Return the first ChildExportSgpiOut filtered by the dcr_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportSgpiOut requireOneByBrandName(string $brand_name) Return the first ChildExportSgpiOut filtered by the brand_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportSgpiOut requireOneByDeviceTime(string $device_time) Return the first ChildExportSgpiOut filtered by the device_time column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportSgpiOut requireOneByManagers(string $managers) Return the first ChildExportSgpiOut filtered by the managers column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportSgpiOut requireOneByCreatedAt(string $created_at) Return the first ChildExportSgpiOut filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportSgpiOut requireOneByUpdatedAt(string $updated_at) Return the first ChildExportSgpiOut filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportSgpiOut requireOneByEmpTerritory(string $emp_territory) Return the first ChildExportSgpiOut filtered by the emp_territory column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportSgpiOut requireOneByEmpBranch(string $emp_branch) Return the first ChildExportSgpiOut filtered by the emp_branch column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportSgpiOut requireOneByEmpTown(string $emp_town) Return the first ChildExportSgpiOut filtered by the emp_town column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildExportSgpiOut[]|Collection find(?ConnectionInterface $con = null) Return ChildExportSgpiOut objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildExportSgpiOut> find(?ConnectionInterface $con = null) Return ChildExportSgpiOut objects based on current ModelCriteria
 *
 * @method     ChildExportSgpiOut[]|Collection findBySgpiVoucherId(int|array<int> $sgpi_voucher_id) Return ChildExportSgpiOut objects filtered by the sgpi_voucher_id column
 * @psalm-method Collection&\Traversable<ChildExportSgpiOut> findBySgpiVoucherId(int|array<int> $sgpi_voucher_id) Return ChildExportSgpiOut objects filtered by the sgpi_voucher_id column
 * @method     ChildExportSgpiOut[]|Collection findByBuName(string|array<string> $bu_name) Return ChildExportSgpiOut objects filtered by the bu_name column
 * @psalm-method Collection&\Traversable<ChildExportSgpiOut> findByBuName(string|array<string> $bu_name) Return ChildExportSgpiOut objects filtered by the bu_name column
 * @method     ChildExportSgpiOut[]|Collection findByZmManagerBranch(string|array<string> $zm_manager_branch) Return ChildExportSgpiOut objects filtered by the zm_manager_branch column
 * @psalm-method Collection&\Traversable<ChildExportSgpiOut> findByZmManagerBranch(string|array<string> $zm_manager_branch) Return ChildExportSgpiOut objects filtered by the zm_manager_branch column
 * @method     ChildExportSgpiOut[]|Collection findByZmManagerTown(string|array<string> $zm_manager_town) Return ChildExportSgpiOut objects filtered by the zm_manager_town column
 * @psalm-method Collection&\Traversable<ChildExportSgpiOut> findByZmManagerTown(string|array<string> $zm_manager_town) Return ChildExportSgpiOut objects filtered by the zm_manager_town column
 * @method     ChildExportSgpiOut[]|Collection findByRmManagerBranch(string|array<string> $rm_manager_branch) Return ChildExportSgpiOut objects filtered by the rm_manager_branch column
 * @psalm-method Collection&\Traversable<ChildExportSgpiOut> findByRmManagerBranch(string|array<string> $rm_manager_branch) Return ChildExportSgpiOut objects filtered by the rm_manager_branch column
 * @method     ChildExportSgpiOut[]|Collection findByRmManagerTown(string|array<string> $rm_manager_town) Return ChildExportSgpiOut objects filtered by the rm_manager_town column
 * @psalm-method Collection&\Traversable<ChildExportSgpiOut> findByRmManagerTown(string|array<string> $rm_manager_town) Return ChildExportSgpiOut objects filtered by the rm_manager_town column
 * @method     ChildExportSgpiOut[]|Collection findByAmManagerBranch(string|array<string> $am_manager_branch) Return ChildExportSgpiOut objects filtered by the am_manager_branch column
 * @psalm-method Collection&\Traversable<ChildExportSgpiOut> findByAmManagerBranch(string|array<string> $am_manager_branch) Return ChildExportSgpiOut objects filtered by the am_manager_branch column
 * @method     ChildExportSgpiOut[]|Collection findByAmManagerTown(string|array<string> $am_manager_town) Return ChildExportSgpiOut objects filtered by the am_manager_town column
 * @psalm-method Collection&\Traversable<ChildExportSgpiOut> findByAmManagerTown(string|array<string> $am_manager_town) Return ChildExportSgpiOut objects filtered by the am_manager_town column
 * @method     ChildExportSgpiOut[]|Collection findByZmPositionCode(string|array<string> $zm_position_code) Return ChildExportSgpiOut objects filtered by the zm_position_code column
 * @psalm-method Collection&\Traversable<ChildExportSgpiOut> findByZmPositionCode(string|array<string> $zm_position_code) Return ChildExportSgpiOut objects filtered by the zm_position_code column
 * @method     ChildExportSgpiOut[]|Collection findByRmPositionCode(string|array<string> $rm_position_code) Return ChildExportSgpiOut objects filtered by the rm_position_code column
 * @psalm-method Collection&\Traversable<ChildExportSgpiOut> findByRmPositionCode(string|array<string> $rm_position_code) Return ChildExportSgpiOut objects filtered by the rm_position_code column
 * @method     ChildExportSgpiOut[]|Collection findByAmPositionCode(string|array<string> $am_position_code) Return ChildExportSgpiOut objects filtered by the am_position_code column
 * @psalm-method Collection&\Traversable<ChildExportSgpiOut> findByAmPositionCode(string|array<string> $am_position_code) Return ChildExportSgpiOut objects filtered by the am_position_code column
 * @method     ChildExportSgpiOut[]|Collection findByEmpPositionCode(string|array<string> $emp_position_code) Return ChildExportSgpiOut objects filtered by the emp_position_code column
 * @psalm-method Collection&\Traversable<ChildExportSgpiOut> findByEmpPositionCode(string|array<string> $emp_position_code) Return ChildExportSgpiOut objects filtered by the emp_position_code column
 * @method     ChildExportSgpiOut[]|Collection findByEmpPositionName(string|array<string> $emp_position_name) Return ChildExportSgpiOut objects filtered by the emp_position_name column
 * @psalm-method Collection&\Traversable<ChildExportSgpiOut> findByEmpPositionName(string|array<string> $emp_position_name) Return ChildExportSgpiOut objects filtered by the emp_position_name column
 * @method     ChildExportSgpiOut[]|Collection findByEmpLevel(string|array<string> $emp_level) Return ChildExportSgpiOut objects filtered by the emp_level column
 * @psalm-method Collection&\Traversable<ChildExportSgpiOut> findByEmpLevel(string|array<string> $emp_level) Return ChildExportSgpiOut objects filtered by the emp_level column
 * @method     ChildExportSgpiOut[]|Collection findByEmployeeCode(string|array<string> $employee_code) Return ChildExportSgpiOut objects filtered by the employee_code column
 * @psalm-method Collection&\Traversable<ChildExportSgpiOut> findByEmployeeCode(string|array<string> $employee_code) Return ChildExportSgpiOut objects filtered by the employee_code column
 * @method     ChildExportSgpiOut[]|Collection findByEmployeeName(string|array<string> $employee_name) Return ChildExportSgpiOut objects filtered by the employee_name column
 * @psalm-method Collection&\Traversable<ChildExportSgpiOut> findByEmployeeName(string|array<string> $employee_name) Return ChildExportSgpiOut objects filtered by the employee_name column
 * @method     ChildExportSgpiOut[]|Collection findByOutletCode(string|array<string> $outlet_code) Return ChildExportSgpiOut objects filtered by the outlet_code column
 * @psalm-method Collection&\Traversable<ChildExportSgpiOut> findByOutletCode(string|array<string> $outlet_code) Return ChildExportSgpiOut objects filtered by the outlet_code column
 * @method     ChildExportSgpiOut[]|Collection findByBrandFocus(string|array<string> $brand_focus) Return ChildExportSgpiOut objects filtered by the brand_focus column
 * @psalm-method Collection&\Traversable<ChildExportSgpiOut> findByBrandFocus(string|array<string> $brand_focus) Return ChildExportSgpiOut objects filtered by the brand_focus column
 * @method     ChildExportSgpiOut[]|Collection findByOutletOrgId(int|array<int> $outlet_org_id) Return ChildExportSgpiOut objects filtered by the outlet_org_id column
 * @psalm-method Collection&\Traversable<ChildExportSgpiOut> findByOutletOrgId(int|array<int> $outlet_org_id) Return ChildExportSgpiOut objects filtered by the outlet_org_id column
 * @method     ChildExportSgpiOut[]|Collection findByOrgUnitId(int|array<int> $org_unit_id) Return ChildExportSgpiOut objects filtered by the org_unit_id column
 * @psalm-method Collection&\Traversable<ChildExportSgpiOut> findByOrgUnitId(int|array<int> $org_unit_id) Return ChildExportSgpiOut objects filtered by the org_unit_id column
 * @method     ChildExportSgpiOut[]|Collection findByTerritoryId(int|array<int> $territory_id) Return ChildExportSgpiOut objects filtered by the territory_id column
 * @psalm-method Collection&\Traversable<ChildExportSgpiOut> findByTerritoryId(int|array<int> $territory_id) Return ChildExportSgpiOut objects filtered by the territory_id column
 * @method     ChildExportSgpiOut[]|Collection findByTerritoryName(string|array<string> $territory_name) Return ChildExportSgpiOut objects filtered by the territory_name column
 * @psalm-method Collection&\Traversable<ChildExportSgpiOut> findByTerritoryName(string|array<string> $territory_name) Return ChildExportSgpiOut objects filtered by the territory_name column
 * @method     ChildExportSgpiOut[]|Collection findByBeatId(int|array<int> $beat_id) Return ChildExportSgpiOut objects filtered by the beat_id column
 * @psalm-method Collection&\Traversable<ChildExportSgpiOut> findByBeatId(int|array<int> $beat_id) Return ChildExportSgpiOut objects filtered by the beat_id column
 * @method     ChildExportSgpiOut[]|Collection findByBeatName(string|array<string> $beat_name) Return ChildExportSgpiOut objects filtered by the beat_name column
 * @psalm-method Collection&\Traversable<ChildExportSgpiOut> findByBeatName(string|array<string> $beat_name) Return ChildExportSgpiOut objects filtered by the beat_name column
 * @method     ChildExportSgpiOut[]|Collection findByTags(string|array<string> $tags) Return ChildExportSgpiOut objects filtered by the tags column
 * @psalm-method Collection&\Traversable<ChildExportSgpiOut> findByTags(string|array<string> $tags) Return ChildExportSgpiOut objects filtered by the tags column
 * @method     ChildExportSgpiOut[]|Collection findByVisitFq(int|array<int> $visit_fq) Return ChildExportSgpiOut objects filtered by the visit_fq column
 * @psalm-method Collection&\Traversable<ChildExportSgpiOut> findByVisitFq(int|array<int> $visit_fq) Return ChildExportSgpiOut objects filtered by the visit_fq column
 * @method     ChildExportSgpiOut[]|Collection findByOutletSalutation(string|array<string> $outlet_salutation) Return ChildExportSgpiOut objects filtered by the outlet_salutation column
 * @psalm-method Collection&\Traversable<ChildExportSgpiOut> findByOutletSalutation(string|array<string> $outlet_salutation) Return ChildExportSgpiOut objects filtered by the outlet_salutation column
 * @method     ChildExportSgpiOut[]|Collection findByOutletName(string|array<string> $outlet_name) Return ChildExportSgpiOut objects filtered by the outlet_name column
 * @psalm-method Collection&\Traversable<ChildExportSgpiOut> findByOutletName(string|array<string> $outlet_name) Return ChildExportSgpiOut objects filtered by the outlet_name column
 * @method     ChildExportSgpiOut[]|Collection findByClassification(string|array<string> $classification) Return ChildExportSgpiOut objects filtered by the classification column
 * @psalm-method Collection&\Traversable<ChildExportSgpiOut> findByClassification(string|array<string> $classification) Return ChildExportSgpiOut objects filtered by the classification column
 * @method     ChildExportSgpiOut[]|Collection findByOutlettypeName(string|array<string> $outlettype_name) Return ChildExportSgpiOut objects filtered by the outlettype_name column
 * @psalm-method Collection&\Traversable<ChildExportSgpiOut> findByOutlettypeName(string|array<string> $outlettype_name) Return ChildExportSgpiOut objects filtered by the outlettype_name column
 * @method     ChildExportSgpiOut[]|Collection findBySgpiName(string|array<string> $sgpi_name) Return ChildExportSgpiOut objects filtered by the sgpi_name column
 * @psalm-method Collection&\Traversable<ChildExportSgpiOut> findBySgpiName(string|array<string> $sgpi_name) Return ChildExportSgpiOut objects filtered by the sgpi_name column
 * @method     ChildExportSgpiOut[]|Collection findBySgpiCode(string|array<string> $sgpi_code) Return ChildExportSgpiOut objects filtered by the sgpi_code column
 * @psalm-method Collection&\Traversable<ChildExportSgpiOut> findBySgpiCode(string|array<string> $sgpi_code) Return ChildExportSgpiOut objects filtered by the sgpi_code column
 * @method     ChildExportSgpiOut[]|Collection findByMaterialSku(string|array<string> $material_sku) Return ChildExportSgpiOut objects filtered by the material_sku column
 * @psalm-method Collection&\Traversable<ChildExportSgpiOut> findByMaterialSku(string|array<string> $material_sku) Return ChildExportSgpiOut objects filtered by the material_sku column
 * @method     ChildExportSgpiOut[]|Collection findBySgpiType(string|array<string> $sgpi_type) Return ChildExportSgpiOut objects filtered by the sgpi_type column
 * @psalm-method Collection&\Traversable<ChildExportSgpiOut> findBySgpiType(string|array<string> $sgpi_type) Return ChildExportSgpiOut objects filtered by the sgpi_type column
 * @method     ChildExportSgpiOut[]|Collection findBySgpiQty(int|array<int> $sgpi_qty) Return ChildExportSgpiOut objects filtered by the sgpi_qty column
 * @psalm-method Collection&\Traversable<ChildExportSgpiOut> findBySgpiQty(int|array<int> $sgpi_qty) Return ChildExportSgpiOut objects filtered by the sgpi_qty column
 * @method     ChildExportSgpiOut[]|Collection findByDcrId(int|array<int> $dcr_id) Return ChildExportSgpiOut objects filtered by the dcr_id column
 * @psalm-method Collection&\Traversable<ChildExportSgpiOut> findByDcrId(int|array<int> $dcr_id) Return ChildExportSgpiOut objects filtered by the dcr_id column
 * @method     ChildExportSgpiOut[]|Collection findByDcrDate(string|array<string> $dcr_date) Return ChildExportSgpiOut objects filtered by the dcr_date column
 * @psalm-method Collection&\Traversable<ChildExportSgpiOut> findByDcrDate(string|array<string> $dcr_date) Return ChildExportSgpiOut objects filtered by the dcr_date column
 * @method     ChildExportSgpiOut[]|Collection findByBrandName(string|array<string> $brand_name) Return ChildExportSgpiOut objects filtered by the brand_name column
 * @psalm-method Collection&\Traversable<ChildExportSgpiOut> findByBrandName(string|array<string> $brand_name) Return ChildExportSgpiOut objects filtered by the brand_name column
 * @method     ChildExportSgpiOut[]|Collection findByDeviceTime(string|array<string> $device_time) Return ChildExportSgpiOut objects filtered by the device_time column
 * @psalm-method Collection&\Traversable<ChildExportSgpiOut> findByDeviceTime(string|array<string> $device_time) Return ChildExportSgpiOut objects filtered by the device_time column
 * @method     ChildExportSgpiOut[]|Collection findByManagers(string|array<string> $managers) Return ChildExportSgpiOut objects filtered by the managers column
 * @psalm-method Collection&\Traversable<ChildExportSgpiOut> findByManagers(string|array<string> $managers) Return ChildExportSgpiOut objects filtered by the managers column
 * @method     ChildExportSgpiOut[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildExportSgpiOut objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildExportSgpiOut> findByCreatedAt(string|array<string> $created_at) Return ChildExportSgpiOut objects filtered by the created_at column
 * @method     ChildExportSgpiOut[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildExportSgpiOut objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildExportSgpiOut> findByUpdatedAt(string|array<string> $updated_at) Return ChildExportSgpiOut objects filtered by the updated_at column
 * @method     ChildExportSgpiOut[]|Collection findByEmpTerritory(string|array<string> $emp_territory) Return ChildExportSgpiOut objects filtered by the emp_territory column
 * @psalm-method Collection&\Traversable<ChildExportSgpiOut> findByEmpTerritory(string|array<string> $emp_territory) Return ChildExportSgpiOut objects filtered by the emp_territory column
 * @method     ChildExportSgpiOut[]|Collection findByEmpBranch(string|array<string> $emp_branch) Return ChildExportSgpiOut objects filtered by the emp_branch column
 * @psalm-method Collection&\Traversable<ChildExportSgpiOut> findByEmpBranch(string|array<string> $emp_branch) Return ChildExportSgpiOut objects filtered by the emp_branch column
 * @method     ChildExportSgpiOut[]|Collection findByEmpTown(string|array<string> $emp_town) Return ChildExportSgpiOut objects filtered by the emp_town column
 * @psalm-method Collection&\Traversable<ChildExportSgpiOut> findByEmpTown(string|array<string> $emp_town) Return ChildExportSgpiOut objects filtered by the emp_town column
 *
 * @method     ChildExportSgpiOut[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildExportSgpiOut> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class ExportSgpiOutQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\ExportSgpiOutQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\ExportSgpiOut', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildExportSgpiOutQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildExportSgpiOutQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildExportSgpiOutQuery) {
            return $criteria;
        }
        $query = new ChildExportSgpiOutQuery();
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
     * @return ChildExportSgpiOut|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        throw new LogicException('The ExportSgpiOut object has no primary key');
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
     * </code>
     * @param array $keys Primary keys to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return Collection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ?ConnectionInterface $con = null)
    {
        throw new LogicException('The ExportSgpiOut object has no primary key');
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
        throw new LogicException('The ExportSgpiOut object has no primary key');
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
        throw new LogicException('The ExportSgpiOut object has no primary key');
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
                $this->addUsingAlias(ExportSgpiOutTableMap::COL_SGPI_VOUCHER_ID, $sgpiVoucherId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($sgpiVoucherId['max'])) {
                $this->addUsingAlias(ExportSgpiOutTableMap::COL_SGPI_VOUCHER_ID, $sgpiVoucherId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportSgpiOutTableMap::COL_SGPI_VOUCHER_ID, $sgpiVoucherId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the bu_name column
     *
     * Example usage:
     * <code>
     * $query->filterByBuName('fooValue');   // WHERE bu_name = 'fooValue'
     * $query->filterByBuName('%fooValue%', Criteria::LIKE); // WHERE bu_name LIKE '%fooValue%'
     * $query->filterByBuName(['foo', 'bar']); // WHERE bu_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $buName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBuName($buName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($buName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportSgpiOutTableMap::COL_BU_NAME, $buName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the zm_manager_branch column
     *
     * Example usage:
     * <code>
     * $query->filterByZmManagerBranch('fooValue');   // WHERE zm_manager_branch = 'fooValue'
     * $query->filterByZmManagerBranch('%fooValue%', Criteria::LIKE); // WHERE zm_manager_branch LIKE '%fooValue%'
     * $query->filterByZmManagerBranch(['foo', 'bar']); // WHERE zm_manager_branch IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $zmManagerBranch The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByZmManagerBranch($zmManagerBranch = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($zmManagerBranch)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportSgpiOutTableMap::COL_ZM_MANAGER_BRANCH, $zmManagerBranch, $comparison);

        return $this;
    }

    /**
     * Filter the query on the zm_manager_town column
     *
     * Example usage:
     * <code>
     * $query->filterByZmManagerTown('fooValue');   // WHERE zm_manager_town = 'fooValue'
     * $query->filterByZmManagerTown('%fooValue%', Criteria::LIKE); // WHERE zm_manager_town LIKE '%fooValue%'
     * $query->filterByZmManagerTown(['foo', 'bar']); // WHERE zm_manager_town IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $zmManagerTown The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByZmManagerTown($zmManagerTown = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($zmManagerTown)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportSgpiOutTableMap::COL_ZM_MANAGER_TOWN, $zmManagerTown, $comparison);

        return $this;
    }

    /**
     * Filter the query on the rm_manager_branch column
     *
     * Example usage:
     * <code>
     * $query->filterByRmManagerBranch('fooValue');   // WHERE rm_manager_branch = 'fooValue'
     * $query->filterByRmManagerBranch('%fooValue%', Criteria::LIKE); // WHERE rm_manager_branch LIKE '%fooValue%'
     * $query->filterByRmManagerBranch(['foo', 'bar']); // WHERE rm_manager_branch IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $rmManagerBranch The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRmManagerBranch($rmManagerBranch = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($rmManagerBranch)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportSgpiOutTableMap::COL_RM_MANAGER_BRANCH, $rmManagerBranch, $comparison);

        return $this;
    }

    /**
     * Filter the query on the rm_manager_town column
     *
     * Example usage:
     * <code>
     * $query->filterByRmManagerTown('fooValue');   // WHERE rm_manager_town = 'fooValue'
     * $query->filterByRmManagerTown('%fooValue%', Criteria::LIKE); // WHERE rm_manager_town LIKE '%fooValue%'
     * $query->filterByRmManagerTown(['foo', 'bar']); // WHERE rm_manager_town IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $rmManagerTown The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRmManagerTown($rmManagerTown = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($rmManagerTown)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportSgpiOutTableMap::COL_RM_MANAGER_TOWN, $rmManagerTown, $comparison);

        return $this;
    }

    /**
     * Filter the query on the am_manager_branch column
     *
     * Example usage:
     * <code>
     * $query->filterByAmManagerBranch('fooValue');   // WHERE am_manager_branch = 'fooValue'
     * $query->filterByAmManagerBranch('%fooValue%', Criteria::LIKE); // WHERE am_manager_branch LIKE '%fooValue%'
     * $query->filterByAmManagerBranch(['foo', 'bar']); // WHERE am_manager_branch IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $amManagerBranch The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAmManagerBranch($amManagerBranch = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($amManagerBranch)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportSgpiOutTableMap::COL_AM_MANAGER_BRANCH, $amManagerBranch, $comparison);

        return $this;
    }

    /**
     * Filter the query on the am_manager_town column
     *
     * Example usage:
     * <code>
     * $query->filterByAmManagerTown('fooValue');   // WHERE am_manager_town = 'fooValue'
     * $query->filterByAmManagerTown('%fooValue%', Criteria::LIKE); // WHERE am_manager_town LIKE '%fooValue%'
     * $query->filterByAmManagerTown(['foo', 'bar']); // WHERE am_manager_town IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $amManagerTown The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAmManagerTown($amManagerTown = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($amManagerTown)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportSgpiOutTableMap::COL_AM_MANAGER_TOWN, $amManagerTown, $comparison);

        return $this;
    }

    /**
     * Filter the query on the zm_position_code column
     *
     * Example usage:
     * <code>
     * $query->filterByZmPositionCode('fooValue');   // WHERE zm_position_code = 'fooValue'
     * $query->filterByZmPositionCode('%fooValue%', Criteria::LIKE); // WHERE zm_position_code LIKE '%fooValue%'
     * $query->filterByZmPositionCode(['foo', 'bar']); // WHERE zm_position_code IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $zmPositionCode The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByZmPositionCode($zmPositionCode = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($zmPositionCode)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportSgpiOutTableMap::COL_ZM_POSITION_CODE, $zmPositionCode, $comparison);

        return $this;
    }

    /**
     * Filter the query on the rm_position_code column
     *
     * Example usage:
     * <code>
     * $query->filterByRmPositionCode('fooValue');   // WHERE rm_position_code = 'fooValue'
     * $query->filterByRmPositionCode('%fooValue%', Criteria::LIKE); // WHERE rm_position_code LIKE '%fooValue%'
     * $query->filterByRmPositionCode(['foo', 'bar']); // WHERE rm_position_code IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $rmPositionCode The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRmPositionCode($rmPositionCode = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($rmPositionCode)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportSgpiOutTableMap::COL_RM_POSITION_CODE, $rmPositionCode, $comparison);

        return $this;
    }

    /**
     * Filter the query on the am_position_code column
     *
     * Example usage:
     * <code>
     * $query->filterByAmPositionCode('fooValue');   // WHERE am_position_code = 'fooValue'
     * $query->filterByAmPositionCode('%fooValue%', Criteria::LIKE); // WHERE am_position_code LIKE '%fooValue%'
     * $query->filterByAmPositionCode(['foo', 'bar']); // WHERE am_position_code IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $amPositionCode The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAmPositionCode($amPositionCode = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($amPositionCode)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportSgpiOutTableMap::COL_AM_POSITION_CODE, $amPositionCode, $comparison);

        return $this;
    }

    /**
     * Filter the query on the emp_position_code column
     *
     * Example usage:
     * <code>
     * $query->filterByEmpPositionCode('fooValue');   // WHERE emp_position_code = 'fooValue'
     * $query->filterByEmpPositionCode('%fooValue%', Criteria::LIKE); // WHERE emp_position_code LIKE '%fooValue%'
     * $query->filterByEmpPositionCode(['foo', 'bar']); // WHERE emp_position_code IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $empPositionCode The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmpPositionCode($empPositionCode = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($empPositionCode)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportSgpiOutTableMap::COL_EMP_POSITION_CODE, $empPositionCode, $comparison);

        return $this;
    }

    /**
     * Filter the query on the emp_position_name column
     *
     * Example usage:
     * <code>
     * $query->filterByEmpPositionName('fooValue');   // WHERE emp_position_name = 'fooValue'
     * $query->filterByEmpPositionName('%fooValue%', Criteria::LIKE); // WHERE emp_position_name LIKE '%fooValue%'
     * $query->filterByEmpPositionName(['foo', 'bar']); // WHERE emp_position_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $empPositionName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmpPositionName($empPositionName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($empPositionName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportSgpiOutTableMap::COL_EMP_POSITION_NAME, $empPositionName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the emp_level column
     *
     * Example usage:
     * <code>
     * $query->filterByEmpLevel('fooValue');   // WHERE emp_level = 'fooValue'
     * $query->filterByEmpLevel('%fooValue%', Criteria::LIKE); // WHERE emp_level LIKE '%fooValue%'
     * $query->filterByEmpLevel(['foo', 'bar']); // WHERE emp_level IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $empLevel The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmpLevel($empLevel = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($empLevel)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportSgpiOutTableMap::COL_EMP_LEVEL, $empLevel, $comparison);

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

        $this->addUsingAlias(ExportSgpiOutTableMap::COL_EMPLOYEE_CODE, $employeeCode, $comparison);

        return $this;
    }

    /**
     * Filter the query on the employee_name column
     *
     * Example usage:
     * <code>
     * $query->filterByEmployeeName('fooValue');   // WHERE employee_name = 'fooValue'
     * $query->filterByEmployeeName('%fooValue%', Criteria::LIKE); // WHERE employee_name LIKE '%fooValue%'
     * $query->filterByEmployeeName(['foo', 'bar']); // WHERE employee_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $employeeName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmployeeName($employeeName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($employeeName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportSgpiOutTableMap::COL_EMPLOYEE_NAME, $employeeName, $comparison);

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

        $this->addUsingAlias(ExportSgpiOutTableMap::COL_OUTLET_CODE, $outletCode, $comparison);

        return $this;
    }

    /**
     * Filter the query on the brand_focus column
     *
     * Example usage:
     * <code>
     * $query->filterByBrandFocus('fooValue');   // WHERE brand_focus = 'fooValue'
     * $query->filterByBrandFocus('%fooValue%', Criteria::LIKE); // WHERE brand_focus LIKE '%fooValue%'
     * $query->filterByBrandFocus(['foo', 'bar']); // WHERE brand_focus IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $brandFocus The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBrandFocus($brandFocus = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($brandFocus)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportSgpiOutTableMap::COL_BRAND_FOCUS, $brandFocus, $comparison);

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
                $this->addUsingAlias(ExportSgpiOutTableMap::COL_OUTLET_ORG_ID, $outletOrgId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outletOrgId['max'])) {
                $this->addUsingAlias(ExportSgpiOutTableMap::COL_OUTLET_ORG_ID, $outletOrgId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportSgpiOutTableMap::COL_OUTLET_ORG_ID, $outletOrgId, $comparison);

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
                $this->addUsingAlias(ExportSgpiOutTableMap::COL_ORG_UNIT_ID, $orgUnitId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($orgUnitId['max'])) {
                $this->addUsingAlias(ExportSgpiOutTableMap::COL_ORG_UNIT_ID, $orgUnitId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportSgpiOutTableMap::COL_ORG_UNIT_ID, $orgUnitId, $comparison);

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
                $this->addUsingAlias(ExportSgpiOutTableMap::COL_TERRITORY_ID, $territoryId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($territoryId['max'])) {
                $this->addUsingAlias(ExportSgpiOutTableMap::COL_TERRITORY_ID, $territoryId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportSgpiOutTableMap::COL_TERRITORY_ID, $territoryId, $comparison);

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

        $this->addUsingAlias(ExportSgpiOutTableMap::COL_TERRITORY_NAME, $territoryName, $comparison);

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
                $this->addUsingAlias(ExportSgpiOutTableMap::COL_BEAT_ID, $beatId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($beatId['max'])) {
                $this->addUsingAlias(ExportSgpiOutTableMap::COL_BEAT_ID, $beatId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportSgpiOutTableMap::COL_BEAT_ID, $beatId, $comparison);

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

        $this->addUsingAlias(ExportSgpiOutTableMap::COL_BEAT_NAME, $beatName, $comparison);

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

        $this->addUsingAlias(ExportSgpiOutTableMap::COL_TAGS, $tags, $comparison);

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
                $this->addUsingAlias(ExportSgpiOutTableMap::COL_VISIT_FQ, $visitFq['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($visitFq['max'])) {
                $this->addUsingAlias(ExportSgpiOutTableMap::COL_VISIT_FQ, $visitFq['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportSgpiOutTableMap::COL_VISIT_FQ, $visitFq, $comparison);

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

        $this->addUsingAlias(ExportSgpiOutTableMap::COL_OUTLET_SALUTATION, $outletSalutation, $comparison);

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

        $this->addUsingAlias(ExportSgpiOutTableMap::COL_OUTLET_NAME, $outletName, $comparison);

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

        $this->addUsingAlias(ExportSgpiOutTableMap::COL_CLASSIFICATION, $classification, $comparison);

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

        $this->addUsingAlias(ExportSgpiOutTableMap::COL_OUTLETTYPE_NAME, $outlettypeName, $comparison);

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

        $this->addUsingAlias(ExportSgpiOutTableMap::COL_SGPI_NAME, $sgpiName, $comparison);

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

        $this->addUsingAlias(ExportSgpiOutTableMap::COL_SGPI_CODE, $sgpiCode, $comparison);

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

        $this->addUsingAlias(ExportSgpiOutTableMap::COL_MATERIAL_SKU, $materialSku, $comparison);

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

        $this->addUsingAlias(ExportSgpiOutTableMap::COL_SGPI_TYPE, $sgpiType, $comparison);

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
                $this->addUsingAlias(ExportSgpiOutTableMap::COL_SGPI_QTY, $sgpiQty['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($sgpiQty['max'])) {
                $this->addUsingAlias(ExportSgpiOutTableMap::COL_SGPI_QTY, $sgpiQty['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportSgpiOutTableMap::COL_SGPI_QTY, $sgpiQty, $comparison);

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
                $this->addUsingAlias(ExportSgpiOutTableMap::COL_DCR_ID, $dcrId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dcrId['max'])) {
                $this->addUsingAlias(ExportSgpiOutTableMap::COL_DCR_ID, $dcrId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportSgpiOutTableMap::COL_DCR_ID, $dcrId, $comparison);

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
                $this->addUsingAlias(ExportSgpiOutTableMap::COL_DCR_DATE, $dcrDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dcrDate['max'])) {
                $this->addUsingAlias(ExportSgpiOutTableMap::COL_DCR_DATE, $dcrDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportSgpiOutTableMap::COL_DCR_DATE, $dcrDate, $comparison);

        return $this;
    }

    /**
     * Filter the query on the brand_name column
     *
     * Example usage:
     * <code>
     * $query->filterByBrandName('fooValue');   // WHERE brand_name = 'fooValue'
     * $query->filterByBrandName('%fooValue%', Criteria::LIKE); // WHERE brand_name LIKE '%fooValue%'
     * $query->filterByBrandName(['foo', 'bar']); // WHERE brand_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $brandName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBrandName($brandName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($brandName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportSgpiOutTableMap::COL_BRAND_NAME, $brandName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the device_time column
     *
     * Example usage:
     * <code>
     * $query->filterByDeviceTime('2011-03-14'); // WHERE device_time = '2011-03-14'
     * $query->filterByDeviceTime('now'); // WHERE device_time = '2011-03-14'
     * $query->filterByDeviceTime(array('max' => 'yesterday')); // WHERE device_time > '2011-03-13'
     * </code>
     *
     * @param mixed $deviceTime The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDeviceTime($deviceTime = null, ?string $comparison = null)
    {
        if (is_array($deviceTime)) {
            $useMinMax = false;
            if (isset($deviceTime['min'])) {
                $this->addUsingAlias(ExportSgpiOutTableMap::COL_DEVICE_TIME, $deviceTime['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($deviceTime['max'])) {
                $this->addUsingAlias(ExportSgpiOutTableMap::COL_DEVICE_TIME, $deviceTime['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportSgpiOutTableMap::COL_DEVICE_TIME, $deviceTime, $comparison);

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

        $this->addUsingAlias(ExportSgpiOutTableMap::COL_MANAGERS, $managers, $comparison);

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
                $this->addUsingAlias(ExportSgpiOutTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(ExportSgpiOutTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportSgpiOutTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(ExportSgpiOutTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(ExportSgpiOutTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportSgpiOutTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the emp_territory column
     *
     * Example usage:
     * <code>
     * $query->filterByEmpTerritory('fooValue');   // WHERE emp_territory = 'fooValue'
     * $query->filterByEmpTerritory('%fooValue%', Criteria::LIKE); // WHERE emp_territory LIKE '%fooValue%'
     * $query->filterByEmpTerritory(['foo', 'bar']); // WHERE emp_territory IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $empTerritory The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmpTerritory($empTerritory = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($empTerritory)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportSgpiOutTableMap::COL_EMP_TERRITORY, $empTerritory, $comparison);

        return $this;
    }

    /**
     * Filter the query on the emp_branch column
     *
     * Example usage:
     * <code>
     * $query->filterByEmpBranch('fooValue');   // WHERE emp_branch = 'fooValue'
     * $query->filterByEmpBranch('%fooValue%', Criteria::LIKE); // WHERE emp_branch LIKE '%fooValue%'
     * $query->filterByEmpBranch(['foo', 'bar']); // WHERE emp_branch IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $empBranch The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmpBranch($empBranch = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($empBranch)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportSgpiOutTableMap::COL_EMP_BRANCH, $empBranch, $comparison);

        return $this;
    }

    /**
     * Filter the query on the emp_town column
     *
     * Example usage:
     * <code>
     * $query->filterByEmpTown('fooValue');   // WHERE emp_town = 'fooValue'
     * $query->filterByEmpTown('%fooValue%', Criteria::LIKE); // WHERE emp_town LIKE '%fooValue%'
     * $query->filterByEmpTown(['foo', 'bar']); // WHERE emp_town IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $empTown The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmpTown($empTown = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($empTown)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportSgpiOutTableMap::COL_EMP_TOWN, $empTown, $comparison);

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildExportSgpiOut $exportSgpiOut Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($exportSgpiOut = null)
    {
        if ($exportSgpiOut) {
            throw new LogicException('ExportSgpiOut object has no primary key');

        }

        return $this;
    }

}
