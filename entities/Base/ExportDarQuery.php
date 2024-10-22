<?php

namespace entities\Base;

use \Exception;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\LogicException;
use entities\ExportDar as ChildExportDar;
use entities\ExportDarQuery as ChildExportDarQuery;
use entities\Map\ExportDarTableMap;

/**
 * Base class that represents a query for the `export_dar` table.
 *
 * @method     ChildExportDarQuery orderByBuName($order = Criteria::ASC) Order by the bu_name column
 * @method     ChildExportDarQuery orderByZmManagerBranch($order = Criteria::ASC) Order by the zm_manager_branch column
 * @method     ChildExportDarQuery orderByZmManagerTown($order = Criteria::ASC) Order by the zm_manager_town column
 * @method     ChildExportDarQuery orderByRmManagerBranch($order = Criteria::ASC) Order by the rm_manager_branch column
 * @method     ChildExportDarQuery orderByRmManagerTown($order = Criteria::ASC) Order by the rm_manager_town column
 * @method     ChildExportDarQuery orderByAmManagerBranch($order = Criteria::ASC) Order by the am_manager_branch column
 * @method     ChildExportDarQuery orderByAmManagerTown($order = Criteria::ASC) Order by the am_manager_town column
 * @method     ChildExportDarQuery orderByZmPositionCode($order = Criteria::ASC) Order by the zm_position_code column
 * @method     ChildExportDarQuery orderByRmPositionCode($order = Criteria::ASC) Order by the rm_position_code column
 * @method     ChildExportDarQuery orderByAmPositionCode($order = Criteria::ASC) Order by the am_position_code column
 * @method     ChildExportDarQuery orderByEmpPositionCode($order = Criteria::ASC) Order by the emp_position_code column
 * @method     ChildExportDarQuery orderByEmpPositionName($order = Criteria::ASC) Order by the emp_position_name column
 * @method     ChildExportDarQuery orderByEmpLevel($order = Criteria::ASC) Order by the emp_level column
 * @method     ChildExportDarQuery orderByEmployeeCode($order = Criteria::ASC) Order by the employee_code column
 * @method     ChildExportDarQuery orderByEmployee($order = Criteria::ASC) Order by the employee column
 * @method     ChildExportDarQuery orderByJwEmployeeCode($order = Criteria::ASC) Order by the jw_employee_code column
 * @method     ChildExportDarQuery orderByJwEmployee($order = Criteria::ASC) Order by the jw_employee column
 * @method     ChildExportDarQuery orderByJwPositionName($order = Criteria::ASC) Order by the jw_position_name column
 * @method     ChildExportDarQuery orderByOutletType($order = Criteria::ASC) Order by the outlet_type column
 * @method     ChildExportDarQuery orderByOutletCode($order = Criteria::ASC) Order by the outlet_code column
 * @method     ChildExportDarQuery orderByOutletName($order = Criteria::ASC) Order by the outlet_name column
 * @method     ChildExportDarQuery orderByAgendacontroltype($order = Criteria::ASC) Order by the agendacontroltype column
 * @method     ChildExportDarQuery orderByAgendname($order = Criteria::ASC) Order by the agendname column
 * @method     ChildExportDarQuery orderByStownname($order = Criteria::ASC) Order by the stownname column
 * @method     ChildExportDarQuery orderByDcrDate($order = Criteria::ASC) Order by the dcr_date column
 * @method     ChildExportDarQuery orderByDcrStatus($order = Criteria::ASC) Order by the dcr_status column
 * @method     ChildExportDarQuery orderByNcaComments($order = Criteria::ASC) Order by the nca_comments column
 * @method     ChildExportDarQuery orderByPlanned($order = Criteria::ASC) Order by the planned column
 * @method     ChildExportDarQuery orderByManagersName($order = Criteria::ASC) Order by the managers_name column
 * @method     ChildExportDarQuery orderByBrandsDetailedName($order = Criteria::ASC) Order by the brands_detailed_name column
 * @method     ChildExportDarQuery orderByEdDuration($order = Criteria::ASC) Order by the ed_duration column
 * @method     ChildExportDarQuery orderByDateTime($order = Criteria::ASC) Order by the datetime column
 * @method     ChildExportDarQuery orderByEmpTerritory($order = Criteria::ASC) Order by the emp_territory column
 * @method     ChildExportDarQuery orderByEmpBranch($order = Criteria::ASC) Order by the emp_branch column
 * @method     ChildExportDarQuery orderByEmpTown($order = Criteria::ASC) Order by the emp_town column
 * @method     ChildExportDarQuery orderByCustomerTown($order = Criteria::ASC) Order by the customer_town column
 * @method     ChildExportDarQuery orderByCustomerPatch($order = Criteria::ASC) Order by the customer_patch column
 * @method     ChildExportDarQuery orderByLeaveTaken($order = Criteria::ASC) Order by the leave_teken column
 * @method     ChildExportDarQuery orderByDcrId($order = Criteria::ASC) Order by the dcr_id column
 * @method     ChildExportDarQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildExportDarQuery orderByIsJw($order = Criteria::ASC) Order by the isjw column
 * @method     ChildExportDarQuery orderBySgpiOut($order = Criteria::ASC) Order by the sgpi_out column
 * @method     ChildExportDarQuery orderByPobTotal($order = Criteria::ASC) Order by the pob_total column
 * @method     ChildExportDarQuery orderByOutletId($order = Criteria::ASC) Order by the outlet_id column
 *
 * @method     ChildExportDarQuery groupByBuName() Group by the bu_name column
 * @method     ChildExportDarQuery groupByZmManagerBranch() Group by the zm_manager_branch column
 * @method     ChildExportDarQuery groupByZmManagerTown() Group by the zm_manager_town column
 * @method     ChildExportDarQuery groupByRmManagerBranch() Group by the rm_manager_branch column
 * @method     ChildExportDarQuery groupByRmManagerTown() Group by the rm_manager_town column
 * @method     ChildExportDarQuery groupByAmManagerBranch() Group by the am_manager_branch column
 * @method     ChildExportDarQuery groupByAmManagerTown() Group by the am_manager_town column
 * @method     ChildExportDarQuery groupByZmPositionCode() Group by the zm_position_code column
 * @method     ChildExportDarQuery groupByRmPositionCode() Group by the rm_position_code column
 * @method     ChildExportDarQuery groupByAmPositionCode() Group by the am_position_code column
 * @method     ChildExportDarQuery groupByEmpPositionCode() Group by the emp_position_code column
 * @method     ChildExportDarQuery groupByEmpPositionName() Group by the emp_position_name column
 * @method     ChildExportDarQuery groupByEmpLevel() Group by the emp_level column
 * @method     ChildExportDarQuery groupByEmployeeCode() Group by the employee_code column
 * @method     ChildExportDarQuery groupByEmployee() Group by the employee column
 * @method     ChildExportDarQuery groupByJwEmployeeCode() Group by the jw_employee_code column
 * @method     ChildExportDarQuery groupByJwEmployee() Group by the jw_employee column
 * @method     ChildExportDarQuery groupByJwPositionName() Group by the jw_position_name column
 * @method     ChildExportDarQuery groupByOutletType() Group by the outlet_type column
 * @method     ChildExportDarQuery groupByOutletCode() Group by the outlet_code column
 * @method     ChildExportDarQuery groupByOutletName() Group by the outlet_name column
 * @method     ChildExportDarQuery groupByAgendacontroltype() Group by the agendacontroltype column
 * @method     ChildExportDarQuery groupByAgendname() Group by the agendname column
 * @method     ChildExportDarQuery groupByStownname() Group by the stownname column
 * @method     ChildExportDarQuery groupByDcrDate() Group by the dcr_date column
 * @method     ChildExportDarQuery groupByDcrStatus() Group by the dcr_status column
 * @method     ChildExportDarQuery groupByNcaComments() Group by the nca_comments column
 * @method     ChildExportDarQuery groupByPlanned() Group by the planned column
 * @method     ChildExportDarQuery groupByManagersName() Group by the managers_name column
 * @method     ChildExportDarQuery groupByBrandsDetailedName() Group by the brands_detailed_name column
 * @method     ChildExportDarQuery groupByEdDuration() Group by the ed_duration column
 * @method     ChildExportDarQuery groupByDateTime() Group by the datetime column
 * @method     ChildExportDarQuery groupByEmpTerritory() Group by the emp_territory column
 * @method     ChildExportDarQuery groupByEmpBranch() Group by the emp_branch column
 * @method     ChildExportDarQuery groupByEmpTown() Group by the emp_town column
 * @method     ChildExportDarQuery groupByCustomerTown() Group by the customer_town column
 * @method     ChildExportDarQuery groupByCustomerPatch() Group by the customer_patch column
 * @method     ChildExportDarQuery groupByLeaveTaken() Group by the leave_teken column
 * @method     ChildExportDarQuery groupByDcrId() Group by the dcr_id column
 * @method     ChildExportDarQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildExportDarQuery groupByIsJw() Group by the isjw column
 * @method     ChildExportDarQuery groupBySgpiOut() Group by the sgpi_out column
 * @method     ChildExportDarQuery groupByPobTotal() Group by the pob_total column
 * @method     ChildExportDarQuery groupByOutletId() Group by the outlet_id column
 *
 * @method     ChildExportDarQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildExportDarQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildExportDarQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildExportDarQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildExportDarQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildExportDarQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildExportDar|null findOne(?ConnectionInterface $con = null) Return the first ChildExportDar matching the query
 * @method     ChildExportDar findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildExportDar matching the query, or a new ChildExportDar object populated from the query conditions when no match is found
 *
 * @method     ChildExportDar|null findOneByBuName(string $bu_name) Return the first ChildExportDar filtered by the bu_name column
 * @method     ChildExportDar|null findOneByZmManagerBranch(string $zm_manager_branch) Return the first ChildExportDar filtered by the zm_manager_branch column
 * @method     ChildExportDar|null findOneByZmManagerTown(string $zm_manager_town) Return the first ChildExportDar filtered by the zm_manager_town column
 * @method     ChildExportDar|null findOneByRmManagerBranch(string $rm_manager_branch) Return the first ChildExportDar filtered by the rm_manager_branch column
 * @method     ChildExportDar|null findOneByRmManagerTown(string $rm_manager_town) Return the first ChildExportDar filtered by the rm_manager_town column
 * @method     ChildExportDar|null findOneByAmManagerBranch(string $am_manager_branch) Return the first ChildExportDar filtered by the am_manager_branch column
 * @method     ChildExportDar|null findOneByAmManagerTown(string $am_manager_town) Return the first ChildExportDar filtered by the am_manager_town column
 * @method     ChildExportDar|null findOneByZmPositionCode(string $zm_position_code) Return the first ChildExportDar filtered by the zm_position_code column
 * @method     ChildExportDar|null findOneByRmPositionCode(string $rm_position_code) Return the first ChildExportDar filtered by the rm_position_code column
 * @method     ChildExportDar|null findOneByAmPositionCode(string $am_position_code) Return the first ChildExportDar filtered by the am_position_code column
 * @method     ChildExportDar|null findOneByEmpPositionCode(string $emp_position_code) Return the first ChildExportDar filtered by the emp_position_code column
 * @method     ChildExportDar|null findOneByEmpPositionName(string $emp_position_name) Return the first ChildExportDar filtered by the emp_position_name column
 * @method     ChildExportDar|null findOneByEmpLevel(string $emp_level) Return the first ChildExportDar filtered by the emp_level column
 * @method     ChildExportDar|null findOneByEmployeeCode(string $employee_code) Return the first ChildExportDar filtered by the employee_code column
 * @method     ChildExportDar|null findOneByEmployee(string $employee) Return the first ChildExportDar filtered by the employee column
 * @method     ChildExportDar|null findOneByJwEmployeeCode(string $jw_employee_code) Return the first ChildExportDar filtered by the jw_employee_code column
 * @method     ChildExportDar|null findOneByJwEmployee(string $jw_employee) Return the first ChildExportDar filtered by the jw_employee column
 * @method     ChildExportDar|null findOneByJwPositionName(string $jw_position_name) Return the first ChildExportDar filtered by the jw_position_name column
 * @method     ChildExportDar|null findOneByOutletType(string $outlet_type) Return the first ChildExportDar filtered by the outlet_type column
 * @method     ChildExportDar|null findOneByOutletCode(string $outlet_code) Return the first ChildExportDar filtered by the outlet_code column
 * @method     ChildExportDar|null findOneByOutletName(string $outlet_name) Return the first ChildExportDar filtered by the outlet_name column
 * @method     ChildExportDar|null findOneByAgendacontroltype(string $agendacontroltype) Return the first ChildExportDar filtered by the agendacontroltype column
 * @method     ChildExportDar|null findOneByAgendname(string $agendname) Return the first ChildExportDar filtered by the agendname column
 * @method     ChildExportDar|null findOneByStownname(string $stownname) Return the first ChildExportDar filtered by the stownname column
 * @method     ChildExportDar|null findOneByDcrDate(string $dcr_date) Return the first ChildExportDar filtered by the dcr_date column
 * @method     ChildExportDar|null findOneByDcrStatus(string $dcr_status) Return the first ChildExportDar filtered by the dcr_status column
 * @method     ChildExportDar|null findOneByNcaComments(string $nca_comments) Return the first ChildExportDar filtered by the nca_comments column
 * @method     ChildExportDar|null findOneByPlanned(string $planned) Return the first ChildExportDar filtered by the planned column
 * @method     ChildExportDar|null findOneByManagersName(string $managers_name) Return the first ChildExportDar filtered by the managers_name column
 * @method     ChildExportDar|null findOneByBrandsDetailedName(string $brands_detailed_name) Return the first ChildExportDar filtered by the brands_detailed_name column
 * @method     ChildExportDar|null findOneByEdDuration(int $ed_duration) Return the first ChildExportDar filtered by the ed_duration column
 * @method     ChildExportDar|null findOneByDateTime(string $datetime) Return the first ChildExportDar filtered by the datetime column
 * @method     ChildExportDar|null findOneByEmpTerritory(string $emp_territory) Return the first ChildExportDar filtered by the emp_territory column
 * @method     ChildExportDar|null findOneByEmpBranch(string $emp_branch) Return the first ChildExportDar filtered by the emp_branch column
 * @method     ChildExportDar|null findOneByEmpTown(string $emp_town) Return the first ChildExportDar filtered by the emp_town column
 * @method     ChildExportDar|null findOneByCustomerTown(string $customer_town) Return the first ChildExportDar filtered by the customer_town column
 * @method     ChildExportDar|null findOneByCustomerPatch(string $customer_patch) Return the first ChildExportDar filtered by the customer_patch column
 * @method     ChildExportDar|null findOneByLeaveTaken(string $leave_teken) Return the first ChildExportDar filtered by the leave_teken column
 * @method     ChildExportDar|null findOneByDcrId(int $dcr_id) Return the first ChildExportDar filtered by the dcr_id column
 * @method     ChildExportDar|null findOneByUpdatedAt(string $updated_at) Return the first ChildExportDar filtered by the updated_at column
 * @method     ChildExportDar|null findOneByIsJw(string $isjw) Return the first ChildExportDar filtered by the isjw column
 * @method     ChildExportDar|null findOneBySgpiOut(string $sgpi_out) Return the first ChildExportDar filtered by the sgpi_out column
 * @method     ChildExportDar|null findOneByPobTotal(int $pob_total) Return the first ChildExportDar filtered by the pob_total column
 * @method     ChildExportDar|null findOneByOutletId(int $outlet_id) Return the first ChildExportDar filtered by the outlet_id column
 *
 * @method     ChildExportDar requirePk($key, ?ConnectionInterface $con = null) Return the ChildExportDar by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportDar requireOne(?ConnectionInterface $con = null) Return the first ChildExportDar matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildExportDar requireOneByBuName(string $bu_name) Return the first ChildExportDar filtered by the bu_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportDar requireOneByZmManagerBranch(string $zm_manager_branch) Return the first ChildExportDar filtered by the zm_manager_branch column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportDar requireOneByZmManagerTown(string $zm_manager_town) Return the first ChildExportDar filtered by the zm_manager_town column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportDar requireOneByRmManagerBranch(string $rm_manager_branch) Return the first ChildExportDar filtered by the rm_manager_branch column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportDar requireOneByRmManagerTown(string $rm_manager_town) Return the first ChildExportDar filtered by the rm_manager_town column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportDar requireOneByAmManagerBranch(string $am_manager_branch) Return the first ChildExportDar filtered by the am_manager_branch column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportDar requireOneByAmManagerTown(string $am_manager_town) Return the first ChildExportDar filtered by the am_manager_town column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportDar requireOneByZmPositionCode(string $zm_position_code) Return the first ChildExportDar filtered by the zm_position_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportDar requireOneByRmPositionCode(string $rm_position_code) Return the first ChildExportDar filtered by the rm_position_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportDar requireOneByAmPositionCode(string $am_position_code) Return the first ChildExportDar filtered by the am_position_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportDar requireOneByEmpPositionCode(string $emp_position_code) Return the first ChildExportDar filtered by the emp_position_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportDar requireOneByEmpPositionName(string $emp_position_name) Return the first ChildExportDar filtered by the emp_position_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportDar requireOneByEmpLevel(string $emp_level) Return the first ChildExportDar filtered by the emp_level column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportDar requireOneByEmployeeCode(string $employee_code) Return the first ChildExportDar filtered by the employee_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportDar requireOneByEmployee(string $employee) Return the first ChildExportDar filtered by the employee column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportDar requireOneByJwEmployeeCode(string $jw_employee_code) Return the first ChildExportDar filtered by the jw_employee_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportDar requireOneByJwEmployee(string $jw_employee) Return the first ChildExportDar filtered by the jw_employee column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportDar requireOneByJwPositionName(string $jw_position_name) Return the first ChildExportDar filtered by the jw_position_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportDar requireOneByOutletType(string $outlet_type) Return the first ChildExportDar filtered by the outlet_type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportDar requireOneByOutletCode(string $outlet_code) Return the first ChildExportDar filtered by the outlet_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportDar requireOneByOutletName(string $outlet_name) Return the first ChildExportDar filtered by the outlet_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportDar requireOneByAgendacontroltype(string $agendacontroltype) Return the first ChildExportDar filtered by the agendacontroltype column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportDar requireOneByAgendname(string $agendname) Return the first ChildExportDar filtered by the agendname column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportDar requireOneByStownname(string $stownname) Return the first ChildExportDar filtered by the stownname column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportDar requireOneByDcrDate(string $dcr_date) Return the first ChildExportDar filtered by the dcr_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportDar requireOneByDcrStatus(string $dcr_status) Return the first ChildExportDar filtered by the dcr_status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportDar requireOneByNcaComments(string $nca_comments) Return the first ChildExportDar filtered by the nca_comments column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportDar requireOneByPlanned(string $planned) Return the first ChildExportDar filtered by the planned column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportDar requireOneByManagersName(string $managers_name) Return the first ChildExportDar filtered by the managers_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportDar requireOneByBrandsDetailedName(string $brands_detailed_name) Return the first ChildExportDar filtered by the brands_detailed_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportDar requireOneByEdDuration(int $ed_duration) Return the first ChildExportDar filtered by the ed_duration column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportDar requireOneByDateTime(string $datetime) Return the first ChildExportDar filtered by the datetime column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportDar requireOneByEmpTerritory(string $emp_territory) Return the first ChildExportDar filtered by the emp_territory column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportDar requireOneByEmpBranch(string $emp_branch) Return the first ChildExportDar filtered by the emp_branch column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportDar requireOneByEmpTown(string $emp_town) Return the first ChildExportDar filtered by the emp_town column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportDar requireOneByCustomerTown(string $customer_town) Return the first ChildExportDar filtered by the customer_town column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportDar requireOneByCustomerPatch(string $customer_patch) Return the first ChildExportDar filtered by the customer_patch column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportDar requireOneByLeaveTaken(string $leave_teken) Return the first ChildExportDar filtered by the leave_teken column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportDar requireOneByDcrId(int $dcr_id) Return the first ChildExportDar filtered by the dcr_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportDar requireOneByUpdatedAt(string $updated_at) Return the first ChildExportDar filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportDar requireOneByIsJw(string $isjw) Return the first ChildExportDar filtered by the isjw column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportDar requireOneBySgpiOut(string $sgpi_out) Return the first ChildExportDar filtered by the sgpi_out column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportDar requireOneByPobTotal(int $pob_total) Return the first ChildExportDar filtered by the pob_total column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportDar requireOneByOutletId(int $outlet_id) Return the first ChildExportDar filtered by the outlet_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildExportDar[]|Collection find(?ConnectionInterface $con = null) Return ChildExportDar objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildExportDar> find(?ConnectionInterface $con = null) Return ChildExportDar objects based on current ModelCriteria
 *
 * @method     ChildExportDar[]|Collection findByBuName(string|array<string> $bu_name) Return ChildExportDar objects filtered by the bu_name column
 * @psalm-method Collection&\Traversable<ChildExportDar> findByBuName(string|array<string> $bu_name) Return ChildExportDar objects filtered by the bu_name column
 * @method     ChildExportDar[]|Collection findByZmManagerBranch(string|array<string> $zm_manager_branch) Return ChildExportDar objects filtered by the zm_manager_branch column
 * @psalm-method Collection&\Traversable<ChildExportDar> findByZmManagerBranch(string|array<string> $zm_manager_branch) Return ChildExportDar objects filtered by the zm_manager_branch column
 * @method     ChildExportDar[]|Collection findByZmManagerTown(string|array<string> $zm_manager_town) Return ChildExportDar objects filtered by the zm_manager_town column
 * @psalm-method Collection&\Traversable<ChildExportDar> findByZmManagerTown(string|array<string> $zm_manager_town) Return ChildExportDar objects filtered by the zm_manager_town column
 * @method     ChildExportDar[]|Collection findByRmManagerBranch(string|array<string> $rm_manager_branch) Return ChildExportDar objects filtered by the rm_manager_branch column
 * @psalm-method Collection&\Traversable<ChildExportDar> findByRmManagerBranch(string|array<string> $rm_manager_branch) Return ChildExportDar objects filtered by the rm_manager_branch column
 * @method     ChildExportDar[]|Collection findByRmManagerTown(string|array<string> $rm_manager_town) Return ChildExportDar objects filtered by the rm_manager_town column
 * @psalm-method Collection&\Traversable<ChildExportDar> findByRmManagerTown(string|array<string> $rm_manager_town) Return ChildExportDar objects filtered by the rm_manager_town column
 * @method     ChildExportDar[]|Collection findByAmManagerBranch(string|array<string> $am_manager_branch) Return ChildExportDar objects filtered by the am_manager_branch column
 * @psalm-method Collection&\Traversable<ChildExportDar> findByAmManagerBranch(string|array<string> $am_manager_branch) Return ChildExportDar objects filtered by the am_manager_branch column
 * @method     ChildExportDar[]|Collection findByAmManagerTown(string|array<string> $am_manager_town) Return ChildExportDar objects filtered by the am_manager_town column
 * @psalm-method Collection&\Traversable<ChildExportDar> findByAmManagerTown(string|array<string> $am_manager_town) Return ChildExportDar objects filtered by the am_manager_town column
 * @method     ChildExportDar[]|Collection findByZmPositionCode(string|array<string> $zm_position_code) Return ChildExportDar objects filtered by the zm_position_code column
 * @psalm-method Collection&\Traversable<ChildExportDar> findByZmPositionCode(string|array<string> $zm_position_code) Return ChildExportDar objects filtered by the zm_position_code column
 * @method     ChildExportDar[]|Collection findByRmPositionCode(string|array<string> $rm_position_code) Return ChildExportDar objects filtered by the rm_position_code column
 * @psalm-method Collection&\Traversable<ChildExportDar> findByRmPositionCode(string|array<string> $rm_position_code) Return ChildExportDar objects filtered by the rm_position_code column
 * @method     ChildExportDar[]|Collection findByAmPositionCode(string|array<string> $am_position_code) Return ChildExportDar objects filtered by the am_position_code column
 * @psalm-method Collection&\Traversable<ChildExportDar> findByAmPositionCode(string|array<string> $am_position_code) Return ChildExportDar objects filtered by the am_position_code column
 * @method     ChildExportDar[]|Collection findByEmpPositionCode(string|array<string> $emp_position_code) Return ChildExportDar objects filtered by the emp_position_code column
 * @psalm-method Collection&\Traversable<ChildExportDar> findByEmpPositionCode(string|array<string> $emp_position_code) Return ChildExportDar objects filtered by the emp_position_code column
 * @method     ChildExportDar[]|Collection findByEmpPositionName(string|array<string> $emp_position_name) Return ChildExportDar objects filtered by the emp_position_name column
 * @psalm-method Collection&\Traversable<ChildExportDar> findByEmpPositionName(string|array<string> $emp_position_name) Return ChildExportDar objects filtered by the emp_position_name column
 * @method     ChildExportDar[]|Collection findByEmpLevel(string|array<string> $emp_level) Return ChildExportDar objects filtered by the emp_level column
 * @psalm-method Collection&\Traversable<ChildExportDar> findByEmpLevel(string|array<string> $emp_level) Return ChildExportDar objects filtered by the emp_level column
 * @method     ChildExportDar[]|Collection findByEmployeeCode(string|array<string> $employee_code) Return ChildExportDar objects filtered by the employee_code column
 * @psalm-method Collection&\Traversable<ChildExportDar> findByEmployeeCode(string|array<string> $employee_code) Return ChildExportDar objects filtered by the employee_code column
 * @method     ChildExportDar[]|Collection findByEmployee(string|array<string> $employee) Return ChildExportDar objects filtered by the employee column
 * @psalm-method Collection&\Traversable<ChildExportDar> findByEmployee(string|array<string> $employee) Return ChildExportDar objects filtered by the employee column
 * @method     ChildExportDar[]|Collection findByJwEmployeeCode(string|array<string> $jw_employee_code) Return ChildExportDar objects filtered by the jw_employee_code column
 * @psalm-method Collection&\Traversable<ChildExportDar> findByJwEmployeeCode(string|array<string> $jw_employee_code) Return ChildExportDar objects filtered by the jw_employee_code column
 * @method     ChildExportDar[]|Collection findByJwEmployee(string|array<string> $jw_employee) Return ChildExportDar objects filtered by the jw_employee column
 * @psalm-method Collection&\Traversable<ChildExportDar> findByJwEmployee(string|array<string> $jw_employee) Return ChildExportDar objects filtered by the jw_employee column
 * @method     ChildExportDar[]|Collection findByJwPositionName(string|array<string> $jw_position_name) Return ChildExportDar objects filtered by the jw_position_name column
 * @psalm-method Collection&\Traversable<ChildExportDar> findByJwPositionName(string|array<string> $jw_position_name) Return ChildExportDar objects filtered by the jw_position_name column
 * @method     ChildExportDar[]|Collection findByOutletType(string|array<string> $outlet_type) Return ChildExportDar objects filtered by the outlet_type column
 * @psalm-method Collection&\Traversable<ChildExportDar> findByOutletType(string|array<string> $outlet_type) Return ChildExportDar objects filtered by the outlet_type column
 * @method     ChildExportDar[]|Collection findByOutletCode(string|array<string> $outlet_code) Return ChildExportDar objects filtered by the outlet_code column
 * @psalm-method Collection&\Traversable<ChildExportDar> findByOutletCode(string|array<string> $outlet_code) Return ChildExportDar objects filtered by the outlet_code column
 * @method     ChildExportDar[]|Collection findByOutletName(string|array<string> $outlet_name) Return ChildExportDar objects filtered by the outlet_name column
 * @psalm-method Collection&\Traversable<ChildExportDar> findByOutletName(string|array<string> $outlet_name) Return ChildExportDar objects filtered by the outlet_name column
 * @method     ChildExportDar[]|Collection findByAgendacontroltype(string|array<string> $agendacontroltype) Return ChildExportDar objects filtered by the agendacontroltype column
 * @psalm-method Collection&\Traversable<ChildExportDar> findByAgendacontroltype(string|array<string> $agendacontroltype) Return ChildExportDar objects filtered by the agendacontroltype column
 * @method     ChildExportDar[]|Collection findByAgendname(string|array<string> $agendname) Return ChildExportDar objects filtered by the agendname column
 * @psalm-method Collection&\Traversable<ChildExportDar> findByAgendname(string|array<string> $agendname) Return ChildExportDar objects filtered by the agendname column
 * @method     ChildExportDar[]|Collection findByStownname(string|array<string> $stownname) Return ChildExportDar objects filtered by the stownname column
 * @psalm-method Collection&\Traversable<ChildExportDar> findByStownname(string|array<string> $stownname) Return ChildExportDar objects filtered by the stownname column
 * @method     ChildExportDar[]|Collection findByDcrDate(string|array<string> $dcr_date) Return ChildExportDar objects filtered by the dcr_date column
 * @psalm-method Collection&\Traversable<ChildExportDar> findByDcrDate(string|array<string> $dcr_date) Return ChildExportDar objects filtered by the dcr_date column
 * @method     ChildExportDar[]|Collection findByDcrStatus(string|array<string> $dcr_status) Return ChildExportDar objects filtered by the dcr_status column
 * @psalm-method Collection&\Traversable<ChildExportDar> findByDcrStatus(string|array<string> $dcr_status) Return ChildExportDar objects filtered by the dcr_status column
 * @method     ChildExportDar[]|Collection findByNcaComments(string|array<string> $nca_comments) Return ChildExportDar objects filtered by the nca_comments column
 * @psalm-method Collection&\Traversable<ChildExportDar> findByNcaComments(string|array<string> $nca_comments) Return ChildExportDar objects filtered by the nca_comments column
 * @method     ChildExportDar[]|Collection findByPlanned(string|array<string> $planned) Return ChildExportDar objects filtered by the planned column
 * @psalm-method Collection&\Traversable<ChildExportDar> findByPlanned(string|array<string> $planned) Return ChildExportDar objects filtered by the planned column
 * @method     ChildExportDar[]|Collection findByManagersName(string|array<string> $managers_name) Return ChildExportDar objects filtered by the managers_name column
 * @psalm-method Collection&\Traversable<ChildExportDar> findByManagersName(string|array<string> $managers_name) Return ChildExportDar objects filtered by the managers_name column
 * @method     ChildExportDar[]|Collection findByBrandsDetailedName(string|array<string> $brands_detailed_name) Return ChildExportDar objects filtered by the brands_detailed_name column
 * @psalm-method Collection&\Traversable<ChildExportDar> findByBrandsDetailedName(string|array<string> $brands_detailed_name) Return ChildExportDar objects filtered by the brands_detailed_name column
 * @method     ChildExportDar[]|Collection findByEdDuration(int|array<int> $ed_duration) Return ChildExportDar objects filtered by the ed_duration column
 * @psalm-method Collection&\Traversable<ChildExportDar> findByEdDuration(int|array<int> $ed_duration) Return ChildExportDar objects filtered by the ed_duration column
 * @method     ChildExportDar[]|Collection findByDateTime(string|array<string> $datetime) Return ChildExportDar objects filtered by the datetime column
 * @psalm-method Collection&\Traversable<ChildExportDar> findByDateTime(string|array<string> $datetime) Return ChildExportDar objects filtered by the datetime column
 * @method     ChildExportDar[]|Collection findByEmpTerritory(string|array<string> $emp_territory) Return ChildExportDar objects filtered by the emp_territory column
 * @psalm-method Collection&\Traversable<ChildExportDar> findByEmpTerritory(string|array<string> $emp_territory) Return ChildExportDar objects filtered by the emp_territory column
 * @method     ChildExportDar[]|Collection findByEmpBranch(string|array<string> $emp_branch) Return ChildExportDar objects filtered by the emp_branch column
 * @psalm-method Collection&\Traversable<ChildExportDar> findByEmpBranch(string|array<string> $emp_branch) Return ChildExportDar objects filtered by the emp_branch column
 * @method     ChildExportDar[]|Collection findByEmpTown(string|array<string> $emp_town) Return ChildExportDar objects filtered by the emp_town column
 * @psalm-method Collection&\Traversable<ChildExportDar> findByEmpTown(string|array<string> $emp_town) Return ChildExportDar objects filtered by the emp_town column
 * @method     ChildExportDar[]|Collection findByCustomerTown(string|array<string> $customer_town) Return ChildExportDar objects filtered by the customer_town column
 * @psalm-method Collection&\Traversable<ChildExportDar> findByCustomerTown(string|array<string> $customer_town) Return ChildExportDar objects filtered by the customer_town column
 * @method     ChildExportDar[]|Collection findByCustomerPatch(string|array<string> $customer_patch) Return ChildExportDar objects filtered by the customer_patch column
 * @psalm-method Collection&\Traversable<ChildExportDar> findByCustomerPatch(string|array<string> $customer_patch) Return ChildExportDar objects filtered by the customer_patch column
 * @method     ChildExportDar[]|Collection findByLeaveTaken(string|array<string> $leave_teken) Return ChildExportDar objects filtered by the leave_teken column
 * @psalm-method Collection&\Traversable<ChildExportDar> findByLeaveTaken(string|array<string> $leave_teken) Return ChildExportDar objects filtered by the leave_teken column
 * @method     ChildExportDar[]|Collection findByDcrId(int|array<int> $dcr_id) Return ChildExportDar objects filtered by the dcr_id column
 * @psalm-method Collection&\Traversable<ChildExportDar> findByDcrId(int|array<int> $dcr_id) Return ChildExportDar objects filtered by the dcr_id column
 * @method     ChildExportDar[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildExportDar objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildExportDar> findByUpdatedAt(string|array<string> $updated_at) Return ChildExportDar objects filtered by the updated_at column
 * @method     ChildExportDar[]|Collection findByIsJw(string|array<string> $isjw) Return ChildExportDar objects filtered by the isjw column
 * @psalm-method Collection&\Traversable<ChildExportDar> findByIsJw(string|array<string> $isjw) Return ChildExportDar objects filtered by the isjw column
 * @method     ChildExportDar[]|Collection findBySgpiOut(string|array<string> $sgpi_out) Return ChildExportDar objects filtered by the sgpi_out column
 * @psalm-method Collection&\Traversable<ChildExportDar> findBySgpiOut(string|array<string> $sgpi_out) Return ChildExportDar objects filtered by the sgpi_out column
 * @method     ChildExportDar[]|Collection findByPobTotal(int|array<int> $pob_total) Return ChildExportDar objects filtered by the pob_total column
 * @psalm-method Collection&\Traversable<ChildExportDar> findByPobTotal(int|array<int> $pob_total) Return ChildExportDar objects filtered by the pob_total column
 * @method     ChildExportDar[]|Collection findByOutletId(int|array<int> $outlet_id) Return ChildExportDar objects filtered by the outlet_id column
 * @psalm-method Collection&\Traversable<ChildExportDar> findByOutletId(int|array<int> $outlet_id) Return ChildExportDar objects filtered by the outlet_id column
 *
 * @method     ChildExportDar[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildExportDar> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class ExportDarQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\ExportDarQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\ExportDar', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildExportDarQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildExportDarQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildExportDarQuery) {
            return $criteria;
        }
        $query = new ChildExportDarQuery();
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
     * @return ChildExportDar|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        throw new LogicException('The ExportDar object has no primary key');
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
        throw new LogicException('The ExportDar object has no primary key');
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
        throw new LogicException('The ExportDar object has no primary key');
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
        throw new LogicException('The ExportDar object has no primary key');
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

        $this->addUsingAlias(ExportDarTableMap::COL_BU_NAME, $buName, $comparison);

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

        $this->addUsingAlias(ExportDarTableMap::COL_ZM_MANAGER_BRANCH, $zmManagerBranch, $comparison);

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

        $this->addUsingAlias(ExportDarTableMap::COL_ZM_MANAGER_TOWN, $zmManagerTown, $comparison);

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

        $this->addUsingAlias(ExportDarTableMap::COL_RM_MANAGER_BRANCH, $rmManagerBranch, $comparison);

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

        $this->addUsingAlias(ExportDarTableMap::COL_RM_MANAGER_TOWN, $rmManagerTown, $comparison);

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

        $this->addUsingAlias(ExportDarTableMap::COL_AM_MANAGER_BRANCH, $amManagerBranch, $comparison);

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

        $this->addUsingAlias(ExportDarTableMap::COL_AM_MANAGER_TOWN, $amManagerTown, $comparison);

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

        $this->addUsingAlias(ExportDarTableMap::COL_ZM_POSITION_CODE, $zmPositionCode, $comparison);

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

        $this->addUsingAlias(ExportDarTableMap::COL_RM_POSITION_CODE, $rmPositionCode, $comparison);

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

        $this->addUsingAlias(ExportDarTableMap::COL_AM_POSITION_CODE, $amPositionCode, $comparison);

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

        $this->addUsingAlias(ExportDarTableMap::COL_EMP_POSITION_CODE, $empPositionCode, $comparison);

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

        $this->addUsingAlias(ExportDarTableMap::COL_EMP_POSITION_NAME, $empPositionName, $comparison);

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

        $this->addUsingAlias(ExportDarTableMap::COL_EMP_LEVEL, $empLevel, $comparison);

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

        $this->addUsingAlias(ExportDarTableMap::COL_EMPLOYEE_CODE, $employeeCode, $comparison);

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

        $this->addUsingAlias(ExportDarTableMap::COL_EMPLOYEE, $employee, $comparison);

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

        $this->addUsingAlias(ExportDarTableMap::COL_JW_EMPLOYEE_CODE, $jwEmployeeCode, $comparison);

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

        $this->addUsingAlias(ExportDarTableMap::COL_JW_EMPLOYEE, $jwEmployee, $comparison);

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

        $this->addUsingAlias(ExportDarTableMap::COL_JW_POSITION_NAME, $jwPositionName, $comparison);

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

        $this->addUsingAlias(ExportDarTableMap::COL_OUTLET_TYPE, $outletType, $comparison);

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

        $this->addUsingAlias(ExportDarTableMap::COL_OUTLET_CODE, $outletCode, $comparison);

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

        $this->addUsingAlias(ExportDarTableMap::COL_OUTLET_NAME, $outletName, $comparison);

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

        $this->addUsingAlias(ExportDarTableMap::COL_AGENDACONTROLTYPE, $agendacontroltype, $comparison);

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

        $this->addUsingAlias(ExportDarTableMap::COL_AGENDNAME, $agendname, $comparison);

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

        $this->addUsingAlias(ExportDarTableMap::COL_STOWNNAME, $stownname, $comparison);

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
                $this->addUsingAlias(ExportDarTableMap::COL_DCR_DATE, $dcrDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dcrDate['max'])) {
                $this->addUsingAlias(ExportDarTableMap::COL_DCR_DATE, $dcrDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportDarTableMap::COL_DCR_DATE, $dcrDate, $comparison);

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

        $this->addUsingAlias(ExportDarTableMap::COL_DCR_STATUS, $dcrStatus, $comparison);

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

        $this->addUsingAlias(ExportDarTableMap::COL_NCA_COMMENTS, $ncaComments, $comparison);

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

        $this->addUsingAlias(ExportDarTableMap::COL_PLANNED, $planned, $comparison);

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

        $this->addUsingAlias(ExportDarTableMap::COL_MANAGERS_NAME, $managersName, $comparison);

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

        $this->addUsingAlias(ExportDarTableMap::COL_BRANDS_DETAILED_NAME, $brandsDetailedName, $comparison);

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
                $this->addUsingAlias(ExportDarTableMap::COL_ED_DURATION, $edDuration['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($edDuration['max'])) {
                $this->addUsingAlias(ExportDarTableMap::COL_ED_DURATION, $edDuration['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportDarTableMap::COL_ED_DURATION, $edDuration, $comparison);

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
                $this->addUsingAlias(ExportDarTableMap::COL_DATETIME, $dateTime['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dateTime['max'])) {
                $this->addUsingAlias(ExportDarTableMap::COL_DATETIME, $dateTime['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportDarTableMap::COL_DATETIME, $dateTime, $comparison);

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

        $this->addUsingAlias(ExportDarTableMap::COL_EMP_TERRITORY, $empTerritory, $comparison);

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

        $this->addUsingAlias(ExportDarTableMap::COL_EMP_BRANCH, $empBranch, $comparison);

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

        $this->addUsingAlias(ExportDarTableMap::COL_EMP_TOWN, $empTown, $comparison);

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

        $this->addUsingAlias(ExportDarTableMap::COL_CUSTOMER_TOWN, $customerTown, $comparison);

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

        $this->addUsingAlias(ExportDarTableMap::COL_CUSTOMER_PATCH, $customerPatch, $comparison);

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

        $this->addUsingAlias(ExportDarTableMap::COL_LEAVE_TEKEN, $leaveTaken, $comparison);

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
                $this->addUsingAlias(ExportDarTableMap::COL_DCR_ID, $dcrId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dcrId['max'])) {
                $this->addUsingAlias(ExportDarTableMap::COL_DCR_ID, $dcrId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportDarTableMap::COL_DCR_ID, $dcrId, $comparison);

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
                $this->addUsingAlias(ExportDarTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(ExportDarTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportDarTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the isjw column
     *
     * Example usage:
     * <code>
     * $query->filterByIsJw('fooValue');   // WHERE isjw = 'fooValue'
     * $query->filterByIsJw('%fooValue%', Criteria::LIKE); // WHERE isjw LIKE '%fooValue%'
     * $query->filterByIsJw(['foo', 'bar']); // WHERE isjw IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $isJw The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIsJw($isJw = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($isJw)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportDarTableMap::COL_ISJW, $isJw, $comparison);

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

        $this->addUsingAlias(ExportDarTableMap::COL_SGPI_OUT, $sgpiOut, $comparison);

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
                $this->addUsingAlias(ExportDarTableMap::COL_POB_TOTAL, $pobTotal['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($pobTotal['max'])) {
                $this->addUsingAlias(ExportDarTableMap::COL_POB_TOTAL, $pobTotal['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportDarTableMap::COL_POB_TOTAL, $pobTotal, $comparison);

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
                $this->addUsingAlias(ExportDarTableMap::COL_OUTLET_ID, $outletId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outletId['max'])) {
                $this->addUsingAlias(ExportDarTableMap::COL_OUTLET_ID, $outletId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportDarTableMap::COL_OUTLET_ID, $outletId, $comparison);

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildExportDar $exportDar Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($exportDar = null)
    {
        if ($exportDar) {
            throw new LogicException('ExportDar object has no primary key');

        }

        return $this;
    }

}
