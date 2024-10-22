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
use entities\OutletStockSummary as ChildOutletStockSummary;
use entities\OutletStockSummaryQuery as ChildOutletStockSummaryQuery;
use entities\Map\OutletStockSummaryTableMap;

/**
 * Base class that represents a query for the `outlet_stock_summary` table.
 *
 * @method     ChildOutletStockSummaryQuery orderByOutletStockSummaryId($order = Criteria::ASC) Order by the outlet_stock_summary_id column
 * @method     ChildOutletStockSummaryQuery orderByOutletOrgId($order = Criteria::ASC) Order by the outlet_org_id column
 * @method     ChildOutletStockSummaryQuery orderByOutletId($order = Criteria::ASC) Order by the outlet_id column
 * @method     ChildOutletStockSummaryQuery orderByMoye($order = Criteria::ASC) Order by the moye column
 * @method     ChildOutletStockSummaryQuery orderByBrandId($order = Criteria::ASC) Order by the brand_id column
 * @method     ChildOutletStockSummaryQuery orderByProductId($order = Criteria::ASC) Order by the product_id column
 * @method     ChildOutletStockSummaryQuery orderByClosingQty($order = Criteria::ASC) Order by the closing_qty column
 * @method     ChildOutletStockSummaryQuery orderByComputedClosingQty($order = Criteria::ASC) Order by the computed_closing_qty column
 * @method     ChildOutletStockSummaryQuery orderByCompetitorId($order = Criteria::ASC) Order by the competitor_id column
 * @method     ChildOutletStockSummaryQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildOutletStockSummaryQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildOutletStockSummaryQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildOutletStockSummaryQuery orderByOrgunitid($order = Criteria::ASC) Order by the orgunitid column
 *
 * @method     ChildOutletStockSummaryQuery groupByOutletStockSummaryId() Group by the outlet_stock_summary_id column
 * @method     ChildOutletStockSummaryQuery groupByOutletOrgId() Group by the outlet_org_id column
 * @method     ChildOutletStockSummaryQuery groupByOutletId() Group by the outlet_id column
 * @method     ChildOutletStockSummaryQuery groupByMoye() Group by the moye column
 * @method     ChildOutletStockSummaryQuery groupByBrandId() Group by the brand_id column
 * @method     ChildOutletStockSummaryQuery groupByProductId() Group by the product_id column
 * @method     ChildOutletStockSummaryQuery groupByClosingQty() Group by the closing_qty column
 * @method     ChildOutletStockSummaryQuery groupByComputedClosingQty() Group by the computed_closing_qty column
 * @method     ChildOutletStockSummaryQuery groupByCompetitorId() Group by the competitor_id column
 * @method     ChildOutletStockSummaryQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildOutletStockSummaryQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildOutletStockSummaryQuery groupByCompanyId() Group by the company_id column
 * @method     ChildOutletStockSummaryQuery groupByOrgunitid() Group by the orgunitid column
 *
 * @method     ChildOutletStockSummaryQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildOutletStockSummaryQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildOutletStockSummaryQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildOutletStockSummaryQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildOutletStockSummaryQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildOutletStockSummaryQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildOutletStockSummaryQuery leftJoinBrands($relationAlias = null) Adds a LEFT JOIN clause to the query using the Brands relation
 * @method     ChildOutletStockSummaryQuery rightJoinBrands($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Brands relation
 * @method     ChildOutletStockSummaryQuery innerJoinBrands($relationAlias = null) Adds a INNER JOIN clause to the query using the Brands relation
 *
 * @method     ChildOutletStockSummaryQuery joinWithBrands($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Brands relation
 *
 * @method     ChildOutletStockSummaryQuery leftJoinWithBrands() Adds a LEFT JOIN clause and with to the query using the Brands relation
 * @method     ChildOutletStockSummaryQuery rightJoinWithBrands() Adds a RIGHT JOIN clause and with to the query using the Brands relation
 * @method     ChildOutletStockSummaryQuery innerJoinWithBrands() Adds a INNER JOIN clause and with to the query using the Brands relation
 *
 * @method     ChildOutletStockSummaryQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildOutletStockSummaryQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildOutletStockSummaryQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildOutletStockSummaryQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildOutletStockSummaryQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildOutletStockSummaryQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildOutletStockSummaryQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     ChildOutletStockSummaryQuery leftJoinOrgUnit($relationAlias = null) Adds a LEFT JOIN clause to the query using the OrgUnit relation
 * @method     ChildOutletStockSummaryQuery rightJoinOrgUnit($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OrgUnit relation
 * @method     ChildOutletStockSummaryQuery innerJoinOrgUnit($relationAlias = null) Adds a INNER JOIN clause to the query using the OrgUnit relation
 *
 * @method     ChildOutletStockSummaryQuery joinWithOrgUnit($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OrgUnit relation
 *
 * @method     ChildOutletStockSummaryQuery leftJoinWithOrgUnit() Adds a LEFT JOIN clause and with to the query using the OrgUnit relation
 * @method     ChildOutletStockSummaryQuery rightJoinWithOrgUnit() Adds a RIGHT JOIN clause and with to the query using the OrgUnit relation
 * @method     ChildOutletStockSummaryQuery innerJoinWithOrgUnit() Adds a INNER JOIN clause and with to the query using the OrgUnit relation
 *
 * @method     ChildOutletStockSummaryQuery leftJoinOutlets($relationAlias = null) Adds a LEFT JOIN clause to the query using the Outlets relation
 * @method     ChildOutletStockSummaryQuery rightJoinOutlets($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Outlets relation
 * @method     ChildOutletStockSummaryQuery innerJoinOutlets($relationAlias = null) Adds a INNER JOIN clause to the query using the Outlets relation
 *
 * @method     ChildOutletStockSummaryQuery joinWithOutlets($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Outlets relation
 *
 * @method     ChildOutletStockSummaryQuery leftJoinWithOutlets() Adds a LEFT JOIN clause and with to the query using the Outlets relation
 * @method     ChildOutletStockSummaryQuery rightJoinWithOutlets() Adds a RIGHT JOIN clause and with to the query using the Outlets relation
 * @method     ChildOutletStockSummaryQuery innerJoinWithOutlets() Adds a INNER JOIN clause and with to the query using the Outlets relation
 *
 * @method     ChildOutletStockSummaryQuery leftJoinOutletOrgData($relationAlias = null) Adds a LEFT JOIN clause to the query using the OutletOrgData relation
 * @method     ChildOutletStockSummaryQuery rightJoinOutletOrgData($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OutletOrgData relation
 * @method     ChildOutletStockSummaryQuery innerJoinOutletOrgData($relationAlias = null) Adds a INNER JOIN clause to the query using the OutletOrgData relation
 *
 * @method     ChildOutletStockSummaryQuery joinWithOutletOrgData($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OutletOrgData relation
 *
 * @method     ChildOutletStockSummaryQuery leftJoinWithOutletOrgData() Adds a LEFT JOIN clause and with to the query using the OutletOrgData relation
 * @method     ChildOutletStockSummaryQuery rightJoinWithOutletOrgData() Adds a RIGHT JOIN clause and with to the query using the OutletOrgData relation
 * @method     ChildOutletStockSummaryQuery innerJoinWithOutletOrgData() Adds a INNER JOIN clause and with to the query using the OutletOrgData relation
 *
 * @method     ChildOutletStockSummaryQuery leftJoinProducts($relationAlias = null) Adds a LEFT JOIN clause to the query using the Products relation
 * @method     ChildOutletStockSummaryQuery rightJoinProducts($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Products relation
 * @method     ChildOutletStockSummaryQuery innerJoinProducts($relationAlias = null) Adds a INNER JOIN clause to the query using the Products relation
 *
 * @method     ChildOutletStockSummaryQuery joinWithProducts($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Products relation
 *
 * @method     ChildOutletStockSummaryQuery leftJoinWithProducts() Adds a LEFT JOIN clause and with to the query using the Products relation
 * @method     ChildOutletStockSummaryQuery rightJoinWithProducts() Adds a RIGHT JOIN clause and with to the query using the Products relation
 * @method     ChildOutletStockSummaryQuery innerJoinWithProducts() Adds a INNER JOIN clause and with to the query using the Products relation
 *
 * @method     \entities\BrandsQuery|\entities\CompanyQuery|\entities\OrgUnitQuery|\entities\OutletsQuery|\entities\OutletOrgDataQuery|\entities\ProductsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildOutletStockSummary|null findOne(?ConnectionInterface $con = null) Return the first ChildOutletStockSummary matching the query
 * @method     ChildOutletStockSummary findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildOutletStockSummary matching the query, or a new ChildOutletStockSummary object populated from the query conditions when no match is found
 *
 * @method     ChildOutletStockSummary|null findOneByOutletStockSummaryId(int $outlet_stock_summary_id) Return the first ChildOutletStockSummary filtered by the outlet_stock_summary_id column
 * @method     ChildOutletStockSummary|null findOneByOutletOrgId(int $outlet_org_id) Return the first ChildOutletStockSummary filtered by the outlet_org_id column
 * @method     ChildOutletStockSummary|null findOneByOutletId(int $outlet_id) Return the first ChildOutletStockSummary filtered by the outlet_id column
 * @method     ChildOutletStockSummary|null findOneByMoye(string $moye) Return the first ChildOutletStockSummary filtered by the moye column
 * @method     ChildOutletStockSummary|null findOneByBrandId(int $brand_id) Return the first ChildOutletStockSummary filtered by the brand_id column
 * @method     ChildOutletStockSummary|null findOneByProductId(int $product_id) Return the first ChildOutletStockSummary filtered by the product_id column
 * @method     ChildOutletStockSummary|null findOneByClosingQty(int $closing_qty) Return the first ChildOutletStockSummary filtered by the closing_qty column
 * @method     ChildOutletStockSummary|null findOneByComputedClosingQty(int $computed_closing_qty) Return the first ChildOutletStockSummary filtered by the computed_closing_qty column
 * @method     ChildOutletStockSummary|null findOneByCompetitorId(int $competitor_id) Return the first ChildOutletStockSummary filtered by the competitor_id column
 * @method     ChildOutletStockSummary|null findOneByCreatedAt(string $created_at) Return the first ChildOutletStockSummary filtered by the created_at column
 * @method     ChildOutletStockSummary|null findOneByUpdatedAt(string $updated_at) Return the first ChildOutletStockSummary filtered by the updated_at column
 * @method     ChildOutletStockSummary|null findOneByCompanyId(int $company_id) Return the first ChildOutletStockSummary filtered by the company_id column
 * @method     ChildOutletStockSummary|null findOneByOrgunitid(int $orgunitid) Return the first ChildOutletStockSummary filtered by the orgunitid column
 *
 * @method     ChildOutletStockSummary requirePk($key, ?ConnectionInterface $con = null) Return the ChildOutletStockSummary by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletStockSummary requireOne(?ConnectionInterface $con = null) Return the first ChildOutletStockSummary matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOutletStockSummary requireOneByOutletStockSummaryId(int $outlet_stock_summary_id) Return the first ChildOutletStockSummary filtered by the outlet_stock_summary_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletStockSummary requireOneByOutletOrgId(int $outlet_org_id) Return the first ChildOutletStockSummary filtered by the outlet_org_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletStockSummary requireOneByOutletId(int $outlet_id) Return the first ChildOutletStockSummary filtered by the outlet_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletStockSummary requireOneByMoye(string $moye) Return the first ChildOutletStockSummary filtered by the moye column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletStockSummary requireOneByBrandId(int $brand_id) Return the first ChildOutletStockSummary filtered by the brand_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletStockSummary requireOneByProductId(int $product_id) Return the first ChildOutletStockSummary filtered by the product_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletStockSummary requireOneByClosingQty(int $closing_qty) Return the first ChildOutletStockSummary filtered by the closing_qty column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletStockSummary requireOneByComputedClosingQty(int $computed_closing_qty) Return the first ChildOutletStockSummary filtered by the computed_closing_qty column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletStockSummary requireOneByCompetitorId(int $competitor_id) Return the first ChildOutletStockSummary filtered by the competitor_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletStockSummary requireOneByCreatedAt(string $created_at) Return the first ChildOutletStockSummary filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletStockSummary requireOneByUpdatedAt(string $updated_at) Return the first ChildOutletStockSummary filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletStockSummary requireOneByCompanyId(int $company_id) Return the first ChildOutletStockSummary filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletStockSummary requireOneByOrgunitid(int $orgunitid) Return the first ChildOutletStockSummary filtered by the orgunitid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOutletStockSummary[]|Collection find(?ConnectionInterface $con = null) Return ChildOutletStockSummary objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildOutletStockSummary> find(?ConnectionInterface $con = null) Return ChildOutletStockSummary objects based on current ModelCriteria
 *
 * @method     ChildOutletStockSummary[]|Collection findByOutletStockSummaryId(int|array<int> $outlet_stock_summary_id) Return ChildOutletStockSummary objects filtered by the outlet_stock_summary_id column
 * @psalm-method Collection&\Traversable<ChildOutletStockSummary> findByOutletStockSummaryId(int|array<int> $outlet_stock_summary_id) Return ChildOutletStockSummary objects filtered by the outlet_stock_summary_id column
 * @method     ChildOutletStockSummary[]|Collection findByOutletOrgId(int|array<int> $outlet_org_id) Return ChildOutletStockSummary objects filtered by the outlet_org_id column
 * @psalm-method Collection&\Traversable<ChildOutletStockSummary> findByOutletOrgId(int|array<int> $outlet_org_id) Return ChildOutletStockSummary objects filtered by the outlet_org_id column
 * @method     ChildOutletStockSummary[]|Collection findByOutletId(int|array<int> $outlet_id) Return ChildOutletStockSummary objects filtered by the outlet_id column
 * @psalm-method Collection&\Traversable<ChildOutletStockSummary> findByOutletId(int|array<int> $outlet_id) Return ChildOutletStockSummary objects filtered by the outlet_id column
 * @method     ChildOutletStockSummary[]|Collection findByMoye(string|array<string> $moye) Return ChildOutletStockSummary objects filtered by the moye column
 * @psalm-method Collection&\Traversable<ChildOutletStockSummary> findByMoye(string|array<string> $moye) Return ChildOutletStockSummary objects filtered by the moye column
 * @method     ChildOutletStockSummary[]|Collection findByBrandId(int|array<int> $brand_id) Return ChildOutletStockSummary objects filtered by the brand_id column
 * @psalm-method Collection&\Traversable<ChildOutletStockSummary> findByBrandId(int|array<int> $brand_id) Return ChildOutletStockSummary objects filtered by the brand_id column
 * @method     ChildOutletStockSummary[]|Collection findByProductId(int|array<int> $product_id) Return ChildOutletStockSummary objects filtered by the product_id column
 * @psalm-method Collection&\Traversable<ChildOutletStockSummary> findByProductId(int|array<int> $product_id) Return ChildOutletStockSummary objects filtered by the product_id column
 * @method     ChildOutletStockSummary[]|Collection findByClosingQty(int|array<int> $closing_qty) Return ChildOutletStockSummary objects filtered by the closing_qty column
 * @psalm-method Collection&\Traversable<ChildOutletStockSummary> findByClosingQty(int|array<int> $closing_qty) Return ChildOutletStockSummary objects filtered by the closing_qty column
 * @method     ChildOutletStockSummary[]|Collection findByComputedClosingQty(int|array<int> $computed_closing_qty) Return ChildOutletStockSummary objects filtered by the computed_closing_qty column
 * @psalm-method Collection&\Traversable<ChildOutletStockSummary> findByComputedClosingQty(int|array<int> $computed_closing_qty) Return ChildOutletStockSummary objects filtered by the computed_closing_qty column
 * @method     ChildOutletStockSummary[]|Collection findByCompetitorId(int|array<int> $competitor_id) Return ChildOutletStockSummary objects filtered by the competitor_id column
 * @psalm-method Collection&\Traversable<ChildOutletStockSummary> findByCompetitorId(int|array<int> $competitor_id) Return ChildOutletStockSummary objects filtered by the competitor_id column
 * @method     ChildOutletStockSummary[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildOutletStockSummary objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildOutletStockSummary> findByCreatedAt(string|array<string> $created_at) Return ChildOutletStockSummary objects filtered by the created_at column
 * @method     ChildOutletStockSummary[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildOutletStockSummary objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildOutletStockSummary> findByUpdatedAt(string|array<string> $updated_at) Return ChildOutletStockSummary objects filtered by the updated_at column
 * @method     ChildOutletStockSummary[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildOutletStockSummary objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildOutletStockSummary> findByCompanyId(int|array<int> $company_id) Return ChildOutletStockSummary objects filtered by the company_id column
 * @method     ChildOutletStockSummary[]|Collection findByOrgunitid(int|array<int> $orgunitid) Return ChildOutletStockSummary objects filtered by the orgunitid column
 * @psalm-method Collection&\Traversable<ChildOutletStockSummary> findByOrgunitid(int|array<int> $orgunitid) Return ChildOutletStockSummary objects filtered by the orgunitid column
 *
 * @method     ChildOutletStockSummary[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildOutletStockSummary> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class OutletStockSummaryQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\OutletStockSummaryQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\OutletStockSummary', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildOutletStockSummaryQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildOutletStockSummaryQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildOutletStockSummaryQuery) {
            return $criteria;
        }
        $query = new ChildOutletStockSummaryQuery();
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
     * @return ChildOutletStockSummary|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(OutletStockSummaryTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = OutletStockSummaryTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildOutletStockSummary A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT outlet_stock_summary_id, outlet_org_id, outlet_id, moye, brand_id, product_id, closing_qty, computed_closing_qty, competitor_id, created_at, updated_at, company_id, orgunitid FROM outlet_stock_summary WHERE outlet_stock_summary_id = :p0';
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
            /** @var ChildOutletStockSummary $obj */
            $obj = new ChildOutletStockSummary();
            $obj->hydrate($row);
            OutletStockSummaryTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildOutletStockSummary|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(OutletStockSummaryTableMap::COL_OUTLET_STOCK_SUMMARY_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(OutletStockSummaryTableMap::COL_OUTLET_STOCK_SUMMARY_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the outlet_stock_summary_id column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletStockSummaryId(1234); // WHERE outlet_stock_summary_id = 1234
     * $query->filterByOutletStockSummaryId(array(12, 34)); // WHERE outlet_stock_summary_id IN (12, 34)
     * $query->filterByOutletStockSummaryId(array('min' => 12)); // WHERE outlet_stock_summary_id > 12
     * </code>
     *
     * @param mixed $outletStockSummaryId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletStockSummaryId($outletStockSummaryId = null, ?string $comparison = null)
    {
        if (is_array($outletStockSummaryId)) {
            $useMinMax = false;
            if (isset($outletStockSummaryId['min'])) {
                $this->addUsingAlias(OutletStockSummaryTableMap::COL_OUTLET_STOCK_SUMMARY_ID, $outletStockSummaryId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outletStockSummaryId['max'])) {
                $this->addUsingAlias(OutletStockSummaryTableMap::COL_OUTLET_STOCK_SUMMARY_ID, $outletStockSummaryId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletStockSummaryTableMap::COL_OUTLET_STOCK_SUMMARY_ID, $outletStockSummaryId, $comparison);

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
     * @see       filterByOutletOrgData()
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
                $this->addUsingAlias(OutletStockSummaryTableMap::COL_OUTLET_ORG_ID, $outletOrgId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outletOrgId['max'])) {
                $this->addUsingAlias(OutletStockSummaryTableMap::COL_OUTLET_ORG_ID, $outletOrgId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletStockSummaryTableMap::COL_OUTLET_ORG_ID, $outletOrgId, $comparison);

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
                $this->addUsingAlias(OutletStockSummaryTableMap::COL_OUTLET_ID, $outletId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outletId['max'])) {
                $this->addUsingAlias(OutletStockSummaryTableMap::COL_OUTLET_ID, $outletId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletStockSummaryTableMap::COL_OUTLET_ID, $outletId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the moye column
     *
     * Example usage:
     * <code>
     * $query->filterByMoye('fooValue');   // WHERE moye = 'fooValue'
     * $query->filterByMoye('%fooValue%', Criteria::LIKE); // WHERE moye LIKE '%fooValue%'
     * $query->filterByMoye(['foo', 'bar']); // WHERE moye IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $moye The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMoye($moye = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($moye)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletStockSummaryTableMap::COL_MOYE, $moye, $comparison);

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
                $this->addUsingAlias(OutletStockSummaryTableMap::COL_BRAND_ID, $brandId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($brandId['max'])) {
                $this->addUsingAlias(OutletStockSummaryTableMap::COL_BRAND_ID, $brandId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletStockSummaryTableMap::COL_BRAND_ID, $brandId, $comparison);

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
     * @see       filterByProducts()
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
                $this->addUsingAlias(OutletStockSummaryTableMap::COL_PRODUCT_ID, $productId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($productId['max'])) {
                $this->addUsingAlias(OutletStockSummaryTableMap::COL_PRODUCT_ID, $productId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletStockSummaryTableMap::COL_PRODUCT_ID, $productId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the closing_qty column
     *
     * Example usage:
     * <code>
     * $query->filterByClosingQty(1234); // WHERE closing_qty = 1234
     * $query->filterByClosingQty(array(12, 34)); // WHERE closing_qty IN (12, 34)
     * $query->filterByClosingQty(array('min' => 12)); // WHERE closing_qty > 12
     * </code>
     *
     * @param mixed $closingQty The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByClosingQty($closingQty = null, ?string $comparison = null)
    {
        if (is_array($closingQty)) {
            $useMinMax = false;
            if (isset($closingQty['min'])) {
                $this->addUsingAlias(OutletStockSummaryTableMap::COL_CLOSING_QTY, $closingQty['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($closingQty['max'])) {
                $this->addUsingAlias(OutletStockSummaryTableMap::COL_CLOSING_QTY, $closingQty['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletStockSummaryTableMap::COL_CLOSING_QTY, $closingQty, $comparison);

        return $this;
    }

    /**
     * Filter the query on the computed_closing_qty column
     *
     * Example usage:
     * <code>
     * $query->filterByComputedClosingQty(1234); // WHERE computed_closing_qty = 1234
     * $query->filterByComputedClosingQty(array(12, 34)); // WHERE computed_closing_qty IN (12, 34)
     * $query->filterByComputedClosingQty(array('min' => 12)); // WHERE computed_closing_qty > 12
     * </code>
     *
     * @param mixed $computedClosingQty The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByComputedClosingQty($computedClosingQty = null, ?string $comparison = null)
    {
        if (is_array($computedClosingQty)) {
            $useMinMax = false;
            if (isset($computedClosingQty['min'])) {
                $this->addUsingAlias(OutletStockSummaryTableMap::COL_COMPUTED_CLOSING_QTY, $computedClosingQty['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($computedClosingQty['max'])) {
                $this->addUsingAlias(OutletStockSummaryTableMap::COL_COMPUTED_CLOSING_QTY, $computedClosingQty['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletStockSummaryTableMap::COL_COMPUTED_CLOSING_QTY, $computedClosingQty, $comparison);

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
                $this->addUsingAlias(OutletStockSummaryTableMap::COL_COMPETITOR_ID, $competitorId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($competitorId['max'])) {
                $this->addUsingAlias(OutletStockSummaryTableMap::COL_COMPETITOR_ID, $competitorId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletStockSummaryTableMap::COL_COMPETITOR_ID, $competitorId, $comparison);

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
                $this->addUsingAlias(OutletStockSummaryTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(OutletStockSummaryTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletStockSummaryTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(OutletStockSummaryTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(OutletStockSummaryTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletStockSummaryTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

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
                $this->addUsingAlias(OutletStockSummaryTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(OutletStockSummaryTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletStockSummaryTableMap::COL_COMPANY_ID, $companyId, $comparison);

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
     * @see       filterByOrgUnit()
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
                $this->addUsingAlias(OutletStockSummaryTableMap::COL_ORGUNITID, $orgunitid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($orgunitid['max'])) {
                $this->addUsingAlias(OutletStockSummaryTableMap::COL_ORGUNITID, $orgunitid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletStockSummaryTableMap::COL_ORGUNITID, $orgunitid, $comparison);

        return $this;
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
                ->addUsingAlias(OutletStockSummaryTableMap::COL_BRAND_ID, $brands->getBrandId(), $comparison);
        } elseif ($brands instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(OutletStockSummaryTableMap::COL_BRAND_ID, $brands->toKeyValue('PrimaryKey', 'BrandId'), $comparison);

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
    public function joinBrands(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
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
    public function useBrandsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
        ?string $joinType = Criteria::INNER_JOIN
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
                ->addUsingAlias(OutletStockSummaryTableMap::COL_COMPANY_ID, $company->getCompanyId(), $comparison);
        } elseif ($company instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(OutletStockSummaryTableMap::COL_COMPANY_ID, $company->toKeyValue('PrimaryKey', 'CompanyId'), $comparison);

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
                ->addUsingAlias(OutletStockSummaryTableMap::COL_ORGUNITID, $orgUnit->getOrgunitid(), $comparison);
        } elseif ($orgUnit instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(OutletStockSummaryTableMap::COL_ORGUNITID, $orgUnit->toKeyValue('PrimaryKey', 'Orgunitid'), $comparison);

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
                ->addUsingAlias(OutletStockSummaryTableMap::COL_OUTLET_ID, $outlets->getId(), $comparison);
        } elseif ($outlets instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(OutletStockSummaryTableMap::COL_OUTLET_ID, $outlets->toKeyValue('PrimaryKey', 'Id'), $comparison);

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
    public function joinOutlets(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
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
    public function useOutletsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
        ?string $joinType = Criteria::INNER_JOIN
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
     * Filter the query by a related \entities\OutletOrgData object
     *
     * @param \entities\OutletOrgData|ObjectCollection $outletOrgData The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletOrgData($outletOrgData, ?string $comparison = null)
    {
        if ($outletOrgData instanceof \entities\OutletOrgData) {
            return $this
                ->addUsingAlias(OutletStockSummaryTableMap::COL_OUTLET_ORG_ID, $outletOrgData->getOutletOrgId(), $comparison);
        } elseif ($outletOrgData instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(OutletStockSummaryTableMap::COL_OUTLET_ORG_ID, $outletOrgData->toKeyValue('PrimaryKey', 'OutletOrgId'), $comparison);

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
    public function joinOutletOrgData(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
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
    public function useOutletOrgDataQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
        ?string $joinType = Criteria::INNER_JOIN
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
     * Filter the query by a related \entities\Products object
     *
     * @param \entities\Products|ObjectCollection $products The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProducts($products, ?string $comparison = null)
    {
        if ($products instanceof \entities\Products) {
            return $this
                ->addUsingAlias(OutletStockSummaryTableMap::COL_PRODUCT_ID, $products->getId(), $comparison);
        } elseif ($products instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(OutletStockSummaryTableMap::COL_PRODUCT_ID, $products->toKeyValue('PrimaryKey', 'Id'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByProducts() only accepts arguments of type \entities\Products or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Products relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinProducts(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Products');

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
            $this->addJoinObject($join, 'Products');
        }

        return $this;
    }

    /**
     * Use the Products relation Products object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\ProductsQuery A secondary query class using the current class as primary query
     */
    public function useProductsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProducts($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Products', '\entities\ProductsQuery');
    }

    /**
     * Use the Products relation Products object
     *
     * @param callable(\entities\ProductsQuery):\entities\ProductsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withProductsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useProductsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Products table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\ProductsQuery The inner query object of the EXISTS statement
     */
    public function useProductsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\ProductsQuery */
        $q = $this->useExistsQuery('Products', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Products table for a NOT EXISTS query.
     *
     * @see useProductsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\ProductsQuery The inner query object of the NOT EXISTS statement
     */
    public function useProductsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\ProductsQuery */
        $q = $this->useExistsQuery('Products', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Products table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\ProductsQuery The inner query object of the IN statement
     */
    public function useInProductsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\ProductsQuery */
        $q = $this->useInQuery('Products', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Products table for a NOT IN query.
     *
     * @see useProductsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\ProductsQuery The inner query object of the NOT IN statement
     */
    public function useNotInProductsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\ProductsQuery */
        $q = $this->useInQuery('Products', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildOutletStockSummary $outletStockSummary Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($outletStockSummary = null)
    {
        if ($outletStockSummary) {
            $this->addUsingAlias(OutletStockSummaryTableMap::COL_OUTLET_STOCK_SUMMARY_ID, $outletStockSummary->getOutletStockSummaryId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the outlet_stock_summary table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OutletStockSummaryTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            OutletStockSummaryTableMap::clearInstancePool();
            OutletStockSummaryTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(OutletStockSummaryTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(OutletStockSummaryTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            OutletStockSummaryTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            OutletStockSummaryTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
