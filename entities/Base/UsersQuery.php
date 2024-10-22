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
use entities\Users as ChildUsers;
use entities\UsersQuery as ChildUsersQuery;
use entities\Map\UsersTableMap;

/**
 * Base class that represents a query for the `users` table.
 *
 * @method     ChildUsersQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 * @method     ChildUsersQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildUsersQuery orderByUsername($order = Criteria::ASC) Order by the username column
 * @method     ChildUsersQuery orderByEmail($order = Criteria::ASC) Order by the email column
 * @method     ChildUsersQuery orderByIsdCode($order = Criteria::ASC) Order by the isd_code column
 * @method     ChildUsersQuery orderByPhone($order = Criteria::ASC) Order by the phone column
 * @method     ChildUsersQuery orderByOtp($order = Criteria::ASC) Order by the otp column
 * @method     ChildUsersQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildUsersQuery orderByPassword($order = Criteria::ASC) Order by the password column
 * @method     ChildUsersQuery orderByRoleId($order = Criteria::ASC) Order by the role_id column
 * @method     ChildUsersQuery orderByEmployeeId($order = Criteria::ASC) Order by the employee_id column
 * @method     ChildUsersQuery orderByLastLogin($order = Criteria::ASC) Order by the last_login column
 * @method     ChildUsersQuery orderByIpAddress($order = Criteria::ASC) Order by the ip_address column
 * @method     ChildUsersQuery orderByIpLocation($order = Criteria::ASC) Order by the ip_location column
 * @method     ChildUsersQuery orderBySessionToken($order = Criteria::ASC) Order by the session_token column
 * @method     ChildUsersQuery orderByAppToken($order = Criteria::ASC) Order by the app_token column
 * @method     ChildUsersQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method     ChildUsersQuery orderByDefaultUser($order = Criteria::ASC) Order by the default_user column
 * @method     ChildUsersQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildUsersQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildUsersQuery groupByUserId() Group by the user_id column
 * @method     ChildUsersQuery groupByName() Group by the name column
 * @method     ChildUsersQuery groupByUsername() Group by the username column
 * @method     ChildUsersQuery groupByEmail() Group by the email column
 * @method     ChildUsersQuery groupByIsdCode() Group by the isd_code column
 * @method     ChildUsersQuery groupByPhone() Group by the phone column
 * @method     ChildUsersQuery groupByOtp() Group by the otp column
 * @method     ChildUsersQuery groupByCompanyId() Group by the company_id column
 * @method     ChildUsersQuery groupByPassword() Group by the password column
 * @method     ChildUsersQuery groupByRoleId() Group by the role_id column
 * @method     ChildUsersQuery groupByEmployeeId() Group by the employee_id column
 * @method     ChildUsersQuery groupByLastLogin() Group by the last_login column
 * @method     ChildUsersQuery groupByIpAddress() Group by the ip_address column
 * @method     ChildUsersQuery groupByIpLocation() Group by the ip_location column
 * @method     ChildUsersQuery groupBySessionToken() Group by the session_token column
 * @method     ChildUsersQuery groupByAppToken() Group by the app_token column
 * @method     ChildUsersQuery groupByStatus() Group by the status column
 * @method     ChildUsersQuery groupByDefaultUser() Group by the default_user column
 * @method     ChildUsersQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildUsersQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildUsersQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildUsersQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildUsersQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildUsersQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildUsersQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildUsersQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildUsersQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildUsersQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildUsersQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildUsersQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildUsersQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildUsersQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildUsersQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     ChildUsersQuery leftJoinEmployee($relationAlias = null) Adds a LEFT JOIN clause to the query using the Employee relation
 * @method     ChildUsersQuery rightJoinEmployee($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Employee relation
 * @method     ChildUsersQuery innerJoinEmployee($relationAlias = null) Adds a INNER JOIN clause to the query using the Employee relation
 *
 * @method     ChildUsersQuery joinWithEmployee($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Employee relation
 *
 * @method     ChildUsersQuery leftJoinWithEmployee() Adds a LEFT JOIN clause and with to the query using the Employee relation
 * @method     ChildUsersQuery rightJoinWithEmployee() Adds a RIGHT JOIN clause and with to the query using the Employee relation
 * @method     ChildUsersQuery innerJoinWithEmployee() Adds a INNER JOIN clause and with to the query using the Employee relation
 *
 * @method     ChildUsersQuery leftJoinRoles($relationAlias = null) Adds a LEFT JOIN clause to the query using the Roles relation
 * @method     ChildUsersQuery rightJoinRoles($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Roles relation
 * @method     ChildUsersQuery innerJoinRoles($relationAlias = null) Adds a INNER JOIN clause to the query using the Roles relation
 *
 * @method     ChildUsersQuery joinWithRoles($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Roles relation
 *
 * @method     ChildUsersQuery leftJoinWithRoles() Adds a LEFT JOIN clause and with to the query using the Roles relation
 * @method     ChildUsersQuery rightJoinWithRoles() Adds a RIGHT JOIN clause and with to the query using the Roles relation
 * @method     ChildUsersQuery innerJoinWithRoles() Adds a INNER JOIN clause and with to the query using the Roles relation
 *
 * @method     ChildUsersQuery leftJoinAuditTableData($relationAlias = null) Adds a LEFT JOIN clause to the query using the AuditTableData relation
 * @method     ChildUsersQuery rightJoinAuditTableData($relationAlias = null) Adds a RIGHT JOIN clause to the query using the AuditTableData relation
 * @method     ChildUsersQuery innerJoinAuditTableData($relationAlias = null) Adds a INNER JOIN clause to the query using the AuditTableData relation
 *
 * @method     ChildUsersQuery joinWithAuditTableData($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the AuditTableData relation
 *
 * @method     ChildUsersQuery leftJoinWithAuditTableData() Adds a LEFT JOIN clause and with to the query using the AuditTableData relation
 * @method     ChildUsersQuery rightJoinWithAuditTableData() Adds a RIGHT JOIN clause and with to the query using the AuditTableData relation
 * @method     ChildUsersQuery innerJoinWithAuditTableData() Adds a INNER JOIN clause and with to the query using the AuditTableData relation
 *
 * @method     ChildUsersQuery leftJoinEmployeeLog($relationAlias = null) Adds a LEFT JOIN clause to the query using the EmployeeLog relation
 * @method     ChildUsersQuery rightJoinEmployeeLog($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EmployeeLog relation
 * @method     ChildUsersQuery innerJoinEmployeeLog($relationAlias = null) Adds a INNER JOIN clause to the query using the EmployeeLog relation
 *
 * @method     ChildUsersQuery joinWithEmployeeLog($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the EmployeeLog relation
 *
 * @method     ChildUsersQuery leftJoinWithEmployeeLog() Adds a LEFT JOIN clause and with to the query using the EmployeeLog relation
 * @method     ChildUsersQuery rightJoinWithEmployeeLog() Adds a RIGHT JOIN clause and with to the query using the EmployeeLog relation
 * @method     ChildUsersQuery innerJoinWithEmployeeLog() Adds a INNER JOIN clause and with to the query using the EmployeeLog relation
 *
 * @method     ChildUsersQuery leftJoinOrderLog($relationAlias = null) Adds a LEFT JOIN clause to the query using the OrderLog relation
 * @method     ChildUsersQuery rightJoinOrderLog($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OrderLog relation
 * @method     ChildUsersQuery innerJoinOrderLog($relationAlias = null) Adds a INNER JOIN clause to the query using the OrderLog relation
 *
 * @method     ChildUsersQuery joinWithOrderLog($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OrderLog relation
 *
 * @method     ChildUsersQuery leftJoinWithOrderLog() Adds a LEFT JOIN clause and with to the query using the OrderLog relation
 * @method     ChildUsersQuery rightJoinWithOrderLog() Adds a RIGHT JOIN clause and with to the query using the OrderLog relation
 * @method     ChildUsersQuery innerJoinWithOrderLog() Adds a INNER JOIN clause and with to the query using the OrderLog relation
 *
 * @method     ChildUsersQuery leftJoinShippingorder($relationAlias = null) Adds a LEFT JOIN clause to the query using the Shippingorder relation
 * @method     ChildUsersQuery rightJoinShippingorder($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Shippingorder relation
 * @method     ChildUsersQuery innerJoinShippingorder($relationAlias = null) Adds a INNER JOIN clause to the query using the Shippingorder relation
 *
 * @method     ChildUsersQuery joinWithShippingorder($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Shippingorder relation
 *
 * @method     ChildUsersQuery leftJoinWithShippingorder() Adds a LEFT JOIN clause and with to the query using the Shippingorder relation
 * @method     ChildUsersQuery rightJoinWithShippingorder() Adds a RIGHT JOIN clause and with to the query using the Shippingorder relation
 * @method     ChildUsersQuery innerJoinWithShippingorder() Adds a INNER JOIN clause and with to the query using the Shippingorder relation
 *
 * @method     ChildUsersQuery leftJoinStockTransaction($relationAlias = null) Adds a LEFT JOIN clause to the query using the StockTransaction relation
 * @method     ChildUsersQuery rightJoinStockTransaction($relationAlias = null) Adds a RIGHT JOIN clause to the query using the StockTransaction relation
 * @method     ChildUsersQuery innerJoinStockTransaction($relationAlias = null) Adds a INNER JOIN clause to the query using the StockTransaction relation
 *
 * @method     ChildUsersQuery joinWithStockTransaction($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the StockTransaction relation
 *
 * @method     ChildUsersQuery leftJoinWithStockTransaction() Adds a LEFT JOIN clause and with to the query using the StockTransaction relation
 * @method     ChildUsersQuery rightJoinWithStockTransaction() Adds a RIGHT JOIN clause and with to the query using the StockTransaction relation
 * @method     ChildUsersQuery innerJoinWithStockTransaction() Adds a INNER JOIN clause and with to the query using the StockTransaction relation
 *
 * @method     ChildUsersQuery leftJoinStockVoucher($relationAlias = null) Adds a LEFT JOIN clause to the query using the StockVoucher relation
 * @method     ChildUsersQuery rightJoinStockVoucher($relationAlias = null) Adds a RIGHT JOIN clause to the query using the StockVoucher relation
 * @method     ChildUsersQuery innerJoinStockVoucher($relationAlias = null) Adds a INNER JOIN clause to the query using the StockVoucher relation
 *
 * @method     ChildUsersQuery joinWithStockVoucher($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the StockVoucher relation
 *
 * @method     ChildUsersQuery leftJoinWithStockVoucher() Adds a LEFT JOIN clause and with to the query using the StockVoucher relation
 * @method     ChildUsersQuery rightJoinWithStockVoucher() Adds a RIGHT JOIN clause and with to the query using the StockVoucher relation
 * @method     ChildUsersQuery innerJoinWithStockVoucher() Adds a INNER JOIN clause and with to the query using the StockVoucher relation
 *
 * @method     ChildUsersQuery leftJoinUserSessions($relationAlias = null) Adds a LEFT JOIN clause to the query using the UserSessions relation
 * @method     ChildUsersQuery rightJoinUserSessions($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UserSessions relation
 * @method     ChildUsersQuery innerJoinUserSessions($relationAlias = null) Adds a INNER JOIN clause to the query using the UserSessions relation
 *
 * @method     ChildUsersQuery joinWithUserSessions($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the UserSessions relation
 *
 * @method     ChildUsersQuery leftJoinWithUserSessions() Adds a LEFT JOIN clause and with to the query using the UserSessions relation
 * @method     ChildUsersQuery rightJoinWithUserSessions() Adds a RIGHT JOIN clause and with to the query using the UserSessions relation
 * @method     ChildUsersQuery innerJoinWithUserSessions() Adds a INNER JOIN clause and with to the query using the UserSessions relation
 *
 * @method     ChildUsersQuery leftJoinUserTriggers($relationAlias = null) Adds a LEFT JOIN clause to the query using the UserTriggers relation
 * @method     ChildUsersQuery rightJoinUserTriggers($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UserTriggers relation
 * @method     ChildUsersQuery innerJoinUserTriggers($relationAlias = null) Adds a INNER JOIN clause to the query using the UserTriggers relation
 *
 * @method     ChildUsersQuery joinWithUserTriggers($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the UserTriggers relation
 *
 * @method     ChildUsersQuery leftJoinWithUserTriggers() Adds a LEFT JOIN clause and with to the query using the UserTriggers relation
 * @method     ChildUsersQuery rightJoinWithUserTriggers() Adds a RIGHT JOIN clause and with to the query using the UserTriggers relation
 * @method     ChildUsersQuery innerJoinWithUserTriggers() Adds a INNER JOIN clause and with to the query using the UserTriggers relation
 *
 * @method     ChildUsersQuery leftJoinWdbSyncLog($relationAlias = null) Adds a LEFT JOIN clause to the query using the WdbSyncLog relation
 * @method     ChildUsersQuery rightJoinWdbSyncLog($relationAlias = null) Adds a RIGHT JOIN clause to the query using the WdbSyncLog relation
 * @method     ChildUsersQuery innerJoinWdbSyncLog($relationAlias = null) Adds a INNER JOIN clause to the query using the WdbSyncLog relation
 *
 * @method     ChildUsersQuery joinWithWdbSyncLog($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the WdbSyncLog relation
 *
 * @method     ChildUsersQuery leftJoinWithWdbSyncLog() Adds a LEFT JOIN clause and with to the query using the WdbSyncLog relation
 * @method     ChildUsersQuery rightJoinWithWdbSyncLog() Adds a RIGHT JOIN clause and with to the query using the WdbSyncLog relation
 * @method     ChildUsersQuery innerJoinWithWdbSyncLog() Adds a INNER JOIN clause and with to the query using the WdbSyncLog relation
 *
 * @method     \entities\CompanyQuery|\entities\EmployeeQuery|\entities\RolesQuery|\entities\AuditTableDataQuery|\entities\EmployeeLogQuery|\entities\OrderLogQuery|\entities\ShippingorderQuery|\entities\StockTransactionQuery|\entities\StockVoucherQuery|\entities\UserSessionsQuery|\entities\UserTriggersQuery|\entities\WdbSyncLogQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildUsers|null findOne(?ConnectionInterface $con = null) Return the first ChildUsers matching the query
 * @method     ChildUsers findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildUsers matching the query, or a new ChildUsers object populated from the query conditions when no match is found
 *
 * @method     ChildUsers|null findOneByUserId(int $user_id) Return the first ChildUsers filtered by the user_id column
 * @method     ChildUsers|null findOneByName(string $name) Return the first ChildUsers filtered by the name column
 * @method     ChildUsers|null findOneByUsername(string $username) Return the first ChildUsers filtered by the username column
 * @method     ChildUsers|null findOneByEmail(string $email) Return the first ChildUsers filtered by the email column
 * @method     ChildUsers|null findOneByIsdCode(string $isd_code) Return the first ChildUsers filtered by the isd_code column
 * @method     ChildUsers|null findOneByPhone(string $phone) Return the first ChildUsers filtered by the phone column
 * @method     ChildUsers|null findOneByOtp(int $otp) Return the first ChildUsers filtered by the otp column
 * @method     ChildUsers|null findOneByCompanyId(int $company_id) Return the first ChildUsers filtered by the company_id column
 * @method     ChildUsers|null findOneByPassword(string $password) Return the first ChildUsers filtered by the password column
 * @method     ChildUsers|null findOneByRoleId(int $role_id) Return the first ChildUsers filtered by the role_id column
 * @method     ChildUsers|null findOneByEmployeeId(int $employee_id) Return the first ChildUsers filtered by the employee_id column
 * @method     ChildUsers|null findOneByLastLogin(int $last_login) Return the first ChildUsers filtered by the last_login column
 * @method     ChildUsers|null findOneByIpAddress(string $ip_address) Return the first ChildUsers filtered by the ip_address column
 * @method     ChildUsers|null findOneByIpLocation(string $ip_location) Return the first ChildUsers filtered by the ip_location column
 * @method     ChildUsers|null findOneBySessionToken(string $session_token) Return the first ChildUsers filtered by the session_token column
 * @method     ChildUsers|null findOneByAppToken(string $app_token) Return the first ChildUsers filtered by the app_token column
 * @method     ChildUsers|null findOneByStatus(int $status) Return the first ChildUsers filtered by the status column
 * @method     ChildUsers|null findOneByDefaultUser(int $default_user) Return the first ChildUsers filtered by the default_user column
 * @method     ChildUsers|null findOneByCreatedAt(string $created_at) Return the first ChildUsers filtered by the created_at column
 * @method     ChildUsers|null findOneByUpdatedAt(string $updated_at) Return the first ChildUsers filtered by the updated_at column
 *
 * @method     ChildUsers requirePk($key, ?ConnectionInterface $con = null) Return the ChildUsers by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOne(?ConnectionInterface $con = null) Return the first ChildUsers matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUsers requireOneByUserId(int $user_id) Return the first ChildUsers filtered by the user_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByName(string $name) Return the first ChildUsers filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByUsername(string $username) Return the first ChildUsers filtered by the username column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByEmail(string $email) Return the first ChildUsers filtered by the email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByIsdCode(string $isd_code) Return the first ChildUsers filtered by the isd_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByPhone(string $phone) Return the first ChildUsers filtered by the phone column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByOtp(int $otp) Return the first ChildUsers filtered by the otp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByCompanyId(int $company_id) Return the first ChildUsers filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByPassword(string $password) Return the first ChildUsers filtered by the password column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByRoleId(int $role_id) Return the first ChildUsers filtered by the role_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByEmployeeId(int $employee_id) Return the first ChildUsers filtered by the employee_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByLastLogin(int $last_login) Return the first ChildUsers filtered by the last_login column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByIpAddress(string $ip_address) Return the first ChildUsers filtered by the ip_address column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByIpLocation(string $ip_location) Return the first ChildUsers filtered by the ip_location column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneBySessionToken(string $session_token) Return the first ChildUsers filtered by the session_token column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByAppToken(string $app_token) Return the first ChildUsers filtered by the app_token column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByStatus(int $status) Return the first ChildUsers filtered by the status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByDefaultUser(int $default_user) Return the first ChildUsers filtered by the default_user column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByCreatedAt(string $created_at) Return the first ChildUsers filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByUpdatedAt(string $updated_at) Return the first ChildUsers filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUsers[]|Collection find(?ConnectionInterface $con = null) Return ChildUsers objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildUsers> find(?ConnectionInterface $con = null) Return ChildUsers objects based on current ModelCriteria
 *
 * @method     ChildUsers[]|Collection findByUserId(int|array<int> $user_id) Return ChildUsers objects filtered by the user_id column
 * @psalm-method Collection&\Traversable<ChildUsers> findByUserId(int|array<int> $user_id) Return ChildUsers objects filtered by the user_id column
 * @method     ChildUsers[]|Collection findByName(string|array<string> $name) Return ChildUsers objects filtered by the name column
 * @psalm-method Collection&\Traversable<ChildUsers> findByName(string|array<string> $name) Return ChildUsers objects filtered by the name column
 * @method     ChildUsers[]|Collection findByUsername(string|array<string> $username) Return ChildUsers objects filtered by the username column
 * @psalm-method Collection&\Traversable<ChildUsers> findByUsername(string|array<string> $username) Return ChildUsers objects filtered by the username column
 * @method     ChildUsers[]|Collection findByEmail(string|array<string> $email) Return ChildUsers objects filtered by the email column
 * @psalm-method Collection&\Traversable<ChildUsers> findByEmail(string|array<string> $email) Return ChildUsers objects filtered by the email column
 * @method     ChildUsers[]|Collection findByIsdCode(string|array<string> $isd_code) Return ChildUsers objects filtered by the isd_code column
 * @psalm-method Collection&\Traversable<ChildUsers> findByIsdCode(string|array<string> $isd_code) Return ChildUsers objects filtered by the isd_code column
 * @method     ChildUsers[]|Collection findByPhone(string|array<string> $phone) Return ChildUsers objects filtered by the phone column
 * @psalm-method Collection&\Traversable<ChildUsers> findByPhone(string|array<string> $phone) Return ChildUsers objects filtered by the phone column
 * @method     ChildUsers[]|Collection findByOtp(int|array<int> $otp) Return ChildUsers objects filtered by the otp column
 * @psalm-method Collection&\Traversable<ChildUsers> findByOtp(int|array<int> $otp) Return ChildUsers objects filtered by the otp column
 * @method     ChildUsers[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildUsers objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildUsers> findByCompanyId(int|array<int> $company_id) Return ChildUsers objects filtered by the company_id column
 * @method     ChildUsers[]|Collection findByPassword(string|array<string> $password) Return ChildUsers objects filtered by the password column
 * @psalm-method Collection&\Traversable<ChildUsers> findByPassword(string|array<string> $password) Return ChildUsers objects filtered by the password column
 * @method     ChildUsers[]|Collection findByRoleId(int|array<int> $role_id) Return ChildUsers objects filtered by the role_id column
 * @psalm-method Collection&\Traversable<ChildUsers> findByRoleId(int|array<int> $role_id) Return ChildUsers objects filtered by the role_id column
 * @method     ChildUsers[]|Collection findByEmployeeId(int|array<int> $employee_id) Return ChildUsers objects filtered by the employee_id column
 * @psalm-method Collection&\Traversable<ChildUsers> findByEmployeeId(int|array<int> $employee_id) Return ChildUsers objects filtered by the employee_id column
 * @method     ChildUsers[]|Collection findByLastLogin(int|array<int> $last_login) Return ChildUsers objects filtered by the last_login column
 * @psalm-method Collection&\Traversable<ChildUsers> findByLastLogin(int|array<int> $last_login) Return ChildUsers objects filtered by the last_login column
 * @method     ChildUsers[]|Collection findByIpAddress(string|array<string> $ip_address) Return ChildUsers objects filtered by the ip_address column
 * @psalm-method Collection&\Traversable<ChildUsers> findByIpAddress(string|array<string> $ip_address) Return ChildUsers objects filtered by the ip_address column
 * @method     ChildUsers[]|Collection findByIpLocation(string|array<string> $ip_location) Return ChildUsers objects filtered by the ip_location column
 * @psalm-method Collection&\Traversable<ChildUsers> findByIpLocation(string|array<string> $ip_location) Return ChildUsers objects filtered by the ip_location column
 * @method     ChildUsers[]|Collection findBySessionToken(string|array<string> $session_token) Return ChildUsers objects filtered by the session_token column
 * @psalm-method Collection&\Traversable<ChildUsers> findBySessionToken(string|array<string> $session_token) Return ChildUsers objects filtered by the session_token column
 * @method     ChildUsers[]|Collection findByAppToken(string|array<string> $app_token) Return ChildUsers objects filtered by the app_token column
 * @psalm-method Collection&\Traversable<ChildUsers> findByAppToken(string|array<string> $app_token) Return ChildUsers objects filtered by the app_token column
 * @method     ChildUsers[]|Collection findByStatus(int|array<int> $status) Return ChildUsers objects filtered by the status column
 * @psalm-method Collection&\Traversable<ChildUsers> findByStatus(int|array<int> $status) Return ChildUsers objects filtered by the status column
 * @method     ChildUsers[]|Collection findByDefaultUser(int|array<int> $default_user) Return ChildUsers objects filtered by the default_user column
 * @psalm-method Collection&\Traversable<ChildUsers> findByDefaultUser(int|array<int> $default_user) Return ChildUsers objects filtered by the default_user column
 * @method     ChildUsers[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildUsers objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildUsers> findByCreatedAt(string|array<string> $created_at) Return ChildUsers objects filtered by the created_at column
 * @method     ChildUsers[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildUsers objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildUsers> findByUpdatedAt(string|array<string> $updated_at) Return ChildUsers objects filtered by the updated_at column
 *
 * @method     ChildUsers[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildUsers> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class UsersQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\UsersQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\Users', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildUsersQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildUsersQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildUsersQuery) {
            return $criteria;
        }
        $query = new ChildUsersQuery();
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
     * @return ChildUsers|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(UsersTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = UsersTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildUsers A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT user_id, name, username, email, isd_code, phone, otp, company_id, password, role_id, employee_id, last_login, ip_address, ip_location, session_token, app_token, status, default_user, created_at, updated_at FROM users WHERE user_id = :p0';
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
            /** @var ChildUsers $obj */
            $obj = new ChildUsers();
            $obj->hydrate($row);
            UsersTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildUsers|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(UsersTableMap::COL_USER_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(UsersTableMap::COL_USER_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the user_id column
     *
     * Example usage:
     * <code>
     * $query->filterByUserId(1234); // WHERE user_id = 1234
     * $query->filterByUserId(array(12, 34)); // WHERE user_id IN (12, 34)
     * $query->filterByUserId(array('min' => 12)); // WHERE user_id > 12
     * </code>
     *
     * @param mixed $userId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUserId($userId = null, ?string $comparison = null)
    {
        if (is_array($userId)) {
            $useMinMax = false;
            if (isset($userId['min'])) {
                $this->addUsingAlias(UsersTableMap::COL_USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userId['max'])) {
                $this->addUsingAlias(UsersTableMap::COL_USER_ID, $userId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersTableMap::COL_USER_ID, $userId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%', Criteria::LIKE); // WHERE name LIKE '%fooValue%'
     * $query->filterByName(['foo', 'bar']); // WHERE name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $name The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByName($name = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersTableMap::COL_NAME, $name, $comparison);

        return $this;
    }

    /**
     * Filter the query on the username column
     *
     * Example usage:
     * <code>
     * $query->filterByUsername('fooValue');   // WHERE username = 'fooValue'
     * $query->filterByUsername('%fooValue%', Criteria::LIKE); // WHERE username LIKE '%fooValue%'
     * $query->filterByUsername(['foo', 'bar']); // WHERE username IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $username The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUsername($username = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($username)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersTableMap::COL_USERNAME, $username, $comparison);

        return $this;
    }

    /**
     * Filter the query on the email column
     *
     * Example usage:
     * <code>
     * $query->filterByEmail('fooValue');   // WHERE email = 'fooValue'
     * $query->filterByEmail('%fooValue%', Criteria::LIKE); // WHERE email LIKE '%fooValue%'
     * $query->filterByEmail(['foo', 'bar']); // WHERE email IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $email The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmail($email = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($email)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersTableMap::COL_EMAIL, $email, $comparison);

        return $this;
    }

    /**
     * Filter the query on the isd_code column
     *
     * Example usage:
     * <code>
     * $query->filterByIsdCode('fooValue');   // WHERE isd_code = 'fooValue'
     * $query->filterByIsdCode('%fooValue%', Criteria::LIKE); // WHERE isd_code LIKE '%fooValue%'
     * $query->filterByIsdCode(['foo', 'bar']); // WHERE isd_code IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $isdCode The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIsdCode($isdCode = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($isdCode)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersTableMap::COL_ISD_CODE, $isdCode, $comparison);

        return $this;
    }

    /**
     * Filter the query on the phone column
     *
     * Example usage:
     * <code>
     * $query->filterByPhone('fooValue');   // WHERE phone = 'fooValue'
     * $query->filterByPhone('%fooValue%', Criteria::LIKE); // WHERE phone LIKE '%fooValue%'
     * $query->filterByPhone(['foo', 'bar']); // WHERE phone IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $phone The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPhone($phone = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($phone)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersTableMap::COL_PHONE, $phone, $comparison);

        return $this;
    }

    /**
     * Filter the query on the otp column
     *
     * Example usage:
     * <code>
     * $query->filterByOtp(1234); // WHERE otp = 1234
     * $query->filterByOtp(array(12, 34)); // WHERE otp IN (12, 34)
     * $query->filterByOtp(array('min' => 12)); // WHERE otp > 12
     * </code>
     *
     * @param mixed $otp The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOtp($otp = null, ?string $comparison = null)
    {
        if (is_array($otp)) {
            $useMinMax = false;
            if (isset($otp['min'])) {
                $this->addUsingAlias(UsersTableMap::COL_OTP, $otp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($otp['max'])) {
                $this->addUsingAlias(UsersTableMap::COL_OTP, $otp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersTableMap::COL_OTP, $otp, $comparison);

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
                $this->addUsingAlias(UsersTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(UsersTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersTableMap::COL_COMPANY_ID, $companyId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the password column
     *
     * Example usage:
     * <code>
     * $query->filterByPassword('fooValue');   // WHERE password = 'fooValue'
     * $query->filterByPassword('%fooValue%', Criteria::LIKE); // WHERE password LIKE '%fooValue%'
     * $query->filterByPassword(['foo', 'bar']); // WHERE password IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $password The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPassword($password = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($password)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersTableMap::COL_PASSWORD, $password, $comparison);

        return $this;
    }

    /**
     * Filter the query on the role_id column
     *
     * Example usage:
     * <code>
     * $query->filterByRoleId(1234); // WHERE role_id = 1234
     * $query->filterByRoleId(array(12, 34)); // WHERE role_id IN (12, 34)
     * $query->filterByRoleId(array('min' => 12)); // WHERE role_id > 12
     * </code>
     *
     * @see       filterByRoles()
     *
     * @param mixed $roleId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRoleId($roleId = null, ?string $comparison = null)
    {
        if (is_array($roleId)) {
            $useMinMax = false;
            if (isset($roleId['min'])) {
                $this->addUsingAlias(UsersTableMap::COL_ROLE_ID, $roleId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($roleId['max'])) {
                $this->addUsingAlias(UsersTableMap::COL_ROLE_ID, $roleId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersTableMap::COL_ROLE_ID, $roleId, $comparison);

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
                $this->addUsingAlias(UsersTableMap::COL_EMPLOYEE_ID, $employeeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($employeeId['max'])) {
                $this->addUsingAlias(UsersTableMap::COL_EMPLOYEE_ID, $employeeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersTableMap::COL_EMPLOYEE_ID, $employeeId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the last_login column
     *
     * Example usage:
     * <code>
     * $query->filterByLastLogin(1234); // WHERE last_login = 1234
     * $query->filterByLastLogin(array(12, 34)); // WHERE last_login IN (12, 34)
     * $query->filterByLastLogin(array('min' => 12)); // WHERE last_login > 12
     * </code>
     *
     * @param mixed $lastLogin The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLastLogin($lastLogin = null, ?string $comparison = null)
    {
        if (is_array($lastLogin)) {
            $useMinMax = false;
            if (isset($lastLogin['min'])) {
                $this->addUsingAlias(UsersTableMap::COL_LAST_LOGIN, $lastLogin['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastLogin['max'])) {
                $this->addUsingAlias(UsersTableMap::COL_LAST_LOGIN, $lastLogin['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersTableMap::COL_LAST_LOGIN, $lastLogin, $comparison);

        return $this;
    }

    /**
     * Filter the query on the ip_address column
     *
     * Example usage:
     * <code>
     * $query->filterByIpAddress('fooValue');   // WHERE ip_address = 'fooValue'
     * $query->filterByIpAddress('%fooValue%', Criteria::LIKE); // WHERE ip_address LIKE '%fooValue%'
     * $query->filterByIpAddress(['foo', 'bar']); // WHERE ip_address IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $ipAddress The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIpAddress($ipAddress = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($ipAddress)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersTableMap::COL_IP_ADDRESS, $ipAddress, $comparison);

        return $this;
    }

    /**
     * Filter the query on the ip_location column
     *
     * Example usage:
     * <code>
     * $query->filterByIpLocation('fooValue');   // WHERE ip_location = 'fooValue'
     * $query->filterByIpLocation('%fooValue%', Criteria::LIKE); // WHERE ip_location LIKE '%fooValue%'
     * $query->filterByIpLocation(['foo', 'bar']); // WHERE ip_location IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $ipLocation The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIpLocation($ipLocation = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($ipLocation)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersTableMap::COL_IP_LOCATION, $ipLocation, $comparison);

        return $this;
    }

    /**
     * Filter the query on the session_token column
     *
     * Example usage:
     * <code>
     * $query->filterBySessionToken('fooValue');   // WHERE session_token = 'fooValue'
     * $query->filterBySessionToken('%fooValue%', Criteria::LIKE); // WHERE session_token LIKE '%fooValue%'
     * $query->filterBySessionToken(['foo', 'bar']); // WHERE session_token IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $sessionToken The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySessionToken($sessionToken = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($sessionToken)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersTableMap::COL_SESSION_TOKEN, $sessionToken, $comparison);

        return $this;
    }

    /**
     * Filter the query on the app_token column
     *
     * Example usage:
     * <code>
     * $query->filterByAppToken('fooValue');   // WHERE app_token = 'fooValue'
     * $query->filterByAppToken('%fooValue%', Criteria::LIKE); // WHERE app_token LIKE '%fooValue%'
     * $query->filterByAppToken(['foo', 'bar']); // WHERE app_token IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $appToken The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAppToken($appToken = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($appToken)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersTableMap::COL_APP_TOKEN, $appToken, $comparison);

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
                $this->addUsingAlias(UsersTableMap::COL_STATUS, $status['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($status['max'])) {
                $this->addUsingAlias(UsersTableMap::COL_STATUS, $status['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersTableMap::COL_STATUS, $status, $comparison);

        return $this;
    }

    /**
     * Filter the query on the default_user column
     *
     * Example usage:
     * <code>
     * $query->filterByDefaultUser(1234); // WHERE default_user = 1234
     * $query->filterByDefaultUser(array(12, 34)); // WHERE default_user IN (12, 34)
     * $query->filterByDefaultUser(array('min' => 12)); // WHERE default_user > 12
     * </code>
     *
     * @param mixed $defaultUser The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDefaultUser($defaultUser = null, ?string $comparison = null)
    {
        if (is_array($defaultUser)) {
            $useMinMax = false;
            if (isset($defaultUser['min'])) {
                $this->addUsingAlias(UsersTableMap::COL_DEFAULT_USER, $defaultUser['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($defaultUser['max'])) {
                $this->addUsingAlias(UsersTableMap::COL_DEFAULT_USER, $defaultUser['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersTableMap::COL_DEFAULT_USER, $defaultUser, $comparison);

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
                $this->addUsingAlias(UsersTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(UsersTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(UsersTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(UsersTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
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
                ->addUsingAlias(UsersTableMap::COL_COMPANY_ID, $company->getCompanyId(), $comparison);
        } elseif ($company instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(UsersTableMap::COL_COMPANY_ID, $company->toKeyValue('PrimaryKey', 'CompanyId'), $comparison);

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
    public function joinCompany(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
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
    public function useCompanyQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
        ?string $joinType = Criteria::LEFT_JOIN
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
                ->addUsingAlias(UsersTableMap::COL_EMPLOYEE_ID, $employee->getEmployeeId(), $comparison);
        } elseif ($employee instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(UsersTableMap::COL_EMPLOYEE_ID, $employee->toKeyValue('PrimaryKey', 'EmployeeId'), $comparison);

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
    public function joinEmployee(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
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
    public function useEmployeeQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
        ?string $joinType = Criteria::LEFT_JOIN
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
     * Filter the query by a related \entities\Roles object
     *
     * @param \entities\Roles|ObjectCollection $roles The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRoles($roles, ?string $comparison = null)
    {
        if ($roles instanceof \entities\Roles) {
            return $this
                ->addUsingAlias(UsersTableMap::COL_ROLE_ID, $roles->getRoleId(), $comparison);
        } elseif ($roles instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(UsersTableMap::COL_ROLE_ID, $roles->toKeyValue('PrimaryKey', 'RoleId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByRoles() only accepts arguments of type \entities\Roles or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Roles relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinRoles(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Roles');

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
            $this->addJoinObject($join, 'Roles');
        }

        return $this;
    }

    /**
     * Use the Roles relation Roles object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\RolesQuery A secondary query class using the current class as primary query
     */
    public function useRolesQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinRoles($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Roles', '\entities\RolesQuery');
    }

    /**
     * Use the Roles relation Roles object
     *
     * @param callable(\entities\RolesQuery):\entities\RolesQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withRolesQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useRolesQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Roles table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\RolesQuery The inner query object of the EXISTS statement
     */
    public function useRolesExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\RolesQuery */
        $q = $this->useExistsQuery('Roles', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Roles table for a NOT EXISTS query.
     *
     * @see useRolesExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\RolesQuery The inner query object of the NOT EXISTS statement
     */
    public function useRolesNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\RolesQuery */
        $q = $this->useExistsQuery('Roles', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Roles table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\RolesQuery The inner query object of the IN statement
     */
    public function useInRolesQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\RolesQuery */
        $q = $this->useInQuery('Roles', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Roles table for a NOT IN query.
     *
     * @see useRolesInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\RolesQuery The inner query object of the NOT IN statement
     */
    public function useNotInRolesQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\RolesQuery */
        $q = $this->useInQuery('Roles', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\AuditTableData object
     *
     * @param \entities\AuditTableData|ObjectCollection $auditTableData the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAuditTableData($auditTableData, ?string $comparison = null)
    {
        if ($auditTableData instanceof \entities\AuditTableData) {
            $this
                ->addUsingAlias(UsersTableMap::COL_USER_ID, $auditTableData->getUserId(), $comparison);

            return $this;
        } elseif ($auditTableData instanceof ObjectCollection) {
            $this
                ->useAuditTableDataQuery()
                ->filterByPrimaryKeys($auditTableData->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByAuditTableData() only accepts arguments of type \entities\AuditTableData or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the AuditTableData relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinAuditTableData(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('AuditTableData');

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
            $this->addJoinObject($join, 'AuditTableData');
        }

        return $this;
    }

    /**
     * Use the AuditTableData relation AuditTableData object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\AuditTableDataQuery A secondary query class using the current class as primary query
     */
    public function useAuditTableDataQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinAuditTableData($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'AuditTableData', '\entities\AuditTableDataQuery');
    }

    /**
     * Use the AuditTableData relation AuditTableData object
     *
     * @param callable(\entities\AuditTableDataQuery):\entities\AuditTableDataQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withAuditTableDataQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useAuditTableDataQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to AuditTableData table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\AuditTableDataQuery The inner query object of the EXISTS statement
     */
    public function useAuditTableDataExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\AuditTableDataQuery */
        $q = $this->useExistsQuery('AuditTableData', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to AuditTableData table for a NOT EXISTS query.
     *
     * @see useAuditTableDataExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\AuditTableDataQuery The inner query object of the NOT EXISTS statement
     */
    public function useAuditTableDataNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\AuditTableDataQuery */
        $q = $this->useExistsQuery('AuditTableData', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to AuditTableData table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\AuditTableDataQuery The inner query object of the IN statement
     */
    public function useInAuditTableDataQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\AuditTableDataQuery */
        $q = $this->useInQuery('AuditTableData', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to AuditTableData table for a NOT IN query.
     *
     * @see useAuditTableDataInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\AuditTableDataQuery The inner query object of the NOT IN statement
     */
    public function useNotInAuditTableDataQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\AuditTableDataQuery */
        $q = $this->useInQuery('AuditTableData', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\EmployeeLog object
     *
     * @param \entities\EmployeeLog|ObjectCollection $employeeLog the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmployeeLog($employeeLog, ?string $comparison = null)
    {
        if ($employeeLog instanceof \entities\EmployeeLog) {
            $this
                ->addUsingAlias(UsersTableMap::COL_USER_ID, $employeeLog->getUserId(), $comparison);

            return $this;
        } elseif ($employeeLog instanceof ObjectCollection) {
            $this
                ->useEmployeeLogQuery()
                ->filterByPrimaryKeys($employeeLog->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByEmployeeLog() only accepts arguments of type \entities\EmployeeLog or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the EmployeeLog relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinEmployeeLog(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('EmployeeLog');

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
            $this->addJoinObject($join, 'EmployeeLog');
        }

        return $this;
    }

    /**
     * Use the EmployeeLog relation EmployeeLog object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\EmployeeLogQuery A secondary query class using the current class as primary query
     */
    public function useEmployeeLogQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinEmployeeLog($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'EmployeeLog', '\entities\EmployeeLogQuery');
    }

    /**
     * Use the EmployeeLog relation EmployeeLog object
     *
     * @param callable(\entities\EmployeeLogQuery):\entities\EmployeeLogQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withEmployeeLogQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useEmployeeLogQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to EmployeeLog table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\EmployeeLogQuery The inner query object of the EXISTS statement
     */
    public function useEmployeeLogExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\EmployeeLogQuery */
        $q = $this->useExistsQuery('EmployeeLog', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to EmployeeLog table for a NOT EXISTS query.
     *
     * @see useEmployeeLogExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\EmployeeLogQuery The inner query object of the NOT EXISTS statement
     */
    public function useEmployeeLogNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\EmployeeLogQuery */
        $q = $this->useExistsQuery('EmployeeLog', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to EmployeeLog table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\EmployeeLogQuery The inner query object of the IN statement
     */
    public function useInEmployeeLogQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\EmployeeLogQuery */
        $q = $this->useInQuery('EmployeeLog', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to EmployeeLog table for a NOT IN query.
     *
     * @see useEmployeeLogInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\EmployeeLogQuery The inner query object of the NOT IN statement
     */
    public function useNotInEmployeeLogQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\EmployeeLogQuery */
        $q = $this->useInQuery('EmployeeLog', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\OrderLog object
     *
     * @param \entities\OrderLog|ObjectCollection $orderLog the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrderLog($orderLog, ?string $comparison = null)
    {
        if ($orderLog instanceof \entities\OrderLog) {
            $this
                ->addUsingAlias(UsersTableMap::COL_USER_ID, $orderLog->getUserId(), $comparison);

            return $this;
        } elseif ($orderLog instanceof ObjectCollection) {
            $this
                ->useOrderLogQuery()
                ->filterByPrimaryKeys($orderLog->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByOrderLog() only accepts arguments of type \entities\OrderLog or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OrderLog relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOrderLog(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OrderLog');

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
            $this->addJoinObject($join, 'OrderLog');
        }

        return $this;
    }

    /**
     * Use the OrderLog relation OrderLog object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\OrderLogQuery A secondary query class using the current class as primary query
     */
    public function useOrderLogQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinOrderLog($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OrderLog', '\entities\OrderLogQuery');
    }

    /**
     * Use the OrderLog relation OrderLog object
     *
     * @param callable(\entities\OrderLogQuery):\entities\OrderLogQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOrderLogQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useOrderLogQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to OrderLog table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\OrderLogQuery The inner query object of the EXISTS statement
     */
    public function useOrderLogExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\OrderLogQuery */
        $q = $this->useExistsQuery('OrderLog', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to OrderLog table for a NOT EXISTS query.
     *
     * @see useOrderLogExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\OrderLogQuery The inner query object of the NOT EXISTS statement
     */
    public function useOrderLogNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OrderLogQuery */
        $q = $this->useExistsQuery('OrderLog', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to OrderLog table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\OrderLogQuery The inner query object of the IN statement
     */
    public function useInOrderLogQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\OrderLogQuery */
        $q = $this->useInQuery('OrderLog', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to OrderLog table for a NOT IN query.
     *
     * @see useOrderLogInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\OrderLogQuery The inner query object of the NOT IN statement
     */
    public function useNotInOrderLogQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OrderLogQuery */
        $q = $this->useInQuery('OrderLog', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\Shippingorder object
     *
     * @param \entities\Shippingorder|ObjectCollection $shippingorder the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByShippingorder($shippingorder, ?string $comparison = null)
    {
        if ($shippingorder instanceof \entities\Shippingorder) {
            $this
                ->addUsingAlias(UsersTableMap::COL_USER_ID, $shippingorder->getUserId(), $comparison);

            return $this;
        } elseif ($shippingorder instanceof ObjectCollection) {
            $this
                ->useShippingorderQuery()
                ->filterByPrimaryKeys($shippingorder->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByShippingorder() only accepts arguments of type \entities\Shippingorder or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Shippingorder relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinShippingorder(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Shippingorder');

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
            $this->addJoinObject($join, 'Shippingorder');
        }

        return $this;
    }

    /**
     * Use the Shippingorder relation Shippingorder object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\ShippingorderQuery A secondary query class using the current class as primary query
     */
    public function useShippingorderQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinShippingorder($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Shippingorder', '\entities\ShippingorderQuery');
    }

    /**
     * Use the Shippingorder relation Shippingorder object
     *
     * @param callable(\entities\ShippingorderQuery):\entities\ShippingorderQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withShippingorderQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useShippingorderQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Shippingorder table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\ShippingorderQuery The inner query object of the EXISTS statement
     */
    public function useShippingorderExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\ShippingorderQuery */
        $q = $this->useExistsQuery('Shippingorder', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Shippingorder table for a NOT EXISTS query.
     *
     * @see useShippingorderExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\ShippingorderQuery The inner query object of the NOT EXISTS statement
     */
    public function useShippingorderNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\ShippingorderQuery */
        $q = $this->useExistsQuery('Shippingorder', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Shippingorder table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\ShippingorderQuery The inner query object of the IN statement
     */
    public function useInShippingorderQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\ShippingorderQuery */
        $q = $this->useInQuery('Shippingorder', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Shippingorder table for a NOT IN query.
     *
     * @see useShippingorderInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\ShippingorderQuery The inner query object of the NOT IN statement
     */
    public function useNotInShippingorderQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\ShippingorderQuery */
        $q = $this->useInQuery('Shippingorder', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\StockTransaction object
     *
     * @param \entities\StockTransaction|ObjectCollection $stockTransaction the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStockTransaction($stockTransaction, ?string $comparison = null)
    {
        if ($stockTransaction instanceof \entities\StockTransaction) {
            $this
                ->addUsingAlias(UsersTableMap::COL_USER_ID, $stockTransaction->getCreatedUser(), $comparison);

            return $this;
        } elseif ($stockTransaction instanceof ObjectCollection) {
            $this
                ->useStockTransactionQuery()
                ->filterByPrimaryKeys($stockTransaction->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByStockTransaction() only accepts arguments of type \entities\StockTransaction or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the StockTransaction relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinStockTransaction(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('StockTransaction');

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
            $this->addJoinObject($join, 'StockTransaction');
        }

        return $this;
    }

    /**
     * Use the StockTransaction relation StockTransaction object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\StockTransactionQuery A secondary query class using the current class as primary query
     */
    public function useStockTransactionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinStockTransaction($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'StockTransaction', '\entities\StockTransactionQuery');
    }

    /**
     * Use the StockTransaction relation StockTransaction object
     *
     * @param callable(\entities\StockTransactionQuery):\entities\StockTransactionQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withStockTransactionQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useStockTransactionQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to StockTransaction table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\StockTransactionQuery The inner query object of the EXISTS statement
     */
    public function useStockTransactionExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\StockTransactionQuery */
        $q = $this->useExistsQuery('StockTransaction', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to StockTransaction table for a NOT EXISTS query.
     *
     * @see useStockTransactionExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\StockTransactionQuery The inner query object of the NOT EXISTS statement
     */
    public function useStockTransactionNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\StockTransactionQuery */
        $q = $this->useExistsQuery('StockTransaction', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to StockTransaction table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\StockTransactionQuery The inner query object of the IN statement
     */
    public function useInStockTransactionQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\StockTransactionQuery */
        $q = $this->useInQuery('StockTransaction', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to StockTransaction table for a NOT IN query.
     *
     * @see useStockTransactionInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\StockTransactionQuery The inner query object of the NOT IN statement
     */
    public function useNotInStockTransactionQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\StockTransactionQuery */
        $q = $this->useInQuery('StockTransaction', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\StockVoucher object
     *
     * @param \entities\StockVoucher|ObjectCollection $stockVoucher the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStockVoucher($stockVoucher, ?string $comparison = null)
    {
        if ($stockVoucher instanceof \entities\StockVoucher) {
            $this
                ->addUsingAlias(UsersTableMap::COL_USER_ID, $stockVoucher->getSvUserId(), $comparison);

            return $this;
        } elseif ($stockVoucher instanceof ObjectCollection) {
            $this
                ->useStockVoucherQuery()
                ->filterByPrimaryKeys($stockVoucher->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByStockVoucher() only accepts arguments of type \entities\StockVoucher or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the StockVoucher relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinStockVoucher(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('StockVoucher');

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
            $this->addJoinObject($join, 'StockVoucher');
        }

        return $this;
    }

    /**
     * Use the StockVoucher relation StockVoucher object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\StockVoucherQuery A secondary query class using the current class as primary query
     */
    public function useStockVoucherQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinStockVoucher($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'StockVoucher', '\entities\StockVoucherQuery');
    }

    /**
     * Use the StockVoucher relation StockVoucher object
     *
     * @param callable(\entities\StockVoucherQuery):\entities\StockVoucherQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withStockVoucherQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useStockVoucherQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to StockVoucher table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\StockVoucherQuery The inner query object of the EXISTS statement
     */
    public function useStockVoucherExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\StockVoucherQuery */
        $q = $this->useExistsQuery('StockVoucher', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to StockVoucher table for a NOT EXISTS query.
     *
     * @see useStockVoucherExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\StockVoucherQuery The inner query object of the NOT EXISTS statement
     */
    public function useStockVoucherNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\StockVoucherQuery */
        $q = $this->useExistsQuery('StockVoucher', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to StockVoucher table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\StockVoucherQuery The inner query object of the IN statement
     */
    public function useInStockVoucherQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\StockVoucherQuery */
        $q = $this->useInQuery('StockVoucher', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to StockVoucher table for a NOT IN query.
     *
     * @see useStockVoucherInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\StockVoucherQuery The inner query object of the NOT IN statement
     */
    public function useNotInStockVoucherQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\StockVoucherQuery */
        $q = $this->useInQuery('StockVoucher', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\UserSessions object
     *
     * @param \entities\UserSessions|ObjectCollection $userSessions the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUserSessions($userSessions, ?string $comparison = null)
    {
        if ($userSessions instanceof \entities\UserSessions) {
            $this
                ->addUsingAlias(UsersTableMap::COL_USER_ID, $userSessions->getUserId(), $comparison);

            return $this;
        } elseif ($userSessions instanceof ObjectCollection) {
            $this
                ->useUserSessionsQuery()
                ->filterByPrimaryKeys($userSessions->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByUserSessions() only accepts arguments of type \entities\UserSessions or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the UserSessions relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinUserSessions(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('UserSessions');

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
            $this->addJoinObject($join, 'UserSessions');
        }

        return $this;
    }

    /**
     * Use the UserSessions relation UserSessions object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\UserSessionsQuery A secondary query class using the current class as primary query
     */
    public function useUserSessionsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinUserSessions($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'UserSessions', '\entities\UserSessionsQuery');
    }

    /**
     * Use the UserSessions relation UserSessions object
     *
     * @param callable(\entities\UserSessionsQuery):\entities\UserSessionsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withUserSessionsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useUserSessionsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to UserSessions table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\UserSessionsQuery The inner query object of the EXISTS statement
     */
    public function useUserSessionsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\UserSessionsQuery */
        $q = $this->useExistsQuery('UserSessions', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to UserSessions table for a NOT EXISTS query.
     *
     * @see useUserSessionsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\UserSessionsQuery The inner query object of the NOT EXISTS statement
     */
    public function useUserSessionsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\UserSessionsQuery */
        $q = $this->useExistsQuery('UserSessions', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to UserSessions table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\UserSessionsQuery The inner query object of the IN statement
     */
    public function useInUserSessionsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\UserSessionsQuery */
        $q = $this->useInQuery('UserSessions', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to UserSessions table for a NOT IN query.
     *
     * @see useUserSessionsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\UserSessionsQuery The inner query object of the NOT IN statement
     */
    public function useNotInUserSessionsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\UserSessionsQuery */
        $q = $this->useInQuery('UserSessions', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\UserTriggers object
     *
     * @param \entities\UserTriggers|ObjectCollection $userTriggers the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUserTriggers($userTriggers, ?string $comparison = null)
    {
        if ($userTriggers instanceof \entities\UserTriggers) {
            $this
                ->addUsingAlias(UsersTableMap::COL_USER_ID, $userTriggers->getUserId(), $comparison);

            return $this;
        } elseif ($userTriggers instanceof ObjectCollection) {
            $this
                ->useUserTriggersQuery()
                ->filterByPrimaryKeys($userTriggers->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByUserTriggers() only accepts arguments of type \entities\UserTriggers or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the UserTriggers relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinUserTriggers(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('UserTriggers');

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
            $this->addJoinObject($join, 'UserTriggers');
        }

        return $this;
    }

    /**
     * Use the UserTriggers relation UserTriggers object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\UserTriggersQuery A secondary query class using the current class as primary query
     */
    public function useUserTriggersQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUserTriggers($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'UserTriggers', '\entities\UserTriggersQuery');
    }

    /**
     * Use the UserTriggers relation UserTriggers object
     *
     * @param callable(\entities\UserTriggersQuery):\entities\UserTriggersQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withUserTriggersQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useUserTriggersQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to UserTriggers table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\UserTriggersQuery The inner query object of the EXISTS statement
     */
    public function useUserTriggersExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\UserTriggersQuery */
        $q = $this->useExistsQuery('UserTriggers', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to UserTriggers table for a NOT EXISTS query.
     *
     * @see useUserTriggersExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\UserTriggersQuery The inner query object of the NOT EXISTS statement
     */
    public function useUserTriggersNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\UserTriggersQuery */
        $q = $this->useExistsQuery('UserTriggers', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to UserTriggers table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\UserTriggersQuery The inner query object of the IN statement
     */
    public function useInUserTriggersQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\UserTriggersQuery */
        $q = $this->useInQuery('UserTriggers', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to UserTriggers table for a NOT IN query.
     *
     * @see useUserTriggersInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\UserTriggersQuery The inner query object of the NOT IN statement
     */
    public function useNotInUserTriggersQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\UserTriggersQuery */
        $q = $this->useInQuery('UserTriggers', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\WdbSyncLog object
     *
     * @param \entities\WdbSyncLog|ObjectCollection $wdbSyncLog the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWdbSyncLog($wdbSyncLog, ?string $comparison = null)
    {
        if ($wdbSyncLog instanceof \entities\WdbSyncLog) {
            $this
                ->addUsingAlias(UsersTableMap::COL_USER_ID, $wdbSyncLog->getUserId(), $comparison);

            return $this;
        } elseif ($wdbSyncLog instanceof ObjectCollection) {
            $this
                ->useWdbSyncLogQuery()
                ->filterByPrimaryKeys($wdbSyncLog->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByWdbSyncLog() only accepts arguments of type \entities\WdbSyncLog or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the WdbSyncLog relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinWdbSyncLog(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('WdbSyncLog');

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
            $this->addJoinObject($join, 'WdbSyncLog');
        }

        return $this;
    }

    /**
     * Use the WdbSyncLog relation WdbSyncLog object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\WdbSyncLogQuery A secondary query class using the current class as primary query
     */
    public function useWdbSyncLogQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinWdbSyncLog($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'WdbSyncLog', '\entities\WdbSyncLogQuery');
    }

    /**
     * Use the WdbSyncLog relation WdbSyncLog object
     *
     * @param callable(\entities\WdbSyncLogQuery):\entities\WdbSyncLogQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withWdbSyncLogQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useWdbSyncLogQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to WdbSyncLog table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\WdbSyncLogQuery The inner query object of the EXISTS statement
     */
    public function useWdbSyncLogExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\WdbSyncLogQuery */
        $q = $this->useExistsQuery('WdbSyncLog', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to WdbSyncLog table for a NOT EXISTS query.
     *
     * @see useWdbSyncLogExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\WdbSyncLogQuery The inner query object of the NOT EXISTS statement
     */
    public function useWdbSyncLogNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\WdbSyncLogQuery */
        $q = $this->useExistsQuery('WdbSyncLog', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to WdbSyncLog table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\WdbSyncLogQuery The inner query object of the IN statement
     */
    public function useInWdbSyncLogQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\WdbSyncLogQuery */
        $q = $this->useInQuery('WdbSyncLog', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to WdbSyncLog table for a NOT IN query.
     *
     * @see useWdbSyncLogInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\WdbSyncLogQuery The inner query object of the NOT IN statement
     */
    public function useNotInWdbSyncLogQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\WdbSyncLogQuery */
        $q = $this->useInQuery('WdbSyncLog', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildUsers $users Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($users = null)
    {
        if ($users) {
            $this->addUsingAlias(UsersTableMap::COL_USER_ID, $users->getUserId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the users table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UsersTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            UsersTableMap::clearInstancePool();
            UsersTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(UsersTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(UsersTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            UsersTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            UsersTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
