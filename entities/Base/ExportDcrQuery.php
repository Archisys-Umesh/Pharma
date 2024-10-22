<?php

namespace entities\Base;

use \Exception;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\LogicException;
use entities\ExportDcr as ChildExportDcr;
use entities\ExportDcrQuery as ChildExportDcrQuery;
use entities\Map\ExportDcrTableMap;

/**
 * Base class that represents a query for the `export_dcr` table.
 *
 * @method     ChildExportDcrQuery orderByBuName($order = Criteria::ASC) Order by the bu_name column
 * @method     ChildExportDcrQuery orderByZmManagerBranch($order = Criteria::ASC) Order by the zm_manager_branch column
 * @method     ChildExportDcrQuery orderByZmManagerTown($order = Criteria::ASC) Order by the zm_manager_town column
 * @method     ChildExportDcrQuery orderByRmManagerBranch($order = Criteria::ASC) Order by the rm_manager_branch column
 * @method     ChildExportDcrQuery orderByRmManagerTown($order = Criteria::ASC) Order by the rm_manager_town column
 * @method     ChildExportDcrQuery orderByAmManagerBranch($order = Criteria::ASC) Order by the am_manager_branch column
 * @method     ChildExportDcrQuery orderByAmManagerTown($order = Criteria::ASC) Order by the am_manager_town column
 * @method     ChildExportDcrQuery orderByZmPositionCode($order = Criteria::ASC) Order by the zm_position_code column
 * @method     ChildExportDcrQuery orderByRmPositionCode($order = Criteria::ASC) Order by the rm_position_code column
 * @method     ChildExportDcrQuery orderByAmPositionCode($order = Criteria::ASC) Order by the am_position_code column
 * @method     ChildExportDcrQuery orderByEmpPositionCode($order = Criteria::ASC) Order by the emp_position_code column
 * @method     ChildExportDcrQuery orderByEmpPositionName($order = Criteria::ASC) Order by the emp_position_name column
 * @method     ChildExportDcrQuery orderByEmpLevel($order = Criteria::ASC) Order by the emp_level column
 * @method     ChildExportDcrQuery orderByEmployeeCode($order = Criteria::ASC) Order by the employee_code column
 * @method     ChildExportDcrQuery orderByEmployee($order = Criteria::ASC) Order by the employee column
 * @method     ChildExportDcrQuery orderByJwEmployeeCode($order = Criteria::ASC) Order by the jw_employee_code column
 * @method     ChildExportDcrQuery orderByJwEmployee($order = Criteria::ASC) Order by the jw_employee column
 * @method     ChildExportDcrQuery orderByJwPositionName($order = Criteria::ASC) Order by the jw_position_name column
 * @method     ChildExportDcrQuery orderByOutletType($order = Criteria::ASC) Order by the outlet_type column
 * @method     ChildExportDcrQuery orderByOutletCode($order = Criteria::ASC) Order by the outlet_code column
 * @method     ChildExportDcrQuery orderByOutletName($order = Criteria::ASC) Order by the outlet_name column
 * @method     ChildExportDcrQuery orderByAgendacontroltype($order = Criteria::ASC) Order by the agendacontroltype column
 * @method     ChildExportDcrQuery orderByAgendname($order = Criteria::ASC) Order by the agendname column
 * @method     ChildExportDcrQuery orderByStownname($order = Criteria::ASC) Order by the stownname column
 * @method     ChildExportDcrQuery orderByDcrDate($order = Criteria::ASC) Order by the dcr_date column
 * @method     ChildExportDcrQuery orderByDcrStatus($order = Criteria::ASC) Order by the dcr_status column
 * @method     ChildExportDcrQuery orderByNcaComments($order = Criteria::ASC) Order by the nca_comments column
 * @method     ChildExportDcrQuery orderByPlanned($order = Criteria::ASC) Order by the planned column
 * @method     ChildExportDcrQuery orderByManagersName($order = Criteria::ASC) Order by the managers_name column
 * @method     ChildExportDcrQuery orderByBrandsDetailedName($order = Criteria::ASC) Order by the brands_detailed_name column
 * @method     ChildExportDcrQuery orderByEdDuration($order = Criteria::ASC) Order by the ed_duration column
 * @method     ChildExportDcrQuery orderByDateTime($order = Criteria::ASC) Order by the datetime column
 * @method     ChildExportDcrQuery orderByEmpTerritory($order = Criteria::ASC) Order by the emp_territory column
 * @method     ChildExportDcrQuery orderByEmpBranch($order = Criteria::ASC) Order by the emp_branch column
 * @method     ChildExportDcrQuery orderByEmpTown($order = Criteria::ASC) Order by the emp_town column
 * @method     ChildExportDcrQuery orderByCustomerTown($order = Criteria::ASC) Order by the customer_town column
 * @method     ChildExportDcrQuery orderByCustomerPatch($order = Criteria::ASC) Order by the customer_patch column
 * @method     ChildExportDcrQuery orderByLeaveTaken($order = Criteria::ASC) Order by the leave_teken column
 *
 * @method     ChildExportDcrQuery groupByBuName() Group by the bu_name column
 * @method     ChildExportDcrQuery groupByZmManagerBranch() Group by the zm_manager_branch column
 * @method     ChildExportDcrQuery groupByZmManagerTown() Group by the zm_manager_town column
 * @method     ChildExportDcrQuery groupByRmManagerBranch() Group by the rm_manager_branch column
 * @method     ChildExportDcrQuery groupByRmManagerTown() Group by the rm_manager_town column
 * @method     ChildExportDcrQuery groupByAmManagerBranch() Group by the am_manager_branch column
 * @method     ChildExportDcrQuery groupByAmManagerTown() Group by the am_manager_town column
 * @method     ChildExportDcrQuery groupByZmPositionCode() Group by the zm_position_code column
 * @method     ChildExportDcrQuery groupByRmPositionCode() Group by the rm_position_code column
 * @method     ChildExportDcrQuery groupByAmPositionCode() Group by the am_position_code column
 * @method     ChildExportDcrQuery groupByEmpPositionCode() Group by the emp_position_code column
 * @method     ChildExportDcrQuery groupByEmpPositionName() Group by the emp_position_name column
 * @method     ChildExportDcrQuery groupByEmpLevel() Group by the emp_level column
 * @method     ChildExportDcrQuery groupByEmployeeCode() Group by the employee_code column
 * @method     ChildExportDcrQuery groupByEmployee() Group by the employee column
 * @method     ChildExportDcrQuery groupByJwEmployeeCode() Group by the jw_employee_code column
 * @method     ChildExportDcrQuery groupByJwEmployee() Group by the jw_employee column
 * @method     ChildExportDcrQuery groupByJwPositionName() Group by the jw_position_name column
 * @method     ChildExportDcrQuery groupByOutletType() Group by the outlet_type column
 * @method     ChildExportDcrQuery groupByOutletCode() Group by the outlet_code column
 * @method     ChildExportDcrQuery groupByOutletName() Group by the outlet_name column
 * @method     ChildExportDcrQuery groupByAgendacontroltype() Group by the agendacontroltype column
 * @method     ChildExportDcrQuery groupByAgendname() Group by the agendname column
 * @method     ChildExportDcrQuery groupByStownname() Group by the stownname column
 * @method     ChildExportDcrQuery groupByDcrDate() Group by the dcr_date column
 * @method     ChildExportDcrQuery groupByDcrStatus() Group by the dcr_status column
 * @method     ChildExportDcrQuery groupByNcaComments() Group by the nca_comments column
 * @method     ChildExportDcrQuery groupByPlanned() Group by the planned column
 * @method     ChildExportDcrQuery groupByManagersName() Group by the managers_name column
 * @method     ChildExportDcrQuery groupByBrandsDetailedName() Group by the brands_detailed_name column
 * @method     ChildExportDcrQuery groupByEdDuration() Group by the ed_duration column
 * @method     ChildExportDcrQuery groupByDateTime() Group by the datetime column
 * @method     ChildExportDcrQuery groupByEmpTerritory() Group by the emp_territory column
 * @method     ChildExportDcrQuery groupByEmpBranch() Group by the emp_branch column
 * @method     ChildExportDcrQuery groupByEmpTown() Group by the emp_town column
 * @method     ChildExportDcrQuery groupByCustomerTown() Group by the customer_town column
 * @method     ChildExportDcrQuery groupByCustomerPatch() Group by the customer_patch column
 * @method     ChildExportDcrQuery groupByLeaveTaken() Group by the leave_teken column
 *
 * @method     ChildExportDcrQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildExportDcrQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildExportDcrQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildExportDcrQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildExportDcrQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildExportDcrQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildExportDcr|null findOne(?ConnectionInterface $con = null) Return the first ChildExportDcr matching the query
 * @method     ChildExportDcr findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildExportDcr matching the query, or a new ChildExportDcr object populated from the query conditions when no match is found
 *
 * @method     ChildExportDcr|null findOneByBuName(string $bu_name) Return the first ChildExportDcr filtered by the bu_name column
 * @method     ChildExportDcr|null findOneByZmManagerBranch(string $zm_manager_branch) Return the first ChildExportDcr filtered by the zm_manager_branch column
 * @method     ChildExportDcr|null findOneByZmManagerTown(string $zm_manager_town) Return the first ChildExportDcr filtered by the zm_manager_town column
 * @method     ChildExportDcr|null findOneByRmManagerBranch(string $rm_manager_branch) Return the first ChildExportDcr filtered by the rm_manager_branch column
 * @method     ChildExportDcr|null findOneByRmManagerTown(string $rm_manager_town) Return the first ChildExportDcr filtered by the rm_manager_town column
 * @method     ChildExportDcr|null findOneByAmManagerBranch(string $am_manager_branch) Return the first ChildExportDcr filtered by the am_manager_branch column
 * @method     ChildExportDcr|null findOneByAmManagerTown(string $am_manager_town) Return the first ChildExportDcr filtered by the am_manager_town column
 * @method     ChildExportDcr|null findOneByZmPositionCode(string $zm_position_code) Return the first ChildExportDcr filtered by the zm_position_code column
 * @method     ChildExportDcr|null findOneByRmPositionCode(string $rm_position_code) Return the first ChildExportDcr filtered by the rm_position_code column
 * @method     ChildExportDcr|null findOneByAmPositionCode(string $am_position_code) Return the first ChildExportDcr filtered by the am_position_code column
 * @method     ChildExportDcr|null findOneByEmpPositionCode(string $emp_position_code) Return the first ChildExportDcr filtered by the emp_position_code column
 * @method     ChildExportDcr|null findOneByEmpPositionName(string $emp_position_name) Return the first ChildExportDcr filtered by the emp_position_name column
 * @method     ChildExportDcr|null findOneByEmpLevel(string $emp_level) Return the first ChildExportDcr filtered by the emp_level column
 * @method     ChildExportDcr|null findOneByEmployeeCode(string $employee_code) Return the first ChildExportDcr filtered by the employee_code column
 * @method     ChildExportDcr|null findOneByEmployee(string $employee) Return the first ChildExportDcr filtered by the employee column
 * @method     ChildExportDcr|null findOneByJwEmployeeCode(string $jw_employee_code) Return the first ChildExportDcr filtered by the jw_employee_code column
 * @method     ChildExportDcr|null findOneByJwEmployee(string $jw_employee) Return the first ChildExportDcr filtered by the jw_employee column
 * @method     ChildExportDcr|null findOneByJwPositionName(string $jw_position_name) Return the first ChildExportDcr filtered by the jw_position_name column
 * @method     ChildExportDcr|null findOneByOutletType(string $outlet_type) Return the first ChildExportDcr filtered by the outlet_type column
 * @method     ChildExportDcr|null findOneByOutletCode(string $outlet_code) Return the first ChildExportDcr filtered by the outlet_code column
 * @method     ChildExportDcr|null findOneByOutletName(string $outlet_name) Return the first ChildExportDcr filtered by the outlet_name column
 * @method     ChildExportDcr|null findOneByAgendacontroltype(string $agendacontroltype) Return the first ChildExportDcr filtered by the agendacontroltype column
 * @method     ChildExportDcr|null findOneByAgendname(string $agendname) Return the first ChildExportDcr filtered by the agendname column
 * @method     ChildExportDcr|null findOneByStownname(string $stownname) Return the first ChildExportDcr filtered by the stownname column
 * @method     ChildExportDcr|null findOneByDcrDate(string $dcr_date) Return the first ChildExportDcr filtered by the dcr_date column
 * @method     ChildExportDcr|null findOneByDcrStatus(string $dcr_status) Return the first ChildExportDcr filtered by the dcr_status column
 * @method     ChildExportDcr|null findOneByNcaComments(string $nca_comments) Return the first ChildExportDcr filtered by the nca_comments column
 * @method     ChildExportDcr|null findOneByPlanned(string $planned) Return the first ChildExportDcr filtered by the planned column
 * @method     ChildExportDcr|null findOneByManagersName(string $managers_name) Return the first ChildExportDcr filtered by the managers_name column
 * @method     ChildExportDcr|null findOneByBrandsDetailedName(string $brands_detailed_name) Return the first ChildExportDcr filtered by the brands_detailed_name column
 * @method     ChildExportDcr|null findOneByEdDuration(int $ed_duration) Return the first ChildExportDcr filtered by the ed_duration column
 * @method     ChildExportDcr|null findOneByDateTime(string $datetime) Return the first ChildExportDcr filtered by the datetime column
 * @method     ChildExportDcr|null findOneByEmpTerritory(string $emp_territory) Return the first ChildExportDcr filtered by the emp_territory column
 * @method     ChildExportDcr|null findOneByEmpBranch(string $emp_branch) Return the first ChildExportDcr filtered by the emp_branch column
 * @method     ChildExportDcr|null findOneByEmpTown(string $emp_town) Return the first ChildExportDcr filtered by the emp_town column
 * @method     ChildExportDcr|null findOneByCustomerTown(string $customer_town) Return the first ChildExportDcr filtered by the customer_town column
 * @method     ChildExportDcr|null findOneByCustomerPatch(string $customer_patch) Return the first ChildExportDcr filtered by the customer_patch column
 * @method     ChildExportDcr|null findOneByLeaveTaken(string $leave_teken) Return the first ChildExportDcr filtered by the leave_teken column
 *
 * @method     ChildExportDcr requirePk($key, ?ConnectionInterface $con = null) Return the ChildExportDcr by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportDcr requireOne(?ConnectionInterface $con = null) Return the first ChildExportDcr matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildExportDcr requireOneByBuName(string $bu_name) Return the first ChildExportDcr filtered by the bu_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportDcr requireOneByZmManagerBranch(string $zm_manager_branch) Return the first ChildExportDcr filtered by the zm_manager_branch column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportDcr requireOneByZmManagerTown(string $zm_manager_town) Return the first ChildExportDcr filtered by the zm_manager_town column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportDcr requireOneByRmManagerBranch(string $rm_manager_branch) Return the first ChildExportDcr filtered by the rm_manager_branch column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportDcr requireOneByRmManagerTown(string $rm_manager_town) Return the first ChildExportDcr filtered by the rm_manager_town column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportDcr requireOneByAmManagerBranch(string $am_manager_branch) Return the first ChildExportDcr filtered by the am_manager_branch column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportDcr requireOneByAmManagerTown(string $am_manager_town) Return the first ChildExportDcr filtered by the am_manager_town column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportDcr requireOneByZmPositionCode(string $zm_position_code) Return the first ChildExportDcr filtered by the zm_position_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportDcr requireOneByRmPositionCode(string $rm_position_code) Return the first ChildExportDcr filtered by the rm_position_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportDcr requireOneByAmPositionCode(string $am_position_code) Return the first ChildExportDcr filtered by the am_position_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportDcr requireOneByEmpPositionCode(string $emp_position_code) Return the first ChildExportDcr filtered by the emp_position_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportDcr requireOneByEmpPositionName(string $emp_position_name) Return the first ChildExportDcr filtered by the emp_position_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportDcr requireOneByEmpLevel(string $emp_level) Return the first ChildExportDcr filtered by the emp_level column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportDcr requireOneByEmployeeCode(string $employee_code) Return the first ChildExportDcr filtered by the employee_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportDcr requireOneByEmployee(string $employee) Return the first ChildExportDcr filtered by the employee column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportDcr requireOneByJwEmployeeCode(string $jw_employee_code) Return the first ChildExportDcr filtered by the jw_employee_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportDcr requireOneByJwEmployee(string $jw_employee) Return the first ChildExportDcr filtered by the jw_employee column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportDcr requireOneByJwPositionName(string $jw_position_name) Return the first ChildExportDcr filtered by the jw_position_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportDcr requireOneByOutletType(string $outlet_type) Return the first ChildExportDcr filtered by the outlet_type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportDcr requireOneByOutletCode(string $outlet_code) Return the first ChildExportDcr filtered by the outlet_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportDcr requireOneByOutletName(string $outlet_name) Return the first ChildExportDcr filtered by the outlet_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportDcr requireOneByAgendacontroltype(string $agendacontroltype) Return the first ChildExportDcr filtered by the agendacontroltype column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportDcr requireOneByAgendname(string $agendname) Return the first ChildExportDcr filtered by the agendname column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportDcr requireOneByStownname(string $stownname) Return the first ChildExportDcr filtered by the stownname column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportDcr requireOneByDcrDate(string $dcr_date) Return the first ChildExportDcr filtered by the dcr_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportDcr requireOneByDcrStatus(string $dcr_status) Return the first ChildExportDcr filtered by the dcr_status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportDcr requireOneByNcaComments(string $nca_comments) Return the first ChildExportDcr filtered by the nca_comments column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportDcr requireOneByPlanned(string $planned) Return the first ChildExportDcr filtered by the planned column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportDcr requireOneByManagersName(string $managers_name) Return the first ChildExportDcr filtered by the managers_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportDcr requireOneByBrandsDetailedName(string $brands_detailed_name) Return the first ChildExportDcr filtered by the brands_detailed_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportDcr requireOneByEdDuration(int $ed_duration) Return the first ChildExportDcr filtered by the ed_duration column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportDcr requireOneByDateTime(string $datetime) Return the first ChildExportDcr filtered by the datetime column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportDcr requireOneByEmpTerritory(string $emp_territory) Return the first ChildExportDcr filtered by the emp_territory column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportDcr requireOneByEmpBranch(string $emp_branch) Return the first ChildExportDcr filtered by the emp_branch column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportDcr requireOneByEmpTown(string $emp_town) Return the first ChildExportDcr filtered by the emp_town column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportDcr requireOneByCustomerTown(string $customer_town) Return the first ChildExportDcr filtered by the customer_town column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportDcr requireOneByCustomerPatch(string $customer_patch) Return the first ChildExportDcr filtered by the customer_patch column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportDcr requireOneByLeaveTaken(string $leave_teken) Return the first ChildExportDcr filtered by the leave_teken column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildExportDcr[]|Collection find(?ConnectionInterface $con = null) Return ChildExportDcr objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildExportDcr> find(?ConnectionInterface $con = null) Return ChildExportDcr objects based on current ModelCriteria
 *
 * @method     ChildExportDcr[]|Collection findByBuName(string|array<string> $bu_name) Return ChildExportDcr objects filtered by the bu_name column
 * @psalm-method Collection&\Traversable<ChildExportDcr> findByBuName(string|array<string> $bu_name) Return ChildExportDcr objects filtered by the bu_name column
 * @method     ChildExportDcr[]|Collection findByZmManagerBranch(string|array<string> $zm_manager_branch) Return ChildExportDcr objects filtered by the zm_manager_branch column
 * @psalm-method Collection&\Traversable<ChildExportDcr> findByZmManagerBranch(string|array<string> $zm_manager_branch) Return ChildExportDcr objects filtered by the zm_manager_branch column
 * @method     ChildExportDcr[]|Collection findByZmManagerTown(string|array<string> $zm_manager_town) Return ChildExportDcr objects filtered by the zm_manager_town column
 * @psalm-method Collection&\Traversable<ChildExportDcr> findByZmManagerTown(string|array<string> $zm_manager_town) Return ChildExportDcr objects filtered by the zm_manager_town column
 * @method     ChildExportDcr[]|Collection findByRmManagerBranch(string|array<string> $rm_manager_branch) Return ChildExportDcr objects filtered by the rm_manager_branch column
 * @psalm-method Collection&\Traversable<ChildExportDcr> findByRmManagerBranch(string|array<string> $rm_manager_branch) Return ChildExportDcr objects filtered by the rm_manager_branch column
 * @method     ChildExportDcr[]|Collection findByRmManagerTown(string|array<string> $rm_manager_town) Return ChildExportDcr objects filtered by the rm_manager_town column
 * @psalm-method Collection&\Traversable<ChildExportDcr> findByRmManagerTown(string|array<string> $rm_manager_town) Return ChildExportDcr objects filtered by the rm_manager_town column
 * @method     ChildExportDcr[]|Collection findByAmManagerBranch(string|array<string> $am_manager_branch) Return ChildExportDcr objects filtered by the am_manager_branch column
 * @psalm-method Collection&\Traversable<ChildExportDcr> findByAmManagerBranch(string|array<string> $am_manager_branch) Return ChildExportDcr objects filtered by the am_manager_branch column
 * @method     ChildExportDcr[]|Collection findByAmManagerTown(string|array<string> $am_manager_town) Return ChildExportDcr objects filtered by the am_manager_town column
 * @psalm-method Collection&\Traversable<ChildExportDcr> findByAmManagerTown(string|array<string> $am_manager_town) Return ChildExportDcr objects filtered by the am_manager_town column
 * @method     ChildExportDcr[]|Collection findByZmPositionCode(string|array<string> $zm_position_code) Return ChildExportDcr objects filtered by the zm_position_code column
 * @psalm-method Collection&\Traversable<ChildExportDcr> findByZmPositionCode(string|array<string> $zm_position_code) Return ChildExportDcr objects filtered by the zm_position_code column
 * @method     ChildExportDcr[]|Collection findByRmPositionCode(string|array<string> $rm_position_code) Return ChildExportDcr objects filtered by the rm_position_code column
 * @psalm-method Collection&\Traversable<ChildExportDcr> findByRmPositionCode(string|array<string> $rm_position_code) Return ChildExportDcr objects filtered by the rm_position_code column
 * @method     ChildExportDcr[]|Collection findByAmPositionCode(string|array<string> $am_position_code) Return ChildExportDcr objects filtered by the am_position_code column
 * @psalm-method Collection&\Traversable<ChildExportDcr> findByAmPositionCode(string|array<string> $am_position_code) Return ChildExportDcr objects filtered by the am_position_code column
 * @method     ChildExportDcr[]|Collection findByEmpPositionCode(string|array<string> $emp_position_code) Return ChildExportDcr objects filtered by the emp_position_code column
 * @psalm-method Collection&\Traversable<ChildExportDcr> findByEmpPositionCode(string|array<string> $emp_position_code) Return ChildExportDcr objects filtered by the emp_position_code column
 * @method     ChildExportDcr[]|Collection findByEmpPositionName(string|array<string> $emp_position_name) Return ChildExportDcr objects filtered by the emp_position_name column
 * @psalm-method Collection&\Traversable<ChildExportDcr> findByEmpPositionName(string|array<string> $emp_position_name) Return ChildExportDcr objects filtered by the emp_position_name column
 * @method     ChildExportDcr[]|Collection findByEmpLevel(string|array<string> $emp_level) Return ChildExportDcr objects filtered by the emp_level column
 * @psalm-method Collection&\Traversable<ChildExportDcr> findByEmpLevel(string|array<string> $emp_level) Return ChildExportDcr objects filtered by the emp_level column
 * @method     ChildExportDcr[]|Collection findByEmployeeCode(string|array<string> $employee_code) Return ChildExportDcr objects filtered by the employee_code column
 * @psalm-method Collection&\Traversable<ChildExportDcr> findByEmployeeCode(string|array<string> $employee_code) Return ChildExportDcr objects filtered by the employee_code column
 * @method     ChildExportDcr[]|Collection findByEmployee(string|array<string> $employee) Return ChildExportDcr objects filtered by the employee column
 * @psalm-method Collection&\Traversable<ChildExportDcr> findByEmployee(string|array<string> $employee) Return ChildExportDcr objects filtered by the employee column
 * @method     ChildExportDcr[]|Collection findByJwEmployeeCode(string|array<string> $jw_employee_code) Return ChildExportDcr objects filtered by the jw_employee_code column
 * @psalm-method Collection&\Traversable<ChildExportDcr> findByJwEmployeeCode(string|array<string> $jw_employee_code) Return ChildExportDcr objects filtered by the jw_employee_code column
 * @method     ChildExportDcr[]|Collection findByJwEmployee(string|array<string> $jw_employee) Return ChildExportDcr objects filtered by the jw_employee column
 * @psalm-method Collection&\Traversable<ChildExportDcr> findByJwEmployee(string|array<string> $jw_employee) Return ChildExportDcr objects filtered by the jw_employee column
 * @method     ChildExportDcr[]|Collection findByJwPositionName(string|array<string> $jw_position_name) Return ChildExportDcr objects filtered by the jw_position_name column
 * @psalm-method Collection&\Traversable<ChildExportDcr> findByJwPositionName(string|array<string> $jw_position_name) Return ChildExportDcr objects filtered by the jw_position_name column
 * @method     ChildExportDcr[]|Collection findByOutletType(string|array<string> $outlet_type) Return ChildExportDcr objects filtered by the outlet_type column
 * @psalm-method Collection&\Traversable<ChildExportDcr> findByOutletType(string|array<string> $outlet_type) Return ChildExportDcr objects filtered by the outlet_type column
 * @method     ChildExportDcr[]|Collection findByOutletCode(string|array<string> $outlet_code) Return ChildExportDcr objects filtered by the outlet_code column
 * @psalm-method Collection&\Traversable<ChildExportDcr> findByOutletCode(string|array<string> $outlet_code) Return ChildExportDcr objects filtered by the outlet_code column
 * @method     ChildExportDcr[]|Collection findByOutletName(string|array<string> $outlet_name) Return ChildExportDcr objects filtered by the outlet_name column
 * @psalm-method Collection&\Traversable<ChildExportDcr> findByOutletName(string|array<string> $outlet_name) Return ChildExportDcr objects filtered by the outlet_name column
 * @method     ChildExportDcr[]|Collection findByAgendacontroltype(string|array<string> $agendacontroltype) Return ChildExportDcr objects filtered by the agendacontroltype column
 * @psalm-method Collection&\Traversable<ChildExportDcr> findByAgendacontroltype(string|array<string> $agendacontroltype) Return ChildExportDcr objects filtered by the agendacontroltype column
 * @method     ChildExportDcr[]|Collection findByAgendname(string|array<string> $agendname) Return ChildExportDcr objects filtered by the agendname column
 * @psalm-method Collection&\Traversable<ChildExportDcr> findByAgendname(string|array<string> $agendname) Return ChildExportDcr objects filtered by the agendname column
 * @method     ChildExportDcr[]|Collection findByStownname(string|array<string> $stownname) Return ChildExportDcr objects filtered by the stownname column
 * @psalm-method Collection&\Traversable<ChildExportDcr> findByStownname(string|array<string> $stownname) Return ChildExportDcr objects filtered by the stownname column
 * @method     ChildExportDcr[]|Collection findByDcrDate(string|array<string> $dcr_date) Return ChildExportDcr objects filtered by the dcr_date column
 * @psalm-method Collection&\Traversable<ChildExportDcr> findByDcrDate(string|array<string> $dcr_date) Return ChildExportDcr objects filtered by the dcr_date column
 * @method     ChildExportDcr[]|Collection findByDcrStatus(string|array<string> $dcr_status) Return ChildExportDcr objects filtered by the dcr_status column
 * @psalm-method Collection&\Traversable<ChildExportDcr> findByDcrStatus(string|array<string> $dcr_status) Return ChildExportDcr objects filtered by the dcr_status column
 * @method     ChildExportDcr[]|Collection findByNcaComments(string|array<string> $nca_comments) Return ChildExportDcr objects filtered by the nca_comments column
 * @psalm-method Collection&\Traversable<ChildExportDcr> findByNcaComments(string|array<string> $nca_comments) Return ChildExportDcr objects filtered by the nca_comments column
 * @method     ChildExportDcr[]|Collection findByPlanned(string|array<string> $planned) Return ChildExportDcr objects filtered by the planned column
 * @psalm-method Collection&\Traversable<ChildExportDcr> findByPlanned(string|array<string> $planned) Return ChildExportDcr objects filtered by the planned column
 * @method     ChildExportDcr[]|Collection findByManagersName(string|array<string> $managers_name) Return ChildExportDcr objects filtered by the managers_name column
 * @psalm-method Collection&\Traversable<ChildExportDcr> findByManagersName(string|array<string> $managers_name) Return ChildExportDcr objects filtered by the managers_name column
 * @method     ChildExportDcr[]|Collection findByBrandsDetailedName(string|array<string> $brands_detailed_name) Return ChildExportDcr objects filtered by the brands_detailed_name column
 * @psalm-method Collection&\Traversable<ChildExportDcr> findByBrandsDetailedName(string|array<string> $brands_detailed_name) Return ChildExportDcr objects filtered by the brands_detailed_name column
 * @method     ChildExportDcr[]|Collection findByEdDuration(int|array<int> $ed_duration) Return ChildExportDcr objects filtered by the ed_duration column
 * @psalm-method Collection&\Traversable<ChildExportDcr> findByEdDuration(int|array<int> $ed_duration) Return ChildExportDcr objects filtered by the ed_duration column
 * @method     ChildExportDcr[]|Collection findByDateTime(string|array<string> $datetime) Return ChildExportDcr objects filtered by the datetime column
 * @psalm-method Collection&\Traversable<ChildExportDcr> findByDateTime(string|array<string> $datetime) Return ChildExportDcr objects filtered by the datetime column
 * @method     ChildExportDcr[]|Collection findByEmpTerritory(string|array<string> $emp_territory) Return ChildExportDcr objects filtered by the emp_territory column
 * @psalm-method Collection&\Traversable<ChildExportDcr> findByEmpTerritory(string|array<string> $emp_territory) Return ChildExportDcr objects filtered by the emp_territory column
 * @method     ChildExportDcr[]|Collection findByEmpBranch(string|array<string> $emp_branch) Return ChildExportDcr objects filtered by the emp_branch column
 * @psalm-method Collection&\Traversable<ChildExportDcr> findByEmpBranch(string|array<string> $emp_branch) Return ChildExportDcr objects filtered by the emp_branch column
 * @method     ChildExportDcr[]|Collection findByEmpTown(string|array<string> $emp_town) Return ChildExportDcr objects filtered by the emp_town column
 * @psalm-method Collection&\Traversable<ChildExportDcr> findByEmpTown(string|array<string> $emp_town) Return ChildExportDcr objects filtered by the emp_town column
 * @method     ChildExportDcr[]|Collection findByCustomerTown(string|array<string> $customer_town) Return ChildExportDcr objects filtered by the customer_town column
 * @psalm-method Collection&\Traversable<ChildExportDcr> findByCustomerTown(string|array<string> $customer_town) Return ChildExportDcr objects filtered by the customer_town column
 * @method     ChildExportDcr[]|Collection findByCustomerPatch(string|array<string> $customer_patch) Return ChildExportDcr objects filtered by the customer_patch column
 * @psalm-method Collection&\Traversable<ChildExportDcr> findByCustomerPatch(string|array<string> $customer_patch) Return ChildExportDcr objects filtered by the customer_patch column
 * @method     ChildExportDcr[]|Collection findByLeaveTaken(string|array<string> $leave_teken) Return ChildExportDcr objects filtered by the leave_teken column
 * @psalm-method Collection&\Traversable<ChildExportDcr> findByLeaveTaken(string|array<string> $leave_teken) Return ChildExportDcr objects filtered by the leave_teken column
 *
 * @method     ChildExportDcr[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildExportDcr> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class ExportDcrQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\ExportDcrQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\ExportDcr', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildExportDcrQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildExportDcrQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildExportDcrQuery) {
            return $criteria;
        }
        $query = new ChildExportDcrQuery();
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
     * @return ChildExportDcr|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        throw new LogicException('The ExportDcr object has no primary key');
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
        throw new LogicException('The ExportDcr object has no primary key');
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
        throw new LogicException('The ExportDcr object has no primary key');
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
        throw new LogicException('The ExportDcr object has no primary key');
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

        $this->addUsingAlias(ExportDcrTableMap::COL_BU_NAME, $buName, $comparison);

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

        $this->addUsingAlias(ExportDcrTableMap::COL_ZM_MANAGER_BRANCH, $zmManagerBranch, $comparison);

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

        $this->addUsingAlias(ExportDcrTableMap::COL_ZM_MANAGER_TOWN, $zmManagerTown, $comparison);

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

        $this->addUsingAlias(ExportDcrTableMap::COL_RM_MANAGER_BRANCH, $rmManagerBranch, $comparison);

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

        $this->addUsingAlias(ExportDcrTableMap::COL_RM_MANAGER_TOWN, $rmManagerTown, $comparison);

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

        $this->addUsingAlias(ExportDcrTableMap::COL_AM_MANAGER_BRANCH, $amManagerBranch, $comparison);

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

        $this->addUsingAlias(ExportDcrTableMap::COL_AM_MANAGER_TOWN, $amManagerTown, $comparison);

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

        $this->addUsingAlias(ExportDcrTableMap::COL_ZM_POSITION_CODE, $zmPositionCode, $comparison);

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

        $this->addUsingAlias(ExportDcrTableMap::COL_RM_POSITION_CODE, $rmPositionCode, $comparison);

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

        $this->addUsingAlias(ExportDcrTableMap::COL_AM_POSITION_CODE, $amPositionCode, $comparison);

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

        $this->addUsingAlias(ExportDcrTableMap::COL_EMP_POSITION_CODE, $empPositionCode, $comparison);

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

        $this->addUsingAlias(ExportDcrTableMap::COL_EMP_POSITION_NAME, $empPositionName, $comparison);

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

        $this->addUsingAlias(ExportDcrTableMap::COL_EMP_LEVEL, $empLevel, $comparison);

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

        $this->addUsingAlias(ExportDcrTableMap::COL_EMPLOYEE_CODE, $employeeCode, $comparison);

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

        $this->addUsingAlias(ExportDcrTableMap::COL_EMPLOYEE, $employee, $comparison);

        return $this;
    }

    /**
     * Filter the query on the jw_employee_code column
     *
     * Example usage:
     * <code>
     * $query->filterByJwEmployeeCode('fooValue');   // WHERE jw_employee_code = 'fooValue'
     * $query->filterByJwEmployeeCode('%fooValue%', Criteria::LIKE); // WHERE jw_employee_code LIKE '%fooValue%'
     * $query->filterByJwEmployeeCode(['foo', 'bar']); // WHERE jw_employee_code IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $jwEmployeeCode The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByJwEmployeeCode($jwEmployeeCode = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($jwEmployeeCode)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportDcrTableMap::COL_JW_EMPLOYEE_CODE, $jwEmployeeCode, $comparison);

        return $this;
    }

    /**
     * Filter the query on the jw_employee column
     *
     * Example usage:
     * <code>
     * $query->filterByJwEmployee('fooValue');   // WHERE jw_employee = 'fooValue'
     * $query->filterByJwEmployee('%fooValue%', Criteria::LIKE); // WHERE jw_employee LIKE '%fooValue%'
     * $query->filterByJwEmployee(['foo', 'bar']); // WHERE jw_employee IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $jwEmployee The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByJwEmployee($jwEmployee = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($jwEmployee)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportDcrTableMap::COL_JW_EMPLOYEE, $jwEmployee, $comparison);

        return $this;
    }

    /**
     * Filter the query on the jw_position_name column
     *
     * Example usage:
     * <code>
     * $query->filterByJwPositionName('fooValue');   // WHERE jw_position_name = 'fooValue'
     * $query->filterByJwPositionName('%fooValue%', Criteria::LIKE); // WHERE jw_position_name LIKE '%fooValue%'
     * $query->filterByJwPositionName(['foo', 'bar']); // WHERE jw_position_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $jwPositionName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByJwPositionName($jwPositionName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($jwPositionName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportDcrTableMap::COL_JW_POSITION_NAME, $jwPositionName, $comparison);

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

        $this->addUsingAlias(ExportDcrTableMap::COL_OUTLET_TYPE, $outletType, $comparison);

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

        $this->addUsingAlias(ExportDcrTableMap::COL_OUTLET_CODE, $outletCode, $comparison);

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

        $this->addUsingAlias(ExportDcrTableMap::COL_OUTLET_NAME, $outletName, $comparison);

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

        $this->addUsingAlias(ExportDcrTableMap::COL_AGENDACONTROLTYPE, $agendacontroltype, $comparison);

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

        $this->addUsingAlias(ExportDcrTableMap::COL_AGENDNAME, $agendname, $comparison);

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

        $this->addUsingAlias(ExportDcrTableMap::COL_STOWNNAME, $stownname, $comparison);

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
                $this->addUsingAlias(ExportDcrTableMap::COL_DCR_DATE, $dcrDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dcrDate['max'])) {
                $this->addUsingAlias(ExportDcrTableMap::COL_DCR_DATE, $dcrDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportDcrTableMap::COL_DCR_DATE, $dcrDate, $comparison);

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

        $this->addUsingAlias(ExportDcrTableMap::COL_DCR_STATUS, $dcrStatus, $comparison);

        return $this;
    }

    /**
     * Filter the query on the nca_comments column
     *
     * Example usage:
     * <code>
     * $query->filterByNcaComments('fooValue');   // WHERE nca_comments = 'fooValue'
     * $query->filterByNcaComments('%fooValue%', Criteria::LIKE); // WHERE nca_comments LIKE '%fooValue%'
     * $query->filterByNcaComments(['foo', 'bar']); // WHERE nca_comments IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $ncaComments The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByNcaComments($ncaComments = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($ncaComments)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportDcrTableMap::COL_NCA_COMMENTS, $ncaComments, $comparison);

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

        $this->addUsingAlias(ExportDcrTableMap::COL_PLANNED, $planned, $comparison);

        return $this;
    }

    /**
     * Filter the query on the managers_name column
     *
     * Example usage:
     * <code>
     * $query->filterByManagersName('fooValue');   // WHERE managers_name = 'fooValue'
     * $query->filterByManagersName('%fooValue%', Criteria::LIKE); // WHERE managers_name LIKE '%fooValue%'
     * $query->filterByManagersName(['foo', 'bar']); // WHERE managers_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $managersName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByManagersName($managersName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($managersName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportDcrTableMap::COL_MANAGERS_NAME, $managersName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the brands_detailed_name column
     *
     * Example usage:
     * <code>
     * $query->filterByBrandsDetailedName('fooValue');   // WHERE brands_detailed_name = 'fooValue'
     * $query->filterByBrandsDetailedName('%fooValue%', Criteria::LIKE); // WHERE brands_detailed_name LIKE '%fooValue%'
     * $query->filterByBrandsDetailedName(['foo', 'bar']); // WHERE brands_detailed_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $brandsDetailedName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBrandsDetailedName($brandsDetailedName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($brandsDetailedName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportDcrTableMap::COL_BRANDS_DETAILED_NAME, $brandsDetailedName, $comparison);

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
                $this->addUsingAlias(ExportDcrTableMap::COL_ED_DURATION, $edDuration['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($edDuration['max'])) {
                $this->addUsingAlias(ExportDcrTableMap::COL_ED_DURATION, $edDuration['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportDcrTableMap::COL_ED_DURATION, $edDuration, $comparison);

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
                $this->addUsingAlias(ExportDcrTableMap::COL_DATETIME, $dateTime['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dateTime['max'])) {
                $this->addUsingAlias(ExportDcrTableMap::COL_DATETIME, $dateTime['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportDcrTableMap::COL_DATETIME, $dateTime, $comparison);

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

        $this->addUsingAlias(ExportDcrTableMap::COL_EMP_TERRITORY, $empTerritory, $comparison);

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

        $this->addUsingAlias(ExportDcrTableMap::COL_EMP_BRANCH, $empBranch, $comparison);

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

        $this->addUsingAlias(ExportDcrTableMap::COL_EMP_TOWN, $empTown, $comparison);

        return $this;
    }

    /**
     * Filter the query on the customer_town column
     *
     * Example usage:
     * <code>
     * $query->filterByCustomerTown('fooValue');   // WHERE customer_town = 'fooValue'
     * $query->filterByCustomerTown('%fooValue%', Criteria::LIKE); // WHERE customer_town LIKE '%fooValue%'
     * $query->filterByCustomerTown(['foo', 'bar']); // WHERE customer_town IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $customerTown The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCustomerTown($customerTown = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($customerTown)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportDcrTableMap::COL_CUSTOMER_TOWN, $customerTown, $comparison);

        return $this;
    }

    /**
     * Filter the query on the customer_patch column
     *
     * Example usage:
     * <code>
     * $query->filterByCustomerPatch('fooValue');   // WHERE customer_patch = 'fooValue'
     * $query->filterByCustomerPatch('%fooValue%', Criteria::LIKE); // WHERE customer_patch LIKE '%fooValue%'
     * $query->filterByCustomerPatch(['foo', 'bar']); // WHERE customer_patch IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $customerPatch The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCustomerPatch($customerPatch = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($customerPatch)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportDcrTableMap::COL_CUSTOMER_PATCH, $customerPatch, $comparison);

        return $this;
    }

    /**
     * Filter the query on the leave_teken column
     *
     * Example usage:
     * <code>
     * $query->filterByLeaveTaken('fooValue');   // WHERE leave_teken = 'fooValue'
     * $query->filterByLeaveTaken('%fooValue%', Criteria::LIKE); // WHERE leave_teken LIKE '%fooValue%'
     * $query->filterByLeaveTaken(['foo', 'bar']); // WHERE leave_teken IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $leaveTaken The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLeaveTaken($leaveTaken = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($leaveTaken)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportDcrTableMap::COL_LEAVE_TEKEN, $leaveTaken, $comparison);

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildExportDcr $exportDcr Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($exportDcr = null)
    {
        if ($exportDcr) {
            throw new LogicException('ExportDcr object has no primary key');

        }

        return $this;
    }

}
