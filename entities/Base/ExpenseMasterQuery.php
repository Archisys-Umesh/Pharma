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
use entities\ExpenseMaster as ChildExpenseMaster;
use entities\ExpenseMasterQuery as ChildExpenseMasterQuery;
use entities\Map\ExpenseMasterTableMap;

/**
 * Base class that represents a query for the `expense_master` table.
 *
 * @method     ChildExpenseMasterQuery orderByExpenseId($order = Criteria::ASC) Order by the expense_id column
 * @method     ChildExpenseMasterQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildExpenseMasterQuery orderByExpenseName($order = Criteria::ASC) Order by the expense_name column
 * @method     ChildExpenseMasterQuery orderByDefaultPolicykey($order = Criteria::ASC) Order by the default_policykey column
 * @method     ChildExpenseMasterQuery orderByCheckcity($order = Criteria::ASC) Order by the checkcity column
 * @method     ChildExpenseMasterQuery orderByPolicykeya($order = Criteria::ASC) Order by the policykeya column
 * @method     ChildExpenseMasterQuery orderByPolicykeyb($order = Criteria::ASC) Order by the policykeyb column
 * @method     ChildExpenseMasterQuery orderByPolicykeyc($order = Criteria::ASC) Order by the policykeyc column
 * @method     ChildExpenseMasterQuery orderByTrips($order = Criteria::ASC) Order by the trips column
 * @method     ChildExpenseMasterQuery orderByPermonth($order = Criteria::ASC) Order by the permonth column
 * @method     ChildExpenseMasterQuery orderByNonreimbursable($order = Criteria::ASC) Order by the nonreimbursable column
 * @method     ChildExpenseMasterQuery orderByIsdaily($order = Criteria::ASC) Order by the isdaily column
 * @method     ChildExpenseMasterQuery orderByIsrateapplied($order = Criteria::ASC) Order by the israteapplied column
 * @method     ChildExpenseMasterQuery orderByRate($order = Criteria::ASC) Order by the rate column
 * @method     ChildExpenseMasterQuery orderByMode($order = Criteria::ASC) Order by the mode column
 * @method     ChildExpenseMasterQuery orderByCommentreq($order = Criteria::ASC) Order by the commentreq column
 * @method     ChildExpenseMasterQuery orderByAdditionalText($order = Criteria::ASC) Order by the additional_text column
 * @method     ChildExpenseMasterQuery orderByIsPrefilled($order = Criteria::ASC) Order by the is_prefilled column
 * @method     ChildExpenseMasterQuery orderByIsMandatory($order = Criteria::ASC) Order by the is_mandatory column
 * @method     ChildExpenseMasterQuery orderByCanRepeat($order = Criteria::ASC) Order by the can_repeat column
 * @method     ChildExpenseMasterQuery orderByExpenseTempateName($order = Criteria::ASC) Order by the expense_tempate_name column
 * @method     ChildExpenseMasterQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildExpenseMasterQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildExpenseMasterQuery orderByIsEditable($order = Criteria::ASC) Order by the is_editable column
 * @method     ChildExpenseMasterQuery orderByAttachmentRequired($order = Criteria::ASC) Order by the attachment_required column
 * @method     ChildExpenseMasterQuery orderBySortOrder($order = Criteria::ASC) Order by the sort_order column
 *
 * @method     ChildExpenseMasterQuery groupByExpenseId() Group by the expense_id column
 * @method     ChildExpenseMasterQuery groupByCompanyId() Group by the company_id column
 * @method     ChildExpenseMasterQuery groupByExpenseName() Group by the expense_name column
 * @method     ChildExpenseMasterQuery groupByDefaultPolicykey() Group by the default_policykey column
 * @method     ChildExpenseMasterQuery groupByCheckcity() Group by the checkcity column
 * @method     ChildExpenseMasterQuery groupByPolicykeya() Group by the policykeya column
 * @method     ChildExpenseMasterQuery groupByPolicykeyb() Group by the policykeyb column
 * @method     ChildExpenseMasterQuery groupByPolicykeyc() Group by the policykeyc column
 * @method     ChildExpenseMasterQuery groupByTrips() Group by the trips column
 * @method     ChildExpenseMasterQuery groupByPermonth() Group by the permonth column
 * @method     ChildExpenseMasterQuery groupByNonreimbursable() Group by the nonreimbursable column
 * @method     ChildExpenseMasterQuery groupByIsdaily() Group by the isdaily column
 * @method     ChildExpenseMasterQuery groupByIsrateapplied() Group by the israteapplied column
 * @method     ChildExpenseMasterQuery groupByRate() Group by the rate column
 * @method     ChildExpenseMasterQuery groupByMode() Group by the mode column
 * @method     ChildExpenseMasterQuery groupByCommentreq() Group by the commentreq column
 * @method     ChildExpenseMasterQuery groupByAdditionalText() Group by the additional_text column
 * @method     ChildExpenseMasterQuery groupByIsPrefilled() Group by the is_prefilled column
 * @method     ChildExpenseMasterQuery groupByIsMandatory() Group by the is_mandatory column
 * @method     ChildExpenseMasterQuery groupByCanRepeat() Group by the can_repeat column
 * @method     ChildExpenseMasterQuery groupByExpenseTempateName() Group by the expense_tempate_name column
 * @method     ChildExpenseMasterQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildExpenseMasterQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildExpenseMasterQuery groupByIsEditable() Group by the is_editable column
 * @method     ChildExpenseMasterQuery groupByAttachmentRequired() Group by the attachment_required column
 * @method     ChildExpenseMasterQuery groupBySortOrder() Group by the sort_order column
 *
 * @method     ChildExpenseMasterQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildExpenseMasterQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildExpenseMasterQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildExpenseMasterQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildExpenseMasterQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildExpenseMasterQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildExpenseMasterQuery leftJoinCompanyRelatedByCompanyId($relationAlias = null) Adds a LEFT JOIN clause to the query using the CompanyRelatedByCompanyId relation
 * @method     ChildExpenseMasterQuery rightJoinCompanyRelatedByCompanyId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CompanyRelatedByCompanyId relation
 * @method     ChildExpenseMasterQuery innerJoinCompanyRelatedByCompanyId($relationAlias = null) Adds a INNER JOIN clause to the query using the CompanyRelatedByCompanyId relation
 *
 * @method     ChildExpenseMasterQuery joinWithCompanyRelatedByCompanyId($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the CompanyRelatedByCompanyId relation
 *
 * @method     ChildExpenseMasterQuery leftJoinWithCompanyRelatedByCompanyId() Adds a LEFT JOIN clause and with to the query using the CompanyRelatedByCompanyId relation
 * @method     ChildExpenseMasterQuery rightJoinWithCompanyRelatedByCompanyId() Adds a RIGHT JOIN clause and with to the query using the CompanyRelatedByCompanyId relation
 * @method     ChildExpenseMasterQuery innerJoinWithCompanyRelatedByCompanyId() Adds a INNER JOIN clause and with to the query using the CompanyRelatedByCompanyId relation
 *
 * @method     ChildExpenseMasterQuery leftJoinBudgetExp($relationAlias = null) Adds a LEFT JOIN clause to the query using the BudgetExp relation
 * @method     ChildExpenseMasterQuery rightJoinBudgetExp($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BudgetExp relation
 * @method     ChildExpenseMasterQuery innerJoinBudgetExp($relationAlias = null) Adds a INNER JOIN clause to the query using the BudgetExp relation
 *
 * @method     ChildExpenseMasterQuery joinWithBudgetExp($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BudgetExp relation
 *
 * @method     ChildExpenseMasterQuery leftJoinWithBudgetExp() Adds a LEFT JOIN clause and with to the query using the BudgetExp relation
 * @method     ChildExpenseMasterQuery rightJoinWithBudgetExp() Adds a RIGHT JOIN clause and with to the query using the BudgetExp relation
 * @method     ChildExpenseMasterQuery innerJoinWithBudgetExp() Adds a INNER JOIN clause and with to the query using the BudgetExp relation
 *
 * @method     ChildExpenseMasterQuery leftJoinCompanyRelatedByAutoCalculatedTa($relationAlias = null) Adds a LEFT JOIN clause to the query using the CompanyRelatedByAutoCalculatedTa relation
 * @method     ChildExpenseMasterQuery rightJoinCompanyRelatedByAutoCalculatedTa($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CompanyRelatedByAutoCalculatedTa relation
 * @method     ChildExpenseMasterQuery innerJoinCompanyRelatedByAutoCalculatedTa($relationAlias = null) Adds a INNER JOIN clause to the query using the CompanyRelatedByAutoCalculatedTa relation
 *
 * @method     ChildExpenseMasterQuery joinWithCompanyRelatedByAutoCalculatedTa($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the CompanyRelatedByAutoCalculatedTa relation
 *
 * @method     ChildExpenseMasterQuery leftJoinWithCompanyRelatedByAutoCalculatedTa() Adds a LEFT JOIN clause and with to the query using the CompanyRelatedByAutoCalculatedTa relation
 * @method     ChildExpenseMasterQuery rightJoinWithCompanyRelatedByAutoCalculatedTa() Adds a RIGHT JOIN clause and with to the query using the CompanyRelatedByAutoCalculatedTa relation
 * @method     ChildExpenseMasterQuery innerJoinWithCompanyRelatedByAutoCalculatedTa() Adds a INNER JOIN clause and with to the query using the CompanyRelatedByAutoCalculatedTa relation
 *
 * @method     ChildExpenseMasterQuery leftJoinExpenseList($relationAlias = null) Adds a LEFT JOIN clause to the query using the ExpenseList relation
 * @method     ChildExpenseMasterQuery rightJoinExpenseList($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ExpenseList relation
 * @method     ChildExpenseMasterQuery innerJoinExpenseList($relationAlias = null) Adds a INNER JOIN clause to the query using the ExpenseList relation
 *
 * @method     ChildExpenseMasterQuery joinWithExpenseList($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ExpenseList relation
 *
 * @method     ChildExpenseMasterQuery leftJoinWithExpenseList() Adds a LEFT JOIN clause and with to the query using the ExpenseList relation
 * @method     ChildExpenseMasterQuery rightJoinWithExpenseList() Adds a RIGHT JOIN clause and with to the query using the ExpenseList relation
 * @method     ChildExpenseMasterQuery innerJoinWithExpenseList() Adds a INNER JOIN clause and with to the query using the ExpenseList relation
 *
 * @method     ChildExpenseMasterQuery leftJoinExpenseRepellent($relationAlias = null) Adds a LEFT JOIN clause to the query using the ExpenseRepellent relation
 * @method     ChildExpenseMasterQuery rightJoinExpenseRepellent($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ExpenseRepellent relation
 * @method     ChildExpenseMasterQuery innerJoinExpenseRepellent($relationAlias = null) Adds a INNER JOIN clause to the query using the ExpenseRepellent relation
 *
 * @method     ChildExpenseMasterQuery joinWithExpenseRepellent($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ExpenseRepellent relation
 *
 * @method     ChildExpenseMasterQuery leftJoinWithExpenseRepellent() Adds a LEFT JOIN clause and with to the query using the ExpenseRepellent relation
 * @method     ChildExpenseMasterQuery rightJoinWithExpenseRepellent() Adds a RIGHT JOIN clause and with to the query using the ExpenseRepellent relation
 * @method     ChildExpenseMasterQuery innerJoinWithExpenseRepellent() Adds a INNER JOIN clause and with to the query using the ExpenseRepellent relation
 *
 * @method     \entities\CompanyQuery|\entities\BudgetExpQuery|\entities\CompanyQuery|\entities\ExpenseListQuery|\entities\ExpenseRepellentQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildExpenseMaster|null findOne(?ConnectionInterface $con = null) Return the first ChildExpenseMaster matching the query
 * @method     ChildExpenseMaster findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildExpenseMaster matching the query, or a new ChildExpenseMaster object populated from the query conditions when no match is found
 *
 * @method     ChildExpenseMaster|null findOneByExpenseId(int $expense_id) Return the first ChildExpenseMaster filtered by the expense_id column
 * @method     ChildExpenseMaster|null findOneByCompanyId(int $company_id) Return the first ChildExpenseMaster filtered by the company_id column
 * @method     ChildExpenseMaster|null findOneByExpenseName(string $expense_name) Return the first ChildExpenseMaster filtered by the expense_name column
 * @method     ChildExpenseMaster|null findOneByDefaultPolicykey(string $default_policykey) Return the first ChildExpenseMaster filtered by the default_policykey column
 * @method     ChildExpenseMaster|null findOneByCheckcity(int $checkcity) Return the first ChildExpenseMaster filtered by the checkcity column
 * @method     ChildExpenseMaster|null findOneByPolicykeya(string $policykeya) Return the first ChildExpenseMaster filtered by the policykeya column
 * @method     ChildExpenseMaster|null findOneByPolicykeyb(string $policykeyb) Return the first ChildExpenseMaster filtered by the policykeyb column
 * @method     ChildExpenseMaster|null findOneByPolicykeyc(string $policykeyc) Return the first ChildExpenseMaster filtered by the policykeyc column
 * @method     ChildExpenseMaster|null findOneByTrips(int $trips) Return the first ChildExpenseMaster filtered by the trips column
 * @method     ChildExpenseMaster|null findOneByPermonth(int $permonth) Return the first ChildExpenseMaster filtered by the permonth column
 * @method     ChildExpenseMaster|null findOneByNonreimbursable(int $nonreimbursable) Return the first ChildExpenseMaster filtered by the nonreimbursable column
 * @method     ChildExpenseMaster|null findOneByIsdaily(int $isdaily) Return the first ChildExpenseMaster filtered by the isdaily column
 * @method     ChildExpenseMaster|null findOneByIsrateapplied(int $israteapplied) Return the first ChildExpenseMaster filtered by the israteapplied column
 * @method     ChildExpenseMaster|null findOneByRate(string $rate) Return the first ChildExpenseMaster filtered by the rate column
 * @method     ChildExpenseMaster|null findOneByMode(string $mode) Return the first ChildExpenseMaster filtered by the mode column
 * @method     ChildExpenseMaster|null findOneByCommentreq(int $commentreq) Return the first ChildExpenseMaster filtered by the commentreq column
 * @method     ChildExpenseMaster|null findOneByAdditionalText(int $additional_text) Return the first ChildExpenseMaster filtered by the additional_text column
 * @method     ChildExpenseMaster|null findOneByIsPrefilled(int $is_prefilled) Return the first ChildExpenseMaster filtered by the is_prefilled column
 * @method     ChildExpenseMaster|null findOneByIsMandatory(int $is_mandatory) Return the first ChildExpenseMaster filtered by the is_mandatory column
 * @method     ChildExpenseMaster|null findOneByCanRepeat(int $can_repeat) Return the first ChildExpenseMaster filtered by the can_repeat column
 * @method     ChildExpenseMaster|null findOneByExpenseTempateName(string $expense_tempate_name) Return the first ChildExpenseMaster filtered by the expense_tempate_name column
 * @method     ChildExpenseMaster|null findOneByCreatedAt(string $created_at) Return the first ChildExpenseMaster filtered by the created_at column
 * @method     ChildExpenseMaster|null findOneByUpdatedAt(string $updated_at) Return the first ChildExpenseMaster filtered by the updated_at column
 * @method     ChildExpenseMaster|null findOneByIsEditable(boolean $is_editable) Return the first ChildExpenseMaster filtered by the is_editable column
 * @method     ChildExpenseMaster|null findOneByAttachmentRequired(boolean $attachment_required) Return the first ChildExpenseMaster filtered by the attachment_required column
 * @method     ChildExpenseMaster|null findOneBySortOrder(int $sort_order) Return the first ChildExpenseMaster filtered by the sort_order column
 *
 * @method     ChildExpenseMaster requirePk($key, ?ConnectionInterface $con = null) Return the ChildExpenseMaster by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseMaster requireOne(?ConnectionInterface $con = null) Return the first ChildExpenseMaster matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildExpenseMaster requireOneByExpenseId(int $expense_id) Return the first ChildExpenseMaster filtered by the expense_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseMaster requireOneByCompanyId(int $company_id) Return the first ChildExpenseMaster filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseMaster requireOneByExpenseName(string $expense_name) Return the first ChildExpenseMaster filtered by the expense_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseMaster requireOneByDefaultPolicykey(string $default_policykey) Return the first ChildExpenseMaster filtered by the default_policykey column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseMaster requireOneByCheckcity(int $checkcity) Return the first ChildExpenseMaster filtered by the checkcity column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseMaster requireOneByPolicykeya(string $policykeya) Return the first ChildExpenseMaster filtered by the policykeya column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseMaster requireOneByPolicykeyb(string $policykeyb) Return the first ChildExpenseMaster filtered by the policykeyb column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseMaster requireOneByPolicykeyc(string $policykeyc) Return the first ChildExpenseMaster filtered by the policykeyc column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseMaster requireOneByTrips(int $trips) Return the first ChildExpenseMaster filtered by the trips column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseMaster requireOneByPermonth(int $permonth) Return the first ChildExpenseMaster filtered by the permonth column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseMaster requireOneByNonreimbursable(int $nonreimbursable) Return the first ChildExpenseMaster filtered by the nonreimbursable column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseMaster requireOneByIsdaily(int $isdaily) Return the first ChildExpenseMaster filtered by the isdaily column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseMaster requireOneByIsrateapplied(int $israteapplied) Return the first ChildExpenseMaster filtered by the israteapplied column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseMaster requireOneByRate(string $rate) Return the first ChildExpenseMaster filtered by the rate column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseMaster requireOneByMode(string $mode) Return the first ChildExpenseMaster filtered by the mode column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseMaster requireOneByCommentreq(int $commentreq) Return the first ChildExpenseMaster filtered by the commentreq column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseMaster requireOneByAdditionalText(int $additional_text) Return the first ChildExpenseMaster filtered by the additional_text column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseMaster requireOneByIsPrefilled(int $is_prefilled) Return the first ChildExpenseMaster filtered by the is_prefilled column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseMaster requireOneByIsMandatory(int $is_mandatory) Return the first ChildExpenseMaster filtered by the is_mandatory column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseMaster requireOneByCanRepeat(int $can_repeat) Return the first ChildExpenseMaster filtered by the can_repeat column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseMaster requireOneByExpenseTempateName(string $expense_tempate_name) Return the first ChildExpenseMaster filtered by the expense_tempate_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseMaster requireOneByCreatedAt(string $created_at) Return the first ChildExpenseMaster filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseMaster requireOneByUpdatedAt(string $updated_at) Return the first ChildExpenseMaster filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseMaster requireOneByIsEditable(boolean $is_editable) Return the first ChildExpenseMaster filtered by the is_editable column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseMaster requireOneByAttachmentRequired(boolean $attachment_required) Return the first ChildExpenseMaster filtered by the attachment_required column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseMaster requireOneBySortOrder(int $sort_order) Return the first ChildExpenseMaster filtered by the sort_order column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildExpenseMaster[]|Collection find(?ConnectionInterface $con = null) Return ChildExpenseMaster objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildExpenseMaster> find(?ConnectionInterface $con = null) Return ChildExpenseMaster objects based on current ModelCriteria
 *
 * @method     ChildExpenseMaster[]|Collection findByExpenseId(int|array<int> $expense_id) Return ChildExpenseMaster objects filtered by the expense_id column
 * @psalm-method Collection&\Traversable<ChildExpenseMaster> findByExpenseId(int|array<int> $expense_id) Return ChildExpenseMaster objects filtered by the expense_id column
 * @method     ChildExpenseMaster[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildExpenseMaster objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildExpenseMaster> findByCompanyId(int|array<int> $company_id) Return ChildExpenseMaster objects filtered by the company_id column
 * @method     ChildExpenseMaster[]|Collection findByExpenseName(string|array<string> $expense_name) Return ChildExpenseMaster objects filtered by the expense_name column
 * @psalm-method Collection&\Traversable<ChildExpenseMaster> findByExpenseName(string|array<string> $expense_name) Return ChildExpenseMaster objects filtered by the expense_name column
 * @method     ChildExpenseMaster[]|Collection findByDefaultPolicykey(string|array<string> $default_policykey) Return ChildExpenseMaster objects filtered by the default_policykey column
 * @psalm-method Collection&\Traversable<ChildExpenseMaster> findByDefaultPolicykey(string|array<string> $default_policykey) Return ChildExpenseMaster objects filtered by the default_policykey column
 * @method     ChildExpenseMaster[]|Collection findByCheckcity(int|array<int> $checkcity) Return ChildExpenseMaster objects filtered by the checkcity column
 * @psalm-method Collection&\Traversable<ChildExpenseMaster> findByCheckcity(int|array<int> $checkcity) Return ChildExpenseMaster objects filtered by the checkcity column
 * @method     ChildExpenseMaster[]|Collection findByPolicykeya(string|array<string> $policykeya) Return ChildExpenseMaster objects filtered by the policykeya column
 * @psalm-method Collection&\Traversable<ChildExpenseMaster> findByPolicykeya(string|array<string> $policykeya) Return ChildExpenseMaster objects filtered by the policykeya column
 * @method     ChildExpenseMaster[]|Collection findByPolicykeyb(string|array<string> $policykeyb) Return ChildExpenseMaster objects filtered by the policykeyb column
 * @psalm-method Collection&\Traversable<ChildExpenseMaster> findByPolicykeyb(string|array<string> $policykeyb) Return ChildExpenseMaster objects filtered by the policykeyb column
 * @method     ChildExpenseMaster[]|Collection findByPolicykeyc(string|array<string> $policykeyc) Return ChildExpenseMaster objects filtered by the policykeyc column
 * @psalm-method Collection&\Traversable<ChildExpenseMaster> findByPolicykeyc(string|array<string> $policykeyc) Return ChildExpenseMaster objects filtered by the policykeyc column
 * @method     ChildExpenseMaster[]|Collection findByTrips(int|array<int> $trips) Return ChildExpenseMaster objects filtered by the trips column
 * @psalm-method Collection&\Traversable<ChildExpenseMaster> findByTrips(int|array<int> $trips) Return ChildExpenseMaster objects filtered by the trips column
 * @method     ChildExpenseMaster[]|Collection findByPermonth(int|array<int> $permonth) Return ChildExpenseMaster objects filtered by the permonth column
 * @psalm-method Collection&\Traversable<ChildExpenseMaster> findByPermonth(int|array<int> $permonth) Return ChildExpenseMaster objects filtered by the permonth column
 * @method     ChildExpenseMaster[]|Collection findByNonreimbursable(int|array<int> $nonreimbursable) Return ChildExpenseMaster objects filtered by the nonreimbursable column
 * @psalm-method Collection&\Traversable<ChildExpenseMaster> findByNonreimbursable(int|array<int> $nonreimbursable) Return ChildExpenseMaster objects filtered by the nonreimbursable column
 * @method     ChildExpenseMaster[]|Collection findByIsdaily(int|array<int> $isdaily) Return ChildExpenseMaster objects filtered by the isdaily column
 * @psalm-method Collection&\Traversable<ChildExpenseMaster> findByIsdaily(int|array<int> $isdaily) Return ChildExpenseMaster objects filtered by the isdaily column
 * @method     ChildExpenseMaster[]|Collection findByIsrateapplied(int|array<int> $israteapplied) Return ChildExpenseMaster objects filtered by the israteapplied column
 * @psalm-method Collection&\Traversable<ChildExpenseMaster> findByIsrateapplied(int|array<int> $israteapplied) Return ChildExpenseMaster objects filtered by the israteapplied column
 * @method     ChildExpenseMaster[]|Collection findByRate(string|array<string> $rate) Return ChildExpenseMaster objects filtered by the rate column
 * @psalm-method Collection&\Traversable<ChildExpenseMaster> findByRate(string|array<string> $rate) Return ChildExpenseMaster objects filtered by the rate column
 * @method     ChildExpenseMaster[]|Collection findByMode(string|array<string> $mode) Return ChildExpenseMaster objects filtered by the mode column
 * @psalm-method Collection&\Traversable<ChildExpenseMaster> findByMode(string|array<string> $mode) Return ChildExpenseMaster objects filtered by the mode column
 * @method     ChildExpenseMaster[]|Collection findByCommentreq(int|array<int> $commentreq) Return ChildExpenseMaster objects filtered by the commentreq column
 * @psalm-method Collection&\Traversable<ChildExpenseMaster> findByCommentreq(int|array<int> $commentreq) Return ChildExpenseMaster objects filtered by the commentreq column
 * @method     ChildExpenseMaster[]|Collection findByAdditionalText(int|array<int> $additional_text) Return ChildExpenseMaster objects filtered by the additional_text column
 * @psalm-method Collection&\Traversable<ChildExpenseMaster> findByAdditionalText(int|array<int> $additional_text) Return ChildExpenseMaster objects filtered by the additional_text column
 * @method     ChildExpenseMaster[]|Collection findByIsPrefilled(int|array<int> $is_prefilled) Return ChildExpenseMaster objects filtered by the is_prefilled column
 * @psalm-method Collection&\Traversable<ChildExpenseMaster> findByIsPrefilled(int|array<int> $is_prefilled) Return ChildExpenseMaster objects filtered by the is_prefilled column
 * @method     ChildExpenseMaster[]|Collection findByIsMandatory(int|array<int> $is_mandatory) Return ChildExpenseMaster objects filtered by the is_mandatory column
 * @psalm-method Collection&\Traversable<ChildExpenseMaster> findByIsMandatory(int|array<int> $is_mandatory) Return ChildExpenseMaster objects filtered by the is_mandatory column
 * @method     ChildExpenseMaster[]|Collection findByCanRepeat(int|array<int> $can_repeat) Return ChildExpenseMaster objects filtered by the can_repeat column
 * @psalm-method Collection&\Traversable<ChildExpenseMaster> findByCanRepeat(int|array<int> $can_repeat) Return ChildExpenseMaster objects filtered by the can_repeat column
 * @method     ChildExpenseMaster[]|Collection findByExpenseTempateName(string|array<string> $expense_tempate_name) Return ChildExpenseMaster objects filtered by the expense_tempate_name column
 * @psalm-method Collection&\Traversable<ChildExpenseMaster> findByExpenseTempateName(string|array<string> $expense_tempate_name) Return ChildExpenseMaster objects filtered by the expense_tempate_name column
 * @method     ChildExpenseMaster[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildExpenseMaster objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildExpenseMaster> findByCreatedAt(string|array<string> $created_at) Return ChildExpenseMaster objects filtered by the created_at column
 * @method     ChildExpenseMaster[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildExpenseMaster objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildExpenseMaster> findByUpdatedAt(string|array<string> $updated_at) Return ChildExpenseMaster objects filtered by the updated_at column
 * @method     ChildExpenseMaster[]|Collection findByIsEditable(boolean|array<boolean> $is_editable) Return ChildExpenseMaster objects filtered by the is_editable column
 * @psalm-method Collection&\Traversable<ChildExpenseMaster> findByIsEditable(boolean|array<boolean> $is_editable) Return ChildExpenseMaster objects filtered by the is_editable column
 * @method     ChildExpenseMaster[]|Collection findByAttachmentRequired(boolean|array<boolean> $attachment_required) Return ChildExpenseMaster objects filtered by the attachment_required column
 * @psalm-method Collection&\Traversable<ChildExpenseMaster> findByAttachmentRequired(boolean|array<boolean> $attachment_required) Return ChildExpenseMaster objects filtered by the attachment_required column
 * @method     ChildExpenseMaster[]|Collection findBySortOrder(int|array<int> $sort_order) Return ChildExpenseMaster objects filtered by the sort_order column
 * @psalm-method Collection&\Traversable<ChildExpenseMaster> findBySortOrder(int|array<int> $sort_order) Return ChildExpenseMaster objects filtered by the sort_order column
 *
 * @method     ChildExpenseMaster[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildExpenseMaster> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class ExpenseMasterQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\ExpenseMasterQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\ExpenseMaster', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildExpenseMasterQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildExpenseMasterQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildExpenseMasterQuery) {
            return $criteria;
        }
        $query = new ChildExpenseMasterQuery();
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
     * @return ChildExpenseMaster|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ExpenseMasterTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ExpenseMasterTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildExpenseMaster A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT expense_id, company_id, expense_name, default_policykey, checkcity, policykeya, policykeyb, policykeyc, trips, permonth, nonreimbursable, isdaily, israteapplied, rate, mode, commentreq, additional_text, is_prefilled, is_mandatory, can_repeat, expense_tempate_name, created_at, updated_at, is_editable, attachment_required, sort_order FROM expense_master WHERE expense_id = :p0';
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
            /** @var ChildExpenseMaster $obj */
            $obj = new ChildExpenseMaster();
            $obj->hydrate($row);
            ExpenseMasterTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildExpenseMaster|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(ExpenseMasterTableMap::COL_EXPENSE_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(ExpenseMasterTableMap::COL_EXPENSE_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(ExpenseMasterTableMap::COL_EXPENSE_ID, $expenseId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($expenseId['max'])) {
                $this->addUsingAlias(ExpenseMasterTableMap::COL_EXPENSE_ID, $expenseId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpenseMasterTableMap::COL_EXPENSE_ID, $expenseId, $comparison);

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
     * @see       filterByCompanyRelatedByCompanyId()
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
                $this->addUsingAlias(ExpenseMasterTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(ExpenseMasterTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpenseMasterTableMap::COL_COMPANY_ID, $companyId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the expense_name column
     *
     * Example usage:
     * <code>
     * $query->filterByExpenseName('fooValue');   // WHERE expense_name = 'fooValue'
     * $query->filterByExpenseName('%fooValue%', Criteria::LIKE); // WHERE expense_name LIKE '%fooValue%'
     * $query->filterByExpenseName(['foo', 'bar']); // WHERE expense_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $expenseName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpenseName($expenseName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($expenseName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpenseMasterTableMap::COL_EXPENSE_NAME, $expenseName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the default_policykey column
     *
     * Example usage:
     * <code>
     * $query->filterByDefaultPolicykey('fooValue');   // WHERE default_policykey = 'fooValue'
     * $query->filterByDefaultPolicykey('%fooValue%', Criteria::LIKE); // WHERE default_policykey LIKE '%fooValue%'
     * $query->filterByDefaultPolicykey(['foo', 'bar']); // WHERE default_policykey IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $defaultPolicykey The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDefaultPolicykey($defaultPolicykey = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($defaultPolicykey)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpenseMasterTableMap::COL_DEFAULT_POLICYKEY, $defaultPolicykey, $comparison);

        return $this;
    }

    /**
     * Filter the query on the checkcity column
     *
     * Example usage:
     * <code>
     * $query->filterByCheckcity(1234); // WHERE checkcity = 1234
     * $query->filterByCheckcity(array(12, 34)); // WHERE checkcity IN (12, 34)
     * $query->filterByCheckcity(array('min' => 12)); // WHERE checkcity > 12
     * </code>
     *
     * @param mixed $checkcity The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCheckcity($checkcity = null, ?string $comparison = null)
    {
        if (is_array($checkcity)) {
            $useMinMax = false;
            if (isset($checkcity['min'])) {
                $this->addUsingAlias(ExpenseMasterTableMap::COL_CHECKCITY, $checkcity['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($checkcity['max'])) {
                $this->addUsingAlias(ExpenseMasterTableMap::COL_CHECKCITY, $checkcity['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpenseMasterTableMap::COL_CHECKCITY, $checkcity, $comparison);

        return $this;
    }

    /**
     * Filter the query on the policykeya column
     *
     * Example usage:
     * <code>
     * $query->filterByPolicykeya('fooValue');   // WHERE policykeya = 'fooValue'
     * $query->filterByPolicykeya('%fooValue%', Criteria::LIKE); // WHERE policykeya LIKE '%fooValue%'
     * $query->filterByPolicykeya(['foo', 'bar']); // WHERE policykeya IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $policykeya The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPolicykeya($policykeya = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($policykeya)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpenseMasterTableMap::COL_POLICYKEYA, $policykeya, $comparison);

        return $this;
    }

    /**
     * Filter the query on the policykeyb column
     *
     * Example usage:
     * <code>
     * $query->filterByPolicykeyb('fooValue');   // WHERE policykeyb = 'fooValue'
     * $query->filterByPolicykeyb('%fooValue%', Criteria::LIKE); // WHERE policykeyb LIKE '%fooValue%'
     * $query->filterByPolicykeyb(['foo', 'bar']); // WHERE policykeyb IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $policykeyb The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPolicykeyb($policykeyb = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($policykeyb)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpenseMasterTableMap::COL_POLICYKEYB, $policykeyb, $comparison);

        return $this;
    }

    /**
     * Filter the query on the policykeyc column
     *
     * Example usage:
     * <code>
     * $query->filterByPolicykeyc('fooValue');   // WHERE policykeyc = 'fooValue'
     * $query->filterByPolicykeyc('%fooValue%', Criteria::LIKE); // WHERE policykeyc LIKE '%fooValue%'
     * $query->filterByPolicykeyc(['foo', 'bar']); // WHERE policykeyc IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $policykeyc The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPolicykeyc($policykeyc = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($policykeyc)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpenseMasterTableMap::COL_POLICYKEYC, $policykeyc, $comparison);

        return $this;
    }

    /**
     * Filter the query on the trips column
     *
     * Example usage:
     * <code>
     * $query->filterByTrips(1234); // WHERE trips = 1234
     * $query->filterByTrips(array(12, 34)); // WHERE trips IN (12, 34)
     * $query->filterByTrips(array('min' => 12)); // WHERE trips > 12
     * </code>
     *
     * @param mixed $trips The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTrips($trips = null, ?string $comparison = null)
    {
        if (is_array($trips)) {
            $useMinMax = false;
            if (isset($trips['min'])) {
                $this->addUsingAlias(ExpenseMasterTableMap::COL_TRIPS, $trips['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($trips['max'])) {
                $this->addUsingAlias(ExpenseMasterTableMap::COL_TRIPS, $trips['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpenseMasterTableMap::COL_TRIPS, $trips, $comparison);

        return $this;
    }

    /**
     * Filter the query on the permonth column
     *
     * Example usage:
     * <code>
     * $query->filterByPermonth(1234); // WHERE permonth = 1234
     * $query->filterByPermonth(array(12, 34)); // WHERE permonth IN (12, 34)
     * $query->filterByPermonth(array('min' => 12)); // WHERE permonth > 12
     * </code>
     *
     * @param mixed $permonth The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPermonth($permonth = null, ?string $comparison = null)
    {
        if (is_array($permonth)) {
            $useMinMax = false;
            if (isset($permonth['min'])) {
                $this->addUsingAlias(ExpenseMasterTableMap::COL_PERMONTH, $permonth['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($permonth['max'])) {
                $this->addUsingAlias(ExpenseMasterTableMap::COL_PERMONTH, $permonth['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpenseMasterTableMap::COL_PERMONTH, $permonth, $comparison);

        return $this;
    }

    /**
     * Filter the query on the nonreimbursable column
     *
     * Example usage:
     * <code>
     * $query->filterByNonreimbursable(1234); // WHERE nonreimbursable = 1234
     * $query->filterByNonreimbursable(array(12, 34)); // WHERE nonreimbursable IN (12, 34)
     * $query->filterByNonreimbursable(array('min' => 12)); // WHERE nonreimbursable > 12
     * </code>
     *
     * @param mixed $nonreimbursable The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByNonreimbursable($nonreimbursable = null, ?string $comparison = null)
    {
        if (is_array($nonreimbursable)) {
            $useMinMax = false;
            if (isset($nonreimbursable['min'])) {
                $this->addUsingAlias(ExpenseMasterTableMap::COL_NONREIMBURSABLE, $nonreimbursable['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($nonreimbursable['max'])) {
                $this->addUsingAlias(ExpenseMasterTableMap::COL_NONREIMBURSABLE, $nonreimbursable['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpenseMasterTableMap::COL_NONREIMBURSABLE, $nonreimbursable, $comparison);

        return $this;
    }

    /**
     * Filter the query on the isdaily column
     *
     * Example usage:
     * <code>
     * $query->filterByIsdaily(1234); // WHERE isdaily = 1234
     * $query->filterByIsdaily(array(12, 34)); // WHERE isdaily IN (12, 34)
     * $query->filterByIsdaily(array('min' => 12)); // WHERE isdaily > 12
     * </code>
     *
     * @param mixed $isdaily The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIsdaily($isdaily = null, ?string $comparison = null)
    {
        if (is_array($isdaily)) {
            $useMinMax = false;
            if (isset($isdaily['min'])) {
                $this->addUsingAlias(ExpenseMasterTableMap::COL_ISDAILY, $isdaily['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($isdaily['max'])) {
                $this->addUsingAlias(ExpenseMasterTableMap::COL_ISDAILY, $isdaily['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpenseMasterTableMap::COL_ISDAILY, $isdaily, $comparison);

        return $this;
    }

    /**
     * Filter the query on the israteapplied column
     *
     * Example usage:
     * <code>
     * $query->filterByIsrateapplied(1234); // WHERE israteapplied = 1234
     * $query->filterByIsrateapplied(array(12, 34)); // WHERE israteapplied IN (12, 34)
     * $query->filterByIsrateapplied(array('min' => 12)); // WHERE israteapplied > 12
     * </code>
     *
     * @param mixed $israteapplied The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIsrateapplied($israteapplied = null, ?string $comparison = null)
    {
        if (is_array($israteapplied)) {
            $useMinMax = false;
            if (isset($israteapplied['min'])) {
                $this->addUsingAlias(ExpenseMasterTableMap::COL_ISRATEAPPLIED, $israteapplied['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($israteapplied['max'])) {
                $this->addUsingAlias(ExpenseMasterTableMap::COL_ISRATEAPPLIED, $israteapplied['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpenseMasterTableMap::COL_ISRATEAPPLIED, $israteapplied, $comparison);

        return $this;
    }

    /**
     * Filter the query on the rate column
     *
     * Example usage:
     * <code>
     * $query->filterByRate('fooValue');   // WHERE rate = 'fooValue'
     * $query->filterByRate('%fooValue%', Criteria::LIKE); // WHERE rate LIKE '%fooValue%'
     * $query->filterByRate(['foo', 'bar']); // WHERE rate IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $rate The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRate($rate = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($rate)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpenseMasterTableMap::COL_RATE, $rate, $comparison);

        return $this;
    }

    /**
     * Filter the query on the mode column
     *
     * Example usage:
     * <code>
     * $query->filterByMode('fooValue');   // WHERE mode = 'fooValue'
     * $query->filterByMode('%fooValue%', Criteria::LIKE); // WHERE mode LIKE '%fooValue%'
     * $query->filterByMode(['foo', 'bar']); // WHERE mode IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $mode The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMode($mode = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($mode)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpenseMasterTableMap::COL_MODE, $mode, $comparison);

        return $this;
    }

    /**
     * Filter the query on the commentreq column
     *
     * Example usage:
     * <code>
     * $query->filterByCommentreq(1234); // WHERE commentreq = 1234
     * $query->filterByCommentreq(array(12, 34)); // WHERE commentreq IN (12, 34)
     * $query->filterByCommentreq(array('min' => 12)); // WHERE commentreq > 12
     * </code>
     *
     * @param mixed $commentreq The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCommentreq($commentreq = null, ?string $comparison = null)
    {
        if (is_array($commentreq)) {
            $useMinMax = false;
            if (isset($commentreq['min'])) {
                $this->addUsingAlias(ExpenseMasterTableMap::COL_COMMENTREQ, $commentreq['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($commentreq['max'])) {
                $this->addUsingAlias(ExpenseMasterTableMap::COL_COMMENTREQ, $commentreq['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpenseMasterTableMap::COL_COMMENTREQ, $commentreq, $comparison);

        return $this;
    }

    /**
     * Filter the query on the additional_text column
     *
     * Example usage:
     * <code>
     * $query->filterByAdditionalText(1234); // WHERE additional_text = 1234
     * $query->filterByAdditionalText(array(12, 34)); // WHERE additional_text IN (12, 34)
     * $query->filterByAdditionalText(array('min' => 12)); // WHERE additional_text > 12
     * </code>
     *
     * @param mixed $additionalText The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAdditionalText($additionalText = null, ?string $comparison = null)
    {
        if (is_array($additionalText)) {
            $useMinMax = false;
            if (isset($additionalText['min'])) {
                $this->addUsingAlias(ExpenseMasterTableMap::COL_ADDITIONAL_TEXT, $additionalText['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($additionalText['max'])) {
                $this->addUsingAlias(ExpenseMasterTableMap::COL_ADDITIONAL_TEXT, $additionalText['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpenseMasterTableMap::COL_ADDITIONAL_TEXT, $additionalText, $comparison);

        return $this;
    }

    /**
     * Filter the query on the is_prefilled column
     *
     * Example usage:
     * <code>
     * $query->filterByIsPrefilled(1234); // WHERE is_prefilled = 1234
     * $query->filterByIsPrefilled(array(12, 34)); // WHERE is_prefilled IN (12, 34)
     * $query->filterByIsPrefilled(array('min' => 12)); // WHERE is_prefilled > 12
     * </code>
     *
     * @param mixed $isPrefilled The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIsPrefilled($isPrefilled = null, ?string $comparison = null)
    {
        if (is_array($isPrefilled)) {
            $useMinMax = false;
            if (isset($isPrefilled['min'])) {
                $this->addUsingAlias(ExpenseMasterTableMap::COL_IS_PREFILLED, $isPrefilled['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($isPrefilled['max'])) {
                $this->addUsingAlias(ExpenseMasterTableMap::COL_IS_PREFILLED, $isPrefilled['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpenseMasterTableMap::COL_IS_PREFILLED, $isPrefilled, $comparison);

        return $this;
    }

    /**
     * Filter the query on the is_mandatory column
     *
     * Example usage:
     * <code>
     * $query->filterByIsMandatory(1234); // WHERE is_mandatory = 1234
     * $query->filterByIsMandatory(array(12, 34)); // WHERE is_mandatory IN (12, 34)
     * $query->filterByIsMandatory(array('min' => 12)); // WHERE is_mandatory > 12
     * </code>
     *
     * @param mixed $isMandatory The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIsMandatory($isMandatory = null, ?string $comparison = null)
    {
        if (is_array($isMandatory)) {
            $useMinMax = false;
            if (isset($isMandatory['min'])) {
                $this->addUsingAlias(ExpenseMasterTableMap::COL_IS_MANDATORY, $isMandatory['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($isMandatory['max'])) {
                $this->addUsingAlias(ExpenseMasterTableMap::COL_IS_MANDATORY, $isMandatory['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpenseMasterTableMap::COL_IS_MANDATORY, $isMandatory, $comparison);

        return $this;
    }

    /**
     * Filter the query on the can_repeat column
     *
     * Example usage:
     * <code>
     * $query->filterByCanRepeat(1234); // WHERE can_repeat = 1234
     * $query->filterByCanRepeat(array(12, 34)); // WHERE can_repeat IN (12, 34)
     * $query->filterByCanRepeat(array('min' => 12)); // WHERE can_repeat > 12
     * </code>
     *
     * @param mixed $canRepeat The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCanRepeat($canRepeat = null, ?string $comparison = null)
    {
        if (is_array($canRepeat)) {
            $useMinMax = false;
            if (isset($canRepeat['min'])) {
                $this->addUsingAlias(ExpenseMasterTableMap::COL_CAN_REPEAT, $canRepeat['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($canRepeat['max'])) {
                $this->addUsingAlias(ExpenseMasterTableMap::COL_CAN_REPEAT, $canRepeat['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpenseMasterTableMap::COL_CAN_REPEAT, $canRepeat, $comparison);

        return $this;
    }

    /**
     * Filter the query on the expense_tempate_name column
     *
     * Example usage:
     * <code>
     * $query->filterByExpenseTempateName('fooValue');   // WHERE expense_tempate_name = 'fooValue'
     * $query->filterByExpenseTempateName('%fooValue%', Criteria::LIKE); // WHERE expense_tempate_name LIKE '%fooValue%'
     * $query->filterByExpenseTempateName(['foo', 'bar']); // WHERE expense_tempate_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $expenseTempateName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpenseTempateName($expenseTempateName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($expenseTempateName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpenseMasterTableMap::COL_EXPENSE_TEMPATE_NAME, $expenseTempateName, $comparison);

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
                $this->addUsingAlias(ExpenseMasterTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(ExpenseMasterTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpenseMasterTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(ExpenseMasterTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(ExpenseMasterTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpenseMasterTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the is_editable column
     *
     * Example usage:
     * <code>
     * $query->filterByIsEditable(true); // WHERE is_editable = true
     * $query->filterByIsEditable('yes'); // WHERE is_editable = true
     * </code>
     *
     * @param bool|string $isEditable The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIsEditable($isEditable = null, ?string $comparison = null)
    {
        if (is_string($isEditable)) {
            $isEditable = in_array(strtolower($isEditable), array('false', 'off', '-', 'no', 'n', '0', ''), true) ? false : true;
        }

        $this->addUsingAlias(ExpenseMasterTableMap::COL_IS_EDITABLE, $isEditable, $comparison);

        return $this;
    }

    /**
     * Filter the query on the attachment_required column
     *
     * Example usage:
     * <code>
     * $query->filterByAttachmentRequired(true); // WHERE attachment_required = true
     * $query->filterByAttachmentRequired('yes'); // WHERE attachment_required = true
     * </code>
     *
     * @param bool|string $attachmentRequired The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAttachmentRequired($attachmentRequired = null, ?string $comparison = null)
    {
        if (is_string($attachmentRequired)) {
            $attachmentRequired = in_array(strtolower($attachmentRequired), array('false', 'off', '-', 'no', 'n', '0', ''), true) ? false : true;
        }

        $this->addUsingAlias(ExpenseMasterTableMap::COL_ATTACHMENT_REQUIRED, $attachmentRequired, $comparison);

        return $this;
    }

    /**
     * Filter the query on the sort_order column
     *
     * Example usage:
     * <code>
     * $query->filterBySortOrder(1234); // WHERE sort_order = 1234
     * $query->filterBySortOrder(array(12, 34)); // WHERE sort_order IN (12, 34)
     * $query->filterBySortOrder(array('min' => 12)); // WHERE sort_order > 12
     * </code>
     *
     * @param mixed $sortOrder The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySortOrder($sortOrder = null, ?string $comparison = null)
    {
        if (is_array($sortOrder)) {
            $useMinMax = false;
            if (isset($sortOrder['min'])) {
                $this->addUsingAlias(ExpenseMasterTableMap::COL_SORT_ORDER, $sortOrder['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($sortOrder['max'])) {
                $this->addUsingAlias(ExpenseMasterTableMap::COL_SORT_ORDER, $sortOrder['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpenseMasterTableMap::COL_SORT_ORDER, $sortOrder, $comparison);

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
    public function filterByCompanyRelatedByCompanyId($company, ?string $comparison = null)
    {
        if ($company instanceof \entities\Company) {
            return $this
                ->addUsingAlias(ExpenseMasterTableMap::COL_COMPANY_ID, $company->getCompanyId(), $comparison);
        } elseif ($company instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(ExpenseMasterTableMap::COL_COMPANY_ID, $company->toKeyValue('PrimaryKey', 'CompanyId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByCompanyRelatedByCompanyId() only accepts arguments of type \entities\Company or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CompanyRelatedByCompanyId relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinCompanyRelatedByCompanyId(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CompanyRelatedByCompanyId');

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
            $this->addJoinObject($join, 'CompanyRelatedByCompanyId');
        }

        return $this;
    }

    /**
     * Use the CompanyRelatedByCompanyId relation Company object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\CompanyQuery A secondary query class using the current class as primary query
     */
    public function useCompanyRelatedByCompanyIdQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCompanyRelatedByCompanyId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CompanyRelatedByCompanyId', '\entities\CompanyQuery');
    }

    /**
     * Use the CompanyRelatedByCompanyId relation Company object
     *
     * @param callable(\entities\CompanyQuery):\entities\CompanyQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withCompanyRelatedByCompanyIdQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useCompanyRelatedByCompanyIdQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the CompanyRelatedByCompanyId relation to the Company table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\CompanyQuery The inner query object of the EXISTS statement
     */
    public function useCompanyRelatedByCompanyIdExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\CompanyQuery */
        $q = $this->useExistsQuery('CompanyRelatedByCompanyId', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the CompanyRelatedByCompanyId relation to the Company table for a NOT EXISTS query.
     *
     * @see useCompanyRelatedByCompanyIdExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\CompanyQuery The inner query object of the NOT EXISTS statement
     */
    public function useCompanyRelatedByCompanyIdNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\CompanyQuery */
        $q = $this->useExistsQuery('CompanyRelatedByCompanyId', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the CompanyRelatedByCompanyId relation to the Company table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\CompanyQuery The inner query object of the IN statement
     */
    public function useInCompanyRelatedByCompanyIdQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\CompanyQuery */
        $q = $this->useInQuery('CompanyRelatedByCompanyId', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the CompanyRelatedByCompanyId relation to the Company table for a NOT IN query.
     *
     * @see useCompanyRelatedByCompanyIdInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\CompanyQuery The inner query object of the NOT IN statement
     */
    public function useNotInCompanyRelatedByCompanyIdQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\CompanyQuery */
        $q = $this->useInQuery('CompanyRelatedByCompanyId', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\BudgetExp object
     *
     * @param \entities\BudgetExp|ObjectCollection $budgetExp the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBudgetExp($budgetExp, ?string $comparison = null)
    {
        if ($budgetExp instanceof \entities\BudgetExp) {
            $this
                ->addUsingAlias(ExpenseMasterTableMap::COL_EXPENSE_ID, $budgetExp->getExpenseId(), $comparison);

            return $this;
        } elseif ($budgetExp instanceof ObjectCollection) {
            $this
                ->useBudgetExpQuery()
                ->filterByPrimaryKeys($budgetExp->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByBudgetExp() only accepts arguments of type \entities\BudgetExp or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BudgetExp relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinBudgetExp(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BudgetExp');

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
            $this->addJoinObject($join, 'BudgetExp');
        }

        return $this;
    }

    /**
     * Use the BudgetExp relation BudgetExp object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\BudgetExpQuery A secondary query class using the current class as primary query
     */
    public function useBudgetExpQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinBudgetExp($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BudgetExp', '\entities\BudgetExpQuery');
    }

    /**
     * Use the BudgetExp relation BudgetExp object
     *
     * @param callable(\entities\BudgetExpQuery):\entities\BudgetExpQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withBudgetExpQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useBudgetExpQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to BudgetExp table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\BudgetExpQuery The inner query object of the EXISTS statement
     */
    public function useBudgetExpExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\BudgetExpQuery */
        $q = $this->useExistsQuery('BudgetExp', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to BudgetExp table for a NOT EXISTS query.
     *
     * @see useBudgetExpExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\BudgetExpQuery The inner query object of the NOT EXISTS statement
     */
    public function useBudgetExpNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\BudgetExpQuery */
        $q = $this->useExistsQuery('BudgetExp', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to BudgetExp table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\BudgetExpQuery The inner query object of the IN statement
     */
    public function useInBudgetExpQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\BudgetExpQuery */
        $q = $this->useInQuery('BudgetExp', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to BudgetExp table for a NOT IN query.
     *
     * @see useBudgetExpInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\BudgetExpQuery The inner query object of the NOT IN statement
     */
    public function useNotInBudgetExpQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\BudgetExpQuery */
        $q = $this->useInQuery('BudgetExp', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\Company object
     *
     * @param \entities\Company|ObjectCollection $company the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCompanyRelatedByAutoCalculatedTa($company, ?string $comparison = null)
    {
        if ($company instanceof \entities\Company) {
            $this
                ->addUsingAlias(ExpenseMasterTableMap::COL_EXPENSE_ID, $company->getAutoCalculatedTa(), $comparison);

            return $this;
        } elseif ($company instanceof ObjectCollection) {
            $this
                ->useCompanyRelatedByAutoCalculatedTaQuery()
                ->filterByPrimaryKeys($company->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByCompanyRelatedByAutoCalculatedTa() only accepts arguments of type \entities\Company or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CompanyRelatedByAutoCalculatedTa relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinCompanyRelatedByAutoCalculatedTa(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CompanyRelatedByAutoCalculatedTa');

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
            $this->addJoinObject($join, 'CompanyRelatedByAutoCalculatedTa');
        }

        return $this;
    }

    /**
     * Use the CompanyRelatedByAutoCalculatedTa relation Company object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\CompanyQuery A secondary query class using the current class as primary query
     */
    public function useCompanyRelatedByAutoCalculatedTaQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinCompanyRelatedByAutoCalculatedTa($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CompanyRelatedByAutoCalculatedTa', '\entities\CompanyQuery');
    }

    /**
     * Use the CompanyRelatedByAutoCalculatedTa relation Company object
     *
     * @param callable(\entities\CompanyQuery):\entities\CompanyQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withCompanyRelatedByAutoCalculatedTaQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useCompanyRelatedByAutoCalculatedTaQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the CompanyRelatedByAutoCalculatedTa relation to the Company table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\CompanyQuery The inner query object of the EXISTS statement
     */
    public function useCompanyRelatedByAutoCalculatedTaExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\CompanyQuery */
        $q = $this->useExistsQuery('CompanyRelatedByAutoCalculatedTa', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the CompanyRelatedByAutoCalculatedTa relation to the Company table for a NOT EXISTS query.
     *
     * @see useCompanyRelatedByAutoCalculatedTaExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\CompanyQuery The inner query object of the NOT EXISTS statement
     */
    public function useCompanyRelatedByAutoCalculatedTaNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\CompanyQuery */
        $q = $this->useExistsQuery('CompanyRelatedByAutoCalculatedTa', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the CompanyRelatedByAutoCalculatedTa relation to the Company table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\CompanyQuery The inner query object of the IN statement
     */
    public function useInCompanyRelatedByAutoCalculatedTaQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\CompanyQuery */
        $q = $this->useInQuery('CompanyRelatedByAutoCalculatedTa', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the CompanyRelatedByAutoCalculatedTa relation to the Company table for a NOT IN query.
     *
     * @see useCompanyRelatedByAutoCalculatedTaInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\CompanyQuery The inner query object of the NOT IN statement
     */
    public function useNotInCompanyRelatedByAutoCalculatedTaQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\CompanyQuery */
        $q = $this->useInQuery('CompanyRelatedByAutoCalculatedTa', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(ExpenseMasterTableMap::COL_EXPENSE_ID, $expenseList->getExpMasterId(), $comparison);

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
     * Filter the query by a related \entities\ExpenseRepellent object
     *
     * @param \entities\ExpenseRepellent|ObjectCollection $expenseRepellent the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpenseRepellent($expenseRepellent, ?string $comparison = null)
    {
        if ($expenseRepellent instanceof \entities\ExpenseRepellent) {
            $this
                ->addUsingAlias(ExpenseMasterTableMap::COL_EXPENSE_ID, $expenseRepellent->getExpenseId(), $comparison);

            return $this;
        } elseif ($expenseRepellent instanceof ObjectCollection) {
            $this
                ->useExpenseRepellentQuery()
                ->filterByPrimaryKeys($expenseRepellent->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByExpenseRepellent() only accepts arguments of type \entities\ExpenseRepellent or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ExpenseRepellent relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinExpenseRepellent(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ExpenseRepellent');

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
            $this->addJoinObject($join, 'ExpenseRepellent');
        }

        return $this;
    }

    /**
     * Use the ExpenseRepellent relation ExpenseRepellent object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\ExpenseRepellentQuery A secondary query class using the current class as primary query
     */
    public function useExpenseRepellentQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinExpenseRepellent($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ExpenseRepellent', '\entities\ExpenseRepellentQuery');
    }

    /**
     * Use the ExpenseRepellent relation ExpenseRepellent object
     *
     * @param callable(\entities\ExpenseRepellentQuery):\entities\ExpenseRepellentQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withExpenseRepellentQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useExpenseRepellentQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to ExpenseRepellent table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\ExpenseRepellentQuery The inner query object of the EXISTS statement
     */
    public function useExpenseRepellentExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\ExpenseRepellentQuery */
        $q = $this->useExistsQuery('ExpenseRepellent', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to ExpenseRepellent table for a NOT EXISTS query.
     *
     * @see useExpenseRepellentExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\ExpenseRepellentQuery The inner query object of the NOT EXISTS statement
     */
    public function useExpenseRepellentNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\ExpenseRepellentQuery */
        $q = $this->useExistsQuery('ExpenseRepellent', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to ExpenseRepellent table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\ExpenseRepellentQuery The inner query object of the IN statement
     */
    public function useInExpenseRepellentQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\ExpenseRepellentQuery */
        $q = $this->useInQuery('ExpenseRepellent', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to ExpenseRepellent table for a NOT IN query.
     *
     * @see useExpenseRepellentInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\ExpenseRepellentQuery The inner query object of the NOT IN statement
     */
    public function useNotInExpenseRepellentQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\ExpenseRepellentQuery */
        $q = $this->useInQuery('ExpenseRepellent', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildExpenseMaster $expenseMaster Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($expenseMaster = null)
    {
        if ($expenseMaster) {
            $this->addUsingAlias(ExpenseMasterTableMap::COL_EXPENSE_ID, $expenseMaster->getExpenseId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the expense_master table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ExpenseMasterTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ExpenseMasterTableMap::clearInstancePool();
            ExpenseMasterTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ExpenseMasterTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ExpenseMasterTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ExpenseMasterTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ExpenseMasterTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
