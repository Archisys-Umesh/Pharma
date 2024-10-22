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
use entities\Survey as ChildSurvey;
use entities\SurveyQuery as ChildSurveyQuery;
use entities\Map\SurveyTableMap;

/**
 * Base class that represents a query for the `survey` table.
 *
 * @method     ChildSurveyQuery orderBySurveyId($order = Criteria::ASC) Order by the survey_id column
 * @method     ChildSurveyQuery orderBySurveyName($order = Criteria::ASC) Order by the survey_name column
 * @method     ChildSurveyQuery orderBySurveyCatid($order = Criteria::ASC) Order by the survey_catid column
 * @method     ChildSurveyQuery orderByIsMultiple($order = Criteria::ASC) Order by the is_multiple column
 * @method     ChildSurveyQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method     ChildSurveyQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildSurveyQuery orderByOutletTypeId($order = Criteria::ASC) Order by the outlet_type_id column
 * @method     ChildSurveyQuery orderByOrgunitid($order = Criteria::ASC) Order by the orgunitid column
 * @method     ChildSurveyQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildSurveyQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildSurveyQuery orderByMediaId($order = Criteria::ASC) Order by the media_id column
 * @method     ChildSurveyQuery orderByAudienceType($order = Criteria::ASC) Order by the audience_type column
 * @method     ChildSurveyQuery orderByShortCode($order = Criteria::ASC) Order by the short_code column
 * @method     ChildSurveyQuery orderByStartDate($order = Criteria::ASC) Order by the start_date column
 * @method     ChildSurveyQuery orderByEndDate($order = Criteria::ASC) Order by the end_date column
 *
 * @method     ChildSurveyQuery groupBySurveyId() Group by the survey_id column
 * @method     ChildSurveyQuery groupBySurveyName() Group by the survey_name column
 * @method     ChildSurveyQuery groupBySurveyCatid() Group by the survey_catid column
 * @method     ChildSurveyQuery groupByIsMultiple() Group by the is_multiple column
 * @method     ChildSurveyQuery groupByStatus() Group by the status column
 * @method     ChildSurveyQuery groupByCompanyId() Group by the company_id column
 * @method     ChildSurveyQuery groupByOutletTypeId() Group by the outlet_type_id column
 * @method     ChildSurveyQuery groupByOrgunitid() Group by the orgunitid column
 * @method     ChildSurveyQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildSurveyQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildSurveyQuery groupByMediaId() Group by the media_id column
 * @method     ChildSurveyQuery groupByAudienceType() Group by the audience_type column
 * @method     ChildSurveyQuery groupByShortCode() Group by the short_code column
 * @method     ChildSurveyQuery groupByStartDate() Group by the start_date column
 * @method     ChildSurveyQuery groupByEndDate() Group by the end_date column
 *
 * @method     ChildSurveyQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSurveyQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSurveyQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSurveyQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSurveyQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSurveyQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSurveyQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildSurveyQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildSurveyQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildSurveyQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildSurveyQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildSurveyQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildSurveyQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     ChildSurveyQuery leftJoinSurveyCategory($relationAlias = null) Adds a LEFT JOIN clause to the query using the SurveyCategory relation
 * @method     ChildSurveyQuery rightJoinSurveyCategory($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SurveyCategory relation
 * @method     ChildSurveyQuery innerJoinSurveyCategory($relationAlias = null) Adds a INNER JOIN clause to the query using the SurveyCategory relation
 *
 * @method     ChildSurveyQuery joinWithSurveyCategory($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SurveyCategory relation
 *
 * @method     ChildSurveyQuery leftJoinWithSurveyCategory() Adds a LEFT JOIN clause and with to the query using the SurveyCategory relation
 * @method     ChildSurveyQuery rightJoinWithSurveyCategory() Adds a RIGHT JOIN clause and with to the query using the SurveyCategory relation
 * @method     ChildSurveyQuery innerJoinWithSurveyCategory() Adds a INNER JOIN clause and with to the query using the SurveyCategory relation
 *
 * @method     ChildSurveyQuery leftJoinOutletType($relationAlias = null) Adds a LEFT JOIN clause to the query using the OutletType relation
 * @method     ChildSurveyQuery rightJoinOutletType($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OutletType relation
 * @method     ChildSurveyQuery innerJoinOutletType($relationAlias = null) Adds a INNER JOIN clause to the query using the OutletType relation
 *
 * @method     ChildSurveyQuery joinWithOutletType($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OutletType relation
 *
 * @method     ChildSurveyQuery leftJoinWithOutletType() Adds a LEFT JOIN clause and with to the query using the OutletType relation
 * @method     ChildSurveyQuery rightJoinWithOutletType() Adds a RIGHT JOIN clause and with to the query using the OutletType relation
 * @method     ChildSurveyQuery innerJoinWithOutletType() Adds a INNER JOIN clause and with to the query using the OutletType relation
 *
 * @method     ChildSurveyQuery leftJoinBrandCampiagnVisitPlan($relationAlias = null) Adds a LEFT JOIN clause to the query using the BrandCampiagnVisitPlan relation
 * @method     ChildSurveyQuery rightJoinBrandCampiagnVisitPlan($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BrandCampiagnVisitPlan relation
 * @method     ChildSurveyQuery innerJoinBrandCampiagnVisitPlan($relationAlias = null) Adds a INNER JOIN clause to the query using the BrandCampiagnVisitPlan relation
 *
 * @method     ChildSurveyQuery joinWithBrandCampiagnVisitPlan($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BrandCampiagnVisitPlan relation
 *
 * @method     ChildSurveyQuery leftJoinWithBrandCampiagnVisitPlan() Adds a LEFT JOIN clause and with to the query using the BrandCampiagnVisitPlan relation
 * @method     ChildSurveyQuery rightJoinWithBrandCampiagnVisitPlan() Adds a RIGHT JOIN clause and with to the query using the BrandCampiagnVisitPlan relation
 * @method     ChildSurveyQuery innerJoinWithBrandCampiagnVisitPlan() Adds a INNER JOIN clause and with to the query using the BrandCampiagnVisitPlan relation
 *
 * @method     ChildSurveyQuery leftJoinSurveyQuestion($relationAlias = null) Adds a LEFT JOIN clause to the query using the SurveyQuestion relation
 * @method     ChildSurveyQuery rightJoinSurveyQuestion($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SurveyQuestion relation
 * @method     ChildSurveyQuery innerJoinSurveyQuestion($relationAlias = null) Adds a INNER JOIN clause to the query using the SurveyQuestion relation
 *
 * @method     ChildSurveyQuery joinWithSurveyQuestion($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SurveyQuestion relation
 *
 * @method     ChildSurveyQuery leftJoinWithSurveyQuestion() Adds a LEFT JOIN clause and with to the query using the SurveyQuestion relation
 * @method     ChildSurveyQuery rightJoinWithSurveyQuestion() Adds a RIGHT JOIN clause and with to the query using the SurveyQuestion relation
 * @method     ChildSurveyQuery innerJoinWithSurveyQuestion() Adds a INNER JOIN clause and with to the query using the SurveyQuestion relation
 *
 * @method     \entities\CompanyQuery|\entities\SurveyCategoryQuery|\entities\OutletTypeQuery|\entities\BrandCampiagnVisitPlanQuery|\entities\SurveyQuestionQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSurvey|null findOne(?ConnectionInterface $con = null) Return the first ChildSurvey matching the query
 * @method     ChildSurvey findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSurvey matching the query, or a new ChildSurvey object populated from the query conditions when no match is found
 *
 * @method     ChildSurvey|null findOneBySurveyId(int $survey_id) Return the first ChildSurvey filtered by the survey_id column
 * @method     ChildSurvey|null findOneBySurveyName(string $survey_name) Return the first ChildSurvey filtered by the survey_name column
 * @method     ChildSurvey|null findOneBySurveyCatid(int $survey_catid) Return the first ChildSurvey filtered by the survey_catid column
 * @method     ChildSurvey|null findOneByIsMultiple(boolean $is_multiple) Return the first ChildSurvey filtered by the is_multiple column
 * @method     ChildSurvey|null findOneByStatus(string $status) Return the first ChildSurvey filtered by the status column
 * @method     ChildSurvey|null findOneByCompanyId(int $company_id) Return the first ChildSurvey filtered by the company_id column
 * @method     ChildSurvey|null findOneByOutletTypeId(int $outlet_type_id) Return the first ChildSurvey filtered by the outlet_type_id column
 * @method     ChildSurvey|null findOneByOrgunitid(string $orgunitid) Return the first ChildSurvey filtered by the orgunitid column
 * @method     ChildSurvey|null findOneByCreatedAt(string $created_at) Return the first ChildSurvey filtered by the created_at column
 * @method     ChildSurvey|null findOneByUpdatedAt(string $updated_at) Return the first ChildSurvey filtered by the updated_at column
 * @method     ChildSurvey|null findOneByMediaId(string $media_id) Return the first ChildSurvey filtered by the media_id column
 * @method     ChildSurvey|null findOneByAudienceType(string $audience_type) Return the first ChildSurvey filtered by the audience_type column
 * @method     ChildSurvey|null findOneByShortCode(string $short_code) Return the first ChildSurvey filtered by the short_code column
 * @method     ChildSurvey|null findOneByStartDate(string $start_date) Return the first ChildSurvey filtered by the start_date column
 * @method     ChildSurvey|null findOneByEndDate(string $end_date) Return the first ChildSurvey filtered by the end_date column
 *
 * @method     ChildSurvey requirePk($key, ?ConnectionInterface $con = null) Return the ChildSurvey by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSurvey requireOne(?ConnectionInterface $con = null) Return the first ChildSurvey matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSurvey requireOneBySurveyId(int $survey_id) Return the first ChildSurvey filtered by the survey_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSurvey requireOneBySurveyName(string $survey_name) Return the first ChildSurvey filtered by the survey_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSurvey requireOneBySurveyCatid(int $survey_catid) Return the first ChildSurvey filtered by the survey_catid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSurvey requireOneByIsMultiple(boolean $is_multiple) Return the first ChildSurvey filtered by the is_multiple column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSurvey requireOneByStatus(string $status) Return the first ChildSurvey filtered by the status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSurvey requireOneByCompanyId(int $company_id) Return the first ChildSurvey filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSurvey requireOneByOutletTypeId(int $outlet_type_id) Return the first ChildSurvey filtered by the outlet_type_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSurvey requireOneByOrgunitid(string $orgunitid) Return the first ChildSurvey filtered by the orgunitid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSurvey requireOneByCreatedAt(string $created_at) Return the first ChildSurvey filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSurvey requireOneByUpdatedAt(string $updated_at) Return the first ChildSurvey filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSurvey requireOneByMediaId(string $media_id) Return the first ChildSurvey filtered by the media_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSurvey requireOneByAudienceType(string $audience_type) Return the first ChildSurvey filtered by the audience_type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSurvey requireOneByShortCode(string $short_code) Return the first ChildSurvey filtered by the short_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSurvey requireOneByStartDate(string $start_date) Return the first ChildSurvey filtered by the start_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSurvey requireOneByEndDate(string $end_date) Return the first ChildSurvey filtered by the end_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSurvey[]|Collection find(?ConnectionInterface $con = null) Return ChildSurvey objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSurvey> find(?ConnectionInterface $con = null) Return ChildSurvey objects based on current ModelCriteria
 *
 * @method     ChildSurvey[]|Collection findBySurveyId(int|array<int> $survey_id) Return ChildSurvey objects filtered by the survey_id column
 * @psalm-method Collection&\Traversable<ChildSurvey> findBySurveyId(int|array<int> $survey_id) Return ChildSurvey objects filtered by the survey_id column
 * @method     ChildSurvey[]|Collection findBySurveyName(string|array<string> $survey_name) Return ChildSurvey objects filtered by the survey_name column
 * @psalm-method Collection&\Traversable<ChildSurvey> findBySurveyName(string|array<string> $survey_name) Return ChildSurvey objects filtered by the survey_name column
 * @method     ChildSurvey[]|Collection findBySurveyCatid(int|array<int> $survey_catid) Return ChildSurvey objects filtered by the survey_catid column
 * @psalm-method Collection&\Traversable<ChildSurvey> findBySurveyCatid(int|array<int> $survey_catid) Return ChildSurvey objects filtered by the survey_catid column
 * @method     ChildSurvey[]|Collection findByIsMultiple(boolean|array<boolean> $is_multiple) Return ChildSurvey objects filtered by the is_multiple column
 * @psalm-method Collection&\Traversable<ChildSurvey> findByIsMultiple(boolean|array<boolean> $is_multiple) Return ChildSurvey objects filtered by the is_multiple column
 * @method     ChildSurvey[]|Collection findByStatus(string|array<string> $status) Return ChildSurvey objects filtered by the status column
 * @psalm-method Collection&\Traversable<ChildSurvey> findByStatus(string|array<string> $status) Return ChildSurvey objects filtered by the status column
 * @method     ChildSurvey[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildSurvey objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildSurvey> findByCompanyId(int|array<int> $company_id) Return ChildSurvey objects filtered by the company_id column
 * @method     ChildSurvey[]|Collection findByOutletTypeId(int|array<int> $outlet_type_id) Return ChildSurvey objects filtered by the outlet_type_id column
 * @psalm-method Collection&\Traversable<ChildSurvey> findByOutletTypeId(int|array<int> $outlet_type_id) Return ChildSurvey objects filtered by the outlet_type_id column
 * @method     ChildSurvey[]|Collection findByOrgunitid(string|array<string> $orgunitid) Return ChildSurvey objects filtered by the orgunitid column
 * @psalm-method Collection&\Traversable<ChildSurvey> findByOrgunitid(string|array<string> $orgunitid) Return ChildSurvey objects filtered by the orgunitid column
 * @method     ChildSurvey[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildSurvey objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildSurvey> findByCreatedAt(string|array<string> $created_at) Return ChildSurvey objects filtered by the created_at column
 * @method     ChildSurvey[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildSurvey objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildSurvey> findByUpdatedAt(string|array<string> $updated_at) Return ChildSurvey objects filtered by the updated_at column
 * @method     ChildSurvey[]|Collection findByMediaId(string|array<string> $media_id) Return ChildSurvey objects filtered by the media_id column
 * @psalm-method Collection&\Traversable<ChildSurvey> findByMediaId(string|array<string> $media_id) Return ChildSurvey objects filtered by the media_id column
 * @method     ChildSurvey[]|Collection findByAudienceType(string|array<string> $audience_type) Return ChildSurvey objects filtered by the audience_type column
 * @psalm-method Collection&\Traversable<ChildSurvey> findByAudienceType(string|array<string> $audience_type) Return ChildSurvey objects filtered by the audience_type column
 * @method     ChildSurvey[]|Collection findByShortCode(string|array<string> $short_code) Return ChildSurvey objects filtered by the short_code column
 * @psalm-method Collection&\Traversable<ChildSurvey> findByShortCode(string|array<string> $short_code) Return ChildSurvey objects filtered by the short_code column
 * @method     ChildSurvey[]|Collection findByStartDate(string|array<string> $start_date) Return ChildSurvey objects filtered by the start_date column
 * @psalm-method Collection&\Traversable<ChildSurvey> findByStartDate(string|array<string> $start_date) Return ChildSurvey objects filtered by the start_date column
 * @method     ChildSurvey[]|Collection findByEndDate(string|array<string> $end_date) Return ChildSurvey objects filtered by the end_date column
 * @psalm-method Collection&\Traversable<ChildSurvey> findByEndDate(string|array<string> $end_date) Return ChildSurvey objects filtered by the end_date column
 *
 * @method     ChildSurvey[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSurvey> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SurveyQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\SurveyQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\Survey', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSurveyQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSurveyQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSurveyQuery) {
            return $criteria;
        }
        $query = new ChildSurveyQuery();
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
     * @return ChildSurvey|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SurveyTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = SurveyTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSurvey A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT survey_id, survey_name, survey_catid, is_multiple, status, company_id, outlet_type_id, orgunitid, created_at, updated_at, media_id, audience_type, short_code, start_date, end_date FROM survey WHERE survey_id = :p0';
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
            /** @var ChildSurvey $obj */
            $obj = new ChildSurvey();
            $obj->hydrate($row);
            SurveyTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSurvey|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SurveyTableMap::COL_SURVEY_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SurveyTableMap::COL_SURVEY_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(SurveyTableMap::COL_SURVEY_ID, $surveyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($surveyId['max'])) {
                $this->addUsingAlias(SurveyTableMap::COL_SURVEY_ID, $surveyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SurveyTableMap::COL_SURVEY_ID, $surveyId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the survey_name column
     *
     * Example usage:
     * <code>
     * $query->filterBySurveyName('fooValue');   // WHERE survey_name = 'fooValue'
     * $query->filterBySurveyName('%fooValue%', Criteria::LIKE); // WHERE survey_name LIKE '%fooValue%'
     * $query->filterBySurveyName(['foo', 'bar']); // WHERE survey_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $surveyName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySurveyName($surveyName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($surveyName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SurveyTableMap::COL_SURVEY_NAME, $surveyName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the survey_catid column
     *
     * Example usage:
     * <code>
     * $query->filterBySurveyCatid(1234); // WHERE survey_catid = 1234
     * $query->filterBySurveyCatid(array(12, 34)); // WHERE survey_catid IN (12, 34)
     * $query->filterBySurveyCatid(array('min' => 12)); // WHERE survey_catid > 12
     * </code>
     *
     * @see       filterBySurveyCategory()
     *
     * @param mixed $surveyCatid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySurveyCatid($surveyCatid = null, ?string $comparison = null)
    {
        if (is_array($surveyCatid)) {
            $useMinMax = false;
            if (isset($surveyCatid['min'])) {
                $this->addUsingAlias(SurveyTableMap::COL_SURVEY_CATID, $surveyCatid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($surveyCatid['max'])) {
                $this->addUsingAlias(SurveyTableMap::COL_SURVEY_CATID, $surveyCatid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SurveyTableMap::COL_SURVEY_CATID, $surveyCatid, $comparison);

        return $this;
    }

    /**
     * Filter the query on the is_multiple column
     *
     * Example usage:
     * <code>
     * $query->filterByIsMultiple(true); // WHERE is_multiple = true
     * $query->filterByIsMultiple('yes'); // WHERE is_multiple = true
     * </code>
     *
     * @param bool|string $isMultiple The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIsMultiple($isMultiple = null, ?string $comparison = null)
    {
        if (is_string($isMultiple)) {
            $isMultiple = in_array(strtolower($isMultiple), array('false', 'off', '-', 'no', 'n', '0', ''), true) ? false : true;
        }

        $this->addUsingAlias(SurveyTableMap::COL_IS_MULTIPLE, $isMultiple, $comparison);

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

        $this->addUsingAlias(SurveyTableMap::COL_STATUS, $status, $comparison);

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
                $this->addUsingAlias(SurveyTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(SurveyTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SurveyTableMap::COL_COMPANY_ID, $companyId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_type_id column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletTypeId(1234); // WHERE outlet_type_id = 1234
     * $query->filterByOutletTypeId(array(12, 34)); // WHERE outlet_type_id IN (12, 34)
     * $query->filterByOutletTypeId(array('min' => 12)); // WHERE outlet_type_id > 12
     * </code>
     *
     * @see       filterByOutletType()
     *
     * @param mixed $outletTypeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletTypeId($outletTypeId = null, ?string $comparison = null)
    {
        if (is_array($outletTypeId)) {
            $useMinMax = false;
            if (isset($outletTypeId['min'])) {
                $this->addUsingAlias(SurveyTableMap::COL_OUTLET_TYPE_ID, $outletTypeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outletTypeId['max'])) {
                $this->addUsingAlias(SurveyTableMap::COL_OUTLET_TYPE_ID, $outletTypeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SurveyTableMap::COL_OUTLET_TYPE_ID, $outletTypeId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the orgunitid column
     *
     * Example usage:
     * <code>
     * $query->filterByOrgunitid('fooValue');   // WHERE orgunitid = 'fooValue'
     * $query->filterByOrgunitid('%fooValue%', Criteria::LIKE); // WHERE orgunitid LIKE '%fooValue%'
     * $query->filterByOrgunitid(['foo', 'bar']); // WHERE orgunitid IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $orgunitid The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrgunitid($orgunitid = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($orgunitid)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SurveyTableMap::COL_ORGUNITID, $orgunitid, $comparison);

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
                $this->addUsingAlias(SurveyTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(SurveyTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SurveyTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(SurveyTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(SurveyTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SurveyTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the media_id column
     *
     * Example usage:
     * <code>
     * $query->filterByMediaId('fooValue');   // WHERE media_id = 'fooValue'
     * $query->filterByMediaId('%fooValue%', Criteria::LIKE); // WHERE media_id LIKE '%fooValue%'
     * $query->filterByMediaId(['foo', 'bar']); // WHERE media_id IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $mediaId The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMediaId($mediaId = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($mediaId)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SurveyTableMap::COL_MEDIA_ID, $mediaId, $comparison);

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

        $this->addUsingAlias(SurveyTableMap::COL_AUDIENCE_TYPE, $audienceType, $comparison);

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

        $this->addUsingAlias(SurveyTableMap::COL_SHORT_CODE, $shortCode, $comparison);

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
                $this->addUsingAlias(SurveyTableMap::COL_START_DATE, $startDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($startDate['max'])) {
                $this->addUsingAlias(SurveyTableMap::COL_START_DATE, $startDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SurveyTableMap::COL_START_DATE, $startDate, $comparison);

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
                $this->addUsingAlias(SurveyTableMap::COL_END_DATE, $endDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($endDate['max'])) {
                $this->addUsingAlias(SurveyTableMap::COL_END_DATE, $endDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SurveyTableMap::COL_END_DATE, $endDate, $comparison);

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
                ->addUsingAlias(SurveyTableMap::COL_COMPANY_ID, $company->getCompanyId(), $comparison);
        } elseif ($company instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SurveyTableMap::COL_COMPANY_ID, $company->toKeyValue('PrimaryKey', 'CompanyId'), $comparison);

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
     * Filter the query by a related \entities\SurveyCategory object
     *
     * @param \entities\SurveyCategory|ObjectCollection $surveyCategory The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySurveyCategory($surveyCategory, ?string $comparison = null)
    {
        if ($surveyCategory instanceof \entities\SurveyCategory) {
            return $this
                ->addUsingAlias(SurveyTableMap::COL_SURVEY_CATID, $surveyCategory->getSurveyCatid(), $comparison);
        } elseif ($surveyCategory instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SurveyTableMap::COL_SURVEY_CATID, $surveyCategory->toKeyValue('PrimaryKey', 'SurveyCatid'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterBySurveyCategory() only accepts arguments of type \entities\SurveyCategory or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SurveyCategory relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSurveyCategory(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SurveyCategory');

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
            $this->addJoinObject($join, 'SurveyCategory');
        }

        return $this;
    }

    /**
     * Use the SurveyCategory relation SurveyCategory object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\SurveyCategoryQuery A secondary query class using the current class as primary query
     */
    public function useSurveyCategoryQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSurveyCategory($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SurveyCategory', '\entities\SurveyCategoryQuery');
    }

    /**
     * Use the SurveyCategory relation SurveyCategory object
     *
     * @param callable(\entities\SurveyCategoryQuery):\entities\SurveyCategoryQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSurveyCategoryQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useSurveyCategoryQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SurveyCategory table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\SurveyCategoryQuery The inner query object of the EXISTS statement
     */
    public function useSurveyCategoryExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\SurveyCategoryQuery */
        $q = $this->useExistsQuery('SurveyCategory', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SurveyCategory table for a NOT EXISTS query.
     *
     * @see useSurveyCategoryExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\SurveyCategoryQuery The inner query object of the NOT EXISTS statement
     */
    public function useSurveyCategoryNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\SurveyCategoryQuery */
        $q = $this->useExistsQuery('SurveyCategory', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SurveyCategory table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\SurveyCategoryQuery The inner query object of the IN statement
     */
    public function useInSurveyCategoryQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\SurveyCategoryQuery */
        $q = $this->useInQuery('SurveyCategory', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SurveyCategory table for a NOT IN query.
     *
     * @see useSurveyCategoryInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\SurveyCategoryQuery The inner query object of the NOT IN statement
     */
    public function useNotInSurveyCategoryQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\SurveyCategoryQuery */
        $q = $this->useInQuery('SurveyCategory', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(SurveyTableMap::COL_OUTLET_TYPE_ID, $outletType->getOutlettypeId(), $comparison);
        } elseif ($outletType instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SurveyTableMap::COL_OUTLET_TYPE_ID, $outletType->toKeyValue('PrimaryKey', 'OutlettypeId'), $comparison);

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
    public function joinOutletType(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
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
    public function useOutletTypeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
        ?string $joinType = Criteria::INNER_JOIN
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
                ->addUsingAlias(SurveyTableMap::COL_SURVEY_ID, $brandCampiagnVisitPlan->getSurveyId(), $comparison);

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
     * Filter the query by a related \entities\SurveyQuestion object
     *
     * @param \entities\SurveyQuestion|ObjectCollection $surveyQuestion the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySurveyQuestion($surveyQuestion, ?string $comparison = null)
    {
        if ($surveyQuestion instanceof \entities\SurveyQuestion) {
            $this
                ->addUsingAlias(SurveyTableMap::COL_SURVEY_ID, $surveyQuestion->getSurveyId(), $comparison);

            return $this;
        } elseif ($surveyQuestion instanceof ObjectCollection) {
            $this
                ->useSurveyQuestionQuery()
                ->filterByPrimaryKeys($surveyQuestion->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySurveyQuestion() only accepts arguments of type \entities\SurveyQuestion or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SurveyQuestion relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSurveyQuestion(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SurveyQuestion');

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
            $this->addJoinObject($join, 'SurveyQuestion');
        }

        return $this;
    }

    /**
     * Use the SurveyQuestion relation SurveyQuestion object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\SurveyQuestionQuery A secondary query class using the current class as primary query
     */
    public function useSurveyQuestionQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSurveyQuestion($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SurveyQuestion', '\entities\SurveyQuestionQuery');
    }

    /**
     * Use the SurveyQuestion relation SurveyQuestion object
     *
     * @param callable(\entities\SurveyQuestionQuery):\entities\SurveyQuestionQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSurveyQuestionQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useSurveyQuestionQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SurveyQuestion table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\SurveyQuestionQuery The inner query object of the EXISTS statement
     */
    public function useSurveyQuestionExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\SurveyQuestionQuery */
        $q = $this->useExistsQuery('SurveyQuestion', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SurveyQuestion table for a NOT EXISTS query.
     *
     * @see useSurveyQuestionExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\SurveyQuestionQuery The inner query object of the NOT EXISTS statement
     */
    public function useSurveyQuestionNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\SurveyQuestionQuery */
        $q = $this->useExistsQuery('SurveyQuestion', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SurveyQuestion table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\SurveyQuestionQuery The inner query object of the IN statement
     */
    public function useInSurveyQuestionQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\SurveyQuestionQuery */
        $q = $this->useInQuery('SurveyQuestion', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SurveyQuestion table for a NOT IN query.
     *
     * @see useSurveyQuestionInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\SurveyQuestionQuery The inner query object of the NOT IN statement
     */
    public function useNotInSurveyQuestionQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\SurveyQuestionQuery */
        $q = $this->useInQuery('SurveyQuestion', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSurvey $survey Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($survey = null)
    {
        if ($survey) {
            $this->addUsingAlias(SurveyTableMap::COL_SURVEY_ID, $survey->getSurveyId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the survey table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SurveyTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SurveyTableMap::clearInstancePool();
            SurveyTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SurveyTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SurveyTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SurveyTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SurveyTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
