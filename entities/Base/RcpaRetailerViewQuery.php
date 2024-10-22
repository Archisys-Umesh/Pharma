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
use entities\RcpaRetailerView as ChildRcpaRetailerView;
use entities\RcpaRetailerViewQuery as ChildRcpaRetailerViewQuery;
use entities\Map\RcpaRetailerViewTableMap;

/**
 * Base class that represents a query for the `rcpa_retailer_view` table.
 *
 * @method     ChildRcpaRetailerViewQuery orderByUniqueid($order = Criteria::ASC) Order by the uniqueid column
 * @method     ChildRcpaRetailerViewQuery orderByDoctorid($order = Criteria::ASC) Order by the doctorid column
 * @method     ChildRcpaRetailerViewQuery orderByOutletOrgId($order = Criteria::ASC) Order by the outlet_org_id column
 * @method     ChildRcpaRetailerViewQuery orderByRetailOutletId($order = Criteria::ASC) Order by the retail_outlet_id column
 * @method     ChildRcpaRetailerViewQuery orderByOutletName($order = Criteria::ASC) Order by the outlet_name column
 * @method     ChildRcpaRetailerViewQuery orderByRcpaMoye($order = Criteria::ASC) Order by the rcpa_moye column
 * @method     ChildRcpaRetailerViewQuery orderByTerritoryId($order = Criteria::ASC) Order by the territory_id column
 * @method     ChildRcpaRetailerViewQuery orderByRcpaValue($order = Criteria::ASC) Order by the rcpa_value column
 * @method     ChildRcpaRetailerViewQuery orderByPotential($order = Criteria::ASC) Order by the potential column
 * @method     ChildRcpaRetailerViewQuery orderByOwn($order = Criteria::ASC) Order by the own column
 * @method     ChildRcpaRetailerViewQuery orderByCompetition($order = Criteria::ASC) Order by the competition column
 * @method     ChildRcpaRetailerViewQuery orderByCreatedAt($order = Criteria::ASC) Order by the lastcreated column
 * @method     ChildRcpaRetailerViewQuery orderByUpdatedAt($order = Criteria::ASC) Order by the lastupdated column
 * @method     ChildRcpaRetailerViewQuery orderByBrandName($order = Criteria::ASC) Order by the brand_name column
 *
 * @method     ChildRcpaRetailerViewQuery groupByUniqueid() Group by the uniqueid column
 * @method     ChildRcpaRetailerViewQuery groupByDoctorid() Group by the doctorid column
 * @method     ChildRcpaRetailerViewQuery groupByOutletOrgId() Group by the outlet_org_id column
 * @method     ChildRcpaRetailerViewQuery groupByRetailOutletId() Group by the retail_outlet_id column
 * @method     ChildRcpaRetailerViewQuery groupByOutletName() Group by the outlet_name column
 * @method     ChildRcpaRetailerViewQuery groupByRcpaMoye() Group by the rcpa_moye column
 * @method     ChildRcpaRetailerViewQuery groupByTerritoryId() Group by the territory_id column
 * @method     ChildRcpaRetailerViewQuery groupByRcpaValue() Group by the rcpa_value column
 * @method     ChildRcpaRetailerViewQuery groupByPotential() Group by the potential column
 * @method     ChildRcpaRetailerViewQuery groupByOwn() Group by the own column
 * @method     ChildRcpaRetailerViewQuery groupByCompetition() Group by the competition column
 * @method     ChildRcpaRetailerViewQuery groupByCreatedAt() Group by the lastcreated column
 * @method     ChildRcpaRetailerViewQuery groupByUpdatedAt() Group by the lastupdated column
 * @method     ChildRcpaRetailerViewQuery groupByBrandName() Group by the brand_name column
 *
 * @method     ChildRcpaRetailerViewQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildRcpaRetailerViewQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildRcpaRetailerViewQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildRcpaRetailerViewQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildRcpaRetailerViewQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildRcpaRetailerViewQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildRcpaRetailerView|null findOne(?ConnectionInterface $con = null) Return the first ChildRcpaRetailerView matching the query
 * @method     ChildRcpaRetailerView findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildRcpaRetailerView matching the query, or a new ChildRcpaRetailerView object populated from the query conditions when no match is found
 *
 * @method     ChildRcpaRetailerView|null findOneByUniqueid(string $uniqueid) Return the first ChildRcpaRetailerView filtered by the uniqueid column
 * @method     ChildRcpaRetailerView|null findOneByDoctorid(int $doctorid) Return the first ChildRcpaRetailerView filtered by the doctorid column
 * @method     ChildRcpaRetailerView|null findOneByOutletOrgId(int $outlet_org_id) Return the first ChildRcpaRetailerView filtered by the outlet_org_id column
 * @method     ChildRcpaRetailerView|null findOneByRetailOutletId(int $retail_outlet_id) Return the first ChildRcpaRetailerView filtered by the retail_outlet_id column
 * @method     ChildRcpaRetailerView|null findOneByOutletName(string $outlet_name) Return the first ChildRcpaRetailerView filtered by the outlet_name column
 * @method     ChildRcpaRetailerView|null findOneByRcpaMoye(string $rcpa_moye) Return the first ChildRcpaRetailerView filtered by the rcpa_moye column
 * @method     ChildRcpaRetailerView|null findOneByTerritoryId(int $territory_id) Return the first ChildRcpaRetailerView filtered by the territory_id column
 * @method     ChildRcpaRetailerView|null findOneByRcpaValue(string $rcpa_value) Return the first ChildRcpaRetailerView filtered by the rcpa_value column
 * @method     ChildRcpaRetailerView|null findOneByPotential(string $potential) Return the first ChildRcpaRetailerView filtered by the potential column
 * @method     ChildRcpaRetailerView|null findOneByOwn(string $own) Return the first ChildRcpaRetailerView filtered by the own column
 * @method     ChildRcpaRetailerView|null findOneByCompetition(string $competition) Return the first ChildRcpaRetailerView filtered by the competition column
 * @method     ChildRcpaRetailerView|null findOneByCreatedAt(string $lastcreated) Return the first ChildRcpaRetailerView filtered by the lastcreated column
 * @method     ChildRcpaRetailerView|null findOneByUpdatedAt(string $lastupdated) Return the first ChildRcpaRetailerView filtered by the lastupdated column
 * @method     ChildRcpaRetailerView|null findOneByBrandName(string $brand_name) Return the first ChildRcpaRetailerView filtered by the brand_name column
 *
 * @method     ChildRcpaRetailerView requirePk($key, ?ConnectionInterface $con = null) Return the ChildRcpaRetailerView by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRcpaRetailerView requireOne(?ConnectionInterface $con = null) Return the first ChildRcpaRetailerView matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildRcpaRetailerView requireOneByUniqueid(string $uniqueid) Return the first ChildRcpaRetailerView filtered by the uniqueid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRcpaRetailerView requireOneByDoctorid(int $doctorid) Return the first ChildRcpaRetailerView filtered by the doctorid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRcpaRetailerView requireOneByOutletOrgId(int $outlet_org_id) Return the first ChildRcpaRetailerView filtered by the outlet_org_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRcpaRetailerView requireOneByRetailOutletId(int $retail_outlet_id) Return the first ChildRcpaRetailerView filtered by the retail_outlet_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRcpaRetailerView requireOneByOutletName(string $outlet_name) Return the first ChildRcpaRetailerView filtered by the outlet_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRcpaRetailerView requireOneByRcpaMoye(string $rcpa_moye) Return the first ChildRcpaRetailerView filtered by the rcpa_moye column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRcpaRetailerView requireOneByTerritoryId(int $territory_id) Return the first ChildRcpaRetailerView filtered by the territory_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRcpaRetailerView requireOneByRcpaValue(string $rcpa_value) Return the first ChildRcpaRetailerView filtered by the rcpa_value column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRcpaRetailerView requireOneByPotential(string $potential) Return the first ChildRcpaRetailerView filtered by the potential column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRcpaRetailerView requireOneByOwn(string $own) Return the first ChildRcpaRetailerView filtered by the own column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRcpaRetailerView requireOneByCompetition(string $competition) Return the first ChildRcpaRetailerView filtered by the competition column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRcpaRetailerView requireOneByCreatedAt(string $lastcreated) Return the first ChildRcpaRetailerView filtered by the lastcreated column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRcpaRetailerView requireOneByUpdatedAt(string $lastupdated) Return the first ChildRcpaRetailerView filtered by the lastupdated column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRcpaRetailerView requireOneByBrandName(string $brand_name) Return the first ChildRcpaRetailerView filtered by the brand_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildRcpaRetailerView[]|Collection find(?ConnectionInterface $con = null) Return ChildRcpaRetailerView objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildRcpaRetailerView> find(?ConnectionInterface $con = null) Return ChildRcpaRetailerView objects based on current ModelCriteria
 *
 * @method     ChildRcpaRetailerView[]|Collection findByUniqueid(string|array<string> $uniqueid) Return ChildRcpaRetailerView objects filtered by the uniqueid column
 * @psalm-method Collection&\Traversable<ChildRcpaRetailerView> findByUniqueid(string|array<string> $uniqueid) Return ChildRcpaRetailerView objects filtered by the uniqueid column
 * @method     ChildRcpaRetailerView[]|Collection findByDoctorid(int|array<int> $doctorid) Return ChildRcpaRetailerView objects filtered by the doctorid column
 * @psalm-method Collection&\Traversable<ChildRcpaRetailerView> findByDoctorid(int|array<int> $doctorid) Return ChildRcpaRetailerView objects filtered by the doctorid column
 * @method     ChildRcpaRetailerView[]|Collection findByOutletOrgId(int|array<int> $outlet_org_id) Return ChildRcpaRetailerView objects filtered by the outlet_org_id column
 * @psalm-method Collection&\Traversable<ChildRcpaRetailerView> findByOutletOrgId(int|array<int> $outlet_org_id) Return ChildRcpaRetailerView objects filtered by the outlet_org_id column
 * @method     ChildRcpaRetailerView[]|Collection findByRetailOutletId(int|array<int> $retail_outlet_id) Return ChildRcpaRetailerView objects filtered by the retail_outlet_id column
 * @psalm-method Collection&\Traversable<ChildRcpaRetailerView> findByRetailOutletId(int|array<int> $retail_outlet_id) Return ChildRcpaRetailerView objects filtered by the retail_outlet_id column
 * @method     ChildRcpaRetailerView[]|Collection findByOutletName(string|array<string> $outlet_name) Return ChildRcpaRetailerView objects filtered by the outlet_name column
 * @psalm-method Collection&\Traversable<ChildRcpaRetailerView> findByOutletName(string|array<string> $outlet_name) Return ChildRcpaRetailerView objects filtered by the outlet_name column
 * @method     ChildRcpaRetailerView[]|Collection findByRcpaMoye(string|array<string> $rcpa_moye) Return ChildRcpaRetailerView objects filtered by the rcpa_moye column
 * @psalm-method Collection&\Traversable<ChildRcpaRetailerView> findByRcpaMoye(string|array<string> $rcpa_moye) Return ChildRcpaRetailerView objects filtered by the rcpa_moye column
 * @method     ChildRcpaRetailerView[]|Collection findByTerritoryId(int|array<int> $territory_id) Return ChildRcpaRetailerView objects filtered by the territory_id column
 * @psalm-method Collection&\Traversable<ChildRcpaRetailerView> findByTerritoryId(int|array<int> $territory_id) Return ChildRcpaRetailerView objects filtered by the territory_id column
 * @method     ChildRcpaRetailerView[]|Collection findByRcpaValue(string|array<string> $rcpa_value) Return ChildRcpaRetailerView objects filtered by the rcpa_value column
 * @psalm-method Collection&\Traversable<ChildRcpaRetailerView> findByRcpaValue(string|array<string> $rcpa_value) Return ChildRcpaRetailerView objects filtered by the rcpa_value column
 * @method     ChildRcpaRetailerView[]|Collection findByPotential(string|array<string> $potential) Return ChildRcpaRetailerView objects filtered by the potential column
 * @psalm-method Collection&\Traversable<ChildRcpaRetailerView> findByPotential(string|array<string> $potential) Return ChildRcpaRetailerView objects filtered by the potential column
 * @method     ChildRcpaRetailerView[]|Collection findByOwn(string|array<string> $own) Return ChildRcpaRetailerView objects filtered by the own column
 * @psalm-method Collection&\Traversable<ChildRcpaRetailerView> findByOwn(string|array<string> $own) Return ChildRcpaRetailerView objects filtered by the own column
 * @method     ChildRcpaRetailerView[]|Collection findByCompetition(string|array<string> $competition) Return ChildRcpaRetailerView objects filtered by the competition column
 * @psalm-method Collection&\Traversable<ChildRcpaRetailerView> findByCompetition(string|array<string> $competition) Return ChildRcpaRetailerView objects filtered by the competition column
 * @method     ChildRcpaRetailerView[]|Collection findByCreatedAt(string|array<string> $lastcreated) Return ChildRcpaRetailerView objects filtered by the lastcreated column
 * @psalm-method Collection&\Traversable<ChildRcpaRetailerView> findByCreatedAt(string|array<string> $lastcreated) Return ChildRcpaRetailerView objects filtered by the lastcreated column
 * @method     ChildRcpaRetailerView[]|Collection findByUpdatedAt(string|array<string> $lastupdated) Return ChildRcpaRetailerView objects filtered by the lastupdated column
 * @psalm-method Collection&\Traversable<ChildRcpaRetailerView> findByUpdatedAt(string|array<string> $lastupdated) Return ChildRcpaRetailerView objects filtered by the lastupdated column
 * @method     ChildRcpaRetailerView[]|Collection findByBrandName(string|array<string> $brand_name) Return ChildRcpaRetailerView objects filtered by the brand_name column
 * @psalm-method Collection&\Traversable<ChildRcpaRetailerView> findByBrandName(string|array<string> $brand_name) Return ChildRcpaRetailerView objects filtered by the brand_name column
 *
 * @method     ChildRcpaRetailerView[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildRcpaRetailerView> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class RcpaRetailerViewQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\RcpaRetailerViewQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\RcpaRetailerView', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildRcpaRetailerViewQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildRcpaRetailerViewQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildRcpaRetailerViewQuery) {
            return $criteria;
        }
        $query = new ChildRcpaRetailerViewQuery();
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
     * @return ChildRcpaRetailerView|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(RcpaRetailerViewTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = RcpaRetailerViewTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildRcpaRetailerView A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT uniqueid, doctorid, outlet_org_id, retail_outlet_id, outlet_name, rcpa_moye, territory_id, rcpa_value, potential, own, competition, lastcreated, lastupdated, brand_name FROM rcpa_retailer_view WHERE uniqueid = :p0';
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
            /** @var ChildRcpaRetailerView $obj */
            $obj = new ChildRcpaRetailerView();
            $obj->hydrate($row);
            RcpaRetailerViewTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildRcpaRetailerView|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(RcpaRetailerViewTableMap::COL_UNIQUEID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(RcpaRetailerViewTableMap::COL_UNIQUEID, $keys, Criteria::IN);

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

        $this->addUsingAlias(RcpaRetailerViewTableMap::COL_UNIQUEID, $uniqueid, $comparison);

        return $this;
    }

    /**
     * Filter the query on the doctorid column
     *
     * Example usage:
     * <code>
     * $query->filterByDoctorid(1234); // WHERE doctorid = 1234
     * $query->filterByDoctorid(array(12, 34)); // WHERE doctorid IN (12, 34)
     * $query->filterByDoctorid(array('min' => 12)); // WHERE doctorid > 12
     * </code>
     *
     * @param mixed $doctorid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDoctorid($doctorid = null, ?string $comparison = null)
    {
        if (is_array($doctorid)) {
            $useMinMax = false;
            if (isset($doctorid['min'])) {
                $this->addUsingAlias(RcpaRetailerViewTableMap::COL_DOCTORID, $doctorid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($doctorid['max'])) {
                $this->addUsingAlias(RcpaRetailerViewTableMap::COL_DOCTORID, $doctorid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(RcpaRetailerViewTableMap::COL_DOCTORID, $doctorid, $comparison);

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
                $this->addUsingAlias(RcpaRetailerViewTableMap::COL_OUTLET_ORG_ID, $outletOrgId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outletOrgId['max'])) {
                $this->addUsingAlias(RcpaRetailerViewTableMap::COL_OUTLET_ORG_ID, $outletOrgId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(RcpaRetailerViewTableMap::COL_OUTLET_ORG_ID, $outletOrgId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the retail_outlet_id column
     *
     * Example usage:
     * <code>
     * $query->filterByRetailOutletId(1234); // WHERE retail_outlet_id = 1234
     * $query->filterByRetailOutletId(array(12, 34)); // WHERE retail_outlet_id IN (12, 34)
     * $query->filterByRetailOutletId(array('min' => 12)); // WHERE retail_outlet_id > 12
     * </code>
     *
     * @param mixed $retailOutletId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRetailOutletId($retailOutletId = null, ?string $comparison = null)
    {
        if (is_array($retailOutletId)) {
            $useMinMax = false;
            if (isset($retailOutletId['min'])) {
                $this->addUsingAlias(RcpaRetailerViewTableMap::COL_RETAIL_OUTLET_ID, $retailOutletId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($retailOutletId['max'])) {
                $this->addUsingAlias(RcpaRetailerViewTableMap::COL_RETAIL_OUTLET_ID, $retailOutletId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(RcpaRetailerViewTableMap::COL_RETAIL_OUTLET_ID, $retailOutletId, $comparison);

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

        $this->addUsingAlias(RcpaRetailerViewTableMap::COL_OUTLET_NAME, $outletName, $comparison);

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

        $this->addUsingAlias(RcpaRetailerViewTableMap::COL_RCPA_MOYE, $rcpaMoye, $comparison);

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
                $this->addUsingAlias(RcpaRetailerViewTableMap::COL_TERRITORY_ID, $territoryId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($territoryId['max'])) {
                $this->addUsingAlias(RcpaRetailerViewTableMap::COL_TERRITORY_ID, $territoryId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(RcpaRetailerViewTableMap::COL_TERRITORY_ID, $territoryId, $comparison);

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
                $this->addUsingAlias(RcpaRetailerViewTableMap::COL_RCPA_VALUE, $rcpaValue['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($rcpaValue['max'])) {
                $this->addUsingAlias(RcpaRetailerViewTableMap::COL_RCPA_VALUE, $rcpaValue['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(RcpaRetailerViewTableMap::COL_RCPA_VALUE, $rcpaValue, $comparison);

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
                $this->addUsingAlias(RcpaRetailerViewTableMap::COL_POTENTIAL, $potential['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($potential['max'])) {
                $this->addUsingAlias(RcpaRetailerViewTableMap::COL_POTENTIAL, $potential['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(RcpaRetailerViewTableMap::COL_POTENTIAL, $potential, $comparison);

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
                $this->addUsingAlias(RcpaRetailerViewTableMap::COL_OWN, $own['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($own['max'])) {
                $this->addUsingAlias(RcpaRetailerViewTableMap::COL_OWN, $own['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(RcpaRetailerViewTableMap::COL_OWN, $own, $comparison);

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
                $this->addUsingAlias(RcpaRetailerViewTableMap::COL_COMPETITION, $competition['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($competition['max'])) {
                $this->addUsingAlias(RcpaRetailerViewTableMap::COL_COMPETITION, $competition['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(RcpaRetailerViewTableMap::COL_COMPETITION, $competition, $comparison);

        return $this;
    }

    /**
     * Filter the query on the lastcreated column
     *
     * Example usage:
     * <code>
     * $query->filterByCreatedAt('2011-03-14'); // WHERE lastcreated = '2011-03-14'
     * $query->filterByCreatedAt('now'); // WHERE lastcreated = '2011-03-14'
     * $query->filterByCreatedAt(array('max' => 'yesterday')); // WHERE lastcreated > '2011-03-13'
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
                $this->addUsingAlias(RcpaRetailerViewTableMap::COL_LASTCREATED, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(RcpaRetailerViewTableMap::COL_LASTCREATED, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(RcpaRetailerViewTableMap::COL_LASTCREATED, $createdAt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the lastupdated column
     *
     * Example usage:
     * <code>
     * $query->filterByUpdatedAt('2011-03-14'); // WHERE lastupdated = '2011-03-14'
     * $query->filterByUpdatedAt('now'); // WHERE lastupdated = '2011-03-14'
     * $query->filterByUpdatedAt(array('max' => 'yesterday')); // WHERE lastupdated > '2011-03-13'
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
                $this->addUsingAlias(RcpaRetailerViewTableMap::COL_LASTUPDATED, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(RcpaRetailerViewTableMap::COL_LASTUPDATED, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(RcpaRetailerViewTableMap::COL_LASTUPDATED, $updatedAt, $comparison);

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

        $this->addUsingAlias(RcpaRetailerViewTableMap::COL_BRAND_NAME, $brandName, $comparison);

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildRcpaRetailerView $rcpaRetailerView Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($rcpaRetailerView = null)
    {
        if ($rcpaRetailerView) {
            $this->addUsingAlias(RcpaRetailerViewTableMap::COL_UNIQUEID, $rcpaRetailerView->getUniqueid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
