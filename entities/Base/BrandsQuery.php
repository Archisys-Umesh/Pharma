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
use entities\Brands as ChildBrands;
use entities\BrandsQuery as ChildBrandsQuery;
use entities\Map\BrandsTableMap;

/**
 * Base class that represents a query for the `brands` table.
 *
 * @method     ChildBrandsQuery orderByBrandId($order = Criteria::ASC) Order by the brand_id column
 * @method     ChildBrandsQuery orderByBrandName($order = Criteria::ASC) Order by the brand_name column
 * @method     ChildBrandsQuery orderByOrgunitid($order = Criteria::ASC) Order by the orgunitid column
 * @method     ChildBrandsQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildBrandsQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildBrandsQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildBrandsQuery orderByBrandCode($order = Criteria::ASC) Order by the brand_code column
 * @method     ChildBrandsQuery orderByBrandRate($order = Criteria::ASC) Order by the brand_rate column
 * @method     ChildBrandsQuery orderByMinValue($order = Criteria::ASC) Order by the min_value column
 *
 * @method     ChildBrandsQuery groupByBrandId() Group by the brand_id column
 * @method     ChildBrandsQuery groupByBrandName() Group by the brand_name column
 * @method     ChildBrandsQuery groupByOrgunitid() Group by the orgunitid column
 * @method     ChildBrandsQuery groupByCompanyId() Group by the company_id column
 * @method     ChildBrandsQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildBrandsQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildBrandsQuery groupByBrandCode() Group by the brand_code column
 * @method     ChildBrandsQuery groupByBrandRate() Group by the brand_rate column
 * @method     ChildBrandsQuery groupByMinValue() Group by the min_value column
 *
 * @method     ChildBrandsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildBrandsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildBrandsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildBrandsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildBrandsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildBrandsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildBrandsQuery leftJoinOrgUnit($relationAlias = null) Adds a LEFT JOIN clause to the query using the OrgUnit relation
 * @method     ChildBrandsQuery rightJoinOrgUnit($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OrgUnit relation
 * @method     ChildBrandsQuery innerJoinOrgUnit($relationAlias = null) Adds a INNER JOIN clause to the query using the OrgUnit relation
 *
 * @method     ChildBrandsQuery joinWithOrgUnit($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OrgUnit relation
 *
 * @method     ChildBrandsQuery leftJoinWithOrgUnit() Adds a LEFT JOIN clause and with to the query using the OrgUnit relation
 * @method     ChildBrandsQuery rightJoinWithOrgUnit() Adds a RIGHT JOIN clause and with to the query using the OrgUnit relation
 * @method     ChildBrandsQuery innerJoinWithOrgUnit() Adds a INNER JOIN clause and with to the query using the OrgUnit relation
 *
 * @method     ChildBrandsQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildBrandsQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildBrandsQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildBrandsQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildBrandsQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildBrandsQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildBrandsQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     ChildBrandsQuery leftJoinBrandCampiagn($relationAlias = null) Adds a LEFT JOIN clause to the query using the BrandCampiagn relation
 * @method     ChildBrandsQuery rightJoinBrandCampiagn($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BrandCampiagn relation
 * @method     ChildBrandsQuery innerJoinBrandCampiagn($relationAlias = null) Adds a INNER JOIN clause to the query using the BrandCampiagn relation
 *
 * @method     ChildBrandsQuery joinWithBrandCampiagn($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BrandCampiagn relation
 *
 * @method     ChildBrandsQuery leftJoinWithBrandCampiagn() Adds a LEFT JOIN clause and with to the query using the BrandCampiagn relation
 * @method     ChildBrandsQuery rightJoinWithBrandCampiagn() Adds a RIGHT JOIN clause and with to the query using the BrandCampiagn relation
 * @method     ChildBrandsQuery innerJoinWithBrandCampiagn() Adds a INNER JOIN clause and with to the query using the BrandCampiagn relation
 *
 * @method     ChildBrandsQuery leftJoinBrandCompetition($relationAlias = null) Adds a LEFT JOIN clause to the query using the BrandCompetition relation
 * @method     ChildBrandsQuery rightJoinBrandCompetition($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BrandCompetition relation
 * @method     ChildBrandsQuery innerJoinBrandCompetition($relationAlias = null) Adds a INNER JOIN clause to the query using the BrandCompetition relation
 *
 * @method     ChildBrandsQuery joinWithBrandCompetition($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BrandCompetition relation
 *
 * @method     ChildBrandsQuery leftJoinWithBrandCompetition() Adds a LEFT JOIN clause and with to the query using the BrandCompetition relation
 * @method     ChildBrandsQuery rightJoinWithBrandCompetition() Adds a RIGHT JOIN clause and with to the query using the BrandCompetition relation
 * @method     ChildBrandsQuery innerJoinWithBrandCompetition() Adds a INNER JOIN clause and with to the query using the BrandCompetition relation
 *
 * @method     ChildBrandsQuery leftJoinBrandRcpa($relationAlias = null) Adds a LEFT JOIN clause to the query using the BrandRcpa relation
 * @method     ChildBrandsQuery rightJoinBrandRcpa($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BrandRcpa relation
 * @method     ChildBrandsQuery innerJoinBrandRcpa($relationAlias = null) Adds a INNER JOIN clause to the query using the BrandRcpa relation
 *
 * @method     ChildBrandsQuery joinWithBrandRcpa($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BrandRcpa relation
 *
 * @method     ChildBrandsQuery leftJoinWithBrandRcpa() Adds a LEFT JOIN clause and with to the query using the BrandRcpa relation
 * @method     ChildBrandsQuery rightJoinWithBrandRcpa() Adds a RIGHT JOIN clause and with to the query using the BrandRcpa relation
 * @method     ChildBrandsQuery innerJoinWithBrandRcpa() Adds a INNER JOIN clause and with to the query using the BrandRcpa relation
 *
 * @method     ChildBrandsQuery leftJoinEdPresentations($relationAlias = null) Adds a LEFT JOIN clause to the query using the EdPresentations relation
 * @method     ChildBrandsQuery rightJoinEdPresentations($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EdPresentations relation
 * @method     ChildBrandsQuery innerJoinEdPresentations($relationAlias = null) Adds a INNER JOIN clause to the query using the EdPresentations relation
 *
 * @method     ChildBrandsQuery joinWithEdPresentations($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the EdPresentations relation
 *
 * @method     ChildBrandsQuery leftJoinWithEdPresentations() Adds a LEFT JOIN clause and with to the query using the EdPresentations relation
 * @method     ChildBrandsQuery rightJoinWithEdPresentations() Adds a RIGHT JOIN clause and with to the query using the EdPresentations relation
 * @method     ChildBrandsQuery innerJoinWithEdPresentations() Adds a INNER JOIN clause and with to the query using the EdPresentations relation
 *
 * @method     ChildBrandsQuery leftJoinEdStats($relationAlias = null) Adds a LEFT JOIN clause to the query using the EdStats relation
 * @method     ChildBrandsQuery rightJoinEdStats($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EdStats relation
 * @method     ChildBrandsQuery innerJoinEdStats($relationAlias = null) Adds a INNER JOIN clause to the query using the EdStats relation
 *
 * @method     ChildBrandsQuery joinWithEdStats($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the EdStats relation
 *
 * @method     ChildBrandsQuery leftJoinWithEdStats() Adds a LEFT JOIN clause and with to the query using the EdStats relation
 * @method     ChildBrandsQuery rightJoinWithEdStats() Adds a RIGHT JOIN clause and with to the query using the EdStats relation
 * @method     ChildBrandsQuery innerJoinWithEdStats() Adds a INNER JOIN clause and with to the query using the EdStats relation
 *
 * @method     ChildBrandsQuery leftJoinOnBoardRequestAddress($relationAlias = null) Adds a LEFT JOIN clause to the query using the OnBoardRequestAddress relation
 * @method     ChildBrandsQuery rightJoinOnBoardRequestAddress($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OnBoardRequestAddress relation
 * @method     ChildBrandsQuery innerJoinOnBoardRequestAddress($relationAlias = null) Adds a INNER JOIN clause to the query using the OnBoardRequestAddress relation
 *
 * @method     ChildBrandsQuery joinWithOnBoardRequestAddress($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OnBoardRequestAddress relation
 *
 * @method     ChildBrandsQuery leftJoinWithOnBoardRequestAddress() Adds a LEFT JOIN clause and with to the query using the OnBoardRequestAddress relation
 * @method     ChildBrandsQuery rightJoinWithOnBoardRequestAddress() Adds a RIGHT JOIN clause and with to the query using the OnBoardRequestAddress relation
 * @method     ChildBrandsQuery innerJoinWithOnBoardRequestAddress() Adds a INNER JOIN clause and with to the query using the OnBoardRequestAddress relation
 *
 * @method     ChildBrandsQuery leftJoinOutletStock($relationAlias = null) Adds a LEFT JOIN clause to the query using the OutletStock relation
 * @method     ChildBrandsQuery rightJoinOutletStock($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OutletStock relation
 * @method     ChildBrandsQuery innerJoinOutletStock($relationAlias = null) Adds a INNER JOIN clause to the query using the OutletStock relation
 *
 * @method     ChildBrandsQuery joinWithOutletStock($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OutletStock relation
 *
 * @method     ChildBrandsQuery leftJoinWithOutletStock() Adds a LEFT JOIN clause and with to the query using the OutletStock relation
 * @method     ChildBrandsQuery rightJoinWithOutletStock() Adds a RIGHT JOIN clause and with to the query using the OutletStock relation
 * @method     ChildBrandsQuery innerJoinWithOutletStock() Adds a INNER JOIN clause and with to the query using the OutletStock relation
 *
 * @method     ChildBrandsQuery leftJoinOutletStockOtherSummary($relationAlias = null) Adds a LEFT JOIN clause to the query using the OutletStockOtherSummary relation
 * @method     ChildBrandsQuery rightJoinOutletStockOtherSummary($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OutletStockOtherSummary relation
 * @method     ChildBrandsQuery innerJoinOutletStockOtherSummary($relationAlias = null) Adds a INNER JOIN clause to the query using the OutletStockOtherSummary relation
 *
 * @method     ChildBrandsQuery joinWithOutletStockOtherSummary($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OutletStockOtherSummary relation
 *
 * @method     ChildBrandsQuery leftJoinWithOutletStockOtherSummary() Adds a LEFT JOIN clause and with to the query using the OutletStockOtherSummary relation
 * @method     ChildBrandsQuery rightJoinWithOutletStockOtherSummary() Adds a RIGHT JOIN clause and with to the query using the OutletStockOtherSummary relation
 * @method     ChildBrandsQuery innerJoinWithOutletStockOtherSummary() Adds a INNER JOIN clause and with to the query using the OutletStockOtherSummary relation
 *
 * @method     ChildBrandsQuery leftJoinOutletStockSummary($relationAlias = null) Adds a LEFT JOIN clause to the query using the OutletStockSummary relation
 * @method     ChildBrandsQuery rightJoinOutletStockSummary($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OutletStockSummary relation
 * @method     ChildBrandsQuery innerJoinOutletStockSummary($relationAlias = null) Adds a INNER JOIN clause to the query using the OutletStockSummary relation
 *
 * @method     ChildBrandsQuery joinWithOutletStockSummary($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OutletStockSummary relation
 *
 * @method     ChildBrandsQuery leftJoinWithOutletStockSummary() Adds a LEFT JOIN clause and with to the query using the OutletStockSummary relation
 * @method     ChildBrandsQuery rightJoinWithOutletStockSummary() Adds a RIGHT JOIN clause and with to the query using the OutletStockSummary relation
 * @method     ChildBrandsQuery innerJoinWithOutletStockSummary() Adds a INNER JOIN clause and with to the query using the OutletStockSummary relation
 *
 * @method     ChildBrandsQuery leftJoinPrescriberData($relationAlias = null) Adds a LEFT JOIN clause to the query using the PrescriberData relation
 * @method     ChildBrandsQuery rightJoinPrescriberData($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PrescriberData relation
 * @method     ChildBrandsQuery innerJoinPrescriberData($relationAlias = null) Adds a INNER JOIN clause to the query using the PrescriberData relation
 *
 * @method     ChildBrandsQuery joinWithPrescriberData($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PrescriberData relation
 *
 * @method     ChildBrandsQuery leftJoinWithPrescriberData() Adds a LEFT JOIN clause and with to the query using the PrescriberData relation
 * @method     ChildBrandsQuery rightJoinWithPrescriberData() Adds a RIGHT JOIN clause and with to the query using the PrescriberData relation
 * @method     ChildBrandsQuery innerJoinWithPrescriberData() Adds a INNER JOIN clause and with to the query using the PrescriberData relation
 *
 * @method     ChildBrandsQuery leftJoinPrescriberTallySummary($relationAlias = null) Adds a LEFT JOIN clause to the query using the PrescriberTallySummary relation
 * @method     ChildBrandsQuery rightJoinPrescriberTallySummary($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PrescriberTallySummary relation
 * @method     ChildBrandsQuery innerJoinPrescriberTallySummary($relationAlias = null) Adds a INNER JOIN clause to the query using the PrescriberTallySummary relation
 *
 * @method     ChildBrandsQuery joinWithPrescriberTallySummary($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PrescriberTallySummary relation
 *
 * @method     ChildBrandsQuery leftJoinWithPrescriberTallySummary() Adds a LEFT JOIN clause and with to the query using the PrescriberTallySummary relation
 * @method     ChildBrandsQuery rightJoinWithPrescriberTallySummary() Adds a RIGHT JOIN clause and with to the query using the PrescriberTallySummary relation
 * @method     ChildBrandsQuery innerJoinWithPrescriberTallySummary() Adds a INNER JOIN clause and with to the query using the PrescriberTallySummary relation
 *
 * @method     ChildBrandsQuery leftJoinProducts($relationAlias = null) Adds a LEFT JOIN clause to the query using the Products relation
 * @method     ChildBrandsQuery rightJoinProducts($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Products relation
 * @method     ChildBrandsQuery innerJoinProducts($relationAlias = null) Adds a INNER JOIN clause to the query using the Products relation
 *
 * @method     ChildBrandsQuery joinWithProducts($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Products relation
 *
 * @method     ChildBrandsQuery leftJoinWithProducts() Adds a LEFT JOIN clause and with to the query using the Products relation
 * @method     ChildBrandsQuery rightJoinWithProducts() Adds a RIGHT JOIN clause and with to the query using the Products relation
 * @method     ChildBrandsQuery innerJoinWithProducts() Adds a INNER JOIN clause and with to the query using the Products relation
 *
 * @method     ChildBrandsQuery leftJoinSgpiMaster($relationAlias = null) Adds a LEFT JOIN clause to the query using the SgpiMaster relation
 * @method     ChildBrandsQuery rightJoinSgpiMaster($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SgpiMaster relation
 * @method     ChildBrandsQuery innerJoinSgpiMaster($relationAlias = null) Adds a INNER JOIN clause to the query using the SgpiMaster relation
 *
 * @method     ChildBrandsQuery joinWithSgpiMaster($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SgpiMaster relation
 *
 * @method     ChildBrandsQuery leftJoinWithSgpiMaster() Adds a LEFT JOIN clause and with to the query using the SgpiMaster relation
 * @method     ChildBrandsQuery rightJoinWithSgpiMaster() Adds a RIGHT JOIN clause and with to the query using the SgpiMaster relation
 * @method     ChildBrandsQuery innerJoinWithSgpiMaster() Adds a INNER JOIN clause and with to the query using the SgpiMaster relation
 *
 * @method     \entities\OrgUnitQuery|\entities\CompanyQuery|\entities\BrandCampiagnQuery|\entities\BrandCompetitionQuery|\entities\BrandRcpaQuery|\entities\EdPresentationsQuery|\entities\EdStatsQuery|\entities\OnBoardRequestAddressQuery|\entities\OutletStockQuery|\entities\OutletStockOtherSummaryQuery|\entities\OutletStockSummaryQuery|\entities\PrescriberDataQuery|\entities\PrescriberTallySummaryQuery|\entities\ProductsQuery|\entities\SgpiMasterQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildBrands|null findOne(?ConnectionInterface $con = null) Return the first ChildBrands matching the query
 * @method     ChildBrands findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildBrands matching the query, or a new ChildBrands object populated from the query conditions when no match is found
 *
 * @method     ChildBrands|null findOneByBrandId(int $brand_id) Return the first ChildBrands filtered by the brand_id column
 * @method     ChildBrands|null findOneByBrandName(string $brand_name) Return the first ChildBrands filtered by the brand_name column
 * @method     ChildBrands|null findOneByOrgunitid(int $orgunitid) Return the first ChildBrands filtered by the orgunitid column
 * @method     ChildBrands|null findOneByCompanyId(int $company_id) Return the first ChildBrands filtered by the company_id column
 * @method     ChildBrands|null findOneByCreatedAt(string $created_at) Return the first ChildBrands filtered by the created_at column
 * @method     ChildBrands|null findOneByUpdatedAt(string $updated_at) Return the first ChildBrands filtered by the updated_at column
 * @method     ChildBrands|null findOneByBrandCode(string $brand_code) Return the first ChildBrands filtered by the brand_code column
 * @method     ChildBrands|null findOneByBrandRate(string $brand_rate) Return the first ChildBrands filtered by the brand_rate column
 * @method     ChildBrands|null findOneByMinValue(int $min_value) Return the first ChildBrands filtered by the min_value column
 *
 * @method     ChildBrands requirePk($key, ?ConnectionInterface $con = null) Return the ChildBrands by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrands requireOne(?ConnectionInterface $con = null) Return the first ChildBrands matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBrands requireOneByBrandId(int $brand_id) Return the first ChildBrands filtered by the brand_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrands requireOneByBrandName(string $brand_name) Return the first ChildBrands filtered by the brand_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrands requireOneByOrgunitid(int $orgunitid) Return the first ChildBrands filtered by the orgunitid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrands requireOneByCompanyId(int $company_id) Return the first ChildBrands filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrands requireOneByCreatedAt(string $created_at) Return the first ChildBrands filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrands requireOneByUpdatedAt(string $updated_at) Return the first ChildBrands filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrands requireOneByBrandCode(string $brand_code) Return the first ChildBrands filtered by the brand_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrands requireOneByBrandRate(string $brand_rate) Return the first ChildBrands filtered by the brand_rate column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrands requireOneByMinValue(int $min_value) Return the first ChildBrands filtered by the min_value column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBrands[]|Collection find(?ConnectionInterface $con = null) Return ChildBrands objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildBrands> find(?ConnectionInterface $con = null) Return ChildBrands objects based on current ModelCriteria
 *
 * @method     ChildBrands[]|Collection findByBrandId(int|array<int> $brand_id) Return ChildBrands objects filtered by the brand_id column
 * @psalm-method Collection&\Traversable<ChildBrands> findByBrandId(int|array<int> $brand_id) Return ChildBrands objects filtered by the brand_id column
 * @method     ChildBrands[]|Collection findByBrandName(string|array<string> $brand_name) Return ChildBrands objects filtered by the brand_name column
 * @psalm-method Collection&\Traversable<ChildBrands> findByBrandName(string|array<string> $brand_name) Return ChildBrands objects filtered by the brand_name column
 * @method     ChildBrands[]|Collection findByOrgunitid(int|array<int> $orgunitid) Return ChildBrands objects filtered by the orgunitid column
 * @psalm-method Collection&\Traversable<ChildBrands> findByOrgunitid(int|array<int> $orgunitid) Return ChildBrands objects filtered by the orgunitid column
 * @method     ChildBrands[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildBrands objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildBrands> findByCompanyId(int|array<int> $company_id) Return ChildBrands objects filtered by the company_id column
 * @method     ChildBrands[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildBrands objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildBrands> findByCreatedAt(string|array<string> $created_at) Return ChildBrands objects filtered by the created_at column
 * @method     ChildBrands[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildBrands objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildBrands> findByUpdatedAt(string|array<string> $updated_at) Return ChildBrands objects filtered by the updated_at column
 * @method     ChildBrands[]|Collection findByBrandCode(string|array<string> $brand_code) Return ChildBrands objects filtered by the brand_code column
 * @psalm-method Collection&\Traversable<ChildBrands> findByBrandCode(string|array<string> $brand_code) Return ChildBrands objects filtered by the brand_code column
 * @method     ChildBrands[]|Collection findByBrandRate(string|array<string> $brand_rate) Return ChildBrands objects filtered by the brand_rate column
 * @psalm-method Collection&\Traversable<ChildBrands> findByBrandRate(string|array<string> $brand_rate) Return ChildBrands objects filtered by the brand_rate column
 * @method     ChildBrands[]|Collection findByMinValue(int|array<int> $min_value) Return ChildBrands objects filtered by the min_value column
 * @psalm-method Collection&\Traversable<ChildBrands> findByMinValue(int|array<int> $min_value) Return ChildBrands objects filtered by the min_value column
 *
 * @method     ChildBrands[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildBrands> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class BrandsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\BrandsQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\Brands', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildBrandsQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildBrandsQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildBrandsQuery) {
            return $criteria;
        }
        $query = new ChildBrandsQuery();
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
     * @return ChildBrands|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(BrandsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = BrandsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildBrands A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT brand_id, brand_name, orgunitid, company_id, created_at, updated_at, brand_code, brand_rate, min_value FROM brands WHERE brand_id = :p0';
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
            /** @var ChildBrands $obj */
            $obj = new ChildBrands();
            $obj->hydrate($row);
            BrandsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildBrands|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(BrandsTableMap::COL_BRAND_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(BrandsTableMap::COL_BRAND_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(BrandsTableMap::COL_BRAND_ID, $brandId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($brandId['max'])) {
                $this->addUsingAlias(BrandsTableMap::COL_BRAND_ID, $brandId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandsTableMap::COL_BRAND_ID, $brandId, $comparison);

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

        $this->addUsingAlias(BrandsTableMap::COL_BRAND_NAME, $brandName, $comparison);

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
                $this->addUsingAlias(BrandsTableMap::COL_ORGUNITID, $orgunitid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($orgunitid['max'])) {
                $this->addUsingAlias(BrandsTableMap::COL_ORGUNITID, $orgunitid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandsTableMap::COL_ORGUNITID, $orgunitid, $comparison);

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
                $this->addUsingAlias(BrandsTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(BrandsTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandsTableMap::COL_COMPANY_ID, $companyId, $comparison);

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
                $this->addUsingAlias(BrandsTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(BrandsTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandsTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(BrandsTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(BrandsTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandsTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the brand_code column
     *
     * Example usage:
     * <code>
     * $query->filterByBrandCode('fooValue');   // WHERE brand_code = 'fooValue'
     * $query->filterByBrandCode('%fooValue%', Criteria::LIKE); // WHERE brand_code LIKE '%fooValue%'
     * $query->filterByBrandCode(['foo', 'bar']); // WHERE brand_code IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $brandCode The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBrandCode($brandCode = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($brandCode)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandsTableMap::COL_BRAND_CODE, $brandCode, $comparison);

        return $this;
    }

    /**
     * Filter the query on the brand_rate column
     *
     * Example usage:
     * <code>
     * $query->filterByBrandRate(1234); // WHERE brand_rate = 1234
     * $query->filterByBrandRate(array(12, 34)); // WHERE brand_rate IN (12, 34)
     * $query->filterByBrandRate(array('min' => 12)); // WHERE brand_rate > 12
     * </code>
     *
     * @param mixed $brandRate The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBrandRate($brandRate = null, ?string $comparison = null)
    {
        if (is_array($brandRate)) {
            $useMinMax = false;
            if (isset($brandRate['min'])) {
                $this->addUsingAlias(BrandsTableMap::COL_BRAND_RATE, $brandRate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($brandRate['max'])) {
                $this->addUsingAlias(BrandsTableMap::COL_BRAND_RATE, $brandRate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandsTableMap::COL_BRAND_RATE, $brandRate, $comparison);

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
                $this->addUsingAlias(BrandsTableMap::COL_MIN_VALUE, $minValue['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($minValue['max'])) {
                $this->addUsingAlias(BrandsTableMap::COL_MIN_VALUE, $minValue['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandsTableMap::COL_MIN_VALUE, $minValue, $comparison);

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
                ->addUsingAlias(BrandsTableMap::COL_ORGUNITID, $orgUnit->getOrgunitid(), $comparison);
        } elseif ($orgUnit instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(BrandsTableMap::COL_ORGUNITID, $orgUnit->toKeyValue('PrimaryKey', 'Orgunitid'), $comparison);

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
                ->addUsingAlias(BrandsTableMap::COL_COMPANY_ID, $company->getCompanyId(), $comparison);
        } elseif ($company instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(BrandsTableMap::COL_COMPANY_ID, $company->toKeyValue('PrimaryKey', 'CompanyId'), $comparison);

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
     * Filter the query by a related \entities\BrandCampiagn object
     *
     * @param \entities\BrandCampiagn|ObjectCollection $brandCampiagn the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBrandCampiagn($brandCampiagn, ?string $comparison = null)
    {
        if ($brandCampiagn instanceof \entities\BrandCampiagn) {
            $this
                ->addUsingAlias(BrandsTableMap::COL_BRAND_ID, $brandCampiagn->getFocusBrandId(), $comparison);

            return $this;
        } elseif ($brandCampiagn instanceof ObjectCollection) {
            $this
                ->useBrandCampiagnQuery()
                ->filterByPrimaryKeys($brandCampiagn->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByBrandCampiagn() only accepts arguments of type \entities\BrandCampiagn or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BrandCampiagn relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinBrandCampiagn(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BrandCampiagn');

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
            $this->addJoinObject($join, 'BrandCampiagn');
        }

        return $this;
    }

    /**
     * Use the BrandCampiagn relation BrandCampiagn object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\BrandCampiagnQuery A secondary query class using the current class as primary query
     */
    public function useBrandCampiagnQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinBrandCampiagn($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BrandCampiagn', '\entities\BrandCampiagnQuery');
    }

    /**
     * Use the BrandCampiagn relation BrandCampiagn object
     *
     * @param callable(\entities\BrandCampiagnQuery):\entities\BrandCampiagnQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withBrandCampiagnQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useBrandCampiagnQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to BrandCampiagn table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\BrandCampiagnQuery The inner query object of the EXISTS statement
     */
    public function useBrandCampiagnExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\BrandCampiagnQuery */
        $q = $this->useExistsQuery('BrandCampiagn', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to BrandCampiagn table for a NOT EXISTS query.
     *
     * @see useBrandCampiagnExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\BrandCampiagnQuery The inner query object of the NOT EXISTS statement
     */
    public function useBrandCampiagnNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\BrandCampiagnQuery */
        $q = $this->useExistsQuery('BrandCampiagn', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to BrandCampiagn table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\BrandCampiagnQuery The inner query object of the IN statement
     */
    public function useInBrandCampiagnQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\BrandCampiagnQuery */
        $q = $this->useInQuery('BrandCampiagn', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to BrandCampiagn table for a NOT IN query.
     *
     * @see useBrandCampiagnInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\BrandCampiagnQuery The inner query object of the NOT IN statement
     */
    public function useNotInBrandCampiagnQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\BrandCampiagnQuery */
        $q = $this->useInQuery('BrandCampiagn', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\BrandCompetition object
     *
     * @param \entities\BrandCompetition|ObjectCollection $brandCompetition the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBrandCompetition($brandCompetition, ?string $comparison = null)
    {
        if ($brandCompetition instanceof \entities\BrandCompetition) {
            $this
                ->addUsingAlias(BrandsTableMap::COL_BRAND_ID, $brandCompetition->getCompetitorBrandId(), $comparison);

            return $this;
        } elseif ($brandCompetition instanceof ObjectCollection) {
            $this
                ->useBrandCompetitionQuery()
                ->filterByPrimaryKeys($brandCompetition->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByBrandCompetition() only accepts arguments of type \entities\BrandCompetition or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BrandCompetition relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinBrandCompetition(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BrandCompetition');

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
            $this->addJoinObject($join, 'BrandCompetition');
        }

        return $this;
    }

    /**
     * Use the BrandCompetition relation BrandCompetition object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\BrandCompetitionQuery A secondary query class using the current class as primary query
     */
    public function useBrandCompetitionQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinBrandCompetition($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BrandCompetition', '\entities\BrandCompetitionQuery');
    }

    /**
     * Use the BrandCompetition relation BrandCompetition object
     *
     * @param callable(\entities\BrandCompetitionQuery):\entities\BrandCompetitionQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withBrandCompetitionQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useBrandCompetitionQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to BrandCompetition table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\BrandCompetitionQuery The inner query object of the EXISTS statement
     */
    public function useBrandCompetitionExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\BrandCompetitionQuery */
        $q = $this->useExistsQuery('BrandCompetition', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to BrandCompetition table for a NOT EXISTS query.
     *
     * @see useBrandCompetitionExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\BrandCompetitionQuery The inner query object of the NOT EXISTS statement
     */
    public function useBrandCompetitionNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\BrandCompetitionQuery */
        $q = $this->useExistsQuery('BrandCompetition', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to BrandCompetition table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\BrandCompetitionQuery The inner query object of the IN statement
     */
    public function useInBrandCompetitionQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\BrandCompetitionQuery */
        $q = $this->useInQuery('BrandCompetition', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to BrandCompetition table for a NOT IN query.
     *
     * @see useBrandCompetitionInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\BrandCompetitionQuery The inner query object of the NOT IN statement
     */
    public function useNotInBrandCompetitionQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\BrandCompetitionQuery */
        $q = $this->useInQuery('BrandCompetition', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\BrandRcpa object
     *
     * @param \entities\BrandRcpa|ObjectCollection $brandRcpa the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBrandRcpa($brandRcpa, ?string $comparison = null)
    {
        if ($brandRcpa instanceof \entities\BrandRcpa) {
            $this
                ->addUsingAlias(BrandsTableMap::COL_BRAND_ID, $brandRcpa->getBrandId(), $comparison);

            return $this;
        } elseif ($brandRcpa instanceof ObjectCollection) {
            $this
                ->useBrandRcpaQuery()
                ->filterByPrimaryKeys($brandRcpa->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByBrandRcpa() only accepts arguments of type \entities\BrandRcpa or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BrandRcpa relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinBrandRcpa(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BrandRcpa');

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
            $this->addJoinObject($join, 'BrandRcpa');
        }

        return $this;
    }

    /**
     * Use the BrandRcpa relation BrandRcpa object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\BrandRcpaQuery A secondary query class using the current class as primary query
     */
    public function useBrandRcpaQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinBrandRcpa($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BrandRcpa', '\entities\BrandRcpaQuery');
    }

    /**
     * Use the BrandRcpa relation BrandRcpa object
     *
     * @param callable(\entities\BrandRcpaQuery):\entities\BrandRcpaQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withBrandRcpaQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useBrandRcpaQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to BrandRcpa table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\BrandRcpaQuery The inner query object of the EXISTS statement
     */
    public function useBrandRcpaExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\BrandRcpaQuery */
        $q = $this->useExistsQuery('BrandRcpa', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to BrandRcpa table for a NOT EXISTS query.
     *
     * @see useBrandRcpaExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\BrandRcpaQuery The inner query object of the NOT EXISTS statement
     */
    public function useBrandRcpaNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\BrandRcpaQuery */
        $q = $this->useExistsQuery('BrandRcpa', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to BrandRcpa table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\BrandRcpaQuery The inner query object of the IN statement
     */
    public function useInBrandRcpaQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\BrandRcpaQuery */
        $q = $this->useInQuery('BrandRcpa', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to BrandRcpa table for a NOT IN query.
     *
     * @see useBrandRcpaInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\BrandRcpaQuery The inner query object of the NOT IN statement
     */
    public function useNotInBrandRcpaQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\BrandRcpaQuery */
        $q = $this->useInQuery('BrandRcpa', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\EdPresentations object
     *
     * @param \entities\EdPresentations|ObjectCollection $edPresentations the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEdPresentations($edPresentations, ?string $comparison = null)
    {
        if ($edPresentations instanceof \entities\EdPresentations) {
            $this
                ->addUsingAlias(BrandsTableMap::COL_BRAND_ID, $edPresentations->getBrandId(), $comparison);

            return $this;
        } elseif ($edPresentations instanceof ObjectCollection) {
            $this
                ->useEdPresentationsQuery()
                ->filterByPrimaryKeys($edPresentations->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByEdPresentations() only accepts arguments of type \entities\EdPresentations or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the EdPresentations relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinEdPresentations(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('EdPresentations');

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
            $this->addJoinObject($join, 'EdPresentations');
        }

        return $this;
    }

    /**
     * Use the EdPresentations relation EdPresentations object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\EdPresentationsQuery A secondary query class using the current class as primary query
     */
    public function useEdPresentationsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinEdPresentations($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'EdPresentations', '\entities\EdPresentationsQuery');
    }

    /**
     * Use the EdPresentations relation EdPresentations object
     *
     * @param callable(\entities\EdPresentationsQuery):\entities\EdPresentationsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withEdPresentationsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useEdPresentationsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to EdPresentations table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\EdPresentationsQuery The inner query object of the EXISTS statement
     */
    public function useEdPresentationsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\EdPresentationsQuery */
        $q = $this->useExistsQuery('EdPresentations', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to EdPresentations table for a NOT EXISTS query.
     *
     * @see useEdPresentationsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\EdPresentationsQuery The inner query object of the NOT EXISTS statement
     */
    public function useEdPresentationsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\EdPresentationsQuery */
        $q = $this->useExistsQuery('EdPresentations', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to EdPresentations table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\EdPresentationsQuery The inner query object of the IN statement
     */
    public function useInEdPresentationsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\EdPresentationsQuery */
        $q = $this->useInQuery('EdPresentations', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to EdPresentations table for a NOT IN query.
     *
     * @see useEdPresentationsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\EdPresentationsQuery The inner query object of the NOT IN statement
     */
    public function useNotInEdPresentationsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\EdPresentationsQuery */
        $q = $this->useInQuery('EdPresentations', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\EdStats object
     *
     * @param \entities\EdStats|ObjectCollection $edStats the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEdStats($edStats, ?string $comparison = null)
    {
        if ($edStats instanceof \entities\EdStats) {
            $this
                ->addUsingAlias(BrandsTableMap::COL_BRAND_ID, $edStats->getBrandId(), $comparison);

            return $this;
        } elseif ($edStats instanceof ObjectCollection) {
            $this
                ->useEdStatsQuery()
                ->filterByPrimaryKeys($edStats->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByEdStats() only accepts arguments of type \entities\EdStats or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the EdStats relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinEdStats(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('EdStats');

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
            $this->addJoinObject($join, 'EdStats');
        }

        return $this;
    }

    /**
     * Use the EdStats relation EdStats object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\EdStatsQuery A secondary query class using the current class as primary query
     */
    public function useEdStatsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinEdStats($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'EdStats', '\entities\EdStatsQuery');
    }

    /**
     * Use the EdStats relation EdStats object
     *
     * @param callable(\entities\EdStatsQuery):\entities\EdStatsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withEdStatsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useEdStatsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to EdStats table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\EdStatsQuery The inner query object of the EXISTS statement
     */
    public function useEdStatsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\EdStatsQuery */
        $q = $this->useExistsQuery('EdStats', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to EdStats table for a NOT EXISTS query.
     *
     * @see useEdStatsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\EdStatsQuery The inner query object of the NOT EXISTS statement
     */
    public function useEdStatsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\EdStatsQuery */
        $q = $this->useExistsQuery('EdStats', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to EdStats table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\EdStatsQuery The inner query object of the IN statement
     */
    public function useInEdStatsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\EdStatsQuery */
        $q = $this->useInQuery('EdStats', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to EdStats table for a NOT IN query.
     *
     * @see useEdStatsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\EdStatsQuery The inner query object of the NOT IN statement
     */
    public function useNotInEdStatsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\EdStatsQuery */
        $q = $this->useInQuery('EdStats', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(BrandsTableMap::COL_BRAND_ID, $onBoardRequestAddress->getFocusBrand(), $comparison);

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
     * Filter the query by a related \entities\OutletStock object
     *
     * @param \entities\OutletStock|ObjectCollection $outletStock the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletStock($outletStock, ?string $comparison = null)
    {
        if ($outletStock instanceof \entities\OutletStock) {
            $this
                ->addUsingAlias(BrandsTableMap::COL_BRAND_ID, $outletStock->getBrandId(), $comparison);

            return $this;
        } elseif ($outletStock instanceof ObjectCollection) {
            $this
                ->useOutletStockQuery()
                ->filterByPrimaryKeys($outletStock->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByOutletStock() only accepts arguments of type \entities\OutletStock or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OutletStock relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOutletStock(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OutletStock');

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
            $this->addJoinObject($join, 'OutletStock');
        }

        return $this;
    }

    /**
     * Use the OutletStock relation OutletStock object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\OutletStockQuery A secondary query class using the current class as primary query
     */
    public function useOutletStockQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinOutletStock($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OutletStock', '\entities\OutletStockQuery');
    }

    /**
     * Use the OutletStock relation OutletStock object
     *
     * @param callable(\entities\OutletStockQuery):\entities\OutletStockQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOutletStockQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useOutletStockQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to OutletStock table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\OutletStockQuery The inner query object of the EXISTS statement
     */
    public function useOutletStockExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\OutletStockQuery */
        $q = $this->useExistsQuery('OutletStock', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to OutletStock table for a NOT EXISTS query.
     *
     * @see useOutletStockExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\OutletStockQuery The inner query object of the NOT EXISTS statement
     */
    public function useOutletStockNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OutletStockQuery */
        $q = $this->useExistsQuery('OutletStock', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to OutletStock table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\OutletStockQuery The inner query object of the IN statement
     */
    public function useInOutletStockQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\OutletStockQuery */
        $q = $this->useInQuery('OutletStock', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to OutletStock table for a NOT IN query.
     *
     * @see useOutletStockInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\OutletStockQuery The inner query object of the NOT IN statement
     */
    public function useNotInOutletStockQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OutletStockQuery */
        $q = $this->useInQuery('OutletStock', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\OutletStockOtherSummary object
     *
     * @param \entities\OutletStockOtherSummary|ObjectCollection $outletStockOtherSummary the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletStockOtherSummary($outletStockOtherSummary, ?string $comparison = null)
    {
        if ($outletStockOtherSummary instanceof \entities\OutletStockOtherSummary) {
            $this
                ->addUsingAlias(BrandsTableMap::COL_BRAND_ID, $outletStockOtherSummary->getBrandId(), $comparison);

            return $this;
        } elseif ($outletStockOtherSummary instanceof ObjectCollection) {
            $this
                ->useOutletStockOtherSummaryQuery()
                ->filterByPrimaryKeys($outletStockOtherSummary->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByOutletStockOtherSummary() only accepts arguments of type \entities\OutletStockOtherSummary or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OutletStockOtherSummary relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOutletStockOtherSummary(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OutletStockOtherSummary');

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
            $this->addJoinObject($join, 'OutletStockOtherSummary');
        }

        return $this;
    }

    /**
     * Use the OutletStockOtherSummary relation OutletStockOtherSummary object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\OutletStockOtherSummaryQuery A secondary query class using the current class as primary query
     */
    public function useOutletStockOtherSummaryQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinOutletStockOtherSummary($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OutletStockOtherSummary', '\entities\OutletStockOtherSummaryQuery');
    }

    /**
     * Use the OutletStockOtherSummary relation OutletStockOtherSummary object
     *
     * @param callable(\entities\OutletStockOtherSummaryQuery):\entities\OutletStockOtherSummaryQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOutletStockOtherSummaryQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useOutletStockOtherSummaryQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to OutletStockOtherSummary table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\OutletStockOtherSummaryQuery The inner query object of the EXISTS statement
     */
    public function useOutletStockOtherSummaryExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\OutletStockOtherSummaryQuery */
        $q = $this->useExistsQuery('OutletStockOtherSummary', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to OutletStockOtherSummary table for a NOT EXISTS query.
     *
     * @see useOutletStockOtherSummaryExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\OutletStockOtherSummaryQuery The inner query object of the NOT EXISTS statement
     */
    public function useOutletStockOtherSummaryNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OutletStockOtherSummaryQuery */
        $q = $this->useExistsQuery('OutletStockOtherSummary', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to OutletStockOtherSummary table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\OutletStockOtherSummaryQuery The inner query object of the IN statement
     */
    public function useInOutletStockOtherSummaryQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\OutletStockOtherSummaryQuery */
        $q = $this->useInQuery('OutletStockOtherSummary', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to OutletStockOtherSummary table for a NOT IN query.
     *
     * @see useOutletStockOtherSummaryInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\OutletStockOtherSummaryQuery The inner query object of the NOT IN statement
     */
    public function useNotInOutletStockOtherSummaryQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OutletStockOtherSummaryQuery */
        $q = $this->useInQuery('OutletStockOtherSummary', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\OutletStockSummary object
     *
     * @param \entities\OutletStockSummary|ObjectCollection $outletStockSummary the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletStockSummary($outletStockSummary, ?string $comparison = null)
    {
        if ($outletStockSummary instanceof \entities\OutletStockSummary) {
            $this
                ->addUsingAlias(BrandsTableMap::COL_BRAND_ID, $outletStockSummary->getBrandId(), $comparison);

            return $this;
        } elseif ($outletStockSummary instanceof ObjectCollection) {
            $this
                ->useOutletStockSummaryQuery()
                ->filterByPrimaryKeys($outletStockSummary->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByOutletStockSummary() only accepts arguments of type \entities\OutletStockSummary or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OutletStockSummary relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOutletStockSummary(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OutletStockSummary');

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
            $this->addJoinObject($join, 'OutletStockSummary');
        }

        return $this;
    }

    /**
     * Use the OutletStockSummary relation OutletStockSummary object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\OutletStockSummaryQuery A secondary query class using the current class as primary query
     */
    public function useOutletStockSummaryQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinOutletStockSummary($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OutletStockSummary', '\entities\OutletStockSummaryQuery');
    }

    /**
     * Use the OutletStockSummary relation OutletStockSummary object
     *
     * @param callable(\entities\OutletStockSummaryQuery):\entities\OutletStockSummaryQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOutletStockSummaryQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useOutletStockSummaryQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to OutletStockSummary table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\OutletStockSummaryQuery The inner query object of the EXISTS statement
     */
    public function useOutletStockSummaryExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\OutletStockSummaryQuery */
        $q = $this->useExistsQuery('OutletStockSummary', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to OutletStockSummary table for a NOT EXISTS query.
     *
     * @see useOutletStockSummaryExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\OutletStockSummaryQuery The inner query object of the NOT EXISTS statement
     */
    public function useOutletStockSummaryNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OutletStockSummaryQuery */
        $q = $this->useExistsQuery('OutletStockSummary', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to OutletStockSummary table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\OutletStockSummaryQuery The inner query object of the IN statement
     */
    public function useInOutletStockSummaryQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\OutletStockSummaryQuery */
        $q = $this->useInQuery('OutletStockSummary', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to OutletStockSummary table for a NOT IN query.
     *
     * @see useOutletStockSummaryInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\OutletStockSummaryQuery The inner query object of the NOT IN statement
     */
    public function useNotInOutletStockSummaryQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OutletStockSummaryQuery */
        $q = $this->useInQuery('OutletStockSummary', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\PrescriberData object
     *
     * @param \entities\PrescriberData|ObjectCollection $prescriberData the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrescriberData($prescriberData, ?string $comparison = null)
    {
        if ($prescriberData instanceof \entities\PrescriberData) {
            $this
                ->addUsingAlias(BrandsTableMap::COL_BRAND_ID, $prescriberData->getBrandId(), $comparison);

            return $this;
        } elseif ($prescriberData instanceof ObjectCollection) {
            $this
                ->usePrescriberDataQuery()
                ->filterByPrimaryKeys($prescriberData->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByPrescriberData() only accepts arguments of type \entities\PrescriberData or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PrescriberData relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinPrescriberData(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PrescriberData');

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
            $this->addJoinObject($join, 'PrescriberData');
        }

        return $this;
    }

    /**
     * Use the PrescriberData relation PrescriberData object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\PrescriberDataQuery A secondary query class using the current class as primary query
     */
    public function usePrescriberDataQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPrescriberData($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PrescriberData', '\entities\PrescriberDataQuery');
    }

    /**
     * Use the PrescriberData relation PrescriberData object
     *
     * @param callable(\entities\PrescriberDataQuery):\entities\PrescriberDataQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withPrescriberDataQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->usePrescriberDataQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to PrescriberData table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\PrescriberDataQuery The inner query object of the EXISTS statement
     */
    public function usePrescriberDataExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\PrescriberDataQuery */
        $q = $this->useExistsQuery('PrescriberData', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to PrescriberData table for a NOT EXISTS query.
     *
     * @see usePrescriberDataExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\PrescriberDataQuery The inner query object of the NOT EXISTS statement
     */
    public function usePrescriberDataNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\PrescriberDataQuery */
        $q = $this->useExistsQuery('PrescriberData', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to PrescriberData table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\PrescriberDataQuery The inner query object of the IN statement
     */
    public function useInPrescriberDataQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\PrescriberDataQuery */
        $q = $this->useInQuery('PrescriberData', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to PrescriberData table for a NOT IN query.
     *
     * @see usePrescriberDataInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\PrescriberDataQuery The inner query object of the NOT IN statement
     */
    public function useNotInPrescriberDataQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\PrescriberDataQuery */
        $q = $this->useInQuery('PrescriberData', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\PrescriberTallySummary object
     *
     * @param \entities\PrescriberTallySummary|ObjectCollection $prescriberTallySummary the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrescriberTallySummary($prescriberTallySummary, ?string $comparison = null)
    {
        if ($prescriberTallySummary instanceof \entities\PrescriberTallySummary) {
            $this
                ->addUsingAlias(BrandsTableMap::COL_BRAND_ID, $prescriberTallySummary->getBrandId(), $comparison);

            return $this;
        } elseif ($prescriberTallySummary instanceof ObjectCollection) {
            $this
                ->usePrescriberTallySummaryQuery()
                ->filterByPrimaryKeys($prescriberTallySummary->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByPrescriberTallySummary() only accepts arguments of type \entities\PrescriberTallySummary or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PrescriberTallySummary relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinPrescriberTallySummary(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PrescriberTallySummary');

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
            $this->addJoinObject($join, 'PrescriberTallySummary');
        }

        return $this;
    }

    /**
     * Use the PrescriberTallySummary relation PrescriberTallySummary object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\PrescriberTallySummaryQuery A secondary query class using the current class as primary query
     */
    public function usePrescriberTallySummaryQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPrescriberTallySummary($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PrescriberTallySummary', '\entities\PrescriberTallySummaryQuery');
    }

    /**
     * Use the PrescriberTallySummary relation PrescriberTallySummary object
     *
     * @param callable(\entities\PrescriberTallySummaryQuery):\entities\PrescriberTallySummaryQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withPrescriberTallySummaryQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->usePrescriberTallySummaryQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to PrescriberTallySummary table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\PrescriberTallySummaryQuery The inner query object of the EXISTS statement
     */
    public function usePrescriberTallySummaryExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\PrescriberTallySummaryQuery */
        $q = $this->useExistsQuery('PrescriberTallySummary', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to PrescriberTallySummary table for a NOT EXISTS query.
     *
     * @see usePrescriberTallySummaryExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\PrescriberTallySummaryQuery The inner query object of the NOT EXISTS statement
     */
    public function usePrescriberTallySummaryNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\PrescriberTallySummaryQuery */
        $q = $this->useExistsQuery('PrescriberTallySummary', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to PrescriberTallySummary table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\PrescriberTallySummaryQuery The inner query object of the IN statement
     */
    public function useInPrescriberTallySummaryQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\PrescriberTallySummaryQuery */
        $q = $this->useInQuery('PrescriberTallySummary', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to PrescriberTallySummary table for a NOT IN query.
     *
     * @see usePrescriberTallySummaryInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\PrescriberTallySummaryQuery The inner query object of the NOT IN statement
     */
    public function useNotInPrescriberTallySummaryQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\PrescriberTallySummaryQuery */
        $q = $this->useInQuery('PrescriberTallySummary', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\Products object
     *
     * @param \entities\Products|ObjectCollection $products the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProducts($products, ?string $comparison = null)
    {
        if ($products instanceof \entities\Products) {
            $this
                ->addUsingAlias(BrandsTableMap::COL_BRAND_ID, $products->getBrandId(), $comparison);

            return $this;
        } elseif ($products instanceof ObjectCollection) {
            $this
                ->useProductsQuery()
                ->filterByPrimaryKeys($products->getPrimaryKeys())
                ->endUse();

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
    public function joinProducts(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
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
    public function useProductsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
        ?string $joinType = Criteria::LEFT_JOIN
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
     * Filter the query by a related \entities\SgpiMaster object
     *
     * @param \entities\SgpiMaster|ObjectCollection $sgpiMaster the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySgpiMaster($sgpiMaster, ?string $comparison = null)
    {
        if ($sgpiMaster instanceof \entities\SgpiMaster) {
            $this
                ->addUsingAlias(BrandsTableMap::COL_BRAND_ID, $sgpiMaster->getBrandId(), $comparison);

            return $this;
        } elseif ($sgpiMaster instanceof ObjectCollection) {
            $this
                ->useSgpiMasterQuery()
                ->filterByPrimaryKeys($sgpiMaster->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySgpiMaster() only accepts arguments of type \entities\SgpiMaster or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SgpiMaster relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSgpiMaster(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SgpiMaster');

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
            $this->addJoinObject($join, 'SgpiMaster');
        }

        return $this;
    }

    /**
     * Use the SgpiMaster relation SgpiMaster object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\SgpiMasterQuery A secondary query class using the current class as primary query
     */
    public function useSgpiMasterQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSgpiMaster($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SgpiMaster', '\entities\SgpiMasterQuery');
    }

    /**
     * Use the SgpiMaster relation SgpiMaster object
     *
     * @param callable(\entities\SgpiMasterQuery):\entities\SgpiMasterQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSgpiMasterQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useSgpiMasterQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SgpiMaster table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\SgpiMasterQuery The inner query object of the EXISTS statement
     */
    public function useSgpiMasterExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\SgpiMasterQuery */
        $q = $this->useExistsQuery('SgpiMaster', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SgpiMaster table for a NOT EXISTS query.
     *
     * @see useSgpiMasterExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\SgpiMasterQuery The inner query object of the NOT EXISTS statement
     */
    public function useSgpiMasterNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\SgpiMasterQuery */
        $q = $this->useExistsQuery('SgpiMaster', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SgpiMaster table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\SgpiMasterQuery The inner query object of the IN statement
     */
    public function useInSgpiMasterQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\SgpiMasterQuery */
        $q = $this->useInQuery('SgpiMaster', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SgpiMaster table for a NOT IN query.
     *
     * @see useSgpiMasterInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\SgpiMasterQuery The inner query object of the NOT IN statement
     */
    public function useNotInSgpiMasterQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\SgpiMasterQuery */
        $q = $this->useInQuery('SgpiMaster', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildBrands $brands Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($brands = null)
    {
        if ($brands) {
            $this->addUsingAlias(BrandsTableMap::COL_BRAND_ID, $brands->getBrandId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the brands table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(BrandsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            BrandsTableMap::clearInstancePool();
            BrandsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(BrandsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(BrandsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            BrandsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            BrandsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
