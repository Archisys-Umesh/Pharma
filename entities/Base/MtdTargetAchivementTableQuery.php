<?php

namespace entities\Base;

use \Exception;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use entities\MtdTargetAchivementTable as ChildMtdTargetAchivementTable;
use entities\MtdTargetAchivementTableQuery as ChildMtdTargetAchivementTableQuery;
use entities\Map\MtdTargetAchivementTableTableMap;

/**
 * Base class that represents a query for the `mtd_target_achivement_table` table.
 *
 * @method     ChildMtdTargetAchivementTableQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildMtdTargetAchivementTableQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildMtdTargetAchivementTableQuery orderByTargetId($order = Criteria::ASC) Order by the target_id column
 * @method     ChildMtdTargetAchivementTableQuery orderByTargetName($order = Criteria::ASC) Order by the target_name column
 * @method     ChildMtdTargetAchivementTableQuery orderByEmployeeId($order = Criteria::ASC) Order by the employee_id column
 * @method     ChildMtdTargetAchivementTableQuery orderByFirstName($order = Criteria::ASC) Order by the first_name column
 * @method     ChildMtdTargetAchivementTableQuery orderByLastName($order = Criteria::ASC) Order by the last_name column
 * @method     ChildMtdTargetAchivementTableQuery orderByEmployeeCode($order = Criteria::ASC) Order by the employee_code column
 * @method     ChildMtdTargetAchivementTableQuery orderByMonth($order = Criteria::ASC) Order by the month column
 * @method     ChildMtdTargetAchivementTableQuery orderByTargetValue($order = Criteria::ASC) Order by the target_value column
 * @method     ChildMtdTargetAchivementTableQuery orderBySales($order = Criteria::ASC) Order by the sales column
 *
 * @method     ChildMtdTargetAchivementTableQuery groupById() Group by the id column
 * @method     ChildMtdTargetAchivementTableQuery groupByCompanyId() Group by the company_id column
 * @method     ChildMtdTargetAchivementTableQuery groupByTargetId() Group by the target_id column
 * @method     ChildMtdTargetAchivementTableQuery groupByTargetName() Group by the target_name column
 * @method     ChildMtdTargetAchivementTableQuery groupByEmployeeId() Group by the employee_id column
 * @method     ChildMtdTargetAchivementTableQuery groupByFirstName() Group by the first_name column
 * @method     ChildMtdTargetAchivementTableQuery groupByLastName() Group by the last_name column
 * @method     ChildMtdTargetAchivementTableQuery groupByEmployeeCode() Group by the employee_code column
 * @method     ChildMtdTargetAchivementTableQuery groupByMonth() Group by the month column
 * @method     ChildMtdTargetAchivementTableQuery groupByTargetValue() Group by the target_value column
 * @method     ChildMtdTargetAchivementTableQuery groupBySales() Group by the sales column
 *
 * @method     ChildMtdTargetAchivementTableQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildMtdTargetAchivementTableQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildMtdTargetAchivementTableQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildMtdTargetAchivementTableQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildMtdTargetAchivementTableQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildMtdTargetAchivementTableQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildMtdTargetAchivementTable|null findOne(?ConnectionInterface $con = null) Return the first ChildMtdTargetAchivementTable matching the query
 * @method     ChildMtdTargetAchivementTable findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildMtdTargetAchivementTable matching the query, or a new ChildMtdTargetAchivementTable object populated from the query conditions when no match is found
 *
 * @method     ChildMtdTargetAchivementTable|null findOneById(string $id) Return the first ChildMtdTargetAchivementTable filtered by the id column
 * @method     ChildMtdTargetAchivementTable|null findOneByCompanyId(int $company_id) Return the first ChildMtdTargetAchivementTable filtered by the company_id column
 * @method     ChildMtdTargetAchivementTable|null findOneByTargetId(int $target_id) Return the first ChildMtdTargetAchivementTable filtered by the target_id column
 * @method     ChildMtdTargetAchivementTable|null findOneByTargetName(string $target_name) Return the first ChildMtdTargetAchivementTable filtered by the target_name column
 * @method     ChildMtdTargetAchivementTable|null findOneByEmployeeId(int $employee_id) Return the first ChildMtdTargetAchivementTable filtered by the employee_id column
 * @method     ChildMtdTargetAchivementTable|null findOneByFirstName(string $first_name) Return the first ChildMtdTargetAchivementTable filtered by the first_name column
 * @method     ChildMtdTargetAchivementTable|null findOneByLastName(string $last_name) Return the first ChildMtdTargetAchivementTable filtered by the last_name column
 * @method     ChildMtdTargetAchivementTable|null findOneByEmployeeCode(string $employee_code) Return the first ChildMtdTargetAchivementTable filtered by the employee_code column
 * @method     ChildMtdTargetAchivementTable|null findOneByMonth(string $month) Return the first ChildMtdTargetAchivementTable filtered by the month column
 * @method     ChildMtdTargetAchivementTable|null findOneByTargetValue(string $target_value) Return the first ChildMtdTargetAchivementTable filtered by the target_value column
 * @method     ChildMtdTargetAchivementTable|null findOneBySales(string $sales) Return the first ChildMtdTargetAchivementTable filtered by the sales column
 *
 * @method     ChildMtdTargetAchivementTable requirePk($key, ?ConnectionInterface $con = null) Return the ChildMtdTargetAchivementTable by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMtdTargetAchivementTable requireOne(?ConnectionInterface $con = null) Return the first ChildMtdTargetAchivementTable matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildMtdTargetAchivementTable requireOneById(string $id) Return the first ChildMtdTargetAchivementTable filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMtdTargetAchivementTable requireOneByCompanyId(int $company_id) Return the first ChildMtdTargetAchivementTable filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMtdTargetAchivementTable requireOneByTargetId(int $target_id) Return the first ChildMtdTargetAchivementTable filtered by the target_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMtdTargetAchivementTable requireOneByTargetName(string $target_name) Return the first ChildMtdTargetAchivementTable filtered by the target_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMtdTargetAchivementTable requireOneByEmployeeId(int $employee_id) Return the first ChildMtdTargetAchivementTable filtered by the employee_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMtdTargetAchivementTable requireOneByFirstName(string $first_name) Return the first ChildMtdTargetAchivementTable filtered by the first_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMtdTargetAchivementTable requireOneByLastName(string $last_name) Return the first ChildMtdTargetAchivementTable filtered by the last_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMtdTargetAchivementTable requireOneByEmployeeCode(string $employee_code) Return the first ChildMtdTargetAchivementTable filtered by the employee_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMtdTargetAchivementTable requireOneByMonth(string $month) Return the first ChildMtdTargetAchivementTable filtered by the month column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMtdTargetAchivementTable requireOneByTargetValue(string $target_value) Return the first ChildMtdTargetAchivementTable filtered by the target_value column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMtdTargetAchivementTable requireOneBySales(string $sales) Return the first ChildMtdTargetAchivementTable filtered by the sales column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildMtdTargetAchivementTable[]|Collection find(?ConnectionInterface $con = null) Return ChildMtdTargetAchivementTable objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildMtdTargetAchivementTable> find(?ConnectionInterface $con = null) Return ChildMtdTargetAchivementTable objects based on current ModelCriteria
 *
 * @method     ChildMtdTargetAchivementTable[]|Collection findById(string|array<string> $id) Return ChildMtdTargetAchivementTable objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildMtdTargetAchivementTable> findById(string|array<string> $id) Return ChildMtdTargetAchivementTable objects filtered by the id column
 * @method     ChildMtdTargetAchivementTable[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildMtdTargetAchivementTable objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildMtdTargetAchivementTable> findByCompanyId(int|array<int> $company_id) Return ChildMtdTargetAchivementTable objects filtered by the company_id column
 * @method     ChildMtdTargetAchivementTable[]|Collection findByTargetId(int|array<int> $target_id) Return ChildMtdTargetAchivementTable objects filtered by the target_id column
 * @psalm-method Collection&\Traversable<ChildMtdTargetAchivementTable> findByTargetId(int|array<int> $target_id) Return ChildMtdTargetAchivementTable objects filtered by the target_id column
 * @method     ChildMtdTargetAchivementTable[]|Collection findByTargetName(string|array<string> $target_name) Return ChildMtdTargetAchivementTable objects filtered by the target_name column
 * @psalm-method Collection&\Traversable<ChildMtdTargetAchivementTable> findByTargetName(string|array<string> $target_name) Return ChildMtdTargetAchivementTable objects filtered by the target_name column
 * @method     ChildMtdTargetAchivementTable[]|Collection findByEmployeeId(int|array<int> $employee_id) Return ChildMtdTargetAchivementTable objects filtered by the employee_id column
 * @psalm-method Collection&\Traversable<ChildMtdTargetAchivementTable> findByEmployeeId(int|array<int> $employee_id) Return ChildMtdTargetAchivementTable objects filtered by the employee_id column
 * @method     ChildMtdTargetAchivementTable[]|Collection findByFirstName(string|array<string> $first_name) Return ChildMtdTargetAchivementTable objects filtered by the first_name column
 * @psalm-method Collection&\Traversable<ChildMtdTargetAchivementTable> findByFirstName(string|array<string> $first_name) Return ChildMtdTargetAchivementTable objects filtered by the first_name column
 * @method     ChildMtdTargetAchivementTable[]|Collection findByLastName(string|array<string> $last_name) Return ChildMtdTargetAchivementTable objects filtered by the last_name column
 * @psalm-method Collection&\Traversable<ChildMtdTargetAchivementTable> findByLastName(string|array<string> $last_name) Return ChildMtdTargetAchivementTable objects filtered by the last_name column
 * @method     ChildMtdTargetAchivementTable[]|Collection findByEmployeeCode(string|array<string> $employee_code) Return ChildMtdTargetAchivementTable objects filtered by the employee_code column
 * @psalm-method Collection&\Traversable<ChildMtdTargetAchivementTable> findByEmployeeCode(string|array<string> $employee_code) Return ChildMtdTargetAchivementTable objects filtered by the employee_code column
 * @method     ChildMtdTargetAchivementTable[]|Collection findByMonth(string|array<string> $month) Return ChildMtdTargetAchivementTable objects filtered by the month column
 * @psalm-method Collection&\Traversable<ChildMtdTargetAchivementTable> findByMonth(string|array<string> $month) Return ChildMtdTargetAchivementTable objects filtered by the month column
 * @method     ChildMtdTargetAchivementTable[]|Collection findByTargetValue(string|array<string> $target_value) Return ChildMtdTargetAchivementTable objects filtered by the target_value column
 * @psalm-method Collection&\Traversable<ChildMtdTargetAchivementTable> findByTargetValue(string|array<string> $target_value) Return ChildMtdTargetAchivementTable objects filtered by the target_value column
 * @method     ChildMtdTargetAchivementTable[]|Collection findBySales(string|array<string> $sales) Return ChildMtdTargetAchivementTable objects filtered by the sales column
 * @psalm-method Collection&\Traversable<ChildMtdTargetAchivementTable> findBySales(string|array<string> $sales) Return ChildMtdTargetAchivementTable objects filtered by the sales column
 *
 * @method     ChildMtdTargetAchivementTable[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildMtdTargetAchivementTable> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class MtdTargetAchivementTableQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\MtdTargetAchivementTableQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\MtdTargetAchivementTable', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildMtdTargetAchivementTableQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildMtdTargetAchivementTableQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildMtdTargetAchivementTableQuery) {
            return $criteria;
        }
        $query = new ChildMtdTargetAchivementTableQuery();
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
     * @return ChildMtdTargetAchivementTable|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        throw new LogicException('The MtdTargetAchivementTable object has no primary key');
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
        throw new LogicException('The MtdTargetAchivementTable object has no primary key');
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
        throw new LogicException('The MtdTargetAchivementTable object has no primary key');
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
        throw new LogicException('The MtdTargetAchivementTable object has no primary key');
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById('fooValue');   // WHERE id = 'fooValue'
     * $query->filterById('%fooValue%', Criteria::LIKE); // WHERE id LIKE '%fooValue%'
     * $query->filterById(['foo', 'bar']); // WHERE id IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $id The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterById($id = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($id)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MtdTargetAchivementTableTableMap::COL_ID, $id, $comparison);

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
                $this->addUsingAlias(MtdTargetAchivementTableTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(MtdTargetAchivementTableTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MtdTargetAchivementTableTableMap::COL_COMPANY_ID, $companyId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the target_id column
     *
     * Example usage:
     * <code>
     * $query->filterByTargetId(1234); // WHERE target_id = 1234
     * $query->filterByTargetId(array(12, 34)); // WHERE target_id IN (12, 34)
     * $query->filterByTargetId(array('min' => 12)); // WHERE target_id > 12
     * </code>
     *
     * @param mixed $targetId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTargetId($targetId = null, ?string $comparison = null)
    {
        if (is_array($targetId)) {
            $useMinMax = false;
            if (isset($targetId['min'])) {
                $this->addUsingAlias(MtdTargetAchivementTableTableMap::COL_TARGET_ID, $targetId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($targetId['max'])) {
                $this->addUsingAlias(MtdTargetAchivementTableTableMap::COL_TARGET_ID, $targetId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MtdTargetAchivementTableTableMap::COL_TARGET_ID, $targetId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the target_name column
     *
     * Example usage:
     * <code>
     * $query->filterByTargetName('fooValue');   // WHERE target_name = 'fooValue'
     * $query->filterByTargetName('%fooValue%', Criteria::LIKE); // WHERE target_name LIKE '%fooValue%'
     * $query->filterByTargetName(['foo', 'bar']); // WHERE target_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $targetName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTargetName($targetName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($targetName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MtdTargetAchivementTableTableMap::COL_TARGET_NAME, $targetName, $comparison);

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
                $this->addUsingAlias(MtdTargetAchivementTableTableMap::COL_EMPLOYEE_ID, $employeeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($employeeId['max'])) {
                $this->addUsingAlias(MtdTargetAchivementTableTableMap::COL_EMPLOYEE_ID, $employeeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MtdTargetAchivementTableTableMap::COL_EMPLOYEE_ID, $employeeId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the first_name column
     *
     * Example usage:
     * <code>
     * $query->filterByFirstName('fooValue');   // WHERE first_name = 'fooValue'
     * $query->filterByFirstName('%fooValue%', Criteria::LIKE); // WHERE first_name LIKE '%fooValue%'
     * $query->filterByFirstName(['foo', 'bar']); // WHERE first_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $firstName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFirstName($firstName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($firstName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MtdTargetAchivementTableTableMap::COL_FIRST_NAME, $firstName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the last_name column
     *
     * Example usage:
     * <code>
     * $query->filterByLastName('fooValue');   // WHERE last_name = 'fooValue'
     * $query->filterByLastName('%fooValue%', Criteria::LIKE); // WHERE last_name LIKE '%fooValue%'
     * $query->filterByLastName(['foo', 'bar']); // WHERE last_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $lastName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLastName($lastName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($lastName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MtdTargetAchivementTableTableMap::COL_LAST_NAME, $lastName, $comparison);

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

        $this->addUsingAlias(MtdTargetAchivementTableTableMap::COL_EMPLOYEE_CODE, $employeeCode, $comparison);

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

        $this->addUsingAlias(MtdTargetAchivementTableTableMap::COL_MONTH, $month, $comparison);

        return $this;
    }

    /**
     * Filter the query on the target_value column
     *
     * Example usage:
     * <code>
     * $query->filterByTargetValue(1234); // WHERE target_value = 1234
     * $query->filterByTargetValue(array(12, 34)); // WHERE target_value IN (12, 34)
     * $query->filterByTargetValue(array('min' => 12)); // WHERE target_value > 12
     * </code>
     *
     * @param mixed $targetValue The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTargetValue($targetValue = null, ?string $comparison = null)
    {
        if (is_array($targetValue)) {
            $useMinMax = false;
            if (isset($targetValue['min'])) {
                $this->addUsingAlias(MtdTargetAchivementTableTableMap::COL_TARGET_VALUE, $targetValue['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($targetValue['max'])) {
                $this->addUsingAlias(MtdTargetAchivementTableTableMap::COL_TARGET_VALUE, $targetValue['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MtdTargetAchivementTableTableMap::COL_TARGET_VALUE, $targetValue, $comparison);

        return $this;
    }

    /**
     * Filter the query on the sales column
     *
     * Example usage:
     * <code>
     * $query->filterBySales(1234); // WHERE sales = 1234
     * $query->filterBySales(array(12, 34)); // WHERE sales IN (12, 34)
     * $query->filterBySales(array('min' => 12)); // WHERE sales > 12
     * </code>
     *
     * @param mixed $sales The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySales($sales = null, ?string $comparison = null)
    {
        if (is_array($sales)) {
            $useMinMax = false;
            if (isset($sales['min'])) {
                $this->addUsingAlias(MtdTargetAchivementTableTableMap::COL_SALES, $sales['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($sales['max'])) {
                $this->addUsingAlias(MtdTargetAchivementTableTableMap::COL_SALES, $sales['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MtdTargetAchivementTableTableMap::COL_SALES, $sales, $comparison);

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildMtdTargetAchivementTable $mtdTargetAchivementTable Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($mtdTargetAchivementTable = null)
    {
        if ($mtdTargetAchivementTable) {
            throw new LogicException('MtdTargetAchivementTable object has no primary key');

        }

        return $this;
    }

    /**
     * Deletes all rows from the mtd_target_achivement_table table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(MtdTargetAchivementTableTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            MtdTargetAchivementTableTableMap::clearInstancePool();
            MtdTargetAchivementTableTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(MtdTargetAchivementTableTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(MtdTargetAchivementTableTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            MtdTargetAchivementTableTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            MtdTargetAchivementTableTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
