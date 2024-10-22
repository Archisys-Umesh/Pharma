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
use entities\RcpaSummary as ChildRcpaSummary;
use entities\RcpaSummaryQuery as ChildRcpaSummaryQuery;
use entities\Map\RcpaSummaryTableMap;

/**
 * Base class that represents a query for the `rcpa_summary` table.
 *
 * @method     ChildRcpaSummaryQuery orderByUniqueid($order = Criteria::ASC) Order by the uniqueid column
 * @method     ChildRcpaSummaryQuery orderByOutletId($order = Criteria::ASC) Order by the outlet_id column
 * @method     ChildRcpaSummaryQuery orderByOutletOrgId($order = Criteria::ASC) Order by the outlet_org_id column
 * @method     ChildRcpaSummaryQuery orderByVisitFq($order = Criteria::ASC) Order by the visit_fq column
 * @method     ChildRcpaSummaryQuery orderByBrandId($order = Criteria::ASC) Order by the brand_id column
 * @method     ChildRcpaSummaryQuery orderByOutletName($order = Criteria::ASC) Order by the outlet_name column
 * @method     ChildRcpaSummaryQuery orderByOutletClassification($order = Criteria::ASC) Order by the outlet_classification column
 * @method     ChildRcpaSummaryQuery orderByTerritoryId($order = Criteria::ASC) Order by the territory_id column
 * @method     ChildRcpaSummaryQuery orderByOrgunitid($order = Criteria::ASC) Order by the orgunitid column
 * @method     ChildRcpaSummaryQuery orderByTags($order = Criteria::ASC) Order by the tags column
 * @method     ChildRcpaSummaryQuery orderByRcpaMoye($order = Criteria::ASC) Order by the rcpa_moye column
 * @method     ChildRcpaSummaryQuery orderByBrandName($order = Criteria::ASC) Order by the brand_name column
 * @method     ChildRcpaSummaryQuery orderByRcpaValue($order = Criteria::ASC) Order by the rcpa_value column
 * @method     ChildRcpaSummaryQuery orderByPotential($order = Criteria::ASC) Order by the potential column
 * @method     ChildRcpaSummaryQuery orderByOwn($order = Criteria::ASC) Order by the own column
 * @method     ChildRcpaSummaryQuery orderByCompetition($order = Criteria::ASC) Order by the competition column
 * @method     ChildRcpaSummaryQuery orderByLastcreated($order = Criteria::ASC) Order by the lastcreated column
 * @method     ChildRcpaSummaryQuery orderByLastupdated($order = Criteria::ASC) Order by the lastupdated column
 * @method     ChildRcpaSummaryQuery orderByMinValue($order = Criteria::ASC) Order by the min_value column
 *
 * @method     ChildRcpaSummaryQuery groupByUniqueid() Group by the uniqueid column
 * @method     ChildRcpaSummaryQuery groupByOutletId() Group by the outlet_id column
 * @method     ChildRcpaSummaryQuery groupByOutletOrgId() Group by the outlet_org_id column
 * @method     ChildRcpaSummaryQuery groupByVisitFq() Group by the visit_fq column
 * @method     ChildRcpaSummaryQuery groupByBrandId() Group by the brand_id column
 * @method     ChildRcpaSummaryQuery groupByOutletName() Group by the outlet_name column
 * @method     ChildRcpaSummaryQuery groupByOutletClassification() Group by the outlet_classification column
 * @method     ChildRcpaSummaryQuery groupByTerritoryId() Group by the territory_id column
 * @method     ChildRcpaSummaryQuery groupByOrgunitid() Group by the orgunitid column
 * @method     ChildRcpaSummaryQuery groupByTags() Group by the tags column
 * @method     ChildRcpaSummaryQuery groupByRcpaMoye() Group by the rcpa_moye column
 * @method     ChildRcpaSummaryQuery groupByBrandName() Group by the brand_name column
 * @method     ChildRcpaSummaryQuery groupByRcpaValue() Group by the rcpa_value column
 * @method     ChildRcpaSummaryQuery groupByPotential() Group by the potential column
 * @method     ChildRcpaSummaryQuery groupByOwn() Group by the own column
 * @method     ChildRcpaSummaryQuery groupByCompetition() Group by the competition column
 * @method     ChildRcpaSummaryQuery groupByLastcreated() Group by the lastcreated column
 * @method     ChildRcpaSummaryQuery groupByLastupdated() Group by the lastupdated column
 * @method     ChildRcpaSummaryQuery groupByMinValue() Group by the min_value column
 *
 * @method     ChildRcpaSummaryQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildRcpaSummaryQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildRcpaSummaryQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildRcpaSummaryQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildRcpaSummaryQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildRcpaSummaryQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildRcpaSummary|null findOne(?ConnectionInterface $con = null) Return the first ChildRcpaSummary matching the query
 * @method     ChildRcpaSummary findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildRcpaSummary matching the query, or a new ChildRcpaSummary object populated from the query conditions when no match is found
 *
 * @method     ChildRcpaSummary|null findOneByUniqueid(string $uniqueid) Return the first ChildRcpaSummary filtered by the uniqueid column
 * @method     ChildRcpaSummary|null findOneByOutletId(int $outlet_id) Return the first ChildRcpaSummary filtered by the outlet_id column
 * @method     ChildRcpaSummary|null findOneByOutletOrgId(int $outlet_org_id) Return the first ChildRcpaSummary filtered by the outlet_org_id column
 * @method     ChildRcpaSummary|null findOneByVisitFq(int $visit_fq) Return the first ChildRcpaSummary filtered by the visit_fq column
 * @method     ChildRcpaSummary|null findOneByBrandId(int $brand_id) Return the first ChildRcpaSummary filtered by the brand_id column
 * @method     ChildRcpaSummary|null findOneByOutletName(string $outlet_name) Return the first ChildRcpaSummary filtered by the outlet_name column
 * @method     ChildRcpaSummary|null findOneByOutletClassification(int $outlet_classification) Return the first ChildRcpaSummary filtered by the outlet_classification column
 * @method     ChildRcpaSummary|null findOneByTerritoryId(int $territory_id) Return the first ChildRcpaSummary filtered by the territory_id column
 * @method     ChildRcpaSummary|null findOneByOrgunitid(int $orgunitid) Return the first ChildRcpaSummary filtered by the orgunitid column
 * @method     ChildRcpaSummary|null findOneByTags(string $tags) Return the first ChildRcpaSummary filtered by the tags column
 * @method     ChildRcpaSummary|null findOneByRcpaMoye(string $rcpa_moye) Return the first ChildRcpaSummary filtered by the rcpa_moye column
 * @method     ChildRcpaSummary|null findOneByBrandName(string $brand_name) Return the first ChildRcpaSummary filtered by the brand_name column
 * @method     ChildRcpaSummary|null findOneByRcpaValue(string $rcpa_value) Return the first ChildRcpaSummary filtered by the rcpa_value column
 * @method     ChildRcpaSummary|null findOneByPotential(string $potential) Return the first ChildRcpaSummary filtered by the potential column
 * @method     ChildRcpaSummary|null findOneByOwn(string $own) Return the first ChildRcpaSummary filtered by the own column
 * @method     ChildRcpaSummary|null findOneByCompetition(string $competition) Return the first ChildRcpaSummary filtered by the competition column
 * @method     ChildRcpaSummary|null findOneByLastcreated(string $lastcreated) Return the first ChildRcpaSummary filtered by the lastcreated column
 * @method     ChildRcpaSummary|null findOneByLastupdated(string $lastupdated) Return the first ChildRcpaSummary filtered by the lastupdated column
 * @method     ChildRcpaSummary|null findOneByMinValue(int $min_value) Return the first ChildRcpaSummary filtered by the min_value column
 *
 * @method     ChildRcpaSummary requirePk($key, ?ConnectionInterface $con = null) Return the ChildRcpaSummary by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRcpaSummary requireOne(?ConnectionInterface $con = null) Return the first ChildRcpaSummary matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildRcpaSummary requireOneByUniqueid(string $uniqueid) Return the first ChildRcpaSummary filtered by the uniqueid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRcpaSummary requireOneByOutletId(int $outlet_id) Return the first ChildRcpaSummary filtered by the outlet_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRcpaSummary requireOneByOutletOrgId(int $outlet_org_id) Return the first ChildRcpaSummary filtered by the outlet_org_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRcpaSummary requireOneByVisitFq(int $visit_fq) Return the first ChildRcpaSummary filtered by the visit_fq column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRcpaSummary requireOneByBrandId(int $brand_id) Return the first ChildRcpaSummary filtered by the brand_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRcpaSummary requireOneByOutletName(string $outlet_name) Return the first ChildRcpaSummary filtered by the outlet_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRcpaSummary requireOneByOutletClassification(int $outlet_classification) Return the first ChildRcpaSummary filtered by the outlet_classification column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRcpaSummary requireOneByTerritoryId(int $territory_id) Return the first ChildRcpaSummary filtered by the territory_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRcpaSummary requireOneByOrgunitid(int $orgunitid) Return the first ChildRcpaSummary filtered by the orgunitid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRcpaSummary requireOneByTags(string $tags) Return the first ChildRcpaSummary filtered by the tags column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRcpaSummary requireOneByRcpaMoye(string $rcpa_moye) Return the first ChildRcpaSummary filtered by the rcpa_moye column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRcpaSummary requireOneByBrandName(string $brand_name) Return the first ChildRcpaSummary filtered by the brand_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRcpaSummary requireOneByRcpaValue(string $rcpa_value) Return the first ChildRcpaSummary filtered by the rcpa_value column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRcpaSummary requireOneByPotential(string $potential) Return the first ChildRcpaSummary filtered by the potential column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRcpaSummary requireOneByOwn(string $own) Return the first ChildRcpaSummary filtered by the own column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRcpaSummary requireOneByCompetition(string $competition) Return the first ChildRcpaSummary filtered by the competition column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRcpaSummary requireOneByLastcreated(string $lastcreated) Return the first ChildRcpaSummary filtered by the lastcreated column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRcpaSummary requireOneByLastupdated(string $lastupdated) Return the first ChildRcpaSummary filtered by the lastupdated column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRcpaSummary requireOneByMinValue(int $min_value) Return the first ChildRcpaSummary filtered by the min_value column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildRcpaSummary[]|Collection find(?ConnectionInterface $con = null) Return ChildRcpaSummary objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildRcpaSummary> find(?ConnectionInterface $con = null) Return ChildRcpaSummary objects based on current ModelCriteria
 *
 * @method     ChildRcpaSummary[]|Collection findByUniqueid(string|array<string> $uniqueid) Return ChildRcpaSummary objects filtered by the uniqueid column
 * @psalm-method Collection&\Traversable<ChildRcpaSummary> findByUniqueid(string|array<string> $uniqueid) Return ChildRcpaSummary objects filtered by the uniqueid column
 * @method     ChildRcpaSummary[]|Collection findByOutletId(int|array<int> $outlet_id) Return ChildRcpaSummary objects filtered by the outlet_id column
 * @psalm-method Collection&\Traversable<ChildRcpaSummary> findByOutletId(int|array<int> $outlet_id) Return ChildRcpaSummary objects filtered by the outlet_id column
 * @method     ChildRcpaSummary[]|Collection findByOutletOrgId(int|array<int> $outlet_org_id) Return ChildRcpaSummary objects filtered by the outlet_org_id column
 * @psalm-method Collection&\Traversable<ChildRcpaSummary> findByOutletOrgId(int|array<int> $outlet_org_id) Return ChildRcpaSummary objects filtered by the outlet_org_id column
 * @method     ChildRcpaSummary[]|Collection findByVisitFq(int|array<int> $visit_fq) Return ChildRcpaSummary objects filtered by the visit_fq column
 * @psalm-method Collection&\Traversable<ChildRcpaSummary> findByVisitFq(int|array<int> $visit_fq) Return ChildRcpaSummary objects filtered by the visit_fq column
 * @method     ChildRcpaSummary[]|Collection findByBrandId(int|array<int> $brand_id) Return ChildRcpaSummary objects filtered by the brand_id column
 * @psalm-method Collection&\Traversable<ChildRcpaSummary> findByBrandId(int|array<int> $brand_id) Return ChildRcpaSummary objects filtered by the brand_id column
 * @method     ChildRcpaSummary[]|Collection findByOutletName(string|array<string> $outlet_name) Return ChildRcpaSummary objects filtered by the outlet_name column
 * @psalm-method Collection&\Traversable<ChildRcpaSummary> findByOutletName(string|array<string> $outlet_name) Return ChildRcpaSummary objects filtered by the outlet_name column
 * @method     ChildRcpaSummary[]|Collection findByOutletClassification(int|array<int> $outlet_classification) Return ChildRcpaSummary objects filtered by the outlet_classification column
 * @psalm-method Collection&\Traversable<ChildRcpaSummary> findByOutletClassification(int|array<int> $outlet_classification) Return ChildRcpaSummary objects filtered by the outlet_classification column
 * @method     ChildRcpaSummary[]|Collection findByTerritoryId(int|array<int> $territory_id) Return ChildRcpaSummary objects filtered by the territory_id column
 * @psalm-method Collection&\Traversable<ChildRcpaSummary> findByTerritoryId(int|array<int> $territory_id) Return ChildRcpaSummary objects filtered by the territory_id column
 * @method     ChildRcpaSummary[]|Collection findByOrgunitid(int|array<int> $orgunitid) Return ChildRcpaSummary objects filtered by the orgunitid column
 * @psalm-method Collection&\Traversable<ChildRcpaSummary> findByOrgunitid(int|array<int> $orgunitid) Return ChildRcpaSummary objects filtered by the orgunitid column
 * @method     ChildRcpaSummary[]|Collection findByTags(string|array<string> $tags) Return ChildRcpaSummary objects filtered by the tags column
 * @psalm-method Collection&\Traversable<ChildRcpaSummary> findByTags(string|array<string> $tags) Return ChildRcpaSummary objects filtered by the tags column
 * @method     ChildRcpaSummary[]|Collection findByRcpaMoye(string|array<string> $rcpa_moye) Return ChildRcpaSummary objects filtered by the rcpa_moye column
 * @psalm-method Collection&\Traversable<ChildRcpaSummary> findByRcpaMoye(string|array<string> $rcpa_moye) Return ChildRcpaSummary objects filtered by the rcpa_moye column
 * @method     ChildRcpaSummary[]|Collection findByBrandName(string|array<string> $brand_name) Return ChildRcpaSummary objects filtered by the brand_name column
 * @psalm-method Collection&\Traversable<ChildRcpaSummary> findByBrandName(string|array<string> $brand_name) Return ChildRcpaSummary objects filtered by the brand_name column
 * @method     ChildRcpaSummary[]|Collection findByRcpaValue(string|array<string> $rcpa_value) Return ChildRcpaSummary objects filtered by the rcpa_value column
 * @psalm-method Collection&\Traversable<ChildRcpaSummary> findByRcpaValue(string|array<string> $rcpa_value) Return ChildRcpaSummary objects filtered by the rcpa_value column
 * @method     ChildRcpaSummary[]|Collection findByPotential(string|array<string> $potential) Return ChildRcpaSummary objects filtered by the potential column
 * @psalm-method Collection&\Traversable<ChildRcpaSummary> findByPotential(string|array<string> $potential) Return ChildRcpaSummary objects filtered by the potential column
 * @method     ChildRcpaSummary[]|Collection findByOwn(string|array<string> $own) Return ChildRcpaSummary objects filtered by the own column
 * @psalm-method Collection&\Traversable<ChildRcpaSummary> findByOwn(string|array<string> $own) Return ChildRcpaSummary objects filtered by the own column
 * @method     ChildRcpaSummary[]|Collection findByCompetition(string|array<string> $competition) Return ChildRcpaSummary objects filtered by the competition column
 * @psalm-method Collection&\Traversable<ChildRcpaSummary> findByCompetition(string|array<string> $competition) Return ChildRcpaSummary objects filtered by the competition column
 * @method     ChildRcpaSummary[]|Collection findByLastcreated(string|array<string> $lastcreated) Return ChildRcpaSummary objects filtered by the lastcreated column
 * @psalm-method Collection&\Traversable<ChildRcpaSummary> findByLastcreated(string|array<string> $lastcreated) Return ChildRcpaSummary objects filtered by the lastcreated column
 * @method     ChildRcpaSummary[]|Collection findByLastupdated(string|array<string> $lastupdated) Return ChildRcpaSummary objects filtered by the lastupdated column
 * @psalm-method Collection&\Traversable<ChildRcpaSummary> findByLastupdated(string|array<string> $lastupdated) Return ChildRcpaSummary objects filtered by the lastupdated column
 * @method     ChildRcpaSummary[]|Collection findByMinValue(int|array<int> $min_value) Return ChildRcpaSummary objects filtered by the min_value column
 * @psalm-method Collection&\Traversable<ChildRcpaSummary> findByMinValue(int|array<int> $min_value) Return ChildRcpaSummary objects filtered by the min_value column
 *
 * @method     ChildRcpaSummary[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildRcpaSummary> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class RcpaSummaryQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\RcpaSummaryQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\RcpaSummary', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildRcpaSummaryQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildRcpaSummaryQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildRcpaSummaryQuery) {
            return $criteria;
        }
        $query = new ChildRcpaSummaryQuery();
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
     * @return ChildRcpaSummary|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(RcpaSummaryTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = RcpaSummaryTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildRcpaSummary A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT uniqueid, outlet_id, outlet_org_id, visit_fq, brand_id, outlet_name, outlet_classification, territory_id, orgunitid, tags, rcpa_moye, brand_name, rcpa_value, potential, own, competition, lastcreated, lastupdated, min_value FROM rcpa_summary WHERE uniqueid = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildRcpaSummary $obj */
            $obj = new ChildRcpaSummary();
            $obj->hydrate($row);
            RcpaSummaryTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildRcpaSummary|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(RcpaSummaryTableMap::COL_UNIQUEID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(RcpaSummaryTableMap::COL_UNIQUEID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the uniqueid column
     *
     * Example usage:
     * <code>
     * $query->filterByUniqueid('fooValue');   // WHERE uniqueid = 'fooValue'
     * $query->filterByUniqueid('%fooValue%', Criteria::LIKE); // WHERE uniqueid LIKE '%fooValue%'
     * $query->filterByUniqueid(['foo', 'bar']); // WHERE uniqueid IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $uniqueid The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUniqueid($uniqueid = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($uniqueid)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(RcpaSummaryTableMap::COL_UNIQUEID, $uniqueid, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_id column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletId(1234); // WHERE outlet_id = 1234
     * $query->filterByOutletId(array(12, 34)); // WHERE outlet_id IN (12, 34)
     * $query->filterByOutletId(array('min' => 12)); // WHERE outlet_id > 12
     * </code>
     *
     * @param mixed $outletId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletId($outletId = null, ?string $comparison = null)
    {
        if (is_array($outletId)) {
            $useMinMax = false;
            if (isset($outletId['min'])) {
                $this->addUsingAlias(RcpaSummaryTableMap::COL_OUTLET_ID, $outletId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outletId['max'])) {
                $this->addUsingAlias(RcpaSummaryTableMap::COL_OUTLET_ID, $outletId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(RcpaSummaryTableMap::COL_OUTLET_ID, $outletId, $comparison);

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
                $this->addUsingAlias(RcpaSummaryTableMap::COL_OUTLET_ORG_ID, $outletOrgId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outletOrgId['max'])) {
                $this->addUsingAlias(RcpaSummaryTableMap::COL_OUTLET_ORG_ID, $outletOrgId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(RcpaSummaryTableMap::COL_OUTLET_ORG_ID, $outletOrgId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the visit_fq column
     *
     * Example usage:
     * <code>
     * $query->filterByVisitFq(1234); // WHERE visit_fq = 1234
     * $query->filterByVisitFq(array(12, 34)); // WHERE visit_fq IN (12, 34)
     * $query->filterByVisitFq(array('min' => 12)); // WHERE visit_fq > 12
     * </code>
     *
     * @param mixed $visitFq The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByVisitFq($visitFq = null, ?string $comparison = null)
    {
        if (is_array($visitFq)) {
            $useMinMax = false;
            if (isset($visitFq['min'])) {
                $this->addUsingAlias(RcpaSummaryTableMap::COL_VISIT_FQ, $visitFq['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($visitFq['max'])) {
                $this->addUsingAlias(RcpaSummaryTableMap::COL_VISIT_FQ, $visitFq['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(RcpaSummaryTableMap::COL_VISIT_FQ, $visitFq, $comparison);

        return $this;
    }

    /**
     * Filter the query on the brand_id column
     *
     * Example usage:
     * <code>
     * $query->filterByBrandId(1234); // WHERE brand_id = 1234
     * $query->filterByBrandId(array(12, 34)); // WHERE brand_id IN (12, 34)
     * $query->filterByBrandId(array('min' => 12)); // WHERE brand_id > 12
     * </code>
     *
     * @param mixed $brandId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBrandId($brandId = null, ?string $comparison = null)
    {
        if (is_array($brandId)) {
            $useMinMax = false;
            if (isset($brandId['min'])) {
                $this->addUsingAlias(RcpaSummaryTableMap::COL_BRAND_ID, $brandId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($brandId['max'])) {
                $this->addUsingAlias(RcpaSummaryTableMap::COL_BRAND_ID, $brandId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(RcpaSummaryTableMap::COL_BRAND_ID, $brandId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_name column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletName('fooValue');   // WHERE outlet_name = 'fooValue'
     * $query->filterByOutletName('%fooValue%', Criteria::LIKE); // WHERE outlet_name LIKE '%fooValue%'
     * $query->filterByOutletName(['foo', 'bar']); // WHERE outlet_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $outletName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletName($outletName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($outletName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(RcpaSummaryTableMap::COL_OUTLET_NAME, $outletName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_classification column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletClassification(1234); // WHERE outlet_classification = 1234
     * $query->filterByOutletClassification(array(12, 34)); // WHERE outlet_classification IN (12, 34)
     * $query->filterByOutletClassification(array('min' => 12)); // WHERE outlet_classification > 12
     * </code>
     *
     * @param mixed $outletClassification The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletClassification($outletClassification = null, ?string $comparison = null)
    {
        if (is_array($outletClassification)) {
            $useMinMax = false;
            if (isset($outletClassification['min'])) {
                $this->addUsingAlias(RcpaSummaryTableMap::COL_OUTLET_CLASSIFICATION, $outletClassification['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outletClassification['max'])) {
                $this->addUsingAlias(RcpaSummaryTableMap::COL_OUTLET_CLASSIFICATION, $outletClassification['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(RcpaSummaryTableMap::COL_OUTLET_CLASSIFICATION, $outletClassification, $comparison);

        return $this;
    }

    /**
     * Filter the query on the territory_id column
     *
     * Example usage:
     * <code>
     * $query->filterByTerritoryId(1234); // WHERE territory_id = 1234
     * $query->filterByTerritoryId(array(12, 34)); // WHERE territory_id IN (12, 34)
     * $query->filterByTerritoryId(array('min' => 12)); // WHERE territory_id > 12
     * </code>
     *
     * @param mixed $territoryId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTerritoryId($territoryId = null, ?string $comparison = null)
    {
        if (is_array($territoryId)) {
            $useMinMax = false;
            if (isset($territoryId['min'])) {
                $this->addUsingAlias(RcpaSummaryTableMap::COL_TERRITORY_ID, $territoryId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($territoryId['max'])) {
                $this->addUsingAlias(RcpaSummaryTableMap::COL_TERRITORY_ID, $territoryId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(RcpaSummaryTableMap::COL_TERRITORY_ID, $territoryId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the orgunitid column
     *
     * Example usage:
     * <code>
     * $query->filterByOrgunitid(1234); // WHERE orgunitid = 1234
     * $query->filterByOrgunitid(array(12, 34)); // WHERE orgunitid IN (12, 34)
     * $query->filterByOrgunitid(array('min' => 12)); // WHERE orgunitid > 12
     * </code>
     *
     * @param mixed $orgunitid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrgunitid($orgunitid = null, ?string $comparison = null)
    {
        if (is_array($orgunitid)) {
            $useMinMax = false;
            if (isset($orgunitid['min'])) {
                $this->addUsingAlias(RcpaSummaryTableMap::COL_ORGUNITID, $orgunitid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($orgunitid['max'])) {
                $this->addUsingAlias(RcpaSummaryTableMap::COL_ORGUNITID, $orgunitid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(RcpaSummaryTableMap::COL_ORGUNITID, $orgunitid, $comparison);

        return $this;
    }

    /**
     * Filter the query on the tags column
     *
     * Example usage:
     * <code>
     * $query->filterByTags('fooValue');   // WHERE tags = 'fooValue'
     * $query->filterByTags('%fooValue%', Criteria::LIKE); // WHERE tags LIKE '%fooValue%'
     * $query->filterByTags(['foo', 'bar']); // WHERE tags IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $tags The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTags($tags = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tags)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(RcpaSummaryTableMap::COL_TAGS, $tags, $comparison);

        return $this;
    }

    /**
     * Filter the query on the rcpa_moye column
     *
     * Example usage:
     * <code>
     * $query->filterByRcpaMoye('fooValue');   // WHERE rcpa_moye = 'fooValue'
     * $query->filterByRcpaMoye('%fooValue%', Criteria::LIKE); // WHERE rcpa_moye LIKE '%fooValue%'
     * $query->filterByRcpaMoye(['foo', 'bar']); // WHERE rcpa_moye IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $rcpaMoye The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRcpaMoye($rcpaMoye = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($rcpaMoye)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(RcpaSummaryTableMap::COL_RCPA_MOYE, $rcpaMoye, $comparison);

        return $this;
    }

    /**
     * Filter the query on the brand_name column
     *
     * Example usage:
     * <code>
     * $query->filterByBrandName('fooValue');   // WHERE brand_name = 'fooValue'
     * $query->filterByBrandName('%fooValue%', Criteria::LIKE); // WHERE brand_name LIKE '%fooValue%'
     * $query->filterByBrandName(['foo', 'bar']); // WHERE brand_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $brandName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBrandName($brandName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($brandName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(RcpaSummaryTableMap::COL_BRAND_NAME, $brandName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the rcpa_value column
     *
     * Example usage:
     * <code>
     * $query->filterByRcpaValue(1234); // WHERE rcpa_value = 1234
     * $query->filterByRcpaValue(array(12, 34)); // WHERE rcpa_value IN (12, 34)
     * $query->filterByRcpaValue(array('min' => 12)); // WHERE rcpa_value > 12
     * </code>
     *
     * @param mixed $rcpaValue The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRcpaValue($rcpaValue = null, ?string $comparison = null)
    {
        if (is_array($rcpaValue)) {
            $useMinMax = false;
            if (isset($rcpaValue['min'])) {
                $this->addUsingAlias(RcpaSummaryTableMap::COL_RCPA_VALUE, $rcpaValue['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($rcpaValue['max'])) {
                $this->addUsingAlias(RcpaSummaryTableMap::COL_RCPA_VALUE, $rcpaValue['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(RcpaSummaryTableMap::COL_RCPA_VALUE, $rcpaValue, $comparison);

        return $this;
    }

    /**
     * Filter the query on the potential column
     *
     * Example usage:
     * <code>
     * $query->filterByPotential(1234); // WHERE potential = 1234
     * $query->filterByPotential(array(12, 34)); // WHERE potential IN (12, 34)
     * $query->filterByPotential(array('min' => 12)); // WHERE potential > 12
     * </code>
     *
     * @param mixed $potential The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPotential($potential = null, ?string $comparison = null)
    {
        if (is_array($potential)) {
            $useMinMax = false;
            if (isset($potential['min'])) {
                $this->addUsingAlias(RcpaSummaryTableMap::COL_POTENTIAL, $potential['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($potential['max'])) {
                $this->addUsingAlias(RcpaSummaryTableMap::COL_POTENTIAL, $potential['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(RcpaSummaryTableMap::COL_POTENTIAL, $potential, $comparison);

        return $this;
    }

    /**
     * Filter the query on the own column
     *
     * Example usage:
     * <code>
     * $query->filterByOwn(1234); // WHERE own = 1234
     * $query->filterByOwn(array(12, 34)); // WHERE own IN (12, 34)
     * $query->filterByOwn(array('min' => 12)); // WHERE own > 12
     * </code>
     *
     * @param mixed $own The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOwn($own = null, ?string $comparison = null)
    {
        if (is_array($own)) {
            $useMinMax = false;
            if (isset($own['min'])) {
                $this->addUsingAlias(RcpaSummaryTableMap::COL_OWN, $own['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($own['max'])) {
                $this->addUsingAlias(RcpaSummaryTableMap::COL_OWN, $own['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(RcpaSummaryTableMap::COL_OWN, $own, $comparison);

        return $this;
    }

    /**
     * Filter the query on the competition column
     *
     * Example usage:
     * <code>
     * $query->filterByCompetition(1234); // WHERE competition = 1234
     * $query->filterByCompetition(array(12, 34)); // WHERE competition IN (12, 34)
     * $query->filterByCompetition(array('min' => 12)); // WHERE competition > 12
     * </code>
     *
     * @param mixed $competition The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCompetition($competition = null, ?string $comparison = null)
    {
        if (is_array($competition)) {
            $useMinMax = false;
            if (isset($competition['min'])) {
                $this->addUsingAlias(RcpaSummaryTableMap::COL_COMPETITION, $competition['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($competition['max'])) {
                $this->addUsingAlias(RcpaSummaryTableMap::COL_COMPETITION, $competition['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(RcpaSummaryTableMap::COL_COMPETITION, $competition, $comparison);

        return $this;
    }

    /**
     * Filter the query on the lastcreated column
     *
     * Example usage:
     * <code>
     * $query->filterByLastcreated('2011-03-14'); // WHERE lastcreated = '2011-03-14'
     * $query->filterByLastcreated('now'); // WHERE lastcreated = '2011-03-14'
     * $query->filterByLastcreated(array('max' => 'yesterday')); // WHERE lastcreated > '2011-03-13'
     * </code>
     *
     * @param mixed $lastcreated The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLastcreated($lastcreated = null, ?string $comparison = null)
    {
        if (is_array($lastcreated)) {
            $useMinMax = false;
            if (isset($lastcreated['min'])) {
                $this->addUsingAlias(RcpaSummaryTableMap::COL_LASTCREATED, $lastcreated['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastcreated['max'])) {
                $this->addUsingAlias(RcpaSummaryTableMap::COL_LASTCREATED, $lastcreated['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(RcpaSummaryTableMap::COL_LASTCREATED, $lastcreated, $comparison);

        return $this;
    }

    /**
     * Filter the query on the lastupdated column
     *
     * Example usage:
     * <code>
     * $query->filterByLastupdated('2011-03-14'); // WHERE lastupdated = '2011-03-14'
     * $query->filterByLastupdated('now'); // WHERE lastupdated = '2011-03-14'
     * $query->filterByLastupdated(array('max' => 'yesterday')); // WHERE lastupdated > '2011-03-13'
     * </code>
     *
     * @param mixed $lastupdated The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLastupdated($lastupdated = null, ?string $comparison = null)
    {
        if (is_array($lastupdated)) {
            $useMinMax = false;
            if (isset($lastupdated['min'])) {
                $this->addUsingAlias(RcpaSummaryTableMap::COL_LASTUPDATED, $lastupdated['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastupdated['max'])) {
                $this->addUsingAlias(RcpaSummaryTableMap::COL_LASTUPDATED, $lastupdated['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(RcpaSummaryTableMap::COL_LASTUPDATED, $lastupdated, $comparison);

        return $this;
    }

    /**
     * Filter the query on the min_value column
     *
     * Example usage:
     * <code>
     * $query->filterByMinValue(1234); // WHERE min_value = 1234
     * $query->filterByMinValue(array(12, 34)); // WHERE min_value IN (12, 34)
     * $query->filterByMinValue(array('min' => 12)); // WHERE min_value > 12
     * </code>
     *
     * @param mixed $minValue The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMinValue($minValue = null, ?string $comparison = null)
    {
        if (is_array($minValue)) {
            $useMinMax = false;
            if (isset($minValue['min'])) {
                $this->addUsingAlias(RcpaSummaryTableMap::COL_MIN_VALUE, $minValue['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($minValue['max'])) {
                $this->addUsingAlias(RcpaSummaryTableMap::COL_MIN_VALUE, $minValue['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(RcpaSummaryTableMap::COL_MIN_VALUE, $minValue, $comparison);

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildRcpaSummary $rcpaSummary Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($rcpaSummary = null)
    {
        if ($rcpaSummary) {
            $this->addUsingAlias(RcpaSummaryTableMap::COL_UNIQUEID, $rcpaSummary->getUniqueid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
