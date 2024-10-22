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
use entities\DeleteBackup as ChildDeleteBackup;
use entities\DeleteBackupQuery as ChildDeleteBackupQuery;
use entities\Map\DeleteBackupTableMap;

/**
 * Base class that represents a query for the `delete_backup` table.
 *
 * @method     ChildDeleteBackupQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildDeleteBackupQuery orderByExpid($order = Criteria::ASC) Order by the expid column
 * @method     ChildDeleteBackupQuery orderByEmpid($order = Criteria::ASC) Order by the empid column
 * @method     ChildDeleteBackupQuery orderByDeletedata($order = Criteria::ASC) Order by the deletedata column
 *
 * @method     ChildDeleteBackupQuery groupById() Group by the id column
 * @method     ChildDeleteBackupQuery groupByExpid() Group by the expid column
 * @method     ChildDeleteBackupQuery groupByEmpid() Group by the empid column
 * @method     ChildDeleteBackupQuery groupByDeletedata() Group by the deletedata column
 *
 * @method     ChildDeleteBackupQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildDeleteBackupQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildDeleteBackupQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildDeleteBackupQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildDeleteBackupQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildDeleteBackupQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildDeleteBackup|null findOne(?ConnectionInterface $con = null) Return the first ChildDeleteBackup matching the query
 * @method     ChildDeleteBackup findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildDeleteBackup matching the query, or a new ChildDeleteBackup object populated from the query conditions when no match is found
 *
 * @method     ChildDeleteBackup|null findOneById(int $id) Return the first ChildDeleteBackup filtered by the id column
 * @method     ChildDeleteBackup|null findOneByExpid(int $expid) Return the first ChildDeleteBackup filtered by the expid column
 * @method     ChildDeleteBackup|null findOneByEmpid(int $empid) Return the first ChildDeleteBackup filtered by the empid column
 * @method     ChildDeleteBackup|null findOneByDeletedata(string $deletedata) Return the first ChildDeleteBackup filtered by the deletedata column
 *
 * @method     ChildDeleteBackup requirePk($key, ?ConnectionInterface $con = null) Return the ChildDeleteBackup by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDeleteBackup requireOne(?ConnectionInterface $con = null) Return the first ChildDeleteBackup matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDeleteBackup requireOneById(int $id) Return the first ChildDeleteBackup filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDeleteBackup requireOneByExpid(int $expid) Return the first ChildDeleteBackup filtered by the expid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDeleteBackup requireOneByEmpid(int $empid) Return the first ChildDeleteBackup filtered by the empid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDeleteBackup requireOneByDeletedata(string $deletedata) Return the first ChildDeleteBackup filtered by the deletedata column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDeleteBackup[]|Collection find(?ConnectionInterface $con = null) Return ChildDeleteBackup objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildDeleteBackup> find(?ConnectionInterface $con = null) Return ChildDeleteBackup objects based on current ModelCriteria
 *
 * @method     ChildDeleteBackup[]|Collection findById(int|array<int> $id) Return ChildDeleteBackup objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildDeleteBackup> findById(int|array<int> $id) Return ChildDeleteBackup objects filtered by the id column
 * @method     ChildDeleteBackup[]|Collection findByExpid(int|array<int> $expid) Return ChildDeleteBackup objects filtered by the expid column
 * @psalm-method Collection&\Traversable<ChildDeleteBackup> findByExpid(int|array<int> $expid) Return ChildDeleteBackup objects filtered by the expid column
 * @method     ChildDeleteBackup[]|Collection findByEmpid(int|array<int> $empid) Return ChildDeleteBackup objects filtered by the empid column
 * @psalm-method Collection&\Traversable<ChildDeleteBackup> findByEmpid(int|array<int> $empid) Return ChildDeleteBackup objects filtered by the empid column
 * @method     ChildDeleteBackup[]|Collection findByDeletedata(string|array<string> $deletedata) Return ChildDeleteBackup objects filtered by the deletedata column
 * @psalm-method Collection&\Traversable<ChildDeleteBackup> findByDeletedata(string|array<string> $deletedata) Return ChildDeleteBackup objects filtered by the deletedata column
 *
 * @method     ChildDeleteBackup[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildDeleteBackup> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class DeleteBackupQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\DeleteBackupQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\DeleteBackup', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildDeleteBackupQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildDeleteBackupQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildDeleteBackupQuery) {
            return $criteria;
        }
        $query = new ChildDeleteBackupQuery();
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
     * @return ChildDeleteBackup|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(DeleteBackupTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = DeleteBackupTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildDeleteBackup A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, expid, empid, deletedata FROM delete_backup WHERE id = :p0';
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
            /** @var ChildDeleteBackup $obj */
            $obj = new ChildDeleteBackup();
            $obj->hydrate($row);
            DeleteBackupTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildDeleteBackup|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(DeleteBackupTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(DeleteBackupTableMap::COL_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(DeleteBackupTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(DeleteBackupTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DeleteBackupTableMap::COL_ID, $id, $comparison);

        return $this;
    }

    /**
     * Filter the query on the expid column
     *
     * Example usage:
     * <code>
     * $query->filterByExpid(1234); // WHERE expid = 1234
     * $query->filterByExpid(array(12, 34)); // WHERE expid IN (12, 34)
     * $query->filterByExpid(array('min' => 12)); // WHERE expid > 12
     * </code>
     *
     * @param mixed $expid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpid($expid = null, ?string $comparison = null)
    {
        if (is_array($expid)) {
            $useMinMax = false;
            if (isset($expid['min'])) {
                $this->addUsingAlias(DeleteBackupTableMap::COL_EXPID, $expid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($expid['max'])) {
                $this->addUsingAlias(DeleteBackupTableMap::COL_EXPID, $expid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DeleteBackupTableMap::COL_EXPID, $expid, $comparison);

        return $this;
    }

    /**
     * Filter the query on the empid column
     *
     * Example usage:
     * <code>
     * $query->filterByEmpid(1234); // WHERE empid = 1234
     * $query->filterByEmpid(array(12, 34)); // WHERE empid IN (12, 34)
     * $query->filterByEmpid(array('min' => 12)); // WHERE empid > 12
     * </code>
     *
     * @param mixed $empid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmpid($empid = null, ?string $comparison = null)
    {
        if (is_array($empid)) {
            $useMinMax = false;
            if (isset($empid['min'])) {
                $this->addUsingAlias(DeleteBackupTableMap::COL_EMPID, $empid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($empid['max'])) {
                $this->addUsingAlias(DeleteBackupTableMap::COL_EMPID, $empid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DeleteBackupTableMap::COL_EMPID, $empid, $comparison);

        return $this;
    }

    /**
     * Filter the query on the deletedata column
     *
     * Example usage:
     * <code>
     * $query->filterByDeletedata('fooValue');   // WHERE deletedata = 'fooValue'
     * $query->filterByDeletedata('%fooValue%', Criteria::LIKE); // WHERE deletedata LIKE '%fooValue%'
     * $query->filterByDeletedata(['foo', 'bar']); // WHERE deletedata IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $deletedata The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDeletedata($deletedata = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($deletedata)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DeleteBackupTableMap::COL_DELETEDATA, $deletedata, $comparison);

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildDeleteBackup $deleteBackup Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($deleteBackup = null)
    {
        if ($deleteBackup) {
            $this->addUsingAlias(DeleteBackupTableMap::COL_ID, $deleteBackup->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the delete_backup table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DeleteBackupTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            DeleteBackupTableMap::clearInstancePool();
            DeleteBackupTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(DeleteBackupTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(DeleteBackupTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            DeleteBackupTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            DeleteBackupTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
