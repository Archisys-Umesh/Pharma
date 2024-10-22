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
use entities\HrUserReferences as ChildHrUserReferences;
use entities\HrUserReferencesQuery as ChildHrUserReferencesQuery;
use entities\Map\HrUserReferencesTableMap;

/**
 * Base class that represents a query for the `hr_user_references` table.
 *
 * @method     ChildHrUserReferencesQuery orderByHrreId($order = Criteria::ASC) Order by the hrre_id column
 * @method     ChildHrUserReferencesQuery orderByEmployeeId($order = Criteria::ASC) Order by the employee_id column
 * @method     ChildHrUserReferencesQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildHrUserReferencesQuery orderByCompany($order = Criteria::ASC) Order by the company column
 * @method     ChildHrUserReferencesQuery orderByConactInformation($order = Criteria::ASC) Order by the conact_information column
 * @method     ChildHrUserReferencesQuery orderByRelation($order = Criteria::ASC) Order by the relation column
 * @method     ChildHrUserReferencesQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildHrUserReferencesQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildHrUserReferencesQuery groupByHrreId() Group by the hrre_id column
 * @method     ChildHrUserReferencesQuery groupByEmployeeId() Group by the employee_id column
 * @method     ChildHrUserReferencesQuery groupByName() Group by the name column
 * @method     ChildHrUserReferencesQuery groupByCompany() Group by the company column
 * @method     ChildHrUserReferencesQuery groupByConactInformation() Group by the conact_information column
 * @method     ChildHrUserReferencesQuery groupByRelation() Group by the relation column
 * @method     ChildHrUserReferencesQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildHrUserReferencesQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildHrUserReferencesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildHrUserReferencesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildHrUserReferencesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildHrUserReferencesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildHrUserReferencesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildHrUserReferencesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildHrUserReferencesQuery leftJoinEmployee($relationAlias = null) Adds a LEFT JOIN clause to the query using the Employee relation
 * @method     ChildHrUserReferencesQuery rightJoinEmployee($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Employee relation
 * @method     ChildHrUserReferencesQuery innerJoinEmployee($relationAlias = null) Adds a INNER JOIN clause to the query using the Employee relation
 *
 * @method     ChildHrUserReferencesQuery joinWithEmployee($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Employee relation
 *
 * @method     ChildHrUserReferencesQuery leftJoinWithEmployee() Adds a LEFT JOIN clause and with to the query using the Employee relation
 * @method     ChildHrUserReferencesQuery rightJoinWithEmployee() Adds a RIGHT JOIN clause and with to the query using the Employee relation
 * @method     ChildHrUserReferencesQuery innerJoinWithEmployee() Adds a INNER JOIN clause and with to the query using the Employee relation
 *
 * @method     \entities\EmployeeQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildHrUserReferences|null findOne(?ConnectionInterface $con = null) Return the first ChildHrUserReferences matching the query
 * @method     ChildHrUserReferences findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildHrUserReferences matching the query, or a new ChildHrUserReferences object populated from the query conditions when no match is found
 *
 * @method     ChildHrUserReferences|null findOneByHrreId(int $hrre_id) Return the first ChildHrUserReferences filtered by the hrre_id column
 * @method     ChildHrUserReferences|null findOneByEmployeeId(int $employee_id) Return the first ChildHrUserReferences filtered by the employee_id column
 * @method     ChildHrUserReferences|null findOneByName(string $name) Return the first ChildHrUserReferences filtered by the name column
 * @method     ChildHrUserReferences|null findOneByCompany(string $company) Return the first ChildHrUserReferences filtered by the company column
 * @method     ChildHrUserReferences|null findOneByConactInformation(string $conact_information) Return the first ChildHrUserReferences filtered by the conact_information column
 * @method     ChildHrUserReferences|null findOneByRelation(string $relation) Return the first ChildHrUserReferences filtered by the relation column
 * @method     ChildHrUserReferences|null findOneByCreatedAt(string $created_at) Return the first ChildHrUserReferences filtered by the created_at column
 * @method     ChildHrUserReferences|null findOneByUpdatedAt(string $updated_at) Return the first ChildHrUserReferences filtered by the updated_at column
 *
 * @method     ChildHrUserReferences requirePk($key, ?ConnectionInterface $con = null) Return the ChildHrUserReferences by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHrUserReferences requireOne(?ConnectionInterface $con = null) Return the first ChildHrUserReferences matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildHrUserReferences requireOneByHrreId(int $hrre_id) Return the first ChildHrUserReferences filtered by the hrre_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHrUserReferences requireOneByEmployeeId(int $employee_id) Return the first ChildHrUserReferences filtered by the employee_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHrUserReferences requireOneByName(string $name) Return the first ChildHrUserReferences filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHrUserReferences requireOneByCompany(string $company) Return the first ChildHrUserReferences filtered by the company column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHrUserReferences requireOneByConactInformation(string $conact_information) Return the first ChildHrUserReferences filtered by the conact_information column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHrUserReferences requireOneByRelation(string $relation) Return the first ChildHrUserReferences filtered by the relation column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHrUserReferences requireOneByCreatedAt(string $created_at) Return the first ChildHrUserReferences filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHrUserReferences requireOneByUpdatedAt(string $updated_at) Return the first ChildHrUserReferences filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildHrUserReferences[]|Collection find(?ConnectionInterface $con = null) Return ChildHrUserReferences objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildHrUserReferences> find(?ConnectionInterface $con = null) Return ChildHrUserReferences objects based on current ModelCriteria
 *
 * @method     ChildHrUserReferences[]|Collection findByHrreId(int|array<int> $hrre_id) Return ChildHrUserReferences objects filtered by the hrre_id column
 * @psalm-method Collection&\Traversable<ChildHrUserReferences> findByHrreId(int|array<int> $hrre_id) Return ChildHrUserReferences objects filtered by the hrre_id column
 * @method     ChildHrUserReferences[]|Collection findByEmployeeId(int|array<int> $employee_id) Return ChildHrUserReferences objects filtered by the employee_id column
 * @psalm-method Collection&\Traversable<ChildHrUserReferences> findByEmployeeId(int|array<int> $employee_id) Return ChildHrUserReferences objects filtered by the employee_id column
 * @method     ChildHrUserReferences[]|Collection findByName(string|array<string> $name) Return ChildHrUserReferences objects filtered by the name column
 * @psalm-method Collection&\Traversable<ChildHrUserReferences> findByName(string|array<string> $name) Return ChildHrUserReferences objects filtered by the name column
 * @method     ChildHrUserReferences[]|Collection findByCompany(string|array<string> $company) Return ChildHrUserReferences objects filtered by the company column
 * @psalm-method Collection&\Traversable<ChildHrUserReferences> findByCompany(string|array<string> $company) Return ChildHrUserReferences objects filtered by the company column
 * @method     ChildHrUserReferences[]|Collection findByConactInformation(string|array<string> $conact_information) Return ChildHrUserReferences objects filtered by the conact_information column
 * @psalm-method Collection&\Traversable<ChildHrUserReferences> findByConactInformation(string|array<string> $conact_information) Return ChildHrUserReferences objects filtered by the conact_information column
 * @method     ChildHrUserReferences[]|Collection findByRelation(string|array<string> $relation) Return ChildHrUserReferences objects filtered by the relation column
 * @psalm-method Collection&\Traversable<ChildHrUserReferences> findByRelation(string|array<string> $relation) Return ChildHrUserReferences objects filtered by the relation column
 * @method     ChildHrUserReferences[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildHrUserReferences objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildHrUserReferences> findByCreatedAt(string|array<string> $created_at) Return ChildHrUserReferences objects filtered by the created_at column
 * @method     ChildHrUserReferences[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildHrUserReferences objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildHrUserReferences> findByUpdatedAt(string|array<string> $updated_at) Return ChildHrUserReferences objects filtered by the updated_at column
 *
 * @method     ChildHrUserReferences[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildHrUserReferences> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class HrUserReferencesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\HrUserReferencesQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\HrUserReferences', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildHrUserReferencesQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildHrUserReferencesQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildHrUserReferencesQuery) {
            return $criteria;
        }
        $query = new ChildHrUserReferencesQuery();
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
     * @return ChildHrUserReferences|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(HrUserReferencesTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = HrUserReferencesTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildHrUserReferences A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT hrre_id, employee_id, name, company, conact_information, relation, created_at, updated_at FROM hr_user_references WHERE hrre_id = :p0';
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
            /** @var ChildHrUserReferences $obj */
            $obj = new ChildHrUserReferences();
            $obj->hydrate($row);
            HrUserReferencesTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildHrUserReferences|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(HrUserReferencesTableMap::COL_HRRE_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(HrUserReferencesTableMap::COL_HRRE_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the hrre_id column
     *
     * Example usage:
     * <code>
     * $query->filterByHrreId(1234); // WHERE hrre_id = 1234
     * $query->filterByHrreId(array(12, 34)); // WHERE hrre_id IN (12, 34)
     * $query->filterByHrreId(array('min' => 12)); // WHERE hrre_id > 12
     * </code>
     *
     * @param mixed $hrreId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByHrreId($hrreId = null, ?string $comparison = null)
    {
        if (is_array($hrreId)) {
            $useMinMax = false;
            if (isset($hrreId['min'])) {
                $this->addUsingAlias(HrUserReferencesTableMap::COL_HRRE_ID, $hrreId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($hrreId['max'])) {
                $this->addUsingAlias(HrUserReferencesTableMap::COL_HRRE_ID, $hrreId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(HrUserReferencesTableMap::COL_HRRE_ID, $hrreId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the employee_id column
     *
     * Example usage:
     * <code>
     * $query->filterByEmployeeId(1234); // WHERE employee_id = 1234
     * $query->filterByEmployeeId(array(12, 34)); // WHERE employee_id IN (12, 34)
     * $query->filterByEmployeeId(array('min' => 12)); // WHERE employee_id > 12
     * </code>
     *
     * @see       filterByEmployee()
     *
     * @param mixed $employeeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmployeeId($employeeId = null, ?string $comparison = null)
    {
        if (is_array($employeeId)) {
            $useMinMax = false;
            if (isset($employeeId['min'])) {
                $this->addUsingAlias(HrUserReferencesTableMap::COL_EMPLOYEE_ID, $employeeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($employeeId['max'])) {
                $this->addUsingAlias(HrUserReferencesTableMap::COL_EMPLOYEE_ID, $employeeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(HrUserReferencesTableMap::COL_EMPLOYEE_ID, $employeeId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%', Criteria::LIKE); // WHERE name LIKE '%fooValue%'
     * $query->filterByName(['foo', 'bar']); // WHERE name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $name The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByName($name = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(HrUserReferencesTableMap::COL_NAME, $name, $comparison);

        return $this;
    }

    /**
     * Filter the query on the company column
     *
     * Example usage:
     * <code>
     * $query->filterByCompany('fooValue');   // WHERE company = 'fooValue'
     * $query->filterByCompany('%fooValue%', Criteria::LIKE); // WHERE company LIKE '%fooValue%'
     * $query->filterByCompany(['foo', 'bar']); // WHERE company IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $company The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCompany($company = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($company)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(HrUserReferencesTableMap::COL_COMPANY, $company, $comparison);

        return $this;
    }

    /**
     * Filter the query on the conact_information column
     *
     * Example usage:
     * <code>
     * $query->filterByConactInformation('fooValue');   // WHERE conact_information = 'fooValue'
     * $query->filterByConactInformation('%fooValue%', Criteria::LIKE); // WHERE conact_information LIKE '%fooValue%'
     * $query->filterByConactInformation(['foo', 'bar']); // WHERE conact_information IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $conactInformation The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByConactInformation($conactInformation = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($conactInformation)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(HrUserReferencesTableMap::COL_CONACT_INFORMATION, $conactInformation, $comparison);

        return $this;
    }

    /**
     * Filter the query on the relation column
     *
     * Example usage:
     * <code>
     * $query->filterByRelation('fooValue');   // WHERE relation = 'fooValue'
     * $query->filterByRelation('%fooValue%', Criteria::LIKE); // WHERE relation LIKE '%fooValue%'
     * $query->filterByRelation(['foo', 'bar']); // WHERE relation IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $relation The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRelation($relation = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($relation)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(HrUserReferencesTableMap::COL_RELATION, $relation, $comparison);

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
                $this->addUsingAlias(HrUserReferencesTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(HrUserReferencesTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(HrUserReferencesTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(HrUserReferencesTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(HrUserReferencesTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(HrUserReferencesTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \entities\Employee object
     *
     * @param \entities\Employee|ObjectCollection $employee The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmployee($employee, ?string $comparison = null)
    {
        if ($employee instanceof \entities\Employee) {
            return $this
                ->addUsingAlias(HrUserReferencesTableMap::COL_EMPLOYEE_ID, $employee->getEmployeeId(), $comparison);
        } elseif ($employee instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(HrUserReferencesTableMap::COL_EMPLOYEE_ID, $employee->toKeyValue('PrimaryKey', 'EmployeeId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByEmployee() only accepts arguments of type \entities\Employee or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Employee relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinEmployee(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Employee');

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
            $this->addJoinObject($join, 'Employee');
        }

        return $this;
    }

    /**
     * Use the Employee relation Employee object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\EmployeeQuery A secondary query class using the current class as primary query
     */
    public function useEmployeeQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinEmployee($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Employee', '\entities\EmployeeQuery');
    }

    /**
     * Use the Employee relation Employee object
     *
     * @param callable(\entities\EmployeeQuery):\entities\EmployeeQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withEmployeeQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useEmployeeQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Employee table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\EmployeeQuery The inner query object of the EXISTS statement
     */
    public function useEmployeeExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\EmployeeQuery */
        $q = $this->useExistsQuery('Employee', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Employee table for a NOT EXISTS query.
     *
     * @see useEmployeeExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\EmployeeQuery The inner query object of the NOT EXISTS statement
     */
    public function useEmployeeNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\EmployeeQuery */
        $q = $this->useExistsQuery('Employee', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Employee table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\EmployeeQuery The inner query object of the IN statement
     */
    public function useInEmployeeQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\EmployeeQuery */
        $q = $this->useInQuery('Employee', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Employee table for a NOT IN query.
     *
     * @see useEmployeeInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\EmployeeQuery The inner query object of the NOT IN statement
     */
    public function useNotInEmployeeQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\EmployeeQuery */
        $q = $this->useInQuery('Employee', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildHrUserReferences $hrUserReferences Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($hrUserReferences = null)
    {
        if ($hrUserReferences) {
            $this->addUsingAlias(HrUserReferencesTableMap::COL_HRRE_ID, $hrUserReferences->getHrreId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the hr_user_references table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(HrUserReferencesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            HrUserReferencesTableMap::clearInstancePool();
            HrUserReferencesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(HrUserReferencesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(HrUserReferencesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            HrUserReferencesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            HrUserReferencesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
