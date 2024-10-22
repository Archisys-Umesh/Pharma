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
use entities\OutletType as ChildOutletType;
use entities\OutletTypeQuery as ChildOutletTypeQuery;
use entities\Map\OutletTypeTableMap;

/**
 * Base class that represents a query for the `outlet_type` table.
 *
 * @method     ChildOutletTypeQuery orderByOutlettypeId($order = Criteria::ASC) Order by the outlettype_id column
 * @method     ChildOutletTypeQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildOutletTypeQuery orderByOutlettypeName($order = Criteria::ASC) Order by the outlettype_name column
 * @method     ChildOutletTypeQuery orderByIsoutletprimary($order = Criteria::ASC) Order by the isoutletprimary column
 * @method     ChildOutletTypeQuery orderByIsoutletendcustomer($order = Criteria::ASC) Order by the isoutletendcustomer column
 * @method     ChildOutletTypeQuery orderByIsenabled($order = Criteria::ASC) Order by the isenabled column
 * @method     ChildOutletTypeQuery orderByOutletparent($order = Criteria::ASC) Order by the outletparent column
 * @method     ChildOutletTypeQuery orderByImageMediaId($order = Criteria::ASC) Order by the image_media_id column
 * @method     ChildOutletTypeQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildOutletTypeQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildOutletTypeQuery orderByOnboardEnabled($order = Criteria::ASC) Order by the onboard_enabled column
 * @method     ChildOutletTypeQuery orderByOrgUnitId($order = Criteria::ASC) Order by the org_unit_id column
 *
 * @method     ChildOutletTypeQuery groupByOutlettypeId() Group by the outlettype_id column
 * @method     ChildOutletTypeQuery groupByCompanyId() Group by the company_id column
 * @method     ChildOutletTypeQuery groupByOutlettypeName() Group by the outlettype_name column
 * @method     ChildOutletTypeQuery groupByIsoutletprimary() Group by the isoutletprimary column
 * @method     ChildOutletTypeQuery groupByIsoutletendcustomer() Group by the isoutletendcustomer column
 * @method     ChildOutletTypeQuery groupByIsenabled() Group by the isenabled column
 * @method     ChildOutletTypeQuery groupByOutletparent() Group by the outletparent column
 * @method     ChildOutletTypeQuery groupByImageMediaId() Group by the image_media_id column
 * @method     ChildOutletTypeQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildOutletTypeQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildOutletTypeQuery groupByOnboardEnabled() Group by the onboard_enabled column
 * @method     ChildOutletTypeQuery groupByOrgUnitId() Group by the org_unit_id column
 *
 * @method     ChildOutletTypeQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildOutletTypeQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildOutletTypeQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildOutletTypeQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildOutletTypeQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildOutletTypeQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildOutletTypeQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildOutletTypeQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildOutletTypeQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildOutletTypeQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildOutletTypeQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildOutletTypeQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildOutletTypeQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     ChildOutletTypeQuery leftJoinMediaFiles($relationAlias = null) Adds a LEFT JOIN clause to the query using the MediaFiles relation
 * @method     ChildOutletTypeQuery rightJoinMediaFiles($relationAlias = null) Adds a RIGHT JOIN clause to the query using the MediaFiles relation
 * @method     ChildOutletTypeQuery innerJoinMediaFiles($relationAlias = null) Adds a INNER JOIN clause to the query using the MediaFiles relation
 *
 * @method     ChildOutletTypeQuery joinWithMediaFiles($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the MediaFiles relation
 *
 * @method     ChildOutletTypeQuery leftJoinWithMediaFiles() Adds a LEFT JOIN clause and with to the query using the MediaFiles relation
 * @method     ChildOutletTypeQuery rightJoinWithMediaFiles() Adds a RIGHT JOIN clause and with to the query using the MediaFiles relation
 * @method     ChildOutletTypeQuery innerJoinWithMediaFiles() Adds a INNER JOIN clause and with to the query using the MediaFiles relation
 *
 * @method     ChildOutletTypeQuery leftJoinBrandCampiagn($relationAlias = null) Adds a LEFT JOIN clause to the query using the BrandCampiagn relation
 * @method     ChildOutletTypeQuery rightJoinBrandCampiagn($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BrandCampiagn relation
 * @method     ChildOutletTypeQuery innerJoinBrandCampiagn($relationAlias = null) Adds a INNER JOIN clause to the query using the BrandCampiagn relation
 *
 * @method     ChildOutletTypeQuery joinWithBrandCampiagn($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BrandCampiagn relation
 *
 * @method     ChildOutletTypeQuery leftJoinWithBrandCampiagn() Adds a LEFT JOIN clause and with to the query using the BrandCampiagn relation
 * @method     ChildOutletTypeQuery rightJoinWithBrandCampiagn() Adds a RIGHT JOIN clause and with to the query using the BrandCampiagn relation
 * @method     ChildOutletTypeQuery innerJoinWithBrandCampiagn() Adds a INNER JOIN clause and with to the query using the BrandCampiagn relation
 *
 * @method     ChildOutletTypeQuery leftJoinOffers($relationAlias = null) Adds a LEFT JOIN clause to the query using the Offers relation
 * @method     ChildOutletTypeQuery rightJoinOffers($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Offers relation
 * @method     ChildOutletTypeQuery innerJoinOffers($relationAlias = null) Adds a INNER JOIN clause to the query using the Offers relation
 *
 * @method     ChildOutletTypeQuery joinWithOffers($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Offers relation
 *
 * @method     ChildOutletTypeQuery leftJoinWithOffers() Adds a LEFT JOIN clause and with to the query using the Offers relation
 * @method     ChildOutletTypeQuery rightJoinWithOffers() Adds a RIGHT JOIN clause and with to the query using the Offers relation
 * @method     ChildOutletTypeQuery innerJoinWithOffers() Adds a INNER JOIN clause and with to the query using the Offers relation
 *
 * @method     ChildOutletTypeQuery leftJoinOnBoardRequest($relationAlias = null) Adds a LEFT JOIN clause to the query using the OnBoardRequest relation
 * @method     ChildOutletTypeQuery rightJoinOnBoardRequest($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OnBoardRequest relation
 * @method     ChildOutletTypeQuery innerJoinOnBoardRequest($relationAlias = null) Adds a INNER JOIN clause to the query using the OnBoardRequest relation
 *
 * @method     ChildOutletTypeQuery joinWithOnBoardRequest($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OnBoardRequest relation
 *
 * @method     ChildOutletTypeQuery leftJoinWithOnBoardRequest() Adds a LEFT JOIN clause and with to the query using the OnBoardRequest relation
 * @method     ChildOutletTypeQuery rightJoinWithOnBoardRequest() Adds a RIGHT JOIN clause and with to the query using the OnBoardRequest relation
 * @method     ChildOutletTypeQuery innerJoinWithOnBoardRequest() Adds a INNER JOIN clause and with to the query using the OnBoardRequest relation
 *
 * @method     ChildOutletTypeQuery leftJoinOnBoardRequestAddress($relationAlias = null) Adds a LEFT JOIN clause to the query using the OnBoardRequestAddress relation
 * @method     ChildOutletTypeQuery rightJoinOnBoardRequestAddress($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OnBoardRequestAddress relation
 * @method     ChildOutletTypeQuery innerJoinOnBoardRequestAddress($relationAlias = null) Adds a INNER JOIN clause to the query using the OnBoardRequestAddress relation
 *
 * @method     ChildOutletTypeQuery joinWithOnBoardRequestAddress($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OnBoardRequestAddress relation
 *
 * @method     ChildOutletTypeQuery leftJoinWithOnBoardRequestAddress() Adds a LEFT JOIN clause and with to the query using the OnBoardRequestAddress relation
 * @method     ChildOutletTypeQuery rightJoinWithOnBoardRequestAddress() Adds a RIGHT JOIN clause and with to the query using the OnBoardRequestAddress relation
 * @method     ChildOutletTypeQuery innerJoinWithOnBoardRequestAddress() Adds a INNER JOIN clause and with to the query using the OnBoardRequestAddress relation
 *
 * @method     ChildOutletTypeQuery leftJoinOnBoardRequiredFields($relationAlias = null) Adds a LEFT JOIN clause to the query using the OnBoardRequiredFields relation
 * @method     ChildOutletTypeQuery rightJoinOnBoardRequiredFields($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OnBoardRequiredFields relation
 * @method     ChildOutletTypeQuery innerJoinOnBoardRequiredFields($relationAlias = null) Adds a INNER JOIN clause to the query using the OnBoardRequiredFields relation
 *
 * @method     ChildOutletTypeQuery joinWithOnBoardRequiredFields($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OnBoardRequiredFields relation
 *
 * @method     ChildOutletTypeQuery leftJoinWithOnBoardRequiredFields() Adds a LEFT JOIN clause and with to the query using the OnBoardRequiredFields relation
 * @method     ChildOutletTypeQuery rightJoinWithOnBoardRequiredFields() Adds a RIGHT JOIN clause and with to the query using the OnBoardRequiredFields relation
 * @method     ChildOutletTypeQuery innerJoinWithOnBoardRequiredFields() Adds a INNER JOIN clause and with to the query using the OnBoardRequiredFields relation
 *
 * @method     ChildOutletTypeQuery leftJoinOutletOutcomes($relationAlias = null) Adds a LEFT JOIN clause to the query using the OutletOutcomes relation
 * @method     ChildOutletTypeQuery rightJoinOutletOutcomes($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OutletOutcomes relation
 * @method     ChildOutletTypeQuery innerJoinOutletOutcomes($relationAlias = null) Adds a INNER JOIN clause to the query using the OutletOutcomes relation
 *
 * @method     ChildOutletTypeQuery joinWithOutletOutcomes($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OutletOutcomes relation
 *
 * @method     ChildOutletTypeQuery leftJoinWithOutletOutcomes() Adds a LEFT JOIN clause and with to the query using the OutletOutcomes relation
 * @method     ChildOutletTypeQuery rightJoinWithOutletOutcomes() Adds a RIGHT JOIN clause and with to the query using the OutletOutcomes relation
 * @method     ChildOutletTypeQuery innerJoinWithOutletOutcomes() Adds a INNER JOIN clause and with to the query using the OutletOutcomes relation
 *
 * @method     ChildOutletTypeQuery leftJoinOutlets($relationAlias = null) Adds a LEFT JOIN clause to the query using the Outlets relation
 * @method     ChildOutletTypeQuery rightJoinOutlets($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Outlets relation
 * @method     ChildOutletTypeQuery innerJoinOutlets($relationAlias = null) Adds a INNER JOIN clause to the query using the Outlets relation
 *
 * @method     ChildOutletTypeQuery joinWithOutlets($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Outlets relation
 *
 * @method     ChildOutletTypeQuery leftJoinWithOutlets() Adds a LEFT JOIN clause and with to the query using the Outlets relation
 * @method     ChildOutletTypeQuery rightJoinWithOutlets() Adds a RIGHT JOIN clause and with to the query using the Outlets relation
 * @method     ChildOutletTypeQuery innerJoinWithOutlets() Adds a INNER JOIN clause and with to the query using the Outlets relation
 *
 * @method     ChildOutletTypeQuery leftJoinOutlettypemodules($relationAlias = null) Adds a LEFT JOIN clause to the query using the Outlettypemodules relation
 * @method     ChildOutletTypeQuery rightJoinOutlettypemodules($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Outlettypemodules relation
 * @method     ChildOutletTypeQuery innerJoinOutlettypemodules($relationAlias = null) Adds a INNER JOIN clause to the query using the Outlettypemodules relation
 *
 * @method     ChildOutletTypeQuery joinWithOutlettypemodules($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Outlettypemodules relation
 *
 * @method     ChildOutletTypeQuery leftJoinWithOutlettypemodules() Adds a LEFT JOIN clause and with to the query using the Outlettypemodules relation
 * @method     ChildOutletTypeQuery rightJoinWithOutlettypemodules() Adds a RIGHT JOIN clause and with to the query using the Outlettypemodules relation
 * @method     ChildOutletTypeQuery innerJoinWithOutlettypemodules() Adds a INNER JOIN clause and with to the query using the Outlettypemodules relation
 *
 * @method     ChildOutletTypeQuery leftJoinSgpiMaster($relationAlias = null) Adds a LEFT JOIN clause to the query using the SgpiMaster relation
 * @method     ChildOutletTypeQuery rightJoinSgpiMaster($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SgpiMaster relation
 * @method     ChildOutletTypeQuery innerJoinSgpiMaster($relationAlias = null) Adds a INNER JOIN clause to the query using the SgpiMaster relation
 *
 * @method     ChildOutletTypeQuery joinWithSgpiMaster($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SgpiMaster relation
 *
 * @method     ChildOutletTypeQuery leftJoinWithSgpiMaster() Adds a LEFT JOIN clause and with to the query using the SgpiMaster relation
 * @method     ChildOutletTypeQuery rightJoinWithSgpiMaster() Adds a RIGHT JOIN clause and with to the query using the SgpiMaster relation
 * @method     ChildOutletTypeQuery innerJoinWithSgpiMaster() Adds a INNER JOIN clause and with to the query using the SgpiMaster relation
 *
 * @method     ChildOutletTypeQuery leftJoinSurvey($relationAlias = null) Adds a LEFT JOIN clause to the query using the Survey relation
 * @method     ChildOutletTypeQuery rightJoinSurvey($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Survey relation
 * @method     ChildOutletTypeQuery innerJoinSurvey($relationAlias = null) Adds a INNER JOIN clause to the query using the Survey relation
 *
 * @method     ChildOutletTypeQuery joinWithSurvey($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Survey relation
 *
 * @method     ChildOutletTypeQuery leftJoinWithSurvey() Adds a LEFT JOIN clause and with to the query using the Survey relation
 * @method     ChildOutletTypeQuery rightJoinWithSurvey() Adds a RIGHT JOIN clause and with to the query using the Survey relation
 * @method     ChildOutletTypeQuery innerJoinWithSurvey() Adds a INNER JOIN clause and with to the query using the Survey relation
 *
 * @method     \entities\CompanyQuery|\entities\MediaFilesQuery|\entities\BrandCampiagnQuery|\entities\OffersQuery|\entities\OnBoardRequestQuery|\entities\OnBoardRequestAddressQuery|\entities\OnBoardRequiredFieldsQuery|\entities\OutletOutcomesQuery|\entities\OutletsQuery|\entities\OutlettypemodulesQuery|\entities\SgpiMasterQuery|\entities\SurveyQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildOutletType|null findOne(?ConnectionInterface $con = null) Return the first ChildOutletType matching the query
 * @method     ChildOutletType findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildOutletType matching the query, or a new ChildOutletType object populated from the query conditions when no match is found
 *
 * @method     ChildOutletType|null findOneByOutlettypeId(int $outlettype_id) Return the first ChildOutletType filtered by the outlettype_id column
 * @method     ChildOutletType|null findOneByCompanyId(int $company_id) Return the first ChildOutletType filtered by the company_id column
 * @method     ChildOutletType|null findOneByOutlettypeName(string $outlettype_name) Return the first ChildOutletType filtered by the outlettype_name column
 * @method     ChildOutletType|null findOneByIsoutletprimary(int $isoutletprimary) Return the first ChildOutletType filtered by the isoutletprimary column
 * @method     ChildOutletType|null findOneByIsoutletendcustomer(int $isoutletendcustomer) Return the first ChildOutletType filtered by the isoutletendcustomer column
 * @method     ChildOutletType|null findOneByIsenabled(int $isenabled) Return the first ChildOutletType filtered by the isenabled column
 * @method     ChildOutletType|null findOneByOutletparent(int $outletparent) Return the first ChildOutletType filtered by the outletparent column
 * @method     ChildOutletType|null findOneByImageMediaId(int $image_media_id) Return the first ChildOutletType filtered by the image_media_id column
 * @method     ChildOutletType|null findOneByCreatedAt(string $created_at) Return the first ChildOutletType filtered by the created_at column
 * @method     ChildOutletType|null findOneByUpdatedAt(string $updated_at) Return the first ChildOutletType filtered by the updated_at column
 * @method     ChildOutletType|null findOneByOnboardEnabled(boolean $onboard_enabled) Return the first ChildOutletType filtered by the onboard_enabled column
 * @method     ChildOutletType|null findOneByOrgUnitId(string $org_unit_id) Return the first ChildOutletType filtered by the org_unit_id column
 *
 * @method     ChildOutletType requirePk($key, ?ConnectionInterface $con = null) Return the ChildOutletType by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletType requireOne(?ConnectionInterface $con = null) Return the first ChildOutletType matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOutletType requireOneByOutlettypeId(int $outlettype_id) Return the first ChildOutletType filtered by the outlettype_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletType requireOneByCompanyId(int $company_id) Return the first ChildOutletType filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletType requireOneByOutlettypeName(string $outlettype_name) Return the first ChildOutletType filtered by the outlettype_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletType requireOneByIsoutletprimary(int $isoutletprimary) Return the first ChildOutletType filtered by the isoutletprimary column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletType requireOneByIsoutletendcustomer(int $isoutletendcustomer) Return the first ChildOutletType filtered by the isoutletendcustomer column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletType requireOneByIsenabled(int $isenabled) Return the first ChildOutletType filtered by the isenabled column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletType requireOneByOutletparent(int $outletparent) Return the first ChildOutletType filtered by the outletparent column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletType requireOneByImageMediaId(int $image_media_id) Return the first ChildOutletType filtered by the image_media_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletType requireOneByCreatedAt(string $created_at) Return the first ChildOutletType filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletType requireOneByUpdatedAt(string $updated_at) Return the first ChildOutletType filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletType requireOneByOnboardEnabled(boolean $onboard_enabled) Return the first ChildOutletType filtered by the onboard_enabled column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletType requireOneByOrgUnitId(string $org_unit_id) Return the first ChildOutletType filtered by the org_unit_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOutletType[]|Collection find(?ConnectionInterface $con = null) Return ChildOutletType objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildOutletType> find(?ConnectionInterface $con = null) Return ChildOutletType objects based on current ModelCriteria
 *
 * @method     ChildOutletType[]|Collection findByOutlettypeId(int|array<int> $outlettype_id) Return ChildOutletType objects filtered by the outlettype_id column
 * @psalm-method Collection&\Traversable<ChildOutletType> findByOutlettypeId(int|array<int> $outlettype_id) Return ChildOutletType objects filtered by the outlettype_id column
 * @method     ChildOutletType[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildOutletType objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildOutletType> findByCompanyId(int|array<int> $company_id) Return ChildOutletType objects filtered by the company_id column
 * @method     ChildOutletType[]|Collection findByOutlettypeName(string|array<string> $outlettype_name) Return ChildOutletType objects filtered by the outlettype_name column
 * @psalm-method Collection&\Traversable<ChildOutletType> findByOutlettypeName(string|array<string> $outlettype_name) Return ChildOutletType objects filtered by the outlettype_name column
 * @method     ChildOutletType[]|Collection findByIsoutletprimary(int|array<int> $isoutletprimary) Return ChildOutletType objects filtered by the isoutletprimary column
 * @psalm-method Collection&\Traversable<ChildOutletType> findByIsoutletprimary(int|array<int> $isoutletprimary) Return ChildOutletType objects filtered by the isoutletprimary column
 * @method     ChildOutletType[]|Collection findByIsoutletendcustomer(int|array<int> $isoutletendcustomer) Return ChildOutletType objects filtered by the isoutletendcustomer column
 * @psalm-method Collection&\Traversable<ChildOutletType> findByIsoutletendcustomer(int|array<int> $isoutletendcustomer) Return ChildOutletType objects filtered by the isoutletendcustomer column
 * @method     ChildOutletType[]|Collection findByIsenabled(int|array<int> $isenabled) Return ChildOutletType objects filtered by the isenabled column
 * @psalm-method Collection&\Traversable<ChildOutletType> findByIsenabled(int|array<int> $isenabled) Return ChildOutletType objects filtered by the isenabled column
 * @method     ChildOutletType[]|Collection findByOutletparent(int|array<int> $outletparent) Return ChildOutletType objects filtered by the outletparent column
 * @psalm-method Collection&\Traversable<ChildOutletType> findByOutletparent(int|array<int> $outletparent) Return ChildOutletType objects filtered by the outletparent column
 * @method     ChildOutletType[]|Collection findByImageMediaId(int|array<int> $image_media_id) Return ChildOutletType objects filtered by the image_media_id column
 * @psalm-method Collection&\Traversable<ChildOutletType> findByImageMediaId(int|array<int> $image_media_id) Return ChildOutletType objects filtered by the image_media_id column
 * @method     ChildOutletType[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildOutletType objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildOutletType> findByCreatedAt(string|array<string> $created_at) Return ChildOutletType objects filtered by the created_at column
 * @method     ChildOutletType[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildOutletType objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildOutletType> findByUpdatedAt(string|array<string> $updated_at) Return ChildOutletType objects filtered by the updated_at column
 * @method     ChildOutletType[]|Collection findByOnboardEnabled(boolean|array<boolean> $onboard_enabled) Return ChildOutletType objects filtered by the onboard_enabled column
 * @psalm-method Collection&\Traversable<ChildOutletType> findByOnboardEnabled(boolean|array<boolean> $onboard_enabled) Return ChildOutletType objects filtered by the onboard_enabled column
 * @method     ChildOutletType[]|Collection findByOrgUnitId(string|array<string> $org_unit_id) Return ChildOutletType objects filtered by the org_unit_id column
 * @psalm-method Collection&\Traversable<ChildOutletType> findByOrgUnitId(string|array<string> $org_unit_id) Return ChildOutletType objects filtered by the org_unit_id column
 *
 * @method     ChildOutletType[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildOutletType> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class OutletTypeQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\OutletTypeQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\OutletType', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildOutletTypeQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildOutletTypeQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildOutletTypeQuery) {
            return $criteria;
        }
        $query = new ChildOutletTypeQuery();
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
     * @return ChildOutletType|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(OutletTypeTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = OutletTypeTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildOutletType A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT outlettype_id, company_id, outlettype_name, isoutletprimary, isoutletendcustomer, isenabled, outletparent, image_media_id, created_at, updated_at, onboard_enabled, org_unit_id FROM outlet_type WHERE outlettype_id = :p0';
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
            /** @var ChildOutletType $obj */
            $obj = new ChildOutletType();
            $obj->hydrate($row);
            OutletTypeTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildOutletType|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(OutletTypeTableMap::COL_OUTLETTYPE_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(OutletTypeTableMap::COL_OUTLETTYPE_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(OutletTypeTableMap::COL_OUTLETTYPE_ID, $outlettypeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outlettypeId['max'])) {
                $this->addUsingAlias(OutletTypeTableMap::COL_OUTLETTYPE_ID, $outlettypeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletTypeTableMap::COL_OUTLETTYPE_ID, $outlettypeId, $comparison);

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
                $this->addUsingAlias(OutletTypeTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(OutletTypeTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletTypeTableMap::COL_COMPANY_ID, $companyId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlettype_name column
     *
     * Example usage:
     * <code>
     * $query->filterByOutlettypeName('fooValue');   // WHERE outlettype_name = 'fooValue'
     * $query->filterByOutlettypeName('%fooValue%', Criteria::LIKE); // WHERE outlettype_name LIKE '%fooValue%'
     * $query->filterByOutlettypeName(['foo', 'bar']); // WHERE outlettype_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $outlettypeName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutlettypeName($outlettypeName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($outlettypeName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletTypeTableMap::COL_OUTLETTYPE_NAME, $outlettypeName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the isoutletprimary column
     *
     * Example usage:
     * <code>
     * $query->filterByIsoutletprimary(1234); // WHERE isoutletprimary = 1234
     * $query->filterByIsoutletprimary(array(12, 34)); // WHERE isoutletprimary IN (12, 34)
     * $query->filterByIsoutletprimary(array('min' => 12)); // WHERE isoutletprimary > 12
     * </code>
     *
     * @param mixed $isoutletprimary The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIsoutletprimary($isoutletprimary = null, ?string $comparison = null)
    {
        if (is_array($isoutletprimary)) {
            $useMinMax = false;
            if (isset($isoutletprimary['min'])) {
                $this->addUsingAlias(OutletTypeTableMap::COL_ISOUTLETPRIMARY, $isoutletprimary['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($isoutletprimary['max'])) {
                $this->addUsingAlias(OutletTypeTableMap::COL_ISOUTLETPRIMARY, $isoutletprimary['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletTypeTableMap::COL_ISOUTLETPRIMARY, $isoutletprimary, $comparison);

        return $this;
    }

    /**
     * Filter the query on the isoutletendcustomer column
     *
     * Example usage:
     * <code>
     * $query->filterByIsoutletendcustomer(1234); // WHERE isoutletendcustomer = 1234
     * $query->filterByIsoutletendcustomer(array(12, 34)); // WHERE isoutletendcustomer IN (12, 34)
     * $query->filterByIsoutletendcustomer(array('min' => 12)); // WHERE isoutletendcustomer > 12
     * </code>
     *
     * @param mixed $isoutletendcustomer The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIsoutletendcustomer($isoutletendcustomer = null, ?string $comparison = null)
    {
        if (is_array($isoutletendcustomer)) {
            $useMinMax = false;
            if (isset($isoutletendcustomer['min'])) {
                $this->addUsingAlias(OutletTypeTableMap::COL_ISOUTLETENDCUSTOMER, $isoutletendcustomer['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($isoutletendcustomer['max'])) {
                $this->addUsingAlias(OutletTypeTableMap::COL_ISOUTLETENDCUSTOMER, $isoutletendcustomer['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletTypeTableMap::COL_ISOUTLETENDCUSTOMER, $isoutletendcustomer, $comparison);

        return $this;
    }

    /**
     * Filter the query on the isenabled column
     *
     * Example usage:
     * <code>
     * $query->filterByIsenabled(1234); // WHERE isenabled = 1234
     * $query->filterByIsenabled(array(12, 34)); // WHERE isenabled IN (12, 34)
     * $query->filterByIsenabled(array('min' => 12)); // WHERE isenabled > 12
     * </code>
     *
     * @param mixed $isenabled The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIsenabled($isenabled = null, ?string $comparison = null)
    {
        if (is_array($isenabled)) {
            $useMinMax = false;
            if (isset($isenabled['min'])) {
                $this->addUsingAlias(OutletTypeTableMap::COL_ISENABLED, $isenabled['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($isenabled['max'])) {
                $this->addUsingAlias(OutletTypeTableMap::COL_ISENABLED, $isenabled['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletTypeTableMap::COL_ISENABLED, $isenabled, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outletparent column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletparent(1234); // WHERE outletparent = 1234
     * $query->filterByOutletparent(array(12, 34)); // WHERE outletparent IN (12, 34)
     * $query->filterByOutletparent(array('min' => 12)); // WHERE outletparent > 12
     * </code>
     *
     * @param mixed $outletparent The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletparent($outletparent = null, ?string $comparison = null)
    {
        if (is_array($outletparent)) {
            $useMinMax = false;
            if (isset($outletparent['min'])) {
                $this->addUsingAlias(OutletTypeTableMap::COL_OUTLETPARENT, $outletparent['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outletparent['max'])) {
                $this->addUsingAlias(OutletTypeTableMap::COL_OUTLETPARENT, $outletparent['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletTypeTableMap::COL_OUTLETPARENT, $outletparent, $comparison);

        return $this;
    }

    /**
     * Filter the query on the image_media_id column
     *
     * Example usage:
     * <code>
     * $query->filterByImageMediaId(1234); // WHERE image_media_id = 1234
     * $query->filterByImageMediaId(array(12, 34)); // WHERE image_media_id IN (12, 34)
     * $query->filterByImageMediaId(array('min' => 12)); // WHERE image_media_id > 12
     * </code>
     *
     * @see       filterByMediaFiles()
     *
     * @param mixed $imageMediaId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByImageMediaId($imageMediaId = null, ?string $comparison = null)
    {
        if (is_array($imageMediaId)) {
            $useMinMax = false;
            if (isset($imageMediaId['min'])) {
                $this->addUsingAlias(OutletTypeTableMap::COL_IMAGE_MEDIA_ID, $imageMediaId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($imageMediaId['max'])) {
                $this->addUsingAlias(OutletTypeTableMap::COL_IMAGE_MEDIA_ID, $imageMediaId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletTypeTableMap::COL_IMAGE_MEDIA_ID, $imageMediaId, $comparison);

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
                $this->addUsingAlias(OutletTypeTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(OutletTypeTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletTypeTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(OutletTypeTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(OutletTypeTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletTypeTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the onboard_enabled column
     *
     * Example usage:
     * <code>
     * $query->filterByOnboardEnabled(true); // WHERE onboard_enabled = true
     * $query->filterByOnboardEnabled('yes'); // WHERE onboard_enabled = true
     * </code>
     *
     * @param bool|string $onboardEnabled The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOnboardEnabled($onboardEnabled = null, ?string $comparison = null)
    {
        if (is_string($onboardEnabled)) {
            $onboardEnabled = in_array(strtolower($onboardEnabled), array('false', 'off', '-', 'no', 'n', '0', ''), true) ? false : true;
        }

        $this->addUsingAlias(OutletTypeTableMap::COL_ONBOARD_ENABLED, $onboardEnabled, $comparison);

        return $this;
    }

    /**
     * Filter the query on the org_unit_id column
     *
     * Example usage:
     * <code>
     * $query->filterByOrgUnitId('fooValue');   // WHERE org_unit_id = 'fooValue'
     * $query->filterByOrgUnitId('%fooValue%', Criteria::LIKE); // WHERE org_unit_id LIKE '%fooValue%'
     * $query->filterByOrgUnitId(['foo', 'bar']); // WHERE org_unit_id IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $orgUnitId The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrgUnitId($orgUnitId = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($orgUnitId)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletTypeTableMap::COL_ORG_UNIT_ID, $orgUnitId, $comparison);

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
                ->addUsingAlias(OutletTypeTableMap::COL_COMPANY_ID, $company->getCompanyId(), $comparison);
        } elseif ($company instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(OutletTypeTableMap::COL_COMPANY_ID, $company->toKeyValue('PrimaryKey', 'CompanyId'), $comparison);

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
     * Filter the query by a related \entities\MediaFiles object
     *
     * @param \entities\MediaFiles|ObjectCollection $mediaFiles The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMediaFiles($mediaFiles, ?string $comparison = null)
    {
        if ($mediaFiles instanceof \entities\MediaFiles) {
            return $this
                ->addUsingAlias(OutletTypeTableMap::COL_IMAGE_MEDIA_ID, $mediaFiles->getMediaId(), $comparison);
        } elseif ($mediaFiles instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(OutletTypeTableMap::COL_IMAGE_MEDIA_ID, $mediaFiles->toKeyValue('PrimaryKey', 'MediaId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByMediaFiles() only accepts arguments of type \entities\MediaFiles or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the MediaFiles relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinMediaFiles(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('MediaFiles');

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
            $this->addJoinObject($join, 'MediaFiles');
        }

        return $this;
    }

    /**
     * Use the MediaFiles relation MediaFiles object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\MediaFilesQuery A secondary query class using the current class as primary query
     */
    public function useMediaFilesQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinMediaFiles($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'MediaFiles', '\entities\MediaFilesQuery');
    }

    /**
     * Use the MediaFiles relation MediaFiles object
     *
     * @param callable(\entities\MediaFilesQuery):\entities\MediaFilesQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withMediaFilesQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useMediaFilesQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to MediaFiles table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\MediaFilesQuery The inner query object of the EXISTS statement
     */
    public function useMediaFilesExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\MediaFilesQuery */
        $q = $this->useExistsQuery('MediaFiles', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to MediaFiles table for a NOT EXISTS query.
     *
     * @see useMediaFilesExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\MediaFilesQuery The inner query object of the NOT EXISTS statement
     */
    public function useMediaFilesNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\MediaFilesQuery */
        $q = $this->useExistsQuery('MediaFiles', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to MediaFiles table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\MediaFilesQuery The inner query object of the IN statement
     */
    public function useInMediaFilesQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\MediaFilesQuery */
        $q = $this->useInQuery('MediaFiles', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to MediaFiles table for a NOT IN query.
     *
     * @see useMediaFilesInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\MediaFilesQuery The inner query object of the NOT IN statement
     */
    public function useNotInMediaFilesQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\MediaFilesQuery */
        $q = $this->useInQuery('MediaFiles', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(OutletTypeTableMap::COL_OUTLETTYPE_ID, $brandCampiagn->getOutlettypeId(), $comparison);

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
     * Filter the query by a related \entities\Offers object
     *
     * @param \entities\Offers|ObjectCollection $offers the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOffers($offers, ?string $comparison = null)
    {
        if ($offers instanceof \entities\Offers) {
            $this
                ->addUsingAlias(OutletTypeTableMap::COL_OUTLETTYPE_ID, $offers->getOutletTypeId(), $comparison);

            return $this;
        } elseif ($offers instanceof ObjectCollection) {
            $this
                ->useOffersQuery()
                ->filterByPrimaryKeys($offers->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByOffers() only accepts arguments of type \entities\Offers or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Offers relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOffers(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Offers');

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
            $this->addJoinObject($join, 'Offers');
        }

        return $this;
    }

    /**
     * Use the Offers relation Offers object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\OffersQuery A secondary query class using the current class as primary query
     */
    public function useOffersQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinOffers($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Offers', '\entities\OffersQuery');
    }

    /**
     * Use the Offers relation Offers object
     *
     * @param callable(\entities\OffersQuery):\entities\OffersQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOffersQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useOffersQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Offers table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\OffersQuery The inner query object of the EXISTS statement
     */
    public function useOffersExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\OffersQuery */
        $q = $this->useExistsQuery('Offers', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Offers table for a NOT EXISTS query.
     *
     * @see useOffersExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\OffersQuery The inner query object of the NOT EXISTS statement
     */
    public function useOffersNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OffersQuery */
        $q = $this->useExistsQuery('Offers', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Offers table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\OffersQuery The inner query object of the IN statement
     */
    public function useInOffersQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\OffersQuery */
        $q = $this->useInQuery('Offers', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Offers table for a NOT IN query.
     *
     * @see useOffersInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\OffersQuery The inner query object of the NOT IN statement
     */
    public function useNotInOffersQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OffersQuery */
        $q = $this->useInQuery('Offers', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\OnBoardRequest object
     *
     * @param \entities\OnBoardRequest|ObjectCollection $onBoardRequest the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOnBoardRequest($onBoardRequest, ?string $comparison = null)
    {
        if ($onBoardRequest instanceof \entities\OnBoardRequest) {
            $this
                ->addUsingAlias(OutletTypeTableMap::COL_OUTLETTYPE_ID, $onBoardRequest->getOutletTypeId(), $comparison);

            return $this;
        } elseif ($onBoardRequest instanceof ObjectCollection) {
            $this
                ->useOnBoardRequestQuery()
                ->filterByPrimaryKeys($onBoardRequest->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByOnBoardRequest() only accepts arguments of type \entities\OnBoardRequest or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OnBoardRequest relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOnBoardRequest(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OnBoardRequest');

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
            $this->addJoinObject($join, 'OnBoardRequest');
        }

        return $this;
    }

    /**
     * Use the OnBoardRequest relation OnBoardRequest object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\OnBoardRequestQuery A secondary query class using the current class as primary query
     */
    public function useOnBoardRequestQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinOnBoardRequest($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OnBoardRequest', '\entities\OnBoardRequestQuery');
    }

    /**
     * Use the OnBoardRequest relation OnBoardRequest object
     *
     * @param callable(\entities\OnBoardRequestQuery):\entities\OnBoardRequestQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOnBoardRequestQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useOnBoardRequestQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to OnBoardRequest table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\OnBoardRequestQuery The inner query object of the EXISTS statement
     */
    public function useOnBoardRequestExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\OnBoardRequestQuery */
        $q = $this->useExistsQuery('OnBoardRequest', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to OnBoardRequest table for a NOT EXISTS query.
     *
     * @see useOnBoardRequestExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\OnBoardRequestQuery The inner query object of the NOT EXISTS statement
     */
    public function useOnBoardRequestNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OnBoardRequestQuery */
        $q = $this->useExistsQuery('OnBoardRequest', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to OnBoardRequest table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\OnBoardRequestQuery The inner query object of the IN statement
     */
    public function useInOnBoardRequestQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\OnBoardRequestQuery */
        $q = $this->useInQuery('OnBoardRequest', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to OnBoardRequest table for a NOT IN query.
     *
     * @see useOnBoardRequestInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\OnBoardRequestQuery The inner query object of the NOT IN statement
     */
    public function useNotInOnBoardRequestQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OnBoardRequestQuery */
        $q = $this->useInQuery('OnBoardRequest', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(OutletTypeTableMap::COL_OUTLETTYPE_ID, $onBoardRequestAddress->getOutletSubTypeId(), $comparison);

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
     * Filter the query by a related \entities\OnBoardRequiredFields object
     *
     * @param \entities\OnBoardRequiredFields|ObjectCollection $onBoardRequiredFields the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOnBoardRequiredFields($onBoardRequiredFields, ?string $comparison = null)
    {
        if ($onBoardRequiredFields instanceof \entities\OnBoardRequiredFields) {
            $this
                ->addUsingAlias(OutletTypeTableMap::COL_OUTLETTYPE_ID, $onBoardRequiredFields->getOutletTypeId(), $comparison);

            return $this;
        } elseif ($onBoardRequiredFields instanceof ObjectCollection) {
            $this
                ->useOnBoardRequiredFieldsQuery()
                ->filterByPrimaryKeys($onBoardRequiredFields->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByOnBoardRequiredFields() only accepts arguments of type \entities\OnBoardRequiredFields or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OnBoardRequiredFields relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOnBoardRequiredFields(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OnBoardRequiredFields');

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
            $this->addJoinObject($join, 'OnBoardRequiredFields');
        }

        return $this;
    }

    /**
     * Use the OnBoardRequiredFields relation OnBoardRequiredFields object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\OnBoardRequiredFieldsQuery A secondary query class using the current class as primary query
     */
    public function useOnBoardRequiredFieldsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinOnBoardRequiredFields($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OnBoardRequiredFields', '\entities\OnBoardRequiredFieldsQuery');
    }

    /**
     * Use the OnBoardRequiredFields relation OnBoardRequiredFields object
     *
     * @param callable(\entities\OnBoardRequiredFieldsQuery):\entities\OnBoardRequiredFieldsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOnBoardRequiredFieldsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useOnBoardRequiredFieldsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to OnBoardRequiredFields table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\OnBoardRequiredFieldsQuery The inner query object of the EXISTS statement
     */
    public function useOnBoardRequiredFieldsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\OnBoardRequiredFieldsQuery */
        $q = $this->useExistsQuery('OnBoardRequiredFields', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to OnBoardRequiredFields table for a NOT EXISTS query.
     *
     * @see useOnBoardRequiredFieldsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\OnBoardRequiredFieldsQuery The inner query object of the NOT EXISTS statement
     */
    public function useOnBoardRequiredFieldsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OnBoardRequiredFieldsQuery */
        $q = $this->useExistsQuery('OnBoardRequiredFields', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to OnBoardRequiredFields table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\OnBoardRequiredFieldsQuery The inner query object of the IN statement
     */
    public function useInOnBoardRequiredFieldsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\OnBoardRequiredFieldsQuery */
        $q = $this->useInQuery('OnBoardRequiredFields', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to OnBoardRequiredFields table for a NOT IN query.
     *
     * @see useOnBoardRequiredFieldsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\OnBoardRequiredFieldsQuery The inner query object of the NOT IN statement
     */
    public function useNotInOnBoardRequiredFieldsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OnBoardRequiredFieldsQuery */
        $q = $this->useInQuery('OnBoardRequiredFields', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\OutletOutcomes object
     *
     * @param \entities\OutletOutcomes|ObjectCollection $outletOutcomes the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletOutcomes($outletOutcomes, ?string $comparison = null)
    {
        if ($outletOutcomes instanceof \entities\OutletOutcomes) {
            $this
                ->addUsingAlias(OutletTypeTableMap::COL_OUTLETTYPE_ID, $outletOutcomes->getOutletTypeId(), $comparison);

            return $this;
        } elseif ($outletOutcomes instanceof ObjectCollection) {
            $this
                ->useOutletOutcomesQuery()
                ->filterByPrimaryKeys($outletOutcomes->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByOutletOutcomes() only accepts arguments of type \entities\OutletOutcomes or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OutletOutcomes relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOutletOutcomes(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OutletOutcomes');

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
            $this->addJoinObject($join, 'OutletOutcomes');
        }

        return $this;
    }

    /**
     * Use the OutletOutcomes relation OutletOutcomes object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\OutletOutcomesQuery A secondary query class using the current class as primary query
     */
    public function useOutletOutcomesQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinOutletOutcomes($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OutletOutcomes', '\entities\OutletOutcomesQuery');
    }

    /**
     * Use the OutletOutcomes relation OutletOutcomes object
     *
     * @param callable(\entities\OutletOutcomesQuery):\entities\OutletOutcomesQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOutletOutcomesQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useOutletOutcomesQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to OutletOutcomes table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\OutletOutcomesQuery The inner query object of the EXISTS statement
     */
    public function useOutletOutcomesExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\OutletOutcomesQuery */
        $q = $this->useExistsQuery('OutletOutcomes', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to OutletOutcomes table for a NOT EXISTS query.
     *
     * @see useOutletOutcomesExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\OutletOutcomesQuery The inner query object of the NOT EXISTS statement
     */
    public function useOutletOutcomesNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OutletOutcomesQuery */
        $q = $this->useExistsQuery('OutletOutcomes', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to OutletOutcomes table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\OutletOutcomesQuery The inner query object of the IN statement
     */
    public function useInOutletOutcomesQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\OutletOutcomesQuery */
        $q = $this->useInQuery('OutletOutcomes', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to OutletOutcomes table for a NOT IN query.
     *
     * @see useOutletOutcomesInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\OutletOutcomesQuery The inner query object of the NOT IN statement
     */
    public function useNotInOutletOutcomesQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OutletOutcomesQuery */
        $q = $this->useInQuery('OutletOutcomes', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\Outlets object
     *
     * @param \entities\Outlets|ObjectCollection $outlets the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutlets($outlets, ?string $comparison = null)
    {
        if ($outlets instanceof \entities\Outlets) {
            $this
                ->addUsingAlias(OutletTypeTableMap::COL_OUTLETTYPE_ID, $outlets->getOutlettypeId(), $comparison);

            return $this;
        } elseif ($outlets instanceof ObjectCollection) {
            $this
                ->useOutletsQuery()
                ->filterByPrimaryKeys($outlets->getPrimaryKeys())
                ->endUse();

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
     * Filter the query by a related \entities\Outlettypemodules object
     *
     * @param \entities\Outlettypemodules|ObjectCollection $outlettypemodules the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutlettypemodules($outlettypemodules, ?string $comparison = null)
    {
        if ($outlettypemodules instanceof \entities\Outlettypemodules) {
            $this
                ->addUsingAlias(OutletTypeTableMap::COL_OUTLETTYPE_ID, $outlettypemodules->getOutlettypeid(), $comparison);

            return $this;
        } elseif ($outlettypemodules instanceof ObjectCollection) {
            $this
                ->useOutlettypemodulesQuery()
                ->filterByPrimaryKeys($outlettypemodules->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByOutlettypemodules() only accepts arguments of type \entities\Outlettypemodules or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Outlettypemodules relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOutlettypemodules(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Outlettypemodules');

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
            $this->addJoinObject($join, 'Outlettypemodules');
        }

        return $this;
    }

    /**
     * Use the Outlettypemodules relation Outlettypemodules object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\OutlettypemodulesQuery A secondary query class using the current class as primary query
     */
    public function useOutlettypemodulesQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinOutlettypemodules($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Outlettypemodules', '\entities\OutlettypemodulesQuery');
    }

    /**
     * Use the Outlettypemodules relation Outlettypemodules object
     *
     * @param callable(\entities\OutlettypemodulesQuery):\entities\OutlettypemodulesQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOutlettypemodulesQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useOutlettypemodulesQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Outlettypemodules table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\OutlettypemodulesQuery The inner query object of the EXISTS statement
     */
    public function useOutlettypemodulesExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\OutlettypemodulesQuery */
        $q = $this->useExistsQuery('Outlettypemodules', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Outlettypemodules table for a NOT EXISTS query.
     *
     * @see useOutlettypemodulesExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\OutlettypemodulesQuery The inner query object of the NOT EXISTS statement
     */
    public function useOutlettypemodulesNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OutlettypemodulesQuery */
        $q = $this->useExistsQuery('Outlettypemodules', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Outlettypemodules table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\OutlettypemodulesQuery The inner query object of the IN statement
     */
    public function useInOutlettypemodulesQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\OutlettypemodulesQuery */
        $q = $this->useInQuery('Outlettypemodules', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Outlettypemodules table for a NOT IN query.
     *
     * @see useOutlettypemodulesInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\OutlettypemodulesQuery The inner query object of the NOT IN statement
     */
    public function useNotInOutlettypemodulesQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OutlettypemodulesQuery */
        $q = $this->useInQuery('Outlettypemodules', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(OutletTypeTableMap::COL_OUTLETTYPE_ID, $sgpiMaster->getOutlettypeId(), $comparison);

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
     * Filter the query by a related \entities\Survey object
     *
     * @param \entities\Survey|ObjectCollection $survey the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySurvey($survey, ?string $comparison = null)
    {
        if ($survey instanceof \entities\Survey) {
            $this
                ->addUsingAlias(OutletTypeTableMap::COL_OUTLETTYPE_ID, $survey->getOutletTypeId(), $comparison);

            return $this;
        } elseif ($survey instanceof ObjectCollection) {
            $this
                ->useSurveyQuery()
                ->filterByPrimaryKeys($survey->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySurvey() only accepts arguments of type \entities\Survey or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Survey relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSurvey(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Survey');

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
            $this->addJoinObject($join, 'Survey');
        }

        return $this;
    }

    /**
     * Use the Survey relation Survey object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\SurveyQuery A secondary query class using the current class as primary query
     */
    public function useSurveyQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSurvey($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Survey', '\entities\SurveyQuery');
    }

    /**
     * Use the Survey relation Survey object
     *
     * @param callable(\entities\SurveyQuery):\entities\SurveyQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSurveyQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSurveyQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Survey table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\SurveyQuery The inner query object of the EXISTS statement
     */
    public function useSurveyExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\SurveyQuery */
        $q = $this->useExistsQuery('Survey', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Survey table for a NOT EXISTS query.
     *
     * @see useSurveyExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\SurveyQuery The inner query object of the NOT EXISTS statement
     */
    public function useSurveyNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\SurveyQuery */
        $q = $this->useExistsQuery('Survey', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Survey table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\SurveyQuery The inner query object of the IN statement
     */
    public function useInSurveyQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\SurveyQuery */
        $q = $this->useInQuery('Survey', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Survey table for a NOT IN query.
     *
     * @see useSurveyInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\SurveyQuery The inner query object of the NOT IN statement
     */
    public function useNotInSurveyQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\SurveyQuery */
        $q = $this->useInQuery('Survey', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildOutletType $outletType Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($outletType = null)
    {
        if ($outletType) {
            $this->addUsingAlias(OutletTypeTableMap::COL_OUTLETTYPE_ID, $outletType->getOutlettypeId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the outlet_type table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OutletTypeTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            OutletTypeTableMap::clearInstancePool();
            OutletTypeTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(OutletTypeTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(OutletTypeTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            OutletTypeTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            OutletTypeTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
