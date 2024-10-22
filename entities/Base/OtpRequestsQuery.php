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
use entities\OtpRequests as ChildOtpRequests;
use entities\OtpRequestsQuery as ChildOtpRequestsQuery;
use entities\Map\OtpRequestsTableMap;

/**
 * Base class that represents a query for the `otp_requests` table.
 *
 * @method     ChildOtpRequestsQuery orderByOtpreqid($order = Criteria::ASC) Order by the otpreqid column
 * @method     ChildOtpRequestsQuery orderByOtpReqMobile($order = Criteria::ASC) Order by the otp_req_mobile column
 * @method     ChildOtpRequestsQuery orderByOtpReqCountrycode($order = Criteria::ASC) Order by the otp_req_countrycode column
 * @method     ChildOtpRequestsQuery orderByOtpRequestReason($order = Criteria::ASC) Order by the otp_request_reason column
 * @method     ChildOtpRequestsQuery orderByOtpDocId($order = Criteria::ASC) Order by the otp_doc_id column
 * @method     ChildOtpRequestsQuery orderByOtp($order = Criteria::ASC) Order by the otp column
 * @method     ChildOtpRequestsQuery orderByOtpRequestEmployee($order = Criteria::ASC) Order by the otp_request_employee column
 * @method     ChildOtpRequestsQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildOtpRequestsQuery orderByOtpReqCreatedDate($order = Criteria::ASC) Order by the otp_req_created_date column
 * @method     ChildOtpRequestsQuery orderByOtpVerified($order = Criteria::ASC) Order by the otp_verified column
 * @method     ChildOtpRequestsQuery orderByOtpVerifiedDate($order = Criteria::ASC) Order by the otp_verified_date column
 *
 * @method     ChildOtpRequestsQuery groupByOtpreqid() Group by the otpreqid column
 * @method     ChildOtpRequestsQuery groupByOtpReqMobile() Group by the otp_req_mobile column
 * @method     ChildOtpRequestsQuery groupByOtpReqCountrycode() Group by the otp_req_countrycode column
 * @method     ChildOtpRequestsQuery groupByOtpRequestReason() Group by the otp_request_reason column
 * @method     ChildOtpRequestsQuery groupByOtpDocId() Group by the otp_doc_id column
 * @method     ChildOtpRequestsQuery groupByOtp() Group by the otp column
 * @method     ChildOtpRequestsQuery groupByOtpRequestEmployee() Group by the otp_request_employee column
 * @method     ChildOtpRequestsQuery groupByCompanyId() Group by the company_id column
 * @method     ChildOtpRequestsQuery groupByOtpReqCreatedDate() Group by the otp_req_created_date column
 * @method     ChildOtpRequestsQuery groupByOtpVerified() Group by the otp_verified column
 * @method     ChildOtpRequestsQuery groupByOtpVerifiedDate() Group by the otp_verified_date column
 *
 * @method     ChildOtpRequestsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildOtpRequestsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildOtpRequestsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildOtpRequestsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildOtpRequestsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildOtpRequestsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildOtpRequestsQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildOtpRequestsQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildOtpRequestsQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildOtpRequestsQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildOtpRequestsQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildOtpRequestsQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildOtpRequestsQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     ChildOtpRequestsQuery leftJoinEmployee($relationAlias = null) Adds a LEFT JOIN clause to the query using the Employee relation
 * @method     ChildOtpRequestsQuery rightJoinEmployee($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Employee relation
 * @method     ChildOtpRequestsQuery innerJoinEmployee($relationAlias = null) Adds a INNER JOIN clause to the query using the Employee relation
 *
 * @method     ChildOtpRequestsQuery joinWithEmployee($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Employee relation
 *
 * @method     ChildOtpRequestsQuery leftJoinWithEmployee() Adds a LEFT JOIN clause and with to the query using the Employee relation
 * @method     ChildOtpRequestsQuery rightJoinWithEmployee() Adds a RIGHT JOIN clause and with to the query using the Employee relation
 * @method     ChildOtpRequestsQuery innerJoinWithEmployee() Adds a INNER JOIN clause and with to the query using the Employee relation
 *
 * @method     \entities\CompanyQuery|\entities\EmployeeQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildOtpRequests|null findOne(?ConnectionInterface $con = null) Return the first ChildOtpRequests matching the query
 * @method     ChildOtpRequests findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildOtpRequests matching the query, or a new ChildOtpRequests object populated from the query conditions when no match is found
 *
 * @method     ChildOtpRequests|null findOneByOtpreqid(int $otpreqid) Return the first ChildOtpRequests filtered by the otpreqid column
 * @method     ChildOtpRequests|null findOneByOtpReqMobile(string $otp_req_mobile) Return the first ChildOtpRequests filtered by the otp_req_mobile column
 * @method     ChildOtpRequests|null findOneByOtpReqCountrycode(string $otp_req_countrycode) Return the first ChildOtpRequests filtered by the otp_req_countrycode column
 * @method     ChildOtpRequests|null findOneByOtpRequestReason(string $otp_request_reason) Return the first ChildOtpRequests filtered by the otp_request_reason column
 * @method     ChildOtpRequests|null findOneByOtpDocId(int $otp_doc_id) Return the first ChildOtpRequests filtered by the otp_doc_id column
 * @method     ChildOtpRequests|null findOneByOtp(int $otp) Return the first ChildOtpRequests filtered by the otp column
 * @method     ChildOtpRequests|null findOneByOtpRequestEmployee(int $otp_request_employee) Return the first ChildOtpRequests filtered by the otp_request_employee column
 * @method     ChildOtpRequests|null findOneByCompanyId(int $company_id) Return the first ChildOtpRequests filtered by the company_id column
 * @method     ChildOtpRequests|null findOneByOtpReqCreatedDate(string $otp_req_created_date) Return the first ChildOtpRequests filtered by the otp_req_created_date column
 * @method     ChildOtpRequests|null findOneByOtpVerified(int $otp_verified) Return the first ChildOtpRequests filtered by the otp_verified column
 * @method     ChildOtpRequests|null findOneByOtpVerifiedDate(string $otp_verified_date) Return the first ChildOtpRequests filtered by the otp_verified_date column
 *
 * @method     ChildOtpRequests requirePk($key, ?ConnectionInterface $con = null) Return the ChildOtpRequests by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOtpRequests requireOne(?ConnectionInterface $con = null) Return the first ChildOtpRequests matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOtpRequests requireOneByOtpreqid(int $otpreqid) Return the first ChildOtpRequests filtered by the otpreqid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOtpRequests requireOneByOtpReqMobile(string $otp_req_mobile) Return the first ChildOtpRequests filtered by the otp_req_mobile column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOtpRequests requireOneByOtpReqCountrycode(string $otp_req_countrycode) Return the first ChildOtpRequests filtered by the otp_req_countrycode column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOtpRequests requireOneByOtpRequestReason(string $otp_request_reason) Return the first ChildOtpRequests filtered by the otp_request_reason column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOtpRequests requireOneByOtpDocId(int $otp_doc_id) Return the first ChildOtpRequests filtered by the otp_doc_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOtpRequests requireOneByOtp(int $otp) Return the first ChildOtpRequests filtered by the otp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOtpRequests requireOneByOtpRequestEmployee(int $otp_request_employee) Return the first ChildOtpRequests filtered by the otp_request_employee column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOtpRequests requireOneByCompanyId(int $company_id) Return the first ChildOtpRequests filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOtpRequests requireOneByOtpReqCreatedDate(string $otp_req_created_date) Return the first ChildOtpRequests filtered by the otp_req_created_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOtpRequests requireOneByOtpVerified(int $otp_verified) Return the first ChildOtpRequests filtered by the otp_verified column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOtpRequests requireOneByOtpVerifiedDate(string $otp_verified_date) Return the first ChildOtpRequests filtered by the otp_verified_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOtpRequests[]|Collection find(?ConnectionInterface $con = null) Return ChildOtpRequests objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildOtpRequests> find(?ConnectionInterface $con = null) Return ChildOtpRequests objects based on current ModelCriteria
 *
 * @method     ChildOtpRequests[]|Collection findByOtpreqid(int|array<int> $otpreqid) Return ChildOtpRequests objects filtered by the otpreqid column
 * @psalm-method Collection&\Traversable<ChildOtpRequests> findByOtpreqid(int|array<int> $otpreqid) Return ChildOtpRequests objects filtered by the otpreqid column
 * @method     ChildOtpRequests[]|Collection findByOtpReqMobile(string|array<string> $otp_req_mobile) Return ChildOtpRequests objects filtered by the otp_req_mobile column
 * @psalm-method Collection&\Traversable<ChildOtpRequests> findByOtpReqMobile(string|array<string> $otp_req_mobile) Return ChildOtpRequests objects filtered by the otp_req_mobile column
 * @method     ChildOtpRequests[]|Collection findByOtpReqCountrycode(string|array<string> $otp_req_countrycode) Return ChildOtpRequests objects filtered by the otp_req_countrycode column
 * @psalm-method Collection&\Traversable<ChildOtpRequests> findByOtpReqCountrycode(string|array<string> $otp_req_countrycode) Return ChildOtpRequests objects filtered by the otp_req_countrycode column
 * @method     ChildOtpRequests[]|Collection findByOtpRequestReason(string|array<string> $otp_request_reason) Return ChildOtpRequests objects filtered by the otp_request_reason column
 * @psalm-method Collection&\Traversable<ChildOtpRequests> findByOtpRequestReason(string|array<string> $otp_request_reason) Return ChildOtpRequests objects filtered by the otp_request_reason column
 * @method     ChildOtpRequests[]|Collection findByOtpDocId(int|array<int> $otp_doc_id) Return ChildOtpRequests objects filtered by the otp_doc_id column
 * @psalm-method Collection&\Traversable<ChildOtpRequests> findByOtpDocId(int|array<int> $otp_doc_id) Return ChildOtpRequests objects filtered by the otp_doc_id column
 * @method     ChildOtpRequests[]|Collection findByOtp(int|array<int> $otp) Return ChildOtpRequests objects filtered by the otp column
 * @psalm-method Collection&\Traversable<ChildOtpRequests> findByOtp(int|array<int> $otp) Return ChildOtpRequests objects filtered by the otp column
 * @method     ChildOtpRequests[]|Collection findByOtpRequestEmployee(int|array<int> $otp_request_employee) Return ChildOtpRequests objects filtered by the otp_request_employee column
 * @psalm-method Collection&\Traversable<ChildOtpRequests> findByOtpRequestEmployee(int|array<int> $otp_request_employee) Return ChildOtpRequests objects filtered by the otp_request_employee column
 * @method     ChildOtpRequests[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildOtpRequests objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildOtpRequests> findByCompanyId(int|array<int> $company_id) Return ChildOtpRequests objects filtered by the company_id column
 * @method     ChildOtpRequests[]|Collection findByOtpReqCreatedDate(string|array<string> $otp_req_created_date) Return ChildOtpRequests objects filtered by the otp_req_created_date column
 * @psalm-method Collection&\Traversable<ChildOtpRequests> findByOtpReqCreatedDate(string|array<string> $otp_req_created_date) Return ChildOtpRequests objects filtered by the otp_req_created_date column
 * @method     ChildOtpRequests[]|Collection findByOtpVerified(int|array<int> $otp_verified) Return ChildOtpRequests objects filtered by the otp_verified column
 * @psalm-method Collection&\Traversable<ChildOtpRequests> findByOtpVerified(int|array<int> $otp_verified) Return ChildOtpRequests objects filtered by the otp_verified column
 * @method     ChildOtpRequests[]|Collection findByOtpVerifiedDate(string|array<string> $otp_verified_date) Return ChildOtpRequests objects filtered by the otp_verified_date column
 * @psalm-method Collection&\Traversable<ChildOtpRequests> findByOtpVerifiedDate(string|array<string> $otp_verified_date) Return ChildOtpRequests objects filtered by the otp_verified_date column
 *
 * @method     ChildOtpRequests[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildOtpRequests> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class OtpRequestsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\OtpRequestsQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\OtpRequests', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildOtpRequestsQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildOtpRequestsQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildOtpRequestsQuery) {
            return $criteria;
        }
        $query = new ChildOtpRequestsQuery();
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
     * @return ChildOtpRequests|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(OtpRequestsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = OtpRequestsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildOtpRequests A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT otpreqid, otp_req_mobile, otp_req_countrycode, otp_request_reason, otp_doc_id, otp, otp_request_employee, company_id, otp_req_created_date, otp_verified, otp_verified_date FROM otp_requests WHERE otpreqid = :p0';
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
            /** @var ChildOtpRequests $obj */
            $obj = new ChildOtpRequests();
            $obj->hydrate($row);
            OtpRequestsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildOtpRequests|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(OtpRequestsTableMap::COL_OTPREQID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(OtpRequestsTableMap::COL_OTPREQID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the otpreqid column
     *
     * Example usage:
     * <code>
     * $query->filterByOtpreqid(1234); // WHERE otpreqid = 1234
     * $query->filterByOtpreqid(array(12, 34)); // WHERE otpreqid IN (12, 34)
     * $query->filterByOtpreqid(array('min' => 12)); // WHERE otpreqid > 12
     * </code>
     *
     * @param mixed $otpreqid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOtpreqid($otpreqid = null, ?string $comparison = null)
    {
        if (is_array($otpreqid)) {
            $useMinMax = false;
            if (isset($otpreqid['min'])) {
                $this->addUsingAlias(OtpRequestsTableMap::COL_OTPREQID, $otpreqid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($otpreqid['max'])) {
                $this->addUsingAlias(OtpRequestsTableMap::COL_OTPREQID, $otpreqid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OtpRequestsTableMap::COL_OTPREQID, $otpreqid, $comparison);

        return $this;
    }

    /**
     * Filter the query on the otp_req_mobile column
     *
     * Example usage:
     * <code>
     * $query->filterByOtpReqMobile('fooValue');   // WHERE otp_req_mobile = 'fooValue'
     * $query->filterByOtpReqMobile('%fooValue%', Criteria::LIKE); // WHERE otp_req_mobile LIKE '%fooValue%'
     * $query->filterByOtpReqMobile(['foo', 'bar']); // WHERE otp_req_mobile IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $otpReqMobile The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOtpReqMobile($otpReqMobile = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($otpReqMobile)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OtpRequestsTableMap::COL_OTP_REQ_MOBILE, $otpReqMobile, $comparison);

        return $this;
    }

    /**
     * Filter the query on the otp_req_countrycode column
     *
     * Example usage:
     * <code>
     * $query->filterByOtpReqCountrycode('fooValue');   // WHERE otp_req_countrycode = 'fooValue'
     * $query->filterByOtpReqCountrycode('%fooValue%', Criteria::LIKE); // WHERE otp_req_countrycode LIKE '%fooValue%'
     * $query->filterByOtpReqCountrycode(['foo', 'bar']); // WHERE otp_req_countrycode IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $otpReqCountrycode The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOtpReqCountrycode($otpReqCountrycode = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($otpReqCountrycode)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OtpRequestsTableMap::COL_OTP_REQ_COUNTRYCODE, $otpReqCountrycode, $comparison);

        return $this;
    }

    /**
     * Filter the query on the otp_request_reason column
     *
     * Example usage:
     * <code>
     * $query->filterByOtpRequestReason('fooValue');   // WHERE otp_request_reason = 'fooValue'
     * $query->filterByOtpRequestReason('%fooValue%', Criteria::LIKE); // WHERE otp_request_reason LIKE '%fooValue%'
     * $query->filterByOtpRequestReason(['foo', 'bar']); // WHERE otp_request_reason IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $otpRequestReason The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOtpRequestReason($otpRequestReason = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($otpRequestReason)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OtpRequestsTableMap::COL_OTP_REQUEST_REASON, $otpRequestReason, $comparison);

        return $this;
    }

    /**
     * Filter the query on the otp_doc_id column
     *
     * Example usage:
     * <code>
     * $query->filterByOtpDocId(1234); // WHERE otp_doc_id = 1234
     * $query->filterByOtpDocId(array(12, 34)); // WHERE otp_doc_id IN (12, 34)
     * $query->filterByOtpDocId(array('min' => 12)); // WHERE otp_doc_id > 12
     * </code>
     *
     * @param mixed $otpDocId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOtpDocId($otpDocId = null, ?string $comparison = null)
    {
        if (is_array($otpDocId)) {
            $useMinMax = false;
            if (isset($otpDocId['min'])) {
                $this->addUsingAlias(OtpRequestsTableMap::COL_OTP_DOC_ID, $otpDocId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($otpDocId['max'])) {
                $this->addUsingAlias(OtpRequestsTableMap::COL_OTP_DOC_ID, $otpDocId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OtpRequestsTableMap::COL_OTP_DOC_ID, $otpDocId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the otp column
     *
     * Example usage:
     * <code>
     * $query->filterByOtp(1234); // WHERE otp = 1234
     * $query->filterByOtp(array(12, 34)); // WHERE otp IN (12, 34)
     * $query->filterByOtp(array('min' => 12)); // WHERE otp > 12
     * </code>
     *
     * @param mixed $otp The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOtp($otp = null, ?string $comparison = null)
    {
        if (is_array($otp)) {
            $useMinMax = false;
            if (isset($otp['min'])) {
                $this->addUsingAlias(OtpRequestsTableMap::COL_OTP, $otp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($otp['max'])) {
                $this->addUsingAlias(OtpRequestsTableMap::COL_OTP, $otp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OtpRequestsTableMap::COL_OTP, $otp, $comparison);

        return $this;
    }

    /**
     * Filter the query on the otp_request_employee column
     *
     * Example usage:
     * <code>
     * $query->filterByOtpRequestEmployee(1234); // WHERE otp_request_employee = 1234
     * $query->filterByOtpRequestEmployee(array(12, 34)); // WHERE otp_request_employee IN (12, 34)
     * $query->filterByOtpRequestEmployee(array('min' => 12)); // WHERE otp_request_employee > 12
     * </code>
     *
     * @see       filterByEmployee()
     *
     * @param mixed $otpRequestEmployee The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOtpRequestEmployee($otpRequestEmployee = null, ?string $comparison = null)
    {
        if (is_array($otpRequestEmployee)) {
            $useMinMax = false;
            if (isset($otpRequestEmployee['min'])) {
                $this->addUsingAlias(OtpRequestsTableMap::COL_OTP_REQUEST_EMPLOYEE, $otpRequestEmployee['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($otpRequestEmployee['max'])) {
                $this->addUsingAlias(OtpRequestsTableMap::COL_OTP_REQUEST_EMPLOYEE, $otpRequestEmployee['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OtpRequestsTableMap::COL_OTP_REQUEST_EMPLOYEE, $otpRequestEmployee, $comparison);

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
                $this->addUsingAlias(OtpRequestsTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(OtpRequestsTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OtpRequestsTableMap::COL_COMPANY_ID, $companyId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the otp_req_created_date column
     *
     * Example usage:
     * <code>
     * $query->filterByOtpReqCreatedDate('2011-03-14'); // WHERE otp_req_created_date = '2011-03-14'
     * $query->filterByOtpReqCreatedDate('now'); // WHERE otp_req_created_date = '2011-03-14'
     * $query->filterByOtpReqCreatedDate(array('max' => 'yesterday')); // WHERE otp_req_created_date > '2011-03-13'
     * </code>
     *
     * @param mixed $otpReqCreatedDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOtpReqCreatedDate($otpReqCreatedDate = null, ?string $comparison = null)
    {
        if (is_array($otpReqCreatedDate)) {
            $useMinMax = false;
            if (isset($otpReqCreatedDate['min'])) {
                $this->addUsingAlias(OtpRequestsTableMap::COL_OTP_REQ_CREATED_DATE, $otpReqCreatedDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($otpReqCreatedDate['max'])) {
                $this->addUsingAlias(OtpRequestsTableMap::COL_OTP_REQ_CREATED_DATE, $otpReqCreatedDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OtpRequestsTableMap::COL_OTP_REQ_CREATED_DATE, $otpReqCreatedDate, $comparison);

        return $this;
    }

    /**
     * Filter the query on the otp_verified column
     *
     * Example usage:
     * <code>
     * $query->filterByOtpVerified(1234); // WHERE otp_verified = 1234
     * $query->filterByOtpVerified(array(12, 34)); // WHERE otp_verified IN (12, 34)
     * $query->filterByOtpVerified(array('min' => 12)); // WHERE otp_verified > 12
     * </code>
     *
     * @param mixed $otpVerified The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOtpVerified($otpVerified = null, ?string $comparison = null)
    {
        if (is_array($otpVerified)) {
            $useMinMax = false;
            if (isset($otpVerified['min'])) {
                $this->addUsingAlias(OtpRequestsTableMap::COL_OTP_VERIFIED, $otpVerified['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($otpVerified['max'])) {
                $this->addUsingAlias(OtpRequestsTableMap::COL_OTP_VERIFIED, $otpVerified['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OtpRequestsTableMap::COL_OTP_VERIFIED, $otpVerified, $comparison);

        return $this;
    }

    /**
     * Filter the query on the otp_verified_date column
     *
     * Example usage:
     * <code>
     * $query->filterByOtpVerifiedDate('2011-03-14'); // WHERE otp_verified_date = '2011-03-14'
     * $query->filterByOtpVerifiedDate('now'); // WHERE otp_verified_date = '2011-03-14'
     * $query->filterByOtpVerifiedDate(array('max' => 'yesterday')); // WHERE otp_verified_date > '2011-03-13'
     * </code>
     *
     * @param mixed $otpVerifiedDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOtpVerifiedDate($otpVerifiedDate = null, ?string $comparison = null)
    {
        if (is_array($otpVerifiedDate)) {
            $useMinMax = false;
            if (isset($otpVerifiedDate['min'])) {
                $this->addUsingAlias(OtpRequestsTableMap::COL_OTP_VERIFIED_DATE, $otpVerifiedDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($otpVerifiedDate['max'])) {
                $this->addUsingAlias(OtpRequestsTableMap::COL_OTP_VERIFIED_DATE, $otpVerifiedDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OtpRequestsTableMap::COL_OTP_VERIFIED_DATE, $otpVerifiedDate, $comparison);

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
                ->addUsingAlias(OtpRequestsTableMap::COL_COMPANY_ID, $company->getCompanyId(), $comparison);
        } elseif ($company instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(OtpRequestsTableMap::COL_COMPANY_ID, $company->toKeyValue('PrimaryKey', 'CompanyId'), $comparison);

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
     * Filter the query by a related \entities\Employee object
     *
     * @param \entities\Employee|ObjectCollection $employee The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmployee($employee, ?string $comparison = null)
    {
        if ($employee instanceof \entities\Employee) {
            return $this
                ->addUsingAlias(OtpRequestsTableMap::COL_OTP_REQUEST_EMPLOYEE, $employee->getEmployeeId(), $comparison);
        } elseif ($employee instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(OtpRequestsTableMap::COL_OTP_REQUEST_EMPLOYEE, $employee->toKeyValue('PrimaryKey', 'EmployeeId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByEmployee() only accepts arguments of type \entities\Employee or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Employee relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinEmployee(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Employee');

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
            $this->addJoinObject($join, 'Employee');
        }

        return $this;
    }

    /**
     * Use the Employee relation Employee object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\EmployeeQuery A secondary query class using the current class as primary query
     */
    public function useEmployeeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinEmployee($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Employee', '\entities\EmployeeQuery');
    }

    /**
     * Use the Employee relation Employee object
     *
     * @param callable(\entities\EmployeeQuery):\entities\EmployeeQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withEmployeeQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useEmployeeQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Employee table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\EmployeeQuery The inner query object of the EXISTS statement
     */
    public function useEmployeeExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\EmployeeQuery */
        $q = $this->useExistsQuery('Employee', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Employee table for a NOT EXISTS query.
     *
     * @see useEmployeeExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\EmployeeQuery The inner query object of the NOT EXISTS statement
     */
    public function useEmployeeNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\EmployeeQuery */
        $q = $this->useExistsQuery('Employee', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Employee table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\EmployeeQuery The inner query object of the IN statement
     */
    public function useInEmployeeQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\EmployeeQuery */
        $q = $this->useInQuery('Employee', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Employee table for a NOT IN query.
     *
     * @see useEmployeeInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\EmployeeQuery The inner query object of the NOT IN statement
     */
    public function useNotInEmployeeQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\EmployeeQuery */
        $q = $this->useInQuery('Employee', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildOtpRequests $otpRequests Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($otpRequests = null)
    {
        if ($otpRequests) {
            $this->addUsingAlias(OtpRequestsTableMap::COL_OTPREQID, $otpRequests->getOtpreqid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the otp_requests table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OtpRequestsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            OtpRequestsTableMap::clearInstancePool();
            OtpRequestsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(OtpRequestsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(OtpRequestsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            OtpRequestsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            OtpRequestsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
