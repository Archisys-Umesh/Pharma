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
use entities\TownCorrection as ChildTownCorrection;
use entities\TownCorrectionQuery as ChildTownCorrectionQuery;
use entities\Map\TownCorrectionTableMap;

/**
 * Base class that represents a query for the `town_correction` table.
 *
 * @method     ChildTownCorrectionQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildTownCorrectionQuery orderByStateId($order = Criteria::ASC) Order by the state_id column
 * @method     ChildTownCorrectionQuery orderByStateName($order = Criteria::ASC) Order by the state_name column
 * @method     ChildTownCorrectionQuery orderByCityId($order = Criteria::ASC) Order by the city_id column
 * @method     ChildTownCorrectionQuery orderByCityName($order = Criteria::ASC) Order by the city_name column
 * @method     ChildTownCorrectionQuery orderByTownId($order = Criteria::ASC) Order by the town_id column
 * @method     ChildTownCorrectionQuery orderByTownName($order = Criteria::ASC) Order by the town_name column
 * @method     ChildTownCorrectionQuery orderByUniqueTownCode($order = Criteria::ASC) Order by the unique_town_code column
 * @method     ChildTownCorrectionQuery orderByToBeRemoved($order = Criteria::ASC) Order by the to_be_removed column
 *
 * @method     ChildTownCorrectionQuery groupById() Group by the id column
 * @method     ChildTownCorrectionQuery groupByStateId() Group by the state_id column
 * @method     ChildTownCorrectionQuery groupByStateName() Group by the state_name column
 * @method     ChildTownCorrectionQuery groupByCityId() Group by the city_id column
 * @method     ChildTownCorrectionQuery groupByCityName() Group by the city_name column
 * @method     ChildTownCorrectionQuery groupByTownId() Group by the town_id column
 * @method     ChildTownCorrectionQuery groupByTownName() Group by the town_name column
 * @method     ChildTownCorrectionQuery groupByUniqueTownCode() Group by the unique_town_code column
 * @method     ChildTownCorrectionQuery groupByToBeRemoved() Group by the to_be_removed column
 *
 * @method     ChildTownCorrectionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildTownCorrectionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildTownCorrectionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildTownCorrectionQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildTownCorrectionQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildTownCorrectionQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildTownCorrection|null findOne(?ConnectionInterface $con = null) Return the first ChildTownCorrection matching the query
 * @method     ChildTownCorrection findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildTownCorrection matching the query, or a new ChildTownCorrection object populated from the query conditions when no match is found
 *
 * @method     ChildTownCorrection|null findOneById(int $id) Return the first ChildTownCorrection filtered by the id column
 * @method     ChildTownCorrection|null findOneByStateId(int $state_id) Return the first ChildTownCorrection filtered by the state_id column
 * @method     ChildTownCorrection|null findOneByStateName(string $state_name) Return the first ChildTownCorrection filtered by the state_name column
 * @method     ChildTownCorrection|null findOneByCityId(int $city_id) Return the first ChildTownCorrection filtered by the city_id column
 * @method     ChildTownCorrection|null findOneByCityName(string $city_name) Return the first ChildTownCorrection filtered by the city_name column
 * @method     ChildTownCorrection|null findOneByTownId(int $town_id) Return the first ChildTownCorrection filtered by the town_id column
 * @method     ChildTownCorrection|null findOneByTownName(string $town_name) Return the first ChildTownCorrection filtered by the town_name column
 * @method     ChildTownCorrection|null findOneByUniqueTownCode(int $unique_town_code) Return the first ChildTownCorrection filtered by the unique_town_code column
 * @method     ChildTownCorrection|null findOneByToBeRemoved(boolean $to_be_removed) Return the first ChildTownCorrection filtered by the to_be_removed column
 *
 * @method     ChildTownCorrection requirePk($key, ?ConnectionInterface $con = null) Return the ChildTownCorrection by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTownCorrection requireOne(?ConnectionInterface $con = null) Return the first ChildTownCorrection matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTownCorrection requireOneById(int $id) Return the first ChildTownCorrection filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTownCorrection requireOneByStateId(int $state_id) Return the first ChildTownCorrection filtered by the state_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTownCorrection requireOneByStateName(string $state_name) Return the first ChildTownCorrection filtered by the state_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTownCorrection requireOneByCityId(int $city_id) Return the first ChildTownCorrection filtered by the city_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTownCorrection requireOneByCityName(string $city_name) Return the first ChildTownCorrection filtered by the city_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTownCorrection requireOneByTownId(int $town_id) Return the first ChildTownCorrection filtered by the town_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTownCorrection requireOneByTownName(string $town_name) Return the first ChildTownCorrection filtered by the town_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTownCorrection requireOneByUniqueTownCode(int $unique_town_code) Return the first ChildTownCorrection filtered by the unique_town_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTownCorrection requireOneByToBeRemoved(boolean $to_be_removed) Return the first ChildTownCorrection filtered by the to_be_removed column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTownCorrection[]|Collection find(?ConnectionInterface $con = null) Return ChildTownCorrection objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildTownCorrection> find(?ConnectionInterface $con = null) Return ChildTownCorrection objects based on current ModelCriteria
 *
 * @method     ChildTownCorrection[]|Collection findById(int|array<int> $id) Return ChildTownCorrection objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildTownCorrection> findById(int|array<int> $id) Return ChildTownCorrection objects filtered by the id column
 * @method     ChildTownCorrection[]|Collection findByStateId(int|array<int> $state_id) Return ChildTownCorrection objects filtered by the state_id column
 * @psalm-method Collection&\Traversable<ChildTownCorrection> findByStateId(int|array<int> $state_id) Return ChildTownCorrection objects filtered by the state_id column
 * @method     ChildTownCorrection[]|Collection findByStateName(string|array<string> $state_name) Return ChildTownCorrection objects filtered by the state_name column
 * @psalm-method Collection&\Traversable<ChildTownCorrection> findByStateName(string|array<string> $state_name) Return ChildTownCorrection objects filtered by the state_name column
 * @method     ChildTownCorrection[]|Collection findByCityId(int|array<int> $city_id) Return ChildTownCorrection objects filtered by the city_id column
 * @psalm-method Collection&\Traversable<ChildTownCorrection> findByCityId(int|array<int> $city_id) Return ChildTownCorrection objects filtered by the city_id column
 * @method     ChildTownCorrection[]|Collection findByCityName(string|array<string> $city_name) Return ChildTownCorrection objects filtered by the city_name column
 * @psalm-method Collection&\Traversable<ChildTownCorrection> findByCityName(string|array<string> $city_name) Return ChildTownCorrection objects filtered by the city_name column
 * @method     ChildTownCorrection[]|Collection findByTownId(int|array<int> $town_id) Return ChildTownCorrection objects filtered by the town_id column
 * @psalm-method Collection&\Traversable<ChildTownCorrection> findByTownId(int|array<int> $town_id) Return ChildTownCorrection objects filtered by the town_id column
 * @method     ChildTownCorrection[]|Collection findByTownName(string|array<string> $town_name) Return ChildTownCorrection objects filtered by the town_name column
 * @psalm-method Collection&\Traversable<ChildTownCorrection> findByTownName(string|array<string> $town_name) Return ChildTownCorrection objects filtered by the town_name column
 * @method     ChildTownCorrection[]|Collection findByUniqueTownCode(int|array<int> $unique_town_code) Return ChildTownCorrection objects filtered by the unique_town_code column
 * @psalm-method Collection&\Traversable<ChildTownCorrection> findByUniqueTownCode(int|array<int> $unique_town_code) Return ChildTownCorrection objects filtered by the unique_town_code column
 * @method     ChildTownCorrection[]|Collection findByToBeRemoved(boolean|array<boolean> $to_be_removed) Return ChildTownCorrection objects filtered by the to_be_removed column
 * @psalm-method Collection&\Traversable<ChildTownCorrection> findByToBeRemoved(boolean|array<boolean> $to_be_removed) Return ChildTownCorrection objects filtered by the to_be_removed column
 *
 * @method     ChildTownCorrection[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildTownCorrection> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class TownCorrectionQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\TownCorrectionQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\TownCorrection', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildTownCorrectionQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildTownCorrectionQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildTownCorrectionQuery) {
            return $criteria;
        }
        $query = new ChildTownCorrectionQuery();
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
     * @return ChildTownCorrection|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(TownCorrectionTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = TownCorrectionTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildTownCorrection A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, state_id, state_name, city_id, city_name, town_id, town_name, unique_town_code, to_be_removed FROM town_correction WHERE id = :p0';
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
            /** @var ChildTownCorrection $obj */
            $obj = new ChildTownCorrection();
            $obj->hydrate($row);
            TownCorrectionTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildTownCorrection|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(TownCorrectionTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(TownCorrectionTableMap::COL_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(TownCorrectionTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(TownCorrectionTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TownCorrectionTableMap::COL_ID, $id, $comparison);

        return $this;
    }

    /**
     * Filter the query on the state_id column
     *
     * Example usage:
     * <code>
     * $query->filterByStateId(1234); // WHERE state_id = 1234
     * $query->filterByStateId(array(12, 34)); // WHERE state_id IN (12, 34)
     * $query->filterByStateId(array('min' => 12)); // WHERE state_id > 12
     * </code>
     *
     * @param mixed $stateId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStateId($stateId = null, ?string $comparison = null)
    {
        if (is_array($stateId)) {
            $useMinMax = false;
            if (isset($stateId['min'])) {
                $this->addUsingAlias(TownCorrectionTableMap::COL_STATE_ID, $stateId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($stateId['max'])) {
                $this->addUsingAlias(TownCorrectionTableMap::COL_STATE_ID, $stateId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TownCorrectionTableMap::COL_STATE_ID, $stateId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the state_name column
     *
     * Example usage:
     * <code>
     * $query->filterByStateName('fooValue');   // WHERE state_name = 'fooValue'
     * $query->filterByStateName('%fooValue%', Criteria::LIKE); // WHERE state_name LIKE '%fooValue%'
     * $query->filterByStateName(['foo', 'bar']); // WHERE state_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $stateName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStateName($stateName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($stateName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TownCorrectionTableMap::COL_STATE_NAME, $stateName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the city_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCityId(1234); // WHERE city_id = 1234
     * $query->filterByCityId(array(12, 34)); // WHERE city_id IN (12, 34)
     * $query->filterByCityId(array('min' => 12)); // WHERE city_id > 12
     * </code>
     *
     * @param mixed $cityId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCityId($cityId = null, ?string $comparison = null)
    {
        if (is_array($cityId)) {
            $useMinMax = false;
            if (isset($cityId['min'])) {
                $this->addUsingAlias(TownCorrectionTableMap::COL_CITY_ID, $cityId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($cityId['max'])) {
                $this->addUsingAlias(TownCorrectionTableMap::COL_CITY_ID, $cityId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TownCorrectionTableMap::COL_CITY_ID, $cityId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the city_name column
     *
     * Example usage:
     * <code>
     * $query->filterByCityName('fooValue');   // WHERE city_name = 'fooValue'
     * $query->filterByCityName('%fooValue%', Criteria::LIKE); // WHERE city_name LIKE '%fooValue%'
     * $query->filterByCityName(['foo', 'bar']); // WHERE city_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $cityName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCityName($cityName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cityName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TownCorrectionTableMap::COL_CITY_NAME, $cityName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the town_id column
     *
     * Example usage:
     * <code>
     * $query->filterByTownId(1234); // WHERE town_id = 1234
     * $query->filterByTownId(array(12, 34)); // WHERE town_id IN (12, 34)
     * $query->filterByTownId(array('min' => 12)); // WHERE town_id > 12
     * </code>
     *
     * @param mixed $townId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTownId($townId = null, ?string $comparison = null)
    {
        if (is_array($townId)) {
            $useMinMax = false;
            if (isset($townId['min'])) {
                $this->addUsingAlias(TownCorrectionTableMap::COL_TOWN_ID, $townId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($townId['max'])) {
                $this->addUsingAlias(TownCorrectionTableMap::COL_TOWN_ID, $townId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TownCorrectionTableMap::COL_TOWN_ID, $townId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the town_name column
     *
     * Example usage:
     * <code>
     * $query->filterByTownName('fooValue');   // WHERE town_name = 'fooValue'
     * $query->filterByTownName('%fooValue%', Criteria::LIKE); // WHERE town_name LIKE '%fooValue%'
     * $query->filterByTownName(['foo', 'bar']); // WHERE town_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $townName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTownName($townName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($townName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TownCorrectionTableMap::COL_TOWN_NAME, $townName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the unique_town_code column
     *
     * Example usage:
     * <code>
     * $query->filterByUniqueTownCode(1234); // WHERE unique_town_code = 1234
     * $query->filterByUniqueTownCode(array(12, 34)); // WHERE unique_town_code IN (12, 34)
     * $query->filterByUniqueTownCode(array('min' => 12)); // WHERE unique_town_code > 12
     * </code>
     *
     * @param mixed $uniqueTownCode The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUniqueTownCode($uniqueTownCode = null, ?string $comparison = null)
    {
        if (is_array($uniqueTownCode)) {
            $useMinMax = false;
            if (isset($uniqueTownCode['min'])) {
                $this->addUsingAlias(TownCorrectionTableMap::COL_UNIQUE_TOWN_CODE, $uniqueTownCode['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($uniqueTownCode['max'])) {
                $this->addUsingAlias(TownCorrectionTableMap::COL_UNIQUE_TOWN_CODE, $uniqueTownCode['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TownCorrectionTableMap::COL_UNIQUE_TOWN_CODE, $uniqueTownCode, $comparison);

        return $this;
    }

    /**
     * Filter the query on the to_be_removed column
     *
     * Example usage:
     * <code>
     * $query->filterByToBeRemoved(true); // WHERE to_be_removed = true
     * $query->filterByToBeRemoved('yes'); // WHERE to_be_removed = true
     * </code>
     *
     * @param bool|string $toBeRemoved The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByToBeRemoved($toBeRemoved = null, ?string $comparison = null)
    {
        if (is_string($toBeRemoved)) {
            $toBeRemoved = in_array(strtolower($toBeRemoved), array('false', 'off', '-', 'no', 'n', '0', ''), true) ? false : true;
        }

        $this->addUsingAlias(TownCorrectionTableMap::COL_TO_BE_REMOVED, $toBeRemoved, $comparison);

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildTownCorrection $townCorrection Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($townCorrection = null)
    {
        if ($townCorrection) {
            $this->addUsingAlias(TownCorrectionTableMap::COL_ID, $townCorrection->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the town_correction table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(TownCorrectionTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            TownCorrectionTableMap::clearInstancePool();
            TownCorrectionTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(TownCorrectionTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(TownCorrectionTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            TownCorrectionTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            TownCorrectionTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
