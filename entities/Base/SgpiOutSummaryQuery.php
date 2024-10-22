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
use entities\SgpiOutSummary as ChildSgpiOutSummary;
use entities\SgpiOutSummaryQuery as ChildSgpiOutSummaryQuery;
use entities\Map\SgpiOutSummaryTableMap;

/**
 * Base class that represents a query for the `sgpi_out_summary` table.
 *
 * @method     ChildSgpiOutSummaryQuery orderByUniqueid($order = Criteria::ASC) Order by the uniqueid column
 * @method     ChildSgpiOutSummaryQuery orderByMoye($order = Criteria::ASC) Order by the moye column
 * @method     ChildSgpiOutSummaryQuery orderByTerritoryId($order = Criteria::ASC) Order by the territory_id column
 * @method     ChildSgpiOutSummaryQuery orderByOutletOrgdataId($order = Criteria::ASC) Order by the outlet_orgdata_id column
 * @method     ChildSgpiOutSummaryQuery orderBySgpiType($order = Criteria::ASC) Order by the sgpi_type column
 * @method     ChildSgpiOutSummaryQuery orderByQty($order = Criteria::ASC) Order by the qty column
 * @method     ChildSgpiOutSummaryQuery orderByLastcreate($order = Criteria::ASC) Order by the lastcreate column
 *
 * @method     ChildSgpiOutSummaryQuery groupByUniqueid() Group by the uniqueid column
 * @method     ChildSgpiOutSummaryQuery groupByMoye() Group by the moye column
 * @method     ChildSgpiOutSummaryQuery groupByTerritoryId() Group by the territory_id column
 * @method     ChildSgpiOutSummaryQuery groupByOutletOrgdataId() Group by the outlet_orgdata_id column
 * @method     ChildSgpiOutSummaryQuery groupBySgpiType() Group by the sgpi_type column
 * @method     ChildSgpiOutSummaryQuery groupByQty() Group by the qty column
 * @method     ChildSgpiOutSummaryQuery groupByLastcreate() Group by the lastcreate column
 *
 * @method     ChildSgpiOutSummaryQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSgpiOutSummaryQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSgpiOutSummaryQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSgpiOutSummaryQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSgpiOutSummaryQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSgpiOutSummaryQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSgpiOutSummary|null findOne(?ConnectionInterface $con = null) Return the first ChildSgpiOutSummary matching the query
 * @method     ChildSgpiOutSummary findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSgpiOutSummary matching the query, or a new ChildSgpiOutSummary object populated from the query conditions when no match is found
 *
 * @method     ChildSgpiOutSummary|null findOneByUniqueid(string $uniqueid) Return the first ChildSgpiOutSummary filtered by the uniqueid column
 * @method     ChildSgpiOutSummary|null findOneByMoye(string $moye) Return the first ChildSgpiOutSummary filtered by the moye column
 * @method     ChildSgpiOutSummary|null findOneByTerritoryId(int $territory_id) Return the first ChildSgpiOutSummary filtered by the territory_id column
 * @method     ChildSgpiOutSummary|null findOneByOutletOrgdataId(int $outlet_orgdata_id) Return the first ChildSgpiOutSummary filtered by the outlet_orgdata_id column
 * @method     ChildSgpiOutSummary|null findOneBySgpiType(string $sgpi_type) Return the first ChildSgpiOutSummary filtered by the sgpi_type column
 * @method     ChildSgpiOutSummary|null findOneByQty(int $qty) Return the first ChildSgpiOutSummary filtered by the qty column
 * @method     ChildSgpiOutSummary|null findOneByLastcreate(string $lastcreate) Return the first ChildSgpiOutSummary filtered by the lastcreate column
 *
 * @method     ChildSgpiOutSummary requirePk($key, ?ConnectionInterface $con = null) Return the ChildSgpiOutSummary by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiOutSummary requireOne(?ConnectionInterface $con = null) Return the first ChildSgpiOutSummary matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSgpiOutSummary requireOneByUniqueid(string $uniqueid) Return the first ChildSgpiOutSummary filtered by the uniqueid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiOutSummary requireOneByMoye(string $moye) Return the first ChildSgpiOutSummary filtered by the moye column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiOutSummary requireOneByTerritoryId(int $territory_id) Return the first ChildSgpiOutSummary filtered by the territory_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiOutSummary requireOneByOutletOrgdataId(int $outlet_orgdata_id) Return the first ChildSgpiOutSummary filtered by the outlet_orgdata_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiOutSummary requireOneBySgpiType(string $sgpi_type) Return the first ChildSgpiOutSummary filtered by the sgpi_type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiOutSummary requireOneByQty(int $qty) Return the first ChildSgpiOutSummary filtered by the qty column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiOutSummary requireOneByLastcreate(string $lastcreate) Return the first ChildSgpiOutSummary filtered by the lastcreate column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSgpiOutSummary[]|Collection find(?ConnectionInterface $con = null) Return ChildSgpiOutSummary objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSgpiOutSummary> find(?ConnectionInterface $con = null) Return ChildSgpiOutSummary objects based on current ModelCriteria
 *
 * @method     ChildSgpiOutSummary[]|Collection findByUniqueid(string|array<string> $uniqueid) Return ChildSgpiOutSummary objects filtered by the uniqueid column
 * @psalm-method Collection&\Traversable<ChildSgpiOutSummary> findByUniqueid(string|array<string> $uniqueid) Return ChildSgpiOutSummary objects filtered by the uniqueid column
 * @method     ChildSgpiOutSummary[]|Collection findByMoye(string|array<string> $moye) Return ChildSgpiOutSummary objects filtered by the moye column
 * @psalm-method Collection&\Traversable<ChildSgpiOutSummary> findByMoye(string|array<string> $moye) Return ChildSgpiOutSummary objects filtered by the moye column
 * @method     ChildSgpiOutSummary[]|Collection findByTerritoryId(int|array<int> $territory_id) Return ChildSgpiOutSummary objects filtered by the territory_id column
 * @psalm-method Collection&\Traversable<ChildSgpiOutSummary> findByTerritoryId(int|array<int> $territory_id) Return ChildSgpiOutSummary objects filtered by the territory_id column
 * @method     ChildSgpiOutSummary[]|Collection findByOutletOrgdataId(int|array<int> $outlet_orgdata_id) Return ChildSgpiOutSummary objects filtered by the outlet_orgdata_id column
 * @psalm-method Collection&\Traversable<ChildSgpiOutSummary> findByOutletOrgdataId(int|array<int> $outlet_orgdata_id) Return ChildSgpiOutSummary objects filtered by the outlet_orgdata_id column
 * @method     ChildSgpiOutSummary[]|Collection findBySgpiType(string|array<string> $sgpi_type) Return ChildSgpiOutSummary objects filtered by the sgpi_type column
 * @psalm-method Collection&\Traversable<ChildSgpiOutSummary> findBySgpiType(string|array<string> $sgpi_type) Return ChildSgpiOutSummary objects filtered by the sgpi_type column
 * @method     ChildSgpiOutSummary[]|Collection findByQty(int|array<int> $qty) Return ChildSgpiOutSummary objects filtered by the qty column
 * @psalm-method Collection&\Traversable<ChildSgpiOutSummary> findByQty(int|array<int> $qty) Return ChildSgpiOutSummary objects filtered by the qty column
 * @method     ChildSgpiOutSummary[]|Collection findByLastcreate(string|array<string> $lastcreate) Return ChildSgpiOutSummary objects filtered by the lastcreate column
 * @psalm-method Collection&\Traversable<ChildSgpiOutSummary> findByLastcreate(string|array<string> $lastcreate) Return ChildSgpiOutSummary objects filtered by the lastcreate column
 *
 * @method     ChildSgpiOutSummary[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSgpiOutSummary> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SgpiOutSummaryQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\SgpiOutSummaryQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\SgpiOutSummary', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSgpiOutSummaryQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSgpiOutSummaryQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSgpiOutSummaryQuery) {
            return $criteria;
        }
        $query = new ChildSgpiOutSummaryQuery();
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
     * @return ChildSgpiOutSummary|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SgpiOutSummaryTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = SgpiOutSummaryTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSgpiOutSummary A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT uniqueid, moye, territory_id, outlet_orgdata_id, sgpi_type, qty, lastcreate FROM sgpi_out_summary WHERE uniqueid = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildSgpiOutSummary $obj */
            $obj = new ChildSgpiOutSummary();
            $obj->hydrate($row);
            SgpiOutSummaryTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSgpiOutSummary|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SgpiOutSummaryTableMap::COL_UNIQUEID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SgpiOutSummaryTableMap::COL_UNIQUEID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the uniqueid column
     *
     * Example usage:
     * <code>
     * $query->filterByUniqueid('fooValue');   // WHERE uniqueid = 'fooValue'
     * $query->filterByUniqueid('%fooValue%', Criteria::LIKE); // WHERE uniqueid LIKE '%fooValue%'
     * $query->filterByUniqueid(['foo', 'bar']); // WHERE uniqueid IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $uniqueid The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUniqueid($uniqueid = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($uniqueid)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiOutSummaryTableMap::COL_UNIQUEID, $uniqueid, $comparison);

        return $this;
    }

    /**
     * Filter the query on the moye column
     *
     * Example usage:
     * <code>
     * $query->filterByMoye('fooValue');   // WHERE moye = 'fooValue'
     * $query->filterByMoye('%fooValue%', Criteria::LIKE); // WHERE moye LIKE '%fooValue%'
     * $query->filterByMoye(['foo', 'bar']); // WHERE moye IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $moye The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMoye($moye = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($moye)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiOutSummaryTableMap::COL_MOYE, $moye, $comparison);

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
                $this->addUsingAlias(SgpiOutSummaryTableMap::COL_TERRITORY_ID, $territoryId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($territoryId['max'])) {
                $this->addUsingAlias(SgpiOutSummaryTableMap::COL_TERRITORY_ID, $territoryId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiOutSummaryTableMap::COL_TERRITORY_ID, $territoryId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_orgdata_id column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletOrgdataId(1234); // WHERE outlet_orgdata_id = 1234
     * $query->filterByOutletOrgdataId(array(12, 34)); // WHERE outlet_orgdata_id IN (12, 34)
     * $query->filterByOutletOrgdataId(array('min' => 12)); // WHERE outlet_orgdata_id > 12
     * </code>
     *
     * @param mixed $outletOrgdataId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletOrgdataId($outletOrgdataId = null, ?string $comparison = null)
    {
        if (is_array($outletOrgdataId)) {
            $useMinMax = false;
            if (isset($outletOrgdataId['min'])) {
                $this->addUsingAlias(SgpiOutSummaryTableMap::COL_OUTLET_ORGDATA_ID, $outletOrgdataId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outletOrgdataId['max'])) {
                $this->addUsingAlias(SgpiOutSummaryTableMap::COL_OUTLET_ORGDATA_ID, $outletOrgdataId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiOutSummaryTableMap::COL_OUTLET_ORGDATA_ID, $outletOrgdataId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the sgpi_type column
     *
     * Example usage:
     * <code>
     * $query->filterBySgpiType('fooValue');   // WHERE sgpi_type = 'fooValue'
     * $query->filterBySgpiType('%fooValue%', Criteria::LIKE); // WHERE sgpi_type LIKE '%fooValue%'
     * $query->filterBySgpiType(['foo', 'bar']); // WHERE sgpi_type IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $sgpiType The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySgpiType($sgpiType = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($sgpiType)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiOutSummaryTableMap::COL_SGPI_TYPE, $sgpiType, $comparison);

        return $this;
    }

    /**
     * Filter the query on the qty column
     *
     * Example usage:
     * <code>
     * $query->filterByQty(1234); // WHERE qty = 1234
     * $query->filterByQty(array(12, 34)); // WHERE qty IN (12, 34)
     * $query->filterByQty(array('min' => 12)); // WHERE qty > 12
     * </code>
     *
     * @param mixed $qty The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByQty($qty = null, ?string $comparison = null)
    {
        if (is_array($qty)) {
            $useMinMax = false;
            if (isset($qty['min'])) {
                $this->addUsingAlias(SgpiOutSummaryTableMap::COL_QTY, $qty['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($qty['max'])) {
                $this->addUsingAlias(SgpiOutSummaryTableMap::COL_QTY, $qty['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiOutSummaryTableMap::COL_QTY, $qty, $comparison);

        return $this;
    }

    /**
     * Filter the query on the lastcreate column
     *
     * Example usage:
     * <code>
     * $query->filterByLastcreate('2011-03-14'); // WHERE lastcreate = '2011-03-14'
     * $query->filterByLastcreate('now'); // WHERE lastcreate = '2011-03-14'
     * $query->filterByLastcreate(array('max' => 'yesterday')); // WHERE lastcreate > '2011-03-13'
     * </code>
     *
     * @param mixed $lastcreate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLastcreate($lastcreate = null, ?string $comparison = null)
    {
        if (is_array($lastcreate)) {
            $useMinMax = false;
            if (isset($lastcreate['min'])) {
                $this->addUsingAlias(SgpiOutSummaryTableMap::COL_LASTCREATE, $lastcreate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastcreate['max'])) {
                $this->addUsingAlias(SgpiOutSummaryTableMap::COL_LASTCREATE, $lastcreate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiOutSummaryTableMap::COL_LASTCREATE, $lastcreate, $comparison);

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSgpiOutSummary $sgpiOutSummary Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($sgpiOutSummary = null)
    {
        if ($sgpiOutSummary) {
            $this->addUsingAlias(SgpiOutSummaryTableMap::COL_UNIQUEID, $sgpiOutSummary->getUniqueid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
