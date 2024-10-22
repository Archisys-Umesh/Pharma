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
use entities\Stp as ChildStp;
use entities\StpQuery as ChildStpQuery;
use entities\Map\StpTableMap;

/**
 * Base class that represents a query for the `stp` table.
 *
 * @method     ChildStpQuery orderByStpId($order = Criteria::ASC) Order by the stp_id column
 * @method     ChildStpQuery orderByPositionId($order = Criteria::ASC) Order by the position_id column
 * @method     ChildStpQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildStpQuery orderByStpStatus($order = Criteria::ASC) Order by the stp_status column
 * @method     ChildStpQuery orderByStpApprovedBy($order = Criteria::ASC) Order by the stp_approved_by column
 * @method     ChildStpQuery orderByApprovedDate($order = Criteria::ASC) Order by the approved_date column
 * @method     ChildStpQuery orderByRejectedReason($order = Criteria::ASC) Order by the rejected_reason column
 * @method     ChildStpQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildStpQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildStpQuery groupByStpId() Group by the stp_id column
 * @method     ChildStpQuery groupByPositionId() Group by the position_id column
 * @method     ChildStpQuery groupByCompanyId() Group by the company_id column
 * @method     ChildStpQuery groupByStpStatus() Group by the stp_status column
 * @method     ChildStpQuery groupByStpApprovedBy() Group by the stp_approved_by column
 * @method     ChildStpQuery groupByApprovedDate() Group by the approved_date column
 * @method     ChildStpQuery groupByRejectedReason() Group by the rejected_reason column
 * @method     ChildStpQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildStpQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildStpQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildStpQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildStpQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildStpQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildStpQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildStpQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildStpQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildStpQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildStpQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildStpQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildStpQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildStpQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildStpQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     ChildStpQuery leftJoinPositions($relationAlias = null) Adds a LEFT JOIN clause to the query using the Positions relation
 * @method     ChildStpQuery rightJoinPositions($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Positions relation
 * @method     ChildStpQuery innerJoinPositions($relationAlias = null) Adds a INNER JOIN clause to the query using the Positions relation
 *
 * @method     ChildStpQuery joinWithPositions($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Positions relation
 *
 * @method     ChildStpQuery leftJoinWithPositions() Adds a LEFT JOIN clause and with to the query using the Positions relation
 * @method     ChildStpQuery rightJoinWithPositions() Adds a RIGHT JOIN clause and with to the query using the Positions relation
 * @method     ChildStpQuery innerJoinWithPositions() Adds a INNER JOIN clause and with to the query using the Positions relation
 *
 * @method     ChildStpQuery leftJoinStpWeek($relationAlias = null) Adds a LEFT JOIN clause to the query using the StpWeek relation
 * @method     ChildStpQuery rightJoinStpWeek($relationAlias = null) Adds a RIGHT JOIN clause to the query using the StpWeek relation
 * @method     ChildStpQuery innerJoinStpWeek($relationAlias = null) Adds a INNER JOIN clause to the query using the StpWeek relation
 *
 * @method     ChildStpQuery joinWithStpWeek($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the StpWeek relation
 *
 * @method     ChildStpQuery leftJoinWithStpWeek() Adds a LEFT JOIN clause and with to the query using the StpWeek relation
 * @method     ChildStpQuery rightJoinWithStpWeek() Adds a RIGHT JOIN clause and with to the query using the StpWeek relation
 * @method     ChildStpQuery innerJoinWithStpWeek() Adds a INNER JOIN clause and with to the query using the StpWeek relation
 *
 * @method     \entities\CompanyQuery|\entities\PositionsQuery|\entities\StpWeekQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildStp|null findOne(?ConnectionInterface $con = null) Return the first ChildStp matching the query
 * @method     ChildStp findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildStp matching the query, or a new ChildStp object populated from the query conditions when no match is found
 *
 * @method     ChildStp|null findOneByStpId(int $stp_id) Return the first ChildStp filtered by the stp_id column
 * @method     ChildStp|null findOneByPositionId(int $position_id) Return the first ChildStp filtered by the position_id column
 * @method     ChildStp|null findOneByCompanyId(int $company_id) Return the first ChildStp filtered by the company_id column
 * @method     ChildStp|null findOneByStpStatus(string $stp_status) Return the first ChildStp filtered by the stp_status column
 * @method     ChildStp|null findOneByStpApprovedBy(int $stp_approved_by) Return the first ChildStp filtered by the stp_approved_by column
 * @method     ChildStp|null findOneByApprovedDate(string $approved_date) Return the first ChildStp filtered by the approved_date column
 * @method     ChildStp|null findOneByRejectedReason(string $rejected_reason) Return the first ChildStp filtered by the rejected_reason column
 * @method     ChildStp|null findOneByCreatedAt(string $created_at) Return the first ChildStp filtered by the created_at column
 * @method     ChildStp|null findOneByUpdatedAt(string $updated_at) Return the first ChildStp filtered by the updated_at column
 *
 * @method     ChildStp requirePk($key, ?ConnectionInterface $con = null) Return the ChildStp by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStp requireOne(?ConnectionInterface $con = null) Return the first ChildStp matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildStp requireOneByStpId(int $stp_id) Return the first ChildStp filtered by the stp_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStp requireOneByPositionId(int $position_id) Return the first ChildStp filtered by the position_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStp requireOneByCompanyId(int $company_id) Return the first ChildStp filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStp requireOneByStpStatus(string $stp_status) Return the first ChildStp filtered by the stp_status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStp requireOneByStpApprovedBy(int $stp_approved_by) Return the first ChildStp filtered by the stp_approved_by column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStp requireOneByApprovedDate(string $approved_date) Return the first ChildStp filtered by the approved_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStp requireOneByRejectedReason(string $rejected_reason) Return the first ChildStp filtered by the rejected_reason column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStp requireOneByCreatedAt(string $created_at) Return the first ChildStp filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStp requireOneByUpdatedAt(string $updated_at) Return the first ChildStp filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildStp[]|Collection find(?ConnectionInterface $con = null) Return ChildStp objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildStp> find(?ConnectionInterface $con = null) Return ChildStp objects based on current ModelCriteria
 *
 * @method     ChildStp[]|Collection findByStpId(int|array<int> $stp_id) Return ChildStp objects filtered by the stp_id column
 * @psalm-method Collection&\Traversable<ChildStp> findByStpId(int|array<int> $stp_id) Return ChildStp objects filtered by the stp_id column
 * @method     ChildStp[]|Collection findByPositionId(int|array<int> $position_id) Return ChildStp objects filtered by the position_id column
 * @psalm-method Collection&\Traversable<ChildStp> findByPositionId(int|array<int> $position_id) Return ChildStp objects filtered by the position_id column
 * @method     ChildStp[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildStp objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildStp> findByCompanyId(int|array<int> $company_id) Return ChildStp objects filtered by the company_id column
 * @method     ChildStp[]|Collection findByStpStatus(string|array<string> $stp_status) Return ChildStp objects filtered by the stp_status column
 * @psalm-method Collection&\Traversable<ChildStp> findByStpStatus(string|array<string> $stp_status) Return ChildStp objects filtered by the stp_status column
 * @method     ChildStp[]|Collection findByStpApprovedBy(int|array<int> $stp_approved_by) Return ChildStp objects filtered by the stp_approved_by column
 * @psalm-method Collection&\Traversable<ChildStp> findByStpApprovedBy(int|array<int> $stp_approved_by) Return ChildStp objects filtered by the stp_approved_by column
 * @method     ChildStp[]|Collection findByApprovedDate(string|array<string> $approved_date) Return ChildStp objects filtered by the approved_date column
 * @psalm-method Collection&\Traversable<ChildStp> findByApprovedDate(string|array<string> $approved_date) Return ChildStp objects filtered by the approved_date column
 * @method     ChildStp[]|Collection findByRejectedReason(string|array<string> $rejected_reason) Return ChildStp objects filtered by the rejected_reason column
 * @psalm-method Collection&\Traversable<ChildStp> findByRejectedReason(string|array<string> $rejected_reason) Return ChildStp objects filtered by the rejected_reason column
 * @method     ChildStp[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildStp objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildStp> findByCreatedAt(string|array<string> $created_at) Return ChildStp objects filtered by the created_at column
 * @method     ChildStp[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildStp objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildStp> findByUpdatedAt(string|array<string> $updated_at) Return ChildStp objects filtered by the updated_at column
 *
 * @method     ChildStp[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildStp> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class StpQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\StpQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\Stp', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildStpQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildStpQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildStpQuery) {
            return $criteria;
        }
        $query = new ChildStpQuery();
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
     * @return ChildStp|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(StpTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = StpTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildStp A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT stp_id, position_id, company_id, stp_status, stp_approved_by, approved_date, rejected_reason, created_at, updated_at FROM stp WHERE stp_id = :p0';
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
            /** @var ChildStp $obj */
            $obj = new ChildStp();
            $obj->hydrate($row);
            StpTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildStp|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(StpTableMap::COL_STP_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(StpTableMap::COL_STP_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the stp_id column
     *
     * Example usage:
     * <code>
     * $query->filterByStpId(1234); // WHERE stp_id = 1234
     * $query->filterByStpId(array(12, 34)); // WHERE stp_id IN (12, 34)
     * $query->filterByStpId(array('min' => 12)); // WHERE stp_id > 12
     * </code>
     *
     * @param mixed $stpId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStpId($stpId = null, ?string $comparison = null)
    {
        if (is_array($stpId)) {
            $useMinMax = false;
            if (isset($stpId['min'])) {
                $this->addUsingAlias(StpTableMap::COL_STP_ID, $stpId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($stpId['max'])) {
                $this->addUsingAlias(StpTableMap::COL_STP_ID, $stpId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StpTableMap::COL_STP_ID, $stpId, $comparison);

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
     * @see       filterByPositions()
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
                $this->addUsingAlias(StpTableMap::COL_POSITION_ID, $positionId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($positionId['max'])) {
                $this->addUsingAlias(StpTableMap::COL_POSITION_ID, $positionId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StpTableMap::COL_POSITION_ID, $positionId, $comparison);

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
                $this->addUsingAlias(StpTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(StpTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StpTableMap::COL_COMPANY_ID, $companyId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the stp_status column
     *
     * Example usage:
     * <code>
     * $query->filterByStpStatus('fooValue');   // WHERE stp_status = 'fooValue'
     * $query->filterByStpStatus('%fooValue%', Criteria::LIKE); // WHERE stp_status LIKE '%fooValue%'
     * $query->filterByStpStatus(['foo', 'bar']); // WHERE stp_status IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $stpStatus The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStpStatus($stpStatus = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($stpStatus)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StpTableMap::COL_STP_STATUS, $stpStatus, $comparison);

        return $this;
    }

    /**
     * Filter the query on the stp_approved_by column
     *
     * Example usage:
     * <code>
     * $query->filterByStpApprovedBy(1234); // WHERE stp_approved_by = 1234
     * $query->filterByStpApprovedBy(array(12, 34)); // WHERE stp_approved_by IN (12, 34)
     * $query->filterByStpApprovedBy(array('min' => 12)); // WHERE stp_approved_by > 12
     * </code>
     *
     * @param mixed $stpApprovedBy The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStpApprovedBy($stpApprovedBy = null, ?string $comparison = null)
    {
        if (is_array($stpApprovedBy)) {
            $useMinMax = false;
            if (isset($stpApprovedBy['min'])) {
                $this->addUsingAlias(StpTableMap::COL_STP_APPROVED_BY, $stpApprovedBy['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($stpApprovedBy['max'])) {
                $this->addUsingAlias(StpTableMap::COL_STP_APPROVED_BY, $stpApprovedBy['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StpTableMap::COL_STP_APPROVED_BY, $stpApprovedBy, $comparison);

        return $this;
    }

    /**
     * Filter the query on the approved_date column
     *
     * Example usage:
     * <code>
     * $query->filterByApprovedDate('2011-03-14'); // WHERE approved_date = '2011-03-14'
     * $query->filterByApprovedDate('now'); // WHERE approved_date = '2011-03-14'
     * $query->filterByApprovedDate(array('max' => 'yesterday')); // WHERE approved_date > '2011-03-13'
     * </code>
     *
     * @param mixed $approvedDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByApprovedDate($approvedDate = null, ?string $comparison = null)
    {
        if (is_array($approvedDate)) {
            $useMinMax = false;
            if (isset($approvedDate['min'])) {
                $this->addUsingAlias(StpTableMap::COL_APPROVED_DATE, $approvedDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($approvedDate['max'])) {
                $this->addUsingAlias(StpTableMap::COL_APPROVED_DATE, $approvedDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StpTableMap::COL_APPROVED_DATE, $approvedDate, $comparison);

        return $this;
    }

    /**
     * Filter the query on the rejected_reason column
     *
     * Example usage:
     * <code>
     * $query->filterByRejectedReason('fooValue');   // WHERE rejected_reason = 'fooValue'
     * $query->filterByRejectedReason('%fooValue%', Criteria::LIKE); // WHERE rejected_reason LIKE '%fooValue%'
     * $query->filterByRejectedReason(['foo', 'bar']); // WHERE rejected_reason IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $rejectedReason The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRejectedReason($rejectedReason = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($rejectedReason)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StpTableMap::COL_REJECTED_REASON, $rejectedReason, $comparison);

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
                $this->addUsingAlias(StpTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(StpTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StpTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(StpTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(StpTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StpTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

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
                ->addUsingAlias(StpTableMap::COL_COMPANY_ID, $company->getCompanyId(), $comparison);
        } elseif ($company instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(StpTableMap::COL_COMPANY_ID, $company->toKeyValue('PrimaryKey', 'CompanyId'), $comparison);

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
     * Filter the query by a related \entities\Positions object
     *
     * @param \entities\Positions|ObjectCollection $positions The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPositions($positions, ?string $comparison = null)
    {
        if ($positions instanceof \entities\Positions) {
            return $this
                ->addUsingAlias(StpTableMap::COL_POSITION_ID, $positions->getPositionId(), $comparison);
        } elseif ($positions instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(StpTableMap::COL_POSITION_ID, $positions->toKeyValue('PrimaryKey', 'PositionId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByPositions() only accepts arguments of type \entities\Positions or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Positions relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinPositions(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Positions');

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
            $this->addJoinObject($join, 'Positions');
        }

        return $this;
    }

    /**
     * Use the Positions relation Positions object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\PositionsQuery A secondary query class using the current class as primary query
     */
    public function usePositionsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPositions($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Positions', '\entities\PositionsQuery');
    }

    /**
     * Use the Positions relation Positions object
     *
     * @param callable(\entities\PositionsQuery):\entities\PositionsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withPositionsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->usePositionsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Positions table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\PositionsQuery The inner query object of the EXISTS statement
     */
    public function usePositionsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\PositionsQuery */
        $q = $this->useExistsQuery('Positions', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Positions table for a NOT EXISTS query.
     *
     * @see usePositionsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\PositionsQuery The inner query object of the NOT EXISTS statement
     */
    public function usePositionsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\PositionsQuery */
        $q = $this->useExistsQuery('Positions', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Positions table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\PositionsQuery The inner query object of the IN statement
     */
    public function useInPositionsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\PositionsQuery */
        $q = $this->useInQuery('Positions', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Positions table for a NOT IN query.
     *
     * @see usePositionsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\PositionsQuery The inner query object of the NOT IN statement
     */
    public function useNotInPositionsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\PositionsQuery */
        $q = $this->useInQuery('Positions', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\StpWeek object
     *
     * @param \entities\StpWeek|ObjectCollection $stpWeek the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStpWeek($stpWeek, ?string $comparison = null)
    {
        if ($stpWeek instanceof \entities\StpWeek) {
            $this
                ->addUsingAlias(StpTableMap::COL_STP_ID, $stpWeek->getStpId(), $comparison);

            return $this;
        } elseif ($stpWeek instanceof ObjectCollection) {
            $this
                ->useStpWeekQuery()
                ->filterByPrimaryKeys($stpWeek->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByStpWeek() only accepts arguments of type \entities\StpWeek or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the StpWeek relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinStpWeek(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('StpWeek');

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
            $this->addJoinObject($join, 'StpWeek');
        }

        return $this;
    }

    /**
     * Use the StpWeek relation StpWeek object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\StpWeekQuery A secondary query class using the current class as primary query
     */
    public function useStpWeekQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinStpWeek($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'StpWeek', '\entities\StpWeekQuery');
    }

    /**
     * Use the StpWeek relation StpWeek object
     *
     * @param callable(\entities\StpWeekQuery):\entities\StpWeekQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withStpWeekQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useStpWeekQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to StpWeek table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\StpWeekQuery The inner query object of the EXISTS statement
     */
    public function useStpWeekExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\StpWeekQuery */
        $q = $this->useExistsQuery('StpWeek', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to StpWeek table for a NOT EXISTS query.
     *
     * @see useStpWeekExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\StpWeekQuery The inner query object of the NOT EXISTS statement
     */
    public function useStpWeekNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\StpWeekQuery */
        $q = $this->useExistsQuery('StpWeek', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to StpWeek table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\StpWeekQuery The inner query object of the IN statement
     */
    public function useInStpWeekQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\StpWeekQuery */
        $q = $this->useInQuery('StpWeek', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to StpWeek table for a NOT IN query.
     *
     * @see useStpWeekInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\StpWeekQuery The inner query object of the NOT IN statement
     */
    public function useNotInStpWeekQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\StpWeekQuery */
        $q = $this->useInQuery('StpWeek', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildStp $stp Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($stp = null)
    {
        if ($stp) {
            $this->addUsingAlias(StpTableMap::COL_STP_ID, $stp->getStpId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the stp table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(StpTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            StpTableMap::clearInstancePool();
            StpTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(StpTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(StpTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            StpTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            StpTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
