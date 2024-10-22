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
use entities\Holidays as ChildHolidays;
use entities\HolidaysQuery as ChildHolidaysQuery;
use entities\Map\HolidaysTableMap;

/**
 * Base class that represents a query for the `holidays` table.
 *
 * @method     ChildHolidaysQuery orderByHolidayId($order = Criteria::ASC) Order by the holiday_id column
 * @method     ChildHolidaysQuery orderByHolidayName($order = Criteria::ASC) Order by the holiday_name column
 * @method     ChildHolidaysQuery orderByHolidayDate($order = Criteria::ASC) Order by the holiday_date column
 * @method     ChildHolidaysQuery orderByIstateid($order = Criteria::ASC) Order by the istateid column
 * @method     ChildHolidaysQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildHolidaysQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildHolidaysQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 *
 * @method     ChildHolidaysQuery groupByHolidayId() Group by the holiday_id column
 * @method     ChildHolidaysQuery groupByHolidayName() Group by the holiday_name column
 * @method     ChildHolidaysQuery groupByHolidayDate() Group by the holiday_date column
 * @method     ChildHolidaysQuery groupByIstateid() Group by the istateid column
 * @method     ChildHolidaysQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildHolidaysQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildHolidaysQuery groupByCompanyId() Group by the company_id column
 *
 * @method     ChildHolidaysQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildHolidaysQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildHolidaysQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildHolidaysQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildHolidaysQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildHolidaysQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildHolidaysQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildHolidaysQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildHolidaysQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildHolidaysQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildHolidaysQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildHolidaysQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildHolidaysQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     ChildHolidaysQuery leftJoinGeoState($relationAlias = null) Adds a LEFT JOIN clause to the query using the GeoState relation
 * @method     ChildHolidaysQuery rightJoinGeoState($relationAlias = null) Adds a RIGHT JOIN clause to the query using the GeoState relation
 * @method     ChildHolidaysQuery innerJoinGeoState($relationAlias = null) Adds a INNER JOIN clause to the query using the GeoState relation
 *
 * @method     ChildHolidaysQuery joinWithGeoState($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the GeoState relation
 *
 * @method     ChildHolidaysQuery leftJoinWithGeoState() Adds a LEFT JOIN clause and with to the query using the GeoState relation
 * @method     ChildHolidaysQuery rightJoinWithGeoState() Adds a RIGHT JOIN clause and with to the query using the GeoState relation
 * @method     ChildHolidaysQuery innerJoinWithGeoState() Adds a INNER JOIN clause and with to the query using the GeoState relation
 *
 * @method     \entities\CompanyQuery|\entities\GeoStateQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildHolidays|null findOne(?ConnectionInterface $con = null) Return the first ChildHolidays matching the query
 * @method     ChildHolidays findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildHolidays matching the query, or a new ChildHolidays object populated from the query conditions when no match is found
 *
 * @method     ChildHolidays|null findOneByHolidayId(int $holiday_id) Return the first ChildHolidays filtered by the holiday_id column
 * @method     ChildHolidays|null findOneByHolidayName(string $holiday_name) Return the first ChildHolidays filtered by the holiday_name column
 * @method     ChildHolidays|null findOneByHolidayDate(string $holiday_date) Return the first ChildHolidays filtered by the holiday_date column
 * @method     ChildHolidays|null findOneByIstateid(int $istateid) Return the first ChildHolidays filtered by the istateid column
 * @method     ChildHolidays|null findOneByCreatedAt(string $created_at) Return the first ChildHolidays filtered by the created_at column
 * @method     ChildHolidays|null findOneByUpdatedAt(string $updated_at) Return the first ChildHolidays filtered by the updated_at column
 * @method     ChildHolidays|null findOneByCompanyId(int $company_id) Return the first ChildHolidays filtered by the company_id column
 *
 * @method     ChildHolidays requirePk($key, ?ConnectionInterface $con = null) Return the ChildHolidays by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHolidays requireOne(?ConnectionInterface $con = null) Return the first ChildHolidays matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildHolidays requireOneByHolidayId(int $holiday_id) Return the first ChildHolidays filtered by the holiday_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHolidays requireOneByHolidayName(string $holiday_name) Return the first ChildHolidays filtered by the holiday_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHolidays requireOneByHolidayDate(string $holiday_date) Return the first ChildHolidays filtered by the holiday_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHolidays requireOneByIstateid(int $istateid) Return the first ChildHolidays filtered by the istateid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHolidays requireOneByCreatedAt(string $created_at) Return the first ChildHolidays filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHolidays requireOneByUpdatedAt(string $updated_at) Return the first ChildHolidays filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHolidays requireOneByCompanyId(int $company_id) Return the first ChildHolidays filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildHolidays[]|Collection find(?ConnectionInterface $con = null) Return ChildHolidays objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildHolidays> find(?ConnectionInterface $con = null) Return ChildHolidays objects based on current ModelCriteria
 *
 * @method     ChildHolidays[]|Collection findByHolidayId(int|array<int> $holiday_id) Return ChildHolidays objects filtered by the holiday_id column
 * @psalm-method Collection&\Traversable<ChildHolidays> findByHolidayId(int|array<int> $holiday_id) Return ChildHolidays objects filtered by the holiday_id column
 * @method     ChildHolidays[]|Collection findByHolidayName(string|array<string> $holiday_name) Return ChildHolidays objects filtered by the holiday_name column
 * @psalm-method Collection&\Traversable<ChildHolidays> findByHolidayName(string|array<string> $holiday_name) Return ChildHolidays objects filtered by the holiday_name column
 * @method     ChildHolidays[]|Collection findByHolidayDate(string|array<string> $holiday_date) Return ChildHolidays objects filtered by the holiday_date column
 * @psalm-method Collection&\Traversable<ChildHolidays> findByHolidayDate(string|array<string> $holiday_date) Return ChildHolidays objects filtered by the holiday_date column
 * @method     ChildHolidays[]|Collection findByIstateid(int|array<int> $istateid) Return ChildHolidays objects filtered by the istateid column
 * @psalm-method Collection&\Traversable<ChildHolidays> findByIstateid(int|array<int> $istateid) Return ChildHolidays objects filtered by the istateid column
 * @method     ChildHolidays[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildHolidays objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildHolidays> findByCreatedAt(string|array<string> $created_at) Return ChildHolidays objects filtered by the created_at column
 * @method     ChildHolidays[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildHolidays objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildHolidays> findByUpdatedAt(string|array<string> $updated_at) Return ChildHolidays objects filtered by the updated_at column
 * @method     ChildHolidays[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildHolidays objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildHolidays> findByCompanyId(int|array<int> $company_id) Return ChildHolidays objects filtered by the company_id column
 *
 * @method     ChildHolidays[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildHolidays> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class HolidaysQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\HolidaysQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\Holidays', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildHolidaysQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildHolidaysQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildHolidaysQuery) {
            return $criteria;
        }
        $query = new ChildHolidaysQuery();
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
     * @return ChildHolidays|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(HolidaysTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = HolidaysTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildHolidays A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT holiday_id, holiday_name, holiday_date, istateid, created_at, updated_at, company_id FROM holidays WHERE holiday_id = :p0';
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
            /** @var ChildHolidays $obj */
            $obj = new ChildHolidays();
            $obj->hydrate($row);
            HolidaysTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildHolidays|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(HolidaysTableMap::COL_HOLIDAY_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(HolidaysTableMap::COL_HOLIDAY_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the holiday_id column
     *
     * Example usage:
     * <code>
     * $query->filterByHolidayId(1234); // WHERE holiday_id = 1234
     * $query->filterByHolidayId(array(12, 34)); // WHERE holiday_id IN (12, 34)
     * $query->filterByHolidayId(array('min' => 12)); // WHERE holiday_id > 12
     * </code>
     *
     * @param mixed $holidayId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByHolidayId($holidayId = null, ?string $comparison = null)
    {
        if (is_array($holidayId)) {
            $useMinMax = false;
            if (isset($holidayId['min'])) {
                $this->addUsingAlias(HolidaysTableMap::COL_HOLIDAY_ID, $holidayId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($holidayId['max'])) {
                $this->addUsingAlias(HolidaysTableMap::COL_HOLIDAY_ID, $holidayId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(HolidaysTableMap::COL_HOLIDAY_ID, $holidayId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the holiday_name column
     *
     * Example usage:
     * <code>
     * $query->filterByHolidayName('fooValue');   // WHERE holiday_name = 'fooValue'
     * $query->filterByHolidayName('%fooValue%', Criteria::LIKE); // WHERE holiday_name LIKE '%fooValue%'
     * $query->filterByHolidayName(['foo', 'bar']); // WHERE holiday_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $holidayName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByHolidayName($holidayName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($holidayName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(HolidaysTableMap::COL_HOLIDAY_NAME, $holidayName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the holiday_date column
     *
     * Example usage:
     * <code>
     * $query->filterByHolidayDate('2011-03-14'); // WHERE holiday_date = '2011-03-14'
     * $query->filterByHolidayDate('now'); // WHERE holiday_date = '2011-03-14'
     * $query->filterByHolidayDate(array('max' => 'yesterday')); // WHERE holiday_date > '2011-03-13'
     * </code>
     *
     * @param mixed $holidayDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByHolidayDate($holidayDate = null, ?string $comparison = null)
    {
        if (is_array($holidayDate)) {
            $useMinMax = false;
            if (isset($holidayDate['min'])) {
                $this->addUsingAlias(HolidaysTableMap::COL_HOLIDAY_DATE, $holidayDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($holidayDate['max'])) {
                $this->addUsingAlias(HolidaysTableMap::COL_HOLIDAY_DATE, $holidayDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(HolidaysTableMap::COL_HOLIDAY_DATE, $holidayDate, $comparison);

        return $this;
    }

    /**
     * Filter the query on the istateid column
     *
     * Example usage:
     * <code>
     * $query->filterByIstateid(1234); // WHERE istateid = 1234
     * $query->filterByIstateid(array(12, 34)); // WHERE istateid IN (12, 34)
     * $query->filterByIstateid(array('min' => 12)); // WHERE istateid > 12
     * </code>
     *
     * @see       filterByGeoState()
     *
     * @param mixed $istateid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIstateid($istateid = null, ?string $comparison = null)
    {
        if (is_array($istateid)) {
            $useMinMax = false;
            if (isset($istateid['min'])) {
                $this->addUsingAlias(HolidaysTableMap::COL_ISTATEID, $istateid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($istateid['max'])) {
                $this->addUsingAlias(HolidaysTableMap::COL_ISTATEID, $istateid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(HolidaysTableMap::COL_ISTATEID, $istateid, $comparison);

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
                $this->addUsingAlias(HolidaysTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(HolidaysTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(HolidaysTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(HolidaysTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(HolidaysTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(HolidaysTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

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
                $this->addUsingAlias(HolidaysTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(HolidaysTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(HolidaysTableMap::COL_COMPANY_ID, $companyId, $comparison);

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
                ->addUsingAlias(HolidaysTableMap::COL_COMPANY_ID, $company->getCompanyId(), $comparison);
        } elseif ($company instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(HolidaysTableMap::COL_COMPANY_ID, $company->toKeyValue('PrimaryKey', 'CompanyId'), $comparison);

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
     * Filter the query by a related \entities\GeoState object
     *
     * @param \entities\GeoState|ObjectCollection $geoState The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByGeoState($geoState, ?string $comparison = null)
    {
        if ($geoState instanceof \entities\GeoState) {
            return $this
                ->addUsingAlias(HolidaysTableMap::COL_ISTATEID, $geoState->getIstateid(), $comparison);
        } elseif ($geoState instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(HolidaysTableMap::COL_ISTATEID, $geoState->toKeyValue('PrimaryKey', 'Istateid'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByGeoState() only accepts arguments of type \entities\GeoState or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the GeoState relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinGeoState(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('GeoState');

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
            $this->addJoinObject($join, 'GeoState');
        }

        return $this;
    }

    /**
     * Use the GeoState relation GeoState object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\GeoStateQuery A secondary query class using the current class as primary query
     */
    public function useGeoStateQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinGeoState($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'GeoState', '\entities\GeoStateQuery');
    }

    /**
     * Use the GeoState relation GeoState object
     *
     * @param callable(\entities\GeoStateQuery):\entities\GeoStateQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withGeoStateQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useGeoStateQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to GeoState table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\GeoStateQuery The inner query object of the EXISTS statement
     */
    public function useGeoStateExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\GeoStateQuery */
        $q = $this->useExistsQuery('GeoState', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to GeoState table for a NOT EXISTS query.
     *
     * @see useGeoStateExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\GeoStateQuery The inner query object of the NOT EXISTS statement
     */
    public function useGeoStateNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\GeoStateQuery */
        $q = $this->useExistsQuery('GeoState', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to GeoState table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\GeoStateQuery The inner query object of the IN statement
     */
    public function useInGeoStateQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\GeoStateQuery */
        $q = $this->useInQuery('GeoState', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to GeoState table for a NOT IN query.
     *
     * @see useGeoStateInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\GeoStateQuery The inner query object of the NOT IN statement
     */
    public function useNotInGeoStateQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\GeoStateQuery */
        $q = $this->useInQuery('GeoState', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildHolidays $holidays Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($holidays = null)
    {
        if ($holidays) {
            $this->addUsingAlias(HolidaysTableMap::COL_HOLIDAY_ID, $holidays->getHolidayId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the holidays table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(HolidaysTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            HolidaysTableMap::clearInstancePool();
            HolidaysTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(HolidaysTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(HolidaysTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            HolidaysTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            HolidaysTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
