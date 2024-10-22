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
use entities\Material as ChildMaterial;
use entities\MaterialQuery as ChildMaterialQuery;
use entities\Map\MaterialTableMap;

/**
 * Base class that represents a query for the `material` table.
 *
 * @method     ChildMaterialQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildMaterialQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildMaterialQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ChildMaterialQuery orderByUrl($order = Criteria::ASC) Order by the url column
 * @method     ChildMaterialQuery orderByMediaId($order = Criteria::ASC) Order by the media_id column
 * @method     ChildMaterialQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildMaterialQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildMaterialQuery orderByOrgunitids($order = Criteria::ASC) Order by the orgunitids column
 * @method     ChildMaterialQuery orderByDesignations($order = Criteria::ASC) Order by the designations column
 * @method     ChildMaterialQuery orderByFolderId($order = Criteria::ASC) Order by the folder_id column
 * @method     ChildMaterialQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 *
 * @method     ChildMaterialQuery groupById() Group by the id column
 * @method     ChildMaterialQuery groupByName() Group by the name column
 * @method     ChildMaterialQuery groupByDescription() Group by the description column
 * @method     ChildMaterialQuery groupByUrl() Group by the url column
 * @method     ChildMaterialQuery groupByMediaId() Group by the media_id column
 * @method     ChildMaterialQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildMaterialQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildMaterialQuery groupByOrgunitids() Group by the orgunitids column
 * @method     ChildMaterialQuery groupByDesignations() Group by the designations column
 * @method     ChildMaterialQuery groupByFolderId() Group by the folder_id column
 * @method     ChildMaterialQuery groupByCompanyId() Group by the company_id column
 *
 * @method     ChildMaterialQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildMaterialQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildMaterialQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildMaterialQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildMaterialQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildMaterialQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildMaterialQuery leftJoinMaterialFolders($relationAlias = null) Adds a LEFT JOIN clause to the query using the MaterialFolders relation
 * @method     ChildMaterialQuery rightJoinMaterialFolders($relationAlias = null) Adds a RIGHT JOIN clause to the query using the MaterialFolders relation
 * @method     ChildMaterialQuery innerJoinMaterialFolders($relationAlias = null) Adds a INNER JOIN clause to the query using the MaterialFolders relation
 *
 * @method     ChildMaterialQuery joinWithMaterialFolders($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the MaterialFolders relation
 *
 * @method     ChildMaterialQuery leftJoinWithMaterialFolders() Adds a LEFT JOIN clause and with to the query using the MaterialFolders relation
 * @method     ChildMaterialQuery rightJoinWithMaterialFolders() Adds a RIGHT JOIN clause and with to the query using the MaterialFolders relation
 * @method     ChildMaterialQuery innerJoinWithMaterialFolders() Adds a INNER JOIN clause and with to the query using the MaterialFolders relation
 *
 * @method     \entities\MaterialFoldersQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildMaterial|null findOne(?ConnectionInterface $con = null) Return the first ChildMaterial matching the query
 * @method     ChildMaterial findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildMaterial matching the query, or a new ChildMaterial object populated from the query conditions when no match is found
 *
 * @method     ChildMaterial|null findOneById(int $id) Return the first ChildMaterial filtered by the id column
 * @method     ChildMaterial|null findOneByName(string $name) Return the first ChildMaterial filtered by the name column
 * @method     ChildMaterial|null findOneByDescription(string $description) Return the first ChildMaterial filtered by the description column
 * @method     ChildMaterial|null findOneByUrl(string $url) Return the first ChildMaterial filtered by the url column
 * @method     ChildMaterial|null findOneByMediaId(string $media_id) Return the first ChildMaterial filtered by the media_id column
 * @method     ChildMaterial|null findOneByCreatedAt(string $created_at) Return the first ChildMaterial filtered by the created_at column
 * @method     ChildMaterial|null findOneByUpdatedAt(string $updated_at) Return the first ChildMaterial filtered by the updated_at column
 * @method     ChildMaterial|null findOneByOrgunitids(string $orgunitids) Return the first ChildMaterial filtered by the orgunitids column
 * @method     ChildMaterial|null findOneByDesignations(string $designations) Return the first ChildMaterial filtered by the designations column
 * @method     ChildMaterial|null findOneByFolderId(int $folder_id) Return the first ChildMaterial filtered by the folder_id column
 * @method     ChildMaterial|null findOneByCompanyId(int $company_id) Return the first ChildMaterial filtered by the company_id column
 *
 * @method     ChildMaterial requirePk($key, ?ConnectionInterface $con = null) Return the ChildMaterial by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMaterial requireOne(?ConnectionInterface $con = null) Return the first ChildMaterial matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildMaterial requireOneById(int $id) Return the first ChildMaterial filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMaterial requireOneByName(string $name) Return the first ChildMaterial filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMaterial requireOneByDescription(string $description) Return the first ChildMaterial filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMaterial requireOneByUrl(string $url) Return the first ChildMaterial filtered by the url column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMaterial requireOneByMediaId(string $media_id) Return the first ChildMaterial filtered by the media_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMaterial requireOneByCreatedAt(string $created_at) Return the first ChildMaterial filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMaterial requireOneByUpdatedAt(string $updated_at) Return the first ChildMaterial filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMaterial requireOneByOrgunitids(string $orgunitids) Return the first ChildMaterial filtered by the orgunitids column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMaterial requireOneByDesignations(string $designations) Return the first ChildMaterial filtered by the designations column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMaterial requireOneByFolderId(int $folder_id) Return the first ChildMaterial filtered by the folder_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMaterial requireOneByCompanyId(int $company_id) Return the first ChildMaterial filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildMaterial[]|Collection find(?ConnectionInterface $con = null) Return ChildMaterial objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildMaterial> find(?ConnectionInterface $con = null) Return ChildMaterial objects based on current ModelCriteria
 *
 * @method     ChildMaterial[]|Collection findById(int|array<int> $id) Return ChildMaterial objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildMaterial> findById(int|array<int> $id) Return ChildMaterial objects filtered by the id column
 * @method     ChildMaterial[]|Collection findByName(string|array<string> $name) Return ChildMaterial objects filtered by the name column
 * @psalm-method Collection&\Traversable<ChildMaterial> findByName(string|array<string> $name) Return ChildMaterial objects filtered by the name column
 * @method     ChildMaterial[]|Collection findByDescription(string|array<string> $description) Return ChildMaterial objects filtered by the description column
 * @psalm-method Collection&\Traversable<ChildMaterial> findByDescription(string|array<string> $description) Return ChildMaterial objects filtered by the description column
 * @method     ChildMaterial[]|Collection findByUrl(string|array<string> $url) Return ChildMaterial objects filtered by the url column
 * @psalm-method Collection&\Traversable<ChildMaterial> findByUrl(string|array<string> $url) Return ChildMaterial objects filtered by the url column
 * @method     ChildMaterial[]|Collection findByMediaId(string|array<string> $media_id) Return ChildMaterial objects filtered by the media_id column
 * @psalm-method Collection&\Traversable<ChildMaterial> findByMediaId(string|array<string> $media_id) Return ChildMaterial objects filtered by the media_id column
 * @method     ChildMaterial[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildMaterial objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildMaterial> findByCreatedAt(string|array<string> $created_at) Return ChildMaterial objects filtered by the created_at column
 * @method     ChildMaterial[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildMaterial objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildMaterial> findByUpdatedAt(string|array<string> $updated_at) Return ChildMaterial objects filtered by the updated_at column
 * @method     ChildMaterial[]|Collection findByOrgunitids(string|array<string> $orgunitids) Return ChildMaterial objects filtered by the orgunitids column
 * @psalm-method Collection&\Traversable<ChildMaterial> findByOrgunitids(string|array<string> $orgunitids) Return ChildMaterial objects filtered by the orgunitids column
 * @method     ChildMaterial[]|Collection findByDesignations(string|array<string> $designations) Return ChildMaterial objects filtered by the designations column
 * @psalm-method Collection&\Traversable<ChildMaterial> findByDesignations(string|array<string> $designations) Return ChildMaterial objects filtered by the designations column
 * @method     ChildMaterial[]|Collection findByFolderId(int|array<int> $folder_id) Return ChildMaterial objects filtered by the folder_id column
 * @psalm-method Collection&\Traversable<ChildMaterial> findByFolderId(int|array<int> $folder_id) Return ChildMaterial objects filtered by the folder_id column
 * @method     ChildMaterial[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildMaterial objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildMaterial> findByCompanyId(int|array<int> $company_id) Return ChildMaterial objects filtered by the company_id column
 *
 * @method     ChildMaterial[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildMaterial> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class MaterialQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\MaterialQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\Material', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildMaterialQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildMaterialQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildMaterialQuery) {
            return $criteria;
        }
        $query = new ChildMaterialQuery();
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
     * @return ChildMaterial|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(MaterialTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = MaterialTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildMaterial A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, name, description, url, media_id, created_at, updated_at, orgunitids, designations, folder_id, company_id FROM material WHERE id = :p0';
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
            /** @var ChildMaterial $obj */
            $obj = new ChildMaterial();
            $obj->hydrate($row);
            MaterialTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildMaterial|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(MaterialTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(MaterialTableMap::COL_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterById($id = null, ?string $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(MaterialTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(MaterialTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MaterialTableMap::COL_ID, $id, $comparison);

        return $this;
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%', Criteria::LIKE); // WHERE name LIKE '%fooValue%'
     * $query->filterByName(['foo', 'bar']); // WHERE name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $name The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByName($name = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MaterialTableMap::COL_NAME, $name, $comparison);

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

        $this->addUsingAlias(MaterialTableMap::COL_DESCRIPTION, $description, $comparison);

        return $this;
    }

    /**
     * Filter the query on the url column
     *
     * Example usage:
     * <code>
     * $query->filterByUrl('fooValue');   // WHERE url = 'fooValue'
     * $query->filterByUrl('%fooValue%', Criteria::LIKE); // WHERE url LIKE '%fooValue%'
     * $query->filterByUrl(['foo', 'bar']); // WHERE url IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $url The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUrl($url = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($url)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MaterialTableMap::COL_URL, $url, $comparison);

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

        $this->addUsingAlias(MaterialTableMap::COL_MEDIA_ID, $mediaId, $comparison);

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
                $this->addUsingAlias(MaterialTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(MaterialTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MaterialTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(MaterialTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(MaterialTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MaterialTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the orgunitids column
     *
     * Example usage:
     * <code>
     * $query->filterByOrgunitids('fooValue');   // WHERE orgunitids = 'fooValue'
     * $query->filterByOrgunitids('%fooValue%', Criteria::LIKE); // WHERE orgunitids LIKE '%fooValue%'
     * $query->filterByOrgunitids(['foo', 'bar']); // WHERE orgunitids IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $orgunitids The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrgunitids($orgunitids = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($orgunitids)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MaterialTableMap::COL_ORGUNITIDS, $orgunitids, $comparison);

        return $this;
    }

    /**
     * Filter the query on the designations column
     *
     * Example usage:
     * <code>
     * $query->filterByDesignations('fooValue');   // WHERE designations = 'fooValue'
     * $query->filterByDesignations('%fooValue%', Criteria::LIKE); // WHERE designations LIKE '%fooValue%'
     * $query->filterByDesignations(['foo', 'bar']); // WHERE designations IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $designations The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDesignations($designations = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($designations)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MaterialTableMap::COL_DESIGNATIONS, $designations, $comparison);

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
     * @see       filterByMaterialFolders()
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
                $this->addUsingAlias(MaterialTableMap::COL_FOLDER_ID, $folderId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($folderId['max'])) {
                $this->addUsingAlias(MaterialTableMap::COL_FOLDER_ID, $folderId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MaterialTableMap::COL_FOLDER_ID, $folderId, $comparison);

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
                $this->addUsingAlias(MaterialTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(MaterialTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MaterialTableMap::COL_COMPANY_ID, $companyId, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \entities\MaterialFolders object
     *
     * @param \entities\MaterialFolders|ObjectCollection $materialFolders The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMaterialFolders($materialFolders, ?string $comparison = null)
    {
        if ($materialFolders instanceof \entities\MaterialFolders) {
            return $this
                ->addUsingAlias(MaterialTableMap::COL_FOLDER_ID, $materialFolders->getFolderId(), $comparison);
        } elseif ($materialFolders instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(MaterialTableMap::COL_FOLDER_ID, $materialFolders->toKeyValue('PrimaryKey', 'FolderId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByMaterialFolders() only accepts arguments of type \entities\MaterialFolders or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the MaterialFolders relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinMaterialFolders(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('MaterialFolders');

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
            $this->addJoinObject($join, 'MaterialFolders');
        }

        return $this;
    }

    /**
     * Use the MaterialFolders relation MaterialFolders object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\MaterialFoldersQuery A secondary query class using the current class as primary query
     */
    public function useMaterialFoldersQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinMaterialFolders($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'MaterialFolders', '\entities\MaterialFoldersQuery');
    }

    /**
     * Use the MaterialFolders relation MaterialFolders object
     *
     * @param callable(\entities\MaterialFoldersQuery):\entities\MaterialFoldersQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withMaterialFoldersQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useMaterialFoldersQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to MaterialFolders table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\MaterialFoldersQuery The inner query object of the EXISTS statement
     */
    public function useMaterialFoldersExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\MaterialFoldersQuery */
        $q = $this->useExistsQuery('MaterialFolders', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to MaterialFolders table for a NOT EXISTS query.
     *
     * @see useMaterialFoldersExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\MaterialFoldersQuery The inner query object of the NOT EXISTS statement
     */
    public function useMaterialFoldersNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\MaterialFoldersQuery */
        $q = $this->useExistsQuery('MaterialFolders', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to MaterialFolders table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\MaterialFoldersQuery The inner query object of the IN statement
     */
    public function useInMaterialFoldersQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\MaterialFoldersQuery */
        $q = $this->useInQuery('MaterialFolders', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to MaterialFolders table for a NOT IN query.
     *
     * @see useMaterialFoldersInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\MaterialFoldersQuery The inner query object of the NOT IN statement
     */
    public function useNotInMaterialFoldersQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\MaterialFoldersQuery */
        $q = $this->useInQuery('MaterialFolders', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildMaterial $material Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($material = null)
    {
        if ($material) {
            $this->addUsingAlias(MaterialTableMap::COL_ID, $material->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the material table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(MaterialTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            MaterialTableMap::clearInstancePool();
            MaterialTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(MaterialTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(MaterialTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            MaterialTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            MaterialTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
