<?php

namespace entities\Base;

use \Exception;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\LogicException;
use entities\ExpenseNotification as ChildExpenseNotification;
use entities\ExpenseNotificationQuery as ChildExpenseNotificationQuery;
use entities\Map\ExpenseNotificationTableMap;

/**
 * Base class that represents a query for the `expense_notification` table.
 *
 * @method     ChildExpenseNotificationQuery orderByMoye($order = Criteria::ASC) Order by the moye column
 * @method     ChildExpenseNotificationQuery orderByPendingForSubmit($order = Criteria::ASC) Order by the pending_for_submit column
 * @method     ChildExpenseNotificationQuery orderByPendingForApprove($order = Criteria::ASC) Order by the pending_for_approve column
 * @method     ChildExpenseNotificationQuery orderByPendingForAudit($order = Criteria::ASC) Order by the pending_for_audit column
 * @method     ChildExpenseNotificationQuery orderByOrgunitId($order = Criteria::ASC) Order by the orgunit_id column
 * @method     ChildExpenseNotificationQuery orderByUnitName($order = Criteria::ASC) Order by the unit_name column
 * @method     ChildExpenseNotificationQuery orderByPendingPunchout($order = Criteria::ASC) Order by the pending_punchout column
 * @method     ChildExpenseNotificationQuery orderByUniquePendingForSubmit($order = Criteria::ASC) Order by the unique_pending_for_submit column
 * @method     ChildExpenseNotificationQuery orderByUniquePendingForApprove($order = Criteria::ASC) Order by the unique_pending_for_approve column
 * @method     ChildExpenseNotificationQuery orderByUniquePendingForSubmitIds($order = Criteria::ASC) Order by the unique_pending_for_submit_ids column
 * @method     ChildExpenseNotificationQuery orderByUniquePendingPunchout($order = Criteria::ASC) Order by the unique_pending_punchout_ids column
 * @method     ChildExpenseNotificationQuery orderByUniquePendingApprovalManagerIds($order = Criteria::ASC) Order by the unique_pending_approval_manager_ids column
 *
 * @method     ChildExpenseNotificationQuery groupByMoye() Group by the moye column
 * @method     ChildExpenseNotificationQuery groupByPendingForSubmit() Group by the pending_for_submit column
 * @method     ChildExpenseNotificationQuery groupByPendingForApprove() Group by the pending_for_approve column
 * @method     ChildExpenseNotificationQuery groupByPendingForAudit() Group by the pending_for_audit column
 * @method     ChildExpenseNotificationQuery groupByOrgunitId() Group by the orgunit_id column
 * @method     ChildExpenseNotificationQuery groupByUnitName() Group by the unit_name column
 * @method     ChildExpenseNotificationQuery groupByPendingPunchout() Group by the pending_punchout column
 * @method     ChildExpenseNotificationQuery groupByUniquePendingForSubmit() Group by the unique_pending_for_submit column
 * @method     ChildExpenseNotificationQuery groupByUniquePendingForApprove() Group by the unique_pending_for_approve column
 * @method     ChildExpenseNotificationQuery groupByUniquePendingForSubmitIds() Group by the unique_pending_for_submit_ids column
 * @method     ChildExpenseNotificationQuery groupByUniquePendingPunchout() Group by the unique_pending_punchout_ids column
 * @method     ChildExpenseNotificationQuery groupByUniquePendingApprovalManagerIds() Group by the unique_pending_approval_manager_ids column
 *
 * @method     ChildExpenseNotificationQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildExpenseNotificationQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildExpenseNotificationQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildExpenseNotificationQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildExpenseNotificationQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildExpenseNotificationQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildExpenseNotification|null findOne(?ConnectionInterface $con = null) Return the first ChildExpenseNotification matching the query
 * @method     ChildExpenseNotification findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildExpenseNotification matching the query, or a new ChildExpenseNotification object populated from the query conditions when no match is found
 *
 * @method     ChildExpenseNotification|null findOneByMoye(string $moye) Return the first ChildExpenseNotification filtered by the moye column
 * @method     ChildExpenseNotification|null findOneByPendingForSubmit(string $pending_for_submit) Return the first ChildExpenseNotification filtered by the pending_for_submit column
 * @method     ChildExpenseNotification|null findOneByPendingForApprove(string $pending_for_approve) Return the first ChildExpenseNotification filtered by the pending_for_approve column
 * @method     ChildExpenseNotification|null findOneByPendingForAudit(string $pending_for_audit) Return the first ChildExpenseNotification filtered by the pending_for_audit column
 * @method     ChildExpenseNotification|null findOneByOrgunitId(int $orgunit_id) Return the first ChildExpenseNotification filtered by the orgunit_id column
 * @method     ChildExpenseNotification|null findOneByUnitName(string $unit_name) Return the first ChildExpenseNotification filtered by the unit_name column
 * @method     ChildExpenseNotification|null findOneByPendingPunchout(string $pending_punchout) Return the first ChildExpenseNotification filtered by the pending_punchout column
 * @method     ChildExpenseNotification|null findOneByUniquePendingForSubmit(string $unique_pending_for_submit) Return the first ChildExpenseNotification filtered by the unique_pending_for_submit column
 * @method     ChildExpenseNotification|null findOneByUniquePendingForApprove(string $unique_pending_for_approve) Return the first ChildExpenseNotification filtered by the unique_pending_for_approve column
 * @method     ChildExpenseNotification|null findOneByUniquePendingForSubmitIds(string $unique_pending_for_submit_ids) Return the first ChildExpenseNotification filtered by the unique_pending_for_submit_ids column
 * @method     ChildExpenseNotification|null findOneByUniquePendingPunchout(string $unique_pending_punchout_ids) Return the first ChildExpenseNotification filtered by the unique_pending_punchout_ids column
 * @method     ChildExpenseNotification|null findOneByUniquePendingApprovalManagerIds(string $unique_pending_approval_manager_ids) Return the first ChildExpenseNotification filtered by the unique_pending_approval_manager_ids column
 *
 * @method     ChildExpenseNotification requirePk($key, ?ConnectionInterface $con = null) Return the ChildExpenseNotification by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseNotification requireOne(?ConnectionInterface $con = null) Return the first ChildExpenseNotification matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildExpenseNotification requireOneByMoye(string $moye) Return the first ChildExpenseNotification filtered by the moye column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseNotification requireOneByPendingForSubmit(string $pending_for_submit) Return the first ChildExpenseNotification filtered by the pending_for_submit column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseNotification requireOneByPendingForApprove(string $pending_for_approve) Return the first ChildExpenseNotification filtered by the pending_for_approve column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseNotification requireOneByPendingForAudit(string $pending_for_audit) Return the first ChildExpenseNotification filtered by the pending_for_audit column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseNotification requireOneByOrgunitId(int $orgunit_id) Return the first ChildExpenseNotification filtered by the orgunit_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseNotification requireOneByUnitName(string $unit_name) Return the first ChildExpenseNotification filtered by the unit_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseNotification requireOneByPendingPunchout(string $pending_punchout) Return the first ChildExpenseNotification filtered by the pending_punchout column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseNotification requireOneByUniquePendingForSubmit(string $unique_pending_for_submit) Return the first ChildExpenseNotification filtered by the unique_pending_for_submit column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseNotification requireOneByUniquePendingForApprove(string $unique_pending_for_approve) Return the first ChildExpenseNotification filtered by the unique_pending_for_approve column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseNotification requireOneByUniquePendingForSubmitIds(string $unique_pending_for_submit_ids) Return the first ChildExpenseNotification filtered by the unique_pending_for_submit_ids column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseNotification requireOneByUniquePendingPunchout(string $unique_pending_punchout_ids) Return the first ChildExpenseNotification filtered by the unique_pending_punchout_ids column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseNotification requireOneByUniquePendingApprovalManagerIds(string $unique_pending_approval_manager_ids) Return the first ChildExpenseNotification filtered by the unique_pending_approval_manager_ids column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildExpenseNotification[]|Collection find(?ConnectionInterface $con = null) Return ChildExpenseNotification objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildExpenseNotification> find(?ConnectionInterface $con = null) Return ChildExpenseNotification objects based on current ModelCriteria
 *
 * @method     ChildExpenseNotification[]|Collection findByMoye(string|array<string> $moye) Return ChildExpenseNotification objects filtered by the moye column
 * @psalm-method Collection&\Traversable<ChildExpenseNotification> findByMoye(string|array<string> $moye) Return ChildExpenseNotification objects filtered by the moye column
 * @method     ChildExpenseNotification[]|Collection findByPendingForSubmit(string|array<string> $pending_for_submit) Return ChildExpenseNotification objects filtered by the pending_for_submit column
 * @psalm-method Collection&\Traversable<ChildExpenseNotification> findByPendingForSubmit(string|array<string> $pending_for_submit) Return ChildExpenseNotification objects filtered by the pending_for_submit column
 * @method     ChildExpenseNotification[]|Collection findByPendingForApprove(string|array<string> $pending_for_approve) Return ChildExpenseNotification objects filtered by the pending_for_approve column
 * @psalm-method Collection&\Traversable<ChildExpenseNotification> findByPendingForApprove(string|array<string> $pending_for_approve) Return ChildExpenseNotification objects filtered by the pending_for_approve column
 * @method     ChildExpenseNotification[]|Collection findByPendingForAudit(string|array<string> $pending_for_audit) Return ChildExpenseNotification objects filtered by the pending_for_audit column
 * @psalm-method Collection&\Traversable<ChildExpenseNotification> findByPendingForAudit(string|array<string> $pending_for_audit) Return ChildExpenseNotification objects filtered by the pending_for_audit column
 * @method     ChildExpenseNotification[]|Collection findByOrgunitId(int|array<int> $orgunit_id) Return ChildExpenseNotification objects filtered by the orgunit_id column
 * @psalm-method Collection&\Traversable<ChildExpenseNotification> findByOrgunitId(int|array<int> $orgunit_id) Return ChildExpenseNotification objects filtered by the orgunit_id column
 * @method     ChildExpenseNotification[]|Collection findByUnitName(string|array<string> $unit_name) Return ChildExpenseNotification objects filtered by the unit_name column
 * @psalm-method Collection&\Traversable<ChildExpenseNotification> findByUnitName(string|array<string> $unit_name) Return ChildExpenseNotification objects filtered by the unit_name column
 * @method     ChildExpenseNotification[]|Collection findByPendingPunchout(string|array<string> $pending_punchout) Return ChildExpenseNotification objects filtered by the pending_punchout column
 * @psalm-method Collection&\Traversable<ChildExpenseNotification> findByPendingPunchout(string|array<string> $pending_punchout) Return ChildExpenseNotification objects filtered by the pending_punchout column
 * @method     ChildExpenseNotification[]|Collection findByUniquePendingForSubmit(string|array<string> $unique_pending_for_submit) Return ChildExpenseNotification objects filtered by the unique_pending_for_submit column
 * @psalm-method Collection&\Traversable<ChildExpenseNotification> findByUniquePendingForSubmit(string|array<string> $unique_pending_for_submit) Return ChildExpenseNotification objects filtered by the unique_pending_for_submit column
 * @method     ChildExpenseNotification[]|Collection findByUniquePendingForApprove(string|array<string> $unique_pending_for_approve) Return ChildExpenseNotification objects filtered by the unique_pending_for_approve column
 * @psalm-method Collection&\Traversable<ChildExpenseNotification> findByUniquePendingForApprove(string|array<string> $unique_pending_for_approve) Return ChildExpenseNotification objects filtered by the unique_pending_for_approve column
 * @method     ChildExpenseNotification[]|Collection findByUniquePendingForSubmitIds(string|array<string> $unique_pending_for_submit_ids) Return ChildExpenseNotification objects filtered by the unique_pending_for_submit_ids column
 * @psalm-method Collection&\Traversable<ChildExpenseNotification> findByUniquePendingForSubmitIds(string|array<string> $unique_pending_for_submit_ids) Return ChildExpenseNotification objects filtered by the unique_pending_for_submit_ids column
 * @method     ChildExpenseNotification[]|Collection findByUniquePendingPunchout(string|array<string> $unique_pending_punchout_ids) Return ChildExpenseNotification objects filtered by the unique_pending_punchout_ids column
 * @psalm-method Collection&\Traversable<ChildExpenseNotification> findByUniquePendingPunchout(string|array<string> $unique_pending_punchout_ids) Return ChildExpenseNotification objects filtered by the unique_pending_punchout_ids column
 * @method     ChildExpenseNotification[]|Collection findByUniquePendingApprovalManagerIds(string|array<string> $unique_pending_approval_manager_ids) Return ChildExpenseNotification objects filtered by the unique_pending_approval_manager_ids column
 * @psalm-method Collection&\Traversable<ChildExpenseNotification> findByUniquePendingApprovalManagerIds(string|array<string> $unique_pending_approval_manager_ids) Return ChildExpenseNotification objects filtered by the unique_pending_approval_manager_ids column
 *
 * @method     ChildExpenseNotification[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildExpenseNotification> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class ExpenseNotificationQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\ExpenseNotificationQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\ExpenseNotification', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildExpenseNotificationQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildExpenseNotificationQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildExpenseNotificationQuery) {
            return $criteria;
        }
        $query = new ChildExpenseNotificationQuery();
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
     * @return ChildExpenseNotification|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        throw new LogicException('The ExpenseNotification object has no primary key');
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
        throw new LogicException('The ExpenseNotification object has no primary key');
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
        throw new LogicException('The ExpenseNotification object has no primary key');
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
        throw new LogicException('The ExpenseNotification object has no primary key');
    }

    /**
     * Filter the query on the moye column
     *
     * Example usage:
     * <code>
     * $query->filterByMoye('fooValue');   // WHERE moye = 'fooValue'
     * $query->filterByMoye('%fooValue%', Criteria::LIKE); // WHERE moye LIKE '%fooValue%'
     * $query->filterByMoye(['foo', 'bar']); // WHERE moye IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $moye The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMoye($moye = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($moye)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpenseNotificationTableMap::COL_MOYE, $moye, $comparison);

        return $this;
    }

    /**
     * Filter the query on the pending_for_submit column
     *
     * Example usage:
     * <code>
     * $query->filterByPendingForSubmit(1234); // WHERE pending_for_submit = 1234
     * $query->filterByPendingForSubmit(array(12, 34)); // WHERE pending_for_submit IN (12, 34)
     * $query->filterByPendingForSubmit(array('min' => 12)); // WHERE pending_for_submit > 12
     * </code>
     *
     * @param mixed $pendingForSubmit The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPendingForSubmit($pendingForSubmit = null, ?string $comparison = null)
    {
        if (is_array($pendingForSubmit)) {
            $useMinMax = false;
            if (isset($pendingForSubmit['min'])) {
                $this->addUsingAlias(ExpenseNotificationTableMap::COL_PENDING_FOR_SUBMIT, $pendingForSubmit['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($pendingForSubmit['max'])) {
                $this->addUsingAlias(ExpenseNotificationTableMap::COL_PENDING_FOR_SUBMIT, $pendingForSubmit['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpenseNotificationTableMap::COL_PENDING_FOR_SUBMIT, $pendingForSubmit, $comparison);

        return $this;
    }

    /**
     * Filter the query on the pending_for_approve column
     *
     * Example usage:
     * <code>
     * $query->filterByPendingForApprove(1234); // WHERE pending_for_approve = 1234
     * $query->filterByPendingForApprove(array(12, 34)); // WHERE pending_for_approve IN (12, 34)
     * $query->filterByPendingForApprove(array('min' => 12)); // WHERE pending_for_approve > 12
     * </code>
     *
     * @param mixed $pendingForApprove The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPendingForApprove($pendingForApprove = null, ?string $comparison = null)
    {
        if (is_array($pendingForApprove)) {
            $useMinMax = false;
            if (isset($pendingForApprove['min'])) {
                $this->addUsingAlias(ExpenseNotificationTableMap::COL_PENDING_FOR_APPROVE, $pendingForApprove['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($pendingForApprove['max'])) {
                $this->addUsingAlias(ExpenseNotificationTableMap::COL_PENDING_FOR_APPROVE, $pendingForApprove['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpenseNotificationTableMap::COL_PENDING_FOR_APPROVE, $pendingForApprove, $comparison);

        return $this;
    }

    /**
     * Filter the query on the pending_for_audit column
     *
     * Example usage:
     * <code>
     * $query->filterByPendingForAudit(1234); // WHERE pending_for_audit = 1234
     * $query->filterByPendingForAudit(array(12, 34)); // WHERE pending_for_audit IN (12, 34)
     * $query->filterByPendingForAudit(array('min' => 12)); // WHERE pending_for_audit > 12
     * </code>
     *
     * @param mixed $pendingForAudit The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPendingForAudit($pendingForAudit = null, ?string $comparison = null)
    {
        if (is_array($pendingForAudit)) {
            $useMinMax = false;
            if (isset($pendingForAudit['min'])) {
                $this->addUsingAlias(ExpenseNotificationTableMap::COL_PENDING_FOR_AUDIT, $pendingForAudit['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($pendingForAudit['max'])) {
                $this->addUsingAlias(ExpenseNotificationTableMap::COL_PENDING_FOR_AUDIT, $pendingForAudit['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpenseNotificationTableMap::COL_PENDING_FOR_AUDIT, $pendingForAudit, $comparison);

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
                $this->addUsingAlias(ExpenseNotificationTableMap::COL_ORGUNIT_ID, $orgunitId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($orgunitId['max'])) {
                $this->addUsingAlias(ExpenseNotificationTableMap::COL_ORGUNIT_ID, $orgunitId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpenseNotificationTableMap::COL_ORGUNIT_ID, $orgunitId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the unit_name column
     *
     * Example usage:
     * <code>
     * $query->filterByUnitName('fooValue');   // WHERE unit_name = 'fooValue'
     * $query->filterByUnitName('%fooValue%', Criteria::LIKE); // WHERE unit_name LIKE '%fooValue%'
     * $query->filterByUnitName(['foo', 'bar']); // WHERE unit_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $unitName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUnitName($unitName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($unitName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpenseNotificationTableMap::COL_UNIT_NAME, $unitName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the pending_punchout column
     *
     * Example usage:
     * <code>
     * $query->filterByPendingPunchout('fooValue');   // WHERE pending_punchout = 'fooValue'
     * $query->filterByPendingPunchout('%fooValue%', Criteria::LIKE); // WHERE pending_punchout LIKE '%fooValue%'
     * $query->filterByPendingPunchout(['foo', 'bar']); // WHERE pending_punchout IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $pendingPunchout The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPendingPunchout($pendingPunchout = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($pendingPunchout)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpenseNotificationTableMap::COL_PENDING_PUNCHOUT, $pendingPunchout, $comparison);

        return $this;
    }

    /**
     * Filter the query on the unique_pending_for_submit column
     *
     * Example usage:
     * <code>
     * $query->filterByUniquePendingForSubmit('fooValue');   // WHERE unique_pending_for_submit = 'fooValue'
     * $query->filterByUniquePendingForSubmit('%fooValue%', Criteria::LIKE); // WHERE unique_pending_for_submit LIKE '%fooValue%'
     * $query->filterByUniquePendingForSubmit(['foo', 'bar']); // WHERE unique_pending_for_submit IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $uniquePendingForSubmit The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUniquePendingForSubmit($uniquePendingForSubmit = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($uniquePendingForSubmit)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpenseNotificationTableMap::COL_UNIQUE_PENDING_FOR_SUBMIT, $uniquePendingForSubmit, $comparison);

        return $this;
    }

    /**
     * Filter the query on the unique_pending_for_approve column
     *
     * Example usage:
     * <code>
     * $query->filterByUniquePendingForApprove('fooValue');   // WHERE unique_pending_for_approve = 'fooValue'
     * $query->filterByUniquePendingForApprove('%fooValue%', Criteria::LIKE); // WHERE unique_pending_for_approve LIKE '%fooValue%'
     * $query->filterByUniquePendingForApprove(['foo', 'bar']); // WHERE unique_pending_for_approve IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $uniquePendingForApprove The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUniquePendingForApprove($uniquePendingForApprove = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($uniquePendingForApprove)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpenseNotificationTableMap::COL_UNIQUE_PENDING_FOR_APPROVE, $uniquePendingForApprove, $comparison);

        return $this;
    }

    /**
     * Filter the query on the unique_pending_for_submit_ids column
     *
     * Example usage:
     * <code>
     * $query->filterByUniquePendingForSubmitIds('fooValue');   // WHERE unique_pending_for_submit_ids = 'fooValue'
     * $query->filterByUniquePendingForSubmitIds('%fooValue%', Criteria::LIKE); // WHERE unique_pending_for_submit_ids LIKE '%fooValue%'
     * $query->filterByUniquePendingForSubmitIds(['foo', 'bar']); // WHERE unique_pending_for_submit_ids IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $uniquePendingForSubmitIds The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUniquePendingForSubmitIds($uniquePendingForSubmitIds = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($uniquePendingForSubmitIds)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpenseNotificationTableMap::COL_UNIQUE_PENDING_FOR_SUBMIT_IDS, $uniquePendingForSubmitIds, $comparison);

        return $this;
    }

    /**
     * Filter the query on the unique_pending_punchout_ids column
     *
     * Example usage:
     * <code>
     * $query->filterByUniquePendingPunchout('fooValue');   // WHERE unique_pending_punchout_ids = 'fooValue'
     * $query->filterByUniquePendingPunchout('%fooValue%', Criteria::LIKE); // WHERE unique_pending_punchout_ids LIKE '%fooValue%'
     * $query->filterByUniquePendingPunchout(['foo', 'bar']); // WHERE unique_pending_punchout_ids IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $uniquePendingPunchout The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUniquePendingPunchout($uniquePendingPunchout = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($uniquePendingPunchout)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpenseNotificationTableMap::COL_UNIQUE_PENDING_PUNCHOUT_IDS, $uniquePendingPunchout, $comparison);

        return $this;
    }

    /**
     * Filter the query on the unique_pending_approval_manager_ids column
     *
     * Example usage:
     * <code>
     * $query->filterByUniquePendingApprovalManagerIds('fooValue');   // WHERE unique_pending_approval_manager_ids = 'fooValue'
     * $query->filterByUniquePendingApprovalManagerIds('%fooValue%', Criteria::LIKE); // WHERE unique_pending_approval_manager_ids LIKE '%fooValue%'
     * $query->filterByUniquePendingApprovalManagerIds(['foo', 'bar']); // WHERE unique_pending_approval_manager_ids IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $uniquePendingApprovalManagerIds The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUniquePendingApprovalManagerIds($uniquePendingApprovalManagerIds = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($uniquePendingApprovalManagerIds)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpenseNotificationTableMap::COL_UNIQUE_PENDING_APPROVAL_MANAGER_IDS, $uniquePendingApprovalManagerIds, $comparison);

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildExpenseNotification $expenseNotification Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($expenseNotification = null)
    {
        if ($expenseNotification) {
            throw new LogicException('ExpenseNotification object has no primary key');

        }

        return $this;
    }

}
