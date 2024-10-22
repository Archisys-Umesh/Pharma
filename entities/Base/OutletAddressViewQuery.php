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
use entities\OutletAddressView as ChildOutletAddressView;
use entities\OutletAddressViewQuery as ChildOutletAddressViewQuery;
use entities\Map\OutletAddressViewTableMap;

/**
 * Base class that represents a query for the `outlet_address_view` table.
 *
 * @method     ChildOutletAddressViewQuery orderByOutletAddressId($order = Criteria::ASC) Order by the outlet_address_id column
 * @method     ChildOutletAddressViewQuery orderByOutletAddress($order = Criteria::ASC) Order by the outlet_address column
 * @method     ChildOutletAddressViewQuery orderByOutletStreetName($order = Criteria::ASC) Order by the outlet_street_name column
 * @method     ChildOutletAddressViewQuery orderByOutletCity($order = Criteria::ASC) Order by the outlet_city column
 * @method     ChildOutletAddressViewQuery orderByOutletState($order = Criteria::ASC) Order by the outlet_state column
 * @method     ChildOutletAddressViewQuery orderByOutletCountry($order = Criteria::ASC) Order by the outlet_country column
 * @method     ChildOutletAddressViewQuery orderByOutletPincode($order = Criteria::ASC) Order by the outlet_pincode column
 * @method     ChildOutletAddressViewQuery orderByOutletId($order = Criteria::ASC) Order by the outlet_id column
 * @method     ChildOutletAddressViewQuery orderByOutletGps($order = Criteria::ASC) Order by the outlet_gps column
 * @method     ChildOutletAddressViewQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildOutletAddressViewQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildOutletAddressViewQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildOutletAddressViewQuery orderByAddressName($order = Criteria::ASC) Order by the address_name column
 * @method     ChildOutletAddressViewQuery orderByIsDefault($order = Criteria::ASC) Order by the is_default column
 * @method     ChildOutletAddressViewQuery orderByOutletOrgId($order = Criteria::ASC) Order by the outlet_org_id column
 * @method     ChildOutletAddressViewQuery orderByOrgUnitId($order = Criteria::ASC) Order by the org_unit_id column
 * @method     ChildOutletAddressViewQuery orderByTerritoryId($order = Criteria::ASC) Order by the territory_id column
 * @method     ChildOutletAddressViewQuery orderByTerritoryName($order = Criteria::ASC) Order by the territory_name column
 *
 * @method     ChildOutletAddressViewQuery groupByOutletAddressId() Group by the outlet_address_id column
 * @method     ChildOutletAddressViewQuery groupByOutletAddress() Group by the outlet_address column
 * @method     ChildOutletAddressViewQuery groupByOutletStreetName() Group by the outlet_street_name column
 * @method     ChildOutletAddressViewQuery groupByOutletCity() Group by the outlet_city column
 * @method     ChildOutletAddressViewQuery groupByOutletState() Group by the outlet_state column
 * @method     ChildOutletAddressViewQuery groupByOutletCountry() Group by the outlet_country column
 * @method     ChildOutletAddressViewQuery groupByOutletPincode() Group by the outlet_pincode column
 * @method     ChildOutletAddressViewQuery groupByOutletId() Group by the outlet_id column
 * @method     ChildOutletAddressViewQuery groupByOutletGps() Group by the outlet_gps column
 * @method     ChildOutletAddressViewQuery groupByCompanyId() Group by the company_id column
 * @method     ChildOutletAddressViewQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildOutletAddressViewQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildOutletAddressViewQuery groupByAddressName() Group by the address_name column
 * @method     ChildOutletAddressViewQuery groupByIsDefault() Group by the is_default column
 * @method     ChildOutletAddressViewQuery groupByOutletOrgId() Group by the outlet_org_id column
 * @method     ChildOutletAddressViewQuery groupByOrgUnitId() Group by the org_unit_id column
 * @method     ChildOutletAddressViewQuery groupByTerritoryId() Group by the territory_id column
 * @method     ChildOutletAddressViewQuery groupByTerritoryName() Group by the territory_name column
 *
 * @method     ChildOutletAddressViewQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildOutletAddressViewQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildOutletAddressViewQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildOutletAddressViewQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildOutletAddressViewQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildOutletAddressViewQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildOutletAddressView|null findOne(?ConnectionInterface $con = null) Return the first ChildOutletAddressView matching the query
 * @method     ChildOutletAddressView findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildOutletAddressView matching the query, or a new ChildOutletAddressView object populated from the query conditions when no match is found
 *
 * @method     ChildOutletAddressView|null findOneByOutletAddressId(int $outlet_address_id) Return the first ChildOutletAddressView filtered by the outlet_address_id column
 * @method     ChildOutletAddressView|null findOneByOutletAddress(string $outlet_address) Return the first ChildOutletAddressView filtered by the outlet_address column
 * @method     ChildOutletAddressView|null findOneByOutletStreetName(string $outlet_street_name) Return the first ChildOutletAddressView filtered by the outlet_street_name column
 * @method     ChildOutletAddressView|null findOneByOutletCity(string $outlet_city) Return the first ChildOutletAddressView filtered by the outlet_city column
 * @method     ChildOutletAddressView|null findOneByOutletState(string $outlet_state) Return the first ChildOutletAddressView filtered by the outlet_state column
 * @method     ChildOutletAddressView|null findOneByOutletCountry(string $outlet_country) Return the first ChildOutletAddressView filtered by the outlet_country column
 * @method     ChildOutletAddressView|null findOneByOutletPincode(string $outlet_pincode) Return the first ChildOutletAddressView filtered by the outlet_pincode column
 * @method     ChildOutletAddressView|null findOneByOutletId(int $outlet_id) Return the first ChildOutletAddressView filtered by the outlet_id column
 * @method     ChildOutletAddressView|null findOneByOutletGps(string $outlet_gps) Return the first ChildOutletAddressView filtered by the outlet_gps column
 * @method     ChildOutletAddressView|null findOneByCompanyId(int $company_id) Return the first ChildOutletAddressView filtered by the company_id column
 * @method     ChildOutletAddressView|null findOneByCreatedAt(string $created_at) Return the first ChildOutletAddressView filtered by the created_at column
 * @method     ChildOutletAddressView|null findOneByUpdatedAt(string $updated_at) Return the first ChildOutletAddressView filtered by the updated_at column
 * @method     ChildOutletAddressView|null findOneByAddressName(string $address_name) Return the first ChildOutletAddressView filtered by the address_name column
 * @method     ChildOutletAddressView|null findOneByIsDefault(int $is_default) Return the first ChildOutletAddressView filtered by the is_default column
 * @method     ChildOutletAddressView|null findOneByOutletOrgId(int $outlet_org_id) Return the first ChildOutletAddressView filtered by the outlet_org_id column
 * @method     ChildOutletAddressView|null findOneByOrgUnitId(int $org_unit_id) Return the first ChildOutletAddressView filtered by the org_unit_id column
 * @method     ChildOutletAddressView|null findOneByTerritoryId(int $territory_id) Return the first ChildOutletAddressView filtered by the territory_id column
 * @method     ChildOutletAddressView|null findOneByTerritoryName(string $territory_name) Return the first ChildOutletAddressView filtered by the territory_name column
 *
 * @method     ChildOutletAddressView requirePk($key, ?ConnectionInterface $con = null) Return the ChildOutletAddressView by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletAddressView requireOne(?ConnectionInterface $con = null) Return the first ChildOutletAddressView matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOutletAddressView requireOneByOutletAddressId(int $outlet_address_id) Return the first ChildOutletAddressView filtered by the outlet_address_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletAddressView requireOneByOutletAddress(string $outlet_address) Return the first ChildOutletAddressView filtered by the outlet_address column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletAddressView requireOneByOutletStreetName(string $outlet_street_name) Return the first ChildOutletAddressView filtered by the outlet_street_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletAddressView requireOneByOutletCity(string $outlet_city) Return the first ChildOutletAddressView filtered by the outlet_city column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletAddressView requireOneByOutletState(string $outlet_state) Return the first ChildOutletAddressView filtered by the outlet_state column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletAddressView requireOneByOutletCountry(string $outlet_country) Return the first ChildOutletAddressView filtered by the outlet_country column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletAddressView requireOneByOutletPincode(string $outlet_pincode) Return the first ChildOutletAddressView filtered by the outlet_pincode column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletAddressView requireOneByOutletId(int $outlet_id) Return the first ChildOutletAddressView filtered by the outlet_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletAddressView requireOneByOutletGps(string $outlet_gps) Return the first ChildOutletAddressView filtered by the outlet_gps column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletAddressView requireOneByCompanyId(int $company_id) Return the first ChildOutletAddressView filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletAddressView requireOneByCreatedAt(string $created_at) Return the first ChildOutletAddressView filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletAddressView requireOneByUpdatedAt(string $updated_at) Return the first ChildOutletAddressView filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletAddressView requireOneByAddressName(string $address_name) Return the first ChildOutletAddressView filtered by the address_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletAddressView requireOneByIsDefault(int $is_default) Return the first ChildOutletAddressView filtered by the is_default column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletAddressView requireOneByOutletOrgId(int $outlet_org_id) Return the first ChildOutletAddressView filtered by the outlet_org_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletAddressView requireOneByOrgUnitId(int $org_unit_id) Return the first ChildOutletAddressView filtered by the org_unit_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletAddressView requireOneByTerritoryId(int $territory_id) Return the first ChildOutletAddressView filtered by the territory_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletAddressView requireOneByTerritoryName(string $territory_name) Return the first ChildOutletAddressView filtered by the territory_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOutletAddressView[]|Collection find(?ConnectionInterface $con = null) Return ChildOutletAddressView objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildOutletAddressView> find(?ConnectionInterface $con = null) Return ChildOutletAddressView objects based on current ModelCriteria
 *
 * @method     ChildOutletAddressView[]|Collection findByOutletAddressId(int|array<int> $outlet_address_id) Return ChildOutletAddressView objects filtered by the outlet_address_id column
 * @psalm-method Collection&\Traversable<ChildOutletAddressView> findByOutletAddressId(int|array<int> $outlet_address_id) Return ChildOutletAddressView objects filtered by the outlet_address_id column
 * @method     ChildOutletAddressView[]|Collection findByOutletAddress(string|array<string> $outlet_address) Return ChildOutletAddressView objects filtered by the outlet_address column
 * @psalm-method Collection&\Traversable<ChildOutletAddressView> findByOutletAddress(string|array<string> $outlet_address) Return ChildOutletAddressView objects filtered by the outlet_address column
 * @method     ChildOutletAddressView[]|Collection findByOutletStreetName(string|array<string> $outlet_street_name) Return ChildOutletAddressView objects filtered by the outlet_street_name column
 * @psalm-method Collection&\Traversable<ChildOutletAddressView> findByOutletStreetName(string|array<string> $outlet_street_name) Return ChildOutletAddressView objects filtered by the outlet_street_name column
 * @method     ChildOutletAddressView[]|Collection findByOutletCity(string|array<string> $outlet_city) Return ChildOutletAddressView objects filtered by the outlet_city column
 * @psalm-method Collection&\Traversable<ChildOutletAddressView> findByOutletCity(string|array<string> $outlet_city) Return ChildOutletAddressView objects filtered by the outlet_city column
 * @method     ChildOutletAddressView[]|Collection findByOutletState(string|array<string> $outlet_state) Return ChildOutletAddressView objects filtered by the outlet_state column
 * @psalm-method Collection&\Traversable<ChildOutletAddressView> findByOutletState(string|array<string> $outlet_state) Return ChildOutletAddressView objects filtered by the outlet_state column
 * @method     ChildOutletAddressView[]|Collection findByOutletCountry(string|array<string> $outlet_country) Return ChildOutletAddressView objects filtered by the outlet_country column
 * @psalm-method Collection&\Traversable<ChildOutletAddressView> findByOutletCountry(string|array<string> $outlet_country) Return ChildOutletAddressView objects filtered by the outlet_country column
 * @method     ChildOutletAddressView[]|Collection findByOutletPincode(string|array<string> $outlet_pincode) Return ChildOutletAddressView objects filtered by the outlet_pincode column
 * @psalm-method Collection&\Traversable<ChildOutletAddressView> findByOutletPincode(string|array<string> $outlet_pincode) Return ChildOutletAddressView objects filtered by the outlet_pincode column
 * @method     ChildOutletAddressView[]|Collection findByOutletId(int|array<int> $outlet_id) Return ChildOutletAddressView objects filtered by the outlet_id column
 * @psalm-method Collection&\Traversable<ChildOutletAddressView> findByOutletId(int|array<int> $outlet_id) Return ChildOutletAddressView objects filtered by the outlet_id column
 * @method     ChildOutletAddressView[]|Collection findByOutletGps(string|array<string> $outlet_gps) Return ChildOutletAddressView objects filtered by the outlet_gps column
 * @psalm-method Collection&\Traversable<ChildOutletAddressView> findByOutletGps(string|array<string> $outlet_gps) Return ChildOutletAddressView objects filtered by the outlet_gps column
 * @method     ChildOutletAddressView[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildOutletAddressView objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildOutletAddressView> findByCompanyId(int|array<int> $company_id) Return ChildOutletAddressView objects filtered by the company_id column
 * @method     ChildOutletAddressView[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildOutletAddressView objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildOutletAddressView> findByCreatedAt(string|array<string> $created_at) Return ChildOutletAddressView objects filtered by the created_at column
 * @method     ChildOutletAddressView[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildOutletAddressView objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildOutletAddressView> findByUpdatedAt(string|array<string> $updated_at) Return ChildOutletAddressView objects filtered by the updated_at column
 * @method     ChildOutletAddressView[]|Collection findByAddressName(string|array<string> $address_name) Return ChildOutletAddressView objects filtered by the address_name column
 * @psalm-method Collection&\Traversable<ChildOutletAddressView> findByAddressName(string|array<string> $address_name) Return ChildOutletAddressView objects filtered by the address_name column
 * @method     ChildOutletAddressView[]|Collection findByIsDefault(int|array<int> $is_default) Return ChildOutletAddressView objects filtered by the is_default column
 * @psalm-method Collection&\Traversable<ChildOutletAddressView> findByIsDefault(int|array<int> $is_default) Return ChildOutletAddressView objects filtered by the is_default column
 * @method     ChildOutletAddressView[]|Collection findByOutletOrgId(int|array<int> $outlet_org_id) Return ChildOutletAddressView objects filtered by the outlet_org_id column
 * @psalm-method Collection&\Traversable<ChildOutletAddressView> findByOutletOrgId(int|array<int> $outlet_org_id) Return ChildOutletAddressView objects filtered by the outlet_org_id column
 * @method     ChildOutletAddressView[]|Collection findByOrgUnitId(int|array<int> $org_unit_id) Return ChildOutletAddressView objects filtered by the org_unit_id column
 * @psalm-method Collection&\Traversable<ChildOutletAddressView> findByOrgUnitId(int|array<int> $org_unit_id) Return ChildOutletAddressView objects filtered by the org_unit_id column
 * @method     ChildOutletAddressView[]|Collection findByTerritoryId(int|array<int> $territory_id) Return ChildOutletAddressView objects filtered by the territory_id column
 * @psalm-method Collection&\Traversable<ChildOutletAddressView> findByTerritoryId(int|array<int> $territory_id) Return ChildOutletAddressView objects filtered by the territory_id column
 * @method     ChildOutletAddressView[]|Collection findByTerritoryName(string|array<string> $territory_name) Return ChildOutletAddressView objects filtered by the territory_name column
 * @psalm-method Collection&\Traversable<ChildOutletAddressView> findByTerritoryName(string|array<string> $territory_name) Return ChildOutletAddressView objects filtered by the territory_name column
 *
 * @method     ChildOutletAddressView[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildOutletAddressView> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class OutletAddressViewQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\OutletAddressViewQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\OutletAddressView', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildOutletAddressViewQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildOutletAddressViewQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildOutletAddressViewQuery) {
            return $criteria;
        }
        $query = new ChildOutletAddressViewQuery();
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
     * @return ChildOutletAddressView|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(OutletAddressViewTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = OutletAddressViewTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildOutletAddressView A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT outlet_address_id, outlet_address, outlet_street_name, outlet_city, outlet_state, outlet_country, outlet_pincode, outlet_id, outlet_gps, company_id, created_at, updated_at, address_name, is_default, outlet_org_id, org_unit_id, territory_id, territory_name FROM outlet_address_view WHERE outlet_address_id = :p0';
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
            /** @var ChildOutletAddressView $obj */
            $obj = new ChildOutletAddressView();
            $obj->hydrate($row);
            OutletAddressViewTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildOutletAddressView|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(OutletAddressViewTableMap::COL_OUTLET_ADDRESS_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(OutletAddressViewTableMap::COL_OUTLET_ADDRESS_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the outlet_address_id column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletAddressId(1234); // WHERE outlet_address_id = 1234
     * $query->filterByOutletAddressId(array(12, 34)); // WHERE outlet_address_id IN (12, 34)
     * $query->filterByOutletAddressId(array('min' => 12)); // WHERE outlet_address_id > 12
     * </code>
     *
     * @param mixed $outletAddressId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletAddressId($outletAddressId = null, ?string $comparison = null)
    {
        if (is_array($outletAddressId)) {
            $useMinMax = false;
            if (isset($outletAddressId['min'])) {
                $this->addUsingAlias(OutletAddressViewTableMap::COL_OUTLET_ADDRESS_ID, $outletAddressId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outletAddressId['max'])) {
                $this->addUsingAlias(OutletAddressViewTableMap::COL_OUTLET_ADDRESS_ID, $outletAddressId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletAddressViewTableMap::COL_OUTLET_ADDRESS_ID, $outletAddressId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_address column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletAddress('fooValue');   // WHERE outlet_address = 'fooValue'
     * $query->filterByOutletAddress('%fooValue%', Criteria::LIKE); // WHERE outlet_address LIKE '%fooValue%'
     * $query->filterByOutletAddress(['foo', 'bar']); // WHERE outlet_address IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $outletAddress The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletAddress($outletAddress = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($outletAddress)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletAddressViewTableMap::COL_OUTLET_ADDRESS, $outletAddress, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_street_name column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletStreetName('fooValue');   // WHERE outlet_street_name = 'fooValue'
     * $query->filterByOutletStreetName('%fooValue%', Criteria::LIKE); // WHERE outlet_street_name LIKE '%fooValue%'
     * $query->filterByOutletStreetName(['foo', 'bar']); // WHERE outlet_street_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $outletStreetName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletStreetName($outletStreetName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($outletStreetName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletAddressViewTableMap::COL_OUTLET_STREET_NAME, $outletStreetName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_city column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletCity('fooValue');   // WHERE outlet_city = 'fooValue'
     * $query->filterByOutletCity('%fooValue%', Criteria::LIKE); // WHERE outlet_city LIKE '%fooValue%'
     * $query->filterByOutletCity(['foo', 'bar']); // WHERE outlet_city IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $outletCity The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletCity($outletCity = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($outletCity)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletAddressViewTableMap::COL_OUTLET_CITY, $outletCity, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_state column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletState('fooValue');   // WHERE outlet_state = 'fooValue'
     * $query->filterByOutletState('%fooValue%', Criteria::LIKE); // WHERE outlet_state LIKE '%fooValue%'
     * $query->filterByOutletState(['foo', 'bar']); // WHERE outlet_state IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $outletState The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletState($outletState = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($outletState)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletAddressViewTableMap::COL_OUTLET_STATE, $outletState, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_country column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletCountry('fooValue');   // WHERE outlet_country = 'fooValue'
     * $query->filterByOutletCountry('%fooValue%', Criteria::LIKE); // WHERE outlet_country LIKE '%fooValue%'
     * $query->filterByOutletCountry(['foo', 'bar']); // WHERE outlet_country IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $outletCountry The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletCountry($outletCountry = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($outletCountry)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletAddressViewTableMap::COL_OUTLET_COUNTRY, $outletCountry, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_pincode column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletPincode('fooValue');   // WHERE outlet_pincode = 'fooValue'
     * $query->filterByOutletPincode('%fooValue%', Criteria::LIKE); // WHERE outlet_pincode LIKE '%fooValue%'
     * $query->filterByOutletPincode(['foo', 'bar']); // WHERE outlet_pincode IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $outletPincode The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletPincode($outletPincode = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($outletPincode)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletAddressViewTableMap::COL_OUTLET_PINCODE, $outletPincode, $comparison);

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
                $this->addUsingAlias(OutletAddressViewTableMap::COL_OUTLET_ID, $outletId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outletId['max'])) {
                $this->addUsingAlias(OutletAddressViewTableMap::COL_OUTLET_ID, $outletId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletAddressViewTableMap::COL_OUTLET_ID, $outletId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_gps column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletGps('fooValue');   // WHERE outlet_gps = 'fooValue'
     * $query->filterByOutletGps('%fooValue%', Criteria::LIKE); // WHERE outlet_gps LIKE '%fooValue%'
     * $query->filterByOutletGps(['foo', 'bar']); // WHERE outlet_gps IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $outletGps The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletGps($outletGps = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($outletGps)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletAddressViewTableMap::COL_OUTLET_GPS, $outletGps, $comparison);

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
                $this->addUsingAlias(OutletAddressViewTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(OutletAddressViewTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletAddressViewTableMap::COL_COMPANY_ID, $companyId, $comparison);

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
                $this->addUsingAlias(OutletAddressViewTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(OutletAddressViewTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletAddressViewTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(OutletAddressViewTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(OutletAddressViewTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletAddressViewTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the address_name column
     *
     * Example usage:
     * <code>
     * $query->filterByAddressName('fooValue');   // WHERE address_name = 'fooValue'
     * $query->filterByAddressName('%fooValue%', Criteria::LIKE); // WHERE address_name LIKE '%fooValue%'
     * $query->filterByAddressName(['foo', 'bar']); // WHERE address_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $addressName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAddressName($addressName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($addressName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletAddressViewTableMap::COL_ADDRESS_NAME, $addressName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the is_default column
     *
     * Example usage:
     * <code>
     * $query->filterByIsDefault(1234); // WHERE is_default = 1234
     * $query->filterByIsDefault(array(12, 34)); // WHERE is_default IN (12, 34)
     * $query->filterByIsDefault(array('min' => 12)); // WHERE is_default > 12
     * </code>
     *
     * @param mixed $isDefault The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIsDefault($isDefault = null, ?string $comparison = null)
    {
        if (is_array($isDefault)) {
            $useMinMax = false;
            if (isset($isDefault['min'])) {
                $this->addUsingAlias(OutletAddressViewTableMap::COL_IS_DEFAULT, $isDefault['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($isDefault['max'])) {
                $this->addUsingAlias(OutletAddressViewTableMap::COL_IS_DEFAULT, $isDefault['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletAddressViewTableMap::COL_IS_DEFAULT, $isDefault, $comparison);

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
                $this->addUsingAlias(OutletAddressViewTableMap::COL_OUTLET_ORG_ID, $outletOrgId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outletOrgId['max'])) {
                $this->addUsingAlias(OutletAddressViewTableMap::COL_OUTLET_ORG_ID, $outletOrgId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletAddressViewTableMap::COL_OUTLET_ORG_ID, $outletOrgId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the org_unit_id column
     *
     * Example usage:
     * <code>
     * $query->filterByOrgUnitId(1234); // WHERE org_unit_id = 1234
     * $query->filterByOrgUnitId(array(12, 34)); // WHERE org_unit_id IN (12, 34)
     * $query->filterByOrgUnitId(array('min' => 12)); // WHERE org_unit_id > 12
     * </code>
     *
     * @param mixed $orgUnitId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrgUnitId($orgUnitId = null, ?string $comparison = null)
    {
        if (is_array($orgUnitId)) {
            $useMinMax = false;
            if (isset($orgUnitId['min'])) {
                $this->addUsingAlias(OutletAddressViewTableMap::COL_ORG_UNIT_ID, $orgUnitId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($orgUnitId['max'])) {
                $this->addUsingAlias(OutletAddressViewTableMap::COL_ORG_UNIT_ID, $orgUnitId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletAddressViewTableMap::COL_ORG_UNIT_ID, $orgUnitId, $comparison);

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
                $this->addUsingAlias(OutletAddressViewTableMap::COL_TERRITORY_ID, $territoryId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($territoryId['max'])) {
                $this->addUsingAlias(OutletAddressViewTableMap::COL_TERRITORY_ID, $territoryId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletAddressViewTableMap::COL_TERRITORY_ID, $territoryId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the territory_name column
     *
     * Example usage:
     * <code>
     * $query->filterByTerritoryName('fooValue');   // WHERE territory_name = 'fooValue'
     * $query->filterByTerritoryName('%fooValue%', Criteria::LIKE); // WHERE territory_name LIKE '%fooValue%'
     * $query->filterByTerritoryName(['foo', 'bar']); // WHERE territory_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $territoryName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTerritoryName($territoryName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($territoryName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletAddressViewTableMap::COL_TERRITORY_NAME, $territoryName, $comparison);

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildOutletAddressView $outletAddressView Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($outletAddressView = null)
    {
        if ($outletAddressView) {
            $this->addUsingAlias(OutletAddressViewTableMap::COL_OUTLET_ADDRESS_ID, $outletAddressView->getOutletAddressId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
