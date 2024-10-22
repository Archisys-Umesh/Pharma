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
use entities\BrandCampiagnClassification as ChildBrandCampiagnClassification;
use entities\BrandCampiagnClassificationQuery as ChildBrandCampiagnClassificationQuery;
use entities\Map\BrandCampiagnClassificationTableMap;

/**
 * Base class that represents a query for the `brand_campiagn_classification` table.
 *
 * @method     ChildBrandCampiagnClassificationQuery orderByBrandCampiagnClassificationId($order = Criteria::ASC) Order by the brand_campiagn_classification_id column
 * @method     ChildBrandCampiagnClassificationQuery orderByClassificationId($order = Criteria::ASC) Order by the classification_id column
 * @method     ChildBrandCampiagnClassificationQuery orderByMinimum($order = Criteria::ASC) Order by the minimum column
 * @method     ChildBrandCampiagnClassificationQuery orderByMaximum($order = Criteria::ASC) Order by the maximum column
 * @method     ChildBrandCampiagnClassificationQuery orderByBrandCampiagnId($order = Criteria::ASC) Order by the brand_campiagn_id column
 * @method     ChildBrandCampiagnClassificationQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildBrandCampiagnClassificationQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildBrandCampiagnClassificationQuery orderByComment($order = Criteria::ASC) Order by the comment column
 *
 * @method     ChildBrandCampiagnClassificationQuery groupByBrandCampiagnClassificationId() Group by the brand_campiagn_classification_id column
 * @method     ChildBrandCampiagnClassificationQuery groupByClassificationId() Group by the classification_id column
 * @method     ChildBrandCampiagnClassificationQuery groupByMinimum() Group by the minimum column
 * @method     ChildBrandCampiagnClassificationQuery groupByMaximum() Group by the maximum column
 * @method     ChildBrandCampiagnClassificationQuery groupByBrandCampiagnId() Group by the brand_campiagn_id column
 * @method     ChildBrandCampiagnClassificationQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildBrandCampiagnClassificationQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildBrandCampiagnClassificationQuery groupByComment() Group by the comment column
 *
 * @method     ChildBrandCampiagnClassificationQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildBrandCampiagnClassificationQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildBrandCampiagnClassificationQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildBrandCampiagnClassificationQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildBrandCampiagnClassificationQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildBrandCampiagnClassificationQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildBrandCampiagnClassificationQuery leftJoinBrandCampiagn($relationAlias = null) Adds a LEFT JOIN clause to the query using the BrandCampiagn relation
 * @method     ChildBrandCampiagnClassificationQuery rightJoinBrandCampiagn($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BrandCampiagn relation
 * @method     ChildBrandCampiagnClassificationQuery innerJoinBrandCampiagn($relationAlias = null) Adds a INNER JOIN clause to the query using the BrandCampiagn relation
 *
 * @method     ChildBrandCampiagnClassificationQuery joinWithBrandCampiagn($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BrandCampiagn relation
 *
 * @method     ChildBrandCampiagnClassificationQuery leftJoinWithBrandCampiagn() Adds a LEFT JOIN clause and with to the query using the BrandCampiagn relation
 * @method     ChildBrandCampiagnClassificationQuery rightJoinWithBrandCampiagn() Adds a RIGHT JOIN clause and with to the query using the BrandCampiagn relation
 * @method     ChildBrandCampiagnClassificationQuery innerJoinWithBrandCampiagn() Adds a INNER JOIN clause and with to the query using the BrandCampiagn relation
 *
 * @method     ChildBrandCampiagnClassificationQuery leftJoinClassification($relationAlias = null) Adds a LEFT JOIN clause to the query using the Classification relation
 * @method     ChildBrandCampiagnClassificationQuery rightJoinClassification($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Classification relation
 * @method     ChildBrandCampiagnClassificationQuery innerJoinClassification($relationAlias = null) Adds a INNER JOIN clause to the query using the Classification relation
 *
 * @method     ChildBrandCampiagnClassificationQuery joinWithClassification($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Classification relation
 *
 * @method     ChildBrandCampiagnClassificationQuery leftJoinWithClassification() Adds a LEFT JOIN clause and with to the query using the Classification relation
 * @method     ChildBrandCampiagnClassificationQuery rightJoinWithClassification() Adds a RIGHT JOIN clause and with to the query using the Classification relation
 * @method     ChildBrandCampiagnClassificationQuery innerJoinWithClassification() Adds a INNER JOIN clause and with to the query using the Classification relation
 *
 * @method     \entities\BrandCampiagnQuery|\entities\ClassificationQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildBrandCampiagnClassification|null findOne(?ConnectionInterface $con = null) Return the first ChildBrandCampiagnClassification matching the query
 * @method     ChildBrandCampiagnClassification findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildBrandCampiagnClassification matching the query, or a new ChildBrandCampiagnClassification object populated from the query conditions when no match is found
 *
 * @method     ChildBrandCampiagnClassification|null findOneByBrandCampiagnClassificationId(int $brand_campiagn_classification_id) Return the first ChildBrandCampiagnClassification filtered by the brand_campiagn_classification_id column
 * @method     ChildBrandCampiagnClassification|null findOneByClassificationId(int $classification_id) Return the first ChildBrandCampiagnClassification filtered by the classification_id column
 * @method     ChildBrandCampiagnClassification|null findOneByMinimum(int $minimum) Return the first ChildBrandCampiagnClassification filtered by the minimum column
 * @method     ChildBrandCampiagnClassification|null findOneByMaximum(int $maximum) Return the first ChildBrandCampiagnClassification filtered by the maximum column
 * @method     ChildBrandCampiagnClassification|null findOneByBrandCampiagnId(int $brand_campiagn_id) Return the first ChildBrandCampiagnClassification filtered by the brand_campiagn_id column
 * @method     ChildBrandCampiagnClassification|null findOneByCreatedAt(string $created_at) Return the first ChildBrandCampiagnClassification filtered by the created_at column
 * @method     ChildBrandCampiagnClassification|null findOneByUpdatedAt(string $updated_at) Return the first ChildBrandCampiagnClassification filtered by the updated_at column
 * @method     ChildBrandCampiagnClassification|null findOneByComment(string $comment) Return the first ChildBrandCampiagnClassification filtered by the comment column
 *
 * @method     ChildBrandCampiagnClassification requirePk($key, ?ConnectionInterface $con = null) Return the ChildBrandCampiagnClassification by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandCampiagnClassification requireOne(?ConnectionInterface $con = null) Return the first ChildBrandCampiagnClassification matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBrandCampiagnClassification requireOneByBrandCampiagnClassificationId(int $brand_campiagn_classification_id) Return the first ChildBrandCampiagnClassification filtered by the brand_campiagn_classification_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandCampiagnClassification requireOneByClassificationId(int $classification_id) Return the first ChildBrandCampiagnClassification filtered by the classification_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandCampiagnClassification requireOneByMinimum(int $minimum) Return the first ChildBrandCampiagnClassification filtered by the minimum column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandCampiagnClassification requireOneByMaximum(int $maximum) Return the first ChildBrandCampiagnClassification filtered by the maximum column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandCampiagnClassification requireOneByBrandCampiagnId(int $brand_campiagn_id) Return the first ChildBrandCampiagnClassification filtered by the brand_campiagn_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandCampiagnClassification requireOneByCreatedAt(string $created_at) Return the first ChildBrandCampiagnClassification filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandCampiagnClassification requireOneByUpdatedAt(string $updated_at) Return the first ChildBrandCampiagnClassification filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandCampiagnClassification requireOneByComment(string $comment) Return the first ChildBrandCampiagnClassification filtered by the comment column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBrandCampiagnClassification[]|Collection find(?ConnectionInterface $con = null) Return ChildBrandCampiagnClassification objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildBrandCampiagnClassification> find(?ConnectionInterface $con = null) Return ChildBrandCampiagnClassification objects based on current ModelCriteria
 *
 * @method     ChildBrandCampiagnClassification[]|Collection findByBrandCampiagnClassificationId(int|array<int> $brand_campiagn_classification_id) Return ChildBrandCampiagnClassification objects filtered by the brand_campiagn_classification_id column
 * @psalm-method Collection&\Traversable<ChildBrandCampiagnClassification> findByBrandCampiagnClassificationId(int|array<int> $brand_campiagn_classification_id) Return ChildBrandCampiagnClassification objects filtered by the brand_campiagn_classification_id column
 * @method     ChildBrandCampiagnClassification[]|Collection findByClassificationId(int|array<int> $classification_id) Return ChildBrandCampiagnClassification objects filtered by the classification_id column
 * @psalm-method Collection&\Traversable<ChildBrandCampiagnClassification> findByClassificationId(int|array<int> $classification_id) Return ChildBrandCampiagnClassification objects filtered by the classification_id column
 * @method     ChildBrandCampiagnClassification[]|Collection findByMinimum(int|array<int> $minimum) Return ChildBrandCampiagnClassification objects filtered by the minimum column
 * @psalm-method Collection&\Traversable<ChildBrandCampiagnClassification> findByMinimum(int|array<int> $minimum) Return ChildBrandCampiagnClassification objects filtered by the minimum column
 * @method     ChildBrandCampiagnClassification[]|Collection findByMaximum(int|array<int> $maximum) Return ChildBrandCampiagnClassification objects filtered by the maximum column
 * @psalm-method Collection&\Traversable<ChildBrandCampiagnClassification> findByMaximum(int|array<int> $maximum) Return ChildBrandCampiagnClassification objects filtered by the maximum column
 * @method     ChildBrandCampiagnClassification[]|Collection findByBrandCampiagnId(int|array<int> $brand_campiagn_id) Return ChildBrandCampiagnClassification objects filtered by the brand_campiagn_id column
 * @psalm-method Collection&\Traversable<ChildBrandCampiagnClassification> findByBrandCampiagnId(int|array<int> $brand_campiagn_id) Return ChildBrandCampiagnClassification objects filtered by the brand_campiagn_id column
 * @method     ChildBrandCampiagnClassification[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildBrandCampiagnClassification objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildBrandCampiagnClassification> findByCreatedAt(string|array<string> $created_at) Return ChildBrandCampiagnClassification objects filtered by the created_at column
 * @method     ChildBrandCampiagnClassification[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildBrandCampiagnClassification objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildBrandCampiagnClassification> findByUpdatedAt(string|array<string> $updated_at) Return ChildBrandCampiagnClassification objects filtered by the updated_at column
 * @method     ChildBrandCampiagnClassification[]|Collection findByComment(string|array<string> $comment) Return ChildBrandCampiagnClassification objects filtered by the comment column
 * @psalm-method Collection&\Traversable<ChildBrandCampiagnClassification> findByComment(string|array<string> $comment) Return ChildBrandCampiagnClassification objects filtered by the comment column
 *
 * @method     ChildBrandCampiagnClassification[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildBrandCampiagnClassification> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class BrandCampiagnClassificationQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\BrandCampiagnClassificationQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\BrandCampiagnClassification', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildBrandCampiagnClassificationQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildBrandCampiagnClassificationQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildBrandCampiagnClassificationQuery) {
            return $criteria;
        }
        $query = new ChildBrandCampiagnClassificationQuery();
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
     * @return ChildBrandCampiagnClassification|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(BrandCampiagnClassificationTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = BrandCampiagnClassificationTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildBrandCampiagnClassification A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT brand_campiagn_classification_id, classification_id, minimum, maximum, brand_campiagn_id, created_at, updated_at, comment FROM brand_campiagn_classification WHERE brand_campiagn_classification_id = :p0';
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
            /** @var ChildBrandCampiagnClassification $obj */
            $obj = new ChildBrandCampiagnClassification();
            $obj->hydrate($row);
            BrandCampiagnClassificationTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildBrandCampiagnClassification|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(BrandCampiagnClassificationTableMap::COL_BRAND_CAMPIAGN_CLASSIFICATION_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(BrandCampiagnClassificationTableMap::COL_BRAND_CAMPIAGN_CLASSIFICATION_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the brand_campiagn_classification_id column
     *
     * Example usage:
     * <code>
     * $query->filterByBrandCampiagnClassificationId(1234); // WHERE brand_campiagn_classification_id = 1234
     * $query->filterByBrandCampiagnClassificationId(array(12, 34)); // WHERE brand_campiagn_classification_id IN (12, 34)
     * $query->filterByBrandCampiagnClassificationId(array('min' => 12)); // WHERE brand_campiagn_classification_id > 12
     * </code>
     *
     * @param mixed $brandCampiagnClassificationId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBrandCampiagnClassificationId($brandCampiagnClassificationId = null, ?string $comparison = null)
    {
        if (is_array($brandCampiagnClassificationId)) {
            $useMinMax = false;
            if (isset($brandCampiagnClassificationId['min'])) {
                $this->addUsingAlias(BrandCampiagnClassificationTableMap::COL_BRAND_CAMPIAGN_CLASSIFICATION_ID, $brandCampiagnClassificationId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($brandCampiagnClassificationId['max'])) {
                $this->addUsingAlias(BrandCampiagnClassificationTableMap::COL_BRAND_CAMPIAGN_CLASSIFICATION_ID, $brandCampiagnClassificationId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandCampiagnClassificationTableMap::COL_BRAND_CAMPIAGN_CLASSIFICATION_ID, $brandCampiagnClassificationId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the classification_id column
     *
     * Example usage:
     * <code>
     * $query->filterByClassificationId(1234); // WHERE classification_id = 1234
     * $query->filterByClassificationId(array(12, 34)); // WHERE classification_id IN (12, 34)
     * $query->filterByClassificationId(array('min' => 12)); // WHERE classification_id > 12
     * </code>
     *
     * @see       filterByClassification()
     *
     * @param mixed $classificationId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByClassificationId($classificationId = null, ?string $comparison = null)
    {
        if (is_array($classificationId)) {
            $useMinMax = false;
            if (isset($classificationId['min'])) {
                $this->addUsingAlias(BrandCampiagnClassificationTableMap::COL_CLASSIFICATION_ID, $classificationId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($classificationId['max'])) {
                $this->addUsingAlias(BrandCampiagnClassificationTableMap::COL_CLASSIFICATION_ID, $classificationId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandCampiagnClassificationTableMap::COL_CLASSIFICATION_ID, $classificationId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the minimum column
     *
     * Example usage:
     * <code>
     * $query->filterByMinimum(1234); // WHERE minimum = 1234
     * $query->filterByMinimum(array(12, 34)); // WHERE minimum IN (12, 34)
     * $query->filterByMinimum(array('min' => 12)); // WHERE minimum > 12
     * </code>
     *
     * @param mixed $minimum The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMinimum($minimum = null, ?string $comparison = null)
    {
        if (is_array($minimum)) {
            $useMinMax = false;
            if (isset($minimum['min'])) {
                $this->addUsingAlias(BrandCampiagnClassificationTableMap::COL_MINIMUM, $minimum['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($minimum['max'])) {
                $this->addUsingAlias(BrandCampiagnClassificationTableMap::COL_MINIMUM, $minimum['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandCampiagnClassificationTableMap::COL_MINIMUM, $minimum, $comparison);

        return $this;
    }

    /**
     * Filter the query on the maximum column
     *
     * Example usage:
     * <code>
     * $query->filterByMaximum(1234); // WHERE maximum = 1234
     * $query->filterByMaximum(array(12, 34)); // WHERE maximum IN (12, 34)
     * $query->filterByMaximum(array('min' => 12)); // WHERE maximum > 12
     * </code>
     *
     * @param mixed $maximum The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMaximum($maximum = null, ?string $comparison = null)
    {
        if (is_array($maximum)) {
            $useMinMax = false;
            if (isset($maximum['min'])) {
                $this->addUsingAlias(BrandCampiagnClassificationTableMap::COL_MAXIMUM, $maximum['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($maximum['max'])) {
                $this->addUsingAlias(BrandCampiagnClassificationTableMap::COL_MAXIMUM, $maximum['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandCampiagnClassificationTableMap::COL_MAXIMUM, $maximum, $comparison);

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
     * @see       filterByBrandCampiagn()
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
                $this->addUsingAlias(BrandCampiagnClassificationTableMap::COL_BRAND_CAMPIAGN_ID, $brandCampiagnId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($brandCampiagnId['max'])) {
                $this->addUsingAlias(BrandCampiagnClassificationTableMap::COL_BRAND_CAMPIAGN_ID, $brandCampiagnId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandCampiagnClassificationTableMap::COL_BRAND_CAMPIAGN_ID, $brandCampiagnId, $comparison);

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
                $this->addUsingAlias(BrandCampiagnClassificationTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(BrandCampiagnClassificationTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandCampiagnClassificationTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(BrandCampiagnClassificationTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(BrandCampiagnClassificationTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandCampiagnClassificationTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

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

        $this->addUsingAlias(BrandCampiagnClassificationTableMap::COL_COMMENT, $comment, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \entities\BrandCampiagn object
     *
     * @param \entities\BrandCampiagn|ObjectCollection $brandCampiagn The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBrandCampiagn($brandCampiagn, ?string $comparison = null)
    {
        if ($brandCampiagn instanceof \entities\BrandCampiagn) {
            return $this
                ->addUsingAlias(BrandCampiagnClassificationTableMap::COL_BRAND_CAMPIAGN_ID, $brandCampiagn->getBrandCampiagnId(), $comparison);
        } elseif ($brandCampiagn instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(BrandCampiagnClassificationTableMap::COL_BRAND_CAMPIAGN_ID, $brandCampiagn->toKeyValue('PrimaryKey', 'BrandCampiagnId'), $comparison);

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
    public function joinBrandCampiagn(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
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
    public function useBrandCampiagnQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
        ?string $joinType = Criteria::INNER_JOIN
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
     * Filter the query by a related \entities\Classification object
     *
     * @param \entities\Classification|ObjectCollection $classification The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByClassification($classification, ?string $comparison = null)
    {
        if ($classification instanceof \entities\Classification) {
            return $this
                ->addUsingAlias(BrandCampiagnClassificationTableMap::COL_CLASSIFICATION_ID, $classification->getId(), $comparison);
        } elseif ($classification instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(BrandCampiagnClassificationTableMap::COL_CLASSIFICATION_ID, $classification->toKeyValue('PrimaryKey', 'Id'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByClassification() only accepts arguments of type \entities\Classification or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Classification relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinClassification(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Classification');

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
            $this->addJoinObject($join, 'Classification');
        }

        return $this;
    }

    /**
     * Use the Classification relation Classification object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\ClassificationQuery A secondary query class using the current class as primary query
     */
    public function useClassificationQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinClassification($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Classification', '\entities\ClassificationQuery');
    }

    /**
     * Use the Classification relation Classification object
     *
     * @param callable(\entities\ClassificationQuery):\entities\ClassificationQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withClassificationQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useClassificationQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Classification table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\ClassificationQuery The inner query object of the EXISTS statement
     */
    public function useClassificationExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\ClassificationQuery */
        $q = $this->useExistsQuery('Classification', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Classification table for a NOT EXISTS query.
     *
     * @see useClassificationExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\ClassificationQuery The inner query object of the NOT EXISTS statement
     */
    public function useClassificationNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\ClassificationQuery */
        $q = $this->useExistsQuery('Classification', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Classification table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\ClassificationQuery The inner query object of the IN statement
     */
    public function useInClassificationQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\ClassificationQuery */
        $q = $this->useInQuery('Classification', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Classification table for a NOT IN query.
     *
     * @see useClassificationInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\ClassificationQuery The inner query object of the NOT IN statement
     */
    public function useNotInClassificationQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\ClassificationQuery */
        $q = $this->useInQuery('Classification', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildBrandCampiagnClassification $brandCampiagnClassification Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($brandCampiagnClassification = null)
    {
        if ($brandCampiagnClassification) {
            $this->addUsingAlias(BrandCampiagnClassificationTableMap::COL_BRAND_CAMPIAGN_CLASSIFICATION_ID, $brandCampiagnClassification->getBrandCampiagnClassificationId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the brand_campiagn_classification table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(BrandCampiagnClassificationTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            BrandCampiagnClassificationTableMap::clearInstancePool();
            BrandCampiagnClassificationTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(BrandCampiagnClassificationTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(BrandCampiagnClassificationTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            BrandCampiagnClassificationTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            BrandCampiagnClassificationTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
