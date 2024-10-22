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
use entities\ExpenseTemplateMaster as ChildExpenseTemplateMaster;
use entities\ExpenseTemplateMasterQuery as ChildExpenseTemplateMasterQuery;
use entities\Map\ExpenseTemplateMasterTableMap;

/**
 * Base class that represents a query for the `expense_template_master` table.
 *
 * @method     ChildExpenseTemplateMasterQuery orderByExpenseTmplId($order = Criteria::ASC) Order by the expense_tmpl_id column
 * @method     ChildExpenseTemplateMasterQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildExpenseTemplateMasterQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildExpenseTemplateMasterQuery orderByExpenseTemplateName($order = Criteria::ASC) Order by the expense_template_name column
 * @method     ChildExpenseTemplateMasterQuery orderByExpenseName($order = Criteria::ASC) Order by the expense_name column
 * @method     ChildExpenseTemplateMasterQuery orderByDefaultPolicykey($order = Criteria::ASC) Order by the default_policykey column
 * @method     ChildExpenseTemplateMasterQuery orderByCheckcity($order = Criteria::ASC) Order by the checkcity column
 * @method     ChildExpenseTemplateMasterQuery orderByPolicykeya($order = Criteria::ASC) Order by the policykeya column
 * @method     ChildExpenseTemplateMasterQuery orderByPolicykeyb($order = Criteria::ASC) Order by the policykeyb column
 * @method     ChildExpenseTemplateMasterQuery orderByPolicykeyc($order = Criteria::ASC) Order by the policykeyc column
 * @method     ChildExpenseTemplateMasterQuery orderByTrips($order = Criteria::ASC) Order by the trips column
 * @method     ChildExpenseTemplateMasterQuery orderByPermonth($order = Criteria::ASC) Order by the permonth column
 * @method     ChildExpenseTemplateMasterQuery orderByNonreimbursable($order = Criteria::ASC) Order by the nonreimbursable column
 * @method     ChildExpenseTemplateMasterQuery orderByIsdaily($order = Criteria::ASC) Order by the isdaily column
 * @method     ChildExpenseTemplateMasterQuery orderByIsrateapplied($order = Criteria::ASC) Order by the israteapplied column
 * @method     ChildExpenseTemplateMasterQuery orderByRate($order = Criteria::ASC) Order by the rate column
 * @method     ChildExpenseTemplateMasterQuery orderByMode($order = Criteria::ASC) Order by the mode column
 * @method     ChildExpenseTemplateMasterQuery orderByCommentreq($order = Criteria::ASC) Order by the commentreq column
 * @method     ChildExpenseTemplateMasterQuery orderByAdditionalText($order = Criteria::ASC) Order by the additional_text column
 * @method     ChildExpenseTemplateMasterQuery orderByIsPrefilled($order = Criteria::ASC) Order by the is_prefilled column
 * @method     ChildExpenseTemplateMasterQuery orderByIsMandatory($order = Criteria::ASC) Order by the is_mandatory column
 *
 * @method     ChildExpenseTemplateMasterQuery groupByExpenseTmplId() Group by the expense_tmpl_id column
 * @method     ChildExpenseTemplateMasterQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildExpenseTemplateMasterQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildExpenseTemplateMasterQuery groupByExpenseTemplateName() Group by the expense_template_name column
 * @method     ChildExpenseTemplateMasterQuery groupByExpenseName() Group by the expense_name column
 * @method     ChildExpenseTemplateMasterQuery groupByDefaultPolicykey() Group by the default_policykey column
 * @method     ChildExpenseTemplateMasterQuery groupByCheckcity() Group by the checkcity column
 * @method     ChildExpenseTemplateMasterQuery groupByPolicykeya() Group by the policykeya column
 * @method     ChildExpenseTemplateMasterQuery groupByPolicykeyb() Group by the policykeyb column
 * @method     ChildExpenseTemplateMasterQuery groupByPolicykeyc() Group by the policykeyc column
 * @method     ChildExpenseTemplateMasterQuery groupByTrips() Group by the trips column
 * @method     ChildExpenseTemplateMasterQuery groupByPermonth() Group by the permonth column
 * @method     ChildExpenseTemplateMasterQuery groupByNonreimbursable() Group by the nonreimbursable column
 * @method     ChildExpenseTemplateMasterQuery groupByIsdaily() Group by the isdaily column
 * @method     ChildExpenseTemplateMasterQuery groupByIsrateapplied() Group by the israteapplied column
 * @method     ChildExpenseTemplateMasterQuery groupByRate() Group by the rate column
 * @method     ChildExpenseTemplateMasterQuery groupByMode() Group by the mode column
 * @method     ChildExpenseTemplateMasterQuery groupByCommentreq() Group by the commentreq column
 * @method     ChildExpenseTemplateMasterQuery groupByAdditionalText() Group by the additional_text column
 * @method     ChildExpenseTemplateMasterQuery groupByIsPrefilled() Group by the is_prefilled column
 * @method     ChildExpenseTemplateMasterQuery groupByIsMandatory() Group by the is_mandatory column
 *
 * @method     ChildExpenseTemplateMasterQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildExpenseTemplateMasterQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildExpenseTemplateMasterQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildExpenseTemplateMasterQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildExpenseTemplateMasterQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildExpenseTemplateMasterQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildExpenseTemplateMaster|null findOne(?ConnectionInterface $con = null) Return the first ChildExpenseTemplateMaster matching the query
 * @method     ChildExpenseTemplateMaster findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildExpenseTemplateMaster matching the query, or a new ChildExpenseTemplateMaster object populated from the query conditions when no match is found
 *
 * @method     ChildExpenseTemplateMaster|null findOneByExpenseTmplId(int $expense_tmpl_id) Return the first ChildExpenseTemplateMaster filtered by the expense_tmpl_id column
 * @method     ChildExpenseTemplateMaster|null findOneByCreatedAt(string $created_at) Return the first ChildExpenseTemplateMaster filtered by the created_at column
 * @method     ChildExpenseTemplateMaster|null findOneByUpdatedAt(string $updated_at) Return the first ChildExpenseTemplateMaster filtered by the updated_at column
 * @method     ChildExpenseTemplateMaster|null findOneByExpenseTemplateName(string $expense_template_name) Return the first ChildExpenseTemplateMaster filtered by the expense_template_name column
 * @method     ChildExpenseTemplateMaster|null findOneByExpenseName(string $expense_name) Return the first ChildExpenseTemplateMaster filtered by the expense_name column
 * @method     ChildExpenseTemplateMaster|null findOneByDefaultPolicykey(string $default_policykey) Return the first ChildExpenseTemplateMaster filtered by the default_policykey column
 * @method     ChildExpenseTemplateMaster|null findOneByCheckcity(boolean $checkcity) Return the first ChildExpenseTemplateMaster filtered by the checkcity column
 * @method     ChildExpenseTemplateMaster|null findOneByPolicykeya(string $policykeya) Return the first ChildExpenseTemplateMaster filtered by the policykeya column
 * @method     ChildExpenseTemplateMaster|null findOneByPolicykeyb(string $policykeyb) Return the first ChildExpenseTemplateMaster filtered by the policykeyb column
 * @method     ChildExpenseTemplateMaster|null findOneByPolicykeyc(string $policykeyc) Return the first ChildExpenseTemplateMaster filtered by the policykeyc column
 * @method     ChildExpenseTemplateMaster|null findOneByTrips(int $trips) Return the first ChildExpenseTemplateMaster filtered by the trips column
 * @method     ChildExpenseTemplateMaster|null findOneByPermonth(boolean $permonth) Return the first ChildExpenseTemplateMaster filtered by the permonth column
 * @method     ChildExpenseTemplateMaster|null findOneByNonreimbursable(boolean $nonreimbursable) Return the first ChildExpenseTemplateMaster filtered by the nonreimbursable column
 * @method     ChildExpenseTemplateMaster|null findOneByIsdaily(boolean $isdaily) Return the first ChildExpenseTemplateMaster filtered by the isdaily column
 * @method     ChildExpenseTemplateMaster|null findOneByIsrateapplied(boolean $israteapplied) Return the first ChildExpenseTemplateMaster filtered by the israteapplied column
 * @method     ChildExpenseTemplateMaster|null findOneByRate(string $rate) Return the first ChildExpenseTemplateMaster filtered by the rate column
 * @method     ChildExpenseTemplateMaster|null findOneByMode(string $mode) Return the first ChildExpenseTemplateMaster filtered by the mode column
 * @method     ChildExpenseTemplateMaster|null findOneByCommentreq(boolean $commentreq) Return the first ChildExpenseTemplateMaster filtered by the commentreq column
 * @method     ChildExpenseTemplateMaster|null findOneByAdditionalText(boolean $additional_text) Return the first ChildExpenseTemplateMaster filtered by the additional_text column
 * @method     ChildExpenseTemplateMaster|null findOneByIsPrefilled(boolean $is_prefilled) Return the first ChildExpenseTemplateMaster filtered by the is_prefilled column
 * @method     ChildExpenseTemplateMaster|null findOneByIsMandatory(boolean $is_mandatory) Return the first ChildExpenseTemplateMaster filtered by the is_mandatory column
 *
 * @method     ChildExpenseTemplateMaster requirePk($key, ?ConnectionInterface $con = null) Return the ChildExpenseTemplateMaster by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseTemplateMaster requireOne(?ConnectionInterface $con = null) Return the first ChildExpenseTemplateMaster matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildExpenseTemplateMaster requireOneByExpenseTmplId(int $expense_tmpl_id) Return the first ChildExpenseTemplateMaster filtered by the expense_tmpl_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseTemplateMaster requireOneByCreatedAt(string $created_at) Return the first ChildExpenseTemplateMaster filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseTemplateMaster requireOneByUpdatedAt(string $updated_at) Return the first ChildExpenseTemplateMaster filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseTemplateMaster requireOneByExpenseTemplateName(string $expense_template_name) Return the first ChildExpenseTemplateMaster filtered by the expense_template_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseTemplateMaster requireOneByExpenseName(string $expense_name) Return the first ChildExpenseTemplateMaster filtered by the expense_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseTemplateMaster requireOneByDefaultPolicykey(string $default_policykey) Return the first ChildExpenseTemplateMaster filtered by the default_policykey column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseTemplateMaster requireOneByCheckcity(boolean $checkcity) Return the first ChildExpenseTemplateMaster filtered by the checkcity column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseTemplateMaster requireOneByPolicykeya(string $policykeya) Return the first ChildExpenseTemplateMaster filtered by the policykeya column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseTemplateMaster requireOneByPolicykeyb(string $policykeyb) Return the first ChildExpenseTemplateMaster filtered by the policykeyb column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseTemplateMaster requireOneByPolicykeyc(string $policykeyc) Return the first ChildExpenseTemplateMaster filtered by the policykeyc column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseTemplateMaster requireOneByTrips(int $trips) Return the first ChildExpenseTemplateMaster filtered by the trips column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseTemplateMaster requireOneByPermonth(boolean $permonth) Return the first ChildExpenseTemplateMaster filtered by the permonth column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseTemplateMaster requireOneByNonreimbursable(boolean $nonreimbursable) Return the first ChildExpenseTemplateMaster filtered by the nonreimbursable column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseTemplateMaster requireOneByIsdaily(boolean $isdaily) Return the first ChildExpenseTemplateMaster filtered by the isdaily column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseTemplateMaster requireOneByIsrateapplied(boolean $israteapplied) Return the first ChildExpenseTemplateMaster filtered by the israteapplied column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseTemplateMaster requireOneByRate(string $rate) Return the first ChildExpenseTemplateMaster filtered by the rate column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseTemplateMaster requireOneByMode(string $mode) Return the first ChildExpenseTemplateMaster filtered by the mode column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseTemplateMaster requireOneByCommentreq(boolean $commentreq) Return the first ChildExpenseTemplateMaster filtered by the commentreq column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseTemplateMaster requireOneByAdditionalText(boolean $additional_text) Return the first ChildExpenseTemplateMaster filtered by the additional_text column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseTemplateMaster requireOneByIsPrefilled(boolean $is_prefilled) Return the first ChildExpenseTemplateMaster filtered by the is_prefilled column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseTemplateMaster requireOneByIsMandatory(boolean $is_mandatory) Return the first ChildExpenseTemplateMaster filtered by the is_mandatory column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildExpenseTemplateMaster[]|Collection find(?ConnectionInterface $con = null) Return ChildExpenseTemplateMaster objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildExpenseTemplateMaster> find(?ConnectionInterface $con = null) Return ChildExpenseTemplateMaster objects based on current ModelCriteria
 *
 * @method     ChildExpenseTemplateMaster[]|Collection findByExpenseTmplId(int|array<int> $expense_tmpl_id) Return ChildExpenseTemplateMaster objects filtered by the expense_tmpl_id column
 * @psalm-method Collection&\Traversable<ChildExpenseTemplateMaster> findByExpenseTmplId(int|array<int> $expense_tmpl_id) Return ChildExpenseTemplateMaster objects filtered by the expense_tmpl_id column
 * @method     ChildExpenseTemplateMaster[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildExpenseTemplateMaster objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildExpenseTemplateMaster> findByCreatedAt(string|array<string> $created_at) Return ChildExpenseTemplateMaster objects filtered by the created_at column
 * @method     ChildExpenseTemplateMaster[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildExpenseTemplateMaster objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildExpenseTemplateMaster> findByUpdatedAt(string|array<string> $updated_at) Return ChildExpenseTemplateMaster objects filtered by the updated_at column
 * @method     ChildExpenseTemplateMaster[]|Collection findByExpenseTemplateName(string|array<string> $expense_template_name) Return ChildExpenseTemplateMaster objects filtered by the expense_template_name column
 * @psalm-method Collection&\Traversable<ChildExpenseTemplateMaster> findByExpenseTemplateName(string|array<string> $expense_template_name) Return ChildExpenseTemplateMaster objects filtered by the expense_template_name column
 * @method     ChildExpenseTemplateMaster[]|Collection findByExpenseName(string|array<string> $expense_name) Return ChildExpenseTemplateMaster objects filtered by the expense_name column
 * @psalm-method Collection&\Traversable<ChildExpenseTemplateMaster> findByExpenseName(string|array<string> $expense_name) Return ChildExpenseTemplateMaster objects filtered by the expense_name column
 * @method     ChildExpenseTemplateMaster[]|Collection findByDefaultPolicykey(string|array<string> $default_policykey) Return ChildExpenseTemplateMaster objects filtered by the default_policykey column
 * @psalm-method Collection&\Traversable<ChildExpenseTemplateMaster> findByDefaultPolicykey(string|array<string> $default_policykey) Return ChildExpenseTemplateMaster objects filtered by the default_policykey column
 * @method     ChildExpenseTemplateMaster[]|Collection findByCheckcity(boolean|array<boolean> $checkcity) Return ChildExpenseTemplateMaster objects filtered by the checkcity column
 * @psalm-method Collection&\Traversable<ChildExpenseTemplateMaster> findByCheckcity(boolean|array<boolean> $checkcity) Return ChildExpenseTemplateMaster objects filtered by the checkcity column
 * @method     ChildExpenseTemplateMaster[]|Collection findByPolicykeya(string|array<string> $policykeya) Return ChildExpenseTemplateMaster objects filtered by the policykeya column
 * @psalm-method Collection&\Traversable<ChildExpenseTemplateMaster> findByPolicykeya(string|array<string> $policykeya) Return ChildExpenseTemplateMaster objects filtered by the policykeya column
 * @method     ChildExpenseTemplateMaster[]|Collection findByPolicykeyb(string|array<string> $policykeyb) Return ChildExpenseTemplateMaster objects filtered by the policykeyb column
 * @psalm-method Collection&\Traversable<ChildExpenseTemplateMaster> findByPolicykeyb(string|array<string> $policykeyb) Return ChildExpenseTemplateMaster objects filtered by the policykeyb column
 * @method     ChildExpenseTemplateMaster[]|Collection findByPolicykeyc(string|array<string> $policykeyc) Return ChildExpenseTemplateMaster objects filtered by the policykeyc column
 * @psalm-method Collection&\Traversable<ChildExpenseTemplateMaster> findByPolicykeyc(string|array<string> $policykeyc) Return ChildExpenseTemplateMaster objects filtered by the policykeyc column
 * @method     ChildExpenseTemplateMaster[]|Collection findByTrips(int|array<int> $trips) Return ChildExpenseTemplateMaster objects filtered by the trips column
 * @psalm-method Collection&\Traversable<ChildExpenseTemplateMaster> findByTrips(int|array<int> $trips) Return ChildExpenseTemplateMaster objects filtered by the trips column
 * @method     ChildExpenseTemplateMaster[]|Collection findByPermonth(boolean|array<boolean> $permonth) Return ChildExpenseTemplateMaster objects filtered by the permonth column
 * @psalm-method Collection&\Traversable<ChildExpenseTemplateMaster> findByPermonth(boolean|array<boolean> $permonth) Return ChildExpenseTemplateMaster objects filtered by the permonth column
 * @method     ChildExpenseTemplateMaster[]|Collection findByNonreimbursable(boolean|array<boolean> $nonreimbursable) Return ChildExpenseTemplateMaster objects filtered by the nonreimbursable column
 * @psalm-method Collection&\Traversable<ChildExpenseTemplateMaster> findByNonreimbursable(boolean|array<boolean> $nonreimbursable) Return ChildExpenseTemplateMaster objects filtered by the nonreimbursable column
 * @method     ChildExpenseTemplateMaster[]|Collection findByIsdaily(boolean|array<boolean> $isdaily) Return ChildExpenseTemplateMaster objects filtered by the isdaily column
 * @psalm-method Collection&\Traversable<ChildExpenseTemplateMaster> findByIsdaily(boolean|array<boolean> $isdaily) Return ChildExpenseTemplateMaster objects filtered by the isdaily column
 * @method     ChildExpenseTemplateMaster[]|Collection findByIsrateapplied(boolean|array<boolean> $israteapplied) Return ChildExpenseTemplateMaster objects filtered by the israteapplied column
 * @psalm-method Collection&\Traversable<ChildExpenseTemplateMaster> findByIsrateapplied(boolean|array<boolean> $israteapplied) Return ChildExpenseTemplateMaster objects filtered by the israteapplied column
 * @method     ChildExpenseTemplateMaster[]|Collection findByRate(string|array<string> $rate) Return ChildExpenseTemplateMaster objects filtered by the rate column
 * @psalm-method Collection&\Traversable<ChildExpenseTemplateMaster> findByRate(string|array<string> $rate) Return ChildExpenseTemplateMaster objects filtered by the rate column
 * @method     ChildExpenseTemplateMaster[]|Collection findByMode(string|array<string> $mode) Return ChildExpenseTemplateMaster objects filtered by the mode column
 * @psalm-method Collection&\Traversable<ChildExpenseTemplateMaster> findByMode(string|array<string> $mode) Return ChildExpenseTemplateMaster objects filtered by the mode column
 * @method     ChildExpenseTemplateMaster[]|Collection findByCommentreq(boolean|array<boolean> $commentreq) Return ChildExpenseTemplateMaster objects filtered by the commentreq column
 * @psalm-method Collection&\Traversable<ChildExpenseTemplateMaster> findByCommentreq(boolean|array<boolean> $commentreq) Return ChildExpenseTemplateMaster objects filtered by the commentreq column
 * @method     ChildExpenseTemplateMaster[]|Collection findByAdditionalText(boolean|array<boolean> $additional_text) Return ChildExpenseTemplateMaster objects filtered by the additional_text column
 * @psalm-method Collection&\Traversable<ChildExpenseTemplateMaster> findByAdditionalText(boolean|array<boolean> $additional_text) Return ChildExpenseTemplateMaster objects filtered by the additional_text column
 * @method     ChildExpenseTemplateMaster[]|Collection findByIsPrefilled(boolean|array<boolean> $is_prefilled) Return ChildExpenseTemplateMaster objects filtered by the is_prefilled column
 * @psalm-method Collection&\Traversable<ChildExpenseTemplateMaster> findByIsPrefilled(boolean|array<boolean> $is_prefilled) Return ChildExpenseTemplateMaster objects filtered by the is_prefilled column
 * @method     ChildExpenseTemplateMaster[]|Collection findByIsMandatory(boolean|array<boolean> $is_mandatory) Return ChildExpenseTemplateMaster objects filtered by the is_mandatory column
 * @psalm-method Collection&\Traversable<ChildExpenseTemplateMaster> findByIsMandatory(boolean|array<boolean> $is_mandatory) Return ChildExpenseTemplateMaster objects filtered by the is_mandatory column
 *
 * @method     ChildExpenseTemplateMaster[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildExpenseTemplateMaster> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class ExpenseTemplateMasterQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\ExpenseTemplateMasterQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\ExpenseTemplateMaster', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildExpenseTemplateMasterQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildExpenseTemplateMasterQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildExpenseTemplateMasterQuery) {
            return $criteria;
        }
        $query = new ChildExpenseTemplateMasterQuery();
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
     * @return ChildExpenseTemplateMaster|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ExpenseTemplateMasterTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ExpenseTemplateMasterTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildExpenseTemplateMaster A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT expense_tmpl_id, created_at, updated_at, expense_template_name, expense_name, default_policykey, checkcity, policykeya, policykeyb, policykeyc, trips, permonth, nonreimbursable, isdaily, israteapplied, rate, mode, commentreq, additional_text, is_prefilled, is_mandatory FROM expense_template_master WHERE expense_tmpl_id = :p0';
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
            /** @var ChildExpenseTemplateMaster $obj */
            $obj = new ChildExpenseTemplateMaster();
            $obj->hydrate($row);
            ExpenseTemplateMasterTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildExpenseTemplateMaster|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(ExpenseTemplateMasterTableMap::COL_EXPENSE_TMPL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(ExpenseTemplateMasterTableMap::COL_EXPENSE_TMPL_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the expense_tmpl_id column
     *
     * Example usage:
     * <code>
     * $query->filterByExpenseTmplId(1234); // WHERE expense_tmpl_id = 1234
     * $query->filterByExpenseTmplId(array(12, 34)); // WHERE expense_tmpl_id IN (12, 34)
     * $query->filterByExpenseTmplId(array('min' => 12)); // WHERE expense_tmpl_id > 12
     * </code>
     *
     * @param mixed $expenseTmplId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpenseTmplId($expenseTmplId = null, ?string $comparison = null)
    {
        if (is_array($expenseTmplId)) {
            $useMinMax = false;
            if (isset($expenseTmplId['min'])) {
                $this->addUsingAlias(ExpenseTemplateMasterTableMap::COL_EXPENSE_TMPL_ID, $expenseTmplId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($expenseTmplId['max'])) {
                $this->addUsingAlias(ExpenseTemplateMasterTableMap::COL_EXPENSE_TMPL_ID, $expenseTmplId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpenseTemplateMasterTableMap::COL_EXPENSE_TMPL_ID, $expenseTmplId, $comparison);

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
                $this->addUsingAlias(ExpenseTemplateMasterTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(ExpenseTemplateMasterTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpenseTemplateMasterTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(ExpenseTemplateMasterTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(ExpenseTemplateMasterTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpenseTemplateMasterTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the expense_template_name column
     *
     * Example usage:
     * <code>
     * $query->filterByExpenseTemplateName('fooValue');   // WHERE expense_template_name = 'fooValue'
     * $query->filterByExpenseTemplateName('%fooValue%', Criteria::LIKE); // WHERE expense_template_name LIKE '%fooValue%'
     * $query->filterByExpenseTemplateName(['foo', 'bar']); // WHERE expense_template_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $expenseTemplateName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpenseTemplateName($expenseTemplateName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($expenseTemplateName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpenseTemplateMasterTableMap::COL_EXPENSE_TEMPLATE_NAME, $expenseTemplateName, $comparison);

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

        $this->addUsingAlias(ExpenseTemplateMasterTableMap::COL_EXPENSE_NAME, $expenseName, $comparison);

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

        $this->addUsingAlias(ExpenseTemplateMasterTableMap::COL_DEFAULT_POLICYKEY, $defaultPolicykey, $comparison);

        return $this;
    }

    /**
     * Filter the query on the checkcity column
     *
     * Example usage:
     * <code>
     * $query->filterByCheckcity(true); // WHERE checkcity = true
     * $query->filterByCheckcity('yes'); // WHERE checkcity = true
     * </code>
     *
     * @param bool|string $checkcity The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCheckcity($checkcity = null, ?string $comparison = null)
    {
        if (is_string($checkcity)) {
            $checkcity = in_array(strtolower($checkcity), array('false', 'off', '-', 'no', 'n', '0', ''), true) ? false : true;
        }

        $this->addUsingAlias(ExpenseTemplateMasterTableMap::COL_CHECKCITY, $checkcity, $comparison);

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

        $this->addUsingAlias(ExpenseTemplateMasterTableMap::COL_POLICYKEYA, $policykeya, $comparison);

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

        $this->addUsingAlias(ExpenseTemplateMasterTableMap::COL_POLICYKEYB, $policykeyb, $comparison);

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

        $this->addUsingAlias(ExpenseTemplateMasterTableMap::COL_POLICYKEYC, $policykeyc, $comparison);

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
                $this->addUsingAlias(ExpenseTemplateMasterTableMap::COL_TRIPS, $trips['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($trips['max'])) {
                $this->addUsingAlias(ExpenseTemplateMasterTableMap::COL_TRIPS, $trips['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExpenseTemplateMasterTableMap::COL_TRIPS, $trips, $comparison);

        return $this;
    }

    /**
     * Filter the query on the permonth column
     *
     * Example usage:
     * <code>
     * $query->filterByPermonth(true); // WHERE permonth = true
     * $query->filterByPermonth('yes'); // WHERE permonth = true
     * </code>
     *
     * @param bool|string $permonth The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPermonth($permonth = null, ?string $comparison = null)
    {
        if (is_string($permonth)) {
            $permonth = in_array(strtolower($permonth), array('false', 'off', '-', 'no', 'n', '0', ''), true) ? false : true;
        }

        $this->addUsingAlias(ExpenseTemplateMasterTableMap::COL_PERMONTH, $permonth, $comparison);

        return $this;
    }

    /**
     * Filter the query on the nonreimbursable column
     *
     * Example usage:
     * <code>
     * $query->filterByNonreimbursable(true); // WHERE nonreimbursable = true
     * $query->filterByNonreimbursable('yes'); // WHERE nonreimbursable = true
     * </code>
     *
     * @param bool|string $nonreimbursable The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByNonreimbursable($nonreimbursable = null, ?string $comparison = null)
    {
        if (is_string($nonreimbursable)) {
            $nonreimbursable = in_array(strtolower($nonreimbursable), array('false', 'off', '-', 'no', 'n', '0', ''), true) ? false : true;
        }

        $this->addUsingAlias(ExpenseTemplateMasterTableMap::COL_NONREIMBURSABLE, $nonreimbursable, $comparison);

        return $this;
    }

    /**
     * Filter the query on the isdaily column
     *
     * Example usage:
     * <code>
     * $query->filterByIsdaily(true); // WHERE isdaily = true
     * $query->filterByIsdaily('yes'); // WHERE isdaily = true
     * </code>
     *
     * @param bool|string $isdaily The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIsdaily($isdaily = null, ?string $comparison = null)
    {
        if (is_string($isdaily)) {
            $isdaily = in_array(strtolower($isdaily), array('false', 'off', '-', 'no', 'n', '0', ''), true) ? false : true;
        }

        $this->addUsingAlias(ExpenseTemplateMasterTableMap::COL_ISDAILY, $isdaily, $comparison);

        return $this;
    }

    /**
     * Filter the query on the israteapplied column
     *
     * Example usage:
     * <code>
     * $query->filterByIsrateapplied(true); // WHERE israteapplied = true
     * $query->filterByIsrateapplied('yes'); // WHERE israteapplied = true
     * </code>
     *
     * @param bool|string $israteapplied The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIsrateapplied($israteapplied = null, ?string $comparison = null)
    {
        if (is_string($israteapplied)) {
            $israteapplied = in_array(strtolower($israteapplied), array('false', 'off', '-', 'no', 'n', '0', ''), true) ? false : true;
        }

        $this->addUsingAlias(ExpenseTemplateMasterTableMap::COL_ISRATEAPPLIED, $israteapplied, $comparison);

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

        $this->addUsingAlias(ExpenseTemplateMasterTableMap::COL_RATE, $rate, $comparison);

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

        $this->addUsingAlias(ExpenseTemplateMasterTableMap::COL_MODE, $mode, $comparison);

        return $this;
    }

    /**
     * Filter the query on the commentreq column
     *
     * Example usage:
     * <code>
     * $query->filterByCommentreq(true); // WHERE commentreq = true
     * $query->filterByCommentreq('yes'); // WHERE commentreq = true
     * </code>
     *
     * @param bool|string $commentreq The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCommentreq($commentreq = null, ?string $comparison = null)
    {
        if (is_string($commentreq)) {
            $commentreq = in_array(strtolower($commentreq), array('false', 'off', '-', 'no', 'n', '0', ''), true) ? false : true;
        }

        $this->addUsingAlias(ExpenseTemplateMasterTableMap::COL_COMMENTREQ, $commentreq, $comparison);

        return $this;
    }

    /**
     * Filter the query on the additional_text column
     *
     * Example usage:
     * <code>
     * $query->filterByAdditionalText(true); // WHERE additional_text = true
     * $query->filterByAdditionalText('yes'); // WHERE additional_text = true
     * </code>
     *
     * @param bool|string $additionalText The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAdditionalText($additionalText = null, ?string $comparison = null)
    {
        if (is_string($additionalText)) {
            $additionalText = in_array(strtolower($additionalText), array('false', 'off', '-', 'no', 'n', '0', ''), true) ? false : true;
        }

        $this->addUsingAlias(ExpenseTemplateMasterTableMap::COL_ADDITIONAL_TEXT, $additionalText, $comparison);

        return $this;
    }

    /**
     * Filter the query on the is_prefilled column
     *
     * Example usage:
     * <code>
     * $query->filterByIsPrefilled(true); // WHERE is_prefilled = true
     * $query->filterByIsPrefilled('yes'); // WHERE is_prefilled = true
     * </code>
     *
     * @param bool|string $isPrefilled The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIsPrefilled($isPrefilled = null, ?string $comparison = null)
    {
        if (is_string($isPrefilled)) {
            $isPrefilled = in_array(strtolower($isPrefilled), array('false', 'off', '-', 'no', 'n', '0', ''), true) ? false : true;
        }

        $this->addUsingAlias(ExpenseTemplateMasterTableMap::COL_IS_PREFILLED, $isPrefilled, $comparison);

        return $this;
    }

    /**
     * Filter the query on the is_mandatory column
     *
     * Example usage:
     * <code>
     * $query->filterByIsMandatory(true); // WHERE is_mandatory = true
     * $query->filterByIsMandatory('yes'); // WHERE is_mandatory = true
     * </code>
     *
     * @param bool|string $isMandatory The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIsMandatory($isMandatory = null, ?string $comparison = null)
    {
        if (is_string($isMandatory)) {
            $isMandatory = in_array(strtolower($isMandatory), array('false', 'off', '-', 'no', 'n', '0', ''), true) ? false : true;
        }

        $this->addUsingAlias(ExpenseTemplateMasterTableMap::COL_IS_MANDATORY, $isMandatory, $comparison);

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildExpenseTemplateMaster $expenseTemplateMaster Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($expenseTemplateMaster = null)
    {
        if ($expenseTemplateMaster) {
            $this->addUsingAlias(ExpenseTemplateMasterTableMap::COL_EXPENSE_TMPL_ID, $expenseTemplateMaster->getExpenseTmplId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the expense_template_master table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ExpenseTemplateMasterTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ExpenseTemplateMasterTableMap::clearInstancePool();
            ExpenseTemplateMasterTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ExpenseTemplateMasterTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ExpenseTemplateMasterTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ExpenseTemplateMasterTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ExpenseTemplateMasterTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
