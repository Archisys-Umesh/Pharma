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
use entities\Agendatypes as ChildAgendatypes;
use entities\AgendatypesQuery as ChildAgendatypesQuery;
use entities\Map\AgendatypesTableMap;

/**
 * Base class that represents a query for the `agendatypes` table.
 *
 * @method     ChildAgendatypesQuery orderByAgendaid($order = Criteria::ASC) Order by the agendaid column
 * @method     ChildAgendatypesQuery orderByAgendname($order = Criteria::ASC) Order by the agendname column
 * @method     ChildAgendatypesQuery orderByAgendaimage($order = Criteria::ASC) Order by the agendaimage column
 * @method     ChildAgendatypesQuery orderByAgendacontroltype($order = Criteria::ASC) Order by the agendacontroltype column
 * @method     ChildAgendatypesQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildAgendatypesQuery orderByOrgunitid($order = Criteria::ASC) Order by the orgunitid column
 * @method     ChildAgendatypesQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method     ChildAgendatypesQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildAgendatypesQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildAgendatypesQuery orderByIsPrivate($order = Criteria::ASC) Order by the is_private column
 *
 * @method     ChildAgendatypesQuery groupByAgendaid() Group by the agendaid column
 * @method     ChildAgendatypesQuery groupByAgendname() Group by the agendname column
 * @method     ChildAgendatypesQuery groupByAgendaimage() Group by the agendaimage column
 * @method     ChildAgendatypesQuery groupByAgendacontroltype() Group by the agendacontroltype column
 * @method     ChildAgendatypesQuery groupByCompanyId() Group by the company_id column
 * @method     ChildAgendatypesQuery groupByOrgunitid() Group by the orgunitid column
 * @method     ChildAgendatypesQuery groupByStatus() Group by the status column
 * @method     ChildAgendatypesQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildAgendatypesQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildAgendatypesQuery groupByIsPrivate() Group by the is_private column
 *
 * @method     ChildAgendatypesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildAgendatypesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildAgendatypesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildAgendatypesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildAgendatypesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildAgendatypesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildAgendatypesQuery leftJoinOrgUnit($relationAlias = null) Adds a LEFT JOIN clause to the query using the OrgUnit relation
 * @method     ChildAgendatypesQuery rightJoinOrgUnit($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OrgUnit relation
 * @method     ChildAgendatypesQuery innerJoinOrgUnit($relationAlias = null) Adds a INNER JOIN clause to the query using the OrgUnit relation
 *
 * @method     ChildAgendatypesQuery joinWithOrgUnit($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OrgUnit relation
 *
 * @method     ChildAgendatypesQuery leftJoinWithOrgUnit() Adds a LEFT JOIN clause and with to the query using the OrgUnit relation
 * @method     ChildAgendatypesQuery rightJoinWithOrgUnit() Adds a RIGHT JOIN clause and with to the query using the OrgUnit relation
 * @method     ChildAgendatypesQuery innerJoinWithOrgUnit() Adds a INNER JOIN clause and with to the query using the OrgUnit relation
 *
 * @method     ChildAgendatypesQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildAgendatypesQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildAgendatypesQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildAgendatypesQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildAgendatypesQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildAgendatypesQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildAgendatypesQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     ChildAgendatypesQuery leftJoinMediaFiles($relationAlias = null) Adds a LEFT JOIN clause to the query using the MediaFiles relation
 * @method     ChildAgendatypesQuery rightJoinMediaFiles($relationAlias = null) Adds a RIGHT JOIN clause to the query using the MediaFiles relation
 * @method     ChildAgendatypesQuery innerJoinMediaFiles($relationAlias = null) Adds a INNER JOIN clause to the query using the MediaFiles relation
 *
 * @method     ChildAgendatypesQuery joinWithMediaFiles($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the MediaFiles relation
 *
 * @method     ChildAgendatypesQuery leftJoinWithMediaFiles() Adds a LEFT JOIN clause and with to the query using the MediaFiles relation
 * @method     ChildAgendatypesQuery rightJoinWithMediaFiles() Adds a RIGHT JOIN clause and with to the query using the MediaFiles relation
 * @method     ChildAgendatypesQuery innerJoinWithMediaFiles() Adds a INNER JOIN clause and with to the query using the MediaFiles relation
 *
 * @method     ChildAgendatypesQuery leftJoinBrandCampiagnVisitPlan($relationAlias = null) Adds a LEFT JOIN clause to the query using the BrandCampiagnVisitPlan relation
 * @method     ChildAgendatypesQuery rightJoinBrandCampiagnVisitPlan($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BrandCampiagnVisitPlan relation
 * @method     ChildAgendatypesQuery innerJoinBrandCampiagnVisitPlan($relationAlias = null) Adds a INNER JOIN clause to the query using the BrandCampiagnVisitPlan relation
 *
 * @method     ChildAgendatypesQuery joinWithBrandCampiagnVisitPlan($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BrandCampiagnVisitPlan relation
 *
 * @method     ChildAgendatypesQuery leftJoinWithBrandCampiagnVisitPlan() Adds a LEFT JOIN clause and with to the query using the BrandCampiagnVisitPlan relation
 * @method     ChildAgendatypesQuery rightJoinWithBrandCampiagnVisitPlan() Adds a RIGHT JOIN clause and with to the query using the BrandCampiagnVisitPlan relation
 * @method     ChildAgendatypesQuery innerJoinWithBrandCampiagnVisitPlan() Adds a INNER JOIN clause and with to the query using the BrandCampiagnVisitPlan relation
 *
 * @method     ChildAgendatypesQuery leftJoinDailycalls($relationAlias = null) Adds a LEFT JOIN clause to the query using the Dailycalls relation
 * @method     ChildAgendatypesQuery rightJoinDailycalls($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Dailycalls relation
 * @method     ChildAgendatypesQuery innerJoinDailycalls($relationAlias = null) Adds a INNER JOIN clause to the query using the Dailycalls relation
 *
 * @method     ChildAgendatypesQuery joinWithDailycalls($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Dailycalls relation
 *
 * @method     ChildAgendatypesQuery leftJoinWithDailycalls() Adds a LEFT JOIN clause and with to the query using the Dailycalls relation
 * @method     ChildAgendatypesQuery rightJoinWithDailycalls() Adds a RIGHT JOIN clause and with to the query using the Dailycalls relation
 * @method     ChildAgendatypesQuery innerJoinWithDailycalls() Adds a INNER JOIN clause and with to the query using the Dailycalls relation
 *
 * @method     ChildAgendatypesQuery leftJoinDayplan($relationAlias = null) Adds a LEFT JOIN clause to the query using the Dayplan relation
 * @method     ChildAgendatypesQuery rightJoinDayplan($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Dayplan relation
 * @method     ChildAgendatypesQuery innerJoinDayplan($relationAlias = null) Adds a INNER JOIN clause to the query using the Dayplan relation
 *
 * @method     ChildAgendatypesQuery joinWithDayplan($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Dayplan relation
 *
 * @method     ChildAgendatypesQuery leftJoinWithDayplan() Adds a LEFT JOIN clause and with to the query using the Dayplan relation
 * @method     ChildAgendatypesQuery rightJoinWithDayplan() Adds a RIGHT JOIN clause and with to the query using the Dayplan relation
 * @method     ChildAgendatypesQuery innerJoinWithDayplan() Adds a INNER JOIN clause and with to the query using the Dayplan relation
 *
 * @method     ChildAgendatypesQuery leftJoinTourplans($relationAlias = null) Adds a LEFT JOIN clause to the query using the Tourplans relation
 * @method     ChildAgendatypesQuery rightJoinTourplans($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Tourplans relation
 * @method     ChildAgendatypesQuery innerJoinTourplans($relationAlias = null) Adds a INNER JOIN clause to the query using the Tourplans relation
 *
 * @method     ChildAgendatypesQuery joinWithTourplans($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Tourplans relation
 *
 * @method     ChildAgendatypesQuery leftJoinWithTourplans() Adds a LEFT JOIN clause and with to the query using the Tourplans relation
 * @method     ChildAgendatypesQuery rightJoinWithTourplans() Adds a RIGHT JOIN clause and with to the query using the Tourplans relation
 * @method     ChildAgendatypesQuery innerJoinWithTourplans() Adds a INNER JOIN clause and with to the query using the Tourplans relation
 *
 * @method     \entities\OrgUnitQuery|\entities\CompanyQuery|\entities\MediaFilesQuery|\entities\BrandCampiagnVisitPlanQuery|\entities\DailycallsQuery|\entities\DayplanQuery|\entities\TourplansQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildAgendatypes|null findOne(?ConnectionInterface $con = null) Return the first ChildAgendatypes matching the query
 * @method     ChildAgendatypes findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildAgendatypes matching the query, or a new ChildAgendatypes object populated from the query conditions when no match is found
 *
 * @method     ChildAgendatypes|null findOneByAgendaid(int $agendaid) Return the first ChildAgendatypes filtered by the agendaid column
 * @method     ChildAgendatypes|null findOneByAgendname(string $agendname) Return the first ChildAgendatypes filtered by the agendname column
 * @method     ChildAgendatypes|null findOneByAgendaimage(int $agendaimage) Return the first ChildAgendatypes filtered by the agendaimage column
 * @method     ChildAgendatypes|null findOneByAgendacontroltype(string $agendacontroltype) Return the first ChildAgendatypes filtered by the agendacontroltype column
 * @method     ChildAgendatypes|null findOneByCompanyId(int $company_id) Return the first ChildAgendatypes filtered by the company_id column
 * @method     ChildAgendatypes|null findOneByOrgunitid(int $orgunitid) Return the first ChildAgendatypes filtered by the orgunitid column
 * @method     ChildAgendatypes|null findOneByStatus(string $status) Return the first ChildAgendatypes filtered by the status column
 * @method     ChildAgendatypes|null findOneByCreatedAt(string $created_at) Return the first ChildAgendatypes filtered by the created_at column
 * @method     ChildAgendatypes|null findOneByUpdatedAt(string $updated_at) Return the first ChildAgendatypes filtered by the updated_at column
 * @method     ChildAgendatypes|null findOneByIsPrivate(boolean $is_private) Return the first ChildAgendatypes filtered by the is_private column
 *
 * @method     ChildAgendatypes requirePk($key, ?ConnectionInterface $con = null) Return the ChildAgendatypes by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAgendatypes requireOne(?ConnectionInterface $con = null) Return the first ChildAgendatypes matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildAgendatypes requireOneByAgendaid(int $agendaid) Return the first ChildAgendatypes filtered by the agendaid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAgendatypes requireOneByAgendname(string $agendname) Return the first ChildAgendatypes filtered by the agendname column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAgendatypes requireOneByAgendaimage(int $agendaimage) Return the first ChildAgendatypes filtered by the agendaimage column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAgendatypes requireOneByAgendacontroltype(string $agendacontroltype) Return the first ChildAgendatypes filtered by the agendacontroltype column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAgendatypes requireOneByCompanyId(int $company_id) Return the first ChildAgendatypes filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAgendatypes requireOneByOrgunitid(int $orgunitid) Return the first ChildAgendatypes filtered by the orgunitid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAgendatypes requireOneByStatus(string $status) Return the first ChildAgendatypes filtered by the status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAgendatypes requireOneByCreatedAt(string $created_at) Return the first ChildAgendatypes filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAgendatypes requireOneByUpdatedAt(string $updated_at) Return the first ChildAgendatypes filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAgendatypes requireOneByIsPrivate(boolean $is_private) Return the first ChildAgendatypes filtered by the is_private column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildAgendatypes[]|Collection find(?ConnectionInterface $con = null) Return ChildAgendatypes objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildAgendatypes> find(?ConnectionInterface $con = null) Return ChildAgendatypes objects based on current ModelCriteria
 *
 * @method     ChildAgendatypes[]|Collection findByAgendaid(int|array<int> $agendaid) Return ChildAgendatypes objects filtered by the agendaid column
 * @psalm-method Collection&\Traversable<ChildAgendatypes> findByAgendaid(int|array<int> $agendaid) Return ChildAgendatypes objects filtered by the agendaid column
 * @method     ChildAgendatypes[]|Collection findByAgendname(string|array<string> $agendname) Return ChildAgendatypes objects filtered by the agendname column
 * @psalm-method Collection&\Traversable<ChildAgendatypes> findByAgendname(string|array<string> $agendname) Return ChildAgendatypes objects filtered by the agendname column
 * @method     ChildAgendatypes[]|Collection findByAgendaimage(int|array<int> $agendaimage) Return ChildAgendatypes objects filtered by the agendaimage column
 * @psalm-method Collection&\Traversable<ChildAgendatypes> findByAgendaimage(int|array<int> $agendaimage) Return ChildAgendatypes objects filtered by the agendaimage column
 * @method     ChildAgendatypes[]|Collection findByAgendacontroltype(string|array<string> $agendacontroltype) Return ChildAgendatypes objects filtered by the agendacontroltype column
 * @psalm-method Collection&\Traversable<ChildAgendatypes> findByAgendacontroltype(string|array<string> $agendacontroltype) Return ChildAgendatypes objects filtered by the agendacontroltype column
 * @method     ChildAgendatypes[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildAgendatypes objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildAgendatypes> findByCompanyId(int|array<int> $company_id) Return ChildAgendatypes objects filtered by the company_id column
 * @method     ChildAgendatypes[]|Collection findByOrgunitid(int|array<int> $orgunitid) Return ChildAgendatypes objects filtered by the orgunitid column
 * @psalm-method Collection&\Traversable<ChildAgendatypes> findByOrgunitid(int|array<int> $orgunitid) Return ChildAgendatypes objects filtered by the orgunitid column
 * @method     ChildAgendatypes[]|Collection findByStatus(string|array<string> $status) Return ChildAgendatypes objects filtered by the status column
 * @psalm-method Collection&\Traversable<ChildAgendatypes> findByStatus(string|array<string> $status) Return ChildAgendatypes objects filtered by the status column
 * @method     ChildAgendatypes[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildAgendatypes objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildAgendatypes> findByCreatedAt(string|array<string> $created_at) Return ChildAgendatypes objects filtered by the created_at column
 * @method     ChildAgendatypes[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildAgendatypes objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildAgendatypes> findByUpdatedAt(string|array<string> $updated_at) Return ChildAgendatypes objects filtered by the updated_at column
 * @method     ChildAgendatypes[]|Collection findByIsPrivate(boolean|array<boolean> $is_private) Return ChildAgendatypes objects filtered by the is_private column
 * @psalm-method Collection&\Traversable<ChildAgendatypes> findByIsPrivate(boolean|array<boolean> $is_private) Return ChildAgendatypes objects filtered by the is_private column
 *
 * @method     ChildAgendatypes[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildAgendatypes> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class AgendatypesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\AgendatypesQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\Agendatypes', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildAgendatypesQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildAgendatypesQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildAgendatypesQuery) {
            return $criteria;
        }
        $query = new ChildAgendatypesQuery();
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
     * @return ChildAgendatypes|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(AgendatypesTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = AgendatypesTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildAgendatypes A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT agendaid, agendname, agendaimage, agendacontroltype, company_id, orgunitid, status, created_at, updated_at, is_private FROM agendatypes WHERE agendaid = :p0';
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
            /** @var ChildAgendatypes $obj */
            $obj = new ChildAgendatypes();
            $obj->hydrate($row);
            AgendatypesTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildAgendatypes|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(AgendatypesTableMap::COL_AGENDAID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(AgendatypesTableMap::COL_AGENDAID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the agendaid column
     *
     * Example usage:
     * <code>
     * $query->filterByAgendaid(1234); // WHERE agendaid = 1234
     * $query->filterByAgendaid(array(12, 34)); // WHERE agendaid IN (12, 34)
     * $query->filterByAgendaid(array('min' => 12)); // WHERE agendaid > 12
     * </code>
     *
     * @param mixed $agendaid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAgendaid($agendaid = null, ?string $comparison = null)
    {
        if (is_array($agendaid)) {
            $useMinMax = false;
            if (isset($agendaid['min'])) {
                $this->addUsingAlias(AgendatypesTableMap::COL_AGENDAID, $agendaid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($agendaid['max'])) {
                $this->addUsingAlias(AgendatypesTableMap::COL_AGENDAID, $agendaid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AgendatypesTableMap::COL_AGENDAID, $agendaid, $comparison);

        return $this;
    }

    /**
     * Filter the query on the agendname column
     *
     * Example usage:
     * <code>
     * $query->filterByAgendname('fooValue');   // WHERE agendname = 'fooValue'
     * $query->filterByAgendname('%fooValue%', Criteria::LIKE); // WHERE agendname LIKE '%fooValue%'
     * $query->filterByAgendname(['foo', 'bar']); // WHERE agendname IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $agendname The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAgendname($agendname = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($agendname)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AgendatypesTableMap::COL_AGENDNAME, $agendname, $comparison);

        return $this;
    }

    /**
     * Filter the query on the agendaimage column
     *
     * Example usage:
     * <code>
     * $query->filterByAgendaimage(1234); // WHERE agendaimage = 1234
     * $query->filterByAgendaimage(array(12, 34)); // WHERE agendaimage IN (12, 34)
     * $query->filterByAgendaimage(array('min' => 12)); // WHERE agendaimage > 12
     * </code>
     *
     * @see       filterByMediaFiles()
     *
     * @param mixed $agendaimage The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAgendaimage($agendaimage = null, ?string $comparison = null)
    {
        if (is_array($agendaimage)) {
            $useMinMax = false;
            if (isset($agendaimage['min'])) {
                $this->addUsingAlias(AgendatypesTableMap::COL_AGENDAIMAGE, $agendaimage['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($agendaimage['max'])) {
                $this->addUsingAlias(AgendatypesTableMap::COL_AGENDAIMAGE, $agendaimage['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AgendatypesTableMap::COL_AGENDAIMAGE, $agendaimage, $comparison);

        return $this;
    }

    /**
     * Filter the query on the agendacontroltype column
     *
     * Example usage:
     * <code>
     * $query->filterByAgendacontroltype('fooValue');   // WHERE agendacontroltype = 'fooValue'
     * $query->filterByAgendacontroltype('%fooValue%', Criteria::LIKE); // WHERE agendacontroltype LIKE '%fooValue%'
     * $query->filterByAgendacontroltype(['foo', 'bar']); // WHERE agendacontroltype IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $agendacontroltype The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAgendacontroltype($agendacontroltype = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($agendacontroltype)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AgendatypesTableMap::COL_AGENDACONTROLTYPE, $agendacontroltype, $comparison);

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
                $this->addUsingAlias(AgendatypesTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(AgendatypesTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AgendatypesTableMap::COL_COMPANY_ID, $companyId, $comparison);

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
                $this->addUsingAlias(AgendatypesTableMap::COL_ORGUNITID, $orgunitid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($orgunitid['max'])) {
                $this->addUsingAlias(AgendatypesTableMap::COL_ORGUNITID, $orgunitid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AgendatypesTableMap::COL_ORGUNITID, $orgunitid, $comparison);

        return $this;
    }

    /**
     * Filter the query on the status column
     *
     * Example usage:
     * <code>
     * $query->filterByStatus('fooValue');   // WHERE status = 'fooValue'
     * $query->filterByStatus('%fooValue%', Criteria::LIKE); // WHERE status LIKE '%fooValue%'
     * $query->filterByStatus(['foo', 'bar']); // WHERE status IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $status The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStatus($status = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($status)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AgendatypesTableMap::COL_STATUS, $status, $comparison);

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
                $this->addUsingAlias(AgendatypesTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(AgendatypesTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AgendatypesTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(AgendatypesTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(AgendatypesTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AgendatypesTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the is_private column
     *
     * Example usage:
     * <code>
     * $query->filterByIsPrivate(true); // WHERE is_private = true
     * $query->filterByIsPrivate('yes'); // WHERE is_private = true
     * </code>
     *
     * @param bool|string $isPrivate The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIsPrivate($isPrivate = null, ?string $comparison = null)
    {
        if (is_string($isPrivate)) {
            $isPrivate = in_array(strtolower($isPrivate), array('false', 'off', '-', 'no', 'n', '0', ''), true) ? false : true;
        }

        $this->addUsingAlias(AgendatypesTableMap::COL_IS_PRIVATE, $isPrivate, $comparison);

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
                ->addUsingAlias(AgendatypesTableMap::COL_ORGUNITID, $orgUnit->getOrgunitid(), $comparison);
        } elseif ($orgUnit instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(AgendatypesTableMap::COL_ORGUNITID, $orgUnit->toKeyValue('PrimaryKey', 'Orgunitid'), $comparison);

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
                ->addUsingAlias(AgendatypesTableMap::COL_COMPANY_ID, $company->getCompanyId(), $comparison);
        } elseif ($company instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(AgendatypesTableMap::COL_COMPANY_ID, $company->toKeyValue('PrimaryKey', 'CompanyId'), $comparison);

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
     * Filter the query by a related \entities\MediaFiles object
     *
     * @param \entities\MediaFiles|ObjectCollection $mediaFiles The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMediaFiles($mediaFiles, ?string $comparison = null)
    {
        if ($mediaFiles instanceof \entities\MediaFiles) {
            return $this
                ->addUsingAlias(AgendatypesTableMap::COL_AGENDAIMAGE, $mediaFiles->getMediaId(), $comparison);
        } elseif ($mediaFiles instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(AgendatypesTableMap::COL_AGENDAIMAGE, $mediaFiles->toKeyValue('PrimaryKey', 'MediaId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByMediaFiles() only accepts arguments of type \entities\MediaFiles or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the MediaFiles relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinMediaFiles(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('MediaFiles');

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
            $this->addJoinObject($join, 'MediaFiles');
        }

        return $this;
    }

    /**
     * Use the MediaFiles relation MediaFiles object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\MediaFilesQuery A secondary query class using the current class as primary query
     */
    public function useMediaFilesQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinMediaFiles($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'MediaFiles', '\entities\MediaFilesQuery');
    }

    /**
     * Use the MediaFiles relation MediaFiles object
     *
     * @param callable(\entities\MediaFilesQuery):\entities\MediaFilesQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withMediaFilesQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useMediaFilesQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to MediaFiles table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\MediaFilesQuery The inner query object of the EXISTS statement
     */
    public function useMediaFilesExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\MediaFilesQuery */
        $q = $this->useExistsQuery('MediaFiles', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to MediaFiles table for a NOT EXISTS query.
     *
     * @see useMediaFilesExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\MediaFilesQuery The inner query object of the NOT EXISTS statement
     */
    public function useMediaFilesNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\MediaFilesQuery */
        $q = $this->useExistsQuery('MediaFiles', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to MediaFiles table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\MediaFilesQuery The inner query object of the IN statement
     */
    public function useInMediaFilesQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\MediaFilesQuery */
        $q = $this->useInQuery('MediaFiles', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to MediaFiles table for a NOT IN query.
     *
     * @see useMediaFilesInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\MediaFilesQuery The inner query object of the NOT IN statement
     */
    public function useNotInMediaFilesQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\MediaFilesQuery */
        $q = $this->useInQuery('MediaFiles', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\BrandCampiagnVisitPlan object
     *
     * @param \entities\BrandCampiagnVisitPlan|ObjectCollection $brandCampiagnVisitPlan the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBrandCampiagnVisitPlan($brandCampiagnVisitPlan, ?string $comparison = null)
    {
        if ($brandCampiagnVisitPlan instanceof \entities\BrandCampiagnVisitPlan) {
            $this
                ->addUsingAlias(AgendatypesTableMap::COL_AGENDAID, $brandCampiagnVisitPlan->getAgendaSubTypeId(), $comparison);

            return $this;
        } elseif ($brandCampiagnVisitPlan instanceof ObjectCollection) {
            $this
                ->useBrandCampiagnVisitPlanQuery()
                ->filterByPrimaryKeys($brandCampiagnVisitPlan->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByBrandCampiagnVisitPlan() only accepts arguments of type \entities\BrandCampiagnVisitPlan or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BrandCampiagnVisitPlan relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinBrandCampiagnVisitPlan(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BrandCampiagnVisitPlan');

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
            $this->addJoinObject($join, 'BrandCampiagnVisitPlan');
        }

        return $this;
    }

    /**
     * Use the BrandCampiagnVisitPlan relation BrandCampiagnVisitPlan object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\BrandCampiagnVisitPlanQuery A secondary query class using the current class as primary query
     */
    public function useBrandCampiagnVisitPlanQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinBrandCampiagnVisitPlan($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BrandCampiagnVisitPlan', '\entities\BrandCampiagnVisitPlanQuery');
    }

    /**
     * Use the BrandCampiagnVisitPlan relation BrandCampiagnVisitPlan object
     *
     * @param callable(\entities\BrandCampiagnVisitPlanQuery):\entities\BrandCampiagnVisitPlanQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withBrandCampiagnVisitPlanQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useBrandCampiagnVisitPlanQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to BrandCampiagnVisitPlan table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\BrandCampiagnVisitPlanQuery The inner query object of the EXISTS statement
     */
    public function useBrandCampiagnVisitPlanExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\BrandCampiagnVisitPlanQuery */
        $q = $this->useExistsQuery('BrandCampiagnVisitPlan', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to BrandCampiagnVisitPlan table for a NOT EXISTS query.
     *
     * @see useBrandCampiagnVisitPlanExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\BrandCampiagnVisitPlanQuery The inner query object of the NOT EXISTS statement
     */
    public function useBrandCampiagnVisitPlanNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\BrandCampiagnVisitPlanQuery */
        $q = $this->useExistsQuery('BrandCampiagnVisitPlan', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to BrandCampiagnVisitPlan table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\BrandCampiagnVisitPlanQuery The inner query object of the IN statement
     */
    public function useInBrandCampiagnVisitPlanQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\BrandCampiagnVisitPlanQuery */
        $q = $this->useInQuery('BrandCampiagnVisitPlan', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to BrandCampiagnVisitPlan table for a NOT IN query.
     *
     * @see useBrandCampiagnVisitPlanInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\BrandCampiagnVisitPlanQuery The inner query object of the NOT IN statement
     */
    public function useNotInBrandCampiagnVisitPlanQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\BrandCampiagnVisitPlanQuery */
        $q = $this->useInQuery('BrandCampiagnVisitPlan', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\Dailycalls object
     *
     * @param \entities\Dailycalls|ObjectCollection $dailycalls the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDailycalls($dailycalls, ?string $comparison = null)
    {
        if ($dailycalls instanceof \entities\Dailycalls) {
            $this
                ->addUsingAlias(AgendatypesTableMap::COL_AGENDAID, $dailycalls->getAgendaId(), $comparison);

            return $this;
        } elseif ($dailycalls instanceof ObjectCollection) {
            $this
                ->useDailycallsQuery()
                ->filterByPrimaryKeys($dailycalls->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByDailycalls() only accepts arguments of type \entities\Dailycalls or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Dailycalls relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinDailycalls(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Dailycalls');

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
            $this->addJoinObject($join, 'Dailycalls');
        }

        return $this;
    }

    /**
     * Use the Dailycalls relation Dailycalls object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\DailycallsQuery A secondary query class using the current class as primary query
     */
    public function useDailycallsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinDailycalls($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Dailycalls', '\entities\DailycallsQuery');
    }

    /**
     * Use the Dailycalls relation Dailycalls object
     *
     * @param callable(\entities\DailycallsQuery):\entities\DailycallsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withDailycallsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useDailycallsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Dailycalls table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\DailycallsQuery The inner query object of the EXISTS statement
     */
    public function useDailycallsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\DailycallsQuery */
        $q = $this->useExistsQuery('Dailycalls', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Dailycalls table for a NOT EXISTS query.
     *
     * @see useDailycallsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\DailycallsQuery The inner query object of the NOT EXISTS statement
     */
    public function useDailycallsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\DailycallsQuery */
        $q = $this->useExistsQuery('Dailycalls', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Dailycalls table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\DailycallsQuery The inner query object of the IN statement
     */
    public function useInDailycallsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\DailycallsQuery */
        $q = $this->useInQuery('Dailycalls', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Dailycalls table for a NOT IN query.
     *
     * @see useDailycallsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\DailycallsQuery The inner query object of the NOT IN statement
     */
    public function useNotInDailycallsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\DailycallsQuery */
        $q = $this->useInQuery('Dailycalls', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\Dayplan object
     *
     * @param \entities\Dayplan|ObjectCollection $dayplan the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDayplan($dayplan, ?string $comparison = null)
    {
        if ($dayplan instanceof \entities\Dayplan) {
            $this
                ->addUsingAlias(AgendatypesTableMap::COL_AGENDAID, $dayplan->getAgendaId(), $comparison);

            return $this;
        } elseif ($dayplan instanceof ObjectCollection) {
            $this
                ->useDayplanQuery()
                ->filterByPrimaryKeys($dayplan->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByDayplan() only accepts arguments of type \entities\Dayplan or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Dayplan relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinDayplan(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Dayplan');

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
            $this->addJoinObject($join, 'Dayplan');
        }

        return $this;
    }

    /**
     * Use the Dayplan relation Dayplan object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\DayplanQuery A secondary query class using the current class as primary query
     */
    public function useDayplanQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinDayplan($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Dayplan', '\entities\DayplanQuery');
    }

    /**
     * Use the Dayplan relation Dayplan object
     *
     * @param callable(\entities\DayplanQuery):\entities\DayplanQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withDayplanQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useDayplanQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Dayplan table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\DayplanQuery The inner query object of the EXISTS statement
     */
    public function useDayplanExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\DayplanQuery */
        $q = $this->useExistsQuery('Dayplan', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Dayplan table for a NOT EXISTS query.
     *
     * @see useDayplanExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\DayplanQuery The inner query object of the NOT EXISTS statement
     */
    public function useDayplanNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\DayplanQuery */
        $q = $this->useExistsQuery('Dayplan', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Dayplan table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\DayplanQuery The inner query object of the IN statement
     */
    public function useInDayplanQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\DayplanQuery */
        $q = $this->useInQuery('Dayplan', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Dayplan table for a NOT IN query.
     *
     * @see useDayplanInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\DayplanQuery The inner query object of the NOT IN statement
     */
    public function useNotInDayplanQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\DayplanQuery */
        $q = $this->useInQuery('Dayplan', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\Tourplans object
     *
     * @param \entities\Tourplans|ObjectCollection $tourplans the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTourplans($tourplans, ?string $comparison = null)
    {
        if ($tourplans instanceof \entities\Tourplans) {
            $this
                ->addUsingAlias(AgendatypesTableMap::COL_AGENDAID, $tourplans->getAgendaId(), $comparison);

            return $this;
        } elseif ($tourplans instanceof ObjectCollection) {
            $this
                ->useTourplansQuery()
                ->filterByPrimaryKeys($tourplans->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByTourplans() only accepts arguments of type \entities\Tourplans or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Tourplans relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinTourplans(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Tourplans');

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
            $this->addJoinObject($join, 'Tourplans');
        }

        return $this;
    }

    /**
     * Use the Tourplans relation Tourplans object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\TourplansQuery A secondary query class using the current class as primary query
     */
    public function useTourplansQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinTourplans($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Tourplans', '\entities\TourplansQuery');
    }

    /**
     * Use the Tourplans relation Tourplans object
     *
     * @param callable(\entities\TourplansQuery):\entities\TourplansQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withTourplansQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useTourplansQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Tourplans table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\TourplansQuery The inner query object of the EXISTS statement
     */
    public function useTourplansExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\TourplansQuery */
        $q = $this->useExistsQuery('Tourplans', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Tourplans table for a NOT EXISTS query.
     *
     * @see useTourplansExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\TourplansQuery The inner query object of the NOT EXISTS statement
     */
    public function useTourplansNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\TourplansQuery */
        $q = $this->useExistsQuery('Tourplans', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Tourplans table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\TourplansQuery The inner query object of the IN statement
     */
    public function useInTourplansQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\TourplansQuery */
        $q = $this->useInQuery('Tourplans', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Tourplans table for a NOT IN query.
     *
     * @see useTourplansInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\TourplansQuery The inner query object of the NOT IN statement
     */
    public function useNotInTourplansQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\TourplansQuery */
        $q = $this->useInQuery('Tourplans', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildAgendatypes $agendatypes Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($agendatypes = null)
    {
        if ($agendatypes) {
            $this->addUsingAlias(AgendatypesTableMap::COL_AGENDAID, $agendatypes->getAgendaid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the agendatypes table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(AgendatypesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            AgendatypesTableMap::clearInstancePool();
            AgendatypesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(AgendatypesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(AgendatypesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            AgendatypesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            AgendatypesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
