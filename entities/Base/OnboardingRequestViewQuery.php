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
use entities\OnboardingRequestView as ChildOnboardingRequestView;
use entities\OnboardingRequestViewQuery as ChildOnboardingRequestViewQuery;
use entities\Map\OnboardingRequestViewTableMap;

/**
 * Base class that represents a query for the `onboarding_request_view` table.
 *
 * @method     ChildOnboardingRequestViewQuery orderByOnBoardRequestId($order = Criteria::ASC) Order by the on_board_request_id column
 * @method     ChildOnboardingRequestViewQuery orderByFirstName($order = Criteria::ASC) Order by the first_name column
 * @method     ChildOnboardingRequestViewQuery orderByLastName($order = Criteria::ASC) Order by the last_name column
 * @method     ChildOnboardingRequestViewQuery orderByOutletName($order = Criteria::ASC) Order by the outlet_name column
 * @method     ChildOnboardingRequestViewQuery orderByEmail($order = Criteria::ASC) Order by the email column
 * @method     ChildOnboardingRequestViewQuery orderByMobile($order = Criteria::ASC) Order by the mobile column
 * @method     ChildOnboardingRequestViewQuery orderByOutletTypeId($order = Criteria::ASC) Order by the outlet_type_id column
 * @method     ChildOnboardingRequestViewQuery orderByOutlettypeName($order = Criteria::ASC) Order by the outlettype_name column
 * @method     ChildOnboardingRequestViewQuery orderByTerritory($order = Criteria::ASC) Order by the territory column
 * @method     ChildOnboardingRequestViewQuery orderByTerritoryName($order = Criteria::ASC) Order by the territory_name column
 * @method     ChildOnboardingRequestViewQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildOnboardingRequestViewQuery orderByCreatedBy($order = Criteria::ASC) Order by the created_by column
 * @method     ChildOnboardingRequestViewQuery orderByOrgunitid($order = Criteria::ASC) Order by the orgunitid column
 * @method     ChildOnboardingRequestViewQuery orderByUnitName($order = Criteria::ASC) Order by the unit_name column
 * @method     ChildOnboardingRequestViewQuery orderByApprovedBy($order = Criteria::ASC) Order by the approved_by column
 * @method     ChildOnboardingRequestViewQuery orderByApprovedAt($order = Criteria::ASC) Order by the approved_at column
 * @method     ChildOnboardingRequestViewQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method     ChildOnboardingRequestViewQuery orderByOperations($order = Criteria::ASC) Order by the operations column
 *
 * @method     ChildOnboardingRequestViewQuery groupByOnBoardRequestId() Group by the on_board_request_id column
 * @method     ChildOnboardingRequestViewQuery groupByFirstName() Group by the first_name column
 * @method     ChildOnboardingRequestViewQuery groupByLastName() Group by the last_name column
 * @method     ChildOnboardingRequestViewQuery groupByOutletName() Group by the outlet_name column
 * @method     ChildOnboardingRequestViewQuery groupByEmail() Group by the email column
 * @method     ChildOnboardingRequestViewQuery groupByMobile() Group by the mobile column
 * @method     ChildOnboardingRequestViewQuery groupByOutletTypeId() Group by the outlet_type_id column
 * @method     ChildOnboardingRequestViewQuery groupByOutlettypeName() Group by the outlettype_name column
 * @method     ChildOnboardingRequestViewQuery groupByTerritory() Group by the territory column
 * @method     ChildOnboardingRequestViewQuery groupByTerritoryName() Group by the territory_name column
 * @method     ChildOnboardingRequestViewQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildOnboardingRequestViewQuery groupByCreatedBy() Group by the created_by column
 * @method     ChildOnboardingRequestViewQuery groupByOrgunitid() Group by the orgunitid column
 * @method     ChildOnboardingRequestViewQuery groupByUnitName() Group by the unit_name column
 * @method     ChildOnboardingRequestViewQuery groupByApprovedBy() Group by the approved_by column
 * @method     ChildOnboardingRequestViewQuery groupByApprovedAt() Group by the approved_at column
 * @method     ChildOnboardingRequestViewQuery groupByStatus() Group by the status column
 * @method     ChildOnboardingRequestViewQuery groupByOperations() Group by the operations column
 *
 * @method     ChildOnboardingRequestViewQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildOnboardingRequestViewQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildOnboardingRequestViewQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildOnboardingRequestViewQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildOnboardingRequestViewQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildOnboardingRequestViewQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildOnboardingRequestView|null findOne(?ConnectionInterface $con = null) Return the first ChildOnboardingRequestView matching the query
 * @method     ChildOnboardingRequestView findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildOnboardingRequestView matching the query, or a new ChildOnboardingRequestView object populated from the query conditions when no match is found
 *
 * @method     ChildOnboardingRequestView|null findOneByOnBoardRequestId(int $on_board_request_id) Return the first ChildOnboardingRequestView filtered by the on_board_request_id column
 * @method     ChildOnboardingRequestView|null findOneByFirstName(string $first_name) Return the first ChildOnboardingRequestView filtered by the first_name column
 * @method     ChildOnboardingRequestView|null findOneByLastName(string $last_name) Return the first ChildOnboardingRequestView filtered by the last_name column
 * @method     ChildOnboardingRequestView|null findOneByOutletName(string $outlet_name) Return the first ChildOnboardingRequestView filtered by the outlet_name column
 * @method     ChildOnboardingRequestView|null findOneByEmail(string $email) Return the first ChildOnboardingRequestView filtered by the email column
 * @method     ChildOnboardingRequestView|null findOneByMobile(string $mobile) Return the first ChildOnboardingRequestView filtered by the mobile column
 * @method     ChildOnboardingRequestView|null findOneByOutletTypeId(int $outlet_type_id) Return the first ChildOnboardingRequestView filtered by the outlet_type_id column
 * @method     ChildOnboardingRequestView|null findOneByOutlettypeName(string $outlettype_name) Return the first ChildOnboardingRequestView filtered by the outlettype_name column
 * @method     ChildOnboardingRequestView|null findOneByTerritory(int $territory) Return the first ChildOnboardingRequestView filtered by the territory column
 * @method     ChildOnboardingRequestView|null findOneByTerritoryName(string $territory_name) Return the first ChildOnboardingRequestView filtered by the territory_name column
 * @method     ChildOnboardingRequestView|null findOneByCreatedAt(string $created_at) Return the first ChildOnboardingRequestView filtered by the created_at column
 * @method     ChildOnboardingRequestView|null findOneByCreatedBy(string $created_by) Return the first ChildOnboardingRequestView filtered by the created_by column
 * @method     ChildOnboardingRequestView|null findOneByOrgunitid(int $orgunitid) Return the first ChildOnboardingRequestView filtered by the orgunitid column
 * @method     ChildOnboardingRequestView|null findOneByUnitName(string $unit_name) Return the first ChildOnboardingRequestView filtered by the unit_name column
 * @method     ChildOnboardingRequestView|null findOneByApprovedBy(string $approved_by) Return the first ChildOnboardingRequestView filtered by the approved_by column
 * @method     ChildOnboardingRequestView|null findOneByApprovedAt(string $approved_at) Return the first ChildOnboardingRequestView filtered by the approved_at column
 * @method     ChildOnboardingRequestView|null findOneByStatus(int $status) Return the first ChildOnboardingRequestView filtered by the status column
 * @method     ChildOnboardingRequestView|null findOneByOperations(string $operations) Return the first ChildOnboardingRequestView filtered by the operations column
 *
 * @method     ChildOnboardingRequestView requirePk($key, ?ConnectionInterface $con = null) Return the ChildOnboardingRequestView by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnboardingRequestView requireOne(?ConnectionInterface $con = null) Return the first ChildOnboardingRequestView matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOnboardingRequestView requireOneByOnBoardRequestId(int $on_board_request_id) Return the first ChildOnboardingRequestView filtered by the on_board_request_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnboardingRequestView requireOneByFirstName(string $first_name) Return the first ChildOnboardingRequestView filtered by the first_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnboardingRequestView requireOneByLastName(string $last_name) Return the first ChildOnboardingRequestView filtered by the last_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnboardingRequestView requireOneByOutletName(string $outlet_name) Return the first ChildOnboardingRequestView filtered by the outlet_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnboardingRequestView requireOneByEmail(string $email) Return the first ChildOnboardingRequestView filtered by the email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnboardingRequestView requireOneByMobile(string $mobile) Return the first ChildOnboardingRequestView filtered by the mobile column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnboardingRequestView requireOneByOutletTypeId(int $outlet_type_id) Return the first ChildOnboardingRequestView filtered by the outlet_type_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnboardingRequestView requireOneByOutlettypeName(string $outlettype_name) Return the first ChildOnboardingRequestView filtered by the outlettype_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnboardingRequestView requireOneByTerritory(int $territory) Return the first ChildOnboardingRequestView filtered by the territory column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnboardingRequestView requireOneByTerritoryName(string $territory_name) Return the first ChildOnboardingRequestView filtered by the territory_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnboardingRequestView requireOneByCreatedAt(string $created_at) Return the first ChildOnboardingRequestView filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnboardingRequestView requireOneByCreatedBy(string $created_by) Return the first ChildOnboardingRequestView filtered by the created_by column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnboardingRequestView requireOneByOrgunitid(int $orgunitid) Return the first ChildOnboardingRequestView filtered by the orgunitid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnboardingRequestView requireOneByUnitName(string $unit_name) Return the first ChildOnboardingRequestView filtered by the unit_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnboardingRequestView requireOneByApprovedBy(string $approved_by) Return the first ChildOnboardingRequestView filtered by the approved_by column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnboardingRequestView requireOneByApprovedAt(string $approved_at) Return the first ChildOnboardingRequestView filtered by the approved_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnboardingRequestView requireOneByStatus(int $status) Return the first ChildOnboardingRequestView filtered by the status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnboardingRequestView requireOneByOperations(string $operations) Return the first ChildOnboardingRequestView filtered by the operations column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOnboardingRequestView[]|Collection find(?ConnectionInterface $con = null) Return ChildOnboardingRequestView objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildOnboardingRequestView> find(?ConnectionInterface $con = null) Return ChildOnboardingRequestView objects based on current ModelCriteria
 *
 * @method     ChildOnboardingRequestView[]|Collection findByOnBoardRequestId(int|array<int> $on_board_request_id) Return ChildOnboardingRequestView objects filtered by the on_board_request_id column
 * @psalm-method Collection&\Traversable<ChildOnboardingRequestView> findByOnBoardRequestId(int|array<int> $on_board_request_id) Return ChildOnboardingRequestView objects filtered by the on_board_request_id column
 * @method     ChildOnboardingRequestView[]|Collection findByFirstName(string|array<string> $first_name) Return ChildOnboardingRequestView objects filtered by the first_name column
 * @psalm-method Collection&\Traversable<ChildOnboardingRequestView> findByFirstName(string|array<string> $first_name) Return ChildOnboardingRequestView objects filtered by the first_name column
 * @method     ChildOnboardingRequestView[]|Collection findByLastName(string|array<string> $last_name) Return ChildOnboardingRequestView objects filtered by the last_name column
 * @psalm-method Collection&\Traversable<ChildOnboardingRequestView> findByLastName(string|array<string> $last_name) Return ChildOnboardingRequestView objects filtered by the last_name column
 * @method     ChildOnboardingRequestView[]|Collection findByOutletName(string|array<string> $outlet_name) Return ChildOnboardingRequestView objects filtered by the outlet_name column
 * @psalm-method Collection&\Traversable<ChildOnboardingRequestView> findByOutletName(string|array<string> $outlet_name) Return ChildOnboardingRequestView objects filtered by the outlet_name column
 * @method     ChildOnboardingRequestView[]|Collection findByEmail(string|array<string> $email) Return ChildOnboardingRequestView objects filtered by the email column
 * @psalm-method Collection&\Traversable<ChildOnboardingRequestView> findByEmail(string|array<string> $email) Return ChildOnboardingRequestView objects filtered by the email column
 * @method     ChildOnboardingRequestView[]|Collection findByMobile(string|array<string> $mobile) Return ChildOnboardingRequestView objects filtered by the mobile column
 * @psalm-method Collection&\Traversable<ChildOnboardingRequestView> findByMobile(string|array<string> $mobile) Return ChildOnboardingRequestView objects filtered by the mobile column
 * @method     ChildOnboardingRequestView[]|Collection findByOutletTypeId(int|array<int> $outlet_type_id) Return ChildOnboardingRequestView objects filtered by the outlet_type_id column
 * @psalm-method Collection&\Traversable<ChildOnboardingRequestView> findByOutletTypeId(int|array<int> $outlet_type_id) Return ChildOnboardingRequestView objects filtered by the outlet_type_id column
 * @method     ChildOnboardingRequestView[]|Collection findByOutlettypeName(string|array<string> $outlettype_name) Return ChildOnboardingRequestView objects filtered by the outlettype_name column
 * @psalm-method Collection&\Traversable<ChildOnboardingRequestView> findByOutlettypeName(string|array<string> $outlettype_name) Return ChildOnboardingRequestView objects filtered by the outlettype_name column
 * @method     ChildOnboardingRequestView[]|Collection findByTerritory(int|array<int> $territory) Return ChildOnboardingRequestView objects filtered by the territory column
 * @psalm-method Collection&\Traversable<ChildOnboardingRequestView> findByTerritory(int|array<int> $territory) Return ChildOnboardingRequestView objects filtered by the territory column
 * @method     ChildOnboardingRequestView[]|Collection findByTerritoryName(string|array<string> $territory_name) Return ChildOnboardingRequestView objects filtered by the territory_name column
 * @psalm-method Collection&\Traversable<ChildOnboardingRequestView> findByTerritoryName(string|array<string> $territory_name) Return ChildOnboardingRequestView objects filtered by the territory_name column
 * @method     ChildOnboardingRequestView[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildOnboardingRequestView objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildOnboardingRequestView> findByCreatedAt(string|array<string> $created_at) Return ChildOnboardingRequestView objects filtered by the created_at column
 * @method     ChildOnboardingRequestView[]|Collection findByCreatedBy(string|array<string> $created_by) Return ChildOnboardingRequestView objects filtered by the created_by column
 * @psalm-method Collection&\Traversable<ChildOnboardingRequestView> findByCreatedBy(string|array<string> $created_by) Return ChildOnboardingRequestView objects filtered by the created_by column
 * @method     ChildOnboardingRequestView[]|Collection findByOrgunitid(int|array<int> $orgunitid) Return ChildOnboardingRequestView objects filtered by the orgunitid column
 * @psalm-method Collection&\Traversable<ChildOnboardingRequestView> findByOrgunitid(int|array<int> $orgunitid) Return ChildOnboardingRequestView objects filtered by the orgunitid column
 * @method     ChildOnboardingRequestView[]|Collection findByUnitName(string|array<string> $unit_name) Return ChildOnboardingRequestView objects filtered by the unit_name column
 * @psalm-method Collection&\Traversable<ChildOnboardingRequestView> findByUnitName(string|array<string> $unit_name) Return ChildOnboardingRequestView objects filtered by the unit_name column
 * @method     ChildOnboardingRequestView[]|Collection findByApprovedBy(string|array<string> $approved_by) Return ChildOnboardingRequestView objects filtered by the approved_by column
 * @psalm-method Collection&\Traversable<ChildOnboardingRequestView> findByApprovedBy(string|array<string> $approved_by) Return ChildOnboardingRequestView objects filtered by the approved_by column
 * @method     ChildOnboardingRequestView[]|Collection findByApprovedAt(string|array<string> $approved_at) Return ChildOnboardingRequestView objects filtered by the approved_at column
 * @psalm-method Collection&\Traversable<ChildOnboardingRequestView> findByApprovedAt(string|array<string> $approved_at) Return ChildOnboardingRequestView objects filtered by the approved_at column
 * @method     ChildOnboardingRequestView[]|Collection findByStatus(int|array<int> $status) Return ChildOnboardingRequestView objects filtered by the status column
 * @psalm-method Collection&\Traversable<ChildOnboardingRequestView> findByStatus(int|array<int> $status) Return ChildOnboardingRequestView objects filtered by the status column
 * @method     ChildOnboardingRequestView[]|Collection findByOperations(string|array<string> $operations) Return ChildOnboardingRequestView objects filtered by the operations column
 * @psalm-method Collection&\Traversable<ChildOnboardingRequestView> findByOperations(string|array<string> $operations) Return ChildOnboardingRequestView objects filtered by the operations column
 *
 * @method     ChildOnboardingRequestView[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildOnboardingRequestView> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class OnboardingRequestViewQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\OnboardingRequestViewQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\OnboardingRequestView', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildOnboardingRequestViewQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildOnboardingRequestViewQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildOnboardingRequestViewQuery) {
            return $criteria;
        }
        $query = new ChildOnboardingRequestViewQuery();
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
     * @return ChildOnboardingRequestView|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(OnboardingRequestViewTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = OnboardingRequestViewTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildOnboardingRequestView A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT on_board_request_id, first_name, last_name, outlet_name, email, mobile, outlet_type_id, outlettype_name, territory, territory_name, created_at, created_by, orgunitid, unit_name, approved_by, approved_at, status, operations FROM onboarding_request_view WHERE on_board_request_id = :p0';
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
            /** @var ChildOnboardingRequestView $obj */
            $obj = new ChildOnboardingRequestView();
            $obj->hydrate($row);
            OnboardingRequestViewTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildOnboardingRequestView|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(OnboardingRequestViewTableMap::COL_ON_BOARD_REQUEST_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(OnboardingRequestViewTableMap::COL_ON_BOARD_REQUEST_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the on_board_request_id column
     *
     * Example usage:
     * <code>
     * $query->filterByOnBoardRequestId(1234); // WHERE on_board_request_id = 1234
     * $query->filterByOnBoardRequestId(array(12, 34)); // WHERE on_board_request_id IN (12, 34)
     * $query->filterByOnBoardRequestId(array('min' => 12)); // WHERE on_board_request_id > 12
     * </code>
     *
     * @param mixed $onBoardRequestId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOnBoardRequestId($onBoardRequestId = null, ?string $comparison = null)
    {
        if (is_array($onBoardRequestId)) {
            $useMinMax = false;
            if (isset($onBoardRequestId['min'])) {
                $this->addUsingAlias(OnboardingRequestViewTableMap::COL_ON_BOARD_REQUEST_ID, $onBoardRequestId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($onBoardRequestId['max'])) {
                $this->addUsingAlias(OnboardingRequestViewTableMap::COL_ON_BOARD_REQUEST_ID, $onBoardRequestId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnboardingRequestViewTableMap::COL_ON_BOARD_REQUEST_ID, $onBoardRequestId, $comparison);

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

        $this->addUsingAlias(OnboardingRequestViewTableMap::COL_FIRST_NAME, $firstName, $comparison);

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

        $this->addUsingAlias(OnboardingRequestViewTableMap::COL_LAST_NAME, $lastName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_name column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletName('fooValue');   // WHERE outlet_name = 'fooValue'
     * $query->filterByOutletName('%fooValue%', Criteria::LIKE); // WHERE outlet_name LIKE '%fooValue%'
     * $query->filterByOutletName(['foo', 'bar']); // WHERE outlet_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $outletName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletName($outletName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($outletName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnboardingRequestViewTableMap::COL_OUTLET_NAME, $outletName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the email column
     *
     * Example usage:
     * <code>
     * $query->filterByEmail('fooValue');   // WHERE email = 'fooValue'
     * $query->filterByEmail('%fooValue%', Criteria::LIKE); // WHERE email LIKE '%fooValue%'
     * $query->filterByEmail(['foo', 'bar']); // WHERE email IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $email The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmail($email = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($email)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnboardingRequestViewTableMap::COL_EMAIL, $email, $comparison);

        return $this;
    }

    /**
     * Filter the query on the mobile column
     *
     * Example usage:
     * <code>
     * $query->filterByMobile('fooValue');   // WHERE mobile = 'fooValue'
     * $query->filterByMobile('%fooValue%', Criteria::LIKE); // WHERE mobile LIKE '%fooValue%'
     * $query->filterByMobile(['foo', 'bar']); // WHERE mobile IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $mobile The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMobile($mobile = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($mobile)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnboardingRequestViewTableMap::COL_MOBILE, $mobile, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_type_id column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletTypeId(1234); // WHERE outlet_type_id = 1234
     * $query->filterByOutletTypeId(array(12, 34)); // WHERE outlet_type_id IN (12, 34)
     * $query->filterByOutletTypeId(array('min' => 12)); // WHERE outlet_type_id > 12
     * </code>
     *
     * @param mixed $outletTypeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletTypeId($outletTypeId = null, ?string $comparison = null)
    {
        if (is_array($outletTypeId)) {
            $useMinMax = false;
            if (isset($outletTypeId['min'])) {
                $this->addUsingAlias(OnboardingRequestViewTableMap::COL_OUTLET_TYPE_ID, $outletTypeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outletTypeId['max'])) {
                $this->addUsingAlias(OnboardingRequestViewTableMap::COL_OUTLET_TYPE_ID, $outletTypeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnboardingRequestViewTableMap::COL_OUTLET_TYPE_ID, $outletTypeId, $comparison);

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

        $this->addUsingAlias(OnboardingRequestViewTableMap::COL_OUTLETTYPE_NAME, $outlettypeName, $comparison);

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
                $this->addUsingAlias(OnboardingRequestViewTableMap::COL_TERRITORY, $territory['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($territory['max'])) {
                $this->addUsingAlias(OnboardingRequestViewTableMap::COL_TERRITORY, $territory['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnboardingRequestViewTableMap::COL_TERRITORY, $territory, $comparison);

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

        $this->addUsingAlias(OnboardingRequestViewTableMap::COL_TERRITORY_NAME, $territoryName, $comparison);

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
                $this->addUsingAlias(OnboardingRequestViewTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(OnboardingRequestViewTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnboardingRequestViewTableMap::COL_CREATED_AT, $createdAt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the created_by column
     *
     * Example usage:
     * <code>
     * $query->filterByCreatedBy('fooValue');   // WHERE created_by = 'fooValue'
     * $query->filterByCreatedBy('%fooValue%', Criteria::LIKE); // WHERE created_by LIKE '%fooValue%'
     * $query->filterByCreatedBy(['foo', 'bar']); // WHERE created_by IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $createdBy The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCreatedBy($createdBy = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($createdBy)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnboardingRequestViewTableMap::COL_CREATED_BY, $createdBy, $comparison);

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
                $this->addUsingAlias(OnboardingRequestViewTableMap::COL_ORGUNITID, $orgunitid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($orgunitid['max'])) {
                $this->addUsingAlias(OnboardingRequestViewTableMap::COL_ORGUNITID, $orgunitid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnboardingRequestViewTableMap::COL_ORGUNITID, $orgunitid, $comparison);

        return $this;
    }

    /**
     * Filter the query on the unit_name column
     *
     * Example usage:
     * <code>
     * $query->filterByUnitName('fooValue');   // WHERE unit_name = 'fooValue'
     * $query->filterByUnitName('%fooValue%', Criteria::LIKE); // WHERE unit_name LIKE '%fooValue%'
     * $query->filterByUnitName(['foo', 'bar']); // WHERE unit_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $unitName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUnitName($unitName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($unitName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnboardingRequestViewTableMap::COL_UNIT_NAME, $unitName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the approved_by column
     *
     * Example usage:
     * <code>
     * $query->filterByApprovedBy('fooValue');   // WHERE approved_by = 'fooValue'
     * $query->filterByApprovedBy('%fooValue%', Criteria::LIKE); // WHERE approved_by LIKE '%fooValue%'
     * $query->filterByApprovedBy(['foo', 'bar']); // WHERE approved_by IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $approvedBy The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByApprovedBy($approvedBy = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($approvedBy)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnboardingRequestViewTableMap::COL_APPROVED_BY, $approvedBy, $comparison);

        return $this;
    }

    /**
     * Filter the query on the approved_at column
     *
     * Example usage:
     * <code>
     * $query->filterByApprovedAt('2011-03-14'); // WHERE approved_at = '2011-03-14'
     * $query->filterByApprovedAt('now'); // WHERE approved_at = '2011-03-14'
     * $query->filterByApprovedAt(array('max' => 'yesterday')); // WHERE approved_at > '2011-03-13'
     * </code>
     *
     * @param mixed $approvedAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByApprovedAt($approvedAt = null, ?string $comparison = null)
    {
        if (is_array($approvedAt)) {
            $useMinMax = false;
            if (isset($approvedAt['min'])) {
                $this->addUsingAlias(OnboardingRequestViewTableMap::COL_APPROVED_AT, $approvedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($approvedAt['max'])) {
                $this->addUsingAlias(OnboardingRequestViewTableMap::COL_APPROVED_AT, $approvedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnboardingRequestViewTableMap::COL_APPROVED_AT, $approvedAt, $comparison);

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
                $this->addUsingAlias(OnboardingRequestViewTableMap::COL_STATUS, $status['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($status['max'])) {
                $this->addUsingAlias(OnboardingRequestViewTableMap::COL_STATUS, $status['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnboardingRequestViewTableMap::COL_STATUS, $status, $comparison);

        return $this;
    }

    /**
     * Filter the query on the operations column
     *
     * Example usage:
     * <code>
     * $query->filterByOperations('fooValue');   // WHERE operations = 'fooValue'
     * $query->filterByOperations('%fooValue%', Criteria::LIKE); // WHERE operations LIKE '%fooValue%'
     * $query->filterByOperations(['foo', 'bar']); // WHERE operations IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $operations The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOperations($operations = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($operations)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnboardingRequestViewTableMap::COL_OPERATIONS, $operations, $comparison);

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildOnboardingRequestView $onboardingRequestView Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($onboardingRequestView = null)
    {
        if ($onboardingRequestView) {
            $this->addUsingAlias(OnboardingRequestViewTableMap::COL_ON_BOARD_REQUEST_ID, $onboardingRequestView->getOnBoardRequestId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
