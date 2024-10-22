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
use entities\OutletStockOtherSummary as ChildOutletStockOtherSummary;
use entities\OutletStockOtherSummaryQuery as ChildOutletStockOtherSummaryQuery;
use entities\Map\OutletStockOtherSummaryTableMap;

/**
 * Base class that represents a query for the `outlet_stock_other_summary` table.
 *
 * @method     ChildOutletStockOtherSummaryQuery orderByOutletStockOtherSummaryId($order = Criteria::ASC) Order by the outlet_stock_other_summary_id column
 * @method     ChildOutletStockOtherSummaryQuery orderByOutletOrgId($order = Criteria::ASC) Order by the outlet_org_id column
 * @method     ChildOutletStockOtherSummaryQuery orderByOutletId($order = Criteria::ASC) Order by the outlet_id column
 * @method     ChildOutletStockOtherSummaryQuery orderByMoye($order = Criteria::ASC) Order by the moye column
 * @method     ChildOutletStockOtherSummaryQuery orderByBrandId($order = Criteria::ASC) Order by the brand_id column
 * @method     ChildOutletStockOtherSummaryQuery orderByProductId($order = Criteria::ASC) Order by the product_id column
 * @method     ChildOutletStockOtherSummaryQuery orderBySaleQty($order = Criteria::ASC) Order by the sale_qty column
 * @method     ChildOutletStockOtherSummaryQuery orderBySaleValue($order = Criteria::ASC) Order by the sale_value column
 * @method     ChildOutletStockOtherSummaryQuery orderByReturnQty($order = Criteria::ASC) Order by the return_qty column
 * @method     ChildOutletStockOtherSummaryQuery orderByReturnValue($order = Criteria::ASC) Order by the return_value column
 * @method     ChildOutletStockOtherSummaryQuery orderByCompetitorId($order = Criteria::ASC) Order by the competitor_id column
 * @method     ChildOutletStockOtherSummaryQuery orderByOrgunitid($order = Criteria::ASC) Order by the orgunitid column
 * @method     ChildOutletStockOtherSummaryQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildOutletStockOtherSummaryQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildOutletStockOtherSummaryQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 *
 * @method     ChildOutletStockOtherSummaryQuery groupByOutletStockOtherSummaryId() Group by the outlet_stock_other_summary_id column
 * @method     ChildOutletStockOtherSummaryQuery groupByOutletOrgId() Group by the outlet_org_id column
 * @method     ChildOutletStockOtherSummaryQuery groupByOutletId() Group by the outlet_id column
 * @method     ChildOutletStockOtherSummaryQuery groupByMoye() Group by the moye column
 * @method     ChildOutletStockOtherSummaryQuery groupByBrandId() Group by the brand_id column
 * @method     ChildOutletStockOtherSummaryQuery groupByProductId() Group by the product_id column
 * @method     ChildOutletStockOtherSummaryQuery groupBySaleQty() Group by the sale_qty column
 * @method     ChildOutletStockOtherSummaryQuery groupBySaleValue() Group by the sale_value column
 * @method     ChildOutletStockOtherSummaryQuery groupByReturnQty() Group by the return_qty column
 * @method     ChildOutletStockOtherSummaryQuery groupByReturnValue() Group by the return_value column
 * @method     ChildOutletStockOtherSummaryQuery groupByCompetitorId() Group by the competitor_id column
 * @method     ChildOutletStockOtherSummaryQuery groupByOrgunitid() Group by the orgunitid column
 * @method     ChildOutletStockOtherSummaryQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildOutletStockOtherSummaryQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildOutletStockOtherSummaryQuery groupByCompanyId() Group by the company_id column
 *
 * @method     ChildOutletStockOtherSummaryQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildOutletStockOtherSummaryQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildOutletStockOtherSummaryQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildOutletStockOtherSummaryQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildOutletStockOtherSummaryQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildOutletStockOtherSummaryQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildOutletStockOtherSummaryQuery leftJoinBrands($relationAlias = null) Adds a LEFT JOIN clause to the query using the Brands relation
 * @method     ChildOutletStockOtherSummaryQuery rightJoinBrands($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Brands relation
 * @method     ChildOutletStockOtherSummaryQuery innerJoinBrands($relationAlias = null) Adds a INNER JOIN clause to the query using the Brands relation
 *
 * @method     ChildOutletStockOtherSummaryQuery joinWithBrands($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Brands relation
 *
 * @method     ChildOutletStockOtherSummaryQuery leftJoinWithBrands() Adds a LEFT JOIN clause and with to the query using the Brands relation
 * @method     ChildOutletStockOtherSummaryQuery rightJoinWithBrands() Adds a RIGHT JOIN clause and with to the query using the Brands relation
 * @method     ChildOutletStockOtherSummaryQuery innerJoinWithBrands() Adds a INNER JOIN clause and with to the query using the Brands relation
 *
 * @method     ChildOutletStockOtherSummaryQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildOutletStockOtherSummaryQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildOutletStockOtherSummaryQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildOutletStockOtherSummaryQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildOutletStockOtherSummaryQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildOutletStockOtherSummaryQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildOutletStockOtherSummaryQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     ChildOutletStockOtherSummaryQuery leftJoinOrgUnit($relationAlias = null) Adds a LEFT JOIN clause to the query using the OrgUnit relation
 * @method     ChildOutletStockOtherSummaryQuery rightJoinOrgUnit($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OrgUnit relation
 * @method     ChildOutletStockOtherSummaryQuery innerJoinOrgUnit($relationAlias = null) Adds a INNER JOIN clause to the query using the OrgUnit relation
 *
 * @method     ChildOutletStockOtherSummaryQuery joinWithOrgUnit($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OrgUnit relation
 *
 * @method     ChildOutletStockOtherSummaryQuery leftJoinWithOrgUnit() Adds a LEFT JOIN clause and with to the query using the OrgUnit relation
 * @method     ChildOutletStockOtherSummaryQuery rightJoinWithOrgUnit() Adds a RIGHT JOIN clause and with to the query using the OrgUnit relation
 * @method     ChildOutletStockOtherSummaryQuery innerJoinWithOrgUnit() Adds a INNER JOIN clause and with to the query using the OrgUnit relation
 *
 * @method     ChildOutletStockOtherSummaryQuery leftJoinOutlets($relationAlias = null) Adds a LEFT JOIN clause to the query using the Outlets relation
 * @method     ChildOutletStockOtherSummaryQuery rightJoinOutlets($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Outlets relation
 * @method     ChildOutletStockOtherSummaryQuery innerJoinOutlets($relationAlias = null) Adds a INNER JOIN clause to the query using the Outlets relation
 *
 * @method     ChildOutletStockOtherSummaryQuery joinWithOutlets($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Outlets relation
 *
 * @method     ChildOutletStockOtherSummaryQuery leftJoinWithOutlets() Adds a LEFT JOIN clause and with to the query using the Outlets relation
 * @method     ChildOutletStockOtherSummaryQuery rightJoinWithOutlets() Adds a RIGHT JOIN clause and with to the query using the Outlets relation
 * @method     ChildOutletStockOtherSummaryQuery innerJoinWithOutlets() Adds a INNER JOIN clause and with to the query using the Outlets relation
 *
 * @method     ChildOutletStockOtherSummaryQuery leftJoinOutletOrgData($relationAlias = null) Adds a LEFT JOIN clause to the query using the OutletOrgData relation
 * @method     ChildOutletStockOtherSummaryQuery rightJoinOutletOrgData($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OutletOrgData relation
 * @method     ChildOutletStockOtherSummaryQuery innerJoinOutletOrgData($relationAlias = null) Adds a INNER JOIN clause to the query using the OutletOrgData relation
 *
 * @method     ChildOutletStockOtherSummaryQuery joinWithOutletOrgData($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OutletOrgData relation
 *
 * @method     ChildOutletStockOtherSummaryQuery leftJoinWithOutletOrgData() Adds a LEFT JOIN clause and with to the query using the OutletOrgData relation
 * @method     ChildOutletStockOtherSummaryQuery rightJoinWithOutletOrgData() Adds a RIGHT JOIN clause and with to the query using the OutletOrgData relation
 * @method     ChildOutletStockOtherSummaryQuery innerJoinWithOutletOrgData() Adds a INNER JOIN clause and with to the query using the OutletOrgData relation
 *
 * @method     ChildOutletStockOtherSummaryQuery leftJoinProducts($relationAlias = null) Adds a LEFT JOIN clause to the query using the Products relation
 * @method     ChildOutletStockOtherSummaryQuery rightJoinProducts($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Products relation
 * @method     ChildOutletStockOtherSummaryQuery innerJoinProducts($relationAlias = null) Adds a INNER JOIN clause to the query using the Products relation
 *
 * @method     ChildOutletStockOtherSummaryQuery joinWithProducts($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Products relation
 *
 * @method     ChildOutletStockOtherSummaryQuery leftJoinWithProducts() Adds a LEFT JOIN clause and with to the query using the Products relation
 * @method     ChildOutletStockOtherSummaryQuery rightJoinWithProducts() Adds a RIGHT JOIN clause and with to the query using the Products relation
 * @method     ChildOutletStockOtherSummaryQuery innerJoinWithProducts() Adds a INNER JOIN clause and with to the query using the Products relation
 *
 * @method     \entities\BrandsQuery|\entities\CompanyQuery|\entities\OrgUnitQuery|\entities\OutletsQuery|\entities\OutletOrgDataQuery|\entities\ProductsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildOutletStockOtherSummary|null findOne(?ConnectionInterface $con = null) Return the first ChildOutletStockOtherSummary matching the query
 * @method     ChildOutletStockOtherSummary findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildOutletStockOtherSummary matching the query, or a new ChildOutletStockOtherSummary object populated from the query conditions when no match is found
 *
 * @method     ChildOutletStockOtherSummary|null findOneByOutletStockOtherSummaryId(int $outlet_stock_other_summary_id) Return the first ChildOutletStockOtherSummary filtered by the outlet_stock_other_summary_id column
 * @method     ChildOutletStockOtherSummary|null findOneByOutletOrgId(int $outlet_org_id) Return the first ChildOutletStockOtherSummary filtered by the outlet_org_id column
 * @method     ChildOutletStockOtherSummary|null findOneByOutletId(int $outlet_id) Return the first ChildOutletStockOtherSummary filtered by the outlet_id column
 * @method     ChildOutletStockOtherSummary|null findOneByMoye(string $moye) Return the first ChildOutletStockOtherSummary filtered by the moye column
 * @method     ChildOutletStockOtherSummary|null findOneByBrandId(int $brand_id) Return the first ChildOutletStockOtherSummary filtered by the brand_id column
 * @method     ChildOutletStockOtherSummary|null findOneByProductId(int $product_id) Return the first ChildOutletStockOtherSummary filtered by the product_id column
 * @method     ChildOutletStockOtherSummary|null findOneBySaleQty(int $sale_qty) Return the first ChildOutletStockOtherSummary filtered by the sale_qty column
 * @method     ChildOutletStockOtherSummary|null findOneBySaleValue(string $sale_value) Return the first ChildOutletStockOtherSummary filtered by the sale_value column
 * @method     ChildOutletStockOtherSummary|null findOneByReturnQty(int $return_qty) Return the first ChildOutletStockOtherSummary filtered by the return_qty column
 * @method     ChildOutletStockOtherSummary|null findOneByReturnValue(string $return_value) Return the first ChildOutletStockOtherSummary filtered by the return_value column
 * @method     ChildOutletStockOtherSummary|null findOneByCompetitorId(int $competitor_id) Return the first ChildOutletStockOtherSummary filtered by the competitor_id column
 * @method     ChildOutletStockOtherSummary|null findOneByOrgunitid(int $orgunitid) Return the first ChildOutletStockOtherSummary filtered by the orgunitid column
 * @method     ChildOutletStockOtherSummary|null findOneByCreatedAt(string $created_at) Return the first ChildOutletStockOtherSummary filtered by the created_at column
 * @method     ChildOutletStockOtherSummary|null findOneByUpdatedAt(string $updated_at) Return the first ChildOutletStockOtherSummary filtered by the updated_at column
 * @method     ChildOutletStockOtherSummary|null findOneByCompanyId(int $company_id) Return the first ChildOutletStockOtherSummary filtered by the company_id column
 *
 * @method     ChildOutletStockOtherSummary requirePk($key, ?ConnectionInterface $con = null) Return the ChildOutletStockOtherSummary by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletStockOtherSummary requireOne(?ConnectionInterface $con = null) Return the first ChildOutletStockOtherSummary matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOutletStockOtherSummary requireOneByOutletStockOtherSummaryId(int $outlet_stock_other_summary_id) Return the first ChildOutletStockOtherSummary filtered by the outlet_stock_other_summary_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletStockOtherSummary requireOneByOutletOrgId(int $outlet_org_id) Return the first ChildOutletStockOtherSummary filtered by the outlet_org_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletStockOtherSummary requireOneByOutletId(int $outlet_id) Return the first ChildOutletStockOtherSummary filtered by the outlet_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletStockOtherSummary requireOneByMoye(string $moye) Return the first ChildOutletStockOtherSummary filtered by the moye column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletStockOtherSummary requireOneByBrandId(int $brand_id) Return the first ChildOutletStockOtherSummary filtered by the brand_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletStockOtherSummary requireOneByProductId(int $product_id) Return the first ChildOutletStockOtherSummary filtered by the product_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletStockOtherSummary requireOneBySaleQty(int $sale_qty) Return the first ChildOutletStockOtherSummary filtered by the sale_qty column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletStockOtherSummary requireOneBySaleValue(string $sale_value) Return the first ChildOutletStockOtherSummary filtered by the sale_value column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletStockOtherSummary requireOneByReturnQty(int $return_qty) Return the first ChildOutletStockOtherSummary filtered by the return_qty column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletStockOtherSummary requireOneByReturnValue(string $return_value) Return the first ChildOutletStockOtherSummary filtered by the return_value column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletStockOtherSummary requireOneByCompetitorId(int $competitor_id) Return the first ChildOutletStockOtherSummary filtered by the competitor_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletStockOtherSummary requireOneByOrgunitid(int $orgunitid) Return the first ChildOutletStockOtherSummary filtered by the orgunitid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletStockOtherSummary requireOneByCreatedAt(string $created_at) Return the first ChildOutletStockOtherSummary filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletStockOtherSummary requireOneByUpdatedAt(string $updated_at) Return the first ChildOutletStockOtherSummary filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletStockOtherSummary requireOneByCompanyId(int $company_id) Return the first ChildOutletStockOtherSummary filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOutletStockOtherSummary[]|Collection find(?ConnectionInterface $con = null) Return ChildOutletStockOtherSummary objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildOutletStockOtherSummary> find(?ConnectionInterface $con = null) Return ChildOutletStockOtherSummary objects based on current ModelCriteria
 *
 * @method     ChildOutletStockOtherSummary[]|Collection findByOutletStockOtherSummaryId(int|array<int> $outlet_stock_other_summary_id) Return ChildOutletStockOtherSummary objects filtered by the outlet_stock_other_summary_id column
 * @psalm-method Collection&\Traversable<ChildOutletStockOtherSummary> findByOutletStockOtherSummaryId(int|array<int> $outlet_stock_other_summary_id) Return ChildOutletStockOtherSummary objects filtered by the outlet_stock_other_summary_id column
 * @method     ChildOutletStockOtherSummary[]|Collection findByOutletOrgId(int|array<int> $outlet_org_id) Return ChildOutletStockOtherSummary objects filtered by the outlet_org_id column
 * @psalm-method Collection&\Traversable<ChildOutletStockOtherSummary> findByOutletOrgId(int|array<int> $outlet_org_id) Return ChildOutletStockOtherSummary objects filtered by the outlet_org_id column
 * @method     ChildOutletStockOtherSummary[]|Collection findByOutletId(int|array<int> $outlet_id) Return ChildOutletStockOtherSummary objects filtered by the outlet_id column
 * @psalm-method Collection&\Traversable<ChildOutletStockOtherSummary> findByOutletId(int|array<int> $outlet_id) Return ChildOutletStockOtherSummary objects filtered by the outlet_id column
 * @method     ChildOutletStockOtherSummary[]|Collection findByMoye(string|array<string> $moye) Return ChildOutletStockOtherSummary objects filtered by the moye column
 * @psalm-method Collection&\Traversable<ChildOutletStockOtherSummary> findByMoye(string|array<string> $moye) Return ChildOutletStockOtherSummary objects filtered by the moye column
 * @method     ChildOutletStockOtherSummary[]|Collection findByBrandId(int|array<int> $brand_id) Return ChildOutletStockOtherSummary objects filtered by the brand_id column
 * @psalm-method Collection&\Traversable<ChildOutletStockOtherSummary> findByBrandId(int|array<int> $brand_id) Return ChildOutletStockOtherSummary objects filtered by the brand_id column
 * @method     ChildOutletStockOtherSummary[]|Collection findByProductId(int|array<int> $product_id) Return ChildOutletStockOtherSummary objects filtered by the product_id column
 * @psalm-method Collection&\Traversable<ChildOutletStockOtherSummary> findByProductId(int|array<int> $product_id) Return ChildOutletStockOtherSummary objects filtered by the product_id column
 * @method     ChildOutletStockOtherSummary[]|Collection findBySaleQty(int|array<int> $sale_qty) Return ChildOutletStockOtherSummary objects filtered by the sale_qty column
 * @psalm-method Collection&\Traversable<ChildOutletStockOtherSummary> findBySaleQty(int|array<int> $sale_qty) Return ChildOutletStockOtherSummary objects filtered by the sale_qty column
 * @method     ChildOutletStockOtherSummary[]|Collection findBySaleValue(string|array<string> $sale_value) Return ChildOutletStockOtherSummary objects filtered by the sale_value column
 * @psalm-method Collection&\Traversable<ChildOutletStockOtherSummary> findBySaleValue(string|array<string> $sale_value) Return ChildOutletStockOtherSummary objects filtered by the sale_value column
 * @method     ChildOutletStockOtherSummary[]|Collection findByReturnQty(int|array<int> $return_qty) Return ChildOutletStockOtherSummary objects filtered by the return_qty column
 * @psalm-method Collection&\Traversable<ChildOutletStockOtherSummary> findByReturnQty(int|array<int> $return_qty) Return ChildOutletStockOtherSummary objects filtered by the return_qty column
 * @method     ChildOutletStockOtherSummary[]|Collection findByReturnValue(string|array<string> $return_value) Return ChildOutletStockOtherSummary objects filtered by the return_value column
 * @psalm-method Collection&\Traversable<ChildOutletStockOtherSummary> findByReturnValue(string|array<string> $return_value) Return ChildOutletStockOtherSummary objects filtered by the return_value column
 * @method     ChildOutletStockOtherSummary[]|Collection findByCompetitorId(int|array<int> $competitor_id) Return ChildOutletStockOtherSummary objects filtered by the competitor_id column
 * @psalm-method Collection&\Traversable<ChildOutletStockOtherSummary> findByCompetitorId(int|array<int> $competitor_id) Return ChildOutletStockOtherSummary objects filtered by the competitor_id column
 * @method     ChildOutletStockOtherSummary[]|Collection findByOrgunitid(int|array<int> $orgunitid) Return ChildOutletStockOtherSummary objects filtered by the orgunitid column
 * @psalm-method Collection&\Traversable<ChildOutletStockOtherSummary> findByOrgunitid(int|array<int> $orgunitid) Return ChildOutletStockOtherSummary objects filtered by the orgunitid column
 * @method     ChildOutletStockOtherSummary[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildOutletStockOtherSummary objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildOutletStockOtherSummary> findByCreatedAt(string|array<string> $created_at) Return ChildOutletStockOtherSummary objects filtered by the created_at column
 * @method     ChildOutletStockOtherSummary[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildOutletStockOtherSummary objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildOutletStockOtherSummary> findByUpdatedAt(string|array<string> $updated_at) Return ChildOutletStockOtherSummary objects filtered by the updated_at column
 * @method     ChildOutletStockOtherSummary[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildOutletStockOtherSummary objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildOutletStockOtherSummary> findByCompanyId(int|array<int> $company_id) Return ChildOutletStockOtherSummary objects filtered by the company_id column
 *
 * @method     ChildOutletStockOtherSummary[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildOutletStockOtherSummary> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class OutletStockOtherSummaryQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\OutletStockOtherSummaryQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\OutletStockOtherSummary', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildOutletStockOtherSummaryQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildOutletStockOtherSummaryQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildOutletStockOtherSummaryQuery) {
            return $criteria;
        }
        $query = new ChildOutletStockOtherSummaryQuery();
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
     * @return ChildOutletStockOtherSummary|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(OutletStockOtherSummaryTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = OutletStockOtherSummaryTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildOutletStockOtherSummary A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT outlet_stock_other_summary_id, outlet_org_id, outlet_id, moye, brand_id, product_id, sale_qty, sale_value, return_qty, return_value, competitor_id, orgunitid, created_at, updated_at, company_id FROM outlet_stock_other_summary WHERE outlet_stock_other_summary_id = :p0';
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
            /** @var ChildOutletStockOtherSummary $obj */
            $obj = new ChildOutletStockOtherSummary();
            $obj->hydrate($row);
            OutletStockOtherSummaryTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildOutletStockOtherSummary|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(OutletStockOtherSummaryTableMap::COL_OUTLET_STOCK_OTHER_SUMMARY_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(OutletStockOtherSummaryTableMap::COL_OUTLET_STOCK_OTHER_SUMMARY_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the outlet_stock_other_summary_id column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletStockOtherSummaryId(1234); // WHERE outlet_stock_other_summary_id = 1234
     * $query->filterByOutletStockOtherSummaryId(array(12, 34)); // WHERE outlet_stock_other_summary_id IN (12, 34)
     * $query->filterByOutletStockOtherSummaryId(array('min' => 12)); // WHERE outlet_stock_other_summary_id > 12
     * </code>
     *
     * @param mixed $outletStockOtherSummaryId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletStockOtherSummaryId($outletStockOtherSummaryId = null, ?string $comparison = null)
    {
        if (is_array($outletStockOtherSummaryId)) {
            $useMinMax = false;
            if (isset($outletStockOtherSummaryId['min'])) {
                $this->addUsingAlias(OutletStockOtherSummaryTableMap::COL_OUTLET_STOCK_OTHER_SUMMARY_ID, $outletStockOtherSummaryId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outletStockOtherSummaryId['max'])) {
                $this->addUsingAlias(OutletStockOtherSummaryTableMap::COL_OUTLET_STOCK_OTHER_SUMMARY_ID, $outletStockOtherSummaryId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletStockOtherSummaryTableMap::COL_OUTLET_STOCK_OTHER_SUMMARY_ID, $outletStockOtherSummaryId, $comparison);

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
                $this->addUsingAlias(OutletStockOtherSummaryTableMap::COL_OUTLET_ORG_ID, $outletOrgId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outletOrgId['max'])) {
                $this->addUsingAlias(OutletStockOtherSummaryTableMap::COL_OUTLET_ORG_ID, $outletOrgId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletStockOtherSummaryTableMap::COL_OUTLET_ORG_ID, $outletOrgId, $comparison);

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
                $this->addUsingAlias(OutletStockOtherSummaryTableMap::COL_OUTLET_ID, $outletId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outletId['max'])) {
                $this->addUsingAlias(OutletStockOtherSummaryTableMap::COL_OUTLET_ID, $outletId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletStockOtherSummaryTableMap::COL_OUTLET_ID, $outletId, $comparison);

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

        $this->addUsingAlias(OutletStockOtherSummaryTableMap::COL_MOYE, $moye, $comparison);

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
                $this->addUsingAlias(OutletStockOtherSummaryTableMap::COL_BRAND_ID, $brandId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($brandId['max'])) {
                $this->addUsingAlias(OutletStockOtherSummaryTableMap::COL_BRAND_ID, $brandId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletStockOtherSummaryTableMap::COL_BRAND_ID, $brandId, $comparison);

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
                $this->addUsingAlias(OutletStockOtherSummaryTableMap::COL_PRODUCT_ID, $productId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($productId['max'])) {
                $this->addUsingAlias(OutletStockOtherSummaryTableMap::COL_PRODUCT_ID, $productId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletStockOtherSummaryTableMap::COL_PRODUCT_ID, $productId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the sale_qty column
     *
     * Example usage:
     * <code>
     * $query->filterBySaleQty(1234); // WHERE sale_qty = 1234
     * $query->filterBySaleQty(array(12, 34)); // WHERE sale_qty IN (12, 34)
     * $query->filterBySaleQty(array('min' => 12)); // WHERE sale_qty > 12
     * </code>
     *
     * @param mixed $saleQty The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySaleQty($saleQty = null, ?string $comparison = null)
    {
        if (is_array($saleQty)) {
            $useMinMax = false;
            if (isset($saleQty['min'])) {
                $this->addUsingAlias(OutletStockOtherSummaryTableMap::COL_SALE_QTY, $saleQty['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($saleQty['max'])) {
                $this->addUsingAlias(OutletStockOtherSummaryTableMap::COL_SALE_QTY, $saleQty['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletStockOtherSummaryTableMap::COL_SALE_QTY, $saleQty, $comparison);

        return $this;
    }

    /**
     * Filter the query on the sale_value column
     *
     * Example usage:
     * <code>
     * $query->filterBySaleValue(1234); // WHERE sale_value = 1234
     * $query->filterBySaleValue(array(12, 34)); // WHERE sale_value IN (12, 34)
     * $query->filterBySaleValue(array('min' => 12)); // WHERE sale_value > 12
     * </code>
     *
     * @param mixed $saleValue The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySaleValue($saleValue = null, ?string $comparison = null)
    {
        if (is_array($saleValue)) {
            $useMinMax = false;
            if (isset($saleValue['min'])) {
                $this->addUsingAlias(OutletStockOtherSummaryTableMap::COL_SALE_VALUE, $saleValue['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($saleValue['max'])) {
                $this->addUsingAlias(OutletStockOtherSummaryTableMap::COL_SALE_VALUE, $saleValue['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletStockOtherSummaryTableMap::COL_SALE_VALUE, $saleValue, $comparison);

        return $this;
    }

    /**
     * Filter the query on the return_qty column
     *
     * Example usage:
     * <code>
     * $query->filterByReturnQty(1234); // WHERE return_qty = 1234
     * $query->filterByReturnQty(array(12, 34)); // WHERE return_qty IN (12, 34)
     * $query->filterByReturnQty(array('min' => 12)); // WHERE return_qty > 12
     * </code>
     *
     * @param mixed $returnQty The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByReturnQty($returnQty = null, ?string $comparison = null)
    {
        if (is_array($returnQty)) {
            $useMinMax = false;
            if (isset($returnQty['min'])) {
                $this->addUsingAlias(OutletStockOtherSummaryTableMap::COL_RETURN_QTY, $returnQty['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($returnQty['max'])) {
                $this->addUsingAlias(OutletStockOtherSummaryTableMap::COL_RETURN_QTY, $returnQty['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletStockOtherSummaryTableMap::COL_RETURN_QTY, $returnQty, $comparison);

        return $this;
    }

    /**
     * Filter the query on the return_value column
     *
     * Example usage:
     * <code>
     * $query->filterByReturnValue(1234); // WHERE return_value = 1234
     * $query->filterByReturnValue(array(12, 34)); // WHERE return_value IN (12, 34)
     * $query->filterByReturnValue(array('min' => 12)); // WHERE return_value > 12
     * </code>
     *
     * @param mixed $returnValue The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByReturnValue($returnValue = null, ?string $comparison = null)
    {
        if (is_array($returnValue)) {
            $useMinMax = false;
            if (isset($returnValue['min'])) {
                $this->addUsingAlias(OutletStockOtherSummaryTableMap::COL_RETURN_VALUE, $returnValue['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($returnValue['max'])) {
                $this->addUsingAlias(OutletStockOtherSummaryTableMap::COL_RETURN_VALUE, $returnValue['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletStockOtherSummaryTableMap::COL_RETURN_VALUE, $returnValue, $comparison);

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
                $this->addUsingAlias(OutletStockOtherSummaryTableMap::COL_COMPETITOR_ID, $competitorId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($competitorId['max'])) {
                $this->addUsingAlias(OutletStockOtherSummaryTableMap::COL_COMPETITOR_ID, $competitorId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletStockOtherSummaryTableMap::COL_COMPETITOR_ID, $competitorId, $comparison);

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
                $this->addUsingAlias(OutletStockOtherSummaryTableMap::COL_ORGUNITID, $orgunitid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($orgunitid['max'])) {
                $this->addUsingAlias(OutletStockOtherSummaryTableMap::COL_ORGUNITID, $orgunitid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletStockOtherSummaryTableMap::COL_ORGUNITID, $orgunitid, $comparison);

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
                $this->addUsingAlias(OutletStockOtherSummaryTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(OutletStockOtherSummaryTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletStockOtherSummaryTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(OutletStockOtherSummaryTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(OutletStockOtherSummaryTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletStockOtherSummaryTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

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
                $this->addUsingAlias(OutletStockOtherSummaryTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(OutletStockOtherSummaryTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletStockOtherSummaryTableMap::COL_COMPANY_ID, $companyId, $comparison);

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
                ->addUsingAlias(OutletStockOtherSummaryTableMap::COL_BRAND_ID, $brands->getBrandId(), $comparison);
        } elseif ($brands instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(OutletStockOtherSummaryTableMap::COL_BRAND_ID, $brands->toKeyValue('PrimaryKey', 'BrandId'), $comparison);

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
                ->addUsingAlias(OutletStockOtherSummaryTableMap::COL_COMPANY_ID, $company->getCompanyId(), $comparison);
        } elseif ($company instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(OutletStockOtherSummaryTableMap::COL_COMPANY_ID, $company->toKeyValue('PrimaryKey', 'CompanyId'), $comparison);

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
                ->addUsingAlias(OutletStockOtherSummaryTableMap::COL_ORGUNITID, $orgUnit->getOrgunitid(), $comparison);
        } elseif ($orgUnit instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(OutletStockOtherSummaryTableMap::COL_ORGUNITID, $orgUnit->toKeyValue('PrimaryKey', 'Orgunitid'), $comparison);

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
                ->addUsingAlias(OutletStockOtherSummaryTableMap::COL_OUTLET_ID, $outlets->getId(), $comparison);
        } elseif ($outlets instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(OutletStockOtherSummaryTableMap::COL_OUTLET_ID, $outlets->toKeyValue('PrimaryKey', 'Id'), $comparison);

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
                ->addUsingAlias(OutletStockOtherSummaryTableMap::COL_OUTLET_ORG_ID, $outletOrgData->getOutletOrgId(), $comparison);
        } elseif ($outletOrgData instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(OutletStockOtherSummaryTableMap::COL_OUTLET_ORG_ID, $outletOrgData->toKeyValue('PrimaryKey', 'OutletOrgId'), $comparison);

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
                ->addUsingAlias(OutletStockOtherSummaryTableMap::COL_PRODUCT_ID, $products->getId(), $comparison);
        } elseif ($products instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(OutletStockOtherSummaryTableMap::COL_PRODUCT_ID, $products->toKeyValue('PrimaryKey', 'Id'), $comparison);

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
     * @param ChildOutletStockOtherSummary $outletStockOtherSummary Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($outletStockOtherSummary = null)
    {
        if ($outletStockOtherSummary) {
            $this->addUsingAlias(OutletStockOtherSummaryTableMap::COL_OUTLET_STOCK_OTHER_SUMMARY_ID, $outletStockOtherSummary->getOutletStockOtherSummaryId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the outlet_stock_other_summary table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OutletStockOtherSummaryTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            OutletStockOtherSummaryTableMap::clearInstancePool();
            OutletStockOtherSummaryTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(OutletStockOtherSummaryTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(OutletStockOtherSummaryTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            OutletStockOtherSummaryTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            OutletStockOtherSummaryTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
