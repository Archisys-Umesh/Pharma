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
use entities\Categories as ChildCategories;
use entities\CategoriesQuery as ChildCategoriesQuery;
use entities\Map\CategoriesTableMap;

/**
 * Base class that represents a query for the `categories` table.
 *
 * @method     ChildCategoriesQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildCategoriesQuery orderByCategoryName($order = Criteria::ASC) Order by the category_name column
 * @method     ChildCategoriesQuery orderByCategoryType($order = Criteria::ASC) Order by the category_type column
 * @method     ChildCategoriesQuery orderByCategoryDescription($order = Criteria::ASC) Order by the category_description column
 * @method     ChildCategoriesQuery orderByCategoryMedia($order = Criteria::ASC) Order by the category_media column
 * @method     ChildCategoriesQuery orderByCategoryDisplayOrder($order = Criteria::ASC) Order by the category_display_order column
 * @method     ChildCategoriesQuery orderByCategoryParentId($order = Criteria::ASC) Order by the category_parent_id column
 * @method     ChildCategoriesQuery orderByCategoryCode($order = Criteria::ASC) Order by the category_code column
 * @method     ChildCategoriesQuery orderByAdditionalData($order = Criteria::ASC) Order by the additional_data column
 * @method     ChildCategoriesQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildCategoriesQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildCategoriesQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildCategoriesQuery orderByOrgunitId($order = Criteria::ASC) Order by the orgunit_id column
 *
 * @method     ChildCategoriesQuery groupById() Group by the id column
 * @method     ChildCategoriesQuery groupByCategoryName() Group by the category_name column
 * @method     ChildCategoriesQuery groupByCategoryType() Group by the category_type column
 * @method     ChildCategoriesQuery groupByCategoryDescription() Group by the category_description column
 * @method     ChildCategoriesQuery groupByCategoryMedia() Group by the category_media column
 * @method     ChildCategoriesQuery groupByCategoryDisplayOrder() Group by the category_display_order column
 * @method     ChildCategoriesQuery groupByCategoryParentId() Group by the category_parent_id column
 * @method     ChildCategoriesQuery groupByCategoryCode() Group by the category_code column
 * @method     ChildCategoriesQuery groupByAdditionalData() Group by the additional_data column
 * @method     ChildCategoriesQuery groupByCompanyId() Group by the company_id column
 * @method     ChildCategoriesQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildCategoriesQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildCategoriesQuery groupByOrgunitId() Group by the orgunit_id column
 *
 * @method     ChildCategoriesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCategoriesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCategoriesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCategoriesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildCategoriesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildCategoriesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildCategoriesQuery leftJoinOrgUnit($relationAlias = null) Adds a LEFT JOIN clause to the query using the OrgUnit relation
 * @method     ChildCategoriesQuery rightJoinOrgUnit($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OrgUnit relation
 * @method     ChildCategoriesQuery innerJoinOrgUnit($relationAlias = null) Adds a INNER JOIN clause to the query using the OrgUnit relation
 *
 * @method     ChildCategoriesQuery joinWithOrgUnit($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OrgUnit relation
 *
 * @method     ChildCategoriesQuery leftJoinWithOrgUnit() Adds a LEFT JOIN clause and with to the query using the OrgUnit relation
 * @method     ChildCategoriesQuery rightJoinWithOrgUnit() Adds a RIGHT JOIN clause and with to the query using the OrgUnit relation
 * @method     ChildCategoriesQuery innerJoinWithOrgUnit() Adds a INNER JOIN clause and with to the query using the OrgUnit relation
 *
 * @method     ChildCategoriesQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildCategoriesQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildCategoriesQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildCategoriesQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildCategoriesQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildCategoriesQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildCategoriesQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     ChildCategoriesQuery leftJoinProducts($relationAlias = null) Adds a LEFT JOIN clause to the query using the Products relation
 * @method     ChildCategoriesQuery rightJoinProducts($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Products relation
 * @method     ChildCategoriesQuery innerJoinProducts($relationAlias = null) Adds a INNER JOIN clause to the query using the Products relation
 *
 * @method     ChildCategoriesQuery joinWithProducts($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Products relation
 *
 * @method     ChildCategoriesQuery leftJoinWithProducts() Adds a LEFT JOIN clause and with to the query using the Products relation
 * @method     ChildCategoriesQuery rightJoinWithProducts() Adds a RIGHT JOIN clause and with to the query using the Products relation
 * @method     ChildCategoriesQuery innerJoinWithProducts() Adds a INNER JOIN clause and with to the query using the Products relation
 *
 * @method     \entities\OrgUnitQuery|\entities\CompanyQuery|\entities\ProductsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildCategories|null findOne(?ConnectionInterface $con = null) Return the first ChildCategories matching the query
 * @method     ChildCategories findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildCategories matching the query, or a new ChildCategories object populated from the query conditions when no match is found
 *
 * @method     ChildCategories|null findOneById(int $id) Return the first ChildCategories filtered by the id column
 * @method     ChildCategories|null findOneByCategoryName(string $category_name) Return the first ChildCategories filtered by the category_name column
 * @method     ChildCategories|null findOneByCategoryType(string $category_type) Return the first ChildCategories filtered by the category_type column
 * @method     ChildCategories|null findOneByCategoryDescription(string $category_description) Return the first ChildCategories filtered by the category_description column
 * @method     ChildCategories|null findOneByCategoryMedia(string $category_media) Return the first ChildCategories filtered by the category_media column
 * @method     ChildCategories|null findOneByCategoryDisplayOrder(int $category_display_order) Return the first ChildCategories filtered by the category_display_order column
 * @method     ChildCategories|null findOneByCategoryParentId(int $category_parent_id) Return the first ChildCategories filtered by the category_parent_id column
 * @method     ChildCategories|null findOneByCategoryCode(string $category_code) Return the first ChildCategories filtered by the category_code column
 * @method     ChildCategories|null findOneByAdditionalData(string $additional_data) Return the first ChildCategories filtered by the additional_data column
 * @method     ChildCategories|null findOneByCompanyId(int $company_id) Return the first ChildCategories filtered by the company_id column
 * @method     ChildCategories|null findOneByCreatedAt(string $created_at) Return the first ChildCategories filtered by the created_at column
 * @method     ChildCategories|null findOneByUpdatedAt(string $updated_at) Return the first ChildCategories filtered by the updated_at column
 * @method     ChildCategories|null findOneByOrgunitId(int $orgunit_id) Return the first ChildCategories filtered by the orgunit_id column
 *
 * @method     ChildCategories requirePk($key, ?ConnectionInterface $con = null) Return the ChildCategories by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCategories requireOne(?ConnectionInterface $con = null) Return the first ChildCategories matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCategories requireOneById(int $id) Return the first ChildCategories filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCategories requireOneByCategoryName(string $category_name) Return the first ChildCategories filtered by the category_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCategories requireOneByCategoryType(string $category_type) Return the first ChildCategories filtered by the category_type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCategories requireOneByCategoryDescription(string $category_description) Return the first ChildCategories filtered by the category_description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCategories requireOneByCategoryMedia(string $category_media) Return the first ChildCategories filtered by the category_media column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCategories requireOneByCategoryDisplayOrder(int $category_display_order) Return the first ChildCategories filtered by the category_display_order column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCategories requireOneByCategoryParentId(int $category_parent_id) Return the first ChildCategories filtered by the category_parent_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCategories requireOneByCategoryCode(string $category_code) Return the first ChildCategories filtered by the category_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCategories requireOneByAdditionalData(string $additional_data) Return the first ChildCategories filtered by the additional_data column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCategories requireOneByCompanyId(int $company_id) Return the first ChildCategories filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCategories requireOneByCreatedAt(string $created_at) Return the first ChildCategories filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCategories requireOneByUpdatedAt(string $updated_at) Return the first ChildCategories filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCategories requireOneByOrgunitId(int $orgunit_id) Return the first ChildCategories filtered by the orgunit_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCategories[]|Collection find(?ConnectionInterface $con = null) Return ChildCategories objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildCategories> find(?ConnectionInterface $con = null) Return ChildCategories objects based on current ModelCriteria
 *
 * @method     ChildCategories[]|Collection findById(int|array<int> $id) Return ChildCategories objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildCategories> findById(int|array<int> $id) Return ChildCategories objects filtered by the id column
 * @method     ChildCategories[]|Collection findByCategoryName(string|array<string> $category_name) Return ChildCategories objects filtered by the category_name column
 * @psalm-method Collection&\Traversable<ChildCategories> findByCategoryName(string|array<string> $category_name) Return ChildCategories objects filtered by the category_name column
 * @method     ChildCategories[]|Collection findByCategoryType(string|array<string> $category_type) Return ChildCategories objects filtered by the category_type column
 * @psalm-method Collection&\Traversable<ChildCategories> findByCategoryType(string|array<string> $category_type) Return ChildCategories objects filtered by the category_type column
 * @method     ChildCategories[]|Collection findByCategoryDescription(string|array<string> $category_description) Return ChildCategories objects filtered by the category_description column
 * @psalm-method Collection&\Traversable<ChildCategories> findByCategoryDescription(string|array<string> $category_description) Return ChildCategories objects filtered by the category_description column
 * @method     ChildCategories[]|Collection findByCategoryMedia(string|array<string> $category_media) Return ChildCategories objects filtered by the category_media column
 * @psalm-method Collection&\Traversable<ChildCategories> findByCategoryMedia(string|array<string> $category_media) Return ChildCategories objects filtered by the category_media column
 * @method     ChildCategories[]|Collection findByCategoryDisplayOrder(int|array<int> $category_display_order) Return ChildCategories objects filtered by the category_display_order column
 * @psalm-method Collection&\Traversable<ChildCategories> findByCategoryDisplayOrder(int|array<int> $category_display_order) Return ChildCategories objects filtered by the category_display_order column
 * @method     ChildCategories[]|Collection findByCategoryParentId(int|array<int> $category_parent_id) Return ChildCategories objects filtered by the category_parent_id column
 * @psalm-method Collection&\Traversable<ChildCategories> findByCategoryParentId(int|array<int> $category_parent_id) Return ChildCategories objects filtered by the category_parent_id column
 * @method     ChildCategories[]|Collection findByCategoryCode(string|array<string> $category_code) Return ChildCategories objects filtered by the category_code column
 * @psalm-method Collection&\Traversable<ChildCategories> findByCategoryCode(string|array<string> $category_code) Return ChildCategories objects filtered by the category_code column
 * @method     ChildCategories[]|Collection findByAdditionalData(string|array<string> $additional_data) Return ChildCategories objects filtered by the additional_data column
 * @psalm-method Collection&\Traversable<ChildCategories> findByAdditionalData(string|array<string> $additional_data) Return ChildCategories objects filtered by the additional_data column
 * @method     ChildCategories[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildCategories objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildCategories> findByCompanyId(int|array<int> $company_id) Return ChildCategories objects filtered by the company_id column
 * @method     ChildCategories[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildCategories objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildCategories> findByCreatedAt(string|array<string> $created_at) Return ChildCategories objects filtered by the created_at column
 * @method     ChildCategories[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildCategories objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildCategories> findByUpdatedAt(string|array<string> $updated_at) Return ChildCategories objects filtered by the updated_at column
 * @method     ChildCategories[]|Collection findByOrgunitId(int|array<int> $orgunit_id) Return ChildCategories objects filtered by the orgunit_id column
 * @psalm-method Collection&\Traversable<ChildCategories> findByOrgunitId(int|array<int> $orgunit_id) Return ChildCategories objects filtered by the orgunit_id column
 *
 * @method     ChildCategories[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildCategories> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class CategoriesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\CategoriesQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\Categories', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCategoriesQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCategoriesQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildCategoriesQuery) {
            return $criteria;
        }
        $query = new ChildCategoriesQuery();
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
     * @return ChildCategories|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CategoriesTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = CategoriesTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildCategories A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, category_name, category_type, category_description, category_media, category_display_order, category_parent_id, category_code, additional_data, company_id, created_at, updated_at, orgunit_id FROM categories WHERE id = :p0';
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
            /** @var ChildCategories $obj */
            $obj = new ChildCategories();
            $obj->hydrate($row);
            CategoriesTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildCategories|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(CategoriesTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(CategoriesTableMap::COL_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(CategoriesTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(CategoriesTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CategoriesTableMap::COL_ID, $id, $comparison);

        return $this;
    }

    /**
     * Filter the query on the category_name column
     *
     * Example usage:
     * <code>
     * $query->filterByCategoryName('fooValue');   // WHERE category_name = 'fooValue'
     * $query->filterByCategoryName('%fooValue%', Criteria::LIKE); // WHERE category_name LIKE '%fooValue%'
     * $query->filterByCategoryName(['foo', 'bar']); // WHERE category_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $categoryName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCategoryName($categoryName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($categoryName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CategoriesTableMap::COL_CATEGORY_NAME, $categoryName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the category_type column
     *
     * Example usage:
     * <code>
     * $query->filterByCategoryType('fooValue');   // WHERE category_type = 'fooValue'
     * $query->filterByCategoryType('%fooValue%', Criteria::LIKE); // WHERE category_type LIKE '%fooValue%'
     * $query->filterByCategoryType(['foo', 'bar']); // WHERE category_type IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $categoryType The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCategoryType($categoryType = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($categoryType)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CategoriesTableMap::COL_CATEGORY_TYPE, $categoryType, $comparison);

        return $this;
    }

    /**
     * Filter the query on the category_description column
     *
     * Example usage:
     * <code>
     * $query->filterByCategoryDescription('fooValue');   // WHERE category_description = 'fooValue'
     * $query->filterByCategoryDescription('%fooValue%', Criteria::LIKE); // WHERE category_description LIKE '%fooValue%'
     * $query->filterByCategoryDescription(['foo', 'bar']); // WHERE category_description IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $categoryDescription The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCategoryDescription($categoryDescription = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($categoryDescription)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CategoriesTableMap::COL_CATEGORY_DESCRIPTION, $categoryDescription, $comparison);

        return $this;
    }

    /**
     * Filter the query on the category_media column
     *
     * Example usage:
     * <code>
     * $query->filterByCategoryMedia('fooValue');   // WHERE category_media = 'fooValue'
     * $query->filterByCategoryMedia('%fooValue%', Criteria::LIKE); // WHERE category_media LIKE '%fooValue%'
     * $query->filterByCategoryMedia(['foo', 'bar']); // WHERE category_media IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $categoryMedia The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCategoryMedia($categoryMedia = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($categoryMedia)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CategoriesTableMap::COL_CATEGORY_MEDIA, $categoryMedia, $comparison);

        return $this;
    }

    /**
     * Filter the query on the category_display_order column
     *
     * Example usage:
     * <code>
     * $query->filterByCategoryDisplayOrder(1234); // WHERE category_display_order = 1234
     * $query->filterByCategoryDisplayOrder(array(12, 34)); // WHERE category_display_order IN (12, 34)
     * $query->filterByCategoryDisplayOrder(array('min' => 12)); // WHERE category_display_order > 12
     * </code>
     *
     * @param mixed $categoryDisplayOrder The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCategoryDisplayOrder($categoryDisplayOrder = null, ?string $comparison = null)
    {
        if (is_array($categoryDisplayOrder)) {
            $useMinMax = false;
            if (isset($categoryDisplayOrder['min'])) {
                $this->addUsingAlias(CategoriesTableMap::COL_CATEGORY_DISPLAY_ORDER, $categoryDisplayOrder['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($categoryDisplayOrder['max'])) {
                $this->addUsingAlias(CategoriesTableMap::COL_CATEGORY_DISPLAY_ORDER, $categoryDisplayOrder['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CategoriesTableMap::COL_CATEGORY_DISPLAY_ORDER, $categoryDisplayOrder, $comparison);

        return $this;
    }

    /**
     * Filter the query on the category_parent_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCategoryParentId(1234); // WHERE category_parent_id = 1234
     * $query->filterByCategoryParentId(array(12, 34)); // WHERE category_parent_id IN (12, 34)
     * $query->filterByCategoryParentId(array('min' => 12)); // WHERE category_parent_id > 12
     * </code>
     *
     * @param mixed $categoryParentId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCategoryParentId($categoryParentId = null, ?string $comparison = null)
    {
        if (is_array($categoryParentId)) {
            $useMinMax = false;
            if (isset($categoryParentId['min'])) {
                $this->addUsingAlias(CategoriesTableMap::COL_CATEGORY_PARENT_ID, $categoryParentId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($categoryParentId['max'])) {
                $this->addUsingAlias(CategoriesTableMap::COL_CATEGORY_PARENT_ID, $categoryParentId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CategoriesTableMap::COL_CATEGORY_PARENT_ID, $categoryParentId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the category_code column
     *
     * Example usage:
     * <code>
     * $query->filterByCategoryCode('fooValue');   // WHERE category_code = 'fooValue'
     * $query->filterByCategoryCode('%fooValue%', Criteria::LIKE); // WHERE category_code LIKE '%fooValue%'
     * $query->filterByCategoryCode(['foo', 'bar']); // WHERE category_code IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $categoryCode The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCategoryCode($categoryCode = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($categoryCode)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CategoriesTableMap::COL_CATEGORY_CODE, $categoryCode, $comparison);

        return $this;
    }

    /**
     * Filter the query on the additional_data column
     *
     * Example usage:
     * <code>
     * $query->filterByAdditionalData('fooValue');   // WHERE additional_data = 'fooValue'
     * $query->filterByAdditionalData('%fooValue%', Criteria::LIKE); // WHERE additional_data LIKE '%fooValue%'
     * $query->filterByAdditionalData(['foo', 'bar']); // WHERE additional_data IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $additionalData The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAdditionalData($additionalData = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($additionalData)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CategoriesTableMap::COL_ADDITIONAL_DATA, $additionalData, $comparison);

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
                $this->addUsingAlias(CategoriesTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(CategoriesTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CategoriesTableMap::COL_COMPANY_ID, $companyId, $comparison);

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
                $this->addUsingAlias(CategoriesTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(CategoriesTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CategoriesTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(CategoriesTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(CategoriesTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CategoriesTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

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
                $this->addUsingAlias(CategoriesTableMap::COL_ORGUNIT_ID, $orgunitId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($orgunitId['max'])) {
                $this->addUsingAlias(CategoriesTableMap::COL_ORGUNIT_ID, $orgunitId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CategoriesTableMap::COL_ORGUNIT_ID, $orgunitId, $comparison);

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
                ->addUsingAlias(CategoriesTableMap::COL_ORGUNIT_ID, $orgUnit->getOrgunitid(), $comparison);
        } elseif ($orgUnit instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(CategoriesTableMap::COL_ORGUNIT_ID, $orgUnit->toKeyValue('PrimaryKey', 'Orgunitid'), $comparison);

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
                ->addUsingAlias(CategoriesTableMap::COL_COMPANY_ID, $company->getCompanyId(), $comparison);
        } elseif ($company instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(CategoriesTableMap::COL_COMPANY_ID, $company->toKeyValue('PrimaryKey', 'CompanyId'), $comparison);

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
                ->addUsingAlias(CategoriesTableMap::COL_ID, $products->getCategoryId(), $comparison);

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
     * Exclude object from result
     *
     * @param ChildCategories $categories Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($categories = null)
    {
        if ($categories) {
            $this->addUsingAlias(CategoriesTableMap::COL_ID, $categories->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the categories table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CategoriesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CategoriesTableMap::clearInstancePool();
            CategoriesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(CategoriesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CategoriesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            CategoriesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            CategoriesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
