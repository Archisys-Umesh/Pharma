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
use entities\BrandRcpa as ChildBrandRcpa;
use entities\BrandRcpaQuery as ChildBrandRcpaQuery;
use entities\Map\BrandRcpaTableMap;

/**
 * Base class that represents a query for the `brand_rcpa` table.
 *
 * @method     ChildBrandRcpaQuery orderByBrcpaId($order = Criteria::ASC) Order by the brcpa_id column
 * @method     ChildBrandRcpaQuery orderByOutletId($order = Criteria::ASC) Order by the outlet_id column
 * @method     ChildBrandRcpaQuery orderByRetailOutletId($order = Criteria::ASC) Order by the retail_outlet_id column
 * @method     ChildBrandRcpaQuery orderByEmployeeId($order = Criteria::ASC) Order by the employee_id column
 * @method     ChildBrandRcpaQuery orderByRcpaValue($order = Criteria::ASC) Order by the rcpa_value column
 * @method     ChildBrandRcpaQuery orderByBrandId($order = Criteria::ASC) Order by the brand_id column
 * @method     ChildBrandRcpaQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildBrandRcpaQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildBrandRcpaQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildBrandRcpaQuery orderByRcpaMoye($order = Criteria::ASC) Order by the rcpa_moye column
 * @method     ChildBrandRcpaQuery orderByCompetitorId($order = Criteria::ASC) Order by the competitor_id column
 * @method     ChildBrandRcpaQuery orderByRefName($order = Criteria::ASC) Order by the ref_name column
 * @method     ChildBrandRcpaQuery orderByProductId($order = Criteria::ASC) Order by the product_id column
 * @method     ChildBrandRcpaQuery orderByBrandRcpaLatLong($order = Criteria::ASC) Order by the brand_rcpa_lat_long column
 * @method     ChildBrandRcpaQuery orderByBrandRcpaAddress($order = Criteria::ASC) Order by the brand_rcpa_address column
 *
 * @method     ChildBrandRcpaQuery groupByBrcpaId() Group by the brcpa_id column
 * @method     ChildBrandRcpaQuery groupByOutletId() Group by the outlet_id column
 * @method     ChildBrandRcpaQuery groupByRetailOutletId() Group by the retail_outlet_id column
 * @method     ChildBrandRcpaQuery groupByEmployeeId() Group by the employee_id column
 * @method     ChildBrandRcpaQuery groupByRcpaValue() Group by the rcpa_value column
 * @method     ChildBrandRcpaQuery groupByBrandId() Group by the brand_id column
 * @method     ChildBrandRcpaQuery groupByCompanyId() Group by the company_id column
 * @method     ChildBrandRcpaQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildBrandRcpaQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildBrandRcpaQuery groupByRcpaMoye() Group by the rcpa_moye column
 * @method     ChildBrandRcpaQuery groupByCompetitorId() Group by the competitor_id column
 * @method     ChildBrandRcpaQuery groupByRefName() Group by the ref_name column
 * @method     ChildBrandRcpaQuery groupByProductId() Group by the product_id column
 * @method     ChildBrandRcpaQuery groupByBrandRcpaLatLong() Group by the brand_rcpa_lat_long column
 * @method     ChildBrandRcpaQuery groupByBrandRcpaAddress() Group by the brand_rcpa_address column
 *
 * @method     ChildBrandRcpaQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildBrandRcpaQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildBrandRcpaQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildBrandRcpaQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildBrandRcpaQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildBrandRcpaQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildBrandRcpaQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildBrandRcpaQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildBrandRcpaQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildBrandRcpaQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildBrandRcpaQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildBrandRcpaQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildBrandRcpaQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     ChildBrandRcpaQuery leftJoinBrands($relationAlias = null) Adds a LEFT JOIN clause to the query using the Brands relation
 * @method     ChildBrandRcpaQuery rightJoinBrands($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Brands relation
 * @method     ChildBrandRcpaQuery innerJoinBrands($relationAlias = null) Adds a INNER JOIN clause to the query using the Brands relation
 *
 * @method     ChildBrandRcpaQuery joinWithBrands($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Brands relation
 *
 * @method     ChildBrandRcpaQuery leftJoinWithBrands() Adds a LEFT JOIN clause and with to the query using the Brands relation
 * @method     ChildBrandRcpaQuery rightJoinWithBrands() Adds a RIGHT JOIN clause and with to the query using the Brands relation
 * @method     ChildBrandRcpaQuery innerJoinWithBrands() Adds a INNER JOIN clause and with to the query using the Brands relation
 *
 * @method     ChildBrandRcpaQuery leftJoinEmployee($relationAlias = null) Adds a LEFT JOIN clause to the query using the Employee relation
 * @method     ChildBrandRcpaQuery rightJoinEmployee($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Employee relation
 * @method     ChildBrandRcpaQuery innerJoinEmployee($relationAlias = null) Adds a INNER JOIN clause to the query using the Employee relation
 *
 * @method     ChildBrandRcpaQuery joinWithEmployee($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Employee relation
 *
 * @method     ChildBrandRcpaQuery leftJoinWithEmployee() Adds a LEFT JOIN clause and with to the query using the Employee relation
 * @method     ChildBrandRcpaQuery rightJoinWithEmployee() Adds a RIGHT JOIN clause and with to the query using the Employee relation
 * @method     ChildBrandRcpaQuery innerJoinWithEmployee() Adds a INNER JOIN clause and with to the query using the Employee relation
 *
 * @method     ChildBrandRcpaQuery leftJoinOutlets($relationAlias = null) Adds a LEFT JOIN clause to the query using the Outlets relation
 * @method     ChildBrandRcpaQuery rightJoinOutlets($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Outlets relation
 * @method     ChildBrandRcpaQuery innerJoinOutlets($relationAlias = null) Adds a INNER JOIN clause to the query using the Outlets relation
 *
 * @method     ChildBrandRcpaQuery joinWithOutlets($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Outlets relation
 *
 * @method     ChildBrandRcpaQuery leftJoinWithOutlets() Adds a LEFT JOIN clause and with to the query using the Outlets relation
 * @method     ChildBrandRcpaQuery rightJoinWithOutlets() Adds a RIGHT JOIN clause and with to the query using the Outlets relation
 * @method     ChildBrandRcpaQuery innerJoinWithOutlets() Adds a INNER JOIN clause and with to the query using the Outlets relation
 *
 * @method     \entities\CompanyQuery|\entities\BrandsQuery|\entities\EmployeeQuery|\entities\OutletsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildBrandRcpa|null findOne(?ConnectionInterface $con = null) Return the first ChildBrandRcpa matching the query
 * @method     ChildBrandRcpa findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildBrandRcpa matching the query, or a new ChildBrandRcpa object populated from the query conditions when no match is found
 *
 * @method     ChildBrandRcpa|null findOneByBrcpaId(int $brcpa_id) Return the first ChildBrandRcpa filtered by the brcpa_id column
 * @method     ChildBrandRcpa|null findOneByOutletId(int $outlet_id) Return the first ChildBrandRcpa filtered by the outlet_id column
 * @method     ChildBrandRcpa|null findOneByRetailOutletId(int $retail_outlet_id) Return the first ChildBrandRcpa filtered by the retail_outlet_id column
 * @method     ChildBrandRcpa|null findOneByEmployeeId(int $employee_id) Return the first ChildBrandRcpa filtered by the employee_id column
 * @method     ChildBrandRcpa|null findOneByRcpaValue(string $rcpa_value) Return the first ChildBrandRcpa filtered by the rcpa_value column
 * @method     ChildBrandRcpa|null findOneByBrandId(int $brand_id) Return the first ChildBrandRcpa filtered by the brand_id column
 * @method     ChildBrandRcpa|null findOneByCompanyId(int $company_id) Return the first ChildBrandRcpa filtered by the company_id column
 * @method     ChildBrandRcpa|null findOneByCreatedAt(string $created_at) Return the first ChildBrandRcpa filtered by the created_at column
 * @method     ChildBrandRcpa|null findOneByUpdatedAt(string $updated_at) Return the first ChildBrandRcpa filtered by the updated_at column
 * @method     ChildBrandRcpa|null findOneByRcpaMoye(string $rcpa_moye) Return the first ChildBrandRcpa filtered by the rcpa_moye column
 * @method     ChildBrandRcpa|null findOneByCompetitorId(int $competitor_id) Return the first ChildBrandRcpa filtered by the competitor_id column
 * @method     ChildBrandRcpa|null findOneByRefName(string $ref_name) Return the first ChildBrandRcpa filtered by the ref_name column
 * @method     ChildBrandRcpa|null findOneByProductId(int $product_id) Return the first ChildBrandRcpa filtered by the product_id column
 * @method     ChildBrandRcpa|null findOneByBrandRcpaLatLong(string $brand_rcpa_lat_long) Return the first ChildBrandRcpa filtered by the brand_rcpa_lat_long column
 * @method     ChildBrandRcpa|null findOneByBrandRcpaAddress(string $brand_rcpa_address) Return the first ChildBrandRcpa filtered by the brand_rcpa_address column
 *
 * @method     ChildBrandRcpa requirePk($key, ?ConnectionInterface $con = null) Return the ChildBrandRcpa by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandRcpa requireOne(?ConnectionInterface $con = null) Return the first ChildBrandRcpa matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBrandRcpa requireOneByBrcpaId(int $brcpa_id) Return the first ChildBrandRcpa filtered by the brcpa_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandRcpa requireOneByOutletId(int $outlet_id) Return the first ChildBrandRcpa filtered by the outlet_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandRcpa requireOneByRetailOutletId(int $retail_outlet_id) Return the first ChildBrandRcpa filtered by the retail_outlet_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandRcpa requireOneByEmployeeId(int $employee_id) Return the first ChildBrandRcpa filtered by the employee_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandRcpa requireOneByRcpaValue(string $rcpa_value) Return the first ChildBrandRcpa filtered by the rcpa_value column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandRcpa requireOneByBrandId(int $brand_id) Return the first ChildBrandRcpa filtered by the brand_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandRcpa requireOneByCompanyId(int $company_id) Return the first ChildBrandRcpa filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandRcpa requireOneByCreatedAt(string $created_at) Return the first ChildBrandRcpa filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandRcpa requireOneByUpdatedAt(string $updated_at) Return the first ChildBrandRcpa filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandRcpa requireOneByRcpaMoye(string $rcpa_moye) Return the first ChildBrandRcpa filtered by the rcpa_moye column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandRcpa requireOneByCompetitorId(int $competitor_id) Return the first ChildBrandRcpa filtered by the competitor_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandRcpa requireOneByRefName(string $ref_name) Return the first ChildBrandRcpa filtered by the ref_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandRcpa requireOneByProductId(int $product_id) Return the first ChildBrandRcpa filtered by the product_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandRcpa requireOneByBrandRcpaLatLong(string $brand_rcpa_lat_long) Return the first ChildBrandRcpa filtered by the brand_rcpa_lat_long column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandRcpa requireOneByBrandRcpaAddress(string $brand_rcpa_address) Return the first ChildBrandRcpa filtered by the brand_rcpa_address column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBrandRcpa[]|Collection find(?ConnectionInterface $con = null) Return ChildBrandRcpa objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildBrandRcpa> find(?ConnectionInterface $con = null) Return ChildBrandRcpa objects based on current ModelCriteria
 *
 * @method     ChildBrandRcpa[]|Collection findByBrcpaId(int|array<int> $brcpa_id) Return ChildBrandRcpa objects filtered by the brcpa_id column
 * @psalm-method Collection&\Traversable<ChildBrandRcpa> findByBrcpaId(int|array<int> $brcpa_id) Return ChildBrandRcpa objects filtered by the brcpa_id column
 * @method     ChildBrandRcpa[]|Collection findByOutletId(int|array<int> $outlet_id) Return ChildBrandRcpa objects filtered by the outlet_id column
 * @psalm-method Collection&\Traversable<ChildBrandRcpa> findByOutletId(int|array<int> $outlet_id) Return ChildBrandRcpa objects filtered by the outlet_id column
 * @method     ChildBrandRcpa[]|Collection findByRetailOutletId(int|array<int> $retail_outlet_id) Return ChildBrandRcpa objects filtered by the retail_outlet_id column
 * @psalm-method Collection&\Traversable<ChildBrandRcpa> findByRetailOutletId(int|array<int> $retail_outlet_id) Return ChildBrandRcpa objects filtered by the retail_outlet_id column
 * @method     ChildBrandRcpa[]|Collection findByEmployeeId(int|array<int> $employee_id) Return ChildBrandRcpa objects filtered by the employee_id column
 * @psalm-method Collection&\Traversable<ChildBrandRcpa> findByEmployeeId(int|array<int> $employee_id) Return ChildBrandRcpa objects filtered by the employee_id column
 * @method     ChildBrandRcpa[]|Collection findByRcpaValue(string|array<string> $rcpa_value) Return ChildBrandRcpa objects filtered by the rcpa_value column
 * @psalm-method Collection&\Traversable<ChildBrandRcpa> findByRcpaValue(string|array<string> $rcpa_value) Return ChildBrandRcpa objects filtered by the rcpa_value column
 * @method     ChildBrandRcpa[]|Collection findByBrandId(int|array<int> $brand_id) Return ChildBrandRcpa objects filtered by the brand_id column
 * @psalm-method Collection&\Traversable<ChildBrandRcpa> findByBrandId(int|array<int> $brand_id) Return ChildBrandRcpa objects filtered by the brand_id column
 * @method     ChildBrandRcpa[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildBrandRcpa objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildBrandRcpa> findByCompanyId(int|array<int> $company_id) Return ChildBrandRcpa objects filtered by the company_id column
 * @method     ChildBrandRcpa[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildBrandRcpa objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildBrandRcpa> findByCreatedAt(string|array<string> $created_at) Return ChildBrandRcpa objects filtered by the created_at column
 * @method     ChildBrandRcpa[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildBrandRcpa objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildBrandRcpa> findByUpdatedAt(string|array<string> $updated_at) Return ChildBrandRcpa objects filtered by the updated_at column
 * @method     ChildBrandRcpa[]|Collection findByRcpaMoye(string|array<string> $rcpa_moye) Return ChildBrandRcpa objects filtered by the rcpa_moye column
 * @psalm-method Collection&\Traversable<ChildBrandRcpa> findByRcpaMoye(string|array<string> $rcpa_moye) Return ChildBrandRcpa objects filtered by the rcpa_moye column
 * @method     ChildBrandRcpa[]|Collection findByCompetitorId(int|array<int> $competitor_id) Return ChildBrandRcpa objects filtered by the competitor_id column
 * @psalm-method Collection&\Traversable<ChildBrandRcpa> findByCompetitorId(int|array<int> $competitor_id) Return ChildBrandRcpa objects filtered by the competitor_id column
 * @method     ChildBrandRcpa[]|Collection findByRefName(string|array<string> $ref_name) Return ChildBrandRcpa objects filtered by the ref_name column
 * @psalm-method Collection&\Traversable<ChildBrandRcpa> findByRefName(string|array<string> $ref_name) Return ChildBrandRcpa objects filtered by the ref_name column
 * @method     ChildBrandRcpa[]|Collection findByProductId(int|array<int> $product_id) Return ChildBrandRcpa objects filtered by the product_id column
 * @psalm-method Collection&\Traversable<ChildBrandRcpa> findByProductId(int|array<int> $product_id) Return ChildBrandRcpa objects filtered by the product_id column
 * @method     ChildBrandRcpa[]|Collection findByBrandRcpaLatLong(string|array<string> $brand_rcpa_lat_long) Return ChildBrandRcpa objects filtered by the brand_rcpa_lat_long column
 * @psalm-method Collection&\Traversable<ChildBrandRcpa> findByBrandRcpaLatLong(string|array<string> $brand_rcpa_lat_long) Return ChildBrandRcpa objects filtered by the brand_rcpa_lat_long column
 * @method     ChildBrandRcpa[]|Collection findByBrandRcpaAddress(string|array<string> $brand_rcpa_address) Return ChildBrandRcpa objects filtered by the brand_rcpa_address column
 * @psalm-method Collection&\Traversable<ChildBrandRcpa> findByBrandRcpaAddress(string|array<string> $brand_rcpa_address) Return ChildBrandRcpa objects filtered by the brand_rcpa_address column
 *
 * @method     ChildBrandRcpa[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildBrandRcpa> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class BrandRcpaQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\BrandRcpaQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\BrandRcpa', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildBrandRcpaQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildBrandRcpaQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildBrandRcpaQuery) {
            return $criteria;
        }
        $query = new ChildBrandRcpaQuery();
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
     * @return ChildBrandRcpa|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(BrandRcpaTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = BrandRcpaTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildBrandRcpa A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT brcpa_id, outlet_id, retail_outlet_id, employee_id, rcpa_value, brand_id, company_id, created_at, updated_at, rcpa_moye, competitor_id, ref_name, product_id, brand_rcpa_lat_long, brand_rcpa_address FROM brand_rcpa WHERE brcpa_id = :p0';
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
            /** @var ChildBrandRcpa $obj */
            $obj = new ChildBrandRcpa();
            $obj->hydrate($row);
            BrandRcpaTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildBrandRcpa|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(BrandRcpaTableMap::COL_BRCPA_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(BrandRcpaTableMap::COL_BRCPA_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the brcpa_id column
     *
     * Example usage:
     * <code>
     * $query->filterByBrcpaId(1234); // WHERE brcpa_id = 1234
     * $query->filterByBrcpaId(array(12, 34)); // WHERE brcpa_id IN (12, 34)
     * $query->filterByBrcpaId(array('min' => 12)); // WHERE brcpa_id > 12
     * </code>
     *
     * @param mixed $brcpaId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBrcpaId($brcpaId = null, ?string $comparison = null)
    {
        if (is_array($brcpaId)) {
            $useMinMax = false;
            if (isset($brcpaId['min'])) {
                $this->addUsingAlias(BrandRcpaTableMap::COL_BRCPA_ID, $brcpaId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($brcpaId['max'])) {
                $this->addUsingAlias(BrandRcpaTableMap::COL_BRCPA_ID, $brcpaId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandRcpaTableMap::COL_BRCPA_ID, $brcpaId, $comparison);

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
                $this->addUsingAlias(BrandRcpaTableMap::COL_OUTLET_ID, $outletId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outletId['max'])) {
                $this->addUsingAlias(BrandRcpaTableMap::COL_OUTLET_ID, $outletId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandRcpaTableMap::COL_OUTLET_ID, $outletId, $comparison);

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
                $this->addUsingAlias(BrandRcpaTableMap::COL_RETAIL_OUTLET_ID, $retailOutletId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($retailOutletId['max'])) {
                $this->addUsingAlias(BrandRcpaTableMap::COL_RETAIL_OUTLET_ID, $retailOutletId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandRcpaTableMap::COL_RETAIL_OUTLET_ID, $retailOutletId, $comparison);

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
     * @see       filterByEmployee()
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
                $this->addUsingAlias(BrandRcpaTableMap::COL_EMPLOYEE_ID, $employeeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($employeeId['max'])) {
                $this->addUsingAlias(BrandRcpaTableMap::COL_EMPLOYEE_ID, $employeeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandRcpaTableMap::COL_EMPLOYEE_ID, $employeeId, $comparison);

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
                $this->addUsingAlias(BrandRcpaTableMap::COL_RCPA_VALUE, $rcpaValue['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($rcpaValue['max'])) {
                $this->addUsingAlias(BrandRcpaTableMap::COL_RCPA_VALUE, $rcpaValue['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandRcpaTableMap::COL_RCPA_VALUE, $rcpaValue, $comparison);

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
     * @see       filterByBrands()
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
                $this->addUsingAlias(BrandRcpaTableMap::COL_BRAND_ID, $brandId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($brandId['max'])) {
                $this->addUsingAlias(BrandRcpaTableMap::COL_BRAND_ID, $brandId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandRcpaTableMap::COL_BRAND_ID, $brandId, $comparison);

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
                $this->addUsingAlias(BrandRcpaTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(BrandRcpaTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandRcpaTableMap::COL_COMPANY_ID, $companyId, $comparison);

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
                $this->addUsingAlias(BrandRcpaTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(BrandRcpaTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandRcpaTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(BrandRcpaTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(BrandRcpaTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandRcpaTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

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

        $this->addUsingAlias(BrandRcpaTableMap::COL_RCPA_MOYE, $rcpaMoye, $comparison);

        return $this;
    }

    /**
     * Filter the query on the competitor_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCompetitorId(1234); // WHERE competitor_id = 1234
     * $query->filterByCompetitorId(array(12, 34)); // WHERE competitor_id IN (12, 34)
     * $query->filterByCompetitorId(array('min' => 12)); // WHERE competitor_id > 12
     * </code>
     *
     * @param mixed $competitorId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCompetitorId($competitorId = null, ?string $comparison = null)
    {
        if (is_array($competitorId)) {
            $useMinMax = false;
            if (isset($competitorId['min'])) {
                $this->addUsingAlias(BrandRcpaTableMap::COL_COMPETITOR_ID, $competitorId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($competitorId['max'])) {
                $this->addUsingAlias(BrandRcpaTableMap::COL_COMPETITOR_ID, $competitorId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandRcpaTableMap::COL_COMPETITOR_ID, $competitorId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the ref_name column
     *
     * Example usage:
     * <code>
     * $query->filterByRefName('fooValue');   // WHERE ref_name = 'fooValue'
     * $query->filterByRefName('%fooValue%', Criteria::LIKE); // WHERE ref_name LIKE '%fooValue%'
     * $query->filterByRefName(['foo', 'bar']); // WHERE ref_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $refName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRefName($refName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($refName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandRcpaTableMap::COL_REF_NAME, $refName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the product_id column
     *
     * Example usage:
     * <code>
     * $query->filterByProductId(1234); // WHERE product_id = 1234
     * $query->filterByProductId(array(12, 34)); // WHERE product_id IN (12, 34)
     * $query->filterByProductId(array('min' => 12)); // WHERE product_id > 12
     * </code>
     *
     * @param mixed $productId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProductId($productId = null, ?string $comparison = null)
    {
        if (is_array($productId)) {
            $useMinMax = false;
            if (isset($productId['min'])) {
                $this->addUsingAlias(BrandRcpaTableMap::COL_PRODUCT_ID, $productId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($productId['max'])) {
                $this->addUsingAlias(BrandRcpaTableMap::COL_PRODUCT_ID, $productId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandRcpaTableMap::COL_PRODUCT_ID, $productId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the brand_rcpa_lat_long column
     *
     * Example usage:
     * <code>
     * $query->filterByBrandRcpaLatLong('fooValue');   // WHERE brand_rcpa_lat_long = 'fooValue'
     * $query->filterByBrandRcpaLatLong('%fooValue%', Criteria::LIKE); // WHERE brand_rcpa_lat_long LIKE '%fooValue%'
     * $query->filterByBrandRcpaLatLong(['foo', 'bar']); // WHERE brand_rcpa_lat_long IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $brandRcpaLatLong The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBrandRcpaLatLong($brandRcpaLatLong = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($brandRcpaLatLong)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandRcpaTableMap::COL_BRAND_RCPA_LAT_LONG, $brandRcpaLatLong, $comparison);

        return $this;
    }

    /**
     * Filter the query on the brand_rcpa_address column
     *
     * Example usage:
     * <code>
     * $query->filterByBrandRcpaAddress('fooValue');   // WHERE brand_rcpa_address = 'fooValue'
     * $query->filterByBrandRcpaAddress('%fooValue%', Criteria::LIKE); // WHERE brand_rcpa_address LIKE '%fooValue%'
     * $query->filterByBrandRcpaAddress(['foo', 'bar']); // WHERE brand_rcpa_address IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $brandRcpaAddress The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBrandRcpaAddress($brandRcpaAddress = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($brandRcpaAddress)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandRcpaTableMap::COL_BRAND_RCPA_ADDRESS, $brandRcpaAddress, $comparison);

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
                ->addUsingAlias(BrandRcpaTableMap::COL_COMPANY_ID, $company->getCompanyId(), $comparison);
        } elseif ($company instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(BrandRcpaTableMap::COL_COMPANY_ID, $company->toKeyValue('PrimaryKey', 'CompanyId'), $comparison);

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
     * Filter the query by a related \entities\Brands object
     *
     * @param \entities\Brands|ObjectCollection $brands The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBrands($brands, ?string $comparison = null)
    {
        if ($brands instanceof \entities\Brands) {
            return $this
                ->addUsingAlias(BrandRcpaTableMap::COL_BRAND_ID, $brands->getBrandId(), $comparison);
        } elseif ($brands instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(BrandRcpaTableMap::COL_BRAND_ID, $brands->toKeyValue('PrimaryKey', 'BrandId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByBrands() only accepts arguments of type \entities\Brands or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Brands relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinBrands(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Brands');

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
            $this->addJoinObject($join, 'Brands');
        }

        return $this;
    }

    /**
     * Use the Brands relation Brands object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\BrandsQuery A secondary query class using the current class as primary query
     */
    public function useBrandsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinBrands($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Brands', '\entities\BrandsQuery');
    }

    /**
     * Use the Brands relation Brands object
     *
     * @param callable(\entities\BrandsQuery):\entities\BrandsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withBrandsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useBrandsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Brands table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\BrandsQuery The inner query object of the EXISTS statement
     */
    public function useBrandsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\BrandsQuery */
        $q = $this->useExistsQuery('Brands', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Brands table for a NOT EXISTS query.
     *
     * @see useBrandsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\BrandsQuery The inner query object of the NOT EXISTS statement
     */
    public function useBrandsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\BrandsQuery */
        $q = $this->useExistsQuery('Brands', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Brands table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\BrandsQuery The inner query object of the IN statement
     */
    public function useInBrandsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\BrandsQuery */
        $q = $this->useInQuery('Brands', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Brands table for a NOT IN query.
     *
     * @see useBrandsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\BrandsQuery The inner query object of the NOT IN statement
     */
    public function useNotInBrandsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\BrandsQuery */
        $q = $this->useInQuery('Brands', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(BrandRcpaTableMap::COL_EMPLOYEE_ID, $employee->getEmployeeId(), $comparison);
        } elseif ($employee instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(BrandRcpaTableMap::COL_EMPLOYEE_ID, $employee->toKeyValue('PrimaryKey', 'EmployeeId'), $comparison);

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
    public function joinEmployee(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
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
    public function useEmployeeQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
        ?string $joinType = Criteria::LEFT_JOIN
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
                ->addUsingAlias(BrandRcpaTableMap::COL_OUTLET_ID, $outlets->getId(), $comparison);
        } elseif ($outlets instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(BrandRcpaTableMap::COL_OUTLET_ID, $outlets->toKeyValue('PrimaryKey', 'Id'), $comparison);

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
     * Exclude object from result
     *
     * @param ChildBrandRcpa $brandRcpa Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($brandRcpa = null)
    {
        if ($brandRcpa) {
            $this->addUsingAlias(BrandRcpaTableMap::COL_BRCPA_ID, $brandRcpa->getBrcpaId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the brand_rcpa table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(BrandRcpaTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            BrandRcpaTableMap::clearInstancePool();
            BrandRcpaTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(BrandRcpaTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(BrandRcpaTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            BrandRcpaTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            BrandRcpaTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
