<?php

namespace entities\Base;

use \Exception;
use \PDO;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;
use entities\OutletMappingView as ChildOutletMappingView;
use entities\OutletMappingViewQuery as ChildOutletMappingViewQuery;
use entities\Map\OutletMappingViewTableMap;

/**
 * Base class that represents a query for the `outlet_mapping_view` table.
 *
 * @method     ChildOutletMappingViewQuery orderByMappingId($order = Criteria::ASC) Order by the mapping_id column
 * @method     ChildOutletMappingViewQuery orderByPrimaryOutletId($order = Criteria::ASC) Order by the primary_outlet_id column
 * @method     ChildOutletMappingViewQuery orderBySecondaryOutletId($order = Criteria::ASC) Order by the secondary_outlet_id column
 * @method     ChildOutletMappingViewQuery orderByPricebookId($order = Criteria::ASC) Order by the pricebook_id column
 * @method     ChildOutletMappingViewQuery orderByIsDefault($order = Criteria::ASC) Order by the isdefault column
 * @method     ChildOutletMappingViewQuery orderByCategoryType($order = Criteria::ASC) Order by the category_type column
 * @method     ChildOutletMappingViewQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildOutletMappingViewQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildOutletMappingViewQuery orderByOutletOrgId($order = Criteria::ASC) Order by the outlet_org_id column
 * @method     ChildOutletMappingViewQuery orderByOrgUnitId($order = Criteria::ASC) Order by the org_unit_id column
 * @method     ChildOutletMappingViewQuery orderByTerritoryId($order = Criteria::ASC) Order by the territory_id column
 * @method     ChildOutletMappingViewQuery orderByTerritoryName($order = Criteria::ASC) Order by the territory_name column
 * @method     ChildOutletMappingViewQuery orderByOutlettypeName($order = Criteria::ASC) Order by the outlettype_name column
 *
 * @method     ChildOutletMappingViewQuery groupByMappingId() Group by the mapping_id column
 * @method     ChildOutletMappingViewQuery groupByPrimaryOutletId() Group by the primary_outlet_id column
 * @method     ChildOutletMappingViewQuery groupBySecondaryOutletId() Group by the secondary_outlet_id column
 * @method     ChildOutletMappingViewQuery groupByPricebookId() Group by the pricebook_id column
 * @method     ChildOutletMappingViewQuery groupByIsDefault() Group by the isdefault column
 * @method     ChildOutletMappingViewQuery groupByCategoryType() Group by the category_type column
 * @method     ChildOutletMappingViewQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildOutletMappingViewQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildOutletMappingViewQuery groupByOutletOrgId() Group by the outlet_org_id column
 * @method     ChildOutletMappingViewQuery groupByOrgUnitId() Group by the org_unit_id column
 * @method     ChildOutletMappingViewQuery groupByTerritoryId() Group by the territory_id column
 * @method     ChildOutletMappingViewQuery groupByTerritoryName() Group by the territory_name column
 * @method     ChildOutletMappingViewQuery groupByOutlettypeName() Group by the outlettype_name column
 *
 * @method     ChildOutletMappingViewQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildOutletMappingViewQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildOutletMappingViewQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildOutletMappingViewQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildOutletMappingViewQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildOutletMappingViewQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildOutletMappingView|null findOne(?ConnectionInterface $con = null) Return the first ChildOutletMappingView matching the query
 * @method     ChildOutletMappingView findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildOutletMappingView matching the query, or a new ChildOutletMappingView object populated from the query conditions when no match is found
 *
 * @method     ChildOutletMappingView|null findOneByMappingId(int $mapping_id) Return the first ChildOutletMappingView filtered by the mapping_id column
 * @method     ChildOutletMappingView|null findOneByPrimaryOutletId(int $primary_outlet_id) Return the first ChildOutletMappingView filtered by the primary_outlet_id column
 * @method     ChildOutletMappingView|null findOneBySecondaryOutletId(int $secondary_outlet_id) Return the first ChildOutletMappingView filtered by the secondary_outlet_id column
 * @method     ChildOutletMappingView|null findOneByPricebookId(int $pricebook_id) Return the first ChildOutletMappingView filtered by the pricebook_id column
 * @method     ChildOutletMappingView|null findOneByIsDefault(int $isdefault) Return the first ChildOutletMappingView filtered by the isdefault column
 * @method     ChildOutletMappingView|null findOneByCategoryType(string $category_type) Return the first ChildOutletMappingView filtered by the category_type column
 * @method     ChildOutletMappingView|null findOneByCreatedAt(string $created_at) Return the first ChildOutletMappingView filtered by the created_at column
 * @method     ChildOutletMappingView|null findOneByUpdatedAt(string $updated_at) Return the first ChildOutletMappingView filtered by the updated_at column
 * @method     ChildOutletMappingView|null findOneByOutletOrgId(int $outlet_org_id) Return the first ChildOutletMappingView filtered by the outlet_org_id column
 * @method     ChildOutletMappingView|null findOneByOrgUnitId(int $org_unit_id) Return the first ChildOutletMappingView filtered by the org_unit_id column
 * @method     ChildOutletMappingView|null findOneByTerritoryId(int $territory_id) Return the first ChildOutletMappingView filtered by the territory_id column
 * @method     ChildOutletMappingView|null findOneByTerritoryName(string $territory_name) Return the first ChildOutletMappingView filtered by the territory_name column
 * @method     ChildOutletMappingView|null findOneByOutlettypeName(string $outlettype_name) Return the first ChildOutletMappingView filtered by the outlettype_name column
 *
 * @method     ChildOutletMappingView requirePk($key, ?ConnectionInterface $con = null) Return the ChildOutletMappingView by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletMappingView requireOne(?ConnectionInterface $con = null) Return the first ChildOutletMappingView matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOutletMappingView requireOneByMappingId(int $mapping_id) Return the first ChildOutletMappingView filtered by the mapping_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletMappingView requireOneByPrimaryOutletId(int $primary_outlet_id) Return the first ChildOutletMappingView filtered by the primary_outlet_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletMappingView requireOneBySecondaryOutletId(int $secondary_outlet_id) Return the first ChildOutletMappingView filtered by the secondary_outlet_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletMappingView requireOneByPricebookId(int $pricebook_id) Return the first ChildOutletMappingView filtered by the pricebook_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletMappingView requireOneByIsDefault(int $isdefault) Return the first ChildOutletMappingView filtered by the isdefault column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletMappingView requireOneByCategoryType(string $category_type) Return the first ChildOutletMappingView filtered by the category_type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletMappingView requireOneByCreatedAt(string $created_at) Return the first ChildOutletMappingView filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletMappingView requireOneByUpdatedAt(string $updated_at) Return the first ChildOutletMappingView filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletMappingView requireOneByOutletOrgId(int $outlet_org_id) Return the first ChildOutletMappingView filtered by the outlet_org_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletMappingView requireOneByOrgUnitId(int $org_unit_id) Return the first ChildOutletMappingView filtered by the org_unit_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletMappingView requireOneByTerritoryId(int $territory_id) Return the first ChildOutletMappingView filtered by the territory_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletMappingView requireOneByTerritoryName(string $territory_name) Return the first ChildOutletMappingView filtered by the territory_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletMappingView requireOneByOutlettypeName(string $outlettype_name) Return the first ChildOutletMappingView filtered by the outlettype_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOutletMappingView[]|Collection find(?ConnectionInterface $con = null) Return ChildOutletMappingView objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildOutletMappingView> find(?ConnectionInterface $con = null) Return ChildOutletMappingView objects based on current ModelCriteria
 *
 * @method     ChildOutletMappingView[]|Collection findByMappingId(int|array<int> $mapping_id) Return ChildOutletMappingView objects filtered by the mapping_id column
 * @psalm-method Collection&\Traversable<ChildOutletMappingView> findByMappingId(int|array<int> $mapping_id) Return ChildOutletMappingView objects filtered by the mapping_id column
 * @method     ChildOutletMappingView[]|Collection findByPrimaryOutletId(int|array<int> $primary_outlet_id) Return ChildOutletMappingView objects filtered by the primary_outlet_id column
 * @psalm-method Collection&\Traversable<ChildOutletMappingView> findByPrimaryOutletId(int|array<int> $primary_outlet_id) Return ChildOutletMappingView objects filtered by the primary_outlet_id column
 * @method     ChildOutletMappingView[]|Collection findBySecondaryOutletId(int|array<int> $secondary_outlet_id) Return ChildOutletMappingView objects filtered by the secondary_outlet_id column
 * @psalm-method Collection&\Traversable<ChildOutletMappingView> findBySecondaryOutletId(int|array<int> $secondary_outlet_id) Return ChildOutletMappingView objects filtered by the secondary_outlet_id column
 * @method     ChildOutletMappingView[]|Collection findByPricebookId(int|array<int> $pricebook_id) Return ChildOutletMappingView objects filtered by the pricebook_id column
 * @psalm-method Collection&\Traversable<ChildOutletMappingView> findByPricebookId(int|array<int> $pricebook_id) Return ChildOutletMappingView objects filtered by the pricebook_id column
 * @method     ChildOutletMappingView[]|Collection findByIsDefault(int|array<int> $isdefault) Return ChildOutletMappingView objects filtered by the isdefault column
 * @psalm-method Collection&\Traversable<ChildOutletMappingView> findByIsDefault(int|array<int> $isdefault) Return ChildOutletMappingView objects filtered by the isdefault column
 * @method     ChildOutletMappingView[]|Collection findByCategoryType(string|array<string> $category_type) Return ChildOutletMappingView objects filtered by the category_type column
 * @psalm-method Collection&\Traversable<ChildOutletMappingView> findByCategoryType(string|array<string> $category_type) Return ChildOutletMappingView objects filtered by the category_type column
 * @method     ChildOutletMappingView[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildOutletMappingView objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildOutletMappingView> findByCreatedAt(string|array<string> $created_at) Return ChildOutletMappingView objects filtered by the created_at column
 * @method     ChildOutletMappingView[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildOutletMappingView objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildOutletMappingView> findByUpdatedAt(string|array<string> $updated_at) Return ChildOutletMappingView objects filtered by the updated_at column
 * @method     ChildOutletMappingView[]|Collection findByOutletOrgId(int|array<int> $outlet_org_id) Return ChildOutletMappingView objects filtered by the outlet_org_id column
 * @psalm-method Collection&\Traversable<ChildOutletMappingView> findByOutletOrgId(int|array<int> $outlet_org_id) Return ChildOutletMappingView objects filtered by the outlet_org_id column
 * @method     ChildOutletMappingView[]|Collection findByOrgUnitId(int|array<int> $org_unit_id) Return ChildOutletMappingView objects filtered by the org_unit_id column
 * @psalm-method Collection&\Traversable<ChildOutletMappingView> findByOrgUnitId(int|array<int> $org_unit_id) Return ChildOutletMappingView objects filtered by the org_unit_id column
 * @method     ChildOutletMappingView[]|Collection findByTerritoryId(int|array<int> $territory_id) Return ChildOutletMappingView objects filtered by the territory_id column
 * @psalm-method Collection&\Traversable<ChildOutletMappingView> findByTerritoryId(int|array<int> $territory_id) Return ChildOutletMappingView objects filtered by the territory_id column
 * @method     ChildOutletMappingView[]|Collection findByTerritoryName(string|array<string> $territory_name) Return ChildOutletMappingView objects filtered by the territory_name column
 * @psalm-method Collection&\Traversable<ChildOutletMappingView> findByTerritoryName(string|array<string> $territory_name) Return ChildOutletMappingView objects filtered by the territory_name column
 * @method     ChildOutletMappingView[]|Collection findByOutlettypeName(string|array<string> $outlettype_name) Return ChildOutletMappingView objects filtered by the outlettype_name column
 * @psalm-method Collection&\Traversable<ChildOutletMappingView> findByOutlettypeName(string|array<string> $outlettype_name) Return ChildOutletMappingView objects filtered by the outlettype_name column
 *
 * @method     ChildOutletMappingView[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildOutletMappingView> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class OutletMappingViewQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\OutletMappingViewQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\OutletMappingView', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildOutletMappingViewQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildOutletMappingViewQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildOutletMappingViewQuery) {
            return $criteria;
        }
        $query = new ChildOutletMappingViewQuery();
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
     * @return ChildOutletMappingView|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(OutletMappingViewTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = OutletMappingViewTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildOutletMappingView A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT mapping_id, primary_outlet_id, secondary_outlet_id, pricebook_id, isdefault, category_type, created_at, updated_at, outlet_org_id, org_unit_id, territory_id, territory_name, outlettype_name FROM outlet_mapping_view WHERE mapping_id = :p0';
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
            /** @var ChildOutletMappingView $obj */
            $obj = new ChildOutletMappingView();
            $obj->hydrate($row);
            OutletMappingViewTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildOutletMappingView|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(OutletMappingViewTableMap::COL_MAPPING_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(OutletMappingViewTableMap::COL_MAPPING_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the mapping_id column
     *
     * Example usage:
     * <code>
     * $query->filterByMappingId(1234); // WHERE mapping_id = 1234
     * $query->filterByMappingId(array(12, 34)); // WHERE mapping_id IN (12, 34)
     * $query->filterByMappingId(array('min' => 12)); // WHERE mapping_id > 12
     * </code>
     *
     * @param mixed $mappingId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMappingId($mappingId = null, ?string $comparison = null)
    {
        if (is_array($mappingId)) {
            $useMinMax = false;
            if (isset($mappingId['min'])) {
                $this->addUsingAlias(OutletMappingViewTableMap::COL_MAPPING_ID, $mappingId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($mappingId['max'])) {
                $this->addUsingAlias(OutletMappingViewTableMap::COL_MAPPING_ID, $mappingId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletMappingViewTableMap::COL_MAPPING_ID, $mappingId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the primary_outlet_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPrimaryOutletId(1234); // WHERE primary_outlet_id = 1234
     * $query->filterByPrimaryOutletId(array(12, 34)); // WHERE primary_outlet_id IN (12, 34)
     * $query->filterByPrimaryOutletId(array('min' => 12)); // WHERE primary_outlet_id > 12
     * </code>
     *
     * @param mixed $primaryOutletId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrimaryOutletId($primaryOutletId = null, ?string $comparison = null)
    {
        if (is_array($primaryOutletId)) {
            $useMinMax = false;
            if (isset($primaryOutletId['min'])) {
                $this->addUsingAlias(OutletMappingViewTableMap::COL_PRIMARY_OUTLET_ID, $primaryOutletId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($primaryOutletId['max'])) {
                $this->addUsingAlias(OutletMappingViewTableMap::COL_PRIMARY_OUTLET_ID, $primaryOutletId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletMappingViewTableMap::COL_PRIMARY_OUTLET_ID, $primaryOutletId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the secondary_outlet_id column
     *
     * Example usage:
     * <code>
     * $query->filterBySecondaryOutletId(1234); // WHERE secondary_outlet_id = 1234
     * $query->filterBySecondaryOutletId(array(12, 34)); // WHERE secondary_outlet_id IN (12, 34)
     * $query->filterBySecondaryOutletId(array('min' => 12)); // WHERE secondary_outlet_id > 12
     * </code>
     *
     * @param mixed $secondaryOutletId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySecondaryOutletId($secondaryOutletId = null, ?string $comparison = null)
    {
        if (is_array($secondaryOutletId)) {
            $useMinMax = false;
            if (isset($secondaryOutletId['min'])) {
                $this->addUsingAlias(OutletMappingViewTableMap::COL_SECONDARY_OUTLET_ID, $secondaryOutletId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($secondaryOutletId['max'])) {
                $this->addUsingAlias(OutletMappingViewTableMap::COL_SECONDARY_OUTLET_ID, $secondaryOutletId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletMappingViewTableMap::COL_SECONDARY_OUTLET_ID, $secondaryOutletId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the pricebook_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPricebookId(1234); // WHERE pricebook_id = 1234
     * $query->filterByPricebookId(array(12, 34)); // WHERE pricebook_id IN (12, 34)
     * $query->filterByPricebookId(array('min' => 12)); // WHERE pricebook_id > 12
     * </code>
     *
     * @param mixed $pricebookId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPricebookId($pricebookId = null, ?string $comparison = null)
    {
        if (is_array($pricebookId)) {
            $useMinMax = false;
            if (isset($pricebookId['min'])) {
                $this->addUsingAlias(OutletMappingViewTableMap::COL_PRICEBOOK_ID, $pricebookId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($pricebookId['max'])) {
                $this->addUsingAlias(OutletMappingViewTableMap::COL_PRICEBOOK_ID, $pricebookId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletMappingViewTableMap::COL_PRICEBOOK_ID, $pricebookId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the isdefault column
     *
     * Example usage:
     * <code>
     * $query->filterByIsDefault(1234); // WHERE isdefault = 1234
     * $query->filterByIsDefault(array(12, 34)); // WHERE isdefault IN (12, 34)
     * $query->filterByIsDefault(array('min' => 12)); // WHERE isdefault > 12
     * </code>
     *
     * @param mixed $isDefault The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIsDefault($isDefault = null, ?string $comparison = null)
    {
        if (is_array($isDefault)) {
            $useMinMax = false;
            if (isset($isDefault['min'])) {
                $this->addUsingAlias(OutletMappingViewTableMap::COL_ISDEFAULT, $isDefault['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($isDefault['max'])) {
                $this->addUsingAlias(OutletMappingViewTableMap::COL_ISDEFAULT, $isDefault['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletMappingViewTableMap::COL_ISDEFAULT, $isDefault, $comparison);

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

        $this->addUsingAlias(OutletMappingViewTableMap::COL_CATEGORY_TYPE, $categoryType, $comparison);

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
                $this->addUsingAlias(OutletMappingViewTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(OutletMappingViewTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletMappingViewTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(OutletMappingViewTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(OutletMappingViewTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletMappingViewTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_org_id column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletOrgId(1234); // WHERE outlet_org_id = 1234
     * $query->filterByOutletOrgId(array(12, 34)); // WHERE outlet_org_id IN (12, 34)
     * $query->filterByOutletOrgId(array('min' => 12)); // WHERE outlet_org_id > 12
     * </code>
     *
     * @param mixed $outletOrgId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletOrgId($outletOrgId = null, ?string $comparison = null)
    {
        if (is_array($outletOrgId)) {
            $useMinMax = false;
            if (isset($outletOrgId['min'])) {
                $this->addUsingAlias(OutletMappingViewTableMap::COL_OUTLET_ORG_ID, $outletOrgId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outletOrgId['max'])) {
                $this->addUsingAlias(OutletMappingViewTableMap::COL_OUTLET_ORG_ID, $outletOrgId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletMappingViewTableMap::COL_OUTLET_ORG_ID, $outletOrgId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the org_unit_id column
     *
     * Example usage:
     * <code>
     * $query->filterByOrgUnitId(1234); // WHERE org_unit_id = 1234
     * $query->filterByOrgUnitId(array(12, 34)); // WHERE org_unit_id IN (12, 34)
     * $query->filterByOrgUnitId(array('min' => 12)); // WHERE org_unit_id > 12
     * </code>
     *
     * @param mixed $orgUnitId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrgUnitId($orgUnitId = null, ?string $comparison = null)
    {
        if (is_array($orgUnitId)) {
            $useMinMax = false;
            if (isset($orgUnitId['min'])) {
                $this->addUsingAlias(OutletMappingViewTableMap::COL_ORG_UNIT_ID, $orgUnitId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($orgUnitId['max'])) {
                $this->addUsingAlias(OutletMappingViewTableMap::COL_ORG_UNIT_ID, $orgUnitId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletMappingViewTableMap::COL_ORG_UNIT_ID, $orgUnitId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the territory_id column
     *
     * Example usage:
     * <code>
     * $query->filterByTerritoryId(1234); // WHERE territory_id = 1234
     * $query->filterByTerritoryId(array(12, 34)); // WHERE territory_id IN (12, 34)
     * $query->filterByTerritoryId(array('min' => 12)); // WHERE territory_id > 12
     * </code>
     *
     * @param mixed $territoryId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTerritoryId($territoryId = null, ?string $comparison = null)
    {
        if (is_array($territoryId)) {
            $useMinMax = false;
            if (isset($territoryId['min'])) {
                $this->addUsingAlias(OutletMappingViewTableMap::COL_TERRITORY_ID, $territoryId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($territoryId['max'])) {
                $this->addUsingAlias(OutletMappingViewTableMap::COL_TERRITORY_ID, $territoryId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletMappingViewTableMap::COL_TERRITORY_ID, $territoryId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the territory_name column
     *
     * Example usage:
     * <code>
     * $query->filterByTerritoryName('fooValue');   // WHERE territory_name = 'fooValue'
     * $query->filterByTerritoryName('%fooValue%', Criteria::LIKE); // WHERE territory_name LIKE '%fooValue%'
     * $query->filterByTerritoryName(['foo', 'bar']); // WHERE territory_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $territoryName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTerritoryName($territoryName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($territoryName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletMappingViewTableMap::COL_TERRITORY_NAME, $territoryName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlettype_name column
     *
     * Example usage:
     * <code>
     * $query->filterByOutlettypeName('fooValue');   // WHERE outlettype_name = 'fooValue'
     * $query->filterByOutlettypeName('%fooValue%', Criteria::LIKE); // WHERE outlettype_name LIKE '%fooValue%'
     * $query->filterByOutlettypeName(['foo', 'bar']); // WHERE outlettype_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $outlettypeName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutlettypeName($outlettypeName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($outlettypeName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletMappingViewTableMap::COL_OUTLETTYPE_NAME, $outlettypeName, $comparison);

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildOutletMappingView $outletMappingView Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($outletMappingView = null)
    {
        if ($outletMappingView) {
            $this->addUsingAlias(OutletMappingViewTableMap::COL_MAPPING_ID, $outletMappingView->getMappingId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
