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
use entities\Announcements as ChildAnnouncements;
use entities\AnnouncementsQuery as ChildAnnouncementsQuery;
use entities\Map\AnnouncementsTableMap;

/**
 * Base class that represents a query for the `announcements` table.
 *
 * @method     ChildAnnouncementsQuery orderByAnnouncementId($order = Criteria::ASC) Order by the announcement_id column
 * @method     ChildAnnouncementsQuery orderByAnnouncementMessage($order = Criteria::ASC) Order by the announcement_message column
 * @method     ChildAnnouncementsQuery orderByAnnouncementTitle($order = Criteria::ASC) Order by the announcement_title column
 * @method     ChildAnnouncementsQuery orderByAnnouncementStdate($order = Criteria::ASC) Order by the announcement_stdate column
 * @method     ChildAnnouncementsQuery orderByAnnouncementEdate($order = Criteria::ASC) Order by the announcement_edate column
 * @method     ChildAnnouncementsQuery orderByBranches($order = Criteria::ASC) Order by the branches column
 * @method     ChildAnnouncementsQuery orderByDesignations($order = Criteria::ASC) Order by the designations column
 * @method     ChildAnnouncementsQuery orderByOrgUnits($order = Criteria::ASC) Order by the org_units column
 * @method     ChildAnnouncementsQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildAnnouncementsQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildAnnouncementsQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildAnnouncementsQuery orderByAnnouncementStatus($order = Criteria::ASC) Order by the announcement_status column
 * @method     ChildAnnouncementsQuery orderByAnnouncementsUrl($order = Criteria::ASC) Order by the announcements_url column
 * @method     ChildAnnouncementsQuery orderByIsEmployeeMapped($order = Criteria::ASC) Order by the is_employee_mapped column
 *
 * @method     ChildAnnouncementsQuery groupByAnnouncementId() Group by the announcement_id column
 * @method     ChildAnnouncementsQuery groupByAnnouncementMessage() Group by the announcement_message column
 * @method     ChildAnnouncementsQuery groupByAnnouncementTitle() Group by the announcement_title column
 * @method     ChildAnnouncementsQuery groupByAnnouncementStdate() Group by the announcement_stdate column
 * @method     ChildAnnouncementsQuery groupByAnnouncementEdate() Group by the announcement_edate column
 * @method     ChildAnnouncementsQuery groupByBranches() Group by the branches column
 * @method     ChildAnnouncementsQuery groupByDesignations() Group by the designations column
 * @method     ChildAnnouncementsQuery groupByOrgUnits() Group by the org_units column
 * @method     ChildAnnouncementsQuery groupByCompanyId() Group by the company_id column
 * @method     ChildAnnouncementsQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildAnnouncementsQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildAnnouncementsQuery groupByAnnouncementStatus() Group by the announcement_status column
 * @method     ChildAnnouncementsQuery groupByAnnouncementsUrl() Group by the announcements_url column
 * @method     ChildAnnouncementsQuery groupByIsEmployeeMapped() Group by the is_employee_mapped column
 *
 * @method     ChildAnnouncementsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildAnnouncementsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildAnnouncementsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildAnnouncementsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildAnnouncementsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildAnnouncementsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildAnnouncementsQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildAnnouncementsQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildAnnouncementsQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildAnnouncementsQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildAnnouncementsQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildAnnouncementsQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildAnnouncementsQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     ChildAnnouncementsQuery leftJoinAnnouncementEmployeeMap($relationAlias = null) Adds a LEFT JOIN clause to the query using the AnnouncementEmployeeMap relation
 * @method     ChildAnnouncementsQuery rightJoinAnnouncementEmployeeMap($relationAlias = null) Adds a RIGHT JOIN clause to the query using the AnnouncementEmployeeMap relation
 * @method     ChildAnnouncementsQuery innerJoinAnnouncementEmployeeMap($relationAlias = null) Adds a INNER JOIN clause to the query using the AnnouncementEmployeeMap relation
 *
 * @method     ChildAnnouncementsQuery joinWithAnnouncementEmployeeMap($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the AnnouncementEmployeeMap relation
 *
 * @method     ChildAnnouncementsQuery leftJoinWithAnnouncementEmployeeMap() Adds a LEFT JOIN clause and with to the query using the AnnouncementEmployeeMap relation
 * @method     ChildAnnouncementsQuery rightJoinWithAnnouncementEmployeeMap() Adds a RIGHT JOIN clause and with to the query using the AnnouncementEmployeeMap relation
 * @method     ChildAnnouncementsQuery innerJoinWithAnnouncementEmployeeMap() Adds a INNER JOIN clause and with to the query using the AnnouncementEmployeeMap relation
 *
 * @method     \entities\CompanyQuery|\entities\AnnouncementEmployeeMapQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildAnnouncements|null findOne(?ConnectionInterface $con = null) Return the first ChildAnnouncements matching the query
 * @method     ChildAnnouncements findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildAnnouncements matching the query, or a new ChildAnnouncements object populated from the query conditions when no match is found
 *
 * @method     ChildAnnouncements|null findOneByAnnouncementId(int $announcement_id) Return the first ChildAnnouncements filtered by the announcement_id column
 * @method     ChildAnnouncements|null findOneByAnnouncementMessage(string $announcement_message) Return the first ChildAnnouncements filtered by the announcement_message column
 * @method     ChildAnnouncements|null findOneByAnnouncementTitle(string $announcement_title) Return the first ChildAnnouncements filtered by the announcement_title column
 * @method     ChildAnnouncements|null findOneByAnnouncementStdate(string $announcement_stdate) Return the first ChildAnnouncements filtered by the announcement_stdate column
 * @method     ChildAnnouncements|null findOneByAnnouncementEdate(string $announcement_edate) Return the first ChildAnnouncements filtered by the announcement_edate column
 * @method     ChildAnnouncements|null findOneByBranches(string $branches) Return the first ChildAnnouncements filtered by the branches column
 * @method     ChildAnnouncements|null findOneByDesignations(string $designations) Return the first ChildAnnouncements filtered by the designations column
 * @method     ChildAnnouncements|null findOneByOrgUnits(string $org_units) Return the first ChildAnnouncements filtered by the org_units column
 * @method     ChildAnnouncements|null findOneByCompanyId(int $company_id) Return the first ChildAnnouncements filtered by the company_id column
 * @method     ChildAnnouncements|null findOneByCreatedAt(string $created_at) Return the first ChildAnnouncements filtered by the created_at column
 * @method     ChildAnnouncements|null findOneByUpdatedAt(string $updated_at) Return the first ChildAnnouncements filtered by the updated_at column
 * @method     ChildAnnouncements|null findOneByAnnouncementStatus(string $announcement_status) Return the first ChildAnnouncements filtered by the announcement_status column
 * @method     ChildAnnouncements|null findOneByAnnouncementsUrl(string $announcements_url) Return the first ChildAnnouncements filtered by the announcements_url column
 * @method     ChildAnnouncements|null findOneByIsEmployeeMapped(boolean $is_employee_mapped) Return the first ChildAnnouncements filtered by the is_employee_mapped column
 *
 * @method     ChildAnnouncements requirePk($key, ?ConnectionInterface $con = null) Return the ChildAnnouncements by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAnnouncements requireOne(?ConnectionInterface $con = null) Return the first ChildAnnouncements matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildAnnouncements requireOneByAnnouncementId(int $announcement_id) Return the first ChildAnnouncements filtered by the announcement_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAnnouncements requireOneByAnnouncementMessage(string $announcement_message) Return the first ChildAnnouncements filtered by the announcement_message column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAnnouncements requireOneByAnnouncementTitle(string $announcement_title) Return the first ChildAnnouncements filtered by the announcement_title column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAnnouncements requireOneByAnnouncementStdate(string $announcement_stdate) Return the first ChildAnnouncements filtered by the announcement_stdate column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAnnouncements requireOneByAnnouncementEdate(string $announcement_edate) Return the first ChildAnnouncements filtered by the announcement_edate column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAnnouncements requireOneByBranches(string $branches) Return the first ChildAnnouncements filtered by the branches column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAnnouncements requireOneByDesignations(string $designations) Return the first ChildAnnouncements filtered by the designations column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAnnouncements requireOneByOrgUnits(string $org_units) Return the first ChildAnnouncements filtered by the org_units column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAnnouncements requireOneByCompanyId(int $company_id) Return the first ChildAnnouncements filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAnnouncements requireOneByCreatedAt(string $created_at) Return the first ChildAnnouncements filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAnnouncements requireOneByUpdatedAt(string $updated_at) Return the first ChildAnnouncements filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAnnouncements requireOneByAnnouncementStatus(string $announcement_status) Return the first ChildAnnouncements filtered by the announcement_status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAnnouncements requireOneByAnnouncementsUrl(string $announcements_url) Return the first ChildAnnouncements filtered by the announcements_url column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAnnouncements requireOneByIsEmployeeMapped(boolean $is_employee_mapped) Return the first ChildAnnouncements filtered by the is_employee_mapped column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildAnnouncements[]|Collection find(?ConnectionInterface $con = null) Return ChildAnnouncements objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildAnnouncements> find(?ConnectionInterface $con = null) Return ChildAnnouncements objects based on current ModelCriteria
 *
 * @method     ChildAnnouncements[]|Collection findByAnnouncementId(int|array<int> $announcement_id) Return ChildAnnouncements objects filtered by the announcement_id column
 * @psalm-method Collection&\Traversable<ChildAnnouncements> findByAnnouncementId(int|array<int> $announcement_id) Return ChildAnnouncements objects filtered by the announcement_id column
 * @method     ChildAnnouncements[]|Collection findByAnnouncementMessage(string|array<string> $announcement_message) Return ChildAnnouncements objects filtered by the announcement_message column
 * @psalm-method Collection&\Traversable<ChildAnnouncements> findByAnnouncementMessage(string|array<string> $announcement_message) Return ChildAnnouncements objects filtered by the announcement_message column
 * @method     ChildAnnouncements[]|Collection findByAnnouncementTitle(string|array<string> $announcement_title) Return ChildAnnouncements objects filtered by the announcement_title column
 * @psalm-method Collection&\Traversable<ChildAnnouncements> findByAnnouncementTitle(string|array<string> $announcement_title) Return ChildAnnouncements objects filtered by the announcement_title column
 * @method     ChildAnnouncements[]|Collection findByAnnouncementStdate(string|array<string> $announcement_stdate) Return ChildAnnouncements objects filtered by the announcement_stdate column
 * @psalm-method Collection&\Traversable<ChildAnnouncements> findByAnnouncementStdate(string|array<string> $announcement_stdate) Return ChildAnnouncements objects filtered by the announcement_stdate column
 * @method     ChildAnnouncements[]|Collection findByAnnouncementEdate(string|array<string> $announcement_edate) Return ChildAnnouncements objects filtered by the announcement_edate column
 * @psalm-method Collection&\Traversable<ChildAnnouncements> findByAnnouncementEdate(string|array<string> $announcement_edate) Return ChildAnnouncements objects filtered by the announcement_edate column
 * @method     ChildAnnouncements[]|Collection findByBranches(string|array<string> $branches) Return ChildAnnouncements objects filtered by the branches column
 * @psalm-method Collection&\Traversable<ChildAnnouncements> findByBranches(string|array<string> $branches) Return ChildAnnouncements objects filtered by the branches column
 * @method     ChildAnnouncements[]|Collection findByDesignations(string|array<string> $designations) Return ChildAnnouncements objects filtered by the designations column
 * @psalm-method Collection&\Traversable<ChildAnnouncements> findByDesignations(string|array<string> $designations) Return ChildAnnouncements objects filtered by the designations column
 * @method     ChildAnnouncements[]|Collection findByOrgUnits(string|array<string> $org_units) Return ChildAnnouncements objects filtered by the org_units column
 * @psalm-method Collection&\Traversable<ChildAnnouncements> findByOrgUnits(string|array<string> $org_units) Return ChildAnnouncements objects filtered by the org_units column
 * @method     ChildAnnouncements[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildAnnouncements objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildAnnouncements> findByCompanyId(int|array<int> $company_id) Return ChildAnnouncements objects filtered by the company_id column
 * @method     ChildAnnouncements[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildAnnouncements objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildAnnouncements> findByCreatedAt(string|array<string> $created_at) Return ChildAnnouncements objects filtered by the created_at column
 * @method     ChildAnnouncements[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildAnnouncements objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildAnnouncements> findByUpdatedAt(string|array<string> $updated_at) Return ChildAnnouncements objects filtered by the updated_at column
 * @method     ChildAnnouncements[]|Collection findByAnnouncementStatus(string|array<string> $announcement_status) Return ChildAnnouncements objects filtered by the announcement_status column
 * @psalm-method Collection&\Traversable<ChildAnnouncements> findByAnnouncementStatus(string|array<string> $announcement_status) Return ChildAnnouncements objects filtered by the announcement_status column
 * @method     ChildAnnouncements[]|Collection findByAnnouncementsUrl(string|array<string> $announcements_url) Return ChildAnnouncements objects filtered by the announcements_url column
 * @psalm-method Collection&\Traversable<ChildAnnouncements> findByAnnouncementsUrl(string|array<string> $announcements_url) Return ChildAnnouncements objects filtered by the announcements_url column
 * @method     ChildAnnouncements[]|Collection findByIsEmployeeMapped(boolean|array<boolean> $is_employee_mapped) Return ChildAnnouncements objects filtered by the is_employee_mapped column
 * @psalm-method Collection&\Traversable<ChildAnnouncements> findByIsEmployeeMapped(boolean|array<boolean> $is_employee_mapped) Return ChildAnnouncements objects filtered by the is_employee_mapped column
 *
 * @method     ChildAnnouncements[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildAnnouncements> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class AnnouncementsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\AnnouncementsQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\Announcements', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildAnnouncementsQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildAnnouncementsQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildAnnouncementsQuery) {
            return $criteria;
        }
        $query = new ChildAnnouncementsQuery();
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
     * @return ChildAnnouncements|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(AnnouncementsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = AnnouncementsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildAnnouncements A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT announcement_id, announcement_message, announcement_title, announcement_stdate, announcement_edate, branches, designations, org_units, company_id, created_at, updated_at, announcement_status, announcements_url, is_employee_mapped FROM announcements WHERE announcement_id = :p0';
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
            /** @var ChildAnnouncements $obj */
            $obj = new ChildAnnouncements();
            $obj->hydrate($row);
            AnnouncementsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildAnnouncements|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(AnnouncementsTableMap::COL_ANNOUNCEMENT_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(AnnouncementsTableMap::COL_ANNOUNCEMENT_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the announcement_id column
     *
     * Example usage:
     * <code>
     * $query->filterByAnnouncementId(1234); // WHERE announcement_id = 1234
     * $query->filterByAnnouncementId(array(12, 34)); // WHERE announcement_id IN (12, 34)
     * $query->filterByAnnouncementId(array('min' => 12)); // WHERE announcement_id > 12
     * </code>
     *
     * @param mixed $announcementId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAnnouncementId($announcementId = null, ?string $comparison = null)
    {
        if (is_array($announcementId)) {
            $useMinMax = false;
            if (isset($announcementId['min'])) {
                $this->addUsingAlias(AnnouncementsTableMap::COL_ANNOUNCEMENT_ID, $announcementId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($announcementId['max'])) {
                $this->addUsingAlias(AnnouncementsTableMap::COL_ANNOUNCEMENT_ID, $announcementId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AnnouncementsTableMap::COL_ANNOUNCEMENT_ID, $announcementId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the announcement_message column
     *
     * Example usage:
     * <code>
     * $query->filterByAnnouncementMessage('fooValue');   // WHERE announcement_message = 'fooValue'
     * $query->filterByAnnouncementMessage('%fooValue%', Criteria::LIKE); // WHERE announcement_message LIKE '%fooValue%'
     * $query->filterByAnnouncementMessage(['foo', 'bar']); // WHERE announcement_message IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $announcementMessage The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAnnouncementMessage($announcementMessage = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($announcementMessage)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AnnouncementsTableMap::COL_ANNOUNCEMENT_MESSAGE, $announcementMessage, $comparison);

        return $this;
    }

    /**
     * Filter the query on the announcement_title column
     *
     * Example usage:
     * <code>
     * $query->filterByAnnouncementTitle('fooValue');   // WHERE announcement_title = 'fooValue'
     * $query->filterByAnnouncementTitle('%fooValue%', Criteria::LIKE); // WHERE announcement_title LIKE '%fooValue%'
     * $query->filterByAnnouncementTitle(['foo', 'bar']); // WHERE announcement_title IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $announcementTitle The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAnnouncementTitle($announcementTitle = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($announcementTitle)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AnnouncementsTableMap::COL_ANNOUNCEMENT_TITLE, $announcementTitle, $comparison);

        return $this;
    }

    /**
     * Filter the query on the announcement_stdate column
     *
     * Example usage:
     * <code>
     * $query->filterByAnnouncementStdate('2011-03-14'); // WHERE announcement_stdate = '2011-03-14'
     * $query->filterByAnnouncementStdate('now'); // WHERE announcement_stdate = '2011-03-14'
     * $query->filterByAnnouncementStdate(array('max' => 'yesterday')); // WHERE announcement_stdate > '2011-03-13'
     * </code>
     *
     * @param mixed $announcementStdate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAnnouncementStdate($announcementStdate = null, ?string $comparison = null)
    {
        if (is_array($announcementStdate)) {
            $useMinMax = false;
            if (isset($announcementStdate['min'])) {
                $this->addUsingAlias(AnnouncementsTableMap::COL_ANNOUNCEMENT_STDATE, $announcementStdate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($announcementStdate['max'])) {
                $this->addUsingAlias(AnnouncementsTableMap::COL_ANNOUNCEMENT_STDATE, $announcementStdate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AnnouncementsTableMap::COL_ANNOUNCEMENT_STDATE, $announcementStdate, $comparison);

        return $this;
    }

    /**
     * Filter the query on the announcement_edate column
     *
     * Example usage:
     * <code>
     * $query->filterByAnnouncementEdate('2011-03-14'); // WHERE announcement_edate = '2011-03-14'
     * $query->filterByAnnouncementEdate('now'); // WHERE announcement_edate = '2011-03-14'
     * $query->filterByAnnouncementEdate(array('max' => 'yesterday')); // WHERE announcement_edate > '2011-03-13'
     * </code>
     *
     * @param mixed $announcementEdate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAnnouncementEdate($announcementEdate = null, ?string $comparison = null)
    {
        if (is_array($announcementEdate)) {
            $useMinMax = false;
            if (isset($announcementEdate['min'])) {
                $this->addUsingAlias(AnnouncementsTableMap::COL_ANNOUNCEMENT_EDATE, $announcementEdate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($announcementEdate['max'])) {
                $this->addUsingAlias(AnnouncementsTableMap::COL_ANNOUNCEMENT_EDATE, $announcementEdate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AnnouncementsTableMap::COL_ANNOUNCEMENT_EDATE, $announcementEdate, $comparison);

        return $this;
    }

    /**
     * Filter the query on the branches column
     *
     * Example usage:
     * <code>
     * $query->filterByBranches('fooValue');   // WHERE branches = 'fooValue'
     * $query->filterByBranches('%fooValue%', Criteria::LIKE); // WHERE branches LIKE '%fooValue%'
     * $query->filterByBranches(['foo', 'bar']); // WHERE branches IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $branches The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBranches($branches = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($branches)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AnnouncementsTableMap::COL_BRANCHES, $branches, $comparison);

        return $this;
    }

    /**
     * Filter the query on the designations column
     *
     * Example usage:
     * <code>
     * $query->filterByDesignations('fooValue');   // WHERE designations = 'fooValue'
     * $query->filterByDesignations('%fooValue%', Criteria::LIKE); // WHERE designations LIKE '%fooValue%'
     * $query->filterByDesignations(['foo', 'bar']); // WHERE designations IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $designations The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDesignations($designations = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($designations)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AnnouncementsTableMap::COL_DESIGNATIONS, $designations, $comparison);

        return $this;
    }

    /**
     * Filter the query on the org_units column
     *
     * Example usage:
     * <code>
     * $query->filterByOrgUnits('fooValue');   // WHERE org_units = 'fooValue'
     * $query->filterByOrgUnits('%fooValue%', Criteria::LIKE); // WHERE org_units LIKE '%fooValue%'
     * $query->filterByOrgUnits(['foo', 'bar']); // WHERE org_units IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $orgUnits The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrgUnits($orgUnits = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($orgUnits)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AnnouncementsTableMap::COL_ORG_UNITS, $orgUnits, $comparison);

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
                $this->addUsingAlias(AnnouncementsTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(AnnouncementsTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AnnouncementsTableMap::COL_COMPANY_ID, $companyId, $comparison);

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
                $this->addUsingAlias(AnnouncementsTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(AnnouncementsTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AnnouncementsTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(AnnouncementsTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(AnnouncementsTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AnnouncementsTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the announcement_status column
     *
     * Example usage:
     * <code>
     * $query->filterByAnnouncementStatus('fooValue');   // WHERE announcement_status = 'fooValue'
     * $query->filterByAnnouncementStatus('%fooValue%', Criteria::LIKE); // WHERE announcement_status LIKE '%fooValue%'
     * $query->filterByAnnouncementStatus(['foo', 'bar']); // WHERE announcement_status IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $announcementStatus The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAnnouncementStatus($announcementStatus = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($announcementStatus)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AnnouncementsTableMap::COL_ANNOUNCEMENT_STATUS, $announcementStatus, $comparison);

        return $this;
    }

    /**
     * Filter the query on the announcements_url column
     *
     * Example usage:
     * <code>
     * $query->filterByAnnouncementsUrl('fooValue');   // WHERE announcements_url = 'fooValue'
     * $query->filterByAnnouncementsUrl('%fooValue%', Criteria::LIKE); // WHERE announcements_url LIKE '%fooValue%'
     * $query->filterByAnnouncementsUrl(['foo', 'bar']); // WHERE announcements_url IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $announcementsUrl The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAnnouncementsUrl($announcementsUrl = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($announcementsUrl)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AnnouncementsTableMap::COL_ANNOUNCEMENTS_URL, $announcementsUrl, $comparison);

        return $this;
    }

    /**
     * Filter the query on the is_employee_mapped column
     *
     * Example usage:
     * <code>
     * $query->filterByIsEmployeeMapped(true); // WHERE is_employee_mapped = true
     * $query->filterByIsEmployeeMapped('yes'); // WHERE is_employee_mapped = true
     * </code>
     *
     * @param bool|string $isEmployeeMapped The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIsEmployeeMapped($isEmployeeMapped = null, ?string $comparison = null)
    {
        if (is_string($isEmployeeMapped)) {
            $isEmployeeMapped = in_array(strtolower($isEmployeeMapped), array('false', 'off', '-', 'no', 'n', '0', ''), true) ? false : true;
        }

        $this->addUsingAlias(AnnouncementsTableMap::COL_IS_EMPLOYEE_MAPPED, $isEmployeeMapped, $comparison);

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
                ->addUsingAlias(AnnouncementsTableMap::COL_COMPANY_ID, $company->getCompanyId(), $comparison);
        } elseif ($company instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(AnnouncementsTableMap::COL_COMPANY_ID, $company->toKeyValue('PrimaryKey', 'CompanyId'), $comparison);

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
     * Filter the query by a related \entities\AnnouncementEmployeeMap object
     *
     * @param \entities\AnnouncementEmployeeMap|ObjectCollection $announcementEmployeeMap the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAnnouncementEmployeeMap($announcementEmployeeMap, ?string $comparison = null)
    {
        if ($announcementEmployeeMap instanceof \entities\AnnouncementEmployeeMap) {
            $this
                ->addUsingAlias(AnnouncementsTableMap::COL_ANNOUNCEMENT_ID, $announcementEmployeeMap->getAnnouncementId(), $comparison);

            return $this;
        } elseif ($announcementEmployeeMap instanceof ObjectCollection) {
            $this
                ->useAnnouncementEmployeeMapQuery()
                ->filterByPrimaryKeys($announcementEmployeeMap->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByAnnouncementEmployeeMap() only accepts arguments of type \entities\AnnouncementEmployeeMap or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the AnnouncementEmployeeMap relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinAnnouncementEmployeeMap(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('AnnouncementEmployeeMap');

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
            $this->addJoinObject($join, 'AnnouncementEmployeeMap');
        }

        return $this;
    }

    /**
     * Use the AnnouncementEmployeeMap relation AnnouncementEmployeeMap object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\AnnouncementEmployeeMapQuery A secondary query class using the current class as primary query
     */
    public function useAnnouncementEmployeeMapQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinAnnouncementEmployeeMap($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'AnnouncementEmployeeMap', '\entities\AnnouncementEmployeeMapQuery');
    }

    /**
     * Use the AnnouncementEmployeeMap relation AnnouncementEmployeeMap object
     *
     * @param callable(\entities\AnnouncementEmployeeMapQuery):\entities\AnnouncementEmployeeMapQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withAnnouncementEmployeeMapQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useAnnouncementEmployeeMapQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to AnnouncementEmployeeMap table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\AnnouncementEmployeeMapQuery The inner query object of the EXISTS statement
     */
    public function useAnnouncementEmployeeMapExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\AnnouncementEmployeeMapQuery */
        $q = $this->useExistsQuery('AnnouncementEmployeeMap', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to AnnouncementEmployeeMap table for a NOT EXISTS query.
     *
     * @see useAnnouncementEmployeeMapExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\AnnouncementEmployeeMapQuery The inner query object of the NOT EXISTS statement
     */
    public function useAnnouncementEmployeeMapNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\AnnouncementEmployeeMapQuery */
        $q = $this->useExistsQuery('AnnouncementEmployeeMap', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to AnnouncementEmployeeMap table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\AnnouncementEmployeeMapQuery The inner query object of the IN statement
     */
    public function useInAnnouncementEmployeeMapQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\AnnouncementEmployeeMapQuery */
        $q = $this->useInQuery('AnnouncementEmployeeMap', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to AnnouncementEmployeeMap table for a NOT IN query.
     *
     * @see useAnnouncementEmployeeMapInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\AnnouncementEmployeeMapQuery The inner query object of the NOT IN statement
     */
    public function useNotInAnnouncementEmployeeMapQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\AnnouncementEmployeeMapQuery */
        $q = $this->useInQuery('AnnouncementEmployeeMap', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildAnnouncements $announcements Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($announcements = null)
    {
        if ($announcements) {
            $this->addUsingAlias(AnnouncementsTableMap::COL_ANNOUNCEMENT_ID, $announcements->getAnnouncementId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the announcements table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(AnnouncementsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            AnnouncementsTableMap::clearInstancePool();
            AnnouncementsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(AnnouncementsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(AnnouncementsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            AnnouncementsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            AnnouncementsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
