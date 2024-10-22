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
use entities\ExpenseList as ChildExpenseList;
use entities\ExpenseListQuery as ChildExpenseListQuery;
use entities\Map\ExpenseListTableMap;

/**
 * Base class that represents a query for the `expense_list` table.
 *
 * @method     ChildExpenseListQuery orderByExpListId($order = Criteria::ASC) Order by the exp_list_id column
 * @method     ChildExpenseListQuery orderByExpId($order = Criteria::ASC) Order by the exp_id column
 * @method     ChildExpenseListQuery orderByExpMasterId($order = Criteria::ASC) Order by the exp_master_id column
 * @method     ChildExpenseListQuery orderByExpNote($order = Criteria::ASC) Order by the exp_note column
 * @method     ChildExpenseListQuery orderByExpRemark($order = Criteria::ASC) Order by the exp_remark column
 * @method     ChildExpenseListQuery orderByExpAuditRemark($order = Criteria::ASC) Order by the exp_audit_remark column
 * @method     ChildExpenseListQuery orderByExpDate($order = Criteria::ASC) Order by the exp_date column
 * @method     ChildExpenseListQuery orderByExpTaxAmount($order = Criteria::ASC) Order by the exp_tax_amount column
 * @method     ChildExpenseListQuery orderByExpClaimedTax($order = Criteria::ASC) Order by the exp_claimed_tax column
 * @method     ChildExpenseListQuery orderByExpTestAmount($order = Criteria::ASC) Order by the exp_test_amount column
 * @method     ChildExpenseListQuery orderByExpRateQty($order = Criteria::ASC) Order by the exp_rate_qty column
 * @method     ChildExpenseListQuery orderByExpRateMode($order = Criteria::ASC) Order by the exp_rate_mode column
 * @method     ChildExpenseListQuery orderByExpIlAmount($order = Criteria::ASC) Order by the exp_il_amount column
 * @method     ChildExpenseListQuery orderByExpReqAmount($order = Criteria::ASC) Order by the exp_req_amount column
 * @method     ChildExpenseListQuery orderByExpAprAmount($order = Criteria::ASC) Order by the exp_apr_amount column
 * @method     ChildExpenseListQuery orderByExpAuditAmount($order = Criteria::ASC) Order by the exp_audit_amount column
 * @method     ChildExpenseListQuery orderByExpFinalAmount($order = Criteria::ASC) Order by the exp_final_amount column
 * @method     ChildExpenseListQuery orderByExpPolicyKey($order = Criteria::ASC) Order by the exp_policy_key column
 * @method     ChildExpenseListQuery orderByExpLimit1($order = Criteria::ASC) Order by the exp_limit1 column
 * @method     ChildExpenseListQuery orderByEmployeeId($order = Criteria::ASC) Order by the employee_id column
 * @method     ChildExpenseListQuery orderByCmpCard($order = Criteria::ASC) Order by the cmp_card column
 * @method     ChildExpenseListQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildExpenseListQuery orderByIsReadonly($order = Criteria::ASC) Order by the is_readonly column
 *
 * @method     ChildExpenseListQuery groupByExpListId() Group by the exp_list_id column
 * @method     ChildExpenseListQuery groupByExpId() Group by the exp_id column
 * @method     ChildExpenseListQuery groupByExpMasterId() Group by the exp_master_id column
 * @method     ChildExpenseListQuery groupByExpNote() Group by the exp_note column
 * @method     ChildExpenseListQuery groupByExpRemark() Group by the exp_remark column
 * @method     ChildExpenseListQuery groupByExpAuditRemark() Group by the exp_audit_remark column
 * @method     ChildExpenseListQuery groupByExpDate() Group by the exp_date column
 * @method     ChildExpenseListQuery groupByExpTaxAmount() Group by the exp_tax_amount column
 * @method     ChildExpenseListQuery groupByExpClaimedTax() Group by the exp_claimed_tax column
 * @method     ChildExpenseListQuery groupByExpTestAmount() Group by the exp_test_amount column
 * @method     ChildExpenseListQuery groupByExpRateQty() Group by the exp_rate_qty column
 * @method     ChildExpenseListQuery groupByExpRateMode() Group by the exp_rate_mode column
 * @method     ChildExpenseListQuery groupByExpIlAmount() Group by the exp_il_amount column
 * @method     ChildExpenseListQuery groupByExpReqAmount() Group by the exp_req_amount column
 * @method     ChildExpenseListQuery groupByExpAprAmount() Group by the exp_apr_amount column
 * @method     ChildExpenseListQuery groupByExpAuditAmount() Group by the exp_audit_amount column
 * @method     ChildExpenseListQuery groupByExpFinalAmount() Group by the exp_final_amount column
 * @method     ChildExpenseListQuery groupByExpPolicyKey() Group by the exp_policy_key column
 * @method     ChildExpenseListQuery groupByExpLimit1() Group by the exp_limit1 column
 * @method     ChildExpenseListQuery groupByEmployeeId() Group by the employee_id column
 * @method     ChildExpenseListQuery groupByCmpCard() Group by the cmp_card column
 * @method     ChildExpenseListQuery groupByCompanyId() Group by the company_id column
 * @method     ChildExpenseListQuery groupByIsReadonly() Group by the is_readonly column
 *
 * @method     ChildExpenseListQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildExpenseListQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildExpenseListQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildExpenseListQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildExpenseListQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildExpenseListQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildExpenseListQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildExpenseListQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildExpenseListQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildExpenseListQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildExpenseListQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildExpenseListQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildExpenseListQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     ChildExpenseListQuery leftJoinExpenseMaster($relationAlias = null) Adds a LEFT JOIN clause to the query using the ExpenseMaster relation
 * @method     ChildExpenseListQuery rightJoinExpenseMaster($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ExpenseMaster relation
 * @method     ChildExpenseListQuery innerJoinExpenseMaster($relationAlias = null) Adds a INNER JOIN clause to the query using the ExpenseMaster relation
 *
 * @method     ChildExpenseListQuery joinWithExpenseMaster($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ExpenseMaster relation
 *
 * @method     ChildExpenseListQuery leftJoinWithExpenseMaster() Adds a LEFT JOIN clause and with to the query using the ExpenseMaster relation
 * @method     ChildExpenseListQuery rightJoinWithExpenseMaster() Adds a RIGHT JOIN clause and with to the query using the ExpenseMaster relation
 * @method     ChildExpenseListQuery innerJoinWithExpenseMaster() Adds a INNER JOIN clause and with to the query using the ExpenseMaster relation
 *
 * @method     ChildExpenseListQuery leftJoinExpenses($relationAlias = null) Adds a LEFT JOIN clause to the query using the Expenses relation
 * @method     ChildExpenseListQuery rightJoinExpenses($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Expenses relation
 * @method     ChildExpenseListQuery innerJoinExpenses($relationAlias = null) Adds a INNER JOIN clause to the query using the Expenses relation
 *
 * @method     ChildExpenseListQuery joinWithExpenses($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Expenses relation
 *
 * @method     ChildExpenseListQuery leftJoinWithExpenses() Adds a LEFT JOIN clause and with to the query using the Expenses relation
 * @method     ChildExpenseListQuery rightJoinWithExpenses() Adds a RIGHT JOIN clause and with to the query using the Expenses relation
 * @method     ChildExpenseListQuery innerJoinWithExpenses() Adds a INNER JOIN clause and with to the query using the Expenses relation
 *
 * @method     ChildExpenseListQuery leftJoinExpenseListDetails($relationAlias = null) Adds a LEFT JOIN clause to the query using the ExpenseListDetails relation
 * @method     ChildExpenseListQuery rightJoinExpenseListDetails($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ExpenseListDetails relation
 * @method     ChildExpenseListQuery innerJoinExpenseListDetails($relationAlias = null) Adds a INNER JOIN clause to the query using the ExpenseListDetails relation
 *
 * @method     ChildExpenseListQuery joinWithExpenseListDetails($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ExpenseListDetails relation
 *
 * @method     ChildExpenseListQuery leftJoinWithExpenseListDetails() Adds a LEFT JOIN clause and with to the query using the ExpenseListDetails relation
 * @method     ChildExpenseListQuery rightJoinWithExpenseListDetails() Adds a RIGHT JOIN clause and with to the query using the ExpenseListDetails relation
 * @method     ChildExpenseListQuery innerJoinWithExpenseListDetails() Adds a INNER JOIN clause and with to the query using the ExpenseListDetails relation
 *
 * @method     \entities\CompanyQuery|\entities\ExpenseMasterQuery|\entities\ExpensesQuery|\entities\ExpenseListDetailsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildExpenseList|null findOne(?ConnectionInterface $con = null) Return the first ChildExpenseList matching the query
 * @method     ChildExpenseList findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildExpenseList matching the query, or a new ChildExpenseList object populated from the query conditions when no match is found
 *
 * @method     ChildExpenseList|null findOneByExpListId(int $exp_list_id) Return the first ChildExpenseList filtered by the exp_list_id column
 * @method     ChildExpenseList|null findOneByExpId(int $exp_id) Return the first ChildExpenseList filtered by the exp_id column
 * @method     ChildExpenseList|null findOneByExpMasterId(int $exp_master_id) Return the first ChildExpenseList filtered by the exp_master_id column
 * @method     ChildExpenseList|null findOneByExpNote(string $exp_note) Return the first ChildExpenseList filtered by the exp_note column
 * @method     ChildExpenseList|null findOneByExpRemark(string $exp_remark) Return the first ChildExpenseList filtered by the exp_remark column
 * @method     ChildExpenseList|null findOneByExpAuditRemark(string $exp_audit_remark) Return the first ChildExpenseList filtered by the exp_audit_remark column
 * @method     ChildExpenseList|null findOneByExpDate(string $exp_date) Return the first ChildExpenseList filtered by the exp_date column
 * @method     ChildExpenseList|null findOneByExpTaxAmount(string $exp_tax_amount) Return the first ChildExpenseList filtered by the exp_tax_amount column
 * @method     ChildExpenseList|null findOneByExpClaimedTax(string $exp_claimed_tax) Return the first ChildExpenseList filtered by the exp_claimed_tax column
 * @method     ChildExpenseList|null findOneByExpTestAmount(string $exp_test_amount) Return the first ChildExpenseList filtered by the exp_test_amount column
 * @method     ChildExpenseList|null findOneByExpRateQty(string $exp_rate_qty) Return the first ChildExpenseList filtered by the exp_rate_qty column
 * @method     ChildExpenseList|null findOneByExpRateMode(string $exp_rate_mode) Return the first ChildExpenseList filtered by the exp_rate_mode column
 * @method     ChildExpenseList|null findOneByExpIlAmount(string $exp_il_amount) Return the first ChildExpenseList filtered by the exp_il_amount column
 * @method     ChildExpenseList|null findOneByExpReqAmount(string $exp_req_amount) Return the first ChildExpenseList filtered by the exp_req_amount column
 * @method     ChildExpenseList|null findOneByExpAprAmount(string $exp_apr_amount) Return the first ChildExpenseList filtered by the exp_apr_amount column
 * @method     ChildExpenseList|null findOneByExpAuditAmount(string $exp_audit_amount) Return the first ChildExpenseList filtered by the exp_audit_amount column
 * @method     ChildExpenseList|null findOneByExpFinalAmount(string $exp_final_amount) Return the first ChildExpenseList filtered by the exp_final_amount column
 * @method     ChildExpenseList|null findOneByExpPolicyKey(string $exp_policy_key) Return the first ChildExpenseList filtered by the exp_policy_key column
 * @method     ChildExpenseList|null findOneByExpLimit1(string $exp_limit1) Return the first ChildExpenseList filtered by the exp_limit1 column
 * @method     ChildExpenseList|null findOneByEmployeeId(int $employee_id) Return the first ChildExpenseList filtered by the employee_id column
 * @method     ChildExpenseList|null findOneByCmpCard(int $cmp_card) Return the first ChildExpenseList filtered by the cmp_card column
 * @method     ChildExpenseList|null findOneByCompanyId(int $company_id) Return the first ChildExpenseList filtered by the company_id column
 * @method     ChildExpenseList|null findOneByIsReadonly(boolean $is_readonly) Return the first ChildExpenseList filtered by the is_readonly column
 *
 * @method     ChildExpenseList requirePk($key, ?ConnectionInterface $con = null) Return the ChildExpenseList by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseList requireOne(?ConnectionInterface $con = null) Return the first ChildExpenseList matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildExpenseList requireOneByExpListId(int $exp_list_id) Return the first ChildExpenseList filtered by the exp_list_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseList requireOneByExpId(int $exp_id) Return the first ChildExpenseList filtered by the exp_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseList requireOneByExpMasterId(int $exp_master_id) Return the first ChildExpenseList filtered by the exp_master_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseList requireOneByExpNote(string $exp_note) Return the first ChildExpenseList filtered by the exp_note column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseList requireOneByExpRemark(string $exp_remark) Return the first ChildExpenseList filtered by the exp_remark column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseList requireOneByExpAuditRemark(string $exp_audit_remark) Return the first ChildExpenseList filtered by the exp_audit_remark column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseList requireOneByExpDate(string $exp_date) Return the first ChildExpenseList filtered by the exp_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseList requireOneByExpTaxAmount(string $exp_tax_amount) Return the first ChildExpenseList filtered by the exp_tax_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseList requireOneByExpClaimedTax(string $exp_claimed_tax) Return the first ChildExpenseList filtered by the exp_claimed_tax column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseList requireOneByExpTestAmount(string $exp_test_amount) Return the first ChildExpenseList filtered by the exp_test_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseList requireOneByExpRateQty(string $exp_rate_qty) Return the first ChildExpenseList filtered by the exp_rate_qty column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseList requireOneByExpRateMode(string $exp_rate_mode) Return the first ChildExpenseList filtered by the exp_rate_mode column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseList requireOneByExpIlAmount(string $exp_il_amount) Return the first ChildExpenseList filtered by the exp_il_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseList requireOneByExpReqAmount(string $exp_req_amount) Return the first ChildExpenseList filtered by the exp_req_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseList requireOneByExpAprAmount(string $exp_apr_amount) Return the first ChildExpenseList filtered by the exp_apr_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseList requireOneByExpAuditAmount(string $exp_audit_amount) Return the first ChildExpenseList filtered by the exp_audit_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseList requireOneByExpFinalAmount(string $exp_final_amount) Return the first ChildExpenseList filtered by the exp_final_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseList requireOneByExpPolicyKey(string $exp_policy_key) Return the first ChildExpenseList filtered by the exp_policy_key column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseList requireOneByExpLimit1(string $exp_limit1) Return the first ChildExpenseList filtered by the exp_limit1 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseList requireOneByEmployeeId(int $employee_id) Return the first ChildExpenseList filtered by the employee_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseList requireOneByCmpCard(int $cmp_card) Return the first ChildExpenseList filtered by the cmp_card column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseList requireOneByCompanyId(int $company_id) Return the first ChildExpenseList filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseList requireOneByIsReadonly(boolean $is_readonly) Return the first ChildExpenseList filtered by the is_readonly column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildExpenseList[]|Collection find(?ConnectionInterface $con = null) Return ChildExpenseList objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildExpenseList> find(?ConnectionInterface $con = null) Return ChildExpenseList objects based on current ModelCriteria
 *
 * @method     ChildExpenseList[]|Collection findByExpListId(int|array<int> $exp_list_id) Return ChildExpenseList objects filtered by the exp_list_id column
 * @psalm-method Collection&\Traversable<ChildExpenseList> findByExpListId(int|array<int> $exp_list_id) Return ChildExpenseList objects filtered by the exp_list_id column
 * @method     ChildExpenseList[]|Collection findByExpId(int|array<int> $exp_id) Return ChildExpenseList objects filtered by the exp_id column
 * @psalm-method Collection&\Traversable<ChildExpenseList> findByExpId(int|array<int> $exp_id) Return ChildExpenseList objects filtered by the exp_id column
 * @method     ChildExpenseList[]|Collection findByExpMasterId(int|array<int> $exp_master_id) Return ChildExpenseList objects filtered by the exp_master_id column
 * @psalm-method Collection&\Traversable<ChildExpenseList> findByExpMasterId(int|array<int> $exp_master_id) Return ChildExpenseList objects filtered by the exp_master_id column
 * @method     ChildExpenseList[]|Collection findByExpNote(string|array<string> $exp_note) Return ChildExpenseList objects filtered by the exp_note column
 * @psalm-method Collection&\Traversable<ChildExpenseList> findByExpNote(string|array<string> $exp_note) Return ChildExpenseList objects filtered by the exp_note column
 * @method     ChildExpenseList[]|Collection findByExpRemark(string|array<string> $exp_remark) Return ChildExpenseList objects filtered by the exp_remark column
 * @psalm-method Collection&\Traversable<ChildExpenseList> findByExpRemark(string|array<string> $exp_remark) Return ChildExpenseList objects filtered by the exp_remark column
 * @method     ChildExpenseList[]|Collection findByExpAuditRemark(string|array<string> $exp_audit_remark) Return ChildExpenseList objects filtered by the exp_audit_remark column
 * @psalm-method Collection&\Traversable<ChildExpenseList> findByExpAuditRemark(string|array<string> $exp_audit_remark) Return ChildExpenseList objects filtered by the exp_audit_remark column
 * @method     ChildExpenseList[]|Collection findByExpDate(string|array<string> $exp_date) Return ChildExpenseList objects filtered by the exp_date column
 * @psalm-method Collection&\Traversable<ChildExpenseList> findByExpDate(string|array<string> $exp_date) Return ChildExpenseList objects filtered by the exp_date column
 * @method     ChildExpenseList[]|Collection findByExpTaxAmount(string|array<string> $exp_tax_amount) Return ChildExpenseList objects filtered by the exp_tax_amount column
 * @psalm-method Collection&\Traversable<ChildExpenseList> findByExpTaxAmount(string|array<string> $exp_tax_amount) Return ChildExpenseList objects filtered by the exp_tax_amount column
 * @method     ChildExpenseList[]|Collection findByExpClaimedTax(string|array<string> $exp_claimed_tax) Return ChildExpenseList objects filtered by the exp_claimed_tax column
 * @psalm-method Collection&\Traversable<ChildExpenseList> findByExpClaimedTax(string|array<string> $exp_claimed_tax) Return ChildExpenseList objects filtered by the exp_claimed_tax column
 * @method     ChildExpenseList[]|Collection findByExpTestAmount(string|array<string> $exp_test_amount) Return ChildExpenseList objects filtered by the exp_test_amount column
 * @psalm-method Collection&\Traversable<ChildExpenseList> findByExpTestAmount(string|array<string> $exp_test_amount) Return ChildExpenseList objects filtered by the exp_test_amount column
 * @method     ChildExpenseList[]|Collection findByExpRateQty(string|array<string> $exp_rate_qty) Return ChildExpenseList objects filtered by the exp_rate_qty column
 * @psalm-method Collection&\Traversable<ChildExpenseList> findByExpRateQty(string|array<string> $exp_rate_qty) Return ChildExpenseList objects filtered by the exp_rate_qty column
 * @method     ChildExpenseList[]|Collection findByExpRateMode(string|array<string> $exp_rate_mode) Return ChildExpenseList objects filtered by the exp_rate_mode column
 * @psalm-method Collection&\Traversable<ChildExpenseList> findByExpRateMode(string|array<string> $exp_rate_mode) Return ChildExpenseList objects filtered by the exp_rate_mode column
 * @method     ChildExpenseList[]|Collection findByExpIlAmount(string|array<string> $exp_il_amount) Return ChildExpenseList objects filtered by the exp_il_amount column
 * @psalm-method Collection&\Traversable<ChildExpenseList> findByExpIlAmount(string|array<string> $exp_il_amount) Return ChildExpenseList objects filtered by the exp_il_amount column
 * @method     ChildExpenseList[]|Collection findByExpReqAmount(string|array<string> $exp_req_amount) Return ChildExpenseList objects filtered by the exp_req_amount column
 * @psalm-method Collection&\Traversable<ChildExpenseList> findByExpReqAmount(string|array<string> $exp_req_amount) Return ChildExpenseList objects filtered by the exp_req_amount column
 * @method     ChildExpenseList[]|Collection findByExpAprAmount(string|array<string> $exp_apr_amount) Return ChildExpenseList objects filtered by the exp_apr_amount column
 * @psalm-method Collection&\Traversable<ChildExpenseList> findByExpAprAmount(string|array<string> $exp_apr_amount) Return ChildExpenseList objects filtered by the exp_apr_amount column
 * @method     ChildExpenseList[]|Collection findByExpAuditAmount(string|array<string> $exp_audit_amount) Return ChildExpenseList objects filtered by the exp_audit_amount column
 * @psalm-method Collection&\Traversable<ChildExpenseList> findByExpAuditAmount(string|array<string> $exp_audit_amount) Return ChildExpenseList objects filtered by the exp_audit_amount column
 * @method     ChildExpenseList[]|Collection findByExpFinalAmount(string|array<string> $exp_final_amount) Return ChildExpenseList objects filtered by the exp_final_amount column
 * @psalm-method Collection&\Traversable<ChildExpenseList> findByExpFinalAmount(string|array<string> $exp_final_amount) Return ChildExpenseList objects filtered by the exp_final_amount column
 * @method     ChildExpenseList[]|Collection findByExpPolicyKey(string|array<string> $exp_policy_key) Return ChildExpenseList objects filtered by the exp_policy_key column
 * @psalm-method Collection&\Traversable<ChildExpenseList> findByExpPolicyKey(string|array<string> $exp_policy_key) Return ChildExpenseList objects filtered by the exp_policy_key column
 * @method     ChildExpenseList[]|Collection findByExpLimit1(string|array<string> $exp_limit1) Return ChildExpenseList objects filtered by the exp_limit1 column
 * @psalm-method Collection&\Traversable<ChildExpenseList> findByExpLimit1(string|array<string> $exp_limit1) Return ChildExpenseList objects filtered by the exp_limit1 column
 * @method     ChildExpenseList[]|Collection findByEmployeeId(int|array<int> $employee_id) Return ChildExpenseList objects filtered by the employee_id column
 * @psalm-method Collection&\Traversable<ChildExpenseList> findByEmployeeId(int|array<int> $employee_id) Return ChildExpenseList objects filtered by the employee_id column
 * @method     ChildExpenseList[]|Collection findByCmpCard(int|array<int> $cmp_card) Return ChildExpenseList objects filtered by the cmp_card column
 * @psalm-method Collection&\Traversable<ChildExpenseList> findByCmpCard(int|array<int> $cmp_card) Return ChildExpenseList objects filtered by the cmp_card column
 * @method     ChildExpenseList[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildExpenseList objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildExpenseList> findByCompanyId(int|array<int> $company_id) Return ChildExpenseList objects filtered by the company_id column
 * @method     ChildExpenseList[]|Collection findByIsReadonly(boolean|array<boolean> $is_readonly) Return ChildExpenseList objects filtered by the is_readonly column
 * @psalm-method Collection&\Traversable<ChildExpenseList> findByIsReadonly(boolean|array<boolean> $is_readonly) Return ChildExpenseList objects filtered by the is_readonly column
 *
 * @method     ChildExpenseList[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildExpenseList> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class ExpenseListQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\ExpenseListQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\ExpenseList', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildExpenseListQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildExpenseListQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildExpenseListQuery) {
            return $criteria;
        }
        $query = new ChildExpenseListQuery();
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
     * @return ChildExpenseList|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ExpenseListTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ExpenseListTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildExpenseList A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT exp_list_id, exp_id, exp_master_id, exp_note, exp_remark, exp_audit_remark, exp_date, exp_tax_amount, exp_claimed_tax, exp_test_amount, exp_rate_qty, exp_rate_mode, exp_il_amount, exp_req_amount, exp_apr_amount, exp_audit_amount, exp_final_amount, exp_policy_key, exp_limit1, employee_id, cmp_card, company_id, is_readonly FROM expense_list WHERE exp_list_id = :p0';
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
            /** @var ChildExpenseList $obj */
            $obj = new ChildExpenseList();
            $obj->hydrate($row);
            ExpenseListTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildExpenseList|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(ExpenseListTableMap::COL_EXP_LIST_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(ExpenseListTableMap::COL_EXP_LIST_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the exp_list_id column
     *
     * Example usage:
     * <code>
     * $query->filterByExpListId(1234); // WHERE exp_list_id = 1234
     * $query->filterByExpListId(array(12, 34)); // WHERE exp_list_id IN (12, 34)
     * $query->filterByExpListId(array('min' => 12)); // WHERE exp_list_id > 12
     * </code>
     *
     * @param mixed $expListId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpListId($expListId = null, ?string $comparison = null)
    {
        if (is_array($expListId)) {
            $useMinMax = false;
            if (isset($expListId['min'])) {
                $this->addUsingAlias(ExpenseListTableMap::COL_EXP_LIST_ID, $expListId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($expListId['max'])) {
                $this->addUsingAlias(ExpenseListTableMap::COL_EXP_LIST_ID, $expListId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpenseListTableMap::COL_EXP_LIST_ID, $expListId, $comparison);

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
     * @see       filterByExpenses()
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
                $this->addUsingAlias(ExpenseListTableMap::COL_EXP_ID, $expId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($expId['max'])) {
                $this->addUsingAlias(ExpenseListTableMap::COL_EXP_ID, $expId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpenseListTableMap::COL_EXP_ID, $expId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the exp_master_id column
     *
     * Example usage:
     * <code>
     * $query->filterByExpMasterId(1234); // WHERE exp_master_id = 1234
     * $query->filterByExpMasterId(array(12, 34)); // WHERE exp_master_id IN (12, 34)
     * $query->filterByExpMasterId(array('min' => 12)); // WHERE exp_master_id > 12
     * </code>
     *
     * @see       filterByExpenseMaster()
     *
     * @param mixed $expMasterId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpMasterId($expMasterId = null, ?string $comparison = null)
    {
        if (is_array($expMasterId)) {
            $useMinMax = false;
            if (isset($expMasterId['min'])) {
                $this->addUsingAlias(ExpenseListTableMap::COL_EXP_MASTER_ID, $expMasterId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($expMasterId['max'])) {
                $this->addUsingAlias(ExpenseListTableMap::COL_EXP_MASTER_ID, $expMasterId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpenseListTableMap::COL_EXP_MASTER_ID, $expMasterId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the exp_note column
     *
     * Example usage:
     * <code>
     * $query->filterByExpNote('fooValue');   // WHERE exp_note = 'fooValue'
     * $query->filterByExpNote('%fooValue%', Criteria::LIKE); // WHERE exp_note LIKE '%fooValue%'
     * $query->filterByExpNote(['foo', 'bar']); // WHERE exp_note IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $expNote The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpNote($expNote = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($expNote)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpenseListTableMap::COL_EXP_NOTE, $expNote, $comparison);

        return $this;
    }

    /**
     * Filter the query on the exp_remark column
     *
     * Example usage:
     * <code>
     * $query->filterByExpRemark('fooValue');   // WHERE exp_remark = 'fooValue'
     * $query->filterByExpRemark('%fooValue%', Criteria::LIKE); // WHERE exp_remark LIKE '%fooValue%'
     * $query->filterByExpRemark(['foo', 'bar']); // WHERE exp_remark IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $expRemark The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpRemark($expRemark = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($expRemark)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpenseListTableMap::COL_EXP_REMARK, $expRemark, $comparison);

        return $this;
    }

    /**
     * Filter the query on the exp_audit_remark column
     *
     * Example usage:
     * <code>
     * $query->filterByExpAuditRemark('fooValue');   // WHERE exp_audit_remark = 'fooValue'
     * $query->filterByExpAuditRemark('%fooValue%', Criteria::LIKE); // WHERE exp_audit_remark LIKE '%fooValue%'
     * $query->filterByExpAuditRemark(['foo', 'bar']); // WHERE exp_audit_remark IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $expAuditRemark The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpAuditRemark($expAuditRemark = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($expAuditRemark)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpenseListTableMap::COL_EXP_AUDIT_REMARK, $expAuditRemark, $comparison);

        return $this;
    }

    /**
     * Filter the query on the exp_date column
     *
     * Example usage:
     * <code>
     * $query->filterByExpDate('2011-03-14'); // WHERE exp_date = '2011-03-14'
     * $query->filterByExpDate('now'); // WHERE exp_date = '2011-03-14'
     * $query->filterByExpDate(array('max' => 'yesterday')); // WHERE exp_date > '2011-03-13'
     * </code>
     *
     * @param mixed $expDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpDate($expDate = null, ?string $comparison = null)
    {
        if (is_array($expDate)) {
            $useMinMax = false;
            if (isset($expDate['min'])) {
                $this->addUsingAlias(ExpenseListTableMap::COL_EXP_DATE, $expDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($expDate['max'])) {
                $this->addUsingAlias(ExpenseListTableMap::COL_EXP_DATE, $expDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpenseListTableMap::COL_EXP_DATE, $expDate, $comparison);

        return $this;
    }

    /**
     * Filter the query on the exp_tax_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByExpTaxAmount(1234); // WHERE exp_tax_amount = 1234
     * $query->filterByExpTaxAmount(array(12, 34)); // WHERE exp_tax_amount IN (12, 34)
     * $query->filterByExpTaxAmount(array('min' => 12)); // WHERE exp_tax_amount > 12
     * </code>
     *
     * @param mixed $expTaxAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpTaxAmount($expTaxAmount = null, ?string $comparison = null)
    {
        if (is_array($expTaxAmount)) {
            $useMinMax = false;
            if (isset($expTaxAmount['min'])) {
                $this->addUsingAlias(ExpenseListTableMap::COL_EXP_TAX_AMOUNT, $expTaxAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($expTaxAmount['max'])) {
                $this->addUsingAlias(ExpenseListTableMap::COL_EXP_TAX_AMOUNT, $expTaxAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpenseListTableMap::COL_EXP_TAX_AMOUNT, $expTaxAmount, $comparison);

        return $this;
    }

    /**
     * Filter the query on the exp_claimed_tax column
     *
     * Example usage:
     * <code>
     * $query->filterByExpClaimedTax(1234); // WHERE exp_claimed_tax = 1234
     * $query->filterByExpClaimedTax(array(12, 34)); // WHERE exp_claimed_tax IN (12, 34)
     * $query->filterByExpClaimedTax(array('min' => 12)); // WHERE exp_claimed_tax > 12
     * </code>
     *
     * @param mixed $expClaimedTax The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpClaimedTax($expClaimedTax = null, ?string $comparison = null)
    {
        if (is_array($expClaimedTax)) {
            $useMinMax = false;
            if (isset($expClaimedTax['min'])) {
                $this->addUsingAlias(ExpenseListTableMap::COL_EXP_CLAIMED_TAX, $expClaimedTax['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($expClaimedTax['max'])) {
                $this->addUsingAlias(ExpenseListTableMap::COL_EXP_CLAIMED_TAX, $expClaimedTax['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpenseListTableMap::COL_EXP_CLAIMED_TAX, $expClaimedTax, $comparison);

        return $this;
    }

    /**
     * Filter the query on the exp_test_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByExpTestAmount(1234); // WHERE exp_test_amount = 1234
     * $query->filterByExpTestAmount(array(12, 34)); // WHERE exp_test_amount IN (12, 34)
     * $query->filterByExpTestAmount(array('min' => 12)); // WHERE exp_test_amount > 12
     * </code>
     *
     * @param mixed $expTestAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpTestAmount($expTestAmount = null, ?string $comparison = null)
    {
        if (is_array($expTestAmount)) {
            $useMinMax = false;
            if (isset($expTestAmount['min'])) {
                $this->addUsingAlias(ExpenseListTableMap::COL_EXP_TEST_AMOUNT, $expTestAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($expTestAmount['max'])) {
                $this->addUsingAlias(ExpenseListTableMap::COL_EXP_TEST_AMOUNT, $expTestAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpenseListTableMap::COL_EXP_TEST_AMOUNT, $expTestAmount, $comparison);

        return $this;
    }

    /**
     * Filter the query on the exp_rate_qty column
     *
     * Example usage:
     * <code>
     * $query->filterByExpRateQty(1234); // WHERE exp_rate_qty = 1234
     * $query->filterByExpRateQty(array(12, 34)); // WHERE exp_rate_qty IN (12, 34)
     * $query->filterByExpRateQty(array('min' => 12)); // WHERE exp_rate_qty > 12
     * </code>
     *
     * @param mixed $expRateQty The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpRateQty($expRateQty = null, ?string $comparison = null)
    {
        if (is_array($expRateQty)) {
            $useMinMax = false;
            if (isset($expRateQty['min'])) {
                $this->addUsingAlias(ExpenseListTableMap::COL_EXP_RATE_QTY, $expRateQty['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($expRateQty['max'])) {
                $this->addUsingAlias(ExpenseListTableMap::COL_EXP_RATE_QTY, $expRateQty['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpenseListTableMap::COL_EXP_RATE_QTY, $expRateQty, $comparison);

        return $this;
    }

    /**
     * Filter the query on the exp_rate_mode column
     *
     * Example usage:
     * <code>
     * $query->filterByExpRateMode('fooValue');   // WHERE exp_rate_mode = 'fooValue'
     * $query->filterByExpRateMode('%fooValue%', Criteria::LIKE); // WHERE exp_rate_mode LIKE '%fooValue%'
     * $query->filterByExpRateMode(['foo', 'bar']); // WHERE exp_rate_mode IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $expRateMode The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpRateMode($expRateMode = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($expRateMode)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpenseListTableMap::COL_EXP_RATE_MODE, $expRateMode, $comparison);

        return $this;
    }

    /**
     * Filter the query on the exp_il_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByExpIlAmount(1234); // WHERE exp_il_amount = 1234
     * $query->filterByExpIlAmount(array(12, 34)); // WHERE exp_il_amount IN (12, 34)
     * $query->filterByExpIlAmount(array('min' => 12)); // WHERE exp_il_amount > 12
     * </code>
     *
     * @param mixed $expIlAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpIlAmount($expIlAmount = null, ?string $comparison = null)
    {
        if (is_array($expIlAmount)) {
            $useMinMax = false;
            if (isset($expIlAmount['min'])) {
                $this->addUsingAlias(ExpenseListTableMap::COL_EXP_IL_AMOUNT, $expIlAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($expIlAmount['max'])) {
                $this->addUsingAlias(ExpenseListTableMap::COL_EXP_IL_AMOUNT, $expIlAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpenseListTableMap::COL_EXP_IL_AMOUNT, $expIlAmount, $comparison);

        return $this;
    }

    /**
     * Filter the query on the exp_req_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByExpReqAmount(1234); // WHERE exp_req_amount = 1234
     * $query->filterByExpReqAmount(array(12, 34)); // WHERE exp_req_amount IN (12, 34)
     * $query->filterByExpReqAmount(array('min' => 12)); // WHERE exp_req_amount > 12
     * </code>
     *
     * @param mixed $expReqAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpReqAmount($expReqAmount = null, ?string $comparison = null)
    {
        if (is_array($expReqAmount)) {
            $useMinMax = false;
            if (isset($expReqAmount['min'])) {
                $this->addUsingAlias(ExpenseListTableMap::COL_EXP_REQ_AMOUNT, $expReqAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($expReqAmount['max'])) {
                $this->addUsingAlias(ExpenseListTableMap::COL_EXP_REQ_AMOUNT, $expReqAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpenseListTableMap::COL_EXP_REQ_AMOUNT, $expReqAmount, $comparison);

        return $this;
    }

    /**
     * Filter the query on the exp_apr_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByExpAprAmount(1234); // WHERE exp_apr_amount = 1234
     * $query->filterByExpAprAmount(array(12, 34)); // WHERE exp_apr_amount IN (12, 34)
     * $query->filterByExpAprAmount(array('min' => 12)); // WHERE exp_apr_amount > 12
     * </code>
     *
     * @param mixed $expAprAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpAprAmount($expAprAmount = null, ?string $comparison = null)
    {
        if (is_array($expAprAmount)) {
            $useMinMax = false;
            if (isset($expAprAmount['min'])) {
                $this->addUsingAlias(ExpenseListTableMap::COL_EXP_APR_AMOUNT, $expAprAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($expAprAmount['max'])) {
                $this->addUsingAlias(ExpenseListTableMap::COL_EXP_APR_AMOUNT, $expAprAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpenseListTableMap::COL_EXP_APR_AMOUNT, $expAprAmount, $comparison);

        return $this;
    }

    /**
     * Filter the query on the exp_audit_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByExpAuditAmount(1234); // WHERE exp_audit_amount = 1234
     * $query->filterByExpAuditAmount(array(12, 34)); // WHERE exp_audit_amount IN (12, 34)
     * $query->filterByExpAuditAmount(array('min' => 12)); // WHERE exp_audit_amount > 12
     * </code>
     *
     * @param mixed $expAuditAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpAuditAmount($expAuditAmount = null, ?string $comparison = null)
    {
        if (is_array($expAuditAmount)) {
            $useMinMax = false;
            if (isset($expAuditAmount['min'])) {
                $this->addUsingAlias(ExpenseListTableMap::COL_EXP_AUDIT_AMOUNT, $expAuditAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($expAuditAmount['max'])) {
                $this->addUsingAlias(ExpenseListTableMap::COL_EXP_AUDIT_AMOUNT, $expAuditAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpenseListTableMap::COL_EXP_AUDIT_AMOUNT, $expAuditAmount, $comparison);

        return $this;
    }

    /**
     * Filter the query on the exp_final_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByExpFinalAmount(1234); // WHERE exp_final_amount = 1234
     * $query->filterByExpFinalAmount(array(12, 34)); // WHERE exp_final_amount IN (12, 34)
     * $query->filterByExpFinalAmount(array('min' => 12)); // WHERE exp_final_amount > 12
     * </code>
     *
     * @param mixed $expFinalAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpFinalAmount($expFinalAmount = null, ?string $comparison = null)
    {
        if (is_array($expFinalAmount)) {
            $useMinMax = false;
            if (isset($expFinalAmount['min'])) {
                $this->addUsingAlias(ExpenseListTableMap::COL_EXP_FINAL_AMOUNT, $expFinalAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($expFinalAmount['max'])) {
                $this->addUsingAlias(ExpenseListTableMap::COL_EXP_FINAL_AMOUNT, $expFinalAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpenseListTableMap::COL_EXP_FINAL_AMOUNT, $expFinalAmount, $comparison);

        return $this;
    }

    /**
     * Filter the query on the exp_policy_key column
     *
     * Example usage:
     * <code>
     * $query->filterByExpPolicyKey('fooValue');   // WHERE exp_policy_key = 'fooValue'
     * $query->filterByExpPolicyKey('%fooValue%', Criteria::LIKE); // WHERE exp_policy_key LIKE '%fooValue%'
     * $query->filterByExpPolicyKey(['foo', 'bar']); // WHERE exp_policy_key IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $expPolicyKey The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpPolicyKey($expPolicyKey = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($expPolicyKey)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpenseListTableMap::COL_EXP_POLICY_KEY, $expPolicyKey, $comparison);

        return $this;
    }

    /**
     * Filter the query on the exp_limit1 column
     *
     * Example usage:
     * <code>
     * $query->filterByExpLimit1(1234); // WHERE exp_limit1 = 1234
     * $query->filterByExpLimit1(array(12, 34)); // WHERE exp_limit1 IN (12, 34)
     * $query->filterByExpLimit1(array('min' => 12)); // WHERE exp_limit1 > 12
     * </code>
     *
     * @param mixed $expLimit1 The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpLimit1($expLimit1 = null, ?string $comparison = null)
    {
        if (is_array($expLimit1)) {
            $useMinMax = false;
            if (isset($expLimit1['min'])) {
                $this->addUsingAlias(ExpenseListTableMap::COL_EXP_LIMIT1, $expLimit1['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($expLimit1['max'])) {
                $this->addUsingAlias(ExpenseListTableMap::COL_EXP_LIMIT1, $expLimit1['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpenseListTableMap::COL_EXP_LIMIT1, $expLimit1, $comparison);

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
                $this->addUsingAlias(ExpenseListTableMap::COL_EMPLOYEE_ID, $employeeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($employeeId['max'])) {
                $this->addUsingAlias(ExpenseListTableMap::COL_EMPLOYEE_ID, $employeeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpenseListTableMap::COL_EMPLOYEE_ID, $employeeId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the cmp_card column
     *
     * Example usage:
     * <code>
     * $query->filterByCmpCard(1234); // WHERE cmp_card = 1234
     * $query->filterByCmpCard(array(12, 34)); // WHERE cmp_card IN (12, 34)
     * $query->filterByCmpCard(array('min' => 12)); // WHERE cmp_card > 12
     * </code>
     *
     * @param mixed $cmpCard The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCmpCard($cmpCard = null, ?string $comparison = null)
    {
        if (is_array($cmpCard)) {
            $useMinMax = false;
            if (isset($cmpCard['min'])) {
                $this->addUsingAlias(ExpenseListTableMap::COL_CMP_CARD, $cmpCard['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($cmpCard['max'])) {
                $this->addUsingAlias(ExpenseListTableMap::COL_CMP_CARD, $cmpCard['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpenseListTableMap::COL_CMP_CARD, $cmpCard, $comparison);

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
                $this->addUsingAlias(ExpenseListTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(ExpenseListTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpenseListTableMap::COL_COMPANY_ID, $companyId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the is_readonly column
     *
     * Example usage:
     * <code>
     * $query->filterByIsReadonly(true); // WHERE is_readonly = true
     * $query->filterByIsReadonly('yes'); // WHERE is_readonly = true
     * </code>
     *
     * @param bool|string $isReadonly The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIsReadonly($isReadonly = null, ?string $comparison = null)
    {
        if (is_string($isReadonly)) {
            $isReadonly = in_array(strtolower($isReadonly), array('false', 'off', '-', 'no', 'n', '0', ''), true) ? false : true;
        }

        $this->addUsingAlias(ExpenseListTableMap::COL_IS_READONLY, $isReadonly, $comparison);

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
                ->addUsingAlias(ExpenseListTableMap::COL_COMPANY_ID, $company->getCompanyId(), $comparison);
        } elseif ($company instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(ExpenseListTableMap::COL_COMPANY_ID, $company->toKeyValue('PrimaryKey', 'CompanyId'), $comparison);

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
     * Filter the query by a related \entities\ExpenseMaster object
     *
     * @param \entities\ExpenseMaster|ObjectCollection $expenseMaster The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpenseMaster($expenseMaster, ?string $comparison = null)
    {
        if ($expenseMaster instanceof \entities\ExpenseMaster) {
            return $this
                ->addUsingAlias(ExpenseListTableMap::COL_EXP_MASTER_ID, $expenseMaster->getExpenseId(), $comparison);
        } elseif ($expenseMaster instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(ExpenseListTableMap::COL_EXP_MASTER_ID, $expenseMaster->toKeyValue('PrimaryKey', 'ExpenseId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByExpenseMaster() only accepts arguments of type \entities\ExpenseMaster or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ExpenseMaster relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinExpenseMaster(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ExpenseMaster');

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
            $this->addJoinObject($join, 'ExpenseMaster');
        }

        return $this;
    }

    /**
     * Use the ExpenseMaster relation ExpenseMaster object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\ExpenseMasterQuery A secondary query class using the current class as primary query
     */
    public function useExpenseMasterQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinExpenseMaster($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ExpenseMaster', '\entities\ExpenseMasterQuery');
    }

    /**
     * Use the ExpenseMaster relation ExpenseMaster object
     *
     * @param callable(\entities\ExpenseMasterQuery):\entities\ExpenseMasterQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withExpenseMasterQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useExpenseMasterQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to ExpenseMaster table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\ExpenseMasterQuery The inner query object of the EXISTS statement
     */
    public function useExpenseMasterExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\ExpenseMasterQuery */
        $q = $this->useExistsQuery('ExpenseMaster', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to ExpenseMaster table for a NOT EXISTS query.
     *
     * @see useExpenseMasterExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\ExpenseMasterQuery The inner query object of the NOT EXISTS statement
     */
    public function useExpenseMasterNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\ExpenseMasterQuery */
        $q = $this->useExistsQuery('ExpenseMaster', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to ExpenseMaster table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\ExpenseMasterQuery The inner query object of the IN statement
     */
    public function useInExpenseMasterQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\ExpenseMasterQuery */
        $q = $this->useInQuery('ExpenseMaster', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to ExpenseMaster table for a NOT IN query.
     *
     * @see useExpenseMasterInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\ExpenseMasterQuery The inner query object of the NOT IN statement
     */
    public function useNotInExpenseMasterQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\ExpenseMasterQuery */
        $q = $this->useInQuery('ExpenseMaster', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(ExpenseListTableMap::COL_EXP_ID, $expenses->getExpId(), $comparison);
        } elseif ($expenses instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(ExpenseListTableMap::COL_EXP_ID, $expenses->toKeyValue('PrimaryKey', 'ExpId'), $comparison);

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
    public function joinExpenses(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
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
    public function useExpensesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
        ?string $joinType = Criteria::INNER_JOIN
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
     * Filter the query by a related \entities\ExpenseListDetails object
     *
     * @param \entities\ExpenseListDetails|ObjectCollection $expenseListDetails the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpenseListDetails($expenseListDetails, ?string $comparison = null)
    {
        if ($expenseListDetails instanceof \entities\ExpenseListDetails) {
            $this
                ->addUsingAlias(ExpenseListTableMap::COL_EXP_LIST_ID, $expenseListDetails->getExpListId(), $comparison);

            return $this;
        } elseif ($expenseListDetails instanceof ObjectCollection) {
            $this
                ->useExpenseListDetailsQuery()
                ->filterByPrimaryKeys($expenseListDetails->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByExpenseListDetails() only accepts arguments of type \entities\ExpenseListDetails or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ExpenseListDetails relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinExpenseListDetails(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ExpenseListDetails');

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
            $this->addJoinObject($join, 'ExpenseListDetails');
        }

        return $this;
    }

    /**
     * Use the ExpenseListDetails relation ExpenseListDetails object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\ExpenseListDetailsQuery A secondary query class using the current class as primary query
     */
    public function useExpenseListDetailsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinExpenseListDetails($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ExpenseListDetails', '\entities\ExpenseListDetailsQuery');
    }

    /**
     * Use the ExpenseListDetails relation ExpenseListDetails object
     *
     * @param callable(\entities\ExpenseListDetailsQuery):\entities\ExpenseListDetailsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withExpenseListDetailsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useExpenseListDetailsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to ExpenseListDetails table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\ExpenseListDetailsQuery The inner query object of the EXISTS statement
     */
    public function useExpenseListDetailsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\ExpenseListDetailsQuery */
        $q = $this->useExistsQuery('ExpenseListDetails', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to ExpenseListDetails table for a NOT EXISTS query.
     *
     * @see useExpenseListDetailsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\ExpenseListDetailsQuery The inner query object of the NOT EXISTS statement
     */
    public function useExpenseListDetailsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\ExpenseListDetailsQuery */
        $q = $this->useExistsQuery('ExpenseListDetails', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to ExpenseListDetails table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\ExpenseListDetailsQuery The inner query object of the IN statement
     */
    public function useInExpenseListDetailsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\ExpenseListDetailsQuery */
        $q = $this->useInQuery('ExpenseListDetails', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to ExpenseListDetails table for a NOT IN query.
     *
     * @see useExpenseListDetailsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\ExpenseListDetailsQuery The inner query object of the NOT IN statement
     */
    public function useNotInExpenseListDetailsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\ExpenseListDetailsQuery */
        $q = $this->useInQuery('ExpenseListDetails', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildExpenseList $expenseList Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($expenseList = null)
    {
        if ($expenseList) {
            $this->addUsingAlias(ExpenseListTableMap::COL_EXP_LIST_ID, $expenseList->getExpListId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the expense_list table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ExpenseListTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ExpenseListTableMap::clearInstancePool();
            ExpenseListTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ExpenseListTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ExpenseListTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ExpenseListTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ExpenseListTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
