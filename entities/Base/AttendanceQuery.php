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
use entities\Attendance as ChildAttendance;
use entities\AttendanceQuery as ChildAttendanceQuery;
use entities\Map\AttendanceTableMap;

/**
 * Base class that represents a query for the `attendance` table.
 *
 * @method     ChildAttendanceQuery orderByAttendanceId($order = Criteria::ASC) Order by the attendance_id column
 * @method     ChildAttendanceQuery orderByEmployeeId($order = Criteria::ASC) Order by the employee_id column
 * @method     ChildAttendanceQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildAttendanceQuery orderByAttendanceDate($order = Criteria::ASC) Order by the attendance_date column
 * @method     ChildAttendanceQuery orderByStartTime($order = Criteria::ASC) Order by the start_time column
 * @method     ChildAttendanceQuery orderByEndTime($order = Criteria::ASC) Order by the end_time column
 * @method     ChildAttendanceQuery orderByStartLatlng($order = Criteria::ASC) Order by the start_latlng column
 * @method     ChildAttendanceQuery orderByStartAddress($order = Criteria::ASC) Order by the start_address column
 * @method     ChildAttendanceQuery orderByEndLatlng($order = Criteria::ASC) Order by the end_latlng column
 * @method     ChildAttendanceQuery orderByEndAddress($order = Criteria::ASC) Order by the end_address column
 * @method     ChildAttendanceQuery orderByShiftMins($order = Criteria::ASC) Order by the shift_mins column
 * @method     ChildAttendanceQuery orderByJointEmp($order = Criteria::ASC) Order by the joint_emp column
 * @method     ChildAttendanceQuery orderByRemark($order = Criteria::ASC) Order by the remark column
 * @method     ChildAttendanceQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method     ChildAttendanceQuery orderByOutletCount($order = Criteria::ASC) Order by the outlet_count column
 * @method     ChildAttendanceQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildAttendanceQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildAttendanceQuery orderByStartItownid($order = Criteria::ASC) Order by the start_itownid column
 * @method     ChildAttendanceQuery orderByEndItownid($order = Criteria::ASC) Order by the end_itownid column
 * @method     ChildAttendanceQuery orderByVisitedItownid($order = Criteria::ASC) Order by the visited_itownid column
 * @method     ChildAttendanceQuery orderByExpenseId($order = Criteria::ASC) Order by the expense_id column
 * @method     ChildAttendanceQuery orderByIsUpdated($order = Criteria::ASC) Order by the is_updated column
 * @method     ChildAttendanceQuery orderByExpenseGenerated($order = Criteria::ASC) Order by the expense_generated column
 * @method     ChildAttendanceQuery orderByExpenseRemark($order = Criteria::ASC) Order by the expense_remark column
 *
 * @method     ChildAttendanceQuery groupByAttendanceId() Group by the attendance_id column
 * @method     ChildAttendanceQuery groupByEmployeeId() Group by the employee_id column
 * @method     ChildAttendanceQuery groupByCompanyId() Group by the company_id column
 * @method     ChildAttendanceQuery groupByAttendanceDate() Group by the attendance_date column
 * @method     ChildAttendanceQuery groupByStartTime() Group by the start_time column
 * @method     ChildAttendanceQuery groupByEndTime() Group by the end_time column
 * @method     ChildAttendanceQuery groupByStartLatlng() Group by the start_latlng column
 * @method     ChildAttendanceQuery groupByStartAddress() Group by the start_address column
 * @method     ChildAttendanceQuery groupByEndLatlng() Group by the end_latlng column
 * @method     ChildAttendanceQuery groupByEndAddress() Group by the end_address column
 * @method     ChildAttendanceQuery groupByShiftMins() Group by the shift_mins column
 * @method     ChildAttendanceQuery groupByJointEmp() Group by the joint_emp column
 * @method     ChildAttendanceQuery groupByRemark() Group by the remark column
 * @method     ChildAttendanceQuery groupByStatus() Group by the status column
 * @method     ChildAttendanceQuery groupByOutletCount() Group by the outlet_count column
 * @method     ChildAttendanceQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildAttendanceQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildAttendanceQuery groupByStartItownid() Group by the start_itownid column
 * @method     ChildAttendanceQuery groupByEndItownid() Group by the end_itownid column
 * @method     ChildAttendanceQuery groupByVisitedItownid() Group by the visited_itownid column
 * @method     ChildAttendanceQuery groupByExpenseId() Group by the expense_id column
 * @method     ChildAttendanceQuery groupByIsUpdated() Group by the is_updated column
 * @method     ChildAttendanceQuery groupByExpenseGenerated() Group by the expense_generated column
 * @method     ChildAttendanceQuery groupByExpenseRemark() Group by the expense_remark column
 *
 * @method     ChildAttendanceQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildAttendanceQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildAttendanceQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildAttendanceQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildAttendanceQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildAttendanceQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildAttendanceQuery leftJoinGeoTownsRelatedByEndItownid($relationAlias = null) Adds a LEFT JOIN clause to the query using the GeoTownsRelatedByEndItownid relation
 * @method     ChildAttendanceQuery rightJoinGeoTownsRelatedByEndItownid($relationAlias = null) Adds a RIGHT JOIN clause to the query using the GeoTownsRelatedByEndItownid relation
 * @method     ChildAttendanceQuery innerJoinGeoTownsRelatedByEndItownid($relationAlias = null) Adds a INNER JOIN clause to the query using the GeoTownsRelatedByEndItownid relation
 *
 * @method     ChildAttendanceQuery joinWithGeoTownsRelatedByEndItownid($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the GeoTownsRelatedByEndItownid relation
 *
 * @method     ChildAttendanceQuery leftJoinWithGeoTownsRelatedByEndItownid() Adds a LEFT JOIN clause and with to the query using the GeoTownsRelatedByEndItownid relation
 * @method     ChildAttendanceQuery rightJoinWithGeoTownsRelatedByEndItownid() Adds a RIGHT JOIN clause and with to the query using the GeoTownsRelatedByEndItownid relation
 * @method     ChildAttendanceQuery innerJoinWithGeoTownsRelatedByEndItownid() Adds a INNER JOIN clause and with to the query using the GeoTownsRelatedByEndItownid relation
 *
 * @method     ChildAttendanceQuery leftJoinExpenses($relationAlias = null) Adds a LEFT JOIN clause to the query using the Expenses relation
 * @method     ChildAttendanceQuery rightJoinExpenses($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Expenses relation
 * @method     ChildAttendanceQuery innerJoinExpenses($relationAlias = null) Adds a INNER JOIN clause to the query using the Expenses relation
 *
 * @method     ChildAttendanceQuery joinWithExpenses($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Expenses relation
 *
 * @method     ChildAttendanceQuery leftJoinWithExpenses() Adds a LEFT JOIN clause and with to the query using the Expenses relation
 * @method     ChildAttendanceQuery rightJoinWithExpenses() Adds a RIGHT JOIN clause and with to the query using the Expenses relation
 * @method     ChildAttendanceQuery innerJoinWithExpenses() Adds a INNER JOIN clause and with to the query using the Expenses relation
 *
 * @method     ChildAttendanceQuery leftJoinGeoTownsRelatedByStartItownid($relationAlias = null) Adds a LEFT JOIN clause to the query using the GeoTownsRelatedByStartItownid relation
 * @method     ChildAttendanceQuery rightJoinGeoTownsRelatedByStartItownid($relationAlias = null) Adds a RIGHT JOIN clause to the query using the GeoTownsRelatedByStartItownid relation
 * @method     ChildAttendanceQuery innerJoinGeoTownsRelatedByStartItownid($relationAlias = null) Adds a INNER JOIN clause to the query using the GeoTownsRelatedByStartItownid relation
 *
 * @method     ChildAttendanceQuery joinWithGeoTownsRelatedByStartItownid($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the GeoTownsRelatedByStartItownid relation
 *
 * @method     ChildAttendanceQuery leftJoinWithGeoTownsRelatedByStartItownid() Adds a LEFT JOIN clause and with to the query using the GeoTownsRelatedByStartItownid relation
 * @method     ChildAttendanceQuery rightJoinWithGeoTownsRelatedByStartItownid() Adds a RIGHT JOIN clause and with to the query using the GeoTownsRelatedByStartItownid relation
 * @method     ChildAttendanceQuery innerJoinWithGeoTownsRelatedByStartItownid() Adds a INNER JOIN clause and with to the query using the GeoTownsRelatedByStartItownid relation
 *
 * @method     ChildAttendanceQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildAttendanceQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildAttendanceQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildAttendanceQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildAttendanceQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildAttendanceQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildAttendanceQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     ChildAttendanceQuery leftJoinEmployee($relationAlias = null) Adds a LEFT JOIN clause to the query using the Employee relation
 * @method     ChildAttendanceQuery rightJoinEmployee($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Employee relation
 * @method     ChildAttendanceQuery innerJoinEmployee($relationAlias = null) Adds a INNER JOIN clause to the query using the Employee relation
 *
 * @method     ChildAttendanceQuery joinWithEmployee($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Employee relation
 *
 * @method     ChildAttendanceQuery leftJoinWithEmployee() Adds a LEFT JOIN clause and with to the query using the Employee relation
 * @method     ChildAttendanceQuery rightJoinWithEmployee() Adds a RIGHT JOIN clause and with to the query using the Employee relation
 * @method     ChildAttendanceQuery innerJoinWithEmployee() Adds a INNER JOIN clause and with to the query using the Employee relation
 *
 * @method     \entities\GeoTownsQuery|\entities\ExpensesQuery|\entities\GeoTownsQuery|\entities\CompanyQuery|\entities\EmployeeQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildAttendance|null findOne(?ConnectionInterface $con = null) Return the first ChildAttendance matching the query
 * @method     ChildAttendance findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildAttendance matching the query, or a new ChildAttendance object populated from the query conditions when no match is found
 *
 * @method     ChildAttendance|null findOneByAttendanceId(int $attendance_id) Return the first ChildAttendance filtered by the attendance_id column
 * @method     ChildAttendance|null findOneByEmployeeId(int $employee_id) Return the first ChildAttendance filtered by the employee_id column
 * @method     ChildAttendance|null findOneByCompanyId(int $company_id) Return the first ChildAttendance filtered by the company_id column
 * @method     ChildAttendance|null findOneByAttendanceDate(string $attendance_date) Return the first ChildAttendance filtered by the attendance_date column
 * @method     ChildAttendance|null findOneByStartTime(string $start_time) Return the first ChildAttendance filtered by the start_time column
 * @method     ChildAttendance|null findOneByEndTime(string $end_time) Return the first ChildAttendance filtered by the end_time column
 * @method     ChildAttendance|null findOneByStartLatlng(string $start_latlng) Return the first ChildAttendance filtered by the start_latlng column
 * @method     ChildAttendance|null findOneByStartAddress(string $start_address) Return the first ChildAttendance filtered by the start_address column
 * @method     ChildAttendance|null findOneByEndLatlng(string $end_latlng) Return the first ChildAttendance filtered by the end_latlng column
 * @method     ChildAttendance|null findOneByEndAddress(string $end_address) Return the first ChildAttendance filtered by the end_address column
 * @method     ChildAttendance|null findOneByShiftMins(string $shift_mins) Return the first ChildAttendance filtered by the shift_mins column
 * @method     ChildAttendance|null findOneByJointEmp(int $joint_emp) Return the first ChildAttendance filtered by the joint_emp column
 * @method     ChildAttendance|null findOneByRemark(string $remark) Return the first ChildAttendance filtered by the remark column
 * @method     ChildAttendance|null findOneByStatus(int $status) Return the first ChildAttendance filtered by the status column
 * @method     ChildAttendance|null findOneByOutletCount(int $outlet_count) Return the first ChildAttendance filtered by the outlet_count column
 * @method     ChildAttendance|null findOneByCreatedAt(string $created_at) Return the first ChildAttendance filtered by the created_at column
 * @method     ChildAttendance|null findOneByUpdatedAt(string $updated_at) Return the first ChildAttendance filtered by the updated_at column
 * @method     ChildAttendance|null findOneByStartItownid(int $start_itownid) Return the first ChildAttendance filtered by the start_itownid column
 * @method     ChildAttendance|null findOneByEndItownid(int $end_itownid) Return the first ChildAttendance filtered by the end_itownid column
 * @method     ChildAttendance|null findOneByVisitedItownid(string $visited_itownid) Return the first ChildAttendance filtered by the visited_itownid column
 * @method     ChildAttendance|null findOneByExpenseId(int $expense_id) Return the first ChildAttendance filtered by the expense_id column
 * @method     ChildAttendance|null findOneByIsUpdated(boolean $is_updated) Return the first ChildAttendance filtered by the is_updated column
 * @method     ChildAttendance|null findOneByExpenseGenerated(boolean $expense_generated) Return the first ChildAttendance filtered by the expense_generated column
 * @method     ChildAttendance|null findOneByExpenseRemark(string $expense_remark) Return the first ChildAttendance filtered by the expense_remark column
 *
 * @method     ChildAttendance requirePk($key, ?ConnectionInterface $con = null) Return the ChildAttendance by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAttendance requireOne(?ConnectionInterface $con = null) Return the first ChildAttendance matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildAttendance requireOneByAttendanceId(int $attendance_id) Return the first ChildAttendance filtered by the attendance_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAttendance requireOneByEmployeeId(int $employee_id) Return the first ChildAttendance filtered by the employee_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAttendance requireOneByCompanyId(int $company_id) Return the first ChildAttendance filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAttendance requireOneByAttendanceDate(string $attendance_date) Return the first ChildAttendance filtered by the attendance_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAttendance requireOneByStartTime(string $start_time) Return the first ChildAttendance filtered by the start_time column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAttendance requireOneByEndTime(string $end_time) Return the first ChildAttendance filtered by the end_time column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAttendance requireOneByStartLatlng(string $start_latlng) Return the first ChildAttendance filtered by the start_latlng column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAttendance requireOneByStartAddress(string $start_address) Return the first ChildAttendance filtered by the start_address column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAttendance requireOneByEndLatlng(string $end_latlng) Return the first ChildAttendance filtered by the end_latlng column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAttendance requireOneByEndAddress(string $end_address) Return the first ChildAttendance filtered by the end_address column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAttendance requireOneByShiftMins(string $shift_mins) Return the first ChildAttendance filtered by the shift_mins column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAttendance requireOneByJointEmp(int $joint_emp) Return the first ChildAttendance filtered by the joint_emp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAttendance requireOneByRemark(string $remark) Return the first ChildAttendance filtered by the remark column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAttendance requireOneByStatus(int $status) Return the first ChildAttendance filtered by the status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAttendance requireOneByOutletCount(int $outlet_count) Return the first ChildAttendance filtered by the outlet_count column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAttendance requireOneByCreatedAt(string $created_at) Return the first ChildAttendance filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAttendance requireOneByUpdatedAt(string $updated_at) Return the first ChildAttendance filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAttendance requireOneByStartItownid(int $start_itownid) Return the first ChildAttendance filtered by the start_itownid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAttendance requireOneByEndItownid(int $end_itownid) Return the first ChildAttendance filtered by the end_itownid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAttendance requireOneByVisitedItownid(string $visited_itownid) Return the first ChildAttendance filtered by the visited_itownid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAttendance requireOneByExpenseId(int $expense_id) Return the first ChildAttendance filtered by the expense_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAttendance requireOneByIsUpdated(boolean $is_updated) Return the first ChildAttendance filtered by the is_updated column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAttendance requireOneByExpenseGenerated(boolean $expense_generated) Return the first ChildAttendance filtered by the expense_generated column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAttendance requireOneByExpenseRemark(string $expense_remark) Return the first ChildAttendance filtered by the expense_remark column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildAttendance[]|Collection find(?ConnectionInterface $con = null) Return ChildAttendance objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildAttendance> find(?ConnectionInterface $con = null) Return ChildAttendance objects based on current ModelCriteria
 *
 * @method     ChildAttendance[]|Collection findByAttendanceId(int|array<int> $attendance_id) Return ChildAttendance objects filtered by the attendance_id column
 * @psalm-method Collection&\Traversable<ChildAttendance> findByAttendanceId(int|array<int> $attendance_id) Return ChildAttendance objects filtered by the attendance_id column
 * @method     ChildAttendance[]|Collection findByEmployeeId(int|array<int> $employee_id) Return ChildAttendance objects filtered by the employee_id column
 * @psalm-method Collection&\Traversable<ChildAttendance> findByEmployeeId(int|array<int> $employee_id) Return ChildAttendance objects filtered by the employee_id column
 * @method     ChildAttendance[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildAttendance objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildAttendance> findByCompanyId(int|array<int> $company_id) Return ChildAttendance objects filtered by the company_id column
 * @method     ChildAttendance[]|Collection findByAttendanceDate(string|array<string> $attendance_date) Return ChildAttendance objects filtered by the attendance_date column
 * @psalm-method Collection&\Traversable<ChildAttendance> findByAttendanceDate(string|array<string> $attendance_date) Return ChildAttendance objects filtered by the attendance_date column
 * @method     ChildAttendance[]|Collection findByStartTime(string|array<string> $start_time) Return ChildAttendance objects filtered by the start_time column
 * @psalm-method Collection&\Traversable<ChildAttendance> findByStartTime(string|array<string> $start_time) Return ChildAttendance objects filtered by the start_time column
 * @method     ChildAttendance[]|Collection findByEndTime(string|array<string> $end_time) Return ChildAttendance objects filtered by the end_time column
 * @psalm-method Collection&\Traversable<ChildAttendance> findByEndTime(string|array<string> $end_time) Return ChildAttendance objects filtered by the end_time column
 * @method     ChildAttendance[]|Collection findByStartLatlng(string|array<string> $start_latlng) Return ChildAttendance objects filtered by the start_latlng column
 * @psalm-method Collection&\Traversable<ChildAttendance> findByStartLatlng(string|array<string> $start_latlng) Return ChildAttendance objects filtered by the start_latlng column
 * @method     ChildAttendance[]|Collection findByStartAddress(string|array<string> $start_address) Return ChildAttendance objects filtered by the start_address column
 * @psalm-method Collection&\Traversable<ChildAttendance> findByStartAddress(string|array<string> $start_address) Return ChildAttendance objects filtered by the start_address column
 * @method     ChildAttendance[]|Collection findByEndLatlng(string|array<string> $end_latlng) Return ChildAttendance objects filtered by the end_latlng column
 * @psalm-method Collection&\Traversable<ChildAttendance> findByEndLatlng(string|array<string> $end_latlng) Return ChildAttendance objects filtered by the end_latlng column
 * @method     ChildAttendance[]|Collection findByEndAddress(string|array<string> $end_address) Return ChildAttendance objects filtered by the end_address column
 * @psalm-method Collection&\Traversable<ChildAttendance> findByEndAddress(string|array<string> $end_address) Return ChildAttendance objects filtered by the end_address column
 * @method     ChildAttendance[]|Collection findByShiftMins(string|array<string> $shift_mins) Return ChildAttendance objects filtered by the shift_mins column
 * @psalm-method Collection&\Traversable<ChildAttendance> findByShiftMins(string|array<string> $shift_mins) Return ChildAttendance objects filtered by the shift_mins column
 * @method     ChildAttendance[]|Collection findByJointEmp(int|array<int> $joint_emp) Return ChildAttendance objects filtered by the joint_emp column
 * @psalm-method Collection&\Traversable<ChildAttendance> findByJointEmp(int|array<int> $joint_emp) Return ChildAttendance objects filtered by the joint_emp column
 * @method     ChildAttendance[]|Collection findByRemark(string|array<string> $remark) Return ChildAttendance objects filtered by the remark column
 * @psalm-method Collection&\Traversable<ChildAttendance> findByRemark(string|array<string> $remark) Return ChildAttendance objects filtered by the remark column
 * @method     ChildAttendance[]|Collection findByStatus(int|array<int> $status) Return ChildAttendance objects filtered by the status column
 * @psalm-method Collection&\Traversable<ChildAttendance> findByStatus(int|array<int> $status) Return ChildAttendance objects filtered by the status column
 * @method     ChildAttendance[]|Collection findByOutletCount(int|array<int> $outlet_count) Return ChildAttendance objects filtered by the outlet_count column
 * @psalm-method Collection&\Traversable<ChildAttendance> findByOutletCount(int|array<int> $outlet_count) Return ChildAttendance objects filtered by the outlet_count column
 * @method     ChildAttendance[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildAttendance objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildAttendance> findByCreatedAt(string|array<string> $created_at) Return ChildAttendance objects filtered by the created_at column
 * @method     ChildAttendance[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildAttendance objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildAttendance> findByUpdatedAt(string|array<string> $updated_at) Return ChildAttendance objects filtered by the updated_at column
 * @method     ChildAttendance[]|Collection findByStartItownid(int|array<int> $start_itownid) Return ChildAttendance objects filtered by the start_itownid column
 * @psalm-method Collection&\Traversable<ChildAttendance> findByStartItownid(int|array<int> $start_itownid) Return ChildAttendance objects filtered by the start_itownid column
 * @method     ChildAttendance[]|Collection findByEndItownid(int|array<int> $end_itownid) Return ChildAttendance objects filtered by the end_itownid column
 * @psalm-method Collection&\Traversable<ChildAttendance> findByEndItownid(int|array<int> $end_itownid) Return ChildAttendance objects filtered by the end_itownid column
 * @method     ChildAttendance[]|Collection findByVisitedItownid(string|array<string> $visited_itownid) Return ChildAttendance objects filtered by the visited_itownid column
 * @psalm-method Collection&\Traversable<ChildAttendance> findByVisitedItownid(string|array<string> $visited_itownid) Return ChildAttendance objects filtered by the visited_itownid column
 * @method     ChildAttendance[]|Collection findByExpenseId(int|array<int> $expense_id) Return ChildAttendance objects filtered by the expense_id column
 * @psalm-method Collection&\Traversable<ChildAttendance> findByExpenseId(int|array<int> $expense_id) Return ChildAttendance objects filtered by the expense_id column
 * @method     ChildAttendance[]|Collection findByIsUpdated(boolean|array<boolean> $is_updated) Return ChildAttendance objects filtered by the is_updated column
 * @psalm-method Collection&\Traversable<ChildAttendance> findByIsUpdated(boolean|array<boolean> $is_updated) Return ChildAttendance objects filtered by the is_updated column
 * @method     ChildAttendance[]|Collection findByExpenseGenerated(boolean|array<boolean> $expense_generated) Return ChildAttendance objects filtered by the expense_generated column
 * @psalm-method Collection&\Traversable<ChildAttendance> findByExpenseGenerated(boolean|array<boolean> $expense_generated) Return ChildAttendance objects filtered by the expense_generated column
 * @method     ChildAttendance[]|Collection findByExpenseRemark(string|array<string> $expense_remark) Return ChildAttendance objects filtered by the expense_remark column
 * @psalm-method Collection&\Traversable<ChildAttendance> findByExpenseRemark(string|array<string> $expense_remark) Return ChildAttendance objects filtered by the expense_remark column
 *
 * @method     ChildAttendance[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildAttendance> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class AttendanceQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\AttendanceQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\Attendance', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildAttendanceQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildAttendanceQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildAttendanceQuery) {
            return $criteria;
        }
        $query = new ChildAttendanceQuery();
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
     * @return ChildAttendance|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(AttendanceTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = AttendanceTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildAttendance A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT attendance_id, employee_id, company_id, attendance_date, start_time, end_time, start_latlng, start_address, end_latlng, end_address, shift_mins, joint_emp, remark, status, outlet_count, created_at, updated_at, start_itownid, end_itownid, visited_itownid, expense_id, is_updated, expense_generated, expense_remark FROM attendance WHERE attendance_id = :p0';
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
            /** @var ChildAttendance $obj */
            $obj = new ChildAttendance();
            $obj->hydrate($row);
            AttendanceTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildAttendance|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(AttendanceTableMap::COL_ATTENDANCE_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(AttendanceTableMap::COL_ATTENDANCE_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the attendance_id column
     *
     * Example usage:
     * <code>
     * $query->filterByAttendanceId(1234); // WHERE attendance_id = 1234
     * $query->filterByAttendanceId(array(12, 34)); // WHERE attendance_id IN (12, 34)
     * $query->filterByAttendanceId(array('min' => 12)); // WHERE attendance_id > 12
     * </code>
     *
     * @param mixed $attendanceId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAttendanceId($attendanceId = null, ?string $comparison = null)
    {
        if (is_array($attendanceId)) {
            $useMinMax = false;
            if (isset($attendanceId['min'])) {
                $this->addUsingAlias(AttendanceTableMap::COL_ATTENDANCE_ID, $attendanceId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($attendanceId['max'])) {
                $this->addUsingAlias(AttendanceTableMap::COL_ATTENDANCE_ID, $attendanceId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AttendanceTableMap::COL_ATTENDANCE_ID, $attendanceId, $comparison);

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
                $this->addUsingAlias(AttendanceTableMap::COL_EMPLOYEE_ID, $employeeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($employeeId['max'])) {
                $this->addUsingAlias(AttendanceTableMap::COL_EMPLOYEE_ID, $employeeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AttendanceTableMap::COL_EMPLOYEE_ID, $employeeId, $comparison);

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
                $this->addUsingAlias(AttendanceTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(AttendanceTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AttendanceTableMap::COL_COMPANY_ID, $companyId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the attendance_date column
     *
     * Example usage:
     * <code>
     * $query->filterByAttendanceDate('2011-03-14'); // WHERE attendance_date = '2011-03-14'
     * $query->filterByAttendanceDate('now'); // WHERE attendance_date = '2011-03-14'
     * $query->filterByAttendanceDate(array('max' => 'yesterday')); // WHERE attendance_date > '2011-03-13'
     * </code>
     *
     * @param mixed $attendanceDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAttendanceDate($attendanceDate = null, ?string $comparison = null)
    {
        if (is_array($attendanceDate)) {
            $useMinMax = false;
            if (isset($attendanceDate['min'])) {
                $this->addUsingAlias(AttendanceTableMap::COL_ATTENDANCE_DATE, $attendanceDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($attendanceDate['max'])) {
                $this->addUsingAlias(AttendanceTableMap::COL_ATTENDANCE_DATE, $attendanceDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AttendanceTableMap::COL_ATTENDANCE_DATE, $attendanceDate, $comparison);

        return $this;
    }

    /**
     * Filter the query on the start_time column
     *
     * Example usage:
     * <code>
     * $query->filterByStartTime('2011-03-14'); // WHERE start_time = '2011-03-14'
     * $query->filterByStartTime('now'); // WHERE start_time = '2011-03-14'
     * $query->filterByStartTime(array('max' => 'yesterday')); // WHERE start_time > '2011-03-13'
     * </code>
     *
     * @param mixed $startTime The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStartTime($startTime = null, ?string $comparison = null)
    {
        if (is_array($startTime)) {
            $useMinMax = false;
            if (isset($startTime['min'])) {
                $this->addUsingAlias(AttendanceTableMap::COL_START_TIME, $startTime['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($startTime['max'])) {
                $this->addUsingAlias(AttendanceTableMap::COL_START_TIME, $startTime['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AttendanceTableMap::COL_START_TIME, $startTime, $comparison);

        return $this;
    }

    /**
     * Filter the query on the end_time column
     *
     * Example usage:
     * <code>
     * $query->filterByEndTime('2011-03-14'); // WHERE end_time = '2011-03-14'
     * $query->filterByEndTime('now'); // WHERE end_time = '2011-03-14'
     * $query->filterByEndTime(array('max' => 'yesterday')); // WHERE end_time > '2011-03-13'
     * </code>
     *
     * @param mixed $endTime The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEndTime($endTime = null, ?string $comparison = null)
    {
        if (is_array($endTime)) {
            $useMinMax = false;
            if (isset($endTime['min'])) {
                $this->addUsingAlias(AttendanceTableMap::COL_END_TIME, $endTime['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($endTime['max'])) {
                $this->addUsingAlias(AttendanceTableMap::COL_END_TIME, $endTime['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AttendanceTableMap::COL_END_TIME, $endTime, $comparison);

        return $this;
    }

    /**
     * Filter the query on the start_latlng column
     *
     * Example usage:
     * <code>
     * $query->filterByStartLatlng('fooValue');   // WHERE start_latlng = 'fooValue'
     * $query->filterByStartLatlng('%fooValue%', Criteria::LIKE); // WHERE start_latlng LIKE '%fooValue%'
     * $query->filterByStartLatlng(['foo', 'bar']); // WHERE start_latlng IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $startLatlng The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStartLatlng($startLatlng = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($startLatlng)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AttendanceTableMap::COL_START_LATLNG, $startLatlng, $comparison);

        return $this;
    }

    /**
     * Filter the query on the start_address column
     *
     * Example usage:
     * <code>
     * $query->filterByStartAddress('fooValue');   // WHERE start_address = 'fooValue'
     * $query->filterByStartAddress('%fooValue%', Criteria::LIKE); // WHERE start_address LIKE '%fooValue%'
     * $query->filterByStartAddress(['foo', 'bar']); // WHERE start_address IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $startAddress The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStartAddress($startAddress = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($startAddress)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AttendanceTableMap::COL_START_ADDRESS, $startAddress, $comparison);

        return $this;
    }

    /**
     * Filter the query on the end_latlng column
     *
     * Example usage:
     * <code>
     * $query->filterByEndLatlng('fooValue');   // WHERE end_latlng = 'fooValue'
     * $query->filterByEndLatlng('%fooValue%', Criteria::LIKE); // WHERE end_latlng LIKE '%fooValue%'
     * $query->filterByEndLatlng(['foo', 'bar']); // WHERE end_latlng IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $endLatlng The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEndLatlng($endLatlng = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($endLatlng)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AttendanceTableMap::COL_END_LATLNG, $endLatlng, $comparison);

        return $this;
    }

    /**
     * Filter the query on the end_address column
     *
     * Example usage:
     * <code>
     * $query->filterByEndAddress('fooValue');   // WHERE end_address = 'fooValue'
     * $query->filterByEndAddress('%fooValue%', Criteria::LIKE); // WHERE end_address LIKE '%fooValue%'
     * $query->filterByEndAddress(['foo', 'bar']); // WHERE end_address IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $endAddress The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEndAddress($endAddress = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($endAddress)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AttendanceTableMap::COL_END_ADDRESS, $endAddress, $comparison);

        return $this;
    }

    /**
     * Filter the query on the shift_mins column
     *
     * Example usage:
     * <code>
     * $query->filterByShiftMins(1234); // WHERE shift_mins = 1234
     * $query->filterByShiftMins(array(12, 34)); // WHERE shift_mins IN (12, 34)
     * $query->filterByShiftMins(array('min' => 12)); // WHERE shift_mins > 12
     * </code>
     *
     * @param mixed $shiftMins The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByShiftMins($shiftMins = null, ?string $comparison = null)
    {
        if (is_array($shiftMins)) {
            $useMinMax = false;
            if (isset($shiftMins['min'])) {
                $this->addUsingAlias(AttendanceTableMap::COL_SHIFT_MINS, $shiftMins['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($shiftMins['max'])) {
                $this->addUsingAlias(AttendanceTableMap::COL_SHIFT_MINS, $shiftMins['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AttendanceTableMap::COL_SHIFT_MINS, $shiftMins, $comparison);

        return $this;
    }

    /**
     * Filter the query on the joint_emp column
     *
     * Example usage:
     * <code>
     * $query->filterByJointEmp(1234); // WHERE joint_emp = 1234
     * $query->filterByJointEmp(array(12, 34)); // WHERE joint_emp IN (12, 34)
     * $query->filterByJointEmp(array('min' => 12)); // WHERE joint_emp > 12
     * </code>
     *
     * @param mixed $jointEmp The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByJointEmp($jointEmp = null, ?string $comparison = null)
    {
        if (is_array($jointEmp)) {
            $useMinMax = false;
            if (isset($jointEmp['min'])) {
                $this->addUsingAlias(AttendanceTableMap::COL_JOINT_EMP, $jointEmp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($jointEmp['max'])) {
                $this->addUsingAlias(AttendanceTableMap::COL_JOINT_EMP, $jointEmp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AttendanceTableMap::COL_JOINT_EMP, $jointEmp, $comparison);

        return $this;
    }

    /**
     * Filter the query on the remark column
     *
     * Example usage:
     * <code>
     * $query->filterByRemark('fooValue');   // WHERE remark = 'fooValue'
     * $query->filterByRemark('%fooValue%', Criteria::LIKE); // WHERE remark LIKE '%fooValue%'
     * $query->filterByRemark(['foo', 'bar']); // WHERE remark IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $remark The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRemark($remark = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($remark)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AttendanceTableMap::COL_REMARK, $remark, $comparison);

        return $this;
    }

    /**
     * Filter the query on the status column
     *
     * Example usage:
     * <code>
     * $query->filterByStatus(1234); // WHERE status = 1234
     * $query->filterByStatus(array(12, 34)); // WHERE status IN (12, 34)
     * $query->filterByStatus(array('min' => 12)); // WHERE status > 12
     * </code>
     *
     * @param mixed $status The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStatus($status = null, ?string $comparison = null)
    {
        if (is_array($status)) {
            $useMinMax = false;
            if (isset($status['min'])) {
                $this->addUsingAlias(AttendanceTableMap::COL_STATUS, $status['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($status['max'])) {
                $this->addUsingAlias(AttendanceTableMap::COL_STATUS, $status['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AttendanceTableMap::COL_STATUS, $status, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_count column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletCount(1234); // WHERE outlet_count = 1234
     * $query->filterByOutletCount(array(12, 34)); // WHERE outlet_count IN (12, 34)
     * $query->filterByOutletCount(array('min' => 12)); // WHERE outlet_count > 12
     * </code>
     *
     * @param mixed $outletCount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletCount($outletCount = null, ?string $comparison = null)
    {
        if (is_array($outletCount)) {
            $useMinMax = false;
            if (isset($outletCount['min'])) {
                $this->addUsingAlias(AttendanceTableMap::COL_OUTLET_COUNT, $outletCount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outletCount['max'])) {
                $this->addUsingAlias(AttendanceTableMap::COL_OUTLET_COUNT, $outletCount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AttendanceTableMap::COL_OUTLET_COUNT, $outletCount, $comparison);

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
                $this->addUsingAlias(AttendanceTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(AttendanceTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AttendanceTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(AttendanceTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(AttendanceTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AttendanceTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the start_itownid column
     *
     * Example usage:
     * <code>
     * $query->filterByStartItownid(1234); // WHERE start_itownid = 1234
     * $query->filterByStartItownid(array(12, 34)); // WHERE start_itownid IN (12, 34)
     * $query->filterByStartItownid(array('min' => 12)); // WHERE start_itownid > 12
     * </code>
     *
     * @see       filterByGeoTownsRelatedByStartItownid()
     *
     * @param mixed $startItownid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStartItownid($startItownid = null, ?string $comparison = null)
    {
        if (is_array($startItownid)) {
            $useMinMax = false;
            if (isset($startItownid['min'])) {
                $this->addUsingAlias(AttendanceTableMap::COL_START_ITOWNID, $startItownid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($startItownid['max'])) {
                $this->addUsingAlias(AttendanceTableMap::COL_START_ITOWNID, $startItownid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AttendanceTableMap::COL_START_ITOWNID, $startItownid, $comparison);

        return $this;
    }

    /**
     * Filter the query on the end_itownid column
     *
     * Example usage:
     * <code>
     * $query->filterByEndItownid(1234); // WHERE end_itownid = 1234
     * $query->filterByEndItownid(array(12, 34)); // WHERE end_itownid IN (12, 34)
     * $query->filterByEndItownid(array('min' => 12)); // WHERE end_itownid > 12
     * </code>
     *
     * @see       filterByGeoTownsRelatedByEndItownid()
     *
     * @param mixed $endItownid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEndItownid($endItownid = null, ?string $comparison = null)
    {
        if (is_array($endItownid)) {
            $useMinMax = false;
            if (isset($endItownid['min'])) {
                $this->addUsingAlias(AttendanceTableMap::COL_END_ITOWNID, $endItownid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($endItownid['max'])) {
                $this->addUsingAlias(AttendanceTableMap::COL_END_ITOWNID, $endItownid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AttendanceTableMap::COL_END_ITOWNID, $endItownid, $comparison);

        return $this;
    }

    /**
     * Filter the query on the visited_itownid column
     *
     * Example usage:
     * <code>
     * $query->filterByVisitedItownid('fooValue');   // WHERE visited_itownid = 'fooValue'
     * $query->filterByVisitedItownid('%fooValue%', Criteria::LIKE); // WHERE visited_itownid LIKE '%fooValue%'
     * $query->filterByVisitedItownid(['foo', 'bar']); // WHERE visited_itownid IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $visitedItownid The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByVisitedItownid($visitedItownid = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($visitedItownid)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AttendanceTableMap::COL_VISITED_ITOWNID, $visitedItownid, $comparison);

        return $this;
    }

    /**
     * Filter the query on the expense_id column
     *
     * Example usage:
     * <code>
     * $query->filterByExpenseId(1234); // WHERE expense_id = 1234
     * $query->filterByExpenseId(array(12, 34)); // WHERE expense_id IN (12, 34)
     * $query->filterByExpenseId(array('min' => 12)); // WHERE expense_id > 12
     * </code>
     *
     * @see       filterByExpenses()
     *
     * @param mixed $expenseId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpenseId($expenseId = null, ?string $comparison = null)
    {
        if (is_array($expenseId)) {
            $useMinMax = false;
            if (isset($expenseId['min'])) {
                $this->addUsingAlias(AttendanceTableMap::COL_EXPENSE_ID, $expenseId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($expenseId['max'])) {
                $this->addUsingAlias(AttendanceTableMap::COL_EXPENSE_ID, $expenseId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AttendanceTableMap::COL_EXPENSE_ID, $expenseId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the is_updated column
     *
     * Example usage:
     * <code>
     * $query->filterByIsUpdated(true); // WHERE is_updated = true
     * $query->filterByIsUpdated('yes'); // WHERE is_updated = true
     * </code>
     *
     * @param bool|string $isUpdated The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIsUpdated($isUpdated = null, ?string $comparison = null)
    {
        if (is_string($isUpdated)) {
            $isUpdated = in_array(strtolower($isUpdated), array('false', 'off', '-', 'no', 'n', '0', ''), true) ? false : true;
        }

        $this->addUsingAlias(AttendanceTableMap::COL_IS_UPDATED, $isUpdated, $comparison);

        return $this;
    }

    /**
     * Filter the query on the expense_generated column
     *
     * Example usage:
     * <code>
     * $query->filterByExpenseGenerated(true); // WHERE expense_generated = true
     * $query->filterByExpenseGenerated('yes'); // WHERE expense_generated = true
     * </code>
     *
     * @param bool|string $expenseGenerated The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpenseGenerated($expenseGenerated = null, ?string $comparison = null)
    {
        if (is_string($expenseGenerated)) {
            $expenseGenerated = in_array(strtolower($expenseGenerated), array('false', 'off', '-', 'no', 'n', '0', ''), true) ? false : true;
        }

        $this->addUsingAlias(AttendanceTableMap::COL_EXPENSE_GENERATED, $expenseGenerated, $comparison);

        return $this;
    }

    /**
     * Filter the query on the expense_remark column
     *
     * Example usage:
     * <code>
     * $query->filterByExpenseRemark('fooValue');   // WHERE expense_remark = 'fooValue'
     * $query->filterByExpenseRemark('%fooValue%', Criteria::LIKE); // WHERE expense_remark LIKE '%fooValue%'
     * $query->filterByExpenseRemark(['foo', 'bar']); // WHERE expense_remark IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $expenseRemark The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpenseRemark($expenseRemark = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($expenseRemark)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AttendanceTableMap::COL_EXPENSE_REMARK, $expenseRemark, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \entities\GeoTowns object
     *
     * @param \entities\GeoTowns|ObjectCollection $geoTowns The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByGeoTownsRelatedByEndItownid($geoTowns, ?string $comparison = null)
    {
        if ($geoTowns instanceof \entities\GeoTowns) {
            return $this
                ->addUsingAlias(AttendanceTableMap::COL_END_ITOWNID, $geoTowns->getItownid(), $comparison);
        } elseif ($geoTowns instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(AttendanceTableMap::COL_END_ITOWNID, $geoTowns->toKeyValue('PrimaryKey', 'Itownid'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByGeoTownsRelatedByEndItownid() only accepts arguments of type \entities\GeoTowns or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the GeoTownsRelatedByEndItownid relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinGeoTownsRelatedByEndItownid(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('GeoTownsRelatedByEndItownid');

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
            $this->addJoinObject($join, 'GeoTownsRelatedByEndItownid');
        }

        return $this;
    }

    /**
     * Use the GeoTownsRelatedByEndItownid relation GeoTowns object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\GeoTownsQuery A secondary query class using the current class as primary query
     */
    public function useGeoTownsRelatedByEndItownidQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinGeoTownsRelatedByEndItownid($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'GeoTownsRelatedByEndItownid', '\entities\GeoTownsQuery');
    }

    /**
     * Use the GeoTownsRelatedByEndItownid relation GeoTowns object
     *
     * @param callable(\entities\GeoTownsQuery):\entities\GeoTownsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withGeoTownsRelatedByEndItownidQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useGeoTownsRelatedByEndItownidQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the GeoTownsRelatedByEndItownid relation to the GeoTowns table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\GeoTownsQuery The inner query object of the EXISTS statement
     */
    public function useGeoTownsRelatedByEndItownidExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\GeoTownsQuery */
        $q = $this->useExistsQuery('GeoTownsRelatedByEndItownid', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the GeoTownsRelatedByEndItownid relation to the GeoTowns table for a NOT EXISTS query.
     *
     * @see useGeoTownsRelatedByEndItownidExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\GeoTownsQuery The inner query object of the NOT EXISTS statement
     */
    public function useGeoTownsRelatedByEndItownidNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\GeoTownsQuery */
        $q = $this->useExistsQuery('GeoTownsRelatedByEndItownid', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the GeoTownsRelatedByEndItownid relation to the GeoTowns table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\GeoTownsQuery The inner query object of the IN statement
     */
    public function useInGeoTownsRelatedByEndItownidQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\GeoTownsQuery */
        $q = $this->useInQuery('GeoTownsRelatedByEndItownid', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the GeoTownsRelatedByEndItownid relation to the GeoTowns table for a NOT IN query.
     *
     * @see useGeoTownsRelatedByEndItownidInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\GeoTownsQuery The inner query object of the NOT IN statement
     */
    public function useNotInGeoTownsRelatedByEndItownidQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\GeoTownsQuery */
        $q = $this->useInQuery('GeoTownsRelatedByEndItownid', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\Expenses object
     *
     * @param \entities\Expenses|ObjectCollection $expenses The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpenses($expenses, ?string $comparison = null)
    {
        if ($expenses instanceof \entities\Expenses) {
            return $this
                ->addUsingAlias(AttendanceTableMap::COL_EXPENSE_ID, $expenses->getExpId(), $comparison);
        } elseif ($expenses instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(AttendanceTableMap::COL_EXPENSE_ID, $expenses->toKeyValue('PrimaryKey', 'ExpId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByExpenses() only accepts arguments of type \entities\Expenses or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Expenses relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinExpenses(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Expenses');

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
            $this->addJoinObject($join, 'Expenses');
        }

        return $this;
    }

    /**
     * Use the Expenses relation Expenses object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\ExpensesQuery A secondary query class using the current class as primary query
     */
    public function useExpensesQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinExpenses($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Expenses', '\entities\ExpensesQuery');
    }

    /**
     * Use the Expenses relation Expenses object
     *
     * @param callable(\entities\ExpensesQuery):\entities\ExpensesQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withExpensesQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useExpensesQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Expenses table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\ExpensesQuery The inner query object of the EXISTS statement
     */
    public function useExpensesExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\ExpensesQuery */
        $q = $this->useExistsQuery('Expenses', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Expenses table for a NOT EXISTS query.
     *
     * @see useExpensesExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\ExpensesQuery The inner query object of the NOT EXISTS statement
     */
    public function useExpensesNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\ExpensesQuery */
        $q = $this->useExistsQuery('Expenses', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Expenses table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\ExpensesQuery The inner query object of the IN statement
     */
    public function useInExpensesQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\ExpensesQuery */
        $q = $this->useInQuery('Expenses', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Expenses table for a NOT IN query.
     *
     * @see useExpensesInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\ExpensesQuery The inner query object of the NOT IN statement
     */
    public function useNotInExpensesQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\ExpensesQuery */
        $q = $this->useInQuery('Expenses', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\GeoTowns object
     *
     * @param \entities\GeoTowns|ObjectCollection $geoTowns The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByGeoTownsRelatedByStartItownid($geoTowns, ?string $comparison = null)
    {
        if ($geoTowns instanceof \entities\GeoTowns) {
            return $this
                ->addUsingAlias(AttendanceTableMap::COL_START_ITOWNID, $geoTowns->getItownid(), $comparison);
        } elseif ($geoTowns instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(AttendanceTableMap::COL_START_ITOWNID, $geoTowns->toKeyValue('PrimaryKey', 'Itownid'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByGeoTownsRelatedByStartItownid() only accepts arguments of type \entities\GeoTowns or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the GeoTownsRelatedByStartItownid relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinGeoTownsRelatedByStartItownid(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('GeoTownsRelatedByStartItownid');

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
            $this->addJoinObject($join, 'GeoTownsRelatedByStartItownid');
        }

        return $this;
    }

    /**
     * Use the GeoTownsRelatedByStartItownid relation GeoTowns object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\GeoTownsQuery A secondary query class using the current class as primary query
     */
    public function useGeoTownsRelatedByStartItownidQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinGeoTownsRelatedByStartItownid($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'GeoTownsRelatedByStartItownid', '\entities\GeoTownsQuery');
    }

    /**
     * Use the GeoTownsRelatedByStartItownid relation GeoTowns object
     *
     * @param callable(\entities\GeoTownsQuery):\entities\GeoTownsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withGeoTownsRelatedByStartItownidQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useGeoTownsRelatedByStartItownidQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the GeoTownsRelatedByStartItownid relation to the GeoTowns table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\GeoTownsQuery The inner query object of the EXISTS statement
     */
    public function useGeoTownsRelatedByStartItownidExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\GeoTownsQuery */
        $q = $this->useExistsQuery('GeoTownsRelatedByStartItownid', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the GeoTownsRelatedByStartItownid relation to the GeoTowns table for a NOT EXISTS query.
     *
     * @see useGeoTownsRelatedByStartItownidExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\GeoTownsQuery The inner query object of the NOT EXISTS statement
     */
    public function useGeoTownsRelatedByStartItownidNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\GeoTownsQuery */
        $q = $this->useExistsQuery('GeoTownsRelatedByStartItownid', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the GeoTownsRelatedByStartItownid relation to the GeoTowns table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\GeoTownsQuery The inner query object of the IN statement
     */
    public function useInGeoTownsRelatedByStartItownidQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\GeoTownsQuery */
        $q = $this->useInQuery('GeoTownsRelatedByStartItownid', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the GeoTownsRelatedByStartItownid relation to the GeoTowns table for a NOT IN query.
     *
     * @see useGeoTownsRelatedByStartItownidInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\GeoTownsQuery The inner query object of the NOT IN statement
     */
    public function useNotInGeoTownsRelatedByStartItownidQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\GeoTownsQuery */
        $q = $this->useInQuery('GeoTownsRelatedByStartItownid', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(AttendanceTableMap::COL_COMPANY_ID, $company->getCompanyId(), $comparison);
        } elseif ($company instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(AttendanceTableMap::COL_COMPANY_ID, $company->toKeyValue('PrimaryKey', 'CompanyId'), $comparison);

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
                ->addUsingAlias(AttendanceTableMap::COL_EMPLOYEE_ID, $employee->getEmployeeId(), $comparison);
        } elseif ($employee instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(AttendanceTableMap::COL_EMPLOYEE_ID, $employee->toKeyValue('PrimaryKey', 'EmployeeId'), $comparison);

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
     * Exclude object from result
     *
     * @param ChildAttendance $attendance Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($attendance = null)
    {
        if ($attendance) {
            $this->addUsingAlias(AttendanceTableMap::COL_ATTENDANCE_ID, $attendance->getAttendanceId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the attendance table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(AttendanceTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            AttendanceTableMap::clearInstancePool();
            AttendanceTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(AttendanceTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(AttendanceTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            AttendanceTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            AttendanceTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
