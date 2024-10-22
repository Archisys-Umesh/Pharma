<?php

namespace entities\Base;

use \Exception;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\LogicException;
use entities\ExportEdetailing as ChildExportEdetailing;
use entities\ExportEdetailingQuery as ChildExportEdetailingQuery;
use entities\Map\ExportEdetailingTableMap;

/**
 * Base class that represents a query for the `export_edetailing` table.
 *
 * @method     ChildExportEdetailingQuery orderByBuName($order = Criteria::ASC) Order by the bu_name column
 * @method     ChildExportEdetailingQuery orderByZmManagerBranch($order = Criteria::ASC) Order by the zm_manager_branch column
 * @method     ChildExportEdetailingQuery orderByZmManagerTown($order = Criteria::ASC) Order by the zm_manager_town column
 * @method     ChildExportEdetailingQuery orderByRmManagerBranch($order = Criteria::ASC) Order by the rm_manager_branch column
 * @method     ChildExportEdetailingQuery orderByRmManagerTown($order = Criteria::ASC) Order by the rm_manager_town column
 * @method     ChildExportEdetailingQuery orderByAmManagerBranch($order = Criteria::ASC) Order by the am_manager_branch column
 * @method     ChildExportEdetailingQuery orderByAmManagerTown($order = Criteria::ASC) Order by the am_manager_town column
 * @method     ChildExportEdetailingQuery orderByZmPositionCode($order = Criteria::ASC) Order by the zm_position_code column
 * @method     ChildExportEdetailingQuery orderByRmPositionCode($order = Criteria::ASC) Order by the rm_position_code column
 * @method     ChildExportEdetailingQuery orderByAmPositionCode($order = Criteria::ASC) Order by the am_position_code column
 * @method     ChildExportEdetailingQuery orderByEmpPositionCode($order = Criteria::ASC) Order by the emp_position_code column
 * @method     ChildExportEdetailingQuery orderByEmpPositionName($order = Criteria::ASC) Order by the emp_position_name column
 * @method     ChildExportEdetailingQuery orderByEmpLevel($order = Criteria::ASC) Order by the emp_level column
 * @method     ChildExportEdetailingQuery orderByEmployeeCode($order = Criteria::ASC) Order by the employee_code column
 * @method     ChildExportEdetailingQuery orderByEmployee($order = Criteria::ASC) Order by the employee column
 * @method     ChildExportEdetailingQuery orderByDeviceStartTime($order = Criteria::ASC) Order by the device_start_time column
 * @method     ChildExportEdetailingQuery orderByDeviceEndTime($order = Criteria::ASC) Order by the device_end_time column
 * @method     ChildExportEdetailingQuery orderByOutletType($order = Criteria::ASC) Order by the outlet_type column
 * @method     ChildExportEdetailingQuery orderByOutletCode($order = Criteria::ASC) Order by the outlet_code column
 * @method     ChildExportEdetailingQuery orderByOutletName($order = Criteria::ASC) Order by the outlet_name column
 * @method     ChildExportEdetailingQuery orderByOutletClassification($order = Criteria::ASC) Order by the outlet_classification column
 * @method     ChildExportEdetailingQuery orderByBrandName($order = Criteria::ASC) Order by the brand_name column
 * @method     ChildExportEdetailingQuery orderBySessionId($order = Criteria::ASC) Order by the session_id column
 * @method     ChildExportEdetailingQuery orderByBrandId($order = Criteria::ASC) Order by the brand_id column
 * @method     ChildExportEdetailingQuery orderByPresentationOrder($order = Criteria::ASC) Order by the presentation_order column
 * @method     ChildExportEdetailingQuery orderByPresentation($order = Criteria::ASC) Order by the presentation column
 * @method     ChildExportEdetailingQuery orderByPlaylist($order = Criteria::ASC) Order by the playlist column
 * @method     ChildExportEdetailingQuery orderByPageCount($order = Criteria::ASC) Order by the page_count column
 * @method     ChildExportEdetailingQuery orderByPresentationTime($order = Criteria::ASC) Order by the presentation_time column
 * @method     ChildExportEdetailingQuery orderByPageName($order = Criteria::ASC) Order by the page_name column
 * @method     ChildExportEdetailingQuery orderBySmiley($order = Criteria::ASC) Order by the smiley column
 * @method     ChildExportEdetailingQuery orderByEdDate($order = Criteria::ASC) Order by the ed_date column
 * @method     ChildExportEdetailingQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildExportEdetailingQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildExportEdetailingQuery orderByEmpTerritory($order = Criteria::ASC) Order by the emp_territory column
 * @method     ChildExportEdetailingQuery orderByEmpBranch($order = Criteria::ASC) Order by the emp_branch column
 * @method     ChildExportEdetailingQuery orderByEmpTown($order = Criteria::ASC) Order by the emp_town column
 *
 * @method     ChildExportEdetailingQuery groupByBuName() Group by the bu_name column
 * @method     ChildExportEdetailingQuery groupByZmManagerBranch() Group by the zm_manager_branch column
 * @method     ChildExportEdetailingQuery groupByZmManagerTown() Group by the zm_manager_town column
 * @method     ChildExportEdetailingQuery groupByRmManagerBranch() Group by the rm_manager_branch column
 * @method     ChildExportEdetailingQuery groupByRmManagerTown() Group by the rm_manager_town column
 * @method     ChildExportEdetailingQuery groupByAmManagerBranch() Group by the am_manager_branch column
 * @method     ChildExportEdetailingQuery groupByAmManagerTown() Group by the am_manager_town column
 * @method     ChildExportEdetailingQuery groupByZmPositionCode() Group by the zm_position_code column
 * @method     ChildExportEdetailingQuery groupByRmPositionCode() Group by the rm_position_code column
 * @method     ChildExportEdetailingQuery groupByAmPositionCode() Group by the am_position_code column
 * @method     ChildExportEdetailingQuery groupByEmpPositionCode() Group by the emp_position_code column
 * @method     ChildExportEdetailingQuery groupByEmpPositionName() Group by the emp_position_name column
 * @method     ChildExportEdetailingQuery groupByEmpLevel() Group by the emp_level column
 * @method     ChildExportEdetailingQuery groupByEmployeeCode() Group by the employee_code column
 * @method     ChildExportEdetailingQuery groupByEmployee() Group by the employee column
 * @method     ChildExportEdetailingQuery groupByDeviceStartTime() Group by the device_start_time column
 * @method     ChildExportEdetailingQuery groupByDeviceEndTime() Group by the device_end_time column
 * @method     ChildExportEdetailingQuery groupByOutletType() Group by the outlet_type column
 * @method     ChildExportEdetailingQuery groupByOutletCode() Group by the outlet_code column
 * @method     ChildExportEdetailingQuery groupByOutletName() Group by the outlet_name column
 * @method     ChildExportEdetailingQuery groupByOutletClassification() Group by the outlet_classification column
 * @method     ChildExportEdetailingQuery groupByBrandName() Group by the brand_name column
 * @method     ChildExportEdetailingQuery groupBySessionId() Group by the session_id column
 * @method     ChildExportEdetailingQuery groupByBrandId() Group by the brand_id column
 * @method     ChildExportEdetailingQuery groupByPresentationOrder() Group by the presentation_order column
 * @method     ChildExportEdetailingQuery groupByPresentation() Group by the presentation column
 * @method     ChildExportEdetailingQuery groupByPlaylist() Group by the playlist column
 * @method     ChildExportEdetailingQuery groupByPageCount() Group by the page_count column
 * @method     ChildExportEdetailingQuery groupByPresentationTime() Group by the presentation_time column
 * @method     ChildExportEdetailingQuery groupByPageName() Group by the page_name column
 * @method     ChildExportEdetailingQuery groupBySmiley() Group by the smiley column
 * @method     ChildExportEdetailingQuery groupByEdDate() Group by the ed_date column
 * @method     ChildExportEdetailingQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildExportEdetailingQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildExportEdetailingQuery groupByEmpTerritory() Group by the emp_territory column
 * @method     ChildExportEdetailingQuery groupByEmpBranch() Group by the emp_branch column
 * @method     ChildExportEdetailingQuery groupByEmpTown() Group by the emp_town column
 *
 * @method     ChildExportEdetailingQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildExportEdetailingQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildExportEdetailingQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildExportEdetailingQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildExportEdetailingQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildExportEdetailingQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildExportEdetailing|null findOne(?ConnectionInterface $con = null) Return the first ChildExportEdetailing matching the query
 * @method     ChildExportEdetailing findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildExportEdetailing matching the query, or a new ChildExportEdetailing object populated from the query conditions when no match is found
 *
 * @method     ChildExportEdetailing|null findOneByBuName(string $bu_name) Return the first ChildExportEdetailing filtered by the bu_name column
 * @method     ChildExportEdetailing|null findOneByZmManagerBranch(string $zm_manager_branch) Return the first ChildExportEdetailing filtered by the zm_manager_branch column
 * @method     ChildExportEdetailing|null findOneByZmManagerTown(string $zm_manager_town) Return the first ChildExportEdetailing filtered by the zm_manager_town column
 * @method     ChildExportEdetailing|null findOneByRmManagerBranch(string $rm_manager_branch) Return the first ChildExportEdetailing filtered by the rm_manager_branch column
 * @method     ChildExportEdetailing|null findOneByRmManagerTown(string $rm_manager_town) Return the first ChildExportEdetailing filtered by the rm_manager_town column
 * @method     ChildExportEdetailing|null findOneByAmManagerBranch(string $am_manager_branch) Return the first ChildExportEdetailing filtered by the am_manager_branch column
 * @method     ChildExportEdetailing|null findOneByAmManagerTown(string $am_manager_town) Return the first ChildExportEdetailing filtered by the am_manager_town column
 * @method     ChildExportEdetailing|null findOneByZmPositionCode(string $zm_position_code) Return the first ChildExportEdetailing filtered by the zm_position_code column
 * @method     ChildExportEdetailing|null findOneByRmPositionCode(string $rm_position_code) Return the first ChildExportEdetailing filtered by the rm_position_code column
 * @method     ChildExportEdetailing|null findOneByAmPositionCode(string $am_position_code) Return the first ChildExportEdetailing filtered by the am_position_code column
 * @method     ChildExportEdetailing|null findOneByEmpPositionCode(string $emp_position_code) Return the first ChildExportEdetailing filtered by the emp_position_code column
 * @method     ChildExportEdetailing|null findOneByEmpPositionName(string $emp_position_name) Return the first ChildExportEdetailing filtered by the emp_position_name column
 * @method     ChildExportEdetailing|null findOneByEmpLevel(string $emp_level) Return the first ChildExportEdetailing filtered by the emp_level column
 * @method     ChildExportEdetailing|null findOneByEmployeeCode(string $employee_code) Return the first ChildExportEdetailing filtered by the employee_code column
 * @method     ChildExportEdetailing|null findOneByEmployee(string $employee) Return the first ChildExportEdetailing filtered by the employee column
 * @method     ChildExportEdetailing|null findOneByDeviceStartTime(string $device_start_time) Return the first ChildExportEdetailing filtered by the device_start_time column
 * @method     ChildExportEdetailing|null findOneByDeviceEndTime(string $device_end_time) Return the first ChildExportEdetailing filtered by the device_end_time column
 * @method     ChildExportEdetailing|null findOneByOutletType(string $outlet_type) Return the first ChildExportEdetailing filtered by the outlet_type column
 * @method     ChildExportEdetailing|null findOneByOutletCode(string $outlet_code) Return the first ChildExportEdetailing filtered by the outlet_code column
 * @method     ChildExportEdetailing|null findOneByOutletName(string $outlet_name) Return the first ChildExportEdetailing filtered by the outlet_name column
 * @method     ChildExportEdetailing|null findOneByOutletClassification(string $outlet_classification) Return the first ChildExportEdetailing filtered by the outlet_classification column
 * @method     ChildExportEdetailing|null findOneByBrandName(string $brand_name) Return the first ChildExportEdetailing filtered by the brand_name column
 * @method     ChildExportEdetailing|null findOneBySessionId(string $session_id) Return the first ChildExportEdetailing filtered by the session_id column
 * @method     ChildExportEdetailing|null findOneByBrandId(int $brand_id) Return the first ChildExportEdetailing filtered by the brand_id column
 * @method     ChildExportEdetailing|null findOneByPresentationOrder(int $presentation_order) Return the first ChildExportEdetailing filtered by the presentation_order column
 * @method     ChildExportEdetailing|null findOneByPresentation(string $presentation) Return the first ChildExportEdetailing filtered by the presentation column
 * @method     ChildExportEdetailing|null findOneByPlaylist(string $playlist) Return the first ChildExportEdetailing filtered by the playlist column
 * @method     ChildExportEdetailing|null findOneByPageCount(string $page_count) Return the first ChildExportEdetailing filtered by the page_count column
 * @method     ChildExportEdetailing|null findOneByPresentationTime(int $presentation_time) Return the first ChildExportEdetailing filtered by the presentation_time column
 * @method     ChildExportEdetailing|null findOneByPageName(string $page_name) Return the first ChildExportEdetailing filtered by the page_name column
 * @method     ChildExportEdetailing|null findOneBySmiley(string $smiley) Return the first ChildExportEdetailing filtered by the smiley column
 * @method     ChildExportEdetailing|null findOneByEdDate(string $ed_date) Return the first ChildExportEdetailing filtered by the ed_date column
 * @method     ChildExportEdetailing|null findOneByCreatedAt(string $created_at) Return the first ChildExportEdetailing filtered by the created_at column
 * @method     ChildExportEdetailing|null findOneByUpdatedAt(string $updated_at) Return the first ChildExportEdetailing filtered by the updated_at column
 * @method     ChildExportEdetailing|null findOneByEmpTerritory(string $emp_territory) Return the first ChildExportEdetailing filtered by the emp_territory column
 * @method     ChildExportEdetailing|null findOneByEmpBranch(string $emp_branch) Return the first ChildExportEdetailing filtered by the emp_branch column
 * @method     ChildExportEdetailing|null findOneByEmpTown(string $emp_town) Return the first ChildExportEdetailing filtered by the emp_town column
 *
 * @method     ChildExportEdetailing requirePk($key, ?ConnectionInterface $con = null) Return the ChildExportEdetailing by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportEdetailing requireOne(?ConnectionInterface $con = null) Return the first ChildExportEdetailing matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildExportEdetailing requireOneByBuName(string $bu_name) Return the first ChildExportEdetailing filtered by the bu_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportEdetailing requireOneByZmManagerBranch(string $zm_manager_branch) Return the first ChildExportEdetailing filtered by the zm_manager_branch column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportEdetailing requireOneByZmManagerTown(string $zm_manager_town) Return the first ChildExportEdetailing filtered by the zm_manager_town column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportEdetailing requireOneByRmManagerBranch(string $rm_manager_branch) Return the first ChildExportEdetailing filtered by the rm_manager_branch column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportEdetailing requireOneByRmManagerTown(string $rm_manager_town) Return the first ChildExportEdetailing filtered by the rm_manager_town column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportEdetailing requireOneByAmManagerBranch(string $am_manager_branch) Return the first ChildExportEdetailing filtered by the am_manager_branch column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportEdetailing requireOneByAmManagerTown(string $am_manager_town) Return the first ChildExportEdetailing filtered by the am_manager_town column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportEdetailing requireOneByZmPositionCode(string $zm_position_code) Return the first ChildExportEdetailing filtered by the zm_position_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportEdetailing requireOneByRmPositionCode(string $rm_position_code) Return the first ChildExportEdetailing filtered by the rm_position_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportEdetailing requireOneByAmPositionCode(string $am_position_code) Return the first ChildExportEdetailing filtered by the am_position_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportEdetailing requireOneByEmpPositionCode(string $emp_position_code) Return the first ChildExportEdetailing filtered by the emp_position_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportEdetailing requireOneByEmpPositionName(string $emp_position_name) Return the first ChildExportEdetailing filtered by the emp_position_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportEdetailing requireOneByEmpLevel(string $emp_level) Return the first ChildExportEdetailing filtered by the emp_level column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportEdetailing requireOneByEmployeeCode(string $employee_code) Return the first ChildExportEdetailing filtered by the employee_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportEdetailing requireOneByEmployee(string $employee) Return the first ChildExportEdetailing filtered by the employee column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportEdetailing requireOneByDeviceStartTime(string $device_start_time) Return the first ChildExportEdetailing filtered by the device_start_time column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportEdetailing requireOneByDeviceEndTime(string $device_end_time) Return the first ChildExportEdetailing filtered by the device_end_time column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportEdetailing requireOneByOutletType(string $outlet_type) Return the first ChildExportEdetailing filtered by the outlet_type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportEdetailing requireOneByOutletCode(string $outlet_code) Return the first ChildExportEdetailing filtered by the outlet_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportEdetailing requireOneByOutletName(string $outlet_name) Return the first ChildExportEdetailing filtered by the outlet_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportEdetailing requireOneByOutletClassification(string $outlet_classification) Return the first ChildExportEdetailing filtered by the outlet_classification column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportEdetailing requireOneByBrandName(string $brand_name) Return the first ChildExportEdetailing filtered by the brand_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportEdetailing requireOneBySessionId(string $session_id) Return the first ChildExportEdetailing filtered by the session_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportEdetailing requireOneByBrandId(int $brand_id) Return the first ChildExportEdetailing filtered by the brand_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportEdetailing requireOneByPresentationOrder(int $presentation_order) Return the first ChildExportEdetailing filtered by the presentation_order column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportEdetailing requireOneByPresentation(string $presentation) Return the first ChildExportEdetailing filtered by the presentation column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportEdetailing requireOneByPlaylist(string $playlist) Return the first ChildExportEdetailing filtered by the playlist column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportEdetailing requireOneByPageCount(string $page_count) Return the first ChildExportEdetailing filtered by the page_count column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportEdetailing requireOneByPresentationTime(int $presentation_time) Return the first ChildExportEdetailing filtered by the presentation_time column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportEdetailing requireOneByPageName(string $page_name) Return the first ChildExportEdetailing filtered by the page_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportEdetailing requireOneBySmiley(string $smiley) Return the first ChildExportEdetailing filtered by the smiley column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportEdetailing requireOneByEdDate(string $ed_date) Return the first ChildExportEdetailing filtered by the ed_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportEdetailing requireOneByCreatedAt(string $created_at) Return the first ChildExportEdetailing filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportEdetailing requireOneByUpdatedAt(string $updated_at) Return the first ChildExportEdetailing filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportEdetailing requireOneByEmpTerritory(string $emp_territory) Return the first ChildExportEdetailing filtered by the emp_territory column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportEdetailing requireOneByEmpBranch(string $emp_branch) Return the first ChildExportEdetailing filtered by the emp_branch column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportEdetailing requireOneByEmpTown(string $emp_town) Return the first ChildExportEdetailing filtered by the emp_town column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildExportEdetailing[]|Collection find(?ConnectionInterface $con = null) Return ChildExportEdetailing objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildExportEdetailing> find(?ConnectionInterface $con = null) Return ChildExportEdetailing objects based on current ModelCriteria
 *
 * @method     ChildExportEdetailing[]|Collection findByBuName(string|array<string> $bu_name) Return ChildExportEdetailing objects filtered by the bu_name column
 * @psalm-method Collection&\Traversable<ChildExportEdetailing> findByBuName(string|array<string> $bu_name) Return ChildExportEdetailing objects filtered by the bu_name column
 * @method     ChildExportEdetailing[]|Collection findByZmManagerBranch(string|array<string> $zm_manager_branch) Return ChildExportEdetailing objects filtered by the zm_manager_branch column
 * @psalm-method Collection&\Traversable<ChildExportEdetailing> findByZmManagerBranch(string|array<string> $zm_manager_branch) Return ChildExportEdetailing objects filtered by the zm_manager_branch column
 * @method     ChildExportEdetailing[]|Collection findByZmManagerTown(string|array<string> $zm_manager_town) Return ChildExportEdetailing objects filtered by the zm_manager_town column
 * @psalm-method Collection&\Traversable<ChildExportEdetailing> findByZmManagerTown(string|array<string> $zm_manager_town) Return ChildExportEdetailing objects filtered by the zm_manager_town column
 * @method     ChildExportEdetailing[]|Collection findByRmManagerBranch(string|array<string> $rm_manager_branch) Return ChildExportEdetailing objects filtered by the rm_manager_branch column
 * @psalm-method Collection&\Traversable<ChildExportEdetailing> findByRmManagerBranch(string|array<string> $rm_manager_branch) Return ChildExportEdetailing objects filtered by the rm_manager_branch column
 * @method     ChildExportEdetailing[]|Collection findByRmManagerTown(string|array<string> $rm_manager_town) Return ChildExportEdetailing objects filtered by the rm_manager_town column
 * @psalm-method Collection&\Traversable<ChildExportEdetailing> findByRmManagerTown(string|array<string> $rm_manager_town) Return ChildExportEdetailing objects filtered by the rm_manager_town column
 * @method     ChildExportEdetailing[]|Collection findByAmManagerBranch(string|array<string> $am_manager_branch) Return ChildExportEdetailing objects filtered by the am_manager_branch column
 * @psalm-method Collection&\Traversable<ChildExportEdetailing> findByAmManagerBranch(string|array<string> $am_manager_branch) Return ChildExportEdetailing objects filtered by the am_manager_branch column
 * @method     ChildExportEdetailing[]|Collection findByAmManagerTown(string|array<string> $am_manager_town) Return ChildExportEdetailing objects filtered by the am_manager_town column
 * @psalm-method Collection&\Traversable<ChildExportEdetailing> findByAmManagerTown(string|array<string> $am_manager_town) Return ChildExportEdetailing objects filtered by the am_manager_town column
 * @method     ChildExportEdetailing[]|Collection findByZmPositionCode(string|array<string> $zm_position_code) Return ChildExportEdetailing objects filtered by the zm_position_code column
 * @psalm-method Collection&\Traversable<ChildExportEdetailing> findByZmPositionCode(string|array<string> $zm_position_code) Return ChildExportEdetailing objects filtered by the zm_position_code column
 * @method     ChildExportEdetailing[]|Collection findByRmPositionCode(string|array<string> $rm_position_code) Return ChildExportEdetailing objects filtered by the rm_position_code column
 * @psalm-method Collection&\Traversable<ChildExportEdetailing> findByRmPositionCode(string|array<string> $rm_position_code) Return ChildExportEdetailing objects filtered by the rm_position_code column
 * @method     ChildExportEdetailing[]|Collection findByAmPositionCode(string|array<string> $am_position_code) Return ChildExportEdetailing objects filtered by the am_position_code column
 * @psalm-method Collection&\Traversable<ChildExportEdetailing> findByAmPositionCode(string|array<string> $am_position_code) Return ChildExportEdetailing objects filtered by the am_position_code column
 * @method     ChildExportEdetailing[]|Collection findByEmpPositionCode(string|array<string> $emp_position_code) Return ChildExportEdetailing objects filtered by the emp_position_code column
 * @psalm-method Collection&\Traversable<ChildExportEdetailing> findByEmpPositionCode(string|array<string> $emp_position_code) Return ChildExportEdetailing objects filtered by the emp_position_code column
 * @method     ChildExportEdetailing[]|Collection findByEmpPositionName(string|array<string> $emp_position_name) Return ChildExportEdetailing objects filtered by the emp_position_name column
 * @psalm-method Collection&\Traversable<ChildExportEdetailing> findByEmpPositionName(string|array<string> $emp_position_name) Return ChildExportEdetailing objects filtered by the emp_position_name column
 * @method     ChildExportEdetailing[]|Collection findByEmpLevel(string|array<string> $emp_level) Return ChildExportEdetailing objects filtered by the emp_level column
 * @psalm-method Collection&\Traversable<ChildExportEdetailing> findByEmpLevel(string|array<string> $emp_level) Return ChildExportEdetailing objects filtered by the emp_level column
 * @method     ChildExportEdetailing[]|Collection findByEmployeeCode(string|array<string> $employee_code) Return ChildExportEdetailing objects filtered by the employee_code column
 * @psalm-method Collection&\Traversable<ChildExportEdetailing> findByEmployeeCode(string|array<string> $employee_code) Return ChildExportEdetailing objects filtered by the employee_code column
 * @method     ChildExportEdetailing[]|Collection findByEmployee(string|array<string> $employee) Return ChildExportEdetailing objects filtered by the employee column
 * @psalm-method Collection&\Traversable<ChildExportEdetailing> findByEmployee(string|array<string> $employee) Return ChildExportEdetailing objects filtered by the employee column
 * @method     ChildExportEdetailing[]|Collection findByDeviceStartTime(string|array<string> $device_start_time) Return ChildExportEdetailing objects filtered by the device_start_time column
 * @psalm-method Collection&\Traversable<ChildExportEdetailing> findByDeviceStartTime(string|array<string> $device_start_time) Return ChildExportEdetailing objects filtered by the device_start_time column
 * @method     ChildExportEdetailing[]|Collection findByDeviceEndTime(string|array<string> $device_end_time) Return ChildExportEdetailing objects filtered by the device_end_time column
 * @psalm-method Collection&\Traversable<ChildExportEdetailing> findByDeviceEndTime(string|array<string> $device_end_time) Return ChildExportEdetailing objects filtered by the device_end_time column
 * @method     ChildExportEdetailing[]|Collection findByOutletType(string|array<string> $outlet_type) Return ChildExportEdetailing objects filtered by the outlet_type column
 * @psalm-method Collection&\Traversable<ChildExportEdetailing> findByOutletType(string|array<string> $outlet_type) Return ChildExportEdetailing objects filtered by the outlet_type column
 * @method     ChildExportEdetailing[]|Collection findByOutletCode(string|array<string> $outlet_code) Return ChildExportEdetailing objects filtered by the outlet_code column
 * @psalm-method Collection&\Traversable<ChildExportEdetailing> findByOutletCode(string|array<string> $outlet_code) Return ChildExportEdetailing objects filtered by the outlet_code column
 * @method     ChildExportEdetailing[]|Collection findByOutletName(string|array<string> $outlet_name) Return ChildExportEdetailing objects filtered by the outlet_name column
 * @psalm-method Collection&\Traversable<ChildExportEdetailing> findByOutletName(string|array<string> $outlet_name) Return ChildExportEdetailing objects filtered by the outlet_name column
 * @method     ChildExportEdetailing[]|Collection findByOutletClassification(string|array<string> $outlet_classification) Return ChildExportEdetailing objects filtered by the outlet_classification column
 * @psalm-method Collection&\Traversable<ChildExportEdetailing> findByOutletClassification(string|array<string> $outlet_classification) Return ChildExportEdetailing objects filtered by the outlet_classification column
 * @method     ChildExportEdetailing[]|Collection findByBrandName(string|array<string> $brand_name) Return ChildExportEdetailing objects filtered by the brand_name column
 * @psalm-method Collection&\Traversable<ChildExportEdetailing> findByBrandName(string|array<string> $brand_name) Return ChildExportEdetailing objects filtered by the brand_name column
 * @method     ChildExportEdetailing[]|Collection findBySessionId(string|array<string> $session_id) Return ChildExportEdetailing objects filtered by the session_id column
 * @psalm-method Collection&\Traversable<ChildExportEdetailing> findBySessionId(string|array<string> $session_id) Return ChildExportEdetailing objects filtered by the session_id column
 * @method     ChildExportEdetailing[]|Collection findByBrandId(int|array<int> $brand_id) Return ChildExportEdetailing objects filtered by the brand_id column
 * @psalm-method Collection&\Traversable<ChildExportEdetailing> findByBrandId(int|array<int> $brand_id) Return ChildExportEdetailing objects filtered by the brand_id column
 * @method     ChildExportEdetailing[]|Collection findByPresentationOrder(int|array<int> $presentation_order) Return ChildExportEdetailing objects filtered by the presentation_order column
 * @psalm-method Collection&\Traversable<ChildExportEdetailing> findByPresentationOrder(int|array<int> $presentation_order) Return ChildExportEdetailing objects filtered by the presentation_order column
 * @method     ChildExportEdetailing[]|Collection findByPresentation(string|array<string> $presentation) Return ChildExportEdetailing objects filtered by the presentation column
 * @psalm-method Collection&\Traversable<ChildExportEdetailing> findByPresentation(string|array<string> $presentation) Return ChildExportEdetailing objects filtered by the presentation column
 * @method     ChildExportEdetailing[]|Collection findByPlaylist(string|array<string> $playlist) Return ChildExportEdetailing objects filtered by the playlist column
 * @psalm-method Collection&\Traversable<ChildExportEdetailing> findByPlaylist(string|array<string> $playlist) Return ChildExportEdetailing objects filtered by the playlist column
 * @method     ChildExportEdetailing[]|Collection findByPageCount(string|array<string> $page_count) Return ChildExportEdetailing objects filtered by the page_count column
 * @psalm-method Collection&\Traversable<ChildExportEdetailing> findByPageCount(string|array<string> $page_count) Return ChildExportEdetailing objects filtered by the page_count column
 * @method     ChildExportEdetailing[]|Collection findByPresentationTime(int|array<int> $presentation_time) Return ChildExportEdetailing objects filtered by the presentation_time column
 * @psalm-method Collection&\Traversable<ChildExportEdetailing> findByPresentationTime(int|array<int> $presentation_time) Return ChildExportEdetailing objects filtered by the presentation_time column
 * @method     ChildExportEdetailing[]|Collection findByPageName(string|array<string> $page_name) Return ChildExportEdetailing objects filtered by the page_name column
 * @psalm-method Collection&\Traversable<ChildExportEdetailing> findByPageName(string|array<string> $page_name) Return ChildExportEdetailing objects filtered by the page_name column
 * @method     ChildExportEdetailing[]|Collection findBySmiley(string|array<string> $smiley) Return ChildExportEdetailing objects filtered by the smiley column
 * @psalm-method Collection&\Traversable<ChildExportEdetailing> findBySmiley(string|array<string> $smiley) Return ChildExportEdetailing objects filtered by the smiley column
 * @method     ChildExportEdetailing[]|Collection findByEdDate(string|array<string> $ed_date) Return ChildExportEdetailing objects filtered by the ed_date column
 * @psalm-method Collection&\Traversable<ChildExportEdetailing> findByEdDate(string|array<string> $ed_date) Return ChildExportEdetailing objects filtered by the ed_date column
 * @method     ChildExportEdetailing[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildExportEdetailing objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildExportEdetailing> findByCreatedAt(string|array<string> $created_at) Return ChildExportEdetailing objects filtered by the created_at column
 * @method     ChildExportEdetailing[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildExportEdetailing objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildExportEdetailing> findByUpdatedAt(string|array<string> $updated_at) Return ChildExportEdetailing objects filtered by the updated_at column
 * @method     ChildExportEdetailing[]|Collection findByEmpTerritory(string|array<string> $emp_territory) Return ChildExportEdetailing objects filtered by the emp_territory column
 * @psalm-method Collection&\Traversable<ChildExportEdetailing> findByEmpTerritory(string|array<string> $emp_territory) Return ChildExportEdetailing objects filtered by the emp_territory column
 * @method     ChildExportEdetailing[]|Collection findByEmpBranch(string|array<string> $emp_branch) Return ChildExportEdetailing objects filtered by the emp_branch column
 * @psalm-method Collection&\Traversable<ChildExportEdetailing> findByEmpBranch(string|array<string> $emp_branch) Return ChildExportEdetailing objects filtered by the emp_branch column
 * @method     ChildExportEdetailing[]|Collection findByEmpTown(string|array<string> $emp_town) Return ChildExportEdetailing objects filtered by the emp_town column
 * @psalm-method Collection&\Traversable<ChildExportEdetailing> findByEmpTown(string|array<string> $emp_town) Return ChildExportEdetailing objects filtered by the emp_town column
 *
 * @method     ChildExportEdetailing[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildExportEdetailing> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class ExportEdetailingQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\ExportEdetailingQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\ExportEdetailing', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildExportEdetailingQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildExportEdetailingQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildExportEdetailingQuery) {
            return $criteria;
        }
        $query = new ChildExportEdetailingQuery();
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
     * @return ChildExportEdetailing|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        throw new LogicException('The ExportEdetailing object has no primary key');
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
        throw new LogicException('The ExportEdetailing object has no primary key');
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
        throw new LogicException('The ExportEdetailing object has no primary key');
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
        throw new LogicException('The ExportEdetailing object has no primary key');
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

        $this->addUsingAlias(ExportEdetailingTableMap::COL_BU_NAME, $buName, $comparison);

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

        $this->addUsingAlias(ExportEdetailingTableMap::COL_ZM_MANAGER_BRANCH, $zmManagerBranch, $comparison);

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

        $this->addUsingAlias(ExportEdetailingTableMap::COL_ZM_MANAGER_TOWN, $zmManagerTown, $comparison);

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

        $this->addUsingAlias(ExportEdetailingTableMap::COL_RM_MANAGER_BRANCH, $rmManagerBranch, $comparison);

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

        $this->addUsingAlias(ExportEdetailingTableMap::COL_RM_MANAGER_TOWN, $rmManagerTown, $comparison);

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

        $this->addUsingAlias(ExportEdetailingTableMap::COL_AM_MANAGER_BRANCH, $amManagerBranch, $comparison);

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

        $this->addUsingAlias(ExportEdetailingTableMap::COL_AM_MANAGER_TOWN, $amManagerTown, $comparison);

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

        $this->addUsingAlias(ExportEdetailingTableMap::COL_ZM_POSITION_CODE, $zmPositionCode, $comparison);

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

        $this->addUsingAlias(ExportEdetailingTableMap::COL_RM_POSITION_CODE, $rmPositionCode, $comparison);

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

        $this->addUsingAlias(ExportEdetailingTableMap::COL_AM_POSITION_CODE, $amPositionCode, $comparison);

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

        $this->addUsingAlias(ExportEdetailingTableMap::COL_EMP_POSITION_CODE, $empPositionCode, $comparison);

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

        $this->addUsingAlias(ExportEdetailingTableMap::COL_EMP_POSITION_NAME, $empPositionName, $comparison);

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

        $this->addUsingAlias(ExportEdetailingTableMap::COL_EMP_LEVEL, $empLevel, $comparison);

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

        $this->addUsingAlias(ExportEdetailingTableMap::COL_EMPLOYEE_CODE, $employeeCode, $comparison);

        return $this;
    }

    /**
     * Filter the query on the employee column
     *
     * Example usage:
     * <code>
     * $query->filterByEmployee('fooValue');   // WHERE employee = 'fooValue'
     * $query->filterByEmployee('%fooValue%', Criteria::LIKE); // WHERE employee LIKE '%fooValue%'
     * $query->filterByEmployee(['foo', 'bar']); // WHERE employee IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $employee The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmployee($employee = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($employee)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportEdetailingTableMap::COL_EMPLOYEE, $employee, $comparison);

        return $this;
    }

    /**
     * Filter the query on the device_start_time column
     *
     * Example usage:
     * <code>
     * $query->filterByDeviceStartTime('2011-03-14'); // WHERE device_start_time = '2011-03-14'
     * $query->filterByDeviceStartTime('now'); // WHERE device_start_time = '2011-03-14'
     * $query->filterByDeviceStartTime(array('max' => 'yesterday')); // WHERE device_start_time > '2011-03-13'
     * </code>
     *
     * @param mixed $deviceStartTime The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDeviceStartTime($deviceStartTime = null, ?string $comparison = null)
    {
        if (is_array($deviceStartTime)) {
            $useMinMax = false;
            if (isset($deviceStartTime['min'])) {
                $this->addUsingAlias(ExportEdetailingTableMap::COL_DEVICE_START_TIME, $deviceStartTime['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($deviceStartTime['max'])) {
                $this->addUsingAlias(ExportEdetailingTableMap::COL_DEVICE_START_TIME, $deviceStartTime['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportEdetailingTableMap::COL_DEVICE_START_TIME, $deviceStartTime, $comparison);

        return $this;
    }

    /**
     * Filter the query on the device_end_time column
     *
     * Example usage:
     * <code>
     * $query->filterByDeviceEndTime('2011-03-14'); // WHERE device_end_time = '2011-03-14'
     * $query->filterByDeviceEndTime('now'); // WHERE device_end_time = '2011-03-14'
     * $query->filterByDeviceEndTime(array('max' => 'yesterday')); // WHERE device_end_time > '2011-03-13'
     * </code>
     *
     * @param mixed $deviceEndTime The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDeviceEndTime($deviceEndTime = null, ?string $comparison = null)
    {
        if (is_array($deviceEndTime)) {
            $useMinMax = false;
            if (isset($deviceEndTime['min'])) {
                $this->addUsingAlias(ExportEdetailingTableMap::COL_DEVICE_END_TIME, $deviceEndTime['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($deviceEndTime['max'])) {
                $this->addUsingAlias(ExportEdetailingTableMap::COL_DEVICE_END_TIME, $deviceEndTime['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportEdetailingTableMap::COL_DEVICE_END_TIME, $deviceEndTime, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_type column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletType('fooValue');   // WHERE outlet_type = 'fooValue'
     * $query->filterByOutletType('%fooValue%', Criteria::LIKE); // WHERE outlet_type LIKE '%fooValue%'
     * $query->filterByOutletType(['foo', 'bar']); // WHERE outlet_type IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $outletType The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletType($outletType = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($outletType)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportEdetailingTableMap::COL_OUTLET_TYPE, $outletType, $comparison);

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

        $this->addUsingAlias(ExportEdetailingTableMap::COL_OUTLET_CODE, $outletCode, $comparison);

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

        $this->addUsingAlias(ExportEdetailingTableMap::COL_OUTLET_NAME, $outletName, $comparison);

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

        $this->addUsingAlias(ExportEdetailingTableMap::COL_OUTLET_CLASSIFICATION, $outletClassification, $comparison);

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

        $this->addUsingAlias(ExportEdetailingTableMap::COL_BRAND_NAME, $brandName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the session_id column
     *
     * Example usage:
     * <code>
     * $query->filterBySessionId('fooValue');   // WHERE session_id = 'fooValue'
     * $query->filterBySessionId('%fooValue%', Criteria::LIKE); // WHERE session_id LIKE '%fooValue%'
     * $query->filterBySessionId(['foo', 'bar']); // WHERE session_id IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $sessionId The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySessionId($sessionId = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($sessionId)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportEdetailingTableMap::COL_SESSION_ID, $sessionId, $comparison);

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
                $this->addUsingAlias(ExportEdetailingTableMap::COL_BRAND_ID, $brandId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($brandId['max'])) {
                $this->addUsingAlias(ExportEdetailingTableMap::COL_BRAND_ID, $brandId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportEdetailingTableMap::COL_BRAND_ID, $brandId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the presentation_order column
     *
     * Example usage:
     * <code>
     * $query->filterByPresentationOrder(1234); // WHERE presentation_order = 1234
     * $query->filterByPresentationOrder(array(12, 34)); // WHERE presentation_order IN (12, 34)
     * $query->filterByPresentationOrder(array('min' => 12)); // WHERE presentation_order > 12
     * </code>
     *
     * @param mixed $presentationOrder The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPresentationOrder($presentationOrder = null, ?string $comparison = null)
    {
        if (is_array($presentationOrder)) {
            $useMinMax = false;
            if (isset($presentationOrder['min'])) {
                $this->addUsingAlias(ExportEdetailingTableMap::COL_PRESENTATION_ORDER, $presentationOrder['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($presentationOrder['max'])) {
                $this->addUsingAlias(ExportEdetailingTableMap::COL_PRESENTATION_ORDER, $presentationOrder['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportEdetailingTableMap::COL_PRESENTATION_ORDER, $presentationOrder, $comparison);

        return $this;
    }

    /**
     * Filter the query on the presentation column
     *
     * Example usage:
     * <code>
     * $query->filterByPresentation('fooValue');   // WHERE presentation = 'fooValue'
     * $query->filterByPresentation('%fooValue%', Criteria::LIKE); // WHERE presentation LIKE '%fooValue%'
     * $query->filterByPresentation(['foo', 'bar']); // WHERE presentation IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $presentation The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPresentation($presentation = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($presentation)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportEdetailingTableMap::COL_PRESENTATION, $presentation, $comparison);

        return $this;
    }

    /**
     * Filter the query on the playlist column
     *
     * Example usage:
     * <code>
     * $query->filterByPlaylist('fooValue');   // WHERE playlist = 'fooValue'
     * $query->filterByPlaylist('%fooValue%', Criteria::LIKE); // WHERE playlist LIKE '%fooValue%'
     * $query->filterByPlaylist(['foo', 'bar']); // WHERE playlist IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $playlist The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPlaylist($playlist = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($playlist)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportEdetailingTableMap::COL_PLAYLIST, $playlist, $comparison);

        return $this;
    }

    /**
     * Filter the query on the page_count column
     *
     * Example usage:
     * <code>
     * $query->filterByPageCount('fooValue');   // WHERE page_count = 'fooValue'
     * $query->filterByPageCount('%fooValue%', Criteria::LIKE); // WHERE page_count LIKE '%fooValue%'
     * $query->filterByPageCount(['foo', 'bar']); // WHERE page_count IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $pageCount The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPageCount($pageCount = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($pageCount)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportEdetailingTableMap::COL_PAGE_COUNT, $pageCount, $comparison);

        return $this;
    }

    /**
     * Filter the query on the presentation_time column
     *
     * Example usage:
     * <code>
     * $query->filterByPresentationTime(1234); // WHERE presentation_time = 1234
     * $query->filterByPresentationTime(array(12, 34)); // WHERE presentation_time IN (12, 34)
     * $query->filterByPresentationTime(array('min' => 12)); // WHERE presentation_time > 12
     * </code>
     *
     * @param mixed $presentationTime The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPresentationTime($presentationTime = null, ?string $comparison = null)
    {
        if (is_array($presentationTime)) {
            $useMinMax = false;
            if (isset($presentationTime['min'])) {
                $this->addUsingAlias(ExportEdetailingTableMap::COL_PRESENTATION_TIME, $presentationTime['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($presentationTime['max'])) {
                $this->addUsingAlias(ExportEdetailingTableMap::COL_PRESENTATION_TIME, $presentationTime['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportEdetailingTableMap::COL_PRESENTATION_TIME, $presentationTime, $comparison);

        return $this;
    }

    /**
     * Filter the query on the page_name column
     *
     * Example usage:
     * <code>
     * $query->filterByPageName('fooValue');   // WHERE page_name = 'fooValue'
     * $query->filterByPageName('%fooValue%', Criteria::LIKE); // WHERE page_name LIKE '%fooValue%'
     * $query->filterByPageName(['foo', 'bar']); // WHERE page_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $pageName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPageName($pageName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($pageName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportEdetailingTableMap::COL_PAGE_NAME, $pageName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the smiley column
     *
     * Example usage:
     * <code>
     * $query->filterBySmiley('fooValue');   // WHERE smiley = 'fooValue'
     * $query->filterBySmiley('%fooValue%', Criteria::LIKE); // WHERE smiley LIKE '%fooValue%'
     * $query->filterBySmiley(['foo', 'bar']); // WHERE smiley IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $smiley The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySmiley($smiley = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($smiley)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportEdetailingTableMap::COL_SMILEY, $smiley, $comparison);

        return $this;
    }

    /**
     * Filter the query on the ed_date column
     *
     * Example usage:
     * <code>
     * $query->filterByEdDate('2011-03-14'); // WHERE ed_date = '2011-03-14'
     * $query->filterByEdDate('now'); // WHERE ed_date = '2011-03-14'
     * $query->filterByEdDate(array('max' => 'yesterday')); // WHERE ed_date > '2011-03-13'
     * </code>
     *
     * @param mixed $edDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEdDate($edDate = null, ?string $comparison = null)
    {
        if (is_array($edDate)) {
            $useMinMax = false;
            if (isset($edDate['min'])) {
                $this->addUsingAlias(ExportEdetailingTableMap::COL_ED_DATE, $edDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($edDate['max'])) {
                $this->addUsingAlias(ExportEdetailingTableMap::COL_ED_DATE, $edDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportEdetailingTableMap::COL_ED_DATE, $edDate, $comparison);

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
                $this->addUsingAlias(ExportEdetailingTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(ExportEdetailingTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportEdetailingTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(ExportEdetailingTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(ExportEdetailingTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportEdetailingTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

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

        $this->addUsingAlias(ExportEdetailingTableMap::COL_EMP_TERRITORY, $empTerritory, $comparison);

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

        $this->addUsingAlias(ExportEdetailingTableMap::COL_EMP_BRANCH, $empBranch, $comparison);

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

        $this->addUsingAlias(ExportEdetailingTableMap::COL_EMP_TOWN, $empTown, $comparison);

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildExportEdetailing $exportEdetailing Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($exportEdetailing = null)
    {
        if ($exportEdetailing) {
            throw new LogicException('ExportEdetailing object has no primary key');

        }

        return $this;
    }

}
