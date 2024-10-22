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
use entities\AnnouncementEmployeeMap as ChildAnnouncementEmployeeMap;
use entities\AnnouncementEmployeeMapQuery as ChildAnnouncementEmployeeMapQuery;
use entities\Map\AnnouncementEmployeeMapTableMap;

/**
 * Base class that represents a query for the `announcement_employee_map` table.
 *
 * @method     ChildAnnouncementEmployeeMapQuery orderByAnnouncementEmployeeMapId($order = Criteria::ASC) Order by the announcement_employee_map_id column
 * @method     ChildAnnouncementEmployeeMapQuery orderByAnnouncementId($order = Criteria::ASC) Order by the announcement_id column
 * @method     ChildAnnouncementEmployeeMapQuery orderByEmployeeId($order = Criteria::ASC) Order by the employee_id column
 * @method     ChildAnnouncementEmployeeMapQuery orderByReadAt($order = Criteria::ASC) Order by the read_at column
 * @method     ChildAnnouncementEmployeeMapQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildAnnouncementEmployeeMapQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildAnnouncementEmployeeMapQuery groupByAnnouncementEmployeeMapId() Group by the announcement_employee_map_id column
 * @method     ChildAnnouncementEmployeeMapQuery groupByAnnouncementId() Group by the announcement_id column
 * @method     ChildAnnouncementEmployeeMapQuery groupByEmployeeId() Group by the employee_id column
 * @method     ChildAnnouncementEmployeeMapQuery groupByReadAt() Group by the read_at column
 * @method     ChildAnnouncementEmployeeMapQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildAnnouncementEmployeeMapQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildAnnouncementEmployeeMapQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildAnnouncementEmployeeMapQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildAnnouncementEmployeeMapQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildAnnouncementEmployeeMapQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildAnnouncementEmployeeMapQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildAnnouncementEmployeeMapQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildAnnouncementEmployeeMapQuery leftJoinAnnouncements($relationAlias = null) Adds a LEFT JOIN clause to the query using the Announcements relation
 * @method     ChildAnnouncementEmployeeMapQuery rightJoinAnnouncements($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Announcements relation
 * @method     ChildAnnouncementEmployeeMapQuery innerJoinAnnouncements($relationAlias = null) Adds a INNER JOIN clause to the query using the Announcements relation
 *
 * @method     ChildAnnouncementEmployeeMapQuery joinWithAnnouncements($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Announcements relation
 *
 * @method     ChildAnnouncementEmployeeMapQuery leftJoinWithAnnouncements() Adds a LEFT JOIN clause and with to the query using the Announcements relation
 * @method     ChildAnnouncementEmployeeMapQuery rightJoinWithAnnouncements() Adds a RIGHT JOIN clause and with to the query using the Announcements relation
 * @method     ChildAnnouncementEmployeeMapQuery innerJoinWithAnnouncements() Adds a INNER JOIN clause and with to the query using the Announcements relation
 *
 * @method     ChildAnnouncementEmployeeMapQuery leftJoinEmployee($relationAlias = null) Adds a LEFT JOIN clause to the query using the Employee relation
 * @method     ChildAnnouncementEmployeeMapQuery rightJoinEmployee($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Employee relation
 * @method     ChildAnnouncementEmployeeMapQuery innerJoinEmployee($relationAlias = null) Adds a INNER JOIN clause to the query using the Employee relation
 *
 * @method     ChildAnnouncementEmployeeMapQuery joinWithEmployee($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Employee relation
 *
 * @method     ChildAnnouncementEmployeeMapQuery leftJoinWithEmployee() Adds a LEFT JOIN clause and with to the query using the Employee relation
 * @method     ChildAnnouncementEmployeeMapQuery rightJoinWithEmployee() Adds a RIGHT JOIN clause and with to the query using the Employee relation
 * @method     ChildAnnouncementEmployeeMapQuery innerJoinWithEmployee() Adds a INNER JOIN clause and with to the query using the Employee relation
 *
 * @method     \entities\AnnouncementsQuery|\entities\EmployeeQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildAnnouncementEmployeeMap|null findOne(?ConnectionInterface $con = null) Return the first ChildAnnouncementEmployeeMap matching the query
 * @method     ChildAnnouncementEmployeeMap findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildAnnouncementEmployeeMap matching the query, or a new ChildAnnouncementEmployeeMap object populated from the query conditions when no match is found
 *
 * @method     ChildAnnouncementEmployeeMap|null findOneByAnnouncementEmployeeMapId(int $announcement_employee_map_id) Return the first ChildAnnouncementEmployeeMap filtered by the announcement_employee_map_id column
 * @method     ChildAnnouncementEmployeeMap|null findOneByAnnouncementId(int $announcement_id) Return the first ChildAnnouncementEmployeeMap filtered by the announcement_id column
 * @method     ChildAnnouncementEmployeeMap|null findOneByEmployeeId(int $employee_id) Return the first ChildAnnouncementEmployeeMap filtered by the employee_id column
 * @method     ChildAnnouncementEmployeeMap|null findOneByReadAt(string $read_at) Return the first ChildAnnouncementEmployeeMap filtered by the read_at column
 * @method     ChildAnnouncementEmployeeMap|null findOneByCreatedAt(string $created_at) Return the first ChildAnnouncementEmployeeMap filtered by the created_at column
 * @method     ChildAnnouncementEmployeeMap|null findOneByUpdatedAt(string $updated_at) Return the first ChildAnnouncementEmployeeMap filtered by the updated_at column
 *
 * @method     ChildAnnouncementEmployeeMap requirePk($key, ?ConnectionInterface $con = null) Return the ChildAnnouncementEmployeeMap by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAnnouncementEmployeeMap requireOne(?ConnectionInterface $con = null) Return the first ChildAnnouncementEmployeeMap matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildAnnouncementEmployeeMap requireOneByAnnouncementEmployeeMapId(int $announcement_employee_map_id) Return the first ChildAnnouncementEmployeeMap filtered by the announcement_employee_map_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAnnouncementEmployeeMap requireOneByAnnouncementId(int $announcement_id) Return the first ChildAnnouncementEmployeeMap filtered by the announcement_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAnnouncementEmployeeMap requireOneByEmployeeId(int $employee_id) Return the first ChildAnnouncementEmployeeMap filtered by the employee_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAnnouncementEmployeeMap requireOneByReadAt(string $read_at) Return the first ChildAnnouncementEmployeeMap filtered by the read_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAnnouncementEmployeeMap requireOneByCreatedAt(string $created_at) Return the first ChildAnnouncementEmployeeMap filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAnnouncementEmployeeMap requireOneByUpdatedAt(string $updated_at) Return the first ChildAnnouncementEmployeeMap filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildAnnouncementEmployeeMap[]|Collection find(?ConnectionInterface $con = null) Return ChildAnnouncementEmployeeMap objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildAnnouncementEmployeeMap> find(?ConnectionInterface $con = null) Return ChildAnnouncementEmployeeMap objects based on current ModelCriteria
 *
 * @method     ChildAnnouncementEmployeeMap[]|Collection findByAnnouncementEmployeeMapId(int|array<int> $announcement_employee_map_id) Return ChildAnnouncementEmployeeMap objects filtered by the announcement_employee_map_id column
 * @psalm-method Collection&\Traversable<ChildAnnouncementEmployeeMap> findByAnnouncementEmployeeMapId(int|array<int> $announcement_employee_map_id) Return ChildAnnouncementEmployeeMap objects filtered by the announcement_employee_map_id column
 * @method     ChildAnnouncementEmployeeMap[]|Collection findByAnnouncementId(int|array<int> $announcement_id) Return ChildAnnouncementEmployeeMap objects filtered by the announcement_id column
 * @psalm-method Collection&\Traversable<ChildAnnouncementEmployeeMap> findByAnnouncementId(int|array<int> $announcement_id) Return ChildAnnouncementEmployeeMap objects filtered by the announcement_id column
 * @method     ChildAnnouncementEmployeeMap[]|Collection findByEmployeeId(int|array<int> $employee_id) Return ChildAnnouncementEmployeeMap objects filtered by the employee_id column
 * @psalm-method Collection&\Traversable<ChildAnnouncementEmployeeMap> findByEmployeeId(int|array<int> $employee_id) Return ChildAnnouncementEmployeeMap objects filtered by the employee_id column
 * @method     ChildAnnouncementEmployeeMap[]|Collection findByReadAt(string|array<string> $read_at) Return ChildAnnouncementEmployeeMap objects filtered by the read_at column
 * @psalm-method Collection&\Traversable<ChildAnnouncementEmployeeMap> findByReadAt(string|array<string> $read_at) Return ChildAnnouncementEmployeeMap objects filtered by the read_at column
 * @method     ChildAnnouncementEmployeeMap[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildAnnouncementEmployeeMap objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildAnnouncementEmployeeMap> findByCreatedAt(string|array<string> $created_at) Return ChildAnnouncementEmployeeMap objects filtered by the created_at column
 * @method     ChildAnnouncementEmployeeMap[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildAnnouncementEmployeeMap objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildAnnouncementEmployeeMap> findByUpdatedAt(string|array<string> $updated_at) Return ChildAnnouncementEmployeeMap objects filtered by the updated_at column
 *
 * @method     ChildAnnouncementEmployeeMap[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildAnnouncementEmployeeMap> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class AnnouncementEmployeeMapQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\AnnouncementEmployeeMapQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\AnnouncementEmployeeMap', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildAnnouncementEmployeeMapQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildAnnouncementEmployeeMapQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildAnnouncementEmployeeMapQuery) {
            return $criteria;
        }
        $query = new ChildAnnouncementEmployeeMapQuery();
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
     * @return ChildAnnouncementEmployeeMap|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(AnnouncementEmployeeMapTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = AnnouncementEmployeeMapTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildAnnouncementEmployeeMap A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT announcement_employee_map_id, announcement_id, employee_id, read_at, created_at, updated_at FROM announcement_employee_map WHERE announcement_employee_map_id = :p0';
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
            /** @var ChildAnnouncementEmployeeMap $obj */
            $obj = new ChildAnnouncementEmployeeMap();
            $obj->hydrate($row);
            AnnouncementEmployeeMapTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildAnnouncementEmployeeMap|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(AnnouncementEmployeeMapTableMap::COL_ANNOUNCEMENT_EMPLOYEE_MAP_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(AnnouncementEmployeeMapTableMap::COL_ANNOUNCEMENT_EMPLOYEE_MAP_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the announcement_employee_map_id column
     *
     * Example usage:
     * <code>
     * $query->filterByAnnouncementEmployeeMapId(1234); // WHERE announcement_employee_map_id = 1234
     * $query->filterByAnnouncementEmployeeMapId(array(12, 34)); // WHERE announcement_employee_map_id IN (12, 34)
     * $query->filterByAnnouncementEmployeeMapId(array('min' => 12)); // WHERE announcement_employee_map_id > 12
     * </code>
     *
     * @param mixed $announcementEmployeeMapId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAnnouncementEmployeeMapId($announcementEmployeeMapId = null, ?string $comparison = null)
    {
        if (is_array($announcementEmployeeMapId)) {
            $useMinMax = false;
            if (isset($announcementEmployeeMapId['min'])) {
                $this->addUsingAlias(AnnouncementEmployeeMapTableMap::COL_ANNOUNCEMENT_EMPLOYEE_MAP_ID, $announcementEmployeeMapId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($announcementEmployeeMapId['max'])) {
                $this->addUsingAlias(AnnouncementEmployeeMapTableMap::COL_ANNOUNCEMENT_EMPLOYEE_MAP_ID, $announcementEmployeeMapId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AnnouncementEmployeeMapTableMap::COL_ANNOUNCEMENT_EMPLOYEE_MAP_ID, $announcementEmployeeMapId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the announcement_id column
     *
     * Example usage:
     * <code>
     * $query->filterByAnnouncementId(1234); // WHERE announcement_id = 1234
     * $query->filterByAnnouncementId(array(12, 34)); // WHERE announcement_id IN (12, 34)
     * $query->filterByAnnouncementId(array('min' => 12)); // WHERE announcement_id > 12
     * </code>
     *
     * @see       filterByAnnouncements()
     *
     * @param mixed $announcementId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAnnouncementId($announcementId = null, ?string $comparison = null)
    {
        if (is_array($announcementId)) {
            $useMinMax = false;
            if (isset($announcementId['min'])) {
                $this->addUsingAlias(AnnouncementEmployeeMapTableMap::COL_ANNOUNCEMENT_ID, $announcementId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($announcementId['max'])) {
                $this->addUsingAlias(AnnouncementEmployeeMapTableMap::COL_ANNOUNCEMENT_ID, $announcementId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AnnouncementEmployeeMapTableMap::COL_ANNOUNCEMENT_ID, $announcementId, $comparison);

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
                $this->addUsingAlias(AnnouncementEmployeeMapTableMap::COL_EMPLOYEE_ID, $employeeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($employeeId['max'])) {
                $this->addUsingAlias(AnnouncementEmployeeMapTableMap::COL_EMPLOYEE_ID, $employeeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AnnouncementEmployeeMapTableMap::COL_EMPLOYEE_ID, $employeeId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the read_at column
     *
     * Example usage:
     * <code>
     * $query->filterByReadAt('2011-03-14'); // WHERE read_at = '2011-03-14'
     * $query->filterByReadAt('now'); // WHERE read_at = '2011-03-14'
     * $query->filterByReadAt(array('max' => 'yesterday')); // WHERE read_at > '2011-03-13'
     * </code>
     *
     * @param mixed $readAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByReadAt($readAt = null, ?string $comparison = null)
    {
        if (is_array($readAt)) {
            $useMinMax = false;
            if (isset($readAt['min'])) {
                $this->addUsingAlias(AnnouncementEmployeeMapTableMap::COL_READ_AT, $readAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($readAt['max'])) {
                $this->addUsingAlias(AnnouncementEmployeeMapTableMap::COL_READ_AT, $readAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AnnouncementEmployeeMapTableMap::COL_READ_AT, $readAt, $comparison);

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
                $this->addUsingAlias(AnnouncementEmployeeMapTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(AnnouncementEmployeeMapTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AnnouncementEmployeeMapTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(AnnouncementEmployeeMapTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(AnnouncementEmployeeMapTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AnnouncementEmployeeMapTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \entities\Announcements object
     *
     * @param \entities\Announcements|ObjectCollection $announcements The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAnnouncements($announcements, ?string $comparison = null)
    {
        if ($announcements instanceof \entities\Announcements) {
            return $this
                ->addUsingAlias(AnnouncementEmployeeMapTableMap::COL_ANNOUNCEMENT_ID, $announcements->getAnnouncementId(), $comparison);
        } elseif ($announcements instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(AnnouncementEmployeeMapTableMap::COL_ANNOUNCEMENT_ID, $announcements->toKeyValue('PrimaryKey', 'AnnouncementId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByAnnouncements() only accepts arguments of type \entities\Announcements or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Announcements relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinAnnouncements(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Announcements');

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
            $this->addJoinObject($join, 'Announcements');
        }

        return $this;
    }

    /**
     * Use the Announcements relation Announcements object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\AnnouncementsQuery A secondary query class using the current class as primary query
     */
    public function useAnnouncementsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinAnnouncements($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Announcements', '\entities\AnnouncementsQuery');
    }

    /**
     * Use the Announcements relation Announcements object
     *
     * @param callable(\entities\AnnouncementsQuery):\entities\AnnouncementsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withAnnouncementsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useAnnouncementsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Announcements table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\AnnouncementsQuery The inner query object of the EXISTS statement
     */
    public function useAnnouncementsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\AnnouncementsQuery */
        $q = $this->useExistsQuery('Announcements', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Announcements table for a NOT EXISTS query.
     *
     * @see useAnnouncementsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\AnnouncementsQuery The inner query object of the NOT EXISTS statement
     */
    public function useAnnouncementsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\AnnouncementsQuery */
        $q = $this->useExistsQuery('Announcements', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Announcements table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\AnnouncementsQuery The inner query object of the IN statement
     */
    public function useInAnnouncementsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\AnnouncementsQuery */
        $q = $this->useInQuery('Announcements', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Announcements table for a NOT IN query.
     *
     * @see useAnnouncementsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\AnnouncementsQuery The inner query object of the NOT IN statement
     */
    public function useNotInAnnouncementsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\AnnouncementsQuery */
        $q = $this->useInQuery('Announcements', $modelAlias, $queryClass, 'NOT IN');
        return $q;
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
                ->addUsingAlias(AnnouncementEmployeeMapTableMap::COL_EMPLOYEE_ID, $employee->getEmployeeId(), $comparison);
        } elseif ($employee instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(AnnouncementEmployeeMapTableMap::COL_EMPLOYEE_ID, $employee->toKeyValue('PrimaryKey', 'EmployeeId'), $comparison);

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
     * @param ChildAnnouncementEmployeeMap $announcementEmployeeMap Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($announcementEmployeeMap = null)
    {
        if ($announcementEmployeeMap) {
            $this->addUsingAlias(AnnouncementEmployeeMapTableMap::COL_ANNOUNCEMENT_EMPLOYEE_MAP_ID, $announcementEmployeeMap->getAnnouncementEmployeeMapId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the announcement_employee_map table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(AnnouncementEmployeeMapTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            AnnouncementEmployeeMapTableMap::clearInstancePool();
            AnnouncementEmployeeMapTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(AnnouncementEmployeeMapTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(AnnouncementEmployeeMapTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            AnnouncementEmployeeMapTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            AnnouncementEmployeeMapTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
