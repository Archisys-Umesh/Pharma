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
use entities\Shippinglineallocation as ChildShippinglineallocation;
use entities\ShippinglineallocationQuery as ChildShippinglineallocationQuery;
use entities\Map\ShippinglineallocationTableMap;

/**
 * Base class that represents a query for the `shippinglineallocation` table.
 *
 * @method     ChildShippinglineallocationQuery orderBySolarid($order = Criteria::ASC) Order by the solarid column
 * @method     ChildShippinglineallocationQuery orderBySolid($order = Criteria::ASC) Order by the solid column
 * @method     ChildShippinglineallocationQuery orderBySerialNumber($order = Criteria::ASC) Order by the serial_number column
 * @method     ChildShippinglineallocationQuery orderBySkuId($order = Criteria::ASC) Order by the sku_id column
 *
 * @method     ChildShippinglineallocationQuery groupBySolarid() Group by the solarid column
 * @method     ChildShippinglineallocationQuery groupBySolid() Group by the solid column
 * @method     ChildShippinglineallocationQuery groupBySerialNumber() Group by the serial_number column
 * @method     ChildShippinglineallocationQuery groupBySkuId() Group by the sku_id column
 *
 * @method     ChildShippinglineallocationQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildShippinglineallocationQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildShippinglineallocationQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildShippinglineallocationQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildShippinglineallocationQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildShippinglineallocationQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildShippinglineallocationQuery leftJoinShippinglines($relationAlias = null) Adds a LEFT JOIN clause to the query using the Shippinglines relation
 * @method     ChildShippinglineallocationQuery rightJoinShippinglines($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Shippinglines relation
 * @method     ChildShippinglineallocationQuery innerJoinShippinglines($relationAlias = null) Adds a INNER JOIN clause to the query using the Shippinglines relation
 *
 * @method     ChildShippinglineallocationQuery joinWithShippinglines($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Shippinglines relation
 *
 * @method     ChildShippinglineallocationQuery leftJoinWithShippinglines() Adds a LEFT JOIN clause and with to the query using the Shippinglines relation
 * @method     ChildShippinglineallocationQuery rightJoinWithShippinglines() Adds a RIGHT JOIN clause and with to the query using the Shippinglines relation
 * @method     ChildShippinglineallocationQuery innerJoinWithShippinglines() Adds a INNER JOIN clause and with to the query using the Shippinglines relation
 *
 * @method     \entities\ShippinglinesQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildShippinglineallocation|null findOne(?ConnectionInterface $con = null) Return the first ChildShippinglineallocation matching the query
 * @method     ChildShippinglineallocation findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildShippinglineallocation matching the query, or a new ChildShippinglineallocation object populated from the query conditions when no match is found
 *
 * @method     ChildShippinglineallocation|null findOneBySolarid(string $solarid) Return the first ChildShippinglineallocation filtered by the solarid column
 * @method     ChildShippinglineallocation|null findOneBySolid(string $solid) Return the first ChildShippinglineallocation filtered by the solid column
 * @method     ChildShippinglineallocation|null findOneBySerialNumber(string $serial_number) Return the first ChildShippinglineallocation filtered by the serial_number column
 * @method     ChildShippinglineallocation|null findOneBySkuId(string $sku_id) Return the first ChildShippinglineallocation filtered by the sku_id column
 *
 * @method     ChildShippinglineallocation requirePk($key, ?ConnectionInterface $con = null) Return the ChildShippinglineallocation by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShippinglineallocation requireOne(?ConnectionInterface $con = null) Return the first ChildShippinglineallocation matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildShippinglineallocation requireOneBySolarid(string $solarid) Return the first ChildShippinglineallocation filtered by the solarid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShippinglineallocation requireOneBySolid(string $solid) Return the first ChildShippinglineallocation filtered by the solid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShippinglineallocation requireOneBySerialNumber(string $serial_number) Return the first ChildShippinglineallocation filtered by the serial_number column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShippinglineallocation requireOneBySkuId(string $sku_id) Return the first ChildShippinglineallocation filtered by the sku_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildShippinglineallocation[]|Collection find(?ConnectionInterface $con = null) Return ChildShippinglineallocation objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildShippinglineallocation> find(?ConnectionInterface $con = null) Return ChildShippinglineallocation objects based on current ModelCriteria
 *
 * @method     ChildShippinglineallocation[]|Collection findBySolarid(string|array<string> $solarid) Return ChildShippinglineallocation objects filtered by the solarid column
 * @psalm-method Collection&\Traversable<ChildShippinglineallocation> findBySolarid(string|array<string> $solarid) Return ChildShippinglineallocation objects filtered by the solarid column
 * @method     ChildShippinglineallocation[]|Collection findBySolid(string|array<string> $solid) Return ChildShippinglineallocation objects filtered by the solid column
 * @psalm-method Collection&\Traversable<ChildShippinglineallocation> findBySolid(string|array<string> $solid) Return ChildShippinglineallocation objects filtered by the solid column
 * @method     ChildShippinglineallocation[]|Collection findBySerialNumber(string|array<string> $serial_number) Return ChildShippinglineallocation objects filtered by the serial_number column
 * @psalm-method Collection&\Traversable<ChildShippinglineallocation> findBySerialNumber(string|array<string> $serial_number) Return ChildShippinglineallocation objects filtered by the serial_number column
 * @method     ChildShippinglineallocation[]|Collection findBySkuId(string|array<string> $sku_id) Return ChildShippinglineallocation objects filtered by the sku_id column
 * @psalm-method Collection&\Traversable<ChildShippinglineallocation> findBySkuId(string|array<string> $sku_id) Return ChildShippinglineallocation objects filtered by the sku_id column
 *
 * @method     ChildShippinglineallocation[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildShippinglineallocation> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class ShippinglineallocationQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\ShippinglineallocationQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\Shippinglineallocation', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildShippinglineallocationQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildShippinglineallocationQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildShippinglineallocationQuery) {
            return $criteria;
        }
        $query = new ChildShippinglineallocationQuery();
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
     * @return ChildShippinglineallocation|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ShippinglineallocationTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ShippinglineallocationTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildShippinglineallocation A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT solarid, solid, serial_number, sku_id FROM shippinglineallocation WHERE solarid = :p0';
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
            /** @var ChildShippinglineallocation $obj */
            $obj = new ChildShippinglineallocation();
            $obj->hydrate($row);
            ShippinglineallocationTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildShippinglineallocation|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(ShippinglineallocationTableMap::COL_SOLARID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(ShippinglineallocationTableMap::COL_SOLARID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the solarid column
     *
     * Example usage:
     * <code>
     * $query->filterBySolarid(1234); // WHERE solarid = 1234
     * $query->filterBySolarid(array(12, 34)); // WHERE solarid IN (12, 34)
     * $query->filterBySolarid(array('min' => 12)); // WHERE solarid > 12
     * </code>
     *
     * @param mixed $solarid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySolarid($solarid = null, ?string $comparison = null)
    {
        if (is_array($solarid)) {
            $useMinMax = false;
            if (isset($solarid['min'])) {
                $this->addUsingAlias(ShippinglineallocationTableMap::COL_SOLARID, $solarid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($solarid['max'])) {
                $this->addUsingAlias(ShippinglineallocationTableMap::COL_SOLARID, $solarid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ShippinglineallocationTableMap::COL_SOLARID, $solarid, $comparison);

        return $this;
    }

    /**
     * Filter the query on the solid column
     *
     * Example usage:
     * <code>
     * $query->filterBySolid(1234); // WHERE solid = 1234
     * $query->filterBySolid(array(12, 34)); // WHERE solid IN (12, 34)
     * $query->filterBySolid(array('min' => 12)); // WHERE solid > 12
     * </code>
     *
     * @see       filterByShippinglines()
     *
     * @param mixed $solid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySolid($solid = null, ?string $comparison = null)
    {
        if (is_array($solid)) {
            $useMinMax = false;
            if (isset($solid['min'])) {
                $this->addUsingAlias(ShippinglineallocationTableMap::COL_SOLID, $solid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($solid['max'])) {
                $this->addUsingAlias(ShippinglineallocationTableMap::COL_SOLID, $solid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ShippinglineallocationTableMap::COL_SOLID, $solid, $comparison);

        return $this;
    }

    /**
     * Filter the query on the serial_number column
     *
     * Example usage:
     * <code>
     * $query->filterBySerialNumber('fooValue');   // WHERE serial_number = 'fooValue'
     * $query->filterBySerialNumber('%fooValue%', Criteria::LIKE); // WHERE serial_number LIKE '%fooValue%'
     * $query->filterBySerialNumber(['foo', 'bar']); // WHERE serial_number IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $serialNumber The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySerialNumber($serialNumber = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($serialNumber)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ShippinglineallocationTableMap::COL_SERIAL_NUMBER, $serialNumber, $comparison);

        return $this;
    }

    /**
     * Filter the query on the sku_id column
     *
     * Example usage:
     * <code>
     * $query->filterBySkuId('fooValue');   // WHERE sku_id = 'fooValue'
     * $query->filterBySkuId('%fooValue%', Criteria::LIKE); // WHERE sku_id LIKE '%fooValue%'
     * $query->filterBySkuId(['foo', 'bar']); // WHERE sku_id IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $skuId The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySkuId($skuId = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($skuId)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ShippinglineallocationTableMap::COL_SKU_ID, $skuId, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \entities\Shippinglines object
     *
     * @param \entities\Shippinglines|ObjectCollection $shippinglines The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByShippinglines($shippinglines, ?string $comparison = null)
    {
        if ($shippinglines instanceof \entities\Shippinglines) {
            return $this
                ->addUsingAlias(ShippinglineallocationTableMap::COL_SOLID, $shippinglines->getSolid(), $comparison);
        } elseif ($shippinglines instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(ShippinglineallocationTableMap::COL_SOLID, $shippinglines->toKeyValue('PrimaryKey', 'Solid'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByShippinglines() only accepts arguments of type \entities\Shippinglines or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Shippinglines relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinShippinglines(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Shippinglines');

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
            $this->addJoinObject($join, 'Shippinglines');
        }

        return $this;
    }

    /**
     * Use the Shippinglines relation Shippinglines object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\ShippinglinesQuery A secondary query class using the current class as primary query
     */
    public function useShippinglinesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinShippinglines($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Shippinglines', '\entities\ShippinglinesQuery');
    }

    /**
     * Use the Shippinglines relation Shippinglines object
     *
     * @param callable(\entities\ShippinglinesQuery):\entities\ShippinglinesQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withShippinglinesQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useShippinglinesQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Shippinglines table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\ShippinglinesQuery The inner query object of the EXISTS statement
     */
    public function useShippinglinesExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\ShippinglinesQuery */
        $q = $this->useExistsQuery('Shippinglines', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Shippinglines table for a NOT EXISTS query.
     *
     * @see useShippinglinesExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\ShippinglinesQuery The inner query object of the NOT EXISTS statement
     */
    public function useShippinglinesNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\ShippinglinesQuery */
        $q = $this->useExistsQuery('Shippinglines', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Shippinglines table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\ShippinglinesQuery The inner query object of the IN statement
     */
    public function useInShippinglinesQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\ShippinglinesQuery */
        $q = $this->useInQuery('Shippinglines', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Shippinglines table for a NOT IN query.
     *
     * @see useShippinglinesInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\ShippinglinesQuery The inner query object of the NOT IN statement
     */
    public function useNotInShippinglinesQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\ShippinglinesQuery */
        $q = $this->useInQuery('Shippinglines', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildShippinglineallocation $shippinglineallocation Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($shippinglineallocation = null)
    {
        if ($shippinglineallocation) {
            $this->addUsingAlias(ShippinglineallocationTableMap::COL_SOLARID, $shippinglineallocation->getSolarid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the shippinglineallocation table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ShippinglineallocationTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ShippinglineallocationTableMap::clearInstancePool();
            ShippinglineallocationTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ShippinglineallocationTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ShippinglineallocationTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ShippinglineallocationTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ShippinglineallocationTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
