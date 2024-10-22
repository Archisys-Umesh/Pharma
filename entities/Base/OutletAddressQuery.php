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
use entities\OutletAddress as ChildOutletAddress;
use entities\OutletAddressQuery as ChildOutletAddressQuery;
use entities\Map\OutletAddressTableMap;

/**
 * Base class that represents a query for the `outlet_address` table.
 *
 * @method     ChildOutletAddressQuery orderByOutletAddressId($order = Criteria::ASC) Order by the outlet_address_id column
 * @method     ChildOutletAddressQuery orderByOutletAddress($order = Criteria::ASC) Order by the outlet_address column
 * @method     ChildOutletAddressQuery orderByOutletStreetName($order = Criteria::ASC) Order by the outlet_street_name column
 * @method     ChildOutletAddressQuery orderByOutletCity($order = Criteria::ASC) Order by the outlet_city column
 * @method     ChildOutletAddressQuery orderByOutletState($order = Criteria::ASC) Order by the outlet_state column
 * @method     ChildOutletAddressQuery orderByOutletCountry($order = Criteria::ASC) Order by the outlet_country column
 * @method     ChildOutletAddressQuery orderByOutletPincode($order = Criteria::ASC) Order by the outlet_pincode column
 * @method     ChildOutletAddressQuery orderByOutletId($order = Criteria::ASC) Order by the outlet_id column
 * @method     ChildOutletAddressQuery orderByOutletGps($order = Criteria::ASC) Order by the outlet_gps column
 * @method     ChildOutletAddressQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildOutletAddressQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildOutletAddressQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildOutletAddressQuery orderByAddressName($order = Criteria::ASC) Order by the address_name column
 * @method     ChildOutletAddressQuery orderByItownid($order = Criteria::ASC) Order by the itownid column
 *
 * @method     ChildOutletAddressQuery groupByOutletAddressId() Group by the outlet_address_id column
 * @method     ChildOutletAddressQuery groupByOutletAddress() Group by the outlet_address column
 * @method     ChildOutletAddressQuery groupByOutletStreetName() Group by the outlet_street_name column
 * @method     ChildOutletAddressQuery groupByOutletCity() Group by the outlet_city column
 * @method     ChildOutletAddressQuery groupByOutletState() Group by the outlet_state column
 * @method     ChildOutletAddressQuery groupByOutletCountry() Group by the outlet_country column
 * @method     ChildOutletAddressQuery groupByOutletPincode() Group by the outlet_pincode column
 * @method     ChildOutletAddressQuery groupByOutletId() Group by the outlet_id column
 * @method     ChildOutletAddressQuery groupByOutletGps() Group by the outlet_gps column
 * @method     ChildOutletAddressQuery groupByCompanyId() Group by the company_id column
 * @method     ChildOutletAddressQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildOutletAddressQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildOutletAddressQuery groupByAddressName() Group by the address_name column
 * @method     ChildOutletAddressQuery groupByItownid() Group by the itownid column
 *
 * @method     ChildOutletAddressQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildOutletAddressQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildOutletAddressQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildOutletAddressQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildOutletAddressQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildOutletAddressQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildOutletAddressQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildOutletAddressQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildOutletAddressQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildOutletAddressQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildOutletAddressQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildOutletAddressQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildOutletAddressQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     ChildOutletAddressQuery leftJoinOutlets($relationAlias = null) Adds a LEFT JOIN clause to the query using the Outlets relation
 * @method     ChildOutletAddressQuery rightJoinOutlets($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Outlets relation
 * @method     ChildOutletAddressQuery innerJoinOutlets($relationAlias = null) Adds a INNER JOIN clause to the query using the Outlets relation
 *
 * @method     ChildOutletAddressQuery joinWithOutlets($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Outlets relation
 *
 * @method     ChildOutletAddressQuery leftJoinWithOutlets() Adds a LEFT JOIN clause and with to the query using the Outlets relation
 * @method     ChildOutletAddressQuery rightJoinWithOutlets() Adds a RIGHT JOIN clause and with to the query using the Outlets relation
 * @method     ChildOutletAddressQuery innerJoinWithOutlets() Adds a INNER JOIN clause and with to the query using the Outlets relation
 *
 * @method     ChildOutletAddressQuery leftJoinGeoTowns($relationAlias = null) Adds a LEFT JOIN clause to the query using the GeoTowns relation
 * @method     ChildOutletAddressQuery rightJoinGeoTowns($relationAlias = null) Adds a RIGHT JOIN clause to the query using the GeoTowns relation
 * @method     ChildOutletAddressQuery innerJoinGeoTowns($relationAlias = null) Adds a INNER JOIN clause to the query using the GeoTowns relation
 *
 * @method     ChildOutletAddressQuery joinWithGeoTowns($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the GeoTowns relation
 *
 * @method     ChildOutletAddressQuery leftJoinWithGeoTowns() Adds a LEFT JOIN clause and with to the query using the GeoTowns relation
 * @method     ChildOutletAddressQuery rightJoinWithGeoTowns() Adds a RIGHT JOIN clause and with to the query using the GeoTowns relation
 * @method     ChildOutletAddressQuery innerJoinWithGeoTowns() Adds a INNER JOIN clause and with to the query using the GeoTowns relation
 *
 * @method     ChildOutletAddressQuery leftJoinOnBoardRequestAddress($relationAlias = null) Adds a LEFT JOIN clause to the query using the OnBoardRequestAddress relation
 * @method     ChildOutletAddressQuery rightJoinOnBoardRequestAddress($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OnBoardRequestAddress relation
 * @method     ChildOutletAddressQuery innerJoinOnBoardRequestAddress($relationAlias = null) Adds a INNER JOIN clause to the query using the OnBoardRequestAddress relation
 *
 * @method     ChildOutletAddressQuery joinWithOnBoardRequestAddress($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OnBoardRequestAddress relation
 *
 * @method     ChildOutletAddressQuery leftJoinWithOnBoardRequestAddress() Adds a LEFT JOIN clause and with to the query using the OnBoardRequestAddress relation
 * @method     ChildOutletAddressQuery rightJoinWithOnBoardRequestAddress() Adds a RIGHT JOIN clause and with to the query using the OnBoardRequestAddress relation
 * @method     ChildOutletAddressQuery innerJoinWithOnBoardRequestAddress() Adds a INNER JOIN clause and with to the query using the OnBoardRequestAddress relation
 *
 * @method     ChildOutletAddressQuery leftJoinOutletOrgData($relationAlias = null) Adds a LEFT JOIN clause to the query using the OutletOrgData relation
 * @method     ChildOutletAddressQuery rightJoinOutletOrgData($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OutletOrgData relation
 * @method     ChildOutletAddressQuery innerJoinOutletOrgData($relationAlias = null) Adds a INNER JOIN clause to the query using the OutletOrgData relation
 *
 * @method     ChildOutletAddressQuery joinWithOutletOrgData($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OutletOrgData relation
 *
 * @method     ChildOutletAddressQuery leftJoinWithOutletOrgData() Adds a LEFT JOIN clause and with to the query using the OutletOrgData relation
 * @method     ChildOutletAddressQuery rightJoinWithOutletOrgData() Adds a RIGHT JOIN clause and with to the query using the OutletOrgData relation
 * @method     ChildOutletAddressQuery innerJoinWithOutletOrgData() Adds a INNER JOIN clause and with to the query using the OutletOrgData relation
 *
 * @method     \entities\CompanyQuery|\entities\OutletsQuery|\entities\GeoTownsQuery|\entities\OnBoardRequestAddressQuery|\entities\OutletOrgDataQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildOutletAddress|null findOne(?ConnectionInterface $con = null) Return the first ChildOutletAddress matching the query
 * @method     ChildOutletAddress findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildOutletAddress matching the query, or a new ChildOutletAddress object populated from the query conditions when no match is found
 *
 * @method     ChildOutletAddress|null findOneByOutletAddressId(string $outlet_address_id) Return the first ChildOutletAddress filtered by the outlet_address_id column
 * @method     ChildOutletAddress|null findOneByOutletAddress(string $outlet_address) Return the first ChildOutletAddress filtered by the outlet_address column
 * @method     ChildOutletAddress|null findOneByOutletStreetName(string $outlet_street_name) Return the first ChildOutletAddress filtered by the outlet_street_name column
 * @method     ChildOutletAddress|null findOneByOutletCity(string $outlet_city) Return the first ChildOutletAddress filtered by the outlet_city column
 * @method     ChildOutletAddress|null findOneByOutletState(string $outlet_state) Return the first ChildOutletAddress filtered by the outlet_state column
 * @method     ChildOutletAddress|null findOneByOutletCountry(string $outlet_country) Return the first ChildOutletAddress filtered by the outlet_country column
 * @method     ChildOutletAddress|null findOneByOutletPincode(string $outlet_pincode) Return the first ChildOutletAddress filtered by the outlet_pincode column
 * @method     ChildOutletAddress|null findOneByOutletId(int $outlet_id) Return the first ChildOutletAddress filtered by the outlet_id column
 * @method     ChildOutletAddress|null findOneByOutletGps(string $outlet_gps) Return the first ChildOutletAddress filtered by the outlet_gps column
 * @method     ChildOutletAddress|null findOneByCompanyId(int $company_id) Return the first ChildOutletAddress filtered by the company_id column
 * @method     ChildOutletAddress|null findOneByCreatedAt(string $created_at) Return the first ChildOutletAddress filtered by the created_at column
 * @method     ChildOutletAddress|null findOneByUpdatedAt(string $updated_at) Return the first ChildOutletAddress filtered by the updated_at column
 * @method     ChildOutletAddress|null findOneByAddressName(string $address_name) Return the first ChildOutletAddress filtered by the address_name column
 * @method     ChildOutletAddress|null findOneByItownid(int $itownid) Return the first ChildOutletAddress filtered by the itownid column
 *
 * @method     ChildOutletAddress requirePk($key, ?ConnectionInterface $con = null) Return the ChildOutletAddress by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletAddress requireOne(?ConnectionInterface $con = null) Return the first ChildOutletAddress matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOutletAddress requireOneByOutletAddressId(string $outlet_address_id) Return the first ChildOutletAddress filtered by the outlet_address_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletAddress requireOneByOutletAddress(string $outlet_address) Return the first ChildOutletAddress filtered by the outlet_address column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletAddress requireOneByOutletStreetName(string $outlet_street_name) Return the first ChildOutletAddress filtered by the outlet_street_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletAddress requireOneByOutletCity(string $outlet_city) Return the first ChildOutletAddress filtered by the outlet_city column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletAddress requireOneByOutletState(string $outlet_state) Return the first ChildOutletAddress filtered by the outlet_state column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletAddress requireOneByOutletCountry(string $outlet_country) Return the first ChildOutletAddress filtered by the outlet_country column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletAddress requireOneByOutletPincode(string $outlet_pincode) Return the first ChildOutletAddress filtered by the outlet_pincode column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletAddress requireOneByOutletId(int $outlet_id) Return the first ChildOutletAddress filtered by the outlet_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletAddress requireOneByOutletGps(string $outlet_gps) Return the first ChildOutletAddress filtered by the outlet_gps column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletAddress requireOneByCompanyId(int $company_id) Return the first ChildOutletAddress filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletAddress requireOneByCreatedAt(string $created_at) Return the first ChildOutletAddress filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletAddress requireOneByUpdatedAt(string $updated_at) Return the first ChildOutletAddress filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletAddress requireOneByAddressName(string $address_name) Return the first ChildOutletAddress filtered by the address_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletAddress requireOneByItownid(int $itownid) Return the first ChildOutletAddress filtered by the itownid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOutletAddress[]|Collection find(?ConnectionInterface $con = null) Return ChildOutletAddress objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildOutletAddress> find(?ConnectionInterface $con = null) Return ChildOutletAddress objects based on current ModelCriteria
 *
 * @method     ChildOutletAddress[]|Collection findByOutletAddressId(string|array<string> $outlet_address_id) Return ChildOutletAddress objects filtered by the outlet_address_id column
 * @psalm-method Collection&\Traversable<ChildOutletAddress> findByOutletAddressId(string|array<string> $outlet_address_id) Return ChildOutletAddress objects filtered by the outlet_address_id column
 * @method     ChildOutletAddress[]|Collection findByOutletAddress(string|array<string> $outlet_address) Return ChildOutletAddress objects filtered by the outlet_address column
 * @psalm-method Collection&\Traversable<ChildOutletAddress> findByOutletAddress(string|array<string> $outlet_address) Return ChildOutletAddress objects filtered by the outlet_address column
 * @method     ChildOutletAddress[]|Collection findByOutletStreetName(string|array<string> $outlet_street_name) Return ChildOutletAddress objects filtered by the outlet_street_name column
 * @psalm-method Collection&\Traversable<ChildOutletAddress> findByOutletStreetName(string|array<string> $outlet_street_name) Return ChildOutletAddress objects filtered by the outlet_street_name column
 * @method     ChildOutletAddress[]|Collection findByOutletCity(string|array<string> $outlet_city) Return ChildOutletAddress objects filtered by the outlet_city column
 * @psalm-method Collection&\Traversable<ChildOutletAddress> findByOutletCity(string|array<string> $outlet_city) Return ChildOutletAddress objects filtered by the outlet_city column
 * @method     ChildOutletAddress[]|Collection findByOutletState(string|array<string> $outlet_state) Return ChildOutletAddress objects filtered by the outlet_state column
 * @psalm-method Collection&\Traversable<ChildOutletAddress> findByOutletState(string|array<string> $outlet_state) Return ChildOutletAddress objects filtered by the outlet_state column
 * @method     ChildOutletAddress[]|Collection findByOutletCountry(string|array<string> $outlet_country) Return ChildOutletAddress objects filtered by the outlet_country column
 * @psalm-method Collection&\Traversable<ChildOutletAddress> findByOutletCountry(string|array<string> $outlet_country) Return ChildOutletAddress objects filtered by the outlet_country column
 * @method     ChildOutletAddress[]|Collection findByOutletPincode(string|array<string> $outlet_pincode) Return ChildOutletAddress objects filtered by the outlet_pincode column
 * @psalm-method Collection&\Traversable<ChildOutletAddress> findByOutletPincode(string|array<string> $outlet_pincode) Return ChildOutletAddress objects filtered by the outlet_pincode column
 * @method     ChildOutletAddress[]|Collection findByOutletId(int|array<int> $outlet_id) Return ChildOutletAddress objects filtered by the outlet_id column
 * @psalm-method Collection&\Traversable<ChildOutletAddress> findByOutletId(int|array<int> $outlet_id) Return ChildOutletAddress objects filtered by the outlet_id column
 * @method     ChildOutletAddress[]|Collection findByOutletGps(string|array<string> $outlet_gps) Return ChildOutletAddress objects filtered by the outlet_gps column
 * @psalm-method Collection&\Traversable<ChildOutletAddress> findByOutletGps(string|array<string> $outlet_gps) Return ChildOutletAddress objects filtered by the outlet_gps column
 * @method     ChildOutletAddress[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildOutletAddress objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildOutletAddress> findByCompanyId(int|array<int> $company_id) Return ChildOutletAddress objects filtered by the company_id column
 * @method     ChildOutletAddress[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildOutletAddress objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildOutletAddress> findByCreatedAt(string|array<string> $created_at) Return ChildOutletAddress objects filtered by the created_at column
 * @method     ChildOutletAddress[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildOutletAddress objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildOutletAddress> findByUpdatedAt(string|array<string> $updated_at) Return ChildOutletAddress objects filtered by the updated_at column
 * @method     ChildOutletAddress[]|Collection findByAddressName(string|array<string> $address_name) Return ChildOutletAddress objects filtered by the address_name column
 * @psalm-method Collection&\Traversable<ChildOutletAddress> findByAddressName(string|array<string> $address_name) Return ChildOutletAddress objects filtered by the address_name column
 * @method     ChildOutletAddress[]|Collection findByItownid(int|array<int> $itownid) Return ChildOutletAddress objects filtered by the itownid column
 * @psalm-method Collection&\Traversable<ChildOutletAddress> findByItownid(int|array<int> $itownid) Return ChildOutletAddress objects filtered by the itownid column
 *
 * @method     ChildOutletAddress[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildOutletAddress> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class OutletAddressQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\OutletAddressQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\OutletAddress', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildOutletAddressQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildOutletAddressQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildOutletAddressQuery) {
            return $criteria;
        }
        $query = new ChildOutletAddressQuery();
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
     * @return ChildOutletAddress|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(OutletAddressTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = OutletAddressTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildOutletAddress A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT outlet_address_id, outlet_address, outlet_street_name, outlet_city, outlet_state, outlet_country, outlet_pincode, outlet_id, outlet_gps, company_id, created_at, updated_at, address_name, itownid FROM outlet_address WHERE outlet_address_id = :p0';
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
            /** @var ChildOutletAddress $obj */
            $obj = new ChildOutletAddress();
            $obj->hydrate($row);
            OutletAddressTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildOutletAddress|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(OutletAddressTableMap::COL_OUTLET_ADDRESS_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(OutletAddressTableMap::COL_OUTLET_ADDRESS_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(OutletAddressTableMap::COL_OUTLET_ADDRESS_ID, $outletAddressId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outletAddressId['max'])) {
                $this->addUsingAlias(OutletAddressTableMap::COL_OUTLET_ADDRESS_ID, $outletAddressId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletAddressTableMap::COL_OUTLET_ADDRESS_ID, $outletAddressId, $comparison);

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

        $this->addUsingAlias(OutletAddressTableMap::COL_OUTLET_ADDRESS, $outletAddress, $comparison);

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

        $this->addUsingAlias(OutletAddressTableMap::COL_OUTLET_STREET_NAME, $outletStreetName, $comparison);

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

        $this->addUsingAlias(OutletAddressTableMap::COL_OUTLET_CITY, $outletCity, $comparison);

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

        $this->addUsingAlias(OutletAddressTableMap::COL_OUTLET_STATE, $outletState, $comparison);

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

        $this->addUsingAlias(OutletAddressTableMap::COL_OUTLET_COUNTRY, $outletCountry, $comparison);

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

        $this->addUsingAlias(OutletAddressTableMap::COL_OUTLET_PINCODE, $outletPincode, $comparison);

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
     * @see       filterByOutlets()
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
                $this->addUsingAlias(OutletAddressTableMap::COL_OUTLET_ID, $outletId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outletId['max'])) {
                $this->addUsingAlias(OutletAddressTableMap::COL_OUTLET_ID, $outletId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletAddressTableMap::COL_OUTLET_ID, $outletId, $comparison);

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

        $this->addUsingAlias(OutletAddressTableMap::COL_OUTLET_GPS, $outletGps, $comparison);

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
                $this->addUsingAlias(OutletAddressTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(OutletAddressTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletAddressTableMap::COL_COMPANY_ID, $companyId, $comparison);

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
                $this->addUsingAlias(OutletAddressTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(OutletAddressTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletAddressTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(OutletAddressTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(OutletAddressTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletAddressTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

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

        $this->addUsingAlias(OutletAddressTableMap::COL_ADDRESS_NAME, $addressName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the itownid column
     *
     * Example usage:
     * <code>
     * $query->filterByItownid(1234); // WHERE itownid = 1234
     * $query->filterByItownid(array(12, 34)); // WHERE itownid IN (12, 34)
     * $query->filterByItownid(array('min' => 12)); // WHERE itownid > 12
     * </code>
     *
     * @see       filterByGeoTowns()
     *
     * @param mixed $itownid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByItownid($itownid = null, ?string $comparison = null)
    {
        if (is_array($itownid)) {
            $useMinMax = false;
            if (isset($itownid['min'])) {
                $this->addUsingAlias(OutletAddressTableMap::COL_ITOWNID, $itownid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($itownid['max'])) {
                $this->addUsingAlias(OutletAddressTableMap::COL_ITOWNID, $itownid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletAddressTableMap::COL_ITOWNID, $itownid, $comparison);

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
                ->addUsingAlias(OutletAddressTableMap::COL_COMPANY_ID, $company->getCompanyId(), $comparison);
        } elseif ($company instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(OutletAddressTableMap::COL_COMPANY_ID, $company->toKeyValue('PrimaryKey', 'CompanyId'), $comparison);

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
     * Filter the query by a related \entities\Outlets object
     *
     * @param \entities\Outlets|ObjectCollection $outlets The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutlets($outlets, ?string $comparison = null)
    {
        if ($outlets instanceof \entities\Outlets) {
            return $this
                ->addUsingAlias(OutletAddressTableMap::COL_OUTLET_ID, $outlets->getId(), $comparison);
        } elseif ($outlets instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(OutletAddressTableMap::COL_OUTLET_ID, $outlets->toKeyValue('PrimaryKey', 'Id'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByOutlets() only accepts arguments of type \entities\Outlets or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Outlets relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOutlets(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Outlets');

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
            $this->addJoinObject($join, 'Outlets');
        }

        return $this;
    }

    /**
     * Use the Outlets relation Outlets object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\OutletsQuery A secondary query class using the current class as primary query
     */
    public function useOutletsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinOutlets($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Outlets', '\entities\OutletsQuery');
    }

    /**
     * Use the Outlets relation Outlets object
     *
     * @param callable(\entities\OutletsQuery):\entities\OutletsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOutletsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useOutletsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Outlets table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\OutletsQuery The inner query object of the EXISTS statement
     */
    public function useOutletsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\OutletsQuery */
        $q = $this->useExistsQuery('Outlets', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Outlets table for a NOT EXISTS query.
     *
     * @see useOutletsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\OutletsQuery The inner query object of the NOT EXISTS statement
     */
    public function useOutletsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OutletsQuery */
        $q = $this->useExistsQuery('Outlets', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Outlets table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\OutletsQuery The inner query object of the IN statement
     */
    public function useInOutletsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\OutletsQuery */
        $q = $this->useInQuery('Outlets', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Outlets table for a NOT IN query.
     *
     * @see useOutletsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\OutletsQuery The inner query object of the NOT IN statement
     */
    public function useNotInOutletsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OutletsQuery */
        $q = $this->useInQuery('Outlets', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\GeoTowns object
     *
     * @param \entities\GeoTowns|ObjectCollection $geoTowns The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByGeoTowns($geoTowns, ?string $comparison = null)
    {
        if ($geoTowns instanceof \entities\GeoTowns) {
            return $this
                ->addUsingAlias(OutletAddressTableMap::COL_ITOWNID, $geoTowns->getItownid(), $comparison);
        } elseif ($geoTowns instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(OutletAddressTableMap::COL_ITOWNID, $geoTowns->toKeyValue('PrimaryKey', 'Itownid'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByGeoTowns() only accepts arguments of type \entities\GeoTowns or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the GeoTowns relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinGeoTowns(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('GeoTowns');

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
            $this->addJoinObject($join, 'GeoTowns');
        }

        return $this;
    }

    /**
     * Use the GeoTowns relation GeoTowns object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\GeoTownsQuery A secondary query class using the current class as primary query
     */
    public function useGeoTownsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinGeoTowns($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'GeoTowns', '\entities\GeoTownsQuery');
    }

    /**
     * Use the GeoTowns relation GeoTowns object
     *
     * @param callable(\entities\GeoTownsQuery):\entities\GeoTownsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withGeoTownsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useGeoTownsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to GeoTowns table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\GeoTownsQuery The inner query object of the EXISTS statement
     */
    public function useGeoTownsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\GeoTownsQuery */
        $q = $this->useExistsQuery('GeoTowns', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to GeoTowns table for a NOT EXISTS query.
     *
     * @see useGeoTownsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\GeoTownsQuery The inner query object of the NOT EXISTS statement
     */
    public function useGeoTownsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\GeoTownsQuery */
        $q = $this->useExistsQuery('GeoTowns', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to GeoTowns table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\GeoTownsQuery The inner query object of the IN statement
     */
    public function useInGeoTownsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\GeoTownsQuery */
        $q = $this->useInQuery('GeoTowns', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to GeoTowns table for a NOT IN query.
     *
     * @see useGeoTownsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\GeoTownsQuery The inner query object of the NOT IN statement
     */
    public function useNotInGeoTownsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\GeoTownsQuery */
        $q = $this->useInQuery('GeoTowns', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\OnBoardRequestAddress object
     *
     * @param \entities\OnBoardRequestAddress|ObjectCollection $onBoardRequestAddress the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOnBoardRequestAddress($onBoardRequestAddress, ?string $comparison = null)
    {
        if ($onBoardRequestAddress instanceof \entities\OnBoardRequestAddress) {
            $this
                ->addUsingAlias(OutletAddressTableMap::COL_OUTLET_ADDRESS_ID, $onBoardRequestAddress->getAddressId(), $comparison);

            return $this;
        } elseif ($onBoardRequestAddress instanceof ObjectCollection) {
            $this
                ->useOnBoardRequestAddressQuery()
                ->filterByPrimaryKeys($onBoardRequestAddress->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByOnBoardRequestAddress() only accepts arguments of type \entities\OnBoardRequestAddress or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OnBoardRequestAddress relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOnBoardRequestAddress(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OnBoardRequestAddress');

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
            $this->addJoinObject($join, 'OnBoardRequestAddress');
        }

        return $this;
    }

    /**
     * Use the OnBoardRequestAddress relation OnBoardRequestAddress object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\OnBoardRequestAddressQuery A secondary query class using the current class as primary query
     */
    public function useOnBoardRequestAddressQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinOnBoardRequestAddress($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OnBoardRequestAddress', '\entities\OnBoardRequestAddressQuery');
    }

    /**
     * Use the OnBoardRequestAddress relation OnBoardRequestAddress object
     *
     * @param callable(\entities\OnBoardRequestAddressQuery):\entities\OnBoardRequestAddressQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOnBoardRequestAddressQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useOnBoardRequestAddressQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to OnBoardRequestAddress table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\OnBoardRequestAddressQuery The inner query object of the EXISTS statement
     */
    public function useOnBoardRequestAddressExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\OnBoardRequestAddressQuery */
        $q = $this->useExistsQuery('OnBoardRequestAddress', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to OnBoardRequestAddress table for a NOT EXISTS query.
     *
     * @see useOnBoardRequestAddressExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\OnBoardRequestAddressQuery The inner query object of the NOT EXISTS statement
     */
    public function useOnBoardRequestAddressNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OnBoardRequestAddressQuery */
        $q = $this->useExistsQuery('OnBoardRequestAddress', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to OnBoardRequestAddress table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\OnBoardRequestAddressQuery The inner query object of the IN statement
     */
    public function useInOnBoardRequestAddressQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\OnBoardRequestAddressQuery */
        $q = $this->useInQuery('OnBoardRequestAddress', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to OnBoardRequestAddress table for a NOT IN query.
     *
     * @see useOnBoardRequestAddressInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\OnBoardRequestAddressQuery The inner query object of the NOT IN statement
     */
    public function useNotInOnBoardRequestAddressQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OnBoardRequestAddressQuery */
        $q = $this->useInQuery('OnBoardRequestAddress', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\OutletOrgData object
     *
     * @param \entities\OutletOrgData|ObjectCollection $outletOrgData the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletOrgData($outletOrgData, ?string $comparison = null)
    {
        if ($outletOrgData instanceof \entities\OutletOrgData) {
            $this
                ->addUsingAlias(OutletAddressTableMap::COL_OUTLET_ADDRESS_ID, $outletOrgData->getDefaultAddress(), $comparison);

            return $this;
        } elseif ($outletOrgData instanceof ObjectCollection) {
            $this
                ->useOutletOrgDataQuery()
                ->filterByPrimaryKeys($outletOrgData->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByOutletOrgData() only accepts arguments of type \entities\OutletOrgData or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OutletOrgData relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOutletOrgData(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OutletOrgData');

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
            $this->addJoinObject($join, 'OutletOrgData');
        }

        return $this;
    }

    /**
     * Use the OutletOrgData relation OutletOrgData object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\OutletOrgDataQuery A secondary query class using the current class as primary query
     */
    public function useOutletOrgDataQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinOutletOrgData($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OutletOrgData', '\entities\OutletOrgDataQuery');
    }

    /**
     * Use the OutletOrgData relation OutletOrgData object
     *
     * @param callable(\entities\OutletOrgDataQuery):\entities\OutletOrgDataQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOutletOrgDataQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useOutletOrgDataQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to OutletOrgData table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\OutletOrgDataQuery The inner query object of the EXISTS statement
     */
    public function useOutletOrgDataExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\OutletOrgDataQuery */
        $q = $this->useExistsQuery('OutletOrgData', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to OutletOrgData table for a NOT EXISTS query.
     *
     * @see useOutletOrgDataExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\OutletOrgDataQuery The inner query object of the NOT EXISTS statement
     */
    public function useOutletOrgDataNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OutletOrgDataQuery */
        $q = $this->useExistsQuery('OutletOrgData', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to OutletOrgData table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\OutletOrgDataQuery The inner query object of the IN statement
     */
    public function useInOutletOrgDataQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\OutletOrgDataQuery */
        $q = $this->useInQuery('OutletOrgData', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to OutletOrgData table for a NOT IN query.
     *
     * @see useOutletOrgDataInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\OutletOrgDataQuery The inner query object of the NOT IN statement
     */
    public function useNotInOutletOrgDataQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OutletOrgDataQuery */
        $q = $this->useInQuery('OutletOrgData', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildOutletAddress $outletAddress Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($outletAddress = null)
    {
        if ($outletAddress) {
            $this->addUsingAlias(OutletAddressTableMap::COL_OUTLET_ADDRESS_ID, $outletAddress->getOutletAddressId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the outlet_address table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OutletAddressTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            OutletAddressTableMap::clearInstancePool();
            OutletAddressTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(OutletAddressTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(OutletAddressTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            OutletAddressTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            OutletAddressTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
