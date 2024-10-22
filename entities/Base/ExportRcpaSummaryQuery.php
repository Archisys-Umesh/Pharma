<?php

namespace entities\Base;

use \Exception;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\LogicException;
use entities\ExportRcpaSummary as ChildExportRcpaSummary;
use entities\ExportRcpaSummaryQuery as ChildExportRcpaSummaryQuery;
use entities\Map\ExportRcpaSummaryTableMap;

/**
 * Base class that represents a query for the `export_rcpa_summary` table.
 *
 * @method     ChildExportRcpaSummaryQuery orderByUniqueid($order = Criteria::ASC) Order by the uniqueid column
 * @method     ChildExportRcpaSummaryQuery orderByOrgunitid($order = Criteria::ASC) Order by the orgunitid column
 * @method     ChildExportRcpaSummaryQuery orderByZmManagerBranch($order = Criteria::ASC) Order by the zm_manager_branch column
 * @method     ChildExportRcpaSummaryQuery orderByZmManagerTown($order = Criteria::ASC) Order by the zm_manager_town column
 * @method     ChildExportRcpaSummaryQuery orderByRmManagerBranch($order = Criteria::ASC) Order by the rm_manager_branch column
 * @method     ChildExportRcpaSummaryQuery orderByRmManagerTown($order = Criteria::ASC) Order by the rm_manager_town column
 * @method     ChildExportRcpaSummaryQuery orderByAmManagerBranch($order = Criteria::ASC) Order by the am_manager_branch column
 * @method     ChildExportRcpaSummaryQuery orderByAmManagerTown($order = Criteria::ASC) Order by the am_manager_town column
 * @method     ChildExportRcpaSummaryQuery orderByZmPositionCode($order = Criteria::ASC) Order by the zm_position_code column
 * @method     ChildExportRcpaSummaryQuery orderByRmPositionCode($order = Criteria::ASC) Order by the rm_position_code column
 * @method     ChildExportRcpaSummaryQuery orderByAmPositionCode($order = Criteria::ASC) Order by the am_position_code column
 * @method     ChildExportRcpaSummaryQuery orderByEmpPositionCode($order = Criteria::ASC) Order by the emp_position_code column
 * @method     ChildExportRcpaSummaryQuery orderByEmpPositionName($order = Criteria::ASC) Order by the emp_position_name column
 * @method     ChildExportRcpaSummaryQuery orderByEmpLevel($order = Criteria::ASC) Order by the emp_level column
 * @method     ChildExportRcpaSummaryQuery orderByEmployeeCode($order = Criteria::ASC) Order by the employee_code column
 * @method     ChildExportRcpaSummaryQuery orderByEmpName($order = Criteria::ASC) Order by the emp_name column
 * @method     ChildExportRcpaSummaryQuery orderByDrcode($order = Criteria::ASC) Order by the drcode column
 * @method     ChildExportRcpaSummaryQuery orderByDrname($order = Criteria::ASC) Order by the drname column
 * @method     ChildExportRcpaSummaryQuery orderByRetailercode($order = Criteria::ASC) Order by the retailercode column
 * @method     ChildExportRcpaSummaryQuery orderByRetailername($order = Criteria::ASC) Order by the retailername column
 * @method     ChildExportRcpaSummaryQuery orderByOutletClassification($order = Criteria::ASC) Order by the outlet_classification column
 * @method     ChildExportRcpaSummaryQuery orderByVisitFq($order = Criteria::ASC) Order by the visit_fq column
 * @method     ChildExportRcpaSummaryQuery orderByTerritory($order = Criteria::ASC) Order by the territory column
 * @method     ChildExportRcpaSummaryQuery orderByTags($order = Criteria::ASC) Order by the tags column
 * @method     ChildExportRcpaSummaryQuery orderByRcpaMoye($order = Criteria::ASC) Order by the rcpa_moye column
 * @method     ChildExportRcpaSummaryQuery orderByBrandName($order = Criteria::ASC) Order by the brand_name column
 * @method     ChildExportRcpaSummaryQuery orderByCompetitorName($order = Criteria::ASC) Order by the competitor_name column
 * @method     ChildExportRcpaSummaryQuery orderByRcpaQty($order = Criteria::ASC) Order by the rcpa_qty column
 * @method     ChildExportRcpaSummaryQuery orderByOwnRate($order = Criteria::ASC) Order by the own_rate column
 * @method     ChildExportRcpaSummaryQuery orderByCompetitorRate($order = Criteria::ASC) Order by the competitor_rate column
 * @method     ChildExportRcpaSummaryQuery orderByPotential($order = Criteria::ASC) Order by the potential column
 * @method     ChildExportRcpaSummaryQuery orderByOwn($order = Criteria::ASC) Order by the own column
 * @method     ChildExportRcpaSummaryQuery orderByCompetition($order = Criteria::ASC) Order by the competition column
 * @method     ChildExportRcpaSummaryQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildExportRcpaSummaryQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildExportRcpaSummaryQuery orderByMinValue($order = Criteria::ASC) Order by the min_value column
 * @method     ChildExportRcpaSummaryQuery orderByEmpTerritory($order = Criteria::ASC) Order by the emp_territory column
 * @method     ChildExportRcpaSummaryQuery orderByEmpBranch($order = Criteria::ASC) Order by the emp_branch column
 * @method     ChildExportRcpaSummaryQuery orderByEmpTown($order = Criteria::ASC) Order by the emp_town column
 *
 * @method     ChildExportRcpaSummaryQuery groupByUniqueid() Group by the uniqueid column
 * @method     ChildExportRcpaSummaryQuery groupByOrgunitid() Group by the orgunitid column
 * @method     ChildExportRcpaSummaryQuery groupByZmManagerBranch() Group by the zm_manager_branch column
 * @method     ChildExportRcpaSummaryQuery groupByZmManagerTown() Group by the zm_manager_town column
 * @method     ChildExportRcpaSummaryQuery groupByRmManagerBranch() Group by the rm_manager_branch column
 * @method     ChildExportRcpaSummaryQuery groupByRmManagerTown() Group by the rm_manager_town column
 * @method     ChildExportRcpaSummaryQuery groupByAmManagerBranch() Group by the am_manager_branch column
 * @method     ChildExportRcpaSummaryQuery groupByAmManagerTown() Group by the am_manager_town column
 * @method     ChildExportRcpaSummaryQuery groupByZmPositionCode() Group by the zm_position_code column
 * @method     ChildExportRcpaSummaryQuery groupByRmPositionCode() Group by the rm_position_code column
 * @method     ChildExportRcpaSummaryQuery groupByAmPositionCode() Group by the am_position_code column
 * @method     ChildExportRcpaSummaryQuery groupByEmpPositionCode() Group by the emp_position_code column
 * @method     ChildExportRcpaSummaryQuery groupByEmpPositionName() Group by the emp_position_name column
 * @method     ChildExportRcpaSummaryQuery groupByEmpLevel() Group by the emp_level column
 * @method     ChildExportRcpaSummaryQuery groupByEmployeeCode() Group by the employee_code column
 * @method     ChildExportRcpaSummaryQuery groupByEmpName() Group by the emp_name column
 * @method     ChildExportRcpaSummaryQuery groupByDrcode() Group by the drcode column
 * @method     ChildExportRcpaSummaryQuery groupByDrname() Group by the drname column
 * @method     ChildExportRcpaSummaryQuery groupByRetailercode() Group by the retailercode column
 * @method     ChildExportRcpaSummaryQuery groupByRetailername() Group by the retailername column
 * @method     ChildExportRcpaSummaryQuery groupByOutletClassification() Group by the outlet_classification column
 * @method     ChildExportRcpaSummaryQuery groupByVisitFq() Group by the visit_fq column
 * @method     ChildExportRcpaSummaryQuery groupByTerritory() Group by the territory column
 * @method     ChildExportRcpaSummaryQuery groupByTags() Group by the tags column
 * @method     ChildExportRcpaSummaryQuery groupByRcpaMoye() Group by the rcpa_moye column
 * @method     ChildExportRcpaSummaryQuery groupByBrandName() Group by the brand_name column
 * @method     ChildExportRcpaSummaryQuery groupByCompetitorName() Group by the competitor_name column
 * @method     ChildExportRcpaSummaryQuery groupByRcpaQty() Group by the rcpa_qty column
 * @method     ChildExportRcpaSummaryQuery groupByOwnRate() Group by the own_rate column
 * @method     ChildExportRcpaSummaryQuery groupByCompetitorRate() Group by the competitor_rate column
 * @method     ChildExportRcpaSummaryQuery groupByPotential() Group by the potential column
 * @method     ChildExportRcpaSummaryQuery groupByOwn() Group by the own column
 * @method     ChildExportRcpaSummaryQuery groupByCompetition() Group by the competition column
 * @method     ChildExportRcpaSummaryQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildExportRcpaSummaryQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildExportRcpaSummaryQuery groupByMinValue() Group by the min_value column
 * @method     ChildExportRcpaSummaryQuery groupByEmpTerritory() Group by the emp_territory column
 * @method     ChildExportRcpaSummaryQuery groupByEmpBranch() Group by the emp_branch column
 * @method     ChildExportRcpaSummaryQuery groupByEmpTown() Group by the emp_town column
 *
 * @method     ChildExportRcpaSummaryQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildExportRcpaSummaryQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildExportRcpaSummaryQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildExportRcpaSummaryQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildExportRcpaSummaryQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildExportRcpaSummaryQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildExportRcpaSummary|null findOne(?ConnectionInterface $con = null) Return the first ChildExportRcpaSummary matching the query
 * @method     ChildExportRcpaSummary findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildExportRcpaSummary matching the query, or a new ChildExportRcpaSummary object populated from the query conditions when no match is found
 *
 * @method     ChildExportRcpaSummary|null findOneByUniqueid(string $uniqueid) Return the first ChildExportRcpaSummary filtered by the uniqueid column
 * @method     ChildExportRcpaSummary|null findOneByOrgunitid(string $orgunitid) Return the first ChildExportRcpaSummary filtered by the orgunitid column
 * @method     ChildExportRcpaSummary|null findOneByZmManagerBranch(string $zm_manager_branch) Return the first ChildExportRcpaSummary filtered by the zm_manager_branch column
 * @method     ChildExportRcpaSummary|null findOneByZmManagerTown(string $zm_manager_town) Return the first ChildExportRcpaSummary filtered by the zm_manager_town column
 * @method     ChildExportRcpaSummary|null findOneByRmManagerBranch(string $rm_manager_branch) Return the first ChildExportRcpaSummary filtered by the rm_manager_branch column
 * @method     ChildExportRcpaSummary|null findOneByRmManagerTown(string $rm_manager_town) Return the first ChildExportRcpaSummary filtered by the rm_manager_town column
 * @method     ChildExportRcpaSummary|null findOneByAmManagerBranch(string $am_manager_branch) Return the first ChildExportRcpaSummary filtered by the am_manager_branch column
 * @method     ChildExportRcpaSummary|null findOneByAmManagerTown(string $am_manager_town) Return the first ChildExportRcpaSummary filtered by the am_manager_town column
 * @method     ChildExportRcpaSummary|null findOneByZmPositionCode(string $zm_position_code) Return the first ChildExportRcpaSummary filtered by the zm_position_code column
 * @method     ChildExportRcpaSummary|null findOneByRmPositionCode(string $rm_position_code) Return the first ChildExportRcpaSummary filtered by the rm_position_code column
 * @method     ChildExportRcpaSummary|null findOneByAmPositionCode(string $am_position_code) Return the first ChildExportRcpaSummary filtered by the am_position_code column
 * @method     ChildExportRcpaSummary|null findOneByEmpPositionCode(string $emp_position_code) Return the first ChildExportRcpaSummary filtered by the emp_position_code column
 * @method     ChildExportRcpaSummary|null findOneByEmpPositionName(string $emp_position_name) Return the first ChildExportRcpaSummary filtered by the emp_position_name column
 * @method     ChildExportRcpaSummary|null findOneByEmpLevel(string $emp_level) Return the first ChildExportRcpaSummary filtered by the emp_level column
 * @method     ChildExportRcpaSummary|null findOneByEmployeeCode(string $employee_code) Return the first ChildExportRcpaSummary filtered by the employee_code column
 * @method     ChildExportRcpaSummary|null findOneByEmpName(string $emp_name) Return the first ChildExportRcpaSummary filtered by the emp_name column
 * @method     ChildExportRcpaSummary|null findOneByDrcode(string $drcode) Return the first ChildExportRcpaSummary filtered by the drcode column
 * @method     ChildExportRcpaSummary|null findOneByDrname(string $drname) Return the first ChildExportRcpaSummary filtered by the drname column
 * @method     ChildExportRcpaSummary|null findOneByRetailercode(string $retailercode) Return the first ChildExportRcpaSummary filtered by the retailercode column
 * @method     ChildExportRcpaSummary|null findOneByRetailername(string $retailername) Return the first ChildExportRcpaSummary filtered by the retailername column
 * @method     ChildExportRcpaSummary|null findOneByOutletClassification(string $outlet_classification) Return the first ChildExportRcpaSummary filtered by the outlet_classification column
 * @method     ChildExportRcpaSummary|null findOneByVisitFq(int $visit_fq) Return the first ChildExportRcpaSummary filtered by the visit_fq column
 * @method     ChildExportRcpaSummary|null findOneByTerritory(string $territory) Return the first ChildExportRcpaSummary filtered by the territory column
 * @method     ChildExportRcpaSummary|null findOneByTags(string $tags) Return the first ChildExportRcpaSummary filtered by the tags column
 * @method     ChildExportRcpaSummary|null findOneByRcpaMoye(string $rcpa_moye) Return the first ChildExportRcpaSummary filtered by the rcpa_moye column
 * @method     ChildExportRcpaSummary|null findOneByBrandName(string $brand_name) Return the first ChildExportRcpaSummary filtered by the brand_name column
 * @method     ChildExportRcpaSummary|null findOneByCompetitorName(string $competitor_name) Return the first ChildExportRcpaSummary filtered by the competitor_name column
 * @method     ChildExportRcpaSummary|null findOneByRcpaQty(string $rcpa_qty) Return the first ChildExportRcpaSummary filtered by the rcpa_qty column
 * @method     ChildExportRcpaSummary|null findOneByOwnRate(string $own_rate) Return the first ChildExportRcpaSummary filtered by the own_rate column
 * @method     ChildExportRcpaSummary|null findOneByCompetitorRate(string $competitor_rate) Return the first ChildExportRcpaSummary filtered by the competitor_rate column
 * @method     ChildExportRcpaSummary|null findOneByPotential(string $potential) Return the first ChildExportRcpaSummary filtered by the potential column
 * @method     ChildExportRcpaSummary|null findOneByOwn(string $own) Return the first ChildExportRcpaSummary filtered by the own column
 * @method     ChildExportRcpaSummary|null findOneByCompetition(string $competition) Return the first ChildExportRcpaSummary filtered by the competition column
 * @method     ChildExportRcpaSummary|null findOneByCreatedAt(string $created_at) Return the first ChildExportRcpaSummary filtered by the created_at column
 * @method     ChildExportRcpaSummary|null findOneByUpdatedAt(string $updated_at) Return the first ChildExportRcpaSummary filtered by the updated_at column
 * @method     ChildExportRcpaSummary|null findOneByMinValue(int $min_value) Return the first ChildExportRcpaSummary filtered by the min_value column
 * @method     ChildExportRcpaSummary|null findOneByEmpTerritory(string $emp_territory) Return the first ChildExportRcpaSummary filtered by the emp_territory column
 * @method     ChildExportRcpaSummary|null findOneByEmpBranch(string $emp_branch) Return the first ChildExportRcpaSummary filtered by the emp_branch column
 * @method     ChildExportRcpaSummary|null findOneByEmpTown(string $emp_town) Return the first ChildExportRcpaSummary filtered by the emp_town column
 *
 * @method     ChildExportRcpaSummary requirePk($key, ?ConnectionInterface $con = null) Return the ChildExportRcpaSummary by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportRcpaSummary requireOne(?ConnectionInterface $con = null) Return the first ChildExportRcpaSummary matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildExportRcpaSummary requireOneByUniqueid(string $uniqueid) Return the first ChildExportRcpaSummary filtered by the uniqueid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportRcpaSummary requireOneByOrgunitid(string $orgunitid) Return the first ChildExportRcpaSummary filtered by the orgunitid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportRcpaSummary requireOneByZmManagerBranch(string $zm_manager_branch) Return the first ChildExportRcpaSummary filtered by the zm_manager_branch column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportRcpaSummary requireOneByZmManagerTown(string $zm_manager_town) Return the first ChildExportRcpaSummary filtered by the zm_manager_town column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportRcpaSummary requireOneByRmManagerBranch(string $rm_manager_branch) Return the first ChildExportRcpaSummary filtered by the rm_manager_branch column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportRcpaSummary requireOneByRmManagerTown(string $rm_manager_town) Return the first ChildExportRcpaSummary filtered by the rm_manager_town column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportRcpaSummary requireOneByAmManagerBranch(string $am_manager_branch) Return the first ChildExportRcpaSummary filtered by the am_manager_branch column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportRcpaSummary requireOneByAmManagerTown(string $am_manager_town) Return the first ChildExportRcpaSummary filtered by the am_manager_town column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportRcpaSummary requireOneByZmPositionCode(string $zm_position_code) Return the first ChildExportRcpaSummary filtered by the zm_position_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportRcpaSummary requireOneByRmPositionCode(string $rm_position_code) Return the first ChildExportRcpaSummary filtered by the rm_position_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportRcpaSummary requireOneByAmPositionCode(string $am_position_code) Return the first ChildExportRcpaSummary filtered by the am_position_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportRcpaSummary requireOneByEmpPositionCode(string $emp_position_code) Return the first ChildExportRcpaSummary filtered by the emp_position_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportRcpaSummary requireOneByEmpPositionName(string $emp_position_name) Return the first ChildExportRcpaSummary filtered by the emp_position_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportRcpaSummary requireOneByEmpLevel(string $emp_level) Return the first ChildExportRcpaSummary filtered by the emp_level column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportRcpaSummary requireOneByEmployeeCode(string $employee_code) Return the first ChildExportRcpaSummary filtered by the employee_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportRcpaSummary requireOneByEmpName(string $emp_name) Return the first ChildExportRcpaSummary filtered by the emp_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportRcpaSummary requireOneByDrcode(string $drcode) Return the first ChildExportRcpaSummary filtered by the drcode column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportRcpaSummary requireOneByDrname(string $drname) Return the first ChildExportRcpaSummary filtered by the drname column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportRcpaSummary requireOneByRetailercode(string $retailercode) Return the first ChildExportRcpaSummary filtered by the retailercode column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportRcpaSummary requireOneByRetailername(string $retailername) Return the first ChildExportRcpaSummary filtered by the retailername column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportRcpaSummary requireOneByOutletClassification(string $outlet_classification) Return the first ChildExportRcpaSummary filtered by the outlet_classification column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportRcpaSummary requireOneByVisitFq(int $visit_fq) Return the first ChildExportRcpaSummary filtered by the visit_fq column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportRcpaSummary requireOneByTerritory(string $territory) Return the first ChildExportRcpaSummary filtered by the territory column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportRcpaSummary requireOneByTags(string $tags) Return the first ChildExportRcpaSummary filtered by the tags column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportRcpaSummary requireOneByRcpaMoye(string $rcpa_moye) Return the first ChildExportRcpaSummary filtered by the rcpa_moye column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportRcpaSummary requireOneByBrandName(string $brand_name) Return the first ChildExportRcpaSummary filtered by the brand_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportRcpaSummary requireOneByCompetitorName(string $competitor_name) Return the first ChildExportRcpaSummary filtered by the competitor_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportRcpaSummary requireOneByRcpaQty(string $rcpa_qty) Return the first ChildExportRcpaSummary filtered by the rcpa_qty column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportRcpaSummary requireOneByOwnRate(string $own_rate) Return the first ChildExportRcpaSummary filtered by the own_rate column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportRcpaSummary requireOneByCompetitorRate(string $competitor_rate) Return the first ChildExportRcpaSummary filtered by the competitor_rate column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportRcpaSummary requireOneByPotential(string $potential) Return the first ChildExportRcpaSummary filtered by the potential column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportRcpaSummary requireOneByOwn(string $own) Return the first ChildExportRcpaSummary filtered by the own column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportRcpaSummary requireOneByCompetition(string $competition) Return the first ChildExportRcpaSummary filtered by the competition column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportRcpaSummary requireOneByCreatedAt(string $created_at) Return the first ChildExportRcpaSummary filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportRcpaSummary requireOneByUpdatedAt(string $updated_at) Return the first ChildExportRcpaSummary filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportRcpaSummary requireOneByMinValue(int $min_value) Return the first ChildExportRcpaSummary filtered by the min_value column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportRcpaSummary requireOneByEmpTerritory(string $emp_territory) Return the first ChildExportRcpaSummary filtered by the emp_territory column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportRcpaSummary requireOneByEmpBranch(string $emp_branch) Return the first ChildExportRcpaSummary filtered by the emp_branch column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportRcpaSummary requireOneByEmpTown(string $emp_town) Return the first ChildExportRcpaSummary filtered by the emp_town column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildExportRcpaSummary[]|Collection find(?ConnectionInterface $con = null) Return ChildExportRcpaSummary objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildExportRcpaSummary> find(?ConnectionInterface $con = null) Return ChildExportRcpaSummary objects based on current ModelCriteria
 *
 * @method     ChildExportRcpaSummary[]|Collection findByUniqueid(string|array<string> $uniqueid) Return ChildExportRcpaSummary objects filtered by the uniqueid column
 * @psalm-method Collection&\Traversable<ChildExportRcpaSummary> findByUniqueid(string|array<string> $uniqueid) Return ChildExportRcpaSummary objects filtered by the uniqueid column
 * @method     ChildExportRcpaSummary[]|Collection findByOrgunitid(string|array<string> $orgunitid) Return ChildExportRcpaSummary objects filtered by the orgunitid column
 * @psalm-method Collection&\Traversable<ChildExportRcpaSummary> findByOrgunitid(string|array<string> $orgunitid) Return ChildExportRcpaSummary objects filtered by the orgunitid column
 * @method     ChildExportRcpaSummary[]|Collection findByZmManagerBranch(string|array<string> $zm_manager_branch) Return ChildExportRcpaSummary objects filtered by the zm_manager_branch column
 * @psalm-method Collection&\Traversable<ChildExportRcpaSummary> findByZmManagerBranch(string|array<string> $zm_manager_branch) Return ChildExportRcpaSummary objects filtered by the zm_manager_branch column
 * @method     ChildExportRcpaSummary[]|Collection findByZmManagerTown(string|array<string> $zm_manager_town) Return ChildExportRcpaSummary objects filtered by the zm_manager_town column
 * @psalm-method Collection&\Traversable<ChildExportRcpaSummary> findByZmManagerTown(string|array<string> $zm_manager_town) Return ChildExportRcpaSummary objects filtered by the zm_manager_town column
 * @method     ChildExportRcpaSummary[]|Collection findByRmManagerBranch(string|array<string> $rm_manager_branch) Return ChildExportRcpaSummary objects filtered by the rm_manager_branch column
 * @psalm-method Collection&\Traversable<ChildExportRcpaSummary> findByRmManagerBranch(string|array<string> $rm_manager_branch) Return ChildExportRcpaSummary objects filtered by the rm_manager_branch column
 * @method     ChildExportRcpaSummary[]|Collection findByRmManagerTown(string|array<string> $rm_manager_town) Return ChildExportRcpaSummary objects filtered by the rm_manager_town column
 * @psalm-method Collection&\Traversable<ChildExportRcpaSummary> findByRmManagerTown(string|array<string> $rm_manager_town) Return ChildExportRcpaSummary objects filtered by the rm_manager_town column
 * @method     ChildExportRcpaSummary[]|Collection findByAmManagerBranch(string|array<string> $am_manager_branch) Return ChildExportRcpaSummary objects filtered by the am_manager_branch column
 * @psalm-method Collection&\Traversable<ChildExportRcpaSummary> findByAmManagerBranch(string|array<string> $am_manager_branch) Return ChildExportRcpaSummary objects filtered by the am_manager_branch column
 * @method     ChildExportRcpaSummary[]|Collection findByAmManagerTown(string|array<string> $am_manager_town) Return ChildExportRcpaSummary objects filtered by the am_manager_town column
 * @psalm-method Collection&\Traversable<ChildExportRcpaSummary> findByAmManagerTown(string|array<string> $am_manager_town) Return ChildExportRcpaSummary objects filtered by the am_manager_town column
 * @method     ChildExportRcpaSummary[]|Collection findByZmPositionCode(string|array<string> $zm_position_code) Return ChildExportRcpaSummary objects filtered by the zm_position_code column
 * @psalm-method Collection&\Traversable<ChildExportRcpaSummary> findByZmPositionCode(string|array<string> $zm_position_code) Return ChildExportRcpaSummary objects filtered by the zm_position_code column
 * @method     ChildExportRcpaSummary[]|Collection findByRmPositionCode(string|array<string> $rm_position_code) Return ChildExportRcpaSummary objects filtered by the rm_position_code column
 * @psalm-method Collection&\Traversable<ChildExportRcpaSummary> findByRmPositionCode(string|array<string> $rm_position_code) Return ChildExportRcpaSummary objects filtered by the rm_position_code column
 * @method     ChildExportRcpaSummary[]|Collection findByAmPositionCode(string|array<string> $am_position_code) Return ChildExportRcpaSummary objects filtered by the am_position_code column
 * @psalm-method Collection&\Traversable<ChildExportRcpaSummary> findByAmPositionCode(string|array<string> $am_position_code) Return ChildExportRcpaSummary objects filtered by the am_position_code column
 * @method     ChildExportRcpaSummary[]|Collection findByEmpPositionCode(string|array<string> $emp_position_code) Return ChildExportRcpaSummary objects filtered by the emp_position_code column
 * @psalm-method Collection&\Traversable<ChildExportRcpaSummary> findByEmpPositionCode(string|array<string> $emp_position_code) Return ChildExportRcpaSummary objects filtered by the emp_position_code column
 * @method     ChildExportRcpaSummary[]|Collection findByEmpPositionName(string|array<string> $emp_position_name) Return ChildExportRcpaSummary objects filtered by the emp_position_name column
 * @psalm-method Collection&\Traversable<ChildExportRcpaSummary> findByEmpPositionName(string|array<string> $emp_position_name) Return ChildExportRcpaSummary objects filtered by the emp_position_name column
 * @method     ChildExportRcpaSummary[]|Collection findByEmpLevel(string|array<string> $emp_level) Return ChildExportRcpaSummary objects filtered by the emp_level column
 * @psalm-method Collection&\Traversable<ChildExportRcpaSummary> findByEmpLevel(string|array<string> $emp_level) Return ChildExportRcpaSummary objects filtered by the emp_level column
 * @method     ChildExportRcpaSummary[]|Collection findByEmployeeCode(string|array<string> $employee_code) Return ChildExportRcpaSummary objects filtered by the employee_code column
 * @psalm-method Collection&\Traversable<ChildExportRcpaSummary> findByEmployeeCode(string|array<string> $employee_code) Return ChildExportRcpaSummary objects filtered by the employee_code column
 * @method     ChildExportRcpaSummary[]|Collection findByEmpName(string|array<string> $emp_name) Return ChildExportRcpaSummary objects filtered by the emp_name column
 * @psalm-method Collection&\Traversable<ChildExportRcpaSummary> findByEmpName(string|array<string> $emp_name) Return ChildExportRcpaSummary objects filtered by the emp_name column
 * @method     ChildExportRcpaSummary[]|Collection findByDrcode(string|array<string> $drcode) Return ChildExportRcpaSummary objects filtered by the drcode column
 * @psalm-method Collection&\Traversable<ChildExportRcpaSummary> findByDrcode(string|array<string> $drcode) Return ChildExportRcpaSummary objects filtered by the drcode column
 * @method     ChildExportRcpaSummary[]|Collection findByDrname(string|array<string> $drname) Return ChildExportRcpaSummary objects filtered by the drname column
 * @psalm-method Collection&\Traversable<ChildExportRcpaSummary> findByDrname(string|array<string> $drname) Return ChildExportRcpaSummary objects filtered by the drname column
 * @method     ChildExportRcpaSummary[]|Collection findByRetailercode(string|array<string> $retailercode) Return ChildExportRcpaSummary objects filtered by the retailercode column
 * @psalm-method Collection&\Traversable<ChildExportRcpaSummary> findByRetailercode(string|array<string> $retailercode) Return ChildExportRcpaSummary objects filtered by the retailercode column
 * @method     ChildExportRcpaSummary[]|Collection findByRetailername(string|array<string> $retailername) Return ChildExportRcpaSummary objects filtered by the retailername column
 * @psalm-method Collection&\Traversable<ChildExportRcpaSummary> findByRetailername(string|array<string> $retailername) Return ChildExportRcpaSummary objects filtered by the retailername column
 * @method     ChildExportRcpaSummary[]|Collection findByOutletClassification(string|array<string> $outlet_classification) Return ChildExportRcpaSummary objects filtered by the outlet_classification column
 * @psalm-method Collection&\Traversable<ChildExportRcpaSummary> findByOutletClassification(string|array<string> $outlet_classification) Return ChildExportRcpaSummary objects filtered by the outlet_classification column
 * @method     ChildExportRcpaSummary[]|Collection findByVisitFq(int|array<int> $visit_fq) Return ChildExportRcpaSummary objects filtered by the visit_fq column
 * @psalm-method Collection&\Traversable<ChildExportRcpaSummary> findByVisitFq(int|array<int> $visit_fq) Return ChildExportRcpaSummary objects filtered by the visit_fq column
 * @method     ChildExportRcpaSummary[]|Collection findByTerritory(string|array<string> $territory) Return ChildExportRcpaSummary objects filtered by the territory column
 * @psalm-method Collection&\Traversable<ChildExportRcpaSummary> findByTerritory(string|array<string> $territory) Return ChildExportRcpaSummary objects filtered by the territory column
 * @method     ChildExportRcpaSummary[]|Collection findByTags(string|array<string> $tags) Return ChildExportRcpaSummary objects filtered by the tags column
 * @psalm-method Collection&\Traversable<ChildExportRcpaSummary> findByTags(string|array<string> $tags) Return ChildExportRcpaSummary objects filtered by the tags column
 * @method     ChildExportRcpaSummary[]|Collection findByRcpaMoye(string|array<string> $rcpa_moye) Return ChildExportRcpaSummary objects filtered by the rcpa_moye column
 * @psalm-method Collection&\Traversable<ChildExportRcpaSummary> findByRcpaMoye(string|array<string> $rcpa_moye) Return ChildExportRcpaSummary objects filtered by the rcpa_moye column
 * @method     ChildExportRcpaSummary[]|Collection findByBrandName(string|array<string> $brand_name) Return ChildExportRcpaSummary objects filtered by the brand_name column
 * @psalm-method Collection&\Traversable<ChildExportRcpaSummary> findByBrandName(string|array<string> $brand_name) Return ChildExportRcpaSummary objects filtered by the brand_name column
 * @method     ChildExportRcpaSummary[]|Collection findByCompetitorName(string|array<string> $competitor_name) Return ChildExportRcpaSummary objects filtered by the competitor_name column
 * @psalm-method Collection&\Traversable<ChildExportRcpaSummary> findByCompetitorName(string|array<string> $competitor_name) Return ChildExportRcpaSummary objects filtered by the competitor_name column
 * @method     ChildExportRcpaSummary[]|Collection findByRcpaQty(string|array<string> $rcpa_qty) Return ChildExportRcpaSummary objects filtered by the rcpa_qty column
 * @psalm-method Collection&\Traversable<ChildExportRcpaSummary> findByRcpaQty(string|array<string> $rcpa_qty) Return ChildExportRcpaSummary objects filtered by the rcpa_qty column
 * @method     ChildExportRcpaSummary[]|Collection findByOwnRate(string|array<string> $own_rate) Return ChildExportRcpaSummary objects filtered by the own_rate column
 * @psalm-method Collection&\Traversable<ChildExportRcpaSummary> findByOwnRate(string|array<string> $own_rate) Return ChildExportRcpaSummary objects filtered by the own_rate column
 * @method     ChildExportRcpaSummary[]|Collection findByCompetitorRate(string|array<string> $competitor_rate) Return ChildExportRcpaSummary objects filtered by the competitor_rate column
 * @psalm-method Collection&\Traversable<ChildExportRcpaSummary> findByCompetitorRate(string|array<string> $competitor_rate) Return ChildExportRcpaSummary objects filtered by the competitor_rate column
 * @method     ChildExportRcpaSummary[]|Collection findByPotential(string|array<string> $potential) Return ChildExportRcpaSummary objects filtered by the potential column
 * @psalm-method Collection&\Traversable<ChildExportRcpaSummary> findByPotential(string|array<string> $potential) Return ChildExportRcpaSummary objects filtered by the potential column
 * @method     ChildExportRcpaSummary[]|Collection findByOwn(string|array<string> $own) Return ChildExportRcpaSummary objects filtered by the own column
 * @psalm-method Collection&\Traversable<ChildExportRcpaSummary> findByOwn(string|array<string> $own) Return ChildExportRcpaSummary objects filtered by the own column
 * @method     ChildExportRcpaSummary[]|Collection findByCompetition(string|array<string> $competition) Return ChildExportRcpaSummary objects filtered by the competition column
 * @psalm-method Collection&\Traversable<ChildExportRcpaSummary> findByCompetition(string|array<string> $competition) Return ChildExportRcpaSummary objects filtered by the competition column
 * @method     ChildExportRcpaSummary[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildExportRcpaSummary objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildExportRcpaSummary> findByCreatedAt(string|array<string> $created_at) Return ChildExportRcpaSummary objects filtered by the created_at column
 * @method     ChildExportRcpaSummary[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildExportRcpaSummary objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildExportRcpaSummary> findByUpdatedAt(string|array<string> $updated_at) Return ChildExportRcpaSummary objects filtered by the updated_at column
 * @method     ChildExportRcpaSummary[]|Collection findByMinValue(int|array<int> $min_value) Return ChildExportRcpaSummary objects filtered by the min_value column
 * @psalm-method Collection&\Traversable<ChildExportRcpaSummary> findByMinValue(int|array<int> $min_value) Return ChildExportRcpaSummary objects filtered by the min_value column
 * @method     ChildExportRcpaSummary[]|Collection findByEmpTerritory(string|array<string> $emp_territory) Return ChildExportRcpaSummary objects filtered by the emp_territory column
 * @psalm-method Collection&\Traversable<ChildExportRcpaSummary> findByEmpTerritory(string|array<string> $emp_territory) Return ChildExportRcpaSummary objects filtered by the emp_territory column
 * @method     ChildExportRcpaSummary[]|Collection findByEmpBranch(string|array<string> $emp_branch) Return ChildExportRcpaSummary objects filtered by the emp_branch column
 * @psalm-method Collection&\Traversable<ChildExportRcpaSummary> findByEmpBranch(string|array<string> $emp_branch) Return ChildExportRcpaSummary objects filtered by the emp_branch column
 * @method     ChildExportRcpaSummary[]|Collection findByEmpTown(string|array<string> $emp_town) Return ChildExportRcpaSummary objects filtered by the emp_town column
 * @psalm-method Collection&\Traversable<ChildExportRcpaSummary> findByEmpTown(string|array<string> $emp_town) Return ChildExportRcpaSummary objects filtered by the emp_town column
 *
 * @method     ChildExportRcpaSummary[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildExportRcpaSummary> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class ExportRcpaSummaryQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\ExportRcpaSummaryQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\ExportRcpaSummary', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildExportRcpaSummaryQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildExportRcpaSummaryQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildExportRcpaSummaryQuery) {
            return $criteria;
        }
        $query = new ChildExportRcpaSummaryQuery();
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
     * @return ChildExportRcpaSummary|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        throw new LogicException('The ExportRcpaSummary object has no primary key');
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
        throw new LogicException('The ExportRcpaSummary object has no primary key');
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
        throw new LogicException('The ExportRcpaSummary object has no primary key');
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
        throw new LogicException('The ExportRcpaSummary object has no primary key');
    }

    /**
     * Filter the query on the uniqueid column
     *
     * Example usage:
     * <code>
     * $query->filterByUniqueid('fooValue');   // WHERE uniqueid = 'fooValue'
     * $query->filterByUniqueid('%fooValue%', Criteria::LIKE); // WHERE uniqueid LIKE '%fooValue%'
     * $query->filterByUniqueid(['foo', 'bar']); // WHERE uniqueid IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $uniqueid The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUniqueid($uniqueid = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($uniqueid)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportRcpaSummaryTableMap::COL_UNIQUEID, $uniqueid, $comparison);

        return $this;
    }

    /**
     * Filter the query on the orgunitid column
     *
     * Example usage:
     * <code>
     * $query->filterByOrgunitid('fooValue');   // WHERE orgunitid = 'fooValue'
     * $query->filterByOrgunitid('%fooValue%', Criteria::LIKE); // WHERE orgunitid LIKE '%fooValue%'
     * $query->filterByOrgunitid(['foo', 'bar']); // WHERE orgunitid IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $orgunitid The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrgunitid($orgunitid = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($orgunitid)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportRcpaSummaryTableMap::COL_ORGUNITID, $orgunitid, $comparison);

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

        $this->addUsingAlias(ExportRcpaSummaryTableMap::COL_ZM_MANAGER_BRANCH, $zmManagerBranch, $comparison);

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

        $this->addUsingAlias(ExportRcpaSummaryTableMap::COL_ZM_MANAGER_TOWN, $zmManagerTown, $comparison);

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

        $this->addUsingAlias(ExportRcpaSummaryTableMap::COL_RM_MANAGER_BRANCH, $rmManagerBranch, $comparison);

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

        $this->addUsingAlias(ExportRcpaSummaryTableMap::COL_RM_MANAGER_TOWN, $rmManagerTown, $comparison);

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

        $this->addUsingAlias(ExportRcpaSummaryTableMap::COL_AM_MANAGER_BRANCH, $amManagerBranch, $comparison);

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

        $this->addUsingAlias(ExportRcpaSummaryTableMap::COL_AM_MANAGER_TOWN, $amManagerTown, $comparison);

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

        $this->addUsingAlias(ExportRcpaSummaryTableMap::COL_ZM_POSITION_CODE, $zmPositionCode, $comparison);

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

        $this->addUsingAlias(ExportRcpaSummaryTableMap::COL_RM_POSITION_CODE, $rmPositionCode, $comparison);

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

        $this->addUsingAlias(ExportRcpaSummaryTableMap::COL_AM_POSITION_CODE, $amPositionCode, $comparison);

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

        $this->addUsingAlias(ExportRcpaSummaryTableMap::COL_EMP_POSITION_CODE, $empPositionCode, $comparison);

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

        $this->addUsingAlias(ExportRcpaSummaryTableMap::COL_EMP_POSITION_NAME, $empPositionName, $comparison);

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

        $this->addUsingAlias(ExportRcpaSummaryTableMap::COL_EMP_LEVEL, $empLevel, $comparison);

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

        $this->addUsingAlias(ExportRcpaSummaryTableMap::COL_EMPLOYEE_CODE, $employeeCode, $comparison);

        return $this;
    }

    /**
     * Filter the query on the emp_name column
     *
     * Example usage:
     * <code>
     * $query->filterByEmpName('fooValue');   // WHERE emp_name = 'fooValue'
     * $query->filterByEmpName('%fooValue%', Criteria::LIKE); // WHERE emp_name LIKE '%fooValue%'
     * $query->filterByEmpName(['foo', 'bar']); // WHERE emp_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $empName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmpName($empName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($empName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportRcpaSummaryTableMap::COL_EMP_NAME, $empName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the drcode column
     *
     * Example usage:
     * <code>
     * $query->filterByDrcode('fooValue');   // WHERE drcode = 'fooValue'
     * $query->filterByDrcode('%fooValue%', Criteria::LIKE); // WHERE drcode LIKE '%fooValue%'
     * $query->filterByDrcode(['foo', 'bar']); // WHERE drcode IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $drcode The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDrcode($drcode = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($drcode)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportRcpaSummaryTableMap::COL_DRCODE, $drcode, $comparison);

        return $this;
    }

    /**
     * Filter the query on the drname column
     *
     * Example usage:
     * <code>
     * $query->filterByDrname('fooValue');   // WHERE drname = 'fooValue'
     * $query->filterByDrname('%fooValue%', Criteria::LIKE); // WHERE drname LIKE '%fooValue%'
     * $query->filterByDrname(['foo', 'bar']); // WHERE drname IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $drname The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDrname($drname = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($drname)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportRcpaSummaryTableMap::COL_DRNAME, $drname, $comparison);

        return $this;
    }

    /**
     * Filter the query on the retailercode column
     *
     * Example usage:
     * <code>
     * $query->filterByRetailercode('fooValue');   // WHERE retailercode = 'fooValue'
     * $query->filterByRetailercode('%fooValue%', Criteria::LIKE); // WHERE retailercode LIKE '%fooValue%'
     * $query->filterByRetailercode(['foo', 'bar']); // WHERE retailercode IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $retailercode The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRetailercode($retailercode = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($retailercode)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportRcpaSummaryTableMap::COL_RETAILERCODE, $retailercode, $comparison);

        return $this;
    }

    /**
     * Filter the query on the retailername column
     *
     * Example usage:
     * <code>
     * $query->filterByRetailername('fooValue');   // WHERE retailername = 'fooValue'
     * $query->filterByRetailername('%fooValue%', Criteria::LIKE); // WHERE retailername LIKE '%fooValue%'
     * $query->filterByRetailername(['foo', 'bar']); // WHERE retailername IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $retailername The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRetailername($retailername = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($retailername)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportRcpaSummaryTableMap::COL_RETAILERNAME, $retailername, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_classification column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletClassification('fooValue');   // WHERE outlet_classification = 'fooValue'
     * $query->filterByOutletClassification('%fooValue%', Criteria::LIKE); // WHERE outlet_classification LIKE '%fooValue%'
     * $query->filterByOutletClassification(['foo', 'bar']); // WHERE outlet_classification IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $outletClassification The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletClassification($outletClassification = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($outletClassification)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportRcpaSummaryTableMap::COL_OUTLET_CLASSIFICATION, $outletClassification, $comparison);

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
                $this->addUsingAlias(ExportRcpaSummaryTableMap::COL_VISIT_FQ, $visitFq['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($visitFq['max'])) {
                $this->addUsingAlias(ExportRcpaSummaryTableMap::COL_VISIT_FQ, $visitFq['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportRcpaSummaryTableMap::COL_VISIT_FQ, $visitFq, $comparison);

        return $this;
    }

    /**
     * Filter the query on the territory column
     *
     * Example usage:
     * <code>
     * $query->filterByTerritory('fooValue');   // WHERE territory = 'fooValue'
     * $query->filterByTerritory('%fooValue%', Criteria::LIKE); // WHERE territory LIKE '%fooValue%'
     * $query->filterByTerritory(['foo', 'bar']); // WHERE territory IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $territory The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTerritory($territory = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($territory)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportRcpaSummaryTableMap::COL_TERRITORY, $territory, $comparison);

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

        $this->addUsingAlias(ExportRcpaSummaryTableMap::COL_TAGS, $tags, $comparison);

        return $this;
    }

    /**
     * Filter the query on the rcpa_moye column
     *
     * Example usage:
     * <code>
     * $query->filterByRcpaMoye('fooValue');   // WHERE rcpa_moye = 'fooValue'
     * $query->filterByRcpaMoye('%fooValue%', Criteria::LIKE); // WHERE rcpa_moye LIKE '%fooValue%'
     * $query->filterByRcpaMoye(['foo', 'bar']); // WHERE rcpa_moye IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $rcpaMoye The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRcpaMoye($rcpaMoye = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($rcpaMoye)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportRcpaSummaryTableMap::COL_RCPA_MOYE, $rcpaMoye, $comparison);

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

        $this->addUsingAlias(ExportRcpaSummaryTableMap::COL_BRAND_NAME, $brandName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the competitor_name column
     *
     * Example usage:
     * <code>
     * $query->filterByCompetitorName('fooValue');   // WHERE competitor_name = 'fooValue'
     * $query->filterByCompetitorName('%fooValue%', Criteria::LIKE); // WHERE competitor_name LIKE '%fooValue%'
     * $query->filterByCompetitorName(['foo', 'bar']); // WHERE competitor_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $competitorName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCompetitorName($competitorName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($competitorName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportRcpaSummaryTableMap::COL_COMPETITOR_NAME, $competitorName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the rcpa_qty column
     *
     * Example usage:
     * <code>
     * $query->filterByRcpaQty(1234); // WHERE rcpa_qty = 1234
     * $query->filterByRcpaQty(array(12, 34)); // WHERE rcpa_qty IN (12, 34)
     * $query->filterByRcpaQty(array('min' => 12)); // WHERE rcpa_qty > 12
     * </code>
     *
     * @param mixed $rcpaQty The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRcpaQty($rcpaQty = null, ?string $comparison = null)
    {
        if (is_array($rcpaQty)) {
            $useMinMax = false;
            if (isset($rcpaQty['min'])) {
                $this->addUsingAlias(ExportRcpaSummaryTableMap::COL_RCPA_QTY, $rcpaQty['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($rcpaQty['max'])) {
                $this->addUsingAlias(ExportRcpaSummaryTableMap::COL_RCPA_QTY, $rcpaQty['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportRcpaSummaryTableMap::COL_RCPA_QTY, $rcpaQty, $comparison);

        return $this;
    }

    /**
     * Filter the query on the own_rate column
     *
     * Example usage:
     * <code>
     * $query->filterByOwnRate(1234); // WHERE own_rate = 1234
     * $query->filterByOwnRate(array(12, 34)); // WHERE own_rate IN (12, 34)
     * $query->filterByOwnRate(array('min' => 12)); // WHERE own_rate > 12
     * </code>
     *
     * @param mixed $ownRate The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOwnRate($ownRate = null, ?string $comparison = null)
    {
        if (is_array($ownRate)) {
            $useMinMax = false;
            if (isset($ownRate['min'])) {
                $this->addUsingAlias(ExportRcpaSummaryTableMap::COL_OWN_RATE, $ownRate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($ownRate['max'])) {
                $this->addUsingAlias(ExportRcpaSummaryTableMap::COL_OWN_RATE, $ownRate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportRcpaSummaryTableMap::COL_OWN_RATE, $ownRate, $comparison);

        return $this;
    }

    /**
     * Filter the query on the competitor_rate column
     *
     * Example usage:
     * <code>
     * $query->filterByCompetitorRate(1234); // WHERE competitor_rate = 1234
     * $query->filterByCompetitorRate(array(12, 34)); // WHERE competitor_rate IN (12, 34)
     * $query->filterByCompetitorRate(array('min' => 12)); // WHERE competitor_rate > 12
     * </code>
     *
     * @param mixed $competitorRate The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCompetitorRate($competitorRate = null, ?string $comparison = null)
    {
        if (is_array($competitorRate)) {
            $useMinMax = false;
            if (isset($competitorRate['min'])) {
                $this->addUsingAlias(ExportRcpaSummaryTableMap::COL_COMPETITOR_RATE, $competitorRate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($competitorRate['max'])) {
                $this->addUsingAlias(ExportRcpaSummaryTableMap::COL_COMPETITOR_RATE, $competitorRate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportRcpaSummaryTableMap::COL_COMPETITOR_RATE, $competitorRate, $comparison);

        return $this;
    }

    /**
     * Filter the query on the potential column
     *
     * Example usage:
     * <code>
     * $query->filterByPotential(1234); // WHERE potential = 1234
     * $query->filterByPotential(array(12, 34)); // WHERE potential IN (12, 34)
     * $query->filterByPotential(array('min' => 12)); // WHERE potential > 12
     * </code>
     *
     * @param mixed $potential The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPotential($potential = null, ?string $comparison = null)
    {
        if (is_array($potential)) {
            $useMinMax = false;
            if (isset($potential['min'])) {
                $this->addUsingAlias(ExportRcpaSummaryTableMap::COL_POTENTIAL, $potential['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($potential['max'])) {
                $this->addUsingAlias(ExportRcpaSummaryTableMap::COL_POTENTIAL, $potential['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportRcpaSummaryTableMap::COL_POTENTIAL, $potential, $comparison);

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
                $this->addUsingAlias(ExportRcpaSummaryTableMap::COL_OWN, $own['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($own['max'])) {
                $this->addUsingAlias(ExportRcpaSummaryTableMap::COL_OWN, $own['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportRcpaSummaryTableMap::COL_OWN, $own, $comparison);

        return $this;
    }

    /**
     * Filter the query on the competition column
     *
     * Example usage:
     * <code>
     * $query->filterByCompetition(1234); // WHERE competition = 1234
     * $query->filterByCompetition(array(12, 34)); // WHERE competition IN (12, 34)
     * $query->filterByCompetition(array('min' => 12)); // WHERE competition > 12
     * </code>
     *
     * @param mixed $competition The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCompetition($competition = null, ?string $comparison = null)
    {
        if (is_array($competition)) {
            $useMinMax = false;
            if (isset($competition['min'])) {
                $this->addUsingAlias(ExportRcpaSummaryTableMap::COL_COMPETITION, $competition['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($competition['max'])) {
                $this->addUsingAlias(ExportRcpaSummaryTableMap::COL_COMPETITION, $competition['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportRcpaSummaryTableMap::COL_COMPETITION, $competition, $comparison);

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
                $this->addUsingAlias(ExportRcpaSummaryTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(ExportRcpaSummaryTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportRcpaSummaryTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(ExportRcpaSummaryTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(ExportRcpaSummaryTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportRcpaSummaryTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

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
                $this->addUsingAlias(ExportRcpaSummaryTableMap::COL_MIN_VALUE, $minValue['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($minValue['max'])) {
                $this->addUsingAlias(ExportRcpaSummaryTableMap::COL_MIN_VALUE, $minValue['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportRcpaSummaryTableMap::COL_MIN_VALUE, $minValue, $comparison);

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

        $this->addUsingAlias(ExportRcpaSummaryTableMap::COL_EMP_TERRITORY, $empTerritory, $comparison);

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

        $this->addUsingAlias(ExportRcpaSummaryTableMap::COL_EMP_BRANCH, $empBranch, $comparison);

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

        $this->addUsingAlias(ExportRcpaSummaryTableMap::COL_EMP_TOWN, $empTown, $comparison);

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildExportRcpaSummary $exportRcpaSummary Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($exportRcpaSummary = null)
    {
        if ($exportRcpaSummary) {
            throw new LogicException('ExportRcpaSummary object has no primary key');

        }

        return $this;
    }

}
