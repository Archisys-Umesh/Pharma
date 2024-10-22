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
use entities\AuditTableData as ChildAuditTableData;
use entities\AuditTableDataQuery as ChildAuditTableDataQuery;
use entities\Map\AuditTableDataTableMap;

/**
 * Base class that represents a query for the `audit_table_data` table.
 *
 * @method     ChildAuditTableDataQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildAuditTableDataQuery orderByAuditTableName($order = Criteria::ASC) Order by the audit_table_name column
 * @method     ChildAuditTableDataQuery orderByPkValue($order = Criteria::ASC) Order by the pk_value column
 * @method     ChildAuditTableDataQuery orderByAuditColumnName($order = Criteria::ASC) Order by the audit_column_name column
 * @method     ChildAuditTableDataQuery orderByOldValue($order = Criteria::ASC) Order by the old_value column
 * @method     ChildAuditTableDataQuery orderByNewValue($order = Criteria::ASC) Order by the new_value column
 * @method     ChildAuditTableDataQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 * @method     ChildAuditTableDataQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildAuditTableDataQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildAuditTableDataQuery groupById() Group by the id column
 * @method     ChildAuditTableDataQuery groupByAuditTableName() Group by the audit_table_name column
 * @method     ChildAuditTableDataQuery groupByPkValue() Group by the pk_value column
 * @method     ChildAuditTableDataQuery groupByAuditColumnName() Group by the audit_column_name column
 * @method     ChildAuditTableDataQuery groupByOldValue() Group by the old_value column
 * @method     ChildAuditTableDataQuery groupByNewValue() Group by the new_value column
 * @method     ChildAuditTableDataQuery groupByUserId() Group by the user_id column
 * @method     ChildAuditTableDataQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildAuditTableDataQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildAuditTableDataQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildAuditTableDataQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildAuditTableDataQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildAuditTableDataQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildAuditTableDataQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildAuditTableDataQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildAuditTableDataQuery leftJoinUsers($relationAlias = null) Adds a LEFT JOIN clause to the query using the Users relation
 * @method     ChildAuditTableDataQuery rightJoinUsers($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Users relation
 * @method     ChildAuditTableDataQuery innerJoinUsers($relationAlias = null) Adds a INNER JOIN clause to the query using the Users relation
 *
 * @method     ChildAuditTableDataQuery joinWithUsers($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Users relation
 *
 * @method     ChildAuditTableDataQuery leftJoinWithUsers() Adds a LEFT JOIN clause and with to the query using the Users relation
 * @method     ChildAuditTableDataQuery rightJoinWithUsers() Adds a RIGHT JOIN clause and with to the query using the Users relation
 * @method     ChildAuditTableDataQuery innerJoinWithUsers() Adds a INNER JOIN clause and with to the query using the Users relation
 *
 * @method     \entities\UsersQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildAuditTableData|null findOne(?ConnectionInterface $con = null) Return the first ChildAuditTableData matching the query
 * @method     ChildAuditTableData findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildAuditTableData matching the query, or a new ChildAuditTableData object populated from the query conditions when no match is found
 *
 * @method     ChildAuditTableData|null findOneById(int $id) Return the first ChildAuditTableData filtered by the id column
 * @method     ChildAuditTableData|null findOneByAuditTableName(string $audit_table_name) Return the first ChildAuditTableData filtered by the audit_table_name column
 * @method     ChildAuditTableData|null findOneByPkValue(string $pk_value) Return the first ChildAuditTableData filtered by the pk_value column
 * @method     ChildAuditTableData|null findOneByAuditColumnName(string $audit_column_name) Return the first ChildAuditTableData filtered by the audit_column_name column
 * @method     ChildAuditTableData|null findOneByOldValue(string $old_value) Return the first ChildAuditTableData filtered by the old_value column
 * @method     ChildAuditTableData|null findOneByNewValue(string $new_value) Return the first ChildAuditTableData filtered by the new_value column
 * @method     ChildAuditTableData|null findOneByUserId(int $user_id) Return the first ChildAuditTableData filtered by the user_id column
 * @method     ChildAuditTableData|null findOneByCreatedAt(string $created_at) Return the first ChildAuditTableData filtered by the created_at column
 * @method     ChildAuditTableData|null findOneByUpdatedAt(string $updated_at) Return the first ChildAuditTableData filtered by the updated_at column
 *
 * @method     ChildAuditTableData requirePk($key, ?ConnectionInterface $con = null) Return the ChildAuditTableData by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAuditTableData requireOne(?ConnectionInterface $con = null) Return the first ChildAuditTableData matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildAuditTableData requireOneById(int $id) Return the first ChildAuditTableData filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAuditTableData requireOneByAuditTableName(string $audit_table_name) Return the first ChildAuditTableData filtered by the audit_table_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAuditTableData requireOneByPkValue(string $pk_value) Return the first ChildAuditTableData filtered by the pk_value column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAuditTableData requireOneByAuditColumnName(string $audit_column_name) Return the first ChildAuditTableData filtered by the audit_column_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAuditTableData requireOneByOldValue(string $old_value) Return the first ChildAuditTableData filtered by the old_value column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAuditTableData requireOneByNewValue(string $new_value) Return the first ChildAuditTableData filtered by the new_value column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAuditTableData requireOneByUserId(int $user_id) Return the first ChildAuditTableData filtered by the user_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAuditTableData requireOneByCreatedAt(string $created_at) Return the first ChildAuditTableData filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAuditTableData requireOneByUpdatedAt(string $updated_at) Return the first ChildAuditTableData filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildAuditTableData[]|Collection find(?ConnectionInterface $con = null) Return ChildAuditTableData objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildAuditTableData> find(?ConnectionInterface $con = null) Return ChildAuditTableData objects based on current ModelCriteria
 *
 * @method     ChildAuditTableData[]|Collection findById(int|array<int> $id) Return ChildAuditTableData objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildAuditTableData> findById(int|array<int> $id) Return ChildAuditTableData objects filtered by the id column
 * @method     ChildAuditTableData[]|Collection findByAuditTableName(string|array<string> $audit_table_name) Return ChildAuditTableData objects filtered by the audit_table_name column
 * @psalm-method Collection&\Traversable<ChildAuditTableData> findByAuditTableName(string|array<string> $audit_table_name) Return ChildAuditTableData objects filtered by the audit_table_name column
 * @method     ChildAuditTableData[]|Collection findByPkValue(string|array<string> $pk_value) Return ChildAuditTableData objects filtered by the pk_value column
 * @psalm-method Collection&\Traversable<ChildAuditTableData> findByPkValue(string|array<string> $pk_value) Return ChildAuditTableData objects filtered by the pk_value column
 * @method     ChildAuditTableData[]|Collection findByAuditColumnName(string|array<string> $audit_column_name) Return ChildAuditTableData objects filtered by the audit_column_name column
 * @psalm-method Collection&\Traversable<ChildAuditTableData> findByAuditColumnName(string|array<string> $audit_column_name) Return ChildAuditTableData objects filtered by the audit_column_name column
 * @method     ChildAuditTableData[]|Collection findByOldValue(string|array<string> $old_value) Return ChildAuditTableData objects filtered by the old_value column
 * @psalm-method Collection&\Traversable<ChildAuditTableData> findByOldValue(string|array<string> $old_value) Return ChildAuditTableData objects filtered by the old_value column
 * @method     ChildAuditTableData[]|Collection findByNewValue(string|array<string> $new_value) Return ChildAuditTableData objects filtered by the new_value column
 * @psalm-method Collection&\Traversable<ChildAuditTableData> findByNewValue(string|array<string> $new_value) Return ChildAuditTableData objects filtered by the new_value column
 * @method     ChildAuditTableData[]|Collection findByUserId(int|array<int> $user_id) Return ChildAuditTableData objects filtered by the user_id column
 * @psalm-method Collection&\Traversable<ChildAuditTableData> findByUserId(int|array<int> $user_id) Return ChildAuditTableData objects filtered by the user_id column
 * @method     ChildAuditTableData[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildAuditTableData objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildAuditTableData> findByCreatedAt(string|array<string> $created_at) Return ChildAuditTableData objects filtered by the created_at column
 * @method     ChildAuditTableData[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildAuditTableData objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildAuditTableData> findByUpdatedAt(string|array<string> $updated_at) Return ChildAuditTableData objects filtered by the updated_at column
 *
 * @method     ChildAuditTableData[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildAuditTableData> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class AuditTableDataQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\AuditTableDataQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\AuditTableData', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildAuditTableDataQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildAuditTableDataQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildAuditTableDataQuery) {
            return $criteria;
        }
        $query = new ChildAuditTableDataQuery();
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
     * @return ChildAuditTableData|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(AuditTableDataTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = AuditTableDataTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildAuditTableData A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, audit_table_name, pk_value, audit_column_name, old_value, new_value, user_id, created_at, updated_at FROM audit_table_data WHERE id = :p0';
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
            /** @var ChildAuditTableData $obj */
            $obj = new ChildAuditTableData();
            $obj->hydrate($row);
            AuditTableDataTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildAuditTableData|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(AuditTableDataTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(AuditTableDataTableMap::COL_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(AuditTableDataTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(AuditTableDataTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AuditTableDataTableMap::COL_ID, $id, $comparison);

        return $this;
    }

    /**
     * Filter the query on the audit_table_name column
     *
     * Example usage:
     * <code>
     * $query->filterByAuditTableName('fooValue');   // WHERE audit_table_name = 'fooValue'
     * $query->filterByAuditTableName('%fooValue%', Criteria::LIKE); // WHERE audit_table_name LIKE '%fooValue%'
     * $query->filterByAuditTableName(['foo', 'bar']); // WHERE audit_table_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $auditTableName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAuditTableName($auditTableName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($auditTableName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AuditTableDataTableMap::COL_AUDIT_TABLE_NAME, $auditTableName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the pk_value column
     *
     * Example usage:
     * <code>
     * $query->filterByPkValue('fooValue');   // WHERE pk_value = 'fooValue'
     * $query->filterByPkValue('%fooValue%', Criteria::LIKE); // WHERE pk_value LIKE '%fooValue%'
     * $query->filterByPkValue(['foo', 'bar']); // WHERE pk_value IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $pkValue The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPkValue($pkValue = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($pkValue)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AuditTableDataTableMap::COL_PK_VALUE, $pkValue, $comparison);

        return $this;
    }

    /**
     * Filter the query on the audit_column_name column
     *
     * Example usage:
     * <code>
     * $query->filterByAuditColumnName('fooValue');   // WHERE audit_column_name = 'fooValue'
     * $query->filterByAuditColumnName('%fooValue%', Criteria::LIKE); // WHERE audit_column_name LIKE '%fooValue%'
     * $query->filterByAuditColumnName(['foo', 'bar']); // WHERE audit_column_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $auditColumnName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAuditColumnName($auditColumnName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($auditColumnName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AuditTableDataTableMap::COL_AUDIT_COLUMN_NAME, $auditColumnName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the old_value column
     *
     * Example usage:
     * <code>
     * $query->filterByOldValue('fooValue');   // WHERE old_value = 'fooValue'
     * $query->filterByOldValue('%fooValue%', Criteria::LIKE); // WHERE old_value LIKE '%fooValue%'
     * $query->filterByOldValue(['foo', 'bar']); // WHERE old_value IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $oldValue The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOldValue($oldValue = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($oldValue)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AuditTableDataTableMap::COL_OLD_VALUE, $oldValue, $comparison);

        return $this;
    }

    /**
     * Filter the query on the new_value column
     *
     * Example usage:
     * <code>
     * $query->filterByNewValue('fooValue');   // WHERE new_value = 'fooValue'
     * $query->filterByNewValue('%fooValue%', Criteria::LIKE); // WHERE new_value LIKE '%fooValue%'
     * $query->filterByNewValue(['foo', 'bar']); // WHERE new_value IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $newValue The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByNewValue($newValue = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($newValue)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AuditTableDataTableMap::COL_NEW_VALUE, $newValue, $comparison);

        return $this;
    }

    /**
     * Filter the query on the user_id column
     *
     * Example usage:
     * <code>
     * $query->filterByUserId(1234); // WHERE user_id = 1234
     * $query->filterByUserId(array(12, 34)); // WHERE user_id IN (12, 34)
     * $query->filterByUserId(array('min' => 12)); // WHERE user_id > 12
     * </code>
     *
     * @see       filterByUsers()
     *
     * @param mixed $userId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUserId($userId = null, ?string $comparison = null)
    {
        if (is_array($userId)) {
            $useMinMax = false;
            if (isset($userId['min'])) {
                $this->addUsingAlias(AuditTableDataTableMap::COL_USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userId['max'])) {
                $this->addUsingAlias(AuditTableDataTableMap::COL_USER_ID, $userId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AuditTableDataTableMap::COL_USER_ID, $userId, $comparison);

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
                $this->addUsingAlias(AuditTableDataTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(AuditTableDataTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AuditTableDataTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(AuditTableDataTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(AuditTableDataTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AuditTableDataTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \entities\Users object
     *
     * @param \entities\Users|ObjectCollection $users The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUsers($users, ?string $comparison = null)
    {
        if ($users instanceof \entities\Users) {
            return $this
                ->addUsingAlias(AuditTableDataTableMap::COL_USER_ID, $users->getUserId(), $comparison);
        } elseif ($users instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(AuditTableDataTableMap::COL_USER_ID, $users->toKeyValue('PrimaryKey', 'UserId'), $comparison);

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
     * @param ChildAuditTableData $auditTableData Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($auditTableData = null)
    {
        if ($auditTableData) {
            $this->addUsingAlias(AuditTableDataTableMap::COL_ID, $auditTableData->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the audit_table_data table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(AuditTableDataTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            AuditTableDataTableMap::clearInstancePool();
            AuditTableDataTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(AuditTableDataTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(AuditTableDataTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            AuditTableDataTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            AuditTableDataTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
