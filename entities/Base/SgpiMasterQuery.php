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
use entities\SgpiMaster as ChildSgpiMaster;
use entities\SgpiMasterQuery as ChildSgpiMasterQuery;
use entities\Map\SgpiMasterTableMap;

/**
 * Base class that represents a query for the `sgpi_master` table.
 *
 * @method     ChildSgpiMasterQuery orderBySgpiId($order = Criteria::ASC) Order by the sgpi_id column
 * @method     ChildSgpiMasterQuery orderBySgpiName($order = Criteria::ASC) Order by the sgpi_name column
 * @method     ChildSgpiMasterQuery orderBySgpiCode($order = Criteria::ASC) Order by the sgpi_code column
 * @method     ChildSgpiMasterQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildSgpiMasterQuery orderBySgpiStatus($order = Criteria::ASC) Order by the sgpi_status column
 * @method     ChildSgpiMasterQuery orderBySgpiMedia($order = Criteria::ASC) Order by the sgpi_media column
 * @method     ChildSgpiMasterQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildSgpiMasterQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildSgpiMasterQuery orderByMaterialSku($order = Criteria::ASC) Order by the material_sku column
 * @method     ChildSgpiMasterQuery orderBySgpiType($order = Criteria::ASC) Order by the sgpi_type column
 * @method     ChildSgpiMasterQuery orderByUseStartDate($order = Criteria::ASC) Order by the use_start_date column
 * @method     ChildSgpiMasterQuery orderByUseEndDate($order = Criteria::ASC) Order by the use_end_date column
 * @method     ChildSgpiMasterQuery orderByOrgUnitId($order = Criteria::ASC) Order by the org_unit_id column
 * @method     ChildSgpiMasterQuery orderByBrandId($order = Criteria::ASC) Order by the brand_id column
 * @method     ChildSgpiMasterQuery orderByMaxQty($order = Criteria::ASC) Order by the max_qty column
 * @method     ChildSgpiMasterQuery orderByOutlettypeId($order = Criteria::ASC) Order by the outlettype_id column
 * @method     ChildSgpiMasterQuery orderByIsStrategic($order = Criteria::ASC) Order by the is_strategic column
 *
 * @method     ChildSgpiMasterQuery groupBySgpiId() Group by the sgpi_id column
 * @method     ChildSgpiMasterQuery groupBySgpiName() Group by the sgpi_name column
 * @method     ChildSgpiMasterQuery groupBySgpiCode() Group by the sgpi_code column
 * @method     ChildSgpiMasterQuery groupByCompanyId() Group by the company_id column
 * @method     ChildSgpiMasterQuery groupBySgpiStatus() Group by the sgpi_status column
 * @method     ChildSgpiMasterQuery groupBySgpiMedia() Group by the sgpi_media column
 * @method     ChildSgpiMasterQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildSgpiMasterQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildSgpiMasterQuery groupByMaterialSku() Group by the material_sku column
 * @method     ChildSgpiMasterQuery groupBySgpiType() Group by the sgpi_type column
 * @method     ChildSgpiMasterQuery groupByUseStartDate() Group by the use_start_date column
 * @method     ChildSgpiMasterQuery groupByUseEndDate() Group by the use_end_date column
 * @method     ChildSgpiMasterQuery groupByOrgUnitId() Group by the org_unit_id column
 * @method     ChildSgpiMasterQuery groupByBrandId() Group by the brand_id column
 * @method     ChildSgpiMasterQuery groupByMaxQty() Group by the max_qty column
 * @method     ChildSgpiMasterQuery groupByOutlettypeId() Group by the outlettype_id column
 * @method     ChildSgpiMasterQuery groupByIsStrategic() Group by the is_strategic column
 *
 * @method     ChildSgpiMasterQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSgpiMasterQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSgpiMasterQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSgpiMasterQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSgpiMasterQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSgpiMasterQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSgpiMasterQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildSgpiMasterQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildSgpiMasterQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildSgpiMasterQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildSgpiMasterQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildSgpiMasterQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildSgpiMasterQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     ChildSgpiMasterQuery leftJoinBrands($relationAlias = null) Adds a LEFT JOIN clause to the query using the Brands relation
 * @method     ChildSgpiMasterQuery rightJoinBrands($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Brands relation
 * @method     ChildSgpiMasterQuery innerJoinBrands($relationAlias = null) Adds a INNER JOIN clause to the query using the Brands relation
 *
 * @method     ChildSgpiMasterQuery joinWithBrands($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Brands relation
 *
 * @method     ChildSgpiMasterQuery leftJoinWithBrands() Adds a LEFT JOIN clause and with to the query using the Brands relation
 * @method     ChildSgpiMasterQuery rightJoinWithBrands() Adds a RIGHT JOIN clause and with to the query using the Brands relation
 * @method     ChildSgpiMasterQuery innerJoinWithBrands() Adds a INNER JOIN clause and with to the query using the Brands relation
 *
 * @method     ChildSgpiMasterQuery leftJoinOrgUnit($relationAlias = null) Adds a LEFT JOIN clause to the query using the OrgUnit relation
 * @method     ChildSgpiMasterQuery rightJoinOrgUnit($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OrgUnit relation
 * @method     ChildSgpiMasterQuery innerJoinOrgUnit($relationAlias = null) Adds a INNER JOIN clause to the query using the OrgUnit relation
 *
 * @method     ChildSgpiMasterQuery joinWithOrgUnit($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OrgUnit relation
 *
 * @method     ChildSgpiMasterQuery leftJoinWithOrgUnit() Adds a LEFT JOIN clause and with to the query using the OrgUnit relation
 * @method     ChildSgpiMasterQuery rightJoinWithOrgUnit() Adds a RIGHT JOIN clause and with to the query using the OrgUnit relation
 * @method     ChildSgpiMasterQuery innerJoinWithOrgUnit() Adds a INNER JOIN clause and with to the query using the OrgUnit relation
 *
 * @method     ChildSgpiMasterQuery leftJoinOutletType($relationAlias = null) Adds a LEFT JOIN clause to the query using the OutletType relation
 * @method     ChildSgpiMasterQuery rightJoinOutletType($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OutletType relation
 * @method     ChildSgpiMasterQuery innerJoinOutletType($relationAlias = null) Adds a INNER JOIN clause to the query using the OutletType relation
 *
 * @method     ChildSgpiMasterQuery joinWithOutletType($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OutletType relation
 *
 * @method     ChildSgpiMasterQuery leftJoinWithOutletType() Adds a LEFT JOIN clause and with to the query using the OutletType relation
 * @method     ChildSgpiMasterQuery rightJoinWithOutletType() Adds a RIGHT JOIN clause and with to the query using the OutletType relation
 * @method     ChildSgpiMasterQuery innerJoinWithOutletType() Adds a INNER JOIN clause and with to the query using the OutletType relation
 *
 * @method     ChildSgpiMasterQuery leftJoinDailycallsSgpiout($relationAlias = null) Adds a LEFT JOIN clause to the query using the DailycallsSgpiout relation
 * @method     ChildSgpiMasterQuery rightJoinDailycallsSgpiout($relationAlias = null) Adds a RIGHT JOIN clause to the query using the DailycallsSgpiout relation
 * @method     ChildSgpiMasterQuery innerJoinDailycallsSgpiout($relationAlias = null) Adds a INNER JOIN clause to the query using the DailycallsSgpiout relation
 *
 * @method     ChildSgpiMasterQuery joinWithDailycallsSgpiout($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the DailycallsSgpiout relation
 *
 * @method     ChildSgpiMasterQuery leftJoinWithDailycallsSgpiout() Adds a LEFT JOIN clause and with to the query using the DailycallsSgpiout relation
 * @method     ChildSgpiMasterQuery rightJoinWithDailycallsSgpiout() Adds a RIGHT JOIN clause and with to the query using the DailycallsSgpiout relation
 * @method     ChildSgpiMasterQuery innerJoinWithDailycallsSgpiout() Adds a INNER JOIN clause and with to the query using the DailycallsSgpiout relation
 *
 * @method     ChildSgpiMasterQuery leftJoinSgpiTrans($relationAlias = null) Adds a LEFT JOIN clause to the query using the SgpiTrans relation
 * @method     ChildSgpiMasterQuery rightJoinSgpiTrans($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SgpiTrans relation
 * @method     ChildSgpiMasterQuery innerJoinSgpiTrans($relationAlias = null) Adds a INNER JOIN clause to the query using the SgpiTrans relation
 *
 * @method     ChildSgpiMasterQuery joinWithSgpiTrans($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SgpiTrans relation
 *
 * @method     ChildSgpiMasterQuery leftJoinWithSgpiTrans() Adds a LEFT JOIN clause and with to the query using the SgpiTrans relation
 * @method     ChildSgpiMasterQuery rightJoinWithSgpiTrans() Adds a RIGHT JOIN clause and with to the query using the SgpiTrans relation
 * @method     ChildSgpiMasterQuery innerJoinWithSgpiTrans() Adds a INNER JOIN clause and with to the query using the SgpiTrans relation
 *
 * @method     \entities\CompanyQuery|\entities\BrandsQuery|\entities\OrgUnitQuery|\entities\OutletTypeQuery|\entities\DailycallsSgpioutQuery|\entities\SgpiTransQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSgpiMaster|null findOne(?ConnectionInterface $con = null) Return the first ChildSgpiMaster matching the query
 * @method     ChildSgpiMaster findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSgpiMaster matching the query, or a new ChildSgpiMaster object populated from the query conditions when no match is found
 *
 * @method     ChildSgpiMaster|null findOneBySgpiId(int $sgpi_id) Return the first ChildSgpiMaster filtered by the sgpi_id column
 * @method     ChildSgpiMaster|null findOneBySgpiName(string $sgpi_name) Return the first ChildSgpiMaster filtered by the sgpi_name column
 * @method     ChildSgpiMaster|null findOneBySgpiCode(string $sgpi_code) Return the first ChildSgpiMaster filtered by the sgpi_code column
 * @method     ChildSgpiMaster|null findOneByCompanyId(int $company_id) Return the first ChildSgpiMaster filtered by the company_id column
 * @method     ChildSgpiMaster|null findOneBySgpiStatus(string $sgpi_status) Return the first ChildSgpiMaster filtered by the sgpi_status column
 * @method     ChildSgpiMaster|null findOneBySgpiMedia(int $sgpi_media) Return the first ChildSgpiMaster filtered by the sgpi_media column
 * @method     ChildSgpiMaster|null findOneByCreatedAt(string $created_at) Return the first ChildSgpiMaster filtered by the created_at column
 * @method     ChildSgpiMaster|null findOneByUpdatedAt(string $updated_at) Return the first ChildSgpiMaster filtered by the updated_at column
 * @method     ChildSgpiMaster|null findOneByMaterialSku(string $material_sku) Return the first ChildSgpiMaster filtered by the material_sku column
 * @method     ChildSgpiMaster|null findOneBySgpiType(string $sgpi_type) Return the first ChildSgpiMaster filtered by the sgpi_type column
 * @method     ChildSgpiMaster|null findOneByUseStartDate(string $use_start_date) Return the first ChildSgpiMaster filtered by the use_start_date column
 * @method     ChildSgpiMaster|null findOneByUseEndDate(string $use_end_date) Return the first ChildSgpiMaster filtered by the use_end_date column
 * @method     ChildSgpiMaster|null findOneByOrgUnitId(int $org_unit_id) Return the first ChildSgpiMaster filtered by the org_unit_id column
 * @method     ChildSgpiMaster|null findOneByBrandId(int $brand_id) Return the first ChildSgpiMaster filtered by the brand_id column
 * @method     ChildSgpiMaster|null findOneByMaxQty(int $max_qty) Return the first ChildSgpiMaster filtered by the max_qty column
 * @method     ChildSgpiMaster|null findOneByOutlettypeId(int $outlettype_id) Return the first ChildSgpiMaster filtered by the outlettype_id column
 * @method     ChildSgpiMaster|null findOneByIsStrategic(boolean $is_strategic) Return the first ChildSgpiMaster filtered by the is_strategic column
 *
 * @method     ChildSgpiMaster requirePk($key, ?ConnectionInterface $con = null) Return the ChildSgpiMaster by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiMaster requireOne(?ConnectionInterface $con = null) Return the first ChildSgpiMaster matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSgpiMaster requireOneBySgpiId(int $sgpi_id) Return the first ChildSgpiMaster filtered by the sgpi_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiMaster requireOneBySgpiName(string $sgpi_name) Return the first ChildSgpiMaster filtered by the sgpi_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiMaster requireOneBySgpiCode(string $sgpi_code) Return the first ChildSgpiMaster filtered by the sgpi_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiMaster requireOneByCompanyId(int $company_id) Return the first ChildSgpiMaster filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiMaster requireOneBySgpiStatus(string $sgpi_status) Return the first ChildSgpiMaster filtered by the sgpi_status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiMaster requireOneBySgpiMedia(int $sgpi_media) Return the first ChildSgpiMaster filtered by the sgpi_media column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiMaster requireOneByCreatedAt(string $created_at) Return the first ChildSgpiMaster filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiMaster requireOneByUpdatedAt(string $updated_at) Return the first ChildSgpiMaster filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiMaster requireOneByMaterialSku(string $material_sku) Return the first ChildSgpiMaster filtered by the material_sku column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiMaster requireOneBySgpiType(string $sgpi_type) Return the first ChildSgpiMaster filtered by the sgpi_type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiMaster requireOneByUseStartDate(string $use_start_date) Return the first ChildSgpiMaster filtered by the use_start_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiMaster requireOneByUseEndDate(string $use_end_date) Return the first ChildSgpiMaster filtered by the use_end_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiMaster requireOneByOrgUnitId(int $org_unit_id) Return the first ChildSgpiMaster filtered by the org_unit_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiMaster requireOneByBrandId(int $brand_id) Return the first ChildSgpiMaster filtered by the brand_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiMaster requireOneByMaxQty(int $max_qty) Return the first ChildSgpiMaster filtered by the max_qty column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiMaster requireOneByOutlettypeId(int $outlettype_id) Return the first ChildSgpiMaster filtered by the outlettype_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiMaster requireOneByIsStrategic(boolean $is_strategic) Return the first ChildSgpiMaster filtered by the is_strategic column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSgpiMaster[]|Collection find(?ConnectionInterface $con = null) Return ChildSgpiMaster objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSgpiMaster> find(?ConnectionInterface $con = null) Return ChildSgpiMaster objects based on current ModelCriteria
 *
 * @method     ChildSgpiMaster[]|Collection findBySgpiId(int|array<int> $sgpi_id) Return ChildSgpiMaster objects filtered by the sgpi_id column
 * @psalm-method Collection&\Traversable<ChildSgpiMaster> findBySgpiId(int|array<int> $sgpi_id) Return ChildSgpiMaster objects filtered by the sgpi_id column
 * @method     ChildSgpiMaster[]|Collection findBySgpiName(string|array<string> $sgpi_name) Return ChildSgpiMaster objects filtered by the sgpi_name column
 * @psalm-method Collection&\Traversable<ChildSgpiMaster> findBySgpiName(string|array<string> $sgpi_name) Return ChildSgpiMaster objects filtered by the sgpi_name column
 * @method     ChildSgpiMaster[]|Collection findBySgpiCode(string|array<string> $sgpi_code) Return ChildSgpiMaster objects filtered by the sgpi_code column
 * @psalm-method Collection&\Traversable<ChildSgpiMaster> findBySgpiCode(string|array<string> $sgpi_code) Return ChildSgpiMaster objects filtered by the sgpi_code column
 * @method     ChildSgpiMaster[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildSgpiMaster objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildSgpiMaster> findByCompanyId(int|array<int> $company_id) Return ChildSgpiMaster objects filtered by the company_id column
 * @method     ChildSgpiMaster[]|Collection findBySgpiStatus(string|array<string> $sgpi_status) Return ChildSgpiMaster objects filtered by the sgpi_status column
 * @psalm-method Collection&\Traversable<ChildSgpiMaster> findBySgpiStatus(string|array<string> $sgpi_status) Return ChildSgpiMaster objects filtered by the sgpi_status column
 * @method     ChildSgpiMaster[]|Collection findBySgpiMedia(int|array<int> $sgpi_media) Return ChildSgpiMaster objects filtered by the sgpi_media column
 * @psalm-method Collection&\Traversable<ChildSgpiMaster> findBySgpiMedia(int|array<int> $sgpi_media) Return ChildSgpiMaster objects filtered by the sgpi_media column
 * @method     ChildSgpiMaster[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildSgpiMaster objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildSgpiMaster> findByCreatedAt(string|array<string> $created_at) Return ChildSgpiMaster objects filtered by the created_at column
 * @method     ChildSgpiMaster[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildSgpiMaster objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildSgpiMaster> findByUpdatedAt(string|array<string> $updated_at) Return ChildSgpiMaster objects filtered by the updated_at column
 * @method     ChildSgpiMaster[]|Collection findByMaterialSku(string|array<string> $material_sku) Return ChildSgpiMaster objects filtered by the material_sku column
 * @psalm-method Collection&\Traversable<ChildSgpiMaster> findByMaterialSku(string|array<string> $material_sku) Return ChildSgpiMaster objects filtered by the material_sku column
 * @method     ChildSgpiMaster[]|Collection findBySgpiType(string|array<string> $sgpi_type) Return ChildSgpiMaster objects filtered by the sgpi_type column
 * @psalm-method Collection&\Traversable<ChildSgpiMaster> findBySgpiType(string|array<string> $sgpi_type) Return ChildSgpiMaster objects filtered by the sgpi_type column
 * @method     ChildSgpiMaster[]|Collection findByUseStartDate(string|array<string> $use_start_date) Return ChildSgpiMaster objects filtered by the use_start_date column
 * @psalm-method Collection&\Traversable<ChildSgpiMaster> findByUseStartDate(string|array<string> $use_start_date) Return ChildSgpiMaster objects filtered by the use_start_date column
 * @method     ChildSgpiMaster[]|Collection findByUseEndDate(string|array<string> $use_end_date) Return ChildSgpiMaster objects filtered by the use_end_date column
 * @psalm-method Collection&\Traversable<ChildSgpiMaster> findByUseEndDate(string|array<string> $use_end_date) Return ChildSgpiMaster objects filtered by the use_end_date column
 * @method     ChildSgpiMaster[]|Collection findByOrgUnitId(int|array<int> $org_unit_id) Return ChildSgpiMaster objects filtered by the org_unit_id column
 * @psalm-method Collection&\Traversable<ChildSgpiMaster> findByOrgUnitId(int|array<int> $org_unit_id) Return ChildSgpiMaster objects filtered by the org_unit_id column
 * @method     ChildSgpiMaster[]|Collection findByBrandId(int|array<int> $brand_id) Return ChildSgpiMaster objects filtered by the brand_id column
 * @psalm-method Collection&\Traversable<ChildSgpiMaster> findByBrandId(int|array<int> $brand_id) Return ChildSgpiMaster objects filtered by the brand_id column
 * @method     ChildSgpiMaster[]|Collection findByMaxQty(int|array<int> $max_qty) Return ChildSgpiMaster objects filtered by the max_qty column
 * @psalm-method Collection&\Traversable<ChildSgpiMaster> findByMaxQty(int|array<int> $max_qty) Return ChildSgpiMaster objects filtered by the max_qty column
 * @method     ChildSgpiMaster[]|Collection findByOutlettypeId(int|array<int> $outlettype_id) Return ChildSgpiMaster objects filtered by the outlettype_id column
 * @psalm-method Collection&\Traversable<ChildSgpiMaster> findByOutlettypeId(int|array<int> $outlettype_id) Return ChildSgpiMaster objects filtered by the outlettype_id column
 * @method     ChildSgpiMaster[]|Collection findByIsStrategic(boolean|array<boolean> $is_strategic) Return ChildSgpiMaster objects filtered by the is_strategic column
 * @psalm-method Collection&\Traversable<ChildSgpiMaster> findByIsStrategic(boolean|array<boolean> $is_strategic) Return ChildSgpiMaster objects filtered by the is_strategic column
 *
 * @method     ChildSgpiMaster[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSgpiMaster> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SgpiMasterQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\SgpiMasterQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\SgpiMaster', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSgpiMasterQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSgpiMasterQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSgpiMasterQuery) {
            return $criteria;
        }
        $query = new ChildSgpiMasterQuery();
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
     * @return ChildSgpiMaster|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SgpiMasterTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = SgpiMasterTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSgpiMaster A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT sgpi_id, sgpi_name, sgpi_code, company_id, sgpi_status, sgpi_media, created_at, updated_at, material_sku, sgpi_type, use_start_date, use_end_date, org_unit_id, brand_id, max_qty, outlettype_id, is_strategic FROM sgpi_master WHERE sgpi_id = :p0';
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
            /** @var ChildSgpiMaster $obj */
            $obj = new ChildSgpiMaster();
            $obj->hydrate($row);
            SgpiMasterTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSgpiMaster|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SgpiMasterTableMap::COL_SGPI_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SgpiMasterTableMap::COL_SGPI_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the sgpi_id column
     *
     * Example usage:
     * <code>
     * $query->filterBySgpiId(1234); // WHERE sgpi_id = 1234
     * $query->filterBySgpiId(array(12, 34)); // WHERE sgpi_id IN (12, 34)
     * $query->filterBySgpiId(array('min' => 12)); // WHERE sgpi_id > 12
     * </code>
     *
     * @param mixed $sgpiId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySgpiId($sgpiId = null, ?string $comparison = null)
    {
        if (is_array($sgpiId)) {
            $useMinMax = false;
            if (isset($sgpiId['min'])) {
                $this->addUsingAlias(SgpiMasterTableMap::COL_SGPI_ID, $sgpiId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($sgpiId['max'])) {
                $this->addUsingAlias(SgpiMasterTableMap::COL_SGPI_ID, $sgpiId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiMasterTableMap::COL_SGPI_ID, $sgpiId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the sgpi_name column
     *
     * Example usage:
     * <code>
     * $query->filterBySgpiName('fooValue');   // WHERE sgpi_name = 'fooValue'
     * $query->filterBySgpiName('%fooValue%', Criteria::LIKE); // WHERE sgpi_name LIKE '%fooValue%'
     * $query->filterBySgpiName(['foo', 'bar']); // WHERE sgpi_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $sgpiName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySgpiName($sgpiName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($sgpiName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiMasterTableMap::COL_SGPI_NAME, $sgpiName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the sgpi_code column
     *
     * Example usage:
     * <code>
     * $query->filterBySgpiCode('fooValue');   // WHERE sgpi_code = 'fooValue'
     * $query->filterBySgpiCode('%fooValue%', Criteria::LIKE); // WHERE sgpi_code LIKE '%fooValue%'
     * $query->filterBySgpiCode(['foo', 'bar']); // WHERE sgpi_code IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $sgpiCode The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySgpiCode($sgpiCode = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($sgpiCode)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiMasterTableMap::COL_SGPI_CODE, $sgpiCode, $comparison);

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
                $this->addUsingAlias(SgpiMasterTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(SgpiMasterTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiMasterTableMap::COL_COMPANY_ID, $companyId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the sgpi_status column
     *
     * Example usage:
     * <code>
     * $query->filterBySgpiStatus('fooValue');   // WHERE sgpi_status = 'fooValue'
     * $query->filterBySgpiStatus('%fooValue%', Criteria::LIKE); // WHERE sgpi_status LIKE '%fooValue%'
     * $query->filterBySgpiStatus(['foo', 'bar']); // WHERE sgpi_status IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $sgpiStatus The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySgpiStatus($sgpiStatus = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($sgpiStatus)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiMasterTableMap::COL_SGPI_STATUS, $sgpiStatus, $comparison);

        return $this;
    }

    /**
     * Filter the query on the sgpi_media column
     *
     * Example usage:
     * <code>
     * $query->filterBySgpiMedia(1234); // WHERE sgpi_media = 1234
     * $query->filterBySgpiMedia(array(12, 34)); // WHERE sgpi_media IN (12, 34)
     * $query->filterBySgpiMedia(array('min' => 12)); // WHERE sgpi_media > 12
     * </code>
     *
     * @param mixed $sgpiMedia The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySgpiMedia($sgpiMedia = null, ?string $comparison = null)
    {
        if (is_array($sgpiMedia)) {
            $useMinMax = false;
            if (isset($sgpiMedia['min'])) {
                $this->addUsingAlias(SgpiMasterTableMap::COL_SGPI_MEDIA, $sgpiMedia['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($sgpiMedia['max'])) {
                $this->addUsingAlias(SgpiMasterTableMap::COL_SGPI_MEDIA, $sgpiMedia['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiMasterTableMap::COL_SGPI_MEDIA, $sgpiMedia, $comparison);

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
                $this->addUsingAlias(SgpiMasterTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(SgpiMasterTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiMasterTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(SgpiMasterTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(SgpiMasterTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiMasterTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the material_sku column
     *
     * Example usage:
     * <code>
     * $query->filterByMaterialSku('fooValue');   // WHERE material_sku = 'fooValue'
     * $query->filterByMaterialSku('%fooValue%', Criteria::LIKE); // WHERE material_sku LIKE '%fooValue%'
     * $query->filterByMaterialSku(['foo', 'bar']); // WHERE material_sku IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $materialSku The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMaterialSku($materialSku = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($materialSku)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiMasterTableMap::COL_MATERIAL_SKU, $materialSku, $comparison);

        return $this;
    }

    /**
     * Filter the query on the sgpi_type column
     *
     * Example usage:
     * <code>
     * $query->filterBySgpiType('fooValue');   // WHERE sgpi_type = 'fooValue'
     * $query->filterBySgpiType('%fooValue%', Criteria::LIKE); // WHERE sgpi_type LIKE '%fooValue%'
     * $query->filterBySgpiType(['foo', 'bar']); // WHERE sgpi_type IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $sgpiType The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySgpiType($sgpiType = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($sgpiType)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiMasterTableMap::COL_SGPI_TYPE, $sgpiType, $comparison);

        return $this;
    }

    /**
     * Filter the query on the use_start_date column
     *
     * Example usage:
     * <code>
     * $query->filterByUseStartDate('2011-03-14'); // WHERE use_start_date = '2011-03-14'
     * $query->filterByUseStartDate('now'); // WHERE use_start_date = '2011-03-14'
     * $query->filterByUseStartDate(array('max' => 'yesterday')); // WHERE use_start_date > '2011-03-13'
     * </code>
     *
     * @param mixed $useStartDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUseStartDate($useStartDate = null, ?string $comparison = null)
    {
        if (is_array($useStartDate)) {
            $useMinMax = false;
            if (isset($useStartDate['min'])) {
                $this->addUsingAlias(SgpiMasterTableMap::COL_USE_START_DATE, $useStartDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($useStartDate['max'])) {
                $this->addUsingAlias(SgpiMasterTableMap::COL_USE_START_DATE, $useStartDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiMasterTableMap::COL_USE_START_DATE, $useStartDate, $comparison);

        return $this;
    }

    /**
     * Filter the query on the use_end_date column
     *
     * Example usage:
     * <code>
     * $query->filterByUseEndDate('2011-03-14'); // WHERE use_end_date = '2011-03-14'
     * $query->filterByUseEndDate('now'); // WHERE use_end_date = '2011-03-14'
     * $query->filterByUseEndDate(array('max' => 'yesterday')); // WHERE use_end_date > '2011-03-13'
     * </code>
     *
     * @param mixed $useEndDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUseEndDate($useEndDate = null, ?string $comparison = null)
    {
        if (is_array($useEndDate)) {
            $useMinMax = false;
            if (isset($useEndDate['min'])) {
                $this->addUsingAlias(SgpiMasterTableMap::COL_USE_END_DATE, $useEndDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($useEndDate['max'])) {
                $this->addUsingAlias(SgpiMasterTableMap::COL_USE_END_DATE, $useEndDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiMasterTableMap::COL_USE_END_DATE, $useEndDate, $comparison);

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
     * @see       filterByOrgUnit()
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
                $this->addUsingAlias(SgpiMasterTableMap::COL_ORG_UNIT_ID, $orgUnitId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($orgUnitId['max'])) {
                $this->addUsingAlias(SgpiMasterTableMap::COL_ORG_UNIT_ID, $orgUnitId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiMasterTableMap::COL_ORG_UNIT_ID, $orgUnitId, $comparison);

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
                $this->addUsingAlias(SgpiMasterTableMap::COL_BRAND_ID, $brandId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($brandId['max'])) {
                $this->addUsingAlias(SgpiMasterTableMap::COL_BRAND_ID, $brandId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiMasterTableMap::COL_BRAND_ID, $brandId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the max_qty column
     *
     * Example usage:
     * <code>
     * $query->filterByMaxQty(1234); // WHERE max_qty = 1234
     * $query->filterByMaxQty(array(12, 34)); // WHERE max_qty IN (12, 34)
     * $query->filterByMaxQty(array('min' => 12)); // WHERE max_qty > 12
     * </code>
     *
     * @param mixed $maxQty The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMaxQty($maxQty = null, ?string $comparison = null)
    {
        if (is_array($maxQty)) {
            $useMinMax = false;
            if (isset($maxQty['min'])) {
                $this->addUsingAlias(SgpiMasterTableMap::COL_MAX_QTY, $maxQty['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($maxQty['max'])) {
                $this->addUsingAlias(SgpiMasterTableMap::COL_MAX_QTY, $maxQty['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiMasterTableMap::COL_MAX_QTY, $maxQty, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlettype_id column
     *
     * Example usage:
     * <code>
     * $query->filterByOutlettypeId(1234); // WHERE outlettype_id = 1234
     * $query->filterByOutlettypeId(array(12, 34)); // WHERE outlettype_id IN (12, 34)
     * $query->filterByOutlettypeId(array('min' => 12)); // WHERE outlettype_id > 12
     * </code>
     *
     * @see       filterByOutletType()
     *
     * @param mixed $outlettypeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutlettypeId($outlettypeId = null, ?string $comparison = null)
    {
        if (is_array($outlettypeId)) {
            $useMinMax = false;
            if (isset($outlettypeId['min'])) {
                $this->addUsingAlias(SgpiMasterTableMap::COL_OUTLETTYPE_ID, $outlettypeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outlettypeId['max'])) {
                $this->addUsingAlias(SgpiMasterTableMap::COL_OUTLETTYPE_ID, $outlettypeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiMasterTableMap::COL_OUTLETTYPE_ID, $outlettypeId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the is_strategic column
     *
     * Example usage:
     * <code>
     * $query->filterByIsStrategic(true); // WHERE is_strategic = true
     * $query->filterByIsStrategic('yes'); // WHERE is_strategic = true
     * </code>
     *
     * @param bool|string $isStrategic The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIsStrategic($isStrategic = null, ?string $comparison = null)
    {
        if (is_string($isStrategic)) {
            $isStrategic = in_array(strtolower($isStrategic), array('false', 'off', '-', 'no', 'n', '0', ''), true) ? false : true;
        }

        $this->addUsingAlias(SgpiMasterTableMap::COL_IS_STRATEGIC, $isStrategic, $comparison);

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
                ->addUsingAlias(SgpiMasterTableMap::COL_COMPANY_ID, $company->getCompanyId(), $comparison);
        } elseif ($company instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SgpiMasterTableMap::COL_COMPANY_ID, $company->toKeyValue('PrimaryKey', 'CompanyId'), $comparison);

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
                ->addUsingAlias(SgpiMasterTableMap::COL_BRAND_ID, $brands->getBrandId(), $comparison);
        } elseif ($brands instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SgpiMasterTableMap::COL_BRAND_ID, $brands->toKeyValue('PrimaryKey', 'BrandId'), $comparison);

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
                ->addUsingAlias(SgpiMasterTableMap::COL_ORG_UNIT_ID, $orgUnit->getOrgunitid(), $comparison);
        } elseif ($orgUnit instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SgpiMasterTableMap::COL_ORG_UNIT_ID, $orgUnit->toKeyValue('PrimaryKey', 'Orgunitid'), $comparison);

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
     * Filter the query by a related \entities\OutletType object
     *
     * @param \entities\OutletType|ObjectCollection $outletType The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletType($outletType, ?string $comparison = null)
    {
        if ($outletType instanceof \entities\OutletType) {
            return $this
                ->addUsingAlias(SgpiMasterTableMap::COL_OUTLETTYPE_ID, $outletType->getOutlettypeId(), $comparison);
        } elseif ($outletType instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SgpiMasterTableMap::COL_OUTLETTYPE_ID, $outletType->toKeyValue('PrimaryKey', 'OutlettypeId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByOutletType() only accepts arguments of type \entities\OutletType or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OutletType relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOutletType(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OutletType');

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
            $this->addJoinObject($join, 'OutletType');
        }

        return $this;
    }

    /**
     * Use the OutletType relation OutletType object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\OutletTypeQuery A secondary query class using the current class as primary query
     */
    public function useOutletTypeQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinOutletType($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OutletType', '\entities\OutletTypeQuery');
    }

    /**
     * Use the OutletType relation OutletType object
     *
     * @param callable(\entities\OutletTypeQuery):\entities\OutletTypeQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOutletTypeQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useOutletTypeQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to OutletType table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\OutletTypeQuery The inner query object of the EXISTS statement
     */
    public function useOutletTypeExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\OutletTypeQuery */
        $q = $this->useExistsQuery('OutletType', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to OutletType table for a NOT EXISTS query.
     *
     * @see useOutletTypeExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\OutletTypeQuery The inner query object of the NOT EXISTS statement
     */
    public function useOutletTypeNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OutletTypeQuery */
        $q = $this->useExistsQuery('OutletType', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to OutletType table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\OutletTypeQuery The inner query object of the IN statement
     */
    public function useInOutletTypeQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\OutletTypeQuery */
        $q = $this->useInQuery('OutletType', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to OutletType table for a NOT IN query.
     *
     * @see useOutletTypeInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\OutletTypeQuery The inner query object of the NOT IN statement
     */
    public function useNotInOutletTypeQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OutletTypeQuery */
        $q = $this->useInQuery('OutletType', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\DailycallsSgpiout object
     *
     * @param \entities\DailycallsSgpiout|ObjectCollection $dailycallsSgpiout the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDailycallsSgpiout($dailycallsSgpiout, ?string $comparison = null)
    {
        if ($dailycallsSgpiout instanceof \entities\DailycallsSgpiout) {
            $this
                ->addUsingAlias(SgpiMasterTableMap::COL_SGPI_ID, $dailycallsSgpiout->getSgpiId(), $comparison);

            return $this;
        } elseif ($dailycallsSgpiout instanceof ObjectCollection) {
            $this
                ->useDailycallsSgpioutQuery()
                ->filterByPrimaryKeys($dailycallsSgpiout->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByDailycallsSgpiout() only accepts arguments of type \entities\DailycallsSgpiout or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the DailycallsSgpiout relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinDailycallsSgpiout(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('DailycallsSgpiout');

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
            $this->addJoinObject($join, 'DailycallsSgpiout');
        }

        return $this;
    }

    /**
     * Use the DailycallsSgpiout relation DailycallsSgpiout object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\DailycallsSgpioutQuery A secondary query class using the current class as primary query
     */
    public function useDailycallsSgpioutQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinDailycallsSgpiout($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'DailycallsSgpiout', '\entities\DailycallsSgpioutQuery');
    }

    /**
     * Use the DailycallsSgpiout relation DailycallsSgpiout object
     *
     * @param callable(\entities\DailycallsSgpioutQuery):\entities\DailycallsSgpioutQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withDailycallsSgpioutQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useDailycallsSgpioutQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to DailycallsSgpiout table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\DailycallsSgpioutQuery The inner query object of the EXISTS statement
     */
    public function useDailycallsSgpioutExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\DailycallsSgpioutQuery */
        $q = $this->useExistsQuery('DailycallsSgpiout', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to DailycallsSgpiout table for a NOT EXISTS query.
     *
     * @see useDailycallsSgpioutExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\DailycallsSgpioutQuery The inner query object of the NOT EXISTS statement
     */
    public function useDailycallsSgpioutNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\DailycallsSgpioutQuery */
        $q = $this->useExistsQuery('DailycallsSgpiout', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to DailycallsSgpiout table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\DailycallsSgpioutQuery The inner query object of the IN statement
     */
    public function useInDailycallsSgpioutQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\DailycallsSgpioutQuery */
        $q = $this->useInQuery('DailycallsSgpiout', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to DailycallsSgpiout table for a NOT IN query.
     *
     * @see useDailycallsSgpioutInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\DailycallsSgpioutQuery The inner query object of the NOT IN statement
     */
    public function useNotInDailycallsSgpioutQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\DailycallsSgpioutQuery */
        $q = $this->useInQuery('DailycallsSgpiout', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\SgpiTrans object
     *
     * @param \entities\SgpiTrans|ObjectCollection $sgpiTrans the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySgpiTrans($sgpiTrans, ?string $comparison = null)
    {
        if ($sgpiTrans instanceof \entities\SgpiTrans) {
            $this
                ->addUsingAlias(SgpiMasterTableMap::COL_SGPI_ID, $sgpiTrans->getSgpiId(), $comparison);

            return $this;
        } elseif ($sgpiTrans instanceof ObjectCollection) {
            $this
                ->useSgpiTransQuery()
                ->filterByPrimaryKeys($sgpiTrans->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySgpiTrans() only accepts arguments of type \entities\SgpiTrans or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SgpiTrans relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSgpiTrans(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SgpiTrans');

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
            $this->addJoinObject($join, 'SgpiTrans');
        }

        return $this;
    }

    /**
     * Use the SgpiTrans relation SgpiTrans object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\SgpiTransQuery A secondary query class using the current class as primary query
     */
    public function useSgpiTransQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSgpiTrans($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SgpiTrans', '\entities\SgpiTransQuery');
    }

    /**
     * Use the SgpiTrans relation SgpiTrans object
     *
     * @param callable(\entities\SgpiTransQuery):\entities\SgpiTransQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSgpiTransQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useSgpiTransQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SgpiTrans table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\SgpiTransQuery The inner query object of the EXISTS statement
     */
    public function useSgpiTransExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\SgpiTransQuery */
        $q = $this->useExistsQuery('SgpiTrans', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SgpiTrans table for a NOT EXISTS query.
     *
     * @see useSgpiTransExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\SgpiTransQuery The inner query object of the NOT EXISTS statement
     */
    public function useSgpiTransNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\SgpiTransQuery */
        $q = $this->useExistsQuery('SgpiTrans', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SgpiTrans table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\SgpiTransQuery The inner query object of the IN statement
     */
    public function useInSgpiTransQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\SgpiTransQuery */
        $q = $this->useInQuery('SgpiTrans', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SgpiTrans table for a NOT IN query.
     *
     * @see useSgpiTransInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\SgpiTransQuery The inner query object of the NOT IN statement
     */
    public function useNotInSgpiTransQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\SgpiTransQuery */
        $q = $this->useInQuery('SgpiTrans', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSgpiMaster $sgpiMaster Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($sgpiMaster = null)
    {
        if ($sgpiMaster) {
            $this->addUsingAlias(SgpiMasterTableMap::COL_SGPI_ID, $sgpiMaster->getSgpiId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the sgpi_master table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SgpiMasterTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SgpiMasterTableMap::clearInstancePool();
            SgpiMasterTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SgpiMasterTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SgpiMasterTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SgpiMasterTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SgpiMasterTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
