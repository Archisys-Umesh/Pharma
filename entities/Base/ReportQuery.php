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
use entities\Report as ChildReport;
use entities\ReportQuery as ChildReportQuery;
use entities\Map\ReportTableMap;

/**
 * Base class that represents a query for the `report` table.
 *
 * @method     ChildReportQuery orderBySr($order = Criteria::ASC) Order by the sr column
 * @method     ChildReportQuery orderByEmployee($order = Criteria::ASC) Order by the employee column
 * @method     ChildReportQuery orderByDesignation($order = Criteria::ASC) Order by the designation column
 * @method     ChildReportQuery orderByReporting($order = Criteria::ASC) Order by the reporting column
 * @method     ChildReportQuery orderByMobile($order = Criteria::ASC) Order by the mobile column
 * @method     ChildReportQuery orderByAddedOn($order = Criteria::ASC) Order by the added_on column
 * @method     ChildReportQuery orderByStatus($order = Criteria::ASC) Order by the status column
 *
 * @method     ChildReportQuery groupBySr() Group by the sr column
 * @method     ChildReportQuery groupByEmployee() Group by the employee column
 * @method     ChildReportQuery groupByDesignation() Group by the designation column
 * @method     ChildReportQuery groupByReporting() Group by the reporting column
 * @method     ChildReportQuery groupByMobile() Group by the mobile column
 * @method     ChildReportQuery groupByAddedOn() Group by the added_on column
 * @method     ChildReportQuery groupByStatus() Group by the status column
 *
 * @method     ChildReportQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildReportQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildReportQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildReportQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildReportQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildReportQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildReport|null findOne(?ConnectionInterface $con = null) Return the first ChildReport matching the query
 * @method     ChildReport findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildReport matching the query, or a new ChildReport object populated from the query conditions when no match is found
 *
 * @method     ChildReport|null findOneBySr(int $sr) Return the first ChildReport filtered by the sr column
 * @method     ChildReport|null findOneByEmployee(string $employee) Return the first ChildReport filtered by the employee column
 * @method     ChildReport|null findOneByDesignation(string $designation) Return the first ChildReport filtered by the designation column
 * @method     ChildReport|null findOneByReporting(string $reporting) Return the first ChildReport filtered by the reporting column
 * @method     ChildReport|null findOneByMobile(int $mobile) Return the first ChildReport filtered by the mobile column
 * @method     ChildReport|null findOneByAddedOn(string $added_on) Return the first ChildReport filtered by the added_on column
 * @method     ChildReport|null findOneByStatus(string $status) Return the first ChildReport filtered by the status column
 *
 * @method     ChildReport requirePk($key, ?ConnectionInterface $con = null) Return the ChildReport by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReport requireOne(?ConnectionInterface $con = null) Return the first ChildReport matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildReport requireOneBySr(int $sr) Return the first ChildReport filtered by the sr column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReport requireOneByEmployee(string $employee) Return the first ChildReport filtered by the employee column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReport requireOneByDesignation(string $designation) Return the first ChildReport filtered by the designation column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReport requireOneByReporting(string $reporting) Return the first ChildReport filtered by the reporting column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReport requireOneByMobile(int $mobile) Return the first ChildReport filtered by the mobile column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReport requireOneByAddedOn(string $added_on) Return the first ChildReport filtered by the added_on column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReport requireOneByStatus(string $status) Return the first ChildReport filtered by the status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildReport[]|Collection find(?ConnectionInterface $con = null) Return ChildReport objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildReport> find(?ConnectionInterface $con = null) Return ChildReport objects based on current ModelCriteria
 *
 * @method     ChildReport[]|Collection findBySr(int|array<int> $sr) Return ChildReport objects filtered by the sr column
 * @psalm-method Collection&\Traversable<ChildReport> findBySr(int|array<int> $sr) Return ChildReport objects filtered by the sr column
 * @method     ChildReport[]|Collection findByEmployee(string|array<string> $employee) Return ChildReport objects filtered by the employee column
 * @psalm-method Collection&\Traversable<ChildReport> findByEmployee(string|array<string> $employee) Return ChildReport objects filtered by the employee column
 * @method     ChildReport[]|Collection findByDesignation(string|array<string> $designation) Return ChildReport objects filtered by the designation column
 * @psalm-method Collection&\Traversable<ChildReport> findByDesignation(string|array<string> $designation) Return ChildReport objects filtered by the designation column
 * @method     ChildReport[]|Collection findByReporting(string|array<string> $reporting) Return ChildReport objects filtered by the reporting column
 * @psalm-method Collection&\Traversable<ChildReport> findByReporting(string|array<string> $reporting) Return ChildReport objects filtered by the reporting column
 * @method     ChildReport[]|Collection findByMobile(int|array<int> $mobile) Return ChildReport objects filtered by the mobile column
 * @psalm-method Collection&\Traversable<ChildReport> findByMobile(int|array<int> $mobile) Return ChildReport objects filtered by the mobile column
 * @method     ChildReport[]|Collection findByAddedOn(string|array<string> $added_on) Return ChildReport objects filtered by the added_on column
 * @psalm-method Collection&\Traversable<ChildReport> findByAddedOn(string|array<string> $added_on) Return ChildReport objects filtered by the added_on column
 * @method     ChildReport[]|Collection findByStatus(string|array<string> $status) Return ChildReport objects filtered by the status column
 * @psalm-method Collection&\Traversable<ChildReport> findByStatus(string|array<string> $status) Return ChildReport objects filtered by the status column
 *
 * @method     ChildReport[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildReport> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class ReportQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\ReportQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\Report', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildReportQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildReportQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildReportQuery) {
            return $criteria;
        }
        $query = new ChildReportQuery();
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
     * @return ChildReport|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ReportTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ReportTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildReport A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT sr, employee, designation, reporting, mobile, added_on, status FROM report WHERE sr = :p0';
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
            /** @var ChildReport $obj */
            $obj = new ChildReport();
            $obj->hydrate($row);
            ReportTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildReport|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(ReportTableMap::COL_SR, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(ReportTableMap::COL_SR, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the sr column
     *
     * Example usage:
     * <code>
     * $query->filterBySr(1234); // WHERE sr = 1234
     * $query->filterBySr(array(12, 34)); // WHERE sr IN (12, 34)
     * $query->filterBySr(array('min' => 12)); // WHERE sr > 12
     * </code>
     *
     * @param mixed $sr The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySr($sr = null, ?string $comparison = null)
    {
        if (is_array($sr)) {
            $useMinMax = false;
            if (isset($sr['min'])) {
                $this->addUsingAlias(ReportTableMap::COL_SR, $sr['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($sr['max'])) {
                $this->addUsingAlias(ReportTableMap::COL_SR, $sr['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ReportTableMap::COL_SR, $sr, $comparison);

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

        $this->addUsingAlias(ReportTableMap::COL_EMPLOYEE, $employee, $comparison);

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

        $this->addUsingAlias(ReportTableMap::COL_DESIGNATION, $designation, $comparison);

        return $this;
    }

    /**
     * Filter the query on the reporting column
     *
     * Example usage:
     * <code>
     * $query->filterByReporting('fooValue');   // WHERE reporting = 'fooValue'
     * $query->filterByReporting('%fooValue%', Criteria::LIKE); // WHERE reporting LIKE '%fooValue%'
     * $query->filterByReporting(['foo', 'bar']); // WHERE reporting IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $reporting The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByReporting($reporting = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($reporting)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ReportTableMap::COL_REPORTING, $reporting, $comparison);

        return $this;
    }

    /**
     * Filter the query on the mobile column
     *
     * Example usage:
     * <code>
     * $query->filterByMobile(1234); // WHERE mobile = 1234
     * $query->filterByMobile(array(12, 34)); // WHERE mobile IN (12, 34)
     * $query->filterByMobile(array('min' => 12)); // WHERE mobile > 12
     * </code>
     *
     * @param mixed $mobile The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMobile($mobile = null, ?string $comparison = null)
    {
        if (is_array($mobile)) {
            $useMinMax = false;
            if (isset($mobile['min'])) {
                $this->addUsingAlias(ReportTableMap::COL_MOBILE, $mobile['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($mobile['max'])) {
                $this->addUsingAlias(ReportTableMap::COL_MOBILE, $mobile['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ReportTableMap::COL_MOBILE, $mobile, $comparison);

        return $this;
    }

    /**
     * Filter the query on the added_on column
     *
     * Example usage:
     * <code>
     * $query->filterByAddedOn('2011-03-14'); // WHERE added_on = '2011-03-14'
     * $query->filterByAddedOn('now'); // WHERE added_on = '2011-03-14'
     * $query->filterByAddedOn(array('max' => 'yesterday')); // WHERE added_on > '2011-03-13'
     * </code>
     *
     * @param mixed $addedOn The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAddedOn($addedOn = null, ?string $comparison = null)
    {
        if (is_array($addedOn)) {
            $useMinMax = false;
            if (isset($addedOn['min'])) {
                $this->addUsingAlias(ReportTableMap::COL_ADDED_ON, $addedOn['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($addedOn['max'])) {
                $this->addUsingAlias(ReportTableMap::COL_ADDED_ON, $addedOn['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ReportTableMap::COL_ADDED_ON, $addedOn, $comparison);

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

        $this->addUsingAlias(ReportTableMap::COL_STATUS, $status, $comparison);

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildReport $report Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($report = null)
    {
        if ($report) {
            $this->addUsingAlias(ReportTableMap::COL_SR, $report->getSr(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the report table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ReportTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ReportTableMap::clearInstancePool();
            ReportTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ReportTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ReportTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ReportTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ReportTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
