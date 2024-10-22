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
use entities\MaterialFolders as ChildMaterialFolders;
use entities\MaterialFoldersQuery as ChildMaterialFoldersQuery;
use entities\Map\MaterialFoldersTableMap;

/**
 * Base class that represents a query for the `material_folders` table.
 *
 * @method     ChildMaterialFoldersQuery orderByFolderId($order = Criteria::ASC) Order by the folder_id column
 * @method     ChildMaterialFoldersQuery orderByFolderName($order = Criteria::ASC) Order by the folder_name column
 * @method     ChildMaterialFoldersQuery orderByFolderParentId($order = Criteria::ASC) Order by the folder_parent_id column
 * @method     ChildMaterialFoldersQuery orderByFolderIcon($order = Criteria::ASC) Order by the folder_icon column
 * @method     ChildMaterialFoldersQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildMaterialFoldersQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildMaterialFoldersQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 *
 * @method     ChildMaterialFoldersQuery groupByFolderId() Group by the folder_id column
 * @method     ChildMaterialFoldersQuery groupByFolderName() Group by the folder_name column
 * @method     ChildMaterialFoldersQuery groupByFolderParentId() Group by the folder_parent_id column
 * @method     ChildMaterialFoldersQuery groupByFolderIcon() Group by the folder_icon column
 * @method     ChildMaterialFoldersQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildMaterialFoldersQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildMaterialFoldersQuery groupByCompanyId() Group by the company_id column
 *
 * @method     ChildMaterialFoldersQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildMaterialFoldersQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildMaterialFoldersQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildMaterialFoldersQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildMaterialFoldersQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildMaterialFoldersQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildMaterialFoldersQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildMaterialFoldersQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildMaterialFoldersQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildMaterialFoldersQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildMaterialFoldersQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildMaterialFoldersQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildMaterialFoldersQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     ChildMaterialFoldersQuery leftJoinMaterial($relationAlias = null) Adds a LEFT JOIN clause to the query using the Material relation
 * @method     ChildMaterialFoldersQuery rightJoinMaterial($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Material relation
 * @method     ChildMaterialFoldersQuery innerJoinMaterial($relationAlias = null) Adds a INNER JOIN clause to the query using the Material relation
 *
 * @method     ChildMaterialFoldersQuery joinWithMaterial($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Material relation
 *
 * @method     ChildMaterialFoldersQuery leftJoinWithMaterial() Adds a LEFT JOIN clause and with to the query using the Material relation
 * @method     ChildMaterialFoldersQuery rightJoinWithMaterial() Adds a RIGHT JOIN clause and with to the query using the Material relation
 * @method     ChildMaterialFoldersQuery innerJoinWithMaterial() Adds a INNER JOIN clause and with to the query using the Material relation
 *
 * @method     \entities\CompanyQuery|\entities\MaterialQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildMaterialFolders|null findOne(?ConnectionInterface $con = null) Return the first ChildMaterialFolders matching the query
 * @method     ChildMaterialFolders findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildMaterialFolders matching the query, or a new ChildMaterialFolders object populated from the query conditions when no match is found
 *
 * @method     ChildMaterialFolders|null findOneByFolderId(int $folder_id) Return the first ChildMaterialFolders filtered by the folder_id column
 * @method     ChildMaterialFolders|null findOneByFolderName(string $folder_name) Return the first ChildMaterialFolders filtered by the folder_name column
 * @method     ChildMaterialFolders|null findOneByFolderParentId(int $folder_parent_id) Return the first ChildMaterialFolders filtered by the folder_parent_id column
 * @method     ChildMaterialFolders|null findOneByFolderIcon(int $folder_icon) Return the first ChildMaterialFolders filtered by the folder_icon column
 * @method     ChildMaterialFolders|null findOneByCreatedAt(string $created_at) Return the first ChildMaterialFolders filtered by the created_at column
 * @method     ChildMaterialFolders|null findOneByUpdatedAt(string $updated_at) Return the first ChildMaterialFolders filtered by the updated_at column
 * @method     ChildMaterialFolders|null findOneByCompanyId(int $company_id) Return the first ChildMaterialFolders filtered by the company_id column
 *
 * @method     ChildMaterialFolders requirePk($key, ?ConnectionInterface $con = null) Return the ChildMaterialFolders by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMaterialFolders requireOne(?ConnectionInterface $con = null) Return the first ChildMaterialFolders matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildMaterialFolders requireOneByFolderId(int $folder_id) Return the first ChildMaterialFolders filtered by the folder_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMaterialFolders requireOneByFolderName(string $folder_name) Return the first ChildMaterialFolders filtered by the folder_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMaterialFolders requireOneByFolderParentId(int $folder_parent_id) Return the first ChildMaterialFolders filtered by the folder_parent_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMaterialFolders requireOneByFolderIcon(int $folder_icon) Return the first ChildMaterialFolders filtered by the folder_icon column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMaterialFolders requireOneByCreatedAt(string $created_at) Return the first ChildMaterialFolders filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMaterialFolders requireOneByUpdatedAt(string $updated_at) Return the first ChildMaterialFolders filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMaterialFolders requireOneByCompanyId(int $company_id) Return the first ChildMaterialFolders filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildMaterialFolders[]|Collection find(?ConnectionInterface $con = null) Return ChildMaterialFolders objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildMaterialFolders> find(?ConnectionInterface $con = null) Return ChildMaterialFolders objects based on current ModelCriteria
 *
 * @method     ChildMaterialFolders[]|Collection findByFolderId(int|array<int> $folder_id) Return ChildMaterialFolders objects filtered by the folder_id column
 * @psalm-method Collection&\Traversable<ChildMaterialFolders> findByFolderId(int|array<int> $folder_id) Return ChildMaterialFolders objects filtered by the folder_id column
 * @method     ChildMaterialFolders[]|Collection findByFolderName(string|array<string> $folder_name) Return ChildMaterialFolders objects filtered by the folder_name column
 * @psalm-method Collection&\Traversable<ChildMaterialFolders> findByFolderName(string|array<string> $folder_name) Return ChildMaterialFolders objects filtered by the folder_name column
 * @method     ChildMaterialFolders[]|Collection findByFolderParentId(int|array<int> $folder_parent_id) Return ChildMaterialFolders objects filtered by the folder_parent_id column
 * @psalm-method Collection&\Traversable<ChildMaterialFolders> findByFolderParentId(int|array<int> $folder_parent_id) Return ChildMaterialFolders objects filtered by the folder_parent_id column
 * @method     ChildMaterialFolders[]|Collection findByFolderIcon(int|array<int> $folder_icon) Return ChildMaterialFolders objects filtered by the folder_icon column
 * @psalm-method Collection&\Traversable<ChildMaterialFolders> findByFolderIcon(int|array<int> $folder_icon) Return ChildMaterialFolders objects filtered by the folder_icon column
 * @method     ChildMaterialFolders[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildMaterialFolders objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildMaterialFolders> findByCreatedAt(string|array<string> $created_at) Return ChildMaterialFolders objects filtered by the created_at column
 * @method     ChildMaterialFolders[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildMaterialFolders objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildMaterialFolders> findByUpdatedAt(string|array<string> $updated_at) Return ChildMaterialFolders objects filtered by the updated_at column
 * @method     ChildMaterialFolders[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildMaterialFolders objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildMaterialFolders> findByCompanyId(int|array<int> $company_id) Return ChildMaterialFolders objects filtered by the company_id column
 *
 * @method     ChildMaterialFolders[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildMaterialFolders> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class MaterialFoldersQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\MaterialFoldersQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\MaterialFolders', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildMaterialFoldersQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildMaterialFoldersQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildMaterialFoldersQuery) {
            return $criteria;
        }
        $query = new ChildMaterialFoldersQuery();
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
     * @return ChildMaterialFolders|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(MaterialFoldersTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = MaterialFoldersTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildMaterialFolders A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT folder_id, folder_name, folder_parent_id, folder_icon, created_at, updated_at, company_id FROM material_folders WHERE folder_id = :p0';
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
            /** @var ChildMaterialFolders $obj */
            $obj = new ChildMaterialFolders();
            $obj->hydrate($row);
            MaterialFoldersTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildMaterialFolders|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(MaterialFoldersTableMap::COL_FOLDER_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(MaterialFoldersTableMap::COL_FOLDER_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(MaterialFoldersTableMap::COL_FOLDER_ID, $folderId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($folderId['max'])) {
                $this->addUsingAlias(MaterialFoldersTableMap::COL_FOLDER_ID, $folderId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MaterialFoldersTableMap::COL_FOLDER_ID, $folderId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the folder_name column
     *
     * Example usage:
     * <code>
     * $query->filterByFolderName('fooValue');   // WHERE folder_name = 'fooValue'
     * $query->filterByFolderName('%fooValue%', Criteria::LIKE); // WHERE folder_name LIKE '%fooValue%'
     * $query->filterByFolderName(['foo', 'bar']); // WHERE folder_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $folderName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFolderName($folderName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($folderName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MaterialFoldersTableMap::COL_FOLDER_NAME, $folderName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the folder_parent_id column
     *
     * Example usage:
     * <code>
     * $query->filterByFolderParentId(1234); // WHERE folder_parent_id = 1234
     * $query->filterByFolderParentId(array(12, 34)); // WHERE folder_parent_id IN (12, 34)
     * $query->filterByFolderParentId(array('min' => 12)); // WHERE folder_parent_id > 12
     * </code>
     *
     * @param mixed $folderParentId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFolderParentId($folderParentId = null, ?string $comparison = null)
    {
        if (is_array($folderParentId)) {
            $useMinMax = false;
            if (isset($folderParentId['min'])) {
                $this->addUsingAlias(MaterialFoldersTableMap::COL_FOLDER_PARENT_ID, $folderParentId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($folderParentId['max'])) {
                $this->addUsingAlias(MaterialFoldersTableMap::COL_FOLDER_PARENT_ID, $folderParentId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MaterialFoldersTableMap::COL_FOLDER_PARENT_ID, $folderParentId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the folder_icon column
     *
     * Example usage:
     * <code>
     * $query->filterByFolderIcon(1234); // WHERE folder_icon = 1234
     * $query->filterByFolderIcon(array(12, 34)); // WHERE folder_icon IN (12, 34)
     * $query->filterByFolderIcon(array('min' => 12)); // WHERE folder_icon > 12
     * </code>
     *
     * @param mixed $folderIcon The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFolderIcon($folderIcon = null, ?string $comparison = null)
    {
        if (is_array($folderIcon)) {
            $useMinMax = false;
            if (isset($folderIcon['min'])) {
                $this->addUsingAlias(MaterialFoldersTableMap::COL_FOLDER_ICON, $folderIcon['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($folderIcon['max'])) {
                $this->addUsingAlias(MaterialFoldersTableMap::COL_FOLDER_ICON, $folderIcon['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MaterialFoldersTableMap::COL_FOLDER_ICON, $folderIcon, $comparison);

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
                $this->addUsingAlias(MaterialFoldersTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(MaterialFoldersTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MaterialFoldersTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(MaterialFoldersTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(MaterialFoldersTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MaterialFoldersTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

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
                $this->addUsingAlias(MaterialFoldersTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(MaterialFoldersTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MaterialFoldersTableMap::COL_COMPANY_ID, $companyId, $comparison);

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
                ->addUsingAlias(MaterialFoldersTableMap::COL_COMPANY_ID, $company->getCompanyId(), $comparison);
        } elseif ($company instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(MaterialFoldersTableMap::COL_COMPANY_ID, $company->toKeyValue('PrimaryKey', 'CompanyId'), $comparison);

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
     * Filter the query by a related \entities\Material object
     *
     * @param \entities\Material|ObjectCollection $material the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMaterial($material, ?string $comparison = null)
    {
        if ($material instanceof \entities\Material) {
            $this
                ->addUsingAlias(MaterialFoldersTableMap::COL_FOLDER_ID, $material->getFolderId(), $comparison);

            return $this;
        } elseif ($material instanceof ObjectCollection) {
            $this
                ->useMaterialQuery()
                ->filterByPrimaryKeys($material->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByMaterial() only accepts arguments of type \entities\Material or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Material relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinMaterial(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Material');

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
            $this->addJoinObject($join, 'Material');
        }

        return $this;
    }

    /**
     * Use the Material relation Material object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\MaterialQuery A secondary query class using the current class as primary query
     */
    public function useMaterialQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinMaterial($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Material', '\entities\MaterialQuery');
    }

    /**
     * Use the Material relation Material object
     *
     * @param callable(\entities\MaterialQuery):\entities\MaterialQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withMaterialQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useMaterialQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Material table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\MaterialQuery The inner query object of the EXISTS statement
     */
    public function useMaterialExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\MaterialQuery */
        $q = $this->useExistsQuery('Material', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Material table for a NOT EXISTS query.
     *
     * @see useMaterialExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\MaterialQuery The inner query object of the NOT EXISTS statement
     */
    public function useMaterialNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\MaterialQuery */
        $q = $this->useExistsQuery('Material', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Material table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\MaterialQuery The inner query object of the IN statement
     */
    public function useInMaterialQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\MaterialQuery */
        $q = $this->useInQuery('Material', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Material table for a NOT IN query.
     *
     * @see useMaterialInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\MaterialQuery The inner query object of the NOT IN statement
     */
    public function useNotInMaterialQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\MaterialQuery */
        $q = $this->useInQuery('Material', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildMaterialFolders $materialFolders Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($materialFolders = null)
    {
        if ($materialFolders) {
            $this->addUsingAlias(MaterialFoldersTableMap::COL_FOLDER_ID, $materialFolders->getFolderId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the material_folders table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(MaterialFoldersTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            MaterialFoldersTableMap::clearInstancePool();
            MaterialFoldersTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(MaterialFoldersTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(MaterialFoldersTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            MaterialFoldersTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            MaterialFoldersTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
