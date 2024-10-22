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
use entities\EdPresentations as ChildEdPresentations;
use entities\EdPresentationsQuery as ChildEdPresentationsQuery;
use entities\Map\EdPresentationsTableMap;

/**
 * Base class that represents a query for the `ed_presentations` table.
 *
 * @method     ChildEdPresentationsQuery orderByPresentationId($order = Criteria::ASC) Order by the presentation_id column
 * @method     ChildEdPresentationsQuery orderByBrandId($order = Criteria::ASC) Order by the brand_id column
 * @method     ChildEdPresentationsQuery orderByPresentationName($order = Criteria::ASC) Order by the presentation_name column
 * @method     ChildEdPresentationsQuery orderByPresentationMedia($order = Criteria::ASC) Order by the presentation_media column
 * @method     ChildEdPresentationsQuery orderByPresentationZipUrl($order = Criteria::ASC) Order by the presentation_zip_url column
 * @method     ChildEdPresentationsQuery orderByPresentationVersionId($order = Criteria::ASC) Order by the presentation_version_id column
 * @method     ChildEdPresentationsQuery orderByPresentationReleaseDate($order = Criteria::ASC) Order by the presentation_release_date column
 * @method     ChildEdPresentationsQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildEdPresentationsQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildEdPresentationsQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildEdPresentationsQuery orderByOrgunitId($order = Criteria::ASC) Order by the orgunit_id column
 * @method     ChildEdPresentationsQuery orderByPageCount($order = Criteria::ASC) Order by the page_count column
 * @method     ChildEdPresentationsQuery orderByFileSize($order = Criteria::ASC) Order by the file_size column
 * @method     ChildEdPresentationsQuery orderByPresentationLanguageId($order = Criteria::ASC) Order by the presentation_language_id column
 * @method     ChildEdPresentationsQuery orderByMediaUrl($order = Criteria::ASC) Order by the media_url column
 * @method     ChildEdPresentationsQuery orderByPresentationTypeName($order = Criteria::ASC) Order by the presentation_type_name column
 *
 * @method     ChildEdPresentationsQuery groupByPresentationId() Group by the presentation_id column
 * @method     ChildEdPresentationsQuery groupByBrandId() Group by the brand_id column
 * @method     ChildEdPresentationsQuery groupByPresentationName() Group by the presentation_name column
 * @method     ChildEdPresentationsQuery groupByPresentationMedia() Group by the presentation_media column
 * @method     ChildEdPresentationsQuery groupByPresentationZipUrl() Group by the presentation_zip_url column
 * @method     ChildEdPresentationsQuery groupByPresentationVersionId() Group by the presentation_version_id column
 * @method     ChildEdPresentationsQuery groupByPresentationReleaseDate() Group by the presentation_release_date column
 * @method     ChildEdPresentationsQuery groupByCompanyId() Group by the company_id column
 * @method     ChildEdPresentationsQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildEdPresentationsQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildEdPresentationsQuery groupByOrgunitId() Group by the orgunit_id column
 * @method     ChildEdPresentationsQuery groupByPageCount() Group by the page_count column
 * @method     ChildEdPresentationsQuery groupByFileSize() Group by the file_size column
 * @method     ChildEdPresentationsQuery groupByPresentationLanguageId() Group by the presentation_language_id column
 * @method     ChildEdPresentationsQuery groupByMediaUrl() Group by the media_url column
 * @method     ChildEdPresentationsQuery groupByPresentationTypeName() Group by the presentation_type_name column
 *
 * @method     ChildEdPresentationsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildEdPresentationsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildEdPresentationsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildEdPresentationsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildEdPresentationsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildEdPresentationsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildEdPresentationsQuery leftJoinBrands($relationAlias = null) Adds a LEFT JOIN clause to the query using the Brands relation
 * @method     ChildEdPresentationsQuery rightJoinBrands($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Brands relation
 * @method     ChildEdPresentationsQuery innerJoinBrands($relationAlias = null) Adds a INNER JOIN clause to the query using the Brands relation
 *
 * @method     ChildEdPresentationsQuery joinWithBrands($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Brands relation
 *
 * @method     ChildEdPresentationsQuery leftJoinWithBrands() Adds a LEFT JOIN clause and with to the query using the Brands relation
 * @method     ChildEdPresentationsQuery rightJoinWithBrands() Adds a RIGHT JOIN clause and with to the query using the Brands relation
 * @method     ChildEdPresentationsQuery innerJoinWithBrands() Adds a INNER JOIN clause and with to the query using the Brands relation
 *
 * @method     ChildEdPresentationsQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildEdPresentationsQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildEdPresentationsQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildEdPresentationsQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildEdPresentationsQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildEdPresentationsQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildEdPresentationsQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     ChildEdPresentationsQuery leftJoinOrgUnit($relationAlias = null) Adds a LEFT JOIN clause to the query using the OrgUnit relation
 * @method     ChildEdPresentationsQuery rightJoinOrgUnit($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OrgUnit relation
 * @method     ChildEdPresentationsQuery innerJoinOrgUnit($relationAlias = null) Adds a INNER JOIN clause to the query using the OrgUnit relation
 *
 * @method     ChildEdPresentationsQuery joinWithOrgUnit($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OrgUnit relation
 *
 * @method     ChildEdPresentationsQuery leftJoinWithOrgUnit() Adds a LEFT JOIN clause and with to the query using the OrgUnit relation
 * @method     ChildEdPresentationsQuery rightJoinWithOrgUnit() Adds a RIGHT JOIN clause and with to the query using the OrgUnit relation
 * @method     ChildEdPresentationsQuery innerJoinWithOrgUnit() Adds a INNER JOIN clause and with to the query using the OrgUnit relation
 *
 * @method     ChildEdPresentationsQuery leftJoinLanguage($relationAlias = null) Adds a LEFT JOIN clause to the query using the Language relation
 * @method     ChildEdPresentationsQuery rightJoinLanguage($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Language relation
 * @method     ChildEdPresentationsQuery innerJoinLanguage($relationAlias = null) Adds a INNER JOIN clause to the query using the Language relation
 *
 * @method     ChildEdPresentationsQuery joinWithLanguage($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Language relation
 *
 * @method     ChildEdPresentationsQuery leftJoinWithLanguage() Adds a LEFT JOIN clause and with to the query using the Language relation
 * @method     ChildEdPresentationsQuery rightJoinWithLanguage() Adds a RIGHT JOIN clause and with to the query using the Language relation
 * @method     ChildEdPresentationsQuery innerJoinWithLanguage() Adds a INNER JOIN clause and with to the query using the Language relation
 *
 * @method     ChildEdPresentationsQuery leftJoinEdFeedbacks($relationAlias = null) Adds a LEFT JOIN clause to the query using the EdFeedbacks relation
 * @method     ChildEdPresentationsQuery rightJoinEdFeedbacks($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EdFeedbacks relation
 * @method     ChildEdPresentationsQuery innerJoinEdFeedbacks($relationAlias = null) Adds a INNER JOIN clause to the query using the EdFeedbacks relation
 *
 * @method     ChildEdPresentationsQuery joinWithEdFeedbacks($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the EdFeedbacks relation
 *
 * @method     ChildEdPresentationsQuery leftJoinWithEdFeedbacks() Adds a LEFT JOIN clause and with to the query using the EdFeedbacks relation
 * @method     ChildEdPresentationsQuery rightJoinWithEdFeedbacks() Adds a RIGHT JOIN clause and with to the query using the EdFeedbacks relation
 * @method     ChildEdPresentationsQuery innerJoinWithEdFeedbacks() Adds a INNER JOIN clause and with to the query using the EdFeedbacks relation
 *
 * @method     \entities\BrandsQuery|\entities\CompanyQuery|\entities\OrgUnitQuery|\entities\LanguageQuery|\entities\EdFeedbacksQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildEdPresentations|null findOne(?ConnectionInterface $con = null) Return the first ChildEdPresentations matching the query
 * @method     ChildEdPresentations findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildEdPresentations matching the query, or a new ChildEdPresentations object populated from the query conditions when no match is found
 *
 * @method     ChildEdPresentations|null findOneByPresentationId(int $presentation_id) Return the first ChildEdPresentations filtered by the presentation_id column
 * @method     ChildEdPresentations|null findOneByBrandId(int $brand_id) Return the first ChildEdPresentations filtered by the brand_id column
 * @method     ChildEdPresentations|null findOneByPresentationName(string $presentation_name) Return the first ChildEdPresentations filtered by the presentation_name column
 * @method     ChildEdPresentations|null findOneByPresentationMedia(int $presentation_media) Return the first ChildEdPresentations filtered by the presentation_media column
 * @method     ChildEdPresentations|null findOneByPresentationZipUrl(string $presentation_zip_url) Return the first ChildEdPresentations filtered by the presentation_zip_url column
 * @method     ChildEdPresentations|null findOneByPresentationVersionId(string $presentation_version_id) Return the first ChildEdPresentations filtered by the presentation_version_id column
 * @method     ChildEdPresentations|null findOneByPresentationReleaseDate(string $presentation_release_date) Return the first ChildEdPresentations filtered by the presentation_release_date column
 * @method     ChildEdPresentations|null findOneByCompanyId(int $company_id) Return the first ChildEdPresentations filtered by the company_id column
 * @method     ChildEdPresentations|null findOneByCreatedAt(string $created_at) Return the first ChildEdPresentations filtered by the created_at column
 * @method     ChildEdPresentations|null findOneByUpdatedAt(string $updated_at) Return the first ChildEdPresentations filtered by the updated_at column
 * @method     ChildEdPresentations|null findOneByOrgunitId(int $orgunit_id) Return the first ChildEdPresentations filtered by the orgunit_id column
 * @method     ChildEdPresentations|null findOneByPageCount(string $page_count) Return the first ChildEdPresentations filtered by the page_count column
 * @method     ChildEdPresentations|null findOneByFileSize(string $file_size) Return the first ChildEdPresentations filtered by the file_size column
 * @method     ChildEdPresentations|null findOneByPresentationLanguageId(int $presentation_language_id) Return the first ChildEdPresentations filtered by the presentation_language_id column
 * @method     ChildEdPresentations|null findOneByMediaUrl(string $media_url) Return the first ChildEdPresentations filtered by the media_url column
 * @method     ChildEdPresentations|null findOneByPresentationTypeName(string $presentation_type_name) Return the first ChildEdPresentations filtered by the presentation_type_name column
 *
 * @method     ChildEdPresentations requirePk($key, ?ConnectionInterface $con = null) Return the ChildEdPresentations by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEdPresentations requireOne(?ConnectionInterface $con = null) Return the first ChildEdPresentations matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEdPresentations requireOneByPresentationId(int $presentation_id) Return the first ChildEdPresentations filtered by the presentation_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEdPresentations requireOneByBrandId(int $brand_id) Return the first ChildEdPresentations filtered by the brand_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEdPresentations requireOneByPresentationName(string $presentation_name) Return the first ChildEdPresentations filtered by the presentation_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEdPresentations requireOneByPresentationMedia(int $presentation_media) Return the first ChildEdPresentations filtered by the presentation_media column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEdPresentations requireOneByPresentationZipUrl(string $presentation_zip_url) Return the first ChildEdPresentations filtered by the presentation_zip_url column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEdPresentations requireOneByPresentationVersionId(string $presentation_version_id) Return the first ChildEdPresentations filtered by the presentation_version_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEdPresentations requireOneByPresentationReleaseDate(string $presentation_release_date) Return the first ChildEdPresentations filtered by the presentation_release_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEdPresentations requireOneByCompanyId(int $company_id) Return the first ChildEdPresentations filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEdPresentations requireOneByCreatedAt(string $created_at) Return the first ChildEdPresentations filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEdPresentations requireOneByUpdatedAt(string $updated_at) Return the first ChildEdPresentations filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEdPresentations requireOneByOrgunitId(int $orgunit_id) Return the first ChildEdPresentations filtered by the orgunit_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEdPresentations requireOneByPageCount(string $page_count) Return the first ChildEdPresentations filtered by the page_count column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEdPresentations requireOneByFileSize(string $file_size) Return the first ChildEdPresentations filtered by the file_size column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEdPresentations requireOneByPresentationLanguageId(int $presentation_language_id) Return the first ChildEdPresentations filtered by the presentation_language_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEdPresentations requireOneByMediaUrl(string $media_url) Return the first ChildEdPresentations filtered by the media_url column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEdPresentations requireOneByPresentationTypeName(string $presentation_type_name) Return the first ChildEdPresentations filtered by the presentation_type_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEdPresentations[]|Collection find(?ConnectionInterface $con = null) Return ChildEdPresentations objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildEdPresentations> find(?ConnectionInterface $con = null) Return ChildEdPresentations objects based on current ModelCriteria
 *
 * @method     ChildEdPresentations[]|Collection findByPresentationId(int|array<int> $presentation_id) Return ChildEdPresentations objects filtered by the presentation_id column
 * @psalm-method Collection&\Traversable<ChildEdPresentations> findByPresentationId(int|array<int> $presentation_id) Return ChildEdPresentations objects filtered by the presentation_id column
 * @method     ChildEdPresentations[]|Collection findByBrandId(int|array<int> $brand_id) Return ChildEdPresentations objects filtered by the brand_id column
 * @psalm-method Collection&\Traversable<ChildEdPresentations> findByBrandId(int|array<int> $brand_id) Return ChildEdPresentations objects filtered by the brand_id column
 * @method     ChildEdPresentations[]|Collection findByPresentationName(string|array<string> $presentation_name) Return ChildEdPresentations objects filtered by the presentation_name column
 * @psalm-method Collection&\Traversable<ChildEdPresentations> findByPresentationName(string|array<string> $presentation_name) Return ChildEdPresentations objects filtered by the presentation_name column
 * @method     ChildEdPresentations[]|Collection findByPresentationMedia(int|array<int> $presentation_media) Return ChildEdPresentations objects filtered by the presentation_media column
 * @psalm-method Collection&\Traversable<ChildEdPresentations> findByPresentationMedia(int|array<int> $presentation_media) Return ChildEdPresentations objects filtered by the presentation_media column
 * @method     ChildEdPresentations[]|Collection findByPresentationZipUrl(string|array<string> $presentation_zip_url) Return ChildEdPresentations objects filtered by the presentation_zip_url column
 * @psalm-method Collection&\Traversable<ChildEdPresentations> findByPresentationZipUrl(string|array<string> $presentation_zip_url) Return ChildEdPresentations objects filtered by the presentation_zip_url column
 * @method     ChildEdPresentations[]|Collection findByPresentationVersionId(string|array<string> $presentation_version_id) Return ChildEdPresentations objects filtered by the presentation_version_id column
 * @psalm-method Collection&\Traversable<ChildEdPresentations> findByPresentationVersionId(string|array<string> $presentation_version_id) Return ChildEdPresentations objects filtered by the presentation_version_id column
 * @method     ChildEdPresentations[]|Collection findByPresentationReleaseDate(string|array<string> $presentation_release_date) Return ChildEdPresentations objects filtered by the presentation_release_date column
 * @psalm-method Collection&\Traversable<ChildEdPresentations> findByPresentationReleaseDate(string|array<string> $presentation_release_date) Return ChildEdPresentations objects filtered by the presentation_release_date column
 * @method     ChildEdPresentations[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildEdPresentations objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildEdPresentations> findByCompanyId(int|array<int> $company_id) Return ChildEdPresentations objects filtered by the company_id column
 * @method     ChildEdPresentations[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildEdPresentations objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildEdPresentations> findByCreatedAt(string|array<string> $created_at) Return ChildEdPresentations objects filtered by the created_at column
 * @method     ChildEdPresentations[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildEdPresentations objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildEdPresentations> findByUpdatedAt(string|array<string> $updated_at) Return ChildEdPresentations objects filtered by the updated_at column
 * @method     ChildEdPresentations[]|Collection findByOrgunitId(int|array<int> $orgunit_id) Return ChildEdPresentations objects filtered by the orgunit_id column
 * @psalm-method Collection&\Traversable<ChildEdPresentations> findByOrgunitId(int|array<int> $orgunit_id) Return ChildEdPresentations objects filtered by the orgunit_id column
 * @method     ChildEdPresentations[]|Collection findByPageCount(string|array<string> $page_count) Return ChildEdPresentations objects filtered by the page_count column
 * @psalm-method Collection&\Traversable<ChildEdPresentations> findByPageCount(string|array<string> $page_count) Return ChildEdPresentations objects filtered by the page_count column
 * @method     ChildEdPresentations[]|Collection findByFileSize(string|array<string> $file_size) Return ChildEdPresentations objects filtered by the file_size column
 * @psalm-method Collection&\Traversable<ChildEdPresentations> findByFileSize(string|array<string> $file_size) Return ChildEdPresentations objects filtered by the file_size column
 * @method     ChildEdPresentations[]|Collection findByPresentationLanguageId(int|array<int> $presentation_language_id) Return ChildEdPresentations objects filtered by the presentation_language_id column
 * @psalm-method Collection&\Traversable<ChildEdPresentations> findByPresentationLanguageId(int|array<int> $presentation_language_id) Return ChildEdPresentations objects filtered by the presentation_language_id column
 * @method     ChildEdPresentations[]|Collection findByMediaUrl(string|array<string> $media_url) Return ChildEdPresentations objects filtered by the media_url column
 * @psalm-method Collection&\Traversable<ChildEdPresentations> findByMediaUrl(string|array<string> $media_url) Return ChildEdPresentations objects filtered by the media_url column
 * @method     ChildEdPresentations[]|Collection findByPresentationTypeName(string|array<string> $presentation_type_name) Return ChildEdPresentations objects filtered by the presentation_type_name column
 * @psalm-method Collection&\Traversable<ChildEdPresentations> findByPresentationTypeName(string|array<string> $presentation_type_name) Return ChildEdPresentations objects filtered by the presentation_type_name column
 *
 * @method     ChildEdPresentations[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildEdPresentations> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class EdPresentationsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\EdPresentationsQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\EdPresentations', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildEdPresentationsQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildEdPresentationsQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildEdPresentationsQuery) {
            return $criteria;
        }
        $query = new ChildEdPresentationsQuery();
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
     * @return ChildEdPresentations|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(EdPresentationsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = EdPresentationsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildEdPresentations A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT presentation_id, brand_id, presentation_name, presentation_media, presentation_zip_url, presentation_version_id, presentation_release_date, company_id, created_at, updated_at, orgunit_id, page_count, file_size, presentation_language_id, media_url, presentation_type_name FROM ed_presentations WHERE presentation_id = :p0';
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
            /** @var ChildEdPresentations $obj */
            $obj = new ChildEdPresentations();
            $obj->hydrate($row);
            EdPresentationsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildEdPresentations|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(EdPresentationsTableMap::COL_PRESENTATION_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(EdPresentationsTableMap::COL_PRESENTATION_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the presentation_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPresentationId(1234); // WHERE presentation_id = 1234
     * $query->filterByPresentationId(array(12, 34)); // WHERE presentation_id IN (12, 34)
     * $query->filterByPresentationId(array('min' => 12)); // WHERE presentation_id > 12
     * </code>
     *
     * @param mixed $presentationId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPresentationId($presentationId = null, ?string $comparison = null)
    {
        if (is_array($presentationId)) {
            $useMinMax = false;
            if (isset($presentationId['min'])) {
                $this->addUsingAlias(EdPresentationsTableMap::COL_PRESENTATION_ID, $presentationId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($presentationId['max'])) {
                $this->addUsingAlias(EdPresentationsTableMap::COL_PRESENTATION_ID, $presentationId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EdPresentationsTableMap::COL_PRESENTATION_ID, $presentationId, $comparison);

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
                $this->addUsingAlias(EdPresentationsTableMap::COL_BRAND_ID, $brandId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($brandId['max'])) {
                $this->addUsingAlias(EdPresentationsTableMap::COL_BRAND_ID, $brandId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EdPresentationsTableMap::COL_BRAND_ID, $brandId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the presentation_name column
     *
     * Example usage:
     * <code>
     * $query->filterByPresentationName('fooValue');   // WHERE presentation_name = 'fooValue'
     * $query->filterByPresentationName('%fooValue%', Criteria::LIKE); // WHERE presentation_name LIKE '%fooValue%'
     * $query->filterByPresentationName(['foo', 'bar']); // WHERE presentation_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $presentationName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPresentationName($presentationName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($presentationName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EdPresentationsTableMap::COL_PRESENTATION_NAME, $presentationName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the presentation_media column
     *
     * Example usage:
     * <code>
     * $query->filterByPresentationMedia(1234); // WHERE presentation_media = 1234
     * $query->filterByPresentationMedia(array(12, 34)); // WHERE presentation_media IN (12, 34)
     * $query->filterByPresentationMedia(array('min' => 12)); // WHERE presentation_media > 12
     * </code>
     *
     * @param mixed $presentationMedia The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPresentationMedia($presentationMedia = null, ?string $comparison = null)
    {
        if (is_array($presentationMedia)) {
            $useMinMax = false;
            if (isset($presentationMedia['min'])) {
                $this->addUsingAlias(EdPresentationsTableMap::COL_PRESENTATION_MEDIA, $presentationMedia['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($presentationMedia['max'])) {
                $this->addUsingAlias(EdPresentationsTableMap::COL_PRESENTATION_MEDIA, $presentationMedia['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EdPresentationsTableMap::COL_PRESENTATION_MEDIA, $presentationMedia, $comparison);

        return $this;
    }

    /**
     * Filter the query on the presentation_zip_url column
     *
     * Example usage:
     * <code>
     * $query->filterByPresentationZipUrl('fooValue');   // WHERE presentation_zip_url = 'fooValue'
     * $query->filterByPresentationZipUrl('%fooValue%', Criteria::LIKE); // WHERE presentation_zip_url LIKE '%fooValue%'
     * $query->filterByPresentationZipUrl(['foo', 'bar']); // WHERE presentation_zip_url IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $presentationZipUrl The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPresentationZipUrl($presentationZipUrl = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($presentationZipUrl)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EdPresentationsTableMap::COL_PRESENTATION_ZIP_URL, $presentationZipUrl, $comparison);

        return $this;
    }

    /**
     * Filter the query on the presentation_version_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPresentationVersionId(1234); // WHERE presentation_version_id = 1234
     * $query->filterByPresentationVersionId(array(12, 34)); // WHERE presentation_version_id IN (12, 34)
     * $query->filterByPresentationVersionId(array('min' => 12)); // WHERE presentation_version_id > 12
     * </code>
     *
     * @param mixed $presentationVersionId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPresentationVersionId($presentationVersionId = null, ?string $comparison = null)
    {
        if (is_array($presentationVersionId)) {
            $useMinMax = false;
            if (isset($presentationVersionId['min'])) {
                $this->addUsingAlias(EdPresentationsTableMap::COL_PRESENTATION_VERSION_ID, $presentationVersionId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($presentationVersionId['max'])) {
                $this->addUsingAlias(EdPresentationsTableMap::COL_PRESENTATION_VERSION_ID, $presentationVersionId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EdPresentationsTableMap::COL_PRESENTATION_VERSION_ID, $presentationVersionId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the presentation_release_date column
     *
     * Example usage:
     * <code>
     * $query->filterByPresentationReleaseDate('2011-03-14'); // WHERE presentation_release_date = '2011-03-14'
     * $query->filterByPresentationReleaseDate('now'); // WHERE presentation_release_date = '2011-03-14'
     * $query->filterByPresentationReleaseDate(array('max' => 'yesterday')); // WHERE presentation_release_date > '2011-03-13'
     * </code>
     *
     * @param mixed $presentationReleaseDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPresentationReleaseDate($presentationReleaseDate = null, ?string $comparison = null)
    {
        if (is_array($presentationReleaseDate)) {
            $useMinMax = false;
            if (isset($presentationReleaseDate['min'])) {
                $this->addUsingAlias(EdPresentationsTableMap::COL_PRESENTATION_RELEASE_DATE, $presentationReleaseDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($presentationReleaseDate['max'])) {
                $this->addUsingAlias(EdPresentationsTableMap::COL_PRESENTATION_RELEASE_DATE, $presentationReleaseDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EdPresentationsTableMap::COL_PRESENTATION_RELEASE_DATE, $presentationReleaseDate, $comparison);

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
                $this->addUsingAlias(EdPresentationsTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(EdPresentationsTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EdPresentationsTableMap::COL_COMPANY_ID, $companyId, $comparison);

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
                $this->addUsingAlias(EdPresentationsTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(EdPresentationsTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EdPresentationsTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(EdPresentationsTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(EdPresentationsTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EdPresentationsTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the orgunit_id column
     *
     * Example usage:
     * <code>
     * $query->filterByOrgunitId(1234); // WHERE orgunit_id = 1234
     * $query->filterByOrgunitId(array(12, 34)); // WHERE orgunit_id IN (12, 34)
     * $query->filterByOrgunitId(array('min' => 12)); // WHERE orgunit_id > 12
     * </code>
     *
     * @see       filterByOrgUnit()
     *
     * @param mixed $orgunitId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrgunitId($orgunitId = null, ?string $comparison = null)
    {
        if (is_array($orgunitId)) {
            $useMinMax = false;
            if (isset($orgunitId['min'])) {
                $this->addUsingAlias(EdPresentationsTableMap::COL_ORGUNIT_ID, $orgunitId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($orgunitId['max'])) {
                $this->addUsingAlias(EdPresentationsTableMap::COL_ORGUNIT_ID, $orgunitId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EdPresentationsTableMap::COL_ORGUNIT_ID, $orgunitId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the page_count column
     *
     * Example usage:
     * <code>
     * $query->filterByPageCount('fooValue');   // WHERE page_count = 'fooValue'
     * $query->filterByPageCount('%fooValue%', Criteria::LIKE); // WHERE page_count LIKE '%fooValue%'
     * $query->filterByPageCount(['foo', 'bar']); // WHERE page_count IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $pageCount The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPageCount($pageCount = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($pageCount)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EdPresentationsTableMap::COL_PAGE_COUNT, $pageCount, $comparison);

        return $this;
    }

    /**
     * Filter the query on the file_size column
     *
     * Example usage:
     * <code>
     * $query->filterByFileSize('fooValue');   // WHERE file_size = 'fooValue'
     * $query->filterByFileSize('%fooValue%', Criteria::LIKE); // WHERE file_size LIKE '%fooValue%'
     * $query->filterByFileSize(['foo', 'bar']); // WHERE file_size IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $fileSize The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFileSize($fileSize = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fileSize)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EdPresentationsTableMap::COL_FILE_SIZE, $fileSize, $comparison);

        return $this;
    }

    /**
     * Filter the query on the presentation_language_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPresentationLanguageId(1234); // WHERE presentation_language_id = 1234
     * $query->filterByPresentationLanguageId(array(12, 34)); // WHERE presentation_language_id IN (12, 34)
     * $query->filterByPresentationLanguageId(array('min' => 12)); // WHERE presentation_language_id > 12
     * </code>
     *
     * @see       filterByLanguage()
     *
     * @param mixed $presentationLanguageId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPresentationLanguageId($presentationLanguageId = null, ?string $comparison = null)
    {
        if (is_array($presentationLanguageId)) {
            $useMinMax = false;
            if (isset($presentationLanguageId['min'])) {
                $this->addUsingAlias(EdPresentationsTableMap::COL_PRESENTATION_LANGUAGE_ID, $presentationLanguageId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($presentationLanguageId['max'])) {
                $this->addUsingAlias(EdPresentationsTableMap::COL_PRESENTATION_LANGUAGE_ID, $presentationLanguageId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EdPresentationsTableMap::COL_PRESENTATION_LANGUAGE_ID, $presentationLanguageId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the media_url column
     *
     * Example usage:
     * <code>
     * $query->filterByMediaUrl('fooValue');   // WHERE media_url = 'fooValue'
     * $query->filterByMediaUrl('%fooValue%', Criteria::LIKE); // WHERE media_url LIKE '%fooValue%'
     * $query->filterByMediaUrl(['foo', 'bar']); // WHERE media_url IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $mediaUrl The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMediaUrl($mediaUrl = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($mediaUrl)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EdPresentationsTableMap::COL_MEDIA_URL, $mediaUrl, $comparison);

        return $this;
    }

    /**
     * Filter the query on the presentation_type_name column
     *
     * Example usage:
     * <code>
     * $query->filterByPresentationTypeName('fooValue');   // WHERE presentation_type_name = 'fooValue'
     * $query->filterByPresentationTypeName('%fooValue%', Criteria::LIKE); // WHERE presentation_type_name LIKE '%fooValue%'
     * $query->filterByPresentationTypeName(['foo', 'bar']); // WHERE presentation_type_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $presentationTypeName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPresentationTypeName($presentationTypeName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($presentationTypeName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EdPresentationsTableMap::COL_PRESENTATION_TYPE_NAME, $presentationTypeName, $comparison);

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
                ->addUsingAlias(EdPresentationsTableMap::COL_BRAND_ID, $brands->getBrandId(), $comparison);
        } elseif ($brands instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(EdPresentationsTableMap::COL_BRAND_ID, $brands->toKeyValue('PrimaryKey', 'BrandId'), $comparison);

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
                ->addUsingAlias(EdPresentationsTableMap::COL_COMPANY_ID, $company->getCompanyId(), $comparison);
        } elseif ($company instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(EdPresentationsTableMap::COL_COMPANY_ID, $company->toKeyValue('PrimaryKey', 'CompanyId'), $comparison);

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
                ->addUsingAlias(EdPresentationsTableMap::COL_ORGUNIT_ID, $orgUnit->getOrgunitid(), $comparison);
        } elseif ($orgUnit instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(EdPresentationsTableMap::COL_ORGUNIT_ID, $orgUnit->toKeyValue('PrimaryKey', 'Orgunitid'), $comparison);

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
     * Filter the query by a related \entities\Language object
     *
     * @param \entities\Language|ObjectCollection $language The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLanguage($language, ?string $comparison = null)
    {
        if ($language instanceof \entities\Language) {
            return $this
                ->addUsingAlias(EdPresentationsTableMap::COL_PRESENTATION_LANGUAGE_ID, $language->getLanguageId(), $comparison);
        } elseif ($language instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(EdPresentationsTableMap::COL_PRESENTATION_LANGUAGE_ID, $language->toKeyValue('PrimaryKey', 'LanguageId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByLanguage() only accepts arguments of type \entities\Language or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Language relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinLanguage(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Language');

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
            $this->addJoinObject($join, 'Language');
        }

        return $this;
    }

    /**
     * Use the Language relation Language object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\LanguageQuery A secondary query class using the current class as primary query
     */
    public function useLanguageQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinLanguage($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Language', '\entities\LanguageQuery');
    }

    /**
     * Use the Language relation Language object
     *
     * @param callable(\entities\LanguageQuery):\entities\LanguageQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withLanguageQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useLanguageQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Language table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\LanguageQuery The inner query object of the EXISTS statement
     */
    public function useLanguageExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\LanguageQuery */
        $q = $this->useExistsQuery('Language', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Language table for a NOT EXISTS query.
     *
     * @see useLanguageExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\LanguageQuery The inner query object of the NOT EXISTS statement
     */
    public function useLanguageNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\LanguageQuery */
        $q = $this->useExistsQuery('Language', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Language table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\LanguageQuery The inner query object of the IN statement
     */
    public function useInLanguageQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\LanguageQuery */
        $q = $this->useInQuery('Language', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Language table for a NOT IN query.
     *
     * @see useLanguageInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\LanguageQuery The inner query object of the NOT IN statement
     */
    public function useNotInLanguageQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\LanguageQuery */
        $q = $this->useInQuery('Language', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\EdFeedbacks object
     *
     * @param \entities\EdFeedbacks|ObjectCollection $edFeedbacks the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEdFeedbacks($edFeedbacks, ?string $comparison = null)
    {
        if ($edFeedbacks instanceof \entities\EdFeedbacks) {
            $this
                ->addUsingAlias(EdPresentationsTableMap::COL_PRESENTATION_ID, $edFeedbacks->getPresentationId(), $comparison);

            return $this;
        } elseif ($edFeedbacks instanceof ObjectCollection) {
            $this
                ->useEdFeedbacksQuery()
                ->filterByPrimaryKeys($edFeedbacks->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByEdFeedbacks() only accepts arguments of type \entities\EdFeedbacks or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the EdFeedbacks relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinEdFeedbacks(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('EdFeedbacks');

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
            $this->addJoinObject($join, 'EdFeedbacks');
        }

        return $this;
    }

    /**
     * Use the EdFeedbacks relation EdFeedbacks object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\EdFeedbacksQuery A secondary query class using the current class as primary query
     */
    public function useEdFeedbacksQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinEdFeedbacks($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'EdFeedbacks', '\entities\EdFeedbacksQuery');
    }

    /**
     * Use the EdFeedbacks relation EdFeedbacks object
     *
     * @param callable(\entities\EdFeedbacksQuery):\entities\EdFeedbacksQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withEdFeedbacksQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useEdFeedbacksQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to EdFeedbacks table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\EdFeedbacksQuery The inner query object of the EXISTS statement
     */
    public function useEdFeedbacksExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\EdFeedbacksQuery */
        $q = $this->useExistsQuery('EdFeedbacks', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to EdFeedbacks table for a NOT EXISTS query.
     *
     * @see useEdFeedbacksExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\EdFeedbacksQuery The inner query object of the NOT EXISTS statement
     */
    public function useEdFeedbacksNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\EdFeedbacksQuery */
        $q = $this->useExistsQuery('EdFeedbacks', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to EdFeedbacks table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\EdFeedbacksQuery The inner query object of the IN statement
     */
    public function useInEdFeedbacksQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\EdFeedbacksQuery */
        $q = $this->useInQuery('EdFeedbacks', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to EdFeedbacks table for a NOT IN query.
     *
     * @see useEdFeedbacksInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\EdFeedbacksQuery The inner query object of the NOT IN statement
     */
    public function useNotInEdFeedbacksQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\EdFeedbacksQuery */
        $q = $this->useInQuery('EdFeedbacks', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildEdPresentations $edPresentations Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($edPresentations = null)
    {
        if ($edPresentations) {
            $this->addUsingAlias(EdPresentationsTableMap::COL_PRESENTATION_ID, $edPresentations->getPresentationId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the ed_presentations table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EdPresentationsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            EdPresentationsTableMap::clearInstancePool();
            EdPresentationsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(EdPresentationsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(EdPresentationsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            EdPresentationsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            EdPresentationsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
