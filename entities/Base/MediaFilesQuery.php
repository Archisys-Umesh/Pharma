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
use entities\MediaFiles as ChildMediaFiles;
use entities\MediaFilesQuery as ChildMediaFilesQuery;
use entities\Map\MediaFilesTableMap;

/**
 * Base class that represents a query for the `media_files` table.
 *
 * @method     ChildMediaFilesQuery orderByMediaId($order = Criteria::ASC) Order by the media_id column
 * @method     ChildMediaFilesQuery orderByMediaName($order = Criteria::ASC) Order by the media_name column
 * @method     ChildMediaFilesQuery orderByMediaMime($order = Criteria::ASC) Order by the media_mime column
 * @method     ChildMediaFilesQuery orderByMediaData($order = Criteria::ASC) Order by the media_data column
 * @method     ChildMediaFilesQuery orderByFolderId($order = Criteria::ASC) Order by the folder_id column
 * @method     ChildMediaFilesQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildMediaFilesQuery orderByIss3file($order = Criteria::ASC) Order by the iss3file column
 *
 * @method     ChildMediaFilesQuery groupByMediaId() Group by the media_id column
 * @method     ChildMediaFilesQuery groupByMediaName() Group by the media_name column
 * @method     ChildMediaFilesQuery groupByMediaMime() Group by the media_mime column
 * @method     ChildMediaFilesQuery groupByMediaData() Group by the media_data column
 * @method     ChildMediaFilesQuery groupByFolderId() Group by the folder_id column
 * @method     ChildMediaFilesQuery groupByCompanyId() Group by the company_id column
 * @method     ChildMediaFilesQuery groupByIss3file() Group by the iss3file column
 *
 * @method     ChildMediaFilesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildMediaFilesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildMediaFilesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildMediaFilesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildMediaFilesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildMediaFilesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildMediaFilesQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildMediaFilesQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildMediaFilesQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildMediaFilesQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildMediaFilesQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildMediaFilesQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildMediaFilesQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     ChildMediaFilesQuery leftJoinMediaFolders($relationAlias = null) Adds a LEFT JOIN clause to the query using the MediaFolders relation
 * @method     ChildMediaFilesQuery rightJoinMediaFolders($relationAlias = null) Adds a RIGHT JOIN clause to the query using the MediaFolders relation
 * @method     ChildMediaFilesQuery innerJoinMediaFolders($relationAlias = null) Adds a INNER JOIN clause to the query using the MediaFolders relation
 *
 * @method     ChildMediaFilesQuery joinWithMediaFolders($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the MediaFolders relation
 *
 * @method     ChildMediaFilesQuery leftJoinWithMediaFolders() Adds a LEFT JOIN clause and with to the query using the MediaFolders relation
 * @method     ChildMediaFilesQuery rightJoinWithMediaFolders() Adds a RIGHT JOIN clause and with to the query using the MediaFolders relation
 * @method     ChildMediaFilesQuery innerJoinWithMediaFolders() Adds a INNER JOIN clause and with to the query using the MediaFolders relation
 *
 * @method     ChildMediaFilesQuery leftJoinAgendatypes($relationAlias = null) Adds a LEFT JOIN clause to the query using the Agendatypes relation
 * @method     ChildMediaFilesQuery rightJoinAgendatypes($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Agendatypes relation
 * @method     ChildMediaFilesQuery innerJoinAgendatypes($relationAlias = null) Adds a INNER JOIN clause to the query using the Agendatypes relation
 *
 * @method     ChildMediaFilesQuery joinWithAgendatypes($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Agendatypes relation
 *
 * @method     ChildMediaFilesQuery leftJoinWithAgendatypes() Adds a LEFT JOIN clause and with to the query using the Agendatypes relation
 * @method     ChildMediaFilesQuery rightJoinWithAgendatypes() Adds a RIGHT JOIN clause and with to the query using the Agendatypes relation
 * @method     ChildMediaFilesQuery innerJoinWithAgendatypes() Adds a INNER JOIN clause and with to the query using the Agendatypes relation
 *
 * @method     ChildMediaFilesQuery leftJoinCheckInMedia($relationAlias = null) Adds a LEFT JOIN clause to the query using the CheckInMedia relation
 * @method     ChildMediaFilesQuery rightJoinCheckInMedia($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CheckInMedia relation
 * @method     ChildMediaFilesQuery innerJoinCheckInMedia($relationAlias = null) Adds a INNER JOIN clause to the query using the CheckInMedia relation
 *
 * @method     ChildMediaFilesQuery joinWithCheckInMedia($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the CheckInMedia relation
 *
 * @method     ChildMediaFilesQuery leftJoinWithCheckInMedia() Adds a LEFT JOIN clause and with to the query using the CheckInMedia relation
 * @method     ChildMediaFilesQuery rightJoinWithCheckInMedia() Adds a RIGHT JOIN clause and with to the query using the CheckInMedia relation
 * @method     ChildMediaFilesQuery innerJoinWithCheckInMedia() Adds a INNER JOIN clause and with to the query using the CheckInMedia relation
 *
 * @method     ChildMediaFilesQuery leftJoinGifts($relationAlias = null) Adds a LEFT JOIN clause to the query using the Gifts relation
 * @method     ChildMediaFilesQuery rightJoinGifts($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Gifts relation
 * @method     ChildMediaFilesQuery innerJoinGifts($relationAlias = null) Adds a INNER JOIN clause to the query using the Gifts relation
 *
 * @method     ChildMediaFilesQuery joinWithGifts($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Gifts relation
 *
 * @method     ChildMediaFilesQuery leftJoinWithGifts() Adds a LEFT JOIN clause and with to the query using the Gifts relation
 * @method     ChildMediaFilesQuery rightJoinWithGifts() Adds a RIGHT JOIN clause and with to the query using the Gifts relation
 * @method     ChildMediaFilesQuery innerJoinWithGifts() Adds a INNER JOIN clause and with to the query using the Gifts relation
 *
 * @method     ChildMediaFilesQuery leftJoinOffers($relationAlias = null) Adds a LEFT JOIN clause to the query using the Offers relation
 * @method     ChildMediaFilesQuery rightJoinOffers($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Offers relation
 * @method     ChildMediaFilesQuery innerJoinOffers($relationAlias = null) Adds a INNER JOIN clause to the query using the Offers relation
 *
 * @method     ChildMediaFilesQuery joinWithOffers($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Offers relation
 *
 * @method     ChildMediaFilesQuery leftJoinWithOffers() Adds a LEFT JOIN clause and with to the query using the Offers relation
 * @method     ChildMediaFilesQuery rightJoinWithOffers() Adds a RIGHT JOIN clause and with to the query using the Offers relation
 * @method     ChildMediaFilesQuery innerJoinWithOffers() Adds a INNER JOIN clause and with to the query using the Offers relation
 *
 * @method     ChildMediaFilesQuery leftJoinOutletType($relationAlias = null) Adds a LEFT JOIN clause to the query using the OutletType relation
 * @method     ChildMediaFilesQuery rightJoinOutletType($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OutletType relation
 * @method     ChildMediaFilesQuery innerJoinOutletType($relationAlias = null) Adds a INNER JOIN clause to the query using the OutletType relation
 *
 * @method     ChildMediaFilesQuery joinWithOutletType($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OutletType relation
 *
 * @method     ChildMediaFilesQuery leftJoinWithOutletType() Adds a LEFT JOIN clause and with to the query using the OutletType relation
 * @method     ChildMediaFilesQuery rightJoinWithOutletType() Adds a RIGHT JOIN clause and with to the query using the OutletType relation
 * @method     ChildMediaFilesQuery innerJoinWithOutletType() Adds a INNER JOIN clause and with to the query using the OutletType relation
 *
 * @method     \entities\CompanyQuery|\entities\MediaFoldersQuery|\entities\AgendatypesQuery|\entities\CheckInMediaQuery|\entities\GiftsQuery|\entities\OffersQuery|\entities\OutletTypeQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildMediaFiles|null findOne(?ConnectionInterface $con = null) Return the first ChildMediaFiles matching the query
 * @method     ChildMediaFiles findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildMediaFiles matching the query, or a new ChildMediaFiles object populated from the query conditions when no match is found
 *
 * @method     ChildMediaFiles|null findOneByMediaId(int $media_id) Return the first ChildMediaFiles filtered by the media_id column
 * @method     ChildMediaFiles|null findOneByMediaName(string $media_name) Return the first ChildMediaFiles filtered by the media_name column
 * @method     ChildMediaFiles|null findOneByMediaMime(string $media_mime) Return the first ChildMediaFiles filtered by the media_mime column
 * @method     ChildMediaFiles|null findOneByMediaData(string $media_data) Return the first ChildMediaFiles filtered by the media_data column
 * @method     ChildMediaFiles|null findOneByFolderId(int $folder_id) Return the first ChildMediaFiles filtered by the folder_id column
 * @method     ChildMediaFiles|null findOneByCompanyId(int $company_id) Return the first ChildMediaFiles filtered by the company_id column
 * @method     ChildMediaFiles|null findOneByIss3file(boolean $iss3file) Return the first ChildMediaFiles filtered by the iss3file column
 *
 * @method     ChildMediaFiles requirePk($key, ?ConnectionInterface $con = null) Return the ChildMediaFiles by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMediaFiles requireOne(?ConnectionInterface $con = null) Return the first ChildMediaFiles matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildMediaFiles requireOneByMediaId(int $media_id) Return the first ChildMediaFiles filtered by the media_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMediaFiles requireOneByMediaName(string $media_name) Return the first ChildMediaFiles filtered by the media_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMediaFiles requireOneByMediaMime(string $media_mime) Return the first ChildMediaFiles filtered by the media_mime column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMediaFiles requireOneByMediaData(string $media_data) Return the first ChildMediaFiles filtered by the media_data column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMediaFiles requireOneByFolderId(int $folder_id) Return the first ChildMediaFiles filtered by the folder_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMediaFiles requireOneByCompanyId(int $company_id) Return the first ChildMediaFiles filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMediaFiles requireOneByIss3file(boolean $iss3file) Return the first ChildMediaFiles filtered by the iss3file column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildMediaFiles[]|Collection find(?ConnectionInterface $con = null) Return ChildMediaFiles objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildMediaFiles> find(?ConnectionInterface $con = null) Return ChildMediaFiles objects based on current ModelCriteria
 *
 * @method     ChildMediaFiles[]|Collection findByMediaId(int|array<int> $media_id) Return ChildMediaFiles objects filtered by the media_id column
 * @psalm-method Collection&\Traversable<ChildMediaFiles> findByMediaId(int|array<int> $media_id) Return ChildMediaFiles objects filtered by the media_id column
 * @method     ChildMediaFiles[]|Collection findByMediaName(string|array<string> $media_name) Return ChildMediaFiles objects filtered by the media_name column
 * @psalm-method Collection&\Traversable<ChildMediaFiles> findByMediaName(string|array<string> $media_name) Return ChildMediaFiles objects filtered by the media_name column
 * @method     ChildMediaFiles[]|Collection findByMediaMime(string|array<string> $media_mime) Return ChildMediaFiles objects filtered by the media_mime column
 * @psalm-method Collection&\Traversable<ChildMediaFiles> findByMediaMime(string|array<string> $media_mime) Return ChildMediaFiles objects filtered by the media_mime column
 * @method     ChildMediaFiles[]|Collection findByMediaData(string|array<string> $media_data) Return ChildMediaFiles objects filtered by the media_data column
 * @psalm-method Collection&\Traversable<ChildMediaFiles> findByMediaData(string|array<string> $media_data) Return ChildMediaFiles objects filtered by the media_data column
 * @method     ChildMediaFiles[]|Collection findByFolderId(int|array<int> $folder_id) Return ChildMediaFiles objects filtered by the folder_id column
 * @psalm-method Collection&\Traversable<ChildMediaFiles> findByFolderId(int|array<int> $folder_id) Return ChildMediaFiles objects filtered by the folder_id column
 * @method     ChildMediaFiles[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildMediaFiles objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildMediaFiles> findByCompanyId(int|array<int> $company_id) Return ChildMediaFiles objects filtered by the company_id column
 * @method     ChildMediaFiles[]|Collection findByIss3file(boolean|array<boolean> $iss3file) Return ChildMediaFiles objects filtered by the iss3file column
 * @psalm-method Collection&\Traversable<ChildMediaFiles> findByIss3file(boolean|array<boolean> $iss3file) Return ChildMediaFiles objects filtered by the iss3file column
 *
 * @method     ChildMediaFiles[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildMediaFiles> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class MediaFilesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\MediaFilesQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\MediaFiles', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildMediaFilesQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildMediaFilesQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildMediaFilesQuery) {
            return $criteria;
        }
        $query = new ChildMediaFilesQuery();
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
     * @return ChildMediaFiles|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(MediaFilesTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = MediaFilesTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildMediaFiles A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT media_id, media_name, media_mime, media_data, folder_id, company_id, iss3file FROM media_files WHERE media_id = :p0';
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
            /** @var ChildMediaFiles $obj */
            $obj = new ChildMediaFiles();
            $obj->hydrate($row);
            MediaFilesTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildMediaFiles|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(MediaFilesTableMap::COL_MEDIA_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(MediaFilesTableMap::COL_MEDIA_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the media_id column
     *
     * Example usage:
     * <code>
     * $query->filterByMediaId(1234); // WHERE media_id = 1234
     * $query->filterByMediaId(array(12, 34)); // WHERE media_id IN (12, 34)
     * $query->filterByMediaId(array('min' => 12)); // WHERE media_id > 12
     * </code>
     *
     * @param mixed $mediaId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMediaId($mediaId = null, ?string $comparison = null)
    {
        if (is_array($mediaId)) {
            $useMinMax = false;
            if (isset($mediaId['min'])) {
                $this->addUsingAlias(MediaFilesTableMap::COL_MEDIA_ID, $mediaId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($mediaId['max'])) {
                $this->addUsingAlias(MediaFilesTableMap::COL_MEDIA_ID, $mediaId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MediaFilesTableMap::COL_MEDIA_ID, $mediaId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the media_name column
     *
     * Example usage:
     * <code>
     * $query->filterByMediaName('fooValue');   // WHERE media_name = 'fooValue'
     * $query->filterByMediaName('%fooValue%', Criteria::LIKE); // WHERE media_name LIKE '%fooValue%'
     * $query->filterByMediaName(['foo', 'bar']); // WHERE media_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $mediaName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMediaName($mediaName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($mediaName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MediaFilesTableMap::COL_MEDIA_NAME, $mediaName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the media_mime column
     *
     * Example usage:
     * <code>
     * $query->filterByMediaMime('fooValue');   // WHERE media_mime = 'fooValue'
     * $query->filterByMediaMime('%fooValue%', Criteria::LIKE); // WHERE media_mime LIKE '%fooValue%'
     * $query->filterByMediaMime(['foo', 'bar']); // WHERE media_mime IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $mediaMime The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMediaMime($mediaMime = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($mediaMime)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MediaFilesTableMap::COL_MEDIA_MIME, $mediaMime, $comparison);

        return $this;
    }

    /**
     * Filter the query on the media_data column
     *
     * Example usage:
     * <code>
     * $query->filterByMediaData('fooValue');   // WHERE media_data = 'fooValue'
     * $query->filterByMediaData('%fooValue%', Criteria::LIKE); // WHERE media_data LIKE '%fooValue%'
     * $query->filterByMediaData(['foo', 'bar']); // WHERE media_data IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $mediaData The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMediaData($mediaData = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($mediaData)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MediaFilesTableMap::COL_MEDIA_DATA, $mediaData, $comparison);

        return $this;
    }

    /**
     * Filter the query on the folder_id column
     *
     * Example usage:
     * <code>
     * $query->filterByFolderId(1234); // WHERE folder_id = 1234
     * $query->filterByFolderId(array(12, 34)); // WHERE folder_id IN (12, 34)
     * $query->filterByFolderId(array('min' => 12)); // WHERE folder_id > 12
     * </code>
     *
     * @see       filterByMediaFolders()
     *
     * @param mixed $folderId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFolderId($folderId = null, ?string $comparison = null)
    {
        if (is_array($folderId)) {
            $useMinMax = false;
            if (isset($folderId['min'])) {
                $this->addUsingAlias(MediaFilesTableMap::COL_FOLDER_ID, $folderId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($folderId['max'])) {
                $this->addUsingAlias(MediaFilesTableMap::COL_FOLDER_ID, $folderId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MediaFilesTableMap::COL_FOLDER_ID, $folderId, $comparison);

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
                $this->addUsingAlias(MediaFilesTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(MediaFilesTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MediaFilesTableMap::COL_COMPANY_ID, $companyId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the iss3file column
     *
     * Example usage:
     * <code>
     * $query->filterByIss3file(true); // WHERE iss3file = true
     * $query->filterByIss3file('yes'); // WHERE iss3file = true
     * </code>
     *
     * @param bool|string $iss3file The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIss3file($iss3file = null, ?string $comparison = null)
    {
        if (is_string($iss3file)) {
            $iss3file = in_array(strtolower($iss3file), array('false', 'off', '-', 'no', 'n', '0', ''), true) ? false : true;
        }

        $this->addUsingAlias(MediaFilesTableMap::COL_ISS3FILE, $iss3file, $comparison);

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
                ->addUsingAlias(MediaFilesTableMap::COL_COMPANY_ID, $company->getCompanyId(), $comparison);
        } elseif ($company instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(MediaFilesTableMap::COL_COMPANY_ID, $company->toKeyValue('PrimaryKey', 'CompanyId'), $comparison);

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
     * Filter the query by a related \entities\MediaFolders object
     *
     * @param \entities\MediaFolders|ObjectCollection $mediaFolders The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMediaFolders($mediaFolders, ?string $comparison = null)
    {
        if ($mediaFolders instanceof \entities\MediaFolders) {
            return $this
                ->addUsingAlias(MediaFilesTableMap::COL_FOLDER_ID, $mediaFolders->getFolderId(), $comparison);
        } elseif ($mediaFolders instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(MediaFilesTableMap::COL_FOLDER_ID, $mediaFolders->toKeyValue('PrimaryKey', 'FolderId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByMediaFolders() only accepts arguments of type \entities\MediaFolders or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the MediaFolders relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinMediaFolders(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('MediaFolders');

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
            $this->addJoinObject($join, 'MediaFolders');
        }

        return $this;
    }

    /**
     * Use the MediaFolders relation MediaFolders object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\MediaFoldersQuery A secondary query class using the current class as primary query
     */
    public function useMediaFoldersQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinMediaFolders($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'MediaFolders', '\entities\MediaFoldersQuery');
    }

    /**
     * Use the MediaFolders relation MediaFolders object
     *
     * @param callable(\entities\MediaFoldersQuery):\entities\MediaFoldersQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withMediaFoldersQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useMediaFoldersQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to MediaFolders table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\MediaFoldersQuery The inner query object of the EXISTS statement
     */
    public function useMediaFoldersExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\MediaFoldersQuery */
        $q = $this->useExistsQuery('MediaFolders', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to MediaFolders table for a NOT EXISTS query.
     *
     * @see useMediaFoldersExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\MediaFoldersQuery The inner query object of the NOT EXISTS statement
     */
    public function useMediaFoldersNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\MediaFoldersQuery */
        $q = $this->useExistsQuery('MediaFolders', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to MediaFolders table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\MediaFoldersQuery The inner query object of the IN statement
     */
    public function useInMediaFoldersQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\MediaFoldersQuery */
        $q = $this->useInQuery('MediaFolders', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to MediaFolders table for a NOT IN query.
     *
     * @see useMediaFoldersInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\MediaFoldersQuery The inner query object of the NOT IN statement
     */
    public function useNotInMediaFoldersQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\MediaFoldersQuery */
        $q = $this->useInQuery('MediaFolders', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\Agendatypes object
     *
     * @param \entities\Agendatypes|ObjectCollection $agendatypes the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAgendatypes($agendatypes, ?string $comparison = null)
    {
        if ($agendatypes instanceof \entities\Agendatypes) {
            $this
                ->addUsingAlias(MediaFilesTableMap::COL_MEDIA_ID, $agendatypes->getAgendaimage(), $comparison);

            return $this;
        } elseif ($agendatypes instanceof ObjectCollection) {
            $this
                ->useAgendatypesQuery()
                ->filterByPrimaryKeys($agendatypes->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByAgendatypes() only accepts arguments of type \entities\Agendatypes or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Agendatypes relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinAgendatypes(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Agendatypes');

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
            $this->addJoinObject($join, 'Agendatypes');
        }

        return $this;
    }

    /**
     * Use the Agendatypes relation Agendatypes object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\AgendatypesQuery A secondary query class using the current class as primary query
     */
    public function useAgendatypesQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinAgendatypes($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Agendatypes', '\entities\AgendatypesQuery');
    }

    /**
     * Use the Agendatypes relation Agendatypes object
     *
     * @param callable(\entities\AgendatypesQuery):\entities\AgendatypesQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withAgendatypesQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useAgendatypesQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Agendatypes table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\AgendatypesQuery The inner query object of the EXISTS statement
     */
    public function useAgendatypesExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\AgendatypesQuery */
        $q = $this->useExistsQuery('Agendatypes', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Agendatypes table for a NOT EXISTS query.
     *
     * @see useAgendatypesExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\AgendatypesQuery The inner query object of the NOT EXISTS statement
     */
    public function useAgendatypesNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\AgendatypesQuery */
        $q = $this->useExistsQuery('Agendatypes', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Agendatypes table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\AgendatypesQuery The inner query object of the IN statement
     */
    public function useInAgendatypesQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\AgendatypesQuery */
        $q = $this->useInQuery('Agendatypes', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Agendatypes table for a NOT IN query.
     *
     * @see useAgendatypesInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\AgendatypesQuery The inner query object of the NOT IN statement
     */
    public function useNotInAgendatypesQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\AgendatypesQuery */
        $q = $this->useInQuery('Agendatypes', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\CheckInMedia object
     *
     * @param \entities\CheckInMedia|ObjectCollection $checkInMedia the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCheckInMedia($checkInMedia, ?string $comparison = null)
    {
        if ($checkInMedia instanceof \entities\CheckInMedia) {
            $this
                ->addUsingAlias(MediaFilesTableMap::COL_MEDIA_ID, $checkInMedia->getMediaId(), $comparison);

            return $this;
        } elseif ($checkInMedia instanceof ObjectCollection) {
            $this
                ->useCheckInMediaQuery()
                ->filterByPrimaryKeys($checkInMedia->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByCheckInMedia() only accepts arguments of type \entities\CheckInMedia or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CheckInMedia relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinCheckInMedia(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CheckInMedia');

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
            $this->addJoinObject($join, 'CheckInMedia');
        }

        return $this;
    }

    /**
     * Use the CheckInMedia relation CheckInMedia object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\CheckInMediaQuery A secondary query class using the current class as primary query
     */
    public function useCheckInMediaQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCheckInMedia($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CheckInMedia', '\entities\CheckInMediaQuery');
    }

    /**
     * Use the CheckInMedia relation CheckInMedia object
     *
     * @param callable(\entities\CheckInMediaQuery):\entities\CheckInMediaQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withCheckInMediaQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useCheckInMediaQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to CheckInMedia table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\CheckInMediaQuery The inner query object of the EXISTS statement
     */
    public function useCheckInMediaExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\CheckInMediaQuery */
        $q = $this->useExistsQuery('CheckInMedia', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to CheckInMedia table for a NOT EXISTS query.
     *
     * @see useCheckInMediaExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\CheckInMediaQuery The inner query object of the NOT EXISTS statement
     */
    public function useCheckInMediaNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\CheckInMediaQuery */
        $q = $this->useExistsQuery('CheckInMedia', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to CheckInMedia table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\CheckInMediaQuery The inner query object of the IN statement
     */
    public function useInCheckInMediaQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\CheckInMediaQuery */
        $q = $this->useInQuery('CheckInMedia', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to CheckInMedia table for a NOT IN query.
     *
     * @see useCheckInMediaInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\CheckInMediaQuery The inner query object of the NOT IN statement
     */
    public function useNotInCheckInMediaQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\CheckInMediaQuery */
        $q = $this->useInQuery('CheckInMedia', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\Gifts object
     *
     * @param \entities\Gifts|ObjectCollection $gifts the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByGifts($gifts, ?string $comparison = null)
    {
        if ($gifts instanceof \entities\Gifts) {
            $this
                ->addUsingAlias(MediaFilesTableMap::COL_MEDIA_ID, $gifts->getMediaId(), $comparison);

            return $this;
        } elseif ($gifts instanceof ObjectCollection) {
            $this
                ->useGiftsQuery()
                ->filterByPrimaryKeys($gifts->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByGifts() only accepts arguments of type \entities\Gifts or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Gifts relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinGifts(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Gifts');

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
            $this->addJoinObject($join, 'Gifts');
        }

        return $this;
    }

    /**
     * Use the Gifts relation Gifts object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\GiftsQuery A secondary query class using the current class as primary query
     */
    public function useGiftsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinGifts($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Gifts', '\entities\GiftsQuery');
    }

    /**
     * Use the Gifts relation Gifts object
     *
     * @param callable(\entities\GiftsQuery):\entities\GiftsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withGiftsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useGiftsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Gifts table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\GiftsQuery The inner query object of the EXISTS statement
     */
    public function useGiftsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\GiftsQuery */
        $q = $this->useExistsQuery('Gifts', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Gifts table for a NOT EXISTS query.
     *
     * @see useGiftsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\GiftsQuery The inner query object of the NOT EXISTS statement
     */
    public function useGiftsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\GiftsQuery */
        $q = $this->useExistsQuery('Gifts', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Gifts table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\GiftsQuery The inner query object of the IN statement
     */
    public function useInGiftsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\GiftsQuery */
        $q = $this->useInQuery('Gifts', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Gifts table for a NOT IN query.
     *
     * @see useGiftsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\GiftsQuery The inner query object of the NOT IN statement
     */
    public function useNotInGiftsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\GiftsQuery */
        $q = $this->useInQuery('Gifts', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(MediaFilesTableMap::COL_MEDIA_ID, $offers->getMediaId(), $comparison);

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
     * Filter the query by a related \entities\OutletType object
     *
     * @param \entities\OutletType|ObjectCollection $outletType the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletType($outletType, ?string $comparison = null)
    {
        if ($outletType instanceof \entities\OutletType) {
            $this
                ->addUsingAlias(MediaFilesTableMap::COL_MEDIA_ID, $outletType->getImageMediaId(), $comparison);

            return $this;
        } elseif ($outletType instanceof ObjectCollection) {
            $this
                ->useOutletTypeQuery()
                ->filterByPrimaryKeys($outletType->getPrimaryKeys())
                ->endUse();

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
     * Exclude object from result
     *
     * @param ChildMediaFiles $mediaFiles Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($mediaFiles = null)
    {
        if ($mediaFiles) {
            $this->addUsingAlias(MediaFilesTableMap::COL_MEDIA_ID, $mediaFiles->getMediaId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the media_files table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(MediaFilesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            MediaFilesTableMap::clearInstancePool();
            MediaFilesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(MediaFilesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(MediaFilesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            MediaFilesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            MediaFilesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
