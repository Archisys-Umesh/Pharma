<?php

namespace entities\Base;

use \Exception;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\LogicException;
use entities\ExportPob as ChildExportPob;
use entities\ExportPobQuery as ChildExportPobQuery;
use entities\Map\ExportPobTableMap;

/**
 * Base class that represents a query for the `export_pob` table.
 *
 * @method     ChildExportPobQuery orderByBuName($order = Criteria::ASC) Order by the bu_name column
 * @method     ChildExportPobQuery orderByZmManagerBranch($order = Criteria::ASC) Order by the zm_manager_branch column
 * @method     ChildExportPobQuery orderByZmManagerTown($order = Criteria::ASC) Order by the zm_manager_town column
 * @method     ChildExportPobQuery orderByRmManagerBranch($order = Criteria::ASC) Order by the rm_manager_branch column
 * @method     ChildExportPobQuery orderByRmManagerTown($order = Criteria::ASC) Order by the rm_manager_town column
 * @method     ChildExportPobQuery orderByAmManagerBranch($order = Criteria::ASC) Order by the am_manager_branch column
 * @method     ChildExportPobQuery orderByAmManagerTown($order = Criteria::ASC) Order by the am_manager_town column
 * @method     ChildExportPobQuery orderByZmPositionCode($order = Criteria::ASC) Order by the zm_position_code column
 * @method     ChildExportPobQuery orderByRmPositionCode($order = Criteria::ASC) Order by the rm_position_code column
 * @method     ChildExportPobQuery orderByAmPositionCode($order = Criteria::ASC) Order by the am_position_code column
 * @method     ChildExportPobQuery orderByEmpPositionCode($order = Criteria::ASC) Order by the emp_position_code column
 * @method     ChildExportPobQuery orderByEmpPositionName($order = Criteria::ASC) Order by the emp_position_name column
 * @method     ChildExportPobQuery orderByEmpLevel($order = Criteria::ASC) Order by the emp_level column
 * @method     ChildExportPobQuery orderByEmployeeCode($order = Criteria::ASC) Order by the employee_code column
 * @method     ChildExportPobQuery orderByEmployee($order = Criteria::ASC) Order by the employee column
 * @method     ChildExportPobQuery orderByDesignation($order = Criteria::ASC) Order by the designation column
 * @method     ChildExportPobQuery orderByFromOutletType($order = Criteria::ASC) Order by the from_outlet_type column
 * @method     ChildExportPobQuery orderByFromOutletCode($order = Criteria::ASC) Order by the from_outlet_code column
 * @method     ChildExportPobQuery orderByFromOutletName($order = Criteria::ASC) Order by the from_outlet_name column
 * @method     ChildExportPobQuery orderByFromOutletClassification($order = Criteria::ASC) Order by the from_outlet_classification column
 * @method     ChildExportPobQuery orderByToOutletType($order = Criteria::ASC) Order by the to_outlet_type column
 * @method     ChildExportPobQuery orderByToOutletCode($order = Criteria::ASC) Order by the to_outlet_code column
 * @method     ChildExportPobQuery orderByToOutletName($order = Criteria::ASC) Order by the to_outlet_name column
 * @method     ChildExportPobQuery orderByToOutletClassification($order = Criteria::ASC) Order by the to_outlet_classification column
 * @method     ChildExportPobQuery orderByProductName($order = Criteria::ASC) Order by the product_name column
 * @method     ChildExportPobQuery orderByProductSku($order = Criteria::ASC) Order by the product_sku column
 * @method     ChildExportPobQuery orderByRate($order = Criteria::ASC) Order by the rate column
 * @method     ChildExportPobQuery orderByQty($order = Criteria::ASC) Order by the qty column
 * @method     ChildExportPobQuery orderByTotalAmt($order = Criteria::ASC) Order by the total_amt column
 * @method     ChildExportPobQuery orderByOrderDate($order = Criteria::ASC) Order by the order_date column
 * @method     ChildExportPobQuery orderByEmpTerritory($order = Criteria::ASC) Order by the emp_territory column
 * @method     ChildExportPobQuery orderByEmpBranch($order = Criteria::ASC) Order by the emp_branch column
 * @method     ChildExportPobQuery orderByEmpTown($order = Criteria::ASC) Order by the emp_town column
 *
 * @method     ChildExportPobQuery groupByBuName() Group by the bu_name column
 * @method     ChildExportPobQuery groupByZmManagerBranch() Group by the zm_manager_branch column
 * @method     ChildExportPobQuery groupByZmManagerTown() Group by the zm_manager_town column
 * @method     ChildExportPobQuery groupByRmManagerBranch() Group by the rm_manager_branch column
 * @method     ChildExportPobQuery groupByRmManagerTown() Group by the rm_manager_town column
 * @method     ChildExportPobQuery groupByAmManagerBranch() Group by the am_manager_branch column
 * @method     ChildExportPobQuery groupByAmManagerTown() Group by the am_manager_town column
 * @method     ChildExportPobQuery groupByZmPositionCode() Group by the zm_position_code column
 * @method     ChildExportPobQuery groupByRmPositionCode() Group by the rm_position_code column
 * @method     ChildExportPobQuery groupByAmPositionCode() Group by the am_position_code column
 * @method     ChildExportPobQuery groupByEmpPositionCode() Group by the emp_position_code column
 * @method     ChildExportPobQuery groupByEmpPositionName() Group by the emp_position_name column
 * @method     ChildExportPobQuery groupByEmpLevel() Group by the emp_level column
 * @method     ChildExportPobQuery groupByEmployeeCode() Group by the employee_code column
 * @method     ChildExportPobQuery groupByEmployee() Group by the employee column
 * @method     ChildExportPobQuery groupByDesignation() Group by the designation column
 * @method     ChildExportPobQuery groupByFromOutletType() Group by the from_outlet_type column
 * @method     ChildExportPobQuery groupByFromOutletCode() Group by the from_outlet_code column
 * @method     ChildExportPobQuery groupByFromOutletName() Group by the from_outlet_name column
 * @method     ChildExportPobQuery groupByFromOutletClassification() Group by the from_outlet_classification column
 * @method     ChildExportPobQuery groupByToOutletType() Group by the to_outlet_type column
 * @method     ChildExportPobQuery groupByToOutletCode() Group by the to_outlet_code column
 * @method     ChildExportPobQuery groupByToOutletName() Group by the to_outlet_name column
 * @method     ChildExportPobQuery groupByToOutletClassification() Group by the to_outlet_classification column
 * @method     ChildExportPobQuery groupByProductName() Group by the product_name column
 * @method     ChildExportPobQuery groupByProductSku() Group by the product_sku column
 * @method     ChildExportPobQuery groupByRate() Group by the rate column
 * @method     ChildExportPobQuery groupByQty() Group by the qty column
 * @method     ChildExportPobQuery groupByTotalAmt() Group by the total_amt column
 * @method     ChildExportPobQuery groupByOrderDate() Group by the order_date column
 * @method     ChildExportPobQuery groupByEmpTerritory() Group by the emp_territory column
 * @method     ChildExportPobQuery groupByEmpBranch() Group by the emp_branch column
 * @method     ChildExportPobQuery groupByEmpTown() Group by the emp_town column
 *
 * @method     ChildExportPobQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildExportPobQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildExportPobQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildExportPobQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildExportPobQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildExportPobQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildExportPob|null findOne(?ConnectionInterface $con = null) Return the first ChildExportPob matching the query
 * @method     ChildExportPob findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildExportPob matching the query, or a new ChildExportPob object populated from the query conditions when no match is found
 *
 * @method     ChildExportPob|null findOneByBuName(string $bu_name) Return the first ChildExportPob filtered by the bu_name column
 * @method     ChildExportPob|null findOneByZmManagerBranch(string $zm_manager_branch) Return the first ChildExportPob filtered by the zm_manager_branch column
 * @method     ChildExportPob|null findOneByZmManagerTown(string $zm_manager_town) Return the first ChildExportPob filtered by the zm_manager_town column
 * @method     ChildExportPob|null findOneByRmManagerBranch(string $rm_manager_branch) Return the first ChildExportPob filtered by the rm_manager_branch column
 * @method     ChildExportPob|null findOneByRmManagerTown(string $rm_manager_town) Return the first ChildExportPob filtered by the rm_manager_town column
 * @method     ChildExportPob|null findOneByAmManagerBranch(string $am_manager_branch) Return the first ChildExportPob filtered by the am_manager_branch column
 * @method     ChildExportPob|null findOneByAmManagerTown(string $am_manager_town) Return the first ChildExportPob filtered by the am_manager_town column
 * @method     ChildExportPob|null findOneByZmPositionCode(string $zm_position_code) Return the first ChildExportPob filtered by the zm_position_code column
 * @method     ChildExportPob|null findOneByRmPositionCode(string $rm_position_code) Return the first ChildExportPob filtered by the rm_position_code column
 * @method     ChildExportPob|null findOneByAmPositionCode(string $am_position_code) Return the first ChildExportPob filtered by the am_position_code column
 * @method     ChildExportPob|null findOneByEmpPositionCode(string $emp_position_code) Return the first ChildExportPob filtered by the emp_position_code column
 * @method     ChildExportPob|null findOneByEmpPositionName(string $emp_position_name) Return the first ChildExportPob filtered by the emp_position_name column
 * @method     ChildExportPob|null findOneByEmpLevel(string $emp_level) Return the first ChildExportPob filtered by the emp_level column
 * @method     ChildExportPob|null findOneByEmployeeCode(string $employee_code) Return the first ChildExportPob filtered by the employee_code column
 * @method     ChildExportPob|null findOneByEmployee(string $employee) Return the first ChildExportPob filtered by the employee column
 * @method     ChildExportPob|null findOneByDesignation(string $designation) Return the first ChildExportPob filtered by the designation column
 * @method     ChildExportPob|null findOneByFromOutletType(string $from_outlet_type) Return the first ChildExportPob filtered by the from_outlet_type column
 * @method     ChildExportPob|null findOneByFromOutletCode(string $from_outlet_code) Return the first ChildExportPob filtered by the from_outlet_code column
 * @method     ChildExportPob|null findOneByFromOutletName(string $from_outlet_name) Return the first ChildExportPob filtered by the from_outlet_name column
 * @method     ChildExportPob|null findOneByFromOutletClassification(string $from_outlet_classification) Return the first ChildExportPob filtered by the from_outlet_classification column
 * @method     ChildExportPob|null findOneByToOutletType(string $to_outlet_type) Return the first ChildExportPob filtered by the to_outlet_type column
 * @method     ChildExportPob|null findOneByToOutletCode(string $to_outlet_code) Return the first ChildExportPob filtered by the to_outlet_code column
 * @method     ChildExportPob|null findOneByToOutletName(string $to_outlet_name) Return the first ChildExportPob filtered by the to_outlet_name column
 * @method     ChildExportPob|null findOneByToOutletClassification(string $to_outlet_classification) Return the first ChildExportPob filtered by the to_outlet_classification column
 * @method     ChildExportPob|null findOneByProductName(string $product_name) Return the first ChildExportPob filtered by the product_name column
 * @method     ChildExportPob|null findOneByProductSku(string $product_sku) Return the first ChildExportPob filtered by the product_sku column
 * @method     ChildExportPob|null findOneByRate(string $rate) Return the first ChildExportPob filtered by the rate column
 * @method     ChildExportPob|null findOneByQty(int $qty) Return the first ChildExportPob filtered by the qty column
 * @method     ChildExportPob|null findOneByTotalAmt(string $total_amt) Return the first ChildExportPob filtered by the total_amt column
 * @method     ChildExportPob|null findOneByOrderDate(string $order_date) Return the first ChildExportPob filtered by the order_date column
 * @method     ChildExportPob|null findOneByEmpTerritory(string $emp_territory) Return the first ChildExportPob filtered by the emp_territory column
 * @method     ChildExportPob|null findOneByEmpBranch(string $emp_branch) Return the first ChildExportPob filtered by the emp_branch column
 * @method     ChildExportPob|null findOneByEmpTown(string $emp_town) Return the first ChildExportPob filtered by the emp_town column
 *
 * @method     ChildExportPob requirePk($key, ?ConnectionInterface $con = null) Return the ChildExportPob by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportPob requireOne(?ConnectionInterface $con = null) Return the first ChildExportPob matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildExportPob requireOneByBuName(string $bu_name) Return the first ChildExportPob filtered by the bu_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportPob requireOneByZmManagerBranch(string $zm_manager_branch) Return the first ChildExportPob filtered by the zm_manager_branch column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportPob requireOneByZmManagerTown(string $zm_manager_town) Return the first ChildExportPob filtered by the zm_manager_town column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportPob requireOneByRmManagerBranch(string $rm_manager_branch) Return the first ChildExportPob filtered by the rm_manager_branch column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportPob requireOneByRmManagerTown(string $rm_manager_town) Return the first ChildExportPob filtered by the rm_manager_town column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportPob requireOneByAmManagerBranch(string $am_manager_branch) Return the first ChildExportPob filtered by the am_manager_branch column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportPob requireOneByAmManagerTown(string $am_manager_town) Return the first ChildExportPob filtered by the am_manager_town column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportPob requireOneByZmPositionCode(string $zm_position_code) Return the first ChildExportPob filtered by the zm_position_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportPob requireOneByRmPositionCode(string $rm_position_code) Return the first ChildExportPob filtered by the rm_position_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportPob requireOneByAmPositionCode(string $am_position_code) Return the first ChildExportPob filtered by the am_position_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportPob requireOneByEmpPositionCode(string $emp_position_code) Return the first ChildExportPob filtered by the emp_position_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportPob requireOneByEmpPositionName(string $emp_position_name) Return the first ChildExportPob filtered by the emp_position_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportPob requireOneByEmpLevel(string $emp_level) Return the first ChildExportPob filtered by the emp_level column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportPob requireOneByEmployeeCode(string $employee_code) Return the first ChildExportPob filtered by the employee_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportPob requireOneByEmployee(string $employee) Return the first ChildExportPob filtered by the employee column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportPob requireOneByDesignation(string $designation) Return the first ChildExportPob filtered by the designation column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportPob requireOneByFromOutletType(string $from_outlet_type) Return the first ChildExportPob filtered by the from_outlet_type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportPob requireOneByFromOutletCode(string $from_outlet_code) Return the first ChildExportPob filtered by the from_outlet_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportPob requireOneByFromOutletName(string $from_outlet_name) Return the first ChildExportPob filtered by the from_outlet_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportPob requireOneByFromOutletClassification(string $from_outlet_classification) Return the first ChildExportPob filtered by the from_outlet_classification column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportPob requireOneByToOutletType(string $to_outlet_type) Return the first ChildExportPob filtered by the to_outlet_type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportPob requireOneByToOutletCode(string $to_outlet_code) Return the first ChildExportPob filtered by the to_outlet_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportPob requireOneByToOutletName(string $to_outlet_name) Return the first ChildExportPob filtered by the to_outlet_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportPob requireOneByToOutletClassification(string $to_outlet_classification) Return the first ChildExportPob filtered by the to_outlet_classification column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportPob requireOneByProductName(string $product_name) Return the first ChildExportPob filtered by the product_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportPob requireOneByProductSku(string $product_sku) Return the first ChildExportPob filtered by the product_sku column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportPob requireOneByRate(string $rate) Return the first ChildExportPob filtered by the rate column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportPob requireOneByQty(int $qty) Return the first ChildExportPob filtered by the qty column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportPob requireOneByTotalAmt(string $total_amt) Return the first ChildExportPob filtered by the total_amt column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportPob requireOneByOrderDate(string $order_date) Return the first ChildExportPob filtered by the order_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportPob requireOneByEmpTerritory(string $emp_territory) Return the first ChildExportPob filtered by the emp_territory column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportPob requireOneByEmpBranch(string $emp_branch) Return the first ChildExportPob filtered by the emp_branch column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportPob requireOneByEmpTown(string $emp_town) Return the first ChildExportPob filtered by the emp_town column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildExportPob[]|Collection find(?ConnectionInterface $con = null) Return ChildExportPob objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildExportPob> find(?ConnectionInterface $con = null) Return ChildExportPob objects based on current ModelCriteria
 *
 * @method     ChildExportPob[]|Collection findByBuName(string|array<string> $bu_name) Return ChildExportPob objects filtered by the bu_name column
 * @psalm-method Collection&\Traversable<ChildExportPob> findByBuName(string|array<string> $bu_name) Return ChildExportPob objects filtered by the bu_name column
 * @method     ChildExportPob[]|Collection findByZmManagerBranch(string|array<string> $zm_manager_branch) Return ChildExportPob objects filtered by the zm_manager_branch column
 * @psalm-method Collection&\Traversable<ChildExportPob> findByZmManagerBranch(string|array<string> $zm_manager_branch) Return ChildExportPob objects filtered by the zm_manager_branch column
 * @method     ChildExportPob[]|Collection findByZmManagerTown(string|array<string> $zm_manager_town) Return ChildExportPob objects filtered by the zm_manager_town column
 * @psalm-method Collection&\Traversable<ChildExportPob> findByZmManagerTown(string|array<string> $zm_manager_town) Return ChildExportPob objects filtered by the zm_manager_town column
 * @method     ChildExportPob[]|Collection findByRmManagerBranch(string|array<string> $rm_manager_branch) Return ChildExportPob objects filtered by the rm_manager_branch column
 * @psalm-method Collection&\Traversable<ChildExportPob> findByRmManagerBranch(string|array<string> $rm_manager_branch) Return ChildExportPob objects filtered by the rm_manager_branch column
 * @method     ChildExportPob[]|Collection findByRmManagerTown(string|array<string> $rm_manager_town) Return ChildExportPob objects filtered by the rm_manager_town column
 * @psalm-method Collection&\Traversable<ChildExportPob> findByRmManagerTown(string|array<string> $rm_manager_town) Return ChildExportPob objects filtered by the rm_manager_town column
 * @method     ChildExportPob[]|Collection findByAmManagerBranch(string|array<string> $am_manager_branch) Return ChildExportPob objects filtered by the am_manager_branch column
 * @psalm-method Collection&\Traversable<ChildExportPob> findByAmManagerBranch(string|array<string> $am_manager_branch) Return ChildExportPob objects filtered by the am_manager_branch column
 * @method     ChildExportPob[]|Collection findByAmManagerTown(string|array<string> $am_manager_town) Return ChildExportPob objects filtered by the am_manager_town column
 * @psalm-method Collection&\Traversable<ChildExportPob> findByAmManagerTown(string|array<string> $am_manager_town) Return ChildExportPob objects filtered by the am_manager_town column
 * @method     ChildExportPob[]|Collection findByZmPositionCode(string|array<string> $zm_position_code) Return ChildExportPob objects filtered by the zm_position_code column
 * @psalm-method Collection&\Traversable<ChildExportPob> findByZmPositionCode(string|array<string> $zm_position_code) Return ChildExportPob objects filtered by the zm_position_code column
 * @method     ChildExportPob[]|Collection findByRmPositionCode(string|array<string> $rm_position_code) Return ChildExportPob objects filtered by the rm_position_code column
 * @psalm-method Collection&\Traversable<ChildExportPob> findByRmPositionCode(string|array<string> $rm_position_code) Return ChildExportPob objects filtered by the rm_position_code column
 * @method     ChildExportPob[]|Collection findByAmPositionCode(string|array<string> $am_position_code) Return ChildExportPob objects filtered by the am_position_code column
 * @psalm-method Collection&\Traversable<ChildExportPob> findByAmPositionCode(string|array<string> $am_position_code) Return ChildExportPob objects filtered by the am_position_code column
 * @method     ChildExportPob[]|Collection findByEmpPositionCode(string|array<string> $emp_position_code) Return ChildExportPob objects filtered by the emp_position_code column
 * @psalm-method Collection&\Traversable<ChildExportPob> findByEmpPositionCode(string|array<string> $emp_position_code) Return ChildExportPob objects filtered by the emp_position_code column
 * @method     ChildExportPob[]|Collection findByEmpPositionName(string|array<string> $emp_position_name) Return ChildExportPob objects filtered by the emp_position_name column
 * @psalm-method Collection&\Traversable<ChildExportPob> findByEmpPositionName(string|array<string> $emp_position_name) Return ChildExportPob objects filtered by the emp_position_name column
 * @method     ChildExportPob[]|Collection findByEmpLevel(string|array<string> $emp_level) Return ChildExportPob objects filtered by the emp_level column
 * @psalm-method Collection&\Traversable<ChildExportPob> findByEmpLevel(string|array<string> $emp_level) Return ChildExportPob objects filtered by the emp_level column
 * @method     ChildExportPob[]|Collection findByEmployeeCode(string|array<string> $employee_code) Return ChildExportPob objects filtered by the employee_code column
 * @psalm-method Collection&\Traversable<ChildExportPob> findByEmployeeCode(string|array<string> $employee_code) Return ChildExportPob objects filtered by the employee_code column
 * @method     ChildExportPob[]|Collection findByEmployee(string|array<string> $employee) Return ChildExportPob objects filtered by the employee column
 * @psalm-method Collection&\Traversable<ChildExportPob> findByEmployee(string|array<string> $employee) Return ChildExportPob objects filtered by the employee column
 * @method     ChildExportPob[]|Collection findByDesignation(string|array<string> $designation) Return ChildExportPob objects filtered by the designation column
 * @psalm-method Collection&\Traversable<ChildExportPob> findByDesignation(string|array<string> $designation) Return ChildExportPob objects filtered by the designation column
 * @method     ChildExportPob[]|Collection findByFromOutletType(string|array<string> $from_outlet_type) Return ChildExportPob objects filtered by the from_outlet_type column
 * @psalm-method Collection&\Traversable<ChildExportPob> findByFromOutletType(string|array<string> $from_outlet_type) Return ChildExportPob objects filtered by the from_outlet_type column
 * @method     ChildExportPob[]|Collection findByFromOutletCode(string|array<string> $from_outlet_code) Return ChildExportPob objects filtered by the from_outlet_code column
 * @psalm-method Collection&\Traversable<ChildExportPob> findByFromOutletCode(string|array<string> $from_outlet_code) Return ChildExportPob objects filtered by the from_outlet_code column
 * @method     ChildExportPob[]|Collection findByFromOutletName(string|array<string> $from_outlet_name) Return ChildExportPob objects filtered by the from_outlet_name column
 * @psalm-method Collection&\Traversable<ChildExportPob> findByFromOutletName(string|array<string> $from_outlet_name) Return ChildExportPob objects filtered by the from_outlet_name column
 * @method     ChildExportPob[]|Collection findByFromOutletClassification(string|array<string> $from_outlet_classification) Return ChildExportPob objects filtered by the from_outlet_classification column
 * @psalm-method Collection&\Traversable<ChildExportPob> findByFromOutletClassification(string|array<string> $from_outlet_classification) Return ChildExportPob objects filtered by the from_outlet_classification column
 * @method     ChildExportPob[]|Collection findByToOutletType(string|array<string> $to_outlet_type) Return ChildExportPob objects filtered by the to_outlet_type column
 * @psalm-method Collection&\Traversable<ChildExportPob> findByToOutletType(string|array<string> $to_outlet_type) Return ChildExportPob objects filtered by the to_outlet_type column
 * @method     ChildExportPob[]|Collection findByToOutletCode(string|array<string> $to_outlet_code) Return ChildExportPob objects filtered by the to_outlet_code column
 * @psalm-method Collection&\Traversable<ChildExportPob> findByToOutletCode(string|array<string> $to_outlet_code) Return ChildExportPob objects filtered by the to_outlet_code column
 * @method     ChildExportPob[]|Collection findByToOutletName(string|array<string> $to_outlet_name) Return ChildExportPob objects filtered by the to_outlet_name column
 * @psalm-method Collection&\Traversable<ChildExportPob> findByToOutletName(string|array<string> $to_outlet_name) Return ChildExportPob objects filtered by the to_outlet_name column
 * @method     ChildExportPob[]|Collection findByToOutletClassification(string|array<string> $to_outlet_classification) Return ChildExportPob objects filtered by the to_outlet_classification column
 * @psalm-method Collection&\Traversable<ChildExportPob> findByToOutletClassification(string|array<string> $to_outlet_classification) Return ChildExportPob objects filtered by the to_outlet_classification column
 * @method     ChildExportPob[]|Collection findByProductName(string|array<string> $product_name) Return ChildExportPob objects filtered by the product_name column
 * @psalm-method Collection&\Traversable<ChildExportPob> findByProductName(string|array<string> $product_name) Return ChildExportPob objects filtered by the product_name column
 * @method     ChildExportPob[]|Collection findByProductSku(string|array<string> $product_sku) Return ChildExportPob objects filtered by the product_sku column
 * @psalm-method Collection&\Traversable<ChildExportPob> findByProductSku(string|array<string> $product_sku) Return ChildExportPob objects filtered by the product_sku column
 * @method     ChildExportPob[]|Collection findByRate(string|array<string> $rate) Return ChildExportPob objects filtered by the rate column
 * @psalm-method Collection&\Traversable<ChildExportPob> findByRate(string|array<string> $rate) Return ChildExportPob objects filtered by the rate column
 * @method     ChildExportPob[]|Collection findByQty(int|array<int> $qty) Return ChildExportPob objects filtered by the qty column
 * @psalm-method Collection&\Traversable<ChildExportPob> findByQty(int|array<int> $qty) Return ChildExportPob objects filtered by the qty column
 * @method     ChildExportPob[]|Collection findByTotalAmt(string|array<string> $total_amt) Return ChildExportPob objects filtered by the total_amt column
 * @psalm-method Collection&\Traversable<ChildExportPob> findByTotalAmt(string|array<string> $total_amt) Return ChildExportPob objects filtered by the total_amt column
 * @method     ChildExportPob[]|Collection findByOrderDate(string|array<string> $order_date) Return ChildExportPob objects filtered by the order_date column
 * @psalm-method Collection&\Traversable<ChildExportPob> findByOrderDate(string|array<string> $order_date) Return ChildExportPob objects filtered by the order_date column
 * @method     ChildExportPob[]|Collection findByEmpTerritory(string|array<string> $emp_territory) Return ChildExportPob objects filtered by the emp_territory column
 * @psalm-method Collection&\Traversable<ChildExportPob> findByEmpTerritory(string|array<string> $emp_territory) Return ChildExportPob objects filtered by the emp_territory column
 * @method     ChildExportPob[]|Collection findByEmpBranch(string|array<string> $emp_branch) Return ChildExportPob objects filtered by the emp_branch column
 * @psalm-method Collection&\Traversable<ChildExportPob> findByEmpBranch(string|array<string> $emp_branch) Return ChildExportPob objects filtered by the emp_branch column
 * @method     ChildExportPob[]|Collection findByEmpTown(string|array<string> $emp_town) Return ChildExportPob objects filtered by the emp_town column
 * @psalm-method Collection&\Traversable<ChildExportPob> findByEmpTown(string|array<string> $emp_town) Return ChildExportPob objects filtered by the emp_town column
 *
 * @method     ChildExportPob[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildExportPob> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class ExportPobQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\ExportPobQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\ExportPob', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildExportPobQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildExportPobQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildExportPobQuery) {
            return $criteria;
        }
        $query = new ChildExportPobQuery();
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
     * @return ChildExportPob|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        throw new LogicException('The ExportPob object has no primary key');
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
        throw new LogicException('The ExportPob object has no primary key');
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
        throw new LogicException('The ExportPob object has no primary key');
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
        throw new LogicException('The ExportPob object has no primary key');
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

        $this->addUsingAlias(ExportPobTableMap::COL_BU_NAME, $buName, $comparison);

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

        $this->addUsingAlias(ExportPobTableMap::COL_ZM_MANAGER_BRANCH, $zmManagerBranch, $comparison);

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

        $this->addUsingAlias(ExportPobTableMap::COL_ZM_MANAGER_TOWN, $zmManagerTown, $comparison);

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

        $this->addUsingAlias(ExportPobTableMap::COL_RM_MANAGER_BRANCH, $rmManagerBranch, $comparison);

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

        $this->addUsingAlias(ExportPobTableMap::COL_RM_MANAGER_TOWN, $rmManagerTown, $comparison);

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

        $this->addUsingAlias(ExportPobTableMap::COL_AM_MANAGER_BRANCH, $amManagerBranch, $comparison);

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

        $this->addUsingAlias(ExportPobTableMap::COL_AM_MANAGER_TOWN, $amManagerTown, $comparison);

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

        $this->addUsingAlias(ExportPobTableMap::COL_ZM_POSITION_CODE, $zmPositionCode, $comparison);

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

        $this->addUsingAlias(ExportPobTableMap::COL_RM_POSITION_CODE, $rmPositionCode, $comparison);

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

        $this->addUsingAlias(ExportPobTableMap::COL_AM_POSITION_CODE, $amPositionCode, $comparison);

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

        $this->addUsingAlias(ExportPobTableMap::COL_EMP_POSITION_CODE, $empPositionCode, $comparison);

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

        $this->addUsingAlias(ExportPobTableMap::COL_EMP_POSITION_NAME, $empPositionName, $comparison);

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

        $this->addUsingAlias(ExportPobTableMap::COL_EMP_LEVEL, $empLevel, $comparison);

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

        $this->addUsingAlias(ExportPobTableMap::COL_EMPLOYEE_CODE, $employeeCode, $comparison);

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

        $this->addUsingAlias(ExportPobTableMap::COL_EMPLOYEE, $employee, $comparison);

        return $this;
    }

    /**
     * Filter the query on the designation column
     *
     * Example usage:
     * <code>
     * $query->filterByDesignation('fooValue');   // WHERE designation = 'fooValue'
     * $query->filterByDesignation('%fooValue%', Criteria::LIKE); // WHERE designation LIKE '%fooValue%'
     * $query->filterByDesignation(['foo', 'bar']); // WHERE designation IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $designation The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDesignation($designation = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($designation)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportPobTableMap::COL_DESIGNATION, $designation, $comparison);

        return $this;
    }

    /**
     * Filter the query on the from_outlet_type column
     *
     * Example usage:
     * <code>
     * $query->filterByFromOutletType('fooValue');   // WHERE from_outlet_type = 'fooValue'
     * $query->filterByFromOutletType('%fooValue%', Criteria::LIKE); // WHERE from_outlet_type LIKE '%fooValue%'
     * $query->filterByFromOutletType(['foo', 'bar']); // WHERE from_outlet_type IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $fromOutletType The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFromOutletType($fromOutletType = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fromOutletType)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportPobTableMap::COL_FROM_OUTLET_TYPE, $fromOutletType, $comparison);

        return $this;
    }

    /**
     * Filter the query on the from_outlet_code column
     *
     * Example usage:
     * <code>
     * $query->filterByFromOutletCode('fooValue');   // WHERE from_outlet_code = 'fooValue'
     * $query->filterByFromOutletCode('%fooValue%', Criteria::LIKE); // WHERE from_outlet_code LIKE '%fooValue%'
     * $query->filterByFromOutletCode(['foo', 'bar']); // WHERE from_outlet_code IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $fromOutletCode The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFromOutletCode($fromOutletCode = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fromOutletCode)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportPobTableMap::COL_FROM_OUTLET_CODE, $fromOutletCode, $comparison);

        return $this;
    }

    /**
     * Filter the query on the from_outlet_name column
     *
     * Example usage:
     * <code>
     * $query->filterByFromOutletName('fooValue');   // WHERE from_outlet_name = 'fooValue'
     * $query->filterByFromOutletName('%fooValue%', Criteria::LIKE); // WHERE from_outlet_name LIKE '%fooValue%'
     * $query->filterByFromOutletName(['foo', 'bar']); // WHERE from_outlet_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $fromOutletName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFromOutletName($fromOutletName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fromOutletName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportPobTableMap::COL_FROM_OUTLET_NAME, $fromOutletName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the from_outlet_classification column
     *
     * Example usage:
     * <code>
     * $query->filterByFromOutletClassification('fooValue');   // WHERE from_outlet_classification = 'fooValue'
     * $query->filterByFromOutletClassification('%fooValue%', Criteria::LIKE); // WHERE from_outlet_classification LIKE '%fooValue%'
     * $query->filterByFromOutletClassification(['foo', 'bar']); // WHERE from_outlet_classification IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $fromOutletClassification The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFromOutletClassification($fromOutletClassification = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fromOutletClassification)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportPobTableMap::COL_FROM_OUTLET_CLASSIFICATION, $fromOutletClassification, $comparison);

        return $this;
    }

    /**
     * Filter the query on the to_outlet_type column
     *
     * Example usage:
     * <code>
     * $query->filterByToOutletType('fooValue');   // WHERE to_outlet_type = 'fooValue'
     * $query->filterByToOutletType('%fooValue%', Criteria::LIKE); // WHERE to_outlet_type LIKE '%fooValue%'
     * $query->filterByToOutletType(['foo', 'bar']); // WHERE to_outlet_type IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $toOutletType The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByToOutletType($toOutletType = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($toOutletType)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportPobTableMap::COL_TO_OUTLET_TYPE, $toOutletType, $comparison);

        return $this;
    }

    /**
     * Filter the query on the to_outlet_code column
     *
     * Example usage:
     * <code>
     * $query->filterByToOutletCode('fooValue');   // WHERE to_outlet_code = 'fooValue'
     * $query->filterByToOutletCode('%fooValue%', Criteria::LIKE); // WHERE to_outlet_code LIKE '%fooValue%'
     * $query->filterByToOutletCode(['foo', 'bar']); // WHERE to_outlet_code IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $toOutletCode The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByToOutletCode($toOutletCode = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($toOutletCode)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportPobTableMap::COL_TO_OUTLET_CODE, $toOutletCode, $comparison);

        return $this;
    }

    /**
     * Filter the query on the to_outlet_name column
     *
     * Example usage:
     * <code>
     * $query->filterByToOutletName('fooValue');   // WHERE to_outlet_name = 'fooValue'
     * $query->filterByToOutletName('%fooValue%', Criteria::LIKE); // WHERE to_outlet_name LIKE '%fooValue%'
     * $query->filterByToOutletName(['foo', 'bar']); // WHERE to_outlet_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $toOutletName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByToOutletName($toOutletName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($toOutletName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportPobTableMap::COL_TO_OUTLET_NAME, $toOutletName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the to_outlet_classification column
     *
     * Example usage:
     * <code>
     * $query->filterByToOutletClassification('fooValue');   // WHERE to_outlet_classification = 'fooValue'
     * $query->filterByToOutletClassification('%fooValue%', Criteria::LIKE); // WHERE to_outlet_classification LIKE '%fooValue%'
     * $query->filterByToOutletClassification(['foo', 'bar']); // WHERE to_outlet_classification IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $toOutletClassification The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByToOutletClassification($toOutletClassification = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($toOutletClassification)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportPobTableMap::COL_TO_OUTLET_CLASSIFICATION, $toOutletClassification, $comparison);

        return $this;
    }

    /**
     * Filter the query on the product_name column
     *
     * Example usage:
     * <code>
     * $query->filterByProductName('fooValue');   // WHERE product_name = 'fooValue'
     * $query->filterByProductName('%fooValue%', Criteria::LIKE); // WHERE product_name LIKE '%fooValue%'
     * $query->filterByProductName(['foo', 'bar']); // WHERE product_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $productName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProductName($productName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($productName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportPobTableMap::COL_PRODUCT_NAME, $productName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the product_sku column
     *
     * Example usage:
     * <code>
     * $query->filterByProductSku('fooValue');   // WHERE product_sku = 'fooValue'
     * $query->filterByProductSku('%fooValue%', Criteria::LIKE); // WHERE product_sku LIKE '%fooValue%'
     * $query->filterByProductSku(['foo', 'bar']); // WHERE product_sku IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $productSku The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProductSku($productSku = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($productSku)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportPobTableMap::COL_PRODUCT_SKU, $productSku, $comparison);

        return $this;
    }

    /**
     * Filter the query on the rate column
     *
     * Example usage:
     * <code>
     * $query->filterByRate(1234); // WHERE rate = 1234
     * $query->filterByRate(array(12, 34)); // WHERE rate IN (12, 34)
     * $query->filterByRate(array('min' => 12)); // WHERE rate > 12
     * </code>
     *
     * @param mixed $rate The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRate($rate = null, ?string $comparison = null)
    {
        if (is_array($rate)) {
            $useMinMax = false;
            if (isset($rate['min'])) {
                $this->addUsingAlias(ExportPobTableMap::COL_RATE, $rate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($rate['max'])) {
                $this->addUsingAlias(ExportPobTableMap::COL_RATE, $rate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportPobTableMap::COL_RATE, $rate, $comparison);

        return $this;
    }

    /**
     * Filter the query on the qty column
     *
     * Example usage:
     * <code>
     * $query->filterByQty(1234); // WHERE qty = 1234
     * $query->filterByQty(array(12, 34)); // WHERE qty IN (12, 34)
     * $query->filterByQty(array('min' => 12)); // WHERE qty > 12
     * </code>
     *
     * @param mixed $qty The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByQty($qty = null, ?string $comparison = null)
    {
        if (is_array($qty)) {
            $useMinMax = false;
            if (isset($qty['min'])) {
                $this->addUsingAlias(ExportPobTableMap::COL_QTY, $qty['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($qty['max'])) {
                $this->addUsingAlias(ExportPobTableMap::COL_QTY, $qty['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportPobTableMap::COL_QTY, $qty, $comparison);

        return $this;
    }

    /**
     * Filter the query on the total_amt column
     *
     * Example usage:
     * <code>
     * $query->filterByTotalAmt(1234); // WHERE total_amt = 1234
     * $query->filterByTotalAmt(array(12, 34)); // WHERE total_amt IN (12, 34)
     * $query->filterByTotalAmt(array('min' => 12)); // WHERE total_amt > 12
     * </code>
     *
     * @param mixed $totalAmt The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTotalAmt($totalAmt = null, ?string $comparison = null)
    {
        if (is_array($totalAmt)) {
            $useMinMax = false;
            if (isset($totalAmt['min'])) {
                $this->addUsingAlias(ExportPobTableMap::COL_TOTAL_AMT, $totalAmt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($totalAmt['max'])) {
                $this->addUsingAlias(ExportPobTableMap::COL_TOTAL_AMT, $totalAmt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportPobTableMap::COL_TOTAL_AMT, $totalAmt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the order_date column
     *
     * Example usage:
     * <code>
     * $query->filterByOrderDate('2011-03-14'); // WHERE order_date = '2011-03-14'
     * $query->filterByOrderDate('now'); // WHERE order_date = '2011-03-14'
     * $query->filterByOrderDate(array('max' => 'yesterday')); // WHERE order_date > '2011-03-13'
     * </code>
     *
     * @param mixed $orderDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrderDate($orderDate = null, ?string $comparison = null)
    {
        if (is_array($orderDate)) {
            $useMinMax = false;
            if (isset($orderDate['min'])) {
                $this->addUsingAlias(ExportPobTableMap::COL_ORDER_DATE, $orderDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($orderDate['max'])) {
                $this->addUsingAlias(ExportPobTableMap::COL_ORDER_DATE, $orderDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportPobTableMap::COL_ORDER_DATE, $orderDate, $comparison);

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

        $this->addUsingAlias(ExportPobTableMap::COL_EMP_TERRITORY, $empTerritory, $comparison);

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

        $this->addUsingAlias(ExportPobTableMap::COL_EMP_BRANCH, $empBranch, $comparison);

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

        $this->addUsingAlias(ExportPobTableMap::COL_EMP_TOWN, $empTown, $comparison);

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildExportPob $exportPob Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($exportPob = null)
    {
        if ($exportPob) {
            throw new LogicException('ExportPob object has no primary key');

        }

        return $this;
    }

}
