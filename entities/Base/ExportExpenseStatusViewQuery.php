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
use entities\ExportExpenseStatusView as ChildExportExpenseStatusView;
use entities\ExportExpenseStatusViewQuery as ChildExportExpenseStatusViewQuery;
use entities\Map\ExportExpenseStatusViewTableMap;

/**
 * Base class that represents a query for the `export_expense_status_view` table.
 *
 * @method     ChildExportExpenseStatusViewQuery orderByUniqueid($order = Criteria::ASC) Order by the uniqueid column
 * @method     ChildExportExpenseStatusViewQuery orderByEmployeeId($order = Criteria::ASC) Order by the employee_id column
 * @method     ChildExportExpenseStatusViewQuery orderByPositionId($order = Criteria::ASC) Order by the position_id column
 * @method     ChildExportExpenseStatusViewQuery orderByOrgunitid($order = Criteria::ASC) Order by the orgunitid column
 * @method     ChildExportExpenseStatusViewQuery orderByBuName($order = Criteria::ASC) Order by the bu_name column
 * @method     ChildExportExpenseStatusViewQuery orderByEmpPositionCode($order = Criteria::ASC) Order by the emp_position_code column
 * @method     ChildExportExpenseStatusViewQuery orderByEmpPositionName($order = Criteria::ASC) Order by the emp_position_name column
 * @method     ChildExportExpenseStatusViewQuery orderByEmpLevel($order = Criteria::ASC) Order by the emp_level column
 * @method     ChildExportExpenseStatusViewQuery orderByEmployeeCode($order = Criteria::ASC) Order by the employee_code column
 * @method     ChildExportExpenseStatusViewQuery orderByEmployeeName($order = Criteria::ASC) Order by the employee_name column
 * @method     ChildExportExpenseStatusViewQuery orderByReportingToEmployeeName($order = Criteria::ASC) Order by the reporting_to_employee_name column
 * @method     ChildExportExpenseStatusViewQuery orderByReportingToEmployeeCode($order = Criteria::ASC) Order by the reporting_to_employee_code column
 * @method     ChildExportExpenseStatusViewQuery orderByEmpTown($order = Criteria::ASC) Order by the emp_town column
 * @method     ChildExportExpenseStatusViewQuery orderByEmpBranch($order = Criteria::ASC) Order by the emp_branch column
 * @method     ChildExportExpenseStatusViewQuery orderByDesignation($order = Criteria::ASC) Order by the designation column
 * @method     ChildExportExpenseStatusViewQuery orderByGrade($order = Criteria::ASC) Order by the grade column
 * @method     ChildExportExpenseStatusViewQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method     ChildExportExpenseStatusViewQuery orderByMonth($order = Criteria::ASC) Order by the month column
 * @method     ChildExportExpenseStatusViewQuery orderByRequestedAmount($order = Criteria::ASC) Order by the requested_amount column
 * @method     ChildExportExpenseStatusViewQuery orderByApprovedAmount($order = Criteria::ASC) Order by the approved_amount column
 * @method     ChildExportExpenseStatusViewQuery orderByFinalAmount($order = Criteria::ASC) Order by the final_amount column
 * @method     ChildExportExpenseStatusViewQuery orderByExpenseStatus($order = Criteria::ASC) Order by the expense_status column
 * @method     ChildExportExpenseStatusViewQuery orderByTotalExpenses($order = Criteria::ASC) Order by the total_expenses column
 * @method     ChildExportExpenseStatusViewQuery orderByExpenseDates($order = Criteria::ASC) Order by the expense_dates column
 *
 * @method     ChildExportExpenseStatusViewQuery groupByUniqueid() Group by the uniqueid column
 * @method     ChildExportExpenseStatusViewQuery groupByEmployeeId() Group by the employee_id column
 * @method     ChildExportExpenseStatusViewQuery groupByPositionId() Group by the position_id column
 * @method     ChildExportExpenseStatusViewQuery groupByOrgunitid() Group by the orgunitid column
 * @method     ChildExportExpenseStatusViewQuery groupByBuName() Group by the bu_name column
 * @method     ChildExportExpenseStatusViewQuery groupByEmpPositionCode() Group by the emp_position_code column
 * @method     ChildExportExpenseStatusViewQuery groupByEmpPositionName() Group by the emp_position_name column
 * @method     ChildExportExpenseStatusViewQuery groupByEmpLevel() Group by the emp_level column
 * @method     ChildExportExpenseStatusViewQuery groupByEmployeeCode() Group by the employee_code column
 * @method     ChildExportExpenseStatusViewQuery groupByEmployeeName() Group by the employee_name column
 * @method     ChildExportExpenseStatusViewQuery groupByReportingToEmployeeName() Group by the reporting_to_employee_name column
 * @method     ChildExportExpenseStatusViewQuery groupByReportingToEmployeeCode() Group by the reporting_to_employee_code column
 * @method     ChildExportExpenseStatusViewQuery groupByEmpTown() Group by the emp_town column
 * @method     ChildExportExpenseStatusViewQuery groupByEmpBranch() Group by the emp_branch column
 * @method     ChildExportExpenseStatusViewQuery groupByDesignation() Group by the designation column
 * @method     ChildExportExpenseStatusViewQuery groupByGrade() Group by the grade column
 * @method     ChildExportExpenseStatusViewQuery groupByStatus() Group by the status column
 * @method     ChildExportExpenseStatusViewQuery groupByMonth() Group by the month column
 * @method     ChildExportExpenseStatusViewQuery groupByRequestedAmount() Group by the requested_amount column
 * @method     ChildExportExpenseStatusViewQuery groupByApprovedAmount() Group by the approved_amount column
 * @method     ChildExportExpenseStatusViewQuery groupByFinalAmount() Group by the final_amount column
 * @method     ChildExportExpenseStatusViewQuery groupByExpenseStatus() Group by the expense_status column
 * @method     ChildExportExpenseStatusViewQuery groupByTotalExpenses() Group by the total_expenses column
 * @method     ChildExportExpenseStatusViewQuery groupByExpenseDates() Group by the expense_dates column
 *
 * @method     ChildExportExpenseStatusViewQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildExportExpenseStatusViewQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildExportExpenseStatusViewQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildExportExpenseStatusViewQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildExportExpenseStatusViewQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildExportExpenseStatusViewQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildExportExpenseStatusView|null findOne(?ConnectionInterface $con = null) Return the first ChildExportExpenseStatusView matching the query
 * @method     ChildExportExpenseStatusView findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildExportExpenseStatusView matching the query, or a new ChildExportExpenseStatusView object populated from the query conditions when no match is found
 *
 * @method     ChildExportExpenseStatusView|null findOneByUniqueid(int $uniqueid) Return the first ChildExportExpenseStatusView filtered by the uniqueid column
 * @method     ChildExportExpenseStatusView|null findOneByEmployeeId(int $employee_id) Return the first ChildExportExpenseStatusView filtered by the employee_id column
 * @method     ChildExportExpenseStatusView|null findOneByPositionId(int $position_id) Return the first ChildExportExpenseStatusView filtered by the position_id column
 * @method     ChildExportExpenseStatusView|null findOneByOrgunitid(int $orgunitid) Return the first ChildExportExpenseStatusView filtered by the orgunitid column
 * @method     ChildExportExpenseStatusView|null findOneByBuName(string $bu_name) Return the first ChildExportExpenseStatusView filtered by the bu_name column
 * @method     ChildExportExpenseStatusView|null findOneByEmpPositionCode(string $emp_position_code) Return the first ChildExportExpenseStatusView filtered by the emp_position_code column
 * @method     ChildExportExpenseStatusView|null findOneByEmpPositionName(string $emp_position_name) Return the first ChildExportExpenseStatusView filtered by the emp_position_name column
 * @method     ChildExportExpenseStatusView|null findOneByEmpLevel(string $emp_level) Return the first ChildExportExpenseStatusView filtered by the emp_level column
 * @method     ChildExportExpenseStatusView|null findOneByEmployeeCode(string $employee_code) Return the first ChildExportExpenseStatusView filtered by the employee_code column
 * @method     ChildExportExpenseStatusView|null findOneByEmployeeName(string $employee_name) Return the first ChildExportExpenseStatusView filtered by the employee_name column
 * @method     ChildExportExpenseStatusView|null findOneByReportingToEmployeeName(string $reporting_to_employee_name) Return the first ChildExportExpenseStatusView filtered by the reporting_to_employee_name column
 * @method     ChildExportExpenseStatusView|null findOneByReportingToEmployeeCode(string $reporting_to_employee_code) Return the first ChildExportExpenseStatusView filtered by the reporting_to_employee_code column
 * @method     ChildExportExpenseStatusView|null findOneByEmpTown(string $emp_town) Return the first ChildExportExpenseStatusView filtered by the emp_town column
 * @method     ChildExportExpenseStatusView|null findOneByEmpBranch(string $emp_branch) Return the first ChildExportExpenseStatusView filtered by the emp_branch column
 * @method     ChildExportExpenseStatusView|null findOneByDesignation(string $designation) Return the first ChildExportExpenseStatusView filtered by the designation column
 * @method     ChildExportExpenseStatusView|null findOneByGrade(string $grade) Return the first ChildExportExpenseStatusView filtered by the grade column
 * @method     ChildExportExpenseStatusView|null findOneByStatus(string $status) Return the first ChildExportExpenseStatusView filtered by the status column
 * @method     ChildExportExpenseStatusView|null findOneByMonth(string $month) Return the first ChildExportExpenseStatusView filtered by the month column
 * @method     ChildExportExpenseStatusView|null findOneByRequestedAmount(string $requested_amount) Return the first ChildExportExpenseStatusView filtered by the requested_amount column
 * @method     ChildExportExpenseStatusView|null findOneByApprovedAmount(string $approved_amount) Return the first ChildExportExpenseStatusView filtered by the approved_amount column
 * @method     ChildExportExpenseStatusView|null findOneByFinalAmount(string $final_amount) Return the first ChildExportExpenseStatusView filtered by the final_amount column
 * @method     ChildExportExpenseStatusView|null findOneByExpenseStatus(string $expense_status) Return the first ChildExportExpenseStatusView filtered by the expense_status column
 * @method     ChildExportExpenseStatusView|null findOneByTotalExpenses(int $total_expenses) Return the first ChildExportExpenseStatusView filtered by the total_expenses column
 * @method     ChildExportExpenseStatusView|null findOneByExpenseDates(string $expense_dates) Return the first ChildExportExpenseStatusView filtered by the expense_dates column
 *
 * @method     ChildExportExpenseStatusView requirePk($key, ?ConnectionInterface $con = null) Return the ChildExportExpenseStatusView by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpenseStatusView requireOne(?ConnectionInterface $con = null) Return the first ChildExportExpenseStatusView matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildExportExpenseStatusView requireOneByUniqueid(int $uniqueid) Return the first ChildExportExpenseStatusView filtered by the uniqueid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpenseStatusView requireOneByEmployeeId(int $employee_id) Return the first ChildExportExpenseStatusView filtered by the employee_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpenseStatusView requireOneByPositionId(int $position_id) Return the first ChildExportExpenseStatusView filtered by the position_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpenseStatusView requireOneByOrgunitid(int $orgunitid) Return the first ChildExportExpenseStatusView filtered by the orgunitid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpenseStatusView requireOneByBuName(string $bu_name) Return the first ChildExportExpenseStatusView filtered by the bu_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpenseStatusView requireOneByEmpPositionCode(string $emp_position_code) Return the first ChildExportExpenseStatusView filtered by the emp_position_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpenseStatusView requireOneByEmpPositionName(string $emp_position_name) Return the first ChildExportExpenseStatusView filtered by the emp_position_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpenseStatusView requireOneByEmpLevel(string $emp_level) Return the first ChildExportExpenseStatusView filtered by the emp_level column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpenseStatusView requireOneByEmployeeCode(string $employee_code) Return the first ChildExportExpenseStatusView filtered by the employee_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpenseStatusView requireOneByEmployeeName(string $employee_name) Return the first ChildExportExpenseStatusView filtered by the employee_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpenseStatusView requireOneByReportingToEmployeeName(string $reporting_to_employee_name) Return the first ChildExportExpenseStatusView filtered by the reporting_to_employee_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpenseStatusView requireOneByReportingToEmployeeCode(string $reporting_to_employee_code) Return the first ChildExportExpenseStatusView filtered by the reporting_to_employee_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpenseStatusView requireOneByEmpTown(string $emp_town) Return the first ChildExportExpenseStatusView filtered by the emp_town column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpenseStatusView requireOneByEmpBranch(string $emp_branch) Return the first ChildExportExpenseStatusView filtered by the emp_branch column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpenseStatusView requireOneByDesignation(string $designation) Return the first ChildExportExpenseStatusView filtered by the designation column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpenseStatusView requireOneByGrade(string $grade) Return the first ChildExportExpenseStatusView filtered by the grade column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpenseStatusView requireOneByStatus(string $status) Return the first ChildExportExpenseStatusView filtered by the status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpenseStatusView requireOneByMonth(string $month) Return the first ChildExportExpenseStatusView filtered by the month column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpenseStatusView requireOneByRequestedAmount(string $requested_amount) Return the first ChildExportExpenseStatusView filtered by the requested_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpenseStatusView requireOneByApprovedAmount(string $approved_amount) Return the first ChildExportExpenseStatusView filtered by the approved_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpenseStatusView requireOneByFinalAmount(string $final_amount) Return the first ChildExportExpenseStatusView filtered by the final_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpenseStatusView requireOneByExpenseStatus(string $expense_status) Return the first ChildExportExpenseStatusView filtered by the expense_status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpenseStatusView requireOneByTotalExpenses(int $total_expenses) Return the first ChildExportExpenseStatusView filtered by the total_expenses column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpenseStatusView requireOneByExpenseDates(string $expense_dates) Return the first ChildExportExpenseStatusView filtered by the expense_dates column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildExportExpenseStatusView[]|Collection find(?ConnectionInterface $con = null) Return ChildExportExpenseStatusView objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildExportExpenseStatusView> find(?ConnectionInterface $con = null) Return ChildExportExpenseStatusView objects based on current ModelCriteria
 *
 * @method     ChildExportExpenseStatusView[]|Collection findByUniqueid(int|array<int> $uniqueid) Return ChildExportExpenseStatusView objects filtered by the uniqueid column
 * @psalm-method Collection&\Traversable<ChildExportExpenseStatusView> findByUniqueid(int|array<int> $uniqueid) Return ChildExportExpenseStatusView objects filtered by the uniqueid column
 * @method     ChildExportExpenseStatusView[]|Collection findByEmployeeId(int|array<int> $employee_id) Return ChildExportExpenseStatusView objects filtered by the employee_id column
 * @psalm-method Collection&\Traversable<ChildExportExpenseStatusView> findByEmployeeId(int|array<int> $employee_id) Return ChildExportExpenseStatusView objects filtered by the employee_id column
 * @method     ChildExportExpenseStatusView[]|Collection findByPositionId(int|array<int> $position_id) Return ChildExportExpenseStatusView objects filtered by the position_id column
 * @psalm-method Collection&\Traversable<ChildExportExpenseStatusView> findByPositionId(int|array<int> $position_id) Return ChildExportExpenseStatusView objects filtered by the position_id column
 * @method     ChildExportExpenseStatusView[]|Collection findByOrgunitid(int|array<int> $orgunitid) Return ChildExportExpenseStatusView objects filtered by the orgunitid column
 * @psalm-method Collection&\Traversable<ChildExportExpenseStatusView> findByOrgunitid(int|array<int> $orgunitid) Return ChildExportExpenseStatusView objects filtered by the orgunitid column
 * @method     ChildExportExpenseStatusView[]|Collection findByBuName(string|array<string> $bu_name) Return ChildExportExpenseStatusView objects filtered by the bu_name column
 * @psalm-method Collection&\Traversable<ChildExportExpenseStatusView> findByBuName(string|array<string> $bu_name) Return ChildExportExpenseStatusView objects filtered by the bu_name column
 * @method     ChildExportExpenseStatusView[]|Collection findByEmpPositionCode(string|array<string> $emp_position_code) Return ChildExportExpenseStatusView objects filtered by the emp_position_code column
 * @psalm-method Collection&\Traversable<ChildExportExpenseStatusView> findByEmpPositionCode(string|array<string> $emp_position_code) Return ChildExportExpenseStatusView objects filtered by the emp_position_code column
 * @method     ChildExportExpenseStatusView[]|Collection findByEmpPositionName(string|array<string> $emp_position_name) Return ChildExportExpenseStatusView objects filtered by the emp_position_name column
 * @psalm-method Collection&\Traversable<ChildExportExpenseStatusView> findByEmpPositionName(string|array<string> $emp_position_name) Return ChildExportExpenseStatusView objects filtered by the emp_position_name column
 * @method     ChildExportExpenseStatusView[]|Collection findByEmpLevel(string|array<string> $emp_level) Return ChildExportExpenseStatusView objects filtered by the emp_level column
 * @psalm-method Collection&\Traversable<ChildExportExpenseStatusView> findByEmpLevel(string|array<string> $emp_level) Return ChildExportExpenseStatusView objects filtered by the emp_level column
 * @method     ChildExportExpenseStatusView[]|Collection findByEmployeeCode(string|array<string> $employee_code) Return ChildExportExpenseStatusView objects filtered by the employee_code column
 * @psalm-method Collection&\Traversable<ChildExportExpenseStatusView> findByEmployeeCode(string|array<string> $employee_code) Return ChildExportExpenseStatusView objects filtered by the employee_code column
 * @method     ChildExportExpenseStatusView[]|Collection findByEmployeeName(string|array<string> $employee_name) Return ChildExportExpenseStatusView objects filtered by the employee_name column
 * @psalm-method Collection&\Traversable<ChildExportExpenseStatusView> findByEmployeeName(string|array<string> $employee_name) Return ChildExportExpenseStatusView objects filtered by the employee_name column
 * @method     ChildExportExpenseStatusView[]|Collection findByReportingToEmployeeName(string|array<string> $reporting_to_employee_name) Return ChildExportExpenseStatusView objects filtered by the reporting_to_employee_name column
 * @psalm-method Collection&\Traversable<ChildExportExpenseStatusView> findByReportingToEmployeeName(string|array<string> $reporting_to_employee_name) Return ChildExportExpenseStatusView objects filtered by the reporting_to_employee_name column
 * @method     ChildExportExpenseStatusView[]|Collection findByReportingToEmployeeCode(string|array<string> $reporting_to_employee_code) Return ChildExportExpenseStatusView objects filtered by the reporting_to_employee_code column
 * @psalm-method Collection&\Traversable<ChildExportExpenseStatusView> findByReportingToEmployeeCode(string|array<string> $reporting_to_employee_code) Return ChildExportExpenseStatusView objects filtered by the reporting_to_employee_code column
 * @method     ChildExportExpenseStatusView[]|Collection findByEmpTown(string|array<string> $emp_town) Return ChildExportExpenseStatusView objects filtered by the emp_town column
 * @psalm-method Collection&\Traversable<ChildExportExpenseStatusView> findByEmpTown(string|array<string> $emp_town) Return ChildExportExpenseStatusView objects filtered by the emp_town column
 * @method     ChildExportExpenseStatusView[]|Collection findByEmpBranch(string|array<string> $emp_branch) Return ChildExportExpenseStatusView objects filtered by the emp_branch column
 * @psalm-method Collection&\Traversable<ChildExportExpenseStatusView> findByEmpBranch(string|array<string> $emp_branch) Return ChildExportExpenseStatusView objects filtered by the emp_branch column
 * @method     ChildExportExpenseStatusView[]|Collection findByDesignation(string|array<string> $designation) Return ChildExportExpenseStatusView objects filtered by the designation column
 * @psalm-method Collection&\Traversable<ChildExportExpenseStatusView> findByDesignation(string|array<string> $designation) Return ChildExportExpenseStatusView objects filtered by the designation column
 * @method     ChildExportExpenseStatusView[]|Collection findByGrade(string|array<string> $grade) Return ChildExportExpenseStatusView objects filtered by the grade column
 * @psalm-method Collection&\Traversable<ChildExportExpenseStatusView> findByGrade(string|array<string> $grade) Return ChildExportExpenseStatusView objects filtered by the grade column
 * @method     ChildExportExpenseStatusView[]|Collection findByStatus(string|array<string> $status) Return ChildExportExpenseStatusView objects filtered by the status column
 * @psalm-method Collection&\Traversable<ChildExportExpenseStatusView> findByStatus(string|array<string> $status) Return ChildExportExpenseStatusView objects filtered by the status column
 * @method     ChildExportExpenseStatusView[]|Collection findByMonth(string|array<string> $month) Return ChildExportExpenseStatusView objects filtered by the month column
 * @psalm-method Collection&\Traversable<ChildExportExpenseStatusView> findByMonth(string|array<string> $month) Return ChildExportExpenseStatusView objects filtered by the month column
 * @method     ChildExportExpenseStatusView[]|Collection findByRequestedAmount(string|array<string> $requested_amount) Return ChildExportExpenseStatusView objects filtered by the requested_amount column
 * @psalm-method Collection&\Traversable<ChildExportExpenseStatusView> findByRequestedAmount(string|array<string> $requested_amount) Return ChildExportExpenseStatusView objects filtered by the requested_amount column
 * @method     ChildExportExpenseStatusView[]|Collection findByApprovedAmount(string|array<string> $approved_amount) Return ChildExportExpenseStatusView objects filtered by the approved_amount column
 * @psalm-method Collection&\Traversable<ChildExportExpenseStatusView> findByApprovedAmount(string|array<string> $approved_amount) Return ChildExportExpenseStatusView objects filtered by the approved_amount column
 * @method     ChildExportExpenseStatusView[]|Collection findByFinalAmount(string|array<string> $final_amount) Return ChildExportExpenseStatusView objects filtered by the final_amount column
 * @psalm-method Collection&\Traversable<ChildExportExpenseStatusView> findByFinalAmount(string|array<string> $final_amount) Return ChildExportExpenseStatusView objects filtered by the final_amount column
 * @method     ChildExportExpenseStatusView[]|Collection findByExpenseStatus(string|array<string> $expense_status) Return ChildExportExpenseStatusView objects filtered by the expense_status column
 * @psalm-method Collection&\Traversable<ChildExportExpenseStatusView> findByExpenseStatus(string|array<string> $expense_status) Return ChildExportExpenseStatusView objects filtered by the expense_status column
 * @method     ChildExportExpenseStatusView[]|Collection findByTotalExpenses(int|array<int> $total_expenses) Return ChildExportExpenseStatusView objects filtered by the total_expenses column
 * @psalm-method Collection&\Traversable<ChildExportExpenseStatusView> findByTotalExpenses(int|array<int> $total_expenses) Return ChildExportExpenseStatusView objects filtered by the total_expenses column
 * @method     ChildExportExpenseStatusView[]|Collection findByExpenseDates(string|array<string> $expense_dates) Return ChildExportExpenseStatusView objects filtered by the expense_dates column
 * @psalm-method Collection&\Traversable<ChildExportExpenseStatusView> findByExpenseDates(string|array<string> $expense_dates) Return ChildExportExpenseStatusView objects filtered by the expense_dates column
 *
 * @method     ChildExportExpenseStatusView[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildExportExpenseStatusView> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class ExportExpenseStatusViewQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\ExportExpenseStatusViewQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\ExportExpenseStatusView', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildExportExpenseStatusViewQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildExportExpenseStatusViewQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildExportExpenseStatusViewQuery) {
            return $criteria;
        }
        $query = new ChildExportExpenseStatusViewQuery();
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
     * @return ChildExportExpenseStatusView|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ExportExpenseStatusViewTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ExportExpenseStatusViewTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildExportExpenseStatusView A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT uniqueid, employee_id, position_id, orgunitid, bu_name, emp_position_code, emp_position_name, emp_level, employee_code, employee_name, reporting_to_employee_name, reporting_to_employee_code, emp_town, emp_branch, designation, grade, status, month, requested_amount, approved_amount, final_amount, expense_status, total_expenses, expense_dates FROM export_expense_status_view WHERE uniqueid = :p0';
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
            /** @var ChildExportExpenseStatusView $obj */
            $obj = new ChildExportExpenseStatusView();
            $obj->hydrate($row);
            ExportExpenseStatusViewTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildExportExpenseStatusView|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(ExportExpenseStatusViewTableMap::COL_UNIQUEID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(ExportExpenseStatusViewTableMap::COL_UNIQUEID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the uniqueid column
     *
     * Example usage:
     * <code>
     * $query->filterByUniqueid(1234); // WHERE uniqueid = 1234
     * $query->filterByUniqueid(array(12, 34)); // WHERE uniqueid IN (12, 34)
     * $query->filterByUniqueid(array('min' => 12)); // WHERE uniqueid > 12
     * </code>
     *
     * @param mixed $uniqueid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUniqueid($uniqueid = null, ?string $comparison = null)
    {
        if (is_array($uniqueid)) {
            $useMinMax = false;
            if (isset($uniqueid['min'])) {
                $this->addUsingAlias(ExportExpenseStatusViewTableMap::COL_UNIQUEID, $uniqueid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($uniqueid['max'])) {
                $this->addUsingAlias(ExportExpenseStatusViewTableMap::COL_UNIQUEID, $uniqueid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpenseStatusViewTableMap::COL_UNIQUEID, $uniqueid, $comparison);

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
                $this->addUsingAlias(ExportExpenseStatusViewTableMap::COL_EMPLOYEE_ID, $employeeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($employeeId['max'])) {
                $this->addUsingAlias(ExportExpenseStatusViewTableMap::COL_EMPLOYEE_ID, $employeeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpenseStatusViewTableMap::COL_EMPLOYEE_ID, $employeeId, $comparison);

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
                $this->addUsingAlias(ExportExpenseStatusViewTableMap::COL_POSITION_ID, $positionId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($positionId['max'])) {
                $this->addUsingAlias(ExportExpenseStatusViewTableMap::COL_POSITION_ID, $positionId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpenseStatusViewTableMap::COL_POSITION_ID, $positionId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the orgunitid column
     *
     * Example usage:
     * <code>
     * $query->filterByOrgunitid(1234); // WHERE orgunitid = 1234
     * $query->filterByOrgunitid(array(12, 34)); // WHERE orgunitid IN (12, 34)
     * $query->filterByOrgunitid(array('min' => 12)); // WHERE orgunitid > 12
     * </code>
     *
     * @param mixed $orgunitid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrgunitid($orgunitid = null, ?string $comparison = null)
    {
        if (is_array($orgunitid)) {
            $useMinMax = false;
            if (isset($orgunitid['min'])) {
                $this->addUsingAlias(ExportExpenseStatusViewTableMap::COL_ORGUNITID, $orgunitid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($orgunitid['max'])) {
                $this->addUsingAlias(ExportExpenseStatusViewTableMap::COL_ORGUNITID, $orgunitid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpenseStatusViewTableMap::COL_ORGUNITID, $orgunitid, $comparison);

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

        $this->addUsingAlias(ExportExpenseStatusViewTableMap::COL_BU_NAME, $buName, $comparison);

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

        $this->addUsingAlias(ExportExpenseStatusViewTableMap::COL_EMP_POSITION_CODE, $empPositionCode, $comparison);

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

        $this->addUsingAlias(ExportExpenseStatusViewTableMap::COL_EMP_POSITION_NAME, $empPositionName, $comparison);

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

        $this->addUsingAlias(ExportExpenseStatusViewTableMap::COL_EMP_LEVEL, $empLevel, $comparison);

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

        $this->addUsingAlias(ExportExpenseStatusViewTableMap::COL_EMPLOYEE_CODE, $employeeCode, $comparison);

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

        $this->addUsingAlias(ExportExpenseStatusViewTableMap::COL_EMPLOYEE_NAME, $employeeName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the reporting_to_employee_name column
     *
     * Example usage:
     * <code>
     * $query->filterByReportingToEmployeeName('fooValue');   // WHERE reporting_to_employee_name = 'fooValue'
     * $query->filterByReportingToEmployeeName('%fooValue%', Criteria::LIKE); // WHERE reporting_to_employee_name LIKE '%fooValue%'
     * $query->filterByReportingToEmployeeName(['foo', 'bar']); // WHERE reporting_to_employee_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $reportingToEmployeeName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByReportingToEmployeeName($reportingToEmployeeName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($reportingToEmployeeName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpenseStatusViewTableMap::COL_REPORTING_TO_EMPLOYEE_NAME, $reportingToEmployeeName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the reporting_to_employee_code column
     *
     * Example usage:
     * <code>
     * $query->filterByReportingToEmployeeCode('fooValue');   // WHERE reporting_to_employee_code = 'fooValue'
     * $query->filterByReportingToEmployeeCode('%fooValue%', Criteria::LIKE); // WHERE reporting_to_employee_code LIKE '%fooValue%'
     * $query->filterByReportingToEmployeeCode(['foo', 'bar']); // WHERE reporting_to_employee_code IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $reportingToEmployeeCode The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByReportingToEmployeeCode($reportingToEmployeeCode = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($reportingToEmployeeCode)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpenseStatusViewTableMap::COL_REPORTING_TO_EMPLOYEE_CODE, $reportingToEmployeeCode, $comparison);

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

        $this->addUsingAlias(ExportExpenseStatusViewTableMap::COL_EMP_TOWN, $empTown, $comparison);

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

        $this->addUsingAlias(ExportExpenseStatusViewTableMap::COL_EMP_BRANCH, $empBranch, $comparison);

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

        $this->addUsingAlias(ExportExpenseStatusViewTableMap::COL_DESIGNATION, $designation, $comparison);

        return $this;
    }

    /**
     * Filter the query on the grade column
     *
     * Example usage:
     * <code>
     * $query->filterByGrade('fooValue');   // WHERE grade = 'fooValue'
     * $query->filterByGrade('%fooValue%', Criteria::LIKE); // WHERE grade LIKE '%fooValue%'
     * $query->filterByGrade(['foo', 'bar']); // WHERE grade IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $grade The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByGrade($grade = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($grade)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpenseStatusViewTableMap::COL_GRADE, $grade, $comparison);

        return $this;
    }

    /**
     * Filter the query on the status column
     *
     * Example usage:
     * <code>
     * $query->filterByStatus('fooValue');   // WHERE status = 'fooValue'
     * $query->filterByStatus('%fooValue%', Criteria::LIKE); // WHERE status LIKE '%fooValue%'
     * $query->filterByStatus(['foo', 'bar']); // WHERE status IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $status The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStatus($status = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($status)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpenseStatusViewTableMap::COL_STATUS, $status, $comparison);

        return $this;
    }

    /**
     * Filter the query on the month column
     *
     * Example usage:
     * <code>
     * $query->filterByMonth('fooValue');   // WHERE month = 'fooValue'
     * $query->filterByMonth('%fooValue%', Criteria::LIKE); // WHERE month LIKE '%fooValue%'
     * $query->filterByMonth(['foo', 'bar']); // WHERE month IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $month The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMonth($month = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($month)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpenseStatusViewTableMap::COL_MONTH, $month, $comparison);

        return $this;
    }

    /**
     * Filter the query on the requested_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByRequestedAmount(1234); // WHERE requested_amount = 1234
     * $query->filterByRequestedAmount(array(12, 34)); // WHERE requested_amount IN (12, 34)
     * $query->filterByRequestedAmount(array('min' => 12)); // WHERE requested_amount > 12
     * </code>
     *
     * @param mixed $requestedAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRequestedAmount($requestedAmount = null, ?string $comparison = null)
    {
        if (is_array($requestedAmount)) {
            $useMinMax = false;
            if (isset($requestedAmount['min'])) {
                $this->addUsingAlias(ExportExpenseStatusViewTableMap::COL_REQUESTED_AMOUNT, $requestedAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($requestedAmount['max'])) {
                $this->addUsingAlias(ExportExpenseStatusViewTableMap::COL_REQUESTED_AMOUNT, $requestedAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpenseStatusViewTableMap::COL_REQUESTED_AMOUNT, $requestedAmount, $comparison);

        return $this;
    }

    /**
     * Filter the query on the approved_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByApprovedAmount(1234); // WHERE approved_amount = 1234
     * $query->filterByApprovedAmount(array(12, 34)); // WHERE approved_amount IN (12, 34)
     * $query->filterByApprovedAmount(array('min' => 12)); // WHERE approved_amount > 12
     * </code>
     *
     * @param mixed $approvedAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByApprovedAmount($approvedAmount = null, ?string $comparison = null)
    {
        if (is_array($approvedAmount)) {
            $useMinMax = false;
            if (isset($approvedAmount['min'])) {
                $this->addUsingAlias(ExportExpenseStatusViewTableMap::COL_APPROVED_AMOUNT, $approvedAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($approvedAmount['max'])) {
                $this->addUsingAlias(ExportExpenseStatusViewTableMap::COL_APPROVED_AMOUNT, $approvedAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpenseStatusViewTableMap::COL_APPROVED_AMOUNT, $approvedAmount, $comparison);

        return $this;
    }

    /**
     * Filter the query on the final_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByFinalAmount(1234); // WHERE final_amount = 1234
     * $query->filterByFinalAmount(array(12, 34)); // WHERE final_amount IN (12, 34)
     * $query->filterByFinalAmount(array('min' => 12)); // WHERE final_amount > 12
     * </code>
     *
     * @param mixed $finalAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFinalAmount($finalAmount = null, ?string $comparison = null)
    {
        if (is_array($finalAmount)) {
            $useMinMax = false;
            if (isset($finalAmount['min'])) {
                $this->addUsingAlias(ExportExpenseStatusViewTableMap::COL_FINAL_AMOUNT, $finalAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($finalAmount['max'])) {
                $this->addUsingAlias(ExportExpenseStatusViewTableMap::COL_FINAL_AMOUNT, $finalAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpenseStatusViewTableMap::COL_FINAL_AMOUNT, $finalAmount, $comparison);

        return $this;
    }

    /**
     * Filter the query on the expense_status column
     *
     * Example usage:
     * <code>
     * $query->filterByExpenseStatus('fooValue');   // WHERE expense_status = 'fooValue'
     * $query->filterByExpenseStatus('%fooValue%', Criteria::LIKE); // WHERE expense_status LIKE '%fooValue%'
     * $query->filterByExpenseStatus(['foo', 'bar']); // WHERE expense_status IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $expenseStatus The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpenseStatus($expenseStatus = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($expenseStatus)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpenseStatusViewTableMap::COL_EXPENSE_STATUS, $expenseStatus, $comparison);

        return $this;
    }

    /**
     * Filter the query on the total_expenses column
     *
     * Example usage:
     * <code>
     * $query->filterByTotalExpenses(1234); // WHERE total_expenses = 1234
     * $query->filterByTotalExpenses(array(12, 34)); // WHERE total_expenses IN (12, 34)
     * $query->filterByTotalExpenses(array('min' => 12)); // WHERE total_expenses > 12
     * </code>
     *
     * @param mixed $totalExpenses The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTotalExpenses($totalExpenses = null, ?string $comparison = null)
    {
        if (is_array($totalExpenses)) {
            $useMinMax = false;
            if (isset($totalExpenses['min'])) {
                $this->addUsingAlias(ExportExpenseStatusViewTableMap::COL_TOTAL_EXPENSES, $totalExpenses['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($totalExpenses['max'])) {
                $this->addUsingAlias(ExportExpenseStatusViewTableMap::COL_TOTAL_EXPENSES, $totalExpenses['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpenseStatusViewTableMap::COL_TOTAL_EXPENSES, $totalExpenses, $comparison);

        return $this;
    }

    /**
     * Filter the query on the expense_dates column
     *
     * Example usage:
     * <code>
     * $query->filterByExpenseDates('fooValue');   // WHERE expense_dates = 'fooValue'
     * $query->filterByExpenseDates('%fooValue%', Criteria::LIKE); // WHERE expense_dates LIKE '%fooValue%'
     * $query->filterByExpenseDates(['foo', 'bar']); // WHERE expense_dates IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $expenseDates The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpenseDates($expenseDates = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($expenseDates)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpenseStatusViewTableMap::COL_EXPENSE_DATES, $expenseDates, $comparison);

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildExportExpenseStatusView $exportExpenseStatusView Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($exportExpenseStatusView = null)
    {
        if ($exportExpenseStatusView) {
            $this->addUsingAlias(ExportExpenseStatusViewTableMap::COL_UNIQUEID, $exportExpenseStatusView->getUniqueid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
