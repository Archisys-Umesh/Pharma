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
use entities\MtpDay as ChildMtpDay;
use entities\MtpDayQuery as ChildMtpDayQuery;
use entities\Map\MtpDayTableMap;

/**
 * Base class that represents a query for the `mtp_day` table.
 *
 * @method     ChildMtpDayQuery orderByMtpDayId($order = Criteria::ASC) Order by the mtp_day_id column
 * @method     ChildMtpDayQuery orderByMtpDayDate($order = Criteria::ASC) Order by the mtp_day_date column
 * @method     ChildMtpDayQuery orderByWeekday($order = Criteria::ASC) Order by the weekday column
 * @method     ChildMtpDayQuery orderByWeeknumber($order = Criteria::ASC) Order by the weeknumber column
 * @method     ChildMtpDayQuery orderByMtpId($order = Criteria::ASC) Order by the mtp_id column
 * @method     ChildMtpDayQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildMtpDayQuery orderByMtpdayRemark($order = Criteria::ASC) Order by the mtpday_remark column
 * @method     ChildMtpDayQuery orderByIshalfday($order = Criteria::ASC) Order by the ishalfday column
 * @method     ChildMtpDayQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildMtpDayQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildMtpDayQuery groupByMtpDayId() Group by the mtp_day_id column
 * @method     ChildMtpDayQuery groupByMtpDayDate() Group by the mtp_day_date column
 * @method     ChildMtpDayQuery groupByWeekday() Group by the weekday column
 * @method     ChildMtpDayQuery groupByWeeknumber() Group by the weeknumber column
 * @method     ChildMtpDayQuery groupByMtpId() Group by the mtp_id column
 * @method     ChildMtpDayQuery groupByCompanyId() Group by the company_id column
 * @method     ChildMtpDayQuery groupByMtpdayRemark() Group by the mtpday_remark column
 * @method     ChildMtpDayQuery groupByIshalfday() Group by the ishalfday column
 * @method     ChildMtpDayQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildMtpDayQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildMtpDayQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildMtpDayQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildMtpDayQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildMtpDayQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildMtpDayQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildMtpDayQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildMtpDayQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildMtpDayQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildMtpDayQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildMtpDayQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildMtpDayQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildMtpDayQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildMtpDayQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     ChildMtpDayQuery leftJoinMtp($relationAlias = null) Adds a LEFT JOIN clause to the query using the Mtp relation
 * @method     ChildMtpDayQuery rightJoinMtp($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Mtp relation
 * @method     ChildMtpDayQuery innerJoinMtp($relationAlias = null) Adds a INNER JOIN clause to the query using the Mtp relation
 *
 * @method     ChildMtpDayQuery joinWithMtp($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Mtp relation
 *
 * @method     ChildMtpDayQuery leftJoinWithMtp() Adds a LEFT JOIN clause and with to the query using the Mtp relation
 * @method     ChildMtpDayQuery rightJoinWithMtp() Adds a RIGHT JOIN clause and with to the query using the Mtp relation
 * @method     ChildMtpDayQuery innerJoinWithMtp() Adds a INNER JOIN clause and with to the query using the Mtp relation
 *
 * @method     ChildMtpDayQuery leftJoinTourplans($relationAlias = null) Adds a LEFT JOIN clause to the query using the Tourplans relation
 * @method     ChildMtpDayQuery rightJoinTourplans($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Tourplans relation
 * @method     ChildMtpDayQuery innerJoinTourplans($relationAlias = null) Adds a INNER JOIN clause to the query using the Tourplans relation
 *
 * @method     ChildMtpDayQuery joinWithTourplans($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Tourplans relation
 *
 * @method     ChildMtpDayQuery leftJoinWithTourplans() Adds a LEFT JOIN clause and with to the query using the Tourplans relation
 * @method     ChildMtpDayQuery rightJoinWithTourplans() Adds a RIGHT JOIN clause and with to the query using the Tourplans relation
 * @method     ChildMtpDayQuery innerJoinWithTourplans() Adds a INNER JOIN clause and with to the query using the Tourplans relation
 *
 * @method     \entities\CompanyQuery|\entities\MtpQuery|\entities\TourplansQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildMtpDay|null findOne(?ConnectionInterface $con = null) Return the first ChildMtpDay matching the query
 * @method     ChildMtpDay findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildMtpDay matching the query, or a new ChildMtpDay object populated from the query conditions when no match is found
 *
 * @method     ChildMtpDay|null findOneByMtpDayId(int $mtp_day_id) Return the first ChildMtpDay filtered by the mtp_day_id column
 * @method     ChildMtpDay|null findOneByMtpDayDate(string $mtp_day_date) Return the first ChildMtpDay filtered by the mtp_day_date column
 * @method     ChildMtpDay|null findOneByWeekday(int $weekday) Return the first ChildMtpDay filtered by the weekday column
 * @method     ChildMtpDay|null findOneByWeeknumber(int $weeknumber) Return the first ChildMtpDay filtered by the weeknumber column
 * @method     ChildMtpDay|null findOneByMtpId(int $mtp_id) Return the first ChildMtpDay filtered by the mtp_id column
 * @method     ChildMtpDay|null findOneByCompanyId(int $company_id) Return the first ChildMtpDay filtered by the company_id column
 * @method     ChildMtpDay|null findOneByMtpdayRemark(string $mtpday_remark) Return the first ChildMtpDay filtered by the mtpday_remark column
 * @method     ChildMtpDay|null findOneByIshalfday(boolean $ishalfday) Return the first ChildMtpDay filtered by the ishalfday column
 * @method     ChildMtpDay|null findOneByCreatedAt(string $created_at) Return the first ChildMtpDay filtered by the created_at column
 * @method     ChildMtpDay|null findOneByUpdatedAt(string $updated_at) Return the first ChildMtpDay filtered by the updated_at column
 *
 * @method     ChildMtpDay requirePk($key, ?ConnectionInterface $con = null) Return the ChildMtpDay by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMtpDay requireOne(?ConnectionInterface $con = null) Return the first ChildMtpDay matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildMtpDay requireOneByMtpDayId(int $mtp_day_id) Return the first ChildMtpDay filtered by the mtp_day_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMtpDay requireOneByMtpDayDate(string $mtp_day_date) Return the first ChildMtpDay filtered by the mtp_day_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMtpDay requireOneByWeekday(int $weekday) Return the first ChildMtpDay filtered by the weekday column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMtpDay requireOneByWeeknumber(int $weeknumber) Return the first ChildMtpDay filtered by the weeknumber column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMtpDay requireOneByMtpId(int $mtp_id) Return the first ChildMtpDay filtered by the mtp_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMtpDay requireOneByCompanyId(int $company_id) Return the first ChildMtpDay filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMtpDay requireOneByMtpdayRemark(string $mtpday_remark) Return the first ChildMtpDay filtered by the mtpday_remark column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMtpDay requireOneByIshalfday(boolean $ishalfday) Return the first ChildMtpDay filtered by the ishalfday column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMtpDay requireOneByCreatedAt(string $created_at) Return the first ChildMtpDay filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMtpDay requireOneByUpdatedAt(string $updated_at) Return the first ChildMtpDay filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildMtpDay[]|Collection find(?ConnectionInterface $con = null) Return ChildMtpDay objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildMtpDay> find(?ConnectionInterface $con = null) Return ChildMtpDay objects based on current ModelCriteria
 *
 * @method     ChildMtpDay[]|Collection findByMtpDayId(int|array<int> $mtp_day_id) Return ChildMtpDay objects filtered by the mtp_day_id column
 * @psalm-method Collection&\Traversable<ChildMtpDay> findByMtpDayId(int|array<int> $mtp_day_id) Return ChildMtpDay objects filtered by the mtp_day_id column
 * @method     ChildMtpDay[]|Collection findByMtpDayDate(string|array<string> $mtp_day_date) Return ChildMtpDay objects filtered by the mtp_day_date column
 * @psalm-method Collection&\Traversable<ChildMtpDay> findByMtpDayDate(string|array<string> $mtp_day_date) Return ChildMtpDay objects filtered by the mtp_day_date column
 * @method     ChildMtpDay[]|Collection findByWeekday(int|array<int> $weekday) Return ChildMtpDay objects filtered by the weekday column
 * @psalm-method Collection&\Traversable<ChildMtpDay> findByWeekday(int|array<int> $weekday) Return ChildMtpDay objects filtered by the weekday column
 * @method     ChildMtpDay[]|Collection findByWeeknumber(int|array<int> $weeknumber) Return ChildMtpDay objects filtered by the weeknumber column
 * @psalm-method Collection&\Traversable<ChildMtpDay> findByWeeknumber(int|array<int> $weeknumber) Return ChildMtpDay objects filtered by the weeknumber column
 * @method     ChildMtpDay[]|Collection findByMtpId(int|array<int> $mtp_id) Return ChildMtpDay objects filtered by the mtp_id column
 * @psalm-method Collection&\Traversable<ChildMtpDay> findByMtpId(int|array<int> $mtp_id) Return ChildMtpDay objects filtered by the mtp_id column
 * @method     ChildMtpDay[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildMtpDay objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildMtpDay> findByCompanyId(int|array<int> $company_id) Return ChildMtpDay objects filtered by the company_id column
 * @method     ChildMtpDay[]|Collection findByMtpdayRemark(string|array<string> $mtpday_remark) Return ChildMtpDay objects filtered by the mtpday_remark column
 * @psalm-method Collection&\Traversable<ChildMtpDay> findByMtpdayRemark(string|array<string> $mtpday_remark) Return ChildMtpDay objects filtered by the mtpday_remark column
 * @method     ChildMtpDay[]|Collection findByIshalfday(boolean|array<boolean> $ishalfday) Return ChildMtpDay objects filtered by the ishalfday column
 * @psalm-method Collection&\Traversable<ChildMtpDay> findByIshalfday(boolean|array<boolean> $ishalfday) Return ChildMtpDay objects filtered by the ishalfday column
 * @method     ChildMtpDay[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildMtpDay objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildMtpDay> findByCreatedAt(string|array<string> $created_at) Return ChildMtpDay objects filtered by the created_at column
 * @method     ChildMtpDay[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildMtpDay objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildMtpDay> findByUpdatedAt(string|array<string> $updated_at) Return ChildMtpDay objects filtered by the updated_at column
 *
 * @method     ChildMtpDay[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildMtpDay> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class MtpDayQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\MtpDayQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\MtpDay', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildMtpDayQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildMtpDayQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildMtpDayQuery) {
            return $criteria;
        }
        $query = new ChildMtpDayQuery();
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
     * @return ChildMtpDay|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(MtpDayTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = MtpDayTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildMtpDay A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT mtp_day_id, mtp_day_date, weekday, weeknumber, mtp_id, company_id, mtpday_remark, ishalfday, created_at, updated_at FROM mtp_day WHERE mtp_day_id = :p0';
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
            /** @var ChildMtpDay $obj */
            $obj = new ChildMtpDay();
            $obj->hydrate($row);
            MtpDayTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildMtpDay|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(MtpDayTableMap::COL_MTP_DAY_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(MtpDayTableMap::COL_MTP_DAY_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the mtp_day_id column
     *
     * Example usage:
     * <code>
     * $query->filterByMtpDayId(1234); // WHERE mtp_day_id = 1234
     * $query->filterByMtpDayId(array(12, 34)); // WHERE mtp_day_id IN (12, 34)
     * $query->filterByMtpDayId(array('min' => 12)); // WHERE mtp_day_id > 12
     * </code>
     *
     * @param mixed $mtpDayId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMtpDayId($mtpDayId = null, ?string $comparison = null)
    {
        if (is_array($mtpDayId)) {
            $useMinMax = false;
            if (isset($mtpDayId['min'])) {
                $this->addUsingAlias(MtpDayTableMap::COL_MTP_DAY_ID, $mtpDayId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($mtpDayId['max'])) {
                $this->addUsingAlias(MtpDayTableMap::COL_MTP_DAY_ID, $mtpDayId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MtpDayTableMap::COL_MTP_DAY_ID, $mtpDayId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the mtp_day_date column
     *
     * Example usage:
     * <code>
     * $query->filterByMtpDayDate('fooValue');   // WHERE mtp_day_date = 'fooValue'
     * $query->filterByMtpDayDate('%fooValue%', Criteria::LIKE); // WHERE mtp_day_date LIKE '%fooValue%'
     * $query->filterByMtpDayDate(['foo', 'bar']); // WHERE mtp_day_date IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $mtpDayDate The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMtpDayDate($mtpDayDate = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($mtpDayDate)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MtpDayTableMap::COL_MTP_DAY_DATE, $mtpDayDate, $comparison);

        return $this;
    }

    /**
     * Filter the query on the weekday column
     *
     * Example usage:
     * <code>
     * $query->filterByWeekday(1234); // WHERE weekday = 1234
     * $query->filterByWeekday(array(12, 34)); // WHERE weekday IN (12, 34)
     * $query->filterByWeekday(array('min' => 12)); // WHERE weekday > 12
     * </code>
     *
     * @param mixed $weekday The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWeekday($weekday = null, ?string $comparison = null)
    {
        if (is_array($weekday)) {
            $useMinMax = false;
            if (isset($weekday['min'])) {
                $this->addUsingAlias(MtpDayTableMap::COL_WEEKDAY, $weekday['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($weekday['max'])) {
                $this->addUsingAlias(MtpDayTableMap::COL_WEEKDAY, $weekday['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MtpDayTableMap::COL_WEEKDAY, $weekday, $comparison);

        return $this;
    }

    /**
     * Filter the query on the weeknumber column
     *
     * Example usage:
     * <code>
     * $query->filterByWeeknumber(1234); // WHERE weeknumber = 1234
     * $query->filterByWeeknumber(array(12, 34)); // WHERE weeknumber IN (12, 34)
     * $query->filterByWeeknumber(array('min' => 12)); // WHERE weeknumber > 12
     * </code>
     *
     * @param mixed $weeknumber The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWeeknumber($weeknumber = null, ?string $comparison = null)
    {
        if (is_array($weeknumber)) {
            $useMinMax = false;
            if (isset($weeknumber['min'])) {
                $this->addUsingAlias(MtpDayTableMap::COL_WEEKNUMBER, $weeknumber['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($weeknumber['max'])) {
                $this->addUsingAlias(MtpDayTableMap::COL_WEEKNUMBER, $weeknumber['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MtpDayTableMap::COL_WEEKNUMBER, $weeknumber, $comparison);

        return $this;
    }

    /**
     * Filter the query on the mtp_id column
     *
     * Example usage:
     * <code>
     * $query->filterByMtpId(1234); // WHERE mtp_id = 1234
     * $query->filterByMtpId(array(12, 34)); // WHERE mtp_id IN (12, 34)
     * $query->filterByMtpId(array('min' => 12)); // WHERE mtp_id > 12
     * </code>
     *
     * @see       filterByMtp()
     *
     * @param mixed $mtpId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMtpId($mtpId = null, ?string $comparison = null)
    {
        if (is_array($mtpId)) {
            $useMinMax = false;
            if (isset($mtpId['min'])) {
                $this->addUsingAlias(MtpDayTableMap::COL_MTP_ID, $mtpId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($mtpId['max'])) {
                $this->addUsingAlias(MtpDayTableMap::COL_MTP_ID, $mtpId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MtpDayTableMap::COL_MTP_ID, $mtpId, $comparison);

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
                $this->addUsingAlias(MtpDayTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(MtpDayTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MtpDayTableMap::COL_COMPANY_ID, $companyId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the mtpday_remark column
     *
     * Example usage:
     * <code>
     * $query->filterByMtpdayRemark('fooValue');   // WHERE mtpday_remark = 'fooValue'
     * $query->filterByMtpdayRemark('%fooValue%', Criteria::LIKE); // WHERE mtpday_remark LIKE '%fooValue%'
     * $query->filterByMtpdayRemark(['foo', 'bar']); // WHERE mtpday_remark IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $mtpdayRemark The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMtpdayRemark($mtpdayRemark = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($mtpdayRemark)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MtpDayTableMap::COL_MTPDAY_REMARK, $mtpdayRemark, $comparison);

        return $this;
    }

    /**
     * Filter the query on the ishalfday column
     *
     * Example usage:
     * <code>
     * $query->filterByIshalfday(true); // WHERE ishalfday = true
     * $query->filterByIshalfday('yes'); // WHERE ishalfday = true
     * </code>
     *
     * @param bool|string $ishalfday The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIshalfday($ishalfday = null, ?string $comparison = null)
    {
        if (is_string($ishalfday)) {
            $ishalfday = in_array(strtolower($ishalfday), array('false', 'off', '-', 'no', 'n', '0', ''), true) ? false : true;
        }

        $this->addUsingAlias(MtpDayTableMap::COL_ISHALFDAY, $ishalfday, $comparison);

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
                $this->addUsingAlias(MtpDayTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(MtpDayTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MtpDayTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(MtpDayTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(MtpDayTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MtpDayTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

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
                ->addUsingAlias(MtpDayTableMap::COL_COMPANY_ID, $company->getCompanyId(), $comparison);
        } elseif ($company instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(MtpDayTableMap::COL_COMPANY_ID, $company->toKeyValue('PrimaryKey', 'CompanyId'), $comparison);

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
     * Filter the query by a related \entities\Mtp object
     *
     * @param \entities\Mtp|ObjectCollection $mtp The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMtp($mtp, ?string $comparison = null)
    {
        if ($mtp instanceof \entities\Mtp) {
            return $this
                ->addUsingAlias(MtpDayTableMap::COL_MTP_ID, $mtp->getMtpId(), $comparison);
        } elseif ($mtp instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(MtpDayTableMap::COL_MTP_ID, $mtp->toKeyValue('PrimaryKey', 'MtpId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByMtp() only accepts arguments of type \entities\Mtp or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Mtp relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinMtp(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Mtp');

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
            $this->addJoinObject($join, 'Mtp');
        }

        return $this;
    }

    /**
     * Use the Mtp relation Mtp object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\MtpQuery A secondary query class using the current class as primary query
     */
    public function useMtpQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinMtp($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Mtp', '\entities\MtpQuery');
    }

    /**
     * Use the Mtp relation Mtp object
     *
     * @param callable(\entities\MtpQuery):\entities\MtpQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withMtpQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useMtpQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Mtp table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\MtpQuery The inner query object of the EXISTS statement
     */
    public function useMtpExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\MtpQuery */
        $q = $this->useExistsQuery('Mtp', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Mtp table for a NOT EXISTS query.
     *
     * @see useMtpExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\MtpQuery The inner query object of the NOT EXISTS statement
     */
    public function useMtpNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\MtpQuery */
        $q = $this->useExistsQuery('Mtp', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Mtp table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\MtpQuery The inner query object of the IN statement
     */
    public function useInMtpQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\MtpQuery */
        $q = $this->useInQuery('Mtp', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Mtp table for a NOT IN query.
     *
     * @see useMtpInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\MtpQuery The inner query object of the NOT IN statement
     */
    public function useNotInMtpQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\MtpQuery */
        $q = $this->useInQuery('Mtp', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\Tourplans object
     *
     * @param \entities\Tourplans|ObjectCollection $tourplans the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTourplans($tourplans, ?string $comparison = null)
    {
        if ($tourplans instanceof \entities\Tourplans) {
            $this
                ->addUsingAlias(MtpDayTableMap::COL_MTP_DAY_ID, $tourplans->getMtpDayId(), $comparison);

            return $this;
        } elseif ($tourplans instanceof ObjectCollection) {
            $this
                ->useTourplansQuery()
                ->filterByPrimaryKeys($tourplans->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByTourplans() only accepts arguments of type \entities\Tourplans or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Tourplans relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinTourplans(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Tourplans');

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
            $this->addJoinObject($join, 'Tourplans');
        }

        return $this;
    }

    /**
     * Use the Tourplans relation Tourplans object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\TourplansQuery A secondary query class using the current class as primary query
     */
    public function useTourplansQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinTourplans($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Tourplans', '\entities\TourplansQuery');
    }

    /**
     * Use the Tourplans relation Tourplans object
     *
     * @param callable(\entities\TourplansQuery):\entities\TourplansQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withTourplansQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useTourplansQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Tourplans table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\TourplansQuery The inner query object of the EXISTS statement
     */
    public function useTourplansExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\TourplansQuery */
        $q = $this->useExistsQuery('Tourplans', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Tourplans table for a NOT EXISTS query.
     *
     * @see useTourplansExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\TourplansQuery The inner query object of the NOT EXISTS statement
     */
    public function useTourplansNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\TourplansQuery */
        $q = $this->useExistsQuery('Tourplans', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Tourplans table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\TourplansQuery The inner query object of the IN statement
     */
    public function useInTourplansQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\TourplansQuery */
        $q = $this->useInQuery('Tourplans', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Tourplans table for a NOT IN query.
     *
     * @see useTourplansInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\TourplansQuery The inner query object of the NOT IN statement
     */
    public function useNotInTourplansQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\TourplansQuery */
        $q = $this->useInQuery('Tourplans', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildMtpDay $mtpDay Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($mtpDay = null)
    {
        if ($mtpDay) {
            $this->addUsingAlias(MtpDayTableMap::COL_MTP_DAY_ID, $mtpDay->getMtpDayId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the mtp_day table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(MtpDayTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            MtpDayTableMap::clearInstancePool();
            MtpDayTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(MtpDayTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(MtpDayTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            MtpDayTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            MtpDayTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
