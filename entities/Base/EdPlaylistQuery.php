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
use entities\EdPlaylist as ChildEdPlaylist;
use entities\EdPlaylistQuery as ChildEdPlaylistQuery;
use entities\Map\EdPlaylistTableMap;

/**
 * Base class that represents a query for the `ed_playlist` table.
 *
 * @method     ChildEdPlaylistQuery orderByPlaylistId($order = Criteria::ASC) Order by the playlist_id column
 * @method     ChildEdPlaylistQuery orderByPlaylistName($order = Criteria::ASC) Order by the playlist_name column
 * @method     ChildEdPlaylistQuery orderByPresentations($order = Criteria::ASC) Order by the presentations column
 * @method     ChildEdPlaylistQuery orderByPlaylistMedia($order = Criteria::ASC) Order by the playlist_media column
 * @method     ChildEdPlaylistQuery orderByPlaylistVersionId($order = Criteria::ASC) Order by the playlist_version_id column
 * @method     ChildEdPlaylistQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildEdPlaylistQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildEdPlaylistQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildEdPlaylistQuery orderByOrgunitId($order = Criteria::ASC) Order by the orgunit_id column
 * @method     ChildEdPlaylistQuery orderByOutletTags($order = Criteria::ASC) Order by the outlet_tags column
 * @method     ChildEdPlaylistQuery orderByIscustom($order = Criteria::ASC) Order by the iscustom column
 * @method     ChildEdPlaylistQuery orderByOutletOrgId($order = Criteria::ASC) Order by the outlet_org_id column
 * @method     ChildEdPlaylistQuery orderByDeviceTime($order = Criteria::ASC) Order by the device_time column
 * @method     ChildEdPlaylistQuery orderByEmployeeId($order = Criteria::ASC) Order by the employee_id column
 * @method     ChildEdPlaylistQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method     ChildEdPlaylistQuery orderByPlaylistTypeId($order = Criteria::ASC) Order by the playlist_type_id column
 *
 * @method     ChildEdPlaylistQuery groupByPlaylistId() Group by the playlist_id column
 * @method     ChildEdPlaylistQuery groupByPlaylistName() Group by the playlist_name column
 * @method     ChildEdPlaylistQuery groupByPresentations() Group by the presentations column
 * @method     ChildEdPlaylistQuery groupByPlaylistMedia() Group by the playlist_media column
 * @method     ChildEdPlaylistQuery groupByPlaylistVersionId() Group by the playlist_version_id column
 * @method     ChildEdPlaylistQuery groupByCompanyId() Group by the company_id column
 * @method     ChildEdPlaylistQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildEdPlaylistQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildEdPlaylistQuery groupByOrgunitId() Group by the orgunit_id column
 * @method     ChildEdPlaylistQuery groupByOutletTags() Group by the outlet_tags column
 * @method     ChildEdPlaylistQuery groupByIscustom() Group by the iscustom column
 * @method     ChildEdPlaylistQuery groupByOutletOrgId() Group by the outlet_org_id column
 * @method     ChildEdPlaylistQuery groupByDeviceTime() Group by the device_time column
 * @method     ChildEdPlaylistQuery groupByEmployeeId() Group by the employee_id column
 * @method     ChildEdPlaylistQuery groupByStatus() Group by the status column
 * @method     ChildEdPlaylistQuery groupByPlaylistTypeId() Group by the playlist_type_id column
 *
 * @method     ChildEdPlaylistQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildEdPlaylistQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildEdPlaylistQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildEdPlaylistQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildEdPlaylistQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildEdPlaylistQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildEdPlaylistQuery leftJoinOrgUnit($relationAlias = null) Adds a LEFT JOIN clause to the query using the OrgUnit relation
 * @method     ChildEdPlaylistQuery rightJoinOrgUnit($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OrgUnit relation
 * @method     ChildEdPlaylistQuery innerJoinOrgUnit($relationAlias = null) Adds a INNER JOIN clause to the query using the OrgUnit relation
 *
 * @method     ChildEdPlaylistQuery joinWithOrgUnit($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OrgUnit relation
 *
 * @method     ChildEdPlaylistQuery leftJoinWithOrgUnit() Adds a LEFT JOIN clause and with to the query using the OrgUnit relation
 * @method     ChildEdPlaylistQuery rightJoinWithOrgUnit() Adds a RIGHT JOIN clause and with to the query using the OrgUnit relation
 * @method     ChildEdPlaylistQuery innerJoinWithOrgUnit() Adds a INNER JOIN clause and with to the query using the OrgUnit relation
 *
 * @method     ChildEdPlaylistQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildEdPlaylistQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildEdPlaylistQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildEdPlaylistQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildEdPlaylistQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildEdPlaylistQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildEdPlaylistQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     \entities\OrgUnitQuery|\entities\CompanyQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildEdPlaylist|null findOne(?ConnectionInterface $con = null) Return the first ChildEdPlaylist matching the query
 * @method     ChildEdPlaylist findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildEdPlaylist matching the query, or a new ChildEdPlaylist object populated from the query conditions when no match is found
 *
 * @method     ChildEdPlaylist|null findOneByPlaylistId(int $playlist_id) Return the first ChildEdPlaylist filtered by the playlist_id column
 * @method     ChildEdPlaylist|null findOneByPlaylistName(string $playlist_name) Return the first ChildEdPlaylist filtered by the playlist_name column
 * @method     ChildEdPlaylist|null findOneByPresentations(string $presentations) Return the first ChildEdPlaylist filtered by the presentations column
 * @method     ChildEdPlaylist|null findOneByPlaylistMedia(int $playlist_media) Return the first ChildEdPlaylist filtered by the playlist_media column
 * @method     ChildEdPlaylist|null findOneByPlaylistVersionId(string $playlist_version_id) Return the first ChildEdPlaylist filtered by the playlist_version_id column
 * @method     ChildEdPlaylist|null findOneByCompanyId(int $company_id) Return the first ChildEdPlaylist filtered by the company_id column
 * @method     ChildEdPlaylist|null findOneByCreatedAt(string $created_at) Return the first ChildEdPlaylist filtered by the created_at column
 * @method     ChildEdPlaylist|null findOneByUpdatedAt(string $updated_at) Return the first ChildEdPlaylist filtered by the updated_at column
 * @method     ChildEdPlaylist|null findOneByOrgunitId(int $orgunit_id) Return the first ChildEdPlaylist filtered by the orgunit_id column
 * @method     ChildEdPlaylist|null findOneByOutletTags(string $outlet_tags) Return the first ChildEdPlaylist filtered by the outlet_tags column
 * @method     ChildEdPlaylist|null findOneByIscustom(boolean $iscustom) Return the first ChildEdPlaylist filtered by the iscustom column
 * @method     ChildEdPlaylist|null findOneByOutletOrgId(int $outlet_org_id) Return the first ChildEdPlaylist filtered by the outlet_org_id column
 * @method     ChildEdPlaylist|null findOneByDeviceTime(string $device_time) Return the first ChildEdPlaylist filtered by the device_time column
 * @method     ChildEdPlaylist|null findOneByEmployeeId(int $employee_id) Return the first ChildEdPlaylist filtered by the employee_id column
 * @method     ChildEdPlaylist|null findOneByStatus(string $status) Return the first ChildEdPlaylist filtered by the status column
 * @method     ChildEdPlaylist|null findOneByPlaylistTypeId(int $playlist_type_id) Return the first ChildEdPlaylist filtered by the playlist_type_id column
 *
 * @method     ChildEdPlaylist requirePk($key, ?ConnectionInterface $con = null) Return the ChildEdPlaylist by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEdPlaylist requireOne(?ConnectionInterface $con = null) Return the first ChildEdPlaylist matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEdPlaylist requireOneByPlaylistId(int $playlist_id) Return the first ChildEdPlaylist filtered by the playlist_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEdPlaylist requireOneByPlaylistName(string $playlist_name) Return the first ChildEdPlaylist filtered by the playlist_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEdPlaylist requireOneByPresentations(string $presentations) Return the first ChildEdPlaylist filtered by the presentations column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEdPlaylist requireOneByPlaylistMedia(int $playlist_media) Return the first ChildEdPlaylist filtered by the playlist_media column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEdPlaylist requireOneByPlaylistVersionId(string $playlist_version_id) Return the first ChildEdPlaylist filtered by the playlist_version_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEdPlaylist requireOneByCompanyId(int $company_id) Return the first ChildEdPlaylist filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEdPlaylist requireOneByCreatedAt(string $created_at) Return the first ChildEdPlaylist filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEdPlaylist requireOneByUpdatedAt(string $updated_at) Return the first ChildEdPlaylist filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEdPlaylist requireOneByOrgunitId(int $orgunit_id) Return the first ChildEdPlaylist filtered by the orgunit_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEdPlaylist requireOneByOutletTags(string $outlet_tags) Return the first ChildEdPlaylist filtered by the outlet_tags column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEdPlaylist requireOneByIscustom(boolean $iscustom) Return the first ChildEdPlaylist filtered by the iscustom column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEdPlaylist requireOneByOutletOrgId(int $outlet_org_id) Return the first ChildEdPlaylist filtered by the outlet_org_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEdPlaylist requireOneByDeviceTime(string $device_time) Return the first ChildEdPlaylist filtered by the device_time column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEdPlaylist requireOneByEmployeeId(int $employee_id) Return the first ChildEdPlaylist filtered by the employee_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEdPlaylist requireOneByStatus(string $status) Return the first ChildEdPlaylist filtered by the status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEdPlaylist requireOneByPlaylistTypeId(int $playlist_type_id) Return the first ChildEdPlaylist filtered by the playlist_type_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEdPlaylist[]|Collection find(?ConnectionInterface $con = null) Return ChildEdPlaylist objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildEdPlaylist> find(?ConnectionInterface $con = null) Return ChildEdPlaylist objects based on current ModelCriteria
 *
 * @method     ChildEdPlaylist[]|Collection findByPlaylistId(int|array<int> $playlist_id) Return ChildEdPlaylist objects filtered by the playlist_id column
 * @psalm-method Collection&\Traversable<ChildEdPlaylist> findByPlaylistId(int|array<int> $playlist_id) Return ChildEdPlaylist objects filtered by the playlist_id column
 * @method     ChildEdPlaylist[]|Collection findByPlaylistName(string|array<string> $playlist_name) Return ChildEdPlaylist objects filtered by the playlist_name column
 * @psalm-method Collection&\Traversable<ChildEdPlaylist> findByPlaylistName(string|array<string> $playlist_name) Return ChildEdPlaylist objects filtered by the playlist_name column
 * @method     ChildEdPlaylist[]|Collection findByPresentations(string|array<string> $presentations) Return ChildEdPlaylist objects filtered by the presentations column
 * @psalm-method Collection&\Traversable<ChildEdPlaylist> findByPresentations(string|array<string> $presentations) Return ChildEdPlaylist objects filtered by the presentations column
 * @method     ChildEdPlaylist[]|Collection findByPlaylistMedia(int|array<int> $playlist_media) Return ChildEdPlaylist objects filtered by the playlist_media column
 * @psalm-method Collection&\Traversable<ChildEdPlaylist> findByPlaylistMedia(int|array<int> $playlist_media) Return ChildEdPlaylist objects filtered by the playlist_media column
 * @method     ChildEdPlaylist[]|Collection findByPlaylistVersionId(string|array<string> $playlist_version_id) Return ChildEdPlaylist objects filtered by the playlist_version_id column
 * @psalm-method Collection&\Traversable<ChildEdPlaylist> findByPlaylistVersionId(string|array<string> $playlist_version_id) Return ChildEdPlaylist objects filtered by the playlist_version_id column
 * @method     ChildEdPlaylist[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildEdPlaylist objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildEdPlaylist> findByCompanyId(int|array<int> $company_id) Return ChildEdPlaylist objects filtered by the company_id column
 * @method     ChildEdPlaylist[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildEdPlaylist objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildEdPlaylist> findByCreatedAt(string|array<string> $created_at) Return ChildEdPlaylist objects filtered by the created_at column
 * @method     ChildEdPlaylist[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildEdPlaylist objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildEdPlaylist> findByUpdatedAt(string|array<string> $updated_at) Return ChildEdPlaylist objects filtered by the updated_at column
 * @method     ChildEdPlaylist[]|Collection findByOrgunitId(int|array<int> $orgunit_id) Return ChildEdPlaylist objects filtered by the orgunit_id column
 * @psalm-method Collection&\Traversable<ChildEdPlaylist> findByOrgunitId(int|array<int> $orgunit_id) Return ChildEdPlaylist objects filtered by the orgunit_id column
 * @method     ChildEdPlaylist[]|Collection findByOutletTags(string|array<string> $outlet_tags) Return ChildEdPlaylist objects filtered by the outlet_tags column
 * @psalm-method Collection&\Traversable<ChildEdPlaylist> findByOutletTags(string|array<string> $outlet_tags) Return ChildEdPlaylist objects filtered by the outlet_tags column
 * @method     ChildEdPlaylist[]|Collection findByIscustom(boolean|array<boolean> $iscustom) Return ChildEdPlaylist objects filtered by the iscustom column
 * @psalm-method Collection&\Traversable<ChildEdPlaylist> findByIscustom(boolean|array<boolean> $iscustom) Return ChildEdPlaylist objects filtered by the iscustom column
 * @method     ChildEdPlaylist[]|Collection findByOutletOrgId(int|array<int> $outlet_org_id) Return ChildEdPlaylist objects filtered by the outlet_org_id column
 * @psalm-method Collection&\Traversable<ChildEdPlaylist> findByOutletOrgId(int|array<int> $outlet_org_id) Return ChildEdPlaylist objects filtered by the outlet_org_id column
 * @method     ChildEdPlaylist[]|Collection findByDeviceTime(string|array<string> $device_time) Return ChildEdPlaylist objects filtered by the device_time column
 * @psalm-method Collection&\Traversable<ChildEdPlaylist> findByDeviceTime(string|array<string> $device_time) Return ChildEdPlaylist objects filtered by the device_time column
 * @method     ChildEdPlaylist[]|Collection findByEmployeeId(int|array<int> $employee_id) Return ChildEdPlaylist objects filtered by the employee_id column
 * @psalm-method Collection&\Traversable<ChildEdPlaylist> findByEmployeeId(int|array<int> $employee_id) Return ChildEdPlaylist objects filtered by the employee_id column
 * @method     ChildEdPlaylist[]|Collection findByStatus(string|array<string> $status) Return ChildEdPlaylist objects filtered by the status column
 * @psalm-method Collection&\Traversable<ChildEdPlaylist> findByStatus(string|array<string> $status) Return ChildEdPlaylist objects filtered by the status column
 * @method     ChildEdPlaylist[]|Collection findByPlaylistTypeId(int|array<int> $playlist_type_id) Return ChildEdPlaylist objects filtered by the playlist_type_id column
 * @psalm-method Collection&\Traversable<ChildEdPlaylist> findByPlaylistTypeId(int|array<int> $playlist_type_id) Return ChildEdPlaylist objects filtered by the playlist_type_id column
 *
 * @method     ChildEdPlaylist[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildEdPlaylist> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class EdPlaylistQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\EdPlaylistQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\EdPlaylist', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildEdPlaylistQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildEdPlaylistQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildEdPlaylistQuery) {
            return $criteria;
        }
        $query = new ChildEdPlaylistQuery();
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
     * @return ChildEdPlaylist|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(EdPlaylistTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = EdPlaylistTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildEdPlaylist A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT playlist_id, playlist_name, presentations, playlist_media, playlist_version_id, company_id, created_at, updated_at, orgunit_id, outlet_tags, iscustom, outlet_org_id, device_time, employee_id, status, playlist_type_id FROM ed_playlist WHERE playlist_id = :p0';
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
            /** @var ChildEdPlaylist $obj */
            $obj = new ChildEdPlaylist();
            $obj->hydrate($row);
            EdPlaylistTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildEdPlaylist|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(EdPlaylistTableMap::COL_PLAYLIST_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(EdPlaylistTableMap::COL_PLAYLIST_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the playlist_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPlaylistId(1234); // WHERE playlist_id = 1234
     * $query->filterByPlaylistId(array(12, 34)); // WHERE playlist_id IN (12, 34)
     * $query->filterByPlaylistId(array('min' => 12)); // WHERE playlist_id > 12
     * </code>
     *
     * @param mixed $playlistId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPlaylistId($playlistId = null, ?string $comparison = null)
    {
        if (is_array($playlistId)) {
            $useMinMax = false;
            if (isset($playlistId['min'])) {
                $this->addUsingAlias(EdPlaylistTableMap::COL_PLAYLIST_ID, $playlistId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($playlistId['max'])) {
                $this->addUsingAlias(EdPlaylistTableMap::COL_PLAYLIST_ID, $playlistId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EdPlaylistTableMap::COL_PLAYLIST_ID, $playlistId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the playlist_name column
     *
     * Example usage:
     * <code>
     * $query->filterByPlaylistName('fooValue');   // WHERE playlist_name = 'fooValue'
     * $query->filterByPlaylistName('%fooValue%', Criteria::LIKE); // WHERE playlist_name LIKE '%fooValue%'
     * $query->filterByPlaylistName(['foo', 'bar']); // WHERE playlist_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $playlistName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPlaylistName($playlistName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($playlistName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EdPlaylistTableMap::COL_PLAYLIST_NAME, $playlistName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the presentations column
     *
     * Example usage:
     * <code>
     * $query->filterByPresentations('fooValue');   // WHERE presentations = 'fooValue'
     * $query->filterByPresentations('%fooValue%', Criteria::LIKE); // WHERE presentations LIKE '%fooValue%'
     * $query->filterByPresentations(['foo', 'bar']); // WHERE presentations IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $presentations The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPresentations($presentations = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($presentations)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EdPlaylistTableMap::COL_PRESENTATIONS, $presentations, $comparison);

        return $this;
    }

    /**
     * Filter the query on the playlist_media column
     *
     * Example usage:
     * <code>
     * $query->filterByPlaylistMedia(1234); // WHERE playlist_media = 1234
     * $query->filterByPlaylistMedia(array(12, 34)); // WHERE playlist_media IN (12, 34)
     * $query->filterByPlaylistMedia(array('min' => 12)); // WHERE playlist_media > 12
     * </code>
     *
     * @param mixed $playlistMedia The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPlaylistMedia($playlistMedia = null, ?string $comparison = null)
    {
        if (is_array($playlistMedia)) {
            $useMinMax = false;
            if (isset($playlistMedia['min'])) {
                $this->addUsingAlias(EdPlaylistTableMap::COL_PLAYLIST_MEDIA, $playlistMedia['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($playlistMedia['max'])) {
                $this->addUsingAlias(EdPlaylistTableMap::COL_PLAYLIST_MEDIA, $playlistMedia['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EdPlaylistTableMap::COL_PLAYLIST_MEDIA, $playlistMedia, $comparison);

        return $this;
    }

    /**
     * Filter the query on the playlist_version_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPlaylistVersionId(1234); // WHERE playlist_version_id = 1234
     * $query->filterByPlaylistVersionId(array(12, 34)); // WHERE playlist_version_id IN (12, 34)
     * $query->filterByPlaylistVersionId(array('min' => 12)); // WHERE playlist_version_id > 12
     * </code>
     *
     * @param mixed $playlistVersionId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPlaylistVersionId($playlistVersionId = null, ?string $comparison = null)
    {
        if (is_array($playlistVersionId)) {
            $useMinMax = false;
            if (isset($playlistVersionId['min'])) {
                $this->addUsingAlias(EdPlaylistTableMap::COL_PLAYLIST_VERSION_ID, $playlistVersionId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($playlistVersionId['max'])) {
                $this->addUsingAlias(EdPlaylistTableMap::COL_PLAYLIST_VERSION_ID, $playlistVersionId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EdPlaylistTableMap::COL_PLAYLIST_VERSION_ID, $playlistVersionId, $comparison);

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
                $this->addUsingAlias(EdPlaylistTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(EdPlaylistTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EdPlaylistTableMap::COL_COMPANY_ID, $companyId, $comparison);

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
                $this->addUsingAlias(EdPlaylistTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(EdPlaylistTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EdPlaylistTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(EdPlaylistTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(EdPlaylistTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EdPlaylistTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the orgunit_id column
     *
     * Example usage:
     * <code>
     * $query->filterByOrgunitId(1234); // WHERE orgunit_id = 1234
     * $query->filterByOrgunitId(array(12, 34)); // WHERE orgunit_id IN (12, 34)
     * $query->filterByOrgunitId(array('min' => 12)); // WHERE orgunit_id > 12
     * </code>
     *
     * @see       filterByOrgUnit()
     *
     * @param mixed $orgunitId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrgunitId($orgunitId = null, ?string $comparison = null)
    {
        if (is_array($orgunitId)) {
            $useMinMax = false;
            if (isset($orgunitId['min'])) {
                $this->addUsingAlias(EdPlaylistTableMap::COL_ORGUNIT_ID, $orgunitId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($orgunitId['max'])) {
                $this->addUsingAlias(EdPlaylistTableMap::COL_ORGUNIT_ID, $orgunitId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EdPlaylistTableMap::COL_ORGUNIT_ID, $orgunitId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_tags column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletTags('fooValue');   // WHERE outlet_tags = 'fooValue'
     * $query->filterByOutletTags('%fooValue%', Criteria::LIKE); // WHERE outlet_tags LIKE '%fooValue%'
     * $query->filterByOutletTags(['foo', 'bar']); // WHERE outlet_tags IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $outletTags The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletTags($outletTags = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($outletTags)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EdPlaylistTableMap::COL_OUTLET_TAGS, $outletTags, $comparison);

        return $this;
    }

    /**
     * Filter the query on the iscustom column
     *
     * Example usage:
     * <code>
     * $query->filterByIscustom(true); // WHERE iscustom = true
     * $query->filterByIscustom('yes'); // WHERE iscustom = true
     * </code>
     *
     * @param bool|string $iscustom The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIscustom($iscustom = null, ?string $comparison = null)
    {
        if (is_string($iscustom)) {
            $iscustom = in_array(strtolower($iscustom), array('false', 'off', '-', 'no', 'n', '0', ''), true) ? false : true;
        }

        $this->addUsingAlias(EdPlaylistTableMap::COL_ISCUSTOM, $iscustom, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_org_id column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletOrgId(1234); // WHERE outlet_org_id = 1234
     * $query->filterByOutletOrgId(array(12, 34)); // WHERE outlet_org_id IN (12, 34)
     * $query->filterByOutletOrgId(array('min' => 12)); // WHERE outlet_org_id > 12
     * </code>
     *
     * @param mixed $outletOrgId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletOrgId($outletOrgId = null, ?string $comparison = null)
    {
        if (is_array($outletOrgId)) {
            $useMinMax = false;
            if (isset($outletOrgId['min'])) {
                $this->addUsingAlias(EdPlaylistTableMap::COL_OUTLET_ORG_ID, $outletOrgId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outletOrgId['max'])) {
                $this->addUsingAlias(EdPlaylistTableMap::COL_OUTLET_ORG_ID, $outletOrgId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EdPlaylistTableMap::COL_OUTLET_ORG_ID, $outletOrgId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the device_time column
     *
     * Example usage:
     * <code>
     * $query->filterByDeviceTime('2011-03-14'); // WHERE device_time = '2011-03-14'
     * $query->filterByDeviceTime('now'); // WHERE device_time = '2011-03-14'
     * $query->filterByDeviceTime(array('max' => 'yesterday')); // WHERE device_time > '2011-03-13'
     * </code>
     *
     * @param mixed $deviceTime The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDeviceTime($deviceTime = null, ?string $comparison = null)
    {
        if (is_array($deviceTime)) {
            $useMinMax = false;
            if (isset($deviceTime['min'])) {
                $this->addUsingAlias(EdPlaylistTableMap::COL_DEVICE_TIME, $deviceTime['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($deviceTime['max'])) {
                $this->addUsingAlias(EdPlaylistTableMap::COL_DEVICE_TIME, $deviceTime['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EdPlaylistTableMap::COL_DEVICE_TIME, $deviceTime, $comparison);

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
                $this->addUsingAlias(EdPlaylistTableMap::COL_EMPLOYEE_ID, $employeeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($employeeId['max'])) {
                $this->addUsingAlias(EdPlaylistTableMap::COL_EMPLOYEE_ID, $employeeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EdPlaylistTableMap::COL_EMPLOYEE_ID, $employeeId, $comparison);

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

        $this->addUsingAlias(EdPlaylistTableMap::COL_STATUS, $status, $comparison);

        return $this;
    }

    /**
     * Filter the query on the playlist_type_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPlaylistTypeId(1234); // WHERE playlist_type_id = 1234
     * $query->filterByPlaylistTypeId(array(12, 34)); // WHERE playlist_type_id IN (12, 34)
     * $query->filterByPlaylistTypeId(array('min' => 12)); // WHERE playlist_type_id > 12
     * </code>
     *
     * @param mixed $playlistTypeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPlaylistTypeId($playlistTypeId = null, ?string $comparison = null)
    {
        if (is_array($playlistTypeId)) {
            $useMinMax = false;
            if (isset($playlistTypeId['min'])) {
                $this->addUsingAlias(EdPlaylistTableMap::COL_PLAYLIST_TYPE_ID, $playlistTypeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($playlistTypeId['max'])) {
                $this->addUsingAlias(EdPlaylistTableMap::COL_PLAYLIST_TYPE_ID, $playlistTypeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EdPlaylistTableMap::COL_PLAYLIST_TYPE_ID, $playlistTypeId, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \entities\OrgUnit object
     *
     * @param \entities\OrgUnit|ObjectCollection $orgUnit The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrgUnit($orgUnit, ?string $comparison = null)
    {
        if ($orgUnit instanceof \entities\OrgUnit) {
            return $this
                ->addUsingAlias(EdPlaylistTableMap::COL_ORGUNIT_ID, $orgUnit->getOrgunitid(), $comparison);
        } elseif ($orgUnit instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(EdPlaylistTableMap::COL_ORGUNIT_ID, $orgUnit->toKeyValue('PrimaryKey', 'Orgunitid'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByOrgUnit() only accepts arguments of type \entities\OrgUnit or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OrgUnit relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOrgUnit(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OrgUnit');

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
            $this->addJoinObject($join, 'OrgUnit');
        }

        return $this;
    }

    /**
     * Use the OrgUnit relation OrgUnit object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\OrgUnitQuery A secondary query class using the current class as primary query
     */
    public function useOrgUnitQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinOrgUnit($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OrgUnit', '\entities\OrgUnitQuery');
    }

    /**
     * Use the OrgUnit relation OrgUnit object
     *
     * @param callable(\entities\OrgUnitQuery):\entities\OrgUnitQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOrgUnitQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useOrgUnitQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to OrgUnit table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\OrgUnitQuery The inner query object of the EXISTS statement
     */
    public function useOrgUnitExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\OrgUnitQuery */
        $q = $this->useExistsQuery('OrgUnit', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to OrgUnit table for a NOT EXISTS query.
     *
     * @see useOrgUnitExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\OrgUnitQuery The inner query object of the NOT EXISTS statement
     */
    public function useOrgUnitNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OrgUnitQuery */
        $q = $this->useExistsQuery('OrgUnit', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to OrgUnit table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\OrgUnitQuery The inner query object of the IN statement
     */
    public function useInOrgUnitQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\OrgUnitQuery */
        $q = $this->useInQuery('OrgUnit', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to OrgUnit table for a NOT IN query.
     *
     * @see useOrgUnitInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\OrgUnitQuery The inner query object of the NOT IN statement
     */
    public function useNotInOrgUnitQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OrgUnitQuery */
        $q = $this->useInQuery('OrgUnit', $modelAlias, $queryClass, 'NOT IN');
        return $q;
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
                ->addUsingAlias(EdPlaylistTableMap::COL_COMPANY_ID, $company->getCompanyId(), $comparison);
        } elseif ($company instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(EdPlaylistTableMap::COL_COMPANY_ID, $company->toKeyValue('PrimaryKey', 'CompanyId'), $comparison);

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
     * Exclude object from result
     *
     * @param ChildEdPlaylist $edPlaylist Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($edPlaylist = null)
    {
        if ($edPlaylist) {
            $this->addUsingAlias(EdPlaylistTableMap::COL_PLAYLIST_ID, $edPlaylist->getPlaylistId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the ed_playlist table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EdPlaylistTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            EdPlaylistTableMap::clearInstancePool();
            EdPlaylistTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(EdPlaylistTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(EdPlaylistTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            EdPlaylistTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            EdPlaylistTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
