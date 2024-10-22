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
use entities\BrandCampiagn as ChildBrandCampiagn;
use entities\BrandCampiagnQuery as ChildBrandCampiagnQuery;
use entities\Map\BrandCampiagnTableMap;

/**
 * Base class that represents a query for the `brand_campiagn` table.
 *
 * @method     ChildBrandCampiagnQuery orderByBrandCampiagnId($order = Criteria::ASC) Order by the brand_campiagn_id column
 * @method     ChildBrandCampiagnQuery orderByCampiagnName($order = Criteria::ASC) Order by the campiagn_name column
 * @method     ChildBrandCampiagnQuery orderByStartDate($order = Criteria::ASC) Order by the start_date column
 * @method     ChildBrandCampiagnQuery orderByEndDate($order = Criteria::ASC) Order by the end_date column
 * @method     ChildBrandCampiagnQuery orderByLockingDate($order = Criteria::ASC) Order by the locking_date column
 * @method     ChildBrandCampiagnQuery orderByDoctorCount($order = Criteria::ASC) Order by the doctor_count column
 * @method     ChildBrandCampiagnQuery orderByFocusBrandId($order = Criteria::ASC) Order by the focus_brand_id column
 * @method     ChildBrandCampiagnQuery orderByPlanned($order = Criteria::ASC) Order by the planned column
 * @method     ChildBrandCampiagnQuery orderByDone($order = Criteria::ASC) Order by the done column
 * @method     ChildBrandCampiagnQuery orderByDistributed($order = Criteria::ASC) Order by the distributed column
 * @method     ChildBrandCampiagnQuery orderByDistributedDone($order = Criteria::ASC) Order by the distributed_done column
 * @method     ChildBrandCampiagnQuery orderByClassificationId($order = Criteria::ASC) Order by the classification_id column
 * @method     ChildBrandCampiagnQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ChildBrandCampiagnQuery orderByMedia($order = Criteria::ASC) Order by the media column
 * @method     ChildBrandCampiagnQuery orderByMaterial($order = Criteria::ASC) Order by the material column
 * @method     ChildBrandCampiagnQuery orderByType($order = Criteria::ASC) Order by the type column
 * @method     ChildBrandCampiagnQuery orderByTags($order = Criteria::ASC) Order by the tags column
 * @method     ChildBrandCampiagnQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildBrandCampiagnQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildBrandCampiagnQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildBrandCampiagnQuery orderByOrgUnitId($order = Criteria::ASC) Order by the org_unit_id column
 * @method     ChildBrandCampiagnQuery orderByBrandCampiagnCode($order = Criteria::ASC) Order by the brand_campiagn_code column
 * @method     ChildBrandCampiagnQuery orderByOutlettypeId($order = Criteria::ASC) Order by the outlettype_id column
 * @method     ChildBrandCampiagnQuery orderByClassifications($order = Criteria::ASC) Order by the classifications column
 * @method     ChildBrandCampiagnQuery orderByFocusBrands($order = Criteria::ASC) Order by the focus_brands column
 * @method     ChildBrandCampiagnQuery orderByMinimumPerTerritory($order = Criteria::ASC) Order by the minimum_per_territory column
 * @method     ChildBrandCampiagnQuery orderByMaximumPerTerritory($order = Criteria::ASC) Order by the maximum_per_territory column
 * @method     ChildBrandCampiagnQuery orderByMinimumForCampiagn($order = Criteria::ASC) Order by the minimum_for_campiagn column
 * @method     ChildBrandCampiagnQuery orderByMaximumForCampiagn($order = Criteria::ASC) Order by the maximum_for_campiagn column
 * @method     ChildBrandCampiagnQuery orderByIsSuspended($order = Criteria::ASC) Order by the is_suspended column
 * @method     ChildBrandCampiagnQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method     ChildBrandCampiagnQuery orderByCampiagnType($order = Criteria::ASC) Order by the campiagn_type column
 * @method     ChildBrandCampiagnQuery orderByDesignation($order = Criteria::ASC) Order by the designation column
 * @method     ChildBrandCampiagnQuery orderByPosition($order = Criteria::ASC) Order by the position column
 * @method     ChildBrandCampiagnQuery orderBySgpiBrands($order = Criteria::ASC) Order by the sgpi_brands column
 * @method     ChildBrandCampiagnQuery orderByComment($order = Criteria::ASC) Order by the comment column
 *
 * @method     ChildBrandCampiagnQuery groupByBrandCampiagnId() Group by the brand_campiagn_id column
 * @method     ChildBrandCampiagnQuery groupByCampiagnName() Group by the campiagn_name column
 * @method     ChildBrandCampiagnQuery groupByStartDate() Group by the start_date column
 * @method     ChildBrandCampiagnQuery groupByEndDate() Group by the end_date column
 * @method     ChildBrandCampiagnQuery groupByLockingDate() Group by the locking_date column
 * @method     ChildBrandCampiagnQuery groupByDoctorCount() Group by the doctor_count column
 * @method     ChildBrandCampiagnQuery groupByFocusBrandId() Group by the focus_brand_id column
 * @method     ChildBrandCampiagnQuery groupByPlanned() Group by the planned column
 * @method     ChildBrandCampiagnQuery groupByDone() Group by the done column
 * @method     ChildBrandCampiagnQuery groupByDistributed() Group by the distributed column
 * @method     ChildBrandCampiagnQuery groupByDistributedDone() Group by the distributed_done column
 * @method     ChildBrandCampiagnQuery groupByClassificationId() Group by the classification_id column
 * @method     ChildBrandCampiagnQuery groupByDescription() Group by the description column
 * @method     ChildBrandCampiagnQuery groupByMedia() Group by the media column
 * @method     ChildBrandCampiagnQuery groupByMaterial() Group by the material column
 * @method     ChildBrandCampiagnQuery groupByType() Group by the type column
 * @method     ChildBrandCampiagnQuery groupByTags() Group by the tags column
 * @method     ChildBrandCampiagnQuery groupByCompanyId() Group by the company_id column
 * @method     ChildBrandCampiagnQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildBrandCampiagnQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildBrandCampiagnQuery groupByOrgUnitId() Group by the org_unit_id column
 * @method     ChildBrandCampiagnQuery groupByBrandCampiagnCode() Group by the brand_campiagn_code column
 * @method     ChildBrandCampiagnQuery groupByOutlettypeId() Group by the outlettype_id column
 * @method     ChildBrandCampiagnQuery groupByClassifications() Group by the classifications column
 * @method     ChildBrandCampiagnQuery groupByFocusBrands() Group by the focus_brands column
 * @method     ChildBrandCampiagnQuery groupByMinimumPerTerritory() Group by the minimum_per_territory column
 * @method     ChildBrandCampiagnQuery groupByMaximumPerTerritory() Group by the maximum_per_territory column
 * @method     ChildBrandCampiagnQuery groupByMinimumForCampiagn() Group by the minimum_for_campiagn column
 * @method     ChildBrandCampiagnQuery groupByMaximumForCampiagn() Group by the maximum_for_campiagn column
 * @method     ChildBrandCampiagnQuery groupByIsSuspended() Group by the is_suspended column
 * @method     ChildBrandCampiagnQuery groupByStatus() Group by the status column
 * @method     ChildBrandCampiagnQuery groupByCampiagnType() Group by the campiagn_type column
 * @method     ChildBrandCampiagnQuery groupByDesignation() Group by the designation column
 * @method     ChildBrandCampiagnQuery groupByPosition() Group by the position column
 * @method     ChildBrandCampiagnQuery groupBySgpiBrands() Group by the sgpi_brands column
 * @method     ChildBrandCampiagnQuery groupByComment() Group by the comment column
 *
 * @method     ChildBrandCampiagnQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildBrandCampiagnQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildBrandCampiagnQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildBrandCampiagnQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildBrandCampiagnQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildBrandCampiagnQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildBrandCampiagnQuery leftJoinDesignations($relationAlias = null) Adds a LEFT JOIN clause to the query using the Designations relation
 * @method     ChildBrandCampiagnQuery rightJoinDesignations($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Designations relation
 * @method     ChildBrandCampiagnQuery innerJoinDesignations($relationAlias = null) Adds a INNER JOIN clause to the query using the Designations relation
 *
 * @method     ChildBrandCampiagnQuery joinWithDesignations($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Designations relation
 *
 * @method     ChildBrandCampiagnQuery leftJoinWithDesignations() Adds a LEFT JOIN clause and with to the query using the Designations relation
 * @method     ChildBrandCampiagnQuery rightJoinWithDesignations() Adds a RIGHT JOIN clause and with to the query using the Designations relation
 * @method     ChildBrandCampiagnQuery innerJoinWithDesignations() Adds a INNER JOIN clause and with to the query using the Designations relation
 *
 * @method     ChildBrandCampiagnQuery leftJoinBrands($relationAlias = null) Adds a LEFT JOIN clause to the query using the Brands relation
 * @method     ChildBrandCampiagnQuery rightJoinBrands($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Brands relation
 * @method     ChildBrandCampiagnQuery innerJoinBrands($relationAlias = null) Adds a INNER JOIN clause to the query using the Brands relation
 *
 * @method     ChildBrandCampiagnQuery joinWithBrands($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Brands relation
 *
 * @method     ChildBrandCampiagnQuery leftJoinWithBrands() Adds a LEFT JOIN clause and with to the query using the Brands relation
 * @method     ChildBrandCampiagnQuery rightJoinWithBrands() Adds a RIGHT JOIN clause and with to the query using the Brands relation
 * @method     ChildBrandCampiagnQuery innerJoinWithBrands() Adds a INNER JOIN clause and with to the query using the Brands relation
 *
 * @method     ChildBrandCampiagnQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildBrandCampiagnQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildBrandCampiagnQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildBrandCampiagnQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildBrandCampiagnQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildBrandCampiagnQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildBrandCampiagnQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     ChildBrandCampiagnQuery leftJoinOrgUnit($relationAlias = null) Adds a LEFT JOIN clause to the query using the OrgUnit relation
 * @method     ChildBrandCampiagnQuery rightJoinOrgUnit($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OrgUnit relation
 * @method     ChildBrandCampiagnQuery innerJoinOrgUnit($relationAlias = null) Adds a INNER JOIN clause to the query using the OrgUnit relation
 *
 * @method     ChildBrandCampiagnQuery joinWithOrgUnit($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OrgUnit relation
 *
 * @method     ChildBrandCampiagnQuery leftJoinWithOrgUnit() Adds a LEFT JOIN clause and with to the query using the OrgUnit relation
 * @method     ChildBrandCampiagnQuery rightJoinWithOrgUnit() Adds a RIGHT JOIN clause and with to the query using the OrgUnit relation
 * @method     ChildBrandCampiagnQuery innerJoinWithOrgUnit() Adds a INNER JOIN clause and with to the query using the OrgUnit relation
 *
 * @method     ChildBrandCampiagnQuery leftJoinOutletType($relationAlias = null) Adds a LEFT JOIN clause to the query using the OutletType relation
 * @method     ChildBrandCampiagnQuery rightJoinOutletType($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OutletType relation
 * @method     ChildBrandCampiagnQuery innerJoinOutletType($relationAlias = null) Adds a INNER JOIN clause to the query using the OutletType relation
 *
 * @method     ChildBrandCampiagnQuery joinWithOutletType($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OutletType relation
 *
 * @method     ChildBrandCampiagnQuery leftJoinWithOutletType() Adds a LEFT JOIN clause and with to the query using the OutletType relation
 * @method     ChildBrandCampiagnQuery rightJoinWithOutletType() Adds a RIGHT JOIN clause and with to the query using the OutletType relation
 * @method     ChildBrandCampiagnQuery innerJoinWithOutletType() Adds a INNER JOIN clause and with to the query using the OutletType relation
 *
 * @method     ChildBrandCampiagnQuery leftJoinBrandCampiagnClassification($relationAlias = null) Adds a LEFT JOIN clause to the query using the BrandCampiagnClassification relation
 * @method     ChildBrandCampiagnQuery rightJoinBrandCampiagnClassification($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BrandCampiagnClassification relation
 * @method     ChildBrandCampiagnQuery innerJoinBrandCampiagnClassification($relationAlias = null) Adds a INNER JOIN clause to the query using the BrandCampiagnClassification relation
 *
 * @method     ChildBrandCampiagnQuery joinWithBrandCampiagnClassification($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BrandCampiagnClassification relation
 *
 * @method     ChildBrandCampiagnQuery leftJoinWithBrandCampiagnClassification() Adds a LEFT JOIN clause and with to the query using the BrandCampiagnClassification relation
 * @method     ChildBrandCampiagnQuery rightJoinWithBrandCampiagnClassification() Adds a RIGHT JOIN clause and with to the query using the BrandCampiagnClassification relation
 * @method     ChildBrandCampiagnQuery innerJoinWithBrandCampiagnClassification() Adds a INNER JOIN clause and with to the query using the BrandCampiagnClassification relation
 *
 * @method     ChildBrandCampiagnQuery leftJoinBrandCampiagnDoctors($relationAlias = null) Adds a LEFT JOIN clause to the query using the BrandCampiagnDoctors relation
 * @method     ChildBrandCampiagnQuery rightJoinBrandCampiagnDoctors($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BrandCampiagnDoctors relation
 * @method     ChildBrandCampiagnQuery innerJoinBrandCampiagnDoctors($relationAlias = null) Adds a INNER JOIN clause to the query using the BrandCampiagnDoctors relation
 *
 * @method     ChildBrandCampiagnQuery joinWithBrandCampiagnDoctors($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BrandCampiagnDoctors relation
 *
 * @method     ChildBrandCampiagnQuery leftJoinWithBrandCampiagnDoctors() Adds a LEFT JOIN clause and with to the query using the BrandCampiagnDoctors relation
 * @method     ChildBrandCampiagnQuery rightJoinWithBrandCampiagnDoctors() Adds a RIGHT JOIN clause and with to the query using the BrandCampiagnDoctors relation
 * @method     ChildBrandCampiagnQuery innerJoinWithBrandCampiagnDoctors() Adds a INNER JOIN clause and with to the query using the BrandCampiagnDoctors relation
 *
 * @method     ChildBrandCampiagnQuery leftJoinBrandCampiagnVisitPlan($relationAlias = null) Adds a LEFT JOIN clause to the query using the BrandCampiagnVisitPlan relation
 * @method     ChildBrandCampiagnQuery rightJoinBrandCampiagnVisitPlan($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BrandCampiagnVisitPlan relation
 * @method     ChildBrandCampiagnQuery innerJoinBrandCampiagnVisitPlan($relationAlias = null) Adds a INNER JOIN clause to the query using the BrandCampiagnVisitPlan relation
 *
 * @method     ChildBrandCampiagnQuery joinWithBrandCampiagnVisitPlan($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BrandCampiagnVisitPlan relation
 *
 * @method     ChildBrandCampiagnQuery leftJoinWithBrandCampiagnVisitPlan() Adds a LEFT JOIN clause and with to the query using the BrandCampiagnVisitPlan relation
 * @method     ChildBrandCampiagnQuery rightJoinWithBrandCampiagnVisitPlan() Adds a RIGHT JOIN clause and with to the query using the BrandCampiagnVisitPlan relation
 * @method     ChildBrandCampiagnQuery innerJoinWithBrandCampiagnVisitPlan() Adds a INNER JOIN clause and with to the query using the BrandCampiagnVisitPlan relation
 *
 * @method     ChildBrandCampiagnQuery leftJoinBrandCampiagnVisits($relationAlias = null) Adds a LEFT JOIN clause to the query using the BrandCampiagnVisits relation
 * @method     ChildBrandCampiagnQuery rightJoinBrandCampiagnVisits($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BrandCampiagnVisits relation
 * @method     ChildBrandCampiagnQuery innerJoinBrandCampiagnVisits($relationAlias = null) Adds a INNER JOIN clause to the query using the BrandCampiagnVisits relation
 *
 * @method     ChildBrandCampiagnQuery joinWithBrandCampiagnVisits($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BrandCampiagnVisits relation
 *
 * @method     ChildBrandCampiagnQuery leftJoinWithBrandCampiagnVisits() Adds a LEFT JOIN clause and with to the query using the BrandCampiagnVisits relation
 * @method     ChildBrandCampiagnQuery rightJoinWithBrandCampiagnVisits() Adds a RIGHT JOIN clause and with to the query using the BrandCampiagnVisits relation
 * @method     ChildBrandCampiagnQuery innerJoinWithBrandCampiagnVisits() Adds a INNER JOIN clause and with to the query using the BrandCampiagnVisits relation
 *
 * @method     \entities\DesignationsQuery|\entities\BrandsQuery|\entities\CompanyQuery|\entities\OrgUnitQuery|\entities\OutletTypeQuery|\entities\BrandCampiagnClassificationQuery|\entities\BrandCampiagnDoctorsQuery|\entities\BrandCampiagnVisitPlanQuery|\entities\BrandCampiagnVisitsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildBrandCampiagn|null findOne(?ConnectionInterface $con = null) Return the first ChildBrandCampiagn matching the query
 * @method     ChildBrandCampiagn findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildBrandCampiagn matching the query, or a new ChildBrandCampiagn object populated from the query conditions when no match is found
 *
 * @method     ChildBrandCampiagn|null findOneByBrandCampiagnId(int $brand_campiagn_id) Return the first ChildBrandCampiagn filtered by the brand_campiagn_id column
 * @method     ChildBrandCampiagn|null findOneByCampiagnName(string $campiagn_name) Return the first ChildBrandCampiagn filtered by the campiagn_name column
 * @method     ChildBrandCampiagn|null findOneByStartDate(string $start_date) Return the first ChildBrandCampiagn filtered by the start_date column
 * @method     ChildBrandCampiagn|null findOneByEndDate(string $end_date) Return the first ChildBrandCampiagn filtered by the end_date column
 * @method     ChildBrandCampiagn|null findOneByLockingDate(string $locking_date) Return the first ChildBrandCampiagn filtered by the locking_date column
 * @method     ChildBrandCampiagn|null findOneByDoctorCount(int $doctor_count) Return the first ChildBrandCampiagn filtered by the doctor_count column
 * @method     ChildBrandCampiagn|null findOneByFocusBrandId(int $focus_brand_id) Return the first ChildBrandCampiagn filtered by the focus_brand_id column
 * @method     ChildBrandCampiagn|null findOneByPlanned(string $planned) Return the first ChildBrandCampiagn filtered by the planned column
 * @method     ChildBrandCampiagn|null findOneByDone(string $done) Return the first ChildBrandCampiagn filtered by the done column
 * @method     ChildBrandCampiagn|null findOneByDistributed(string $distributed) Return the first ChildBrandCampiagn filtered by the distributed column
 * @method     ChildBrandCampiagn|null findOneByDistributedDone(string $distributed_done) Return the first ChildBrandCampiagn filtered by the distributed_done column
 * @method     ChildBrandCampiagn|null findOneByClassificationId(string $classification_id) Return the first ChildBrandCampiagn filtered by the classification_id column
 * @method     ChildBrandCampiagn|null findOneByDescription(string $description) Return the first ChildBrandCampiagn filtered by the description column
 * @method     ChildBrandCampiagn|null findOneByMedia(string $media) Return the first ChildBrandCampiagn filtered by the media column
 * @method     ChildBrandCampiagn|null findOneByMaterial(string $material) Return the first ChildBrandCampiagn filtered by the material column
 * @method     ChildBrandCampiagn|null findOneByType(string $type) Return the first ChildBrandCampiagn filtered by the type column
 * @method     ChildBrandCampiagn|null findOneByTags(string $tags) Return the first ChildBrandCampiagn filtered by the tags column
 * @method     ChildBrandCampiagn|null findOneByCompanyId(int $company_id) Return the first ChildBrandCampiagn filtered by the company_id column
 * @method     ChildBrandCampiagn|null findOneByCreatedAt(string $created_at) Return the first ChildBrandCampiagn filtered by the created_at column
 * @method     ChildBrandCampiagn|null findOneByUpdatedAt(string $updated_at) Return the first ChildBrandCampiagn filtered by the updated_at column
 * @method     ChildBrandCampiagn|null findOneByOrgUnitId(int $org_unit_id) Return the first ChildBrandCampiagn filtered by the org_unit_id column
 * @method     ChildBrandCampiagn|null findOneByBrandCampiagnCode(string $brand_campiagn_code) Return the first ChildBrandCampiagn filtered by the brand_campiagn_code column
 * @method     ChildBrandCampiagn|null findOneByOutlettypeId(int $outlettype_id) Return the first ChildBrandCampiagn filtered by the outlettype_id column
 * @method     ChildBrandCampiagn|null findOneByClassifications(string $classifications) Return the first ChildBrandCampiagn filtered by the classifications column
 * @method     ChildBrandCampiagn|null findOneByFocusBrands(string $focus_brands) Return the first ChildBrandCampiagn filtered by the focus_brands column
 * @method     ChildBrandCampiagn|null findOneByMinimumPerTerritory(int $minimum_per_territory) Return the first ChildBrandCampiagn filtered by the minimum_per_territory column
 * @method     ChildBrandCampiagn|null findOneByMaximumPerTerritory(int $maximum_per_territory) Return the first ChildBrandCampiagn filtered by the maximum_per_territory column
 * @method     ChildBrandCampiagn|null findOneByMinimumForCampiagn(int $minimum_for_campiagn) Return the first ChildBrandCampiagn filtered by the minimum_for_campiagn column
 * @method     ChildBrandCampiagn|null findOneByMaximumForCampiagn(int $maximum_for_campiagn) Return the first ChildBrandCampiagn filtered by the maximum_for_campiagn column
 * @method     ChildBrandCampiagn|null findOneByIsSuspended(boolean $is_suspended) Return the first ChildBrandCampiagn filtered by the is_suspended column
 * @method     ChildBrandCampiagn|null findOneByStatus(string $status) Return the first ChildBrandCampiagn filtered by the status column
 * @method     ChildBrandCampiagn|null findOneByCampiagnType(string $campiagn_type) Return the first ChildBrandCampiagn filtered by the campiagn_type column
 * @method     ChildBrandCampiagn|null findOneByDesignation(int $designation) Return the first ChildBrandCampiagn filtered by the designation column
 * @method     ChildBrandCampiagn|null findOneByPosition(string $position) Return the first ChildBrandCampiagn filtered by the position column
 * @method     ChildBrandCampiagn|null findOneBySgpiBrands(string $sgpi_brands) Return the first ChildBrandCampiagn filtered by the sgpi_brands column
 * @method     ChildBrandCampiagn|null findOneByComment(string $comment) Return the first ChildBrandCampiagn filtered by the comment column
 *
 * @method     ChildBrandCampiagn requirePk($key, ?ConnectionInterface $con = null) Return the ChildBrandCampiagn by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandCampiagn requireOne(?ConnectionInterface $con = null) Return the first ChildBrandCampiagn matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBrandCampiagn requireOneByBrandCampiagnId(int $brand_campiagn_id) Return the first ChildBrandCampiagn filtered by the brand_campiagn_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandCampiagn requireOneByCampiagnName(string $campiagn_name) Return the first ChildBrandCampiagn filtered by the campiagn_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandCampiagn requireOneByStartDate(string $start_date) Return the first ChildBrandCampiagn filtered by the start_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandCampiagn requireOneByEndDate(string $end_date) Return the first ChildBrandCampiagn filtered by the end_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandCampiagn requireOneByLockingDate(string $locking_date) Return the first ChildBrandCampiagn filtered by the locking_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandCampiagn requireOneByDoctorCount(int $doctor_count) Return the first ChildBrandCampiagn filtered by the doctor_count column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandCampiagn requireOneByFocusBrandId(int $focus_brand_id) Return the first ChildBrandCampiagn filtered by the focus_brand_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandCampiagn requireOneByPlanned(string $planned) Return the first ChildBrandCampiagn filtered by the planned column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandCampiagn requireOneByDone(string $done) Return the first ChildBrandCampiagn filtered by the done column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandCampiagn requireOneByDistributed(string $distributed) Return the first ChildBrandCampiagn filtered by the distributed column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandCampiagn requireOneByDistributedDone(string $distributed_done) Return the first ChildBrandCampiagn filtered by the distributed_done column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandCampiagn requireOneByClassificationId(string $classification_id) Return the first ChildBrandCampiagn filtered by the classification_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandCampiagn requireOneByDescription(string $description) Return the first ChildBrandCampiagn filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandCampiagn requireOneByMedia(string $media) Return the first ChildBrandCampiagn filtered by the media column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandCampiagn requireOneByMaterial(string $material) Return the first ChildBrandCampiagn filtered by the material column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandCampiagn requireOneByType(string $type) Return the first ChildBrandCampiagn filtered by the type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandCampiagn requireOneByTags(string $tags) Return the first ChildBrandCampiagn filtered by the tags column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandCampiagn requireOneByCompanyId(int $company_id) Return the first ChildBrandCampiagn filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandCampiagn requireOneByCreatedAt(string $created_at) Return the first ChildBrandCampiagn filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandCampiagn requireOneByUpdatedAt(string $updated_at) Return the first ChildBrandCampiagn filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandCampiagn requireOneByOrgUnitId(int $org_unit_id) Return the first ChildBrandCampiagn filtered by the org_unit_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandCampiagn requireOneByBrandCampiagnCode(string $brand_campiagn_code) Return the first ChildBrandCampiagn filtered by the brand_campiagn_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandCampiagn requireOneByOutlettypeId(int $outlettype_id) Return the first ChildBrandCampiagn filtered by the outlettype_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandCampiagn requireOneByClassifications(string $classifications) Return the first ChildBrandCampiagn filtered by the classifications column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandCampiagn requireOneByFocusBrands(string $focus_brands) Return the first ChildBrandCampiagn filtered by the focus_brands column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandCampiagn requireOneByMinimumPerTerritory(int $minimum_per_territory) Return the first ChildBrandCampiagn filtered by the minimum_per_territory column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandCampiagn requireOneByMaximumPerTerritory(int $maximum_per_territory) Return the first ChildBrandCampiagn filtered by the maximum_per_territory column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandCampiagn requireOneByMinimumForCampiagn(int $minimum_for_campiagn) Return the first ChildBrandCampiagn filtered by the minimum_for_campiagn column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandCampiagn requireOneByMaximumForCampiagn(int $maximum_for_campiagn) Return the first ChildBrandCampiagn filtered by the maximum_for_campiagn column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandCampiagn requireOneByIsSuspended(boolean $is_suspended) Return the first ChildBrandCampiagn filtered by the is_suspended column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandCampiagn requireOneByStatus(string $status) Return the first ChildBrandCampiagn filtered by the status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandCampiagn requireOneByCampiagnType(string $campiagn_type) Return the first ChildBrandCampiagn filtered by the campiagn_type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandCampiagn requireOneByDesignation(int $designation) Return the first ChildBrandCampiagn filtered by the designation column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandCampiagn requireOneByPosition(string $position) Return the first ChildBrandCampiagn filtered by the position column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandCampiagn requireOneBySgpiBrands(string $sgpi_brands) Return the first ChildBrandCampiagn filtered by the sgpi_brands column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandCampiagn requireOneByComment(string $comment) Return the first ChildBrandCampiagn filtered by the comment column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBrandCampiagn[]|Collection find(?ConnectionInterface $con = null) Return ChildBrandCampiagn objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildBrandCampiagn> find(?ConnectionInterface $con = null) Return ChildBrandCampiagn objects based on current ModelCriteria
 *
 * @method     ChildBrandCampiagn[]|Collection findByBrandCampiagnId(int|array<int> $brand_campiagn_id) Return ChildBrandCampiagn objects filtered by the brand_campiagn_id column
 * @psalm-method Collection&\Traversable<ChildBrandCampiagn> findByBrandCampiagnId(int|array<int> $brand_campiagn_id) Return ChildBrandCampiagn objects filtered by the brand_campiagn_id column
 * @method     ChildBrandCampiagn[]|Collection findByCampiagnName(string|array<string> $campiagn_name) Return ChildBrandCampiagn objects filtered by the campiagn_name column
 * @psalm-method Collection&\Traversable<ChildBrandCampiagn> findByCampiagnName(string|array<string> $campiagn_name) Return ChildBrandCampiagn objects filtered by the campiagn_name column
 * @method     ChildBrandCampiagn[]|Collection findByStartDate(string|array<string> $start_date) Return ChildBrandCampiagn objects filtered by the start_date column
 * @psalm-method Collection&\Traversable<ChildBrandCampiagn> findByStartDate(string|array<string> $start_date) Return ChildBrandCampiagn objects filtered by the start_date column
 * @method     ChildBrandCampiagn[]|Collection findByEndDate(string|array<string> $end_date) Return ChildBrandCampiagn objects filtered by the end_date column
 * @psalm-method Collection&\Traversable<ChildBrandCampiagn> findByEndDate(string|array<string> $end_date) Return ChildBrandCampiagn objects filtered by the end_date column
 * @method     ChildBrandCampiagn[]|Collection findByLockingDate(string|array<string> $locking_date) Return ChildBrandCampiagn objects filtered by the locking_date column
 * @psalm-method Collection&\Traversable<ChildBrandCampiagn> findByLockingDate(string|array<string> $locking_date) Return ChildBrandCampiagn objects filtered by the locking_date column
 * @method     ChildBrandCampiagn[]|Collection findByDoctorCount(int|array<int> $doctor_count) Return ChildBrandCampiagn objects filtered by the doctor_count column
 * @psalm-method Collection&\Traversable<ChildBrandCampiagn> findByDoctorCount(int|array<int> $doctor_count) Return ChildBrandCampiagn objects filtered by the doctor_count column
 * @method     ChildBrandCampiagn[]|Collection findByFocusBrandId(int|array<int> $focus_brand_id) Return ChildBrandCampiagn objects filtered by the focus_brand_id column
 * @psalm-method Collection&\Traversable<ChildBrandCampiagn> findByFocusBrandId(int|array<int> $focus_brand_id) Return ChildBrandCampiagn objects filtered by the focus_brand_id column
 * @method     ChildBrandCampiagn[]|Collection findByPlanned(string|array<string> $planned) Return ChildBrandCampiagn objects filtered by the planned column
 * @psalm-method Collection&\Traversable<ChildBrandCampiagn> findByPlanned(string|array<string> $planned) Return ChildBrandCampiagn objects filtered by the planned column
 * @method     ChildBrandCampiagn[]|Collection findByDone(string|array<string> $done) Return ChildBrandCampiagn objects filtered by the done column
 * @psalm-method Collection&\Traversable<ChildBrandCampiagn> findByDone(string|array<string> $done) Return ChildBrandCampiagn objects filtered by the done column
 * @method     ChildBrandCampiagn[]|Collection findByDistributed(string|array<string> $distributed) Return ChildBrandCampiagn objects filtered by the distributed column
 * @psalm-method Collection&\Traversable<ChildBrandCampiagn> findByDistributed(string|array<string> $distributed) Return ChildBrandCampiagn objects filtered by the distributed column
 * @method     ChildBrandCampiagn[]|Collection findByDistributedDone(string|array<string> $distributed_done) Return ChildBrandCampiagn objects filtered by the distributed_done column
 * @psalm-method Collection&\Traversable<ChildBrandCampiagn> findByDistributedDone(string|array<string> $distributed_done) Return ChildBrandCampiagn objects filtered by the distributed_done column
 * @method     ChildBrandCampiagn[]|Collection findByClassificationId(string|array<string> $classification_id) Return ChildBrandCampiagn objects filtered by the classification_id column
 * @psalm-method Collection&\Traversable<ChildBrandCampiagn> findByClassificationId(string|array<string> $classification_id) Return ChildBrandCampiagn objects filtered by the classification_id column
 * @method     ChildBrandCampiagn[]|Collection findByDescription(string|array<string> $description) Return ChildBrandCampiagn objects filtered by the description column
 * @psalm-method Collection&\Traversable<ChildBrandCampiagn> findByDescription(string|array<string> $description) Return ChildBrandCampiagn objects filtered by the description column
 * @method     ChildBrandCampiagn[]|Collection findByMedia(string|array<string> $media) Return ChildBrandCampiagn objects filtered by the media column
 * @psalm-method Collection&\Traversable<ChildBrandCampiagn> findByMedia(string|array<string> $media) Return ChildBrandCampiagn objects filtered by the media column
 * @method     ChildBrandCampiagn[]|Collection findByMaterial(string|array<string> $material) Return ChildBrandCampiagn objects filtered by the material column
 * @psalm-method Collection&\Traversable<ChildBrandCampiagn> findByMaterial(string|array<string> $material) Return ChildBrandCampiagn objects filtered by the material column
 * @method     ChildBrandCampiagn[]|Collection findByType(string|array<string> $type) Return ChildBrandCampiagn objects filtered by the type column
 * @psalm-method Collection&\Traversable<ChildBrandCampiagn> findByType(string|array<string> $type) Return ChildBrandCampiagn objects filtered by the type column
 * @method     ChildBrandCampiagn[]|Collection findByTags(string|array<string> $tags) Return ChildBrandCampiagn objects filtered by the tags column
 * @psalm-method Collection&\Traversable<ChildBrandCampiagn> findByTags(string|array<string> $tags) Return ChildBrandCampiagn objects filtered by the tags column
 * @method     ChildBrandCampiagn[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildBrandCampiagn objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildBrandCampiagn> findByCompanyId(int|array<int> $company_id) Return ChildBrandCampiagn objects filtered by the company_id column
 * @method     ChildBrandCampiagn[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildBrandCampiagn objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildBrandCampiagn> findByCreatedAt(string|array<string> $created_at) Return ChildBrandCampiagn objects filtered by the created_at column
 * @method     ChildBrandCampiagn[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildBrandCampiagn objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildBrandCampiagn> findByUpdatedAt(string|array<string> $updated_at) Return ChildBrandCampiagn objects filtered by the updated_at column
 * @method     ChildBrandCampiagn[]|Collection findByOrgUnitId(int|array<int> $org_unit_id) Return ChildBrandCampiagn objects filtered by the org_unit_id column
 * @psalm-method Collection&\Traversable<ChildBrandCampiagn> findByOrgUnitId(int|array<int> $org_unit_id) Return ChildBrandCampiagn objects filtered by the org_unit_id column
 * @method     ChildBrandCampiagn[]|Collection findByBrandCampiagnCode(string|array<string> $brand_campiagn_code) Return ChildBrandCampiagn objects filtered by the brand_campiagn_code column
 * @psalm-method Collection&\Traversable<ChildBrandCampiagn> findByBrandCampiagnCode(string|array<string> $brand_campiagn_code) Return ChildBrandCampiagn objects filtered by the brand_campiagn_code column
 * @method     ChildBrandCampiagn[]|Collection findByOutlettypeId(int|array<int> $outlettype_id) Return ChildBrandCampiagn objects filtered by the outlettype_id column
 * @psalm-method Collection&\Traversable<ChildBrandCampiagn> findByOutlettypeId(int|array<int> $outlettype_id) Return ChildBrandCampiagn objects filtered by the outlettype_id column
 * @method     ChildBrandCampiagn[]|Collection findByClassifications(string|array<string> $classifications) Return ChildBrandCampiagn objects filtered by the classifications column
 * @psalm-method Collection&\Traversable<ChildBrandCampiagn> findByClassifications(string|array<string> $classifications) Return ChildBrandCampiagn objects filtered by the classifications column
 * @method     ChildBrandCampiagn[]|Collection findByFocusBrands(string|array<string> $focus_brands) Return ChildBrandCampiagn objects filtered by the focus_brands column
 * @psalm-method Collection&\Traversable<ChildBrandCampiagn> findByFocusBrands(string|array<string> $focus_brands) Return ChildBrandCampiagn objects filtered by the focus_brands column
 * @method     ChildBrandCampiagn[]|Collection findByMinimumPerTerritory(int|array<int> $minimum_per_territory) Return ChildBrandCampiagn objects filtered by the minimum_per_territory column
 * @psalm-method Collection&\Traversable<ChildBrandCampiagn> findByMinimumPerTerritory(int|array<int> $minimum_per_territory) Return ChildBrandCampiagn objects filtered by the minimum_per_territory column
 * @method     ChildBrandCampiagn[]|Collection findByMaximumPerTerritory(int|array<int> $maximum_per_territory) Return ChildBrandCampiagn objects filtered by the maximum_per_territory column
 * @psalm-method Collection&\Traversable<ChildBrandCampiagn> findByMaximumPerTerritory(int|array<int> $maximum_per_territory) Return ChildBrandCampiagn objects filtered by the maximum_per_territory column
 * @method     ChildBrandCampiagn[]|Collection findByMinimumForCampiagn(int|array<int> $minimum_for_campiagn) Return ChildBrandCampiagn objects filtered by the minimum_for_campiagn column
 * @psalm-method Collection&\Traversable<ChildBrandCampiagn> findByMinimumForCampiagn(int|array<int> $minimum_for_campiagn) Return ChildBrandCampiagn objects filtered by the minimum_for_campiagn column
 * @method     ChildBrandCampiagn[]|Collection findByMaximumForCampiagn(int|array<int> $maximum_for_campiagn) Return ChildBrandCampiagn objects filtered by the maximum_for_campiagn column
 * @psalm-method Collection&\Traversable<ChildBrandCampiagn> findByMaximumForCampiagn(int|array<int> $maximum_for_campiagn) Return ChildBrandCampiagn objects filtered by the maximum_for_campiagn column
 * @method     ChildBrandCampiagn[]|Collection findByIsSuspended(boolean|array<boolean> $is_suspended) Return ChildBrandCampiagn objects filtered by the is_suspended column
 * @psalm-method Collection&\Traversable<ChildBrandCampiagn> findByIsSuspended(boolean|array<boolean> $is_suspended) Return ChildBrandCampiagn objects filtered by the is_suspended column
 * @method     ChildBrandCampiagn[]|Collection findByStatus(string|array<string> $status) Return ChildBrandCampiagn objects filtered by the status column
 * @psalm-method Collection&\Traversable<ChildBrandCampiagn> findByStatus(string|array<string> $status) Return ChildBrandCampiagn objects filtered by the status column
 * @method     ChildBrandCampiagn[]|Collection findByCampiagnType(string|array<string> $campiagn_type) Return ChildBrandCampiagn objects filtered by the campiagn_type column
 * @psalm-method Collection&\Traversable<ChildBrandCampiagn> findByCampiagnType(string|array<string> $campiagn_type) Return ChildBrandCampiagn objects filtered by the campiagn_type column
 * @method     ChildBrandCampiagn[]|Collection findByDesignation(int|array<int> $designation) Return ChildBrandCampiagn objects filtered by the designation column
 * @psalm-method Collection&\Traversable<ChildBrandCampiagn> findByDesignation(int|array<int> $designation) Return ChildBrandCampiagn objects filtered by the designation column
 * @method     ChildBrandCampiagn[]|Collection findByPosition(string|array<string> $position) Return ChildBrandCampiagn objects filtered by the position column
 * @psalm-method Collection&\Traversable<ChildBrandCampiagn> findByPosition(string|array<string> $position) Return ChildBrandCampiagn objects filtered by the position column
 * @method     ChildBrandCampiagn[]|Collection findBySgpiBrands(string|array<string> $sgpi_brands) Return ChildBrandCampiagn objects filtered by the sgpi_brands column
 * @psalm-method Collection&\Traversable<ChildBrandCampiagn> findBySgpiBrands(string|array<string> $sgpi_brands) Return ChildBrandCampiagn objects filtered by the sgpi_brands column
 * @method     ChildBrandCampiagn[]|Collection findByComment(string|array<string> $comment) Return ChildBrandCampiagn objects filtered by the comment column
 * @psalm-method Collection&\Traversable<ChildBrandCampiagn> findByComment(string|array<string> $comment) Return ChildBrandCampiagn objects filtered by the comment column
 *
 * @method     ChildBrandCampiagn[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildBrandCampiagn> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class BrandCampiagnQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\BrandCampiagnQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\BrandCampiagn', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildBrandCampiagnQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildBrandCampiagnQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildBrandCampiagnQuery) {
            return $criteria;
        }
        $query = new ChildBrandCampiagnQuery();
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
     * @return ChildBrandCampiagn|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(BrandCampiagnTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = BrandCampiagnTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildBrandCampiagn A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT brand_campiagn_id, campiagn_name, start_date, end_date, locking_date, doctor_count, focus_brand_id, planned, done, distributed, distributed_done, classification_id, description, media, material, type, tags, company_id, created_at, updated_at, org_unit_id, brand_campiagn_code, outlettype_id, classifications, focus_brands, minimum_per_territory, maximum_per_territory, minimum_for_campiagn, maximum_for_campiagn, is_suspended, status, campiagn_type, designation, position, sgpi_brands, comment FROM brand_campiagn WHERE brand_campiagn_id = :p0';
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
            /** @var ChildBrandCampiagn $obj */
            $obj = new ChildBrandCampiagn();
            $obj->hydrate($row);
            BrandCampiagnTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildBrandCampiagn|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(BrandCampiagnTableMap::COL_BRAND_CAMPIAGN_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(BrandCampiagnTableMap::COL_BRAND_CAMPIAGN_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the brand_campiagn_id column
     *
     * Example usage:
     * <code>
     * $query->filterByBrandCampiagnId(1234); // WHERE brand_campiagn_id = 1234
     * $query->filterByBrandCampiagnId(array(12, 34)); // WHERE brand_campiagn_id IN (12, 34)
     * $query->filterByBrandCampiagnId(array('min' => 12)); // WHERE brand_campiagn_id > 12
     * </code>
     *
     * @param mixed $brandCampiagnId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBrandCampiagnId($brandCampiagnId = null, ?string $comparison = null)
    {
        if (is_array($brandCampiagnId)) {
            $useMinMax = false;
            if (isset($brandCampiagnId['min'])) {
                $this->addUsingAlias(BrandCampiagnTableMap::COL_BRAND_CAMPIAGN_ID, $brandCampiagnId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($brandCampiagnId['max'])) {
                $this->addUsingAlias(BrandCampiagnTableMap::COL_BRAND_CAMPIAGN_ID, $brandCampiagnId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandCampiagnTableMap::COL_BRAND_CAMPIAGN_ID, $brandCampiagnId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the campiagn_name column
     *
     * Example usage:
     * <code>
     * $query->filterByCampiagnName('fooValue');   // WHERE campiagn_name = 'fooValue'
     * $query->filterByCampiagnName('%fooValue%', Criteria::LIKE); // WHERE campiagn_name LIKE '%fooValue%'
     * $query->filterByCampiagnName(['foo', 'bar']); // WHERE campiagn_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $campiagnName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCampiagnName($campiagnName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($campiagnName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandCampiagnTableMap::COL_CAMPIAGN_NAME, $campiagnName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the start_date column
     *
     * Example usage:
     * <code>
     * $query->filterByStartDate('2011-03-14'); // WHERE start_date = '2011-03-14'
     * $query->filterByStartDate('now'); // WHERE start_date = '2011-03-14'
     * $query->filterByStartDate(array('max' => 'yesterday')); // WHERE start_date > '2011-03-13'
     * </code>
     *
     * @param mixed $startDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStartDate($startDate = null, ?string $comparison = null)
    {
        if (is_array($startDate)) {
            $useMinMax = false;
            if (isset($startDate['min'])) {
                $this->addUsingAlias(BrandCampiagnTableMap::COL_START_DATE, $startDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($startDate['max'])) {
                $this->addUsingAlias(BrandCampiagnTableMap::COL_START_DATE, $startDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandCampiagnTableMap::COL_START_DATE, $startDate, $comparison);

        return $this;
    }

    /**
     * Filter the query on the end_date column
     *
     * Example usage:
     * <code>
     * $query->filterByEndDate('2011-03-14'); // WHERE end_date = '2011-03-14'
     * $query->filterByEndDate('now'); // WHERE end_date = '2011-03-14'
     * $query->filterByEndDate(array('max' => 'yesterday')); // WHERE end_date > '2011-03-13'
     * </code>
     *
     * @param mixed $endDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEndDate($endDate = null, ?string $comparison = null)
    {
        if (is_array($endDate)) {
            $useMinMax = false;
            if (isset($endDate['min'])) {
                $this->addUsingAlias(BrandCampiagnTableMap::COL_END_DATE, $endDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($endDate['max'])) {
                $this->addUsingAlias(BrandCampiagnTableMap::COL_END_DATE, $endDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandCampiagnTableMap::COL_END_DATE, $endDate, $comparison);

        return $this;
    }

    /**
     * Filter the query on the locking_date column
     *
     * Example usage:
     * <code>
     * $query->filterByLockingDate('2011-03-14'); // WHERE locking_date = '2011-03-14'
     * $query->filterByLockingDate('now'); // WHERE locking_date = '2011-03-14'
     * $query->filterByLockingDate(array('max' => 'yesterday')); // WHERE locking_date > '2011-03-13'
     * </code>
     *
     * @param mixed $lockingDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLockingDate($lockingDate = null, ?string $comparison = null)
    {
        if (is_array($lockingDate)) {
            $useMinMax = false;
            if (isset($lockingDate['min'])) {
                $this->addUsingAlias(BrandCampiagnTableMap::COL_LOCKING_DATE, $lockingDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lockingDate['max'])) {
                $this->addUsingAlias(BrandCampiagnTableMap::COL_LOCKING_DATE, $lockingDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandCampiagnTableMap::COL_LOCKING_DATE, $lockingDate, $comparison);

        return $this;
    }

    /**
     * Filter the query on the doctor_count column
     *
     * Example usage:
     * <code>
     * $query->filterByDoctorCount(1234); // WHERE doctor_count = 1234
     * $query->filterByDoctorCount(array(12, 34)); // WHERE doctor_count IN (12, 34)
     * $query->filterByDoctorCount(array('min' => 12)); // WHERE doctor_count > 12
     * </code>
     *
     * @param mixed $doctorCount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDoctorCount($doctorCount = null, ?string $comparison = null)
    {
        if (is_array($doctorCount)) {
            $useMinMax = false;
            if (isset($doctorCount['min'])) {
                $this->addUsingAlias(BrandCampiagnTableMap::COL_DOCTOR_COUNT, $doctorCount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($doctorCount['max'])) {
                $this->addUsingAlias(BrandCampiagnTableMap::COL_DOCTOR_COUNT, $doctorCount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandCampiagnTableMap::COL_DOCTOR_COUNT, $doctorCount, $comparison);

        return $this;
    }

    /**
     * Filter the query on the focus_brand_id column
     *
     * Example usage:
     * <code>
     * $query->filterByFocusBrandId(1234); // WHERE focus_brand_id = 1234
     * $query->filterByFocusBrandId(array(12, 34)); // WHERE focus_brand_id IN (12, 34)
     * $query->filterByFocusBrandId(array('min' => 12)); // WHERE focus_brand_id > 12
     * </code>
     *
     * @see       filterByBrands()
     *
     * @param mixed $focusBrandId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFocusBrandId($focusBrandId = null, ?string $comparison = null)
    {
        if (is_array($focusBrandId)) {
            $useMinMax = false;
            if (isset($focusBrandId['min'])) {
                $this->addUsingAlias(BrandCampiagnTableMap::COL_FOCUS_BRAND_ID, $focusBrandId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($focusBrandId['max'])) {
                $this->addUsingAlias(BrandCampiagnTableMap::COL_FOCUS_BRAND_ID, $focusBrandId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandCampiagnTableMap::COL_FOCUS_BRAND_ID, $focusBrandId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the planned column
     *
     * Example usage:
     * <code>
     * $query->filterByPlanned('fooValue');   // WHERE planned = 'fooValue'
     * $query->filterByPlanned('%fooValue%', Criteria::LIKE); // WHERE planned LIKE '%fooValue%'
     * $query->filterByPlanned(['foo', 'bar']); // WHERE planned IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $planned The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPlanned($planned = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($planned)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandCampiagnTableMap::COL_PLANNED, $planned, $comparison);

        return $this;
    }

    /**
     * Filter the query on the done column
     *
     * Example usage:
     * <code>
     * $query->filterByDone('fooValue');   // WHERE done = 'fooValue'
     * $query->filterByDone('%fooValue%', Criteria::LIKE); // WHERE done LIKE '%fooValue%'
     * $query->filterByDone(['foo', 'bar']); // WHERE done IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $done The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDone($done = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($done)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandCampiagnTableMap::COL_DONE, $done, $comparison);

        return $this;
    }

    /**
     * Filter the query on the distributed column
     *
     * Example usage:
     * <code>
     * $query->filterByDistributed('fooValue');   // WHERE distributed = 'fooValue'
     * $query->filterByDistributed('%fooValue%', Criteria::LIKE); // WHERE distributed LIKE '%fooValue%'
     * $query->filterByDistributed(['foo', 'bar']); // WHERE distributed IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $distributed The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDistributed($distributed = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($distributed)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandCampiagnTableMap::COL_DISTRIBUTED, $distributed, $comparison);

        return $this;
    }

    /**
     * Filter the query on the distributed_done column
     *
     * Example usage:
     * <code>
     * $query->filterByDistributedDone('fooValue');   // WHERE distributed_done = 'fooValue'
     * $query->filterByDistributedDone('%fooValue%', Criteria::LIKE); // WHERE distributed_done LIKE '%fooValue%'
     * $query->filterByDistributedDone(['foo', 'bar']); // WHERE distributed_done IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $distributedDone The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDistributedDone($distributedDone = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($distributedDone)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandCampiagnTableMap::COL_DISTRIBUTED_DONE, $distributedDone, $comparison);

        return $this;
    }

    /**
     * Filter the query on the classification_id column
     *
     * Example usage:
     * <code>
     * $query->filterByClassificationId('fooValue');   // WHERE classification_id = 'fooValue'
     * $query->filterByClassificationId('%fooValue%', Criteria::LIKE); // WHERE classification_id LIKE '%fooValue%'
     * $query->filterByClassificationId(['foo', 'bar']); // WHERE classification_id IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $classificationId The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByClassificationId($classificationId = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($classificationId)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandCampiagnTableMap::COL_CLASSIFICATION_ID, $classificationId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the description column
     *
     * Example usage:
     * <code>
     * $query->filterByDescription('fooValue');   // WHERE description = 'fooValue'
     * $query->filterByDescription('%fooValue%', Criteria::LIKE); // WHERE description LIKE '%fooValue%'
     * $query->filterByDescription(['foo', 'bar']); // WHERE description IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $description The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDescription($description = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandCampiagnTableMap::COL_DESCRIPTION, $description, $comparison);

        return $this;
    }

    /**
     * Filter the query on the media column
     *
     * Example usage:
     * <code>
     * $query->filterByMedia('fooValue');   // WHERE media = 'fooValue'
     * $query->filterByMedia('%fooValue%', Criteria::LIKE); // WHERE media LIKE '%fooValue%'
     * $query->filterByMedia(['foo', 'bar']); // WHERE media IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $media The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMedia($media = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($media)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandCampiagnTableMap::COL_MEDIA, $media, $comparison);

        return $this;
    }

    /**
     * Filter the query on the material column
     *
     * Example usage:
     * <code>
     * $query->filterByMaterial('fooValue');   // WHERE material = 'fooValue'
     * $query->filterByMaterial('%fooValue%', Criteria::LIKE); // WHERE material LIKE '%fooValue%'
     * $query->filterByMaterial(['foo', 'bar']); // WHERE material IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $material The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMaterial($material = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($material)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandCampiagnTableMap::COL_MATERIAL, $material, $comparison);

        return $this;
    }

    /**
     * Filter the query on the type column
     *
     * Example usage:
     * <code>
     * $query->filterByType('fooValue');   // WHERE type = 'fooValue'
     * $query->filterByType('%fooValue%', Criteria::LIKE); // WHERE type LIKE '%fooValue%'
     * $query->filterByType(['foo', 'bar']); // WHERE type IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $type The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByType($type = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($type)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandCampiagnTableMap::COL_TYPE, $type, $comparison);

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

        $this->addUsingAlias(BrandCampiagnTableMap::COL_TAGS, $tags, $comparison);

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
                $this->addUsingAlias(BrandCampiagnTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(BrandCampiagnTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandCampiagnTableMap::COL_COMPANY_ID, $companyId, $comparison);

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
                $this->addUsingAlias(BrandCampiagnTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(BrandCampiagnTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandCampiagnTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(BrandCampiagnTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(BrandCampiagnTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandCampiagnTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

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
                $this->addUsingAlias(BrandCampiagnTableMap::COL_ORG_UNIT_ID, $orgUnitId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($orgUnitId['max'])) {
                $this->addUsingAlias(BrandCampiagnTableMap::COL_ORG_UNIT_ID, $orgUnitId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandCampiagnTableMap::COL_ORG_UNIT_ID, $orgUnitId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the brand_campiagn_code column
     *
     * Example usage:
     * <code>
     * $query->filterByBrandCampiagnCode('fooValue');   // WHERE brand_campiagn_code = 'fooValue'
     * $query->filterByBrandCampiagnCode('%fooValue%', Criteria::LIKE); // WHERE brand_campiagn_code LIKE '%fooValue%'
     * $query->filterByBrandCampiagnCode(['foo', 'bar']); // WHERE brand_campiagn_code IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $brandCampiagnCode The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBrandCampiagnCode($brandCampiagnCode = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($brandCampiagnCode)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandCampiagnTableMap::COL_BRAND_CAMPIAGN_CODE, $brandCampiagnCode, $comparison);

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
                $this->addUsingAlias(BrandCampiagnTableMap::COL_OUTLETTYPE_ID, $outlettypeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outlettypeId['max'])) {
                $this->addUsingAlias(BrandCampiagnTableMap::COL_OUTLETTYPE_ID, $outlettypeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandCampiagnTableMap::COL_OUTLETTYPE_ID, $outlettypeId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the classifications column
     *
     * Example usage:
     * <code>
     * $query->filterByClassifications('fooValue');   // WHERE classifications = 'fooValue'
     * $query->filterByClassifications('%fooValue%', Criteria::LIKE); // WHERE classifications LIKE '%fooValue%'
     * $query->filterByClassifications(['foo', 'bar']); // WHERE classifications IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $classifications The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByClassifications($classifications = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($classifications)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandCampiagnTableMap::COL_CLASSIFICATIONS, $classifications, $comparison);

        return $this;
    }

    /**
     * Filter the query on the focus_brands column
     *
     * Example usage:
     * <code>
     * $query->filterByFocusBrands('fooValue');   // WHERE focus_brands = 'fooValue'
     * $query->filterByFocusBrands('%fooValue%', Criteria::LIKE); // WHERE focus_brands LIKE '%fooValue%'
     * $query->filterByFocusBrands(['foo', 'bar']); // WHERE focus_brands IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $focusBrands The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFocusBrands($focusBrands = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($focusBrands)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandCampiagnTableMap::COL_FOCUS_BRANDS, $focusBrands, $comparison);

        return $this;
    }

    /**
     * Filter the query on the minimum_per_territory column
     *
     * Example usage:
     * <code>
     * $query->filterByMinimumPerTerritory(1234); // WHERE minimum_per_territory = 1234
     * $query->filterByMinimumPerTerritory(array(12, 34)); // WHERE minimum_per_territory IN (12, 34)
     * $query->filterByMinimumPerTerritory(array('min' => 12)); // WHERE minimum_per_territory > 12
     * </code>
     *
     * @param mixed $minimumPerTerritory The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMinimumPerTerritory($minimumPerTerritory = null, ?string $comparison = null)
    {
        if (is_array($minimumPerTerritory)) {
            $useMinMax = false;
            if (isset($minimumPerTerritory['min'])) {
                $this->addUsingAlias(BrandCampiagnTableMap::COL_MINIMUM_PER_TERRITORY, $minimumPerTerritory['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($minimumPerTerritory['max'])) {
                $this->addUsingAlias(BrandCampiagnTableMap::COL_MINIMUM_PER_TERRITORY, $minimumPerTerritory['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandCampiagnTableMap::COL_MINIMUM_PER_TERRITORY, $minimumPerTerritory, $comparison);

        return $this;
    }

    /**
     * Filter the query on the maximum_per_territory column
     *
     * Example usage:
     * <code>
     * $query->filterByMaximumPerTerritory(1234); // WHERE maximum_per_territory = 1234
     * $query->filterByMaximumPerTerritory(array(12, 34)); // WHERE maximum_per_territory IN (12, 34)
     * $query->filterByMaximumPerTerritory(array('min' => 12)); // WHERE maximum_per_territory > 12
     * </code>
     *
     * @param mixed $maximumPerTerritory The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMaximumPerTerritory($maximumPerTerritory = null, ?string $comparison = null)
    {
        if (is_array($maximumPerTerritory)) {
            $useMinMax = false;
            if (isset($maximumPerTerritory['min'])) {
                $this->addUsingAlias(BrandCampiagnTableMap::COL_MAXIMUM_PER_TERRITORY, $maximumPerTerritory['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($maximumPerTerritory['max'])) {
                $this->addUsingAlias(BrandCampiagnTableMap::COL_MAXIMUM_PER_TERRITORY, $maximumPerTerritory['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandCampiagnTableMap::COL_MAXIMUM_PER_TERRITORY, $maximumPerTerritory, $comparison);

        return $this;
    }

    /**
     * Filter the query on the minimum_for_campiagn column
     *
     * Example usage:
     * <code>
     * $query->filterByMinimumForCampiagn(1234); // WHERE minimum_for_campiagn = 1234
     * $query->filterByMinimumForCampiagn(array(12, 34)); // WHERE minimum_for_campiagn IN (12, 34)
     * $query->filterByMinimumForCampiagn(array('min' => 12)); // WHERE minimum_for_campiagn > 12
     * </code>
     *
     * @param mixed $minimumForCampiagn The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMinimumForCampiagn($minimumForCampiagn = null, ?string $comparison = null)
    {
        if (is_array($minimumForCampiagn)) {
            $useMinMax = false;
            if (isset($minimumForCampiagn['min'])) {
                $this->addUsingAlias(BrandCampiagnTableMap::COL_MINIMUM_FOR_CAMPIAGN, $minimumForCampiagn['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($minimumForCampiagn['max'])) {
                $this->addUsingAlias(BrandCampiagnTableMap::COL_MINIMUM_FOR_CAMPIAGN, $minimumForCampiagn['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandCampiagnTableMap::COL_MINIMUM_FOR_CAMPIAGN, $minimumForCampiagn, $comparison);

        return $this;
    }

    /**
     * Filter the query on the maximum_for_campiagn column
     *
     * Example usage:
     * <code>
     * $query->filterByMaximumForCampiagn(1234); // WHERE maximum_for_campiagn = 1234
     * $query->filterByMaximumForCampiagn(array(12, 34)); // WHERE maximum_for_campiagn IN (12, 34)
     * $query->filterByMaximumForCampiagn(array('min' => 12)); // WHERE maximum_for_campiagn > 12
     * </code>
     *
     * @param mixed $maximumForCampiagn The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMaximumForCampiagn($maximumForCampiagn = null, ?string $comparison = null)
    {
        if (is_array($maximumForCampiagn)) {
            $useMinMax = false;
            if (isset($maximumForCampiagn['min'])) {
                $this->addUsingAlias(BrandCampiagnTableMap::COL_MAXIMUM_FOR_CAMPIAGN, $maximumForCampiagn['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($maximumForCampiagn['max'])) {
                $this->addUsingAlias(BrandCampiagnTableMap::COL_MAXIMUM_FOR_CAMPIAGN, $maximumForCampiagn['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandCampiagnTableMap::COL_MAXIMUM_FOR_CAMPIAGN, $maximumForCampiagn, $comparison);

        return $this;
    }

    /**
     * Filter the query on the is_suspended column
     *
     * Example usage:
     * <code>
     * $query->filterByIsSuspended(true); // WHERE is_suspended = true
     * $query->filterByIsSuspended('yes'); // WHERE is_suspended = true
     * </code>
     *
     * @param bool|string $isSuspended The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIsSuspended($isSuspended = null, ?string $comparison = null)
    {
        if (is_string($isSuspended)) {
            $isSuspended = in_array(strtolower($isSuspended), array('false', 'off', '-', 'no', 'n', '0', ''), true) ? false : true;
        }

        $this->addUsingAlias(BrandCampiagnTableMap::COL_IS_SUSPENDED, $isSuspended, $comparison);

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

        $this->addUsingAlias(BrandCampiagnTableMap::COL_STATUS, $status, $comparison);

        return $this;
    }

    /**
     * Filter the query on the campiagn_type column
     *
     * Example usage:
     * <code>
     * $query->filterByCampiagnType('fooValue');   // WHERE campiagn_type = 'fooValue'
     * $query->filterByCampiagnType('%fooValue%', Criteria::LIKE); // WHERE campiagn_type LIKE '%fooValue%'
     * $query->filterByCampiagnType(['foo', 'bar']); // WHERE campiagn_type IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $campiagnType The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCampiagnType($campiagnType = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($campiagnType)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandCampiagnTableMap::COL_CAMPIAGN_TYPE, $campiagnType, $comparison);

        return $this;
    }

    /**
     * Filter the query on the designation column
     *
     * Example usage:
     * <code>
     * $query->filterByDesignation(1234); // WHERE designation = 1234
     * $query->filterByDesignation(array(12, 34)); // WHERE designation IN (12, 34)
     * $query->filterByDesignation(array('min' => 12)); // WHERE designation > 12
     * </code>
     *
     * @see       filterByDesignations()
     *
     * @param mixed $designation The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDesignation($designation = null, ?string $comparison = null)
    {
        if (is_array($designation)) {
            $useMinMax = false;
            if (isset($designation['min'])) {
                $this->addUsingAlias(BrandCampiagnTableMap::COL_DESIGNATION, $designation['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($designation['max'])) {
                $this->addUsingAlias(BrandCampiagnTableMap::COL_DESIGNATION, $designation['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandCampiagnTableMap::COL_DESIGNATION, $designation, $comparison);

        return $this;
    }

    /**
     * Filter the query on the position column
     *
     * Example usage:
     * <code>
     * $query->filterByPosition('fooValue');   // WHERE position = 'fooValue'
     * $query->filterByPosition('%fooValue%', Criteria::LIKE); // WHERE position LIKE '%fooValue%'
     * $query->filterByPosition(['foo', 'bar']); // WHERE position IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $position The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPosition($position = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($position)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandCampiagnTableMap::COL_POSITION, $position, $comparison);

        return $this;
    }

    /**
     * Filter the query on the sgpi_brands column
     *
     * Example usage:
     * <code>
     * $query->filterBySgpiBrands('fooValue');   // WHERE sgpi_brands = 'fooValue'
     * $query->filterBySgpiBrands('%fooValue%', Criteria::LIKE); // WHERE sgpi_brands LIKE '%fooValue%'
     * $query->filterBySgpiBrands(['foo', 'bar']); // WHERE sgpi_brands IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $sgpiBrands The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySgpiBrands($sgpiBrands = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($sgpiBrands)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandCampiagnTableMap::COL_SGPI_BRANDS, $sgpiBrands, $comparison);

        return $this;
    }

    /**
     * Filter the query on the comment column
     *
     * Example usage:
     * <code>
     * $query->filterByComment('fooValue');   // WHERE comment = 'fooValue'
     * $query->filterByComment('%fooValue%', Criteria::LIKE); // WHERE comment LIKE '%fooValue%'
     * $query->filterByComment(['foo', 'bar']); // WHERE comment IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $comment The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByComment($comment = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($comment)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandCampiagnTableMap::COL_COMMENT, $comment, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \entities\Designations object
     *
     * @param \entities\Designations|ObjectCollection $designations The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDesignations($designations, ?string $comparison = null)
    {
        if ($designations instanceof \entities\Designations) {
            return $this
                ->addUsingAlias(BrandCampiagnTableMap::COL_DESIGNATION, $designations->getDesignationId(), $comparison);
        } elseif ($designations instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(BrandCampiagnTableMap::COL_DESIGNATION, $designations->toKeyValue('PrimaryKey', 'DesignationId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByDesignations() only accepts arguments of type \entities\Designations or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Designations relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinDesignations(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Designations');

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
            $this->addJoinObject($join, 'Designations');
        }

        return $this;
    }

    /**
     * Use the Designations relation Designations object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\DesignationsQuery A secondary query class using the current class as primary query
     */
    public function useDesignationsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinDesignations($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Designations', '\entities\DesignationsQuery');
    }

    /**
     * Use the Designations relation Designations object
     *
     * @param callable(\entities\DesignationsQuery):\entities\DesignationsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withDesignationsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useDesignationsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Designations table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\DesignationsQuery The inner query object of the EXISTS statement
     */
    public function useDesignationsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\DesignationsQuery */
        $q = $this->useExistsQuery('Designations', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Designations table for a NOT EXISTS query.
     *
     * @see useDesignationsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\DesignationsQuery The inner query object of the NOT EXISTS statement
     */
    public function useDesignationsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\DesignationsQuery */
        $q = $this->useExistsQuery('Designations', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Designations table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\DesignationsQuery The inner query object of the IN statement
     */
    public function useInDesignationsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\DesignationsQuery */
        $q = $this->useInQuery('Designations', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Designations table for a NOT IN query.
     *
     * @see useDesignationsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\DesignationsQuery The inner query object of the NOT IN statement
     */
    public function useNotInDesignationsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\DesignationsQuery */
        $q = $this->useInQuery('Designations', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(BrandCampiagnTableMap::COL_FOCUS_BRAND_ID, $brands->getBrandId(), $comparison);
        } elseif ($brands instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(BrandCampiagnTableMap::COL_FOCUS_BRAND_ID, $brands->toKeyValue('PrimaryKey', 'BrandId'), $comparison);

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
                ->addUsingAlias(BrandCampiagnTableMap::COL_COMPANY_ID, $company->getCompanyId(), $comparison);
        } elseif ($company instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(BrandCampiagnTableMap::COL_COMPANY_ID, $company->toKeyValue('PrimaryKey', 'CompanyId'), $comparison);

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
                ->addUsingAlias(BrandCampiagnTableMap::COL_ORG_UNIT_ID, $orgUnit->getOrgunitid(), $comparison);
        } elseif ($orgUnit instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(BrandCampiagnTableMap::COL_ORG_UNIT_ID, $orgUnit->toKeyValue('PrimaryKey', 'Orgunitid'), $comparison);

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
                ->addUsingAlias(BrandCampiagnTableMap::COL_OUTLETTYPE_ID, $outletType->getOutlettypeId(), $comparison);
        } elseif ($outletType instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(BrandCampiagnTableMap::COL_OUTLETTYPE_ID, $outletType->toKeyValue('PrimaryKey', 'OutlettypeId'), $comparison);

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
     * Filter the query by a related \entities\BrandCampiagnClassification object
     *
     * @param \entities\BrandCampiagnClassification|ObjectCollection $brandCampiagnClassification the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBrandCampiagnClassification($brandCampiagnClassification, ?string $comparison = null)
    {
        if ($brandCampiagnClassification instanceof \entities\BrandCampiagnClassification) {
            $this
                ->addUsingAlias(BrandCampiagnTableMap::COL_BRAND_CAMPIAGN_ID, $brandCampiagnClassification->getBrandCampiagnId(), $comparison);

            return $this;
        } elseif ($brandCampiagnClassification instanceof ObjectCollection) {
            $this
                ->useBrandCampiagnClassificationQuery()
                ->filterByPrimaryKeys($brandCampiagnClassification->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByBrandCampiagnClassification() only accepts arguments of type \entities\BrandCampiagnClassification or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BrandCampiagnClassification relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinBrandCampiagnClassification(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BrandCampiagnClassification');

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
            $this->addJoinObject($join, 'BrandCampiagnClassification');
        }

        return $this;
    }

    /**
     * Use the BrandCampiagnClassification relation BrandCampiagnClassification object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\BrandCampiagnClassificationQuery A secondary query class using the current class as primary query
     */
    public function useBrandCampiagnClassificationQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinBrandCampiagnClassification($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BrandCampiagnClassification', '\entities\BrandCampiagnClassificationQuery');
    }

    /**
     * Use the BrandCampiagnClassification relation BrandCampiagnClassification object
     *
     * @param callable(\entities\BrandCampiagnClassificationQuery):\entities\BrandCampiagnClassificationQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withBrandCampiagnClassificationQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useBrandCampiagnClassificationQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to BrandCampiagnClassification table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\BrandCampiagnClassificationQuery The inner query object of the EXISTS statement
     */
    public function useBrandCampiagnClassificationExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\BrandCampiagnClassificationQuery */
        $q = $this->useExistsQuery('BrandCampiagnClassification', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to BrandCampiagnClassification table for a NOT EXISTS query.
     *
     * @see useBrandCampiagnClassificationExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\BrandCampiagnClassificationQuery The inner query object of the NOT EXISTS statement
     */
    public function useBrandCampiagnClassificationNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\BrandCampiagnClassificationQuery */
        $q = $this->useExistsQuery('BrandCampiagnClassification', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to BrandCampiagnClassification table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\BrandCampiagnClassificationQuery The inner query object of the IN statement
     */
    public function useInBrandCampiagnClassificationQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\BrandCampiagnClassificationQuery */
        $q = $this->useInQuery('BrandCampiagnClassification', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to BrandCampiagnClassification table for a NOT IN query.
     *
     * @see useBrandCampiagnClassificationInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\BrandCampiagnClassificationQuery The inner query object of the NOT IN statement
     */
    public function useNotInBrandCampiagnClassificationQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\BrandCampiagnClassificationQuery */
        $q = $this->useInQuery('BrandCampiagnClassification', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\BrandCampiagnDoctors object
     *
     * @param \entities\BrandCampiagnDoctors|ObjectCollection $brandCampiagnDoctors the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBrandCampiagnDoctors($brandCampiagnDoctors, ?string $comparison = null)
    {
        if ($brandCampiagnDoctors instanceof \entities\BrandCampiagnDoctors) {
            $this
                ->addUsingAlias(BrandCampiagnTableMap::COL_BRAND_CAMPIAGN_ID, $brandCampiagnDoctors->getBrandCampiagnId(), $comparison);

            return $this;
        } elseif ($brandCampiagnDoctors instanceof ObjectCollection) {
            $this
                ->useBrandCampiagnDoctorsQuery()
                ->filterByPrimaryKeys($brandCampiagnDoctors->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByBrandCampiagnDoctors() only accepts arguments of type \entities\BrandCampiagnDoctors or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BrandCampiagnDoctors relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinBrandCampiagnDoctors(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BrandCampiagnDoctors');

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
            $this->addJoinObject($join, 'BrandCampiagnDoctors');
        }

        return $this;
    }

    /**
     * Use the BrandCampiagnDoctors relation BrandCampiagnDoctors object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\BrandCampiagnDoctorsQuery A secondary query class using the current class as primary query
     */
    public function useBrandCampiagnDoctorsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinBrandCampiagnDoctors($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BrandCampiagnDoctors', '\entities\BrandCampiagnDoctorsQuery');
    }

    /**
     * Use the BrandCampiagnDoctors relation BrandCampiagnDoctors object
     *
     * @param callable(\entities\BrandCampiagnDoctorsQuery):\entities\BrandCampiagnDoctorsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withBrandCampiagnDoctorsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useBrandCampiagnDoctorsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to BrandCampiagnDoctors table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\BrandCampiagnDoctorsQuery The inner query object of the EXISTS statement
     */
    public function useBrandCampiagnDoctorsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\BrandCampiagnDoctorsQuery */
        $q = $this->useExistsQuery('BrandCampiagnDoctors', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to BrandCampiagnDoctors table for a NOT EXISTS query.
     *
     * @see useBrandCampiagnDoctorsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\BrandCampiagnDoctorsQuery The inner query object of the NOT EXISTS statement
     */
    public function useBrandCampiagnDoctorsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\BrandCampiagnDoctorsQuery */
        $q = $this->useExistsQuery('BrandCampiagnDoctors', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to BrandCampiagnDoctors table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\BrandCampiagnDoctorsQuery The inner query object of the IN statement
     */
    public function useInBrandCampiagnDoctorsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\BrandCampiagnDoctorsQuery */
        $q = $this->useInQuery('BrandCampiagnDoctors', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to BrandCampiagnDoctors table for a NOT IN query.
     *
     * @see useBrandCampiagnDoctorsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\BrandCampiagnDoctorsQuery The inner query object of the NOT IN statement
     */
    public function useNotInBrandCampiagnDoctorsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\BrandCampiagnDoctorsQuery */
        $q = $this->useInQuery('BrandCampiagnDoctors', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\BrandCampiagnVisitPlan object
     *
     * @param \entities\BrandCampiagnVisitPlan|ObjectCollection $brandCampiagnVisitPlan the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBrandCampiagnVisitPlan($brandCampiagnVisitPlan, ?string $comparison = null)
    {
        if ($brandCampiagnVisitPlan instanceof \entities\BrandCampiagnVisitPlan) {
            $this
                ->addUsingAlias(BrandCampiagnTableMap::COL_BRAND_CAMPIAGN_ID, $brandCampiagnVisitPlan->getBrandCampiagnId(), $comparison);

            return $this;
        } elseif ($brandCampiagnVisitPlan instanceof ObjectCollection) {
            $this
                ->useBrandCampiagnVisitPlanQuery()
                ->filterByPrimaryKeys($brandCampiagnVisitPlan->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByBrandCampiagnVisitPlan() only accepts arguments of type \entities\BrandCampiagnVisitPlan or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BrandCampiagnVisitPlan relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinBrandCampiagnVisitPlan(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BrandCampiagnVisitPlan');

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
            $this->addJoinObject($join, 'BrandCampiagnVisitPlan');
        }

        return $this;
    }

    /**
     * Use the BrandCampiagnVisitPlan relation BrandCampiagnVisitPlan object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\BrandCampiagnVisitPlanQuery A secondary query class using the current class as primary query
     */
    public function useBrandCampiagnVisitPlanQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinBrandCampiagnVisitPlan($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BrandCampiagnVisitPlan', '\entities\BrandCampiagnVisitPlanQuery');
    }

    /**
     * Use the BrandCampiagnVisitPlan relation BrandCampiagnVisitPlan object
     *
     * @param callable(\entities\BrandCampiagnVisitPlanQuery):\entities\BrandCampiagnVisitPlanQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withBrandCampiagnVisitPlanQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useBrandCampiagnVisitPlanQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to BrandCampiagnVisitPlan table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\BrandCampiagnVisitPlanQuery The inner query object of the EXISTS statement
     */
    public function useBrandCampiagnVisitPlanExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\BrandCampiagnVisitPlanQuery */
        $q = $this->useExistsQuery('BrandCampiagnVisitPlan', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to BrandCampiagnVisitPlan table for a NOT EXISTS query.
     *
     * @see useBrandCampiagnVisitPlanExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\BrandCampiagnVisitPlanQuery The inner query object of the NOT EXISTS statement
     */
    public function useBrandCampiagnVisitPlanNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\BrandCampiagnVisitPlanQuery */
        $q = $this->useExistsQuery('BrandCampiagnVisitPlan', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to BrandCampiagnVisitPlan table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\BrandCampiagnVisitPlanQuery The inner query object of the IN statement
     */
    public function useInBrandCampiagnVisitPlanQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\BrandCampiagnVisitPlanQuery */
        $q = $this->useInQuery('BrandCampiagnVisitPlan', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to BrandCampiagnVisitPlan table for a NOT IN query.
     *
     * @see useBrandCampiagnVisitPlanInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\BrandCampiagnVisitPlanQuery The inner query object of the NOT IN statement
     */
    public function useNotInBrandCampiagnVisitPlanQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\BrandCampiagnVisitPlanQuery */
        $q = $this->useInQuery('BrandCampiagnVisitPlan', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\BrandCampiagnVisits object
     *
     * @param \entities\BrandCampiagnVisits|ObjectCollection $brandCampiagnVisits the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBrandCampiagnVisits($brandCampiagnVisits, ?string $comparison = null)
    {
        if ($brandCampiagnVisits instanceof \entities\BrandCampiagnVisits) {
            $this
                ->addUsingAlias(BrandCampiagnTableMap::COL_BRAND_CAMPIAGN_ID, $brandCampiagnVisits->getBrandCampiagnId(), $comparison);

            return $this;
        } elseif ($brandCampiagnVisits instanceof ObjectCollection) {
            $this
                ->useBrandCampiagnVisitsQuery()
                ->filterByPrimaryKeys($brandCampiagnVisits->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByBrandCampiagnVisits() only accepts arguments of type \entities\BrandCampiagnVisits or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BrandCampiagnVisits relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinBrandCampiagnVisits(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BrandCampiagnVisits');

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
            $this->addJoinObject($join, 'BrandCampiagnVisits');
        }

        return $this;
    }

    /**
     * Use the BrandCampiagnVisits relation BrandCampiagnVisits object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\BrandCampiagnVisitsQuery A secondary query class using the current class as primary query
     */
    public function useBrandCampiagnVisitsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinBrandCampiagnVisits($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BrandCampiagnVisits', '\entities\BrandCampiagnVisitsQuery');
    }

    /**
     * Use the BrandCampiagnVisits relation BrandCampiagnVisits object
     *
     * @param callable(\entities\BrandCampiagnVisitsQuery):\entities\BrandCampiagnVisitsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withBrandCampiagnVisitsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useBrandCampiagnVisitsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to BrandCampiagnVisits table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\BrandCampiagnVisitsQuery The inner query object of the EXISTS statement
     */
    public function useBrandCampiagnVisitsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\BrandCampiagnVisitsQuery */
        $q = $this->useExistsQuery('BrandCampiagnVisits', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to BrandCampiagnVisits table for a NOT EXISTS query.
     *
     * @see useBrandCampiagnVisitsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\BrandCampiagnVisitsQuery The inner query object of the NOT EXISTS statement
     */
    public function useBrandCampiagnVisitsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\BrandCampiagnVisitsQuery */
        $q = $this->useExistsQuery('BrandCampiagnVisits', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to BrandCampiagnVisits table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\BrandCampiagnVisitsQuery The inner query object of the IN statement
     */
    public function useInBrandCampiagnVisitsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\BrandCampiagnVisitsQuery */
        $q = $this->useInQuery('BrandCampiagnVisits', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to BrandCampiagnVisits table for a NOT IN query.
     *
     * @see useBrandCampiagnVisitsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\BrandCampiagnVisitsQuery The inner query object of the NOT IN statement
     */
    public function useNotInBrandCampiagnVisitsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\BrandCampiagnVisitsQuery */
        $q = $this->useInQuery('BrandCampiagnVisits', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildBrandCampiagn $brandCampiagn Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($brandCampiagn = null)
    {
        if ($brandCampiagn) {
            $this->addUsingAlias(BrandCampiagnTableMap::COL_BRAND_CAMPIAGN_ID, $brandCampiagn->getBrandCampiagnId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the brand_campiagn table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(BrandCampiagnTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            BrandCampiagnTableMap::clearInstancePool();
            BrandCampiagnTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(BrandCampiagnTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(BrandCampiagnTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            BrandCampiagnTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            BrandCampiagnTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
