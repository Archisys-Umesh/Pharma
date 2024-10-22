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
use entities\BeatCorrection as ChildBeatCorrection;
use entities\BeatCorrectionQuery as ChildBeatCorrectionQuery;
use entities\Map\BeatCorrectionTableMap;

/**
 * Base class that represents a query for the `beat_correction` table.
 *
 * @method     ChildBeatCorrectionQuery orderByOnBoardRequestAddressId($order = Criteria::ASC) Order by the on_board_request_address_id column
 * @method     ChildBeatCorrectionQuery orderByTerritory($order = Criteria::ASC) Order by the territory column
 * @method     ChildBeatCorrectionQuery orderByObraUnitName($order = Criteria::ASC) Order by the obra_unit_name column
 * @method     ChildBeatCorrectionQuery orderByFirstName($order = Criteria::ASC) Order by the first_name column
 * @method     ChildBeatCorrectionQuery orderByLastName($order = Criteria::ASC) Order by the last_name column
 * @method     ChildBeatCorrectionQuery orderByAddress($order = Criteria::ASC) Order by the address column
 * @method     ChildBeatCorrectionQuery orderByBeatUnitName($order = Criteria::ASC) Order by the beat_unit_name column
 * @method     ChildBeatCorrectionQuery orderByBeatName($order = Criteria::ASC) Order by the beat_name column
 * @method     ChildBeatCorrectionQuery orderByBeatOptions($order = Criteria::ASC) Order by the beat_options column
 * @method     ChildBeatCorrectionQuery orderByCorrectBeatName($order = Criteria::ASC) Order by the correct_beat_name column
 * @method     ChildBeatCorrectionQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method     ChildBeatCorrectionQuery orderByBeatOrgUnitId($order = Criteria::ASC) Order by the beat_org_unit_id column
 *
 * @method     ChildBeatCorrectionQuery groupByOnBoardRequestAddressId() Group by the on_board_request_address_id column
 * @method     ChildBeatCorrectionQuery groupByTerritory() Group by the territory column
 * @method     ChildBeatCorrectionQuery groupByObraUnitName() Group by the obra_unit_name column
 * @method     ChildBeatCorrectionQuery groupByFirstName() Group by the first_name column
 * @method     ChildBeatCorrectionQuery groupByLastName() Group by the last_name column
 * @method     ChildBeatCorrectionQuery groupByAddress() Group by the address column
 * @method     ChildBeatCorrectionQuery groupByBeatUnitName() Group by the beat_unit_name column
 * @method     ChildBeatCorrectionQuery groupByBeatName() Group by the beat_name column
 * @method     ChildBeatCorrectionQuery groupByBeatOptions() Group by the beat_options column
 * @method     ChildBeatCorrectionQuery groupByCorrectBeatName() Group by the correct_beat_name column
 * @method     ChildBeatCorrectionQuery groupByStatus() Group by the status column
 * @method     ChildBeatCorrectionQuery groupByBeatOrgUnitId() Group by the beat_org_unit_id column
 *
 * @method     ChildBeatCorrectionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildBeatCorrectionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildBeatCorrectionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildBeatCorrectionQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildBeatCorrectionQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildBeatCorrectionQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildBeatCorrection|null findOne(?ConnectionInterface $con = null) Return the first ChildBeatCorrection matching the query
 * @method     ChildBeatCorrection findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildBeatCorrection matching the query, or a new ChildBeatCorrection object populated from the query conditions when no match is found
 *
 * @method     ChildBeatCorrection|null findOneByOnBoardRequestAddressId(int $on_board_request_address_id) Return the first ChildBeatCorrection filtered by the on_board_request_address_id column
 * @method     ChildBeatCorrection|null findOneByTerritory(int $territory) Return the first ChildBeatCorrection filtered by the territory column
 * @method     ChildBeatCorrection|null findOneByObraUnitName(string $obra_unit_name) Return the first ChildBeatCorrection filtered by the obra_unit_name column
 * @method     ChildBeatCorrection|null findOneByFirstName(string $first_name) Return the first ChildBeatCorrection filtered by the first_name column
 * @method     ChildBeatCorrection|null findOneByLastName(string $last_name) Return the first ChildBeatCorrection filtered by the last_name column
 * @method     ChildBeatCorrection|null findOneByAddress(string $address) Return the first ChildBeatCorrection filtered by the address column
 * @method     ChildBeatCorrection|null findOneByBeatUnitName(string $beat_unit_name) Return the first ChildBeatCorrection filtered by the beat_unit_name column
 * @method     ChildBeatCorrection|null findOneByBeatName(string $beat_name) Return the first ChildBeatCorrection filtered by the beat_name column
 * @method     ChildBeatCorrection|null findOneByBeatOptions(string $beat_options) Return the first ChildBeatCorrection filtered by the beat_options column
 * @method     ChildBeatCorrection|null findOneByCorrectBeatName(string $correct_beat_name) Return the first ChildBeatCorrection filtered by the correct_beat_name column
 * @method     ChildBeatCorrection|null findOneByStatus(int $status) Return the first ChildBeatCorrection filtered by the status column
 * @method     ChildBeatCorrection|null findOneByBeatOrgUnitId(int $beat_org_unit_id) Return the first ChildBeatCorrection filtered by the beat_org_unit_id column
 *
 * @method     ChildBeatCorrection requirePk($key, ?ConnectionInterface $con = null) Return the ChildBeatCorrection by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBeatCorrection requireOne(?ConnectionInterface $con = null) Return the first ChildBeatCorrection matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBeatCorrection requireOneByOnBoardRequestAddressId(int $on_board_request_address_id) Return the first ChildBeatCorrection filtered by the on_board_request_address_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBeatCorrection requireOneByTerritory(int $territory) Return the first ChildBeatCorrection filtered by the territory column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBeatCorrection requireOneByObraUnitName(string $obra_unit_name) Return the first ChildBeatCorrection filtered by the obra_unit_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBeatCorrection requireOneByFirstName(string $first_name) Return the first ChildBeatCorrection filtered by the first_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBeatCorrection requireOneByLastName(string $last_name) Return the first ChildBeatCorrection filtered by the last_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBeatCorrection requireOneByAddress(string $address) Return the first ChildBeatCorrection filtered by the address column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBeatCorrection requireOneByBeatUnitName(string $beat_unit_name) Return the first ChildBeatCorrection filtered by the beat_unit_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBeatCorrection requireOneByBeatName(string $beat_name) Return the first ChildBeatCorrection filtered by the beat_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBeatCorrection requireOneByBeatOptions(string $beat_options) Return the first ChildBeatCorrection filtered by the beat_options column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBeatCorrection requireOneByCorrectBeatName(string $correct_beat_name) Return the first ChildBeatCorrection filtered by the correct_beat_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBeatCorrection requireOneByStatus(int $status) Return the first ChildBeatCorrection filtered by the status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBeatCorrection requireOneByBeatOrgUnitId(int $beat_org_unit_id) Return the first ChildBeatCorrection filtered by the beat_org_unit_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBeatCorrection[]|Collection find(?ConnectionInterface $con = null) Return ChildBeatCorrection objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildBeatCorrection> find(?ConnectionInterface $con = null) Return ChildBeatCorrection objects based on current ModelCriteria
 *
 * @method     ChildBeatCorrection[]|Collection findByOnBoardRequestAddressId(int|array<int> $on_board_request_address_id) Return ChildBeatCorrection objects filtered by the on_board_request_address_id column
 * @psalm-method Collection&\Traversable<ChildBeatCorrection> findByOnBoardRequestAddressId(int|array<int> $on_board_request_address_id) Return ChildBeatCorrection objects filtered by the on_board_request_address_id column
 * @method     ChildBeatCorrection[]|Collection findByTerritory(int|array<int> $territory) Return ChildBeatCorrection objects filtered by the territory column
 * @psalm-method Collection&\Traversable<ChildBeatCorrection> findByTerritory(int|array<int> $territory) Return ChildBeatCorrection objects filtered by the territory column
 * @method     ChildBeatCorrection[]|Collection findByObraUnitName(string|array<string> $obra_unit_name) Return ChildBeatCorrection objects filtered by the obra_unit_name column
 * @psalm-method Collection&\Traversable<ChildBeatCorrection> findByObraUnitName(string|array<string> $obra_unit_name) Return ChildBeatCorrection objects filtered by the obra_unit_name column
 * @method     ChildBeatCorrection[]|Collection findByFirstName(string|array<string> $first_name) Return ChildBeatCorrection objects filtered by the first_name column
 * @psalm-method Collection&\Traversable<ChildBeatCorrection> findByFirstName(string|array<string> $first_name) Return ChildBeatCorrection objects filtered by the first_name column
 * @method     ChildBeatCorrection[]|Collection findByLastName(string|array<string> $last_name) Return ChildBeatCorrection objects filtered by the last_name column
 * @psalm-method Collection&\Traversable<ChildBeatCorrection> findByLastName(string|array<string> $last_name) Return ChildBeatCorrection objects filtered by the last_name column
 * @method     ChildBeatCorrection[]|Collection findByAddress(string|array<string> $address) Return ChildBeatCorrection objects filtered by the address column
 * @psalm-method Collection&\Traversable<ChildBeatCorrection> findByAddress(string|array<string> $address) Return ChildBeatCorrection objects filtered by the address column
 * @method     ChildBeatCorrection[]|Collection findByBeatUnitName(string|array<string> $beat_unit_name) Return ChildBeatCorrection objects filtered by the beat_unit_name column
 * @psalm-method Collection&\Traversable<ChildBeatCorrection> findByBeatUnitName(string|array<string> $beat_unit_name) Return ChildBeatCorrection objects filtered by the beat_unit_name column
 * @method     ChildBeatCorrection[]|Collection findByBeatName(string|array<string> $beat_name) Return ChildBeatCorrection objects filtered by the beat_name column
 * @psalm-method Collection&\Traversable<ChildBeatCorrection> findByBeatName(string|array<string> $beat_name) Return ChildBeatCorrection objects filtered by the beat_name column
 * @method     ChildBeatCorrection[]|Collection findByBeatOptions(string|array<string> $beat_options) Return ChildBeatCorrection objects filtered by the beat_options column
 * @psalm-method Collection&\Traversable<ChildBeatCorrection> findByBeatOptions(string|array<string> $beat_options) Return ChildBeatCorrection objects filtered by the beat_options column
 * @method     ChildBeatCorrection[]|Collection findByCorrectBeatName(string|array<string> $correct_beat_name) Return ChildBeatCorrection objects filtered by the correct_beat_name column
 * @psalm-method Collection&\Traversable<ChildBeatCorrection> findByCorrectBeatName(string|array<string> $correct_beat_name) Return ChildBeatCorrection objects filtered by the correct_beat_name column
 * @method     ChildBeatCorrection[]|Collection findByStatus(int|array<int> $status) Return ChildBeatCorrection objects filtered by the status column
 * @psalm-method Collection&\Traversable<ChildBeatCorrection> findByStatus(int|array<int> $status) Return ChildBeatCorrection objects filtered by the status column
 * @method     ChildBeatCorrection[]|Collection findByBeatOrgUnitId(int|array<int> $beat_org_unit_id) Return ChildBeatCorrection objects filtered by the beat_org_unit_id column
 * @psalm-method Collection&\Traversable<ChildBeatCorrection> findByBeatOrgUnitId(int|array<int> $beat_org_unit_id) Return ChildBeatCorrection objects filtered by the beat_org_unit_id column
 *
 * @method     ChildBeatCorrection[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildBeatCorrection> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class BeatCorrectionQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\BeatCorrectionQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\BeatCorrection', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildBeatCorrectionQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildBeatCorrectionQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildBeatCorrectionQuery) {
            return $criteria;
        }
        $query = new ChildBeatCorrectionQuery();
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
     * @return ChildBeatCorrection|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(BeatCorrectionTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = BeatCorrectionTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildBeatCorrection A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT on_board_request_address_id, territory, obra_unit_name, first_name, last_name, address, beat_unit_name, beat_name, beat_options, correct_beat_name, status, beat_org_unit_id FROM beat_correction WHERE on_board_request_address_id = :p0';
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
            /** @var ChildBeatCorrection $obj */
            $obj = new ChildBeatCorrection();
            $obj->hydrate($row);
            BeatCorrectionTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildBeatCorrection|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(BeatCorrectionTableMap::COL_ON_BOARD_REQUEST_ADDRESS_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(BeatCorrectionTableMap::COL_ON_BOARD_REQUEST_ADDRESS_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the on_board_request_address_id column
     *
     * Example usage:
     * <code>
     * $query->filterByOnBoardRequestAddressId(1234); // WHERE on_board_request_address_id = 1234
     * $query->filterByOnBoardRequestAddressId(array(12, 34)); // WHERE on_board_request_address_id IN (12, 34)
     * $query->filterByOnBoardRequestAddressId(array('min' => 12)); // WHERE on_board_request_address_id > 12
     * </code>
     *
     * @param mixed $onBoardRequestAddressId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOnBoardRequestAddressId($onBoardRequestAddressId = null, ?string $comparison = null)
    {
        if (is_array($onBoardRequestAddressId)) {
            $useMinMax = false;
            if (isset($onBoardRequestAddressId['min'])) {
                $this->addUsingAlias(BeatCorrectionTableMap::COL_ON_BOARD_REQUEST_ADDRESS_ID, $onBoardRequestAddressId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($onBoardRequestAddressId['max'])) {
                $this->addUsingAlias(BeatCorrectionTableMap::COL_ON_BOARD_REQUEST_ADDRESS_ID, $onBoardRequestAddressId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BeatCorrectionTableMap::COL_ON_BOARD_REQUEST_ADDRESS_ID, $onBoardRequestAddressId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the territory column
     *
     * Example usage:
     * <code>
     * $query->filterByTerritory(1234); // WHERE territory = 1234
     * $query->filterByTerritory(array(12, 34)); // WHERE territory IN (12, 34)
     * $query->filterByTerritory(array('min' => 12)); // WHERE territory > 12
     * </code>
     *
     * @param mixed $territory The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTerritory($territory = null, ?string $comparison = null)
    {
        if (is_array($territory)) {
            $useMinMax = false;
            if (isset($territory['min'])) {
                $this->addUsingAlias(BeatCorrectionTableMap::COL_TERRITORY, $territory['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($territory['max'])) {
                $this->addUsingAlias(BeatCorrectionTableMap::COL_TERRITORY, $territory['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BeatCorrectionTableMap::COL_TERRITORY, $territory, $comparison);

        return $this;
    }

    /**
     * Filter the query on the obra_unit_name column
     *
     * Example usage:
     * <code>
     * $query->filterByObraUnitName('fooValue');   // WHERE obra_unit_name = 'fooValue'
     * $query->filterByObraUnitName('%fooValue%', Criteria::LIKE); // WHERE obra_unit_name LIKE '%fooValue%'
     * $query->filterByObraUnitName(['foo', 'bar']); // WHERE obra_unit_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $obraUnitName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByObraUnitName($obraUnitName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($obraUnitName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BeatCorrectionTableMap::COL_OBRA_UNIT_NAME, $obraUnitName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the first_name column
     *
     * Example usage:
     * <code>
     * $query->filterByFirstName('fooValue');   // WHERE first_name = 'fooValue'
     * $query->filterByFirstName('%fooValue%', Criteria::LIKE); // WHERE first_name LIKE '%fooValue%'
     * $query->filterByFirstName(['foo', 'bar']); // WHERE first_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $firstName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFirstName($firstName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($firstName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BeatCorrectionTableMap::COL_FIRST_NAME, $firstName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the last_name column
     *
     * Example usage:
     * <code>
     * $query->filterByLastName('fooValue');   // WHERE last_name = 'fooValue'
     * $query->filterByLastName('%fooValue%', Criteria::LIKE); // WHERE last_name LIKE '%fooValue%'
     * $query->filterByLastName(['foo', 'bar']); // WHERE last_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $lastName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLastName($lastName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($lastName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BeatCorrectionTableMap::COL_LAST_NAME, $lastName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the address column
     *
     * Example usage:
     * <code>
     * $query->filterByAddress('fooValue');   // WHERE address = 'fooValue'
     * $query->filterByAddress('%fooValue%', Criteria::LIKE); // WHERE address LIKE '%fooValue%'
     * $query->filterByAddress(['foo', 'bar']); // WHERE address IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $address The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAddress($address = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($address)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BeatCorrectionTableMap::COL_ADDRESS, $address, $comparison);

        return $this;
    }

    /**
     * Filter the query on the beat_unit_name column
     *
     * Example usage:
     * <code>
     * $query->filterByBeatUnitName('fooValue');   // WHERE beat_unit_name = 'fooValue'
     * $query->filterByBeatUnitName('%fooValue%', Criteria::LIKE); // WHERE beat_unit_name LIKE '%fooValue%'
     * $query->filterByBeatUnitName(['foo', 'bar']); // WHERE beat_unit_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $beatUnitName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBeatUnitName($beatUnitName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($beatUnitName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BeatCorrectionTableMap::COL_BEAT_UNIT_NAME, $beatUnitName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the beat_name column
     *
     * Example usage:
     * <code>
     * $query->filterByBeatName('fooValue');   // WHERE beat_name = 'fooValue'
     * $query->filterByBeatName('%fooValue%', Criteria::LIKE); // WHERE beat_name LIKE '%fooValue%'
     * $query->filterByBeatName(['foo', 'bar']); // WHERE beat_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $beatName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBeatName($beatName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($beatName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BeatCorrectionTableMap::COL_BEAT_NAME, $beatName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the beat_options column
     *
     * Example usage:
     * <code>
     * $query->filterByBeatOptions('fooValue');   // WHERE beat_options = 'fooValue'
     * $query->filterByBeatOptions('%fooValue%', Criteria::LIKE); // WHERE beat_options LIKE '%fooValue%'
     * $query->filterByBeatOptions(['foo', 'bar']); // WHERE beat_options IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $beatOptions The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBeatOptions($beatOptions = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($beatOptions)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BeatCorrectionTableMap::COL_BEAT_OPTIONS, $beatOptions, $comparison);

        return $this;
    }

    /**
     * Filter the query on the correct_beat_name column
     *
     * Example usage:
     * <code>
     * $query->filterByCorrectBeatName('fooValue');   // WHERE correct_beat_name = 'fooValue'
     * $query->filterByCorrectBeatName('%fooValue%', Criteria::LIKE); // WHERE correct_beat_name LIKE '%fooValue%'
     * $query->filterByCorrectBeatName(['foo', 'bar']); // WHERE correct_beat_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $correctBeatName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCorrectBeatName($correctBeatName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($correctBeatName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BeatCorrectionTableMap::COL_CORRECT_BEAT_NAME, $correctBeatName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the status column
     *
     * Example usage:
     * <code>
     * $query->filterByStatus(1234); // WHERE status = 1234
     * $query->filterByStatus(array(12, 34)); // WHERE status IN (12, 34)
     * $query->filterByStatus(array('min' => 12)); // WHERE status > 12
     * </code>
     *
     * @param mixed $status The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStatus($status = null, ?string $comparison = null)
    {
        if (is_array($status)) {
            $useMinMax = false;
            if (isset($status['min'])) {
                $this->addUsingAlias(BeatCorrectionTableMap::COL_STATUS, $status['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($status['max'])) {
                $this->addUsingAlias(BeatCorrectionTableMap::COL_STATUS, $status['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BeatCorrectionTableMap::COL_STATUS, $status, $comparison);

        return $this;
    }

    /**
     * Filter the query on the beat_org_unit_id column
     *
     * Example usage:
     * <code>
     * $query->filterByBeatOrgUnitId(1234); // WHERE beat_org_unit_id = 1234
     * $query->filterByBeatOrgUnitId(array(12, 34)); // WHERE beat_org_unit_id IN (12, 34)
     * $query->filterByBeatOrgUnitId(array('min' => 12)); // WHERE beat_org_unit_id > 12
     * </code>
     *
     * @param mixed $beatOrgUnitId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBeatOrgUnitId($beatOrgUnitId = null, ?string $comparison = null)
    {
        if (is_array($beatOrgUnitId)) {
            $useMinMax = false;
            if (isset($beatOrgUnitId['min'])) {
                $this->addUsingAlias(BeatCorrectionTableMap::COL_BEAT_ORG_UNIT_ID, $beatOrgUnitId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($beatOrgUnitId['max'])) {
                $this->addUsingAlias(BeatCorrectionTableMap::COL_BEAT_ORG_UNIT_ID, $beatOrgUnitId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BeatCorrectionTableMap::COL_BEAT_ORG_UNIT_ID, $beatOrgUnitId, $comparison);

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildBeatCorrection $beatCorrection Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($beatCorrection = null)
    {
        if ($beatCorrection) {
            $this->addUsingAlias(BeatCorrectionTableMap::COL_ON_BOARD_REQUEST_ADDRESS_ID, $beatCorrection->getOnBoardRequestAddressId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the beat_correction table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(BeatCorrectionTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            BeatCorrectionTableMap::clearInstancePool();
            BeatCorrectionTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(BeatCorrectionTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(BeatCorrectionTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            BeatCorrectionTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            BeatCorrectionTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
