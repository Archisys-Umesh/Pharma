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
use entities\EdPresentationType as ChildEdPresentationType;
use entities\EdPresentationTypeQuery as ChildEdPresentationTypeQuery;
use entities\Map\EdPresentationTypeTableMap;

/**
 * Base class that represents a query for the `ed_presentation_type` table.
 *
 * @method     ChildEdPresentationTypeQuery orderByEdtypeId($order = Criteria::ASC) Order by the edtype_id column
 * @method     ChildEdPresentationTypeQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildEdPresentationTypeQuery orderByPresentationtypeName($order = Criteria::ASC) Order by the presentationtype_name column
 * @method     ChildEdPresentationTypeQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildEdPresentationTypeQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildEdPresentationTypeQuery groupByEdtypeId() Group by the edtype_id column
 * @method     ChildEdPresentationTypeQuery groupByCompanyId() Group by the company_id column
 * @method     ChildEdPresentationTypeQuery groupByPresentationtypeName() Group by the presentationtype_name column
 * @method     ChildEdPresentationTypeQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildEdPresentationTypeQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildEdPresentationTypeQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildEdPresentationTypeQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildEdPresentationTypeQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildEdPresentationTypeQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildEdPresentationTypeQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildEdPresentationTypeQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildEdPresentationType|null findOne(?ConnectionInterface $con = null) Return the first ChildEdPresentationType matching the query
 * @method     ChildEdPresentationType findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildEdPresentationType matching the query, or a new ChildEdPresentationType object populated from the query conditions when no match is found
 *
 * @method     ChildEdPresentationType|null findOneByEdtypeId(int $edtype_id) Return the first ChildEdPresentationType filtered by the edtype_id column
 * @method     ChildEdPresentationType|null findOneByCompanyId(int $company_id) Return the first ChildEdPresentationType filtered by the company_id column
 * @method     ChildEdPresentationType|null findOneByPresentationtypeName(string $presentationtype_name) Return the first ChildEdPresentationType filtered by the presentationtype_name column
 * @method     ChildEdPresentationType|null findOneByCreatedAt(string $created_at) Return the first ChildEdPresentationType filtered by the created_at column
 * @method     ChildEdPresentationType|null findOneByUpdatedAt(string $updated_at) Return the first ChildEdPresentationType filtered by the updated_at column
 *
 * @method     ChildEdPresentationType requirePk($key, ?ConnectionInterface $con = null) Return the ChildEdPresentationType by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEdPresentationType requireOne(?ConnectionInterface $con = null) Return the first ChildEdPresentationType matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEdPresentationType requireOneByEdtypeId(int $edtype_id) Return the first ChildEdPresentationType filtered by the edtype_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEdPresentationType requireOneByCompanyId(int $company_id) Return the first ChildEdPresentationType filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEdPresentationType requireOneByPresentationtypeName(string $presentationtype_name) Return the first ChildEdPresentationType filtered by the presentationtype_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEdPresentationType requireOneByCreatedAt(string $created_at) Return the first ChildEdPresentationType filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEdPresentationType requireOneByUpdatedAt(string $updated_at) Return the first ChildEdPresentationType filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEdPresentationType[]|Collection find(?ConnectionInterface $con = null) Return ChildEdPresentationType objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildEdPresentationType> find(?ConnectionInterface $con = null) Return ChildEdPresentationType objects based on current ModelCriteria
 *
 * @method     ChildEdPresentationType[]|Collection findByEdtypeId(int|array<int> $edtype_id) Return ChildEdPresentationType objects filtered by the edtype_id column
 * @psalm-method Collection&\Traversable<ChildEdPresentationType> findByEdtypeId(int|array<int> $edtype_id) Return ChildEdPresentationType objects filtered by the edtype_id column
 * @method     ChildEdPresentationType[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildEdPresentationType objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildEdPresentationType> findByCompanyId(int|array<int> $company_id) Return ChildEdPresentationType objects filtered by the company_id column
 * @method     ChildEdPresentationType[]|Collection findByPresentationtypeName(string|array<string> $presentationtype_name) Return ChildEdPresentationType objects filtered by the presentationtype_name column
 * @psalm-method Collection&\Traversable<ChildEdPresentationType> findByPresentationtypeName(string|array<string> $presentationtype_name) Return ChildEdPresentationType objects filtered by the presentationtype_name column
 * @method     ChildEdPresentationType[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildEdPresentationType objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildEdPresentationType> findByCreatedAt(string|array<string> $created_at) Return ChildEdPresentationType objects filtered by the created_at column
 * @method     ChildEdPresentationType[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildEdPresentationType objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildEdPresentationType> findByUpdatedAt(string|array<string> $updated_at) Return ChildEdPresentationType objects filtered by the updated_at column
 *
 * @method     ChildEdPresentationType[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildEdPresentationType> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class EdPresentationTypeQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\EdPresentationTypeQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\EdPresentationType', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildEdPresentationTypeQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildEdPresentationTypeQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildEdPresentationTypeQuery) {
            return $criteria;
        }
        $query = new ChildEdPresentationTypeQuery();
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
     * @return ChildEdPresentationType|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(EdPresentationTypeTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = EdPresentationTypeTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildEdPresentationType A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT edtype_id, company_id, presentationtype_name, created_at, updated_at FROM ed_presentation_type WHERE edtype_id = :p0';
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
            /** @var ChildEdPresentationType $obj */
            $obj = new ChildEdPresentationType();
            $obj->hydrate($row);
            EdPresentationTypeTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildEdPresentationType|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(EdPresentationTypeTableMap::COL_EDTYPE_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(EdPresentationTypeTableMap::COL_EDTYPE_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the edtype_id column
     *
     * Example usage:
     * <code>
     * $query->filterByEdtypeId(1234); // WHERE edtype_id = 1234
     * $query->filterByEdtypeId(array(12, 34)); // WHERE edtype_id IN (12, 34)
     * $query->filterByEdtypeId(array('min' => 12)); // WHERE edtype_id > 12
     * </code>
     *
     * @param mixed $edtypeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEdtypeId($edtypeId = null, ?string $comparison = null)
    {
        if (is_array($edtypeId)) {
            $useMinMax = false;
            if (isset($edtypeId['min'])) {
                $this->addUsingAlias(EdPresentationTypeTableMap::COL_EDTYPE_ID, $edtypeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($edtypeId['max'])) {
                $this->addUsingAlias(EdPresentationTypeTableMap::COL_EDTYPE_ID, $edtypeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EdPresentationTypeTableMap::COL_EDTYPE_ID, $edtypeId, $comparison);

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
                $this->addUsingAlias(EdPresentationTypeTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(EdPresentationTypeTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EdPresentationTypeTableMap::COL_COMPANY_ID, $companyId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the presentationtype_name column
     *
     * Example usage:
     * <code>
     * $query->filterByPresentationtypeName('fooValue');   // WHERE presentationtype_name = 'fooValue'
     * $query->filterByPresentationtypeName('%fooValue%', Criteria::LIKE); // WHERE presentationtype_name LIKE '%fooValue%'
     * $query->filterByPresentationtypeName(['foo', 'bar']); // WHERE presentationtype_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $presentationtypeName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPresentationtypeName($presentationtypeName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($presentationtypeName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EdPresentationTypeTableMap::COL_PRESENTATIONTYPE_NAME, $presentationtypeName, $comparison);

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
                $this->addUsingAlias(EdPresentationTypeTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(EdPresentationTypeTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EdPresentationTypeTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(EdPresentationTypeTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(EdPresentationTypeTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EdPresentationTypeTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildEdPresentationType $edPresentationType Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($edPresentationType = null)
    {
        if ($edPresentationType) {
            $this->addUsingAlias(EdPresentationTypeTableMap::COL_EDTYPE_ID, $edPresentationType->getEdtypeId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the ed_presentation_type table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EdPresentationTypeTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            EdPresentationTypeTableMap::clearInstancePool();
            EdPresentationTypeTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(EdPresentationTypeTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(EdPresentationTypeTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            EdPresentationTypeTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            EdPresentationTypeTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
