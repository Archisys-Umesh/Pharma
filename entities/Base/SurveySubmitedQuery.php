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
use entities\SurveySubmited as ChildSurveySubmited;
use entities\SurveySubmitedQuery as ChildSurveySubmitedQuery;
use entities\Map\SurveySubmitedTableMap;

/**
 * Base class that represents a query for the `survey_submited` table.
 *
 * @method     ChildSurveySubmitedQuery orderBySurverySubmitId($order = Criteria::ASC) Order by the survery_submit_id column
 * @method     ChildSurveySubmitedQuery orderByEmployeeId($order = Criteria::ASC) Order by the employee_id column
 * @method     ChildSurveySubmitedQuery orderBySubmitDate($order = Criteria::ASC) Order by the submit_date column
 * @method     ChildSurveySubmitedQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildSurveySubmitedQuery orderByOutletId($order = Criteria::ASC) Order by the outlet_id column
 * @method     ChildSurveySubmitedQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildSurveySubmitedQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildSurveySubmitedQuery orderBySurveyId($order = Criteria::ASC) Order by the survey_id column
 * @method     ChildSurveySubmitedQuery orderByDcrId($order = Criteria::ASC) Order by the dcr_id column
 * @method     ChildSurveySubmitedQuery orderByAudienceType($order = Criteria::ASC) Order by the audience_type column
 * @method     ChildSurveySubmitedQuery orderByShortCode($order = Criteria::ASC) Order by the short_code column
 * @method     ChildSurveySubmitedQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method     ChildSurveySubmitedQuery orderByForEmployeeId($order = Criteria::ASC) Order by the for_employee_id column
 * @method     ChildSurveySubmitedQuery orderByBrandcampaignVisitPlanId($order = Criteria::ASC) Order by the brandcampaign_visit_plan_id column
 *
 * @method     ChildSurveySubmitedQuery groupBySurverySubmitId() Group by the survery_submit_id column
 * @method     ChildSurveySubmitedQuery groupByEmployeeId() Group by the employee_id column
 * @method     ChildSurveySubmitedQuery groupBySubmitDate() Group by the submit_date column
 * @method     ChildSurveySubmitedQuery groupByCompanyId() Group by the company_id column
 * @method     ChildSurveySubmitedQuery groupByOutletId() Group by the outlet_id column
 * @method     ChildSurveySubmitedQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildSurveySubmitedQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildSurveySubmitedQuery groupBySurveyId() Group by the survey_id column
 * @method     ChildSurveySubmitedQuery groupByDcrId() Group by the dcr_id column
 * @method     ChildSurveySubmitedQuery groupByAudienceType() Group by the audience_type column
 * @method     ChildSurveySubmitedQuery groupByShortCode() Group by the short_code column
 * @method     ChildSurveySubmitedQuery groupByStatus() Group by the status column
 * @method     ChildSurveySubmitedQuery groupByForEmployeeId() Group by the for_employee_id column
 * @method     ChildSurveySubmitedQuery groupByBrandcampaignVisitPlanId() Group by the brandcampaign_visit_plan_id column
 *
 * @method     ChildSurveySubmitedQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSurveySubmitedQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSurveySubmitedQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSurveySubmitedQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSurveySubmitedQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSurveySubmitedQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSurveySubmitedQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildSurveySubmitedQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildSurveySubmitedQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildSurveySubmitedQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildSurveySubmitedQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildSurveySubmitedQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildSurveySubmitedQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     ChildSurveySubmitedQuery leftJoinEmployee($relationAlias = null) Adds a LEFT JOIN clause to the query using the Employee relation
 * @method     ChildSurveySubmitedQuery rightJoinEmployee($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Employee relation
 * @method     ChildSurveySubmitedQuery innerJoinEmployee($relationAlias = null) Adds a INNER JOIN clause to the query using the Employee relation
 *
 * @method     ChildSurveySubmitedQuery joinWithEmployee($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Employee relation
 *
 * @method     ChildSurveySubmitedQuery leftJoinWithEmployee() Adds a LEFT JOIN clause and with to the query using the Employee relation
 * @method     ChildSurveySubmitedQuery rightJoinWithEmployee() Adds a RIGHT JOIN clause and with to the query using the Employee relation
 * @method     ChildSurveySubmitedQuery innerJoinWithEmployee() Adds a INNER JOIN clause and with to the query using the Employee relation
 *
 * @method     ChildSurveySubmitedQuery leftJoinOutlets($relationAlias = null) Adds a LEFT JOIN clause to the query using the Outlets relation
 * @method     ChildSurveySubmitedQuery rightJoinOutlets($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Outlets relation
 * @method     ChildSurveySubmitedQuery innerJoinOutlets($relationAlias = null) Adds a INNER JOIN clause to the query using the Outlets relation
 *
 * @method     ChildSurveySubmitedQuery joinWithOutlets($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Outlets relation
 *
 * @method     ChildSurveySubmitedQuery leftJoinWithOutlets() Adds a LEFT JOIN clause and with to the query using the Outlets relation
 * @method     ChildSurveySubmitedQuery rightJoinWithOutlets() Adds a RIGHT JOIN clause and with to the query using the Outlets relation
 * @method     ChildSurveySubmitedQuery innerJoinWithOutlets() Adds a INNER JOIN clause and with to the query using the Outlets relation
 *
 * @method     ChildSurveySubmitedQuery leftJoinDailycalls($relationAlias = null) Adds a LEFT JOIN clause to the query using the Dailycalls relation
 * @method     ChildSurveySubmitedQuery rightJoinDailycalls($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Dailycalls relation
 * @method     ChildSurveySubmitedQuery innerJoinDailycalls($relationAlias = null) Adds a INNER JOIN clause to the query using the Dailycalls relation
 *
 * @method     ChildSurveySubmitedQuery joinWithDailycalls($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Dailycalls relation
 *
 * @method     ChildSurveySubmitedQuery leftJoinWithDailycalls() Adds a LEFT JOIN clause and with to the query using the Dailycalls relation
 * @method     ChildSurveySubmitedQuery rightJoinWithDailycalls() Adds a RIGHT JOIN clause and with to the query using the Dailycalls relation
 * @method     ChildSurveySubmitedQuery innerJoinWithDailycalls() Adds a INNER JOIN clause and with to the query using the Dailycalls relation
 *
 * @method     ChildSurveySubmitedQuery leftJoinBrandCampiagnVisitPlan($relationAlias = null) Adds a LEFT JOIN clause to the query using the BrandCampiagnVisitPlan relation
 * @method     ChildSurveySubmitedQuery rightJoinBrandCampiagnVisitPlan($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BrandCampiagnVisitPlan relation
 * @method     ChildSurveySubmitedQuery innerJoinBrandCampiagnVisitPlan($relationAlias = null) Adds a INNER JOIN clause to the query using the BrandCampiagnVisitPlan relation
 *
 * @method     ChildSurveySubmitedQuery joinWithBrandCampiagnVisitPlan($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BrandCampiagnVisitPlan relation
 *
 * @method     ChildSurveySubmitedQuery leftJoinWithBrandCampiagnVisitPlan() Adds a LEFT JOIN clause and with to the query using the BrandCampiagnVisitPlan relation
 * @method     ChildSurveySubmitedQuery rightJoinWithBrandCampiagnVisitPlan() Adds a RIGHT JOIN clause and with to the query using the BrandCampiagnVisitPlan relation
 * @method     ChildSurveySubmitedQuery innerJoinWithBrandCampiagnVisitPlan() Adds a INNER JOIN clause and with to the query using the BrandCampiagnVisitPlan relation
 *
 * @method     ChildSurveySubmitedQuery leftJoinSurveySubmitedAnswer($relationAlias = null) Adds a LEFT JOIN clause to the query using the SurveySubmitedAnswer relation
 * @method     ChildSurveySubmitedQuery rightJoinSurveySubmitedAnswer($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SurveySubmitedAnswer relation
 * @method     ChildSurveySubmitedQuery innerJoinSurveySubmitedAnswer($relationAlias = null) Adds a INNER JOIN clause to the query using the SurveySubmitedAnswer relation
 *
 * @method     ChildSurveySubmitedQuery joinWithSurveySubmitedAnswer($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SurveySubmitedAnswer relation
 *
 * @method     ChildSurveySubmitedQuery leftJoinWithSurveySubmitedAnswer() Adds a LEFT JOIN clause and with to the query using the SurveySubmitedAnswer relation
 * @method     ChildSurveySubmitedQuery rightJoinWithSurveySubmitedAnswer() Adds a RIGHT JOIN clause and with to the query using the SurveySubmitedAnswer relation
 * @method     ChildSurveySubmitedQuery innerJoinWithSurveySubmitedAnswer() Adds a INNER JOIN clause and with to the query using the SurveySubmitedAnswer relation
 *
 * @method     \entities\CompanyQuery|\entities\EmployeeQuery|\entities\OutletsQuery|\entities\DailycallsQuery|\entities\BrandCampiagnVisitPlanQuery|\entities\SurveySubmitedAnswerQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSurveySubmited|null findOne(?ConnectionInterface $con = null) Return the first ChildSurveySubmited matching the query
 * @method     ChildSurveySubmited findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSurveySubmited matching the query, or a new ChildSurveySubmited object populated from the query conditions when no match is found
 *
 * @method     ChildSurveySubmited|null findOneBySurverySubmitId(int $survery_submit_id) Return the first ChildSurveySubmited filtered by the survery_submit_id column
 * @method     ChildSurveySubmited|null findOneByEmployeeId(int $employee_id) Return the first ChildSurveySubmited filtered by the employee_id column
 * @method     ChildSurveySubmited|null findOneBySubmitDate(string $submit_date) Return the first ChildSurveySubmited filtered by the submit_date column
 * @method     ChildSurveySubmited|null findOneByCompanyId(int $company_id) Return the first ChildSurveySubmited filtered by the company_id column
 * @method     ChildSurveySubmited|null findOneByOutletId(string $outlet_id) Return the first ChildSurveySubmited filtered by the outlet_id column
 * @method     ChildSurveySubmited|null findOneByCreatedAt(string $created_at) Return the first ChildSurveySubmited filtered by the created_at column
 * @method     ChildSurveySubmited|null findOneByUpdatedAt(string $updated_at) Return the first ChildSurveySubmited filtered by the updated_at column
 * @method     ChildSurveySubmited|null findOneBySurveyId(string $survey_id) Return the first ChildSurveySubmited filtered by the survey_id column
 * @method     ChildSurveySubmited|null findOneByDcrId(int $dcr_id) Return the first ChildSurveySubmited filtered by the dcr_id column
 * @method     ChildSurveySubmited|null findOneByAudienceType(string $audience_type) Return the first ChildSurveySubmited filtered by the audience_type column
 * @method     ChildSurveySubmited|null findOneByShortCode(string $short_code) Return the first ChildSurveySubmited filtered by the short_code column
 * @method     ChildSurveySubmited|null findOneByStatus(string $status) Return the first ChildSurveySubmited filtered by the status column
 * @method     ChildSurveySubmited|null findOneByForEmployeeId(string $for_employee_id) Return the first ChildSurveySubmited filtered by the for_employee_id column
 * @method     ChildSurveySubmited|null findOneByBrandcampaignVisitPlanId(int $brandcampaign_visit_plan_id) Return the first ChildSurveySubmited filtered by the brandcampaign_visit_plan_id column
 *
 * @method     ChildSurveySubmited requirePk($key, ?ConnectionInterface $con = null) Return the ChildSurveySubmited by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSurveySubmited requireOne(?ConnectionInterface $con = null) Return the first ChildSurveySubmited matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSurveySubmited requireOneBySurverySubmitId(int $survery_submit_id) Return the first ChildSurveySubmited filtered by the survery_submit_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSurveySubmited requireOneByEmployeeId(int $employee_id) Return the first ChildSurveySubmited filtered by the employee_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSurveySubmited requireOneBySubmitDate(string $submit_date) Return the first ChildSurveySubmited filtered by the submit_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSurveySubmited requireOneByCompanyId(int $company_id) Return the first ChildSurveySubmited filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSurveySubmited requireOneByOutletId(string $outlet_id) Return the first ChildSurveySubmited filtered by the outlet_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSurveySubmited requireOneByCreatedAt(string $created_at) Return the first ChildSurveySubmited filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSurveySubmited requireOneByUpdatedAt(string $updated_at) Return the first ChildSurveySubmited filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSurveySubmited requireOneBySurveyId(string $survey_id) Return the first ChildSurveySubmited filtered by the survey_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSurveySubmited requireOneByDcrId(int $dcr_id) Return the first ChildSurveySubmited filtered by the dcr_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSurveySubmited requireOneByAudienceType(string $audience_type) Return the first ChildSurveySubmited filtered by the audience_type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSurveySubmited requireOneByShortCode(string $short_code) Return the first ChildSurveySubmited filtered by the short_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSurveySubmited requireOneByStatus(string $status) Return the first ChildSurveySubmited filtered by the status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSurveySubmited requireOneByForEmployeeId(string $for_employee_id) Return the first ChildSurveySubmited filtered by the for_employee_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSurveySubmited requireOneByBrandcampaignVisitPlanId(int $brandcampaign_visit_plan_id) Return the first ChildSurveySubmited filtered by the brandcampaign_visit_plan_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSurveySubmited[]|Collection find(?ConnectionInterface $con = null) Return ChildSurveySubmited objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSurveySubmited> find(?ConnectionInterface $con = null) Return ChildSurveySubmited objects based on current ModelCriteria
 *
 * @method     ChildSurveySubmited[]|Collection findBySurverySubmitId(int|array<int> $survery_submit_id) Return ChildSurveySubmited objects filtered by the survery_submit_id column
 * @psalm-method Collection&\Traversable<ChildSurveySubmited> findBySurverySubmitId(int|array<int> $survery_submit_id) Return ChildSurveySubmited objects filtered by the survery_submit_id column
 * @method     ChildSurveySubmited[]|Collection findByEmployeeId(int|array<int> $employee_id) Return ChildSurveySubmited objects filtered by the employee_id column
 * @psalm-method Collection&\Traversable<ChildSurveySubmited> findByEmployeeId(int|array<int> $employee_id) Return ChildSurveySubmited objects filtered by the employee_id column
 * @method     ChildSurveySubmited[]|Collection findBySubmitDate(string|array<string> $submit_date) Return ChildSurveySubmited objects filtered by the submit_date column
 * @psalm-method Collection&\Traversable<ChildSurveySubmited> findBySubmitDate(string|array<string> $submit_date) Return ChildSurveySubmited objects filtered by the submit_date column
 * @method     ChildSurveySubmited[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildSurveySubmited objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildSurveySubmited> findByCompanyId(int|array<int> $company_id) Return ChildSurveySubmited objects filtered by the company_id column
 * @method     ChildSurveySubmited[]|Collection findByOutletId(string|array<string> $outlet_id) Return ChildSurveySubmited objects filtered by the outlet_id column
 * @psalm-method Collection&\Traversable<ChildSurveySubmited> findByOutletId(string|array<string> $outlet_id) Return ChildSurveySubmited objects filtered by the outlet_id column
 * @method     ChildSurveySubmited[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildSurveySubmited objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildSurveySubmited> findByCreatedAt(string|array<string> $created_at) Return ChildSurveySubmited objects filtered by the created_at column
 * @method     ChildSurveySubmited[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildSurveySubmited objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildSurveySubmited> findByUpdatedAt(string|array<string> $updated_at) Return ChildSurveySubmited objects filtered by the updated_at column
 * @method     ChildSurveySubmited[]|Collection findBySurveyId(string|array<string> $survey_id) Return ChildSurveySubmited objects filtered by the survey_id column
 * @psalm-method Collection&\Traversable<ChildSurveySubmited> findBySurveyId(string|array<string> $survey_id) Return ChildSurveySubmited objects filtered by the survey_id column
 * @method     ChildSurveySubmited[]|Collection findByDcrId(int|array<int> $dcr_id) Return ChildSurveySubmited objects filtered by the dcr_id column
 * @psalm-method Collection&\Traversable<ChildSurveySubmited> findByDcrId(int|array<int> $dcr_id) Return ChildSurveySubmited objects filtered by the dcr_id column
 * @method     ChildSurveySubmited[]|Collection findByAudienceType(string|array<string> $audience_type) Return ChildSurveySubmited objects filtered by the audience_type column
 * @psalm-method Collection&\Traversable<ChildSurveySubmited> findByAudienceType(string|array<string> $audience_type) Return ChildSurveySubmited objects filtered by the audience_type column
 * @method     ChildSurveySubmited[]|Collection findByShortCode(string|array<string> $short_code) Return ChildSurveySubmited objects filtered by the short_code column
 * @psalm-method Collection&\Traversable<ChildSurveySubmited> findByShortCode(string|array<string> $short_code) Return ChildSurveySubmited objects filtered by the short_code column
 * @method     ChildSurveySubmited[]|Collection findByStatus(string|array<string> $status) Return ChildSurveySubmited objects filtered by the status column
 * @psalm-method Collection&\Traversable<ChildSurveySubmited> findByStatus(string|array<string> $status) Return ChildSurveySubmited objects filtered by the status column
 * @method     ChildSurveySubmited[]|Collection findByForEmployeeId(string|array<string> $for_employee_id) Return ChildSurveySubmited objects filtered by the for_employee_id column
 * @psalm-method Collection&\Traversable<ChildSurveySubmited> findByForEmployeeId(string|array<string> $for_employee_id) Return ChildSurveySubmited objects filtered by the for_employee_id column
 * @method     ChildSurveySubmited[]|Collection findByBrandcampaignVisitPlanId(int|array<int> $brandcampaign_visit_plan_id) Return ChildSurveySubmited objects filtered by the brandcampaign_visit_plan_id column
 * @psalm-method Collection&\Traversable<ChildSurveySubmited> findByBrandcampaignVisitPlanId(int|array<int> $brandcampaign_visit_plan_id) Return ChildSurveySubmited objects filtered by the brandcampaign_visit_plan_id column
 *
 * @method     ChildSurveySubmited[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSurveySubmited> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SurveySubmitedQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\SurveySubmitedQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\SurveySubmited', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSurveySubmitedQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSurveySubmitedQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSurveySubmitedQuery) {
            return $criteria;
        }
        $query = new ChildSurveySubmitedQuery();
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
     * @return ChildSurveySubmited|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SurveySubmitedTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = SurveySubmitedTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSurveySubmited A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT survery_submit_id, employee_id, submit_date, company_id, outlet_id, created_at, updated_at, survey_id, dcr_id, audience_type, short_code, status, for_employee_id, brandcampaign_visit_plan_id FROM survey_submited WHERE survery_submit_id = :p0';
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
            /** @var ChildSurveySubmited $obj */
            $obj = new ChildSurveySubmited();
            $obj->hydrate($row);
            SurveySubmitedTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSurveySubmited|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SurveySubmitedTableMap::COL_SURVERY_SUBMIT_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SurveySubmitedTableMap::COL_SURVERY_SUBMIT_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the survery_submit_id column
     *
     * Example usage:
     * <code>
     * $query->filterBySurverySubmitId(1234); // WHERE survery_submit_id = 1234
     * $query->filterBySurverySubmitId(array(12, 34)); // WHERE survery_submit_id IN (12, 34)
     * $query->filterBySurverySubmitId(array('min' => 12)); // WHERE survery_submit_id > 12
     * </code>
     *
     * @param mixed $surverySubmitId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySurverySubmitId($surverySubmitId = null, ?string $comparison = null)
    {
        if (is_array($surverySubmitId)) {
            $useMinMax = false;
            if (isset($surverySubmitId['min'])) {
                $this->addUsingAlias(SurveySubmitedTableMap::COL_SURVERY_SUBMIT_ID, $surverySubmitId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($surverySubmitId['max'])) {
                $this->addUsingAlias(SurveySubmitedTableMap::COL_SURVERY_SUBMIT_ID, $surverySubmitId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SurveySubmitedTableMap::COL_SURVERY_SUBMIT_ID, $surverySubmitId, $comparison);

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
                $this->addUsingAlias(SurveySubmitedTableMap::COL_EMPLOYEE_ID, $employeeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($employeeId['max'])) {
                $this->addUsingAlias(SurveySubmitedTableMap::COL_EMPLOYEE_ID, $employeeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SurveySubmitedTableMap::COL_EMPLOYEE_ID, $employeeId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the submit_date column
     *
     * Example usage:
     * <code>
     * $query->filterBySubmitDate('2011-03-14'); // WHERE submit_date = '2011-03-14'
     * $query->filterBySubmitDate('now'); // WHERE submit_date = '2011-03-14'
     * $query->filterBySubmitDate(array('max' => 'yesterday')); // WHERE submit_date > '2011-03-13'
     * </code>
     *
     * @param mixed $submitDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySubmitDate($submitDate = null, ?string $comparison = null)
    {
        if (is_array($submitDate)) {
            $useMinMax = false;
            if (isset($submitDate['min'])) {
                $this->addUsingAlias(SurveySubmitedTableMap::COL_SUBMIT_DATE, $submitDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($submitDate['max'])) {
                $this->addUsingAlias(SurveySubmitedTableMap::COL_SUBMIT_DATE, $submitDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SurveySubmitedTableMap::COL_SUBMIT_DATE, $submitDate, $comparison);

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
                $this->addUsingAlias(SurveySubmitedTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(SurveySubmitedTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SurveySubmitedTableMap::COL_COMPANY_ID, $companyId, $comparison);

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
                $this->addUsingAlias(SurveySubmitedTableMap::COL_OUTLET_ID, $outletId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outletId['max'])) {
                $this->addUsingAlias(SurveySubmitedTableMap::COL_OUTLET_ID, $outletId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SurveySubmitedTableMap::COL_OUTLET_ID, $outletId, $comparison);

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
                $this->addUsingAlias(SurveySubmitedTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(SurveySubmitedTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SurveySubmitedTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(SurveySubmitedTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(SurveySubmitedTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SurveySubmitedTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the survey_id column
     *
     * Example usage:
     * <code>
     * $query->filterBySurveyId(1234); // WHERE survey_id = 1234
     * $query->filterBySurveyId(array(12, 34)); // WHERE survey_id IN (12, 34)
     * $query->filterBySurveyId(array('min' => 12)); // WHERE survey_id > 12
     * </code>
     *
     * @param mixed $surveyId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySurveyId($surveyId = null, ?string $comparison = null)
    {
        if (is_array($surveyId)) {
            $useMinMax = false;
            if (isset($surveyId['min'])) {
                $this->addUsingAlias(SurveySubmitedTableMap::COL_SURVEY_ID, $surveyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($surveyId['max'])) {
                $this->addUsingAlias(SurveySubmitedTableMap::COL_SURVEY_ID, $surveyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SurveySubmitedTableMap::COL_SURVEY_ID, $surveyId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the dcr_id column
     *
     * Example usage:
     * <code>
     * $query->filterByDcrId(1234); // WHERE dcr_id = 1234
     * $query->filterByDcrId(array(12, 34)); // WHERE dcr_id IN (12, 34)
     * $query->filterByDcrId(array('min' => 12)); // WHERE dcr_id > 12
     * </code>
     *
     * @see       filterByDailycalls()
     *
     * @param mixed $dcrId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDcrId($dcrId = null, ?string $comparison = null)
    {
        if (is_array($dcrId)) {
            $useMinMax = false;
            if (isset($dcrId['min'])) {
                $this->addUsingAlias(SurveySubmitedTableMap::COL_DCR_ID, $dcrId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dcrId['max'])) {
                $this->addUsingAlias(SurveySubmitedTableMap::COL_DCR_ID, $dcrId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SurveySubmitedTableMap::COL_DCR_ID, $dcrId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the audience_type column
     *
     * Example usage:
     * <code>
     * $query->filterByAudienceType('fooValue');   // WHERE audience_type = 'fooValue'
     * $query->filterByAudienceType('%fooValue%', Criteria::LIKE); // WHERE audience_type LIKE '%fooValue%'
     * $query->filterByAudienceType(['foo', 'bar']); // WHERE audience_type IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $audienceType The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAudienceType($audienceType = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($audienceType)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SurveySubmitedTableMap::COL_AUDIENCE_TYPE, $audienceType, $comparison);

        return $this;
    }

    /**
     * Filter the query on the short_code column
     *
     * Example usage:
     * <code>
     * $query->filterByShortCode('fooValue');   // WHERE short_code = 'fooValue'
     * $query->filterByShortCode('%fooValue%', Criteria::LIKE); // WHERE short_code LIKE '%fooValue%'
     * $query->filterByShortCode(['foo', 'bar']); // WHERE short_code IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $shortCode The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByShortCode($shortCode = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($shortCode)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SurveySubmitedTableMap::COL_SHORT_CODE, $shortCode, $comparison);

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

        $this->addUsingAlias(SurveySubmitedTableMap::COL_STATUS, $status, $comparison);

        return $this;
    }

    /**
     * Filter the query on the for_employee_id column
     *
     * Example usage:
     * <code>
     * $query->filterByForEmployeeId(1234); // WHERE for_employee_id = 1234
     * $query->filterByForEmployeeId(array(12, 34)); // WHERE for_employee_id IN (12, 34)
     * $query->filterByForEmployeeId(array('min' => 12)); // WHERE for_employee_id > 12
     * </code>
     *
     * @param mixed $forEmployeeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByForEmployeeId($forEmployeeId = null, ?string $comparison = null)
    {
        if (is_array($forEmployeeId)) {
            $useMinMax = false;
            if (isset($forEmployeeId['min'])) {
                $this->addUsingAlias(SurveySubmitedTableMap::COL_FOR_EMPLOYEE_ID, $forEmployeeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($forEmployeeId['max'])) {
                $this->addUsingAlias(SurveySubmitedTableMap::COL_FOR_EMPLOYEE_ID, $forEmployeeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SurveySubmitedTableMap::COL_FOR_EMPLOYEE_ID, $forEmployeeId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the brandcampaign_visit_plan_id column
     *
     * Example usage:
     * <code>
     * $query->filterByBrandcampaignVisitPlanId(1234); // WHERE brandcampaign_visit_plan_id = 1234
     * $query->filterByBrandcampaignVisitPlanId(array(12, 34)); // WHERE brandcampaign_visit_plan_id IN (12, 34)
     * $query->filterByBrandcampaignVisitPlanId(array('min' => 12)); // WHERE brandcampaign_visit_plan_id > 12
     * </code>
     *
     * @see       filterByBrandCampiagnVisitPlan()
     *
     * @param mixed $brandcampaignVisitPlanId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBrandcampaignVisitPlanId($brandcampaignVisitPlanId = null, ?string $comparison = null)
    {
        if (is_array($brandcampaignVisitPlanId)) {
            $useMinMax = false;
            if (isset($brandcampaignVisitPlanId['min'])) {
                $this->addUsingAlias(SurveySubmitedTableMap::COL_BRANDCAMPAIGN_VISIT_PLAN_ID, $brandcampaignVisitPlanId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($brandcampaignVisitPlanId['max'])) {
                $this->addUsingAlias(SurveySubmitedTableMap::COL_BRANDCAMPAIGN_VISIT_PLAN_ID, $brandcampaignVisitPlanId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SurveySubmitedTableMap::COL_BRANDCAMPAIGN_VISIT_PLAN_ID, $brandcampaignVisitPlanId, $comparison);

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
                ->addUsingAlias(SurveySubmitedTableMap::COL_COMPANY_ID, $company->getCompanyId(), $comparison);
        } elseif ($company instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SurveySubmitedTableMap::COL_COMPANY_ID, $company->toKeyValue('PrimaryKey', 'CompanyId'), $comparison);

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
                ->addUsingAlias(SurveySubmitedTableMap::COL_EMPLOYEE_ID, $employee->getEmployeeId(), $comparison);
        } elseif ($employee instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SurveySubmitedTableMap::COL_EMPLOYEE_ID, $employee->toKeyValue('PrimaryKey', 'EmployeeId'), $comparison);

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
                ->addUsingAlias(SurveySubmitedTableMap::COL_OUTLET_ID, $outlets->getId(), $comparison);
        } elseif ($outlets instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SurveySubmitedTableMap::COL_OUTLET_ID, $outlets->toKeyValue('PrimaryKey', 'Id'), $comparison);

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
     * Filter the query by a related \entities\Dailycalls object
     *
     * @param \entities\Dailycalls|ObjectCollection $dailycalls The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDailycalls($dailycalls, ?string $comparison = null)
    {
        if ($dailycalls instanceof \entities\Dailycalls) {
            return $this
                ->addUsingAlias(SurveySubmitedTableMap::COL_DCR_ID, $dailycalls->getDcrId(), $comparison);
        } elseif ($dailycalls instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SurveySubmitedTableMap::COL_DCR_ID, $dailycalls->toKeyValue('PrimaryKey', 'DcrId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByDailycalls() only accepts arguments of type \entities\Dailycalls or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Dailycalls relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinDailycalls(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Dailycalls');

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
            $this->addJoinObject($join, 'Dailycalls');
        }

        return $this;
    }

    /**
     * Use the Dailycalls relation Dailycalls object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\DailycallsQuery A secondary query class using the current class as primary query
     */
    public function useDailycallsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinDailycalls($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Dailycalls', '\entities\DailycallsQuery');
    }

    /**
     * Use the Dailycalls relation Dailycalls object
     *
     * @param callable(\entities\DailycallsQuery):\entities\DailycallsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withDailycallsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useDailycallsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Dailycalls table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\DailycallsQuery The inner query object of the EXISTS statement
     */
    public function useDailycallsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\DailycallsQuery */
        $q = $this->useExistsQuery('Dailycalls', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Dailycalls table for a NOT EXISTS query.
     *
     * @see useDailycallsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\DailycallsQuery The inner query object of the NOT EXISTS statement
     */
    public function useDailycallsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\DailycallsQuery */
        $q = $this->useExistsQuery('Dailycalls', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Dailycalls table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\DailycallsQuery The inner query object of the IN statement
     */
    public function useInDailycallsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\DailycallsQuery */
        $q = $this->useInQuery('Dailycalls', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Dailycalls table for a NOT IN query.
     *
     * @see useDailycallsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\DailycallsQuery The inner query object of the NOT IN statement
     */
    public function useNotInDailycallsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\DailycallsQuery */
        $q = $this->useInQuery('Dailycalls', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\BrandCampiagnVisitPlan object
     *
     * @param \entities\BrandCampiagnVisitPlan|ObjectCollection $brandCampiagnVisitPlan The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBrandCampiagnVisitPlan($brandCampiagnVisitPlan, ?string $comparison = null)
    {
        if ($brandCampiagnVisitPlan instanceof \entities\BrandCampiagnVisitPlan) {
            return $this
                ->addUsingAlias(SurveySubmitedTableMap::COL_BRANDCAMPAIGN_VISIT_PLAN_ID, $brandCampiagnVisitPlan->getBrandCampiagnVisitPlanId(), $comparison);
        } elseif ($brandCampiagnVisitPlan instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SurveySubmitedTableMap::COL_BRANDCAMPAIGN_VISIT_PLAN_ID, $brandCampiagnVisitPlan->toKeyValue('PrimaryKey', 'BrandCampiagnVisitPlanId'), $comparison);

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
     * Filter the query by a related \entities\SurveySubmitedAnswer object
     *
     * @param \entities\SurveySubmitedAnswer|ObjectCollection $surveySubmitedAnswer the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySurveySubmitedAnswer($surveySubmitedAnswer, ?string $comparison = null)
    {
        if ($surveySubmitedAnswer instanceof \entities\SurveySubmitedAnswer) {
            $this
                ->addUsingAlias(SurveySubmitedTableMap::COL_SURVERY_SUBMIT_ID, $surveySubmitedAnswer->getSurveySubmitedId(), $comparison);

            return $this;
        } elseif ($surveySubmitedAnswer instanceof ObjectCollection) {
            $this
                ->useSurveySubmitedAnswerQuery()
                ->filterByPrimaryKeys($surveySubmitedAnswer->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySurveySubmitedAnswer() only accepts arguments of type \entities\SurveySubmitedAnswer or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SurveySubmitedAnswer relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSurveySubmitedAnswer(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SurveySubmitedAnswer');

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
            $this->addJoinObject($join, 'SurveySubmitedAnswer');
        }

        return $this;
    }

    /**
     * Use the SurveySubmitedAnswer relation SurveySubmitedAnswer object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\SurveySubmitedAnswerQuery A secondary query class using the current class as primary query
     */
    public function useSurveySubmitedAnswerQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSurveySubmitedAnswer($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SurveySubmitedAnswer', '\entities\SurveySubmitedAnswerQuery');
    }

    /**
     * Use the SurveySubmitedAnswer relation SurveySubmitedAnswer object
     *
     * @param callable(\entities\SurveySubmitedAnswerQuery):\entities\SurveySubmitedAnswerQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSurveySubmitedAnswerQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useSurveySubmitedAnswerQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SurveySubmitedAnswer table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\SurveySubmitedAnswerQuery The inner query object of the EXISTS statement
     */
    public function useSurveySubmitedAnswerExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\SurveySubmitedAnswerQuery */
        $q = $this->useExistsQuery('SurveySubmitedAnswer', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SurveySubmitedAnswer table for a NOT EXISTS query.
     *
     * @see useSurveySubmitedAnswerExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\SurveySubmitedAnswerQuery The inner query object of the NOT EXISTS statement
     */
    public function useSurveySubmitedAnswerNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\SurveySubmitedAnswerQuery */
        $q = $this->useExistsQuery('SurveySubmitedAnswer', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SurveySubmitedAnswer table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\SurveySubmitedAnswerQuery The inner query object of the IN statement
     */
    public function useInSurveySubmitedAnswerQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\SurveySubmitedAnswerQuery */
        $q = $this->useInQuery('SurveySubmitedAnswer', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SurveySubmitedAnswer table for a NOT IN query.
     *
     * @see useSurveySubmitedAnswerInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\SurveySubmitedAnswerQuery The inner query object of the NOT IN statement
     */
    public function useNotInSurveySubmitedAnswerQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\SurveySubmitedAnswerQuery */
        $q = $this->useInQuery('SurveySubmitedAnswer', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSurveySubmited $surveySubmited Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($surveySubmited = null)
    {
        if ($surveySubmited) {
            $this->addUsingAlias(SurveySubmitedTableMap::COL_SURVERY_SUBMIT_ID, $surveySubmited->getSurverySubmitId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the survey_submited table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SurveySubmitedTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SurveySubmitedTableMap::clearInstancePool();
            SurveySubmitedTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SurveySubmitedTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SurveySubmitedTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SurveySubmitedTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SurveySubmitedTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
