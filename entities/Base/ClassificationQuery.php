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
use entities\Classification as ChildClassification;
use entities\ClassificationQuery as ChildClassificationQuery;
use entities\Map\ClassificationTableMap;

/**
 * Base class that represents a query for the `classification` table.
 *
 * @method     ChildClassificationQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildClassificationQuery orderByClassification($order = Criteria::ASC) Order by the classification column
 * @method     ChildClassificationQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildClassificationQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildClassificationQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildClassificationQuery orderByOrgunitid($order = Criteria::ASC) Order by the orgunitid column
 *
 * @method     ChildClassificationQuery groupById() Group by the id column
 * @method     ChildClassificationQuery groupByClassification() Group by the classification column
 * @method     ChildClassificationQuery groupByCompanyId() Group by the company_id column
 * @method     ChildClassificationQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildClassificationQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildClassificationQuery groupByOrgunitid() Group by the orgunitid column
 *
 * @method     ChildClassificationQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildClassificationQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildClassificationQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildClassificationQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildClassificationQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildClassificationQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildClassificationQuery leftJoinOrgUnit($relationAlias = null) Adds a LEFT JOIN clause to the query using the OrgUnit relation
 * @method     ChildClassificationQuery rightJoinOrgUnit($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OrgUnit relation
 * @method     ChildClassificationQuery innerJoinOrgUnit($relationAlias = null) Adds a INNER JOIN clause to the query using the OrgUnit relation
 *
 * @method     ChildClassificationQuery joinWithOrgUnit($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OrgUnit relation
 *
 * @method     ChildClassificationQuery leftJoinWithOrgUnit() Adds a LEFT JOIN clause and with to the query using the OrgUnit relation
 * @method     ChildClassificationQuery rightJoinWithOrgUnit() Adds a RIGHT JOIN clause and with to the query using the OrgUnit relation
 * @method     ChildClassificationQuery innerJoinWithOrgUnit() Adds a INNER JOIN clause and with to the query using the OrgUnit relation
 *
 * @method     ChildClassificationQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildClassificationQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildClassificationQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildClassificationQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildClassificationQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildClassificationQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildClassificationQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     ChildClassificationQuery leftJoinBrandCampiagnClassification($relationAlias = null) Adds a LEFT JOIN clause to the query using the BrandCampiagnClassification relation
 * @method     ChildClassificationQuery rightJoinBrandCampiagnClassification($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BrandCampiagnClassification relation
 * @method     ChildClassificationQuery innerJoinBrandCampiagnClassification($relationAlias = null) Adds a INNER JOIN clause to the query using the BrandCampiagnClassification relation
 *
 * @method     ChildClassificationQuery joinWithBrandCampiagnClassification($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BrandCampiagnClassification relation
 *
 * @method     ChildClassificationQuery leftJoinWithBrandCampiagnClassification() Adds a LEFT JOIN clause and with to the query using the BrandCampiagnClassification relation
 * @method     ChildClassificationQuery rightJoinWithBrandCampiagnClassification() Adds a RIGHT JOIN clause and with to the query using the BrandCampiagnClassification relation
 * @method     ChildClassificationQuery innerJoinWithBrandCampiagnClassification() Adds a INNER JOIN clause and with to the query using the BrandCampiagnClassification relation
 *
 * @method     ChildClassificationQuery leftJoinBrandCampiagnDoctors($relationAlias = null) Adds a LEFT JOIN clause to the query using the BrandCampiagnDoctors relation
 * @method     ChildClassificationQuery rightJoinBrandCampiagnDoctors($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BrandCampiagnDoctors relation
 * @method     ChildClassificationQuery innerJoinBrandCampiagnDoctors($relationAlias = null) Adds a INNER JOIN clause to the query using the BrandCampiagnDoctors relation
 *
 * @method     ChildClassificationQuery joinWithBrandCampiagnDoctors($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BrandCampiagnDoctors relation
 *
 * @method     ChildClassificationQuery leftJoinWithBrandCampiagnDoctors() Adds a LEFT JOIN clause and with to the query using the BrandCampiagnDoctors relation
 * @method     ChildClassificationQuery rightJoinWithBrandCampiagnDoctors() Adds a RIGHT JOIN clause and with to the query using the BrandCampiagnDoctors relation
 * @method     ChildClassificationQuery innerJoinWithBrandCampiagnDoctors() Adds a INNER JOIN clause and with to the query using the BrandCampiagnDoctors relation
 *
 * @method     ChildClassificationQuery leftJoinOnBoardRequestAddress($relationAlias = null) Adds a LEFT JOIN clause to the query using the OnBoardRequestAddress relation
 * @method     ChildClassificationQuery rightJoinOnBoardRequestAddress($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OnBoardRequestAddress relation
 * @method     ChildClassificationQuery innerJoinOnBoardRequestAddress($relationAlias = null) Adds a INNER JOIN clause to the query using the OnBoardRequestAddress relation
 *
 * @method     ChildClassificationQuery joinWithOnBoardRequestAddress($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OnBoardRequestAddress relation
 *
 * @method     ChildClassificationQuery leftJoinWithOnBoardRequestAddress() Adds a LEFT JOIN clause and with to the query using the OnBoardRequestAddress relation
 * @method     ChildClassificationQuery rightJoinWithOnBoardRequestAddress() Adds a RIGHT JOIN clause and with to the query using the OnBoardRequestAddress relation
 * @method     ChildClassificationQuery innerJoinWithOnBoardRequestAddress() Adds a INNER JOIN clause and with to the query using the OnBoardRequestAddress relation
 *
 * @method     ChildClassificationQuery leftJoinOutlets($relationAlias = null) Adds a LEFT JOIN clause to the query using the Outlets relation
 * @method     ChildClassificationQuery rightJoinOutlets($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Outlets relation
 * @method     ChildClassificationQuery innerJoinOutlets($relationAlias = null) Adds a INNER JOIN clause to the query using the Outlets relation
 *
 * @method     ChildClassificationQuery joinWithOutlets($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Outlets relation
 *
 * @method     ChildClassificationQuery leftJoinWithOutlets() Adds a LEFT JOIN clause and with to the query using the Outlets relation
 * @method     ChildClassificationQuery rightJoinWithOutlets() Adds a RIGHT JOIN clause and with to the query using the Outlets relation
 * @method     ChildClassificationQuery innerJoinWithOutlets() Adds a INNER JOIN clause and with to the query using the Outlets relation
 *
 * @method     \entities\OrgUnitQuery|\entities\CompanyQuery|\entities\BrandCampiagnClassificationQuery|\entities\BrandCampiagnDoctorsQuery|\entities\OnBoardRequestAddressQuery|\entities\OutletsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildClassification|null findOne(?ConnectionInterface $con = null) Return the first ChildClassification matching the query
 * @method     ChildClassification findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildClassification matching the query, or a new ChildClassification object populated from the query conditions when no match is found
 *
 * @method     ChildClassification|null findOneById(int $id) Return the first ChildClassification filtered by the id column
 * @method     ChildClassification|null findOneByClassification(string $classification) Return the first ChildClassification filtered by the classification column
 * @method     ChildClassification|null findOneByCompanyId(int $company_id) Return the first ChildClassification filtered by the company_id column
 * @method     ChildClassification|null findOneByCreatedAt(string $created_at) Return the first ChildClassification filtered by the created_at column
 * @method     ChildClassification|null findOneByUpdatedAt(string $updated_at) Return the first ChildClassification filtered by the updated_at column
 * @method     ChildClassification|null findOneByOrgunitid(int $orgunitid) Return the first ChildClassification filtered by the orgunitid column
 *
 * @method     ChildClassification requirePk($key, ?ConnectionInterface $con = null) Return the ChildClassification by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildClassification requireOne(?ConnectionInterface $con = null) Return the first ChildClassification matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildClassification requireOneById(int $id) Return the first ChildClassification filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildClassification requireOneByClassification(string $classification) Return the first ChildClassification filtered by the classification column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildClassification requireOneByCompanyId(int $company_id) Return the first ChildClassification filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildClassification requireOneByCreatedAt(string $created_at) Return the first ChildClassification filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildClassification requireOneByUpdatedAt(string $updated_at) Return the first ChildClassification filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildClassification requireOneByOrgunitid(int $orgunitid) Return the first ChildClassification filtered by the orgunitid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildClassification[]|Collection find(?ConnectionInterface $con = null) Return ChildClassification objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildClassification> find(?ConnectionInterface $con = null) Return ChildClassification objects based on current ModelCriteria
 *
 * @method     ChildClassification[]|Collection findById(int|array<int> $id) Return ChildClassification objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildClassification> findById(int|array<int> $id) Return ChildClassification objects filtered by the id column
 * @method     ChildClassification[]|Collection findByClassification(string|array<string> $classification) Return ChildClassification objects filtered by the classification column
 * @psalm-method Collection&\Traversable<ChildClassification> findByClassification(string|array<string> $classification) Return ChildClassification objects filtered by the classification column
 * @method     ChildClassification[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildClassification objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildClassification> findByCompanyId(int|array<int> $company_id) Return ChildClassification objects filtered by the company_id column
 * @method     ChildClassification[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildClassification objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildClassification> findByCreatedAt(string|array<string> $created_at) Return ChildClassification objects filtered by the created_at column
 * @method     ChildClassification[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildClassification objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildClassification> findByUpdatedAt(string|array<string> $updated_at) Return ChildClassification objects filtered by the updated_at column
 * @method     ChildClassification[]|Collection findByOrgunitid(int|array<int> $orgunitid) Return ChildClassification objects filtered by the orgunitid column
 * @psalm-method Collection&\Traversable<ChildClassification> findByOrgunitid(int|array<int> $orgunitid) Return ChildClassification objects filtered by the orgunitid column
 *
 * @method     ChildClassification[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildClassification> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class ClassificationQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\ClassificationQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\Classification', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildClassificationQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildClassificationQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildClassificationQuery) {
            return $criteria;
        }
        $query = new ChildClassificationQuery();
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
     * @return ChildClassification|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ClassificationTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ClassificationTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildClassification A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, classification, company_id, created_at, updated_at, orgunitid FROM classification WHERE id = :p0';
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
            /** @var ChildClassification $obj */
            $obj = new ChildClassification();
            $obj->hydrate($row);
            ClassificationTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildClassification|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(ClassificationTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(ClassificationTableMap::COL_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(ClassificationTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ClassificationTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ClassificationTableMap::COL_ID, $id, $comparison);

        return $this;
    }

    /**
     * Filter the query on the classification column
     *
     * Example usage:
     * <code>
     * $query->filterByClassification('fooValue');   // WHERE classification = 'fooValue'
     * $query->filterByClassification('%fooValue%', Criteria::LIKE); // WHERE classification LIKE '%fooValue%'
     * $query->filterByClassification(['foo', 'bar']); // WHERE classification IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $classification The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByClassification($classification = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($classification)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ClassificationTableMap::COL_CLASSIFICATION, $classification, $comparison);

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
                $this->addUsingAlias(ClassificationTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(ClassificationTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ClassificationTableMap::COL_COMPANY_ID, $companyId, $comparison);

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
                $this->addUsingAlias(ClassificationTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(ClassificationTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ClassificationTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(ClassificationTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(ClassificationTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ClassificationTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the orgunitid column
     *
     * Example usage:
     * <code>
     * $query->filterByOrgunitid(1234); // WHERE orgunitid = 1234
     * $query->filterByOrgunitid(array(12, 34)); // WHERE orgunitid IN (12, 34)
     * $query->filterByOrgunitid(array('min' => 12)); // WHERE orgunitid > 12
     * </code>
     *
     * @see       filterByOrgUnit()
     *
     * @param mixed $orgunitid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrgunitid($orgunitid = null, ?string $comparison = null)
    {
        if (is_array($orgunitid)) {
            $useMinMax = false;
            if (isset($orgunitid['min'])) {
                $this->addUsingAlias(ClassificationTableMap::COL_ORGUNITID, $orgunitid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($orgunitid['max'])) {
                $this->addUsingAlias(ClassificationTableMap::COL_ORGUNITID, $orgunitid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ClassificationTableMap::COL_ORGUNITID, $orgunitid, $comparison);

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
                ->addUsingAlias(ClassificationTableMap::COL_ORGUNITID, $orgUnit->getOrgunitid(), $comparison);
        } elseif ($orgUnit instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(ClassificationTableMap::COL_ORGUNITID, $orgUnit->toKeyValue('PrimaryKey', 'Orgunitid'), $comparison);

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
                ->addUsingAlias(ClassificationTableMap::COL_COMPANY_ID, $company->getCompanyId(), $comparison);
        } elseif ($company instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(ClassificationTableMap::COL_COMPANY_ID, $company->toKeyValue('PrimaryKey', 'CompanyId'), $comparison);

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
                ->addUsingAlias(ClassificationTableMap::COL_ID, $brandCampiagnClassification->getClassificationId(), $comparison);

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
                ->addUsingAlias(ClassificationTableMap::COL_ID, $brandCampiagnDoctors->getClassificationId(), $comparison);

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
                ->addUsingAlias(ClassificationTableMap::COL_ID, $onBoardRequestAddress->getSpeciality(), $comparison);

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
                ->addUsingAlias(ClassificationTableMap::COL_ID, $outlets->getOutletClassification(), $comparison);

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
     * Exclude object from result
     *
     * @param ChildClassification $classification Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($classification = null)
    {
        if ($classification) {
            $this->addUsingAlias(ClassificationTableMap::COL_ID, $classification->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the classification table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ClassificationTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ClassificationTableMap::clearInstancePool();
            ClassificationTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ClassificationTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ClassificationTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ClassificationTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ClassificationTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
