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
use entities\HrUserDocuments as ChildHrUserDocuments;
use entities\HrUserDocumentsQuery as ChildHrUserDocumentsQuery;
use entities\Map\HrUserDocumentsTableMap;

/**
 * Base class that represents a query for the `hr_user_documents` table.
 *
 * @method     ChildHrUserDocumentsQuery orderByHrdoId($order = Criteria::ASC) Order by the hrdo_id column
 * @method     ChildHrUserDocumentsQuery orderByEmployeeId($order = Criteria::ASC) Order by the employee_id column
 * @method     ChildHrUserDocumentsQuery orderByDocumentId($order = Criteria::ASC) Order by the document_id column
 * @method     ChildHrUserDocumentsQuery orderByScannedFileName($order = Criteria::ASC) Order by the scanned_file_name column
 * @method     ChildHrUserDocumentsQuery orderByMime($order = Criteria::ASC) Order by the mime column
 * @method     ChildHrUserDocumentsQuery orderByFileSize($order = Criteria::ASC) Order by the file_size column
 * @method     ChildHrUserDocumentsQuery orderByRemark($order = Criteria::ASC) Order by the remark column
 * @method     ChildHrUserDocumentsQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildHrUserDocumentsQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildHrUserDocumentsQuery groupByHrdoId() Group by the hrdo_id column
 * @method     ChildHrUserDocumentsQuery groupByEmployeeId() Group by the employee_id column
 * @method     ChildHrUserDocumentsQuery groupByDocumentId() Group by the document_id column
 * @method     ChildHrUserDocumentsQuery groupByScannedFileName() Group by the scanned_file_name column
 * @method     ChildHrUserDocumentsQuery groupByMime() Group by the mime column
 * @method     ChildHrUserDocumentsQuery groupByFileSize() Group by the file_size column
 * @method     ChildHrUserDocumentsQuery groupByRemark() Group by the remark column
 * @method     ChildHrUserDocumentsQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildHrUserDocumentsQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildHrUserDocumentsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildHrUserDocumentsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildHrUserDocumentsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildHrUserDocumentsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildHrUserDocumentsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildHrUserDocumentsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildHrUserDocumentsQuery leftJoinEmployee($relationAlias = null) Adds a LEFT JOIN clause to the query using the Employee relation
 * @method     ChildHrUserDocumentsQuery rightJoinEmployee($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Employee relation
 * @method     ChildHrUserDocumentsQuery innerJoinEmployee($relationAlias = null) Adds a INNER JOIN clause to the query using the Employee relation
 *
 * @method     ChildHrUserDocumentsQuery joinWithEmployee($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Employee relation
 *
 * @method     ChildHrUserDocumentsQuery leftJoinWithEmployee() Adds a LEFT JOIN clause and with to the query using the Employee relation
 * @method     ChildHrUserDocumentsQuery rightJoinWithEmployee() Adds a RIGHT JOIN clause and with to the query using the Employee relation
 * @method     ChildHrUserDocumentsQuery innerJoinWithEmployee() Adds a INNER JOIN clause and with to the query using the Employee relation
 *
 * @method     \entities\EmployeeQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildHrUserDocuments|null findOne(?ConnectionInterface $con = null) Return the first ChildHrUserDocuments matching the query
 * @method     ChildHrUserDocuments findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildHrUserDocuments matching the query, or a new ChildHrUserDocuments object populated from the query conditions when no match is found
 *
 * @method     ChildHrUserDocuments|null findOneByHrdoId(int $hrdo_id) Return the first ChildHrUserDocuments filtered by the hrdo_id column
 * @method     ChildHrUserDocuments|null findOneByEmployeeId(int $employee_id) Return the first ChildHrUserDocuments filtered by the employee_id column
 * @method     ChildHrUserDocuments|null findOneByDocumentId(string $document_id) Return the first ChildHrUserDocuments filtered by the document_id column
 * @method     ChildHrUserDocuments|null findOneByScannedFileName(string $scanned_file_name) Return the first ChildHrUserDocuments filtered by the scanned_file_name column
 * @method     ChildHrUserDocuments|null findOneByMime(string $mime) Return the first ChildHrUserDocuments filtered by the mime column
 * @method     ChildHrUserDocuments|null findOneByFileSize(string $file_size) Return the first ChildHrUserDocuments filtered by the file_size column
 * @method     ChildHrUserDocuments|null findOneByRemark(string $remark) Return the first ChildHrUserDocuments filtered by the remark column
 * @method     ChildHrUserDocuments|null findOneByCreatedAt(string $created_at) Return the first ChildHrUserDocuments filtered by the created_at column
 * @method     ChildHrUserDocuments|null findOneByUpdatedAt(string $updated_at) Return the first ChildHrUserDocuments filtered by the updated_at column
 *
 * @method     ChildHrUserDocuments requirePk($key, ?ConnectionInterface $con = null) Return the ChildHrUserDocuments by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHrUserDocuments requireOne(?ConnectionInterface $con = null) Return the first ChildHrUserDocuments matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildHrUserDocuments requireOneByHrdoId(int $hrdo_id) Return the first ChildHrUserDocuments filtered by the hrdo_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHrUserDocuments requireOneByEmployeeId(int $employee_id) Return the first ChildHrUserDocuments filtered by the employee_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHrUserDocuments requireOneByDocumentId(string $document_id) Return the first ChildHrUserDocuments filtered by the document_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHrUserDocuments requireOneByScannedFileName(string $scanned_file_name) Return the first ChildHrUserDocuments filtered by the scanned_file_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHrUserDocuments requireOneByMime(string $mime) Return the first ChildHrUserDocuments filtered by the mime column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHrUserDocuments requireOneByFileSize(string $file_size) Return the first ChildHrUserDocuments filtered by the file_size column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHrUserDocuments requireOneByRemark(string $remark) Return the first ChildHrUserDocuments filtered by the remark column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHrUserDocuments requireOneByCreatedAt(string $created_at) Return the first ChildHrUserDocuments filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHrUserDocuments requireOneByUpdatedAt(string $updated_at) Return the first ChildHrUserDocuments filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildHrUserDocuments[]|Collection find(?ConnectionInterface $con = null) Return ChildHrUserDocuments objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildHrUserDocuments> find(?ConnectionInterface $con = null) Return ChildHrUserDocuments objects based on current ModelCriteria
 *
 * @method     ChildHrUserDocuments[]|Collection findByHrdoId(int|array<int> $hrdo_id) Return ChildHrUserDocuments objects filtered by the hrdo_id column
 * @psalm-method Collection&\Traversable<ChildHrUserDocuments> findByHrdoId(int|array<int> $hrdo_id) Return ChildHrUserDocuments objects filtered by the hrdo_id column
 * @method     ChildHrUserDocuments[]|Collection findByEmployeeId(int|array<int> $employee_id) Return ChildHrUserDocuments objects filtered by the employee_id column
 * @psalm-method Collection&\Traversable<ChildHrUserDocuments> findByEmployeeId(int|array<int> $employee_id) Return ChildHrUserDocuments objects filtered by the employee_id column
 * @method     ChildHrUserDocuments[]|Collection findByDocumentId(string|array<string> $document_id) Return ChildHrUserDocuments objects filtered by the document_id column
 * @psalm-method Collection&\Traversable<ChildHrUserDocuments> findByDocumentId(string|array<string> $document_id) Return ChildHrUserDocuments objects filtered by the document_id column
 * @method     ChildHrUserDocuments[]|Collection findByScannedFileName(string|array<string> $scanned_file_name) Return ChildHrUserDocuments objects filtered by the scanned_file_name column
 * @psalm-method Collection&\Traversable<ChildHrUserDocuments> findByScannedFileName(string|array<string> $scanned_file_name) Return ChildHrUserDocuments objects filtered by the scanned_file_name column
 * @method     ChildHrUserDocuments[]|Collection findByMime(string|array<string> $mime) Return ChildHrUserDocuments objects filtered by the mime column
 * @psalm-method Collection&\Traversable<ChildHrUserDocuments> findByMime(string|array<string> $mime) Return ChildHrUserDocuments objects filtered by the mime column
 * @method     ChildHrUserDocuments[]|Collection findByFileSize(string|array<string> $file_size) Return ChildHrUserDocuments objects filtered by the file_size column
 * @psalm-method Collection&\Traversable<ChildHrUserDocuments> findByFileSize(string|array<string> $file_size) Return ChildHrUserDocuments objects filtered by the file_size column
 * @method     ChildHrUserDocuments[]|Collection findByRemark(string|array<string> $remark) Return ChildHrUserDocuments objects filtered by the remark column
 * @psalm-method Collection&\Traversable<ChildHrUserDocuments> findByRemark(string|array<string> $remark) Return ChildHrUserDocuments objects filtered by the remark column
 * @method     ChildHrUserDocuments[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildHrUserDocuments objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildHrUserDocuments> findByCreatedAt(string|array<string> $created_at) Return ChildHrUserDocuments objects filtered by the created_at column
 * @method     ChildHrUserDocuments[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildHrUserDocuments objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildHrUserDocuments> findByUpdatedAt(string|array<string> $updated_at) Return ChildHrUserDocuments objects filtered by the updated_at column
 *
 * @method     ChildHrUserDocuments[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildHrUserDocuments> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class HrUserDocumentsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\HrUserDocumentsQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\HrUserDocuments', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildHrUserDocumentsQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildHrUserDocumentsQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildHrUserDocumentsQuery) {
            return $criteria;
        }
        $query = new ChildHrUserDocumentsQuery();
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
     * @return ChildHrUserDocuments|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(HrUserDocumentsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = HrUserDocumentsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildHrUserDocuments A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT hrdo_id, employee_id, document_id, scanned_file_name, mime, file_size, remark, created_at, updated_at FROM hr_user_documents WHERE hrdo_id = :p0';
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
            /** @var ChildHrUserDocuments $obj */
            $obj = new ChildHrUserDocuments();
            $obj->hydrate($row);
            HrUserDocumentsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildHrUserDocuments|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(HrUserDocumentsTableMap::COL_HRDO_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(HrUserDocumentsTableMap::COL_HRDO_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the hrdo_id column
     *
     * Example usage:
     * <code>
     * $query->filterByHrdoId(1234); // WHERE hrdo_id = 1234
     * $query->filterByHrdoId(array(12, 34)); // WHERE hrdo_id IN (12, 34)
     * $query->filterByHrdoId(array('min' => 12)); // WHERE hrdo_id > 12
     * </code>
     *
     * @param mixed $hrdoId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByHrdoId($hrdoId = null, ?string $comparison = null)
    {
        if (is_array($hrdoId)) {
            $useMinMax = false;
            if (isset($hrdoId['min'])) {
                $this->addUsingAlias(HrUserDocumentsTableMap::COL_HRDO_ID, $hrdoId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($hrdoId['max'])) {
                $this->addUsingAlias(HrUserDocumentsTableMap::COL_HRDO_ID, $hrdoId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(HrUserDocumentsTableMap::COL_HRDO_ID, $hrdoId, $comparison);

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
                $this->addUsingAlias(HrUserDocumentsTableMap::COL_EMPLOYEE_ID, $employeeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($employeeId['max'])) {
                $this->addUsingAlias(HrUserDocumentsTableMap::COL_EMPLOYEE_ID, $employeeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(HrUserDocumentsTableMap::COL_EMPLOYEE_ID, $employeeId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the document_id column
     *
     * Example usage:
     * <code>
     * $query->filterByDocumentId('fooValue');   // WHERE document_id = 'fooValue'
     * $query->filterByDocumentId('%fooValue%', Criteria::LIKE); // WHERE document_id LIKE '%fooValue%'
     * $query->filterByDocumentId(['foo', 'bar']); // WHERE document_id IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $documentId The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDocumentId($documentId = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($documentId)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(HrUserDocumentsTableMap::COL_DOCUMENT_ID, $documentId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the scanned_file_name column
     *
     * Example usage:
     * <code>
     * $query->filterByScannedFileName('fooValue');   // WHERE scanned_file_name = 'fooValue'
     * $query->filterByScannedFileName('%fooValue%', Criteria::LIKE); // WHERE scanned_file_name LIKE '%fooValue%'
     * $query->filterByScannedFileName(['foo', 'bar']); // WHERE scanned_file_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $scannedFileName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByScannedFileName($scannedFileName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($scannedFileName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(HrUserDocumentsTableMap::COL_SCANNED_FILE_NAME, $scannedFileName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the mime column
     *
     * Example usage:
     * <code>
     * $query->filterByMime('fooValue');   // WHERE mime = 'fooValue'
     * $query->filterByMime('%fooValue%', Criteria::LIKE); // WHERE mime LIKE '%fooValue%'
     * $query->filterByMime(['foo', 'bar']); // WHERE mime IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $mime The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMime($mime = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($mime)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(HrUserDocumentsTableMap::COL_MIME, $mime, $comparison);

        return $this;
    }

    /**
     * Filter the query on the file_size column
     *
     * Example usage:
     * <code>
     * $query->filterByFileSize('fooValue');   // WHERE file_size = 'fooValue'
     * $query->filterByFileSize('%fooValue%', Criteria::LIKE); // WHERE file_size LIKE '%fooValue%'
     * $query->filterByFileSize(['foo', 'bar']); // WHERE file_size IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $fileSize The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFileSize($fileSize = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fileSize)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(HrUserDocumentsTableMap::COL_FILE_SIZE, $fileSize, $comparison);

        return $this;
    }

    /**
     * Filter the query on the remark column
     *
     * Example usage:
     * <code>
     * $query->filterByRemark('fooValue');   // WHERE remark = 'fooValue'
     * $query->filterByRemark('%fooValue%', Criteria::LIKE); // WHERE remark LIKE '%fooValue%'
     * $query->filterByRemark(['foo', 'bar']); // WHERE remark IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $remark The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRemark($remark = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($remark)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(HrUserDocumentsTableMap::COL_REMARK, $remark, $comparison);

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
                $this->addUsingAlias(HrUserDocumentsTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(HrUserDocumentsTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(HrUserDocumentsTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(HrUserDocumentsTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(HrUserDocumentsTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(HrUserDocumentsTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

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
                ->addUsingAlias(HrUserDocumentsTableMap::COL_EMPLOYEE_ID, $employee->getEmployeeId(), $comparison);
        } elseif ($employee instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(HrUserDocumentsTableMap::COL_EMPLOYEE_ID, $employee->toKeyValue('PrimaryKey', 'EmployeeId'), $comparison);

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
     * @param ChildHrUserDocuments $hrUserDocuments Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($hrUserDocuments = null)
    {
        if ($hrUserDocuments) {
            $this->addUsingAlias(HrUserDocumentsTableMap::COL_HRDO_ID, $hrUserDocuments->getHrdoId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the hr_user_documents table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(HrUserDocumentsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            HrUserDocumentsTableMap::clearInstancePool();
            HrUserDocumentsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(HrUserDocumentsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(HrUserDocumentsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            HrUserDocumentsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            HrUserDocumentsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
