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
use entities\Expenses as ChildExpenses;
use entities\ExpensesQuery as ChildExpensesQuery;
use entities\Map\ExpensesTableMap;

/**
 * Base class that represents a query for the `expenses` table.
 *
 * @method     ChildExpensesQuery orderByExpId($order = Criteria::ASC) Order by the exp_id column
 * @method     ChildExpensesQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildExpensesQuery orderByExpenseDate($order = Criteria::ASC) Order by the expense_date column
 * @method     ChildExpensesQuery orderByBudgetId($order = Criteria::ASC) Order by the budget_id column
 * @method     ChildExpensesQuery orderByExpenseTrip($order = Criteria::ASC) Order by the expense_trip column
 * @method     ChildExpensesQuery orderByExpensePlacewrk($order = Criteria::ASC) Order by the expense_placewrk column
 * @method     ChildExpensesQuery orderByExpenseReqAmt($order = Criteria::ASC) Order by the expense_req_amt column
 * @method     ChildExpensesQuery orderByExpenseApprovedAmt($order = Criteria::ASC) Order by the expense_approved_amt column
 * @method     ChildExpensesQuery orderByExpenseAdditionalAmt($order = Criteria::ASC) Order by the expense_additional_amt column
 * @method     ChildExpensesQuery orderByExpenseTaxAmt($order = Criteria::ASC) Order by the expense_tax_amt column
 * @method     ChildExpensesQuery orderByExpenseFinalAmt($order = Criteria::ASC) Order by the expense_final_amt column
 * @method     ChildExpensesQuery orderByExpenseStatus($order = Criteria::ASC) Order by the expense_status column
 * @method     ChildExpensesQuery orderByEmployeeId($order = Criteria::ASC) Order by the employee_id column
 * @method     ChildExpensesQuery orderByExpenseMode($order = Criteria::ASC) Order by the expense_mode column
 * @method     ChildExpensesQuery orderByExpenseNote($order = Criteria::ASC) Order by the expense_note column
 * @method     ChildExpensesQuery orderByOrgunitId($order = Criteria::ASC) Order by the orgunit_id column
 * @method     ChildExpensesQuery orderByTripCurrency($order = Criteria::ASC) Order by the trip_currency column
 * @method     ChildExpensesQuery orderByReadflag($order = Criteria::ASC) Order by the readflag column
 * @method     ChildExpensesQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildExpensesQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildExpensesQuery orderByPin($order = Criteria::ASC) Order by the pin column
 * @method     ChildExpensesQuery orderByDeviceName($order = Criteria::ASC) Order by the device_name column
 * @method     ChildExpensesQuery orderByDeviceBattery($order = Criteria::ASC) Order by the device_battery column
 * @method     ChildExpensesQuery orderByDeviceTime($order = Criteria::ASC) Order by the device_time column
 * @method     ChildExpensesQuery orderBySettledAmount($order = Criteria::ASC) Order by the settled_amount column
 * @method     ChildExpensesQuery orderBySettledDate($order = Criteria::ASC) Order by the settled_date column
 * @method     ChildExpensesQuery orderBySettledDesc($order = Criteria::ASC) Order by the settled_desc column
 * @method     ChildExpensesQuery orderByTripType($order = Criteria::ASC) Order by the trip_type column
 * @method     ChildExpensesQuery orderByDoVerify($order = Criteria::ASC) Order by the do_verify column
 *
 * @method     ChildExpensesQuery groupByExpId() Group by the exp_id column
 * @method     ChildExpensesQuery groupByCompanyId() Group by the company_id column
 * @method     ChildExpensesQuery groupByExpenseDate() Group by the expense_date column
 * @method     ChildExpensesQuery groupByBudgetId() Group by the budget_id column
 * @method     ChildExpensesQuery groupByExpenseTrip() Group by the expense_trip column
 * @method     ChildExpensesQuery groupByExpensePlacewrk() Group by the expense_placewrk column
 * @method     ChildExpensesQuery groupByExpenseReqAmt() Group by the expense_req_amt column
 * @method     ChildExpensesQuery groupByExpenseApprovedAmt() Group by the expense_approved_amt column
 * @method     ChildExpensesQuery groupByExpenseAdditionalAmt() Group by the expense_additional_amt column
 * @method     ChildExpensesQuery groupByExpenseTaxAmt() Group by the expense_tax_amt column
 * @method     ChildExpensesQuery groupByExpenseFinalAmt() Group by the expense_final_amt column
 * @method     ChildExpensesQuery groupByExpenseStatus() Group by the expense_status column
 * @method     ChildExpensesQuery groupByEmployeeId() Group by the employee_id column
 * @method     ChildExpensesQuery groupByExpenseMode() Group by the expense_mode column
 * @method     ChildExpensesQuery groupByExpenseNote() Group by the expense_note column
 * @method     ChildExpensesQuery groupByOrgunitId() Group by the orgunit_id column
 * @method     ChildExpensesQuery groupByTripCurrency() Group by the trip_currency column
 * @method     ChildExpensesQuery groupByReadflag() Group by the readflag column
 * @method     ChildExpensesQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildExpensesQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildExpensesQuery groupByPin() Group by the pin column
 * @method     ChildExpensesQuery groupByDeviceName() Group by the device_name column
 * @method     ChildExpensesQuery groupByDeviceBattery() Group by the device_battery column
 * @method     ChildExpensesQuery groupByDeviceTime() Group by the device_time column
 * @method     ChildExpensesQuery groupBySettledAmount() Group by the settled_amount column
 * @method     ChildExpensesQuery groupBySettledDate() Group by the settled_date column
 * @method     ChildExpensesQuery groupBySettledDesc() Group by the settled_desc column
 * @method     ChildExpensesQuery groupByTripType() Group by the trip_type column
 * @method     ChildExpensesQuery groupByDoVerify() Group by the do_verify column
 *
 * @method     ChildExpensesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildExpensesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildExpensesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildExpensesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildExpensesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildExpensesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildExpensesQuery leftJoinBudgetGroup($relationAlias = null) Adds a LEFT JOIN clause to the query using the BudgetGroup relation
 * @method     ChildExpensesQuery rightJoinBudgetGroup($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BudgetGroup relation
 * @method     ChildExpensesQuery innerJoinBudgetGroup($relationAlias = null) Adds a INNER JOIN clause to the query using the BudgetGroup relation
 *
 * @method     ChildExpensesQuery joinWithBudgetGroup($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BudgetGroup relation
 *
 * @method     ChildExpensesQuery leftJoinWithBudgetGroup() Adds a LEFT JOIN clause and with to the query using the BudgetGroup relation
 * @method     ChildExpensesQuery rightJoinWithBudgetGroup() Adds a RIGHT JOIN clause and with to the query using the BudgetGroup relation
 * @method     ChildExpensesQuery innerJoinWithBudgetGroup() Adds a INNER JOIN clause and with to the query using the BudgetGroup relation
 *
 * @method     ChildExpensesQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildExpensesQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildExpensesQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildExpensesQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildExpensesQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildExpensesQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildExpensesQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     ChildExpensesQuery leftJoinCurrencies($relationAlias = null) Adds a LEFT JOIN clause to the query using the Currencies relation
 * @method     ChildExpensesQuery rightJoinCurrencies($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Currencies relation
 * @method     ChildExpensesQuery innerJoinCurrencies($relationAlias = null) Adds a INNER JOIN clause to the query using the Currencies relation
 *
 * @method     ChildExpensesQuery joinWithCurrencies($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Currencies relation
 *
 * @method     ChildExpensesQuery leftJoinWithCurrencies() Adds a LEFT JOIN clause and with to the query using the Currencies relation
 * @method     ChildExpensesQuery rightJoinWithCurrencies() Adds a RIGHT JOIN clause and with to the query using the Currencies relation
 * @method     ChildExpensesQuery innerJoinWithCurrencies() Adds a INNER JOIN clause and with to the query using the Currencies relation
 *
 * @method     ChildExpensesQuery leftJoinEmployee($relationAlias = null) Adds a LEFT JOIN clause to the query using the Employee relation
 * @method     ChildExpensesQuery rightJoinEmployee($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Employee relation
 * @method     ChildExpensesQuery innerJoinEmployee($relationAlias = null) Adds a INNER JOIN clause to the query using the Employee relation
 *
 * @method     ChildExpensesQuery joinWithEmployee($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Employee relation
 *
 * @method     ChildExpensesQuery leftJoinWithEmployee() Adds a LEFT JOIN clause and with to the query using the Employee relation
 * @method     ChildExpensesQuery rightJoinWithEmployee() Adds a RIGHT JOIN clause and with to the query using the Employee relation
 * @method     ChildExpensesQuery innerJoinWithEmployee() Adds a INNER JOIN clause and with to the query using the Employee relation
 *
 * @method     ChildExpensesQuery leftJoinOrgUnit($relationAlias = null) Adds a LEFT JOIN clause to the query using the OrgUnit relation
 * @method     ChildExpensesQuery rightJoinOrgUnit($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OrgUnit relation
 * @method     ChildExpensesQuery innerJoinOrgUnit($relationAlias = null) Adds a INNER JOIN clause to the query using the OrgUnit relation
 *
 * @method     ChildExpensesQuery joinWithOrgUnit($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OrgUnit relation
 *
 * @method     ChildExpensesQuery leftJoinWithOrgUnit() Adds a LEFT JOIN clause and with to the query using the OrgUnit relation
 * @method     ChildExpensesQuery rightJoinWithOrgUnit() Adds a RIGHT JOIN clause and with to the query using the OrgUnit relation
 * @method     ChildExpensesQuery innerJoinWithOrgUnit() Adds a INNER JOIN clause and with to the query using the OrgUnit relation
 *
 * @method     ChildExpensesQuery leftJoinAttendance($relationAlias = null) Adds a LEFT JOIN clause to the query using the Attendance relation
 * @method     ChildExpensesQuery rightJoinAttendance($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Attendance relation
 * @method     ChildExpensesQuery innerJoinAttendance($relationAlias = null) Adds a INNER JOIN clause to the query using the Attendance relation
 *
 * @method     ChildExpensesQuery joinWithAttendance($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Attendance relation
 *
 * @method     ChildExpensesQuery leftJoinWithAttendance() Adds a LEFT JOIN clause and with to the query using the Attendance relation
 * @method     ChildExpensesQuery rightJoinWithAttendance() Adds a RIGHT JOIN clause and with to the query using the Attendance relation
 * @method     ChildExpensesQuery innerJoinWithAttendance() Adds a INNER JOIN clause and with to the query using the Attendance relation
 *
 * @method     ChildExpensesQuery leftJoinEmployeeWorkLog($relationAlias = null) Adds a LEFT JOIN clause to the query using the EmployeeWorkLog relation
 * @method     ChildExpensesQuery rightJoinEmployeeWorkLog($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EmployeeWorkLog relation
 * @method     ChildExpensesQuery innerJoinEmployeeWorkLog($relationAlias = null) Adds a INNER JOIN clause to the query using the EmployeeWorkLog relation
 *
 * @method     ChildExpensesQuery joinWithEmployeeWorkLog($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the EmployeeWorkLog relation
 *
 * @method     ChildExpensesQuery leftJoinWithEmployeeWorkLog() Adds a LEFT JOIN clause and with to the query using the EmployeeWorkLog relation
 * @method     ChildExpensesQuery rightJoinWithEmployeeWorkLog() Adds a RIGHT JOIN clause and with to the query using the EmployeeWorkLog relation
 * @method     ChildExpensesQuery innerJoinWithEmployeeWorkLog() Adds a INNER JOIN clause and with to the query using the EmployeeWorkLog relation
 *
 * @method     ChildExpensesQuery leftJoinExpenseFiles($relationAlias = null) Adds a LEFT JOIN clause to the query using the ExpenseFiles relation
 * @method     ChildExpensesQuery rightJoinExpenseFiles($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ExpenseFiles relation
 * @method     ChildExpensesQuery innerJoinExpenseFiles($relationAlias = null) Adds a INNER JOIN clause to the query using the ExpenseFiles relation
 *
 * @method     ChildExpensesQuery joinWithExpenseFiles($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ExpenseFiles relation
 *
 * @method     ChildExpensesQuery leftJoinWithExpenseFiles() Adds a LEFT JOIN clause and with to the query using the ExpenseFiles relation
 * @method     ChildExpensesQuery rightJoinWithExpenseFiles() Adds a RIGHT JOIN clause and with to the query using the ExpenseFiles relation
 * @method     ChildExpensesQuery innerJoinWithExpenseFiles() Adds a INNER JOIN clause and with to the query using the ExpenseFiles relation
 *
 * @method     ChildExpensesQuery leftJoinExpenseList($relationAlias = null) Adds a LEFT JOIN clause to the query using the ExpenseList relation
 * @method     ChildExpensesQuery rightJoinExpenseList($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ExpenseList relation
 * @method     ChildExpensesQuery innerJoinExpenseList($relationAlias = null) Adds a INNER JOIN clause to the query using the ExpenseList relation
 *
 * @method     ChildExpensesQuery joinWithExpenseList($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ExpenseList relation
 *
 * @method     ChildExpensesQuery leftJoinWithExpenseList() Adds a LEFT JOIN clause and with to the query using the ExpenseList relation
 * @method     ChildExpensesQuery rightJoinWithExpenseList() Adds a RIGHT JOIN clause and with to the query using the ExpenseList relation
 * @method     ChildExpensesQuery innerJoinWithExpenseList() Adds a INNER JOIN clause and with to the query using the ExpenseList relation
 *
 * @method     \entities\BudgetGroupQuery|\entities\CompanyQuery|\entities\CurrenciesQuery|\entities\EmployeeQuery|\entities\OrgUnitQuery|\entities\AttendanceQuery|\entities\EmployeeWorkLogQuery|\entities\ExpenseFilesQuery|\entities\ExpenseListQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildExpenses|null findOne(?ConnectionInterface $con = null) Return the first ChildExpenses matching the query
 * @method     ChildExpenses findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildExpenses matching the query, or a new ChildExpenses object populated from the query conditions when no match is found
 *
 * @method     ChildExpenses|null findOneByExpId(int $exp_id) Return the first ChildExpenses filtered by the exp_id column
 * @method     ChildExpenses|null findOneByCompanyId(int $company_id) Return the first ChildExpenses filtered by the company_id column
 * @method     ChildExpenses|null findOneByExpenseDate(string $expense_date) Return the first ChildExpenses filtered by the expense_date column
 * @method     ChildExpenses|null findOneByBudgetId(int $budget_id) Return the first ChildExpenses filtered by the budget_id column
 * @method     ChildExpenses|null findOneByExpenseTrip(int $expense_trip) Return the first ChildExpenses filtered by the expense_trip column
 * @method     ChildExpenses|null findOneByExpensePlacewrk(string $expense_placewrk) Return the first ChildExpenses filtered by the expense_placewrk column
 * @method     ChildExpenses|null findOneByExpenseReqAmt(string $expense_req_amt) Return the first ChildExpenses filtered by the expense_req_amt column
 * @method     ChildExpenses|null findOneByExpenseApprovedAmt(string $expense_approved_amt) Return the first ChildExpenses filtered by the expense_approved_amt column
 * @method     ChildExpenses|null findOneByExpenseAdditionalAmt(string $expense_additional_amt) Return the first ChildExpenses filtered by the expense_additional_amt column
 * @method     ChildExpenses|null findOneByExpenseTaxAmt(string $expense_tax_amt) Return the first ChildExpenses filtered by the expense_tax_amt column
 * @method     ChildExpenses|null findOneByExpenseFinalAmt(string $expense_final_amt) Return the first ChildExpenses filtered by the expense_final_amt column
 * @method     ChildExpenses|null findOneByExpenseStatus(int $expense_status) Return the first ChildExpenses filtered by the expense_status column
 * @method     ChildExpenses|null findOneByEmployeeId(int $employee_id) Return the first ChildExpenses filtered by the employee_id column
 * @method     ChildExpenses|null findOneByExpenseMode(int $expense_mode) Return the first ChildExpenses filtered by the expense_mode column
 * @method     ChildExpenses|null findOneByExpenseNote(string $expense_note) Return the first ChildExpenses filtered by the expense_note column
 * @method     ChildExpenses|null findOneByOrgunitId(int $orgunit_id) Return the first ChildExpenses filtered by the orgunit_id column
 * @method     ChildExpenses|null findOneByTripCurrency(int $trip_currency) Return the first ChildExpenses filtered by the trip_currency column
 * @method     ChildExpenses|null findOneByReadflag(int $readflag) Return the first ChildExpenses filtered by the readflag column
 * @method     ChildExpenses|null findOneByCreatedAt(string $created_at) Return the first ChildExpenses filtered by the created_at column
 * @method     ChildExpenses|null findOneByUpdatedAt(string $updated_at) Return the first ChildExpenses filtered by the updated_at column
 * @method     ChildExpenses|null findOneByPin(string $pin) Return the first ChildExpenses filtered by the pin column
 * @method     ChildExpenses|null findOneByDeviceName(string $device_name) Return the first ChildExpenses filtered by the device_name column
 * @method     ChildExpenses|null findOneByDeviceBattery(string $device_battery) Return the first ChildExpenses filtered by the device_battery column
 * @method     ChildExpenses|null findOneByDeviceTime(string $device_time) Return the first ChildExpenses filtered by the device_time column
 * @method     ChildExpenses|null findOneBySettledAmount(string $settled_amount) Return the first ChildExpenses filtered by the settled_amount column
 * @method     ChildExpenses|null findOneBySettledDate(string $settled_date) Return the first ChildExpenses filtered by the settled_date column
 * @method     ChildExpenses|null findOneBySettledDesc(string $settled_desc) Return the first ChildExpenses filtered by the settled_desc column
 * @method     ChildExpenses|null findOneByTripType(string $trip_type) Return the first ChildExpenses filtered by the trip_type column
 * @method     ChildExpenses|null findOneByDoVerify(boolean $do_verify) Return the first ChildExpenses filtered by the do_verify column
 *
 * @method     ChildExpenses requirePk($key, ?ConnectionInterface $con = null) Return the ChildExpenses by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenses requireOne(?ConnectionInterface $con = null) Return the first ChildExpenses matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildExpenses requireOneByExpId(int $exp_id) Return the first ChildExpenses filtered by the exp_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenses requireOneByCompanyId(int $company_id) Return the first ChildExpenses filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenses requireOneByExpenseDate(string $expense_date) Return the first ChildExpenses filtered by the expense_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenses requireOneByBudgetId(int $budget_id) Return the first ChildExpenses filtered by the budget_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenses requireOneByExpenseTrip(int $expense_trip) Return the first ChildExpenses filtered by the expense_trip column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenses requireOneByExpensePlacewrk(string $expense_placewrk) Return the first ChildExpenses filtered by the expense_placewrk column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenses requireOneByExpenseReqAmt(string $expense_req_amt) Return the first ChildExpenses filtered by the expense_req_amt column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenses requireOneByExpenseApprovedAmt(string $expense_approved_amt) Return the first ChildExpenses filtered by the expense_approved_amt column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenses requireOneByExpenseAdditionalAmt(string $expense_additional_amt) Return the first ChildExpenses filtered by the expense_additional_amt column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenses requireOneByExpenseTaxAmt(string $expense_tax_amt) Return the first ChildExpenses filtered by the expense_tax_amt column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenses requireOneByExpenseFinalAmt(string $expense_final_amt) Return the first ChildExpenses filtered by the expense_final_amt column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenses requireOneByExpenseStatus(int $expense_status) Return the first ChildExpenses filtered by the expense_status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenses requireOneByEmployeeId(int $employee_id) Return the first ChildExpenses filtered by the employee_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenses requireOneByExpenseMode(int $expense_mode) Return the first ChildExpenses filtered by the expense_mode column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenses requireOneByExpenseNote(string $expense_note) Return the first ChildExpenses filtered by the expense_note column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenses requireOneByOrgunitId(int $orgunit_id) Return the first ChildExpenses filtered by the orgunit_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenses requireOneByTripCurrency(int $trip_currency) Return the first ChildExpenses filtered by the trip_currency column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenses requireOneByReadflag(int $readflag) Return the first ChildExpenses filtered by the readflag column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenses requireOneByCreatedAt(string $created_at) Return the first ChildExpenses filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenses requireOneByUpdatedAt(string $updated_at) Return the first ChildExpenses filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenses requireOneByPin(string $pin) Return the first ChildExpenses filtered by the pin column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenses requireOneByDeviceName(string $device_name) Return the first ChildExpenses filtered by the device_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenses requireOneByDeviceBattery(string $device_battery) Return the first ChildExpenses filtered by the device_battery column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenses requireOneByDeviceTime(string $device_time) Return the first ChildExpenses filtered by the device_time column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenses requireOneBySettledAmount(string $settled_amount) Return the first ChildExpenses filtered by the settled_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenses requireOneBySettledDate(string $settled_date) Return the first ChildExpenses filtered by the settled_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenses requireOneBySettledDesc(string $settled_desc) Return the first ChildExpenses filtered by the settled_desc column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenses requireOneByTripType(string $trip_type) Return the first ChildExpenses filtered by the trip_type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenses requireOneByDoVerify(boolean $do_verify) Return the first ChildExpenses filtered by the do_verify column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildExpenses[]|Collection find(?ConnectionInterface $con = null) Return ChildExpenses objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildExpenses> find(?ConnectionInterface $con = null) Return ChildExpenses objects based on current ModelCriteria
 *
 * @method     ChildExpenses[]|Collection findByExpId(int|array<int> $exp_id) Return ChildExpenses objects filtered by the exp_id column
 * @psalm-method Collection&\Traversable<ChildExpenses> findByExpId(int|array<int> $exp_id) Return ChildExpenses objects filtered by the exp_id column
 * @method     ChildExpenses[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildExpenses objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildExpenses> findByCompanyId(int|array<int> $company_id) Return ChildExpenses objects filtered by the company_id column
 * @method     ChildExpenses[]|Collection findByExpenseDate(string|array<string> $expense_date) Return ChildExpenses objects filtered by the expense_date column
 * @psalm-method Collection&\Traversable<ChildExpenses> findByExpenseDate(string|array<string> $expense_date) Return ChildExpenses objects filtered by the expense_date column
 * @method     ChildExpenses[]|Collection findByBudgetId(int|array<int> $budget_id) Return ChildExpenses objects filtered by the budget_id column
 * @psalm-method Collection&\Traversable<ChildExpenses> findByBudgetId(int|array<int> $budget_id) Return ChildExpenses objects filtered by the budget_id column
 * @method     ChildExpenses[]|Collection findByExpenseTrip(int|array<int> $expense_trip) Return ChildExpenses objects filtered by the expense_trip column
 * @psalm-method Collection&\Traversable<ChildExpenses> findByExpenseTrip(int|array<int> $expense_trip) Return ChildExpenses objects filtered by the expense_trip column
 * @method     ChildExpenses[]|Collection findByExpensePlacewrk(string|array<string> $expense_placewrk) Return ChildExpenses objects filtered by the expense_placewrk column
 * @psalm-method Collection&\Traversable<ChildExpenses> findByExpensePlacewrk(string|array<string> $expense_placewrk) Return ChildExpenses objects filtered by the expense_placewrk column
 * @method     ChildExpenses[]|Collection findByExpenseReqAmt(string|array<string> $expense_req_amt) Return ChildExpenses objects filtered by the expense_req_amt column
 * @psalm-method Collection&\Traversable<ChildExpenses> findByExpenseReqAmt(string|array<string> $expense_req_amt) Return ChildExpenses objects filtered by the expense_req_amt column
 * @method     ChildExpenses[]|Collection findByExpenseApprovedAmt(string|array<string> $expense_approved_amt) Return ChildExpenses objects filtered by the expense_approved_amt column
 * @psalm-method Collection&\Traversable<ChildExpenses> findByExpenseApprovedAmt(string|array<string> $expense_approved_amt) Return ChildExpenses objects filtered by the expense_approved_amt column
 * @method     ChildExpenses[]|Collection findByExpenseAdditionalAmt(string|array<string> $expense_additional_amt) Return ChildExpenses objects filtered by the expense_additional_amt column
 * @psalm-method Collection&\Traversable<ChildExpenses> findByExpenseAdditionalAmt(string|array<string> $expense_additional_amt) Return ChildExpenses objects filtered by the expense_additional_amt column
 * @method     ChildExpenses[]|Collection findByExpenseTaxAmt(string|array<string> $expense_tax_amt) Return ChildExpenses objects filtered by the expense_tax_amt column
 * @psalm-method Collection&\Traversable<ChildExpenses> findByExpenseTaxAmt(string|array<string> $expense_tax_amt) Return ChildExpenses objects filtered by the expense_tax_amt column
 * @method     ChildExpenses[]|Collection findByExpenseFinalAmt(string|array<string> $expense_final_amt) Return ChildExpenses objects filtered by the expense_final_amt column
 * @psalm-method Collection&\Traversable<ChildExpenses> findByExpenseFinalAmt(string|array<string> $expense_final_amt) Return ChildExpenses objects filtered by the expense_final_amt column
 * @method     ChildExpenses[]|Collection findByExpenseStatus(int|array<int> $expense_status) Return ChildExpenses objects filtered by the expense_status column
 * @psalm-method Collection&\Traversable<ChildExpenses> findByExpenseStatus(int|array<int> $expense_status) Return ChildExpenses objects filtered by the expense_status column
 * @method     ChildExpenses[]|Collection findByEmployeeId(int|array<int> $employee_id) Return ChildExpenses objects filtered by the employee_id column
 * @psalm-method Collection&\Traversable<ChildExpenses> findByEmployeeId(int|array<int> $employee_id) Return ChildExpenses objects filtered by the employee_id column
 * @method     ChildExpenses[]|Collection findByExpenseMode(int|array<int> $expense_mode) Return ChildExpenses objects filtered by the expense_mode column
 * @psalm-method Collection&\Traversable<ChildExpenses> findByExpenseMode(int|array<int> $expense_mode) Return ChildExpenses objects filtered by the expense_mode column
 * @method     ChildExpenses[]|Collection findByExpenseNote(string|array<string> $expense_note) Return ChildExpenses objects filtered by the expense_note column
 * @psalm-method Collection&\Traversable<ChildExpenses> findByExpenseNote(string|array<string> $expense_note) Return ChildExpenses objects filtered by the expense_note column
 * @method     ChildExpenses[]|Collection findByOrgunitId(int|array<int> $orgunit_id) Return ChildExpenses objects filtered by the orgunit_id column
 * @psalm-method Collection&\Traversable<ChildExpenses> findByOrgunitId(int|array<int> $orgunit_id) Return ChildExpenses objects filtered by the orgunit_id column
 * @method     ChildExpenses[]|Collection findByTripCurrency(int|array<int> $trip_currency) Return ChildExpenses objects filtered by the trip_currency column
 * @psalm-method Collection&\Traversable<ChildExpenses> findByTripCurrency(int|array<int> $trip_currency) Return ChildExpenses objects filtered by the trip_currency column
 * @method     ChildExpenses[]|Collection findByReadflag(int|array<int> $readflag) Return ChildExpenses objects filtered by the readflag column
 * @psalm-method Collection&\Traversable<ChildExpenses> findByReadflag(int|array<int> $readflag) Return ChildExpenses objects filtered by the readflag column
 * @method     ChildExpenses[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildExpenses objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildExpenses> findByCreatedAt(string|array<string> $created_at) Return ChildExpenses objects filtered by the created_at column
 * @method     ChildExpenses[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildExpenses objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildExpenses> findByUpdatedAt(string|array<string> $updated_at) Return ChildExpenses objects filtered by the updated_at column
 * @method     ChildExpenses[]|Collection findByPin(string|array<string> $pin) Return ChildExpenses objects filtered by the pin column
 * @psalm-method Collection&\Traversable<ChildExpenses> findByPin(string|array<string> $pin) Return ChildExpenses objects filtered by the pin column
 * @method     ChildExpenses[]|Collection findByDeviceName(string|array<string> $device_name) Return ChildExpenses objects filtered by the device_name column
 * @psalm-method Collection&\Traversable<ChildExpenses> findByDeviceName(string|array<string> $device_name) Return ChildExpenses objects filtered by the device_name column
 * @method     ChildExpenses[]|Collection findByDeviceBattery(string|array<string> $device_battery) Return ChildExpenses objects filtered by the device_battery column
 * @psalm-method Collection&\Traversable<ChildExpenses> findByDeviceBattery(string|array<string> $device_battery) Return ChildExpenses objects filtered by the device_battery column
 * @method     ChildExpenses[]|Collection findByDeviceTime(string|array<string> $device_time) Return ChildExpenses objects filtered by the device_time column
 * @psalm-method Collection&\Traversable<ChildExpenses> findByDeviceTime(string|array<string> $device_time) Return ChildExpenses objects filtered by the device_time column
 * @method     ChildExpenses[]|Collection findBySettledAmount(string|array<string> $settled_amount) Return ChildExpenses objects filtered by the settled_amount column
 * @psalm-method Collection&\Traversable<ChildExpenses> findBySettledAmount(string|array<string> $settled_amount) Return ChildExpenses objects filtered by the settled_amount column
 * @method     ChildExpenses[]|Collection findBySettledDate(string|array<string> $settled_date) Return ChildExpenses objects filtered by the settled_date column
 * @psalm-method Collection&\Traversable<ChildExpenses> findBySettledDate(string|array<string> $settled_date) Return ChildExpenses objects filtered by the settled_date column
 * @method     ChildExpenses[]|Collection findBySettledDesc(string|array<string> $settled_desc) Return ChildExpenses objects filtered by the settled_desc column
 * @psalm-method Collection&\Traversable<ChildExpenses> findBySettledDesc(string|array<string> $settled_desc) Return ChildExpenses objects filtered by the settled_desc column
 * @method     ChildExpenses[]|Collection findByTripType(string|array<string> $trip_type) Return ChildExpenses objects filtered by the trip_type column
 * @psalm-method Collection&\Traversable<ChildExpenses> findByTripType(string|array<string> $trip_type) Return ChildExpenses objects filtered by the trip_type column
 * @method     ChildExpenses[]|Collection findByDoVerify(boolean|array<boolean> $do_verify) Return ChildExpenses objects filtered by the do_verify column
 * @psalm-method Collection&\Traversable<ChildExpenses> findByDoVerify(boolean|array<boolean> $do_verify) Return ChildExpenses objects filtered by the do_verify column
 *
 * @method     ChildExpenses[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildExpenses> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class ExpensesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\ExpensesQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\Expenses', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildExpensesQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildExpensesQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildExpensesQuery) {
            return $criteria;
        }
        $query = new ChildExpensesQuery();
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
     * @return ChildExpenses|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ExpensesTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ExpensesTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildExpenses A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT exp_id, company_id, expense_date, budget_id, expense_trip, expense_placewrk, expense_req_amt, expense_approved_amt, expense_additional_amt, expense_tax_amt, expense_final_amt, expense_status, employee_id, expense_mode, expense_note, orgunit_id, trip_currency, readflag, created_at, updated_at, pin, device_name, device_battery, device_time, settled_amount, settled_date, settled_desc, trip_type, do_verify FROM expenses WHERE exp_id = :p0';
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
            /** @var ChildExpenses $obj */
            $obj = new ChildExpenses();
            $obj->hydrate($row);
            ExpensesTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildExpenses|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(ExpensesTableMap::COL_EXP_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(ExpensesTableMap::COL_EXP_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the exp_id column
     *
     * Example usage:
     * <code>
     * $query->filterByExpId(1234); // WHERE exp_id = 1234
     * $query->filterByExpId(array(12, 34)); // WHERE exp_id IN (12, 34)
     * $query->filterByExpId(array('min' => 12)); // WHERE exp_id > 12
     * </code>
     *
     * @param mixed $expId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpId($expId = null, ?string $comparison = null)
    {
        if (is_array($expId)) {
            $useMinMax = false;
            if (isset($expId['min'])) {
                $this->addUsingAlias(ExpensesTableMap::COL_EXP_ID, $expId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($expId['max'])) {
                $this->addUsingAlias(ExpensesTableMap::COL_EXP_ID, $expId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpensesTableMap::COL_EXP_ID, $expId, $comparison);

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
                $this->addUsingAlias(ExpensesTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(ExpensesTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpensesTableMap::COL_COMPANY_ID, $companyId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the expense_date column
     *
     * Example usage:
     * <code>
     * $query->filterByExpenseDate('2011-03-14'); // WHERE expense_date = '2011-03-14'
     * $query->filterByExpenseDate('now'); // WHERE expense_date = '2011-03-14'
     * $query->filterByExpenseDate(array('max' => 'yesterday')); // WHERE expense_date > '2011-03-13'
     * </code>
     *
     * @param mixed $expenseDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpenseDate($expenseDate = null, ?string $comparison = null)
    {
        if (is_array($expenseDate)) {
            $useMinMax = false;
            if (isset($expenseDate['min'])) {
                $this->addUsingAlias(ExpensesTableMap::COL_EXPENSE_DATE, $expenseDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($expenseDate['max'])) {
                $this->addUsingAlias(ExpensesTableMap::COL_EXPENSE_DATE, $expenseDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpensesTableMap::COL_EXPENSE_DATE, $expenseDate, $comparison);

        return $this;
    }

    /**
     * Filter the query on the budget_id column
     *
     * Example usage:
     * <code>
     * $query->filterByBudgetId(1234); // WHERE budget_id = 1234
     * $query->filterByBudgetId(array(12, 34)); // WHERE budget_id IN (12, 34)
     * $query->filterByBudgetId(array('min' => 12)); // WHERE budget_id > 12
     * </code>
     *
     * @see       filterByBudgetGroup()
     *
     * @param mixed $budgetId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBudgetId($budgetId = null, ?string $comparison = null)
    {
        if (is_array($budgetId)) {
            $useMinMax = false;
            if (isset($budgetId['min'])) {
                $this->addUsingAlias(ExpensesTableMap::COL_BUDGET_ID, $budgetId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($budgetId['max'])) {
                $this->addUsingAlias(ExpensesTableMap::COL_BUDGET_ID, $budgetId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpensesTableMap::COL_BUDGET_ID, $budgetId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the expense_trip column
     *
     * Example usage:
     * <code>
     * $query->filterByExpenseTrip(1234); // WHERE expense_trip = 1234
     * $query->filterByExpenseTrip(array(12, 34)); // WHERE expense_trip IN (12, 34)
     * $query->filterByExpenseTrip(array('min' => 12)); // WHERE expense_trip > 12
     * </code>
     *
     * @param mixed $expenseTrip The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpenseTrip($expenseTrip = null, ?string $comparison = null)
    {
        if (is_array($expenseTrip)) {
            $useMinMax = false;
            if (isset($expenseTrip['min'])) {
                $this->addUsingAlias(ExpensesTableMap::COL_EXPENSE_TRIP, $expenseTrip['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($expenseTrip['max'])) {
                $this->addUsingAlias(ExpensesTableMap::COL_EXPENSE_TRIP, $expenseTrip['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpensesTableMap::COL_EXPENSE_TRIP, $expenseTrip, $comparison);

        return $this;
    }

    /**
     * Filter the query on the expense_placewrk column
     *
     * Example usage:
     * <code>
     * $query->filterByExpensePlacewrk('fooValue');   // WHERE expense_placewrk = 'fooValue'
     * $query->filterByExpensePlacewrk('%fooValue%', Criteria::LIKE); // WHERE expense_placewrk LIKE '%fooValue%'
     * $query->filterByExpensePlacewrk(['foo', 'bar']); // WHERE expense_placewrk IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $expensePlacewrk The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpensePlacewrk($expensePlacewrk = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($expensePlacewrk)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpensesTableMap::COL_EXPENSE_PLACEWRK, $expensePlacewrk, $comparison);

        return $this;
    }

    /**
     * Filter the query on the expense_req_amt column
     *
     * Example usage:
     * <code>
     * $query->filterByExpenseReqAmt(1234); // WHERE expense_req_amt = 1234
     * $query->filterByExpenseReqAmt(array(12, 34)); // WHERE expense_req_amt IN (12, 34)
     * $query->filterByExpenseReqAmt(array('min' => 12)); // WHERE expense_req_amt > 12
     * </code>
     *
     * @param mixed $expenseReqAmt The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpenseReqAmt($expenseReqAmt = null, ?string $comparison = null)
    {
        if (is_array($expenseReqAmt)) {
            $useMinMax = false;
            if (isset($expenseReqAmt['min'])) {
                $this->addUsingAlias(ExpensesTableMap::COL_EXPENSE_REQ_AMT, $expenseReqAmt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($expenseReqAmt['max'])) {
                $this->addUsingAlias(ExpensesTableMap::COL_EXPENSE_REQ_AMT, $expenseReqAmt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpensesTableMap::COL_EXPENSE_REQ_AMT, $expenseReqAmt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the expense_approved_amt column
     *
     * Example usage:
     * <code>
     * $query->filterByExpenseApprovedAmt(1234); // WHERE expense_approved_amt = 1234
     * $query->filterByExpenseApprovedAmt(array(12, 34)); // WHERE expense_approved_amt IN (12, 34)
     * $query->filterByExpenseApprovedAmt(array('min' => 12)); // WHERE expense_approved_amt > 12
     * </code>
     *
     * @param mixed $expenseApprovedAmt The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpenseApprovedAmt($expenseApprovedAmt = null, ?string $comparison = null)
    {
        if (is_array($expenseApprovedAmt)) {
            $useMinMax = false;
            if (isset($expenseApprovedAmt['min'])) {
                $this->addUsingAlias(ExpensesTableMap::COL_EXPENSE_APPROVED_AMT, $expenseApprovedAmt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($expenseApprovedAmt['max'])) {
                $this->addUsingAlias(ExpensesTableMap::COL_EXPENSE_APPROVED_AMT, $expenseApprovedAmt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpensesTableMap::COL_EXPENSE_APPROVED_AMT, $expenseApprovedAmt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the expense_additional_amt column
     *
     * Example usage:
     * <code>
     * $query->filterByExpenseAdditionalAmt(1234); // WHERE expense_additional_amt = 1234
     * $query->filterByExpenseAdditionalAmt(array(12, 34)); // WHERE expense_additional_amt IN (12, 34)
     * $query->filterByExpenseAdditionalAmt(array('min' => 12)); // WHERE expense_additional_amt > 12
     * </code>
     *
     * @param mixed $expenseAdditionalAmt The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpenseAdditionalAmt($expenseAdditionalAmt = null, ?string $comparison = null)
    {
        if (is_array($expenseAdditionalAmt)) {
            $useMinMax = false;
            if (isset($expenseAdditionalAmt['min'])) {
                $this->addUsingAlias(ExpensesTableMap::COL_EXPENSE_ADDITIONAL_AMT, $expenseAdditionalAmt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($expenseAdditionalAmt['max'])) {
                $this->addUsingAlias(ExpensesTableMap::COL_EXPENSE_ADDITIONAL_AMT, $expenseAdditionalAmt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpensesTableMap::COL_EXPENSE_ADDITIONAL_AMT, $expenseAdditionalAmt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the expense_tax_amt column
     *
     * Example usage:
     * <code>
     * $query->filterByExpenseTaxAmt(1234); // WHERE expense_tax_amt = 1234
     * $query->filterByExpenseTaxAmt(array(12, 34)); // WHERE expense_tax_amt IN (12, 34)
     * $query->filterByExpenseTaxAmt(array('min' => 12)); // WHERE expense_tax_amt > 12
     * </code>
     *
     * @param mixed $expenseTaxAmt The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpenseTaxAmt($expenseTaxAmt = null, ?string $comparison = null)
    {
        if (is_array($expenseTaxAmt)) {
            $useMinMax = false;
            if (isset($expenseTaxAmt['min'])) {
                $this->addUsingAlias(ExpensesTableMap::COL_EXPENSE_TAX_AMT, $expenseTaxAmt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($expenseTaxAmt['max'])) {
                $this->addUsingAlias(ExpensesTableMap::COL_EXPENSE_TAX_AMT, $expenseTaxAmt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpensesTableMap::COL_EXPENSE_TAX_AMT, $expenseTaxAmt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the expense_final_amt column
     *
     * Example usage:
     * <code>
     * $query->filterByExpenseFinalAmt(1234); // WHERE expense_final_amt = 1234
     * $query->filterByExpenseFinalAmt(array(12, 34)); // WHERE expense_final_amt IN (12, 34)
     * $query->filterByExpenseFinalAmt(array('min' => 12)); // WHERE expense_final_amt > 12
     * </code>
     *
     * @param mixed $expenseFinalAmt The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpenseFinalAmt($expenseFinalAmt = null, ?string $comparison = null)
    {
        if (is_array($expenseFinalAmt)) {
            $useMinMax = false;
            if (isset($expenseFinalAmt['min'])) {
                $this->addUsingAlias(ExpensesTableMap::COL_EXPENSE_FINAL_AMT, $expenseFinalAmt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($expenseFinalAmt['max'])) {
                $this->addUsingAlias(ExpensesTableMap::COL_EXPENSE_FINAL_AMT, $expenseFinalAmt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpensesTableMap::COL_EXPENSE_FINAL_AMT, $expenseFinalAmt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the expense_status column
     *
     * Example usage:
     * <code>
     * $query->filterByExpenseStatus(1234); // WHERE expense_status = 1234
     * $query->filterByExpenseStatus(array(12, 34)); // WHERE expense_status IN (12, 34)
     * $query->filterByExpenseStatus(array('min' => 12)); // WHERE expense_status > 12
     * </code>
     *
     * @param mixed $expenseStatus The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpenseStatus($expenseStatus = null, ?string $comparison = null)
    {
        if (is_array($expenseStatus)) {
            $useMinMax = false;
            if (isset($expenseStatus['min'])) {
                $this->addUsingAlias(ExpensesTableMap::COL_EXPENSE_STATUS, $expenseStatus['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($expenseStatus['max'])) {
                $this->addUsingAlias(ExpensesTableMap::COL_EXPENSE_STATUS, $expenseStatus['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpensesTableMap::COL_EXPENSE_STATUS, $expenseStatus, $comparison);

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
     * @see       filterByEmployee()
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
                $this->addUsingAlias(ExpensesTableMap::COL_EMPLOYEE_ID, $employeeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($employeeId['max'])) {
                $this->addUsingAlias(ExpensesTableMap::COL_EMPLOYEE_ID, $employeeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpensesTableMap::COL_EMPLOYEE_ID, $employeeId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the expense_mode column
     *
     * Example usage:
     * <code>
     * $query->filterByExpenseMode(1234); // WHERE expense_mode = 1234
     * $query->filterByExpenseMode(array(12, 34)); // WHERE expense_mode IN (12, 34)
     * $query->filterByExpenseMode(array('min' => 12)); // WHERE expense_mode > 12
     * </code>
     *
     * @param mixed $expenseMode The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpenseMode($expenseMode = null, ?string $comparison = null)
    {
        if (is_array($expenseMode)) {
            $useMinMax = false;
            if (isset($expenseMode['min'])) {
                $this->addUsingAlias(ExpensesTableMap::COL_EXPENSE_MODE, $expenseMode['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($expenseMode['max'])) {
                $this->addUsingAlias(ExpensesTableMap::COL_EXPENSE_MODE, $expenseMode['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpensesTableMap::COL_EXPENSE_MODE, $expenseMode, $comparison);

        return $this;
    }

    /**
     * Filter the query on the expense_note column
     *
     * Example usage:
     * <code>
     * $query->filterByExpenseNote('fooValue');   // WHERE expense_note = 'fooValue'
     * $query->filterByExpenseNote('%fooValue%', Criteria::LIKE); // WHERE expense_note LIKE '%fooValue%'
     * $query->filterByExpenseNote(['foo', 'bar']); // WHERE expense_note IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $expenseNote The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpenseNote($expenseNote = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($expenseNote)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpensesTableMap::COL_EXPENSE_NOTE, $expenseNote, $comparison);

        return $this;
    }

    /**
     * Filter the query on the orgunit_id column
     *
     * Example usage:
     * <code>
     * $query->filterByOrgunitId(1234); // WHERE orgunit_id = 1234
     * $query->filterByOrgunitId(array(12, 34)); // WHERE orgunit_id IN (12, 34)
     * $query->filterByOrgunitId(array('min' => 12)); // WHERE orgunit_id > 12
     * </code>
     *
     * @see       filterByOrgUnit()
     *
     * @param mixed $orgunitId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrgunitId($orgunitId = null, ?string $comparison = null)
    {
        if (is_array($orgunitId)) {
            $useMinMax = false;
            if (isset($orgunitId['min'])) {
                $this->addUsingAlias(ExpensesTableMap::COL_ORGUNIT_ID, $orgunitId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($orgunitId['max'])) {
                $this->addUsingAlias(ExpensesTableMap::COL_ORGUNIT_ID, $orgunitId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpensesTableMap::COL_ORGUNIT_ID, $orgunitId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the trip_currency column
     *
     * Example usage:
     * <code>
     * $query->filterByTripCurrency(1234); // WHERE trip_currency = 1234
     * $query->filterByTripCurrency(array(12, 34)); // WHERE trip_currency IN (12, 34)
     * $query->filterByTripCurrency(array('min' => 12)); // WHERE trip_currency > 12
     * </code>
     *
     * @see       filterByCurrencies()
     *
     * @param mixed $tripCurrency The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTripCurrency($tripCurrency = null, ?string $comparison = null)
    {
        if (is_array($tripCurrency)) {
            $useMinMax = false;
            if (isset($tripCurrency['min'])) {
                $this->addUsingAlias(ExpensesTableMap::COL_TRIP_CURRENCY, $tripCurrency['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($tripCurrency['max'])) {
                $this->addUsingAlias(ExpensesTableMap::COL_TRIP_CURRENCY, $tripCurrency['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpensesTableMap::COL_TRIP_CURRENCY, $tripCurrency, $comparison);

        return $this;
    }

    /**
     * Filter the query on the readflag column
     *
     * Example usage:
     * <code>
     * $query->filterByReadflag(1234); // WHERE readflag = 1234
     * $query->filterByReadflag(array(12, 34)); // WHERE readflag IN (12, 34)
     * $query->filterByReadflag(array('min' => 12)); // WHERE readflag > 12
     * </code>
     *
     * @param mixed $readflag The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByReadflag($readflag = null, ?string $comparison = null)
    {
        if (is_array($readflag)) {
            $useMinMax = false;
            if (isset($readflag['min'])) {
                $this->addUsingAlias(ExpensesTableMap::COL_READFLAG, $readflag['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($readflag['max'])) {
                $this->addUsingAlias(ExpensesTableMap::COL_READFLAG, $readflag['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpensesTableMap::COL_READFLAG, $readflag, $comparison);

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
                $this->addUsingAlias(ExpensesTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(ExpensesTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpensesTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(ExpensesTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(ExpensesTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpensesTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the pin column
     *
     * Example usage:
     * <code>
     * $query->filterByPin('fooValue');   // WHERE pin = 'fooValue'
     * $query->filterByPin('%fooValue%', Criteria::LIKE); // WHERE pin LIKE '%fooValue%'
     * $query->filterByPin(['foo', 'bar']); // WHERE pin IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $pin The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPin($pin = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($pin)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpensesTableMap::COL_PIN, $pin, $comparison);

        return $this;
    }

    /**
     * Filter the query on the device_name column
     *
     * Example usage:
     * <code>
     * $query->filterByDeviceName('fooValue');   // WHERE device_name = 'fooValue'
     * $query->filterByDeviceName('%fooValue%', Criteria::LIKE); // WHERE device_name LIKE '%fooValue%'
     * $query->filterByDeviceName(['foo', 'bar']); // WHERE device_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $deviceName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDeviceName($deviceName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($deviceName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpensesTableMap::COL_DEVICE_NAME, $deviceName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the device_battery column
     *
     * Example usage:
     * <code>
     * $query->filterByDeviceBattery('fooValue');   // WHERE device_battery = 'fooValue'
     * $query->filterByDeviceBattery('%fooValue%', Criteria::LIKE); // WHERE device_battery LIKE '%fooValue%'
     * $query->filterByDeviceBattery(['foo', 'bar']); // WHERE device_battery IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $deviceBattery The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDeviceBattery($deviceBattery = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($deviceBattery)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpensesTableMap::COL_DEVICE_BATTERY, $deviceBattery, $comparison);

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

        $this->addUsingAlias(ExpensesTableMap::COL_DEVICE_TIME, $deviceTime, $comparison);

        return $this;
    }

    /**
     * Filter the query on the settled_amount column
     *
     * Example usage:
     * <code>
     * $query->filterBySettledAmount(1234); // WHERE settled_amount = 1234
     * $query->filterBySettledAmount(array(12, 34)); // WHERE settled_amount IN (12, 34)
     * $query->filterBySettledAmount(array('min' => 12)); // WHERE settled_amount > 12
     * </code>
     *
     * @param mixed $settledAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySettledAmount($settledAmount = null, ?string $comparison = null)
    {
        if (is_array($settledAmount)) {
            $useMinMax = false;
            if (isset($settledAmount['min'])) {
                $this->addUsingAlias(ExpensesTableMap::COL_SETTLED_AMOUNT, $settledAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($settledAmount['max'])) {
                $this->addUsingAlias(ExpensesTableMap::COL_SETTLED_AMOUNT, $settledAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpensesTableMap::COL_SETTLED_AMOUNT, $settledAmount, $comparison);

        return $this;
    }

    /**
     * Filter the query on the settled_date column
     *
     * Example usage:
     * <code>
     * $query->filterBySettledDate('2011-03-14'); // WHERE settled_date = '2011-03-14'
     * $query->filterBySettledDate('now'); // WHERE settled_date = '2011-03-14'
     * $query->filterBySettledDate(array('max' => 'yesterday')); // WHERE settled_date > '2011-03-13'
     * </code>
     *
     * @param mixed $settledDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySettledDate($settledDate = null, ?string $comparison = null)
    {
        if (is_array($settledDate)) {
            $useMinMax = false;
            if (isset($settledDate['min'])) {
                $this->addUsingAlias(ExpensesTableMap::COL_SETTLED_DATE, $settledDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($settledDate['max'])) {
                $this->addUsingAlias(ExpensesTableMap::COL_SETTLED_DATE, $settledDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpensesTableMap::COL_SETTLED_DATE, $settledDate, $comparison);

        return $this;
    }

    /**
     * Filter the query on the settled_desc column
     *
     * Example usage:
     * <code>
     * $query->filterBySettledDesc('fooValue');   // WHERE settled_desc = 'fooValue'
     * $query->filterBySettledDesc('%fooValue%', Criteria::LIKE); // WHERE settled_desc LIKE '%fooValue%'
     * $query->filterBySettledDesc(['foo', 'bar']); // WHERE settled_desc IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $settledDesc The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySettledDesc($settledDesc = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($settledDesc)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpensesTableMap::COL_SETTLED_DESC, $settledDesc, $comparison);

        return $this;
    }

    /**
     * Filter the query on the trip_type column
     *
     * Example usage:
     * <code>
     * $query->filterByTripType('fooValue');   // WHERE trip_type = 'fooValue'
     * $query->filterByTripType('%fooValue%', Criteria::LIKE); // WHERE trip_type LIKE '%fooValue%'
     * $query->filterByTripType(['foo', 'bar']); // WHERE trip_type IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $tripType The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTripType($tripType = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tripType)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpensesTableMap::COL_TRIP_TYPE, $tripType, $comparison);

        return $this;
    }

    /**
     * Filter the query on the do_verify column
     *
     * Example usage:
     * <code>
     * $query->filterByDoVerify(true); // WHERE do_verify = true
     * $query->filterByDoVerify('yes'); // WHERE do_verify = true
     * </code>
     *
     * @param bool|string $doVerify The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDoVerify($doVerify = null, ?string $comparison = null)
    {
        if (is_string($doVerify)) {
            $doVerify = in_array(strtolower($doVerify), array('false', 'off', '-', 'no', 'n', '0', ''), true) ? false : true;
        }

        $this->addUsingAlias(ExpensesTableMap::COL_DO_VERIFY, $doVerify, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \entities\BudgetGroup object
     *
     * @param \entities\BudgetGroup|ObjectCollection $budgetGroup The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBudgetGroup($budgetGroup, ?string $comparison = null)
    {
        if ($budgetGroup instanceof \entities\BudgetGroup) {
            return $this
                ->addUsingAlias(ExpensesTableMap::COL_BUDGET_ID, $budgetGroup->getBgid(), $comparison);
        } elseif ($budgetGroup instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(ExpensesTableMap::COL_BUDGET_ID, $budgetGroup->toKeyValue('PrimaryKey', 'Bgid'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByBudgetGroup() only accepts arguments of type \entities\BudgetGroup or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BudgetGroup relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinBudgetGroup(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BudgetGroup');

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
            $this->addJoinObject($join, 'BudgetGroup');
        }

        return $this;
    }

    /**
     * Use the BudgetGroup relation BudgetGroup object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\BudgetGroupQuery A secondary query class using the current class as primary query
     */
    public function useBudgetGroupQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinBudgetGroup($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BudgetGroup', '\entities\BudgetGroupQuery');
    }

    /**
     * Use the BudgetGroup relation BudgetGroup object
     *
     * @param callable(\entities\BudgetGroupQuery):\entities\BudgetGroupQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withBudgetGroupQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useBudgetGroupQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to BudgetGroup table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\BudgetGroupQuery The inner query object of the EXISTS statement
     */
    public function useBudgetGroupExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\BudgetGroupQuery */
        $q = $this->useExistsQuery('BudgetGroup', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to BudgetGroup table for a NOT EXISTS query.
     *
     * @see useBudgetGroupExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\BudgetGroupQuery The inner query object of the NOT EXISTS statement
     */
    public function useBudgetGroupNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\BudgetGroupQuery */
        $q = $this->useExistsQuery('BudgetGroup', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to BudgetGroup table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\BudgetGroupQuery The inner query object of the IN statement
     */
    public function useInBudgetGroupQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\BudgetGroupQuery */
        $q = $this->useInQuery('BudgetGroup', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to BudgetGroup table for a NOT IN query.
     *
     * @see useBudgetGroupInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\BudgetGroupQuery The inner query object of the NOT IN statement
     */
    public function useNotInBudgetGroupQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\BudgetGroupQuery */
        $q = $this->useInQuery('BudgetGroup', $modelAlias, $queryClass, 'NOT IN');
        return $q;
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
                ->addUsingAlias(ExpensesTableMap::COL_COMPANY_ID, $company->getCompanyId(), $comparison);
        } elseif ($company instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(ExpensesTableMap::COL_COMPANY_ID, $company->toKeyValue('PrimaryKey', 'CompanyId'), $comparison);

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
    public function joinCompany(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
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
    public function useCompanyQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
        ?string $joinType = Criteria::INNER_JOIN
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
     * Filter the query by a related \entities\Currencies object
     *
     * @param \entities\Currencies|ObjectCollection $currencies The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCurrencies($currencies, ?string $comparison = null)
    {
        if ($currencies instanceof \entities\Currencies) {
            return $this
                ->addUsingAlias(ExpensesTableMap::COL_TRIP_CURRENCY, $currencies->getCurrencyId(), $comparison);
        } elseif ($currencies instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(ExpensesTableMap::COL_TRIP_CURRENCY, $currencies->toKeyValue('PrimaryKey', 'CurrencyId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByCurrencies() only accepts arguments of type \entities\Currencies or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Currencies relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinCurrencies(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Currencies');

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
            $this->addJoinObject($join, 'Currencies');
        }

        return $this;
    }

    /**
     * Use the Currencies relation Currencies object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\CurrenciesQuery A secondary query class using the current class as primary query
     */
    public function useCurrenciesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCurrencies($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Currencies', '\entities\CurrenciesQuery');
    }

    /**
     * Use the Currencies relation Currencies object
     *
     * @param callable(\entities\CurrenciesQuery):\entities\CurrenciesQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withCurrenciesQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useCurrenciesQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Currencies table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\CurrenciesQuery The inner query object of the EXISTS statement
     */
    public function useCurrenciesExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\CurrenciesQuery */
        $q = $this->useExistsQuery('Currencies', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Currencies table for a NOT EXISTS query.
     *
     * @see useCurrenciesExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\CurrenciesQuery The inner query object of the NOT EXISTS statement
     */
    public function useCurrenciesNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\CurrenciesQuery */
        $q = $this->useExistsQuery('Currencies', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Currencies table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\CurrenciesQuery The inner query object of the IN statement
     */
    public function useInCurrenciesQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\CurrenciesQuery */
        $q = $this->useInQuery('Currencies', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Currencies table for a NOT IN query.
     *
     * @see useCurrenciesInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\CurrenciesQuery The inner query object of the NOT IN statement
     */
    public function useNotInCurrenciesQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\CurrenciesQuery */
        $q = $this->useInQuery('Currencies', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\Employee object
     *
     * @param \entities\Employee|ObjectCollection $employee The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmployee($employee, ?string $comparison = null)
    {
        if ($employee instanceof \entities\Employee) {
            return $this
                ->addUsingAlias(ExpensesTableMap::COL_EMPLOYEE_ID, $employee->getEmployeeId(), $comparison);
        } elseif ($employee instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(ExpensesTableMap::COL_EMPLOYEE_ID, $employee->toKeyValue('PrimaryKey', 'EmployeeId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByEmployee() only accepts arguments of type \entities\Employee or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Employee relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinEmployee(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Employee');

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
            $this->addJoinObject($join, 'Employee');
        }

        return $this;
    }

    /**
     * Use the Employee relation Employee object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\EmployeeQuery A secondary query class using the current class as primary query
     */
    public function useEmployeeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinEmployee($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Employee', '\entities\EmployeeQuery');
    }

    /**
     * Use the Employee relation Employee object
     *
     * @param callable(\entities\EmployeeQuery):\entities\EmployeeQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withEmployeeQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useEmployeeQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Employee table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\EmployeeQuery The inner query object of the EXISTS statement
     */
    public function useEmployeeExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\EmployeeQuery */
        $q = $this->useExistsQuery('Employee', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Employee table for a NOT EXISTS query.
     *
     * @see useEmployeeExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\EmployeeQuery The inner query object of the NOT EXISTS statement
     */
    public function useEmployeeNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\EmployeeQuery */
        $q = $this->useExistsQuery('Employee', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Employee table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\EmployeeQuery The inner query object of the IN statement
     */
    public function useInEmployeeQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\EmployeeQuery */
        $q = $this->useInQuery('Employee', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Employee table for a NOT IN query.
     *
     * @see useEmployeeInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\EmployeeQuery The inner query object of the NOT IN statement
     */
    public function useNotInEmployeeQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\EmployeeQuery */
        $q = $this->useInQuery('Employee', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\OrgUnit object
     *
     * @param \entities\OrgUnit|ObjectCollection $orgUnit The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrgUnit($orgUnit, ?string $comparison = null)
    {
        if ($orgUnit instanceof \entities\OrgUnit) {
            return $this
                ->addUsingAlias(ExpensesTableMap::COL_ORGUNIT_ID, $orgUnit->getOrgunitid(), $comparison);
        } elseif ($orgUnit instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(ExpensesTableMap::COL_ORGUNIT_ID, $orgUnit->toKeyValue('PrimaryKey', 'Orgunitid'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByOrgUnit() only accepts arguments of type \entities\OrgUnit or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OrgUnit relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOrgUnit(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OrgUnit');

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
            $this->addJoinObject($join, 'OrgUnit');
        }

        return $this;
    }

    /**
     * Use the OrgUnit relation OrgUnit object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\OrgUnitQuery A secondary query class using the current class as primary query
     */
    public function useOrgUnitQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinOrgUnit($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OrgUnit', '\entities\OrgUnitQuery');
    }

    /**
     * Use the OrgUnit relation OrgUnit object
     *
     * @param callable(\entities\OrgUnitQuery):\entities\OrgUnitQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOrgUnitQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useOrgUnitQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to OrgUnit table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\OrgUnitQuery The inner query object of the EXISTS statement
     */
    public function useOrgUnitExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\OrgUnitQuery */
        $q = $this->useExistsQuery('OrgUnit', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to OrgUnit table for a NOT EXISTS query.
     *
     * @see useOrgUnitExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\OrgUnitQuery The inner query object of the NOT EXISTS statement
     */
    public function useOrgUnitNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OrgUnitQuery */
        $q = $this->useExistsQuery('OrgUnit', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to OrgUnit table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\OrgUnitQuery The inner query object of the IN statement
     */
    public function useInOrgUnitQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\OrgUnitQuery */
        $q = $this->useInQuery('OrgUnit', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to OrgUnit table for a NOT IN query.
     *
     * @see useOrgUnitInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\OrgUnitQuery The inner query object of the NOT IN statement
     */
    public function useNotInOrgUnitQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OrgUnitQuery */
        $q = $this->useInQuery('OrgUnit', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\Attendance object
     *
     * @param \entities\Attendance|ObjectCollection $attendance the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAttendance($attendance, ?string $comparison = null)
    {
        if ($attendance instanceof \entities\Attendance) {
            $this
                ->addUsingAlias(ExpensesTableMap::COL_EXP_ID, $attendance->getExpenseId(), $comparison);

            return $this;
        } elseif ($attendance instanceof ObjectCollection) {
            $this
                ->useAttendanceQuery()
                ->filterByPrimaryKeys($attendance->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByAttendance() only accepts arguments of type \entities\Attendance or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Attendance relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinAttendance(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Attendance');

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
            $this->addJoinObject($join, 'Attendance');
        }

        return $this;
    }

    /**
     * Use the Attendance relation Attendance object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\AttendanceQuery A secondary query class using the current class as primary query
     */
    public function useAttendanceQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinAttendance($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Attendance', '\entities\AttendanceQuery');
    }

    /**
     * Use the Attendance relation Attendance object
     *
     * @param callable(\entities\AttendanceQuery):\entities\AttendanceQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withAttendanceQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useAttendanceQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Attendance table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\AttendanceQuery The inner query object of the EXISTS statement
     */
    public function useAttendanceExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\AttendanceQuery */
        $q = $this->useExistsQuery('Attendance', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Attendance table for a NOT EXISTS query.
     *
     * @see useAttendanceExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\AttendanceQuery The inner query object of the NOT EXISTS statement
     */
    public function useAttendanceNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\AttendanceQuery */
        $q = $this->useExistsQuery('Attendance', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Attendance table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\AttendanceQuery The inner query object of the IN statement
     */
    public function useInAttendanceQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\AttendanceQuery */
        $q = $this->useInQuery('Attendance', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Attendance table for a NOT IN query.
     *
     * @see useAttendanceInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\AttendanceQuery The inner query object of the NOT IN statement
     */
    public function useNotInAttendanceQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\AttendanceQuery */
        $q = $this->useInQuery('Attendance', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\EmployeeWorkLog object
     *
     * @param \entities\EmployeeWorkLog|ObjectCollection $employeeWorkLog the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmployeeWorkLog($employeeWorkLog, ?string $comparison = null)
    {
        if ($employeeWorkLog instanceof \entities\EmployeeWorkLog) {
            $this
                ->addUsingAlias(ExpensesTableMap::COL_EXP_ID, $employeeWorkLog->getExpId(), $comparison);

            return $this;
        } elseif ($employeeWorkLog instanceof ObjectCollection) {
            $this
                ->useEmployeeWorkLogQuery()
                ->filterByPrimaryKeys($employeeWorkLog->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByEmployeeWorkLog() only accepts arguments of type \entities\EmployeeWorkLog or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the EmployeeWorkLog relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinEmployeeWorkLog(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('EmployeeWorkLog');

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
            $this->addJoinObject($join, 'EmployeeWorkLog');
        }

        return $this;
    }

    /**
     * Use the EmployeeWorkLog relation EmployeeWorkLog object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\EmployeeWorkLogQuery A secondary query class using the current class as primary query
     */
    public function useEmployeeWorkLogQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinEmployeeWorkLog($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'EmployeeWorkLog', '\entities\EmployeeWorkLogQuery');
    }

    /**
     * Use the EmployeeWorkLog relation EmployeeWorkLog object
     *
     * @param callable(\entities\EmployeeWorkLogQuery):\entities\EmployeeWorkLogQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withEmployeeWorkLogQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useEmployeeWorkLogQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to EmployeeWorkLog table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\EmployeeWorkLogQuery The inner query object of the EXISTS statement
     */
    public function useEmployeeWorkLogExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\EmployeeWorkLogQuery */
        $q = $this->useExistsQuery('EmployeeWorkLog', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to EmployeeWorkLog table for a NOT EXISTS query.
     *
     * @see useEmployeeWorkLogExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\EmployeeWorkLogQuery The inner query object of the NOT EXISTS statement
     */
    public function useEmployeeWorkLogNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\EmployeeWorkLogQuery */
        $q = $this->useExistsQuery('EmployeeWorkLog', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to EmployeeWorkLog table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\EmployeeWorkLogQuery The inner query object of the IN statement
     */
    public function useInEmployeeWorkLogQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\EmployeeWorkLogQuery */
        $q = $this->useInQuery('EmployeeWorkLog', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to EmployeeWorkLog table for a NOT IN query.
     *
     * @see useEmployeeWorkLogInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\EmployeeWorkLogQuery The inner query object of the NOT IN statement
     */
    public function useNotInEmployeeWorkLogQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\EmployeeWorkLogQuery */
        $q = $this->useInQuery('EmployeeWorkLog', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\ExpenseFiles object
     *
     * @param \entities\ExpenseFiles|ObjectCollection $expenseFiles the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpenseFiles($expenseFiles, ?string $comparison = null)
    {
        if ($expenseFiles instanceof \entities\ExpenseFiles) {
            $this
                ->addUsingAlias(ExpensesTableMap::COL_EXP_ID, $expenseFiles->getExpId(), $comparison);

            return $this;
        } elseif ($expenseFiles instanceof ObjectCollection) {
            $this
                ->useExpenseFilesQuery()
                ->filterByPrimaryKeys($expenseFiles->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByExpenseFiles() only accepts arguments of type \entities\ExpenseFiles or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ExpenseFiles relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinExpenseFiles(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ExpenseFiles');

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
            $this->addJoinObject($join, 'ExpenseFiles');
        }

        return $this;
    }

    /**
     * Use the ExpenseFiles relation ExpenseFiles object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\ExpenseFilesQuery A secondary query class using the current class as primary query
     */
    public function useExpenseFilesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinExpenseFiles($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ExpenseFiles', '\entities\ExpenseFilesQuery');
    }

    /**
     * Use the ExpenseFiles relation ExpenseFiles object
     *
     * @param callable(\entities\ExpenseFilesQuery):\entities\ExpenseFilesQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withExpenseFilesQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useExpenseFilesQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to ExpenseFiles table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\ExpenseFilesQuery The inner query object of the EXISTS statement
     */
    public function useExpenseFilesExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\ExpenseFilesQuery */
        $q = $this->useExistsQuery('ExpenseFiles', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to ExpenseFiles table for a NOT EXISTS query.
     *
     * @see useExpenseFilesExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\ExpenseFilesQuery The inner query object of the NOT EXISTS statement
     */
    public function useExpenseFilesNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\ExpenseFilesQuery */
        $q = $this->useExistsQuery('ExpenseFiles', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to ExpenseFiles table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\ExpenseFilesQuery The inner query object of the IN statement
     */
    public function useInExpenseFilesQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\ExpenseFilesQuery */
        $q = $this->useInQuery('ExpenseFiles', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to ExpenseFiles table for a NOT IN query.
     *
     * @see useExpenseFilesInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\ExpenseFilesQuery The inner query object of the NOT IN statement
     */
    public function useNotInExpenseFilesQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\ExpenseFilesQuery */
        $q = $this->useInQuery('ExpenseFiles', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\ExpenseList object
     *
     * @param \entities\ExpenseList|ObjectCollection $expenseList the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpenseList($expenseList, ?string $comparison = null)
    {
        if ($expenseList instanceof \entities\ExpenseList) {
            $this
                ->addUsingAlias(ExpensesTableMap::COL_EXP_ID, $expenseList->getExpId(), $comparison);

            return $this;
        } elseif ($expenseList instanceof ObjectCollection) {
            $this
                ->useExpenseListQuery()
                ->filterByPrimaryKeys($expenseList->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByExpenseList() only accepts arguments of type \entities\ExpenseList or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ExpenseList relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinExpenseList(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ExpenseList');

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
            $this->addJoinObject($join, 'ExpenseList');
        }

        return $this;
    }

    /**
     * Use the ExpenseList relation ExpenseList object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\ExpenseListQuery A secondary query class using the current class as primary query
     */
    public function useExpenseListQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinExpenseList($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ExpenseList', '\entities\ExpenseListQuery');
    }

    /**
     * Use the ExpenseList relation ExpenseList object
     *
     * @param callable(\entities\ExpenseListQuery):\entities\ExpenseListQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withExpenseListQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useExpenseListQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to ExpenseList table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\ExpenseListQuery The inner query object of the EXISTS statement
     */
    public function useExpenseListExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\ExpenseListQuery */
        $q = $this->useExistsQuery('ExpenseList', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to ExpenseList table for a NOT EXISTS query.
     *
     * @see useExpenseListExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\ExpenseListQuery The inner query object of the NOT EXISTS statement
     */
    public function useExpenseListNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\ExpenseListQuery */
        $q = $this->useExistsQuery('ExpenseList', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to ExpenseList table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\ExpenseListQuery The inner query object of the IN statement
     */
    public function useInExpenseListQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\ExpenseListQuery */
        $q = $this->useInQuery('ExpenseList', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to ExpenseList table for a NOT IN query.
     *
     * @see useExpenseListInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\ExpenseListQuery The inner query object of the NOT IN statement
     */
    public function useNotInExpenseListQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\ExpenseListQuery */
        $q = $this->useInQuery('ExpenseList', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildExpenses $expenses Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($expenses = null)
    {
        if ($expenses) {
            $this->addUsingAlias(ExpensesTableMap::COL_EXP_ID, $expenses->getExpId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the expenses table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ExpensesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ExpensesTableMap::clearInstancePool();
            ExpensesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ExpensesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ExpensesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ExpensesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ExpensesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
