<?php

namespace entities\Base;

use \Exception;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\LogicException;
use entities\JwReportView as ChildJwReportView;
use entities\JwReportViewQuery as ChildJwReportViewQuery;
use entities\Map\JwReportViewTableMap;

/**
 * Base class that represents a query for the `jw_report_view` table.
 *
 * @method     ChildJwReportViewQuery orderByUserPositionCode($order = Criteria::ASC) Order by the user_position_code column
 * @method     ChildJwReportViewQuery orderByUserHqName($order = Criteria::ASC) Order by the user_hq_name column
 * @method     ChildJwReportViewQuery orderByUserName($order = Criteria::ASC) Order by the user_name column
 * @method     ChildJwReportViewQuery orderByUserEmpCode($order = Criteria::ASC) Order by the user_emp_code column
 * @method     ChildJwReportViewQuery orderByUserLevel($order = Criteria::ASC) Order by the user_level column
 * @method     ChildJwReportViewQuery orderByJwHqName($order = Criteria::ASC) Order by the jw_hq_name column
 * @method     ChildJwReportViewQuery orderByJwEmployeeName($order = Criteria::ASC) Order by the jw_employee_name column
 * @method     ChildJwReportViewQuery orderByJwEmpCode($order = Criteria::ASC) Order by the jw_emp_code column
 * @method     ChildJwReportViewQuery orderByJwPositionCode($order = Criteria::ASC) Order by the jw_position_code column
 * @method     ChildJwReportViewQuery orderByJwEmpLevel($order = Criteria::ASC) Order by the jw_emp_level column
 * @method     ChildJwReportViewQuery orderByNoOfJwDaysWorked($order = Criteria::ASC) Order by the no_of_jw_days_worked column
 * @method     ChildJwReportViewQuery orderByNoOfCallsJw($order = Criteria::ASC) Order by the no_of_calls_jw column
 * @method     ChildJwReportViewQuery orderByCallAverage($order = Criteria::ASC) Order by the call_average column
 * @method     ChildJwReportViewQuery orderByMonthYear($order = Criteria::ASC) Order by the month_year column
 *
 * @method     ChildJwReportViewQuery groupByUserPositionCode() Group by the user_position_code column
 * @method     ChildJwReportViewQuery groupByUserHqName() Group by the user_hq_name column
 * @method     ChildJwReportViewQuery groupByUserName() Group by the user_name column
 * @method     ChildJwReportViewQuery groupByUserEmpCode() Group by the user_emp_code column
 * @method     ChildJwReportViewQuery groupByUserLevel() Group by the user_level column
 * @method     ChildJwReportViewQuery groupByJwHqName() Group by the jw_hq_name column
 * @method     ChildJwReportViewQuery groupByJwEmployeeName() Group by the jw_employee_name column
 * @method     ChildJwReportViewQuery groupByJwEmpCode() Group by the jw_emp_code column
 * @method     ChildJwReportViewQuery groupByJwPositionCode() Group by the jw_position_code column
 * @method     ChildJwReportViewQuery groupByJwEmpLevel() Group by the jw_emp_level column
 * @method     ChildJwReportViewQuery groupByNoOfJwDaysWorked() Group by the no_of_jw_days_worked column
 * @method     ChildJwReportViewQuery groupByNoOfCallsJw() Group by the no_of_calls_jw column
 * @method     ChildJwReportViewQuery groupByCallAverage() Group by the call_average column
 * @method     ChildJwReportViewQuery groupByMonthYear() Group by the month_year column
 *
 * @method     ChildJwReportViewQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildJwReportViewQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildJwReportViewQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildJwReportViewQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildJwReportViewQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildJwReportViewQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildJwReportView|null findOne(?ConnectionInterface $con = null) Return the first ChildJwReportView matching the query
 * @method     ChildJwReportView findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildJwReportView matching the query, or a new ChildJwReportView object populated from the query conditions when no match is found
 *
 * @method     ChildJwReportView|null findOneByUserPositionCode(string $user_position_code) Return the first ChildJwReportView filtered by the user_position_code column
 * @method     ChildJwReportView|null findOneByUserHqName(string $user_hq_name) Return the first ChildJwReportView filtered by the user_hq_name column
 * @method     ChildJwReportView|null findOneByUserName(string $user_name) Return the first ChildJwReportView filtered by the user_name column
 * @method     ChildJwReportView|null findOneByUserEmpCode(string $user_emp_code) Return the first ChildJwReportView filtered by the user_emp_code column
 * @method     ChildJwReportView|null findOneByUserLevel(string $user_level) Return the first ChildJwReportView filtered by the user_level column
 * @method     ChildJwReportView|null findOneByJwHqName(string $jw_hq_name) Return the first ChildJwReportView filtered by the jw_hq_name column
 * @method     ChildJwReportView|null findOneByJwEmployeeName(string $jw_employee_name) Return the first ChildJwReportView filtered by the jw_employee_name column
 * @method     ChildJwReportView|null findOneByJwEmpCode(string $jw_emp_code) Return the first ChildJwReportView filtered by the jw_emp_code column
 * @method     ChildJwReportView|null findOneByJwPositionCode(string $jw_position_code) Return the first ChildJwReportView filtered by the jw_position_code column
 * @method     ChildJwReportView|null findOneByJwEmpLevel(string $jw_emp_level) Return the first ChildJwReportView filtered by the jw_emp_level column
 * @method     ChildJwReportView|null findOneByNoOfJwDaysWorked(int $no_of_jw_days_worked) Return the first ChildJwReportView filtered by the no_of_jw_days_worked column
 * @method     ChildJwReportView|null findOneByNoOfCallsJw(int $no_of_calls_jw) Return the first ChildJwReportView filtered by the no_of_calls_jw column
 * @method     ChildJwReportView|null findOneByCallAverage(string $call_average) Return the first ChildJwReportView filtered by the call_average column
 * @method     ChildJwReportView|null findOneByMonthYear(string $month_year) Return the first ChildJwReportView filtered by the month_year column
 *
 * @method     ChildJwReportView requirePk($key, ?ConnectionInterface $con = null) Return the ChildJwReportView by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJwReportView requireOne(?ConnectionInterface $con = null) Return the first ChildJwReportView matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildJwReportView requireOneByUserPositionCode(string $user_position_code) Return the first ChildJwReportView filtered by the user_position_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJwReportView requireOneByUserHqName(string $user_hq_name) Return the first ChildJwReportView filtered by the user_hq_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJwReportView requireOneByUserName(string $user_name) Return the first ChildJwReportView filtered by the user_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJwReportView requireOneByUserEmpCode(string $user_emp_code) Return the first ChildJwReportView filtered by the user_emp_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJwReportView requireOneByUserLevel(string $user_level) Return the first ChildJwReportView filtered by the user_level column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJwReportView requireOneByJwHqName(string $jw_hq_name) Return the first ChildJwReportView filtered by the jw_hq_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJwReportView requireOneByJwEmployeeName(string $jw_employee_name) Return the first ChildJwReportView filtered by the jw_employee_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJwReportView requireOneByJwEmpCode(string $jw_emp_code) Return the first ChildJwReportView filtered by the jw_emp_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJwReportView requireOneByJwPositionCode(string $jw_position_code) Return the first ChildJwReportView filtered by the jw_position_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJwReportView requireOneByJwEmpLevel(string $jw_emp_level) Return the first ChildJwReportView filtered by the jw_emp_level column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJwReportView requireOneByNoOfJwDaysWorked(int $no_of_jw_days_worked) Return the first ChildJwReportView filtered by the no_of_jw_days_worked column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJwReportView requireOneByNoOfCallsJw(int $no_of_calls_jw) Return the first ChildJwReportView filtered by the no_of_calls_jw column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJwReportView requireOneByCallAverage(string $call_average) Return the first ChildJwReportView filtered by the call_average column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJwReportView requireOneByMonthYear(string $month_year) Return the first ChildJwReportView filtered by the month_year column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildJwReportView[]|Collection find(?ConnectionInterface $con = null) Return ChildJwReportView objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildJwReportView> find(?ConnectionInterface $con = null) Return ChildJwReportView objects based on current ModelCriteria
 *
 * @method     ChildJwReportView[]|Collection findByUserPositionCode(string|array<string> $user_position_code) Return ChildJwReportView objects filtered by the user_position_code column
 * @psalm-method Collection&\Traversable<ChildJwReportView> findByUserPositionCode(string|array<string> $user_position_code) Return ChildJwReportView objects filtered by the user_position_code column
 * @method     ChildJwReportView[]|Collection findByUserHqName(string|array<string> $user_hq_name) Return ChildJwReportView objects filtered by the user_hq_name column
 * @psalm-method Collection&\Traversable<ChildJwReportView> findByUserHqName(string|array<string> $user_hq_name) Return ChildJwReportView objects filtered by the user_hq_name column
 * @method     ChildJwReportView[]|Collection findByUserName(string|array<string> $user_name) Return ChildJwReportView objects filtered by the user_name column
 * @psalm-method Collection&\Traversable<ChildJwReportView> findByUserName(string|array<string> $user_name) Return ChildJwReportView objects filtered by the user_name column
 * @method     ChildJwReportView[]|Collection findByUserEmpCode(string|array<string> $user_emp_code) Return ChildJwReportView objects filtered by the user_emp_code column
 * @psalm-method Collection&\Traversable<ChildJwReportView> findByUserEmpCode(string|array<string> $user_emp_code) Return ChildJwReportView objects filtered by the user_emp_code column
 * @method     ChildJwReportView[]|Collection findByUserLevel(string|array<string> $user_level) Return ChildJwReportView objects filtered by the user_level column
 * @psalm-method Collection&\Traversable<ChildJwReportView> findByUserLevel(string|array<string> $user_level) Return ChildJwReportView objects filtered by the user_level column
 * @method     ChildJwReportView[]|Collection findByJwHqName(string|array<string> $jw_hq_name) Return ChildJwReportView objects filtered by the jw_hq_name column
 * @psalm-method Collection&\Traversable<ChildJwReportView> findByJwHqName(string|array<string> $jw_hq_name) Return ChildJwReportView objects filtered by the jw_hq_name column
 * @method     ChildJwReportView[]|Collection findByJwEmployeeName(string|array<string> $jw_employee_name) Return ChildJwReportView objects filtered by the jw_employee_name column
 * @psalm-method Collection&\Traversable<ChildJwReportView> findByJwEmployeeName(string|array<string> $jw_employee_name) Return ChildJwReportView objects filtered by the jw_employee_name column
 * @method     ChildJwReportView[]|Collection findByJwEmpCode(string|array<string> $jw_emp_code) Return ChildJwReportView objects filtered by the jw_emp_code column
 * @psalm-method Collection&\Traversable<ChildJwReportView> findByJwEmpCode(string|array<string> $jw_emp_code) Return ChildJwReportView objects filtered by the jw_emp_code column
 * @method     ChildJwReportView[]|Collection findByJwPositionCode(string|array<string> $jw_position_code) Return ChildJwReportView objects filtered by the jw_position_code column
 * @psalm-method Collection&\Traversable<ChildJwReportView> findByJwPositionCode(string|array<string> $jw_position_code) Return ChildJwReportView objects filtered by the jw_position_code column
 * @method     ChildJwReportView[]|Collection findByJwEmpLevel(string|array<string> $jw_emp_level) Return ChildJwReportView objects filtered by the jw_emp_level column
 * @psalm-method Collection&\Traversable<ChildJwReportView> findByJwEmpLevel(string|array<string> $jw_emp_level) Return ChildJwReportView objects filtered by the jw_emp_level column
 * @method     ChildJwReportView[]|Collection findByNoOfJwDaysWorked(int|array<int> $no_of_jw_days_worked) Return ChildJwReportView objects filtered by the no_of_jw_days_worked column
 * @psalm-method Collection&\Traversable<ChildJwReportView> findByNoOfJwDaysWorked(int|array<int> $no_of_jw_days_worked) Return ChildJwReportView objects filtered by the no_of_jw_days_worked column
 * @method     ChildJwReportView[]|Collection findByNoOfCallsJw(int|array<int> $no_of_calls_jw) Return ChildJwReportView objects filtered by the no_of_calls_jw column
 * @psalm-method Collection&\Traversable<ChildJwReportView> findByNoOfCallsJw(int|array<int> $no_of_calls_jw) Return ChildJwReportView objects filtered by the no_of_calls_jw column
 * @method     ChildJwReportView[]|Collection findByCallAverage(string|array<string> $call_average) Return ChildJwReportView objects filtered by the call_average column
 * @psalm-method Collection&\Traversable<ChildJwReportView> findByCallAverage(string|array<string> $call_average) Return ChildJwReportView objects filtered by the call_average column
 * @method     ChildJwReportView[]|Collection findByMonthYear(string|array<string> $month_year) Return ChildJwReportView objects filtered by the month_year column
 * @psalm-method Collection&\Traversable<ChildJwReportView> findByMonthYear(string|array<string> $month_year) Return ChildJwReportView objects filtered by the month_year column
 *
 * @method     ChildJwReportView[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildJwReportView> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class JwReportViewQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\JwReportViewQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\JwReportView', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildJwReportViewQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildJwReportViewQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildJwReportViewQuery) {
            return $criteria;
        }
        $query = new ChildJwReportViewQuery();
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
     * @return ChildJwReportView|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        throw new LogicException('The JwReportView object has no primary key');
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
        throw new LogicException('The JwReportView object has no primary key');
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
        throw new LogicException('The JwReportView object has no primary key');
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
        throw new LogicException('The JwReportView object has no primary key');
    }

    /**
     * Filter the query on the user_position_code column
     *
     * Example usage:
     * <code>
     * $query->filterByUserPositionCode('fooValue');   // WHERE user_position_code = 'fooValue'
     * $query->filterByUserPositionCode('%fooValue%', Criteria::LIKE); // WHERE user_position_code LIKE '%fooValue%'
     * $query->filterByUserPositionCode(['foo', 'bar']); // WHERE user_position_code IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $userPositionCode The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUserPositionCode($userPositionCode = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($userPositionCode)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(JwReportViewTableMap::COL_USER_POSITION_CODE, $userPositionCode, $comparison);

        return $this;
    }

    /**
     * Filter the query on the user_hq_name column
     *
     * Example usage:
     * <code>
     * $query->filterByUserHqName('fooValue');   // WHERE user_hq_name = 'fooValue'
     * $query->filterByUserHqName('%fooValue%', Criteria::LIKE); // WHERE user_hq_name LIKE '%fooValue%'
     * $query->filterByUserHqName(['foo', 'bar']); // WHERE user_hq_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $userHqName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUserHqName($userHqName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($userHqName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(JwReportViewTableMap::COL_USER_HQ_NAME, $userHqName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the user_name column
     *
     * Example usage:
     * <code>
     * $query->filterByUserName('fooValue');   // WHERE user_name = 'fooValue'
     * $query->filterByUserName('%fooValue%', Criteria::LIKE); // WHERE user_name LIKE '%fooValue%'
     * $query->filterByUserName(['foo', 'bar']); // WHERE user_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $userName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUserName($userName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($userName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(JwReportViewTableMap::COL_USER_NAME, $userName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the user_emp_code column
     *
     * Example usage:
     * <code>
     * $query->filterByUserEmpCode('fooValue');   // WHERE user_emp_code = 'fooValue'
     * $query->filterByUserEmpCode('%fooValue%', Criteria::LIKE); // WHERE user_emp_code LIKE '%fooValue%'
     * $query->filterByUserEmpCode(['foo', 'bar']); // WHERE user_emp_code IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $userEmpCode The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUserEmpCode($userEmpCode = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($userEmpCode)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(JwReportViewTableMap::COL_USER_EMP_CODE, $userEmpCode, $comparison);

        return $this;
    }

    /**
     * Filter the query on the user_level column
     *
     * Example usage:
     * <code>
     * $query->filterByUserLevel('fooValue');   // WHERE user_level = 'fooValue'
     * $query->filterByUserLevel('%fooValue%', Criteria::LIKE); // WHERE user_level LIKE '%fooValue%'
     * $query->filterByUserLevel(['foo', 'bar']); // WHERE user_level IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $userLevel The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUserLevel($userLevel = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($userLevel)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(JwReportViewTableMap::COL_USER_LEVEL, $userLevel, $comparison);

        return $this;
    }

    /**
     * Filter the query on the jw_hq_name column
     *
     * Example usage:
     * <code>
     * $query->filterByJwHqName('fooValue');   // WHERE jw_hq_name = 'fooValue'
     * $query->filterByJwHqName('%fooValue%', Criteria::LIKE); // WHERE jw_hq_name LIKE '%fooValue%'
     * $query->filterByJwHqName(['foo', 'bar']); // WHERE jw_hq_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $jwHqName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByJwHqName($jwHqName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($jwHqName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(JwReportViewTableMap::COL_JW_HQ_NAME, $jwHqName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the jw_employee_name column
     *
     * Example usage:
     * <code>
     * $query->filterByJwEmployeeName('fooValue');   // WHERE jw_employee_name = 'fooValue'
     * $query->filterByJwEmployeeName('%fooValue%', Criteria::LIKE); // WHERE jw_employee_name LIKE '%fooValue%'
     * $query->filterByJwEmployeeName(['foo', 'bar']); // WHERE jw_employee_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $jwEmployeeName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByJwEmployeeName($jwEmployeeName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($jwEmployeeName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(JwReportViewTableMap::COL_JW_EMPLOYEE_NAME, $jwEmployeeName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the jw_emp_code column
     *
     * Example usage:
     * <code>
     * $query->filterByJwEmpCode('fooValue');   // WHERE jw_emp_code = 'fooValue'
     * $query->filterByJwEmpCode('%fooValue%', Criteria::LIKE); // WHERE jw_emp_code LIKE '%fooValue%'
     * $query->filterByJwEmpCode(['foo', 'bar']); // WHERE jw_emp_code IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $jwEmpCode The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByJwEmpCode($jwEmpCode = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($jwEmpCode)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(JwReportViewTableMap::COL_JW_EMP_CODE, $jwEmpCode, $comparison);

        return $this;
    }

    /**
     * Filter the query on the jw_position_code column
     *
     * Example usage:
     * <code>
     * $query->filterByJwPositionCode('fooValue');   // WHERE jw_position_code = 'fooValue'
     * $query->filterByJwPositionCode('%fooValue%', Criteria::LIKE); // WHERE jw_position_code LIKE '%fooValue%'
     * $query->filterByJwPositionCode(['foo', 'bar']); // WHERE jw_position_code IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $jwPositionCode The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByJwPositionCode($jwPositionCode = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($jwPositionCode)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(JwReportViewTableMap::COL_JW_POSITION_CODE, $jwPositionCode, $comparison);

        return $this;
    }

    /**
     * Filter the query on the jw_emp_level column
     *
     * Example usage:
     * <code>
     * $query->filterByJwEmpLevel('fooValue');   // WHERE jw_emp_level = 'fooValue'
     * $query->filterByJwEmpLevel('%fooValue%', Criteria::LIKE); // WHERE jw_emp_level LIKE '%fooValue%'
     * $query->filterByJwEmpLevel(['foo', 'bar']); // WHERE jw_emp_level IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $jwEmpLevel The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByJwEmpLevel($jwEmpLevel = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($jwEmpLevel)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(JwReportViewTableMap::COL_JW_EMP_LEVEL, $jwEmpLevel, $comparison);

        return $this;
    }

    /**
     * Filter the query on the no_of_jw_days_worked column
     *
     * Example usage:
     * <code>
     * $query->filterByNoOfJwDaysWorked(1234); // WHERE no_of_jw_days_worked = 1234
     * $query->filterByNoOfJwDaysWorked(array(12, 34)); // WHERE no_of_jw_days_worked IN (12, 34)
     * $query->filterByNoOfJwDaysWorked(array('min' => 12)); // WHERE no_of_jw_days_worked > 12
     * </code>
     *
     * @param mixed $noOfJwDaysWorked The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByNoOfJwDaysWorked($noOfJwDaysWorked = null, ?string $comparison = null)
    {
        if (is_array($noOfJwDaysWorked)) {
            $useMinMax = false;
            if (isset($noOfJwDaysWorked['min'])) {
                $this->addUsingAlias(JwReportViewTableMap::COL_NO_OF_JW_DAYS_WORKED, $noOfJwDaysWorked['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($noOfJwDaysWorked['max'])) {
                $this->addUsingAlias(JwReportViewTableMap::COL_NO_OF_JW_DAYS_WORKED, $noOfJwDaysWorked['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(JwReportViewTableMap::COL_NO_OF_JW_DAYS_WORKED, $noOfJwDaysWorked, $comparison);

        return $this;
    }

    /**
     * Filter the query on the no_of_calls_jw column
     *
     * Example usage:
     * <code>
     * $query->filterByNoOfCallsJw(1234); // WHERE no_of_calls_jw = 1234
     * $query->filterByNoOfCallsJw(array(12, 34)); // WHERE no_of_calls_jw IN (12, 34)
     * $query->filterByNoOfCallsJw(array('min' => 12)); // WHERE no_of_calls_jw > 12
     * </code>
     *
     * @param mixed $noOfCallsJw The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByNoOfCallsJw($noOfCallsJw = null, ?string $comparison = null)
    {
        if (is_array($noOfCallsJw)) {
            $useMinMax = false;
            if (isset($noOfCallsJw['min'])) {
                $this->addUsingAlias(JwReportViewTableMap::COL_NO_OF_CALLS_JW, $noOfCallsJw['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($noOfCallsJw['max'])) {
                $this->addUsingAlias(JwReportViewTableMap::COL_NO_OF_CALLS_JW, $noOfCallsJw['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(JwReportViewTableMap::COL_NO_OF_CALLS_JW, $noOfCallsJw, $comparison);

        return $this;
    }

    /**
     * Filter the query on the call_average column
     *
     * Example usage:
     * <code>
     * $query->filterByCallAverage(1234); // WHERE call_average = 1234
     * $query->filterByCallAverage(array(12, 34)); // WHERE call_average IN (12, 34)
     * $query->filterByCallAverage(array('min' => 12)); // WHERE call_average > 12
     * </code>
     *
     * @param mixed $callAverage The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCallAverage($callAverage = null, ?string $comparison = null)
    {
        if (is_array($callAverage)) {
            $useMinMax = false;
            if (isset($callAverage['min'])) {
                $this->addUsingAlias(JwReportViewTableMap::COL_CALL_AVERAGE, $callAverage['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($callAverage['max'])) {
                $this->addUsingAlias(JwReportViewTableMap::COL_CALL_AVERAGE, $callAverage['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(JwReportViewTableMap::COL_CALL_AVERAGE, $callAverage, $comparison);

        return $this;
    }

    /**
     * Filter the query on the month_year column
     *
     * Example usage:
     * <code>
     * $query->filterByMonthYear('fooValue');   // WHERE month_year = 'fooValue'
     * $query->filterByMonthYear('%fooValue%', Criteria::LIKE); // WHERE month_year LIKE '%fooValue%'
     * $query->filterByMonthYear(['foo', 'bar']); // WHERE month_year IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $monthYear The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMonthYear($monthYear = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($monthYear)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(JwReportViewTableMap::COL_MONTH_YEAR, $monthYear, $comparison);

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildJwReportView $jwReportView Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($jwReportView = null)
    {
        if ($jwReportView) {
            throw new LogicException('JwReportView object has no primary key');

        }

        return $this;
    }

}
