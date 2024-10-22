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
use entities\OnBoardRequiredFields as ChildOnBoardRequiredFields;
use entities\OnBoardRequiredFieldsQuery as ChildOnBoardRequiredFieldsQuery;
use entities\Map\OnBoardRequiredFieldsTableMap;

/**
 * Base class that represents a query for the `on_board_required_fields` table.
 *
 * @method     ChildOnBoardRequiredFieldsQuery orderByOnBoardRequiredFieldsId($order = Criteria::ASC) Order by the on_board_required_fields_id column
 * @method     ChildOnBoardRequiredFieldsQuery orderByOrgUnitId($order = Criteria::ASC) Order by the org_unit_id column
 * @method     ChildOnBoardRequiredFieldsQuery orderByOutletTypeId($order = Criteria::ASC) Order by the outlet_type_id column
 * @method     ChildOnBoardRequiredFieldsQuery orderByRequiredFields($order = Criteria::ASC) Order by the required_fields column
 * @method     ChildOnBoardRequiredFieldsQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildOnBoardRequiredFieldsQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildOnBoardRequiredFieldsQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildOnBoardRequiredFieldsQuery orderByStatusTypeId($order = Criteria::ASC) Order by the status_type_id column
 *
 * @method     ChildOnBoardRequiredFieldsQuery groupByOnBoardRequiredFieldsId() Group by the on_board_required_fields_id column
 * @method     ChildOnBoardRequiredFieldsQuery groupByOrgUnitId() Group by the org_unit_id column
 * @method     ChildOnBoardRequiredFieldsQuery groupByOutletTypeId() Group by the outlet_type_id column
 * @method     ChildOnBoardRequiredFieldsQuery groupByRequiredFields() Group by the required_fields column
 * @method     ChildOnBoardRequiredFieldsQuery groupByCompanyId() Group by the company_id column
 * @method     ChildOnBoardRequiredFieldsQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildOnBoardRequiredFieldsQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildOnBoardRequiredFieldsQuery groupByStatusTypeId() Group by the status_type_id column
 *
 * @method     ChildOnBoardRequiredFieldsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildOnBoardRequiredFieldsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildOnBoardRequiredFieldsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildOnBoardRequiredFieldsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildOnBoardRequiredFieldsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildOnBoardRequiredFieldsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildOnBoardRequiredFieldsQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildOnBoardRequiredFieldsQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildOnBoardRequiredFieldsQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildOnBoardRequiredFieldsQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildOnBoardRequiredFieldsQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildOnBoardRequiredFieldsQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildOnBoardRequiredFieldsQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     ChildOnBoardRequiredFieldsQuery leftJoinOrgUnit($relationAlias = null) Adds a LEFT JOIN clause to the query using the OrgUnit relation
 * @method     ChildOnBoardRequiredFieldsQuery rightJoinOrgUnit($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OrgUnit relation
 * @method     ChildOnBoardRequiredFieldsQuery innerJoinOrgUnit($relationAlias = null) Adds a INNER JOIN clause to the query using the OrgUnit relation
 *
 * @method     ChildOnBoardRequiredFieldsQuery joinWithOrgUnit($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OrgUnit relation
 *
 * @method     ChildOnBoardRequiredFieldsQuery leftJoinWithOrgUnit() Adds a LEFT JOIN clause and with to the query using the OrgUnit relation
 * @method     ChildOnBoardRequiredFieldsQuery rightJoinWithOrgUnit() Adds a RIGHT JOIN clause and with to the query using the OrgUnit relation
 * @method     ChildOnBoardRequiredFieldsQuery innerJoinWithOrgUnit() Adds a INNER JOIN clause and with to the query using the OrgUnit relation
 *
 * @method     ChildOnBoardRequiredFieldsQuery leftJoinOutletType($relationAlias = null) Adds a LEFT JOIN clause to the query using the OutletType relation
 * @method     ChildOnBoardRequiredFieldsQuery rightJoinOutletType($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OutletType relation
 * @method     ChildOnBoardRequiredFieldsQuery innerJoinOutletType($relationAlias = null) Adds a INNER JOIN clause to the query using the OutletType relation
 *
 * @method     ChildOnBoardRequiredFieldsQuery joinWithOutletType($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OutletType relation
 *
 * @method     ChildOnBoardRequiredFieldsQuery leftJoinWithOutletType() Adds a LEFT JOIN clause and with to the query using the OutletType relation
 * @method     ChildOnBoardRequiredFieldsQuery rightJoinWithOutletType() Adds a RIGHT JOIN clause and with to the query using the OutletType relation
 * @method     ChildOnBoardRequiredFieldsQuery innerJoinWithOutletType() Adds a INNER JOIN clause and with to the query using the OutletType relation
 *
 * @method     \entities\CompanyQuery|\entities\OrgUnitQuery|\entities\OutletTypeQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildOnBoardRequiredFields|null findOne(?ConnectionInterface $con = null) Return the first ChildOnBoardRequiredFields matching the query
 * @method     ChildOnBoardRequiredFields findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildOnBoardRequiredFields matching the query, or a new ChildOnBoardRequiredFields object populated from the query conditions when no match is found
 *
 * @method     ChildOnBoardRequiredFields|null findOneByOnBoardRequiredFieldsId(int $on_board_required_fields_id) Return the first ChildOnBoardRequiredFields filtered by the on_board_required_fields_id column
 * @method     ChildOnBoardRequiredFields|null findOneByOrgUnitId(int $org_unit_id) Return the first ChildOnBoardRequiredFields filtered by the org_unit_id column
 * @method     ChildOnBoardRequiredFields|null findOneByOutletTypeId(int $outlet_type_id) Return the first ChildOnBoardRequiredFields filtered by the outlet_type_id column
 * @method     ChildOnBoardRequiredFields|null findOneByRequiredFields(string $required_fields) Return the first ChildOnBoardRequiredFields filtered by the required_fields column
 * @method     ChildOnBoardRequiredFields|null findOneByCompanyId(int $company_id) Return the first ChildOnBoardRequiredFields filtered by the company_id column
 * @method     ChildOnBoardRequiredFields|null findOneByCreatedAt(string $created_at) Return the first ChildOnBoardRequiredFields filtered by the created_at column
 * @method     ChildOnBoardRequiredFields|null findOneByUpdatedAt(string $updated_at) Return the first ChildOnBoardRequiredFields filtered by the updated_at column
 * @method     ChildOnBoardRequiredFields|null findOneByStatusTypeId(int $status_type_id) Return the first ChildOnBoardRequiredFields filtered by the status_type_id column
 *
 * @method     ChildOnBoardRequiredFields requirePk($key, ?ConnectionInterface $con = null) Return the ChildOnBoardRequiredFields by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnBoardRequiredFields requireOne(?ConnectionInterface $con = null) Return the first ChildOnBoardRequiredFields matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOnBoardRequiredFields requireOneByOnBoardRequiredFieldsId(int $on_board_required_fields_id) Return the first ChildOnBoardRequiredFields filtered by the on_board_required_fields_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnBoardRequiredFields requireOneByOrgUnitId(int $org_unit_id) Return the first ChildOnBoardRequiredFields filtered by the org_unit_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnBoardRequiredFields requireOneByOutletTypeId(int $outlet_type_id) Return the first ChildOnBoardRequiredFields filtered by the outlet_type_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnBoardRequiredFields requireOneByRequiredFields(string $required_fields) Return the first ChildOnBoardRequiredFields filtered by the required_fields column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnBoardRequiredFields requireOneByCompanyId(int $company_id) Return the first ChildOnBoardRequiredFields filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnBoardRequiredFields requireOneByCreatedAt(string $created_at) Return the first ChildOnBoardRequiredFields filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnBoardRequiredFields requireOneByUpdatedAt(string $updated_at) Return the first ChildOnBoardRequiredFields filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnBoardRequiredFields requireOneByStatusTypeId(int $status_type_id) Return the first ChildOnBoardRequiredFields filtered by the status_type_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOnBoardRequiredFields[]|Collection find(?ConnectionInterface $con = null) Return ChildOnBoardRequiredFields objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildOnBoardRequiredFields> find(?ConnectionInterface $con = null) Return ChildOnBoardRequiredFields objects based on current ModelCriteria
 *
 * @method     ChildOnBoardRequiredFields[]|Collection findByOnBoardRequiredFieldsId(int|array<int> $on_board_required_fields_id) Return ChildOnBoardRequiredFields objects filtered by the on_board_required_fields_id column
 * @psalm-method Collection&\Traversable<ChildOnBoardRequiredFields> findByOnBoardRequiredFieldsId(int|array<int> $on_board_required_fields_id) Return ChildOnBoardRequiredFields objects filtered by the on_board_required_fields_id column
 * @method     ChildOnBoardRequiredFields[]|Collection findByOrgUnitId(int|array<int> $org_unit_id) Return ChildOnBoardRequiredFields objects filtered by the org_unit_id column
 * @psalm-method Collection&\Traversable<ChildOnBoardRequiredFields> findByOrgUnitId(int|array<int> $org_unit_id) Return ChildOnBoardRequiredFields objects filtered by the org_unit_id column
 * @method     ChildOnBoardRequiredFields[]|Collection findByOutletTypeId(int|array<int> $outlet_type_id) Return ChildOnBoardRequiredFields objects filtered by the outlet_type_id column
 * @psalm-method Collection&\Traversable<ChildOnBoardRequiredFields> findByOutletTypeId(int|array<int> $outlet_type_id) Return ChildOnBoardRequiredFields objects filtered by the outlet_type_id column
 * @method     ChildOnBoardRequiredFields[]|Collection findByRequiredFields(string|array<string> $required_fields) Return ChildOnBoardRequiredFields objects filtered by the required_fields column
 * @psalm-method Collection&\Traversable<ChildOnBoardRequiredFields> findByRequiredFields(string|array<string> $required_fields) Return ChildOnBoardRequiredFields objects filtered by the required_fields column
 * @method     ChildOnBoardRequiredFields[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildOnBoardRequiredFields objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildOnBoardRequiredFields> findByCompanyId(int|array<int> $company_id) Return ChildOnBoardRequiredFields objects filtered by the company_id column
 * @method     ChildOnBoardRequiredFields[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildOnBoardRequiredFields objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildOnBoardRequiredFields> findByCreatedAt(string|array<string> $created_at) Return ChildOnBoardRequiredFields objects filtered by the created_at column
 * @method     ChildOnBoardRequiredFields[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildOnBoardRequiredFields objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildOnBoardRequiredFields> findByUpdatedAt(string|array<string> $updated_at) Return ChildOnBoardRequiredFields objects filtered by the updated_at column
 * @method     ChildOnBoardRequiredFields[]|Collection findByStatusTypeId(int|array<int> $status_type_id) Return ChildOnBoardRequiredFields objects filtered by the status_type_id column
 * @psalm-method Collection&\Traversable<ChildOnBoardRequiredFields> findByStatusTypeId(int|array<int> $status_type_id) Return ChildOnBoardRequiredFields objects filtered by the status_type_id column
 *
 * @method     ChildOnBoardRequiredFields[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildOnBoardRequiredFields> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class OnBoardRequiredFieldsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\OnBoardRequiredFieldsQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\OnBoardRequiredFields', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildOnBoardRequiredFieldsQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildOnBoardRequiredFieldsQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildOnBoardRequiredFieldsQuery) {
            return $criteria;
        }
        $query = new ChildOnBoardRequiredFieldsQuery();
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
     * @return ChildOnBoardRequiredFields|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(OnBoardRequiredFieldsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = OnBoardRequiredFieldsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildOnBoardRequiredFields A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT on_board_required_fields_id, org_unit_id, outlet_type_id, required_fields, company_id, created_at, updated_at, status_type_id FROM on_board_required_fields WHERE on_board_required_fields_id = :p0';
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
            /** @var ChildOnBoardRequiredFields $obj */
            $obj = new ChildOnBoardRequiredFields();
            $obj->hydrate($row);
            OnBoardRequiredFieldsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildOnBoardRequiredFields|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(OnBoardRequiredFieldsTableMap::COL_ON_BOARD_REQUIRED_FIELDS_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(OnBoardRequiredFieldsTableMap::COL_ON_BOARD_REQUIRED_FIELDS_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the on_board_required_fields_id column
     *
     * Example usage:
     * <code>
     * $query->filterByOnBoardRequiredFieldsId(1234); // WHERE on_board_required_fields_id = 1234
     * $query->filterByOnBoardRequiredFieldsId(array(12, 34)); // WHERE on_board_required_fields_id IN (12, 34)
     * $query->filterByOnBoardRequiredFieldsId(array('min' => 12)); // WHERE on_board_required_fields_id > 12
     * </code>
     *
     * @param mixed $onBoardRequiredFieldsId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOnBoardRequiredFieldsId($onBoardRequiredFieldsId = null, ?string $comparison = null)
    {
        if (is_array($onBoardRequiredFieldsId)) {
            $useMinMax = false;
            if (isset($onBoardRequiredFieldsId['min'])) {
                $this->addUsingAlias(OnBoardRequiredFieldsTableMap::COL_ON_BOARD_REQUIRED_FIELDS_ID, $onBoardRequiredFieldsId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($onBoardRequiredFieldsId['max'])) {
                $this->addUsingAlias(OnBoardRequiredFieldsTableMap::COL_ON_BOARD_REQUIRED_FIELDS_ID, $onBoardRequiredFieldsId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnBoardRequiredFieldsTableMap::COL_ON_BOARD_REQUIRED_FIELDS_ID, $onBoardRequiredFieldsId, $comparison);

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
     * @see       filterByOrgUnit()
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
                $this->addUsingAlias(OnBoardRequiredFieldsTableMap::COL_ORG_UNIT_ID, $orgUnitId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($orgUnitId['max'])) {
                $this->addUsingAlias(OnBoardRequiredFieldsTableMap::COL_ORG_UNIT_ID, $orgUnitId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnBoardRequiredFieldsTableMap::COL_ORG_UNIT_ID, $orgUnitId, $comparison);

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
     * @see       filterByOutletType()
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
                $this->addUsingAlias(OnBoardRequiredFieldsTableMap::COL_OUTLET_TYPE_ID, $outletTypeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outletTypeId['max'])) {
                $this->addUsingAlias(OnBoardRequiredFieldsTableMap::COL_OUTLET_TYPE_ID, $outletTypeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnBoardRequiredFieldsTableMap::COL_OUTLET_TYPE_ID, $outletTypeId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the required_fields column
     *
     * Example usage:
     * <code>
     * $query->filterByRequiredFields('fooValue');   // WHERE required_fields = 'fooValue'
     * $query->filterByRequiredFields('%fooValue%', Criteria::LIKE); // WHERE required_fields LIKE '%fooValue%'
     * $query->filterByRequiredFields(['foo', 'bar']); // WHERE required_fields IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $requiredFields The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRequiredFields($requiredFields = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($requiredFields)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnBoardRequiredFieldsTableMap::COL_REQUIRED_FIELDS, $requiredFields, $comparison);

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
                $this->addUsingAlias(OnBoardRequiredFieldsTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(OnBoardRequiredFieldsTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnBoardRequiredFieldsTableMap::COL_COMPANY_ID, $companyId, $comparison);

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
                $this->addUsingAlias(OnBoardRequiredFieldsTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(OnBoardRequiredFieldsTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnBoardRequiredFieldsTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(OnBoardRequiredFieldsTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(OnBoardRequiredFieldsTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnBoardRequiredFieldsTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the status_type_id column
     *
     * Example usage:
     * <code>
     * $query->filterByStatusTypeId(1234); // WHERE status_type_id = 1234
     * $query->filterByStatusTypeId(array(12, 34)); // WHERE status_type_id IN (12, 34)
     * $query->filterByStatusTypeId(array('min' => 12)); // WHERE status_type_id > 12
     * </code>
     *
     * @param mixed $statusTypeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStatusTypeId($statusTypeId = null, ?string $comparison = null)
    {
        if (is_array($statusTypeId)) {
            $useMinMax = false;
            if (isset($statusTypeId['min'])) {
                $this->addUsingAlias(OnBoardRequiredFieldsTableMap::COL_STATUS_TYPE_ID, $statusTypeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($statusTypeId['max'])) {
                $this->addUsingAlias(OnBoardRequiredFieldsTableMap::COL_STATUS_TYPE_ID, $statusTypeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnBoardRequiredFieldsTableMap::COL_STATUS_TYPE_ID, $statusTypeId, $comparison);

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
                ->addUsingAlias(OnBoardRequiredFieldsTableMap::COL_COMPANY_ID, $company->getCompanyId(), $comparison);
        } elseif ($company instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(OnBoardRequiredFieldsTableMap::COL_COMPANY_ID, $company->toKeyValue('PrimaryKey', 'CompanyId'), $comparison);

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
                ->addUsingAlias(OnBoardRequiredFieldsTableMap::COL_ORG_UNIT_ID, $orgUnit->getOrgunitid(), $comparison);
        } elseif ($orgUnit instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(OnBoardRequiredFieldsTableMap::COL_ORG_UNIT_ID, $orgUnit->toKeyValue('PrimaryKey', 'Orgunitid'), $comparison);

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
     * Filter the query by a related \entities\OutletType object
     *
     * @param \entities\OutletType|ObjectCollection $outletType The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletType($outletType, ?string $comparison = null)
    {
        if ($outletType instanceof \entities\OutletType) {
            return $this
                ->addUsingAlias(OnBoardRequiredFieldsTableMap::COL_OUTLET_TYPE_ID, $outletType->getOutlettypeId(), $comparison);
        } elseif ($outletType instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(OnBoardRequiredFieldsTableMap::COL_OUTLET_TYPE_ID, $outletType->toKeyValue('PrimaryKey', 'OutlettypeId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByOutletType() only accepts arguments of type \entities\OutletType or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OutletType relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOutletType(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OutletType');

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
            $this->addJoinObject($join, 'OutletType');
        }

        return $this;
    }

    /**
     * Use the OutletType relation OutletType object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\OutletTypeQuery A secondary query class using the current class as primary query
     */
    public function useOutletTypeQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinOutletType($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OutletType', '\entities\OutletTypeQuery');
    }

    /**
     * Use the OutletType relation OutletType object
     *
     * @param callable(\entities\OutletTypeQuery):\entities\OutletTypeQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOutletTypeQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useOutletTypeQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to OutletType table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\OutletTypeQuery The inner query object of the EXISTS statement
     */
    public function useOutletTypeExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\OutletTypeQuery */
        $q = $this->useExistsQuery('OutletType', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to OutletType table for a NOT EXISTS query.
     *
     * @see useOutletTypeExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\OutletTypeQuery The inner query object of the NOT EXISTS statement
     */
    public function useOutletTypeNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OutletTypeQuery */
        $q = $this->useExistsQuery('OutletType', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to OutletType table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\OutletTypeQuery The inner query object of the IN statement
     */
    public function useInOutletTypeQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\OutletTypeQuery */
        $q = $this->useInQuery('OutletType', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to OutletType table for a NOT IN query.
     *
     * @see useOutletTypeInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\OutletTypeQuery The inner query object of the NOT IN statement
     */
    public function useNotInOutletTypeQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OutletTypeQuery */
        $q = $this->useInQuery('OutletType', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildOnBoardRequiredFields $onBoardRequiredFields Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($onBoardRequiredFields = null)
    {
        if ($onBoardRequiredFields) {
            $this->addUsingAlias(OnBoardRequiredFieldsTableMap::COL_ON_BOARD_REQUIRED_FIELDS_ID, $onBoardRequiredFields->getOnBoardRequiredFieldsId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the on_board_required_fields table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OnBoardRequiredFieldsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            OnBoardRequiredFieldsTableMap::clearInstancePool();
            OnBoardRequiredFieldsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(OnBoardRequiredFieldsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(OnBoardRequiredFieldsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            OnBoardRequiredFieldsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            OnBoardRequiredFieldsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
