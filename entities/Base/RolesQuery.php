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
use entities\Roles as ChildRoles;
use entities\RolesQuery as ChildRolesQuery;
use entities\Map\RolesTableMap;

/**
 * Base class that represents a query for the `roles` table.
 *
 * @method     ChildRolesQuery orderByRoleId($order = Criteria::ASC) Order by the role_id column
 * @method     ChildRolesQuery orderByRoleName($order = Criteria::ASC) Order by the role_name column
 * @method     ChildRolesQuery orderByRolePrivate($order = Criteria::ASC) Order by the role_private column
 * @method     ChildRolesQuery orderByRoleDesc($order = Criteria::ASC) Order by the role_desc column
 * @method     ChildRolesQuery orderByRolePermissions($order = Criteria::ASC) Order by the role_permissions column
 *
 * @method     ChildRolesQuery groupByRoleId() Group by the role_id column
 * @method     ChildRolesQuery groupByRoleName() Group by the role_name column
 * @method     ChildRolesQuery groupByRolePrivate() Group by the role_private column
 * @method     ChildRolesQuery groupByRoleDesc() Group by the role_desc column
 * @method     ChildRolesQuery groupByRolePermissions() Group by the role_permissions column
 *
 * @method     ChildRolesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildRolesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildRolesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildRolesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildRolesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildRolesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildRolesQuery leftJoinUsers($relationAlias = null) Adds a LEFT JOIN clause to the query using the Users relation
 * @method     ChildRolesQuery rightJoinUsers($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Users relation
 * @method     ChildRolesQuery innerJoinUsers($relationAlias = null) Adds a INNER JOIN clause to the query using the Users relation
 *
 * @method     ChildRolesQuery joinWithUsers($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Users relation
 *
 * @method     ChildRolesQuery leftJoinWithUsers() Adds a LEFT JOIN clause and with to the query using the Users relation
 * @method     ChildRolesQuery rightJoinWithUsers() Adds a RIGHT JOIN clause and with to the query using the Users relation
 * @method     ChildRolesQuery innerJoinWithUsers() Adds a INNER JOIN clause and with to the query using the Users relation
 *
 * @method     \entities\UsersQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildRoles|null findOne(?ConnectionInterface $con = null) Return the first ChildRoles matching the query
 * @method     ChildRoles findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildRoles matching the query, or a new ChildRoles object populated from the query conditions when no match is found
 *
 * @method     ChildRoles|null findOneByRoleId(int $role_id) Return the first ChildRoles filtered by the role_id column
 * @method     ChildRoles|null findOneByRoleName(string $role_name) Return the first ChildRoles filtered by the role_name column
 * @method     ChildRoles|null findOneByRolePrivate(boolean $role_private) Return the first ChildRoles filtered by the role_private column
 * @method     ChildRoles|null findOneByRoleDesc(string $role_desc) Return the first ChildRoles filtered by the role_desc column
 * @method     ChildRoles|null findOneByRolePermissions(string $role_permissions) Return the first ChildRoles filtered by the role_permissions column
 *
 * @method     ChildRoles requirePk($key, ?ConnectionInterface $con = null) Return the ChildRoles by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRoles requireOne(?ConnectionInterface $con = null) Return the first ChildRoles matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildRoles requireOneByRoleId(int $role_id) Return the first ChildRoles filtered by the role_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRoles requireOneByRoleName(string $role_name) Return the first ChildRoles filtered by the role_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRoles requireOneByRolePrivate(boolean $role_private) Return the first ChildRoles filtered by the role_private column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRoles requireOneByRoleDesc(string $role_desc) Return the first ChildRoles filtered by the role_desc column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRoles requireOneByRolePermissions(string $role_permissions) Return the first ChildRoles filtered by the role_permissions column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildRoles[]|Collection find(?ConnectionInterface $con = null) Return ChildRoles objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildRoles> find(?ConnectionInterface $con = null) Return ChildRoles objects based on current ModelCriteria
 *
 * @method     ChildRoles[]|Collection findByRoleId(int|array<int> $role_id) Return ChildRoles objects filtered by the role_id column
 * @psalm-method Collection&\Traversable<ChildRoles> findByRoleId(int|array<int> $role_id) Return ChildRoles objects filtered by the role_id column
 * @method     ChildRoles[]|Collection findByRoleName(string|array<string> $role_name) Return ChildRoles objects filtered by the role_name column
 * @psalm-method Collection&\Traversable<ChildRoles> findByRoleName(string|array<string> $role_name) Return ChildRoles objects filtered by the role_name column
 * @method     ChildRoles[]|Collection findByRolePrivate(boolean|array<boolean> $role_private) Return ChildRoles objects filtered by the role_private column
 * @psalm-method Collection&\Traversable<ChildRoles> findByRolePrivate(boolean|array<boolean> $role_private) Return ChildRoles objects filtered by the role_private column
 * @method     ChildRoles[]|Collection findByRoleDesc(string|array<string> $role_desc) Return ChildRoles objects filtered by the role_desc column
 * @psalm-method Collection&\Traversable<ChildRoles> findByRoleDesc(string|array<string> $role_desc) Return ChildRoles objects filtered by the role_desc column
 * @method     ChildRoles[]|Collection findByRolePermissions(string|array<string> $role_permissions) Return ChildRoles objects filtered by the role_permissions column
 * @psalm-method Collection&\Traversable<ChildRoles> findByRolePermissions(string|array<string> $role_permissions) Return ChildRoles objects filtered by the role_permissions column
 *
 * @method     ChildRoles[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildRoles> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class RolesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\RolesQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\Roles', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildRolesQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildRolesQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildRolesQuery) {
            return $criteria;
        }
        $query = new ChildRolesQuery();
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
     * @return ChildRoles|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(RolesTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = RolesTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildRoles A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT role_id, role_name, role_private, role_desc, role_permissions FROM roles WHERE role_id = :p0';
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
            /** @var ChildRoles $obj */
            $obj = new ChildRoles();
            $obj->hydrate($row);
            RolesTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildRoles|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(RolesTableMap::COL_ROLE_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(RolesTableMap::COL_ROLE_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the role_id column
     *
     * Example usage:
     * <code>
     * $query->filterByRoleId(1234); // WHERE role_id = 1234
     * $query->filterByRoleId(array(12, 34)); // WHERE role_id IN (12, 34)
     * $query->filterByRoleId(array('min' => 12)); // WHERE role_id > 12
     * </code>
     *
     * @param mixed $roleId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRoleId($roleId = null, ?string $comparison = null)
    {
        if (is_array($roleId)) {
            $useMinMax = false;
            if (isset($roleId['min'])) {
                $this->addUsingAlias(RolesTableMap::COL_ROLE_ID, $roleId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($roleId['max'])) {
                $this->addUsingAlias(RolesTableMap::COL_ROLE_ID, $roleId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(RolesTableMap::COL_ROLE_ID, $roleId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the role_name column
     *
     * Example usage:
     * <code>
     * $query->filterByRoleName('fooValue');   // WHERE role_name = 'fooValue'
     * $query->filterByRoleName('%fooValue%', Criteria::LIKE); // WHERE role_name LIKE '%fooValue%'
     * $query->filterByRoleName(['foo', 'bar']); // WHERE role_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $roleName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRoleName($roleName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($roleName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(RolesTableMap::COL_ROLE_NAME, $roleName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the role_private column
     *
     * Example usage:
     * <code>
     * $query->filterByRolePrivate(true); // WHERE role_private = true
     * $query->filterByRolePrivate('yes'); // WHERE role_private = true
     * </code>
     *
     * @param bool|string $rolePrivate The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRolePrivate($rolePrivate = null, ?string $comparison = null)
    {
        if (is_string($rolePrivate)) {
            $rolePrivate = in_array(strtolower($rolePrivate), array('false', 'off', '-', 'no', 'n', '0', ''), true) ? false : true;
        }

        $this->addUsingAlias(RolesTableMap::COL_ROLE_PRIVATE, $rolePrivate, $comparison);

        return $this;
    }

    /**
     * Filter the query on the role_desc column
     *
     * Example usage:
     * <code>
     * $query->filterByRoleDesc('fooValue');   // WHERE role_desc = 'fooValue'
     * $query->filterByRoleDesc('%fooValue%', Criteria::LIKE); // WHERE role_desc LIKE '%fooValue%'
     * $query->filterByRoleDesc(['foo', 'bar']); // WHERE role_desc IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $roleDesc The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRoleDesc($roleDesc = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($roleDesc)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(RolesTableMap::COL_ROLE_DESC, $roleDesc, $comparison);

        return $this;
    }

    /**
     * Filter the query on the role_permissions column
     *
     * Example usage:
     * <code>
     * $query->filterByRolePermissions('fooValue');   // WHERE role_permissions = 'fooValue'
     * $query->filterByRolePermissions('%fooValue%', Criteria::LIKE); // WHERE role_permissions LIKE '%fooValue%'
     * $query->filterByRolePermissions(['foo', 'bar']); // WHERE role_permissions IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $rolePermissions The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRolePermissions($rolePermissions = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($rolePermissions)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(RolesTableMap::COL_ROLE_PERMISSIONS, $rolePermissions, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \entities\Users object
     *
     * @param \entities\Users|ObjectCollection $users the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUsers($users, ?string $comparison = null)
    {
        if ($users instanceof \entities\Users) {
            $this
                ->addUsingAlias(RolesTableMap::COL_ROLE_ID, $users->getRoleId(), $comparison);

            return $this;
        } elseif ($users instanceof ObjectCollection) {
            $this
                ->useUsersQuery()
                ->filterByPrimaryKeys($users->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByUsers() only accepts arguments of type \entities\Users or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Users relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinUsers(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Users');

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
            $this->addJoinObject($join, 'Users');
        }

        return $this;
    }

    /**
     * Use the Users relation Users object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\UsersQuery A secondary query class using the current class as primary query
     */
    public function useUsersQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinUsers($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Users', '\entities\UsersQuery');
    }

    /**
     * Use the Users relation Users object
     *
     * @param callable(\entities\UsersQuery):\entities\UsersQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withUsersQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useUsersQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Users table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\UsersQuery The inner query object of the EXISTS statement
     */
    public function useUsersExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\UsersQuery */
        $q = $this->useExistsQuery('Users', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Users table for a NOT EXISTS query.
     *
     * @see useUsersExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\UsersQuery The inner query object of the NOT EXISTS statement
     */
    public function useUsersNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\UsersQuery */
        $q = $this->useExistsQuery('Users', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Users table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\UsersQuery The inner query object of the IN statement
     */
    public function useInUsersQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\UsersQuery */
        $q = $this->useInQuery('Users', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Users table for a NOT IN query.
     *
     * @see useUsersInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\UsersQuery The inner query object of the NOT IN statement
     */
    public function useNotInUsersQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\UsersQuery */
        $q = $this->useInQuery('Users', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildRoles $roles Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($roles = null)
    {
        if ($roles) {
            $this->addUsingAlias(RolesTableMap::COL_ROLE_ID, $roles->getRoleId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the roles table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(RolesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            RolesTableMap::clearInstancePool();
            RolesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(RolesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(RolesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            RolesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            RolesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
