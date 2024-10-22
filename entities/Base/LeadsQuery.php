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
use entities\Leads as ChildLeads;
use entities\LeadsQuery as ChildLeadsQuery;
use entities\Map\LeadsTableMap;

/**
 * Base class that represents a query for the `leads` table.
 *
 * @method     ChildLeadsQuery orderByLeadId($order = Criteria::ASC) Order by the lead_id column
 * @method     ChildLeadsQuery orderByPositionId($order = Criteria::ASC) Order by the position_id column
 * @method     ChildLeadsQuery orderByClassificationId($order = Criteria::ASC) Order by the classification_id column
 * @method     ChildLeadsQuery orderByFirstName($order = Criteria::ASC) Order by the first_name column
 * @method     ChildLeadsQuery orderByLastName($order = Criteria::ASC) Order by the last_name column
 * @method     ChildLeadsQuery orderByEmail($order = Criteria::ASC) Order by the email column
 * @method     ChildLeadsQuery orderByMobile($order = Criteria::ASC) Order by the mobile column
 * @method     ChildLeadsQuery orderByGender($order = Criteria::ASC) Order by the gender column
 * @method     ChildLeadsQuery orderByDob($order = Criteria::ASC) Order by the dob column
 * @method     ChildLeadsQuery orderByMaritalStatus($order = Criteria::ASC) Order by the marital_status column
 * @method     ChildLeadsQuery orderByAnniversary($order = Criteria::ASC) Order by the anniversary column
 * @method     ChildLeadsQuery orderByEducation($order = Criteria::ASC) Order by the education column
 * @method     ChildLeadsQuery orderByRegNo($order = Criteria::ASC) Order by the reg_no column
 * @method     ChildLeadsQuery orderByReason($order = Criteria::ASC) Order by the reason column
 * @method     ChildLeadsQuery orderByDeviceTimestamp($order = Criteria::ASC) Order by the device_timestamp column
 * @method     ChildLeadsQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildLeadsQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildLeadsQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildLeadsQuery groupByLeadId() Group by the lead_id column
 * @method     ChildLeadsQuery groupByPositionId() Group by the position_id column
 * @method     ChildLeadsQuery groupByClassificationId() Group by the classification_id column
 * @method     ChildLeadsQuery groupByFirstName() Group by the first_name column
 * @method     ChildLeadsQuery groupByLastName() Group by the last_name column
 * @method     ChildLeadsQuery groupByEmail() Group by the email column
 * @method     ChildLeadsQuery groupByMobile() Group by the mobile column
 * @method     ChildLeadsQuery groupByGender() Group by the gender column
 * @method     ChildLeadsQuery groupByDob() Group by the dob column
 * @method     ChildLeadsQuery groupByMaritalStatus() Group by the marital_status column
 * @method     ChildLeadsQuery groupByAnniversary() Group by the anniversary column
 * @method     ChildLeadsQuery groupByEducation() Group by the education column
 * @method     ChildLeadsQuery groupByRegNo() Group by the reg_no column
 * @method     ChildLeadsQuery groupByReason() Group by the reason column
 * @method     ChildLeadsQuery groupByDeviceTimestamp() Group by the device_timestamp column
 * @method     ChildLeadsQuery groupByCompanyId() Group by the company_id column
 * @method     ChildLeadsQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildLeadsQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildLeadsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildLeadsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildLeadsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildLeadsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildLeadsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildLeadsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildLeads|null findOne(?ConnectionInterface $con = null) Return the first ChildLeads matching the query
 * @method     ChildLeads findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildLeads matching the query, or a new ChildLeads object populated from the query conditions when no match is found
 *
 * @method     ChildLeads|null findOneByLeadId(int $lead_id) Return the first ChildLeads filtered by the lead_id column
 * @method     ChildLeads|null findOneByPositionId(int $position_id) Return the first ChildLeads filtered by the position_id column
 * @method     ChildLeads|null findOneByClassificationId(int $classification_id) Return the first ChildLeads filtered by the classification_id column
 * @method     ChildLeads|null findOneByFirstName(string $first_name) Return the first ChildLeads filtered by the first_name column
 * @method     ChildLeads|null findOneByLastName(string $last_name) Return the first ChildLeads filtered by the last_name column
 * @method     ChildLeads|null findOneByEmail(string $email) Return the first ChildLeads filtered by the email column
 * @method     ChildLeads|null findOneByMobile(string $mobile) Return the first ChildLeads filtered by the mobile column
 * @method     ChildLeads|null findOneByGender(string $gender) Return the first ChildLeads filtered by the gender column
 * @method     ChildLeads|null findOneByDob(string $dob) Return the first ChildLeads filtered by the dob column
 * @method     ChildLeads|null findOneByMaritalStatus(int $marital_status) Return the first ChildLeads filtered by the marital_status column
 * @method     ChildLeads|null findOneByAnniversary(string $anniversary) Return the first ChildLeads filtered by the anniversary column
 * @method     ChildLeads|null findOneByEducation(string $education) Return the first ChildLeads filtered by the education column
 * @method     ChildLeads|null findOneByRegNo(string $reg_no) Return the first ChildLeads filtered by the reg_no column
 * @method     ChildLeads|null findOneByReason(string $reason) Return the first ChildLeads filtered by the reason column
 * @method     ChildLeads|null findOneByDeviceTimestamp(string $device_timestamp) Return the first ChildLeads filtered by the device_timestamp column
 * @method     ChildLeads|null findOneByCompanyId(int $company_id) Return the first ChildLeads filtered by the company_id column
 * @method     ChildLeads|null findOneByCreatedAt(string $created_at) Return the first ChildLeads filtered by the created_at column
 * @method     ChildLeads|null findOneByUpdatedAt(string $updated_at) Return the first ChildLeads filtered by the updated_at column
 *
 * @method     ChildLeads requirePk($key, ?ConnectionInterface $con = null) Return the ChildLeads by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLeads requireOne(?ConnectionInterface $con = null) Return the first ChildLeads matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildLeads requireOneByLeadId(int $lead_id) Return the first ChildLeads filtered by the lead_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLeads requireOneByPositionId(int $position_id) Return the first ChildLeads filtered by the position_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLeads requireOneByClassificationId(int $classification_id) Return the first ChildLeads filtered by the classification_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLeads requireOneByFirstName(string $first_name) Return the first ChildLeads filtered by the first_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLeads requireOneByLastName(string $last_name) Return the first ChildLeads filtered by the last_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLeads requireOneByEmail(string $email) Return the first ChildLeads filtered by the email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLeads requireOneByMobile(string $mobile) Return the first ChildLeads filtered by the mobile column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLeads requireOneByGender(string $gender) Return the first ChildLeads filtered by the gender column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLeads requireOneByDob(string $dob) Return the first ChildLeads filtered by the dob column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLeads requireOneByMaritalStatus(int $marital_status) Return the first ChildLeads filtered by the marital_status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLeads requireOneByAnniversary(string $anniversary) Return the first ChildLeads filtered by the anniversary column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLeads requireOneByEducation(string $education) Return the first ChildLeads filtered by the education column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLeads requireOneByRegNo(string $reg_no) Return the first ChildLeads filtered by the reg_no column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLeads requireOneByReason(string $reason) Return the first ChildLeads filtered by the reason column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLeads requireOneByDeviceTimestamp(string $device_timestamp) Return the first ChildLeads filtered by the device_timestamp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLeads requireOneByCompanyId(int $company_id) Return the first ChildLeads filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLeads requireOneByCreatedAt(string $created_at) Return the first ChildLeads filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLeads requireOneByUpdatedAt(string $updated_at) Return the first ChildLeads filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildLeads[]|Collection find(?ConnectionInterface $con = null) Return ChildLeads objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildLeads> find(?ConnectionInterface $con = null) Return ChildLeads objects based on current ModelCriteria
 *
 * @method     ChildLeads[]|Collection findByLeadId(int|array<int> $lead_id) Return ChildLeads objects filtered by the lead_id column
 * @psalm-method Collection&\Traversable<ChildLeads> findByLeadId(int|array<int> $lead_id) Return ChildLeads objects filtered by the lead_id column
 * @method     ChildLeads[]|Collection findByPositionId(int|array<int> $position_id) Return ChildLeads objects filtered by the position_id column
 * @psalm-method Collection&\Traversable<ChildLeads> findByPositionId(int|array<int> $position_id) Return ChildLeads objects filtered by the position_id column
 * @method     ChildLeads[]|Collection findByClassificationId(int|array<int> $classification_id) Return ChildLeads objects filtered by the classification_id column
 * @psalm-method Collection&\Traversable<ChildLeads> findByClassificationId(int|array<int> $classification_id) Return ChildLeads objects filtered by the classification_id column
 * @method     ChildLeads[]|Collection findByFirstName(string|array<string> $first_name) Return ChildLeads objects filtered by the first_name column
 * @psalm-method Collection&\Traversable<ChildLeads> findByFirstName(string|array<string> $first_name) Return ChildLeads objects filtered by the first_name column
 * @method     ChildLeads[]|Collection findByLastName(string|array<string> $last_name) Return ChildLeads objects filtered by the last_name column
 * @psalm-method Collection&\Traversable<ChildLeads> findByLastName(string|array<string> $last_name) Return ChildLeads objects filtered by the last_name column
 * @method     ChildLeads[]|Collection findByEmail(string|array<string> $email) Return ChildLeads objects filtered by the email column
 * @psalm-method Collection&\Traversable<ChildLeads> findByEmail(string|array<string> $email) Return ChildLeads objects filtered by the email column
 * @method     ChildLeads[]|Collection findByMobile(string|array<string> $mobile) Return ChildLeads objects filtered by the mobile column
 * @psalm-method Collection&\Traversable<ChildLeads> findByMobile(string|array<string> $mobile) Return ChildLeads objects filtered by the mobile column
 * @method     ChildLeads[]|Collection findByGender(string|array<string> $gender) Return ChildLeads objects filtered by the gender column
 * @psalm-method Collection&\Traversable<ChildLeads> findByGender(string|array<string> $gender) Return ChildLeads objects filtered by the gender column
 * @method     ChildLeads[]|Collection findByDob(string|array<string> $dob) Return ChildLeads objects filtered by the dob column
 * @psalm-method Collection&\Traversable<ChildLeads> findByDob(string|array<string> $dob) Return ChildLeads objects filtered by the dob column
 * @method     ChildLeads[]|Collection findByMaritalStatus(int|array<int> $marital_status) Return ChildLeads objects filtered by the marital_status column
 * @psalm-method Collection&\Traversable<ChildLeads> findByMaritalStatus(int|array<int> $marital_status) Return ChildLeads objects filtered by the marital_status column
 * @method     ChildLeads[]|Collection findByAnniversary(string|array<string> $anniversary) Return ChildLeads objects filtered by the anniversary column
 * @psalm-method Collection&\Traversable<ChildLeads> findByAnniversary(string|array<string> $anniversary) Return ChildLeads objects filtered by the anniversary column
 * @method     ChildLeads[]|Collection findByEducation(string|array<string> $education) Return ChildLeads objects filtered by the education column
 * @psalm-method Collection&\Traversable<ChildLeads> findByEducation(string|array<string> $education) Return ChildLeads objects filtered by the education column
 * @method     ChildLeads[]|Collection findByRegNo(string|array<string> $reg_no) Return ChildLeads objects filtered by the reg_no column
 * @psalm-method Collection&\Traversable<ChildLeads> findByRegNo(string|array<string> $reg_no) Return ChildLeads objects filtered by the reg_no column
 * @method     ChildLeads[]|Collection findByReason(string|array<string> $reason) Return ChildLeads objects filtered by the reason column
 * @psalm-method Collection&\Traversable<ChildLeads> findByReason(string|array<string> $reason) Return ChildLeads objects filtered by the reason column
 * @method     ChildLeads[]|Collection findByDeviceTimestamp(string|array<string> $device_timestamp) Return ChildLeads objects filtered by the device_timestamp column
 * @psalm-method Collection&\Traversable<ChildLeads> findByDeviceTimestamp(string|array<string> $device_timestamp) Return ChildLeads objects filtered by the device_timestamp column
 * @method     ChildLeads[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildLeads objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildLeads> findByCompanyId(int|array<int> $company_id) Return ChildLeads objects filtered by the company_id column
 * @method     ChildLeads[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildLeads objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildLeads> findByCreatedAt(string|array<string> $created_at) Return ChildLeads objects filtered by the created_at column
 * @method     ChildLeads[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildLeads objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildLeads> findByUpdatedAt(string|array<string> $updated_at) Return ChildLeads objects filtered by the updated_at column
 *
 * @method     ChildLeads[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildLeads> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class LeadsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\LeadsQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\Leads', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildLeadsQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildLeadsQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildLeadsQuery) {
            return $criteria;
        }
        $query = new ChildLeadsQuery();
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
     * @return ChildLeads|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(LeadsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = LeadsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildLeads A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT lead_id, position_id, classification_id, first_name, last_name, email, mobile, gender, dob, marital_status, anniversary, education, reg_no, reason, device_timestamp, company_id, created_at, updated_at FROM leads WHERE lead_id = :p0';
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
            /** @var ChildLeads $obj */
            $obj = new ChildLeads();
            $obj->hydrate($row);
            LeadsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildLeads|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(LeadsTableMap::COL_LEAD_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(LeadsTableMap::COL_LEAD_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the lead_id column
     *
     * Example usage:
     * <code>
     * $query->filterByLeadId(1234); // WHERE lead_id = 1234
     * $query->filterByLeadId(array(12, 34)); // WHERE lead_id IN (12, 34)
     * $query->filterByLeadId(array('min' => 12)); // WHERE lead_id > 12
     * </code>
     *
     * @param mixed $leadId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLeadId($leadId = null, ?string $comparison = null)
    {
        if (is_array($leadId)) {
            $useMinMax = false;
            if (isset($leadId['min'])) {
                $this->addUsingAlias(LeadsTableMap::COL_LEAD_ID, $leadId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($leadId['max'])) {
                $this->addUsingAlias(LeadsTableMap::COL_LEAD_ID, $leadId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(LeadsTableMap::COL_LEAD_ID, $leadId, $comparison);

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
                $this->addUsingAlias(LeadsTableMap::COL_POSITION_ID, $positionId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($positionId['max'])) {
                $this->addUsingAlias(LeadsTableMap::COL_POSITION_ID, $positionId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(LeadsTableMap::COL_POSITION_ID, $positionId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the classification_id column
     *
     * Example usage:
     * <code>
     * $query->filterByClassificationId(1234); // WHERE classification_id = 1234
     * $query->filterByClassificationId(array(12, 34)); // WHERE classification_id IN (12, 34)
     * $query->filterByClassificationId(array('min' => 12)); // WHERE classification_id > 12
     * </code>
     *
     * @param mixed $classificationId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByClassificationId($classificationId = null, ?string $comparison = null)
    {
        if (is_array($classificationId)) {
            $useMinMax = false;
            if (isset($classificationId['min'])) {
                $this->addUsingAlias(LeadsTableMap::COL_CLASSIFICATION_ID, $classificationId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($classificationId['max'])) {
                $this->addUsingAlias(LeadsTableMap::COL_CLASSIFICATION_ID, $classificationId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(LeadsTableMap::COL_CLASSIFICATION_ID, $classificationId, $comparison);

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

        $this->addUsingAlias(LeadsTableMap::COL_FIRST_NAME, $firstName, $comparison);

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

        $this->addUsingAlias(LeadsTableMap::COL_LAST_NAME, $lastName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the email column
     *
     * Example usage:
     * <code>
     * $query->filterByEmail('fooValue');   // WHERE email = 'fooValue'
     * $query->filterByEmail('%fooValue%', Criteria::LIKE); // WHERE email LIKE '%fooValue%'
     * $query->filterByEmail(['foo', 'bar']); // WHERE email IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $email The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmail($email = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($email)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(LeadsTableMap::COL_EMAIL, $email, $comparison);

        return $this;
    }

    /**
     * Filter the query on the mobile column
     *
     * Example usage:
     * <code>
     * $query->filterByMobile('fooValue');   // WHERE mobile = 'fooValue'
     * $query->filterByMobile('%fooValue%', Criteria::LIKE); // WHERE mobile LIKE '%fooValue%'
     * $query->filterByMobile(['foo', 'bar']); // WHERE mobile IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $mobile The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMobile($mobile = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($mobile)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(LeadsTableMap::COL_MOBILE, $mobile, $comparison);

        return $this;
    }

    /**
     * Filter the query on the gender column
     *
     * Example usage:
     * <code>
     * $query->filterByGender('fooValue');   // WHERE gender = 'fooValue'
     * $query->filterByGender('%fooValue%', Criteria::LIKE); // WHERE gender LIKE '%fooValue%'
     * $query->filterByGender(['foo', 'bar']); // WHERE gender IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $gender The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByGender($gender = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($gender)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(LeadsTableMap::COL_GENDER, $gender, $comparison);

        return $this;
    }

    /**
     * Filter the query on the dob column
     *
     * Example usage:
     * <code>
     * $query->filterByDob('2011-03-14'); // WHERE dob = '2011-03-14'
     * $query->filterByDob('now'); // WHERE dob = '2011-03-14'
     * $query->filterByDob(array('max' => 'yesterday')); // WHERE dob > '2011-03-13'
     * </code>
     *
     * @param mixed $dob The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDob($dob = null, ?string $comparison = null)
    {
        if (is_array($dob)) {
            $useMinMax = false;
            if (isset($dob['min'])) {
                $this->addUsingAlias(LeadsTableMap::COL_DOB, $dob['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dob['max'])) {
                $this->addUsingAlias(LeadsTableMap::COL_DOB, $dob['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(LeadsTableMap::COL_DOB, $dob, $comparison);

        return $this;
    }

    /**
     * Filter the query on the marital_status column
     *
     * Example usage:
     * <code>
     * $query->filterByMaritalStatus(1234); // WHERE marital_status = 1234
     * $query->filterByMaritalStatus(array(12, 34)); // WHERE marital_status IN (12, 34)
     * $query->filterByMaritalStatus(array('min' => 12)); // WHERE marital_status > 12
     * </code>
     *
     * @param mixed $maritalStatus The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMaritalStatus($maritalStatus = null, ?string $comparison = null)
    {
        if (is_array($maritalStatus)) {
            $useMinMax = false;
            if (isset($maritalStatus['min'])) {
                $this->addUsingAlias(LeadsTableMap::COL_MARITAL_STATUS, $maritalStatus['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($maritalStatus['max'])) {
                $this->addUsingAlias(LeadsTableMap::COL_MARITAL_STATUS, $maritalStatus['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(LeadsTableMap::COL_MARITAL_STATUS, $maritalStatus, $comparison);

        return $this;
    }

    /**
     * Filter the query on the anniversary column
     *
     * Example usage:
     * <code>
     * $query->filterByAnniversary('2011-03-14'); // WHERE anniversary = '2011-03-14'
     * $query->filterByAnniversary('now'); // WHERE anniversary = '2011-03-14'
     * $query->filterByAnniversary(array('max' => 'yesterday')); // WHERE anniversary > '2011-03-13'
     * </code>
     *
     * @param mixed $anniversary The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAnniversary($anniversary = null, ?string $comparison = null)
    {
        if (is_array($anniversary)) {
            $useMinMax = false;
            if (isset($anniversary['min'])) {
                $this->addUsingAlias(LeadsTableMap::COL_ANNIVERSARY, $anniversary['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($anniversary['max'])) {
                $this->addUsingAlias(LeadsTableMap::COL_ANNIVERSARY, $anniversary['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(LeadsTableMap::COL_ANNIVERSARY, $anniversary, $comparison);

        return $this;
    }

    /**
     * Filter the query on the education column
     *
     * Example usage:
     * <code>
     * $query->filterByEducation('fooValue');   // WHERE education = 'fooValue'
     * $query->filterByEducation('%fooValue%', Criteria::LIKE); // WHERE education LIKE '%fooValue%'
     * $query->filterByEducation(['foo', 'bar']); // WHERE education IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $education The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEducation($education = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($education)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(LeadsTableMap::COL_EDUCATION, $education, $comparison);

        return $this;
    }

    /**
     * Filter the query on the reg_no column
     *
     * Example usage:
     * <code>
     * $query->filterByRegNo('fooValue');   // WHERE reg_no = 'fooValue'
     * $query->filterByRegNo('%fooValue%', Criteria::LIKE); // WHERE reg_no LIKE '%fooValue%'
     * $query->filterByRegNo(['foo', 'bar']); // WHERE reg_no IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $regNo The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRegNo($regNo = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($regNo)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(LeadsTableMap::COL_REG_NO, $regNo, $comparison);

        return $this;
    }

    /**
     * Filter the query on the reason column
     *
     * Example usage:
     * <code>
     * $query->filterByReason('fooValue');   // WHERE reason = 'fooValue'
     * $query->filterByReason('%fooValue%', Criteria::LIKE); // WHERE reason LIKE '%fooValue%'
     * $query->filterByReason(['foo', 'bar']); // WHERE reason IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $reason The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByReason($reason = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($reason)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(LeadsTableMap::COL_REASON, $reason, $comparison);

        return $this;
    }

    /**
     * Filter the query on the device_timestamp column
     *
     * Example usage:
     * <code>
     * $query->filterByDeviceTimestamp('2011-03-14'); // WHERE device_timestamp = '2011-03-14'
     * $query->filterByDeviceTimestamp('now'); // WHERE device_timestamp = '2011-03-14'
     * $query->filterByDeviceTimestamp(array('max' => 'yesterday')); // WHERE device_timestamp > '2011-03-13'
     * </code>
     *
     * @param mixed $deviceTimestamp The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDeviceTimestamp($deviceTimestamp = null, ?string $comparison = null)
    {
        if (is_array($deviceTimestamp)) {
            $useMinMax = false;
            if (isset($deviceTimestamp['min'])) {
                $this->addUsingAlias(LeadsTableMap::COL_DEVICE_TIMESTAMP, $deviceTimestamp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($deviceTimestamp['max'])) {
                $this->addUsingAlias(LeadsTableMap::COL_DEVICE_TIMESTAMP, $deviceTimestamp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(LeadsTableMap::COL_DEVICE_TIMESTAMP, $deviceTimestamp, $comparison);

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
                $this->addUsingAlias(LeadsTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(LeadsTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(LeadsTableMap::COL_COMPANY_ID, $companyId, $comparison);

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
                $this->addUsingAlias(LeadsTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(LeadsTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(LeadsTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(LeadsTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(LeadsTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(LeadsTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildLeads $leads Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($leads = null)
    {
        if ($leads) {
            $this->addUsingAlias(LeadsTableMap::COL_LEAD_ID, $leads->getLeadId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the leads table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(LeadsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            LeadsTableMap::clearInstancePool();
            LeadsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(LeadsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(LeadsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            LeadsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            LeadsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
